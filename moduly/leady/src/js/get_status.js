var dataSource = new kendo.data.DataSource({
    transport: {
        read: {
            type: "POST",
            url: API_URL+"lead/get_status",
            dataType: "json"
        }
    }
});

var viewModel = kendo.observable({
    Status: null,
    type: dataSource,
});

kendo.bind($("\#status"), viewModel);

