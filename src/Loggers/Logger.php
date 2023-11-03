<?php

namespace Noxo\FilamentActivityLog\Loggers;

use Closure;
use DragonCode\Support\Concerns\Makeable;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Database\Eloquent\Model;
use Noxo\FilamentActivityLog\Fields;

class Logger
{
    use Concerns\HasEvents;
    use Concerns\Loggable;
    use Makeable;

    public static bool $disabled = false;

    public static ?string $model;

    protected Model $newModel;

    protected ?Model $oldModel;

    public function __construct(Model $newModel, Model $oldModel = null)
    {
        if (is_null($oldModel)) {
            $this->newModel = $newModel;
            $this->oldModel = $oldModel;
        } else {
            $this->newModel = $oldModel;
            $this->oldModel = $newModel;
        }
    }

    public static function getLabel(): string | Htmlable | null
    {
        return (string) str(static::$model)
            ->afterLast('\\')
            ->kebab()
            ->replace(['-', '_'], ' ')
            ->ucfirst();
    }

    /**
     * Perform actions through a closure and update the "modelAfter."
     */
    public function through(Closure $callback): static
    {
        $callback(clone $this->oldModel);

        $this->newModel = $this->oldModel->fresh();

        return $this;
    }

    public static function fields(Fields\Fields $fields): Fields\Fields
    {
        return $fields;
    }

    /**
     * @return array<Fields\Field>
     */
    public function getFields(): array
    {
        return static::fields(new Fields\Fields)->getFields();
    }
}
