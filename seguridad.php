<?php
session_start();
$user = isset($_SESSION["user"])?$_SESSION["user"]:"";

if($user == "")
{
    header("Location: login.php");
    exit();

}
?>