<?php

namespace Noxo\FilamentActivityLog;

use Closure;
use Illuminate\Database\Eloquent\Model;

class ActivityLogger
{
    use Concerns\FieldTypeHandler;
    use Concerns\Loggable;
    use Concerns\PrimaryEventLogger;

    public static ?string $modelClass;

    public static ?array $fields;

    public static ?array $types;

    public static ?array $fieldViews;

    protected Model $model;

    protected ?Model $modelAfter;

    public function __construct(Model $model, Model $modelAfter = null)
    {
        $this->model = $model;
        $this->modelAfter = $modelAfter;
    }

    // TODO: Makeable trait
    public static function make(Model $model, Model $modelAfter = null): static
    {
        return new static($model, $modelAfter);
    }

    /**
     * Perform actions through a closure and update the "modelAfter."
     *
     * @param Closure $callback
     *
     * @return static
     */
    public function through(Closure $callback): static
    {
        $callback(clone $this->model);

        $this->modelAfter = $this->model->fresh();

        return $this;
    }

    /**
     * Get the value of a field, optionally from the "after" model.
     *
     * @param string $key
     * @param bool $fromAfter
     *
     * @return mixed
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
