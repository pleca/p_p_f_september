<?php
require_once($_SERVER ['DOCUMENT_ROOT'].'czy_zalogowany.php');
setlocale ( LC_CTYPE, "pl_PL.UTF-8" );

$drukiaMain = new DrukiMain();

$element_id = (isset($_POST['element_id'])) ? htmlspecialchars($_POST['element_id']) : '' ;
$droga = (isset($_POST['droga'])) ? htmlspecialchars($_POST['droga']) : '' ;
$nazwa_druku = (isset($_POST['nazwa_druku'])) ? htmlspecialchars($_POST['nazwa_druku']) : '' ;

$element_id = explode('-',$element_id);
//$element_id[0] - umowa
//$element_id[1] - glowny klient
//$element_id[2] - umowa typ

$komunikat = 'Brak akcji do wykonania!!!';
$rodzajOut = 'blad';

$zmienne_pdf = array();

$umowa = $bazaDanych->pobierzDane('*','umowa','Id = '.$element_id[0]);
$umowa = $umowa->fetch_object();

$IdentyfikatorPrzedstawiciela = $bazaDanych->pobierzDane('login, imie, nazwisko','uzytkownik','id = '.$umowa->PrzedstawicielId);
$IdentyfikatorPrzedstawiciela = $IdentyfikatorPrzedstawiciela->fetch_object();

/*if(!empty($umowa->JednostkaId)){
    $KodJednostki = $bazaDanych->pobierzDane('Wartosc','umowaSlownikKodJednostki','Id = '.$umowa->JednostkaId);
    $KodJednostki = $KodJednostki->fetch_object();
}*/

$zmienne_pdf['umowa'] = array(
    'IdentyfikatorPrzedstawiciela' => $IdentyfikatorPrzedstawiciela->login
,'Imie' => $IdentyfikatorPrzedstawiciela->imie
,'Nazwisko' => $IdentyfikatorPrzedstawiciela->nazwisko
,'KodJednostki' => $umowa->JednostkaNumer
,'KonsultantId' => $umowa->KonsultantId
,'DataUmowy' => $umowa->DataUmowy
,'Miasto' => $umowa->Miasto
);
$zmienne_pdf['umowa'] = json_encode($zmienne_pdf['umowa']);

$umowa_klient = $bazaDanych->pobierzDane('*','umowaOsoba','Id = '.$element_id[1]);
$umowa_klient = $umowa_klient->fetch_object();
$umowa_klient_adres = $bazaDanych->pobierzDane('*','umowaAdres','Id = '.$umowa_klient->AdresId);
$umowa_klient_adres = $umowa_klient_adres->fetch_object();
$umowa_klient_adres_miasto = $bazaDanych->pobierzDane('*','umowaAdresMiasto','Id = '.$umowa_klient_adres->MiastoId);
$umowa_klient_adres_miasto = $umowa_klient_adres_miasto->fetch_object();
$umowa_klient_kontakt = $bazaDanych->pobierzDane('*','umowaKontakt','Id = '.$umowa_klient->KontaktId);
$umowa_klient_kontakt = $umowa_klient_kontakt->fetch_object();

$zmienne_pdf['klient'] = array(
    'Imie' => $umowa_klient->Imie
,'IdKlienta' => $umowa_klient->Id
,'Nazwisko' => $umowa_klient->Nazwisko
,'Ulica' => $umowa_klient_adres->Ulica
,'NrDomu' => $umowa_klient_adres->NrDomu
,'NrMieszkania' => $umowa_klient_adres->NrMieszkania
,'KodPocztowy' => $umowa_klient_adres->KodPocztowy
,'Miasto' => $umowa_klient_adres_miasto->Wartosc
,'Pesel' => $umowa_klient->Pesel
,'Dowod' => $umowa_klient->Dowod
,'Mail' => $umowa_klient_kontakt->Mail
,'Telefon' => $umowa_klient_kontakt->Telefon
);
$zmienne_pdf['klient'] = json_encode($zmienne_pdf['klient']);



