<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Navbar extends Component
{

    public $username;
    public $lang;
    public function __construct($username, $lang = 'English')
    {
        $this->username = $username;
        $this->lang = $lang;
    }


    public function render(): View|Closure|string
    {
        return view('components.navbar');
    }
}
