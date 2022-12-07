<?php require_once(ROOT . '/Views/partials/header.php'); ?>


<div class="container p-6 mx-auto ">
    <!-- Faire un formulaire ici -->

    <section>
        <!-- Formulaire d'ajout de tâche -->
        <form class="standard-form label-left" action="/blog/update" method="POST">
            
            <input id="id" name="id" type="hidden" value="<?= $article['id'] ?>">

            <fieldset>
                <legend>Modification article</legend>
                <ul>
                    <li>
                        <label for="title">Titre :</label>
                        <input id="title" name="title" type="text" value="<?= $article['title'] ?>" style="border:1px solid #DEDEDC;">
                    </li>
                    <li>
                        <label for="author">Author :</label>
                        <input id="author" name="author" type="text" value="<?= $article['author'] ?>"style="border:1px solid #DEDEDC;">
                    </li>
                    <li>
                        <label for="content">Contenu :</label>
                        <textarea id="content" name="content" rows="5" style="border:1px solid #DEDEDC;width:300px;"><?= $article['content'] ?>"</textarea>
                    </li>
                    <li>
                        <label for="resume">Resume :</label>
                        <textarea id="resume" name="resume" rows="5" style="border:1px solid #DEDEDC;width:300px;"><?= $article['resume'] ?>"</textarea>
                    </li>
                    <li>
                        <label for="content">Catégorie :</label>
                        <select name="categorie">
                            <?php foreach($categories as $categories) : ?>
                                <option value="<?= $categories['id'] ?>" <?= !empty($article['category_id']) && $article['category_id'] == $categories['id'] ? 'selected' : '' ?>>
                                    <?= $categories['name'] ?>
                                </option>
                            <?php endforeach ?>
                        </select>
                    </li>
                    <li>
                        <input type="submit" value="Modifier" title="Modifier">
                    </li>
                </ul>
            </fieldset>
        </form>
    </section>




</div>
<?php require_once(ROOT . '/Views/partials/footer.php'); ?>
