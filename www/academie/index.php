<?php include('../academie/app/includes/nav.php');
include('../academie/app/includes/head.php');
var_dump($_SESSION)?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Welcome to My Ludo Academia, <?php 
    if(isset($_SESSION['username'])){
        echo $_SESSION['username'] ;
    }else{echo 'feel free to register!';} ?></h1>
</body>
</html>