<?php
require_once($_SERVER ['DOCUMENT_ROOT'].'/header.php');
require_once($_SERVER ['DOCUMENT_ROOT'].'/klasy/klasa_api.php');
$user_id = $_SESSION["uzytkownik_login"];

if ($_POST) {
    $agent_id = $_POST["agentid"];
}

/*
if(!in_array('82', $luzu)){
    header('Location: https://' . $_SERVER ['HTTP_HOST'] . '/403 ');
}
*/
tytul_strony('KALENDARZ');
?>

<script type="text/javascript" src="<?php adres_strony(); ?>biblioteki/bootstrap/js/bootstrap.js"></script>
<script src="<?php adres_strony(); ?>biblioteki/telerik_2018.1.117/js/jquery.js"></script>
<script src="<?php adres_strony(); ?>biblioteki/telerik_2018.1.117/js/kendo.all.js"></script>

<link rel="stylesheet" href="<?php adres_strony(); ?>biblioteki/telerik_2018.1.117/styles/web/kendo.common.css" />
<link rel="stylesheet" href="<?php adres_strony(); ?>biblioteki/telerik_2018.1.117/styles/web/kendo.bootstrap.css" />
<link rel="stylesheet" href="<?php adres_strony(); ?>biblioteki/telerik_2018.1.117/styles/web/kendo.bootstrap.mobile.css" />
<script src="<?php adres_strony(); ?>biblioteki/telerik_2018.1.117/js/messages/kendo.messages.pl-PL.js"></script>
<script src="<?php adres_strony(); ?>biblioteki/telerik_2018.1.117/js/cultures/kendo.culture.pl-PL.js"></script>
<script src="<?php adres_strony(); ?>biblioteki/telerik_2018.1.117/js/kendo.timezones.js"></script>

<link rel="stylesheet" href="<?php echo 'https://' . $_SERVER ['HTTP_HOST'] . '/biblioteki/bootstrap/css/bootstrap.css'; ?>" type="text/css" />
<link rel="stylesheet" href="<?php echo 'https://' . $_SERVER ['HTTP_HOST'] . '/moduly/calendar/css/style.css'; ?>" type="text/css" />

<div class="col-md-12">
    <div class="col-md-12"><?php  echo gdzie_jestem($_SERVER['REQUEST_URI']); ?></div>

    <div class="col-md-2">
        <div class="panel panel-default ">
            <div class="panel-heading">MENU</div>
            <div class="panel-body panel_body_menu">

                <?php // if(in_array('44', $luzu)){ ?>
                <?php //if(in_array('42', $luzu)){ ?>
                <a class="margin_t_10" href="<?php echo 'https://' . $_SERVER ['HTTP_HOST'] . '/moduly/raporty/sprzedaz_struktury/'; ?>">
                    <div id="prow_uzytkownika" class="margin_b_0 margin_t_10 width_100 btn btn-default">Dodaj</div></a>
                <?php //} ?>
            </div>
        </div>
    </div>
    <div class="col-md-10">
        <div class="panel panel-default">
            <div id="panel_body_prowizji" class="panel-body ">


                <?php // if(in_array('45', $luzu)){ ?>
                <?php if(in_array('82', $luzu)){ ?>
                    <div class="wykres_prowizji_struktury">
                        <div class="container center">
                            <h3>Kalendarz</h3>


                            <?php
                            $curl = curl_init();
                            $wp_api_url = "http://10.0.0.45/agent/getdependentstructure/".$user_id;
                            curl_setopt($curl, CURLOPT_URL, $wp_api_url);
                            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                            curl_setopt($curl, CURLOPT_HEADER, false);
                            $response = curl_exec($curl);
                            $err = curl_error($curl);
                            curl_close($curl);
                            ?>

                            <?php if ($response != "[]") : ?>
                            <form action="" method="post">
                                <select name="agentid" onchange="this.form.submit();">
                            <?php
                            $response = json_decode($response, true);
                               foreach ($response as $key => $roxw) {
                                echo '<option value="'.$roxw["agentNumber"].'">'.$roxw["name"].'</option>';
                            }
                            ?>
                                </select>
                            </form>
                            <?php endif; ?>

                                <div id="scheduler"></div>
                            </div>
                            <script>
                                kendo.culture("pl-PL");
                                $(function() {
                                    $("#scheduler").kendoScheduler({
                                        date: new Date("<?php echo date("Y/m/d"); ?>"),
                                        startTime: new Date("<?php echo date("Y/m/d H:i:s"); ?>"),
                                        height: 600,
                                        views: [
                                            "day", {type: "workWeek"},
                                            "week", {type: "week"},
                                            "month", {type: "month", selected: true}
                                        ],
                                        editable: {
                                            confirmation: true,
                                            create: true,
                                            destroy: true,
                                            move: true,
                                            resize: true,
                                            template: $("#schedulerUTemplate").html()
                                        },
                                        timezone: "Europe/Warsaw",
                                        dataSource: {
                                            batch: true,
                                            transport: {
                                                read: {
                                                    <?php if ($agent_id) : ?>
                                                    url: "https://10.0.0.45/calendar/get/<?php echo api::encryptUrlValue($agent_id); ?>",
                                                    <?php else : ?>
                                                    url: "https://10.0.0.45/calendar/get/<?php echo api::encryptUrlValue($user_id); ?>",
                                                    <?php endif; ?>
                                                    dataType: "json",
                                                    type: "post"
                                                },
                                                update: {
                                                    <?php if ($agent_id) : ?>
                                                    url: "https://10.0.0.45/calendar/update/<?php echo api::encryptUrlValue($agent_id); ?>",
                                                    <?php else : ?>
                                                    url: "https://10.0.0.45/calendar/update/<?php echo api::encryptUrlValue($user_id); ?>",
                                                    <?php endif; ?>
                                                    dataType: "json",
                                                    type: "post"
                                                },
                                                create: {
                                                    <?php if ($agent_id) : ?>
                                                    url: "https://10.0.0.45/calendar/add/<?php echo api::encryptUrlValue($agent_id); ?>",
                                                    <?php else : ?>
                                                    url: "https://10.0.0.45/calendar/add/<?php echo api::encryptUrlValue($user_id); ?>",
                                                    <?php endif; ?>
                                                    dataType: "json",
                                                    type: "post"
                                                },
                                                destroy: {
                                                    <?php if ($agent_id) : ?>
                                                    url: "https://10.0.0.45/calendar/delete/<?php echo api::encryptUrlValue($agent_id); ?>",
                                                    <?php else : ?>
                                                    url: "https://10.0.0.45/calendar/delete/<?php echo api::encryptUrlValue($user_id); ?>",
                                                    <?php endif; ?>
                                                    dataType: "json",
                                                    type: "post"
                                                },
                                                parameterMap: function(options, operation) {
                                                    if (operation !== "read" && options.models) {
                                                        return {models: kendo.stringify(options.models)};
                                                    }
                                                }
                                            },
                                            schema: {
                                                model: {
                                                    id: "taskId",
                                                    fields: {
                                                        taskId: { from: "event_id", type: "number" },
                                                        title: { from: "title", defaultValue: "No title", validation: { required: true } },
                                                        start: { type: "date", from: "start_date" },
                                                        end: { type: "date", from: "end_date" },
                                                        description: { from: "description" },
                                                        isAllDay: { type: "boolean", from: "allDay" },
                                                        <?php if ($agent_id) : ?>
                                                        user_id: { from: "user_id", defaultValue: "<?php echo $agent_id; ?>" }
                                                        <?php else : ?>
                                                        user_id: { from: "user_id", defaultValue: "<?php echo $_SESSION["uzytkownik_login"]; ?>" }
                                                        <?php endif; ?>

                                                    }
                                                }
                                            },
                                        },

                                    });
                                });
                            </script>



































                        </div>
                        <div id="chart_div_struktura"></div>
                    </div>
                <?php } ?>
                <div id="error_msg" class="center"></div>
            </div>
        </div>
    </div>
    <div class="clear_b"></div>
