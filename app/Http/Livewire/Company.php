<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Auth;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use App\Models\User;


class Company extends Component
{
    use WithFileUploads;

    public $currentStep = 1;
    public $company;
    public $username,$email,$password,$password_confirmation;
    public $name, $price, $detail, $status = 1;
    public  $logo,$info,$phone,$address;
    public $successMsg = '';

    

    public function render()
    {
        if(Auth::check()){
            $this->currentStep=2;
        }
        return view('livewire.company');
    }
    /**
     * Write code on Method
     */
    public function firstStepSubmit()
    {
        $validatedData = $this->validate([
             'username' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // dd('you made it');
        $user = User::create([
            'name' => $this->username,
            'email' => $this->email,
            'password' => Hash::make($this->password),
        ]);

        $user->assignRole('company');

        event(new Registered($user));

        Auth::login($user);

        $this->currentStep = 2;
    }
  
    /**
     * Write code on Method
     */
    public function secondStepSubmit()
    {

        if(Auth::user()->hasRole('company')){
            if(empty(Auth::user()->company)){
                $validatedData = $this->validate([
                    'name' => 'required|unique:companies',
                    'logo' => 'required|image|max:1024',
                    'info' => 'required',
                    'phone' => 'required',
                    'address' => 'required',
                ]);
                $filename=time();

                $path = $this->logo->storeAs('logo',$filename,'public');

                
                // if(Auth::check() && Auth::user()->hasRole()){

                // }
                 
                 $this->company=\App\Models\Company::create([
                    'name'=>$this->name,
                    'logo'=>$path,
                    'info'=>$this->info,
                    'phone'=>$this->phone,
                    'address'=>$this->address,
                    'status'=>1,
                    'user_id'=>Auth::user()->id
                 ]);
            }else{
                $this->successMsg = 'Company already exists.';
            }
        }else{
            dd('no he is not');
        }

        // dd('helo');
        

  
        $this->currentStep = 3;
    }
  
    /**
     * Write code on Method
     */
    public function submitForm()
    {
        Team::create([
            'name' => $this->name,
            'price' => $this->price,
            'detail' => $this->detail,
            'status' => $this->status,
        ]);
  
        $this->successMsg = 'Team successfully created.';
  
        $this->clearForm();
  
        $this->currentStep = 1;
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
