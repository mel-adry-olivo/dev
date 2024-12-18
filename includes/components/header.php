<header class="header__wrapper">
    <div class="header">
        <div class="page-overlay page-overlay-nav"></div>
        <nav class="header__nav">
            <button class="header__nav-button">
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" class="iconify iconify--iconoir" width="24" height="24" preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 5h18M3 12h18M3 19h18"></path></svg>
            </button>
            <ul class="header__nav-list">
                <li class="header__nav-header">
                    <button class="icon-container header__nav-close-button"><?php echo getIcon('close')?></button>
                </li>
                <li class="header__nav-item">
                    <a href="./shop.php?type=sunglasses" class="header__nav-link">Sunglasses</a>
                </li>
                <li class="header__nav-item">
                    <a href="./shop.php?type=eyeglasses" class="header__nav-link">Eyeglasses</a>
                </li>
                <li class="header__nav-item">
                    <a href="./shop.php?type=all" class="header__nav-link">Shop</a>
                </li>
            </ul>
        </nav>
        <div class="header__logo">
            <a href="./">
                <img src="./assets/images/icons/logo-xsmall.webp" alt="Inspec Logo" width="66" height="16">
            </a>
        </div>  
        <div class="header__actions">
            <ul class="header__actions-list">
                <li class="header__action-item">
                    <button class="icon-container header__action-button" data-action="favorites">
                        <?php echo getIcon('heart')?>
                    </button>
                </li>
                <li class="header__action-item">
                    <button class="icon-container header__action-button <?php echo (isset($_SESSION['user_id'])) ? 'online' : '' ?>" data-action="user">
                        <?php echo getIcon('user')?>
                    </button>
                </li>
                <li class="header__action-item">
                    <button href="./summary.php" class="icon-container header__action-button" data-action="bag">
                        <?php echo getIcon('bag')?>
                    </button>
                </li>
            </ul>
        </div>
    </div>
</header>
<div class="page-overlay page-overlay-action-menu"></div>
