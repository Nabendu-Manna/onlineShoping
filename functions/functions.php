<?php
$db = mysqli_connect("localhost", "root", "", "myshop");

//function for getting the ip address
function getRealIpAddr() {
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        //chick ip from share internet
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        //to check ip passed from proxy
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}

function cart() {
    if (isset($_GET['add_cart'])) {
        if(isset($_COOKIE["custEmail"])){
            global $db;
            $customer_email = $_COOKIE['custEmail'];
            $ip_add = getRealIpAddr();
            $p_id = $_GET['add_cart'];
            $check_pro = "SELECT * FROM cart WHERE p_id='$p_id' AND customer_email='$customer_email'";
            $run_check = mysqli_query($db, $check_pro);
            if(mysqli_num_rows($run_check) == 0){
                $q = "INSERT INTO cart(p_id, customer_email, qty) VALUES ('$p_id','$customer_email',1)";
                $run_q = mysqli_query($db, $q);
            }
        }else{
            header("location: customer/customer_login.php");
        }
    }
}

function items(){
    global $db;
    $ip_add = getRealIpAddr();
    if(isset($_COOKIE["custEmail"])){
        $customer_email = $_COOKIE['custEmail'];
        $get_items = "select * from cart where customer_email='$customer_email'";
        $run_items = mysqli_query($db, $get_items);
        $count_items = mysqli_num_rows($run_items);
        $p_q = 0;
        while($c_items = mysqli_fetch_array($run_items)){
            $p_q = $p_q + $c_items['qty'];
        }
        
        echo $p_q;
    }else{
        echo "0";
    }
}

function total_price() {
    global $db;
    $ip_add = getRealIpAddr();
    if(isset($_COOKIE["custEmail"])){
        $customer_email = $_COOKIE['custEmail'];
        $sel_price = "select * from cart where customer_email = '$customer_email'";
        $run_price = mysqli_query($db,$sel_price);
        $product_price = 0;
        while($record = mysqli_fetch_array($run_price)){
            $pro_id = $record['p_id'];
            $pro_price = "select * from products where product_id = '$pro_id'";
            $run_pro_price = mysqli_query($db,$pro_price);
            $p_price = mysqli_fetch_array($run_pro_price); 
            $product_price = $product_price + $p_price['product_price'] * $record['qty'];
        }
        echo $product_price ." $";
    }else{
        echo "0"." $";
    }
}

function getPro() {
    global $db;
    // if (!isset($_GET['cat'])) {
        // if (!isset($_GET['brand'])) {
            
            $get_products = "select * from products order by rand() LIMIT 0,9";
            $run_products = mysqli_query($db, $get_products);
            while ($row_products = mysqli_fetch_array($run_products)) {
                $pro_id = $row_products['product_id'];
                $pro_title = $row_products['product_title'];
                $pro_cat = $row_products['cat_id'];
                $pro_brand = $row_products['brand_id'];
                $pro_desc = $row_products['product_desc'];
                $pro_price = $row_products['product_price'];
                $pro_image = $row_products['product_img2'];
                echo "
                    <div id='single_product'>
                        <h3>$pro_title   </h3>
                        <a href='details.php?pro_id=$pro_id'><img src='admin_area/product_images/$pro_image'></a><br/>
                        <p><b>Price: $pro_price $</b></p>
                        <a href='details.php?pro_id=$pro_id' style=''>Details</a>
                        <a href='index.php?add_cart=$pro_id'><button style='border-radius:5px;'>Add to cart</button></a>
                    </div>
                ";
            }
        // }
    // }
}

function getCatPro() {
    global $db;
    if (isset($_GET['cat'])) {
        $cat_id = $_GET['cat'];
        $get_cat_pro = "select * from products where cat_id='$cat_id' order by rand() LIMIT 0,6";
        $run_cat_pro = mysqli_query($db, $get_cat_pro);
        $count = mysqli_num_rows($run_cat_pro);
        if ($count == 0) {
            echo "NO products found in this category!";
        } else {
            while ($row_cat_pro = mysqli_fetch_array($run_cat_pro)) {
                $pro_id = $row_cat_pro['product_id'];
                $pro_title = $row_cat_pro['product_title'];
                $pro_cat = $row_cat_pro['cat_id'];
                $pro_brand = $row_cat_pro['brand_id'];
                $pro_desc = $row_cat_pro['product_desc'];
                $pro_price = $row_cat_pro['product_price'];
                $pro_image = $row_cat_pro['product_img2'];
                echo "
                    <div id='single_product'>
                        <h3>$pro_title   </h3>
                        <a href='details.php?pro_id=$pro_id'><img src='admin_area/product_images/$pro_image'></a><br/>
                        <p><b>Price: $pro_price $</b></p>
                        <a href='details.php?pro_id=$pro_id' style='float: left;'>Details</a>
                        <a href='index.php?add_cart=$pro_id'><button style='float:right;'>Add to cart</button></a>
                    </div>
                ";
            }
        }
    }
}

