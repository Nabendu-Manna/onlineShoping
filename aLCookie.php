<?php
    include("includes/db.php");
    include("functions/functions.php");
    echo "xxx";
// if(isset($_POST['a_login'])){
    $admin_email = $_POST['a_email'];
    $admin_pass = $_POST['a_pass'];
    echo "xxx";
    $set_admin = "SELECT * FROM `admin` WHERE `admin_email` = '$admin_email' AND `admin_pass` = '$admin_pass'";
    $run_admin = mysqli_query($con, $set_admin);
    if(mysqli_num_rows($run_admin) == 1){
        setcookie("custEmail",$admin_email,time()+31536000);
        setcookie("custPass",$admin_pass,time()+31536000);
        // echo"<script>alert('Welcome');</script>";
        header("location:index.php");
    }else{
        // echo"<script>alert('Email or password is wrong!');</script>";
        header("location: admin/admin_login.php");
        //echo"<script>window.location.replace('customer/customer_login.php','self');</script>";
    }
// }
?>