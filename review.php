<?php 

session_start();

require './includes/templates.php';
require './includes/icons.php';
require './includes/config.php';
require './includes/db-utils.php';

if(isset($_GET['id'])) {
    $id = $_GET['id'];
    $product = getProductById($id);
    $productAttributes = getProductAttributesByID($id);
}


$title = 'Review | INSPEC®';
$reviews = getProductReviewsByDate($id);
$averageRating = getAverageRating($id);
$count = getProductReviewCount($id);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>
    <script type="module" src="./assets/js/pages/review.js" defer></script>
    <link rel="shortcut icon" href="./assets/images/icons/favicon.ico" type="image/x-icon">
    <?php require './includes/style-loader.php'?>
</head>
<body>
<div class="wrapper">
        <?php require './includes/components/header.php'?>
        <?php require './includes/components/action-menu.php'?>
        <section class="review">
            <header class="review__header">
                <div class="top-bar">
                    <span class="review__header-title">Ratings & Reviews of <?php echo $product['name']; ?></span>
                    <button class="button-link product__review__button product__write-review">Write Review</button>
                </div>
                <div class="review__statistics-ratings">
                    <div class="product-data">
                        <img class="image" src="<?php echo $product['image_main']?>" alt="">
                        <span class="brand"><?php echo $product['brand']?></span>
                        <span class="name"><?php echo $product['name']?></span>
                    </div>
                    <div class="review__statistics-average">
                        <span class="review__average-label">Average Rating</span>
                        <div class="rating-wrapper">
                            <span class="rating-total"><?php echo $averageRating; ?></span>
                            <div class="rating-stars">
                                <?php echo createRatingStars(floor($averageRating))?>
                            </div>
                            <span class="rating-subtitle"><?php echo $count; ?> Reviews</span>
                        </div>
                    </div>
                </div>
            </header>
            <main class="review__content">
            <?php foreach($reviews as $review) createReviewCard($review)?>
            </main>
        </section>
    </div>
    <div class="snackbar"></div>
    <?php require './includes/components/footer.php'?>
    <?php include './includes/components/confirm-dialog.php';?>
    <?php require './includes/components/review-form.php' ?>

</body>
</html>