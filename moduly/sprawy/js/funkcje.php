<?php
if (! isset ( $_SERVER ['HTTP_REFERER'] )) {
	session_start ();
	session_destroy ();
	header ( 'Location: http://' . $_SERVER ['HTTP_HOST'] );
	die ();
} else {
	require ('funkcje_klient_p1.js');
	require ('funkcje_klient.js');
	// require ('funkcje_klient_p1.js');
}

