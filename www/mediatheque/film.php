<?php 
    ob_start();
    $bdd = new PDO('mysql:host=mysql;dbname=gens;charset=utf8','root','root');

    $requestRead = $bdd->prepare('SELECT titre, realisateur, dure, genre, synopsys 
                                    FROM fiche');

    $requestRead->execute(array());
    var_dump($requestRead);
    while($data= $requestRead->fetch()){
    echo '<br> Titre du film: ' . $data['titre'] .' '. 'Nom du réalisateur: ' . $data['realisateur'] .' '. 'Durée du film: ' . $data['dure'] .'min '. 'Genre du film: ' . $data['genre'] .' '
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
        </ul>
    </nav>
</body>
</html>