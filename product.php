<?php

session_start();

require './includes/templates.php';
require './includes/icons.php';
require './includes/db-utils.php';
require './includes/utils.php';

$conn = require './includes/db-conn.php';
$isFavorite = '';

if(isset($_SESSION['in_bag'])) {
    $inBag = $_SESSION['in_bag'];
    unset($_SESSION['in_bag']);
}

if(isset($_GET['id'])) {
    $id = $_GET['id'];
    $product = getProductById($conn, $id);
    $productAttributes = getProductAttributesByID($conn, $id);
    $title = $product['brand'] . ' ' . $product['name'] . ' | INSPEC®';
}

if(isset($_SESSION['user_id'])) {
    $userId = $_SESSION['user_id'];
    $isFavorite = isProductFavorite($conn, $id, $userId) ? 'active' : '';
}


$tooltip = $isFavorite ? 'Remove from favorites' : 'Add to favorites';
$reviews = getLimitedProductReviews($conn, $id, 2);
$averageRating = getAverageRating($conn, $id);
$count = getProductReviewCount($conn, $id);
$productsByBrand = getProductsByBrand($conn, $product['brand']);
$productsByBrand = array_filter($productsByBrand, function ($product) use ($id) {
    return $product['product_id'] !== $id;
});
    
$productsByShape = getProductsByShape($conn, $productAttributes['Shape']);
$productsByShape = array_filter($productsByShape, function ($product) use ($id) {
    return $product['product_id'] !== $id;
});


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>
    <script type="module" src="./assets/js/pages/product.js" defer></script>
    <link rel="shortcut icon" href="./assets/images/icons/favicon.ico" type="image/x-icon">
    <?php require './includes/style-loader.php'?>
</head>
<body>
    <div class="wrapper">
        <?php require './includes/components/header.php'?>
        <?php require './includes/components/action-menu.php'?>
        <section class="product">
            <div class="product__images">
                <div class="product__image-container--main">
                    <img src="<?php echo $product['image_main']; ?>" alt="" />
                </div>
                <div class="product__image-container--alternate">
                    <img src="<?php echo $product['image_alternate']; ?>" alt="" />
                </div>
            </div>  
            <div class="product__info">
                <div class="product__info-header">
                    <div class="product__info-header-text">
                        <h6 class="product__info-brand"><?php echo $product['brand']; ?></h6>
                        <h6 class="product__info-name"><?php echo $product['name']; ?></h6>
                        <span class="product__info-subtext">
                            <?php 
                                echo $productAttributes['Color'] . " " . 
                                     $productAttributes['Shape'] . " " .  
                                     $productAttributes['Gender'] . " " . 
                                     $product['type']; ?>
                        </span>
                    </div>
                    <button class="product__favorite-button product__info-favorite <?php echo $isFavorite; ?>" data-tooltip="<?php echo $tooltip; ?>" data-action="favorites" data-id="<?php echo $product['product_id']; ?>">
                        <span class="product__favorite-icon product__favorite-icon--unchecked "> <?php echo getIcon("heart"); ?> </span>
                        <span class="product__favorite-icon product__favorite-icon--checked" data-tooltip="Remove from favorites"><?php echo getIcon("heart-filled"); ?></span>
                    </button>
                </div>
                <div class="product__info-main">
                    <span class="product__info-price">₱<?php echo number_format($product['price'], '0', '.', ','); ?></span>
                    <div class="product__info-ratings">
                        <div class="product__info-stars-wrapper">
                            <?php echo createRatingStars(floor($averageRating), 'product__info-rating'); ?>
                        </div>
                        <span class="product__info-reviews-count"><?php echo $count; ?> Reviews</span>
                    </div>
                </div>
                <form action="./routes/products/bag.php" method="POST" class="product__info-form">
                    <input type="hidden" name="product_id" value="<?php echo $product['product_id']; ?>">
                    <input type="hidden" name="add" value="add">
                    <button type='submit' class="button button--filled-dark product__add-button">Add to Bag</button>
                </form>
                <?php if(isset($inBag)) : ?>
                <span class="product__info-in-bag-text">Product is already in your bag</span>
                <?php endif ?>
                <span class="product__info-reservation-count"><?php echo $product['reserve_count']; ?> Reserved</span>
                <span class="product__info-reminder">You can only reserve 1 unit at a time</span>
                <div class="product__info-others">
                    <div class="product__info-others-item">
                        <span class="product__info-other-title">Size & Fit</span>
                        <span class="product__info-sizes">
                            <?php echo "Lens Width: " . $product['lens_width'] . " mm, Bridge Width: " . $product['bridge_width'] . " mm, Temple Length: " . $product['temple_length'] . " mm"; ?>
                        </span>
                    </div>
                    <div class="product__info-others-item">
                        <header class="product__info-others-header">
                            <span class="product__info-other-title">User Reviews</span>
                            <div class="review-forms">
                                <a href="./review.php?id=<?php echo $product['product_id']; ?>" class="button-link product__info-other-button">View All</a>
                                <button class="button-link product__info-other-button product__write-review">Write Review</button>
                            </div>
                        </header>
                        <div class="product__info-reviews">
                            <?php foreach($reviews as $review) createReviewCard($review); ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="section section--related">
            <header class="section__header">
                <h5 class="section__header-text">More from the same brand</h5>
            </header>
            <main class="section__content">
                <div class="products__showcase">
                    <?php if(!empty($productsByBrand)) : ?>
                        <div class="products__carousel">
                            <?php foreach($productsByBrand as $product) createProductCard($product); ?>
                        </div>
                        <?php if(count($productsByBrand) > 4) : ?>
                            <div class="products__carousel-control-group">
                                <button class="icon-container products__carousel-control products__carousel-control--prev">
                                    <?php echo getIcon('arrow-left'); ?>
                                </button>
                                <button class="icon-container products__carousel-control products__carousel-control--next">
                                    <?php echo getIcon('arrow-right'); ?>
                                </button>
                            </div>
                        <?php endif; ?>
                    <?php else : ?>
                        <p>No products found</p>
                    <?php endif; ?>
                </div>
            </main>
        </section>  
        <section class="section section--recommended">
            <header class="section__header">
                <h5 class="section__header-text">You may also like</h5>
            </header>
            <main class="section__content">
                <div class="products__showcase">
                    <?php if(!empty($productsByShape)) : ?>
                        <div class="products__carousel">
                            <?php foreach($productsByShape as $product) createProductCard($product); ?>
                        </div>
                        <?php if(count($productsByShape) > 4) : ?>
                            <div class="products__carousel-control-group">
                                <button class="icon-container products__carousel-control products__carousel-control--prev">
                                    <?php echo getIcon('arrow-left'); ?>
                                </button>
                                <button class="icon-container products__carousel-control products__carousel-control--next">
                                    <?php echo getIcon('arrow-right'); ?>
                                </button>
                            </div>
                        <?php endif; ?>
                    <?php else : ?>
                        <p>No products found</p>
                    <?php endif; ?>
                </div>
            </main>
        </section>  
    </div>
    <div class="snackbar"></div>
    <?php require './includes/components/footer.php'?>
    <?php require './includes/components/review-form.php' ?>
    <?php include './includes/components/confirm-dialog.php';?>
</body>
</html>
