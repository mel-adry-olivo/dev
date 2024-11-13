<?php

// table names
$categories = getAllCategories();




?>

<div class="shop__filter">
    <ul class="shop__filter-categories">
        <?php 
            foreach($categories as $category => $categoryItems) {
                createFilterCategory($category, $categoryItems);
            }
        ?>
    </ul>
</div>