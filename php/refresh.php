<?php
session_start();
$_SESSION['refresh']=1;
header('location:../index.php');


