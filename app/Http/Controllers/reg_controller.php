<?php


namespace App\Http\Controllers;
use App\Models\User;

class reg_controller extends Controller
{
    public function addUser(){
        $name  = request()->input('name', '');
        $pw = request()->input('pw', '');
        if($name == '' || $pw == ''){
            return view('welcome');
        }else {
            User::insert([
                ['username' => $name, 'password' => $pw]
            ]);
        }
    }
}