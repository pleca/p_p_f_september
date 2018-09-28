$(document).ready(function () {

  var window = $("#contractWindow").data("kendoWindow");
  var printWindow = $("#printContractWindow").data("kendoWindow");

    kendo.pdf.defineFont({
        "Museo_100"    : "https://cdn.votum-sa.pl/fonts/Museo_300.php",
        "Museo_300"    : "https://cdn.votum-sa.pl/fonts/Museo_300.php",
        "Museo_500"    : "https://cdn.votum-sa.pl/fonts/Museo_500.php",
        "Museo_700"    : "https://cdn.votum-sa.pl/fonts/Museo_700.php",
        "Museo_900"    : "https://cdn.votum-sa.pl/fonts/Museo_900.php"
    });

        dataSource = new kendo.data.DataSource({
            transport: {
                read:  {
                    url: API_URL+"bona/getcontractlist/"+user,
                    dataType: "json",
                    type: "POST"
                },
                parameterMap: function (options, operation) {
                    if (operation !== "read" && options.models) {
                        return {
                            models: kendo.stringify(options.models),
                            api_key: '1aa53f75-55c8-41a7-8554-25e094c71b47',
                            user: user
                        };
                    }
                    if(operation == "read") {
                        return {
                            user: user
                        };
                    }
                }
            },
            batch: true,
            pageSize: 10,
            schema: {
                id: "ContractID",
                model: {
                    fields: {
                        ContractID: { editable: false, type: "number" },
                        ContractNumber: { type: "string"},
                        ContractName: { type: "string"},
                        ClientName: { type: "string"},
                        AddDate: { type: "date" },
                        SentToCentral: { type: "string" }
                    }
                }
            }
        });

    $("#grid_contract_list").kendoGrid({
        dataSource: dataSource,
        pageable: true,
        sortable: true,
        columns: [
            { field: "ContractNumber", title: "Numer umowy" },
            { field: "ContractName", title:"Rodzaj umowy"},
            { field: "ClientName", title:"Klient"},
            { field: "AddDate", title:"Data dodania", template: '#= kendo.toString(kendo.parseDate(AddDate), "yyyy-MM-dd HH:mm")#'},
            { field: "SentToCentral", title:"Status wysyłki"},
            { command: [
                    {
                        text: "Edytuj",
                        name: "edit",
                        iconClass: "k-icon k-i-edit",
                        className: "btn-edit",
                        click: editContract
                    },
                    {
                        text: "Wydruk",
                        name: "print",
                        iconClass: "k-icon k-i-preview",
                        className: "btn-print",
                        click: printContract
                    }
                ], title: "&nbsp;", width: '150px'}],
        editable: false,
        detailTemplate: kendo.template($("#detailTemplate").html()),

    });

    var editTemplate = kendo.template($("#editContractTemplate").html());
    var contractBonaTemplate = kendo.template($("#printBonaContractTemplate").html());

    function editContract(e) {

        e.preventDefault();

        var dataItem = this.dataItem($(e.currentTarget).closest("tr"));


        $.ajax({
            type: "POST",
            url: API_URL+"bona/bonacontractget/"+dataItem.ContractID,
            dataType: "json",
            success: function(data) {
                window.content(editTemplate(data));
            }
        });

        window.open();

    }

    function printContract(e) {

        e.preventDefault();

        var dataItem = this.dataItem($(e.currentTarget).closest("tr"));

        $.ajax({
            type: "POST",
            url: API_URL+"bona/bonacontractget/"+dataItem.ContractID,
            dataType: "json",
            success: function(data) {
                console.log(data.FirstNameI);
                printWindow.content(contractBonaTemplate(data));
            }
        });

        printWindow.open();

        printWindow.element.prev().find(".k-window-title").html("Umowa Bona nr "+dataItem.ContractID);




        //$('.k-grid-print').on("click", function () {

            //$('.printLead').find(".pageHeader").html("<b>Szczegóły leada nr "+dataItem.ID+"</b>");
            //$('.descriptionText').hide();
            //$('.descriptionTextPrint').show();

        /*kendo.drawing.drawDOM("#printContractWindow", {
            forcePageBreak: ".new-page",
            paperSize: "A4",
            margin: "2cm",
            scale: 0.50
        }).then(function (group) {
            kendo.drawing.pdf.saveAs(group, "Bona.pdf");
        });*/
        //});
    }


})
function customBoolEditor(container, options) {
    var guid = kendo.guid();
    $('<input class="k-checkbox" id="' + guid + '" type="checkbox" name="Discontinued" data-type="boolean" data-bind="checked:Discontinued">').appendTo(container);
    $('<label class="k-checkbox-label" for="' + guid + '">&#8203;</label>').appendTo(container);
}

