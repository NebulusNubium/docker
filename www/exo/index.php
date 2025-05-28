<?php ob_start() ?>  
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>EXO</h1>

    <h2>Exo Requête 1</h2>
    <?php if (isset($_GET['ville'], $_GET['transport'])): 
        $ville = htmlspecialchars($_GET['ville']);
        $transport = htmlspecialchars($_GET['transport']);
    ?>
        <p>
            La ville choisie est <strong><?= $ville ?></strong>
            et le voyage se fera en <strong><?= $transport ?></strong> !
        </p>
    <?php endif;
    echo $lolilol; 
    var_dump($lolilol)?>

    <h2>Exo Requête 2</h2>
    <?php if (isset($_POST['animal'])):
        $animal = htmlspecialchars($_POST['animal']);
    ?>
        <p>Votre animal favori est <strong><?= $animal ?></strong>.</p>
    <?php else: ?>
        <p>Votre animal favori est .. ?</p>
        <form action="index.php" method="post">
            <input type="text" name="animal" placeholder="Entrez un animal">
            <button type="submit">Envoyer</button>
        </form>
    <?php endif; ?>
 <?php
session_start();

// Exo 3 – gestion du pseudo et couleur
$bgColor = isset($_POST['color']) ? htmlspecialchars($_POST['color']) : '';
$pseudo3 = isset($_POST['pseudo']) ? htmlspecialchars($_POST['pseudo']) : '';

// Exo 9 – jeu de devinette
if (!isset($_SESSION['number'])) {
    $_SESSION['number'] = rand(0, 1000);
}
$secret = $_SESSION['number'];
?>
    <!-- Exo requête 3 -->
    <h2>Exo requête 3</h2>
    <form action="index.php" method="post">
        <label>Choisissez une couleur : <input type="color" name="color" value="<?= $bgColor ?>"></label><br>
        <label>Votre pseudo : <input type="text" name="pseudo" placeholder="Pseudo"></label><br>
        <button type="submit">Valider</button>
    </form>
    <?php if ($pseudo3): ?>
        <p>Bonjour <strong><?= $pseudo3 ?></strong> !</p>
    <?php endif; ?>

    <!-- Exo requête 4 -->
    <h2>Exo requête 4</h2>
    <form action="index.php" method="post">
        <label>Entrez un nombre : <input type="number" name="roll" placeholder="Ex. 12"></label><br>
        <button type="submit">Lancer le dé</button>
    </form>
    <?php if (isset($_POST['roll'])):
        $roll = (int)$_POST['roll'];
        if ($roll % 6 === 0):
            $result4 = rand(1, $roll); ?>
            <p>Résultat du lancer : <?= $result4 ?></p>
        <?php else: ?>
            <p>Erreur : le nombre n’est pas multiple de 6.</p>
            <form action="index.php" method="get">
                <input type="hidden" name="error" value="lol">
                <button>Tenter de nouveau</button>
            </form>
        <?php endif;
    endif; ?>

    <!-- Exo requête 5 -->
    <h2>Exo requête 5</h2>
    <form action="index.php" method="post">
        <label>Pseudo : <input type="text" name="pseudo" placeholder="Pseudo"></label><br>
        <label>Mot de passe : <input type="password" name="mdp" placeholder="Mot de passe"></label><br>
        <button type="submit" name="register">Register</button>
        <button type="submit" name="login">Login</button>
    </form>
    <?php if (isset($_POST['pseudo'], $_POST['mdp'])):
        $pseudoDTB = 'petitchat';
        $mdpDTB    = 'ghibli';
        $hash      = password_hash($_POST['mdp'], PASSWORD_ARGON2ID);
        if ($_POST['pseudo'] === $pseudoDTB && password_verify($mdpDTB, $hash)):
            header('Location: https://github.com/NebulusNubium');
            exit;
        else:
            header('Location: index.php?error=lol');
            exit;
        endif;
    endif; ?>

    <!-- Exo requête 6 -->
    <h2>Exo requête 6</h2>
    <form action="index.php" method="post">
        <input type="number" name="number1" placeholder="Nombre 1">
        <input type="number" name="number2" placeholder="Nombre 2"><br>
        <button type="submit" name="multiplier">Multiplier</button>
        <button type="submit" name="soustraire">Soustraire</button>
        <button type="submit" name="diviser">Diviser</button>
        <button type="submit" name="additionner">Additionner</button>
    </form>
    <?php
    if (isset($_POST['number1'], $_POST['number2'])):
        $n1 = (int)$_POST['number1'];
        $n2 = (int)$_POST['number2'];
        if (isset($_POST['multiplier'])) {
            $res6 = $n1 * $n2;
        } elseif (isset($_POST['diviser'])) {
            if ($n2 !== 0) {
                $res6 = $n1 / $n2;
            } else {
                $err6 = 'Division par zéro !';
            }
        } elseif (isset($_POST['soustraire'])) {
            $res6 = $n1 - $n2;
        } elseif (isset($_POST['additionner'])) {
            $res6 = $n1 + $n2;
        }
        if (isset($res6)) {
            echo "<p>Résultat : $res6</p>";
        } elseif (isset($err6)) {
            echo "<p>$err6</p>";
        }
    endif;
    ?>

    <!-- Exo requête 7 -->
    <h2>Exo requête 7</h2>


    <h2>Exo requête 8</h2>
    <form action="index.php" method="post">
        <p>1. What is the color of courgettes?</p>
        <label><input type="radio" name="q1" value="red"> Red</label>
        <label><input type="radio" name="q1" value="blue"> Blue</label>
        <label><input type="radio" name="q1" value="green"> Green</label>
        <label><input type="radio" name="q1" value="yellow"> Yellow</label>

        <p>2. What is the color of courgettes?</p>
        <label><input type="radio" name="q2" value="red"> Red</label>
        <label><input type="radio" name="q2" value="blue"> Blue</label>
        <label><input type="radio" name="q2" value="green"> Green</label>
        <label><input type="radio" name="q2" value="yellow"> Yellow</label>

        <p>3. What is the color of courgettes?</p>
        <label><input type="radio" name="q3" value="red"> Red</label>
        <label><input type="radio" name="q3" value="blue"> Blue</label>
        <label><input type="radio" name="q3" value="green"> Green</label>
        <label><input type="radio" name="q3" value="yellow"> Yellow</label><br>

        <button type="submit" name="submit_q8">Valider</button>
    </form>

    <?php
    if (isset($_POST['submit_q8'])) {
        $score = 0;
        if (isset($_POST['q1']) && $_POST['q1'] === 'green')   $score++;
        if (isset($_POST['q2']) && $_POST['q2'] === 'green')   $score++;
        if (isset($_POST['q3']) && $_POST['q3'] === 'green')   $score++;
        echo "<p>Score total : <strong>$score/3</strong></p>";
    }
    ?>
    <!-- Exo requête 9 -->
    <h2>Exo requête 9</h2>
    <form action="index.php" method="post">
        <p>Generate and guess the number between 0 and 1 000 !</p>
        <input type="number" name="guess" placeholder="Votre essai"><br>
        <button type="submit" name="guessing">Je propose…</button>
    </form>
    <?php if (isset($_POST['guessing'])):
        $guess = (int)$_POST['guess'];
        echo "<p>Secret (debug) : $secret</p>";
        if ($guess === $secret) {
            echo '<p>You got it!</p>';
        } elseif ($guess < $secret) {
            echo '<p>Bigger!</p>';
        } else {
            echo '<p>Smaller!</p>';
        }
    endif; ?>

    <!-- Exo requête 10 -->
   <h2> Exo requête 10 </h2>
    <form action="index.php" method="post" enctype="multipart/form-data">
    <p>Uploadez votre image:</p>
    <input type="file" name="file" id="file">
    <input type="submit" value="submit" name="submit">
    </form>
    
