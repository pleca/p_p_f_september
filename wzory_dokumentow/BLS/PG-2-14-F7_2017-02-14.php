<link rel="stylesheet" href="<?php echo 'https://' . $_SERVER ['HTTP_HOST'] . '/wzory_dokumentow/BLS/css/PG-2-14-F7_2017-02-14.css'; ?>" type="text/css" />
<?php
require_once ($_SERVER ['DOCUMENT_ROOT'] . 'wzory_dokumentow/db/funkcje_db.php');

require_once ($_SERVER ['DOCUMENT_ROOT'] . 'moduly/sprawy/db/funkcje_db.php');

require_once ($_SERVER ['DOCUMENT_ROOT'] . 'funkcje_glowne.php');

$uzytkownik_id = $_POST ['uzytkownik_id'];
$id_sprawy = $_POST ['id_sprawy'];
$id_umowy = $_POST ['id_umowy'];

(isset ( $_POST ['id_sprawy'] )) ? $id_sprawy = $_POST ['id_sprawy'] : $id_sprawy = $_GET ['id_sprawy'];
(isset ( $_POST ['uzytkownik_id'] )) ? $uzytkownik_id = $_POST ['uzytkownik_id'] : $uzytkownik_id = $_GET ['uzytkownik_id'];
(isset ( $_POST ['id_umowy'] )) ? $id_umowy = $_POST ['id_umowy'] : $id_umowy = $_GET ['id_umowy'];
(isset ( $_POST ['potwierdzenie'] )) ? $potwierdzenie = $_POST ['potwierdzenie'] : $potwierdzenie = $_GET ['potwierdzenie'];

$dane_uzytkownika = uzytkownik_pobierz_po_id ( $uzytkownik_id );
$identyfikator_przedstawiciela = $dane_uzytkownika ['login'];


$numer_stopka = 'PG-2-14-F7/2017-02-14';


if ($potwierdzenie == '1') {
	$znak_wodny = '<div class="uo_strona_znak_wodny">POTWIERDZENIE ZAMÓWIENIA</div>';
}

?>