function getBrandPro() {
    global $db;
    if (isset($_GET['brand'])) {
        $brand_id = $_GET['brand'];
        $get_brand_pro = "select * from products where brand_id='$brand_id' order by rand() LIMIT 0,6";
        $run_brand_pro = mysqli_query($db, $get_brand_pro);
        $count = mysqli_num_rows($run_brand_pro);
        if ($count == 0) {
            echo "NO products found in this brand!";
        } else {
            while ($row_brand_pro = mysqli_fetch_array($run_brand_pro)) {
                $pro_id = $row_brand_pro['product_id'];
                $pro_title = $row_brand_pro['product_title'];
                $pro_cat = $row_brand_pro['cat_id'];
                $pro_brand = $row_brand_pro['brand_id'];
                $pro_desc = $row_brand_pro['product_desc'];
                $pro_price = $row_brand_pro['product_price'];
                $pro_image = $row_brand_pro['product_img2'];
                echo "
                    <div id='single_product'>
                        <h3>$pro_title</h3>
                        <a href='details.php?pro_id=$pro_id'><img src='admin_area/product_images/$pro_image'></a><br/>
                        <p><b>Price: $pro_price $</b></p>
                        <a href='details.php?pro_id=$pro_id' style='float: left;'>Details</a>
                        <a href='index.php?add_cart=$pro_id'><button style='float:right;'>Add to cart</button></a>
                    </div>
                ";
            }
        }
    }
}
function getCats() {
    global $db;
    $get_cats = "SELECT * FROM categories";
    $run_cats = mysqli_query($db, $get_cats);
    while ($row_cats = mysqli_fetch_array($run_cats)) {
        $cat_id = $row_cats['cat_id'];
        $cat_title = $row_cats['cat_title'];
        echo "<li><a href='index.php?cat=$cat_id'>$cat_title</a></li>";
    }
}

function getBrands() {
    global $db;
    $get_cats = "SELECT * FROM brands";
    $run_cats = mysqli_query($db, $get_cats);
    while ($row_cats = mysqli_fetch_array($run_cats)) {
        $brand_id = $row_cats['brand_id'];
        $brand_title = $row_cats['brand_title'];
        echo "<li><a href='index.php?brand=$brand_id'>$brand_title</a></li>";
    }
}

function chCookie(){
    global $db;
    if(isset($_COOKIE["custEmail"]) && isset($_COOKIE["custPass"])){
        $customer_email = $_COOKIE['custEmail'];
        $customer_pass = $_COOKIE['custPass'];
        $set_customer = "SELECT * FROM `customer` WHERE `customer_email` = '$customer_email' AND `customer_pass` = '$customer_pass'";
        $run_customer = mysqli_query($db, $set_customer);
        if(mysqli_num_rows($run_customer) == 1){
            echo'<li><a href = "LogOut.php"><i class="fas fa-sign-in-alt"></i> Log out</a></li>';
        }else{
            echo'<li><a href = "customer\customer_login.php"><i class="fas fa-sign-in-alt"></i> Log in</a></li>';
        }
    }else{
        echo'<li><a href = "customer\customer_login.php"><i class="fas fa-sign-in-alt"></i> Log in</a></li>';
    }
}

function getCookiesItems(){
    global $db;
    //echo"Welcome:";
    if(isset($_COOKIE["custEmail"])){
        $customer_email = $_COOKIE['custEmail'];
        $set_customer = "SELECT * FROM `customer` WHERE `customer_email` = '$customer_email'";
        $run_customer = mysqli_query($db, $set_customer);
        while($row_customer = mysqli_fetch_array($run_customer)){
            echo"Welcome:".$row_customer['customer_name']." ;";
        }
    }else{
        echo"Welcome:";
    }
}