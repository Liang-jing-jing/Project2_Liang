<?php
session_start();
$servername ="localhost";
$db_username="root";
$db_password="";
$db_name="travel";
$conn=new mysqli($servername,$db_username,$db_password,$db_name);
$user=$_GET['user'];
$path = $_GET['path'];
mysqli_query($conn,"DELETE FROM favoredImage WHERE (userName='$user') AND (PATH='$path')");
header("location:My_Favourite.php");