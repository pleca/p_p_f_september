var PANEL_ADDRESS = 'https://pp-test.votum-sa.pl/'

kendo.culture("pl-PL");

function Round (n, k) {
  var factor = Math.pow(10, k)
  return Math.round(n * factor) / factor
}

function calculate (results) {
  $('.tenThousand .prepayment').empty()
  $('.tenThousand .prepayment').append(results.tenThousand.prepayment)
  $('.tenThousand .remunerationAmount').empty()
  $('.tenThousand .remunerationAmount').append(results.tenThousand.remunerationAmount)
  $('.tenThousand .remunerationFromReduction').empty()
  $('.tenThousand .remunerationFromReduction').append(results.tenThousand.remunerationFromReduction)
  $('.tenThousand .sumRemuneration').empty()
  $('.tenThousand .sumRemuneration').append(results.tenThousand.sumRemuneration)
  $('.tenThousand .totalBenefitsPercentage').empty()
  $('.tenThousand .totalBenefitsPercentage').append(Round(results.tenThousand.totalBenefitsPercentage * 100, 1) + ' %')

  $('.fiveThousand .prepayment').empty()
  $('.fiveThousand .prepayment').append(results.fiveThousand.prepayment)
  $('.fiveThousand .remunerationAmount').empty()
  $('.fiveThousand .remunerationAmount').append(results.fiveThousand.remunerationAmount)
  $('.fiveThousand .remunerationFromReduction').empty()
  $('.fiveThousand .remunerationFromReduction').append(results.fiveThousand.remunerationFromReduction)
  $('.fiveThousand .sumRemuneration').empty()
  $('.fiveThousand .sumRemuneration').append(results.fiveThousand.sumRemuneration)
  $('.fiveThousand .totalBenefitsPercentage').empty()
  $('.fiveThousand .totalBenefitsPercentage').append(Round(results.fiveThousand.totalBenefitsPercentage * 100, 1) + ' %')

  $('.twoThousandFiveHundred .prepayment').empty()
  $('.twoThousandFiveHundred .prepayment').append(results.twoThousandFiveHundred.prepayment)
  $('.twoThousandFiveHundred .remunerationAmount').empty()
  $('.twoThousandFiveHundred .remunerationAmount').append(results.twoThousandFiveHundred.remunerationAmount)
  $('.twoThousandFiveHundred .remunerationFromReduction').empty()
  $('.twoThousandFiveHundred .remunerationFromReduction').append(results.twoThousandFiveHundred.remunerationFromReduction)
  $('.twoThousandFiveHundred .sumRemuneration').empty()
  $('.twoThousandFiveHundred .sumRemuneration').append(results.twoThousandFiveHundred.sumRemuneration)
  $('.twoThousandFiveHundred .totalBenefitsPercentage').empty()
  $('.twoThousandFiveHundred .totalBenefitsPercentage').append(Round(results.twoThousandFiveHundred.totalBenefitsPercentage * 100, 1) + ' %')
}

function francDataCalculate () {
  var data = [
    currencyCode = 'CHF',
    plnValue = $('#plnValue').val(),
    chfValue = $('#chfValue').val(),
    exchangeRate = $('#exchangeRate').val(),
    margin = $('#margin').val(),
    agreementDate = $('#agreementDate').val(),
    loanPeriod = $('#loanPeriod').val(),
    gracePeriod = $('#gracePeriod').val(),
    spread = $('#spread').val(),
    chfDate = $('#chfDate').val(),
    paymentDayOfMonth = '0'
  ]
  for (var i = 0; i < data.length; i++) {
    if (data[i] == '') data[i] = '0'
  }
  console.log(API_URL + 'loancalc/calc/' + data[0] + '/' + data[1] + '/' + data[2] + '/' + data[3] + '/' + data[4] + '/' + data[5] + '/' + data[6] + '/' + data[7] + '/' + data[8] + '/' + data[9] + '/' + data[10])
  $.ajax({
    url: API_URL + 'loancalc/calc/' + data[0] + '/' + data[1] + '/' + data[2] + '/' + data[3] + '/' + data[4] + '/' + data[5] + '/' + data[6] + '/' + data[7] + '/' + data[8] + '/' + data[9] + '/' + data[10],
    type: 'POST',
    data: {
      'api_key': '1aa53f75-55c8-41a7-8554-25e094c71b47'
    },

    success: function (response) {
      $('.closeToExpirationInfo').empty()
      $('.closeToExpirationInfo').append('W najbliższych 30 miesiącach mogą ulec przedawnieniu nadpłacone raty w&nbsp;kwocie&nbsp;PLN&nbsp;<span id="closeToExpirationValueChange" class="closeToExpirationValue"><b></b></span>')
      $('.closeToExpirationValue').empty()
      $('.closeToExpirationValue').append(response.closeToExpirationValue.toFixed(2))
      $('.spreadRefundValue').empty()
      if($('#chfDate').val()){
        $('.spreadRefundValue').append(((response.futureOverpaidValue + response.actualOverpaidValue) - response.spreadRefundValue).toFixed(2) + 'zł')
      }else {
        $('.spreadRefundValue').append((response.futureOverpaidValue + response.actualOverpaidValue).toFixed(2) + 'zł')
      }
      $('.futureOverpaidValue').empty()
      $('.futureOverpaidValue').append(response.futureOverpaidValue.toFixed(2) + 'zł')
      $('.actualOverpaidValue').empty()
      if($('#chfDate').val()) {
        $('.actualOverpaidValue').append((response.actualOverpaidValue - response.spreadRefundValue).toFixed(2) + 'zł');
      }else{
        $('.actualOverpaidValue').append(response.actualOverpaidValue.toFixed(2) + 'zł');
      }

      $('#move-to-commission-calc-btn').removeClass('hide')

      $('#addBtn').removeAttr("disabled");
    },
    error: function (response) {
      console.log('Błąd kalkulatora')
    }
  })
}

