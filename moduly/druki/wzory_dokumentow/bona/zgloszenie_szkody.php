<?php
    setlocale ( LC_CTYPE, "pl_PL.UTF-8" );

    $umowa = json_decode($_POST['umowa'], true);
    $klient = json_decode($_POST['klient'], true);
    $wynagrodzenie = json_decode($_POST['wynagrodzenie'], true);
    $umowa_dane = json_decode($_POST['umowa_dane'], true);
    $lista_dostepnej_dokumentacji = json_decode($_POST['lista_dostepnej_dokumentacji']);
    $lista_pobranej_dokumentacji = $_POST['lista_pobranej_dokumentacji'];



    $stopka = 'PG-2-18-F3/2017-01-09';
?>


<link rel="stylesheet" href="<?php echo 'https://' . $_SERVER ['HTTP_HOST'] . '/biblioteki/bootstrap/css/bootstrap.css'; ?>" type="text/css" />
<link rel="stylesheet" href="<?php echo 'https://' . $_SERVER ['HTTP_HOST'] . '/moduly/druki/wzory_dokumentow/css/wzory_dokumentow.css'; ?>" type="text/css" />
<script id="skrypty" type="text/javascript" src="<?php echo 'https://' . $_SERVER ['HTTP_HOST'] . '/biblioteki/jQuery/jquery.min.js'; ?>"></script>
<script id="skrypty" type="text/javascript" src="<?php echo 'https://' . $_SERVER ['HTTP_HOST'] . '/moduly/druki/wzory_dokumentow/js/wzory_dokumentow.js'; ?>"></script>

