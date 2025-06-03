<?php
    ob_start();
 $bdd = new PDO('mysql:host=mysql;dbname=gens;charset=utf8','root','root');
    if (isset($_POST['realisateur']) && isset($_POST['titre']) && isset($_POST['dure']) && isset($_POST['synopsys']) && isset($_POST['genre']) ){
        $realisateur = htmlspecialchars(trim($_POST['realisateur']));
        $titre = htmlspecialchars(trim($_POST['titre']));
        $dure = htmlspecialchars(trim($_POST['dure']));
        $synopsys = htmlspecialchars(trim($_POST['synopsys']));
        $genre = htmlspecialchars(trim($_POST['genre']));

        $requestRead = $bdd->prepare('SELECT titre, realisateur, dure, genre, synopsys 
                                      FROM fiche');

        $requestRead->execute(array());

        $requestWrite = $bdd->prepare('INSERT INTO fiche(titre, realisateur, dure, genre, synopsys)
                                       VALUES(:titre,:realisateur, :dure, :genre, :synopsys)');

        $requestWrite->execute([
            'titre'=>$titre,
            'realisateur'=>$realisateur,
            'dure'=>$dure,
            'synopsys'=>$synopsys,
            'genre'=>$genre
    ]);
    $realisateur= htmlspecialchars($_POST['realisateur']);
    $titre= htmlspecialchars($_POST['titre']);
        while($data= $requestWrite->fetch()){
        echo $data;

    }
  }

    ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>fiche</title>
</head>
<body id="fiche">
    <nav>
        <ul>
            <li><a href="film.php">Les Films</a></li>
            <li><a href="index.php">L'accueil</a></li>
            <li><a href="login.php">Register</a></li>
        </ul>
    </nav>
    <form action="fiche.php" method="post">
            <input type="text" name="titre" placeholder="Entrez un titre">
            <input type="text" name="realisateur" placeholder="Entrez un realisateur">    
            <input type="text" name="dure" placeholder="Entrez une durée">
            <input type="text" name="synopsys" placeholder="Entrez un synopsys">    
            <input type="text" name="genre" placeholder="Entrez un genre">       
            <button type="submit">Envoyer</button>
    </form>

</body>
</html>