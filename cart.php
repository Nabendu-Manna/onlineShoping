<?php
    include("includes/db.php");
    include("functions/functions.php");
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <title>my shop</title>
    <link rel="stylesheet" type="text/css" href="styles/style.css" media="all"/>
    <link rel="stylesheet" type="text/css" href="icon/css/all.css">
</head>
<body>
<div class="main_wrapper">
    <div id="navbar">
        <ul id="menu">
            <li><a href = "index.php"><i class="fas fa-home"></i> Home</a></li>
            <!-- <li><a href = "all_products.php"><i class="fas fa-archive"></i> All Products</a></li> -->
            <li><a href = "my_account.php"><i class="fas fa-user-alt"></i> My Account</a></li>
            <li><a href = "cart.php"><i class="fas fa-cart-plus"></i> Shopping Cart</a></li>
            <li><a href = "contact.php"><i class="fas fa-comments"></i> Contact Us</a></li>
            <?php chCookie(); ?>        </ul>
        <div id="form">
                <form method="POST" action="results.php" enctype="multipart/form-data">
                    <input type="text" name="user_query" placeholder="Search"/>
                    <input type="submit" name="search" value="Search"/>
                </form>
            </div>
    </div>

    <div class="content_wrapper">
        <!--<div id="left_sideber">
            <img src="image/logo.png" height="100px"/>
            <div id="sidebar_title">Categories</div>
            <ul id="cats"><?php getCats(); ?></ul>
            <div id="sidebar_title">Brands</div>
            <ul id="cats"><?php getBrands(); ?></ul>
        </div>-->

        <!--<div id="right_content">-->
            <?php cart();?>
            <div id="headline">
                <div id="headline_content">
                    <b>Welcome!</b>
                    <b style="color: rgb(255,255,0);">Shopping Cart:</b>
                    <span>- Items: <?php items(); ?> - Price: <?php total_price(); ?>
                    <!-- <a href = "cart.php" style="color:#FF0;">Go to cart</a> </span> -->
                </div>
            </div>
            <div id="products_box" >
                <form action="cart.php" method="post" enctype="multipart/form-data">
                    <table width = "500"align="center" bgcolor="#0099CC" style="margin-left: -50px;">
                        <tr align="center">
                            <td><b>Remove</b></td>
                            <td><b>Products</b></td>
                            <td><b>Quantity</b></td>
                            <td><b>Total price</b></td>
                        </tr>
                        <?php
                        $ip_add = getRealIpAddr();
                        if(!isset($_COOKIE['custEmail'])){
                            header("location: customer/customer_login.php");
                        }else{
                        $customer_email = $_COOKIE['custEmail'];
                        $sel_price = "select * from cart where customer_email = '$customer_email'";
                        $run_price = mysqli_query($con,$sel_price);
                        $product_price = 0;
                        while($record = mysqli_fetch_array($run_price)){
                            $pro_id = $record['p_id'];
                            $pro_price = "select * from products where product_id = '$pro_id'";
                            $run_pro_price = mysqli_query($con,$pro_price);
                            $p_price = mysqli_fetch_array($run_pro_price); 
                            $product_p = $p_price['product_price'];
                            $product_title = $p_price['product_title'];
                            $product_image = $p_price['product_img2'];
                            $p_qty = $record['qty'];
                            $product_price = $product_price + $product_p * $p_qty;
                        ?>
                        <tr>
                            <td><br><br><input type="checkbox" name="remove[]" value="<?php echo $pro_id; ?>"></td>
                            <td><?php echo $product_title; ?> <br/> <img src="admin_area/product_images/<?php echo"$product_image"; ?>" height="80" width="80"></td>
                            <td><br><br><input type="text" name="qty-<?php echo $pro_id;?>" value="<?php
                                $qt_q="SELECT `qty` FROM `cart` WHERE p_id='$pro_id'";
                                $r_q=mysqli_query($con,$qt_q);
                                $row_qt=mysqli_fetch_array($r_q);
                                $n_qty = $row_qt['qty'];
                                echo $n_qty ?>" size="3"/>
                            </td>
                            <td><br><br><?php echo $product_p * $n_qty." $"; ?></td>
                        </tr> <?php } ?>
                            <?php
                            if(isset($_POST['update'])){
                                $pr_q="SELECT `p_id` FROM `cart`";
                                $run_pr=mysqli_query($con,$pr_q);
                                while($pr = mysqli_fetch_array($run_pr)){
                                    $pro = $pr['p_id'];
                                    $q = "qty-".(string)$pro;
                                    $qty = $_POST[$q];
                                    $insert_qty = "UPDATE `cart` SET `qty`=$qty WHERE `customer_email`='$customer_email' and p_id='$pro'";
                                    mysqli_query($con,$insert_qty);
                                }
                                echo"<script>window.open('cart.php','_self')</script>";
                            }
                            ?>
                        <tr>
                            <td colspan="3" align="right"><br/><b>Sub Totle:</b></td>
                            <td><br/><b><?php echo $product_price." $"; ?></b><br><br></td>
                        </tr>
                        <tr>
                            <td colspan="2"><input type="submit" name="update" value="update"/></td>
                            <td><input type="submit" name="continue" value="Continue Shopping"/></td>
                            <td><button><a href="pyment.php?customer_email=<?php echo $customer_email; ?>" style="text-decoration:none; color:#000;">Checkout</a></button></td>
                        </tr>
                    </table>
                </form>
                <?php
                function updatecart (){
                    global $con;
                    if(isset($_POST['update'])){ 
                        foreach($_POST['remove'] as $remove_id){
                            $delete_products = "delete from cart where p_id = '$remove_id'";
                            $run_delete = mysqli_query($con, $delete_products);
                            if($run_delete){
                                echo"<script>window.open('cart.php','_self')</script>";
                            }
                        }
                    }
                }
                echo @$up_cart = updatecart();
                if(isset($_POST['continue'])){
                    echo"<script>window.open('index.php','_self')</script>";
                }
                }
                ?>
            </div>
        </div>
    <!--</div>-->
    
</div>
<div class="fotter">
    ?????????????????????????????????<br/>??????????????????????????
</div>
</body>
</html>