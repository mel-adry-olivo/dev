

<div class="action-menu__content-item bag">  
    <div class="bag__wrapper">
        <?php if(isset($_SESSION['user_id'])) : ?>
            <?php if(empty($bag)) : ?>
            <div class="bag__content">
                <div class="bag__empty-content">
                    <span class="bag__empty-text">Your bag is empty</span>
                    <a href="./shop.php" class="button-link explore">Explore</a>
                </div>
            </div>
            <?php else : ?>
                <div class="bag__content">
                <?php foreach($bag as $bagproduct) : ?>
                    <?php createBagCard($bagproduct); ?>
                <?php endforeach; ?>
                </div>
            <?php endif; ?>
            <div class="bag__footer">
                <div class="bag__total-wrapper">
                    <span class="bag__total-text">Subtotal</span>
                    <span class="bag__total">₱0.00</span>
                </div>
                <a href="./summary.php" class="button button--filled-dark bag__checkout">Proceed to Reservation</a>
            </div>
        <?php else : ?>
            <div class="bag__content">
                <div class="bag__empty-content">
                    <span class="bag__empty-text">Your bag is empty</span>
                    <button class="button-link bag__not-logged-button">Log in or create an account</button>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>