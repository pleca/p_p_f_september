<div id="contract_bona">
    <div id="tabstrip_bona">
        <ul>
            <li class="k-state-active">
                Klient
            </li>
            <li>
                Dane o zdarzeniu
            </li>
            <li>
                Informacje dotyczące szkody
            </li>
            <li>
                Zgody
            </li>
            <li>
                Wynagrodzenie
            </li>
            <li>
                Umowa
            </li>
        </ul>
        <div>
            <ul class="fieldlist">
                <div class="card">
                    <li class="row">
                        <div class="col-md-9"><label for="simple-input" class="big_label" style="width: 100%; float: left;">Zleceniodawca/Właściciel</label></div>
                        <div class="col-md-3">
                            <a role="button" class="k-button k-button-icontext k-primary data-button" id="clear-data" href="#" style="width:100%">Kopiuj adres zameldowania</a>
                        </div>
                    </li>
                    <li class="row">
                        <div class="col-md-6 inputValidate-1">
                            <label for="simple-input">Imię</label>
                            <input name="FirstNameI" id="FirstNameI" type="text" class="k-input k-textbox" value=""
                                   required validationMessage="To pole jest wymagane." style="width: 100%;"/>
                        </div>
                        <div class="col-md-6 inputValidate-1">
                            <label for="simple-input">Nazwisko/Firma</label>
                            <input name="LastNameI" type="text" id="LastNameI" class="k-input k-textbox" value=""
                                   required validationMessage="To pole jest wymagane." style="width: 100%;"/>
                        </div>
                    </li>
                    <li class="row">
                        <div class="col-md-3 inputValidate-1">
                            <label for="simple-input">PESEL</label>
                            <input name="PESELI" required type="text" id="PESELI" pattern="\d{11}"
                                   class="k-input k-textbox" required validationMessage="To pole jest wymagane."
                                   value="" style="width: 100%;"/>
                        </div>
                        <div class="col-md-3 inputValidate-1">
                            <label for="simple-input">Nr dokumentu tożsamości</label>
                            <input name="IdentityCardI" id="IdentityCardI" type="text" class="k-input k-textbox"
                                   value="" required validationMessage="To pole jest wymagane." style="width: 100%;"/>
                        </div>
                        <div class="col-md-3">
                            <label for="simple-input">Telefon*</label>
                            <input name="PhoneI" id="PhoneI" type="tel" class="k-input k-textbox" pattern="\d{9}"
                                   value="" style="width: 100%;"/>
                        </div>
                        <div class="col-md-3">
                            <label for="simple-input">E-Mail**</label>
                            <input name="EmailI" id="EmailI" type="email" class="k-input k-textbox" value="" style="width: 100%;"/>
                        </div>
                    </li>
                    <li class="row">
                        <div class="col-md-4">
                            <label for="simple-input">NIP</label>
                            <input name="NIPI" type="text" id="NIPI" pattern="\d{10}"
                                   class="k-input k-textbox" value="" style="width: 100%;"/>
                        </div>
                        <div class="col-md-4">
                            <label for="simple-input">REGON</label>
                            <input name="REGONI" id="REGONI" type="text" class="k-input k-textbox"
                                   value="" style="width: 100%;"/>
                        </div>
                        <div class="col-md-4">
                            <label for="simple-input">KRS</label>
                            <input name="KRSI" id="KRSI" type="text" class="k-input k-textbox"
                                   value=""style="width: 100%;"/>
                        </div>
                    </li>
                    <label for="simple-input" class="small_label" style="width: 100%; float: left;">Adres zameldowania:</label>
                    <li class="row">
                        <div class="col-md-3">
                            <label for="simple-input">Ulica</label>
                            <input name="StreetI" type="text" id="StreetI" class="k-input k-textbox" value=""
                                   style="width: 100%;"/>
                        </div>
                        <div class="col-md-3">
                            <label for="simple-input">Nr domu</label>
                            <input name="HomeNumberI" type="text" id="HomeNumberI" class="k-input k-textbox" value=""
                                   style="width: 100%;"/>
                        </div>
                        <div class="col-md-3">
                            <label for="simple-input">Kod pocztowy</label>
                            <input name="PostCodeI" type="text" id="PostCodeI" pattern="\d{2}-\d{3}"
                                   class="k-input k-textbox" value="" style="width: 100%;"/>
                        </div>
                        <div class="col-md-3">
                            <label for="simple-input">Miejscowość</label>
                            <input name="CityI" type="text" id="CityI" class="k-input k-textbox" value=""
                                   style="width: 100%;"/>
                        </div>
                    </li>
                    <label for="simple-input" class="small_label" style="width: 100%; float: left;">Adres korespondencyjny (jeśli inny niż zameldowania):</label>
                    <li class="row">
                        <div class="col-md-3">
                            <label for="simple-input">Ulica</label>
                            <input name="Street" type="text" id="Street" class="k-input k-textbox" value=""
                                   style="width: 100%;"/>
                        </div>
                        <div class="col-md-3">
                            <label for="simple-input">Nr domu/mieszkania</label>
                            <input name="HomeNumber" type="text" id="HomeNumber" class="k-input k-textbox" value=""
                                   style="width: 100%;"/>
                        </div>
                        <div class="col-md-3">
                            <label for="simple-input">Kod pocztowy</label>
                            <input name="PostCode" type="text" id="PostCode" pattern="\d{2}-\d{3}"
                                   class="k-input k-textbox" value="" style="width: 100%;"/>
                        </div>
                        <div class="col-md-3">
                            <label for="simple-input">Miejscowość</label>
                            <input name="City" type="text" id="City" class="k-input k-textbox" value=""
                                   style="width: 100%;"/>
                        </div>
                    </li>
                    <li class="row">
                        <div class="col-md-6">
                            <input type="checkbox" id="Company" name="Company" class="k-checkbox">
                            <label class="k-checkbox-label" for="Company">Zleceniodawca oświadcza, że prowadzi pozarolniczą działalność gospodarczą.</label>
                        </div>
                        <div class="col-md-6">
                            <input type="checkbox" id="VAT" name="VAT" class="k-checkbox">
                            <label class="k-checkbox-label" for="VAT">Zleceniodawca oświadcza, że jestem płatnikiem podatku VAT.</label>
                        </div>
                    </li>
                </div>
            </ul>
            <ul class="fieldlist">
                <div class="card">
                    <li class="row">
                        <div class="col-md-6"><label for="simple-input" class="big_label" style="width: 100%; float: left;">Współwłaściciel</label></div>
                        <div class="col-md-3">
                            <a role="button" class="k-button k-button-icontext k-primary data-button-adress" id="copy-first-address" href="#" style="width:100%">Kopiuj adres zameldowania</a>
                        </div>
                        <div class="col-md-3">
                            <a role="button" class="k-button k-button-icontext k-primary data-button-adress" id="copy-second-address" href="#" style="width:100%">Kopiuj adres korespondencyjny</a>
                        </div>
                    </li>
                    <li class="row">
                        <div class="col-md-6">
                            <label for="simple-input">Imię</label>
                            <input name="FirstNameII" id="FirstNameII" type="text" class="k-input k-textbox" value="" style="width: 100%;"/>
                        </div>
                        <div class="col-md-6">
                            <label for="simple-input">Nazwisko/Firma</label>
                            <input name="LastNameII" type="text" id="LastNameII" class="k-input k-textbox" value="" style="width: 100%;"/>
                        </div>
                    </li>
                    <li class="row">
                        <div class="col-md-3">
                            <label for="simple-input">PESEL</label>
                            <input name="PESELII" type="text" id="PESELII" pattern="\d{11}"
                                   class="k-input k-textbox" value="" style="width: 100%;"/>
                        </div>
                        <div class="col-md-3">
                            <label for="simple-input">Nr dokumentu tożsamości</label>
                            <input name="IdentityCardII" id="IdentityCardII" type="text" class="k-input k-textbox"
                                   value="" style="width: 100%;"/>
                        </div>
                        <div class="col-md-3">
                            <label for="simple-input">Telefon*</label>
                            <input name="PhoneII" id="PhoneII" type="tel" class="k-input k-textbox" pattern="\d{9}"
                                   value="" style="width: 100%;"/>
                        </div>
                        <div class="col-md-3">
                            <label for="simple-input">E-Mail**</label>
                            <input name="EmailII" id="EmailII" type="email" class="k-input k-textbox" value="" style="width: 100%;"/>
                        </div>
                    </li>
                    <label for="simple-input" class="small_label" style="width: 100%; float: left;">Adres zameldowania:</label>
                    <li class="row">
                        <div class="col-md-3">
                            <label for="simple-input">Ulica</label>
                            <input name="StreetII" type="text" id="StreetII" class="k-input k-textbox" value=""
                                   style="width: 100%;"/>
                        </div>
                        <div class="col-md-3">
                            <label for="simple-input">Nr domu</label>
                            <input name="HomeNumberII" type="text" id="HomeNumberII" class="k-input k-textbox" value=""
                                   style="width: 100%;"/>
                        </div>
                        <div class="col-md-3">
                            <label for="simple-input">Kod pocztowy</label>
                            <input name="PostCodeII" type="text" id="PostCodeII" pattern="\d{2}-\d{3}"
                                   class="k-input k-textbox" value="" style="width: 100%;"/>
                        </div>
                        <div class="col-md-3">
                            <label for="simple-input">Miejscowość</label>
                            <input name="CityII" type="text" id="CityII" class="k-input k-textbox" value=""
                                   style="width: 100%;"/>
                        </div>
                    </li>
                </div>
            </ul>
            <ul class="fieldlist">
                <div class="card">
                    <label for="simple-input" class="big_label" style="width: 100%; float: left;">Uprawniony do uzyskania informacji telefonicznej</label>
                    <li class="row">
                        <div class="col-md-4">
                            <label for="simple-input">Imię</label>
                            <input name="PhoneFirstName" type="text" id="PhoneFirstName" class="k-input k-textbox" value=""
                                   style="width: 100%;"/>
                        </div>
                        <div class="col-md-5">
                            <label for="simple-input">Nazwisko</label>
                            <input name="PhoneLastName" type="text" id="PhoneLastName" class="k-input k-textbox" value=""
                                   style="width: 100%;"/>
                        </div>
                        <div class="col-md-3">
                            <label for="simple-input">PESEL</label>
                            <input name="PhonePESEL" type="text" id="PhonePESEL" pattern="\d{11}" class="k-input k-textbox"
                                   value="" style="width: 100%;"/>
                        </div>
                    </li>
                </div>
            </ul>
            <a role="button" class="k-button k-button-icontext k-primary nextTab1 odswierzSesje nextTabButton" href="#">Przejdź dalej</a>
        </div>
        <div>
            <ul class="fieldlist">
                <div class="card">
                    <label for="simple-input" class="big_label" style="width: 100%; float: left;">Przedmiot umowy</label>
                    <li class="row inputValidate-2" style="width: 100%;">
                        <div class="col-md-4">
                            <label for="simple-input">Data i godzina zdarzenia:</label>
                            <input name="IncidentDate" id="IncidentDate" value="" required validationMessage="To pole jest wymagane." style="width: 100%;" class="k-input"/>
                            <span class="k-invalid-msg" data-for="IncidentDate"></span>
                        </div>
                    </li>
                    <li class="row">
                        <div class="col-md-8">
                            <label for="simple-input">Przyczyna powstania szkody (np. powódź, podtopienie, silny wiatr, pożar, przymrozek, kolizja drogowa, itp.)</label>
                            <input name="Reason" type="text" class="k-input k-textbox" value="" style="width: 100%;"/>
                        </div>
                    </li>
                    <li class="row">
                        <div class="col-md-12">
                            <label for="simple-input">Opis powstałych szkód - dokładna lokalizacja przedmiotu szkody</label>
                            <textarea cols="20" name="Discription" rows="3" class="k-textbox k-input" style="width: 100%; height: 200px;"></textarea>
                        </div>
                    </li>
                </div>
            </ul>
            <ul class="fieldlist">
                <div class="card">
                    <label for="simple-input" class="big_label" style="width: 100%; float: left;">Posiadane polisy ubezpieczenia mienia</label>
                    <li class="row">
                        <div class="col-md-1">
                            <label for="simple-input"></label>
                            <div style="width: 100%;font-weight: bold; margin-top:20px; text-align:center;">I </div>
                        </div>
                        <div class="col-md-5">
                            <label for="simple-input">Zakład ubezpieczeń</label>
                            <input name="InsurerI" type="text" id="InsurerI" class="k-input k-textbox" value=""
                                   style="width: 100%;"/>
                        </div>
                        <div class="col-md-3">
                            <label for="simple-input">Nazwa polisy</label>
                            <input name="PolicyNameI" type="text" id="PolicyNameI" class="k-input k-textbox" value=""
                                   style="width: 100%;"/>
                        </div>
                        <div class="col-md-3">
                            <label for="simple-input">Numer polisy</label>
                            <input name="PolicyNumberI" type="text" id="PolicyNumberI" class="k-input k-textbox"
                                   value="" style="width: 100%;"/>
                        </div>
                    </li>
                    <li class="row">
                        <div class="col-md-1">
                            <label for="simple-input"></label>
                            <div style="width: 100%;font-weight: bold; margin-top:20px; text-align:center;">II </div>
                        </div>
                        <div class="col-md-5">
                            <label for="simple-input">Zakład ubezpieczeń</label>
                            <input name="InsurerII" type="text" id="InsurerII" class="k-input k-textbox" value=""
                                   style="width: 100%;"/>
                        </div>
                        <div class="col-md-3">
                            <label for="simple-input">Nazwa polisy</label>
                            <input name="PolicyNameII" type="text" id="PolicyNameII" class="k-input k-textbox" value=""
                                   style="width: 100%;"/>
                        </div>
                        <div class="col-md-3">
                            <label for="simple-input">Numer polisy</label>
                            <input name="PolicyNumberII" type="text" id="PolicyNumberII" class="k-input k-textbox"
                                   value="" style="width: 100%;"/>
                        </div>
                    </li>
                    <li class="row">
                        <div class="col-md-1">
                            <label for="simple-input"></label>
                            <div style="width: 100%;font-weight: bold; margin-top:20px; text-align:center;">III </div>
                        </div>
                        <div class="col-md-5">
                            <label for="simple-input">Zakład ubezpieczeń</label>
                            <input name="InsurerIII" type="text" id="InsurerIII" class="k-input k-textbox" value=""
                                   style="width: 100%;"/>
                        </div>
                        <div class="col-md-3">
                            <label for="simple-input">Nazwa polisy</label>
                            <input name="PolicyNameIII" type="text" id="PolicyNameIII" class="k-input k-textbox" value=""
                                   style="width: 100%;"/>
                        </div>
                        <div class="col-md-3">
                            <label for="simple-input">Numer polisy</label>
                            <input name="PolicyNumberIII" type="text" id="PolicyNumberIII" class="k-input k-textbox"
                                   value="" style="width: 100%;"/>
                        </div>
                    </li>


                    <li class="row" style="padding-bottom: 0.5em; margin-left: 10px; margin-right:10px;">
                        Czy zgłoszono szkodę do zakładu ubezpieczeń?
                    </li>

                    <li class="row" style="margin-left: 10px; margin-right:10px;padding-bottom:0em;">
                        <div class="col-md-3" style="float:left;">
                            <input type="radio" name="Notification" id="NotificationNo" value="0" class="k-radio">
                            <label class="k-radio-label" for="NotificationNo">nie</label>
                        </div>
                        <div class="col-md-4" style="float:left;">
                            <input type="radio" name="Notification" id="NotificationYes" value="1" class="k-radio">
                            <label class="k-radio-label" for="NotificationYes" style="float:left">tak, data zgłoszenia: &nbsp;</label>
                            <input name="NotificationDate" id="NotificationDate" value="" disabled style="width: 50%; height: 26px;top:-5px;" class="k-input"/>
                        </div>
                    </li>
                    <li class="row" style="padding-bottom: 0.5em; margin-left: 10px; margin-right:10px;">
                        Odszkodowania:
                    </li>
                    <li class="row" style="margin-left: 10px; margin-right:10px;padding-bottom:0.5em;">
                        <div class="col-md-3" style="float:left;">
                            <input type="radio" name="PaidOut" id="PaidOutNo" value="0" class="k-radio" style="margin-top: 10px;">
                            <label class="k-radio-label" for="PaidOutNo">nie wypłacono</label>
                        </div>
                        <div class="col-md-6" style="float:left;">
                            <input type="radio" name="PaidOut" id="PaidOutYes" value="1" class="k-radio">
                            <label class="k-radio-label" for="PaidOutYes" style="float:left">wypłacono w kwocie: </label>
                            <input name="AnountPaidOut" type="text" id="AnountPaidOut" disabled class="k-input k-textbox" value="" style="width: 30%; height: 26px; top:-5px;"/>&nbsp;zł,
                        </div>
                    </li>
                    <li class="row" style="margin-left: 10px; margin-right:10px;">
                        <div class="col-md-12" style="margin-left: 10px; margin-right:10px;">
                            numer szkody nadany przez zakład ubezpieczeń: &nbsp;
                            <input name="DamageNumber" type="text" id="DamageNumber" disabled class="k-input k-textbox" value="" style="width: 30%; height: 26px; top:0px;"/>
                        </div>
                    </li>
                </div>
            </ul>
            <ul class="fieldlist">
                <div class="card">
                    <label for="simple-input" class="big_label" style="width: 100%; float: left;">Dochodzenie roszczeń</label>
                    <li class="row" style="padding-bottom: 0.5em; margin-left: 10px; margin-right:10px;">
                        Czy dokonano przeniesienia praw wynikających z umowy ubezpieczenia (cesja)?
                    </li>
                    <li class="row" style="padding-bottom: 0.5em; margin-left: 10px; margin-right:10px;">
                        <div class="col-md-2" style="float:left;">
                            <input type="radio" name="Assignment" id="AssignmentNo" value="0" class="k-radio" style="margin-top: 10px;">
                            <label class="k-radio-label" for="AssignmentNo">nie</label>
                        </div>
                        <div class="col-md-6" style="float:left;">
                            <input type="radio" name="Assignment" id="AssignmentYes" value="1" class="k-radio">
                            <label class="k-radio-label" for="AssignmentYes" style="float:left"> tak &nbsp; </label>
                            <input name="AssignmentValue" type="text" id="AssignmentValue" disabled class="k-input k-textbox" value="" style="width: 50%; height: 26px; top:-5px;"/>
                        </div>
                    </li>
                    <li class="row" style="padding-bottom: 0.5em;padding-left: 0.5em;">
                        <div class="col-md-12">
                            <input type="radio" id="OtherAgentNo" value="0" class="k-radio" name="OtherAgent">
                            <label class="k-radio-label" for="OtherAgentNo">Nie zlecano wcześniej dochodzenia roszczeń żadnemu podmiotowi. &nbsp;</label>
                        </div>
                    </li>
                    <li class="row" style="padding-bottom: 0.5em;padding-left: 0.5em;">
                        <div class="col-md-12">
                            <input type="radio" id="OtherAgentYes" class="k-radio" name="OtherAgent" value="1">
                            <label class="k-radio-label" for="OtherAgentYes"> Sprawę zlecono wcześniej pełnomocnikowi (nazwa): &nbsp;
                                <input name="OtherAgentName" type="text" disabled id="OtherAgentName" class="k-input k-textbox" value="" style="width: 40%; height: 26px; top:-5px;"/>&nbsp;
                            </label>
                        </div>
                    </li>
                    <li class="row" style="padding-bottom: 0.5em;padding-left: 0.5em;margin-left:10px">
                        <div class="col-md-12">
                            <div class="k-inline-label" style="float:left;"> z którym zawarto umowę dnia: &nbsp;</div>
                            <input name="OtherAgentContractDate" disabled id="OtherAgentContractDate" class="k-input" value="" style="width: 20%; height: 26px; top:-5px;"/>
                        </div>
                    </li>
                    <li class="row" style="padding-bottom: 0.5em;padding-left: 0.5em;">
                        <div class="col-md-12">
                            <input type="checkbox" id="Terminate" class="k-checkbox" name="Terminate" value="">
                            <label class="k-checkbox-label" for="Terminate" style="float:left;"> Umowę z wyżej wymienionym wypowiedziano w dniu: &nbsp;</label>
                            <input name="TerminateDate" type="text" id="TerminateDate" disabled class="k-input k-textbox" value="" style="width: 20%; height: 26px; top:-5px;"/>
                        </div>
                    </li>
                    <li class="row" style="padding-bottom: 0.5em;padding-left: 0.5em;">
                        <div class="col-md-12">
                            <input type="checkbox" id="Page" name="Page" class="k-checkbox">
                            <label class="k-inline-label" style="float:left;">Przekazałem pełnomocnikowi Votum S.A. dokumentację składającą się z: &nbsp;</label>
                            <input name="PageValue" type="text" id="PageValue" class="k-input k-textbox" value="" style="width: 10%; height: 26px; top:-5px;"/> kart.
                        </div>
                    </li>
                    <li class="row" style="padding-bottom: 0.5em; margin-left: 10px; margin-right:10px;">
                        Wyrażam zgodę na otrzymywanie informacji związanych z wykonywaniem umowy poprzez:
                    </li>
                    <li class="row" style="padding-bottom: 0.5em;padding-left: 0.5em;">
                        <div class="col-md-3">
                            <input type="checkbox" id="ConsentSMS" id="ConsentSMS" class="k-checkbox" name="ConsentSMS">
                            <label class="k-checkbox-label" for="ConsentSMS">
                                wiadomości tekstowe SMS
                            </label>
                        </div>
                        <div class="col-md-6">
                            <input type="checkbox" id="ConsentEmail" id="ConsentEmail" class="k-checkbox" name="ConsentEmail">
                            <label class="k-checkbox-label" for="ConsentEmail">
                                wiadomości e-mail na podany przeze mnie numer/adres.
                            </label>
                        </div>
                    </li>
                </div>
            </ul>
            <a role="button" class="k-button k-button-icontext k-primary nextTab2 odswierzSesje nextTabButton" href="#">Przejdź dalej</a>
        </div>
        <div>
            <ul class="fieldlist">
                <div class="card">
                    <label for="simple-input" class="big_label" style="width: 100%; float: left;">Informacje dotyczące szkody</label>
                    <div id="panelbar_bona">
                        <li class="k-state-active">
                            1. Czy na miejscu zdarzenia były służby ratunkowe, policja, pogotowie? Jeśli tak, to jakie jednostki i z jakiej miejscowości?
                            <span class="k-icon k-i-edit k-panelbar-collapse-status"></span>
                            <div class="answer">
                                <textarea cols="20" rows="3" class="k-textbox k-input" name="Answer1" style="width: 100%; height: 200px;"></textarea>
                            </div>
                        </li>
                        <li>
                            2. Jeżeli prowadzone jest lub było prowadzone postępowanie - jaka jest sygnatura akt; jaki jest jego obecny etap lub jak zakończyło się?
                            <span class="k-icon k-i-edit k-panelbar-collapse-status"></span>
                            <div class="answer">
                                <textarea cols="20" rows="3" class="k-textbox k-input" name="Answer2" style="width: 100%; height: 200px;"></textarea>
                            </div>
                        </li>
                        <li>
                            3. Czy jest możliwe przeprowadzenie oględzin uszkodzonego mienia; jeśli nie jest to możliwe, to z jakiej przyczyny?
                            <span class="k-icon k-i-edit k-panelbar-collapse-status"></span>
                            <div class="answer">
                                <textarea cols="20" rows="3" class="k-textbox k-input" name="Answer3" style="width: 100%; height: 200px;"></textarea>
                            </div>
                        </li>
                        <li>
                            4. Czy przedmiot szkody uległ całkowitemu zniszczeniu lub utracie; czy też możliwa jest jego odbudowa, naprawa lub odtworzenie?
                            <span class="k-icon k-i-edit k-panelbar-collapse-status"></span>
                            <div class="answer">
                                <textarea cols="20" rows="3" class="k-textbox k-input" name="Answer4" style="width: 100%; height: 200px;"></textarea>
                            </div>
                        </li>
                        <li>
                            5. Czy dokonano odbudowy, naprawy lub odtworzenia uszkodzonego mienia?
                            <span class="k-icon k-i-edit k-panelbar-collapse-status"></span>
                            <div class="answer">
                                <textarea cols="20" rows="3" class="k-textbox k-input" name="Answer5" style="width: 100%; height: 200px;"></textarea>
                            </div>
                        </li>
                        <li>
                            6. Jeżeli nie dokonano odbudowy, naprawy lub odtworzenia, to czy jest to planowane - jeśli tak, to w jakim terminie?
                            <span class="k-icon k-i-edit k-panelbar-collapse-status"></span>
                            <div class="answer">
                                <textarea cols="20" rows="3" class="k-textbox k-input" name="Answer6" style="width: 100%; height: 200px;"></textarea>
                            </div>
                        </li>
                        <li>
                            7. Czy odbudowa, naprawa lub odtworzenie zostało wykonane bądź będzie wykonane za pośrednictwem wyspecjalizowanego podmiotu czy
                            też samodzielnie we własnym zakresie?
                            <span class="k-icon k-i-edit k-panelbar-collapse-status"></span>
                            <div class="answer">
                                <textarea cols="20" rows="3" class="k-textbox k-input" name="Answer7" style="width: 100%; height: 200px;"></textarea>
                            </div>
                        </li>
                        <li>
                            8. Jakimi dowodami dysponuje poszkodowany, które wskazują na rzeczywiste koszty odbudowy, naprawy lub odtworzenia (np. rachunki,
                            faktury, kosztorys, wycena, oferta naprawy/obudowy, ect.)
                            <span class="k-icon k-i-edit k-panelbar-collapse-status"></span>
                            <div class="answer">
                                <textarea cols="20" rows="3" class="k-textbox k-input" name="Answer8" style="width: 100%; height: 200px;"></textarea>
                            </div>
                        </li>
                        <li>
                            9. Czy dokonana odbudowa, naprawa lub odtworzenie zostało wykonane przy zachowaniu dotychczasowych wymiarów, konstrukcji i materiałów
                            czy też dokonano zmian w odniesieniu do stanu nim szkoda wystąpiła?
                            <span class="k-icon k-i-edit k-panelbar-collapse-status"></span>
                            <div class="answer">
                                <textarea cols="20" rows="3" class="k-textbox k-input" name="Answer9" style="width: 100%; height: 200px;"></textarea>
                            </div>
                        </li>
                    </div>
                </div>
            </ul>
            <a role="button" class="k-button k-button-icontext k-primary nextTab3 odswierzSesje nextTabButton" href="#">Przejdź dalej</a>
        </div>
        <div>
            <ul class="fieldlist">
                <div class="card">
                    <label for="simple-input" class="big_label" style="width: 100%; float: left;">Zgody</label>
                    <li class="row" style="padding-bottom: 0.5em; margin-left: 5px; margin-right:10px;">
                        I. Wyrażam zgodę na przekazanie moich danych kontaktowych (telefon, adres poczty elektronicznej, adres zamieszkania) następującym
                        podmiotom:
                    </li>
                    <li class="row" style="padding-bottom: 0.5em;padding-left: 1.0em;">
                        <div class="col-md-12">
                            <input type="checkbox" id="dataConsentDSA" class="k-checkbox" name="dataConsentDSA">
                            <label class="k-checkbox-label" for="dataConsentDSA">
                                DSA Investment S.A. Al. Wiśniowa 47, 53-126 Wrocław, KRS: 0000391830, w zakresie danych teleadresowych w celu sporządzenia oferty
                                produktów finansowych i ubezpieczeń osobowych;
                            </label>
                        </div>
                    </li>
                    <li class="row" style="padding-bottom: 0.5em;padding-left: 1.0em;">
                        <div class="col-md-12">
                            <input type="checkbox" id="dataConsentPCRF" class="k-checkbox" name="dataConsentPCRF">
                            <label class="k-checkbox-label" for="dataConsentPCRF">
                                Polskie Centrum Rehabilitacji Funkcjonalnej Votum S.A. Sp. k., Golikówka 6, 30-723 Kraków, KRS: 0000290430 , w zakresie danych
                                zawartych w umowie i przekazanej dokumentacji, w tym stanu zdrowia w celu sporządzenia
                                oferty rehabilitacji;
                            </label>
                        </div>
                    </li>
                    <li class="row" style="padding-bottom: 0.5em;padding-left: 1.0em;">
                        <div class="col-md-12">
                            <input type="checkbox" id="dataConsentVOTUM" class="k-checkbox" name="dataConsentVOTUM">
                            <label class="k-checkbox-label" for="dataConsentVOTUM">
                                Fundacja VOTUM, ul. Wyścigowa 56i, 53-012 Wrocław, KRS: 0000272272, w zakresie danych zawartych w umowie i przekazanej dokumentacji,
                                w tym stanu zdrowia w celu przedstawienia możliwego zakresu pomocy;
                            </label>
                        </div>
                    </li>
                    <li class="row" style="padding-bottom: 0.5em;padding-left: 1.0em;">
                        <div class="col-md-12">
                            <input type="checkbox" id="dataConsentAUTOVOTUM" class="k-checkbox" name="dataConsentAUTOVOTUM">
                            <label class="k-checkbox-label" for="dataConsentAUTOVOTUM">
                                AUTOVOTUM S.A., ul. Wyścigowa 56i, 53-012 Wrocław, KRS: 0000273033, w zakresie danych teleadresowych w celu sporządzenia oferty
                                usług wynajmu pojazdów zastępczych;
                            </label>
                        </div>
                    </li>
                    <li class="row" style="padding-bottom: 0.5em;padding-left: 1.0em;">
                        <div class="col-md-12">
                            <input type="checkbox" id="dataConsentBEP" class="k-checkbox" name="dataConsentBEP">
                            <label class="k-checkbox-label" for="dataConsentBEP">
                                Biuro Ekspertyz Procesowych sp. z o.o., Aleja Wiśniowa 47, 53-126 Wrocław, KRS: 0000565095, w zakresie danych teleadresowych w celu
                                sporządzenia oferty cesji wierzytelności dotyczącej szkody w pojeździe.
                            </label>
                        </div>
                    </li>
                    <li class="row" style="padding-bottom: 0.5em; margin-left: 5px; margin-right:10px;margin-top:10px;">
                        II. Wyrażam zgodę na wykonywanie następujących czynności przez:
                    </li>
                    <li class="row" style="padding-bottom: 0.5em; margin-left: 10px; margin-right:10px;">
                        1. DSA Investment S.A., Al. Wiśniowa 47,53-126 Wrocław,
                    </li>
                    <li class="row" style="padding-bottom: 0.5em;padding-left: 2.0em;">
                        <div class="col-md-12">
                            <input type="checkbox" id="marketingConsentDSA1" class="k-checkbox" name="marketingConsentDSA1">
                            <label class="k-checkbox-label" for="marketingConsentDSA1">
                                a) Przesłanie informacji handlowych za pośrednictwem środków komunikacji elektronicznej, zgodnie z ustawą z dnia 08.07.2002 r. o
                                świadczeniu usług drogą elektroniczną (Dz.U. z 2016 r. poz.1030)
                            </label>
                        </div>
                    </li>
                    <li class="row" style="padding-bottom: 0.5em;padding-left: 2.0em;">
                        <div class="col-md-12">
                            <input type="checkbox" id="marketingConsentDSA2" class="k-checkbox" name="marketingConsentDSA2">
                            <label class="k-checkbox-label" for="marketingConsentDSA2">
                                b) Przekazywanie treści marketingowych na  podany przez mnie nr telefonu w tym przy użyciu automatycznych systemów wywołujących
                                w rozumieniu ustawy z dnia 17.07.2004 r. Prawo telekomunikacyjne (Dz.U. z 2016 r. poz. 1489)
                            </label>
                        </div>
                    </li>
                    <li class="row" style="padding-bottom: 0.5em; margin-left: 15px; margin-right:10px;">
                        2. VOTUM S.A., ul. Wyścigowa 56i, 53-012 Wrocław,
                    </li>
                    <li class="row" style="padding-bottom: 0.5em;padding-left: 2.0em;">
                        <div class="col-md-12">
                            <input type="checkbox" id="marketingConsentVOTUM1" class="k-checkbox" name="marketingConsentVOTUM1">
                            <label class="k-checkbox-label" for="marketingConsentVOTUM1">
                                a) przesyłanie informacji handlowych za pośrednictwem środków komunikacji elektronicznej zgodnie z ustawą z dn. 08.07.2002 r. o
                                świadczeniu usług drogą elektroniczną (t. j. Dz.U. z 2017 r. poz. 1219)
                            </label>
                        </div>
                    </li>
                    <li class="row" style="padding-bottom: 0.5em;padding-left: 2.0em;">
                        <div class="col-md-12">
                            <input type="checkbox" id="marketingConsentVOTUM2" class="k-checkbox" name="marketingConsentVOTUM2">
                            <label class="k-checkbox-label" for="marketingConsentVOTUM2">
                                b) przekazywanie treści marketingowych na podany przeze mnie nr telefonu w tym przy użyciu automatycznych systemów wywołujących
                                w rozumieniu ustawy z dn.16.07.2004 r. Prawo telekomunikacyjne (t. j. Dz.U. z 2017 r. poz. 1907)
                            </label>
                        </div>
                    </li>
                </div>
            </ul>
            <a role="button" class="k-button k-button-icontext k-primary nextTab4 odswierzSesje nextTabButton" href="#">Przejdź dalej</a>
        </div>
        <div>
            <ul class="fieldlist">
                <div class="card">
                    <label for="simple-input" class="big_label" style="width: 100%; float: left;">Wynagrodzenie</label>
                    <li class="row" style="padding-bottom: 0.5em; margin-left: 10px; margin-right:10px;">
                        Odbiorcą wynagrodzenia jest:
                    </li>
                    <li class="row" style="padding-bottom: 1.5em;padding-left: 0.5em;">
                        <div class="col-md-3">
                            <input type="radio" id="ConsumerFirst" value="1" class="k-radio" name="Consumer">
                            <label class="k-radio-label" for="ConsumerFirst">
                                Zleceniodawca/Właściciel
                            </label>
                        </div>
                        <div class="col-md-3">
                            <input type="radio" id="ConsumerSecond" value="2" class="k-radio" name="Consumer">
                            <label class="k-radio-label" for="ConsumerSecond">
                                Współwłaściciel
                            </label>
                        </div>
                    </li>

                    <li class="row" style="padding-bottom: 0.5em; margin-left: 10px; margin-right:10px;">
                        Forma przekazania wynagrodzenia:
                    </li>
                    <li class="row" style="padding-bottom: 2em;padding-left: 0.5em;">
                        <div class="col-md-3">
                            <input type="radio" name="PaymentForm" id="PaymentTransfer" value="0" class="k-radio" style="margin-top: 10px;">
                            <label class="k-radio-label" for="PaymentTransfer">przelew bankowy</label>
                        </div>
                        <div class="col-md-3">
                            <input type="radio" name="PaymentForm" id="PaymentPostOfficeTransfer" value="1" class="k-radio">
                            <label class="k-radio-label" for="PaymentPostOfficeTransfer">przekaz pocztowy</label>
                        </div>
                    </li>

                    <li class="row">
                        <div class="col-md-4 inputValidate-5">
                            <label for="simple-input">Numer konta</label>
                            <input name="AccountNumber" id="AccountNumber" type="text" class="k-input k-textbox" required
                                   validationMessage="To pole jest wymagane." value="" style="width: 100%;"/>
                        </div>
                        <div class="col-md-3">
                            <label for="simple-input">Imię</label>
                            <input name="CustomerFirstName" id="CustomerFirstName" type="text" class="k-input k-textbox"
                                   value="" style="width: 100%;"/>
                        </div>
                        <div class="col-md-5">
                            <label for="simple-input">Nazwisko/Firma</label>
                            <input name="CustomerLastName" id="CustomerLastName" type="text" class="k-input k-textbox"
                                   value="" style="width: 100%;"/>
                        </div>
                    </li>
                    <li class="row">
                        <div class="col-md-4">
                            <label for="simple-input">Ulica</label>
                            <input name="CustomerStreet" id="CustomerStreet" type="text" class="k-input k-textbox" value=""
                                   style="width: 100%;"/>
                        </div>
                        <div class="col-md-2">
                            <label for="simple-input">Nr domu/mieszkania</label>
                            <input name="CustomerHomeNumber" id="CustomerHomeNumber" type="text" class="k-input k-textbox"
                                   value="" style="width: 100%;"/>
                        </div>
                        <div class="col-md-2">
                            <label for="simple-input">Kod pocztowy</label>
                            <input name="CustomerPostCode" id="CustomerPostCode" type="text" class="k-input k-textbox"
                                   pattern="\d{2}-\d{3}" value="" style="width: 100%;"/>
                        </div>
                        <div class="col-md-4">
                            <label for="simple-input">Miejscowość</label>
                            <input name="CustomerCity" id="CustomerCity" type="text" class="k-input k-textbox" value=""
                                   style="width: 100%;"/>
                        </div>
                    </li>
                </div>
            </ul>
            <a role="button" id="update" class="k-button k-button-icontext k-primary nextTab5 odswierzSesje nextTabButton" href="#">Przejdź dalej</a>
        </div>
        <div>
            <ul class="fieldlist">
                <div class="card">
                    <label for="simple-input" class="big_label" style="width: 100%; float: left;">Dane przedstawiciela oraz umowy</label>

                    <li class="row">
                        <div class="col-md-4 inputValidate-6">
                            <label for="simple-input">Prowizja</label>
                            <input name="Commission" id="Commission" type="text" class="k-input k-textbox" value="" style="width: 100%;" required
                                   validationMessage="To pole jest wymagane."/>
                            <span class="k-invalid-msg" data-for="Commission"></span>
                        </div>
                        <div class="col-md-4 inputValidate-6">
                            <label for="simple-input">Kod jednostki</label>
                            <input name="UnitCode" id="UnitCode" type="text" class="k-input k-textbox" value="" style="width: 100%; " required
                                   validationMessage="To pole jest wymagane."/>
                            <span class="k-invalid-msg" data-for="UnitCode"></span>
                        </div>
                        <div class="col-md-4 inputValidate-6">
                            <label for="simple-input">Kod konsultanta</label>
                            <input name="ConsultantCode" id="ConsultantCode" type="text" class="k-input k-textbox" value="" style="width: 100%;" required
                                   validationMessage="To pole jest wymagane."/>
                            <span class="k-invalid-msg" data-for="ConsultantCode"></span>
                        </div>
                    </li>
                </div>
            </ul>
            <a role="button" id="update" class="k-button k-button-icontext k-primary nextTabButton odswierzSesje saveContract" href="#">Zapisz</a>
        </div>
    </div>
</div>
<div style="width: 100%; float: left; margin: 10px 0 10px 0;"></div>

