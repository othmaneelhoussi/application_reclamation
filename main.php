<?php
    session_start();
?>
<!Doctype html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Réclamation</title>
        <link rel="stylesheet" href="styles/main-footer.css">
        <link href="https://fonts.googleapis.com/css?family=Amatic+SC|Baloo+Da+2|Shadows+Into+Light&display=swap" rel="stylesheet">

    </head>
    <body>

        <header>
            <nav>

                <ul class="sections"> <!-----Section de l'application susceptible de changer ------>
                    <li><a href="#">Home</a></li>
                    <li><a href="#">Réclamations et Réponses</a></li>
                </ul>
                <div>
                    <?php
                        //formulaire de login et inscription + messages de connexion et deconnexion
                        if (isset($_SESSION['utilisateur_uid'])){
                            echo '<div class="login"><form action="includes/logout.inc.php" method= "post">
                            <button type="submit" name="logout-submit">Se déconnecter</button>
                            </form> </div>';
                        }
                        else{
                            echo ' <div class="signup"><form action="includes/login.inc.php" method= "post">
                            <input type="text" name= "mailuid" placeholder="Nom d\'utilisateur/Email...">
                            <input type="password" name= "pwd" placeholder="Mot de passe">
                            <button type="submit" name="login-submit">S\'identifier</button>
                            </form> 
                            <a href="signup.php">Inscription</a> </div>';
                        }
                    ?>
                </div>
            </nav>
        </header>