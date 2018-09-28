<?php

if(!isset($_SERVER['HTTP_REFERER'])){
	session_start();
	session_destroy();
	header ( 'Location: http://'.$_SERVER ['HTTP_HOST'] );
	die();
}else{
    require_once('zmienneGlobalne.js');
	require_once('jquery.js');
	require_once('jquery-ui.js');
	require_once('wysiwyg-editor.js');
	require_once('wysiwyg.js');
    require_once('klasa_MainPanel.js');
    require_once('mainObslugaZdarzen.js');
    require_once('funkcje.js');
    require_once('lastConversationsMain.js');
}


