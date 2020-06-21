<?php
session_start();
header('location:../src/Search.php');
if ($_POST['1']=='1'&&$_POST['title'] && !$_POST['description']){
    $title = $_POST['title'];
    $_SESSION['title2'] = $title;
    unset($_SESSION['description2']);
    unset($_SESSION['Wrong']);
}elseif ($_POST['1']=='2'&&$_POST['description'] && !$_POST['title']){
    $description = $_POST['description'];
    $_SESSION['description2'] = $description;
    unset($_SESSION['title2']);
    unset($_SESSION['Wrong']);
}
else{
    $_SESSION['Wrong'] = 1;
    echo "Please choose only one way to search.";
    unset($_SESSION['title2']);
    unset($_SESSION['description2']);
}