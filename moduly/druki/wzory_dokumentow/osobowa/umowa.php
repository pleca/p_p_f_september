<?php
setlocale ( LC_CTYPE, "pl_PL.UTF-8" );

$umowa = json_decode($_POST['umowa'], true);
$umowa_dane = json_decode($_POST['umowa_dane'], true);
$pozostale_informacje = json_decode($_POST['pozostale_informacje'], true);
$klient = json_decode($_POST['klient'], true);
$dochodzenie_roszczen = json_decode($_POST['dochodzenie_roszczen'], true);
$uprawniony = json_decode($_POST['uprawniony'], true);
$wynagrodzenie = json_decode($_POST['wynagrodzenie'], true);

$stopka = 'PG-2-23-F3/2018-05-24';
//$stopka = 'PG-2-23-F3/2018-01-02';
?>


<link rel="stylesheet" href="<?php echo 'https://' . $_SERVER ['HTTP_HOST'] . '/biblioteki/bootstrap/css/bootstrap.css'; ?>" type="text/css" />
<link rel="stylesheet" href="<?php echo 'https://' . $_SERVER ['HTTP_HOST'] . '/moduly/druki/wzory_dokumentow/css/wzory_dokumentow.css'; ?>" type="text/css" />


    <div class="pdf_strona">

        <div class="pdf_strona_pierwsza_naglowek_pelnomocnictwo margin_t_20">
            <div class="pdfs_tytu_dokumentu pdf_tytul_pelnomocnictwo margin_t_80">
                <p class="margin_b_0 font_w_800 font_size_24 text_a_center">UMOWA KOMPLEKSOWEJ OPIEKI ODSZKODOWAWCZEJ</p>
                <p class="margin_b_0 font_size_16 text_a_center margin_t_20">zawarta w dniu <?php echo (!empty($umowa['DataUmowy'])) ? $umowa['DataUmowy'] : '______________' ; ?> r. pomiędzy Zleceniodawcą (zwanym dalej Klientem)</p>
            </div>
            <div class="pdfs_logo_laur"><img src="<?php echo 'https://' . $_SERVER ['HTTP_HOST']; ?>/img/laur.png" /></div>
            <div class="pdfs_logo_osobowe"><img src="<?php echo 'https://' . $_SERVER ['HTTP_HOST']; ?>/img/logo.png" /></div>
        </div>

        <div class="szary_box szary_box_ramka_czerw margin_t_20">
            <div class="form-group col-md-6 margin_t_5">
                <div class="pdf_kratka kratka_nowy"><?php echo $klient['Imie']; ?></div>
                <label class="font_size_10 margin_b_0">imię</label>
            </div>
            <div class="form-group col-md-6 margin_t_5">
                <div class="pdf_kratka kratka_nowy"><?php echo $klient['Nazwisko']; ?></div>
                <label class="font_size_10 margin_b_0">nazwisko</label>
            </div>
            <label class="font_w_800 col-md-12 margin_t_10 margin_b_0"><p class="margin_b_0">Adres zamieszkania</p></label>
            <div class="form-group col-md-6 margin_t_5">
                <div class="pdf_kratka kratka_nowy"><?php echo $klient['Ulica']; ?></div>
                <label class="font_size_10 margin_b_0">ulica</label>
            </div>
            <div class="form-group col-md-2 margin_t_5 paddding_r_0">
                <div class="pdf_kratka kratka_nowy"><?php echo $klient['NrDomu']; ?></div>
                <label class="font_size_10 ">nr domu</label>
            </div>
            <div class="form-group col-md-2 margin_t_5 paddding_l_0">
                <div class="pdf_kratka kratka_nowy"><?php echo $klient['NrMieszkania']; ?></div>
                <label class="font_size_10">mieszkania</label>
            </div>
            <div class="form-group col-md-2 margin_t_5">
                <div class="pdf_kratka kratka_nowy"><?php echo $klient['KodPocztowy']; ?></div>
                <label class="font_size_10">kod pocztowy</label>
            </div>
            <div class="form-group col-md-4 margin_t_5">
                <div class="pdf_kratka kratka_nowy"><?php echo $klient['Miasto']; ?></div>
                <label class="font_size_10 ">miejscowość</label>
            </div>
            <div class="form-group col-md-4 margin_t_5">
                <div class="pdf_kratka kratka_nowy"><?php echo $klient['Pesel']; ?></div>
                <label class="font_size_10 ">PESEL</label>
            </div>
            <div class="form-group col-md-4 margin_t_5">
                <div class="pdf_kratka kratka_nowy"><?php echo $klient['Dowod']; ?></div>
                <label class="font_size_10 ">seria i numer dowodu osobistego</label>
            </div>
            <div class="form-group col-md-4 margin_t_5">
                <div class="pdf_kratka kratka_nowy"><?php echo $klient['Telefon']; ?></div>
                <label class="font_size_10 ">telefon</label>
            </div>
            <div class="form-group col-md-8 margin_t_5">
                <div class="pdf_kratka kratka_nowy"><?php echo $klient['Mail']; ?></div>
                <label class="font_size_10 ">e-mail</label>
            </div>
            <div class="form-group col-md-12 margin_t_5">
                <div class="pdf_kratka kratka_nowy"><?php echo $wynagrodzenie['WynagrodzenieNumer']; ?></div>
                <label class="font_size_10 float_l">nr rachunku bankowego</label>
                <div class="col-md-4 float_r font_size_10"><span class="glyphicon glyphicon<?php echo ($wynagrodzenie['IdOdbiorcy'] == $klient['IdKlienta']) ? '-check' : '-unchecked'; ?>" aria-hidden="true"></span> posiadaczem rachunku bankowego jest klient</div>
            </div>
            <div class="form-group col-md-12 margin_t_5">
                <div class="pdf_kratka kratka_nowy"><?php echo ($wynagrodzenie['IdOdbiorcy'] != $klient['IdKlienta']) ? $wynagrodzenie['WynagrodzenieImie'].' '.$wynagrodzenie['WynagrodzenieNazwisko'] : ''; ?></div>
                <label class="font_size_10 ">imię i nazwisko posiadacza rachunku (wypełnić, jeśli posiadaczem rachunku nie jest Klient)</label>
            </div>
            <div class="clear_b"></div>
        </div>

        <div class="clear_b odstep"></div>

        <div class="szary_box szary_box_ramka_czerw">
            <div class="pdf_kratka_duza">
                <p class="margin_b_0 text_align_justify font_size_12">a Zleceniobiorcą:<p>
                <p class="margin_b_0 text_align_justify font_size_12">VOTUM S.A. z siedzibą we Wrocławiu 53-012, ul. Wyścigowa 56i, tel. 71/ 33 93 400, faks. 71/ 33 93 403,
                e-mail: dok@votum-sa.pl, zarejestrowana w Sądzie Rejonowym dla Wrocławia Fabrycznej VI Wydział Gospodarczy Krajowego Rejestru Sądowego pod numerem
                KRS: 0000243252, REGON: 020136043, NIP: 899-25-49-057, KAPITAŁ ZAKŁADOWY: 1 200 000 zł wpłacony w całości, zwanym dalej Votum,
                </p>
                <p class="margin_b_0 text_align_justify font_size_12">zwanymi dalej łącznie Stronami.<p>
            </div>
        </div>

        <div class="clear_b odstep"></div>

        <div class="triang_box">
            <div class="triang_czer"></div>
            <div class="triang_digit"><p><span class="font_w_800">I</span></p></div>
            <div class="triang_czar"></div>
            <div class="triang_czar_text"><p><span class="font_w_800">PRZEDMIOT UMOWY</span></p></div>
            <div class="clear_b"></div>
        </div>

        <div class="col-md-12 padding_l_40 padding_r_40 padding_t_10">
            <p class="margin_b_0 text_align_justify">Votum <span class="font_w_700">zobowiązuje się</span> podjąć na rzecz Klienta działania mające na celu uzyskanie wszystkich możliwych świadczeń odszkodowawczych
                od podmiotu odpowiedzialnego za szkodę na osobie, wynikającą ze zdarzenia z dnia <span class="font_w_700"><?php echo (!empty($pozostale_informacje['DataZdarzenia'])) ? $pozostale_informacje['DataZdarzenia'] : '______________'; ?></span> r.
                (zwanych dalej łącznie Odszkodowaniem).
            </p>
        </div>


        <div class="clear_b odstep"></div>

        <div class="triang_box">
            <div class="triang_czer"></div>
            <div class="triang_digit"><p><span class="font_w_800">II</span></p></div>
            <div class="triang_czar"></div>
            <div class="triang_czar_text"><p><span class="font_w_800">GWARANCJE VOTUM</span></p></div>
            <div class="clear_b"></div>
        </div>

        <div class="col-md-12 padding_l_40 padding_r_40 padding_t_10">
            Votum <span class="font_w_700">gwarantuje</span>, że:
            <ol class="numerowanie">
            <li class="margin_b_0 text_align_justify">
                wystąpi na swój koszt o dokumentację, w szczególności medyczną, potwierdzającą roszczenia Klienta,
            </li>
            <li class="margin_b_0 text_align_justify">
                przekaże Klientowi na wskazany przez niego rachunek uzyskane na jego rzecz środki w terminie 7 dni roboczych od ich wpływu na rachunek VOTUM,
                po uprzednim potrąceniu należnego wynagrodzenia, a w przypadku braku wskazania przez Klienta rachunku, wyśle w tym terminie środki przekazem pocztowym na adres
                Klienta wskazany w umowie lub w pisemnym oświadczeniu Klienta, przy czym koszty przekazu pocztowego ponosi Klient,
            </li>
            <li class="margin_b_0 text_align_justify">
                rozpozna wniosek Klienta o zaliczkę na poczet Odszkodowania w terminie 7 dni roboczych od jego złożenia,
            </li>
            <li class="margin_b_0 text_align_justify">
                przekaże za zgodą obu Stron dokumentację medyczną Klienta w celu sporządzenia Indywidualnego Planu Rehabilitacji (IPR) w Polskim
                Centrum Rehabilitacji Funkcjonalnej Votum S.A. w terminie 14 dni od jego złożenia i rozpozna wniosek o zaliczkę na poczet Odszkodowania
                przeznaczoną na rehabilitację w ramach IPR,
            </li>
            <li class="margin_b_0 text_align_justify">
                nie zawrze ugody z ubezpieczycielem lub innym podmiotem odpowiedzialnym za szkodę bez uprzedniej zgody Klienta,
            </li>
            <li class="margin_b_0 text_align_justify">
                powództwo o zapłatę Odszkodowania zostanie wytoczone tylko w przypadku zgody obu stron umowy,
            </li>
            <li class="margin_b_0 text_align_justify">
                pełnomocnik wystąpi o zwolnienie Klienta z kosztów sądowych, na podstawie prawidłowo wypełnionego przez Klienta formularza
                oświadczenia o stanie rodzinnym, majątku i dochodach,
            </li>
            <li class="margin_b_0 text_align_justify">
                poniesie koszty wszelkich opłat sądowych, opłat skarbowych i wydatków na wynagrodzenie biegłych sądowych związanych z wytoczeniem
                powództwa o zapłatę Odszkodowania i prowadzeniem sprawy sądowej, w części, w jakiej Klient nie zostanie zwolniony
                z ich ponoszenia przez sąd,
            </li>
            <li class="margin_b_0 text_align_justify">
                będzie systematycznie informować Klienta o przebiegu wykonania umowy,
            </li>
            <li class="margin_b_0 text_align_justify">
                udzieli odpowiedzi na złożoną przez Klienta reklamację w terminie 21 dni od jej otrzymania.
            </li>
            </ol>
        </div>

        <div class="clear_b odstep"></div>
        <div class="stopka_pionowa"><?php echo $stopka; ?></div>
        <div class="stopka_pozioma_dol"><p class="text_a_center margin_b_0">1/3</p></div>
    </div>

    <div class="pdf_strona">

        <div class="pdf_strona_pierwsza_naglowek_pelnomocnictwo margin_t_20">
            <div class="pdfs_logo_laur"><img src="<?php echo 'https://' . $_SERVER ['HTTP_HOST']; ?>/img/laur.png" /></div>
            <div class="pdfs_logo_osobowe"><img src="<?php echo 'https://' . $_SERVER ['HTTP_HOST']; ?>/img/logo.png" /></div>
        </div>

        <!--<div class="pdfs_logo_laur"><img src="<?php /*echo 'https://' . $_SERVER ['HTTP_HOST']; */?>/img/laur.png" /></div>
        <div class="pdfs_logo_osobowe"><img src="<?php /*echo 'https://' . $_SERVER ['HTTP_HOST']; */?>/img/logo.png" /></div>-->

        <div class="triang_box margin_t_60">
            <div class="triang_czer"></div>
            <div class="triang_digit"><p><span class="font_w_800">III</span></p></div>
            <div class="triang_czar"></div>
            <div class="triang_czar_text"><p><span class="font_w_800">WYNAGRODZENIE VOTUM</span></p></div>
            <div class="clear_b"></div>
        </div>

        <div class="col-md-12 padding_l_40 padding_r_40 padding_t_10">
            <ol class="numerowanie">
                <li class="margin_b_0 text_align_justify">
                    VOTUM <span class="font_w_700">nie pobiera wynagrodzenia</span> w przypadku nieuzyskania Odszkodowania z przyczyn niezależnych od Klienta lub odstąpienia
                    od dochodzenia Odszkodowania ze względu na żądanie Klienta wynikające z roszczeń regresowych do sprawcy szkody.
                </li>
                <li class="margin_b_0 text_align_justify">
                    VOTUM <span class="font_w_700">nie pobiera wynagrodzenia</span> od uzyskanych dla Klienta:
                </li>
                <ol class="numerowanie_alfabet_male">
                    <li class="margin_b_0 text_align_justify">
                        zwrotów kosztów leczenia, hospitalizacji, rehabilitacji, dostosowania lokalu lub pojazdu do potrzeb osoby niepełnosprawnej, zakupu
                        protez, sprzętów ortopedycznych, lekarstw, materiałów opatrunkowych, jak również kosztów przejazdów Klienta oraz osób bliskich
                        do placówek medycznych,
                    </li>
                    <li class="margin_b_0 text_align_justify">
                        zwrotów kosztów związanych z pogrzebem najbliższego członka rodziny Klienta,
                    </li>
                    <li class="margin_b_0 text_align_justify">
                        rent, chyba że zostaną wypłacone jednorazowo w wysokości należnej za okres co najmniej 6 miesięcy.
                    </li>
                </ol>
                <li class="margin_b_0 text_align_justify">
                    VOTUM <span class="font_w_700">nie pobiera wynagrodzenia</span> w przypadku wypowiedzenia umowy przez Klienta. Jeżeli wypowiedzenie nastąpiło bez ważnego powodu, a na skutek wykonania umowy Klient uzyskał Odszkodowanie, VOTUM może domagać się naprawienia szkody wyłącznie do kwoty wysokości wynagrodzenia, jakie zostałoby naliczone, gdyby Klient nie wypowiedział umowy.
                </li>
                <li class="margin_b_0 text_align_justify">
                    Za wykonanie umowy, Votum pobiera wynagrodzenie w wysokości <span class="font_w_700"><?php echo (!empty($umowa_dane['ProcentWynagrodzenia'])) ? $umowa_dane['ProcentWynagrodzenia'] : '______________' ; ?></span>% (słownie <span class="font_w_700"><?php echo (!empty($umowa_dane['ProcentWynagrodzenia'])) ? $umowa_dane['ProcentWynagrodzeniaSlownie'] : '______________' ; ?></span>
                    %) brutto (w tym 23% VAT) wartości wszystkich uzyskanych dla Klienta świadczeń z wyjątkiem wyżej wymienionych.
                </li>
                <li class="margin_b_0 text_align_justify">
                    Poniesione przez Votum koszty procesu podlegają zwrotowi na rzecz Votum <span class="font_w_700">wyłącznie z kwoty ogółu świadczeń</span> przyznanych
                    Klientowi rozstrzygnięciem sądu lub ugodą, a koszty zastępstwa procesowego zasądzone w sprawie przypadają reprezentującemu
                    Klienta pełnomocnikowi procesowemu z Kancelarii Adwokatów i Radców Prawnych A. Łebek i Wspólnicy sp.k.
                </li>
                <li class="margin_b_0 text_align_justify">
                    W przypadku wypłaty Odszkodowania bezpośrednio Klientowi, Klient zobowiązuje się wpłacić w terminie 7 dni roboczych od dnia
                    jego otrzymania należne VOTUM wynagrodzenie na rachunek bankowy prowadzony w ING Bank Śląski S.A. Oddział we Wrocławiu
                    nr 70 1050 1575 1000 0023 2392 0799 lub na inny rachunek wskazany przez VOTUM. W przypadku, gdy Klient jest małoletni,
                    ubezwłasnowolniony bądź reprezentowany przez swojego małżonka, osoba podpisująca umowę w imieniu Klienta przyjmuje
                    odpowiedzialność solidarną za zobowiązania Klienta wynikające z umowy.
                </li>
            </ol>
        </div>

        <div class="clear_b odstep"></div>

        <div class="triang_box">
            <div class="triang_czer"></div>
            <div class="triang_digit"><p><span class="font_w_800">IV</span></p></div>
            <div class="triang_czar"></div>
            <div class="triang_czar_text"><p><span class="font_w_800">OBSŁUGA EKSPERCKA</span></p></div>
            <div class="clear_b"></div>
        </div>

        <div class="col-md-12 padding_l_40 padding_r_40 padding_t_10">
            Votum w ramach uzyskanego od Klienta wynagrodzenia i w zakresie niezbędnym do wykonania umowy, <span class="font_w_700">pokrywa wynagrodzenia
            i koszty dochodzenia Odszkodowania</span>, w tym koszty dojazdów i substytucji na terenie całego kraju, wskazanego przez siebie:
            <ol class="numerowanie">
                <li class="margin_b_0 text_align_justify">
                    doradcy odszkodowawczego w postępowaniu polubownym,
                </li>
                <li class="margin_b_0 text_align_justify">
                    pełnomocnika w postępowaniu mediacyjnym,
                </li>
                <li class="margin_b_0 text_align_justify">
                    adwokata lub radcy prawnego z Kancelarii Adwokatów i Radców Prawnych A. Łebek i Wspólnicy sp. k. we Wrocławiu w postępowaniu:
                </li>
                <ol class="numerowanie_alfabet_male">
                    <li class="margin_b_0 text_align_justify">
                        karnym przygotowawczym prowadzonym w związku ze zdarzeniem wskazanym w pkt I – w zakresie reprezentacji Klienta jako
                        pokrzywdzonego,
                    </li>
                    <li class="margin_b_0 text_align_justify">
                        cywilnym sądowym i egzekucyjnym – o zapłatę Odszkodowania,
                    </li>
                    <li class="margin_b_0 text_align_justify">
                        cywilnym sądowym z zakresu prawa rodzinnego i opiekuńczego oraz osobowego,
                    </li>
                </ol>
                <li class="margin_b_0 text_align_justify">
                    biegłego z zakresu rekonstrukcji zdarzeń drogowych.
                </li>
            </ol>
        </div>

        <div class="clear_b odstep"></div>

        <div class="triang_box">
            <div class="triang_czer"></div>
            <div class="triang_digit"><p><span class="font_w_800">V</span></p></div>
            <div class="triang_czar"></div>
            <div class="triang_czar_text"><p><span class="font_w_800">CZAS TRWANIA UMOWY</span></p></div>
            <div class="clear_b"></div>
        </div>

        <div class="col-md-12 padding_l_40 padding_r_40 padding_t_10">
            <p class="margin_b_0 text_align_justify">
                Umowa zostaje zawarta na czas do całkowitego wyegzekwowania od podmiotu odpowiedzialnego za szkodę na rzecz Klienta należnego
                mu Odszkodowania w postępowaniu przedsądowym, sądowym i egzekucyjnym.
            </p>
        </div>

        <div class="clear_b odstep"></div>


        <div class="triang_box">
            <div class="triang_czer"></div>
            <div class="triang_digit"><p><span class="font_w_800">VI</span></p></div>
            <div class="triang_czar"></div>
            <div class="triang_czar_text"><p><span class="font_w_800">OŚWIADCZENIA STRON</span></p></div>
            <div class="clear_b"></div>
        </div>

        <div class="col-md-12 font_size_12 padding_l_40 padding_r_40 padding_t_10">
            Votum oświadcza, że:
            <ol class="numerowanie">
                <li class="margin_b_0 text_align_justify">
                    Informacje o sposobie wykonywania umowy mogą być przekazywane na wskazany w umowie nr telefonu, adres e-mail, pocztą lub na konto Klienta dostępne za pośrednictwem strony internetowej VOTUM,
                </li>
                <li class="margin_b_0 text_align_justify">
                    Klient może złożyć reklamację na świadczone przez Votum usługi listem poleconym na adres spółki..
                </li>
            </ol>

            Klient oświadcza, że został poinformowany o:
            <ol class="numerowanie">
                <li class="margin_b_0 text_align_justify">
                    sposobie i terminie wykonania prawa odstąpienia od umowy od niniejszej umowy oraz wzorze oświadczenia o odstąpieniu i o po-zasądowych sposobach rozpatrywania reklamacji – na odrębnym formularzu,
                </li>
                <li class="margin_b_0 text_align_justify">
                    prawie żądania przez ubezpieczyciela lub Ubezpieczeniowy Fundusz Gwarancyjny zwrotu wypłaconych kwot od sprawcy lub osoby, która nie zawarła umowy obowiązkowego ubezpieczenia odpowiedzialności cywilnej, w przypadkach określonych przepisami prawa.
                </li>
            </ol>

            <p style="font-size: 13px">Klient oświadcza, że
                <span class="glyphicon glyphicon<?php echo ($dochodzenie_roszczen['ZleconoRoszczenia'] == 1) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span> nie zlecał
                <span class="glyphicon glyphicon<?php echo ($dochodzenie_roszczen['ZleconoRoszczenia'] == 2) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span> zlecał
                wcześniej dochodzenie roszczeń pełnomocnikowi <span class="font_w_700"><?php echo ($dochodzenie_roszczen['ZleconoRoszczenia'] == 2) ? $dochodzenie_roszczen['NazwaPelnomocnika'] : '______________'; ?></span> na podstawie umowy z dnia
                <span class="font_w_700"><?php echo ($dochodzenie_roszczen['ZleconoRoszczenia'] == 2) ? $dochodzenie_roszczen['DataZawarciaUmowy'] : '______________'; ?></span>r.
            </p>

            <p style="font-size: 13px">Klient oświadcza, że
                <span class="glyphicon glyphicon<?php echo ($umowa_dane['UpowaznienieKAIRP'] == 1) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span> upoważnia
                <span class="glyphicon glyphicon<?php echo ($umowa_dane['UpowaznienieKAIRP'] == 0) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span> nie upoważnia
                Zleceniobiorcy do uzyskiwania informacji i dokumentów w sprawach prowadzonych przez Kancelarię Adwokatów i Radców Prawnych A. Łebek i Wspólnicy sp.k. z siedzibą we Wrocławiu, w związku z realizacją niniejszej umowy.
            </p>

            <p style="font-size: 13px">Od ww. umowy Klient
                <span class="glyphicon glyphicon<?php echo ($dochodzenie_roszczen['WypowiedzenieUmowy'] == 1) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span> odstąpił
                <span class="glyphicon glyphicon<?php echo ($dochodzenie_roszczen['WypowiedzenieUmowy'] == 2) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span> wypowiedział dnia
                <span class="font_w_700"><?php echo (($dochodzenie_roszczen['WypowiedzenieUmowy'] == 1) || ($dochodzenie_roszczen['WypowiedzenieUmowy'] == 2)) ? $dochodzenie_roszczen['DataWypowiedzenia']: '______________'; ?></span>r.
            </p>
        </div>

        <div class="clear_b odstep"></div>
        <div class="stopka_pionowa"><?php echo $stopka; ?></div>
        <div class="stopka_pozioma_dol"><p class="text_a_center margin_b_0">2/3</p></div>
    </div>

    <div class="pdf_strona">

        <div class="pdf_strona_pierwsza_naglowek_pelnomocnictwo margin_t_20">
            <div class="pdfs_logo_laur"><img src="<?php echo 'https://' . $_SERVER ['HTTP_HOST']; ?>/img/laur.png" /></div>
            <div class="pdfs_logo_osobowe"><img src="<?php echo 'https://' . $_SERVER ['HTTP_HOST']; ?>/img/logo.png" /></div>
        </div>

        <div class="triang_box margin_t_80">
            <div class="triang_czer"></div>
            <div class="triang_digit"><p><span class="font_w_800">VII</span></p></div>
            <div class="triang_czar"></div>
            <div class="triang_czar_text"><p><span class="font_w_800">POSTANOWIENIA KOŃCOWE</span></p></div>
            <div class="clear_b"></div>
        </div>
        <div class="col-md-12 padding_l_40 padding_r_40 padding_t_10">
            <ol class="numerowanie">
                <li class="margin_b_0 text_align_justify">
                    Wszelkie zmiany umowy wymagają formy pisemnej pod rygorem nieważności.
                </li>
                <li class="margin_b_0 text_align_justify">
                    Umowę sporządzono i podpisano w dwóch jednobrzmiących egzemplarzach, po jednym dla każdej ze Stron.
                </li>
                <li class="margin_b_0 text_align_justify">
                    Integralną częścią niniejszej umowy jest załącznik – klauzula informacyjna dla Klienta.
                </li>
            </ol>
        </div>

