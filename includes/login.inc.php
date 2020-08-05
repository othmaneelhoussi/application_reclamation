<?php
if (isset($_POST['login-submit'])) {

    require 'dbh.inc.php';

    //collecte des infos rentre pour connexion
    $mailuid = $_POST['mailuid'];
    $mdp = $_POST['pwd'];

    //case vide (je ne sais pas si ca va etre inclu dans le code final)
    if ( empty($mailuid) || empty($mdp) ){
        header("Location: ../index.php?error=emptyfiles");
        exit();
    }
    else{
        //verification des infos depuis la base de donnees
        $sql ="SELECT * FROM utilisateur WHERE u_nom_compte=? OR u_email=?;";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)){
            header("Location: ../index.php?error=sqlerror");
            exit();
        }
        else{
            mysqli_stmt_bind_param($stmt, "ss", $mailuid, $mailuid);
            mysqli_stmt_execute($stmt);
            $result =mysqli_stmt_get_result($stmt);
            if ($row= mysqli_fetch_assoc($result)){
                $pwdCheck= password_verify($mdp, $row['u_mdp']);
                if ($pwdCheck==false) {
                    header("Location: ../index.php?error=wrongpwd");
                    exit();
                }
                else if($pwdCheck==true){
                    session_start();
                    $_SESSION['utilisateur_id'] = $row['u_id'];
                    $_SESSION['utilisateur_uid'] = $row['u_nom_compte'];

                    header("Location: ../index.php?login=success");
                    exit();
                }
                else{
                    header("Location: ../index.php?error=wrongpwd");
                    exit();
                }
            }
            else{
                header("Location: ../index.php?error=nouser");
                exit();
            }

        }

    }




}
else{
    header("Location: ../index.php");
    exit();
}