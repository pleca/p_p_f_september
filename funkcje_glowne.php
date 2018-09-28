<?php
mb_internal_encoding ( "UTF-8" );
function get_adres_strony() {
	return 'https://' . $_SERVER ['HTTP_HOST'] . '/';
}
function adres_strony() {
	echo 'https://' . $_SERVER ['HTTP_HOST'] . '/';
}
function default_css() {
	echo 'https://' . $_SERVER ['HTTP_HOST'] . '/css/style.css';
}
function mobile_css() {
	echo 'https://' . $_SERVER ['HTTP_HOST'] . '/css/mobile.css';
}
function tytul_strony($tytul) {
	echo '<div class="tytul_strony_b">';
	
	echo '</div>';
	echo '<div class="tytul_strony">';
	echo '<div class="czas_trwania_sesji" ><span class="odswierzSesje odswiez_sesje"></span><span class="czasTrwaniaSesjiZegar" data-czas_sesji="20">20 min. do zakończenia sesji</span></div>';
	echo '<p>' . $tytul . '</p>';
	
	echo '</div>';
	echo '<div id="powrot_do_glownej" class="col-md-12"><a href="https://' . $_SERVER ['HTTP_HOST'] . '/"><img src="https://' . $_SERVER ['HTTP_HOST'] . '/img/logo.png" /></a></div>';

}
function tytul_strony_bez_sesji($tytul) {
	echo '<div id="menu_mobile_logowanie"></div>';
	echo '<div class="tytul_strony_b">';
	
	echo '</div>';
	echo '<div class="mobile_opcje_logowania"><div class="mol_e"></div><div class="mol_e"></div><div class="mol_e"></div></div>';
	
	echo '<div class="tytul_strony">';
	echo '<p>' . $tytul . '</p>';
	
	echo '</div>';
	echo '<div id="powrot_do_glownej" class="col-md-12"><img src="https://' . $_SERVER ['HTTP_HOST'] . '/img/logo.png" /></div>';
}

if (! function_exists ( 'str_split' )) {
	function str_split($string, $len = 1) {
		if ($len < 1)
			return false;
		for($i = 0, $rt = Array (); $i < ceil ( strlen ( $string ) / $len ); $i ++)
			$rt [$i] = substr ( $string, $len * $i, $len );
		return ($rt);
	}
}

$slowa = Array (
		'minus',
		
		Array (
				'zero',
				'jeden',
				'dwa',
				'trzy',
				'cztery',
				'pięć',
				'sześć',
				'siedem',
				'osiem',
				'dziewięć' 
		),
		
		Array (
				'dziesięć',
				'jedenaście',
				'dwanaście',
				'trzynaście',
				'czternaście',
				'piętnaście',
				'szesnaście',
				'siedemnaście',
				'osiemnaście',
				'dziewiętnaście' 
		),
		
		Array (
				'dziesięć',
				'dwadzieścia',
				'trzydzieści',
				'czterdzieści',
				'pięćdziesiąt',
				'sześćdziesiąt',
				'siedemdziesiąt',
				'osiemdziesiąt',
				'dziewięćdziesiąt' 
		),
		
		Array (
				'sto',
				'dwieście',
				'trzysta',
				'czterysta',
				'pięćset',
				'sześćset',
				'siedemset',
				'osiemset',
				'dziewięćset' 
		),
		
		Array (
				'tysiąc',
				'tysiące',
				'tysięcy' 
		),
		
		Array (
				'milion',
				'miliony',
				'milionów' 
		),
		
		Array (
				'miliard',
				'miliardy',
				'miliardów' 
		),
		
		Array (
				'bilion',
				'biliony',
				'bilionów' 
		),
		
		Array (
				'biliard',
				'biliardy',
				'biliardów' 
		),
		
		Array (
				'trylion',
				'tryliony',
				'trylionów' 
		),
		
		Array (
				'tryliard',
				'tryliardy',
				'tryliardów' 
		),
		
		Array (
				'kwadrylion',
				'kwadryliony',
				'kwadrylionów' 
		),
		
		Array (
				'kwintylion',
				'kwintyliony',
				'kwintylionów' 
		),
		
		Array (
				'sekstylion',
				'sekstyliony',
				'sekstylionów' 
		),
		
		Array (
				'septylion',
				'septyliony',
				'septylionów' 
		),
		
		Array (
				'oktylion',
				'oktyliony',
				'oktylionów' 
		),
		
		Array (
				'nonylion',
				'nonyliony',
				'nonylionów' 
		),
		
		Array (
				'decylion',
				'decyliony',
				'decylionów' 
		) 
);
function odmiana($odmiany, $int) { // $odmiany = Array('jeden','dwa','pięć')
	$txt = $odmiany [2];
	if ($int == 1)
		$txt = $odmiany [0];
	$jednosci = ( int ) substr ( $int, - 1 );
	$reszta = $int % 100;
	if (($jednosci > 1 && $jednosci < 5) & ! ($reszta > 10 && $reszta < 20))
		$txt = $odmiany [1];
	return $txt;
}
function liczba($int) { // odmiana dla liczb < 1000
	global $slowa;
	$wynik = '';
	$j = abs ( ( int ) $int );
	
	if ($j == 0)
		return $slowa [1] [0];
	$jednosci = $j % 10;
	$dziesiatki = ($j % 100 - $jednosci) / 10;
	$setki = ($j - $dziesiatki * 10 - $jednosci) / 100;
	
	if ($setki > 0)
		$wynik .= $slowa [4] [$setki - 1] . ' ';
	
	if ($dziesiatki > 0)
		if ($dziesiatki == 1)
			$wynik .= $slowa [2] [$jednosci] . ' ';
		else
			$wynik .= $slowa [3] [$dziesiatki - 1] . ' ';
	
	if ($jednosci > 0 && $dziesiatki != 1)
		$wynik .= $slowa [1] [$jednosci] . ' ';
	return $wynik;
}
function slownie($int) {
	global $slowa;
	
	$in = preg_replace ( '/[^-\d]+/', '', $int );
	$out = '';
	
	if ($in {0} == '-') {
		$in = substr ( $in, 1 );
		$out = $slowa [0] . ' ';
	}
	
	$txt = str_split ( strrev ( $in ), 3 );
	
	if ($in == 0)
		$out = $slowa [1] [0] . ' ';
	
	for($i = count ( $txt ) - 1; $i >= 0; $i --) {
		$liczba = ( int ) strrev ( $txt [$i] );
		if ($liczba > 0)
			if ($i == 0)
				$out .= liczba ( $liczba ) . ' ';
			else
				$out .= ($liczba > 1 ? liczba ( $liczba ) . ' ' : '') . odmiana ( $slowa [4 + $i], $liczba ) . ' ';
	}
	return trim ( $out );
}
function mb_ucfirst($value) {
	$firstLetter = mb_strtoupper ( mb_substr ( $value, 0, 1 ), 'UTF-8' );
	$otherLetters = mb_substr ( $value, 1 );
	
	return $firstLetter . $otherLetters;
}
function gdzie_jestem($adres_url) {
	$au_array = explode ( '/', $adres_url );
	
	$aua_count = count ( $au_array );
	
	$au_array = array_diff ( $au_array, array (
			$au_array,
			0 
	) );
	
	if (end ( $au_array ) === '') {
		$gdzie_jestem_html = '
			<div class="gdzie_jestem">
				<a href="'.get_adres_strony().'strona_glowna"><p>Strona główna</p></a>
			</div>';
	} else {
		unset ( $au_array [$aua_count] );
		unset ( $au_array [$aua_count - 1] );
		unset ( $au_array [0] );
		
		foreach ( $au_array as $aua ) {
			$adres_url_rodzic = $adres_url_rodzic . '/' . $aua;
		}
		
		$gdzie_jestem_html = '
			<div class="gdzie_jestem">
				<a href="'.get_adres_strony().'strona_glowna"><p>Strona główna</p></a>
				<p class="ukosnik">/</p>
				<a href="'.get_adres_strony().$adres_url_rodzic . '"><p>' . end ( $au_array ) . '</p></a>
			</div>';
	}
	
	// $gdzie_jestem_html = print_r($au_array);
	
	return $gdzie_jestem_html;
}

