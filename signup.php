<?php
   require "main.php";
?>
<!--Formulaire d'inscription--->
        
            <div class="return"><a href="index.php"><i class="fas fa-arrow-left"></i></a></div>
        </div>
    </header>
    <main>
        <div class="preface">
            <h1>Inscription</h1>
            <?php
                ini_set('display_errors',0);
                if (isset($_GET['error'])){
                    if ($_GET['error']=="emptyfields"){
                        echo '<p class="erreur">Veuillez remplir toutes les cases!</p>';
                    }
                    else if($_GET['error']=="invaliduidmail"){
                        echo '<p class="erreur">Nom d\'utilisateur et Email invalide! </p>';
                    }
                    else if($_GET['error']=="invaliduid"){
                        echo '<p class="erreur">Nom d\'utilisateur invalide! </p>';
                    }
                    else if($_GET['error']=="invalidmail"){
                        echo '<p class="erreur">Email invalide! </p>';
                    }
                    else if($_GET['error']=="passwordCheck"){
                        echo '<p class="erreur">Veuillez vérifier votre mot de passe! </p>';
                    }
                    else if($_GET['error']=="usertaken"){
                        echo '<p class="erreur">Nom d\'utilisateur existant! </p>';
                    }
                }
                else if($_GET['signup']=="success") {
                    echo '<p class="success"> Inscription accomplie! </p>
                    <p>Veuillez vous identifier.</p>';
                }
            ?>
            <form action="includes/signup.inc.php" method="post">
                <input class='signup-el' type="text" name="unom" placeholder="Nom et Prénom">
                <input class='signup-el' type="text" name="uid" placeholder="Nom d'utilisateur"> 
                <br>           
                <input class='signup-el' type="text" name="mail" placeholder="Email">
                <input class='signup-el' type="text" name="phone" placeholder="Numéro de téléphone">
                <br>
                <input class='signup-el' type="password" name="pwd" placeholder="Mot de passe">
                <input class='signup-el' type="password" name="pwd-repeat" placeholder="Vérifier mot de passe">
                <br>
                <button class='signup-el' type="submit" name= "signup-submit">Inscription</button>
                
            </form>
        </div>
    </main>

<?php
   require "footer.php";
?>