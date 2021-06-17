<?php
    include("../includes/db.php");
    include("../functions/functions.php");
    session_start();
?>
<?php
if(isset($_POST['register'])){
    $admin_email = $_POST['a_email'];
    $admin_pass = $_POST['a_pass'];
    $set_admin = "SELECT * FROM `admin` WHERE `admin_email` = '$admin_email'";
    $run_admin = mysqli_query($con, $set_admin);
    if(mysqli_num_rows($run_admin) == 1){
        echo"<script>alert('Already exists');</script>";
        header("location: seller_register.php");
        //echo"<script>window.location.replace('customer_register.php','self');</script>";
    }else{
        $aName=$_POST['a_name'];
        $aEmail=$_POST['a_email'];
        $aPass=$_POST['a_pass'];
        $aCountry=$_POST['a_country'];
        $aCity=$_POST['a_city'];
        $aContact=$_POST['a_contact'];
        $aAddress=$_POST['a_address'];
        $aPin=$_POST['a_pin'];
        // imgage
        $aImg;
        $aTempName;

        $aImg=$_FILES['a_image'] ['name'];
        $aTempName=$_FILES['a_image'] ['tmp_name'];
        move_uploaded_file($aTempName,"admin_images/$aImg");

        $_SESSION['custEmail'] = $aEmail;
        $_SESSION['custPass'] = $aPass;

        setcookie("custEmail",$aEmail,time()+31536000);
        setcookie("custPass",$aPass,time()+31536000);

        setcookie("adminEmail",$aEmail,time()+31536000);
        setcookie("adminPass",$aPass,time()+31536000);

        $ip_add = getRealIpAddr();

        $set_cust = "SELECT * FROM `customer` WHERE `customer_email` = '$aEmail'";
        $run_cust = mysqli_query($con, $set_cust);
        if(mysqli_num_rows($run_cust) == 0){
            $inCustomer = "INSERT INTO `customer`(`customer_name`, `customer_email`, `customer_pass`, `customer_country`, `customer_city`, `customer_contact`, `customer_address`, `customer_image`, `customer_ip`, `customer_pin`) VALUES ('$aName','$aEmail','$aPass','$aCountry','$aCity','$aContact','$aAddress','$aImg','1', '$aPin')";
            $run_customer = mysqli_query($con, $inCustomer);
        }

        $inAdmin = "INSERT INTO `admin`(`admin_name`, `admin_email`, `admin_pass`, `admin_country`, `admin_city`, `admin_contact`, `admin_address`, `admin_image`, `admin_pin`) VALUES ('$aName','$aEmail','$aPass','$aCountry','$aCity','$aContact','$aAddress','$aImg', '$aPin')";
        $run_admin = mysqli_query($con, $inAdmin);

        echo"<script>alert('Welcome');</script>";
        header("location: ../index.php");
    }
}
?>