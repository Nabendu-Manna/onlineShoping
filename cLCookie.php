<?php
    include("includes/db.php");
    include("functions/functions.php");
?>
<?php
if(isset($_POST['c_login'])){
    $customer_email = $_POST['c_email'];
    $customer_pass = $_POST['c_pass'];

    $set_customer = "SELECT * FROM `customer` WHERE `customer_email` = '$customer_email' AND `customer_pass` = '$customer_pass'";
    $run_customer = mysqli_query($con, $set_customer);
    if(mysqli_num_rows($run_customer) == 1){
        setcookie("custEmail",$customer_email,time()+31536000);
        setcookie("custPass",$customer_pass,time()+31536000);
        echo"<script>alert('Welcome');</script>";
        header("location: index.php");
    }else{
        echo"<script>alert('Email or password is wrong!');</script>";
        header("location: customer/customer_login.php");
        //echo"<script>window.location.replace('customer/customer_login.php','self');</script>";
    }
}
?>