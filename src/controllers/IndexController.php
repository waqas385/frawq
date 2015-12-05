<?php

namespace Controllers;

use View,
    Redirect,    Input;

class IndexController extends \System\Controller {

    public function index() {
        // to access template placed under a folder with in view
        //$home = View::make('forms.forms',array('inner_content' => 'Welcome'));
        
        $home = View::make('home',array('inner_content' => 'Welcome'));
        return View::make('main', array('content' => $home));
    }

    /*
    public function login() {
        $login = View::make('login');
        return View::make('main', array('content' => $login));
    }

    public function doLogin() {
        $email = Input::get('email');
        $password = Input::get('password');
        
        if($email == "admin@admin.com" && $password == "admin1234"){
            $_SESSION['user'] = 'admin@admin.com';
            return Redirect::to('list');
        }elseif($email == "guest@guest.com" && $password == "guest1234"){
            $_SESSION['user'] = 'guest@guest.com';
            return Redirect::to('list');
        }
        
        return Redirect::to('login', array('error' => 'Email or Password is incorrect'));
        
    }
    
    public function logout(){
        unset($_SESSION['user']);
        return Redirect::to('/');
    }
    */
}
