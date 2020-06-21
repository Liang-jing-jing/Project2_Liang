<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Browser</title>
    <link rel="stylesheet" href="css/Main.css">
    <link rel="stylesheet" href="css/Browser.css">

</head>
<body>
<form action="../php/browser.php" method="post">
<div style="top: 0">
    <div style="top: 0">
        <ul class="nav">
            <img src="../images/logo.jpg" width="31.2" height="31.2" alt="...">
            <li><a href="../index.php">Home</a></li>
            <li><a href="Browser.php" style="color: black;background-color: gray">Browser</a></li>
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
</div>
    <div class="sidebar" >
        <br>

        <p>
            <br>
            <label>
                <input placeholder="Search by title" name="search1">
            </label>
            <button type="submit"><img src="../images/search.png" onclick="alert('已搜索')" style="width: 30px;height:30px" alt="..."></button>
        </p>

        <table style="margin-top: 20px; ">
            <thead>
            <tr style="border-top-left-radius: 5px;border-top-right-radius: 5px;">
                <th><a>Hot Country</a></th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td><a href="../php/browser.php?id='Italy'&ISO=IT" type="submit">Italy</a></td>
            </tr>
            <tr>
                <td><a href="../php/browser.php?id='Canada'&ISO=CA" type="submit">Canada</a></td>
            </tr>

            <tr>
                <td><a href="../php/browser.php?id='United Kingdom'&ISO=GB" type="submit">United Kingdom</a></td>
            </tr>
            <tr style="border-bottom-left-radius: 5px;border-bottom-right-radius: 5px;">
                <td><a href="../php/browser.php?id='Germany'&ISO=DE" type="submit"> Germany</a></td>
            </tr>
            </tbody>

        </table>
        <table style="margin-top: 20px; ">
            <thead>
            <tr style="border-top-left-radius: 5px;border-top-right-radius: 5px;">
                <th>Hot City</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td><a href="../php/browser.php?cityCode=3176959">    Firenze   </a></td>
            </tr>
            <tr>
                <td><a href="../php/browser.php?cityCode=3169070">    Roma   </a></td>
            </tr>
            <tr>
                <td><a href="../php/browser.php?cityCode=2643743">    London    </a></td>
            </tr>
            <tr style="border-bottom-left-radius: 5px;border-bottom-right-radius: 5px;">
                <td><a href="../php/browser.php?cityCode=2950159">    Berlin    </a></td>
            </tr>
            </tbody>

        </table>
        <table style="margin-top: 20px; ">
            <thead>
            <tr style="border-top-left-radius: 5px;border-top-right-radius: 5px;">
                <th>Hot Content</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td><a href="../php/browser.php?content=scenery">    Scenery    </a></td>
            </tr>

            </tbody>

        </table>

    </div>
