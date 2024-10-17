<?php 
require "../../config/db_connection.php";

$email = $_POST ['emailalias'];
$pass = $_POST ['passwd'];

$enc_pass = md5($pass);

$query = "SELECT * from users where email = '$email'";
$result = pg_query($conn, $query);
$row = pg_fetch_assoc($result);
if($row) {
    //echo "Registro exitoso!";
    echo "<script>alert ('Email already exists!')</script>";
    header ('refresh:0; url=http://127.0.0.1/BETA/api/src/register_form.html');
    exit();
}



//DB.connection

require('../../config/db_connection.php');

//GET data from register_form

$query = "INSERT INTO users (email,password) VALUES('$email',' $enc_pass')"; //execute querry


$result = pg_query($conn, $query);


if($result) {
    //echo "Registro exitoso!";
    echo "<script>alert ('registration successful!')</script>";
    header ('refresh:0; url=http://127.0.0.1/BETA/api/src/login_form.html');
} else {
    echo "Error en el registro!";
}

pg_close($conn);
//echo "Email" . $email  ;
//echo "<br>password : " . $pass;
//echo "<br>enc_password : " . $enc_pass;

//para crear la base de datos 
/* CREATE TABLE users (id SERIAL PRIMARY KEY,email varchar(150), password TEXT NOT NULL, status BOOLEAN DEFAULT TRUE , created_at T
IMESTAMPTZ DEFAULT NOW() , update_at TIMESTAMPTZ DEFAULT NOW(), deleted_at TIMESTAMPTZ);
*/
?>