<script id="invoiceSettingsTemplate" type="text/x-kendo-template">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12" >
                <label for="simple-input" style="font-size: 12px;">Podaj schemat numeracji</label>
                <input name="InvoiceSchema" id="InvoiceSchema" type="text" class="k-input k-textbox" style="width: 100%;"/>
            </div>
        </div>
        <div class="legend" style="font-size: 12px;">
            {nr} - kolejny własny numer definiowany każdorazowo </br>
            {dd} - dzień miesiąca w postaci dwucyfrowej </br>
            {DD} - dzień miesiąca bez zer </br>
            {mm} - miesiąc w postaci dwucyfrowej </br>
            {MM} - miesiąc bez zer </br>
            {rrrr} - rok w postaci czterocyfrowej </br>
            {RR} - rok w postaci dwucyfrowej </br>
        </div>
        <div class="row justify-content-md-center">
            <div class="col-md-4">
                <button type="button" id="saveSettings">Zapisz schemat</button>
            </div>
        </div>
    </div>

    <script>
        var settingsWindow = $("\#invoiceSettingsWindow").data("kendoWindow");

        $("\#saveSettings").kendoButton({
            click: onClickSaveSettingsInvoice
        });

        function onClickSaveSettingsInvoice(e) {
            $.ajax({
                url: API_URL + "Commission",
                type: 'POST',
                dataType: "json",
                data: {
                    'AgentNumber': user,
                    'InvoiceSchema': document.getElementsByName('InvoiceSchema')[0].value,
                }
            }).success(function (result) {
                settingsWindow.close();
            });
        }

    <\/script>

</script>