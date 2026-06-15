<?php

namespace Modules\IPE\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class Question extends Component
{
    /**
     * Create a new component instance.
     */
    public $title;
    public $helperQuestions;
    public $uniqueApplicant;
    public $perMark;
    public $disabled;

    public function __construct(
        $title,
        $helperQuestions,
        $uniqueApplicant,
        $perMark = 5,
        $disabled = false
    ) {
        $this->title = $title;
        $this->helperQuestions = $helperQuestions;
        $this->uniqueApplicant = $uniqueApplicant;
        $this->perMark = $perMark;
        $this->disabled = $disabled;
    }

    /**
     * Get the view/contents that represent the component.
     */
    public function render(): View|string
    {
        return view('ipe::components.question');
    }
}
