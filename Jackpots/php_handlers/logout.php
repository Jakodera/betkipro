<?php
session_start();
unset($_SESSION['usernumber']);
if(isset($_COOKIE['remember'])){
    
    setcookie('remember',"", 1,'/','betkipro.com');
    unset($_COOKIE['remember']);
}
header('location:../html/login.php');
exit();
