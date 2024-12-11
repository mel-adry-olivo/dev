<?php


$brands = getProductBrands($conn);
$materials = getProductMaterials($conn);
$colors = getProductColors($conn);
$shapes = getProductShapes($conn);


?>

<form action="" method="POST" class="product__add-form" enctype="multipart/form-data">
    <div class="main-form">
        <div class="main-details">
            <h6 class="add__form-title">Add a product</h6>
            <div class="image-container">
                <div class="image-main-container">
                </div>
                <div class="image-secondary-container">
                </div>
            </div>
            <div class="file-chooser">
                <div class="file-chooser-item">
                    <label for="product-image">Choose Main Image</label>
                    <input type="file" name="product-image" id="product-image" accept="image/*" placeholder="Please input the main image.">
                </div>
                <div class="file-chooser-item">
                    <label for="product-image2">Choose Alternate Image</label>
                    <input type="file" name="product-image2" id="product-image2" accept="image/*" placeholder="Please input the alternate image.">
                </div>
            </div>
            <div class="row-group brand-group">
                <div class="field-group">
                    <label for="product-brand">Choose from existing brands</label>
                    <select name="product-brand" class="product-select product-brand-select" data-input="new-brand"> 
                        <?php foreach ($brands as $brand) : ?>
                        <option value="<?php echo $brand['brand_id']; ?>"><?php echo $brand['name']; ?></option>
                        <?php endforeach; ?>
                        <option value="new">Add a new brand</option>
                    </select>
                </div>
                <div class="field-group new-brand">
                    <label for="product-brand-input">New Brand</label>
                    <input type="text" name="product-brand-input" placeholder="Please enter a brand">
                </div>
            </div>
            <div class="field-group">
                <label for="product-name">Product Name</label>
                <input type="text" name="product-name" placeholder="Please enter a valid product name">
            </div>
            <div class="row-group">
                <div class="field-group">
                    <label for="product-price">Price</label>
                    <input type="number" name="product-price" value="0" min="0" step="1" placeholder="Please enter a valid price">
                </div>
            </div>
        </div>
        <div class="secondary-details">
            <div class="row-group">
                <div class="field-group">
                    <label for="product-type">Type</label>
                    <select name="product-type">
                        <option value="Eyeglasses">Eyeglasses</option>
                        <option value="Sunglasses">Sunglasses</option>
                    </select>
                </div>
                <div class="field-group">
                    <label for="product-gender">Gender</label>
                    <input type="hidden" name="product-gender-pa" value="">
                    <select name="product-gender">
                        <option value="14">Men</option>
                        <option value="15">Women</option>
                        <option value="16">Unisex</option>
                    </select>
                </div>
            </div>
            <div class="row-group">
                <div class="field-group">
                    <label for="product-lens-width">Lens Width</label>
                    <input type="number" name="product-lens-width" value=0 min="0" step="1" placeholder="Ex: Please input a valid lens-width"> 
                </div>
                <div class="field-group">
                    <label for="product-bridge-width">Bridge Width</label>
                    <input type="number" name="product-bridge-width" value=0 min="0" step="1" placeholder="Ex: Please input a valid bridge-width"> 
                </div>
                <div class="field-group">
                    <label for="product-temple-length">Temple Length</label>
                    <input type="number" name="product-temple-length" value=0 min="0" step="1" placeholder="Ex: Please input a valid temple length"> 
                </div>
            </div>
            <div class="row-group">
                <div class="field-group">
                    <label for="product-color">Choose from existing colors</label>
                    <input type="hidden" name="product-color-pa" value="">
                    <select name="product-color" class="product-select product-color-select" data-input="new-color"> 
                        <?php foreach ($colors as $color) : ?>
                        <option value="<?php echo $color['attribute_id']; ?>"><?php echo $color['color_name']; ?></option>
                        <?php endforeach; ?>
                        <option value="new">Add a new color</option>
                    </select>
                </div>
                <div class="field-group new-color">
                    <label for="product-color-input">New Color</label>
                    <input type="text" name="product-color-input" placeholder="Please enter a color.">
                </div>
            </div>
            <div class="row-group">
                <div class="field-group">
                    <label for="product-material">Choose from existing materials</label>
                    <input type="hidden" name="product-material-pa" value="">
                    <select name="product-material" class="product-select product-material-select" data-input="new-material"> 
                        <?php foreach ($materials as $material) : ?>
                        <option value="<?php echo $material['attribute_id']; ?>"><?php echo $material['material_name']; ?></option>
                        <?php endforeach; ?>
                        <option value="new">Add a new material</option>
                    </select>
                </div>
                <div class="field-group new-material">
                    <label for="product-material-input">New Material</label>
                    <input type="text" name="product-material-input" placeholder="Please enter a material.">
                </div>
            </div>
            <div class="row-group">
                <div class="field-group">    
                    <label for="product-shape">Choose from existing shapes</label>
                    <input type="hidden" name="product-shape-pa" value="">
                    <select name="product-shape" class="product-select product-shape-select" data-input="new-shape"> 
                        <?php foreach ($shapes as $shape) : ?>
                        <option value="<?php echo $shape['attribute_id']; ?>"><?php echo $shape['shape_name']; ?></option>
                        <?php endforeach; ?>
                        <option value="new">Add a new shape</option>
                    </select>
                </div>
                <div class="field-group new-shape">
                    <label for="product-shape-input">New Shape</label>
                    <input type="text" name="product-shape-input" placeholder="Please enter a shape.">
                </div>
            </div>
            <div class="field-group">
                <label for="product-frame-type">Frame Type</label>
                <input type="hidden" name="product-frame-type-pa" value="">
                <select name="product-frame-type" class="product-frame-type-select">
                    <option value="13">Rimless</option>
                    <option value="12">Semi-Rim</option>
                    <option value="11">Full-Rim</option>
                </select>
            </div>
        </div>
    </div>
    <div class="add__button-group">
        <button class="button add__cancel" type="button">Cancel</button>
        <button class="button button--filled-dark add__submit" type="submit" name="add">Add Product</button>
    </div>
</form>
<div class="page-overlay add-product-overlay"></div>