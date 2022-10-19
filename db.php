<?php

session_start();

$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "taxnow";

/*$dbhost = "localhost";
$dbuser = "c64rrhh";
$dbpass = "iofdpWWPB2T2@";
$dbname = "c64rrhh";*/

$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

if(!$conn){
    die("No hay conexion:" .mysqli_connect_error());
}
?>
