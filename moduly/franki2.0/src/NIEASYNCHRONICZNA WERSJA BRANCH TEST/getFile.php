<?php
require_once '../../../../konfiguracja/konfiguracja_Main.php';

if (!isset($_SERVER['HTTP_REFERER'])) {
    session_start();
    session_destroy();
    header('Location: https://'.$_SERVER ['HTTP_HOST']);
    die();
} else {
    $docid = $_GET['docid'];
    header('Location: '.API_URL.'frank/dowloaddocument/'.$docid);
}