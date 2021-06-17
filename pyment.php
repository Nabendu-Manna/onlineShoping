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
                    <b><?php
                            getCookiesItems();
                        ?></b>
                    <b style="color: rgb(255,255,0);">Shopping Cart:</b>
                    <span>- Items: <?php items(); ?> - Price: <?php total_price(); ?> - <a href = "cart.php" style="color:#FF0;">Go to cart</a> </span>
                </div>
            </div>
            <?php
            if(isset($_GET['customer_email'])){
                $customer_email = $_GET['customer_email'];
                
            }
            ?>
            <div id="products" >
                <div align="center" style="padding:20px;align-content: center;">
                    <h1 style="font-size:40px; color:red;">Pyment</h1><br><br><br><br>
                    <a href="#"><img src="image/PayPal-logo.png" height="100px" width="250px"/></a><br><br>
                    <a href="order.php?customer_email=<?php echo $customer_email; ?>"><img src="image/pay offline.png" height="150px" width="250px"/></a>
                </div>
            </div>
        </div>
    <!--</div>-->

</div>
<div class="fotter">
    ?????????????????????????????????<br/>??????????????????????????
</div>
</body>
</html>