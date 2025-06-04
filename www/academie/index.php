<?php include('../academie/app/includes/nav.php');
var_dump($_SESSION)?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Welcome to my Academy, <?php echo $_SESSION['username'] ?></h1>
</body>
</html>