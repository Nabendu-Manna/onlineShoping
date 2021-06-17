<?php
include("includes/db.php");

if(isset($_COOKIE["custEmail"])){
    $customer_email = $_COOKIE['custEmail'];
    $set_customer = "SELECT * FROM `admin` WHERE `admin_email` = '$customer_email'";
    $run_customer = mysqli_query($con, $set_customer);
    if(mysqli_num_rows($run_customer) == 1){
        header("location: admin_area/account.php");
    }else{
        $set_customer = "SELECT * FROM `seller` WHERE `seller_email` = '$customer_email'";
        $run_customer = mysqli_query($con, $set_customer);
        if(mysqli_num_rows($run_customer) == 1){
            header("location: seller/account.php");
        }else{
            $set_customer = "SELECT * FROM `customer` WHERE `customer_email` = '$customer_email'";
            $run_customer = mysqli_query($con, $set_customer);
            if(mysqli_num_rows($run_customer) == 1){
                header("location: customer/account.php");
            }else{
                header("location: customer/customer_login.php");
            }
        }
    }
}else{
    header("location: customer/customer_login.php");
}
?>