<!--        <p class="font_size_10 text_align_justify padding_l_40 padding_r_40">-->
<!--            Zgodnie z art. 24 ust. 1 ustawy z dnia 29 sierpnia 1997 r. o ochronie danych osobowych (tekst jednolity: Dz. U. z 2016 r., poz. 922 ze zm.) VOTUM informuje, że: 1. administratorem danych-->
<!--            osobowych jest VOTUM S.A. z siedzibą we Wrocławiu, ul. Wyścigowa 56i, 53-012 Wrocław, 2. dane osobowe będą przetwarzane w celu wykonania umowy oraz w innych usprawiedliwionych-->
<!--            celach administratora i mogą być przekazywane podmiotom współpracującym przy jej wykonaniu, jak również podmiotom, od których będą uzyskiwane informacje niezbędne do-->
<!--            wykonania umowy i podmiotom od których będą dochodzone roszczenia, a także, za Pana/Pani zgodą, podmiotom wskazanym pod treścią umowy, 3. posiada Pani/Pan prawo dostępu-->
<!--            do treści danych oraz ich poprawiania, 4. podanie VOTUM danych osobowych jest dobrowolne. Wyrażam zgodę na przetwarzanie danych osobowych osoby, na rzecz której będą dochodzone-->
<!--            roszczenia odszkodowawcze (w tym danych dotyczących stanu zdrowia, skazań, orzeczeń o ukaraniu i mandatów karnych, a także innych orzeczeń wydanych w postępowaniu-->
<!--            sądowym) w celu wykonania umowy.-->
<!--        </p>-->

        <div class="clear_b odstep"></div>


        <div class="szary_box szary_box_ramka_czerw">

            <p class="padding_6">
                Działający w imieniu Klienta:
                <span class="glyphicon glyphicon<?php echo ($pozostale_informacje['RodzajUprawnionego'] == 1) ? '-check' : '-unchecked'; ?>"
                      aria-hidden="true"></span> przedstawiciel ustawowy
                <span class="glyphicon glyphicon<?php echo ($pozostale_informacje['RodzajUprawnionego'] == 2) ? '-check' : '-unchecked'; ?>"
                      aria-hidden="true"></span> opiekun prawny poszkodowanego
                <span class="glyphicon glyphicon<?php echo ($pozostale_informacje['RodzajUprawnionego'] == 3) ? '-check' : '-unchecked'; ?>"
                      aria-hidden="true"></span> małżonek osoby uprawnionej*:
            </p>

            <div class="form-group col-md-6">
                <div class="pdf_kratka kratka_nowy"><?php echo $uprawniony['Imie']; ?></div>
                <label class="font_size_10 margin_b_0">imię</label>
            </div>
            <div class="form-group col-md-6">
                <div class="pdf_kratka kratka_nowy"><?php echo $uprawniony['Nazwisko']; ?></div>
                <label class="font_size_10 margin_b_0">nazwisko</label>
            </div>
            <label class="font_w_700 col-md-12 margin_t_10"><p class="margin_b_0"><span class="font_w_800">Adres zamieszkania</span></p></label>
            <div class="form-group col-md-6 margin_t_5">
                <div class="pdf_kratka kratka_nowy"><?php echo $uprawniony['Ulica']; ?></div>
                <label class="font_size_10 margin_b_0">ulica</label>
            </div>
            <div class="form-group col-md-2 margin_t_5 paddding_r_0">
                <div class="pdf_kratka kratka_nowy"><?php echo $uprawniony['NrDomu']; ?></div>
                <label class="font_size_10 ">nr domu</label>
            </div>
            <div class="form-group col-md-2 margin_t_5 paddding_l_0">
                <div class="pdf_kratka kratka_nowy"><?php echo $uprawniony['NrMieszkania']; ?></div>
                <label class="font_size_10">mieszkania</label>
            </div>
            <div class="form-group col-md-2 margin_t_5">
                <div class="pdf_kratka kratka_nowy"><?php echo $uprawniony['KodPocztowy']; ?></div>
                <label class="font_size_10">kod pocztowy</label>
            </div>
            <div class="form-group col-md-4 margin_t_5">
                <div class="pdf_kratka kratka_nowy"><?php echo $uprawniony['Miasto']; ?></div>
                <label class="font_size_10 ">miejscowość</label>
            </div>
            <div class="form-group col-md-4 margin_t_5">
                <div class="pdf_kratka kratka_nowy"><?php echo $uprawniony['Pesel']; ?></div>
                <label class="font_size_10 ">PESEL</label>
            </div>
            <div class="form-group col-md-4 margin_t_5">
                <div class="pdf_kratka kratka_nowy"><?php echo $uprawniony['Dowod']; ?></div>
                <label class="font_size_10 ">seria i numer dowodu osobistego</label>
            </div>

            <p class="font_size_10 padding_l_10 padding_r_10 margin_t_10 padding_b_10">
                    *W przypadku, gdy umowa zawierana jest w imieniu osoby nie posiadającej pełnej zdolności do czynności prawnych, tj. <span class="font_w_700">małoletniego/ubezwłasnowolnionego, umowę podpisuje przedstawiciel
                    ustawowy lub opiekun prawny poszkodowanego.</span> W razie przemijającej przeszkody, która dotyczy jednego z małżonków pozostających we wspólnym pożyciu, zgodnie z art. 29
                    Kodeksu rodzinnego i opiekuńczego, drugi małżonek może za niego działać w sprawach zwykłego zarządu.
            </p>

            <div class="clear_b"></div>
        </div>

        <div class="clear_b odstep"></div>


        <div class="szary_box szary_box_ramka_czerw text_a_center">
            <div class="form-group col-md-4 margin_t_5">
                <div class="pdf_kratka kratka_nowy big_kratka"><?php echo $umowa['Imie'].' '.$umowa['Nazwisko'] ?></div>
                <label class="font_size_10 ">Imię i nazwisko pełnomocnika Votum</br>
                    (wypełnić drukowanymi literami)</label>
            </div>
            <div class="form-group col-md-4 margin_t_5">
                <div class="pdf_kratka kratka_nowy big_kratka"></div>
                <label class="font_size_10 text_a_center">Czytelny podpis
                    pełnomocnika Votum</label>
            </div>
            <div class="form-group col-md-4 margin_t_5">
                <div class="pdf_kratka kratka_nowy big_kratka"></div>
                <label class="font_size_10 ">Podpis Klienta/Osoby działającej w imieniu Klienta*</label>
            </div>
            <div class="clear_b"></div>
        </div>

