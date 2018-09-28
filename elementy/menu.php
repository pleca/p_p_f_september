<?php

    require_once($_SERVER ['DOCUMENT_ROOT'].'/czy_zalogowany.php');
    $mainPanel = new main_PanelPrzedstawiciela();

?>
<div id="menu">
	<div class="wysun_menu">
		<div class="wysun_menu_kreska"></div>
		<div class="wysun_menu_kreska"></div>
		<div class="wysun_menu_kreska"></div>
	</div>
	<div class="menu">
        <i class="fa fa-times ukryj_widok wysun_menu position_absolute" aria-hidden="true"></i>
        <div id="uzytkownik_id" data-uzytkownik_id="<?php echo $_SESSION['uzytkownik_id']; ?>" class="uzytkownik_informacje">
			<div class="uzytkownik_avatar">
				<img class="wyswietlPanelUzytkownika" src="<?php echo get_adres_strony().'img/avatar/'.$_SESSION['uzytkownik_avatar']; ?>" />
			</div>
			<p class="zablokowane_pole_transparent margin_b_0">Witaj</p>
			<p class="zablokowane_pole_transparent"><?php echo $_SESSION['uzytkownik_imie'].' '.$_SESSION['uzytkownik_nazwisko']; ?></p>
			<div class="ustawienia_uzytkownika">
				<img class="wyswietlPanelUzytkownika" src="<?php echo get_adres_strony().'img/ustawienia.png'; ?>" />
			</div>
		</div>

		<div class="menu_kreska"></div>

		<div class="menu_opcje_l_r">

            <?php
                $listaPrzyznanychModulow = $mainPanel->listaPrzyznanychModulow($_SESSION['uzytkownik_id'], $bazaDanych);
                $liczbaPrzyznanychModulow = count($listaPrzyznanychModulow);

                for($i = 0; $i < $liczbaPrzyznanychModulow; $i++){
                    echo '<a href="'.get_adres_strony().'moduly/'.$listaPrzyznanychModulow[$i]['nazwa_uproszczona'].'/"><div class="menu_element">'.$listaPrzyznanychModulow[$i]['nazwa_krotka'].'</div></a>';
                }

            ?>
					
					<div class="clear_b"></div>
		</div>
		<div class="clear_b"></div>
		<div class="menu_kreska"></div>
		<div id="wyloguj" class="zablokowane_pole_transparent">WYLOGUJ</div>
	</div>
</div>