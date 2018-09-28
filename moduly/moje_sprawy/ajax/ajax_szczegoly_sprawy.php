<?php
if (! isset ( $_SERVER ['HTTP_REFERER'] )) {
	session_start ();
	session_destroy ();
	header ( 'Location: https://' . $_SERVER ['HTTP_HOST'] );
	die ();
}

session_start ();
require_once ($_SERVER ['DOCUMENT_ROOT'] . 'moduly/moje_sprawy/db/funkcje_db.php');
require_once ($_SERVER ['DOCUMENT_ROOT'] . 'konfiguracja/konfiguracja_Main.php');

$id_sprawy = htmlspecialchars($_POST['id_sprawy']);

//$id_uzytkownika = 'A011068';

//$id_uzytkownika = $uzytkownik ['login'];



$szczegoly_spraw = pobierz_szczegoly_sprawy ( $id_sprawy );
$komentarze_do_spraw = pobierz_komentarze_do_spraw ( $id_sprawy );

while ( $wiersz = mssql_fetch_array ( $szczegoly_spraw ) ) {
	
	$numer_sprawy = iconv ( "cp1250", "UTF-8", $wiersz ['CaseNumber'] );
    $status = iconv ( "cp1250", "UTF-8", $wiersz ['CaseState'] );
    $nazwisko_klienta = iconv ( "cp1250", "UTF-8", $wiersz ['ClientSurname'] );
    $imie_klienta = iconv ( "cp1250", "UTF-8", $wiersz ['ClientName'] );
    $nazwisko_poszkodowanego = iconv ( "cp1250", "UTF-8", $wiersz ['VictimSurname'] );
    $imie_poszkodowanego = iconv ( "cp1250", "UTF-8", $wiersz ['VictimName'] );
    $data_rejestracji = iconv ( "cp1250", "UTF-8", $wiersz ['CaseRegisterDate'] );
    $etap_sprawy = iconv ( "cp1250", "UTF-8", $wiersz ['CaseStage'] );
    $etap = iconv ( "cp1250", "UTF-8", $wiersz ['ChanceryStage'] );
    $obslugujacy = iconv ( "cp1250", "UTF-8", $wiersz ['CaseUser'] );
    $email_obslugujacego = iconv ( "cp1250", "UTF-8", $wiersz ['CaseUserMail'] );
    $wartosc_sprawy = number_format(iconv ( "cp1250", "UTF-8", $wiersz ['CaseValueSubmit'] ), 2, ',', ' ');
    $data_roszczenia = iconv ( "cp1250", "UTF-8", $wiersz ['CaseClaimDate'] );
    $wycena = iconv ( "cp1250", "UTF-8", $wiersz ['CaseCasueValuation'] );
    $data_archiwum = iconv ( "cp1250", "UTF-8", $wiersz ['ArchiveDate'] );
    $powod_przniesienia = iconv ( "cp1250", "UTF-8", $wiersz ['ArchiveEeason'] );
    $numer_agenta = iconv ( "cp1250", "UTF-8", $wiersz ['AgentNumber'] );
    $nazwa_agenta = iconv ( "cp1250", "UTF-8", $wiersz ['AgentName'] );
    $numer_kierownika = iconv ( "cp1250", "UTF-8", $wiersz ['ManagerNumber'] );
    $nazwa_kierownika = iconv ( "cp1250", "UTF-8", $wiersz ['ManagerName'] );
    $numer_dyrektora = iconv ( "cp1250", "UTF-8", $wiersz ['DirectorNumber'] );
    $nazwa_dyrektora = iconv ( "cp1250", "UTF-8", $wiersz ['DirectorName'] );
    $grupa_spraw = iconv ( "cp1250", "UTF-8", $wiersz ['CaseGroup'] );
    $email_prawnika = iconv ( "cp1250", "UTF-8", $wiersz ['CaseLawyerMail'] );
    $powod_odrzucenia = iconv ( "cp1250", "UTF-8", $wiersz ['RejectionReason'] );
    $jednostka = iconv ( "cp1250", "UTF-8", $wiersz ['UnitNumber'] );
    $honorarium = iconv ( "cp1250", "UTF-8", $wiersz ['Honorarium'] ).' %';

    $komentarze_tab = array();

    while ( $wiersz_kom = mssql_fetch_array ( $komentarze_do_spraw ) ) {
        $data = iconv ( 'cp1250', 'UTF-8', $wiersz_kom ['Data'] );
        $komentarz = iconv ( "cp1250", "UTF-8", $wiersz_kom ['Komentarz'] );

        $komentarze_tab[] = '<div class="data_wiersz">'.date('Y-m-d H:i ', strtotime($data)).'</div>- '.$komentarz . '</br>';
    }

    $kom_as_string = implode($komentarze_tab);

    $prawnik = iconv ( "cp1250", "UTF-8", $wiersz ['CaseLawyer'] );
    $data_pozwu = iconv ( "cp1250", "UTF-8", $wiersz ['LawsuitDate'] );
    $wps = iconv ( "cp1250", "UTF-8", $wiersz ['WPS'] );

}