<br>
    <div style="width: 70%;float: none" class="main">
        <div class="filter">
            <p>Filter</p>
            <label for="first"></label>
            <select id="first" onChange="change()" name="country">
                <option selected="selected">Filter:Country</option>
                <option>China</option>
                <option>Japan</option>
                <option>Italy</option>
                <option>America</option>
            </select>

            <label for="second" ></label>
            <select id="second" name="city">
                <option selected>Filter:City</option>
            </select>
            <label></label>
            <select name="subject">
                <option selected>Filter:Subject</option>
                <option>Scenery</option>
                <option>Buildings</option>
                <option>Wonder</option>
            </select>
            <button onclick="alert('已更新')" type="submit">Filter</button>

            <script>
                function change()
                {
                    const x = document.getElementById("first");
                    const y = document.getElementById("second");
                    y.options.length = 0; // 清除second下拉框的所有内容
                    if(x.selectedIndex === 0)
                    {
                        y.options.add(new Option("Filter:City", "0"));
                    }
                    if(x.selectedIndex === 1)
                    {
                        y.options.add(new Option("Shanghai", "0"));
                        y.options.add(new Option("Kunming", "1"));
                        y.options.add(new Option("Beijing", "2"));
                        y.options.add(new Option("Yantai", "3"));
                    }

                    if(x.selectedIndex === 2)
                    {
                        y.options.add(new Option("Tokyo", "0"));
                        y.options.add(new Option("Osaka", "1"));
                        y.options.add(new Option("Kamakura", "2"));
                    }
                    if(x.selectedIndex === 3)
                    {
                        y.options.add(new Option("Roman", "0"));
                        y.options.add(new Option("Milan", "1"));
                        y.options.add(new Option("Firenze", "2"));
                        y.options.add(new Option("Florance", "3"));
                    }
                    if(x.selectedIndex === 4)
                    {
                        y.options.add(new Option("New York", "0"));
                        y.options.add(new Option("San Francisco", "1"));
                        y.options.add(new Option("Washington", "2"));
                    }

                }
            </script>
        </div>

            <?php
            error_reporting(0);
            echo "<div class=\"gallery\">";
            $serverName = "localhost";
            $db_username = "root";
            $db_password = "";
            $db_name = "travel";
            $conn = new mysqli($serverName,$db_username,$db_password,$db_name);
            error_reporting(0);
            if(isset($_SESSION['title1'])){
                $thing = $_SESSION['title1'];
                $search = 'Title';
                $sql = "SELECT * FROM travelimage WHERE ".$search." LIKE '%".$thing."%'";
                $query = mysqli_query($conn,$sql);
                $value = mysqli_num_rows($query);
            }elseif(isset($_SESSION['country1'])&&isset($_SESSION['city1'])&&isset($_SESSION['subject1'])){
                $country = $_SESSION['country1'];
                $city = $_SESSION['city1'];
                $subject = $_SESSION['subject1'];
                $sql_ISO = "SELECT * FROM geocountries WHERE CountryName = '$country'";
                $query_ISO = mysqli_query($conn,$sql_ISO);
                $row_ISO = mysqli_fetch_assoc($query_ISO);
                $ISO = $row_ISO['ISO'];
                $sql_cityCode = "SELECT * FROM geocities WHERE AsciiName = '$city'";
                $query_city = mysqli_query($conn,$sql_cityCode);
                $row_cityCode = mysqli_fetch_assoc($query_city);
                $cityCode = $row_cityCode['GeoNameID'];
                $sql = "SELECT * FROM travelimage WHERE (CityCode = '$cityCode') AND (CountryCodeISO = '$ISO') AND (Content = '$subject')";
                $query = mysqli_query($conn,$sql);
                $value = mysqli_num_rows($query);
            }elseif (isset($_SESSION['ISO1'])){
                $ISO = $_SESSION['ISO1'];

                $sql = "SELECT * FROM travelimage WHERE (CountryCodeISO = '$ISO')";
                $query = mysqli_query($conn,$sql);
                $value = mysqli_num_rows($query);

            }elseif (isset($_SESSION['cityCode1'])){
                $cityCode = $_SESSION['cityCode1'];
                $sql = "SELECT * FROM travelimage WHERE (CityCode = '$cityCode')";
                $query = mysqli_query($conn,$sql);
                $value = mysqli_num_rows($query);

            }elseif(isset($_SESSION['content'])){
                $content = 'scenery';
                $sql = "SELECT * FROM travelimage WHERE (Content = '$content')";
                $query = mysqli_query($conn,$sql);
                $value = mysqli_num_rows($query);
            }
            if($value==0){
                echo "<p style='text-align: center'>Please search properly to get the result.</p>";
            }
            if($value <= 12){
                $all=1;
            }elseif ($value<=24&&$value>12){
                $all=2;
            }
            elseif ($value<=36&&$value>24){
                $all=3;
            }
            elseif ($value<=48&&$value>36){
                $all=4;
            }
            elseif ($value>48){
                $all=5;
            }
            if(!isset($_GET['page'])){
                $_GET['page'] = 1;
            }
            if($_GET['page'] == 1){
                $l = 1;
                if($value <= 12){
                    $m = $value;
                }else{
                    $m = 12;
                }
            }elseif ($_GET['page'] == 2){
                $l = 13;
                if ($value <= 24){
                    if ($value>12){
                        $m = $value - 12;
                    }else{
                        $m = 0;
                        echo "<p style='text-align: center'>There is no photo on this page.</p>";
                    }
                }else{
                    $m = 12;
                }
            }elseif ($_GET['page'] == 3){
                $l = 25;
                if ($value <= 36){
                    if ($value>24){
                        $m = $value - 24;
                    }else{
                        $m = 0;
                        echo "<p style='text-align: center'>There is no photo on this page.</p>";
                    }
                }else{
                    $m = 12;
                }
            }elseif ($_GET['page'] == 4){
                $l = 37;
                if ($value <= 48){
                    if ($value>36){
                        $m = $value - 36;
                    }else{
                        $m = 0;
                        echo "<p style='text-align: center'>There is no photo on this page.</p>";
                    }
                }else{
                    $m = 12;
                }
            }else{
                $l = 49;
                if ($value <= 60){
                    if ($value>48){
                        $m = $value - 48;
                    }else{
                        $m = 0;
                        echo "<p style='text-align: center'>There is no photo on this page.</p>";
                    }
                }else{
                    $m = 12;
                }
            }
            if(isset($_SESSION['title1'])){
                for ($i=0;$i<$m;$i++) {
                    $j = $i + $l - 1;
                    $sql0 = "SELECT * FROM travelimage WHERE " . $search . " LIKE '%" . $thing . "%' limit $j,1";
                    $query0 = mysqli_query($conn, $sql0);
                    $row0 = mysqli_fetch_assoc($query0);
                    $path = $row0['PATH'];
                    $src = '../images/' . $path;
                    $sql1 = "SELECT * FROM travelimage WHERE PATH = '$path'";
                    $query1 = mysqli_query($conn, $sql1);
                    $row1 = mysqli_fetch_assoc($query1);
                    $t = $row1['Title'];
                    $des = $row1['Description'];
                    $content = $row1['Content'];
                    echo "<figure>
                    <a href=\"Details.php?src=$path&title=$t&des=$des&path=$path&content=$content\"><img src=".$src." width=\"280\" height=\"280\"></a>
                    </figure>";
                }
            }elseif (isset($_SESSION['country1'])&&isset($_SESSION['city1'])&&isset($_SESSION['subject1'])){
                for ($i=0;$i<$m;$i++){
                    $j = $i + $l - 1;
                    $sql0 = "SELECT * FROM travelimage WHERE (CityCode = '$cityCode') AND (CountryCodeISO = '$ISO') AND (Content = '$subject') limit $j,1";
                    $query0 = mysqli_query($conn, $sql0);
                    $row0 = mysqli_fetch_assoc($query0);
                    $path = $row0['PATH'];
                    $src = '../images/' . $path;
                    $sql1 = "SELECT * FROM travelimage WHERE PATH = '$path'";
                    $query1 = mysqli_query($conn, $sql1);
                    $row1 = mysqli_fetch_assoc($query1);
                    $t = $row1['Title'];
                    $des = $row1['Description'];
                    $content = $row1['Content'];
                    echo "<figure>
                    <a href=\"Details.php?src=$path&title=$t&des=$des&path=$path&content=$content\"><img src=".$src." width=\"280\" height=\"280\"></a>
                    </figure>";
                }
            }elseif (isset($_SESSION['ISO1'])){
                $ISO = $_SESSION['ISO1'];
                for ($i=0;$i<$m;$i++){
                    $j = $i + $l - 1;
                    $sql0 = "SELECT * FROM travelimage WHERE (CountryCodeISO = '$ISO') limit $j,1";
                    $query0 = mysqli_query($conn, $sql0);
                    $row0 = mysqli_fetch_assoc($query0);
                    $path = $row0['PATH'];
                    $src = '../images/' . $path;
                    $sql1 = "SELECT * FROM travelimage WHERE PATH = '$path'";
                    $query1 = mysqli_query($conn, $sql1);
                    $row1 = mysqli_fetch_assoc($query1);
                    $t = $row1['Title'];
                    $des = $row1['Description'];
                    $content = $row1['Content'];
                    echo "<figure>
                    <a href=\"Details.php?src=$path&title=$t&des=$des&path=$path&content=$content\"><img src=".$src." width=\"280\" height=\"280\"></a>
                    </figure>";
                }
            }elseif (isset($_SESSION['cityCode1'])){
                $cityCode = $_SESSION['cityCode1'];
                for ($i=0;$i<$m;$i++){
                    $j = $i + $l - 1;
                    $sql0 = "SELECT * FROM travelimage WHERE (CityCode = '$cityCode') limit $j,1";
                    $query0 = mysqli_query($conn, $sql0);
                    $row0 = mysqli_fetch_assoc($query0);
                    $path = $row0['PATH'];
                    $src = '../images/' . $path;
                    $sql1 = "SELECT * FROM travelimage WHERE PATH = '$path'";
                    $query1 = mysqli_query($conn, $sql1);
                    $row1 = mysqli_fetch_assoc($query1);
                    $t = $row1['Title'];
                    $des = $row1['Description'];
                    $content = $row1['Content'];
                    echo "<figure>
                    <a href=\"Details.php?src=$path&title=$t&des=$des&path=$path&content=$content\"><img src=".$src." width=\"280\" height=\"280\"></a>
                    </figure>";
                }
            }elseif (isset($_SESSION['content'])){
                $content=$_SESSION['content'];
                for ($i=0;$i<$m;$i++){
                    $j = $i + $l - 1;
                    $sql0 = "SELECT * FROM travelimage WHERE (Content = 'scenery') limit $j,1";
                    $query0 = mysqli_query($conn, $sql0);
                    $row0 = mysqli_fetch_assoc($query0);
                    $path = $row0['PATH'];
                    $src = '../images/' . $path;
                    $sql1 = "SELECT * FROM travelimage WHERE PATH = '$path'";
                    $query1 = mysqli_query($conn, $sql1);
                    $row1 = mysqli_fetch_assoc($query1);
                    $t = $row1['Title'];
                    $des = $row1['Description'];
                    $content = $row1['Content'];
                    echo "<figure>
                    <a href=\"Details.php?src=$path&title=$t&des=$des&path=$path&content=$content\"><img src=".$src." width=\"280\" height=\"280\"></a>
                    </figure>";
                }
            }
            echo "</div>";




            echo "<div style=\"margin-left: 40%; background-color: white\">";
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
<a href="?page=2" class="page">2</a> 
<a href="?page=3" class="on">3</a>
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
            echo "</div>";
            ?>
    </div>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>

    <footer style="width: 100%">
        <p>@肥仔阿亮</p>
        <p>Email:19302010061@fudan.edu.cn</p>
        <p>Tel:15901984704</p>
    </footer>
</form>
</body>
</html>