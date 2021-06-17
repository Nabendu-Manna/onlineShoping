<?php
    include("includes/db.php");
    include("functions/functions.php");
    // header("location: rCookie.php");
    include("rCookie.php");


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
        <?php chCookie(); ?>
    </ul>
    <div id="form">
            <form method="POST" action="results.php" enctype="multipart/form-data">
                <input type="text" name="user_query" placeholder="Search"/>
                <input type="submit" name="search" value="Search"/>
            </form>
        </div>
</div>

    <div class="content_wrapper">
        <!--<div id="left_sideber">
            <div id="sidebar_title">Categories</div>
            <ul id="cats"><?php getCats(); ?></ul>
            <div id="sidebar_title">Brands</div>
            <ul id="cats"><?php getBrands(); ?></ul>
        </div>-->

        <div id="right_content">
            <?php cart();?>
            <div id="headline">
                <div id="headline_content">
                    <b>
                        <?php
                            getCookiesItems();
                        ?>
                    </b>
                    <b style="color: rgb(255,255,0);">Shopping Cart:</b>
                    <span>- Items: <?php items(); ?> - Price: <?php total_price(); ?> - <a href = "cart.php" style="color:#FF0;">Go to cart</a> </span>
                </div>
            </div>
            <?php
            ?>
            <div id="products_box">
                <?php
                    if(isset($_COOKIE["user_query"])){
                        $user_keyword = $_COOKIE["user_query"];
                        $get_products = "select * from products where product_keywords like '%$user_keyword%' order by rand() LIMIT 0,3";
                        $run_products = mysqli_query($con, $get_products);
                        // echo"<div id = 'likePro'>";
                        while($row_products = mysqli_fetch_array($run_products)){
                            $pro_id=$row_products['product_id'];
                            $pro_title=$row_products['product_title'];
                            $pro_cat=$row_products['cat_id'];
                            $pro_brand=$row_products['brand_id'];
                            $pro_desc=$row_products['product_desc'];
                            $pro_price=$row_products['product_price'];
                            $pro_image=$row_products['product_img2'];
                            echo"
                                <div id='single_product'>
                                    <h3>$pro_title</h3>
                                    <img src='admin_area/product_images/$pro_image'/><br/>
                                    <p><b>Price: $pro_price $</b></p>
                                    <a href='details.php?pro_id=$pro_id' style=''>Details</a>
                                    <a href='index.php?add_cart=$pro_id'><button style='border-radius:5px;'>Add to cart</button></a>
                                </div>
                            ";
                        }
                        // echo"</div>";
                    }
                    getPro();
                    // getCatPro();
                    // getBrandPro();
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