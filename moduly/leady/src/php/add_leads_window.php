<!--
  Created by PhpStorm.
  User: mmedynski
  Date: 30.03.2018
  Time: 14:23
-->

<script id="agentListTemplate" type="text/x-kendo-template">
    <span>#: data.agentNumber # - #: data.name #</span>
</script>

<form id="add_leads_window">

    <ul class="fieldlist">

        <li>
            <label for="simple-input" style="width: 100%; float:left;">Dane o zdarzeniu</label>
            <div style="width: 30%; float: left;">
                <label for="simple-input" class="top_label">Data zdarzenia</label>
                <input id="datepickerStartAdd" name="StartEvent" data-format="yyyy-MM-dd" type="text" data-bind="value: StartEvent" style="width: 95%;"/></div>
            <div style="width: 30%; float: left;">
                <label for="simple-input"  class="top_label">Przybliżona data zdarzenia</label>
                <input data-role="datepicker" data-format="MMMM yyyy" data-start="year" data-depth="year" dateInput="true" name="ApproximateEventDate" type="text" data-bind="value: ApproximateEventDate" style="width: 100%;"/>
            </div>
        </li>
        <li>
            <label for="simple-input" style="width: 100%; float:left;">Miejsce zdarzenia</label>
            <div style="width: 33%; float: left;">
                <label for="simple-input" class="top_label">Województwo</label>
                <input id="province_list" name="EventProvince" data-bind="value: EventProvince" required validationMessage="To pole jest wymagane." style="width: 95% !important;"/>
                <span class="k-invalid-msg" data-for="EventProvince"></span>
            </div>
            <div style="width: 34%; float: left;">
                <label for="simple-input"  class="top_label">Powiat</label>
                <input id="district_list" name="EventDistrict" data-bind="value: EventDistrict" required validationMessage="To pole jest wymagane." style="width: 95%;"/>
                <span class="k-invalid-msg" data-for="EventDistrict"></span>
            </div>
            <div style="width: 33%; float: left;">
                <label for="simple-input"  class="top_label">Gmina</label>
                <input id="commune_list" name="EventCommune" data-bind="value: EventCommune" style="width: 100%;"/>
            </div>
        </li>
        <li>
            <label for="simple-input" style="width: 100%; float:left;">Dane poszkodowanego/zmarłego</label>
            <div style="width: 50%; float: left;">
                <label for="simple-input" class="top_label">Imię</label>
                <input name="VictimFirstName" style="width: 95%;" type="text" class="k-input k-textbox" data-bind="value: VictimFirstName" required validationMessage="To pole jest wymagane."/>
            </div>
            <div style="width: 50%; float: left;">
                <label for="simple-input"  class="top_label">Nazwisko</label>
                <input name="VictimLastName" style="width: 100%;" type="text" class="k-input k-textbox" data-bind="value: VictimLastName" required validationMessage="To pole jest wymagane."/>
            </div>
        </li>
        <li>
            <div style="width: 70%; float: left;">
                <label for="simple-input" class="top_label">Ulica</label>
                <input name="VictimStreet" type="text" class="k-input k-textbox" data-bind="value: VictimStreet" style="width: 95%;"/>
            </div>
            <div style="width: 30%; float: left;">
                <label for="simple-input"  class="top_label">Numer domu/mieszkania</label>
                <input name="VictimHome" type="text" class="k-input k-textbox" data-bind="value: VictimHome" style="width: 100%;"/>
            </div>
        </li>
        <li>
            <div style="width: 30%; float: left;">
                <label for="simple-input" class="top_label">Kod pocztowy</label>
                <input name="VictimPostCode" type="text" class="k-input k-textbox" data-bind="value: VictimPostCode" style="width: 95%;"/>
            </div>
            <div style="width: 70%; float: left;">
                <label for="simple-input"  class="top_label">Miejscowość</label>
                <input name="VictimCity" type="text" class="k-input k-textbox" data-bind="value: VictimCity" required validationMessage="To pole jest wymagane." style="width: 100%;"/>
            </div>
        </li>
        <li>
            <div style="width: 35%; float: left;">
                <label for="simple-input" class="top_label">Numer telefonu</label>
                <input name="VictimPhone" type="text" class="k-input k-textbox" data-bind="value: VictimPhone" style="width: 95%;"/>
            </div>
            <div style="width: 30%; float: left;">
                <label for="simple-input"  class="top_label">Wiek</label>
                <input name="VictimAge" type="text" class="k-input k-textbox" data-bind="value: VictimAge" style="width: 95%;"/>
            </div>
            <div style="width: 35%; float: left;">
                <label for="simple-input"  class="top_label">Pokrewieństwo</label>
                <input name="Relationship" type="text" class="k-input k-textbox" data-bind="value: Relationship" style="width: 100%;"/>
            </div>
        </li>
        <li style="clear: both;"></li>
        <li>
            <label for="simple-input" style="width: 100%; float:left;">Dane o sprawie</label>
            <div style="width: 25%; float: left;" id="unit">
                <label for="simple-input" class="top_label">Jednostka</label>
                 <input id="unit_list" name="UnitID" data-bind="value: UnitID" required validationMessage="To pole jest wymagane." style="width: 95%;"/>
                <span class="k-invalid-msg" data-for="UnitID"></span>
            </div>
            <div style="width: 25%; float: left;" id="basket">
                <label for="simple-input"  class="top_label">Koszyk</label>
                <input id="basket_list" name="BasketID" data-bind="value: BasketID" style="width: 95%;"/>
            </div>
            <div style="width: 25%; float: left;" id="event_type">
                <label for="simple-input"  class="top_label">Typ zdarzenia</label>
                <input id="event_type_list" name="EventTypeID" data-bind="value: EventTypeID" style="width: 95%;"/>
            </div>
            <div style="width: 25%; float: left;">
                <label for="simple-input"  class="top_label">Ilość umów</label>
                <input name="Contract" type="text" class="k-input k-textbox" data-bind="value: Contract" style="width: 100%;"/>
            </div>
        </li>
        <li style="clear: both;"></li>
        <li>
            <div style="width: 34%; float: left; margin-bottom: 30px" id="status">
                <label for="simple-input" class="top_label">Status</label>
                <input id="status_list" name="StatusID" data-bind="value: StatusID" required validationMessage="To pole jest wymagane."/>
                <span class="k-invalid-msg" data-for="StatusID"></span>
            </div>
            <div style="width: 33%; float: left;" id="status_auxiliary" class="hide">
                <label for="simple-input"  class="top_label">Status pomocniczy</label>
                <input id="status_auxiliary_list" name="StatusAuxiliaryID" data-bind="value: StatusAuxiliaryID"/>
            </div>
            <div style="width: 33%; float: left;" id="status_competition" class="hide">
                <label for="simple-input"  class="top_label">Typ Konkurencja</label>
                <input id="status_competition_list" name="CompetitionID" data-bind="value: CompetitionID"/>
            </div>
        </li>
        <li style="clear: both;"></li>
        </li>
        <li>
            <label for="simple-textarea">Opis</label>
            <textarea id="simple-textarea" name="Description" class="k-textbox validate" data-bind="value: Description" style="width: 100%; height:120px;" required validationMessage="To pole jest wymagane."></textarea>
        </li>
        <li class="assign_director">
            <label for="simple-textarea">Dodaj wybranemu dyrektorowi/kierownikowi uprawnienie do leada</label>
            <div id="agent_number" style="width: 100%; float:left;">
                <input id="structur_list" name="AgentNumber" data-bind="value: AgentNumber" style="width: 100%; float:left;"/>
            </div>
        </li>

    </ul>

    <div class="k-edit-buttons k-state-default">
        <a role="button" id="create" data-bind="click: create" class="k-button k-button-icontext k-primary k-grid-update" href="#">Zapisz</a>
        <a role="button" id="close" data-bind="click: close" class="k-button k-button-icontext k-grid-cancel" href="#"><span class="k-icon k-i-cancel"></span>Anuluj</a>
    </div>
