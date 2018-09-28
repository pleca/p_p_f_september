$(document).ready(function () {

    var contractFrankTemplate = kendo.template($("#tmpPrint").html());
    var printWindowFrank = $("#printContractFrankWindow").data("kendoWindow");

  var creditTypeData = [
    {credit_name: 'Kredyt konsolidacyjny', credit_id: '1'},
    {credit_name: 'Kredyt hipoteczny', credit_id: '2'}
  ]
  var contractBankData = [
    {bank_name: 'Bank BPH SA', bank_id: '1'},
    {bank_name: 'Bank Gospodarstwa Krajowego', bank_id: '2'},
    {bank_name: 'Bank Handlowy w Warszawie', bank_id: '3'},
    {bank_name: 'Bank Millennium SA', bank_id: '4'},
    {bank_name: 'Bank Zachodni WBK', bank_id: '5'},
    {bank_name: 'BOŚ Bank SA', bank_id: '6'},
    // {bank_name: "Deutsche Bank Polska S.A.", bank_id: '7'},
    {bank_name: 'DNB Bank Polska S.A.', bank_id: '8'},
    {bank_name: 'Euro Bank S.A.', bank_id: '9'},
    {bank_name: 'Getin Noble Bank SA', bank_id: '10'},
    {bank_name: 'mBank SA', bank_id: '12'},
    {bank_name: 'PKO BP SA', bank_id: '13'},
    {bank_name: 'Raiffeisen Bank Polska S.A.', bank_id: '14'},
    {bank_name: 'Santander Consumer Bank SA', bank_id: '15'}
  ]

  var mandateBankData = [
    {bank_name: 'GE Money Bank', bank_id: '1'},
    {bank_name: 'Bank Gospodarstwa Krajowego', bank_id: '2'},
    {bank_name: 'Bank Handlowy w Warszawie', bank_id: '3'},
    {bank_name: 'Bank Millennium SA', bank_id: '4'},
    {bank_name: 'Kredyt Bank S.A.', bank_id: '5'},
    {bank_name: 'BOŚ Bank SA', bank_id: '6'},
    // {bank_name: "Deutsche Bank PBC SA", bank_id: '7'},
    {bank_name: 'DNB Bank Polska S.A.', bank_id: '8'},
    {bank_name: 'Euro Bank S.A.', bank_id: '9'},
    {bank_name: 'Getin Noble Bank SA', bank_id: '10'},
    {bank_name: 'BRE Bank S.A. Oddział bankowości detalicznej (zwany Multibankiem)', bank_id: '12'},
    {bank_name: 'Nordea Bank Polska SA', bank_id: '13'},
    {bank_name: 'EFG Eurobank Ergasias S.A., Polbank S.A. ', bank_id: '14'},
    {bank_name: 'Santander Consumer Bank S.A.', bank_id: '15'},
  ]

  var contract_id = 0
  var window

  kendo.pdf.defineFont({
    'DejaVu Sans': 'https://kendo.cdn.telerik.com/2016.2.607/styles/fonts/DejaVu/DejaVuSans.ttf',
    'DejaVu Sans|Bold': 'https://kendo.cdn.telerik.com/2016.2.607/styles/fonts/DejaVu/DejaVuSans-Bold.ttf',
    'DejaVu Sans|Bold|Italic': 'https://kendo.cdn.telerik.com/2016.2.607/styles/fonts/DejaVu/DejaVuSans-Oblique.ttf',
    'DejaVu Sans|Italic': 'https://kendo.cdn.telerik.com/2016.2.607/styles/fonts/DejaVu/DejaVuSans-Oblique.ttf',
    'WebComponentsIcons': 'https://kendo.cdn.telerik.com/2017.1.223/styles/fonts/glyphs/WebComponentsIcons.ttf'
  })

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
    else return '0'
  }

  $('#OtherAgentDate').kendoDatePicker({})
  $('#CheckBox1Date').kendoDatePicker({})
  $('#CheckBox2Date').kendoDatePicker({})
  $('#CheckBox3Date').kendoDatePicker({})
  $('#BankContractDate').kendoDatePicker({})


  $('#BankName').kendoComboBox({
    dataTextField: 'bank_name',
    dataValueField: 'bank_id',
    dataSource: contractBankData,
    filter: 'contains',
    suggest: true,
    index: 1
  })
  $('#MandateBankName').kendoComboBox({
    dataTextField: 'bank_name',
    dataValueField: 'bank_id',
    dataSource: mandateBankData,
    filter: 'contains',
    suggest: true,
    index: 1
  })
  $('#CreditType').kendoComboBox({
    dataTextField: 'credit_name',
    dataValueField: 'credit_id',
    dataSource: creditTypeData,
    filter: 'contains',
    suggest: true,
    index: 1
  })

  $('#clear-data').on('click', function () {
    $('#contract').find('input').val('')
  })
  $("#address-of-correspondence-checkbox").change(function() {
    if(!this.checked) {
      $('.address-of-correspondence-div li input').prop('disabled', true)
      $('.address-of-correspondence-div li input').val('');
    }else{
      $('.address-of-correspondence-div input').prop('disabled', false)
    }
  });
  $('#copy-address').on('click', function () {
    $('#StreetII').val($('#StreetI').val())
    $('#HomeNumberII').val($('#HomeNumberI').val())
    $('#ApartmentNumberII').val($('#ApartmentNumberI').val())
    $('#PostCodeII').val($('#PostCodeI').val())
    $('#CityII').val($('#CityI').val())
  })
  $('#Button3a').on('click', function () {
    $('.other-agent').removeClass('hide')
  })

  $('#Button3b').on('click', function () {
    $('.other-agent').addClass('hide')
  })
  $('#CustomerA').on('click', function () {
    $('#CustomerFirstName').val($('#FirstNameI').val())
    $('#CustomerLastName').val($('#LastNameI').val())
    $('#CustomerStreet').val($('#StreetI').val())
    $('#CustomerHomeNumber').val($('#HomeNumberI').val())
    $('#CustomerApartmentNumber').val($('#ApartmentNumberI').val())
    $('#CustomerPostCode').val($('#PostCodeI').val())
    $('#CustomerCity').val($('#CityI').val())
  })
  $('#CustomerB').on('click', function () {
    $('#CustomerFirstName').val($('#FirstNameII').val())
    $('#CustomerLastName').val($('#LastNameII').val())
    $('#CustomerStreet').val($('#StreetII').val())
    $('#CustomerHomeNumber').val($('#HomeNumberII').val())
    $('#CustomerApartmentNumber').val($('#ApartmentNumberII').val())
    $('#CustomerPostCode').val($('#PostCodeII').val())
    $('#CustomerCity').val($('#CityII').val())
  })

  $('#FirstNameII').on('change', function () {
    if ($('#FirstNameII').val()) {
      this.setAttribute('required', true)
      this.setAttribute('validationMessage', 'To pole jest wymagane.')
      this.parentNode.className = 'contract-1'
      $('#LastNameII').attr('required', 'true')
      $('#LastNameII').attr('validationMessage', 'To pole jest wymagane.')
      $('#LastNameII').parent().addClass('contract-1')
      $('#PESELII').attr('required', 'true')
      $('#PESELII').attr('validationMessage', 'To pole jest wymagane.')
      $('#PESELII').parent().addClass('contract-1')
      $('#IdentityCardII').attr('required', 'true')
      $('#IdentityCardII').attr('validationMessage', 'To pole jest wymagane.')
      $('#IdentityCardII').parent().addClass('contract-1')
    }
  })

  var tabStrip = $('#contract').kendoTabStrip().data('kendoTabStrip')
  $('#contract').on('click', '.nextTab1 ', function () {
    var validator = false
    $('.contract-1').each(function () {
      var validator1 = $(this).kendoValidator({
        messages: {
          identitycard: "Nieprawidłowy format numeru dowodu osobistego",
          pesel: "Nieprawidłowy format numeru PESEL",
          required: "To pole jest wymagane",
        },
        rules: {
          identitycard: function(input) {
            if (input.is("[name=IdentityCardI]")||input.is("[name=IdentityCardII]")) {
              var numer = input.val();
              if (numer === '') { return true }
              return mainPanel.sprawdzNumerDowodu(numer)
            }
            return true
          },
          pesel: function(input) {
            if (input.is("[name=PESELI]")||input.is("[name=PESELII]")) {
              var pesel = input.val();
              if (pesel === '') { return true }
              return mainPanel.sprawdzPesel(pesel)
            }
            return true
          }
        }
      }).data("kendoValidator")
      validator = validator1.validate()
      if (validator == false) return false
    })
    if (validator) {
      tabStrip.select(1)
    }
  })
  $('#contract').on('click', '.nextTab2', function () {
    var validator = false
    $('.contract-2').each(function () {
      var validator1 = $(this).kendoValidator().data('kendoValidator')
      validator = validator1.validate()
      if (validator == false) return false
    })
    if (validator) {
      tabStrip.select(2)
    }
  })
  $('#contract').on('click', '.nextTab3', function () {
    var validator = false;
    $('.contract-3').each(function(){
      var validator1 = $(this).kendoValidator().data("kendoValidator");
      validator = validator1.validate();
      if (validator == false) return false;
    });
    if(validator){
    tabStrip.select(3)
     }
  })
  $('#contract').on('click', '.nextTab4', function () {
    // var validator = false;
    // $('.contract-4').each(function(){
    //   var validator1 = $(this).kendoValidator().data("kendoValidator");
    //   validator = validator1.validate();
    //   if (validator == false) return false;
    // });
    // if(validator){
      tabStrip.select(4)
    //}
  })
  $('#contract').on('click', '.nextTab5', function () {
    var validator = false;
    $('.contract-5').each(function(){
      var validator1 = $(this).kendoValidator().data("kendoValidator");
      validator = validator1.validate();
      if (validator == false) return false;
    });
    if(validator){
      tabStrip.select(5)
    }
  })

  $('#update').on('click', function () {
    var validator = false
    $('.contract-6').each(function () {
      var validator1 = $(this).kendoValidator().data('kendoValidator')
      validator = validator1.validate()
      if (validator == false) {
        tabStrip.select(0)
        return false
      }
    })

    $('.contract-2').each(function () {
      var validator1 = $(this).kendoValidator().data('kendoValidator')
      validator = validator1.validate()
      if (validator == false) {
        tabStrip.select(1)
        return false
      }
    })
    $('.contract-3').each(function () {
      var validator1 = $(this).kendoValidator().data('kendoValidator')
      validator = validator1.validate()
      if (validator == false) {
        return false
      }
    })
    $('.contract-5').each(function () {
      var validator1 = $(this).kendoValidator().data('kendoValidator')
      validator = validator1.validate()
      if (validator == false) {
        return false
      }
    })
    $('.contract-6').each(function () {
      var validator1 = $(this).kendoValidator().data('kendoValidator')
      validator = validator1.validate()
      if (validator == false) {
        return false
      }
    })
    if (validator) {
      $.ajax({
        url: API_URL + 'frank/setcontract',
        type: 'POST',
        dataType: 'json',
        data: {
          'AgentNumber': user,
          'ContractID': $('#contract').data('contract_id'),
          'FirstNameI': document.getElementsByName('FirstNameI')[0].value,
          'LastNameI': document.getElementsByName('LastNameI')[0].value,
          'StreetI': document.getElementsByName('StreetI')[0].value,
          'HomeNumberI': document.getElementsByName('HomeNumberI')[0].value,
          'ApartmentNumberI': document.getElementsByName('ApartmentNumberI')[0].value,
          'PostCodeI': document.getElementsByName('PostCodeI')[0].value,
          'CityI': document.getElementsByName('CityI')[0].value,
          'PESELI': document.getElementsByName('PESELI')[0].value,
          'IdentityCardI': document.getElementsByName('IdentityCardI')[0].value,
          'PhoneI': document.getElementsByName('PhoneI')[0].value,
          'EmailI': document.getElementsByName('EmailI')[0].value,

          'FirstNameII': document.getElementsByName('FirstNameII')[0].value,
          'LastNameII': document.getElementsByName('LastNameII')[0].value,
          'StreetII': document.getElementsByName('StreetII')[0].value,
          'HomeNumberII': document.getElementsByName('HomeNumberII')[0].value,
          'ApartmentNumberII': document.getElementsByName('ApartmentNumberII')[0].value,
          'PostCodeII': document.getElementsByName('PostCodeII')[0].value,
          'CityII': document.getElementsByName('CityII')[0].value,
          'PESELII': document.getElementsByName('PESELII')[0].value,
          'IdentityCardII': document.getElementsByName('IdentityCardII')[0].value,
          'PhoneII': document.getElementsByName('PhoneII')[0].value,
          'EmailII': document.getElementsByName('EmailII')[0].value,
          'Street': document.getElementsByName('Street')[0].value,
          'HomeNumber': document.getElementsByName('HomeNumber')[0].value,
          'ApartmentNumber': document.getElementsByName('ApartmentNumber')[0].value,
          'PostCode': document.getElementsByName('PostCode')[0].value,
          'City': document.getElementsByName('City')[0].value,

          'BankName': document.getElementsByName('BankName')[0].value,

          'ContractNumber': document.getElementsByName('ContractNumber')[0].value,
          'RadioButton1': getCheckedRadio('RadioButton1'),
          'RadioButton2': getCheckedRadio('RadioButton2'),
          'RadioButton3': getCheckedRadio('RadioButton3'),
          'OtherAgentName': document.getElementsByName('OtherAgentName')[0].value,
          'OtherAgentDate': document.getElementsByName('OtherAgentDate')[0].value,
          'CheckBox1': getCheckedCheckbox('CheckBox1'),
          'CheckBox2': getCheckedCheckbox('CheckBox2'),
          'CheckBox3': getCheckedCheckbox('CheckBox3'),
          'CheckBox1Date': document.getElementsByName('CheckBox1Date')[0].value,
          'CheckBox2Date': document.getElementsByName('CheckBox2Date')[0].value,
          'CheckBox3Date': document.getElementsByName('CheckBox3Date')[0].value,

          'CreditType': document.getElementsByName('CreditType')[0].value,
          'MandateBankName': document.getElementsByName('MandateBankName')[0].value,

          'dataConsentDSA': getCheckedCheckbox('dataConsentDSA'),
          'dataConsentPCRF': getCheckedCheckbox('dataConsentPCRF'),
          'dataConsentVOTUM': getCheckedCheckbox('dataConsentVOTUM'),
          'dataConsentAUTOVOTUM': getCheckedCheckbox('dataConsentAUTOVOTUM'),
          'dataConsentBEP': getCheckedCheckbox('dataConsentBEP'),
          'marketingConsentDSA1': getCheckedCheckbox('marketingConsentDSA1'),
          'marketingConsentDSA2': getCheckedCheckbox('marketingConsentDSA2'),
          'marketingConsentVOTUM1': getCheckedCheckbox('marketingConsentVOTUM1'),
          'marketingConsentVOTUM2': getCheckedCheckbox('marketingConsentVOTUM2'),

          'BankContractDate': document.getElementsByName('BankContractDate')[0].value,
          'Unit': document.getElementsByName('Unit')[0].value,
          'UnitNumber': $("#unit").data("kendoDropDownList").text() == 'Brak' ? ' ' : $("#unit").data("kendoDropDownList").text(),

          'Consultant': document.getElementsByName('Consultant')[0].value,
          'ConsultantNumber': $("#consultant").data("kendoDropDownList").text() == 'Brak' ? ' ' : $("#consultant").data("kendoDropDownList").text(),

          'RadioCustomer': getCheckedRadio('RadioCustomer'),
          'AccountNumber': document.getElementsByName('AccountNumber')[0].value,
          'CustomerFirstName': document.getElementsByName('CustomerFirstName')[0].value,
          'CustomerLastName': document.getElementsByName('CustomerLastName')[0].value,
          'CustomerStreet': document.getElementsByName('CustomerStreet')[0].value,
          'CustomerHomeNumber': document.getElementsByName('CustomerHomeNumber')[0].value,
          'CustomerApartmentNumber': document.getElementsByName('CustomerApartmentNumber')[0].value,
          'CustomerPostCode': document.getElementsByName('CustomerPostCode')[0].value,
          'CustomerCity': document.getElementsByName('CustomerCity')[0].value,
          'ContractType': document.getElementsByName('ContractType')[0].value,
        }
      }).success(function (result) {

        //alert(result.ContractID)

        //$('#contract').data('contract_id')
        //$('#contract').attr('data-contract_id', result.ContractID)

        //contract_id = result.ContractID;
        $('#update').attr('disabled', 'disabled')
        $('.save-contract').append('<a role="button" id="print" class="k-button k-button-icontext k-primary export-pdf updateContract" href="#">Pokaż druk umowy</a>')

        $('#print').kendoButton({

          click: function (e) {


              $.ajax({
                  url: API_URL + 'frank/bankcontractget/' + result.ContractID,
                  type: 'GET',
                  dataType: 'json',
                  success: function(data) {
                    console.log(data);
                      printWindowFrank.content(contractFrankTemplate(data));
                  }
              });
              printWindowFrank.open();

              printWindowFrank.element.prev().find(".k-window-title").html("Umowa Frankowa nr "+result.ContractID);
          }
        })
      })
    }
  })

    //var editTemplate = kendo.template($("#tmpPrint").html());

  function generatePDF (selector) {

    kendo.drawing.drawDOM(selector, {
      forcePageBreak: '.new-page',
      paperSize: 'A4',
      margin: '0cm',
      scale: 0.5
    }).then(function (group) {
      //kendo.drawing.pdf.saveAs({
      kendo.saveAs({
        dataURI: group,
        fileName: 'contract.pdf',
        proxyURL: "https://demos.telerik.com/kendo-ui/service/export",
        forceProxy: true
      });
    })

  }

  $('#contract-type').kendoComboBox({
    dataTextField: 'commission_name',
    dataValueField: 'commission_id',
    dataSource: {
      type: 'json',
      serverFiltering: true,
      transport: {
        read: {
          url: API_URL + 'frank/getcontractcommission',
        }
      }
    },
    filter: 'contains',
    suggest: true,
    index: 3
  })

  $('#unit').kendoDropDownList({
    filter: "contains",
    dataTextField: 'unitNumber',
    dataValueField: 'unitID',
    dataSource: {
      transport: {
        read: {
          url: API_URL + 'frank/getunit',
        }
      }
    },
  })
  var unitDropdownlist =$('#unit').data("kendoDropDownList")
  unitDropdownlist.value(0);
  $('#consultant').kendoDropDownList({
    filter: "contains",
    dataTextField: 'consultantNumber',
    dataValueField: 'consultantID',
    dataSource: {
      transport: {
        read: {
          url: API_URL + 'frank/getconsultantnumber',
        }
      }
    },
  })
  var consultantDropdownlist =$('#consultant').data("kendoDropDownList")
  consultantDropdownlist.value(0);

  /*
    var window = $("#dialog").kendoWindow({
      width: "34%",
      minWidth: 100,
      title: "Umowa",
      visible: false,
      position: {
        top: 100,
        left: "33%"
      },
      content: {
        url: API_URL+"frank/bankcontractget/10",
        type: 'POST',
        dataType: "json",
        iframe: false,
        template: $("#page-template").html()
      }
    });*/

  function openWindow (contract_id) {

    window = $('#dialog').kendoWindow({
      width: '34%',
      minWidth: 100,
      title: 'Umowa',
      actions: [
        'refresh',
        'Close'
      ],
      visible: false,
      position: {
        top: 100,
        left: '33%'
      },
      content: {
        dataType: 'json',
        iframe: false,
        template: $('#page-template').html()
      }
    })
    var windowObject = window.data('kendoWindow')
    windowObject.refresh({
      url: API_URL + 'frank/bankcontractget/' + contract_id,
      template: $('#page-template').html()
    })
    windowObject.open().center()
  }

})

