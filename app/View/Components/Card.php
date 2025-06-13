<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Card extends Component
{
    public $media;
    public function __construct($media){
        $this->media = $media;
    }

    public function render(): View|Closure|string
    {
        return view('components.card');
    }
}
