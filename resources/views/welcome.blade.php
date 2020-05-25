<!DOCTYPE html>
<html>
    <head>
        <title>Laravel</title>

        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">

        <style>
            html, body {
                height: 100%;
            }

            body {
                margin: 0;
                padding: 0;
                width: 100%;
                display: table;
                font-weight: 100;
                font-family: 'Lato';
            }

            .container {
                text-align: center;
                display: table-cell;
                vertical-align: middle;
            }

            .content {
                text-align: center;
                display: inline-block;
            }

            .title {
                font-size: 96px;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="content">
                <input type="text" name="name" placeholder="Username">
                <input type="text" name="pw" placeholder="Password">
                <input type="submit" name="submit" value="Login">
            </div>
        </div>
        <?php
            $temp_username = "";
            $temp_password = "";
            $db_conn = mysqli_connect('127.0.0.1','root','','laravel_db');

            if(isset($_POST['submit'])){
                $temp_username = ($_GET['name']);
                $temp_password = ($_GET['pw']);
            $query = "SELECT username,password FROM user_datas WHERE username = '$temp_username' AND password = '$temp_password'";
            $res = mysqli_query($db_conn,$query);
            if(mysqli_num_rows($res) > 0){
                print "Veikmīgi!";
            }


            }
        ?>
    </body>
</html>
