
function onStatusAuxiliarySelect(e) {
  console.log(e.sender.selectedIndex);
  if ((e.sender.selectedIndex == '1')&&(e.sender.listView.dataSource._data[0].Name == "Konkurencja")) {
    $('#competition').removeClass('hide');
    var dataSource = new kendo.data.DataSource({
      transport: {
        read: {
          type: "POST",
          url: API_URL + "lead/get_competition",
          dataType: "json"
        }
      }
    });

    var viewModel = kendo.observable({
      StatusAuxiliary: null,
      type: dataSource,
    });

    kendo.bind($("\#competition"), viewModel);
  }else if(!($('#competition').hasClass('hide'))){
    $('#competition').addClass('hide');
  }
}