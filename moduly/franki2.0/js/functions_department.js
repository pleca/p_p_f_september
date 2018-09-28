$(document).ready(function () {
  var files = [
    {path: 'download/department/koordynatorzy.pdf', name: 'Koordynatorzy w DSB', type: 'pdf', id: '1'},
    {path: 'download/department/zespoly.pdf', name: 'Zespoły w DSB', type: 'pdf', id: '2'}
  ];
  $("#department_grid").kendoGrid({
    dataSource: files,
    sortable: {
      mode: "single",
      allowUnsort: false
    },
    pageable: true,
    columns: [
      { field: "name", title: "Nazwa", width:"50%" },
      { field: "id", title: "Pobierz", template: '<a href="#=path#" class="home_grid_link" download><span class="k-icon k-i-download"></span></a>', width: "15%"}
    ],
    editable: "false",
    save: function () {
      this.dataSource.read();
    }
  });
});
