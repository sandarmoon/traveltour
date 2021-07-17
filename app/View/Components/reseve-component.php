<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\Car;

class reseve-component extends Component
{
    public $car;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($car)
    {
        $this->car=Car::find($car);
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {

        return view('components.reseve-component');
    }
}
