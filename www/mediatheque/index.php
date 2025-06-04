<?php session_start(); ?>
<?php ob_start(); ?>

<?php
    $bdd = new PDO('mysql:host=mysql;dbname=gens;charset=utf8','root','root');
    if($_GET['status']=='logout'){
        session_unset();
        session_destroy();
    }
        if (isset($_POST['nom']) && isset($_POST['prenom'])){
            $nom    = htmlspecialchars(trim($_POST['nom']));
            $prenom = htmlspecialchars(trim($_POST['prenom']));
            $pseudo = htmlspecialchars(trim($_POST['pseudo']));
            $mdp = htmlspecialchars(trim($_POST['mdp']));
            $hashing = password_hash($mdp, PASSWORD_ARGON2ID);
            $requestRead = $bdd->prepare('SELECT prenom, nom, username, mdp FROM users');
            $requestRead->execute(array());
            $requestWrite = $bdd->prepare('INSERT INTO users(prenom, nom, username, mdp)
                                            VALUES(:prenom,:nom, :username, :mdp)');
            $requestWrite->execute([
                'prenom'=>$prenom,
                'nom'=>$nom,
                'username'=>$pseudo,
                'mdp'=>$hashing
        ]);
        }
    
        $requestRead = $bdd->prepare('SELECT id,titre, realisateur, dure, genre, synopsys 
                                    FROM fiche
                                    ORDER BY id DESC
                                    LIMIT 3');

    $requestRead->execute(array());
    var_dump($requestRead);

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
            <li><a href="../mediatheque/fiche.php">fiche de film</a></li>
            <li><a href="logIn.php">Log In</a></li>
            <li><a href="logIn.php?status=logout">Log Out</a></li>
        </ul>
    </nav>
    <form action="index.php" method="post">
            <input type="text" name="prenom" placeholder="Entrez un prenom"><br>
            <input type="text" name="nom" placeholder="Entrez un nom"><br>
            <label>Pseudo : <input type="text" name="pseudo" placeholder="Pseudo"></label><br>
        <label>Mot de passe : <input type="password" name="mdp" placeholder="Mot de passe"></label><br>            
            <button type="submit">Envoyer</button>
    </form>
    <?php var_dump($_SESSION['user']);
    echo 'Bonjour ' . $_SESSION['user'] . ' !' ?>
    
    
    <?php 
        while($data=$requestRead->fetch()){ 
          echo '<br> Titre du film: ' . $data['titre'] .' '. 'Nom du réalisateur: ' . $data['realisateur'] .' '. 'Durée du film: ' . $data['dure'] .'min '. 'Genre du film: ' . $data['genre'] . '<button><a href="synopsys.php?id=' . $data['id'].">Voir Plus</a></button>'";}
    ?>
</body>
</html>