<!--        <div class="col-md-12 padding_l_40 padding_r_40 padding_t_10 margin_b_0">-->
<!--            <p class="font_size_12 margin_b_0">Wyrażam zgodę na przekazanie moich danych osobowych następującym podmiotom:</p>-->
<!--            <p class="font_size_12 margin_b_0">-->
<!--                a) DSA Investment S.A. Al. Wiśniowa 47, 53-126 Wrocław w zakresie danych teleadresowych w celu sporządzenia oferty produktów finansowych-->
<!--                i ubezpieczeń osobowych:<br>-->
<!--                <span class="glyphicon glyphicon--><?php //echo ($umowa_dane['ZgodaDaneDSA'] == 1) ? '-check' : '-unchecked'; ?><!--" aria-hidden="true"></span> Tak-->
<!--                <span class="glyphicon glyphicon--><?php //echo ($umowa_dane['ZgodaDaneDSA'] == 0) ? '-check' : '-unchecked'; ?><!--" aria-hidden="true"></span> Nie-->
<!--            </p>-->
<!--            <p class="font_size_12 margin_b_0">-->
<!--                b) Protecta sp. z o.o., Kościuszki 16b/4-5, 87-800 Włocławek w zakresie danych teleadresowych w celu sporządzenia oferty usług dla przedsiębiorców:<br>-->
<!--                <span class="glyphicon glyphicon--><?php //echo ($umowa_dane['ZgodaDaneProtecta'] == 1) ? '-check' : '-unchecked'; ?><!--" aria-hidden="true"></span> Tak-->
<!--                <span class="glyphicon glyphicon--><?php //echo ($umowa_dane['ZgodaDaneProtecta'] == 0) ? '-check' : '-unchecked'; ?><!--" aria-hidden="true"></span> Nie-->
<!--            </p>-->
<!--            <p class="font_size_12 margin_b_0">-->
<!--                c) Polskiemu Centrum Rehabilitacji Funkcjonalnej Votum S.A. Sp. k., Golikówka 6, 30-723 Kraków w zakresie danych zawartych w umowie-->
<!--                i przekazanej dokumentacji, w tym stanu zdrowia w celu sporządzenia oferty rehabilitacji:<br>-->
<!--                <span class="glyphicon glyphicon--><?php //echo ($umowa_dane['ZgodaPCRF'] == 1) ? '-check' : '-unchecked'; ?><!--" aria-hidden="true"></span> Tak-->
<!--                <span class="glyphicon glyphicon--><?php //echo ($umowa_dane['ZgodaPCRF'] == 0) ? '-check' : '-unchecked'; ?><!--" aria-hidden="true"></span> Nie-->
<!--            </p>-->
<!--            <p class="font_size_12 margin_b_0">-->
<!--                d) pomocy przez Fundację VOTUM, ul. Wyścigowa 56i, 53-012 Wrocław w zakresie danych zawartych w umowie i przekazanej dokumentacji,-->
<!--                w tym stanu zdrowia w celu przedstawienia możliwego zakresu pomocy:<br>-->
<!--                <span class="glyphicon glyphicon--><?php //echo ($umowa_dane['ZgodaFundacja'] == 1) ? '-check' : '-unchecked'; ?><!--" aria-hidden="true"></span> Tak-->
<!--                <span class="glyphicon glyphicon--><?php //echo ($umowa_dane['ZgodaFundacja'] == 0) ? '-check' : '-unchecked'; ?><!--" aria-hidden="true"></span> Nie-->
<!--            </p>-->
<!--            <p class="font_size_12 margin_b_0">-->
<!--                Oświadczam, że jestem świadomy(a) dobrowolności udostępnienia moich danych osobowych oraz że zostałem(am) poinformowany(a)-->
<!--                o prawie wglądu do moich danych oraz ich poprawiania, zgodnie z postanowieniami ustawy z dnia 29 sierpnia 1997r. o ochronie danych-->
<!--                osobowych (Dz.U. z 2016 r. poz. 922).-->
<!--            </p>-->
<!---->
<!--            <div class="clear_b"></div>-->
<!---->
<!--            <div class="col-md-12 padding_l_40 padding_r_40 margin_t_20">-->
<!--                <div class="form-group col-md-5 margin_t_5 float_r">-->
<!--                    <div class="pdf_kreska"></div>-->
<!--                    <p class="text_a_center font_size_10">Podpis Klienta/Osoby działającej w imieniu Klienta</p>-->
<!--                </div>-->
<!--            </div>-->
<!---->
<!--            <p class="font_size_12 margin_b_0">Wyrażam zgodę na wykonywanie następujących czynności przez:</p>-->
<!--            <p class="font_size_12 margin_b_0">1. DSA Investment S.A. Al. Wiśniowa 47, 53-126 Wrocław, KRS nr 0000391830:</p>-->
<!--            <p class="font_size_12 margin_b_0">-->
<!--                a) przesyłanie informacji handlowych za pośrednictwem środków komunikacji elektronicznej zgodnie z ustawą z dn. 08.07.2002 r. o świadczeniu usług drogą elektron-iczną (Dz.U. z 2017 r. poz. 1219):<br>-->
<!--            <span class="glyphicon glyphicon--><?php //echo ($umowa_dane['ZgodaInfDSA'] == 1) ? '-check' : '-unchecked'; ?><!--" aria-hidden="true"></span> Tak-->
<!--            <span class="glyphicon glyphicon--><?php //echo ($umowa_dane['ZgodaInfDSA'] == 0) ? '-check' : '-unchecked'; ?><!--" aria-hidden="true"></span> Nie </p>-->
<!--            <p class="font_size_12 margin_b_0">-->
<!--                b) przekazywanie treści marketingowych na podany przeze mnie nr telefonu w tym przy użyciu automatycznych systemów wywołują cych w rozumieniu ustawy z dn.16.07.2004 r. Prawo telekomunikacyjne (t. j. Dz.U. z 2017 r. poz. 1907):<br>-->
<!--            <span class="glyphicon glyphicon--><?php //echo ($umowa_dane['ZgodaMarketingDSA'] == 1) ? '-check' : '-unchecked'; ?><!--" aria-hidden="true"></span> Tak-->
<!--            <span class="glyphicon glyphicon--><?php //echo ($umowa_dane['ZgodaMarketingDSA'] == 0) ? '-check' : '-unchecked'; ?><!--" aria-hidden="true"></span> Nie </p>-->
<!---->
<!--            <p class="font_size_12 margin_b_0">2. VOTUM S.A., ul. Wyścigowa 56i, 53-012 Wrocław, KRS nr 0000243252:</p>-->
<!--            <p class="font_size_12 margin_b_0">-->
<!--                a) przesyłanie informacji handlowych za pośrednictwem środków komunikacji elektronicznej zgodnie z ustawą z dn. 08.07.2002 r. o świadczeniu usług drogą elektroniczną (t. j. Dz.U. z 2017 r. poz. 1219):<br>-->
<!--            <span class="glyphicon glyphicon--><?php //echo ($umowa_dane['ZgodaInfVotum'] == 1) ? '-check' : '-unchecked'; ?><!--" aria-hidden="true"></span> Tak-->
<!--            <span class="glyphicon glyphicon--><?php //echo ($umowa_dane['ZgodaInfVotum'] == 0) ? '-check' : '-unchecked'; ?><!--" aria-hidden="true"></span> Nie </p>-->
<!--            <p class="font_size_12 margin_b_0">-->
<!--                b) przekazywanie treści marketingowych na podany przeze mnie nr telefonu w tym przy użyciu automatycznych systemów wywołują cych w rozumieniu ustawy z dn.16.07.2004 r. Prawo telekomunikacyjne (t. j. Dz.U. z 2017 r. poz. 1907):<br>-->
<!--            <span class="glyphicon glyphicon--><?php //echo ($umowa_dane['ZgodaMarketingVotum'] == 1) ? '-check' : '-unchecked'; ?><!--" aria-hidden="true"></span> Tak-->
<!--            <span class="glyphicon glyphicon--><?php //echo ($umowa_dane['ZgodaMarketingVotum'] == 0) ? '-check' : '-unchecked'; ?><!--" aria-hidden="true"></span> Nie </p>-->
<!---->
<!--            <div class="col-md-12 padding_l_40 padding_r_40 margin_t_20">-->
<!--                <div class="form-group col-md-5 margin_t_5 float_r">-->
<!--                    <div class="pdf_kreska"></div>-->
<!--                    <p class="text_a_center font_size_10">Podpis Klienta/Osoby działającej w imieniu Klienta</p>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->

        <div class="clear_b"></div>
        <div class="stopka_pionowa"><?php echo $stopka; ?></div>
        <div class="stopka_pozioma_dol"><p class="text_a_center margin_b_0">3/3</p></div>
    </div>
