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
                if (estPair($i) true) {
                    echo $i . '<br>'
                }
        }
        //  for ($i=0; $i <=20; $i++){
        //     echo ($i % 2 == 0) ? $i . '<br>' : "";
        // }

    echo '<h2> exo 7 </h2>';
        function pyta($a,$b,$c){
            Math.sqrt(b * b + c * c)
            echo
        }
    ?>

</body>
</html>