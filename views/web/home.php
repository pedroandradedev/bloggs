<?php $this->layout('layouts/web', ["title" => "Início"]) ?>

<section class="text-gray-600 ">
    <div class="container mx-auto flex px-5 py-24 md:flex-row flex-col items-center">
        <div class="lg:flex-grow md:w-1/2 lg:pr-24 md:pr-16 flex flex-col md:items-start md:text-left mb-16 md:mb-0 items-center text-center">
            <h1 class="title-font sm:text-4xl text-3xl mb-4 font-medium text-gray-900">Lorem ipsum dolor sit amet
            </h1>
            <p class="mb-8 leading-relaxed">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam at pellentesque ipsum. Integer hendrerit arcu in tempus mollis. Interdum et malesuada fames ac ante ipsum primis in faucibus. Pellentesque habitant.</p>
            <div class="flex justify-center">
                <button class="inline-flex text-white bg-blue-500 border-0 py-2 px-6 focus:outline-none hover:bg-blue-600 rounded text-lg">Button</button>
            </div>
        </div>
        <div class="lg:max-w-lg lg:w-full md:w-1/2 w-5/6">
            <img class="object-cover object-center rounded" alt="hero" src="https://dummyimage.com/720x600">
        </div>
    </div>
</section>

<section class="text-gray-600 ">
    <div class="container px-5 py-24 mx-auto">
        <div class="flex flex-wrap w-full mb-20">
            <div class="lg:w-1/2 w-full mb-6 lg:mb-0">
                <h1 class="sm:text-3xl text-2xl font-bold title-font text-gray-900">Blog</h1>
                <p class="mb-2">Últimos posts</p>
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
    </div>
</section>