
<?php
session_start();
header("content-type:text/html;charset = utf8");
$serverName = "localhost";
$db_username = "root";
$db_password = "";
$db_name = "travel";
$connect = new mysqli($serverName,$db_username,$db_password,$db_name);
$name = $_POST["username"];
$password = $_POST["password"];
$sql = "SELECT UserName,Pass From traveluser WHERE (UserName = '$name')AND (Pass = '$password')";
$query = mysqli_query($connect,$sql);
$result = $connect->query($sql);
if($result->num_rows > 0){
    $_SESSION['user'] = $name;
//    echo "<script type='text/javascript'>location.href = '../index.php'</script>";
    header("location:../index.php");
}
else{
    exit('fail to log in, please click here<a href="../src/Login.php">return</a>');
}