</form>

<script>

    $(document).ready(function() {


      $("#datepickerStartAdd").kendoDatePicker();
      $("#datepickerApproximate").kendoDatePicker({
        start: "year",
        depth: "year",
        format: "MMMM yyyy",
        dateInput: true
      });

      // STRUCTURE AGENT //

      var dependent_structure = new kendo.data.DataSource({
        transport: {
          read: {
            type: "POST",
            url: API_URL + "agent/getsuperior",
            dataType: "json"
          }
        }
      });

      $("#structur_list").kendoDropDownList({
        dataTextField: "name",
        dataValueField: "agentNumber",
        dataSource: dependent_structure,
        optionLabel: 'Wybierz',
        filter: "contains",
        template: $("#agentListTemplate").html(),
        valueTemplate: '<span id="data" data-name="#:name #" data-agentnumber="#:agentNumber #"">   #:agentNumber # - #: name # </span>',
        valuePrimitive: true
      });

      // PLACE //
      var province_key, district_key;

      $("#province_list").kendoDropDownList({
        dataTextField: "value",
        dataValueField: "value",
        dataSource: new kendo.data.DataSource({
          transport: {
            read: {
              type: "POST",
              url: API_URL + "address",
              dataType: "json"
            }
          }
        }),
        filter: "startswith",
        minLength: 1,
        valuePrimitive: true,
        select: function (e) {
          var dataItem = this.dataItem(e.item.index());
          province_key = dataItem.key;

          var district_list = new kendo.data.DataSource({
            transport: {
              read: {
                type: "POST",
                url: API_URL + "address/" + province_key,
                dataType: "json"
              }
            }
          });

          district_input.setDataSource(district_list)
          district_input.enable(true);

        }
      });

      $("#district_list").kendoAutoComplete({
        enable: false,
        dataTextField: "value",
        filter: "startswith",
        minLength: 1,
        valuePrimitive: true,
        select: function (e) {
          var dataItem = this.dataItem(e.item.index());
          district_key = dataItem.key;

          var commune_list = new kendo.data.DataSource({
            transport: {
              read: {
                type: "POST",
                url: API_URL + "address/" + province_key + "/" + district_key,
                dataType: "json"
              }
            }
          });

          commune_input.setDataSource(commune_list)
          commune_input.enable(true);
        }
      });

      var district_input = $("#district_list").data("kendoAutoComplete");

      $("#commune_list").kendoAutoComplete({
        enable: false,
        dataTextField: "value",
        filter: "startswith",
        minLength: 1,
        valuePrimitive: true
      });

      var commune_input = $("#commune_list").data("kendoAutoComplete");

      // UNIT //
      var unit = new kendo.data.DataSource({
        transport: {
          read: {
            type: "POST",
            url: API_URL + "lead/get_unit",
            dataType: "json"
          },
            parameterMap: function (data, type) {
                if(type = "read") {
                    return {
                        user: user
                    }
                }}
        }
      });
      $("#unit_list").kendoDropDownList({
        dataTextField: "Name",
        dataValueField: "Id",
        dataSource: unit,
        optionLabel: 'Wybierz',
        filter: "contains",
        valuePrimitive: true
      });

      // BASKET //
      var basket = new kendo.data.DataSource({
        transport: {
          read: {
            type: "POST",
            url: API_URL + "lead/get_basket",
            dataType: "json"
          }
        }
      });
      $("#basket_list").kendoDropDownList({
        dataTextField: "Name",
        dataValueField: "Id",
        dataSource: basket,
        optionLabel: 'Wybierz',
        filter: "contains",
        valuePrimitive: true
      });

      // EVENT TYPE //
      var event_type = new kendo.data.DataSource({
        transport: {
          read: {
            type: "POST",
            url: API_URL + "lead/get_event_type",
            dataType: "json"
          }
        }
      });
      $("#event_type_list").kendoDropDownList({
        dataTextField: "Name",
        dataValueField: "Id",
        dataSource: event_type,
        optionLabel: 'Wybierz',
        filter: "contains",
        valuePrimitive: true
      });

      // STATUS //

      var status = new kendo.data.DataSource({
        transport: {
          read: {
            type: "POST",
            url: API_URL + "lead/get_status",
            dataType: "json"
          }
        }
      });
      $("#status_list").kendoDropDownList({
        dataTextField: "Name",
        dataValueField: "Id",
        dataSource: status,
        optionLabel: 'Wybierz',
        change: onStatusSelectAdd,
        filter: "contains",
        valuePrimitive: true
      });

      // STATUS AUXILIARY//
      function onStatusSelectAdd () {
        if (($("#status_list").data("kendoDropDownList").value() == '5') || ($("#status_list").data("kendoDropDownList").value() == '6')) {
          $('#status_auxiliary').removeClass('hide')
          var statusAuxiliary = new kendo.data.DataSource({
            transport: {
              read: {
                type: "POST",
                url: API_URL + "lead/get_status_auxiliary",
                dataType: "json",
                data: {
                  status: $("#status_list").data("kendoDropDownList").value()
                }
              }
            }
          });
          $("#status_auxiliary_list").kendoDropDownList({
            dataTextField: "Name",
            dataValueField: "Id",
            dataSource: statusAuxiliary,
            optionLabel: 'Wybierz',
            change: onStatusAuxiliarySelectAdd,
            filter: "contains",
            valuePrimitive: true
          });
        } else if (!($('#status_auxiliary').hasClass('hide'))) {
          $('#status_auxiliary').addClass('hide');
        }

        if (!($('#status_competition').hasClass('hide')) && ($("#status_list").data("kendoDropDownList").value() != '5')) {
          $('#status_competition').addClass('hide')
        }
      }

      // STATUS COMPETITION //
      function onStatusAuxiliarySelectAdd () {
        console.log($("#status_auxiliary_list").data("kendoDropDownList").text());
        if (($("#status_auxiliary_list").data("kendoDropDownList").value() == '1') && ($("#status_auxiliary_list").data("kendoDropDownList").text() == "Konkurencja")) {
            $('#status_competition').removeClass('hide');

            var statusCompetition = new kendo.data.DataSource({
              transport: {
                read: {
                  type: "POST",
                  url: API_URL + "lead/get_competition",
                  dataType: "json",
                }
              }
            });
            $("#status_competition_list").kendoDropDownList({
              dataTextField: "Name",
              dataValueField: "Id",
              dataSource: statusCompetition,
              optionLabel: 'Wybierz',
              filter: "contains",
              valuePrimitive: true
            });
        }else if(!($('#status_competition').hasClass('hide'))){
          $('#status_competition').addClass('hide');
        }
      }


        var viewModel = kendo.observable({

            close: function(e) {
                kendoWindow.data("kendoWindow").close();
            },
            create: function(e) {

                e.preventDefault();
                var validator = $("#add_leads_window").kendoValidator().data('kendoValidator');
                if (validator.validate()) {

                    var agentName = $('#data').data('name');
                    var agentNumber = $('#data').data('agentnumber');

                    $.ajax({
                        url: API_URL + 'lead/add_lead',
                        type: 'POST',
                        dataType: "json",
                        data: {
                            'AgentNumber': agentNumber ? agentNumber : null,
                            'AgentName': agentName ? agentName : null,
                            'User': user,
                            'StartEvent': kendo.toString(kendo.parseDate(this.get("StartEvent")), "yyyy-MM-dd"),
                            'VictimFirstName': (this.get("VictimFirstName")) ? this.get("VictimFirstName") : null,
                            'VictimLastName': (this.get("VictimLastName")) ? this.get("VictimLastName") : null,
                            'EventProvince': (this.get("EventProvince")) ? this.get("EventProvince") : null,
                            'EventDistrict': (this.get("EventDistrict")) ? this.get("EventDistrict") : null,
                            'EventCommune': (this.get("EventCommune")) ? this.get("EventCommune") : null,
                            'UnitID': (this.get("UnitID")) ? this.get("UnitID") : '0',
                            'BasketID': (this.get("BasketID")) ? this.get("BasketID") : '0',
                            'EventTypeID': (this.get("EventTypeID")) ? this.get("EventTypeID") : '0',
                            'StatusID': (this.get("StatusID")) ? this.get("StatusID") : '0',
                            'StatusAuxiliaryID': (this.get("StatusAuxiliaryID")) ? this.get("StatusAuxiliaryID") : '0',
                            'CompetitionID': (this.get("CompetitionID")) ? this.get("CompetitionID") : '0',
                            'Contract': (this.get("Contract")) ? this.get("Contract") : '0',
                            'Description': (this.get("Description")) ? this.get("Description") : null,
                            'ApproximateEventDate': kendo.toString(kendo.parseDate(this.get("ApproximateEventDate")), "yyyy-MM-dd"),
                            'VictimStreet': (this.get("VictimStreet")) ? this.get("VictimStreet") : null,
                            'VictimHome': (this.get("VictimHome")) ? this.get("VictimHome") : null,
                            'VictimPostCode': (this.get("VictimPostCode")) ? this.get("VictimPostCode") : null,
                            'VictimCity': (this.get("VictimCity")) ? this.get("VictimCity") : null,
                            'VictimPhone': (this.get("VictimPhone")) ? this.get("VictimPhone") : null,
                            'VictimAge': (this.get("VictimAge")) ? this.get("VictimAge") : '0',
                            'Relationship': (this.get("Relationship")) ? this.get("Relationship") : null
                        },
                        success: function (result){
                            kendoGridAll.data("kendoGrid").dataSource.read();
                            kendoGridUser.data("kendoGrid").dataSource.read();
                            kendoGridStruct.data("kendoGrid").dataSource.read();
                            kendoGridManager.data("kendoGrid").dataSource.read();
                            kendoGridAll.data("kendoGrid").refresh();
                            kendoGridUser.data("kendoGrid").refresh();
                            kendoGridStruct.data("kendoGrid").refresh();
                            kendoGridManager.data("kendoGrid").refresh();
                        }
                    });


                    this.set("AgentNumber", '');
                    this.set("StartEvent", '');
                    this.set("VictimFirstName", '');
                    this.set("VictimLastName", '');
                    this.set("EventProvince", '');
                    this.set("EventDistrict", '');
                    this.set("EventCommune", '');
                    this.set("UnitID", '');
                    this.set("BasketID", '');
                    this.set("EventTypeID", '');
                    this.set("StatusID", '');
                    this.set("StatusAuxiliaryID", '');
                    this.set("CompetitionID", '');
                    this.set("Contract", '');
                    this.set("Description", '');
                    this.set("ApproximateEventDate", '');
                    this.set("VictimStreet", '');
                    this.set("VictimHome", '');
                    this.set("VictimPostCode", '');
                    this.set("VictimCity", '');
                    this.set("VictimPhone", '');
                    this.set("VictimAge", '');
                    this.set("Relationship", '');


                    /*setInterval(function () {
                        var grid = kendoGridAll.data("kendoGrid");
                        grid.dataSource.read();
                    }, 30000);*/

                    kendoWindow.data("kendoWindow").close();

                    //kendoGridAll.data("kendoGrid").dataSource.data.read();
                    //kendoGridAll.data("kendoGrid").refresh();

                }
            },
        });

        kendo.bind($("#add_leads_window"), viewModel);

    });
</script>
