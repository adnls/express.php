<!DOCTYPE html>

<html>
    <head>
        <meta charset="utf-8" />
        <title><?= $this->title ?></title>
        <?= $this->style ?>
        <link href="/work/static/css/style.css" rel="stylesheet"/>
    </head>
    <body>
        <?= $this->script ?>
        <script type="text/javascript" src="/work/static/javascript/toggleMenu.js"></script>
        <?= $this->content ?>
    </body>
</html>