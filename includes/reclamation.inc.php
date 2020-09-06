<?php
if (isset($_POST['reclamation-submit'])){

    require 'dbh.inc.php';
    $sujet = $_POST['sujet'];
    $description = $_POST['description'];

    $str= 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890_,:';
    $str= str_shuffle($str);
    $r_id= substr($str,0,32);

    //traiter les erreurs et corriger avant de les transmettre a la base de donnees
    //ne pas laisser les cases vides
    if ( empty($description) || empty($sujet)) {
        header("Location: ../reclamation.php?error=emptyfields&Sujet=".$sujet."&Description=".$description);
        exit(); 
    }
    else {
        //tranmission des donnees vers la base de donnees avec quelques mesures de securite
        $sql ="INSERT INTO reclamation (r_id, sujet, description, r_date, r_status) VALUES (?, ?, ?, ?, ?)";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)){
            header("Location: ../reclamation.php?error=sqlerror");
            exit();
        }
        else {
            $date = date("d-m-Y");
            $r_status= "Ouverte";
            mysqli_stmt_bind_param($stmt, "sssss",$r_id, $sujet , $description, $date, $r_status);
            mysqli_stmt_execute($stmt);
            header("Location: ../reclamation.php?envoi=success");
            exit();
        }
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
    }
}
    
    
else{
    header("Location: ../reclamation.php");
    exit();
}