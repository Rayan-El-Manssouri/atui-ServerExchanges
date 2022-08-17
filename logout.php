<?php
//On dégage tous les erreurs inutiles. 
error_reporting(0);

// Connexion a la bdd
require_once 'bdd/database.php';
$database = new Database();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
</head>
<body>
    <h1>Page d'inscription</h1>
    <form method="POST" >
        <input type="email" placeholder="Email" name="email" required> <br> <br>
        <input type="password" placeholder="Mot de passe" name="password" required> <br> <br>
        <input type="submit" name="send" value="S'inscrire">
    </form>
    <?php 

    //On regarder si le formulaire est vide ou pas.
    if(!empty($_POST['send'])){
        // On évite les failles html
        $email = htmlentities($_POST['email']);

        $password = htmlentities($_POST['password']);
        $password_ash = password_hash($password, PASSWORD_DEFAULT);

        // On regarder si l'utilisateur existe ou pas.
        $query = "SELECT * FROM utilisateur WHERE BINARY email='".$email."'";
        $data = $database->read($query);

        if(!empty($data[0])){
                ?>
                    <script>
                        location.replace("logout.php?status=Email déjà enregistrer.")
                    </script>
                <?php

        }else{
            $query2 = "INSERT INTO `utilisateur`(`email`, `password`) VALUES ('$email','$password_ash')";
            $data2 = $database->read($query2);
            echo "Utilisateur bien rajouter."
            ?>
                <a href="sign.php">Revenir a la page de connexion.</a>
            <?php
        }
    }
    echo $_GET['status'];
    ?>
</body>
</html>