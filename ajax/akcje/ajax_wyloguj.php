<?php
session_start();
session_destroy();

$arrayOut = array(
    'wyloguj' => true
);

echo json_encode($arrayOut);
return;