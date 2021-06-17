<?php
    include("includes/db.php");
    include("functions/functions.php");

$custEmail = 'custEmail';
$custPass = 'custPass';
if(isset($_COOKIE[$custEmail]) && isset($_COOKIE[$custPass])){
    $cE = $_COOKIE[$custEmail];
    $cP = $_COOKIE[$custPass];
    $get_cust = "SELECT * FROM `customer` WHERE `customer_email`= '$cE' AND `customer_pass` = '$cP'";
    $run_c = mysqli_query($con, $get_cust);
    if(mysqli_num_rows($run_c) == 1){
        /*header("location: index.php");*/
        header("location: pyment.php");
    }
}else{
    header("location: customer/customer_login.php");
}
?>
