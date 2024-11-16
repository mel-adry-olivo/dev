<?php

require './includes/templates.php';
require './includes/icons.php';
require './includes/db-connect.php';
require './includes/db-utils.php';

session_start();


if(isset($_GET['id'])) {
    $id = $_GET['id'];
    $product = getProductById($id);
    $productAttributes = getProductAttributesByID($id);
    $title = $product['brand'] . ' ' . $product['name'] . ' | INSPEC®';
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>
    <script type="module" src="./assets/js/product.js" defer></script>
    <link rel="shortcut icon" href="./assets/images/icons/favicon.ico" type="image/x-icon">
    <?php require './includes/style-loader.php'?>
</head>
<body>
    <div class="wrapper">
        <?php require './includes/components/header.php'?>
        <?php require './includes/components/action-menu.php'?>
        <section class="product">
            <div class="product__images">
                <div class="product__image-container product__image-container--main">
                    <img src="<?php echo $product['image_main']; ?>" alt="">
                </div>
                <div class="product__image-container product__image-container--alternate">
                    <img src="<?php echo $product['image_alternate']; ?>" alt="">
                </div>
            </div>  
            <div class="product__info">
                <div class="product__info-header">
                    <div class="product__info-header-text">
                        <h6 class="product__info-brand"><?php echo $product['brand']; ?></h6>
                        <h6 class="product__info-name"><?php echo $product['name']; ?></h6>
                        <span class="product__info-subtext">
                            <?php echo $productAttributes['Color'] . " " . $productAttributes['Shape'] . " " .  $productAttributes['Gender'] . " " . $product['type']; ?>
                        </span>
                    </div>
                    <button class="product__favorite-button product__info-favorite" data-tooltip="Add to favorites">
                        <span class="product__favorite-icon product__favorite-icon--unchecked "> <?php echo getIcon("heart"); ?> </span>
                        <span class="product__favorite-icon product__favorite-icon--checked" data-tooltip="Remove from favorites"><?php echo getIcon("heart-filled"); ?></span>
                    </button>
                </div>
                <div class="product__info-main">
                    <span class="product__info-price">₱<?php echo number_format($product['price'], '0', '.', ','); ?></span>
                    <div class="product__info-reviews">
                        <div class="product__info-stars-wrapper">
                            <span class="icon-container product__info-rating"><?php echo getIcon("star-empty"); ?></span>
                            <span class="icon-container product__info-rating"><?php echo getIcon("star-empty"); ?></span>
                            <span class="icon-container product__info-rating"><?php echo getIcon("star-empty"); ?></span>
                            <span class="icon-container product__info-rating"><?php echo getIcon("star-empty"); ?></span>
                            <span class="icon-container product__info-rating"><?php echo getIcon("star-empty"); ?></span>
                        </div>
                        <span class="product__info-reviews-count">0 Reviews</span>
                    </div>
                </div>
                <button class="button button--filled-dark product__add-button">Add to bag</button>
                <span class="product__info-reservation-count"><?php echo $product['reserve_count']; ?> Reserved</span>
                <div class="product__info-others">
                    <div class="product__info-sizes-wrapper">
                        <span class="product__info-sizes-title">Size & Fit</span>
                        <span class="product__info-sizes">
                            <?php echo "Lens Width: " . $product['lens_width'] . " mm, Bridge Width: " . $product['bridge_width'] . " mm, Temple Length: " . $product['temple_length'] . " mm"; ?>
                        </span>
                    </div>
                </div>
            </div>
        </section>
        <section class="review">
            
        </section>
    </div>
</body>
</html>
