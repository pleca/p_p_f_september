$(document).ready(function () {
  var files = [
    {path: 'download/library/raport-najwyzsza-izba-kontroli.pdf', name: 'RAPORT - Najwyższa Izba Kontroli-P-17-111-ochrona praw konsumentów-kredyty-walutowe', type: 'pdf', id: '1'},
  ];
  $("#library_grid").kendoGrid({
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