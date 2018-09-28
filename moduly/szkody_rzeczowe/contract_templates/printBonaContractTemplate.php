<script id="printBonaContractTemplate" type="text/x-kendo-template">

    <button class="export-pdf printContractBona" data-role="button" data-icon="print" data-bind="visible: isVisible, enabled: isEnabled, events: { click: onClick }" style="width: 100%;">Drukuj</button>

    <div class="printWindow">

        <?php
        $order_number = 'PG-2-18-F3/2018-05-24';
        $contract_number = 'PG-2-18-F1/2018-05-24';
        $aggreement_layout_number = 'PG-2-18-F7/2018-05-24';
        $enablement_votum_layout_number = 'PG-2-18-F4/2018-05-24';
        $instruction_client = 'PG-2-14-F5/2018-05-24';
        $instruction_votum = 'PG-2-14-F4/2018-05-24';
        ?>

        <div class="pdf_strona size-a4 pdf-page">
            <div class="row margin_width" style="padding-top: 30px; padding-bottom: 10px;">
                <div class="logo_left">
                    <img src="<?php echo 'https://' . $_SERVER ['HTTP_HOST']; ?>/img/laur_small.png" />
                </div>
                <div class="logo_right">
                    <img src="<?php echo 'https://' . $_SERVER ['HTTP_HOST']; ?>/img/logo_small.png" />
                </div>
            </div>
            <div class="row margin_width">
                <div class="col-4">
                    <div class="row" style="margin-bottom: 5px;">
                        <div class="box" style="width: 100%;font-size: 10px; padding-top: 5px; padding-left:2px;">#= data.AgentNumber #</div>
                        <span class="under_small_label">identyfikator przedstawiciela</span>
                    </div>
                    <div class="row" style="margin-bottom: 0px;">
                        <div class="box" style="width: 100%;font-size: 10px; padding-top: 5px; padding-left:2px;">#= data.Unit #</div>
                        <span class="under_small_label">kod jednostki</span>
                    </div>
                </div>
                <div class="col-4">
                    <div class="row" style="padding: 0px 10px 0px 10px; margin-bottom: 0px;">
                        <div class="big_box" style="width: 100%;font-size: 10px; padding-top: 5px; padding-left:2px;"></div>
                        <span class="under_small_label">podpis przedstawiciela</span>
                    </div>
                </div>
                <div class="col-4">
                    <div class="row" style="padding: 0px 10px 0px 0px; margin-bottom: 0px;">
                        <div class="big_box" style="width: 100%;font-size: 14px; text-align:center; padding-top: 15px; color: \#CCC; font-family: 'Museo_700';">DATA</br> WPŁYWU</div>
                        <span class="under_small_label"><i class="far fa-square" style="background-color: \#FFF;"></i> skany wysłane na: </br> dokumenty@votum-sa.pl</span>
                    </div>
                </div>
            </div>
            <div class="row margin_width">
                <div class="col-4">
                    <div class="row" style="margin-bottom: 5px;">
                        <div class="box" style="width: 100%;font-size: 10px; padding-top: 5px; padding-left:2px;">#= data.Consultant #</div>
                        <span class="under_small_label">kod konsultanta</span>
                    </div>
                </div>
                <div class="col-4">
                    <div class="row" style="padding: 0px 10px 0px 10px; margin-bottom: 5px;">
                        <div class="box" style="width: 100%;font-size: 10px; padding-top: 2px; padding-left:2px;"></div>
                        <span class="under_small_label">nr sprawy</span>
                    </div>
                </div>
            </div>
            <span class="row contract_name"><p>ZGŁOSZENIE SZKODY NA MIENIU / ZAMÓWIENIE</p></span>
            <div class="row justify-content-center" style="padding-bottom: 0.5em;padding-top: 0em; margin-left: 0px; margin-right:0px;font-size:8px;">na podstawie zamówienia z dnia #= (data.AddDate != null) ? data.AddDate : '' # r. złożonego przez: </div>
            <div class="form_section_client">
                <div class="red_margin"></div>
                <div class="form_section_body">
                    <div class="body_form">
                        <div class="form_grey_body">
                            <div class="row" style="margin-left: 0px; margin-right:0px;">
                                <div class="label_contract" style="width: 100%; font-family: 'Museo_700'; font-weight: 700px;">Zleceniodawca:</div>
                            </div>
                            <div class="row" style="padding-bottom: 0.5em; margin-left: 0px; margin-right:0px;">
                                <div class="col-6 padding_column">
                                    <input name="FirstNameIPrint" type="text" class="k-input k-textbox" value="#= (data.FirstNameI != null) ? data.FirstNameI : '' #"/>
                                    <span class="under_small_label">imię</span>
                                </div>
                                <div class="col-6 padding_column">
                                    <input name="LastName1Print" type="text" class="k-input k-textbox" value="#= (data.LastNameI != null) ? data.LastNameI : '' #"/>
                                    <span class="under_small_label">nazwisko</span>
                                </div>
                            </div>
                            <div class="row" style="padding-bottom: 0.5em; margin-left: 0px; margin-right:0px;">
                                <span class="under_small_label" style="text-align: left;padding-left:10px;">adres zameldowania zleceniodawcy</span>
                                <div class="col-4 padding_column">
                                    <input name="StreetI" type="text" class="k-input k-textbox" value="#= (data.StreetI != null) ? data.StreetI : '' #"/>
                                    <span class="under_small_label">ulica</span>
                                </div>
                                <div class="col-3 padding_column">
                                    <input name="HomeNumberI" type="text" class="k-input k-textbox" value="#= (data.HomeI != null) ? data.HomeI : '' #"/>
                                    <span class="under_small_label">nr domu / mieszkania</span>
                                </div>
                                <div class="col-2 padding_column">
                                    <input name="PostCodeI" type="text" class="k-input k-textbox" value="#= (data.PostCodeI != null) ? data.PostCodeI : '' #"/>
                                    <span class="under_small_label">kod pocztowy</span>
                                </div>
                                <div class="col-3 padding_column">
                                    <input name="CityI" type="text" class="k-input k-textbox" value="#= (data.CityI != null) ? data.CityI : '' #"/>
                                    <span class="under_small_label">miejscowość</span>
                                </div>
                            </div>
                            <div class="row" style="padding-bottom: 0.5em; margin-left: 0px; margin-right:0px;">
                                <span class="under_small_label" style="text-align: left;padding-left:10px;">adres korespondencyjny (jeśli jest inny niż zameldowania)</span>
                                <div class="col-4 padding_column">
                                    <input name="StreetI" type="text" class="k-input k-textbox" value="#= (data.Street != null) ? data.Street : '' #"/>
                                    <span class="under_small_label">ulica</span>
                                </div>
                                <div class="col-3 padding_column">
                                    <input name="HomeNumberI" type="text" class="k-input k-textbox" value="#= (data.Home != null) ? data.Home : '' #"/>
                                    <span class="under_small_label">nr domu / mieszkania</span>
                                </div>
                                <div class="col-2 padding_column">
                                    <input name="PostCodeI" type="text" class="k-input k-textbox" value="#= (data.PostCode != null) ? data.PostCode : '' #"/>
                                    <span class="under_small_label">kod pocztowy</span>
                                </div>
                                <div class="col-3 padding_column">
                                    <input name="CityI" type="text" class="k-input k-textbox" value="#= (data.City != null) ? data.City : '' #"/>
                                    <span class="under_small_label">miejscowość</span>
                                </div>
                            </div>
                            <div class="row" style="padding-bottom: 0.5em; margin-left: 0px; margin-right:0px;">
                                <div class="col-4 padding_column">
                                    <input name="PESELI" type="text" class="k-input k-textbox" value="#= (data.PESELI != null) ? data.PESELI : '' #"/>
                                    <span class="under_small_label">PESEL</span>
                                </div>
                                <div class="col-4 padding_column">
                                    <input name="IdentityCardI" type="text" class="k-input k-textbox" value="#= (data.IdNrI != null) ? data.IdNrI : '' #"/>
                                    <span class="under_small_label">seria i numer dowodu osobistego</span>
                                </div>
                                <div class="col-4 padding_column">
                                    <input name="PhoneI" type="text" class="k-input k-textbox" value="#= (data.PhoneI != null) ? data.PhoneI : '' #"/>
                                    <span class="under_small_label">telefon</span>
                                </div>
                            </div>
                            <div class="row" style="padding-bottom: 0.5em; margin-left: 0px; margin-right:0px;">
                                <div class="col-7 padding_column">
                                    <input name="EmailI" type="text" class="k-input k-textbox" value="#= (data.EmailI != null) ? data.EmailI : '' #"/>
                                    <span class="under_small_label">e-mail</span>
                                </div>
                                <div class="col-5 padding_column">
                                    <input name="NIP1" type="text" class="k-input k-textbox" value="#= (data.NIPI != null) ? data.NIPI : '' #"/>
                                    <span class="under_small_label">NIP</span>
                                </div>
                            </div>
                            <div class="row" style="padding-bottom: 0.5em; margin-left: 0px; margin-right:0px;">
                                <div class="col-5 padding_column">
                                    <input name="KRS1" type="text" class="k-input k-textbox" value="#= (data.KRSI != null) ? data.KRSI : '' #"/>
                                    <span class="under_small_label">KRS</span>
                                </div>
                                <div class="col-5 padding_column">
                                    <input name="REGON1" type="text" class="k-input k-textbox" value="#= (data.REGONI != null) ? data.REGONI : '' #"/>
                                    <span class="under_small_label">REGON</span>
                                </div>
                            </div>
                            <div class="row justify-content-center" style="padding-bottom: 0.5em; margin-left: 0px; margin-right:0px;">
                                <div class="col-6 padding_column">
                                    <i class="#= (data.Company == 1) ? 'far fa-check-square' : 'far fa-square' #" style="background-color: \#FFF;"></i> Oświadczam, że prowadzę pozarolniczą działalność gospodarczą.
                                </div>
                                <div class="col-5 padding_column">
                                    <i class="#= (data.VAT == 1) ? 'far fa-check-square' : 'far fa-square' #" style="background-color: \#FFF;"></i> Oświadczam, że jestem płatnikiem podatku VAT.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="red_margin"></div>
            </div>
            <div class="margin_10"></div>
            <div class="form_section_phone">
                <div class="red_margin"></div>
                <div class="form_section_body">
                    <div class="body_form">
                        <div class="form_grey_body">
                            <div class="row" style="margin-left: 0px; margin-right:0px;">
                                <div class="label_contract" style="width: 100%; font-family: 'Museo_700';">Uprawniony do uzyskania informacji telefonicznej:</div>
                            </div>
                            <div class="row" style="padding-bottom: 0.5em; margin-left: 0px; margin-right:0px;">
                                <div class="col-4 padding_column">
                                    <input name="FirstNameI" type="text" class="k-input k-textbox" value="#= (data.FirstName != null) ? data.FirstName : '' #"/>
                                    <span class="under_small_label">imię</span>
                                </div>
                                <div class="col-4 padding_column">
                                    <input name="LastName1" type="text" class="k-input k-textbox" value="#= (data.LastName != null) ? data.LastName : '' #"/>
                                    <span class="under_small_label">nazwisko</span>
                                </div>
                                <div class="col-4 padding_column">
                                    <input name="LastName1" type="text" class="k-input k-textbox" value="#= (data.PESEL != null) ? data.PESEL : '' #"/>
                                    <span class="under_small_label">PESEL</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="red_margin"></div>
            </div>
            <div class="margin_10"></div>
            <div class="row justify-content-center" style="width: 100%; margin: 0px; padding-top: 6px;height: 20px; background-color: \#CC0000; color: \#FFF;  font-family: 'Museo_700'; font-size: 10px;'">
                INFORMACJE O ZDARZENIU Z DNIA: #= (data.IncidentDate != null) ? data.IncidentDate : '' #
            </div>
            <div class="row" style="margin-left: 0px; margin-right:0px;font-size:9px;">
                <div class="text_label_contract" style="width: 100%;font-family: 'Museo_300';"><span style="font-family: 'Museo_700';">Przyczyna powstania szkody</span> (np. powódź, podtopienie, silny wiatr, pożar, przymrozek, kolizja drogowa, itp.)</div>
                <div class="box" style="width: 100%;font-size: 12px; margin: 5px 20px 0px 20px;">#= (data.Reason != null) ? data.Reason : '' #</div>
            </div>
            <div class="row" style="margin-left: 0px; margin-right:0px;font-size:9px;">
                <div class="text_label_contract" style="width: 100%;font-family: 'Museo_300';"><span style="font-family: 'Museo_700';">Opis powstałych szkód</span> - dokładna lokalizacja przedmiotu szkody</div>
                <div class="damage_big_box" style="width: 100%;font-size: 12px; margin: 5px 20px 0px 20px;">#= (data.Description != null) ? data.Description : '' #</div>
            </div>
            <div class="number_site_text">
                <div class="row justify-content-center" style="width: 100%; margin: 0px;">1/3</div>
            </div>
            <div class="print_text"><?php echo $order_number; ?></div>
        </div>

        <div class="pdf_strona size-a4 pdf-page new-page">
            <div class="row margin_width" style="padding-top: 30px; padding-bottom: 10px;">
                <div class="logo_left">
                    <img src="<?php echo 'https://' . $_SERVER ['HTTP_HOST']; ?>/img/laur_small.png" />
                </div>
                <div class="logo_right">
                    <img src="<?php echo 'https://' . $_SERVER ['HTTP_HOST']; ?>/img/logo_small.png" />
                </div>
            </div>

            <div class="form_section_insurer">
                <div class="red_margin"></div>
                <div class="form_section_body">
                    <div class="body_form">
                        <div class="form_grey_body">
                            <div class="row" style="margin-left: 0px; margin-right:0px;">
                                <div class="label_contract" style="width: 100%; font-family: 'Museo_700';">Posiadane polisy ubezpieczenia mienia:</div>
                            </div>
                            <span class="under_small_label" style="text-align: left;padding-left:10px;">
                            <div class="row" style=" margin-left: 0px; margin-right:0px;font-size:9px;">
                            <div class="col-1 padding_column">
                            </div>
                            <div class="col-4 padding_column">
                                Zakład ubezpieczeń
                            </div>
                            <div class="col-4 padding_column">
                                Nazwa polisy
                            </div>
                            <div class="col-3 padding_column">
                                Numer polisy
                            </div>
                        </div>
                        </span>
                            <div class="row" style="margin-left: 0px; margin-right:0px;">
                                <div class="col-1 padding_column">
                                    <span class="number"><p>1.</p></span>
                                </div>
                                <div class="col-4 padding_column">
                                    <input name="InsurerName1" type="text" class="k-input k-textbox" value="#= (data.InsurerName1 != null) ? data.InsurerName1 : '' #"/>
                                </div>
                                <div class="col-4 padding_column">
                                    <input name="PolicyName1" type="text" class="k-input k-textbox" value="#= (data.PolicyName1 != null) ? data.PolicyName1 : '' #"/>
                                </div>
                                <div class="col-3 padding_column">
                                    <input name="PolicyNumber1" type="text" class="k-input k-textbox" value="#= (data.PolicyNumber1 != null) ? data.PolicyNumber1 : '' #"/>
                                </div>
                            </div>
                            <div class="row" style="margin-left: 0px; margin-right:0px;">
                                <div class="col-1 padding_column">
                                    <span class="number"><p>2.</p></span>
                                </div>
                                <div class="col-4 padding_column">
                                    <input name="InsurerName2" type="text" class="k-input k-textbox" value="#= (data.InsurerName2 != null) ? data.InsurerName2 : '' #"/>
                                </div>
                                <div class="col-4 padding_column">
                                    <input name="PolicyName2" type="text" class="k-input k-textbox" value="#= (data.PolicyName2 != null) ? data.PolicyName2 : '' #"/>
                                </div>
                                <div class="col-3 padding_column">
                                    <input name="PolicyNumber2" type="text" class="k-input k-textbox" value="#= (data.PolicyNumber2 != null) ? data.PolicyNumber2 : '' #"/>
                                </div>
                            </div>
                            <div class="row" style="margin-left: 0px; margin-right:0px;">
                                <div class="col-1 padding_column">
                                    <span class="number"><p>3.</p></span>
                                </div>
                                <div class="col-4 padding_column">
                                    <input name="InsurerName3" type="text" class="k-input k-textbox" value="#= (data.InsurerName3 != null) ? data.InsurerName3 : '' #"/>
                                </div>
                                <div class="col-4 padding_column">
                                    <input name="PolicyName3" type="text" class="k-input k-textbox" value="#= (data.PolicyName3 != null) ? data.PolicyName3 : '' #"/>
                                </div>
                                <div class="col-3 padding_column">
                                    <input name="PolicyNumber3" type="text" class="k-input k-textbox" value="#= (data.PolicyNumber3 != null) ? data.PolicyNumber3 : '' #"/>
                                </div>
                            </div>
                            <div class="row" style="padding-bottom: 0.5em;padding-top: 0.5em; margin-left: 0px; margin-right:0px; font-size:9px;">
                                <div class="col padding_column">
                                    <i class="#= (data.Notification == 0) ? 'far fa-check-square' : 'far fa-square' #" style="background-color: \#FFF;"></i> nie zgłoszono szkody do zakładu ubezpieczeń /
                                    <i class="#= (data.Notification == 1) ? 'far fa-check-square' : 'far fa-square' #" style="background-color: \#FFF;"></i> zgłoszono szkodę do zakładu ubezpieczeń, data zgłoszenia: #= (data.NotificationDate != null) ? data.NotificationDate : '<span class="underline_black" style="width: 60px;"></span>' #
                                </div>
                            </div>
                            <div class="row" style="padding-bottom: 0.5em;padding-top: 0.5em; margin-left: 0px; margin-right:0px;font-size:9px;">
                                <div class="col padding_column">
                                    Odszkodowania:
                                    <i class="#= (data.PaidOut == 0) ? 'far fa-check-square' : 'far fa-square' #" style="background-color: \#FFF;"></i> nie wypłacono /
                                    <i class="#= (data.PaidOut == 1) ? 'far fa-check-square' : 'far fa-square' #" style="background-color: \#FFF;"></i> wypłacono w kwocie: #= (data.AnountPaidOut != '') ? data.AnountPaidOut : '<span class="underline_black" style="width: 60px;"></span>' # zł,
                                </div>
                            </div>
                            <div class="row" style="padding-bottom: 0.5em;padding-top: 0.5em; margin-left: 0px; margin-right:0px;font-size:9px;">
                                <div class="col padding_column">
                                    numer szkody nadany przez zakład ubezpieczeń #= (data.DamageNumber != '') ? data.DamageNumber : '<span class="underline_black" style="width: 80px;"></span>' #
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="red_margin"></div>
            </div>

            <div class="clear"></div>
            <div class="row" style="margin-left: 0px; margin-right:0px; margin-top: 30px;">
                <div class="col-4 padding_column"></div>
                <div class="col-4 padding_column"></div>
                <div class="col-4 padding_column">
                    <div class="row justify-content-center border_bottom" style="padding-bottom: 0.5em;padding-top: 0.5em; margin-left: 0px; margin-right:0px;font-size:9px;"></div>
                    <div class="row justify-content-center" style="padding-bottom: 0.5em;padding-top: 0.5em; margin-left: 0px; margin-right:0px;font-size:7px;">Podpis Zleceniodawcy</div>
                </div>
            </div>
            <div class="clear"></div>

            <div class="row" style="margin-left: 0px; margin-right:0px;font-size:9px;">
                <div class="text_label_contract" style="width: 100%;"><span style="font-family: 'Museo_700';">Informacje dotyczące szkody:</span></div>
            </div>

            <div class="row" style="margin-left: 0px; margin-right:0px;font-size:9px;">
                <div class="text_label_contract" style="width: 100%;">
                    1. Czy na miejscu zdarzenia były służby ratunkowe, policja, pogotowie? Jeśli tak, to jakie jednostki i z jakiej miejscowości?
                </div>
                <div class="text_label_contract" style="width: 100%;">
                    #= (data.Answer1 != '') ? data.Answer1 : '<div class="margin_10"></div><span class="underline" style="width: 100%;"></span><div class="margin_10"></div><div class="margin_10"></div><span class="underline" style="width: 100%;"></span></br></br>' #
                </div>
            </div>
            <div class="row" style="margin-left: 0px; margin-right:0px;font-size:9px;">
                <div class="text_label_contract" style="width: 100%;">
                    2. Jeżeli prowadzone jest lub było prowadzone postępowanie - jaka jest sygnatura akt; jaki jest jego obecny etap lub jak zakończyło się?
                </div>
                <div class="text_label_contract" style="width: 100%;">
                    #= (data.Answer2 != '') ? data.Answer2 : '<div class="margin_10"></div><span class="underline" style="width: 100%;"></span><div class="margin_10"></div><div class="margin_10"></div><span class="underline" style="width: 100%;"></span></br></br>' #
                </div>
            </div>
            <div class="row" style="margin-left: 0px; margin-right:0px;font-size:9px;">
                <div class="text_label_contract" style="width: 100%;">
                    3. Czy jest możliwe przeprowadzenie oględzin uszkodzonego mienia; jeśli nie jest to możliwe, to z jakiej przyczyny?
                </div>
                <div class="text_label_contract" style="width: 100%;">
                    #= (data.Answer3 != '') ? data.Answer3 : '<div class="margin_10"></div><span class="underline" style="width: 100%;"></span><div class="margin_10"></div><div class="margin_10"></div><span class="underline" style="width: 100%;"></span></br></br>' #
                </div>
            </div>
            <div class="row" style="margin-left: 0px; margin-right:0px;font-size:9px;">
                <div class="text_label_contract" style="width: 100%;">
                    4. Czy przedmiot szkody uległ całkowitemu zniszczeniu lub utracie; czy też możliwa jest jego odbudowa, naprawa lub odtworzenie?
                </div>
                <div class="text_label_contract" style="width: 100%;">
                    #= (data.Answer4 != '') ? data.Answer4 : '<div class="margin_10"></div><span class="underline" style="width: 100%;"></span><div class="margin_10"></div><div class="margin_10"></div><span class="underline" style="width: 100%;"></span></br></br>' #
                </div>
            </div>
            <div class="row" style="margin-left: 0px; margin-right:0px;font-size:9px;">
                <div class="text_label_contract" style="width: 100%;">
                    5. Czy dokonano odbudowy, naprawy lub odtworzenia uszkodzonego mienia?
                </div>
                <div class="text_label_contract" style="width: 100%;">
                    #= (data.Answer5 != '') ? data.Answer5 : '<div class="margin_10"></div><span class="underline" style="width: 100%;"></span><div class="margin_10"></div><div class="margin_10"></div><span class="underline" style="width: 100%;"></span></br></br>' #
                </div>
            </div>
            <div class="row" style="margin-left: 0px; margin-right:0px;font-size:9px;">
                <div class="text_label_contract" style="width: 100%;">
                    6. Jeżeli nie dokonano odbudowy, naprawy lub odtworzenia, to czy jest to planowane - jeśli tak, to w jakim terminie?
                </div>
                <div class="text_label_contract" style="width: 100%;">
                    #= (data.Answer6 != '') ? data.Answer6 : '<div class="margin_10"></div><span class="underline" style="width: 100%;"></span><div class="margin_10"></div><div class="margin_10"></div><span class="underline" style="width: 100%;"></span></br></br>' #
                </div>
            </div>
            <div class="row" style="margin-left: 0px; margin-right:0px;font-size:9px;">
                <div class="text_label_contract" style="width: 100%;">
                    7. Czy odbudowa, naprawa lub odtworzenie zostało wykonane bądź będzie wykonane za pośrednictwem wyspecjalizowanego podmiotu czy
                    też samodzielnie we własnym zakresie?
                </div>
                <div class="text_label_contract" style="width: 100%;">
                    #= (data.Answer7 != '') ? data.Answer7 : '<div class="margin_10"></div><span class="underline" style="width: 100%;"></span><div class="margin_10"></div><div class="margin_10"></div><span class="underline" style="width: 100%;"></span></br></br>' #
                </div>
            </div>

            <div class="number_site_text">
                <div class="row justify-content-center" style="width: 100%; margin: 0px;">2/3</div>
            </div>
            <div class="print_text"><?php echo $order_number; ?></div>
        </div>

        <div class="pdf_strona size-a4 pdf-page new-page">
            <div class="row margin_width" style="padding-top: 30px; padding-bottom: 10px;">
                <div class="logo_left">
                    <img src="<?php echo 'https://' . $_SERVER ['HTTP_HOST']; ?>/img/laur_small.png" />
                </div>
                <div class="logo_right">
                    <img src="<?php echo 'https://' . $_SERVER ['HTTP_HOST']; ?>/img/logo_small.png" />
                </div>
            </div>

            <div class="row" style="margin-left: 0px; margin-right:0px;font-size:9px;">
                <div class="text_label_contract" style="width: 100%;">
                    8. Jakimi dowodami dysponuje poszkodowany, które wskazują na rzeczywiste koszty odbudowy, naprawy lub odtworzenia (np. rachunki,
                    faktury, kosztorys, wycena, oferta naprawy/obudowy, ect.)
                </div>
                <div class="text_label_contract" style="width: 100%;">
                    #= (data.Answer8 != '') ? data.Answer8 : '<div class="margin_10"></div><span class="underline" style="width: 100%;"></span><div class="margin_10"></div><div class="margin_10"></div><span class="underline" style="width: 100%;"></span></br></br>' #
                </div>
            </div>
            <div class="row" style="margin-left: 0px; margin-right:0px;font-size:9px;">
                <div class="text_label_contract" style="width: 100%;">
                    9. Czy dokonana odbudowa, naprawa lub odtworzenie zostało wykonane przy zachowaniu dotychczasowych wymiarów, konstrukcji i materiałów
                    czy też dokonano zmian w odniesieniu do stanu nim szkoda wystąpiła?
                </div>
                <div class="text_label_contract" style="width: 100%;">
                    #= (data.Answer9 != '') ? data.Answer9 : '<div class="margin_10"></div><span class="underline" style="width: 100%;"></span><div class="margin_10"></div><div class="margin_10"></div><span class="underline" style="width: 100%;"></span></br></br>' #
                </div>
            </div>
            <div class="margin_10"></div>
            <div class="form_section_agreements">
                <div class="red_margin"></div>
                <div class="form_section_body">
                    <div class="body_form">
                        <div class="form_grey_body">
                            <div class="row" style="margin-left: 0px; margin-right:0px;">
                                <div class="label_contract" style="width: 100%; font-family: 'Museo_700';">Dochodzenie roszczeń</div>
                            </div>
                            <div class="row" style="padding-bottom: 0.5em;padding-top: 0.5em; margin-left: 0px; margin-right:0px; font-size:8px;">
                                <div class="col padding_column">
                                    <i class="#= (data.Assignment == 1) ? 'far fa-check-square' : 'far fa-square' #" style="background-color: \#FFF;"></i> TAK /
                                    <i class="#= (data.Assignment == 0) ? 'far fa-check-square' : 'far fa-square' #" style="background-color: \#FFF;"></i> NIE dokonano przeniesienia praw wynikających z umowy ubezpieczenia (cesja) #= (data.AssignmentValue != '') ? data.AssignmentValue : '<span class="underline_black" style="width: 100px;"></span>' #
                                </div>
                            </div>
                            <div class="row" style="padding-bottom: 0.5em;padding-top: 0.5em; margin-left: 0px; margin-right:0px; font-size:8px;">
                                <div class="col padding_column">
                                    <i class="#= (data.OtherAgent == 0) ? 'far fa-check-square' : 'far fa-square' #" style="background-color: \#FFF;"></i> Nie zlecano wcześniej dochodzenia roszczeń żadnemu podmiotowi.
                                </div>
                            </div>
                            <div class="row" style="padding-bottom: 0.5em;padding-top: 0.5em; margin-left: 0px; margin-right:0px; font-size:8px;">
                                <div class="col padding_column">
                                    <i class="#= (data.OtherAgent == 1) ? 'far fa-check-square' : 'far fa-square' #" style="background-color: \#FFF;"></i> Sprawę zlecono wcześniej pełnomocnikowi (nazwa) #= (data.OtherAgentName != '') ? data.OtherAgentName : '<span class="underline_black" style="width: 100px;"></span>' #
                                </div>
                            </div>
                            <div class="row" style="padding-bottom: 0.5em;padding-top: 0.5em; margin-left: 0px; margin-right:0px;font-size:8px;">
                                <div class="col padding_column">
                                    z którym zawarto umowę dnia #= (data.OtherAgentContractDate != null) ? data.OtherAgentContractDate : '<span class="underline_black" style="width: 80px;"></span>' #
                                </div>
                            </div>
                            <div class="row" style="padding-bottom: 0.5em;padding-top: 0.5em; margin-left: 0px; margin-right:0px; font-size:8px;">
                                <div class="col padding_column">
                                    <i class="#= (data.Terminate == 1) ? 'far fa-check-square' : 'far fa-square' #" style="background-color: \#FFF;"></i> Umowę z wyżej wymienionym wypowiedziano w dniu #= (data.TerminateDate != null) ? data.TerminateDate : '<span class="underline_black" style="width: 80px;"></span>' #
                                </div>
                            </div>
                            <div class="row" style="padding-bottom: 0.5em;padding-top: 0.5em; margin-left: 0px; margin-right:0px;font-size:8px;">
                                <div class="col padding_column">
                                    Przekazałem pełnomocnikowi Votum S.A. dokumentację składającą się z #= (data.PageValue != null) ? data.PageValue : '<span class="underline_black" style="width: 30px;">' # słownie #= (data.PageValue != null) ? data.PageValue : '<span class="underline_black" style="width: 100px;"></span>' # kart.
                                </div>
                            </div>
                            <div class="row" style="padding-bottom: 0.5em;padding-top: 0.5em; margin-left: 0px; margin-right:0px; font-size:8px;">
                                <div class="col padding_column">
                                    <i class="#= (data.ConsentSMS == 1 || data.ConsentEmail == 1) ? 'far fa-check-square' : 'far fa-square' #" style="background-color: \#FFF;"></i> Wyrażam zgodę na otrzymywanie informacji związanych z wykonywaniem umowy poprzez:
                                </div>
                            </div>
                            <div class="row" style="padding-bottom: 0.5em;padding-top: 0.5em; margin-left: 0px; margin-right:0px; font-size:8px;">
                                <div class="col padding_column">
                                    <i class="#= (data.ConsentSMS == 1) ? 'far fa-check-square' : 'far fa-square' #" style="background-color: \#FFF;"></i> wiadomości tekstowe SMS /
                                    <i class="#= (data.ConsentEmail == 1) ? 'far fa-check-square' : 'far fa-square' #" style="background-color: \#FFF;"></i> wiadomości e-mail na numer/adres przeze mnie wskazany.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="red_margin"></div>
            </div>

            <div class="row" style="margin-left: 0px; margin-right:0px; margin-top: 30px;">
                <div class="col-4 padding_column">
                    <div class="row justify-content-center border_bottom" style="padding-bottom: 0.5em;padding-top: 0.5em; margin-left: 0px; margin-right:0px;font-size:9px;"></div>
                    <div class="row justify-content-center" style="padding-bottom: 0.5em;padding-top: 0.5em; margin-left: 0px; margin-right:0px;font-size:7px;">Miejscowość i data</div>
                </div>
                <div class="col-4 padding_column"></div>
                <div class="col-4 padding_column">
                    <div class="row justify-content-center border_bottom" style="padding-bottom: 0.5em;padding-top: 0.5em; margin-left: 0px; margin-right:0px;font-size:9px;"></div>
                    <div class="row justify-content-center" style="padding-bottom: 0.5em;padding-top: 0.5em; margin-left: 0px; margin-right:0px;font-size:7px;">Podpis Zleceniodawcy</div>
                </div>
            </div>
            <div class="clear"></div>

            <div class="row" style="margin-left: 0px; margin-right:0px;font-size:9px;">
                <div class="text_label_contract" style="width: 100%;"><span style="font-family: 'Museo_700';">Oświadczenie</span></div>
                <div class="text_label_contract" style="width: 100%;">Ja niżej podpisany, jako pełnomocnik Zleceniobiorcy – VOTUM S.A., oświadczam, iż podpisy Zleceniodawcy na wszystkich dokumentach,
                    tj. na umowie, pełnomocnictwie oraz zgłoszeniu szkody, zostały złożone w mojej obecności własnoręcznie przez Zleceniodawcę.
                </div>
            </div>

            <div class="row" style="margin-left: 0px; margin-right:0px; margin-top: 30px;">
                <div class="col-6 padding_column">
                    <div class="row justify-content-center border_bottom" style="padding-bottom: 0.5em;padding-top: 0.5em; margin-left: 0px; margin-right:0px;font-size:9px;"></div>
                    <div class="row justify-content-center" style="padding-bottom: 0.5em;padding-top: 0.5em; margin-left: 0px; margin-right:0px;font-size:7px;">Imię i nazwisko przedstawiciela (wypełnić drukowanymi literami)</div>
                </div>
                <div class="col-2 padding_column"></div>
                <div class="col-4 padding_column">
                    <div class="row justify-content-center border_bottom" style="padding-bottom: 0.5em;padding-top: 0.5em; margin-left: 0px; margin-right:0px;font-size:9px;"></div>
                    <div class="row justify-content-center" style="padding-bottom: 0.5em;padding-top: 0.5em; margin-left: 0px; margin-right:0px;font-size:7px;">Podpis przedstawiciela</div>
                </div>
            </div>
            <div class="clear"></div>

            <div class="number_site_text">
                <div class="row justify-content-center" style="width: 100%; margin: 0px;">3/3</div>
            </div>
            <div class="print_text"><?php echo $order_number; ?></div>
        </div>

        <!--UMOWA-->

        <div class="pdf_strona size-a4 pdf-page new-page">
            <div class="row margin_width" style="padding-top: 30px; padding-bottom: 10px;">
                <div class="logo_left">
                    <img src="<?php echo 'https://' . $_SERVER ['HTTP_HOST']; ?>/img/laur_small.png" />
                </div>
                <div class="logo_right">
                    <img src="<?php echo 'https://' . $_SERVER ['HTTP_HOST']; ?>/img/logo_small.png" />
                </div>
            </div>

            <div class="row margin_width" style="margin-top: -50px;">
                <div class="col"></div>
                <div class="col-3">
                    <div class="row" style="margin-bottom: 5px;">
                        <div class="box" style="width: 100%;font-size: 12px; padding-top: 2px; padding-left: 2px;">#= data.AgentNumber #</div>
                        <span class="under_small_label">identyfikator przedstawiciela</span>
                    </div>
                </div>
                <div class="col"></div>
            </div>
            <div class="margin_10"></div>
            <span class="row contract_name"><p>UMOWA O DOCHODZENIE ROSZCZEŃ ODSZKODOWAWCZYCH „BONA”</p></span>
            <div class="row justify-content-center" style="padding-bottom: 0.5em;padding-top: 0em; margin-left: 0px; margin-right:0px;font-size:8px;">na podstawie zamówienia z dnia #= (data.AddDate != null) ? data.AddDate : '' # r. złożonego przez: </div>
            <div class="form_section_client" style="height:241px;">
                <div class="red_margin"></div>
                <div class="form_section_body">
                    <div class="body_form">
                        <div class="form_grey_body">
                            <div class="row" style="margin-left: 0px; margin-right:0px;">
                                <div class="label_contract" style="width: 100%; font-family: 'Museo_700';">Właściciel / Współwłaściciel:</div>
                            </div>
                            <div class="row" style="padding-bottom: 0em; margin-left: 0px; margin-right:0px;">
                                <div class="col-6 padding_column">
                                    <input name="FirstNameIPrint" type="text" class="k-input k-textbox" value="#= (data.FirstNameI != null) ? data.FirstNameI : '' #"/>
                                    <span class="under_small_label">imię</span>
                                </div>
                                <div class="col-6 padding_column">
                                    <input name="LastName1Print" type="text" class="k-input k-textbox" value="#= (data.LastNameI != null) ? data.LastNameI : '' #"/>
                                    <span class="under_small_label">nazwisko/firma</span>
                                </div>
                            </div>
                            <div class="row" style="padding-bottom: 0em; margin-left: 0px; margin-right:0px;">
                                <div class="col-4 padding_column">
                                    <input name="StreetI" type="text" class="k-input k-textbox" value="#= (data.StreetI != null) ? data.StreetI : '' #"/>
                                    <span class="under_small_label">ulica</span>
                                </div>
                                <div class="col-4 padding_column">
                                    <input name="HomeNumberI" type="text" class="k-input k-textbox" value="#= (data.HomeI != null) ? data.HomeI : '' #"/>
                                    <span class="under_small_label">nr domu / mieszkania</span>
                                </div>
                                <div class="col-4 padding_column">
                                    <input name="PostCodeI" type="text" class="k-input k-textbox" value="#= (data.PostCodeI != null) ? data.PostCodeI : '' #"/>
                                    <span class="under_small_label">kod pocztowy</span>
                                </div>
                            </div>
                            <div class="row" style="padding-bottom: 0em; margin-left: 0px; margin-right:0px;">
                                <div class="col-4 padding_column">
                                    <input name="CityI" type="text" class="k-input k-textbox" value="#= (data.CityI != null) ? data.CityI : '' #"/>
                                    <span class="under_small_label">miejscowość</span>
                                </div>
                                <div class="col-4 padding_column">
                                    <input name="PESELI" type="text" class="k-input k-textbox" value="#= (data.PESELI != null) ? data.PESELI : '' #"/>
                                    <span class="under_small_label">PESEL</span>
                                </div>
                                <div class="col-4 padding_column">
                                    <input name="IdentityCardI" type="text" class="k-input k-textbox" value="#= (data.IdNrI != null) ? data.IdNrI : '' #"/>
                                    <span class="under_small_label">seria i numer dowodu osobistego</span>
                                </div>
                            </div>
                            <div class="row" style="padding-bottom: 0em; margin-left: 0px; margin-right:0px;">
                                <div class="col-5 padding_column">
                                    <input name="PhoneI" type="text" class="k-input k-textbox" value="#= (data.PhoneI != null) ? data.PhoneI : '' #"/>
                                    <span class="under_small_label">telefon</span>
                                </div>
                                <div class="col-7 padding_column">
                                    <input name="EmailI" type="text" class="k-input k-textbox" value="#= (data.EmailI != null) ? data.EmailI : '' #"/>
                                    <span class="under_small_label">e-mail</span>
                                </div>
                            </div>
                            <div class="row" style="padding-bottom: 0em; margin-left: 0px; margin-right:0px;">
                                <div class="col-5 padding_column">
                                    <input name="NIP1" type="text" class="k-input k-textbox" value="#= (data.NIP1 != null) ? data.NIP1 : '' #"/>
                                    <span class="under_small_label">NIP</span>
                                </div>
                                <div class="col-7 padding_column">
                                    <input name="REGON1" type="text" class="k-input k-textbox" value="#= (data.REGONI != null) ? data.REGONI : '' #"/>
                                    <span class="under_small_label">REGON</span>
                                </div>
                            </div>
                            <div class="row" style="padding-bottom: 0em; margin-left: 0px; margin-right:0px;">
                                <div class="col-5 padding_column">
                                    <input name="KRS1" type="text" class="k-input k-textbox" value="#= (data.KRS1 != null) ? data.KRS1 : '' #"/>
                                    <span class="under_small_label">KRS</span>
                                </div>
                                <div class="col-7 padding_column">
                                    <input name="REGON1" type="text" class="k-input k-textbox" value="#= (data.REGONI != null) ? data.REGONI : '' #"/>
                                    <span class="under_small_label">reprezentowana(y) przez</span>
                                </div>
                            </div>
                            <div class="row" style="padding-bottom: 0.5em; margin-left: 0px; margin-right:0px;">
                                <div class="text_label_contract" style="width: 100%; padding-left: 10px; padding-right:10px; line-height:10px;">Należy wypełnić właściwe pola. W przypadku osób fizycznych: imię i nazwisko, adres, PESEL, seria i numer dowodu osobistego, w przypadku
                                    osób fizycznych prowadzących działalność gospodarczą: imię i nazwisko, firma, adres, NIP, REGON, w przypadku spółek prawa handlowego
                                    i innych podmiotów prowadzących działalność gospodarczą: firma, siedziba, adres, NIP, REGON, KRS oraz sposób reprezentacji, zgodny z KRS.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="red_margin"></div>
            </div>
            <div class="margin_10"></div>
            <div class="form_section_phone" style="height: 88px;">
                <div class="red_margin"></div>
                <div class="form_section_body" style="padding-bottom:8px;">
                    <div class="body_form">
                        <div class="form_grey_body">
                            <div class="text_label_contract" style="width: 100%; padding-left: 10px; padding-right:10px;line-height:10px;">zwanego dalej „Zleceniodawcą”,</div>
                            <div class="text_label_contract" style="width: 100%; padding-left: 10px; padding-right:10px;line-height:10px;">dla</div>
                            <div class="text_label_contract" style="width: 100%; padding-left: 10px; padding-right:10px;line-height:10px;">VOTUM S.A. z siedzibą we Wrocławiu; ul. Wyścigowa 56i, 53-012 Wrocław, tel. 71/33 93 400, faks: 71/33 93 403, e-mail: dok@votum-sa.pl, zarejestrowaną
                                w Sądzie Rejonowym dla Wrocławia Fabrycznej, VI Wydział Gospodarczy KRS, pod numerem KRS 0000243252, Regon 020136043,
                                NIP 899-25-49-057, KAPITAŁ ZAKŁADOWY: 1.200.000 PLN wpłacony w całości
                            </div>
                            <div class="text_label_contract" style="width: 100%; padding-left: 10px; padding-right:10px;line-height:10px;">zwaną dalej „VOTUM”, o następującej treści:</div>
                        </div>
                    </div>
                </div>
                <div class="red_margin"></div>
            </div>
            <div class="margin_10"></div>

            <div class="capture align-middle">
                <div class="red_margin_capture"></div>
                <div class="number_capture"> I </div>
                <div class="capture_title">PRZEDMIOT UMOWY</div>
            </div>
            <div class="contract_text">
                <div style="font-size:8px !important;margin-bottom: 0px!important">
                    <li>
                        <div class="number">1.</div>
                        <div class="li_content">
                            VOTUM zobowiązuje się do powzięcia czynności mających na celu uzyskanie należnych Zleceniodawcy świadczeń odszkodowawczych
                            od podmiotu obowiązanego do zapewnienia ochrony ubezpieczeniowej (zwanego dalej „Zobowiązanym“), za szkodę majątkową
                            powstałą na skutek zdarzenia z dnia #= (data.IncidentDate != null) ? data.IncidentDate : '' # r.
                        </div>
                    </li>
                    <li>
                        <div class="number">2.</div>
                        <div class="li_content">
                            VOTUM podejmuje czynności, o których mowa w ust. 1, na podstawie dokumentów uzyskanych od Zleceniodawcy.
                        </div>
                    </li>
                </div>
            </div>
            <div class="clear"></div>
            <div class="margin_10"></div>
            <div class="capture align-middle">
                <div class="red_margin_capture"></div>
                <div class="number_capture"> II </div>
                <div class="capture_title">WYNAGRODZENIE</div>
            </div>



            <div class="contract_text">
                <div style="font-size:8px !important;margin-bottom: 0px!important">
                    <li>
                        <div class="number">1.</div>
                        <div class="li_content">
                            VOTUM zobowiązuje się do przekazania Zleceniodawcy uzyskanych świadczeń odszkodowawczych w terminie <b>7 dni roboczych</b> od
                            dnia ich otrzymania, po uprzednim potrąceniu należnego VOTUM wynagrodzenia, za pośrednictwem <i class="#= (data.PaymentForm == 1) ? 'far fa-check-square' : 'far fa-square' #" style="background-color: \#FFF;"></i> przekazu pocztowego lub
                            <i class="#= (data.PaymentForm == 0) ? 'far fa-check-square' : 'far fa-square' #" style="background-color: \#FFF;"></i> przelewem bankowym na wskazany przez Zleceniodawcę rachunek bankowy:

                        </div>
                    </li>
                </div>
            </div>
            <div class="clear"></div>
            <div class="margin_10"></div>
            <div class="form_section_phone" style="height: 110px;">
                <div class="red_margin"></div>
                <div class="form_section_body" style="padding-bottom:8px;">
                    <div class="body_form">
                        <div class="form_grey_body">
                            <div class="row" style="padding-bottom: 0em; margin-left: 0px; margin-right:0px;">
                                <div class="col-12 padding_column">
                                    <input name="AccountNumber" type="text" class="k-input k-textbox" value="#= (data.AccountNumber != '') ? data.AccountNumber : '' #"/>
                                    <span class="under_small_label">nr rachunku</span>
                                </div>
                            </div>
                            <div class="row" style="padding-bottom: 0em; margin-left: 0px; margin-right:0px;">
                                <span class="under_small_label" style="padding-left:10px; padding-top: 2px; text-align: left;">Posiadacz rachunku (Wypełnić, jeżeli posiadaczem rachunku nie jest Zleceniodawca. Wskazać imię, nazwisko oraz adres posiadacza.)</span>
                                <div class="col-6 padding_column">
                                    <input name="CustomerFirstName" type="text" class="k-input k-textbox" value="#= (data.CustomerFirstName != '') ? data.CustomerFirstName : '' #"/>
                                    <span class="under_small_label">imię</span>
                                </div>
                                <div class="col-6 padding_column">
                                    <input name="CustomerLastName" type="text" class="k-input k-textbox" value="#= (data.CustomerLastName != '') ? data.CustomerLastName : '' #"/>
                                    <span class="under_small_label">nazwisko/firma</span>
                                </div>
                            </div>
                            <div class="row" style="padding-bottom: 0em; margin-left: 0px; margin-right:0px;">
                                <div class="col-4 padding_column">
                                    <input name="CustomerStreet" type="text" class="k-input k-textbox" value="#= (data.CustomerStreet != '') ? data.CustomerStreet : '' #"/>
                                    <span class="under_small_label">ulica</span>
                                </div>
                                <div class="col-3 padding_column">
                                    <input name="CustomerStreetNumber" type="text" class="k-input k-textbox" value="#= (data.CustomerStreetNumber != '') ? data.CustomerStreetNumber : '' #"/>
                                    <span class="under_small_label">nr domu/mieszkania</span>
                                </div>
                                <div class="col-2 padding_column">
                                    <input name="CustomerPostCode" type="text" class="k-input k-textbox" value="#= (data.CustomerPostCode != '') ? data.CustomerPostCode : '' #"/>
                                    <span class="under_small_label">kod pocztowy</span>
                                </div>
                                <div class="col-3 padding_column">
                                    <input name="CustomerCity" type="text" class="k-input k-textbox" value="#= (data.CustomerCity != '') ? data.CustomerCity : '' #"/>
                                    <span class="under_small_label">miejscowość</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="red_margin"></div>
            </div>
            <div class="number_site_text">
                <div class="row justify-content-center" style="width: 100%; margin: 0px;">1/3</div>
            </div>
            <div class="print_text"><?php echo $contract_number; ?></div>
        </div>

        <div class="pdf_strona size-a4 pdf-page new-page">
            <div class="row margin_width" style="padding-top: 30px; padding-bottom: 10px;">
                <div class="logo_left">
                    <img src="<?php echo 'https://' . $_SERVER ['HTTP_HOST']; ?>/img/laur_small.png" />
                </div>
                <div class="logo_right">
                    <img src="<?php echo 'https://' . $_SERVER ['HTTP_HOST']; ?>/img/logo_small.png" />
                </div>
            </div>

            <div class="contract_text">
                <div style="font-size:8px !important;margin-bottom: 0px!important">
                    <li>
                        <div class="number">2.</div>
                        <div class="li_content">
                            Zleceniodawca upoważnia VOTUM do odbioru wszelkich uzyskanych w jego imieniu świadczeń w ramach wykonania niniejszej umowy
                        </div>
                    </li>
                    <li>
                        <div class="number">3.</div>
                        <div class="li_content">
                            Z tytułu wykonania niniejszej umowy VOTUM przysługuje wynagrodzenie w wysokości #= (data.Commision != null) ? data.Commision : '' #% (słownie:
                            #= (data.Commision != null) ? data.Commision : '' #%) brutto wartości uzyskanych dla Zleceniodawcy świadczeń (w tym podatek od towarów i usług VAT
                            w wysokości 23 %).
                        </div>
                    </li>
                    <li>
                        <div class="number">4.</div>
                        <div class="li_content">
                            Dodatkowo VOTUM przysługuje zwrot udokumentowanych kosztów:
                        </div>
                    </li>
                    <div style="font-size:8px !important;padding-left:15px !important;margin-bottom: 0px!important">
                        <li>
                            <div class="number">a)</div>
                            <div class="li_content">
                                wykonania operatu szacunkowego lub opinii, w celu udokumentowania przyczyn powstania szkody, stanu faktycznego po powstaniu
                                szkody i oszacowania wartości szkody, jeżeli w trakcie postępowania likwidacyjnego niezbędne okaże się wykonanie tych czynności
                                przez rzeczoznawcę majątkowego, biegłego lub specjalistę z danej dziedziny; w razie potrzeby wykonania operatu szacunkowego lub
                                opinii, o których wyżej mowa, VOTUM poinformuje Zleceniodawcę i po uzyskaniu jego zgody, zleci ich wykonanie ww. podmiotom.
                            </div>
                        </li>
                        <li>
                            <div class="number">b)</div>
                            <div class="li_content">
                                opłat skarbowych od pełnomocnictwa w kwocie 17 zł (słownie: siedemnaście złotych) od każdego pełnomocnictwa, innych opłat
                                skarbowych oraz opłat sądowych,
                            </div>
                        </li>
                        <li>
                            <div class="number">c)</div>
                            <div class="li_content">
                                określonej w przepisach prawa opłaty za postępowanie pozasądowe prowadzone przed Rzecznikiem Finansowym w wysokości 50,00 zł,
                                po uprzednim wyrażeniu zgody na takie postępowanie przez Zleceniodawcę
                            </div>
                        </li>
                        <li>
                            <div class="number">d)</div>
                            <div class="li_content">
                                określonej w przepisach prawa opłaty za mediacje przed Sądem Polubownym przy komisji Nadzoru Finansowego w wysokości 50,00 zł,
                                po uprzednim wyrażeniu zgody na takie postępowanie przez Zleceniodawcę.
                            </div>
                        </li>
                    </div>
                    <li>
                        <div class="number">5.</div>
                        <div class="li_content">
                            W przypadku spełnienia świadczenia przez Zobowiązanego bezpośrednio do rąk Zleceniodawcy po dacie zawarcia niniejszej umowy,
                            Zleceniodawca zobowiązuje się niezwłocznie powiadomić o tym VOTUM i wypłacić w terminie 7 dni roboczych od dnia jego otrzymania
                            należne VOTUM wynagrodzenie na rachunek bankowy prowadzony w ING Bank Śląski S.A. Oddział we Wrocławiu nr 70 1050 1575
                            1000 0023 2392 0799, bądź w inny sposób wskazany przez VOTUM.
                        </div>
                    </li>
                    <li>
                        <div class="number">6.</div>
                        <div class="li_content">
                            VOTUM <b>nie pobiera wynagrodzenia</b> w przypadku wypowiedzenia umowy przez Klienta. Jeżeli wypowiedzenie nastąpiło bez ważnego
                            powodu, a na skutek wykonania umowy Klient uzyskał Odszkodowanie, VOTUM może domagać się naprawienia szkody wyłącznie
                            do kwoty wysokości wynagrodzenia, jakie zostałoby naliczone, gdyby Klient nie wypowiedział umowy.
                        </div>
                    </li>
                </div>
            </div>

            <div class="clear"></div>
            <div class="margin_10"></div>
            <div class="capture align-middle">
                <div class="red_margin_capture"></div>
                <div class="number_capture"> III </div>
                <div class="capture_title">OKRES OBOWIĄZYWANIA UMOWY</div>
            </div>
            <div class="contract_text">
                <li>Umowa zostaje zawarta na czas do całkowitego wyegzekwowania dla Zleceniodawcy świadczeń należnych od Zobowiązanego <b>w postępowaniu
                        przedsądowym, sądowym i egzekucyjnym.</b></li>
            </div>

            <div class="clear"></div>
            <div class="margin_10"></div>
            <div class="capture align-middle">
                <div class="red_margin_capture"></div>
                <div class="number_capture"> IV </div>
                <div class="capture_title">WARUNKI PROWADZENIA POSTĘPOWANIA SĄDOWEGO</div>
            </div>

            <div class="contract_text">
                <div style="font-size:8px !important;margin-bottom: 0px!important">
                    <li>
                        <div class="number">1.</div>
                        <div class="li_content">
                            Skierowanie sprawy na drogę postępowania sądowego przeciwko Zobowiązanemu wymaga zgody obu stron umowy.
                        </div>
                    </li>
                    <li>
                        <div class="number">2.</div>
                        <div class="li_content">
                            W przypadku wyrażenia przez Zleceniodawcę zgody na prowadzenie postępowania sądowego, zobowiązuje się on do niezwłocznego
                            przekazania VOTUM wszelkich posiadanych informacji dotyczących przedmiotu umowy oraz wszelkiej żądanej przez niego dokumentacji
                            i oświadczeń, które będą przydatne do wykonania umowy.
                        </div>
                    </li>
                    <li>
                        <div class="number">3.</div>
                        <div class="li_content">
                            <b>VOTUM pokrywa koszty wynagrodzenia pełnomocnika procesowego</b>, za wyjątkiem kosztów przejazdów pełnomocnika procesowego
                            na rozprawy, w wysokości określonej przez przepisy Rozporządzenia Ministra Infrastruktury w sprawie warunków ustalania
                            oraz sposobu dokonywania zwrotu kosztów używania do celów służbowych samochodów osobowych, motocykli i motorowerów
                            niebędących własnością pracodawcy (Dz. U. z 2002 r. nr 27, poz. 271) albo kosztów zastępstwa substytucyjnego w wysokości faktycznie
                            poniesionej, nie przekraczającej 300 zł (słownie: trzysta złotych) od każdego posiedzenia, do pokrycia których zobowiązany będzie
                            Zleceniodawca.
                        </div>
                    </li>
                    <li>
                        <div class="number">4.</div>
                        <div class="li_content">
                            <b>VOTUM zobowiązuje się do wystąpienia o zwolnienie Zleceniodawcy z kosztów sądowych</b>, po uprzednim złożeniu przez
                            Zleceniodawcę oświadczenia o stanie rodzinnym, majątku i dochodach, według obowiązującego wzoru urzędowego (w przypadku
                            osób fizycznych) lub przedłożenia dokumentacji rachunkowej i księgowej, niezbędnej do złożenia wniosku o zwolnienie od kosztów
                            sądowych (w przypadku innych podmiotów). W przypadku braku zwolnienia przez sąd z kosztów sądowych, do ich pokrycia zobowią
                            zuje się Zleceniodawca.
                        </div>
                    </li>
                    <li>
                        <div class="number">5.</div>
                        <div class="li_content">
                            Koszty procesu zasądzone od Zobowiązanego przypadają VOTUM lub Zleceniodawcy w części, w jakiej zostały poniesione przez każdą
                            ze stron, z tym, że koszty zastępstwa procesowego zasądzone w sprawie przypadają pełnomocnikowi procesowemu, o którym mowa
                            w § 5 ust. 1.
                        </div>
                    </li>
                </div>
            </div>

            <div class="clear"></div>
            <div class="margin_10"></div>
            <div class="capture align-middle">
                <div class="red_margin_capture"></div>
                <div class="number_capture"> V </div>
                <div class="capture_title">PRAWA I OBOWIĄZKI STRON</div>
            </div>

            <div class="contract_text">
                <div style="font-size:8px !important;margin-bottom: 0px!important">
                    <li>
                        <div class="number">1.</div>
                        <div class="li_content">
                            Czynności wchodzące w zakres niniejszej umowy VOTUM może wykonywać za pomocą podmiotów współpracujących, w szczególności
                            adwokatów lub radców prawnych, przy czym za działanie tych osób VOTUM odpowiada wobec Zleceniodawcy jak za działania własne.
                        </div>
                    </li>
                    <li>
                        <div class="number">2.</div>
                        <div class="li_content">
                            Zleceniodawca upoważnia VOTUM do pozyskania informacji o okolicznościach zdarzenia, o którym mowa w § 1 ust. 1, oraz dotyczących
                            go dokumentów, w zakresie w jakim jest to niezbędne do wykonania umowy.
                        </div>
                    </li>
                    <li>
                        <div class="number">3.</div>
                        <div class="li_content">
                            VOTUM oświadcza, że nie zawrze w imieniu Zleceniodawcy ugody ze zobowiązanym bez jego zgody. Wyrażenie zgody może nastąpić
                            w dowolnej formie. W przypadku złożenia oferty zawarcia ugody przez Zobowiązanego bezpośrednio Zleceniodawcy, zobowiązuje się
                            on do niezwłocznego poinformowania o tym VOTUM.
                        </div>
                    </li>
                    <li>
                        <div class="number">4.</div>
                        <div class="li_content">
                            Reklamacje związane z wykonaniem umowy Zleceniodawca może składać w formie listu poleconego na adres VOTUM. VOTUM rozpatruje
                            reklamacje i udziela Zleceniodawcy pisemnej odpowiedzi w terminie 30 dni.
                        </div>
                    </li>
                    <li>
                        <div class="number">5.</div>
                        <div class="li_content">
                            Informacje dotyczące wykonywania niniejszej umowy będą kierowane na wskazany przez Zleceniodawcę nr telefonu lub adres email,
                            a w przypadku ich braku – na adres zameldowania/korespondencyjny.
                        </div>
                    </li>
                </div>
            </div>

            <div class="number_site_text">
                <div class="row justify-content-center" style="width: 100%; margin: 0px;">2/3</div>
            </div>
            <div class="print_text"><?php echo $contract_number; ?></div>
        </div>


        <div class="pdf_strona size-a4 pdf-page new-page">
            <div class="row margin_width" style="padding-top: 30px; padding-bottom: 10px;">
                <div class="logo_left">
                    <img src="<?php echo 'https://' . $_SERVER ['HTTP_HOST']; ?>/img/laur_small.png" />
                </div>
                <div class="logo_right">
                    <img src="<?php echo 'https://' . $_SERVER ['HTTP_HOST']; ?>/img/logo_small.png" />
                </div>
            </div>
            <div class="clear"></div>
            <div class="margin_10"></div>
            <div class="capture align-middle">
                <div class="red_margin_capture"></div>
                <div class="number_capture"> VI </div>
                <div class="capture_title">POSTANOWIENIA KOŃCOWE</div>
            </div>

            <div class="contract_text">
                <div style="font-size:8px !important;margin-bottom: 0px!important">
                    <li>
                        <div class="number">1.</div>
                        <div class="li_content">
                            Wszelkie zmiany umowy wymagają formy pisemnej pod rygorem nieważności.
                        </div>
                    </li>
                    <li>
                        <div class="number">2.</div>
                        <div class="li_content">
                            W kwestiach nieuregulowanych w umowie zastosowanie mają przepisy kodeksu cywilnego.
                        </div>
                    </li>
                    <li>
                        <div class="number">3.</div>
                        <div class="li_content">
                            Umowę sporządzono i podpisano w dwóch jednobrzmiących egzemplarzach, po jednym dla każdej ze stron.
                        </div>
                    </li>
                    <li>
                        <div class="number">4.</div>
                        <div class="li_content">
                            Integralną częścią niniejszej umowy jest załącznik – Klauzule informacyjne dla Klienta.
                        </div>
                    </li>
                </div>
            </div>

            <div class="clear"></div>
            <div class="margin_10"></div>
            <div class="row" style="margin-left: 0px; margin-right:0px; margin-top: 30px;">
                <div class="col-4 padding_column">
                    <div class="row justify-content-center border_bottom" style="padding-bottom: 0.5em;padding-top: 0.5em; margin-left: 0px; margin-right:0px;font-size:9px;"></div>
                    <div class="row justify-content-center" style="padding-bottom: 0.5em;padding-top: 0.5em; margin-left: 0px; margin-right:0px;font-size:7px;">VOTUM S.A.</div>
                </div>
                <div class="col-4 padding_column"></div>
                <div class="col-4 padding_column">
                    <div class="row justify-content-center border_bottom" style="padding-bottom: 0.5em;padding-top: 0.5em; margin-left: 0px; margin-right:0px;font-size:9px;"></div>
                    <div class="row justify-content-center" style="padding-bottom: 0.5em;padding-top: 0.5em; margin-left: 0px; margin-right:0px;font-size:7px;">Zleceniodawca</div>
                </div>
            </div>
            <div class="clear"></div>

            <div class="number_site_text">
                <div class="row justify-content-center" style="width: 100%; margin: 0px;">3/3</div>
            </div>
            <div class="print_text"><?php echo $contract_number; ?></div>
        </div>

        <div class="pdf_strona size-a4 pdf-page new-page">
            <div class="row margin_width" style="padding-top: 30px; padding-bottom: 10px;">
                <div class="logo_left">
                    <img src="<?php echo 'https://' . $_SERVER ['HTTP_HOST']; ?>/img/laur_small.png" />
                </div>
                <div class="logo_right">
                    <img src="<?php echo 'https://' . $_SERVER ['HTTP_HOST']; ?>/img/logo_small.png" />
                </div>
            </div>
            <div class="clear"></div>
            <span class="row contract_name"><p>Załącznik - Klauzula informacyjna dla klienta</p></span>
            <div class="capture">
                <div class="red_margin_capture"></div>
                <div class="number_capture"> § I </div>
                <div class="capture_title">INFORMACJE</div>
            </div>

            <div class="clear"></div>
            <div class="row contract_text font_size_10">
                <div class="col-6">
                    <li>
                        <div class="number_f_10">I.</div>
                        <div class="li_content_f_10">
                            VOTUM S.A. z siedzibą we Wrocławiu informuje, że w związku z obowiązkami wynikającymi z ogólnego rozporządzenia
                            o ochronie danych osobowych z dnia 27 kwietnia 2016 r. (RODO), dane osobowe podane przez
                            Klienta w umowie i załącznikach do umowy, jak również dane uzyskane w trakcie jej wykonywania będą przetwarzane
                            przez VOTUM S.A. z siedzibą we Wrocławiu, ul. Wyścigowa 56i, 53-012 Wrocław, wpisana do rejestru
                            przedsiębiorców KRS pod numerem 0000243252 (dalej „Spółka”), która stanie się Administratorem tych danych.
                        </div>
                    </li>
                    <li>
                        <div class="number_f_10">II.</div>
                        <div class="li_content_f_10">
                            Uzyskanie informacji o procesach przetwarzania danych osobowych możliwe jest poprzez kontakt z Inspektorem
                            Ochrony Danych w formie elektronicznej: e-mail iod@ votum-sa.pl lub pisemnej: Inspektor Ochrony Danych,
                            ul. Wyścigowa 56i, 53-012 Wrocław.
                        </div>
                    </li>
                    <li>
                        <div class="number_f_10">III.</div>
                        <div class="li_content_f_10">
                            Dane osobowe przetwarzane będą w następujących celach oraz na podstawie następujących przesłanek:
                        </div>
                    </li>
                    <div style="padding-left:15px !important;margin-bottom: 0px!important">
                        <li>
                            <div class="number_f_10">1.</div>
                            <div class="li_content_f_10">
                                Wykonie umowy na rzecz klienta, podstawą prawną jest art. 6 ust. 1 lit b RODO,
                            </div>
                        </li>
                        <li>
                            <div class="number_f_10">2.</div>
                            <div class="li_content_f_10">
                                Marketing usług własnych, wykorzystywane do tego celu będą środki komunikacji w tym telefon
                                oraz email, podstawą prawną jest art. 6 ust. 1 lit. f) RODO,
                            </div>
                        </li>
                        <li>
                            <div class="number_f_10">3.</div>
                            <div class="li_content_f_10">
                                Zapewnienie prawidłowości podatkowych po wystawieniu faktury, podstawą prawna jest art. 6 ust. 1
                                lit. c) RODO uszczegółowienie w art. 70 §1 Ordynacji Podatkowej,
                            </div>
                        </li>
                        <li>
                            <div class="number_f_10">4.</div>
                            <div class="li_content_f_10">
                                W przypadku wyrażenia dodatkowych zgód (art. 6 ust.1 lit a), dane osobowe będą przetwarzane w
                                celu zaproponowania usług podmiotów powiązanych z VOTUM S.A wskazanym w §2 poniżej.
                            </div>
                        </li>
                    </div>
                    <li>
                        <div class="number_f_10">IV.</div>
                        <div class="li_content_f_10">
                            Dane osobowe udostępnione będą podmiotom zobowiązanym do naprawienia szkody, a w razie takiej potrzeby - organom państwowym.
                        </div>
                    </li>
                    <li>
                        <div class="number_f_10">V.</div>
                        <div class="li_content_f_10">
                            W zależności o celu przetwarzania dane osobowe Klienta będą przetwarzane przez następujący okres czasu:
                        </div>
                    </li>
                    <div style="padding-left:15px !important;margin-bottom: 0px!important">
                        <li>
                            <div class="number_f_10">1.</div>
                            <div class="li_content_f_10">
                                W związku z możliwością podniesienia roszczeń z kodeksu cywilnego, przez okres do 10 lat od momentu zakończenia umowy,
                            </div>
                        </li>
                        <li>
                            <div class="number_f_10">2.</div>
                            <div class="li_content_f_10">
                                W związku z możliwością pojawienia się nowych ofert, przez okres do 10 lat od momentu zakończenia
                                umowy lub do momentu wniesienia sprzeciwu na marketing wskazanego podmiotu.
                            </div>
                        </li>
                    </div>
                </div>
                <div class="col-6">
                    <div style="padding-left:15px !important;margin-bottom: 0px!important">
                        <li>
                            <div class="number_f_10">3.</div>
                            <div class="li_content_f_10">
                                W związku z wymogami ustawy, przez okres 5 lat + bieżący rok podatkowy od momenty wystawienia faktury,
                            </div>
                        </li>
                        <li>
                            <div class="number_f_10">4.</div>
                            <div class="li_content_f_10">
                                W związku z możliwością pojawienia się nowych ofert, przez okres do 10 lat od momentu zakończenia
                                umowy lub do momentu wniesienia sprzeciwu na marketing wskazanego podmiotu.
                            </div>
                        </li>
                    </div>
                    <li>
                        <div class="number_f_10">VI.</div>
                        <div class="li_content_f_10">
                            Klient ma prawo dostępu do swoich danych, ich sprostowania, usunięcia lub ograniczenia przetwarzania a
                            także do wniesienia sprzeciwu wobec przetwarzania danych, w tym na marketing usług własnych VOTUM
                            S.A. oraz do przenoszenia danych. Klient jest uprawniony do cofnięcia wyrażonej zgody na przetwarzanie danych
                            w każdym czasie, a także do wniesienia skargi w związku z przetwarzaniem danych do organu nadzorczego –
                            Prezesa Urzędu Ochrony Danych Osobowych.
                        </div>
                    </li>
                    <li>
                        <div class="number_f_10">VII.</div>
                        <div class="li_content_f_10">
                            Podanie danych jest dobrowolne jednakże niezbędne dla celów wykonania umowy. W przypadku braku podania
                            danych lub niewyrażenia zgody na ich przetwarzanie, realizacja umowy może stać się niemożliwa.
                        </div>
                    </li>
                    <li>
                        <div class="number_f_10">VIII.</div>
                        <div class="li_content_f_10">
                            Dane osobowe wskazane w umowie, będą podlegały profilowaniu, które ma na celu dopasowanie i zaproponowanie
                            Klientowi nowych usług. Każdorazowo przed podjęciem decyzji w tym przedmiocie dane osobowe będą weryfikowane
                            przez pracownika VOTUM S.A.
                        </div>
                    </li>
                </div>
            </div>
            <div class="clear"></div>

            <div class="row" style="margin-left: 0px; margin-right:0px;">
                <div class="text_label_contract" style="width: 100%;font-size:10px !important;">Oświadczam, że zapoznałem się z treścią informacji zawartych w §1</div>
            </div>
            <div class="row" style="margin-left: 0px; margin-right:0px; margin-top: 30px;">
                <div class="col-3 padding_column"></div>
                <div class="col-3 padding_column"></div>
                <div class="col-6 padding_column">
                    <div class="row justify-content-center border_bottom" style="padding-bottom: 0.5em;padding-top: 0.5em; margin-left: 0px; margin-right:0px;font-size:9px;"></div>
                    <div class="row justify-content-center" style="padding-bottom: 0.5em;padding-top: 0.5em; margin-left: 0px; margin-right:0px;font-size:9px;">podpis Klienta/osoby działającej w imieniu Klienta</div>
                </div>
            </div>
            <div class="clear"></div>
            <div class="number_site_text">
                <div class="row justify-content-center" style="width: 100%; margin: 0px;">1/2</div>
            </div>
            <div class="print_text"><?php echo $aggreement_layout_number; ?></div>
        </div>

        <div class="pdf_strona size-a4 pdf-page new-page">
            <div class="row margin_width" style="padding-top: 30px; padding-bottom: 10px;">
                <div class="logo_left">
                    <img src="<?php echo 'https://' . $_SERVER ['HTTP_HOST']; ?>/img/laur_small.png" />
                </div>
                <div class="logo_right">
                    <img src="<?php echo 'https://' . $_SERVER ['HTTP_HOST']; ?>/img/logo_small.png" />
                </div>
            </div>
            <div class="clear"></div>

            <div class="margin_10"></div>
            <div class="capture">
                <div class="red_margin_capture"></div>
                <div class="number_capture"> § II </div>
                <div class="capture_title">ZGODY KLIENTA</div>
            </div>
            <div class="margin_10"></div>


            <div class="contract_text" style="font-size: 9px;">
                <b>I.</b>
                Wyrażam zgodę na przekazanie moich danych kontaktowych (telefon, adres poczty elektronicznej, adres zamieszkania) następującym podmiotom:
            </div>
            <div class="contract_text" style="font-size: 9px;padding-top:5px;padding-bottom:5px;">
                1. DSA Investment S.A. Al. Wiśniowa 47, 53-126 Wrocław, KRS: 0000391830, w zakresie danych teleadresowych w celu sporządzenia oferty
                produktów finansowych i ubezpieczeń osobowych:
            </div>
            <div class="contract_text" style="font-size: 9px;padding-top:5px;padding-bottom:5px;">
                <i class="#= (data.DSAI == 1) ? 'far fa-check-square' : 'far fa-square' #" style="background-color: \#FFF;"></i> TAK
                <i class="#= (data.DSAI == 0) ? 'far fa-check-square' : 'far fa-square' #" style="background-color: \#FFF;"></i> NIE
            </div>

            <div class="contract_text" style="font-size: 9px;padding-top:5px;padding-bottom:5px;">
                2. Polskie Centrum Rehabilitacji Funkcjonalnej Votum S.A. Sp. k., Golikówka 6, 30-723 Kraków, KRS: 0000290430 , w zakresie danych
                zawartych w umowie i przekazanej dokumentacji, w tym stanu zdrowia w celu sporządzenia oferty rehabilitacji
            </div>
            <div class="contract_text" style="font-size: 9px;padding-top:5px;padding-bottom:5px;">
                <i class="#= (data.PCRFI == 1) ? 'far fa-check-square' : 'far fa-square' #" style="background-color: \#FFF;"></i> TAK
                <i class="#= (data.PCRFI == 0) ? 'far fa-check-square' : 'far fa-square' #" style="background-color: \#FFF;"></i> NIE
            </div>

            <div class="contract_text" style="font-size: 9px;padding-top:5px;padding-bottom:5px;">
                3. Fundacja VOTUM, ul. Wyścigowa 56i, 53-012 Wrocław, KRS: 0000272272, w zakresie danych zawartych w umowie i przekazanej dokumentacji,
                w tym stanu zdrowia w celu przedstawienia możliwego zakresu pomocy:
            </div>
            <div class="contract_text" style="font-size: 9px;padding-top:5px;padding-bottom:5px;">
                <i class="#= (data.FundacjaI == 1) ? 'far fa-check-square' : 'far fa-square' #" style="background-color: \#FFF;"></i> TAK
                <i class="#= (data.FundacjaI == 0) ? 'far fa-check-square' : 'far fa-square' #" style="background-color: \#FFF;"></i> NIE
            </div>

            <div class="contract_text" style="font-size: 9px;padding-top:5px;padding-bottom:5px;">
                4. AUTOVOTUM S.A., ul. Wyścigowa 56i, 53-012 Wrocław, KRS: 0000273033, w zakresie danych teleadresowych w celu sporządzenia oferty
                usług wynajmu pojazdów zastępczych;
            </div>
            <div class="contract_text" style="font-size: 9px;padding-top:5px;padding-bottom:5px;">
                <i class="#= (data.AutovotumI == 1) ? 'far fa-check-square' : 'far fa-square' #" style="background-color: \#FFF;"></i> TAK
                <i class="#= (data.AutovotumI == 0) ? 'far fa-check-square' : 'far fa-square' #" style="background-color: \#FFF;"></i> NIE
            </div>

            <div class="contract_text" style="font-size: 9px;padding-top:5px;padding-bottom:5px;">
                5. Biuro Ekspertyz Procesowych sp. z o.o., Aleja Wiśniowa 47, 53-126 Wrocław, KRS: 0000565095, w zakresie danych teleadresowych w celu
                sporządzenia oferty cesji wierzytelności dotyczącej szkody w pojeździe.
            </div>
            <div class="contract_text" style="font-size: 9px;padding-top:5px;padding-bottom:5px;">
                <i class="#= (data.BEPI == 1) ? 'far fa-check-square' : 'far fa-square' #" style="background-color: \#FFF;"></i> TAK
                <i class="#= (data.BEPI == 0) ? 'far fa-check-square' : 'far fa-square' #" style="background-color: \#FFF;"></i> NIE
            </div>

            <div class="contract_text" style="font-size: 9px;padding-top:5px;padding-bottom:5px;">
                <b>II.</b>
                Wyrażam zgodę na wykonywanie następujących czynności przez:
            </div>
            <div class="contract_text" style="font-size: 9px;padding-top:5px;padding-bottom:5px;">
                1. DSA Investment S.A., Al. Wiśniowa 47,53-126 Wrocław,
            </div>
            <div class="contract_text" style="font-size: 9px;padding-top:5px;padding-bottom:5px;">
                a) Przesłanie informacji handlowych za pośrednictwem środków komunikacji elektronicznej, zgodnie z ustawą z dnia 08.07.2002 r. o świadczeniu
                usług drogą elektroniczną (Dz.U. z 2016 r. poz.1030);
            </div>
            <div class="contract_text" style="font-size: 9px;padding-top:5px;padding-bottom:5px;">
                <i class="#= (data.DSAIIA == 1) ? 'far fa-check-square' : 'far fa-square' #" style="background-color: \#FFF;"></i> TAK
                <i class="#= (data.DSAIIA == 0) ? 'far fa-check-square' : 'far fa-square' #" style="background-color: \#FFF;"></i> NIE
            </div>
            <div class="contract_text" style="font-size: 9px;padding-top:5px;padding-bottom:5px;">
                b) Przekazywanie treści marketingowych na podany przez mnie nr telefonu w tym przy użyciu automatycznych systemów wywołujących
                w rozumieniu ustawy z dnia 17.07.2004 r. Prawo telekomunikacyjne (Dz.U. z 2016 r. poz. 1489);
            </div>
            <div class="contract_text" style="font-size: 9px;padding-top:5px;padding-bottom:5px;">
                <i class="#= (data.DSAIIB == 1) ? 'far fa-check-square' : 'far fa-square' #" style="background-color: \#FFF;"></i> TAK
                <i class="#= (data.DSAIIB == 0) ? 'far fa-check-square' : 'far fa-square' #" style="background-color: \#FFF;"></i> NIE
            </div>

            <div class="contract_text" style="font-size: 9px;padding-top:5px;padding-bottom:5px;">
                2. VOTUM S.A., ul. Wyścigowa 56i, 53-012 Wrocław,
            </div>
            <div class="contract_text" style="font-size: 9px;padding-top:5px;padding-bottom:5px;">
                a) przesyłanie informacji handlowych za pośrednictwem środków komunikacji elektronicznej zgodnie z ustawą z dn. 08.07.2002 r. o świadczeniu
                usług drogą elektroniczną (t. j. Dz.U. z 2017 r. poz. 1219):
            </div>
            <div class="contract_text" style="font-size: 9px;padding-top:5px;padding-bottom:5px;">
                <i class="#= (data.VotumIIA == 1) ? 'far fa-check-square' : 'far fa-square' #" style="background-color: \#FFF;"></i> TAK
                <i class="#= (data.VotumIIA == 0) ? 'far fa-check-square' : 'far fa-square' #" style="background-color: \#FFF;"></i> NIE
            </div>
            <div class="contract_text" style="font-size: 9px;padding-top:5px;padding-bottom:5px;">
                b) przekazywanie treści marketingowych na podany przeze mnie nr telefonu w tym przy użyciu automatycznych systemów wywołujących
                w rozumieniu ustawy z dn.16.07.2004 r. Prawo telekomunikacyjne (t. j. Dz.U. z 2017 r. poz. 1907):
            </div>
            <div class="contract_text" style="font-size: 9px;padding-top:5px;padding-bottom:5px;">
                <i class="#= (data.VotumIIB == 1) ? 'far fa-check-square' : 'far fa-square' #" style="background-color: \#FFF;"></i> TAK
                <i class="#= (data.VotumIIB == 0) ? 'far fa-check-square' : 'far fa-square' #" style="background-color: \#FFF;"></i> NIE
            </div>

            <div class="row" style="margin-left: 0px; margin-right:0px; margin-top: 30px;">
                <div class="col-3 padding_column"></div>
                <div class="col-3 padding_column"></div>
                <div class="col-6 padding_column">
                    <div class="row justify-content-center border_bottom" style="padding-bottom: 0.5em;padding-top: 0.5em; margin-left: 0px; margin-right:0px;font-size:9px;"></div>
                    <div class="row justify-content-center" style="padding-bottom: 0.5em;padding-top: 0.5em; margin-left: 0px; margin-right:0px;font-size:9px;">podpis Klienta/osoby działającej w imieniu Klienta</div>
                </div>
            </div>

            <div class="clear"></div>
            <div class="number_site_text">
                <div class="row justify-content-center" style="width: 100%; margin: 0px;">2/2</div>
            </div>
            <div class="print_text"><?php echo $aggreement_layout_number; ?></div>
        </div>

        <!--PEŁNOMOCNICTWO VOTUM-->

        <div class="pdf_strona size-a4 pdf-page new-page">
            <div class="row margin_width" style="padding-top: 30px; padding-bottom: 10px;">
                <div class="logo_left">
                    <img src="<?php echo 'https://' . $_SERVER ['HTTP_HOST']; ?>/img/laur_small.png" />
                </div>
                <div class="logo_right">
                    <img src="<?php echo 'https://' . $_SERVER ['HTTP_HOST']; ?>/img/logo_small.png" />
                </div>
            </div>

            <div class="margin_10"></div>
            <span class="row contract_name"><p>PEŁNOMOCNICTWO</p></span>
            <div class="form_section_client" style="height:281px;">
                <div class="red_margin"></div>
                <div class="form_section_body">
                    <div class="body_form">
                        <div class="form_grey_body">
                            <div class="row" style="margin-left: 0px; margin-right:0px;">
                                <div class="label_contract" style="width: 100%; font-family: 'Museo_700';">Udzielone przez:</div>
                            </div>
                            <div class="row" style="padding-bottom: 0.5em; margin-left: 0px; margin-right:0px;">
                                <div class="col-6 padding_column">
                                    <input name="FirstNameIPrint" type="text" class="k-input k-textbox" value="#= (data.FirstNameI != null) ? data.FirstNameI : '' #"/>
                                    <span class="under_small_label">imię</span>
                                </div>
                                <div class="col-6 padding_column">
                                    <input name="LastName1Print" type="text" class="k-input k-textbox" value="#= (data.LastNameI != null) ? data.LastNameI : '' #"/>
                                    <span class="under_small_label">nazwisko</span>
                                </div>
                            </div>
                            <div class="row" style="padding-bottom: 0.5em; margin-left: 0px; margin-right:0px;">
                                <span class="under_small_label" style="text-align: left;padding-left:10px;">adres</span>
                                <div class="col-4 padding_column">
                                    <input name="StreetI" type="text" class="k-input k-textbox" value="#= (data.StreetI != null) ? data.StreetI : '' #"/>
                                    <span class="under_small_label">ulica</span>
                                </div>
                                <div class="col-3 padding_column">
                                    <input name="HomeNumberI" type="text" class="k-input k-textbox" value="#= (data.HomeI != null) ? data.HomeI : '' #"/>
                                    <span class="under_small_label">nr domu / mieszkania</span>
                                </div>
                                <div class="col-2 padding_column">
                                    <input name="PostCodeI" type="text" class="k-input k-textbox" value="#= (data.PostCodeI != null) ? data.PostCodeI : '' #"/>
                                    <span class="under_small_label">kod pocztowy</span>
                                </div>
                                <div class="col-3 padding_column">
                                    <input name="CityI" type="text" class="k-input k-textbox" value="#= (data.CityI != null) ? data.CityI : '' #"/>
                                    <span class="under_small_label">miejscowość</span>
                                </div>
                            </div>
                            <div class="row" style="padding-bottom: 0.5em; margin-left: 0px; margin-right:0px;">
                                <span class="under_small_label" style="text-align: left;padding-left:10px;">adres korespondencyjny (jeśli jest inny niż zameldowania)</span>
                                <div class="col-4 padding_column">
                                    <input name="StreetI" type="text" class="k-input k-textbox" value="#= (data.Street != null) ? data.Street : '' #"/>
                                    <span class="under_small_label">ulica</span>
                                </div>
                                <div class="col-3 padding_column">
                                    <input name="HomeNumberI" type="text" class="k-input k-textbox" value="#= (data.Home != null) ? data.Home : '' #"/>
                                    <span class="under_small_label">nr domu / mieszkania</span>
                                </div>
                                <div class="col-2 padding_column">
                                    <input name="PostCodeI" type="text" class="k-input k-textbox" value="#= (data.PostCode != null) ? data.PostCode : '' #"/>
                                    <span class="under_small_label">kod pocztowy</span>
                                </div>
                                <div class="col-3 padding_column">
                                    <input name="CityI" type="text" class="k-input k-textbox" value="#= (data.City != null) ? data.City : '' #"/>
                                    <span class="under_small_label">miejscowość</span>
                                </div>
                            </div>
                            <div class="row" style="padding-bottom: 0.5em; margin-left: 0px; margin-right:0px;">
                                <div class="col-4 padding_column">
                                    <input name="PESELI" type="text" class="k-input k-textbox" value="#= (data.PESELI != null) ? data.PESELI : '' #"/>
                                    <span class="under_small_label">PESEL</span>
                                </div>
                                <div class="col-4 padding_column">
                                    <input name="IdentityCardI" type="text" class="k-input k-textbox" value="#= (data.IdNrI != null) ? data.IdNrI : '' #"/>
                                    <span class="under_small_label">seria i numer dowodu osobistego</span>
                                </div>
                                <div class="col-4 padding_column">
                                    <input name="NIP1" type="text" class="k-input k-textbox" value="#= (data.NIPI != null) ? data.NIPI : '' #"/>
                                    <span class="under_small_label">NIP</span>
                                </div>
                            </div>
                            <div class="row" style="padding-bottom: 0.5em; margin-left: 0px; margin-right:0px;">
                                <div class="col-5 padding_column">
                                    <input name="KRS1" type="text" class="k-input k-textbox" value="#= (data.KRSI != null) ? data.KRSI : '' #"/>
                                    <span class="under_small_label">KRS</span>
                                </div>
                                <div class="col-5 padding_column">
                                    <input name="REGON1" type="text" class="k-input k-textbox" value="#= (data.REGONI != null) ? data.REGONI : '' #"/>
                                    <span class="under_small_label">REGON</span>
                                </div>
                            </div>
                            <div class="row" style="padding-bottom: 0.5em; margin-left: 0px; margin-right:0px;">
                                <span class="under_small_label" style="text-align: left;padding-left:10px;">Reprezentowana(y) przez</span>
                                <div class="col-12 padding_column">
                                    <input name="StreetI" type="text" class="k-input k-textbox" value="#= (data.StreetI != null) ? data.StreetI : '' #"/>
                                </div>
                            </div>
                            <div class="row" style="padding-bottom: 0.5em; margin-left: 0px; margin-right:0px;">
                                <div class="text_label_contract" style="width: 100%; padding-left: 10px; padding-right:10px; line-height:10px;">Należy wypełnić właściwe pola. W przypadku osób fizycznych: imię i nazwisko, adres, PESEL, seria i numer dowodu osobistego, w przypadku
                                    osób fizycznych prowadzących działalność gospodarczą: imię i nazwisko, firma, adres, NIP, REGON, w przypadku spółek prawa handlowego
                                    i innych podmiotów prowadzących działalność gospodarczą: firma, siedziba, adres, NIP, REGON, KRS oraz sposób reprezentacji, zgodny z KRS.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="red_margin"></div>
            </div>
            <div class="margin_10"></div>
            <div class="form_section_phone" style="height: 58px;">
                <div class="red_margin"></div>
                <div class="form_section_body" style="padding-bottom:8px;">
                    <div class="body_form">
                        <div class="form_grey_body">
                            <div class="row" style="margin-left: 0px; margin-right:0px;">
                                <div class="label_contract" style="width: 100%; font-family: 'Museo_700';">Upoważniające</div>
                            </div>
                            <div class="row" style="margin-left: 0px; margin-right:0px;">
                                <div class="text_label_contract" style="width: 100%; padding-left: 10px; padding-right:10px; line-height:10px;">
                                    VOTUM S.A. z siedzibą we Wrocławiu; ul. Wyścigowa 56i, 53-012 Wrocław, tel. 71/33 93 400, faks: 71/33 93 403, e-mail: dok@votum-sa.pl, zarejestrowaną
                                    w Sądzie Rejonowym dla Wrocławia Fabrycznej, VI Wydział Gospodarczy KRS, pod numerem KRS 0000243252, Regon 020136043,
                                    NIP 899-25-49-057, KAPITAŁ ZAKŁADOWY: 1.200.000 PLN wpłacony w całości;
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="red_margin"></div>
            </div>

            <div class="contract_text">do podejmowania w imieniu Mocodawcy przed wszelkimi podmiotami, wszelkich czynności mających na celu ustalenie okoliczności zdarzenia z dnia
                #= (data.IncidentDate != null) ? data.IncidentDate : '<span class="underline" style="width: 100px;"></span>' # i jego skutków, oraz dochodzenie roszczeń odszkodowawczych, które z niego wynikają, w tym, w szczególności do:</div>
            <div class="contract_text">
                <li>
                    <div class="number">1.</div>
                    <div class="li_content">
                        wszelkich czynności pozaprocesowych i polubownych;
                    </div>
                </li>
                <li>
                    <div class="number">2.</div>
                    <div class="li_content">
                        zawarcia ugody, w tym związanej ze zrzeczeniem się dalszych roszczeń;
                    </div>
                </li>
                <li>
                    <div class="number">3.</div>
                    <div class="li_content">
                        odbioru świadczenia;
                    </div>
                </li>
                <li>
                    <div class="number">4.</div>
                    <div class="li_content">
                        wskazania rachunku bankowego, na który mają być przelane świadczenia;
                    </div>
                </li>
                <li>
                    <div class="number">5.</div>
                    <div class="li_content">
                        odbioru wszelkiej korespondencji w sprawach objętych pełnomocnictwem;
                    </div>
                </li>
                <li>
                    <div class="number">6.</div>
                    <div class="li_content">
                        gromadzenia dokumentacji dotyczącej szkody, w tym jej odbioru od podmiotów, które je tworzą i przechowują;
                    </div>
                </li>
                <li>
                    <div class="number">7.</div>
                    <div class="li_content">
                        przekazania dokumentacji dotyczącej szkody innym podmiotom w celu wydania opinii w zakresie zasadności i wysokości roszczeń;
                    </div>
                </li>
                <li>
                    <div class="number">8.</div>
                    <div class="li_content">
                        udzielania dalszych pełnomocnictw.
                    </div>
                </li>
            </div>
            <div class="clear"></div>
            <div class="margin_10"></div>
            <div class="contract_text">Pełnomocnictwo jest ważne także po śmierci mocodawcy.</div>
            <div class="contract_text">Upoważniam VOTUM S.A. do przekazywania oraz odbierania moich danych osobowych objętych zakresem niniejszego pełnomocnictwa.</div>

            <div class="row" style="margin-left: 0px; margin-right:0px; margin-top: 30px;">
                <div class="col-6 padding_column">
                    <div class="row justify-content-center border_bottom" style="padding-bottom: 0.5em;padding-top: 0.5em; margin-left: 0px; margin-right:0px;font-size:9px;"></div>
                    <div class="row justify-content-center" style="padding-bottom: 0.5em;padding-top: 0.5em; margin-left: 0px; margin-right:0px;font-size:7px;">Miejscowość i data</div>
                </div>
                <div class="col-2 padding_column"></div>
                <div class="col-4 padding_column">
                    <div class="row justify-content-center border_bottom" style="padding-bottom: 0.5em;padding-top: 0.5em; margin-left: 0px; margin-right:0px;font-size:9px;"></div>
                    <div class="row justify-content-center" style="padding-bottom: 0.5em;padding-top: 0.5em; margin-left: 0px; margin-right:0px;font-size:7px;">Podpis Mocodawcy</div>
                </div>
            </div>
            <div class="clear"></div>

            <div class="number_site_text">
                <div class="row justify-content-center" style="width: 100%; margin: 0px;">1/1</div>
            </div>
            <div class="print_text"><?php echo $enablement_votum_layout_number; ?></div>
        </div>


        <!--PEŁNOMOCNICTWO KAIRP-->

        <div class="pdf_strona size-a4 pdf-page new-page">
            <div class="row margin_width" style="padding-top: 30px; padding-bottom: 10px;">
                <div class="logo_left">
                    <img style="margin-left: 0px !important;" src="<?php echo 'https://' . $_SERVER ['HTTP_HOST']; ?>/img/logo_kairp_small.png" />
                </div>

            </div>

            <div class="contract_text">
                <div style="width: 50%; float: right;">
                    <p style="text-align: right;font-size: 10px; float:right;"><span class="underline" style="width: 120px;"></span>, <span class="underline" style="width: 100px;"></span> r. </p>
                </div>
            </div>
            <div class="clear"></div>
            <span class="row contract_name" style="margin-top: 40px !important;"><p>PEŁNOMOCNICTWO</p></span>
            <div class="contract_text justyfy" style="margin-top: 10px !important; font-size: 10px;line-height: normal;">
                    Ja niżej podpisany/a
                    #= (data.FirstNameI != null) ? data.FirstNameI +' '+ data.LastNameI : '<span class="underline" style="width: 150px;"></span>' #
                    , działając w imieniu własnym oraz jako przedstawiciel ustawowy małoletniego/małoletniej*
                <span class="underline" style="width: 200px;"></span> upoważniam samodzielnie adwokata
                    Andrzeja Łebka i adw. Anielę Łebek z Kancelarii Adwokatów i Radców Prawnych A. Łebek i Wspólnicy sp. k.
                    we Wrocławiu do prowadzenia sprawy karnej <span class="underline" style="width: 100px;"></span> w związku ze zdarzeniem z dnia #= (data.IncidentDate != null) ? data.IncidentDate : '<span class="underline" style="width: 80px;"></span>' #
            </div>
            <div class="clear"></div>

            <div class="row" style="margin-left: 0px; margin-right:0px; margin-top: 30px;padding: 0px 30px 0px 30px;">
                <div class="col-6 padding_column">
                    <div class="row justify-content-center border_bottom" style="padding-bottom: 0.5em;padding-top: 0.5em; margin-left: 0px; margin-right:0px;font-size:9px;"></div>
                    <div class="row justify-content-center" style="padding-bottom: 0.5em;padding-top: 0.5em; margin-left: 0px; margin-right:0px;font-size:10px;">Podpis Mocodawcy</div>
                </div>
                <div class="col-6 padding_column"></div>
            </div>

            <div class="row" style="margin-left: 0px; margin-right:0px; margin-top: 30px; padding: 0px 30px 0px 30px;">
                <div class="col-6 padding_column"></div>
                <div class="col-6 padding_column">
                    <div class="row justify-content-center" style="padding-bottom: 0.5em;padding-top: 0.5em; margin-left: 0px; margin-right:0px;font-size:10px;font-family: 'Museo_700';">
                        Oświadczam, że udzielam substytucji do prowadzenia sprawy przez:
                    </div>
                    <div class="row" style="padding-bottom: 0.5em;padding-top: 0.5em; margin-left: 0px; margin-right:0px;font-size:10px;">
                        1. adw. Bartosza Koszów,
                    </div>
                    <div class="row" style="padding-bottom: 0.5em;padding-top: 0.5em; margin-left: 0px; margin-right:0px;font-size:10px;">
                        2. <span class="underline" style="width: 200px;">
                    </div>
                </div>
            </div>

                <div class="row" style="margin-left: 0px; margin-right:0px; margin-top: 30px;padding: 0px 30px 0px 30px;">
                    <div class="col-5 padding_column">
                        <div class="row text-left" style="padding-bottom: 0.5em;padding-top: 0.5em; margin-left: 0px; margin-right:0px;font-size:10px;">
                            Wrocław, dnia <span class="underline" style="width: 100px;">
                        </div>
                    </div>
                    <div class="col-7 padding_column"></div>
                </div>
                <div class="row" style="margin-left: 0px; margin-right:0px; margin-top: 30px;padding: 0px 30px 0px 30px;">
                    <div class="col-5 padding_column">
                        <div class="row justify-content-center border_bottom" style="padding-bottom: 0.5em;padding-top: 0.5em; margin-left: 0px; margin-right:0px;font-size:9px;"></div>
                        <div class="row justify-content-center" style="padding-bottom: 0.5em;padding-top: 0.5em; margin-left: 0px; margin-right:0px;font-size:10px;">Adw. Andrzej Łebek</div>
                    </div>
                    <div class="col-2 padding_column"></div>
                    <div class="col-5 padding_column">
                        <div class="row justify-content-center border_bottom" style="padding-bottom: 0.5em;padding-top: 0.5em; margin-left: 0px; margin-right:0px;font-size:9px;"></div>
                        <div class="row justify-content-center" style="padding-bottom: 0.5em;padding-top: 0.5em; margin-left: 0px; margin-right:0px;font-size:10px;">Adw. Aniela Łebek</div>
                    </div>
                </div>


            <div class="contract_text" style="margin-top: 140px !important; font-size: 10px;">
                <div class="row border_bottom" style="margin-left:0px; margin-bottom: 10px;"></div>
                <div class="justify-content-center row" style="color:\#b72a20; font-family: 'Museo_700';">KANCELARIA ADWOKATÓW I RADCÓW PRAWNYCH A. ŁEBEK I WSPÓLNICY SPÓŁKA KOMANDYTOWA</div>
                <div class="justify-content-center row">ul. Wyścigowa 56i; 53-012 Wrocław, tel. +48 71 332 93 40, fax +48 71 332 93 43</div>
                <div class="justify-content-center row">e-mail: kancelaria@kairp-lebek.pl, www.kairp-lebek.pl</div>
                <div class="justify-content-center row">NIP: 899-25-79-696 REGON: 020356170 KRS:0000262469</div>
            </div>
            <div class="clear"></div>

            <div class="number_site_text">
                <div class="row justify-content-center" style="width: 100%; margin: 0px;">1/1</div>
            </div>
        </div>

        <!--POUCZENIE KLIENTA-->

        <div class="pdf_strona size-a4 pdf-page new-page">
            <div class="row margin_width" style="padding-top: 30px; padding-bottom: 10px;">
                <div class="logo_left">
                    <img src="<?php echo 'https://' . $_SERVER ['HTTP_HOST']; ?>/img/laur_small.png" />
                </div>
                <div class="logo_right">
                    <img src="<?php echo 'https://' . $_SERVER ['HTTP_HOST']; ?>/img/logo_small.png" />
                </div>
            </div>

            <span class="row contract_name" style="padding-bottom: 0px;"><p style="margin-bottom: 0px;">POUCZENIE O PRAWIE DO ODSTĄPIENIA </br>OD UMOWY ORAZ O INNYCH PRAWACH KONSUMENTA</p></span>
            <div class="row justify-content-center">(dla osoby fizycznej zawierającej z VOTUM S.A. umowę niezwiązaną bezpośrednio z jej działalnością gospodarczą lub zawodową)</div>
            <div class="row" style="margin-left: 0px; margin-right:0px;font-size:9px; margin-top:15px;">
                <div class="text_label_contract" style="width: 100%;"><span style="font-family: 'Museo_700';">Prawo do odstąpienia od umowy</span></div>
                <div class="text_label_contract" style="width: 100%; text-align: justify;">
                    Zgodnie z przepisami ustawy z dnia 30 maja 2014 r. o prawach konsumenta (Dz. U. z 2014 r., poz. 827), VOTUM informuje, że ma Pan/Pani
                    prawo odstąpić od niniejszej umowy w terminie 14 dni bez podania jakiejkolwiek przyczyny. Termin do odstąpienia od umowy kończy się
                    po upływie 14 dni od dnia zawarcia umowy. Aby skorzystać z prawa do odstąpienia od umowy, musi Pan/Pani poinformować VOTUM S.A.,
                    ul. Wyścigowa 56i, 53-012 Wrocław, tel. 71/ 33 93 400, faks. 71/ 33 93 403, e-mail: dok@votum-sa.pl o swojej decyzji w drodze jednoznacznego
                    oświadczenia, na przykład pismem wysłanym pocztą, faksem lub pocztą elektroniczną. Może Pan/Pani skorzystać z wzoru formularza odstąpienia
                    od umowy, jednak nie jest to obowiązkowe. Aby zachować termin do odstąpienia od umowy, wystarczy, aby wysłał/a Pan/Pani informację
                    dotyczącą wykonania przysługującego Panu/Pani prawa do odstąpienia od umowy przed upływem terminu do odstąpienia od umowy.
                </div>
                <div class="text_label_contract" style="width: 100%; text-align: justify;">
                    VOTUM informuje, że do zawartej przez Panią/Pana umowy nie mają zastosowania przesłanki wyłączenia prawa do odstąpienia od umowy
                    określone w art. 38 ustawy z dnia 30 maja 2014 r. o prawach konsumenta.
                </div>
            </div>

            <div class="row" style="margin-left: 0px; margin-right:0px;font-size:9px;">
                <div class="text_label_contract" style="width: 100%;"><span style="font-family: 'Museo_700';">Skutki odstąpienia od umowy</span></div>
                <div class="text_label_contract" style="width: 100%; text-align: justify;">
                    W przypadku odstąpienia od niniejszej umowy jest Pan/Pani zobowiązana/y do dokonania na własny koszt zwrotu VOTUM wynagrodzenia,
                    które otrzymał/a Pan/Pani na podstawie umowy. Zwrot powinien nastąpić na rachunek bankowy VOTUM, z którego wynagrodzenie zostało
                    przekazane niezwłocznie, nie później niż w terminie 14 dni od dnia, w którym Pan/i odstąpił/a od umowy.
                </div>
            </div>

            <div class="row" style="margin-left: 0px; margin-right:0px;font-size:9px;">
                <div class="text_label_contract" style="width: 100%;"><span style="font-family: 'Museo_700';">Pozasądowe sposoby rozwiązywania sporów</span></div>
                <div class="text_label_contract"  style="width: 100%; text-align: justify;">
                    W przypadku powstania sporu z VOTUM na tle umowy przelewu wierzytelności może Pan/Pani dobrowolnie i nieodpłatnie zwrócić się
                    opomoc do właściwego terenowo miejskiego lub powiatowego rzecznika konsumentów. Więcej informacji na temat pozasądowych spo-
                    sobów rozwiązywania sporów może Pan/Pani uzyskać u miejskiego lub powiatowego rzecznika konsumentów oraz w Urzędzie Ochrony
                    Konkurencji i Konsumentów, www.uokik.gov.pl.
                </div>
            </div>

            <div class="margin_10"></div>
            <div class="form_section" style="height: 415px;">
                <div class="red_margin"></div>
                <div class="form_section_body" style="padding-bottom:8px;">
                    <div class="body_form">
                        <div class="form_grey_body">
                            <div class="row" style="margin-left: 0px; margin-right:0px;">
                                <div class="label_contract" style="width: 100%; font-family: 'Museo_700'; font-weight: 700;">Wzór formularza odstąpienia od umowy:</div>
                            </div>
                            <div class="white_table">
                                <div class="row" style="margin-left: 0px; margin-right:0px; margin-top: 10px;padding: 0px 30px 0px 30px;">
                                    <div class="col-9 padding_column"></div>
                                    <div class="col-3 padding_column" style="margin-top:10px; margin-bottom: 30px;">
                                        <div class="row left-content-center" style="padding-bottom: 0em;padding-top: 0em; margin-left: 0px; margin-right:0px;font-size:10px;">VOTUM S.A.</div>
                                        <div class="row left-content-center" style="padding-bottom: 0em;padding-top: 0em; margin-left: 0px; margin-right:0px;font-size:10px;">ul. Wyścigowa 56i</div>
                                        <div class="row left-content-center" style="padding-bottom: 0em;padding-top: 0em; margin-left: 0px; margin-right:0px;font-size:10px;">53-012 Wrocław</div>
                                        <div class="row left-content-center" style="padding-bottom: 0em;padding-top: 0em; margin-left: 0px; margin-right:0px;font-size:10px;">fax: 71/ 33 93 403</div>
                                        <div class="row left-content-center" style="padding-bottom: 0em;padding-top: 0em; margin-left: 0px; margin-right:0px;font-size:10px;">dok@votum-sa.pl</div>
                                    </div>
                                </div>

                                <span class="row contract_name" style="padding-bottom: 5px;"><p style="margin-bottom: 0px;">Odstąpienie od umowy</p></span>
                                <div class="row justify-content-center" style="margin-bottom: 15px;font-size:10px;">(formularz ten należy wypełnić i odesłać tylko w przypadku chęci odstąpienia od umowy)</div>
                                <div class="row justify-content-center" style="paddnig-bottom: 5px;font-size:10px;">
                                    Niniejszym informuję o moim odstąpieniu od umowy przelewu wierzytelności zawartej na podstawie oferty</br>
                                    z dnia:
                                </div>

                                <div class="row" style="margin-left: 0px; margin-right:0px; margin-top: 30px;padding: 0px 30px 0px 30px;">
                                    <div class="col-5 padding_column"></div>
                                    <div class="col-7 padding_column">
                                        <div class="row justify-content-center border_bottom" style="padding-bottom: 0.5em;padding-top: 0.5em; margin-left: 0px; margin-right:0px;font-size:9px;"></div>
                                        <div class="row justify-content-center" style="padding-bottom: 1em;padding-top: 0.5em; margin-left: 0px; margin-right:0px;font-size:9px;">Imię i nazwisko konsumenta</div>

                                        <div class="row justify-content-center border_bottom" style="padding-bottom: 0.5em;padding-top: 0.5em; margin-left: 0px; margin-right:0px;font-size:9px;"></div>
                                        <div class="margin_10"></div>
                                        <div class="row justify-content-center border_bottom" style="padding-bottom: 0.5em;padding-top: 0.5em; margin-left: 0px; margin-right:0px;font-size:9px;"></div>
                                        <div class="row justify-content-center" style="padding-bottom: 1em;padding-top: 0.5em; margin-left: 0px; margin-right:0px;font-size:9px;">Adres zamieszkania konsumenta</div>

                                        <div class="row justify-content-center border_bottom" style="padding-bottom: 0.5em;padding-top: 0.5em; margin-left: 0px; margin-right:0px;font-size:9px;"></div>
                                        <div class="row justify-content-center" style="padding-bottom: 1em;padding-top: 0.5em; margin-left: 0px; margin-right:0px;font-size:9px;">Podpis konsumenta, data</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="red_margin"></div>
            </div>

            <div class="number_site_text">
                <div class="row justify-content-center" style="width: 100%; margin: 0px;">1/2</div>
            </div>
            <div class="print_text"><?php echo $instruction_client; ?></div>
        </div>

        <div class="pdf_strona size-a4 pdf-page new-page">
            <div class="row margin_width" style="padding-top: 30px; padding-bottom: 10px;">
                <div class="logo_left">
                    <img src="<?php echo 'https://' . $_SERVER ['HTTP_HOST']; ?>/img/laur_small.png" />
                </div>
                <div class="logo_right">
                    <img src="<?php echo 'https://' . $_SERVER ['HTTP_HOST']; ?>/img/logo_small.png" />
                </div>
            </div>


            <div class="row" style="margin-left: 0px; margin-right:0px; margin-top: 50px;padding: 0px 30px 0px 30px;">
                <div class="col-9 padding_column"></div>
                <div class="col-3 padding_column" style="margin-top:10px; margin-bottom: 30px;">
                    <div class="row left-content-center" style="padding-bottom: 0em;padding-top: 0em; margin-left: 0px; margin-right:0px;font-size:10px;">VOTUM S.A.</div>
                    <div class="row left-content-center" style="padding-bottom: 0em;padding-top: 0em; margin-left: 0px; margin-right:0px;font-size:10px;">ul. Wyścigowa 56i</div>
                    <div class="row left-content-center" style="padding-bottom: 0em;padding-top: 0em; margin-left: 0px; margin-right:0px;font-size:10px;">53-012 Wrocław</div>
                    <div class="row left-content-center" style="padding-bottom: 0em;padding-top: 0em; margin-left: 0px; margin-right:0px;font-size:10px;">fax: 71/ 33 93 403</div>
                    <div class="row left-content-center" style="padding-bottom: 0em;padding-top: 0em; margin-left: 0px; margin-right:0px;font-size:10px;">dok@votum-sa.pl</div>
                </div>
            </div>

            <span class="row contract_name" style="padding-bottom: 5px;"><p style="margin-bottom: 0px;">Odstąpienie od umowy</p></span>
            <div class="row justify-content-center" style="margin-bottom: 15px;font-size:10px;">(formularz ten należy wypełnić i odesłać tylko w przypadku chęci odstąpienia od umowy)</div>
            <div class="row justify-content-center" style="paddnig-bottom: 5px;font-size:10px;">
                Niniejszym informuję o moim odstąpieniu od umowy przelewu wierzytelności zawartej na podstawie oferty</br>
                z dnia:
            </div>

            <div class="row" style="margin-left: 0px; margin-right:0px; margin-top: 30px;padding: 0px 30px 0px 30px;">
                <div class="col-5 padding_column"></div>
                <div class="col-7 padding_column">
                    <div class="row justify-content-center border_bottom" style="padding-bottom: 0.5em;padding-top: 0.5em; margin-left: 0px; margin-right:0px;font-size:9px;"></div>
                    <div class="row justify-content-center" style="padding-bottom: 1em;padding-top: 0.5em; margin-left: 0px; margin-right:0px;font-size:9px;">Imię i nazwisko konsumenta</div>

                    <div class="row justify-content-center border_bottom" style="padding-bottom: 0.5em;padding-top: 0.5em; margin-left: 0px; margin-right:0px;font-size:9px;"></div>
                    <div class="margin_10"></div>
                    <div class="row justify-content-center border_bottom" style="padding-bottom: 0.5em;padding-top: 0.5em; margin-left: 0px; margin-right:0px;font-size:9px;"></div>
                    <div class="row justify-content-center" style="padding-bottom: 1em;padding-top: 0.5em; margin-left: 0px; margin-right:0px;font-size:9px;">Adres zamieszkania konsumenta</div>

                    <div class="row justify-content-center border_bottom" style="padding-bottom: 0.5em;padding-top: 0.5em; margin-left: 0px; margin-right:0px;font-size:9px;"></div>
                    <div class="row justify-content-center" style="padding-bottom: 1em;padding-top: 0.5em; margin-left: 0px; margin-right:0px;font-size:9px;">Podpis konsumenta, data</div>
                </div>
            </div>


            <div class="number_site_text">
                <div class="row justify-content-center" style="width: 100%; margin: 0px;">2/2</div>
            </div>
            <div class="print_text"><?php echo $instruction_client; ?></div>
        </div>

        <!--POUCZENIE DLA VOTUM-->

        <div class="pdf_strona size-a4 pdf-page new-page">
            <div class="row margin_width" style="padding-top: 30px; padding-bottom: 10px;">
                <div class="logo_left">
                    <img src="<?php echo 'https://' . $_SERVER ['HTTP_HOST']; ?>/img/laur_small.png" />
                </div>
                <div class="logo_right">
                    <img src="<?php echo 'https://' . $_SERVER ['HTTP_HOST']; ?>/img/logo_small.png" />
                </div>
            </div>

            <span class="row contract_name" style="padding-bottom: 0px;"><p style="margin-bottom: 0px;">POUCZENIE O PRAWIE DO ODSTĄPIENIA </br>OD UMOWY ORAZ O INNYCH PRAWACH KONSUMENTA</p></span>
            <div class="row justify-content-center">(dla osoby fizycznej zawierającej z VOTUM S.A. umowę niezwiązaną bezpośrednio z jej działalnością gospodarczą lub zawodową)</div>
            <div class="row" style="margin-left: 0px; margin-right:0px;font-size:9px; margin-top:15px;">
                <div class="text_label_contract" style="width: 100%;"><span style="font-family: 'Museo_700';">Prawo do odstąpienia od umowy</span></div>
                <div class="text_label_contract" style="width: 100%; text-align: justify;">
                    Zgodnie z przepisami ustawy z dnia 30 maja 2014 r. o prawach konsumenta (Dz. U. z 2014 r., poz. 827), VOTUM informuje, że ma Pan/Pani
                    prawo odstąpić od niniejszej umowy w terminie 14 dni bez podania jakiejkolwiek przyczyny. Termin do odstąpienia od umowy kończy się
                    po upływie 14 dni od dnia zawarcia umowy. Aby skorzystać z prawa do odstąpienia od umowy, musi Pan/Pani poinformować VOTUM S.A.,
                    ul. Wyścigowa 56i, 53-012 Wrocław, tel. 71/ 33 93 400, faks. 71/ 33 93 403, e-mail: dok@votum-sa.pl o swojej decyzji w drodze jednoznacznego
                    oświadczenia, na przykład pismem wysłanym pocztą, faksem lub pocztą elektroniczną. Może Pan/Pani skorzystać z wzoru formularza odstąpienia
                    od umowy, jednak nie jest to obowiązkowe. Aby zachować termin do odstąpienia od umowy, wystarczy, aby wysłał/a Pan/Pani informację
                    dotyczącą wykonania przysługującego Panu/Pani prawa do odstąpienia od umowy przed upływem terminu do odstąpienia od umowy.
                </div>
                <div class="text_label_contract" style="width: 100%; text-align: justify;">
                    VOTUM informuje, że do zawartej przez Panią/Pana umowy nie mają zastosowania przesłanki wyłączenia prawa do odstąpienia od umowy
                    określone w art. 38 ustawy z dnia 30 maja 2014 r. o prawach konsumenta.
                </div>
            </div>

            <div class="row" style="margin-left: 0px; margin-right:0px;font-size:9px;">
                <div class="text_label_contract" style="width: 100%;"><span style="font-family: 'Museo_700';">Skutki odstąpienia od umowy</span></div>
                <div class="text_label_contract" style="width: 100%; text-align: justify;">
                    W przypadku odstąpienia od niniejszej umowy jest Pan/Pani zobowiązana/y do dokonania na własny koszt zwrotu VOTUM wynagrodzenia,
                    które otrzymał/a Pan/Pani na podstawie umowy. Zwrot powinien nastąpić na rachunek bankowy VOTUM, z którego wynagrodzenie zostało
                    przekazane niezwłocznie, nie później niż w terminie 14 dni od dnia, w którym Pan/i odstąpił/a od umowy.
                </div>
            </div>

            <div class="row" style="margin-left: 0px; margin-right:0px;font-size:9px;">
                <div class="text_label_contract" style="width: 100%;"><span style="font-family: 'Museo_700';">Pozasądowe sposoby rozwiązywania sporów</span></div>
                <div class="text_label_contract"  style="width: 100%; text-align: justify;">
                    W przypadku powstania sporu z VOTUM na tle umowy przelewu wierzytelności może Pan/Pani dobrowolnie i nieodpłatnie zwrócić się
                    opomoc do właściwego terenowo miejskiego lub powiatowego rzecznika konsumentów. Więcej informacji na temat pozasądowych spo-
                    sobów rozwiązywania sporów może Pan/Pani uzyskać u miejskiego lub powiatowego rzecznika konsumentów oraz w Urzędzie Ochrony
                    Konkurencji i Konsumentów, www.uokik.gov.pl.
                </div>
            </div>

            <div class="margin_10"></div>
            <div class="form_section" style="height: 373px;">
                <div class="red_margin"></div>
                <div class="form_section_body" style="padding-bottom:8px;">
                    <div class="body_form">
                        <div class="form_grey_body">
                            <div class="row" style="margin-left: 0px; margin-right:0px;">
                                <div class="label_contract" style="width: 100%; font-family: 'Museo_700'; font-weight: 700;">Wzór formularza odstąpienia od umowy:</div>
                            </div>
                            <div class="white_table" style="height: 325px;">
                                <div class="row" style="margin-left: 0px; margin-right:0px; margin-top: 10px;padding: 0px 30px 0px 30px;">
                                    <div class="col-9 padding_column"></div>
                                    <div class="col-3 padding_column" style="margin-top:10px; margin-bottom: 30px;">
                                        <div class="row left-content-center" style="padding-bottom: 0em;padding-top: 0em; margin-left: 0px; margin-right:0px;font-size:10px;">VOTUM S.A.</div>
                                        <div class="row left-content-center" style="padding-bottom: 0em;padding-top: 0em; margin-left: 0px; margin-right:0px;font-size:10px;">ul. Wyścigowa 56i</div>
                                        <div class="row left-content-center" style="padding-bottom: 0em;padding-top: 0em; margin-left: 0px; margin-right:0px;font-size:10px;">53-012 Wrocław</div>
                                        <div class="row left-content-center" style="padding-bottom: 0em;padding-top: 0em; margin-left: 0px; margin-right:0px;font-size:10px;">fax: 71/ 33 93 403</div>
                                        <div class="row left-content-center" style="padding-bottom: 0em;padding-top: 0em; margin-left: 0px; margin-right:0px;font-size:10px;">dok@votum-sa.pl</div>
                                    </div>
                                </div>

                                <span class="row contract_name" style="padding-bottom: 5px;"><p style="margin-bottom: 0px;">Odstąpienie od umowy</p></span>
                                <div class="row justify-content-center" style="margin-bottom: 15px;font-size:10px;">(formularz ten należy wypełnić i odesłać tylko w przypadku chęci odstąpienia od umowy)</div>
                                <div class="row justify-content-center" style="paddnig-bottom: 5px;font-size:10px;">
                                    Niniejszym informuję o moim odstąpieniu od umowy przelewu wierzytelności zawartej na podstawie oferty</br>
                                    z dnia:
                                </div>

                                <div class="row" style="margin-left: 0px; margin-right:0px; margin-top: 30px;padding: 0px 30px 0px 30px;">
                                    <div class="col-5 padding_column"></div>
                                    <div class="col-7 padding_column">
                                        <div class="row justify-content-center border_bottom" style="padding-bottom: 0.5em;padding-top: 0.5em; margin-left: 0px; margin-right:0px;font-size:9px;"></div>
                                        <div class="row justify-content-center" style="padding-bottom: 1em;padding-top: 0.5em; margin-left: 0px; margin-right:0px;font-size:9px;">Imię i nazwisko konsumenta</div>

                                        <div class="row justify-content-center border_bottom" style="padding-bottom: 0.5em;padding-top: 0.5em; margin-left: 0px; margin-right:0px;font-size:9px;"></div>
                                        <div class="margin_10"></div>
                                        <div class="row justify-content-center border_bottom" style="padding-bottom: 0.5em;padding-top: 0.5em; margin-left: 0px; margin-right:0px;font-size:9px;"></div>
                                        <div class="row justify-content-center" style="padding-bottom: 1em;padding-top: 0.5em; margin-left: 0px; margin-right:0px;font-size:9px;">Adres zamieszkania konsumenta</div>

                                        <div class="row justify-content-center border_bottom" style="padding-bottom: 0.5em;padding-top: 0.5em; margin-left: 0px; margin-right:0px;font-size:9px;"></div>
                                        <div class="row justify-content-center" style="padding-bottom: 1em;padding-top: 0.5em; margin-left: 0px; margin-right:0px;font-size:9px;">Podpis konsumenta, data</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="red_margin"></div>
            </div>
            <div class="row" style="margin-left: 0px; margin-right:0px;font-size:10px;">
                <div class="text_label_contract" style="width: 100%;">Potwierdzam otrzymanie pouczenia o jednakowej treści oraz formularza odstąpienia od umowy o treści zgodnej z zamieszczonym wyżej wzorem.
                </div>
            </div>

            <div class="row" style="margin-left: 0px; margin-right:0px; margin-top: 20px;padding: 0px 30px 0px 30px;">
                <div class="col-8 padding_column"></div>
                <div class="col-4 padding_column">
                    <div class="row justify-content-center border_bottom" style="padding-bottom: 0.5em;padding-top: 0.5em; margin-left: 0px; margin-right:0px;font-size:9px;"></div>
                    <div class="row justify-content-center" style="padding-bottom: 0.5em;padding-top: 0.5em; margin-left: 0px; margin-right:0px;font-size:9px;">Podpis konsumenta</div>
                </div>
            </div>

            <div class="number_site_text">
                <div class="row justify-content-center" style="width: 100%; margin: 0px;">1/1</div>
            </div>
            <div class="print_text"><?php echo $instruction_votum; ?></div>
        </div>

    </div>

    <script>

        var viewModel = kendo.observable({
            isVisible: true,
            isEnabled: true,
            onClick: function() {
                kendo.drawing.drawDOM(".printWindow", {
                    forcePageBreak: ".new-page",
                    paperSize: "A4",
                    margin: "0cm",
                    scale: 1.0
                }).then(function (group) {
                    kendo.drawing.pdf.saveAs(group, "Bona.pdf");
                });
            }
        });
        kendo.bind($(".printContractBona"), viewModel);

    <\/script>
</script>