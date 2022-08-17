<?php  
error_reporting(0);
//Connexion a la bdd 
require_once 'bdd/database.php';
// Création de l'instance de la classe
$database = new Database();

//Démarage de la session (a mettre dans toutes les pages.)
session_start();

//Récuperation de la function est_connecter (Boolean)
require_once 'function/auth.php';

if(!est_connecter()){
    ?>
    <p>Vous êtes déconnecter.</p>
    <?php
}else{
    ?>
    <p>Vous êtes connecter.</p>
    <?php
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
</head>
<body>
    <h1>Page de connexion</h1>
    <form method="POST" >
        <input type="email" placeholder="Email" name="email" required> <br> <br>
        <input type="password" placeholder="Mot de passe" name="password" required> <br> <br>
        <input type="submit" name="send">
        <a href="logout.php">
            Je n'ai pas de compte
        </a>
    </form>
<?php 
    if(!empty($_POST['send'])){
            // htmlentities est une function en php pour éviter les fails du code html.
            $atuiServerExchanges_Sendemail = htmlentities($_POST['email']);
            $atuiServerExchanges_Sendpassword = htmlentities($_POST['password']);
            //BINARY est en sql pour qui prend compte des majuscule est minuscule.
            $query = "SELECT * FROM utilisateur WHERE BINARY email='".$atuiServerExchanges_Sendemail."' AND BINARY password='".$atuiServerExchanges_Sendpassword."' ";
            $data = $database->read($query);

            if(!empty($data[0])){
                //Recuperation de l'email
                $_SESSION['email'] = $data[0]["email"];

                //Recuperation de l'id de l'utilisateur ce qui ous permettra de savoir a qui ça appartient.
                $_SESSION['id'] = $data[0]["IdUtilisateur"];

                // Variable connecte qui dit si le compte connecter ou pas. $_SESSION['connecte'] = 0 => déconnecter ,  $_SESSION['connecte'] = 1 => connecter.
                $_SESSION['connecte'] = 1;
                ?>
                    <script>
                        // On le redirige aux panel si tous est ok.
                        location.replace("confirmer/panel.php");
                    </script>
                <?php
            }else{
                $atuiServerExchanges_Error = "Mot de passe ou email incorect";
                ?>
                    <script>
                        location.replace("sign.php?status=<?=$atuiServerExchanges_Error?>")
                    </script>
                <?php
            }
        }
        
        echo $_GET['status'];
        ?>
</body>
</html>