<!--STRONA PIERWSZA-->

    <div class="strona">
        <div class="logo_votum"></div>
        <div class="id_przedstawiciela">A0001234</div>
        <div class="tytul_strony">
            <p>UMOWA</p>
            <p>PRZELEWU WIERZYTELNOŚCI BLS</p>
            <p>NR: ______ / ______ / ______ </p>
        </div>
        <div class="naglowek_umowy">
            <p>zawarta na podstawie oferty z dnia __ - __ - ____ r. pomiędzy:</p>
        </div>
                <div class="formularz_czerwony">
                    <div class="naglowek_formularza_czerwony">
                        <div class="szary"><p>WŁAŚCICIEL</p></div>
                        <div class="czerwony"><p>WSPÓŁWŁAŚCICIEL:</p></div>
                    </div>
                    <div class="clear_b"></div>
                    <div class="pola_formularza_wlasciciel">
                        <div class="element_pole">
                            <p>IMIĘ, NAZWISKO / FIRMA PRZEDSIĘBIORCY</p>
                            <div class="bls_im_naz_zleceniodawcy"></div>
                        </div>
                        <div class="element_pole">
                            <p>ULICA</p>
                            <div class="bls_ulica_zleceniodawcy"></div>
                        </div>
                        <div class="element_pole margin_l_20">
                            <p>NR DOMU</p>
                            <div class="bls_nr_domu_zleceniodawcy"></div>
                        </div>
                        <div class="element_pole margin_l_20">
                            <p>NR LOKALU</p>
                            <div class="bls_nr_lokalu_zleceniodawcy"></div>
                        </div>
                        <div class="element_pole margin_l_20">
                            <p>KOD POCZTOWY</p>
                            <div class="bls_kod_pocztowy_zleceniodawcy"></div>
                        </div>
                        <div class="element_pole margin_l_20">
                            <p>MIEJSCOWOŚĆ</p>
                            <div class="bls_miejscowosc_zleceniodawcy"></div>
                        </div>
                        <div class="element_pole">
                            <p>SERIA I NR DOKUMENTU</p>
                            <div class="bls_dokument_zleceniodawcy"></div>
                        </div>
                        <div class="element_pole margin_l_20">
                            <p>NUMER PESEL</p>
                            <div class="bls_pesel_zleceniodawcy"></div>
                        </div>
                        <div class="element_pole margin_l_20">
                            <p>NIP (*WYPEŁNIĆ TYLKO DLA PRZEDSIĘBIORSTWA)</p>
                            <div class="bls_nip_zleceniodawcy"></div>
                        </div>
                        <div class="element_pole margin_l_20">
                            <p>KRD/EDG</p>
                            <div class="bls_krd_zleceniodawcy"></div>
                        </div>
                        <div class="element_pole">
                            <p>DATA URODZENIA</p>
                            <div class="bls_data_urodzenia_zleceniodawcy"></div>
                        </div>
                        <div class="element_pole margin_l_20">
                            <p>TELEFON KONTAKTOWY</p>
                            <div class="bls_telefon_zleceniodawcy"></div>
                        </div>
                        <div class="element_pole margin_l_20">
                            <p>E-MAIL</p>
                            <div class="bls_e-mail_zleceniodawcy"></div>
                        </div>
                        <div class="clear_b"></div>
                        <div class="sekcja_formularza">
                            <p>URZĄD SKARBOWY* </p>
                            <div class="medium">
                                <p>(*DOTYCZY OSÓB FIZYCZNYCH):</p>
                            </div>
                         </div>
                        <div class="element_pole">
                            <p>PEŁNA NAZWA URZĘDU SKARBOWEGO</p>
                            <div class="bls_us_zleceniodawcy"></div>
                        </div>
                        <div class="element_pole">
                            <p>ULICA</p>
                            <div class="bls_ulica_us_zleceniodawcy"></div>
                        </div>
                        <div class="element_pole margin_l_20">
                            <p>NR DOMU</p>
                            <div class="bls_nr_domu_us_zleceniodawcy"></div>
                        </div>
                        <div class="element_pole margin_l_20">
                            <p>NR LOKALU</p>
                            <div class="bls_nr_lokalu_us_zleceniodawcy"></div>
                        </div>
                        <div class="element_pole margin_l_20">
                            <p>KOD POCZTOWY</p>
                            <div class="bls_kod_pocztowy_us_zleceniodawcy"></div>
                        </div>
                        <div class="element_pole margin_l_20">
                            <p>MIEJSCOWOŚĆ</p>
                            <div class="bls_miejscowosc_us_zleceniodawcy"></div>
                        </div>
                        <div class="element_pole">
                            <p>WIELKOŚĆ UDZIAŁU W WIERZYTELNOŚCI*</p>
                            <div class="bls_udzial_zleceniodawcy"></div>
                        </div>
                        <div class="przypis_poziomy"><p>(*WPISAĆ PROCENTOWO BĄDŹ UŁAMKIEM WIELKOŚĆ UDZIAŁU LUB POŁOWĘ PRAWA PRZYSŁUGUJĄCEGO
                                MAŁŻONKOM W RAMACH MAŁŻEŃSKIEGO MAJĄTKU WSPÓLNEGO)</p></div>
                        <div class="clear_b"></div>
                        <div class="sekcja_formularza"><p>reprezentowany przez</p></div>
                    </div>
                </div>


            <div class="formularz_szary">
                <div class="naglowek_formularza_szary">
                    <div class="szary"><p>REPREZENTANT 1:</p></div>
                </div>
                <div class="clear_b"></div>
                <div class="pola_formularza_reprezentant_1">
                    <div class="element_pole">
                        <p>IMIĘ, NAZWISKO / FIRMA PRZEDSIĘBIORCY</p>
                        <div class="bls_im_naz_zleceniodawcy"></div>
                    </div>
                    <div class="element_pole">
                        <p>ULICA</p>
                        <div class="bls_ulica_zleceniodawcy"></div>
                    </div>
                    <div class="element_pole margin_l_20">
                        <p>NR DOMU</p>
                        <div class="bls_nr_domu_zleceniodawcy"></div>
                    </div>
                    <div class="element_pole margin_l_20">
                        <p>NR LOKALU</p>
                        <div class="bls_nr_lokalu_zleceniodawcy"></div>
                    </div>
                    <div class="element_pole margin_l_20">
                        <p>KOD POCZTOWY</p>
                        <div class="bls_kod_pocztowy_zleceniodawcy"></div>
                    </div>
                    <div class="element_pole margin_l_20">
                        <p>MIEJSCOWOŚĆ</p>
                        <div class="bls_miejscowosc_zleceniodawcy"></div>
                    </div>
                    <div class="element_pole">
                        <p>SERIA I NR DOKUMENTU</p>
                        <div class="bls_dokument_zleceniodawcy"></div>
                    </div>
                    <div class="element_pole margin_l_20">
                        <p>DATA URODZENIA*(*DOTYCZY OSÓB FIZYCZNYCH – WSPÓLNIKÓW SPÓŁKI CYWILNEJ BĄDŹ OSOBOWEJ ZBYWAJĄCEJ WIERZYTELNOŚĆ)</p>
                        <div class="bls_pesel_zleceniodawcy"></div>
                    </div>
                    <div class="clear_b"></div>
                    <div class="sekcja_formularza">
                        <p>URZĄD SKARBOWY* </p>
                        <div class="medium">
                            <p>(*DOTYCZY OSÓB FIZYCZNYCH – WSPÓLNIKÓW SPÓŁKI CYWILNEJ BĄDŹ OSOBOWEJ ZBYWAJĄCEJ WIERZYTELNOŚĆ):</p>
                        </div>
                    </div>
                    <div class="element_pole">
                        <p>PEŁNA NAZWA URZĘDU SKARBOWEGO</p>
                        <div class="bls_us_zleceniodawcy"></div>
                    </div>
                    <div class="element_pole">
                        <p>ULICA</p>
                        <div class="bls_ulica_us_zleceniodawcy"></div>
                    </div>
                    <div class="element_pole margin_l_20">
                        <p>NR DOMU</p>
                        <div class="bls_nr_domu_us_zleceniodawcy"></div>
                    </div>
                    <div class="element_pole margin_l_20">
                        <p>NR LOKALU</p>
                        <div class="bls_nr_lokalu_us_zleceniodawcy"></div>
                    </div>
                    <div class="element_pole margin_l_20">
                        <p>KOD POCZTOWY</p>
                        <div class="bls_kod_pocztowy_us_zleceniodawcy"></div>
                    </div>
                    <div class="element_pole margin_l_20">
                        <p>MIEJSCOWOŚĆ</p>
                        <div class="bls_miejscowosc_us_zleceniodawcy"></div>
                    </div>
                    <div class="element_pole">
                        <p>WIELKOŚĆ UDZIAŁU W ZYSKU Z PRZELEWU WIERZYTELNOŚCI*</p>
                        <div class="bls_udzial_zleceniodawcy"></div>
                    </div>
                    <div class="przypis_poziomy_top"><p>(*WPISAĆ PROCENTOWO BĄDŹ UŁAMKIEM)</p></div>
                </div>
            </div>


            <div class="formularz_szary_obramowanie">
                <div class="naglowek_formularza_szary">
                    <div class="szary"><p>REPREZENTANT 2:</p></div>
                    <div class="czerwony_2"><p>WSPÓŁWŁAŚCICIEL*(*niepotrzebne skreślić)</p></div>
                </div>
                <div class="clear_b"></div>
                <div class="pola_formularza_reprezentant_2">
                    <div class="element_pole">
                        <p>IMIĘ, NAZWISKO / FIRMA PRZEDSIĘBIORCY</p>
                        <div class="bls_im_naz_zleceniodawcy"></div>
                    </div>
                    <div class="element_pole">
                        <p>ULICA</p>
                        <div class="bls_ulica_zleceniodawcy"></div>
                    </div>
                    <div class="element_pole margin_l_20">
                        <p>NR DOMU</p>
                        <div class="bls_nr_domu_zleceniodawcy"></div>
                    </div>
                    <div class="element_pole margin_l_20">
                        <p>NR LOKALU</p>
                        <div class="bls_nr_lokalu_zleceniodawcy"></div>
                    </div>
                    <div class="element_pole margin_l_20">
                        <p>KOD POCZTOWY</p>
                        <div class="bls_kod_pocztowy_zleceniodawcy"></div>
                    </div>
                    <div class="element_pole margin_l_20">
                        <p>MIEJSCOWOŚĆ</p>
                        <div class="bls_miejscowosc_zleceniodawcy"></div>
                    </div>
                    <div class="element_pole">
                        <p>SERIA I NR DOKUMENTU</p>
                        <div class="bls_dokument_zleceniodawcy"></div>
                    </div>
                    <div class="element_pole margin_l_20">
                        <p>NUMER PESEL</p>
                        <div class="bls_pesel_zleceniodawcy"></div>
                    </div>
                    <div class="element_pole margin_l_20">
                        <p>NIP (*WYPEŁNIĆ TYLKO DLA PRZEDSIĘBIORSTWA)</p>
                        <div class="bls_nip_zleceniodawcy"></div>
                    </div>
                    <div class="element_pole margin_l_20">
                        <p>KRD/EDG</p>
                        <div class="bls_krd_zleceniodawcy"></div>
                    </div>
                    <div class="element_pole">
                        <p>DATA URODZENIA*(*DOTYCZY OSÓB FIZYCZNYCH – WSPÓLNIKÓW SPÓŁKI CYWILNEJ BĄDŹ OSOBOWEJ ZBYWAJĄCEJ WIERZYTELNOŚĆ)</p>
                        <div class="bls_pesel_zleceniodawcy"></div>
                    </div>
                    <div class="clear_b"></div>
                    <div class="element_pole">
                        <p>TELEFON KONTAKTOWY</p>
                        <div class="bls_telefon_zleceniodawcy"></div>
                    </div>
                    <div class="element_pole margin_l_20">
                        <p>E-MAIL</p>
                        <div class="bls_e-mail_zleceniodawcy"></div>
                    </div>
                </div>
            </div>
        <div class="stopka_strony">
            <div class="stopka_strony_lewe">&nbsp;</div>
            <div class="stopka_strony_srodkowe">1/3</div>
            <div class="stopka_strony_prawe"><?php echo $numer_stopka; ?></div>
        </div>
    </div>