</div>











<script id="schedulerUTemplate" type="text/x-kendo-template">
    <div class="k-edit-label"><label for="title">Nazwa</label></div>
    <div data-container-for="title" class="k-edit-field">
        <input type="text" class="k-input k-textbox" name="title" required="required" data-bind="value:title">
    </div>
    <div class="k-edit-label">
        <label for="start">Początek</label>
    </div>
    <div data-container-for="start" class="k-edit-field">
        <input type="text"
               data-role="datetimepicker"
               data-interval="15"
               data-type="date"
               data-bind="value:start,invisible:isAllDay"
               name="start"/>
        <input type="text" data-type="date" data-role="datepicker" data-bind="value:start,visible:isAllDay" name="start" />
        <span data-bind="text: startTimezone"></span>
        <span data-for="start" class="k-invalid-msg" style="display: none;"></span>
    </div>
    <div class="k-edit-label"><label for="end">Koniec</label></div>
    <div data-container-for="end" class="k-edit-field">
        <input type="text" data-type="date" data-role="datetimepicker" data-bind="value:end,invisible:isAllDay" name="end" data-datecompare-msg="End date should be greater than or equal to the start date" />
        <input type="text" data-type="date" data-role="datepicker" data-bind="value:end,visible:isAllDay" name="end" data-datecompare-msg="End date should be greater than or equal to the start date" />
        <span data-bind="text: endTimezone"></span>
        <span data-bind="text: startTimezone, invisible: endTimezone"></span>
        <span data-for="end" class="k-invalid-msg" style="display: none;"></span>
    </div>
    <div class="k-edit-label"><label for="isAllDay">Cały dzień</label></div>
    <div data-container-for="isAllDay" class="k-edit-field">
        <input type="checkbox" name="isAllDay" data-type="boolean" data-bind="checked:isAllDay">
    </div>
<?php /*    <div class="k-edit-label"><label for="recurrenceRule">Repeat</label></div>
    <div data-container-for="recurrenceRule" class="k-edit-field">
        <div data-bind="value:recurrenceRule" name="recurrenceRule" data-role="recurrenceeditor"></div>
    </div>
 */ ?>
    <div class="k-edit-label"><label for="description">Opis</label></div>
    <div data-container-for="description" class="k-edit-field">
        <textarea name="description" class="k-textbox" data-bind="value:description"></textarea>
    </div>
</script>




















<?php require_once($_SERVER ['DOCUMENT_ROOT'].'/footer.php'); ?>

