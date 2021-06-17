<?php
    //session_start();
    $user_keyword = $_SESSION['user_query'];
    setcookie("user_query",$user_keyword,time()+43200);
?>