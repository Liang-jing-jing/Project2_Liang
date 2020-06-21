<?php
error_reporting(0);
$serverName = "localhost";
$db_username = "root";
$db_password = "";
$db_name = "travel";
$connect = new mysqli($serverName,$db_username,$db_password,$db_name);
$user=$_GET['user'];
$path=$_GET['path'];
$title=$_GET['title'];
$des=$_GET['description'];
$content=$_GET['content'];

$sql="SELECT * FROM favoredImage WHERE (userName='$user') AND (PATH='$path')";
$query=mysqli_query($connect,$sql);
$value=mysqli_num_rows($query);
$sql1="DELETE FROM favoredImage WHERE userName=''";
$query1=mysqli_query($connect,$sql1);
$sql2="DELETE FROM favoredImage WHERE PATH=''";
$query2=mysqli_query($connect,$sql2);
if ($user!==''){
    if($value==0){
        mysqli_query($connect,"INSERT INTO favoredImage(PATH,userName) VALUES ('$path','$user')");
        echo '<p>you have favored the photo, click<a href="../src/Details.php?path='.$path.'&title='.$title.'&description='.$des.'&content='.$content.'&user='.$user.'">here</a> to return</p>';
    }else{
        mysqli_query($connect,"DELETE FROM favoredImage WHERE (PATH='$path') AND (userName='$user')");
        echo '<p>you have unfavored the photo, click<a href="../src/Details.php?path='.$path.'&title='.$title.'&description='.$des.'&content='.$content.'&user='.$user.'">here</a> to return';
    }
}else{
    echo"Please <a href='../src/Login.php'>log in</a> first.";
}

