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
        <div class="container">
            <div class="content">
                <input type="text" name="name" id="name" placeholder="Username">
                <input type="text" name="pw" id = "pw" placeholder="Password">
                <input type="submit" value="Login" onclick="myFunction(document.getElementById('name').value,document.getElementById('pw').value)">
            </div>
        </div>
        <script type="text/javascript">
            function myFunction(name,pw){

                window.location.href = "{{ route('authCheck')}}";
            }
        </script>
    </body>
</html>