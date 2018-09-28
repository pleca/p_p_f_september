<?php
require_once ($_SERVER ['DOCUMENT_ROOT'] . '/czy_zalogowany.php');

require_once ($_SERVER ['DOCUMENT_ROOT'] . 'moduly/sprawy/db/funkcje_db.php');
require_once ($_SERVER ['DOCUMENT_ROOT'] . 'db/function_db.php');

// $lista_klientow = pobierz_liste_klientow();

$lista_klientow = pobierz_liste_klientow_ze_sprawami ();
$lista_klientow_1 = pobierz_liste_klientow_ze_sprawami ();
$lista_klientow_2 = pobierz_liste_klientow_ze_sprawami ();

//$uprawnienie_do_zmiany_prowizji = sprawdz_uprawnienie ($_SESSION['uzytkownik_id'], '44');
$uprawnienie_do_umowy_bankowej = sprawdz_uprawnienie ($_SESSION['uzytkownik_id'], '44');

$sprawa = sprawa_pobierz_wszystkie_dane_po_id_sprawy ( $dokument_id );

$umowa_bankowa = sprawa_pokaz_szczegoly_umowy_bankowej ( $sprawa ['sprawa_umowa_bankowa_id'] );
$umowa = sprawa_pobierz_dane_umowy ( $sprawa ['sprawa_umowa_id'] );
$dochodzenie_roszczen = sprawa_pobierz_dochodzenie_roszczen ( $sprawa ['sprawa_dochodzenie_roszczen_id'] );

$klient = sprawa_pobierz_dane_klienta_dla_uzytkownika ( $sprawa ['sprawa_klient_id'] );
$klient_1 = sprawa_pobierz_dane_klienta_dla_uzytkownika ( $sprawa ['sprawa_klient_id'] );
$klient_2 = sprawa_pobierz_dane_klienta_dla_uzytkownika ( $sprawa ['sprawa_klient_2_id'] );
$id_klienta_1 = sprawa_pobierz_dane_klienta_dla_uzytkownika ( $sprawa ['sprawa_klient_id'] );
$id_klienta_2 = sprawa_pobierz_dane_klienta_dla_uzytkownika ( $sprawa ['sprawa_klient_2_id'] );



?>

