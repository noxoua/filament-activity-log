<?php

namespace Noxo\FilamentActivityLog\ResourceLogger;

class Field
{
    use Concerns\CanDisplay;
    use Concerns\CanResolve;
    use Concerns\CanStore;
    use Concerns\HasLabel;
    use Concerns\HasName;
    use Concerns\HasType;
    use Concerns\HasView;
    use Concerns\Types\Badge;
    use Concerns\Types\Boolean;
    use Concerns\Types\Date;
    use Concerns\Types\Enum;
    use Concerns\Types\Media;
    use Concerns\Types\Money;
    use Concerns\Types\Relation;
    use Concerns\Types\Table;

    public function __construct(string $name, string $type = null)
    {
        $this->name($name);

        if (! is_null($type)) {
            $this->resolveFromString($type);
        }
    }
}
