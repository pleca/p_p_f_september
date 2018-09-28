<script id="commissionTemplate" type="text/x-kendo-template">
    <div id="commission_details">
                <div data-role="grid"
                     data-columns="[
                                 { 'field': 'CaseNumber', 'title': 'Numer sprawy' },
                                 { 'field': 'AgentNumber', 'title': 'Nr agenta' },
                                 { 'field': 'ManagerNumber', 'title': 'Nr kierownika' },
                                 { 'field': 'DirectorNumber', 'title': 'Nr dyrektora' },
                                 { 'field': 'ClientSurname', 'title': 'Nazwisko klienta' },
                                 { 'field': 'CompensationAmount', 'title': 'Kwota odszkodowania' },
                                 { 'field': 'AccountDate', 'title': 'Data wpływu' },
                                 { 'field': 'FeeNetto', 'title': 'Honorarium netto' },
                                 { 'field': 'CommissionBeforeDeduction', 'title': 'Prowizja (przed potrąceniem)' },
                                 { 'field': 'CommissionAfterDeduction', 'title': 'Prowizja po potrąceniu' },
                                 { 'field': 'CompensationNumber', 'title': 'Numer odszkodowania' },
                              ]"
                     data-bind="source: details"
                     style="height: 400px"></div>
        <script>
            var viewModel = kendo.observable({
                details: new kendo.data.DataSource({
                    transport: {
                        read: {
                            url: API_URL+"Commission/GetLinesForMonthWithMonthNumber/Agent/"+user+"/Month/#: data.month #/Year/#: data.year #",
                            dataType: "json"
                        }
                    }
                })
            });
            kendo.bind($("\#commission_details"), viewModel);
</script>
</div>

</script>