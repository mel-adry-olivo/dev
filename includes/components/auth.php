<div class="auth" data-state="login">
    <div class="auth-login">
        <header class="auth__header">
            <span class="auth__title">Login</span>
            <span class="auth__subtitle">To access your account</span>
            <span class="auth__subtitle">Use 'admin' as email and password for admin access</span>
        </header>
        <form action="./handlers/auth/login.php" method="POST" class="auth__form">
            <div class="auth__field-group">
                <label for="login-email" class="auth__label">Email</label>
                <input type="text" id="login-email" class="auth__field"  name="login-email" autocomplete="off" placeholder="-"/>
            </div>
            <div class="auth__field-group">
                <label for="login-password" class="auth__label">Password</label>
                <input type="password" id="login-password" class="auth__field"  name="login-password" autocomplete="off" placeholder="-"/>
            </div>
            <button type="submit" class="button button--filled-dark auth__submit">Login</button>
        </form>
        <footer class="auth__footer">
            <span class="auth__cta-text">Don't have an account yet?</span>
            <button class="button-link auth__cta-button">Register</button>
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
                <input type="text" id="register-fname" class="auth__field" name="register-fname" autocomplete="off" required/>
            </div>
            <div class="auth__field-group">
                <label for="register-lname" class="auth__label">Last Name</label>
                <input type="text" id="register-lname" class="auth__field"  name="register-lname" autocomplete="off" required/>
            </div>
            <div class="auth__field-group">
                <label for="register-email" class="auth__label">Email</label>
                <input type="email" id="register-email" class="auth__field" name="register-email" autocomplete="off" required/>
            </div>
            <div class="auth__field-group">
                <label for="register-password" class="auth__label">Password</label>
                <input type="password" id="register-password" class="auth__field" name="register-password"autocomplete="off" required/>
            </div>
            <button type="submit" class="button button--filled-dark auth__submit">Create Account</button>
        </form>
        <footer class="auth__footer">
            <span class="auth__cta-text">Already have an account?</span>
            <button class="button-link auth__cta-button">Login</button>
        </footer>
    </div>
</div>


