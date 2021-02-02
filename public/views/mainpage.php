<!DOCTYPE html>
<head>
    <link rel="stylesheet" type="text/css" href="public/css/body.css">
    <link rel="stylesheet" type="text/css" href="public/css/header.css">
    <link rel="stylesheet" type="text/css" href="public/css/utilities.css">
    <script src="https://kit.fontawesome.com/b12911381b.js" crossorigin="anonymous"></script>
    <script src="index.js" defer></script>
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
            <input  type="text" placeholder="Search for a team...">
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
        <div class="mainblock">
            <?php foreach($events as $event): ?>
                <div id="event-1">
                        <div class="mainblock-part">
                            <h5><?= $event->GetTitle(); ?></h5>
                            <img src="public/uploads/<?= $event->GetImage(); ?>">
                            <p><?= $event->GetDescription(); ?></p>
                            <div class="mainblock-part_social">
                                <p><i class="fas fa-heart"></i>609</p>
                                <p><i class="fas fa-comments"></i>120</p>
                                <button type="button">SHARE</button>
                            </div>
                        </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>