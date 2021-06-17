<?php
    include("includes/db.php");
    include("functions/functions.php");
    //get customer_email
    if(isset($_GET['customer_email'])){
        $customer_email= $_GET['customer_email'];
    }
    //geting product price & number of items
    $cart_sql = "select * from cart where customer_email = '$customer_email';";
    $cart_sql_run = mysqli_query($db,$cart_sql);
    $status = "pending";
    ///////////////////////////////// mod /////////////////////////////////////
    do{
        $invoice_no = mt_rand();
        $invo_sql="SELECT * FROM `customer_orders` WHERE `customer_id` IN (SELECT customer_id FROM customer WHERE customer_email = '$customer_email');";
        $run_invo = mysqli_query($db,$invo_sql);
        $invo = mysqli_fetch_array($run_invo);
        $invo_no_f_t = $invo['invoice_no'];
    }while($invoice_no == $invo_no_f_t);
    $product_price = 0;
    
    $seller="SELECT * FROM `seller`order by rand() LIMIT 0,9";
    $seller_run = mysqli_query($db,$seller);
    $seller_id_a = mysqli_fetch_array($seller_run);
    $seller_id = $seller_id_a['seller_id'];

    $cust_sql = "SELECT `customer_id` FROM `customer` WHERE `customer_email`='$customer_email'";
    $cust_sql_run = mysqli_query($db,$cust_sql);
    $cust_id_a = mysqli_fetch_array($cust_sql_run);
    $cust_id = $cust_id_a['customer_id'];
    
    while($cart_i = mysqli_fetch_array($cart_sql_run)){
        $p_id_f_in = $cart_i['p_id'];
        $insert_customer_order = "INSERT INTO `customer_orders`(`customer_id`, `seller_id`, `product_id`, `invoice_no`, `order_date`, `order_status`) VALUES ('$cust_id', '$seller_id', '$p_id_f_in','$invoice_no', NOW(),'$status')";
        $insert_order_run = mysqli_query($db,$insert_customer_order);
    }
    $empty_cart_sql = "DELETE FROM `cart` WHERE `customer_email`='$customer_email'";
    $empty_cart_run = mysqli_query($db,$empty_cart_sql);
    echo"<script>alert('Order successfully submitted, Thanks.');</script>";
    header("location: my_account.php");
?>