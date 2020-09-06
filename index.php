<?php
   require "main.php";
?>

      </div>
   </header>
   <main>
      
      <?php
         //formulaire de login et inscription + messages de connexion et deconnexion
         if (!isset($_SESSION['utilisateur_uid']) && !isset($_SESSION['admin_uid'])){
            echo '<div class= "main"> <div class="login"><form action="includes/login.inc.php" method= "post">
            <input class="login-el" type="text" name= "mailuid" placeholder="Nom d\'utilisateur ou Email...">
            <input class="login-el" type="password" name= "pwd" placeholder="Mot de passe">
            <button class="login-el" type="submit" name="login-submit">S\'identifier</button>
            </form> </div>
            <div><a href="signup.php" class="signup-link">Inscription</a></div></div></br>';
         }
      ?>
      

      <div class="preface">
         <?php
         //message de connexion
            if (isset($_SESSION['utilisateur_uid'])){
               echo '<p>Bienvenue!</p>
               <div class="nav">
               <div class="onglet"><a href="reclamation.php">Envoyer une réclamation</a></div> 
               <div class="onglet"><a href="recherche.php">Rechercher une une réclamation</a> </div>
               </div>';
            }
            else if (isset($_SESSION['admin_uid'])){
               echo '<p>Bienvenue!</p>
               <div class="nav">
               <div><a href="recherche.php">Rechercher une une réclamation</a> </div>
               </div>';
            }
            else{
               echo '<p>Veuillez vous inscrire ou vous identifier</p>';
            }
         ?>
      </div>
   </main>

<?php
   require "footer.php";
?>