<div class="page-overlay"></div>
<div class="action-menu">
    <div class="action-menu__wrapper">
        <header class="action-menu__header">
            <button class="icon-container action-menu__close-button"><?php echo getIcon('close')?></button>
            <ul class="action-menu__actions">
                <li class="action-menu__item"><button class="icon-container action-menu__button" data-action="search"><?php echo getIcon('search')?></button></li>
                <li class="action-menu__item"><button class="icon-container action-menu__button" data-action="favorites"><?php echo getIcon('heart')?> </button></li>
                <li class="action-menu__item"><button class="icon-container action-menu__button" data-action="bag"><?php echo getIcon('bag')?></button></li>
                <li class="action-menu__item"><button class="icon-container action-menu__button" data-action="user"><?php echo getIcon('user')?></button></li>
            </ul>
        </header>
        <div class="action-menu__content-wrapper">
            <main class="action-menu__content">
                <?php require './includes/components/search.php'?>
                <?php require './includes/components/favorites.php'?>
                <?php require './includes/components/bag.php'?>
                <?php require './includes/components/user.php'?>
            </main>
        </div>
    </div>
</div>