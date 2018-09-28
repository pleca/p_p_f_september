<?php
    if(!isset($widokDane)){
        return;
    }
?>
<div class="panelDodatkoweZdjecie">
    <div class="form-group margin_b_10">
        <input type="text" class="form-control height_40 konkursDodatkoweZdjecieNazwa" placeholder="Nazwa">
    </div>
    <div class="konkursDodatkoweZdjecie"></div>
    <div data-rodzic_klasa="konkursDodatkoweZdjecie" class="float_l btn btn-default margin_t_10 przyciskUploadGrupaUpload konkursDodatkoweZdjecieUpload">
        <span class="przyciskUploadGrupaNazwa">Przeglądaj...</span>
        <input class="cursor_p" accept="image/*" data-kolumna="nazwa_pliku" type="file" />
    </div>
    <div class="clear_b"></div>
    <button type="button" data-tabela="<?php echo $widokDane['tabela']; ?>" data-element_id="<?php echo $widokDane['element_id']; ?>" class="btn btn-success width_100 margin_t_10 height_40 konkursZapiszDodatkowaGrafike">Dodaj grafike</button>
</div>