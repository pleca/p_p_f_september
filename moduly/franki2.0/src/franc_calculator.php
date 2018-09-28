<div id="franc-calculator" class="container">
    <div class="row"><p class="franc-calculator-header">Kalkulator oblicza orientacyjną wartość nadpłaconych rat kredytu w związku z faktem, że bank stosował w umowie kredytowej niedozwoloną klauzulę indeksacyjną. UWAGA. Banki stosowały różne kursy CHF dla przeliczania należnych rat kredytu z CHF na PLN, dlatego jako punkt odniesienia do wyliczeń przyjęliśmy 1% różnicy w stosunku do średniego kursu NBP.</p></div>
<!--    <div class="row">
        <div class="col-6 franc-calculator-form">
            <input type="checkbox" id="eq1" class="k-checkbox" checked="checked">
            <label class="k-checkbox-label" for="eq1">Czy kredyt był wypłacany w transzach?</label>
        </div>
    </div>-->
    <div class="row">
        <div class="col-6 franc-calculator-form pln-value-div">
            <label><b>Kwota kredytu w PLN (lub pierwszej transzy)</b></label>
            <input type="number" min="0" name="plnValue" id="plnValue" tabindex="1" required validationMessage="Uzupełnij pole" /><span class="franc_tooltip" data-toggle="tooltip" title="Tutaj wpisz kwotę kredytu w PLN (I transzy).">?</span>
        </div>
        <div class="col-6 franc-calculator-form">
            <label><b>Karencja w spłacie kapitału (mies)</b></label>
            <input min="0" type="number" name="gracePeriod" tabindex="7" id="gracePeriod" />
        </div>
    </div>
    <div class="row">
        <div class="franc-calculator-form col-6 loan-period-div">
            <label><b>Okres kredytowania (mies)</b></label>
            <input type="text" name="loanPeriod" tabindex="2" id="loanPeriod" required validationMessage="Uzupełnij pole"/><span class="franc_tooltip" data-toggle="tooltip" title="Podaj okres kredytowania w miesiącach(np. 20at = 240 miesięcy, 30 lat = 360 miesięcy).">?</span>
        </div>

        <div class="franc-calculator-form col-6">
            <label><b>Wartość spreadu w %</b></label>
            <input value="1" min="0" type="number" name="spread" tabindex="8" disabled id="spread" required />
        </div>
    </div>
    <div class="row">
        <div class="franc-calculator-form col-6 agreement-date-div">
            <label><b>Data udzielenia kredytu</b></label>
            <input id="agreementDate" name="agreementDate" value="01.08.2008" tabindex="3" required type="date" validationMessage="Uzupełnij pole"/><span class="franc_tooltip" data-toggle="tooltip" title="Podaj datę udzielenia kredytu (dzień.miesiąc.rok).">?</span>
        </div>
        <div class="franc-calculator-form col-6">
            <label><b>Data, od której kredyt spłacany jest w CHF</b></label>
            <input id="chfDate" name="chfDate" type="date" tabindex="9"/>
        </div>
    </div>

    <div class="row">
        <div class="franc-calculator-form col-6 margin-div">
            <label><b>Marża banku w %</b></label>
            <input min="0" type="text" id="margin" tabindex="4" required validationMessage="Uzupełnij pole" name="margin"  /><span class="franc_tooltip" data-toggle="tooltip" title="Tutaj podaj marżę kredytu, która zostanie doliczona do stawki LIBOR 3M CHF.">?</span>
        </div>
        <div class="franc-calculator-form col-6">
            <label><b>Orientacyjna wartość nadpłaconych rat w PLN</b></label>
            <div id="actualOverpaidValueChange" class="actualOverpaidValue"></div>
        </div>
    </div>
    <div class="row">
        <div class="franc-calculator-form col-6">
            <label><b>Kurs CHF z dnia udzielenia kredytu</b></label>
            <input min="0" type="number" disabled name="exchangeRate" tabindex="5" id="exchangeRate" />
        </div>
        <div class="franc-calculator-form col-6">
            <label><b>Orientacyjna wartość przyszłych nadpłat w PLN</b></label>
            <div id="futureOverpaidValueChange" class="futureOverpaidValue"></div>
        </div>
    </div>
    <div class="row">
        <div class="franc-calculator-form col-6">
            <label><b>Kwota kredytu w CHF</b></label>
            <input type="number" min="0" name="chfValue" disabled id="chfValue" tabindex="6"/>
        </div>
        <div class="franc-calculator-form col-6">
            <div><b>Suma wartości wszystkich korzyści w PLN</b></div>
            <div id="spreadRefundValueChange" class="spreadRefundValue"></div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="calculate"><button type="submit" class="btn odswierzSesje calculateValue" tabindex="11">Oblicz</button></div>
        </div>
    </div>
    <div class="row" style="margin-top:20px; margin-bottom: 10px;">
        <div class="col-12">
            <div class="calculateTranche"><button disabled class="btn" id="addBtn">Dodaj kolejną transzę</button></div>
        </div>
    </div>
    <div class="row" style="margin-top: 20px;">
        <div class="col-12">
            <div class="refreshCalculate"><button type="submit" class="btn odswierzSesje" id="refreshCalc" tabindex="11">Wyczyśc wartości</button></div>
        </div>
    </div>
    <div class="row trancheList">
        <div class="franc-calculator-form col-12" id="listView" style="border-width: 0px;"></div>
    </div>
    <div class="row hide" id="move-to-commission-calc-btn">
        <div class="col-12">
            <div class="commission-calculate"><button type="submit" class="btn" id="move-to-commission-calc" tabindex="11">Przenieś wyniki do kalkulatora ofertowego</button></div>
        </div>
    </div>
            <h4 class="closeToExpirationInfo"></h4>
