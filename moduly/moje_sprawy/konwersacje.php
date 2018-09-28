<?php
require_once($_SERVER ['DOCUMENT_ROOT'].'/header.php');

//if(!in_array('42', $luzu)){
if(!in_array('40', $luzu)){
    header('Location: https://' . $_SERVER ['HTTP_HOST'] . '/403 ');
}

$mainPanel->wyswietlNaglowek(false, 'moje sprawy');

if(!in_array('116', $luzu)) {

    echo '<script>
            var files_acces = 0;
       </script>';
}
else {
    echo '<script>
            var files_acces = 1;
       </script>';
}

?>

    <script type="text/javascript" src="<?php adres_strony(); ?>biblioteki/bootstrap/js/bootstrap.js"></script>
    <script type="text/javascript" src="<?php adres_strony(); ?>biblioteki/bootstrap/js/npm.js"></script>

    <script type="text/javascript" src="<?php adres_strony(); ?>biblioteki/datatables/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="<?php adres_strony(); ?>biblioteki/datatables/dataTables.responsive.min.js"></script>
    <script type="text/javascript" src="<?php adres_strony(); ?>biblioteki/datatables/dataTables.bootstrap.min.js"></script>

    <script type="text/javascript" src="<?php adres_strony(); ?>biblioteki/datatables/dataTables.fixedHeader.min.js"></script>
    <script type="text/javascript" src="<?php adres_strony(); ?>biblioteki/bootstrap/js/responsive.bootstrap.min.js"></script>
    <script type="text/javascript" src="<?php adres_strony(); ?>biblioteki/datatables/dataTables.responsive.min.js"></script>

    <script type="text/javascript" src="<?php adres_strony(); ?>moduly/moje_sprawy/js/funkcje_konwersacje"></script>

    <link rel="stylesheet" href="<?php adres_strony(); ?>biblioteki/telerik/styles/kendo.common.min.css" />
    <link rel="stylesheet" href="<?php adres_strony(); ?>biblioteki/telerik/styles/kendo.default.min.css" />
    <link rel="stylesheet" href="<?php adres_strony(); ?>biblioteki/telerik/styles/kendo.default.mobile.min.css" />
    <script src="<?php adres_strony(); ?>biblioteki/telerik/js/kendo.all.min.js"></script>

    <link rel="stylesheet" href="<?php echo 'https://' . $_SERVER ['HTTP_HOST'] . '/biblioteki/datatables/dataTables.bootstrap.css'; ?>" type="text/css" />
    <link rel="stylesheet" href="<?php echo 'https://' . $_SERVER ['HTTP_HOST'] . '/biblioteki/bootstrap/css/bootstrap.css'; ?>" type="text/css" />
    <link rel="stylesheet" href="<?php echo 'https://' . $_SERVER ['HTTP_HOST'] . '/biblioteki/fontawsome/css/font-awesome.css'; ?>" type="text/css" />
    <link rel="stylesheet" href="<?php echo 'https://' . $_SERVER ['HTTP_HOST'] . '/moduly/moje_sprawy/css/style-conversation.css'; ?>" type="text/css" />

    <div class="row">
        <div class="col-md-12">
            <div class="col-md-12"><?php  echo gdzie_jestem($_SERVER['REQUEST_URI']); ?></div>
            <div class="col-md-2">
                <div class="panel panel-default ">
                    <div class="panel-heading">MENU SPRAW</div>
                    <div class="panel-body panel_menu_body">
                        <a class="margin_t_10" href="<?php echo 'https://' . $_SERVER ['HTTP_HOST'] . '/moduly/moje_sprawy/'; ?>">
                            <div id="sprawy_glowna" class="margin_b_0 margin_t_10 width_100 btn btn-default">Strona główna</div></a>
                        <a class="margin_t_10" href="<?php echo 'https://' . $_SERVER ['HTTP_HOST'] . '/moduly/moje_sprawy/sprawy'; ?>">
                            <div id="sprawy_sprawy" class="margin_b_0 margin_t_10 width_100 btn btn-default">Sprawy</div></a>
                        <a class="margin_t_10" href="<?php echo 'https://' . $_SERVER ['HTTP_HOST'] . '/moduly/moje_sprawy/konwersacje'; ?>">
                            <div id="sprawy_konwersacje" class="margin_b_0 margin_t_10 width_100 btn btn-default">Konwersacje</div></a>
                    </div>
                </div>
            </div>
            <div class="col-md-10">
                    <div class=" contact-content">
                        <div class="col-md-4">
                            <ul class="new-conversation list-group">
                                <div class="new-conversation-form-button element-header">
                                    <span class="">Rozpocznij rozmowę </span> <span style="padding-top: 0px" class="fa fa-chevron-left right" aria-hidden="true"></span>
                                </div>
                                <li class="">
                                    <div class="new-conversation-form hide">
                                        <form>
                                            <input type="hidden" id="agentNumber" value="<?php echo $_SESSION['uzytkownik_login']; ?>">
                                            <div class="row">
                                                <div class="col">
                                                    <input id="conversationTitle" name="title" type="text"
                                                           class="k-textbox left form-control" placeholder="Wpisz tytuł"
                                                    />
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-xs-12">
                                                    <select id="conversationTarget" class="k-selectbox left form-control">
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col">
                                                    <input id="conversationCaseNumber" name="title" type="text"
                                                           class="k-textbox left form-control hide" placeholder="Wpisz numer sprawy"
                                                    />
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col">
                                              <textarea id="questionMsg" name="content" type="text"
                                              class="k-textbox left form-control" placeholder="Wpisz treść"
                                              style="height: 150px"></textarea>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-xs-12">
                                                    <span class="appendConversation form-button" style="margin-top: 20px; float: right">DODAJ</span>
                                                </div>
                                            </div>
                                            <div id="formError"></div>
                                        </form>
                                    </div>
                                </li>
                            </ul>
                            <ul class="list-group conversationsList">
                            </ul>
                        </div>
                        <div class="col-md-8">
                            <div class="conversation">
                                <div class="element-header">
                                    <span class="conversationTitle">KONWERSACJA</span>
                                </div>
                                <div class="conversation-body hide">
                                    <ul class="fieldlist ">
                                        <div class="form-group conversationsWindow">
                                        </div>

                                        <div id="conversationError"></div>
                                    </ul>
                                    <div class="conversation-add-comment">
                                        <div class="row">
                                            <div class="col-12">
                                                <label for="simple-input" class="no-style-label">Dodaj komentarz</label>
                                            </div>
                                            <div class="col">
                                        <textarea id="conversationMsg" name="content" type="text"
                                                  class="k-textbox left form-control" placeholder="Wpisz treść"
                                                  style="height: 150px" required></textarea>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col text-right">
                                                <span class="addQuestion form-button" style="margin-top: 20px; margin-right: 0">DODAJ</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>

        </div>
    </div>
    <div class="clear_b"></div>

<?php require_once($_SERVER ['DOCUMENT_ROOT'].'/footer.php'); ?>