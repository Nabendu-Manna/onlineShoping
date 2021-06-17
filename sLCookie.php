<?php
    include("includes/db.php");
    include("functions/functions.php");

if(isset($_POST['s_login'])){
    $seller_email = $_POST['s_email'];
    $seller_pass = $_POST['s_pass'];

    $set_seller = "SELECT * FROM `seller` WHERE `seller_email` = '$seller_email' AND `seller_pass` = '$seller_pass'";
    $run_seller = mysqli_query($con, $set_seller);
    if(mysqli_num_rows($run_seller) == 1){
        setcookie("custEmail",$seller_email,time()+31536000);
        setcookie("custPass",$seller_pass,time()+31536000);
        echo"<script>alert('Welcome');</script>";
        header("location: index.php");
    }else{
        echo"<script>alert('Email or password is wrong!');</script>";
        header("location: seller/seller_login.php");
        //echo"<script>window.location.replace('customer/customer_login.php','self');</script>";
    }
}
?>