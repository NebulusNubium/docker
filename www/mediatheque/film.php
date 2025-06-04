<?php 
    ob_start();
    $bdd = new PDO('mysql:host=mysql;dbname=gens;charset=utf8','root','root');
    if($_GET['status']=='logout'){
        session_unset();
        session_destroy();
    }
    $requestRead = $bdd->prepare('SELECT titre, realisateur, dure, genre, synopsys, user, prenom 
                                    FROM fiche
                                    LEFT JOIN users ON
                                    fiche.user = users.username; ');
    $requestRead->execute(array());
    var_dump($requestRead);
    while($data= $requestRead->fetch()){
    echo '<br> Titre du film: ' . $data['titre'] .' '. 'Nom du réalisateur: ' . $data['realisateur'] .' '. 'Durée du film: ' . $data['dure'] .'min '. 'Genre du film: ' . $data['genre'] .' ' . 'Par: ' . $data['prenom'] . ' '
;}
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
        <ul>
            <li><a href="fiche.php">Enregistrer un film</a></li>
            <li><a href="index.php">L'accueil</a></li>
            <li><a href="login.php">Register</a></li>
            <li><a href="logIn.php?status=logout">Log Out</a></li>
        </ul>
    </nav>
</body>
</html>