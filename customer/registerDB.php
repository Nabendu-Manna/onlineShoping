<?php
    include("../includes/db.php");
    include("../functions/functions.php");
    session_start();
?>
<?php
if(isset($_POST['register'])){
    $customer_email = $_POST['c_email'];
    $customer_pass = $_POST['c_pass'];
    $set_customer = "SELECT * FROM `customer` WHERE `customer_email` = '$customer_email'";
    $run_customer = mysqli_query($con, $set_customer);
    if(mysqli_num_rows($run_customer) == 1){
        echo"<script>alert('Already exists');</script>";
        header("location: customer_register.php");
        //echo"<script>window.location.replace('customer_register.php','self');</script>";
    }else{
        $cName=$_POST['c_name'];
        $cEmail=$_POST['c_email'];
        $cPass=$_POST['c_pass'];
        $cCountry=$_POST['c_country'];
        $cCity=$_POST['c_city'];
        $cContact=$_POST['c_contact'];
        $cAddress=$_POST['c_address'];
        $cPin=$_POST['c_pin'];
        //imgage
        $cImg=$_FILES['c_image'] ['name'];
        $cTempName=$_FILES['c_image'] ['tmp_name'];
        move_uploaded_file($cTempName,"customer_images/$cImg");

        $_SESSION['custEmail'] = $cEmail;
        $_SESSION['custPass'] = $cPass;
        setcookie("custEmail",$cEmail,time()+31536000);
        setcookie("custPass",$cPass,time()+31536000);
        $ip_add = getRealIpAddr();
        $inCustomer = "INSERT INTO `customer`(`customer_name`, `customer_email`, `customer_pass`, `customer_country`, `customer_city`, `customer_contact`, `customer_address`, `customer_image`, `customer_ip`, `customer_pin`) VALUES ('$cName','$cEmail','$cPass','$cCountry','$cCity','$cContact','$cAddress','$cImg','1', '$cPin')";
        $run_customer = mysqli_query($con, $inCustomer);
        echo"<script>alert('Welcome');</script>";
        header("location: ../index.php");
    }
}
?>