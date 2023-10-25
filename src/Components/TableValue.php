<?php

namespace Noxo\FilamentActivityLog\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class TableValue extends Component
{
    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View | Closure | string
    {
        return view('filament-activity-log::components.table-value');
    }
}
