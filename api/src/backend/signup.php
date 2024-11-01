<?php 
    function save_data_supabase($emailalias, $passwd){

        $SUPABASE_URL = 'https://anbfscwxhcpoyizceyxs.supabase.co';
        $SUPABASE_KEY = 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6ImFuYmZzY3d4aGNwb3lpemNleXhzIiwicm9sZSI6ImFub24iLCJpYXQiOjE3MzAzODg2ODYsImV4cCI6MjA0NTk2NDY4Nn0.33xy3Ou5xh4k_HlCO9ZTgdWWFfcL0_ddEUH9D6Wt-g4';

        //obtener la data 
        $url = "$SUPABASE_URL/rest/v1/users";

        //consumir data
        $data = [
            'email' => $emailalias,
            'password' => $passwd,
        ];

        //hacer el push 
        $options=[
            'http' => [
                'header' => [ 
                    "Content-Type: application/json",
                    "Authorization: Bearer $SUPABASE_KEY",
                    "apikey: $SUPABASE_KEY"
                ],
                'method' => 'POST',
                'content' => json_encode($data),
            ],
        ];

        $context = stream_context_create($options);
        $response = file_get_contents($url, true, $context);

        if($response === false){
            echo "Error al conectar con la base de datos"; 
        }else{
            echo "user has been created ";
        }
    }


    require "../../config/db_connection.php";

    $email = $_POST['emailalias'];
    $pass = $_POST['passwd'];

    $enc_pass = md5($pass);

    $query = "select * from users where email = '$email'";
    $result = pg_query($conn, $query);
    $row = pg_fetch_assoc($result);
    if($row) {
        //echo "Registro exitoso!";
        echo "<script>alert ('Email already exists!')</script>";
        header ('refresh:0; url=http://127.0.0.1/BETA/api/src/register_form.html');
        exit();
    }



    //DB.connection

    
    //GET data from register_form

    $query = "INSERT INTO users (email,password) VALUES('$email','$enc_pass')"; //execute querry


    $result = pg_query($conn, $query);


    if($result) {
        //echo "Registro exitoso!";
        save_data_supabase($email,$enc_pass);
        //echo "<script>alert ('registration successful!')</script>";
        //header ('refresh:0; url=http://127.0.0.1/BETA/api/src/login_form.html');
    } else {
        echo "Error en el registro!";
    }

    //pg_close($conn);
    //echo "Email" . $email  ;
    //echo "<br>password : " . $pass;
    //echo "<br>enc_password : " . $enc_pass;

    //para crear la base de datos 
    /* CREATE TABLE users (id SERIAL PRIMARY KEY,email varchar(150), password TEXT NOT NULL, status BOOLEAN DEFAULT TRUE , created_at T
    IMESTAMPTZ DEFAULT NOW() , update_at TIMESTAMPTZ DEFAULT NOW(), deleted_at TIMESTAMPTZ);
    */
?>