/*kamyk 2017-01-12*/
function is_serialized( $data, $strict = true ) {
	// if it isn't a string, it isn't serialized.
	if ( ! is_string( $data ) ) {
		return false;
	}
	$data = trim( $data );
	if ( 'N;' == $data ) {
		return true;
	}
	if ( strlen( $data ) < 4 ) {
		return false;
	}
	if ( ':' !== $data[1] ) {
		return false;
	}
	if ( $strict ) {
		$lastc = substr( $data, -1 );
		if ( ';' !== $lastc && '}' !== $lastc ) {
			return false;
		}
	} else {
		$semicolon = strpos( $data, ';' );
		$brace     = strpos( $data, '}' );
		// Either ; or } must exist.
		if ( false === $semicolon && false === $brace )
			return false;
			// But neither must be in the first X characters.
			if ( false !== $semicolon && $semicolon < 3 )
				return false;
				if ( false !== $brace && $brace < 4 )
					return false;
	}
	$token = $data[0];
	switch ( $token ) {
		case 's' :
			if ( $strict ) {
				if ( '"' !== substr( $data, -2, 1 ) ) {
					return false;
				}
			} elseif ( false === strpos( $data, '"' ) ) {
				return false;
			}
			// or else fall through
		case 'a' :
		case 'O' :
			return (bool) preg_match( "/^{$token}:[0-9]+:/s", $data );
		case 'b' :
		case 'i' :
		case 'd' :
			$end = $strict ? '$' : '';
			return (bool) preg_match( "/^{$token}:[0-9.E-]+;$end/", $data );
	}
	return false;
}

function maybe_unserialize( $original ) {
	if ( is_serialized( $original ) ) // don't attempt to unserialize data that wasn't serialized going in
		return @unserialize( $original );
		return $original;
}

function maybe_serialize( $data ) {
	if ( is_array( $data ) || is_object( $data ) )
		return serialize( $data );

		// Double serialization is required for backward compatibility.
		// See https://core.trac.wordpress.org/ticket/12930
		// Also the world will end. See WP 3.6.1.
		if ( is_serialized( $data, false ) )
			return serialize( $data );

			return $data;
}

/*
function utf8_converter($array)
{
    array_walk_recursive($array, function(&$item, $key){
        $item = iconv ( "cp1250", "UTF-8", $item );
    });
    return $array;
}
*/
















