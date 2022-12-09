<?php require_once(ROOT . '/Views/partials/header.php'); ?>



 
<?php
// $psw  = "coucou";
// $psw1 = password_hash($psw, PASSWORD_ARGON2I);
// $psw2 = password_hash($psw, PASSWORD_ARGON2I);
// echo $psw1."<br />";
// echo $psw2."<br />";
// var_dump(  password_verify($psw, $psw1 ) ) ;


?>

<div class="container p-6 mx-auto grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 lg:gap-8">
    <div class="p-2">

        <div>
            <?= !empty($_SESSION['msgErr'])  ?  $_SESSION['msgErr'] :"" ?>
        </div>


    <?php foreach($blogs as $blog) : ?>
        <a href="/blog/show/<?= $blog['id'] ?>">
            <div class="relative">
                <div class="absolute top-4 right-4 rounded shadow bg-white text-gray-900 dark:bg-gray-900 dark:text-white text-sm px-2 py-0.5">
                <?= $blog['created_at'] ?>
                </div>
            </div>
            <div class="my-2 text-xl font-semibold"><?= $blog['title'] ?></div>
            <div class=""><?= $blog['resume'] ?></div>
            <div><b><?= $blog['categorie'] ?></b></div>
        </a>
        <?php endforeach ?>

    </div>
</div>

<?php require_once(ROOT . '/Views/partials/footer.php'); ?>


<?php
// phpinfo();
?>
