<?php 

require './includes/functions.php';
require './includes/icons.php';
require './includes/db-connect.php';
require './includes/db-utils.php';

$title = "INSPEC®"; 
if(isset($_GET['type'])) {
    $type = $_GET['type'];
    $shopHeader = ucfirst($type);
    $shopSubtitle = $type === 'sunglasses' ? 
    'Elevate your style while protecting your eyes with our premium sunglasses.' 
    : 
    'Discover our collection of eyeglasses, crafted with precision lenses for crystal-clear vision.';
}

session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title><?php echo $title; ?></title>
    <script type="module" src="./assets/js/shop.js" defer></script>
    <?php require './includes/style-loader.php'?>
</head>
<body>
    <div class="wrapper">
        <?php require './includes/components/header.php'?>
        <?php require './includes/components/action-menu.php'?>
        <section class="shop">
            <header class="shop__header">
                <div class="shop__header-text-wrapper">
                    <span class="shop__header-title"><?php echo $shopHeader; ?></span>
                    <span class="shop__header-subtitle"><?php echo $shopSubtitle; ?></span>
                </div>
            </header>
            <?php require './includes/components/shop-filter.php'?>
            <main class="product-catalog">
                <!-- Where product card goes  -->
                <?php include './includes/test-products-list.php'; ?>
            </main>
        </section>
    </div>
</body>
</html>