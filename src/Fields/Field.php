<?php

namespace Noxo\FilamentActivityLog\Fields;

use Closure;

class Field
{
    use Concerns\Displayable;
    use Concerns\Storable;
    use Concerns\Types\Badge;
    use Concerns\Types\Boolean;
    use Concerns\Types\Date;
    use Concerns\Types\Enum;
    use Concerns\Types\Media;
    use Concerns\Types\Money;
    use Concerns\Types\Relation;
    use Concerns\Types\Table;

    public string $name;

    public ?string $type = null;

    public mixed $options = null;

    public ?Closure $resolveCallback = null;

    public ?string $view = 'default';

    public ?string $label = null;

    public function __construct(string $name, string $type = null)
    {
        $this->name($name);

        if (! is_null($type)) {
            $this->resolveFromString($type);
        }
    }

    public function name(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function resolveFromString(string $string): static
    {
        if (str_contains($string, ':')) {
            [$type, $options] = explode(':', $string);
        } else {
            [$type, $options] = [$string, null];
        }

        $list = [
            'boolean',
            'badge',
            'date',
            'money',
            'label',
            'media',
            'relation',
        ];

        if (in_array($type, $list)) {
            $this->{$type}($options);
        }

        return $this;
    }

    public function is(string $type): bool
    {
        return $this->type === $type;
    }

    public function type(string $type, mixed $options = null): static
    {
        $this->type = $type;
        $this->options = $options;

        return $this;
    }

    public function resolveUsing(Closure $callback): static
    {
        $this->resolveCallback = $callback;

        return $this;
    }

    public function view(string $view): static
    {
        $this->view = $view;

        return $this;
    }

    public function label(string $key): static
    {
        $this->label = $key;

        return $this;
    }
}
