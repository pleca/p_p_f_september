$(document).ready(function() {

    var window = $("#commissionWindow").data("kendoWindow");
    var commissionTemplate = kendo.template($("#commissionTemplate").html());

    var commission_type_structure = new kendo.data.DataSource({
        transport: {
            read: {
                type: "POST",
                url: API_URL + "Commission/GetCommissionsType",
                dataType: "json"
            }
        }
    });

    $("#commission_type_structure").kendoDropDownList({
        dataTextField: "Value",
        dataValueField: "Type",
        dataSource: commission_type_structure,
        enable: false
    });

    var commission_type_list = $("#commission_type_structure").data("kendoDropDownList");

    var date_commission_structure = $("#date_commission_structure").kendoDatePicker({
        start: "year",
        depth: "year",
        format: "MMMM yyyy",
        dateInput: true,
        value:new Date(),
        change: function() {
            commission_type_list.enable(true);
        }
    }).data("kendoDatePicker");



    $("#searchStructureCommissionButton").kendoButton({
        click: onClick
    });

    function onClick(e) {
        var date = date_commission_structure.value();
        var type = $("#commission_type_structure").data("kendoDropDownList").value();

        var commissionValue = new kendo.data.DataSource({
            transport: {
                read: {
                    type: "POST",
                    url: API_URL + "Commission/GetAllSumForStructByYearMonthAndAgentNumber/Agent/"+user+"/Month/"+kendo.toString(date, "MM")+"/Year/"+kendo.toString(date, "yyyy"),
                    dataType: "json"
                }
            }
        });


        var commissionGrid = $("#structure_commission_grid").kendoGrid({
            dataSource: commissionValue,
            height: 'auto',
            scrollable: false,
            pageable: false,
            columns: [
                { field: "Agent", title: "Numer agenta", filterable: false },
                { field: "Manager", title: "Kierownik", filterable: false },
                { field: "Value", title: "Kwota prowizji", filterable: false },
            ]
        });


        $('#structure_commission_grid').on('click', 'td', function (e) {

            var row = $(this).closest("tr");
            var colIdx = $("td", row).index(this);

            var data = { agent: user, year: kendo.toString(date, "yyyy"), type: $('#structure_commission_grid').find('th').eq(colIdx).data('field'), month: kendo.toString(date, "MM") }
            window.content(commissionTemplate(data));
            window.open();
        })
    }

});