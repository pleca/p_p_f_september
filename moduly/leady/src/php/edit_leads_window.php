<!--
  Created by PhpStorm.
  User: mmedynski
  Date: 30.03.2018
  Time: 14:23
-->

<script id="agentListTemplate" type="text/x-kendo-template">
    <span>#: data.agentNumber # - #: data.name #</span>
</script>

<script id="editTemplate" type="text/x-kendo-template">

      <ul class="fieldlist">
          <li>
              <label for="simple-input" style="width: 100%; float:left;">Dane o zdarzeniu</label>
              <div style="width: 30%; float: left;">
                  <label for="simple-input" class="top_label">Data zdarzenia</label>
                  <input data-role="datepicker" id="datepickerStartAdd" name="StartEvent" data-format="yyyy-MM-dd" type="text" data-bind="value: StartEvent" style="width: 95%;"/></div>
              <div style="width: 30%; float: left;">
                  <label for="simple-input"  class="top_label">Przybliżona data zdarzenia</label>
                  <input data-role="datepicker" data-format="MMMM yyyy" data-start="year" data-depth="year" dateInput="true" name="ApproximateEventDate" type="text" data-bind="value: ApproximateEventDate" style="width: 100%;"/>
              </div>
          </li>
          <li>
              <label for="simple-input" style="width: 100%; float:left;">Miejsce zdarzenia</label>
              <div style="width: 33%; float: left;" id="province">
                  <label for="simple-input" class="top_label">Województwo</label>
                  <input id="province_list" name="EventProvince" data-bind="value: EventProvince" required validationMessage="To pole jest wymagane." style="width: 95% !important;"/>
                  <span class="k-invalid-msg" data-for="EventProvince"></span>
              </div>
              <div style="width: 34%; float: left;" id="district">
                  <label for="simple-input"  class="top_label">Powiat</label>
                  <input id="district_list" name="EventDistrict" data-bind="value: EventDistrict" class="district_option"required validationMessage="To pole jest wymagane." style="width: 95%;"/>
                  <span class="k-invalid-msg" data-for="EventDistrict"></span>
              </div>
              <div style="width: 33%; float: left;" id="commune">
                  <label for="simple-input"  class="top_label">Gmina</label>
                  <input id="commune_list" name="EventCommune" disabled="disabled" data-bind="value: EventCommune" style="width: 100%;"/>
              </div>
              <script type="text/javascript" src="./src/js/event_place.js"><\/script>
                  </li>
          <li>
              <label for="simple-input" style="width: 100%; float:left;">Dane poszkodowanego/zmarłego</label>
              <div style="width: 50%; float: left;">
                  <label for="simple-input" class="top_label">Imię</label>
                  <input style="width: 95%;" name="VictimFirstName" type="text" class="k-input k-textbox" data-bind="value: VictimFirstName" required validationMessage="To pole jest wymagane."/>
              </div>
              <div style="width: 50%; float: left;">
                  <label for="simple-input"  class="top_label">Nazwisko</label>
                  <input name="VictimLastName" type="text" class="k-input k-textbox" data-bind="value: VictimLastName" style="width: 100%;" required validationMessage="To pole jest wymagane."/>
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
                  <input name="VictimCity" type="text" class="k-input k-textbox" data-bind="value: VictimCity" style="width: 100%;"/>
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
                      <label for="simple-input">Dane o sprawie</label>
                      <div style="width: 25%; float: left;" id="unit">
                          <label for="simple-input"  class="top_label">Jednostka</label>
                          <select data-role="dropdownlist"
                          data-option-label="Wybierz jednostkę"
                          data-value-primitive="true"
                          data-filter="contains"
                          data-value-field="Id"
                          data-text-field="Name"
                          name="Unit"
                          data-bind="value: UnitID, source: type"
                          style="width: 95%;"
                          required validationMessage="To pole jest wymagane.">
                          </select>
                          <span class="k-invalid-msg" data-for="Unit"></span>
                      </div>
                      <script type="text/javascript" src="./src/js/get_unit.js"><\/script>

                      <div style="width: 25%; float: left;" id="basket">
                          <label for="simple-input"  class="top_label">Koszyk</label>
                          <select data-role="dropdownlist"
                          data-option-label="Wybierz koszyk"
                          data-value-primitive="true"
                          data-filter="contains"
                          data-value-field="Id"
                          data-text-field="Name"
                          name="Basket"
                          data-bind="value: BasketID, source: type"
                          style="width: 95%;" >
                          </select>
                          <span class="k-invalid-msg" data-for="Basket"></span>
                      </div>
                      <script type="text/javascript" src="./src/js/get_basket.js"><\/script>

                      <div style="width: 25%; float: left;" id="event_type">
                          <label for="simple-input"  class="top_label">Typ zdarzenia</label>
                          <select data-role="dropdownlist"
                          data-option-label="Wybierz koszyk"
                          data-value-primitive="true"
                          data-filter="contains"
                          data-value-field="Id"
                          data-text-field="Name"
                          name="EventType"
                          data-bind="value: EventTypeID, source: type"
                          style="width: 95%;" >
                      </select>
                      <span class="k-invalid-msg" data-for="EventType"></span>
                      </div>
                      <script type="text/javascript" src="./src/js/get_event_type.js"><\/script>

                      <div style="width: 25%; float: left;">
                      <label for="simple-input"  class="top_label">Ilość umów</label>
                        <input name="Contract" type="text" class="k-input k-textbox" style="width: 100%;"/>
                      </div>

        </li>
        <li style="clear: both;"></li>
        <li>
                      <div style="width: 34%; float: left;" id="status">
                      <label for="simple-input"  class="top_label">Status</label>
                      <select data-role="dropdownlist"
                          data-option-label="Wybierz status"
                          data-value-primitive="true"
                          data-filter="contains"
                          data-change=onStatusSelectEdit
                          data-value-field="Id"
                          data-text-field="Name"
                          name="Status"
                          data-bind="value: StatusID, source: type"
                          style="width: 95%;"
                          required validationMessage="To pole jest wymagane.">
                      </select>
                      <span class="k-invalid-msg" data-for="Status"></span>
                      </div>
                      <script type="text/javascript" src="./src/js/get_status.js"><\/script>

                      <div style="width: 33%; float: left;" id="status_auxiliary_edit" class="hide">
                      <label for="simple-input"  class="top_label">Status pomocniczy</label>
                      <select data-role="dropdownlist"
                          data-option-label="Wybierz status"
                          data-value-primitive="true"
                          data-filter="contains"
                          data-value-field="Id"
                          data-change=onStatusAuxiliarySelect
                          data-text-field="Name"
                          name="StatusAuxiliary"
                          data-bind="value: StatusAuxiliaryID, source: type"
                          style="width: 95%;" >
                      </select>
                      <span class="k-invalid-msg" data-for="StatusAuxiliary"></span>
                      </div>
                      <script type="text/javascript" src="./src/js/get_status_auxiliary.js"><\/script>

                      <div style="width: 33%; float: left;" id="competition" class="hide">
                      <label for="simple-input"  class="top_label">Konkurencja</label>
                      <select data-role="dropdownlist"
                          data-option-label="Wybierz konkurencję"
                          data-value-primitive="true"
                          data-filter="contains"
                          data-value-field="Id"
                          data-text-field="Name"
                          name="Competition"
                          data-bind="value: CompetitionID, source: type"
                          style="width: 100%;" >
                      </select>
                      <span class="k-invalid-msg" data-for="Competition"></span>
                      </div>
                      <script type="text/javascript" src="./src/js/get_competition.js"><\/script>

                </li>
                <li style="clear: both;"></li>
        <li>
            <label for="simple-textarea">Opis</label>
            <textarea id="simple-textarea" name="Description" class="k-textbox" style="width: 100%; height:120px;" required validationMessage="To pole jest wymagane."></textarea>
        </li>
        <li>
             <label for="simple-textarea">Komentarze</label>
             <div id="comment_list">
                  <div data-role="grid"
                       data-filterable="false"
                       data-editable="{'mode': 'inline'}"
                       data-toolbar="['create', 'save']"
                       data-columns="[
                                       { 'field': 'CommentDate', 'title': 'Data komentarza', 'width': 120, },
                                       { 'field': 'commentUserName', 'title': 'Twórca komentarza', 'width': 180, },
                                       { 'field': 'Comment', 'title': 'Komentarz' }
                                      ]"
                       data-bind="source: comments"
                       style="height: 200px" >
                  </div>
             </div>
             <script>



                var leadId = #: ID #;

                var viewModel = kendo.observable({
                    comments: new kendo.data.DataSource({
                        schema: {
                            model: {
                                id: "Id",
                                fields: {
                                    CommentDate: { type: "string", editable: false },
                                    commentUserName: { type: "string", editable: false },
                                    Comment: { type: "string" },
                                }
                            }
                        },
                        batch: true,
                        transport: {
                            read: {
                                type: "POST",
                                url: API_URL+"lead/get_comments",
                                dataType: "json"
                            },
                            update: {
                                type: "POST",
                                url: API_URL+"lead/edit_comment",
                                dataType: "json"
                            },
                            create: {
                                type: "POST",
                                url: API_URL+"lead/add_comment",
                                dataType: "json"
                            },
                            parameterMap: function(options) {

                                return {
                                    models: kendo.stringify(options.models),
                                    leadId: leadId,
                                    user: user,
                                    localization: localization
                                };
                            }
                        }
                    })
                });
                kendo.bind($("\#comment_list"), viewModel);
                <\/script>
        </li>
                  #if(przypisz_agenta){#

                  <li>
                  <label for="simple-textarea">Przypisz osobę do wybranego leada</label>
                  <div id="agent_number" style="width: 100%; float: left;">
                      <select data-role="dropdownlist"
                      data-option-label="Wybierz użytkownika"
                      data-value-primitive="true"
                      data-filter="contains"
                      data-template="agentListTemplate"
                      data-value-field="agentNumber"
                      data-text-field="name"
                      name="AgentNumber"
                      data-bind="value: AgentNumber, source: type"
                  class="width_100">
                          </select>
                          </div>
                          <script>

                      var dataSource = new kendo.data.DataSource({
                          transport: {
                              read: {
                                  type: "POST",
                                  url: API_URL+"agent/getdependentstructure/"+user,
                                  dataType: "json"
                              }
                          }
                      });

                      var viewModel = kendo.observable({
                          AgentNumber: null,
                          type: dataSource,
                      });

                      kendo.bind($("\#agent_number"), viewModel);
                  <\/script>
                      </li>

                  #}#

    </ul>

</script>