<?php 
    
    $allowedExts  = ['jpg','jpeg','png','gif','pdf'];
    if(isset($_FILES['file']) && isset($_POST['submit']) && $_FILES['file']['extension']==$allowedExts){
        
    }
    var_dump($_FILES);
?>
<?php
// Exo Algo 1
for ($i = 0; $i < 26; $i++) {
    echo $i . '<br>';
}
 ?>

<h2>Exo 2</h2>
<?php
for ($i = 25; $i > 0; $i--) {
    echo $i . '<br>';
}
?>

<h2>Exo 3</h2>
<?php
for ($i = 0; $i < 25; $i++) {
    for ($result = 1; $result <= $i; $result++) {
        echo $result;
    }
    echo '<br>';
}
?>

<h2>Exo 4</h2>
<?php
$result = 0;
for ($i = 1; $i <= 30; $i++) {
    $result += $i;
}
echo $result;
?>

<h2>Exo 5</h2>
<?php
function estPair($n) {
    return $n % 2 === 0;
}
?>

<h2>Exo 6</h2>
<?php
for ($i = 0; $i <= 20; $i++) {
    if (estPair($i)) {
        echo $i . '<br>';
    }
}
?>

<h2>Exo 7</h2>
<?php
function pyta($b, $c) {
    echo 'a est égale à : ' . sqrt($b**2 + $c**2);
}
?>

<h2>Exo 8</h2>
<?php
$heure = 15;
if ($heure >= 0 && $heure < 12) {
    echo 'matin';
} elseif ($heure < 19) {
    echo 'aprem';
} elseif ($heure < 24) {
    echo 'soir';
} else {
    echo 'invalid input';
}
?>

<h2>Exo 9</h2>

<h2>Exo 10</h2>
<?php
for ($i = 1; $i <= 100; $i++) {
    if ($i % 3 === 0 && $i % 5 === 0) {
        echo $i . '<br>foobar<br>';
    } elseif ($i % 3 === 0) {
        echo $i . '<br>foo<br>';
    } elseif ($i % 5 === 0) {
        echo $i . '<br>bar<br>';
    }
}
?>

<h2>Exo 11</h2>
<?php
$identitePersonne = [
    'nom'    => 'Croft',
    'prenom' => 'Lara',
    'metier' => 'Archéologue'
];
echo '<h3>C\'est un plaisir de vous voir ' 
     . $identitePersonne['prenom'] . ' ' 
     . $identitePersonne['nom'] 
     . ' ! (' . $identitePersonne['metier'] . ')</h3>';
?>

<h2>Exo 12</h2>
<?php
$fighters = ['Zelda','Samus','Bowser','Peach','Lucina'];
foreach ($fighters as $fighter) {
    if (strlen($fighter) === 6) {
        echo $fighter . '<br>';
    }
}
?>

<h2>Exo 13</h2>
<?php
$array = [1045, 15, 20, 30, 50, 100, 9029];
echo min($array);
?>

<h2>Exo 14</h2>


<h2>Exo 15</h2>



</body>
</html>