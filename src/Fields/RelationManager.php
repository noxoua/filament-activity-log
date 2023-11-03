<?php

namespace Noxo\FilamentActivityLog\Fields;

class RelationManager
{
    use Concerns\HasFields;
    use Concerns\HasLabel;
    use Concerns\HasName;

    public function __construct(string $name)
    {
        $this->name($name);
    }
}
