<?php
if (isset($_POST['reouvrir-submit'])){

    require 'dbh.inc.php';
    $numero = $_POST['numero'];
    $raison= $_POST['raison'];

    //ne pas laisser les cases vides (je ne sais pas si cette partie va etre incluse dans le code de l appli)
    if ( empty($numero) || empty($raison)) {
        header("Location: ../reouvrir.php?error=emptyfields&numero=".$numero."&raison=".$raison);
        exit(); 
    }
    else{
        $sql ="SELECT r_id FROM reclamation WHERE r_id=?";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)){
            header("Location: ../reouvrir.php?error=sqlerror");
            exit(); 
        }
        else {
            mysqli_stmt_bind_param($stmt, "s", $numero);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            $resultCheck= mysqli_stmt_num_rows($stmt);
            if ($resultCheck==0){
                header("Location: ../reouvrir.php?error=AucuneReclamation&".$numero);
                exit(); 
            }
            else{
                $sql ="INSERT INTO reouverture(r_id, raison, r_date) VALUES (?, ?, ?)";
                $stmt = mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($stmt, $sql)){
                    header("Location: ../reouvrir.php?error=sqlerror");
                    exit(); 
                }
                else {
                    $date = date("Y-m-d");
                    mysqli_stmt_bind_param($stmt, "sss",$numero, $raison, $date);
                    mysqli_stmt_execute($stmt);
                    $sql ="UPDATE reclamation SET r_status = ? WHERE r_id=?";
                    $stmt = mysqli_stmt_init($conn);
                    if (!mysqli_stmt_prepare($stmt, $sql)){
                        header("Location: ../reouvrir.php?error=sqlerror");
                        exit(); 
                    }
                    else {
                        $statut="Réouverte";//Reouverte car tu as utilise ouverte comme condition pour le lien vers reponse 
                        mysqli_stmt_bind_param($stmt, "ss",$statut, $numero);
                        mysqli_stmt_execute($stmt);
                        header("Location: ../reouvrir.php?envoi=success");
                        exit(); 
                    }
                }
            }
        }
        
    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}

else{
    header("Location: ../reouvrir.php");
    exit();
}