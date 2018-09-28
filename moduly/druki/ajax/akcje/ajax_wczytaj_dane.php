<?php

require_once($_SERVER ['DOCUMENT_ROOT'] . 'czy_zalogowany.php');

$akcja = (isset($_POST['akcja'])) ? htmlspecialchars($_POST['akcja']) : '';
$element_id = (isset($_POST['element_id'])) ? htmlspecialchars($_POST['element_id']) : '';
$tabela = (isset($_POST['tabela'])) ? htmlspecialchars($_POST['tabela']) : '';

$drukiMain = new DrukiMain();

$tytul = '';
$tresc = '';

switch ($akcja) {
    case 'historia_wyswietl':
            $id = (isset($_POST['id'])) ? htmlspecialchars($_POST['id']) : '';
            $tytul = 'Historia elementu';

            if($tabela == 'umowaOsoba_historia_zmian'){
                $kolumna = 'umowaOsoba_id';
            }

            if($tabela == 'umowa_historia_zmian'){
                $kolumna = 'umowa_id';
            }

            $tresc = $drukiMain->generujZakladkeHistoria($tabela, $kolumna, $bazaDanych, $id);
        break;

    case 'lista_dostepnych_drog':
            $tresc .= '<div class="listaDostepnychDrog">';
                if($drukiMain->sprawdzUprawnienie('druki_umowa_bankowa')) {
                    $tresc .= '<button data-element_id="" data-ogolne="1" data-akcja="nowy" data-droga="bankowa" data-strona="zakladki" type="button" class="wczytajStroneUmowyDoPopUp btn btn-default float_l width_50 margin_b_20">BANKOWA</button>';
                }
                if($drukiMain->sprawdzUprawnienie('druki_umowa_ofe')) {
                    $tresc .= '<button data-element_id="" data-ogolne="1" data-akcja="nowy" data-droga="ofe" data-strona="zakladki" type="button" class="wczytajStroneUmowyDoPopUp btn btn-default float_r width_50 margin_b_20">OFE</button>';

                }
                if($drukiMain->sprawdzUprawnienie('druki_umowa_osobowa')) {
                    $tresc .= '<button data-element_id="" data-ogolne="1" data-akcja="nowy" data-droga="osobowa" data-strona="zakladki" type="button" class="wczytajStroneUmowyDoPopUp btn btn-default float_l width_50 margin_b_0">OSOBOWA</button>';

                }
                if($drukiMain->sprawdzUprawnienie('druki_umowa_rzeczowa')) {
                    $tresc .= '<button data-element_id="" data-ogolne="1" data-akcja="nowy" data-droga="rzeczowa" data-strona="zakladki" type="button" class="wczytajStroneUmowyDoPopUp btn btn-default float_r width_50 margin_b_0">RZECZOWA</button>';

                }
                $tresc .= '<div class="clear_b"></div>';
            $tresc .= '</div>';
        break;

    case 'edytuj_klienta':
            $umowa_osoba_tmp = $bazaDanych->pobierzDane('*','umowaOsoba','id = '.$element_id);
            $umowa_osoba_tmp = $umowa_osoba_tmp->fetch_object();

            $umowa_osoba_kontakt_tmp = $bazaDanych->pobierzDane('*','umowaKontakt','id = '.$umowa_osoba_tmp->KontaktId);
            $umowa_osoba_kontakt_tmp = $umowa_osoba_kontakt_tmp->fetch_object();

            $umowa_osoba_adres_tmp = $bazaDanych->pobierzDane('*','umowaAdres','id = '.$umowa_osoba_tmp->AdresId);
            $umowa_osoba_adres_tmp = $umowa_osoba_adres_tmp->fetch_object();

            $umowa_osoba_adres_miasto_tmp = $bazaDanych->pobierzDane('*','umowaAdresMiasto','id = '.$umowa_osoba_adres_tmp->MiastoId);
            $umowa_osoba_adres_miasto_tmp = $umowa_osoba_adres_miasto_tmp->fetch_object();

            $tresc .= '<div class="klientSzczegoly">';
                $tresc .= '<div class="well well-sm margin_b_10">'.$umowa_osoba_tmp->Imie.' '.$umowa_osoba_tmp->Nazwisko.'</div>';
                $tresc .= '<ul class="nav nav-tabs" role="tablist">';
                    $tresc .= '<li role="presentation" class="active"><a href="#DaneOgolne" aria-controls="DaneOgolne" role="tab" data-toggle="tab">Ogólne</a></li>';
                $tresc .= '</ul>';
                $tresc .= '<div class="tab-content">';
                    $tresc .= '<div role="tabpanel" class="tab-pane active" id="DaneOgolne">';
                        $tresc .= '<div class="daneKlienta">';
                            $tresc .= '<label class="width_100">IMIE I NAZWISKO</label>';
                            $tresc .= '<div class="col-md-6 inputPole padding_r_10"><input data-wartosc_domyslna="'.$umowa_osoba_tmp->Imie.'" value="'.$umowa_osoba_tmp->Imie.'" data-kolumna="Imie" type="text" class="update wymagane duzeMaleLiteryCyfry" placeholder="Imię"></div>';
                            $tresc .= '<div class="col-md-6 inputPole "><input data-wartosc_domyslna="'.$umowa_osoba_tmp->Nazwisko.'" value="'.$umowa_osoba_tmp->Nazwisko.'" data-kolumna="Nazwisko" type="text" class="update wymagane duzeMaleLiteryCyfry" placeholder="Nazwisko"></div>';
                            $tresc .= '<label class="margin_t_10 width_100">ADRES ZAMELDOWANIA</label>';
                            $tresc .= '<div class="col-md-6 inputPole padding_r_10"><input data-wartosc_domyslna="'.$umowa_osoba_adres_tmp->Ulica.'" value="'.$umowa_osoba_adres_tmp->Ulica.'" data-kolumna="Ulica" type="text" class="update wymagane duzeMaleLiteryCyfry" placeholder="Ulica"></div>';
                            $tresc .= '<div class="col-md-3 inputPole padding_r_10"><input data-wartosc_domyslna="'.$umowa_osoba_adres_tmp->NrDomu.'" value="'.$umowa_osoba_adres_tmp->NrDomu.'" data-kolumna="NrDomu" type="text" class="update wymagane duzeMaleLiteryCyfry" placeholder="Nr domu"></div>';
                            $tresc .= '<div class="col-md-3 inputPole "><input data-wartosc_domyslna="'.$umowa_osoba_adres_tmp->NrMieszkania.'" value="'.$umowa_osoba_adres_tmp->NrMieszkania.'" data-kolumna="NrMieszkania" type="text" class="update duzeMaleLiteryCyfry" placeholder="Nr mieszkania"></div>';
                            $tresc .= '<div class="col-md-4 inputPole padding_r_10 margin_t_10"><input data-wartosc_domyslna="'.$umowa_osoba_adres_tmp->KodPocztowy.'" value="'.$umowa_osoba_adres_tmp->KodPocztowy.'" data-kolumna="KodPocztowy" type="text" class="update wymagane poleLiczbowe sprawdzKodPocztowy" maxlength="6" placeholder="Kod pocztowy"></div>';
                            $tresc .= '<div class="col-md-8 inputPole margin_t_10"><input data-wartosc_domyslna="'.$umowa_osoba_adres_miasto_tmp->Wartosc.'" value="'.$umowa_osoba_adres_miasto_tmp->Wartosc.'" data-kolumna="Wartosc" type="text" class="update wymagane duzeMaleLiteryCyfry" placeholder="Miejscowość"></div>';
                            $tresc .= '<label class="margin_t_10 width_100">DANE Z DOWODU</label>';
                            $tresc .= '<div class="col-md-6 inputPole padding_r_10"><input data-wartosc_domyslna="'.$umowa_osoba_tmp->Pesel.'" value="'.$umowa_osoba_tmp->Pesel.'" data-kolumna="Pesel" type="text" class="update wymagane poleLiczbowe sprawdzPesel" maxlength="11" placeholder="Pesel"></div>';
                            $tresc .= '<div class="col-md-6 inputPole "><input data-wartosc_domyslna="'.$umowa_osoba_tmp->Dowod.'" value="'.$umowa_osoba_tmp->Dowod.'" data-kolumna="Dowod" type="text" class="update wymagane duzeMaleLiteryCyfry sprawdzNumerDowodu" maxlength="9" placeholder="Seria i numer dowodu"></div>';
                            $tresc .= '<label class="margin_t_10 width_100">DANE DO KONTAKTU</label>';
                            $tresc .= '<div class="col-md-4 inputPole padding_r_10"><input data-wartosc_domyslna="'.$umowa_osoba_kontakt_tmp->Telefon.'" value="'.$umowa_osoba_kontakt_tmp->Telefon.'" data-kolumna="Telefon" type="text" class="update poleLiczbowe" placeholder="Telefon"></div>';
                            $tresc .= '<div class="col-md-8 inputPole "><input data-wartosc_domyslna="'.$umowa_osoba_kontakt_tmp->Mail.'" value="'.$umowa_osoba_kontakt_tmp->Mail.'" data-kolumna="Mail" type="text" class="update duzeMaleLiteryCyfry sprawdzEmail" placeholder="Adres e-mail"></div>';
                            $tresc .= '<div class="clear_b"></div>';
                            $tresc .= '<button data-klasa_rodzic="daneKlienta" data-element_id="'.$element_id.'" data-tabela="umowaOsoba" data-akcja="aktualizuj_klienta" type="button" class="margin_t_10 btn btn-success width_100 margin_b_0 zapiszZmiany przyciskZapiszZmianyZielony">Zapisz zmiany</button>';
                        $tresc .= '</div>';
                    $tresc .= '</div>';
                    $tresc .= '<div role="tabpanel" class="tab-pane" id="przypisaneUmowy">...</div>';
                $tresc .= '</div>';
            $tresc .= '</div>';
        break;

    case 'szczeguly_umowy':
            $element_id = explode('-',$element_id);

            $umowa_tmp = $bazaDanych->pobierzDane('*','umowa','Id = '.$element_id[0]);
            $umowa_tmp = $umowa_tmp->fetch_object();
            
            $umowa_osoba_tmp = $bazaDanych->pobierzDane('Imie, Nazwisko, KontaktId','umowaOsoba','Id = '.$element_id[1]);

            if ($umowa_osoba_tmp) {
                $umowa_osoba_tmp = $umowa_osoba_tmp->fetch_object();

                $umowa_osoba_kontakt_tmp = $bazaDanych->pobierzDane('Mail, Telefon','umowaKontakt','Id = '.$umowa_osoba_tmp->KontaktId);
                $umowa_osoba_kontakt_tmp = $umowa_osoba_kontakt_tmp->fetch_object();
            }

            $umowa_rodzaj_tmp = $bazaDanych->pobierzDane('Wartosc, TabelaNazwa','umowaSlownikUmowaTyp','Id = '.$umowa_tmp->UmowaTypId);
            $umowa_rodzaj_tmp = $umowa_rodzaj_tmp->fetch_object();

            $umowa_rodzaj_dane_tmp = $bazaDanych->pobierzDane('*',$umowa_rodzaj_tmp->TabelaNazwa,'Id = '.$element_id[2]);
            $umowa_rodzaj_dane_tmp = $umowa_rodzaj_dane_tmp->fetch_object();

        $umowa_droga = '';

        if($umowa_tmp->UmowaTypId == 1){
            $umowa_droga = 'bankowa';
            $nazwa_umowy = $umowa_rodzaj_tmp->Wartosc;
        }

        if($umowa_tmp->UmowaTypId == 2){
            $umowa_droga = 'ofe';
            $nazwa_umowy = $umowa_rodzaj_tmp->Wartosc;
        }

        if($umowa_tmp->UmowaTypId == 3){
            $umowa_droga = 'rzeczowa';

            $umowa_rzeczowa_nazwa_tmp = $bazaDanych->pobierzDane('*','umowaSlownikUmowaRzeczowaTyp','Id = '.$umowa_rodzaj_dane_tmp->UmowaRzeczowaTypId);
            $umowa_rzeczowa_nazwa_tmp = $umowa_rzeczowa_nazwa_tmp->fetch_object();

            $nazwa_umowy = $umowa_rzeczowa_nazwa_tmp->Wartosc;
        }
        if($umowa_tmp->UmowaTypId == 4){
            $umowa_droga = 'osobowa';
            $nazwa_umowy = $umowa_rodzaj_tmp->Wartosc;

            $umowa_osobowa_tmp = $bazaDanych->pobierzDane('*','umowaOsobowa','Id = '.$element_id[2]);
            $umowa_osobowa_tmp = $umowa_osobowa_tmp->fetch_object();

            $typ_szkody_tmp = $bazaDanych->pobierzDane('*','umowaSlownikTypSzkody','Id = '.$umowa_osobowa_tmp->TypSzkodyId);
            if ($typ_szkody_tmp) {
                $typ_szkody_tmp = $typ_szkody_tmp->fetch_object();
            }
        }



       /*     $tresc .='<div class="umowaSzczegolyDane">';
                $tresc .= '<div class="alert alert-danger" role="alert">';
                    $tresc .= '<p class="margin_b_10"><b>UWAGA!!!</b> Po przekazaniu kopii elektronicznej umowy do centrali w dalszym ciągu oryginały należy przesłac poczta tradycyjną!!!</p>';
                    $tresc .= '<button data-nazwa_drogi="'.$umowa_droga.'" data-element_id="'.$element_id[0].'-'.$element_id[1].'-'.$element_id[2].'" data-telefon="'.$umowa_osoba_kontakt_tmp->Telefon.'" type="button" class="btn btn-danger width_100 wyslijKopieDoCentrali">Wyślij kopie elektroniczną do centrali</button>';
            $tresc .= '</div>';
			*/
           
            if ($umowa_tmp->WyslanaDoCentrali == 0) {
                $tresc .= '<div class="alert bg-success" role="alert" id="dodajspawe">';
                $tresc .= '<button data-nazwa_drogi="'.$umowa_droga.'" data-element_id="'.$element_id[0].'" data-telefon="'.$umowa_osoba_kontakt_tmp->Telefon.'" type="button" class="btn btn-success width_100 dodajSpraweDoCentrali">Dodaj sprawę do centrali</button>
                <p><br>Dodanie dokumentów, będzie możliwe dopiero po przesłaniu sprawy do Centrali</p>';
                $tresc .= '</div>';
            }
            else {

                $curl = curl_init();
                curl_setopt($curl, CURLOPT_URL, API_URL.'contract/getdictionary');
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($curl, CURLOPT_HEADER, false);
                curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
                $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
                $datax = curl_exec($curl);
                curl_close($curl);

                $tresc .= '<div class="alert well">';

                $tresc .= '<div class="alert bg-info" role="alert" id="sendFilesToCentarlMessage" style="display: none;">';
                $tresc .= '</div>';


                $tresc .= '<form id="sendFilesToCentarl" enctype="multipart/form-data" method="post">
                        <label for="file">Dodaj plik</label>
                        <input name="file[]" class="input-file" type="file"  id="sendFilesToCentarlInputFile" multiple="multiple" style="width: 100%; height: auto;">
                        ';
                $tresc .= '    <select name="fid" style="width: 100%;">';

                if ($datax) {
                    foreach (json_decode($datax, true) as $key => $row) {
                        $tresc .= '<option value="' . $row["id"] . '">' . $row["name"] . '</option>';
                    }
                }

                $tresc .= '    </select><br>';
                $tresc .= '<button id="upload_file" data-element_id="'.$element_id[0]."-".$element_id[1]."-".$element_id[2].'" type="submit" class="btn btn-success" value="Wyślij" style="background-color: #5cb85c; margin-top: 10px;">Wyślij</button>
                <p><br>W celu poprawnego zarejestrowania sprawy należy przesłać skan Umowy, Pełnomocnictw oraz Zgłoszenie</p>
                    </form>';
                $tresc .= '</div>';
            }








        $tresc .= '<div class="well well-sm margin_b_10">'.$nazwa_umowy.' ('.$element_id[0].')</div>';
                $tresc .='<ul class="nav nav-tabs" role="tablist">';
                    $tresc .='<li role="presentation" class="active"><a href="#szczegolyOgolne" aria-controls="szczegolyOgolne" role="tab" data-toggle="tab">Ogólne</a></li>';
                    $tresc .='<li role="presentation"><a href="#szczegolyDruki" aria-controls="profile" role="tab" data-toggle="tab">Druki</a></li>';
                    /*$tresc .='<li role="presentation"><a href="#szczegolyPliki" aria-controls="szczegolyPliki" role="tab" data-toggle="tab">Pliki</a></li>';*/
                $tresc .='</ul>';
                $tresc .='<div class="tab-content">';
                    $tresc .='<div role="tabpanel" class="tab-pane active" id="szczegolyOgolne">';
                        $tresc .= '<div class="szczegolyUmowa">';
                            $tresc .= '<label class="width_100">DANE UMOWY</label>';
                           // $tresc .= '<div class="col-md-12 margin_b_10 inputPole"><input disabled value="'.$umowa_rodzaj_tmp->Wartosc.'" type="text"  placeholder="Typ umowy"></div>';
                            $tresc .= '<div class="col-md-6 padding_r_10 margin_b_10 inputPole"><input disabled value="'.$umowa_tmp->Miasto.'" type="text"  placeholder="Miasto"></div>';
                            $tresc .= '<div class="col-md-6 margin_b_10 inputPole"><input disabled value="'.$umowa_tmp->DataUtworzenia.'" type="text"  placeholder="Data Dodania"></div>';
                            $tresc .= '<div class="col-md-6 padding_r_10 inputPole"><input disabled value="'.$umowa_rodzaj_dane_tmp->ProcentWynagrodzenia.'" type="text"  placeholder="% wynagrodzenia"></div>';
                            $tresc .= '<div class="col-md-6 margin_b_10 inputPole"><input disabled value="'.$typ_szkody_tmp->Wartosc.'" type="text"  placeholder="Typ szkody"></div>';


                            $tresc .= '<label class="margin_t_10 width_100">KLIENT</label>';
                            $tresc .= '<div class="col-md-6 padding_r_10 margin_b_10 inputPole"><input disabled value="'.$umowa_osoba_tmp->Imie.'" type="text"  placeholder="Imie"></div>';
                            $tresc .= '<div class="col-md-6 margin_b_10 inputPole"><input disabled value="'.$umowa_osoba_tmp->Nazwisko.'" type="text"  placeholder="Nazwisko"></div>';
                            $tresc .= '<div class="col-md-6 padding_r_10 inputPole"><input disabled value="'.$umowa_osoba_kontakt_tmp->Telefon.'" type="text"  placeholder="Telefon"></div>';
                            $tresc .= '<div class="col-md-6 inputPole"><input disabled value="'.$umowa_osoba_kontakt_tmp->Mail.'" type="text"  placeholder="Mail"></div>';
                            $tresc .= '<div class="clear_b"></div>';

                            $tresc .= '<label class="margin_t_10 width_100">ODBIORCA WYNAGRODZENIA</label>';

                            $odbiorca_imie = '';
                            $odbirca_nazwisko = '';

                            if($umowa_rodzaj_dane_tmp->SposobPlatnosciId == '2'){

                                $umowa_odbiorca_wynagrdzenia_rachunek = $bazaDanych->pobierzDane('*', 'umowaRachunekBankowy', 'Id = ' . $umowa_rodzaj_dane_tmp->RachunekBankowyId);

                                if($umowa_odbiorca_wynagrdzenia_rachunek) {
                                    $umowa_odbiorca_wynagrdzenia_rachunek = $umowa_odbiorca_wynagrdzenia_rachunek->fetch_object();
                                    $umowa_odbiorca_wynagrdzenia = $bazaDanych->pobierzDane('*', 'umowaOsoba', 'Id = ' . $umowa_odbiorca_wynagrdzenia_rachunek->OsobaId);
                                }
                                $tresc .= '<div class="col-md-12 margin_b_10 inputPole"><input disabled value="'.$umowa_odbiorca_wynagrdzenia_rachunek->Numer.'" type="text"  placeholder="Numer Rachunku"></div>';

                            }else{
                                if(!is_null($umowa_rodzaj_dane_tmp->OdbiorcaId)){
                                    $umowa_odbiorca_wynagrdzenia = $bazaDanych->pobierzDane('*','umowaOsoba','Id = '.$umowa_rodzaj_dane_tmp->OdbiorcaId);
                                }
                            }

                            if(!is_null($umowa_odbiorca_wynagrdzenia)){
                                $umowa_odbiorca_wynagrdzenia = $umowa_odbiorca_wynagrdzenia->fetch_object();
                                $odbiorca_imie = $umowa_odbiorca_wynagrdzenia->Imie;
                                $odbirca_nazwisko = $umowa_odbiorca_wynagrdzenia->Nazwisko;
                            }

                            $tresc .= '<div class="col-md-6 padding_r_10 inputPole"><input disabled value="'.$odbiorca_imie.'" type="text"  placeholder="Imie"></div>';
                            $tresc .= '<div class="col-md-6 inputPole"><input disabled value="'.$odbirca_nazwisko.'" type="text"  placeholder="Nazwisko"></div>';
                            $tresc .= '<div class="clear_b"></div>';
                            $tresc .= '<button type="button" data-element_id="'.$element_id[0].'-'.$element_id[1].'-'.$element_id[2].'" data-akcja="edytuj" data-droga="'.$umowa_droga.'" data-ogolne="1" data-strona="zakladki"  class="margin_t_10 wczytajStroneUmowyDoPopUp btn btn-success width_100 przyciskZapiszZmianyZielony">Edytuj</button>';

                        $tresc .= '</div>';
                    $tresc .= '</div>';
                    $tresc .='<div role="tabpanel" class="tab-pane" id="szczegolyDruki">';


                        $tresc .='<ul class="list-group margin_b_0 listaDrukow">';


                        if ($umowa_tmp->UmowaTypId == 3) {

                            if ($umowa_rodzaj_dane_tmp->OgraniczenieWierzytelnosci) {
                                $lista_drukow = $bazaDanych->pobierzDane('*','umowaDrukTypUmowaTyp','UmowaTypId = '.$umowa_tmp->UmowaTypId. ' AND UmowaPodtypId='.$umowa_rodzaj_dane_tmp->UmowaRzeczowaTypId);
                            } else {
                                $lista_drukow = $bazaDanych->pobierzDane('*','umowaDrukTypUmowaTyp','UmowaTypId = '.$umowa_tmp->UmowaTypId. ' AND UmowaPodtypId='.$umowa_rodzaj_dane_tmp->UmowaRzeczowaTypId. ' AND DrukTypId!=8');
                            }

                            //$lista_drukow = $bazaDanych->pobierzDane('*','umowaDrukTypUmowaTyp','UmowaTypId = '.$umowa_tmp->UmowaTypId. ' AND UmowaPodtypId='.$umowa_rodzaj_dane_tmp->UmowaRzeczowaTypId);

                        } else if ($umowa_tmp->UmowaTypId == 4) {
                            $lista_drukow = $bazaDanych->pobierzDane('*','umowaDrukTypUmowaTyp','UmowaTypId = '.$umowa_tmp->UmowaTypId.' AND UmowaPodtypId IS NULL');
                        } else {
                            $lista_drukow = $bazaDanych->pobierzDane('*','umowaDrukTypUmowaTyp','UmowaTypId = '.$umowa_tmp->UmowaTypId);
                        }
                            if(mysqli_num_rows($lista_drukow) !== 0){

                                while($poj_lista_drukow = $lista_drukow->fetch_object()){

                                        $druk = $bazaDanych->pobierzDane('*', 'umowaSlownikDrukTyp', 'Id = ' . $poj_lista_drukow->DrukTypId);
                                        $druk = $druk->fetch_object();
                                        $tresc .= '<li class="list-group-item btn btn-default generujDokument" data-nazwa_druku="' . $druk->WartoscUproszczona . '" data-rodzaj_druku="' . $druk->Rodzaj . '" data-droga="' . $umowa_droga . '" data-element_id="' . $element_id[0] . '-' . $element_id[1] . '-' . $element_id[2] . '">' . $druk->Wartosc .'</li>';
                                }

                                $rodzaj_szkody = $bazaDanych->pobierzDane('*','umowaOsobowa','Id = '.$element_id[2]);
                                if ($rodzaj_szkody) {
                                    $rodzaj_szkody = $rodzaj_szkody->fetch_object();

                                    if ($umowa_tmp->UmowaTypId == 4 && $rodzaj_szkody->TypSzkodyId == 1) {
                                        $tresc .= '<li class="list-group-item btn btn-default generujDokument margin_b_10" data-nazwa_druku="oswiadczenie_poszkodowanego" data-rodzaj_druku="' . $druk->Rodzaj . '" data-droga="' . $umowa_droga . '" data-element_id="' . $element_id[0] . '-' . $element_id[1] . '-' . $element_id[2] . '">Oświadczenie poszkodowanego</li>';
                                        $tresc .= '<li class="list-group-item btn btn-default generujDokument margin_b_10" data-nazwa_druku="wniosek_do_fundacji_votum" data-rodzaj_druku="' . $druk->Rodzaj . '" data-droga="' . $umowa_droga . '" data-element_id="' . $element_id[0] . '-' . $element_id[1] . '-' . $element_id[2] . '">Wniosek do Fundacji VOTUM</li>';
                                        $tresc .= '<li class="list-group-item btn btn-default margin_b_10"><a target="_blank" href="/moduly/druki/!druki_pdf/instrukcja.pdf">Instrukcja wypełniania oświadczenia oraz wniosek</a></li>';
                                        //$tresc .= '<li class="list-group-item btn btn-default margin_b_10"><a target="_blank" href="/moduly/druki/!druki_pdf/wniosek_do_fundacji_Votum.pdf">Wniosek do Fundacji VOTUM</a></li>';
                                    } else if ($umowa_tmp->UmowaTypId == 4 && $rodzaj_szkody->TypSzkodyId == 2) {
                                        $tresc .= '<li class="list-group-item btn btn-default generujDokument margin_b_10" data-nazwa_druku="ankieta" data-rodzaj_druku="' . $druk->Rodzaj . '" data-droga="' . $umowa_droga . '" data-element_id="' . $element_id[0] . '-' . $element_id[1] . '-' . $element_id[2] . '">Ankieta uprawnionego</li>';
                                    }
                                    //if ($umowa_tmp->UmowaTypId == 4) {
                                        $tresc .= '<li class="list-group-item btn btn-default generujDokument margin_b_10" data-nazwa_druku="wszystko" data-rodzaj_druku="' . $druk->Rodzaj . '" data-droga="' . $umowa_droga . '" data-element_id="' . $element_id[0] . '-' . $element_id[1] . '-' . $element_id[2] . '">Wszystkie dokumenty</li>';
                                    //}
                                }


                            }else{
                                $tresc .= 'Brak dostepnych druków do wygenerowania...';
                            }

                        $tresc .='</ul>';
                    $tresc .='</div>';



/*

                    $tresc .='<div role="tabpanel" class="tab-pane" id="szczegolyPliki">';
                    $tresc .= '<form id="my_for_d" enctype="multipart/form-data" method="post">
                        <label for="file">Dodaj plik</label>
                        <input id="file" name="file[]" class="input-file" type="file"  multiple="multiple">
                        <button class="add_more">Dodaj więcej plików</button><br>
                        <input id="upload_file" type="submit" class="btn btn-default" value="Wyślij">
                    </form>';
                    $tresc .='</div>';

*/




            $tresc .= '</div>';
        break;

    default:
        $tresc = 'Wystąpił błąd!!! Skontaktuj się z administratorem systemu!!!';

}

$dane = array(
            'tytul' => $tytul
            ,'tresc' => $tresc
            ,'miniatura' => ''
);

echo json_encode($dane);
return;
?>

