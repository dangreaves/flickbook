<?php use Aura\Html\Escaper as e; ?>
<?= $this->render(VIEWS_DIR . '/partials/header.php', ['title' => $this->query]) ?>
<div class="page">
    <?php if ($this->results->count()): ?>
        <section class="section navigation-section section--bordered">
            <nav class="navigation-section__left">
                <a href="/" class="button"><i class="fa fa-search"></i> Search again</a>
            </nav>
        </section>
        <section class="section section--grid section--bordered">
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
        <section class="section">
            <?= $this->results->render() ?>
        </section>
    <?php else: ?>
        <section class="section">
            <h1 class="page-title">Woops, we couldn't find anything for &ldquo;<?= e::h($this->query) ?>&rdquo;</h1>
            <a href="/" class="button"><i class="fa fa-search"></i> Search again</a>
        </section>
    <?php endif; ?>
</div>
<?= $this->render(VIEWS_DIR . '/partials/footer.php') ?>