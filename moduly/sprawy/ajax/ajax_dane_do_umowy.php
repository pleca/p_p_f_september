<?php
require_once ($_SERVER ['DOCUMENT_ROOT'] . '/czy_zalogowany.php');

require_once ($_SERVER ['DOCUMENT_ROOT'] . 'moduly/sprawy/db/funkcje_db.php');
require_once ($_SERVER ['DOCUMENT_ROOT'] . 'db/function_db.php');

$lista_klientow = pobierz_liste_klientow_ze_sprawami ();
$lista_klientow_1 = pobierz_liste_klientow_ze_sprawami ();
$lista_klientow_2 = pobierz_liste_klientow_ze_sprawami ();

$uprawnienie_do_umowy_bankowej = sprawdz_uprawnienie ($_SESSION['uzytkownik_id'], '44'); // w umowach
//$uprawnienie_do_umowy_bankowej = sprawdz_uprawnienie ($_SESSION['uzytkownik_id'], '46');  // w panelu

// $lista_klientow = pobierz_liste_klientow();

$id_klienta = htmlspecialchars ( $_POST ['id_klienta'] );
$id_klienta_1 = htmlspecialchars ( $_POST ['id_klienta'] );
$id_klienta_2 = htmlspecialchars ( $_POST ['id_klienta'] );

if (! empty ( $id_klienta )) {
	$klient = sprawa_pobierz_dane_klienta_dla_uzytkownika ( $id_klienta );
}

if (! empty ( $id_klienta_1 )) {
	$klient = sprawa_pobierz_dane_klienta_dla_uzytkownika ( $id_klienta_1 );
}

if (! empty ( $id_klienta_2 )) {
	$klient_2 = sprawa_pobierz_dane_klienta_dla_uzytkownika ( $id_klienta_2 );
}

$uzytkownik = pobierz_dane_z_tabeli_dla_id ( 'uzytkownik', $id_klienta );
// $uprawnienie = $uzytkownik ['uzytkownik_grupa_id'];

?>

