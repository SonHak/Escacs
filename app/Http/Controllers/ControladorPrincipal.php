<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;


class ControladorPrincipal extends Controller
{
    //
    public function login(Request $request)
    {
        //

        $email = $request->input('email');
        $pass = $request->input('password');
   

        if (Auth::attempt(['email'=>$email,'password'=>$pass])) {
            // Authentication passed...
          
            $rand_part = str_shuffle("abcdefghijklmnopqrstuvwxyz0123456789".uniqid());

            $user = User::where('email','=',$email)->first();
            $user->token = $rand_part;
            $user->save();


            return $rand_part;
            

        }else{
            return "error al loggear";
        }
        
    }



    public function logout(Request $request)
    {

        $email = $request->input('email');
        $pass = $request->input('password');

      
        Auth::logout();
        return "Logout +1";

    }
}