$dane = "<div class='dane_sprawy'>"
    ."<table id='szczegoly_spraw'>"
    ."<tr>"
            ."<td class='nazwa_kolumny'>Status sprawy:</td><td class='wartosc_kolumny'>".$status."</td>"
            ."<td class='nazwa_kolumny'>Numer agenta:</td><td class='wartosc_kolumny'>".$numer_agenta."</td></tr>"
    ."<tr>"
            ."<td class='nazwa_kolumny'>Nazwisko i imię klienta:</td><td class='wartosc_kolumny'>".$nazwisko_klienta." ".$imie_klienta."</td>"
            ."<td class='nazwa_kolumny'>Nazwisko i imię agenta:</td><td class='wartosc_kolumny'>".$nazwa_agenta."</td></tr>"
    ."<tr>"
            ."<td class='nazwa_kolumny'>Nazwisko i imię poszkodowanego:</td><td class='wartosc_kolumny'>".$nazwisko_poszkodowanego." ".$imie_poszkodowanego."</td>"
            ."<td class='nazwa_kolumny'>Numer kierownika:</td><td class='wartosc_kolumny'>".$numer_kierownika."</td></tr>"
    ."<tr>"
            ."<td class='nazwa_kolumny'>Data rejestracji sprawy:</td><td class='wartosc_kolumny'>".$data_rejestracji."</td><td class='nazwa_kolumny'>Nazwisko i imię kierownika:</td>"
            ."<td class='wartosc_kolumny'>".$nazwa_kierownika."</td></tr>"
    ."<tr>"
            ."<td class='nazwa_kolumny'>Etap sprawy:</td><td class='wartosc_kolumny'>".$etap_sprawy."</td>"
            ."<td class='nazwa_kolumny'>Numer dyrektora:</td><td class='wartosc_kolumny'>".$numer_dyrektora."</td></tr>"
    ."<tr>"
            ."<td class='nazwa_kolumny'>Honorarium:</td><td class='wartosc_kolumny'>".$honorarium."</td>"

            ."<td class='nazwa_kolumny'>Nazwisko i imię dyrektora:</td><td class='wartosc_kolumny'>".$nazwa_dyrektora."</td></tr>"
    ."<tr>"
            ."<td class='nazwa_kolumny'>Wartośc sprawy:</td><td class='wartosc_kolumny'>".$wartosc_sprawy."</td>"
            ."<td class='nazwa_kolumny'>Jednostka:</td><td class='wartosc_kolumny'>".$jednostka."</td></tr>"
    ."<tr>"
            ."<td class='nazwa_kolumny'>Data roszczenia:</td><td class='wartosc_kolumny'>".$data_roszczenia."</td>"
            ."<td class='nazwa_kolumny'>Obsługujący:</td><td class='wartosc_kolumny'>".$obslugujacy."</td></tr>"
    ."<tr>"
            ."<td class='nazwa_kolumny'>Wycena:</td><td class='wartosc_kolumny'>".$wycena."</td>"
            ."<td class='nazwa_kolumny'>E-mail obsługującego:</td><td class='wartosc_kolumny'><a href=mailto:".$email_obslugujacego." target='_blank'>".$email_obslugujacego."</a></td></tr>"
    ."<tr>"
            ."<td class='nazwa_kolumny'>WPS:</td><td class='wartosc_kolumny'>".$wps."</td>"
            ."<td class='nazwa_kolumny'>Prawnik:</td><td class='wartosc_kolumny'>".$prawnik."</td></tr>"
    ."<tr>"

            ."<td class='nazwa_kolumny'>Data pozwu:</td><td class='wartosc_kolumny'>".$data_pozwu."</td>"
            ."<td class='nazwa_kolumny'>E-mail prawnika:</td><td class='wartosc_kolumny'><a href=mailto:".$email_prawnika." target='_blank'>".$email_prawnika."</a></td></tr>"
    ."<tr>"
            ."<td class='nazwa_kolumny'>Etap kancelarii:</td><td colspan='3' class='wartosc_kolumny'>".$etap."</td></tr>"
    ."<tr>"
            ."<td class='nazwa_kolumny'>Data archiwum:</td><td>".$data_archiwum."</td>"
            ."<td class='nazwa_kolumny'>Grupa spraw:</td><td>".$grupa_spraw."</td></tr>"

    ."<tr>"
            ."<td class='nazwa_kolumny'>Powód przeniesienia:</td><td colspan='3'>".$powod_przniesienia."</td></tr>"
    ."<tr>"
            ."<td class='nazwa_kolumny'>Powód odrzucenia:</td><td colspan='3'>".$powod_odrzucenia."</td></tr>"
    ."<tr>"
            ."<td class='nazwa_kolumny'>Komentarze:</td><td colspan='3'>".$kom_as_string."</td></tr>"
    ."</table>"
    ."<div>"
    ."<div class=\"conversation-add-comment\">"
        ."<div class=\"row\">"
            ."<div class=\"col-12\">"
            ."<label for=\"simple-input\" class=\"no-style-label\">Rozpocznij rozmowę dotyczącą sprawy</label>"
            ."</div>"
            ."<input name='case_number' id='caseNumber' type='hidden' value=$numer_sprawy />"
            ."<input type='hidden' id='agentNumber' value=". $_SESSION['uzytkownik_login'] .">"