<div id="id_druk_umowy" class="tlo_umowa druk_umowy">
	<div class="druk_umowy_strona">
		<div class="druk_umowy_strona_str_1 strona_umowy">
			<div class="strona_umowy str_1 mop">
				<div class="formularz_umowy">
					<div class="pytanie_do_klienta">
						<p class="zgoda_napis pytanie_o_przetwarzanie ">CZY KLIENT WYRAŻA
							ZGODĘ NA PRZETWARZANIE DANYCH OSOBOWYCH?</p>
						<div class="przetwarzanie">
							<div class="zgoda">
								tak
								<p class="kratka tak"></p>
							</div>
							<div class="zgoda">
								nie
								<p class="kratka nie"></p>
							</div>
							<div class="clear_b "></div>
						</div>

						<div class="komunikat_brak_zgody">Niestety bez zgody nie możesz
							rozpocząć sporządzania umowy!!!</div>
					</div>


					<div class="typ_szkody ">
						<p class="typ_szkody_naglowek_tresc margin_b_10">TYP SZKODY</p>
						<div class="szkoda">
							Obrażenia ciała
							<p class="kratka obrazenia"></p>
						</div>
						<div class="szkoda">
							Śmierć poszkodowanego
							<p class="kratka smierc"></p>
						</div>

						<div class="szkoda" style="display:<?php echo (isset($uprawnienie_do_umowy_bankowej ['1'])) ? 'block' : 'none'; ?>">
							Roszczenia z umów bankowych
							<p class="kratka bank"></p>
						</div>

						<div class="clear_b "></div>
						<div class="inne_szkody margin_t_10">
							<div class="szkoda">
								Szkoda w pojeździe
								<p class="kratka pojazd"></p>
							</div>
							<div class="szkoda">
								Szkoda w budynku
								<p class="kratka budynek"></p>
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

					<div class="rodzaj_wypadku margin_t_10">
						<p class="rodzaj_wypadku_naglowek_tresc margin_b_10">RODZAJ
							WYPADKU</p>
						<div class="rodzaj">
							Komunikacyjny
							<p class="kratka komunikacyjny"></p>
						</div>
						<div class="rodzaj">
							W rolnictwie
							<p class="kratka w_rolnictwie"></p>
						</div>
						<div class="rodzaj">
							Inny
							<p class="kratka inne"></p>
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
					<div id="zapisz_strone_1"
						class="zapisz_str_1 margin_t_10 zablokowane_pole_transparent">ZAPISZ
						I PRZEJŹ DALEJ</div>
				</div>
			</div>

			<div class="strona_umowy str_2 mop">

                    <?php
																				
																				$lista_jednostek = sprawa_pobierz_jednostki ();
																				
																				?>
                        <p>WYBIERZ KOD JEDNOSTKI</p>
				<select class="lista_jednostek_opcje ">
					<option selected class="select_opcja_d">Wybierz</option>
                            <?php
																												
																												while ( $lj = mysqli_fetch_assoc ( $lista_jednostek ) ) {
																													echo '<option id="' . $lj ['id'] . '" class="select_opcja" >';
																													echo $lj ['kod_jednostki'] . ', ' . $lj ['nazwa'];
																													echo '</option>';
																												}
																												
																												?>
                        </select>


				<p class="zleceniodawca_naglowek_tresc margin_b_10">ZLECENIODAWCA</p>

				<div class="zleceniodawca_formularz klient_umowa margin_t_10">
					<p>WYBIERZ KLIENTA Z LISTY</p>
					<select name="lista_klientow_opcje" class="lista_klientow_opcje ">
						<option <?php if(empty($id_klienta)){ echo 'selected'; } ?>
							class="select_opcja_d">Wybierz</option>
                                <?php
																																
																																while ( $wiersz = mysqli_fetch_assoc ( $lista_klientow ) ) {
																																	echo '<option id="' . $wiersz ['id'] . '" class="select_opcja" ';
																																	if ($id_klienta == $wiersz ['id']) {
																																		echo 'selected';
																																	}
																																	echo '>' . $wiersz ['id'] . ' - ' . $wiersz ['imie'] . ' ' . $wiersz ['nazwisko'] . ', ' . $wiersz ['pesel'] . ', ' . $wiersz ['dowod'] . '</option>';
																																}
																																
																																?>
                            </select>

                    <div class="instrukcja_dodaj margin_t_10 margin_b_10 akcja_dodawania">
                        <span>DODAJ NOWEGO KLIENTA</span>
                    </div>
                    <div class="dodawanie_klienta margin_b_10">
                        <p class="margin_t_10">DODAJ KLIENTA (ZLECENIODAWCE)</p>
                        <div
                            class="zleceniodawca_formularz_imie zleceniodawca_formularz_element margin_r_20 zablokowane_pole">
                            <input placeholder="Imię" type="text"
                                class="zleceniodawca_imie_b imie" tab="1"
                                value="<?php echo $klient['imie']; ?>" />
                        </div>
                        <div
                            class="zleceniodawca_formularz_nazwisko zleceniodawca_formularz_element zablokowane_pole margin_r_20">
                            <input placeholder="Nazwisko" type="text"
                                class="zleceniodawca_nazwisko_b nazwisko" tab="2"
                                value="<?php echo $klient['nazwisko']; ?>" />
                        </div>
                        <div
                            class="zleceniodawca_formularz_wiek zablokowane_pole zleceniodawca_formularz_element ">
                            <input placeholder="Wiek" type="text" class="zleceniodawca_wiek_b"
                                tab="2" value="<?php echo $klient[13]; ?>" />
                        </div>
                        <div class="clear_b"></div>
                        <p class="margin_t_10">ADRES ZAMELDOWANIA ZLECENIODAWCY</p>
                        <div
                            class="zleceniodawca_formularz_ulica zleceniodawca_formularz_element margin_r_20 zablokowane_pole">
                            <input placeholder="Ulica" type="text"
                                class="zleceniodawca_ulica_b" tab="3"
                                value="<?php echo $klient['ulica']; ?>" />
                        </div>
                        <div
                            class="zleceniodawca_formularz_nr_domu zleceniodawca_formularz_element margin_r_10 zablokowane_pole">
                            <input maxlength="12" size="12" placeholder="Nr domu" type="text"
                                class="zleceniodawca_nr_domu_b" tab="4"
                                value="<?php echo $klient['nr_domu']; ?>" />
                        </div>
                        <div
                            class="zleceniodawca_formularz_nr_mieszkania zleceniodawca_formularz_element margin_r_10 zablokowane_pole">
                            <input maxlength="15" size="15" placeholder="Nr mieszkania"
                                type="text" class="zleceniodawca_nr_mieszkania_b" tab="5"
                                value="<?php echo $klient['nr_mieszkania']; ?>" />
                        </div>
                        <div
                            class="zleceniodawca_formularz_kod_pocztowy zleceniodawca_formularz_element zablokowane_pole">
                            <input maxlength="6" size="6" placeholder="Kod pocztowy"
                                type="text" class="zleceniodawca_kod_pocztowy_b kod_pocztowy"
                                tab="6" onkeyup="sprawdz_kod_pocztowy(this);"
                                value="<?php echo $klient['kod_pocztowy']; ?>" />
                        </div>
                        <div
                            class="zleceniodawca_formularz_miejscowosc zleceniodawca_formularz_element margin_r_20 margin_t_10 zablokowane_pole">
                            <input placeholder="Miejscowość" type="text"
                                class="zleceniodawca_miejscowosc_b" tab="7"
                                value="<?php echo $klient['miasto']; ?>" />
                        </div>
                        <div
                            class="zleceniodawca_formularz_pesel zleceniodawca_formularz_element margin_r_20 margin_t_10 zablokowane_pole">
                            <input maxlength="11" size="11" placeholder="Pesel" type="text"
                                class="zleceniodawca_pesel_b pesel" tab="8"
                                onkeyup="sprawdz_pesel(this);"
                                value="<?php echo $klient['pesel']; ?>" />
                        </div>
                        <div
                            class="zleceniodawca_formularz_seria_i_numer_dowodu zleceniodawca_formularz_element margin_t_10 zablokowane_pole">
                            <input maxlength="9" size="9" placeholder="Seria i numer dowodu"
                                type="text"
                                class="zleceniodawca_seria_i_numer_dowodu_b numer_dowodu" tab="9"
                                onkeyup="sprawdz_dowod(this);"
                                value="<?php echo $klient['dowod_osobisty']; ?>" />
                        </div>
                        <div class="clear_b"></div>
                        <p class="margin_t_10">DANE KONTAKTOWE ZLECENIODAWCY</p>
                        <div
                            class="zleceniodawca_formularz_email zleceniodawca_formularz_element  margin_r_20 zablokowane_pole">
                            <input placeholder="Email" type="text"
                                class="zleceniodawca_email_b email" tab="10"
                                value="<?php echo $klient['email']; ?>" />
                        </div>
                        <div
                            class="zleceniodawca_formularz_telefon zleceniodawca_formularz_element zablokowane_pole">
                            <input placeholder="Telefon" type="text"
                                class="zleceniodawca_telefon_b" tab="11"
                                value="<?php echo $klient['telefon_kom']; ?>" />
                        </div>
                        <div class="clear_b margin_b_10"></div>
                        <p class="adres_kor_napis margin_b_10">ADRES DO KORESPONDENCJI</p>
                        <div class="korespondencja obecny_klient">
                            Taki jak zameldowania
                            <p class="kratka zaznaczone klient_obecny"></p>
                        </div>
                        <div class="clear_b "></div>
                        <div class="adres_kor_form margin_b_10 margin_t_10">
                            <div
                                class="zleceniodawca_formularz_ulica zleceniodawca_formularz_element margin_r_20  ">
                                <input placeholder="Ulica" type="text"
                                    class="zleceniodawca_ulica_kor_b"
                                    value="<?php echo $klient['ulica']; ?>" />
                            </div>
                            <div
                                class="zleceniodawca_formularz_nr_domu zleceniodawca_formularz_element margin_r_10  ">
                                <input maxlength="12" size="12" placeholder="Nr domu" type="text"
                                    class="zleceniodawca_nr_domu_kor_b"
                                    value="<?php echo $klient['nr_domu']; ?>" />
                            </div>
                            <div
                                class="zleceniodawca_formularz_nr_mieszkania zleceniodawca_formularz_element margin_r_10  ">
                                <input maxlength="15" size="15" placeholder="Nr mieszkania"
                                    type="text" class="zleceniodawca_nr_mieszkania_kor_b"
                                    value="<?php echo $klient['nr_mieszkania']; ?>" />
                            </div>
                            <div
                                class="zleceniodawca_formularz_kod_pocztowy zleceniodawca_formularz_element  ">
                                <input maxlength="6" size="6" placeholder="Kod pocztowy"
                                    type="text" class="zleceniodawca_kod_pocztowy_kor_b kod_pocztowy"
                                    onkeyup="sprawdz_kod_pocztowy(this);"
                                    value="<?php echo $klient['kod_pocztowy']; ?>" />
                            </div>
                            <div
                                class="zleceniodawca_formularz_miejscowosc zleceniodawca_formularz_element margin_r_20 margin_t_10 ">
                                <input placeholder="Miejscowość" type="text"
                                    class="zleceniodawca_miejscowosc_kor_b"
                                    value="<?php echo $klient['miasto']; ?>" />
                            </div>
                            <div class="clear_b"></div>

                        </div>
                    </div>

				</div>

				<div class="zleceniodawca_formularz_dodaj margin_b_10">
					<p class="margin_t_10_b_5">DANE KLIENTA (ZLECENIODAWCY)</p>
					<div
						class="zleceniodawca_formularz_imie zleceniodawca_formularz_element margin_r_20">
						<input placeholder="Imię" type="text"
							class="zleceniodawca_imie_dodaj imie" tab="1" />
					</div>
					<div
						class="zleceniodawca_formularz_nazwisko zleceniodawca_formularz_element margin_r_20">
						<input placeholder="Nazwisko" type="text"
							class="zleceniodawca_nazwisko_dodaj nazwisko" tab="2" />
					</div>
					<div class="clear_b"></div>
					<p class="margin_t_10_b_5">ADRES ZAMELDOWANIA ZLECENIODAWCY</p>
					<div
						class="zleceniodawca_formularz_ulica zleceniodawca_formularz_element margin_r_20">
						<input placeholder="Ulica" type="text"
							class="zleceniodawca_ulica_dodaj" tab="3" />
					</div>
					<div
						class="zleceniodawca_formularz_nr_domu zleceniodawca_formularz_element margin_r_10">
						<input maxlength="12" size="12" placeholder="Nr domu" type="text"
							class="zleceniodawca_nr_domu_dodaj" tab="4" />
					</div>
					<div
						class="zleceniodawca_formularz_nr_mieszkania zleceniodawca_formularz_element margin_r_10">
						<input maxlength="15" size="15" placeholder="Nr mieszkania"
							type="text" class="zleceniodawca_nr_mieszkania_dodaj" tab="5" />
					</div>
					<div
						class="zleceniodawca_formularz_kod_pocztowy zleceniodawca_formularz_element ">
						<input maxlength="6" size="6" placeholder="Kod pocztowy"
							type="text" class="zleceniodawca_kod_pocztowy_dodaj kod_pocztowy"
							tab="6" onkeyup="sprawdz_kod_pocztowy(this);" />
					</div>
					<div
						class="zleceniodawca_formularz_miejscowosc zleceniodawca_formularz_element margin_r_20 margin_t_10">
						<input placeholder="Miejscowość" type="text"
							class="zleceniodawca_miejscowosc_dodaj" tab="7" />
					</div>
					<div class="clear_b"></div>
					<div class="pytanie_obcokrajowiec margin_b_10 margin_t_10">
						<p>Zleceniodawca jest obcokrajowcem</p>
						<div class="obcokrajowiec margin_t_0">
							tak
							<p class="kratka tak"></p>
						</div>
						<div class="obcokrajowiec margin_t_0">
							nie
							<p class="kratka nie zaznaczone"></p>
						</div>
						<div class="clear_b "></div>
					</div>

					<div class="dane_identyfikacyjne margin_b_10">
						<div
							class="zleceniodawca_formularz_pesel zleceniodawca_formularz_element margin_r_20 ">
							<input maxlength="11" size="11" placeholder="Pesel" type="text"
								class="zleceniodawca_pesel_dodaj pesel" tab="8"
								//onkeyup="sprawdz_pesel(this);" />
						</div>
						<div
							class="zleceniodawca_formularz_seria_i_numer_dowodu zleceniodawca_formularz_element ">
							<input maxlength="9" size="9" placeholder="Seria i numer dowodu"
								type="text"
								class="zleceniodawca_seria_i_numer_dowodu_dodaj numer_dowodu"
								tab="9" onkeyup="sprawdz_dowod(this);" />
						</div>
					</div>
					<div class="dane_identyfikacyjne_obcokrajowca margin_b_10">
						<div
							class="zleceniodawca_formularz_pesel zleceniodawca_formularz_element margin_r_20 ">
							<input maxlength="22" size="20" placeholder="Rodzaj dokumentu"
								type="text" class="zleceniodawca_dokument_dodaj dokument" />
						</div>
						<div
							class="zleceniodawca_formularz_seria_i_numer_dowodu zleceniodawca_formularz_element ">
							<input maxlength="16" size="16" placeholder="Numer dokumentu"
								type="text" class="zleceniodawca_numer_dokumentu_dodaj" />
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
					<div class="korespondencja margin_t_10">
						Taki jak zameldowania
						<p class="kratka korespondencja_adres_nk zaznaczone"></p>
					</div>
					<div class="clear_b "></div>
					<div class="adres_kor_form margin_b_10 margin_t_10">
						<div
							class="zleceniodawca_formularz_ulica zleceniodawca_formularz_element margin_r_20  ">
							<input placeholder="Ulica" type="text"
								class="zleceniodawca_ulica_kor_dodaj"
								value="<?php echo $klient['ulica']; ?>" />
						</div>
						<div
							class="zleceniodawca_formularz_nr_domu zleceniodawca_formularz_element margin_r_10  ">
							<input maxlength="12" size="12" placeholder="Nr domu" type="text"
								class="zleceniodawca_nr_domu_kor_dodaj"
								value="<?php echo $klient['nr_domu']; ?>" />
						</div>
						<div
							class="zleceniodawca_formularz_nr_mieszkania zleceniodawca_formularz_element margin_r_10  ">
							<input maxlength="15" size="15" placeholder="Nr mieszkania"
								type="text" class="zleceniodawca_nr_mieszkania_kor_dodaj"
								value="<?php echo $klient['nr_mieszkania']; ?>" />
						</div>
						<div
							class="zleceniodawca_formularz_kod_pocztowy zleceniodawca_formularz_element  ">
							<input maxlength="6" size="6" placeholder="Kod pocztowy"
								type="text"
								class="zleceniodawca_kod_pocztowy_kor_dodaj kod_pocztowy"
								onkeyup="sprawdz_kod_pocztowy(this);"
								value="<?php echo $klient['kod_pocztowy']; ?>" />
						</div>
						<div
							class="zleceniodawca_formularz_miejscowosc zleceniodawca_formularz_element margin_r_20 margin_t_10 ">
							<input placeholder="Miejscowość" type="text"
								class="zleceniodawca_miejscowosc_kor_dodaj"
								value="<?php echo $klient['miasto']; ?>" />
						</div>
						<div class="clear_b"></div>

					</div>
				</div>

				<div id="zapisz_strone_2" class="zapisz_str_2"
					class=" margin_t_10 zablokowane_pole_transparent">ZAPISZ I PRZEJŹ
					DALEJ</div>



			</div>


			<div class="strona_umowy str_2_b umowa_bankowa">

                    <?php
																				
																				$lista_jednostek = sprawa_pobierz_jednostki ();
																				
																				?>
                        <p>WYBIERZ KOD JEDNOSTKI</p>
				<select class="lista_jednostek_opcje">
					<option selected class="select_opcja_d">Wybierz</option>
                            <?php
																												
																												while ( $lj = mysqli_fetch_assoc ( $lista_jednostek ) ) {
																													echo '<option id="' . $lj ['id'] . '" class="select_opcja" >';
																													echo $lj ['kod_jednostki'] . ', ' . $lj ['nazwa'];
																													echo '</option>';
																												}
																												
																												?>
                        </select>


				<p class="zleceniodawca_naglowek_tresc margin_b_10">ZLECENIODAWCA I</p>

				<div class="zleceniodawca_formularz_b1 klient_umowa margin_t_10">
					<p>WYBIERZ KLIENTA Z LISTY</p>
					<select name="lista_klientow_opcje" class="lista_klientow_opcje_b1">
						<option <?php if(empty($id_klienta_1)){ echo 'selected'; } ?>
							class="select_opcja_d">Wybierz</option>
                                <?php
																																while ( $wiersz = mysqli_fetch_assoc ( $lista_klientow_1 ) ) {
																																	echo '<option id="' . $wiersz ['id'] . '" class="select_opcja" ';
																																	if ($id_klienta_1 == $wiersz ['id']) {
																																		echo 'selected';
																																	}
																																	echo '>' . $wiersz ['id'] . ' - ' . $wiersz ['imie'] . ' ' . $wiersz ['nazwisko'] . ', ' . $wiersz ['pesel'] . ', ' . $wiersz ['dowod'] . '</option>';
																																}
																																
																																?>
                            </select>
                    <div class="instrukcja_dodaj_b1 margin_t_10 margin_b_10 akcja_dodawania">
                        DODAJ NOWEGO KLIENTA
                    </div>
                    <div class="dodawanie_klienta_b1 margin_b_10">
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
							class="zleceniodawca_miejscowosc zl_miejscowosc_um_bank_1"
							tab="7" value="<?php echo $klient_1['miasto']; ?>" />
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
						<option <?php if(empty($id_klienta_2)){ echo 'selected'; } ?>
							class="select_opcja_d">Wybierz</option>
                                <?php
																																while ( $wiersz = mysqli_fetch_assoc ( $lista_klientow_2 ) ) {
																																	echo '<option id="' . $wiersz ['id'] . '" class="select_opcja" ';
																																	if ($id_klienta_2 == $wiersz ['id']) {
																																		echo 'selected';
																																	}
																																	echo '>' . $wiersz ['id'] . ' - ' . $wiersz ['imie'] . ' ' . $wiersz ['nazwisko'] . ', ' . $wiersz ['pesel'] . ', ' . $wiersz ['dowod'] . '</option>';
																																}
																																
																																?>
                            </select>
                    <div class="instrukcja_dodaj_b2 margin_t_10 margin_b_10 akcja_dodawania">
                        DODAJ NOWEGO KLIENTA
                    </div>
                    <div class="dodawanie_klienta_b2 margin_b_10">
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
							class="zleceniodawca_miejscowosc zl_miejscowosc_um_bank_2"
							tab="7" value="<?php echo $klient_2['miasto']; ?>" />
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
							placeholder="Nazwa banku" />
						<div class="clear_b"></div>
					</div>

					<div class="zgloszenie_wiersz_elementow">
						<p>Numer umowy:</p>
						<input type="text" name="" class="numer_umowy"
							placeholder="Numer umowy" />
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
							<span class="kratka_2 dok_umowa"></span> Umowa z Klientem
						</p>
						<div class="clear_b"></div>
					</div>
					<div class="zgloszenie_wiersz_elementow">
						<p>
							<span class="kratka_2 dok_pelnomocnictwo"></span> Pełnomocnictwo
						</p>
						<div class="clear_b"></div>
					</div>
					<div class="zgloszenie_wiersz_elementow">
						<p>
							<span class="kratka_2 dok_dok_tozsam"></span> Kopia dokumentu
							tożsamości Klienta
						</p>
						<div class="clear_b"></div>
					</div>
					<div class="zgloszenie_wiersz_elementow">
						<p>
							<span class="kratka_2 dok_wniosek_kred"></span> Kopia wniosku
							kredytowego
						</p>
						<div class="clear_b"></div>
					</div>
					<div class="zgloszenie_wiersz_elementow">
						<p>
							<span class="kratka_2 dok_umowa_kred"></span> Kopia umowy kredytu
							bankowego wraz z aneksami (jeżeli takowe były zawierane)
						</p>
						<div class="clear_b"></div>
					</div>
					<div class="zgloszenie_wiersz_elementow">
						<p>
							<span class="kratka_2 dok_regulamin"></span> Kopia Regulaminu
							udzielania kredytów i pożyczek hipotecznych załączonego do umowy
							kredytu bankowego
						</p>
						<div class="clear_b"></div>
					</div>
					<div class="zgloszenie_wiersz_elementow">
						<p>
							<span class="kratka_2 dok_tab_oplat"></span> Kopia Tabeli Opłat i
							Prowizji załączona do umowy kredytu bankowego
						</p>
						<div class="clear_b"></div>
					</div>
					<div class="zgloszenie_wiersz_elementow">
						<p>
							<span class="kratka_2 dok_harmonogram"></span> Kopia harmonogramu
							spłaty rat
						</p>
						<div class="clear_b"></div>
					</div>
					<div class="zgloszenie_wiersz_elementow">
						<p>
							<span class="kratka_2 dok_potwierdzenie"></span> Kopia
							potwierdzenia spłaty rat
						</p>
						<div class="clear_b"></div>
					</div>
					<div class="zgloszenie_wiersz_elementow">
						<p>
							<span class="kratka_2 dok_decyzje"></span> Decyzje oraz pisma
							Banku w przedmiocie udzielonego kredytu
						</p>
						<div class="clear_b"></div>
					</div>
					<div class="zgloszenie_wiersz_elementow">
						<p>
							<span class="kratka_2 dok_potw_oplaty"></span> Kopia
							potwierdzenia opłaty za ubezpieczenie
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
							<span class="kratka_2 dok_dok_tozsamosci_zlec_2"></span> Kopia
							dokumentu tożsamości Współkredytobiorcy
						</p>
						<div class="clear_b"></div>
					</div>
					<div class="zgloszenie_wiersz_elementow">
						<p>
							<span class="kratka_2 dok_akt_malzenstwa"></span> Kopia odpisu
							skróconego aktu małżeństwa (w przypadku jego zawarcia)
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
							<span class="kratka_2 zlecono_zwrot_tak"></span> Tak
						</p>
						<p>
							<span class="kratka_2 zlecono_zwrot_nie"></span> Nie
						</p>
						<div class="clear_b"></div>
					</div>
					<div class='opcje_przy_zgloszeniu'>
						<p>Wskaż jakie zgłoszono roszczenia</p>
						<div class="zgloszenie_wiersz_elementow">
							<p>
								<span class="kratka_2 nadplacone_raty"></span> nadpłaconych rat
								w związku z zastosowaną indeksacją
							</p>
							<div class="clear_b"></div>
						</div>
						<div class="zgloszenie_wiersz_elementow">
							<p>
								<span class="kratka_2 oplaty_ubep_pom"></span> nienależnie
								pobranej opłaty w związku z likwidacją ubezpieczenia
								pomostowego:
							</p>
							<input type="text" name="" class="data data_ub_pom"
								placeholder="Data zgłoszenia" />
							<div class="clear_b"></div>
						</div>
						<div class="zgloszenie_wiersz_elementow">
							<p>
								<span class="kratka_2 oplaty_ubezp_wkl_wl"></span> nienależnie
								pobranej opłaty w związku z likwidacją ubezpieczenia wkładu
								własnego:
							</p>
							<input type="text" name="" class="data data_wk_wl"
								placeholder="Data zgłoszenia" />
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
								<span class="kratka_2 czy_zlecono"></span> Sprawę zlecono
								wcześniej pełnomocnikowi:
							</p>
							<input type="text" name="" class="nazwa_pelnomocnika"
								placeholder="Nazwa" />
							<div class="clear_b"></div>
							<p>z którym zawarto umowę dnia:</p>
							<input type="text" name="" class="data data_zlecenia"
								placeholder="Data zlecenia" />
							<div class="clear_b"></div>
						</div>
						<div class="zgloszenie_wiersz_elementow dane_o_wypowiedzeniu">
							<p>
								<span class="kratka_2 wypowiedziono"></span> umowę z wyżej
								wymienionym wypowiedziano w dniu
							</p>
							<input type="text" name="" class="data data_wypowiedzenia"
								placeholder="Data wypowiedzenia" />
							<div class="clear_b"></div>
						</div>
						<div class="dr_informacje margin_t_10 margin_b_10">
							<p>Czy klient wyraża zgodę na otrzymywanie informacji związanych
								z wykonywaniem umowy?</p>
							<p class="zgody_na_inf">
								<span class="kratka_2 inf_zgoda_tak"></span> Tak
							</p>
							<p>
								<span class="kratka_2 inf_zgoda_nie"></span> Nie
							</p>
							<div class="clear_b"></div>
							<div class="rodzaj_informowania">
								<p>
									<span class="kratka_2 inf_sms"></span> wiadomości SMS na podany
									przeze mnie numer
								</p>
								<p>
									<span class="kratka_2 inf_email"></span> wiadomości e-mail na
									podany przeze mnie adres
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


			<div class="strona_umowy str_7_b umowa_bankowa">
				<p class="wynagrodzenie_naglowek_tresc">WYNAGRODZENIE</p>
				<div class="wynagrodzenie_naglowek_tresc_tresc">
					<div class="wynagrodzenie ">
						<div class="zgloszenie_wiersz_elementow wybor_umowy">
							<p>Uzupełnij kwotę prowizji:</p>
							<input type="number" name="" class="prowizja_usl_bankowe" min="1"
								max="100" placeholder="Prowizja w %" value="30" />
							<div class="clear_b"></div>
						</div>

						<div class="zgloszenie_wiersz_elementow wybor_umowy">
							<p>
								<span class="kratka_2 przekaz_pocztowy"></span>przekaz pocztowy
							</p>
							<p>
								<span class="kratka_2 przelew_bankowy"></span>przelew bankowy
							</p>
							<div class="clear_b"></div>
						</div>
						<div class="wynagrodzenie_przelew ">
							<div class="kopiuj_adres_zleceniodawcy">
								<p>
									<span class="kratka_2 zleceniodawca_odbiorca"></span>Odbiorcą
									wynagrodzenia jest Zleceniodawca
								</p>
							</div>
							<div
								class="zleceniodawca_formularz_numer_rachunku_bankowego zleceniodawca_formularz_element margin_t_10">
								<input maxlength="32" size="32"
									placeholder="Nr rachunku Bankowego" type="text"
									class="wynagrodzenie_nr_rachunku_bankowego nr_rachunku_bankowego"
									onkeyup="" />
							</div>
							<div
								class="zleceniodawca_formularz_imie wynagrodzenie_imie  zleceniodawca_formularz_element margin_r_20 margin_t_10">
								<input placeholder="Imię" type="text"
									class="wynagrodzenie_zleceniodawca_imie imie imie_przelew"
									tab="1" />
							</div>
							<div
								class="zleceniodawca_formularz_nazwisko wynagrodzenie_nazwisko  zleceniodawca_formularz_element margin_t_10">
								<input placeholder="Nazwisko" type="text"
									class="wynagrodzenie_zleceniodawca_nazwisko nazwisko nazwisko_przelew"
									tab="2" />
							</div>
							<div class="clear_b"></div>
							<div
								class="zleceniodawca_formularz_ulica wynagrodzenie_ulica  zleceniodawca_formularz_element margin_r_20 margin_t_10">
								<input placeholder="Ulica" type="text"
									class="wynagrodzenie_zleceniodawca_ulica ulica ulica_przelew"
									tab="3" />
							</div>
							<div
								class="zleceniodawca_formularz_nr_domu wynagrodzenie_dom  zleceniodawca_formularz_element margin_r_10 margin_t_10">
								<input maxlength="12" size="12" placeholder="Nr domu"
									type="text"
									class="wynagrodzenie_zleceniodawca_nr_domu dom_przelew" tab="4" />
							</div>
							<div
								class="zleceniodawca_formularz_nr_mieszkania wynagrodzenie_mieszkanie  zleceniodawca_formularz_element margin_r_10 margin_t_10">
								<input maxlength="15" size="15" placeholder="Nr mieszkania"
									type="text"
									class="wynagrodzenie_zleceniodawca_nr_mieszkania mieszkanie_przelew"
									tab="5" />
							</div>
							<div
								class="zleceniodawca_formularz_kod_pocztowy wynagrodzenie_kod  zleceniodawca_formularz_element margin_t_10 margin_r_20">
								<input maxlength="6" size="6" placeholder="Kod pocztowy"
									type="text"
									class="wynagrodzenie_zleceniodawca_kod_pocztowy kod_pocztowy kod_przelew"
									tab="6" onkeyup="sprawdz_kod_pocztowy(this);" />
							</div>
							<div
								class="zleceniodawca_formularz_miejscowosc wynagrodzenie_miejscowosc  zleceniodawca_formularz_element margin_r_20 margin_t_10">
								<input placeholder="Miejscowość" type="text"
									class="wynagrodzenie_zleceniodawca_miejscowosc miejscowosc_przelew"
									tab="7" />
							</div>
						</div>

						<div class="wynagrodzenie_przekaz margin_t_10">
							<div class="kopiuj_adres_zleceniodawcy">
								<p>
									<span
										class="kratka_2 zleceniodawca_odbiorca odbiorca_wynagrodzenia_zleceniodawca"></span>Odbiorcą
									wynagrodzenia jest Zleceniodawca
								</p>
							</div>
							<div class="clear_b"></div>
							<div
								class="zleceniodawca_formularz_imie wynagrodzenie_imie  zleceniodawca_formularz_element margin_r_20 margin_t_10">
								<input placeholder="Imię" type="text"
									class="wynagrodzenie_zleceniodawca_imie imie imie_przekaz"
									tab="1" />
							</div>
							<div
								class="zleceniodawca_formularz_nazwisko wynagrodzenie_nazwisko  zleceniodawca_formularz_element margin_t_10">
								<input placeholder="Nazwisko" type="text"
									class="wynagrodzenie_zleceniodawca_nazwisko nazwisko nazwisko_przekaz"
									tab="2" />
							</div>
							<div class="clear_b"></div>
							<div
								class="zleceniodawca_formularz_ulica wynagrodzenie_ulica  zleceniodawca_formularz_element margin_r_20 margin_t_10">
								<input placeholder="Ulica" type="text"
									class="wynagrodzenie_zleceniodawca_ulica ulica_przekaz" tab="3" />
							</div>
							<div
								class="zleceniodawca_formularz_nr_domu wynagrodzenie_dom  zleceniodawca_formularz_element margin_r_10 margin_t_10">
								<input maxlength="12" size="12" placeholder="Nr domu"
									type="text"
									class="wynagrodzenie_zleceniodawca_nr_domu dom_przekaz" tab="4" />
							</div>
							<div
								class="zleceniodawca_formularz_nr_mieszkania wynagrodzenie_mieszkanie  zleceniodawca_formularz_element margin_r_10 margin_t_10">
								<input maxlength="15" size="15" placeholder="Nr mieszkania"
									type="text"
									class="wynagrodzenie_zleceniodawca_nr_mieszkania mieszkanie_przekaz"
									tab="5" />
							</div>
							<div
								class="zleceniodawca_formularz_kod_pocztowy wynagrodzenie_kod  zleceniodawca_formularz_element margin_t_10 margin_r_20">
								<input maxlength="6" size="6" placeholder="Kod pocztowy"
									type="text"
									class="wynagrodzenie_zleceniodawca_kod_pocztowy kod_pocztowy kod_przekaz"
									tab="6" onkeyup="sprawdz_kod_pocztowy(this);" />
							</div>
							<div
								class="zleceniodawca_formularz_miejscowosc wynagrodzenie_miejscowosc  zleceniodawca_formularz_element margin_r_20 margin_t_10">
								<input placeholder="Miejscowość" type="text"
									class="wynagrodzenie_zleceniodawca_miejscowosc miejscowosc_przekaz"
									tab="7" />
							</div>
						</div>

						<div class="clear_b"></div>
					</div>
				</div>

				<div id="zapisz_strone_7_b" class="zapisz_str_7_b"
					class=" margin_t_10 zablokowane_pole_transparent">ZAPISZ I GENERUJ
					UMOWE</div>
			</div>








			<div class="strona_umowy str_3 mop">

                    <?php
																				
																				$lista_umow_klonowania = pobierz_liste_umow ();
																				
																				?>
                        <div class="klonowanie_umowy">
					<select class="klonowanie_umowy_lista">
                                <?php
																																echo '<option class="select_opcja_ku" selected>Wybierz</option>';
																																while ( $luk = mysqli_fetch_assoc ( $lista_umow_klonowania ) ) {
																																	echo '<option class="select_opcja_ku" id="' . $luk ['id'] . '">';
																																	echo $luk ['id'];
																																	if (! empty ( $luk ['imie'] )) {
																																		echo ', ' . $luk ['imie'] . ' ' . $luk ['nazwisko'];
																																	}
																																	if (! empty ( $luk ['nazwa'] )) {
																																		echo ', ' . $luk ['nazwa'];
																																	}
																																	if (! empty ( $luk ['wartosc'] )) {
																																		echo ', ' . $luk ['wartosc'];
																																	}
																																	echo '</option>';
																																}
																																
																																?>
                            </select>
					<div class="przenies_dane_umowy">PRZENIEŚ DANE Z UMOWY</div>
					<div class="clear_b "></div>
				</div>

				<div class="poszkodowany_umowa ">
					<p class="poszkodowany_naglowek_tresc margin_b_10">DANE
						POSZKODOWANEGO (ZMARŁEGO)</p>

					<div class="przepisanie_klienta margin_b_10 margin_t_10">
						<p class="poszkodowany margin_b_10 margin_t_10">Osobą poszkodowaną
							jest klient</p>
						<div class="poszkodowany_o margin_t_10 margin_b_10">
							Tak
							<p data-id="<?php echo $poszkodowany['id'];?>"
								class="kratka klient_poszkodowany_tak"></p>
						</div>
						<div class="poszkodowany_o margin_t_10 margin_b_10">
							Nie
							<p data-id="<?php echo $poszkodowany['id'];?>"
								class="kratka klient_poszkodowany_nie"></p>
						</div>
					</div>
					<div class="clear_b"></div>

					<div class="kim_poszkodowany margin_b_10 margin_t_10">
						<p class="poszkodowany margin_b_10 margin_t_10">Poszkodowany był:</p>
						<div class="kb_poszkodowany margin_t_10 margin_b_10">
							osobą małoletnią
							<p data-id="<?php echo $poszkodowany['id'];?>"
								class="kratka poszkodowany_maloletni"></p>
						</div>
						<div class="kb_poszkodowany margin_t_10 margin_b_10">
							osobą ubezwłasnowolnioną całkowicie
							<p data-id="<?php echo $poszkodowany['id'];?>"
								class="kratka poszkodowany_ubezwlasnowolniony"></p>
						</div>
						<div class="kb_poszkodowany margin_t_10 margin_b_10">
							małżonkiem klienta
							<p data-id="<?php echo $poszkodowany['id'];?>"
								class="kratka poszkodowany_malzonek"></p>
						</div>
					</div>
					<div class="clear_b"></div>
                    <div class="dane_klienta_form">
					<div
						class="zleceniodawca_formularz_imie zleceniodawca_formularz_element margin_r_20 ">
						<input placeholder="Imię" type="text"
							class="poszkodowany_imie imie" />
					</div>
					<div
						class="zleceniodawca_formularz_nazwisko zleceniodawca_formularz_element margin_r_20 ">
						<input placeholder="Nazwisko" type="text"
							class="poszkodowany_nazwisko nazwisko" />
					</div>
					<div class="clear_b"></div>
					<div
						class="zleceniodawca_formularz_ulica zleceniodawca_formularz_element margin_r_20 margin_t_10 ">
						<input placeholder="Ulica" type="text" class="poszkodowany_ulica" />
					</div>
					<div
						class="zleceniodawca_formularz_nr_domu zleceniodawca_formularz_element margin_r_10 margin_t_10 ">
						<input maxlength="12" size="12" placeholder="Nr domu" type="text"
							class="poszkodowany_nr_domu" />
					</div>
					<div
						class="zleceniodawca_formularz_nr_mieszkania zleceniodawca_formularz_element margin_r_10 margin_t_10 ">
						<input maxlength="15" size="15" placeholder="Nr mieszkania"
							type="text" class="poszkodowany_nr_mieszkania" />
					</div>
					<div
						class="zleceniodawca_formularz_kod_pocztowy zleceniodawca_formularz_element margin_t_10 ">
						<input maxlength="6" size="6" placeholder="Kod pocztowy"
							type="text" class="poszkodowany_kod_pocztowy kod_pocztowy"
							onkeyup="sprawdz_kod_pocztowy(this);" />
					</div>
					<div
						class="zleceniodawca_formularz_miejscowosc zleceniodawca_formularz_element margin_r_20 margin_t_10 ">
						<input placeholder="Miejscowość" type="text"
							class="poszkodowany_miejscowosc" />
					</div>

					<div class="clear_b margin_b_10 "></div>
					<p class="obcokrajowiec margin_b_10 margin_t_0">Poszkodowany jest
						obcokrajowcem</p>
					<div class="korespondencja">
						Tak
						<p class="kratka obcokrajowiec_tak obc_tak"></p>
					</div>
					<div class="korespondencja">
						Nie
						<p class="kratka obcokrajowiec_nie zaznaczone obc_nie"></p>
					</div>
					<div class="clear_b "></div>
					<div class="dokument_polski">
						<div
							class="zleceniodawca_formularz_pesel zleceniodawca_formularz_element margin_r_20 margin_t_10 ">
							<input maxlength="11" size="11" placeholder="Pesel" type="text"
								class="poszkodowany_pesel pesel" onkeyup="sprawdz_pesel(this);" />
						</div>
						<div
							class="zleceniodawca_formularz_seria_i_numer_dowodu zleceniodawca_formularz_element margin_t_10 ">
							<input maxlength="9" size="9" placeholder="Seria i numer dowodu"
								type="text" class="poszkodowany_seria_i_numer_dowodu"
								onkeyup="sprawdz_dowod(this);" />
						</div>
					</div>
					<div class="dokument_obcokrajowca">
						<div
							class="zleceniodawca_formularz_pesel zleceniodawca_formularz_element margin_r_20 margin_t_10 ">
							<input maxlength="22" size="20" placeholder="Rodzaj dokumentu"
								type="text" class="poszkodowany_dokument dokument" />
						</div>
						<div
							class="zleceniodawca_formularz_seria_i_numer_dowodu zleceniodawca_formularz_element margin_t_10 ">
							<input maxlength="16" size="16" placeholder="Numer dokumentu"
								type="text" class="poszkodowany_numer_dokumentu" />
						</div>
					</div>
					<div class="clear_b "></div>
					<div
						class="zleceniodawca_formularz_email zleceniodawca_formularz_element  margin_r_20  margin_t_10 ">
						<input placeholder="Email" type="text"
							class="poszkodowany_email email" />
					</div>
					<div
						class="zleceniodawca_formularz_telefon zleceniodawca_formularz_element  margin_t_10 ">
						<input placeholder="Telefon" type="text" class="poszkodowany_tel" />
					</div>
                    </div>
					<div class="clear_b margin_b_10"></div>

					<div id="zapisz_strone_3" class="zapisz_str_3"
						class=" margin_t_10 zablokowane_pole_transparent">ZAPISZ I PRZEJŹ
						DALEJ</div>
				</div>

			</div>

			<div class="strona_umowy str_4 mop">

				<p class="uprawniony_naglowek_tresc margin_b_10">UPRAWNIONY</p>
				<div class="uprawniony_formularz margin_b_10 margin_t_10">
					<p>UPRAWNIONY (zaznacz jeśli chcesz podać dane osoby uprawnionej)</p>
					<div class="uprawniony_formularz_kratka">
						<p class="kratka uprawniony_formularz_kratka_kratka"></p>
					</div>
					<div class="clear_b "></div>
					<div class="uprawniony_formularz_formularz margin_b_10 margin_t_10">
						<div
							class="zleceniodawca_formularz_imie zleceniodawca_formularz_element margin_r_20">
							<input placeholder="Imię" type="text"
								class="uprawniony_imie imie" />
						</div>
						<div
							class="zleceniodawca_formularz_nazwisko zleceniodawca_formularz_element margin_r_20">
							<input placeholder="Nazwisko" type="text"
								class="uprawniony_nazwisko nazwisko" />
						</div>
						<div class="clear_b"></div>
						<div
							class="zleceniodawca_formularz_ulica zleceniodawca_formularz_element margin_r_20 margin_t_10">
							<input placeholder="Ulica" type="text" class="uprawniony_ulica" />
						</div>
						<div
							class="zleceniodawca_formularz_nr_domu zleceniodawca_formularz_element margin_r_10 margin_t_10">
							<input maxlength="12" size="12" placeholder="Nr domu" type="text"
								class="uprawniony_nr_domu" />
						</div>
						<div
							class="zleceniodawca_formularz_nr_mieszkania zleceniodawca_formularz_element margin_r_10 margin_t_10">
							<input maxlength="15" size="15" placeholder="Nr mieszkania"
								type="text" class="uprawniony_nr_mieszkania" />
						</div>
						<div
							class="zleceniodawca_formularz_kod_pocztowy zleceniodawca_formularz_element margin_t_10">
							<input maxlength="6" size="6" placeholder="Kod pocztowy"
								type="text" class="uprawniony_kod_pocztowy kod_pocztowy"
								onkeyup="sprawdz_kod_pocztowy(this);" />
						</div>
						<div
							class="zleceniodawca_formularz_miejscowosc zleceniodawca_formularz_element margin_r_20 margin_t_10">
							<input placeholder="Miejscowość" type="text"
								class="uprawniony_miejscowosc" />
						</div>
						<div class="clear_b margin_b_10"></div>
						<p class="obcokrajowiec margin_b_10 margin_t_0">Uprawniony jest
							obcokrajowcem</p>
						<div class="korespondencja">
							Tak
							<p class="kratka obcokrajowiec_tak uprawniony_obcokraj"></p>
						</div>
						<div class="korespondencja">
							Nie
							<p
								class="kratka obcokrajowiec_nie uprawniony_obcokraj zaznaczone"></p>
						</div>
						<div class="clear_b "></div>
						<div class="dokument_polski">
							<div
								class="zleceniodawca_formularz_pesel zleceniodawca_formularz_element margin_r_20 margin_t_10 ">
								<input maxlength="11" size="11" placeholder="Pesel" type="text"
									class="uprawniony_pesel pesel" onkeyup="sprawdz_pesel(this);" />
							</div>
							<div
								class="zleceniodawca_formularz_seria_i_numer_dowodu zleceniodawca_formularz_element margin_t_10 ">
								<input maxlength="9" size="9" placeholder="Seria i numer dowodu"
									type="text" class="uprawniony_seria_i_numer_dowodu"
									onkeyup="sprawdz_dowod(this);" />
							</div>
						</div>
						<div class="dokument_obcokrajowca">
							<div
								class="zleceniodawca_formularz_pesel zleceniodawca_formularz_element margin_r_20 margin_t_10 ">
								<input maxlength="22" size="20" placeholder="Rodzaj dokumentu"
									type="text" class="uprawniony_dokument dokument" />
							</div>
							<div
								class="zleceniodawca_formularz_seria_i_numer_dowodu zleceniodawca_formularz_element margin_t_10 ">
								<input maxlength="16" size="16" placeholder="Numer dokumentu"
									type="text" class="uprawniony_numer_dokumentu" />
							</div>
						</div>
						<div class="clear_b "></div>
						<div
							class="zleceniodawca_formularz_email zleceniodawca_formularz_element  margin_r_20  margin_t_10">
							<input placeholder="Email" type="text"
								class="uprawniony_email email" />
						</div>
						<div
							class="zleceniodawca_formularz_telefon zleceniodawca_formularz_element  margin_t_10">
							<input placeholder="Telefon" type="text"
								class="uprawniony_telefon" />
						</div>
						<div class="clear_b "></div>
					</div>

				</div>
				<div class="uprawniony_informacje_formularz margin_t_10">
					<p>UPRAWNIONY DO UZYSKANIA INFORMACJI TELEFONICZNEJ</p>
					<div class="uprawniony_do_informacji_kratka">
						<p class="kratka uprawniony_do_informacji_kratka_kratka"></p>
					</div>
					<div class="clear_b "></div>
					<div
						class="uprawniony_informacje_formularz_formularz margin_b_10 margin_t_10">
						<div
							class="zleceniodawca_formularz_imie zleceniodawca_formularz_element margin_r_20">
							<input placeholder="Imię" type="text"
								class="uprawniony_informacje_imie imie" />
						</div>
						<div
							class="zleceniodawca_formularz_nazwisko zleceniodawca_formularz_element margin_r_20">
							<input placeholder="Nazwisko" type="text"
								class="uprawniony_informacje_nazwisko nazwisko" />
						</div>
						<div
							class="zleceniodawca_formularz_pesel zleceniodawca_formularz_element  ">
							<input maxlength="11" size="11" placeholder="Pesel" type="text"
								class="uprawniony_informacje_pesel pesel"
								onkeyup="sprawdz_pesel(this);" />
						</div>
						<div class="clear_b"></div>
					</div>
					<div id="zapisz_strone_4"
						class="zapisz_str_4 margin_t_10 zablokowane_pole_transparent">ZAPISZ
						I PRZEJŹ DALEJ</div>
				</div>

			</div>

			<div class="strona_umowy str_5 mop">
				<div class="str_5_rekomendacja ">
					<p class="margin_b_10">REKOMENDACJA</p>
					<input class="str_5_rekomendacja_tresc margin_b_10"
						placeholder="Wprowadź dane osoby..." />
					<div class="str_5_zapisz_rekomendacje sprawa_zapisz_rekomendacje">ZAPISZ
						REKOMENDACJE</div>
				</div>


				<div class="dane_wypadku_formularz ">
					<p class="info_o_zdarzeniu_naglowek_tresc margin_b_10">INFORMACJE O
						ZDARZENIU</p>
					<div
						class="dane_wypadku_data_wypadku zleceniodawca_formularz_element margin_r_20 ">
						<input placeholder="Data wypadku (RRRR-MM-DD)" type="text"
							class="data data_wypadku str_5_data_wypadku" />
					</div>
					<div
						class="dane_wypadku_godzina_wypadku zleceniodawca_formularz_element margin_r_20 ">
						<input placeholder="Godzina (GG:MM)" type="time"
							class="godzina_wypadku" />
					</div>
					<div
						class="dane_wypadku_miejsce_zdarzenia zleceniodawca_formularz_element  ">
						<input placeholder="Miejsce zdarzenia" type="text"
							class="miejsce_zdarzenia" />
					</div>
					<div class="clear_b margin_b_10"></div>
					<p class="float_left">W zdarzeniu uczestniczyły 2 pojazdy</p>
					<div class="pojazd_a_k_b_k">
						<p class="kratka pojazd_a_k_b_k_kratka"></p>
					</div>
					<div class="clear_b margin_b_10"></div>
					<p class="float_left">Poszkodowanym był pieszy lub rowerzysta</p>
					<div class="pojazd_b_k">
						<p class="kratka pojazd_b_k_kratka"></p>
					</div>
					<div class="clear_b margin_b_10"></div>
					<p class="float_left">Szkoda niekomunikacyjna</p>
					<div class="pojazd_c_k">
						<p class="kratka pojazd_c_k_kratka"></p>
					</div>
					<div class="clear_b "></div>
					<div class="margin_t_10 pojazd_a">
						<p>POJAZD A (w którym znajdował się poszkodowany)</p>
						<div
							class="dane_wypadku_pojazd_a_marka zleceniodawca_formularz_element margin_r_20 ">
							<input placeholder="Marka" type="text" class="pojazd_a_marka" />
						</div>
						<div
							class="dane_wypadku_pojazd_a_model zleceniodawca_formularz_element  margin_r_20">
							<input placeholder="Typ pojazdu" type="text"
								class="pojazd_a_model" />
						</div>
						<div
							class="dane_wypadku_pojazd_a_nr_rejestracyjny zleceniodawca_formularz_element  margin_r_20">
							<input placeholder="Nr rejestracyjny" type="text"
								class="pojazd_a_nr_rejestracyjny" />
						</div>
						<div
							class="dane_wypadku_pojazd_a_kraj_rejestracji zleceniodawca_formularz_element  ">
							<input placeholder="Kraj rejestracji" type="text"
								class="pojazd_a_kraj_rejestracji" />
						</div>
						<div
							class="dane_wypadku_pojazd_a_kierujacy_pojazdem zleceniodawca_formularz_element margin_t_10 margin_r_20 ">
							<input placeholder="Kierujący pojazdem" type="text"
								class="pojazd_a_kierujacy_pojazdem" />
						</div>
						<div
							class="dane_wypadku_pojazd_a_posiadacz_pojazdu zleceniodawca_formularz_element margin_t_10 margin_r_20 ">
							<input placeholder="Posiadacz pojazdu" type="text"
								class="pojazd_a_posiadacz_pojazdu" />
						</div>
						<div
							class="dane_wypadku_pojazd_a_uoc_posiadacz_pojazdu zleceniodawca_formularz_element margin_t_10 margin_r_20 ">
							<input placeholder="Ubezpieczyciel OC posiadacza pojazdu"
								type="text" class="pojazd_a_uoc_posiadacz_pojazdu" />
						</div>
						<div
							class="dane_wypadku_pojazd_a_nr_polisy_oc zleceniodawca_formularz_element margin_t_10 ">
							<input placeholder="Numer polisy OC" type="text"
								class="pojazd_a_nr_polisy_oc" />
						</div>
						<div class="clear_b"></div>
					</div>
					<div class="margin_t_10 pojazd_b margin_b_10">
						<p>POJAZD B* lub PODMIOT ODPOWIEDZIALNY</p>
						<div
							class="dane_wypadku_pojazd_a_marka zleceniodawca_formularz_element margin_r_20 ">
							<input placeholder="Marka" type="text" class="pojazd_b_marka" />
						</div>
						<div
							class="dane_wypadku_pojazd_a_model zleceniodawca_formularz_element  margin_r_20">
							<input placeholder="Typ pojazdu" type="text"
								class="pojazd_b_model" />
						</div>
						<div
							class="dane_wypadku_pojazd_a_nr_rejestracyjny zleceniodawca_formularz_element  margin_r_20">
							<input placeholder="Nr rejestracyjny" type="text"
								class="pojazd_b_nr_rejestracyjny" />
						</div>
						<div
							class="dane_wypadku_pojazd_a_kraj_rejestracji zleceniodawca_formularz_element  ">
							<input placeholder="Kraj rejestracji" type="text"
								class="pojazd_b_kraj_rejestracji" />
						</div>
						<div
							class="dane_wypadku_pojazd_a_kierujacy_pojazdem zleceniodawca_formularz_element margin_t_10 margin_r_20 ">
							<input placeholder="Kierujący pojazdem" type="text"
								class="pojazd_b_kierujacy_pojazdem" />
						</div>
						<div
							class="dane_wypadku_pojazd_a_posiadacz_pojazdu zleceniodawca_formularz_element margin_t_10 margin_r_20 ">
							<input placeholder="Posiadacz pojazdu" type="text"
								class="pojazd_b_posiadacz_pojazdu" />
						</div>
						<div
							class="dane_wypadku_pojazd_a_uoc_posiadacz_pojazdu zleceniodawca_formularz_element margin_t_10 margin_r_20 ">
							<input placeholder="Ubezpieczyciel OC posiadacza pojazdu"
								type="text" class="pojazd_b_uoc_posiadacz_pojazdu" />
						</div>
						<div
							class="dane_wypadku_pojazd_a_nr_polisy_oc zleceniodawca_formularz_element margin_t_10 ">
							<input placeholder="Numer polisy OC" type="text"
								class="pojazd_b_nr_polisy_oc" />
						</div>
						<div class="clear_b"></div>
						<div class="zgloszenie_wiersz_elementow margin_t_10">
							<p>Stosunek do kierującego pojazdem A</p>
							<p class="dr_s_do_a_obcy_o">
								<span class="kratka_2 dr_s_do_a_obcy"></span> obcy
							</p>
							<p class="dr_s_do_a_rodzina_o">
								<span class="kratka_2 dr_s_do_a_rodzina"></span> rodzina
							</p>
							<p class="dr_s_do_a_inny_o">
								<span class="kratka_2 dr_s_do_a_inny"></span> inny
							</p>
							<input type="text" name=""
								class="dr_s_do_a_inny_rodzaj dr_s_do_a_inny_o_o"
								placeholder="Rodzaj" />
							<div class="clear_b"></div>
						</div>
						<div class="zgloszenie_wiersz_elementow">
							<p>Stosunek do kierującego pojazdem B</p>
							<p class="dr_s_do_b_obcy_o">
								<span class="kratka_2 dr_s_do_b_obcy"></span> obcy
							</p>
							<p class="dr_s_do_b_rodzina_o">
								<span class="kratka_2 dr_s_do_b_rodzina"></span> rodzina
							</p>
							<p class="dr_s_do_b_inny_o">
								<span class="kratka_2 dr_s_do_b_inny"></span> inny
							</p>
							<input type="text" name=""
								class="dr_s_do_b_inny_rodzaj dr_s_do_b_inny_o_o"
								placeholder="Rodzaj" />
							<div class="clear_b"></div>
						</div>
					</div>
					<p class="opis_zdarzenia_naglowek_tresc margin_b_10">OPIS ZDARZENIA</p>
					<div style="display: block">
						<div class="opis_zdarzenia_pole ">
							<textarea placeholder="Wprowadź dane..." class="opis_zdarzenia"></textarea>
						</div>
					</div>

					<div class='obrazenia_ciala'>
						<p class="opis_obrazen_naglowek_tresc margin_b_10">OPIS OBRAŻEŃ</p>
						<div class="opis_obrazen_pole ">
							<textarea placeholder="Wprowadź dane..." class="opis_obrazen"></textarea>
						</div>
					</div>

					<div class="clear_b"></div>
					<div id="zapisz_strone_5" class="zapisz_str_5"
						class=" margin_t_10 zablokowane_pole_transparent">ZAPISZ I PRZEJŹ
						DALEJ</div>
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
							dochodzenia od kierującego pojazdem mechanicznym zwrotu
							wypłaconego z tytułu ubezpieczenia OC posiadaczy pojazdów
							mechanicznych odszkodowania, jeżeli kierujący: <br /> 1)
							wyrządził szkodę umyślnie lub w stanie po użyciu alkoholu albo
							pod wpływem środków odurzających, substancji psychotropowych lub
							środków zastępczych w rozumieniu przepisów o przeciwdziałaniu
							narkomanii; <br /> 2) wszedł w posiadanie pojazdu wskutek
							popełnienia przestępstwa; <br /> 3) nie posiadał wymaganych
							uprawnień do kierowania pojazdem mechanicznym, z wyjątkiem
							przypadków, gdy chodziło o ratowanie życia ludzkiego lub mienia
							albo o pościg za osobą podjęty bezpośrednio po popełnieniu przez
							nią przestępstwa; <br /> 4) zbiegł z miejsca zdarzenia.
						</p>
						<p>Zgodnie z art. 110 ust. 1 z chwilą wypłaty przez Fundusz
							odszkodowania, sprawca szkody i osoba, która nie dopełniła
							obowiązku zawarcia umowy ubezpieczenia obowiązkowego są
							obowiązani do zwrotu Funduszowi spełnionego świadczenia w
							przypadku gdy: posiadacz zaidentyfikowanego pojazdu
							mechanicznego, którego ruchem szkodę tę wyrządzono, nie był
							ubezpieczony obowiązkowym ubezpieczeniem OC posiadaczy pojazdów
							mechanicznych, lub rolnik, osoba pozostająca z nim we wspólnym
							gospodarstwie domowym lub osoba pracująca w jego gospodarstwie
							rolnym wyrządzili szkodę, a rolnik nie był ubezpieczony
							obowiązkowym ubezpieczeniem OC rolników.</p>
					</div>
					<div class="zgloszenie_wiersz_elementow">
						<p class="margin_t_20">W przypadku możliwości żądania od sprawcy
							lub osoby, która nie dopełniła obowiązku zawarcia umowy
							ubezpieczenia obowiązkowego zwrotu wypłaconych odszkodowań przez
							ubezpieczyciela lub UFG:</p>
						<p class="dr_ub_ufg_tak_o">
							<span class="kratka_2 dr_ub_ufg_tak"></span> decyduję się na
							dochodzenie roszczeń od ubezpieczyciela lub UFG
						</p>
						<div class="clear_b"></div>
						<p class="dr_ub_ufg_nie_o">
							<span class="kratka_2 dr_ub_ufg_nie"></span> nie decyduję się na
							dochodzenie roszczeń od ubezpieczyciela lub UFG
						</p>
						<div class="clear_b"></div>
					</div>
					<div class="zgloszenie_wiersz_elementow margin_t_20">
						<p>W przypadku dochodzenia roszczeń bezpośrednio od swojego
							pracodawcy:</p>
						<div class="clear_b"></div>
						<p class="dr_tak_o">
							<span class="kratka_2 dr_tak"></span> decyduję się na dochodzenie
							roszczeń
						</p>
						<p class="dr_nie_o">
							<span class="kratka_2 dr_nie"></span> nie decyduję się na
							dochodzenie roszczeń
						</p>
						<div class="clear_b"></div>
					</div>

				</div>
				<div id="zapisz_strone_6" class="zapisz_str_6"
					class=" margin_t_10 zablokowane_pole_transparent">ZAPISZ I PRZEJŹ
					DALEJ</div>
			</div>

			<div class="strona_umowy str_7 mop">

				<p class="odpowiedzialnosc_karna_naglowek_tresc">ODPOWIEDZIALNOSC
					KARNA</p>
				<div class="odpowiedzialnosc_karna_naglowek_tresc_tresc">
					<div class="zgloszenie_wiersz_elementow">
						<p>sygn. akt</p>
						<input type="text" name="" class="ok_sygnatura_akt"
							placeholder="sygn. akt" />
						<div class="clear_b"></div>
					</div>
					<div class="zgloszenie_wiersz_elementow">
						<p>
							<span class="kratka_2 ok_sprawca_napisal_oswiadczenie"></span>
							sprawca napisał oświadczenie
						</p>
						<div class="clear_b"></div>
					</div>
					<div class="zgloszenie_wiersz_elementow">
						<p>
							<span class="kratka_2 ok_wezwano_policje"></span> na miejsce
							zdarzenia wezwano policję
						</p>
						<input type="text" class="ok_wp_miejsce" name=""
							placeholder="Miejscowość" />
						<div class="clear_b"></div>
					</div>
					<div class="zgloszenie_wiersz_elementow">
						<p>
							<span class="kratka_2 ok_wszczeto_postepowanie"></span> wszczęto
							postępowanie w sprawie
						</p>
						<div class="clear_b"></div>
					</div>
					<div class="zgloszenie_wiersz_elementow">
						<p>
							<span class="kratka_2 ok_postawiono_sprawcy_zarzut"></span>
							postawiono sprawcy zarzut
						</p>
						<input type="text" name="" class="ok_psz_artykul"
							placeholder="Nr artykułu" />
						<p class="ok_psz_kk_o">
							<span class="kratka_2 ok_psz_kk"></span> k.k
						</p>
						<p class="ok_psz_kw_o">
							<span class="kratka_2 ok_psz_kw"></span> k.w.
						</p>
						<div class="clear_b"></div>
					</div>
					<div class="zgloszenie_wiersz_elementow">
						<p>
							<span class="kratka_2 ok_postepowanie_karne_umorzono"></span>
							postępowanie karne umorzono na podstawie
						</p>
						<input type="text" name="" class="ok_pku_artykul"
							placeholder="Nr artykułu" />
						<p class="ok_pku_kpk_o">
							<span class="kratka_2 ok_pku_kpk"></span> k.p.k.
						</p>
						<p class="ok_pku_kpw_o">
							<span class="kratka_2 ok_pku_kpw"></span> k.p.w.
						</p>
						<div class="clear_b"></div>
					</div>
					<div class="zgloszenie_wiersz_elementow">
						<p>
							<span class="kratka_2 ok_skierowano_akt_do_sadu"></span>
							skierowano akt oskarżenia do sądu
						</p>
						<input type="text" name="" class="ok_sads_pelna_nazwa_sadu"
							placeholder="Pełna nazwa sądu" />
						<div class="clear_b"></div>
					</div>
					<div class="zgloszenie_wiersz_elementow">
						<div class="wyrok">
							<p>
								<span class="kratka_2 ok_zapadl_wyrok"></span> zapadł wyrok
							</p>
							<p class="ok_zw_skazujacy_o">
								<span class="kratka_2 ok_zw_skazujacy"></span> skazujący
							</p>
							<p class="ok_zw_uniewinniajacy_o">
								<span class="kratka_2 ok_zw_uniewinniajacy"></span>
								uniewinniający o czyn
							</p>
							<input type="text" name="" class="ok_zw_u_artykul"
								placeholder="Nr artykułu" />
							<p class="ok_zw_kk_o">
								<span class="kratka_2 ok_zw_kk"></span> k.k
							</p>
							<p class="ok_zw_kw_o">
								<span class="kratka_2 ok_zw_kw"></span> k.w.
							</p>
						</div>
						<div class="clear_b"></div>
					</div>
				</div>

				<div id="zapisz_strone_7" class="zapisz_str_7"
					class=" margin_t_10 zablokowane_pole_transparent">ZAPISZ I PRZEJŹ
					DALEJ</div>
			</div>

			<div class="strona_umowy str_8 mop">

				<p class="odpowiedzialnosc_cywilna_naglowek_tresc">ODPOWIEDZIALNOŚĆ
					CYWILNA</p>
				<div class="odpowiedzialnosc_cywilna_naglowek_tresc_tresc">
					<div class="zgloszenie_wiersz_elementow">
						<p>nr szkody</p>
						<input type="text" name="" class="oc_nr_szkody"
							placeholder="Nr szkody" />
						<div class="clear_b"></div>
					</div>
					<div class="zgloszenie_wiersz_elementow">
						<p class="oc_zgloszono_szp_o">
							<span class="kratka_2 oc_zgloszono_szp"></span> zgłoszono szkodę
							w pojeździe do ubezpieczyciela OC sprawcy
						</p>
						<input type="text" name="" class="data oc_zgloszono_szp_data"
							placeholder="Data" />
						<div class="clear_b"></div>
					</div>
					<div class="zgloszenie_wiersz_elementow">
						<p class="oc_nie_zgloszono_szp_o">
							<span class="kratka_2 oc_nie_zgloszono_szp"></span> nie zgłoszono
							szkody w pojeździe do ubezpieczyciela OC sprawcy
						</p>
						<div class="clear_b"></div>
					</div>
					<div class="zgloszenie_wiersz_elementow">
						<p class="oc_zgloszono_szo_o">
							<span class="kratka_2 oc_zgloszono_szo"></span> zgłoszono szkodę
							na osobie do ubezpieczyciela OC sprawcy
						</p>
						<input type="text" name="" class="data oc_zgloszono_szo_data"
							placeholder="Data" />
						<div class="clear_b"></div>
					</div>
					<div class="zgloszenie_wiersz_elementow">
						<p class="oc_nie_zgloszono_szo_o">
							<span class="kratka_2 oc_nie_zgloszono_szo"></span> nie zgłoszono
							szkody na osobie do ubezpieczyciela OC sprawcy
						</p>
						<div class="clear_b"></div>
					</div>
					<div class="zgloszenie_wiersz_elementow margin_t_10">
						<p>Odszkodowanie z OC sprawcy:</p>
						<div class="clear_b"></div>
						<p class="oc_odszkodowanie_oc_p_nie_wyplacono_o margin_t_10">
							<span class="kratka_2 oc_odszkodowanie_oc_p_nie_wyplacono"></span>
							nie wypłacono
						</p>
						<div class="clear_b"></div>
						<p class="oc_odszkodowanie_oc_p_wyplacono_o">
							<span class="kratka_2 oc_odszkodowanie_oc_p_wyplacono"></span>
							wypłacono na szkodę w pojeździe
						</p>
						<div class="clear_b"></div>
						<p>
							<span class="kratka_2 oc_wyplacono_szo"></span> wypłacono za
							szkodę osobową
						</p>
						<input type="text" name="" class="oc_wyplacono_szo_kwota"
							placeholder="Kwota" />
						<div class="clear_b"></div>
					</div>
					<div class="zgloszenie_wiersz_elementow element_input oc_wyplacono_szo_o">
						<p>na podstawie:</p>
						<p class="on_wyplacono_szo_ugoda_o">
							<span class="kratka_2 on_wyplacono_szo_ugoda"></span> ugody
						</p>
						<p class="on_wyplacono_szo_wyrok_o">
							<span class="kratka_2 on_wyplacono_szo_wyrok"></span> wyroku
						</p>
						<p class="on_wyplacono_szo_decyzja_zd_o">
							<span class="kratka_2 on_wyplacono_szo_decyzja_zd"></span>
							decyzji z dnia:
						</p>
						<input type="text" name=""
							class="data on_wyplacono_szo_data on_wyplacono_szo_decyzja_zd_o"
							placeholder="Data decyzji" />
						<p class="on_wyplacono_szo_nie_wiem">
							<span class="kratka_2 on_wyplacono_szo_nie_wiem"></span> nie wiem
						</p>
						<div class="clear_b"></div>
					</div>
				</div>

				<div id="zapisz_strone_8" class="zapisz_str_8"
					class=" margin_t_10 zablokowane_pole_transparent">ZAPISZ I PRZEJŹ
					DALEJ</div>
			</div>

			<div class="strona_umowy str_9 mop">

				<p class="pozostale_roszczenia_naglowek_tresc">DOCHODZENIE ROSZCZEŃ</p>
				<div class="pozostale_roszczenia_naglowek_tresc_tresc">
					<div class="zgloszenie_wiersz_elementow">
						<p class="dr_nie_zlecano_innym_o">
							<span class="kratka_2 dr_nie_zlecano_innym"></span> nie zlecono
							wcześniej dochodzenia roszczeń żadnemu podmiotowi
						</p>
						<div class="clear_b"></div>
					</div>
					<div class="zgloszenie_wiersz_elementow  ">
						<p class="dr_zlecono_sprawe_o">
							<span class="kratka_2 dr_zlecono_sprawe"></span> sprawę zlecono
							wcześniej pełnomocnikowi
						</p>
						<input type="text" name=""
							class="dr_zs_nazwa dr_zlecono_sprawe_o_o" placeholder="Nazwa" />
						<p class="dr_zlecono_sprawe_o_o">z którym zawarto umowę dnia</p>
						<input type="text" name=""
							class="data dr_zs_data_umowy dr_zlecono_sprawe_o_o"
							placeholder="Data" />
						<div class="clear_b"></div>
					</div>
					<div class="zgloszenie_wiersz_elementow dr_zlecono_sprawe_o_o ">
						<p>
							<span class="kratka_2 dr_zs_wypowiedziano_umowe_opcja"></span>
							umowę z wyżej wymienionym pełnomocnikiem wypowiedziano
						</p>
						<input type="text" name=""
							class="data dr_zs_wypowiedziano_umowe_data" placeholder="Data" />
						<div class="clear_b"></div>
					</div>

					<!-----------------medyk 12-09-2016------------------>


					<div class="zgloszenie_wiersz_elementow dr_zlecono_votum_o_o">
						<p>Przekazałem pełnomocnikowi Votum S.A. dokumentację składającą
							się z</p>
						<input type="text" name="" class="dr_ile_kart" placeholder="ilosc"
							style="display: block;" />
						<p>kart.</p>
						<div class="clear_b"></div>
						<div class="dr_informacje margin_t_10 margin_b_10">
							<p>Czy klient wyraża zgodę na otrzymywanie informacji związanych
								z wykonywaniem umowy?</p>
							<p class="dr_zgoda_o">
								<span class="kratka_2 dr_zgoda_tak"></span> Tak
							</p>
							<p>
								<span class="kratka_2 dr_zgoda_nie"></span> Nie
							</p>
							<div class="clear_b"></div>
							<div class="dr_rodaj_inf_o">
								<p>
									<span class="kratka_2 dr_sms"></span> wiadomości SMS na podany
									przeze mnie numer
								</p>
								<p>
									<span class="kratka_2 dr_email"></span> wiadomości e-mail na
									podany przeze mnie adres
								</p>
							</div>
						</div>
						<div class="clear_b"></div>
					</div>
					<!--------------------------------------------------->

				</div>

				<div id="zapisz_strone_9" class="zapisz_str_9"
					class=" margin_t_10 zablokowane_pole_transparent">ZAPISZ I PRZEJŹ
					DALEJ</div>
			</div>

			<div class="strona_umowy str_10 mop">

				<p class="inne_odszkodowania_naglowek_tresc">INNE ODSZKODOWANIA</p>
				<div class="inne_odszkodowania_naglowek_tresc_tresc">
					<div class="zgloszenie_wiersz_elementow">
						<p>
							<span class="kratka_2 io_zgloszono_nnw"></span> zgłoszono szkodę
							do ubezpieczyciela NNW
						</p>
						<input type="text" name="" class="io_zgloszono_nnw_nazwa"
							placeholder="Nazwa ubezpieczyciela" />
						<div class="clear_b"></div>
					</div>
					<div class="zgloszenie_wiersz_elementow">
						<p>
							<span class="kratka_2 io_uszczerbek_nnw"></span> ubezpieczyciel
							NNW określił uszczerbek na zdrowiu na
						</p>
						<input type="text" name="" class="io_procent_uszczerbku_nnw"
							placeholder="procent uszczerbku" />
						<div class="clear_b"></div>
					</div>
					<div class="zgloszenie_wiersz_elementow margin_t_20">
						<p>Był to wypadek</p>
						<p class="io_wypadek_przy_pracy_o">
							<span class="kratka_2 io_wypadek_przy_pracy io_wypadek_zgloszono"></span>
							przy pracy
						</p>
						<p class="io_wypadek_w_drodze_do_pracy_o">
							<span class="kratka_2 io_wypadek_w_drodze_do_pracy"></span> w
							drodze do lub z pracy
						</p>
						<div class="clear_b"></div>
					</div>

					<div class="inf_o_szkodzie">
						<div class="zgloszenie_wiersz_elementow">
							<p>zgłoszono szkodę do</p>
							<p class="io_wypadek_zgloszono_zus_o">
								<span class="kratka_2 io_wypadek_zgloszono_zus"></span> ZUS
							</p>
							<p class="io_wypadek_zgloszono_krus_o">
								<span class="kratka_2 io_wypadek_zgloszono_krus"></span> KRUS
							</p>
							<p class="io_wypadek_zgloszono_inne_o ">
								<span class="kratka_2 io_wypadek_zgloszono_inne"></span> inne
							</p>
							<input type="text" name=""
								class="io_wypadek_zgloszono_inne_nazwa" placeholder="Nazwa" />
							<div class="clear_b"></div>
						</div>

						<div class="zgloszenie_wiersz_elementow sekcja_przy_obrazeniach">
							<p>który określił uszczerbek na zdrowiu na</p>
							<input type="text" name="" class="io_procent_uszczerbku"
								placeholder="procent uszczerbku" />
							<div class="clear_b"></div>
						</div>
						<div class="zgloszenie_wiersz_elementow sekcja_przy_obrazeniach">
							<p>
								<span class="kratka_2 jednorazowe_odszkodowanie"></span>
								przyznano jednorazowe odszkodowanie z tytułu wypadku przy pracy
								w wysokości
							</p>
							<input type="text" name="" class="io_kwota_odszkodowania"
								placeholder="kwota odszkodowania" />
							<div class="clear_b"></div>
						</div>
						<div class="zgloszenie_wiersz_elementow sekcja_przy_smierci">
							<p>
								<span class="kratka_2 io_przyznano_zasilek_p"></span> przyznano
								zasiłek pogrzebowy
							</p>
							<div class="clear_b"></div>
						</div>
					</div>


					<div class="zgloszenie_wiersz_elementow sekcja_przy_obrazeniach">
						<p>W związku z wypadkiem stwierdzono niezdolność do pracy na
							podstawie:</p>
						<div class="clear_b"></div>
						<p class="io_zwolnienie_lekarskie ">
							<span class="kratka_2 zwolnienie_lekarskie "></span> zwolnienia
							lekarskiego na okres od <input type="text" name=""
								class="data data_niezdolnosci_od" placeholder="od" /> do <input
								type="text" name="" class="data data_niezdolnosci_do"
								placeholder="do" />
						</p>
						<div class="clear_b"></div>

						<p class="io_niezdolnosc_do_pracy">
							<span class="kratka_2 io_orzeczenie"></span> orzeczenia o
							niezdolności do pracy :
						</p>
						<p class="io_niezdolnosc_do_pracy">
							<span class="kratka_2 io_calkowite"></span> całkowitej
						</p>
						<p class="io_niezdolnosc_do_pracy">
							<span class="kratka_2 io_czesciowe"></span> częściowej
						</p>
						<p class="io_niezdolnosc_do_pracy">
							<span class="kratka_2 io_trwale"></span> trwałej
						</p>
						<p class="io_niezdolnosc_do_pracy">
							<span class="kratka_2 io_okresowe"></span> okresowej
						</p>
						<input type="text" name="" class="io_okresowe_data data"
							placeholder="do dnia" />
						<div class="clear_b"></div>

						<p class="io_niezdolnosc_do_pracy">
							<span class="kratka_2 io_zus"></span> ZUS
						</p>
						<p class="io_niezdolnosc_do_pracy">
							<span class="kratka_2 io_krus"></span> KRUS
						</p>
						<p class="io_niezdolnosc_do_pracy">
							<span class="kratka_2 io_inne"></span> inne
						</p>
						<input type="text" name="" class="io_inne_nazwa"
							placeholder="nazwa" />
						<p class="io_niezdolnosc_do_pracy">
							przyznal <span class="kratka_2 io_renta"></span> rentę
						</p>
						<p>
							<span class="kratka_2 io_inne_swiadczenie"></span> inne
						</p>
						<input type="text" name="" class="io_inne_swiadczenie_nazwa"
							placeholder="nazwa świadczenia" />
						<div class="clear_b"></div>
						<p>w wysokości</p>
						<input type="text" name="" class="io_kwota_swiadczenia"
							placeholder="kwota świadczenia" />
						<p>zł miesięcznie, na okres do</p>
						<input type="text" name="" class="io_okres_swiadczenia data"
							placeholder="do kiedy" />

					</div>



					<!--  /*				<div
						class="zgloszenie_wiersz_elementow zgloszono_szkode margin_t_20">
						<p>Zgłoszono szkodę do</p>
						<p class="io_wypadek_zgloszono_zus_o io_wypadek_zgloszono_o">
							<span class="kratka_2 io_wypadek_zgloszono_zus"></span> ZUS
						</p>
						<p class="io_wypadek_zgloszono_krus_o io_wypadek_zgloszono_o">
							<span class="kratka_2 io_wypadek_zgloszono_krus"></span> KRUS
						</p>
						<p class="io_wypadek_zgloszono_inne_o io_wypadek_zgloszono_o">
							<span class="kratka_2 io_wypadek_zgloszono_inne"></span> inne
						</p>
						<input type="text" name=""
							class="io_wypadek_zgloszono_o io_wypadek_zgloszono_inne_nazwa"
							placeholder="Nazwa" />
						<div class="clear_b"></div>
					</div>
					<div class="zgloszenie_wiersz_elementow margin_t_20">
						<p>
							<span class="kratka_2 io_przyznano_zasilek_p"></span> Przyznano
							zasiłek pogrzebowy
						</p>
						<div class="clear_b"></div>
					</div>  */  -->





					<div class="zgloszenie_wiersz_elementow margin_t_20">
						<p>
							<span class="kratka_2 zsz_pf"></span> Jestem zainteresowany
							ofertą produktów finansowych
						</p>
						<div class="clear_b"></div>
					</div>
					<!-----------------medyk 12-09-2016------------------>

					<div class="zgloszenie_wiersz_elementow io_zgody_o">

						<p>
							<span class="kratka_2 zsz_pcrf"></span>
						
						
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
								<span class="kratka_2 zsz_gamma"></span>
							
							
							<div class="blok">Jestem zainteresowana/y ofertą usług medycznych
								i wyrażam zgodę na przekazywanie „Centrum Medycznemu Gamma” Sp.
								z o.o. w Warszawie moich danych osobowych lub danych osobowych
								małoletniego / ubezwłasnowolnionego / małżonka, którego
								reprezentuję, w tym informacji dotyczących stanu zdrowia, w celu
								opracowania i przedstawienia oferty.</div>
							</p>
						</div>
						<div class="clear_b"></div>

						<div class="zgloszenie_wiersz_elementow ">
							<p>
								<span class="kratka_2 zsz_dzialalnosc"></span>
							
							
							<div class="blok">Oświadczam, że prowadzę pozarolniczą
								działalność gospodarczą.</div>
							</p>
						</div>
					</div>


					<!--------------------------------------------------->

				</div>
				<div class="clear_b"></div>

				<div id="zapisz_strone_10" class="zapisz_str_10"
					class=" margin_t_10 zablokowane_pole_transparent">ZAPISZ I PRZEJDZ
					DALEJ</div>
			</div>

			<!-- medyk 13-09-2016 -->
			<div class="strona_umowa str_11 mop">
				<div class="promedica_optima">

					<p
						class="oswiadzczenie_osoby_poszkodowanej_naglowek_tresc margin_b_10">OŚWIADCZENIE
						OSOBY POSZKODOWANEJ</p>

					<div class="zgloszenie_wiersz_elementow ">
						<p>
                                Ja,
                                <?php echo $poszkodowany['imie'].' '.$poszkodowany['nazwisko']; ?> oświadczam, że jestem świadomy odpowiedzialności karnej za wprowadzenie w błąd ubezpieczyciela w celu osiągnięcia korzyści majątkowej, oświadczam, iż byłem uczestnikiem wypadku komunikacyjnego, który miał miejsce w
                                    <?php echo $zdarzenie['miejsce']; ?>
                                        w dniu
                                        <?php echo $zdarzenie['data']; ?>
                                            około godziny
                                            <?php echo $zdarzenie['godzina']; ?>.
                            </p>
					</div>
					<div class="clear_b"></div>
					<div class="zgloszenie_wiersz_elementow margin_t_10">
						<p>W chwili zdarzenia</p>
						<p class="oz_pod_wplywem_o">
							<span class="kratka_2 oz_pod_wplywem"></span> byłem/-am
						</p>
						<p class="oz_nie_pod_wplywem_o">
							<span class="kratka_2 oz_nie_pod_wplywem"></span> nie byłem/-am
							pod wpływem:
						</p>
						<div class="clear_b"></div>
						<p class="oz_alkohol_o">
							<span class="kratka_2 oz_alkohol"></span> alkoholu
						</p>
						<p class="oz_narkotyki_o">
							<span class="kratka_2 oz_narkotyki"></span> narkotyków
						</p>
						<p class="oz_inne_srodki_o">
							<span class="kratka_2 oz_inne_srodki"></span> innych środków
							odurzających.
						</p>
					</div>
					<div class="clear_b"></div>
					<div class="zgloszenie_wiersz_elementow margin_t_10">
						<p>Poszkodowany znajdował się</p>
						<p class="oz_poza_pojazdem_o">
							<span class="kratka_2 oz_poza_pojazdem"></span> poza pojazdem
						</p>
						<p class="oz_w_pojezdzie_o">
							<span class="kratka_2 oz_w_pojezdzie"></span> w pojeździe.
						</p>
					</div>
					<div class="clear_b"></div>
					<div class="zgloszenie_wiersz_elementow margin_t_10 poza_pojazdem">
						<p>Byłem/-am</p>
						<p class="oz_pieszy_o">
							<span class="kratka_2 oz_pieszy"></span> pieszym/-ą
						</p>
						<p class="oz_rowerzysta_o">
							<span class="kratka_2 oz_rowerzysta"></span> rowerzystą/-ką
						
						
						<div class="clear_b"></div>
                                i zostałem/-am potrącony/-a przez pojazd marki
                                <?php echo $zdarzenie_pojazd_b['marka']; ?> o nr. rej.
                                    <?php echo $zdarzenie_pojazd_b['nr_rejestracyjny']; ?>
                            </p>
					</div>
					<div class="clear_b"></div>
					<div class="zgloszenie_wiersz_elementow margin_t_10 w_pojezdzie">
						<p>Typ pojazdu:</p>
						<p class="oz_samochod_o">
							<span class="kratka_2 oz_samochod"></span> samochód
						</p>
						<p class="oz_komunikacja_o">
							<span class="kratka_2 oz_komunikacja"></span> komunikacja
							zbiorowa
						</p>
						<p class="oz_inne_o">
							<span class="kratka_2 oz_inne"></span> inne
						</p>
						<input type="text" name="" class="oz_inne_nazwa" placeholder="inny pojazd" value="" style="display:<?php echo ($oswiadczenie_poszkodowanego['sprawa_typ_pojazdu_id'] == '3') ? 'block' : 'none' ; ?>;" />
						<div class="clear_b"></div>
						<p>W pojeździe marki
                                <?php echo $zdarzenie_pojazd_a['marka']; ?> o numerze rej.
                                    <?php echo $zdarzenie_pojazd_a['nr_rejestracyjny']; ?> byłem/-am: </p>
						<div class="clear_b"></div>
						<p class="oz_kierowca_o">
							<span class="kratka_2 oz_kierowca"></span> kierowcą
						</p>
						<p class="oz_pasazer_o">
							<span class="kratka_2 oz_pasazer"></span> pasażerem
						</p>
						<div class="clear_b"></div>
						<div class='pozycja_pasazera' style="display: none;">
							<p>siedziałem/-am</p>
							<p class="oz_obok_kierowcy_o">
								<span class="kratka_2 oz_obok_kierowcy"></span> obok kierowcy
							</p>
							<p class="oz_z_tylu_kierowcy_o">
								<span class="kratka_2 oz_z_tylu_kierowcy"></span> z tyłu za
								kierowcą
							</p>
							<p class="oz_za_pasazerem_o">
								<span class="kratka_2 oz_za_pasazerem"></span> z tyłu za
								przednim pasażerem
							</p>
							<p class="oz_posrodku_o">
								<span class="kratka_2 oz_posrodku"></span> z tyłu pośrodku
							</p>
							<div class="clear_b"></div>
							<p class="oz_inne_miejsce_o">
								<span class="kratka_2 oz_inne_miejsce"></span> inne
							</p>
							<input type="text" name="" class="oz_inne_miejsce_nazwa"
								placeholder="inne miejsce" value="" />
						</div>
						<div class="clear_b"></div>
						<p>W chwili zdarzenia</p>
						<p class="oz_byly_pasy_o">
							<span class="kratka_2 oz_byly_pasy"></span> miałem/-am
						</p>
						<p class="oz_bez_pasow_o">
							<span class="kratka_2 oz_bez_pasow"></span> nie miałem/-am
							zapiętych pasów bezpieczeństwa (założony kask).
						</p>
						<div class="clear_b"></div>
						<p class="oz_jestem_posiadaczem_o">
							<span class="kratka_2 oz_jestem_posiadaczem"></span>
						</p>
						<p>Jestem</p>
						<p class="oz_nie_jestem_posiadaczem_o">
							<span class="kratka_2 oz_nie_jestem_posiadaczem"></span>
						</p>
						<p>nie jestem współposiadaczem wyżej wymienionego pojazdu.</p>
					</div>
					<div class="clear_b"></div>
					<div
						class="zgloszenie_wiersz_elementow margin_t_10 o_kierujacym picie_kierowca"
						style="display: none;">
						<p>Wsiadając do pojazdu przed wypadkiem:</p>
						<div class="clear_b"></div>
						<p class="oz_wiedza_o_piciu_o">
							<span class="kratka_2 oz_wiedza_o_piciu"></span> wiedziałem/-am
						</p>
						<p class="oz_brak_wiedzy_o_piciu_o">
							<span class="kratka_2 oz_brak_wiedzy_o_piciu"></span> nie
							wiedziałem/-am,
						
						
						<div class="clear_b"></div>
						że kierujący pojazdem przed zajęciem miejsca za kierownicą
						spożywał alkohol lub inne środki odurzające.
						</p>
						<div class="clear_b"></div>
					</div>
					<div
						class="zgloszenie_wiersz_elementow margin_t_10 o_kierujacym prawko_kierowca"
						style="display: none;">
						<p>Wsiadając do pojazdu przed wypadkiem:</p>
						<div class="clear_b"></div>
						<p class="oz_wiedza_o_prawku_o">
							<span class="kratka_2 oz_wiedza_o_prawku"></span> wiedziałem/-am
						</p>
						<p class="oz_brak_wiedzy_o_prawku_o">
							<span class="kratka_2 oz_brak_wiedzy_o_prawku"></span> nie
							wiedziałem/-am,
						
						
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
							<span class="kratka_2 lecz_koniec"></span> zakończyło się z dniem
						</p>
						<input type="data" name="" class="data lecz_koniec_data"
							placeholder="data zakończenia" value="" style="display: block;" />
						<div class="clear_b"></div>
						<p class="lecz_plan_koniec_o">
							<span class="kratka_2 lecz_plan_koniec"></span> jeszcze się nie
							zakończyło, a przewidywany przez lekarzy termin jego ukończenia
							to
						</p>
						<input type="data" name="" class="data lecz_data_plan_zak"
							placeholder="planowany koniec" value="" style="display: block;" />
						<div class="clear_b"></div>
						<p class="lecz_brak_terminu_o">
							<span class="kratka_2 lecz_brak_terminu"></span> jeszcze się nie
							zakończyło, a przewidywany termin jego ukończenia nie jest mi
							znany,
						</p>
						<div class="clear_b"></div>
						<p class="lecz_zabiegi_o">
							<span class="kratka_2 lecz_zabiegi"></span> planowane są jeszcze
							zabiegi operacyjne.
						</p>
					</div>
					<div class="clear_b"></div>
					<div class="zgloszenie_wiersz_elementow leczenie margin_t_10">
						Jednocześnie informuję, że w związku z doznanymi obrażeniami
						przebywałem na zwolnieniu chorobowym w okresie od dnia
						</p>
						<input type="data" name="" class="data od_kiedy_l4"
							placeholder="od kiedy" value="" style="display: block;" />
						<p class="lecz_na_zwolnieniu_do_o">
							<span class="kratka_2 lecz_na_zwolnieniu_do"></span> do dnia
						</p>
						<input type="data" name="" class="data do_kiedy_l4"
							placeholder="do kiedy" value="" style="display: block;" />
						<p class="lecz_na_zwolnieniu_o">
							<span class="kratka_2 lecz_na_zwolnieniu"></span> nadal przebywam
							na zwolnieniu.
						</p>
					</div>
					<div class="clear_b"></div>
					<p
						class="oswiadzczenie_osoby_poszkodowanej_naglowek_tresc margin_b_10">PRZEBIEG
						LECZENIA (doznane urazy i odczuwane dolegliwości należy opisać w
						OŚWIADCZENIU)</p>
					<div class="zgloszenie_wiersz_elementow przebieg_leczenia">
						<p class="pl_pogotowie_o margin_b_10">
							<span class="kratka_2 pl_pogotowie"></span> na miejsce zdarzenia
							wezwano pogotowie z:
						</p>
						<input type="text" name="" class="szpital"
							placeholder="miejscowość, szpital" value=""
							style="display: block;" />
						<div class="clear_b"></div>

						<div class="przychodnia_blok">
							<p class="pl_przychodnia_o">
								<span class="kratka_2 pl_przychodnia"></span> poszkodowany sam
								zgłosił się do lekarza
							</p>
							<input type="text" name="" class="przychodnia margin_t_10"
								placeholder="dane lekarza, przychodni" value="" />
							<p class="pl_przychodnia_tekst_o margin_t_10"
								style="display: none;">w dniu</p>
							<input type="data" name=""
								class="data przychodnia_data margin_t_10"
								placeholder="data zgłoszenia" value="" />
						</div>
						<div class="clear_b"></div>


						<p class="pl_hospitalizacja_o margin_t_10" data-row="1">
							<span class="kratka_2 pl_hospitalizacja"></span> po wypadku
							poszkodowany był hospitalizowany w
						</p>
						<div class="clear_b"></div>



						<div class='lh leczenie_hospitalizacja_1 element_input' data-row='1'>
							<input type='text' name='' class='hospitalizacja'
								placeholder='miejsce hospitalizacji' value=''
								style='display: block;' /> <input type='data' name=''
								class='data hospitalizacja_data'
								placeholder='data od' value=''
								style='display: block;' />
                            <input type='data' name=''
                                   class='data hospitalizacja_data_do'
                                   placeholder='data do' value=''
                                   style='display: block;' />
                            <span class='dodaj_szpital'
								title='Dodaj szpital' onclick='dodaj_szpital()'
								style='display: block;'></span>
						</div>






						<div class="clear_b"></div>


						<p class="pl_zabiegi_o margin_t_10" data-row="1">
							<span class="kratka_2 pl_zabiegi"></span> przeprowadzone zabiegi
							operacyjne
						</p>
						<div class="clear_b"></div>
						<div class='pz placowki_zabiegi_1 element_input' data-row='1'>
							<input type='text' name='' class='placowka_zabieg'
								placeholder='Adres placówki medycznej, w której leczono poszkodowanego w związku z wypadkiem'
								value='' style='display: block;' /> <input type='data' name=''
								class='data placowka_zabieg_data' placeholder='data zabiegu'
								value='' style='display: block;' /> <span class='dodaj_zabieg'
								title='Usun zabieg' onclick='dodaj_zabieg()'
								style='display: block;'></span>
						</div>





						<div class="clear_b"></div>
					</div>
					<div class="clear_b"></div>
					<div id="zapisz_strone_11b" class="zapisz_str_11"
						class=" margin_t_10 zablokowane_pole_transparent">ZAPISZ I PRZEJDŹ
						DALEJ</div>

				</div>

				<!-- -->



				<div class="maxima_optima">
					<!-- medyk-->
					<p
						class="oswiadzczenie_osoby_uprawnionej_naglowek_tresc margin_b_10">OŚWIADCZENIE
						OSOBY UPRAWNIONEJ</p>



					<div class="zgloszenie_wiersz_elementow zablokowane_pole">
                        <p>Imię i nazwisko osoby uprawnionej:</p>
						<input type="text" name="" class="ou_imie_nazwisko_u"
							placeholder="Imie i nazwisko osoby uprawnionej" value="" />
						<div class="clear_b"></div>
					</div>
					<div class="zgloszenie_wiersz_elementow zablokowane_pole">
                        <p>Imię i nazwisko osoby zmarłej:</p>
						<input type="text" name="" class="ou_imie_nazwisko_zm"
							placeholder="Imie i nazwisko osoby zmarłej" value="" />
						<div class="clear_b"></div>
					</div>
					<div class="zgloszenie_wiersz_elementow zablokowane_pole">
						<p>Data wypadku</p>
						<input type="text" name="" class="data ou_data_wypadku "
							placeholder="Data" value="" />
						<div class="clear_b"></div>
					</div>
					<div class="zgloszenie_wiersz_elementow">
						<p>Po śmierci najbliższego członka rodziny:</p>
						<p>
							<span class="kratka_2 ou_ps_nastapilo_psm"></span>nastapiło
							pogorszenie sytuacji materialnej
						</p>
						<p>
							<span class="kratka_2 ou_ps_w_krzywda zaznaczone"></span>wystapiła
							krzywda
						</p>
						<div class="clear_b"></div>
					</div>

					<p class="informacje_o_zmarlym_naglowek_tresc">INFORMACJE O ZMARŁYM</p>
					<div class="informacje_o_zmarlym_naglowek_tresc_tresc">
						<div class="zgloszenie_wiersz_elementow">
							<p>Wiek w momencie śmierci:</p>
							<input type="text" name="" class="ou_iz_wiek " placeholder="Wiek" />
							<div class="clear_b"></div>
						</div>
						<div class="zgloszenie_wiersz_elementow wyksztalcenie">
							<p>Wykształcenie</p>
							<p class="ou_iz_w_wyzsze_o ou_iz_w_srednie_o ou_iz_w_zawodowe_o">
								<span class="kratka_2 ou_iz_w_podstawowe"></span>podstawowe
							</p>
							<p
								class="ou_iz_w_wyzsze_o ou_iz_w_srednie_o ou_iz_w_podstawowe_o">
								<span class="kratka_2 ou_iz_w_zawodowe"></span>zawodowe
							</p>
							<p
								class="ou_iz_w_wyzsze_o ou_iz_w_zawodowe_o ou_iz_w_podstawowe_o">
								<span class="kratka_2 ou_iz_w_srednie"></span>średnie
							</p>
							<p
								class="ou_iz_w_srednie_o ou_iz_w_zawodowe_o ou_iz_w_podstawowe_o">
								<span class="kratka_2 ou_iz_w_wyzsze"></span>wyższe
							</p>
							<div class="clear_b"></div>
						</div>
						<div class="zgloszenie_wiersz_elementow">
							<input type="text" name="" class="ou_iz_z_wyuczony"
								placeholder="Zawód wyuczony" /> <input type="text" name=""
								class="ou_iz_z_wykonywany" placeholder="Zawód wykonywany" /> <input
								type="text" name="" class="ou_iz_dodatkowe_k"
								placeholder="Dodatkowe kwalifikacje lub uprawnienia" />
							<div class="clear_b"></div>
						</div>
						<div class="zgloszenie_wiersz_elementow">
							<p>Zatrudnienie:</p>
							<p
								class="ou_iz_zat_inne_o ou_iz_zat_pd_o ou_iz_zat_gr_o ou_iz_zat_wdg_o ou_iz_zat_uz_o ou_iz_zat_uop_o">
								<span class="kratka_2 ou_iz_zat_brak"></span>brak
							</p>
							<p
								class="ou_iz_zat_inne_o ou_iz_zat_pd_o ou_iz_zat_gr_o ou_iz_zat_wdg_o ou_iz_zat_uz_o ou_iz_zat_brak_o">
								<span class="kratka_2 ou_iz_zat_uop"></span>umowa o pracę
							</p>
							<p
								class="ou_iz_zat_inne_o ou_iz_zat_pd_o ou_iz_zat_gr_o ou_iz_zat_wdg_o ou_iz_zat_uop_o ou_iz_zat_brak_o">
								<span class="kratka_2 ou_iz_zat_uz"></span>umowa zlecenia
							</p>
							<p
								class="ou_iz_zat_inne_o ou_iz_zat_pd_o ou_iz_zat_gr_o ou_iz_zat_uz_o ou_iz_zat_uop_o ou_iz_zat_brak_o">
								<span class="kratka_2 ou_iz_zat_wdg"></span>własna działalność
								gospodarcza
							</p>
							<p
								class="ou_iz_zat_inne_o ou_iz_zat_pd_o ou_iz_zat_wdg_o ou_iz_zat_uz_o ou_iz_zat_uop_o ou_iz_zat_brak_o">
								<span class="kratka_2 ou_iz_zat_gr"></span>gospodarstwo rolne
							</p>
							<p
								class="ou_iz_zat_inne_o ou_iz_zat_gr_o ou_iz_zat_wdg_o ou_iz_zat_uz_o ou_iz_zat_uop_o ou_iz_zat_brak_o">
								<span class="kratka_2 ou_iz_zat_pd"></span>prace dorywcze
							</p>
							<p
								class="ou_iz_zat_pd_o ou_iz_zat_gr_o ou_iz_zat_wdg_o ou_iz_zat_uz_o ou_iz_zat_uop_o ou_iz_zat_brak_o">
								<span class="kratka_2 ou_iz_zat_inne"></span>inne
							</p>
							<input type="text" name="" class="ou_iz_zat_inne_nazwa "
								placeholder="Rodzaj wykonywanej pracy" />
							<div class="clear_b"></div>
						</div>
						<div class="zgloszenie_wiersz_elementow">
							<input type="text" name="" class=" ou_iz_zat_pensja"
								placeholder="Przeciętna wysokość zarobków z 3 ostatnich mc netto" />
							<div class="clear_b"></div>
						</div>
					</div>

					<p class="informacje_o_uprawnionym_naglowek_tresc margin_b_10">INFORMACJE
						O UPRAWNIONYM</p>
					<div class="informacje_o_uprawnionym_tresc_tresc">
						<div class="zgloszenie_wiersz_elementow text_wiek_smierc">
							<p>Wiek uprawnionego w momencie śmierci:</p>
						</div>
						<div class="zgloszenie_wiersz_elementow">
							<input type="text" name="" class="ou_iu_wiek " placeholder="Wiek" />
							<div class="clear_b"></div>
						</div>
						<div class="zgloszenie_wiersz_elementow">
							<p>Wykształcenie</p>
							<p class="ou_iu_w_wyzsze_o ou_iu_w_srednie_o ou_iu_w_zawodowe_o">
								<span class="kratka_2 ou_iu_w_podstawowe"></span>podstawowe
							</p>
							<p
								class="ou_iu_w_wyzsze_o ou_iu_w_srednie_o ou_iu_w_podstawowe_o">
								<span class="kratka_2 ou_iu_w_zawodowe"></span>zawodowe
							</p>
							<p
								class="ou_iu_w_wyzsze_o ou_iu_w_zawodowe_o ou_iu_w_podstawowe_o">
								<span class="kratka_2 ou_iu_w_srednie"></span>średnie
							</p>
							<p
								class="ou_iu_w_srednie_o ou_iu_w_zawodowe_o ou_iu_w_podstawowe_o">
								<span class="kratka_2 ou_iu_w_wyzsze"></span>wyższe
							</p>
							<div class="clear_b"></div>
						</div>
						<div class="zgloszenie_wiersz_elementow">
							<input type="text" name="" class="ou_iu_z_wyuczony"
								placeholder="Zawód wyuczony" /> <input type="text" name=""
								class="ou_iu_z_wykonywany" placeholder="Zawód wykonywany" /> <input
								type="text" name="" class="ou_iu_dodatkowe_k"
								placeholder="Dodatkowe kwalifikacje lub uprawnienia" />
							<div class="clear_b"></div>
						</div>
						<div class="zgloszenie_wiersz_elementow">
							<p>Zatrudnienie:</p>
							<p
								class="ou_iu_zat_inne_o ou_iu_zat_pd_o ou_iu_zat_gr_o ou_iu_zat_wdg_o ou_iu_zat_uz_o ou_iu_zat_uop_o ">
								<span class="kratka_2 ou_iu_zat_brak"></span>brak
							</p>
							<p
								class="ou_iu_zat_inne_o ou_iu_zat_pd_o ou_iu_zat_gr_o ou_iu_zat_wdg_o ou_iu_zat_uz_o ou_iu_zat_brak_o ">
								<span class="kratka_2 ou_iu_zat_uop"></span>umowa o pracę
							</p>
							<p
								class="ou_iu_zat_inne_o ou_iu_zat_pd_o ou_iu_zat_gr_o ou_iu_zat_wdg_o ou_iu_zat_uop_o ou_iu_zat_brak_o ">
								<span class="kratka_2 ou_iu_zat_uz"></span>umowa zlecenia
							</p>
							<p
								class="ou_iu_zat_inne_o ou_iu_zat_pd_o ou_iu_zat_gr_o ou_iu_zat_uz_o ou_iu_zat_uop_o ou_iu_zat_brak_o ">
								<span class="kratka_2 ou_iu_zat_wdg"></span>własna działalność
								gospodarcza
							</p>
							<p
								class="ou_iu_zat_inne_o ou_iu_zat_pd_o ou_iu_zat_wdg_o ou_iu_zat_uz_o ou_iu_zat_uop_o ou_iu_zat_brak_o ">
								<span class="kratka_2 ou_iu_zat_gr"></span>gospodarstwo rolne
							</p>
							<p
								class="ou_iu_zat_inne_o ou_iu_zat_gr_o ou_iu_zat_wdg_o ou_iu_zat_uz_o ou_iu_zat_uop_o ou_iu_zat_brak_o ">
								<span class="kratka_2 ou_iu_zat_pd"></span>prace dorywcze
							</p>
							<p
								class="ou_iu_zat_pd_o ou_iu_zat_gr_o ou_iu_zat_wdg_o ou_iu_zat_uz_o ou_iu_zat_uop_o ou_iu_zat_brak_o ">
								<span class="kratka_2 ou_iu_zat_inne"></span>inne
							</p>
							<input type="text" name="" class="ou_iu_zat_inne_nazwa "
								placeholder="Rodzaj wykonywanej pracy" />
							<div class="clear_b"></div>
						</div>
						<div class="zgloszenie_wiersz_elementow">
							<input type="text" name="" class="ou_iu_zat_pensja "
								placeholder="Przeciętna wysokość zarobków z 3 ostatnich mc netto" />
							<div class="clear_b"></div>
						</div>
					</div>
					<p class="stosunki_rodzinne_majatkowe_naglowek_tresc">STOSUNKI
						RODZINNE I MAJĄTKOWE</p>
					<div class="stosunki_rodzinne_majatkowe_naglowek_tresc_tresc">
						<div class="zgloszenie_wiersz_elementow">
							<p>Zmarły był dla uprawnionego:</p>
							<p
								class="ou_srm_zdu_m_o ou_srm_zdu_pk_o ou_srm_zdu_pm_o ou_srm_zdu_ma_o ou_srm_zdu_o_o ou_srm_zdu_c_o ou_srm_zdu_s_o ou_srm_zdu_si_o ou_srm_zdu_b_o ou_srm_zdu_wk_o ou_srm_zdu_wm_o ou_srm_zdu_dz_o ou_srm_zdu_ba_o ou_srm_zdu_inne_o">
								<span class="kratka_2 ou_srm_zdu_z"></span>żoną
							</p>
							<p
								class="ou_srm_zdu_z_o  ou_srm_zdu_pk_o ou_srm_zdu_pm_o ou_srm_zdu_ma_o ou_srm_zdu_o_o ou_srm_zdu_c_o ou_srm_zdu_s_o ou_srm_zdu_si_o ou_srm_zdu_b_o ou_srm_zdu_wk_o ou_srm_zdu_wm_o ou_srm_zdu_dz_o ou_srm_zdu_ba_o ou_srm_zdu_inne_o">
								<span class="kratka_2 ou_srm_zdu_m"></span>mężem
							</p>
							<p
								class="ou_srm_zdu_z_o ou_srm_zdu_m_o  ou_srm_zdu_pm_o ou_srm_zdu_ma_o ou_srm_zdu_o_o ou_srm_zdu_c_o ou_srm_zdu_s_o ou_srm_zdu_si_o ou_srm_zdu_b_o ou_srm_zdu_wk_o ou_srm_zdu_wm_o ou_srm_zdu_dz_o ou_srm_zdu_ba_o ou_srm_zdu_inne_o">
								<span class="kratka_2 ou_srm_zdu_pk"></span>partnerką
							</p>
							<p
								class="ou_srm_zdu_z_o ou_srm_zdu_m_o ou_srm_zdu_pk_o  ou_srm_zdu_ma_o ou_srm_zdu_o_o ou_srm_zdu_c_o ou_srm_zdu_s_o ou_srm_zdu_si_o ou_srm_zdu_b_o ou_srm_zdu_wk_o ou_srm_zdu_wm_o ou_srm_zdu_dz_o ou_srm_zdu_ba_o ou_srm_zdu_inne_o">
								<span class="kratka_2 ou_srm_zdu_pm"></span>partnerem
							</p>
							<p
								class="ou_srm_zdu_z_o ou_srm_zdu_m_o ou_srm_zdu_pk_o ou_srm_zdu_pm_o  ou_srm_zdu_o_o ou_srm_zdu_c_o ou_srm_zdu_s_o ou_srm_zdu_si_o ou_srm_zdu_b_o ou_srm_zdu_wk_o ou_srm_zdu_wm_o ou_srm_zdu_dz_o ou_srm_zdu_ba_o ou_srm_zdu_inne_o">
								<span class="kratka_2 ou_srm_zdu_ma"></span>matką
							</p>
							<p
								class="ou_srm_zdu_z_o ou_srm_zdu_m_o ou_srm_zdu_pk_o ou_srm_zdu_pm_o ou_srm_zdu_ma_o  ou_srm_zdu_c_o ou_srm_zdu_s_o ou_srm_zdu_si_o ou_srm_zdu_b_o ou_srm_zdu_wk_o ou_srm_zdu_wm_o ou_srm_zdu_dz_o ou_srm_zdu_ba_o ou_srm_zdu_inne_o">
								<span class="kratka_2 ou_srm_zdu_o"></span>ojcem
							</p>
							<p
								class="ou_srm_zdu_z_o ou_srm_zdu_m_o ou_srm_zdu_pk_o ou_srm_zdu_pm_o ou_srm_zdu_ma_o ou_srm_zdu_o_o  ou_srm_zdu_s_o ou_srm_zdu_si_o ou_srm_zdu_b_o ou_srm_zdu_wk_o ou_srm_zdu_wm_o ou_srm_zdu_dz_o ou_srm_zdu_ba_o ou_srm_zdu_inne_o">
								<span class="kratka_2 ou_srm_zdu_c"></span>córką
							</p>
							<p
								class="ou_srm_zdu_z_o ou_srm_zdu_m_o ou_srm_zdu_pk_o ou_srm_zdu_pm_o ou_srm_zdu_ma_o ou_srm_zdu_o_o ou_srm_zdu_c_o  ou_srm_zdu_si_o ou_srm_zdu_b_o ou_srm_zdu_wk_o ou_srm_zdu_wm_o ou_srm_zdu_dz_o ou_srm_zdu_ba_o ou_srm_zdu_inne_o">
								<span class="kratka_2 ou_srm_zdu_s"></span>synem
							</p>
							<p
								class="ou_srm_zdu_z_o ou_srm_zdu_m_o ou_srm_zdu_pk_o ou_srm_zdu_pm_o ou_srm_zdu_ma_o ou_srm_zdu_o_o ou_srm_zdu_c_o ou_srm_zdu_s_o  ou_srm_zdu_b_o ou_srm_zdu_wk_o ou_srm_zdu_wm_o ou_srm_zdu_dz_o ou_srm_zdu_ba_o ou_srm_zdu_inne_o">
								<span class="kratka_2 ou_srm_zdu_si"></span>siostrą
							</p>
							<p
								class="ou_srm_zdu_z_o ou_srm_zdu_m_o ou_srm_zdu_pk_o ou_srm_zdu_pm_o ou_srm_zdu_ma_o ou_srm_zdu_o_o ou_srm_zdu_c_o ou_srm_zdu_s_o ou_srm_zdu_si_o  ou_srm_zdu_wk_o ou_srm_zdu_wm_o ou_srm_zdu_dz_o ou_srm_zdu_ba_o ou_srm_zdu_inne_o">
								<span class="kratka_2 ou_srm_zdu_b"></span>bratem
							</p>
							<p
								class="ou_srm_zdu_z_o ou_srm_zdu_m_o ou_srm_zdu_pk_o ou_srm_zdu_pm_o ou_srm_zdu_ma_o ou_srm_zdu_o_o ou_srm_zdu_c_o ou_srm_zdu_s_o ou_srm_zdu_si_o ou_srm_zdu_b_o  ou_srm_zdu_wm_o ou_srm_zdu_dz_o ou_srm_zdu_ba_o ou_srm_zdu_inne_o">
								<span class="kratka_2 ou_srm_zdu_wk"></span>wnuczką
							</p>
							<p
								class="ou_srm_zdu_z_o ou_srm_zdu_m_o ou_srm_zdu_pk_o ou_srm_zdu_pm_o ou_srm_zdu_ma_o ou_srm_zdu_o_o ou_srm_zdu_c_o ou_srm_zdu_s_o ou_srm_zdu_si_o ou_srm_zdu_b_o ou_srm_zdu_wk_o  ou_srm_zdu_dz_o ou_srm_zdu_ba_o ou_srm_zdu_inne_o">
								<span class="kratka_2 ou_srm_zdu_wm"></span>wnukiem
							</p>
							<p
								class="ou_srm_zdu_z_o ou_srm_zdu_m_o ou_srm_zdu_pk_o ou_srm_zdu_pm_o ou_srm_zdu_ma_o ou_srm_zdu_o_o ou_srm_zdu_c_o ou_srm_zdu_s_o ou_srm_zdu_si_o ou_srm_zdu_b_o ou_srm_zdu_wk_o ou_srm_zdu_wm_o  ou_srm_zdu_ba_o ou_srm_zdu_inne_o">
								<span class="kratka_2 ou_srm_zdu_dz"></span>dziadkiem
							</p>
							<p
								class="ou_srm_zdu_z_o ou_srm_zdu_m_o ou_srm_zdu_pk_o ou_srm_zdu_pm_o ou_srm_zdu_ma_o ou_srm_zdu_o_o ou_srm_zdu_c_o ou_srm_zdu_s_o ou_srm_zdu_si_o ou_srm_zdu_b_o ou_srm_zdu_wk_o ou_srm_zdu_wm_o ou_srm_zdu_dz_o  ou_srm_zdu_inne_o">
								<span class="kratka_2 ou_srm_zdu_ba"></span>babcią
							</p>
							<p
								class="ou_srm_zdu_z_o ou_srm_zdu_m_o ou_srm_zdu_pk_o ou_srm_zdu_pm_o ou_srm_zdu_ma_o ou_srm_zdu_o_o ou_srm_zdu_c_o ou_srm_zdu_s_o ou_srm_zdu_si_o ou_srm_zdu_b_o ou_srm_zdu_wk_o ou_srm_zdu_wm_o ou_srm_zdu_dz_o ou_srm_zdu_ba_o ">
								<span class="kratka_2 ou_srm_zdu_inne"></span>inne
							</p>
							<input type="text" name="" class=" ou_srm_zdu_inne_rodzaj"
								placeholder="Rodzaj więzi" />
							<div class="clear_b"></div>
						</div>
						<div class="zgloszenie_wiersz_elementow">
							<p>Zmarły:</p>
							<div class="clear_b"></div>
						</div>
						<div class="zgloszenie_wiersz_elementow">
							<p>
								<span class="kratka_2 ou_srm_pzuwg"></span>pozostawał z
								uprawnionym we wspólnym gospodarstwie
							</p>
							<p>
								<span class="kratka_2 ou_srm_bzptsacu"></span>był zameldowany
								pod tym samym adresem co uprawniony
							</p>
							<p>
								<span class="kratka_2 ou_srm_nbzptsacu_amr"></span>nie był
								zameldowany pod tym samym adresem co uprawniony, ale mieszkali
								razem
							</p>
							<p class="ou_srm_pwo_o">
								<span class="kratka_2 ou_srm_pwo"></span>pomagał w biezących
								obowiązkach
							</p>
							<p class="ou_srm_npwo_o">
								<span class="kratka_2 ou_srm_npwo"></span>nie pomagał w
								biezących obowiązkach
							</p>
							<div class="clear_b"></div>
						</div>
						<div class="zgloszenie_wiersz_elementow">
							<p>Uprawniony określa stosunki ze zmarłym jako:</p>
							<p class="ou_sudz_zle_o ou_sudz_p_o ou_sudz_z_o">
								<span class="kratka_2 ou_sudz_bz"></span>bardzo zażyłe
							</p>
							<p class="ou_sudz_zle_o ou_sudz_p_o ou_sudz_bz_o">
								<span class="kratka_2 ou_sudz_z"></span>zażyłe
							</p>
							<p class="ou_sudz_zle_o ou_sudz_z_o ou_sudz_bz_o">
								<span class="kratka_2 ou_sudz_p"></span>powierzchowne
							</p>
							<p class="ou_sudz_p_o ou_sudz_z_o ou_sudz_bz_o">
								<span class="kratka_2 ou_sudz_zle"></span>złe
							</p>
							<div class="clear_b"></div>
						</div>
						<div class="zgloszenie_wiersz_elementow">
							<p>Zmarły:</p>
							<div class="clear_b"></div>
						</div>
						<div class="zgloszenie_wiersz_elementow">
							<p class="ou_sbnu_utrz_o">
								<span class="kratka_2 ou_sbnu_utrz"></span>był na moim
								utrzymaniu
							</p>
							<p class="ou_sbnu_lnmu_o">
								<span class="kratka_2 ou_sbnu_lnmu"></span>łożył na moje
								utrzymanie
							</p>
							<p>
								<span class="kratka_2 ou_sbnu_pwk"></span>posiadał z uprawnionym
								wspólne konto
							</p>
							<p>
								<span class="kratka_2 ou_sbnu_pkur"></span>partycypował koszty
								utrzymania rodziny
							</p>
							<p>
								<span class="kratka_2 ou_sbnu_wfwp"></span>wspierałby
								uprawnionego finansowo w przyszłości
							</p>
							<div class="clear_b"></div>
						</div>
					</div>
					<p class="sytuacja_po_smierci_naglowek_tresc">SYTUACJA PO ŚMIERCI
						CZŁONKA NAJBLIŻSZEJ RODZINY</p>
					<div class="sytuacja_po_smierci_naglowek_tresc_tresc">
						<div class="zgloszenie_wiersz_elementow">
							<p>Po śmierci członka rodziny sytuacja materialna uprawnionego:</p>
							<div class="clear_b"></div>
						</div>
						<div class="zgloszenie_wiersz_elementow">
							<p class="ou_spscnr_sm_nuz_o">
								<span class="kratka_2 ou_spscnr_sm_nuz"></span>nie uległa
								zmianie
							</p>
							<p class="ou_spscnr_sm_psn_o">
								<span class="kratka_2 ou_spscnr_sm_psn"></span>pogorszyła się
								nieznacznie
							</p>
							<p class="ou_spscnr_sm_psz_o">
								<span class="kratka_2 ou_spscnr_sm_psz"></span>pogorszyła sie
								znacznie
							</p>
							<div class="clear_b"></div>
						</div>
						<div class="zgloszenie_wiersz_elementow">
							<p>Motywacja uprawnionego do poprawy sytuacji materialnej</p>
							<div class="clear_b"></div>
						</div>
						<div class="zgloszenie_wiersz_elementow">
							<p class="ou_spscnr_mo_nuz_o">
								<span class="kratka_2 ou_spscnr_mo_nuz"></span>nie uległa
								zmianie
							</p>
							<p class="ou_spscnr_mo_psn_o">
								<span class="kratka_2 ou_spscnr_mo_psn"></span>poprawiła się
							</p>
							<p class="ou_spscnr_mo_psz_o">
								<span class="kratka_2 ou_spscnr_mo_psz"></span>pogorszyła się
							</p>
							<div class="clear_b"></div>
						</div>
						<div class="zgloszenie_wiersz_elementow">
							<p>Po śmierci członka rodziny uprawniony</p>
							<p class="ou_spscnr_wstrzas_o_o">
								<span class="kratka_2 ou_spscnr_wstrzas_o"></span>odczuł
							</p>
							<p class="ou_spscnr_wstrzas_no_o">
								<span class="kratka_2 ou_spscnr_wstrzas_no"></span>nie odczuł
							</p>
							<p>&nbsp; znaczącego wstrząsu psychicznego.</p>
							<div class="clear_b"></div>
						</div>
						<div class="zgloszenie_wiersz_elementow">
							<p>
								<span class="kratka_2 ou_spscnr_snp"></span>uprawniony korzysta
								z środków farmakologicznych w związku ze złym stanem psychicznym
							</p>
							<p>
								<span class="kratka_2 ou_spscnr_szps"></span>stan zdrowia
								uprawnionego uległ pogorszeniu
							</p>
							<div class="clear_b"></div>
						</div>
						<div class="zgloszenie_wiersz_elementow">
							<p>Uprawniony korzysta z porad/wsparcia:</p>
							<p>
								<span class="kratka_2 ou_spscnr_uk_psychiatra"></span>psychiatry
							</p>
							<p>
								<span class="kratka_2 ou_spscnr_uk_psycholog"></span>psychologa
							</p>
							<p>
								<span class="kratka_2 ou_spscnr_uk_pedszk"></span>pedagoga
								szkolnego
							</p>
							<p>
								<span class="kratka_2 ou_spscnr_uk_lpk"></span>lekarza
								pierwszego kontaktu
							</p>
							<p>
								<span class="kratka_2 ou_spscnr_uk_duch"></span>duchownego
							</p>
							<p>
								<span class="kratka_2 ou_spscnr_uk_rodz"></span>rodziny
							</p>
							<div class="clear_b"></div>
						</div>
						<div class="zgloszenie_wiersz_elementow">
							<p>Zmarły pozostawił po sobie:</p>
							<p class="ou_spscnr_zps_wk_o">
								<span class="kratka_2 ou_spscnr_zps_wk"></span>wdowę
							</p>
							<p class="ou_spscnr_zps_wm_o">
								<span class="kratka_2 ou_spscnr_zps_wm"></span>wdowca
							</p>
							<p>
								<span class="kratka_2 ou_spscnr_zps_dz"></span>dzieci
							</p>
							<input type="text" name="" class="ou_spscnr_zps_dz_l "
								placeholder="liczba" /> <input type="text" name=""
								class="ou_spscnr_zps_dz_w " placeholder="wiek dzieci oddziel średnikiem ';'" />
							<div class="clear_b"></div>
						</div>
					</div>

					<div id="zapisz_strone_11a" class="zapisz_str_11"
						class=" margin_t_10 zablokowane_pole_transparent">ZAPISZ I PRZEJDŹ
						DALEJ</div>
				</div>
			</div>



			<div class="strona_umowy str_12 mop">
				<div class="dane_do_oswiadczenia">
					<p>DANE DO OŚWIADCZENIA</p>
					<input type="text" name="" class="ddo_imie margin_r_20 margin_t_10"
						placeholder="Imię" /> <input type="text" name=""
						class="ddo_nazwisko " placeholder="Nazwisko" />
					<div class="clear_b"></div>
					<input type="text" name=""
						class="ddo_ulica margin_r_20 margin_t_10" placeholder="Ulica" /> <input
						type="text" name="" class="ddo_nr_domu margin_r_10 margin_t_10"
						placeholder="Nr domu" /> <input type="text" name=""
						class="ddo_nr_mieszkania margin_r_10 margin_t_10"
						placeholder="Nr mieszkania" />
					<div
						class="zleceniodawca_formularz_kod_pocztowy zleceniodawca_formularz_element margin_t_10 formularz_ddo_kod">
						<input maxlength="6" size="6" placeholder="Kod pocztowy" name=""
							type="text" class="ddo_kod_pocztowy"
							onkeyup="sprawdz_kod_pocztowy(this);">
					</div>

					<!-- <input type="text" name="" class="ddo_kod_pocztowy margin_t_10" placeholder="Kod pocztowy" onkeyup="sprawdz_kod_pocztowy(this);" />  -->
					<div class="clear_b"></div>
					<input type="text" name=""
						class="ddo_miejscowosc margin_t_10 margin_r_20"
						placeholder="Miejscowość" />
					<div class="clear_b"></div>
				</div>
				<p class="oswiadczenie_naglowek_tresc margin_b_10">OŚWIADCZENIE
					TREŚĆ</p>
				<div class="oswiadczenie_naglowek_tresc_tresc">
					<div class="opis_zdarzenia_pole ">
						<textarea placeholder="Wprowadź dane..." type="text"
							class="zsz_oswiadczenie_tresc"></textarea>
					</div>
				</div>
                <div class="element_input">
                    <input type="text" name=""
                        class="ddo_miejscowosc_generowania margin_b_10 margin_r_20"
                        placeholder="Miejscowość" /> <input type="text" name=""
                        class="data ddo_data margin_b_10" placeholder="Data" />
                </div>
				<div class="clear_b"></div>
				<div id="zapisz_strone_12"
					class="zapisz_str_12 generuj_zgloszenie_pdf"
					class=" margin_t_10 zablokowane_pole_transparent">ZAPISZ DANE I
					PRZEJDZ DO WYBORU UMOWY</div>
			</div>


			<div class="strona_umowy str_13 mop">
				<p class="wybor_umowy_tresc margin_b_10">WYBIERZ TYP UMOWY</p>
				<div class="wybor_umowy_tresc_tresc">

					<div class="zgloszenie_wiersz_elementow wybor_umowy">
                        <div class="maxima_pu">
						<p class="umowa_maxima">
							<span class="kratka_2 maxima"></span>MAXIMA
						</p>
						<input type="number" name="" class="prowizja_maxima" placeholder="Prowizja w %" value="35" min="15"
                               max="35"/>
                        </div>
                        <div class="promedica_pu">
						<p class="umowa_promedica">
							<span class="kratka_2 promedica"></span>PROMEDICA
						</p>
						<input type="number" name="" class="prowizja_promedica" min="25"
							max="35" placeholder="Prowizja w %" value="35" />
                        </div>
                        <div class="optima_pu">
						<p class="umowa_optima">
							<span class="kratka_2 optima"></span>OPTIMA
						</p>
						<input type="number" name="" class="prowizja_optima" min="25"
							max="35" placeholder="Prowizja w %" value="35" />
                        </div>
                        <div class="prima_pu">
                            <p class="umowa_prima">
                                <span class="kratka_2 prima"></span>PRIMA
                            </p>
                            <input type="number" name="" class="prowizja_prima" min="25"
                                   max="35" placeholder="Prowizja w %" value="35" />
                        </div>
						<div class="clear_b"></div>
					</div>

				</div>







				<div id="zapisz_strone_13" class="zapisz_str_13"
					class=" margin_t_10 zablokowane_pole_transparent">PRZEJDŻ DO
					UZUPEŁNIANIA UMOWY</div>
			</div>

			<div class="strona_umowy str_14 mop">
				<p class="sposob_platnosci_tresc ">WYBIERZ SPOSÓB PŁATNOŚCI</p>
				<div class="sposob_platnosci_tresc_tresc">
					<div class="wynagrodzenie ">
						<div class="zgloszenie_wiersz_elementow wybor_umowy">
							<p>
								<span class="kratka_2 przekaz_pocztowy"></span>przekaz pocztowy
							</p>
							<p>
								<span class="kratka_2 przelew_bankowy"></span>przelew bankowy
							</p>
							<div class="clear_b"></div>
						</div>
						<div class="wynagrodzenie_przelew ">
							<div class="kopiuj_adres_zleceniodawcy">
								<p>
									<span class="kratka_2 zleceniodawca_odbiorca"></span>Odbiorcą
									wynagrodzenia jest Zleceniodawca
								</p>
							</div>
							<div
								class="zleceniodawca_formularz_numer_rachunku_bankowego zleceniodawca_formularz_element margin_t_10">
                                <select id="rodzaj_rachunku">
                                    <option value="pl" selected>PL</option>
                                    <option value="inny">Inny</option>
                                </select>
								<input maxlength="32" size="32"
									placeholder="Nr rachunku bankowego" type="text"
									class="wynagrodzenie_nr_rachunku_bankowego_u nr_rachunku_bankowego"
									onkeyup="" />
							</div>
							<div
								class="zleceniodawca_formularz_imie wynagrodzenie_imie  zleceniodawca_formularz_element margin_r_20 margin_t_10">
								<input placeholder="Imię" type="text"
									class="wynagrodzenie_zleceniodawca_imie imie imie_przelew_u"
									tab="1" />
							</div>
							<div
								class="zleceniodawca_formularz_nazwisko wynagrodzenie_nazwisko  zleceniodawca_formularz_element margin_t_10">
								<input placeholder="Nazwisko" type="text"
									class="wynagrodzenie_zleceniodawca_nazwisko nazwisko nazwisko_przelew_u"
									tab="2" />
							</div>
							<div class="clear_b"></div>
							<div
								class="zleceniodawca_formularz_ulica wynagrodzenie_ulica  zleceniodawca_formularz_element margin_r_20 margin_t_10">
								<input placeholder="Ulica" type="text"
									class="wynagrodzenie_zleceniodawca_ulica ulica ulica_przelew_u"
									tab="3" />
							</div>
							<div
								class="zleceniodawca_formularz_nr_domu wynagrodzenie_dom  zleceniodawca_formularz_element margin_r_10 margin_t_10">
								<input maxlength="12" size="12" placeholder="Nr domu"
									type="text"
									class="wynagrodzenie_zleceniodawca_nr_domu dom_przelew_u" tab="4" />
							</div>
							<div
								class="zleceniodawca_formularz_nr_mieszkania wynagrodzenie_mieszkanie  zleceniodawca_formularz_element margin_r_10 margin_t_10">
								<input maxlength="15" size="15" placeholder="Nr mieszkania"
									type="text"
									class="wynagrodzenie_zleceniodawca_nr_mieszkania mieszkanie_przelew_u"
									tab="5" />
							</div>
							<div
								class="zleceniodawca_formularz_kod_pocztowy wynagrodzenie_kod  zleceniodawca_formularz_element margin_t_10 margin_r_20">
								<input maxlength="6" size="6" placeholder="Kod pocztowy"
									type="text"
									class="wynagrodzenie_zleceniodawca_kod_pocztowy kod_pocztowy kod_przelew_u"
									tab="6" onkeyup="sprawdz_kod_pocztowy(this);" />
							</div>
							<div
								class="zleceniodawca_formularz_miejscowosc wynagrodzenie_miejscowosc  zleceniodawca_formularz_element margin_r_20 margin_t_10">
								<input placeholder="Miejscowość" type="text"
									class="wynagrodzenie_zleceniodawca_miejscowosc miejscowosc_przelew_u"
									tab="7" />
							</div>
						</div>

						<div class="wynagrodzenie_przekaz margin_t_10">
							<div class="kopiuj_adres_zleceniodawcy">
								<p>
									<span
										class="kratka_2 zleceniodawca_odbiorca odbiorca_wynagrodzenia_zleceniodawca"></span>Odbiorcą
									wynagrodzenia jest Zleceniodawca
								</p>
							</div>
							<div class="clear_b"></div>
							<div
								class="zleceniodawca_formularz_imie wynagrodzenie_imie  zleceniodawca_formularz_element margin_r_20 margin_t_10">
								<input placeholder="Imię" type="text"
									class="wynagrodzenie_zleceniodawca_imie imie imie_przekaz_u"
									tab="1" />
							</div>
							<div
								class="zleceniodawca_formularz_nazwisko wynagrodzenie_nazwisko  zleceniodawca_formularz_element margin_t_10">
								<input placeholder="Nazwisko" type="text"
									class="wynagrodzenie_zleceniodawca_nazwisko nazwisko nazwisko_przekaz_u"
									tab="2" />
							</div>
							<div class="clear_b"></div>
							<div
								class="zleceniodawca_formularz_ulica wynagrodzenie_ulica  zleceniodawca_formularz_element margin_r_20 margin_t_10">
								<input placeholder="Ulica" type="text"
									class="wynagrodzenie_zleceniodawca_ulica ulica_przekaz_u" tab="3" />
							</div>
							<div
								class="zleceniodawca_formularz_nr_domu wynagrodzenie_dom  zleceniodawca_formularz_element margin_r_10 margin_t_10">
								<input maxlength="12" size="12" placeholder="Nr domu"
									type="text"
									class="wynagrodzenie_zleceniodawca_nr_domu dom_przekaz_u" tab="4" />
							</div>
							<div
								class="zleceniodawca_formularz_nr_mieszkania wynagrodzenie_mieszkanie  zleceniodawca_formularz_element margin_r_10 margin_t_10">
								<input maxlength="15" size="15" placeholder="Nr mieszkania"
									type="text"
									class="wynagrodzenie_zleceniodawca_nr_mieszkania mieszkanie_przekaz_u"
									tab="5" />
							</div>
							<div
								class="zleceniodawca_formularz_kod_pocztowy wynagrodzenie_kod  zleceniodawca_formularz_element margin_t_10 margin_r_20">
								<input maxlength="6" size="6" placeholder="Kod pocztowy"
									type="text"
									class="wynagrodzenie_zleceniodawca_kod_pocztowy kod_pocztowy kod_przekaz_u"
									tab="6" onkeyup="sprawdz_kod_pocztowy(this);" />
							</div>
							<div
								class="zleceniodawca_formularz_miejscowosc wynagrodzenie_miejscowosc  zleceniodawca_formularz_element margin_r_20 margin_t_10">
								<input placeholder="Miejscowość" type="text"
									class="wynagrodzenie_zleceniodawca_miejscowosc miejscowosc_przekaz_u"
									tab="7" />
							</div>
						</div>

						<div class="clear_b"></div>
					</div>
				</div>

				<div id="zapisz_strone_14" class="zapisz_str_14 generuj_umowe_pdf"
					class=" margin_t_10 zablokowane_pole_transparent">ZAPISZ I PRZEJDŻ
					DALEJ</div>
			</div>


		</div>

	</div>
</div>
</div>