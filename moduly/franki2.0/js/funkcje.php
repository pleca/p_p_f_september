<?php

if (!isset($_SERVER['HTTP_REFERER'])) {
    session_start();
    session_destroy();
    header('Location: http://' . $_SERVER ['HTTP_HOST']);
    die();
} else {
    require('functions.js');
    require('functions_franc_calculator.js');
    require('functions_commission_calculator.js');
    require('functions_contract.js');
    require('functions_contract_list.js');
    require('functions_documents.js');
    require('functions_department.js');
    require('functions_presentations.js');
    require('functions_library.js');
    require('functions_videos.js');
}