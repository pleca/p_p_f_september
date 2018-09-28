<?php
require_once ($_SERVER ['DOCUMENT_ROOT'] . '/czy_zalogowany.php');
require_once ($_SERVER ['DOCUMENT_ROOT'] . 'moduly/sprawy/db/funkcje_db.php');

$dokument_id = htmlspecialchars ( $_POST ['dokument_id'] );

$usun_widok_umowy_sprawy = sprawa_aktualizacja ( 'czy_usuniety', '1', $dokument_id );
$usun_widok_umowy_sprawy = mysqli_fetch_assoc ( $usun_widok_umowy_sprawy );


	