<div class="pdf_strona">
    <div class="pdf_strona_pierwsza_naglowek">
        <div class="pdfs_przedstawiciel_dane">
            <div class="form-group col-md-3 padding_l_0">
                <div class="pdf_kratka"><?php echo $klient['Nazwisko']; ?></div>
                <label class="pdf_duze_litery font_size_10 no_bold">IDENTYFIKATOR PRZEDSTAWICIELA</label>
            </div>
            <div class="form-group col-md-6 padding_l_0">
                <div class="pdf_kratka_podpis"><?php echo $klient['Nazwisko']; ?></div>
                <label class="pdf_duze_litery font_size_10 no_bold">PODPIS PRZEDSTAWICIELA</label>
            </div>
            <div class="clear_b"></div>
            <div class="pdf_kratka"><?php echo $umowa['KodJednostki']; ?></div>
            <p class="pdf_duze_litery font_size_10 margin_b_4 margin_t_2">kod jednostki</p>
            <div class="pdf_kratka"><?php echo $umowa['KodKonsultanta']; ?></div>
            <p class="pdf_duze_litery font_size_10 margin_b_4 margin_t_2">kod konsultanta</p>
            <div class="pdf_kratka"></div>
            <p class="pdf_duze_litery font_size_10 margin_b_0 margin_t_2">nr sprawy</p>
        </div>
        <div class="pdfs_tytu_dokumentu">
            <p class="margin_b_0">ZGŁOSZENIE SZKODY</p>
            <p class="margin_b_0 font_size_26 font_w_700">NA MIENIU / ZAMÓWIENIE</p>
        </div>
        <div class="pdfs_logo"><img src="<?php echo 'https://' . $_SERVER ['HTTP_HOST']; ?>/img/logo.png" /></div>
    </div>

    <div class="pdf_czerwona_kratka pdf_kratka_duza kratka_naglowek margin_t_20">
        <div class="pdf_kratka_duza_naglowek_zgloszenie font_w_700 pdf_duze_litery">ZLECENIODAWCA</div>
        <div class="form-group col-md-6 margin_t_5">
            <label class="pdf_duze_litery font_size_10">imie</label>
            <div class="pdf_kratka"><?php echo $klient['Imie']; ?></div>
        </div>
        <div class="form-group col-md-6 margin_t_5">
            <label class="pdf_duze_litery font_size_10">nazwisko</label>
            <div class="pdf_kratka"><?php echo $klient['Nazwisko']; ?></div>
        </div>
        <p class="pdf_duze_litery font_w_700 font_size_10 col-md-12 margin_b_4">adres zameldowania zleceniodawcy</p>
        <div class="form-group col-md-4">
            <label class="pdf_duze_litery font_size_10">ulica</label>
            <div class="pdf_kratka"><?php echo $klient['Ulica']; ?></div>
        </div>
        <div class="form-group col-md-1 paddding_r_0">
            <label class="pdf_duze_litery font_size_10 ">nr domu /</label>
            <div class="pdf_kratka"><?php echo $klient['NrDomu']; ?></div>
        </div>
        <div class="form-group col-md-1 paddding_l_0">
            <label class="pdf_duze_litery font_size_10">mieszkania</label>
            <div class="pdf_kratka"><?php echo $klient['NrMieszkania']; ?></div>
        </div>
        <div class="form-group col-md-2">
            <label class="pdf_duze_litery font_size_10">kod pocztowy</label>
            <div class="pdf_kratka"><?php echo $klient['KodPocztowy']; ?></div>
        </div>
        <div class="form-group col-md-4">
            <label class="pdf_duze_litery font_size_10">miejscowość</label>
            <div class="pdf_kratka"><?php echo $klient['Miasto']; ?></div>
        </div>
        <p class="pdf_duze_litery font_w_700 font_size_10 col-md-12 margin_b_4">adres korespondencyjny zleceniodawcy (jeśli jest inny niż zameldowania)</p>
        <div class="form-group col-md-4">
            <label class="pdf_duze_litery font_size_10">ulica</label>
            <div class="pdf_kratka"><?php echo $klient['Ulica']; ?></div>
        </div>
        <div class="form-group col-md-1 paddding_r_0">
            <label class="pdf_duze_litery font_size_10 ">nr domu /</label>
            <div class="pdf_kratka"><?php echo $klient['NrDomu']; ?></div>
        </div>
        <div class="form-group col-md-1 paddding_l_0">
            <label class="pdf_duze_litery font_size_10">mieszkania</label>
            <div class="pdf_kratka"><?php echo $klient['NrMieszkania']; ?></div>
        </div>
        <div class="form-group col-md-2">
            <label class="pdf_duze_litery font_size_10">kod pocztowy</label>
            <div class="pdf_kratka"><?php echo $klient['KodPocztowy']; ?></div>
        </div>
        <div class="form-group col-md-4">
            <label class="pdf_duze_litery font_size_10">miejscowość</label>
            <div class="pdf_kratka"><?php echo $klient['Miasto']; ?></div>
        </div>
        <div class="form-group col-md-2">
            <label class="pdf_duze_litery font_size_10">pesel</label>
            <div class="pdf_kratka"><?php echo $klient['Pesel']; ?></div>
        </div>
        <div class="form-group col-md-3">
            <label class="pdf_duze_litery font_size_10">telefon</label>
            <div class="pdf_kratka"><?php echo $klient['Telefon']; ?></div>
        </div>
        <div class="form-group col-md-5">
            <label class="pdf_duze_litery font_size_10">e-mail</label>
            <div class="pdf_kratka"><?php echo $klient['Telefon']; ?></div>
        </div>
        <div class="form-group col-md-2">
            <label class="pdf_duze_litery font_size_10">seria i numer dowodu</label>
            <div class="pdf_kratka"><?php echo $klient['Dowod']; ?></div>
        </div>
        <div class="form-group col-md-7">
            <label class="pdf_duze_litery font_size_12"><span class="glyphicon glyphicon<?php echo ($umowa_dane['NadplaconeRaty'] == 1) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span>Oświadczam, że prowadzę pozaroliczą działalność gospodarczą.</label>
        </div>
        <div class="form-group col-md-5">
            <label class="pdf_duze_litery font_size_12"><span class="glyphicon glyphicon<?php echo ($umowa_dane['NadplaconeRaty'] == 1) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span>Oświadczam, że jestem płatnikiem podatku VAT.</label>
        </div>
        <div class="form-group col-md-4">
            <label class="pdf_duze_litery font_size_10">NIP</label>
            <div class="pdf_kratka"><?php echo $klient['Miasto']; ?></div>
        </div>
        <div class="form-group col-md-4">
            <label class="pdf_duze_litery font_size_10">REGON</label>
            <div class="pdf_kratka"><?php echo $klient['Pesel']; ?></div>
        </div>
        <div class="form-group col-md-4">
            <label class="pdf_duze_litery font_size_10">KRS</label>
            <div class="pdf_kratka"><?php echo $klient['Telefon']; ?></div>
        </div>
    </div>
    <div class="pdf_czerwona_kratka pdf_kratka_duza kratka_naglowek">
        <div class="pdf_kratka_duza_naglowek_zgloszenie font_w_700 pdf_duze_litery">UPRAWNIONY DO UZYSKANIA INFORMACJI TELEFONICZNEJ</div>
        <div class="form-group col-md-4 margin_t_5">
            <label class="pdf_duze_litery font_size_10">IMIĘ</label>
            <div class="pdf_kratka"><?php echo $klient['Miasto']; ?></div>
        </div>
        <div class="form-group col-md-4 margin_t_5">
            <label class="pdf_duze_litery font_size_10">NAZWISKO</label>
            <div class="pdf_kratka"><?php echo $klient['Pesel']; ?></div>
        </div>
        <div class="form-group col-md-4 margin_t_5">
            <label class="pdf_duze_litery font_size_10">PESEL</label>
            <div class="pdf_kratka"><?php echo $klient['Telefon']; ?></div>
        </div>
    </div>

    <div class="pdf_szara_kratka pdf_kratka_duza kratka_naglowek">
        <div class="pdf_kratka_duza_naglowek_zgloszenie font_w_700">Informacje o zdarzeniu z dnia: <?php echo '?DANE?'; ?> godziny: <?php echo '?DANE?'; ?></div>
        <div class="form-group col-md-12 margin_t_5">
            <label class="font_size_14">Przyczyna powstania szkody (np. powódź, podtopienie, silny wiatr, pożar, przymrozek, kolizja drogowa, itp.)</label>
            <div class="pdf_kratka"><?php echo $klient['Miasto']; ?></div>
        </div>
    </div>

    <div class="pdf_szara_kratka pdf_kratka_duza kratka_naglowek">
        <div class="pdf_kratka_szara_duza_naglowek_zgloszenie font_w_700">OPIS POWSTAŁYCH SZKÓD - DOKŁADNA LOKALIZACJA PRZEDMIOTU SZKODY</div>
        <div class="form-group col-md-12 margin_t_5">
            <p class="margin_b_0">Ogólnie znana teza głosi, iż użytkownika może rozpraszać zrozumiała zawartość strony, kiedy ten chce zobaczyć sam jej wygląd.
                Jedną z mocnych stron używania Lorem Ipsum jest to, że ma wiele różnych „kombinacji” zdań, słów i akapitów, w przeciwieństwie do zwykłego: „tekst, tekst, tekst”, sprawiającego,
                że wygląda to „zbyt czytelnie” po polsku. Wielu webmasterów i designerów używa Lorem Ipsum jako domyślnego modelu tekstu i wpisanie w internetowej wyszukiwarce ‘lorem ipsum’
                spowoduje znalezienie bardzo wielu stron, które wciąż są w budowie. Wiele wersji tekstu ewoluowało i zmieniało się przez lata, czasem przez przypadek, czasem specjalnie (humorystyczne wstawki itd).</p>
        </div>
    </div>

    <div class="pdf_szara_kratka pdf_kratka_duza kratka_naglowek">
        <div class="pdf_kratka_szara_duza_naglowek_zgloszenie font_w_700">POSIADANE POLISY UBEZPIECZENIA MIENIA</div>
        <div class="form-group col-md-12 margin_t_5">
            <div class="form-group col-md-4">
                <label class="pdf_duze_litery font_size_10">ZAKŁAD UBEZPIECZEŃ</label>
            </div>
            <div class="form-group col-md-4">
                <label class="pdf_duze_litery font_size_10">NAZWA POLISY</label>
            </div>
            <div class="form-group col-md-4">
                <label class="pdf_duze_litery font_size_10">NUMER POLISY</label>
            </div>

            <?php
            for ($i=0; $i<3; $i++) {
                ?>
                <div class="form-group col-md-4">
                    <div class="pdf_kratka"><?php echo $klient['Miasto']; ?></div>
                </div>
                <div class="form-group col-md-4">
                    <div class="pdf_kratka"><?php echo $klient['Pesel']; ?></div>
                </div>
                <div class="form-group col-md-4">
                    <div class="pdf_kratka"><?php echo $klient['Telefon']; ?></div>
                </div>

                <?php
            }
            ?>
            <div class="form-group col-md-12">
                <p class="margin_b_0"><span class="glyphicon glyphicon<?php echo ($umowa_dane['NadplaconeRaty'] == 1) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span> nie zgłoszono szkody do zakładu ubezpieczeń</p>
            </div>
            <div class="form-group col-md-12">
                <p class="margin_b_0"><span class="glyphicon glyphicon<?php echo ($umowa_dane['NadplaconeRaty'] == 1) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span> zgłoszono szkodę do zakładu ubezpieczeń, data zgłoszenia <?php echo '?DANE?'; ?></p>
            </div>
            <div class="form-group col-md-12">
                <p class="margin_b_0">Odszkodowania: <span class="glyphicon glyphicon<?php echo ($umowa_dane['NadplaconeRaty'] == 1) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span> nie wypłacono / <span class="glyphicon glyphicon<?php echo ($umowa_dane['NadplaconeRaty'] == 1) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span>
                    wypłacono w kwocie <?php echo '?DANE?'; ?> zł numer szkody nadany przez zakład ubezpieczeń <div class="pdf_kratka"><?php echo '?DANE?'; ?></div></p>
            </div>
        </div>
    </div>

    <div class="pdf_podpisy col-md-12 paddding_l_0 paddding_r_0 margin_t_60 margin_b_20">
        <div class="pdf_podpisy_p float_r col-md-6 paddding_l_0 paddding_r_0">
            <div class="pdf_kreska col-md-12 paddding_l_0 paddding_r_0 margin_b_0"></div>
            <p class="margin_b_0 font_size_10 pdf_duze_litery text_a_right">podpis zleceniodawcY</p>
        </div>
        <div class="clear_b"></div>
    </div>


    <div class="pdf_strona_stopka col-md-12 margin_b_0">
        <div class="pdf_strona_stopka_wersja"><?php echo $stopka; ?></div>
        <p class="text_a_center margin_b_0">1/2</p>
    </div>
