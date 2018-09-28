var keys_to_moving_in_input = [8, 9, 32, 35, 36, 37, 39, 46, 109, 189];

$(document).ready(function() {



  var etap_archiwum = $('.opcja_archiwum').data('etap_archiwum');

  if (etap_archiwum == undefined) {
    etap_archiwum = '1';
  }
  //sprawdz_archiwum();
  pokaz_moje_sprawy (etap_archiwum);
  //sprawdz_archiwum();



});
var addConversation = function(data){
  var conversationsJson = JSON.stringify(data);
  $.ajax({
    type: "POST",
    url: API_URL + 'conversation/addconversation',
    data: {conversation: conversationsJson},
    success: function(result) {
      window.console.log(result);
      $('.loading').remove();
      $('#conversationTitle').val('');
      $('#conversationMsg').val('');
      $('#form2Success').append('<span class="form2Success">Wysłano.</span>');
      setTimeout(function () {
        $('#form2Success').empty();
      }, 1500);
    }
  });
};
function sprawdz_archiwum() {

  $('.opcja_archiwum').on('change', function () {
    if (this.checked) {
      //alert ('zaznaczone');
      table
        .column( 6 )
        .search( "[^Archiwum]", true )
        .draw();
      //$('.opcja_archiwum').attr('data-etap_archiwum', '1');
      //pokaz_moje_sprawy('1');
    }
    else {
      //alert ('niezaznaczone');
      table
        .column( 6 )
        .search( "", true )
        .draw();
      //$('.opcja_archiwum').attr('data-etap_archiwum', '0');
      //pokaz_moje_sprawy('0');
    }
  });
}


var table;
function pokaz_moje_sprawy (etap_archiwum) {


  //$('#sprawy').dataTable().fnClearTable();
  $('#sprawy').dataTable().fnDestroy();

  $('#sprawy tfoot th').each( function () {
    var title = $(this).text();
    $(this).html( '<input type="text" placeholder='+title+' />' );
  } );

  table = $('#sprawy').DataTable( {

    "ajax": "ajax/ajax_lista_spraw_uzytkownika",
    "dataSrc": "data",
    "autoWidth": false,
    "scrollX": true,
    "columns": [
      { "data": "lp",
        "width": "3%"},
      { "data": "numer_sprawy",
        "width": "10%"},
      { "data": "data_wplywu",
        "width": "7%"},
      { "data": "data_ostatniego_wplywu",
        "width": "7%"},
      { "data": "data_ostatniego_komentarza",
        "width": "7%"},
      { "data": "nazwisko_imie_klienta",
        "width": "12%"},
      { "data": "etap_sprawy",
        "width": "10%"},
      { "data": "agent",
        "width": "12%"},
      { "data": "grupa_spraw",
        "width": "9%"},
      { "data": null,
        "width": "23%",
        "orderable": false,
        "render": function (data, type, row) {
          return '<table cellpadding="5" cellspacing="0" border="0">'+
            '<tr>'+
            '<td>Etap w kancelarii:</td>'+
            '<td>'+row.etap_w_kancelari+'</td>'+
            '</tr>'+
            '<tr>'+
            '<td>Kierownik:</td>'+
            '<td>'+row.kierownik+'</td>'+
            '</tr>'+
            '<tr>'+
            '<td>Dyrektor:</td>'+
            '<td>'+row.dyrektor+'</td>'+
            '</tr>'+
            '<tr>'+
            '<td>Kwota ostatniego wpływu:</td>'+
            '<td>'+row.kwota_wplywu+'</td>'+
            '</tr>'+
            '<tr>'+
            '<td>Typ szkody:</td>'+
            '<td>'+row.typ_szkody+'</td>'+
            '</tr>'+
            '<tr>'+
            '<td>Ostatni komentarz:</td>'+
            '<td>'+row.komentarz+'</td>'+
            '</tr>'+
            '</table>';
          //'<div class="wyslij_powiadomienie_btn"><p>WYSLIJ</p></div>';
          //return '<p>Etap w Kancelarii: '+row.etap_w_kancelari +'</p><p>Kierownik: '+ row.kierownik +'</p><p>Dyrektor: '+ row.dyrektor+'</p>';
        }
      }

    ],
    "columnDefs": [
      { responsivePriority: 3, targets: 0},
      { responsivePriority: 1, targets: 1},
      { responsivePriority: 1, targets: 2},
      { responsivePriority: 2, targets: 3},
      { responsivePriority: 2, targets: 4},
      { responsivePriority: 2, targets: 5},
      { responsivePriority: 1, targets: 6},
      { responsivePriority: 2, targets: 7},
      { responsivePriority: 3, targets: 8},
      { responsivePriority: 3, targets: 8}
    ],
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
    "responsive": false
  } );





  table.on('order.dt search.dt', function () {
    table.column(0, { search: 'applied', order: 'applied' }).nodes().each(function (cell, i) {
      cell.innerHTML = i + 1;
    });
  }).draw();

  $('#sprawy tfoot th input').attr('placeholder', '');
  $('#sprawy tfoot th:first input').hide();

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



  if(etap_archiwum == '0') {
    $( "#sprawy_filter" ).prepend( "<label><input type='checkbox' class='opcja_archiwum'>Bez spraw na etapie archiwum</label>" );
    table
      .column( 6 )
      .search( "", true )
      .draw();
    //$( "#sprawy_filter" ).prepend( "<label><input type='checkbox' class='opcja_archiwum_2'>Bez spraw na etapie archiwum_2</label>" );
  } else {
    $( "#sprawy_filter" ).prepend( "<label><input type='checkbox' class='opcja_archiwum' checked>Bez spraw na etapie archiwum</label>" );
    table
      .column( 6 )
      .search( "[^Archiwum]", true )
      .draw();
  }

  sprawdz_archiwum();

}



