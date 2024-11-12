<div class="action-menu__content-item user" data-state="login">
    <div class="user__content">
        <?php 
        require isset($_SESSION['user_id']) ? 
        './includes/components/profile.php' : './includes/components/auth.php';
        ?>
    </div>
</div>