<?php

require '../../includes/config.php';
require '../../includes/db-utils.php';

session_start();

$inputEmail = $_POST['login-email'];
$inputPassword = md5($_POST['login-password']);

$user = getUserByEmail($inputEmail);

if($user) {
    $_SESSION['user_id'] = $user['user_id'];
    $_SESSION['fname'] = $user['fname'];
    $_SESSION['lname'] = $user['lname'];
    $_SESSION['email'] = $user['email'];
    $_SESSION['login_success'] = true;

    header("Location: " . ($_SERVER['HTTP_REFERER'] ?? './index.php'));
    exit();
} else {
    
    $_SESSION['login_success'] = false;
    header("Location: " . ($_SERVER['HTTP_REFERER'] ?? './index.php'));
    exit();
}
