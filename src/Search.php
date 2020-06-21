<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Search</title>
    <link rel="stylesheet" href="css/Main.css">
    <link rel="stylesheet" href="css/Search.css">
    <div>
        <ul class="nav">
            <img src="../images/logo.jpg" width="31.2" height="31.2" alt="...">
            <li><a href="../index.php">Home</a></li>
            <li><a href="Browser.php">Browser</a></li>
            <li><a href="Search.php" style="color: black;background-color: gray">Search</a></li>
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
<form action="../php/search.php" method="post">
    <br>
    <div class="search">
        <h2 style="border-top-left-radius: 5px;border-top-right-radius: 5px">Search</h2>
        <div class="filter">
            <label>
                <input type="radio" value="1" name="1" checked>
            </label>Filter by title<br>
            <label>
                <input type="text" class="text" name="title">
            </label><br>
            <label>
                <input type="radio" value="2" name="1">
            </label>Filter by Description<br>
            <label>
                <input type="text" class="text" name="description">
            </label><br>
            <button onclick="alert('已搜索')" type="submit">Filter</button>

        </div>
    </div>

    <div class="result" style="border-top: none">
        <h2 style="border-bottom: 1px solid gray;border-top-left-radius: 5px;border-top-right-radius: 5px;background-color: darkgrey">Result</h2>

<?php
error_reporting(0);
$serverName = "localhost";
$db_username = "root";
$db_password = "";
$db_name = "travel";
$conn = new mysqli($serverName,$db_username,$db_password,$db_name);
if(isset($_SESSION['Wrong'])){
    echo "<p style='text-align: center'>Please choose only one way to search.</p>";
}
if(isset($_SESSION['title2'])){
    $thing = $_SESSION['title2'];
    $search = 'Title';
}elseif (isset($_SESSION['description2'])){
    $search = "Description";
    $thing = $_SESSION['description2'];
}
$sql = "SELECT * FROM travelimage WHERE ".$search." LIKE '%".$thing."%'";
$query = mysqli_query($conn,$sql);
$value = mysqli_num_rows($query);
if($value==0){
    echo "<p style='text-align: center'>There is no result.</p>";
}
if($value<=4){
    $all=1;
}
elseif ($value<=8&&$value>4){
    $all=2;
}
elseif ($value<=12&&$value>8){
    $all=3;
}
elseif ($value<=16&&$value>12){
    $all=4;
}
elseif ($value>16){
    $all=5;
}
if(!isset($_GET['page'])){
    $_GET['page'] = 1;
}
if($_GET['page'] == 1){
    $l = 1;
    if($value <= 4){
        $m = $value;
    }else{
        $m = 4;
    }
}elseif ($_GET['page'] == 2){
    $l = 5;
    if ($value <= 8){
        if ($value>4){
            $m = $value - 4;
        }else{
            $m = 0;
            echo "<p style='text-align: center'>There is no photo on this page.</p>";
        }
    }else{
        $m = 4;
    }
}elseif ($_GET['page'] == 3){
    $l = 9;
    if ($value <= 12){
        if ($value>8){
            $m = $value - 8;
        }else{
            $m = 0;
            echo "<p style='text-align: center'>There is no photo on this page.</p>";
        }
    }else{
        $m = 4;
    }
}elseif ($_GET['page'] == 4){
    $l = 13;
    if ($value <= 16){
        if ($value>12){
            $m = $value - 12;
        }else{
            $m = 0;
            echo "<p style='text-align: center'>There is no photo on this page.</p>";
        }
    }else{
        $m = 4;
    }
}else{
    $l = 17;
    if ($value <= 20){
        if ($value>16){
            $m = $value - 16;
        }else{
            $m = 0;
            echo "<p style='text-align: center'>There is no photo on this page.</p>";
        }
    }else{
        $m = 4;
    }
}

