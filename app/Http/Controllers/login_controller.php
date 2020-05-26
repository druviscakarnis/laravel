<?php


namespace App\Http\Controllers;
use input;
use App\Models\User;
use DB;

class login_controller extends Controller
{
    public function checkAuth(){
        //$db_conn = mysqli_connect('127.0.0.1','root','','laravel_db');

        /*$name  = request()->input('name', 'default');
        $pw = request()->input('pw', 'default');
        $query = "SELECT username,password FROM user_datas WHERE username = '$name' AND password = '$pw'";
        $result = mysqli_query($db_conn,$query);

        if(mysqli_num_rows($result)==1) {
            return view('login');
        }else{
            return view('login_f');
        }*/
        $users_temp = User::where('username', 'admin')
        ->first();
        dump($users_temp);
        $users = User::get();
        foreach($users as $user){
            echo "Lietotājs: ".$user->username." ".$user->password."<br>";
        }
        $userCount = User::count();
        echo "Lietotāju skaits: ".$userCount;

    }

}
?>