<?php

include("conexion.php");
$con=conectar();

$username=$_GET['id'];

$sql="DELETE FROM users  WHERE username='$username'";
$query=mysqli_query($con,$sql);

    if($query){
        Header("Location: alumno.php");
    }
?>
