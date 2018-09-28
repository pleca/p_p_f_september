<?php require_once($_SERVER ['DOCUMENT_ROOT'].'/header.php'); ?>
<?php
	if(!in_array('18', $luzu)){
		header('Location: https://' . $_SERVER ['HTTP_HOST'] . '/403 ');
	}
?>
<?php

tytul_strony('DOKUMENTY');

require_once($_SERVER ['DOCUMENT_ROOT'].'moduly/dokumenty/db/funkcje_db.php');

$dokumenty_strona = dokumenty_rodzaj_pobierz_strony($_SESSION['uzytkownik_id'], $_SESSION['uzytkownik_grupa_id']);
?>

<script id="skrypty" type="text/javascript" src="<?php echo adres_strony(); ?>moduly/dokumenty/js/funkcje"></script>
<link rel="stylesheet" href="<?php echo 'https://' . $_SERVER ['HTTP_HOST'] . '/moduly/dokumenty/css/style.css'; ?>" type="text/css" />

<div class="body_strona_tytul zablokowane_pole_transparent">WYBIERZ JEDEN Z ELEMENTÓ
    W</div>
<?php  echo gdzie_jestem($_SERVER['REQUEST_URI']); ?>
<div class="body_strona lista mobile_administracja dokumenty">

	<div class="body_strona_l ">
		<?php if(in_array('19', $luzu)){ ?>
			<div class="dokumenty_strona_dodaj_nowy">
				<input class="dokumenty_strona_dodaj_nowy_nr_kolejnosci " type="text"  placeholder="Nr" />
				<input class="dokumenty_strona_dodaj_nowy_nazwa " type="text"  placeholder="Nazwa" />
				<span style="display:block; float:left; " class="dokumenty_strona_dodaj_nowy_zapisz" ></span>
				<div class="clear_b"></div>
			</div>
		<?php } ?>
		<div  class="dokumenty_strona_lista">
			<?php 
				
			$i=0;
			
			while ($ds = mysqli_fetch_assoc($dokumenty_strona)) {		
				
				if($i == 0){
					echo '<div class="dokumenty_strona_przycisk"><div id="regulaminy" data-strona_id="'.$ds['id'].'" class="element_do_wyboru  aktywny" title="'.$ds['nazwa'].'" >';
						echo '<div class="nazwa"><p>'.$ds['nazwa'].'</p></div>';
                        if(in_array('20', $luzu)){
                            if($ds['id'] != '1'){
                                echo '<span class="edytuj_strona float_r"></span>';
                            }
                        }
						echo '</div>';


						echo '<div class="clear_b"></div>';
					echo '</div>';
					

					$_POST['dokumenty_strona_id'] = $ds['id'];
					$_POST['dokumenty_strona_nazwa'] = $ds['nazwa'];
					
				}else{
					echo '<div class="dokumenty_strona_przycisk"><div id="regulaminy" data-strona_id="'.$ds['id'].'" class="element_do_wyboru " title="'.$ds['nazwa'].'" >';
						echo '<div class="nazwa"><p>'.$ds['nazwa'].'</p></div>';
                    if(in_array('20', $luzu)){
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
			
		
			require_once($_SERVER ['DOCUMENT_ROOT'].'moduly/dokumenty/ajax/widoki/ajax_dokumenty_strona.php');  
		?>
	</div>
	
	<div class="clear_b"></div>
</div>
 
 <div id="szczegoly_dokumentu"></div>
 
<?php require_once($_SERVER ['DOCUMENT_ROOT'].'/footer.php'); ?>