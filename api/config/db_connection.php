<?php

/*
$number1 = 20;
$number2 = 12;


$number3 = $number1 + $number2;

echo $number3;

*/



//database conetion 
//developer juan chaucanez  
//data quemada
$servername = "localhost";//127.0.0.1;localhost
$username = "postgres";//credenciales 
$password = "unicesmag";
//nombre base datos
$dbname = "beta";
$port = "5432";

//credencial de conectividad
$data_connection = "
host   = $host
port   = $port
dbname = $dbname
user   = $username
password = $password
";
//conectar al puerto
$conn = pg_connect($data_connection);
//da permisos 
//solo para los programadores 
if (!$conn) {
    die("cagaste mano ". pg_last_error());
} else {

    echo "conectado mano";
 
}



pg_close($conn);


?>

