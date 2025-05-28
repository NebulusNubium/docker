<?php
    ob_start();
    $bdd = new PDO('mysql:host=mysql;dbname=gens;charset=utf8','root','root');
    $requestRead = $bdd->prepare('SELECT prenom, nom FROM users');
    $requestRead->execute(array());

    while ($data = $requestRead->fetch()){
        echo $data['nom'] . ' ' . $data['prenom'] . '<br>';
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
    <!-- <h1><php echo $nom $prenom ?</h1>
    <form action="index.php" method="post">
            <input type="text" name="prenom" placeholder="Entrez un animal">
            <input type="text" name="nom" placeholder="Entrez un animal">            
            <button type="submit">Envoyer</button>
    </form>
</form> -->

</body>
</html>