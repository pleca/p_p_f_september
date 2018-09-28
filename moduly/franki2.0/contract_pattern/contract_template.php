<?php
$contract_layout_number = 'PG-2-21-F8/2018-06-15';
$aggreement_layout_number = 'PG-2-21-F9/2018-05-24';
$enablement_votum_layout_number = 'PG-2-21-F2/2018-06-21';
$instruction_client = 'PG-2-21-F4/2018-05-24';
?>

<script type="x/kendo-template" id="tmpPrint">

        <button class="export-pdf printContract"
                data-role="button"
                data-icon="print"
                data-bind="visible: isVisible, enabled: isEnabled, events: { click: onClick }"
                style="width: 180px">Pokaż/Drukuj</button>

        <div class="print-contract">


            # for (var i = 0; i < 2; i++) { #

            <!--UMOWA x2-->

            <div class="pdf_strona size-a4 pdf-page">
                <div class="row margin_width" style="margin-top: 20px;">
                    <div class="col-4">
                        <div style="margin-bottom: 5px;">
                            <div class="box" style="width: 100%;font-size: 10px; padding-top: 5px; padding-left:2px;">#= (data.agent_number != null && data.agent_number != '') ? data.agent_number : '' #</div>
                            <span class="under_small_label">IDENTYFIKATOR PRZEDSTAWICIELA</span>
                        </div>
                    </div>
                    <div class="col-4"></div>
                    <div class="col-4">
                        <div style="margin-bottom: 5px;">
                            <img src="<?php echo 'https://' . $_SERVER ['HTTP_HOST']; ?>/img/logo_small.png" />
                        </div>
                    </div>
                </div>
                <div class="row margin_width">
                    <div class="col-4">
                        <div style="margin-bottom: 5px;">
                            <div class="box" style="width: 100%;font-size: 10px; padding-top: 5px; padding-left:2px;">#= (data.unit_number != null && data.unit_number != '') ? data.unit_number : '' #</div>
                            <span class="under_small_label">KOD JEDNOSTKI</span>
                        </div>
                    </div>
                    <div class="col-4">
                        <div style="margin-bottom: 5px;">
                            <div class="box" style="width: 100%;font-size: 10px; padding-top: 5px; padding-left:2px;">#= (data.consultant_number != null && data.consultant_number != '') ? data.consultant_number : '' #</div>
                            <span class="under_small_label">KOD KONSULTANTA</span>
                        </div>
                    </div>
                </div>


                <span class="row contract_name">
                    <p>
                        UMOWA KOMPLEKSOWEJ OBSŁUGI SPRAWY BANKOWEJ
                        #if(data.ContractType == '3'){#
                            (BASIC)
                            #}else if (data.ContractType == '2') {#
                            (PREMIUM)
                            #}else if (data.ContractType == '1') {#
                            (VIP)
                            #}#
                    </p>
                </span>
                <div class="row justify-content-center" style="padding-bottom: 0.5em;padding-top: 0em; margin-left: 0px; margin-right:0px;font-size:8px;">zawarta w dniu #= (data.add_date != null && data.add_date != '') ? data.add_date : '<span class="underline" style="width: 50px;"></span>' # r. przez: </div>
                <div class="form_section_client" style="height: 525px;">
                    <div class="red_margin"></div>
                    <div class="form_section_body">
                        <div class="body_form">
                            <div class="form_grey_body">
                                <div class="row" style="margin-left: 0px; margin-right:0px;">
                                    <div class="label_contract" style="width: 100%; font-family: 'Museo_700'; font-weight: 700;">Zleceniodawca I</div>
                                </div>
                                <div class="row" style="padding-bottom: 0.5em; margin-left: 0px; margin-right:0px;">
                                    <div class="col-6 padding_column">
                                        <input name="FirstNameIPrint" type="text" class="k-input k-textbox" value="#= (data.FirstName1 != null && data.FirstName1 != '') ? data.FirstName1 : '' #"/>
                                        <span class="under_small_label">imię</span>
                                    </div>
                                    <div class="col-6 padding_column">
                                        <input name="LastName1Print" type="text" class="k-input k-textbox" value="#= (data.LastName1 != null && data.LastName1 != '') ? data.LastName1 : '' #"/>
                                        <span class="under_small_label">nazwisko</span>
                                    </div>
                                </div>
                                <div class="row" style="padding-bottom: 0.5em; margin-left: 0px; margin-right:0px;">
                                    <div class="label_contract" style="width: 100%; font-family: 'Museo_700'; font-weight: 700;">Adres zameldowania zleceniodawcy</div>
                                    <div class="col-6 padding_column">
                                        <input name="StreetI" type="text" class="k-input k-textbox" value="#= (data.Street1 != null && data.Street1 != '') ? data.Street1 : '' #"/>
                                        <span class="under_small_label">ulica</span>
                                    </div>
                                    <div class="col-2 padding_column">
                                        <input name="HomeNumberI" type="text" class="k-input k-textbox" value="#= (data.Home1 != null && data.Home1 != '') ? data.Home1 : '' #"/>
                                        <span class="under_small_label">nr domu</span>
                                    </div>
                                    <div class="col-2 padding_column">
                                        <input name="ApartmentNumberI" type="text" class="k-input k-textbox" value="#= (data.Apartment1 != null && data.Apartment1 != '') ? data.Apartment1 : '' #"/>
                                        <span class="under_small_label">nr mieszkania</span>
                                    </div>
                                    <div class="col-2 padding_column">
                                        <input name="PostCodeI" type="text" class="k-input k-textbox" value="#= (data.PostCode1 != null && data.PostCode1 != '') ? data.PostCode1 : '' #"/>
                                        <span class="under_small_label">kod pocztowy</span>
                                    </div>
                                </div>
                                <div class="row" style="padding-bottom: 0.5em; margin-left: 0px; margin-right:0px;">
                                    <div class="col-4 padding_column">
                                        <input name="CityI" type="text" class="k-input k-textbox" value="#= (data.City1 != null && data.City1 != '') ? data.City1 : '' #"/>
                                        <span class="under_small_label">miejscowość</span>
                                    </div>
                                    <div class="col-4 padding_column">
                                        <input name="PESELI" type="text" class="k-input k-textbox" value="#= (data.PESEL1 != null && data.PESEL1 != '') ? data.PESEL1 : '' #"/>
                                        <span class="under_small_label">PESEL</span>
                                    </div>
                                    <div class="col-4 padding_column">
                                        <input name="IdentityCardI" type="text" class="k-input k-textbox" value="#= (data.IdNr1 != null && data.IdNr1 != '') ? data.IdNr1 : '' #"/>
                                        <span class="under_small_label">seria i numer dowodu osobistego</span>
                                    </div>
                                </div>
                                <div class="row" style="padding-bottom: 0.5em; margin-left: 0px; margin-right:0px;">
                                    <div class="col-4 padding_column">
                                        <input name="PhoneI" type="text" class="k-input k-textbox" value="#= (data.Phone1 != null && data.Phone1 != '') ? data.Phone1 : '' #"/>
                                        <span class="under_small_label">telefon*</span>
                                    </div>
                                    <div class="col-8 padding_column">
                                        <input name="EmailI" type="text" class="k-input k-textbox" value="#= (data.Email1 != null && data.Email1 != '') ? data.Email1 : '' #"/>
                                        <span class="under_small_label">e-mail*</span>
                                    </div>
                                </div>
                                <div class="row" style="margin-left: 0px; margin-right:0px;">
                                    <div class="label_contract" style="width: 100%; font-family: 'Museo_700'; font-weight: 700;">oraz</div>
                                    <div class="label_contract" style="width: 100%; font-family: 'Museo_700'; font-weight: 700;">Zleceniodawca II</div>
                                </div>
                                <div class="row" style="padding-bottom: 0.5em; margin-left: 0px; margin-right:0px;">
                                    <div class="col-6 padding_column">
                                        <input name="FirstNameIIPrint" type="text" class="k-input k-textbox" value="#= (data.FirstName2 != null && data.FirstName2 != '') ? data.FirstName2 : '' #"/>
                                        <span class="under_small_label">imię</span>
                                    </div>
                                    <div class="col-6 padding_column">
                                        <input name="LastName1IPrint" type="text" class="k-input k-textbox" value="#= (data.LastName2 != null && data.LastName2 != '') ? data.LastName2 : '' #"/>
                                        <span class="under_small_label">nazwisko</span>
                                    </div>
                                </div>
                                <div class="row" style="padding-bottom: 0.5em; margin-left: 0px; margin-right:0px;">
                                    <div class="label_contract" style="width: 100%; font-family: 'Museo_700'; font-weight: 700;">Adres zameldowania zleceniodawcy</div>
                                    <div class="col-6 padding_column">
                                        <input name="StreetII" type="text" class="k-input k-textbox" value="#= (data.Street2 != null && data.Street2 != '') ? data.Street2 : '' #"/>
                                        <span class="under_small_label">ulica</span>
                                    </div>
                                    <div class="col-3 padding_column">
                                        <input name="HomeNumberII" type="text" class="k-input k-textbox" value="#= (data.Home2 != null && data.Home2 != '') ? data.Home2 : '' #"/>
                                        <span class="under_small_label">nr domu / mieszkania</span>
                                    </div>
                                    <div class="col-3 padding_column">
                                        <input name="PostCodeII" type="text" class="k-input k-textbox" value="#= (data.PostCode2 != null && data.PostCode2 != '') ? data.PostCode2 : '' #"/>
                                        <span class="under_small_label">kod pocztowy</span>
                                    </div>
                                </div>
                                <div class="row" style="padding-bottom: 0.5em; margin-left: 0px; margin-right:0px;">
                                    <div class="col-4 padding_column">
                                        <input name="CityII" type="text" class="k-input k-textbox" value="#= (data.City2 != null && data.City2 != '') ? data.City2 : '' #"/>
                                        <span class="under_small_label">miejscowość</span>
                                    </div>
                                    <div class="col-4 padding_column">
                                        <input name="PESELII" type="text" class="k-input k-textbox" value="#= (data.PESEL2 != null && data.PESEL2 != '') ? data.PESEL2 : '' #"/>
                                        <span class="under_small_label">PESEL</span>
                                    </div>
                                    <div class="col-4 padding_column">
                                        <input name="IdentityCardII" type="text" class="k-input k-textbox" value="#= (data.IdNr2 != null && data.IdNr2 != '') ? data.IdNr2 : '' #"/>
                                        <span class="under_small_label">seria i numer dowodu osobistego</span>
                                    </div>
                                </div>
                                <div class="row" style="padding-bottom: 0.5em; margin-left: 0px; margin-right:0px;">
                                    <div class="col-4 padding_column">
                                        <input name="PhoneII" type="text" class="k-input k-textbox" value="#= (data.Phone2 != null && data.Phone2 != '') ? data.Phone2 : '' #"/>
                                        <span class="under_small_label">telefon*</span>
                                    </div>
                                    <div class="col-8 padding_column">
                                        <input name="EmailII" type="text" class="k-input k-textbox" value="#= (data.Email2 != null && data.Email2 != '') ? data.Email2 : '' #"/>
                                        <span class="under_small_label">e-mail*</span>
                                    </div>
                                </div>
                                <div class="row" style="padding-bottom: 0.5em; margin-left: 0px; margin-right:0px;">
                                    <div class="label_contract" style="width: 100%; font-family: 'Museo_700'; font-weight: 700;">Adres korespondencyjny:</div>
                                    <div class="col-6 padding_column">
                                        <input name="Street" type="text" class="k-input k-textbox" value="#= (data.ForrwardingStreet != null && data.ForrwardingStreet != '') ? data.ForrwardingStreet : '' #"/>
                                        <span class="under_small_label">ulica</span>
                                    </div>
                                    <div class="col-3 padding_column">
                                        <input name="HomeNumber" type="text" class="k-input k-textbox" value="#= (data.ForrwardingHome != null && data.ForrwardingHome != '') ? data.ForrwardingHome : '' #"/>
                                        <span class="under_small_label">nr domu / mieszkania</span>
                                    </div>
                                    <div class="col-3 padding_column">
                                        <input name="PostCode" type="text" class="k-input k-textbox" value="#= (data.ForrwardingPostalCode != null && data.ForrwardingPostalCode != '') ? data.ForrwardingPostalCode : '' #"/>
                                        <span class="under_small_label">kod pocztowy</span>
                                    </div>
                                </div>
                                <div class="row" style="padding-bottom: 0.5em; margin-left: 0px; margin-right:0px;">
                                    <div class="col-4 padding_column">
                                        <input name="City" type="text" class="k-input k-textbox" value="#= (data.ForrwardingCity != null && data.ForrwardingCity != '') ? data.ForrwardingCity : '' #"/>
                                        <span class="under_small_label">miejscowość</span>
                                    </div>
                                </div>
                                <div class="clear"></div>
                                <div class="row" style="padding-bottom: 0.5em; margin-left: 0px; margin-right:0px;">
                                    <div class="label_contract" style="width: 100%; font-family: 'Museo_300';font-size: 8px !important;">zwanego/zwanych dalej <span style="font-family: 'Museo_700'; font-weight: 700;">KLIENTEM</span></div>
                                </div>
                                <div class="clear"></div>
                                <div class="row" style="padding-bottom: 0.5em; margin-left: 0px; margin-right:0px;">
                                    <span class="under_small_label" style="width: 100%; font-family: 'Museo_700'; font-weight: 700;text-align:center;">a</span>
                                </div>
                                <div class="clear"></div>
                                <div class="row" style="padding-bottom: 0em; margin-left: 0px; margin-right:0px;">
                                    <div class="label_contract" style="width: 100%; font-family: 'Museo_700'; font-weight: 700;">ZLECENIOBIORCĄ:</div>
                                </div>
                                <div class="clear"></div>
                                <div class="row" style="padding-bottom: 0.5em; margin-left: 0px; margin-right:0px;">
                                    <div class="text_label_contract" style="width: 100%; padding-left: 10px; padding-right:10px; line-height:10px;">
                                        VOTUM S.A. z siedzibą we Wrocławiu 53-012, ul. Wyścigowa 56i, tel. 71/ 33 93 400, faks. 71/ 33 93 403, e-mail: dok@votum-sa.pl, zarejestrowana
                                        w Sądzie Rejonowym dla Wrocławia Fabrycznej VI Wydział Gospodarczy Krajowego Rejestru Sądowego pod numerem KRS: 0000243252,
                                        REGON: 020136043, NIP: 899-25-49-057, KAPITAŁ ZAKŁADOWY: 1 200 000 zł. wpłacony w całości.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="red_margin"></div>
                </div>
                <div class="clear"></div>
                <div class="contract_text" style="padding-top: 5px;">
                        * numer telefonu dedykowany do otrzymywania powiadomień z informacjami o etapach sprawy drogą wiadomości sms,
                        </br>
                        ** adres e-mail dedykowany do otrzymywania wiadomości z informacjami o etapach sprawy
                </div>
                <div class="margin_10"></div>
                <div class="capture">
                    <div class="red_margin_capture"></div>
                    <div class="number_capture"> I </div>
                    <div class="capture_title">PRZEDMIOT UMOWY</div>
                </div>
                <div class="contract_text justyfy">
                    <p>Zleceniobiorca (zwany dalej VOTUM) zobowiązuje się na zlecenie Zleceniodawcy do powzięcia czynności polegających na dochodzeniu
                        roszczeń od <span>#= (data.BankName != null && data.BankName != '') ? data.BankName : '<span class="underline" style="width: 120px;"></span>' #</span> (zwanego dalej: Zobowiązanym) dotyczących umowy kredytu hipotecznego
                        lub konsolidacyjnego numer <span>#= (data.BankContractNumber != null && data.BankContractNumber != '') ? data.BankContractNumber : '<span class="underline" style="width: 80px;"></span>' #</span> waloryzowanego bądź denominowanego do waluty obcej w związku z zastosowaną przez bank konstrukcją indeksacji oraz ubezpieczeń z nią powiązanych.</p>
                </div>
                <div class="number_site_text">
                    <div class="row justify-content-center" style="width: 100%; margin: 0px;">1/4</div>
                </div>
                <div class="print_text"><?php echo $contract_layout_number; ?></div>
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

                <div class="margin_10"></div>
                <div class="capture">
                    <div class="red_margin_capture"></div>
                    <div class="number_capture"> II </div>
                    <div class="capture_title">GWARANCJE VOTUM</div>
                </div>

                <div class="contract_text">
                    <div style="font-size:8px !important;margin-bottom: 0px!important">
                        <li>
                            Votum <span style="font-family: 'Museo_700';font-weight: 700;">gwarantuje</span>, że:
                        </li>
                        <li>
                            <div class="number">a.</div>
                            <div class="li_content">
                                dokona szczegółowej analizy otrzymanej od Klienta dokumentacji bankowej,
                            </div>
                        </li>
                        <li>
                            <div class="number">b.</div>
                            <div class="li_content">
                                przygotuje i przekaże Klientowi wniosek o wydanie dokumentacji niezbędnej do wykonania umowy
                            </div>
                        </li>
                        <li>
                            <div class="number">c.</div>
                            <div class="li_content">
                                w przypadku odmowy wydania dokumentacji przez Zobowiązanego przygotuje i przekaże Klientowi reklamację,
                            </div>
                        </li>
                        <li>
                            <div class="number">d.</div>
                            <div class="li_content">
                                w przypadku odmowy wydania przez Zobowiązanego dokumentacji po złożonej uprzednio reklamacji przygotuje oraz złoży skargę do
                                Rzecznika Finansowego,
                            </div>
                        </li>
                        <li>
                            <div class="number">e.</div>
                            <div class="li_content">
                                dokona oszacowania należnego Klientowi roszczenia z tytułu nadpłaconych rat, poprzez analizę wysokości każdej pojedynczej
                                zapłaconej przez Klienta na rzecz Zobowiązanego raty kapitałowo-odsetkowej i porównanie jej z ratą kapitałowo-odsetkową
                                niezawierającą klauzuli waloryzacyjnej do waluty obcej, z uwzględnieniem ilości uruchomionych transz, procentowej wartości danej
                                transzy w stosunku do kursu waluty obcej, po jakim została uruchomiona oraz wpływu kursu uruchomienia każdej z pojedynczych
                                transz na średni kurs udzielenia całego kredytu, mając na względzie wiedzę dostępną na dzień oszacowania,
                            </div>
                        </li>
                        <li>
                            <div class="number">f.</div>
                            <div class="li_content">
                                dokona analizy zasadności wystąpienia wobec Zobowiązanego z roszczeniem o zwrot kwoty uiszczonej tytułem ubezpieczenia niskiego
                                wkładu własnego,
                            </div>
                        </li>
                        <li>
                            <div class="number">g.</div>
                            <div class="li_content">
                                dokona analizy zasadności wystąpienia wobec Zobowiązanego z roszczeniem o zwrot proporcjonalnej, nienależnej części składki
                                uiszczonej na ubezpieczenie pomostowe,
                            </div>
                        </li>
                        <li>
                            <div class="number">h.</div>
                            <div class="li_content">
                                w uzasadnionych przypadkach przedstawi Klientowi alternatywne roszczenie o unieważnienie umowy kredytowej,
                            </div>
                        </li>
                        <li>
                            <div class="number">i.</div>
                            <div class="li_content">
                                w uzasadnionych przypadkach złoży wniosek o wszczęcie postępowania w sprawie rozwiązywania sporów między Klientem a podmiotem
                                rynku finansowego bądź skargę do Rzecznika Finansowego,
                            </div>
                        </li>
                        <li>
                            <div class="number">j.</div>
                            <div class="li_content">
                                w uzasadnionych przypadkach złoży umowę o przeprowadzenie mediacji w centrum mediacji Sądu Polubownego przy Komisji Nadzoru
                                Finansowego,
                            </div>
                        </li>
                        <li>
                            <div class="number">k.</div>
                            <div class="li_content">
                                wyłoży w imieniu Klienta opłatę w kwocie 50 zł (słownie: pięćdziesiąt złotych) za złożenie wniosku o wszczęcie postępowania w sprawie
                                rozwiązywania sporów między Klientem a podmiotem rynku finansowego do Rzecznika Finansowego,
                            </div>
                        </li>
                        <li>
                            <div class="number">l.</div>
                            <div class="li_content">
                                wyłoży w imieniu Klienta opłatę w kwocie 50 zł (słownie: pięćdziesiąt złotych) za złożenie umowy o przeprowadzenie mediacji w centrum
                                mediacji Sądu Polubownego przy Komisji Nadzoru Finansowego,
                            </div>
                        </li>
                        <li>
                            <div class="number">m.</div>
                            <div class="li_content">
                                w uzasadnionych przypadkach przygotuje dokumentację do przeprowadzenia postępowania o zawezwanie do próby ugodowej przeciwko
                                Zobowiązanemu w terminie do 14 dni licząc od dnia uzupełnienia przez Klienta dokumentacji niezbędnej do prawidłowego złożenia
                                takiego wniosku,
                            </div>
                        </li>
                        <li>
                            <div class="number">n.</div>
                            <div class="li_content">
                                przekaże Klientowi na wskazany przez niego rachunek uzyskane na jego rzecz środki w terminie 7 dni roboczych od ich wpływu na
                                rachunek VOTUM, po uprzednim potrąceniu wynagrodzenia i poniesionych kosztów,
                            </div>
                        </li>
                        <li>
                            <div class="number">o.</div>
                            <div class="li_content">
                                nie zawrze ugody ze Zobowiązanym bez uprzedniej pisemnej zgody Klienta,
                            </div>
                        </li>
                        <li>
                            <div class="number">p.</div>
                            <div class="li_content">
                                powództwo o zapłatę zostanie wytoczone tylko w przypadku zgody obu stron umowy, w tym pisemnej zgody Klienta,
                            </div>
                        </li>
                        <li>
                            <div class="number">q.</div>
                            <div class="li_content">
                                po prawomocnym zakończeniu postępowania sądowego przedstawi Klientowi rekomendację w zakresie zasadności skierowania
                                wobec Zobowiązanego dodatkowego roszczenia o obniżenie salda zadłużenia z tytułu umowy kredytowej,
                            </div>
                        </li>
                        <li>
                            <div class="number">r.</div>
                            <div class="li_content">
                                będzie systematycznie informować Klienta o przebiegu wykonania umowy,
                            </div>
                        </li>
                        <li>
                            <div class="number">s.</div>
                            <div class="li_content">
                                udzieli odpowiedzi na złożoną reklamację w terminie 21 dni od dnia jej otrzymania.
                            </div>
                        </li>
                    </div>
                </div>

                <div class="clear"></div>
                <div class="margin_10"></div>
                <div class="capture align-middle">
                    <div class="red_margin_capture"></div>
                    <div class="number_capture"> III </div>
                    <div class="capture_title">OBSŁUGA EKSPERCKA</div>
                </div>
                <div class="contract_text">
                    <div style="font-size:8px !important;margin-bottom: 0px!important">
                        <li>
                            Votum w ramach uzyskanego od Klienta wynagrodzenia i w zakresie niezbędnym do wykonania umowy, pokrywa koszty wskazanego przez
                            siebie:
                        </li>
                        <li>
                            <div class="number">a.</div>
                            <div class="li_content">
                                specjalisty obsługi spraw finansowych na każdym etapie wykonania umowy,
                            </div>
                        </li>
                        <li>
                            <div class="number">b.</div>
                            <div class="li_content">
                                specjalisty w zakresie szacowania roszczeń w postępowaniu przedsądowym,
                            </div>
                        </li>
                        <li>
                            <div class="number">c.</div>
                            <div class="li_content">
                                pełnomocnika Klienta w postępowaniu mediacyjnym,
                            </div>
                        </li>
                        <li>
                            <div class="number">d.</div>
                            <div class="li_content">
                                adwokata lub radcy prawnego reprezentującego Klienta w postępowaniu przedsądowym, pojednawczym, sądowym oraz egzekucyjnym.
                            </div>
                        </li>
                    </div>
                </div>

                <div class="clear"></div>
                <div class="margin_10"></div>
                <div class="capture align-middle">
                    <div class="red_margin_capture"></div>
                    <div class="number_capture"> IV </div>
                    <div class="capture_title">WYNAGRODZENIE VOTUM</div>
                </div>

                <div class="contract_text">
                    <div style="font-size:8px !important;margin-bottom: 0px!important">
                        <li>
                            <div class="number">1.</div>
                            <div class="li_content">
                                VOTUM zobowiązuje się do przekazania Klientowi uzyskanych świadczeń w terminie 7 dni roboczych od dnia ich otrzymania,
                                po uprzednim potrąceniu należnego VOTUM wynagrodzenia i poniesionych wydatków na wskazany przez Zleceniodawcę rachunek
                                bankowy:
                            </div>
                        </li>
                    </div>
                </div>
                <div class="clear"></div>
                <div class="margin_10"></div>
                <div class="form_section_phone" style="height: 130px;">
                    <div class="red_margin"></div>
                    <div class="form_section_body" style="padding-bottom:8px;">
                        <div class="body_form">
                            <div class="form_grey_body">
                                <div class="row" style="padding-bottom: 0em; margin-left: 0px; margin-right:0px;">
                                    <div class="col-12 padding_column">
                                        <input name="AccountNumber" type="text" class="k-input k-textbox" value="#= (data.CustomerAccountNumber != '' && data.CustomerAccountNumber != null) ? data.CustomerAccountNumber : '' #"/>
                                        <span class="under_small_label">nr rachunku bankowego</span>
                                    </div>
                                </div>
                                <div class="row" style="padding-bottom: 0em; margin-left: 0px; margin-right:0px;">
                                    <div class="col-6 padding_column">
                                        <input name="CustomerFirstName" type="text" class="k-input k-textbox" value="#= (data.CustomerFirstname != '' && data.CustomerFirstname != null) ? data.CustomerFirstname : '' #"/>
                                        <span class="under_small_label">imię</span>
                                    </div>
                                    <div class="col-6 padding_column">
                                        <input name="CustomerLastName" type="text" class="k-input k-textbox" value="#= (data.CustomerLastname != '' && data.CustomerLastname != null) ? data.CustomerLastname : '' #"/>
                                        <span class="under_small_label">nazwisko</span>
                                    </div>
                                </div>
                                <div class="row" style="padding-bottom: 0em; margin-left: 0px; margin-right:0px;">
                                    <div class="col-6 padding_column">
                                        <input name="CustomerStreet" type="text" class="k-input k-textbox" value="#= (data.CustomerStreet != '' && data.CustomerStreet != null) ? data.CustomerStreet : '' #"/>
                                        <span class="under_small_label">ulica</span>
                                    </div>
                                    <div class="col-3 padding_column">
                                        <input name="CustomerStreetNumber" type="text" class="k-input k-textbox" value="#= (data.CustomerStreetNumber != '' && data.CustomerStreetNumber != null) ? data.CustomerStreetNumber : '' #"/>
                                        <span class="under_small_label">nr domu/mieszkania</span>
                                    </div>
                                    <div class="col-3 padding_column">
                                        <input name="CustomerPostCode" type="text" class="k-input k-textbox" value="#= (data.CustomerPostalCode != '' && data.CustomerPostalCode != null) ? data.CustomerPostalCode : '' #"/>
                                        <span class="under_small_label">kod pocztowy</span>
                                    </div>
                                </div>
                                <div class="row" style="padding-bottom: 0em; margin-left: 0px; margin-right:0px;">
                                    <div class="col-4 padding_column">
                                        <input name="CustomerCity" type="text" class="k-input k-textbox" value="#= (data.CustomerCity != '' && data.CustomerCity != null) ? data.CustomerCity : '' #"/>
                                        <span class="under_small_label">miejscowość</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="red_margin"></div>
                </div>

                <div class="number_site_text">
                    <div class="row justify-content-center" style="width: 100%; margin: 0px;">2/4</div>
                </div>
                <div class="print_text"><?php echo $contract_layout_number; ?></div>
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
                                Klient upoważnia VOTUM do odbioru wszelkich uzyskanych w jego imieniu świadczeń w ramach wykonania niniejszej umowy.
                            </div>
                        </li>
                        <li>
                            <div class="number">3.</div>
                            <div class="li_content">
                                VOTUM przysługuje wynagrodzenie w kwocie <span style="font-family: 'Museo_700';font-weight: 700;">
                            #if(data.ContractType == '3'){#
                            3.075
                            #}else if (data.ContractType == '2') {#
                            6.150
                            #}else if (data.ContractType == '1') {#
                            12.300
                            #}#
                            zł. </span>
                                (słownie:
                                #if(data.ContractType == '3'){#
                                <?php echo slownie(intval(3075)); ?>
                                #}else if (data.ContractType == '2') {#
                                <?php echo slownie(intval(6150)); ?>
                                #}else if (data.ContractType == '1') {#
                                <?php echo slownie(intval(12300)); ?>
                                #}#
                                ) brutto (w tym podatek od
                                towarów i usług VAT w wysokości 23%) za analizę merytoryczną dokumentacji, roszczeń Klienta, przeprowadzenie postępowania
                                przedsądowego, przygotowanie dokumentacji do postępowania pojednawczego, sądowego oraz egzekucyjnego.
                            </div>
                        </li>
                        <li>
                            <div class="number">4.</div>
                            <div class="li_content">
                                Klient uiszcza z góry wynagrodzenie, o którym mowa w ust. 3 powyżej, na rachunek bankowy VOTUM o numerze:
                                40 1050 1575 1000 0023 1250 6476, w terminie 7 dni od dnia przekazania Klientowi informacji VOTUM o zarejestrowaniu sprawy
                                i nadaniu jej numeru, który należy podać w tytule przelewu. VOTUM może wstrzymać się z wykonaniem umowy do dnia uiszczenia
                                wynagrodzenia, o którym mowa w ust. 3 powyżej.
                            </div>
                        </li>
                        <li>
                            <div class="number">5.</div>
                            <div class="li_content">
                                Niezależnie od wynagrodzenia, o którym mowa w ustępie 3, z tytułu wykonania niniejszej umowy VOTUM przysługuje wynagrodzenie
                                w wysokości

                                #if(data.ContractType == '3'){#
                                30% (słownie: trzydzieści procent)
                                #}else if (data.ContractType == '2') {#
                                20% (słownie: dwadzieścia procent)
                                #}else if (data.ContractType == '1') {#
                                10% (słownie: dziesięć procent)
                                #}#

                                brutto (w tym podatek od towarów i usług VAT w wysokości 23%) liczone
                                od wartości uzyskanych dla Klienta świadczeń z tytułu nadpłaconych rat kredytu. Jeżeli na skutek działań podjętych przez VOTUM
                                w ramach niniejszej umowy nastąpi zmniejszenie salda zadłużenia Klienta wobec Zobowiązanego, VOTUM przysługiwać będzie
                                również wynagrodzenie w wysokości wskazanej w zdaniu poprzedzającym, liczone od kwoty o jaką zmniejszone zostało to saldo.
                                W takim przypadku Klient zobowiązany jest do uiszczenia wynagrodzenia w terminie 7 dni od dnia otrzymania od VOTUM faktury VAT.
                            </div>
                        </li>
                        <li>
                            <div class="number">6.</div>
                            <div class="li_content">
                                Votum przysługuje zwrot wyłożonej tymczasowo opłaty w kwocie 50 zł (słownie: pięćdziesiąt złotych) za złożenie wniosku o wszczęcie
                                postępowania w sprawie rozwiązywania sporów między klientem a podmiotem rynku finansowego do Rzecznika Finansowego.
                            </div>
                        </li>
                        <li>
                            <div class="number">7.</div>
                            <div class="li_content">
                                Votum przysługuje zwrot wyłożonej tymczasowo w imieniu Klienta opłaty w kwocie 50 zł (słownie: pięćdziesiąt złotych) za złożenie
                                umowy o przeprowadzenie mediacji w centrum mediacji Sądu Polubownego przy Komisji Nadzoru Finansowego.
                            </div>
                        </li>
                        <li>
                            <div class="number">8.</div>
                            <div class="li_content">
                                W przypadku poniesienia przez VOTUM kosztów procesu podlegają one zwrotowi na rzecz VOTUM wyłącznie z kwoty ogółu świadczeń
                                przyznanych Klientowi rozstrzygnięciem sądu lub ugodą, a koszty zastępstwa procesowego zasądzone w sprawie przypadają
                                reprezentującemu Klienta pełnomocnikowi procesowemu wskazanemu przez VOTUM.
                            </div>
                        </li>
                        <li>
                            <div class="number">9.</div>
                            <div class="li_content">
                                W przypadku spełnienia świadczenia przez Zobowiązanego bezpośrednio do rąk Klienta po dacie zawarcia niniejszej umowy,
                                Klient zobowiązuje się niezwłocznie powiadomić o tym VOTUM i wpłacić w terminie 7 dni roboczych od dnia jego otrzymania należne
                                VOTUM wynagrodzenie wraz z poniesionymi przez VOTUM kosztami w związku z realizacją umowy, na rachunek bankowy
                                prowadzony w ING Bank Śląski S.A. Oddział we Wrocławiu, nr 40 1050 1575 1000 0023 1250 6476 bądź w inny sposób wskazany przez
                                VOTUM.
                            </div>
                        </li>
                        <li>
                            <div class="number">10.</div>
                            <div class="li_content">
                                Za zobowiązania wynikające z niniejszej umowy Klienci ponoszą odpowiedzialność solidarną.
                            </div>
                        </li>
                    </div>
                </div>
                <div class="clear"></div>
                <div class="margin_10"></div>
                <div class="capture align-middle">
                    <div class="red_margin_capture"></div>
                    <div class="number_capture"> V </div>
                    <div class="capture_title">CZAS TRWANIA UMOWY</div>
                </div>
                <div class="contract_text">
                    <div style="font-size:8px !important;margin-bottom: 0px!important">
                        <li>
                            <div class="number">1.</div>
                            <div class="li_content">
                                Umowa zostaje zawarta na czas do całkowitego wyegzekwowania dla Klienta świadczeń należnych od Zobowiązanego w postępowaniu
                                przedsądowym, sądowym i egzekucyjnym.
                            </div>
                        </li>
                        <li>
                            <div class="number">2.</div>
                            <div class="li_content">
                                Klient może wypowiedzieć umowę w każdym czasie. Jeżeli wypowiedzenie nastąpiło bez ważnego powodu, a na skutek wykonania
                                umowy Klient uzyskał od Zobowiązanego świadczenie lub doszło do zmniejszenia salda zadłużenia, VOTUM może domagać się
                                naprawienia szkody wyłącznie do kwoty wysokości wynagrodzenia, jakie zostałoby naliczone, gdyby Klient nie wypowiedział umowy.
                            </div>
                        </li>
                        <li>
                            <div class="number">3.</div>
                            <div class="li_content">
                                W przypadku wypowiedzenia umowy bez ważnego powodu przez VOTUM, jest ona odpowiedzialna za szkodę.
                            </div>
                        </li>
                    </div>
                </div>
                <div class="clear"></div>
                <div class="margin_10"></div>
                <div class="capture align-middle">
                    <div class="red_margin_capture"></div>
                    <div class="number_capture"> VI </div>
                    <div class="capture_title">OŚWIADCZENIA STRON</div>
                </div>
                <div class="contract_text">
                    <div style="font-size:8px !important;margin-bottom: 0px!important">
                        <li>
                            Votum oświadcza, że:
                        </li>
                        <li>
                            <div class="number">a.</div>
                            <div class="li_content">
                                informacje o sposobie wykonania umowy mogą być przekazywane na wskazany w umowie nr telefonu, adres e-mail, pocztą lub na
                                konto Klienta dostępne za pośrednictwem strony internetowej VOTUM: www.votum-sa.pl,
                            </div>
                        </li>
                        <li>
                            <div class="number">b.</div>
                            <div class="li_content">
                                Klient może złożyć reklamacje na świadczone przez VOTUM usługi listem poleconym na adres spółki.
                            </div>
                        </li>
                        <div class="clear"></div>
                        <div class="margin_10"></div>
                        <li>
                            Klient oświadcza, że żąda rozpoczęcia wykonywania usługi przez VOTUM przed upływem terminu do odstąpienia od umowy:
                        </li>
                        <li>
                            <i class="#= (data.RadioButton1 == 1) ? 'far fa-check-square' : 'far fa-square' #" style="background-color: \#FFF;"></i> TAK /
                            <i class="#= (data.RadioButton1 != 1) ? 'far fa-check-square' : 'far fa-square' #" style="background-color: \#FFF;"></i> NIE
                        </li>
                        <div class="margin_10"></div>
                        <li>
                            Klient oświadcza, że
                            <i class="#= (data.RadioButton2 == 1) ? 'far fa-check-square' : 'far fa-square' #" style="background-color: \#FFF;"></i> upoważnia /
                            <i class="#= (data.RadioButton2 != 1) ? 'far fa-check-square' : 'far fa-square' #" style="background-color: \#FFF;"></i> nie upoważnia Zleceniobiorcy do uzyskiwania informacji i
                            dokumentów w sprawach prowadzonych przez Kancelarię Adwokatów i Radców Prawnych A. Łebek i Wspólnicy sp.k. z siedzibą we Wrocławiu, w związku
                            z realizacją niniejszej umowy.
                        </li>
                        <div class="margin_10"></div>
                        <li>
                            Klient oświadcza, że:
                        </li>
                        <li>
                            <div class="number">a.</div>
                            <div class="li_content">
                                został poinformowany o sposobie i terminie prawa odstąpienia od niniejszej umowy oraz wzorze oświadczenia o odstąpieniu
                                i o pozasądowych sposobach rozpatrywania reklamacji – na odrębnym formularzu,
                            </div>
                        </li>
                        <li>
                            <div class="number">b.</div>
                            <div class="li_content">
                                zobowiązuje się do zachowania poufności w związku z prowadzoną sprawą, co do każdego jej etapu i nieudostępniania informacji
                                oraz dokumentacji osobom trzecim,
                            </div>
                        </li>
                        <li>
                            <div class="number">c.</div>
                            <div class="li_content">
                                <i class="#= (data.RadioButton3 != 1) ? 'far fa-check-square' : 'far fa-square' #" style="background-color: \#FFF;"></i> nie zlecał wcześniej dochodzenia roszczeń żadnemu podmiotowi,
                                <i class="#= (data.RadioButton3 == 1) ? 'far fa-check-square' : 'far fa-square' #" style="background-color: \#FFF;"></i> zlecał sprawę wcześniej innemu pełnomocnikowi (nazwa):
                                #= (data.other_agent_name != '') ? data.other_agent_name : '<span class="underline" style="width: 100px;"></span>' #
                                z którym zawarł umowę dnia
                                #= (data.other_agent_date != '' && data.other_agent_date != null) ? data.other_agent_date : '<span class="underline" style="width: 60px;"></span>' #
                            </div>
                        </li>
                        <li>
                            <div class="number">d.</div>
                            <div class="li_content">
                                <i class="#= (data.CheckBox1 == 0 && data.CheckBox2 == 0 && data.CheckBox3 == 0) ? 'far fa-check-square' : 'far fa-square' #" style="background-color: \#FFF;"></i> nie zgłaszał roszczeń do Zobowiązanego,
                                <i class="#= (data.CheckBox1 == 1 || data.CheckBox2 == 1 || data.CheckBox3 == 1) ? 'far fa-check-square' : 'far fa-square' #" style="background-color: \#FFF;"></i> zgłaszał do Zobowiązanego roszczenia tytułem:
                            </div>
                        </li>
                        <div style="font-size:8px !important;padding-left:25px !important;margin-bottom: 0px!important">
                            <li>
                                <div class="number"></div>
                                <div class="li_content">
                                    <i class="#= (data.CheckBox1 == 1) ? 'far fa-check-square' : 'far fa-square' #" style="background-color: \#FFF;"></i>
                                    nadpłaconych rat w związku z klauzulą waloryzacyjną, data zgłoszenia:
                                    #= (data.CheckBox1Date != '' && data.CheckBox1 == 1) ? data.CheckBox1Date: '<span class="underline" style="width: 60px;"></span>' #
                                </div>
                            </li>
                            <li>
                                <div class="number"></div>
                                <div class="li_content">
                                    <i class="#= (data.CheckBox2 == 1) ? 'far fa-check-square' : 'far fa-square' #" style="background-color: \#FFF;"></i>
                                    zapłaconych składek za ubezpieczenie niskiego wkładu własnego, data zgłoszenia:
                                    #= (data.CheckBox2Date != '' && data.CheckBox2 == 1) ? data.CheckBox2Date: '<span class="underline" style="width: 60px;"></span>' #
                                </div>
                            </li>
                            <li>
                                <div class="number"></div>
                                <div class="li_content">
                                    <i class="#= (data.CheckBox3 == 1) ? 'far fa-check-square' : 'far fa-square' #" style="background-color: \#FFF;"></i>
                                    nadpłaconej składki za ubezpieczenie pomostowe, data zgłoszenia:
                                    #= (data.CheckBox2Date != '' && data.CheckBox3 == 1) ? data.CheckBox2Date: '<span class="underline" style="width: 60px;"></span>' #
                                </div>
                            </li>
                        </div>
                    </div>
                </div>

                <div class="number_site_text">
                    <div class="row justify-content-center" style="width: 100%; margin: 0px;">3/4</div>
                </div>
                <div class="print_text"><?php echo $contract_layout_number; ?></div>
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
                    <div class="number_capture"> VII </div>
                    <div class="capture_title">WARUNKI PROWADZENIA POSTĘPOWANIA SĄDOWEGO</div>
                </div>
                <div class="contract_text">
                    <div style="font-size:8px !important;margin-bottom: 0px!important">
                        <li>
                            <div class="number">1.</div>
                            <div class="li_content">
                                Klient jest zobowiązany do zapłaty kosztów prowadzenia postępowania sądowego, w tym:
                            </div>
                        </li>
                        <div style="font-size:8px !important;padding-left:15px !important;margin-bottom: 0px!important">
                            <li>
                                <div class="number">a.</div>
                                <div class="li_content">
                                    opłaty sądowej od pozwu w wysokości 5% wartości przedmiotu sporu, lecz nie więcej niż 1.000 zł, zgodnie z obowiązującymi
                                    przepisami (art. 13 ust. 1a Ustawy o kosztach sądowych w sprawach cywilnych, Dz. U. z 2018 r., poz. 300 ze zm.),
                                </div>
                            </li>
                            <li>
                                <div class="number">b.</div>
                                <div class="li_content">
                                    opłaty sądowej za złożenie wniosku o zawezwanie do próby ugodowej w kwocie 40 lub 300 zł, zgodnie z obowiązującymi przepisami
                                    (art. 23 pkt 3 lub art. 24 ust. 1 pkt 5) Ustawy o kosztach sądowych w sprawach cywilnych, Dz. U. z 2018 r., poz. 300 ze zm.),
                                </div>
                            </li>
                            <li>
                                <div class="number">c.</div>
                                <div class="li_content">
                                    kosztów przejazdów pełnomocnika procesowego na rozprawy, w wysokości określonej przez przepisy Rozporządzenia Ministra
                                    Infrastruktury w sprawie warunków ustalania oraz sposobu dokonywania zwrotu kosztów używania do celów służbowych
                                    samochodów osobowych, motocykli i motorowerów niebędących własnością pracodawcy (Dz. U. z 2002 r. nr 27, poz. 271 ze
                                    zm.) albo kosztów zastępstwa substytucyjnego w wysokości nie przekraczającej 300 zł brutto (słownie: trzysta złotych) za każde
                                    posiedzenie, płatne na 14 dni przed terminem rozprawy,
                                </div>
                            </li>
                            <li>
                                <div class="number">d.</div>
                                <div class="li_content">
                                    opłat skarbowych w kwocie 17 zł (słownie: siedemnaście złotych) od każdego pełnomocnictwa, innych opłat skarbowych oraz
                                    opłat sądowych.
                                </div>
                            </li>
                        </div>
                        <li>
                            <div class="number">2.</div>
                            <div class="li_content">
                                VOTUM nie ponosi odpowiedzialności za skutki wynikłe z nieuregulowania przez Klienta, bądź uregulowania z opóźnieniem, opłat
                                wymienionych powyżej.
                            </div>
                        </li>
                    </div>
                </div>

                <div class="clear"></div>
                <div class="margin_10"></div>
                <div class="capture align-middle">
                    <div class="red_margin_capture"></div>
                    <div class="number_capture"> VIII </div>
                    <div class="capture_title">PRAWA I OBOWIĄZKI STRON</div>
                </div>
                <div class="contract_text">
                    <div style="font-size:8px !important;margin-bottom: 0px!important">
                        <li>
                            <div class="number">1.</div>
                            <div class="li_content">
                                Czynności wchodzące w zakres niniejszej umowy VOTUM może wykonywać za pomocą podmiotów współpracujących, w szczególności
                                adwokatów lub radców prawnych, przy czym za działanie tych osób VOTUM odpowiada wobec Klienta jak za działania własne.
                            </div>
                        </li>
                        <li>
                            <div class="number">2.</div>
                            <div class="li_content">
                                Klient zobowiązuje się do niezwłocznego przekazania VOTUM wszelkich posiadanych informacji dotyczących przedmiotu umowy
                                ze Zobowiązanym oraz wszelkiej dokumentacji i niezbędnych oświadczeń, które będą konieczne do wykonania niniejszej umowy,
                                w szczególności:
                            </div>
                        </li>
                        <div style="font-size:8px !important;padding-left:15px !important;margin-bottom: 0px!important">
                            <li>
                                <div class="number">a.</div>
                                <div class="li_content">
                                    kopii umowy kredytu bankowego wraz z aneksami (jeżeli takowe były zawierane),
                                </div>
                            </li>
                            <li>
                                <div class="number">b.</div>
                                <div class="li_content">
                                    kopii regulaminu kredytów i pożyczek hipotecznych załączonego do umowy kredytu bankowego,
                                </div>
                            </li>
                            <li>
                                <div class="number">c.</div>
                                <div class="li_content">
                                    kopii Tabeli Opłat i Prowizji załączonej do umowy kredytu bankowego.
                                </div>
                            </li>
                        </div>
                        <li>
                            <div class="number">2.</div>
                            <div class="li_content">
                                Klient zobowiązuje się do niezwłocznego poinformowania VOTUM o każdorazowej zmianie danych do kontaktu, w szczególności
                                numeru telefonu, adresu e-mail oraz adresu do korespondencji.
                            </div>
                        </li>
                    </div>
                </div>

                <div class="clear"></div>
                <div class="margin_10"></div>
                <div class="capture align-middle">
                    <div class="red_margin_capture"></div>
                    <div class="number_capture"> IX </div>
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
                                W kwestiach nieuregulowanych mają zastosowanie przepisy Kodeksu cywilnego.
                            </div>
                        </li>
                        <li>
                            <div class="number">3.</div>
                            <div class="li_content">
                                Umowę sporządzono i podpisano w dwóch jednobrzmiących egzemplarzach, po jednej dla każdej ze stron.
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
                    <div class="row justify-content-center" style="width: 100%; margin: 0px;">4/4</div>
                </div>
                <div class="print_text"><?php echo $contract_layout_number; ?></div>
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
                    <i class="#= (data.dataConsentDSA == 1) ? 'far fa-check-square' : 'far fa-square' #" style="background-color: \#FFF;"></i> TAK
                    <i class="#= (data.dataConsentDSA == 0) ? 'far fa-check-square' : 'far fa-square' #" style="background-color: \#FFF;"></i> NIE
                </div>

                <div class="contract_text" style="font-size: 9px;padding-top:5px;padding-bottom:5px;">
                    2. Polskie Centrum Rehabilitacji Funkcjonalnej Votum S.A. Sp. k., Golikówka 6, 30-723 Kraków, KRS: 0000290430 , w zakresie danych
                    zawartych w umowie i przekazanej dokumentacji, w tym stanu zdrowia w celu sporządzenia oferty rehabilitacji
                </div>
                <div class="contract_text" style="font-size: 9px;padding-top:5px;padding-bottom:5px;">
                    <i class="#= (data.dataConsentPCRF == 1) ? 'far fa-check-square' : 'far fa-square' #" style="background-color: \#FFF;"></i> TAK
                    <i class="#= (data.dataConsentPCRF == 0) ? 'far fa-check-square' : 'far fa-square' #" style="background-color: \#FFF;"></i> NIE
                </div>

                <div class="contract_text" style="font-size: 9px;padding-top:5px;padding-bottom:5px;">
                    3. Fundacja VOTUM, ul. Wyścigowa 56i, 53-012 Wrocław, KRS: 0000272272, w zakresie danych zawartych w umowie i przekazanej dokumentacji,
                    w tym stanu zdrowia w celu przedstawienia możliwego zakresu pomocy:
                </div>
                <div class="contract_text" style="font-size: 9px;padding-top:5px;padding-bottom:5px;">
                    <i class="#= (data.dataConsentVOTUM == 1) ? 'far fa-check-square' : 'far fa-square' #" style="background-color: \#FFF;"></i> TAK
                    <i class="#= (data.dataConsentVOTUM == 0) ? 'far fa-check-square' : 'far fa-square' #" style="background-color: \#FFF;"></i> NIE
                </div>

                <div class="contract_text" style="font-size: 9px;padding-top:5px;padding-bottom:5px;">
                    4. AUTOVOTUM S.A., ul. Wyścigowa 56i, 53-012 Wrocław, KRS: 0000273033, w zakresie danych teleadresowych w celu sporządzenia oferty
                    usług wynajmu pojazdów zastępczych;
                </div>
                <div class="contract_text" style="font-size: 9px;padding-top:5px;padding-bottom:5px;">
                    <i class="#= (data.dataConsentAUTOVOTUM == 1) ? 'far fa-check-square' : 'far fa-square' #" style="background-color: \#FFF;"></i> TAK
                    <i class="#= (data.dataConsentAUTOVOTUM == 0) ? 'far fa-check-square' : 'far fa-square' #" style="background-color: \#FFF;"></i> NIE
                </div>

                <div class="contract_text" style="font-size: 9px;padding-top:5px;padding-bottom:5px;">
                    5. Biuro Ekspertyz Procesowych sp. z o.o., Aleja Wiśniowa 47, 53-126 Wrocław, KRS: 0000565095, w zakresie danych teleadresowych w celu
                    sporządzenia oferty cesji wierzytelności dotyczącej szkody w pojeździe.
                </div>
                <div class="contract_text" style="font-size: 9px;padding-top:5px;padding-bottom:5px;">
                    <i class="#= (data.dataConsentBEP == 1) ? 'far fa-check-square' : 'far fa-square' #" style="background-color: \#FFF;"></i> TAK
                    <i class="#= (data.dataConsentBEP == 0) ? 'far fa-check-square' : 'far fa-square' #" style="background-color: \#FFF;"></i> NIE
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
                    <i class="#= (data.marketingConsentDSA1 == 1) ? 'far fa-check-square' : 'far fa-square' #" style="background-color: \#FFF;"></i> TAK
                    <i class="#= (data.marketingConsentDSA1 == 0) ? 'far fa-check-square' : 'far fa-square' #" style="background-color: \#FFF;"></i> NIE
                </div>
                <div class="contract_text" style="font-size: 9px;padding-top:5px;padding-bottom:5px;">
                    b) Przekazywanie treści marketingowych na podany przez mnie nr telefonu w tym przy użyciu automatycznych systemów wywołujących
                    w rozumieniu ustawy z dnia 17.07.2004 r. Prawo telekomunikacyjne (Dz.U. z 2016 r. poz. 1489);
                </div>
                <div class="contract_text" style="font-size: 9px;padding-top:5px;padding-bottom:5px;">
                    <i class="#= (data.marketingConsentDSA2 == 1) ? 'far fa-check-square' : 'far fa-square' #" style="background-color: \#FFF;"></i> TAK
                    <i class="#= (data.marketingConsentDSA2 == 0) ? 'far fa-check-square' : 'far fa-square' #" style="background-color: \#FFF;"></i> NIE
                </div>

                <div class="contract_text" style="font-size: 9px;padding-top:5px;padding-bottom:5px;">
                    2. VOTUM S.A., ul. Wyścigowa 56i, 53-012 Wrocław,
                </div>
                <div class="contract_text" style="font-size: 9px;padding-top:5px;padding-bottom:5px;">
                    a) przesyłanie informacji handlowych za pośrednictwem środków komunikacji elektronicznej zgodnie z ustawą z dn. 08.07.2002 r. o świadczeniu
                    usług drogą elektroniczną (t. j. Dz.U. z 2017 r. poz. 1219):
                </div>
                <div class="contract_text" style="font-size: 9px;padding-top:5px;padding-bottom:5px;">
                    <i class="#= (data.marketingConsentVOTUM1 == 1) ? 'far fa-check-square' : 'far fa-square' #" style="background-color: \#FFF;"></i> TAK
                    <i class="#= (data.marketingConsentVOTUM1 == 0) ? 'far fa-check-square' : 'far fa-square' #" style="background-color: \#FFF;"></i> NIE
                </div>
                <div class="contract_text" style="font-size: 9px;padding-top:5px;padding-bottom:5px;">
                    b) przekazywanie treści marketingowych na podany przeze mnie nr telefonu w tym przy użyciu automatycznych systemów wywołujących
                    w rozumieniu ustawy z dn.16.07.2004 r. Prawo telekomunikacyjne (t. j. Dz.U. z 2017 r. poz. 1907):
                </div>
                <div class="contract_text" style="font-size: 9px;padding-top:5px;padding-bottom:5px;">
                    <i class="#= (data.marketingConsentVOTUM2 == 1) ? 'far fa-check-square' : 'far fa-square' #" style="background-color: \#FFF;"></i> TAK
                    <i class="#= (data.marketingConsentVOTUM2 == 0) ? 'far fa-check-square' : 'far fa-square' #" style="background-color: \#FFF;"></i> NIE
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

            # } #


            # for (var i = 0; i < 2; i++) { #

            <!--PEŁNOMOCNICTWO VOTUM ZLECENIODAWCY I x2-->

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

                <div class="contract_text">Ja niżej podpisany:</div>
                <div class="margin_10"></div>

                <div class="form_section_client" style="height:155px;">
                    <div class="red_margin"></div>
                    <div class="form_section_body">
                        <div class="body_form">
                            <div class="form_grey_body">
                                <div class="row" style="padding-bottom: 0.5em; margin-left: 0px; margin-right:0px;">
                                    <div class="col-6 padding_column">
                                        <input name="FirstNameIPrint" type="text" class="k-input k-textbox" value="#= (data.FirstName1 != null && data.FirstName1 != '') ? data.FirstName1 : '' #"/>
                                        <span class="under_small_label">imię</span>
                                    </div>
                                    <div class="col-6 padding_column">
                                        <input name="LastName1Print" type="text" class="k-input k-textbox" value="#= (data.LastName1 != null && data.LastName1 != '') ? data.LastName1 : '' #"/>
                                        <span class="under_small_label">nazwisko</span>
                                    </div>
                                </div>
                                <div class="row" style="padding-bottom: 0.5em; margin-left: 0px; margin-right:0px;">
                                    <div class="label_contract" style="width: 100%; font-family: 'Museo_700'; font-weight: 700;">Adres zameldowania mocodawcy:</div>
                                    <div class="col-6 padding_column">
                                        <input name="StreetI" type="text" class="k-input k-textbox" value="#= (data.Street1 != null && data.Street1 != '') ? data.Street1 : '' #"/>
                                        <span class="under_small_label">ulica</span>
                                    </div>
                                    <div class="col-3 padding_column">
                                        <input name="HomeNumberI" type="text" class="k-input k-textbox" value="#= (data.Home1 != null && data.Home1 != '') ? data.Home1 : '' #"/>
                                        <span class="under_small_label">nr domu / mieszkania</span>
                                    </div>
                                    <div class="col-3 padding_column">
                                        <input name="PostCodeI" type="text" class="k-input k-textbox" value="#= (data.PostCode1 != null && data.PostCode1 != '') ? data.PostCode1 : '' #"/>
                                        <span class="under_small_label">kod pocztowy</span>
                                    </div>
                                </div>
                                <div class="row" style="padding-bottom: 0.5em; margin-left: 0px; margin-right:0px;">
                                    <div class="col-4 padding_column">
                                        <input name="CityI" type="text" class="k-input k-textbox" value="#= (data.City1 != null && data.City1 != '') ? data.City1 : '' #"/>
                                        <span class="under_small_label">miejscowość</span>
                                    </div>
                                    <div class="col-4 padding_column">
                                        <input name="PESELI" type="text" class="k-input k-textbox" value="#= (data.PESEL1 != null && data.PESEL1 != '') ? data.PESEL1 : '' #"/>
                                        <span class="under_small_label">PESEL</span>
                                    </div>
                                    <div class="col-4 padding_column">
                                        <input name="IdentityCardI" type="text" class="k-input k-textbox" value="#= (data.IdNr1 != null && data.IdNr1 != '') ? data.IdNr1 : '' #"/>
                                        <span class="under_small_label">seria i numer dowodu osobistego</span>
                                    </div>
                                </div>
                                <div class="row" style="padding-bottom: 0.5em; margin-left: 0px; margin-right:0px;">
                                    <div class="col-5 padding_column">
                                        <input name="PhoneI" type="text" class="k-input k-textbox" value="#= (data.Phone1 != null && data.Phone1 != '') ? data.Phone1 : '' #"/>
                                        <span class="under_small_label">telefon</span>
                                    </div>
                                    <div class="col-7 padding_column">
                                        <input name="EmailI" type="text" class="k-input k-textbox" value="#= (data.Email1 != null && data.Email1 != '') ? data.Email1 : '' #"/>
                                        <span class="under_small_label">e-mail</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="red_margin"></div>
                </div>
                <div class="clear"></div>
                <div class="margin_10"></div>
                <span class="row contract_name"><p style="font-size:12px;margin-bottom:0px;text-align:center">UPOWAŻNIAM:</p></span>

                <div class="contract_text" style="text-align: justify; font-size:12px; font-weight: 300; line-height: 14px;">
                    VOTUM S.A. z siedzibą we Wrocławiu 53-012, przy ul. Wyścigowa 56i, zarejestrowana w Sądzie
                    Rejonowym dla Wrocławia Fabrycznej VI Wydział Gospodarczy Krajowego Rejestru Sądowego pod numerem
                    KRS: 0000243252, REGON: 020136043, NIP: 899-25-49-057, KAPITAŁ ZAKŁADOWY: 1 200 000
                    zł. wpłacony w całości, d o podejmowania w moim imieniu wszelkich czynności mających na celu
                    dochodzenie roszczeń dotyczących umowy kredytu #= (data.CreditType != null && data.CreditType != '') ? data.CreditType : '<span class="underline" style="width: 60px;"></span>' #
                    numer #= (data.BankContractNumber != null && data.BankContractNumber != '') ? data.BankContractNumber : '<span class="underline" style="width: 80px;"></span>' # udzielonego przez #= (data.MandateBankName != null && data.MandateBankName != '') ? data.MandateBankName : '<span class="underline" style="width: 120px;"></span>' #
                    , w tym w szczególności do: wszelkich czynności pozaprocesowych i
                    polubownych, zawarcia ugody, w tym wiążącej się ze zrzeczeniem się dalszych roszczeń, odbioru świadczenia,
                    wskazania rachunku bankowego, na który mają być przelane świadczenia, odbioru wszelkiej korespondencji w
                    sprawach objętych pełnomocnictwem, gromadzenia dokumentacji mającej związek ze sprawą, w tym jej odbioru
                    od podmiotów, które je tworzą i przechowują, udzielania dalszych pełnomocnictw.
                </div>
                <div class="clear"></div>
                <div class="margin_10"></div>

                <div class="contract_text" style="text-align: justify; font-size:12px; font-weight: 300; line-height: 14px;">
                    Zgodnie z art. 104 ust. 3 ustawy z dnia 29 sierpnia 1997 r. Prawo bankowe (Dz. U. z 2016 r. poz. 1988) upoważniam
                    zarówno bank, a także Rzecznika Finansowego, do ujawnienia i przekazania VOTUM S.A. wszelkich żądanych
                    przez Spółkę dokumentów i informacji objętych tajemnicą bankową, dotyczących udzielenia i wykonania kredytu #= (data.CreditType != null && data.CreditType != '') ? data.CreditType : '<span class="underline" style="width: 60px;"></span>' #
                    o numerze #= (data.BankContractNumber != null && data.BankContractNumber != '') ? data.BankContractNumber : '<span class="underline" style="width: 80px;"></span>' # na podstawie umowy z dnia #= (data.BankContractDate != null && data.BankContractDate != '') ? data.BankContractDate : '<span class="underline" style="width: 50px;"></span>' # r. , w zakresie niezbędnym do wykonania wszelkich
                    czynności objętych pełnomocnictwem, a także realizacji zadań przez Rzecznika Finansowego w związku z wniesionym
                    wnioskiem w ww. sprawie.
                </div>
                <div class="clear"></div>
                <div class="margin_10"></div>

                <div class="row" style="margin-left: 0px; margin-right:0px; margin-top: 30px;">
                    <div class="col-6 padding_column">
                        <div class="row justify-content-center border_bottom" style="padding-bottom: 0.5em;padding-top: 0.5em; margin-left: 0px; margin-right:0px;font-size:9px;"></div>
                        <div class="row justify-content-center" style="padding-bottom: 0.5em;padding-top: 0.5em; margin-left: 0px; margin-right:0px;font-size:7px;">miejscowość i data</div>
                    </div>
                    <div class="col-2 padding_column"></div>
                    <div class="col-4 padding_column">
                        <div class="row justify-content-center border_bottom" style="padding-bottom: 0.5em;padding-top: 0.5em; margin-left: 0px; margin-right:0px;font-size:9px;"></div>
                        <div class="row justify-content-center" style="padding-bottom: 0.5em;padding-top: 0.5em; margin-left: 0px; margin-right:0px;font-size:7px;">PODPIS MOCODAWCY</div>
                    </div>
                </div>
                <div class="clear"></div>

                <div class="number_site_text">
                    <div class="row justify-content-center" style="width: 100%; margin: 0px;">1/1</div>
                </div>
                <div class="print_text"><?php echo $enablement_votum_layout_number; ?></div>
            </div>

            <!--PEŁNOMOCNICTWO KAIRP ZLECENIODAWCY I x2-->

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
                <div class="contract_text" style="text-align: justify; font-size:12px; font-weight: 300; line-height: 14px;">
                    Ja niżej podpisany/a
                    #= (data.FirstName1 != null) ? data.FirstName1 +' '+ data.LastName1 : '<span class="underline" style="width: 150px;"></span>' #
                    upoważniam
                    <span class="underline" style="width: 130px;"></span> <span class="underline" style="width: 130px;"></span> z Kancelarii Adwokatów
                    i Radców Prawnych A. Łebek i Wspólnicy sp. k. we Wrocławiu do prowadzenia sprawy przeciwko
                    #= (data.BankName != null && data.BankName != '') ? data.BankName : '<span class="underline" style="width: 120px;"></span>' # o zapłatę. Pełnomocnictwo obejmuje
                    umocowanie do podejmowania wszelkich związanych ze sprawą czynności zarówno w postępowaniu przed
                    sądami powszechnymi wszystkich instancji, złożenia wniosku o zawezwanie do próby ugodowej oraz negocjowania
                    i zawarcia ugody, a także prowadzenia negocjacji pozasądowych oraz uprawnienie do odbioru świadczenia.
                    Pełnomocnictwo niniejsze zostaje udzielone na czas nieokreślony, ze skutkiem od dnia jego przyjęcia
                    przez Pełnomocnika.
                </div>
                <div class="clear"></div>

                <div class="margin_10"></div>
                <div class="contract_text" style="text-align: justify; font-size:12px; font-weight: 300; line-height: 14px;">
                    Ponadto, na podstawie art. 104 ust. 3 ustawy z dnia 29 sierpnia 1997 r. Prawo bankowe (Dz. U. z 2016 r. poz. 1988), upoważniam zarówno bank,
                    a także Rzecznika Finansowego do ujawnienia i przekazania wszystkich informacji objętych tajemnicą bankową mojemu pełnomocnikowi,
                    w zakresie niezbędnym do wykonania wszelkich czynności objętych pełnomocnictwem, a także realizacji zadań przez Rzecznika Finansowego w związku
                    z wniesionym wnioskiem w wyżej wymienionej sprawie.
                </div>
                <div class="clear"></div>

                <div class="contract_text">
                    <div class="row" style="margin-left: 0px; margin-right:0px; margin-top: 30px;padding: 0px 30px 0px 30px;">
                        <div class="col-6 padding_column"></div>
                        <div class="col-6 padding_column">
                            <div class="row justify-content-center border_bottom" style="padding-bottom: 0.5em;padding-top: 0.5em; margin-left: 0px; margin-right:0px;font-size:9px;"></div>
                            <div class="row justify-content-center" style="padding-bottom: 0.5em;padding-top: 0.5em; margin-left: 0px; margin-right:0px;font-size:10px;">PODPIS MOCODAWCY</div>
                        </div>
                    </div>
                </div>

                        <div class="row" style="padding: 10px 30px 10px 30px; margin-left: 0px; margin-right:0px;font-size:12px;">
                            Oświadczam, że pełnomocnictwo niniejsze przyjmuję oraz udzielam substytucji do prowadzenia sprawy:
                        </div>
                        <div class="row" style="padding: 10px 30px 10px 30px; margin-left: 0px; margin-right:0px;font-size:12px;">
                            1. <span class="underline" style="width: 90%;">
                        </div>
                        <div class="row" style="padding: 10px 30px 10px 30px; margin-left: 0px; margin-right:0px;font-size:12px;">
                            2. <span class="underline" style="width: 90%;">
                        </div>
                        <div class="row" style="padding: 10px 30px 10px 30px; margin-left: 0px; margin-right:0px;font-size:12px;">
                            3. <span class="underline" style="width: 90%;">
                        </div>


                <div class="row" style="margin-left: 0px; margin-right:0px; margin-top: 30px;padding: 0px 30px 0px 30px;">
                    <div class="col-5 padding_column">
                        <div class="row text-left" style="padding-bottom: 0.5em;padding-top: 0.5em; margin-left: 0px; margin-right:0px;font-size:10px;">
                            Wrocław, dnia <span class="underline" style="width: 100px;">
                        </div>
                    </div>
                    <div class="col-2 padding_column"></div>
                    <div class="col-5 padding_column">
                        <div class="row justify-content-center border_bottom" style="padding-bottom: 0.5em;padding-top: 0.5em; margin-left: 0px; margin-right:0px;font-size:9px;"></div>
                        <div class="row justify-content-center" style="padding-bottom: 0.5em;padding-top: 0.5em; margin-left: 0px; margin-right:0px;font-size:8px;">PODPIS PEŁNOMOCNIKA</div>
                    </div>
                </div>

                <div class="contract_text" style="margin-top: 20px !important; font-size: 10px;">
                    <div class="row border_bottom" style="margin-left:0px; margin-bottom: 10px;"></div>
                    <div class="justify-content-center row" style="color:\#b72a20; font-family: 'Museo_700';font-weight: 700;">KANCELARIA ADWOKATÓW I RADCÓW PRAWNYCH A. ŁEBEK I WSPÓLNICY SPÓŁKA KOMANDYTOWA</div>
                    <div class="justify-content-center row" style="line-height: 12px;">ul. Wyścigowa 56i; 53-012 Wrocław, tel. +48 71 332 93 40, fax +48 71 332 93 43</div>
                    <div class="justify-content-center row" style="line-height: 12px;">e-mail: kancelaria@kairp-lebek.pl, www.kairp-lebek.pl</div>
                    <div class="justify-content-center row" style="line-height: 12px;">NIP: 899-25-79-696 REGON: 020356170 KRS:0000262469</div>
                </div>
                <div class="clear"></div>

                <div class="number_site_text">
                    <div class="row justify-content-center" style="width: 100%; margin: 0px;">1/1</div>
                </div>
            </div>

            # } #


            #if(data.PESEL2){#
                # for (var i = 0; i < 2; i++) { #

            <!--PEŁNOMOCNICTWO VOTUM ZLECENIODAWCY II x2-->

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

                <div class="contract_text">Ja niżej podpisany:</div>
                <div class="margin_10"></div>

                <div class="form_section_client" style="height:155px;">
                    <div class="red_margin"></div>
                    <div class="form_section_body">
                        <div class="body_form">
                            <div class="form_grey_body">
                                <div class="row" style="padding-bottom: 0.5em; margin-left: 0px; margin-right:0px;">
                                    <div class="col-6 padding_column">
                                        <input name="FirstNameIPrint" type="text" class="k-input k-textbox" value="#= (data.FirstName2 != null && data.FirstName2 != '') ? data.FirstName2 : '' #"/>
                                        <span class="under_small_label">imię</span>
                                    </div>
                                    <div class="col-6 padding_column">
                                        <input name="LastName1Print" type="text" class="k-input k-textbox" value="#= (data.LastName2 != null && data.LastName2 != '') ? data.LastName2 : '' #"/>
                                        <span class="under_small_label">nazwisko</span>
                                    </div>
                                </div>
                                <div class="row" style="padding-bottom: 0.5em; margin-left: 0px; margin-right:0px;">
                                    <div class="label_contract" style="width: 100%; font-family: 'Museo_700'; font-weight: 700;">Adres zameldowania mocodawcy:</div>
                                    <div class="col-6 padding_column">
                                        <input name="StreetI" type="text" class="k-input k-textbox" value="#= (data.Street2 != null && data.Street2 != '') ? data.Street2 : '' #"/>
                                        <span class="under_small_label">ulica</span>
                                    </div>
                                    <div class="col-3 padding_column">
                                        <input name="HomeNumberI" type="text" class="k-input k-textbox" value="#= (data.Home2 != null && data.Home2 != '') ? data.Home2 : '' #"/>
                                        <span class="under_small_label">nr domu / mieszkania</span>
                                    </div>
                                    <div class="col-3 padding_column">
                                        <input name="PostCodeI" type="text" class="k-input k-textbox" value="#= (data.PostCode2 != null && data.PostCode2 != '') ? data.PostCode2 : '' #"/>
                                        <span class="under_small_label">kod pocztowy</span>
                                    </div>
                                </div>
                                <div class="row" style="padding-bottom: 0.5em; margin-left: 0px; margin-right:0px;">
                                    <div class="col-4 padding_column">
                                        <input name="CityI" type="text" class="k-input k-textbox" value="#= (data.City2 != null && data.City2 != '') ? data.City2 : '' #"/>
                                        <span class="under_small_label">miejscowość</span>
                                    </div>
                                    <div class="col-4 padding_column">
                                        <input name="PESELI" type="text" class="k-input k-textbox" value="#= (data.PESEL2 != null && data.PESEL2 != '') ? data.PESEL2 : '' #"/>
                                        <span class="under_small_label">PESEL</span>
                                    </div>
                                    <div class="col-4 padding_column">
                                        <input name="IdentityCardI" type="text" class="k-input k-textbox" value="#= (data.IdNr2 != null && data.IdNr2 != '') ? data.IdNr2 : '' #"/>
                                        <span class="under_small_label">seria i numer dowodu osobistego</span>
                                    </div>
                                </div>
                                <div class="row" style="padding-bottom: 0.5em; margin-left: 0px; margin-right:0px;">
                                    <div class="col-5 padding_column">
                                        <input name="PhoneI" type="text" class="k-input k-textbox" value="#= (data.Phone2 != null && data.Phone2 != '') ? data.Phone2 : '' #"/>
                                        <span class="under_small_label">telefon</span>
                                    </div>
                                    <div class="col-7 padding_column">
                                        <input name="EmailI" type="text" class="k-input k-textbox" value="#= (data.Email2 != null && data.Email2 != '') ? data.Email2 : '' #"/>
                                        <span class="under_small_label">e-mail</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="red_margin"></div>
                </div>
                <div class="clear"></div>
                <div class="margin_10"></div>
                <span class="row contract_name"><p style="font-size:12px;margin-bottom:0px;text-align:center">UPOWAŻNIAM:</p></span>

                <div class="contract_text" style="text-align: justify; font-size:12px; font-weight: 300; line-height: 14px;">
                    VOTUM S.A. z siedzibą we Wrocławiu 53-012, przy ul. Wyścigowa 56i, zarejestrowana w Sądzie
                    Rejonowym dla Wrocławia Fabrycznej VI Wydział Gospodarczy Krajowego Rejestru Sądowego pod numerem
                    KRS: 0000243252, REGON: 020136043, NIP: 899-25-49-057, KAPITAŁ ZAKŁADOWY: 1 200 000
                    zł. wpłacony w całości, d o podejmowania w moim imieniu wszelkich czynności mających na celu
                    dochodzenie roszczeń dotyczących umowy kredytu #= (data.CreditType != null && data.CreditType != '') ? data.CreditType : '<span class="underline" style="width: 60px;"></span>' #
                    numer #= (data.BankContractNumber != null && data.BankContractNumber != '') ? data.BankContractNumber : '<span class="underline" style="width: 80px;"></span>' # udzielonego przez #= (data.MandateBankName != null && data.MandateBankName != '') ? data.MandateBankName : '<span class="underline" style="width: 120px;"></span>' #
                    , w tym w szczególności do: wszelkich czynności pozaprocesowych i
                    polubownych, zawarcia ugody, w tym wiążącej się ze zrzeczeniem się dalszych roszczeń, odbioru świadczenia,
                    wskazania rachunku bankowego, na który mają być przelane świadczenia, odbioru wszelkiej korespondencji w
                    sprawach objętych pełnomocnictwem, gromadzenia dokumentacji mającej związek ze sprawą, w tym jej odbioru
                    od podmiotów, które je tworzą i przechowują, udzielania dalszych pełnomocnictw.
                </div>
                <div class="clear"></div>
                <div class="margin_10"></div>

                <div class="contract_text" style="text-align: justify; font-size:12px; font-weight: 300; line-height: 14px;">
                    Zgodnie z art. 104 ust. 3 ustawy z dnia 29 sierpnia 1997 r. Prawo bankowe (Dz. U. z 2016 r. poz. 1988) upoważniam
                    zarówno bank, a także Rzecznika Finansowego, do ujawnienia i przekazania VOTUM S.A. wszelkich żądanych
                    przez Spółkę dokumentów i informacji objętych tajemnicą bankową, dotyczących udzielenia i wykonania kredytu #= (data.CreditType != null && data.CreditType != '') ? data.CreditType : '<span class="underline" style="width: 60px;"></span>' #
                    o numerze #= (data.BankContractNumber != null && data.BankContractNumber != '') ? data.BankContractNumber : '<span class="underline" style="width: 80px;"></span>' # na podstawie umowy z dnia #= (data.BankContractDate != null && data.BankContractDate != '') ? data.BankContractDate : '<span class="underline" style="width: 50px;"></span>' # r. , w zakresie niezbędnym do wykonania wszelkich
                    czynności objętych pełnomocnictwem, a także realizacji zadań przez Rzecznika Finansowego w związku z wniesionym
                    wnioskiem w ww. sprawie.
                </div>
                <div class="clear"></div>
                <div class="margin_10"></div>

                <div class="row" style="margin-left: 0px; margin-right:0px; margin-top: 30px;">
                    <div class="col-6 padding_column">
                        <div class="row justify-content-center border_bottom" style="padding-bottom: 0.5em;padding-top: 0.5em; margin-left: 0px; margin-right:0px;font-size:9px;"></div>
                        <div class="row justify-content-center" style="padding-bottom: 0.5em;padding-top: 0.5em; margin-left: 0px; margin-right:0px;font-size:7px;">miejscowość i data</div>
                    </div>
                    <div class="col-2 padding_column"></div>
                    <div class="col-4 padding_column">
                        <div class="row justify-content-center border_bottom" style="padding-bottom: 0.5em;padding-top: 0.5em; margin-left: 0px; margin-right:0px;font-size:9px;"></div>
                        <div class="row justify-content-center" style="padding-bottom: 0.5em;padding-top: 0.5em; margin-left: 0px; margin-right:0px;font-size:7px;">PODPIS MOCODAWCY</div>
                    </div>
                </div>
                <div class="clear"></div>

                <div class="number_site_text">
                    <div class="row justify-content-center" style="width: 100%; margin: 0px;">1/1</div>
                </div>
                <div class="print_text"><?php echo $enablement_votum_layout_number; ?></div>
            </div>

            <!--PEŁNOMOCNICTWO KAIRP ZLECENIODAWCY II x2-->

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
                <div class="contract_text" style="text-align: justify; font-size:12px; font-weight: 300; line-height: 14px;">
                    Ja niżej podpisany/a
                    #= (data.FirstName2 != null) ? data.FirstName2 +' '+ data.LastName2 : '<span class="underline" style="width: 150px;"></span>' #
                    upoważniam
                    <span class="underline" style="width: 130px;"></span> <span class="underline" style="width: 130px;"></span> z Kancelarii Adwokatów
                    i Radców Prawnych A. Łebek i Wspólnicy sp. k. we Wrocławiu do prowadzenia sprawy przeciwko
                    #= (data.BankName != null && data.BankName != '') ? data.BankName : '<span class="underline" style="width: 120px;"></span>' # o zapłatę. Pełnomocnictwo obejmuje
                    umocowanie do podejmowania wszelkich związanych ze sprawą czynności zarówno w postępowaniu przed
                    sądami powszechnymi wszystkich instancji, złożenia wniosku o zawezwanie do próby ugodowej oraz negocjowania
                    i zawarcia ugody, a także prowadzenia negocjacji pozasądowych oraz uprawnienie do odbioru świadczenia.
                    Pełnomocnictwo niniejsze zostaje udzielone na czas nieokreślony, ze skutkiem od dnia jego przyjęcia
                    przez Pełnomocnika.
                </div>
                <div class="clear"></div>

                <div class="margin_10"></div>
                <div class="contract_text" style="text-align: justify; font-size:12px; font-weight: 300; line-height: 14px;">
                    Ponadto, na podstawie art. 104 ust. 3 ustawy z dnia 29 sierpnia 1997 r. Prawo bankowe (Dz. U. z 2016 r. poz. 1988), upoważniam zarówno bank,
                    a także Rzecznika Finansowego do ujawnienia i przekazania wszystkich informacji objętych tajemnicą bankową mojemu pełnomocnikowi,
                    w zakresie niezbędnym do wykonania wszelkich czynności objętych pełnomocnictwem, a także realizacji zadań przez Rzecznika Finansowego w związku
                    z wniesionym wnioskiem w wyżej wymienionej sprawie.
                </div>
                <div class="clear"></div>

                <div class="contract_text">
                    <div class="row" style="margin-left: 0px; margin-right:0px; margin-top: 30px;padding: 0px 30px 0px 30px;">
                        <div class="col-6 padding_column"></div>
                        <div class="col-6 padding_column">
                            <div class="row justify-content-center border_bottom" style="padding-bottom: 0.5em;padding-top: 0.5em; margin-left: 0px; margin-right:0px;font-size:9px;"></div>
                            <div class="row justify-content-center" style="padding-bottom: 0.5em;padding-top: 0.5em; margin-left: 0px; margin-right:0px;font-size:10px;">PODPIS MOCODAWCY</div>
                        </div>
                    </div>
                </div>

                <div class="row" style="padding: 10px 30px 10px 30px; margin-left: 0px; margin-right:0px;font-size:12px;">
                    Oświadczam, że pełnomocnictwo niniejsze przyjmuję oraz udzielam substytucji do prowadzenia sprawy:
                </div>
                <div class="row" style="padding: 10px 30px 10px 30px; margin-left: 0px; margin-right:0px;font-size:12px;">
                    1. <span class="underline" style="width: 90%;">
                </div>
                <div class="row" style="padding: 10px 30px 10px 30px; margin-left: 0px; margin-right:0px;font-size:12px;">
                    2. <span class="underline" style="width: 90%;">
                </div>
                <div class="row" style="padding: 10px 30px 10px 30px; margin-left: 0px; margin-right:0px;font-size:12px;">
                    3. <span class="underline" style="width: 90%;">
                </div>


                <div class="row" style="margin-left: 0px; margin-right:0px; margin-top: 30px;padding: 0px 30px 0px 30px;">
                    <div class="col-5 padding_column">
                        <div class="row text-left" style="padding-bottom: 0.5em;padding-top: 0.5em; margin-left: 0px; margin-right:0px;font-size:10px;">
                            Wrocław, dnia <span class="underline" style="width: 100px;">
                        </div>
                    </div>
                    <div class="col-2 padding_column"></div>
                    <div class="col-5 padding_column">
                        <div class="row justify-content-center border_bottom" style="padding-bottom: 0.5em;padding-top: 0.5em; margin-left: 0px; margin-right:0px;font-size:9px;"></div>
                        <div class="row justify-content-center" style="padding-bottom: 0.5em;padding-top: 0.5em; margin-left: 0px; margin-right:0px;font-size:8px;">PODPIS PEŁNOMOCNIKA</div>
                    </div>
                </div>

                <div class="contract_text" style="margin-top: 20px !important; font-size: 10px;">
                    <div class="row border_bottom" style="margin-left:0px; margin-bottom: 10px;"></div>
                    <div class="justify-content-center row" style="color:\#b72a20; font-family: 'Museo_700';font-weight: 700;">KANCELARIA ADWOKATÓW I RADCÓW PRAWNYCH A. ŁEBEK I WSPÓLNICY SPÓŁKA KOMANDYTOWA</div>
                    <div class="justify-content-center row" style="line-height: 12px;">ul. Wyścigowa 56i; 53-012 Wrocław, tel. +48 71 332 93 40, fax +48 71 332 93 43</div>
                    <div class="justify-content-center row" style="line-height: 12px;">e-mail: kancelaria@kairp-lebek.pl, www.kairp-lebek.pl</div>
                    <div class="justify-content-center row" style="line-height: 12px;">NIP: 899-25-79-696 REGON: 020356170 KRS:0000262469</div>
                </div>
                <div class="clear"></div>

                <div class="number_site_text">
                    <div class="row justify-content-center" style="width: 100%; margin: 0px;">1/1</div>
                </div>
            </div>

                # } #
            # } #


            <!--POUCZENIE KLIENTA-->

            <div class="pdf_strona size-a4 pdf-page new-page">
                <div class="row margin_width" style="padding-top: 30px; padding-bottom: 10px;">
                    <div class="logo_left">
                    </div>
                    <div class="logo_right">
                        <img src="<?php echo 'https://' . $_SERVER ['HTTP_HOST']; ?>/img/logo_small.png" />
                    </div>
                </div>

                <span class="row contract_name" style="padding-bottom: 0px;"><p style="margin-bottom: 0px;">POUCZENIE O PRAWIE DO ODSTĄPIENIA </br>OD UMOWY ORAZ O INNYCH PRAWACH KONSUMENTA</p></span>
                <div class="row" style="margin-left: 0px; margin-right:0px;font-size:9px; margin-top:15px;">
                    <div class="text_label_contract" style="width: 100%;font-family: 'Museo_700';font-weight: 700;">PRAWO DO ODSTĄPIENIA OD UMOWY</div>
                    <div class="text_label_contract" style="width: 100%; text-align: justify;">
                        Zgodnie z przepisami ustawy z dnia 30 maja 2016 r. o prawach konsumenta (Dz. U. z 2014 r., poz. 827), VOTUM informuje, że mają
                        Państwo prawo odstąpić od niniejszej umowy w terminie 14 dni bez podania jakiejkolwiek przyczyny. Termin do odstąpienia od
                        umowy kończy się po upływie 14 dni od dnia zawarcia umowy. Aby skorzystać z prawa do odstąpienia od umowy, muszą Państwo
                        poinformować VOTUM S.A., ul. Wyścigowa 56i, 53-012 Wrocław, tel. 71/ 33 93 400, faks. 71/33 93 403, e-mail: dok@votum-sa.pl
                        o swojej decyzji w drodze jednoznacznego oświadczenia, na przykład pismem wysłanym pocztą, faksem lub pocztą elektroniczną. Mogą
                        Państwo skorzystać z wzoru formularza odstąpienia od umowy, jednak nie jest to obowiązkowe. Aby zachować termin do odstąpienia
                        od umowy, wystarczy, aby wysłali Państwo informację dotyczącą wykonania przysługującego Państwu prawa do odstąpienia od
                        umowy przed upływem terminu do odstąpienia od umowy.
                    </div>
                </div>

                <div class="row" style="margin-left: 0px; margin-right:0px;font-size:9px;">
                    <div class="text_label_contract" style="width: 100%;font-family: 'Museo_700';font-weight: 700;">SKUTKI ODSTĄPIENIA OD UMOWY</div>
                    <div class="text_label_contract" style="width: 100%; text-align: justify;">
                        W przypadku odstąpienia od niniejszej umowy VOTUM zwraca Państwu wszelkie otrzymane od Państwa płatności, niezwłocznie,
                        a w każdym wypadku nie później niż 14 dni od dnia, w którym VOTUM została poinformowana o Państwa decyzji o wykonaniu prawa
                        odstąpienia od niniejszej umowy. VOTUM dokona zwrotu płatności przy użyciu takich samych sposobów płatności, jakie zostały przez
                        Państwa użyte w pierwotnej transakcji, chyba że Państwo wyraźnie zgodzili się na inne rozwiązanie, w każdym przypadku nie poniosą
                        Państwo żadnych opłat w związku z tym zwrotem.
                        Jeżeli żądali Państwo rozpoczęcia świadczenia usług przed upływem terminu do odstąpienia od umowy, zapłacą Państwo VOTUM
                        kwotę proporcjonalną do zakresu świadczeń spełnionych do chwili, w której poinformowali Państwo VOTUM o odstąpieniu od
                        niniejszej umowy.
                        Jeżeli na skutek złożonego przez Państwo żądania rozpoczęcia świadczenia usług przez VOTUM przed terminem do odstąpienia VOTUM
                        wykona całą usługę przed upływem terminu do odstąpienia, utracą Państwo prawo do odstąpienia od umowy na podstawie art. 38 pkt
                        1 ustawy z dnia 30 maja 2014 r. o prawach konsumenta.
                    </div>
                </div>

                <div class="row" style="margin-left: 0px; margin-right:0px;font-size:9px;">
                    <div class="text_label_contract" style="width: 100%;font-family: 'Museo_700';font-weight: 700;">POZASĄDOWE SPOSOBY ROZPATRYWANIA REKLAMACJI</div>
                    <div class="text_label_contract"  style="width: 100%; text-align: justify;">
                        Jeżeli złożą Państwo reklamację na usługi VOTUM i nie zostanie ona uwzględniona albo rozpatrzona przez VOTUM w terminie 30 dni
                        od dnia jej otrzymania, mają Państwo prawo skorzystać z pozasądowych sposobów rozpatrywania reklamacji w drodze mediacji lub za
                        pomocą sądów polubownych, składając na odpowiednim formularzu wniosek do właściwego terenowo Wojewódzkiego Inspektoratu
                        Inspekcji Handlowej. Mogą Państwo również zwrócić się o pomoc do właściwego terenowo miejskiego lub powiatowego rzecznika
                        konsumentów. Ze wskazanych sposobów rozwiązywania sporów można skorzystać dobrowolnie i nieodpłatnie. Więcej informacji na
                        ten temat mogą Państwo uzyskać we wskazanych instytucjach oraz w Urzędzie Ochrony Konkurencji i Konsumentów, www.uokik.gov.pl.
                    </div>
                </div>

                <div class="margin_10"></div>
                <div class="form_section" style="height: 415px;">
                    <div class="form_section_body" style="padding-bottom:8px; width: 100%;">
                        <div class="body_form">
                            <div class="form_grey_body">
                                <div class="white_table">
                                    <div class="row" style="margin-left: 0px; margin-right:0px;">
                                        <div class="label_contract" style="width: 100%; font-family: 'Museo_700'; font-weight: 700;color:\#b72a20 !important;">WZÓR FORMULARZA ODSTĄPIENIA OD UMOWY:</div>
                                    </div>
                                    <div class="row" style="margin-left: 0px; margin-right:0px; margin-top: 10px;padding: 0px 30px 0px 30px;">
                                        <div class="col-9 padding_column"></div>
                                        <div class="col-3 padding_column" style="margin-top:10px; margin-bottom: 30px;">
                                            <div class="row left-content-center" style="padding-bottom: 0em;padding-top: 0em; margin-left: 0px; margin-right:0px;font-size:10px;">VOTUM S.A.</div>
                                            <div class="row left-content-center" style="padding-bottom: 0em;padding-top: 0em; margin-left: 0px; margin-right:0px;font-size:10px;">ul. Wyścigowa 56i</div>
                                            <div class="row left-content-center" style="padding-bottom: 0em;padding-top: 0em; margin-left: 0px; margin-right:0px;font-size:10px;">53-012 Wrocław</div>
                                            <div class="margin_10"></div>
                                            <div class="row left-content-center" style="padding-bottom: 0em;padding-top: 0em; margin-left: 0px; margin-right:0px;font-size:10px;">fax: 71/ 33 93 403</div>
                                            <div class="row left-content-center" style="padding-bottom: 0em;padding-top: 0em; margin-left: 0px; margin-right:0px;font-size:10px;">dok@votum-sa.pl</div>
                                        </div>
                                    </div>

                                    <span class="row contract_name" style="padding-bottom: 5px;"><p style="margin-bottom: 0px;">Odstąpienie od umowy</p></span>
                                    <div class="row justify-content-center" style="margin-bottom: 15px;font-size:10px;">(formularz ten należy wypełnić i odesłać tylko w przypadku chęci odstąpienia od umowy)</div>
                                    <div class="row justify-content-center" style="paddnig-bottom: 5px;font-size:10px;">
                                        Niniejszym informuję/informujemy* o moim/naszym odstąpieniu od umowy zawartej na podstawie zamówienia </br>z dnia:
                                    </div>

                                    <div class="row" style="margin-left: 0px; margin-right:0px; margin-top: 30px;padding: 0px 30px 0px 30px;">
                                        <div class="col-5 padding_column"></div>
                                        <div class="col-7 padding_column">
                                            <div class="row justify-content-center border_bottom" style="padding-bottom: 0.5em;padding-top: 0.5em; margin-left: 0px; margin-right:0px;font-size:9px;"></div>
                                            <div class="row justify-content-center" style="padding-bottom: 1em;padding-top: 0.5em; margin-left: 0px; margin-right:0px;font-size:9px;">IMIĘ I NAZWISKO KONSUMENTA(-ÓW)</div>

                                            <div class="row justify-content-center border_bottom" style="padding-bottom: 0.5em;padding-top: 0.5em; margin-left: 0px; margin-right:0px;font-size:9px;"></div>
                                            <div class="margin_10"></div>
                                            <div class="row justify-content-center border_bottom" style="padding-bottom: 0.5em;padding-top: 0.5em; margin-left: 0px; margin-right:0px;font-size:9px;"></div>
                                            <div class="row justify-content-center" style="padding-bottom: 1em;padding-top: 0.5em; margin-left: 0px; margin-right:0px;font-size:9px;">ADRES ZAMIESZKANIA KONSUMENTA(-ÓW)</div>

                                            <div class="row justify-content-center border_bottom" style="padding-bottom: 0.5em;padding-top: 0.5em; margin-left: 0px; margin-right:0px;font-size:9px;"></div>
                                            <div class="row justify-content-center" style="padding-bottom: 1em;padding-top: 0.5em; margin-left: 0px; margin-right:0px;font-size:9px;">PODPIS KONSUMENTA(-ÓW), DATA</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="number_site_text">
                    <div class="row justify-content-center" style="width: 100%; margin: 0px;">1/2</div>
                </div>
                <div class="print_text"><?php echo $instruction_client; ?></div>
            </div>

            <div class="pdf_strona size-a4 pdf-page new-page">
                <div class="row margin_width" style="padding-top: 70px; padding-bottom: 10px;"></div>


                <div class="row" style="margin-left: 0px; margin-right:0px; margin-top: 50px;padding: 0px 30px 0px 30px;">
                    <div class="col-7 padding_column"></div>
                    <div class="col-5 padding_column" style="margin-top:10px; margin-bottom: 30px;">
                        <div class="row left-content-center" style="padding-bottom: 0em;padding-top: 0em; margin-left: 0px; margin-right:0px;font-size:14px;">VOTUM S.A.</div>
                        <div class="row left-content-center" style="padding-bottom: 0em;padding-top: 0em; margin-left: 0px; margin-right:0px;font-size:14px;">ul. Wyścigowa 56i</div>
                        <div class="row left-content-center" style="padding-bottom: 0em;padding-top: 0em; margin-left: 0px; margin-right:0px;font-size:14px;">53-012 Wrocław</div>
                        <div class="margin_10"></div>
                        <div class="row left-content-center" style="padding-bottom: 0em;padding-top: 0em; margin-left: 0px; margin-right:0px;font-size:14px;">fax: 71/ 33 93 403</div>
                        <div class="row left-content-center" style="padding-bottom: 0em;padding-top: 0em; margin-left: 0px; margin-right:0px;font-size:14px;">dok@votum-sa.pl</div>
                    </div>
                </div>

                <span class="row contract_name" style="padding-bottom: 5px;"><p style="margin-bottom: 0px;font-size:16px;">ODSTAPIENIE OD UMOWY</p></span>
                <div class="row justify-content-center" style="margin-bottom: 15px;font-size:12px;">(formularz ten należy wypełnić i odesłać tylko w przypadku chęci odstąpienia od umowy)</div>
                <div class="clear"></div>
                <div class="row justify-content-center" style="font-size:14px;padding: 0px 40px 0px 40px;">
                    Niniejszym informuję/informujemy* o moim/naszym odstąpieniu od umowy zawartej na podstawie zamówienia z dnia:
                </div>

                <div class="row" style="margin-left: 0px; margin-right:0px; margin-top: 30px;padding: 0px 30px 0px 30px;">
                    <div class="col-5 padding_column"></div>
                    <div class="col-7 padding_column">
                        <div class="row justify-content-center border_bottom" style="padding-bottom: 0.5em;padding-top: 0.5em; margin-left: 0px; margin-right:0px;font-size:9px;"></div>
                        <div class="row justify-content-center" style="padding-bottom: 1em;padding-top: 0.5em; margin-left: 0px; margin-right:0px;font-size:12px;">IMIĘ I NAZWISKO KONSUMENTA(-ÓW)</div>

                        <div class="row justify-content-center border_bottom" style="padding-bottom: 0.5em;padding-top: 0.5em; margin-left: 0px; margin-right:0px;font-size:9px;"></div>
                        <div class="margin_10"></div>
                        <div class="margin_10"></div>
                        <div class="row justify-content-center border_bottom" style="padding-bottom: 0.5em;padding-top: 0.5em; margin-left: 0px; margin-right:0px;font-size:9px;"></div>
                        <div class="row justify-content-center" style="padding-bottom: 1em;padding-top: 0.5em; margin-left: 0px; margin-right:0px;font-size:12px;">ADRES ZAMIESZKANIA KONSUMENTA(-ÓW)</div>

                        <div class="row justify-content-center border_bottom" style="padding-bottom: 0.5em;padding-top: 0.5em; margin-left: 0px; margin-right:0px;font-size:9px;"></div>
                        <div class="row justify-content-center" style="padding-bottom: 1em;padding-top: 0.5em; margin-left: 0px; margin-right:0px;font-size:12px;">PODPIS KONSUMENTA(-ÓW), DATA</div>
                    </div>
                </div>


                <div class="number_site_text">
                    <div class="row justify-content-center" style="width: 100%; margin: 0px;">2/2</div>
                </div>
                <div class="print_text"><?php echo $instruction_client; ?></div>
            </div>

        </div>

          <script type="text/javascript">

              var viewModel = kendo.observable({
                  isVisible: true,
                  isEnabled: true,
                  onClick: function() {
                      kendo.drawing.drawDOM('.print-contract', {
                          forcePageBreak: ".new-page",
                          paperSize: "A4",
                          margin: "0cm"
                      }).then(function(group){
                          kendo.drawing.pdf.saveAs(group, "contract.pdf");
                      });
                  }
              });
              kendo.bind($(".printContract"), viewModel);
          </\script>
</script>
