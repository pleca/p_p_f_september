var keys_to_moving_in_input = [8, 9, 32, 35, 36, 37, 39, 46, 109, 189];


$(document).ready(function() {

    pobierz_date();
    zmien_rok();
    obsluga_menu();
    $('#typy_prowizji').hide();

    js_pobierz_typy_prowizji_agenta (wybrany_rok());
    js_pobierz_sume_prowizji_agenta ('0');
    pokaz_podzial_prowizji();
    pokaz_szczegoly_prowizji();

} );

function obsluga_menu() {

    $('#strona').on('click','#wszystkie',function(){
        $('#typy_prowizji').hide();
        $('#szczegoly_prowizji_wrapper').hide();
        js_pobierz_sume_prowizji_agenta ('0');
    });
    $('#strona').on('click','#podstawowe',function(){
        $('#typy_prowizji').hide();
        $('#szczegoly_prowizji_wrapper').hide();
        js_pobierz_sume_prowizji_agenta ('1');
    });
    $('#strona').on('click','#ofe',function(){
        $('#typy_prowizji').hide();
        $('#szczegoly_prowizji_wrapper').hide();
        js_pobierz_sume_prowizji_agenta ('2');
    });
    $('#strona').on('click','#cesje_wierzytelnosci',function(){
        $('#typy_prowizji').hide();
        $('#szczegoly_prowizji_wrapper').hide();
        js_pobierz_sume_prowizji_agenta ('3');
    });
    $('#strona').on('click','#wss_cesje',function(){
        $('#typy_prowizji').hide();
        $('#szczegoly_prowizji_wrapper').hide();
        js_pobierz_sume_prowizji_agenta ('5');
    });
    $('#strona').on('click','#wss_osobowe',function(){
        $('#typy_prowizji').hide();
        $('#szczegoly_prowizji_wrapper').hide();
        js_pobierz_sume_prowizji_agenta ('6');
    });
    $('#strona').on('click','#wnm_cesje',function(){
        $('#typy_prowizji').hide();
        $('#szczegoly_prowizji_wrapper').hide();
        js_pobierz_sume_prowizji_agenta ('7');
    });
    $('#strona').on('click','#wnm_osobowe',function(){
        $('#typy_prowizji').hide();
        $('#szczegoly_prowizji_wrapper').hide();
        js_pobierz_sume_prowizji_agenta ('8');
    });
    $('#strona').on('click','#auta_zastepcze',function(){
        $('#typy_prowizji').hide();
        $('#szczegoly_prowizji_wrapper').hide();
        js_pobierz_sume_prowizji_agenta ('9');
    });
    $('#strona').on('click','#ssv',function(){
        $('#typy_prowizji').hide();
        $('#szczegoly_prowizji_wrapper').hide();
        js_pobierz_sume_prowizji_agenta ('10');
    });
}



function pobierz_date() {
    var d = new Date();
    var n = d.getFullYear();
    var miesiac = d.getMonth();
    var rok = parseFloat(n);

    if (miesiac == 0) {
        rok = rok - 1;
        document.getElementById("rok").innerHTML = rok;
    } else {
        document.getElementById("rok").innerHTML = rok;
    }

    return rok;
}

function wybrany_rok() {

        var rok_wybrany = document.getElementById('rok').innerHTML;
        var rok = parseFloat(rok_wybrany);

        return rok;
}

function zmien_rok() {

    $(".rok_poprzedni").click(function(){
        var rok_obecny = document.getElementById('rok').innerHTML;
        var rok = parseFloat(rok_obecny);
        var rok_poprzedni = rok - 1;

        if(rok_poprzedni < 2013) {

        } else {

            $('#typy_prowizji').hide();
            $('#szczegoly_prowizji_wrapper').hide();
            document.getElementById("rok").innerHTML = rok_poprzedni;
            js_pobierz_typy_prowizji_agenta (wybrany_rok());
            js_pobierz_sume_prowizji_agenta ('0');
        }
    });

    $(".rok_kolejny").click(function(){
        var rok_obecny = document.getElementById('rok').innerHTML;
        var rok = parseFloat(rok_obecny);
        var rok_kolejny = rok + 1;

        var aktualny_rok = pobierz_date();

        if(rok_kolejny > aktualny_rok) {

        } else {

            $('#typy_prowizji').hide();
            $('#szczegoly_prowizji_wrapper').hide();
            document.getElementById("rok").innerHTML = rok_kolejny;
            js_pobierz_typy_prowizji_agenta (wybrany_rok());
            js_pobierz_sume_prowizji_agenta ('0');
        }

    });

}


