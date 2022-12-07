<?php require_once(ROOT . '/Views/partials/header.php'); ?>


<div class="container p-6 mx-auto ">
    <!-- Faire un formulaire ici -->

    <section>
        <!-- Formulaire d'ajout de tâche -->
        <form class="standard-form label-left" action="/blog/store" method="POST">
            <fieldset>
                <legend>Nouvel article</legend>
                <ul>
                    <li>
                        <label for="title">Titre :</label>
                        <input id="title" name="title" type="text" style="border:1px solid #DEDEDC;">
                    </li>
                    <li>
                        <label for="author">Author :</label>
                        <input id="author" name="author" type="text" style="border:1px solid #DEDEDC;">
                    </li>
                    <li>
                        <label for="content">Contenu :</label>
                        <textarea id="content" name="content" rows="5" style="border:1px solid #DEDEDC;width:300px;"></textarea>
                    </li>
                    <li>
                        <label for="resume">Resume :</label>
                        <textarea id="resume" name="resume" rows="5" style="border:1px solid #DEDEDC;width:300px;"></textarea>
                    </li>
                    <li>
                        <label for="content">Catégorie :</label>
                        <select name="categorie">
                        <?php foreach($categories as $categories) : ?>
                            <option value="<?= $categories['id'] ?>"><?= $categories['name'] ?></option>
                        <?php endforeach ?>
                        </select>
                    </li>
                    <li>
                        <input type="submit" value="Ajouter" title="Ajouter">
                    </li>
                </ul>
            </fieldset>
        </form>
    </section>




</div>
<?php require_once(ROOT . '/Views/partials/footer.php'); ?>
