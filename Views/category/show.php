<?php require_once(ROOT . '/Views/partials/header.php'); ?>
<main class="flex-1">
    <div class="relative max-w-5xl mx-auto px-4">
        <div class="absolute top-4 right-8 rounded shadow bg-white text-gray-900 dark:bg-gray-900 dark:text-white px-2 py-0.5">
        <?= $categorie['created_at'] ?>
        </div>
    </div>
    <article class="prose lg:prose-lg mx-auto my-8 dark:prose-dark px-4">
        <h1 class="text-2xl font-bold mb-2"><?= $categorie['name'] ?></h1>
    </article>
    <a href="/category/edit/<?= $categorie['id'] ?>">Editer</a>
    <a href="/category/delete/<?= $categorie['id'] ?>">Supprimer</a>
</main>
<?php require_once(ROOT . '/Views/partials/footer.php'); ?>
