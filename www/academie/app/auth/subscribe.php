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

    //        // requête join user-elements
    // $elementsJoin = $bdd->prepare('  SELECT u.id AS user_id, u.username AS username,
    //             GROUP_CONCAT(e.id 
    //                 ORDER BY e.id SEPARATOR ", ") 
    //                                 AS element_ids,
    //             GROUP_CONCAT(e.nom 
    //                 ORDER BY e.nom SEPARATOR ", ") 
    //                                 AS element_names
    //                                     FROM user_elements as ue
    //                                     LEFT JOIN users AS u
    //                                         ON ue.user_id = u.id
    //                                     LEFT JOIN elements AS e
    //                                         ON ue.element_id = e.id
    //                 GROUP BY u.id, u.username'
    //                             );
    //         $elements->execute(array());
    //         $data = $elements->fetch();
    // $elementsWrite = $bdd->prepare(' INSERT INTO ue(user_id, e.id)
    //                                 Values($_SESSION['username'],$_POST['element']')
?>

<?php include('../includes/head.php'); ?>
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

    <?php include('footer.php')?>
</body>
</html>