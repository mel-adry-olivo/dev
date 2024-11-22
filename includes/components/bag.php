<?php
    if(isset($_SESSION['user_id'])) {
        $bag = [
            [
                "product_id" => 1,
                "brand" => "Brand 1",
                "name" => "Product 1",
                "price" => 100,
                "quantity" => 2,
                "image_main" => "./assets/images/products/gucci-gg1509o-0.png"
            ],
            [
                "product_id" => 2,
                "brand" => "Brand 2",
                "name" => "Product 2",
                "price" => 200,
                "quantity" => 1,
                "image_main" => "./assets/images/products/gucci-gg1509o-0.png"
            ],
            [
                "product_id" => 3,
                "brand" => "Brand 3",
                "name" => "Product 3",
                "price" => 300,
                "quantity" => 3,
                "image_main" => "./assets/images/products/gucci-gg1509o-0.png"
            ],
            [
                "product_id" => 4,
                "brand" => "Brand 4",
                "name" => "Product 4",
                "price" => 400,
                "quantity" => 1,
                "image_main" => "./assets/images/products/gucci-gg1509o-0.png"
            ]
        ];
    }
?>

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
    <?php else : ?>
        <div class="bag__content">
            <div class="bag__empty-content">
                <span class="bag__empty-text">Your bag is empty</span>
                <button class="button-link bag__not-logged-button">Log in or create an account</button>
            </div>
        </div>
    <?php endif; ?>
    <button class="button button--filled-dark bag__checkout">Proceed to Reservation</button>
    </div>
</div>