<div class="pdf_strona">
    <div class="">
        <div class="pdfs_tytu_doumentu_zalacznik">
            <p class="margin_b_0"></p>
            <p class="margin_b_30 margin_t_120 pdf_duze_litery font_w_70055">ZAŁĄCZNIK - Klauzula informacyjna dla klienta</p>
        </div>
        <div class="pdfs_logo margin_t_30"><img src="<?php echo 'https://' . $_SERVER ['HTTP_HOST']; ?>/img/logo.png" /></div>
    </div>
    <p class="margin_b_30 margin_t_50 font_w_700">§1 Informacje</p>
    <ol class="roman">
        <li class="margin_b_10">VOTUM S.A. z siedzibą we Wrocławiu informuje, że w związku z obowiązkami wynikającymi z ogólnego rozporządzenia o ochronie danych osobowych z dnia 27 kwietnia 2016 r. (RODO), dane osobowe podane przez Klienta w umowie i załącznikach do umowy, jak również dane uzyskane w trakcie jej wykonywania będą przetwarzane przez VOTUM S.A. z siedzibą we Wrocławiu, ul. Wyścigowa 56i, 53-012 Wrocław, wpisana do rejestru przedsiębiorców KRS pod numerem 0000243252 (dalej „Spółka”), która stanie się Administratorem tych danych.</li>
        <li class="margin_b_10">Uzyskanie informacji o procesach przetwarzania danych osobowych możliwe jest poprzez kontakt z Inspektorem Ochrony Danych w formie elektronicznej: e-mail iod@votum-sa.pl lub pisemnej: Inspektor Ochrony Danych, ul. Wyścigowa 56i, 53-012 Wrocław. </li>
        <li class="margin_b_10">Dane osobowe przetwarzane będą w następujących celach oraz na podstawie następujących przesłanek:
            <ol class="numerowanie">
                <li>Wykonie umowy na rzecz klienta, podstawą prawną jest art. 6 ust. 1 lit b RODO.</li>
                <li>Marketing usług własnych, wykorzystywane do tego celu będą środki komunikacji w tym telefon oraz email, podstawą prawną jest art. 6 ust. 1 lit. f) RODO.</li>
                <li>Zapewnienie prawidłowości podatkowych po wystawieniu faktury, podstawą prawna jest art. 6 ust. 1 lit. c) RODO uszczegółowienie w art. 70 §1 Ordynacji Podatkowej</li>
                <li>W przypadku wyrażenia dodatkowych zgód (art. 6 ust.1 lit a), dane osobowe będą przetwarzane w celu zaproponowania usług podmiotów powiązanych z VOTUM S.A wskazanym w §2 poniżej</li>
            </ol>
        </li>
        <li class="margin_b_10">Dane osobowe udostępnione będą bankom udzielającym kredytów indeksowanych bądź denominowanych do waluty obcej w związku z zastosowaną indeksacją oraz ubezpieczeń z nimi powiązanym, a w razie takiej potrzeby - organom państwowym.</li>
        <li class="margin_b_10">W zależności o celu przetwarzania dane osobowe Klienta będą przetwarzane przez następujący okres czasu:
            <ol class="numerowanie">
                <li>W związku z możliwością podniesienia roszczeń z kodeksu cywilnego, przez okres do 10 lat od momentu zakończenia umowy. </li>
                <li>W związku z możliwością pojawienia się nowych ofert, przez okres do 10 lat od momentu zakończenia umowy lub do momentu wniesienia sprzeciwu na marketing usług VOTUM S.A.</li>
                <li>W związku z wymogami ustawy, przez okres 5 lat + bieżący rok podatkowy od momenty wystawienia faktury</li>
                <li>W związku z możliwością pojawienia się nowych ofert, przez okres do 10 lat od momentu zakończenia umowy lub do momentu wniesienia sprzeciwu na marketing wskazanego podmiotu.</li>
            </ol>
        </li>
        <li class="margin_b_10">Klient ma prawo dostępu do swoich danych, ich sprostowania, usunięcia lub ograniczenia przetwarzania a także do wniesienia sprzeciwu wobec przetwarzania danych, w tym na marketing usług własnych VOTUM S.A. Klient jest uprawniony do cofnięcia wyrażonej zgody na przetwarzanie danych w każdym czasie, a także do wniesienia skargi w związku z przetwarzaniem danych do organu nadzorczego – Prezesa Urzędu Ochrony Danych Osobowych. </li>
        <li class="margin_b_10">Podanie danych jest dobrowolne jednakże niezbędne dla celów wykonania umowy.
            W przypadku braku podania danych lub niewyrażenia zgody na ich przetwarzanie, realizacja umowy może stać się niemożliwa.
        </li>
        <li class="margin_b_10">Dane osobowe wskazane w umowie, będą podlegały profilowaniu, które ma na celu dopasowanie i zaproponowanie Klientowi nowych usług. Każdorazowo przed podjęciem decyzji w tym przedmiocie dane osobowe będą weryfikowane przez pracownika VOTUM S.A.</li>
    </ol>
    <p class="margin_t_15">Oświadczam, że zapoznałem się z treścią informacji zawartych w §1</p>
    <div class="pdf_podpisy col-md-12 paddding_l_0 paddding_r_0 margin_t_60 margin_b_20">
        <div class="pdf_podpisy_p float_r col-md-6 paddding_l_0 paddding_r_0">
            <div class="pdf_kreska col-md-12 paddding_l_0 paddding_r_0 margin_b_0 "></div>
            <p class="margin_b_0 font_size_10 text_a_right">podpis Klienta/osoby działającej w imieniu Klienta</p>
        </div>
        <div class="clear_b"></div>
    </div>
    <div class="pdf_strona_stopka col-md-12 margin_b_0">
        <div class="pdf_strona_stopka_wersja"></div>
        <p class="text_a_center margin_b_0"></p>
    </div>
