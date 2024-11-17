<?php 

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

function createProductCard($product) {
    $productId = $product["product_id"];
    $imagePath = $product["image_main"];
    $brand = $product["brand"];
    $name = $product["name"];
    $price = $product["price"];
    $favoriteUnchecked = getIcon("heart");
    $favoriteChecked = getIcon("heart-filled");

    echo
    <<<HTML
        <a href="./product.php?id=$productId" class="product__card">  
            <div class="product__image-container">
                <img src="$imagePath" alt="" class="product__image" width="316" height="">
                <button class="product__favorite-button" data-tooltip="Add to favorites">
                    <span class="product__favorite-icon product__favorite-icon--unchecked">$favoriteUnchecked</span>
                    <span class="product__favorite-icon product__favorite-icon--checked" data-tooltip="Remove from favorites">$favoriteChecked</span>
                </button>
            </div>
            <div class="product__text-wrapper">
                <span class="product__brand">$brand</span>
                <span class="product__name">$name</span>
                <span class="product__price">$price</span>
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
            <span class="shop__dropdown-button-text">$formattedCategory</span>
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

function createReviewCard($review) {
    $name = $review["name"];
    $date = $review["created_at"];
    $rating = $review["rating"];
    $text = $review["review_text"];
    $ratingHTML = createRatingStars($rating);

    echo
    <<<HTML
        <div class="product__review-card">
            <div class="product__review-card-header">
                <div class="product__review-card-text">
                    <span class="product__review-card-name">$name</span>
                    <span class="product__review-card-date">$date</span></span>
                </div>
                <div class="product__review-card-stars">
                    $ratingHTML
                </div>
            </div>
            <div class="product__review-card-body">
                <p class="product__review-card-text">
                    $text
                </p>
            </div>
        </div>
    HTML;
}

function createRatingStars($rating) {
    $ratingHTML = '';

    $starEmpty = getIcon("star-empty");
    $starHalf = getIcon("star-half");
    $starFilled = getIcon("star-filled");

    $emptyStarHTML = '<span class="icon-container product__review-rating">' . $starEmpty. '</span>';
    $halfStarHTML = '<span class="icon-container product__review-rating">' . $starHalf . '</span>';
    $fullStarHTML = '<span class="icon-container product__review-rating">' . $starFilled . '</span>';

    $fullStars = floor($rating); 
    $halfStars = ($rating != $fullStars) ? 1 : 0; 
    $emptyStars = 5 - $fullStars - $halfStars; 


    for ($i = 0; $i < $fullStars; $i++) {
        $ratingHTML .= $fullStarHTML;

    }

    if ($halfStars == 1) {
        $ratingHTML .= $halfStarHTML;

    }

    for ($i = 0; $i < $emptyStars; $i++) {
        $ratingHTML .= $emptyStarHTML;
    }


    return $ratingHTML;
}

function logger($message) {
    echo "<script>console.log('$message')</script>";

}