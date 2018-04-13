<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\fichas;
use App\partida;

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


            
            return $user->token;
            

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


     public function espera(Request $request)
    {
        $arrayUsuarios = User::all();

        return $arrayUsuarios->toJson(JSON_PRETTY_PRINT);

    }


    public function jugar(Request $request)
    {

        try{
            $newPartida = new Partida;
            
           $user1 = $request->input('usuarioCrea');
           $user2 = $request->input('usuarioAcepta');

           $newPartida->user1 = $user1;
           $newPartida->user2 = $user2;

           $newPartida->save();

            return "se creó la partida";
        }
        catch (\Exception $e){
            return $e->getMessage();

        }



    }



}
