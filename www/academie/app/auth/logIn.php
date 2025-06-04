<?php include ('../includes/nav.php');
?>

<?php include('../includes/head.php'); ?>

<!DOCTYPE html>
<html lang="en">

<body>
    <?php if (!isset($_SESSION['username'])) {
    if($_SERVER['REQUEST_METHOD']==='POST'){
            $username = $_POST['username'];
            $password = $_POST['password'];
    
            $request = $bdd->prepare('  SELECT * 
                                        FROM users
                                        WHERE username=:username'
                                    );
    
            $request->execute(array( 'username' => $username ));
    
            $data = $request->fetch();
            
            if(password_verify($password,$data['password'])){
                $_SESSION['username']=$data['id'];
                header('location:/academie/index.php?success=5');
            }else{
                header('location:login.php?error=1');
            }
        
        }
}else{
    echo 'hello';
}
?>
        <h1>Connexion</h1>
    <?php if(isset($_GET['error'])):?>
        <p class="error">Nom d'utilisateur ou mot de passe incorrect</p>
    <?php endif?>
    <form action="login.php" method="post">
        <label for="username">Votre nom d'utilisateur</label>
        <input type="text" name="username" id="username">
        <label for="password">Votre mot de passe</label>
        <input type="password" name="password" id="password">
        <button>se connecter</button>
    </form>

    <h1>Mon Profil</h1>
    <h2>Mes éléments</h2>
    <form>
        <input type="checkbox" id="element1" name="element1" value="Bike">
        <label for="element1"> Feu</label>
        <input type="checkbox" id="element2" name="element2" value="Car">
        <la2el for="element2"> Eau</label>
        <input type="checkbox" id="element3" name="element3" value="Boat">
        <label for="element3"> Lumière</label>
        <input type="checkbox" id="element4" name="element4" value="Boat">
        <label for="element4"> Air</label>
        <input type="checkbox" id="element5" name="element5" value="Boat">
        <label for="element5"> Terre</label>
    </form> 
</html>