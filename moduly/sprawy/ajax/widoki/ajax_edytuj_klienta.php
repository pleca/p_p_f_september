<?php
require_once($_SERVER ['DOCUMENT_ROOT'].'czy_zalogowany.php');

$klient_id = htmlspecialchars($_POST['klient_id']);


require_once($_SERVER ['DOCUMENT_ROOT'].'moduly/sprawy/db/funkcje_db.php');

$klient = sprawa_pobierz_klienta_po_id_dla_uzytkownika($klient_id, $_SESSION['uzytkownik_id']);


?>

<div class="tlo_ajax">
	<div class="zleceniodawca_formularz zf_edycja">
		<div class="zleceniodawca_formularz_naglowek" data-klient_id="<?php echo $klient['id']; ?>"><?php echo $klient['imie']; ?> <?php echo $klient['nazwisko']; ?> (<?php echo $klient['id']; ?>)<span class="edytuj klient_szczegoly_opcje_edytuj"></span></div>
		<p>DANE KLIENTA (ZLECENIODAWCY)</p>
		<div class="zleceniodawca_formularz_imie zleceniodawca_formularz_element margin_r_20 zablokowane_pole">
			<input placeholder="Imię" type="text" class="zleceniodawca_imie imie" tab="1" value="<?php echo $klient['imie']; ?>"/>	
		</div>
		<div class="zleceniodawca_formularz_nazwisko zleceniodawca_formularz_element zablokowane_pole ">
			<input placeholder="Nazwisko" type="text" class="zleceniodawca_nazwisko nazwisko" tab="2" value="<?php echo $klient['nazwisko']; ?>"/>	
		</div>
		<div class="clear_b"></div>
		<p >ADRES ZAMELDOWANIA ZLECENIODAWCY</p>
		<div class="zleceniodawca_formularz_ulica zleceniodawca_formularz_element margin_r_20 zablokowane_pole ">
			<input placeholder="Ulica" type="text" class="zleceniodawca_ulica" tab="3" value="<?php echo $klient['ulica']; ?>"/>	
		</div>
		<div class="zleceniodawca_formularz_nr_domu zleceniodawca_formularz_element margin_r_10 zablokowane_pole ">
			<input maxlength="12" size="12" placeholder="Nr domu" type="text" class="zleceniodawca_nr_domu" tab="4" value="<?php echo $klient['nr_domu']; ?>"/>	
		</div>
		<div class="zleceniodawca_formularz_nr_mieszkania zleceniodawca_formularz_element margin_r_10 zablokowane_pole ">
			<input maxlength="15" size="15" placeholder="Nr mieszkania" type="text" class="zleceniodawca_nr_mieszkania" tab="5" value="<?php echo $klient['nr_mieszkania']; ?>"/>	
		</div>
		<div class="zleceniodawca_formularz_kod_pocztowy zleceniodawca_formularz_element zablokowane_pole  ">
			<input maxlength="6" size="6" placeholder="Kod pocztowy" type="text" class="zleceniodawca_kod_pocztowy kod_pocztowy" value="<?php echo $klient['kod_pocztowy']; ?>" tab="6" onkeyup="sprawdz_kod_pocztowy(this);"/>	
		</div>
		<div class="zleceniodawca_formularz_miejscowosc zleceniodawca_formularz_element margin_r_20 margin_t_10 zablokowane_pole ">
			<input placeholder="Miejscowość" type="text" class="zleceniodawca_miejscowosc" tab="7" value="<?php echo $klient['miasto']; ?>"/>	
		</div>
        <div class="clear_b"></div>
        <div class="pytanie_obcokrajowiec  ">
	        <p >Zleceniodawca jest obcokrajowcem </p>
	        
	        <?php 
	        
	        	if($klient['czy_obcokrajowiec'] == '0'){
	        		echo '<div class="obcokrajowiec" style="display:none;" > tak <p class="kratka tak  "></p></div>';
	        		echo '<div class="obcokrajowiec"> nie <p class="kratka nie zaznaczone"></p></div>';
	        	}else{
	        		echo '<div class="obcokrajowiec"> tak <p class="kratka tak zaznaczone "></p></div>';
	        		echo '<div class="obcokrajowiec" style="display:none;"> nie <p class="kratka nie "></p></div>';
	        	}
	        
	        ?>
	       <div class="clear_b "></div>         
        </div>
        
        <div class="obcokrajowiec_dane_dok  dane_identyfikacyjne margin_b_10" style="display:<?php echo $klient['czy_obcokrajowiec'] == '0' ? 'block' : 'none' ; ?>;">
			<div class="zleceniodawca_formularz_pesel zleceniodawca_formularz_element margin_r_20  zablokowane_pole ">
				<input maxlength="11" size="11" placeholder="Pesel" type="text" class="zleceniodawca_pesel pesel" value="<?php echo $klient['pesel']; ?>" tab="8" onkeyup="sprawdz_pesel(this);" />	
			</div>
			<div class="zleceniodawca_formularz_seria_i_numer_dowodu zleceniodawca_formularz_element  zablokowane_pole ">
				<input maxlength="9" size="9" placeholder="Seria i numer dowodu" type="text" class="zleceniodawca_seria_i_numer_dowodu numer_dowodu" value="<?php echo $klient['dowod']; ?>" tab="9" onkeyup="sprawdz_dowod(this);" />	
			</div>
			<div class="clear_b "></div> 
        </div>
        <div class="obcokrajowiec_dane_dok dane_identyfikacyjne_obcokrajowca margin_b_10 zablokowane_pole"  style="display:<?php echo $klient['czy_obcokrajowiec'] == '1' ? 'block' : 'none' ; ?>;">
			<div class="zleceniodawca_formularz_pesel zleceniodawca_formularz_element margin_r_20   ">
	            <input maxlength="22" size="20" placeholder="Rodzaj dokumentu" type="text" class="poszkodowany_dokument dokument" value="<?php echo $klient['rodzaj_dokumentu']; ?>"/>	
	        </div>
	        <div class="zleceniodawca_formularz_seria_i_numer_dowodu zleceniodawca_formularz_element   zablokowane_pole ">
	            <input maxlength="16" size="16" placeholder="Numer dokumentu" type="text" class="poszkodowany_numer_dokumentu"  value="<?php echo $klient['nr_dokumentu']; ?>"/>	
	        </div>
	        <div class="clear_b "></div> 
        </div>

		<p>DANE KONTAKTOWE ZLECENIODAWCY</p>
		<div class="zleceniodawca_formularz_email zleceniodawca_formularz_element  margin_r_20 zablokowane_pole ">
			<input maxlength="80" size="80" placeholder="Email" type="email" class="zleceniodawca_email email" tab="10"  value="<?php echo $klient['email']; ?>" />	
		</div>	
		<div class="zleceniodawca_formularz_telefon zleceniodawca_formularz_element  zablokowane_pole ">
			<input maxlength="9" size="9" placeholder="Telefon" type="text" class="zleceniodawca_telefon" tab="11"  value="<?php echo $klient['telefon']; ?>" />	
		</div>
		<div class="clear_b"></div>	
	</div>

	<div id="klient_zapisz_zmiany" class="margin_t_10  ">ZAPISZ ZMIANY</div>
</div>























