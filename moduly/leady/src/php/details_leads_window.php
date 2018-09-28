<!--
  Created by PhpStorm.
  User: mmedynski
  Date: 30.03.2018
  Time: 14:23
-->
<div id="details_leads_window">
    <script id="detailsTemplate" type="text/x-kendo-template">

        <ul class="fieldlist printLead">

            <div class="pageHeader"></div>

            <li>
                <label for="simple-input" style="width: 100%; float:left;">Dane o zdarzeniu</label>
                <div style="width: 30%; float: left;">
                    <label for="simple-input" class="top_label">Data zdarzenia</label>
                    <input disabled name="StartEvent" type="text" class="k-input k-textbox" value="#= (kendo.toString(kendo.parseDate(StartEvent), 'yyyy-MM-dd') != null) ? kendo.toString(kendo.parseDate(StartEvent), 'yyyy-MM-dd') : '' #" style="width: 95%;"/></div>
                <div style="width: 30%; float: left;">
                    <label for="simple-input"  class="top_label">Przybliżona data zdarzenia</label>
                    <input disabled name="ApproximateEventDate" class="k-input k-textbox" type="text" value="#= (kendo.toString(kendo.parseDate(ApproximateEventDate), 'yyyy-MM-dd') != null) ? kendo.toString(kendo.parseDate(ApproximateEventDate), 'yyyy-MM-dd') : '' #" ApproximateEventDate" style="width: 100%;"/>
                </div>
            </li>
            <li>
                <label for="simple-input" style="width: 100%; float:left;">Miejsce zdarzenia</label>
                <div style="width: 33%; float: left;">
                    <label for="simple-input" class="top_label">Województwo</label>
                    <input disabled name="EventProvince" type="text" class="k-input k-textbox" value="#= EventProvince #" style="width: 95%;"/>
                </div>
                <div style="width: 34%; float: left;">
                    <label for="simple-input"  class="top_label">Powiat</label>
                    <input disabled name="EventDistrict" type="text" class="k-input k-textbox" value="#= EventDistrict #" style="width: 95%;"/>
                </div>
                <div style="width: 33%; float: left;">
                    <label for="simple-input"  class="top_label">Gmina</label>
                    <input disabled name="EventCommune" type="text" class="k-input k-textbox" value="#= EventCommune #" style="width: 100%;"/>
                </div>
            </li>
            <li>
                <label for="simple-input" style="width: 100%; float:left;">Dane poszkodowanego/zmarłego</label>
                <div style="width: 50%; float: left;">
                    <label for="simple-input" class="top_label">Imię</label>
                    <input disabled name="VictimFirstName" type="text" class="k-input k-textbox" value="#= VictimFirstName #" style="width: 95%;"/>
                </div>
                <div style="width: 50%; float: left;">
                    <label for="simple-input"  class="top_label">Nazwisko</label>
                    <input disabled name="VictimLastName" type="text" class="k-input k-textbox" value="#= VictimLastName #" style="width: 100%;"/>
                </div>
            </li>
            <li>
                <div style="width: 70%; float: left;">
                    <label for="simple-input" class="top_label">Ulica</label>
                    <input disabled name="VictimStreet" type="text" class="k-input k-textbox" value="#= VictimStreet #" style="width: 95%;"/>
                </div>
                <div style="width: 30%; float: left;">
                    <label for="simple-input"  class="top_label">Numer domu/mieszkania</label>
                    <input disabled name="VictimHome" type="text" class="k-input k-textbox" value="#= VictimHome #" style="width: 100%;"/>
                </div>
            </li>
            <li>
                <div style="width: 30%; float: left;">
                    <label for="simple-input" class="top_label">Kod pocztowy</label>
                    <input disabled name="VictimPostCode" type="text" class="k-input k-textbox" value="#= VictimPostCode #" style="width: 95%;"/>
                </div>
                <div style="width: 70%; float: left;">
                    <label for="simple-input"  class="top_label">Miejscowość</label>
                    <input disabled name="VictimCity" type="text" class="k-input k-textbox" value="#= VictimCity #" style="width: 100%;"/>
                </div>
            </li>
            <li>
                <div style="width: 35%; float: left;">
                    <label for="simple-input" class="top_label">Numer telefonu</label>
                    <input disabled name="VictimPhone" type="text" class="k-input k-textbox" value="#= (VictimPhone != null) ? VictimPhone : '' #" style="width: 95%;"/>
                </div>
                <div style="width: 30%; float: left;">
                    <label for="simple-input"  class="top_label">Wiek</label>
                    <input disabled name="VictimAge" type="text" class="k-input k-textbox" value="#= (VictimAge != 0) ? VictimAge : '' #" style="width: 95%;"/>
                </div>
                <div style="width: 35%; float: left;">
                    <label for="simple-input"  class="top_label">Pokrewieństwo</label>
                    <input disabled name="Relationship" type="text" class="k-input k-textbox" value="#= Relationship #" style="width: 100%;"/>
                </div>
            </li>
            <li style="clear: both;"></li>
            <li>
                <label for="simple-input" style="width: 100%; float:left;">Dane o sprawie</label>
                <div style="width: 25%; float: left;">
                    <label for="simple-input" class="top_label">Jednostka</label>
                    <input disabled name="Unit" type="text" class="k-input k-textbox" value="#= (Unit != null) ? Unit : '' #" style="width: 95%;"/>
                </div>
                <div style="width: 25%; float: left;">
                    <label for="simple-input"  class="top_label">Koszyk</label>
                    <input disabled name="Basket" type="text" class="k-input k-textbox" value="#= (Basket != null) ? Basket : '' #" style="width: 95%;"/>
                </div>
                <div style="width: 25%; float: left;">
                    <label for="simple-input"  class="top_label">Typ zdarzenia</label>
                    <input disabled name="EventType" type="text" class="k-input k-textbox" value="#= (EventType != null) ? EventType : '' #" style="width: 95%;"/>
                </div>
                <div style="width: 25%; float: left;">
                    <label for="simple-input"  class="top_label">Ilość umów</label>
                    <input disabled name="Contract" type="text" class="k-input k-textbox" value="#= (Contract != 0) ? Contract : '' #" style="width: 100%;"/>
                </div>
            </li>
            <li style="clear: both;"></li>
            <li>
                <div style="width: 34%; float: left; margin-bottom: 30px" id="status">
                    <label for="simple-input" class="top_label">Status</label>
                    <input disabled name="Status" type="text" class="k-input k-textbox" value="#= (Status != null) ? Status : '' #"/>
                </div>
                <div style="width: 33%; float: left;" id="status_auxiliary">
                    <label for="simple-input"  class="top_label">Status pomocniczy</label>
                    <input disabled name="StatusAuxiliary" type="text" class="k-input k-textbox" value="#= (StatusAuxiliary != undefined) ? StatusAuxiliary : '' #"/>
                </div>
                <div style="width: 33%; float: left;" id="status_competition">
                    <label for="simple-input"  class="top_label">Typ Konkurencja</label>
                    <input disabled name="Competition" type="text" class="k-input k-textbox" value="#= (Competition != undefined) ? Competition : '' #"/>
                </div>
            </li>
            <li style="clear: both;"></li>
            <li>
                <label for="simple-textarea">Opis</label>
                <textarea readonly="true" id="simple-textarea" name="Description" class="k-textbox descriptionText" style="width: 100%; height:120px" >#= Description #</textarea>
                <div class="descriptionTextPrint" style="width: 100%; height:auto; display:none;" >#= Description #</div>
            </li>
            <li>
                <label for="simple-textarea">Komentarze</label>
                <div id="comment_list">
                    <div data-role="grid"
                         data-filterable="false"
                         data-editable="false"
                         data-columns="[
                                        { 'field': 'CommentDate', 'title': 'Data komentarza', 'width': 120},
                                        { 'field': 'commentUserName', 'title': 'Twórca komentarza', 'width': 180, },
                                        { 'field': 'Comment', 'title': 'Komentarz' },
                                      ]"
                         data-bind="source: comments"
                         style="height: 200px">
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
                                        CommentDate: { type: "string" },
                                        commentUserName: { type: "string" },
                                        Comment: { type: "string" }
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
                                parameterMap: function(options) {
                                    return {
                                        models: kendo.stringify(options.models),
                                        leadId: leadId
                                    };
                                }
                            }
                        })
                    });
                    kendo.bind($("\#comment_list"), viewModel);
                    <\/script>
                    </li>
                    </ul>
                    <div class="k-edit-buttons k-state-default">
                        <a role="button" class="k-button k-button-icontext k-primary k-grid-print" href="\#"><span class="k-icon k-i-print"></span> Drukuj</a>
                    </div>
    </script>

</div>