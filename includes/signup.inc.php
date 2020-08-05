<?php
if (isset($_POST['signup-submit'])){

//colecter les informations du formulaire d'inscription

    require 'dbh.inc.php';
    $nomprenom = $_POST['unom'];
    $nom_utilisateur = $_POST['uid'];
    $email = $_POST['mail'];
    $telephone = $_POST['phone'];
    $mdp = $_POST['pwd'];
    $mdprepeter = $_POST['pwd-repeat'];

    //traiter les erreurs et corriger avant de les transmettre a la base de donnees


    //ne pas laisser les cases vides (je ne sais pas si cette partie va etre incluse dans le code de l appli)
    if ( empty($nomprenom) || empty($nom_utilisateur) || empty($mdp) || empty($mdprepeter) || empty($email) ) {
        header("Location: ../signup.php?error=emptyfields&uid=".$nom_utilisateur."&email=".$email);
        exit(); 
    }

    //nom et email valide 
    else if (!preg_match("/^[a-zA-Z0-9]*$/", $nom_utilisateur) && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: ../signup.php?error=invaliduid&mail");
        exit(); 
    }
    else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: ../signup.php?error=invalidmail&uid=".$nom_utilisateur);
        exit(); 
    }
    else if (!preg_match("/^[a-zA-Z0-9]*$/", $nom_utilisateur)) {
        header("Location: ../signup.php?error=invaliduid&mail=".$email);
        exit(); 
    }

    //mot de passe verifie
    else if ($mdp !== $mdprepeter){
        header("Location: ../signup.php?error=passwordCheck&mail=".$email."&uid=".$nom_utilisateur);
        exit(); 
    }
    else{
        //nom d'utilisateur non existant deja dans la base de donnees

        $sql ="SELECT u_nom_compte FROM utilisateur WHERE u_nom_compte=?";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)){
            header("Location: ../signup.php?error=sqlerror");
            exit(); 
        }
        else {
            mysqli_stmt_bind_param($stmt, "s", $nom_utilisateur);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            $resultCheck= mysqli_stmt_num_rows($stmt);
            if ($resultCheck>0){
                header("Location: ../signup.php?error=usertaken&mail=".$email);
                exit(); 
            }
            else {

                //tranmission des donnees vers la base de donnees avec quelques mesures de securite
                $sql ="INSERT INTO utilisateur (u_nom, u_nom_compte ,u_email, u_telephone ,u_mdp) VALUES (?, ?, ?, ?, ?)";
                $stmt = mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($stmt, $sql)){
                    header("Location: ../signup.php?error=sqlerror");
                    exit(); 
                }
                else {
                    $hashedPwd = password_hash($mdp, PASSWORD_DEFAULT);
                    mysqli_stmt_bind_param($stmt, "sssss",$nomprenom, $nom_utilisateur, $email, $telephone, $hashedPwd);
                    mysqli_stmt_execute($stmt);
                    header("Location: ../signup.php?signup=success");
                    exit(); 
                }
            }

        }
    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}
else{
    header("Location: ../signup.php");
    exit();
}
