<?php
    include("../includes/db.php");
    include("../functions/functions.php");
    session_start();
?>
<?php
if(isset($_POST['register'])){
    $seller_email = $_POST['s_email'];
    $seller_pass = $_POST['s_pass'];
    $set_seller = "SELECT * FROM `seller` WHERE `seller_email` = '$seller_email'";
    $run_seller = mysqli_query($con, $set_seller);
    if(mysqli_num_rows($run_seller) == 1){
        echo"<script>alert('Already exists');</script>";
        header("location: seller_register.php");
        //echo"<script>window.location.replace('customer_register.php','self');</script>";
    }else{
        $sName=$_POST['s_name'];
        $sEmail=$_POST['s_email'];
        $sPass=$_POST['s_pass'];
        $sCountry=$_POST['s_country'];
        $sCity=$_POST['s_city'];
        $sContact=$_POST['s_contact'];
        $sAddress=$_POST['s_address'];
        $sPin=$_POST['s_pin'];
        // imgage
        $sImg;
        $sTempName;

        $sImg=$_FILES['s_image'] ['name'];
        $sTempName=$_FILES['s_image'] ['tmp_name'];
        move_uploaded_file($sTempName,"seller_images/$sImg");

        $_SESSION['custEmail'] = $sEmail;
        $_SESSION['custPass'] = $sPass;

        setcookie("custEmail",$sEmail,time()+31536000);
        setcookie("custPass",$sPass,time()+31536000);

        setcookie("sellerEmail",$sEmail,time()+31536000);
        setcookie("sellerPass",$sPass,time()+31536000);

        $ip_add = getRealIpAddr();

        $set_cust = "SELECT * FROM `customer` WHERE `customer_email` = '$sEmail'";
        $run_cust = mysqli_query($con, $set_cust);
        if(mysqli_num_rows($run_cust) == 0){
            $inCustomer = "INSERT INTO `customer`(`customer_name`, `customer_email`, `customer_pass`, `customer_country`, `customer_city`, `customer_contact`, `customer_address`, `customer_image`, `customer_ip`, `customer_pin`) VALUES ('$sName','$sEmail','$sPass','$sCountry','$sCity','$sContact','$sAddress','$sImg','1', '$sPin')";
            $run_customer = mysqli_query($con, $inCustomer);
        }
        
        $inSeller = "INSERT INTO `seller`(`seller_name`, `seller_email`, `seller_pass`, `seller_country`, `seller_city`, `seller_contact`, `seller_address`, `seller_image`, `seller_pin`) VALUES ('$sName','$sEmail','$sPass','$sCountry','$sCity','$sContact','$sAddress','$sImg', '$sPin')";
        $run_seller = mysqli_query($con, $inSeller);

        echo"<script>alert('Welcome');</script>";
        header("location: ../index.php");
    }
}
?>