<!--        <div class="table-responsive">-->
<!--            <table class="table" border="1">-->
<!--                <div id="franc-calculator-form">-->
<!--                <tbody>-->
<!--                <tr>-->
<!--                    <th scope="row"> <b>Kwota kredytu w PLN</b></th>-->
<!--                    <td class="plnValue"><input type="number" min="0" id="plnValue" required></td>-->
<!--                    <td><b>Karencja w spłacie kapitału (mies)</b></td>-->
<!--                    <td class="gracePeriod"><input min="0" type="number"></td>-->
<!--                </tr>-->
<!--                <tr>-->
<!--                    <th scope="row"><b>Kwota kredytu w CHF</b></th>-->
<!--                    <td class="chfValue"><input type="number" min="0" required></td>-->
<!--                    <td><b>Wartość spreadu w %</b></td>-->
<!--                    <td class="spread"><input value="1" min="0" type="number" required></td>-->
<!--                </tr>-->
<!--                <tr>-->
<!--                    <th scope="row"><b>Kurs CHF z dnia udzielenia kredytu</b></th>-->
<!--                    <td class="exchangeRate"><input min="0" type="number" required></td>-->
<!--                    <td><b>Data, od której kredyt spłacany jest w CHF</b></td>-->
<!--                    <td class="chfDate"><input id="chfDate" type="date"></td>-->
<!--                </tr>-->
<!--                <tr>-->
<!--                    <th scope="row"><b>Marża banku w %</b></th>-->
<!--                    <td class="margin"><input min="0" type="text" name="margin" required></td>-->
<!--                    <td><b>Dzień płatności</b></td>-->
<!--                    <td class="paymentDayOfMonth"><input min="1" type="number"></td>-->
<!--                </tr>-->
<!--                <tr>-->
<!--                    <th scope="row"><b>Data udzielenia kredytu</b></th>-->
<!--                    <td class="agreementDate"><input id="agreementDate" required type="date"></td>-->
<!--                    <td><b>Orientacyjna wartość nadpłaconych rat w PLN</b></td>-->
<!--                    <td class="actualOverpaidValue"></td>-->
<!--                </tr>-->
<!--                <tr>-->
<!--                    <th scope="row"><b>Okres kredytowania (mies)</b></th>-->
<!--                    <td class="loanPeriod"><input type="text" required></td>-->
<!--                    <td><b>Orientacyjna wartość przyszłych nadpłat w PLN</b></td>-->
<!--                    <td class="futureOverpaidValue"></td>-->
<!--                </tr>-->
<!--                <tr>-->
<!--                    <td colspan="2" class="calculate"><button type="submit" class="btn ">Oblicz</button></td>-->
<!--<!--                    <td><b>Suma wartości wszystkich korzyści w PLN</b></td>-->
<!--                    <td><span class="status"></span></td>-->
<!--                    <td class="spreadRefundValue"></td>-->
<!--                </tr>-->
<!--                </tbody>-->
<!--                </div>-->
<!--            </table>-->
<!--            <h4 class="closeToExpirationInfo"></h4>-->
<!--        </div>-->
<!--    </div>-->
    <div class="row">
        <div class="col-12">
            <div class="calculate">
                <button id="frank-calculate-generate-pdf">Generuj PDF</button>
            </div>
        </div>
    </div>
