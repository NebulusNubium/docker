<?php ob_start() ?>  
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
 <?php echo '<h1>EXO</h1>';
 //exo Requete 1 http://localhost:8080/exo/index.php?ville=Paris&transport=covoit// -->
    echo '<h2>Exo Requette 1</h2>';
    echo 'La ville choisie est ' . $_GET['ville'] . ' et le voyage se fera en ' . $_GET['transport'] . ' !' . '<br>';

    echo '<h2>Exo Requette 2</h2>';
    echo '<form action= "index.php" method="post"> <input type="text" name="animal"> </form>';
    echo 'Votre animal favori est ' . $_POST['animal'] . '<br>';

    echo '<h2> Exo req 3 </h2>';
    echo '<form action= "index.php" method="post"> <input type="color" name="color"> <input type="text" name="pseudo"> <button>valider</button> </form>';
    echo $_POST['pseudo'] . '<br>';
    echo '<style> body {background-color:' . $_POST['color'] . ';} </style>';

    echo '<h2> Exo req 4 </h2>';
    echo '<form action= "index.php" method="post"> <input type="number" name="roll"> <button>valider</button> </form>';
    function roll(){
        $result= rand(1,$_POST['roll']);
        if($_POST['roll'] % 6 ==0){
            return $result;
        } else {
            '<form action= "index.php?error=lol" method="get">';
        }
        
    }
    echo roll() . '<br>';

    echo '<h2> Exo req 5 </h2>';
        echo '<form action= "index.php" method="post"> <input type="text" name="pseudo"> <input type="text" name="mdp"> <button>register</button> <button>login</button>  </form>';
        $pseudoDTB=  'petitchat';
        $mdpDTB= 'ghibli';
        $hash = password_hash($_POST['mdp'], PASSWORD_ARGON2ID);
        if(isset($_POST['pseudo']) && isset($_POST['mdp'])){
            if($_POST['pseudo'] === $pseudoDTB && password_verify($mdpDTB, $hash)){
            header('location:https://github.com/NebulusNubium');
            } else {
            header('location:index.php?error=lol');
            }
        }
    echo '<h2> Exo req 6 </h2>';

   //exo Algo 1 // -->
    echo '<h2> exo algo 1 </h2>';
    for ($i=0; $i <26; $i++){
        echo $i . '<br>';
    }
    // Exo 2
     echo '<h2>exo 2</h2>'; 
    for ($i=25; $i >0; $i--){
        echo $i . '<br>';
    }

    echo '<h2>exo 3</h2>'; 
    for ($i=0; $i <25; $i++){

        for ($result=1; $result<=$i; $result++ ) {
            echo $result;
        }
        echo '<br>';
    }

    echo '<h2> exo 4 </h2>';
        $result = 0;
        for ($i=1; $i<=30; $i++ ) {
                $result=$i + $result;
            }
        echo $result;
    

        echo '<h2> exo 5 </h2>';
        function estPair($estPair){
            $estPair % 2 == 0 ? true : false;
        }
        echo '<h2> exo 6 </h2>';
            for ($i=0; $i <=20; $i++){
                if (estPair($i)== true) {
                    echo $i . '<br>';
                }
        }
        //  for ($i=0; $i <=20; $i++){
        //     echo ($i % 2 == 0) ? $i . '<br>' : "";
        // }

    echo '<h2> exo 7 </h2>';
        function pyta($b,$c){
            echo ("a est égale à:" . sqrt($b**2 + $c**2));
        }

    echo '<h2> exo 8 </h2>';
    $heure=15;
    if($heure<=12 && $heure>=0){
        echo "matin";
    } else if ($heure>=12 && $heure<19) {
        echo "aprem";
    } else if ($heure>=19 && $heure<24) {
        echo "soir";
    } else {
        echo "invalid input";
    }

    echo '<h2> exo 9 </h2>';
        // estPair($estPair){
        //     $estPair % 2 == 0 ? true : false;
        // }

    echo '<h2> exo 10 </h2>';
    
    for ($i=1; $i<=100; $i++) {
        if( $i % 3 === 0 && $i % 5 === 0) {
        echo $i . '<br>' . 'foobar'. '<br>' ;
        } else if ($i % 3 === 0){
        echo $i . '<br>' . 'foo'. '<br>';
        } else if($i % 5 === 0){
        echo $i . '<br>' . 'bar'. '<br>';
        } 
    }

    echo '<h2> exo 11 </h2>';
    $identitePersonne=[
        'nom' => 'Croft',
        'prenom' =>'Lara',
        'metier' => 'Archéologue'
    ];  
    echo '<h3> C\'est un plaisir de vous voir  ' . $identitePersonne['prenom'] . $identitePersonne['nom'] . ' !(' .$identitePersonne['metier'] . ') </h3>';

    echo '<h2> exo 12 </h2>';
     $fighters=['Zelda','Samus','Bowser','Peach','Lucina'] ;
    foreach($fighters as $fighter){
        echo (strlen($fighter)==6) ? $fighter : "" ;
    }

    echo '<h2> exo 13 </h2>';
    $array=[1045, 15, 20, 30, 50, 100, 9029];
    echo min($array);

    echo '<h2> exo 14 </h2>';
    // $array=[1045, 15, 20, 30, 50, 100, 9029];
    // for ($i=0; $i <6; $i++){
    //     $array=[1045, 15, 20, 30, 50, 100, 9029];
    //     min($array)
    //     $newArray[$i]=[]
    // }
    // asort($array)
    // foreach
    echo '<h2> exo 15 </h2>';



    ?>

</body>
</html>