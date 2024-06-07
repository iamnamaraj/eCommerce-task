<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Input extends Component
{
    public $field;
    public $text;
    public $type;
    public $required;
    public $current;
    /**
     * Create a new component instance.
     */
    public function __construct($field, $text, $type = "text", $required = false, $current = "")
    {
        $this->field = $field;
        $this->text = $text;
        $this->type = $type;
        $this->required = $required;
        $this->current = $current;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.input');
    }
}
