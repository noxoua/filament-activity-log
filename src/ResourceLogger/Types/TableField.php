<?php

namespace Noxo\FilamentActivityLog\ResourceLogger\Types;

use DragonCode\Support\Concerns\Makeable;
use Noxo\FilamentActivityLog\ResourceLogger\Concerns\HasFields;

class TableField
{
    use HasFields;
    use Makeable;

    public function __construct(array $fields)
    {
        $this->fields($fields);
    }
}
