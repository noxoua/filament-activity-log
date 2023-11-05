<?php

namespace Noxo\FilamentActivityLog\ResourceLogger;

use DragonCode\Support\Concerns\Makeable;

class RelationManager
{
    use Concerns\HasFields;
    use Concerns\HasLabel;
    use Concerns\HasName;
    use Concerns\HasRelationLoader;
    use Makeable;

    public function __construct(string $name)
    {
        $this->name($name);
    }
}
