<?php require_once(ROOT . '/Views/partials/header.php'); ?>
<main class="flex flex-col">
    <div class="relative max-w-5xl mx-auto px-4">
        <?= $article['created_at'] ?>
    </div>
    <article class="mx-auto my-8 px-4">
        <h1 class="text-2xl font-bold mb-2"><?= $article['title'] ?></h1>
        <h5 class="text-sm flex flex-col items-center">
        <p><?= $article['resume'] ?></p>
        <p><?= $article['categorie'] ?></p>
        <hr>
        <?= $article['content'] ?>
    </article>
    <a href="/blog/edit/<?= $article['id'] ?>">Editer</a>
    <a href="/blog/delete/<?= $article['id'] ?>">Supprimer</a>
</main>
<?php require_once(ROOT . '/Views/partials/footer.php'); ?>
