<?php 

require '../../includes/config.php';

session_start();

$conn = require '../../includes/db-conn.php';
$inputFname = $_POST['register-fname'];
$inputLname = $_POST['register-lname'];
$inputEmail = $_POST['register-email'];
$inputPassword = md5($_POST['register-password']);

$user = [
    'fname' => $inputFname,
    'lname' => $inputLname,
    'email' => $inputEmail,
    'password' => $inputPassword,
];

if(createUser($conn, $user)) {
    $_SESSION['role'] = $user['user_id'] == 1 ? 'admin' : 'customer';
    $_SESSION['user_id'] = getUserByEmail($conn, $inputEmail)['user_id'];
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
}

