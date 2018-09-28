var keys_to_moving_in_input = [8, 9, 32, 35, 36, 37, 39, 46, 109, 189];

$(document).ready(function() {

    pokaz_moje_zgloszenia ();

});

var table;
function pokaz_moje_zgloszenia () {


    //$('#sprawy').dataTable().fnClearTable();
    $('#zgloszenia').dataTable().fnDestroy();

    $('#zgloszenia tfoot th').each( function () {
        var title = $(this).text();
        $(this).html( '<input type="text" placeholder='+title+' />' );
    } );

    table = $('#zgloszenia').DataTable( {

        "ajax": "ajax/ajax_lista_zgloszen_uzytkownika",
        "dataSrc": "data",
        "autoWidth": false,
        "columns": [
            { "data": "lp",
                "width": "3%"},
            { "data": "numer_sprawy",
                "width": "10%"},
            { "data": "temat",
                "width": "26%"},
            { "data": "kategoria",
                "width": "10%"},
            { "data": "etap_sprawy",
                "width": "15%"},
            { "data": "agent",
                "width": "12%"},
            { "data": "kierownik",
                "width": "12%"},
            { "data": "dyrektor",
                "width": "12%"}

        ],
        "columnDefs": [
            { "responsivePriority": 2, "targets": 0},
            { "responsivePriority": 1, "targets": 1},
            { "responsivePriority": 2, "targets": 2},
            { "responsivePriority": 1, "targets": 3},
            { "responsivePriority": 1, "targets": 4},
            { "responsivePriority": 2, "targets": 5},
            { "responsivePriority": 2, "targets": 6},
            { "responsivePriority": 2, "targets": 7},
        ],
        "initComplete": function () {
            this.api().columns([3,4]).every( function () {
                var column = this
                var select = $('<select><option value="">Wszystkie</option></select>')
                    //var select = $('<select><label><input type="checkbox" checked value="">Wszystkie</label></select>')
                    .appendTo( $(column.footer()).empty() )
                    .on( 'change', function () {
                        var val = $.fn.dataTable.util.escapeRegex(
                            $(this).val()
                        );

                        column
                            .search( val ? '^'+val+'$' : '', true, false )
                            .draw();
                    } );

                column.data().unique().sort().each( function ( d, j ) {
                    select.append( '<option value="'+d+'">'+d+'</option>' )
                    //select.append( '<label><input type="checkbox" value="'+d+'">'+d+'</label>' )
                } );
            } );
        },
        "language": {
            "processing":     "Przetwarzanie...",
            "search":         "Szukaj:",
            "lengthMenu":     "Pokaż _MENU_ pozycji",
            "info":           "Pozycje od _START_ do _END_ z _TOTAL_ łącznie",
            "infoEmpty":      "Pozycji 0 z 0 dostępnych",
            "infoFiltered":   "(filtrowanie spośród _MAX_ dostępnych pozycji)",
            "infoPostFix":    "",
            "loadingRecords": "Wczytywanie...",
            "zeroRecords":    "Nie znaleziono pasujących pozycji",
            "emptyTable":     "Wczytywanie...",
            "paginate": {
                "first":      "Pierwsza",
                "previous":   "Poprzednia",
                "next":       "Następna",
                "last":       "Ostatnia"
            },
            "aria": {
                "sortAscending": ": aktywuj, by posortować kolumnę rosnąco",
                "sortDescending": ": aktywuj, by posortować kolumnę malejąco"
            }
        },
        "pagingType": "simple_numbers",
        "lengthMenu": [10, 25, 50, 100],
        "columnDefs": [
            {
                "searchable": false,
                "orderable": false,
                "targets": 0
            },
        ],
        "order": [[1, 'dsc']],
        "destroy": true,
        "responsive": true
    } );





    table.on('order.dt search.dt', function () {
        table.column(0, { search: 'applied', order: 'applied' }).nodes().each(function (cell, i) {
            cell.innerHTML = i + 1;
        });
    }).draw();

    $('#zgloszenia tfoot th input').attr('placeholder', '');
    $('#zgloszenia tfoot th:first input').hide();

    table.columns().every( function () {
        var that = this;

        $( 'input', this.footer() ).on( 'keyup change', function () {
            if ( that.search() !== this.value ) {
                that
                    .search( this.value )
                    .draw();
            }
        } );
    } );



}

$('#strona').on('click', '.pokaz_szczegoly_zgloszenia', function() {

    pokaz_szczegoly_zgloszenia ($(this).data('id_zgloszenia'));

});

function pokaz_szczegoly_zgloszenia (id_zgloszenia) {

    $.ajax({
        method: "POST",
        url: "ajax/ajax_szczegoly_zgloszenia",

        data: {
            id_zgloszenia: id_zgloszenia
        }
    })
        .done(function (data) {

            var array = $.parseJSON(data);

            mainPanel.wyswietlPopUp('modal-lg');

            document.getElementById("popUpTytul").innerHTML = 'SZCZEGÓŁY ZGŁOSZENIA: '+array[0];



            var tresc_boxa = document.getElementById("popUpTresc");
            tresc_boxa.innerHTML = array[1];

            informacje_o_zgloszeniu(array[2]);


        }).fail(function (ajaxContext) {

    });
}

function informacje_o_zgloszeniu (id_zgloszenia_tmp) {

    var id_zgloszenia = id_zgloszenia_tmp;

    //alert(id_zgloszenia);

    $.ajax({
        method: "POST",
        url: 'ajax/ajax_informacje_o_zgloszeniu',
        data: {
            id_zgloszenia: id_zgloszenia,

        }
    }).done(function (data) {

        var array = $.parseJSON(data);

        var tresc_tabeli = document.getElementById("popUpTresc");

        if(array[2] != null) {
            tresc_tabeli.innerHTML = document.getElementById("popUpTresc").innerHTML +array[0] + array[1];
        }

        $('.menu_zgloszen li:first').addClass('active');
        var x = $('.menu_zgloszen li:first a').attr( 'id' );

        $(x).addClass('in active');

    }).fail(function (ajaxContext) {

    });

}