<?php $this->layout('layouts/web', [ "title" => $post->title ]) ?>

<section class="text-gray-600">
    <div class="container px-5 py-14 mx-auto">
        <img class="rounded w-full object-cover object-center mb-6 aspect-video" src="<?= $post->image && file_exists($post->image) ? "/" . $post->image : "https://dummyimage.com/720x400" ?>">
        <h1 class="text-3xl text-gray-900 font-bold title-font"><?= $post->title ?></h1>
        <h3 class="mb-4 text-sm italic">Postado em: <?= date("d/m/Y H:i", strtotime($post->created_at)) ?></h3>
        <p class="leading-relaxed text-base"><?= nl2br($post->description) ?></p>
    </div>
</section>