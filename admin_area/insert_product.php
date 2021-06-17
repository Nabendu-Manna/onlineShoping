<?php
include("../includes/db.php");
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>my shop admin</title>
    
    <!--<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script>tinymce.init({ selector:'textarea' });</script>-->
</head>
<body bgcolor="#223">
    <form method="POST" action="insert_product.php" enctype="multipart/form-data">
        <table width="700" align="center" bgcolor="#aaa" style=" border-radius:20px;">
            <tr align="center">
                <td colspan="2"><h2>Insert new product</h2></td>
            </tr>
            <tr>
                <td align="right"><b>Product title</b></td>
                <td><input type="text" name="product_title" size="50"/></td>
            </tr>
            <tr>
                <td align="right"><b>Product category</b></td>
                <td>
                    <select name="product_cat">
                        <option></option>
                        <?php
                        $get_cats="SELECT * FROM categories";
                        $run_cats=mysqli_query($con, $get_cats);
                        while($row_cats=mysqli_fetch_array($run_cats)){
                            $cat_id=$row_cats['cat_id'];
                            $cat_title=$row_cats['cat_title'];
                            echo"<option value='$cat_id'>$cat_title</option>";
                        }
                        ?>
                    </select>
                </td>
            </tr>

            <tr>
                <td align="right"><b>Product brand</b></td>
                <td>
                    <select name="product_brand">
                        <option></option>
                        <?php
                            $get_cats="SELECT * FROM brands";
                            $run_cats=mysqli_query($con, $get_cats);
                            while($row_cats=mysqli_fetch_array($run_cats)){
                                $brand_id=$row_cats['brand_id'];
                                $brand_title=$row_cats['brand_title'];
                                echo"<option value='$brand_id'>$brand_title</option>";
                            }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td align="right"><b>Product image1</b></td>
                <td><input type="file" name="product_img1"/></td>
            </tr>
            <tr>
                <td align="right"><b>Product image2</b></td>
                <td><input type="file" name="product_img2"/></td>
            </tr>
            <tr>
                <td align="right"><b>Product image3</b></td>
                <td><input type="file" name="product_img3"/></td>
            </tr>
            <tr>
                <td align="right"><b>Product price</b></td>
                <td><input type="text" name="product_price" size="50"/></td>
            </tr>
            <tr>
                <td align="right"><b>Product Description</b></td>
                <td><textarea cols="42" rows="10" name="product_desc"></textarea></td>
            </tr>
            <tr>
                <td align="right"><b>Product keywords</b></td>
                <td><input type="text" name="product_keywords" size="50"/></td>
            </tr>
            <tr align="center">
                <td colspan="2"><input type="submit" name="insert_product" value="Insert Product"/></td>
            </tr>
        </table>
    </form>
</body>
</html>

<?php
    if(isset($_POST['insert_product'])){
        //text
        $product_title=$_POST['product_title'];
        $product_cat=$_POST['product_cat'];
        $product_brand=$_POST['product_brand'];
        $product_price=$_POST['product_price'];
        $product_desc=$_POST['product_desc'];
        $product_keywords=$_POST['product_keywords'];
        $status='on';
        
        //imgage
        $product_img1=$_FILES['product_img1'] ['name'];
        $product_img2=$_FILES['product_img2'] ['name'];
        $product_img3=$_FILES['product_img3'] ['name'];
        //image temp name
        $temp_name1=$_FILES['product_img1'] ['tmp_name'];
        $temp_name2=$_FILES['product_img2'] ['tmp_name'];
        $temp_name3=$_FILES['product_img3'] ['tmp_name'];

        if($product_title=='' OR $product_cat=='' OR $product_brand=='' OR $product_desc=='' OR $product_keywords=='' OR $product_price=='' OR $product_img1==''){
            echo"<script>alert('Please fill all the fields!')</script>";
            exit();
        }else{
            //upload image.
            move_uploaded_file($temp_name1,"product_images/$product_img1");
            move_uploaded_file($temp_name2,"product_images/$product_img2");
            move_uploaded_file($temp_name3,"product_images/$product_img3");
            //Insert Product.
            $insert_product="INSERT INTO products (cat_id, brand_id, date, product_title, product_img1, product_img2, product_img3, product_price, product_desc, status, product_keywords) VALUES ('$product_cat','$product_brand',NOW(),'$product_title','$product_img1','$product_img2','$product_img3','$product_price','$product_desc','$status','$product_keywords')";
            $run_product=mysqli_query($con, $insert_product);
            if($run_product){
                echo"<script>alert('One product inserted.')</script>";
            }else{
                echo"<script>alert('Product not inserted.')</script>";
            }
        }
    }
?>