$(document).ready(function () {
  var files = [
    {video_id: 'panel-generowanie-umowy-votum-sa', name: 'Panel generowanie umowy_ VOTUM S.A - Mozilla Firefox 05.09.2018 19_58_36', type: 'mp4', id: '1'},
    {video_id: 'panel-kalkulator-ofertowy-votum-sa', name: 'Panel kalkulator ofertowy_ VOTUM S.A - Mozilla Firefox 05.09.2018 19_30_24', type: 'mp4', id: '2'},
    {video_id: 'panel-kalkulator-roszczen-votum-sa', name: 'Panel Kalkulator roszczen _ VOTUM S.A - Mozilla Firefox 05.09.2018 19_04_07', type: 'mp4', id: '3'},
  ];
  $("#videos_grid").kendoGrid({
    dataSource: files,
    sortable: {
      mode: "single",
      allowUnsort: false
    },
    pageable: true,
    columns: [
      { field: "name", title: "Nazwa", width:"50%" },
      { field: "id", title: "Pobierz", template: '<a href="src/getFile/getFile-#=video_id#.php" class="home_grid_link" download><span class="k-icon k-i-download"></span></a>', width: "15%"}
    ],
    editable: "false",
    save: function () {
      this.dataSource.read();
    }
  });
});