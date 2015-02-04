<?= $this->render(VIEWS_DIR . '/partials/header.php', ['title' => 'Search', 'hide_header' => true]) ?>
<div class="search-hero">
    <div class="search-hero__box">
        <h1 class="search-hero__logo">Flickbook</h1>
        <form action="/search" method="GET">
            <input type="text" name="query" class="search-hero__box__input" placeholder="Tell me what you're looking for" />
            <button type="submit" class="button button--large search-hero__box__button">Show me</button>
        </form>
    </div>
</div>
<?= $this->render(VIEWS_DIR . '/partials/footer.php', ['hide_footer' => true]) ?>