//            ."<div class=\"col-12\">"
//                ."<input type=\"text\" name='title' id='conversationTitle' class='form-control left k-textbox' placeholder='Wpisz tytuł'/>"
//            ."</div>"

            ."<div class=\"col\">"
        ."<textarea id=\"conversationMsg\" name=\"content\" type=\"text\" class=\"k-textbox left form-control\" placeholder=\"Wpisz treść wiadomości\" style=\"height: 150px\" required></textarea></div>"
        ."</input>"
        ."<div class=\"row\">"
            ."<div class=\"col-xs-12 text-right\">"
                ."<div id=\"form2Error\" class='col-xs-8'></div>"
                ."<div id=\"form2Success\" class='col-xs-7'></div>"
                ."<span class=\"appendConversation1 form-button\" style=\"margin-top: 20px; margin-right: 0\">Wyślij</span>"
            ."</div>"
        ."</div>"

    ."</div>"
    ."</div>"
    ."</div>"
    ."<div class='tabelka_wrapper'>"
        ."<div class='tabelka_wrapper'>"
                ."<div class='text-left form-group'>"
                    ."<button class='btn btn-default' id='addFilesBtnCase'>Dodaj pliki</button>"
                ."</div>"
                ."<div class=\"k-content\" style=''>"
                    ."<div class=\"row \">"
                        ."<div class=\"col-xs-12 col-sm-12 col-md-12 col-lg-12 hide form-group\" id='doc-add-btn-label'>Wybierz rodzaj dokumentu:</div>"
                    ."</div>"
                    ."<div class=\"row\">"
                        ."<div class=\"col-xs-12 col-sm-12 col-md-12 col-lg-12 hide form-group\" id='doc-types-add-row'>"
                            ."<input id=\"doc-types\" style='width: 100%'/>"
                            ."<input type='hidden' name='type_id' id='selected-doc-type'/>"
                            ."<input type='hidden' name='type_text' id='selected-doc-type-text'/>"
                            ."<input type='hidden' name='case_id' id='current_case_id' value='$id_sprawy'/>"
                            .'<input type="hidden" name="numer_agenta" id="current_agent_number" value="'.$_SESSION['uzytkownik_login'].'">'
                        ."</div>"
                    ."</div>"
                    ."<div class=\"row \">"
                        ."<div class=\"col-xs-12 col-sm-12 col-md-12 col-lg-12 hide form-group\" id='case-files-div'>"
                            ."<input id=\"case-files\" type=\"file\" name=\"files\"/>"
                        ."</div>"
                    ."</div>"
                ."</div>"//k-content
        ."</div>"
        .'<div id="grid-docs"></div>'
    ."</div>"
;

$dane = array(
    0 => $numer_sprawy,
    1 => $dane,
	2 => $id_sprawy
    //3 => $imie_klienta,
    //4 => $nazwisko_poszkodowanego,
    //5 => $imie_poszkodowanego,
    //6 => $data_rejestracji,
    //7 => $etap_sprawy,
    //8 => $etap,
    //9 => $obslugujacy,
    //10 => $email_obslugujacego,
    //11 => $wartosc_sprawy,
    //12 => $data_roszczenia,
    //13 => $wycena,
    //14 => $data_archiwum,
    ///15 => $powod_przniesienia,
    //16 => $numer_agenta,
    //17 => $nazwa_agenta,
    //18 => $numer_kierownika,
    //19 => $nazwa_kierownika,
    //20 => $numer_dyrektora,
    //21 => $nazwa_dyrektora,
    //22 => $jednostka,
    //23 => $honorarium,
    //24 => $kom_as_string,
    //24 => str_replace(",",'.',$komentarze_tab),
    //25 => $prawnik,
    //26 => $data_pozwu,
    //27 => $wps,
    //30 => $id_sprawy
);

//array_push ( $dane [24], $komentarze_tab );

echo json_encode($dane);


?>


