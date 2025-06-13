<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Breadcrumb extends Component
{
    public $title;
    public $subtitle;
    public $right;
    /**
     * Create a new component instance.
     */
    public function __construct($title = null, $subtitle = null, $right = [])
    {
        $this->title = $title;
        $this->subtitle = $subtitle;
        $this->right = $right;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.breadcrumb');
    }
}
