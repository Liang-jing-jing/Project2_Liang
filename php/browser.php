<?php

session_start();
$serverName = "localhost";
$db_username = "root";
$db_password = "";
$db_name = "travel";
$conn = new mysqli($serverName,$db_username,$db_password,$db_name);

if($_POST["search1"]){
    $search1 = $_POST['search1'];
    $_SESSION['title1'] = $_POST["search1"];
    unset($_SESSION['country1']);
    unset($_SESSION['city1']);
    unset($_SESSION['subject1']);
    unset($_SESSION['cityCode1']);
    unset($_SESSION['ISO1']);
}
if($_POST['country']!=='Filter:Country'&&$_POST['city']!=='Filter:city'&&$_POST['subject']!=='Filter:Subject'){
    if($_POST['country'] == 'China'){
        if($_POST['city'] == 0){
            $city = 'Shanghai';
        }elseif ($_POST['city'] == 1){
            $city = 'Kunming';
        }elseif ($_POST['city'] == 2){
            $city = 'Beijing';
        }else{
            $city = 'Yantai';
        }
    }elseif ($_POST['country'] == 'Japan'){
        if($_POST['city'] == 0){
            $city = 'Tokyo';
        }elseif ($_POST['city'] == 1){
            $city = 'Osaka';
        }else{
            $city = 'Kamakura';
        }
    }elseif ($_POST['country'] == 'Italy'){
        if($_POST['city'] == 0){
            $city = 'Roman';
        }elseif ($_POST['city'] == 1){
            $city = 'Milan';
        }elseif ($_POST['city'] == 2){
            $city = 'Firenze';
        }else{
            $city = 'Florance';
        }
    }else{
        if($_POST['city'] == 0){
            $city = 'New York';
        }elseif ($_POST['city'] == 1){
            $city = 'San Francisco';
        }else {
            $city = 'Washington';
        }
    }
    $_SESSION['search2'] = 1;
    unset($_SESSION['title1']);
    $_SESSION['country1'] = $_POST['country'];
    $_SESSION['city1'] = $city;
    $_SESSION['subject1'] = $_POST['subject'];
    unset($_SESSION['cityCode1']);
    unset($_SESSION['ISO1']);




}
if(isset($_GET['id'])&&isset($_GET['ISO'])){
    $id = $_GET['id'];
    $ISO = $_GET['ISO'];
    unset($_SESSION['title1']);
    unset($_SESSION['country1']);
    unset($_SESSION['city1']);
    unset($_SESSION['subject1']);
    $_SESSION['ISO1'] = $ISO;
    unset($_SESSION['cityCode1']);

}
if(isset($_GET['cityCode'])){
    $cityCode = $_GET['cityCode'];
    unset($_SESSION['title1']);
    unset($_SESSION['country1']);
    unset($_SESSION['city1']);
    unset($_SESSION['subject1']);
    unset($_SESSION['ISO1']);
    $_SESSION['cityCode1'] = $cityCode;

}
if(isset($_GET['content'])){
    $content=$_GET['content'];
    unset($_SESSION['title1']);
    unset($_SESSION['country1']);
    unset($_SESSION['city1']);
    unset($_SESSION['subject1']);
    unset($_SESSION['ISO1']);
    unset($_SESSION['cityCode1']);
    $_SESSION['content'] = $content;

}
header('location:../src/Browser.php');