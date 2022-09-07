<?php 
    //menükezelés
    include("menu.php");
?>
<!doctype html>
<html lang='hu'>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="./front/css/w3.css">
	<link rel="stylesheet" href="./front/css/mystyle.css">
	<link rel="stylesheet" href="./front/css/table.css">
	<title>Késések</title>
<!---    <base href = "./front"> --->
</head>
<body class="w3-light-blue" id='pagetop'>
    <header class="w3-light-gray">
        <div class="w3-container content">
            <div id="logo">
                <a href='./'><img src='./front/img/logo.png'></a>
            </div>
            <div>
                <h2>Galamb Lelkűek Iskolája</h2>
                <p>Késésnyilvántartás</p>
            </div>
            
            <?php if($belepve): ?> 

                <div class="w3-right-align">
                <img class='icon' src='./front/img/user.png' alt='user' title='Bejelentkezve'>
                <br><?= $userinfo['uNev'] ?></div>
            <?php endif; ?>
        </div>   
    <nav class="w3-blue-gray">
        <div class="w3-bar content">
            <?php if(!$belepve): ?>    
                <a href='./?p=login' class="w3-bar-item w3-button w3-right">
                <img class='icon' src='./front/img/user.png' title='Belépés' alt='belépés'>
                </a>
            <?php else: ?>
                <a href='./?p=tanulok' class="w3-bar-item w3-button">Tanulók</a>
                <a href='./?p=osztaly' class="w3-bar-item w3-button">Osztályok</a>
                <a href='./?logout=yes' class="w3-bar-item w3-button w3-right">
                <img class='icon' src='./front/img/logout.png' title='Kilépés' alt='kilépés'>
                </a>
            <?php endif; ?>             
        </div>
    </nav>
    </header>
<main class="w3-white">