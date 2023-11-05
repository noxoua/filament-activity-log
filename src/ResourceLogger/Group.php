<?php

namespace Noxo\FilamentActivityLog\ResourceLogger;

use DragonCode\Support\Concerns\Makeable;

/**
 * @todo Group not working yet..
 */
class Group
{
    use Concerns\HasFields;
    use Concerns\HasLabel;
    use Makeable;

    public function __construct(array $fields)
    {
        $this->fields($fields);
    }
}
