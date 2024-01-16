<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($title) ?  $title . " | " : "" ?><?= site('name') ?></title>
    <link rel="icon" type="image/png" href="<?= asset("images/favicon.png") ?>" />
    <meta name="theme-color" content="<?= site("color") ?>">
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= asset("css/style.css") ?>">
</head>

<body class="bg-gray-900">
    <?= $this->section("content") ?>

    <script src="<?= asset("js/jquery-3.7.1.min.js") ?>"></script>
    <script src="<?= asset("js/blockUI.js") ?>"></script>
    <script src="<?= asset("js/sweetalert2.js") ?>"></script>
    <?= $this->section('scripts') ?>
</body>

</html>