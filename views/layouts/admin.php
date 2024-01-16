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

<body>
    <header class="text-gray-600 ">
        <div class="container mx-auto flex flex-wrap p-5 flex-col md:flex-row items-center">
            <a href="<?= $router->route("admin.dashboard") ?>" class="flex title-font font-medium items-center text-gray-900 mb-4 md:mb-0">
                <div class="w-10 h-10 text-white bg-blue-500 rounded-full flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="3" viewBox="0 0 26 26" class="w-5 h-5">
                        <path d="m13,1h6c3.31,0,6,2.69,6,6h0c0,3.31-2.69,6-6,6H1C1,6.38,6.38,1,13,1Z"/>
                        <path d="m1,13h18c3.31,0,6,2.69,6,6h0c0,3.31-2.69,6-6,6H1v-12h0Z"/>
                    </svg>
                </div>
                <span class="ml-3 text-xl">Bloggs</span>
            </a>
            <nav class="md:ml-auto flex flex-wrap flex-col md:flex-row items-center text-base justify-center gap-5">
                <a href="<?= $router->route("admin.dashboard") ?>" class="hover:text-gray-900">Posts</a>
                <a href="<?= $router->route("auth.logout") ?>" class="inline-flex items-center bg-gray-100 border-0 py-1 px-3 focus:outline-none hover:bg-gray-200 rounded text-base">Sair
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4 ml-1"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" x2="9" y1="12" y2="12"/></svg>
                </a>
            </nav>
        </div>
    </header>

    <div class="container mx-auto flex flex-wrap p-5">
        <?= $this->section("content") ?>
    </div>

    <script src="<?= asset("js/jquery-3.7.1.min.js") ?>"></script>
    <script src="<?= asset("js/jquery.form.js") ?>"></script>
    <script src="<?= asset("js/blockUI.js") ?>"></script>
    <script src="<?= asset("js/sweetalert2.js") ?>"></script>
    <?= $this->section('scripts') ?>
</body>

</html>