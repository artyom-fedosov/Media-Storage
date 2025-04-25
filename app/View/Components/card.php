<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Card extends Component
{

    public $title;
    public $keywords = [];
    public $descr;
    public $image;

    public function __construct($title, $keywords=[], $descr=null, $image="https://www.w3schools.com/howto/img_avatar.png")
    {
        $this->title = $title;
        $this->keywords = $keywords;
        $this->descr = $descr;
        $this->image = $image;
    }


    public function render(): View|Closure|string
    {
        return view('components.card');
    }
}
