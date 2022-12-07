<?php require_once(ROOT . '/Views/partials/header.php'); ?>
<div class="container p-6 mx-auto ">
   <!-- Form -->

   <section>
        <!-- Formulaire d'ajout de tâche -->
        <form class="standard-form label-left" action="/category/store" method="POST">
            <fieldset>
                <legend>Nouvelle categorie</legend>
                <ul>
                    <li>
                        <label for="title">Name :</label>
                        <input id="name" name="name" type="text" style="border:1px solid #DEDEDC;">
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