function agreementDate () {
  var agreementDate = $('#agreementDate')
  agreementDate.data('kendoNumericTextBox').value('01.06.2008')
  agreementDate.data('kendoNumericTextBox').trigger('change')
}

$(document).ready(function () {
  kendo.culture('pl-PL')
  $('button #commission-calculate-generate-pdf').click(function () {
    kendo.drawing.drawDOM('#table-commission', {
      forcePageBreak: '.new-page',
      paperSize: 'A4',
      margin: '0cm'
    }).then(function (group) {
      kendo.drawing.pdf.saveAs(group, 'contract.pdf')
    })
  })

  $('#agreementDate').kendoDatePicker()

  $('#chfDate').kendoDatePicker()
  $('#plnValue').kendoNumericTextBox({
    culture: 'en-US',
    decimals: 2,
    step: 1,
    format: '#'
  })
  $('#chfValue').kendoNumericTextBox({
    culture: 'en-US',
    decimals: 2,
    step: 1,
    format: '#'
  })
  $('#exchangeRate').kendoNumericTextBox({
    culture: 'en-US'
  })
  $('#loanPeriod').kendoNumericTextBox({
    culture: 'en-US',
    decimals: 2,
    step: 1,
    format: '#'
  })
  $('#gracePeriod').kendoNumericTextBox({
    culture: 'en-US',
    decimals: 2,
    step: 1,
    format: '#'
  })
  $('#spread').kendoNumericTextBox({
    culture: 'en-US'
  })
  $('#margin').kendoNumericTextBox({
    culture: 'en-US'
  })
  $('#paymentDayOfMonth').kendoNumericTextBox({
    culture: 'en-US',
    decimals: 2,
    step: 1,
    format: '#'
  })
  $('#username').kendoNumericTextBox()
  $('#location').kendoNumericTextBox()

  $('#agreementDate').val('01.06.2008')

  $('#plnValue, #agreementDate').on('change', function () {
    if (($('#plnValue').val()) && ($('#agreementDate').val())) {
      $.ajax({
        url: API_URL + 'loancalc/exchange/' + $('#plnValue').val() + '/' + $('#agreementDate').val(),
        type: 'POST',
        data: {
          'api_key': '1aa53f75-55c8-41a7-8554-25e094c71b47'
        },
        success: function (response) {
          // $('#exchangeRate').val(response.chfexchange);
          var rate = $('#exchangeRate')
          rate.data('kendoNumericTextBox').value(response.chfexchange)
          rate.data('kendoNumericTextBox').trigger('change')
          var chf = $('#chfValue')
          chf.data('kendoNumericTextBox').value(response.CHF)
          chf.data('kendoNumericTextBox').trigger('change')
        },
        error: function (response) {
          console.log('Błąd obliczeń kursu')
        }
      })
    }
  })
  $('.calculateValue').click(function () {
    var validator = false
    $('.franc-calculator-form').each(function () {
      var validator1 = $(this).kendoValidator().data('kendoValidator')
      validator = validator1.validate()
      if (validator == false) {
        return false
      }
    })
    if (validator) {
      francDataCalculate()
    }
  })

    $('#frank-calculate-generate-pdf').on('click', (function () {


        $('.calculate').hide();
        $('.commission-calculate').hide();
        $('.calculateTranche').hide();
        $('.refreshCalculate').hide();

        kendo.drawing.drawDOM("#franc-calculator", {}).then(function (group) {
            kendo.drawing.pdf.saveAs(group, "calculator.pdf");
            $('.calculate').show();
            $('.commission-calculate').show();
            $('.calculateTranche').show();
            $('.refreshCalculate').show();

        });

    }));

  $('#move-to-commission-calc').click(function () {
    var cl = $('.actualOverpaidValue').text()
    var claim = cl.slice(0, -2)
    var dc = $('.futureOverpaidValue').text()
    var decreasedCapital = dc.slice(0, -2)
    var frankData = [claim, decreasedCapital]
    // setCookie('claim', claim);
    // setCookie('decreasedCapital', decreasedCapital);
    $('#v-pills-franc-calculator').removeClass('active')
    $('#v-pills-franc-calculator').removeClass('show')
    $('#v-pills-franc-calculator-tab').removeClass('active')
    $('#v-pills-franc-calculator-tab').attr('aria-selected', 'false')
    $('#v-pills-commission-calculator').addClass('active')
    $('#v-pills-commission-calculator').addClass('show')
    $('#v-pills-commission-calculator-tab').addClass('active')
    $('#v-pills-commission-calculator-tab').attr('aria-selected', 'true')
    commissionDataCalculate(frankData)
  })


    $("#listView").kendoListView({
        template: kendo.template($("#template").html()),
        editTemplate: kendo.template($("#editTemplate").html()),
        dataSource: {
            schema: {
                model: {
                    id: "ID",
                    fields: {
                        trancheDate: { type: 'date', format: 'dd.MM.yyyy' },
                        trancheValue: { type: "number" },
                        trancheOverpaidValue: { type: "number" }
                    }
                }
            }
        }
    });
    $("#addBtn").click(function(){

        var listView = $("#listView").data("kendoListView");
        listView.add();
        var defaultDate = kendo.toString(kendo.parseDate("01.07.2008"), 'dd.MM.yyyy');
        $("#trancheDate").data("kendoDatePicker").value(defaultDate);

    });

    $("#refreshCalc").click(function(){
        window.location.reload(true);
    });

})

