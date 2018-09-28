
    <div id="contract">
        <ul>
            <li class="k-state-active">
                Klient
            </li>
            <li>
                Dane o kredycie
            </li>
            <li>
                Pełnomocnictwo
            </li>
            <li>
                Zgody
            </li>
            <li>
                Dodatkowe informacje
            </li>
            <li>
                Wynagrodzenie
            </li>
        </ul>

    <div class="contract-page">
        <ul class="fieldlist">
            <div class="card">
                <div class="card-body">
                    <label for="simple-input" class="big_label" style="width: 100%; float: left;">Zleceniodawca I</label>
                    <span>
                        <a role="button" class="k-button k-button-icontext k-primary data-button" id="clear-data" href="#">Wyczyść dane</a>
                    </span>
                    <li>
                        <div style="width: 50%; float: left;" class="contract-1">
                            <label for="simple-input contract-1">Imię</label>
                            <input name="FirstNameI" id="FirstNameI" type="text" class="k-input k-textbox" value="" required validationMessage="To pole jest wymagane." style="width: 95%;"/>
                        </div>
                        <div style="width: 50%; float: left;" class="contract-1">
                            <label for="simple-input">Nazwisko</label>
                            <input name="LastNameI" type="text" id="LastNameI" class="k-input k-textbox" value="" required validationMessage="To pole jest wymagane." style="width: 100%;"/>
                        </div>
                    </li>
                    <label for="simple-input" class="small_label" style="width: 100%; float: left;">Adres zameldowania zleceniodawcy:</label>
                    <li>
                        <div style="width: 30%; float: left;">
                            <label for="simple-input">Ulica</label>
                            <input name="StreetI" type="text" id="StreetI" class="k-input k-textbox"value="" style="width: 95%;"/>
                        </div>
                        <div style="width: 20%; float: left;" >
                            <label for="simple-input">Nr domu</label>
                            <input name="HomeNumberI" type="text" id="HomeNumberI" class="k-input k-textbox" value="" style="width: 95%;"/>
                        </div>
                        <div style="width: 20%; float: left;" >
                            <label for="simple-input">Nr mieszkania</label>
                            <input name="ApartmentNumberI" type="text" id="ApartmentNumberI" class="k-input k-textbox" value="" style="width: 95%;"/>
                        </div>
                        <div style="width: 20%; float: left;" class="contract-1">
                            <label for="simple-input">Kod pocztowy</label>
                            <input name="PostCodeI" type="text" id="PostCodeI" pattern="\d{2}-\d{3}" class="k-input k-textbox" value="" style="width: 95%;"/>
                        </div>
                        <div style="width: 30%; float: left;" >
                            <label for="simple-input">Miejscowość</label>
                            <input name="CityI" type="text" id="CityI" class="k-input k-textbox" value="" style="width: 95%;"/>
                        </div>
                    </li>
                    <li>
                        <div style="width: 20%; float: left;" class="contract-required contract-1">
                            <label for="simple-input">PESEL</label>
                            <input name="PESELI" required type="text" id="PESELI" pattern="\d{11}" class="k-input k-textbox" required value="" style="width: 95%;"/>
                        </div>
                        <div style="width: 20%; float: left;" class="contract-1">
                            <label for="simple-input">Seria i numer dowodu osobistego</label>
                            <input name="IdentityCardI" id="IdentityCardI" type="text" class="k-input k-textbox" value="" required style="width: 95%;"/>
                        </div>
                        <div style="width: 20%; float: left;">
                            <label for="simple-input">Telefon*</label>
                            <input name="PhoneI" id="PhoneI" type="tel" class="k-input k-textbox" pattern="\d{9}" value="" style="width: 95%;"/>
                        </div>
                        <div style="width: 40%; float: left;">
                            <label for="simple-input">E-Mail**</label>
                            <input name="EmailI" id="EmailI" type="email" class="k-input k-textbox" value="" style="width: 100%;"/>
                        </div>
                    </li>
                </div>
            </div>
        </ul>
        <ul class="fieldlist">
            <div class="card">
                <div class="card-body">
                    <label for="simple-input" class="big_label" style="width: 100%; float: left;">Zleceniodawca II</label>
                    <span>
                        <a role="button" class="k-button k-button-icontext k-primary data-button" id="copy-address" href="#">Kopiuj adres</a>
                    </span>
                    <li>
                        <div style="width: 50%; float: left;">
                            <label for="simple-input">Imię</label>
                            <input name="FirstNameII" type="text" id="FirstNameII" class="k-input k-textbox" value=""  style="width: 95%;"/>
                        </div>
                        <div style="width: 50%; float: left;">
                            <label for="simple-input">Nazwisko</label>
                            <input name="LastNameII" type="text" id="LastNameII" class="k-input k-textbox" value=""  style="width: 100%;"/>
                        </div>
                    </li>
                    <label for="simple-input" class="small_label" style="width: 100%; float: left;">Adres zameldowania zleceniodawcy:</label>
                    <li>
                        <div style="width: 30%; float: left;">
                            <label for="simple-input">Ulica</label>
                            <input name="StreetII" type="text" id="StreetII" class="k-input k-textbox" value="" style="width: 95%;"/>
                        </div>
                        <div style="width: 20%; float: left;">
                            <label for="simple-input">Nr domu</label>
                            <input name="HomeNumberII" type="text" id="HomeNumberII" class="k-input k-textbox" value="" style="width: 95%;"/>
                        </div>
                        <div style="width: 20%; float: left;">
                            <label for="simple-input">Nr mieszkania</label>
                            <input name="ApartmentNumberII" type="text" id="ApartmentNumberII" class="k-input k-textbox" value="" style="width: 95%;"/>
                        </div>
                        <div style="width: 20%; float: left;">
                            <label for="simple-input">Kod pocztowy</label>
                            <input name="PostCodeII" type="text" id="PostCodeII" pattern="\d{2}-\d{3}" class="k-input k-textbox" value="" style="width: 95%;"/>
                        </div>
                        <div style="width: 30%; float: left;">
                            <label for="simple-input">Miejscowość</label>
                            <input name="CityII" type="text" id="CityII" class="k-input k-textbox" value="" style="width: 95%;"/>
                        </div>
                    </li>
                    <li>
                        <div style="width: 20%; float: left;" class="contract-1">
                            <label for="simple-input">PESEL</label>
                            <input name="PESELII" type="text" id="PESELII" pattern="\d{11}" class="k-input k-textbox" value="" style="width: 95%;"/>
                        </div>
                        <div style="width: 20%; float: left;" class="contract-1">
                            <label for="simple-input">Seria i numer dowodu osobistego</label>
                            <input name="IdentityCardII" type="text" id="IdentityCardII" class="k-input k-textbox" value=""  style="width: 95%;"/>
                        </div>
                        <div style="width: 20%; float: left;">
                            <label for="simple-input">Telefon*</label>
                            <input name="PhoneII" type="tel" id="PhoneII" pattern="\d{9}" class="k-input k-textbox" value="" style="width: 95%;"/>
                        </div>
                        <div style="width: 40%; float: left;">
                            <label for="simple-input">E-Mail**</label>
                            <input name="EmailII" type="email" id="EmailII" class="k-input k-textbox" value="" style="width: 100%;"/>
                        </div>
                    </li>
                </div>
            </div>
        </ul>
        <ul class="fieldlist">
            <div class="card">
                <div class="card-body address-of-correspondence-div">
                    <div class="row">
                        <div class="col-12 text-right">
                            <label for="address-of-correspondence-checkbox" style="cursor: pointer; display: inline-block">Adres korespondencyjny jest inny niż adres zameldowania</label>
                            <input type="checkbox" name="address-of-correspondence-checkbox" style="cursor: pointer" id="address-of-correspondence-checkbox"/>
                        </div>
                    </div>
                    <label for="simple-input" class="big_label" style="width: 100%; float: left;">Adres korespondencyjny</label>
                    <li>
                        <div style="width: 30%; float: left;">
                            <label for="simple-input">Ulica</label>
                            <input name="Street" type="text" class="k-input k-textbox" value="" style="width: 95%;" disabled/>
                        </div>
                        <div style="width: 20%; float: left;">
                            <label for="simple-input">Nr domu</label>
                            <input name="HomeNumber" type="text" class="k-input k-textbox" value="" style="width: 95%;" disabled/>
                        </div>
                        <div style="width: 20%; float: left;">
                            <label for="simple-input">Nr mieszkania</label>
                            <input name="ApartmentNumber" type="text" class="k-input k-textbox" value="" style="width: 95%;" disabled/>
                        </div>
                        <div style="width: 20%; float: left;">
                            <label for="simple-input">Kod pocztowy</label>
                            <input name="PostCode" type="text" pattern="\d{2}-\d{3}" class="k-input k-textbox" value="" style="width: 95%;" disabled/>
                        </div>
                        <div style="width: 30%; float: left;">
                            <label for="simple-input">Miejscowość</label>
                            <input name="City" type="text" class="k-input k-textbox" value="" style="width 95%;" disabled/>
                        </div>
                    </li>
                    <li>
                        <a role="button" class="k-button k-button-icontext k-primary updateContract nextTab1" href="#">Przejdź dalej</a>
                    </li>
                </div>
            </div>
        </ul>
    </div>
    <div class="contract-page">
        <ul class="fieldlist">
            <div class="card">
                <div class="card-body">
                    <label for="simple-input" class="big_label" style="width: 100%; float: left;">Przedmiot umowy</label>
                    <li>
                        <div style="width: 50%; float: left;" class="contract-2">
                            <label for="simple-input">Nazwa banku</label>
                            <input name="BankName" id="BankName"  type="text" class="k-input k-textbox" value="" required validationMessage="To pole jest wymagane." style="width: 95%;"/>
                        </div>
                        <div style="width: 50%; float: left;" class="contract-2">
                            <label for="simple-input">Numer umowy</label>
                            <input name="ContractNumber" type="text" class="k-input k-textbox" required validationMessage="To pole jest wymagane." value="" style="width: 100%;"/>
                        </div>

                    </li>
                </div>
            </div>
        </ul>
        <ul class="fieldlist">
            <div class="card">
                <div class="card-body">
                    <label for="simple-input" class="big_label" style="width: 100%; float: left;">Oświadczenia stron</label>
                    <li>
                        <div style="width: 100%; float: left; margin: 10px 0 0 0;">
                            <label for="simple-input" class="contact_form_content" style="width: 100%; float: left;">Klient oświadcza, że:</label>
                        </div>
                        <div style="width: 100%; float: left; margin: 10px 0 10px 0;">
                            <label for="simple-input" class="contact_form_content"> - żąda rozpoczęcia wykonywania usługi przez VOTUM przed upływem terminu do odstąpienia od umowy?</label>
                        </div>
                        <div style="width: 20%; float: left;" id="Radio1">
                            <input type="radio" name="RadioButton1" id="Button1a" value="1" class="k-radio" style="width: 25%; float: left;">
                            <label class="k-radio-label contact_form_content" for="Button1a" style="width: 25%; float: left;">tak</label>
                            <input type="radio" name="RadioButton1" id="Button1b" value="0" class="k-radio" style="width: 25%; float: left;">
                            <label class="k-radio-label contact_form_content" for="Button1b" style="width: 25%; float: left;">nie</label>
                        </div>
                        <div style="width: 100%; float: left; margin: 10px 0 10px 0;">
                            <label for="simple-input" class="contact_form_content"> - upoważnia Zleceniobiorcę do uzyskiwania informacji i dokumentów w sprawach
                                prowadzonych przez Kancelarię Adwokatów i Radców Prawnych A. Łebek i Wspólnicy sp.k. z siedzibą we Wrocławiu, w związku
                                z realizacją niniejszej umowy?</label>
                        </div>
                        <div style="width: 20%; float: left;" id="Radio2">
                            <input type="radio" name="RadioButton2" id="Button2a" value="1" class="k-radio" style="width: 25%; float: left;">
                            <label class="k-radio-label contact_form_content" for="Button2a" style="width: 25%; float: left;">tak</label>
                            <input type="radio" name="RadioButton2" id="Button2b" value="0" class="k-radio" style="width: 25%; float: left;">
                            <label class="k-radio-label contact_form_content" for="Button2b" style="width: 25%; float: left;">nie</label>
                        </div>
                        <div style="width: 100%; float: left; margin: 10px 0 10px 0;">
                            <label for="simple-input" class="contact_form_content"> - został poinformowany o sposobie i terminie prawa odstąpienia od niniejszej umowy oraz wzorze oświadczenia o odstąpieniu
                                i o pozasądowych sposobach rozpatrywania reklamacji – na odrębnym formularzu.</label>
                        </div>
                        <div style="width: 100%; float: left; margin: 10px 0 10px 0;">
                            <label for="simple-input" class="contact_form_content"> - zobowiązuje się do zachowania poufności w związku z prowadzoną sprawą, co do każdego jej etapu i nieudostępniania informacji
                                oraz dokumentacji osobom trzecim.</label>
                        </div>
                        <div style="width: 100%; float: left; margin: 10px 0 10px 0;">
                            <label for="simple-input" class="contact_form_content"> - czy zlecał wcześniej dochodzenia roszczeń innemu podmiotowi</label>
                        </div>
                        <div style="width: 20%; float: left;" id="Radio3">
                            <input type="radio" name="RadioButton3" id="Button3a" value="1" class="k-radio" style="width: 25%; float: left;">
                            <label class="k-radio-label contact_form_content" for="Button3a" style="width: 25%; float: left;">tak</label>
                            <input type="radio" name="RadioButton3" id="Button3b" value="0" class="k-radio" style="width: 25%; float: left;">
                            <label class="k-radio-label contact_form_content" for="Button3b" style="width: 25%; float: left;">nie</label>
                        </div>
                        <div style="width: 100%; float: left; margin: 10px 0 10px 0;" class="other-agent hide">
                            <span style="font-weight: normal">Nazwa pełnomocnika: </span><input type="text" name="OtherAgentName" id="OtherAgentName" class="k-input k-textbox"/><span style="font-weight: normal">, z którym zawarł umowę dnia: </span><input type="text" name="OtherAgentDate" id="OtherAgentDate" class="k-input k-textbox"/>
                        </div>

                        <div style="width: 100%; float: left; margin: 10px 0 10px 0;">
                            <label for="simple-input" class="contact_form_content"> - zgłaszał do Zobowiązanego roszczenia tytułem:</label>
                        </div>
                        <div style="width: 100%; float: left; margin: 0 0 15px 30px">
                            <input type="checkbox" id="checkbox1" name="CheckBox1" class="k-checkbox" style="margin-top: 8px;">
                            <label class="k-checkbox-label contact_form_content" for="checkbox1" style="float: left; margin: 8px 10px 0 0;">nadpłaconych rat w związku z klauzulą waloryzacyjną, data zgłoszenia</label>
                            <input name="CheckBox1Date" id="CheckBox1Date" type="text" class="k-input k-textbox" value="" style="float: left;"/>
                        </div>
                        <div style="width: 100%; float: left; margin: 0 0 15px 30px">
                            <input type="checkbox" id="checkbox2" name="CheckBox2" class="k-checkbox" style="margin-top: 8px;">
                            <label class="k-checkbox-label contact_form_content" for="checkbox2" style="float: left; margin: 8px 10px 0 0;">zapłaconych składek za Ubezpieczenie Niskiego Wkładu Własnego, data zgłoszenia</label>
                            <input name="CheckBox2Date" id="CheckBox2Date" type="text" class="k-input k-textbox" value="" style="float: left;"/>
                        </div>
                        <div style="width: 100%; float: left; margin: 0 0 15px 30px">
                            <input type="checkbox" id="checkbox3" name="CheckBox3" class="k-checkbox" style="margin-top: 8px;">
                            <label class="k-checkbox-label contact_form_content" for="checkbox3" style="float: left; margin: 8px 10px 0 0;">nadpłaconej składki za Ubezpieczenie Pomostowe, data zgłoszenia</label>
                            <input name="CheckBox3Date" id="CheckBox3Date" type="text" class="k-input k-textbox" value="" style="float: left;"/>
                        </div>
                    </li>
                    <li>
                        <a role="button" class="k-button k-button-icontext k-primary updateContract nextTab2" href="#">Przejdź dalej</a>
                    </li>
                </div>
            </div>
        </ul>

    </div>
    <div class="contract-page">
        <ul class="fieldlist">
            <div class="card">
                <div class="card-body">
                    <li>
                        <div style="width: 100%; float: left; margin: 0 0 15px 30px">
                            <div style="width: 100%; float: left; margin: 10px 0 10px 0;">
                                <div style="width: 50%; float: left;" class="contract-3">
                                    <label for="simple-input">Nazwa banku</label>
                                    <input type="text" name="MandateBankName" id="MandateBankName" class="k-input k-textbox" required validationMessage="To pole jest wymagane." style="width: 95%"/>
                                </div>
                                <div style="width: 50%; float: left;" class="contract-3">
                                    <label for="simple-input">Rodzaj kredytu</label>
                                    <input name="CreditType" id="CreditType"  type="text" class="k-input k-textbox" value="" required validationMessage="To pole jest wymagane." style="width: 95%;"/>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li>
                        <a role="button" class="k-button k-button-icontext k-primary updateContract nextTab3" href="#">Przejdź dalej</a>
                    </li>
                </div>

            </div>
        </ul>
    </div>
    <div class="contract-page">
        <ul class="fieldlist">
            <div class="card">
                <div class="card-body">
                    <label for="simple-input" class="big_label" style="width: 100%; float: left;">Zgody</label>
                    <li>
                        <div style="width: 100%; float: left; margin: 10px 0 0 0;">
                            <label for="simple-input" class="contact_form_content" style="width: 100%; float: left;">I. Wyrażam zgodę na przekazanie moich danych kontaktowych (telefon, adres poczty elektronicznej, adres zamieszkania) następującym
                                podmiotom:</label>
                        </div>
                        <div style="width: 100%; float: left; margin: 0 0 15px 30px">
                            <input type="checkbox" id="dataConsentDSA" name="dataConsentDSA" class="k-checkbox" style="margin-top: 8px;">
                            <label class="k-checkbox-label contact_form_content" for="dataConsentDSA" style="float: left; margin: 8px 10px 0 0;">DSA Investment S.A. Al. Wiśniowa 47, 53-126 Wrocław, KRS: 0000391830, w zakresie danych teleadresowych w celu sporządzenia oferty
                                produktów finansowych i ubezpieczeń osobowych:</label>
                        </div>
                        <div style="width: 100%; float: left; margin: 0 0 15px 30px">
                            <input type="checkbox" id="dataConsentPCRF" name="dataConsentPCRF" class="k-checkbox" style="margin-top: 8px;">
                            <label class="k-checkbox-label contact_form_content" for="dataConsentPCRF" style="float: left; margin: 8px 10px 0 0;">Polskie Centrum Rehabilitacji Funkcjonalnej Votum S.A. Sp. k., Golikówka 6, 30-723 Kraków, KRS: 0000290430 , w zakresie danych
                                zawartych w umowie i przekazanej dokumentacji, w tym stanu zdrowia w celu sporządzenia oferty rehabilitacji:</label>
                        </div>
                        <div style="width: 100%; float: left; margin: 0 0 15px 30px">
                            <input type="checkbox" id="dataConsentVOTUM" name="dataConsentVOTUM" class="k-checkbox" style="margin-top: 8px;">
                            <label class="k-checkbox-label contact_form_content" for="dataConsentVOTUM" style="float: left; margin: 8px 10px 0 0;">Fundacja VOTUM, ul. Wyścigowa 56i, 53-012 Wrocław, KRS: 0000272272, w zakresie danych zawartych w umowie i przekazanej dokumentacji,
                                w tym stanu zdrowia w celu przedstawienia możliwego zakresu pomocy:</label>
                        </div>
                        <div style="width: 100%; float: left; margin: 0 0 15px 30px">
                            <input type="checkbox" id="dataConsentAUTOVOTUM" name="dataConsentAUTOVOTUM" class="k-checkbox" style="margin-top: 8px;">
                            <label class="k-checkbox-label contact_form_content" for="dataConsentAUTOVOTUM" style="float: left; margin: 8px 10px 0 0;">AUTOVOTUM S.A., ul. Wyścigowa 56i, 53-012 Wrocław, KRS: 0000273033, w zakresie danych teleadresowych w celu sporządzenia oferty
                                usług wynajmu pojazdów zastępczych;</label>
                        </div>
                        <div style="width: 100%; float: left; margin: 0 0 15px 30px">
                            <input type="checkbox" id="dataConsentBEP" name="dataConsentBEP" class="k-checkbox" style="margin-top: 8px;">
                            <label class="k-checkbox-label contact_form_content" for="dataConsentBEP" style="float: left; margin: 8px 10px 0 0;">Biuro Ekspertyz Procesowych sp. z o.o., Aleja Wiśniowa 47, 53-126 Wrocław, KRS: 0000565095, w zakresie danych teleadresowych w celu
                                sporządzenia oferty cesji wierzytelności dotyczącej szkody w pojeździe.</label>
                        </div>
                        <div style="width: 100%; float: left; margin: 10px 0 0 0;">
                            <label for="simple-input" class="contact_form_content" style="width: 100%; float: left;">II. Wyrażam zgodę na wykonywanie następujących czynności przez:</label>
                        </div>
                        <div style="width: 100%; float: left; margin: 0 0 15px 30px">
                            <label for="simple-input" class="contact_form_content" style="width: 100%; float: left;">1. DSA Investment S.A., Al. Wiśniowa 47,53-126 Wrocław,</label>
                            <input type="checkbox" id="marketingConsentDSA1" name="marketingConsentDSA1" class="k-checkbox" style="margin-top: 8px;">
                            <label class="k-checkbox-label contact_form_content" for="marketingConsentDSA1" style="float: left; margin: 8px 10px 0 0;">a) Przesłanie informacji handlowych za pośrednictwem środków komunikacji elektronicznej, zgodnie z ustawą z dnia 08.07.2002 r. o świadczeniu
                                usług drogą elektroniczną (Dz.U. z 2016 r. poz.1030)</label>
                            <input type="checkbox" id="marketingConsentDSA2" name="marketingConsentDSA2" class="k-checkbox" style="margin-top: 8px;">
                            <label class="k-checkbox-label contact_form_content" for="marketingConsentDSA2" style="float: left; margin: 8px 10px 0 0;">b) Przekazywanie treści marketingowych na podany przez mnie nr telefonu w tym przy użyciu automatycznych systemów wywołujących
                                w rozumieniu ustawy z dnia 17.07.2004 r. Prawo telekomunikacyjne (Dz.U. z 2016 r. poz. 1489)</label>
                        </div>
                        <div style="width: 100%; float: left; margin: 0 0 15px 30px">
                            <label for="simple-input" class="contact_form_content" style="width: 100%; float: left;">2. VOTUM S.A., ul. Wyścigowa 56i, 53-012 Wrocław,</label>
                            <input type="checkbox" id="marketingConsentVOTUM1" name="marketingConsentVOTUM1" class="k-checkbox" style="margin-top: 8px;">
                            <label class="k-checkbox-label contact_form_content" for="marketingConsentVOTUM1" style="float: left; margin: 8px 10px 0 0;">a) przesyłanie informacji handlowych za pośrednictwem środków komunikacji elektronicznej zgodnie z ustawą z dn. 08.07.2002 r. o świadczeniu
                                usług drogą elektroniczną (t. j. Dz.U. z 2017 r. poz. 1219)</label>
                            <input type="checkbox" id="marketingConsentVOTUM2" name="marketingConsentVOTUM2" class="k-checkbox" style="margin-top: 8px;">
                            <label class="k-checkbox-label contact_form_content" for="marketingConsentVOTUM2" style="float: left; margin: 8px 10px 0 0;">b) przekazywanie treści marketingowych na podany przeze mnie nr telefonu w tym przy użyciu automatycznych systemów wywołujących
                                w rozumieniu ustawy z dn.16.07.2004 r. Prawo telekomunikacyjne (t. j. Dz.U. z 2017 r. poz. 1907)</label>
                        </div>
                        </div>
                    </li>
                    <li>
                        <a role="button" class="k-button k-button-icontext k-primary updateContract nextTab4" href="#">Przejdź dalej</a>
                    </li>
                </div>
        </ul>

    </div>
    <div class="contract-page">
        <ul class="fieldlist">
            <div class="card">
                <div class="card-body">
