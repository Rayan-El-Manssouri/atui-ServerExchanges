<?php
// On supprime toutes les erreurs 
error_reporting(0);

// Connexion à la base de données
require_once 'bdd/database.php';
$database = new Database();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="Formulaire d'inscription de Server Exchanges. ">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="index,follow">
    <link rel="canonical" href="https://alcapitan.github.io/atui">
    <meta name="theme-color" content="#e63300">
    <title>Inscription</title>
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
            <h1>Inscription</h1>
            <form method="POST">
                <input type="email" placeholder="Email" name="email" required>
                <input type="password" placeholder="Mot de passe" name="password" required>
                <?php echo $_GET['status']; ?>
                <input type="submit" name="send" value="S'inscrire">
            </form>
            <a href="login.html">J'ai déjà un compte</a>
        </article>
    </section>
    <?php 
    // On regarde si le formulaire est vide ou pas.
    if(!empty($_POST['send'])){
        // On évite les erreurs HTML
        $atuiServerExchanges_Sendemail = htmlentities($_POST['email']);

        $atuiServerExchanges_Sendpassword = htmlentities($_POST['password']);
        $atuiServerExchanges_SendpasswordHash = password_hash($atuiServerExchanges_Sendpassword, PASSWORD_DEFAULT);

        // On regarde si l'utilisateur est déjà enregistré.
        $atuiServerExchanges_query = "SELECT * FROM utilisateur WHERE BINARY email='".$atuiServerExchanges_Sendemail."'";
        $data = $database->read($atuiServerExchanges_query);

        if(!empty($data[0])){
            ?>
                <script>
                    location.replace("signin.php?status=Email déjà enregistré.")
                </script>
            <?php
        }else{
            $atuiServerExchanges_query2 = "INSERT INTO `utilisateur`(`email`, `password`) VALUES ('$atuiServerExchanges_Sendemail','$atuiServerExchanges_SendpasswordHash')";
            $data2 = $database->read($atuiServerExchanges_query2);

            echo "Utilisateur inscrit."
            ?>
                <a href="login.php">Aller à la page de connexion.</a>
            <?php
        }
    }
    ?>
    <script src="https://cdn.jsdelivr.net/gh/alcapitan/atui@dev/atui/kernel/main.js"></script>
</body>
</html>