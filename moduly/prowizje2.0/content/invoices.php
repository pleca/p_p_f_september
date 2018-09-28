<link rel="stylesheet" href="<?php echo 'https://' . $_SERVER ['HTTP_HOST'] . '/moduly/prowizje2.0/styles/invoices.css'; ?>" type="text/css" />

<div id="invoices">

    <div class="commission_filter">
        <div class="row">
            <div class="col-md-3">
                <input id="date_invoices" style="width: 100%" disabled/>
            </div>
            <div class="col-md-2">
                <input name="InvoiceNumber" id="InvoiceNumber" type="text" class="k-input k-textbox" style="width: 100%;"/>
            </div>
            <div class="col-md-3">
                <button type="button" id="createInvoicesButton" data-item="0">Generuj fakturę</button>
            </div>
            <div class="col-md-2"></div>
            <div class="col-md-2">
                <button type="button" id="settingsInvoicesButton" style="float:right;">Ustawienia faktury</button>
            </div>
        </div>
    </div>
    <div id="invoices_grid"></div>

</div>