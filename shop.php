<?php 

session_start();

require './includes/templates.php';
require './includes/icons.php';
require './includes/config.php';
require './includes/db-utils.php';


$title = "INSPEC®"; 
if(isset($_GET['type'])) {
    $type = $_GET['type'];
    $shopHeader = ucfirst($type);
    $sunglassesSubtitle = 'Discover our collection of sunglasses, crafted with precision lenses for crystal-clear vision.';
    $eyeglassesSubtitle = 'Elevate your style while protecting your eyes with our premium eyeglasses.';
    $shopSubtitle = $type === 'sunglasses' ? $sunglassesSubtitle : $eyeglassesSubtitle;
    $products = getSortedProducts($type, 'DESC'); // DESC by default
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title><?php echo $title; ?></title>
    <script type="module" src="./assets/js/pages/shop.js" defer></script>
    <link rel="shortcut icon" href="./assets/images/icons/favicon.ico" type="image/x-icon">
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
            <?php require './includes/components/shop-toolbar.php'?>
            <main class="product-catalog">
                <?php foreach($products as $product) createProductCard($product);?>
            </main>
        </section>
    </div>
    <?php require './includes/components/footer.php'?>
    <div id="snackbar"></div>
</body>
</html>