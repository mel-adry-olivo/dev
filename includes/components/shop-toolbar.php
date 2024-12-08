<?php

$categories = getAllCategories($conn);

?>

<div class="shop__toolbar">
    <div class="shop__toolbar-filter">
        <button class="shop__dropdown-button shop__filter-button-mobile">
            <span class="shop__dropdown-button-text">Filter by</span>
            <span class="icon-container shop__dropdown-icon"><?php echo getIcon("arrow-down"); ?></span>
        </button>
        <div class="shop__filter-container">
            <header class="shop__filter-header">
                <button class="shop__filter-close-button"><?php echo getIcon("close"); ?></button>
                <button class="button-link shop__filter-reset shop__filter-reset-mobile">Reset Filters</button>
            </header>
            <div class="shop__filter-content">
                <ul class="shop__filter-items">
                    <?php 
                        foreach($categories as $category => $categoryItems) {
                            createFilterCategory($category, $categoryItems);
                        }
                    ?>
                </ul>
                <button class="button-link shop__filter-reset shop__filter-reset-desktop">Reset Filters</button>
            </div>
        </div>
    </div>
    <div class="shop__toolbar-actions">
        <div class="shop__toolbar-count">
            <span class="shop__toolbar-count"><?php echo count($products); ?> Products</span>
        </div>
        <div class="shop__toolbar-sort">
            <button class="shop__dropdown-button">
                <span class="shop__dropdown-button-text">Sort By</span>
                <span class="icon-container shop__dropdown-icon"><?php echo getIcon("arrow-down"); ?></span>
            </button>
            <div class="shop__dropdown-container">
                <div class="shop__dropdown-content">
                    <ul class="shop__dropdown-items">
                        <li class='shop__dropdown-item active' sort-order="DESC">
                          <span class='icon-container shop__dropdown-icon'><?php echo getIcon("check"); ?></span>
                          <button>Price: High to Low</button>
                       </li>
                       <li class='shop__dropdown-item' sort-order="ASC">
                          <span class='icon-container shop__dropdown-icon'><?php echo getIcon("check"); ?></span>
                          <button>Price: Low to High</button>
                       </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="page-overlay page-overlay-filter"></div>