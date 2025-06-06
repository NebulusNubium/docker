<?php
include '../includes/head.php';  
include '../includes/nav.php'; 

?>
<!DOCTYPE html>
<html lang="en">

<body>
    <?php if (!isset($_SESSION['username'])) {
    if(isset($_POST['username']) && $_POST['pasword']){
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

    $elements = $bdd->prepare('  SELECT u.id AS user_id, u.username AS username,
            GROUP_CONCAT(e.id 
                ORDER BY e.id SEPARATOR ", ") 
                                AS element_ids,
            GROUP_CONCAT(e.nom 
                ORDER BY e.nom SEPARATOR ", ") 
                                AS element_names
                                    FROM user_elements as ue
                                    LEFT JOIN users AS u
                                        ON ue.user_id = u.id
                                    LEFT JOIN elements AS e
                                        ON ue.element_id = e.id
                GROUP BY u.id, u.username'
                            );
        $elements->execute(array());
        $data = $elements->fetch();

    $sorts = $bdd->prepare('  SELECT u.id AS user_id, u.username AS username,
            GROUP_CONCAT(e.id 
                ORDER BY e.id SEPARATOR ", ") 
                                AS element_ids,
            GROUP_CONCAT(e.nom 
                ORDER BY e.nom SEPARATOR ", ") 
                                AS element_names
                                    FROM user_elements as ue
                                    LEFT JOIN users AS u
                                        ON ue.user_id = u.id
                                    LEFT JOIN elements AS e
                                        ON ue.element_id = e.id
                                    LEFT JOIN sorts
                                        ON sorts.element_id = e.id
                GROUP BY u.id, u.username'
                            );
        $sorts->execute(array());
        $dataSort = $sorts->fetch();

        $sortsWrite = $bdd->prepare('  INSERT INTO sorts(nom, element_id)
                                       Values(:sort, :elementSort)'
                            );
        $sorts->execute(array());
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
    <!-- A rajouter: conditions elements -->
    <h2>Mes Sorts</h2>
        <?php 
        echo 'Vos Elements sont: ' . $data['element_names'] . ' ! <br><br>';

    if(isset($sorts)){
        echo $data['sort'];
    }else{echo 'feel free to register your spells here!';
    echo '<form action="login.php" method="post">
        <label for="sorts">Enregistrer un sort</label>
        <input type="text" name="sorts" id="sorts">
        <label for="elementSort">Element du sort</label>
        <input type="text" name="elementSort" id="elementSort">
    </form>';} ?>
    <h2>Mes bêtes</h2>
        <?php 
            if(isset($betes)){
        echo $betes ;
    }else{echo 'feel free to register your beasts here!';
    echo '<form action="login.php" method="post">
        <label for="betes">Vos betes</label>
        <input type="text" name="betes" id="betes">
    </form>';}
        ?>
</html> 