<!--STRONA DRUGA-->

    <div class="strona">
        <div class="logo_votum"></div>
        <div class="formularz_szary_obramowanie margin_t_60">

            <div class="pola_formularza_reprezentant_2_us">
                <div class="sekcja_formularza">
                    <p>URZĄD SKARBOWY* </p>
                    <div class="medium">
                        <p>(*DOTYCZY OSÓB FIZYCZNYCH – WSPÓLNIKÓW SPÓŁKI CYWILNEJ BĄDŹ OSOBOWEJ ZBYWAJĄCEJ WIERZYTELNOŚĆ):</p>
                    </div>
                </div>
                <div class="element_pole">
                    <p>PEŁNA NAZWA URZĘDU SKARBOWEGO</p>
                    <div class="bls_us_zleceniodawcy"></div>
                </div>
                <div class="element_pole">
                    <p>ULICA</p>
                    <div class="bls_ulica_us_zleceniodawcy"></div>
                </div>
                <div class="element_pole margin_l_20">
                    <p>NR DOMU</p>
                    <div class="bls_nr_domu_us_zleceniodawcy"></div>
                </div>
                <div class="element_pole margin_l_20">
                    <p>NR LOKALU</p>
                    <div class="bls_nr_lokalu_us_zleceniodawcy"></div>
                </div>
                <div class="element_pole margin_l_20">
                    <p>KOD POCZTOWY</p>
                    <div class="bls_kod_pocztowy_us_zleceniodawcy"></div>
                </div>
                <div class="element_pole margin_l_20">
                    <p>MIEJSCOWOŚĆ</p>
                    <div class="bls_miejscowosc_us_zleceniodawcy"></div>
                </div>
                <div class="element_pole">
                    <p>WIELKOŚĆ UDZIAŁU W WIERZYTELNOŚCI/ W ZYSKU Z PRZELEWU WIERZYTELNOŚCI</p>
                    <div class="bls_udzial_zleceniodawcy"></div>
                </div>
                <div class="przypis_poziomy_us"><p>(*WPISAĆ PROCENTOWO BĄDŹ UŁAMKIEM WIELKOŚĆ UDZIAŁU W WIERZYTELNOŚCI/W ZYSKU Z PRZELEWU WIERZYTELNOŚCI
                        LUB POŁOWĘ PRAWA PRZYSŁUGUJĄCEGO MAŁŻONKOM W RAMACH MAŁŻEŃSKIEGO MAJĄTKU WSPÓLNEGO)</p></div>
            </div>
        </div>
        <div class="spojnik">
            <p>a</p>
        </div>

        <div class="formularz_szary_cesjonariusz">

            <div class="pola_formularza_cesjonariusz">
                <div class="cesjonariusz_sekcja">
                    <p>
                        VOTUM S.A. z siedzibą we Wrocławiu 53-012, ul. Wyścigowa 56i, tel.
                        71/ 33 93 400, faks. 71/ 33 93 403, e-mail: dok@votum-sa.pl,
                        zarejestrowana w Sądzie Rejonowym dla Wrocławia Fabrycznej VI Wydział
                        Gospodarczy Krajowego Rejestru Sądowego pod numerem <span
                                class="czerwony_tekst">KRS: 0000243252, REGON: 020136043, NIP:
				899-25-49-057, KAPITAŁ ZAKŁADOWY: 1 200 000 zł wpłacony w całości,</span>
                        którą reprezentuje:
                    </p>
                    <div class="element_pole">
                        <div class="bls_cesjonariusz"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="bls_sekcja">
            <div class="bls_sekcja_tresc">
                <p>
                    Strony zgodnie ustalają, co następuje:
                </p>
            </div>
        </div>

        <div class="bls_sekcja">
            <div class="bls_sekcja_tytul">PRZEDMIOT UMOWY</div>
            <div class="bls_sekcja_paragraf">§ 1</div>
            <div class="bls_sekcja_tresc">
                <p>
                    Cedent zbywa odpłatnie na rzecz Cesjonariusza wszelkie wierzytelności jakie przysługują Cedentowi z tytułu odszkodowania za szkodę
                    w pojeździe marki ________________________, nr rej. __________________, od ______________________ należnego w związku
                    ze zdarzeniem z dnia (nr akt szkodowych ________________________________), w części przekraczającej wysokość
                    świadczenia pieniężnego zapłaconego przez ubezpieczyciela ____________________________________, zwanego dalej Ubezpieczycielem,
                    na rzecz Cedenta z tytułu nabycia części tej wierzytelności do wysokości zapłaconej kwoty na podstawie umowy przelewu
                    wierzytelności z dnia , w sprawie o numerze_____________________.
                </p>
            </div>
        </div>

        <div class="bls_sekcja">
            <div class="bls_sekcja_tytul">WYNAGRODZENIE</div>
            <div class="bls_sekcja_paragraf">§ 2</div>
            <div class="bls_sekcja_tresc">
                <p>
                    1. Cesjonariusz nabywa od Cedenta wierzytelność, o której mowa w § 1, za kwotę określoną w załączniku nr 1 do umowy.
                </p>
                <p>
                    2. Informacja, o której mowa w ust. 1, stanowi tajemnicę handlową i nie podlega ujawnieniu bez zgody Cesjonariusza.
                </p>
                <p>
                    3. Cesjonariusz zobowiązuje się do zapłaty kwoty, określonej w załączniku nr 1 do umowy, w terminie 7 dni roboczych od daty podpisania
                    umowy przez Cesjonariusza na rachunek bankowy wskazany przez Cedenta lub w inny sposób, określony w załączniku nr 1 do umowy.
                </p>
            </div>
        </div>

        <div class="bls_sekcja">
            <div class="bls_sekcja_tytul">OŚWIADCZENIA STRON</div>
            <div class="bls_sekcja_paragraf">§ 3</div>
            <div class="bls_sekcja_tresc">
                <p>
                    1. Cedent oświadcza, że wierzytelność, o której mowa w mowa w § 1, została zaspokojona w części odpowiadającej kwocie ______________zł
                    (słownie: _______________________________________________), zapłaconej przez Ubezpieczyciela na rzecz Cedenta z tytułu nabycia
                    części tej wierzytelności na podstawie umowy przelewu.
                </p>
                <p>
                    2. Cedent oświadcza, że z tytułu poniesionej szkody majątkowej, o której mowa w § 1 umowy, ponad kwotę zapłaconą przez Ubezpieczyciela
                    z tytułu nabycia wierzytelności:
                <p>- nie uzyskał dodatkowych kwot,</p>
                <p>- uzyskał dodatkowo odszkodowanie w łącznej kwocie ______________________ zł brutto (słownie: ____________________________
                    ________________________złotych).</p>
                </p>
                <p>
                    3. Cedent oświadcza, że szkoda, o której mowa w § 1, miała miejsce w okolicznościach, o których zawiadomił ubezpieczyciela, oraz że nie
                    toczyło się w związku z jej powstaniem postępowanie karne dotyczące doprowadzenia innej osoby do niekorzystnego rozporządzenia
                    własnym lub cudzym mieniem za pomocą wprowadzenia jej w błąd (art. 286 kodeksu karnego) lub spowodowania zdarzenia będącego
                    podstawą do wypłaty odszkodowania w celu uzyskania takiego odszkodowania z tytułu umowy ubezpieczenia (art. 298 kodeksu karnego).
                </p>
                <p>
                    4. Cedent oświadcza, że koszty naprawy pojazdu w związku ze szkodą, o której mowa w § 1, nie zostały pokryte na podstawie przedstawienia
                    Dłużnikowi rachunku lub faktury VAT lub innego dokumentu potwierdzającego wysokość kosztów naprawy. Koszty, o których mowa
                    w zdaniu pierwszym, nie dotyczą holowania, najmu pojazdu zastępczego, parkowania, ani przedmiotów przewożonych w pojeździe,
                    o którym mowa w § 1.
                </p>
                <p>
                    5. Cedent oświadcza, że nie zrzekł się roszczeń przysługujących mu względem Dłużnika w związku ze szkodą, o której mowa w § 1,
                    w tym w szczególności w wyniku zawarcia ugody lub innego porozumienia.
                </p>
                <p>
                    6. Cedent oświadcza, że wierzytelność, o której mowa w § 1, przelewana na rzecz Cesjonariusza jest wolna od obciążeń, oraz że uprawnienie
                    do jej zbycia na rzecz osób trzecich nie zostało wyłączone.
                </p>
                <p>
                    7. Cedent oświadcza, że pojazd, o którym mowa w § 1 umowy, w dacie powstania szkody nie był przedmiotem współwłasności z osobą
                    trzecią.
                </p>
            </div>
        </div>

        <div class="stopka_strony">
            <div class="stopka_strony_lewe">&nbsp;</div>
            <div class="stopka_strony_srodkowe">2/3</div>
            <div class="stopka_strony_prawe"><?php echo $numer_stopka; ?></div>
        </div>
    </div>