</div>

<script type="text/x-kendo-tmpl" id="template">
    <div class="row" style="margin-left: 20px;">
        <div class="franc-calculator-form col-6">
            <label><b>Data wypłaty transzy</b></label>
            <input disabled name="trancheDate" id="trancheDate" type="text" class="k-input k-textbox trancheDate" value="#= kendo.toString(kendo.parseDate(trancheDate), 'dd.MM.yyyy') #"/>
        </div>
        <div class="franc-calculator-form col-5">
            <label><b>Kwota transzy w PLN</b></label>
            <input disabled name="trancheValue" id="trancheValue" type="text" class="k-input k-textbox trancheValue" value="#= trancheValue #"/>
        </div>
        <div class="franc-calculator-form col-6" style="text-align:center; display: none;">
            <label><b>Orientacyjna wartość nadpłaconych rat w PLN</b></label>
            <input disabled name="trancheOverpaidValue" id="trancheOverpaidValue" type="text" class="futureOverpaidValueTranche" value="#= trancheOverpaidValue #"/>
        </div>
        <!--<div class="franc-calculator-form col-3" style="text-align:center; margin-top: 30px;">
        <div class="edit-buttons">
                <a class="k-button k-edit-button" href="\\#"><span class="k-icon k-i-edit"></span>&nbsp;Edytuj</a>
                <a class="k-button k-delete-button" href="\\#"><span class="k-icon k-i-close"></span>&nbsp;Usuń</a>
            </div>
        </div>-->
    </div>
    <script>
    $(".k-delete-button").click(function(e) {

        var value = $(this).parent().parent().parent().children().first().next().next().children().first().next().val();

    });
     <\/script>
</script>

