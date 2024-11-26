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
                <span class="review__header-title">Ratings & Reviews of <?php echo $product['name']; ?></span>
                <div class="review__statistics-ratings">
                    <div class="product-data">
                        <img class="image" src="<?php echo $product['image_main']?>" alt="">
                        <span class="brand"><?php echo $product['brand']?></span>
                        <span class="name"><?php echo $product['name']?></span>
                    </div>
                    <div class="review__statistics-average">
                        <span class="review__average-label">Average Rating</span>
                        <div class="rating-wrapper">
                            <span class="rating-total">0.0</span>
                            <div class="rating-stars">
                                <span class="icon-container rating-star">&#9733</span>
                                <span class="icon-container rating-star">&#9733</span>
                                <span class="icon-container rating-star">&#9733</span>
                                <span class="icon-container rating-star">&#9733</span>
                                <span class="icon-container rating-star">&#9733</span>
                            </div>
                            <span class="rating-subtitle">1213 Reviews</span>
                        </div>
                    </div>
                </div>
            </header>
            <main class="review__content">
                
            </main>
        </section>
    </div>
    <div id="snackbar"></div>
    <?php require './includes/components/footer.php'?>

</body>
</html>