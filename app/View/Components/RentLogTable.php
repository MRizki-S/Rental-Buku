<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class RentLogTable extends Component
{

    // ngisi dulu di sini agar dapet dipake data yang dikirim di rent log table
    public $rentlog;
    /**
     * Create a new component instance.
     */
    public function __construct($rentlog)
    {
        // deklarasikan dulu rent log
        $this->rentlog = $rentlog;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.rent-log-table');
    }
}
