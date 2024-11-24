<?php 

session_start();

require './includes/templates.php';
require './includes/icons.php';
require './includes/config.php';
require './includes/db-utils.php';


$title = "Login | INSPEC®"; 

$message = "";

if(isset($_SESSION['login_success']) && $_SESSION['login_success'] == false) {
    $title = "Invalid Login | INSPEC®";
    $message = "Invalid username or password";
    unset($_SESSION['login_success']);
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
    <?php require './includes/style-loader.php'?>
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
                    <form action="./routes/auth/login.php" method="POST" class="auth__form">
                        <div class="auth__field-group">
                            <input type="text" class="auth__field" placeholder="Name" name="login-email" autocomplete="off"/>
                            <label for="login-email" class="auth__label">Email</label>
                        </div>
                        <div class="auth__field-group">
                            <input type="password" class="auth__field" placeholder="Password" name="login-password" autocomplete="off"/>
                            <label for="login-password" class="auth__label">Password</label>
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
                    <form action="./routes/auth/register.php" method="POST" class="auth__form">
                        <div class="auth__field-group">
                            <input type="text" class="auth__field" placeholder="Name" name="register-fname" autocomplete="off"/>
                            <label for="register-fname" class="auth__label">First Name</label>
                        </div>
                        <div class="auth__field-group">
                            <input type="text" class="auth__field" placeholder="Name" name="register-lname" autocomplete="off"/>
                            <label for="register-lname" class="auth__label">Last Name</label>
                        </div>
                        <div class="auth__field-group">
                            <input type="text" class="auth__field" placeholder="Name" name="register-email" autocomplete="off"/>
                            <label for="register-email" class="auth__label">Email</label>
                        </div>
                        <div class="auth__field-group">
                            <input type="password" class="auth__field" placeholder="Password" name="register-password"autocomplete="off"/>
                            <label for="register-password" class="auth__label">Password</label>
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
    <div id="snackbar"></div>
</body>
</html>