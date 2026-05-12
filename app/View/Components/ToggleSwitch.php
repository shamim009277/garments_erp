<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ToggleSwitch extends Component
{

    public $id;
    public $checked;
    public $dataId;
     /**
     * Create a new component instance.
     */
    public function __construct($id, $checked = false, $dataId = null)
    {
        $this->id = $id;
        $this->checked = $checked;
        $this->dataId = $dataId;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.toggle-switch');
    }
}
