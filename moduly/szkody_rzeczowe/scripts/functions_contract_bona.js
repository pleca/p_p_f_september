$(document).ready(function () {

  kendo.culture("pl-PL");

    var tabStrip = $('#tabstrip_bona').kendoTabStrip().data('kendoTabStrip')

    $('#tabstrip_bona').on('click', '.nextTab1 ', function () {
        var validator = false
        $('.inputValidate-1').each(function () {
            var validator1 = $(this).kendoValidator().data('kendoValidator')
           validator = validator1.validate()
            if (validator == false) return false
        })
        if (validator) {
            tabStrip.select(1)
        }
    })
    $('#tabstrip_bona').on('click', '.nextTab2', function () {
        var validator = false
        $('.inputValidate-2').each(function () {
            var validator1 = $(this).kendoValidator().data('kendoValidator')
            validator = validator1.validate()
            if (validator == false) return false
        })
        if (validator) {
            tabStrip.select(2)
        }
    })
    $('#tabstrip_bona').on('click', '.nextTab3', function () {
        tabStrip.select(3)
    })
    $('#tabstrip_bona').on('click', '.nextTab4', function () {
        tabStrip.select(4)
    })
    $('#tabstrip_bona').on('click', '.nextTab5', function () {
        var validator = false
        $('.inputValidate-5').each(function () {
            var validator1 = $(this).kendoValidator().data('kendoValidator')
            validator = validator1.validate()
            if (validator == false) return false
        })
        if (validator) {
            tabStrip.select(5)
        }
    })


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
    $("#InsurerI").kendoDropDownList({
        dataTextField: "name",
        dataValueField: "id",
        dataSource: insurer,
        optionLabel: 'Wybierz',
        filter: "contains",
        valuePrimitive: true
    });
    $("#InsurerII").kendoDropDownList({
        dataTextField: "name",
        dataValueField: "id",
        dataSource: insurer,
        optionLabel: 'Wybierz',
        filter: "contains",
        valuePrimitive: true
    });
    $("#InsurerIII").kendoDropDownList({
        dataTextField: "name",
        dataValueField: "id",
        dataSource: insurer,
        optionLabel: 'Wybierz',
        filter: "contains",
        valuePrimitive: true
    });

  $('#IncidentDate').kendoDateTimePicker({
      format: "yyyy-MM-dd HH:mm:ss"
  })
  $('#NotificationDate').kendoDatePicker({
      format: "yyyy-MM-dd"
  })
  $('#OtherAgentContractDate').kendoDatePicker({
      format: "yyyy-MM-dd"
  })
  $('#TerminateDate').kendoDatePicker({
      format: "yyyy-MM-dd"
  })

    $("#tabstrip_bona").kendoTabStrip({
        animation:  {
            open: {
                effects: "fadeIn"
            }
        }
    });

    $("#panelbar_bona").kendoPanelBar({
        expandMode: "single"
    });

    $('#clear-data').on('click', function(){
        $('#contract_bona').find('input').val('');
    });

    $('#copy-first-address').on('click', function(){
        $('#StreetII').val($('#StreetI').val());
        $('#HomeNumberII').val($('#HomeNumberI').val());
        $('#PostCodeII').val($('#PostCodeI').val());
        $('#CityII').val($('#CityI').val());
    });
    $('#copy-second-address').on('click', function(){
        $('#StreetII').val($('#Street').val());
        $('#HomeNumberII').val($('#HomeNumber').val());
        $('#PostCodeII').val($('#PostCode').val());
        $('#CityII').val($('#City').val());
    });


    $('#ConsumerFirst').on('click', function(){

        var radioButtons = document.getElementsByName('Consumer')
        for (var x = 0; x < radioButtons.length; x++) {
            if (radioButtons[x].checked) {
                $('#CustomerFirstName').val($('#FirstNameI').val());
                $('#CustomerLastName').val($('#LastNameI').val());
                $('#CustomerStreet').val($('#StreetI').val());
                $('#CustomerHomeNumber').val($('#HomeNumberI').val());
                $('#CustomerPostCode').val($('#PostCodeI').val());
                $('#CustomerCity').val($('#CityI').val());
            }
        }
    });

    $('#ConsumerSecond').on('click', function(){
        var radioButtons = document.getElementsByName('Consumer')

        for (var x = 0; x < radioButtons.length; x++) {
            if (radioButtons[x].checked) {
                $('#CustomerFirstName').val($('#FirstNameII').val());
                $('#CustomerLastName').val($('#LastNameII').val());
                $('#CustomerStreet').val($('#StreetII').val());
                $('#CustomerHomeNumber').val($('#HomeNumberII').val());
                $('#CustomerPostCode').val($('#PostCodeII').val());
                $('#CustomerCity').val($('#CityII').val());
            }
        }
    });

    $('#PaymentTransfer').on('click', function(){
        var radioButtons = document.getElementsByName('PaymentForm')

        for (var x = 0; x < radioButtons.length; x++) {
            if (radioButtons[x].checked) {
                $('#AccountNumber').attr("required", true);
                $('#AccountNumber').attr("disabled", false);
            }
        }
    });

    $('#PaymentPostOfficeTransfer').on('click', function(){
        var radioButtons = document.getElementsByName('PaymentForm')

        for (var x = 0; x < radioButtons.length; x++) {
            if (radioButtons[x].checked) {
                $('#AccountNumber').attr("required", false);
                $('#AccountNumber').val("");
                $('#AccountNumber').attr("disabled", true);
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


    $("[name='Consumer']").click(function(){
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

    $('#AssignmentYes').on('click', function(){
        $('#AssignmentValue').removeAttr("disabled");
    });
    $('#AssignmentNo').on('click', function(){
        $('#AssignmentValue').val("");
        $('#AssignmentValue').attr("disabled", true);
    });

    $('#NotificationYes').on('click', function(){
        $("#NotificationDate").data("kendoDatePicker").enable(true);
    });
    $('#NotificationNo').on('click', function(){
        $('#NotificationDate').val("");
        $("#NotificationDate").data("kendoDatePicker").enable(false);
    });

    $('#Terminate').on('click', function(){
        if (($("#Terminate").is(':checked'))) {
            $("#TerminateDate").data("kendoDatePicker").enable(true);
        } else {
            $('#TerminateDate').val("");
            $("#TerminateDate").data("kendoDatePicker").enable(false);
        }
    });

    $('#OtherAgentYes').on('click', function(){
        $("#OtherAgentContractDate").data("kendoDatePicker").enable(true);
        $('#OtherAgentName').removeAttr("disabled");
    });
    $('#OtherAgentNo').on('click', function(){
        $('#OtherAgentName').val("");
        $('#OtherAgentName').attr("disabled", true);
        $('#OtherAgentContractDate').val("");
        $("#OtherAgentContractDate").data("kendoDatePicker").enable(false);
    });

    $('#PaidOutYes').on('click', function(){
        $('#AnountPaidOut').removeAttr("disabled");
        $('#DamageNumber').removeAttr("disabled");
    });
    $('#PaidOutNo').on('click', function(){
        $('#AnountPaidOut').val("");
        $('#AnountPaidOut').attr("disabled", true);
        $('#DamageNumber').attr("disabled", true);
    });

    $(".answer").children().change(function(){
        $(this).parent().parent().children(":first").children(":first").addClass('k-i-edit');
        $(this).parent().parent().children(":first").children(":first").addClass('k-i-check');
        mainPanel.odswierzSesje();
    });

    $('#UnitCode').kendoComboBox({
        dataTextField: 'commission_name',
        dataValueField: 'commission_id',
        dataSource: {
            type: 'json',
            transport: {
                read: {
                    url: API_URL + 'agent/getunit',
                }
            }
        },
        filter: 'contains',
        suggest: true,
        index: 3
    })
    $('#ConsultantCode').kendoComboBox({
        dataTextField: 'commission_name',
        dataValueField: 'commission_id',
        dataSource: {
            type: 'json',
            transport: {
                read: {
                    url: API_URL + 'agent/getconsultantnumber',
                }
            }
        },
        filter: 'contains',
        suggest: true,
        index: 3
    })


    $('.saveContract').on('click', function(){

        var validator = false
        $('.inputValidate-1').each(function () {
            var validator1 = $(this).kendoValidator().data('kendoValidator')
            validator = validator1.validate()
            if (validator == false) {
                tabStrip.select(0)
                return false
            }
        })

        $('.inputValidate-2').each(function () {
            var validator1 = $(this).kendoValidator().data('kendoValidator')
            validator = validator1.validate()
            if (validator == false) {
                tabStrip.select(1)
                return false
            }
        })

        $('.inputValidate-5').each(function () {
            var validator1 = $(this).kendoValidator().data('kendoValidator')
            validator = validator1.validate()
            if (validator == false) {
                tabStrip.select(4)
                return false
            }
        })
        $('.inputValidate-6').each(function () {
            var validator1 = $(this).kendoValidator().data('kendoValidator')
            validator = validator1.validate()
            if (validator == false) {
                tabStrip.select(5)
                return false
            }
        })
        if (validator) {


            $.ajax({
                url: API_URL + "bona/setcontract",
                type: 'POST',
                dataType: "json",
                data: {
                    'AgentNumber': user,
                    'FirstNameI': document.getElementsByName('FirstNameI')[0].value,
                    'LastNameI': document.getElementsByName('LastNameI')[0].value,
                    'PESELI': document.getElementsByName('PESELI')[0].value,
                    'IdentityCardI': document.getElementsByName('IdentityCardI')[0].value,
                    'PhoneI': document.getElementsByName('PhoneI')[0].value,
                    'EmailI': document.getElementsByName('EmailI')[0].value,
                    'NIPI': document.getElementsByName('NIPI')[0].value,
                    'REGONI': document.getElementsByName('REGONI')[0].value,
                    'KRSI': document.getElementsByName('KRSI')[0].value,
                    'StreetI': document.getElementsByName('StreetI')[0].value,
                    'HomeNumberI': document.getElementsByName('HomeNumberI')[0].value,
                    'PostCodeI': document.getElementsByName('PostCodeI')[0].value,
                    'CityI': document.getElementsByName('CityI')[0].value,

                    'Street': document.getElementsByName('Street')[0].value,
                    'HomeNumber': document.getElementsByName('HomeNumber')[0].value,
                    'PostCode': document.getElementsByName('PostCode')[0].value,
                    'City': document.getElementsByName('City')[0].value,

                    'VAT': getCheckedCheckbox('VAT'),
                    'Company': getCheckedCheckbox('Company'),

                    'FirstNameII': document.getElementsByName('FirstNameII')[0].value,
                    'LastNameII': document.getElementsByName('LastNameII')[0].value,
                    'PESELII': document.getElementsByName('PESELII')[0].value,
                    'IdentityCardII': document.getElementsByName('IdentityCardII')[0].value,
                    'PhoneII': document.getElementsByName('PhoneII')[0].value,
                    'EmailII': document.getElementsByName('EmailII')[0].value,
                    'StreetII': document.getElementsByName('StreetII')[0].value,
                    'HomeNumberII': document.getElementsByName('HomeNumberII')[0].value,
                    'PostCodeII': document.getElementsByName('PostCodeII')[0].value,
                    'CityII': document.getElementsByName('CityII')[0].value,

                    'PhoneFirstName': document.getElementsByName('PhoneFirstName')[0].value,
                    'PhoneLastName': document.getElementsByName('PhoneLastName')[0].value,
                    'PhonePESEL': document.getElementsByName('PhonePESEL')[0].value,

                    'IncidentDate': document.getElementsByName('IncidentDate')[0].value,
                    'Reason': document.getElementsByName('Reason')[0].value,
                    'Discription': document.getElementsByName('Discription')[0].value,

                    'InsurerI': document.getElementsByName('InsurerI')[0].value,
                    'PolicyNameI': document.getElementsByName('PolicyNameI')[0].value,
                    'PolicyNumberI': document.getElementsByName('PolicyNumberI')[0].value,
                    'InsurerII': document.getElementsByName('InsurerII')[0].value,
                    'PolicyNameII': document.getElementsByName('PolicyNameII')[0].value,
                    'PolicyNumberII': document.getElementsByName('PolicyNumberII')[0].value,
                    'InsurerIII': document.getElementsByName('InsurerIII')[0].value,
                    'PolicyNameIII': document.getElementsByName('PolicyNameIII')[0].value,
                    'PolicyNumberIII': document.getElementsByName('PolicyNumberIII')[0].value,

                    'Notification': getCheckedRadio('Notification'),
                    'NotificationDate': document.getElementsByName('NotificationDate')[0].value,
                    'PaidOut': getCheckedRadio('PaidOut'),
                    'AnountPaidOut': document.getElementsByName('AnountPaidOut')[0].value,
                    'DamageNumber': document.getElementsByName('DamageNumber')[0].value,

                    'Assignment': getCheckedRadio('Assignment'),
                    'AssignmentValue': document.getElementsByName('AssignmentValue')[0].value,

                    'OtherAgent': getCheckedRadio('OtherAgent'),
                    'OtherAgentName': document.getElementsByName('OtherAgentName')[0].value,
                    'OtherAgentContractDate': document.getElementsByName('OtherAgentContractDate')[0].value,

                    'Terminate': getCheckedCheckbox('Terminate'),
                    'TerminateDate': document.getElementsByName('TerminateDate')[0].value,
                    'PageValue': document.getElementsByName('PageValue')[0].value,

                    'ConsentSMS': getCheckedCheckbox('ConsentSMS'),
                    'ConsentEmail': getCheckedCheckbox('ConsentEmail'),

                    'dataConsentDSA': getCheckedCheckbox('dataConsentDSA'),
                    'dataConsentPCRF': getCheckedCheckbox('dataConsentPCRF'),
                    'dataConsentVOTUM': getCheckedCheckbox('dataConsentVOTUM'),
                    'dataConsentAUTOVOTUM': getCheckedCheckbox('dataConsentAUTOVOTUM'),
                    'dataConsentBEP': getCheckedCheckbox('dataConsentBEP'),
                    'marketingConsentDSA1': getCheckedCheckbox('marketingConsentDSA1'),
                    'marketingConsentDSA2': getCheckedCheckbox('marketingConsentDSA2'),
                    'marketingConsentVOTUM1': getCheckedCheckbox('marketingConsentVOTUM1'),
                    'marketingConsentVOTUM2': getCheckedCheckbox('marketingConsentVOTUM2'),

                    'PaymentForm': getCheckedRadio('PaymentForm'),

                    'AccountNumber': document.getElementsByName('AccountNumber')[0].value,
                    'CustomerFirstName': document.getElementsByName('CustomerFirstName')[0].value,
                    'CustomerLastName': document.getElementsByName('CustomerLastName')[0].value,
                    'CustomerStreet': document.getElementsByName('CustomerStreet')[0].value,
                    'CustomerHomeNumber': document.getElementsByName('CustomerHomeNumber')[0].value,
                    'CustomerPostCode': document.getElementsByName('CustomerPostCode')[0].value,
                    'CustomerCity': document.getElementsByName('CustomerCity')[0].value,

                    'Answer1': document.getElementsByName('Answer1')[0].value,
                    'Answer2': document.getElementsByName('Answer2')[0].value,
                    'Answer3': document.getElementsByName('Answer3')[0].value,
                    'Answer4': document.getElementsByName('Answer4')[0].value,
                    'Answer5': document.getElementsByName('Answer5')[0].value,
                    'Answer6': document.getElementsByName('Answer6')[0].value,
                    'Answer7': document.getElementsByName('Answer7')[0].value,
                    'Answer8': document.getElementsByName('Answer8')[0].value,
                    'Answer9': document.getElementsByName('Answer9')[0].value,

                    'Commission': document.getElementsByName('Commission')[0].value,
                    'UnitCode': document.getElementsByName('UnitCode')[0].value,
                    'ConsultantCode': document.getElementsByName('ConsultantCode')[0].value
                }
            }).success(function (result) {

            });
        }
    });

})

