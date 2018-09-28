var PANEL_ADDRESS = 'https://pp-test.votum-sa.pl/'

function Round (n, k) {
  var factor = Math.pow(10, k)
  return Math.round(n * factor) / factor
}

function calculate (results) {
    $('.tenThousand .prepayment').empty();
    $('.tenThousand .prepayment').append(Round(results.tenThousand.prepayment,2) + ' zł');
    $('.tenThousand .remunerationAmount').empty();
    $('.tenThousand .remunerationAmount').append(Round(results.tenThousand.remunerationAmount,2) + ' zł');
    $('.tenThousand .remunerationFromReduction').empty();
    $('.tenThousand .remunerationFromReduction').append(Round(results.tenThousand.remunerationFromReduction,2) + ' zł');
    $('.tenThousand .sumRemuneration').empty();
    $('.tenThousand .sumRemuneration').append((Round(results.tenThousand.sumRemuneration,2) + ' zł').bold());
    $('.tenThousand .totalBenefitsPercentage').empty();
    $('.tenThousand .totalBenefitsPercentage').append(Round(results.tenThousand.totalBenefitsPercentage * 100, 1) + ' %');

    $('.fiveThousand .prepayment').empty();
    $('.fiveThousand .prepayment').append(Round(results.fiveThousand.prepayment,2) + ' zł' );
    $('.fiveThousand .remunerationAmount').empty();
    $('.fiveThousand .remunerationAmount').append(Round(results.fiveThousand.remunerationAmount,2) + ' zł');
    $('.fiveThousand .remunerationFromReduction').empty();
    $('.fiveThousand .remunerationFromReduction').append(Round(results.fiveThousand.remunerationFromReduction,2) + ' zł');
    $('.fiveThousand .sumRemuneration').empty();
    $('.fiveThousand .sumRemuneration').append((Round(results.fiveThousand.sumRemuneration,2) + ' zł').bold());
    $('.fiveThousand .totalBenefitsPercentage').empty();
    $('.fiveThousand .totalBenefitsPercentage').append(Round(results.fiveThousand.totalBenefitsPercentage * 100, 1) + ' %');

    $('.twoThousandFiveHundred .prepayment').empty();
    $('.twoThousandFiveHundred .prepayment').append(Round(results.twoThousandFiveHundred.prepayment,2) + ' zł');
    $('.twoThousandFiveHundred .remunerationAmount').empty();
    $('.twoThousandFiveHundred .remunerationAmount').append(Round(results.twoThousandFiveHundred.remunerationAmount,2) + ' zł');
    $('.twoThousandFiveHundred .remunerationFromReduction').empty();
    $('.twoThousandFiveHundred .remunerationFromReduction').append(Round(results.twoThousandFiveHundred.remunerationFromReduction,2) + ' zł');
    $('.twoThousandFiveHundred .sumRemuneration').empty();
    $('.twoThousandFiveHundred .sumRemuneration').append((Round(results.twoThousandFiveHundred.sumRemuneration,2) + ' zł').bold());
    $('.twoThousandFiveHundred .totalBenefitsPercentage').empty();
    $('.twoThousandFiveHundred .totalBenefitsPercentage').append(Round(results.twoThousandFiveHundred.totalBenefitsPercentage * 100, 1) + ' %');
}

function commissionDataCalculate (frankData = false) {
  var credit = '300000'
  var claim = $('#claim').val()
  var decreasedCapital = $('#decreasedCapital').val()
  if (frankData) {
    claim = frankData[0]
    decreasedCapital = frankData[1]
    $('input[name="claim"]').val(claim)
    $('input[name="decreasedCapital"]').val(decreasedCapital)
  }
  $.ajax({
    url: API_URL + 'api/commission/calc/' + credit + '/' + claim + '/' +
    decreasedCapital,
    type: 'POST',
    data: {
      'api_key': '1aa53f75-55c8-41a7-8554-25e094c71b47',
    },
    success: function (response) {
      calculate(response.results)
    },
    error: function (response) {
      $('#dodajspawe').html('Błąd przesyłu')

    },
  })
}

$(document).ready(function () {
  kendo.culture('pl-PL')
  commissionDataCalculate()
  $('#commission-calculate-generate-pdf').on('click', (function () {

      $('.commission-calculate').hide();
    kendo.drawing.drawDOM('#commission-calculator', {
      forcePageBreak: '.new-page',
      paperSize: 'A4',
      margin: '2cm',
      landscape: true,
      scale: 0.50,
    }).then(function (group) {
      kendo.drawing.pdf.saveAs(group, 'calculator.pdf')
        $('.commission-calculate').show();
    })

  }))
  $('.commission-calculate').on('click', function () {
    commissionDataCalculate()
  })

})

