<?php
require_once($_SERVER ['DOCUMENT_ROOT'].'czy_zalogowany.php');

require_once($_SERVER ['DOCUMENT_ROOT'].'moduly/mailing/db/funkcje_db.php');

$lista_wyslanych = mailing_lista_wszystkich_wyslanych();

$lista_wyslanych_liczba = mysqli_num_rows($lista_wyslanych);

if($lista_wyslanych_liczba == 0){
	echo '<p>Brak wysłanych</p>';
	return false;
}

while ($lw = mysqli_fetch_assoc($lista_wyslanych)) {
	$lista_zalacznikow = json_decode(htmlspecialchars_decode($lw['lista_zalacznikow']));
	echo '<div class="mailing_wyslany_pojedynczy">';
	echo '<div class="mwp_temat">'.$lw['nadawca_imie_nazwisko'].' - '.$lw['temat'].' ('.$lw['data_wyslania'].')';
		echo ($lista_zalacznikow != null) ? '<span class="zalacznik"></span>' : '' ;
	echo '</div>';
	echo '<div class="mwp_informacje">';
	echo '<div class="mwpi_nadawca">'.$lw['nadawca_imie_nazwisko'].' ('.$lw['nadawca_email'].')</div>';
	echo '<div class="mwpi_tresc">'.htmlspecialchars_decode($lw['tresc']).'</div>';
	echo '<div class="mwpi_lista_odbiorcow">';
	$lista_odbiorcow = json_decode(htmlspecialchars_decode($lw['lista_odbiorcow']));
		
	$i=0;
	for($i=0;$i<count($lista_odbiorcow);$i++){


		if($lista_odbiorcow[$i]->status == '0'){
			echo '<div class="bledny_mail"><div class="bledny_mail_napis">'.$lista_odbiorcow[$i]->email.'</div><div class="mail_nie_wyslany_ikona"><div class="mail_nie_wyslany">'.$lista_odbiorcow[$i]->komunikat.'</div></div><div class="clear_b"></div></div>';

		}else{
			echo '<div class="poprawny_mail"><div class="poprawny_mail_napis">'.$lista_odbiorcow[$i]->email.'</div><div class="mail_wyslany_ikona" ><div class="mail_wyslany">Mail wysłany prawidłowo do: '.$lista_odbiorcow[$i]->email.'</div></div><div class="clear_b"></div></div>';
		}

	}
	echo '<div class="clear_b"></div>'			;
	echo '</div>';
	
	if($lista_zalacznikow != null){
	echo '<div class="mwpi_lista_zalacznikow">';
						
						$i=0;
					//	print_r($lista_zalacznikow);
						for($i=0;$i<count($lista_zalacznikow);$i++){
							
							echo '<div class="pojedynczy_zalacznik">';
									echo '<p><a href="pobierz_zalacznik.php?mailing_id='.$lw['id'].'&nazwa='.$lista_zalacznikow[$i]->src.'">'.$lista_zalacznikow[$i]->src.'</a></p>';
							echo '</div>';						
	
						}
						echo '<div class="clear_b"></div>';
				echo '</div>';
	}
	echo '<div data-mailing_id="'.$lw['id'].'" class="mailing_edytuj_widok wyslij_ponownie">WYŚLIJ PONOWNIE</div>';
	echo '</div>';
	
	


	echo '</div>';
}