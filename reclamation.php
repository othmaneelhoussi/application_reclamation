
<?php
   require "main.php";
?>

            <div class="return"><a href="index.php"><i class="fas fa-arrow-left"></i></a></div>
        </div>
    </header>
    <main>
        <h1>Réclamation</h1>
        <?php
            ini_set('display_errors',0);
            if (isset($_GET['error'])){
                echo "Erreur!";
                if ($_GET['error']=="emptyfields"){
                    echo '<p class="erreur">Veuillez remplir toutes les cases!</p>';
                }
            }
            else if($_GET['envoi']=="success") {

                /* Namespace alias. 
                use PHPMailer\PHPMailer\PHPMailer;
                use PHPMailer\PHPMailer\Exception;

                require 'PHPMailer\Exception.php';
                require 'PHPMailer\PHPMailer.php';
                require 'PHPMailer\SMTP.php';

                $mail = new PHPMailer(TRUE);
                
                try {
                $mail->setFrom('othmaneelhoussi22@gmail.com', 'Me');
                $mail->addAddress('othmaneelhoussi2205@gmail.com', 'Him');
                $mail->Subject = 'Force';
                $mail->Body = 'There is a great disturbance in the Force.';

                $mail->isSMTP();
   
                $mail->Host = 'smtp@gmail.com';
                $mail->SMTPAuth = TRUE;
                $mail->SMTPSecure = 'tls';
                $mail->Username = 'othmaneelhoussi22@gmail.com';
                $mail->Password = 'milou0071';
                $mail->Port = 587;

                $mail->send();
                }
                catch (Exception $e)
                {
                echo $e->errorMessage();
                }
                catch (\Exception $e)
                {
                echo $e->getMessage();
                }*/
                echo '<p class="success"> Votre demande a été enregistré avec succès! </p>';
            }
        ?>
        <form action="includes/reclamation.inc.php" method="post" enctype="multipart/form-data">
        <input type="text" name="sujet" placeholder="Sujet de la réclamation"> 
        <br><br>
        <textarea name="description" placeholder="Description de la réclamation" cols="40" rows="10"></textarea>
        <br><br>
        <label for="file">Sélectionner un document: </label> </br>  
        <input type="file" name="document">
        <br><br>
        <button type="submit" name= "reclamation-submit" >Envoyer</button> 
        </form>

    </main>

<?php
   require "footer.php";
?>
