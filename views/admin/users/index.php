<?php $this->layout('layouts/admin', ["title" => "Usuários"]) ?>

<?php if (count($users) <= 0) : ?>
    <div class="flex flex-col items-center justify-center w-full gap-2 px-8 py-16 mt-4 text-2xl font-semibold text-center text-gray-500">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-10 h-10">
            <line x1="12" x2="18" y1="12" y2="18" />
            <line x1="12" x2="18" y1="18" y2="12" />
            <rect width="14" height="14" x="8" y="8" rx="2" ry="2" />
            <path d="M4 16c-1.1 0-2-.9-2-2V4c0-1.1.9-2 2-2h10c1.1 0 2 .9 2 2" />
        </svg>
        <p>Nenhum usuário cadastrado.</p>
        <a href="<?= $router->route("user.create") ?>" class="text-base underline hover:text-blue-500">Cadastrar o primeiro usuário</a>
    </div>
<?php else : ?>
    <div class="flex flex-col md:flex-row items-start md:items-center md:justify-between mb-4 w-full gap-2">
        <h1 class="text-2xl font-bold">Usuários</h1>
        <a href="<?= $router->route("user.create") ?>" class="inline-flex items-center bg-gray-100 border-0 py-1 px-3 focus:outline-none hover:bg-gray-200 rounded text-base">Novo
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4 ml-1"><path d="M5 12h14"/><path d="M12 5v14"/></svg>
        </a>
    </div>

    <?= flash("status") ?>

    <div class="w-full overflow-hidden overflow-x-auto">
        <table class="table-auto w-full text-left whitespace-no-wrap">
            <thead>
                <tr>
                    <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tl rounded-bl">Título</th>
                    <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">Criado em</th>
                    <th class="w-10 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tr rounded-br"></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user) : ?>
                    <tr>
                        <td class="px-4 py-3 align-middle"><?= $user->first_name ?> <?= $user->last_name ?></td>
                        <td class="px-4 py-3 align-middle"><?= $user->created_at ? date("d/m/Y H:i", strtotime($user->created_at)) : "Indeterminado" ?></td>
                        <td class="w-10 text-center align-middle">
                            <div class="flex items-center gap-2">
                                <a href="<?= $router->route("user.edit", ["id" => $user->id]) ?>" class="inline-flex items-center bg-green-100 border-0 py-2 px-3 focus:outline-none hover:bg-green-200 rounded text-base">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4"><path d="M17 3a2.85 2.83 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5Z"/><path d="m15 5 4 4"/></svg>
                                </a>
                                <form action="<?= $router->route("user.delete", ["id" => $user->id]) ?>" method="post">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button type="submit" class="inline-flex items-center bg-red-100 border-0 py-2 px-3 focus:outline-none hover:bg-red-200 rounded text-base">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4"><path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/><line x1="10" x2="10" y1="11" y2="17"/><line x1="14" x2="14" y1="11" y2="17"/></svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="mt-8 flex items-center justify-center w-full">
        <?= $paginator->render(null, false); ?>
    </div>
<?php endif; ?>