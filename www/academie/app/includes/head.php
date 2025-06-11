<?php
$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

$bdd = new PDO('mysql:host=mysql;dbname=academie;charset=utf8', 'root', 'root');
ob_start();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Ludo Academia</title>
    <link rel="stylesheet" href="/academie/asset/css/style.css">
</head>
<body>
