<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ShowChat extends Component
{
    /**
     * Create a new component instance.
     */
    public $messages;

    public function __construct($messages)
    {
        $this->messages = $messages;
    }

    public function render()
    {
        return view('components.show-chat');
    }
}
