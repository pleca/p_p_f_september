<?php
$contract_layout_number = 'PG-2-21-F8/2018-06-15';
$aggreement_layout_number = 'PG-2-21-F9/2018-05-24';
$enablement_votum_layout_number = 'PG-2-21-F2/2018-05-24';
$resignation_layout_number = 'PG-2-21-F4/2018-05-24';
?>
<script type="x/kendo-template" id="tmpPrint">

    <div class="page-template">
        <button
                class="export-pdf printContractEdit"
                data-role="button"
                data-icon="print"
                data-bind="visible: isVisible, enabled: isEnabled, events: { click: onClick }"
                style="width: 180px"
        >Drukuj</button>
        <div id="print-contract-edit">
            <div class="pdf_strona size-a4 pdf-page">
                <div class="header">
                    <div class="agent_id">
                        <div class="box" style="width: 50%;font-size: 12px; padding-top: 2px;">#= data.agent_number #</div>
                        <span>IDENTYFIKATOR PRZEDSTAWICIELA</span>
                    </div>
                    <div class="logo_right">
                        <img src="<?php echo 'https://' . $_SERVER ['HTTP_HOST']; ?>/img/logo_small.png" />
                    </div>
                    <div class="unit_code">
                        <div class="box" style="margin-right: 5px; font-size: 12px; padding-top: 2px;">#= data.unit_id #</div>
                        <span>KOD JEDNOSTKI</span>
                    </div>
                    <div class="consultant_code">
                        <div class="box" style="margin-right: 5px; font-size: 12px; padding-top: 2px;">#= data.consultant_id #</div>
                        <span>KOD KONSULTANTA</span>
                    </div>
                </div>
                <span class="contract_name">UMOWA KOMPLEKSOWEJ OBSŁUGI SPRAWY BANKOWEJ
                        #if(data.ContractType == '3'){#
                            (BASIC)
                            #}else if (data.ContractType == '2') {#
                            (PREMIUM)
                            #}else if (data.ContractType == '1') {#
                            (VIP)
                            #}#
                    </span>
                <p class="date">zawarta w dniu #= data.add_date # przez:</p>
                <div class="form_section_client">
                    <div class="red_margin"></div>
                    <div class="form_section_body">
                        <div class="body_form">
                            <ul class="fieldlist">
                                <label for="simple-input" class="label_contract" style="width: 100%; float: left; font-weight: bold;">Zleceniodawca I</label>
                                <li>
                                    <div style="width: 50%; float: left;">
                                        <input name="FirstNameI" type="text" class="k-input k-textbox"
                                               value="#= (data.FirstName1 != null) ? data.FirstName1 : '' #"
                                               style="width: 95%;height:18px;font-size:10px;"/>
                                        <label class="small_label_contract" for="simple-input">imię</label>
                                    </div>
                                    <div style="width: 50%; float: left;">
                                        <input name="LastNameI" type="text" class="k-input k-textbox"
                                               value="#= (data.LastName1 != null) ? data.LastName1 : '' #"
                                               style="width: 100%; height: 18px;font-size:10px;"/>
                                        <label class="small_label_contract" for="simple-input">nazwisko</label>
                                    </div>
                                </li>
                                <label for="simple-input" class="label_contract" style="width: 100%; float: left; font-weight: bold;">Adres zameldowania zleceniodawcy:</label>
                                <li>
                                    <div style="width: 60%; float: left;">
                                        <input name="StreetI" type="text" class="k-input k-textbox"
                                               value="#= (data.Street1 != null) ? data.Street1 : '' #"
                                               style="width: 95%; height: 18px;font-size:10px;"/>
                                        <label class="small_label_contract" for="simple-input">ulica</label>
                                    </div>
                                    <div style="width: 20%; float: left;">
                                        <input name="HomeNumberI" type="text" class="k-input k-textbox"
                                               value="#= (data.Home1 != null) ? data.Home1 : '' #"
                                               style="width: 95%; height: 18px;font-size:10px;"/>
                                        <label class="small_label_contract" for="simple-input">nr domu/mieszkania</label>
                                    </div>
                                    <div style="width: 20%; float: left;">
                                        <input name="PostCodeI" type="text" class="k-input k-textbox"
                                               value="#= (data.PostCode1 != null) ? data.PostCode1 : '' #"
                                               style="width: 100%; height: 18px;font-size:10px;"/>
                                        <label class="small_label_contract" for="simple-input">kod pocztowy</label>
                                    </div>
                                </li>
                                <li>
                                    <div style="width: 33%; float: left;">
                                        <input name="CityI" type="text" class="k-input k-textbox"
                                               value="#= (data.City1 != null) ? data.City1 : '' #"
                                               style="width: 95%; height: 18px;font-size:10px;"/>
                                        <label class="small_label_contract" for="simple-input">miejscowość</label>
                                    </div>
                                    <div style="width: 33%; float: left;">
                                        <input name="PESELI" type="text" class="k-input k-textbox"
                                               value="#= (data.PESEL1 != null) ? data.PESEL1 : '' #"
                                               style="width: 95%; height: 18px;font-size:10px;"/>
                                        <label class="small_label_contract" for="simple-input">PESEL</label>
                                    </div>
                                    <div style="width: 33%; float: left;">
                                        <input name="IdentityCardI" type="text" class="k-input k-textbox"
                                               value="#= (data.IdNr1 != null) ? data.IdNr1 : '' #"
                                               style="width: 100%; height: 18px;font-size:10px;"/>
                                        <label class="small_label_contract" for="simple-input">seria i numer dowodu osobistego</label>
                                    </div>
                                </li>
                                <li>
                                    <div style="width: 30%; float: left;">
                                        <input name="PhoneI" type="text" class="k-input k-textbox"
                                               value="#= (data.Phone1 != null) ? data.Phone1 : '' #"
                                               style="width: 95%;height: 18px;font-size:10px;"/>
                                        <label class="small_label_contract" for="simple-input">telefon *</label>
                                    </div>
                                    <div style="width: 70%; float: left;">
                                        <input name="EmailI" type="text" class="k-input k-textbox"
                                               value="#= (data.Email1 != null) ? data.Email1 : '' #"
                                               style="width: 100%; height: 18px;font-size:10px;"/>
                                        <label class="small_label_contract" for="simple-input">e-mail **</label>
                                    </div>
                                </li>

                                <label for="simple-input" class="label_contract" style="width: 100%; float: left; font-weight: bold;">oraz</label>
                                <label for="simple-input" class="label_contract" style="width: 100%; float: left; font-weight: bold;">Zleceniodawca II</label>
                                <li>
                                    <div style="width: 50%; float: left;">
                                        <input name="FirstNameII" type="text" class="k-input k-textbox"
                                               value="#= (data.FirstName2 != null) ? data.FirstName2 : '' #"
                                               style="width: 95%;height: 18px;font-size:10px;"/>
                                        <label class="small_label_contract" for="simple-input">imię</label>
                                    </div>
                                    <div style="width: 50%; float: left;">
                                        <input name="LastNameII" type="text" class="k-input k-textbox"
                                               value="#= (data.LastName2 != null) ? data.LastName2 : '' #"
                                               style="width: 100%; height: 18px;font-size:10px;"/>
                                        <label class="small_label_contract" for="simple-input">nazwisko</label>
                                    </div>
                                </li>
                                <label for="simple-input" class="label_contract" style="width: 100%; float: left; font-weight: bold;">Adres zameldowania zleceniodawcy:</label>
                                <li>
                                    <div style="width: 60%; float: left;">
                                        <input name="StreetII" type="text" class="k-input k-textbox"
                                               value="#= (data.Street2 != null) ? data.Street2 : '' #"
                                               style="width: 95%; height: 18px;font-size:10px;"/>
                                        <label class="small_label_contract" for="simple-input">ulica</label>
                                    </div>
                                    <div style="width: 20%; float: left;">
                                        <input name="HomeNumberII" type="text" class="k-input k-textbox"
                                               value="#= (data.Home2 != null) ? data.Home2 : '' #"
                                               style="width: 95%; height: 18px;font-size:10px;"/>
                                        <label class="small_label_contract" for="simple-input">nr domu/mieszkania</label>
                                    </div>
                                    <div style="width: 20%; float: left;">
                                        <input name="PostCodeII" type="text" class="k-input k-textbox"
                                               value="#= (data.PostCode2 != null) ? data.PostCode2 : '' #"
                                               style="width: 100%; height: 18px;font-size:10px;"/>
                                        <label class="small_label_contract" for="simple-input">kod pocztowy</label>
                                    </div>
                                </li>
                                <li>
                                    <div style="width: 33%; float: left;">
                                        <input name="CityII" type="text" class="k-input k-textbox"
                                               value="#= (data.City2 != null) ? data.City2 : '' #"
                                               style="width: 95%; height: 18px;font-size:10px;"/>
                                        <label class="small_label_contract" for="simple-input">miejscowość</label>
                                    </div>
                                    <div style="width: 33%; float: left;">
                                        <input name="PESELII" type="text" class="k-input k-textbox"
                                               value="#= (data.PESEL2 != null) ? data.PESEL2 : '' #"
                                               style="width: 95%; height: 18px;font-size:10px;"/>
                                        <label class="small_label_contract" for="simple-input">PESEL</label>
                                    </div>
                                    <div style="width: 33%; float: left;">
                                        <input name="IdentityCardII" type="text" class="k-input k-textbox"
                                               value="#= (data.IdNr2 != null) ? data.IdNr2 : '' #"
                                               style="width: 100%; height: 18px;font-size:10px;"/>
                                        <label class="small_label_contract" for="simple-input">seria i numer dowodu osobistego</label>
                                    </div>
                                </li>
                                <li>
                                    <div style="width: 30%; float: left;">
                                        <input name="PhoneII" type="text" class="k-input k-textbox"
                                               value="#= (data.Phone2 != null) ? data.Phone2 : '' #"
                                               style="width: 95%;height: 18px;font-size:10px;"/>
                                        <label class="small_label_contract" for="simple-input">telefon *</label>
                                    </div>
                                    <div style="width: 70%; float: left;">
                                        <input name="EmailII" type="text" class="k-input k-textbox"
                                               value="#= (data.Email2 != null) ? data.Email2 : '' #"
                                               style="width: 100%; height: 18px;font-size:10px;"/>
                                        <label class="small_label_contract" for="simple-input">e-mail **</label>
                                    </div>
                                </li>
                                <label for="simple-input" class="label_contract" style="width: 100%; float: left; font-weight: bold;">Adres korespondencyjny:</label>
                                <li>
                                    <div style="width: 60%; float: left;">
                                        <input name="Street" type="text" class="k-input k-textbox"
                                               value="#= (data.ForrwardingStreet != null) ? data.ForrwardingStreet : '' #"
                                               style="width: 95%; height: 18px;font-size:10px;"/>
                                        <label class="small_label_contract" for="simple-input">ulica</label>
                                    </div>
                                    <div style="width: 20%; float: left;">
                                        <input name="HomeNumber" type="text" class="k-input k-textbox"
                                               value="#= (data.ForrwardingHome != null) ? data.ForrwardingHome : '' #"
                                               style="width: 95%; height: 18px;font-size:10px;"/>
                                        <label class="small_label_contract" for="simple-input">nr domu/mieszkania</label>
                                    </div>
                                    <div style="width: 20%; float: left;">
                                        <input name="PostCode" type="text" class="k-input k-textbox"
                                               value="#= (data.ForrwardingPostalCode != null) ? data.ForrwardingPostalCode : '' #"
                                               style="width: 100%; height: 18px;font-size:10px;"/>
                                        <label class="small_label_contract" for="simple-input">kod pocztowy</label>
                                    </div>
                                </li>
                                <li>
                                    <div style="width: 33%; float: left;">
                                        <input name="City" type="text" class="k-input k-textbox"
                                               value="#= (data.ForrwardingCity != null) ? data.ForrwardingCity : '' #"
                                               style="width: 95%; height: 18px;font-size:10px;"/>
                                        <label class="small_label_contract" for="simple-input">miejscowość</label>
                                    </div>
                                </li>
                                <label for="simple-input" class="label_contract" style="width: 100%; float: left;">zwanego/zwanych dalej <span>KLIENTEM</span></label>
                                <label for="simple-input" class="label_contract" style="width: 100%; float: left; font-weight: bold;text-align:center;">a</label>
                                <label for="simple-input" class="label_contract" style="width: 100%; float: left; font-weight: bold;">ZLECENIOBIORCĄ:
                                </label>
                            </ul>
                            <p style="width: 100%; float: left; font-size:10px;padding:0 10px 0 10px;">
                                VOTUM S.A. z siedzibą we Wrocławiu 53-012, ul. Wyścigowa 56i, tel. 71/ 33 93 400, faks. 71/ 33 93 403, e-mail: dok@votum-sa.pl, zarejestrowana
                                w Sądzie Rejonowym dla Wrocławia Fabrycznej VI Wydział Gospodarczy Krajowego Rejestru Sądowego pod numerem KRS: 0000243252,
                                REGON: 020136043, NIP: 899-25-49-057, KAPITAŁ ZAKŁADOWY: 1 200 000 zł. wpłacony w całości.
                            </p>
                        </div>
                    </div>
                    <div class="red_margin"></div>
                </div>
                <div class="contract_text">
                    <p>* numer telefonu dedykowany do otrzymywania powiadomień z informacjami o etapach sprawy drogą wiadomości sms,</p>
                    <p>** adres e-mail dedykowany do otrzymywania wiadomości z informacjami o etapach sprawy</p>
                </div>
                <div class="capture">
                    <div class="red_margin_capture"></div>
                    <div class="number_capture"> I </div>
                    <div class="capture_title">PRZEDMIOT UMOWY</div>
                </div>
                <div class="contract_text justyfy">
                    <p>Zleceniobiorca (zwany dalej VOTUM) zobowiązuje się na zlecenie Zleceniodawcy do powzięcia czynności polegających na dochodzeniu
                        roszczeń od <span>#= (data.BankName != null) ? data.BankName : '____________________________________________' #</span> (zwanego dalej: Zobowiązanym) dotyczących umowy kredytu hipotecznego
                        lub konsolidacyjnego numer <span>#= (data.BankContractNumber != null) ? data.BankContractNumber : '____________________________________________' #</span> waloryzowanego bądź denominowanego do waluty obcej w związku z zastosowaną przez bank konstrukcją indeksacji oraz ubezpieczeń z nią powiązanych.</p>
                </div>
                <div class="footer"><p style="width: 60%;float:right;">1/4</p></div>
                <div class="print_text"><?php echo $contract_layout_number; ?></div>
            </div>
            <div class="pdf_strona size-a4 pdf-page new-page">
                <div class="header">
                    <div class="logo_left">
                        <img src="<?php echo 'https://' . $_SERVER ['HTTP_HOST']; ?>/img/laur_small.png" />
                    </div>
                    <div class="logo_right">
                        <img src="<?php echo 'https://' . $_SERVER ['HTTP_HOST']; ?>/img/logo_small.png" />
                    </div>
                </div>
                <div class="clear"></div>
                <div class="clear"></div>
                <div class="capture">
                    <div class="red_margin_capture"></div>
                    <div class="number_capture"> II </div>
                    <div class="capture_title">GWARANCJE VOTUM</div>
                </div>
                <div class="contract_text justyfy">
                    <p>Votum gwarantuje, że:</p>
                    <ul style="list-style-type: none;font-size:9px !important;padding-left:5px !important;margin-bottom: 0px!important">
                        <li>a. dokona szczegółowej analizy otrzymanej od Klienta dokumentacji bankowej,</li>
                        <li>b. przygotuje i przekaże Klientowi wniosek o wydanie dokumentacji niezbędnej do wykonania umowy</li>
                        <li>c. w przypadku odmowy wydania dokumentacji przez Zobowiązanego przygotuje i przekaże Klientowi reklamację,</li>
                        <li>d. w przypadku odmowy wydania przez Zobowiązanego dokumentacji po złożonej uprzednio reklamacji przygotuje oraz złoży skargę do
                            Rzecznika Finansowego,</li>
                        <li>e. dokona oszacowania należnego Klientowi roszczenia z tytułu nadpłaconych rat, poprzez analizę wysokości każdej pojedynczej
                            zapłaconej przez Klienta na rzecz Zobowiązanego raty kapitałowo-odsetkowej i porównanie jej z ratą kapitałowo-odsetkową
                            niezawierającą klauzuli waloryzacyjnej do waluty obcej, z uwzględnieniem ilości uruchomionych transz, procentowej wartości danej
                            transzy w stosunku do kursu waluty obcej, po jakim została uruchomiona oraz wpływu kursu uruchomienia każdej z pojedynczych
                                transz na średni kurs udzielenia całego kredytu, mając na względzie wiedzę dostępną na dzień oszacowania,</li>
                        <li>f. dokona analizy zasadności wystąpienia wobec Zobowiązanego z roszczeniem o zwrot kwoty uiszczonej tytułem ubezpieczenia niskiego
                            wkładu własnego,</li>
                        <li>g. dokona analizy zasadności wystąpienia wobec Zobowiązanego z roszczeniem o zwrot proporcjonalnej, nienależnej części składki
                            uiszczonej na ubezpieczenie pomostowe,</li>
                        <li>h. w uzasadnionych przypadkach przedstawi Klientowi alternatywne roszczenie o unieważnienie umowy kredytowej,</li>
                        <li>i. w uzasadnionych przypadkach złoży wniosek o wszczęcie postępowania w sprawie rozwiązywania sporów między Klientem a podmiotem
                            rynku finansowego bądź skargę do Rzecznika Finansowego,</li>
                        <li>i. w uzasadnionych przypadkach złoży umowę o przeprowadzenie mediacji w centrum mediacji Sądu Polubownego przy Komisji Nadzoru
                            Finansowego,</li>
                        <li>k. wyłoży w imieniu Klienta opłatę w kwocie 50 zł (słownie: pięćdziesiąt złotych) za złożenie wniosku o wszczęcie postępowania w sprawie
                            rozwiązywania sporów między Klientem a podmiotem rynku finansowego do Rzecznika Finansowego,</li>
                        <li>l. wyłoży w imieniu Klienta opłatę w kwocie 50 zł (słownie: pięćdziesiąt złotych) za złożenie umowy o przeprowadzenie mediacji w centrum
                            mediacji Sądu Polubownego przy Komisji Nadzoru Finansowego</li>
                        <li>m. w uzasadnionych przypadkach przygotuje dokumentację do przeprowadzenia postępowania o zawezwanie do próby ugodowej przeciwko
                            Zobowiązanemu w terminie do 14 dni licząc od dnia uzupełnienia przez Klienta dokumentacji niezbędnej do prawidłowego złożenia
                            takiego wniosku</li>
                        <li>n. przekaże Klientowi na wskazany przez niego rachunek uzyskane na jego rzecz środki w terminie 7 dni roboczych od ich wpływu na
                            rachunek VOTUM, po uprzednim potrąceniu wynagrodzenia i poniesionych kosztów,</li>
                        <li>o. nie zawrze ugody ze Zobowiązanym bez uprzedniej pisemnej zgody Klienta,</li>
                        <li>p. powództwo o zapłatę zostanie wytoczone tylko w przypadku zgody obu stron umowy, w tym pisemnej zgody Klienta,</li>
                        <li>q. po prawomocnym zakończeniu postępowania sądowego przedstawi Klientowi rekomendację w zakresie zasadności skierowania
                            wobec Zobowiązanego dodatkowego roszczenia o obniżenie salda zadłużenia z tytułu umowy kredytowej,</li>
                        <li>r. będzie systematycznie informować Klienta o przebiegu wykonania umowy,</li>
                        <li>s. udzieli odpowiedzi na złożoną reklamację w terminie 21 dni od dnia jej otrzymania.</li>
                    </ul>
                </div>
                <div class="clear"></div>
                <div class="capture">
                    <div class="red_margin_capture"></div>
                    <div class="number_capture"> III </div>
                    <div class="capture_title">OBSŁUGA EKSPERCKA</div>
                </div>
                <div class="contract_text justyfy">
                    <p>Votum w ramach uzyskanego od Klienta wynagrodzenia i w zakresie niezbędnym do wykonania umowy, pokrywa koszty wskazanego przez
                        siebie:</p>
                    <ul style="list-style-type: none;font-size:9px !important;padding-left:5px !important;margin-bottom: 0px!important">
                        <li>a. specjalisty obsługi spraw finansowych na każdym etapie wykonania umowy,</li>
                        <li>b. specjalisty w zakresie szacowania roszczeń w postępowaniu przedsądowym,</li>
                        <li>c. pełnomocnika Klienta w postępowaniu mediacyjnym,</li>
                        <li>d. adwokata lub radcy prawnego reprezentującego Klienta w postępowaniu przedsądowym, pojednawczym, sądowym oraz egzekucyjnym.</li>
                    </ul>
                </div>
                <div class="clear"></div>
                <div class="capture">
                    <div class="red_margin_capture"></div>
                    <div class="number_capture"> IV </div>
                    <div class="capture_title">WYNAGRODZENIE VOTUM</div>
                </div>
                <div class="contract_text justyfy" style="padding-bottom:0px !important;">
                    <ul style="font-size:9px !important;padding-left:5px !important;margin-bottom: 8px!important; list-style-type: none;">
                        <li>1. VOTUM zobowiązuje się do przekazania Klientowi uzyskanych świadczeń w terminie 7 dni roboczych od dnia ich otrzymania,
                            po uprzednim potrąceniu należnego VOTUM wynagrodzenia i poniesionych wydatków na wskazany przez Zleceniodawcę rachunek
                            bankowy:</li>
                    </ul>
                </div>
                <div class="clear"></div>
                <div class="form_section_customer">
                    <div class="red_margin"></div>
                    <div class="form_section_body">
                        <div class="body_form">
                            <ul class="fieldlist">
                                <li>
                                    <div style="width: 100%; float: left;">
                                        <input name="AccountNumber" type="text" class="k-input k-textbox"
                                               value="#= (data.CustomerAccountNumber != null) ? data.CustomerAccountNumber: '' #"
                                               style="width: 100%; height: 18px;font-size:10px;"/>
                                        <label class="small_label_contract" for="simple-input">nr rachunku bankowego</label>
                                    </div>
                                </li>
                                <li>
                                    <div style="width: 50%; float: left;">
                                        <input name="CustomerFirstName" type="text" class="k-input k-textbox"
                                               value="#= (data.CustomerFirstname != null) ? data.CustomerFirstname: '' #"
                                               style="width: 95%;height: 18px;font-size:10px;"/>
                                        <label class="small_label_contract" for="simple-input">imię</label>
                                    </div>
                                    <div style="width: 50%; float: left;">
                                        <input name="CustomerLastName" type="text" class="k-input k-textbox"
                                               value="#= (data.CustomerLastname != null) ? data.CustomerLastname: '' #"
                                               style="width: 100%; height: 18px;font-size:10px;"/>
                                        <label class="small_label_contract" for="simple-input">nazwisko</label>
                                    </div>
                                </li>
                                <li>
                                    <div style="width: 60%; float: left;">
                                        <input name="CustomerStreet" type="text" class="k-input k-textbox"
                                               value="#= (data.CustomerStreet != null) ? data.CustomerStreet: '' #"
                                               style="width: 95%; height: 18px;font-size:10px;"/>
                                        <label class="small_label_contract" for="simple-input">ulica</label>
                                    </div>
                                    <div style="width: 20%; float: left;">
                                        <input name="CustomerHomeNumber" type="text" class="k-input k-textbox"
                                               value="#= (data.CustomerStreetNumber != null) ? data.CustomerStreetNumber: '' #"
                                               style="width: 95%; height: 18px;font-size:10px;"/>
                                        <label class="small_label_contract" for="simple-input">nr domu/mieszkania</label>
                                    </div>
                                    <div style="width: 20%; float: left;">
                                        <input name="CustomerPostCode" type="text" class="k-input k-textbox"
                                               value="#= (data.CustomerPostalCode != null) ? data.CustomerPostalCode: '' #"
                                               style="width: 100%; height: 18px;font-size:10px;"/>
                                        <label class="small_label_contract" for="simple-input">kod pocztowy</label>
                                    </div>
                                </li>
                                <li>
                                    <div style="width: 33%; float: left;">
                                        <input name="CustomerCity" type="text" class="k-input k-textbox"
                                               value="#= (data.CustomerCity != null) ? data.CustomerCity: '' #"
                                               style="width: 95%; height: 18px;font-size:10px;"/>
                                        <label class="small_label_contract" for="simple-input">miejscowość</label>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="red_margin"></div>
                </div>
                <div class="footer"><p style="width: 100%">2/4</p></div>
                <div class="print_text"><?php echo $contract_layout_number; ?></div>
            </div>

            <div class="pdf_strona size-a4 pdf-page new-page">
                <div class="header">
                    <div class="logo_left">
                        <img src="<?php echo 'https://' . $_SERVER ['HTTP_HOST']; ?>/img/laur_small.png" />
                    </div>
                    <div class="logo_right">
                        <img src="<?php echo 'https://' . $_SERVER ['HTTP_HOST']; ?>/img/logo_small.png" />
                    </div>
                </div>
                <div class="clear"></div>
                <div class="contract_text justyfy">
                    <ul style="font-size:9px !important;padding-left:5px !important;margin-bottom: 8px!important; list-style-type: none;">
                        <li>2. Klient upoważnia VOTUM do odbioru wszelkich uzyskanych w jego imieniu świadczeń w ramach wykonania niniejszej umowy.</li>
                        <li>3. VOTUM przysługuje wynagrodzenie w kwocie <span>
                            #if(data.ContractType == '3'){#
                            3.075
                            #}else if (data.ContractType == '2') {#
                            6.150
                            #}else if (data.ContractType == '1') {#
                            12.300
                            #}#
                            </span>
                            zł. (słownie:
                            #if(data.ContractType == '3'){#
                            <?php echo slownie(intval(3075)); ?>
                            #}else if (data.ContractType == '2') {#
                            <?php echo slownie(intval(6150)); ?>
                            #}else if (data.ContractType == '1') {#
                            <?php echo slownie(intval(12300)); ?>
                            #}#
                            ) brutto (w tym podatek od
                            towarów i usług VAT w wysokości 23%) za analizę merytoryczną dokumentacji, roszczeń Klienta, przeprowadzenie postępowania
                            przedsądowego, przygotowanie dokumentacji do postępowania pojednawczego, sądowego oraz egzekucyjnego.</li>
                        <li>4. Klient uiszcza z góry wynagrodzenie, o którym mowa w ust. 3 powyżej, na rachunek bankowy VOTUM o numerze:
                            40 1050 1575 1000 0023 1250 6476, w terminie 7 dni od dnia przekazania Klientowi informacji VOTUM o zarejestrowaniu sprawy
                            i nadaniu jej numeru, który należy podać w tytule przelewu. VOTUM może wstrzymać się z wykonaniem umowy do dnia uiszczenia
                            wynagrodzenia, o którym mowa w ust. 3 powyżej.</li>
                        <li>5. Niezależnie od wynagrodzenia, o którym mowa w ustępie 3, z tytułu wykonania niniejszej umowy VOTUM przysługuje wynagrodzenie
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
                            W takim przypadku Klient zobowiązany jest do uiszczenia wynagrodzenia w terminie 7 dni od dnia otrzymania od VOTUM faktury VAT.</li>
                        <li>6. Votum przysługuje zwrot wyłożonej tymczasowo opłaty w kwocie 50 zł (słownie: pięćdziesiąt złotych) za złożenie wniosku o wszczęcie
                            postępowania w sprawie rozwiązywania sporów między klientem a podmiotem rynku finansowego do Rzecznika Finansowego</li>
                        <li>7. Votum przysługuje zwrot wyłożonej tymczasowo w imieniu Klienta opłaty w kwocie 50 zł (słownie: pięćdziesiąt złotych) za złożenie
                            umowy o przeprowadzenie mediacji w centrum mediacji Sądu Polubownego przy Komisji Nadzoru Finansowego</li>
                        <li>8. W przypadku poniesienia przez VOTUM kosztów procesu podlegają one zwrotowi na rzecz VOTUM wyłącznie z kwoty ogółu świadczeń
                            przyznanych Klientowi rozstrzygnięciem sądu lub ugodą, a koszty zastępstwa procesowego zasądzone w sprawie przypadają
                            reprezentującemu Klienta pełnomocnikowi procesowemu wskazanemu przez VOTUM.</li>
                        <li>9. W przypadku spełnienia świadczenia przez Zobowiązanego bezpośrednio do rąk Klienta po dacie zawarcia niniejszej umowy,
                            Klient zobowiązuje się niezwłocznie powiadomić o tym VOTUM i wpłacić w terminie 7 dni roboczych od dnia jego otrzymania należne
                            VOTUM wynagrodzenie wraz z poniesionymi przez VOTUM kosztami w związku z realizacją umowy, na rachunek bankowy
                            prowadzony w ING Bank Śląski S.A. Oddział we Wrocławiu, nr 40 1050 1575 1000 0023 1250 6476 bądź w inny sposób wskazany przez
                            VOTUM.</li>
                        <li>10. Za zobowiązania wynikające z niniejszej umowy Klienci ponoszą odpowiedzialność solidarną.</li>
                    </ul>
                </div>
                <div class="clear"></div>
                <div class="capture">
                    <div class="red_margin_capture"></div>
                    <div class="number_capture"> V </div>
                    <div class="capture_title">CZAS TRWANIA UMOWY</div>
                </div>
                <div class="contract_text justyfy">
                    <ul style="font-size:9px !important;padding-left:15px !important;margin-bottom: 8px!important; list-style-type: none;">
                        <li>1. Umowa zostaje zawarta na czas do całkowitego wyegzekwowania dla Klienta świadczeń należnych od Zobowiązanego w postępowaniu
                            przedsądowym, sądowym i egzekucyjnym.</li>
                        <li>2. Klient może wypowiedzieć umowę w każdym czasie. Jeżeli wypowiedzenie nastąpiło bez ważnego powodu, a na skutek wykonania
                            umowy Klient uzyskał od Zobowiązanego świadczenie lub doszło do zmniejszenia salda zadłużenia, VOTUM może domagać się
                            naprawienia szkody wyłącznie do kwoty wysokości wynagrodzenia, jakie zostałoby naliczone, gdyby Klient nie wypowiedział umowy.</li>
                        <li>3. W przypadku wypowiedzenia umowy bez ważnego powodu przez VOTUM, jest ona odpowiedzialna za szkodę.</li>
                    </ul>
                </div>
                <div class="clear"></div>
                <div class="capture">
                    <div class="red_margin_capture"></div>
                    <div class="number_capture"> VI </div>
                    <div class="capture_title">OŚWIADCZENIA STRON</div>
                </div>
                <div class="contract_text justyfy">
                    <p>Votum oświadcza, że:</p>
                    <ul type="a" style="list-style-type: none;font-size:9px !important;padding-left:5px !important;margin-bottom: 0px!important">
                        <li>a. informacje o sposobie wykonania umowy mogą być przekazywane na wskazany w umowie nr telefonu, adres e-mail, pocztą lub na
                            konto Klienta dostępne za pośrednictwem strony internetowej VOTUM: www.votum-sa.pl,</li>
                        <li>b. Klient może złożyć reklamacje na świadczone przez VOTUM usługi listem poleconym na adres spółki.</li>
                    </ul>

                    <div style="width:100%; float:left;">
                        <p>Klient oświadcza, że żąda rozpoczęcia wykonywania usługi przez VOTUM przed upływem terminu do odstąpienia od umowy:</p>
                    </div>
                    <div style="width:100%; float:left;">
                        <p><i class="checkbox">#=(data.RadioButton1 == '1') ? 'X' : '&nbsp&nbsp&nbsp'#</i> TAK <i class="checkbox">#=(data.RadioButton1 != '1') ? 'X' : '&nbsp&nbsp&nbsp'#</i> NIE</p>
                    </div>

                    <p>Klient oświadcza, że</p>
                    <p><i class="checkbox">#=(data.RadioButton2 == '1') ? 'X' : '&nbsp&nbsp&nbsp'#</i> upoważnia / <i class="checkbox">#=(data.RadioButton2 != '1') ? 'X' : '&nbsp&nbsp&nbsp'#</i> nie upoważnia Zleceniobiorcy do uzyskiwania informacji i
                        dokumentów w sprawach prowadzonych przez Kancelarię Adwokatów i Radców Prawnych A. Łebek i Wspólnicy sp.k. z siedzibą we Wrocławiu, w związku
                        z realizacją niniejszej umowy</p>

                    <!--<div style="width:100%; float:left;">
                        <p class="checkbox">#=(data.RadioButton2 == '1') ? 'X' : ''#</p><p class="left">upoważnia /</p>
                        <p class="checkbox">#=(data.RadioButton1 != '1') ? 'X' : ''#</p><p class="left">nie upoważnia Zleceniobiorcy do uzyskiwania informacji i
                            dokumentów w sprawach prowadzonych przez Kancelarię Adwokatów i Radców Prawnych A. Łebek i Wspólnicy sp.k. z siedzibą we Wrocławiu, w związku
                            z realizacją niniejszej umowy</p>
                    </div>-->


                    <p>Klient oświadcza, że:</p>
                    <ul style="list-style-type: none;font-size:9px !important;padding-left:15px !important;margin-bottom: 0px!important">
                        <li>a. został poinformowany o sposobie i terminie prawa odstąpienia od niniejszej umowy oraz wzorze oświadczenia o odstąpieniu
                            i o pozasądowych sposobach rozpatrywania reklamacji – na odrębnym formularzu,</li>
                        <li>b. zobowiązuje się do zachowania poufności w związku z prowadzoną sprawą, co do każdego jej etapu i nieudostępniania informacji
                            oraz dokumentacji osobom trzecim,</li>
                        <li>c.
                            #if(data.RadioButton3 == 0 || data.RadioButton3 == null){#
                            <i class="checkbox">X</i>
                            nie zlecał wcześniej dochodzenia roszczeń żadnemu podmiotowi,
                            <i class="checkbox">&nbsp&nbsp&nbsp</i>
                            zlecał sprawę wcześniej innemu pełnomocnikowi (nazwa):
                            ___________________________________  z którym zawarł umowę dnia _____________________
                            #}else{#
                            <i class="checkbox">&nbsp&nbsp&nbsp</i>
                            nie zlecał wcześniej dochodzenia roszczeń żadnemu podmiotowi,
                            <i class="checkbox">X</i>
                            zlecał sprawę wcześniej innemu pełnomocnikowi (nazwa):
                            #= (data.other_agent_name != null) ? data.other_agent_name: '____________________________________' #  z którym zawarł umowę dnia #= (data.other_agent_date != null || data.other_agent_date != 0) ? data.other_agent_date: '_____________________' #
                            #}#
                        </li>
                        <li>d.
                            #if(data.CheckBox1 == true || data.CheckBox2 == true || data.CheckBox3 == true){#
                            <i class="checkbox">&nbsp&nbsp&nbsp</i>
                            nie zgłaszał roszczeń do Zobowiązanego,
                            <i class="checkbox">X</i>
                            zgłaszał do Zobowiązanego roszczenia tytułem:
                            #}else{#
                            <i class="checkbox">X</i>
                            nie zgłaszał roszczeń do Zobowiązanego,
                            <i class="checkbox">&nbsp&nbsp&nbsp</i>
                            zgłaszał do Zobowiązanego roszczenia tytułem:
                            #}#
                        </li>
                    </ul>
                    <p>
                        #if(data.CheckBox1 == '1'){#
                        <i class="checkbox">X</i>
                        #}else{#
                        <i class="checkbox">&nbsp&nbsp&nbsp</i>
                        #}#
                        nadpłaconych rat w związku z klauzulą waloryzacyjną, data zgłoszenia:
                        #= (data.CheckBox1Date != '') ? data.CheckBox1Date: '__________________' #
                    </p>
                    <p>
                        #if(data.CheckBox2 == '1'){#
                        <i class="checkbox">X</i>
                        #}else{#
                        <i class="checkbox">&nbsp&nbsp&nbsp</i>
                        #}#
                        zapłaconych składek za ubezpieczenie niskiego wkładu własnego, data zgłoszenia:
                        #= (data.CheckBox2Date != '') ? data.CheckBox2Date: '__________________' #
                    </p>
                    <p>
                        #if(data.CheckBox3 == '1'){#
                        <i class="checkbox">X</i>
                        #}else{#
                        <i class="checkbox">&nbsp&nbsp&nbsp</i>
                        #}#
                        nadpłaconej składki za ubezpieczenie pomostowe, data zgłoszenia:
                        #= (data.CheckBox2Date != '') ? data.CheckBox2Date: '__________________' #

                    </p>

                </div>
                <div class="footer"><p style="width: 100%">3/4</p></div>
                <div class="print_text"><?php echo $contract_layout_number; ?></div>
            </div>

            <div class="pdf_strona size-a4 pdf-page new-page">
                <div class="header">
                    <div class="logo_left">
                        <img src="<?php echo 'https://' . $_SERVER ['HTTP_HOST']; ?>/img/laur_small.png" />
                    </div>
                    <div class="logo_right">
                        <img src="<?php echo 'https://' . $_SERVER ['HTTP_HOST']; ?>/img/logo_small.png" />
                    </div>
                </div>
                <div class="clear"></div>
                <div class="capture">
                    <div class="red_margin_capture"></div>
                    <div class="number_capture"> VII </div>
                    <div class="capture_title">WARUNKI PROWADZENIA POSTĘPOWANIA SĄDOWEGO</div>
                </div>
                <div class="contract_text justyfy">
                    <ul style="font-size:9px !important;padding-left:15px !important;margin-bottom: 0px!important;list-style-type: none;">
                        <li>1. Klient jest zobowiązany do zapłaty kosztów prowadzenia postępowania sądowego, w tym:</li>
                        <ul style="list-style-type:none;margin-bottom:0px !important;padding-left:15px !important;">
                            <li>a. opłaty sądowej od pozwu w wysokości 5% wartości przedmiotu sporu, lecz nie więcej niż 1.000 zł, zgodnie z obowiązującymi
                                przepisami (art. 13 ust. 1a Ustawy o kosztach sądowych w sprawach cywilnych, Dz. U. z 2018 r., poz. 300 ze zm.),</li>
                            <li>b. opłaty sądowej za złożenie wniosku o zawezwanie do próby ugodowej w kwocie 40 lub 300 zł, zgodnie z obowiązującymi przepisami
                                (art. 23 pkt 3 lub art. 24 ust. 1 pkt 5) Ustawy o kosztach sądowych w sprawach cywilnych, Dz. U. z 2018 r., poz. 300 ze zm.)</li>
                            <li>c. kosztów przejazdów pełnomocnika procesowego na rozprawy, w wysokości określonej przez przepisy Rozporządzenia Ministra
                                Infrastruktury w sprawie warunków ustalania oraz sposobu dokonywania zwrotu kosztów używania do celów służbowych
                                samochodów osobowych, motocykli i motorowerów niebędących własnością pracodawcy (Dz. U. z 2002 r. nr 27, poz. 271 ze
                                zm.) albo kosztów zastępstwa substytucyjnego w wysokości nie przekraczającej 300 zł brutto (słownie: trzysta złotych) za każde
                                posiedzenie, płatne na 14 dni przed terminem rozprawy,</li>
                            <li>d. opłat skarbowych w kwocie 17 zł (słownie: siedemnaście złotych) od każdego pełnomocnictwa, innych opłat skarbowych oraz
                                opłat sądowych</li>
                        </ul>
                        <li>2. VOTUM nie ponosi odpowiedzialności za skutki wynikłe z nieuregulowania przez Klienta, bądź uregulowania z opóźnieniem, opłat
                            wymienionych powyżej.</li>
                    </ul>
                </div>
                <div class="clear"></div>
                <div class="capture">
                    <div class="red_margin_capture"></div>
                    <div class="number_capture"> VIII </div>
                    <div class="capture_title">PRAWA I OBOWIĄZKI STRON</div>
                </div>
                <div class="contract_text justyfy">
                    <ul style="font-size:9px !important;padding-left:15px !important;margin-bottom: 0px!important;list-style-type: none;">
                        <li>1. Czynności wchodzące w zakres niniejszej umowy VOTUM może wykonywać za pomocą podmiotów współpracujących, w szczególności
                            adwokatów lub radców prawnych, przy czym za działanie tych osób VOTUM odpowiada wobec Klienta jak za działania własne.</li>
                        <li>2. Klient zobowiązuje się do niezwłocznego przekazania VOTUM wszelkich posiadanych informacji dotyczących przedmiotu umowy
                            ze Zobowiązanym oraz wszelkiej dokumentacji i niezbędnych oświadczeń, które będą konieczne do wykonania niniejszej umowy,
                            w szczególności:</li>
                        <ul style="list-style-type:none;margin-bottom:0px !important;padding-left:15px !important;">
                            <li>a. kopii umowy kredytu bankowego wraz z aneksami (jeżeli takowe były zawierane),</li>
                            <li>b. kopii regulaminu kredytów i pożyczek hipotecznych załączonego do umowy kredytu bankowego,</li>
                            <li>c. kopii Tabeli Opłat i Prowizji załączonej do umowy kredytu bankowego.</li>
                        </ul>
                        <li>3. Klient zobowiązuje się do niezwłocznego poinformowania VOTUM o każdorazowej zmianie danych do kontaktu, w szczególności
                            numeru telefonu, adresu e-mail oraz adresu do korespondencji.</li>
                    </ul>
                </div>
                <div class="clear"></div>
                <div class="capture">
                    <div class="red_margin_capture"></div>
                    <div class="number_capture"> IX </div>
                    <div class="capture_title">POSTANOWIENIA KOŃCOWE</div>
                </div>
                <div class="contract_text justyfy">
                    <ul style="font-size:9px !important;padding-left:15px !important;margin-bottom: 0px!important;list-style-type: none;">
                        <li>1. Wszelkie zmiany umowy wymagają formy pisemnej pod rygorem nieważności.</li>
                        <li>2. W kwestiach nieuregulowanych mają zastosowanie przepisy Kodeksu cywilnego</li>
                        <li>3. Umowę sporządzono i podpisano w dwóch jednobrzmiących egzemplarzach, po jednej dla każdej ze stron.</li>
                        <li>4. Integralną częścią niniejszej umowy jest załącznik – Klauzule informacyjne dla Klienta.</li>
                    </ul>
                </div>
                <div class="clear"></div>

                <div class="contract_text" style="margin-top: 20px;">
                    <div style="width: 50%; float: left;">
                        <p style="text-align: left;">_________________________________________</p>
                        <label for="simple-input" style="font-size: 10px; float:left;">VOTUM S.A.</label>
                    </div>
                    <div style="width: 50%; float: right;">
                        <p style="text-align: right;">_________________________________________</p>
                        <label for="simple-input" style="font-size: 10px; float:right;">Zleceniodawca</label>
                    </div>
                </div>

                <div class="footer"><p style="width: 100%">4/4</p></div>
                <div class="print_text"><?php echo $contract_layout_number; ?></div>
            </div>

            <!--KOPIA UMOWY-->

            <div class="pdf_strona size-a4 pdf-page new-page">
                <div class="header">
                    <div class="agent_id">
                        <div class="box" style="width: 50%;font-size: 12px; padding-top: 2px;">#= data.agent_number #</div>
                        <span>IDENTYFIKATOR PRZEDSTAWICIELA</span>
                    </div>
                    <div class="logo_right">
                        <img src="<?php echo 'https://' . $_SERVER ['HTTP_HOST']; ?>/img/logo_small.png" />
                    </div>
                    <div class="unit_code">
                        <div class="box" style="margin-right: 5px; font-size: 12px; padding-top: 2px;">#= data.unit_id #</div>
                        <span>KOD JEDNOSTKI</span>
                    </div>
                    <div class="consultant_code">
                        <div class="box" style="margin-right: 5px; font-size: 12px; padding-top: 2px;">#= data.consultant_id #</div>
                        <span>KOD KONSULTANTA</span>
                    </div>
                </div>
                <span class="contract_name">UMOWA KOMPLEKSOWEJ OBSŁUGI SPRAWY BANKOWEJ
                        #if(data.ContractType == '3'){#
                            (BASIC)
                            #}else if (data.ContractType == '2') {#
                            (PREMIUM)
                            #}else if (data.ContractType == '1') {#
                            (VIP)
                            #}#
                    </span>
                <p class="date">zawarta w dniu #= data.add_date # przez:</p>
                <div class="form_section_client">
                    <div class="red_margin"></div>
                    <div class="form_section_body">
                        <div class="body_form">
                            <ul class="fieldlist">
                                <label for="simple-input" class="label_contract" style="width: 100%; float: left; font-weight: bold;">Zleceniodawca I</label>
                                <li>
                                    <div style="width: 50%; float: left;">
                                        <input name="FirstNameI" type="text" class="k-input k-textbox"
                                               value="#= (data.FirstName1 != null) ? data.FirstName1 : '' #"
                                               style="width: 95%;height:18px;font-size:10px;"/>
                                        <label class="small_label_contract" for="simple-input">imię</label>
                                    </div>
                                    <div style="width: 50%; float: left;">
                                        <input name="LastNameI" type="text" class="k-input k-textbox"
                                               value="#= (data.LastName1 != null) ? data.LastName1 : '' #"
                                               style="width: 100%; height: 18px;font-size:10px;"/>
                                        <label class="small_label_contract" for="simple-input">nazwisko</label>
                                    </div>
                                </li>
                                <label for="simple-input" class="label_contract" style="width: 100%; float: left; font-weight: bold;">Adres zameldowania zleceniodawcy:</label>
                                <li>
                                    <div style="width: 60%; float: left;">
                                        <input name="StreetI" type="text" class="k-input k-textbox"
                                               value="#= (data.Street1 != null) ? data.Street1 : '' #"
                                               style="width: 95%; height: 18px;font-size:10px;"/>
                                        <label class="small_label_contract" for="simple-input">ulica</label>
                                    </div>
                                    <div style="width: 20%; float: left;">
                                        <input name="HomeNumberI" type="text" class="k-input k-textbox"
                                               value="#= (data.Home1 != null) ? data.Home1 : '' #"
                                               style="width: 95%; height: 18px;font-size:10px;"/>
                                        <label class="small_label_contract" for="simple-input">nr domu/mieszkania</label>
                                    </div>
                                    <div style="width: 20%; float: left;">
                                        <input name="PostCodeI" type="text" class="k-input k-textbox"
                                               value="#= (data.PostCode1 != null) ? data.PostCode1 : '' #"
                                               style="width: 100%; height: 18px;font-size:10px;"/>
                                        <label class="small_label_contract" for="simple-input">kod pocztowy</label>
                                    </div>
                                </li>
                                <li>
                                    <div style="width: 33%; float: left;">
                                        <input name="CityI" type="text" class="k-input k-textbox"
                                               value="#= (data.City1 != null) ? data.City1 : '' #"
                                               style="width: 95%; height: 18px;font-size:10px;"/>
                                        <label class="small_label_contract" for="simple-input">miejscowość</label>
                                    </div>
                                    <div style="width: 33%; float: left;">
                                        <input name="PESELI" type="text" class="k-input k-textbox"
                                               value="#= (data.PESEL1 != null) ? data.PESEL1 : '' #"
                                               style="width: 95%; height: 18px;font-size:10px;"/>
                                        <label class="small_label_contract" for="simple-input">PESEL</label>
                                    </div>
                                    <div style="width: 33%; float: left;">
                                        <input name="IdentityCardI" type="text" class="k-input k-textbox"
                                               value="#= (data.IdNr1 != null) ? data.IdNr1 : '' #"
                                               style="width: 100%; height: 18px;font-size:10px;"/>
                                        <label class="small_label_contract" for="simple-input">seria i numer dowodu osobistego</label>
                                    </div>
                                </li>
                                <li>
                                    <div style="width: 30%; float: left;">
                                        <input name="PhoneI" type="text" class="k-input k-textbox"
                                               value="#= (data.Phone1 != null) ? data.Phone1 : '' #"
                                               style="width: 95%;height: 18px;font-size:10px;"/>
                                        <label class="small_label_contract" for="simple-input">telefon *</label>
                                    </div>
                                    <div style="width: 70%; float: left;">
                                        <input name="EmailI" type="text" class="k-input k-textbox"
                                               value="#= (data.Email1 != null) ? data.Email1 : '' #"
                                               style="width: 100%; height: 18px;font-size:10px;"/>
                                        <label class="small_label_contract" for="simple-input">e-mail **</label>
                                    </div>
                                </li>

                                <label for="simple-input" class="label_contract" style="width: 100%; float: left; font-weight: bold;">oraz</label>
                                <label for="simple-input" class="label_contract" style="width: 100%; float: left; font-weight: bold;">Zleceniodawca II</label>
                                <li>
                                    <div style="width: 50%; float: left;">
                                        <input name="FirstNameII" type="text" class="k-input k-textbox"
                                               value="#= (data.FirstName2 != null) ? data.FirstName2 : '' #"
                                               style="width: 95%;height: 18px;font-size:10px;"/>
                                        <label class="small_label_contract" for="simple-input">imię</label>
                                    </div>
                                    <div style="width: 50%; float: left;">
                                        <input name="LastNameII" type="text" class="k-input k-textbox"
                                               value="#= (data.LastName2 != null) ? data.LastName2 : '' #"
                                               style="width: 100%; height: 18px;font-size:10px;"/>
                                        <label class="small_label_contract" for="simple-input">nazwisko</label>
                                    </div>
                                </li>
                                <label for="simple-input" class="label_contract" style="width: 100%; float: left; font-weight: bold;">Adres zameldowania zleceniodawcy:</label>
                                <li>
                                    <div style="width: 60%; float: left;">
                                        <input name="StreetII" type="text" class="k-input k-textbox"
                                               value="#= (data.Street2 != null) ? data.Street2 : '' #"
                                               style="width: 95%; height: 18px;font-size:10px;"/>
                                        <label class="small_label_contract" for="simple-input">ulica</label>
                                    </div>
                                    <div style="width: 20%; float: left;">
                                        <input name="HomeNumberII" type="text" class="k-input k-textbox"
                                               value="#= (data.Home2 != null) ? data.Home2 : '' #"
                                               style="width: 95%; height: 18px;font-size:10px;"/>
                                        <label class="small_label_contract" for="simple-input">nr domu/mieszkania</label>
                                    </div>
                                    <div style="width: 20%; float: left;">
                                        <input name="PostCodeII" type="text" class="k-input k-textbox"
                                               value="#= (data.PostCode2 != null) ? data.PostCode2 : '' #"
                                               style="width: 100%; height: 18px;font-size:10px;"/>
                                        <label class="small_label_contract" for="simple-input">kod pocztowy</label>
                                    </div>
                                </li>
                                <li>
                                    <div style="width: 33%; float: left;">
                                        <input name="CityII" type="text" class="k-input k-textbox"
                                               value="#= (data.City2 != null) ? data.City2 : '' #"
                                               style="width: 95%; height: 18px;font-size:10px;"/>
                                        <label class="small_label_contract" for="simple-input">miejscowość</label>
                                    </div>
                                    <div style="width: 33%; float: left;">
                                        <input name="PESELII" type="text" class="k-input k-textbox"
                                               value="#= (data.PESEL2 != null) ? data.PESEL2 : '' #"
                                               style="width: 95%; height: 18px;font-size:10px;"/>
                                        <label class="small_label_contract" for="simple-input">PESEL</label>
                                    </div>
                                    <div style="width: 33%; float: left;">
                                        <input name="IdentityCardII" type="text" class="k-input k-textbox"
                                               value="#= (data.IdNr2 != null) ? data.IdNr2 : '' #"
                                               style="width: 100%; height: 18px;font-size:10px;"/>
                                        <label class="small_label_contract" for="simple-input">seria i numer dowodu osobistego</label>
                                    </div>
                                </li>
                                <li>
                                    <div style="width: 30%; float: left;">
                                        <input name="PhoneII" type="text" class="k-input k-textbox"
                                               value="#= (data.Phone2 != null) ? data.Phone2 : '' #"
                                               style="width: 95%;height: 18px;font-size:10px;"/>
                                        <label class="small_label_contract" for="simple-input">telefon *</label>
                                    </div>
                                    <div style="width: 70%; float: left;">
                                        <input name="EmailII" type="text" class="k-input k-textbox"
                                               value="#= (data.Email2 != null) ? data.Email2 : '' #"
                                               style="width: 100%; height: 18px;font-size:10px;"/>
                                        <label class="small_label_contract" for="simple-input">e-mail **</label>
                                    </div>
                                </li>
                                <label for="simple-input" class="label_contract" style="width: 100%; float: left; font-weight: bold;">Adres korespondencyjny:</label>
                                <li>
                                    <div style="width: 60%; float: left;">
                                        <input name="Street" type="text" class="k-input k-textbox"
                                               value="#= (data.ForrwardingStreet != null) ? data.ForrwardingStreet : '' #"
                                               style="width: 95%; height: 18px;font-size:10px;"/>
                                        <label class="small_label_contract" for="simple-input">ulica</label>
                                    </div>
                                    <div style="width: 20%; float: left;">
                                        <input name="HomeNumber" type="text" class="k-input k-textbox"
                                               value="#= (data.ForrwardingHome != null) ? data.ForrwardingHome : '' #"
                                               style="width: 95%; height: 18px;font-size:10px;"/>
                                        <label class="small_label_contract" for="simple-input">nr domu/mieszkania</label>
                                    </div>
                                    <div style="width: 20%; float: left;">
                                        <input name="PostCode" type="text" class="k-input k-textbox"
                                               value="#= (data.ForrwardingPostalCode != null) ? data.ForrwardingPostalCode : '' #"
                                               style="width: 100%; height: 18px;font-size:10px;"/>
                                        <label class="small_label_contract" for="simple-input">kod pocztowy</label>
                                    </div>
                                </li>
                                <li>
                                    <div style="width: 33%; float: left;">
                                        <input name="City" type="text" class="k-input k-textbox"
                                               value="#= (data.ForrwardingCity != null) ? data.ForrwardingCity : '' #"
                                               style="width: 95%; height: 18px;font-size:10px;"/>
                                        <label class="small_label_contract" for="simple-input">miejscowość</label>
                                    </div>
                                </li>
                                <label for="simple-input" class="label_contract" style="width: 100%; float: left;">zwanego/zwanych dalej <span>KLIENTEM</span></label>
                                <label for="simple-input" class="label_contract" style="width: 100%; float: left; font-weight: bold;text-align:center;">a</label>
                                <label for="simple-input" class="label_contract" style="width: 100%; float: left; font-weight: bold;">ZLECENIOBIORCĄ:
                                </label>
                            </ul>
                            <p style="width: 100%; float: left; font-size:10px;padding:0 10px 0 10px;">
                                VOTUM S.A. z siedzibą we Wrocławiu 53-012, ul. Wyścigowa 56i, tel. 71/ 33 93 400, faks. 71/ 33 93 403, e-mail: dok@votum-sa.pl, zarejestrowana
                                w Sądzie Rejonowym dla Wrocławia Fabrycznej VI Wydział Gospodarczy Krajowego Rejestru Sądowego pod numerem KRS: 0000243252,
                                REGON: 020136043, NIP: 899-25-49-057, KAPITAŁ ZAKŁADOWY: 1 200 000 zł. wpłacony w całości.
                            </p>
                        </div>
                    </div>
                    <div class="red_margin"></div>
                </div>
                <div class="contract_text">
                    <p>* numer telefonu dedykowany do otrzymywania powiadomień z informacjami o etapach sprawy drogą wiadomości sms,</p>
                    <p>** adres e-mail dedykowany do otrzymywania wiadomości z informacjami o etapach sprawy</p>
                </div>
                <div class="capture">
                    <div class="red_margin_capture"></div>
                    <div class="number_capture"> I </div>
                    <div class="capture_title">PRZEDMIOT UMOWY</div>
                </div>
                <div class="contract_text justyfy">
                    <p>Zleceniobiorca (zwany dalej VOTUM) zobowiązuje się na zlecenie Zleceniodawcy do powzięcia czynności polegających na dochodzeniu
                        roszczeń od <span>#= (data.BankName != null) ? data.BankName : '____________________________________________' #</span> (zwanego dalej: Zobowiązanym) dotyczących umowy kredytu hipotecznego
                        lub konsolidacyjnego numer <span>#= (data.BankContractNumber != null) ? data.BankContractNumber : '____________________________________________' #</span> waloryzowanego bądź denominowanego do waluty obcej w związku z zastosowaną przez bank konstrukcją indeksacji oraz ubezpieczeń z nią powiązanych.</p>
                </div>
                <div class="footer"><p style="width: 60%;float:right;">1/4</p></div>
                <div class="print_text"><?php echo $contract_layout_number; ?></div>
            </div>
            <div class="pdf_strona size-a4 pdf-page new-page">
                <div class="header">
                    <div class="logo_left">
                        <img src="<?php echo 'https://' . $_SERVER ['HTTP_HOST']; ?>/img/laur_small.png" />
                    </div>
                    <div class="logo_right">
                        <img src="<?php echo 'https://' . $_SERVER ['HTTP_HOST']; ?>/img/logo_small.png" />
                    </div>
                </div>
                <div class="clear"></div>
                <div class="clear"></div>
                <div class="capture">
                    <div class="red_margin_capture"></div>
                    <div class="number_capture"> II </div>
                    <div class="capture_title">GWARANCJE VOTUM</div>
                </div>
                <div class="contract_text justyfy">
                    <p>Votum gwarantuje, że:</p>
                    <ul style="list-style-type: none;font-size:9px !important;padding-left:5px !important;margin-bottom: 0px!important">
                        <li>a. dokona szczegółowej analizy otrzymanej od Klienta dokumentacji bankowej,</li>
                        <li>b. przygotuje i przekaże Klientowi wniosek o wydanie dokumentacji niezbędnej do wykonania umowy</li>
                        <li>c. w przypadku odmowy wydania dokumentacji przez Zobowiązanego przygotuje i przekaże Klientowi reklamację,</li>
                        <li>d. w przypadku odmowy wydania przez Zobowiązanego dokumentacji po złożonej uprzednio reklamacji przygotuje oraz złoży skargę do
                            Rzecznika Finansowego,</li>
                        <li>e. dokona oszacowania należnego Klientowi roszczenia z tytułu nadpłaconych rat, poprzez analizę wysokości każdej pojedynczej
                            zapłaconej przez Klienta na rzecz Zobowiązanego raty kapitałowo-odsetkowej i porównanie jej z ratą kapitałowo-odsetkową
                            niezawierającą klauzuli waloryzacyjnej do waluty obcej, z uwzględnieniem ilości uruchomionych transz, procentowej wartości danej
                            transzy w stosunku do kursu waluty obcej, po jakim została uruchomiona oraz wpływu kursu uruchomienia każdej z pojedynczych
                            transz na średni kurs udzielenia całego kredytu, mając na względzie wiedzę dostępną na dzień oszacowania,</li>
                        <li>f. dokona analizy zasadności wystąpienia wobec Zobowiązanego z roszczeniem o zwrot kwoty uiszczonej tytułem ubezpieczenia niskiego
                            wkładu własnego,</li>
                        <li>g. dokona analizy zasadności wystąpienia wobec Zobowiązanego z roszczeniem o zwrot proporcjonalnej, nienależnej części składki
                            uiszczonej na ubezpieczenie pomostowe,</li>
                        <li>h. w uzasadnionych przypadkach przedstawi Klientowi alternatywne roszczenie o unieważnienie umowy kredytowej,</li>
                        <li>i. w uzasadnionych przypadkach złoży wniosek o wszczęcie postępowania w sprawie rozwiązywania sporów między Klientem a podmiotem
                            rynku finansowego bądź skargę do Rzecznika Finansowego,</li>
                        <li>j. w uzasadnionych przypadkach złoży umowę o przeprowadzenie mediacji w centrum mediacji Sądu Polubownego przy Komisji Nadzoru
                            Finansowego,</li>
                        <li>k. wyłoży w imieniu Klienta opłatę w kwocie 50 zł (słownie: pięćdziesiąt złotych) za złożenie wniosku o wszczęcie postępowania w sprawie
                            rozwiązywania sporów między Klientem a podmiotem rynku finansowego do Rzecznika Finansowego,</li>
                        <li>l. wyłoży w imieniu Klienta opłatę w kwocie 50 zł (słownie: pięćdziesiąt złotych) za złożenie umowy o przeprowadzenie mediacji w centrum
                            mediacji Sądu Polubownego przy Komisji Nadzoru Finansowego</li>
                        <li>m. w uzasadnionych przypadkach przygotuje dokumentację do przeprowadzenia postępowania o zawezwanie do próby ugodowej przeciwko
                            Zobowiązanemu w terminie do 14 dni licząc od dnia uzupełnienia przez Klienta dokumentacji niezbędnej do prawidłowego złożenia
                            takiego wniosku</li>
                        <li>n. przekaże Klientowi na wskazany przez niego rachunek uzyskane na jego rzecz środki w terminie 7 dni roboczych od ich wpływu na
                            rachunek VOTUM, po uprzednim potrąceniu wynagrodzenia i poniesionych kosztów,</li>
                        <li>o. nie zawrze ugody ze Zobowiązanym bez uprzedniej pisemnej zgody Klienta,</li>
                        <li>p. powództwo o zapłatę zostanie wytoczone tylko w przypadku zgody obu stron umowy, w tym pisemnej zgody Klienta,</li>
                        <li>q. po prawomocnym zakończeniu postępowania sądowego przedstawi Klientowi rekomendację w zakresie zasadności skierowania
                            wobec Zobowiązanego dodatkowego roszczenia o obniżenie salda zadłużenia z tytułu umowy kredytowej,</li>
                        <li>r. będzie systematycznie informować Klienta o przebiegu wykonania umowy,</li>
                        <li>s. udzieli odpowiedzi na złożoną reklamację w terminie 21 dni od dnia jej otrzymania.</li>
                    </ul>
                </div>
                <div class="clear"></div>
                <div class="capture">
                    <div class="red_margin_capture"></div>
                    <div class="number_capture"> III </div>
                    <div class="capture_title">OBSŁUGA EKSPERCKA</div>
                </div>
                <div class="contract_text justyfy">
                    <p>Votum w ramach uzyskanego od Klienta wynagrodzenia i w zakresie niezbędnym do wykonania umowy, pokrywa koszty wskazanego przez
                        siebie:</p>
                    <ul style="list-style-type: none;font-size:9px !important;padding-left:5px !important;margin-bottom: 0px!important">
                        <li>a. specjalisty obsługi spraw finansowych na każdym etapie wykonania umowy,</li>
                        <li>b. specjalisty w zakresie szacowania roszczeń w postępowaniu przedsądowym,</li>
                        <li>c. pełnomocnika Klienta w postępowaniu mediacyjnym,</li>
                        <li>d. adwokata lub radcy prawnego reprezentującego Klienta w postępowaniu przedsądowym, pojednawczym, sądowym oraz egzekucyjnym.</li>
                    </ul>
                </div>
                <div class="clear"></div>
                <div class="capture">
                    <div class="red_margin_capture"></div>
                    <div class="number_capture"> IV </div>
                    <div class="capture_title">WYNAGRODZENIE VOTUM</div>
                </div>
                <div class="contract_text justyfy" style="padding-bottom:0px !important;">
                    <ul style="font-size:9px !important;padding-left:5px !important;margin-bottom: 8px!important;list-style-type: none;">
                        <li>1. VOTUM zobowiązuje się do przekazania Klientowi uzyskanych świadczeń w terminie 7 dni roboczych od dnia ich otrzymania,
                            po uprzednim potrąceniu należnego VOTUM wynagrodzenia i poniesionych wydatków na wskazany przez Zleceniodawcę rachunek
                            bankowy:</li>
                    </ul>
                </div>
                <div class="clear"></div>
                <div class="form_section_customer">
                    <div class="red_margin"></div>
                    <div class="form_section_body">
                        <div class="body_form">
                            <ul class="fieldlist">
                                <li>
                                    <div style="width: 100%; float: left;">
                                        <input name="AccountNumber" type="text" class="k-input k-textbox"
                                               value="#= (data.CustomerAccountNumber != null) ? data.CustomerAccountNumber: '' #"
                                               style="width: 100%; height: 18px;font-size:10px;"/>
                                        <label class="small_label_contract" for="simple-input">nr rachunku bankowego</label>
                                    </div>
                                </li>
                                <li>
                                    <div style="width: 50%; float: left;">
                                        <input name="CustomerFirstName" type="text" class="k-input k-textbox"
                                               value="#= (data.CustomerFirstname != null) ? data.CustomerFirstname: '' #"
                                               style="width: 95%;height: 18px;font-size:10px;"/>
                                        <label class="small_label_contract" for="simple-input">imię</label>
                                    </div>
                                    <div style="width: 50%; float: left;">
                                        <input name="CustomerLastName" type="text" class="k-input k-textbox"
                                               value="#= (data.CustomerLastname != null) ? data.CustomerLastname: '' #"
                                               style="width: 100%; height: 18px;font-size:10px;"/>
                                        <label class="small_label_contract" for="simple-input">nazwisko</label>
                                    </div>
                                </li>
                                <li>
                                    <div style="width: 60%; float: left;">
                                        <input name="CustomerStreet" type="text" class="k-input k-textbox"
                                               value="#= (data.CustomerStreet != null) ? data.CustomerStreet: '' #"
                                               style="width: 95%; height: 18px;font-size:10px;"/>
                                        <label class="small_label_contract" for="simple-input">ulica</label>
                                    </div>
                                    <div style="width: 20%; float: left;">
                                        <input name="CustomerHomeNumber" type="text" class="k-input k-textbox"
                                               value="#= (data.CustomerStreetNumber != null) ? data.CustomerStreetNumber: '' #"
                                               style="width: 95%; height: 18px;font-size:10px;"/>
                                        <label class="small_label_contract" for="simple-input">nr domu/mieszkania</label>
                                    </div>
                                    <div style="width: 20%; float: left;">
                                        <input name="CustomerPostCode" type="text" class="k-input k-textbox"
                                               value="#= (data.CustomerPostalCode != null) ? data.CustomerPostalCode: '' #"
                                               style="width: 100%; height: 18px;font-size:10px;"/>
                                        <label class="small_label_contract" for="simple-input">kod pocztowy</label>
                                    </div>
                                </li>
                                <li>
                                    <div style="width: 33%; float: left;">
                                        <input name="CustomerCity" type="text" class="k-input k-textbox"
                                               value="#= (data.CustomerCity != null) ? data.CustomerCity: '' #"
                                               style="width: 95%; height: 18px;font-size:10px;"/>
                                        <label class="small_label_contract" for="simple-input">miejscowość</label>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="red_margin"></div>
                </div>
                <div class="footer"><p style="width: 100%">2/4</p></div>
                <div class="print_text"><?php echo $contract_layout_number; ?></div>
            </div>

            <div class="pdf_strona size-a4 pdf-page new-page">
                <div class="header">
                    <div class="logo_left">
                        <img src="<?php echo 'https://' . $_SERVER ['HTTP_HOST']; ?>/img/laur_small.png" />
                    </div>
                    <div class="logo_right">
                        <img src="<?php echo 'https://' . $_SERVER ['HTTP_HOST']; ?>/img/logo_small.png" />
                    </div>
                </div>
                <div class="clear"></div>
                <div class="contract_text justyfy">
                    <ul style="font-size:9px !important;padding-left:15px !important;margin-bottom: 8px!important;list-style-type: none;">
                        <li>2. Klient upoważnia VOTUM do odbioru wszelkich uzyskanych w jego imieniu świadczeń w ramach wykonania niniejszej umowy.</li>
                        <li>3. VOTUM przysługuje wynagrodzenie w kwocie <span>
                            #if(data.ContractType == '3'){#
                            3.075
                            #}else if (data.ContractType == '2') {#
                            6.150
                            #}else if (data.ContractType == '1') {#
                            12.300
                            #}#
                            </span>
                            zł. (słownie:
                            #if(data.ContractType == '3'){#
                            <?php echo slownie(intval(3075)); ?>
                            #}else if (data.ContractType == '2') {#
                            <?php echo slownie(intval(6150)); ?>
                            #}else if (data.ContractType == '1') {#
                            <?php echo slownie(intval(12300)); ?>
                            #}#
                            ) brutto (w tym podatek od
                            towarów i usług VAT w wysokości 23%) za analizę merytoryczną dokumentacji, roszczeń Klienta, przeprowadzenie postępowania
                            przedsądowego, przygotowanie dokumentacji do postępowania pojednawczego, sądowego oraz egzekucyjnego.</li>
                        <li>4. Klient uiszcza z góry wynagrodzenie, o którym mowa w ust. 3 powyżej, na rachunek bankowy VOTUM o numerze:
                            40 1050 1575 1000 0023 1250 6476, w terminie 7 dni od dnia przekazania Klientowi informacji VOTUM o zarejestrowaniu sprawy
                            i nadaniu jej numeru, który należy podać w tytule przelewu. VOTUM może wstrzymać się z wykonaniem umowy do dnia uiszczenia
                            wynagrodzenia, o którym mowa w ust. 3 powyżej.</li>
                        <li>5. Niezależnie od wynagrodzenia, o którym mowa w ustępie 3, z tytułu wykonania niniejszej umowy VOTUM przysługuje wynagrodzenie
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
                            W takim przypadku Klient zobowiązany jest do uiszczenia wynagrodzenia w terminie 7 dni od dnia otrzymania od VOTUM faktury VAT.</li>
                        <li>6. Votum przysługuje zwrot wyłożonej tymczasowo opłaty w kwocie 50 zł (słownie: pięćdziesiąt złotych) za złożenie wniosku o wszczęcie
                            postępowania w sprawie rozwiązywania sporów między klientem a podmiotem rynku finansowego do Rzecznika Finansowego</li>
                        <li>7. Votum przysługuje zwrot wyłożonej tymczasowo w imieniu Klienta opłaty w kwocie 50 zł (słownie: pięćdziesiąt złotych) za złożenie
                            umowy o przeprowadzenie mediacji w centrum mediacji Sądu Polubownego przy Komisji Nadzoru Finansowego</li>
                        <li>8. W przypadku poniesienia przez VOTUM kosztów procesu podlegają one zwrotowi na rzecz VOTUM wyłącznie z kwoty ogółu świadczeń
                            przyznanych Klientowi rozstrzygnięciem sądu lub ugodą, a koszty zastępstwa procesowego zasądzone w sprawie przypadają
                            reprezentującemu Klienta pełnomocnikowi procesowemu wskazanemu przez VOTUM.</li>
                        <li>9. W przypadku spełnienia świadczenia przez Zobowiązanego bezpośrednio do rąk Klienta po dacie zawarcia niniejszej umowy,
                            Klient zobowiązuje się niezwłocznie powiadomić o tym VOTUM i wpłacić w terminie 7 dni roboczych od dnia jego otrzymania należne
                            VOTUM wynagrodzenie wraz z poniesionymi przez VOTUM kosztami w związku z realizacją umowy, na rachunek bankowy
                            prowadzony w ING Bank Śląski S.A. Oddział we Wrocławiu, nr 40 1050 1575 1000 0023 1250 6476 bądź w inny sposób wskazany przez
                            VOTUM.</li>
                        <li>10. Za zobowiązania wynikające z niniejszej umowy Klienci ponoszą odpowiedzialność solidarną.</li>
                    </ul>
                </div>
                <div class="clear"></div>
                <div class="capture">
                    <div class="red_margin_capture"></div>
                    <div class="number_capture"> V </div>
                    <div class="capture_title">CZAS TRWANIA UMOWY</div>
                </div>
                <div class="contract_text justyfy">
                    <ul style="font-size:9px !important;padding-left:5px !important;margin-bottom: 8px!important;list-style-type: none;">
                        <li>1. Umowa zostaje zawarta na czas do całkowitego wyegzekwowania dla Klienta świadczeń należnych od Zobowiązanego w postępowaniu
                            przedsądowym, sądowym i egzekucyjnym.</li>
                        <li>2. Klient może wypowiedzieć umowę w każdym czasie. Jeżeli wypowiedzenie nastąpiło bez ważnego powodu, a na skutek wykonania
                            umowy Klient uzyskał od Zobowiązanego świadczenie lub doszło do zmniejszenia salda zadłużenia, VOTUM może domagać się
                            naprawienia szkody wyłącznie do kwoty wysokości wynagrodzenia, jakie zostałoby naliczone, gdyby Klient nie wypowiedział umowy.</li>
                        <li>3. W przypadku wypowiedzenia umowy bez ważnego powodu przez VOTUM, jest ona odpowiedzialna za szkodę.</li>
                    </ul>
                </div>
                <div class="clear"></div>
                <div class="capture">
                    <div class="red_margin_capture"></div>
                    <div class="number_capture"> VI </div>
                    <div class="capture_title">OŚWIADCZENIA STRON</div>
                </div>
                <div class="contract_text justyfy">
                    <p>Votum oświadcza, że:</p>
                    <ul style="list-style-type: none;font-size:9px !important;padding-left:5px !important;margin-bottom: 0px!important">
                        <li>a. informacje o sposobie wykonania umowy mogą być przekazywane na wskazany w umowie nr telefonu, adres e-mail, pocztą lub na
                            konto Klienta dostępne za pośrednictwem strony internetowej VOTUM: www.votum-sa.pl,</li>
                        <li>b. Klient może złożyć reklamacje na świadczone przez VOTUM usługi listem poleconym na adres spółki.</li>
                    </ul>

                    <div style="width:100%; float:left;">
                        <p>Klient oświadcza, że żąda rozpoczęcia wykonywania usługi przez VOTUM przed upływem terminu do odstąpienia od umowy:</p>
                    </div>
                    <div style="width:100%; float:left;">
                        <p><i class="checkbox">#=(data.RadioButton1 == '1') ? 'X' : '&nbsp&nbsp&nbsp'#</i> TAK <i class="checkbox">#=(data.RadioButton1 != '1') ? 'X' : '&nbsp&nbsp&nbsp'#</i> NIE</p>
                    </div>

                    <p>Klient oświadcza, że</p>
                    <p><i class="checkbox">#=(data.RadioButton2 == '1') ? 'X' : '&nbsp&nbsp&nbsp'#</i> upoważnia / <i class="checkbox">#=(data.RadioButton2 != '1') ? 'X' : '&nbsp&nbsp&nbsp'#</i> nie upoważnia Zleceniobiorcy do uzyskiwania informacji i
                        dokumentów w sprawach prowadzonych przez Kancelarię Adwokatów i Radców Prawnych A. Łebek i Wspólnicy sp.k. z siedzibą we Wrocławiu, w związku
                        z realizacją niniejszej umowy</p>

                    <!--<div style="width:100%; float:left;">
                        <p class="checkbox">#=(data.RadioButton2 == '1') ? 'X' : ''#</p><p class="left">upoważnia /</p>
                        <p class="checkbox">#=(data.RadioButton1 != '1') ? 'X' : ''#</p><p class="left">nie upoważnia Zleceniobiorcy do uzyskiwania informacji i
                            dokumentów w sprawach prowadzonych przez Kancelarię Adwokatów i Radców Prawnych A. Łebek i Wspólnicy sp.k. z siedzibą we Wrocławiu, w związku
                            z realizacją niniejszej umowy</p>
                    </div>-->


                    <p>Klient oświadcza, że:</p>
                    <ul style="list-style-type: none;font-size:9px !important;padding-left:5px !important;margin-bottom: 0px!important">
                        <li>a. został poinformowany o sposobie i terminie prawa odstąpienia od niniejszej umowy oraz wzorze oświadczenia o odstąpieniu
                            i o pozasądowych sposobach rozpatrywania reklamacji – na odrębnym formularzu,</li>
                        <li>b. zobowiązuje się do zachowania poufności w związku z prowadzoną sprawą, co do każdego jej etapu i nieudostępniania informacji
                            oraz dokumentacji osobom trzecim,</li>
                        <li>c.
                            #if(data.RadioButton3 == 0 || data.RadioButton3 == null){#
                            <i class="checkbox">X</i>
                            nie zlecał wcześniej dochodzenia roszczeń żadnemu podmiotowi,
                            <i class="checkbox">&nbsp&nbsp&nbsp</i>
                            zlecał sprawę wcześniej innemu pełnomocnikowi (nazwa):
                            ___________________________________  z którym zawarł umowę dnia _____________________
                            #}else{#
                            <i class="checkbox">&nbsp&nbsp&nbsp</i>
                            nie zlecał wcześniej dochodzenia roszczeń żadnemu podmiotowi,
                            <i class="checkbox">X</i>
                            zlecał sprawę wcześniej innemu pełnomocnikowi (nazwa):
                            #= (data.other_agent_name != null) ? data.other_agent_name: '____________________________________' #  z którym zawarł umowę dnia #= (data.other_agent_date != null || data.other_agent_date != 0) ? data.other_agent_date: '_____________________' #
                            #}#
                        </li>
                        <li>d.
                            #if(data.CheckBox1 == true || data.CheckBox2 == true || data.CheckBox3 == true){#
                            <i class="checkbox">&nbsp&nbsp&nbsp</i>
                            nie zgłaszał roszczeń do Zobowiązanego,
                            <i class="checkbox">X</i>
                            zgłaszał do Zobowiązanego roszczenia tytułem:
                            #}else{#
                            <i class="checkbox">X</i>
                            nie zgłaszał roszczeń do Zobowiązanego,
                            <i class="checkbox">&nbsp&nbsp&nbsp</i>
                            zgłaszał do Zobowiązanego roszczenia tytułem:
                            #}#
                        </li>
                    </ul>
                    <p>
                        #if(data.CheckBox1 == '1'){#
                        <i class="checkbox">X</i>
                        #}else{#
                        <i class="checkbox">&nbsp&nbsp&nbsp</i>
                        #}#
                        nadpłaconych rat w związku z klauzulą waloryzacyjną, data zgłoszenia:
                        #= (data.CheckBox1Date != '') ? data.CheckBox1Date: '__________________' #
                    </p>
                    <p>
                        #if(data.CheckBox2 == '1'){#
                        <i class="checkbox">X</i>
                        #}else{#
                        <i class="checkbox">&nbsp&nbsp&nbsp</i>
                        #}#
                        zapłaconych składek za ubezpieczenie niskiego wkładu własnego, data zgłoszenia:
                        #= (data.CheckBox2Date != '') ? data.CheckBox2Date: '__________________' #
                    </p>
                    <p>
                        #if(data.CheckBox3 == '1'){#
                        <i class="checkbox">X</i>
                        #}else{#
                        <i class="checkbox">&nbsp&nbsp&nbsp</i>
                        #}#
                        nadpłaconej składki za ubezpieczenie pomostowe, data zgłoszenia:
                        #= (data.CheckBox2Date != '') ? data.CheckBox2Date: '__________________' #

                    </p>

                </div>
                <div class="footer"><p style="width: 100%">3/4</p></div>
                <div class="print_text"><?php echo $contract_layout_number; ?></div>
            </div>

            <div class="pdf_strona size-a4 pdf-page new-page">
                <div class="header">
                    <div class="logo_left">
                        <img src="<?php echo 'https://' . $_SERVER ['HTTP_HOST']; ?>/img/laur_small.png" />
                    </div>
                    <div class="logo_right">
                        <img src="<?php echo 'https://' . $_SERVER ['HTTP_HOST']; ?>/img/logo_small.png" />
                    </div>
                </div>
                <div class="clear"></div>
                <div class="capture">
                    <div class="red_margin_capture"></div>
                    <div class="number_capture"> VII </div>
                    <div class="capture_title">WARUNKI PROWADZENIA POSTĘPOWANIA SĄDOWEGO</div>
                </div>
                <div class="contract_text justyfy">
                    <ul style="font-size:9px !important;padding-left:5px !important;margin-bottom: 0px!important;list-style-type: none;">
                        <li>1. Klient jest zobowiązany do zapłaty kosztów prowadzenia postępowania sądowego, w tym:</li>
                        <ul style="list-style-type:none;margin-bottom:0px !important;padding-left:5px !important;">
                            <li>a. opłaty sądowej od pozwu w wysokości 5% wartości przedmiotu sporu, lecz nie więcej niż 1.000 zł, zgodnie z obowiązującymi
                                przepisami (art. 13 ust. 1a Ustawy o kosztach sądowych w sprawach cywilnych, Dz. U. z 2018 r., poz. 300 ze zm.),</li>
                            <li>b. opłaty sądowej za złożenie wniosku o zawezwanie do próby ugodowej w kwocie 40 lub 300 zł, zgodnie z obowiązującymi przepisami
                                (art. 23 pkt 3 lub art. 24 ust. 1 pkt 5) Ustawy o kosztach sądowych w sprawach cywilnych, Dz. U. z 2018 r., poz. 300 ze zm.)</li>
                            <li>c. kosztów przejazdów pełnomocnika procesowego na rozprawy, w wysokości określonej przez przepisy Rozporządzenia Ministra
                                Infrastruktury w sprawie warunków ustalania oraz sposobu dokonywania zwrotu kosztów używania do celów służbowych
                                samochodów osobowych, motocykli i motorowerów niebędących własnością pracodawcy (Dz. U. z 2002 r. nr 27, poz. 271 ze
                                zm.) albo kosztów zastępstwa substytucyjnego w wysokości nie przekraczającej 300 zł brutto (słownie: trzysta złotych) za każde
                                posiedzenie, płatne na 14 dni przed terminem rozprawy,</li>
                            <li>d. opłat skarbowych w kwocie 17 zł (słownie: siedemnaście złotych) od każdego pełnomocnictwa, innych opłat skarbowych oraz
                                opłat sądowych</li>
                        </ul>
                        <li>2. VOTUM nie ponosi odpowiedzialności za skutki wynikłe z nieuregulowania przez Klienta, bądź uregulowania z opóźnieniem, opłat
                            wymienionych powyżej.</li>
                    </ul>
                </div>
                <div class="clear"></div>
                <div class="capture">
                    <div class="red_margin_capture"></div>
                    <div class="number_capture"> VIII </div>
                    <div class="capture_title">PRAWA I OBOWIĄZKI STRON</div>
                </div>
                <div class="contract_text justyfy">
                    <ul style="font-size:9px !important;padding-left:5px !important;margin-bottom: 0px!important;list-style-type: none;">
                        <li>1. Czynności wchodzące w zakres niniejszej umowy VOTUM może wykonywać za pomocą podmiotów współpracujących, w szczególności
                            adwokatów lub radców prawnych, przy czym za działanie tych osób VOTUM odpowiada wobec Klienta jak za działania własne.</li>
                        <li>2. Klient zobowiązuje się do niezwłocznego przekazania VOTUM wszelkich posiadanych informacji dotyczących przedmiotu umowy
                            ze Zobowiązanym oraz wszelkiej dokumentacji i niezbędnych oświadczeń, które będą konieczne do wykonania niniejszej umowy,
                            w szczególności:</li>
                        <ul style="list-style-type:none;margin-bottom:0px !important;padding-left:5px !important;">
                            <li>a. kopii umowy kredytu bankowego wraz z aneksami (jeżeli takowe były zawierane),</li>
                            <li>b. kopii regulaminu kredytów i pożyczek hipotecznych załączonego do umowy kredytu bankowego,</li>
                            <li>c. kopii Tabeli Opłat i Prowizji załączonej do umowy kredytu bankowego.</li>
                        </ul>
                        <li>3. Klient zobowiązuje się do niezwłocznego poinformowania VOTUM o każdorazowej zmianie danych do kontaktu, w szczególności
                            numeru telefonu, adresu e-mail oraz adresu do korespondencji.</li>
                    </ul>
                </div>
                <div class="clear"></div>
                <div class="capture">
                    <div class="red_margin_capture"></div>
                    <div class="number_capture"> IX </div>
                    <div class="capture_title">POSTANOWIENIA KOŃCOWE</div>
                </div>
                <div class="contract_text justyfy">
                    <ul style="font-size:9px !important;padding-left:5px !important;margin-bottom: 0px!important;list-style-type: none;">
                        <li>a. Wszelkie zmiany umowy wymagają formy pisemnej pod rygorem nieważności.</li>
                        <li>b. W kwestiach nieuregulowanych mają zastosowanie przepisy Kodeksu cywilnego</li>
                        <li>c. Umowę sporządzono i podpisano w dwóch jednobrzmiących egzemplarzach, po jednej dla każdej ze stron.</li>
                        <li>d. Integralną częścią niniejszej umowy jest załącznik – Klauzule informacyjne dla Klienta.</li>
                    </ul>
                </div>
                <div class="clear"></div>

                <div class="contract_text" style="margin-top: 20px;">
                    <div style="width: 50%; float: left;">
                        <p style="text-align: left;">_________________________________________</p>
                        <label for="simple-input" style="font-size: 10px; float:left;">VOTUM S.A.</label>
                    </div>
                    <div style="width: 50%; float: right;">
                        <p style="text-align: right;">_________________________________________</p>
                        <label for="simple-input" style="font-size: 10px; float:right;">Zleceniodawca</label>
                    </div>
                </div>

                <div class="footer"><p style="width: 100%">4/4</p></div>
                <div class="print_text"><?php echo $contract_layout_number; ?></div>
            </div>



            <div class="pdf_strona size-a4 pdf-page new-page">
                <div class="header">
                    <div class="logo_left">
                        <img src="<?php echo 'https://' . $_SERVER ['HTTP_HOST']; ?>/img/laur_small.png" />
                    </div>
                    <div class="logo_right">
                        <img src="<?php echo 'https://' . $_SERVER ['HTTP_HOST']; ?>/img/logo_small.png" />
                    </div>
                </div>
                <div class="clear"></div>
                <p style="font-size: 16px; text-align: center; width: 100%">Załącznik - Klauzule informacyjne dla klienta</p>
                <div class="capture">
                    <div class="red_margin_capture"></div>
                    <div class="number_capture"> § I </div>
                    <div class="capture_title">INFORMACJE</div>
                </div>
                <div class="contract_text">
                    <div class="font_size_10 justyfy" style="width: 50%;float:left;padding-right:0px;">
                        <ul style="list-style-type: none;">
                            <li>I. VOTUM S.A. z siedzibą we Wrocławiu informuje, że w związku z obowiązkami wynikającymi z ogólnego rozporządzenia
                                o ochronie danych osobowych z dnia 27 kwietnia 2016 r. (RODO), dane osobowe podane przez
                                Klienta w umowie i załącznikach do umowy, jak również dane uzyskane w trakcie jej wykonywania będą przetwarzane
                                przez VOTUM S.A. z siedzibą we Wrocławiu, ul. Wyścigowa 56i, 53-012 Wrocław, wpisana do rejestru
                                przedsiębiorców KRS pod numerem 0000243252 (dalej „Spółka”), która stanie się Administratorem tych danych.</li>
                            <li>II. Uzyskanie informacji o procesach przetwarzania danych osobowych możliwe jest poprzez kontakt z Inspektorem
                                Ochrony Danych w formie elektronicznej: e-mail iod@ votum-sa.pl lub pisemnej: Inspektor Ochrony Danych,
                                ul. Wyścigowa 56i, 53-012 Wrocław</li>
                            <li>III. Dane osobowe przetwarzane będą w następujących celach oraz na podstawie następujących przesłanek:</li>
                            <ul style="list-style-type: none;margin-bottom:0px !important;">
                                <li>1. Wykonie umowy na rzecz klienta, podstawą prawną jest art. 6 ust. 1 lit b RODO,</li>
                                <li>2. Marketing usług własnych, wykorzystywane do tego celu będą środki komunikacji w tym telefon
                                    oraz email, podstawą prawną jest art. 6 ust. 1 lit. f) RODO,</li>
                                <li>3. Zapewnienie prawidłowości podatkowych po wystawieniu faktury, podstawą prawna jest art. 6 ust. 1 lit. c)
                                    RODO uszczegółowienie w art. 70 §1 Ordynacji Podatkowej,</li>
                                <li>4. W przypadku wyrażenia dodatkowych zgód (art. 6 ust.1 lit a), dane osobowe będą przetwarzane w
                                    celu zaproponowania usług podmiotów powiązanych z VOTUM S.A wskazanym w §2 poniżej.</li>
                            </ul>
                            <li>IV. Dane osobowe udostępnione będą bankom udzielającym kredytów indeksowanych bądź denominowanych
                                do waluty obcej w związku z zastosowaną indeksacją oraz ubezpieczeń z nimi powiązanym, a w razie takiej
                                potrzeby - organom państwowym.</li>
                            <li>V. W zależności o celu przetwarzania dane osobowe Klienta będą przetwarzane przez następujący okres czasu:</li>

                        </ul>
                    </div>
                    <div class="font_size_10 justyfy" style="width: 50%;float:right;padding-left:0px;">
                        <ul style="list-style-type: none;">
                            <ul style="list-style-type: none;margin-bottom:0px !important;">
                                <li>1. W związku z możliwością podniesienia roszczeń z kodeksu cywilnego, przez okres do 10 lat od momentu zakończenia umowy</li>
                                <li>2. W związku z możliwością pojawienia się nowych ofert, przez okres do 10 lat od momentu zakończenia umowy lub do momentu
                                    wniesienia sprzeciwu na marketing usług VOTUM S.A,</li>
                                <li>3. W związku z wymogami ustawy, przez okres 5 lat + bieżący rok podatkowy od momentu wystawienia faktury</li>
                                <li>4. W związku z możliwością pojawienia się nowych ofert, przez okres do 10 lat od momentu zakończenia umowy lub do momentu
                                    wniesienia sprzeciwu na marketing wskazanego podmiotu.</li>
                            </ul>
                            <li>VI. Klient ma prawo dostępu do swoich danych, ich sprostowania, usunięcia lub ograniczenia przetwarzania a także do wniesienia
                                sprzeciwu wobec przetwarzania danych, w tym na marketing usług własnych VOTUM S.A. oraz do przenoszenia danych. Klient jest
                                uprawniony do cofnięcia wyrażonej zgody na przetwarzanie danych w każdym czasie, a także do wniesienia skargi w związku
                                z przetwarzaniem danych do organu nadzorczego – Prezesa Urzędu Ochrony Danych Osobowych.</li>
                            <li>VII. Podanie danych jest dobrowolne jednakże niezbędne dla celów wykonania umowy. W przypadku braku podania danych lub
                                niewyrażenia zgody na ich przetwarzanie, realizacja umowy może stać się niemożliwa.</li>
                            <li>VIII. Dane osobowe wskazane w umowie, będą podlegały profilowaniu, które ma na celu dopasowanie i zaproponowanie Klientowi
                                nowych usług. Każdorazowo przed podjęciem decyzji w tym przedmiocie dane osobowe będą weryfikowane przez pracownika VOTUM S.A.</li>
                        </ul>
                    </div>
                </div>
                <div class="contract_text">
                    <div style="width: 70%; float: right;">
                        <label for="simple-input" style="font-size: 12px; float:right;">Oświadczam, że zapoznałem się z treścią informacji zawartych w §1</label>
                    </div>
                    <div style="width: 50%; float: right; margin-top: 20px;">
                        <p style="text-align: right;">___________________________________________________________________</p>
                        <label for="simple-input" style="font-size: 12px; float:right;">podpis Klienta/osoby działającej w imieniu Klienta</label>
                    </div>
                </div>
                <div class="clear"></div>
                <div class="footer"><p style="width: 100%">1/2</p></div>
                <div class="print_text"><?php echo $aggreement_layout_number; ?></div>
            </div>

            <div class="pdf_strona size-a4 pdf-page new-page">
                <div class="header">
                    <div class="logo_left">
                        <img src="<?php echo 'https://' . $_SERVER ['HTTP_HOST']; ?>/img/laur_small.png" />
                    </div>
                    <div class="logo_right">
                        <img src="<?php echo 'https://' . $_SERVER ['HTTP_HOST']; ?>/img/logo_small.png" />
                    </div>
                </div>
                <div class="clear"></div>

                <div class="capture">
                    <div class="red_margin_capture"></div>
                    <div class="number_capture"> § II </div>
                    <div class="capture_title">ZGODY KLIENTA</div>
                </div>
                <div class="contract_text font_size_12 justyfy">
                    <p>I. Wyrażam zgodę na przekazanie moich danych kontaktowych (telefon, adres poczty elektronicznej, adres zamieszkania) następującym
                        podmiotom:</p>
                    <p>1. DSA Investment S.A. Al. Wiśniowa 47, 53-126 Wrocław, KRS: 0000391830, w zakresie danych teleadresowych w celu sporządzenia oferty
                        produktów finansowych i ubezpieczeń osobowych:</p>
                    <div style="width:100%; float:left;">
                        <i class="checkbox">#=(data.dataConsentDSA == '1') ? 'X' : '&nbsp&nbsp&nbsp'#</i> TAK
                        <i class="checkbox">#=(data.dataConsentDSA != '1') ? 'X' : '&nbsp&nbsp&nbsp'#</i> NIE
                    </div>
                    <p>2. Polskie Centrum Rehabilitacji Funkcjonalnej Votum S.A. Sp. k., Golikówka 6, 30-723 Kraków, KRS: 0000290430 , w zakresie danych
                        zawartych w umowie i przekazanej dokumentacji, w tym stanu zdrowia w celu sporządzenia oferty rehabilitacji: </p>
                    <div style="width:100%; float:left;">
                        <i class="checkbox">#=(data.dataConsentPCRF == '1') ? 'X' : '&nbsp&nbsp&nbsp'#</i> TAK
                        <i class="checkbox">#=(data.dataConsentPCRF != '1') ? 'X' : '&nbsp&nbsp&nbsp'#</i> NIE
                    </div>

                    <p>3. Fundacja VOTUM, ul. Wyścigowa 56i, 53-012 Wrocław, KRS: 0000272272, w zakresie danych zawartych w umowie i przekazanej dokumentacji,
                        w tym stanu zdrowia w celu przedstawienia możliwego zakresu pomocy: </p>
                    <div style="width:100%; float:left;">
                        <i class="checkbox">#=(data.dataConsentVOTUM == '1') ? 'X' : '&nbsp&nbsp&nbsp'#</i> TAK
                        <i class="checkbox">#=(data.dataConsentVOTUM != '1') ? 'X' : '&nbsp&nbsp&nbsp'#</i> NIE
                    </div>

                    <p>4. AUTOVOTUM S.A., ul. Wyścigowa 56i, 53-012 Wrocław, KRS: 0000273033, w zakresie danych teleadresowych w celu sporządzenia oferty
                        usług wynajmu pojazdów zastępczych;</p>
                    <div style="width:100%; float:left;">
                        <i class="checkbox">#=(data.dataConsentAUTOVOTUM == '1') ? 'X' : '&nbsp&nbsp&nbsp'#</i> TAK
                        <i class="checkbox">#=(data.dataConsentAUTOVOTUM != '1') ? 'X' : '&nbsp&nbsp&nbsp'#</i> NIE
                    </div>

                    <p>5. Biuro Ekspertyz Procesowych sp. z o.o., Aleja Wiśniowa 47, 53-126 Wrocław, KRS: 0000565095, w zakresie danych teleadresowych w celu
                        sporządzenia oferty cesji wierzytelności dotyczącej szkody w pojeździe. </p>

                    <div style="width:100%; float:left;">
                        <i class="checkbox">#=(data.dataConsentBEP == '1') ? 'X' : '&nbsp&nbsp&nbsp'#</i> TAK
                        <i class="checkbox">#=(data.dataConsentBEP != '1') ? 'X' : '&nbsp&nbsp&nbsp'#</i> NIE
                    </div>
                    </br></br></br>
                    <p>II. Wyrażam zgodę na wykonywanie następujących czynności przez:</p>
                    <p>DSA Investment S.A., Al. Wiśniowa 47,53-126 Wrocław, </p>
                    <p>a) Przesłanie informacji handlowych za pośrednictwem środków komunikacji elektronicznej, zgodnie z ustawą z dnia 08.07.2002 r. o świadczeniu
                        usług drogą elektroniczną (Dz.U. z 2016 r. poz.1030)</p>
                    <div style="width:100%; float:left;">
                        <i class="checkbox">#=(data.marketingConsentDSA1 == '1') ? 'X' : '&nbsp&nbsp&nbsp'#</i> TAK
                        <i class="checkbox">#=(data.marketingConsentDSA1 != '1') ? 'X' : '&nbsp&nbsp&nbsp'#</i> NIE
                    </div>

                    <p>b) Przekazywanie treści marketingowych na podany przez mnie nr telefonu w tym przy użyciu automatycznych systemów wywołujących
                        w rozumieniu ustawy z dnia 17.07.2004 r. Prawo telekomunikacyjne (Dz.U. z 2016 r. poz. 1489); </p>
                    <div style="width:100%; float:left;">
                        <i class="checkbox">#=(data.marketingConsentDSA2 == '1') ? 'X' : '&nbsp&nbsp&nbsp'#</i> TAK
                        <i class="checkbox">#=(data.marketingConsentDSA2 != '1') ? 'X' : '&nbsp&nbsp&nbsp'#</i> NIE
                    </div>

                    <p>2. VOTUM S.A., ul. Wyścigowa 56i, 53-012 Wrocław, </p>
                    <p>a) przesyłanie informacji handlowych za pośrednictwem środków komunikacji elektronicznej zgodnie z ustawą z dn. 08.07.2002 r. o świadczeniu
                        usług drogą elektroniczną (t. j. Dz.U. z 2017 r. poz. 1219):</p>
                    <div style="width:100%; float:left;">
                        <i class="checkbox">#=(data.marketingConsentVOTUM1 == '1') ? 'X' : '&nbsp&nbsp&nbsp'#</i> TAK
                        <i class="checkbox">#=(data.marketingConsentVOTUM1 != '1') ? 'X' : '&nbsp&nbsp&nbsp'#</i> NIE
                    </div>

                    <p>b) przekazywanie treści marketingowych na podany przeze mnie nr telefonu w tym przy użyciu automatycznych systemów wywołujących
                        w rozumieniu ustawy z dn.16.07.2004 r. Prawo telekomunikacyjne (t. j. Dz.U. z 2017 r. poz. 1907):</p>
                    <div style="width:100%; float:left;">
                        <i class="checkbox">#=(data.marketingConsentVOTUM2 == '1') ? 'X' : '&nbsp&nbsp&nbsp'#</i> TAK
                        <i class="checkbox">#=(data.marketingConsentVOTUM2 != '1') ? 'X' : '&nbsp&nbsp&nbsp'#</i> NIE
                    </div>


                </div>
                <div class="contract_text" style="margin-top: 20px;">
                    <div style="width: 50%; float: right;">
                        <p style="text-align: right;">____________________________________________________________</p>
                        <label for="simple-input" style="font-size: 12px; float:right;">podpis Klienta/osoby działającej w imieniu Klienta</label>
                    </div>
                </div>
                <div class="clear"></div>
                <div class="footer"><p style="width: 100%">2/2</p></div>
                <div class="print_text"><?php echo $aggreement_layout_number; ?></div>
            </div>

            <!--PELNOMOCNICTWO VOTUM-->

            # for (var i = 0; i < 2; i++) { #

            <div class="pdf_strona size-a4 pdf-page new-page">
                <div class="header">
                    <div class="logo_left">
                        <img src="<?php echo 'https://' . $_SERVER ['HTTP_HOST']; ?>/img/laur_small.png" />
                    </div>
                    <div class="logo_right">
                        <img src="<?php echo 'https://' . $_SERVER ['HTTP_HOST']; ?>/img/logo_small.png" />
                    </div>
                </div>
                <div class="clear"></div>
                <span class="contract_name">PEŁNOMOCNICTWO</span>
                <p style="margin-left: 20px; font-size:12px;">Ja niżej podpisany</p>
                <div class="form_section_enablement">
                    <div class="red_margin"></div>
                    <div class="form_section_body">
                        <div class="body_form">
                            <ul class="fieldlist">
                                <li>
                                    <div style="width: 50%; float: left;">
                                        <input name="FirstNameI" type="text" class="k-input k-textbox"
                                               value="#= (data.FirstName1 != null) ? data.FirstName1 : '' #"
                                               style="width: 95%;height: 18px;font-size:10px;"/>
                                        <label class="small_label_contract" for="simple-input">imię</label>
                                    </div>
                                    <div style="width: 50%; float: left;">
                                        <input name="LastNameI" type="text" class="k-input k-textbox"
                                               value="#= (data.LastName1 != null) ? data.LastName1 : '' #"
                                               style="width: 100%; height: 18px;font-size:10px;"/>
                                        <label class="small_label_contract" for="simple-input">nazwisko</label>
                                    </div>
                                </li>
                                <label for="simple-input" class="label_contract" style="width: 100%; float: left; font-weight: bold;">Adres zameldowania mocodawcy:</label>
                                <li>
                                    <div style="width: 60%; float: left;">
                                        <input name="StreetI" type="text" class="k-input k-textbox"
                                               value="#= (data.Street1 != null) ? data.Street1 : '' #"
                                               style="width: 95%; height: 18px;font-size:10px;"/>
                                        <label class="small_label_contract" for="simple-input">ulica</label>
                                    </div>
                                    <div style="width: 20%; float: left;">
                                        <input name="HomeNumberI" type="text" class="k-input k-textbox"
                                               value="#= (data.Home1 != null) ? data.Home1 : '' #"
                                               style="width: 95%; height: 18px;font-size:10px;"/>
                                        <label class="small_label_contract" for="simple-input">nr domu/mieszkania</label>
                                    </div>
                                    <div style="width: 20%; float: left;">
                                        <input name="PostCodeI" type="text" class="k-input k-textbox"
                                               value="#= (data.PostCode1 != null) ? data.PostCode1 : '' #"
                                               style="width: 100%; height: 18px;font-size:10px;"/>
                                        <label class="small_label_contract" for="simple-input">kod pocztowy</label>
                                    </div>
                                </li>
                                <li>
                                    <div style="width: 33%; float: left;">
                                        <input name="CityI" type="text" class="k-input k-textbox"
                                               value="#= (data.City1 != null) ? data.City1 : '' #"
                                               style="width: 95%; height: 18px;font-size:10px;"/>
                                        <label class="small_label_contract" for="simple-input">miejscowość</label>
                                    </div>
                                    <div style="width: 33%; float: left;">
                                        <input name="PESELI" type="text" class="k-input k-textbox"
                                               value="#= (data.PESEL1 != null) ? data.PESEL1 : '' #"
                                               style="width: 95%; height: 18px;font-size:10px;"/>
                                        <label class="small_label_contract" for="simple-input">PESEL</label>
                                    </div>
                                    <div style="width: 33%; float: left;">
                                        <input name="IdentityCardI" type="text" class="k-input k-textbox"
                                               value="#= (data.IdNr1 != null) ? data.IdNr1 : '' #"
                                               style="width: 100%; height: 18px;font-size:10px;"/>
                                        <label class="small_label_contract" for="simple-input">seria i numer dowodu osobistego</label>
                                    </div>
                                </li>
                                <li>
                                    <div style="width: 30%; float: left;">
                                        <input name="PhoneI" type="text" class="k-input k-textbox"
                                               value="#= (data.Phone1 != null) ? data.Phone1 : '' #"
                                               style="width: 95%;height: 18px;font-size:10px;"/>
                                        <label class="small_label_contract" for="simple-input">telefon *</label>
                                    </div>
                                    <div style="width: 70%; float: left;">
                                        <input name="EmailI" type="text" class="k-input k-textbox"
                                               value="#= (data.Email1 != null) ? data.Email1 : '' #"
                                               style="width: 100%; height: 18px;font-size:10px;"/>
                                        <label class="small_label_contract" for="simple-input">e-mail **</label>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="red_margin"></div>
                </div>
                <span class="contract_name" style="font-size: 11px !important;">UPOWAŻNIAM:</span>
                <div class="contract_text justyfy" style="margin-top: 10px !important;">
                    <p style="font-size: 12px !important; margin-top: 10px !important;">VOTUM S.A. z siedzibą we Wrocławiu 53-012, przy ul. Wyścigowa 56i, zarejestrowana w Sądzie
                        Rejonowym dla Wrocławia Fabrycznej VI Wydział Gospodarczy Krajowego Rejestru Sądowego pod numerem
                        KRS: 0000243252, REGON: 020136043, NIP: 899-25-49-057, KAPITAŁ ZAKŁADOWY: 1 200 000
                        zł. wpłacony w całości, d o podejmowania w moim imieniu wszelkich czynności mających na celu
                        dochodzenie roszczeń dotyczących umowy kredytu #= (data.CreditType != null) ? data.CreditType : '_______________________________' #
                        numer #= (data.BankContractNumber != null) ? data.BankContractNumber : '' # udzielonego przez #= (data.MandateBankName != null) ? data.MandateBankName : '' #
                        , w tym w szczególności do: wszelkich czynności pozaprocesowych i
                        polubownych, zawarcia ugody, w tym wiążącej się ze zrzeczeniem się dalszych roszczeń, odbioru świadczenia,
                        wskazania rachunku bankowego, na który mają być przelane świadczenia, odbioru wszelkiej korespondencji w
                        sprawach objętych pełnomocnictwem, gromadzenia dokumentacji mającej związek ze sprawą, w tym jej odbioru
                        od podmiotów, które je tworzą i przechowują, udzielania dalszych pełnomocnictw. </p>

                    <p style="font-weight: bold; font-size: 12px !important; margin-top: 10px !important;">
                        Zgodnie z art. 104 ust. 3 ustawy z dnia 29 sierpnia 1997 r. Prawo bankowe (Dz. U. z 2016 r. poz. 1988) upoważniam
                        zarówno bank, a także Rzecznika Finansowego, do ujawnienia i przekazania VOTUM S.A. wszelkich żądanych
                        przez Spółkę dokumentów i informacji objętych tajemnicą bankową, dotyczących udzielenia i wykonania kredytu #= (data.CreditType != null) ? data.CreditType : '_______________________________' #
                        o numerze #= (data.BankContractNumber != null) ? data.BankContractNumber : '' # na podstawie umowy z dnia ____________________ r. , w zakresie niezbędnym do wykonania wszelkich
                        czynności objętych pełnomocnictwem, a także realizacji zadań przez Rzecznika Finansowego w związku z wniesionym
                        wnioskiem w ww. sprawie.
                    </p>
                </div>
                <div class="clear"></div>

                <div class="contract_text" style="margin-top: 20px;">
                    <div style="width: 50%; float: left;">
                        <p style="text-align: left;">_________________________________________</p>
                        <label for="simple-input" style="font-size: 10px; float:left;">miejscowość, data</label>
                    </div>
                    <div style="width: 50%; float: right;">
                        <p style="text-align: right;">_________________________________________</p>
                        <label for="simple-input" style="font-size: 10px; float:right;">PODPIS MOCODAWCY</label>
                    </div>
                </div>
                <div class="footer"><p style="width: 100%">1/1</p></div>
                <div class="print_text"><?php echo $enablement_votum_layout_number; ?></div>
            </div>

            #}#

            #if(data.PESEL2){#

            # for (var i = 0; i < 2; i++) { #

            <!--DRUGIE PELNOMOCNICTWO VOTUM-->

            <div class="pdf_strona size-a4 pdf-page new-page">
                <div class="header">
                    <div class="logo_left">
                        <img src="<?php echo 'https://' . $_SERVER ['HTTP_HOST']; ?>/img/laur_small.png" />
                    </div>
                    <div class="logo_right">
                        <img src="<?php echo 'https://' . $_SERVER ['HTTP_HOST']; ?>/img/logo_small.png" />
                    </div>
                </div>
                <div class="clear"></div>
                <span class="contract_name">PEŁNOMOCNICTWO</span>
                <p style="margin-left: 20px; font-size:12px;">Ja niżej podpisany</p>
                <div class="form_section_enablement">
                    <div class="red_margin"></div>
                    <div class="form_section_body">
                        <div class="body_form">
                            <ul class="fieldlist">
                                <li>
                                    <div style="width: 50%; float: left;">
                                        <input name="FirstNameII" type="text" class="k-input k-textbox"
                                               value="#= (data.FirstName2 != null) ? data.FirstName2 : '' #"
                                               style="width: 95%;height: 18px;font-size:10px;"/>
                                        <label class="small_label_contract" for="simple-input">imię</label>
                                    </div>
                                    <div style="width: 50%; float: left;">
                                        <input name="LastNameII" type="text" class="k-input k-textbox"
                                               value="#= (data.LastName2 != null) ? data.LastName2 : '' #"
                                               style="width: 100%; height: 18px;font-size:10px;"/>
                                        <label class="small_label_contract" for="simple-input">nazwisko</label>
                                    </div>
                                </li>
                                <label for="simple-input" class="label_contract" style="width: 100%; float: left; font-weight: bold;">Adres zameldowania mocodawcy:</label>
                                <li>
                                    <div style="width: 60%; float: left;">
                                        <input name="StreetII" type="text" class="k-input k-textbox"
                                               value="#= (data.Street2 != null) ? data.Street2 : '' #"
                                               style="width: 95%; height: 18px;font-size:10px;"/>
                                        <label class="small_label_contract" for="simple-input">ulica</label>
                                    </div>
                                    <div style="width: 20%; float: left;">
                                        <input name="HomeNumberII" type="text" class="k-input k-textbox"
                                               value="#= (data.Home2 != null) ? data.Home2 : '' #"
                                               style="width: 95%; height: 18px;font-size:10px;"/>
                                        <label class="small_label_contract" for="simple-input">nr domu/mieszkania</label>
                                    </div>
                                    <div style="width: 20%; float: left;">
                                        <input name="PostCodeII" type="text" class="k-input k-textbox"
                                               value="#= (data.PostCode2 != null) ? data.PostCode2 : '' #"
                                               style="width: 100%; height: 18px;font-size:10px;"/>
                                        <label class="small_label_contract" for="simple-input">kod pocztowy</label>
                                    </div>
                                </li>
                                <li>
                                    <div style="width: 33%; float: left;">
                                        <input name="CityII" type="text" class="k-input k-textbox"
                                               value="#= (data.City2 != null) ? data.City2 : '' #"
                                               style="width: 95%; height: 18px;font-size:10px;"/>
                                        <label class="small_label_contract" for="simple-input">miejscowość</label>
                                    </div>
                                    <div style="width: 33%; float: left;">
                                        <input name="PESELII" type="text" class="k-input k-textbox"
                                               value="#= (data.PESEL2 != null) ? data.PESEL2 : '' #"
                                               style="width: 95%; height: 18px;font-size:10px;"/>
                                        <label class="small_label_contract" for="simple-input">PESEL</label>
                                    </div>
                                    <div style="width: 33%; float: left;">
                                        <input name="IdentityCardII" type="text" class="k-input k-textbox"
                                               value="#= (data.IdNr2 != null) ? data.IdNr2 : '' #"
                                               style="width: 100%; height: 18px;font-size:10px;"/>
                                        <label class="small_label_contract" for="simple-input">seria i numer dowodu osobistego</label>
                                    </div>
                                </li>
                                <li>
                                    <div style="width: 30%; float: left;">
                                        <input name="PhoneII" type="text" class="k-input k-textbox"
                                               value="#= (data.Phone2 != null) ? data.Phone2 : '' #"
                                               style="width: 95%;height: 18px;font-size:10px;"/>
                                        <label class="small_label_contract" for="simple-input">telefon *</label>
                                    </div>
                                    <div style="width: 70%; float: left;">
                                        <input name="EmailII" type="text" class="k-input k-textbox"
                                               value="#= (data.Email2 != null) ? data.Email2 : '' #"
                                               style="width: 100%; height: 18px;font-size:10px;"/>
                                        <label class="small_label_contract" for="simple-input">e-mail **</label>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="red_margin"></div>
                </div>
                <span class="contract_name" style="font-size: 11px !important;">UPOWAŻNIAM:</span>
                <div class="contract_text justyfy" style="margin-top: 10px !important;">
                    <p style="font-size: 12px !important; margin-top: 10px !important;">VOTUM S.A. z siedzibą we Wrocławiu 53-012, przy ul. Wyścigowa 56i, zarejestrowana w Sądzie
                        Rejonowym dla Wrocławia Fabrycznej VI Wydział Gospodarczy Krajowego Rejestru Sądowego pod numerem
                        KRS: 0000243252, REGON: 020136043, NIP: 899-25-49-057, KAPITAŁ ZAKŁADOWY: 1 200 000
                        zł. wpłacony w całości, d o podejmowania w moim imieniu wszelkich czynności mających na celu
                        dochodzenie roszczeń dotyczących umowy kredytu #= (data.CreditType != null) ? data.CreditType : '_______________________________' #
                        numer #= (data.BankContractNumber != null) ? data.BankContractNumber : '' # udzielonego przez #= (data.MandateBankName != null) ? data.MandateBankName : '' #
                        , w tym w szczególności do: wszelkich czynności pozaprocesowych i
                        polubownych, zawarcia ugody, w tym wiążącej się ze zrzeczeniem się dalszych roszczeń, odbioru świadczenia,
                        wskazania rachunku bankowego, na który mają być przelane świadczenia, odbioru wszelkiej korespondencji w
                        sprawach objętych pełnomocnictwem, gromadzenia dokumentacji mającej związek ze sprawą, w tym jej odbioru
                        od podmiotów, które je tworzą i przechowują, udzielania dalszych pełnomocnictw. </p>

                    <p style="font-weight: bold; font-size: 12px !important; margin-top: 10px !important;">
                        Zgodnie z art. 104 ust. 3 ustawy z dnia 29 sierpnia 1997 r. Prawo bankowe (Dz. U. z 2016 r. poz. 1988) upoważniam
                        zarówno bank, a także Rzecznika Finansowego, do ujawnienia i przekazania VOTUM S.A. wszelkich żądanych
                        przez Spółkę dokumentów i informacji objętych tajemnicą bankową, dotyczących udzielenia i wykonania kredytu #= (data.CreditType != null) ? data.CreditType : '_______________________________' #
                        o numerze #= (data.BankContractNumber != null) ? data.BankContractNumber : '' # na podstawie umowy z dnia ____________________ r. , w zakresie niezbędnym do wykonania wszelkich
                        czynności objętych pełnomocnictwem, a także realizacji zadań przez Rzecznika Finansowego w związku z wniesionym
                        wnioskiem w ww. sprawie.
                    </p>
                </div>
                <div class="clear"></div>

                <div class="contract_text" style="margin-top: 20px;">
                    <div style="width: 50%; float: left;">
                        <p style="text-align: left;">_________________________________________</p>
                        <label for="simple-input" style="font-size: 10px; float:left;">miejscowość, data</label>
                    </div>
                    <div style="width: 50%; float: right;">
                        <p style="text-align: right;">_________________________________________</p>
                        <label for="simple-input" style="font-size: 10px; float:right;">PODPIS MOCODAWCY</label>
                    </div>
                </div>
                <div class="footer"><p style="width: 100%">1/1</p></div>
                <div class="print_text"><?php echo $enablement_votum_layout_number; ?></div>
            </div>


            #}#

            #}#

            <!--PELNOMOCNICTWO KAIRP-->

            # for (var i = 0; i < 2; i++) { #


            <div class="pdf_strona size-a4 pdf-page new-page">
                <div class="header">
                    <div class="logo_left">
                        <img style="margin-left: 0px !important;" src="<?php echo 'https://' . $_SERVER ['HTTP_HOST']; ?>/img/logo_kairp_small.png" />
                    </div>
                </div>
                <div class="clear"></div>
                <div class="contract_text">
                    <div style="width: 50%; float: right;">
                        <p style="text-align: right;font-size: 10px; float:right;">__________________________________, ____________ r. </p>
                    </div>
                </div>
                <div class="clear"></div>
                <span class="contract_name" style="margin: 50px 0 50px 0;">PEŁNOMOCNICTWO</span>
                <div class="contract_text justyfy" style="margin-top: 10px !important;">
                    <p style="font-size: 12px !important; margin-top: 10px !important;">Ja niżej podpisany/a
                        #= (data.FirstName1 != null) ? data.FirstName1 +' '+ data.LastName1 : '_____________________________________' #
                        upoważniam
                        _________________________________ ______________________________ z Kancelarii Adwokatów
                        i Radców Prawnych A. Łebek i Wspólnicy sp. k. we Wrocławiu do prowadzenia sprawy przeciwko
                        #= (data.BankName != null) ? data.BankName : '_____________________________________' # o zapłatę. Pełnomocnictwo obejmuje
                        umocowanie do podejmowania wszelkich związanych ze sprawą czynności zarówno w postępowaniu przed
                        sądami powszechnymi wszystkich instancji, złożenia wniosku o zawezwanie do próby ugodowej oraz negocjowania
                        i zawarcia ugody, a także prowadzenia negocjacji pozasądowych oraz uprawnienie do odbioru świadczenia.
                        Pełnomocnictwo niniejsze zostaje udzielone na czas nieokreślony, ze skutkiem od dnia jego przyjęcia
                        przez Pełnomocnika.
                    </p>
                </div>
                <div class="clear"></div>
                <div class="contract_text justyfy" style="margin-top: 10px !important;">
                    <p style="font-size: 12px !important; margin-top: 10px !important;">
                        Ponadto, na podstawie art. 104 ust. 3 ustawy z dnia 29 sierpnia 1997 r. Prawo bankowe (Dz. U. z 2016 r. poz. 1988), upoważniam zarówno bank,
                        a także Rzecznika Finansowego do ujawnienia i przekazania wszystkich informacji objętych tajemnicą bankową mojemu pełnomocnikowi,
                        w zakresie niezbędnym do wykonania wszelkich czynności objętych pełnomocnictwem, a także realizacji zadań przez Rzecznika Finansowego w związku
                        z wniesionym wnioskiem w wyżej wymienionej sprawie.
                    </p>
                </div>
                <div class="clear"></div>

                <div class="contract_text">
                    <div style="width: 50%; float: right; margin-top:20px;">
                        <p style="text-align: right;">_________________________________________</p>
                        <label for="simple-input" style="font-size: 10px; float:right;">PODPIS MOCODAWCY</label>
                    </div>
                </div>
                <div class="clear"></div>
                <div class="contract_text">
                    <p style="font-size:12px !important;">Oświadczam, że pełnomocnictwo niniejsze przyjmuję oraz udzielam substytucji do prowadzenia sprawy:</p>
                    <p style="margin: 10px 0 10px 0 !important;">1. _______________________________________________________________________________</p>
                    <p style="margin: 10px 0 10px 0 !important;">2. _______________________________________________________________________________</p>
                    <p style="margin: 10px 0 10px 0 !important;">3. _______________________________________________________________________________</p>
                </div>
                <div class="clear"></div>
                <div class="contract_text" style="margin-top:20px;">
                    <div style="width: 50%; float: left;">
                        <p style="text-align: left;font-size:12px !important;">Wrocław, dnia ________________ r.</p>
                    </div>
                    <div style="width: 50%; float: right;">
                        <p style="text-align: right;">_________________________________________</p>
                        <label for="simple-input" style="font-size: 10px; float:right;">PODPIS PEŁNOMOCNIKA</label>
                    </div>
                </div>
                <div class="footer"><p style="width: 100%">1/1</p></div>
            </div>

            # } #

            # if(data.PESEL2){ #

            # for (var i = 0; i < 2; i++) { #

            <!--DRUGIE PELNOMOCNICTWO KAIRP-->


            <div class="pdf_strona size-a4 pdf-page new-page">
                <div class="header">
                    <div class="logo_left">
                        <img style="margin-left: 0px !important;" src="<?php echo 'https://' . $_SERVER ['HTTP_HOST']; ?>/img/logo_kairp_small.png" />
                    </div>
                </div>
                <div class="clear"></div>
                <div class="contract_text">
                    <div style="width: 50%; float: right;">
                        <p style="text-align: right;font-size: 10px; float:right;">__________________________________, ____________ r. </p>
                    </div>
                </div>
                <div class="clear"></div>
                <span class="contract_name" style="margin: 50px 0 50px 0;">PEŁNOMOCNICTWO</span>
                <div class="contract_text justyfy" style="margin-top: 10px !important;">
                    <p style="font-size: 12px !important; margin-top: 10px !important;">Ja niżej podpisany/a
                        #= (data.FirstName2 != null) ? data.FirstName2 +' '+ data.LastName2 : '_____________________________________' #
                        upoważniam
                        _________________________________ ______________________________ z Kancelarii Adwokatów
                        i Radców Prawnych A. Łebek i Wspólnicy sp. k. we Wrocławiu do prowadzenia sprawy przeciwko
                        #= (data.BankName != null) ? data.BankName : '_____________________________________' # o zapłatę. Pełnomocnictwo obejmuje
                        umocowanie do podejmowania wszelkich związanych ze sprawą czynności zarówno w postępowaniu przed
                        sądami powszechnymi wszystkich instancji, złożenia wniosku o zawezwanie do próby ugodowej oraz negocjowania
                        i zawarcia ugody, a także prowadzenia negocjacji pozasądowych oraz uprawnienie do odbioru świadczenia.
                        Pełnomocnictwo niniejsze zostaje udzielone na czas nieokreślony, ze skutkiem od dnia jego przyjęcia
                        przez Pełnomocnika.
                    </p>
                </div>
                <div class="clear"></div>
                <div class="contract_text justyfy" style="margin-top: 10px !important;">
                    <p style="font-size: 12px !important; margin-top: 10px !important;">
                        Ponadto, na podstawie art. 104 ust. 3 ustawy z dnia 29 sierpnia 1997 r. Prawo bankowe (Dz. U. z 2016 r. poz. 1988), upoważniam zarówno bank,
                        a także Rzecznika Finansowego do ujawnienia i przekazania wszystkich informacji objętych tajemnicą bankową mojemu pełnomocnikowi,
                        w zakresie niezbędnym do wykonania wszelkich czynności objętych pełnomocnictwem, a także realizacji zadań przez Rzecznika Finansowego w związku
                        z wniesionym wnioskiem w wyżej wymienionej sprawie.
                    </p>
                </div>
                <div class="clear"></div>

                <div class="contract_text">
                    <div style="width: 50%; float: right; margin-top:20px;">
                        <p style="text-align: right;">_________________________________________</p>
                        <label for="simple-input" style="font-size: 10px; float:right;">PODPIS MOCODAWCY</label>
                    </div>
                </div>
                <div class="clear"></div>
                <div class="contract_text">
                    <p style="font-size:12px !important;">Oświadczam, że pełnomocnictwo niniejsze przyjmuję oraz udzielam substytucji do prowadzenia sprawy:</p>
                    <p style="margin: 10px 0 10px 0 !important;">1. _______________________________________________________________________________</p>
                    <p style="margin: 10px 0 10px 0 !important;">2. _______________________________________________________________________________</p>
                    <p style="margin: 10px 0 10px 0 !important;">3. _______________________________________________________________________________</p>
                </div>
                <div class="clear"></div>
                <div class="contract_text" style="margin-top:20px;">
                    <div style="width: 50%; float: left;">
                        <p style="text-align: left;font-size:12px !important;">Wrocław, dnia ________________ r.</p>
                    </div>
                    <div style="width: 50%; float: right;">
                        <p style="text-align: right;">_________________________________________</p>
                        <label for="simple-input" style="font-size: 10px; float:right;">PODPIS PEŁNOMOCNIKA</label>
                    </div>
                </div>
                <div class="footer"><p style="width: 100%">1/1</p></div>
            </div>

                #}#
            #}#

            <!--POUCZENIE-->

            <div class="pdf_strona size-a4 pdf-page new-page">
                <div class="header">
                    <div class="logo_right">
                        <img src="<?php echo 'https://' . $_SERVER ['HTTP_HOST']; ?>/img/logo_small.png" />
                    </div>
                </div>
                <div class="clear"></div>
                <span class="contract_name">POUCZENIE O PRAWIE DO ODSTĄPIENIA<br />
                        OD UMOWY ORAZ O INNYCH PRAWACH KONSUMENTA</span>
                <br/>
                <div class="contract_text" style="margin-top: 10px !important;">
                    <p style="font-weight: bold; margin-left: 20px;  margin-top: 10px !important">PRAWO DO ODSTĄPIENIA OD UMOWY</p>
                    <p style="font-size: 10px !important; margin-bottom: 10px; margin-top: 5px !important;">Zgodnie z przepisami ustawy z dnia 30 maja 2016 r. o prawach konsumenta (Dz. U. z 2014 r., poz. 827), VOTUM informuje, że mają
                        Państwo prawo odstąpić od niniejszej umowy w terminie 14 dni bez podania jakiejkolwiek przyczyny. Termin do odstąpienia od
                        umowy kończy się po upływie 14 dni od dnia zawarcia umowy. Aby skorzystać z prawa do odstąpienia od umowy, muszą Państwo
                        poinformować VOTUM S.A., ul. Wyścigowa 56i, 53-012 Wrocław, tel. 71/ 33 93 400, faks. 71/33 93 403, e-mail: dok@votum-sa.pl
                        o swojej decyzji w drodze jednoznacznego oświadczenia, na przykład pismem wysłanym pocztą, faksem lub pocztą elektroniczną. Mogą
                        Państwo skorzystać z wzoru formularza odstąpienia od umowy, jednak nie jest to obowiązkowe. Aby zachować termin do odstąpienia
                        od umowy, wystarczy, aby wysłali Państwo informację dotyczącą wykonania przysługującego Państwu prawa do odstąpienia od
                        umowy przed upływem terminu do odstąpienia od umowy. </p>
                    <p style="font-weight: bold;margin-left: 20px; margin-top: 10px !important">SKUTKI ODSTĄPIENIA OD UMOWY</p>
                    <p style="font-size: 10px !important; margin-bottom: 10px; margin-top: 5px !important;">
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
                    </p>
                    <p style="font-weight: bold; margin-left: 20px;  margin-top: 10px !important">POZASĄDOWE SPOSOBY ROZPATRYWANIA REKLAMACJI</p>
                    <p style=" font-size: 10px !important; margin-bottom: 10px; margin-top: 5px !important;">
                        Jeżeli złożą Państwo reklamację na usługi VOTUM i nie zostanie ona uwzględniona albo rozpatrzona przez VOTUM w terminie 30 dni
                        od dnia jej otrzymania, mają Państwo prawo skorzystać z pozasądowych sposobów rozpatrywania reklamacji w drodze mediacji lub za
                        pomocą sądów polubownych, składając na odpowiednim formularzu wniosek do właściwego terenowo Wojewódzkiego Inspektoratu
                        Inspekcji Handlowej. Mogą Państwo również zwrócić się o pomoc do właściwego terenowo miejskiego lub powiatowego rzecznika
                        konsumentów. Ze wskazanych sposobów rozwiązywania sporów można skorzystać dobrowolnie i nieodpłatnie. Więcej informacji na
                        ten temat mogą Państwo uzyskać we wskazanych instytucjach oraz w Urzędzie Ochrony Konkurencji i Konsumentów, www.uokik.gov.pl.
                    </p>
                    <div class="content_text">
                        <div class="pattern">
                            <p class="red">WZÓR FORMULARZA ODSTĄPIENIA OD UMOWY</p>
                            <div class="row" style="margin-top: 10px">
                                <div class="col-7">
                                </div>
                                <div class="col-3">
                                    <p style="font-weight: bold">VOTUM S.A.</p>
                                    <p style="font-weight: bold">ul. Wyścigowa 56i</p>
                                    <p style="font-weight: bold">53-012</p>
                                    <p>fax: 71/ 33 93 403</p>
                                    <p>dok@votum-sa.pl</p>
                                </div>
                                <div class="col-2"></div>
                            </div>
                            <div class="row" style="margin-top: 10px; text-align: center">
                                <div class="col-12">
                                    <p style="font-weight: bold; font-size: 24px;">ODSTĄPIENIE OD UMOWY</p>
                                    <p style="font-weight: bold; font-size: 12px">(formularz ten należy wypełnić i odesłać tylko w przypadku chęci odstąpienia od umowy)</p>
                                </div>
                            </div>
                            <div class="row" style="margin-top: 10px; text-align: center">
                                <p style="font-size: 8px !important; margin: auto !important">Niniejszym informuję/informujemy* o moim/naszym* odstąpieniu od umowy zawartej na podstawie zamówienia z dnia __________________ .</p>
                            </div>
                            <div class="row" style="margin-top: 20px">
                                <div class="col-7">
                                </div>
                                <div class="col-3">
                                    <p style="margin-top: 10px; margin-bottom: 0!important; height: 15px">________________________________</p>
                                    <p style="font-size: 7px !important">IMIĘ I NAZWISKO KONSUMENTA(-ÓW)</p>
                                    <p style="margin-top: 10px; height: 15px">________________________________</p>
                                    <p style="margin-top: 10px; margin-bottom: 0!important; height: 15px">________________________________</p>
                                    <p style="font-size: 7px !important">ADRES ZAMIESZKANIA KONSUMENTA(-ÓW)</p>
                                    <p style="margin-top: 10px; margin-bottom: 0!important; height: 15px">________________________________</p>
                                    <p style="font-size: 7px !important">PODPIS KONSUMENTA(-ÓW), DATA</p>
                                </div>
                                <div class="col-2"></div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="clear"></div>
                <div class="footer"><p style="width: 100%">1/2</p></div>
                <div class="print_text"><?php echo $resignation_layout_number; ?></div>
            </div>


            <div class="pdf_strona size-a4 pdf-page new-page">
                <div class="row" style="margin-top: 30px">
                    <div class="col-7">
                    </div>
                    <div class="col-3">
                        <p style="margin: 0; font-weight: bold; font-size:10px">VOTUM S.A.</p>
                        <p style="margin: 0; font-weight: bold; font-size:10px">ul. Wyścigowa 56i</p>
                        <p style="margin: 0; font-weight: bold; font-size:10px">53-012</p>
                        <p style="margin: 0; font-size:10px">fax: 71/ 33 93 403</p>
                        <p style="margin: 0; font-size:10px">dok@votum-sa.pl</p>
                    </div>
                    <div class="col-2"></div>
                </div>
                <div class="clear"></div>
                <div style="text-align:center; margin-top: 40px">
                    <span class="contract_name">ODSTĄPIENIE OD UMOWY</span>
                    <p style="font-weight: bold; font-size: 12px">(formularz ten należy wypełnić i odesłać tylko w przypadku chęci odstąpienia od umowy)</p>
                </div>
                <div class="row" style=" margin-top: 50px; text-align: center">
                    <p style="font-size: 12px; margin:auto">Niniejszym informuję/informujemy* o moim/naszym* odstąpieniu od umowy zawartej <br/> na podstawie zamówienia z dnia __________________ .</p>
                </div>
                <br/>
                <div class="row" style="margin-top: 20px">
                    <div class="col-6">
                    </div>
                    <div class="col-4">
                        <p style="margin-top: 20px; margin-bottom:0 !important;">____________________________________________</p>
                        <p style="">IMIĘ I NAZWISKO KONSUMENTA(-ÓW)</p>
                        <p style="margin-top: 20px">____________________________________________</p><br/>
                        <p style=" margin-bottom: 0 !important;">____________________________________________</p>
                        <p style="">ADRES ZAMIESZKANIA KONSUMENTA(-ÓW)</p>
                        <p style="margin-top: 20px; margin-bottom: 0!important">____________________________________________</p>
                        <p style="">PODPIS KONSUMENTA(-ÓW), DATA</p>
                    </div>
                    <div class="col-2"></div>
                </div>
                <div class="clear"></div>
                <div class="footer"><p style="width: 100%">2/2</p></div>
                <div class="print_text"><?php echo $resignation_layout_number; ?></div>
            </div>

        </div>

        <script type="text/javascript">

          var viewModel2 = kendo.observable({
            isVisible: true,
            isEnabled: true,
            onClick: function() {
              kendo.drawing.drawDOM('\#dialogEdit \#print-contract-edit',{
                forcePageBreak: ".new-page",
                paperSize: "A4",
                margin: "0cm"
              }).then(function(group){
                kendo.drawing.pdf.saveAs(group, "contract.pdf");
              });
            }
          });
          kendo.bind($(".printContractEdit"), viewModel2);
          </\script>

</script>
