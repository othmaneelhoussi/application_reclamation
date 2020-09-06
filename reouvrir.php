<?php
   require "main.php";
?>
            <div class="return"><a href="recherche.php"><i class="fas fa-arrow-left"></i></a></div>
        </div>
    </header>
    <main>

        <?php
            ini_set('display_errors',0);
            if(isset($_SESSION["admin_uid"])){        
                echo "<h1>Refermeture de la réclamation</h1>";
            }
            else{
                echo "<h1>Réouverture de la réclamation</h1>";
            }


            if (isset($_GET['error'])){
                if ($_GET['error']=="emptyfields"){
                    echo '<p class="erreur">Veuillez remplir toutes les cases!</p>';
                }
                if ($_GET['error']=="AucuneReclamation"){
                    echo '<p class="erreur">Aucune réclamation trouvée!</p>';
                }
            }
            else if($_GET['envoi']=="success") {
                echo '<p class="success"> Votre réponse a été enregistrée avec succès!</p>';
            }
        ?>
        
        <?php
        if (isset($_SESSION['admin_uid'])){
            echo'<form action="includes/reouvrirAdmin.inc.php" method="POST"><input type="text" name="numero" placeholder="Numéro de réclamation"> 
            <br><br>
            <textarea name="reponse" placeholder="Réponse" cols="40" rows="10"></textarea>
            <br><br>
            <button type="submit" name= "reouvrir-submit" >Envoyer</button></form>';
        }
        else {
            echo'<form action="includes/reouvrir.inc.php" method="POST"><input type="text" name="numero" placeholder="Numéro de réclamation"> 
            <br><br>
            <textarea name="raison" placeholder="Raison" cols="40" rows="10"></textarea>
            <br><br>
            <button type="submit" name= "reouvrir-submit" >Envoyer</button></form>';
        }
        ?>
    </main>

<?php
   require "footer.php";
?>