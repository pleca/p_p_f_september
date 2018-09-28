<?php

if(!isset($_SERVER['HTTP_REFERER'])){
    session_start();
    session_destroy();
    header ( 'Location: http://'.$_SERVER ['HTTP_HOST'] );
    die();
}else{
    require('functions.js');
    require('functions_commission_agents.js');
    require('functions_commission_structure.js');
    require('functions_invoices.js');
}