</div>
<div class="pdf_strona">

    <div class="pdf_szara_kratka pdf_kratka_duza kratka_naglowek">
        <div class="pdf_kratka_szara_duza_naglowek_zgloszenie font_w_700">INFORMACJE DOTYCZĄCE SZKODY:</div>
        <div class="form-group col-md-12 margin_t_5">
            <label class="font_size_15">1. Czy na miejscu zdarzenia były służby ratunkowe, policja, pogotowie? Jeśli tak, to jakie jednostki i z jakiej miejscowości?</label>
            <p class="margin_b_0">Ogólnie znana teza głosi, iż użytkownika może rozpraszać zrozumiała zawartość strony, kiedy ten chce zobaczyć sam jej wygląd.
                Wiele wersji tekstu ewoluowało i zmieniało się przez lata, czasem przez przypadek, czasem specjalnie (humorystyczne wstawki itd).</p>
        </div>
        <div class="form-group col-md-12 margin_t_5">
            <label class="font_size_15">2. Jeżeli prowadzone jest lub było prowadzone postepowanie - jaka jest sygnatura akt; jaki jest jego obecny etap lub jak zakończyło się?</label>
            <p class="margin_b_0">Ogólnie znana teza głosi, iż użytkownika może rozpraszać zrozumiała zawartość strony, kiedy ten chce zobaczyć sam jej wygląd.
                Wiele wersji tekstu ewoluowało i zmieniało się przez lata, czasem przez przypadek, czasem specjalnie (humorystyczne wstawki itd).</p>
        </div>
        <div class="form-group col-md-12 margin_t_5">
            <label class="font_size_15">3. Czy jest mozliwe przeprowadzenie oględzin uszkodzonego mienia; jeśli nie jest to możliwe, to z jakiej przyczyny?</label>
            <p class="margin_b_0">Ogólnie znana teza głosi, iż użytkownika może rozpraszać zrozumiała zawartość strony, kiedy ten chce zobaczyć sam jej wygląd.
                Wiele wersji tekstu ewoluowało i zmieniało się przez lata, czasem przez przypadek, czasem specjalnie (humorystyczne wstawki itd).</p>
        </div>
        <div class="form-group col-md-12 margin_t_5">
            <label class="font_size_15">4. Czy przedmiot szkody uległ całkowitemu zniszczeniu lub utracie; czy też możliwa jest jego odbudowa, naprawa lub odtworzenie?</label>
            <p class="margin_b_0">Ogólnie znana teza głosi, iż użytkownika może rozpraszać zrozumiała zawartość strony, kiedy ten chce zobaczyć sam jej wygląd.
                Wiele wersji tekstu ewoluowało i zmieniało się przez lata, czasem przez przypadek, czasem specjalnie (humorystyczne wstawki itd).</p>
        </div>
        <div class="form-group col-md-12 margin_t_5">
            <label class="font_size_15">5. Czy dokonano odbudowy, naprawy lub odtworzenia uszkodzonego mienia?</label>
            <p class="margin_b_0">Ogólnie znana teza głosi, iż użytkownika może rozpraszać zrozumiała zawartość strony, kiedy ten chce zobaczyć sam jej wygląd.
                Wiele wersji tekstu ewoluowało i zmieniało się przez lata, czasem przez przypadek, czasem specjalnie (humorystyczne wstawki itd).</p>
        </div>
        <div class="form-group col-md-12 margin_t_5">
            <label class="font_size_15">6. Jeżeli nie dokonano odbudowy, naprawy lub odtworzenia, to czy jest to planowane - jeśli tak, to w jakim terminie?</label>
            <p class="margin_b_0">Ogólnie znana teza głosi, iż użytkownika może rozpraszać zrozumiała zawartość strony, kiedy ten chce zobaczyć sam jej wygląd.
                Wiele wersji tekstu ewoluowało i zmieniało się przez lata, czasem przez przypadek, czasem specjalnie (humorystyczne wstawki itd).</p>
        </div>
        <div class="form-group col-md-12 margin_t_5">
            <label class="font_size_15">7. Czy odbudowa, naprawa lub odtworzenie zostało wykonane bądź będzie wykonane za pośrednictwem wyspecjalizowanego podmiotu czy też samodzielnie we własnym zakresie?</label>
            <p class="margin_b_0">Ogólnie znana teza głosi, iż użytkownika może rozpraszać zrozumiała zawartość strony, kiedy ten chce zobaczyć sam jej wygląd.
                Wiele wersji tekstu ewoluowało i zmieniało się przez lata, czasem przez przypadek, czasem specjalnie (humorystyczne wstawki itd).</p>
        </div>
        <div class="form-group col-md-12 margin_t_5">
            <label class="font_size_15">8. Jakimi dowodami dysponuje poszkodowany, które wskazują na rzeczywiste koszty odbudowy, naprawy lub odtworzenia (np. rachunki, faktury, kosztorys, wycena, oferta naprawy/odbudowy, ect>.)</label>
            <p class="margin_b_0">Ogólnie znana teza głosi, iż użytkownika może rozpraszać zrozumiała zawartość strony, kiedy ten chce zobaczyć sam jej wygląd.
                Wiele wersji tekstu ewoluowało i zmieniało się przez lata, czasem przez przypadek, czasem specjalnie (humorystyczne wstawki itd).</p>
        </div>
        <div class="form-group col-md-12 margin_t_5">
            <label class="font_size_15">9. Czy dokonana odbudowa, naprawa lub odtworzenie zostało wykonane przy zachowaniu dotychczasowych wymiarów, konstrukcji i materiałów czy też dokonano zmian w odniesieniu do stanu nim szkoda wystąpiła?</label>
            <p class="margin_b_0">Ogólnie znana teza głosi, iż użytkownika może rozpraszać zrozumiała zawartość strony, kiedy ten chce zobaczyć sam jej wygląd.
                Wiele wersji tekstu ewoluowało i zmieniało się przez lata, czasem przez przypadek, czasem specjalnie (humorystyczne wstawki itd).</p>
        </div>
    </div>

    <div class="pdf_szara_kratka pdf_kratka_duza kratka_naglowek">
        <div class="pdf_kratka_szara_duza_naglowek_zgloszenie font_w_700">DOCHODZENIE ROSZCZEŃ</div>
        <div class="form-group col-md-12 margin_t_5">
            <p class="margin_b_0"><span class="glyphicon glyphicon<?php echo ($umowa_dane['NadplaconeRaty'] == 1) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span> TAK <span class="glyphicon glyphicon<?php echo ($umowa_dane['NadplaconeRaty'] == 1) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span>
                NIE  dokonano przeniesienia praw wynikających z umowy ubezpieczenia (cesja) <?php echo '?DANE?'; ?></p>
            <p class="margin_b_0"><span class="glyphicon glyphicon<?php echo ($umowa_dane['NadplaconeRaty'] == 1) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span> nie zlecano wcześniej dochodzenia roszczeń żadnemu podmiotowi</p>
            <p class="margin_b_0"><span class="glyphicon glyphicon<?php echo ($umowa_dane['NadplaconeRaty'] == 1) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span> sprawę zlecono wcześniej pełnomocnikowi (nazwa) <?php echo '?DANE?'; ?> z którym zawarto umowę dnia <?php echo '?DANE?'; ?></p>
            <p class="margin_b_0"><span class="glyphicon glyphicon<?php echo ($umowa_dane['NadplaconeRaty'] == 1) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span> umowę z wyżej wymienionym wypowiedziano w dniu <?php echo '?DANE?'; ?></p>
            <p class="margin_b_0"> Przekazałem pełnomocnikowi VOTUM S.A. dokumentację składającą się z <?php echo '?DANE?'; ?> słownie <?php echo '?DANE?'; ?> kart.</p>
            <p class="margin_b_0"><span class="glyphicon glyphicon<?php echo ($umowa_dane['NadplaconeRaty'] == 1) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span> Wyrażam zgodę na otrzymywanie informacji związanych z wykonywaniem umowy poprzez:</p>
            <p class="margin_b_0"><span class="glyphicon glyphicon<?php echo ($umowa_dane['NadplaconeRaty'] == 1) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span> wiadomości tekstowe SMS / <span class="glyphicon glyphicon<?php echo ($umowa_dane['NadplaconeRaty'] == 1) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span> wiadomości e-mail na numer/adres przeze mnie wskazany.</p>
            <p class="margin_b_0"><span class="glyphicon glyphicon<?php echo ($umowa_dane['NadplaconeRaty'] == 1) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span> Jestem zainteresowany/a ofertą produktów finansowych i wyrażam zgodę na przekazywanie Protecta Finanse Sp. z o.o. we Włocławku moich danych
            osobowych w celach markeingowych, w szczególności w celu opracowania i przedstawienia oferty.</p>
            <p class="margin_b_0"><span class="glyphicon glyphicon<?php echo ($umowa_dane['NadplaconeRaty'] == 1) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span> Nie jestem zainteresowany/a ofertą produktów finansowych.</p>
        </div>
    </div>

    <div class="pdf_podpisy col-md-12 paddding_l_0 paddding_r_0 margin_t_50 margin_b_10">
        <div class="pdf_podpisy_l float_l col-md-4 paddding_l_0 paddding_r_0">
            <div class="pdf_kreska col-md-12 paddding_l_0 paddding_r_0 margin_b_0"></div>
            <p class="margin_b_0 font_size_10 pdf_duze_litery">MIEJSCOWOŚĆ I DATA.</p>
        </div>
        <div class="pdf_podpisy_p float_r col-md-6 paddding_l_0 paddding_r_0">
            <div class="pdf_kreska col-md-12 paddding_l_0 paddding_r_0 margin_b_0"></div>
            <p class="margin_b_0 font_size_10 pdf_duze_litery text_a_right">PODPIS ZLECENIODAWCY</p>
        </div>
        <div class="clear_b"></div>
    </div>

    <p class="margin_b_0 margin_t_10 font_w_700">Oświadczenie</p>
    <p class="">Ja niżej podpisany, jako pełnomocnik Zleceniobiorcy - VOTUM S.A., oświadczam, iż podpisy Zleceniodawcy na wszystkich dokumentach, tj. na umowie, pełnomocnictwie oraz zgłoszeniu szkody, zostały złożone w mojej obecności własnoręcznie przez Zleceniodawcę.</p>

    <div class="pdf_podpisy col-md-12 paddding_l_0 paddding_r_0 margin_t_50 margin_b_20">
        <div class="pdf_podpisy_l float_l col-md-4 paddding_l_0 paddding_r_0">
            <div class="pdf_kreska col-md-12 paddding_l_0 paddding_r_0 margin_b_0"></div>
            <p class="margin_b_0 font_size_10 pdf_duze_litery">IMIĘ I NAZWISKO PRZEDSTAWICIELA</p>
        </div>
        <div class="pdf_podpisy_p float_r col-md-6 paddding_l_0 paddding_r_0">
            <div class="pdf_kreska col-md-12 paddding_l_0 paddding_r_0 margin_b_0"></div>
            <p class="margin_b_0 font_size_10 pdf_duze_litery text_a_right">CZYTELNY PODPIS PRZEDSTAWICIELA</p>
        </div>
        <div class="clear_b"></div>
    </div>

    <div class="pdf_strona_stopka col-md-12 margin_b_0">
        <div class="pdf_strona_stopka_wersja"><?php echo $stopka; ?></div>
        <p class="text_a_center margin_b_0">2/2</p>
    </div>
</div>
