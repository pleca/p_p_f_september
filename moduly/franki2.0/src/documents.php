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
    <a href="src/getFile/getFile.php?uploaded_doc_id=#=uploaded_doc_id#"><span class="k-icon k-i-download"></span></a>
</script>


<script id="user-groups-li-edit" type="text/x-kendo-template">
    <li class="user-groups-li-edit">
        <input type="checkbox" name=group[#:data.id#]" id="#:data.nazwa#" value="#:data.id#" class="k-checkbox" # if (data.checked) { # checked # } #>
        <label class="k-checkbox-label" for="#:data.nazwa#">#:data.nazwa#</label>
    </li>
</script>

<script id="document-edit-template2" type="text/x-kendo-template">
    <div id="document-grid-popup">
        <div class="k-content">

            <ul class="fieldlist input-group">
                <li>
                    <label for="doc_desc">opis</label>
                    <input id="doc_desc" class="k-textbox" data-bind="value: doc_desc" name="doc_desc" type="text" style="width: 100%;"/>
                    <label for="doc_name">nazwa</label>
                    <input id="doc_name" class="k-textbox" data-bind="value: doc_name" name="doc_name" type="text" style="width: 100%;"/>
                </li>

                <li>
                    <input type="hidden" id='uploadedFileDocId' data-bind="value: uploaded_doc_id" />
                    <input type="hidden" id='uploadedFileDateAdd' data-bind="value: date_add" />
                    <input type="hidden" id='uploadedFileDateMod' data-bind="value: date_mod" />
                    <input type="hidden" id='uploadedFileTitle' data-bind="value: doc_file_title" />
                    <input type="hidden" id='uploadedFile' data-bind="value: doc_file" />
                    <input type="hidden" id='uploadedFileType' data-bind="value: doc_type" />
                </li>
                <li>
                    <input name="files" id="fileupload" type="file"/>
                </li>
            </ul>
            <hr class="col-xs-12">

            <div id="document-permissions" style="display:none;">
                <ul class="fieldlist">
                    <li>
                        <h5 class="form-head-doc">Grupy użytkowników:</h5>
                        <div id="document-groups">
                            <span id="centeredNotificationGroups" style="display:none;"></span>
                            <form id="document-group-permissions-form">
                            <ul class="fieldlist-groups" data-role="listview"
                                data-template="user-groups-li-edit"
                                data-bind="source: groupsData">
                            </ul>
                            <input type="submit" id="saveGroupPermissions" value="Zapisz grupy">
                            </form>
                        </div>
                    </li>
                </ul>
                <hr class="col-xs-12">
                <ul class="fieldlist">
                    <li>
                        <div class="">
                            <h5 class="form-head-doc">Pojedyńczy użytkownicy:</h5>
                            <span id="centeredNotification" style="display:none;"></span>
                            <div id="grid-single-user-groups"></div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <script>
      var documentId = '0';
      var editMode = false;
      $("\#saveGroupPermissions").kendoButton();
      $("\#document-grid-popup ~ .k-edit-buttons").hide();

      #if(uploaded_doc_id){#
        documentId = #:uploaded_doc_id#
        editMode = true;
      #}#

      if(editMode){
        //div uprawnienia
        $("\#document-permissions").show();
        $("\#document-grid-popup ~ .k-edit-buttons").show();
        $(".k-grid-update").show();
      }

      var dataSource2 = new kendo.data.DataSource({
        transport: {
          read: {
            url: API_URL+"frank/getusergroups/"+documentId,
            dataType: "json"
          }
        },
        parameterMap: function (options, type) {
          return {
            api_key: '1aa53f75-55c8-41a7-8554-25e094c71b47',
          };
        }

      });
      var viewModel2 = kendo.observable({
        groupsData: dataSource2,
      });
      kendo.bind($("\#document-groups"), viewModel2);

      var notificationGroups = $("\#centeredNotificationGroups").kendoNotification({
        stacking: "down",
        show: onShow,
        button: true
      }).data("kendoNotification");


      var notificationUser = $("\#centeredNotification").kendoNotification({
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
        parameterMap: function (options, type) {
          return {
            api_key: '1aa53f75-55c8-41a7-8554-25e094c71b47',
          };
        }
      });

      allUsersDataSource.fetch(function() {
        allUsers = allUsersDataSource.data();
      })

      var assignedUsersDataSource = new kendo.data.DataSource({
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
          parameterMap: function (options, type) {
            return {
              api_key: '1aa53f75-55c8-41a7-8554-25e094c71b47',
            };
          },
        },
        change: function(e) {
          if(e.action === "remove" && typeof e.items[0].UserID !== "undefined"){
            var removed = ajaxRemoveUserFromDocument(e.items[0].UserID, $("\#uploadedFileDocId").val())
          }
        },
        batch: true,
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
            ajaxRemoveUserFromDocument(e.model.UserID, $("\#uploadedFileDocId").val())
            ajaxAddUserToDocument(e.values.UserID, $("\#uploadedFileDocId").val())
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
            ajaxAddUserToDocument(e.model.UserID, $("\#uploadedFileDocId").val())
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

      function ajaxRemoveUserFromDocument (userid, docid) {
        $.ajax({
          url: API_URL+"frank/removeuserdocument",
          type: 'POST',
          dataType: "json",
          data: {
            api_key: '1aa53f75-55c8-41a7-8554-25e094c71b47',
            user: user,
            documentId: docid,
            user_id: userid
          },
          success : function(response) {
            notificationUser.show(kendo.toString('POMYŚLNIE USUNIĘTO UŻYTKOWNIKA   .') );
            removed = true;
          },
          error: function(xhr, status, error) {
            var err = eval("(" + xhr.responseText + ")");
            console.log("grid.saveChanges.NIE usunięto użytkowników.", err.Message)
          }
        });
      }

      function ajaxAddUserToDocument (userid, docid) {
        $.ajax({
          url: API_URL+"frank/addusertodocument",
          type: 'POST',
          dataType: "json",
          data: {
            api_key: '1aa53f75-55c8-41a7-8554-25e094c71b47',
            user: user,
            document_id: docid,
            user_id: userid
          },
          success : function(response) {
            notificationUser.show(kendo.toString('POMYŚLNIE DODANO UŻYTKOWNIKA   .') );
          },
          error: function(xhr, status, error) {
            var err = eval("(" + xhr.responseText + ")");
            console.log("grid.cellClose.NIE dodano użytkownika.", err.Message)
          }
        });
      }

      $('\#document-group-permissions-form').submit(function( event ) {
        var formData = JSON.stringify($('\#document-group-permissions-form').serializeArray())
        event.preventDefault();
        $.ajax({
          url: API_URL+"frank/adddocumentgroups",
          type: 'POST',
          dataType: "json",
          data: {
            api_key: '1aa53f75-55c8-41a7-8554-25e094c71b47',
            user: user,
            groups: formData,
            doc_id: $("\#uploadedFileDocId").val(),
          },
          success : function(response) {
            notificationGroups.show(kendo.toString('POMYŚLNIE DODANO GRUPY   .') );
          },
          error: function(xhr, status, error) {
            var err = eval("(" + xhr.responseText + ")");
            console.log("NIE dodano grup.", err.Message)
          }
        });
      });

      kendo.bind($("\#document-groups"), viewModel2);

      <\/script>
</script>
</div>