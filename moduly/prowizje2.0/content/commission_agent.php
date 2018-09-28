<link rel="stylesheet" href="<?php echo 'https://' . $_SERVER ['HTTP_HOST'] . '/moduly/prowizje2.0/styles/commission_agent.css'; ?>" type="text/css" />

<div id="commission_agent">
    <div class="commission_filter">
        <div class="row">
            <!--<div class="col-md-2">
                <input id="date_commission_agent_start" style="width: 100%" />
            </div>
            <div class="col-md-2">
                <input id="date_commission_agent_end" style="width: 100%" />
            </div>-->
            <div class="col-md-3">
                <input id="date_commission_agent" style="width: 100%" />
            </div>
            <div class="col-md-3">
                <input id="commission_type_agent" style="width: 100%" />
            </div>
            <div class="col-md-3">
                <button type="button" id="searchAgentCommissionButton" data-item="0">Wyszukaj</button>
            </div>
        </div>
    </div>
    <div id="agent_commission_grid"></div>
</div>