switch ($droga) {
    case 'bankowa':
        $umowaBankowa = $bazaDanych->pobierzDane('*','umowaBankowa','Id = '.$element_id[2]);
        $umowaBankowa = $umowaBankowa->fetch_object();

        $osoba_do_inf_tel = $bazaDanych->pobierzDane('Imie, Nazwisko, Pesel','umowaOsoba','Id = '.$umowaBankowa->OsobaUprawnionyDoInfId);

        if($osoba_do_inf_tel) {
            $osoba_do_inf_tel = $osoba_do_inf_tel->fetch_object();

            $zmienne_pdf['uprawniony_do_inf_tel'] = array(
                'Imie' => $osoba_do_inf_tel->Imie
            ,'Nazwisko' => $osoba_do_inf_tel->Nazwisko
            ,'Pesel' => $osoba_do_inf_tel->Pesel
            );
            $zmienne_pdf['uprawniony_do_inf_tel'] = json_encode($zmienne_pdf['uprawniony_do_inf_tel']);
        }


        $umowa_klient_2_id = $bazaDanych->pobierzDane('OsobaId','umowaBankowaOsoba','BankowaId = '.$element_id[2].' AND NrKlienta = 2');

        if(mysqli_num_rows($umowa_klient_2_id) != 0){
            $umowa_klient_2_id = $umowa_klient_2_id->fetch_object();
            $umowa_klient = $bazaDanych->pobierzDane('*','umowaOsoba','Id = '.$umowa_klient_2_id->OsobaId);
            $umowa_klient = $umowa_klient->fetch_object();
            $umowa_klient_adres = $bazaDanych->pobierzDane('*','umowaAdres','Id = '.$umowa_klient->AdresId);
            $umowa_klient_adres = $umowa_klient_adres->fetch_object();
            $umowa_klient_adres_miasto = $bazaDanych->pobierzDane('*','umowaAdresMiasto','Id = '.$umowa_klient_adres->MiastoId);
            $umowa_klient_adres_miasto = $umowa_klient_adres_miasto->fetch_object();
            $umowa_klient_kontakt = $bazaDanych->pobierzDane('*','umowaKontakt','Id = '.$umowa_klient->KontaktId);
            $umowa_klient_kontakt = $umowa_klient_kontakt->fetch_object();

            $zmienne_pdf['klient2'] = array(
                'Imie' => $umowa_klient->Imie
            ,'Nazwisko' => $umowa_klient->Nazwisko
            ,'Ulica' => $umowa_klient_adres->Ulica
            ,'NrDomu' => $umowa_klient_adres->NrDomu
            ,'NrMieszkania' => $umowa_klient_adres->NrMieszkania
            ,'KodPocztowy' => $umowa_klient_adres->KodPocztowy
            ,'Miasto' => $umowa_klient_adres_miasto->Wartosc
            ,'Pesel' => $umowa_klient->Pesel
            ,'Dowod' => $umowa_klient->Dowod
            ,'Mail' => $umowa_klient_kontakt->Mail
            ,'Telefon' => $umowa_klient_kontakt->Telefon
            );
            $zmienne_pdf['klient2'] = json_encode($zmienne_pdf['klient2']);
        }


        $zmienne_pdf['lista_dostepnej_dokumentacji'] = array();

        $lista_dokumentacji = $bazaDanych->pobierzDane('ZalacznikTypId','umowaZalacznikTypUmowaTyp','UmowaTypId = 1');
        while($poj_lista_dokumentacji = $lista_dokumentacji->fetch_object()){
            $lista_dokumentacji_nazwa = $bazaDanych->pobierzDane('Id, Wartosc','umowaSlownikZalacznikTyp','Id = '.$poj_lista_dokumentacji->ZalacznikTypId);
            $lista_dokumentacji_nazwa = $lista_dokumentacji_nazwa->fetch_object();
            $zmienne_pdf['lista_dostepnej_dokumentacji'][$poj_lista_dokumentacji->ZalacznikTypId] = $lista_dokumentacji_nazwa->Wartosc;

        }
        $zmienne_pdf['lista_dostepnej_dokumentacji'] = json_encode($zmienne_pdf['lista_dostepnej_dokumentacji']);

        $zmienne_pdf['lista_pobranej_dokumentacji'] = '';
        $lista_pobranej_dokumentacji = $bazaDanych->pobierzDane('ZalacznikTypId','umowaZalacznik','UmowaId = '.$element_id[0].' AND czy_usuniety = 0');
        if(!is_null($lista_pobranej_dokumentacji)){
            while($poj_lista_pobranej_dokumentacji = $lista_pobranej_dokumentacji->fetch_object()){
                $zmienne_pdf['lista_pobranej_dokumentacji'] .= $poj_lista_pobranej_dokumentacji->ZalacznikTypId.',';
            }
        }

        $lista_dodatkowych_klientow = $bazaDanych->pobierzDane('OsobaId','umowaBankowaOsoba','BankowaId = '.$element_id[2].' AND NrKlienta > 2');
        $liczba_dodatkowych_klientow = 0;
        if($lista_dodatkowych_klientow != false){
            $liczba_dodatkowych_klientow = mysqli_num_rows($lista_dodatkowych_klientow);
            $zmienne_pdf['lista_dodatkowych_klientow'] = array();

            $i = 0;
            while($poj_lista_dodatkowych_klientow = $lista_dodatkowych_klientow->fetch_object()){
                $umowa_dod_klient = $bazaDanych->pobierzDane('*','umowaOsoba','Id = '.$poj_lista_dodatkowych_klientow->OsobaId);
                $umowa_dod_klient = $umowa_dod_klient->fetch_object();
                $umowa_dod_klient_adres = $bazaDanych->pobierzDane('*','umowaAdres','Id = '.$umowa_dod_klient->AdresId);
                $umowa_dod_klient_adres = $umowa_dod_klient_adres->fetch_object();
                $umowa_dod_klient_adres_miasto = $bazaDanych->pobierzDane('*','umowaAdresMiasto','Id = '.$umowa_dod_klient_adres->MiastoId);
                $umowa_dod_klient_adres_miasto = $umowa_dod_klient_adres_miasto->fetch_object();
                $umowa_dod_klient_kontakt = $bazaDanych->pobierzDane('*','umowaKontakt','Id = '.$umowa_dod_klient->KontaktId);
                $umowa_dod_klient_kontakt = $umowa_dod_klient_kontakt->fetch_object();

                $zmienne_pdf['lista_dodatkowych_klientow'][$i] = array(
                    'Imie' => $umowa_dod_klient->Imie
                ,'Nazwisko' => $umowa_dod_klient->Nazwisko
                ,'Ulica' => $umowa_dod_klient_adres->Ulica
                ,'NrDomu' => $umowa_dod_klient_adres->NrDomu
                ,'NrMieszkania' => $umowa_dod_klient_adres->NrMieszkania
                ,'KodPocztowy' => $umowa_dod_klient_adres->KodPocztowy
                ,'Miasto' => $umowa_dod_klient_adres_miasto->Wartosc
                ,'Pesel' => $umowa_dod_klient->Pesel
                ,'Dowod' => $umowa_dod_klient->Dowod
                ,'Mail' => $umowa_dod_klient_kontakt->Mail
                ,'Telefon' => $umowa_dod_klient_kontakt->Telefon
                );
                $i++;
            }

            $zmienne_pdf['lista_dodatkowych_klientow'] = json_encode($zmienne_pdf['lista_dodatkowych_klientow']);

        }

        $rodzaj_kredytu_nazwa = $bazaDanych->pobierzDane('Id, Wartosc','umowaSlownikRodzajKredytu','Id = '.$umowaBankowa->RodzajKredytuId);

        if($rodzaj_kredytu_nazwa) {
            $rodzaj_kredytu_nazwa = $rodzaj_kredytu_nazwa->fetch_object();

            $rodzaj_kredytu = $rodzaj_kredytu_nazwa->Wartosc;
        }


        $zmienne_pdf['umowa_dane'] = array(
            'Zobowiazany' => $umowaBankowa->Zobowiazany
        ,'UdzielajacyKredytu' => $umowaBankowa->UdzielajacyKredytu
        ,'NrKredytu' => $umowaBankowa->NrKredytu
        ,'ProcentWynagrodzenia' => $umowaBankowa->ProcentWynagrodzenia
        ,'ProcentWynagrodzeniaSlownie' => slownie(intval($umowaBankowa->ProcentWynagrodzenia))
        ,'ZgloszenieRoszczenDoBanku' => $umowaBankowa->ZgloszenieRoszczenDoBanku
        ,'NadplaconeRaty' => $umowaBankowa->NadplaconeRaty
        ,'UbezpieczeniPomostowe' => $umowaBankowa->UbezpieczeniPomostowe
        ,'UbezpieczeniePomostoweData' => $umowaBankowa->UbezpieczeniePomostoweData
        ,'UbezpieczenieWkladu' => $umowaBankowa->UbezpieczenieWkladu
        ,'UbezpieczenieWkladuData' => $umowaBankowa->UbezpieczenieWkladuData
        ,'ZlecenieDochodzeniaRoszczen' => $umowaBankowa->ZlecenieDochodzeniaRoszczen
        ,'PelnomocnikNazwa' => $umowaBankowa->PelnomocnikNazwa
        ,'PelnomocnikDataZawarcia' => $umowaBankowa->PelnomocnikDataZawarcia
        ,'PelnomocnikWypowiedzenieUmowy' => $umowaBankowa->PelnomocnikWypowiedzenieUmowy
        ,'PelnomocnitWypowiedzenieUmowyData' => $umowaBankowa->PelnomocnitWypowiedzenieUmowyData
        ,'ZgodaNaInformacje' => $umowaBankowa->ZgodaNaInformacje
        ,'ZgodaSms' => $umowaBankowa->ZgodaSms
        ,'ZgodaMail' => $umowaBankowa->ZgodaMail
        ,'ZgodaOfertaDSA' => $umowaBankowa->ZgodaOfertaDSA
        ,'ZgodaOfertaProtecta' => $umowaBankowa->ZgodaOfertaProtecta
        ,'ZgodaInfDSA' => $umowaBankowa->ZgodaInfDSA
        ,'ZgodaMarketingDSA' => $umowaBankowa->ZgodaMarketingDSA
        ,'ZgodaInfProtecta' => $umowaBankowa->ZgodaInfProtecta
        ,'ZgodaMarketingProtecta' => $umowaBankowa->ZgodaMarketingProtecta
        ,'ListaDodatkowychKlientow' => $liczba_dodatkowych_klientow
        ,'AdresKorJakZameldowania' => $umowaBankowa->AdresKorJakZameldowania
        ,'RodzajKredytu' => $rodzaj_kredytu
        ,'OsobaUprawnionyDoInfId' => $umowaBankowa->OsobaUprawnionyDoInfId
        , 'ZgodaDaneDSA' => $umowaBankowa->ZgodaDaneDSA
        , 'ZgodaDaneProtecta' => $umowaBankowa->ZgodaDaneProtecta
        , 'ZgodaInfVotum' => $umowaBankowa->ZgodaInfVotum
        , 'ZgodaMarketingVotum' => $umowaBankowa->ZgodaMarketingVotum
        , 'ZgodaDanePCRF' => $umowaBankowa->ZgodaDanePCRF
        , 'ZgodaDaneFundacja' => $umowaBankowa->ZgodaDaneFundacja
        , 'ZgodaDaneAutovotum' => $umowaBankowa->ZgodaDaneAutovotum
        , 'ZgodaDaneBEP' => $umowaBankowa->ZgodaDaneBEP
        );

        $zmienne_pdf['umowa_dane'] = json_encode($zmienne_pdf['umowa_dane']);

        $wynagrodzenie_numer = '';
        $wynagrodzenie_odbiorca_id = $umowaBankowa->OdbiorcaId;
        if(!empty($umowaBankowa->SposobPlatnosciId)){
            if($umowaBankowa->SposobPlatnosciId == 2){
                $wynagrodzenie_tmp = $bazaDanych->pobierzDane('*','umowaRachunekBankowy','Id = '.$umowaBankowa->RachunekBankowyId);

                if ($wynagrodzenie_tmp) {
                    $wynagrodzenie_tmp = $wynagrodzenie_tmp->fetch_object();

                    $wynagrodzenie_numer = $wynagrodzenie_tmp->Numer;
                    $wynagrodzenie_odbiorca_id = $wynagrodzenie_tmp->OsobaId;
                }

            }

            if(!empty($wynagrodzenie_odbiorca_id)){
                $wynagrodzenie_odbiorca = $bazaDanych->pobierzDane('*','umowaOsoba','Id = '.$wynagrodzenie_odbiorca_id);
                $wynagrodzenie_odbiorca = $wynagrodzenie_odbiorca->fetch_object();
                $wynagrodzenie_odbiorca_adres = $bazaDanych->pobierzDane('*','umowaAdres','Id = '.$wynagrodzenie_odbiorca->AdresId);
                $wynagrodzenie_odbiorca_adres = $wynagrodzenie_odbiorca_adres->fetch_object();
                $wynagrodzenie_odbiorca_adres_miasto = $bazaDanych->pobierzDane('*','umowaAdresMiasto','Id = '.$wynagrodzenie_odbiorca_adres->MiastoId);
                $wynagrodzenie_odbiorca_adres_miasto = $wynagrodzenie_odbiorca_adres_miasto->fetch_object();

                $zmienne_pdf['wynagrodzenie'] = array(
                    'SposobPlatnosciId' => $umowaBankowa->SposobPlatnosciId
                ,'WynagdorzenieNumer' => $wynagrodzenie_numer
                ,'WynagdorzenieImie' => $wynagrodzenie_odbiorca->Imie
                ,'WynagdorzenieNazwisko' => $wynagrodzenie_odbiorca->Nazwisko
                ,'WynagdorzenieUlica' => $wynagrodzenie_odbiorca_adres->Ulica
                ,'WynagdorzenieNrDomu' => $wynagrodzenie_odbiorca_adres->NrDomu
                ,'WynagdorzenieNrMieszkania' => $wynagrodzenie_odbiorca_adres->NrMieszkania
                ,'WynagdorzenieKodPocztowy' => $wynagrodzenie_odbiorca_adres->KodPocztowy
                ,'WynagdorzenieMiasto' => $wynagrodzenie_odbiorca_adres_miasto->Wartosc
                );
                $zmienne_pdf['wynagrodzenie'] = json_encode($zmienne_pdf['wynagrodzenie']);

                //var_dump($zmienne_pdf['wynagrodzenie']);
            }

        }

        if($umowaBankowa->AdresKorJakZameldowania != 1){
            $umowa_adres_kor = $bazaDanych->pobierzDane('*','umowaAdres','Id = '.$umowaBankowa->AdresKorId);
            $umowa_adres_kor = $umowa_adres_kor->fetch_object();
            $umowa_adres_kor_miasto = $bazaDanych->pobierzDane('*','umowaAdresMiasto','Id = '.$umowa_adres_kor->MiastoId);
            $umowa_adres_kor_miasto = $umowa_adres_kor_miasto->fetch_object();

            $zmienne_pdf['adres_do_korespondencji'] = array(
                'KorUlica' => $umowa_adres_kor->Ulica
            ,'KorNrDomu' => $umowa_adres_kor->NrDomu
            ,'KorNrMieszkania' => $umowa_adres_kor->NrMieszkania
            ,'KorKodPocztowy' => $umowa_adres_kor->KodPocztowy
            ,'KorMiasto' => $umowa_adres_kor_miasto->Wartosc
            );
            $zmienne_pdf['adres_do_korespondencji'] = json_encode($zmienne_pdf['adres_do_korespondencji']);
        }


        break;

    case 'ofe':

        $umowaOfe = $bazaDanych->pobierzDane('*','umowaOfe','Id = '.$element_id[2]);
        $umowaOfe = $umowaOfe->fetch_object();

        if($umowaOfe->UmowaDzialajacyWImieniuId != 4){
            $umowa_w_imieniu_opis = $bazaDanych->pobierzDane('Wartosc','umowaSlownikDzialajacWImieniu','Id = '.$umowaOfe->UmowaDzialajacyWImieniuId.' AND czy_usuniety = 0');
            $umowa_w_imieniu_opis = $umowa_w_imieniu_opis->fetch_object();
            $umowa_w_imieniu = $bazaDanych->pobierzDane('*','umowaOsoba','Id = '.$umowaOfe->OsobaPoszkodowanyId);
            $umowa_w_imieniu = $umowa_w_imieniu->fetch_object();
            $umowa_w_imieniu_adres = $bazaDanych->pobierzDane('*','umowaAdres','Id = '.$umowa_w_imieniu->AdresId);
            $umowa_w_imieniu_adres = $umowa_w_imieniu_adres->fetch_object();
            $umowa_w_imieniu_adres_miasto = $bazaDanych->pobierzDane('*','umowaAdresMiasto','Id = '.$umowa_w_imieniu_adres->MiastoId);
            $umowa_w_imieniu_adres_miasto = $umowa_w_imieniu_adres_miasto->fetch_object();

            $zmienne_pdf['w_imieniu'] = array(
                'Opis' => $umowaOfe->UmowaDzialajacyWImieniuId
            ,'Imie' => $umowa_w_imieniu->Imie
            ,'Nazwisko' => $umowa_w_imieniu->Nazwisko
            ,'Ulica' => $umowa_w_imieniu_adres->Ulica
            ,'NrDomu' => $umowa_w_imieniu_adres->NrDomu
            ,'NrMieszkania' => $umowa_w_imieniu_adres->NrMieszkania
            ,'KodPocztowy' => $umowa_w_imieniu_adres->KodPocztowy
            ,'Miasto' => $umowa_w_imieniu_adres_miasto->Wartosc
            );

            $zmienne_pdf['w_imieniu'] = json_encode($zmienne_pdf['w_imieniu']);
        }
        $wynagrodzenie_numer = '';
        $wynagrodzenie_odbiorca_id = $umowaOfe->OdbiorcaId;
        if(!empty($umowaOfe->SposobPlatnosciId)){
            if($umowaOfe->SposobPlatnosciId == 2){
                $wynagrodzenie_tmp = $bazaDanych->pobierzDane('*','umowaRachunekBankowy','Id = '.$umowaOfe->RachunekBankowyId);
                $wynagrodzenie_tmp = $wynagrodzenie_tmp->fetch_object();

                $wynagrodzenie_numer = $wynagrodzenie_tmp->Numer;
                $wynagrodzenie_odbiorca_id = $wynagrodzenie_tmp->OsobaId;
            }

            if(!empty($wynagrodzenie_odbiorca_id)){
                $wynagrodzenie_odbiorca = $bazaDanych->pobierzDane('*','umowaOsoba','Id = '.$wynagrodzenie_odbiorca_id);
                $wynagrodzenie_odbiorca = $wynagrodzenie_odbiorca->fetch_object();
                $wynagrodzenie_odbiorca_adres = $bazaDanych->pobierzDane('*','umowaAdres','Id = '.$wynagrodzenie_odbiorca->AdresId);
                $wynagrodzenie_odbiorca_adres = $wynagrodzenie_odbiorca_adres->fetch_object();
                $wynagrodzenie_odbiorca_adres_miasto = $bazaDanych->pobierzDane('*','umowaAdresMiasto','Id = '.$wynagrodzenie_odbiorca_adres->MiastoId);
                $wynagrodzenie_odbiorca_adres_miasto = $wynagrodzenie_odbiorca_adres_miasto->fetch_object();

                $zmienne_pdf['wynagrodzenie'] = array(
                    'SposobPlatnosciId' => $umowaOfe->SposobPlatnosciId
                ,'WynagrodzenieNumer' => $wynagrodzenie_numer
                ,'WynagrodzenieImie' => $wynagrodzenie_odbiorca->Imie
                ,'WynagrodzenieNazwisko' => $wynagrodzenie_odbiorca->Nazwisko
                ,'WynagrodzenieUlica' => $wynagrodzenie_odbiorca_adres->Ulica
                ,'WynagrodzenieNrDomu' => $wynagrodzenie_odbiorca_adres->NrDomu
                ,'WynagrodzenieNrMieszkania' => $wynagrodzenie_odbiorca_adres->NrMieszkania
                ,'WynagrodzenieKodPocztowy' => $wynagrodzenie_odbiorca_adres->KodPocztowy
                ,'WynagrodzenieMiasto' => $wynagrodzenie_odbiorca_adres_miasto->Wartosc
                );
                $zmienne_pdf['wynagrodzenie'] = json_encode($zmienne_pdf['wynagrodzenie']);

            }

        }


        break;

    case 'rzeczowa':

        $umowaRzeczowa = $bazaDanych->pobierzDane('*','umowaRzeczowa','Id = '.$element_id[2]);
        $umowaRzeczowa = $umowaRzeczowa->fetch_object();

        unset($zmienne_pdf['klient']);

        $umowa_pojazd = $bazaDanych->pobierzDane('*','umowaPojazd','Id = '.$umowaRzeczowa->PojazdId);
        if ($umowa_pojazd){
            $umowa_pojazd = $umowa_pojazd->fetch_object();
        }
        $umowa_ubezpieczyciel = $bazaDanych->pobierzDane('*','umowaUbezpieczyciel','Id = '.$umowaRzeczowa->UbezpieczycielId);
        if ($umowa_ubezpieczyciel){
            $umowa_ubezpieczyciel = $umowa_ubezpieczyciel->fetch_object();
            $umowa_ubezpieczyciel_adres = $bazaDanych->pobierzDane('*','umowaAdres','Id = '.$umowa_ubezpieczyciel->AdresId);
            $umowa_ubezpieczyciel_adres = $umowa_ubezpieczyciel_adres->fetch_object();
            $umowa_ubezpieczyciel_adres_miasto = $bazaDanych->pobierzDane('*','umowaAdresMiasto','Id = '.$umowa_ubezpieczyciel_adres->MiastoId);
            $umowa_ubezpieczyciel_adres_miasto = $umowa_ubezpieczyciel_adres_miasto->fetch_object();
        }

        $wartosc_uproszczona_umowy = $bazaDanych->pobierzDane('*','umowaSlownikUmowaRzeczowaTyp','Id = '.$umowaRzeczowa->UmowaRzeczowaTypId);
        $wartosc_uproszczona_umowy = $wartosc_uproszczona_umowy->fetch_object();

        $droga = $wartosc_uproszczona_umowy->WartoscUproszczona;


        $lista_wlascicieli = $bazaDanych->pobierzDane('OsobaId','umowaRzeczowaOsoba','RzeczowaId = '.$element_id[2].' AND OsobaTypId=1');
        $liczba_wlascicieli = mysqli_num_rows($lista_wlascicieli);

        $zmienne_pdf['liczba_wlascicieli'] = $liczba_wlascicieli;

        for ($i=1; $i<=$liczba_wlascicieli; $i++) {

            $lista_wlascicieli = $bazaDanych->pobierzDane('OsobaId, UrzadSkarbowyId, WielkoscUdzialu','umowaRzeczowaOsoba','RzeczowaId = '.$element_id[2].' AND NrOsoby = '.$i.' AND OsobaTypId=1');

            if($lista_wlascicieli) {
                $lista_wlascicieli = $lista_wlascicieli->fetch_object();
                $umowa_klient = $bazaDanych->pobierzDane('*', 'umowaOsoba', 'Id = ' . $lista_wlascicieli->OsobaId);
                $umowa_klient = $umowa_klient->fetch_object();
                $umowa_klient_adres = $bazaDanych->pobierzDane('*', 'umowaAdres', 'Id = ' . $umowa_klient->AdresId);
                $umowa_klient_adres = $umowa_klient_adres->fetch_object();
                $umowa_klient_adres_miasto = $bazaDanych->pobierzDane('*', 'umowaAdresMiasto', 'Id = ' . $umowa_klient_adres->MiastoId);
                $umowa_klient_adres_miasto = $umowa_klient_adres_miasto->fetch_object();
                $umowa_klient_kontakt = $bazaDanych->pobierzDane('*', 'umowaKontakt', 'Id = ' . $umowa_klient->KontaktId);
                $umowa_klient_kontakt = $umowa_klient_kontakt->fetch_object();

                $urzad_skarbowy = $bazaDanych->pobierzDane('*', 'umowaUrzadSkarbowy', 'Id = ' . $lista_wlascicieli->UrzadSkarbowyId);


                if ($urzad_skarbowy) {
                    $urzad_skarbowy = $urzad_skarbowy->fetch_object();

                    $adres_us_tmp = $bazaDanych->pobierzDane('*', 'umowaAdres', 'Id = ' . $urzad_skarbowy->AdresId);
                    $adres_us_tmp = $adres_us_tmp->fetch_object();

                    $miasto_us_tmp = $bazaDanych->pobierzDane('*', 'umowaAdresMiasto', 'Id = ' . $adres_us_tmp->MiastoId);
                    $miasto_us_tmp = $miasto_us_tmp->fetch_object();
                }

                $zmienne_pdf['klient_' . $i] = array(
                    'Imie' => $umowa_klient->Imie
                , 'Nazwisko' => $umowa_klient->Nazwisko
                , 'Nazwa' => $umowa_klient->Nazwa
                , 'Id' => $umowa_klient->Id
                , 'Nip' => $umowa_klient->Nip
                , 'Krs' => $umowa_klient->Krs
                , 'DataUrodzenia' => $umowa_klient->DataUrodzenia
                , 'Ulica' => $umowa_klient_adres->Ulica
                , 'NrDomu' => $umowa_klient_adres->NrDomu
                , 'NrMieszkania' => $umowa_klient_adres->NrMieszkania
                , 'KodPocztowy' => $umowa_klient_adres->KodPocztowy
                , 'Miasto' => $umowa_klient_adres_miasto->Wartosc
                , 'Pesel' => $umowa_klient->Pesel
                , 'Dowod' => $umowa_klient->Dowod
                , 'Mail' => $umowa_klient_kontakt->Mail
                , 'Telefon' => $umowa_klient_kontakt->Telefon
                , 'NazwaUS' => $urzad_skarbowy->Nazwa
                , 'UlicaUS' => $adres_us_tmp->Ulica
                , 'NrDomuUS' => $adres_us_tmp->NrDomu
                , 'NrMieszkaniaUS' => $adres_us_tmp->NrMieszkania
                , 'KodPocztowyUS' => $adres_us_tmp->KodPocztowy
                , 'MiastoUS' => $miasto_us_tmp->Wartosc
                , 'WielkoscUdzialu' => $lista_wlascicieli->WielkoscUdzialu
                );
            } else {
                $zmienne_pdf['klient_' . $i] = array(
                    'Imie' => ''
                , 'Nazwisko' => ''
                , 'Nazwa' => ''
                , 'Id' => ''
                , 'Nip' => ''
                , 'Krs' => ''
                , 'DataUrodzenia' => ''
                , 'Ulica' => ''
                , 'NrDomu' => ''
                , 'NrMieszkania' => ''
                , 'KodPocztowy' => ''
                , 'Miasto' => ''
                , 'Pesel' => ''
                , 'Dowod' => ''
                , 'Mail' => ''
                , 'Telefon' => ''
                , 'NazwaUS' => ''
                , 'UlicaUS' => ''
                , 'NrDomuUS' => ''
                , 'NrMieszkaniaUS' => ''
                , 'KodPocztowyUS' => ''
                , 'MiastoUS' => ''
                , 'WielkoscUdzialu' => ''
                );
            }
            $zmienne_pdf['klient_'.$i] = json_encode($zmienne_pdf['klient_'.$i]);
        }


        for ($i=1; $i<=$liczba_wlascicieli; $i++) {

            $lista_pelnomocnikow = $bazaDanych->pobierzDane('OsobaId, UrzadSkarbowyId, WielkoscUdzialu','umowaRzeczowaOsoba','RzeczowaId = '.$element_id[2].' AND NrOsoby = '.$i.' AND OsobaTypId=5');

            if($lista_pelnomocnikow) {
                $lista_pelnomocnikow = $lista_pelnomocnikow->fetch_object();
                $umowa_pelnomocnik = $bazaDanych->pobierzDane('*', 'umowaOsoba', 'Id = ' . $lista_pelnomocnikow->OsobaId);
                $umowa_pelnomocnik = $umowa_pelnomocnik->fetch_object();
                $umowa_pelnomocnik_adres = $bazaDanych->pobierzDane('*', 'umowaAdres', 'Id = ' . $umowa_pelnomocnik->AdresId);
                $umowa_pelnomocnik_adres = $umowa_pelnomocnik_adres->fetch_object();
                $umowa_pelnomocnik_adres_miasto = $bazaDanych->pobierzDane('*', 'umowaAdresMiasto', 'Id = ' . $umowa_pelnomocnik_adres->MiastoId);
                $umowa_pelnomocnik_adres_miasto = $umowa_pelnomocnik_adres_miasto->fetch_object();
                $umowa_pelnomocnik_kontakt = $bazaDanych->pobierzDane('*', 'umowaKontakt', 'Id = ' . $umowa_pelnomocnik->KontaktId);
                $umowa_pelnomocnik_kontakt = $umowa_pelnomocnik_kontakt->fetch_object();

                $urzad_skarbowy = $bazaDanych->pobierzDane('*', 'umowaUrzadSkarbowy', 'Id = ' . $lista_pelnomocnikow->UrzadSkarbowyId);


                if ($urzad_skarbowy) {
                    $urzad_skarbowy = $urzad_skarbowy->fetch_object();

                    $adres_us_tmp = $bazaDanych->pobierzDane('*', 'umowaAdres', 'Id = ' . $urzad_skarbowy->AdresId);
                    $adres_us_tmp = $adres_us_tmp->fetch_object();

                    $miasto_us_tmp = $bazaDanych->pobierzDane('*', 'umowaAdresMiasto', 'Id = ' . $adres_us_tmp->MiastoId);
                    $miasto_us_tmp = $miasto_us_tmp->fetch_object();
                }

                $zmienne_pdf['pelnomocnik_' . $i] = array(
                    'Imie' => $umowa_pelnomocnik->Imie
                , 'Nazwisko' => $umowa_pelnomocnik->Nazwisko
                , 'Nazwa' => $umowa_pelnomocnik->Nazwa
                , 'Id' => $umowa_pelnomocnik->Id
                , 'Nip' => $umowa_pelnomocnik->Nip
                , 'Krs' => $umowa_pelnomocnik->Krs
                , 'DataUrodzenia' => $umowa_pelnomocnik->DataUrodzenia
                , 'Ulica' => $umowa_pelnomocnik_adres->Ulica
                , 'NrDomu' => $umowa_pelnomocnik_adres->NrDomu
                , 'NrMieszkania' => $umowa_pelnomocnik_adres->NrMieszkania
                , 'KodPocztowy' => $umowa_pelnomocnik_adres->KodPocztowy
                , 'Miasto' => $umowa_pelnomocnik_adres_miasto->Wartosc
                , 'Pesel' => $umowa_pelnomocnik->Pesel
                , 'Dowod' => $umowa_pelnomocnik->Dowod
                , 'Mail' => $umowa_pelnomocnik_kontakt->Mail
                , 'Telefon' => $umowa_pelnomocnik_kontakt->Telefon
                , 'NazwaUS' => $urzad_skarbowy->Nazwa
                , 'UlicaUS' => $adres_us_tmp->Ulica
                , 'NrDomuUS' => $adres_us_tmp->NrDomu
                , 'NrMieszkaniaUS' => $adres_us_tmp->NrMieszkania
                , 'KodPocztowyUS' => $adres_us_tmp->KodPocztowy
                , 'MiastoUS' => $miasto_us_tmp->Wartosc
                , 'WielkoscUdzialu' => $lista_pelnomocnikow->WielkoscUdzialu
                );
            } else {
                $zmienne_pdf['pelnomocnik_' . $i] = array(
                    'Imie' => ''
                , 'Nazwisko' => ''
                , 'Nazwa' => ''
                , 'Id' => ''
                , 'Nip' => ''
                , 'Krs' => ''
                , 'DataUrodzenia' => ''
                , 'Ulica' => ''
                , 'NrDomu' => ''
                , 'NrMieszkania' => ''
                , 'KodPocztowy' => ''
                , 'Miasto' => ''
                , 'Pesel' => ''
                , 'Dowod' => ''
                , 'Mail' => ''
                , 'Telefon' => ''
                , 'NazwaUS' => ''
                , 'UlicaUS' => ''
                , 'NrDomuUS' => ''
                , 'NrMieszkaniaUS' => ''
                , 'KodPocztowyUS' => ''
                , 'MiastoUS' => ''
                , 'WielkoscUdzialu' => ''
                );
            }

            $zmienne_pdf['pelnomocnik_'.$i] = json_encode($zmienne_pdf['pelnomocnik_'.$i]);
        }

        for ($i=1; $i<=$liczba_wlascicieli; $i++) {

            $lista_reprezentantow = $bazaDanych->pobierzDane('OsobaId, UrzadSkarbowyId, WielkoscUdzialu','umowaRzeczowaOsoba','RzeczowaId = '.$element_id[2].' AND NrOsoby = '.$i.' AND OsobaTypId=6');

            if($lista_reprezentantow) {
                $lista_reprezentantow = $lista_reprezentantow->fetch_object();
                $umowa_reprezentant = $bazaDanych->pobierzDane('*', 'umowaOsoba', 'Id = ' . $lista_reprezentantow->OsobaId);
                $umowa_reprezentant = $umowa_reprezentant->fetch_object();
                $umowa_reprezentant_adres = $bazaDanych->pobierzDane('*', 'umowaAdres', 'Id = ' . $umowa_reprezentant->AdresId);
                $umowa_reprezentant_adres = $umowa_reprezentant_adres->fetch_object();
                $umowa_reprezentant_adres_miasto = $bazaDanych->pobierzDane('*', 'umowaAdresMiasto', 'Id = ' . $umowa_reprezentant_adres->MiastoId);
                $umowa_reprezentant_adres_miasto = $umowa_reprezentant_adres_miasto->fetch_object();
                $umowa_reprezentant_kontakt = $bazaDanych->pobierzDane('*', 'umowaKontakt', 'Id = ' . $umowa_reprezentant->KontaktId);
                $umowa_reprezentant_kontakt = $umowa_reprezentant_kontakt->fetch_object();

                $urzad_skarbowy = $bazaDanych->pobierzDane('*', 'umowaUrzadSkarbowy', 'Id = ' . $lista_reprezentantow->UrzadSkarbowyId);


                if ($urzad_skarbowy) {
                    $urzad_skarbowy = $urzad_skarbowy->fetch_object();

                    $adres_us_tmp = $bazaDanych->pobierzDane('*', 'umowaAdres', 'Id = ' . $urzad_skarbowy->AdresId);
                    $adres_us_tmp = $adres_us_tmp->fetch_object();

                    $miasto_us_tmp = $bazaDanych->pobierzDane('*', 'umowaAdresMiasto', 'Id = ' . $adres_us_tmp->MiastoId);
                    $miasto_us_tmp = $miasto_us_tmp->fetch_object();
                }

                $zmienne_pdf['reprezentant_' . $i] = array(
                    'Imie' => $umowa_reprezentant->Imie
                , 'Nazwisko' => $umowa_reprezentant->Nazwisko
                , 'Nazwa' => $umowa_reprezentant->Nazwa
                , 'Id' => $umowa_reprezentant->Id
                , 'Nip' => $umowa_reprezentant->Nip
                , 'Krs' => $umowa_reprezentant->Krs
                , 'DataUrodzenia' => $umowa_reprezentant->DataUrodzenia
                , 'Ulica' => $umowa_reprezentant_adres->Ulica
                , 'NrDomu' => $umowa_reprezentant_adres->NrDomu
                , 'NrMieszkania' => $umowa_reprezentant_adres->NrMieszkania
                , 'KodPocztowy' => $umowa_reprezentant_adres->KodPocztowy
                , 'Miasto' => $umowa_reprezentant_adres_miasto->Wartosc
                , 'Pesel' => $umowa_reprezentant->Pesel
                , 'Dowod' => $umowa_reprezentant->Dowod
                , 'Mail' => $umowa_reprezentant_kontakt->Mail
                , 'Telefon' => $umowa_reprezentant_kontakt->Telefon
                , 'NazwaUS' => $urzad_skarbowy->Nazwa
                , 'UlicaUS' => $adres_us_tmp->Ulica
                , 'NrDomuUS' => $adres_us_tmp->NrDomu
                , 'NrMieszkaniaUS' => $adres_us_tmp->NrMieszkania
                , 'KodPocztowyUS' => $adres_us_tmp->KodPocztowy
                , 'MiastoUS' => $miasto_us_tmp->Wartosc
                , 'WielkoscUdzialu' => $lista_reprezentant->WielkoscUdzialu
                );
            } else {
                $zmienne_pdf['reprezentant_' . $i] = array(
                    'Imie' => ''
                , 'Nazwisko' => ''
                , 'Nazwa' => ''
                , 'Id' => ''
                , 'Nip' => ''
                , 'Krs' => ''
                , 'DataUrodzenia' => ''
                , 'Ulica' => ''
                , 'NrDomu' => ''
                , 'NrMieszkania' => ''
                , 'KodPocztowy' => ''
                , 'Miasto' => ''
                , 'Pesel' => ''
                , 'Dowod' => ''
                , 'Mail' => ''
                , 'Telefon' => ''
                , 'NazwaUS' => ''
                , 'UlicaUS' => ''
                , 'NrDomuUS' => ''
                , 'NrMieszkaniaUS' => ''
                , 'KodPocztowyUS' => ''
                , 'MiastoUS' => ''
                , 'WielkoscUdzialu' => ''
                );
            }

            $zmienne_pdf['reprezentant_'.$i] = json_encode($zmienne_pdf['reprezentant_'.$i]);
        }

        $tytulOgraniczenia = $bazaDanych->pobierzDane('*','umowaSlownikTytulOgraniczenia','Id = '.$umowaRzeczowa->TytulOgraniczeniaId);

        if($tytulOgraniczenia) {
            $tytulOgraniczenia = $tytulOgraniczenia->fetch_object();
        }


        $zmienne_pdf['umowa_dane'] = array(
            'Marka' => $umowa_pojazd->Marka
        ,'Model' => $umowa_pojazd->Model
        ,'NrRejestracyjny' => $umowa_pojazd->NrRejestracyjny
        ,'UmowaTypKlientaId' => $umowaRzeczowa->UmowaTypKlientaId
        ,'UbezpieczycielNazwa' => $umowa_ubezpieczyciel->Nazwa
        ,'UbezpieczycielUlica' => $umowa_ubezpieczyciel_adres->Ulica
        ,'UbezpieczycielNrDomu' => $umowa_ubezpieczyciel_adres->NrDomu
        ,'UbezpieczycielNrMieszkania' => $umowa_ubezpieczyciel_adres->NrMieszkania
        ,'UbezpieczycielKodPocztowy' => $umowa_ubezpieczyciel_adres->KodPocztowy
        ,'UbezpieczycielMiasto' => $umowa_ubezpieczyciel_adres_miasto->Wartosc
        ,'DataSzkody' => $umowaRzeczowa->DataSzkody
        ,'NumerAkt' => $umowaRzeczowa->NumerAkt
        ,'NazwaUbezpieczyciela' => $umowaRzeczowa->NazwaUbezpieczyciela
        ,'DataUmowyPrzelewu' => $umowaRzeczowa->DataUmowyPrzelewu
        ,'NumerSprawy' => $umowaRzeczowa->NumerSprawy
        ,'OtrzymanaKwotaWierzytelności' => $umowaRzeczowa->OtrzymanaKwotaWierzytelności
        ,'OtrzymanaKwotaWierzytelnościSlownie' => slownie(intval($umowaRzeczowa->OtrzymanaKwotaWierzytelności))
        ,'UzyskanoOdszkodowanie' => $umowaRzeczowa->UzyskanoOdszkodowanie
        ,'KwotaOdszkodowania' => $umowaRzeczowa->KwotaOdszkodowania
        ,'KwotaOdszkodowaniaSlownie' => slownie(intval($umowaRzeczowa->KwotaOdszkodowania))
        ,'KwotaOdkupienia' => $umowaRzeczowa->KwotaOdkupienia
        ,'OgraniczenieWierzytelnosci' => $umowaRzeczowa->OgraniczenieWierzytelnosci
        ,'TytulOgraniczeniaId' => $umowaRzeczowa->TytulOgraniczeniaId
        ,'TytulOgraniczeniaWartosc' => $tytulOgraniczenia->Wartosc
        , 'ZgodaDaneDSA' => $umowaRzeczowa->ZgodaDaneDSA
        , 'ZgodaInfDSA' => $umowaRzeczowa->ZgodaInfDSA
        , 'ZgodaMarketingDSA' => $umowaRzeczowa->ZgodaMarketingDSA
        , 'ZgodaDaneAutovotum' => $umowaRzeczowa->ZgodaDaneAutovotum
        , 'ZgodaInfVotum' => $umowaRzeczowa->ZgodaInfVotum
        , 'ZgodaMarketingVotum' => $umowaRzeczowa->ZgodaMarketingVotum
        , 'ZgodaDanePCRF' => $umowaRzeczowa->ZgodaDanePCRF
        , 'ZgodaDaneFundacja' => $umowaRzeczowa->ZgodaDaneFundacja
        , 'ZgodaDaneBEP' => $umowaRzeczowa->ZgodaDaneBEP
        );

        $zmienne_pdf['umowa_dane'] = json_encode($zmienne_pdf['umowa_dane']);

        break;

    case 'osobowa':

        $umowaOsobowa = $bazaDanych->pobierzDane('*','umowaOsobowa','Id = '.$element_id[2]);
        $umowaOsobowa = $umowaOsobowa->fetch_object();
		if($umowaOsobowa) {
		$zmienne_pdf['umowa_dane'] = array(
                'RodzajSzkodyId' => $umowaOsobowa->RodzajSzkodyId
            , 'TypSzkodyId' => $umowaOsobowa->TypSzkodyId
            , 'TypZdarzeniaId' => $umowaOsobowa->TypZdarzeniaId
            , 'ZgodaDaneDSA' => $umowaOsobowa->ZgodaDaneDSA
            , 'ZgodaDaneProtecta' => $umowaOsobowa->ZgodaDaneProtecta
            , 'ZgodaInfDSA' => $umowaOsobowa->ZgodaInfDSA
            , 'ZgodaMarketingDSA' => $umowaOsobowa->ZgodaMarketingDSA
            , 'ZgodaInfVotum' => $umowaOsobowa->ZgodaInfVotum
            , 'ZgodaMarketingVotum' => $umowaOsobowa->ZgodaMarketingVotum
            , 'ZgodaDanePCRF' => $umowaOsobowa->ZgodaDanePCRF
            , 'ZgodaDaneFundacja' => $umowaOsobowa->ZgodaDaneFundacja
            , 'ZgodaDaneAutovotum' => $umowaOsobowa->ZgodaDaneAutovotum
            , 'ZgodaDaneBEP' => $umowaOsobowa->ZgodaDaneBEP
            , 'ProcentWynagrodzenia' => $umowaOsobowa->ProcentWynagrodzenia
            , 'ProcentWynagrodzeniaSlownie' => slownie(intval($umowaOsobowa->ProcentWynagrodzenia))
            , 'UpowaznienieKAIRP' => $umowaOsobowa -> UpowaznienieKAIRP
            );
            $zmienne_pdf['umowa_dane'] = json_encode($zmienne_pdf['umowa_dane']);
		}
		
        $umowaZdarzenie = $bazaDanych->pobierzDane('Data','umowaZdarzenie','Id = '.$umowaOsobowa->ZdarzenieId);

        if($umowaZdarzenie) {
            $umowaZdarzenie = $umowaZdarzenie->fetch_object();          

            $zmienne_pdf['pozostale_informacje'] = array(
                'DataZdarzenia' => $umowaZdarzenie->Data
            , 'RodzajUprawnionego' => $umowaOsobowa->UmowaRodzajUprawnionegoId
            );
            $zmienne_pdf['pozostale_informacje'] = json_encode($zmienne_pdf['pozostale_informacje']);
        }

        $dochodzenieRoszczen = $bazaDanych->pobierzDane('*','umowaDochodzenieRoszczen','Id = '.$umowaOsobowa->DochodzenieRoszczenId);

        if ($dochodzenieRoszczen) {
            $dochodzenieRoszczen = $dochodzenieRoszczen->fetch_object();

            $zmienne_pdf['dochodzenie_roszczen'] = array(
                'ZleconoRoszczenia' => $dochodzenieRoszczen->ZleconoRoszczenia
            , 'NazwaPelnomocnika' => $dochodzenieRoszczen->NazwaPelnomocnika
            , 'DataZawarciaUmowy' => $dochodzenieRoszczen->DataZawarciaUmowy
            , 'WypowiedzenieUmowy' => $dochodzenieRoszczen->WypowiedzenieUmowy
            , 'DataWypowiedzenia' => $dochodzenieRoszczen->DataWypowiedzenia
            );
            $zmienne_pdf['dochodzenie_roszczen'] = json_encode($zmienne_pdf['dochodzenie_roszczen']);
        }

        $wynagrodzenie_numer = '';
        $wynagrodzenie_odbiorca_id = $umowaOsobowa->OdbiorcaId;
        if(!empty($umowaOsobowa->SposobPlatnosciId)){
            if($umowaOsobowa->SposobPlatnosciId == 2){
                $wynagrodzenie_tmp = $bazaDanych->pobierzDane('*','umowaRachunekBankowy','Id = '.$umowaOsobowa->RachunekBankowyId);
                $wynagrodzenie_tmp = $wynagrodzenie_tmp->fetch_object();

                $wynagrodzenie_numer = $wynagrodzenie_tmp->Numer;
                $wynagrodzenie_odbiorca_id = $wynagrodzenie_tmp->OsobaId;
            }

            if(!empty($wynagrodzenie_odbiorca_id)){
                $wynagrodzenie_odbiorca = $bazaDanych->pobierzDane('*','umowaOsoba','Id = '.$wynagrodzenie_odbiorca_id);
                $wynagrodzenie_odbiorca = $wynagrodzenie_odbiorca->fetch_object();


                $zmienne_pdf['wynagrodzenie'] = array(
                    'SposobPlatnosciId' => $umowaOsobowa->SposobPlatnosciId
                ,'IdOdbiorcy' => $wynagrodzenie_odbiorca->Id
                ,'WynagrodzenieNumer' => $wynagrodzenie_numer
                ,'WynagrodzenieImie' => $wynagrodzenie_odbiorca->Imie
                ,'WynagrodzenieNazwisko' => $wynagrodzenie_odbiorca->Nazwisko
                );
                $zmienne_pdf['wynagrodzenie'] = json_encode($zmienne_pdf['wynagrodzenie']);

            }

        }

        $umowa_uprawniony = $bazaDanych->pobierzDane('*','umowaOsoba','Id = '.$umowaOsobowa->OsobaUprawnionyId);

        if($umowa_uprawniony) {
            $umowa_uprawniony = $umowa_uprawniony->fetch_object();
            $umowa_uprawniony_adres = $bazaDanych->pobierzDane('*', 'umowaAdres', 'Id = ' . $umowa_uprawniony->AdresId);
            $umowa_uprawniony_adres = $umowa_uprawniony_adres->fetch_object();
            $umowa_uprawniony_adres_miasto = $bazaDanych->pobierzDane('*', 'umowaAdresMiasto', 'Id = ' . $umowa_uprawniony_adres->MiastoId);
            $umowa_uprawniony_adres_miasto = $umowa_uprawniony_adres_miasto->fetch_object();
            $umowa_uprawniony_kontakt = $bazaDanych->pobierzDane('*', 'umowaKontakt', 'Id = ' . $umowa_uprawniony->KontaktId);
            $umowa_uprawniony_kontakt = $umowa_uprawniony_kontakt->fetch_object();

            $zmienne_pdf['uprawniony'] = array(
                'Imie' => $umowa_uprawniony->Imie
            , 'Nazwisko' => $umowa_uprawniony->Nazwisko
            , 'Ulica' => $umowa_uprawniony_adres->Ulica
            , 'NrDomu' => $umowa_uprawniony_adres->NrDomu
            , 'NrMieszkania' => $umowa_uprawniony_adres->NrMieszkania
            , 'KodPocztowy' => $umowa_uprawniony_adres->KodPocztowy
            , 'Miasto' => $umowa_uprawniony_adres_miasto->Wartosc
            , 'Pesel' => $umowa_uprawniony->Pesel
            , 'Dowod' => $umowa_uprawniony->Dowod
            , 'Mail' => $umowa_uprawniony_kontakt->Mail
            , 'Telefon' => $umowa_uprawniony_kontakt->Telefon
            );
            $zmienne_pdf['uprawniony'] = json_encode($zmienne_pdf['uprawniony']);
        }

        break;
}

