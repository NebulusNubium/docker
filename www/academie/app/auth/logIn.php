<?php
include('../includes/nav.php');
$userId = (int) $_SESSION['username'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
 
    if (!empty($_POST['sorts']) && !empty($_POST['elementSort'])) {

        $sortName    = trim(htmlspecialchars($_POST['sorts']));
        $elementName = trim(htmlspecialchars($_POST['elementSort']));

        // 2a) Chercher l'ID de l'élément dans la table "elements"
        $findElement = $bdd->prepare('
            SELECT id 
            FROM elements 
            WHERE nom = :nom
            LIMIT 1
        ');
        $findElement->execute([
            'nom' => $elementName
        ]);
        $elem = $findElement->fetch();

        if ($elem) {
            // L'élément existe : on peut donc insérer le nouveau sort
                $checkOwnership = $bdd->prepare('
                    SELECT 1 
                    FROM user_elements 
                    WHERE user_id = :uid 
                      AND element_id = :eid
                    LIMIT 1
                ');

            // Message de confirmation
            $feedback = '<div style="color: green; font-weight: bold;">
                             Le sort « ' . htmlspecialchars($sortName) . ' » a bien été enregistré.
                         </div>';
        } else {
            // Si l'élément n'existe pas dans la table "elements"
            $feedback = '<div style="color: red; font-weight: bold;">
                             Erreur : l\'élément « ' . htmlspecialchars($elementName) . ' » est introuvable.
                         </div>';
        }
    } else {
        // Au moins un champ vide
        $feedback = '<div style="color: red; font-weight: bold;">
                         Merci de remplir les deux champs (nom du sort et élément).
                     </div>';
    }
}


    // 3b) Requête pour lister, pour l’utilisateur connecté, ses propres sorts
    $sortsStmt = $bdd->prepare('
        SELECT
            u.id                       AS user_id,
            u.username                 AS username,
            GROUP_CONCAT(s.nom 
                ORDER BY s.nom SEPARATOR ", ") 
                                      AS sort_names,
            GROUP_CONCAT(e.nom 
                ORDER BY e.nom SEPARATOR ", ") 
                                      AS element_names_for_sorts
        FROM user_elements AS ue
        LEFT JOIN users AS u
            ON ue.user_id = u.id
        LEFT JOIN elements AS e
            ON ue.element_id = e.id
        LEFT JOIN sorts AS s
            ON s.element_id = e.id
        WHERE u.id = :uid
        GROUP BY
            u.id,
            u.username
    ');
    $sortsStmt->execute([
        'uid' => $userId
    ]);
    $usersWithSorts = $sortsStmt->fetchAll();

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Gestion des sorts et éléments</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.4;
            margin: 20px;
        }
        legend {
            font-weight: bold;
        }
        label {
            display: inline-block;
            width: 120px;
            margin-bottom: 8px;
        }
        input[type="text"] {
            width: 200px;
        }
        input[type="submit"] {
            margin-top: 10px;
        }
    </style>
</head>
<body>

    <h1>Enregistrer un nouveau sort</h1>

    <div class="feedback">
        <?php
        // Si on a défini un message $feedback après la soumission du form
        if (isset($feedback)) {
            echo $feedback;
        }
        ?>
    </div>

    <fieldset>
        <legend>Formulaire d’ajout</legend>
        <form action="" method="post">
            <label for="sorts">Nom du sort :</label>
            <input type="text" name="sorts" id="sorts" required><br>

            <label for="elementSort">Élément (nom) :</label>
            <input type="text" name="elementSort" id="elementSort" required><br>

            <input type="submit" value="Enregistrer le sort">
        </form>
    </fieldset>

    <div class="results">
        <h2>Liste des utilisateurs et de leurs éléments</h2>

        <h2>Liste des utilisateurs et de leurs sorts</h2>
        <?php
       
        ?>
    </div>

</body>
</html>




<!-- <?php include ('../includes/nav.php');
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
        var_dump($data);
        var_dump($dataSort);
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
</html> -->