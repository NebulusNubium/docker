<?php 
include_once('../includes/head.php');
include_once('../includes/nav.php') ;
if(isset($_POST['username']) && isset($_POST['password']) && isset($_POST['passwordConfirm'])){
    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']);
    $passwordConfirm = htmlspecialchars($_POST['passwordConfirm']);


    $request = $bdd->prepare('  SELECT username, password
                                FROM users 
                                WHERE username = :username '
                            
    );

  $request->execute([
    'username' => $username
]);

    $data = $request->fetch();

        // Cryptage du mot de passe
    if($password == $passwordConfirm){
        $passwordCrypt = password_hash($password,PASSWORD_BCRYPT);

        // Préparation de la requête
$request = $bdd->prepare(
    'INSERT INTO users (username, password, role)
     VALUES (:username, :password, :role)'
);
$request->execute([
    'username' => $username,
    'password' => $passwordCrypt,
    'role'     => 'user'
]);
$userId = $bdd->lastInsertId();
    if(isset($_POST['element'])){
        //si champ rempli, alors on stock
        $elementsSelected=$_POST['element'];

        $requestSend= $bdd->prepare('INSERT INTO user_elements(user_id, element_id)
                                    VALUES (?, ?)');
        foreach($elementsSelected as $elementSelected){
            $requestSend->execute([$userId,$elementSelected]);
        }

    }
    header('location:/academie/index.php?success=4');
}else{
        header('location:subscribe.php?error=1');
    }
    }
    if(isset($_GET['error'])){ 
        switch($_GET['error']){
                case 1:
                    echo "<p class='error'>Vos mots de passe ne correspondent pas</p>";
                    break;
                case 2:
                    echo "<p class='error'>Ce nom d'utilisateur existe déjà</p>";
                    break;
            }
        }
?>

<?php 
    $readElements= $bdd->query('SELECT * FROM elements');
    $elements = $readElements->fetchAll();
?>
<body>
    <h1>Inscription</h1>
    
        <!-- idéalement, faire une boucle while pour lire tous les éléments sur la DTB et créer les checkbox au fur et à mesure, au cas où l'admin veut rajouter des éléments -->
    <h3>Crées ton compte et désignes tes éléments</h3>
    <form action="subscribe.php" method="post">
        <label for="username">Votre nom d'utilisateur</label>
        <input type="text" name="username" id="username">
        <label for="password">Votre mot de passe</label>
        <input type="password" name="password" id="password">
        <label for="passwordConfirm">Confirmez votre mot de passe</label>
        <input type="password" name="passwordConfirm" id="passwordConfirm"><br>

        <!-- JE BOUCLE MA LISTE DES ELEMENTS DE BDD POUR EN FAIRE AUTANT DE CHECKBOX -->
        <?php foreach($elements as $element) : ?>
            <label for="<?= $element['nom'] ?>"><?= $element['nom'] ?></label>
            <input type="checkbox" id="<?= $element['nom'] ?>" name="element[]" value="<?= $element['id'] ?>">
        <?php endforeach ?>

        <button type="submit">Register</button>
    </form>

    <?php include('footer.php')?>
</body>
</html>