$adres_http_umowy = 'https://' . $_SERVER ['HTTP_HOST'] . '/moduly/druki/wzory_dokumentow/'.$droga.'/'.$nazwa_druku.'';

require_once($_SERVER ['DOCUMENT_ROOT'] . 'biblioteki/generator_pdf/vendor/autoload.php');
use mikehaertl\wkhtmlto\Pdf;

$opcje = array (
    'encoding' => 'UTF-8',
    'post' => $zmienne_pdf
);
$pdf = new Pdf ( array (
    'commandOptions' => array (
        'enableXvfb' => true,
        'xvfbRunBinary' => 'exec xvfb-run'
    )
) );

$pdf->setOptions ( $opcje );
$pdf->addPage ( $adres_http_umowy );

if (! file_exists ( '/var/www/pliki/!druki/' . $element_id[0] )) {
    mkdir ( '/var/www/pliki/!druki/' . $element_id[0], 0777 );
}

//$nazwa_pliku = date('U').'_'.$nazwa_druku;
$nazwa_pliku = $element_id[0].'_'.$nazwa_druku;

if (! $pdf->saveAs ( '/var/www/pliki/!druki/' . $element_id[0] . '/'.$nazwa_pliku.'.pdf' )) {
    $komunikat = $pdf->getError();
}

$drukiaMain->dodajWpisDoHistorii($bazaDanych, $element_id[0], 'umowa_id', 'Wygenerowanie '.$nazwa_druku, '', $nazwa_pliku, 'umowa_historia_zmian');


$komunikat = 'Wygenerowano poprawnie dokument!!!';
$rodzajOut = 'sukces';

$dane = array(
    'rodzaj' => $rodzajOut
,'komunikat' => $komunikat
,'element_id' => $element_id[0]
,'nazwa_pliku' => $nazwa_pliku

);

echo json_encode($dane);
return;
