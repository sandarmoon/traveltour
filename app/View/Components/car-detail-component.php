<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\Car;
class car-detail-component extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public Car $car;
    public function __construct($car)
    {
        $this->car=$car;


    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        
        dd($this->car);
        return view('components.car-detail-component');
    }
}
