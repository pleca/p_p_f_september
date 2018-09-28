<?php

require_once($_SERVER ['DOCUMENT_ROOT'] . 'czy_zalogowany.php');

$rodzaj = (isset($_POST['rodzaj'])) ? htmlspecialchars($_POST['rodzaj']) : '';
$element_id = (isset($_POST['element_id'])) ? htmlspecialchars($_POST['element_id']) : '';
$akcja = (isset($_POST['akcja'])) ? htmlspecialchars($_POST['akcja']) : '';
$droga = (isset($_POST['droga'])) ? htmlspecialchars($_POST['droga']) : '';
$disabled = 'disabled';
$update = '';

$InformacjeOdKlienta = '';

$element_id_tmp = explode('-',$element_id);
$umowa_dane_tmp = $bazaDanych -> pobierzDane('*', 'umowa'.mb_ucfirst($droga), 'Id='.$element_id_tmp[2]);

$umowa_dane_tmp = $umowa_dane_tmp->fetch_object();
$InformacjeOdKlienta = $umowa_dane_tmp->InformacjeOdKlienta;


?>

    <div class="daneStronyUmowyPopUp">
        <label class="margin_t_10 width_100">INNE ISTOTNE INFORMACJE PRZEKAZANE PRZEZ KLIENTA</label>

        <div class="zpg_opcja zpg_opcja_input">
            <textarea class="form-control update textarea_content" id='textarea_content' rows="6" id="comment" data-kolumna="InformacjeOdKlienta" data-wartosc_domyslna="<?php echo $InformacjeOdKlienta; ?>"><?php echo $InformacjeOdKlienta; ?></textarea>
        </div>

        <button data-reakcja="<?php echo ($akcja == 'nowy') ? 'zapisz_zmiany' : 'zapisz_przeladuj_widok'; ?>" data-droga="<?php echo $droga; ?>" data-klasa_rodzic="daneStronyUmowyPopUp" data-element_id="<?php echo $element_id; ?>" data-tabela="umowaOfe" data-ogolne="0" data-strona="4" data-akcja="aktualizuj_strone_umowy" type="button" class="przyciskZapiszZmianyZielony margin_t_10 wczytajStroneDrogiUmowyDoPopUp btn btn-success width_100 margin_b_0">Zapisz zmiany</button>

    </div>
