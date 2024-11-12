<?php

// table names
$categories = ['brand', 'frame_type', 'shape'];

?>

<div class="shop__filter">
    <ul class="shop__filter-categories">
        <?php foreach($categories as $category) {
            $categoryItems = retrieveAllFrom($category);
            createFilterCategory($category, $categoryItems);
        }
        ?>
    </ul>
</div>