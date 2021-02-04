<!DOCTYPE html>
<head>
    <link rel="stylesheet" type="text/css" href="public/css/body.css">
    <link rel="stylesheet" type="text/css" href="public/css/header.css">
    <link rel="stylesheet" type="text/css" href="public/css/utilities.css">
    <script src="https://kit.fontawesome.com/b12911381b.js" crossorigin="anonymous"></script>
    <script src="index.js" defer></script>
    <script type="text/javascript" src="./public/js/search.js" defer></script>
    <script type="text/javascript" src="./public/js/likes.js" defer></script>
    <title>MAIN PAGE</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta charset="utf-8">
    <meta name="language" content="Polish">
</head>
<body class="mainpage">
    <header class="header">
        <img  class="sign" src="public/img/logo.svg">
        <div class="header_buttons">
            <button type="button" class="search_collapse"><div class="search_collapse_glass collapsible_button"></div></button>
            <div class="menu_btn"><div class="menu_btn-burger"></div></div>
        </div>
        <div class="collapsible__content">
            <input  type="text" placeholder="Search for an event...">
        </div>
        <nav class="small_menu">
            <ul class="small_menu-list">
                <li class="d-flex justify-center"><button class="small_menu-list-element" type="button">Sports</button></li>
                <li class="d-flex justify-center"><button type="button" class="small_menu-list-element">Streams</button></li>
                <li class="d-flex justify-center"><button class="small_menu-list-element md-mr-2rem" type="button">Profile</button></li>
            </ul>
        </nav>
    </header>
    <div class="main">
        <section class="mainblock">
            <?php foreach($events as $event): ?>
                <div id="<?= $event->getId(); ?>">
                    <div class="mainblock-part">
                        <h5><?= $event->getTitle(); ?></h5>
                        <img src="public/uploads/<?= $event->getImage(); ?>">
                        <p><?= $event->getDescription(); ?></p>
                        <div class="mainblock-part_social">
                            <p><i class="fas fa-heart"><?= $event->getLike(); ?></i></p>
                            <p><i class="fas fa-comments">0</i></p>
                            <button type="button">SHARE</button>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </section>
    </div>
</body>

<template id="event-template">
    <div id="">
        <div class="mainblock-part">
            <h5>title</h5>
            <img src="">
            <p>description</p>
            <div class="mainblock-part_social">
                <p><i class="fas fa-heart"> 0</i></p>
                <p><i class="fas fa-comments"> 0</i></p>
                <button type="button">SHARE</button>
            </div>
        </div>
    </div>
</template>