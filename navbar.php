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
