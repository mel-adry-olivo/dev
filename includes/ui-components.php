<?php

function createProductCard($conn,$product) {

    $userId = $_SESSION["user_id"] ?? null;
    $productId = $product["product_id"];
    $imagePath = $product["image_main"];
    $imageAlt = $product["image_alternate"];
    $brand = $product["brand"];
    $name = $product["name"];
    $price = $product["price"];
    $favoriteUnchecked = getIcon("heart");
    $favoriteChecked = getIcon("heart-filled");
    $isFavorite = isProductFavorite($conn, $productId, $userId) ? 'active' : '';
    $tooltip = $isFavorite ? 'Remove from favorites' : 'Add to favorites';

    echo
    <<<HTML
        <a href="./product.php?id=$productId" class="product__card" data-id="$productId">
            <div class="product__image-container">
                <img src="$imagePath" alt="$name" class="product__image product__image--main" width="316" >
                <img src="$imageAlt" alt="$name" class="product__image product__image--alternate" width="316" >
                <button class="product__favorite-button $isFavorite" data-tooltip="$tooltip" data-id="$productId">
                    <span class="product__favorite-icon product__favorite-icon--unchecked">$favoriteUnchecked</span>
                    <span class="product__favorite-icon product__favorite-icon--checked" data-tooltip="Remove from favorites">$favoriteChecked</span>
                </button>
            </div>
            <div class="product__text-wrapper">
                <span class="product__brand">$brand</span>
                <span class="product__name">$name</span>
                <span class="product__price">₱$price</span>
            </div>
        </a>
    HTML;
}

function createFavoriteCard($product) {

    $productId = $product["product_id"];
    $imagePath = $product["image_main"];
    $brand = $product["brand"];
    $name = $product["name"];
    $price = $product["price"];
    $close = getIcon("close");


    echo
    <<<HTML
        <div class="product__favorite-card" data-id="$productId">
            <button class="icon-container product__card-close" data-id="$productId">$close</button>
            <div class="product__image-container">
                <img src="$imagePath" alt="" class="product__image" width="316" height="">
            </div>
            <div class="product__favorite-info">
                <div class="product__favorite-text-wrapper">
                    <span class="product__favorite-brand">$brand</span>
                    <a  href="./product.php?id=$productId" class="product__favorite-name">$name</a>
                </div>
                <form action="./handlers/products/bag.php" method="POST" class="product__favorite-form">
                    <input type="hidden" name="product_id" value="$productId">
                    <input type="hidden" name="add" value="add">
                    <button class="button-link product__favorite-action" type="submit">Add to bag</button>
                </form>
            </div>
            <span class="product__favorite-price">₱$price</span>
        </div>
    HTML;
}

function createBagCard($product) {
    $productId = $product["product_id"];
    $imagePath = $product["image_main"];
    $brand = $product["brand"];
    $name = $product["name"];
    $price = $product["price"];
    $close = getIcon("close");

    echo
    <<<HTML
        <div class="product__bag-card" data-id="$productId">
            <form action="./handlers/products/bag.php" method="POST" class="product__bag-close-form">
                <input type="hidden" name="remove">
                <input type="hidden" name="product_id" value="$productId">
                <button type="submit" name="remove" class="icon-container product__bag-close" data-id="$productId">$close</button>
            </form>
            <div class="product__image-container">
                <img src="$imagePath" alt="" class="product__image" width="316" height="">
            </div>
            <div class="product__favorite-info">
                <div class="product__favorite-text-wrapper">
                    <span class="product__favorite-brand">$brand</span>
                    <a  href="./product.php?id=$productId" class="product__favorite-name">$name</a>
                </div>
                <span class="product__bag-price">₱$price</span>
            </div>
        </div>
    HTML;
}

function createReservationCard($product) {
    $productId = $product["product_id"];
    $imagePath = $product["image_main"];
    $brand = $product["brand"];
    $name = $product["name"];
    $price = $product["price"];
    $close = getIcon("close");

    echo
    <<<HTML
        <div class="product__bag-card" data-id="$productId">
            <form action="./handlers/products/reservation.php" method="POST" class="product__reserve-close-form">
                <input type="hidden" name="remove">
                <input type="hidden" name="product_id" value="$productId">
                <button type="submit" name="remove" class="icon-container product__bag-close" data-id="$productId">$close</button>
            </form>
            <div class="product__image-container">
                <img src="$imagePath" alt="" class="product__image" width="316" height="">
            </div>
            <div class="product__favorite-info">
                <div class="product__favorite-text-wrapper">
                    <span class="product__favorite-brand">$brand</span>
                    <a  href="./product.php?id=$productId" class="product__favorite-name">$name</a>
                </div>
                <span class="product__bag-price">₱$price</span>
            </div>
        </div>
    HTML;
}

