 <?php
    ob_start();
 $bdd = new PDO('mysql:host=mysql;dbname=gens;charset=utf8','root','root');
 if (isset($_POST['pseudo']) && isset($_POST['mdp'])){
            $pseudoInput = $_POST['pseudo'];
            $mdpInput = $_POST['mdp'];
            $credentialsDTB = $bdd->prepare('SELECT username, mdp 
                        FROM users
                        WHERE username = :pseudo');

            $credentialsDTB->execute(array('username'=>$pseudoInput));
        var_dump($credentialsDTB);
        $data = $credentialsDTB->fetch();
        var_dump($data);
            $hash      = password_hash($mdpInput, PASSWORD_ARGON2ID);
        if (password_verify($credentialsDTB[1], $hash)){
            header('Location: https://github.com/NebulusNubium');
            exit;
        }else{
            header('Location: index.php?error=lol');
            exit;
    }}?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log In</title>
</head>
<body>
    <!-- mdp -->
  <form action="login.php" method="post">
        <label>Pseudo : <input type="text" name="pseudo" placeholder="Pseudo"></label><br>
        <label>Mot de passe : <input type="password" name="mdp" placeholder="Mot de passe"></label><br>
        <button type="submit" name="register">Register</button>
        <button type="submit" name="login">Login</button>
    </form>

</body>
</html>