</div>

<div class="pdf_strona pdf_strona_zalacznik">
    <div class="pdfs_logo margin_t_30"><img src="<?php echo 'https://' . $_SERVER ['HTTP_HOST']; ?>/img/logo.png" /></div>
    <p class="margin_b_30 margin_t_50 font_w_700">§2 Zgody Klienta</p>
    <ol class="roman">
        <li class="margin_b_10">Wyrażam zgodę na przekazanie moich danych kontaktowych (telefon, adres poczty elektronicznej, adres zamieszkania) następującym podmiotom
            <ol class="numerowanie">
                <li class="margin_b_10"><b>DSA Investment S.A.</b>Al. Wiśniowa 47, 53-126 Wrocław, KRS: 0000391830, w zakresie danych teleadresowych w celu sporządzenia oferty produktów finansowych i ubezpieczeń osobowych: <br />
                    <span class="glyphicon glyphicon<?php echo ($umowa_dane['ZgodaDaneDSA'] == 1) ? '-check' : '-unchecked'; ?>" aria-hidden="true"></span> Tak
                    <span class="glyphicon glyphicon<?php echo ($umowa_dane['ZgodaDaneDSA'] == 0) ? '-check' : '-unchecked'; ?>" aria-hidden="true"></span> Nie
                </li class="margin_b_10">
                <li><b>Polskie Centrum Rehabilitacji Funkcjonalnej Votum S.A. Sp. k.</b> Golikówka 6, 30-723 Kraków, KRS: 0000290430  , w zakresie danych zawartych w umowie i przekazanej dokumentacji, w tym stanu zdrowia w celu sporządzenia oferty rehabilitacji: <br />
                    <span class="glyphicon glyphicon<?php echo ($umowa_dane['ZgodaDanePCRF'] == 1) ? '-check' : '-unchecked'; ?>" aria-hidden="true"></span> Tak
                    <span class="glyphicon glyphicon<?php echo ($umowa_dane['ZgodaDanePCRF'] == 0) ? '-check' : '-unchecked'; ?>" aria-hidden="true"></span> Nie
                </li>
                <li class="margin_b_10"><b>Fundacja VOTUM</b> ul. Wyścigowa 56i, 53-012 Wrocław, KRS: 0000272272, w zakresie danych zawartych w umowie i przekazanej dokumentacji, w tym stanu zdrowia w celu przedstawienia możliwego zakresu pomocy: <br />
                    <span class="glyphicon glyphicon<?php echo ($umowa_dane['ZgodaDaneFundacja'] == 1) ? '-check' : '-unchecked'; ?>" aria-hidden="true"></span> Tak
                    <span class="glyphicon glyphicon<?php echo ($umowa_dane['ZgodaDaneFundacja'] == 0) ? '-check' : '-unchecked'; ?>" aria-hidden="true"></span> Nie
                </li>
                <li class="margin_b_10"><b>AUTOVOTUM S.A.</b> ul. Wyścigowa 56i, 53-012 Wrocław, KRS: 0000273033, w zakresie danych teleadresowych w celu sporządzenia oferty usług wynajmu pojazdów zastępczych; <br />
                    <span class="glyphicon glyphicon<?php echo ($umowa_dane['ZgodaDaneAutovotum'] == 1) ? '-check' : '-unchecked'; ?>" aria-hidden="true"></span> Tak
                    <span class="glyphicon glyphicon<?php echo ($umowa_dane['ZgodaDaneAutovotum'] == 0) ? '-check' : '-unchecked'; ?>" aria-hidden="true"></span> Nie
                </li>
                <li class="margin_b_10"><b>Biuro Ekspertyz Procesowych sp. z o.o.</b> Aleja Wiśniowa 47, 53-126 Wrocław, KRS:  0000565095, w zakresie danych teleadresowych w celu sporządzenia oferty cesji wierzytelności dotyczącej szkody w pojeździe. <br />
                    <span class="glyphicon glyphicon<?php echo ($umowa_dane['ZgodaDaneBEP'] == 1) ? '-check' : '-unchecked'; ?>" aria-hidden="true"></span> Tak
                    <span class="glyphicon glyphicon<?php echo ($umowa_dane['ZgodaDaneBEP'] == 0) ? '-check' : '-unchecked'; ?>" aria-hidden="true"></span> Nie
                </li>
            </ol>
        </li>
        <li class="margin_b_10">Wyrażam zgodę na wykonywanie następujących czynności przez:
            <ol class="numerowanie">
                <li class="margin_b_10"><b>DSA Investment S.A., Al. Wiśniowa 47,53-126 Wrocław,</b>
                    <ol class="numerowanie_alfabet_male">
                        <li class="margin_b_10">Przesłanie informacji handlowych za pośrednictwem środków komunikacji elektronicznej, zgodnie z ustawą z dnia 08.07.2002 r. o świadczeniu usług drogą elektroniczną (Dz.U. z 2016 r. poz.1030): <br />
                            <span class="glyphicon glyphicon<?php echo ($umowa_dane['ZgodaInfDSA'] == 1) ? '-check' : '-unchecked'; ?>" aria-hidden="true"></span> Tak
                            <span class="glyphicon glyphicon<?php echo ($umowa_dane['ZgodaInfDSA'] == 0) ? '-check' : '-unchecked'; ?>" aria-hidden="true"></span> Nie
                        </li>
                        <li class="margin_b_10">Przekazywanie treści marketingowych na podany przez mnie nr telefonu w tym przy użyciu automatycznych systemów wywołujących w rozumieniu ustawy z dnia 17.07.2004 r. Prawo telekomunikacyjne (Dz.U. z 2016 r. poz. 1489): <br />
                            <span class="glyphicon glyphicon<?php echo ($umowa_dane['ZgodaMarketingDSA'] == 1) ? '-check' : '-unchecked'; ?>" aria-hidden="true"></span> Tak
                            <span class="glyphicon glyphicon<?php echo ($umowa_dane['ZgodaMarketingDSA'] == 0) ? '-check' : '-unchecked'; ?>" aria-hidden="true"></span> Nie
                        </li>
                    </ol>
                </li>
                <li class="margin_b_10"><b>VOTUM S.A., ul. Wyścigowa 56i, 53-012 Wrocław,  </b>
                    <ol class="numerowanie_alfabet_male">
                        <li class="margin_b_10">przesyłanie informacji handlowych za pośrednictwem środków komunikacji elektronicznej zgodnie z 	ustawą z dn. 08.07.2002 r. o świadczeniu usług drogą elektroniczną (t. j. Dz.U. z 2017 r. poz. 1219): <br />
                            <span class="glyphicon glyphicon<?php echo ($umowa_dane['ZgodaInfVotum'] == 1) ? '-check' : '-unchecked'; ?>" aria-hidden="true"></span> Tak
                            <span class="glyphicon glyphicon<?php echo ($umowa_dane['ZgodaInfVotum'] == 0) ? '-check' : '-unchecked'; ?>" aria-hidden="true"></span> Nie
                        </li>
                        <li class="margin_b_10">przekazywanie treści marketingowych na podany przeze mnie nr telefonu w tym przy użyciu 	automatycznych 	systemów wywołują¬cych w rozumieniu ustawy z dn.16.07.2004 r. Prawo 	telekomunikacyjne (t. j. Dz.U. z 2017 r. poz. 	1907): <br />
                            <span class="glyphicon glyphicon<?php echo ($umowa_dane['ZgodaMarketingVotum'] == 1) ? '-check' : '-unchecked'; ?>" aria-hidden="true"></span> Tak
                            <span class="glyphicon glyphicon<?php echo ($umowa_dane['ZgodaMarketingVotum'] == 0) ? '-check' : '-unchecked'; ?>" aria-hidden="true"></span> Nie
                        </li>
                    </ol>
                </li>
            </ol>
        </li>
    </ol>
    <div class="pdf_podpisy col-md-12 paddding_l_0 paddding_r_0 margin_t_60 margin_b_20">
        <div class="pdf_podpisy_p float_r col-md-6 paddding_l_0 paddding_r_0">
            <div class="pdf_kreska col-md-12 paddding_l_0 paddding_r_0 margin_b_0 "></div>
            <p class="margin_b_0 font_size_10 text_a_right">podpis Klienta/osoby działającej w imieniu Klienta</p>
        </div>
        <div class="clear_b"></div>
    </div>
    <div class="pdf_strona_stopka col-md-12 margin_b_0">
        <div class="pdf_strona_stopka_wersja"></div>
        <p class="text_a_center margin_b_0"></p>
    </div>
</div>