function js_pobierz_typy_prowizji_agenta(rok) {


        $.ajax({
            method: "POST",
            url: "../ajax/ajax_pobierz_typy_prowizji_agenta",
            data: {
                rok: rok
            }
        })
            .done(function (data) {


                $('.prowizjau_1').hide();
                $('.prowizjau_1').removeClass('aktywne');
                $('.prowizjau_2').hide();
                $('.prowizjau_2').removeClass('aktywne');
                $('.prowizjau_3').hide();
                $('.prowizjau_3').removeClass('aktywne');
                $('.prowizjau_4').hide();
                $('.prowizjau_4').removeClass('aktywne');
                $('.prowizjau_5').hide();
                $('.prowizjau_5').removeClass('aktywne');
                $('.prowizjau_6').hide();
                $('.prowizjau_6').removeClass('aktywne');
                $('.prowizjau_7').hide();
                $('.prowizjau_7').removeClass('aktywne');
                $('.prowizjau_8').hide();
                $('.prowizjau_8').removeClass('aktywne');
                $('.prowizjau_9').hide();
                $('.prowizjau_9').removeClass('aktywne');
                $('.prowizjau_10').hide();
                $('.prowizjau_10').removeClass('aktywne');

                var array = $.parseJSON(data);
                var tablica = [];

                for(var i=0; i<=10; i++) {
                    var tmp = JSON.stringify(array[i]);
                    if(tmp != undefined) {
                        tablica.push(eval('(' + tmp + ')'));
                    }
                }

                var ile_prowizji = tablica.length;

                for(var j=0; j<ile_prowizji; j++) {

                    $('.prowizjau_'+tablica[j].typ).show();
                    $('.prowizjau_'+tablica[j].typ).addClass('aktywne');

                }

            }).fail(function (ajaxContext) {
                alert(ajaxContext.responseText);
        });

}

