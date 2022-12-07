<?php require_once(ROOT . '/Views/partials/header.php'); ?>


<div class="container p-6 mx-auto grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 lg:gap-8">
            <div class="p-2">
            <?php foreach($categories as $categorie) : ?>
                <a href="/category/show/<?= $categorie['id'] ?>">
                    <div class="relative">
                        <div class="absolute top-4 right-4 rounded shadow bg-white text-gray-900 dark:bg-gray-900 dark:text-white text-sm px-2 py-0.5">
                        <?= $categorie['created_at'] ?>
                        </div>
                    </div>
                    <div class="my-2 text-xl font-semibold"><?= $categorie['name'] ?></div>
                </a>
                <?php endforeach ?>
            </div>
</div>

<?php require_once(ROOT . '/Views/partials/footer.php'); ?>
