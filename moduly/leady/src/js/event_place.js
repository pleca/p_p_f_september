var province_key, district_key;

$("\#province_list").kendoDropDownList({
    dataTextField: "value",
    dataValueField: "value",
    dataSource: new kendo.data.DataSource({
        transport: {
            read: {
                type: "POST",
                url: API_URL+"address",
                dataType: "json"
            }
        }
    }),
    filter: "startswith",
    minLength: 1,
    valuePrimitive: true,
    select: function (e) {
        var dataItem = this.dataItem(e.item.index());
        province_key = dataItem.key;

        var district_list = new kendo.data.DataSource({
            transport: {
                read: {
                    type: "POST",
                    url: API_URL+"address/"+province_key,
                    dataType: "json"
                }
            }
        });

        district_input.setDataSource(district_list)
        district_input.enable(true);

    }
});

$("\#district_list").kendoAutoComplete({
    enable: false,
    dataTextField: "value",
    filter: "startswith",
    minLength: 1,
    valuePrimitive: true,
    select: function (e) {
        var dataItem = this.dataItem(e.item.index());
        district_key = dataItem.key;

        var commune_list = new kendo.data.DataSource({
            transport: {
                read: {
                    type: "POST",
                    url: API_URL+"address/"+province_key+"/"+district_key,
                    dataType: "json"
                }
            }
        });

        commune_input.setDataSource(commune_list)
        commune_input.enable(true);
    }
});

var district_input = $("\#district_list").data("kendoAutoComplete");

$("\#commune_list").kendoAutoComplete({
    enable: false,
    dataTextField: "value",
    filter: "startswith",
    minLength: 1,
    valuePrimitive: true
});

var commune_input = $("\#commune_list").data("kendoAutoComplete");