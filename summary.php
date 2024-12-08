<?php

session_start();

require './includes/templates.php';
require './includes/icons.php';
require './includes/db-utils.php';

$conn = require './includes/db-conn.php';

if(!isset($_SESSION['user_id'])) {
    header("Location: ./index.php");
    exit();
}

if (!isset($_SESSION['referer']) ) {
    $_SESSION['referer'] = $_SERVER['HTTP_REFERER'];
}

$userId = $_SESSION['user_id'] ?? null;
$bag = getBagProducts($conn, $userId);
$count = count($bag);   
$title = 'Bag | INSPEC®';

$totalPrice = 0;
foreach($bag as $bagproduct) {
    $totalPrice += $bagproduct['price'];
}
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
                <a href="<?php echo $_SESSION['referer'] ?? './'; ?>" class="bag__summary-back">
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
                        <h6 class="bag__summary-title">Your Bag</h6>
                        <span class="bag__summary-count">
                            <?php 
                            echo $count; 
                            echo $count === 1 ? ' Product' : ' Products'; 
                            ?> 
                        </span>
                    </div>
                    <?php if (empty($bag)) : ?>
                        <span class="bag__empty-text">Your bag is empty</span>
                    <?php else : ?> 
                        <?php foreach($bag as $bagproduct) : ?>
                            <?php createBagCard($bagproduct); ?>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </main>
            <footer>
                <div class="bag__total-wrapper">
                    <h6 class="bag__total-title">Total</h6>
                    <div class="bag__subtotal-wrapper">
                        <span class="bag__subtotal-text">Subtotal</span>
                        <span class="bag__subtotal">₱<?php echo number_format($totalPrice, '0', '.', ','); ?></span>
                    </div>
                    <form action="./routes/products/bag.php" method="POST" class="bag__reserve-form">
                        <input type="hidden" name="reserve" value="true">
                        <button name="reserve" class="button button--filled-dark bag__reserve" <?php echo empty($bag) ? 'disabled' : ''; ?>>Reserve Now</button>
                    </form>
                </div>
            </footer>
        </div>
    </div>
    <div class="snackbar"></div>
    <div class="page-overlay confirm__overlay"></div>
    <div class="confirm__dialog">
        <h6>Confirm</h6>
        <p class="confirm__message">Message</p>
        <div class="confirm__button-wrapper">
            <button class="confirm__cancel">Cancel</button>
            <button class="button button--filled-dark confirm__ok">Yes</button>
        </div>
    </div>
    <div class="loader-container hidden">
        <div class="loader"></div>
        <span>Processing reservation</span>
    </div>
</body>
</html>