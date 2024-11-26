<?php

require '../../includes/config.php';
require '../../includes/db-utils.php';

session_start();

$inputEmail = $_POST['login-email'];
$inputPassword = md5($_POST['login-password']);

$user = getUserByEmail($inputEmail);

if($user) {
    $_SESSION['role'] = $user['user_id'] == 1 ? 'admin' : 'customer';
    $_SESSION['user_id'] = $user['user_id'];
    $_SESSION['fname'] = $user['fname'];
    $_SESSION['lname'] = $user['lname'];
    $_SESSION['email'] = $user['email'];
    $_SESSION['login_success'] = true;


    if(basename($_SERVER['HTTP_REFERER'], ".php") == 'login') { 
        header("Location: ../../index.php");
        exit();
    }
    
    header("Location: ../../index.php?login=true");
    exit();

} else {
    
    $_SESSION['login_success'] = false;
    header("Location: ../../login.php");
    exit();
}
