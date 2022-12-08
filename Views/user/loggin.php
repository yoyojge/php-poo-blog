<?php require_once(ROOT . '/Views/partials/header.php'); ?>
<div class="container p-6 mx-auto ">
   <!-- Form -->

   <section>
        <!-- Formulaire d'ajout de tâche -->

        <div>
            <!-- <?php 
                var_dump($_SESSION['msgErr']); 
                echo $_SESSION['msgErr'];
                if(!empty($_SESSION['msgErr'])){
                    echo $_SESSION['msgErr'];
                }
                else{
                    echo "pas d'erreur";
                }
            ?> -->
            <?= !empty($_SESSION['msgErr'])  ?  $_SESSION['msgErr'] :"" ?>
        </div>

        <form class="standard-form label-left" action="/user/connect" method="POST">
            <fieldset>
                <legend>Se logguer</legend>
                <ul>
                    
                    <li>
                        <label for="email">Email :</label>
                        <input id="email" name="email" type="text" style="border:1px solid #DEDEDC;" 
                        value="<?= !empty($_SESSION['$email'])  ?  $_SESSION['$email'] :"" ?>"  required>
                    </li>

                    <li>
                        <label for="password">Password :</label>
                        <input id="password" name="password" type="password" style="border:1px solid #DEDEDC;" value="" required>
                    </li>

                    
                    
                   
                    <li>
                        <input type="submit" value="Se connecter" title="Se connecter">
                    </li>
                </ul>
            </fieldset>
        </form>
    </section>







</div>
<?php require_once(ROOT . '/Views/partials/footer.php'); ?>
