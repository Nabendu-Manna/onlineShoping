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
            <li><a href = "all_products.php"><i class="fas fa-archive"></i> All Products</a></li>
            <li><a href = "my_account.php"><i class="fas fa-user-alt"></i> My Account</a></li>
            <li><a href = "cart.php"><i class="fas fa-cart-plus"></i> Shopping Cart</a></li>
            <li><a href = "contact.php"><i class="fas fa-comments"></i> Contact Us</a></li>
            <?php chCookie(); ?>
        </ul>
        <div id="form">
                <form method="POST" action="results.php" enctype="multipart/form-data">
                    <input type="text" name="user_query" placeholder="Search"/>
                    <input type="submit" name="search" value="Search"/>
                </form>
            </div>
    </div>
    <div class="content_wrapper" style="height:600px;">
        <!--<div id="left_sideber">
            <div id="sidebar_title">Categories</div>
            <ul id="cats"><?php getCats(); ?></ul>
            <div id="sidebar_title">Brands</div>
            <ul id="cats"><?php getBrands(); ?></ul>
        </div>-->

        <div id="right_content">
            <div id="headline">
                <div id="headline_content">
                    <b><?php
                            getCookiesItems();
                        ?></b>
                    <b style="color: rgb(255,255,0);">Shopping Cart:</b>
                    <span>- Items: <?php items(); ?> - Price: <?php total_price(); ?> - <a href = "cart.php" style="color:#FF0;">Go to cart</a> </span>
                </div>
            </div>
            <div id="products_box">
                <?php 
                    if(isset($_GET['pro_id'])){
                        $product_id = $_GET['pro_id'];
                        $get_products = "select * from products where product_id = '$product_id'";
                        $run_products = mysqli_query($con, $get_products);
                        while($row_products = mysqli_fetch_array($run_products)){
                            $pro_id=$row_products['product_id'];
                            $pro_title=$row_products['product_title'];
                            $pro_cat=$row_products['cat_id'];
                            $pro_brand=$row_products['brand_id'];
                            $pro_desc=$row_products['product_desc'];
                            $pro_price=$row_products['product_price'];
                            $pro_image2=$row_products['product_img2'];
                            $pro_image1=$row_products['product_img1'];
                            $pro_image3=$row_products['product_img3'];
                            echo"
                                <div id='single_product'>
                                    <h3>$pro_title   </h3>
                                    <img src='admin_area/product_images/$pro_image2'/><br/>
                                    <img src='admin_area/product_images/$pro_image1' style='height: 100px; width:100px; border: 1px solid rgba(0, 0, 0, 0.315); border-radius: 20px;'/>
                                    <img src='admin_area/product_images/$pro_image3' style='height: 100px; width:100px; border: 1px solid rgba(0, 0, 0, 0.315); border-radius: 20px;'/><br/>
                                    <p><b>Price: $pro_price $</b></p>
                                    <p>$pro_desc</p>
                                    <a href='index.php' style='float: left;'>Go back</a>
                                    <a href='index.php?add_cart=$pro_id'><button style='float:right;'>Add to cart</button></a>
                                </div>
                            ";
                        }
                    }
                    getCatPro(); getBrandPro(); 
                ?>
            </div>
        </div>
    </div>
</div>

<div class="fotter">
    ?????????????????????????????????<br/>??????????????????????????
</div>
</body>
</html>