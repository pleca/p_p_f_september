<?php
require_once ($_SERVER ['DOCUMENT_ROOT'] . 'czy_zalogowany.php');
require_once ($_SERVER ['DOCUMENT_ROOT'] . 'moduly/sprawy/db/funkcje_db.php');

$typ_szkody = htmlspecialchars ( $_POST ['typ_szkody'] );
$uzytkownik = $_SESSION ['uzytkownik_id'];

$dodaj_sprawe = sprawa_dodaj_sprawe ( $uzytkownik );
$dodaj_sprawe = mysqli_fetch_assoc ( $dodaj_sprawe );

$id_sprawy = $dodaj_sprawe ['sprawa_id'];
$dodaj_typ_rodzaj = uzupelnij_typ_rodzaj ( $typ_szkody, $rodzaj_wypadku, $id_sprawy );
$dodaj_typ_rodzaj = mysqli_fetch_assoc ( $dodaj_typ_rodzaj );

$dane = array (
		0 => $id_sprawy 
);

echo json_encode ( $dane );
