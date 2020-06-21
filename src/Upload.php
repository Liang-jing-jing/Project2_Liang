<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Upload</title>
    <link rel="stylesheet" href="css/Main.css">
    <link rel="stylesheet" href="css/Upload.css">
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
<form method="post" action="../upload.php" enctype="multipart/form-data">
<br>
<br>
    <h1>Upload</h1>
    <div style="border: 1px solid black;margin:10px 300px;">
        <?php
            error_reporting(0);
            $path=$_GET['path'];
            if($_GET['id']=='my_photo') {
                echo '<label><span class="label">Path:</span><textarea style="resize: none;width:150px;height:18px;" id="file" name="file" required>'.$path.'</textarea></label><br>';
            }else{
                echo '<label style="position: relative;left: 20px"><span class="label">请选取一个图像文件:</span> <input type="file" id="file" name="file" accept="image/*" onchange="readFile(this.files[0])" required/></label>';
            }
        ?>



        <div id="preview" style="margin-left: 530px"></div>
    <?php
    error_reporting(0);
    if($_GET['id']=='my_photo'){
        $path=$_GET['path'];
        $src='../upload/'.$path;
        echo '<img src="'.$src.'" width=150 height=110 style="margin-left: 530px;margin-top:0">';
    }
    ?>

    <label><span class="label">Title:</span>

        <?php
        error_reporting(0);
            if($_GET['id']=='my_photo'){
                $t=$_GET['title'];
                echo '<textarea style="resize: none;width:150px;height:18px;" name="title" required>'.$t.'</textarea>';
            }else{
                echo '<input type="text" name="title" required>';
            }
        ?>
        </label><br>
    <label><span class="label">Description:</span>

        <?php
        error_reporting(0);
        if($_GET['id']=='my_photo'){
            $des = $_GET['des'];
            echo '<textarea style="resize: none;width:150px;height:18px;" name="des" required>'.$des.'</textarea>';
        }else{
            echo '<input type="text" name="des" required>';
        }
        ?>
        </label><br>
    <label>
        <label for="first"></label>
        <select id="first" onChange="change()" name="country">

            <?php
            error_reporting(0);
            if($_GET['id']=='my_photo'){
                $arr = array("China","India","Indonesia","America");
                for($i=0;$i<4;$i++){
                    if($arr[$i]==$_GET['country']){
                        echo'<option selected="selected">'.$arr[$i].'</option>';
                    }
                    else{
                        echo '<option>'.$arr[$i].'</option>';
                    }
                }

            }else{
                echo ' 
            <option selected="selected">China</option>
            <option>India</option>
            <option>Indonesia</option>
            <option>America</option>';
            }

            ?>
        </select>
        <label></label>
        </label><br>
    <label>
        <label></label>
        <label for="second"></label>
        <select id="second" onchange="change()" name="city">
<!--            <option selected>Shanghai</option>-->
<!--            <option>Chongqing</option>-->
<!--            <option>Beijing</option>-->
<!--            <option>Chengdu</option>-->
            <?php
            error_reporting(0);
                $city = $_GET['city'];
                if($_GET['id']=='my_photo'){
                    if ($_GET['country']=='China'){
                        $arr_city = array("Shanghai","Chongqing","Beijing","Chengdu");
                        for($i=0;$i<4;$i++){
                            if($arr_city[$i]==$_GET['city']){
                                echo '<option selected>'.$arr_city[$i].'</option>';
                            }else{
                                echo '<option>'.$arr_city[$i].'</option>';
                            }
                        }
                    }elseif ($_GET['country']=='India'){
                        $arr_city = array("Bombay","Delhi","Bangalore");
                        for($i=0;$i<3;$i++){
                            if($arr_city[$i]==$_GET['city']){
                                echo '<option selected>'.$arr_city[$i].'</option>';
                            }else{
                                echo '<option>'.$arr_city[$i].'</option>';
                            }
                        }
                    }elseif ($_GET['country']=='Indonesia'){
                        $arr_city = array("Roman","Venice","Milan","Florence");
                        for($i=0;$i<4;$i++){
                            if($arr_city[$i]==$_GET['city']){
                                echo '<option selected>'.$arr_city[$i].'</option>';
                            }else{
                                echo '<option>'.$arr_city[$i].'</option>';
                            }
                        }
                    }else{
                        $arr_city = array("New York","San Francisco","Washington");
                        for($i=0;$i<3;$i++){
                            if($arr_city[$i]==$_GET['city']){
                                echo '<option selected>'.$arr_city[$i].'</option>';
                            }else{
                                echo '<option>'.$arr_city[$i].'</option>';
                            }
                        }
                    }


                }else{
                    echo "<option selected>Shanghai</option>
            <option>Chongqing</option>
            <option>Beijing</option>
            <option>Chengdu</option>";
                }
            ?>
        </select>
        </label><br>

    <label>
        <select name="subject">

            <?php
            error_reporting(0);
                if($_GET['id']=='my_photo'){
                    $arr_subject = array("Scenery","City","People","Animals","Buildings","Wonder","Other");
                    for($i=0;$i<7;$i++){
                        if($arr_subject[$i]==$_GET['content']){
                            echo '<option selected>'.$arr_subject[$i].'</option>';
                        }else{
                            echo '<option>'.$arr_subject[$i].'</option>';
                        }
                    }
                }else{
                    echo '
            <option selected>Scenery</option>
            <option>City</option>
            <option>People</option>
            <option>Animals</option>
            <option>Buildings</option>
            <option >Wonder</option>
            <option>Other</option>';
                }
            ?>
        </select>
    </label>


        <?php
        error_reporting(0);
            if($_GET['id']=='my_photo'){
                echo '<input type="submit" value="Modify" name="continue" class="submit"><br>';
            }else{
                echo '<input type="submit" value="Upload" name="continue" class="submit"><br>';
            }
        ?>