<div id="id_druk_umowy" class="tlo_umowa druk_umowy">
	<div class="druk_umowy_strona">
		<div class="druk_umowy_strona_str_1 strona_umowy str_1">


			<div class="typ_szkody ">
				<p class="typ_szkody_naglowek_tresc margin_b_10">TYP SZKODY</p>
				<div class="szkoda" style="display:<?php echo ($sprawa ['sprawa_typ_szkody_id'] == '3') ? 'none' : 'block'; ?>">
					Obrażenia ciała
					<p data-komorka="sprawa_typ_szkody_id" data-wartosc="1"
						class="kratka obrazenia <?php echo ($sprawa['sprawa_typ_szkody_id'] == '1') ? 'zaznaczone' : ''; ?>"></p>
				</div>
				<div class="szkoda" style="display:<?php echo ($sprawa ['sprawa_typ_szkody_id'] == '3') ? 'none' : 'block'; ?>">
					Śmierć poszkodowanego
					<p data-komorka="sprawa_typ_szkody_id" data-wartosc="2"
						class="kratka smierc  <?php echo ($sprawa['sprawa_typ_szkody_id'] == '2') ? 'zaznaczone' : ''; ?>"></p>
				</div>

				<div class="szkoda"style="display:<?php echo (isset($uprawnienie_do_umowy_bankowej ['1'])) ? 'block' : 'none'; ?>">
					Roszczenia z umów bankowych
					<p data-komorka="sprawa_typ_szkody_id" data-wartosc="3"
						class="kratka bank typ_inne  <?php echo ($sprawa['sprawa_typ_szkody_id'] == '3') ? 'zaznaczone' : ''; ?>"></p>
				</div>

				<div class="clear_b "></div>
				<div class="inne_szkody margin_t_10"
					<?php echo ($sprawa['sprawa_typ_szkody_id'] == '3') ? 'style="display:block;"' : ''; ?>>
					<div class="szkoda">
						Szkoda w pojeździe
						<p data-komorka="sprawa_podtyp_szkody_id" data-wartosc="1"
							class="kratka pojazd  <?php echo ($sprawa['sprawa_podtyp_szkody_id'] == '1') ? 'zaznaczone' : ''; ?>"></p>
					</div>
					<div class="szkoda">
						Szkoda w budynku
						<p data-komorka="sprawa_podtyp_szkody_id" data-wartosc="2"
							class="kratka budynek  <?php echo ($sprawa['sprawa_podtyp_szkody_id'] == '2') ? 'zaznaczone' : ''; ?>"></p>
					</div>
					<div class="szkoda">
						Inna &nbsp;
						<p class="kratka inna_szkoda"></p>
					</div>
					<input type="text" name="" class="szkoda_uzupelniona"
						placeholder="Wpisz szkodę" />
					<div class="clear_b "></div>
				</div>


			</div>

			<div class="rodzaj_wypadku margin_t_10" style="display: block;">
				<p class="rodzaj_wypadku_naglowek_tresc margin_b_10">RODZAJ WYPADKU</p>
				<div class="rodzaj">
					Komunikacyjny
					<p data-komorka="sprawa_rodzaj_wypadku_id" data-wartosc="1"
						class="kratka komunikacyjny  <?php echo ($sprawa['sprawa_rodzaj_wypadku_id'] == '1') ? 'zaznaczone' : ''; ?>"></p>
				</div>
				<div class="rodzaj">
					W rolnictwie
					<p data-komorka="sprawa_rodzaj_wypadku_id" data-wartosc="2"
						class="kratka w_rolnictwie  <?php echo ($sprawa['sprawa_rodzaj_wypadku_id'] == '2') ? 'zaznaczone' : ''; ?>"></p>
				</div>
				<div class="rodzaj">
					Inny
					<p data-komorka="sprawa_rodzaj_wypadku_id" data-wartosc="3"
						class="kratka inne  <?php echo ($sprawa['sprawa_rodzaj_wypadku_id'] == '3') ? 'zaznaczone' : ''; ?>"></p>
				</div>
				<div class="clear_b "></div>
				<div class="inne_wypadki margin_t_10">
					<div class="rodzaj">
						W pracy
						<p class="kratka praca"></p>
					</div>
					<div class="rodzaj">
						Błąd medyczny
						<p class="kratka medyczny"></p>
					</div>
					<div class="rodzaj">
						Inna &nbsp;
						<p class="kratka inny_wypadek"></p>
					</div>
					<input type="text" name="" class="inny_rodzaj_wypadku"
						placeholder="Wpisz rodzaj" />
					<div class="clear_b "></div>
				</div>


			</div>
		</div>

		<div class="strona_umowy str_2 mop">
            
            <?php
												if (! empty ( $klient ['pesel'] )) {
													
													$rok = substr ( $klient ['pesel'], 0, 2 );
													$miesiac = substr ( $klient ['pesel'], 2, - 7 );
													$dzien = substr ( $klient ['pesel'], 4, - 5 );
													
													if ($miesiac < 13) {
														$miesiac = $miesiac;
														$rok = '19' . $rok;
													} else if ($miesiac > 12) {
														$miesiac = $miesiac - 20;
														$rok = '20' . $rok;
													}
													$dzsiaj_rok = date ( 'Y' );
													$dzsiaj_miesiac = date ( 'm' );
													$data_urodzenia = $dzien . '-' . $miesiac . '-' . $rok;
													
													$$wiek = floor ( ((($dzsiaj_rok * 12) + $dzsiaj_miesiac) - (($rok * 12) + $miesiac)) / 12 );
													
													/*
													 *
													 * $urodziny = new DateTime ( implode ( '-', array (
													 * ( int ) substr ( $klient ['pesel'], 0, 2 ) + 1800 + (((floor ( (( int ) $klient ['pesel'] {2}) / 2 ) + 1) % 5) * 100),
													 * substr ( $klient ['pesel'], 2, 2 ),
													 * substr ( $klient ['pesel'], 4, 2 )
													 * ) ) );
													 *
													 * $rok_urodzenia = $urodziny->format ( 'Y' );
													 * $dzsiaj_rok = date ( 'Y' );
													 * $miesiac_urodzenia = $urodziny->format ( 'm' );
													 * $dzsiaj_miesiac = date ( 'm' );
													 *
													 * $wiek = floor ( ((($dzsiaj_rok * 12) + $dzsiaj_miesiac) - (($rok_urodzenia * 12) + $miesiac_urodzenia)) / 12 );
													 */
												}
												
												$lista_jednostek = sprawa_pobierz_jednostki ();
												
												?>
            		<p>WYBIERZ KOD JEDNOSTKI</p>
			<select class="lista_jednostek_opcje ">
				<option
					<?php echo (!empty($sprawa['sprawa_jednostka_id'])) ? 'selected' : '' ; ?>
					class="select_opcja_d">Wybierz</option>
                                                            <?php
																																																												
																																																												while ( $lj = mysqli_fetch_assoc ( $lista_jednostek ) ) {
																																																													echo '<option id="' . $lj ['id'] . '" class="select_opcja" ';
																																																													if ($lj ['id'] == $sprawa ['sprawa_jednostka_id']) {
																																																														echo 'selected';
																																																													}
																																																													echo '>';
																																																													echo $lj ['kod_jednostki'] . ', ' . $lj ['nazwa'];
																																																													echo '</option>';
																																																												}
																																																												
																																																												?>
                                                    </select>

			<p>WYBIERZ KLIENTA Z LISTY</p>
			<select name="lista_klientow_opcje"
				class="lista_klientow_opcje lko_edycja">
				<option
					<?php if(empty($sprawa['sprawa_klient_id'])){ echo 'selected'; } ?>
					class="select_opcja_d">Wybierz</option>
                                                            <?php
																																																												
																																																												while ( $wiersz = mysqli_fetch_assoc ( $lista_klientow ) ) {
																																																													echo '<option id="' . $wiersz ['id'] . '" class="select_opcja" ';
																																																													if ($sprawa ['sprawa_klient_id'] == $wiersz ['id']) {
																																																														echo 'selected';
																																																													}
																																																													echo '>' . $wiersz ['id'] . ' - ' . $wiersz ['imie'] . ' ' . $wiersz ['nazwisko'] . ', ' . $wiersz ['pesel'] . ', ' . $wiersz ['dowod'] . '</option>';
																																																												}
																																																												
																																																												?>
                                                    </select>
			<p class="zleceniodawca_naglowek_tresc margin_t_10 margin_b_10">ZLECENIODAWCA</p>


			<div
				class="zleceniodawca_formularz klient_umowa margin_t_10 sprawa_klient_dane"
				data-klient_id="<?php echo $sprawa['sprawa_klient_id']; ?>"
				data-klient_wybrany_id="<?php echo $sprawa['sprawa_klient_id']; ?>">


				<div
					class="zleceniodawca_formularz_imie zleceniodawca_formularz_element margin_r_20 zablokowane_pole">
					<input placeholder="Imię" type="text"
						class="zleceniodawca_imie imie" tab="1"
						value="<?php echo $klient['imie']; ?>" />
				</div>
				<div
					class="zleceniodawca_formularz_nazwisko zleceniodawca_formularz_element zablokowane_pole margin_r_20">
					<input placeholder="Nazwisko" type="text"
						class="zleceniodawca_nazwisko nazwisko" tab="2"
						value="<?php echo $klient['nazwisko']; ?>" />
				</div>
				<div
					class="zleceniodawca_formularz_wiek zablokowane_pole zleceniodawca_formularz_element ">
					<input placeholder="Wiek" type="text" class="zleceniodawca_wiek"
						tab="2" value="<?php echo $wiek; ?>" />
				</div>
				<div class="clear_b"></div>
				<p class="margin_t_10">ADRES ZAMELDOWANIA ZLECENIODAWCY</p>
				<div
					class="zleceniodawca_formularz_ulica zleceniodawca_formularz_element margin_r_20 zablokowane_pole">
					<input placeholder="Ulica" type="text" class="zleceniodawca_ulica"
						tab="3" value="<?php echo $klient['ulica']; ?>" />
				</div>
				<div
					class="zleceniodawca_formularz_nr_domu zleceniodawca_formularz_element margin_r_10 zablokowane_pole">
					<input maxlength="12" size="12" placeholder="Nr domu" type="text"
						class="zleceniodawca_nr_domu" tab="4"
						value="<?php echo $klient['nr_domu']; ?>" />
				</div>
				<div
					class="zleceniodawca_formularz_nr_mieszkania zleceniodawca_formularz_element margin_r_10 zablokowane_pole">
					<input maxlength="15" size="15" placeholder="Nr mieszkania"
						type="text" class="zleceniodawca_nr_mieszkania" tab="5"
						value="<?php echo $klient['nr_mieszkania']; ?>" />
				</div>
				<div
					class="zleceniodawca_formularz_kod_pocztowy zleceniodawca_formularz_element zablokowane_pole">
					<input maxlength="6" size="6" placeholder="Kod pocztowy"
						type="text" class="zleceniodawca_kod_pocztowy kod_pocztowy"
						tab="6" onkeyup="sprawdz_kod_pocztowy(this);"
						value="<?php echo $klient['kod_pocztowy']; ?>" />
				</div>
				<div
					class="zleceniodawca_formularz_miejscowosc zleceniodawca_formularz_element margin_r_20 margin_t_10 zablokowane_pole">
					<input placeholder="Miejscowość" type="text"
						class="zleceniodawca_miejscowosc" tab="7"
						value="<?php echo $klient['miasto']; ?>" />
				</div>
				<div
					class="zleceniodawca_formularz_pesel zleceniodawca_formularz_element margin_r_20 margin_t_10 zablokowane_pole">

					<input maxlength="11" size="11"
						placeholder="<?php echo ($klient['czy_obcokrajowiec'] == '0') ? 'Pesel' : 'Rodzaj dokumentu'; ?>"
						type="text"
						class=<?php echo ($klient['czy_obcokrajowiec'] == '0') ? '"zleceniodawca_pesel pesel" onkeyup="sprawdz_pesel(this);" tab="8"' : '"poszkodowany_dokument dokument"'; ?>
						value="<?php echo ($klient['czy_obcokrajowiec'] == '0') ? $klient['pesel'] : $klient['rodzaj_dokumentu']; ?>" />
				</div>
				<div
					class="zleceniodawca_formularz_seria_i_numer_dowodu zleceniodawca_formularz_element margin_t_10 zablokowane_pole">
					<input maxlength="9" size="9"
						placeholder="<?php echo ($klient['czy_obcokrajowiec'] == '0') ? 'Seria i numer dowodu' : 'Numer dokumentu'; ?>"
						type="text"
						class=<?php echo ($klient['czy_obcokrajowiec'] == '0') ? '"zleceniodawca_seria_i_numer_dowodu numer_dowodu" onkeyup="sprawdz_dowod(this);" tab="9"' : '"poszkodowany_numer_dokumentu"'; ?>
						value="<?php echo ($klient['czy_obcokrajowiec'] == '0') ? $klient['dowod'] : $klient['nr_dokumentu']; ?>" />
				</div>
				<div class="clear_b"></div>
				<p class="margin_t_10">DANE KONTAKTOWE ZLECENIODAWCY</p>
				<div
					class="zleceniodawca_formularz_email zleceniodawca_formularz_element  margin_r_20 zablokowane_pole">
					<input placeholder="Email" type="text"
						class="zleceniodawca_email email" tab="10"
						value="<?php echo $klient['email']; ?>" />
				</div>
				<div
					class="zleceniodawca_formularz_telefon zleceniodawca_formularz_element zablokowane_pole">
					<input placeholder="Telefon" type="text"
						class="zleceniodawca_telefon" tab="11"
						value="<?php echo $klient['telefon']; ?>" />
				</div>
				<div class="clear_b margin_b_10"></div>

                <?php
                $adres_zameldowania = sprawa_pobierz_dane_z_tabeli_po_id('sprawa_adres', $klient['sprawa_adres_korespondencja_id']);
                ?>

				<p class="adres_kor_napis margin_b_10">ADRES DO KORESPONDENCJI</p>
				<div class="korespondencja obecny_klient">
					Taki jak zameldowania
					<p
						class="kratka <?php echo ($klient['sprawa_adres_zameldowania_id'] == $klient['sprawa_adres_korespondencja_id']) ? 'zaznaczone' : '' ; ?> "></p>
				</div>
				<div class="clear_b "></div>
				<div
					data-adres_kor_id="<?php echo $klient['sprawa_adres_korespondencja_id']; ?>"
					data-adres_zam_id="<?php echo $klient['sprawa_adres_zameldowania_id']; ?>"
					class="zleceniodawca_adres_kor_form adres_kor_form  margin_t_10"
					<?php echo ($klient['sprawa_adres_zameldowania_id'] == $klient['sprawa_adres_korespondencja_id']) ? '' : 'style="display:block;"' ; ?>>
					<div
						class="zleceniodawca_formularz_ulica zleceniodawca_formularz_element margin_r_20  ">
						<input placeholder="Ulica" type="text"
							class="zleceniodawca_ulica_kor"
							value="<?php echo ($klient['sprawa_adres_zameldowania_id'] == $klient['sprawa_adres_korespondencja_id']) ? '' : $adres_zameldowania['ulica']; ?>" />
					</div>
					<div
						class="zleceniodawca_formularz_nr_domu zleceniodawca_formularz_element margin_r_10  ">
						<input maxlength="12" size="12" placeholder="Nr domu" type="text"
							class="zleceniodawca_nr_domu_kor"
                               value="<?php echo ($klient['sprawa_adres_zameldowania_id'] == $klient['sprawa_adres_korespondencja_id']) ? '' : $adres_zameldowania['nr_domu']; ?>" />
					</div>
					<div
						class="zleceniodawca_formularz_nr_mieszkania zleceniodawca_formularz_element margin_r_10  ">
						<input maxlength="15" size="15" placeholder="Nr mieszkania"
							type="text" class="zleceniodawca_nr_mieszkania_kor"
                               value="<?php echo ($klient['sprawa_adres_zameldowania_id'] == $klient['sprawa_adres_korespondencja_id']) ? '' : $adres_zameldowania['nr_mieszkania']; ?>" />
					</div>
					<div
						class="zleceniodawca_formularz_kod_pocztowy zleceniodawca_formularz_element  ">
						<input maxlength="6" size="6" placeholder="Kod pocztowy"
							type="text" class="zleceniodawca_kod_pocztowy_kor kod_pocztowy"
							onkeyup="sprawdz_kod_pocztowy(this);"
                               value="<?php echo ($klient['sprawa_adres_zameldowania_id'] == $klient['sprawa_adres_korespondencja_id']) ? '' : $adres_zameldowania['kod_pocztowy']; ?>" />
					</div>
					<div
						class="zleceniodawca_formularz_miejscowosc zleceniodawca_formularz_element margin_r_20 margin_t_10 ">
						<input placeholder="Miejscowość" type="text"
							class="zleceniodawca_miejscowosc_kor"
                               value="<?php echo ($klient['sprawa_adres_zameldowania_id'] == $klient['sprawa_adres_korespondencja_id']) ? '' : $adres_zameldowania['miasto']; ?>" />
					</div>
					<div class="clear_b"></div>
					<div
						class="zapisz_adres_kor_na_sprawie margin_t_10 zablokowane_pole_transparent">ZAPISZ
						ADRES</div>
				</div>
			</div>


			<div id="zapisz_strone_2" class="zapisz_str_2"
				class=" margin_t_10 zablokowane_pole_transparent">ZAPISZ ZMIANY
				DALEJ</div>



		</div>


		<div class="strona_umowy str_2_b umowa_bankowa">

                    <?php
																				
																				$lista_jednostek = sprawa_pobierz_jednostki ();
																				
																				?>
                        <p>WYBIERZ KOD JEDNOSTKI</p>
			<select class="lista_jednostek_opcje">
				<option
					<?php echo (!empty($sprawa['sprawa_jednostka_id'])) ? 'selected' : '' ; ?>
					class="select_opcja_d">Wybierz</option>
                            <?php
																												
																												while ( $lj = mysqli_fetch_assoc ( $lista_jednostek ) ) {
																													echo '<option id="' . $lj ['id'] . '" class="select_opcja" ';
																													if ($lj ['id'] == $sprawa ['sprawa_jednostka_id']) {
																														echo 'selected';
																													}
																													echo '>';
																													echo $lj ['kod_jednostki'] . ', ' . $lj ['nazwa'];
																													echo '</option>';
																												}
																												
																												?>
                        </select>


			<p class="zleceniodawca_naglowek_tresc margin_b_10">ZLECENIODAWCA I</p>

			<div class="zleceniodawca_formularz_b1 klient_umowa margin_t_10">
				<p>WYBIERZ KLIENTA Z LISTY</p>
				<select name="lista_klientow_opcje" class="lista_klientow_opcje_b1">
					<option
						<?php if(empty($sprawa['sprawa_klient_id'])){ echo 'selected'; } ?>
						class="select_opcja_d">Wybierz</option>
                                <?php
																																while ( $wiersz = mysqli_fetch_assoc ( $lista_klientow_1 ) ) {
																																	echo '<option id="' . $wiersz ['id'] . '" class="select_opcja" ';
																																	if ($sprawa ['sprawa_klient_id'] == $wiersz ['id']) {
																																		echo 'selected';
																																	}
																																	echo '>' . $wiersz ['id'] . ' - ' . $wiersz ['imie'] . ' ' . $wiersz ['nazwisko'] . ', ' . $wiersz ['pesel'] . ', ' . $wiersz ['dowod'] . '</option>';
																																}
																																
																																?>
                            </select>

				<p class="margin_t_10">DODAJ KLIENTA (ZLECENIODAWCY)</p>
				<div
					class="zleceniodawca_formularz_imie zleceniodawca_formularz_element margin_r_20 zablokowane_pole">
					<input placeholder="Imię" type="text"
						class="zleceniodawca_imie zl_imie_um_bank_1 imie" tab="1"
						value="<?php echo $klient_1['imie']; ?>" />
				</div>
				<div
					class="zleceniodawca_formularz_nazwisko zleceniodawca_formularz_element zablokowane_pole margin_r_20">
					<input placeholder="Nazwisko" type="text"
						class="zleceniodawca_nazwisko zl_nazwisko_um_bank_1 nazwisko"
						tab="2" value="<?php echo $klient_1['nazwisko']; ?>" />
				</div>
				<div
					class="zleceniodawca_formularz_wiek zablokowane_pole zleceniodawca_formularz_element ">
					<input placeholder="Wiek" type="text"
						class="zleceniodawca_wiek zl_wiek_um_bank_1" tab="2"
						value="<?php echo $klient_1[13]; ?>" />
				</div>
				<div class="clear_b"></div>
				<p class="margin_t_10">ADRES ZAMELDOWANIA ZLECENIODAWCY</p>
				<div
					class="zleceniodawca_formularz_ulica zleceniodawca_formularz_element margin_r_20 zablokowane_pole">
					<input placeholder="Ulica" type="text"
						class="zleceniodawca_ulica zl_ulica_um_bank_1" tab="3"
						value="<?php echo $klient_1['ulica']; ?>" />
				</div>
				<div
					class="zleceniodawca_formularz_nr_domu zleceniodawca_formularz_element margin_r_10 zablokowane_pole">
					<input maxlength="12" size="12" placeholder="Nr domu" type="text"
						class="zleceniodawca_nr_domu zl_nr_domu_um_bank_1" tab="4"
						value="<?php echo $klient_1['nr_domu']; ?>" />
				</div>
				<div
					class="zleceniodawca_formularz_nr_mieszkania zleceniodawca_formularz_element margin_r_10 zablokowane_pole">
					<input maxlength="15" size="15" placeholder="Nr mieszkania"
						type="text"
						class="zleceniodawca_nr_mieszkania zl_nr_mieszkania_um_bank_1"
						tab="5" value="<?php echo $klient_1['nr_mieszkania']; ?>" />
				</div>
				<div
					class="zleceniodawca_formularz_kod_pocztowy zleceniodawca_formularz_element zablokowane_pole">
					<input maxlength="6" size="6" placeholder="Kod pocztowy"
						type="text"
						class="zleceniodawca_kod_pocztowy zl_kod_pocztowy_um_bank_1 kod_pocztowy"
						tab="6" onkeyup="sprawdz_kod_pocztowy(this);"
						value="<?php echo $klient_1['kod_pocztowy']; ?>" />
				</div>
				<div
					class="zleceniodawca_formularz_miejscowosc zleceniodawca_formularz_element margin_r_20 margin_t_10 zablokowane_pole">
					<input placeholder="Miejscowość" type="text"
						class="zleceniodawca_miejscowosc zl_miejscowosc_um_bank_1" tab="7"
						value="<?php echo $klient_1['miasto']; ?>" />
				</div>
				<div
					class="zleceniodawca_formularz_pesel zleceniodawca_formularz_element margin_r_20 margin_t_10 zablokowane_pole">
					<input maxlength="11" size="11" placeholder="Pesel" type="text"
						class="zleceniodawca_pesel zl_pesel_um_bank_1 pesel" tab="8"
						onkeyup="sprawdz_pesel(this);"
						value="<?php echo $klient_1['pesel']; ?>" />
				</div>
				<div
					class="zleceniodawca_formularz_seria_i_numer_dowodu zleceniodawca_formularz_element margin_t_10 zablokowane_pole">
					<input maxlength="9" size="9" placeholder="Seria i numer dowodu"
						type="text"
						class="zleceniodawca_seria_i_numer_dowodu numer_dowodu zl_numer_dowodu_um_bank_1"
						tab="9" onkeyup="sprawdz_dowod(this);"
						value="<?php echo $klient_1['dowod_osobisty']; ?>" />
				</div>
				<div class="clear_b"></div>
				<p class="margin_t_10">DANE KONTAKTOWE ZLECENIODAWCY</p>
				<div
					class="zleceniodawca_formularz_email zleceniodawca_formularz_element  margin_r_20 zablokowane_pole">
					<input placeholder="Email" type="text"
						class="zleceniodawca_email zl_email_um_bank_1 email" tab="10"
						value="<?php echo $klient_1['email']; ?>" />
				</div>
				<div
					class="zleceniodawca_formularz_telefon zleceniodawca_formularz_element zablokowane_pole">
					<input placeholder="Telefon" type="text"
						class="zleceniodawca_telefon zl_telefon_um_bank_1" tab="11"
						value="<?php echo $klient_1['telefon_kom']; ?>" />
				</div>
				<div class="clear_b margin_b_10"></div>
				<p class="adres_kor_napis margin_b_10">ADRES DO KORESPONDENCJI</p>
				<div class="korespondencja obecny_klient b1_kor_ob">
					Taki jak zameldowania
					<p class="kratka zaznaczone "></p>
				</div>
				<div class="clear_b "></div>
				<div class="adres_kor_form margin_b_10 margin_t_10">
					<div
						class="zleceniodawca_formularz_ulica zleceniodawca_formularz_element margin_r_20  ">
						<input placeholder="Ulica" type="text"
							class="zleceniodawca_ulica_kor"
							value="<?php echo $klient_1['ulica']; ?>" />
					</div>
					<div
						class="zleceniodawca_formularz_nr_domu zleceniodawca_formularz_element margin_r_10  ">
						<input maxlength="12" size="12" placeholder="Nr domu" type="text"
							class="zleceniodawca_nr_domu_kor"
							value="<?php echo $klient_1['nr_domu']; ?>" />
					</div>
					<div
						class="zleceniodawca_formularz_nr_mieszkania zleceniodawca_formularz_element margin_r_10  ">
						<input maxlength="15" size="15" placeholder="Nr mieszkania"
							type="text" class="zleceniodawca_nr_mieszkania_kor"
							value="<?php echo $klient_1['nr_mieszkania']; ?>" />
					</div>
					<div
						class="zleceniodawca_formularz_kod_pocztowy zleceniodawca_formularz_element  ">
						<input maxlength="6" size="6" placeholder="Kod pocztowy"
							type="text" class="zleceniodawca_kod_pocztowy_kor kod_pocztowy"
							onkeyup="sprawdz_kod_pocztowy(this);"
							value="<?php echo $klient_1['kod_pocztowy']; ?>" />
					</div>
					<div
						class="zleceniodawca_formularz_miejscowosc zleceniodawca_formularz_element margin_r_20 margin_t_10 ">
						<input placeholder="Miejscowość" type="text"
							class="zleceniodawca_miejscowosc_kor"
							value="<?php echo $klient_1['miasto']; ?>" />
					</div>
					<div class="clear_b"></div>

				</div>
				<div class="instrukcja_dodaj_b1 margin_t_10 margin_b_10 akcja_dodawania">
					<span>DODAJ NOWEGO KLIENTA</span>
				</div>
			</div>

			<div class="zleceniodawca_formularz_dodaj_b1 margin_b_10">
				<p class="margin_t_10_b_5">DANE KLIENTA (ZLECENIODAWCY)</p>
				<div
					class="zleceniodawca_formularz_imie zleceniodawca_formularz_element margin_r_20">
					<input placeholder="Imię" type="text"
						class="zleceniodawca_imie_dodaj b1_imie_dodaj imie" tab="1" />
				</div>
				<div
					class="zleceniodawca_formularz_nazwisko zleceniodawca_formularz_element margin_r_20">
					<input placeholder="Nazwisko" type="text"
						class="zleceniodawca_nazwisko_dodaj b1_nazwisko_dodaj nazwisko"
						tab="2" />
				</div>
				<div class="clear_b"></div>
				<p class="margin_t_10_b_5">ADRES ZAMELDOWANIA ZLECENIODAWCY</p>
				<div
					class="zleceniodawca_formularz_ulica zleceniodawca_formularz_element margin_r_20">
					<input placeholder="Ulica" type="text"
						class="zleceniodawca_ulica_dodaj b1_ulica_dodaj" tab="3" />
				</div>
				<div
					class="zleceniodawca_formularz_nr_domu zleceniodawca_formularz_element margin_r_10">
					<input maxlength="12" size="12" placeholder="Nr domu" type="text"
						class="zleceniodawca_nr_domu_dodaj b1_nr_domu_dodaj" tab="4" />
				</div>
				<div
					class="zleceniodawca_formularz_nr_mieszkania zleceniodawca_formularz_element margin_r_10">
					<input maxlength="15" size="15" placeholder="Nr mieszkania"
						type="text"
						class="zleceniodawca_nr_mieszkania_dodaj b1_nr_mieszkania_dodaj"
						tab="5" />
				</div>
				<div
					class="zleceniodawca_formularz_kod_pocztowy zleceniodawca_formularz_element ">
					<input maxlength="6" size="6" placeholder="Kod pocztowy"
						type="text"
						class="zleceniodawca_kod_pocztowy_dodaj b1_kod_pocztowy_dodaj kod_pocztowy"
						tab="6" onkeyup="sprawdz_kod_pocztowy(this);" />
				</div>
				<div
					class="zleceniodawca_formularz_miejscowosc zleceniodawca_formularz_element margin_r_20 margin_t_10">
					<input placeholder="Miejscowość" type="text"
						class="zleceniodawca_miejscowosc_dodaj b1_miejscowosc_dodaj"
						tab="7" />
				</div>
				<div class="clear_b"></div>
				<div class="pytanie_obcokrajowiec margin_b_10 margin_t_10">
					<p>Zleceniodawca jest obcokrajowcem</p>
					<div class="obcokrajowiec zl_obc_um_bank_1 margin_t_0">
						tak
						<p class="kratka tak"></p>
					</div>
					<div class="obcokrajowiec zl_obc_um_bank_1 margin_t_0">
						nie
						<p class="kratka nie zaznaczone"></p>
					</div>
					<div class="clear_b "></div>
				</div>

				<div class="dane_identyfikacyjne margin_b_10">
					<div
						class="zleceniodawca_formularz_pesel zleceniodawca_formularz_element margin_r_20 ">
						<input maxlength="11" size="11" placeholder="Pesel" type="text"
							class="zleceniodawca_pesel_dodaj b1_pesel_dodaj pesel" tab="8"
							//onkeyup="sprawdz_pesel(this);" />
					</div>
					<div
						class="zleceniodawca_formularz_seria_i_numer_dowodu zleceniodawca_formularz_element ">
						<input maxlength="9" size="9" placeholder="Seria i numer dowodu"
							type="text"
							class="zleceniodawca_seria_i_numer_dowodu_dodaj b1_seria_i_numer_dowodu_dodaj numer_dowodu"
							tab="9" onkeyup="sprawdz_dowod(this);" />
					</div>
				</div>
				<div class="dane_identyfikacyjne_obcokrajowca margin_b_10">
					<div
						class="zleceniodawca_formularz_pesel zleceniodawca_formularz_element margin_r_20 ">
						<input maxlength="22" size="20" placeholder="Rodzaj dokumentu"
							type="text"
							class="zleceniodawca_dokument_dodaj b1_dokument_dodaj dokument" />
					</div>
					<div
						class="zleceniodawca_formularz_seria_i_numer_dowodu zleceniodawca_formularz_element ">
						<input maxlength="16" size="16" placeholder="Numer dokumentu"
							type="text"
							class="zleceniodawca_numer_dokumentu_dodaj b1_numer_dokumentu_dodaj" />
					</div>
				</div>
				<div class="clear_b"></div>
				<p class="margin_t_10_b_5">DANE KONTAKTOWE ZLECENIODAWCY</p>
				<div
					class="zleceniodawca_formularz_email zleceniodawca_formularz_element  margin_r_20">
					<input maxlength="80" size="80" placeholder="Email" type="email"
						class="zleceniodawca_email_dodaj b1_email_dodaj email" tab="10" />
				</div>
				<div
					class="zleceniodawca_formularz_telefon zleceniodawca_formularz_element ">
					<input maxlength="9" size="9" placeholder="Telefon" type="text"
						class="zleceniodawca_telefon_dodaj b1_telefon_dodaj" tab="11" />
				</div>
				<div class="clear_b"></div>
				<p class="adres_kor_napis margin_b_10 margin_t_10">ADRES DO
					KORESPONDENCJI</p>
				<div class="korespondencja margin_t_10">
					Taki jak zameldowania
					<p class="kratka korespondencja_adres b1_adres_kor zaznaczone"></p>
				</div>
				<div class="clear_b "></div>


				<div class="adres_kor_form margin_b_10 margin_t_10">
					<div
						class="zleceniodawca_formularz_ulica zleceniodawca_formularz_element margin_r_20  ">
						<input placeholder="Ulica" type="text"
							class="zleceniodawca_ulica_kor_dodaj b1_ulica_kor_dodaj"
							value="<?php echo $klient_1['ulica']; ?>" />
					</div>
					<div
						class="zleceniodawca_formularz_nr_domu zleceniodawca_formularz_element margin_r_10  ">
						<input maxlength="12" size="12" placeholder="Nr domu" type="text"
							class="zleceniodawca_nr_domu_kor_dodaj b1_nr_domu_kor_dodaj"
							value="<?php echo $klient_1['nr_domu']; ?>" />
					</div>
					<div
						class="zleceniodawca_formularz_nr_mieszkania zleceniodawca_formularz_element margin_r_10  ">
						<input maxlength="15" size="15" placeholder="Nr mieszkania"
							type="text"
							class="zleceniodawca_nr_mieszkania_kor_dodaj b1_nr_mieszkania_kor_dodaj"
							value="<?php echo $klient_1['nr_mieszkania']; ?>" />
					</div>
					<div
						class="zleceniodawca_formularz_kod_pocztowy zleceniodawca_formularz_element  ">
						<input maxlength="6" size="6" placeholder="Kod pocztowy"
							type="text"
							class="zleceniodawca_kod_pocztowy_kor_dodaj kod_pocztowy"
							b1_kod_pocztowy_kor_dodaj onkeyup="sprawdz_kod_pocztowy(this);"
							value="<?php echo $klient_1['kod_pocztowy']; ?>" />
					</div>
					<div
						class="zleceniodawca_formularz_miejscowosc zleceniodawca_formularz_element margin_r_20 margin_t_10 ">
						<input placeholder="Miejscowość" type="text"
							class="zleceniodawca_miejscowosc_kor_dodaj b1_miejscowosc_kor_dodaj"
							value="<?php echo $klient_1['miasto']; ?>" />
					</div>
					<div class="clear_b"></div>
				</div>
			</div>




			<p class="zleceniodawca_naglowek_tresc margin_b_10">ZLECENIODAWCA II</p>

			<div class="zleceniodawca_formularz_b2 klient_umowa margin_t_10">
				<p>WYBIERZ KLIENTA Z LISTY</p>
				<select name="lista_klientow_opcje" class="lista_klientow_opcje_b2">
					<option
						<?php if(empty($sprawa['sprawa_klient_2_id'])){ echo 'selected'; } ?>
						class="select_opcja_d">Wybierz</option>
                                <?php
																																while ( $wiersz = mysqli_fetch_assoc ( $lista_klientow_2 ) ) {
																																	echo '<option id="' . $wiersz ['id'] . '" class="select_opcja" ';
																																	if ($sprawa ['sprawa_klient_2_id'] == $wiersz ['id']) {
																																		echo 'selected';
																																	}
																																	echo '>' . $wiersz ['id'] . ' - ' . $wiersz ['imie'] . ' ' . $wiersz ['nazwisko'] . ', ' . $wiersz ['pesel'] . ', ' . $wiersz ['dowod'] . '</option>';
																																}
																																
																																?>
                            </select>

				<p class="margin_t_10">DODAJ KLIENTA (ZLECENIODAWCY)</p>
				<div
					class="zleceniodawca_formularz_imie zleceniodawca_formularz_element margin_r_20 zablokowane_pole">
					<input placeholder="Imię" type="text"
						class="zleceniodawca_imie imie zl_imie_um_bank_2" tab="1"
						value="<?php echo $klient_2['imie']; ?>" />
				</div>
				<div
					class="zleceniodawca_formularz_nazwisko zleceniodawca_formularz_element zablokowane_pole margin_r_20">
					<input placeholder="Nazwisko" type="text"
						class="zleceniodawca_nazwisko nazwisko zl_nazwisko_um_bank_2"
						tab="2" value="<?php echo $klient_2['nazwisko']; ?>" />
				</div>
				<div
					class="zleceniodawca_formularz_wiek zablokowane_pole zleceniodawca_formularz_element ">
					<input placeholder="Wiek" type="text"
						class="zleceniodawca_wiek zl_wiek_um_bank_2" tab="2"
						value="<?php echo $klient_2[13]; ?>" />
				</div>
				<div class="clear_b"></div>
				<p class="margin_t_10">ADRES ZAMELDOWANIA ZLECENIODAWCY</p>
				<div
					class="zleceniodawca_formularz_ulica zleceniodawca_formularz_element margin_r_20 zablokowane_pole">
					<input placeholder="Ulica" type="text"
						class="zleceniodawca_ulica zl_ulica_um_bank_2" tab="3"
						value="<?php echo $klient_2['ulica']; ?>" />
				</div>
				<div
					class="zleceniodawca_formularz_nr_domu zleceniodawca_formularz_element margin_r_10 zablokowane_pole">
					<input maxlength="12" size="12" placeholder="Nr domu" type="text"
						class="zleceniodawca_nr_domu zl_nr_domu_um_bank_2" tab="4"
						value="<?php echo $klient_2['nr_domu']; ?>" />
				</div>
				<div
					class="zleceniodawca_formularz_nr_mieszkania zleceniodawca_formularz_element margin_r_10 zablokowane_pole">
					<input maxlength="15" size="15" placeholder="Nr mieszkania"
						type="text"
						class="zleceniodawca_nr_mieszkania zl_nr_mieszkania_um_bank_2"
						tab="5" value="<?php echo $klient_2['nr_mieszkania']; ?>" />
				</div>
				<div
					class="zleceniodawca_formularz_kod_pocztowy zleceniodawca_formularz_element zablokowane_pole">
					<input maxlength="6" size="6" placeholder="Kod pocztowy"
						type="text"
						class="zleceniodawca_kod_pocztowy kod_pocztowy zl_kod_pocztowy_um_bank_2"
						tab="6" onkeyup="sprawdz_kod_pocztowy(this);"
						value="<?php echo $klient_2['kod_pocztowy']; ?>" />
				</div>
				<div
					class="zleceniodawca_formularz_miejscowosc zleceniodawca_formularz_element margin_r_20 margin_t_10 zablokowane_pole">
					<input placeholder="Miejscowość" type="text"
						class="zleceniodawca_miejscowosc zl_miejscowosc_um_bank_2" tab="7"
						value="<?php echo $klient_2['miasto']; ?>" />
				</div>
				<div
					class="zleceniodawca_formularz_pesel zleceniodawca_formularz_element margin_r_20 margin_t_10 zablokowane_pole">
					<input maxlength="11" size="11" placeholder="Pesel" type="text"
						class="zleceniodawca_pesel pesel zl_pesel_um_bank_2" tab="8"
						onkeyup="sprawdz_pesel(this);"
						value="<?php echo $klient_2['pesel']; ?>" />
				</div>
				<div
					class="zleceniodawca_formularz_seria_i_numer_dowodu zleceniodawca_formularz_element margin_t_10 zablokowane_pole">
					<input maxlength="9" size="9" placeholder="Seria i numer dowodu"
						type="text"
						class="zleceniodawca_seria_i_numer_dowodu numer_dowodu zl_numer_dowodu_um_bank_2"
						tab="9" onkeyup="sprawdz_dowod(this);"
						value="<?php echo $klient_2['dowod_osobisty']; ?>" />
				</div>
				<div class="clear_b"></div>
				<p class="margin_t_10">DANE KONTAKTOWE ZLECENIODAWCY</p>
				<div
					class="zleceniodawca_formularz_email zleceniodawca_formularz_element  margin_r_20 zablokowane_pole">
					<input placeholder="Email" type="text"
						class="zleceniodawca_email email zl_email_um_bank_2" tab="10"
						value="<?php echo $klient_2['email']; ?>" />
				</div>
				<div
					class="zleceniodawca_formularz_telefon zleceniodawca_formularz_element zablokowane_pole">
					<input placeholder="Telefon" type="text"
						class="zleceniodawca_telefon zl_telefon_um_bank_2" tab="11"
						value="<?php echo $klient_2['telefon_kom']; ?>" />
				</div>
				<div class="clear_b margin_b_10"></div>
				<p class="adres_kor_napis margin_b_10">ADRES DO KORESPONDENCJI</p>
				<div class="korespondencja obecny_klient">
					Taki jak zameldowania
					<p class="kratka zaznaczone "></p>
				</div>
				<div class="clear_b "></div>
				<div class="adres_kor_form margin_b_10 margin_t_10">
					<div
						class="zleceniodawca_formularz_ulica zleceniodawca_formularz_element margin_r_20  ">
						<input placeholder="Ulica" type="text"
							class="zleceniodawca_ulica_kor zl_ulica_um_bank_2"
							value="<?php echo $klient_2['ulica']; ?>" />
					</div>
					<div
						class="zleceniodawca_formularz_nr_domu zleceniodawca_formularz_element margin_r_10  ">
						<input maxlength="12" size="12" placeholder="Nr domu" type="text"
							class="zleceniodawca_nr_domu_kor zl_nr_domu_um_bank_2"
							value="<?php echo $klient_2['nr_domu']; ?>" />
					</div>
					<div
						class="zleceniodawca_formularz_nr_mieszkania zleceniodawca_formularz_element margin_r_10  ">
						<input maxlength="15" size="15" placeholder="Nr mieszkania"
							type="text"
							class="zleceniodawca_nr_mieszkania_kor zl_nr_mieszkania_um_bank_2"
							value="<?php echo $klient_2['nr_mieszkania']; ?>" />
					</div>
					<div
						class="zleceniodawca_formularz_kod_pocztowy zleceniodawca_formularz_element  ">
						<input maxlength="6" size="6" placeholder="Kod pocztowy"
							type="text"
							class="zleceniodawca_kod_pocztowy_kor kod_pocztowy zl_kod_pocztowy_um_bank_2"
							onkeyup="sprawdz_kod_pocztowy(this);"
							value="<?php echo $klient_2['kod_pocztowy']; ?>" />
					</div>
					<div
						class="zleceniodawca_formularz_miejscowosc zleceniodawca_formularz_element margin_r_20 margin_t_10 ">
						<input placeholder="Miejscowość" type="text"
							class="zleceniodawca_miejscowosc_kor zl_miejscowosc_um_bank_2"
							value="<?php echo $klient_2['miasto']; ?>" />
					</div>
					<div class="clear_b"></div>

				</div>
				<div class="instrukcja_dodaj_b2 margin_t_10 margin_b_10 akcja_dodawania">
					<span>DODAJ NOWEGO KLIENTA</span>
				</div>
			</div>

			<div class="zleceniodawca_formularz_dodaj_b2 margin_b_10">
				<p class="margin_t_10_b_5">DANE KLIENTA (ZLECENIODAWCY)</p>
				<div
					class="zleceniodawca_formularz_imie zleceniodawca_formularz_element margin_r_20">
					<input placeholder="Imię" type="text"
						class="zleceniodawca_imie_dodaj b2_imie_dodaj imie" tab="1" />
				</div>
				<div
					class="zleceniodawca_formularz_nazwisko zleceniodawca_formularz_element margin_r_20">
					<input placeholder="Nazwisko" type="text"
						class="zleceniodawca_nazwisko_dodaj b2_nazwisko_dodaj nazwisko"
						tab="2" />
				</div>
				<div class="clear_b"></div>
				<p class="margin_t_10_b_5">ADRES ZAMELDOWANIA ZLECENIODAWCY</p>
				<div
					class="zleceniodawca_formularz_ulica zleceniodawca_formularz_element margin_r_20">
					<input placeholder="Ulica" type="text"
						class="zleceniodawca_ulica_dodaj b2_ulica_dodaj" tab="3" />
				</div>
				<div
					class="zleceniodawca_formularz_nr_domu zleceniodawca_formularz_element margin_r_10">
					<input maxlength="12" size="12" placeholder="Nr domu" type="text"
						class="zleceniodawca_nr_domu_dodaj b2_nr_domu_dodaj" tab="4" />
				</div>
				<div
					class="zleceniodawca_formularz_nr_mieszkania zleceniodawca_formularz_element margin_r_10">
					<input maxlength="15" size="15" placeholder="Nr mieszkania"
						type="text"
						class="zleceniodawca_nr_mieszkania_dodaj b2_nr_mieszkania_dodaj"
						tab="5" />
				</div>
				<div
					class="zleceniodawca_formularz_kod_pocztowy zleceniodawca_formularz_element ">
					<input maxlength="6" size="6" placeholder="Kod pocztowy"
						type="text"
						class="zleceniodawca_kod_pocztowy_dodaj b2_kod_pocztowy_dodaj kod_pocztowy"
						tab="6" onkeyup="sprawdz_kod_pocztowy(this);" />
				</div>
				<div
					class="zleceniodawca_formularz_miejscowosc zleceniodawca_formularz_element margin_r_20 margin_t_10">
					<input placeholder="Miejscowość" type="text"
						class="zleceniodawca_miejscowosc_dodaj b2_miejscowosc_dodaj"
						tab="7" />
				</div>
				<div class="clear_b"></div>
				<div class="pytanie_obcokrajowiec margin_b_10 margin_t_10">
					<p>Zleceniodawca jest obcokrajowcem</p>
					<div class="obcokrajowiec zl_obc_um_bank_2 margin_t_0">
						tak
						<p class="kratka tak"></p>
					</div>
					<div class="obcokrajowiec zl_obc_um_bank_2 margin_t_0">
						nie
						<p class="kratka nie zaznaczone"></p>
					</div>
					<div class="clear_b "></div>
				</div>

				<div class="dane_identyfikacyjne margin_b_10">
					<div
						class="zleceniodawca_formularz_pesel zleceniodawca_formularz_element margin_r_20 ">
						<input maxlength="11" size="11" placeholder="Pesel" type="text"
							class="zleceniodawca_pesel_dodaj b2_pesel_dodaj pesel" tab="8"
							//onkeyup="sprawdz_pesel(this);" />
					</div>
					<div
						class="zleceniodawca_formularz_seria_i_numer_dowodu zleceniodawca_formularz_element ">
						<input maxlength="9" size="9" placeholder="Seria i numer dowodu"
							type="text"
							class="zleceniodawca_seria_i_numer_dowodu_dodaj b2_seria_i_numer_dowodu_dodaj numer_dowodu"
							tab="9" onkeyup="sprawdz_dowod(this);" />
					</div>
				</div>
				<div class="dane_identyfikacyjne_obcokrajowca margin_b_10">
					<div
						class="zleceniodawca_formularz_pesel zleceniodawca_formularz_element margin_r_20 ">
						<input maxlength="22" size="20" placeholder="Rodzaj dokumentu"
							type="text"
							class="zleceniodawca_dokument_dodaj b2_dokument_dodaj dokument" />
					</div>
					<div
						class="zleceniodawca_formularz_seria_i_numer_dowodu zleceniodawca_formularz_element ">
						<input maxlength="16" size="16" placeholder="Numer dokumentu"
							type="text"
							class="zleceniodawca_numer_dokumentu_dodaj b2_numer_dokumentu_dodaj" />
					</div>
				</div>
				<div class="clear_b"></div>
				<p class="margin_t_10_b_5">DANE KONTAKTOWE ZLECENIODAWCY</p>
				<div
					class="zleceniodawca_formularz_email zleceniodawca_formularz_element  margin_r_20">
					<input maxlength="80" size="80" placeholder="Email" type="email"
						class="zleceniodawca_email_dodaj email" tab="10" />
				</div>
				<div
					class="zleceniodawca_formularz_telefon zleceniodawca_formularz_element ">
					<input maxlength="9" size="9" placeholder="Telefon" type="text"
						class="zleceniodawca_telefon_dodaj" tab="11" />
				</div>
				<div class="clear_b"></div>
				<p class="adres_kor_napis margin_b_10 margin_t_10">ADRES DO
					KORESPONDENCJI</p>
				<div class="korespondencja b2_adres_kor margin_t_10">
					Taki jak zameldowania
					<p class="kratka korespondencja_adres zaznaczone"></p>
				</div>
				<div class="clear_b "></div>
				<div class="adres_kor_form margin_b_10 margin_t_10">
					<div
						class="zleceniodawca_formularz_ulica zleceniodawca_formularz_element margin_r_20  ">
						<input placeholder="Ulica" type="text"
							class="zleceniodawca_ulica_kor_dodaj b2_ulica_kor_dodaj"
							value="<?php echo $klient_2['ulica']; ?>" />
					</div>
					<div
						class="zleceniodawca_formularz_nr_domu zleceniodawca_formularz_element margin_r_10  ">
						<input maxlength="12" size="12" placeholder="Nr domu" type="text"
							class="zleceniodawca_nr_domu_kor_dodaj b2_nr_domu_kor_dodaj"
							value="<?php echo $klient_2['nr_domu']; ?>" />
					</div>
					<div
						class="zleceniodawca_formularz_nr_mieszkania zleceniodawca_formularz_element margin_r_10  ">
						<input maxlength="15" size="15" placeholder="Nr mieszkania"
							type="text"
							class="zleceniodawca_nr_mieszkania_kor_dodaj b2_nr_mieszkania_kor_dodaj"
							value="<?php echo $klient_2['nr_mieszkania']; ?>" />
					</div>
					<div
						class="zleceniodawca_formularz_kod_pocztowy zleceniodawca_formularz_element  ">
						<input maxlength="6" size="6" placeholder="Kod pocztowy"
							type="text"
							class="zleceniodawca_kod_pocztowy_kor_dodaj b2_kod_pocztowy_kor_dodaj kod_pocztowy"
							onkeyup="sprawdz_kod_pocztowy(this);"
							value="<?php echo $klient_2['kod_pocztowy']; ?>" />
					</div>
					<div
						class="zleceniodawca_formularz_miejscowosc zleceniodawca_formularz_element margin_r_20 margin_t_10 ">
						<input placeholder="Miejscowość" type="text"
							class="zleceniodawca_miejscowosc_kor_dodaj b2_miejscowosc_kor_dodaj"
							value="<?php echo $klient_2['miasto']; ?>" />
					</div>
					<div class="clear_b"></div>

				</div>
			</div>

			<div id="zapisz_strone_2_b1"
				class="zapisz_str_2_b1 zapisz_strone_zlec_1"
				class=" margin_t_10 zablokowane_pole_transparent">ZAPISZ I PRZEJDŹ
				DALEJ</div>



		</div>

		<div class="strona_umowy str_3_b umowa_bankowa">

			<p class="przedmiot_umowy_naglowek_tresc">DANE O KREDYCIE</p>

			<div class="przedmiot_umowy_naglowek_tresc_tresc margin_t_10">
				<div class="zgloszenie_wiersz_elementow">
					<p>Nazwa banku:</p>
					<input type="text" name="" class="nazwa_banku"
						placeholder="Nazwa banku"
						value="<?php echo $umowa_bankowa['nazwa_banku']; ?>" />
					<div class="clear_b"></div>
				</div>

				<div class="zgloszenie_wiersz_elementow">
					<p>Numer umowy:</p>
					<input type="text" name="" class="numer_umowy"
						placeholder="Numer umowy"
						value="<?php echo $umowa_bankowa['numer_umowy']; ?>" />
					<div class="clear_b"></div>
				</div>
			</div>

			<div id="zapisz_strone_3_b" class="zapisz_str_3_b"
				class=" margin_t_10 zablokowane_pole_transparent">ZAPISZ I PRZEJDŹ
				DALEJ</div>
		</div>



		<div class="strona_umowy str_4_b umowa_bankowa">

			<p class="lista_dokumentacji_naglowek_tresc">LISTA DOKUMENTACJI
				POBRANEJ OD KLIENTA</p>
			<div class="ista_dokumentacji_naglowek_tresc_tresc margin_t_10">
				<div class="zgloszenie_wiersz_elementow">
					<p>DOKUMENTACJA POBRANA OD KLIENTA:</p>
					<div class="clear_b"></div>
				</div>
				<div class="zgloszenie_wiersz_elementow">
					<p>
						<span
							class="kratka_2 dok_umowa <?php echo ($umowa_bankowa['umowa'] == '1') ? 'zaznaczone' : '' ; ?> "></span>
						Umowa z Klientem
					</p>
					<div class="clear_b"></div>
				</div>
				<div class="zgloszenie_wiersz_elementow">
					<p>
						<span
							class="kratka_2 dok_pelnomocnictwo <?php echo ($umowa_bankowa['pelnomocnictwo'] == '1') ? 'zaznaczone' : '' ; ?> "></span>
						Pełnomocnictwo
					</p>
					<div class="clear_b"></div>
				</div>
				<div class="zgloszenie_wiersz_elementow">
					<p>
						<span
							class="kratka_2 dok_dok_tozsam <?php echo ($umowa_bankowa['dowod_klienta'] == '1') ? 'zaznaczone' : '' ; ?> "></span>
						Kopia dokumentu tożsamości Klienta
					</p>
					<div class="clear_b"></div>
				</div>
				<div class="zgloszenie_wiersz_elementow">
					<p>
						<span
							class="kratka_2 dok_wniosek_kred <?php echo ($umowa_bankowa['wniosek'] == '1') ? 'zaznaczone' : '' ; ?> "></span>
						Kopia wniosku kredytowego
					</p>
					<div class="clear_b"></div>
				</div>
				<div class="zgloszenie_wiersz_elementow">
					<p>
						<span
							class="kratka_2 dok_umowa_kred <?php echo ($umowa_bankowa['umowa_z_bankiem'] == '1') ? 'zaznaczone' : '' ; ?> "></span>
						Kopia umowy kredytu bankowego wraz z aneksami (jeżeli takowe były
						zawierane)
					</p>
					<div class="clear_b"></div>
				</div>
				<div class="zgloszenie_wiersz_elementow">
					<p>
						<span
							class="kratka_2 dok_regulamin <?php echo ($umowa_bankowa['regulamin'] == '1') ? 'zaznaczone' : '' ; ?> "></span>
						Kopia Regulaminu udzielania kredytów i pożyczek hipotecznych
						załączonego do umowy kredytu bankowego
					</p>
					<div class="clear_b"></div>
				</div>
				<div class="zgloszenie_wiersz_elementow">
					<p>
						<span
							class="kratka_2 dok_tab_oplat <?php echo ($umowa_bankowa['tabela'] == '1') ? 'zaznaczone' : '' ; ?> "></span>
						Kopia Tabeli Opłat i Prowizji załączona do umowy kredytu bankowego
					</p>
					<div class="clear_b"></div>
				</div>
				<div class="zgloszenie_wiersz_elementow">
					<p>
						<span
							class="kratka_2 dok_harmonogram <?php echo ($umowa_bankowa['harmonogram'] == '1') ? 'zaznaczone' : '' ; ?> "></span>
						Kopia harmonogramu spłaty rat
					</p>
					<div class="clear_b"></div>
				</div>
				<div class="zgloszenie_wiersz_elementow">
					<p>
						<span
							class="kratka_2 dok_potwierdzenie <?php echo ($umowa_bankowa['potwierdzenia'] == '1') ? 'zaznaczone' : '' ; ?> "></span>
						Kopia potwierdzenia spłaty rat
					</p>
					<div class="clear_b"></div>
				</div>
				<div class="zgloszenie_wiersz_elementow">
					<p>
						<span
							class="kratka_2 dok_decyzje <?php echo ($umowa_bankowa['decyzje'] == '1') ? 'zaznaczone' : '' ; ?> "></span>
						Decyzje oraz pisma Banku w przedmiocie udzielonego kredytu
					</p>
					<div class="clear_b"></div>
				</div>
				<div class="zgloszenie_wiersz_elementow">
					<p>
						<span
							class="kratka_2 dok_potw_oplaty <?php echo ($umowa_bankowa['ubezpieczenie'] == '1') ? 'zaznaczone' : '' ; ?> "></span>
						Kopia potwierdzenia opłaty za ubezpieczenie
					</p>
					<div class="clear_b"></div>
				</div>


				<div class="zgloszenie_wiersz_elementow">
					<p>DODATKOWA DOKUMENTACJA W PRZYPADKU DOCHODZENIA ROSZCZENIA Z
						UDZIAŁEM WSPÓŁKREDYTOBIORCY:</p>
					<div class="clear_b"></div>
				</div>
				<div class="zgloszenie_wiersz_elementow">
					<p>
						<span
							class="kratka_2 dok_dok_tozsamosci_zlec_2 <?php echo ($umowa_bankowa['dowod_wspolkredytobiorcy'] == '1') ? 'zaznaczone' : '' ; ?> "></span>
						Kopia dokumentu tożsamości Współkredytobiorcy
					</p>
					<div class="clear_b"></div>
				</div>
				<div class="zgloszenie_wiersz_elementow">
					<p>
						<span
							class="kratka_2 dok_akt_malzenstwa <?php echo ($umowa_bankowa['akt_malzenstwa'] == '1') ? 'zaznaczone' : '' ; ?> "></span>
						Kopia odpisu skróconego aktu małżeństwa (w przypadku jego
						zawarcia)
					</p>
					<div class="clear_b"></div>
				</div>
			</div>


			<div id="zapisz_strone_4_b" class="zapisz_str_4_b"
				class=" margin_t_10 zablokowane_pole_transparent">ZAPISZ I PRZEJŹ
				DALEJ</div>
		</div>

		<div class="strona_umowy str_5_b umowa_bankowa">

			<p class="odpowiedzialnosc_zobowiazanego_naglowek_tresc">ODPOWIEDZIALNOŚĆ
				ZOBOWIĄZANEGO</p>

			<div
				class="odpowiedzialnosc_zobowiazanego_naglowek_tresc_tresc margin_t_10">
				<div class="zgloszenie_wiersz_elementow">
					<p>Czy zgłoszono roszczenie do banku o zwrot?</p>
					<p class="zlecono">
						<span
							class="kratka_2 zlecono_zwrot_tak <?php echo ($umowa_bankowa['czy_zgloszono_roszczenia'] == '1') ? 'zaznaczone' : '' ; ?> "></span>
						Tak
					</p>
					<p>
						<span
							class="kratka_2 zlecono_zwrot_nie <?php echo ($umowa_bankowa['czy_zgloszono_roszczenia'] == '0') ? 'zaznaczone' : '' ; ?> "></span>
						Nie
					</p>
					<div class="clear_b"></div>
				</div>
				<div class='opcje_przy_zgloszeniu'>
					<p>Wskaż jakie zgłoszono roszczenia</p>
					<div class="zgloszenie_wiersz_elementow">
						<p>
							<span
								class="kratka_2 nadplacone_raty <?php echo ($umowa_bankowa['indeksacja'] == '1') ? 'zaznaczone' : '' ; ?> "></span>
							nadpłaconych rat w związku z zastosowaną indeksacją
						</p>
						<div class="clear_b"></div>
					</div>
					<div class="zgloszenie_wiersz_elementow">
						<p>
							<span
								class="kratka_2 oplaty_ubep_pom <?php echo ($umowa_bankowa['ubezp_pomostowe'] == '1') ? 'zaznaczone' : '' ; ?> "></span>
							nienależnie pobranej opłaty w związku z likwidacją ubezpieczenia
							pomostowego:
						</p>
						<input type="text" name="" class="data data_ub_pom"
							placeholder="Data zgłoszenia"
							value="<?php echo ($umowa_bankowa['ubezp_pomostowe'] == '1') ? $umowa_bankowa['data_ubezp_pomostowe'] : '' ; ?> " />
						<div class="clear_b"></div>
					</div>
					<div class="zgloszenie_wiersz_elementow">
						<p>
							<span
								class="kratka_2 oplaty_ubezp_wkl_wl <?php echo ($umowa_bankowa['ubezp_wkl_wlasnego'] == '1') ? 'zaznaczone' : '' ; ?> "></span>
							nienależnie pobranej opłaty w związku z likwidacją ubezpieczenia
							wkładu własnego:
						</p>
						<input type="text" name="" class="data data_wk_wl"
							placeholder="Data zgłoszenia"
							value="<?php echo ($umowa_bankowa['ubezp_wkl_wlasnego'] == '1') ? $umowa_bankowa['data_wkl_wlasnego'] : '' ; ?> " />
						<div class="clear_b"></div>
					</div>
				</div>
			</div>

			<div id="zapisz_strone_5_b" class="zapisz_str_5_b"
				class=" margin_t_10 zablokowane_pole_transparent">ZAPISZ I PRZEJDŹ
				DALEJ</div>
		</div>



		<div class="strona_umowy str_6_b umowa_bankowa">

			<p class="dochodzenie_roszczen_naglowek_tresc">DOCHODZENIE ROSZCZEŃ</p>

			<div class="ochodzenie_roszczen_naglowek_tresc_tresc margin_t_10">
				<div class="zgloszenie_wiersz_elementow">
					<div class="zgloszenie_wiersz_elementow">
						<p>
							<span
								class="kratka_2 czy_zlecono <?php echo ($dochodzenie_roszczen['czy_zlecono'] == '1') ? 'zaznaczone' : '' ; ?> "></span>
							Sprawę zlecono wcześniej pełnomocnikowi:
						</p>
						<input type="text" name="" class="nazwa_pelnomocnika"
							placeholder="Nazwa"
							value="<?php echo ($dochodzenie_roszczen['czy_zlecono'] == '1') ? $dochodzenie_roszczen['komu_zlecono'] : '' ; ?> " />
						<div class="clear_b"></div>
						<p>z którym zawarto umowę dnia:</p>
						<input type="text" name="" class="data data_zlecenia"
							placeholder="Data zlecenia"
							value="<?php echo ($dochodzenie_roszczen['czy_zlecono'] == '1') ? $dochodzenie_roszczen['kiedy_zlecono'] : '' ; ?> " />
						<div class="clear_b"></div>
					</div>
					<div class="zgloszenie_wiersz_elementow dane_o_wypowiedzeniu">
						<p>
							<span
								class="kratka_2 wypowiedziono <?php echo ($dochodzenie_roszczen['czy_wypowiedziano'] == '1') ? 'zaznaczone' : '' ; ?> "></span>
							umowę z wyżej wymienionym wypowiedziano w dniu
						</p>
						<input type="text" name="" class="data data_wypowiedzenia"
							placeholder="Data wypowiedzenia"
							value="<?php echo ($dochodzenie_roszczen['czy_wypowiedziano'] == '1') ? $dochodzenie_roszczen['kiedy_wypowiedziano'] : '' ; ?> " />
						<div class="clear_b"></div>
					</div>
					<div class="dr_informacje margin_t_10 margin_b_10">
						<p>Czy klient wyraża zgodę na otrzymywanie informacji związanych z
							wykonywaniem umowy?</p>
						<p class="zgody_na_inf">
							<span
								class="kratka_2 inf_zgoda_tak <?php echo (($sprawa['zgoda_na_inf_sms'] == '1') OR ($sprawa['zgoda_na_inf_email'] == '1')) ? 'zaznaczone' : '' ; ?> "></span>
							Tak
						</p>
						<p>
							<span
								class="kratka_2 inf_zgoda_nie <?php echo (($sprawa['zgoda_na_inf_sms'] == '0') AND ($sprawa['zgoda_na_inf_email'] == '0')) ? '' : 'zaznaczone' ; ?> "></span>
							Nie
						</p>
						<div class="clear_b"></div>
						<div class="rodzaj_informowania">
							<p>
								<span
									class="kratka_2 inf_sms <?php echo ($sprawa['zgoda_na_inf_sms'] == '1') ? 'zaznaczone' : '' ; ?> "></span>
								wiadomości SMS na podany przeze mnie numer
							</p>
							<p>
								<span
									class="kratka_2 inf_email <?php echo ($sprawa['zgoda_na_inf_email'] == '1') ? 'zaznaczone' : '' ; ?> "></span>
								wiadomości e-mail na podany przeze mnie adres
							</p>
						</div>
					</div>
					<div class="clear_b"></div>
				</div>
			</div>


			<div id="zapisz_strone_6_b" class="zapisz_str_6_b"
				class=" margin_t_10 zablokowane_pole_transparent">ZAPISZ I PRZEJDŹ
				DALEJ</div>
		</div>

        <?php
								$dane_umowy_platnosc_bank = sprawa_pobierz_dane_z_tabeli_po_id ( 'sprawa_umowa', $sprawa ['sprawa_umowa_id'] );
								$dane_umowy_platnosc_osoba_bank = sprawa_pobierz_dane_z_tabeli_po_id ( 'sprawa_osoba', $dane_umowy_platnosc_bank ['osoba_do_wyplaty_id'] );
								$dane_umowy_platnos_osoba_adres_bank = sprawa_pobierz_dane_z_tabeli_po_id ( 'sprawa_adres', $dane_umowy_platnosc_osoba_bank ['sprawa_adres_zameldowania_id'] );
								?>

		<div class="strona_umowy str_7_b umowa_bankowa"
			data-id_umowy="<?php echo $sprawa ['sprawa_umowa_id']; ?>">
			<p class="wynagrodzenie_naglowek_tresc">WYNAGRODZENIE</p>
			<div class="wynagrodzenie_naglowek_tresc_tresc">
				<div class="wynagrodzenie ">
					<div class="zgloszenie_wiersz_elementow wybor_umowy">
						<p>Uzupełnij kwotę prowizji:</p>
						<input type="number" name="" class="prowizja_usl_bankowe" min="1"
							max="100" placeholder="Prowizja w %"
							value="<?php echo $umowa['prowizja']; ?>" />
						<div class="clear_b"></div>
					</div>

					<div class="zgloszenie_wiersz_elementow wybor_umowy">
						<p>
							<span
								class="kratka_2 przekaz_pocztowyy sprawa_spw <?php echo ($dane_umowy_platnosc_bank['forma_platnosci'] == 'przekaz') ? 'zaznaczone' : '' ; ?> "></span>przekaz
							pocztowy
						</p>
						<p>
							<span
								class="kratka_2 przelew_bankowyy sprawa_spw <?php echo ($dane_umowy_platnosc_bank['forma_platnosci'] == 'przelew') ? 'zaznaczone' : '' ; ?>"></span>przelew
							bankowy
						</p>
						<div class="clear_b"></div>
					</div>
					<div class="wynagrodzenie_do_umowy ">
						<div class="kopiuj_adres_zleceniodawcy"
							data-id_odbiorcy="<?php echo $dane_umowy_platnosc_bank['osoba_do_wyplaty_id']; ?>">
							<p>
								<span
									class="kratka_2 kopiuj_adres_zleceniodawcy_kratka <?php echo ($dane_umowy_platnosc_bank['osoba_do_wyplaty_id'] == $sprawa['sprawa_klient_id']) ? 'zaznaczone' : '' ; ?>"></span>Odbiorcą
								wynagrodzenia jest Zleceniodawca
							</p>
						</div>
						<div class="clear_b"></div>
						<div class=" zleceniodawca_formularz_numer_rachunku_bankowego zleceniodawca_formularz_element margin_t_10 " style="display:<?php echo ($dane_umowy_platnosc_bank['forma_platnosci'] == 'przelew') ? 'block' : 'none' ; ?>;" >
							<input
								<?php echo ($dane_umowy_platnosc_bank['osoba_do_wyplaty_id'] == $sprawa['sprawa_klient_id']) ? 'disabled' : '' ; ?>
								value="<?php echo $dane_umowy_platnosc_osoba_bank['nr_rachunku']; ?>"
								maxlength="32" size="32" placeholder="Nr rachunku Bankowego"
								type="text"
								class=" dane_do_umowy_platnosc_rachunek wynagrodzenie_nr_rachunku_bankowego nr_rachunku_bankowego"
								onkeyup="sprawdz_numer_rachunku(this);" />
						</div>
						<div
							class="zleceniodawca_formularz_imie wynagrodzenie_imie  zleceniodawca_formularz_element margin_r_20 margin_t_10">
							<input
								<?php echo ($dane_umowy_platnosc_bank['osoba_do_wyplaty_id'] == $sprawa['sprawa_klient_id']) ? 'disabled' : '' ; ?>
								placeholder="Imię" type="text"
								value="<?php echo $dane_umowy_platnosc_osoba_bank['imie']; ?>"
								class="dane_do_umowy_pole_obowiazkowe_ub wynagrodzenie_zleceniodawca_imie_ub imie imie_przelew imie_przelew_edytuj_widok"
								tab="1" />
						</div>
						<div
							class="zleceniodawca_formularz_nazwisko wynagrodzenie_nazwisko  zleceniodawca_formularz_element margin_t_10">
							<input
								<?php echo ($dane_umowy_platnosc_bank['osoba_do_wyplaty_id'] == $sprawa['sprawa_klient_id']) ? 'disabled' : '' ; ?>
								placeholder="Nazwisko" type="text"
								value="<?php echo $dane_umowy_platnosc_osoba_bank['nazwisko']; ?>"
								class="dane_do_umowy_pole_obowiazkowe_ub wynagrodzenie_zleceniodawca_nazwisko_ub nazwisko nazwisko_przelew"
								tab="2" />
						</div>
						<div class="clear_b"></div>
						<div
							class="zleceniodawca_formularz_ulica wynagrodzenie_ulica  zleceniodawca_formularz_element margin_r_20 margin_t_10">
							<input
								<?php echo ($dane_umowy_platnosc_bank['osoba_do_wyplaty_id'] == $sprawa['sprawa_klient_id']) ? 'disabled' : '' ; ?>
								placeholder="Ulica" type="text"
								value="<?php echo $dane_umowy_platnos_osoba_adres_bank['ulica']; ?>"
								class="dane_do_umowy_pole_obowiazkowe_ub wynagrodzenie_zleceniodawca_ulica_ub ulica ulica_przelew"
								tab="3" />
						</div>
						<div
							class="zleceniodawca_formularz_nr_domu wynagrodzenie_dom  zleceniodawca_formularz_element margin_r_10 margin_t_10">
							<input
								<?php echo ($dane_umowy_platnosc_bank['osoba_do_wyplaty_id'] == $sprawa['sprawa_klient_id']) ? 'disabled' : '' ; ?>
								maxlength="12" size="12" placeholder="Nr domu"
								value="<?php echo $dane_umowy_platnos_osoba_adres_bank['nr_domu']; ?>"
								type="text"
								class="dane_do_umowy_pole_obowiazkowe_ub wynagrodzenie_zleceniodawca_nr_domu_ub dom_przelew"
								tab="4" />
						</div>
						<div
							class="zleceniodawca_formularz_nr_mieszkania wynagrodzenie_mieszkanie  zleceniodawca_formularz_element margin_r_10 margin_t_10">
							<input
								<?php echo ($dane_umowy_platnosc_bank['osoba_do_wyplaty_id'] == $sprawa['sprawa_klient_id']) ? 'disabled' : '' ; ?>
								maxlength="15" size="15" placeholder="Nr mieszkania"
								value="<?php echo $dane_umowy_platnos_osoba_adres_bank['nr_mieszkania']; ?>"
								type="text"
								class="wynagrodzenie_zleceniodawca_nr_mieszkania_ub mieszkanie_przelew dane_do_umowy_nr_mieszkania_edytuj_widok"
								tab="5" />
						</div>
						<div
							class="zleceniodawca_formularz_kod_pocztowy wynagrodzenie_kod  zleceniodawca_formularz_element margin_t_10 ">
							<input
								<?php echo ($dane_umowy_platnosc_bank['osoba_do_wyplaty_id'] == $sprawa['sprawa_klient_id']) ? 'disabled' : '' ; ?>
								maxlength="6" size="6" placeholder="Kod pocztowy"
								value="<?php echo $dane_umowy_platnos_osoba_adres_bank['kod_pocztowy']; ?>"
								type="text"
								class="dane_do_umowy_pole_obowiazkowe_ub wynagrodzenie_zleceniodawca_kod_pocztowy_ub kod_pocztowy kod_przelew"
								tab="6" onkeyup="sprawdz_kod_pocztowy(this);" />
						</div>
						<div
							class="zleceniodawca_formularz_miejscowosc wynagrodzenie_miejscowosc  zleceniodawca_formularz_element  margin_t_10">
							<input
								<?php echo ($dane_umowy_platnosc_bank['osoba_do_wyplaty_id'] == $sprawa['sprawa_klient_id']) ? 'disabled' : '' ; ?>
								placeholder="Miejscowość" type="text"
								value="<?php echo $dane_umowy_platnos_osoba_adres_bank['miasto']; ?>"
								class="dane_do_umowy_pole_obowiazkowe_ub wynagrodzenie_zleceniodawca_miejscowosc_ub miejscowosc_przelew"
								tab="7" />
						</div>

						<div class="clear_b"></div>
					</div>
				</div>
			</div>

			<div id="zapisz_strone_7_b" class="zapisz_str_7_b_edycja"
				class=" margin_t_10 zablokowane_pole_transparent">ZAPISZ I GENERUJ
				UMOWE</div>
		</div>












	</div>

	<div class="strona_umowy str_3 mop">
            		<?php
														
														$poszkodowany = sprawa_pobierz_dane_z_tabeli_po_id ( 'sprawa_osoba', $sprawa ['sprawa_poszkodowany_id'] );
														$poszkodowany_adres = sprawa_pobierz_dane_z_tabeli_po_id ( 'sprawa_adres', $poszkodowany ['sprawa_adres_zameldowania_id'] );
														$poszkodowany_kontakt = sprawa_pobierz_dane_z_tabeli_po_id ( 'sprawa_kontakt', $poszkodowany ['sprawa_kontakt_id'] );
														
														?>
					<div class="poszkodowany_umowa ">
			<p class="poszkodowany_naglowek_tresc margin_b_10"
				data-poszkodowany_id="<?php echo $sprawa['sprawa_poszkodowany_id']; ?>">
					<?php
					
					echo ($sprawa ['sprawa_typ_szkody_id'] == '1') ? 'DANE
					POSZKODOWANEGO' : 'DANE
					ZMARŁEGO';
					?></p>
			<div class="przepisanie_klienta margin_b_10 margin_t_10">
				<p class="poszkodowany margin_b_10 margin_t_10">Osobą poszkodowaną
					jest klient</p>
				<div class="poszkodowany_o margin_t_10 margin_b_10">
					Tak
					<p data-id="<?php echo $poszkodowany['id'];?>"
						class="kratka klient_poszkodowany_tak <?php echo ($sprawa['sprawa_klient_id'] == $sprawa['sprawa_poszkodowany_id']) ? 'zaznaczone' : '' ; ?>"></p>
				</div>
				<div class="poszkodowany_o margin_t_10 margin_b_10">
					Nie
					<p data-id="<?php echo $poszkodowany['id'];?>"
						class="kratka klient_poszkodowany_nie <?php echo ($sprawa['sprawa_klient_id'] != $sprawa['sprawa_poszkodowany_id']) ? 'zaznaczone' : '' ; ?>"></p>
				</div>
			</div>
			<div class="clear_b"></div>

			<div class="kim_poszkodowany margin_b_10 margin_t_10"
					style="display:<?php echo ($sprawa ['sprawa_typ_szkody_id'] == '1') ? 'block' : 'none'; ?>">
				<p class="poszkodowany margin_b_10 margin_t_10">Poszkodowany był:</p>
				<div class="kb_poszkodowany margin_t_10 margin_b_10">
					osobą małoletnią
					<p data-id="<?php echo $poszkodowany['id'];?>"
						class="kratka poszkodowany_maloletni <?php echo ($sprawa['sprawa_typ_poszkodowany_id'] == '1') ? 'zaznaczone' : '' ;?>"></p>
				</div>
				<div class="kb_poszkodowany margin_t_10 margin_b_10">
					osobą ubezwłasnowolnioną całkowicie
					<p data-id="<?php echo $poszkodowany['id'];?>"
						class="kratka poszkodowany_ubezwlasnowolniony <?php echo ($sprawa['sprawa_typ_poszkodowany_id'] == '2') ? 'zaznaczone' : '' ;?>"></p>
				</div>
				<div class="kb_poszkodowany margin_t_10 margin_b_10">
					małżonkiem klienta
					<p data-id="<?php echo $poszkodowany['id'];?>"
						class="kratka poszkodowany_malzonek <?php echo ($sprawa['sprawa_typ_poszkodowany_id'] == '3') ? 'zaznaczone' : '' ;?>"></p>
				</div>
			</div>
			<div class="clear_b"></div>
                        <div class="dane_klienta_form" style="display:<?php echo ($sprawa['sprawa_klient_id'] == $sprawa['sprawa_poszkodowany_id']) ? 'none' : 'block' ; ?>;">
			<div
				class="zleceniodawca_formularz_imie zleceniodawca_formularz_element margin_r_20 margin_t_10 ">
				<input data-tabela="sprawa_osoba"
					data-id="<?php echo $poszkodowany['id'];?>" data-kolumna="imie"
					placeholder="Imię" type="text" class="poszkodowany_imie imie"
					value="<?php echo $poszkodowany['imie']; ?>" />
			</div>
			<div
				class="zleceniodawca_formularz_nazwisko zleceniodawca_formularz_element margin_r_20 margin_t_10">
				<input data-tabela="sprawa_osoba"
					data-id="<?php echo $poszkodowany['id'];?>" data-kolumna="nazwisko"
					placeholder="Nazwisko" type="text"
					class="poszkodowany_nazwisko nazwisko"
					value="<?php echo $poszkodowany['nazwisko']; ?>" />
			</div>
			<div class="clear_b"></div>
			<div
				class="zleceniodawca_formularz_ulica zleceniodawca_formularz_element margin_r_20 margin_t_10 ">
				<input data-tabela="sprawa_adres"
					data-id="<?php echo $poszkodowany['id'];?>" data-kolumna="ulica"
					placeholder="Ulica" type="text" class="poszkodowany_ulica"
					value="<?php echo $poszkodowany_adres['ulica']; ?>" />
			</div>
			<div
				class="zleceniodawca_formularz_nr_domu zleceniodawca_formularz_element margin_r_10 margin_t_10 ">
				<input data-tabela="sprawa_adres"
					data-id="<?php echo $poszkodowany['id'];?>" data-kolumna="nr_domu"
					maxlength="12" size="12" placeholder="Nr domu" type="text"
					class="poszkodowany_nr_domu"
					value="<?php echo $poszkodowany_adres['nr_domu']; ?>" />
			</div>
			<div
				class="zleceniodawca_formularz_nr_mieszkania zleceniodawca_formularz_element margin_r_10 margin_t_10 ">
				<input data-tabela="sprawa_adres"
					data-id="<?php echo $poszkodowany['id'];?>"
					data-kolumna="nr_mieszkania" maxlength="15" size="15"
					placeholder="Nr mieszkania" type="text"
					class="poszkodowany_nr_mieszkania"
					value="<?php echo $poszkodowany_adres['nr_mieszkania']; ?>" />
			</div>
			<div
				class="zleceniodawca_formularz_kod_pocztowy zleceniodawca_formularz_element margin_t_10 ">
				<input data-tabela="sprawa_adres"
					data-id="<?php echo $poszkodowany['id'];?>"
					data-kolumna="kod_pocztowy" maxlength="6" size="6"
					placeholder="Kod pocztowy" type="text"
					class="poszkodowany_kod_pocztowy kod_pocztowy"
					value="<?php echo $poszkodowany_adres['kod_pocztowy']; ?>"
					onkeyup="sprawdz_kod_pocztowy(this);" />
			</div>
			<div
				class="zleceniodawca_formularz_miejscowosc zleceniodawca_formularz_element margin_r_20 margin_t_10 ">
				<input data-tabela="sprawa_adres"
					data-id="<?php echo $poszkodowany['id'];?>" data-kolumna="miasto"
					placeholder="Miejscowość" type="text"
					class="poszkodowany_miejscowosc"
					value="<?php echo $poszkodowany_adres['miasto']; ?>" />
			</div>

			<div class="clear_b margin_b_10 "></div>
			<p class="obcokrajowiec margin_b_10 margin_t_0">Poszkodowany jest
				obcokrajowcem</p>
			<div class="korespondencja_o">
				Tak
				<p data-id="<?php echo $poszkodowany['id'];?>"
					class="kratka obcokrajowiec_tak obc_tak <?php echo ($poszkodowany['czy_obcokrajowiec'] == '1') ? 'zaznaczone' : '' ; ?> "></p>
			</div>
			<div class="korespondencja_o">
				Nie
				<p data-id="<?php echo $poszkodowany['id'];?>"
					class="kratka obcokrajowiec_nie obc_nie <?php echo ($poszkodowany['czy_obcokrajowiec'] == '0') ? 'zaznaczone' : '' ; ?> "></p>
			</div>
			<div class="clear_b "></div>
			<div class="dokument_polski" style="display:<?php echo ($poszkodowany['czy_obcokrajowiec'] == '1') ? 'none' : 'block' ;?>;">
				<div
					class="zleceniodawca_formularz_pesel zleceniodawca_formularz_element margin_r_20 margin_t_10 ">
					<input data-tabela="sprawa_osoba"
						data-id="<?php echo $poszkodowany['id'];?>" data-kolumna="pesel"
						maxlength="11" size="11" placeholder="Pesel" type="text"
						class="poszkodowany_pesel pesel"
						value="<?php echo $poszkodowany['pesel']; ?>"
						onkeyup="sprawdz_pesel(this);" />
				</div>
				<div
					class="zleceniodawca_formularz_seria_i_numer_dowodu zleceniodawca_formularz_element margin_t_10 ">
					<input data-tabela="sprawa_osoba"
						data-id="<?php echo $poszkodowany['id'];?>" data-kolumna="dowod"
						maxlength="9" size="9" placeholder="Seria i numer dowodu"
						type="text" class="poszkodowany_seria_i_numer_dowodu"
						value="<?php echo $poszkodowany['dowod']; ?>"
						onkeyup="sprawdz_dowod(this);" />
				</div>
			</div>
			<div class="dokument_obcokrajowca" style="display:<?php echo ($poszkodowany['czy_obcokrajowiec'] == '1') ? 'block' : 'none' ;?>;">
				<div
					class="zleceniodawca_formularz_pesel zleceniodawca_formularz_element margin_r_20 margin_t_10 ">
					<input data-tabela="sprawa_osoba"
						data-id="<?php echo $poszkodowany['id'];?>"
						data-kolumna="rodzaj_dokumentu" maxlength="22" size="20"
						placeholder="Rodzaj dokumentu" type="text"
						class="poszkodowany_dokument dokument"
						value="<?php echo $poszkodowany['rodzaj_dokumentu']; ?>" />
				</div>
				<div
					class="zleceniodawca_formularz_seria_i_numer_dowodu zleceniodawca_formularz_element margin_t_10 ">
					<input data-tabela="sprawa_osoba"
						data-id="<?php echo $poszkodowany['id'];?>"
						data-kolumna="nr_dokumentu" maxlength="16" size="16"
						placeholder="Numer dokumentu" type="text"
						class="poszkodowany_numer_dokumentu"
						value="<?php echo $poszkodowany['nr_dokumentu']; ?>" />
				</div>
			</div>
			<div class="clear_b "></div>
			<div
				class="zleceniodawca_formularz_email zleceniodawca_formularz_element  margin_r_20  margin_t_10 ">
				<input data-tabela="sprawa_kontakt"
					data-id="<?php echo $poszkodowany['id'];?>" data-kolumna="email"
					placeholder="Email" type="text" class="poszkodowany_email email"
					value="<?php echo $poszkodowany_kontakt['email']; ?>" />
			</div>
			<div
				class="zleceniodawca_formularz_telefon zleceniodawca_formularz_element  margin_t_10 ">
				<input data-tabela="sprawa_kontakt"
					data-id="<?php echo $poszkodowany['id'];?>" data-kolumna="telefon"
					placeholder="Telefon" type="text" class="poszkodowany_tel"
					value="<?php echo $poszkodowany_kontakt['telefon']; ?>" />
			</div>
                        </div>
			<div class="clear_b "></div>

			<div
				class="poszkodowany_zapisz_zmiany margin_t_10 zablokowane_pole_transparent zz_edytuj">ZAPISZ
				ZMIANY</div>
		</div>

	</div>

	<div class="strona_umowy str_4 mop">
                	<?php
																	
																	$uprawniony = sprawa_pobierz_dane_z_tabeli_po_id ( 'sprawa_osoba', $sprawa ['sprawa_uprawniony_id'] );
																	$uprawniony_adres = sprawa_pobierz_dane_z_tabeli_po_id ( 'sprawa_adres', $uprawniony ['sprawa_adres_zameldowania_id'] );
																	$uprawniony_kontakt = sprawa_pobierz_dane_z_tabeli_po_id ( 'sprawa_kontakt', $uprawniony ['sprawa_kontakt_id'] );
																	?>
                <p class="uprawniony_naglowek_tresc margin_b_10"
			data-uprawniony_id="<?php echo $sprawa['sprawa_uprawniony_id']; ?>"
			data-uprawniony_kontakt_id="<?php echo $uprawniony['sprawa_kontakt_id']; ?>"
			data-uprawniony_adres_id="<?php echo $uprawniony['sprawa_adres_zameldowania_id']; ?>">UPRAWNIONY</p>
		<div class="uprawniony_formularz margin_b_10 margin_t_10">
			<p>UPRAWNIONY (zaznacz jeśli chcesz podać dane osoby uprawnionej)</p>
			<div class="uprawniony_formularz_kratka">
				<p
					class="kratka uprawniony_formularz_kratka_kratka <?php echo (!empty($sprawa['sprawa_uprawniony_id']) && ($sprawa['sprawa_klient_id'] != $sprawa['sprawa_uprawniony_id'])) ? 'zaznaczone' : '' ; ?>"></p>
			</div>
			<div class="clear_b "></div>
			<div class="uprawniony_formularz_formularz margin_b_10 margin_t_10" style="display:<?php echo (!empty($sprawa['sprawa_uprawniony_id'])) ? 'block' : 'none' ; ?>;">
				<div
					class="zleceniodawca_formularz_imie zleceniodawca_formularz_element margin_r_20">
					<input placeholder="Imię" type="text" class="uprawniony_imie imie"
						value="<?php echo ($uprawniony['imie'] != $klient['imie']) ? $uprawniony['imie'] : '' ; ?>" />
				</div>
				<div
					class="zleceniodawca_formularz_nazwisko zleceniodawca_formularz_element margin_r_20">
					<input placeholder="Nazwisko" type="text"
						class="uprawniony_nazwisko nazwisko"
						value="<?php echo ($uprawniony['nazwisko'] != $klient['nazwisko']) ? $uprawniony['nazwisko'] : '' ; ?>" />
				</div>
				<div class="clear_b"></div>
				<div
					class="zleceniodawca_formularz_ulica zleceniodawca_formularz_element margin_r_20 margin_t_10">
					<input placeholder="Ulica" type="text" class="uprawniony_ulica"
						value="<?php echo ($uprawniony_adres['ulica'] != $klient['ulica']) ? $uprawniony['ulica'] : '' ; ?>" />
				</div>
				<div
					class="zleceniodawca_formularz_nr_domu zleceniodawca_formularz_element margin_r_10 margin_t_10">
					<input maxlength="12" size="12" placeholder="Nr domu" type="text"
						class="uprawniony_nr_domu"
						value="<?php echo ($uprawniony_adres['nr_domu'] != $klient['nr_domu']) ? $uprawniony['nr_domu'] : '' ; ?>" />
				</div>
				<div
					class="zleceniodawca_formularz_nr_mieszkania zleceniodawca_formularz_element margin_r_10 margin_t_10">
					<input maxlength="15" size="15" placeholder="Nr mieszkania"
						type="text" class="uprawniony_nr_mieszkania"
						value="<?php echo ($uprawniony_adres['nr_mieszkania'] != $klient['nr_mieszkania']) ? $uprawniony['nr_mieszkania'] : '' ; ?>" />
				</div>
				<div
					class="zleceniodawca_formularz_kod_pocztowy zleceniodawca_formularz_element margin_t_10">
					<input maxlength="6" size="6" placeholder="Kod pocztowy"
						type="text" class="uprawniony_kod_pocztowy kod_pocztowy"
						value="<?php echo ($uprawniony_adres['kod_pocztowy'] != $klient['kod_pocztowy']) ? $uprawniony['kod_pocztowy'] : '' ; ?>"
						onkeyup="sprawdz_kod_pocztowy(this);" />
				</div>
				<div
					class="zleceniodawca_formularz_miejscowosc zleceniodawca_formularz_element margin_r_20 margin_t_10">
					<input placeholder="Miejscowość" type="text"
						class="uprawniony_miejscowosc"
						value="<?php echo ($uprawniony_adres['miasto'] != $klient['miasto']) ? $uprawniony['miasto'] : '' ; ?>" />
				</div>
				<div class="clear_b margin_b_10"></div>
				<p class="obcokrajowiec margin_b_10 margin_t_0">Uprawniony jest
					obcokrajowcem</p>
				<div class="korespondencja_o">
					Tak
					<p
						class="kratka obcokrajowiec_tak uprawniony_obcokraj  <?php echo ($uprawniony['czy_obcokrajowiec'] == '1') ? 'zaznaczone' : '' ; ?>"></p>
				</div>
				<div class="korespondencja_o">
					Nie
					<p
						class="kratka obcokrajowiec_nie uprawniony_obcokraj  <?php echo ($uprawniony['czy_obcokrajowiec'] == '0') ? 'zaznaczone' : '' ; ?>"></p>
				</div>
				<div class="clear_b "></div>
				<div class="dokument_polski" style="display:<?php echo ($uprawniony['czy_obcokrajowiec'] == '1') ? 'none' : 'block' ;?>;">
					<div
						class="zleceniodawca_formularz_pesel zleceniodawca_formularz_element margin_r_20 margin_t_10 ">
						<input maxlength="11" size="11" placeholder="Pesel" type="text"
							class="uprawniony_pesel pesel"
							value="<?php echo ($uprawniony['pesel'] != $klient['pesel']) ? $uprawniony['pesel'] : '' ; ?>"
							onkeyup="sprawdz_pesel(this);" />
					</div>
					<div
						class="zleceniodawca_formularz_seria_i_numer_dowodu zleceniodawca_formularz_element margin_t_10 ">
						<input maxlength="9" size="9" placeholder="Seria i numer dowodu"
							type="text" class="uprawniony_seria_i_numer_dowodu"
							value="<?php echo ($uprawniony['dowod'] != $klient['dowod']) ? $uprawniony['dowod'] : '' ; ?>"
							onkeyup="sprawdz_dowod(this);" />
					</div>
				</div>
				<div class="dokument_obcokrajowca" style="display:<?php echo ($uprawniony['czy_obcokrajowiec'] == '1') ? 'block' : 'none' ;?>;">
					<div
						class="zleceniodawca_formularz_pesel zleceniodawca_formularz_element margin_r_20 margin_t_10 ">
						<input maxlength="22" size="20" placeholder="Rodzaj dokumentu"
							type="text" class="uprawniony_dokument dokument"
							value="<?php echo ($uprawniony['rodzaj_dokumentu'] != $klient['rodzaj_dokumentu']) ? $uprawniony['rodzaj_dokumentu'] : '' ; ?>" />
					</div>
					<div
						class="zleceniodawca_formularz_seria_i_numer_dowodu zleceniodawca_formularz_element margin_t_10 ">
						<input maxlength="16" size="16" placeholder="Numer dokumentu"
							type="text" class="uprawniony_numer_dokumentu"
							value="<?php echo ($uprawniony['nr_dokumentu'] != $klient['rodzaj_dokumentu']) ? $uprawniony['rodzaj_dokumentu'] : '' ; ?>" />
					</div>
				</div>
				<div class="clear_b "></div>
				<div
					class="zleceniodawca_formularz_email zleceniodawca_formularz_element  margin_r_20  margin_t_10">
					<input placeholder="Email" type="text"
						class="uprawniony_email email"
						value="<?php echo ($uprawniony_kontakt['email'] != $klient['email']) ? $uprawniony['email'] : '' ; ?>" />
				</div>
				<div
					class="zleceniodawca_formularz_telefon zleceniodawca_formularz_element  margin_t_10">
					<input placeholder="Telefon" type="text" class="uprawniony_telefon"
						value="<?php echo ($uprawniony_kontakt['telefon'] != $klient['telefon']) ? $uprawniony['telefon'] : '' ; ?>" />
				</div>
				<div class="clear_b "></div>
				<div
					class="uprawniony_zapisz_zmiany zz_edytuj margin_t_10 zablokowane_pole_transparent">ZAPISZ
					ZMIANY</div>
			</div>

		</div>
				
				<?php
				
				$uprawniony_do_inf = sprawa_pobierz_dane_z_tabeli_po_id ( 'sprawa_osoba', $sprawa ['sprawa_uprawniony_do_inf_id'] );
				
				?>
				
				<div
			class="uprawniony_informacje_formularz margin_t_10 uprawniony_do_informacji_id"
			data-uprawniony_do_inf_id="<?php echo $sprawa['sprawa_uprawniony_do_inf_id']; ?>">
			<p>UPRAWNIONY DO UZYSKANIA INFORMACJI TELEFONICZNEJ</p>
			<div class="uprawniony_do_informacji_kratka">
				<p
					class="kratka uprawniony_do_informacji_kratka_kratka <?php echo (!empty($sprawa['sprawa_uprawniony_do_inf_id'])) ? 'zaznaczone' : '' ; ?> "></p>
			</div>
			<div class="clear_b "></div>
			<div class="uprawniony_informacje_formularz_formularz  margin_t_10" style="display:<?php echo (!empty($sprawa['sprawa_uprawniony_do_inf_id'])) ? 'block' : 'none' ; ?>;">
				<div
					class="zleceniodawca_formularz_imie zleceniodawca_formularz_element margin_r_20">
					<input placeholder="Imię" type="text"
						class="uprawniony_informacje_imie imie"
						value="<?php echo $uprawniony_do_inf['imie']; ?>" />
				</div>
				<div
					class="zleceniodawca_formularz_nazwisko zleceniodawca_formularz_element margin_r_20">
					<input placeholder="Nazwisko" type="text"
						class="uprawniony_informacje_nazwisko nazwisko"
						value="<?php echo $uprawniony_do_inf['nazwisko']; ?>" />
				</div>
				<div
					class="zleceniodawca_formularz_pesel zleceniodawca_formularz_element  ">
					<input maxlength="11" size="11" placeholder="Pesel" type="text"
						class="uprawniony_informacje_pesel pesel"
						value="<?php echo $uprawniony_do_inf['pesel']; ?>"
						onkeyup="sprawdz_pesel(this);" />
				</div>
				<div class="clear_b"></div>
				<div
					class="uprawniony_do_inf_zapisz_zmiany zz_edytuj margin_t_10 zablokowane_pole_transparent">ZAPISZ
					ZMIANY</div>
			</div>

		</div>

	</div>

	<div class="strona_umowy str_5 mop">
		<div class="str_5_rekomendacja ">
			<p class="margin_b_10">REKOMENDACJA</p>
			<input class="str_5_rekomendacja_tresc margin_b_10"
				placeholder="Wprowadź dane osoby..."
				value="<?php echo $sprawa['rekomendacja']; ?>" />
			<div class="str_5_zapisz_rekomendacje sprawa_zapisz_rekomendacje">ZAPISZ
				REKOMENDACJE</div>
		</div>
            	<?php
													
													$zdarzenie = sprawa_pobierz_dane_z_tabeli_po_id ( 'sprawa_zdarzenie', $sprawa ['sprawa_zdarzenie_id'] );
													$zdarzenie_pojazd_a = sprawa_pobierz_dane_z_tabeli_po_id ( 'sprawa_zdarzenie_pojazd', $zdarzenie ['pojazd_a_id'] );
													$zdarzenie_pojazd_b = sprawa_pobierz_dane_z_tabeli_po_id ( 'sprawa_zdarzenie_pojazd', $zdarzenie ['pojazd_b_id'] );
													$zdarzenie_opis = sprawa_pobierz_dane_z_tabeli_po_id ( 'sprawa_opis', $sprawa ['sprawa_opis_id'] );
													$obrazenia_opis = sprawa_pobierz_dane_z_tabeli_po_id ( 'sprawa_obrazenia', $sprawa ['sprawa_obrazenia_id'] );
													?>
                <div class="dane_wypadku_formularz ">
			<p
				class="info_o_zdarzeniu_id info_o_zdarzeniu_naglowek_tresc margin_b_10"
				data-informacje_o_zdarzeniu_id="<?php echo $zdarzenie['id']; ?>">INFORMACJE
				O ZDARZENIU</p>
			<div
				class="dane_wypadku_data_wypadku zleceniodawca_formularz_element margin_r_20 ">
				<input placeholder="Data wypadku (RRRR-MM-DD)" type="text"
					class="data data_wypadku str_5_data_wypadku"
					value="<?php echo $zdarzenie['data']; ?>" />
			</div>
			<div
				class="dane_wypadku_godzina_wypadku zleceniodawca_formularz_element margin_r_20 ">
				<input placeholder="Godzina (GG:MM)" type="time"
					class="godzina_wypadku"
					value="<?php echo $zdarzenie['godzina']; ?>" />
			</div>
			<div
				class="dane_wypadku_miejsce_zdarzenia zleceniodawca_formularz_element  ">
				<input placeholder="Miejsce zdarzenia" type="text"
					class="miejsce_zdarzenia"
					value="<?php echo $zdarzenie['miejsce']; ?>" />
			</div>
			<div class="clear_b margin_b_10 "></div>
			<p class="float_left">W zdarzeniu uczestniczyły 2 pojazdy</p>
			<div class="pojazd_a_k_b_k">
				<p
					class="kratka pojazd_a_k_b_k_kratka <?php echo ($zdarzenie['rodzaj_zdarzenia'] == 1) ? 'zaznaczone' : '' ; ?>"></p>
			</div>
			<div class="clear_b margin_b_10"></div>
			<p class="float_left">Poszkodowanym był pieszy lub rowerzysta</p>
			<div class="pojazd_b_k">
				<p
					class="kratka pojazd_b_k_kratka <?php echo ($zdarzenie['rodzaj_zdarzenia'] == 2) ? 'zaznaczone' : '' ; ?>"></p>
			</div>
			<div class="clear_b margin_b_10"></div>
			<p class="float_left">Szkoda niekomunikacyjna</p>
			<div class="pojazd_c_k">
				<p
					class="kratka pojazd_c_k_kratka <?php echo ($zdarzenie['rodzaj_zdarzenia'] == 3) ? 'zaznaczone' : '' ; ?>"></p>
			</div>
			<div class="clear_b margin_b_10"></div>
			<div class="margin_t_10 pojazd_a" style="display:<?php echo ($zdarzenie['rodzaj_zdarzenia'] == 1) ? 'block' : 'none' ; ?>;">
				<p class="margin_b_10">POJAZD A (w którym znajdował się
					poszkodowany)</p>
				<div
					class="dane_wypadku_pojazd_a_marka zleceniodawca_formularz_element margin_r_20 ">
					<input placeholder="Marka" type="text" class="pojazd_a_marka"
						value="<?php echo $zdarzenie_pojazd_a['marka']; ?>" />
				</div>
				<div
					class="dane_wypadku_pojazd_a_model zleceniodawca_formularz_element  margin_r_20">
					<input placeholder="Typ pojazdu" type="text" class="pojazd_a_model"
						value="<?php echo $zdarzenie_pojazd_a['typ_pojazdu']; ?>" />
				</div>
				<div
					class="dane_wypadku_pojazd_a_nr_rejestracyjny zleceniodawca_formularz_element  margin_r_20">
					<input placeholder="Nr rejestracyjny" type="text"
						class="pojazd_a_nr_rejestracyjny"
						value="<?php echo $zdarzenie_pojazd_a['nr_rejestracyjny']; ?>" />
				</div>
				<div
					class="dane_wypadku_pojazd_a_kraj_rejestracji zleceniodawca_formularz_element  ">
					<input placeholder="Kraj rejestracji" type="text"
						class="pojazd_a_kraj_rejestracji"
						value="<?php echo $zdarzenie_pojazd_a['kraj_rejestracji']; ?>" />
				</div>
				<div
					class="dane_wypadku_pojazd_a_kierujacy_pojazdem zleceniodawca_formularz_element margin_t_10 margin_r_20 ">
					<input placeholder="Kierujący pojazdem" type="text"
						class="pojazd_a_kierujacy_pojazdem"
						value="<?php echo $zdarzenie_pojazd_a['kierujacy']; ?>" />
				</div>
				<div
					class="dane_wypadku_pojazd_a_posiadacz_pojazdu zleceniodawca_formularz_element margin_t_10 margin_r_20 ">
					<input placeholder="Posiadacz pojazdu" type="text"
						class="pojazd_a_posiadacz_pojazdu"
						value="<?php echo $zdarzenie_pojazd_a['posiadacz']; ?>" />
				</div>
				<div
					class="dane_wypadku_pojazd_a_uoc_posiadacz_pojazdu zleceniodawca_formularz_element margin_t_10 margin_r_20 ">
					<input placeholder="Ubezpieczyciel OC posiadacza pojazdu"
						type="text" class="pojazd_a_uoc_posiadacz_pojazdu"
						value="<?php echo $zdarzenie_pojazd_a['ubezpieczyciel']; ?>" />
				</div>
				<div
					class="dane_wypadku_pojazd_a_nr_polisy_oc zleceniodawca_formularz_element margin_t_10 ">
					<input placeholder="Numer polisy OC" type="text"
						class="pojazd_a_nr_polisy_oc"
						value="<?php echo $zdarzenie_pojazd_a['nr_oc']; ?>" />
				</div>
				<div class="clear_b"></div>
			</div>
			<div class="margin_t_10 pojazd_b margin_b_10" style="display:<?php echo (($zdarzenie['rodzaj_zdarzenia'] == 1) OR ($zdarzenie['rodzaj_zdarzenia'] == 2)) ? 'block' : 'none' ; ?>;">
				<p class="margin_b_10">POJAZD B* lub PODMIOT ODPOWIEDZIALNY</p>
				<div
					class="dane_wypadku_pojazd_a_marka zleceniodawca_formularz_element margin_r_20 ">
					<input placeholder="Marka" type="text" class="pojazd_b_marka"
						value="<?php echo $zdarzenie_pojazd_b['marka']; ?>" />
				</div>
				<div
					class="dane_wypadku_pojazd_a_model zleceniodawca_formularz_element  margin_r_20">
					<input placeholder="Typ pojazdu" type="text" class="pojazd_b_model"
						value="<?php echo $zdarzenie_pojazd_b['typ_pojazdu']; ?>" />
				</div>
				<div
					class="dane_wypadku_pojazd_a_nr_rejestracyjny zleceniodawca_formularz_element  margin_r_20">
					<input placeholder="Nr rejestracyjny" type="text"
						class="pojazd_b_nr_rejestracyjny"
						value="<?php echo $zdarzenie_pojazd_b['nr_rejestracyjny']; ?>" />
				</div>
				<div
					class="dane_wypadku_pojazd_a_kraj_rejestracji zleceniodawca_formularz_element  ">
					<input placeholder="Kraj rejestracji" type="text"
						class="pojazd_b_kraj_rejestracji"
						value="<?php echo $zdarzenie_pojazd_b['kraj_rejestracji']; ?>" />
				</div>
				<div
					class="dane_wypadku_pojazd_a_kierujacy_pojazdem zleceniodawca_formularz_element margin_t_10 margin_r_20 ">
					<input placeholder="Kierujący pojazdem" type="text"
						class="pojazd_b_kierujacy_pojazdem"
						value="<?php echo $zdarzenie_pojazd_b['kierujacy']; ?>" />
				</div>
				<div
					class="dane_wypadku_pojazd_a_posiadacz_pojazdu zleceniodawca_formularz_element margin_t_10 margin_r_20 ">
					<input placeholder="Posiadacz pojazdu" type="text"
						class="pojazd_b_posiadacz_pojazdu"
						value="<?php echo $zdarzenie_pojazd_b['posiadacz']; ?>" />
				</div>
				<div
					class="dane_wypadku_pojazd_a_uoc_posiadacz_pojazdu zleceniodawca_formularz_element margin_t_10 margin_r_20 ">
					<input placeholder="Ubezpieczyciel OC posiadacza pojazdu"
						type="text" class="pojazd_b_uoc_posiadacz_pojazdu"
						value="<?php echo $zdarzenie_pojazd_b['ubezpieczyciel']; ?>" />
				</div>
				<div
					class="dane_wypadku_pojazd_a_nr_polisy_oc zleceniodawca_formularz_element margin_t_10 ">
					<input placeholder="Numer polisy OC" type="text"
						class="pojazd_b_nr_polisy_oc"
						value="<?php echo $zdarzenie_pojazd_b['nr_oc']; ?>" />
				</div>
				<div class="clear_b"></div>

			</div>
			<div class="zgloszenie_wiersz_elementow stosunek_a stosunki_pojazdow" style="display:<?php echo (!empty($zdarzenie['pojazd_a_id'])) ? 'block' : 'none' ; ?>;">
				<p>Stosunek do kierującego pojazdem A</p>
				<p class="dr_s_do_a_obcy_o">
					<span
						class="kratka_2 dr_s_do_a_obcy <?php echo ($zdarzenie['stosunek_poj_a'] == '1') ? 'zaznaczone' : '' ; ?>"></span>
					obcy
				</p>
				<p class="dr_s_do_a_rodzina_o">
					<span
						class="kratka_2 dr_s_do_a_rodzina  <?php echo ($zdarzenie['stosunek_poj_a'] == '2') ? 'zaznaczone' : '' ; ?>"></span>
					rodzina
				</p>
				<p class="dr_s_do_a_inny_o">
					<span
						class="kratka_2 dr_s_do_a_inny stos_a_inny  <?php echo ($zdarzenie['stosunek_poj_a'] == '3') ? 'zaznaczone' : '' ; ?>"></span>
					inny
				</p>
				<input type="text" name="" class="dr_s_do_a_inny_rodzaj dr_s_do_a_inny_o_o stos_a_inny_rodzaj" placeholder="Rodzaj" value="<?php echo $zdarzenie['stosunek_poj_a_tekst']; ?>"  style="display:<?php echo ($zdarzenie['stosunek_poj_a'] == '3') ? 'block' : 'none' ; ?>;"/>
				<div class="clear_b"></div>
			</div>
			<div class="zgloszenie_wiersz_elementow stosunek_b stosunki_pojazdow" style="display:<?php echo (!empty($zdarzenie['pojazd_b_id'])) ? 'block' : 'none' ; ?>;">
				<p>Stosunek do kierującego pojazdem B</p>
				<p class="dr_s_do_b_obcy_o">
					<span
						class="kratka_2 dr_s_do_b_obcy  <?php echo ($zdarzenie['stosunek_poj_b'] == '1') ? 'zaznaczone' : '' ; ?>"></span>
					obcy
				</p>
				<p class="dr_s_do_b_rodzina_o">
					<span
						class="kratka_2 dr_s_do_b_rodzina  <?php echo ($zdarzenie['stosunek_poj_b'] == '2') ? 'zaznaczone' : '' ; ?>"></span>
					rodzina
				</p>
				<p class="dr_s_do_b_inny_o">
					<span
						class="kratka_2 dr_s_do_b_inny stos_b_inny <?php echo ($zdarzenie['stosunek_poj_b'] == '3') ? 'zaznaczone' : '' ; ?>"></span>
					inny
				</p>
				<input type="text" name="" class="dr_s_do_b_inny_rodzaj dr_s_do_b_inny_o_o stos_b_inny_rodzaj" placeholder="Rodzaj" value="<?php echo $zdarzenie['stosunek_poj_b_tekst']; ?>" style="display:<?php echo ($zdarzenie['stosunek_poj_b'] == '3') ? 'block' : 'none' ; ?>;"/>
				<div class="clear_b"></div>
			</div>
			<p class="opis_zdarzenia_naglowek_tresc margin_b_10">OPIS ZDARZENIA</p>
			<div style="display: block">
				<div class="opis_zdarzenia_pole ">
					<textarea placeholder="Wprowadź dane..." class="opis_zdarzenia"><?php echo $zdarzenie_opis['wartosc']; ?></textarea>
				</div>
			</div>
			<div class='obrazenia_ciala' style="display:<?php echo ($sprawa['sprawa_typ_szkody_id'] == '1') ? 'block' : 'none' ; ?>;">
				<p class="opis_obrazen_naglowek_tresc margin_b_10">OPIS OBRAŻEŃ</p>
				<div class="opis_obrazen_pole ">
					<textarea placeholder="Wprowadź dane..." class="opis_obrazen"><?php echo $obrazenia_opis['wartosc']; ?></textarea>
				</div>
			</div>

			<div class="clear_b"></div>
			<div
				class="informacje_o_zdarzeniu_zapisz_zmiany margin_t_10 zz_edytuj zablokowane_pole_transparent">ZAPISZ
				ZMIANY</div>
		</div>

	</div>


	<div class="strona_umowy str_6 mop">

		<p class="dochodzenie_roszczen_naglowek_tresc">DOCHODZENIE ROSZCZEŃ</p>
		<div class="dochodzenie_roszczen_naglowek_tresc_tresc">

			<div class="zgloszenie_wiersz_elementow ">
				<p>Oświadczam, że zostałem poinformowany o okolicznościach
					uzasadniających dochodzenie zwrotu wypłaconego odszkodowania od
					sprawcy wypadku przez ubezpieczyciela lub Ubezpieczeniowy Fundusz
					Gwarancyjny, określonych w ustawie z dnia 22 maja 2003 r. o
					ubezpieczeniach obowiązkowych, Ubezpieczeniowym Funduszu
					Gwarancyjnym i Polskim Biurze Ubezpieczycieli Komunikacyjnych
					(Dz.U. Nr 124, poz. 1152).</p>
				<p>
					Zgodnie z art. 43. zakładowi ubezpieczeń przysługuje prawo
					dochodzenia od kierującego pojazdem mechanicznym zwrotu wypłaconego
					z tytułu ubezpieczenia OC posiadaczy pojazdów mechanicznych
					odszkodowania, jeżeli kierujący:<br /> 1) wyrządził szkodę umyślnie
					lub w stanie po użyciu alkoholu albo pod wpływem środków
					odurzających, substancji psychotropowych lub środków zastępczych w
					rozumieniu przepisów o przeciwdziałaniu narkomanii;<br /> 2) wszedł
					w posiadanie pojazdu wskutek popełnienia przestępstwa;<br /> 3) nie
					posiadał wymaganych uprawnień do kierowania pojazdem mechanicznym,
					z wyjątkiem przypadków, gdy chodziło o ratowanie życia ludzkiego
					lub mienia albo o pościg za osobą podjęty bezpośrednio po
					popełnieniu przez nią przestępstwa;<br /> 4) zbiegł z miejsca
					zdarzenia.
				</p>
				<p>Zgodnie z art. 110 ust. 1 z chwilą wypłaty przez Fundusz
					odszkodowania, sprawca szkody i osoba, która nie dopełniła
					obowiązku zawarcia umowy ubezpieczenia obowiązkowego są obowiązani
					do zwrotu Funduszowi spełnionego świadczenia w przypadku gdy:
					posiadacz zaidentyfikowanego pojazdu mechanicznego, którego ruchem
					szkodę tę wyrządzono, nie był ubezpieczony obowiązkowym
					ubezpieczeniem OC posiadaczy pojazdów mechanicznych, lub rolnik,
					osoba pozostająca z nim we wspólnym gospodarstwie domowym lub osoba
					pracująca w jego gospodarstwie rolnym wyrządzili szkodę, a rolnik
					nie był ubezpieczony obowiązkowym ubezpieczeniem OC rolników.</p>
			</div>
			<div class="zgloszenie_wiersz_elementow">
				<p class="margin_t_20">W przypadku możliwości żądania od sprawcy lub
					osoby, która nie dopełniła obowiązku zawarcia umowy ubezpieczenia
					obowiązkowego zwrotu wypłaconych odszkodowań przez ubezpieczyciela
					lub UFG:</p>
				<p class="dr_ub_ufg_tak_o">
					<span
						class="kratka_2 dr_ub_ufg_tak <?php echo ($sprawa['roszczenia_od_ubezp_ufg'] == '1') ? 'zaznaczone' : '' ; ?>"></span>
					decyduję się na dochodzenie roszczeń od ubezpieczyciela lub UFG
				</p>
				<div class="clear_b"></div>
				<p class="dr_ub_ufg_nie_o">
					<span
						class="kratka_2 dr_ub_ufg_nie <?php echo ($sprawa['roszczenia_od_ubezp_ufg'] == '0') ? 'zaznaczone' : '' ; ?>"></span>
					nie decyduję się na dochodzenie roszczeń od ubezpieczyciela lub UFG
				</p>
				<div class="clear_b"></div>
			</div>
			<div class="zgloszenie_wiersz_elementow margin_t_20">
				<p>W przypadku dochodzenia roszczeń bezpośrednio od swojego
					pracodawcy:</p>
				<div class="clear_b"></div>
				<p class="dr_tak_o">
					<span
						class="kratka_2 dr_tak <?php echo ($sprawa['roszczenia_od_prac'] == '1') ? 'zaznaczone' : '' ; ?>"></span>
					decyduję się na dochodzenie roszczeń
				</p>
				<p class="dr_nie_o">
					<span
						class="kratka_2 dr_nie <?php echo ($sprawa['roszczenia_od_prac'] == '0') ? 'zaznaczone' : '' ; ?>"></span>
					nie decyduję się na dochodzenie roszczeń
				</p>
				<div class="clear_b"></div>
			</div>

		</div>
	</div>

	<div class="strona_umowy str_7 mop">
            		<?php
														
														$odpowiedzialnosc_karna = sprawa_pobierz_dane_z_tabeli_po_id ( 'sprawa_odpowiedzialnosc_karna', $sprawa ['odpowiedzialnosc_karna_id'] );
														
														?>
                    <p class="odpowiedzialnosc_karna_naglowek_tresc">ODPOWIEDZIALNOSC
			KARNA</p>
		<div
			class="odpowiedzialnosc_karna_naglowek_tresc_tresc odpowiedzialnosc_karna_id"
			data-odpowiedzialnosc_karna_id="<?php echo $sprawa['odpowiedzialnosc_karna_id']; ?>">
			<div class="zgloszenie_wiersz_elementow">
				<p>sygn. akt</p>
				<input type="text" name="" class="ok_sygnatura_akt"
					placeholder="sygn. akt"
					value="<?php echo $odpowiedzialnosc_karna['sygnatura_akt']; ?>" />
				<div class="clear_b"></div>
			</div>
			<div class="zgloszenie_wiersz_elementow">
				<p>
					<span
						class="kratka_2 ok_sprawca_napisal_oswiadczenie <?php echo ($odpowiedzialnosc_karna['oswiadczenie'] == '1') ? 'zaznaczone' : '' ; ?>"></span>
					sprawca napisał oświadczenie
				</p>
				<div class="clear_b"></div>
			</div>
			<div class="zgloszenie_wiersz_elementow">
				<p>
					<span
						class="kratka_2 ok_wezwano_policje  <?php echo ($odpowiedzialnosc_karna['wezwano_policje'] == '1') ? 'zaznaczone' : '' ; ?>"></span>
					na miejsce zdarzenia wezwano policję
				</p>
				<input type="text" class="ok_wp_miejsce" name="" placeholder="Miejscowość" value="<?php echo $odpowiedzialnosc_karna['skad_policja']; ?>" style="display:<?php echo ($odpowiedzialnosc_karna['wezwano_policje'] == '1') ? 'block' : 'none' ; ?>;"/>
				<div class="clear_b"></div>
			</div>
			<div class="zgloszenie_wiersz_elementow">
				<p>
					<span
						class="kratka_2 ok_wszczeto_postepowanie <?php echo ($odpowiedzialnosc_karna['wszczeto_postepowanie'] == '1') ? 'zaznaczone' : '' ; ?>"></span>
					wszczęto postępowanie w sprawie
				</p>
				<div class="clear_b"></div>
			</div>
			<div class="zgloszenie_wiersz_elementow">
				<p>
					<span
						class="kratka_2 ok_postawiono_sprawcy_zarzut <?php echo ($odpowiedzialnosc_karna['zarzut'] == '1') ? 'zaznaczone' : '' ; ?>"></span>
					postawiono sprawcy zarzut
				</p>
				<input type="text" name="" class="ok_psz_artykul" placeholder="Nr artykułu" value="<?php echo $odpowiedzialnosc_karna['zarzut_z_art']; ?>"  style="display:<?php echo ($odpowiedzialnosc_karna['zarzut'] == '1') ? 'block' : 'none' ; ?>;"/>
				<p class="ok_psz_kk_o" style="display:<?php echo ($odpowiedzialnosc_karna['zarzut'] == '1') ? 'block' : 'none' ; ?>;">
					<span class="kratka_2 ok_psz_kk"></span> k.k
				</p>
				<p class="ok_psz_kw_o" style="display:<?php echo ($odpowiedzialnosc_karna['zarzut'] == '1') ? 'block' : 'none' ; ?>;">
					<span class="kratka_2 ok_psz_kw"></span> k.w.
				</p>
				<div class="clear_b"></div>
			</div>
			<div class="zgloszenie_wiersz_elementow">
				<p>
					<span
						class="kratka_2 ok_postepowanie_karne_umorzono <?php echo ($odpowiedzialnosc_karna['umorzono'] == '1') ? 'zaznaczone' : '' ; ?>"></span>
					postępowanie karne umorzono na podstawie
				</p>
				<input type="text" name="" class="ok_pku_artykul" placeholder="Nr artykułu" value="<?php echo $odpowiedzialnosc_karna['umorz_na_podst']; ?>" style="display:<?php echo ($odpowiedzialnosc_karna['umorzono'] == '1') ? 'block' : 'none' ; ?>;"/>
				<p class="ok_pku_kpk_o" style="display:<?php echo ($odpowiedzialnosc_karna['umorzono'] == '1') ? 'block' : 'none' ; ?>;">
					<span class="kratka_2 ok_pku_kpk"></span> k.p.k.
				</p>
				<p class="ok_pku_kpw_o" style="display:<?php echo ($odpowiedzialnosc_karna['umorzono'] == '1') ? 'block' : 'none' ; ?>;">
					<span class="kratka_2 ok_pku_kpw"></span> k.p.w.
				</p>
				<div class="clear_b"></div>
			</div>
			<div class="zgloszenie_wiersz_elementow">
				<p>
					<span
						class="kratka_2 ok_skierowano_akt_do_sadu <?php echo ($odpowiedzialnosc_karna['do_sadu'] == '1') ? 'zaznaczone' : '' ; ?>"></span>
					skierowano akt oskarżenia do sądu
				</p>
				<input type="text" name="" class="ok_sads_pelna_nazwa_sadu" placeholder="Pełna nazwa sądu"  value="<?php echo $odpowiedzialnosc_karna['nazwa_sadu']; ?>" style="display:<?php echo ($odpowiedzialnosc_karna['do_sadu'] == '1') ? 'block' : 'none' ; ?>;"/>
				<div class="clear_b"></div>
			</div>
			<div class="zgloszenie_wiersz_elementow">
				<div class="wyrok">
					<p>
						<span
							class="kratka_2 ok_zapadl_wyrok <?php echo ($odpowiedzialnosc_karna['czy_wyrok'] == '1') ? 'zaznaczone' : '' ; ?>"></span>
						zapadł wyrok
					</p>
					<p class="ok_zw_skazujacy_o" style="display:<?php echo ($odpowiedzialnosc_karna['czy_wyrok'] == '1') ? 'block' : 'none' ; ?>;">
						<span
							class="kratka_2 ok_zw_skazujacy <?php echo ($odpowiedzialnosc_karna['skazujacy'] == '1') ? 'zaznaczone' : '' ; ?>"></span>
						skazujący
					</p>
					<p class="ok_zw_uniewinniajacy_o" style="display:<?php echo ($odpowiedzialnosc_karna['czy_wyrok'] == '1') ? 'block' : 'none' ; ?>;">
						<span
							class="kratka_2 ok_zw_uniewinniajacy <?php echo ($odpowiedzialnosc_karna['uniewinniajacy'] == '1') ? 'zaznaczone' : '' ; ?>"></span>
						uniewinniający o czyn
					</p>
					<input type="text" name="" class="ok_zw_u_artykul" placeholder="Nr artykułu"  value="<?php echo $odpowiedzialnosc_karna['wyrok_z_art']; ?>"  style="display:<?php echo ($odpowiedzialnosc_karna['czy_wyrok'] == '1') ? 'block' : 'none' ; ?>;"/>
					<p class="ok_zw_kk_o" style="display:<?php echo ($odpowiedzialnosc_karna['czy_wyrok'] == '1') ? 'block' : 'none' ; ?>;">
						<span class="kratka_2 ok_zw_kk"></span> k.k
					</p>
					<p class="ok_zw_kw_o" style="display:<?php echo ($odpowiedzialnosc_karna['czy_wyrok'] == '1') ? 'block' : 'none' ; ?>;">
						<span class="kratka_2 ok_zw_kw"></span> k.w.
					</p>
				</div>
				<div class="clear_b"></div>
			</div>
		</div>

		<div
			class="zz_edytuj margin_t_10 zablokowane_pole_transparent odpowiedzialnosc_karna_zapisz_zmiany">ZAPISZ
			ZMIANY</div>
	</div>

	<div class="strona_umowy str_8 mop">
            		<?php
														
														$odpowiedzialnosc_cywilna = sprawa_pobierz_dane_z_tabeli_po_id ( 'sprawa_odpowiedzialnosc_cywilna', $sprawa ['odpowiedzialnosc_cywilna_id'] );
														
														?>
                <p class="odpowiedzialnosc_cywilna_naglowek_tresc">ODPOWIEDZIALNOŚĆ
			CYWILNA</p>
		<div
			class="odpowiedzialnosc_cywilna_naglowek_tresc_tresc odpowiedzialnosc_cywilna_id"
			data-odpowiedzialnosc_cywilna_id="<?php echo $sprawa['odpowiedzialnosc_cywilna_id']; ?>">
			<div class="zgloszenie_wiersz_elementow">
				<p>nr szkody</p>
				<input type="text" name="" class="oc_nr_szkody"
					placeholder="Nr szkody"
					value="<?php echo $odpowiedzialnosc_cywilna['nr_szkody']; ?>" />
				<div class="clear_b"></div>
			</div>
			<div class="zgloszenie_wiersz_elementow">
				<p class="oc_zgloszono_szp_o">
					<span
						class="kratka_2 oc_zgloszono_szp <?php echo ($odpowiedzialnosc_cywilna['zgl_szkode_w_poj'] == '1') ? 'zaznaczone' : '' ; ?>"></span>
					zgłoszono szkodę w pojeździe do ubezpieczyciela OC sprawcy
				</p>
				<input type="text" name="" class="data oc_zgloszono_szp_data" placeholder="Data" value="<?php echo $odpowiedzialnosc_cywilna['data_zgl_w_poj']; ?>" style="display:<?php echo ($odpowiedzialnosc_cywilna['zgl_szkode_w_poj'] == '1') ? 'block' : 'none' ; ?>;"/>
				<div class="clear_b"></div>
			</div>
			<div class="zgloszenie_wiersz_elementow">
				<p class="oc_nie_zgloszono_szp_o">
					<span
						class="kratka_2 oc_nie_zgloszono_szp <?php echo ($odpowiedzialnosc_cywilna['zgl_szkode_w_poj'] == '0') ? 'zaznaczone' : '' ; ?>"></span>
					nie zgłoszono szkody w pojeździe do ubezpieczyciela OC sprawcy
				</p>
				<div class="clear_b"></div>
			</div>
			<div class="zgloszenie_wiersz_elementow">
				<p class="oc_zgloszono_szo_o"><span class="kratka_2 oc_zgloszono_szo <?php echo ($odpowiedzialnosc_cywilna['zgl_szkode_na_os'] == '1') ? 'zaznaczone' : '' ; ?>"></span>
					zgłoszono szkodę na osobie do ubezpieczyciela OC sprawcy
				</p>
				<input type="text" name="" class="data oc_zgloszono_szo_data"  placeholder="Data" value="<?php echo $odpowiedzialnosc_cywilna['data_zgl_na_os']; ?>" style="display:<?php echo ($odpowiedzialnosc_cywilna['zgl_szkode_na_os'] == '1') ? 'block' : 'none' ; ?>;" />
				<div class="clear_b"></div>
			</div>
			<div class="zgloszenie_wiersz_elementow">
				<p class="oc_nie_zgloszono_szo_o">
					<span
						class="kratka_2 oc_nie_zgloszono_szo <?php echo ($odpowiedzialnosc_cywilna['zgl_szkode_na_os'] == '0') ? 'zaznaczone' : '' ; ?>"></span>
					nie zgłoszono szkody na osobie do ubezpieczyciela OC sprawcy
				</p>
				<div class="clear_b"></div>
			</div>
			<div class="zgloszenie_wiersz_elementow margin_t_10">
				<p>Odszkodowanie z OC sprawcy:</p>
				<div class="clear_b"></div>
				<p class="oc_odszkodowanie_oc_p_nie_wyplacono_o margin_t_10">
					<span
						class="kratka_2 oc_odszkodowanie_oc_p_nie_wyplacono  <?php echo ($odpowiedzialnosc_cywilna['co_z_oc'] == '1') ? 'zaznaczone' : '' ; ?>"></span>
					nie wypłacono
				</p>
				<div class="clear_b"></div>
				<p class="oc_odszkodowanie_oc_p_wyplacono_o">
					<span
						class="kratka_2 oc_odszkodowanie_oc_p_wyplacono <?php echo ($odpowiedzialnosc_cywilna['co_z_oc'] == '2') ? 'zaznaczone' : '' ; ?>"></span>
					wypłacono na szkodę w pojeździe
				</p>
				<div class="clear_b"></div>
				<p>
					<span
						class="kratka_2 oc_wyplacono_szo  <?php echo ($odpowiedzialnosc_cywilna['co_z_oc'] == '3') ? 'zaznaczone' : '' ; ?>"></span>
					wypłacono za szkodę osobową
				</p>
				<input type="text" name="" class="oc_wyplacono_szo_kwota" placeholder="Kwota"  value="<?php echo $odpowiedzialnosc_cywilna['kwota']; ?>"  style="display:<?php echo ($odpowiedzialnosc_cywilna['co_z_oc'] == '3') ? 'block' : 'none' ; ?>;" />
				<div class="clear_b"></div>
			</div>

			<div class="zgloszenie_wiersz_elementow element_input oc_wyplacono_szo_o"  style="display:<?php echo ($odpowiedzialnosc_cywilna['co_z_oc'] == '3') ? 'block' : 'none' ; ?>;" >
				<p>na podstawie:</p>
				<p class="on_wyplacono_szo_ugoda_o"><span class="kratka_2 on_wyplacono_szo_ugoda <?php echo ($odpowiedzialnosc_cywilna['podstawa'] == '1') ? 'zaznaczone' : '' ; ?>"></span>
					ugody
				</p>
				<p class="on_wyplacono_szo_wyrok_o"><span class="kratka_2 on_wyplacono_szo_wyrok <?php echo ($odpowiedzialnosc_cywilna['podstawa'] == '2') ? 'zaznaczone' : '' ; ?>"></span>
					wyroku
				</p>
				<p class="on_wyplacono_szo_decyzja_zd_o"><span class="kratka_2 on_wyplacono_szo_decyzja_zd <?php echo ($odpowiedzialnosc_cywilna['podstawa'] == '3') ? 'zaznaczone' : '' ; ?>"></span>
					decyzji z dnia:
				</p>

				<input type="text" name="" class="data on_wyplacono_szo_data" placeholder="Data decyzji" value="<?php echo $odpowiedzialnosc_cywilna['data_decyzji']; ?>" />

				<p class="on_wyplacono_szo_nie_wiem"><span class="kratka_2 on_wyplacono_szo_nie_wiem  <?php echo ($odpowiedzialnosc_cywilna['podstawa'] == '4') ? 'zaznaczone' : '' ; ?>"></span>
					nie wiem
				</p>
				<div class="clear_b"></div>
			</div>
		</div>

		<div
			class="zz_edytuj margin_t_10 zablokowane_pole_transparent odpowiedzialnosc_cywilna_zapisz_zmiany">ZAPISZ
			ZMIANY</div>
	</div>

	<div class="strona_umowy str_9 mop">
            	<?php
													
													$dochodzenie_roszczen = sprawa_pobierz_dane_z_tabeli_po_id ( 'sprawa_dochodzenie_roszczen', $sprawa ['sprawa_dochodzenie_roszczen_id'] );
													
													?>
                <p class="pozostale_roszczenia_naglowek_tresc">DOCHODZENIE
			ROSZCZEŃ</p>
		<div
			class="pozostale_roszczenia_naglowek_tresc_tresc dochodzenie_roszczen_id"
			data-dochodzenie_roszczen_id="<?php echo $sprawa['sprawa_dochodzenie_roszczen_id']; ?>">
			<div class="zgloszenie_wiersz_elementow">
				<p class="dr_nie_zlecano_innym_o">
					<span
						class="kratka_2 dr_nie_zlecano_innym  <?php echo ($dochodzenie_roszczen['czy_zlecono'] == '0') ? 'zaznaczone' : '' ; ?>"></span>
					nie zlecono wcześniej dochodzenia roszczeń żadnemu podmiotowi
				</p>
				<div class="clear_b"></div>
			</div>
			<div class="zgloszenie_wiersz_elementow  ">
				<p class="dr_zlecono_sprawe_o">
					<span
						class="kratka_2 dr_zlecono_sprawe  <?php echo ($dochodzenie_roszczen['czy_zlecono'] == '1') ? 'zaznaczone' : '' ; ?>"></span>
					sprawę zlecono wcześniej pełnomocnikowi
				</p>
				<input type="text" name="" class="dr_zs_nazwa dr_zlecono_sprawe_o_o" placeholder="Nazwa"  value="<?php echo $dochodzenie_roszczen['komu_zlecono']; ?>"   style="display:<?php echo ($dochodzenie_roszczen['czy_zlecono'] == '1') ? 'block' : 'none' ; ?>;" />
				<p class="dr_zlecono_sprawe_o_o"  style="display:<?php echo ($dochodzenie_roszczen['czy_zlecono'] == '1') ? 'block' : 'none' ; ?>;" >z
					którym zawarto umowę dnia</p>
				<input type="text" name="" class="data dr_zs_data_umowy dr_zlecono_sprawe_o_o" placeholder="Data" value="<?php echo $dochodzenie_roszczen['kiedy_zlecono']; ?>" style="display:<?php echo ($dochodzenie_roszczen['czy_zlecono'] == '1') ? 'block' : 'none' ; ?>;" />
				<div class="clear_b"></div>
			</div>
			<div class="zgloszenie_wiersz_elementow dr_zlecono_sprawe_o_o "  style="display:<?php echo ($dochodzenie_roszczen['czy_zlecono'] == '1') ? 'block' : 'none' ; ?>;"  >
				<p>
					<span
						class="kratka_2 dr_zs_wypowiedziano_umowe_opcja  <?php echo ($dochodzenie_roszczen['czy_wypowiedziano'] == '1') ? 'zaznaczone' : '' ; ?>"></span>
					umowę z wyżej wymienionym pełnomocnikiem wypowiedziano
				</p>
				<input type="text" name="" class="data dr_zs_wypowiedziano_umowe_data" placeholder="Data" value="<?php echo $dochodzenie_roszczen['kiedy_wypowiedziano']; ?>" style="display:<?php echo ($dochodzenie_roszczen['czy_zlecono'] == '1') ? 'block' : 'none' ; ?>;" />
				<div class="clear_b"></div>
			</div>

			<!-----------------medyk 24-08-2016------------------>

			<div class="zgloszenie_wiersz_elementow dr_zlecono_votum_o_o ">
				<p>Przekazałem pełnomocnikowi Votum S.A. dokumentację składającą się
					z</p>
				<input type="text" name="" class="dr_ile_kart" placeholder="ilosc"
					value="<?php echo ($dochodzenie_roszczen['ile_kart'] != '0') ? $dochodzenie_roszczen['ile_kart'] : '' ; ?>"
					style="display: block;" />
				<p>kart.</p>
				<div class="clear_b"></div>
				<div class="dr_informacje margin_t_10 margin_b_10">
					<p>Czy klient wyraża zgodę na otrzymywanie informacji związanych z
						wykonywaniem umowy?</p>
					<p class="dr_zgoda_o">
						<span
							class="kratka_2 dr_zgoda_tak <?php echo ($sprawa['zgoda_na_inf_sms'] == '1' OR $sprawa['zgoda_na_inf_email'] == '1') ? 'zaznaczone' : '' ; ?>"></span>
						Tak
					</p>
					<p>
						<span
							class="kratka_2 dr_zgoda_nie <?php echo (($sprawa['zgoda_na_inf_sms']) == '0' AND ($sprawa['zgoda_na_inf_email']) == '0') ? 'zaznaczone' : '' ; ?>"></span>
						Nie
					</p>
					<div class="clear_b"></div>
					<div class="dr_rodaj_inf_o">
						<p>
							<span
								class="kratka_2 dr_sms <?php echo ($sprawa['zgoda_na_inf_sms'] == '1') ? 'zaznaczone' : '' ; ?>"></span>
							wiadomości SMS na podany przeze mnie numer
						</p>
						<p>
							<span
								class="kratka_2 dr_email <?php echo ($sprawa['zgoda_na_inf_email'] == '1') ? 'zaznaczone' : '' ; ?>"></span>
							wiadomości e-mail na podany przeze mnie adres
						</p>
					</div>
				</div>

			</div>
			<!--------------------------------------------------->

		</div>

		<div
			class="zz_edytuj margin_t_10 zablokowane_pole_transparent dochodzenie_roszczen_zapisz_zmiany">ZAPISZ
			ZMIANY</div>
	</div>

	<div class="strona_umowy str_10 mop">
            	<?php
													
													$inne_odszkodowania = sprawa_pobierz_dane_z_tabeli_po_id ( 'sprawa_inne_odszkodowania', $sprawa ['sprawa_inne_odszkodowania_id'] );
													
													?>
                <p class="inne_odszkodowania_naglowek_tresc">INNE
			ODSZKODOWANIA</p>
		<div
			class="inne_odszkodowania_naglowek_tresc_tresc inne_odszkodowania_id"
			data-inne_odszkodowania_id="<?php echo $sprawa['sprawa_inne_odszkodowania_id']; ?>">
			<div class="zgloszenie_wiersz_elementow">
				<p>
					<span
						class="kratka_2 io_zgloszono_nnw  <?php echo ($inne_odszkodowania['zgloszono_nnw'] == '1') ? 'zaznaczone' : '' ; ?>"></span>
					zgłoszono szkodę do ubezpieczyciela NNW
				</p>
				<input type="text" name="" class="io_zgloszono_nnw_nazwa" placeholder="Nazwa ubezpieczyciela" value="<?php echo $inne_odszkodowania['komu_zgloszono']; ?>" style="display:<?php echo ($inne_odszkodowania['zgloszono_nnw'] == '1') ? 'block' : 'none' ; ?>;"  />
				<div class="clear_b"></div>
			</div>
			<div class="zgloszenie_wiersz_elementow sekcja_przy_obrazeniach" style="display:<?php echo ($sprawa['sprawa_typ_szkody_id'] == '1') ? 'block' : 'none' ; ?>;" >
				<p>
					<span
						class="kratka_2 io_uszczerbek_nnw  <?php echo ($inne_odszkodowania['uszczerbek_nnw'] == '1') ? 'zaznaczone' : '' ; ?>"></span>
					ubezpieczyciel NNW określił uszczerbek na zdrowiu na
				</p>
				<input type="text" name="" class="io_procent_uszczerbku_nnw"
						placeholder="procent uszczerbku"
						value="<?php echo $inne_odszkodowania['uszczerbek_nnw_procent']; ?>" style="display:<?php echo ($inne_odszkodowania['uszczerbek_nnw'] == '1') ? 'block' : 'none' ; ?>;"/>
				<div class="clear_b"></div>
			</div>
			<div class="zgloszenie_wiersz_elementow ">
				<p>Był to wypadek</p>
				<p class="io_wypadek_przy_pracy_o ">
					<span
						class="kratka_2 io_wypadek_przy_pracy io_wypadek_zgloszono  <?php echo ($inne_odszkodowania['jaki_wypadek'] == '1') ? 'zaznaczone' : '' ; ?>"></span>
					przy pracy
				</p>
				<p class="io_wypadek_w_drodze_do_pracy_o">
					<span
						class="kratka_2 io_wypadek_w_drodze_do_pracy  <?php echo ($inne_odszkodowania['jaki_wypadek'] == '2') ? 'zaznaczone' : '' ; ?>"></span>
					w drodze do lub z pracy
				</p>
				<div class="clear_b"></div>
			</div>
			<div class="inf_o_szkodzie" style="display:<?php echo ($inne_odszkodowania['gdzie_zgloszono_id'] != '0') ? 'block !important' : 'none' ; ?>;">
				<div class="zgloszenie_wiersz_elementow">
					<p>zgłoszono szkodę do</p>
					<p class="io_wypadek_zgloszono_zus_o ">
						<span
							class="kratka_2 io_wypadek_zgloszono_zus <?php echo ($inne_odszkodowania['gdzie_zgloszono_id'] == '1') ? 'zaznaczone' : '' ; ?>"></span>
						ZUS
					</p>
					<p class="io_wypadek_zgloszono_krus_o">
						<span
							class="kratka_2 io_wypadek_zgloszono_krus <?php echo ($inne_odszkodowania['gdzie_zgloszono_id'] == '2') ? 'zaznaczone' : '' ; ?>"></span>
						KRUS
					</p>
					<p class="io_wypadek_zgloszono_inne_o ">
						<span
							class="kratka_2 io_wypadek_zgloszono_inne <?php echo ($inne_odszkodowania['gdzie_zgloszono_id'] == '3') ? 'zaznaczone' : '' ; ?>"></span>
						inne
					</p>
					<input type="text" name="" class="io_wypadek_zgloszono_inne_nazwa" placeholder="Nazwa" value="<?php echo $inne_odszkodowania['inne_tekst']; ?>" style="display:<?php echo ($inne_odszkodowania['gdzie_zgloszono_id'] == '3') ? 'block' : 'none' ; ?>;" />
					<div class="clear_b"></div>
				</div>

				<div class="zgloszenie_wiersz_elementow sekcja_przy_obrazeniach" style="display:<?php echo ($sprawa['sprawa_typ_szkody_id'] == '1') ? 'block' : 'none' ; ?>;">
					<p>który określił uszczerbek na zdrowiu na</p>
					<input type="text" name="" class="io_procent_uszczerbku"
						placeholder="procent uszczerbku"
						value="<?php echo ($inne_odszkodowania['uszczerbek_ubezp_procent'] != '0') ? $inne_odszkodowania['uszczerbek_ubezp_procent'] : ''; ?>" />
					<div class="clear_b"></div>
				</div>
				<div class="zgloszenie_wiersz_elementow sekcja_przy_obrazeniach" style="display:<?php echo ($sprawa['sprawa_typ_szkody_id'] == '1') ? 'block' : 'none' ; ?>;">
					<p>
						<span
							class="kratka_2 jednorazowe_odszkodowanie <?php echo ($inne_odszkodowania['jednorazowe_odszkodowanie'] == '1') ? 'zaznaczone' : '' ; ?>"></span>
						przyznano jednorazowe odszkodowanie z tytułu wypadku przy pracy w
						wysokości
					</p>
					<input type="text" name="" class="io_kwota_odszkodowania"
						placeholder="kwota odszkodowania"
						value="<?php echo ($inne_odszkodowania['jednorazowe_odszkodowanie_kwota'] != '0') ? $inne_odszkodowania['jednorazowe_odszkodowanie_kwota'] : ''; ?>" />
					<div class="clear_b"></div>
				</div>
			</div>

			<div class="zgloszenie_wiersz_elementow sekcja_przy_smierci" style="display:<?php echo ($sprawa['sprawa_typ_szkody_id'] == '1') ? 'none' : 'block' ; ?>;">
				<p>
					<span
						class="kratka_2 io_przyznano_zasilek_p <?php echo ($inne_odszkodowania['zasilek_pogrzebowy'] == '1') ? 'zaznaczone' : '' ; ?>"></span>
					przyznano zasiłek pogrzebowy
				</p>
				<div class="clear_b"></div>
			</div>

			<div class="zgloszenie_wiersz_elementow sekcja_przy_obrazeniach" style="display:<?php echo ($sprawa['sprawa_typ_szkody_id'] == '1') ? 'block' : 'none' ; ?>;">
				<p>W związku z wypadkiem stwierdzono niezdolność do pracy na
					podstawie:</p>
				<div class="clear_b"></div>
				<p class="io_zwolnienie_lekarskie">
					<span
						class="kratka_2 zwolnienie_lekarskie  <?php echo ($inne_odszkodowania['zwolnienie'] == '1') ? 'zaznaczone' : '' ; ?>"></span>
					zwolnienia lekarskiego na okres od <input type="text" name=""
						class="data data_niezdolnosci_od" placeholder="od"
						value="<?php echo ($inne_odszkodowania['zwolnienie_od'] == '0000-00-00') ? '' : $inne_odszkodowania['zwolnienie_od']; ?>" />
					do <input type="text" name="" class="data data_niezdolnosci_do"
						placeholder="do"
						value="<?php echo ($inne_odszkodowania['zwolnienie_do'] == '0000-00-00') ? '' : $inne_odszkodowania['zwolnienie_do']; ?>" />
				</p>
				<div class="clear_b"></div>

				<p class="io_niezdolnosc_do_pracy">
					<span
						class="kratka_2 io_orzeczenie <?php echo ($inne_odszkodowania['orzeczenie'] == '1') ? 'zaznaczone' : '' ; ?>"></span>
					orzeczenia o niezdolności do pracy :
				</p>
				<p class="io_niezdolnosc_do_pracy">
					<span
						class="kratka_2 io_calkowite <?php echo ($inne_odszkodowania['orzeczenie_id'] == '1') ? 'zaznaczone' : '' ; ?>"></span>
					całkowitej
				</p>
				<p class="io_niezdolnosc_do_pracy">
					<span
						class="kratka_2 io_czesciowe <?php echo ($inne_odszkodowania['orzeczenie_id'] == '2') ? 'zaznaczone' : '' ; ?>"></span>
					częściowej
				</p>
				<p class="io_niezdolnosc_do_pracy">
					<span
						class="kratka_2 io_trwale <?php echo ($inne_odszkodowania['orzeczenie_id'] == '3') ? 'zaznaczone' : '' ; ?>"></span>
					trwałej
				</p>
				<p class="io_niezdolnosc_do_pracy">
					<span
						class="kratka_2 io_okresowe <?php echo ($inne_odszkodowania['orzeczenie_id'] == '4') ? 'zaznaczone' : '' ; ?>"></span>
					okresowej
				</p>
				<input type="text" name="" class="io_okresowe_data data"
						placeholder="do dnia"
						value="<?php echo ($inne_odszkodowania['orzeczenie_do'] == '0000-00-00') ? '' : $inne_odszkodowania['orzeczenie_do']; ?>" style="display:<?php echo ($inne_odszkodowania['orzeczenie_id'] == '4') ? 'block' : 'none' ; ?>;"/>
				<div class="clear_b"></div>

				<p class="io_niezdolnosc_do_pracy">
					<span
						class="kratka_2 io_zus <?php echo ($inne_odszkodowania['niezdolnosc_ubezpieczyciel_id'] == '1') ? 'zaznaczone' : '' ; ?>"></span>
					ZUS
				</p>
				<p class="io_niezdolnosc_do_pracy">
					<span
						class="kratka_2 io_krus <?php echo ($inne_odszkodowania['niezdolnosc_ubezpieczyciel_id'] == '2') ? 'zaznaczone' : '' ; ?>"></span>
					KRUS
				</p>
				<p class="io_niezdolnosc_do_pracy">
					<span
						class="kratka_2 io_inne <?php echo ($inne_odszkodowania['niezdolnosc_ubezpieczyciel_id'] == '3') ? 'zaznaczone' : '' ; ?>"></span>
					inne
				</p>
				<input type="text" name="" class="io_inne_nazwa" placeholder="nazwa"
					value="<?php echo $inne_odszkodowania['niezdolnosc_ubezpieczyciel_inne']; ?>" />
				<p class="io_niezdolnosc_do_pracy">
					przyznal <span
						class="kratka_2 io_renta <?php echo ($inne_odszkodowania['swiadczenie_id'] == '1') ? 'zaznaczone' : '' ; ?>"></span>
					rentę
				</p>
				<p>
					<span
						class="kratka_2 io_inne_swiadczenie <?php echo ($inne_odszkodowania['swiadczenie_id'] == '2') ? 'zaznaczone' : '' ; ?>"></span>
					inne
				</p>
				<input type="text" name="" class="io_inne_swiadczenie_nazwa"
						placeholder="nazwa świadczenia"
						value="<?php echo $inne_odszkodowania['swiadczenie_inne']; ?>" style="display:<?php echo ($inne_odszkodowania['swiadczenie_id'] == '2') ? 'block' : 'none' ; ?>;"/>
				<div class="clear_b"></div>
				<p>w wysokości</p>
				<input type="text" name="" class="io_kwota_swiadczenia"
					placeholder="kwota świadczenia"
					value="<?php echo ($inne_odszkodowania['kwota_swiadczenia'] != '0') ? $inne_odszkodowania['kwota_swiadczenia'] : ''; ?>" />
				<p>zł miesięcznie, na okres do</p>
				<input type="text" name="" class="io_okres_swiadczenia data"
					placeholder="do kiedy"
					value="<?php echo ($inne_odszkodowania['okres_swiadczenia'] == '0000-00-00') ? '' : $inne_odszkodowania['okres_swiadczenia']; ?>" />

			</div>

			<div class="zgloszenie_wiersz_elementow">
				<p>
					<span
						class="kratka_2 zsz_pf <?php echo ($inne_odszkodowania['oferta_finansowa'] == '1') ? 'zaznaczone' : '' ; ?>"></span>
					Jestem zainteresowany ofertą produktów finansowych
				</p>
				<div class="clear_b"></div>
			</div>

			<!-----------------medyk 24-08-2016------------------>

			<div class="zgloszenie_wiersz_elementow io_zgody_o "  style="display:<?php echo ($sprawa['sprawa_typ_szkody_id'] == '1') ? 'block' : 'none' ; ?>;"  >

				<p>
					<span
						class="kratka_2 zsz_pcrf <?php echo ($inne_odszkodowania['pcrf'] == '1') ? 'zaznaczone' : '' ; ?>"></span>
				
				
				<div class="blok">Jestem zainteresowana/y ofertą rehabilitacyjną i
					wyrażam zgodę na przekazywanie PCRF Votum S.A. Sp. k. w Krakowie
					moich danych osobowych lub danych osobowych małoletniego /
					ubezwłasnowolnionego / małżonka, którego reprezentuję, w tym
					informacji dotyczących stanu zdrowia, w celu opracowania i
					przedstawienia oferty.</div>
				</p>

				<div class="clear_b"></div>

				<div class="zgloszenie_wiersz_elementow ">
					<p>
						<span
							class="kratka_2 zsz_fundacja <?php echo ($inne_odszkodowania['fundacja'] == '1') ? 'zaznaczone' : '' ; ?>"></span>
					
					
					<div class="blok">Jestem zainteresowana/y objęciem mnie pomocą
						przez Fundację VOTUM i wyrażam zgodę na przekazanie Fundacji VOTUM
						we Wrocławiu moich danych osobowych lub danych osobowych
						małoletniego / ubezwłasnowolnionego / małżonka, którego
						reprezentuję, w tym informacji dotyczących stanu zdrowia, w celu
						opracowania i przedstawienia możliwego zakresu pomocy.</div>
					</p>
				</div>
				<div class="clear_b"></div>

				<div class="zgloszenie_wiersz_elementow ">
					<p>
						<span
							class="kratka_2 zsz_gamma <?php echo ($inne_odszkodowania['gamma'] == '1') ? 'zaznaczone' : '' ; ?>"></span>
					
					
					<div class="blok">Jestem zainteresowana/y ofertą usług medycznych i
						wyrażam zgodę na przekazywanie „Centrum Medycznemu Gamma” Sp. z
						o.o. w Warszawie moich danych osobowych lub danych osobowych
						małoletniego / ubezwłasnowolnionego / małżonka, którego
						reprezentuję, w tym informacji dotyczących stanu zdrowia, w celu
						opracowania i przedstawienia oferty.</div>
					</p>
				</div>
				<div class="clear_b"></div>

				<div class="zgloszenie_wiersz_elementow ">
					<p>
						<span
							class="kratka_2 zsz_dzialalnosc <?php echo ($inne_odszkodowania['dzialalnosc'] == '1') ? 'zaznaczone' : '' ; ?>"></span>
					
					
					<div class="blok">Oświadczam, że prowadzę pozarolniczą działalność
						gospodarczą.</div>
					</p>
				</div>
			</div>
			<div class="clear_b"></div>

			<!--------------------------------------------------->

		</div>

		<div
			class="zz_edytuj margin_t_10 zablokowane_pole_transparent inne_odszkodowania_zapisz_zmiany">ZAPISZ
			ZMIANY</div>
	</div>

	<div class="strona_umowy str_11 mop">
		<div class="promedica_optima" style="display:<?php echo ($sprawa['sprawa_typ_szkody_id'] == '1') ? 'block' : 'none'; ?> ;">
            
            <?php
												
												$oswiadczenie_poszkodowanego = sprawa_pobierz_dane_z_tabeli_po_id ( 'sprawa_oswiadczenie_poszkodowanego', $sprawa ['sprawa_oswiadczenie_poszkodowanego_id'] );
												
												$leczenie = sprawa_pobierz_dane_z_tabeli_po_id ( 'sprawa_leczenie', $sprawa ['sprawa_leczenie_id'] );
												
												$przebieg_leczenia = sprawa_pobierz_dane_z_tabeli_po_id ( 'sprawa_przebieg_leczenia', $sprawa ['sprawa_przebieg_leczenia_id'] );
												
												$hospitalizacja = sprawa_pobierz_miejsce_hospitalizacji ( $sprawa ['sprawa_przebieg_leczenia_id'] );
												
												$zabiegi = sprawa_pobierz_placowki ( $sprawa ['sprawa_przebieg_leczenia_id'] );
												?>
            
            <p
				class="oswiadzczenie_osoby_poszkodowanej_naglowek_tresc margin_b_10"
				data-oswiadczenie_poszkodowanego_id="<?php echo $sprawa['sprawa_oswiadczenie_poszkodowanego_id']; ?>"
				data-leczenie_id="<?php echo $sprawa['sprawa_leczenie_id']; ?>"
				data-przebieg_leczenia_id="<?php echo $sprawa['sprawa_przebieg_leczenia_id']; ?>">OŚWIADCZENIE
				OSOBY POSZKODOWANEJ</p>

			<div class="zgloszenie_wiersz_elementow ">
				<p>
                        Ja, <?php echo $poszkodowany['imie'].' '.$poszkodowany['nazwisko']; ?> oświadczam, że jestem świadomy odpowiedzialności karnej za wprowadzenie w błąd ubezpieczyciela w celu osiągnięcia korzyści majątkowej, oświadczam, iż byłem uczestnikiem wypadku komunikacyjnego, który miał miejsce w <?php echo $zdarzenie['miejsce']; ?>	
                        w dniu <?php echo $zdarzenie['data']; ?>
                        około godziny <?php echo $zdarzenie['godzina']; ?>.
                        </p>
			</div>
			<div class="clear_b"></div>
			<div class="zgloszenie_wiersz_elementow margin_t_10">
				<p>W chwili zdarzenia</p>
				<p class="oz_pod_wplywem_o">
					<span
						class="kratka_2 oz_pod_wplywem <?php echo ($oswiadczenie_poszkodowanego['pod_wplywem'] == '1') ? 'zaznaczone' : '' ; ?>"></span>
					byłem/-am
				</p>
				<p class="oz_nie_pod_wplywem_o">
					<span
						class="kratka_2 oz_nie_pod_wplywem <?php echo ($oswiadczenie_poszkodowanego['pod_wplywem'] == '0') ? 'zaznaczone' : '' ; ?>"></span>
					nie byłem/-am pod wpływem:
				</p>
				<div class="clear_b"></div>
				<p class="oz_alkohol_o">
					<span
						class="kratka_2 oz_alkohol <?php echo ($oswiadczenie_poszkodowanego['sprawa_uzywki_id'] == '1') ? 'zaznaczone' : '' ; ?>"></span>
					alkoholu
				</p>
				<p class="oz_narkotyki_o">
					<span
						class="kratka_2 oz_narkotyki <?php echo ($oswiadczenie_poszkodowanego['sprawa_uzywki_id'] == '2') ? 'zaznaczone' : '' ; ?>"></span>
					narkotyków
				</p>
				<p class="oz_inne_srodki_o">
					<span
						class="kratka_2 oz_inne_srodki <?php echo ($oswiadczenie_poszkodowanego['sprawa_uzywki_id'] == '3') ? 'zaznaczone' : '' ; ?>"></span>
					innych środków odurzających.
				</p>
			</div>
			<div class="clear_b"></div>
			<div class="zgloszenie_wiersz_elementow margin_t_10">
				<p>Poszkodowany znajdował się</p>
				<p class="oz_poza_pojazdem_o">
					<span
						class="kratka_2 oz_poza_pojazdem <?php echo ($oswiadczenie_poszkodowanego['w_pojezdzie'] == '0') ? 'zaznaczone' : '' ; ?>"></span>
					poza pojazdem
				</p>
				<p class="oz_w_pojezdzie_o">
					<span
						class="kratka_2 oz_w_pojezdzie <?php echo ($oswiadczenie_poszkodowanego['w_pojezdzie'] == '1') ? 'zaznaczone' : '' ; ?>"></span>
					w pojeździe.
				</p>
			</div>
			<div class="clear_b"></div>
			<div class="zgloszenie_wiersz_elementow margin_t_10 poza_pojazdem" style="display:<?php echo ($oswiadczenie_poszkodowanego['w_pojezdzie'] == '0') ? 'block' : 'none'; ?> ;">
				<p>Byłem/-am</p>
				<p class="oz_pieszy_o">
					<span
						class="kratka_2 oz_pieszy <?php echo ($oswiadczenie_poszkodowanego['rola'] == '1') ? 'zaznaczone' : '' ; ?>"></span>
					pieszym/-ą
				</p>
				<p class="oz_rowerzysta_o">
					<span
						class="kratka_2 oz_rowerzysta <?php echo ($oswiadczenie_poszkodowanego['rola'] == '2') ? 'zaznaczone' : '' ; ?>"></span>
					rowerzystą/-ką
				
				
				<div class="clear_b"></div>
                        i zostałem/-am potrącony/-a przez pojazd marki <?php echo $zdarzenie_pojazd_b['marka']; ?> o nr. rej. <?php echo $zdarzenie_pojazd_b['nr_rejestracyjny']; ?></p>
			</div>
			<div class="clear_b"></div>
			<div class="zgloszenie_wiersz_elementow margin_t_10 w_pojezdzie" style="display:<?php echo ($oswiadczenie_poszkodowanego['w_pojezdzie'] == '1') ? 'block' : 'none'; ?> ;">
				<p>Typ pojazdu:</p>
				<p class="oz_samochod_o">
					<span
						class="kratka_2 oz_samochod <?php echo ($oswiadczenie_poszkodowanego['sprawa_typ_pojazdu_id'] == '1') ? 'zaznaczone' : '' ; ?>"></span>
					samochód
				</p>
				<p class="oz_komunikacja_o">
					<span
						class="kratka_2 oz_komunikacja <?php echo ($oswiadczenie_poszkodowanego['sprawa_typ_pojazdu_id'] == '2') ? 'zaznaczone' : '' ; ?>"></span>
					komunikacja zbiorowa
				</p>
				<p class="oz_inne_o">
					<span
						class="kratka_2 oz_inne <?php echo ($oswiadczenie_poszkodowanego['sprawa_typ_pojazdu_id'] == '3') ? 'zaznaczone' : '' ; ?>"></span>
					inne
				</p>
				<input type="text" name="" class="oz_inne_nazwa" placeholder="inny pojazd" value="<?php echo $oswiadczenie_poszkodowanego['typ_pojazdu_inny']; ?>" style="display:<?php echo ($oswiadczenie_poszkodowanego['sprawa_typ_pojazdu_id'] == '3') ? 'block' : 'none' ; ?>;"/>
				<div class="clear_b"></div>
				<p>W pojeździe marki <?php echo $zdarzenie_pojazd_a['marka']; ?> o numerze rej. <?php echo $zdarzenie_pojazd_a['nr_rejestracyjny']; ?> byłem/-am: </p>
				<div class="clear_b"></div>
				<p class="oz_kierowca_o">
					<span
						class="kratka_2 oz_kierowca <?php echo ($oswiadczenie_poszkodowanego['sprawa_pozycja_id'] == '1') ? 'zaznaczone' : '' ; ?>"></span>
					kierowcą
				</p>
				<p class="oz_pasazer_o">
					<span
						class="kratka_2 oz_pasazer <?php echo ($oswiadczenie_poszkodowanego['sprawa_pozycja_id'] != '1') ? 'zaznaczone' : '' ; ?>"></span>
					pasażerem
				</p>
				<div class="clear_b"></div>
				<div class='pozycja_pasazera' style="display:<?php echo ($oswiadczenie_poszkodowanego['sprawa_pozycja_id'] != '1') ? 'block' : 'none'; ?> ;">
					<p>siedziałem/-am</p>
					<p class="oz_obok_kierowcy_o">
						<span
							class="kratka_2 oz_obok_kierowcy <?php echo ($oswiadczenie_poszkodowanego['sprawa_pozycja_id'] == '3') ? 'zaznaczone' : '' ; ?>"></span>
						obok kierowcy
					</p>
					<p class="oz_z_tylu_kierowcy_o">
						<span
							class="kratka_2 oz_z_tylu_kierowcy <?php echo ($oswiadczenie_poszkodowanego['sprawa_pozycja_id'] == '4') ? 'zaznaczone' : '' ; ?>"></span>
						z tyłu za kierowcą
					</p>
					<p class="oz_za_pasazerem_o">
						<span
							class="kratka_2 oz_za_pasazerem <?php echo ($oswiadczenie_poszkodowanego['sprawa_pozycja_id'] == '5') ? 'zaznaczone' : '' ; ?>"></span>
						z tyłu za przednim pasażerem
					</p>
					<p class="oz_posrodku_o">
						<span
							class="kratka_2 oz_posrodku <?php echo ($oswiadczenie_poszkodowanego['sprawa_pozycja_id'] == '6') ? 'zaznaczone' : '' ; ?>"></span>
						z tyłu pośrodku
					</p>
					<div class="clear_b"></div>
					<p class="oz_inne_miejsce_o">
						<span
							class="kratka_2 oz_inne_miejsce <?php echo ($oswiadczenie_poszkodowanego['sprawa_pozycja_id'] == '7') ? 'zaznaczone' : '' ; ?>"></span>
						inne
					</p>
					<input type="text" name="" class="oz_inne_miejsce_nazwa" placeholder="inne miejsce" value="<?php echo $oswiadczenie_poszkodowanego['pozycja_inna']; ?>" style="display:<?php echo ($oswiadczenie_poszkodowanego['sprawa_pozycja_id'] == '7') ? 'block' : 'none' ; ?>;"/>
				</div>
				<div class="clear_b"></div>

				<p>W chwili zdarzenia</p>


				<p class="oz_byly_pasy_o">
					<span
						class="kratka_2 oz_byly_pasy <?php echo ($oswiadczenie_poszkodowanego['pasy'] == '1') ? 'zaznaczone' : '' ; ?>"></span>
					miałem/-am
				</p>
				<p class="oz_bez_pasow_o">
					<span
						class="kratka_2 oz_bez_pasow <?php echo ($oswiadczenie_poszkodowanego['pasy'] == '2') ? 'zaznaczone' : '' ; ?>"></span>
					nie miałem/-am zapiętych pasów bezpieczeństwa (założony kask).
				</p>
				<div class="clear_b"></div>
				<p class="oz_jestem_posiadaczem_o">
					<span
						class="kratka_2 oz_jestem_posiadaczem <?php echo ($oswiadczenie_poszkodowanego['wspolwlasnosc'] == '1') ? 'zaznaczone' : '' ; ?>"></span>
				</p>
				<p>Jestem</p>
				<p class="oz_nie_jestem_posiadaczem_o">
					<span
						class="kratka_2 oz_nie_jestem_posiadaczem <?php echo ($oswiadczenie_poszkodowanego['wspolwlasnosc'] == '2') ? 'zaznaczone' : '' ; ?>"></span>
				</p>
				<p>nie jestem współposiadaczem wyżej wymienionego pojazdu.</p>
			</div>
			<div class="clear_b"></div>
			<div
					class="zgloszenie_wiersz_elementow margin_t_10 o_kierujacym picie_kierowca" style="display:<?php echo ($oswiadczenie_poszkodowanego['w_pojezdzie'] == '1') ? 'block' : 'none' ; ?>">
				<p>Wsiadając do pojazdu przed wypadkiem:</p>
				<div class="clear_b"></div>
				<p class="oz_wiedza_o_piciu_o">
					<span
						class="kratka_2 oz_wiedza_o_piciu <?php echo ($oswiadczenie_poszkodowanego['wiedza_o_stanie_kierowcy'] == '1') ? 'zaznaczone' : '' ; ?>"></span>
					wiedziałem/-am
				</p>
				<p class="oz_brak_wiedzy_o_piciu_o">
					<span
						class="kratka_2 oz_brak_wiedzy_o_piciu <?php echo ($oswiadczenie_poszkodowanego['wiedza_o_stanie_kierowcy'] == '0') ? 'zaznaczone' : '' ; ?>"></span>
					nie wiedziałem/-am,
				
				
				<div class="clear_b"></div>
				że kierujący pojazdem przed zajęciem miejsca za kierownicą spożywał
				alkohol lub inne środki odurzające.
				</p>
				<div class="clear_b"></div>
			</div>
			<div
					class="zgloszenie_wiersz_elementow margin_t_10 o_kierujacym prawko_kierowca" style="display:<?php echo ($oswiadczenie_poszkodowanego['w_pojezdzie'] == '1') ? 'block' : 'none' ; ?>">
				<p>Wsiadając do pojazdu przed wypadkiem:</p>
				<div class="clear_b"></div>
				<p class="oz_wiedza_o_prawku_o">
					<span
						class="kratka_2 oz_wiedza_o_prawku <?php echo ($oswiadczenie_poszkodowanego['wiedza_o_upr_kierowcy'] == '1') ? 'zaznaczone' : '' ; ?>"></span>
					wiedziałem/-am
				</p>
				<p class="oz_brak_wiedzy_o_prawku_o">
					<span
						class="kratka_2 oz_brak_wiedzy_o_prawku <?php echo ($oswiadczenie_poszkodowanego['wiedza_o_upr_kierowcy'] == '0') ? 'zaznaczone' : '' ; ?>"></span>
					nie wiedziałem/-am,
				
				
				<div class="clear_b"></div>
				że kierujący pojazdem nie posiada uprawnień do kierowania pojazdem
				mechanicznym.
				</p>
			</div>
			<div class="clear_b"></div>
			<p
				class="oswiadzczenie_osoby_poszkodowanej_naglowek_tresc margin_b_10">LECZENIE</p>
			<div class="zgloszenie_wiersz_elementow leczenie">
				<p>Oświadczam, że leczenie następstw doznanych obrażeń</p>
				<div class="clear_b"></div>
				<p class="lecz_koniec_o">
					<span
						class="kratka_2 lecz_koniec <?php echo ($leczenie['sprawa_stan_leczenia_id'] == '1') ? 'zaznaczone' : '' ; ?>"></span>
					zakończyło się z dniem
				</p>
				<input type="data" name="" class="data lecz_koniec_data"
					placeholder="data zakończenia"
					value="<?php echo ($leczenie['sprawa_stan_leczenia_id'] == '1') ? $leczenie['leczenie_koniec'] : '' ?>"
					style="display: block;" />
				<div class="clear_b"></div>
				<p class="lecz_plan_koniec_o">
					<span
						class="kratka_2 lecz_plan_koniec <?php echo ($leczenie['sprawa_stan_leczenia_id'] == '2') ? 'zaznaczone' : '' ; ?>"></span>
					jeszcze się nie zakończyło, a przewidywany przez lekarzy termin
					jego ukończenia to
				</p>
				<input type="data" name="" class="data lecz_data_plan_zak"
					placeholder="planowany koniec"
					value="<?php echo ($leczenie['sprawa_stan_leczenia_id'] == '2') ? $leczenie['leczenie_plan_koniec'] : '' ?>"
					style="display: block;" />
				<div class="clear_b"></div>
				<p class="lecz_brak_terminu_o">
					<span
						class="kratka_2 lecz_brak_terminu <?php echo ($leczenie['sprawa_stan_leczenia_id'] == '3') ? 'zaznaczone' : '' ; ?>"></span>
					jeszcze się nie zakończyło, a przewidywany termin jego ukończenia
					nie jest mi znany,
				</p>
				<div class="clear_b"></div>
				<p class="lecz_zabiegi_o">
					<span
						class="kratka_2 lecz_zabiegi <?php echo ($leczenie['sprawa_stan_leczenia_id'] == '4') ? 'zaznaczone' : '' ; ?>"></span>
					planowane są jeszcze zabiegi operacyjne.
				</p>
			</div>
			<div class="clear_b"></div>
			<div class="zgloszenie_wiersz_elementow leczenie margin_t_10">
				Jednocześnie informuję, że w związku z doznanymi obrażeniami
				przebywałem na zwolnieniu chorobowym w okresie od dnia
				</p>
				<input type="data" name="" class="data od_kiedy_l4"
					placeholder="od kiedy"
					value="<?php echo ($leczenie['data_pocz_zw'] == '0000-00-00') ? '' : $leczenie['data_pocz_zw'] ?>"
					style="display: block;" />
				<p class="lecz_na_zwolnieniu_do_o">
					<span
						class="kratka_2 lecz_na_zwolnieniu_do <?php echo ($leczenie['data_kon_zw'] == '0000-00-00') ? '' : 'zaznaczone' ?>"></span>
					do dnia
				</p>
				<input type="data" name="" class="data do_kiedy_l4"
					placeholder="do kiedy"
					value="<?php echo ($leczenie['data_kon_zw'] == '0000-00-00') ? '' : $leczenie['data_kon_zw'] ?>"
					style="display: block;" />
				<p class="lecz_na_zwolnieniu_o">
					<span
						class="kratka_2 lecz_na_zwolnieniu <?php echo ($leczenie['data_kon_zw'] == '0000-00-00') ? 'zaznaczone' : '' ?>"></span>
					nadal przebywam na zwolnieniu.
				</p>
			</div>
			<div class="clear_b"></div>
			<p
				class="oswiadzczenie_osoby_poszkodowanej_naglowek_tresc margin_b_10">PRZEBIEG
				LECZENIA (doznane urazy i odczuwane dolegliwości należy opisać w
				OŚWIADCZENIU)</p>
			<div class="zgloszenie_wiersz_elementow przebieg_leczenia">
				<p class="pl_pogotowie_o margin_b_10">
					<span
						class="kratka_2 pl_pogotowie <?php echo ($przebieg_leczenia['skad_pogotowie'] == '') ? '' : 'zaznaczone' ?>"></span>
					na miejsce zdarzenia wezwano pogotowie z:
				</p>
				<input type="text" name="" class="szpital"
					placeholder="miejscowość, szpital"
					value="<?php echo ($przebieg_leczenia['skad_pogotowie'] == '') ? '' : $przebieg_leczenia['skad_pogotowie'] ?>"
					style="display: block;" />
				<div class="clear_b"></div>

				<div class="przychodnia_blok">
					<p class="pl_przychodnia_o">
						<span
							class="kratka_2 pl_przychodnia <?php echo ($przebieg_leczenia['przychodnia'] == '') ? '' : 'zaznaczone' ?>"></span>
						poszkodowany sam zgłosił się do lekarza
					</p>
					<input type="text" name="" class="przychodnia margin_t_10" placeholder="dane lekarza, przychodni" value="<?php echo ($przebieg_leczenia['przychodnia'] == '') ? '' : $przebieg_leczenia['przychodnia'] ?>" style="display:<?php echo ($przebieg_leczenia['przychodnia'] != '') ? 'block' : 'none' ; ?>;"/>
					<p class="pl_przychodnia_tekst_o margin_t_10"
						style="display: none;">w dniu</p>
					<input type="data" name="" class="data przychodnia_data margin_t_10" placeholder="data zgłoszenia" value="<?php echo ($przebieg_leczenia['przychodnia_data'] == '0000-00-00') ? '' : $przebieg_leczenia['przychodnia_data'] ?>" style="display:<?php echo ($przebieg_leczenia['przychodnia'] != '') ? 'block' : 'none' ; ?>;"/>
				</div>
				<div class="clear_b"></div>


				<p class="pl_hospitalizacja_o margin_t_10"
					data-id_przebieg_leczenia="<?php echo $przebieg_leczenia['id']; ?>"
					data-row="<?php echo mysqli_num_rows($hospitalizacja); ?>">
					<span
						class="kratka_2 pl_hospitalizacja <?php echo (mysqli_num_rows($hospitalizacja) > 0) ? 'zaznaczone' : '' ?>" /></span>
					po wypadku poszkodowany był hospitalizowany w
				</p>
				<div class="clear_b"></div>
                

                <?php
																
																if (mysqli_num_rows ( $hospitalizacja ) > 0) {
																	$display = 'block';
																} else {
																	$display = 'none';
																}
																
																$licznik = mysqli_num_rows ( $hospitalizacja );
																
																if (! isset ( $licznik )) {
																	$licznik = 0;
																} else
																	$licznik = mysqli_num_rows ( $hospitalizacja );
																	
																	// $licznik = mysqli_num_rows ( $hospitalizacja );
																
																if ($licznik == 1) {
																	$hospitalizacja_dane = mysqli_fetch_assoc ( $hospitalizacja );
																	echo "<div class='lh leczenie_hospitalizacja_" . $licznik . " element_input' data-row='" . $licznik . "' data-id_hospitalizacji='" . $hospitalizacja_dane ['id'] . "'>";
																	echo "<input type='text' name='' class='hospitalizacja' placeholder='miejsce hospitalizacji' value='" . $hospitalizacja_dane ['nazwa'] . "' style='display:'" . $display . "';'/>";
                                                                    echo "<input type='data' name='' class='data hospitalizacja_data' placeholder='data od' value='" . $hospitalizacja_dane ['data'] . "' style='display:'" . $display . "';'/>";
                                                                    echo "<input type='data' name='' class='data hospitalizacja_data_do' placeholder='data do' value='" . $hospitalizacja_dane ['data_do'] . "' style='display:'" . $display . "';'/>";
																	echo "<span class='dodaj_szpital' title='Dodaj szpital' onclick='dodaj_szpital()' style='display:'" . $display . "';'></span>";
																	echo "</div>";
																} else if ($licznik < 1) {
																	
																	echo "<div class='lh leczenie_hospitalizacja_" . $licznik . " element_input' data-row='" . $licznik . "' data-id_hospitalizacji='" . $hospitalizacja_dane ['id'] . "'>";
																	echo "<input type='text' name='' class='hospitalizacja' placeholder='miejsce hospitalizacji' value='" . $hospitalizacja_dane ['nazwa'] . "' style='display:'" . $display . "';'/>";
																	echo "<input type='data' name='' class='data hospitalizacja_data' placeholder='data od' value='" . $hospitalizacja_dane ['data'] . "' style='display:'" . $display . "';'/>";
                                                                    echo "<input type='data' name='' class='data hospitalizacja_data_do' placeholder='data do' value='" . $hospitalizacja_dane ['data_do'] . "' style='display:'" . $display . "';'/>";
																	echo "<span class='dodaj_szpital' title='Dodaj szpital' onclick='dodaj_szpital()' style='display:'" . $display . "';'></span>";
																	echo "</div>";
																} else if ($licznik > 1) {
																	$i = 1;
																	
																	while ( $hospitalizacja_dane = mysqli_fetch_assoc ( $hospitalizacja ) ) {
																		
																		echo "<div class='lh leczenie_hospitalizacja_" . $i . " element_input' data-row='" . $i . "' data-id_hospitalizacji='" . $hospitalizacja_dane ['id'] . "'>";
                                                                        echo "<input type='text' name='' class='hospitalizacja' placeholder='miejsce hospitalizacji' value='" . $hospitalizacja_dane ['nazwa'] . "' style='display:'" . $display . "';'/>";
                                                                        echo "<input type='data' name='' class='data hospitalizacja_data_do' placeholder='data do' value='" . $hospitalizacja_dane ['data'] . "' style='display:'" . $display . "';'/>";
																		echo "<input type='data' name='' class='data hospitalizacja_data' placeholder='data hospitalizacji' value='" . $hospitalizacja_dane ['data_do'] . "' style='display:'" . $display . "';'/>";
																		if ($i == 1) {
																			echo "<span class='dodaj_szpital' title='Dodaj szpital' onclick='dodaj_szpital()' style='display:'" . $display . "';'></span>";
																			$i ++;
																		} else {
																			echo "<span class='usun_szpital' title='Usun szpital' onclick='usun_szpital(" . $i . ", " . $hospitalizacja_dane ['id'] . ")' style='display:'" . $display . "';'></span>";
																			$i ++;
																		}
																		echo "</div>";
																	}
																}
																
																?>
              
                <div class="clear_b"></div>


				<p class="pl_zabiegi_o margin_t_10"
					data-id_przebieg_leczenia="<?php echo $przebieg_leczenia['id']; ?>"
					data-row="<?php echo mysqli_num_rows($zabiegi); ?>">
					<span
						class="kratka_2 pl_zabiegi <?php echo (mysqli_num_rows($zabiegi) > 0) ? 'zaznaczone' : '' ?>" /></span>
					przeprowadzono zabiegi operacyjne
				</p>
				<div class="clear_b"></div>
                

                <?php
																
																if (mysqli_num_rows ( $zabiegi ) > 0) {
																	$display = 'block';
																} else {
																	$display = 'none';
																}
																
																$licznik_placowek = mysqli_num_rows ( $zabiegi );
																
																if (! isset ( $licznik_placowek )) {
																	$licznik_placowek = 0;
																} else
																	$licznik_placowek = mysqli_num_rows ( $zabiegi );
																	
																	// $licznik_placowek = mysqli_num_rows ( $zabiegi );
																
																if ($licznik_placowek == 1) {
																	$zabiegi_dane = mysqli_fetch_assoc ( $zabiegi );
																	echo "<div class='pz placowki_zabiegi_" . $licznik_placowek . " element_input' data-row='" . $licznik_placowek . "' data-id_placowek='" . $zabiegi_dane ['id'] . "'>";
																	echo "<input type='text' name='' class='placowka_zabieg' placeholder='Adres placówki medycznej, w której leczono poszkodowanego w związku z wypadkiem' value='" . $zabiegi_dane ['nazwa'] . "' style='display:'" . $display . "';'/>";
																	echo "<input type='data' name='' class='data placowka_zabieg_data' placeholder='data zabiegu' value='" . $zabiegi_dane ['data'] . "' style='display:'" . $display . "';'/>";
																	echo "<span class='dodaj_zabieg' title='Usun zabieg' onclick='dodaj_zabieg()' style='display:'" . $display . "';'></span>";
																	echo "</div>";
																} else if ($licznik_placowek < 1) {
																	
																	echo "<div class='pz placowki_zabiegi_" . $licznik_placowek . " element_input' data-row='" . $licznik_placowek . "' data-id_placowek='" . $zabiegi_dane ['id'] . "'>";
																	echo "<input type='text' name='' class='placowka_zabieg' placeholder='Adres placówki medycznej, w której leczono poszkodowanego w związku z wypadkiem' value='" . $zabiegi_dane ['nazwa'] . "' style='display:'" . $display . "';'/>";
																	echo "<input type='data' name='' class='data placowka_zabieg_data' placeholder='data zabiegu' value='" . $zabiegi_dane ['data'] . "' style='display:'" . $display . "';'/>";
																	echo "<span class='dodaj_zabieg' title='Usun zabieg' onclick='dodaj_zabieg()' style='display:'" . $display . "';'></span>";
																	echo "</div>";
																} else if ($licznik_placowek > 1) {
																	
																	$j = 1;
																	
																	while ( $zabiegi_dane = mysqli_fetch_assoc ( $zabiegi ) ) {
																		
																		echo "<div class='pz placowki_zabiegi_" . $j . " element_input' data-row='" . $j . "' data-id_placowek='" . $zabiegi_dane ['id'] . "'>";
																		echo "<input type='text' name='' class='placowka_zabieg' placeholder='Adres placówki medycznej, w której leczono poszkodowanego w związku z wypadkiem' value='" . $zabiegi_dane ['nazwa'] . "' style='display:'" . $display . "';'/>";
																		echo "<input type='data' name='' class='data placowka_zabieg_data' placeholder='data zabiegu' value='" . $zabiegi_dane ['data'] . "' style='display:'" . $display . "';'/>";
																		if ($j == 1) {
																			echo "<span class='dodaj_zabieg' title='Dodaj zabieg' onclick='dodaj_zabieg()' style='display:'" . $display . "';'></span>";
																			$j ++;
																		} else {
																			echo "<span class='usun_zabieg' title='Usun zabieg' onclick='usun_zabieg(" . $j . ", " . $zabiegi_dane ['id'] . ")' style='display:'" . $display . "';'></span>";
																			$j ++;
																		}
																		echo "</div>";
																	}
																}
																
																?>
                <div class="clear_b"></div>
			</div>
			<div class="clear_b"></div>
			<div
				class="zz_edytuj margin_t_10 zablokowane_pole_transparent oswiadczenie_poszkodowanego_zapisz_zmiany">ZAPISZ
				ZMIANY</div>

		</div>


		<div class="maxima_optima" style="display:<?php echo ($sprawa['sprawa_typ_szkody_id'] == '2') ? 'block' : 'none'; ?> ;">


			<p class="oswiadzczenie_osoby_uprawnionej_naglowek_tresc margin_b_10">OŚWIADCZENIE
				OSOBY UPRAWNIONEJ</p>



			<div class="zgloszenie_wiersz_elementow zablokowane_pole">
                <p>Imię i nazwisko osoby uprawnionej:</p>
				<input type="text" name="" class="ou_imie_nazwisko_u"
					placeholder="Imie i nazwisko osoby uprawnionej"
					value="<?php echo $uprawniony['imie'].' '.$uprawniony['nazwisko']; ?>" />
				<div class="clear_b"></div>
			</div>
			<div class="zgloszenie_wiersz_elementow zablokowane_pole">
                <p>Imię i nazwisko osoby zmarłej:</p>
				<input type="text" name="" class="ou_imie_nazwisko_zm"
					placeholder="Imie i nazwisko osoby zmarłej"
					value="<?php echo $poszkodowany['imie'].' '.$poszkodowany['nazwisko']; ?>" />
				<div class="clear_b"></div>
			</div>
			<div class="zgloszenie_wiersz_elementow zablokowane_pole">
				<p>Data wypadku</p>
				<input type="text" name="" class="data ou_data_wypadku "
					placeholder="Data" value="<?php echo $zdarzenie['data']; ?>" />
				<div class="clear_b"></div>
			</div>
			<div class="zgloszenie_wiersz_elementow">
				<p>Po śmierci najbliższego członka rodziny:</p>
				<p>
					<span
						class="kratka_2 ou_ps_nastapilo_psm <?php echo ($sprawa['pogorszenie_sytuacji'] == '1') ? 'zaznaczone' : '' ; ?>"></span>nastapiło
					pogorszenie sytuacji materialnej
				</p>
				<p>
					<span
						class="kratka_2 ou_ps_w_krzywda  <?php echo ($sprawa['wystapienie_krzywdy'] == '1') ? 'zaznaczone' : '' ; ?>"></span>wystapiła
					krzywda
				</p>
				<div class="clear_b"></div>
			</div>
				
				<?php
				
				$info_zmarly = sprawa_pobierz_dane_z_tabeli_po_id ( 'sprawa_osoba', $sprawa ['sprawa_poszkodowany_id'] );
				$info_uprawniony = sprawa_pobierz_dane_z_tabeli_po_id ( 'sprawa_osoba', $sprawa ['sprawa_uprawniony_id'] );
				$stos_r_m = sprawa_pobierz_dane_z_tabeli_po_id ( 'sprawa_stosunki_rodzinne', $sprawa ['sprawa_stosunki_rodzinne_id'] );
				$sytuacja_po_s = sprawa_pobierz_dane_z_tabeli_po_id ( 'sprawa_sytuacja_rodziny', $sprawa ['sprawa_sytuacja_rodziny_id'] );
				$stos_mieszkaniowe = sprawa_pobierz_dane_z_tabeli_po_id ( 'sprawa_stosunki_mieszkaniowe', $stos_r_m ['sprawa_stosunki_mieszkaniowe_id'] );
				$utrzymanie = sprawa_pobierz_dane_z_tabeli_po_id ( 'sprawa_utrzymanie', $stos_r_m ['sprawa_utrzymanie_id'] );
				$porady = sprawa_pobierz_dane_z_tabeli_po_id ( 'sprawa_porady', $sytuacja_po_s ['sprawa_porady_id'] );
				
				?>
				
				<p class="informacje_o_zmarlym_naglowek_tresc">INFORMACJE O ZMARŁYM</p>
			<div class="informacje_o_zmarlym_naglowek_tresc_tresc">
				<div class="zgloszenie_wiersz_elementow">
					<p>Wiek w momencie śmierci:</p>
					<input type="text" name="" class="ou_iz_wiek " placeholder="Wiek"
						value="<?php echo $info_zmarly['wiek']; ?>" />
					<div class="clear_b"></div>
				</div>
				<div class="zgloszenie_wiersz_elementow wyksztalcenie">
					<p>Wykształcenie</p>
					<p class="ou_iz_w_wyzsze_o ou_iz_w_srednie_o ou_iz_w_zawodowe_o">
						<span data-wyk_id="1"
							class="kratka_2 ou_iz_w_podstawowe ou_iz_wyksztalcenie <?php echo ($info_zmarly['sprawa_wyksztalcenie_id'] == '1') ? 'zaznaczone' : '' ; ?>"></span>podstawowe
					</p>
					<p class="ou_iz_w_wyzsze_o ou_iz_w_srednie_o ou_iz_w_podstawowe_o">
						<span data-wyk_id="2"
							class="kratka_2 ou_iz_w_zawodowe ou_iz_wyksztalcenie <?php echo ($info_zmarly['sprawa_wyksztalcenie_id'] == '2') ? 'zaznaczone' : '' ; ?>"></span>zawodowe
					</p>
					<p class="ou_iz_w_wyzsze_o ou_iz_w_zawodowe_o ou_iz_w_podstawowe_o">
						<span data-wyk_id="3"
							class="kratka_2 ou_iz_w_srednie ou_iz_wyksztalcenie <?php echo ($info_zmarly['sprawa_wyksztalcenie_id'] == '3') ? 'zaznaczone' : '' ; ?>"></span>średnie
					</p>
					<p
						class="ou_iz_w_srednie_o ou_iz_w_zawodowe_o ou_iz_w_podstawowe_o">
						<span data-wyk_id="4"
							class="kratka_2 ou_iz_w_wyzsze ou_iz_wyksztalcenie <?php echo ($info_zmarly['sprawa_wyksztalcenie_id'] == '4') ? 'zaznaczone' : '' ; ?>"></span>wyższe
					</p>
					<div class="clear_b"></div>
				</div>
				<div class="zgloszenie_wiersz_elementow">
					<input type="text" name="" class="ou_iz_z_wyuczony"
						placeholder="Zawód wyuczony"
						value="<?php echo $info_zmarly['zawod_wyuczony']; ?>" /> <input
						type="text" name="" class="ou_iz_z_wykonywany"
						placeholder="Zawód wykonywany"
						value="<?php echo $info_zmarly['zawod_wykonywany']; ?>" /> <input
						type="text" name="" class="ou_iz_dodatkowe_k"
						placeholder="Dodatkowe kwalifikacje lub uprawnienia"
						value="<?php echo $info_zmarly['dodatkowe_kwalifikacje']; ?>" />
					<div class="clear_b"></div>
				</div>
				<div class="zgloszenie_wiersz_elementow">
					<p>Zatrudnienie:</p>
					<p
						class="ou_iz_zat_inne_o ou_iz_zat_pd_o ou_iz_zat_gr_o ou_iz_zat_wdg_o ou_iz_zat_uz_o ou_iz_zat_uop_o">
						<span data-zat_id="1"
							class="kratka_2 ou_iz_zat_brak ou_iz_zatrudnienie <?php echo ($info_zmarly['sprawa_zatrudnienie_id'] == '1') ? 'zaznaczone' : '' ; ?>"></span>brak
					</p>
					<p
						class="ou_iz_zat_inne_o ou_iz_zat_pd_o ou_iz_zat_gr_o ou_iz_zat_wdg_o ou_iz_zat_uz_o ou_iz_zat_brak_o">
						<span data-zat_id="2"
							class="kratka_2 ou_iz_zat_uop ou_iz_zatrudnienie <?php echo ($info_zmarly['sprawa_zatrudnienie_id'] == '2') ? 'zaznaczone' : '' ; ?>"></span>umowa
						o pracę
					</p>
					<p
						class="ou_iz_zat_inne_o ou_iz_zat_pd_o ou_iz_zat_gr_o ou_iz_zat_wdg_o ou_iz_zat_uop_o ou_iz_zat_brak_o">
						<span data-zat_id="3"
							class="kratka_2 ou_iz_zat_uz ou_iz_zatrudnienie <?php echo ($info_zmarly['sprawa_zatrudnienie_id'] == '3') ? 'zaznaczone' : '' ; ?>"></span>umowa
						zlecenia
					</p>
					<p
						class="ou_iz_zat_inne_o ou_iz_zat_pd_o ou_iz_zat_gr_o ou_iz_zat_uz_o ou_iz_zat_uop_o ou_iz_zat_brak_o">
						<span data-zat_id="4"
							class="kratka_2 ou_iz_zat_wdg ou_iz_zatrudnienie <?php echo ($info_zmarly['sprawa_zatrudnienie_id'] == '4') ? 'zaznaczone' : '' ; ?>"></span>własna
						działalność gospodarcza
					</p>
					<p
						class="ou_iz_zat_inne_o ou_iz_zat_pd_o ou_iz_zat_wdg_o ou_iz_zat_uz_o ou_iz_zat_uop_o ou_iz_zat_brak_o">
						<span data-zat_id="5"
							class="kratka_2 ou_iz_zat_gr ou_iz_zatrudnienie <?php echo ($info_zmarly['sprawa_zatrudnienie_id'] == '5') ? 'zaznaczone' : '' ; ?>"></span>gospodarstwo
						rolne
					</p>
					<p
						class="ou_iz_zat_inne_o ou_iz_zat_gr_o ou_iz_zat_wdg_o ou_iz_zat_uz_o ou_iz_zat_uop_o ou_iz_zat_brak_o">
						<span data-zat_id="6"
							class="kratka_2 ou_iz_zat_pd ou_iz_zatrudnienie <?php echo ($info_zmarly['sprawa_zatrudnienie_id'] == '6') ? 'zaznaczone' : '' ; ?>"></span>prace
						dorywcze
					</p>
					<p
						class="ou_iz_zat_pd_o ou_iz_zat_gr_o ou_iz_zat_wdg_o ou_iz_zat_uz_o ou_iz_zat_uop_o ou_iz_zat_brak_o">
						<span data-zat_id="7"
							class="kratka_2 ou_iz_zat_inne ou_iz_zatrudnienie <?php echo ($info_zmarly['sprawa_zatrudnienie_id'] == '7') ? 'zaznaczone' : '' ; ?>"></span>inne
					</p>
					<input type="text" name="" class="ou_iz_zat_inne_nazwa " placeholder="Rodzaj wykonywanej pracy" style="display:<?php echo ($info_zmarly['sprawa_zatrudnienie_id'] == '7') ? 'block' : 'none' ; ?>;" value="<?php echo $info_zmarly['zatrudnienie_tekst']; ?>"/>
					<div class="clear_b"></div>
				</div>
				<div class="zgloszenie_wiersz_elementow">
					<input type="text" name="" class=" ou_iz_zat_pensja"
						placeholder="Przeciętna wysokość zarobków z 3 ostatnich mc netto"
						value="<?php echo $info_zmarly['zarobki']; ?>" />
					<div class="clear_b"></div>
				</div>
				<div
					class="zz_edytuj margin_t_10 zablokowane_pole_transparent informacje_o_zmarlym_zapisz_zmiany">ZAPISZ
					ZMIANY</div>
			</div>

			<p class="informacje_o_uprawnionym_naglowek_tresc ">INFORMACJE O
				UPRAWNIONYM</p>
			<div class="informacje_o_uprawnionym_tresc_tresc">
				<div class="zgloszenie_wiersz_elementow text_wiek_smierc">
					<p>Wiek uprawnionego w momencie śmierci:</p>
				</div>
				<div class="zgloszenie_wiersz_elementow">
					<input type="text" name="" class="ou_iu_wiek " placeholder="Wiek"
						value="<?php echo $uprawniony['wiek']; ?>" />
					<div class="clear_b"></div>
				</div>
				<div class="zgloszenie_wiersz_elementow">
					<p>Wykształcenie</p>
					<p class="ou_iu_w_wyzsze_o ou_iu_w_srednie_o ou_iu_w_zawodowe_o">
						<span data-wyk_id="1"
							class="kratka_2 ou_iu_w_podstawowe ou_iu_wyksztalcenie <?php echo ($info_uprawniony['sprawa_wyksztalcenie_id'] == '1') ? 'zaznaczone' : '' ; ?>"></span>podstawowe
					</p>
					<p class="ou_iu_w_wyzsze_o ou_iu_w_srednie_o ou_iu_w_podstawowe_o">
						<span data-wyk_id="2"
							class="kratka_2 ou_iu_w_zawodowe ou_iu_wyksztalcenie <?php echo ($info_uprawniony['sprawa_wyksztalcenie_id'] == '2') ? 'zaznaczone' : '' ; ?>"></span>zawodowe
					</p>
					<p class="ou_iu_w_wyzsze_o ou_iu_w_zawodowe_o ou_iu_w_podstawowe_o">
						<span data-wyk_id="3"
							class="kratka_2 ou_iu_w_srednie ou_iu_wyksztalcenie <?php echo ($info_uprawniony['sprawa_wyksztalcenie_id'] == '3') ? 'zaznaczone' : '' ; ?>"></span>średnie
					</p>
					<p
						class="ou_iu_w_srednie_o ou_iu_w_zawodowe_o ou_iu_w_podstawowe_o">
						<span data-wyk_id="4"
							class="kratka_2 ou_iu_w_wyzsze ou_iu_wyksztalcenie <?php echo ($info_uprawniony['sprawa_wyksztalcenie_id'] == '4') ? 'zaznaczone' : '' ; ?>"></span>wyższe
					</p>
					<div class="clear_b"></div>
				</div>
				<div class="zgloszenie_wiersz_elementow">
					<input type="text" name="" class="ou_iu_z_wyuczony"
						placeholder="Zawód wyuczony"
						value="<?php echo $info_uprawniony['zawod_wyuczony']; ?>" /> <input
						type="text" name="" class="ou_iu_z_wykonywany"
						placeholder="Zawód wykonywany"
						value="<?php echo $info_uprawniony['zawod_wykonywany']; ?>" /> <input
						type="text" name="" class="ou_iu_dodatkowe_k"
						placeholder="Dodatkowe kwalifikacje lub uprawnienia"
						value="<?php echo $info_uprawniony['dodatkowe_kwalifikacje']; ?>" />
					<div class="clear_b"></div>
				</div>
				<div class="zgloszenie_wiersz_elementow">
					<p>Zatrudnienie:</p>
					<p
						class="ou_iu_zat_inne_o ou_iu_zat_pd_o ou_iu_zat_gr_o ou_iu_zat_wdg_o ou_iu_zat_uz_o ou_iu_zat_uop_o ">
						<span data-zat_id="1"
							class="kratka_2 ou_iu_zat_brak ou_iu_zatrudnienie <?php echo ($info_uprawniony['sprawa_zatrudnienie_id'] == '1') ? 'zaznaczone' : '' ; ?>"></span>brak
					</p>
					<p
						class="ou_iu_zat_inne_o ou_iu_zat_pd_o ou_iu_zat_gr_o ou_iu_zat_wdg_o ou_iu_zat_uz_o ou_iu_zat_brak_o ">
						<span data-zat_id="2"
							class="kratka_2 ou_iu_zat_uop ou_iu_zatrudnienie <?php echo ($info_uprawniony['sprawa_zatrudnienie_id'] == '2') ? 'zaznaczone' : '' ; ?>"></span>umowa
						o pracę
					</p>
					<p
						class="ou_iu_zat_inne_o ou_iu_zat_pd_o ou_iu_zat_gr_o ou_iu_zat_wdg_o ou_iu_zat_uop_o ou_iu_zat_brak_o ">
						<span data-zat_id="3"
							class="kratka_2 ou_iu_zat_uz ou_iu_zatrudnienie <?php echo ($info_uprawniony['sprawa_zatrudnienie_id'] == '3') ? 'zaznaczone' : '' ; ?>"></span>umowa
						zlecenia
					</p>
					<p
						class="ou_iu_zat_inne_o ou_iu_zat_pd_o ou_iu_zat_gr_o ou_iu_zat_uz_o ou_iu_zat_uop_o ou_iu_zat_brak_o ">
						<span data-zat_id="4"
							class="kratka_2 ou_iu_zat_wdg ou_iu_zatrudnienie <?php echo ($info_uprawniony['sprawa_zatrudnienie_id'] == '4') ? 'zaznaczone' : '' ; ?>"></span>własna
						działalność gospodarcza
					</p>
					<p
						class="ou_iu_zat_inne_o ou_iu_zat_pd_o ou_iu_zat_wdg_o ou_iu_zat_uz_o ou_iu_zat_uop_o ou_iu_zat_brak_o ">
						<span data-zat_id="5"
							class="kratka_2 ou_iu_zat_gr ou_iu_zatrudnienie <?php echo ($info_uprawniony['sprawa_zatrudnienie_id'] == '5') ? 'zaznaczone' : '' ; ?>"></span>gospodarstwo
						rolne
					</p>
					<p
						class="ou_iu_zat_inne_o ou_iu_zat_gr_o ou_iu_zat_wdg_o ou_iu_zat_uz_o ou_iu_zat_uop_o ou_iu_zat_brak_o ">
						<span data-zat_id="6"
							class="kratka_2 ou_iu_zat_pd ou_iu_zatrudnienie <?php echo ($info_uprawniony['sprawa_zatrudnienie_id'] == '6') ? 'zaznaczone' : '' ; ?>"></span>prace
						dorywcze
					</p>
					<p
						class="ou_iu_zat_pd_o ou_iu_zat_gr_o ou_iu_zat_wdg_o ou_iu_zat_uz_o ou_iu_zat_uop_o ou_iu_zat_brak_o ">
						<span data-zat_id="7"
							class="kratka_2 ou_iu_zat_inne ou_iu_zatrudnienie <?php echo ($info_uprawniony['sprawa_zatrudnienie_id'] == '7') ? 'zaznaczone' : '' ; ?>"></span>inne
					</p>
					<input type="text" name="" class="ou_iu_zat_inne_nazwa " placeholder="Rodzaj wykonywanej pracy" style="display:<?php echo ($info_uprawniony['sprawa_zatrudnienie_id'] == '7') ? 'block' : 'none' ; ?>;" value="<?php echo $info_uprawniony['zatrudnienie_tekst']; ?>"/>
					<div class="clear_b"></div>
				</div>
				<div class="zgloszenie_wiersz_elementow">
					<input type="text" name="" class="ou_iu_zat_pensja "
						placeholder="Przeciętna wysokość zarobków z 3 ostatnich mc netto"
						value="<?php echo $info_uprawniony['zarobki']; ?>" />
					<div class="clear_b"></div>
				</div>
				<div
					class="zz_edytuj margin_t_10 zablokowane_pole_transparent informacje_o_uprawnionym_zapisz_zmiany">ZAPISZ
					ZMIANY</div>
			</div>
			<p
				class="stosunki_rodzinne_majatkowe_naglowek_tresc utrzymanie_stosunki_id"
				data-id_stosunki="<?php echo $stos_mieszkaniowe['id']; ?>"
				data-id_utrzymanie="<?php echo $utrzymanie['id']; ?>>STOSUNKI
					RODZINNE I MAJĄTKOWE</p>
			
			
			<div class="stosunki_rodzinne_majatkowe_naglowek_tresc_tresc">
				<div class="zgloszenie_wiersz_elementow">
					<p>Zmarły był dla uprawnionego:</p>
					<p
						class="ou_srm_zdu_m_o ou_srm_zdu_pk_o ou_srm_zdu_pm_o ou_srm_zdu_ma_o ou_srm_zdu_o_o ou_srm_zdu_c_o ou_srm_zdu_s_o ou_srm_zdu_si_o ou_srm_zdu_b_o ou_srm_zdu_wk_o ou_srm_zdu_wm_o ou_srm_zdu_dz_o ou_srm_zdu_ba_o ou_srm_zdu_inne_o">
						<span data-ou_zmar_dla_upra_id="1"
							class="kratka_2 ou_srm_zdu_z ou_zmar_dla_upra  <?php echo ($stos_r_m['sprawa_pokrewienstwo_id'] == '1') ? 'zaznaczone' : '' ; ?>"></span>żoną
					</p>
					<p
						class="ou_srm_zdu_z_o  ou_srm_zdu_pk_o ou_srm_zdu_pm_o ou_srm_zdu_ma_o ou_srm_zdu_o_o ou_srm_zdu_c_o ou_srm_zdu_s_o ou_srm_zdu_si_o ou_srm_zdu_b_o ou_srm_zdu_wk_o ou_srm_zdu_wm_o ou_srm_zdu_dz_o ou_srm_zdu_ba_o ou_srm_zdu_inne_o">
						<span data-ou_zmar_dla_upra_id="2"
							class="kratka_2 ou_srm_zdu_m ou_zmar_dla_upra <?php echo ($stos_r_m['sprawa_pokrewienstwo_id'] == '2') ? 'zaznaczone' : '' ; ?>"></span>mężem
					</p>
					<p
						class="ou_srm_zdu_z_o ou_srm_zdu_m_o  ou_srm_zdu_pm_o ou_srm_zdu_ma_o ou_srm_zdu_o_o ou_srm_zdu_c_o ou_srm_zdu_s_o ou_srm_zdu_si_o ou_srm_zdu_b_o ou_srm_zdu_wk_o ou_srm_zdu_wm_o ou_srm_zdu_dz_o ou_srm_zdu_ba_o ou_srm_zdu_inne_o">
						<span data-ou_zmar_dla_upra_id="3"
							class="kratka_2 ou_srm_zdu_pk ou_zmar_dla_upra <?php echo ($stos_r_m['sprawa_pokrewienstwo_id'] == '3') ? 'zaznaczone' : '' ; ?>"></span>partnerką
					</p>
					<p
						class="ou_srm_zdu_z_o ou_srm_zdu_m_o ou_srm_zdu_pk_o  ou_srm_zdu_ma_o ou_srm_zdu_o_o ou_srm_zdu_c_o ou_srm_zdu_s_o ou_srm_zdu_si_o ou_srm_zdu_b_o ou_srm_zdu_wk_o ou_srm_zdu_wm_o ou_srm_zdu_dz_o ou_srm_zdu_ba_o ou_srm_zdu_inne_o">
						<span data-ou_zmar_dla_upra_id="4"
							class="kratka_2 ou_srm_zdu_pm ou_zmar_dla_upra <?php echo ($stos_r_m['sprawa_pokrewienstwo_id'] == '4') ? 'zaznaczone' : '' ; ?>"></span>partnerem
					</p>
					<p
						class="ou_srm_zdu_z_o ou_srm_zdu_m_o ou_srm_zdu_pk_o ou_srm_zdu_pm_o  ou_srm_zdu_o_o ou_srm_zdu_c_o ou_srm_zdu_s_o ou_srm_zdu_si_o ou_srm_zdu_b_o ou_srm_zdu_wk_o ou_srm_zdu_wm_o ou_srm_zdu_dz_o ou_srm_zdu_ba_o ou_srm_zdu_inne_o">
						<span data-ou_zmar_dla_upra_id="5"
							class="kratka_2 ou_srm_zdu_ma ou_zmar_dla_upra <?php echo ($stos_r_m['sprawa_pokrewienstwo_id'] == '5') ? 'zaznaczone' : '' ; ?>"></span>matką
					</p>
					<p
						class="ou_srm_zdu_z_o ou_srm_zdu_m_o ou_srm_zdu_pk_o ou_srm_zdu_pm_o ou_srm_zdu_ma_o  ou_srm_zdu_c_o ou_srm_zdu_s_o ou_srm_zdu_si_o ou_srm_zdu_b_o ou_srm_zdu_wk_o ou_srm_zdu_wm_o ou_srm_zdu_dz_o ou_srm_zdu_ba_o ou_srm_zdu_inne_o">
						<span data-ou_zmar_dla_upra_id="6"
							class="kratka_2 ou_srm_zdu_o ou_zmar_dla_upra <?php echo ($stos_r_m['sprawa_pokrewienstwo_id'] == '6') ? 'zaznaczone' : '' ; ?>"></span>ojcem
					</p>
					<p
						class="ou_srm_zdu_z_o ou_srm_zdu_m_o ou_srm_zdu_pk_o ou_srm_zdu_pm_o ou_srm_zdu_ma_o ou_srm_zdu_o_o  ou_srm_zdu_s_o ou_srm_zdu_si_o ou_srm_zdu_b_o ou_srm_zdu_wk_o ou_srm_zdu_wm_o ou_srm_zdu_dz_o ou_srm_zdu_ba_o ou_srm_zdu_inne_o">
						<span data-ou_zmar_dla_upra_id="7"
							class="kratka_2 ou_srm_zdu_c ou_zmar_dla_upra <?php echo ($stos_r_m['sprawa_pokrewienstwo_id'] == '7') ? 'zaznaczone' : '' ; ?>"></span>córką
					</p>
					<p
						class="ou_srm_zdu_z_o ou_srm_zdu_m_o ou_srm_zdu_pk_o ou_srm_zdu_pm_o ou_srm_zdu_ma_o ou_srm_zdu_o_o ou_srm_zdu_c_o  ou_srm_zdu_si_o ou_srm_zdu_b_o ou_srm_zdu_wk_o ou_srm_zdu_wm_o ou_srm_zdu_dz_o ou_srm_zdu_ba_o ou_srm_zdu_inne_o">
						<span data-ou_zmar_dla_upra_id="8"
							class="kratka_2 ou_srm_zdu_s ou_zmar_dla_upra <?php echo ($stos_r_m['sprawa_pokrewienstwo_id'] == '8') ? 'zaznaczone' : '' ; ?>"></span>synem
					</p>
					<p
						class="ou_srm_zdu_z_o ou_srm_zdu_m_o ou_srm_zdu_pk_o ou_srm_zdu_pm_o ou_srm_zdu_ma_o ou_srm_zdu_o_o ou_srm_zdu_c_o ou_srm_zdu_s_o  ou_srm_zdu_b_o ou_srm_zdu_wk_o ou_srm_zdu_wm_o ou_srm_zdu_dz_o ou_srm_zdu_ba_o ou_srm_zdu_inne_o">
						<span data-ou_zmar_dla_upra_id="9"
							class="kratka_2 ou_srm_zdu_si ou_zmar_dla_upra <?php echo ($stos_r_m['sprawa_pokrewienstwo_id'] == '9') ? 'zaznaczone' : '' ; ?>"></span>siostrą
					</p>
					<p
						class="ou_srm_zdu_z_o ou_srm_zdu_m_o ou_srm_zdu_pk_o ou_srm_zdu_pm_o ou_srm_zdu_ma_o ou_srm_zdu_o_o ou_srm_zdu_c_o ou_srm_zdu_s_o ou_srm_zdu_si_o  ou_srm_zdu_wk_o ou_srm_zdu_wm_o ou_srm_zdu_dz_o ou_srm_zdu_ba_o ou_srm_zdu_inne_o">
						<span data-ou_zmar_dla_upra_id="10"
							class="kratka_2 ou_srm_zdu_b ou_zmar_dla_upra <?php echo ($stos_r_m['sprawa_pokrewienstwo_id'] == '10') ? 'zaznaczone' : '' ; ?>"></span>bratem
					</p>
					<p
						class="ou_srm_zdu_z_o ou_srm_zdu_m_o ou_srm_zdu_pk_o ou_srm_zdu_pm_o ou_srm_zdu_ma_o ou_srm_zdu_o_o ou_srm_zdu_c_o ou_srm_zdu_s_o ou_srm_zdu_si_o ou_srm_zdu_b_o  ou_srm_zdu_wm_o ou_srm_zdu_dz_o ou_srm_zdu_ba_o ou_srm_zdu_inne_o">
						<span data-ou_zmar_dla_upra_id="11"
							class="kratka_2 ou_srm_zdu_wk ou_zmar_dla_upra <?php echo ($stos_r_m['sprawa_pokrewienstwo_id'] == '11') ? 'zaznaczone' : '' ; ?>"></span>wnuczką
					</p>
					<p
						class="ou_srm_zdu_z_o ou_srm_zdu_m_o ou_srm_zdu_pk_o ou_srm_zdu_pm_o ou_srm_zdu_ma_o ou_srm_zdu_o_o ou_srm_zdu_c_o ou_srm_zdu_s_o ou_srm_zdu_si_o ou_srm_zdu_b_o ou_srm_zdu_wk_o  ou_srm_zdu_dz_o ou_srm_zdu_ba_o ou_srm_zdu_inne_o">
						<span data-ou_zmar_dla_upra_id="12"
							class="kratka_2 ou_srm_zdu_wm ou_zmar_dla_upra <?php echo ($stos_r_m['sprawa_pokrewienstwo_id'] == '12') ? 'zaznaczone' : '' ; ?>"></span>wnukiem
					</p>
					<p
						class="ou_srm_zdu_z_o ou_srm_zdu_m_o ou_srm_zdu_pk_o ou_srm_zdu_pm_o ou_srm_zdu_ma_o ou_srm_zdu_o_o ou_srm_zdu_c_o ou_srm_zdu_s_o ou_srm_zdu_si_o ou_srm_zdu_b_o ou_srm_zdu_wk_o ou_srm_zdu_wm_o  ou_srm_zdu_ba_o ou_srm_zdu_inne_o">
						<span data-ou_zmar_dla_upra_id="13"
							class="kratka_2 ou_srm_zdu_dz ou_zmar_dla_upra <?php echo ($stos_r_m['sprawa_pokrewienstwo_id'] == '13') ? 'zaznaczone' : '' ; ?>"></span>dziadkiem
					</p>
					<p
						class="ou_srm_zdu_z_o ou_srm_zdu_m_o ou_srm_zdu_pk_o ou_srm_zdu_pm_o ou_srm_zdu_ma_o ou_srm_zdu_o_o ou_srm_zdu_c_o ou_srm_zdu_s_o ou_srm_zdu_si_o ou_srm_zdu_b_o ou_srm_zdu_wk_o ou_srm_zdu_wm_o ou_srm_zdu_dz_o  ou_srm_zdu_inne_o">
						<span data-ou_zmar_dla_upra_id="14"
							class="kratka_2 ou_srm_zdu_ba ou_zmar_dla_upra <?php echo ($stos_r_m['sprawa_pokrewienstwo_id'] == '14') ? 'zaznaczone' : '' ; ?>"></span>babcią
					</p>
					<p
						class="ou_srm_zdu_z_o ou_srm_zdu_m_o ou_srm_zdu_pk_o ou_srm_zdu_pm_o ou_srm_zdu_ma_o ou_srm_zdu_o_o ou_srm_zdu_c_o ou_srm_zdu_s_o ou_srm_zdu_si_o ou_srm_zdu_b_o ou_srm_zdu_wk_o ou_srm_zdu_wm_o ou_srm_zdu_dz_o ou_srm_zdu_ba_o ">
						<span data-ou_zmar_dla_upra_id="15"
							class="kratka_2 ou_srm_zdu_inne ou_zmar_dla_upra <?php echo ($stos_r_m['sprawa_pokrewienstwo_id'] == '15') ? 'zaznaczone' : '' ; ?>"></span>inne
					</p>
					<input type="text" name="" class="ou_srm_zdu_inne_rodzaj_tekst ou_srm_zdu_inne_rodzaj" placeholder="Rodzaj więzi" style="display:<?php echo ($stos_r_m['sprawa_pokrewienstwo_id'] == '15') ? 'block' : 'none' ; ?>;" value="<?php echo $stos_r_m['pokrewienstwo_tekst']; ?>" />
					<div class="clear_b"></div>
				</div>
				<div class="zgloszenie_wiersz_elementow">
					<p>Zmarły:</p>
					<div class="clear_b"></div>
				</div>
				<div class="zgloszenie_wiersz_elementow">
					<p>
						<span data-zm_dla_up_stos_mieszkan_id="#"
							class="kratka_2 ou_srm_pzuwg zm_dla_up_stos_mieszkan <?php echo ($stos_mieszkaniowe['zmienna1'] == '1') ? 'zaznaczone' : '' ; ?>"></span>pozostawał
						z uprawnionym we wspólnym gospodarstwie
					</p>
					<p>
						<span data-zm_dla_up_stos_mieszkan_id="#"
							class="kratka_2 ou_srm_bzptsacu zm_dla_up_stos_mieszkan <?php echo ($stos_mieszkaniowe['zmienna2'] == '1') ? 'zaznaczone' : '' ; ?>"></span>był
						zameldowany pod tym samym adresem co uprawniony
					</p>
					<p>
						<span data-zm_dla_up_stos_mieszkan_id="#"
							class="kratka_2 ou_srm_nbzptsacu_amr zm_dla_up_stos_mieszkan <?php echo ($stos_mieszkaniowe['zmienna3'] == '1') ? 'zaznaczone' : '' ; ?>"></span>nie
						był zameldowany pod tym samym adresem co uprawniony, ale mieszkali
						razem
					</p>




					<p class="ou_srm_pwo_o">
						<span data-zm_dla_up_pomoc_id="1"
							class="kratka_2 ou_srm_pwo zm_dla_up_pomocc <?php echo ($stos_r_m['sprawa_pomoc_id'] == '1') ? 'zaznaczone' : '' ; ?>"></span>pomagał
						w biezących obowiązkach
					</p>
					<p class="ou_srm_npwo_o">
						<span data-zm_dla_up_pomoc_id="2"
							class="kratka_2 ou_srm_npwo zm_dla_up_pomocc <?php echo ($stos_r_m['sprawa_pomoc_id'] == '2') ? 'zaznaczone' : '' ; ?>"></span>nie
						pomagał w biezących obowiązkach
					</p>
					<div class="clear_b"></div>
				</div>
				<div class="zgloszenie_wiersz_elementow">
					<p>Uprawniony określa stosunki ze zmarłym jako:</p>
					<p class="ou_sudz_zle_o ou_sudz_p_o ou_sudz_z_o">
						<span data-zm_dla_up_stosunki_u_id="1"
							class="kratka_2 ou_sudz_bz zm_dla_up_stosunki_u <?php echo ($stos_r_m['sprawa_stosunki_uprawnionego_id'] == '1') ? 'zaznaczone' : '' ; ?>"></span>bardzo
						zażyłe
					</p>
					<p class="ou_sudz_zle_o ou_sudz_p_o ou_sudz_bz_o">
						<span data-zm_dla_up_stosunki_u_id="2"
							class="kratka_2 ou_sudz_z zm_dla_up_stosunki_u <?php echo ($stos_r_m['sprawa_stosunki_uprawnionego_id'] == '2') ? 'zaznaczone' : '' ; ?>"></span>zażyłe
					</p>
					<p class="ou_sudz_zle_o ou_sudz_z_o ou_sudz_bz_o">
						<span data-zm_dla_up_stosunki_u_id="3"
							class="kratka_2 ou_sudz_p zm_dla_up_stosunki_u <?php echo ($stos_r_m['sprawa_stosunki_uprawnionego_id'] == '3') ? 'zaznaczone' : '' ; ?>"></span>powierzchowne
					</p>
					<p class="ou_sudz_p_o ou_sudz_z_o ou_sudz_bz_o">
						<span data-zm_dla_up_stosunki_u_id="4"
							class="kratka_2 ou_sudz_zle zm_dla_up_stosunki_u <?php echo ($stos_r_m['sprawa_stosunki_uprawnionego_id'] == '4') ? 'zaznaczone' : '' ; ?>"></span>złe
					</p>
					<div class="clear_b"></div>
				</div>
				<div class="zgloszenie_wiersz_elementow">
					<p>Zmarły:</p>
					<div class="clear_b"></div>
				</div>
				<div class="zgloszenie_wiersz_elementow">
					<p class="ou_sbnu_utrz_o">
						<span data-zm_dla_up_utrzymanie_id="#"
							class="kratka_2 ou_sbnu_utrz zm_dla_up_utrzymanie <?php echo ($utrzymanie['zmienna1'] == '1') ? 'zaznaczone' : '' ; ?>"></span>był
						na moim utrzymaniu
					</p>
					<p class="ou_sbnu_lnmu_o">
						<span data-zm_dla_up_utrzymanie_id="#"
							class="kratka_2 ou_sbnu_lnmu zm_dla_up_utrzymanie <?php echo ($utrzymanie['zmienna2'] == '1') ? 'zaznaczone' : '' ; ?>"></span>łożył
						na moje utrzymanie
					</p>
					<p>
						<span data-zm_dla_up_utrzymanie_id="#"
							class="kratka_2 ou_sbnu_pwk zm_dla_up_utrzymanie <?php echo ($utrzymanie['zmienna3'] == '1') ? 'zaznaczone' : '' ; ?>"></span>posiadał
						z uprawnionym wspólne konto
					</p>
					<p>
						<span data-zm_dla_up_utrzymanie_id="#"
							class="kratka_2 ou_sbnu_pkur zm_dla_up_utrzymanie <?php echo ($utrzymanie['zmienna4'] == '1') ? 'zaznaczone' : '' ; ?>"></span>partycypował
						koszty utrzymania rodziny
					</p>
					<p>
						<span data-zm_dla_up_utrzymanie_id="#"
							class="kratka_2 ou_sbnu_wfwp zm_dla_up_utrzymanie <?php echo ($utrzymanie['zmienna5'] == '1') ? 'zaznaczone' : '' ; ?>"></span>wspierałby
						uprawnionego finansowo w przyszłości
					</p>
					<div class="clear_b"></div>
				</div>
				<div
					class="zz_edytuj margin_t_10 zablokowane_pole_transparent stosunki_rodzinne_majatkowe_zapisz_zmiany">ZAPISZ
					ZMIANY</div>
			</div>
			<p class="sytuacja_po_smierci_naglowek_tresc porada_id" style="display:<?php echo ($sprawa['sprawa_typ_szkody_id'] == '1') ? 'none' : 'block' ; ?>;"
					data-id_porady="<?php echo $porady['id']; ?>">SYTUACJA PO ŚMIERCI
				CZŁONKA NAJBLIŻSZEJ RODZINY</p>
			<div class="sytuacja_po_smierci_naglowek_tresc_tresc " style="
					display:<?php echo ($sprawa['sprawa_typ_szkody_id'] == '1') ? 'none' : 'block' ; ?>;">
				<div class="zgloszenie_wiersz_elementow">
					<p>Po śmierci członka rodziny sytuacja materialna uprawnionego:</p>
					<div class="clear_b"></div>
				</div>
				<div class="zgloszenie_wiersz_elementow">
					<p class="ou_spscnr_sm_nuz_o">
						<span data-syt_p_s_rodz_mat_id="1"
							class="kratka_2 ou_spscnr_sm_nuz syt_p_s_rodz_mat <?php echo ($sytuacja_po_s['sprawa_sytuacja_majatkowa_id'] == '1') ? 'zaznaczone' : '' ; ?>"></span>nie
						uległa zmianie
					</p>
					<p class="ou_spscnr_sm_psn_o">
						<span data-syt_p_s_rodz_mat_id="2"
							class="kratka_2 ou_spscnr_sm_psn syt_p_s_rodz_mat <?php echo ($sytuacja_po_s['sprawa_sytuacja_majatkowa_id'] == '2') ? 'zaznaczone' : '' ; ?>"></span>pogorszyła
						się nieznacznie
					</p>
					<p class="ou_spscnr_sm_psz_o">
						<span data-syt_p_s_rodz_mat_id="3"
							class="kratka_2 ou_spscnr_sm_psz syt_p_s_rodz_mat <?php echo ($sytuacja_po_s['sprawa_sytuacja_majatkowa_id'] == '3') ? 'zaznaczone' : '' ; ?>"></span>pogorszyła
						sie znacznie
					</p>
					<div class="clear_b"></div>
				</div>
				<div class="zgloszenie_wiersz_elementow">
					<p>Motywacja uprawnionego do poprawy sytuacji materialnej</p>
					<div class="clear_b"></div>
				</div>
				<div class="zgloszenie_wiersz_elementow">
					<p class="ou_spscnr_mo_nuz_o">
						<span data-syt_p_s_rodz_mot_id="1"
							class="kratka_2 ou_spscnr_mo_nuz syt_p_s_rodz_mot <?php echo ($sytuacja_po_s['sprawa_motywacja_id'] == '1') ? 'zaznaczone' : '' ; ?>"></span>nie
						uległa zmianie
					</p>
					<p class="ou_spscnr_mo_psn_o">
						<span data-syt_p_s_rodz_mot_id="2"
							class="kratka_2 ou_spscnr_mo_psn syt_p_s_rodz_mot <?php echo ($sytuacja_po_s['sprawa_motywacja_id'] == '2') ? 'zaznaczone' : '' ; ?>"></span>poprawiła
						się
					</p>
					<p class="ou_spscnr_mo_psz_o">
						<span data-syt_p_s_rodz_mot_id="3"
							class="kratka_2 ou_spscnr_mo_psz syt_p_s_rodz_mot <?php echo ($sytuacja_po_s['sprawa_motywacja_id'] == '3') ? 'zaznaczone' : '' ; ?>"></span>pogorszyła
						się
					</p>
					<div class="clear_b"></div>
				</div>
				<div class="zgloszenie_wiersz_elementow">
					<p>Po śmierci członka rodziny uprawniony</p>
					<p class="ou_spscnr_wstrzas_o_o">
						<span data-syt_p_s_rodz_wstrz_id="1"
							class="kratka_2 ou_spscnr_wstrzas_o syt_p_s_rodz_wstrz <?php echo ($sytuacja_po_s['sprawa_stan_psychiczny_id'] == '1') ? 'zaznaczone' : '' ; ?>"></span>odczuł
					</p>
					<p class="ou_spscnr_wstrzas_no_o">
						<span data-syt_p_s_rodz_wstrz_id="2"
							class="kratka_2 ou_spscnr_wstrzas_no syt_p_s_rodz_wstrz <?php echo ($sytuacja_po_s['sprawa_stan_psychiczny_id'] == '2') ? 'zaznaczone' : '' ; ?>"></span>nie
						odczuł
					</p>
					<p>&nbsp; znaczącego wstrząsu psychicznego.</p>
					<div class="clear_b"></div>
				</div>
				<div class="zgloszenie_wiersz_elementow">
					<p>
						<span data-syt_p_s_rodz_zdr_id="1"
							class="kratka_2 ou_spscnr_snp syt_p_s_rodz_zdr <?php echo ($sytuacja_po_s['sprawa_stan_zdrowia_id'] == '1') ? 'zaznaczone' : '' ; ?>"></span>uprawniony
						korzysta z środków farmakologicznych w związku ze złym stanem
						psychicznym
					</p>
					<p>
						<span data-syt_p_s_rodz_zdr_id="2"
							class="kratka_2 ou_spscnr_szps syt_p_s_rodz_zdr <?php echo ($sytuacja_po_s['sprawa_stan_zdrowia_id'] == '2') ? 'zaznaczone' : '' ; ?>"></span>stan
						zdrowia uprawnionego uległ pogorszeniu
					</p>
					<div class="clear_b"></div>
				</div>
				<div class="zgloszenie_wiersz_elementow">
					<p>Uprawniony korzysta z porad/wsparcia:</p>
					<p>
						<span data-syt_p_s_rodz_por_id="#"
							class="kratka_2 ou_spscnr_uk_psychiatra syt_p_s_rodz_por <?php echo ($porady['zmienna1'] == '1') ? 'zaznaczone' : '' ; ?>"></span>psychiatry
					</p>
					<p>
						<span data-syt_p_s_rodz_por_id="#"
							class="kratka_2 ou_spscnr_uk_psycholog syt_p_s_rodz_por <?php echo ($porady['zmienna2'] == '1') ? 'zaznaczone' : '' ; ?>"></span>psychologa
					</p>
					<p>
						<span data-syt_p_s_rodz_por_id="#"
							class="kratka_2 ou_spscnr_uk_pedszk syt_p_s_rodz_por <?php echo ($porady['zmienna3'] == '1') ? 'zaznaczone' : '' ; ?>"></span>pedagoga
						szkolnego
					</p>
					<p>
						<span data-syt_p_s_rodz_por_id="#"
							class="kratka_2 ou_spscnr_uk_lpk syt_p_s_rodz_por <?php echo ($porady['zmienna4'] == '1') ? 'zaznaczone' : '' ; ?>"></span>lekarza
						pierwszego kontaktu
					</p>
					<p>
						<span data-syt_p_s_rodz_por_id="#"
							class="kratka_2 ou_spscnr_uk_duch syt_p_s_rodz_por <?php echo ($porady['zmienna5'] == '1') ? 'zaznaczone' : '' ; ?>"></span>duchownego
					</p>
					<p>
						<span data-syt_p_s_rodz_por_id="#"
							class="kratka_2 ou_spscnr_uk_rodz syt_p_s_rodz_por <?php echo ($porady['zmienna6'] == '1') ? 'zaznaczone' : '' ; ?>"></span>rodziny
					</p>
					<div class="clear_b"></div>
				</div>
				<div class="zgloszenie_wiersz_elementow">
					<p>Zmarły pozostawił po sobie:</p>
					<p class="ou_spscnr_zps_wk_o">
						<span data-syt_p_s_rodz_zmarl_p_id="1"
							class="kratka_2 ou_spscnr_zps_wk syt_p_s_rodz_zmarl_p <?php echo ($sytuacja_po_s['czy_zostal_malzonek'] == '1') ? 'zaznaczone' : '' ; ?>"></span>wdowę
					</p>
					<p class="ou_spscnr_zps_wm_o">
						<span data-syt_p_s_rodz_zmarl_p_id="2"
							class="kratka_2 ou_spscnr_zps_wm syt_p_s_rodz_zmarl_p <?php echo ($sytuacja_po_s['czy_zostal_malzonek'] == '2') ? 'zaznaczone' : '' ; ?>"></span>wdowca
					</p>
					<p>
						<span data-syt_p_s_rodz_zmarl_dz_id="3"
							class="kratka_2 ou_spscnr_zps_dz syt_p_s_rodz_zmarl_dz <?php echo ($sytuacja_po_s['sprawa_pozostawiona_rodzina_id'] == '3') ? 'zaznaczone' : '' ; ?>"></span>dzieci
					</p>
					<input type="text" name="" class="ou_spscnr_zps_dz_l " placeholder="liczba" value="<?php echo ($sytuacja_po_s['liczba_dzieci'] != '0') ? 'liczba_dzieci' : '' ; ?>" style="display:<?php echo ($sytuacja_po_s['sprawa_pozostawiona_rodzina_id'] == '3') ? 'block' : 'none' ; ?>;"/>
					<input type="text" name="" class="ou_spscnr_zps_dz_w " placeholder="wiek dzieci oddziel średnikiem ';'" value="<?php echo $sytuacja_po_s['wiek_dzieci']; ?>" style="display:<?php echo ($sytuacja_po_s['sprawa_pozostawiona_rodzina_id'] == '3') ? 'block' : 'none' ; ?>;"/>
                    <div class="clear_b"></div>
				</div>
				<div
					class="zz_edytuj margin_t_10 zablokowane_pole_transparent sytuacja_po_smierci_czlonka_rodziny_zapisz_zmiany">ZAPISZ
					ZMIANY</div>
			</div>


		</div>
	</div>

	<div class="strona_umowy str_12 mop">
                <?php
																
																$sprawa_oswiadczenie = sprawa_pobierz_dane_z_tabeli_po_id ( 'sprawa_oswiadczenie', $sprawa ['sprawa_oswiadczenie_id'] );
																$so_imie_nazwisko = explode ( ' ', $sprawa_oswiadczenie ['imie_nazwisko'] );
																$so_imie = $so_imie_nazwisko [0];
																$so_nazwisko = $so_imie_nazwisko [1];
																
																$so_adres = explode ( ',', $sprawa_oswiadczenie ['adres'] );
																$so_ulica = $so_adres [0];
																$so_nr_domu = $so_adres [1];
																$so_nr_mieszkania = $so_adres [2];
																$so_kod_pocztowy = $so_adres [3];
																$so_miejscowosc = $so_adres [4];
																
																?>
                <div class="dane_do_oswiadczenia">
			<p>DANE DO OŚWIADCZENIA</p>
			<input type="text" name="" class="ddo_imie margin_r_20 margin_t_10"
				placeholder="Imię" value="<?php echo $so_imie; ?>" /> <input
				type="text" name="" class="ddo_nazwisko " placeholder="Nazwisko"
				value="<?php echo $so_nazwisko; ?>" />
			<div class="clear_b"></div>
			<input type="text" name="" class="ddo_ulica margin_r_20 margin_t_10"
				placeholder="Ulica" value="<?php echo $so_ulica; ?>" /> <input
				type="text" name="" class="ddo_nr_domu margin_r_10 margin_t_10"
				placeholder="Nr domu" value="<?php echo $so_nr_domu; ?>" /> <input
				type="text" name=""
				class="ddo_nr_mieszkania margin_r_10 margin_t_10"
				placeholder="Nr mieszkania" value="<?php echo $so_nr_mieszkania; ?>" />

			<div
				class="zleceniodawca_formularz_kod_pocztowy zleceniodawca_formularz_element margin_t_10 formularz_ddo_kod">
				<input maxlength="6" size="6" placeholder="Kod pocztowy"
					value="<?php echo $so_kod_pocztowy; ?>" type="text"
					class="ddo_kod_pocztowy" onkeyup="sprawdz_kod_pocztowy(this);">
			</div>

			<!-- <input type="text" name="" class="ddo_kod_pocztowy margin_t_10"
						placeholder="Kod pocztowy" value="<?php //echo $so_kod_pocztowy; ?>"
						onkeyup="sprawdz_kod_pocztowy(this);" /> -->

			<div class="clear_b"></div>
			<input type="text" name="" class="ddo_miejscowosc margin_t_10"
				placeholder="Miejscowość" value="<?php echo $so_miejscowosc; ?>" />
		</div>
		<p class="oswiadczenie_naglowek_tresc margin_b_10">OŚWIADCZENIE TREŚĆ</p>
		<div class="oswiadczenie_naglowek_tresc_tresc">
			<div class="opis_zdarzenia_pole ">
				<textarea placeholder="Wprowadź dane..." type="text"
					class="zsz_oswiadczenie_tresc" value=""><?php echo $sprawa_oswiadczenie['wartosc']; ?></textarea>
			</div>
		</div>
        <div class="element_input">
		<input type="text" name=""
			class="ddo_miejscowosc_generowania margin_b_10 margin_r_20"
			placeholder="Miejscowość"
			value="<?php echo $sprawa_oswiadczenie['miejscowosc']; ?>" /> <input
			type="text" name="" class="data ddo_data margin_b_10"
			placeholder="Data"
			value="<?php echo $sprawa_oswiadczenie['data_oswiadczenia']; ?>" />
        </div>
		<div class="clear_b"></div>
		<div
			class="zz_edytuj margin_t_10 zablokowane_pole_transparent oswiadczenie_zapisz_zmiany">ZAPISZ
			ZMIANY</div>
	</div>


	<div class="strona_umowy str_13 mop">
            
            	<?php
													
													$typ_umowy = sprawa_pobierz_dane_z_tabeli_po_id ( 'sprawa_umowa', $sprawa ['sprawa_umowa_id'] );
													
													?>
            
                <!-- medyk edycja 14-09-2016 -->

		<p class="wybor_umowy_tresc ">WYBIERZ TYP UMOWY</p>
		<div class="wybor_umowy_tresc_tresc">
			<div class="zgloszenie_wiersz_elementow wybor_umowy">
                <div class="maxima_pu"  style="display:<?php echo ($sprawa['sprawa_typ_szkody_id'] != '1') ? 'block' : 'none' ; ?>;">
				<p class="umowa_maxima">
					<span
						class="kratka_2 maxima <?php echo ($typ_umowy['nazwa'] == 'maxima') ? 'zaznaczone' : '' ; ?>"></span>MAXIMA
                </p>
					<input type="number" name="" class="prowizja_maxima" min="15" max="35" placeholder="Prowizja w %" value="<?php echo $typ_umowy['prowizja']; ?>"/>
                </div>
                <div class="promedica_pu" style="display:<?php echo ($sprawa['sprawa_typ_szkody_id'] == '1') ? 'block' : 'none' ; ?>;">
				<p class="umowa_promedica">
					<span
						class="kratka_2 promedica <?php echo ($typ_umowy['nazwa'] == 'promedica') ? 'zaznaczone' : '' ; ?>"></span>PROMEDICA
				</p>
				<input  type="number" name="" class="prowizja_promedica" min="25" max="35" placeholder="Prowizja w %" value="<?php echo ($typ_umowy['nazwa'] == 'maxima') ? '35' : $typ_umowy['prowizja']; ?>"/>
                </div>
                    <div class="optima_pu" style="display:<?php echo (($sprawa['sprawa_typ_szkody_id'] == '1') OR ($sprawa['sprawa_typ_szkody_id'] == '2')) ? 'block' : 'none' ; ?>;">
				<p class="umowa_optima">
					<span
						class="kratka_2 optima <?php echo ($typ_umowy['nazwa'] == 'optima') ? 'zaznaczone' : '' ; ?>"></span>OPTIMA
				</p>
				<input  type="number" name="" class="prowizja_optima" min="25" max="35" placeholder="Prowizja w %" value="<?php echo ($typ_umowy['nazwa'] == 'maxima') ? '35' : $typ_umowy['prowizja']; ?>"/>
                    </div>
                <div class="prima_pu" style="display:<?php echo (($sprawa['sprawa_typ_szkody_id'] == '1') OR ($sprawa['sprawa_typ_szkody_id'] == '2')) ? 'block' : 'none' ; ?>;">
                    <p class="umowa_prima">
                        <span class="kratka_2 prima <?php echo ($typ_umowy['nazwa'] == 'prima') ? 'zaznaczone' : '' ; ?>"></span>PRIMA
                    </p>
                    <input type="number" name="" class="prowizja_prima" min="25"
                           max="35" placeholder="Prowizja w %" value="<?php echo ($typ_umowy['nazwa'] == 'maxima') ? '35' : $typ_umowy['prowizja']; ?>" />
                </div>
				<div class="clear_b"></div>
			</div>

		</div>

		<div
			class="typ_umowy_zapisz_zmiany zablokowane_pole_transparent zz_edytuj">ZAPISZ
			ZMIANY</div>
	</div>

	<div class="strona_umowy str_14 mop">
            
            <?php
												
												$dane_umowy_platnosc = sprawa_pobierz_dane_z_tabeli_po_id ( 'sprawa_umowa', $sprawa ['sprawa_umowa_id'] );
												$dane_umowy_platnosc_osoba = sprawa_pobierz_dane_z_tabeli_po_id ( 'sprawa_osoba', $dane_umowy_platnosc ['osoba_do_wyplaty_id'] );
												$dane_umowy_platnos_osoba_adres = sprawa_pobierz_dane_z_tabeli_po_id ( 'sprawa_adres', $dane_umowy_platnosc_osoba ['sprawa_adres_zameldowania_id'] );
												
												?>
            
                <p class="sposob_platnosci_tresc ">WYBIERZ SPOSÓB
			PŁATNOŚCI</p>
		<div class="sposob_platnosci_tresc_tresc">
			<div class="wynagrodzenie ">
				<div class="zgloszenie_wiersz_elementow wybor_umowy">
					<p>
						<span
							class="kratka_2 przekaz_pocztowyy sprawa_spw <?php echo ($dane_umowy_platnosc['forma_platnosci'] == 'przekaz') ? 'zaznaczone' : '' ; ?> "></span>przekaz
						pocztowy
					</p>
					<p>
						<span
							class="kratka_2 przelew_bankowyy sprawa_spw <?php echo ($dane_umowy_platnosc['forma_platnosci'] == 'przelew') ? 'zaznaczone' : '' ; ?>"></span>przelew
						bankowy
					</p>
					<div class="clear_b"></div>
				</div>
				<div class="wynagrodzenie_do_umowy ">
					<div class="kopiuj_adres_zleceniodawcy"
						data-id_odbiorcy="<?php echo $dane_umowy_platnosc['osoba_do_wyplaty_id']; ?>">
						<p>
							<span
								class="kratka_2 kopiuj_adres_zleceniodawcy_kratka <?php echo ($dane_umowy_platnosc['osoba_do_wyplaty_id'] == $sprawa['sprawa_klient_id']) ? 'zaznaczone' : '' ; ?>"></span>Odbiorcą
							wynagrodzenia jest Zleceniodawca
						</p>
					</div>
					<div class="clear_b"></div>
					<div class=" zleceniodawca_formularz_numer_rachunku_bankowego zleceniodawca_formularz_element margin_t_10 " style="display:<?php echo ($dane_umowy_platnosc['forma_platnosci'] == 'przelew') ? 'block' : 'none' ; ?>;" >
                        <select id="rodzaj_rachunku">
                            <option value="pl" selected>PL</option>
                            <option value="inny">Inny</option>
                        </select>
                        <input
							<?php echo ($dane_umowy_platnosc['osoba_do_wyplaty_id'] == $sprawa['sprawa_klient_id']) ? 'disabled' : '' ; ?>
							value="<?php echo $dane_umowy_platnosc_osoba['nr_rachunku']; ?>"
							maxlength="32" size="32" placeholder="Nr rachunku bankowego"
							type="text"
							class="dane_do_umowy_platnosc_rachunek wynagrodzenie_nr_rachunku_bankowego nr_rachunku_bankowego rachunek_bankowy_edycja"
							onkeyup="sprawdz_numer_rachunku(this);" />
					</div>
					<div
						class="zleceniodawca_formularz_imie wynagrodzenie_imie  zleceniodawca_formularz_element margin_r_20 margin_t_10">
						<input
							<?php echo ($dane_umowy_platnosc['osoba_do_wyplaty_id'] == $sprawa['sprawa_klient_id']) ? 'disabled' : '' ; ?>
							placeholder="Imię" type="text"
							value="<?php echo $dane_umowy_platnosc_osoba['imie']; ?>"
							class="dane_do_umowy_pole_obowiazkowe wynagrodzenie_zleceniodawca_imie imie imie_przelew imie_przelew_edytuj_widok"
							tab="1" />
					</div>
					<div
						class="zleceniodawca_formularz_nazwisko wynagrodzenie_nazwisko  zleceniodawca_formularz_element margin_t_10">
						<input
							<?php echo ($dane_umowy_platnosc['osoba_do_wyplaty_id'] == $sprawa['sprawa_klient_id']) ? 'disabled' : '' ; ?>
							placeholder="Nazwisko" type="text"
							value="<?php echo $dane_umowy_platnosc_osoba['nazwisko']; ?>"
							class="dane_do_umowy_pole_obowiazkowe wynagrodzenie_zleceniodawca_nazwisko nazwisko nazwisko_przelew"
							tab="2" />
					</div>
					<div class="clear_b"></div>
					<div
						class="zleceniodawca_formularz_ulica wynagrodzenie_ulica  zleceniodawca_formularz_element margin_r_20 margin_t_10">
						<input
							<?php echo ($dane_umowy_platnosc['osoba_do_wyplaty_id'] == $sprawa['sprawa_klient_id']) ? 'disabled' : '' ; ?>
							placeholder="Ulica" type="text"
							value="<?php echo $dane_umowy_platnos_osoba_adres['ulica']; ?>"
							class="dane_do_umowy_pole_obowiazkowe wynagrodzenie_zleceniodawca_ulica ulica ulica_przelew"
							tab="3" />
					</div>
					<div
						class="zleceniodawca_formularz_nr_domu wynagrodzenie_dom  zleceniodawca_formularz_element margin_r_10 margin_t_10">
						<input
							<?php echo ($dane_umowy_platnosc['osoba_do_wyplaty_id'] == $sprawa['sprawa_klient_id']) ? 'disabled' : '' ; ?>
							maxlength="12" size="12" placeholder="Nr domu"
							value="<?php echo $dane_umowy_platnos_osoba_adres['nr_domu']; ?>"
							type="text"
							class="dane_do_umowy_pole_obowiazkowe wynagrodzenie_zleceniodawca_nr_domu dom_przelew"
							tab="4" />
					</div>
					<div
						class="zleceniodawca_formularz_nr_mieszkania wynagrodzenie_mieszkanie  zleceniodawca_formularz_element margin_r_10 margin_t_10">
						<input
							<?php echo ($dane_umowy_platnosc['osoba_do_wyplaty_id'] == $sprawa['sprawa_klient_id']) ? 'disabled' : '' ; ?>
							maxlength="15" size="15" placeholder="Nr mieszkania"
							value="<?php echo $dane_umowy_platnos_osoba_adres['nr_mieszkania']; ?>"
							type="text"
							class="wynagrodzenie_zleceniodawca_nr_mieszkania mieszkanie_przelew dane_do_umowy_nr_mieszkania_edytuj_widok"
							tab="5" />
					</div>
					<div
						class="zleceniodawca_formularz_kod_pocztowy wynagrodzenie_kod  zleceniodawca_formularz_element margin_t_10 ">
						<input
							<?php echo ($dane_umowy_platnosc['osoba_do_wyplaty_id'] == $sprawa['sprawa_klient_id']) ? 'disabled' : '' ; ?>
							maxlength="6" size="6" placeholder="Kod pocztowy"
							value="<?php echo $dane_umowy_platnos_osoba_adres['kod_pocztowy']; ?>"
							type="text"
							class="dane_do_umowy_pole_obowiazkowe wynagrodzenie_zleceniodawca_kod_pocztowy kod_pocztowy kod_przelew"
							tab="6" onkeyup="sprawdz_kod_pocztowy(this);" />
					</div>
					<div
						class="zleceniodawca_formularz_miejscowosc wynagrodzenie_miejscowosc  zleceniodawca_formularz_element  margin_t_10">
						<input
							<?php echo ($dane_umowy_platnosc['osoba_do_wyplaty_id'] == $sprawa['sprawa_klient_id']) ? 'disabled' : '' ; ?>
							placeholder="Miejscowość" type="text"
							value="<?php echo $dane_umowy_platnos_osoba_adres['miasto']; ?>"
							class="dane_do_umowy_pole_obowiazkowe wynagrodzenie_zleceniodawca_miejscowosc miejscowosc_przelew"
							tab="7" />
					</div>
					<div class="clear_b"></div>
				</div>




			</div>
		</div>

		<div
			class="zz_edytuj  zablokowane_pole_transparent sposob_platnosci_zapisz_zmiany">ZAPISZ
			ZMIANY</div>
	</div>


</div>

</div>
</div>
</div>
