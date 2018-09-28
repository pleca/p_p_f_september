var dataSource = new kendo.data.DataSource({
    transport: {
        read: {
            type: "POST",
            url: API_URL+"lead/get_unit",
            dataType: "json"
        },
        parameterMap: function (data, type) {
        if(type = "read") {
            return {
                user: user
            }
        }}
    }
});

var viewModel = kendo.observable({
    Unit: null,
    type: dataSource,
});

kendo.bind($("\#unit"), viewModel);