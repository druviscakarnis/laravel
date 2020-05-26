<?php


namespace App\Http\Controllers;


class login_controller extends Controller
{
    public function checkAuth(){
        $db_conn = mysqli_connect('127.0.0.1','root','','laravel_db');

        $name = "admin";
        $pw = "admin";
        $query = "SELECT username,password FROM user_datas WHERE username = '$name' AND password = '$pw'";
        $result = mysqli_query($db_conn,$query);

        if(mysqli_num_rows($result)==1) {
            return view('login');
        }else{
            return view('login_f');
        }
    }
}
?>