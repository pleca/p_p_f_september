<link rel="stylesheet" href="<?php echo 'https://' . $_SERVER ['HTTP_HOST'] . '/moduly/prowizje2.0/styles/commission_structure.css'; ?>" type="text/css" />

<div id="commission_structure">
    <div class="commission_filter">
        <div class="row">
            <div class="col-md-3">
                <input id="date_commission_structure" title="monthpicker" style="width: 100%" />
            </div>
            <div class="col-md-3">
                <input id="commission_type_structure" style="width: 100%" />
            </div>
            <div class="col-md-3">
                <button type="button" id="searchStructureCommissionButton" data-item="0">Wyszukaj</button>
            </div>
        </div>
    </div>
    <div id="structure_commission_grid"></div>
</div>