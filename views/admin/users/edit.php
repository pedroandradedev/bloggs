<?php $this->layout('layouts/admin', ["title" => "Editar Usuário"]) ?>

<div class="flex flex-col md:flex-row items-start md:items-center md:justify-between mb-4 w-full gap-2">
    <h1 class="text-2xl font-bold">Editar usuário</h1>
</div>

<?= flash("status") ?>

<form id="form" action="<?= $router->route('user.update', ["id" => $user->id]) ?>" method="post" class="space-y-4 w-full" enctype="multipart/form-data">
    <div class="flex flex-col">
        <label for="first_name" class="required">Nome:</label>
        <input id="first_name" type="text" name="first_name" class="input-control" value="<?= flash(name: "first_name", free: true) ?? $user->first_name ?>" />
    </div>
    <div class="flex flex-col">
        <label for="last_name" class="required">Sobrenome:</label>
        <input id="last_name" type="text" name="last_name" class="input-control" value="<?= flash(name: "last_name", free: true) ?? $user->last_name ?>" />
    </div>
    <div class="flex flex-col">
        <label for="email" class="required">Email:</label>
        <input id="email" type="email" name="email" class="input-control" value="<?= flash(name: "email", free: true) ?? $user->email ?>" />
    </div>
    <div class="flex flex-col">
        <label for="password">Senha:</label>
        <input id="password" type="password" name="password" class="input-control" />
    </div>
    <button class="btn" type="submit">Salvar Alterações</button>
    <input type="hidden" name="_method" value="PUT">
</form>