<?php
setlocale ( LC_CTYPE, "pl_PL.UTF-8" );

$umowa = json_decode($_POST['umowa'], true);
$umowa_dane = json_decode($_POST['umowa_dane'], true);
$klient = json_decode($_POST['klient'], true);
$poszkodowany = json_decode($_POST['poszkodowany'], true);
$uprawniony_do_inf = json_decode($_POST['uprawniony_do_inf'], true);
$zdarzenie = json_decode($_POST['zdarzenie'], true);
$PojazdA = json_decode($_POST['PojazdA'], true);
$PojazdB = json_decode($_POST['PojazdB'], true);
$odpowiedzialnosc_karna = json_decode($_POST['odpowiedzialnosc_karna'], true);
$odpowiedzialnosc_cywilna = json_decode($_POST['odpowiedzialnosc_cywilna'], true);
$przebieg_leczenia = json_decode($_POST['przebieg_leczenia'], true);

$stopka = 'PG-2-23-F3/2017-10-01';

?>

<script src="https://use.typekit.net/utq0hxn.js"></script>
<script>try{Typekit.load({ async: true });}catch(e){}</script>

<link rel="stylesheet" href="<?php echo 'https://' . $_SERVER ['HTTP_HOST'] . '/biblioteki/bootstrap/css/bootstrap.css'; ?>" type="text/css"/>
<link rel="stylesheet" href="<?php echo 'https://' . $_SERVER ['HTTP_HOST'] . '/moduly/druki/wzory_dokumentow/css/wzory_dokumentow.css'; ?>" type="text/css"/>


