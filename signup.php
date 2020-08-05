<?php
   require "main.php";
?>
<!--Formulaire d'inscription--->
    <main>
        <h1>Inscription</h1>
        <?php
            if (isset($_GET['error'])){
                if ($_GET['error']=="emptyfields"){
                    echo '<p>Veuillez remplir toutes les cases.</p>';
                }
                else if($_GET['error']=="invaliduidmail"){
                    echo '<p>Nom d\'utilisateur et Email invalide. </p>';
                }
                else if($_GET['error']=="invaliduid"){
                    echo '<p>Nom d\'utilisateur invalide. </p>';
                }
                else if($_GET['error']=="invalidmail"){
                    echo '<p>Email invalide. </p>';
                }
                else if($_GET['error']=="passwordCheck"){
                    echo '<p>Veuillez vérifier votre mot de passe. </p>';
                }
                else if($_GET['error']=="usertaken"){
                    echo '<p>Nom d\'utilisateur existant. </p>';
                }
            }
            else if($_GET['signup']=="success") {
                echo '<p> Inscription accomplie. </p>
                <p>Veuillez vous identifier.</p>';
            }
        ?>
        <form action="includes/signup.inc.php" method="post">
            <input type="text" name="unom" placeholder="Nom et Prénom">
            <input type="text" name="uid" placeholder="Nom d'utilisateur">            
            <input type="text" name="mail" placeholder="Email">
            <input type="text" name="phone" placeholder="Numéro de téléphone">
            <input type="password" name="pwd" placeholder="Mot de passe">
            <input type="password" name="pwd-repeat" placeholder="Vérifier mot de passe">
            <button type="submit" name= "signup-submit">Inscription</button>
            
        </form>
    </main>

<?php
   require "footer.php";
?>