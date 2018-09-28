function onStatusSelectEdit (e) {
  console.log(e.sender.selectedIndex);
  if ((e.sender.selectedIndex == '5') || (e.sender.selectedIndex == '6')) {

    $('#status_auxiliary_edit').removeClass('hide')
    var dataSource = new kendo.data.DataSource({
      transport: {
        read: {
          type: 'POST',
          url: API_URL + 'lead/get_status_auxiliary',
          dataType: 'json',
          data: {
            status: e.sender.selectedIndex
          }
        }
      }
    })

    var viewModel = kendo.observable({
      StatusAuxiliary: null,
      type: dataSource,
    })

    kendo.bind($('\#status_auxiliary_edit'), viewModel)
  } else if (!($('#status_auxiliary_edit').hasClass('hide'))) {
    $('#status_auxiliary_edit').addClass('hide');
    }

    if (!($('#competition').hasClass('hide')) && (e.sender.selectedIndex != '5')) {
      $('#competition').addClass('hide')
    }
}