
<?php
   require "main.php";
?>

            <div class="return"><a href="recherche.php"><i class="fas fa-arrow-left"></i></a></div>
        </div>
    </header>

<h1>Résultat de la recherche</h1>
<div class="reclamation-liste">

    <?php
        if (isset($_SESSION['admin_uid'])){
            if (isset($_POST['recherche-submit'])){
                $recherche = mysqli_real_escape_string($conn, $_POST['recherche']);
                $sql= "SELECT * FROM reclamation WHERE r_id='$recherche' OR sujet LIKE '%$recherche%' OR description LIKE '%$recherche%'";
    
                $result= mysqli_query($conn, $sql);
                $queryResult= mysqli_num_rows($result);
    
                if ($queryResult==1){
                    echo "<div class='reclamation-boite'><p class='success'>Il y a 1 résultat:</p></div>";
                }
                elseif($queryResult>1){
                    echo "<div class='reclamation-boite'><p class='success'>Il y a ".$queryResult." résultats:</p></div>";
                }
                else{
                    echo "<div class='reclamation-boite'><p class='erreur'>Aucun résultat!</p></div>";
                }

                if ($queryResult > 0) {
                    while($row = mysqli_fetch_assoc($result)){
                        echo "<a href='reclamationDetails.php?numero=".$row['r_id']."'><div class='reclamation-boite'><h3 class='nombre'>".$row['r_id']."</h3></a>
                        <h4>".$row['sujet']."</h4>
                        <p>".$row['description']."</p>
                        <p>".$row['r_date']."</p>
                        <p>".$row['r_status']."</p>
                        </div>";
    
                    } 
                } 
                
            }
        }


        else if (isset($_SESSION['utilisateur_uid'])){
            if (isset($_POST['recherche-submit'])){
                $recherche = mysqli_real_escape_string($conn, $_POST['recherche']);
                $sql= "SELECT * FROM reclamation WHERE r_id='$recherche'";
    
                $result= mysqli_query($conn, $sql);
                $queryResult= mysqli_num_rows($result);

                if ($queryResult==1){
                    echo "<div class='reclamation-boite'><p class='success'>Il y a 1 résultat:</p>";
                }
                elseif($queryResult>1){
                    echo "<div class='reclamation-boite'><p class='success'>Il y a ".$queryResult." résultats:</p>";
                }
                else{
                    echo "<div class='reclamation-boite'><p class='erreur'>Aucun résultat!</p></div>";
                }

                if ($queryResult > 0) {
            
                    while($row = mysqli_fetch_assoc($result)){
                        echo "<a href='reclamationDetails.php?numero=".$row['r_id']."'><h3 class='nombre'>".$row['r_id']."</h3></div></a>";
    
                    } 
                } 
                
            }
        }
    ?>
</div>
<?php
   require "footer.php";
?>