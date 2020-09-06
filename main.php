<?php
    require 'includes/dbh.inc.php';
    session_start();
?>
<!Doctype html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Application de réclamation </title>
        <link rel="stylesheet" href="styles/basics.css">
        
    <link rel="stylesheet" href="styles/all.css">
        <link href="https://fonts.googleapis.com/css?family=Amatic+SC|Baloo+Da+2|Shadows+Into+Light&display=swap" rel="stylesheet">

    </head>
    <body>
        <header>
            <div class="top">
            <?php
               if (isset($_SESSION['utilisateur_uid']) || isset($_SESSION['admin_uid']) ){
                    echo '<div class="logout"><form action="includes/logout.inc.php" method= "post">
                    <button type="submit" name="logout-submit">Se déconnecter</button>
                    </form> </div>';
                }
            ?>
        
    