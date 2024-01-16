<?php $this->layout('layouts/admin', ["title" => "Criar Post"]) ?>

<div class="flex flex-col md:flex-row items-start md:items-center md:justify-between mb-4 w-full gap-2">
    <h1 class="text-2xl font-bold">Novo post</h1>
</div>

<?= flash("status") ?>

<form id="form" action="<?= $router->route('post.store') ?>" method="post" class="space-y-4 w-full" enctype="multipart/form-data">
    <div class="flex flex-col">
        <label for="title" class="required">Título:</label>
        <input id="title" type="text" name="title" class="input-control" value="<?= flash(name: "title", free: true) ?>" />
    </div>
    <div class="flex flex-col">
        <label for="description" class="required">Descrição:</label>
        <textarea id="description" name="description" rows="10" class="input-control"><?= flash(name: "description", free: true) ?></textarea>
    </div>
    <div class="flex flex-col">
        <label for="image">Imagem:</label>
        <label class="block mt-1">
            <span class="sr-only">Escolha uma imagem...</span>
            <input id="image" type="file" name="image" class="block w-full text-sm text-slate-500
            file:mr-4 file:py-2 file:px-4
            file:rounded-full file:border-0
            file:text-sm file:font-semibold
            file:bg-blue-50 file:text-blue-700
            hover:file:bg-blue-100
            "/>
        </label>
    </div>
    <button class="btn" type="submit">Criar</button>
</form>