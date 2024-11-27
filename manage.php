<?php 

session_start();

require './includes/templates.php';
require './includes/icons.php';
require './includes/config.php';
require './includes/db-utils.php';

$title = 'Manage Products| INSPEC®';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>
    <script type="module" src="./assets/js/pages/manage.js" defer></script>
    <link rel="shortcut icon" href="./assets/images/icons/favicon.ico" type="image/x-icon">
    <?php require './includes/style-loader.php'?>
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
                                <th>Gender</th>
                                <th>Price</th>
                                <th>Stocks</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <div class="product-container">
                                        <img src="https://placehold.co/60" width="60" height="60" alt="product">
                                        <span>Sample Product 1</span>
                                    </div>
                                </td>
                                <td>Sunglasses</td>
                                <td>Men</td>
                                <td>P1,500</td>
                                <td>45</td>
                                <td>
                                    <div class="actions-container">
                                        <button class="button-link">Edit</button>
                                        <button class="button-link">Delete</button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="product-container">
                                        <img src="https://placehold.co/60" width="60" height="60" alt="product">
                                        <span>Sample Product 2</span>
                                    </div>
                                </td>
                                <td>Sunglasses</td>
                                <td>Men</td>
                                <td>P1,500</td>
                                <td>45</td>
                                <td>
                                    <div class="actions-container">
                                        <button class="button-link">Edit</button>
                                        <button class="button-link">Delete</button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="product-container">
                                        <img src="https://placehold.co/60" width="60" height="60" alt="product">
                                        <span>Sample Product 3</span>
                                    </div>
                                </td>
                                <td>Sunglasses</td>
                                <td>Men</td>
                                <td>P1,500</td>
                                <td>45</td>
                                <td>
                                    <div class="actions-container">
                                        <button class="button-link">Edit</button>
                                        <button class="button-link">Delete</button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </div>
    <div class="snackbar"></div>
    <?php require './includes/components/footer.php'?>
    <?php include './includes/components/confirm-dialog.php';?>
    <?php require './includes/components/review-form.php' ?>
</body>
</html>