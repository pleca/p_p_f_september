<?php if (in_array('dodaj_dokument', $_SESSION['_listaUprawnien'])) { ?>
    <button type="button" class="k-button k-button-icontext k-grid-adding" data-toggle="modal" data-target="#modalForm" id="doc-add-btn">
        <span class="k-icon k-i-plus"></span>
        <span>Dodaj dokument<span>
    </button>
<?php } ?>


<!-- MODAL TWORZENIE NOWEGO DOKUMENTU POPUP -->
<div id="modalForm" class="modal fade mb-3" role="dialog">
    <div class="documents-form">
        <div class="modal-dialog modal-lg">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Dodawanie pliku</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form method="post" action="<?php echo API_URL ?>frank/addDocumentFile"
                      enctype="multipart/form-data" id="document-form">
                    <div class="k-content">
                        <div class="modal-body">
                            <ul class="fieldlist">
                                <li>
                                    <label>plik:</label>
                                    <input id="files" type="file" name="files" validationmessage="Dodaj plik."/>
                                </li>
                                <li>
                                    <label>opis: </label>
                                    <input class="k-textbox" type="text" id="documents-description"
                                           name="description" validationmessage="Dodaj opis" required/>
                                </li>
                                <li>
                                    <label>nazwa: </label>
                                    <input class="k-textbox" type="text" id="documents-name"
                                           name="name" validationmessage="Dodaj nazwę" required/>
                                </li>
                            </ul>
                            <div class="">
                                <h5 class="form-head-doc">Grupy użytkowników:</h5>
                                <ul class="fieldlist-groups" id="user-groups-ul"></ul>
                            </div>
                            <div class="alert alert-info">
                                <strong>Uwaga!</strong> Opcja dodawania pojedyńczych użytkowników dostępna po dodaniu pliku i wybraniu opcji "Edycja".
                            </div>
<!--                            <div class="">-->
<!--                                <h5 class="form-head-doc">Pojedyńczy użytkownicy:</h5>-->
<!--                                <div id="grid-single-user-groups-new"></div>-->
<!--                            </div>-->
                        </div>
                        <div class="text-right cancel-div"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="k-button">Dodaj</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- GŁÓWNY GRID LISTA DOKUMENTÓW-->
<div id="documents">
    <div id="documents_grid"></div>
</div>


<script id="user-groups-li" type="text/x-kendo-template">
    <li class="user-groups-li">
        <input type="checkbox" name="group[]" value="#:id#" id="#:id#" class="k-checkbox">
        <label class="k-checkbox-label" for="#:id#">#:nazwa#</label>
    </li>
</script>


<script id="single-user-li" type="text/x-kendo-template">
    <li>
        <input type="checkbox" name="group[]" value="#:id#" id="#:id#" class="k-checkbox">
        <label class="k-checkbox-label" for="#:id#">#:nazwa#</label>
    </li>
</script>


<script id="btntemplate" type="text/x-kendo-template">
    <a href="src/getFile/getFile.php?docid=#=doc_id#"><span class="k-icon k-i-download"></span></a>
</script>


