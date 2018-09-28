
$(document).ready(function () {

  var dataSource3 = new kendo.data.DataSource({
    transport: {
      read: {
        url: API_URL + 'frank/getdocumentslist',
        dataType: 'json',
      },
      destroy: {
        url: API_URL + 'frank/removedocument',
        dataType: 'json',
      },
      parameterMap: function (options, type) {
        if (type === "destroy") {
          return {
            models: kendo.stringify(options.models),
            api_key: '1aa53f75-55c8-41a7-8554-25e094c71b47',
            doc_id: options.models[0].doc_id
          }
        }
        return {
          models: kendo.stringify(options.models),
          api_key: '1aa53f75-55c8-41a7-8554-25e094c71b47',
          user: user
        };
      }
    },
    pageSize: 12,
    batch: true,
    schema: {
      model: {
        id: 'doc_id',
        fields: {
          file: 'doc_file',
          file_name: 'doc_file_title',
        },
      },
    },
  })

  $('#documents_grid').kendoGrid({
    scrollable: false,
    pageable: true,
    sortable: true,
    dataSource: dataSource3,
    filterable: {
      operators: {
        string: {
          contains: "Zawiera"
        }
      }
    },
    columns: [
      {title: 'Data dodania', field: 'date_add'},
      {title: 'Nazwa pliku', field: 'file_name'},
      {title: 'Opis', field: 'doc_desc'},
      {
        title: '',
        template: $('#btntemplate').html(),
        width: '50px',
      },
      {command: ['edit','destroy'], title: '&nbsp;', width: '200px'},
    ],
    editable: {
      mode: 'popup',
      template: $('#document-edit-template').html(),
      window: {
        title: 'Edycja dokumentu',
        width: '50%',
        minWidth: 100,
        visible: false,
        close: onCloseWindow,
        position: {
          top: 10,
          left: '20%',
        },
      },
    },
    dataBound: function (){
      if (!edytuj_dokument) {
        $(".k-grid-edit").hide();
      } else {
        $(".k-grid-edit").show();
      }

    },
    edit: function (e) {
      $('a.k-grid-update').hide()
      $('a.k-grid-cancel').hide()
    },
  })


  var dataSource = new kendo.data.DataSource({
    transport: {
      read: {
        url: API_URL + 'frank/getusergroupslist',
        dataType: 'json',
      },
    },
  })

  // MODAL TWORZENIE NOWEGO DOKUMENTU
  $('#user-groups-ul').kendoListView({
    dataSource: dataSource,
    template: $('#user-groups-li').html(),
  })

  $('#document-form').submit(function () {
    setCookie('documents', true)
  })

  if (getCookie('documents')) {
    switchTabToDocuments()
    deleteCookie('documents')
  }

  $('#document-form').kendoValidator({
    rules: {
      upload: function (input) {
        if (input[0].type === 'file') {
          return (input.closest('.k-upload').find('.k-file').length > 0 &&
            input.closest('.k-upload').find('.k-file-invalid').length === 0)
        }
        return true
      },
    },
  }).data('kendoValidator')

  $('#document-form .k-upload-button').on('change', 'input[type=file]', function () {
    $(this).blur().focus()
  })

  function switchTabToDocuments () {
    $('#v-pills-franc-calculator').removeClass('active')
    $('#v-pills-franc-calculator').removeClass('show')
    $('#v-pills-franc-calculator-tab').removeClass('active')
    $('#v-pills-franc-calculator-tab').attr('aria-selected', 'false')
    $('#v-pills-documents').addClass('active')
    $('#v-pills-documents').addClass('show')
    $('#v-pills-documents-tab').addClass('active')
    $('#v-pills-documents-tab').attr('aria-selected', 'true')
  }

  $('#files').kendoUpload(
    {
      multiple: false,
    },
  )
})


function onCloseWindow () {
  setCookie('documents', true)
  location.reload();
}
