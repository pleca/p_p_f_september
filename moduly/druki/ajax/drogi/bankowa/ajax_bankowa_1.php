<?php

    require_once($_SERVER ['DOCUMENT_ROOT'] . 'czy_zalogowany.php');

    $rodzaj = (isset($_POST['rodzaj'])) ? htmlspecialchars($_POST['rodzaj']) : '';
    $element_id = (isset($_POST['element_id'])) ? htmlspecialchars($_POST['element_id']) : '';
    $akcja = (isset($_POST['akcja'])) ? htmlspecialchars($_POST['akcja']) : '';
    $droga = (isset($_POST['droga'])) ? htmlspecialchars($_POST['droga']) : '';

    if($akcja == 'edytuj' ){
        $element_id = explode('-',$element_id);

        $lista_dodatkowych_klientow = $bazaDanych->pobierzDane('OsobaId','umowaBankowaOsoba','BankowaId = '.$element_id[2].' AND NrKlienta != 1');

        $element_id = $element_id[0].'-'.$element_id[1].'-'.$element_id[2];
    }

?>
    <div class="daneStronyUmowyPopUp">
        <div class="panel panel-default margin_b_0">
            <div class="panel-heading cursor_p rozwinPojedynczyPanelNaglowniek">DODATKOWY ZLECENIODAWCA<i class="fa dsu_dodaj_nowego_klienta fa-plus float_r" aria-hidden="true"></i></div>
            <div class="panel-body ukryj_widok daneDodatkowegoKlienta">

                <div class="col-md-6 inputPole padding_r_10"><input data-wartosc_domyslna="" value="" data-kolumna="Imie" type="text" class="update wymagane duzeMaleLiteryCyfry" placeholder="Imię"></div>
                <div class="col-md-6 inputPole "><input data-wartosc_domyslna="" value="" data-kolumna="Nazwisko" type="text" class="update wymagane duzeMaleLiteryCyfry" placeholder="Nazwisko"></div>

                <label class="margin_t_10 width_100">ADRES ZAMELDOWANIA</label>
                <div class="col-md-6 inputPole padding_r_10"><input data-wartosc_domyslna="" value="" data-kolumna="Ulica" type="text" class="update wymagane duzeMaleLiteryCyfry" placeholder="Ulica"></div>
                <div class="col-md-3 inputPole padding_r_10"><input data-wartosc_domyslna="" value="" data-kolumna="NrDomu" type="text" class="update wymagane duzeMaleLiteryCyfry" placeholder="Nr domu"></div>
                <div class="col-md-3 inputPole "><input data-wartosc_domyslna="" value="" data-kolumna="NrMieszkania" type="text" class="update duzeMaleLiteryCyfry" placeholder="Nr mieszkania"></div>
                <div class="col-md-4 inputPole padding_r_10 margin_t_10"><input data-wartosc_domyslna="" value="" data-kolumna="KodPocztowy" type="text" class="update wymagane sprawdzKodPocztowy poleLiczbowe" maxlength="6" placeholder="Kod pocztowy"></div>
                <div class="col-md-8 inputPole margin_t_10"><input data-wartosc_domyslna="" value="" data-kolumna="Wartosc" type="text" class="update wymagane" placeholder="Miejscowość"></div>

                <label class="margin_t_10 width_100">DANE Z DOWODU</label>
                <div class="col-md-6 inputPole padding_r_10"><input data-wartosc_domyslna="" value="" data-kolumna="Pesel" type="text" class="update wymagane sprawdzPesel poleLiczbowe" maxlength="11"  placeholder="Pesel"></div>
                <div class="col-md-6 inputPole "><input data-wartosc_domyslna="" value="" data-kolumna="Dowod" type="text" class="update wymagane duzeMaleLiteryCyfry" maxlength="9" placeholder="Seria i numer dowodu"></div>

                <label class="margin_t_10 width_100">DANE DO KONTAKTU</label>
                <div class="col-md-4 inputPole padding_r_10"><input data-wartosc_domyslna="" value="" data-kolumna="Telefon" type="text" class="update poleLiczbowe" placeholder="Telefon"></div>
                <div class="col-md-8 inputPole "><input data-wartosc_domyslna="" value="" data-kolumna="Mail" type="text" class="update sprawdzEmail duzeMaleLiteryCyfry" placeholder="Adres e-mail"></div>

                <button data-reakcja="<?php echo ($akcja == 'nowy') ? 'zapisz_zmiany' : 'zapisz_przeladuj_widok'; ?>" data-droga="<?php echo $droga; ?>" data-klasa_rodzic="daneDodatkowegoKlienta" data-element_id="<?php echo $element_id; ?>" data-tabela="umowaOsoba" data-ogolne="0" data-strona="1" data-akcja="dodaj_dodatkowego_klienta" type="button" class="przyciskZapiszZmianyZielony margin_t_10 wczytajStroneDrogiUmowyDoPopUp btn btn-success width_100 margin_b_0">Dodaj klienta</button>

            </div>
        </div>

        <?php
            if($lista_dodatkowych_klientow){
                $i = 0;
                while($poj_lista_dodatkowych_klientow = $lista_dodatkowych_klientow->fetch_object()){

                    $umowa_osoba_tmp = $bazaDanych->pobierzDane('*','umowaOsoba','Id = '.$poj_lista_dodatkowych_klientow->OsobaId);
                    $umowa_osoba_tmp = $umowa_osoba_tmp->fetch_object();

                    $umowa_osoba_kontakt_tmp = $bazaDanych->pobierzDane('*','umowaKontakt','Id = '.$umowa_osoba_tmp->KontaktId);
                    $umowa_osoba_kontakt_tmp = $umowa_osoba_kontakt_tmp->fetch_object();

                    $umowa_osoba_adres_tmp = $bazaDanych->pobierzDane('*','umowaAdres','Id = '.$umowa_osoba_tmp->AdresId);
                    $umowa_osoba_adres_tmp = $umowa_osoba_adres_tmp->fetch_object();

                    $umowa_osoba_adres_miasto_tmp = $bazaDanych->pobierzDane('*','umowaAdresMiasto','Id = '.$umowa_osoba_adres_tmp->MiastoId);
                    $umowa_osoba_adres_miasto_tmp = $umowa_osoba_adres_miasto_tmp->fetch_object();

                    $Imie = $umowa_osoba_tmp->Imie;
                    $Nazwisko = $umowa_osoba_tmp->Nazwisko;
                    $Pesel = $umowa_osoba_tmp->Pesel;
                    $Dowod = $umowa_osoba_tmp->Dowod;
                    $Ulica = $umowa_osoba_adres_tmp->Ulica;
                    $NrDomu = $umowa_osoba_adres_tmp->NrDomu;
                    $NrMieszkania = $umowa_osoba_adres_tmp->NrMieszkania;
                    $KodPocztowy = $umowa_osoba_adres_tmp->KodPocztowy;
                    $WartoscMiasto = $umowa_osoba_adres_miasto_tmp->Wartosc;
                    $Mail = $umowa_osoba_kontakt_tmp->Mail;
                    $Telefon = $umowa_osoba_kontakt_tmp->Telefon;

                    $element_id = explode('-',$element_id);

                    $element_id = $element_id[0].'-'.$poj_lista_dodatkowych_klientow->OsobaId.'-'.$element_id[2];

        ?>
                    <div class="panel panel-default margin_t_10 margin_b_0">
                        <div class="panel-heading cursor_p rozwinPojedynczyPanelNaglowniek"><?php echo $Imie.' '.$Nazwisko; ?><i class="fa dsu_dodaj_nowego_klienta fa-pencil float_r" aria-hidden="true"></i></div>
                        <div class="panel-body ukryj_widok daneDodatkowegoKlienta_<?php echo $i; ?>">

                            <div class="col-md-6 inputPole padding_r_10"><input data-wartosc_domyslna="<?php echo $Imie; ?>" value="<?php echo $Imie; ?>" data-kolumna="Imie" type="text" class="update wymagane duzeMaleLiteryCyfry" placeholder="Imię"></div>
                            <div class="col-md-6 inputPole "><input data-wartosc_domyslna="<?php echo $Nazwisko; ?>" value="<?php echo $Nazwisko; ?>" data-kolumna="Nazwisko" type="text" class="update wymagane duzeMaleLiteryCyfry" placeholder="Nazwisko"></div>

                            <label class="margin_t_10 width_100">ADRES ZAMELDOWANIA</label>
                            <div class="col-md-6 inputPole padding_r_10"><input data-wartosc_domyslna="<?php echo $Ulica; ?>" value="<?php echo $Ulica; ?>" data-kolumna="Ulica" type="text" class="update wymagane duzeMaleLiteryCyfry" placeholder="Ulica"></div>
                            <div class="col-md-3 inputPole padding_r_10"><input data-wartosc_domyslna="<?php echo $NrDomu; ?>" value="<?php echo $NrDomu; ?>" data-kolumna="NrDomu" type="text" class="update wymagane duzeMaleLiteryCyfry" placeholder="Nr domu"></div>
                            <div class="col-md-3 inputPole "><input data-wartosc_domyslna="<?php echo $NrMieszkania; ?>" value="<?php echo $NrMieszkania; ?>" data-kolumna="NrMieszkania" type="text" class="update duzeMaleLiteryCyfry" placeholder="Nr mieszkania"></div>
                            <div class="col-md-4 inputPole padding_r_10 margin_t_10"><input data-wartosc_domyslna="<?php echo $KodPocztowy; ?>" value="<?php echo $KodPocztowy; ?>" data-kolumna="KodPocztowy" type="text" class="update wymagane sprawdzKodPocztowy poleLiczbowe" maxlength="6" placeholder="Kod pocztowy"></div>
                            <div class="col-md-8 inputPole margin_t_10"><input data-wartosc_domyslna="<?php echo $WartoscMiasto; ?>" value="<?php echo $WartoscMiasto; ?>" data-kolumna="Wartosc" type="text" class="update wymagane duzeMaleLiteryCyfry" placeholder="Miejscowość"></div>

                            <label class="margin_t_10 width_100">DANE Z DOWODU</label>
                            <div class="col-md-6 inputPole padding_r_10"><input data-wartosc_domyslna="<?php echo $Pesel; ?>" value="<?php echo $Pesel; ?>" data-kolumna="Pesel" type="text" class="update wymagane sprawdzPesel poleLiczbowe" maxlength="11"  placeholder="Pesel"></div>
                            <div class="col-md-6 inputPole "><input data-wartosc_domyslna="<?php echo $Dowod; ?>" value="<?php echo $Dowod; ?>" data-kolumna="Dowod" type="text" class="update wymagane duzeMaleLiteryCyfry " maxlength="9" placeholder="Seria i numer dowodu"></div>

                            <label class="margin_t_10 width_100">DANE DO KONTAKTU</label>
                            <div class="col-md-4 inputPole padding_r_10"><input data-wartosc_domyslna="<?php echo $Telefon; ?>" value="<?php echo $Telefon; ?>" data-kolumna="Telefon" type="text" class="update poleLiczbowe" placeholder="Telefon"></div>
                            <div class="col-md-8 inputPole "><input data-wartosc_domyslna="<?php echo $Mail; ?>" value="<?php echo $Mail; ?>" data-kolumna="Mail" type="text" class="update duzeMaleLiteryCyfry sprawdzEmail" placeholder="Adres e-mail"></div>

                            <button data-reakcja="<?php echo ($akcja == 'nowy') ? 'zapisz_zmiany' : 'zapisz_przeladuj_widok'; ?>" data-droga="<?php echo $droga; ?>" data-klasa_rodzic="daneDodatkowegoKlienta_<?php echo $i; ?>" data-element_id="<?php echo $element_id; ?>" data-tabela="umowaOsoba" data-ogolne="0" data-strona="1" data-akcja="aktualizuj_dodatkowego_klienta" type="button" class="przyciskZapiszZmianyZielony margin_t_10 wczytajStroneDrogiUmowyDoPopUp btn btn-success width_100 margin_b_0">Zapisz zmiany</button>

                        </div>
                    </div>
        <?php
                    $i++;
                }
            }
        ?>

    </div>
