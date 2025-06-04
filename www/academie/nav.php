<?php 
    ob_start();
    $bdd = new PDO('mysql:host=mysql;dbname=academie;charset=utf8','root','root');
    if($_GET['status']=='logout'){
        session_unset();
        session_destroy();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <nav>
        <li><a href="index.php">accueil</a></li>
        <li><a href="bestiaire.php">bestiaire</a></li>
        <li><a href="codex.php">codex</a></li>
        <li><a href="logIn.php">profil</a></li>
        <li><a href="index.php?status=logout">log out</a></li>
    </nav>
</body>
</html>

