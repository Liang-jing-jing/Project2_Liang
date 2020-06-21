<?php
error_reporting(0);
session_start();
$servername ="localhost";
$db_username="root";
$db_password="";
$db_name="travel";
$conn=new mysqli($servername,$db_username,$db_password,$db_name);
$user=$_SESSION['user'];
if($_POST['file']){
    $name=$_POST['file'];
}else{
    $name=$_FILES["file"]["name"];
}


$sql="SELECT * FROM myphoto WHERE (userName='$user') AND (PATH='$name')";
$query=mysqli_query($conn,$sql);
$value = $conn->query($sql)->num_rows;
$title = $_POST['title'];
$des = $_POST['des'];

    if ($_FILES["file"]["error"] <= 0) {
        if (!file_exists("upload/" . $_FILES["file"]["name"])){
            move_uploaded_file($_FILES["file"]["tmp_name"],
                "upload/" . $_FILES["file"]["name"]);
        }
    }


if($_POST['country']!=='Filter:Country'&&$_POST['city']!=='Filter:city'&&$_POST['subject']!=='Filter:Subject'){
    $country = $_POST['country'];
    $subject = $_POST['subject'];
    $city=$_POST['city'];

}
if ($user!==null&&$_POST['country']!=='Filter:Country'&&$_POST['city']!=='Filter:city'&&$_POST['subject']!=='Filter:Subject'){
    if ($value==0){
    $sql1="INSERT INTO myphoto(userName,PATH,title,description,country,city,subject) VALUES ('$user','$name','$title','$des','$country','$city','$subject')";
    $query=mysqli_query($conn,$sql1);
    echo"<script type='text/javascript'>location.href = 'src/My_Photo.php'</script>";
}else{
        $sql2 = "SELECT * FROM myphoto WHERE (userName='$user') AND (PATH='$name')";
        $query=mysqli_query($conn,$sql2);
        $row=mysqli_fetch_assoc($query);
        if($country!==$row['country']||$des!==$row['description']||$title!==$row['title']||$city!==$row['city']||$subject!==$row['subject']){

            mysqli_query($conn,"update myphoto set country='$country' WHERE (PATH='$name')");
            mysqli_query($conn,"update myphoto set description='$des' WHERE (PATH='$name')");
            mysqli_query($conn,"update myphoto set city='$city' WHERE (PATH='$name')");
            mysqli_query($conn,"update myphoto set title='$title' WHERE (PATH='$name')");
            mysqli_query($conn,"update myphoto set subject='$subject' WHERE (PATH='$name')");


            echo"<script type='text/javascript'>location.href = 'src/My_Photo.php'</script>";
        }else{
            echo '你已经拥有该图片,点击此处 <a href="src/My_Photo.php">返回</a> 我的上传，进行修改';
        }


}
}

//header("location:src/My_Photo.php");