<?php

    $favorites = getFavoritedProducts();
?>

<div class="action-menu__content-item favorites">
    <div class="favorites__wrapper">
        <?php if(isset($_SESSION['user_id'])) : ?>
            <?php if(empty($favorites)) : ?>
            <div class="favorites__empty-content">
                <span class="favorites__empty-text">Your favorites is empty</span>
                <a href="./shop.php" class="button-link favorites__explore">Explore</a>
            </div>
            <?php else : ?>
                <div class="favorites__content">
                <?php foreach($favorites as $favorite) : ?>
                    <?php 
                    $favoriteProduct = getProductById($favorite['product_id']); 
                    createProductCard($favoriteProduct);
                    ?>
                <?php endforeach; ?>
                </div>
            <?php endif; ?>
        <?php else : ?>
            <div class="favorites__empty-content">
                <span class="favorites__empty-text">Your favorites is empty</span>
                <button class="button-link favorites__not-logged-button">Log in or create an account</button>
            </div>
        <?php endif; ?>
    </div>
</div>
