<?php
require_once ($_SERVER ['DOCUMENT_ROOT'] . '/czy_zalogowany.php');

require_once ($_SERVER ['DOCUMENT_ROOT'] . 'moduly/sprawy/db/funkcje_db.php');

$lista_umow = pobierz_liste_umow ();

?>

<div class="zakladki"></div>
<div class="clear_b"></div>
<div id="zakladki_tresc">
	<div class="tabelka">
		<div
			class="tabelka_naglowek tabelka_wiersz zablokowane_pole_transparent">
			<p class="tabelka_id">ID</p>
			<p class="tabelka_imie_nazwisko">Imię i nazwisko klienta</p>
			<p class="tabelka_rodzaj_umowy">Rodzaj umowy</p>
			<p class="tabelka_typ_szkody">Typ szkody</p>
			<p class="tabelka_opcje"></p>
			<div class="clear_b"></div>
		</div>
                    <?php
																				
																				while ( $wiersz = mysqli_fetch_assoc ( $lista_umow ) ) {
																					echo '<div class="tabelka_wiersz">';
																					echo '<p class="tabelka_id zablokowane_pole_transparent" id="umowa_z_listy" data-id_dokumentu="' . $wiersz ['id'] . '" data-typ_szkody="' . $wiersz ['sprawa_typ_szkody_id'] . '">' . $wiersz ['id'] . '</p>';
																					echo '<p class="tabelka_imie_nazwisko zablokowane_pole_transparent">' . $wiersz ['imie'] . ' ' . $wiersz ['nazwisko'] . '</p>';
																					echo '<p class="tabelka_rodzaj_umowy zablokowane_pole_transparent">' . $wiersz ['nazwa'] . '</p>';
																					echo '<p class="tabelka_typ_szkody zablokowane_pole_transparent">' . $wiersz ['wartosc'] . '</p>';
																					echo '<p class="tabelka_opcje">';
																					echo '<span class=" usun usun_umowa" data-id_dokumentu="' . $wiersz ['id'] . '" data-id_typ_szkody="' . $wiersz ['sprawa_typ_szkody_id'] . '"></span>';
																					echo '<span class=" edytuj edytuj_umowa" data-strona="' . $wiersz ['ostatnia_edytowana_strona'] . '" data-id_dokumentu="' . $wiersz ['id'] . '" data-id_typ_szkody="' . $wiersz ['sprawa_typ_szkody_id'] . '"></span>';
																					echo '<span class=" rozwin" title="Rozwiń"></span>';
																					echo '</p>';
																					echo '<div class="clear_b"></div>';
																					echo '<div class="tabelka_wiersz_lista_dokumentow">';
																					if ($wiersz ['sprawa_typ_szkody_id'] != 3) {
																						echo '<div class="twld_kreska_e">Druk zgłoszenia szkody';
																						echo '<div class="twld_kreska_e_opcje">';
																						echo '<span class="generuj generuj_druk_zgloszenia_szkody generuj_zgloszenie_pdf" data-potwierdzenie="0" data-id_sprawy="' . $wiersz ['id'] . '"></span>';
																						echo '</div>';
																						echo '</div>';
																						
																						echo '<div class="twld_kreska_e">Potwierdzenie druk zgłoszenia szkody';
																						echo '<div class="twld_kreska_e_opcje">';
																						echo '<span class="generuj generuj_zgloszenie_pdf" data-potwierdzenie="1" data-id_sprawy="' . $wiersz ['id'] . '"></span>';
																						echo '</div>';
																						echo '</div>';
																					}
																					if (! empty ( $wiersz ['sprawa_umowa_id'] )) {
																						echo '<div class="twld_kreska_e">Umowa - ' . ucfirst ( $wiersz ['nazwa'] );
																						echo '<div class="twld_kreska_e_opcje">';
																						echo '<span class="generuj generuj_umowe generuj_umowe_pdf" data-potwierdzenie="0" data-id_sprawy="' . $wiersz ['id'] . '" data-id_umowa="' . $wiersz ['sprawa_umowa_id'] . '" data-id_uprawniony="' . $wiersz ['sprawa_uprawniony_id'] . '" data-id_sprawa="' . $wiersz ['id'] . '"></span>';
																						echo '</div>';
																						echo '</div>';
																						echo '<div class="twld_kreska_e">Potwierdzenie umowa - ' . ucfirst ( $wiersz ['nazwa'] );
																						echo '<div class="twld_kreska_e_opcje">';
																						echo '<span class="generuj  generuj_umowe_pdf" data-potwierdzenie="1" data-id_sprawy="' . $wiersz ['id'] . '" data-id_umowa="' . $wiersz ['sprawa_umowa_id'] . '" data-id_uprawniony="' . $wiersz ['sprawa_uprawniony_id'] . '" data-id_sprawa="' . $wiersz ['id'] . '"></span>';
																						echo '</div>';
																						echo '</div>';
																						echo '<div class="twld_kreska_e">Pouczenie o prawie do odstąpienia od umowy';
																						echo '<div class="twld_kreska_e_opcje">';
																						echo '<span class="generuj  generuj_pouczenie_o_prawie_odstapienia_od_umowy_pdf" data-id_sprawy="' . $wiersz ['id'] . '"></span>';
																						echo '</div>';
																						echo '</div>';
																						if ($wiersz ['sprawa_typ_szkody_id'] != 3) {
																							echo '<div class="twld_kreska_e">Pełnomocnictwo VOTUM';
																							echo '<div class="twld_kreska_e_opcje">';
																							echo '<span class="generuj  generuj_pelnomocnictwo_votum_pdf" data-id_sprawy="' . $wiersz ['id'] . '"></span>';
																							echo '</div>';
																							echo '</div>';
																							echo '<div class="twld_kreska_e">Pełnomocnictwo KAIRP';
																							echo '<div class="twld_kreska_e_opcje">';
																							echo '<span class="generuj  generuj_pelnomocnictwo_kairp_pdf" data-id_sprawy="' . $wiersz ['id'] . '"></span>';
																							echo '</div>';
																							echo '</div>';
																						}
                                                                                        if ($wiersz ['sprawa_typ_szkody_id'] == 3) {
                                                                                            echo '<div class="twld_kreska_e">Pełnomocnictwo bankowe VOTUM';
                                                                                            echo '<div class="twld_kreska_e_opcje">';
                                                                                            echo '<span class="generuj generuj_pelnomocnictwo_bankowe_votum_pdf" data-id_sprawy="' . $wiersz ['id'] . '" data-id_umowa="' . $wiersz ['sprawa_umowa_id'] . '" ></span>';
                                                                                            echo '</div>';
                                                                                            echo '</div>';
                                                                                        }
																						echo '<div class="twld_kreska_e">Deklaracja przedstawiciela';
																						echo '<div class="twld_kreska_e_opcje">';
																						echo '<span class="generuj  generuj_deklaracja_przedstawiciela_pdf" data-id_sprawy="' . $wiersz ['id'] . '"></span>';
																						echo '</div>';
																						echo '</div>';
																						echo '<div class="twld_kreska_e">Drukuj wszystko';
																						echo '<div class="twld_kreska_e_opcje">';
																						echo '<span class="generuj generuj_drukuj_wszystko_pdf" data-id_sprawy="' . $wiersz ['id'] . '" data-id_umowa="' . $wiersz ['sprawa_umowa_id'] . '"></span>';
																						echo '</div>';
																						echo '</div>';
																					}
																					echo '</div>';
																					echo '</div>';
																				}
																				
																				?>
				</div>
</div>