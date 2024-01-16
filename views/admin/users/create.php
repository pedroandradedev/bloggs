<?php $this->layout('layouts/admin', ["title" => "Novo Usuário"]) ?>

<div class="flex flex-col md:flex-row items-start md:items-center md:justify-between mb-4 w-full gap-2">
    <h1 class="text-2xl font-bold">Novo usuário</h1>
</div>

<?= flash("status") ?>

<form id="form" action="<?= $router->route('user.store') ?>" method="post" class="space-y-4 w-full" enctype="multipart/form-data">
    <div class="flex flex-col">
        <label for="first_name" class="required">Nome:</label>
        <input id="first_name" type="text" name="first_name" class="input-control" value="<?= flash(name: "first_name", free: true) ?>" />
    </div>
    <div class="flex flex-col">
        <label for="last_name" class="required">Sobrenome:</label>
        <input id="last_name" type="text" name="last_name" class="input-control" value="<?= flash(name: "last_name", free: true) ?>" />
    </div>
    <div class="flex flex-col">
        <label for="email" class="required">E-mail:</label>
        <input id="email" type="email" name="email" class="input-control" value="<?= flash(name: "email", free: true) ?>" />
    </div>
    <div class="flex flex-col">
        <label for="password" class="required">Senha:</label>
        <input id="password" type="password" name="password" class="input-control" />
    </div>
    <button class="btn" type="submit">Criar</button>
</form>