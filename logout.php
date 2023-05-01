<?php
session_start();
$_SESSION['sid']="";
unset($_SESSION['sid']);
header("location: login.html");
?>