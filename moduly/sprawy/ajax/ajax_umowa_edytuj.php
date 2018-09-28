<?php 

require_once($_SERVER ['DOCUMENT_ROOT'].'/czy_zalogowany.php'); 

$dokument_id = htmlspecialchars($_POST['dokument_id']);
$typ_szkody = htmlspecialchars($_POST['typ_szkody']);
?>
	
	<div class="edytuj_dokument">EDYTUJ DOKUMENT (<?php echo $dokument_id; ?>)</div>
	
			<div class="zakladki">
				  
                <div class="pozycje_zakladek" >
            
                <div class="krok_1 zakladki_element aktywna">1</div>
				<div class="krok_2 zakladki_element">2</div>
                <div class="krok_3 zakladki_element">3</div>
                <div class="krok_4 zakladki_element">4</div>
                <div class="krok_5 zakladki_element">5</div>
                <div class="krok_6 zakladki_element">6</div>
                <div class="krok_7 zakladki_element">7</div>
                <div class="krok_8 zakladki_element">8</div>
                <div class="krok_9 zakladki_element">9</div>
                <div class="krok_10 zakladki_element">10</div>
                <div class="krok_11 zakladki_element">11</div>
                <div class="krok_12 zakladki_element">12</div>
                <div class="krok_13 zakladki_element">13</div>
                <div class="krok_14 zakladki_element">14</div>
                
				</div>
			</div>
			<div class="clear_b"></div>
			<div id="zakladki_tresc" class="umowa_do_edycji" data-id_sprawy="<?php echo $dokument_id;  ?>" data-typ_szkody="<?php echo $typ_szkody;  ?>">
				<?php require_once('ajax_dane_do_umowy_edytuj.php'); ?>
			</div>