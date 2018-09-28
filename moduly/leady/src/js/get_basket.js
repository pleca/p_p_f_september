var dataSource = new kendo.data.DataSource({
    transport: {
        read: {
            type: "POST",
            url: API_URL+"lead/get_basket",
            dataType: "json"
        }
    }
});

var viewModel = kendo.observable({
    Basket: null,
    type: dataSource,
});

kendo.bind($("\#basket"), viewModel);