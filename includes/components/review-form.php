<form action="./routes/products/reviews.php?action=create" method="POST" class="review__form">
    <h6 class="review__form-title">Write a review</h6>
    <div class="field-group">
        <label for="review-rating">Rating</label>
        <select name="rating" class="review-rating">
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
        </select>
    </div>
    <div class="field-group">
        <label for="review-text">Review</label>
        <textarea name="text" class="review-text" cols="20" rows="8"></textarea>
    </div>
    <div class="review__button-group">
        <button class="button review__cancel" type="button">Cancel</button>
        <button class="button button--filled-dark review__submit" type="submit">Submit Review</button>
    </div>
    <input type="hidden" name="product_id" value="<?php echo $id; ?>">
</form>
<div class="page-overlay review-overlay"></div>