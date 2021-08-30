<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        session(['url.intended' => url()->previous()]);
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(LoginRequest $request)
    {
       $redirectTo=null;
        $request->authenticate();

       

        //in case intended url is available
    
         $request->session()->regenerate();

      

         // dd(Auth::user);
        if(auth()->check() && (auth()->user()->hasRole('customer'))) {
            // dd('helo');
           if (session()->has('url.intended')) {
                $redirectTo = session()->get('url.intended');
                session()->forget('url.intended');
            }
        } 

        if(auth()->check() && auth()->user()->hasRole('admin')|auth()->user()->hasRole('company')) {
            // dd('helo2');
           return redirect()->to('/car');
        }

          if ($redirectTo) {
            return redirect($redirectTo);
        }

        return redirect()->intended('/');
    }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
