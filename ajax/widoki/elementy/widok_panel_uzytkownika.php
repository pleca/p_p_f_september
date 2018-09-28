<?php
    if(!isset($uzytkownikDane)){
        return;
    }
?>
<div class="panelUzytkownikaDane">

        <div class="panelUzytkownikaOgolne col-md-8 padding_l_0 " >
            <div class="form-group margin_b_10">
                <input type="text" disabled class="form-control height_40 border_r_0" placeholder="Imie" value="<?php echo $uzytkownikDane->imie; ?>">
            </div>
            <div class="form-group margin_b_10">
                <input type="text" disabled class="form-control height_40 border_r_0" placeholder="Nazwisko" value="<?php echo $uzytkownikDane->nazwisko; ?>">
            </div>
            <div class="form-group margin_b_10">
                <input type="text" disabled class="form-control height_40 border_r_0" placeholder="Telefon" value="<?php echo $uzytkownikDane->telefon_kom; ?>">
            </div>
            <div class="form-group margin_b_10">
                <input type="email" disabled class="form-control height_40 border_r_0" placeholder="Email" value="<?php echo $uzytkownikDane->email; ?>">
            </div>
            <div class="form-group margin_b_10">
                <input type="password" class="form-control height_40 border_r_0 update uzytkownikStareHaslo" data-wartosc_domyslna="" value="" data-kolumna="uzytkownikStareHaslo" placeholder="Stare haslo">
            </div>
            <div class="form-group margin_b_10">
                <input type="password" class="form-control height_40 border_r_0 update uzytkownikHaslo" data-wartosc_domyslna="" value="" data-kolumna="uzytkownikHaslo" placeholder="Haslo">
            </div>
            <div class="form-group margin_b_10">
                <input type="password" class="form-control height_40 border_r_0 update uzytkownikHasloPowtorz" data-wartosc_domyslna="" value="" data-kolumna="uzytkownikHasloPowtorz" placeholder="Powtórz hasło">
            </div>
        </div>
        <div class="panelUzytkownikaAvatar col-md-4 padding_l_0 padding_r_0" >
            <div id="uzytkownikAvatarPanelPodglad"><img class="width_100 height_auto" src="<?php echo get_adres_strony().'img/avatar/'.$uzytkownikDane->avatar_link; ?>"/></div>
            <div id="uzytkownikAvatarPanelPrzyciskGrupa">
                <div id="uzytkownikAvatarPanelPrzyciskGrupaUpload" class="float_l btn btn-default"><span>Przeglądaj...</span><input data-wartosc_domyslna="<?php echo $uzytkownikDane->avatar_link; ?>" value="<?php echo $uzytkownikDane->avatar_link; ?>" accept="image/*" class="cursor_p panelUzytkownikAvatarInput" type="file" /></div>
                <i class="fa fa-trash margin_t_10 btn btn-default" aria-hidden="true" data-placement="left" data-html="true" data-toggle="popover"  title="Czy jesteś pewien?" data-content="<button data-element_id='<?php echo $uzytkownikDane->id; ?>' data-nazwa_pliku='<?php echo $uzytkownikDane->avatar_link; ?>' type='button' class='btn btn-danger usunTak usunAvatarPanelUzytkownika'>TAK</button>"></i>
                <div class="clear_b"></div>
            </div>
        </div>

        <button type="button" class="btn btn-success height_40 border_r_0 width_100 panelUzytkownikZapiszZmiany">Zapisz zmiany</button>

    <div class="clear_b"></div>
</div>