<script id="user-groups-li-edit" type="text/x-kendo-template">
    <li class="user-groups-li-edit">
        <input type="checkbox" name=group[#:data.id#]" id="#:data.nazwa#" value="#:data.id#" class="k-checkbox" # if (data.checked) { # checked # } #>
        <label class="k-checkbox-label" for="#:data.nazwa#">#:data.nazwa#</label>
    </li>
</script>


<!--SKRYPT EDYCJI WIERSZA GRIDA POPUP-->
<script id="document-edit-template" type="text/x-kendo-template">

    <div class="documents-form">
        <form method="post" action="<?php echo API_URL ?>frank/updatedocument"
              enctype="multipart/form-data" id="document-form-edit">
            <div class="k-content">
                <div class="modal-body">
                    <ul class="fieldlist">
                        <li>
                            <label>plik:</label>
                            <input id="files-edit" type="file" name="doc_file" validationmessage="Dodaj plik."/>
                            <input id="doc_id" name="doc_id" type="hidden">
                        </li>
                        <li>
                            <label>opis: </label>
                            <input class="k-textbox" type="text" id="documents-description-edit"
                                   name="doc_desc" validationmessage="Dodaj opis" required/>
                        </li>
                        <li>
                            <label>nazwa: </label>
                            <input class="k-textbox" type="text" id="documents-name-edit"
                                   name="doc_name" validationmessage="Dodaj nazwę" required/>
                        </li>
                    </ul>
                    <h5 class="form-head-doc">Grupy użytkowników:</h5>
                    <div id="document-groups">
                        <ul class="fieldlist-groups" data-role="listview"
                            data-template="user-groups-li-edit"
                            data-bind="source: groupsData">
                        </ul>
                    </div>
                    <div class="">
                        <h5 class="form-head-doc">Pojedyńczy użytkownicy:</h5>
                        <span id="centeredNotification" style="display:none;"></span>
                        <div id="grid-single-user-groups"></div>
                    </div>
                </div>
            </div>

            <div class="modal-footer" >
                <button type="submit" id="document-update-edit" class="k-button">Zapisz</button>
            </div>

        </form>
    </div>

    <script>
      var documentId = #: doc_id #;
      var newUser = true;

      var centered = $("\#centeredNotification").kendoNotification({
        stacking: "down",
        show: onShow,
        button: true
      }).data("kendoNotification");

      function onShow(e) {
        if (e.sender.getNotifications().length == 1) {
          var element = e.element.parent(),
            eWidth = element.width(),
            eHeight = element.height(),
            wWidth = $(window).width(),
            wHeight = $(window).height(),
            newTop, newLeft;

          newLeft = Math.floor(wWidth / 2 - eWidth / 2);
          newTop = Math.floor(wHeight / 2 - eHeight / 2);

          e.element.parent().css({top: newTop, left: newLeft});
        }
      }


  var allUsersDataSource = new kendo.data.DataSource({
    transport: {
      read: {
        url: API_URL + "frank/getusers",
        dataType: "json"
      }
    },
  });

  allUsersDataSource.fetch(function() {
    allUsers = allUsersDataSource.data();
  })

  var assignedUsersDataSource = new kendo.data.DataSource({
    // autoSync: true,
    transport: {
      read:{
        url: API_URL+"frank/getassignedusers/"+documentId,
        dataType: "json"
      },
      create: {
        type: "POST",
        url: API_URL+"frank/addusertodocument",
        dataType: "json"
      },
      update: {
        type: "POST",
        url: API_URL+"frank/editusertodocument",
        dataType: "json"
      },
      destroy:{
        type: "POST",
        url: API_URL+"frank/removeuserdocument",
        dataType: "json"
      },
      batch: true,
    },
    change: function(e) {
      if(e.action === "remove" && typeof e.items[0].UserID !== "undefined"){
        var removed = ajaxRemoveUserFromDocument(e.items[0].UserID, documentId)
      }
    },
    pageSize: 14,
    schema: {
      model: {
        fields: {
          UserName: { editable: false, nullable: true },
          Surname: { editable: false, nullable: true },
          UserID: { field: "UserID" },
          GroupName: { editable: false, nullable: true },
        }
      }
    }
  });

  var _grid = $("\#grid-single-user-groups").kendoGrid({
    dataSource: assignedUsersDataSource,
    filterable: true,
    scrollable: false,
    toolbar: ["create"],
    pageable: true,
    columns: [
      {
        field: "UserID", width: "100%",
        editor: userDropDownEditor,
        title: "Agent",
        template: function(userID) {
          if(userID.UserID === ''){
            return '';
          }
            for (var idx = 0, length = allUsers.length; idx < length; idx++) {
              if (allUsers[idx].UserNameID == userID.UserID) {
                return allUsers[idx].Login;
              }
            }
        }
      },
      { command: [ "destroy"], title: "&nbsp;", width: "250px" }
    ],
    editable: {mode: "incell"},
    save: function(e) {
      if (e.model.UserID !== "" && e.values.UserID !== "" && e.values.UserID !== e.model.UserID){
          //edycja komórki
        ajaxRemoveUserFromDocument(e.model.UserID, documentId)
        ajaxAddUserToDocument(e.values.UserID, documentId)
        setCookie('UserModification', e.model.UserID);
      }
    },
    cellClose: function(e){
      newUser = true;
      if(getCookie('UserModification')){
        var userModification = getCookie('UserModification');
        if(userModification){
          newUser = false;
        }
        deleteCookie('UserModification')
      }
      if (getCookie('cellOpened')) {
        if(getCookie('cellOpened') == e.model.UserID) {
          newUser = false;
        }
        deleteCookie('cellOpened')
      }
      if(e.type === "save" && typeof e.model.UserID !== "undefined" && e.model.isNew() && newUser === true && e.model.UserID > 0 ){
        ajaxAddUserToDocument(e.model.UserID, documentId)
      }
    },
    edit: function(e){
      if (!getCookie('cellOpened')) {
          setCookie('cellOpened', e.model.UserID);
      }
    }
  });

  function userDropDownEditor(container, options) {
    $('<input data-bind="value:' + options.field + '"/>')
    .appendTo(container)
    .kendoDropDownList({
      dataTextField: "Login",
      dataValueField: "UserNameID",
      filter: "contains",
      dataSource: allUsersDataSource,
      valuePrimitive:true,
    })
  }

    function ajaxRemoveUserFromDocument (userid, documentid) {
      $.ajax({
        url: API_URL+"frank/removeuserdocument",
        type: 'POST',
        dataType: "json",
        data: {
          api_key: '1aa53f75-55c8-41a7-8554-25e094c71b47',
          user: user,
          documentId: documentid,
          user_id: userid
        },
        success : function(response) {
          centered.show(kendo.toString('POMYŚLNIE USUNIĘTO UŻYTKOWNIKA   .') );
          removed = true;
        },
        error: function(xhr, status, error) {
          var err = eval("(" + xhr.responseText + ")");
          console.log("grid.saveChanges.NIE usunięto użytkowników.", err.Message)
        }
      });
    }

      function ajaxAddUserToDocument (userid, documentid) {
        $.ajax({
          url: API_URL+"frank/addusertodocument",
          type: 'POST',
          dataType: "json",
          data: {
            api_key: '1aa53f75-55c8-41a7-8554-25e094c71b47',
            user: user,
            document_id: documentid,
            user_id: userid
          },
          success : function(response) {
            centered.show(kendo.toString('POMYŚLNIE DODANO UŻYTKOWNIKA   .') );
          },
          error: function(xhr, status, error) {
            var err = eval("(" + xhr.responseText + ")");
            console.log("grid.cellClose.NIE dodano użytkownika.", err.Message)
          }
        });
      }



      var dataSource2 = new kendo.data.DataSource({
        transport: {
          read: {
            url: API_URL+"frank/getusergroups/"+documentId,
            dataType: "json"
          }
        }
      });

      var viewModel2 = kendo.observable({
        groupsData: dataSource2,
      });

      kendo.bind($("\#document-groups"), viewModel2);


      $('\#document-form-edit').submit(function () {
        setCookie('documents', true)
      })

      $('\#files-edit').kendoUpload(
        {
          multiple: false,
        },
      )

      <\/script>
</script>
