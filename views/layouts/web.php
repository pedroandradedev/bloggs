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
            <a href="<?= $router->route("web.home") ?>" class="flex title-font font-medium items-center text-gray-900 mb-4 md:mb-0">
                <div class="w-10 h-10 text-white bg-blue-500 rounded-full flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="3" viewBox="0 0 26 26" class="w-5 h-5">
                        <path d="m13,1h6c3.31,0,6,2.69,6,6h0c0,3.31-2.69,6-6,6H1C1,6.38,6.38,1,13,1Z" />
                        <path d="m1,13h18c3.31,0,6,2.69,6,6h0c0,3.31-2.69,6-6,6H1v-12h0Z" />
                    </svg>
                </div>
                <span class="ml-3 text-xl">Bloggs</span>
            </a>
            <nav class="md:ml-auto flex flex-wrap flex-col md:flex-row items-center text-base justify-center gap-5">
                <a href="<?= $router->route("web.home") ?>" class="hover:text-gray-900">Início</a>
                <a href="<?= $router->route("web.blog") ?>" class="hover:text-gray-900">Blog</a>
                <a href="<?= $router->route("auth.login") ?>" class="inline-flex items-center bg-gray-100 border-0 py-1 px-3 focus:outline-none hover:bg-gray-200 rounded text-base">Entrar
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4 ml-1">
                        <path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4" />
                        <polyline points="10 17 15 12 10 7" />
                        <line x1="15" x2="3" y1="12" y2="12" />
                    </svg>
                </a>
            </nav>
        </div>
    </header>

    <?= $this->section("content") ?>

    <footer class="text-gray-600">
        <div class="bg-gray-100">
            <div class="container px-5 py-6 mx-auto flex items-center sm:flex-row flex-col">
                <div class="w-10 h-10 text-white bg-blue-500 rounded-full flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="3" viewBox="0 0 26 26" class="w-5 h-5">
                        <path d="m13,1h6c3.31,0,6,2.69,6,6h0c0,3.31-2.69,6-6,6H1C1,6.38,6.38,1,13,1Z" />
                        <path d="m1,13h18c3.31,0,6,2.69,6,6h0c0,3.31-2.69,6-6,6H1v-12h0Z" />
                    </svg>
                </div>
                <span class="ml-3 text-xl">Bloggs</span>
                <p class="text-sm text-gray-500 sm:ml-6 sm:mt-0 mt-4">© <?= site('year') ?> <?= site('name') ?> —
                    <a href="https://github.com/pedroandradedev" class="text-gray-600 ml-1" target="_blank">@pedroandradedev</a>
                </p>
                <span class="inline-flex sm:ml-auto sm:mt-0 mt-4 justify-center sm:justify-start">
                    <a class="text-gray-500">
                        <svg fill="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-5 h-5" viewBox="0 0 24 24">
                            <path d="M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3z"></path>
                        </svg>
                    </a>
                    <a class="ml-3 text-gray-500">
                        <svg fill="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-5 h-5" viewBox="0 0 24 24">
                            <path d="M23 3a10.9 10.9 0 01-3.14 1.53 4.48 4.48 0 00-7.86 3v1A10.66 10.66 0 013 4s-4 9 5 13a11.64 11.64 0 01-7 2c9 5 20 0 20-11.5a4.5 4.5 0 00-.08-.83A7.72 7.72 0 0023 3z"></path>
                        </svg>
                    </a>
                    <a class="ml-3 text-gray-500">
                        <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-5 h-5" viewBox="0 0 24 24">
                            <rect width="20" height="20" x="2" y="2" rx="5" ry="5"></rect>
                            <path d="M16 11.37A4 4 0 1112.63 8 4 4 0 0116 11.37zm1.5-4.87h.01"></path>
                        </svg>
                    </a>
                    <a class="ml-3 text-gray-500">
                        <svg fill="currentColor" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="0" class="w-5 h-5" viewBox="0 0 24 24">
                            <path stroke="none" d="M16 8a6 6 0 016 6v7h-4v-7a2 2 0 00-2-2 2 2 0 00-2 2v7h-4v-7a6 6 0 016-6zM2 9h4v12H2z"></path>
                            <circle cx="4" cy="4" r="2" stroke="none"></circle>
                        </svg>
                    </a>
                </span>
            </div>
        </div>
    </footer>

    <script src="<?= asset("js/jquery-3.7.1.min.js") ?>"></script>
    <script src="<?= asset("js/blockUI.js") ?>"></script>
    <script src="<?= asset("js/sweetalert2.js") ?>"></script>
    <?= $this->section('scripts') ?>
</body>

</html>