<script type="text/x-kendo-tmpl" id="editTemplate">
     <div style="margin-bottom: 10px; padding-bottom: 15px; border-bottom: 2px solid \#a71016;">
         <div class="row trancheRow">
            <div class="tmpValue" style="text-align:center; display:none;">
                <input id="actualOverpaidValue_tmp" name="actualOverpaidValue_tmp" type="text"/>
                <input id="futureOverpaidValue_tmp" name="futureOverpaidValue_tmp" type="text"/>
                <input id="spreadRefundValue_tmp" name="spreadRefundValue_tmp" type="text"/>
                <input id="closeToExpirationValue_tmp" name="closeToExpirationValue_tmp" type="text"/>
            </div>
            <div class="tranche-franc-calculator-form col-4">
                <label><b>Data wypłaty transzy</b></label>
                <input id="trancheDate" name="trancheDate" value="01.07.2008" data-format="dd.MM.yyyy" data-role="datepicker" data-bind="value:trancheDate" tabindex="3" required type="date" validationMessage="Uzupełnij pole"/>
            </div>
            <div class="tranche-franc-calculator-form col-4">
                <label><b>Kwota transzy w PLN</b></label>
                <input id="trancheValue" type="number" min="0" data-role="numerictextbox" data-bind="value:trancheValue" name="trancheValue" tabindex="1" required validationMessage="Uzupełnij pole" />
            </div>
            <div class="tranche-franc-calculator-form col-3" style="margin-top: 30px; text-align:center;">
                <a class="k-button k-update-button" href="\\#">
                    <span class="k-icon k-i-check"></span>&nbsp;Dodaj
                </a>
                <a class="k-button k-cancel-button" href="\\#">
                    <span class="k-icon k-i-cancel"></span>&nbsp;Anuluj
                </a>
             </div>
         </div>
     </div>

     <script>

     $('\#trancheDate, \#trancheValue').on('change', function () {

     var validator = false
        $('.tranche-franc-calculator-form').each(function () {
            var validator1 = $(this).kendoValidator().data('kendoValidator')
            validator = validator1.validate()
            if (validator == false) {
                return false
            }
        })
        if (validator) {

            var trancheDate_tmp = $('\#trancheDate').val();
            var trancheValue_tmp = $('\#trancheValue').val();

            var agreementDateTest = $('\#agreementDate').val();
            var trancheDateTest = trancheDate_tmp;

            var resone = agreementDateTest.split(".");
            var restwo = trancheDateTest.split(".");

            var date1 = new Date(resone[2], resone[1], resone[0]);
            var date2 = new Date(restwo[2], restwo[1], restwo[0]);

            var diff = new Date(date2.getTime() - date1.getTime());

            var year = diff.getUTCFullYear() - 1970;
            var month = diff.getUTCMonth();

            var month_lenght = $('\#loanPeriod').val() - ((year*12)+month);

            if (trancheValue_tmp && trancheDate_tmp) {
              $.ajax({
                url: API_URL + 'loancalc\/exchange\/' + trancheValue_tmp + '\/' + trancheDate_tmp,
                type: 'POST',
                data: {
                  'api_key': '1aa53f75-55c8-41a7-8554-25e094c71b47'
                },
                success: function (response) {

                  sendTranche(response.chfexchange, response.CHF, trancheDateTest, month_lenght);
                },
                error: function (response) {
                  console.log('Błąd obliczeń kursu')
                }
              })
            }


            function sendTranche (chfexchange, CHF, trancheDateTest, month_lenght) {

                var data = [
                        currencyCode = 'CHF',
                        plnValue = trancheValue_tmp,
                        chfValue = CHF,
                        exchangeRate = chfexchange,
                        margin = $('\#margin').val(),
                        agreementDate = trancheDateTest,
                        loanPeriod = month_lenght,
                        gracePeriod = $('\#gracePeriod').val(),
                        spread = $('\#spread').val(),
                        chfDate = $('\#chfDate').val(),
                        paymentDayOfMonth = '0'
                      ]

                for (var i = 0; i < data.length; i++) {
                    if (data[i] == '') data[i] = '0'
                  }

                  $.ajax({
                    url: API_URL + 'loancalc\/calc\/' + data[0] + '\/' + data[1] + '\/' + data[2] + '\/' + data[3] + '\/' + data[4] + '\/' + data[5] + '\/' + data[6] + '\/' + data[7] + '\/' + data[8] + '\/' + data[9] + '\/' + data[10],
                    type: 'POST',
                    data: {
                      'api_key': '1aa53f75-55c8-41a7-8554-25e094c71b47'
                    },

                    success: function (response) {

                        var actualOverpaidValue_tmp = $('.actualOverpaidValue').text();
                        var futureOverpaidValue_tmp = $('.futureOverpaidValue').text();
                        var spreadRefundValue_tmp = $('.spreadRefundValue').text();
                        var closeToExpirationValue_tmp = $('.closeToExpirationValue').text();

                        var actualOverpaidValue_new = (parseFloat(actualOverpaidValue_tmp.substring(0,actualOverpaidValue_tmp.length - 2)) + parseFloat(response.actualOverpaidValue)).toFixed(2);
                        var futureOverpaidValue_new = (parseFloat(futureOverpaidValue_tmp.substring(0,futureOverpaidValue_tmp.length - 2)) + parseFloat(response.futureOverpaidValue)).toFixed(2);
                        var spreadRefundValue_new = (parseFloat(actualOverpaidValue_new) + parseFloat(futureOverpaidValue_new)).toFixed(2);
                        var closeToExpirationValue_new = (parseFloat(closeToExpirationValue_tmp) + parseFloat(response.closeToExpirationValue)).toFixed(2);

                        $('.actualOverpaidValue').empty();
                        $('.futureOverpaidValue').empty();
                        $('.spreadRefundValue').empty();
                        $('.closeToExpirationValue').empty();
                        $('.actualOverpaidValue').append(actualOverpaidValue_new + 'zł');
                        $('.futureOverpaidValue').append(futureOverpaidValue_new + 'zł');
                        $('.spreadRefundValue').append(spreadRefundValue_new + 'zł');
                        $('.closeToExpirationValue').append(closeToExpirationValue_new + 'zł');
                    },
                    error: function (response) {
                      console.log('Błąd kalkulatora')
                    }
                  })
                }
            }

     })

    <\/script
</script>