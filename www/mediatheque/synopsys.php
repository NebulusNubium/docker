
 <?php 
    ob_start();
    $bdd = new PDO('mysql:host=mysql;dbname=gens;charset=utf8','root','root');

    $requestRead = $bdd->prepare('SELECT titre, synopsys 
                                    FROM fiche');

    $requestRead->execute(array());
    var_dump($requestRead);
    while($data= $requestRead->fetch()){
    echo '<br> Titre du film: ' . $data['titre'] .' '. 'Synopsys: ' . $data['synopsys']
;}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
</body>
</html>