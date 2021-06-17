<?php
// include("includes/db.php");
// include("functions/functions.php");
session_start();

if(isset($_SESSION['custEmail'])){
    $customer_email = $_SESSION['custEmail'];
    $customer_pass = $_SESSION['custPass'];

    setcookie("custEmail",$customer_email,time()+31536000);
    setcookie("custPass",$customer_pass,time()+31536000);
    // header("location: index.php");
}
?>