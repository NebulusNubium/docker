<?php session_start(); ?>
<?php ob_start(); ?>

<?php
    $bdd = new PDO('mysql:host=mysql;dbname=gens;charset=utf8','root','root');
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
    

</body>
</html>