<!--STRONA TRZECIA-->

<div class="strona">
    <div class="logo_votum"></div>

    <div class="bls_sekcja margin_t_80">
        <div class="bls_sekcja_tresc">
            <p>
                8. Cedent oświadcza, że ujawnił Cesjonariuszowi wszelkie nienaprawione uszkodzenia, jakie pojazd posiadał przed powstaniem
                szkody komunikacyjnej, o której mowa § 1. Ponadto Cedent oświadcza, że pojazd ten bezpośrednio przed powstaniem szkody był
                dopuszczony do ruchu po drogach publicznych, o ile nie złożył Cesjonariuszowi przed zawarciem umowy odmiennego oświadczenia w
                formie pisemnej albo nie przedłożył dokumentów stwierdzających okoliczności przeciwne.
            </p>
            <p>
                9. Cedent oświadcza, że Dłużnik, o którym mowa w § 1, w dacie zawarcia umowy nie ma względem niego żadnej wymagalnej
                Wierzytelności podlegającej potrąceniu z wierzytelnościami, o których mowa w § 1.
            </p>
            <p>
                10. Cedent zobowiązuje się do sporządzenia pisemnego zawiadomienia dłużnika o przeniesieniu wierzytelności i złożenia go na ręce
                Cesjonariusza w celu przedłożenia Dłużnikowi. Cedent zobowiązuje się do tego, że nie cofnie złożonego oświadczenia.
            </p>
            <p>
                11. W przypadku uzyskania przez Cedenta od Dłużnika świadczenia tytułem spłaty wierzytelności, określonej w § 1, po podpisaniu
                przez Cedenta niniejszej umowy, Cedent zobowiązuje się do przekazania całości świadczenia na rachunek bankowy Cesjonariusza
                ING Bank Śląski S.A. 19 1050 1575 1000 0023 10250 6369 oraz powiadomić o tym Cesjonariusza na piśmie w terminie 7 dni roboczych od daty
                uzyskania świadczenia.
            </p>
        </div>
    </div>

    <div class="bls_sekcja">
        <div class="bls_sekcja_tytul">DOKUMENTACJA DLA CESJONARIUSZA</div>
        <div class="bls_sekcja_paragraf">§ 4</div>
        <div class="bls_sekcja_tresc">
            <p>
                1.Cedent, w celu dochodzenia wierzytelności od Dłużnika, przekazuje Cesjonariuszowi następujące dokumenty:
            </p>
            <p>
                a) kopię wypełnionych stron karty pojazdu, o którym mowa w § 1, jeżeli została ona wydana;
            </p>
            <p>
                b) kopię dowodu rejestracyjnego pojazdu, o którym mowa w § 1;
            </p>
            <p>
                c) kopię umowy sprzedaży pojazdu, o którym mowa w § 1, jeżeli został on zbyty po powstaniu szkody, o której mowa w § 1;
            </p>
            <p>
                d) kopie dowodów osobistych wszystkich współwłaścicieli pojazdu, a jeżeli właścicielem pojazdu jest przedsiębiorca, również
                dokumenty rejestrowe przedsiębiorcy będącego właścicielem pojazdu;
            </p>
            <p>
                e) kosztorys wyceny szkody zawierający szczegółowy wykaz części podlegających wymianie lub naprawie, procedury naprawcze i czas
                ich wykonania oraz przyjęte ceny wyżej wymienionych, dotyczące szkody, o której mowa w § 1, wykonany na zlecenie lub przez
                Dłużnika, o którym mowa w § 1, jeżeli został wydany;
            </p>
            <p>
                f) wszelkie oświadczenia Dłużnika o przyznaniu odszkodowania z tytułu szkody, o której mowa w § 1, lub potwierdzenie wpływu
                odszkodowania wpłaconego na rachunek bankowy Cedenta bądź pokwitowanie jego odbioru;
            </p>
            <p>
                g) w przypadku, gdy wierzytelność przysługuje Cedentowi z tytułu ubezpieczenia AUTO-CASCO – kopię polisy oraz ogólnych warunków
                umowy ubezpieczenia, aktualnych na dzień zawarcia umowy;
            </p>
            <p>
                h) kopię umowy przelewu wierzytelności zawartej z Ubezpieczycielem, o której mowa w § 1, oraz potwierdzenie wpływu świadczenia
                pieniężnego zapłaconego przez Ubezpieczyciela na rachunek bankowy Cedenta z tytułu nabycia części wierzytelności, o której mowa
                w § 1, bądź pokwitowanie jego odbioru.
            </p>
            <p>
                2. Cesjonariusz zobowiązuje się do wykorzystania przekazanych mu dokumentów wyłącznie w celu realizacji umowy.
            </p>
        </div>
    </div>

    <div class="bls_sekcja">
        <div class="bls_sekcja_tytul">POSTANOWIENIA KOŃCOWE</div>
        <div class="bls_sekcja_paragraf">§ 5</div>
        <div class="bls_sekcja_tresc">
            <p>
                1. Wszelkie zmiany umowy wymagają formy pisemnej pod rygorem nieważności.
            </p>
            <p>
                2. Umowa wraz z załącznikiem nr 1 została sporządzona w dwóch jednobrzmiących egzemplarzach, po jednym dla każdej ze Stron
            </p>
        </div>
    </div>

    <div class="podpisy_dwa">
        <div class="podpis_lewy">VOTUM S.A.</div>
        <div class="podpis_prawy">CEDENT (OSOBY DOKONUJĄCE CESJI)</div>
    </div>

    <div class="kreska"></div>

    <div class="bls_przypisy">
        <p>Zgodnie z art. 24 ust. 1 ustawy z dnia 29 sierpnia 1997 r. o ochronie danych osobowych (tekst jednolity: Dz.U. z 2016 r., poz. 922 ze zm.) VOTUM informuje, że:</p>
        <p>1. administratorem danych osobowych jest VOTUM S.A. z siedzibą we Wrocławiu 53-012, przy ul. Wyścigowej 56i,</p>
        <p>2. dane osobowe będą przetwarzane w celu wykonania umowy i mogą być przekazywane podmiotom współpracującym przy jej wykonaniu, jak również podmiotom,
            od których będą uzyskiwane informacje niezbędne do wykonania umowy i podmiotom, od których będą dochodzone roszczenia,</p>
        <p>3. posiada Pani/Pan prawo dostępu do treści danych oraz ich poprawiania,</p>
        <p>4. podanie VOTUM danych osobowych jest dobrowolne.</p>
    </div>

    <div class="podpisy_dwa">
        <div class="podpis_prawy">CEDENT (OSOBY DOKONUJĄCE CESJI)</div>
    </div>

    <div class="stopka_strony">
        <div class="stopka_strony_lewe">&nbsp;</div>
        <div class="stopka_strony_srodkowe">3/3</div>
        <div class="stopka_strony_prawe"><?php echo $numer_stopka; ?></div>
    </div>
</div>