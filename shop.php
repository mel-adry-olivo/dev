<?php 

session_start();

require './includes/ui-components.php';
require './includes/icons.php';
require './includes/db-functions.php';


$conn = require './includes/db-conn.php';
$type = $_GET['type'];

switch($_GET['type']) {
    case 'sunglasses':
        $shopHeader = 'Sunglasses';
        $shopSubtitle = 'Discover our collection of sunglasses, crafted with precision lenses for crystal-clear vision.';
        $title = "Sunglasses | INSPEC®"; 
        break;
    case 'eyeglasses':
        $shopHeader = 'Eyeglasses';
        $shopSubtitle = 'Elevate your style while protecting your eyes with our premium eyeglasses.';
        $title = "Eyeglasses | INSPEC®"; 
        break;
    case 'all':
        $shopHeader = 'Shop All';
        $shopSubtitle = 'Discover our collection of sunglasses, eyeglasses, and more, crafted with precision lenses for crystal-clear vision.';
        $title = "Shop | INSPEC®"; 
        break;
}


$products = getProductsbyType($conn, $type);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title><?php echo $title; ?></title>
    <script type="module" src="./assets/js/pages/shop.js" defer></script>
    <link rel="shortcut icon" href="./assets/images/icons/favicon.ico" type="image/x-icon">
    <link href="https://fonts.cdnfonts.com/css/satoshi" rel="stylesheet"/>
    <link href="https://fonts.cdnfonts.com/css/source-serif-pro" rel="stylesheet"/>
    <link href="./assets/styles/global/global.css" rel="stylesheet"/>
    <link href="./assets/styles/global/components.css" rel="stylesheet"/>
    <link href="./assets/styles/pages/shop.css" rel="stylesheet"/>
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
            <?php require './includes/components/shop-toolbar.php'?>
            <main class="product-catalog">
                <?php foreach($products as $product) createProductCard($conn, $product);?>
            </main>
        </section>
    </div>
    <?php require './includes/components/footer.php'?>
    <?php include './includes/components/confirm-dialog.php';?>
    <div class="snackbar"></div>
</body>
</html>