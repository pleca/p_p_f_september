$(document).ready(function () {

    kendo.culture("pl-PL");

    /*$('#commission_agent').kendoTabStrip({
        animation: {
            open: {
                effects: 'fadeIn',
            },
        },
    })
    $('#commission_structure').kendoTabStrip({
        animation: {
            open: {
                effects: 'fadeIn',
            },
        },
    })
    $('#invoices').kendoTabStrip({
        animation: {
            open: {
                effects: 'fadeIn',
            },
        },
    })*/

    $("#commissionWindow").kendoWindow({
        title: "Szczegóły prowizji",
        width: "80%",
        modal: true,
        minWidth: 100,
        visible: false,
        position: {
            top: 100,
            left: "10%"
        }
    }).data("kendoWindow");

    $("#invoiceSettingsWindow").kendoWindow({
        title: "Ustawienia faktury",
        width: "20%",
        modal: true,
        minWidth: 100,
        visible: false,
        position: {
            top: 100,
            left: "40%"
        }
    }).data("kendoWindow");

    $("#invoiceWindow").kendoWindow({
        title: "Podglad faktury",
        width: "80%",
        modal: true,
        minWidth: 100,
        visible: false,
        position: {
            top: 100,
            left: "10%"
        }
    }).data("kendoWindow");
})
