<?php

require_once($_SERVER ['DOCUMENT_ROOT'] . 'czy_zalogowany.php');

$element_id = (isset($_POST['element_id'])) ? htmlspecialchars($_POST['element_id']) : '';
$akcja = (isset($_POST['akcja'])) ? htmlspecialchars($_POST['akcja']) : '';
$droga = (isset($_POST['droga'])) ? htmlspecialchars($_POST['droga']) : '';

$ZgodaNaInformacje = 0;
$ZgodaSms = 0;
$ZgodaMail = 0;

$OswiadczenieODzialalnosci = 0;
$OfertaProtecta = 0;
$OfertaFinansowa = 0;

$OfertaPCRF = 0;
$OfertaFundacji = 0;
$OfertaGamma = 0;

if($akcja == 'edytuj' ){
    $element_id = explode('-',$element_id);
    //var_dump($droga);
    $umowa_dane = $bazaDanych->pobierzDane('*', 'umowa'.mb_ucfirst($droga), 'Id = '.$element_id[2]);
    //var_dump($umowa_dane->fetch_object());
    $umowa_dane = $umowa_dane->fetch_object();

    $umowa = $bazaDanych->pobierzDane('UmowaTypId', 'umowa', 'Id = '.$element_id[0]);
    $umowa = $umowa->fetch_object();

    $ZgodaNaInformacje = $umowa_dane->ZgodaNaInformacje;
    $ZgodaSms = $umowa_dane->ZgodaSms;
    $ZgodaMail = $umowa_dane->ZgodaMail;

    $ZgodaOfertaDSA = $umowa_dane->ZgodaOfertaDSA;
    $ZgodaOfertaProtecta = $umowa_dane->ZgodaOfertaProtecta;
    $ZgodaInfDSA = $umowa_dane->ZgodaInfDSA;
    $ZgodaMarketingDSA = $umowa_dane->ZgodaMarketingDSA;
    $ZgodaInfProtecta = $umowa_dane->ZgodaInfProtecta;
    $ZgodaMarketingProtecta = $umowa_dane->ZgodaMarketingProtecta;

    $ZgodaDaneDSA = $umowa_dane->ZgodaDaneDSA;
    $ZgodaDanePCRF = $umowa_dane->ZgodaDanePCRF;
    $ZgodaDaneFundacja = $umowa_dane->ZgodaDaneFundacja;
    $ZgodaDaneAutovotum = $umowa_dane->ZgodaDaneAutovotum;
    $ZgodaDaneBEP = $umowa_dane->ZgodaDaneBEP;
    $ZgodaDaneProtecta = $umowa_dane->ZgodaDaneProtecta;
    $ZgodaInfVotum = $umowa_dane->ZgodaInfVotum;
    $ZgodaMarketingVotum = $umowa_dane->ZgodaMarketingVotum;
    $ZgodaPCRF = $umowa_dane->ZgodaPCRF;
    $ZgodaFundacja = $umowa_dane->ZgodaFundacja;





    $OswiadczenieODzialalnosci = $umowa_dane->OswiadczenieODzialalnosci;
    $OfertaProtecta = $umowa_dane->OfertaProtecta;
    $OfertaFinansowa = $umowa_dane->OfertaFinansowa;

    $OfertaPCRF = $umowa_dane->OfertaPCRF;
    $OfertaFundacji = $umowa_dane->OfertaFundacji;
    $OfertaGamma = $umowa_dane->OfertaGamma;

    $element_id = $element_id[0].'-'.$element_id[1].'-'.$element_id[2];
}
if ($umowa->UmowaTypId == '1') {
    ?>
    <div class="daneStronyUmowyPopUp">

        <label class="margin_t_10 width_100 gray_background">ZGODY</label>

        <div class="zaznaczPoleGrupa margin_t_10">
            <div class="zpg_opcja"><i data-wartosc_domyslna="<?php echo $ZgodaDaneDSA; ?>"
                                      value="<?php echo $ZgodaDaneDSA; ?>" data-kolumna="ZgodaDaneDSA"
                                      class="fa fa<?php echo ($ZgodaDaneDSA == 1) ? '-check' : ''; ?>-square-o fa-2 float_l attrValue"
                                      aria-hidden="true"></i>
                <p>Wyrażam zgodę na przekazanie moich danych kontaktowych (telefon, adres poczty elektronicznej, adres zamieszkania) dla podmiotu: DSA Investment S.A. Al. Wiśniowa 47, 53-126 Wrocław w zakresie danych teleadresowych w celu sporządzenia oferty produktów finansowych i ubezpieczeń osobowych.</p></div>
            <div class="clear_b"></div>
        </div>
<!--        <div class="zaznaczPoleGrupa ">-->
<!--            <div class="zpg_opcja "><i data-wartosc_domyslna="--><?php //echo $ZgodaDaneProtecta; ?><!--" value="--><?php //echo $ZgodaDaneProtecta; ?><!--"-->
<!--                                       data-kolumna="ZgodaDaneProtecta"-->
<!--                                       class="fa fa--><?php //echo ($ZgodaDaneProtecta == 1) ? '-check' : ''; ?><!---square-o fa-2 float_l attrValue"-->
<!--                                       aria-hidden="true"></i>-->
<!--                <p>Wyrażam zgodę na przekazanie moich danych osobowych Protecta sp. z o.o., ul Kościuszki 16b/4-5, 87-800 Włocławek w zakresie danych teleadresowych w celu sporządzenia oferty usług dla przedsiębiorców.</p></div>-->
<!--            <div class="clear_b"></div>-->
<!--        </div>-->

        <div class="zaznaczPoleGrupa ">
            <div class="zpg_opcja "><i data-wartosc_domyslna="<?php echo $ZgodaDanePCRF; ?>" value="<?php echo $ZgodaDanePCRF; ?>"
                                       data-kolumna="ZgodaDanePCRF"
                                       class="fa fa<?php echo ($ZgodaDanePCRF == 1) ? '-check' : ''; ?>-square-o fa-2 float_l attrValue"
                                       aria-hidden="true"></i>
                <p>Wyrażam zgodę na przekazanie moich danych kontaktowych (telefon, adres poczty elektronicznej, adres zamieszkania) dla podmiotu: Polskie Centrum Rehabilitacji Funkcjonalnej Votum S.A. Sp. k., Golikówka 6, 30-723 Kraków, KRS: 0000290430  , w zakresie danych zawartych w umowie i przekazanej dokumentacji, w tym stanu zdrowia w celu sporządzenia oferty rehabilitacji.</p></div>
            <div class="clear_b"></div>
        </div>

        <div class="zaznaczPoleGrupa ">
            <div class="zpg_opcja "><i data-wartosc_domyslna="<?php echo $ZgodaDaneFundacja; ?>" value="<?php echo $ZgodaDaneFundacja; ?>"
                                       data-kolumna="ZgodaDaneFundacja"
                                       class="fa fa<?php echo ($ZgodaDaneFundacja == 1) ? '-check' : ''; ?>-square-o fa-2 float_l attrValue"
                                       aria-hidden="true"></i>
                <p>Wyrażam zgodę na przekazanie moich danych kontaktowych (telefon, adres poczty elektronicznej, adres zamieszkania) dla podmiotu: Fundacja VOTUM, ul. Wyścigowa 56i, 53-012 Wrocław, KRS: 0000272272, w zakresie danych zawartych w umowie i przekazanej dokumentacji, w tym stanu zdrowia w celu przedstawienia możliwego zakresu pomocy.</p></div>
            <div class="clear_b"></div>
        </div>

        <div class="zaznaczPoleGrupa ">
            <div class="zpg_opcja "><i data-wartosc_domyslna="<?php echo $ZgodaDaneAutovotum; ?>" value="<?php echo $ZgodaDaneAutovotum; ?>"
                                       data-kolumna="ZgodaDaneAutovotum"
                                       class="fa fa<?php echo ($ZgodaDaneAutovotum == 1) ? '-check' : ''; ?>-square-o fa-2 float_l attrValue"
                                       aria-hidden="true"></i>
                <p>Wyrażam zgodę na przekazanie moich danych kontaktowych (telefon, adres poczty elektronicznej, adres zamieszkania) dla podmiotu: AUTOVOTUM S.A., ul. Wyścigowa 56i, 53-012 Wrocław, KRS: 0000273033, w zakresie danych teleadresowych w celu sporządzenia oferty usług wynajmu pojazdów zastępczych.</p></div>
            <div class="clear_b"></div>
        </div>

        <div class="zaznaczPoleGrupa ">
            <div class="zpg_opcja "><i data-wartosc_domyslna="<?php echo $ZgodaDaneBEP; ?>" value="<?php echo $ZgodaDaneBEP; ?>"
                                       data-kolumna="ZgodaDaneBEP"
                                       class="fa fa<?php echo ($ZgodaDaneBEP == 1) ? '-check' : ''; ?>-square-o fa-2 float_l attrValue"
                                       aria-hidden="true"></i>
                <p>Wyrażam zgodę na przekazanie moich danych kontaktowych (telefon, adres poczty elektronicznej, adres zamieszkania) dla podmiotu: Biuro Ekspertyz Procesowych sp. z o.o., Aleja Wiśniowa 47, 53-126 Wrocław, KRS:  0000565095, w zakresie danych teleadresowych w celu sporządzenia oferty cesji wierzytelności dotyczącej szkody w pojeździe.</p></div>
            <div class="clear_b"></div>
        </div>


        <div class="zaznaczPoleGrupa ">
            <div class="zpg_opcja "><i data-wartosc_domyslna="<?php echo $ZgodaInfDSA; ?>"
                                       value="<?php echo $ZgodaInfDSA; ?>" data-kolumna="ZgodaInfDSA"
                                       class="fa fa<?php echo ($ZgodaInfDSA == 1) ? '-check' : ''; ?>-square-o fa-2 float_l attrValue"
                                       aria-hidden="true"></i>
                <p>Wyrażam zgodę na przesyłanie informacji handlowych za pośrednictwem środków komunikacji elektronicznej zgodnie z ustawą z dn. 08.07.2002 r. o świadczeniu usług drogą elektroniczną (Dz.U. z 2017r. poz. 1219) przez DSA Investment S.A. Al. Wiśniowa 47, 53-126 Wrocław, KRS nr 0000391830.</p></div>
            <div class="clear_b"></div>
        </div>
        <div class="zaznaczPoleGrupa ">
            <div class="zpg_opcja "><i data-wartosc_domyslna="<?php echo $ZgodaMarketingDSA; ?>"
                                       value="<?php echo $ZgodaMarketingDSA; ?>" data-kolumna="ZgodaMarketingDSA"
                                       class="fa fa<?php echo ($ZgodaMarketingDSA == 1) ? '-check' : ''; ?>-square-o fa-2 float_l attrValue"
                                       aria-hidden="true"></i>
                <p>Wyrażam zgodę na przekazywanie treści marketingowych na podany przeze mnie nr telefonu w tym przy użyciu automatycznych systemów wywołujących w rozumieniu ustawy z dn. 16.07.2004 r. Prawo telekomunikacyjne (Dz.U. z 2017 r. poz. 1907) przez DSA Investment S.A. Al. Wiśniowa 47, 53-126 Wrocław, KRS nr 0000391830.</p></div>
            <div class="clear_b"></div>
        </div>

        <div class="zaznaczPoleGrupa ">
            <div class="zpg_opcja "><i data-wartosc_domyslna="<?php echo $ZgodaInfVotum; ?>"
                                       value="<?php echo $ZgodaInfVotum; ?>" data-kolumna="ZgodaInfVotum"
                                       class="fa fa<?php echo ($ZgodaInfVotum == 1) ? '-check' : ''; ?>-square-o fa-2 float_l attrValue"
                                       aria-hidden="true"></i>
                <p>Wyrażam zgodę na przesyłanie informacji handlowych za pośrednictwem środków komunikacji elektronicznej zgodnie z ustawą z dn. 08.07.2002 r. o świadczeniu usług drogą elektroniczną (Dz.U. z 2017r. poz. 1219) przez VOTUM S.A., ul. Wyścigowa 56i, 53-012 Wrocław, KRS nr 0000243252.</p></div>
            <div class="clear_b"></div>
        </div>
        <div class="zaznaczPoleGrupa ">
            <div class="zpg_opcja "><i data-wartosc_domyslna="<?php echo $ZgodaMarketingVotum; ?>"
                                       value="<?php echo $ZgodaMarketingVotum; ?>" data-kolumna="ZgodaMarketingVotum"
                                       class="fa fa<?php echo ($ZgodaMarketingVotum == 1) ? '-check' : ''; ?>-square-o fa-2 float_l attrValue"
                                       aria-hidden="true"></i>
                <p>Wyrażam zgodę na przekazywanie treści marketingowych na podany przeze mnie nr telefonu w tym przy użyciu automatycznych systemów wywołujących w rozumieniu ustawy z dn. 16.07.2004 r. Prawo telekomunikacyjne (Dz.U. z 2017 r. poz. 1907) przez VOTUM S.A., ul. Wyścigowa 56i, 53-012 Wrocław, KRS nr 0000243252.</p></div>
            <div class="clear_b"></div>
        </div>

        <button data-reakcja="<?php echo ($akcja == 'nowy') ? 'zapisz_zmiany' : 'zapisz_przeladuj_widok'; ?>"
                data-droga="<?php echo $droga; ?>" data-klasa_rodzic="daneStronyUmowyPopUp"
                data-element_id="<?php echo $element_id; ?>" data-tabela="umowa<?php echo mb_ucfirst($droga); ?>"
                data-strona="zgody" data-ogolne="1" data-akcja="aktualizuj_strone_umowy" type="button"
                class="przyciskZapiszZmianyZielony margin_t_10 wczytajStroneDrogiUmowyDoPopUp btn btn-success width_100 margin_b_0">
            Zapisz zmiany
        </button>


    </div>
    <?php
}

