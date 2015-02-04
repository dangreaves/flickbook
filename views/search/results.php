<?= $this->render(VIEWS_DIR . '/partials/header.php', ['title' => $this->query]) ?>
<div class="page">
    <section class="section section--grid">
        <div class="grid">
            <?php foreach ($this->results->items() as $photo): ?>
                <div class="grid__col grid__col--padded l-one-sixth">
                    <a href="/photo/<?= $photo->getId() ?>?query=<?= $this->query ?>&page=<?= $this->page ?>" class="image-thumb">
                        <div style="background-image: url(<?= $photo->getUrl() ?>);">
                            <span class="image-thumb__mask"></span>
                            <?php if ($title = $photo->getTitle(30)): ?>
                                <span class="image-thumb__title"><?= $title ?></span>
                            <?php endif; ?>
                        </div>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
    </section>
    <section class="section section--bordered">
        <?= $this->results->render() ?>
    </section>
</div>
<?= $this->render(VIEWS_DIR . '/partials/footer.php') ?>