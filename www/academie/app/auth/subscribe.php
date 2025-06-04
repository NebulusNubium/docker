<?php 
// Methode alternative au isset qui permet de vérifier si des requêtes de type POST ont bien été envoyé
include('../includes/nav.php') ;
if(isset($_POST['username']) && isset($_POST['password']) && isset($_POST['passwordConfirm'])){
    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']);
    $passwordConfirm = htmlspecialchars($_POST['passwordConfirm']);

    // REQUETE read qui va permettre de lire la table user
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
    header('location:/academie/index.php?success=4');}else{
        header('location:subscribe.php?error=1');
    }
    } 


?>

<?php include('../includes/head.php'); ?>
<body>
    <h1>Inscription</h1>
    
    <?php if(isset($_GET['error'])){ ?>
       <?php  switch($_GET['error']){
                case 1:
                    echo "<p class='error'>Vos mots de passe ne correspondent pas</p>";
                    break;
                case 2:
                    echo "<p class='error'>Ce nom d'utilisateur existe déjà</p>";
                    break;
            }
        } ?>

    <form action="subscribe.php" method="post">
        <label for="username">Votre nom d'utilisateur</label>
        <input type="text" name="username" id="username">
        <label for="password">Votre mot de passe</label>
        <input type="password" name="password" id="password">
        <label for="passwordConfirm">Confirmez votre mot de passe</label>
        <input type="password" name="passwordConfirm" id="passwordConfirm">

    </form>

    <h2>Choisis tes éléments</h2>
    <form>
        <input type="checkbox" id="element1" name="element1">
        <label for="element1"> Feu</label>
        <input type="checkbox" id="element2" name="element2">
        <label for="element2"> Eau</label>
        <input type="checkbox" id="element3" name="element3">
        <label for="element3"> Lumière</label>
        <input type="checkbox" id="element4" name="element4">
        <label for="element4"> Air</label>
        <input type="checkbox" id="element5" name="element5">
        <label for="element5"> Terre</label><br>
        <button>s'inscrire</button>
    </form> 
</body>
</html>