<div class="pdf_strona">


    <div class="pdf_strona_pierwsza_naglowek_pelnomocnictwo margin_t_20">
        <div class="pdfs_tytu_dokumentu pdf_tytul_pelnomocnictwo margin_t_40">
            <p class="margin_b_0 font_w_700 font_size_26 text_a_center">INFORMACJE</p>
            <p class="margin_b_0 font_w_700 font_size_26 text_a_center">DO ZGŁOSZENIA SZKODY</p>
        </div>
        <div class="pdfs_logo_osobowe"><img src="<?php echo 'https://' . $_SERVER ['HTTP_HOST']; ?>/img/logo.png"/></div>
    </div>
    <div class="form-group margin_b_0 margin_t_20">
        <div class="width_20_p float_l height_20 font_w_700">
            <?php echo $umowa['IdentyfikatorPrzedstawiciela']; ?>
        </div>
        <div class="width_20_p float_l height_20 font_w_700">
            <?php echo $umowa['KodJednostki']; ?>
        </div>
        <div class="width_20_p float_l height_20 font_w_700">
            <?php echo $umowa['KodKonsultanta']; ?>
        </div>
        <div class="width_20_p float_l height_20 font_w_700">
            <?php echo $umowa['GrupaSprawId']; ?>
        </div>
        <div class="width_20_p float_l height_20 font_w_700">
            <?php echo $umowa['NrAnkiety']; ?>
        </div>
    </div>

    <div class="form-group">
        <div class="width_20_p float_l">
            <div class="border_t"></div>
            ID agenta
        </div>
        <div class="width_20_p float_l">
            <div class="border_t"></div>
            Kod jednostki
        </div>
        <div class="width_20_p float_l">
            <div class="border_t"></div>
            Kod konsultanta
        </div>
        <div class="width_20_p float_l">
            <div class="border_t"></div>
            Nr Grupy spraw
        </div>
        <div class="width_20_p float_l">
            <div class="border_t"></div>
            Nr Ankiety
        </div>

    </div>
    <div class="clear_b"></div>

    <p class="margin_t_5">Nr sprawy <?php echo '_____________________________'; ?></p>
    <p>
        <span class="font_w_700">Rodzaj wypadku:</span>
        <span class="glyphicon glyphicon<?php echo ($umowa_dane['RodzajSzkodyId'] == 1) ? '-check' : '-unchecked'; ?>" aria-hidden="true"></span> komunikacyjny
        <span class="glyphicon glyphicon<?php echo ($umowa_dane['RodzajSzkodyId'] == 2) ? '-check' : '-unchecked'; ?>" aria-hidden="true"></span> w rolnictwie
        <span class="glyphicon glyphicon<?php echo ($umowa_dane['RodzajSzkodyId'] == 4) ? '-check' : '-unchecked'; ?>" aria-hidden="true"></span> w pracy
        <span class="glyphicon glyphicon<?php echo ($umowa_dane['RodzajSzkodyId'] == 3) ? '-check' : '-unchecked'; ?>" aria-hidden="true"></span> inny ______________
    </p>
    <p>
        <span class="font_w_700">Następstwa:</span> <span class="glyphicon glyphicon<?php echo ($umowa_dane['TypSzkodyId'] == 1) ? '-check' : '-unchecked'; ?>" aria-hidden="true"></span> obrażenia ciała
        <span class="glyphicon glyphicon<?php echo ($umowa_dane['TypSzkodyId'] == 2) ? '-check' : '-unchecked'; ?>" aria-hidden="true"></span> śmierć poszkodowanego <?php echo ($umowa_dane['TypSzkodyId'] == 2) ? $poszkodowany['Imie'].' '.$poszkodowany['Nazwisko'] : ''; ?>
        <span class="glyphicon glyphicon<?php echo ($umowa_dane['TypSzkodyId'] == 3) ? '-check' : '-unchecked'; ?>" aria-hidden="true"></span> inny <?php echo ($umowa_dane['RodzajSzkodyId'] == 3) ? $umowa_dane['InnyRodzajSzkody'] : '______________'; ?>
    </p>
    <p>
        Imię i nazwisko klienta:
        <?php echo (!empty($klient['Nazwisko'])) ? $klient['Imie'].' '.$klient['Nazwisko'] : '______________'; ?>
    </p>
    <p>
        Osoba upoważniona do uzyskiwania informacji telefonicznej:
        <?php echo (!empty($uprawniony_do_inf['Id'])) ? $uprawniony_do_inf['Imie'].' '.$uprawniony_do_inf['Nazwisko'].' - PESEL: '.$uprawniony_do_inf['Pesel'] : '______________'; ?>
    </p>
    <p>
        Data, godzina i miejsce zdarzenia:
        <?php echo (!empty($zdarzenie['Data'])) ? $zdarzenie['Data'].' '.$zdarzenie['Godzina'] : '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'; ?> w miejscowości: <?php echo (!empty($zdarzenie['Miejscowosc'])) ? $zdarzenie['Miejscowosc'] : ''; ?>
    </p>
    <div class="clear_b odstep"></div>


    <div class="szary_box szary_box_ramka_czerw">
        <div class="form-group col-md-12 margin_t_5">
            <label class="font_size_10 margin_b_0">Opis wypadku: </label>
            <div class="pdf_kratka kratka_nowy super_big_kratka"><?php echo $zdarzenie['OpisZdarzenia']; ?></div>
        </div>
        <div class="clear_b"></div>
    </div>
    <div class="clear_b odstep"></div>


    <div class="szary_box szary_box_ramka_czerw">
        <div class="form-group col-md-2 margin_t_5">
            <label class="font_size_10"></label>
        </div>
        <div class="form-group col-md-5 margin_t_5">
            <label class="font_size_10"><b>Pojazd A</b> (w którym znajdował się poszkodowany)</label>
            <p class="font_size_10 margin_b_0"><span class="glyphicon glyphicon<?php echo ($PojazdA['SprawcaPojazd'] == 1) ? '-check' : '-unchecked'; ?>" aria-hidden="true"></span> pojazd sprawcy</p>
        </div>
        <div class="form-group col-md-5 margin_t_5">
            <label class="font_size_10"><b>Pojazd B*</b> lub podmiot odpowiedzialny</label>
            <p class="font_size_10 margin_b_0"><span class="glyphicon glyphicon<?php echo ($PojazdB['SprawcaPojazd'] == 1) ? '-check' : '-unchecked'; ?>" aria-hidden="true"></span> pojazd sprawcy</p>
        </div>
        <div class="clear_b"></div>
    </div>

    <div class="szary_box szary_box_ramka_czerw">
        <div class="form-group col-md-2 margin_t_5">
            <label class="font_size_10">Marka, typ pojazdu</label>
        </div>
        <div class="form-group col-md-5 margin_t_5">
            <div class="pdf_kratka kratka_nowy"><?php echo $PojazdA['Marka'].' '.$PojazdA['Model']; ?></div>
           </div>
        <div class="form-group col-md-5 margin_t_5">
            <div class="pdf_kratka kratka_nowy"><?php echo $PojazdB['Marka'].' '.$PojazdB['Model']; ?></div>
          </div>
        <div class="clear_b"></div>
    </div>


    <div class="szary_box szary_box_ramka_czerw">
        <div class="form-group col-md-2 margin_t_5">
            <label class="font_size_10">Nr rejestracyjny i kraj rejestracji
                (jeśli inny niż Polska)</label>
        </div>
        <div class="form-group col-md-5 margin_t_5">
            <div class="pdf_kratka kratka_nowy"><?php echo $PojazdA['NrRejestracyjny'].' '.$PojazdA['KrajRejestracji']; ?></div>
        </div>
        <div class="form-group col-md-5 margin_t_5">
            <div class="pdf_kratka kratka_nowy"><?php echo $PojazdB['NrRejestracyjny'].' '.$PojazdB['KrajRejestracji']; ?></div>
        </div>
        <div class="clear_b"></div>
    </div>

    <div class="szary_box szary_box_ramka_czerw">
        <div class="form-group col-md-2 margin_t_5">
            <label class="font_size_10">Kierujący pojazdem</label>
        </div>
        <div class="form-group col-md-5 margin_t_5">
            <div class="pdf_kratka kratka_nowy"><?php echo $PojazdA['KierujacyPojazdem']; ?></div>
        </div>
        <div class="form-group col-md-5 margin_t_5">
            <div class="pdf_kratka kratka_nowy"><?php echo $PojazdB['KierujacyPojazdem']; ?></div>
        </div>
        <div class="clear_b"></div>
    </div>

    <div class="szary_box szary_box_ramka_czerw">
        <div class="form-group col-md-2 margin_t_5">
            <label class="font_size_10">Posiadacz pojazdu</label>
        </div>
        <div class="form-group col-md-5 margin_t_5">
            <div class="pdf_kratka kratka_nowy"><?php echo $PojazdA['PosiadaczPojazdu']; ?></div>
        </div>
        <div class="form-group col-md-5 margin_t_5">
            <div class="pdf_kratka kratka_nowy"><?php echo $PojazdB['PosiadaczPojazdu']; ?></div>
        </div>
        <div class="clear_b"></div>
    </div>

    <div class="szary_box szary_box_ramka_czerw">
        <div class="form-group col-md-2 margin_t_5">
            <label class="font_size_10">Ubezpieczyciel OC
                posiadacza pojazdu</label>
        </div>
        <div class="form-group col-md-5 margin_t_5">
            <div class="pdf_kratka kratka_nowy"><?php echo $PojazdA['Ubezpieczyciel']; ?></div>
        </div>
        <div class="form-group col-md-5 margin_t_5">
            <div class="pdf_kratka kratka_nowy"><?php echo $PojazdB['Ubezpieczyciel']; ?></div>
        </div>
        <div class="clear_b"></div>
    </div>

    <div class="szary_box szary_box_ramka_czerw">
        <div class="form-group col-md-2 margin_t_5">
            <label class="font_size_10">Numer polisy OC</label>
        </div>
        <div class="form-group col-md-5 margin_t_5">
            <div class="pdf_kratka kratka_nowy"><?php echo $PojazdA['NumerPolisy']; ?></div>
        </div>
        <div class="form-group col-md-5 margin_t_5">
            <div class="pdf_kratka kratka_nowy"><?php echo $PojazdB['NumerPolisy']; ?></div>
        </div>
        <div class="clear_b"></div>
        <p class="font_size_10 padding_l_10 padding_r_10 margin_t_10 padding_b_10">*Jeżeli w zdarzeniu uczestniczyły 2 pojazdy, należy wypełnić pola pojazd A i B; jeżeli poszkodowany był pieszym lub rowerzystą, wypełnić tylko pole pojazd B, przy szkodach niekomunikacyjnych
            dane sprawcy należy wpisać w polu pojazd B.</p>
    </div>

    <div class="col-md-12 padding_l_40 padding_r_40 margin_t_0">
        <p><span class="font_w_700">Odpowiedzialność karna:</span></p>

        <p>Na miejsce zdarzenia
            <span class="glyphicon glyphicon<?php echo ($odpowiedzialnosc_karna['WezwanoPolicje'] == 1) ? '-check' : '-unchecked'; ?>" aria-hidden="true"></span> wezwano policję z <?php echo ($odpowiedzialnosc_karna['WezwanoPolicje'] == 1) ? $odpowiedzialnosc_karna['MiejscowoscPolicji'] : '____________________________'; ?>
            <span class="glyphicon glyphicon<?php echo ($odpowiedzialnosc_karna['WezwanoPolicje'] == 0) ? '-check' : '-unchecked'; ?>" aria-hidden="true"></span> nie wezwano policji.
        </p>
        <p>Czy sprawa została zakończona:
            <span class="glyphicon glyphicon<?php echo ($odpowiedzialnosc_karna['RodzajZakonczenia'] == 1) ? '-check' : '-unchecked'; ?>" aria-hidden="true"></span> oświadczeniem sprawcy
            <span class="glyphicon glyphicon<?php echo ($odpowiedzialnosc_karna['RodzajZakonczenia'] == 2) ? '-check' : '-unchecked'; ?>" aria-hidden="true"></span> mandatem wystawionym przez policję
            <span class="glyphicon glyphicon<?php echo ($odpowiedzialnosc_karna['RodzajZakonczenia'] == 3) ? '-check' : '-unchecked'; ?>" aria-hidden="true"></span> umorzeniem przez Prokuraturę
            <span class="glyphicon glyphicon<?php echo ($odpowiedzialnosc_karna['RodzajZakonczenia'] == 4) ? '-check' : '-unchecked'; ?>" aria-hidden="true"></span> wyrokiem Sądu <?php echo ($odpowiedzialnosc_karna['RodzajZakonczenia'] == 4) ? $odpowiedzialnosc_karna['Sad'] : '____________________________'; ?>
            <span class="glyphicon glyphicon<?php echo ($odpowiedzialnosc_karna['RodzajZakonczenia'] == 5) ? '-check' : '-unchecked'; ?>" aria-hidden="true"></span> nadal trwa postępowanie
        </p>
    </div>
    <div class="clear_b"></div>

    <div class="szary_box szary_box_ramka_czerw">
        <div class="form-group col-md-12 margin_t_5">
            <label class="font_size_10 margin_b_0">Obrażenia</label>
            <div class="pdf_kratka kratka_nowy big_kratka"><?php echo $zdarzenie['OpisObrazen']; ?></div>
        </div>
        <div class="clear_b"></div>
    </div>

    <div class="col-md-12 padding_l_40 padding_r_40 margin_t_0">

        <p><span class="font_w_700">Odpowiedzialność cywilna</span></p>
        <p>
            Czy zgłoszono szkodę w pojeździe ubezpieczyciela OC sprawcy?
            <span class="glyphicon glyphicon<?php echo ($odpowiedzialnosc_cywilna['ZgloszonoPojazdZOc'] == 1) ? '-check' : '-unchecked'; ?>" aria-hidden="true"></span> tak
            <span class="glyphicon glyphicon<?php echo ($odpowiedzialnosc_cywilna['ZgloszonoPojazdZOc'] == 2) ? '-check' : '-unchecked'; ?>" aria-hidden="true"></span> nie
            <span class="glyphicon glyphicon<?php echo ($odpowiedzialnosc_cywilna['ZgloszonoPojazdZOc'] == 3) ? '-check' : '-unchecked'; ?>" aria-hidden="true"></span> nie wiem
        <p>
            Czy zgłoszono szkodę na osobie do ubezpieczyciela OC sprawcy?
            <span class="glyphicon glyphicon<?php echo ($odpowiedzialnosc_cywilna['ZgloszonoOsobeZOc'] == 1) ? '-check' : '-unchecked'; ?>" aria-hidden="true"></span> tak
            <span class="glyphicon glyphicon<?php echo ($odpowiedzialnosc_cywilna['ZgloszonoOsobeZOc'] == 2) ? '-check' : '-unchecked'; ?>" aria-hidden="true"></span> nie
            <span class="glyphicon glyphicon<?php echo ($odpowiedzialnosc_cywilna['ZgloszonoOsobeZOc'] == 3) ? '-check' : '-unchecked'; ?>" aria-hidden="true"></span> nie wiem
        </p>
        <p>
            Czy ubezpieczyciel wypłacił odszkodowanie z OC sprawcy?
            <span class="glyphicon glyphicon<?php echo ($odpowiedzialnosc_cywilna['WyplaconoZOcSprawcy'] == 1) ? '-check' : '-unchecked'; ?>" aria-hidden="true"></span> tak w kwocie
            <?php echo ($odpowiedzialnosc_cywilna['WyplaconoZOcSprawcy'] == 1) ? $odpowiedzialnosc_cywilna['KwotaOdszkodowania'] : '______________'; ?> zł
            <span class="glyphicon glyphicon<?php echo ($odpowiedzialnosc_cywilna['WyplaconoZOcSprawcy'] == 2) ? '-check' : '-unchecked'; ?>" aria-hidden="true"></span> nie.
        </p>
        <p>
            Wypłata z OC sprawcy nastąpiła na podstawie:
            <span class="glyphicon glyphicon<?php echo ($odpowiedzialnosc_cywilna['PodstawaPrawna'] == 1) ? '-check' : '-unchecked'; ?>" aria-hidden="true"></span> decyzji
            <span class="glyphicon glyphicon<?php echo ($odpowiedzialnosc_cywilna['PodstawaPrawna'] == 2) ? '-check' : '-unchecked'; ?>" aria-hidden="true"></span> ugody
            <span class="glyphicon glyphicon<?php echo ($odpowiedzialnosc_cywilna['PodstawaPrawna'] == 3) ? '-check' : '-unchecked'; ?>" aria-hidden="true"></span> wyroku z dnia
            <?php echo ($odpowiedzialnosc_cywilna['DataWyroku'] != '0000-00-00') ? $odpowiedzialnosc_cywilna['DataWyroku'] : '______________'; ?>r.
        </p>

        <div class="clear_b odstep"></div>
        <div class="float_l center">
            _______________________________________<br>
        Podpis pełnomocnika Votum
        </div>
        <div class="float_r center">
        _______________________________________<br>
        Podpis Klienta/W imieniu klienta
        </div>

        <div class="clear_b odstep"></div>
        <p class="font_size_10">Oświadczam, że podpisy Klienta na wszystkich dokumentach, w tym umowie z załącznikami i pełnomocnictwie, zostały złożone w mojej obecności własnoręcznie przez Klienta.</p>

        <div class="clear_b odstep"></div>
        <div class="float_l center">
            _______________________________________<br>
            Czytelny podpis pełnomocnika VOTUM
        </div>
    </div>

    <div class="stopka_pionowa"><?php echo $stopka; ?></div>

</div>