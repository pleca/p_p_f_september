<script id="editContractTemplate" type="text/x-kendo-template">
    <div id="tabstrip_bona_edit" data-contract_bona_id="#= data.ID #">
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
                            <a role="button" class="k-button k-button-icontext k-primary data-button" id="clear-data" href="\#" style="width:100%">Kopiuj adres zameldowania</a>
                        </div>
                    </li>
                    <li class="row">
                        <div class="col-md-6">
                            <label for="simple-input">Imię</label>
                            <input name="FirstNameIEdit" id="FirstNameI" type="text" value="#= (data.FirstNameI != null) ? data.FirstNameI : '' #" class="k-input k-textbox"
                                   required validationMessage="To pole jest wymagane." style="width: 100%;"/>
                        </div>
                        <div class="col-md-6">
                            <label for="simple-input">Nazwisko/Firma</label>
                            <input name="LastNameIEdit" type="text" value="#= (data.LastNameI != null) ? data.LastNameI : '' #" id="LastNameI" class="k-input k-textbox"
                                   required validationMessage="To pole jest wymagane." style="width: 100%;"/>
                        </div>
                    </li>
                    <li class="row">
                        <div class="col-md-3">
                            <label for="simple-input">PESEL</label>
                            <input name="PESELIEdit" type="text" value="#= (data.PESELI != null) ? data.PESELI : '' #" id="PESELI" pattern="\d{11}"
                                   class="k-input k-textbox" required validationMessage="To pole jest wymagane."
                                   style="width: 100%;"/>
                        </div>
                        <div class="col-md-3">
                            <label for="simple-input">Nr dokumentu tożsamości</label>
                            <input name="IdentityCardIEdit" id="IdentityCardI" value="#= (data.IdNrI != null) ? data.IdNrI : '' #" type="text" class="k-input k-textbox"
                                  required validationMessage="To pole jest wymagane." style="width: 100%;"/>
                        </div>
                        <div class="col-md-3">
                            <label for="simple-input">Telefon*</label>
                            <input name="PhoneIEdit" id="PhoneI" type="tel" value="#= (data.PhoneI != null) ? data.PhoneI : '' #" class="k-input k-textbox" pattern="\d{9}"
                                   style="width: 100%;"/>
                        </div>
                        <div class="col-md-3">
                            <label for="simple-input">E-Mail**</label>
                            <input name="EmailIEdit" id="EmailI" type="email" value="#= (data.EmailI != null) ? data.EmailI : '' #" class="k-input k-textbox" style="width: 100%;"/>
                        </div>
                    </li>
                    <li class="row">
                        <div class="col-md-4">
                            <label for="simple-input">NIP</label>
                            <input name="NIPIEdit" type="text" id="NIPI" value="#= (data.NIPI != null) ? data.NIPI : '' #" pattern="\d{10}"
                                   class="k-input k-textbox" style="width: 100%;"/>
                        </div>
                        <div class="col-md-4">
                            <label for="simple-input">REGON</label>
                            <input name="REGONIEdit" id="REGONI" type="text" value="#= (data.REGONI != null) ? data.REGONI : '' #" class="k-input k-textbox"
                                   style="width: 100%;"/>
                        </div>
                        <div class="col-md-4">
                            <label for="simple-input">KRS</label>
                            <input name="KRSIEdit" id="KRSI" type="text" value="#= (data.KRSI != null) ? data.KRSI : '' #" class="k-input k-textbox"
                                   style="width: 100%;"/>
                        </div>
                    </li>
                    <label for="simple-input" class="small_label" style="width: 100%; float: left;">Adres zameldowania:</label>
                    <li class="row">
                        <div class="col-md-3">
                            <label for="simple-input">Ulica</label>
                            <input name="StreetIEdit" type="text" id="StreetI" value="#= (data.StreetI != null) ? data.StreetI : '' #" class="k-input k-textbox"
                                   style="width: 100%;"/>
                        </div>
                        <div class="col-md-3">
                            <label for="simple-input">Nr domu</label>
                            <input name="HomeNumberIEdit" type="text" id="HomeNumberI" value="#= (data.HomeNumberI != null) ? data.HomeNumberI : '' #" class="k-input k-textbox"
                                   style="width: 100%;"/>
                        </div>
                        <div class="col-md-3">
                            <label for="simple-input">Kod pocztowy</label>
                            <input name="PostCodeIEdit" type="text" id="PostCodeI" value="#= (data.PostCodeI != null) ? data.PostCodeI : '' #" pattern="\d{2}-\d{3}"
                                   class="k-input k-textbox" style="width: 100%;"/>
                        </div>
                        <div class="col-md-3">
                            <label for="simple-input">Miejscowość</label>
                            <input name="CityIEdit" type="text" id="CityI" value="#= (data.CityI != null) ? data.CityI : '' #" class="k-input k-textbox"
                                   style="width: 100%;"/>
                        </div>
                    </li>
                    <label for="simple-input" class="small_label" style="width: 100%; float: left;">Adres korespondencyjny (jeśli inny niż zameldowania):</label>
                    <li class="row">
                        <div class="col-md-3">
                            <label for="simple-input">Ulica</label>
                            <input name="StreetEdit" type="text" id="Street" value="#= (data.Street != null) ? data.Street : '' #" class="k-input k-textbox"
                                   style="width: 100%;"/>
                        </div>
                        <div class="col-md-3">
                            <label for="simple-input">Nr domu/mieszkania</label>
                            <input name="HomeNumberEdit" type="text" id="HomeNumber" value="#= (data.Home != null) ? data.Home : '' #" class="k-input k-textbox"
                                   style="width: 100%;"/>
                        </div>
                        <div class="col-md-3">
                            <label for="simple-input">Kod pocztowy</label>
                            <input name="PostCodeEdit" type="text" id="PostCode" value="#= (data.PostCode != null) ? data.PostCode : '' #" pattern="\d{2}-\d{3}"
                                   class="k-input k-textbox" style="width: 100%;"/>
                        </div>
                        <div class="col-md-3">
                            <label for="simple-input">Miejscowość</label>
                            <input name="CityEdit" type="text" id="City" value="#= (data.City != null) ? data.City : '' #" class="k-input k-textbox"
                                   style="width: 100%;"/>
                        </div>
                    </li>
                    <li class="row">
                        <div class="col-md-6">
                            <input type="checkbox" id="CompanyEdit" name="CompanyEdit" class="k-checkbox" #= (data.Company != 0) ? checked='checked' : '' #>
                            <label class="k-checkbox-label" for="CompanyEdit">Zleceniodawca oświadcza, że prowadzi pozarolniczą działalność gospodarczą.</label>
                        </div>
                        <div class="col-md-6">
                            <input type="checkbox" id="VATEdit" name="VATEdit" class="k-checkbox" #= (data.VAT != 0) ? checked='checked' : '' #>
                            <label class="k-checkbox-label" for="VATEdit">Zleceniodawca oświadcza, że jestem płatnikiem podatku VAT.</label>
                        </div>
                    </li>
                </div>
            </ul>
            <ul class="fieldlist">
                <div class="card">
                    <li class="row">
                        <div class="col-md-6"><label for="simple-input" class="big_label" style="width: 100%; float: left;">Współwłaściciel</label></div>
                        <div class="col-md-3">
                            <a role="button" class="k-button k-button-icontext k-primary data-button-adress" id="copy-first-address" href="\#" style="width:100%">Kopiuj adres zameldowania</a>
                        </div>
                        <div class="col-md-3">
                            <a role="button" class="k-button k-button-icontext k-primary data-button-adress" id="copy-second-address" href="\#" style="width:100%">Kopiuj adres korespondencyjny</a>
                        </div>
                    </li>
                    <li class="row">
                        <div class="col-md-6">
                            <label for="simple-input">Imię</label>
                            <input name="FirstNameIIEdit" id="FirstNameII" value="#= (data.FirstNameII != null) ? data.FirstNameII : '' #" type="text" class="k-input k-textbox"
                                   required validationMessage="To pole jest wymagane." style="width: 100%;"/>
                        </div>
                        <div class="col-md-6">
                            <label for="simple-input">Nazwisko/Firma</label>
                            <input name="LastNameIIEdit" type="text" value="#= (data.LastNameII != null) ? data.LastNameII : '' #" id="LastNameII" class="k-input k-textbox"
                                   required validationMessage="To pole jest wymagane." style="width: 100%;"/>
                        </div>
                    </li>
                    <li class="row">
                        <div class="col-md-3">
                            <label for="simple-input">PESEL</label>
                            <input name="PESELIIEdit" type="text" value="#= (data.PESELII != null) ? data.PESELII : '' #" id="PESELII" pattern="\d{11}"
                                   class="k-input k-textbox" required validationMessage="To pole jest wymagane."
                                   style="width: 100%;"/>
                        </div>
                        <div class="col-md-3">
                            <label for="simple-input">Nr dokumentu tożsamości</label>
                            <input name="IdentityCardIIEdit" id="IdentityCardII" value="#= (data.IdNrII != null) ? data.IdNrII : '' #" type="text" class="k-input k-textbox"
                                   required validationMessage="To pole jest wymagane." style="width: 100%;"/>
                        </div>
                        <div class="col-md-3">
                            <label for="simple-input">Telefon*</label>
                            <input name="PhoneIIEdit" id="PhoneII" type="tel" value="#= (data.PhoneII != null) ? data.PhoneII : '' #" class="k-input k-textbox" pattern="\d{9}"
                                   style="width: 100%;"/>
                        </div>
                        <div class="col-md-3">
                            <label for="simple-input">E-Mail**</label>
                            <input name="EmailIIEdit" id="EmailII" value="#= (data.EmailII != null) ? data.EmailII : '' #" type="email" class="k-input k-textbox" style="width: 100%;"/>
                        </div>
                    </li>
                    <label for="simple-input" class="small_label" style="width: 100%; float: left;">Adres zameldowania:</label>
                    <li class="row">
                        <div class="col-md-3">
                            <label for="simple-input">Ulica</label>
                            <input name="StreetIIEdit" type="text" value="#= (data.StreetII != null) ? data.StreetII : '' #" id="StreetII" class="k-input k-textbox"
                                   style="width: 100%;"/>
                        </div>
                        <div class="col-md-3">
                            <label for="simple-input">Nr domu</label>
                            <input name="HomeNumberIIEdit" type="text" value="#= (data.HomeII != null) ? data.HomeII : '' #" id="HomeNumberII" class="k-input k-textbox"
                                   style="width: 100%;"/>
                        </div>
                        <div class="col-md-3">
                            <label for="simple-input">Kod pocztowy</label>
                            <input name="PostCodeIIEdit" type="text" value="#= (data.PostCodeII != null) ? data.PostCodeII : '' #" id="PostCodeII" pattern="\d{2}-\d{3}"
                                   class="k-input k-textbox" style="width: 100%;"/>
                        </div>
                        <div class="col-md-3">
                            <label for="simple-input">Miejscowość</label>
                            <input name="CityIIEdit" type="text" value="#= (data.CityII != null) ? data.CityII : '' #" id="CityII" class="k-input k-textbox"
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
                            <input name="PhoneFirstNameEdit" type="text" value="#= (data.FirstName != null) ? data.FirstName : '' #" id="PhoneFirstName" class="k-input k-textbox"
                                   style="width: 100%;"/>
                        </div>
                        <div class="col-md-5">
                            <label for="simple-input">Nazwisko</label>
                            <input name="PhoneLastNameEdit" type="text" value="#= (data.LastName != null) ? data.LastName : '' #" id="PhoneLastName" class="k-input k-textbox"
                                   style="width: 100%;"/>
                        </div>
                        <div class="col-md-3">
                            <label for="simple-input">PESEL</label>
                            <input name="PhonePESELEdit" type="text" value="#= (data.PESEL != null) ? data.PESEL : '' #" id="PhonePESEL" pattern="\d{11}" class="k-input k-textbox"
                                   style="width: 100%;"/>
                        </div>
                    </li>
                </div>
            </ul>
            <a role="button" id="editContractBona" class="k-button k-button-icontext k-primary updateContract" href="\#">Przejdź dalej</a>
        </div>
        <div>
            <ul class="fieldlist">
                <div class="card">
                    <label for="simple-input" class="big_label" style="width: 100%; float: left;">Przedmiot umowy</label>
                    <li class="row">
                        <div class="col-md-4">
                            <label for="simple-input">Data i godzina zdarzenia:</label>
                            <input name="IncidentDateEdit" id="IncidentDateEdit" value="#= (data.IncidentDate != null) ? data.IncidentDate : '' #" style="width: 100%;" class="k-input"/>
                        </div>
                        <div class="col-md-8">
                            <label for="simple-input">Przyczyna powstania szkody (np. powódź, podtopienie, silny wiatr, pożar, przymrozek, kolizja drogowa, itp.)</label>
                            <input name="ReasonEdit" type="text" class="k-input k-textbox" value="#= (data.Reason != null) ? data.Reason : '' #" style="width: 100%;"/>
                        </div>
                    </li>
                    <li class="row">
                        <div class="col-md-12">
                            <label for="simple-input">Opis powstałych szkód - dokładna lokalizacja przedmiotu szkody</label>
                            <textarea cols="20" name="DiscriptionEdit" rows="3" class="k-textbox k-input" style="width: 100%; height: 200px; padding: 10px;">#= (data.Description != null) ? data.Description : '' #</textarea>
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
                            <input name="InsurerIEdit" type="text" id="InsurerIEdit" class="k-input k-textbox" value="#= (data.PolicyId1 != null) ? data.PolicyId1 : '' #" style="width: 100%;"/>
                        </div>
                        <div class="col-md-3">
                            <label for="simple-input">Nazwa polisy</label>
                            <input name="PolicyNameIEdit" type="text" id="PolicyNameI" class="k-input k-textbox" value="#= (data.PolicyName1 != null) ? data.PolicyName1 : '' #" style="width: 100%;"/>
                        </div>
                        <div class="col-md-3">
                            <label for="simple-input">Numer polisy</label>
                            <input name="PolicyNumberIEdit" type="text" id="PolicyNumberI" class="k-input k-textbox" value="#= (data.PolicyNumber1 != null) ? data.PolicyNumber1 : '' #" style="width: 100%;"/>
                        </div>
                    </li>
                    <li class="row">
                        <div class="col-md-1">
                            <label for="simple-input"></label>
                            <div style="width: 100%;font-weight: bold; margin-top:20px; text-align:center;">II </div>
                        </div>
                        <div class="col-md-5">
                            <label for="simple-input">Zakład ubezpieczeń</label>
                            <input name="InsurerIIEdit" type="text" id="InsurerIIEdit" class="k-input k-textbox" value="#= (data.PolicyId2 != null) ? data.PolicyId2 : '' #" style="width: 100%;"/>
                        </div>
                        <div class="col-md-3">
                            <label for="simple-input">Nazwa polisy</label>
                            <input name="PolicyNameIIEdit" type="text" id="PolicyNameII" class="k-input k-textbox" value="#= (data.PolicyName2 != null) ? data.PolicyName2 : '' #" style="width: 100%;"/>
                        </div>
                        <div class="col-md-3">
                            <label for="simple-input">Numer polisy</label>
                            <input name="PolicyNumberIIEdit" type="text" id="PolicyNumberII" class="k-input k-textbox" value="#= (data.PolicyNumber2 != null) ? data.PolicyNumber2 : '' #" style="width: 100%;"/>
                        </div>
                    </li>
                    <li class="row">
                        <div class="col-md-1">
                            <label for="simple-input"></label>
                            <div style="width: 100%;font-weight: bold; margin-top:20px; text-align:center;">III </div>
                        </div>
                        <div class="col-md-5">
                            <label for="simple-input">Zakład ubezpieczeń</label>
                            <input name="InsurerIIIEdit" type="text" id="InsurerIIIEdit" class="k-input k-textbox" value="#= (data.PolicyId3 != null) ? data.PolicyId3 : '' #" style="width: 100%;"/>
                        </div>
                        <div class="col-md-3">
                            <label for="simple-input">Nazwa polisy</label>
                            <input name="PolicyNameIIIEdit" type="text" id="PolicyNameIII" class="k-input k-textbox" value="#= (data.PolicyName3 != null) ? data.PolicyName3 : '' #" style="width: 100%;"/>
                        </div>
                        <div class="col-md-3">
                            <label for="simple-input">Numer polisy</label>
                            <input name="PolicyNumberIIIEdit" type="text" id="PolicyNumberIII" class="k-input k-textbox" value="#= (data.PolicyNumber3 != null) ? data.PolicyNumber3 : '' #" style="width: 100%;"/>
                        </div>
                    </li>


                    <li class="row" style="padding-bottom: 0.5em; margin-left: 10px; margin-right:10px;">
                        Czy zgłoszono szkodę do zakładu ubezpieczeń?
                    </li>

                    <li class="row" style="margin-left: 10px; margin-right:10px;padding-bottom:0em;">
                        <div class="col-md-3" style="float:left;">
                            <input type="radio" name="NotificationEdit" id="NotificationNoEdit" value="0" class="k-radio" #= (data.Notification == 0) ? checked='checked' : '' #>
                            <label class="k-radio-label" for="NotificationNoEdit">nie</label>
                        </div>
                        <div class="col-md-4" style="float:left;">
                            <input type="radio" name="NotificationEdit" id="NotificationYesEdit" value="1" class="k-radio" #= (data.Notification == 1) ? checked='checked' : '' #>
                            <label class="k-radio-label" for="NotificationYesEdit" style="float:left">tak, data zgłoszenia: &nbsp;</label>
                            <input name="NotificationDateEdit" id="NotificationDateEdit" value="#= (data.NotificationDate != null) ? data.NotificationDate : '' #" disabled style="width: 50%; height: 26px;top:-5px;" class="k-input"/>
                        </div>
                    </li>
                    <li class="row" style="padding-bottom: 0.5em; margin-left: 10px; margin-right:10px;">
                        Odszkodowania:
                    </li>
                    <li class="row" style="margin-left: 10px; margin-right:10px;padding-bottom:0.5em;">
                        <div class="col-md-3" style="float:left;">
                            <input type="radio" name="PaidOutEdit" id="PaidOutNoEdit" value="0" class="k-radio" style="margin-top: 10px;" #= (data.PaidOut == 0) ? checked='checked' : '' #>
                            <label class="k-radio-label" for="PaidOutNoEdit">nie wypłacono</label>
                        </div>
                        <div class="col-md-6" style="float:left;">
                            <input type="radio" name="PaidOutEdit" id="PaidOutYesEdit" value="1" class="k-radio" #= (data.PaidOut == 1) ? checked='checked' : '' #>
                            <label class="k-radio-label" for="PaidOutYesEdit" style="float:left">wypłacono w kwocie: </label>
                            <input name="AnountPaidOutEdit" type="text" id="AnountPaidOutEdit" disabled class="k-input k-textbox" value="#= (data.AnountPaidOut != null) ? data.AnountPaidOut : '' #" style="width: 30%; height: 26px; top:-5px;"/>&nbsp;zł,
                        </div>
                    </li>
                    <li class="row" style="margin-left: 10px; margin-right:10px;">
                        <div class="col-md-12" style="margin-left: 10px; margin-right:10px;">
                            numer szkody nadany przez zakład ubezpieczeń: &nbsp;
                            <input name="DamageNumberEdit" type="text" id="DamageNumberEdit" disabled class="k-input k-textbox" value="#= (data.DamageNumber != null) ? data.DamageNumber : '' #" style="width: 30%; height: 26px; top:0px;"/>
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
                            <input type="radio" name="AssignmentEdit" id="AssignmentNoEdit" value="0" class="k-radio" style="margin-top: 10px;" #= (data.Assignment == 0) ? checked='checked' : '' #>
                            <label class="k-radio-label" for="AssignmentNoEdit">nie</label>
                        </div>
                        <div class="col-md-6" style="float:left;">
                            <input type="radio" name="AssignmentEdit" id="AssignmentYesEdit" value="1" class="k-radio" #= (data.Assignment == 1) ? checked='checked' : '' #>
                            <label class="k-radio-label" for="AssignmentYesEdit" style="float:left"> tak &nbsp; </label>
                            <input name="AssignmentValueEdit" type="text" id="AssignmentValueEdit" disabled class="k-input k-textbox" value="#= (data.AssignmentValue != null) ? data.AssignmentValue : '' #" style="width: 50%; height: 26px; top:-5px;"/>
                        </div>
                    </li>
                    <li class="row" style="padding-bottom: 0.5em;padding-left: 0.5em;">
                        <div class="col-md-12">
                            <input type="radio" id="OtherAgentNoEdit" value="0" class="k-radio" name="OtherAgentEdit" #= (data.OtherAgent == 0) ? checked='checked' : '' #>
                            <label class="k-radio-label" for="OtherAgentNoEdit">Nie zlecano wcześniej dochodzenia roszczeń żadnemu podmiotowi. &nbsp;</label>
                        </div>
                    </li>
                    <li class="row" style="padding-bottom: 0.5em;padding-left: 0.5em;">
                        <div class="col-md-12">
                            <input type="radio" id="OtherAgentYesEdit" class="k-radio" name="OtherAgent" value="1" #= (data.OtherAgent == 1) ? checked='checked' : '' #>
                            <label class="k-radio-label" for="OtherAgentYesEdit"> Sprawę zlecono wcześniej pełnomocnikowi (nazwa): &nbsp;
                                <input name="OtherAgentNameEdit" type="text" disabled id="OtherAgentNameEdit" class="k-input k-textbox" value="#= (data.OtherAgentName != null) ? data.OtherAgentName : '' #" style="width: 40%; height: 26px; top:-5px;"/>&nbsp;
                            </label>
                        </div>
                    </li>
                    <li class="row" style="padding-bottom: 0.5em;padding-left: 0.5em;margin-left:10px">
                        <div class="col-md-12">
                            <div class="k-inline-label" style="float:left;"> z którym zawarto umowę dnia: &nbsp;</div>
                            <input name="OtherAgentContractDateEdit" disabled id="OtherAgentContractDateEdit" class="k-input" value="#= (data.OtherAgentContractDate != null) ? data.OtherAgentContractDate : '' #" style="width: 20%; height: 26px; top:-5px;"/>
                        </div>
                    </li>
                    <li class="row" style="padding-bottom: 0.5em;padding-left: 0.5em;">
                        <div class="col-md-12">
                            <input type="checkbox" id="TerminateEdit" class="k-checkbox" name="TerminateEdit" #= (data.Terminate != 0) ? checked='checked' : '' #>
                            <label class="k-checkbox-label" for="TerminateEdit" style="float:left;"> Umowę z wyżej wymienionym wypowiedziano w dniu: &nbsp;</label>
                            <input name="TerminateDateEdit" type="text" id="TerminateDateEdit" disabled class="k-input k-textbox" value="#= (data.TerminateDate != null) ? data.TerminateDate : '' #" style="width: 20%; height: 26px; top:-5px;"/>
                        </div>
                    </li>
                    <li class="row" style="padding-bottom: 0.5em;padding-left: 0.5em;">
                        <div class="col-md-12">
                            <input type="checkbox" id="Page" name="PageEdit" class="k-checkbox">
                            <label class="k-inline-label" style="float:left;">Przekazałem pełnomocnikowi Votum S.A. dokumentację składającą się z: &nbsp;</label>
                            <input name="PageValueEdit" type="text" id="PageValue" class="k-input k-textbox" value="#= (data.PageValue != null) ? data.PageValue : '' #" style="width: 10%; height: 26px; top:-5px;"/> kart.
                        </div>
                    </li>
                    <li class="row" style="padding-bottom: 0.5em; margin-left: 10px; margin-right:10px;">
                        Wyrażam zgodę na otrzymywanie informacji związanych z wykonywaniem umowy poprzez:
                    </li>
                    <li class="row" style="padding-bottom: 0.5em;padding-left: 0.5em;">
                        <div class="col-md-3">
                            <input type="checkbox" id="ConsentSMSEdit" class="k-checkbox" name="ConsentSMSEdit" #= (data.ConsentSMS != 0) ? checked='checked' : '' #>
                            <label class="k-checkbox-label" for="ConsentSMSEdit">
                                wiadomości tekstowe SMS
                            </label>
                        </div>
                        <div class="col-md-6">
                            <input type="checkbox" id="ConsentEmailEdit" class="k-checkbox" name="ConsentEmailEdit" #= (data.ConsentEmail != 0) ? checked='checked' : '' #>
                            <label class="k-checkbox-label" for="ConsentEmailEdit">
                                wiadomości e-mail na podany przeze mnie numer/adres.
                            </label>
                        </div>
                    </li>
                </div>
            </ul>
            <a role="button" class="k-button k-button-icontext k-primary updateContract odswierzSesje" href="\#">Przejdź dalej</a>
        </div>
        <div>
            <ul class="fieldlist">
                <div class="card">
                    <label for="simple-input" class="big_label" style="width: 100%; float: left;">Informacje dotyczące szkody</label>
                    <div id="panelbar_bona_edit">
                        <li class="k-state-active">
                            1. Czy na miejscu zdarzenia były służby ratunkowe, policja, pogotowie? Jeśli tak, to jakie jednostki i z jakiej miejscowości?
                            <span class="k-icon k-i-edit k-panelbar-collapse-status"></span>
                            <div class="answerEdit">
                                <textarea cols="20" rows="3" class="k-textbox k-input" name="Answer1Edit" style="width: 100%; height: 200px;">#= (data.Answer1 != null) ? data.Answer1 : '' #</textarea>
                            </div>
                        </li>
                        <li>
                            2. Jeżeli prowadzone jest lub było prowadzone postępowanie - jaka jest sygnatura akt; jaki jest jego obecny etap lub jak zakończyło się?
                            <span class="k-icon k-i-edit k-panelbar-collapse-status"></span>
                            <div class="answerEdit">
                                <textarea cols="20" rows="3" class="k-textbox k-input" name="Answer2Edit" style="width: 100%; height: 200px;">#= (data.Answer2 != null) ? data.Answer2 : '' #</textarea>
                            </div>
                        </li>
                        <li>
                            3. Czy jest możliwe przeprowadzenie oględzin uszkodzonego mienia; jeśli nie jest to możliwe, to z jakiej przyczyny?
                            <span class="k-icon k-i-edit k-panelbar-collapse-status"></span>
                            <div class="answerEdit">
                                <textarea cols="20" rows="3" class="k-textbox k-input" name="Answer3Edit" style="width: 100%; height: 200px;">#= (data.Answer3 != null) ? data.Answer3 : '' #</textarea>
                            </div>
                        </li>
                        <li>
                            4. Czy przedmiot szkody uległ całkowitemu zniszczeniu lub utracie; czy też możliwa jest jego odbudowa, naprawa lub odtworzenie?
                            <span class="k-icon k-i-edit k-panelbar-collapse-status"></span>
                            <div class="answerEdit">
                                <textarea cols="20" rows="3" class="k-textbox k-input" name="Answer4Edit" style="width: 100%; height: 200px;">#= (data.Answer4 != null) ? data.Answer4 : '' #</textarea>
                            </div>
                        </li>
                        <li>
                            5. Czy dokonano odbudowy, naprawy lub odtworzenia uszkodzonego mienia?
                            <span class="k-icon k-i-edit k-panelbar-collapse-status"></span>
                            <div class="answer">
                                <textarea cols="20" rows="3" class="k-textbox k-input" name="Answer5Edit" style="width: 100%; height: 200px;">#= (data.Answer5 != null) ? data.Answer5 : '' #</textarea>
                            </div>
                        </li>
                        <li>
                            6. Jeżeli nie dokonano odbudowy, naprawy lub odtworzenia, to czy jest to planowane - jeśli tak, to w jakim terminie?
                            <span class="k-icon k-i-edit k-panelbar-collapse-status"></span>
                            <div class="answerEdit">
                                <textarea cols="20" rows="3" class="k-textbox k-input" name="Answer6Edit" style="width: 100%; height: 200px;">#= (data.Answer6 != null) ? data.Answer6 : '' #</textarea>
                            </div>
                        </li>
                        <li>
                            7. Czy odbudowa, naprawa lub odtworzenie zostało wykonane bądź będzie wykonane za pośrednictwem wyspecjalizowanego podmiotu czy
                            też samodzielnie we własnym zakresie?
                            <span class="k-icon k-i-edit k-panelbar-collapse-status"></span>
                            <div class="answerEdit">
                                <textarea cols="20" rows="3" class="k-textbox k-input" name="Answer7Edit" style="width: 100%; height: 200px;">#= (data.Answer7 != null) ? data.Answer7 : '' #</textarea>
                            </div>
                        </li>
                        <li>
                            8. Jakimi dowodami dysponuje poszkodowany, które wskazują na rzeczywiste koszty odbudowy, naprawy lub odtworzenia (np. rachunki,
                            faktury, kosztorys, wycena, oferta naprawy/obudowy, ect.)
                            <span class="k-icon k-i-edit k-panelbar-collapse-status"></span>
                            <div class="answerEdit">
                                <textarea cols="20" rows="3" class="k-textbox k-input" name="Answer8Edit" style="width: 100%; height: 200px;">#= (data.Answer8 != null) ? data.Answer8 : '' #</textarea>
                            </div>
                        </li>
                        <li>
                            9. Czy dokonana odbudowa, naprawa lub odtworzenie zostało wykonane przy zachowaniu dotychczasowych wymiarów, konstrukcji i materiałów
                            czy też dokonano zmian w odniesieniu do stanu nim szkoda wystąpiła?
                            <span class="k-icon k-i-edit k-panelbar-collapse-status"></span>
                            <div class="answerEdit">
                                <textarea cols="20" rows="3" class="k-textbox k-input" name="Answer9Edit" style="width: 100%; height: 200px;">#= (data.Answer9 != null) ? data.Answer9 : '' #</textarea>
                            </div>
                        </li>
                    </div>
                </div>
            </ul>
            <a role="button" class="k-button k-button-icontext k-primary updateContract odswierzSesje" href="\#">Przejdź dalej</a>
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
                            <input type="checkbox" id="dataConsentDSAEdit" class="k-checkbox" name="dataConsentDSAEdit" #= (data.DSAI != 0) ? checked='checked' : '' #>
                            <label class="k-checkbox-label" for="dataConsentDSAEdit">
                                DSA Investment S.A. Al. Wiśniowa 47, 53-126 Wrocław, KRS: 0000391830, w zakresie danych teleadresowych w celu sporządzenia oferty
                                produktów finansowych i ubezpieczeń osobowych;
                            </label>
                        </div>
                    </li>
                    <li class="row" style="padding-bottom: 0.5em;padding-left: 1.0em;">
                        <div class="col-md-12">
                            <input type="checkbox" id="dataConsentPCRFEdit" class="k-checkbox" name="dataConsentPCRFEdit" #= (data.PCRFI != 0) ? checked='checked' : '' #>
                            <label class="k-checkbox-label" for="dataConsentPCRFEdit">
                                Polskie Centrum Rehabilitacji Funkcjonalnej Votum S.A. Sp. k., Golikówka 6, 30-723 Kraków, KRS: 0000290430 , w zakresie danych
                                zawartych w umowie i przekazanej dokumentacji, w tym stanu zdrowia w celu sporządzenia
                                oferty rehabilitacji;
                            </label>
                        </div>
                    </li>
                    <li class="row" style="padding-bottom: 0.5em;padding-left: 1.0em;">
                        <div class="col-md-12">
                            <input type="checkbox" id="dataConsentVOTUMEdit" class="k-checkbox" name="dataConsentVOTUMEdit" #= (data.FundacjaI != 0) ? checked='checked' : '' #>
                            <label class="k-checkbox-label" for="dataConsentVOTUMEdit">
                                Fundacja VOTUM, ul. Wyścigowa 56i, 53-012 Wrocław, KRS: 0000272272, w zakresie danych zawartych w umowie i przekazanej dokumentacji,
                                w tym stanu zdrowia w celu przedstawienia możliwego zakresu pomocy;
                            </label>
                        </div>
                    </li>
                    <li class="row" style="padding-bottom: 0.5em;padding-left: 1.0em;">
                        <div class="col-md-12">
                            <input type="checkbox" id="dataConsentAUTOVOTUMEdit" class="k-checkbox" name="dataConsentAUTOVOTUMEdit" #= (data.AutovotumI != 0) ? checked='checked' : '' #>
                            <label class="k-checkbox-label" for="dataConsentAUTOVOTUMEdit">
                                AUTOVOTUM S.A., ul. Wyścigowa 56i, 53-012 Wrocław, KRS: 0000273033, w zakresie danych teleadresowych w celu sporządzenia oferty
                                usług wynajmu pojazdów zastępczych;
                            </label>
                        </div>
                    </li>
                    <li class="row" style="padding-bottom: 0.5em;padding-left: 1.0em;">
                        <div class="col-md-12">
                            <input type="checkbox" id="dataConsentBEPEdit" class="k-checkbox" name="dataConsentBEPEdit" #= (data.BEPI != 0) ? checked='checked' : '' #>
                            <label class="k-checkbox-label" for="dataConsentBEPEdit">
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
                            <input type="checkbox" id="marketingConsentDSA1Edit" class="k-checkbox" name="marketingConsentDSA1Edit" #= (data.DSAIIA != 0) ? checked='checked' : '' #>
                            <label class="k-checkbox-label" for="marketingConsentDSA1Edit">
                                a) Przesłanie informacji handlowych za pośrednictwem środków komunikacji elektronicznej, zgodnie z ustawą z dnia 08.07.2002 r. o
                                świadczeniu usług drogą elektroniczną (Dz.U. z 2016 r. poz.1030)
                            </label>
                        </div>
                    </li>
                    <li class="row" style="padding-bottom: 0.5em;padding-left: 2.0em;">
                        <div class="col-md-12">
                            <input type="checkbox" id="marketingConsentDSA2Edit" class="k-checkbox" name="marketingConsentDSA2Edit" #= (data.DSAIIB != 0) ? checked='checked' : '' #>
                            <label class="k-checkbox-label" for="marketingConsentDSA2Edit">
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
                            <input type="checkbox" id="marketingConsentVOTUM1Edit" class="k-checkbox" name="marketingConsentVOTUM1Edit" #= (data.VotumIIA != 0) ? checked='checked' : '' #>
                            <label class="k-checkbox-label" for="marketingConsentVOTUM1Edit">
                                a) przesyłanie informacji handlowych za pośrednictwem środków komunikacji elektronicznej zgodnie z ustawą z dn. 08.07.2002 r. o
                                świadczeniu usług drogą elektroniczną (t. j. Dz.U. z 2017 r. poz. 1219)
                            </label>
                        </div>
                    </li>
                    <li class="row" style="padding-bottom: 0.5em;padding-left: 2.0em;">
                        <div class="col-md-12">
                            <input type="checkbox" id="marketingConsentVOTUM2Edit" class="k-checkbox" name="marketingConsentVOTUM2Edit" #= (data.VotumIIB != 0) ? checked='checked' : '' #>
                            <label class="k-checkbox-label" for="marketingConsentVOTUM2Edit">
                                b) przekazywanie treści marketingowych na podany przeze mnie nr telefonu w tym przy użyciu automatycznych systemów wywołujących
                                w rozumieniu ustawy z dn.16.07.2004 r. Prawo telekomunikacyjne (t. j. Dz.U. z 2017 r. poz. 1907)
                            </label>
                        </div>
                    </li>
                </div>
            </ul>
            <a role="button" class="k-button k-button-icontext k-primary updateContract odswierzSesje" href="\#">Przejdź dalej</a>
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
                            <input type="radio" id="ConsumerFirst" value="1" class="k-radio" name="ConsumerEdit" #= ((data.FirstNameI == data.CustomerFirstName) && (data.LastNameI == data.CustomerLastName)) ? checked='checked' : '' #>
                            <label class="k-radio-label" for="ConsumerFirst">
                                Zleceniodawca/Właściciel
                            </label>
                        </div>
                        <div class="col-md-3">
                            <input type="radio" id="ConsumerSecond" value="2" class="k-radio" name="ConsumerEdit" #= ((data.FirstNameII == data.CustomerFirstName) && (data.LastNameII == data.CustomerLastName)) ? checked='checked' : '' #>
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
                            <input type="radio" name="PaymentFormEdit" id="PaymentTransferEdit" value="0" class="k-radio" style="margin-top: 10px;" #= (data.PaymentForm == 0) ? checked='checked' : '' #>
                            <label class="k-radio-label" for="PaymentTransferEdit">przelew bankowy</label>
                        </div>
                        <div class="col-md-3">
                            <input type="radio" name="PaymentFormEdit" id="PaymentPostOfficeTransferEdit" value="1" class="k-radio" #= (data.PaymentForm == 1) ? checked='checked' : '' #>
                            <label class="k-radio-label" for="PaymentPostOfficeTransferEdit">przekaz pocztowy</label>
                        </div>
                    </li>

                    <li class="row">
                        <div class="col-md-4">
                            <label for="simple-input">Numer konta</label>
                            <input name="AccountNumberEdit" id="AccountNumberEdit" type="text" class="k-input k-textbox" required
                                   validationMessage="To pole jest wymagane." style="width: 100%;" value="#= (data.AccountNumber != null) ? data.AccountNumber : '' #" />
                        </div>
                        <div class="col-md-3">
                            <label for="simple-input">Imię</label>
                            <input name="CustomerFirstNameEdit" id="CustomerFirstName" type="text" class="k-input k-textbox" value="#= (data.CustomerFirstName != null) ? data.CustomerFirstName : '' #" style="width: 100%;"/>
                        </div>
                        <div class="col-md-5">
                            <label for="simple-input">Nazwisko/Firma</label>
                            <input name="CustomerLastNameEdit" id="CustomerLastName" type="text" class="k-input k-textbox" value="#= (data.CustomerLastName != null) ? data.CustomerLastName : '' #" style="width: 100%;"/>
                        </div>
                    </li>
                    <li class="row">
                        <div class="col-md-4">
                            <label for="simple-input">Ulica</label>
                            <input name="CustomerStreetEdit" id="CustomerStreet" type="text" class="k-input k-textbox" value="#= (data.CustomerStreet != null) ? data.CustomerStreet : '' #" style="width: 100%;"/>
                        </div>
                        <div class="col-md-2">
                            <label for="simple-input">Nr domu/mieszkania</label>
                            <input name="CustomerHomeNumberEdit" id="CustomerHomeNumber" type="text" class="k-input k-textbox" value="#= (data.CustomerStreetNumber != null) ? data.CustomerStreetNumber : '' #" style="width: 100%;"/>
                        </div>
                        <div class="col-md-2">
                            <label for="simple-input">Kod pocztowy</label>
                            <input name="CustomerPostCodeEdit" id="CustomerPostCode" type="text" class="k-input k-textbox"
                                   pattern="\d{2}-\d{3}" value="#= (data.CustomerPostCode != null) ? data.CustomerPostCode : '' #" style="width: 100%;"/>
                        </div>
                        <div class="col-md-4">
                            <label for="simple-input">Miejscowość</label>
                            <input name="CustomerCityEdit" id="CustomerCity" type="text" class="k-input k-textbox" value="#= (data.CustomerCity != null) ? data.CustomerCity : '' #" style="width: 100%;"/>
                        </div>
                    </li>
                </div>
            </ul>
            <a role="button" id="update" class="k-button k-button-icontext k-primary k-grid-update updateContract" href="\#">Przejdź dalej</a>
        </div>
        <div>
            <ul class="fieldlist">
                <div class="card">
                    <label for="simple-input" class="big_label" style="width: 100%; float: left;">Dane przedstawiciela oraz umowy</label>

                    <li class="row">
                        <div class="col-md-4">
                            <label for="simple-input">Prowizja</label>
                            <input name="CommissionEdit" id="Commission" type="text" class="k-input k-textbox" value="#= (data.Commision != null) ? data.Commision : '' #" style="width: 100%;"/>
                        </div>
                        <div class="col-md-4">
                            <label for="simple-input">Kod jednostki</label>
                            <input name="UnitCodeEdit" id="UnitCode" type="text" class="k-input k-textbox" value="#= (data.Unit != null) ? data.Unit : '' #" style="width: 100%;"/>
                        </div>
                        <div class="col-md-4">
                            <label for="simple-input">Kod konsultanta</label>
                            <input name="ConsultantCodeEdit" id="ConsultantCode" type="text" class="k-input k-textbox" value="#= (data.Consultant != null) ? data.Consultant : '' #" style="width: 100%;"/>
                        </div>
                    </li>
                </div>
            </ul>
            <a role="button" id="update" class="k-button k-button-icontext k-primary k-grid-update updateContract" href="\#">Zapisz</a>
        </div>
    </div>
    <script>

        // INSURER //
        var insurer = new kendo.data.DataSource({
            transport: {
                read: {
                    type: "POST",
                    url: API_URL + "bona/get_insurer",
                    dataType: "json"
                }
            }
        });
        $("\#InsurerIEdit").kendoDropDownList({
            dataTextField: "name",
            dataValueField: "id",
            dataSource: insurer,
            optionLabel: 'Wybierz',
            filter: "contains",
            valuePrimitive: true
        });
        $("\#InsurerIIEdit").kendoDropDownList({
            dataTextField: "name",
            dataValueField: "id",
            dataSource: insurer,
            optionLabel: 'Wybierz',
            filter: "contains",
            valuePrimitive: true
        });
        $("\#InsurerIIIEdit").kendoDropDownList({
            dataTextField: "name",
            dataValueField: "id",
            dataSource: insurer,
            optionLabel: 'Wybierz',
            filter: "contains",
            valuePrimitive: true
        });

        $("\#tabstrip_bona_edit").kendoTabStrip({
            animation:  {
                open: {
                    effects: "fadeIn"
                }
            }
        });

        $("\#panelbar_bona_edit").kendoPanelBar({
            expandMode: "single"
        });

        $('\#IncidentDateEdit').kendoDateTimePicker({})
        $('\#NotificationDateEdit').kendoDatePicker({})
        $('\#OtherAgentContractDateEdit').kendoDatePicker({})
        $('\#TerminateDateEdit').kendoDatePicker({})

        $('\#clear-data').on('click', function(){
            $('\#tabstrip_bona_edit').find('input').val('');
        });

        $('\#copy-first-address').on('click', function(){
            $('\#StreetIIEdit').val($('\#StreetIEdit').val());
            $('\#HomeNumberIIEdit').val($('\#HomeNumberIEdit').val());
            $('\#PostCodeIIEdit').val($('\#PostCodeIEdit').val());
            $('\#CityIIEdit').val($('\#CityIEdit').val());
        });
        $('\#copy-second-address').on('click', function(){
            $('\#StreetIIEdit').val($('\#StreetEdit').val());
            $('\#HomeNumberIIEdit').val($('\#HomeNumberEdit').val());
            $('\#PostCodeIIEdit').val($('\#PostCodeEdit').val());
            $('\#CityIIEdit').val($('\#CityEdit').val());
        });


        $('\#ConsumerFirstEdit').on('click', function(){

            var radioButtons = document.getElementsByName('Consumer')
            for (var x = 0; x < radioButtons.length; x++) {
                if (radioButtons[x].checked) {
                    $('\#CustomerFirstName').val($('\#FirstNameI').val());
                    $('\#CustomerLastName').val($('\#LastNameI').val());
                    $('\#CustomerStreet').val($('\#StreetI').val());
                    $('\#CustomerHomeNumber').val($('\#HomeNumberI').val());
                    $('\#CustomerPostCode').val($('\#PostCodeI').val());
                    $('\#CustomerCity').val($('\#CityI').val());
                }
            }
        });

        $('\#ConsumerSecondEdit').on('click', function(){
            var radioButtons = document.getElementsByName('ConsumerEdit')

            for (var x = 0; x < radioButtons.length; x++) {
                if (radioButtons[x].checked) {
                    $('\#CustomerFirstName').val($('\#FirstNameII').val());
                    $('\#CustomerLastName').val($('\#LastNameII').val());
                    $('\#CustomerStreet').val($('\#StreetII').val());
                    $('\#CustomerHomeNumber').val($('\#HomeNumberII').val());
                    $('\#CustomerPostCode').val($('\#PostCodeII').val());
                    $('\#CustomerCity').val($('\#CityII').val());
                }
            }
        });

        $('\#PaymentTransferEdit').on('click', function(){
            var radioButtons = document.getElementsByName('PaymentFormEdit')

            for (var x = 0; x < radioButtons.length; x++) {
                if (radioButtons[x].checked) {
                    $('\#AccountNumberEdit').attr("required", true);
                    $('\#AccountNumberEdit').attr("disabled", false);
                }
            }
        });

        $('\#PaymentPostOfficeTransferEdit').on('click', function(){
            var radioButtons = document.getElementsByName('PaymentFormEdit')

            for (var x = 0; x < radioButtons.length; x++) {
                if (radioButtons[x].checked) {
                    $('\#AccountNumberEdit').attr("required", false);
                    $('\#AccountNumberEdit').val("");
                    $('\#AccountNumberEdit').attr("disabled", true);
                }
            }
        });


        function getCheckedRadio (name) {
            var radioButtons = document.getElementsByName(name)
            for (var x = 0; x < radioButtons.length; x++) {
                if (radioButtons[x].checked) {
                    return radioButtons[x].value
                }
            }
        }

        function getCheckedCheckbox (name) {
            if (document.getElementsByName(name)[0].checked) {
                return '1'
            }
            else {
                return '0'
            }
        }


        $("[name='ConsumerEdit']").click(function(){
            if ($(this).attr('checkstate') == 'true')
            {
                $(this).attr('checked', false);
                $(this).attr('checkstate', 'false');
            }
            else
            {
                $(this).attr('checked', true);
                $(this).attr('checkstate', 'true');
            }

        });

        $('\#AssignmentYesEdit').on('click', function(){
            $('\#AssignmentValueEdit').removeAttr("disabled");
        });
        $('\#AssignmentNoEdit').on('click', function(){
            $('\#AssignmentValueEdit').val("");
            $('\#AssignmentValueEdit').attr("disabled", true);
        });

        $('\#NotificationYesEdit').on('click', function(){
            $("\#NotificationDateEdit").data("kendoDatePicker").enable(true);
        });
        $('\#NotificationNoEdit').on('click', function(){
            $('\#NotificationDateEdit').val("");
            $("\#NotificationDateEdit").data("kendoDatePicker").enable(false);
        });

        $('\#TerminateEdit').on('click', function(){
            if (($("\#TerminateEdit").is(':checked'))) {
                $("\#TerminateDateEdit").data("kendoDatePicker").enable(true);
            } else {
                $('\#TerminateDateEdit').val("");
                $("\#TerminateDateEdit").data("kendoDatePicker").enable(false);
            }
        });

        $('\#OtherAgentYesEdit').on('click', function(){
            $("\#OtherAgentContractDateEdit").data("kendoDatePicker").enable(true);
            $('\#OtherAgentNameEdit').removeAttr("disabled");
        });
        $('\#OtherAgentNoEdit').on('click', function(){
            $('\#OtherAgentNameEdit').val("");
            $('\#OtherAgentNameEdit').attr("disabled", true);
            $('\#OtherAgentContractDateEdit').val("");
            $("\#OtherAgentContractDateEdit").data("kendoDatePicker").enable(false);
        });

        $('\#PaidOutYesEdit').on('click', function(){
            $('\#AnountPaidOutEdit').removeAttr("disabled");
            $('\#DamageNumberEdit').removeAttr("disabled");
        });
        $('\#PaidOutNoEdit').on('click', function(){
            $('\#AnountPaidOutEdit').val("");
            $('\#AnountPaidOutEdit').attr("disabled", true);
            $('\#DamageNumberEdit').attr("disabled", true);
        });

        $(".answerEdit").children().change(function(){
            $(this).parent().parent().children(":first").children(":first").addClass('k-i-edit');
            $(this).parent().parent().children(":first").children(":first").addClass('k-i-check');
            mainPanel.odswierzSesje();
        });

        $('\#editContractBona').on('click', function(e){

            $.ajax({
                url: API_URL+"bona/editcontract",
                type: 'POST',
                dataType: "json",
                data: {
                    'ContractID': $('\#tabstrip_bona_edit').data('contract_bona_id'),
                    'AgentNumber': user,
                    'FirstNameI': document.getElementsByName('FirstNameIEdit')[0].value,
                    'LastNameI': document.getElementsByName('LastNameIEdit')[0].value,
                    'PESELI': document.getElementsByName('PESELIEdit')[0].value,
                    'IdentityCardI': document.getElementsByName('IdentityCardIEdit')[0].value,
                    'PhoneI': document.getElementsByName('PhoneIEdit')[0].value,
                    'EmailI': document.getElementsByName('EmailIEdit')[0].value,
                    'NIPI': document.getElementsByName('NIPIEdit')[0].value,
                    'REGONI': document.getElementsByName('REGONIEdit')[0].value,
                    'KRSI': document.getElementsByName('KRSIEdit')[0].value,
                    'StreetI': document.getElementsByName('StreetIEdit')[0].value,
                    'HomeNumberI': document.getElementsByName('HomeNumberIEdit')[0].value,
                    'PostCodeI': document.getElementsByName('PostCodeIEdit')[0].value,
                    'CityI': document.getElementsByName('CityIEdit')[0].value,

                    'Street': document.getElementsByName('StreetEdit')[0].value,
                    'HomeNumber': document.getElementsByName('HomeNumberEdit')[0].value,
                    'PostCode': document.getElementsByName('PostCodeEdit')[0].value,
                    'City': document.getElementsByName('CityEdit')[0].value,


                    'FirstNameII': document.getElementsByName('FirstNameIIEdit')[0].value,
                    'LastNameII': document.getElementsByName('LastNameIIEdit')[0].value,
                    'PESELII': document.getElementsByName('PESELIIEdit')[0].value,
                    'IdentityCardII': document.getElementsByName('IdentityCardIIEdit')[0].value,
                    'PhoneII': document.getElementsByName('PhoneIIEdit')[0].value,
                    'EmailII': document.getElementsByName('EmailIIEdit')[0].value,
                    'StreetII': document.getElementsByName('StreetIIEdit')[0].value,
                    'HomeNumberII': document.getElementsByName('HomeNumberIIEdit')[0].value,
                    'PostCodeII': document.getElementsByName('PostCodeIIEdit')[0].value,
                    'CityII': document.getElementsByName('CityIIEdit')[0].value,

                    'PhoneFirstName': document.getElementsByName('PhoneFirstNameEdit')[0].value,
                    'PhoneLastName': document.getElementsByName('PhoneLastNameEdit')[0].value,
                    'PhonePESEL': document.getElementsByName('PhonePESELEdit')[0].value,

                    'IncidentDate': document.getElementsByName('IncidentDateEdit')[0].value,
                    'Reason': document.getElementsByName('ReasonEdit')[0].value,
                    'Discription': document.getElementsByName('DiscriptionEdit')[0].value,

                    'InsurerI': document.getElementsByName('InsurerIEdit')[0].value,
                    'PolicyNameI': document.getElementsByName('PolicyNameIEdit')[0].value,
                    'PolicyNumberI': document.getElementsByName('PolicyNumberIEdit')[0].value,
                    'InsurerII': document.getElementsByName('InsurerIIEdit')[0].value,
                    'PolicyNameII': document.getElementsByName('PolicyNameIIEdit')[0].value,
                    'PolicyNumberII': document.getElementsByName('PolicyNumberIIEdit')[0].value,
                    'InsurerIII': document.getElementsByName('InsurerIIIEdit')[0].value,
                    'PolicyNameIII': document.getElementsByName('PolicyNameIIIEdit')[0].value,
                    'PolicyNumberIII': document.getElementsByName('PolicyNumberIIIEdit')[0].value,

                    'VAT': getCheckedCheckbox('VATEdit'),
                    'Company': getCheckedCheckbox('CompanyEdit'),

                    'NotificationDate': document.getElementsByName('NotificationDateEdit')[0].value,
                    'AnountPaidOut': document.getElementsByName('AnountPaidOutEdit')[0].value,
                    'DamageNumber': document.getElementsByName('DamageNumberEdit')[0].value,

                    'AssignmentValue': document.getElementsByName('AssignmentValueEdit')[0].value,

                    'OtherAgentName': document.getElementsByName('OtherAgentNameEdit')[0].value,
                    'OtherAgentContractDate': document.getElementsByName('OtherAgentContractDateEdit')[0].value,

                    'Terminate': getCheckedCheckbox('TerminateEdit'),
                    'TerminateDate': document.getElementsByName('TerminateDateEdit')[0].value,
                    'PageValue': document.getElementsByName('PageValueEdit')[0].value,

                    'ConsentSMS': getCheckedCheckbox('ConsentSMSEdit'),
                    'ConsentEmail': getCheckedCheckbox('ConsentEmailEdit'),

                    'dataConsentDSA': getCheckedCheckbox('dataConsentDSAEdit'),
                    'dataConsentPCRF': getCheckedCheckbox('dataConsentPCRFEdit'),
                    'dataConsentVOTUM': getCheckedCheckbox('dataConsentVOTUMEdit'),
                    'dataConsentAUTOVOTUM': getCheckedCheckbox('dataConsentAUTOVOTUMEdit'),
                    'dataConsentBEP': getCheckedCheckbox('dataConsentBEPEdit'),
                    'marketingConsentDSA1': getCheckedCheckbox('marketingConsentDSA1Edit'),
                    'marketingConsentDSA2': getCheckedCheckbox('marketingConsentDSA2Edit'),
                    'marketingConsentVOTUM1': getCheckedCheckbox('marketingConsentVOTUM1Edit'),
                    'marketingConsentVOTUM2': getCheckedCheckbox('marketingConsentVOTUM2Edit'),

                    'AccountNumber': document.getElementsByName('AccountNumberEdit')[0].value,
                    'CustomerFirstName': document.getElementsByName('CustomerFirstNameEdit')[0].value,
                    'CustomerLastName': document.getElementsByName('CustomerLastNameEdit')[0].value,
                    'CustomerStreet': document.getElementsByName('CustomerStreetEdit')[0].value,
                    'CustomerHomeNumber': document.getElementsByName('CustomerHomeNumberEdit')[0].value,
                    'CustomerPostCode': document.getElementsByName('CustomerPostCodeEdit')[0].value,
                    'CustomerCity': document.getElementsByName('CustomerCityEdit')[0].value,

                    'Answer1': document.getElementsByName('Answer1Edit')[0].value,
                    'Answer2': document.getElementsByName('Answer2Edit')[0].value,
                    'Answer3': document.getElementsByName('Answer3Edit')[0].value,
                    'Answer4': document.getElementsByName('Answer4Edit')[0].value,
                    'Answer5': document.getElementsByName('Answer5Edit')[0].value,
                    'Answer6': document.getElementsByName('Answer6Edit')[0].value,
                    'Answer7': document.getElementsByName('Answer7Edit')[0].value,
                    'Answer8': document.getElementsByName('Answer8Edit')[0].value,
                    'Answer9': document.getElementsByName('Answer9Edit')[0].value,

                    'Commission': document.getElementsByName('CommissionEdit')[0].value,
                    'UnitCode': document.getElementsByName('UnitCodeEdit')[0].value,
                    'ConsultantCode': document.getElementsByName('ConsultantCodeEdit')[0].value,

                    'PaymentForm': getCheckedRadio('PaymentFormEdit'),
                    'Assignment': getCheckedRadio('AssignmentEdit'),
                    'Notification': getCheckedRadio('NotificationEdit'),
                    'OtherAgent': getCheckedRadio('OtherAgentEdit'),
                    'PaidOut': getCheckedRadio('PaidOutEdit'),

                }
            }).success  (function (result){

            });

        });


    <\/script>
</script>