<?php

namespace Noxo\FilamentActivityLog;

use Closure;
use Illuminate\Database\Eloquent\Model;

class ActivityLogger
{
    use Concerns\FieldTypeHandler;
    use Concerns\Loggable;
    use Concerns\PrimaryEventLogger;

    public Model $model;

    public ?Model $modelAfter;

    public array $fields;

    public function __construct(Model $model, Model $modelAfter = null)
    {
        $this->model = $model;
        $this->modelAfter = $modelAfter;
    }

    public static function make(Model $model, Model $modelAfter = null): static
    {
        return new static($model, $modelAfter);
    }

    public function through(Closure $callback): static
    {
        $callback(clone $this->model);

        $this->modelAfter = $this->model->fresh();

        return $this;
    }

    /**
     * Get the value of a field, optionally from the "after" model.
     */
    public function getValue(string $key, bool $fromAfter = false): mixed
    {
        $model = $fromAfter ? $this->modelAfter : $this->model;

        $methodName = 'process' . ucfirst($key);
        if (method_exists($this, $methodName) && is_callable([$this, $methodName])) {
            return call_user_func([$this, $methodName], $model);
        }

        $typeValue = $this->getTypeValue($model, $key);
        if ($typeValue !== false) {
            return $typeValue;
        }

        return $model->{$key};
    }
}
