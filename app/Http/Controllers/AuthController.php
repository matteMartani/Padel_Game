<?php

namespace App\Http\Controllers;

use App\Models\DataLayer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class AuthController extends Controller
{
    public function authentication(){
        session_start();
        $_SESSION['login_error'] = false;
        return view('auth.login');
    }

    public function join(){
        session_start();
        $_SESSION['join_error'] = false;
        return view('auth.join');
    }

    public function login(Request $request){

        session_start();
        $dl = new DataLayer();

        if($dl->validUser($request -> input('username'), $request->input('password'))){

            $_SESSION['logged'] = true;
            $_SESSION['username'] = $request->input('username');
            $_SESSION['user_id'] = $dl -> getUserID($request->input('username'));

            //if(!empty($_POST['remember'])){
            //setcookie('username', $_POST['username'], time() + (10*365*24*60*60), "/");
            // setcookie('password', $_POST['password'], time() + (10*365*24*60*60), "/");
            // }

            return Redirect::to(route( 'home' ));
        } else {
            $_SESSION['login_error'] = true;
            return view('auth.login');
        }
    }

    public function register(Request $request){

        session_start();
        $dl = new DataLayer();

        if($dl->checkUsername($request->input('username'))){
            $_SESSION['join_error'] = true;
            return view('auth.join');
        }

        $dl->addUser($request -> input('username'), $request->input('email'), $request->input('password'));

        $_SESSION['logged'] = true;
        $_SESSION['username'] = $request->input('username');
        $_SESSION['user_id'] = $dl -> getUserID($request->input('username'));
        return Redirect::to(route( 'home' ));
    }

    public function logout(){
        session_start();
        session_destroy();
        return Redirect::to(route( 'home' ));
    }
}