</div>
</form>
    <footer id="footer" style="bottom: 0">
        <p>@肥仔阿亮</p>
        <p>Email:19302010061@fudan.edu.cn</p>
        <p>Tel:15901984704</p>
    </footer>
</body>
</html>
<script>
    function change()
    {
        const x = document.getElementById("first");
        const y = document.getElementById("second");
        y.options.length = 0; // 清除second下拉框的所有内容

        if(x.selectedIndex === 0)
        {
            y.options.add(new Option("Shanghai", "Shanghai",false,true));
            y.options.add(new Option("Chongqing", "Chongqing"));
            y.options.add(new Option("Beijing", "Beijing"));
            y.options.add(new Option("Chengdu", "Chengdu"));
        }

        if(x.selectedIndex === 1)
        {
            y.options.add(new Option("Bombay", "Bombay",false,true));
            y.options.add(new Option("Delhi", "Delhi"));
            y.options.add(new Option("Bangalore", "Bangalore"));
        }
        if(x.selectedIndex === 2)
        {
            y.options.add(new Option("Bandung", "Bandung",false,true));
            y.options.add(new Option("Jakarta", "Jakarta"));
            y.options.add(new Option("Yogyakarta", "Yogyakarta"));
            y.options.add(new Option("Medan", "Medan"));
        }
        if(x.selectedIndex === 3)
        {
            y.options.add(new Option("New York", "New York",false,true));
            y.options.add(new Option("San Francisco", "San Francisco"));
            y.options.add(new Option("Washington", "Washington"));
        }

    }
</script>
<script type="text/javascript">
    file=[];
    function readFile(f){
        var reader = new FileReader();
        if (file.length===0){
            reader.readAsDataURL(f);
            reader.onload = function(){
                var preview = document.querySelector('#preview');
                var img = document.createElement("img");
                img.src = reader.result;
                img.width=150;
                img.height=110;
                preview.appendChild(img);
                file[0]=reader.result;

            };
            reader.onerror = function(e){
                console.log("Error"+e);
            }
        }else {
            document.getElementsByTagName("img")[0].remove();
            reader.readAsDataURL(f);
            reader.onload = function(){
                var preview = document.querySelector('#preview');
                var img = document.createElement("img");
                file[0]=reader.result;
                img.src = file[0];
                img.width=550;
                img.height=400;
                preview.appendChild(img);

            };
            reader.onerror = function(e){
                console.log("Error"+e);
            }
        }

    }
    function read(f) {
        var reader = new FileReader();
        if (file.length===0){
            reader.readAsDataURL(f);
            reader.onload = function(){
                var preview = document.querySelector('#preview');
                var img = document.createElement("img");
                img.src = reader.result;
                img.width=150;
                img.height=110;
                preview.appendChild(img);

            };
            reader.onerror = function(e){
                console.log("Error"+e);
            }
        }else {
            document.getElementsByTagName("img")[0].remove();
            reader.readAsDataURL(f);
            reader.onload = function(){
                var preview = document.querySelector('#preview');
                var img = document.createElement("img");
                file[0]=reader.result;
                img.src = file[0];
                img.width=550;
                img.height=400;
                preview.appendChild(img);

            };
            reader.onerror = function(e){
                console.log("Error"+e);
            }
        }
    }
</script>