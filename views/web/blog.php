<?php $this->layout('layouts/web', ["title" => "Blog"]) ?>

<section class="text-gray-600 ">
    <div class="container px-5 py-24 mx-auto">
        <div class="flex flex-wrap w-full mb-20">
            <div class="lg:w-1/2 w-full mb-6 lg:mb-0">
                <h1 class="sm:text-3xl text-2xl font-bold title-font text-gray-900 mb-2">Blog</h1>
                <div class="h-1 w-20 bg-blue-500 rounded"></div>
            </div>
            <p class="lg:w-1/2 w-full leading-relaxed text-gray-500">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam at pellentesque ipsum. Integer hendrerit arcu in tempus mollis. Interdum et malesuada fames ac ante ipsum primis in faucibus. Pellentesque habitant.</p>
        </div>
        <div class="flex flex-wrap -m-4">
            <?php foreach ($posts as $post) : ?>
                <div class="w-full xl:w-1/4 md:w-1/2 p-4">
                    <div class="bg-gray-100 p-6 rounded-lg">
                        <a href="<?= $router->route("web.post", ["id" => $post->id]) ?>"><img class="rounded w-full object-cover object-center mb-6 aspect-video" src="<?= $post->image && file_exists($post->image) ? "/" . $post->image : "https://dummyimage.com/720x400" ?>"></a>
                        <a href="<?= $router->route("web.post", ["id" => $post->id]) ?>" class="text-lg text-gray-900 font-bold title-font mb-4 hover:text-blue-500"><?= $post->title ?></a>
                        <p class="leading-relaxed text-base"><?= substr($post->description,0,100) . (strlen($post->description) > 100 ? "..." : "") ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="mt-8 flex items-center justify-center">
            <?= $paginator->render(null, false); ?>
        </div>
    </div>
</section>