function createReviewCard($review) {
    $reviewId = $review['review_id'];
    $productId = $review['product_id'];
    $name = $review["fname"] . " " . $review["lname"];
    $userId = $review["user_id"];
    $date = $review["created_at"];
    $formattedDate = date("F j, Y", strtotime($date));
    $rating = $review["rating"];
    $text = $review["review_text"];
    $ratingHTML = createRatingStars($rating);
    $closeIcon = getIcon('close');

    $currentUser = $_SESSION['user_id'] ?? '';
    $role = $_SESSION['role'] ?? '';
    $isAdmin = $role == 'admin' ?? 'customer';

    if(isset($currentUser)) {
        $hasClose = $userId == $currentUser || $isAdmin;
        $isCurrentUser = $hasClose  ? '<button  class="product__review-close">'. $closeIcon .'</button>' : '';
        $deleteForm =
        <<<HTML
            <form class="product__review-close-form" method="post" action="./handlers/products/reviews.php">
                <input type="hidden" name="action" value="remove"/>
                <input type="hidden" name="review_id" value="$reviewId"/>
                <input type="hidden" name="product_id" value="$productId"/>
                $isCurrentUser
            </form>
        HTML;
    }



    echo
    <<<HTML
        <div class="product__review-card" data-user-id="$userId">
            <div class="product__review-card-header">
                <div class="product__review-card-text">
                    <span class="product__review-card-name">$name</span>
                    <span class="product__review-card-date">$formattedDate</span>

                </div>
                $deleteForm
            </div>
            <div class="product__review-card-stars">
                    $ratingHTML
                </div>
            <div class="product__review-card-body">
                <p class="product__review-card-text">
                    $text
                </p>
            </div>
        </div>
    HTML;
}


function createShapeItem($shape) {
    $imagePath = $shape["image"];
    $name = $shape["name"];
    $bagIcon = getIcon("bag");
    $arrowIcon = getIcon("arrow-right");

    echo
    <<<HTML
        <a href="#" class="shapes__item">
            <img src="$imagePath" alt="$name" class="shapes__item-image">
            <div class="shapes__item-link">
                <div class="icon-container shapes__item-icon">$bagIcon</div>
                <span class="shapes__item-text">$name</span>
                <div class="shapes__item-arrow">$arrowIcon</div>
            </div>
        </a>
    HTML;
}

function createFilterCategory($category, $items) {

    $formattedCategory = ucwords(str_replace('_', ' ', $category));
    $downArrow = getIcon("arrow-down");
    $check = getIcon("check");
    $itemsHTML = '';

    foreach($items as $item) {
        $itemsHTML .= "<li class='shop__dropdown-item' filter='$category' data-value='$item'>
                          <span class='icon-container shop__dropdown-icon'>$check</span>
                          <button>". $item . "</button>
                       </li>";
    }

    echo
    <<<HTML
    <li class="shop__filter-category">
        <button class="shop__dropdown-button">
            <span class="shop__dropdown-button-text" data-text='$formattedCategory'>$formattedCategory</span>
            <span class="icon-container shop__dropdown-icon">$downArrow</span>
        </button>
        <div class="shop__dropdown-container">
            <div class="shop__dropdown-content">
                <ul class="shop__dropdown-items">
                    $itemsHTML
                </ul>
            </div>
        </div>
    </li>
    HTML;
}


function createRatingStars($rating, $class = null) {
    $ratingHTML = '';

    $class = $class === null ? 'product__review-rating' : $class;

    $starEmpty = getIcon("star-empty");
    $starFilled = getIcon("star-filled");

    $emptyStarHTML = '<span class="icon-container '. $class .'">' . $starEmpty. '</span>';
    $fullStarHTML = '<span class="icon-container '. $class .'">' . $starFilled . '</span>';

    $fullStars = $rating;
    $emptyStars = 5 - $fullStars;

    for ($i = 0; $i < $fullStars; $i++) {
        $ratingHTML .= $fullStarHTML;

    }

    for ($i = 0; $i < $emptyStars; $i++) {
        $ratingHTML .= $emptyStarHTML;
    }

    return $ratingHTML;
}
