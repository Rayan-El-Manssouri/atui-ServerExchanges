<?php  
require_once 'bdd/database.php';
$database = new Database();
session_start();
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
            Inscription
        </a>
    </form>
<?php 
    if(!empty($_POST['send'])){
        $email = htmlentities($_POST['email']);
        $password = htmlentities($_POST['password']);
        $query = "SELECT * FROM utilisateur WHERE BINARY email='".$email."' AND BINARY password='".$password."' ";
        $data = $database->read($query);
        if(!empty($data[0])){
            $_SESSION['email'] = $data[0]["email"];
            $_SESSION['id'] = $data[0]["IdUtilisateur"];
            $_SESSION['connecte'] = 1;
            ?>
            <script>
            location.replace("confirmer/panel.php");
            </script>
            <?php
            die();
        }else{
        ?>
        <script>
            alert("Email ou le mot de passe est incorect.")
            location.replace("")
        </script>            
        <?php
         }
        }
        ?>
</body>
</html>