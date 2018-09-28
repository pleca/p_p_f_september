<div id="contract-list" xmlns="http://www.w3.org/1999/html">
    <ul>
        <li class="k-state-active">Lista Umów</li>
    </ul>
    <style>
        div.k-edit-form-container {
            width: auto;
            height: auto;
        }
    </style>
    <div id="grid"></div>

    <script id="popup_editor" type="text/x-kendo-template">
        <?php require_once('./src/contract_edit.php'); ?>
    </script>
    <script type="text/x-kendo-template" id="detailTemplate">
       <div class="row">
           <div class="col-4">
               <div class="sendToCentralDiv">
                   <button class="btn btn-success sendToCentral">Wyślij sprawę do centrali</button>
               </div>
           </div>
           <div class="col-8">
               <div class="addFiles text-right">
                   <button class="btn btn-default hide addFilesBtn">Dodaj pliki</button>
               </div>
               <div class="fileUploadDiv hide">
                   <p for="">Wybierz rodzaj dokumentu</p>
                   <div class="demo-section k-content">
                       <input class="file_upload" style="width: 100%" />
                   </div>
                   <div class="sendFilesToCentral hide">
                       <input name="files" type="file" aria-label="files" />
                   </div>
               </div>
           </div>
       </div>

    </script>

</div>
