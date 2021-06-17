<?php
session_start();

setcookie("custEmail",NULL,time()-31536000);
setcookie("custPass",NULL,time()-31536000);
// echo"<script>window.location.replace('index.php','self');</script>";
setcookie("custEmail",NULL,time()-31536000);
setcookie("custPass",NULL,time()-31536000);
if(isset($_COOKIE["user_query"])){
    setcookie("user_query",NULL,time()-43200);
    unset($_SESSION['user_query']);
}
if(isset($_SESSION['custEmail'])){
    unset($_SESSION['custEmail']);
    unset($_SESSION['custPass']);
}
session_destroy();
echo"<script>window.location.replace('index.php','self');</script>";
?>