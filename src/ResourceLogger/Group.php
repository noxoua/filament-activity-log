<?php

namespace Noxo\FilamentActivityLog\ResourceLogger;

use DragonCode\Support\Concerns\Makeable;

/**
 * @todo Group not working yet..
 */
class Group
{
    use Makeable;
    use Concerns\HasFields;
    use Concerns\HasLabel;

    public function __construct(array $fields)
    {
        $this->fields($fields);
    }
}
