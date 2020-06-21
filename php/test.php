<?php
$serverName = "localhost";
$db_username = "root";
$db_password = "";
$db_name = "travel";
$conn = new mysqli($serverName,$db_username,$db_password,$db_name);
$thing = 'at';
$search = 'Title';
$sql = "SELECT * FROM travelimage WHERE ".$search." LIKE '%".$thing."%'";
$query = mysqli_query($conn,$sql);
$value = mysqli_num_rows($query);
echo $value;