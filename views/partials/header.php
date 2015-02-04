<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <title><?= $this->title ?> - Flickbook</title>
        <meta name="description" content="" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <link rel="stylesheet" href="/css/style.css" />
        <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" />
    </head>
    <body>
        <?php if (! $this->hide_header): ?>
            <header class="header">
                <a href="/" class="header__logo">Flickbook</a>
            </header>
        <?php endif; ?>