<?php
    if(isset($_SESSION['user_id'])) {
        // $favorites = getFavoritedProducts($_SESSION['user_id']);
        // $favoriteProducts = [];
        $bag = [];
    }
?>
<div class="action-menu__content-item bag">  
    
    <?php if(isset($_SESSION['user_id'])) : ?>
            <?php if(empty($bag)) : ?>
            <div class="bag__wrapper">
                <div class="bag__content">
                    <div class="bag__empty-content">
                        <span class="bag__empty-text">Your bag is empty</span>
                        <a href="./shop.php" class="button-link explore">Explore</a>
                    </div>
                </div>
            </div>
            <?php else : ?>
                <div class="bag__content">
                    <!-- Bag content -->
                </div>
            <?php endif; ?>
        <?php else : ?>
            <div class="bag__wrapper">
                <div class="bag__content">
                    <div class="bag__empty-content">
                        <span class="bag__empty-text">Your bag is empty</span>
                        <button class="button-link bag__not-logged-button">Log in or create an account</button>
                    </div>
                </div>
            </div>
        <?php endif; ?>
</div>