<?php
   require "main.php";
?>
    <main>
      <?php
      //message de connexion
         if (isset($_SESSION['utilisateur_uid'])){
            echo '<p>Bienvenue!</p>';
         }
         else{
            echo ' <p>Veuillez vous enregistrer</p>';
         }
      ?>
    </main>

<?php
   require "footer.php";
?>