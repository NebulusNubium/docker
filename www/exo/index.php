<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <!-- //exo 1 // -->
    <?php echo '<h1>EXO</h1>'; 
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

    
    echo '<h2> exo 14 </h2>';

    echo '<h2> exo 15 </h2>';
    ?>

</body>
</html>