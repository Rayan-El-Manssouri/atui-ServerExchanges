<?php 
erroR_reporting(0);
require_once 'bdd/database.php';
$database = new Database();


?>

<!DOCTYPE html>
<html lang="en">
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
    if(!empty($_POST['send'])){
        $email = htmlentities($_POST['email']);
        $password = htmlentities($_POST['password']);
        $query = "SELECT * FROM utilisateur WHERE BINARY email='".$email."' AND BINARY password='".$password."' ";
        $data = $database->read($query);
        if(!empty($data[0])){
            ?>
                <script>
                    alert("Utilisateur déjà enregistrer.")
                    location.replace("")
                </script>
            <?php
        }else{
            $query2 = "INSERT INTO `utilisateur`(`email`, `password`) VALUES ('$email','$password')";
            $data2 = $database->read($query2);
            echo "Utilisateur bien rajouter."
            ?>
            <a href="sign.php">Revenir a la page de connexion.</a>
            <?php
        }
    }
    ?>


</body>
</html>