<?php

namespace Controllers;

use View,
    Redirect,    Input;

class IndexController extends \System\Controller {

    /*
     * action index
     */
    public function index() {
        return View::make('main', array('content' => 'Welcome Developer!'));
    }

    /*
     * action login
     */
    public function login() {
        // To access template within folder
        $login = View::make('forms.login');
        
        return View::make('main', array('content' => $login));
    }
    
    /*
     * action do-login will validate user against credentials
     */
    public function doLogin() {
        $email = Input::get('email');
        $password = Input::get('password');
        
        if($email == "admin@admin.com" && $password == "admin1234"){
            $_SESSION['user'] = 'admin@admin.com';
            // on successfull credentials
            return Redirect::to('dashboard');
        }
        
        return Redirect::to('login', array('error' => 'Email or Password is incorrect'));
        
    }
    
    /*
     * action logout, will destroy user session
     */
    public function logout(){
        unset($_SESSION['user']);
        return Redirect::to('/');
    }
    
    
    /*
     * action dashboard, after successful login
     */
    public function dashboard(){
        return View::make('main', array('content' => 'Hello User '.$_SESSION['user']));
    }
}
