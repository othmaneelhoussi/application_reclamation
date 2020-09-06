<?php
if (isset($_POST['reponse-submit'])){

//colecter les informations du formulaire d'inscription
    require 'dbh.inc.php';
    $numero = $_POST['numero'];
    $reponse= $_POST['reponse'];
    $statut= "";

    //ne pas laisser les cases vides (je ne sais pas si cette partie va etre incluse dans le code de l appli)
    if ( empty($numero) || empty($reponse)) {
        header("Location: ../reponse.php?error=emptyfields&numero=".$numero."&reponse=".$reponse);
        exit(); 
    }
    /*else if ($statut == 1 || $statut == 2){
        header("Location: ../reponse.php?error=error&statutnonvalide=".$statut);
        exit(); 
    }*/
    else{
        //tranmission des donnees vers la base de donnees avec quelques mesures de securite
        $sql ="SELECT r_id FROM reclamation WHERE r_id=?";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)){
            header("Location: ../reponse.php?error=sqlerror");
            exit(); 
        }
        else {
            mysqli_stmt_bind_param($stmt, "s", $numero);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            $resultCheck= mysqli_stmt_num_rows($stmt);
            if ($resultCheck==0){
                header("Location: ../reponse.php?error=AucuneReclamation&numero=".$numero);
                exit();
            }
            else{
                $sql ="SELECT r_id FROM reponse WHERE r_id=?";
                $stmt = mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($stmt, $sql)){
                    header("Location: ../reponse.php?error=sqlerror");
                    exit(); 
                }
                else {
                    mysqli_stmt_bind_param($stmt, "s", $numero);
                    mysqli_stmt_execute($stmt);
                    mysqli_stmt_store_result($stmt);
                    $resultCheck= mysqli_stmt_num_rows($stmt);
                    if ($resultCheck > 0){
                        header("Location: ../reponse.php?error=ReclamationRepondue&".$numero);
                        exit(); 
                    }
                    else {
                        $sql ="INSERT INTO reponse (r_id, reponse, rep_date) VALUES (?, ?, ?)";
                        $stmt = mysqli_stmt_init($conn);
                        if (!mysqli_stmt_prepare($stmt, $sql)){
                            header("Location: ../reponse.php?error=sqlerror");
                            exit();
                            }
                        else {                           
                            $date = date("Y-m-d");
                            mysqli_stmt_bind_param($stmt, "sss",$numero, $reponse, $date);
                            mysqli_stmt_execute($stmt);

                            $sql ="UPDATE reclamation SET r_status = ? WHERE r_id=?";
                            $stmt = mysqli_stmt_init($conn);
                            if (!mysqli_stmt_prepare($stmt, $sql)){
                                header("Location: ../reponse.php?error=sqlerror");
                                exit(); 
                            }
                            else{
                                $statut="Fermée";
                                mysqli_stmt_bind_param($stmt, "ss",$statut, $numero);
                                mysqli_stmt_execute($stmt);
                                header("Location: ../reponse.php?envoi=success");
                                exit(); 
                            }
                        
                        }
                    }    
                        
                    
                }
            }
        
        }
    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}
else{
    header("Location: ../reponse.php");
    exit();
}