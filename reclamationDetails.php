<?php
   require "main.php";
?>
         <div class="return"><a href="recherche.php"><i class="fas fa-arrow-left"></i></a></div>
      </div>
   </header>
   <main>
        <h2>Détails de la réclamation.</h2>
        <div class="reclamation-liste">
           <?php


           $r_id=mysqli_real_escape_string($conn, $_GET['numero']);




         //----------------------------------------------DETAILS DE LA RECLAM------------------------------------------
           
            $sql= "SELECT * FROM reclamation WHERE r_id='$r_id'";
            $result= mysqli_query($conn, $sql);
            $queryResults= mysqli_num_rows($result);

            if($queryResults>0){
               while($row=mysqli_fetch_assoc($result)){
                  echo "<div class='reclamation-boite'>
                     <h3 class='nombre'>Numéro de réclamation: ".$row['r_id']."</h3>
                     <h4>Sujet: ".$row['sujet']."</4>
                     <p>Description: ".$row['description']."</p>
                     <p>Date: ".$row['r_date']."</p>";

                  if ($row['r_status']=="Ouverte"){ //Si la reclamation est ouverte on ne peut pas la reouvrir 
                     echo"<p >Satut: <e class='success'>".$row['r_status']."</e></p>
                     </div>";                   
                     if (isset($_SESSION['admin_uid'])){//L admin peut y repondre
                     echo "<p><a href='reponse.php'>Répondre</a></p>";
                     }
                  }

                  else if ($row['r_status']=="Réouverte"){//Une fois reouverte plus de lien pour repondre pour l admin
                     echo"<p>Satut: <e class='success'>".$row['r_status']."</e></p>
                     </div>";     
                  }

                  else{//Si elle est ferme 
                     if (isset($_SESSION['admin_uid'])){//l admin ne peut plus y repondre
                        echo "<p >Satut: <e class='erreur'>".$row['r_status']."</e></p></div>"; 
                     }  
                     else {//la personne peut la reouvrir
                        echo "<p>Satut: <e class='erreur'><a href='reouvrir.php'>".$row['r_status']."</e> </a> (clicker sur le statut pour réouvrir votre réclamation)</p></div>";
                     }
                  }
                  
               }
            }
            //------------------------xx----------------------DETAILS DE LA RECLAM------------------xx------------------------




            //----------------------------------------------REPONSE A LA RECLAM------------------------------------------
            $sql= "SELECT * FROM reponse WHERE r_id='$r_id'";
            $result= mysqli_query($conn, $sql);
            $queryResults= mysqli_num_rows($result);

            if($queryResults>0){
               while($row=mysqli_fetch_assoc($result)){
                  echo "<div>
                     <h3>Réponse</h3>
                     <p>Solution proposée: ".$row['reponse']."</p>
                     <p>Date: ".$row['rep_date']."</p>
                     </div>";
               }
            } 
            //---------------------------xx-------------------REPONSE A LA RECLAM----------------------xx--------------------
            



          //----------------------------------------------REOUVERTURE DE LA RECLAM------------------------------------------
            $sql= "SELECT * FROM reouverture WHERE r_id='$r_id'";
            $result= mysqli_query($conn, $sql);
            $queryResults= mysqli_num_rows($result);

            if($queryResults>0){
               while($row=mysqli_fetch_assoc($result)){
                  echo"</br><h3>Réouverture</h3>";
                  echo "<div><p>Raison de réouverture: ".$row['raison']."</p>
                        <p>Date: ".$row['r_date']."</p>";
                  if ($row['reponse']!=""){
                     echo"<p>--------------------------------------------------------------------------</p>
                     <p>Autre solution proposée: ".$row['reponse']."</p>
                     <p>Date: ".$row['rep_date']."</p></div>";
                  }
                  
                  if(isset($_SESSION['admin_uid']) && $row['reponse']==""){
                    echo "<p><a href='reouvrir.php'>Répondre</a></p>";                     
                  }

               }
            }
          //------------------------xx----------------------REOUVERTURE DE LA RECLAM------------------xx------------------------



           ?>
        </div>
    </main>

<?php
   require "footer.php";
?>