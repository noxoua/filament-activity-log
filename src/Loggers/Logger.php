<?php

namespace Noxo\FilamentActivityLog\Loggers;

use Closure;
use DragonCode\Support\Concerns\Makeable;
use Illuminate\Database\Eloquent\Model;

class Logger
{
    use Concerns\HasEvents;
    use Concerns\HasLabel;
    use Concerns\HasRelationManager;
    use Concerns\HasResourceLogger;
    use Concerns\Loggable;
    use Makeable;

    public static bool $disabled = false;

    public static ?string $model;

    protected ?Model $newModel;

    protected ?Model $oldModel;

    public function __construct(Model $newModel = null, Model $oldModel = null)
    {
        if (is_null($oldModel)) {
            $this->newModel = $newModel;
            $this->oldModel = $oldModel;
        } else {
            $this->newModel = $oldModel;
            $this->oldModel = $newModel;
        }
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
}
