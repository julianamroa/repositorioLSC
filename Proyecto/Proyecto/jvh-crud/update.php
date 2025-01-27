<?php

include("conexion.php");
$con=conectar();

$username=$_POST['username'];
$email=$_POST['email'];
$user_type=$_POST['user_type'];
$password=$_POST['password'];


$sql="UPDATE users SET email ='$email',user_type='$user_type', password='$password' WHERE username='$username'";
$query=mysqli_query($con,$sql);

    if($query){
        Header("Location: alumno.php");
    }
?>