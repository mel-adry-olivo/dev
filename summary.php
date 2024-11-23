<?php

session_start();

if(isset($_SESSION['user_id'])) {
    // $bag = [
    //     [
    //         "product_id" => 1,
    //         "brand" => "Brand 1",
    //         "name" => "Product 1",
    //         "price" => 100,
    //         "quantity" => 2,
    //         "image_main" => "./assets/images/products/gucci-gg1509o-0.png"
    //     ],
    //     [
    //         "product_id" => 2,
    //         "brand" => "Brand 2",
    //         "name" => "Product 2",
    //         "price" => 200,
    //         "quantity" => 1,
    //         "image_main" => "./assets/images/products/gucci-gg1509o-0.png"
    //     ],
    //     [
    //         "product_id" => 3,
    //         "brand" => "Brand 3",
    //         "name" => "Product 3",
    //         "price" => 300,
    //         "quantity" => 3,
    //         "image_main" => "./assets/images/products/gucci-gg1509o-0.png"
    //     ],
    //     [
    //         "product_id" => 4,
    //         "brand" => "Brand 4",
    //         "name" => "Product 4",
    //         "price" => 400,
    //         "quantity" => 1,
    //         "image_main" => "./assets/images/products/gucci-gg1509o-0.png"
    //     ]
    // ];
}



require './includes/templates.php';
require './includes/icons.php';
require './includes/config.php';
require './includes/db-utils.php';

$title = 'Bag | INSPEC®';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>
    <link rel="shortcut icon" href="./assets/images/icons/favicon.ico" type="image/x-icon">
    <script type="module" src="./assets/js/pages/summary.js" defer></script>
    <?php require './includes/style-loader.php'?>
</head>
<body>
    <div class="wrapper">
        <div class="bag__summary">
            <header class="bag__summary-header">
                <a href="<?php echo $_SERVER['HTTP_REFERER'] ?? './index.php'; ?>" class="bag__summary-back">
                    <span class="icon-container bag__summary-back-icon"><?php echo getIcon("arrow-left"); ?></span>
                    <span class="bag__summary-back-text">Back</span>
                </a>
                <div class="header__logo">
                    <a href="./index.php">
                        <img src="./assets/images/icons/logo-xsmall.png" alt="Inspec Logo" width="66" height="16">
                    </a>
                </div>  
            </header>
            <main class="bag__summary-content">
                <div class="bag__summary-products">
                    <div class="bag__summary-content-header">
                        <h6 class="bag__summary-title">Bag Summary</h6>
                        <span class="bag__summary-count">0 items</span>
                    </div>
                    <?php foreach($bag as $bagproduct) : ?>
                        <?php createBagCard($bagproduct); ?>
                    <?php endforeach; ?>
                </div>
                <div class="bag__total-wrapper">
                    <h6 class="bag__total-title">Total</h6>
                    <div class="bag__subtotal-wrapper">
                        <span class="bag__subtotal-text">Subtotal</span>
                        <span class="bag__subtotal">₱0.00</span>
                    </div>
                    <a class="button button--filled-dark bag__checkout">Proceed to Reservation</a>
                </div>
            </main>
        </div>
    </div>
    <?php // require './includes/components/footer.php'?>
    <div id="snackbar"></div>
</body>
</html>