<?php 

session_start();

require './includes/templates.php';
require './includes/icons.php';
require './includes/db-utils.php';

$conn = require './includes/db-conn.php';
$title = 'Manage Products| INSPEC®';

$products = getAllProducts($conn);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>
    <script type="module" src="./assets/js/pages/manage.js" defer></script>
    <link rel="shortcut icon" href="./assets/images/icons/favicon.ico" type="image/x-icon">
    <link href="https://fonts.cdnfonts.com/css/satoshi" rel="stylesheet"/>
    <link href="https://fonts.cdnfonts.com/css/source-serif-pro" rel="stylesheet"/>
    <link href="./assets/styles/global/global.css" rel="stylesheet"/>
    <link href="./assets/styles/global/components.css" rel="stylesheet"/>
    <link href="./assets/styles/pages/manage.css" rel="stylesheet"/>
</head>
<body>
<div class="wrapper">
        <?php require './includes/components/header.php'?>
        <?php require './includes/components/action-menu.php'?>
        <section class="manage">
            <div class="manage__header">
                <h6>Manage Products</h6>
            </div>
            <div class="manage__content">
                <div class="content__header">
                    <div class="content__searchbar">
                        <span class="icon-container search-icon"><?php echo getIcon("search"); ?></span>
                        <input type="text" name="search" placeholder="Search product" >
                    </div>
                    <button class="button button--filled-dark content__add-button">
                        <span class="icon-container add-icon"><?php echo getIcon("add"); ?></span>
                        <span>Add Product</span>
                    </button>
                </div>
                <div class="content__products">
                    <table class="product__table">
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Type</th>
                                <th>Price</th>
                                <th>Stocks</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($products as $product) : ?>
                            <tr>
                                <td>
                                    <div class="product-container">
                                        <img src="<?php echo $product['image_main']; ?>" width="60" height="60" alt="product">
                                        <a class="button-link" href="./product.php?id=<?php echo $product['product_id']; ?>"><?php echo $product['brand'] . " " . $product['name']; ?></a>
                                    </div>
                                </td>
                                <td><?php echo $product['type']; ?></td>
                                <td>₱<?php echo number_format($product['price'], '0', '.', ','); ?></td>
                                <td><?php echo $product['stock_quantity']; ?></td>
                                <td>
                                    <div class="actions-container">
                                        <button class="button-link product__edit" data-id="<?php echo $product['product_id']; ?>">Edit</button>
                                        <button class="button-link product__delete" data-id="<?php echo $product['product_id']; ?>">Delete</button>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </div>
    <div class="snackbar"></div>
    <?php require './includes/components/footer.php'?>
    <?php include './includes/components/confirm-dialog.php';?>
    <?php require './includes/components/product-add-form.php' ?>
</body>
</html>