<script type="module">
    import { showSnackbar } from "./assets/js/components/snackbar.js";
    <?php if (isset($_SESSION['login_success']) && $_SESSION['login_success'] === true): ?>
        showSnackbar("You have successfully logged in.");
    <?php elseif (isset($_SESSION['login_success']) && $_SESSION['login_success'] === false): ?>
        showSnackbar("Invalid credentials.");
    <?php endif; ?>
    <?php unset($_SESSION['login_success']); ?>
</script>