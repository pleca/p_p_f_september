<?php require_once($_SERVER ['DOCUMENT_ROOT'].'/header.php'); ?>
<?php
	if(!in_array('118', $luzu)){
		header('Location: https://' . $_SERVER ['HTTP_HOST'] . '/403 ');
	}
?>
<?php

tytul_strony('Strefa produktów');

require_once($_SERVER ['DOCUMENT_ROOT'].'moduly/strefa_produktow/db/funkcje_db.php');
$produkty_strona = produkty_rodzaj_pobierz_strony($_SESSION['uzytkownik_id'], $_SESSION['uzytkownik_grupa_id']);
?>

<script id="skrypty" type="text/javascript" src="<?php echo adres_strony(); ?>moduly/strefa_produktow/js/funkcje"></script>
<link rel="stylesheet" href="<?php echo 'https://' . $_SERVER ['HTTP_HOST'] . '/moduly/strefa_produktow/css/style.css'; ?>" type="text/css" />

<div class="body_strona_tytul zablokowane_pole_transparent">WYBIERZ JEDEN Z ELEMENTÓW</div>
<?php  echo gdzie_jestem($_SERVER['REQUEST_URI']); ?>
<div class="body_strona lista mobile_administracja produkty">

	<div class="body_strona_l ">
		<?php if(in_array('119', $luzu)){ ?>
			<div class="produkty_strona_dodaj_nowy">
				<input class="produkty_strona_dodaj_nowy_nr_kolejnosci " type="text"  placeholder="Nr" />
				<input class="produkty_strona_dodaj_nowy_nazwa " type="text"  placeholder="Nazwa" />
				<span style="display:block; float:left; " class="produkty_strona_dodaj_nowy_zapisz" ></span>
				<div class="clear_b"></div>
			</div>
		<?php } ?>
		<div  class="produkty_strona_lista">
			<?php

			$i=0;

			while ($ds = mysqli_fetch_assoc($produkty_strona)) {

				if($i == 0){
					echo '<div class="produkty_strona_przycisk"><div id="regulaminy" data-strona_id="'.$ds['id'].'" class="element_do_wyboru  aktywny" title="'.$ds['nazwa'].'" >';
						echo '<div class="nazwa"><p>'.$ds['nazwa'].'</p></div>';
                        if(in_array('120', $luzu)){
                            if($ds['id'] != '1'){
                                echo '<span class="edytuj_strona float_r"></span>';
                            }
                        }
						echo '</div>';


						echo '<div class="clear_b"></div>';
					echo '</div>';


					$_POST['produkty_strona_id'] = $ds['id'];
					$_POST['produkty_strona_nazwa'] = $ds['nazwa'];

				}else{
					echo '<div class="produkty_strona_przycisk"><div id="regulaminy" data-strona_id="'.$ds['id'].'" class="element_do_wyboru " title="'.$ds['nazwa'].'" >';
						echo '<div class="nazwa"><p>'.$ds['nazwa'].'</p></div>';
                    if(in_array('120', $luzu)){
                        if($ds['id'] != '1'){
                            echo '<span class="edytuj_strona float_r"></span>';
                        }
                    }
						echo '</div>';


						echo '<div class="clear_b"></div>';
					echo '</div>';

				}
				$i++;


			}

			?>
		</div>

	</div>
	<div id="body_strona_r" class="body_strona_r">
		<?php


			require_once($_SERVER ['DOCUMENT_ROOT'].'moduly/strefa_produktow/ajax/widoki/ajax_produkty_strona.php');
		?>
	</div>

	<div class="clear_b"></div>
</div>

 <div id="szczegoly_produktu"></div>

<?php require_once($_SERVER ['DOCUMENT_ROOT'].'/footer.php'); ?>