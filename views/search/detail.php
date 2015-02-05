<?php use Aura\Html\Escaper as e; ?>
<?= $this->render(VIEWS_DIR . '/partials/header.php', ['title' => $this->photo->getTitle()]) ?>
<div class="page">
    <?php if ($this->back_url): ?>
        <section class="section navigation-section section--bordered">
            <nav class="navigation-section__left">
                <a href="<?= $this->back_url ?>" class="button"><i class="fa fa-th-large"></i> Back to results</a>
            </nav>
        </section>
    <?php endif; ?>
    <section class="section section--grid">
        <div class="grid">
            <div class="grid__col grid__col--padded l-one-half">
                <figure class="image-full">
                    <div style="background-image: url(<?= $this->photo->getUrl('c') ?>);"></div>
                </figure>
            </div>
            <div class="grid__col grid__col--padded l-one-half">
                <?php if ($title = $this->photo->getTitle()): ?>
                    <h1 class="page-title"><?= e::h($title) ?></h1>
                <?php endif; ?>
                <?php if ($description = $this->photo->getDescription()): ?>
                    <p><?= $description ?></p>
                <?php endif; ?>
            </div>
        </div>
    </section>
</div>
<?= $this->render(VIEWS_DIR . '/partials/footer.php') ?>