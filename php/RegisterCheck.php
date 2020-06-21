<?php
if(isset($_POST["submit"])) {
    session_start();
    header("content-type:text/html;charset = utf8");
    $serverName = "localhost";
    $db_username = "root";
    $db_password = "";
    $db_name = "travel";
    $connect = new mysqli($serverName,$db_username,$db_password,$db_name);
    if ($connect->connect_error) {
        die("连接失败: " . $connect->connect_error);
    }
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['pw'];

    $sql0 = "SELECT UserName FROM traveluser WHERE (UserName = '$name')";
    $result=mysqli_query($connect,$sql0);
    $rowcount=mysqli_num_rows($result);
    if ($rowcount === 0){
        $sql = "INSERT INTO traveluser (Email, UserName, Pass)
            VALUES ('$email', '$name', '$password')";

        if($connect->query($sql) === TRUE){
            echo "<script type='text/javascript'>location.href = '../src/Login.php'</script>";
        }

    }
    else{
        exit('the userName has been registered, you fail to register, please click here<a href="../src/Register.html">return</a>');
    }


}
