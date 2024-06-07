<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Asset/dossier_css/JohBeauty.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <title>Joh Beauty</title>
</head>
<body>
    <header class="Lait">
        <ul class="ul_header">
            <li><img class="logoacc" src="Asset/img/logo_joh_beauty_V2-removebg-preview (1).png" alt="Logo Joh Beauty"></li>
            <li><button class="bouton"><a href="Pageaccueil.php">Accueil</a></button></li>
            <?php if (!isset($_SESSION["donnees"]["nom"])): ?>
                <li><button class="bouton">Préstations</button></li>
                <li><button class="bouton">Cadeau</button></li>
                <li><button class="bouton">Contact</button></li>
                <li><a class="bouton" href="traitementinscription.php">Connexion</a></li>
            <?php else: ?>
                <li><button class="bouton"><a href="deconnexion2.php">Déconnexion</a></button></li>
            <?php endif; ?>
            <li><button class="bouton">Prendre rendez-vous</button></li>
        </ul>
    </header>


    