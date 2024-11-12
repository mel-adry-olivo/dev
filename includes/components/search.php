<div class="action-menu__content-item search">
    <form action="./search.php" method="POST" class="search__form">
        <div class="search__field">
            <span class="icon-container search__icon"><?php echo getIcon('search')?></span>
            <input type="text" name="search__input" id="search__input" placeholder="What are you looking for?" autocomplete="off">
        </div>
        <button type="submit" class="icon-container search__submit">
            <?php echo getIcon('arrow-right')?>
        </button>
    </form>
    <div class="search__suggestions-wrapper">
        <span class="search__suggestions-label">Suggestions</span>
        <ul class="search__suggestions">
            <li class="search__suggestion-item">
                <a href="./search.php" class="search__suggestion-link">Suggestion 1</a>
            </li>
            <li class="search__suggestion-item">
                <a href="./search.php" class="search__suggestion-link">Suggestion 2</a>
            </li>
            <li class="search__suggestion-item">
                <a href="./search.php" class="search__suggestion-link">Suggestion 3</a>
            </li>
            <li class="search__suggestion-item">
                <a href="./search.php" class="search__suggestion-link">Suggestion 4</a>
            </li>
        </ul>
    </div>
    <div class="search__recommendations-wrapper">
        <span class="search__recommendations-label">You may also like</span>
        <div class="search__recommendations-grid">
            <img src="https://placehold.co/600x400" alt="">
            <img src="https://placehold.co/600x400" alt="">
        </div>
    </div>
</div>