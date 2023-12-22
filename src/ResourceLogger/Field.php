<?php

namespace Noxo\FilamentActivityLog\ResourceLogger;

use DragonCode\Support\Concerns\Makeable;
use Filament\Forms\Components\Concerns\CanAllowHtml;
use Filament\Support\Concerns\EvaluatesClosures;

class Field
{
    use CanAllowHtml;
    use Concerns\CanDisplay;
    use Concerns\CanStore;
    use Concerns\FieldResolver;
    use Concerns\HasLabel;
    use Concerns\HasName;
    use Concerns\HasState;
    use Concerns\HasTemplate;
    use Concerns\HasType;
    use Concerns\HasView;
    use Concerns\Types\Badge;
    use Concerns\Types\Boolean;
    use Concerns\Types\Date;
    use Concerns\Types\Difference;
    use Concerns\Types\Enum;
    use Concerns\Types\Inline;
    use Concerns\Types\KeyValue;
    use Concerns\Types\Media;
    use Concerns\Types\Money;
    use Concerns\Types\Relation;
    use Concerns\Types\Table;
    use EvaluatesClosures;
    use Makeable;

    public function __construct(string $name, ?string $type = null)
    {
        $this->name($name);

        if (! is_null($type)) {
            $this->resolveField($type);
        }
    }
}
