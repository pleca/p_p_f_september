<?php
require_once($_SERVER ['DOCUMENT_ROOT'].'czy_zalogowany.php');

$powiadomienia = $bazaDanych->pobierzDane('*','powiadomienia', 'powiadomienia_rodzaj_id = 1 AND czy_aktywny = 1 AND czy_usuniety = 0');

if(mysqli_num_rows($powiadomienia) == 0){
	$dane = array(
			0 => 0
	);
	echo json_encode($dane);
	return;
}

$request_uri = explode('/',$_SERVER['HTTP_REFERER']);

if($request_uri[3] == 'moduly' AND $request_uri[4] == 'administracja_systemem'){
	$dane = array(
			0 => 0
	);
	echo json_encode($dane);
	return;
}

$powiadomienie = mysqli_fetch_assoc($powiadomienia);

if(!isset($_COOKIE['powiadomienie_cookie_id'])){
	setcookie('powiadomienie_cookie_id', $powiadomienie['cookie_id'], time() + (86400), "/");
}

if(!isset($_COOKIE['powiadomienie_ilosc_wyswietlen'])){
	setcookie('powiadomienie_ilosc_wyswietlen', $powiadomienie['ilosc_wyswietlen'], time() + (86400), "/");
}

if($_COOKIE['powiadomienie_cookie_id'] === $powiadomienie['cookie_id'] ){
	if($powiadomienie['ilosc_wyswietlen'] != '0'){
		if($_COOKIE['powiadomienie_ilosc_wyswietlen'] == '1'){
			$dane = array(
					0 => '0'
			);
			echo json_encode($dane);
			return;
		}else{
			setcookie('powiadomienie_ilosc_wyswietlen', ($_COOKIE['powiadomienie_ilosc_wyswietlen'] - 1), time() + (86400), "/");
		}
	}
}else{
	setcookie('powiadomienie_cookie_id', $powiadomienie['cookie_id'], time() + (86400), "/");
	setcookie('powiadomienie_ilosc_wyswietlen', $powiadomienie['ilosc_wyswietlen'], time() + (86400), "/");	
}


    if($powiadomienie) {

        $listaGrupPrzyznanych = $bazaDanych->pobierzDane('*','powiadomienia_id_uzytkownik_grupy_id','powiadomienia_id = '.$powiadomienie['id']);

        while ($poj_lista_grup = $listaGrupPrzyznanych->fetch_object()) {

            if($poj_lista_grup->uzytkownik_grupy_id == $_SESSION['uzytkownik_grupa_id']) {
                $zmienna = '1';
                break;
            } else {
                $zmienna = '0';
            }
        }
    }

$dane = array(
		0 => '1'
		,1 => htmlspecialchars_decode($powiadomienie['tresc'])
		,3 => $zmienna
		
);

echo json_encode($dane);
	



