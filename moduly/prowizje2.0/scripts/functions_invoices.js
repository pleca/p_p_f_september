$(document).ready(function() {

    var settingsWindow = $("#invoiceSettingsWindow").data("kendoWindow");
    var invoiceWindow = $("#invoiceWindow").data("kendoWindow");
    var invoiceSettingsTemplate = kendo.template($("#invoiceSettingsTemplate").html());

    var date_invoices = $("#date_invoices").kendoDatePicker({
        start: "year",
        depth: "year",
        format: "MMMM yyyy",
        dateInput: true,
        value:new Date(),
    }).data("kendoDatePicker");

    $("#createInvoicesButton").kendoButton({
        click: onClickCreateInvoice
    });

    $("#settingsInvoicesButton").kendoButton({
        click: onClickSettingsInvoice
    });

    function onClickSettingsInvoice(e) {

        settingsWindow.content(invoiceSettingsTemplate('TEST'));
        settingsWindow.open();

    }

    function onClickCreateInvoice(e) {

        $.ajax({
            url: API_URL + "Commission",
            type: 'POST',
            dataType: "json",
            data: {
                'AgentNumber': user,
                'InvoiceNumber': document.getElementsByName('InvoiceNumber')[0].value,
            }
        }).success(function (result) {
            invoiceWindow.content('TEST Faktury');
            invoiceWindow.open();
        });
    }

});