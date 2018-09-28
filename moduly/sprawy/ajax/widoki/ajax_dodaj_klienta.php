<?php
require_once($_SERVER ['DOCUMENT_ROOT'].'czy_zalogowany.php');


?>
<div class="tlo_ajax">
	<div class="zleceniodawca_formularz">
		<p >DANE KLIENTA (ZLECENIODAWCY)</p>
		<div class="zleceniodawca_formularz_imie zleceniodawca_formularz_element margin_r_20">
			<input placeholder="Imię" type="text" class="zleceniodawca_imie imie" tab="1"/>	
		</div>
		<div class="zleceniodawca_formularz_nazwisko zleceniodawca_formularz_element">
			<input placeholder="Nazwisko" type="text" class="zleceniodawca_nazwisko nazwisko" tab="2"/>	
		</div>
		<div class="clear_b"></div>
		<p >ADRES ZAMELDOWANIA ZLECENIODAWCY</p>
		<div class="zleceniodawca_formularz_ulica zleceniodawca_formularz_element margin_r_20">
			<input placeholder="Ulica" type="text" class="zleceniodawca_ulica" tab="3"/>	
		</div>
		<div class="zleceniodawca_formularz_nr_domu zleceniodawca_formularz_element margin_r_10">
			<input maxlength="12" size="12" placeholder="Nr domu" type="text" class="zleceniodawca_nr_domu" tab="4"/>	
		</div>
		<div class="zleceniodawca_formularz_nr_mieszkania zleceniodawca_formularz_element margin_r_10">
			<input maxlength="15" size="15" placeholder="Nr mieszkania" type="text" class="zleceniodawca_nr_mieszkania" tab="5"/>	
		</div>
		<div class="zleceniodawca_formularz_kod_pocztowy zleceniodawca_formularz_element ">
			<input maxlength="6" size="6" placeholder="Kod pocztowy" type="text" class="zleceniodawca_kod_pocztowy kod_pocztowy" tab="6" onkeyup="sprawdz_kod_pocztowy(this);"/>	
		</div>
		<div class="zleceniodawca_formularz_miejscowosc zleceniodawca_formularz_element margin_r_20 margin_t_10">
			<input placeholder="Miejscowość" type="text" class="zleceniodawca_miejscowosc" tab="7"/>	
		</div>
        <div class="clear_b"></div>
        <div class="pytanie_obcokrajowiec margin_b_10 margin_t_10">
        <p >Zleceniodawca jest obcokrajowcem </p>
        <div class="obcokrajowiec"> tak <p class="kratka tak"></p></div>
        <div class="obcokrajowiec"> nie <p class="kratka nie zaznaczone"></p></div>
        </div>
        <div class="clear_b "></div>
        <div class="dane_identyfikacyjne margin_b_10">
		<div class="zleceniodawca_formularz_pesel zleceniodawca_formularz_element margin_r_20 ">
			<input maxlength="11" size="11" placeholder="Pesel" type="text" class="zleceniodawca_pesel pesel" tab="8" onkeyup="sprawdz_pesel(this);" />	
		</div>
		<div class="zleceniodawca_formularz_seria_i_numer_dowodu zleceniodawca_formularz_element ">
			<input maxlength="9" size="9" placeholder="Seria i numer dowodu" type="text" class="zleceniodawca_seria_i_numer_dowodu numer_dowodu" tab="9" onkeyup="sprawdz_dowod(this);" />	
		</div>
        </div>
        <div class="dane_identyfikacyjne_obcokrajowca margin_b_10">
		<div class="zleceniodawca_formularz_pesel zleceniodawca_formularz_element margin_r_20 margin_t_10 ">
            <input maxlength="22" size="20" placeholder="Rodzaj dokumentu" type="text" class="poszkodowany_dokument dokument"/>	
        </div>
        <div class="zleceniodawca_formularz_seria_i_numer_dowodu zleceniodawca_formularz_element margin_t_10 ">
            <input maxlength="16" size="16" placeholder="Numer dokumentu" type="text" class="poszkodowany_numer_dokumentu" />	
        </div>
        </div>
		<div class="clear_b"></div>
		<p>DANE KONTAKTOWE ZLECENIODAWCY</p>
		<div class="zleceniodawca_formularz_email zleceniodawca_formularz_element  margin_r_20">
			<input maxlength="80" size="80" placeholder="Email" type="email" class="zleceniodawca_email email" tab="10"  />	
		</div>	
		<div class="zleceniodawca_formularz_telefon zleceniodawca_formularz_element ">
			<input maxlength="9" size="9" placeholder="Telefon" type="text" class="zleceniodawca_telefon" tab="11"  />	
		</div>
		<div class="clear_b"></div>	
	</div>

	<div id="klient_dodaj_nowy" class=" margin_t_10 zablokowane_pole_transparent">ZAPISZ KLIENTA</div>
</div>

