for ($i=0;$i<$m;$i++){
    $j = $i + $l - 1;
    $sql0 = "SELECT * FROM travelimage WHERE ".$search." LIKE '%".$thing."%' limit $j,1";
    $query0 = mysqli_query($conn,$sql0);
    $row0 = mysqli_fetch_assoc($query0);
    $path = $row0['PATH'];
    $src = '../images/'.$path;
    $sql1 = "SELECT * FROM travelimage WHERE PATH = '$path'";
    $query1 = mysqli_query($conn,$sql1);
    $row1 = mysqli_fetch_assoc($query1);
    $t = $row1['Title'];
    $des = $row1['Description'];
    $content = $row1['Content'];
    echo " <div  class=\"information\" style=\"border-bottom: none\">
 <figure><a href=\"Details.php?src=$path&title=$t&des=$des&path=$path&content=$content\"><img src=".$src." style=\"float: left\" width=\"96\" height=\"96\" alt=\"photo\" ></a></figure>
 <figcaption style='margin-bottom: 60px'><h3>$t</h3>
<p style='text-align: left'>$des</p>
</figcaption>
</div>";

}
?>

    </div>
    <div style="margin-left: 40%; background-color: white">

        <?php
        error_reporting(0);
        if($all==1){
            if(!isset($_GET['page'])){
                $_GET['page'] = 1;
            }
            if ($_GET['page'] == 1){
                echo '<a href="?page=1" class="page"><<</a>
<a href="?page=1" class = "on">1</a>
<a href="?page=1" class="page">>></a>';
            }
        }elseif ($all==2){
            if(!isset($_GET['page'])){
                $_GET['page'] = 1;
            }
            if ($_GET['page'] == 1){
                echo '<a href="?page=1" class="page"><<</a>
<a href="?page=1" class = "on">1</a>
<a href="?page=2" class="page">2</a> 
<a href="?page=2" class="page">>></a>';
            }elseif ($_GET['page']==2){
                echo '<a href="?page=1" class="page"><<</a>
<a href="?page=1" class = "page">1</a>
<a href="?page=2" class="on">2</a> 
<a href="?page=2" class="page">>></a>';
            }
        }elseif ($all==3){
            if(!isset($_GET['page'])){
                $_GET['page'] = 1;
            }
            if ($_GET['page'] == 1){
                echo '<a href="?page=1" class="page"><<</a>
<a href="?page=1" class = "on">1</a>
<a href="?page=2" class="page">2</a> 
<a href="?page=3" class="page">3</a>
<a href="?page=2" class="page">>></a>';
            }elseif ($_GET['page']==2){
                echo '<a href="?page=1" class="page"><<</a>
<a href="?page=1" class = "page">1</a>
<a href="?page=2" class="on">2</a> 
<a href="?page=3" class="page">3</a>
<a href="?page=3" class="page">>></a>';
            }elseif ($_GET['page']==3){
                echo '<a href="?page=2" class="page"><<</a>
<a href="?page=1" class = "page">1</a>
<a href="?page=2" class="on">2</a> 
<a href="?page=3" class="page">3</a>
<a href="?page=3" class="page">>></a>';
            }
        }elseif ($all==4){
            if(!isset($_GET['page'])){
                $_GET['page'] = 1;
            }
            if ($_GET['page'] == 1){
                echo '<a href="?page=1" class="page"><<</a>
<a href="?page=1" class = "on">1</a>
<a href="?page=2" class="page">2</a> 
<a href="?page=3" class="page">3</a>
<a href="?page=4" class="page">4</a>
<a href="?page=2" class="page">>></a>';
            }elseif ($_GET['page']==2){
                echo '<a href="?page=1" class="page"><<</a>
<a href="?page=1" class = "page">1</a>
<a href="?page=2" class="on">2</a> 
<a href="?page=3" class="page">3</a>
<a href="?page=4" class="page">4</a>
<a href="?page=3" class="page">>></a>';
            }elseif ($_GET['page']==3){
                echo '<a href="?page=2" class="page"><<</a>
<a href="?page=1" class = "page">1</a>
<a href="?page=2" class="page">2</a> 
<a href="?page=3" class="on">3</a>
<a href="?page=4" class="page">4</a>
<a href="?page=4" class="page">>></a>';
            }elseif ($_GET['page']==4){
                echo '<a href="?page=3" class="page"><<</a>
<a href="?page=1" class = "page">1</a>
<a href="?page=2" class="page">2</a> 
<a href="?page=3" class="page">3</a>
<a href="?page=4" class="on">4</a>
<a href="?page=4" class="page">>></a>';
            }
        }elseif ($all==5){
            if(!isset($_GET['page'])){
                $_GET['page'] = 1;
            }
            if ($_GET['page'] == 1){
                echo '<a href="?page=1" class="page"><<</a>
<a href="?page=1" class = "on">1</a>
<a href="?page=2" class="page">2</a> 
<a href="?page=3" class="page">3</a>
<a href="?page=4" class="page">4</a>
<a href="?page=5" class="page">5</a>
<a href="?page=2" class="page">>></a>';
            }elseif ($_GET['page'] == 2){
                echo '<a href="?page=1" class="page"><<</a>
<a href="?page=1" class = "page">1</a>
<a href="?page=2" class="on">2</a> 
<a href="?page=3" class="page">3</a>
<a href="?page=4" class="page">4</a>
<a href="?page=5" class="page">5</a>
<a href="?page=3" class="page">>></a>';
            }elseif ($_GET['page'] == 3){
                echo '<a href="?page=2" class="page"><<</a>
<a href="?page=1" class = "page">1</a>
<a href="?page=2" class="page">2</a> 
<a href="?page=3" class="on">3</a>
<a href="?page=4" class="page">4</a>
<a href="?page=5" class="page">5</a>
<a href="?page=4" class="page">>></a>';
            }elseif ($_GET['page'] == 4){
                echo '<a href="?page=3" class="page"><<</a>
<a href="?page=1" class = "page">1</a>
<a href="?page=2" class="page">2</a> 
<a href="?page=3" class="page">3</a>
<a href="?page=4" class="on">4</a>
<a href="?page=5" class="page">5</a>
<a href="?page=5" class="page">>></a>';
            }else{
                echo '<a href="?page=4" class="page"><<</a>
<a href="?page=1" class = "page">1</a>
<a href="?page=2" class="page">2</a> 
<a href="?page=3" class="page">3</a>
<a href="?page=4" class="page">4</a>
<a href="?page=5" class="on">5</a>
<a href="?page=5" class="page">>></a>';
            }
        }
        ?>
    </div>
</form>
    <footer>
        <p>@肥仔阿亮</p>
        <p>Email:19302010061@fudan.edu.cn</p>
        <p>Tel:15901984704</p>
    </footer>
</body>
</html>