<!--                    <label for="simple-input" class="big_label" style="width: 100%; float: left;">Dane do przelewu</label>-->
                    <li style="width: 100%; float: left;">
                        <div style="width: 33%; float: left;" class="contract-5">
                            <label for="simple-input">Data zawarcia umowy z bankiem</label>
                            <input name="BankContractDate" id="BankContractDate" type="text" class="k-input k-textbox" value="" style="float: left;"/>
                        </div>
                        <div style="width: 30%; float: left; margin-bottom: 30px" class="contract-5">
                            <label for="contract-type">Kod jednostki</label>
                            <input type="text" name="Unit" id="unit" >
                        </div>
                        <div style="width: 30%; float: left; margin-bottom: 30px" class="contract-5">
                            <label for="contract-type">Kod konsultanta</label>
                            <input type="text" name="Consultant" id="consultant" >
                        </div>
                    </li>
                    <li>
                        <a role="button" class="k-button k-button-icontext k-primary updateContract nextTab5" href="#">Przejdź dalej</a>
                    </li>
                </div>
            </div>
        </ul>
    </div>
    <div class="contract-page">
        <ul class="fieldlist">
            <div class="card">
                <div class="card-body">
                    <label for="simple-input" class="big_label" style="width: 100%; float: left;">Dane do przelewu</label>
                    <li>
                        <div style="width: 100%; float: left; margin: 10px 0 10px 0;">
                            <label for="simple-input" class="contact_form_content">Odbiorcą świadczenia jest:</label>
                        </div>
                        <div style="width: 50%; float: left;" id="Customer">
                            <input type="radio" name="RadioCustomer" id="CustomerA" value="1" class="k-radio" style="width: 10%; float: left;">
                            <label class="k-radio-label contact_form_content" for="CustomerA" style="width: 40%; float: left;">Zleceniodawca I</label>
                            <input type="radio" name="RadioCustomer" id="CustomerB" value="2" class="k-radio" style="width: 10%; float: left;">
                            <label class="k-radio-label contact_form_content" for="CustomerB" style="width: 40%; float: left;">Zleceniodawca II</label>
                        </div>
                    </li>
                    <li style="width: 100%; float: left;">
                        <div style="width: 33%; float: left;" class="contract-6">
                            <label for="simple-input">Numer konta</label>
                            <input name="AccountNumber" id="AccountNumber" type="text" class="k-input k-textbox" required validationMessage="To pole jest wymagane." value="" style="width: 95%;"/>
                        </div>
                        <div style="width: 33%; float: left;">
                            <label for="simple-input">Imię</label>
                            <input name="CustomerFirstName" id="CustomerFirstName" type="text" class="k-input k-textbox" value="" style="width: 95%;"/>
                        </div>
                        <div style="width: 34%; float: left;">
                            <label for="simple-input">Nazwisko</label>
                            <input name="CustomerLastName" id="CustomerLastName" type="text" class="k-input k-textbox" value="" style="width: 100%;"/>
                        </div>
                    </li>
                    <li style="width: 100%; float: left;">
                        <div style="width: 30%; float: left;">
                            <label for="simple-input">Ulica</label>
                            <input name="CustomerStreet" id="CustomerStreet" type="text" class="k-input k-textbox" value="" style="width: 95%;"/>
                        </div>
                        <div style="width: 20%; float: left;">
                            <label for="simple-input">Nr domu</label>
                            <input name="CustomerHomeNumber" id="CustomerHomeNumber" type="text" class="k-input k-textbox" value="" style="width: 95%;"/>
                        </div>
                        <div style="width: 20%; float: left;">
                            <label for="simple-input">Nr mieszkania</label>
                            <input name="CustomerApartmentNumber" id="CustomerApartmentNumber" type="text" class="k-input k-textbox" value="" style="width: 95%;"/>
                        </div>
                        <div style="width: 20%; float: left;">
                            <label for="simple-input">Kod pocztowy</label>
                            <input name="CustomerPostCode" id="CustomerPostCode" type="text" class="k-input k-textbox" pattern="\d{2}-\d{3}" value="" style="width: 95%;"/>
                        </div>
                        <div style="width: 30%; float: left;">
                            <label for="simple-input">Miejscowość</label>
                            <input name="CustomerCity" id="CustomerCity" type="text" class="k-input k-textbox" value="" style="width: 95%;"/>
                        </div>
                    </li>
                    <li style="width: 100%; float: left;">
                        <div style="width: 30%; float: left; margin-bottom: 30px" class="contract-6">
                            <label for="contract-type">Wybierz typ umowy</label>
                            <input type="text" name="ContractType" id="contract-type" required validationMessage="To pole jest wymagane.">
                        </div>
                    </li>
                    <li class="save-contract">
                        <a role="button" id="update" class="k-button k-button-icontext k-primary k-grid-update updateContract" href="#">Zapisz</a>
                    </li>
                </div>
            </div>
        </ul>
    </div>
    </div>
    <div style="width: 100%; float: left; margin: 10px 0 10px 0;"></div>

