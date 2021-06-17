<?php
    session_start();
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
            <form action="registerDB.php" method="post" enctype="multipart/form-data">
                <table align="center"style="border-radius:30px;background: rgba(0, 255, 115, 0.651); padding:30px;">
                    <tr>
                        <td colspan="2" align="center"><h1 style="font-size:30px; font-weight:bolder;" align="center">Creat an Account</h1><br></td>
                    </tr>
                    <tr>
                        <td align="right"><b>Name</b></td>
                        <td align="left"><input type="text" name="c_name" required/></td>
                    </tr>
                    <tr>
                        <td align="right"><b>Email</b></td>
                        <td align="left"><input type="text" name="c_email" required/></td>
                    </tr>
                    <tr>
                        <td align="right"><b>Password</b></td>
                        <td align="left">
                            <input type="password" name="c_pass" required/>
                        </td>
                    </tr>
                    <tr>
                        <td align="right"><b>Country</b></td>
                        <td align="left"><input type="text" name="c_country" required/></td>
                    </tr>
                    <tr>
                        <td align="right"><b>City</b></td>
                        <td align="left"><input type="text" name="c_city" required/></td>
                    </tr>
                    <tr>
                        <td align="right"><b>Phone no</b></td>
                        <td align="left"><input type="text" name="c_contact" required/></td>
                    </tr>
                    <tr>
                        <td align="right"><b>Address</b></td>
                        <td align="left"><input type="text" name="c_address" required/></td>
                    </tr>
                    <tr>
                        <td align="right"><b>photo</b></td>
                        <td align="left"><input type="file" name="c_image" required/></td>
                    </tr>
                    <tr><td colspan="2" align="center"><input type="submit" name="register" value="Register"/></td></tr>
                </table>
            </form>
            <br><br>
        </div>
    </div>
</div>

<div class="fotter">
    ?????????????????????????????????<br/>??????????????????????????
</div>
</body>
</html>