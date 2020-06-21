<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Details</title>
    <link rel="stylesheet" href="css/Main.css">
    <link rel="stylesheet" href="css/Details.css">
    <div id="topAnchor">
        <ul class="nav">
            <img src="../images/logo.jpg" width="31.2" height="31.2" alt="...">
            <li><a href="../index.php">Home</a></li>
            <li><a href="Browser.php">Browser</a></li>
            <li><a href="Search.php">Search</a></li>
        </ul>
    </div>
    <div class="dropdown">
        <button class="dropButton" id="dropButton" ><a href="../src/Login.php">  Log in </a></button>
        <?php
        session_start();
        if(!empty($_SESSION['user']) && isset($_SESSION['user'])){
            echo '<div class="dropdown-content">
            <a href="Upload.php"><img src="../images/Upload.jpg" width="30" height="30" alt="...">Upload</a>
            <a href="My_Photo.php"><img src="../images/My_Photo.png" width="30" height="30" alt="...">My Photo</a>
            <a href="My_Favourite.php"><img src="../images/Favor.jpg" width="30" height="30" alt="...">My Favourite</a>
            <a href="Login.php"><img src="../images/Log_in.png" width="30" height="30" alt="..." id="log_out">Log out</a>
        </div>';
            echo '<script type="text/javascript">document.getElementById("dropButton").innerText = "My Account ▼";</script>';
        }
        ?>
    </div>

</head>
<body>
<form method="post" action="../php/favor.php">
    <div class="information">

        <?php
        error_reporting(0);
        header("content-type:text/html;charset = utf8");
        session_start();
        $serverName = "localhost";
        $db_username = "root";
        $db_password = "";
        $db_name = "travel";
        $connect = new mysqli($serverName,$db_username,$db_password,$db_name);
        $user = $_SESSION['user'];
        if($_GET['id']=='myPhoto'){
            $src = $_GET['src'];
            $path = $_GET['path'];
            $t = $_GET['title'];
            $des = $_GET['des'];
            $sub = $_GET['content'];
            $city = $_GET['city'];
            $country = $_GET['country'];
            echo "<br>";
            echo "<h1>Title:$t</h1>";
            echo "<figure style='float: left'><img src='$src' width='400' height='400'></figure>";
            echo "<div><p><h2>Details:</h2>$des</p><p><h2>Content:</h2>$sub</p><p><h2>Country:</h2>$country</p><p><h2>City:</h2>$city</p>";

        }else{
            $path = $_GET['src'];
            $path1 = $_GET['path'];
            $sql = "SELECT Title, Description, CityCode, CountryCodeISO, Content FROM travelimage WHERE (PATH= '$path1')";
            $query = mysqli_query($connect,$sql);
            $row = mysqli_fetch_assoc($query);
            $title = $_GET['title'];
            $description = $_GET['des'];
            $content = $_GET['content'];
            $ISO = $row["CountryCodeISO"];
            $sql1 = "SELECT CountryName FROM geocountries WHERE (ISO = '$ISO')";
            $query1 = mysqli_query($connect,$sql1);
            $row1 = mysqli_fetch_assoc($query1);
            $country = $row1["CountryName"];
            $cityISO = $row["CityCode"];
            $sql2 = "SELECT AsciiName FROM geocities WHERE (GeoNameID = '$cityISO')";
            $query2 = mysqli_query($connect,$sql2);
            $row2 = mysqli_fetch_assoc($query2);
            $city = $row2['AsciiName'];
            $Path = "../images/".$path1;
            $sql3="SELECT * FROM favoredImage WHERE (userName='$user') AND (PATH='$path1')";
            $query3=mysqli_query($connect,$sql3);
            $value = mysqli_num_rows($query3);

            $_SESSION['path']=$path1;
            $_SESSION['title']=$title;
            $_SESSION['description']=$description;
            $_SESSION['content']=$content;

            $favored_value=0;
            $sql4="SELECT * FROM favoredImage";
            $query4=mysqli_query($connect,$sql4);
            $v=mysqli_num_rows($query4);
            $row4=mysqli_fetch_assoc($query4);
            for ($i=0;$i<$v;$i++){
                $sql5="SELECT * FROM favoredImage limit $i,1 ";
                $query5=mysqli_query($connect,$sql5);
                $row5=mysqli_fetch_assoc($query5);
                if($row5['PATH']==$path1){
                    $favored_value+=1;
                }
            }

            echo "<br>";
            echo "<h1>Title:$title</h1>";
            echo "<figure style='float: left'><img src='$Path' width='400' height='400'></figure>";
            echo "<div><p><h2>Details:</h2>$description</p><p><h2>Content:</h2>$content</p><p><h2>Country:</h2>$country</p><p><h2>City:</h2>$city</p>
<button value=\"Favor\">Favored:$favored_value</button></div>";
            if($value==0){
                echo '<br><button  id="favored"  value="Favor" type="submit"><a href="../php/favor.php?path='.$path1.'&title='.$title.'&description='.$description.'$content='.$content.'&user='.$user.'">Favor</a></button>';
            }else{
                echo '<br><button  id="favored"  value="Favor"><a href="../php/favor.php?path='.$path1.'&title='.$title.'&description='.$description.'$content='.$content.'&user='.$user.'">Favored</a></button>';
            }
        }

        ?>


    </div>
</form>


    <footer id="footer">
        <p>@肥仔阿亮</p>
        <p>Email:19302010061@fudan.edu.cn</p>
        <p>Tel:15901984704</p>
    </footer>
</body>
</html>