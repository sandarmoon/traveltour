<?php
namespace App\View\Components;
use Illuminate\View\Component;
use App\Models\City;

class searching extends Component
{
   public $allcities;
   public $left;

   public $packages;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($left=0,$packages)
    {
       
        $this->allcities=City::whereNull('parent_id')->get();

        $this->left=$left;
        $this->packages=$packages;
         

        
    }

    

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
       
         

        return view('components.searchingnew',['cities'=>$this->cities]);





    }
}
