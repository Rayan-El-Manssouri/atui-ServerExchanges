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
        <?php echo $_GET['status'] ?>

        <input type="submit" name="send">

        <a href="signin.php">
            Je n'ai pas de compte
        </a>
    </form>
<?php 
    if(!empty($_POST['send'])){
            // htmlentities est une function en php pour éviter les fails du code html.
            $atuiServerExchanges_Sendemail = htmlentities($_POST['email']);
            $atuiServerExchanges_Sendpassword = htmlentities($_POST['password']);
            //BINARY est en sql pour qui prend compte des majuscule est minuscule.
            $query = "SELECT * FROM utilisateur WHERE BINARY email='".$atuiServerExchanges_Sendemail."'";
            $data = $database->read($query);
            foreach ($data as $dataV2 ) {
                $atuiServerExchanges_SendpasswordHash = $dataV2['password'];
            }
            if(!empty($data[0])){
                if(password_verify($atuiServerExchanges_Sendpassword, $atuiServerExchanges_SendpasswordHash)){
                    $_SESSION['connecte'] = 1;
                    header("Location: confirmer/panel.php");
                }else{
                    $atuiServerExchanges_Error = "Mot de passe ou email incorect";
                    ?>
                        <script>
                            location.replace("signin.php?status=<?=$atuiServerExchanges_Error?>")
                        </script>
                    <?php
                }
            }
            }
        ?>
</body>
</html>