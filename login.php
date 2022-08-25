<?php  
error_reporting(0);
// Connexion à la base de données
require_once 'bdd/database.php';
// Création de l'instance de la classe
$database = new Database();

// Démarrage de la session (à mettre dans toutes les pages)
session_start();

// Récupération de la function est_connecter (Boolean)
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
    <meta name="description" content="Formulaire de connexion de Server Exchanges. ">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="index,follow">
    <link rel="canonical" href="https://alcapitan.github.io/atui">
    <meta name="theme-color" content="#e63300">
    <title>Connexion</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&family=Red+Hat+Display&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/gh/alcapitan/atui@dev/atui/kernel/main.css">
    <link rel="stylesheet" type="text/css" href="forms.css">
    <link rel="icon" type="img/png" href="https://cdn.jsdelivr.net/gh/alcapitan/atui@dev/patch/icons/logo.png">
</head>
<body>
    <section>
        <article>
            <img src="https://cdn.jsdelivr.net/gh/alcapitan/atui@dev/patch/icons/logo.png" alt="Logo d'ATUI">
            <h1>Connexion</h1>
            <form method="POST">
                <input type="email" placeholder="Email" name="email" required>
                <input type="password" placeholder="Mot de passe" name="password" required>
                <?php echo $_GET['status'] ?>
                <input type="submit" name="send" value="Se connecter">
                <?php 
                if(!empty($_POST['send'])){
                    // htmlentities est une function en php pour éviter les erreurs HTML.
                    $atuiServerExchanges_Sendemail = htmlentities($_POST['email']);
                    $atuiServerExchanges_Sendpassword = htmlentities($_POST['password']);
                    // BINARY est une fonction en sql qui ne prend pas en compte les majuscules et minuscules.
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
                            $atuiServerExchanges_Error = "Email et mot de passe incorrect";
                            ?>
                                <script>
                                    location.replace("signin.php?status=<?=$atuiServerExchanges_Error?>")
                                </script>
                            <?php
                        }
                    }
                    }
                ?>
            </form>
            <a href="signin.html">Je n'ai pas de compte</a>
        </article>
    </section>
    <script src="https://cdn.jsdelivr.net/gh/alcapitan/atui@dev/atui/kernel/main.js"></script>
</body>
</html>