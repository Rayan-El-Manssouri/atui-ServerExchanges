<?php 

require_once '../function/auth.php';
session_start();
if(!est_connecter()){
    header("Location: ../sign.php");
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel</title>
</head>
<body>
    <form method="POST">
        <input type="submit" name="logout" value="Se déonnecter">
    </form>
    <?php 
    
    if(!est_connecter()){
        ?>
        <p>Vous êtes déconnecter.</p>
        <?php
    }else{
        ?>
        <p>Vous êtes connecter.</p>
        <?php
    }



    if(isset($_POST['logout'])){
        header("Location: ../function/logout.php");
    }
    
    ?>

</body>
</html>