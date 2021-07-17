<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\City;
use App\Models\Car;
use App\Models\Booking;
use App\Http\Resources\CarResource;
use Carbon\Carbon;
use Auth;

class Wizard extends Component
{
    public $currentStep = 1;
    public $name, $price, $detail, $status = 1;
    public $successMsg = '';

    public $loc;
    public $loc_id;
    // starting
    public  $cars;
    public $car;
    public $location=[];
    public $company_phone,$company_name,$city_name;
    public $type_name,$brand_name,$company_address;

    public $drop,$pickup,$sdate,$edate;
   


    public function mount($cars,$drop,$pickup,$sdate,$edate){
        $this->cars=$cars;
        $this->drop=$drop;
        $this->pickup=$pickup;
        $this->sdate=$sdate;
        $this->edate=$edate;
    }

    public function render()
    {
        $cars=$this->cars;
        $cities=City::whereNull('parent_id')->get();
        return view('livewire.wizard',compact('cars','cities'));
    }

    public function firstStepSubmit($id)
    {
        $c=Car::find($id);
        $this->car=$c;

        foreach($c->pickuppivot as $p)
        {
            $fullname=$p->name;
            $city=$p->parent->name;
            $format=['name'=>$fullname,'city'=>$city,'id'=>$p->id];
            array_push($this->location, $format);
        }
        // dd($this->location);
        $this->company_name=$c->company->name;
        $this->company_phone=$c->company->phone;
        $this->company_address=$c->company->addresss;

        $this->type_name=$c->type->name;
        $this->brand_name=$c->brand->name;
        $this->city_name=$c->city->name;

    
        // dd(var_dump($this->car));
        // $validatedData = $this->validate([
        //     'name' => 'required',
        //     'price' => 'required|numeric',
        //     'detail' => 'required',
        // ]);
 
        $this->currentStep = 2;
    }
  
    /**
     * Write code on Method
     */
    public function secondStepSubmit()
    {
        $validatedData = $this->validate([
            'loc' => 'required',
        ]);
        
       $finalpickup=City::find($this->loc);
       // dd($finalpickup);
       $this->loc=$finalpickup->name;
       $this->loc_id=$finalpickup->id;
       $this->city=$finalpickup->parent->name;
        $this->currentStep = 3;
    }

    function generateRandomString($length = 20) {
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $charactersLength = strlen($characters);
            $randomString = '';
            for ($i = 0; $i < $length; $i++) {
                $randomString .= $characters[rand(0, $charactersLength - 1)];
            }
            return $randomString;
        }
       
  
    /**
     * Write code on Method
     */
    public function submitForm()
    {
        $booking_date=date("d/m/Y");
        
        $booking_code = $this->generateRandomString(5);

        $user_id=Auth::user()->id;

        $car_id=$this->car->id;

        $from_city_id=$this->pickup->id;
        $to_city_id=$this->pickup->id;
        

        $sd = new Carbon($this->sdate);
        $ed = new Carbon($this->edate);
        $day=$sd->diffInDays($ed);


       $discount=$this->car->discount;
       $price=$this->car->priceperday;
       $subtotal=0;
       if($discount ==0){
        $subtotal=$price * $day;
       }else{
        $subtotal=$discount * $day;
       }

       $a = 5/100;
        $b = round($a*$subtotal);
         $percent=0;
        if (($b != "") && ($a != "")){
           $percent = $b;
            } else {
            $percent = 0;
            }

        $total=$subtotal+ $percent;
       
       $pickup_location=$this->loc_id;
       $custom_location='';


       Booking::create([
        'booking_code'=>$booking_code,
        'booking_date'=>$booking_date,
        'user_id'=>$user_id,
        'car_id'=>$car_id,
        'from_city_id'=>$from_city_id,
        'to_city_id'=>$to_city_id,
        'day'=>$day,
        'total'=>$total,
        'pickup_id'=>$pickup_location,
        'custom_pickup'=>'',
        'departure_date'=>$sd,
        'arrival_date'=>$ed,
        'pickup_time'=>'5:00 AM',
        'status'=>1

       ]);
  
        $this->clearForm();
        session()->flash('message', 'Booking is successfully added!.');
         return redirect()->to('/front/');
    }
  
    /**
     * Write code on Method
     */
    public function back($step)
    {
        $this->currentStep = $step;    
    }
  
    /**
     * Write code on Method
     */
    public function clearForm()
    {
        $this->name = '';
        $this->price = '';
        $this->detail = '';
        $this->status = 1;
    }
}
