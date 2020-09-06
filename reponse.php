<?php
   require "main.php";
?>

            <div class="return"><a href="recherche.php"><i class="fas fa-arrow-left"></i></a></div>
        </div>
    </header>
    <main>
        <h1>Reéponse à la réclamation</h1>
        <?php
            ini_set('display_errors',0);
            if (isset($_GET['error'])){
                if ($_GET['error']=="emptyfields"){
                    echo '<p class="erreur">Veuillez remplir toutes les cases!</p>';
                }
                if ($_GET['error']=="AucuneReclamation"){
                    echo '<p class="erreur">Aucune réclamation trouvée!</p>';
                }
                if ($_GET['error']=="ReclamationRepondue"){
                    echo '<p class="erreur">Réclamation déjà prise en charge!</p>';
                }
            }
            else if($_GET['envoi']=="success") {
                echo '<p class="success"> Votre réponse a été enregistrée avec succès!</p>';
            }
        ?>
        <form action="includes/reponse.inc.php" method="POST">
        <input type="text" name="numero" placeholder="Numéro de réclamation"> 
        <br><br>
        <textarea name="reponse" placeholder="Réponse" cols="40" rows="10"></textarea>
        <br><br>
        <!------ <input type="checkbox" name="nv-statut" value="fermer" class="checkbox" />Fermer la réclamation<br/> ---Cause un probleme(quellesconditions utilise dans reclamationdetails)-->
        <button type="submit" name= "reponse-submit" >Envoyer</button> 
        </form>
    </main>

<?php
   require "footer.php";
?>