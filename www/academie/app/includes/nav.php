<?php 
$bdd = new PDO('mysql:host=mysql;dbname=academie;charset=utf8', 'root', 'root');
ob_start();
session_start();
function sanitarize($input){
    return htmlspecialchars(trim(strtolower($input)));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="/academie/asset/css/style.css">
</head>
<body>
    <nav>
        <div class="left-nav">
            <ul>
                <li><a href="/academie/index.php">accueil</a></li>
                <li><a href="/academie/app/includes/bestiaire.php">bestiaire</a></li>
                <li><a href="/academie/app/includes/codex.php">codex</a></li>
            </ul>
        </div>

        <div class="right-nav">
            <ul>
                <li><a href="/academie/app/auth/logIn.php">profil</a></li>
                <li><a href="/academie/app/auth/logout.php">logout</a></li>
                <li><a href="/academie/app/auth/subscribe.php">Register</a></li>
            </ul>
        </div>
    </nav>
</body>
</html>

