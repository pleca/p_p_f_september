<?php require_once($_SERVER ['DOCUMENT_ROOT'].'/czy_zalogowany.php'); ?>

    <html xmlns="https://www.w3c.org/1999/xhtml" xml:lang="pl" lang="pl">

    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <link rel="stylesheet" href="<?php default_css(); ?>" type="text/css" />
        <meta name=viewport content="width=device-width, initial-scale=1">
        <?php if($_SERVER['REQUEST_URI'] == '/strona_glowna'){ ?>
            <link rel="stylesheet" href="https://<?php echo $_SERVER ['HTTP_HOST']; ?>/biblioteki/bootstrap/css/bootstrap.css" type="text/css" />
        <?php } ?>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <link rel="shortcut icon" href="<?php echo 'https://' . $_SERVER ['HTTP_HOST'] . '/'; ?>favicon.png" />
        <link rel="shortcut icon" href="<?php echo 'https://' . $_SERVER ['HTTP_HOST'] . '/'; ?>favicon.ico" />
        <link id="mobile_css" rel="stylesheet" href="<?php mobile_css(); ?>" type="text/css" />
        <title>Panel | VOTUM S.A</title>
        <link rel="stylesheet" href="https://<?php echo $_SERVER ['HTTP_HOST']; ?>/biblioteki/fontawsome/css/font-awesome.css" type="text/css" />
        <link id="cssMain" rel="stylesheet" href="https://<?php echo $_SERVER ['HTTP_HOST']; ?>/css/styleMain.css" type="text/css" />
        <link id="cssMobile" rel="stylesheet" href="https://<?php echo $_SERVER ['HTTP_HOST']; ?>/css/styleMobile.css" type="text/css" />
        <script id="skrypty" type="text/javascript" src="/js/skrypty"></script>
        <script id="skrypty" type="text/javascript" src="/js/lastConversationsMain.js"></script>

        <!--   <script class="skryptJs" type="text/javascript" src="https://<?php echo $_SERVER ['HTTP_HOST']; ?>/biblioteki/bootstrap/js/timepicer.js"></script> -->
    </head>

    <body>
        <?php echo '<div id="menu_podreczne"></div>'; ?>
            <div id="strona">
                <?php include (sciezka_dluga . '/elementy/menu.php'); ?>
