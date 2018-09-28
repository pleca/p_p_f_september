<?php

    require_once($_SERVER ['DOCUMENT_ROOT'] . 'czy_zalogowany.php');

    $element_id = (isset($_POST['element_id'])) ? htmlspecialchars($_POST['element_id']) : '';
    $akcja = (isset($_POST['akcja'])) ? htmlspecialchars($_POST['akcja']) : '';
    $droga = (isset($_POST['droga'])) ? htmlspecialchars($_POST['droga']) : '';
    $strona = (isset($_POST['strona'])) ? htmlspecialchars($_POST['strona']) : '';
    $ogolne = (isset($_POST['ogolne'])) ? htmlspecialchars($_POST['ogolne']) : '';


        $Imie = '';
        $Nazwisko = '';
        $Pesel = '';
        $Dowod = '';
        $Ulica = '';
        $NrDomu = '';
        $NrMieszkania = '';
        $KodPocztowy = '';
        $Mail = '';
        $Telefon = '';
        $WartoscMiasto = '';

        if ($akcja == 'edytuj') {
            $element_id = explode('-', $element_id);

            $umowa_osoba_tmp = $bazaDanych->pobierzDane('*', 'umowaOsoba', 'Id = ' . $element_id[1] );
            $umowa_osoba_tmp = $umowa_osoba_tmp->fetch_object();

            $umowa_osoba_kontakt_tmp = $bazaDanych->pobierzDane('*', 'umowaKontakt', 'Id = ' . $umowa_osoba_tmp->KontaktId);
            $umowa_osoba_kontakt_tmp = $umowa_osoba_kontakt_tmp->fetch_object();

            $umowa_osoba_adres_tmp = $bazaDanych->pobierzDane('*', 'umowaAdres', 'Id = ' . $umowa_osoba_tmp->AdresId);
            $umowa_osoba_adres_tmp = $umowa_osoba_adres_tmp->fetch_object();

            $umowa_osoba_adres_miasto_tmp = $bazaDanych->pobierzDane('*', 'umowaAdresMiasto', 'Id = ' . $umowa_osoba_adres_tmp->MiastoId);
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

            $element_id = $element_id[0] . '-' . $element_id[1] . '-' . $element_id[2];
        }

        ?>
        <div class="daneKlientaPopUp">
            <?php if ($akcja == 'nowy'){ ?>
            <div class="panel panel-default margin_b_0">
                <div class="panel-heading ">DANE KLIENTA</div>
                <div class="panel-body">
                    <?php } ?>
                    <label class="margin_t_10 width_100 gray_background">DANE ZLECENIODAWCY</label>
                    <label class="margin_t_10 width_100">Imię i nazwisko</label>
                    <div class="col-md-6 inputPole padding_r_10"><input data-wartosc_domyslna="<?php echo $Imie; ?>"
                                                                        value="<?php echo $Imie; ?>" data-kolumna="Imie"
                                                                        type="text"
                                                                        class="update wymagane duzeMaleLiteryCyfry"
                                                                        placeholder="Imię"></div>
                    <div class="col-md-6 inputPole "><input data-wartosc_domyslna="<?php echo $Nazwisko; ?>"
                                                            value="<?php echo $Nazwisko; ?>" data-kolumna="Nazwisko"
                                                            type="text" class="update wymagane duzeMaleLiteryCyfry"
                                                            placeholder="Nazwisko"></div>
                    <div class="col-md-0 inputPole padding_r_10"><input type="hidden" value="1" data-kolumna="OsobaTypId" type="text" class="update" placeholder=""></div>


                    <label class="margin_t_10 width_100">Adres zameldowania</label>
                    <div class="col-md-6 inputPole padding_r_10"><input data-wartosc_domyslna="<?php echo $Ulica; ?>"
                                                                        value="<?php echo $Ulica; ?>"
                                                                        data-kolumna="Ulica" type="text"
                                                                        class="update wymagane duzeMaleLiteryCyfry"
                                                                        placeholder="Ulica"></div>
                    <div class="col-md-3 inputPole padding_r_10"><input data-wartosc_domyslna="<?php echo $NrDomu; ?>"
                                                                        value="<?php echo $NrDomu; ?>"
                                                                        data-kolumna="NrDomu" type="text"
                                                                        class="update wymagane duzeMaleLiteryCyfry"
                                                                        placeholder="Nr domu"></div>
                    <div class="col-md-3 inputPole "><input data-wartosc_domyslna="<?php echo $NrMieszkania; ?>"
                                                            value="<?php echo $NrMieszkania; ?>"
                                                            data-kolumna="NrMieszkania" type="text"
                                                            class="update duzeMaleLiteryCyfry"
                                                            placeholder="Nr mieszkania"></div>
                    <div class="col-md-4 inputPole padding_r_10 margin_t_10"><input
                                data-wartosc_domyslna="<?php echo $KodPocztowy; ?>" value="<?php echo $KodPocztowy; ?>"
                                data-kolumna="KodPocztowy" type="text"
                                class="update wymagane sprawdzKodPocztowy poleLiczbowe" maxlength="6"
                                placeholder="Kod pocztowy"></div>
                    <div class="col-md-8 inputPole margin_t_10"><input
                                data-wartosc_domyslna="<?php echo $WartoscMiasto; ?>"
                                value="<?php echo $WartoscMiasto; ?>" data-kolumna="Wartosc" type="text"
                                class="update wymagane duzeMaleLiteryCyfry" placeholder="Miejscowość"></div>

                    <label class="margin_t_10 width_100">Dane z dowodu</label>
                    <div class="col-md-6 inputPole padding_r_10"><input data-wartosc_domyslna="<?php echo $Pesel; ?>"
                                                                        value="<?php echo $Pesel; ?>"
                                                                        data-kolumna="Pesel" type="text" maxlength="11"
                                                                        class="update wymagane sprawdzPesel poleLiczbowe"
                                                                        placeholder="Pesel"></div>
                    <div class="col-md-6 inputPole "><input data-wartosc_domyslna="<?php echo $Dowod; ?>"
                                                            value="<?php echo $Dowod; ?>" data-kolumna="Dowod"
                                                            type="text"
                                                            class="update wymagane duzeMaleLiteryCyfry"
                                                            maxlength="9" placeholder="Seria i numer dowodu"></div>

                    <label class="margin_t_10 width_100">Dane do kontaktu</label>
                    <div class="col-md-4 inputPole padding_r_10"><input data-wartosc_domyslna="<?php echo $Telefon; ?>"
                                                                        value="<?php echo $Telefon; ?>"
                                                                        data-kolumna="Telefon" type="text"
                                                                        class="update poleLiczbowe"
                                                                        placeholder="Telefon"></div>
                    <div class="col-md-8 inputPole "><input data-wartosc_domyslna="<?php echo $Mail; ?>"
                                                            value="<?php echo $Mail; ?>" data-kolumna="Mail" type="text"
                                                            class="update sprawdzEmail duzeMaleLiteryCyfry"
                                                            placeholder="Adres e-mail"></div>

                    <button data-reakcja="<?php echo ($akcja == 'nowy') ? 'zapisz_zmiany' : 'zapisz_przeladuj_widok'; ?>"
                            data-droga="<?php echo $droga; ?>" data-klasa_rodzic="daneKlientaPopUp"
                            data-element_id="<?php echo $element_id; ?>" data-tabela="umowaOsoba" data-ogolne="1"
                            data-strona="<?php echo ($akcja == 'nowy') ? 'zakladki' : 'dodaj_klienta'; ?>"
                            data-akcja="<?php echo ($akcja == 'nowy') ? 'dodaj_klienta' : 'aktualizuj_klienta'; ?>"
                            type="button"
                            class="przyciskZapiszZmianyZielony margin_t_10 wczytajStroneDrogiUmowyDoPopUp btn btn-success width_100 margin_b_0">
                        Zapisz
                    </button>
                    <?php if ($akcja == 'nowy'){ ?>
                </div>
            </div>
        <?php } ?>
        </div>
