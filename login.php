<?php

session_start();

require './includes/ui-components.php';
require './includes/icons.php';
require './includes/db-functions.php';


$title = "Login | INSPEC®";
$message = "";

if(isset($_SESSION['login_success']) && $_SESSION['login_success'] == false) {
    $title = "Invalid Login | INSPEC®";
    $message = "Invalid username or password";
    unset($_SESSION['login_success']);
}

if(isset($_SESSION['register_error'])) {
    $title = "Registration Error | INSPEC®";
    $message = "Registration Error. User already exists.";
    unset($_SESSION['register_error']);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title><?php echo $title; ?></title>
    <script type="module" src="./assets/js/pages/login.js" defer></script>
    <link rel="shortcut icon" href="./assets/images/icons/favicon.ico" type="image/x-icon">
    <link rel="preload" href="./assets/styles/fonts/Satoshi-Regular.woff2" as="font" type="font/woff2" crossorigin>
    <link rel="preload" href="./assets/styles/fonts/Satoshi-Light.woff2" as="font" type="font/woff2" crossorigin>
    <link rel="preload" href="./assets/styles/fonts/Satoshi-Medium.woff2" as="font" type="font/woff2" crossorigin>
    <link href="./assets/styles/global/global.css" rel="stylesheet"/>
    <link href="./assets/styles/global/components.css" rel="stylesheet"/>
    <link href="./assets/styles/pages/login.css" rel="stylesheet"/>
</head>
<body>
    <div class="wrapper">
        <?php require './includes/components/header.php'?>
        <?php require './includes/components/action-menu.php'?>
        <section class="login">
            <span class="login__message"><?php echo $message; ?></span>
            <div class="form" data-state="login">
                <div class="auth-login">
                    <header class="auth__header">
                        <span class="auth__title">Login</span>
                        <span class="auth__subtitle">To access your account</span>
                    </header>
                    <form action="./handlers/auth/login.php" method="POST" class="auth__form">
                        <div class="auth__field-group">
                            <label for="login-email" class="auth__label">Email</label>
                            <input type="text" id="loginp-email" class="auth__field" name="login-email" autocomplete="off"/>
                        </div>
                        <div class="auth__field-group">
                            <label for="login-password" class="auth__label">Password</label>
                            <input type="password" id="loginp-password" class="auth__field" name="login-password" autocomplete="off"/>
                        </div>
                        <button type="submit" class="button button--filled-dark auth__submit">Login</button>
                    </form>
                    <footer class="auth__footer">
                        <span class="auth__cta-text">Don't have an account yet?</span>
                        <button class="button-link auth__cta-button-register">Register</button>
                    </footer>
                </div>
                <div class="auth-register">
                    <header class="auth__header">
                        <span class="auth__title">Register</span>
                        <span class="auth__subtitle">Create an account</span>
                    </header>
                    <form action="./handlers/auth/register.php" method="POST" class="auth__form">
                        <div class="auth__field-group">
                            <label for="register-fname" class="auth__label">First Name</label>
                            <input type="text" id="registerp-fname" class="auth__field" name="register-fname" autocomplete="off" required/>
                        </div>
                        <div class="auth__field-group">
                            <label for="register-lname" class="auth__label">Last Name</label>
                            <input type="text" id="registerp-lname" class="auth__field" name="register-lname" autocomplete="off" required/>
                        </div>
                        <div class="auth__field-group">
                            <label for="register-email"  class="auth__label">Email</label>
                            <input type="text" id="registerp-email" class="auth__field" name="register-email" autocomplete="off" required>
                        </div>
                        <div class="auth__field-group">
                            <label for="register-password"  class="auth__label">Password</label>
                            <input type="password" id="registerp-password" class="auth__field" name="register-password"autocomplete="off" required/>
                        </div>
                        <button type="submit" class="button button--filled-dark auth__submit">Create Account</button>
                    </form>
                    <footer class="auth__footer">
                        <span class="auth__cta-text">Already have an account?</span>
                        <button class="button-link auth__cta-button-login"/>Login</button>
                    </footer>
                </div>
            </div>
        </section>
    </div>
    <?php require './includes/components/footer.php'?>
    <?php include './includes/components/confirm-dialog.php';?>
    <div class="snackbar"></div>
</body>
</html>