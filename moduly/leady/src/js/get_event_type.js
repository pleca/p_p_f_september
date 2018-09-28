var dataSource = new kendo.data.DataSource({
    transport: {
        read: {
            type: "POST",
            url: API_URL+"lead/get_event_type",
            dataType: "json"
        }
    }
});

var viewModel = kendo.observable({
    EventType: null,
    type: dataSource,
});

kendo.bind($("\#event_type"), viewModel);