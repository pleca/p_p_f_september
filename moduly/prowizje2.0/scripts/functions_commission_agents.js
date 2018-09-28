$(document).ready(function() {

    var window = $("#commissionWindow").data("kendoWindow");
    var commissionTemplate = kendo.template($("#commissionTemplate").html());

    $("#commission_type_agent").kendoDropDownList({
        dataTextField: "Value",
        dataValueField: "Type",
        dataSource: [],
        enable: false
    });

    var commission_type_list = $("#commission_type_agent").data("kendoDropDownList");

    var date_commission_agent = $("#date_commission_agent").kendoDatePicker({
        start: "year",
        depth: "year",
        format: "MMMM yyyy",
        dateInput: true,
        value:new Date(),
        change: function() {

            var commission_type_agent = new kendo.data.DataSource({
                transport: {
                    read: {
                        type: "POST",
                        url: API_URL + "Commission/GetCommissionsTypeForAgentNumberAndYear/Agent/A011068/Year/"+kendo.toString(date_commission_agent.value(), "yyyy"),
                        // url: API_URL + "Commission/GetCommissionsTypeForAgentNumberAndYear/Agent/"+user+"/Year/"+kendo.toString(date_commission_agent.value(), "yyyy"),
                        dataType: "json"
                    }
                }
            });
            commission_type_list.setDataSource(commission_type_agent);
            commission_type_list.enable(true);
        }
    }).data("kendoDatePicker");



    $("#searchAgentCommissionButton").kendoButton({
        click: onClick
    });

    function onClick(e) {

        var date = date_commission_agent.value();

        var commissionType = function () {

            var tmp = $.ajax({
                url: API_URL + "Commission/GetCommissionsTypeForAgentNumberAndYear/Agent/"+user+"/Year/"+kendo.toString(date, "yyyy"),
                dataType: "json",
                async: false,
                success: function(data) {
                }
            }).responseText ;
            return  tmp;
        }();

        var commissionValue = new kendo.data.DataSource({
            transport: {
                read: {
                    type: "POST",
                    url: API_URL + "Commission/GetSumForAgentNumberMonthAndYear/Agent/"+user+"/Month/"+kendo.toString(date, "MM")+"/Year/"+kendo.toString(date, "yyyy"),
                    dataType: "json"
                }
            }
        });


        var commissionGrid = $("#agent_commission_grid").kendoGrid({
            dataSource: commissionValue,
            height: 'auto',
            scrollable: false,
            pageable: false,
            columns: JSON.parse(commissionType)
        });


        $('#agent_commission_grid').on('click', 'td', function (e) {

            var row = $(this).closest("tr");
            var colIdx = $("td", row).index(this); //selektor: zaznacz <td> w row

            var data = { agent: user, year: kendo.toString(date, "yyyy"), type: $('#agent_commission_grid').find('th').eq(colIdx).data('field'), month: kendo.toString(date, "MM") }
            window.content(commissionTemplate(data));
            window.open();
        })
    }

});