$('#strona').on('click', '.pokaz_szczegoly_sprawy', function() {

  pokaz_szczegoly_sprawy ($(this).data('id_sprawy'));

});

function pokaz_szczegoly_sprawy (id_sprawy) {

  $.ajax({
    method: "POST",
    url: "ajax/ajax_szczegoly_sprawy",

    data: {
      id_sprawy: id_sprawy
    }
  })
    .done(function (data) {

      var array = $.parseJSON(data);

      //$('#myModal1').modal('show');

      mainPanel.wyswietlPopUp('modal-lg');

      document.getElementById("popUpTytul").innerHTML = 'SZCZEGÓŁY SPRAWY: '+array[0];



      var tresc_boxa = document.getElementById("popUpTresc");
      tresc_boxa.innerHTML = array[1];
      /*
      '<div class="dane_sprawy"><table id="szczegoly_spraw">'
      +'<tr><td class="nazwa_kolumny">Status sprawy:</td><td class="wartosc_kolumny">' + array[1] + '</td><td class="nazwa_kolumny">Numer agenta:</td><td class="wartosc_kolumny">' + array[16] + '</td></tr>'
      +'<tr><td class="nazwa_kolumny">Nazwisko i imię klienta:</td><td class="wartosc_kolumny">' + array[2] +' '+ array[3] + '</td><td class="nazwa_kolumny">Nazwisko i imię agenta:</td><td class="wartosc_kolumny">' + array[17] + '</td></tr>'
      +'<tr><td class="nazwa_kolumny">Nazwisko i imię poszkodowanego:</td><td class="wartosc_kolumny">' + array[4] +' '+ array[5] +'</td><td class="nazwa_kolumny">Numer kierownika:</td><td class="wartosc_kolumny">' + array[18] + '</td></tr>'
      +'<tr><td class="nazwa_kolumny">Data rejestracji sprawy:</td><td class="wartosc_kolumny">' + array[6] + '</td><td class="nazwa_kolumny">Nazwisko i imię kierownika:</td><td class="wartosc_kolumny">' + array[19] + '</td></tr>'
      +'<tr><td class="nazwa_kolumny">Etap sprawy:</td><td class="wartosc_kolumny">' + array[7] + '</td><td class="nazwa_kolumny">Numer dyrektora:</td><td class="wartosc_kolumny">' + array[20] + '</td></tr>'
      +'<tr><td class="nazwa_kolumny">Etap:</td><td class="wartosc_kolumny">' + array[8] + '</td><td class="nazwa_kolumny">Nazwisko i imię dyrektora:</td><td class="wartosc_kolumny">' + array[21] + '</td></tr>'
      +'<tr><td class="nazwa_kolumny">Wartośc sprawy:</td><td class="wartosc_kolumny">' + array[11] + '</td><td class="nazwa_kolumny">Jednostka:</td><td class="wartosc_kolumny">' + array[22] + '</td></tr>'
      +'<tr><td class="nazwa_kolumny">Data roszczenia:</td><td class="wartosc_kolumny">' + array[12] + '</td><td class="nazwa_kolumny">Obsługujący:</td><td class="wartosc_kolumny">' + array[9] + '</td></tr>'
      +'<tr><td class="nazwa_kolumny">Wycena:</td><td class="wartosc_kolumny">' + array[13] + '</td><td class="nazwa_kolumny">E-mail obsługującego:</td><td class="wartosc_kolumny"><a href=mailto:' + array[10] + '>' + array[10] + '</a></td></tr>'
      +'<tr><td class="nazwa_kolumny">Honorarium:</td><td class="wartosc_kolumny">' + array[23] + '</td><td class="nazwa_kolumny">Prawnik:</td><td class="wartosc_kolumny">' + array[25] + '</td></tr>'
      +'<tr><td class="nazwa_kolumny">Data pozwu:</td><td class="wartosc_kolumny">' + array[26] + '</td><td class="nazwa_kolumny">WPS:</td><td class="wartosc_kolumny">' + array[27] + '</td></tr>'
      +'<tr><td class="nazwa_kolumny">Data archiwum:</td><td>' + array[14] + '</td></tr>'
      +'<tr><td class="nazwa_kolumny">Powód przeniesienia:</td><td colspan="3">' + array[15] + '</td></tr>'
      +'<tr><td class="nazwa_kolumny">Komentarze:</td><td colspan="3">' + array[24] + '</td></tr>'
      + '</table></div>';
*/


      nowa_tabelka(array[2]);


      /*
                  var modal = document.getElementById('myModal');

                  var span = document.getElementsByClassName("close")[0];

                  modal.style.display = "block";

                  span.onclick = function() {
                      modal.style.display = "none";
                  }

                  window.onclick = function(event) {
                      if (event.target == modal) {
                          modal.style.display = "none";
                      }
                  }
      */
      $('.appendConversation1').on('click', function(){
        conversations = [];
        var data = {};
        if(($('#conversationTitle').val() == '')||($('#conversationMsg').val() == '')){
            $('#form2Error').append('<span class="form2Error"> Wypełnij poprawnie wszystkie pola!</span>');
            setTimeout(function () {
              $('#form2Error').empty();
            }, 1500);
        }else {
          var caseNumber = $('#caseNumber').val();
          var conversationMsg = $('#conversationMsg').val();
          var agentNumber = $('#agentNumber').val();
          data.agentNumber = agentNumber;
          data.type = 2;
          data.subject = caseNumber;
          data.message = new Array;
          var messageData = {};
          messageData.content = conversationMsg;
          conversations.push(data);
          conversations[0].message = new Array;
          conversations[0].message.push(messageData);
          $('.conversationsList').empty();
          addConversation(conversations);
          // $('.new-conversation-form').toggleClass('hide');
          // $('.new-conversation-form-button > .fa').toggleClass('fa-chevron-right');
          // $('.new-conversation-form-button > .fa').toggleClass('fa-chevron-down');
        }
      });
    }).fail(function (ajaxContext) {

  });

}
function nowa_tabelka (id_sprawy_tmp) {

  var id_sprawy = id_sprawy_tmp;

  var tresc_tabeli = document.getElementById("popUpTresc");
  tresc_tabeli.innerHTML = document.getElementById("popUpTresc").innerHTML +
    "<table id='tabelka' class='table table-striped table-bordered responsive' cellspacing='0' width='100%'>" +
    "<thead><tr>"+
    "<th>Numer odszkodowania</th>"+
    "<th>Data wpływu</th>"+
    "<th>Kwota wpływu</th>"+
    "<th>Podstawa do odliczenia honorarium</th>"+
    "</tr></thead></table>";


  var table = $('#tabelka')
  .on( 'init.dt', function () {
    console.log( 'Table initialisation complete: '+new Date().getTime() );

    var filesDataSource = new kendo.data.DataSource({
      transport: {
        read: {
          url: API_URL + 'case/getdocumentslist',
          dataType: 'json',
        },
        parameterMap: function (options) {
          return {
            models: kendo.stringify(options.models),
            api_key: '1aa53f75-55c8-41a7-8554-25e094c71b47',
            case_id: id_sprawy,
            agent_number: $('#agentNumber').val()
          };
        }
      },
      pageSize: 12,
      batch: true,
      schema: {
        model: {
          fields: {
            name: 'name',
            date: 'date',
          },
        },
      },
    })


    $('#grid-docs').kendoGrid({
      scrollable: false,
      pageable: true,
      sortable: true,
      dataSource: filesDataSource,
      columns: [
        {title: 'Typ pliku', field: 'name'},
        {title: 'Data dodania', field: 'date'},
      ],
    })

    $('#addFilesBtnCase').click(function (e) {
      $('#doc-add-btn-label').removeClass('hide');
      $('#doc-types-add-row').removeClass('hide');
    })

    fillDictionaryList();

    $('#case-files').kendoUpload(
      {
        async: {
          saveUrl: API_URL+'case/addDocumentFile',
          withCredentials: false,
          autoUpload: true,
        },
        multiple: false,
        localization: {
          select: "Wybierz plik..",
          remove: 'Usuń'
        },
        uploadEventHandler (e) {
          e.headers.set('Access-Control-Allow-Credentials', 'true');
        },
        type: "post",
        success: function (e) {
          var files = e.files;
          if (e.operation === "upload") {
            console.log("Successfully uploaded " + files.length + " files");
          }
          var date = e.response.date;
          var name = $("#selected-doc-type-text").val();
          filesDataSource.add({ name: name, date: date });
        },
        error: function (e) {
          var files = e.files;
          if (e.operation === "upload") {
            alert("Failed to upload " + files.length + " files");
          }
        },
        upload: function (d) {
          d.data = {
            agent_number: $("#current_agent_number").val(),
            type_id: $("#selected-doc-type").val(),
            case_id: $("#current_case_id").val(),
          };
        },
        showFileList: true,
        select: onSelect,
        remove: onRemove
      },
    )

    function onSelect(e) {
      $('#doc-submit-btn').removeClass('hide');
    };

    function onRemove(e) {
      $('#doc-submit-btn').addClass('hide');
    }
  })
  .DataTable({

    "ajax":{
      "url": 'ajax/ajax_tabela_do_szczegolow_sprawy',
      "type": 'GET',
      "data": {"id_sprawy": id_sprawy}
    },
    "columns": [
      { "data": "numer_odszkodowania", "className": "body-center"},
      { "data": "data_wplywu", "className": "body-center"},
      { "data": "kwota_wplywu", "className": "body-center"},
      { "data": "kwota_bazowa", "className": "body-center"}
    ],
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
    "pagingType": "simple_numbers",
    "lengthMenu": [10, 25, 50, 100],
    "order": [[0, 'asc']],
    "autoWidth": false
  } );

  function fillDictionaryList(){
    $("#doc-types").kendoDropDownList({
      autoBind: false,
      text: "Wybierz typ",
      close: onCloseDropDown,
      dataTextField: "name",
      dataValueField: "id",
      dataSource: {
        transport: {
          read: {
            dataType: "json",
            url: API_URL + 'case/getFileTypeDictionaryList',
          }
        },
        parameterMap: function (options) {
          return {
            api_key: '1aa53f75-55c8-41a7-8554-25e094c71b47',
          };
        }
      }
    });
  }

  function onCloseDropDown (e) {
    $("#selected-doc-type").val(this.dataItem().id)
    $("#selected-doc-type-text").val(this.dataItem().name)
    $('#case-files-div').removeClass('hide')
    $('#doc-add-btn-label').addClass('hide')
  }
}