if ($umowa->UmowaTypId == '2') {
?>
    <div class="daneStronyUmowyPopUp">

        <label class="margin_t_10 width_100 gray_background">ZGODY</label>

        <div class="zaznaczPoleGrupa ">
            <div class="zpg_opcja"><i data-wartosc_domyslna="<?php echo $OswiadczenieODzialalnosci; ?>"
                                      value="<?php echo $OswiadczenieODzialalnosci; ?>" data-kolumna="OswiadczenieODzialalnosci"
                                      class="fa fa<?php echo ($OswiadczenieODzialalnosci == 1) ? '-check' : ''; ?>-square-o fa-2 float_l attrValue"
                                      aria-hidden="true"></i>
                <p>Oświadczam, że prowadzę pozarolniczą działalność gospodarczą</p></div>
            <div class="clear_b"></div>
        </div>

        <div class="zaznaczPoleGrupa ">
            <div class="zpg_opcja"><i data-wartosc_domyslna="<?php echo $OfertaProtecta; ?>"
                                      value="<?php echo $OfertaProtecta; ?>" data-kolumna="OfertaProtecta"
                                      class="fa fa<?php echo ($OfertaProtecta == 1) ? '-check' : ''; ?>-square-o fa-2 float_l attrValue"
                                      aria-hidden="true"></i>
                <p>Jestem zainteresowany/a ofertą produktów finansowych i wyrażam zgodę na przekazywanie Protecta Finance Sp. z o.o.
                    we Włocławku moich danych osobowych w celach marketingowych, w szczególności w celu opracowania i przedstawienia oferty</p></div>
            <div class="clear_b"></div>
        </div>

        <div class="zaznaczPoleGrupa ">
            <div class="zpg_opcja"><i data-wartosc_domyslna="<?php echo $OfertaFinansowa; ?>"
                                      value="<?php echo $OfertaFinansowa; ?>" data-kolumna="OfertaFinansowa"
                                      class="fa fa<?php echo ($OfertaFinansowa == 1) ? '-check' : ''; ?>-square-o fa-2 float_l attrValue"
                                      aria-hidden="true"></i>
                <p>Nie jestem zainteresowany/a ofertą produktów finansowych</p></div>
            <div class="clear_b"></div>
        </div>

        <div class="zaznaczPoleGrupa ">
            <div class="zpg_opcja"><i data-wartosc_domyslna="<?php echo $ZgodaNaInformacje; ?>"
                                      value="<?php echo $ZgodaNaInformacje; ?>" data-kolumna="ZgodaNaInformacje"
                                      class="fa fa<?php echo ($ZgodaNaInformacje == 1) ? '-check' : ''; ?>-square-o fa-2 float_l attrValue"
                                      aria-hidden="true"></i>
                <p>Wyrażam zgodę na otrzymywanie informacji związanych z wykonaniem umowy poprzez:</p></div>
            <div class="clear_b"></div>
        </div>
        <div class="zaznaczPoleGrupa ">
            <div class="zpg_opcja "><i data-wartosc_domyslna="<?php echo $ZgodaSms; ?>" value="<?php echo $ZgodaSms; ?>"
                                       data-kolumna="ZgodaSms"
                                       class="fa fa<?php echo ($ZgodaSms == 1) ? '-check' : ''; ?>-square-o fa-2 float_l attrValue"
                                       aria-hidden="true"></i>
                <p>Wiadomości tekstowe SMS</p></div>
            <div class="clear_b"></div>
        </div>
        <div class="zaznaczPoleGrupa ">
            <div class="zpg_opcja "><i data-wartosc_domyslna="<?php echo $ZgodaMail; ?>"
                                       value="<?php echo $ZgodaMail; ?>" data-kolumna="ZgodaMail"
                                       class="fa fa<?php echo ($ZgodaMail == 1) ? '-check' : ''; ?>-square-o fa-2 float_l attrValue"
                                       aria-hidden="true"></i>
                <p>Wiadomości email</p></div>
            <div class="clear_b"></div>
        </div>

        <button data-reakcja="<?php echo ($akcja == 'nowy') ? 'zapisz_zmiany' : 'zapisz_przeladuj_widok'; ?>"
                data-droga="<?php echo $droga; ?>" data-klasa_rodzic="daneStronyUmowyPopUp"
                data-element_id="<?php echo $element_id; ?>" data-tabela="umowa<?php echo mb_ucfirst($droga); ?>"
                data-strona="zgody" data-ogolne="1" data-akcja="aktualizuj_strone_umowy" type="button"
                class="przyciskZapiszZmianyZielony margin_t_10 wczytajStroneDrogiUmowyDoPopUp btn btn-success width_100 margin_b_0">
            Zapisz zmiany
        </button>


    </div>
<?php
}
if ($umowa->UmowaTypId == '3') {
    ?>
    <div class="daneStronyUmowyPopUp">

        <label class="margin_t_10 width_100 gray_background">ZGODY</label>

        <div class="zaznaczPoleGrupa margin_t_10">
            <div class="zpg_opcja"><i data-wartosc_domyslna="<?php echo $ZgodaDaneDSA; ?>"
                                      value="<?php echo $ZgodaDaneDSA; ?>" data-kolumna="ZgodaDaneDSA"
                                      class="fa fa<?php echo ($ZgodaDaneDSA == 1) ? '-check' : ''; ?>-square-o fa-2 float_l attrValue"
                                      aria-hidden="true"></i>
                <p>Wyrażam zgodę na przekazanie moich danych kontaktowych (telefon, adres poczty elektronicznej, adres zamieszkania) dla podmiotu: DSA Investment S.A. Al. Wiśniowa 47, 53-126 Wrocław w zakresie danych teleadresowych w celu sporządzenia oferty produktów finansowych i ubezpieczeń osobowych.</p></div>
            <div class="clear_b"></div>
        </div>
        <div class="zaznaczPoleGrupa ">
            <div class="zpg_opcja "><i data-wartosc_domyslna="<?php echo $ZgodaDanePCRF; ?>" value="<?php echo $ZgodaDanePCRF; ?>"
                                       data-kolumna="ZgodaDanePCRF"
                                       class="fa fa<?php echo ($ZgodaDanePCRF == 1) ? '-check' : ''; ?>-square-o fa-2 float_l attrValue"
                                       aria-hidden="true"></i>
                <p>Wyrażam zgodę na przekazanie moich danych kontaktowych (telefon, adres poczty elektronicznej, adres zamieszkania) dla podmiotu: Polskie Centrum Rehabilitacji Funkcjonalnej Votum S.A. Sp. k., Golikówka 6, 30-723 Kraków, KRS: 0000290430  , w zakresie danych zawartych w umowie i przekazanej dokumentacji, w tym stanu zdrowia w celu sporządzenia oferty rehabilitacji.</p></div>
            <div class="clear_b"></div>
        </div>

        <div class="zaznaczPoleGrupa ">
            <div class="zpg_opcja "><i data-wartosc_domyslna="<?php echo $ZgodaDaneFundacja; ?>" value="<?php echo $ZgodaDaneFundacja; ?>"
                                       data-kolumna="ZgodaDaneFundacja"
                                       class="fa fa<?php echo ($ZgodaDaneFundacja == 1) ? '-check' : ''; ?>-square-o fa-2 float_l attrValue"
                                       aria-hidden="true"></i>
                <p>Wyrażam zgodę na przekazanie moich danych kontaktowych (telefon, adres poczty elektronicznej, adres zamieszkania) dla podmiotu: Fundacja VOTUM, ul. Wyścigowa 56i, 53-012 Wrocław, KRS: 0000272272, w zakresie danych zawartych w umowie i przekazanej dokumentacji, w tym stanu zdrowia w celu przedstawienia możliwego zakresu pomocy.</p></div>
            <div class="clear_b"></div>
        </div>

        <div class="zaznaczPoleGrupa ">
            <div class="zpg_opcja "><i data-wartosc_domyslna="<?php echo $ZgodaDaneAutovotum; ?>" value="<?php echo $ZgodaDaneAutovotum; ?>"
                                       data-kolumna="ZgodaDaneAutovotum"
                                       class="fa fa<?php echo ($ZgodaDaneAutovotum == 1) ? '-check' : ''; ?>-square-o fa-2 float_l attrValue"
                                       aria-hidden="true"></i>
                <p>Wyrażam zgodę na przekazanie moich danych kontaktowych (telefon, adres poczty elektronicznej, adres zamieszkania) dla podmiotu: AUTOVOTUM S.A., ul. Wyścigowa 56i, 53-012 Wrocław, KRS: 0000273033, w zakresie danych teleadresowych w celu sporządzenia oferty usług wynajmu pojazdów zastępczych.</p></div>
            <div class="clear_b"></div>
        </div>

        <div class="zaznaczPoleGrupa ">
            <div class="zpg_opcja "><i data-wartosc_domyslna="<?php echo $ZgodaDaneBEP; ?>" value="<?php echo $ZgodaDaneBEP; ?>"
                                       data-kolumna="ZgodaDaneBEP"
                                       class="fa fa<?php echo ($ZgodaDaneBEP == 1) ? '-check' : ''; ?>-square-o fa-2 float_l attrValue"
                                       aria-hidden="true"></i>
                <p>Wyrażam zgodę na przekazanie moich danych kontaktowych (telefon, adres poczty elektronicznej, adres zamieszkania) dla podmiotu: Biuro Ekspertyz Procesowych sp. z o.o., Aleja Wiśniowa 47, 53-126 Wrocław, KRS:  0000565095, w zakresie danych teleadresowych w celu sporządzenia oferty cesji wierzytelności dotyczącej szkody w pojeździe.</p></div>
            <div class="clear_b"></div>
        </div>


        <div class="zaznaczPoleGrupa ">
            <div class="zpg_opcja "><i data-wartosc_domyslna="<?php echo $ZgodaInfDSA; ?>"
                                       value="<?php echo $ZgodaInfDSA; ?>" data-kolumna="ZgodaInfDSA"
                                       class="fa fa<?php echo ($ZgodaInfDSA == 1) ? '-check' : ''; ?>-square-o fa-2 float_l attrValue"
                                       aria-hidden="true"></i>
                <p>Wyrażam zgodę na przesyłanie informacji handlowych za pośrednictwem środków komunikacji elektronicznej zgodnie z ustawą z dn. 08.07.2002 r. o świadczeniu usług drogą elektroniczną (Dz.U. z 2017r. poz. 1219) przez DSA Investment S.A. Al. Wiśniowa 47, 53-126 Wrocław, KRS nr 0000391830.</p></div>
            <div class="clear_b"></div>
        </div>
        <div class="zaznaczPoleGrupa ">
            <div class="zpg_opcja "><i data-wartosc_domyslna="<?php echo $ZgodaMarketingDSA; ?>"
                                       value="<?php echo $ZgodaMarketingDSA; ?>" data-kolumna="ZgodaMarketingDSA"
                                       class="fa fa<?php echo ($ZgodaMarketingDSA == 1) ? '-check' : ''; ?>-square-o fa-2 float_l attrValue"
                                       aria-hidden="true"></i>
                <p>Wyrażam zgodę na przekazywanie treści marketingowych na podany przeze mnie nr telefonu w tym przy użyciu automatycznych systemów wywołujących w rozumieniu ustawy z dn. 16.07.2004 r. Prawo telekomunikacyjne (Dz.U. z 2017 r. poz. 1907) przez DSA Investment S.A. Al. Wiśniowa 47, 53-126 Wrocław, KRS nr 0000391830.</p></div>
            <div class="clear_b"></div>
        </div>

        <div class="zaznaczPoleGrupa ">
            <div class="zpg_opcja "><i data-wartosc_domyslna="<?php echo $ZgodaInfVotum; ?>"
                                       value="<?php echo $ZgodaInfVotum; ?>" data-kolumna="ZgodaInfVotum"
                                       class="fa fa<?php echo ($ZgodaInfVotum == 1) ? '-check' : ''; ?>-square-o fa-2 float_l attrValue"
                                       aria-hidden="true"></i>
                <p>Wyrażam zgodę na przesyłanie informacji handlowych za pośrednictwem środków komunikacji elektronicznej zgodnie z ustawą z dn. 08.07.2002 r. o świadczeniu usług drogą elektroniczną (Dz.U. z 2017r. poz. 1219) przez VOTUM S.A., ul. Wyścigowa 56i, 53-012 Wrocław, KRS nr 0000243252.</p></div>
            <div class="clear_b"></div>
        </div>
        <div class="zaznaczPoleGrupa ">
            <div class="zpg_opcja "><i data-wartosc_domyslna="<?php echo $ZgodaMarketingVotum; ?>"
                                       value="<?php echo $ZgodaMarketingVotum; ?>" data-kolumna="ZgodaMarketingVotum"
                                       class="fa fa<?php echo ($ZgodaMarketingVotum == 1) ? '-check' : ''; ?>-square-o fa-2 float_l attrValue"
                                       aria-hidden="true"></i>
                <p>Wyrażam zgodę na przekazywanie treści marketingowych na podany przeze mnie nr telefonu w tym przy użyciu automatycznych systemów wywołujących w rozumieniu ustawy z dn. 16.07.2004 r. Prawo telekomunikacyjne (Dz.U. z 2017 r. poz. 1907) przez VOTUM S.A., ul. Wyścigowa 56i, 53-012 Wrocław, KRS nr 0000243252.</p></div>
            <div class="clear_b"></div>
        </div>

        <button data-reakcja="<?php echo ($akcja == 'nowy') ? 'zapisz_zmiany' : 'zapisz_przeladuj_widok'; ?>"
                data-droga="<?php echo $droga; ?>" data-klasa_rodzic="daneStronyUmowyPopUp"
                data-element_id="<?php echo $element_id; ?>" data-tabela="umowa<?php echo mb_ucfirst($droga); ?>"
                data-strona="zgody" data-ogolne="1" data-akcja="aktualizuj_strone_umowy" type="button"
                class="przyciskZapiszZmianyZielony margin_t_10 wczytajStroneDrogiUmowyDoPopUp btn btn-success width_100 margin_b_0">
            Zapisz zmiany
        </button>


    </div>
    <?php
}if ($umowa->UmowaTypId == '4') {

    $TypSzkodyId = $umowa_dane->TypSzkodyId;

    ?>
    <div class="daneStronyUmowyPopUp">

        <label class="margin_t_10 width_100 gray_background">ZGODY</label>

        <?php if ($TypSzkodyId == 1) { ?>
        <div class="zaznaczPoleGrupa margin_t_10">
            <div class="zpg_opcja"><i data-wartosc_domyslna="<?php echo $OfertaPCRF; ?>"
                                      value="<?php echo $OfertaPCRF; ?>" data-kolumna="OfertaPCRF"
                                      class="fa fa<?php echo ($OfertaPCRF == 1) ? '-check' : ''; ?>-square-o fa-2 float_l attrValue"
                                      aria-hidden="true"></i>
                <p>Jestem zainteresowana/y ofertą rehabilitacyjną i wyrażam zgodę na przekazywanie PCRF Votum S.A. Sp. k. w Krakowie
                    moich danych osobowych lub danych osobowych małoletniego / ubezwłasnowolnionego / małżonka, którego reprezentuję,
                    w tym informacji dotyczących stanu zdrowia, w celu opracowania i przedstawienia oferty.</p></div>
            <div class="clear_b"></div>
        </div>
        <?php } ?>


        <?php if ($TypSzkodyId == 1) { ?>
        <div class="zaznaczPoleGrupa ">
            <div class="zpg_opcja"><i data-wartosc_domyslna="<?php echo $OfertaFundacji; ?>"
                                      value="<?php echo $OfertaFundacji; ?>" data-kolumna="OfertaFundacji"
                                      class="fa fa<?php echo ($OfertaFundacji == 1) ? '-check' : ''; ?>-square-o fa-2 float_l attrValue"
                                      aria-hidden="true"></i>
                <p>Jestem zainteresowana/y objęciem mnie pomocą przez Fundację VOTUM i wyrażam zgodę na przekazanie Fundacji VOTUM we Wrocławiu moich
                    danych osobowych lub danych osobowych małoletniego / ubezwłasnowolnionego / małżonka, którego reprezentuję, w tym informacji dotyczących
                    stanu zdrowia, w celu opracowania i przedstawienia możliwego zakresu pomocy.</p></div>
            <div class="clear_b"></div>
        </div>
        <?php } ?>

        <?php if ($TypSzkodyId == 1) { ?>
        <div class="zaznaczPoleGrupa ">
            <div class="zpg_opcja"><i data-wartosc_domyslna="<?php echo $OfertaGamma; ?>"
                                      value="<?php echo $OfertaGamma; ?>" data-kolumna="OfertaGamma"
                                      class="fa fa<?php echo ($OfertaGamma == 1) ? '-check' : ''; ?>-square-o fa-2 float_l attrValue"
                                      aria-hidden="true"></i>
                <p>Jestem zainteresowana/y ofertą usług medycznych i wyrażam zgodę na przekazywanie „Centrum Medycznemu Gamma” Sp. z o.o. w Warszawie moich danych
                    osobowych lub danych osobowych małoletniego / ubezwłasnowolnionego / małżonka, którego reprezentuję, w tym informacji dotyczących stanu zdrowia,
                    w celu opracowania i przedstawienia oferty.</p></div>
            <div class="clear_b"></div>
        </div>
        <?php } ?>

        <?php if ($TypSzkodyId == 1) { ?>
        <div class="zaznaczPoleGrupa ">
            <div class="zpg_opcja"><i data-wartosc_domyslna="<?php echo $OswiadczenieODzialalnosci; ?>"
                                      value="<?php echo $OswiadczenieODzialalnosci; ?>" data-kolumna="OswiadczenieODzialalnosci"
                                      class="fa fa<?php echo ($OswiadczenieODzialalnosci == 1) ? '-check' : ''; ?>-square-o fa-2 float_l attrValue"
                                      aria-hidden="true"></i>
                <p>Oświadczam, że prowadzę pozarolniczą działalność gospodarczą</p></div>
            <div class="clear_b"></div>
        </div>
        <?php } ?>


        <div class="zaznaczPoleGrupa ">
            <div class="zpg_opcja"><i data-wartosc_domyslna="<?php echo $OfertaProtecta; ?>"
                                      value="<?php echo $OfertaProtecta; ?>" data-kolumna="OfertaProtecta"
                                      class="fa fa<?php echo ($OfertaProtecta == 1) ? '-check' : ''; ?>-square-o fa-2 float_l attrValue"
                                      aria-hidden="true"></i>
                <p>Jestem zainteresowany/a ofertą produktów finansowych i wyrażam zgodę na przekazywanie Protecta Finance Sp. z o.o.
                    we Włocławku moich danych osobowych w celach marketingowych, w szczególności w celu opracowania i przedstawienia oferty</p></div>
            <div class="clear_b"></div>
        </div>


        <div class="zaznaczPoleGrupa ">
            <div class="zpg_opcja"><i data-wartosc_domyslna="<?php echo $ZgodaNaInformacje; ?>"
                                      value="<?php echo $ZgodaNaInformacje; ?>" data-kolumna="ZgodaNaInformacje"
                                      class="fa fa<?php echo ($ZgodaNaInformacje == 1) ? '-check' : ''; ?>-square-o fa-2 float_l attrValue"
                                      aria-hidden="true"></i>
                <p>Wyrażam zgodę na otrzymywanie informacji związanych z wykonaniem umowy poprzez:</p></div>
            <div class="clear_b"></div>
        </div>
        <div class="zaznaczPoleGrupa ">
            <div class="zpg_opcja "><i data-wartosc_domyslna="<?php echo $ZgodaSms; ?>" value="<?php echo $ZgodaSms; ?>"
                                       data-kolumna="ZgodaSms"
                                       class="fa fa<?php echo ($ZgodaSms == 1) ? '-check' : ''; ?>-square-o fa-2 float_l attrValue"
                                       aria-hidden="true"></i>
                <p>Wiadomości tekstowe SMS</p></div>
            <div class="clear_b"></div>
        </div>
        <div class="zaznaczPoleGrupa ">
            <div class="zpg_opcja "><i data-wartosc_domyslna="<?php echo $ZgodaMail; ?>"
                                       value="<?php echo $ZgodaMail; ?>" data-kolumna="ZgodaMail"
                                       class="fa fa<?php echo ($ZgodaMail == 1) ? '-check' : ''; ?>-square-o fa-2 float_l attrValue"
                                       aria-hidden="true"></i>
                <p>Wiadomości email</p></div>
            <div class="clear_b"></div>
        </div>

        <button data-reakcja="<?php echo ($akcja == 'nowy') ? 'zapisz_zmiany' : 'zapisz_przeladuj_widok'; ?>"
                data-droga="<?php echo $droga; ?>" data-klasa_rodzic="daneStronyUmowyPopUp"
                data-element_id="<?php echo $element_id; ?>" data-tabela="umowa<?php echo mb_ucfirst($droga); ?>"
                data-strona="zgody" data-ogolne="1" data-akcja="aktualizuj_strone_umowy" type="button"
                class="przyciskZapiszZmianyZielony margin_t_10 wczytajStroneDrogiUmowyDoPopUp btn btn-success width_100 margin_b_0">
            Zapisz zmiany
        </button>


    </div>
    <?php
}
?>