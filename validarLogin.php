<?php
include("db.php");

$user = $_POST['user'];
$pass = md5($_POST['pass']);

$_SESSION['user']=$user;

$query = "SELECT*FROM users where user='$user' and pass='$pass'";
$result = mysqli_query($conn, $query);

$fill=mysqli_num_rows($result);

if($fill){
    header('location: home.php');
}else{
    ?>
    <h1>ERROR AUTENTIFICACION</h1>
    <?php
}
mysqli_free_result($result)
?>