<?php require_once(ROOT . '/Views/partials/header.php'); ?>
<div class="container p-6 mx-auto ">
    <!-- Form -->



    <form class="standard-form label-left" action="/category/update" method="POST">
            
            <input id="id" name="id" type="hidden" value="<?= $categorie['id'] ?>">

            <fieldset>
                <legend>Modification categorie</legend>
                <ul>
                    <li>
                        <label for="name">Name :</label>
                        <input id="name" name="name" type="text" value="<?= $categorie['name'] ?>" style="border:1px solid #DEDEDC;">
                    </li>
                    
                    <li>
                        <input type="submit" value="Modifier" title="Modifier">
                    </li>
                </ul>
            </fieldset>
        </form>















</div>
<?php require_once(ROOT . '/Views/partials/footer.php'); ?>
