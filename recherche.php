<?php
   require "main.php";
?>
         <div class="return"><a href="index.php"><i class="fas fa-arrow-left"></i></a></div>
      </div>
    </header>
   <main>
        <h1>Chercher une réclamation</h1>
        <form action="recherchePage.php" method="POST">
            <input type="text" name="recherche" placeholder="RECHERCHE">
            <button type="submit" name= "recherche-submit">Chercher</button>            
        </form>
        <h2>Résultat</h2>
        <div class="reclamation-liste">
           <?php
            if (isset($_SESSION['admin_uid'])){
               $sql= "SELECT * FROM reclamation";
               $result= mysqli_query($conn, $sql);
               $queryResults= mysqli_num_rows($result);
               if($queryResults>0){
                  while($row=mysqli_fetch_assoc($result)){
                     echo "<div class='reclamation-boite'>
                     <a href='reclamationDetails.php?numero=".$row['r_id']."'><h3 class='nombre'>".$row['r_id']."</h3></a>
                     <h4>".$row['sujet']."</h4>
                     <p>".$row['description']."</p>
                     <p>".$row['r_date']."</p>";

                     if ($row['r_status']=="Ouverte"){  
                        echo"<p ><e class='success'>".$row['r_status']."</e></p>";
                     }
                     else if ($row['r_status']=="Réouverte"){
                        echo"<p><e class='success'>".$row['r_status']."</e></p>";     
                     }
                     else{
                        echo "<p ><e class='erreur'>".$row['r_status']."</e></p>";
                     }

                     echo "</div>";

                  }
               }
            }
            else if (isset($_SESSION['utilisateur_uid'])){
               echo "<div class='reclamation-boite'>Utilisez votre numéro de réclamation envoyé par email pour y accéder.</div>";
            }
           ?>
        </div>
   </main>

<?php
   require "footer.php";
?>