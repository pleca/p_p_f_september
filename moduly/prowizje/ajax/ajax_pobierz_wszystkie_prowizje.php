<?php

if (! isset ( $_SERVER ['HTTP_REFERER'] )) {
	session_start ();
	session_destroy ();
	header ( 'Location: https://' . $_SERVER ['HTTP_HOST'] );
	die ();
}

session_start ();

require_once ($_SERVER ['DOCUMENT_ROOT'] . 'moduly/prowizje/db/funkcje_db.php');

$uzytkownik = pobierz_jeden_wiersz_z_tabeli ( 'uzytkownik', $_SESSION ['uzytkownik_id'] );

$rok = htmlspecialchars ( $_POST ['rok'] );
$typ_prowizji = htmlspecialchars ( $_POST ['typ_prowizji'] );

$tablicajson = array (
		array () 
);

$prowizja = pobierz_prowizje_wszystkich_agentow ($rok, $typ_prowizji );

while ( $wiersz = mssql_fetch_array ( $prowizja ) ) {
	
	$dane_agenta = iconv ( "cp1250", "UTF-8", $wiersz ['AgentNumber'] );
    $dane_kierownika = iconv ( "cp1250", "UTF-8", $wiersz ['Manager'] );
    $dane_dyrektora = iconv ( "cp1250", "UTF-8", $wiersz ['Director'] );

    $agent = iconv ( "cp1250", "UTF-8", $wiersz ['Agent'] );

    if ($agent == ' ()') {
        $agent = '';
	}
    if ($dane_kierownika == ' ()') {
        $dane_kierownika = '';
    }
    if ($dane_dyrektora == ' ()') {
        $dane_dyrektora = '';
    }

	$tablica = array ();
	
	$tablica1 = array (
        'agent' => $agent,
        'kierownik' => $dane_kierownika,
        'dyrektor' => $dane_dyrektora
    );

	$tablica = array_merge ( $tablica1 );

	for($i=1; $i<=12; $i++) {

		$dane = round ( iconv ( "cp1250", "UTF-8", $wiersz [$i] ), 2 );

        if ($typ_prowizji == '0') {
            $tablica [$i] = '<div class="pokaz_szczegoly_prowizji_agentow" data-nr_miesiaca="'.$i.'" data-nr_agenta="'.$dane_agenta.'">' . $dane . '</div>';

        } else {
            $tablica [$i] = '<div class="pokaz_wszystkie_szczegoly_prowizji_agentow" data-id_miesiaca="' . $i . '" data-nr_agenta="' . $dane_agenta . '" data-typ_prowizji="' . $typ_prowizji . '">' . $dane . '</div>';
        }

	};

	array_push ( $tablicajson [0], $tablica );
}

echo json_encode ( $tablicajson [0] );
	