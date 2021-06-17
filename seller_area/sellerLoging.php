<?php
    include("../includes/db.php");
    include("../functions/functions.php");
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <title>my shop</title>
    <link rel="stylesheet" type="text/css" href="../styles/style.css" media="all"/>
    <link rel="stylesheet" type="text/css" href="../icon/css/all.css">
</head>
<body>
<div class="main_wrapper">
<div id="navbar">
    <ul id="menu">
        <li><a href = "../index.php"><i class="fas fa-home"></i> Home</a></li>
        <!-- <li><a href = "../all_products.php"><i class="fas fa-archive"></i> All Products</a></li> -->
        <li><a href = "../my_account.php"><i class="fas fa-user-alt"></i> My Account</a></li>
        <li><a href = "../cart.php"><i class="fas fa-cart-plus"></i> Shopping Cart</a></li>
        <li><a href = "../contact.php"><i class="fas fa-comments"></i> Contact Us</a></li>
    </ul>
    <div id="form">
            <form method="POST" action="results.php" enctype="multipart/form-data">
                <input type="text" name="user_query" placeholder="Search"/>
                <input type="submit" name="search" value="Search"/>
            </form>
        </div>
</div>
    <div class="content_wrapper">
        <?php cart();?>
        <div id="headline">
            <div id="headline_content">
                <b><?php
                            getCookiesItems();
                        ?></b>
                <b style="color: rgb(255,255,0);">Shopping Cart:</b>
                <span>- Items: <?php items(); ?> - Price: <?php total_price(); ?> - <a href = "../cart.php" style="color:#FF0;">Go to cart</a> </span>
            </div>
        </div>
        <div style="padding-top:100px;">
            <form action="../lcookie.php" method="post">
                <table align="center"style="border-radius:30px;background: rgba(0, 255, 115, 0.651); padding:30px;">
                    <tr><td colspan="2"><h1 style="font-size:30px; font-weight:bolder;" align="center">Login</h1><br></td></tr>
                    <tr>
                        <td align="right">Enter your email: </td><td align="left"><input type="text" name="c_email" placeholder="Enter your email" required/></td>
                    </tr>
                    <tr>
                        <td align="right">Enter your passsword: </td><td align="left"><input type="password" name="c_pass" placeholder="Enter your passsword" required/></td>
                    </tr>
                    <tr><td colspan="2" align="center"><a href="forgot_pass.php" style="text-decoration:none;">Forgot passsword</a></td></tr>
                    <tr align="center">
                        <td colspan="2"><input type="submit" name="c_login" value="Login"/></td>
                    </tr>
                    <tr align="center">
                        <td colspan="2"><br><a href="customer_register.php" style="text-decoration:none; font-weight:bolder;">New register</a></td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</div>
<div class="fotter">
    ?????????????????????????????????<br/>??????????????????????????
</div>
</body>
</html>
