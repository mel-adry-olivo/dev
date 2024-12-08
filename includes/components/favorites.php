<?php
    
    if(isset($_SESSION['user_id'])) {
        $userId = $_SESSION['user_id'];
        $favorites = getFavoritedProducts($conn, $userId);
        $favoriteProducts = [];
    }
?>
<div class="action-menu__content-item favorites">
    <div class="favorites__wrapper">
        <?php if(isset($_SESSION['user_id'])) : ?>
            <?php if(empty($favorites)) : ?>
            <div class="favorites__content">
                <div class="favorites__empty-content">
                    <span class="favorites__empty-text">Your favorites is empty</span>
                    <a href="./shop.php?type=sunglasses" class="button-link explore">Explore</a>
                </div>
            </div>
            <?php else : ?>
                <div class="favorites__content">
                <?php foreach($favorites as $favorite) : ?>
                    <?php createFavoriteCard($favorite); ?>
                <?php endforeach; ?>
                </div>
            <?php endif; ?>
        <?php else : ?>
            <div class="favorites__content">
                <div class="favorites__empty-content">
                    <span class="favorites__empty-text">Your favorites is empty</span>
                    <button class="button-link favorites__not-logged-button">Log in or create an account</button>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>
