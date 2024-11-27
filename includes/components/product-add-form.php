<form action="#" method="POST" class="product__add-form">
    <h6 class="add__form-title">Add a product</h6>
    <div class="image-container">
        <div class="image-main-container">

        </div>
        <div class="image-secondary-container">
            
        </div>
    </div>
    <div class="file-chooser">
        <div class="file-chooser-item">
            <label for="product-image">Choose Image 1</label>
            <input type="file" name="product-image" id="product-image" accept="image/*">
        </div>
        <div class="file-chooser-item">
            <label for="product-image">Choose Image 2</label>
            <input type="file" name="product-image" id="product-image" accept="image/*">
        </div>
    </div>
    <div class="field-group">
        <label for="product-name">Product Name</label>
        <input type="text" name="product-name">
    </div>
    <div class="row-group">
        <div class="field-group">
            <label for="product-type">Type</label>
            <select name="product-type">
                <option value="eyeglasses">Eyeglasses</option>
                <option value="sunglasses">Sunglasses</option>
            </select>
        </div>
        <div class="field-group">
            <label for="product-gender">Gender</label>
            <select name="product-gender">
                <option value="men">Men</option>
                <option value="women">Women</option>
                <option value="unisex">Unisex</option>
            </select>
        </div>
    </div>
    <div class="row-group flex-1">
        <div class="field-group">
            <label for="product-price">Price</label>
            <input 
                type="number" 
                name="product-price" 
                value="0" 
                onInput="event.target.value = event.target.value.replace(/[^0-9]/g, '')" 
                min="0" 
                step="1">
        </div>
        <div class="field-group">
            <label for="product-stocks">Stocks</label>
            <input type="number" name="product-stocks" value="0">
        </div>
    </div>
    <div class="add__button-group">
        <button class="button add__cancel" type="button">Cancel</button>
        <button class="button button--filled-dark add__submit" type="submit">Add Product</button>
    </div>
    <input type="hidden" name="action" value="create">
    <input type="hidden" name="product_id" value="<?php echo $product['product_id']; ?>">
</form>
<div class="page-overlay add-product-overlay"></div>