function js_pobierz_sume_prowizji_agenta (typ_prowizji) {

    $('#suma_prowizji_uzytkownika').show();

    var rok = wybrany_rok()

    $.fn.dataTable.ext.errMode = 'none';

    var suma = $('#suma_prowizji_uzytkownika').DataTable( {

        data: dane_do_tabeli_pobierz_sume_prowizji_agenta(rok, typ_prowizji),
        columns: [
            { "title": 'Styczen' },
            { "title": 'Luty' },
            { "title": 'Marzec' },
            { "title": 'Kwiecień' },
            { "title": 'Maj' },
            { "title": 'Czerwiec' },
            { "title": 'Lipiec' },
            { "title": 'Sierpień' },
            { "title": 'Wrzesień' },
            { "title": 'Październik' },
            { "title": 'Listopad' },
            { "title": 'Grudzień' }
        ],
        columnDefs: [
            { responsivePriority: 1, targets: dane_do_tabeli_pobierz_sume_prowizji_agenta_ostatni_miesiac (rok)-1},
            { responsivePriority: 1, targets: dane_do_tabeli_pobierz_sume_prowizji_agenta_ostatni_miesiac (rok)-2},
            { responsivePriority: 2, targets: dane_do_tabeli_pobierz_sume_prowizji_agenta_ostatni_miesiac (rok)-3}
        ],
        language: {
            "processing":     "Przetwarzanie...",
            "search":         "Szukaj:",
            "lengthMenu":     "Pokaż _MENU_ pozycji",
            "info":           "Pozycje od _START_ do _END_ z _TOTAL_ łącznie",
            "infoEmpty":      "Pozycji 0 z 0 dostępnych",
            "infoFiltered":   "(filtrowanie spośród _MAX_ dostępnych pozycji)",
            "infoPostFix":    "",
            "loadingRecords": "Wczytywanie...",
            "zeroRecords":    "Nie znaleziono pasujących pozycji",
            "emptyTable":     "Brak danych",
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
        destroy : true,
        pageLength: 25,
        processing: true,
        paging: false,
        info: false,
        searching: false,
        responsive: false,
        scrollX: true
    });
}

function dane_do_tabeli_pobierz_sume_prowizji_agenta_ostatni_miesiac (rok) {

    var zmienna = '';

    $.ajax({
        method: "POST",
        url: "../ajax/ajax_pobierz_ostatni_miesiac",
        data: {
            rok: rok
        },
        dataType: "json",
        async : false,
        success: function(data){
            zmienna = data;
        }
    });
    return zmienna;
}

function dane_do_tabeli_pobierz_sume_prowizji_agenta (rok, typ_prowizji) {

    var zmienna = '';

    $.ajax({
        method: "POST",
        url: "../ajax/ajax_pobierz_sume_prowizji_agenta",
        data: {
            rok: rok,
            typ_prowizji: typ_prowizji
        },
        dataType: "json",
        async : false,
        success: function(data){
            zmienna = data;
        }
    });
    return zmienna;
}

function pokaz_podzial_prowizji() {
    $('#strona').on('click','.suma_prowizji',function(){

        $('#szczegoly_prowizji_wrapper').hide();

        var nr_miesiaca = $(this).data('nr_miesiaca');
        var typ_prowizji = $(this).data('typ_prowizji');

        if (typ_prowizji != '0' || typ_prowizji != undefined) {
            $('#typy_prowizji').hide();
        }

        js_pobierz_podzial_prowizji_agenta(nr_miesiaca);
    });
}

function pokaz_szczegoly_prowizji() {
    $('#strona').on('click','.szczegoly_prowizji',function(){

        var nr_miesiaca = $(this).data('nr_miesiaca');
        var typ_prowizji = $(this).data('typ_prowizji');


        js_pobierz_szczegoly_prowizji_agenta(nr_miesiaca, wybrany_rok(), typ_prowizji);
    });
}


function js_pobierz_podzial_prowizji_agenta(miesiac) {

    var rok = wybrany_rok();

    $('#typy_prowizji').hide();

    var typy = $('#typy_prowizji').DataTable( {

        data: dane_do_tabeli_pobierz_podzial_prowizji_agenta(rok, miesiac),
        columns: [
            { "className": "body-center"},
            { "className": "body-center"},
            { "className": "body-center"},
            { "className": "body-center"},
            { "className": "body-center"},
            { "className": "body-center"},
            { "className": "body-center"},
            { "className": "body-center"},
            { "className": "body-center"},
            { "className": "body-center"}
        ],
        language: {
            "processing":     "Przetwarzanie...",
            "search":         "Szukaj:",
            "lengthMenu":     "Pokaż _MENU_ pozycji",
            "info":           "Pozycje od _START_ do _END_ z _TOTAL_ łącznie",
            "infoEmpty":      "Pozycji 0 z 0 dostępnych",
            "infoFiltered":   "(filtrowanie spośród _MAX_ dostępnych pozycji)",
            "infoPostFix":    "",
            "loadingRecords": "Wczytywanie...",
            "zeroRecords":    "Nie znaleziono pasujących pozycji",
            "emptyTable":     "Brak danych",
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
        destroy : true,
        pageLength: 25,
        processing: true,
        paging: false,
        info: false,
        searching: false,
        responsive: true
    });

    var kolumny = kolumny_do_tabeli_pobierz_podzial_prowizji_agenta_naglowki_tabeli (rok);

    typy.columns( [ 0,1,2,3,4,5,6,7,8,9] ).visible( false );
    typy.columns( kolumny ).visible( true );
    typy.columns.adjust().draw( false ); // adjust column sizing and redraw

    $('#typy_prowizji').show();
}
function dane_do_tabeli_pobierz_podzial_prowizji_agenta (rok, miesiac) {

    var zmienna_1 = '';

    $.ajax({
        method: "POST",
        url: "../ajax/ajax_pobierz_podzial_prowizji_agenta",
        data: {
            rok: rok,
            miesiac: miesiac
        },
        dataType: "json",
        async : false,
        success: function(data){
            zmienna_1 = data;
        }
    });
    return zmienna_1;
}
function kolumny_do_tabeli_pobierz_podzial_prowizji_agenta_naglowki_tabeli (rok) {

    var zmienna = '';

    $.ajax({
        method: "POST",
        url: "../ajax/ajax_pobierz_typy_prowizji_agenta",
        data: {
            rok: rok
        },
        dataType: "json",
        async: false,
        success: function (data) {

            var tablica = [];
            var tablica_tmp = [];

            for(var i=0; i<=9; i++) {
                var tmp = JSON.stringify(data[i]);

                if(tmp != undefined) {
                    tablica.push(eval('(' + tmp + ')'));
                    var kolumny = tablica[i].typ - 1;
                    tablica_tmp.push(kolumny);
                }
            }

            zmienna = tablica_tmp;

        }
    });
    return zmienna;
}


function js_pobierz_szczegoly_prowizji_agenta(miesiac, rok, typ_prowizji) {


    $('#szczegoly_prowizji').show();

    var szczegoly = $('#szczegoly_prowizji').DataTable({

        dom: 'Bfrtip',
        buttons: [
            'csv', 'excel',
            {
                extend: 'pdfHtml5',
                orientation: 'landscape',
                pageSize: 'legal',
                header:true,
                customize: function ( doc ) {

                    doc.content.splice( 0, 0, {
                        margin: [ 0, 0, 0, 12 ],
                        alignment: 'right',
                        image: 'data:image/png;base64,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',

                    } );
                },
                exportOptions: {
                    columns: [1,4,6,8,9,10,11,12,13,14,15,16,17],
                    modifier: {
                        page: 'current'
                    }
                },
            }
        ],
        data: dane_do_tabeli_pobierz_szczegoly_prowizji_agenta(miesiac, rok, typ_prowizji),

        columns: [
            { title: "Krótki numer sprawy"},
            { title: "Numer sprawy" },
            { title: "Kod jednostki" },
            { title: "Nr agenta" },
            { title: "Agent" },
            { title: "Nr kierownika" },
            { title: "Kierownik" },
            { title: "Nr dyrektora" },
            { title: "Dyrektor" },
            { title: "Nazwisko klienta" },
            { title: "Imie klienta" },
            { title: "Kwota odszkodowania" },
            { title: "Data wpływu" },
            { title: "Honorarium netto" },
            { title: "Prowizja (przed potrąceniem)" },
            { title: "Prowizja (po potrąceniu)" },
            { title: "Numer odszkodowania" },
            { title: "Nazwa prowizji" }
        ],
        language: {
            "processing":     "Przetwarzanie...",
            "search":         "Szukaj:",
            "lengthMenu":     "Pokaż _MENU_ pozycji",
            "info":           "Pozycje od _START_ do _END_ z _TOTAL_ łącznie",
            "infoEmpty":      "Pozycji 0 z 0 dostępnych",
            "infoFiltered":   "(filtrowanie spośród _MAX_ dostępnych pozycji)",
            "infoPostFix":    "",
            "loadingRecords": "Wczytywanie...",
            "zeroRecords":    "Nie znaleziono pasujących pozycji",
            "emptyTable":     "Brak danych",
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
        columnDefs: [
            { responsivePriority: 3, targets: 0},
            { responsivePriority: 1, targets: 1},
            { responsivePriority: 3, targets: 2},
            { responsivePriority: 2, targets: 3},
            { responsivePriority: 4, targets: 4},
            { responsivePriority: 2, targets: 5},
            { responsivePriority: 4, targets: 6},
            { responsivePriority: 2, targets: 7},
            { responsivePriority: 4, targets: 8},
            { responsivePriority: 2, targets: 9},
            { responsivePriority: 4, targets: 10},
            { responsivePriority: 2, targets: 11},
            { responsivePriority: 2, targets: 12},
            { responsivePriority: 1, targets: 13},
            { responsivePriority: 2, targets: 14},
            { responsivePriority: 1, targets: 15},
            { responsivePriority: 2, targets: 16},
            { responsivePriority: 2, targets: 17}
        ],
        destroy : true,
        pageLength: 25,
        processing: true,
        paging: true,
        info: true,
        searching: true,
        responsive: true
    });

}

function dane_do_tabeli_pobierz_szczegoly_prowizji_agenta(miesiac, rok, typ_prowizji) {

    var zmienna = '';

    $.ajax({
        method: "POST",
        url: "../ajax/ajax_szczegoly_prowizji_agenta",
        data: {
            miesiac: miesiac,
            typ_prowizji: typ_prowizji,
            rok: rok
        },
        dataType: "json",
        async : false,
        success: function(data){

            if(data.error){
            } else {
                zmienna = data;

            }
        }
    });

    return zmienna;

}
