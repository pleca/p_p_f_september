$(document).ready(function () {
  var files = [
    {path: 'download/events/prezentacja-iii-franki-20.pdf', name: 'OSTATECZNA scalona_FRANKI - PREZENTACJA III EVENT-2.0_Wrocław', type: 'pdf', id: '1'},
  ];
  $("#presentations_grid").kendoGrid({
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