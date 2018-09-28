
<div id="contract-edit">
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

    <div class="tab-contract">
        <ul class="fieldlist">
            <div class="card">
                <div class="card-body">
                    <label for="simple-input" class="big_label" style="width: 100%; float: left;">Zleceniodawca
                        I</label>
                    <span>
                        <a role="button" class="k-button k-button-icontext k-primary data-button odswierzSesje"
                           id="clear-data-edit" href="\#">Wyczyść dane</a>
                    </span>
                    <li>
                        <div style="width: 50%; float: left;" class="contract-1-edit">
                            <label for="simple-input contract-1-edit">Imię</label>
                            <input name="FirstNameIEdit" id="FirstNameIEdit" type="text" class="k-input k-textbox contract-edit-field" value=""
                                   required validationMessage="To pole jest wymagane." style="width: 95%;"/>
                        </div>
                        <div style="width: 50%; float: left;" class="contract-1-edit">
                            <label for="simple-input">Nazwisko</label>
                            <input name="LastNameIEdit" type="text" id="LastNameIEdit" class="k-input k-textbox contract-edit-field" value=""
                                   required validationMessage="To pole jest wymagane." style="width: 100%;"/>
                        </div>
                    </li>
                    <label for="simple-input" class="small_label" style="width: 100%; float: left;">Adres zameldowania
                        zleceniodawcy:</label>
                    <li>
                        <div style="width: 30%; float: left;">
                            <label for="simple-input">Ulica</label>
                            <input name="StreetIEdit" type="text" id="StreetIEdit" class="k-input k-textbox contract-edit-field" value=""
                                   style="width: 95%;"/>
                        </div>
                        <div style="width: 20%; float: left;">
                            <label for="simple-input">Nr domu</label>
                            <input name="HomeNumberIEdit" type="text" maxlength="10" id="HomeNumberIEdit" class="k-input k-textbox contract-edit-field" value=""
                                   style="width: 95%;"/>
                        </div>
                        <div style="width: 20%; float: left;">
                            <label for="simple-input">Nr mieszkania</label>
                            <input name="ApartmentNumberIEdit" type="text" maxlength="10" id="ApartmentNumberIEdit" class="k-input k-textbox contract-edit-field" value=""
                                   style="width: 95%;"/>
                        </div>
                        <div style="width: 20%; float: left;">
                            <label for="simple-input">Kod pocztowy</label>
                            <input name="PostCodeIEdit" type="text" pattern="[0-9]{2}\-[0-9]{3}" id="PostCodeIEdit"
                                   class="k-input k-textbox contract-edit-field" validationMessage="Błędny format." value="" style="width: 95%;"/>
                        </div>
                        <div style="width: 30%; float: left;">
                            <label for="simple-input">Miejscowość</label>
                            <input name="CityIEdit" type="text" id="CityIEdit" class="k-input k-textbox contract-edit-field" value=""
                                   style="width: 100%;"/>
                        </div>
                    </li>
                    <li>
                        <div style="width: 20%; float: left;" class="contract-required contract-1-edit">
                            <label for="simple-input">PESEL</label>
                            <input name="PESELIEdit" required type="text" id="PESELIEdit"
                                   class="k-input k-textbox contract-edit-field" required
                                   value="" style="width: 95%;"/>
                        </div>
                        <div style="width: 20%; float: left;" class="contract-1-edit">
                            <label for="simple-input">Seria i numer dowodu osobistego</label>
                            <input name="IdentityCardIEdit" id="IdentityCardIEdit" type="text" class="k-input k-textbox contract-edit-field"
                                   value="" required style="width: 95%;"/>
                        </div>
                        <div style="width: 20%; float: left;">
                            <label for="simple-input">Telefon*</label>
                            <input name="PhoneIEdit" id="PhoneIEdit" type="tel" maxlength="12" class="k-input k-textbox contract-edit-field"
                                   value="" style="width: 95%;"/>
                        </div>
                        <div style="width: 40%; float: left;">
                            <label for="simple-input">E-Mail**</label>
                            <input name="EmailIEdit" id="EmailIEdit" type="email" class="k-input k-textbox contract-edit-field" value=""
                                   style="width: 100%;"/>
                        </div>
                    </li>
                </div>
            </div>
        </ul>
        <ul class="fieldlist">
            <div class="card">
                <div class="card-body">
                    <label for="simple-input" class="big_label" style="width: 100%; float: left;">Zleceniodawca
                        II</label>
                    <span>
                        <a role="button" class="k-button k-button-icontext k-primary data-button odswierzSesje"
                           id="copy-address-edit">Kopiuj adres</a>
                    </span>
                    <li>
                        <div style="width: 50%; float: left;">
                            <label for="simple-input">Imię</label>
                            <input name="FirstNameIIEdit" type="text" id="FirstNameIIEdit" class="k-input k-textbox contract-edit-field" value=""
                                   style="width: 95%;"/>
                        </div>
                        <div style="width: 50%; float: left;">
                            <label for="simple-input">Nazwisko</label>
                            <input name="LastNameIIEdit" type="text" id="LastNameIIEdit" class="k-input k-textbox contract-edit-field" value=""
                                   style="width: 100%;"/>
                        </div>
                    </li>
                    <label for="simple-input" class="small_label" style="width: 100%; float: left;">Adres zameldowania
                        zleceniodawcy:</label>
                    <li>
                        <div style="width: 30%; float: left;">
                            <label for="simple-input">Ulica</label>
                            <input name="StreetIIEdit" type="text" id="StreetIIEdit" class="k-input k-textbox contract-edit-field" value=""
                                   style="width: 95%;"/>
                        </div>
                        <div style="width: 20%; float: left;">
                            <label for="simple-input">Nr domu</label>
                            <input name="HomeNumberIIEdit" type="text"  maxlength="10" id="HomeNumberIIEdit" class="k-input k-textbox contract-edit-field" value=""
                                   style="width: 95%;"/>
                        </div>
                        <div style="width: 20%; float: left;">
                            <label for="simple-input">Nr mieszkania</label>
                            <input name="ApartmentNumberIIEdit" type="text"  maxlength="10" id="ApartmentNumberIIEdit" class="k-input k-textbox contract-edit-field" value=""
                                   style="width: 95%;"/>
                        </div>
                        <div style="width: 20%; float: left;">
                            <label for="simple-input">Kod pocztowy</label>
                            <input name="PostCodeIIEdit" type="text" pattern="[0-9]{2}\-[0-9]{3}" id="PostCodeIIEdit"
                                   class="k-input k-textbox contract-edit-field" value="" style="width: 95%;"/>
                        </div>
                        <div style="width: 30%; float: left;">
                            <label for="simple-input">Miejscowość</label>
                            <input name="CityIIEdit" type="text" id="CityIIEdit" class="k-input k-textbox contract-edit-field" value=""
                                   style="width: 100%;"/>
                        </div>
                    </li>
                    <li>
                        <div style="width: 20%; float: left;" class="contract-1-edit">
                        <label for="simple-input">PESEL</label>
                        <input name="PESELIIEdit" type="text" id="PESELIIEdit" class="k-input k-textbox contract-edit-field"
                               value="" style="width: 95%;"/>
                </div>
                <div style="width: 20%; float: left;" class="contract-1-edit">
                    <label for="simple-input">Seria i numer dowodu osobistego</label>
                    <input name="IdentityCardIIEdit" type="text" id="IdentityCardIIEdit" class="k-input k-textbox contract-edit-field" value=""
                           style="width: 95%;"/>
                </div>
                <div style="width: 20%; float: left;">
                    <label for="simple-input">Telefon*</label>
                    <input name="PhoneIIEdit" type="tel" maxlength="12" id="PhoneIIEdit" class="k-input k-textbox contract-edit-field" value=""
                           style="width: 95%;"/>
                </div>
                <div style="width: 40%; float: left;">
                    <label for="simple-input">E-Mail**</label>
                    <input name="EmailIIEdit" type="email" id="EmailIIEdit" class="k-input k-textbox contract-edit-field" value=""
                           style="width: 100%;"/>
                </div>
                </li>
            </div>
            </div>
        </ul>
        <ul class="fieldlist">
            <div class="card">
                <div class="card-body">
                    <label for="simple-input" class="big_label" style="width: 100%; float: left;">Adres
                        korespondencyjny</label>
                    <li>
                        <div style="width: 30%; float: left;">
                            <label for="simple-input">Ulica</label>
                            <input name="StreetEdit" id="StreetEdit" type="text" class="k-input k-textbox contract-edit-field" value="" style="width: 95%;"/>
                        </div>
                        <div style="width: 20%; float: left;">
                            <label for="simple-input">Nr domu</label>
                            <input name="HomeNumberEdit" type="text" maxlength="10" class="k-input k-textbox contract-edit-field" value="" style="width: 95%;"/>
                        </div>
                        <div style="width: 20%; float: left;">
                            <label for="simple-input">Nr mieszkania</label>
                            <input name="ApartmentNumberEdit" type="text" maxlength="10" class="k-input k-textbox contract-edit-field" value="" style="width: 95%;"/>
                        </div>
                        <div style="width: 20%; float: left;">
                            <label for="simple-input">Kod pocztowy</label>
                            <input name="PostCodeEdit" type="text" pattern="[0-9]{2}\-[0-9]{3}" class="k-input k-textbox contract-edit-field" value=""
                                   style="width: 95%;"/>
                        </div>
                        <div style="width: 30%; float: left;">
                            <label for="simple-input">Miejscowość</label>
                            <input name="CityEdit" type="text" class="k-input k-textbox contract-edit-field" value="" style="width: 100%;"/>
                        </div>
                    </li>
                    <li>
                        <a role="button" class="k-button k-button-icontext k-primary updateContract nextTab1 nextTabEdit odswierzSesje"
                           href="\#">Przejdź dalej</a>
                    </li>
                </div>
            </div>
        </ul>
    </div>
    <div class="tab-contract">
        <ul class="fieldlist">
            <div class="card">
                <div class="card-body">
                    <label for="simple-input" class="big_label" style="width: 100%; float: left;">Przedmiot umowy</label>
                    <li>
                        <div style="width: 50%; float: left;" class="contract-2-edit">
                            <label for="simple-input">Nazwa banku</label>
                            <input name="BankNameEdit" id="BankNameEdit"  type="text" class="k-input k-textbox contract-edit-field" value="" disabled style="width: 95%;"/>
                        </div>
                        <div style="width: 50%; float: left;" class="contract-2-edit">
                            <label for="simple-input">Numer umowy</label>
                            <input name="ContractNumberEdit" type="text" class="k-input k-textbox contract-edit-field" disabled="" value="" style="width: 100%;"/>
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
                            <label for="simple-input" class="contact_form_content" style="width: 100%; float: left;">Klient
                                oświadcza, że:</label>
                        </div>
                        <div style="width: 100%; float: left; margin: 10px 0 10px 0;">
                            <label for="simple-input" class="contact_form_content"> - żąda rozpoczęcia wykonywania usługi
                                przez VOTUM przed upływem terminu do odstąpienia od umowy?</label>
                        </div>
                        <div style="width: 20%; float: left;" id="Radio1">
                            <input type="radio" name="RadioButton1Edit" id="Button1aEdit" value="1" class="k-radio contract-edit-field"
                                   style="width: 25%; float: left;">
                            <label class="k-radio-label contact_form_content" for="Button1aEdit"
                                   style="width: 25%; float: left;">tak</label>
                            <input type="radio" name="RadioButton1Edit" id="Button1bEdit" value="0" class="k-radio contract-edit-field"
                                   style="width: 25%; float: left;">
                            <label class="k-radio-label contact_form_content" for="Button1bEdit"
                                   style="width: 25%; float: left;">nie</label>
                        </div>
                        <div style="width: 100%; float: left; margin: 10px 0 10px 0;">
                            <label for="simple-input" class="contact_form_content"> - upoważnia Zleceniobiorcę do
                                uzyskiwania informacji i dokumentów w sprawach
                                prowadzonych przez Kancelarię Adwokatów i Radców Prawnych A. Łebek i Wspólnicy sp.k. z
                                siedzibą we Wrocławiu, w związku
                                z realizacją niniejszej umowy?</label>
                        </div>
                        <div style="width: 20%; float: left;" id="Radio2">
                            <input type="radio" name="RadioButton2Edit" id="Button2aEdit" value="1" class="k-radio contract-edit-field"
                                   style="width: 25%; float: left;">
                            <label class="k-radio-label contact_form_content" for="Button2aEdit"
                                   style="width: 25%; float: left;">tak</label>
                            <input type="radio" name="RadioButton2Edit" id="Button2bEdit" value="0" class="k-radio contract-edit-field"
                                   style="width: 25%; float: left;">
                            <label class="k-radio-label contact_form_content" for="Button2bEdit"
                                   style="width: 25%; float: left;">nie</label>
                        </div>
                        <div style="width: 100%; float: left; margin: 10px 0 10px 0;">
                            <label for="simple-input" class="contact_form_content"> - został poinformowany o sposobie i
                                terminie prawa odstąpienia od niniejszej umowy oraz wzorze oświadczenia o odstąpieniu
                                i o pozasądowych sposobach rozpatrywania reklamacji – na odrębnym formularzu.</label>
                        </div>
                        <div style="width: 100%; float: left; margin: 10px 0 10px 0;">
                            <label for="simple-input" class="contact_form_content"> - zobowiązuje się do zachowania
                                poufności w związku z prowadzoną sprawą, co do każdego jej etapu i nieudostępniania
                                informacji
                                oraz dokumentacji osobom trzecim.</label>
                        </div>
                        <div style="width: 100%; float: left; margin: 10px 0 10px 0;">
                            <label for="simple-input" class="contact_form_content"> - czy zlecał wcześniej dochodzenia
                                roszczeń żadnemu podmiotowi</label>
                        </div>
                        <div style="width: 20%; float: left;" id="Radio3">
                            <input type="radio" name="RadioButton3Edit" id="Button3aEdit" value="1" class="k-radio contract-edit-field"
                                   style="width: 25%; float: left;">
                            <label class="k-radio-label contact_form_content" for="Button3aEdit"
                                   style="width: 25%; float: left;">tak</label>
                            <input type="radio" name="RadioButton3Edit" id="Button3bEdit" value="0" class="k-radio contract-edit-field"
                                   style="width: 25%; float: left;">
                            <label class="k-radio-label contact_form_content" for="Button3bEdit"
                                   style="width: 25%; float: left;">nie</label>
                        </div>
                        <div style="width: 100%; float: left; margin: 10px 0 10px 0;" class="other-agent-edit hide">
                            <span style="font-weight: normal">Nazwa pełnomocnika: </span><input type="text"
                                                                                                name="OtherAgentNameEdit"
                                                                                                id="OtherAgentNameEdit"
                                                                                                class="k-input k-textbox"/><span
                                    style="font-weight: normal">, z którym zawarł umowę dnia: </span><input type="text"
                                                                                                            name="OtherAgentDateEdit"
                                                                                                            id="OtherAgentDateEdit"
                                                                                                            class="k-input k-textbox"/>
                        </div>

                        <div style="width: 100%; float: left; margin: 10px 0 10px 0;">
                            <label for="simple-input" class="contact_form_content"> - zgłaszał do Zobowiązanego roszczenia
                                tytułem:</label>
                        </div>
                        <div style="width: 100%; float: left; margin: 0 0 15px 30px">
                            <input type="checkbox" id="CheckBox1Edit" name="CheckBox1Edit" class="k-checkbox contract-edit-field"
                                   style="margin-top: 8px;">
                            <label class="k-checkbox-label contact_form_content" for="CheckBox1Edit"
                                   style="float: left; margin: 8px 10px 0 0;">nadpłaconych rat w związku z klauzulą
                                waloryzacyjną, data zgłoszenia</label>
                            <input name="CheckBox1DateEdit" id="CheckBox1DateEdit" type="text" class="k-input k-textbox contract-edit-field" value=""
                                   style="float: left;"/>
                        </div>
                        <div style="width: 100%; float: left; margin: 0 0 15px 30px">
                            <input type="checkbox" id="CheckBox2Edit" name="CheckBox2Edit" class="k-checkbox contract-edit-field"
                                   style="margin-top: 8px;">
                            <label class="k-checkbox-label contact_form_content" for="CheckBox2Edit"
                                   style="float: left; margin: 8px 10px 0 0;">zapłaconych składek za Ubezpieczenie Niskiego
                                Wkładu Własnego, data zgłoszenia</label>
                            <input name="CheckBox2DateEdit" id="CheckBox2DateEdit" type="text" class="k-input k-textbox contract-edit-field" value=""
                                   style="float: left;"/>
                        </div>
                        <div style="width: 100%; float: left; margin: 0 0 15px 30px">
                            <input type="checkbox" id="CheckBox3Edit" name="CheckBox3Edit" class="k-checkbox contract-edit-field"
                                   style="margin-top: 8px;">
                            <label class="k-checkbox-label contact_form_content" for="CheckBox3Edit"
                                   style="float: left; margin: 8px 10px 0 0;">nadpłaconej składki za Ubezpieczenie
                                Pomostowe, data zgłoszenia</label>
                            <input name="CheckBox3DateEdit" id="CheckBox3DateEdit" type="text" class="k-input k-textbox contract-edit-field" value=""
                                   style="float: left;"/>
                        </div>
                    </li>
                    <li>
                        <a role="button" class="k-button k-button-icontext k-primary updateContract nextTab2 nextTabEdit odswierzSesje"
                           href="\#">Przejdź dalej</a>
                    </li>
                </div>
            </div>
        </ul>
    </div>
    <div class="tab-contract">
        <ul class="fieldlist">
            <div class="card">
                <div class="card-body">
                    <li>
                        <div style="width: 100%; float: left; margin: 0 0 15px 30px">
                            <div style="width: 100%; float: left; margin: 10px 0 10px 0;">
                                <div style="width: 50%; float: left;" class="contract-3-edit">
                                    <label for="simple-input">Nazwa banku</label>
                                    <input type="text" name="MandateBankNameEdit" id="MandateBankNameEdit" class="k-input k-textbox contract-edit-field"
                                           disabled style="width: 95%"/>
                                </div>
                                <div style="width: 50%; float: left;" class="contract-3-edit">
                                    <label for="simple-input">Rodzaj kredytu</label>
                                    <input name="CreditTypeEdit" id="CreditTypeEdit" type="text" class="k-input k-textbox contract-edit-field" value=""
                                           disabled style="width: 95%;"/>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li>
                        <a role="button" class="k-button k-button-icontext k-primary updateContract nextTab3 nextTabEdit odswierzSesje"
                           href="\#">Przejdź dalej</a>
                    </li>
                </div>

            </div>
        </ul>
    </div>
    <div class="tab-contract">
        <ul class="fieldlist">
            <div class="card">
                <div class="card-body">
                    <label for="simple-input" class="big_label" style="width: 100%; float: left;">Zgody</label>
                    <li>
                        <div style="width: 100%; float: left; margin: 10px 0 0 0;">
                            <label for="simple-input" class="contact_form_content" style="width: 100%; float: left;">I.
                                Wyrażam zgodę na przekazanie moich danych kontaktowych (telefon, adres poczty
                                elektronicznej, adres zamieszkania) następującym
                                podmiotom:</label>
                        </div>
                        <div style="width: 100%; float: left; margin: 0 0 15px 30px">
                            <input type="checkbox" id="dataConsentDSAEdit" name="dataConsentDSAEdit" class="k-checkbox contract-edit-field"
                                   style="margin-top: 8px;">
                            <label class="k-checkbox-label contact_form_content" for="dataConsentDSAEdit"
                                   style="float: left; margin: 8px 10px 0 0;">DSA Investment S.A. Al. Wiśniowa 47, 53-126
                                Wrocław, KRS: 0000391830, w zakresie danych teleadresowych w celu sporządzenia oferty
                                produktów finansowych i ubezpieczeń osobowych:</label>
                        </div>
                        <div style="width: 100%; float: left; margin: 0 0 15px 30px">
                            <input type="checkbox" id="dataConsentPCRFEdit" name="dataConsentPCRFEdit" class="k-checkbox contract-edit-field"
                                   style="margin-top: 8px;">
                            <label class="k-checkbox-label contact_form_content" for="dataConsentPCRFEdit"
                                   style="float: left; margin: 8px 10px 0 0;">Polskie Centrum Rehabilitacji Funkcjonalnej
                                Votum S.A. Sp. k., Golikówka 6, 30-723 Kraków, KRS: 0000290430 , w zakresie danych
                                zawartych w umowie i przekazanej dokumentacji, w tym stanu zdrowia w celu sporządzenia
                                oferty rehabilitacji:</label>
                        </div>
                        <div style="width: 100%; float: left; margin: 0 0 15px 30px">
                            <input type="checkbox" id="dataConsentVOTUMEdit" name="dataConsentVOTUMEdit" class="k-checkbox contract-edit-field"
                                   style="margin-top: 8px;">
                            <label class="k-checkbox-label contact_form_content" for="dataConsentVOTUMEdit"
                                   style="float: left; margin: 8px 10px 0 0;">Fundacja VOTUM, ul. Wyścigowa 56i, 53-012
                                Wrocław, KRS: 0000272272, w zakresie danych zawartych w umowie i przekazanej dokumentacji,
                                w tym stanu zdrowia w celu przedstawienia możliwego zakresu pomocy:</label>
                        </div>
                        <div style="width: 100%; float: left; margin: 0 0 15px 30px">
                            <input type="checkbox" id="dataConsentAUTOVOTUMEdit" name="dataConsentAUTOVOTUMEdit" class="k-checkbox contract-edit-field"
                                   style="margin-top: 8px;">
                            <label class="k-checkbox-label contact_form_content" for="dataConsentAUTOVOTUMEdit"
                                   style="float: left; margin: 8px 10px 0 0;">AUTOVOTUM S.A., ul. Wyścigowa 56i, 53-012
                                Wrocław, KRS: 0000273033, w zakresie danych teleadresowych w celu sporządzenia oferty
                                usług wynajmu pojazdów zastępczych;</label>
                        </div>
                        <div style="width: 100%; float: left; margin: 0 0 15px 30px">
                            <input type="checkbox" id="dataConsentBEPEdit" name="dataConsentBEPEdit" class="k-checkbox contract-edit-field"
                                   style="margin-top: 8px;">
                            <label class="k-checkbox-label contact_form_content" for="dataConsentBEPEdit"
                                   style="float: left; margin: 8px 10px 0 0;">Biuro Ekspertyz Procesowych sp. z o.o., Aleja
                                Wiśniowa 47, 53-126 Wrocław, KRS: 0000565095, w zakresie danych teleadresowych w celu
                                sporządzenia oferty cesji wierzytelności dotyczącej szkody w pojeździe.</label>
                        </div>
                        <div style="width: 100%; float: left; margin: 10px 0 0 0;">
                            <label for="simple-input" class="contact_form_content" style="width: 100%; float: left;">II.
                                Wyrażam zgodę na wykonywanie następujących czynności przez:</label>
                        </div>
                        <div style="width: 100%; float: left; margin: 0 0 15px 30px">
                            <label for="simple-input" class="contact_form_content" style="width: 100%; float: left;">1. DSA
                                Investment S.A., Al. Wiśniowa 47,53-126 Wrocław,</label>
                            <input type="checkbox" id="marketingConsentDSA1Edit" name="marketingConsentDSA1Edit" class="k-checkbox contract-edit-field"
                                   style="margin-top: 8px;">
                            <label class="k-checkbox-label contact_form_content" for="marketingConsentDSA1Edit"
                                   style="float: left; margin: 8px 10px 0 0;">a) Przesłanie informacji handlowych za
                                pośrednictwem środków komunikacji elektronicznej, zgodnie z ustawą z dnia 08.07.2002 r. o
                                świadczeniu
                                usług drogą elektroniczną (Dz.U. z 2016 r. poz.1030)</label>
                            <input type="checkbox" id="marketingConsentDSA2Edit" name="marketingConsentDSA2Edit" class="k-checkbox contract-edit-field"
                                   style="margin-top: 8px;">
                            <label class="k-checkbox-label contact_form_content" for="marketingConsentDSA2Edit"
                                   style="float: left; margin: 8px 10px 0 0;">b) Przekazywanie treści marketingowych na
                                podany przez mnie nr telefonu w tym przy użyciu automatycznych systemów wywołujących
                                w rozumieniu ustawy z dnia 17.07.2004 r. Prawo telekomunikacyjne (Dz.U. z 2016 r. poz.
                                1489)</label>
                        </div>
                        <div style="width: 100%; float: left; margin: 0 0 15px 30px">
                            <label for="simple-input" class="contact_form_content" style="width: 100%; float: left;">2.
                                VOTUM S.A., ul. Wyścigowa 56i, 53-012 Wrocław,</label>
                            <input type="checkbox" id="marketingConsentVOTUM1Edit" name="marketingConsentVOTUM1Edit"
                                   class="k-checkbox contract-edit-field" style="margin-top: 8px;">
                            <label class="k-checkbox-label contact_form_content" for="marketingConsentVOTUM1Edit"
                                   style="float: left; margin: 8px 10px 0 0;">a) przesyłanie informacji handlowych za
                                pośrednictwem środków komunikacji elektronicznej zgodnie z ustawą z dn. 08.07.2002 r. o
                                świadczeniu
                                usług drogą elektroniczną (t. j. Dz.U. z 2017 r. poz. 1219)</label>
                            <input type="checkbox" id="marketingConsentVOTUM2Edit" name="marketingConsentVOTUM2Edit"
                                   class="k-checkbox contract-edit-field" style="margin-top: 8px;">
                            <label class="k-checkbox-label contact_form_content" for="marketingConsentVOTUM2Edit"
                                   style="float: left; margin: 8px 10px 0 0;">b) przekazywanie treści marketingowych na
                                podany przeze mnie nr telefonu w tym przy użyciu automatycznych systemów wywołujących
                                w rozumieniu ustawy z dn.16.07.2004 r. Prawo telekomunikacyjne (t. j. Dz.U. z 2017 r. poz.
                                1907)</label>
                        </div>
                </div>
                </li>
                <li>
                    <a role="button" class="k-button k-button-icontext k-primary updateContract nextTab4 nextTabEdit odswierzSesje"
                       href="\#">Przejdź dalej</a>
                </li>
            </div>
        </ul>

    </div>
    <div class="tab-contract">
        <ul class="fieldlist">
            <div class="card">
                <div class="card-body">
                    <!--                    <label for="simple-input" class="big_label" style="width: 100%; float: left;">Dane do przelewu</label>-->
                    <li style="width: 100%; float: left;">
                        <div style="width: 33%; float: left;" class="contract-3">
                            <label for="simple-input">Data zawarcia umowy z bankiem</label>
                            <input name="BankContractDateEdit" class="contract-edit-field" id="BankContractDateEdit" type="text" class="k-input k-textbox" value="" style="float: left;"/>
                        </div>
                        <div style="width: 30%; float: left; margin-bottom: 30px" class="contract-3">
                            <label for="contract-type">Kod jednostki</label>
                            <input type="text" class="contract-edit-field" name="UnitEdit" id="unit-edit" >
                        </div>
                        <div style="width: 30%; float: left; margin-bottom: 30px" class="contract-3">
                            <label for="contract-type">Kod konsultanta</label>
                            <input type="text" name="ConsultantEdit" class="contract-edit-field" id="consultant-edit" >
                        </div>
                    </li>
                    <li>
                        <a role="button" class="k-button k-button-icontext k-primary updateContract nextTab5 odswierzSesje" href="\#">Przejdź dalej</a>
                    </li>
                </div>
            </div>
        </ul>
    </div>
    <div class="tab-contract">
        <ul class="fieldlist">
            <div class="card">
                <div class="card-body">
                    <label for="simple-input" class="big_label" style="width: 100%; float: left;">Wynagrodzenie</label>
                    <li>
                        <div style="width: 100%; float: left; margin: 10px 0 10px 0;">
                            <label for="simple-input" class="contact_form_content">Odbiorcą wynagrodzenia jest:</label>
                        </div>
                    </li>
                    <li style="width: 100%; float: left;">
                        <div style="width: 33%; float: left;" class="contract-3-edit">
                            <label for="simple-input">Numer konta</label>
                            <input name="AccountNumberEdit" id="AccountNumberEdit" type="text" class="k-input k-textbox contract-edit-field" required
                                   validationMessage="To pole jest wymagane." value="" style="width: 95%;"/>
                        </div>
                        <div style="width: 33%; float: left;">
                            <label for="simple-input">Imię</label>
                            <input name="CustomerFirstNameEdit" id="CustomerFirstNameEdit" type="text" class="k-input k-textbox contract-edit-field"
                                   value="" style="width: 95%;"/>
                        </div>
                        <div style="width: 34%; float: left;">
                            <label for="simple-input">Nazwisko</label>
                            <input name="CustomerLastNameEdit" id="CustomerLastNameEdit" type="text" class="k-input k-textbox contract-edit-field"
                                   value="" style="width: 100%;"/>
                        </div>
                    </li>
                    <li style="width: 100%; float: left;">
                        <div style="width: 30%; float: left;">
                            <label for="simple-input">Ulica</label>
                            <input name="CustomerStreetEdit" id="CustomerStreetEdit" type="text" class="k-input k-textbox contract-edit-field" value=""
                                   style="width: 95%;"/>
                        </div>
                        <div style="width: 20%; float: left;">
                            <label for="simple-input">Nr domu</label>
                            <input name="CustomerHomeNumberEdit" id="CustomerHomeNumberEdit" type="text" maxlength="5" class="k-input k-textbox contract-edit-field"
                                   value="" style="width: 95%;"/>
                        </div>
                        <div style="width: 20%; float: left;">
                            <label for="simple-input">Nr mieszkania</label>
                            <input name="CustomerApartmentNumberEdit" id="CustomerApartmentNumberEdit" type="text" maxlength="5" class="k-input k-textbox contract-edit-field"
                                   value="" style="width: 95%;"/>
                        </div>
                        <div style="width: 20%; float: left;">
                            <label for="simple-input">Kod pocztowy</label>
                            <input name="CustomerPostCodeEdit" pattern="[0-9]{2}\-[0-9]{3}" id="CustomerPostCodeEdit" type="text" class="k-input k-textbox contract-edit-field"
                                    value="" style="width: 95%;"/>
                        </div>
                        <div style="width: 30%; float: left;">
                            <label for="simple-input">Miejscowość</label>
                            <input name="CustomerCityEdit" id="CustomerCityEdit" type="text" class="k-input k-textbox contract-edit-field" value=""
                            <input name="CustomerCityEdit" id="CustomerCityEdit" type="text" class="k-input k-textbox contract-edit-field" value=""
                            <input name="CustomerCityEdit" id="CustomerCityEdit" type="text" class="k-input k-textbox contract-edit-field" value=""
                                   style="width: 100%;"/>
                        </div>
                    </li>
                    <li style="width: 100%; float: left;">
                        <div style="width: 30%; float: left; margin-bottom: 30px" class="contract-3-edit">
                            <label for="contract-type-edit">Typ umowy</label>
                            <input type="text" class="k-input k-textbox contract-edit-field" name="ContractTypeEdit" id="contract-type-edit" disabled>
                        </div>
                    </li>
                    <li id="save-contract-edit">
                        <a role="button" id="update-edit"
                           class="k-button k-button-icontext k-primary updateContract odswierzSesje hide" href="\#">Zapisz
                        </a>
                        <a role="button" id="print-edit"
                           class="k-button k-button-icontext k-primary export-pdf updateContract" href="\#">Pokaż druk umowy
                        </a>
                    </li>
                </div>
            </div>
        </ul>
    </div>
</div>
<div style="width: 100%; float: left; margin: 10px 0 10px 0;"></div>

