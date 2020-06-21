<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Home</title>
    <link rel="stylesheet" href="src/css/Main.css">
    <link rel="stylesheet" href="src/css/Home.css">
    <div id="topAnchor">
        <ul class="nav">
            <img src="./images/logo.jpg" width="31.2" height="31.2" alt="...">
            <li><a href="index.php" style="color: black;background-color: gray">Home</a></li>
            <li><a href="src/Browser.php">Browser</a></li>
            <li><a href="src/Search.php">Search</a></li>
        </ul>
    </div>
    <div class="dropdown">
        <button class="dropButton" id="dropButton" ><a href="src/Login.php">  Log in </a></button>
        <?php
            session_start();
            if(!empty($_SESSION['user']) && isset($_SESSION['user'])){
                $user = $_SESSION['user'];
                echo '<div class="dropdown-content">
            <a href="src/Upload.php"><img src="images/Upload.jpg" width="30" height="30" alt="...">Upload</a>
            <a href="src/My_Photo.php?user=$user"><img src="images/My_Photo.png" width="30" height="30" alt="...">My Photo</a>
            <a href="src/My_Favourite.php"><img src="images/Favor.jpg" width="30" height="30" alt="...">My Favourite</a>
            <a href="src/Login.php?id=logout"><img src="images/Log_in.png" width="30" height="30" alt="..." id="log_out">Log out</a>
        </div>';
                echo '<script type="text/javascript">document.getElementById("dropButton").innerText = "My Account ▼";</script>';
            }
        ?>

    </div>
</head>
<body>
<form method="post" action="php/refresh.php">
<div>
    <figure>
        <img src="images/first_image.jpg" class="first_image" alt="" width="1200" height="800">
    </figure>
</div>
<div>
    <h1>图片精选</h1>
</div>
<div class="gallery">
<?php
error_reporting(0);
header("content-type:text/html;charset = utf8");
$serverName = "localhost";
$db_username = "root";
$db_password = "";
$db_name = "travel";
$connect = new mysqli($serverName,$db_username,$db_password,$db_name);
$sql1 = "SELECT ImageID FROM travelimagefavor";
$query1 = mysqli_query($connect,$sql1);
if(empty($_SESSION['refresh'])){
    for ($i=0;$i<6;$i++){
        $sql3="SELECT PATH AS PATH, COUNT(*) AS COUNTS FROM favoredImage GROUP BY PATH ORDER BY COUNT(*) DESC limit $i,1";
        $query3=mysqli_query($connect,$sql3);
        $row3=mysqli_fetch_assoc($query3);
        $r=$row3['PATH'];

        $sql4="SELECT * FROM travelimage WHERE PATH='$r'";
        $query4=mysqli_query($connect,$sql4);
        $row4=mysqli_fetch_assoc($query4);

        $path = "images/".$row4["PATH"];
        $title = $row4["Title"];
        $description = $row4["Description"];
        $_SESSION['src'] = $row4["PATH"];
        $content = $row4["Content"];
        $path1 = $row4["PATH"];
        echo '<figure><a href="src/Details.php?src='.$path.'&title='.$title.'&des='.$description.'&content='.$content.'&path='.$path1.'"><img src="'.$path.'"  width="190" height="190" class="image"></a><h3>'.$title.'</h3><p>'.$description.'</p></figure>';
    }


}
else {
    for ($i = 0; $i < 6; $i++) {
        $sql2 = "SELECT Title, Description, PATH, Content FROM travelimage ORDER BY RAND() limit 1";
        $query2 = mysqli_query($connect, $sql2);
        $result = mysqli_fetch_assoc($query2);
        $path2 = "images/" . $result["PATH"];
        $title2 = $result["Title"];
        $description2 = $result["Description"];
        $content2 = $result["Content"];
        $path3 = $result["PATH"];
        echo '<figure><a href="src/Details.php?src=' . $path2 . '&title=' . $title2 . '&des=' . $description2 . '&content=' . $content2 . '&path=' . $path3 . '"><img src="' . $path2 . '"  width="190" height="190" class="image"></a><h3>' . $title2 . '</h3><p>' . $description2 . '</p></figure>';


    }
}

?>

</div>
<div style="position: fixed;bottom: 120px;right: 0;">
    <button style="width: 90px;height: 90px;color: white;border: none" type="submit" id="submit" value="submit" name="submit"><img src="images/Reload.jpeg" alt="Reload" width="80px" height="80px" class="reload"></button>
</div>
<div style="position: fixed;bottom: 20px;right: 0;">
    <img src="images/To_top.jpg" alt="To top" width="80px" height="80px" onclick="location.href='#topAnchor'" class="reload">
</div>

<footer>
    <p>@肥仔阿亮</p>
    <p>Email:19302010061@fudan.edu.cn</p>
    <p>Tel:15901984704</p>
</footer>
</form>
</body>
</html>