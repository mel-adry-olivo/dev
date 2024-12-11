<?php

require '../../includes/db-functions.php';


session_start();

$conn = require '../../includes/db-conn.php';
$inputEmail = $_POST['login-email'];
$inputPassword = md5($_POST['login-password']);

$user = getUserByEmail($conn, $inputEmail);

if($user && $user['password'] == $inputPassword) {

    $_SESSION['role'] = $user['user_id'] == 1 ? 'admin' : 'customer';
    $_SESSION['user_id'] = $user['user_id'];
    $_SESSION['fname'] = $user['fname'];
    $_SESSION['lname'] = $user['lname'];
    $_SESSION['email'] = $user['email'];
    $_SESSION['login_success'] = true;

    
    header("Location: ./../../");
    exit();

} else {
    
    $_SESSION['login_success'] = false;
    header("Location: ../../login.php");
    exit();
}
