<?php 

$email = $_POST ['emailalias'];

$pass = $_POST ['passwd'];

$enc_pass = md5($pass);


//DB.connection

require('../../config/db_connection.php');
 
//GET data from register_form

$query = "INSERT INTO users (email,password) VALUES('$email',' $enc_pass')";

$result = pg_query($conn, $query);


if($result) {
    echo "Registro exitoso!";
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