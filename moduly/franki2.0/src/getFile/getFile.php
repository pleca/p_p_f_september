<?php
require_once '../../../../konfiguracja/konfiguracja_Main.php';

if (!isset($_SERVER['HTTP_REFERER'])) {
    session_start();
    session_destroy();
    header('Location: https://'.$_SERVER ['HTTP_HOST']);
    die();
} else {
    $uploaded_doc_id = $_GET['uploaded_doc_id'];
    header('Location: '.API_URL.'frank/dowloaddocument/'.$uploaded_doc_id);
}