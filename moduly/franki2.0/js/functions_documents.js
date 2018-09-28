
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
      create: {
        url: API_URL + 'frank/createdocument',
        dataType: 'json',
      },
      update: {
        url: API_URL + 'frank/updatedocuments',
        dataType: 'json',
      },
      parameterMap: function (options, type) {
        return {
          models: kendo.stringify(options.models),
          api_key: '1aa53f75-55c8-41a7-8554-25e094c71b47',
          user: user
        };
      }
    },
    batch: true,
    schema: {
      model: {
        id: 'doc_id',
        fields: {
          doc_id: { editable: false },
          doc_file: 'doc_file',
          doc_file_title: 'doc_file_title',
          doc_desc: 'doc_desc',
          doc_name: 'doc_name',
          doc_type: 'doc_type',
          date_add: 'date_add',
          date_mod: 'date_mod',
          uploaded_doc_id: 'uploaded_doc_id',
        },
      },
    },
  })

  var docMainGrid = $('#documents_grid').kendoGrid({
    scrollable: false,
    pageable: true,
    sortable: true,
    dataSource: dataSource3,
    toolbar: [
      { name: "create" }
    ],
    filterable: {
      operators: {
        string: {
          contains: "Zawiera"
        }
      }
    },
    columns: [
      {title: 'Data dodania', field: 'date_add', format: "{0: yyyy-MM-dd HH:mm:ss}"},
      {title: 'Nazwa pliku', field: 'doc_file_title'},
      {title: 'Opis', field: 'doc_desc'},
      {
        title: '',
        template: $('#btntemplate').html(),
        width: '50px',
      },
      {command: ['edit'], title: '&nbsp;', width: '100px'},
      {command: ['destroy'], title: '&nbsp;', width: '100px'},
    ],
    editable: {
      mode: 'popup',
      template: $('#document-edit-template2').html(),
      window: {
        title: "Edycja",
        width: "60%",
        minWidth: 100,
        visible: true,
        position: {
          top: 100,
          left: "20%"
        }
      }
    },
    dataBound: function (){
      var grid = $('#documents_grid').data("kendoGrid");
      grid.hideColumn("");
      if (!dodaj_dokument) {
        $("#documents_grid .k-grid-add").hide();
      } else {
        $("#documents_grid .k-grid-add").show();
      }
      if (!pobierz_dokument) {
        grid.hideColumn(3);
      } else {
        grid.showColumn(3);
      }
      if (!edytuj_dokument) {
        grid.hideColumn(4);
      } else {
        grid.showColumn(4);
      }
      if (!usun_dokument) {
        grid.hideColumn(5);
      } else {
        grid.showColumn(5);
      }
    },
    save: function(e,c){
      e.model.set("uploaded_doc_id",$("#uploadedFileDocId").val());
      e.model.set("doc_desc",$("#doc_desc").val());
      e.model.set("doc_name",$("#doc_name").val());
      e.model.set("date_add",$("#uploadedFileDateAdd").val());
      e.model.set("date_mod",$("#uploadedFileDateAdd").val());
      e.model.set("doc_file_title",$("#uploadedFileTitle").val());
      e.model.set("doc_file",$("#uploadedFile").val());
      e.model.set("doc_type",$("#uploadedFileType").val());
    },
    edit: function (k) {
      $("#fileupload").kendoUpload({
        async: {
          saveUrl: API_URL+'frank/uploadDocumentFile',
          withCredentials: false,
          autoUpload: false,
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
          $("#uploadedFileDocId").val(e.response[0].uploaded_doc_id);
          $("#uploadedFileDateAdd").val(e.response[0].date_add);
          $("#uploadedFileDateMod").val(e.response[0].date_mod);
          $("#uploadedFileTitle").val(e.response[0].doc_file_title);
          $("#uploadedFile").val(e.response[0].doc_file);
          $("#uploadedFileType").val(e.response[0].doc_type);

          $("#document-permissions").show();
          $("#document-grid-popup ~ .k-edit-buttons").show();
          $(".k-grid-update").show();
        },
        error: function (e) {
          var files = e.files;
          if (e.operation === "upload") {
            alert("Failed to upload " + files.length + " files");
          }
        },
        upload: function (d) {
          d.data = {
            description: $("#doc_desc").val(),
            name: $("#doc_name").val(),
            uploaded_doc_id: $("#uploadedFileDocId").val(),
          };
        },
        showFileList: true,
      });
    },
  })
})

