<?php
require_once($_SERVER ['DOCUMENT_ROOT'] . 'czy_zalogowany.php');

$zarzadzanieUzytkownikami = new ZarzadzanieUzytkownikami();
$bazaDanych = new main_BazaDanych();

$uzytkownik_tmp = $widokDane['uzytkownikDane'];
$element_id = $widokDane['elementId'];

?>

<div class="well well-sm margin_b_10">
    <?php if($zarzadzanieUzytkownikami->sprawdzUprawnienie('administracja_usun_uzytkownika') || $zarzadzanieUzytkownikami->sprawdzUprawnienie('administracja_usun_uzytkownika')) { ?>
        <i class="fa <?php echo (($uzytkownik_tmp->status == '1') ? 'fa-trash' : 'fa-undo'); ?>  margin_r_10" aria-hidden="true" data-placement="left" data-html="true" data-toggle="popover"  title="Czy jesteś pewien?" data-content="<button data-tabela='uzytkownik' data-reakcja='<?php echo (($uzytkownik_tmp->status == '1') ? 'usun' : 'przywroc'); ?>' data-element_id='<?php echo $element_id; ?>' type='button' class='btn btn-danger usunTak usunPrzywrocUzytkownika'>TAK</button>"></i>
    <?php } ?>
    <?php echo $uzytkownik_tmp->imie.' '.$uzytkownik_tmp->nazwisko; ?>

    <?php if($zarzadzanieUzytkownikami->sprawdzUprawnienie('administracja_wymus_wylogowanie')){ ?>
        <i class="float_r fa fa-sign-out" aria-hidden="true" data-placement="left" data-html="true" data-toggle="popover"  title="Czy jesteś pewien?" data-content="<button data-element_id = '<?php echo $element_id; ?>' type = 'button' class='btn btn-danger usunTak wymusWylogowanieUzytkownika' > TAK</button > "></i>
    <?php } ?>

    <?php if($zarzadzanieUzytkownikami->sprawdzUprawnienie('administracja_przejmij_sesje_uzytkownika')){ ?>
        <i class="float_r fa fa-refresh uzytkownikPrzejmijSesje" data-toggle="tooltip" data-placement="left" title="Przejmij sesje użytkownika" aria-hidden="true" data-element_id = "<?php echo $element_id; ?>"></i>
    <?php } ?>
</div>
<ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#uzytkownikOgolne" aria-controls="uzytkownikOgolne" role="tab" data-toggle="tab">Ogólne</a></li>
    <?php if($zarzadzanieUzytkownikami->sprawdzUprawnienie('administracja_szczegoly_uzytkownika')) { ?>
        <li role="presentation"><a href="#uzytkownikSzczegoly" aria-controls="profile" role="tab" data-toggle="tab">Szczegóły</a></li>
    <?php  } ?>
    <li role="presentation"><a href="#uzytkownikAvatar" aria-controls="profile" role="tab" data-toggle="tab">Avatar</a></li>
    <?php if($zarzadzanieUzytkownikami->sprawdzUprawnienie('administracja_nadawanie_uprawnien')) { ?>
        <li role="presentation"><a href="#uzytkownikUprawnienia" aria-controls="profile" role="tab" data-toggle="tab">Uprawnienia</a></li>
    <?php } ?>
</ul>

<div class="tab-content">
    <div role="tabpanel" class="tab-pane active uzytkownikOgolne"  id="uzytkownikOgolne">
        <div class="alert alert-danger text-center font_weight_700 margin_b_10" role="alert">UWAGA!!! Zmiana grupy spowoduje nadpisanie uprawnień!!!</div>
        <?php
            $uzytkownik_grupa_nazwa_tmp = $bazaDanych->pobierzDane('nazwa','uzytkownik_grupy','id = '.$uzytkownik_tmp->uzytkownik_grupa_id);
            $uzytkownik_grupa_nazwa_tmp = $uzytkownik_grupa_nazwa_tmp->fetch_object();
        ?>
        <input class="float_l width_50" disabled type="text" value="<?php echo $uzytkownik_tmp->login; ?>"/>
        <div class="dropdown width_50 float_r">
            <button class="btn btn-default dropdown-toggle margin_t_0 width_100" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                <div data-kolumna="uzytkownik_grupa_id" data-wartosc_domyslna="<?php echo $uzytkownik_tmp->uzytkownik_grupa_id; ?>" value="<?php echo $uzytkownik_tmp->uzytkownik_grupa_id; ?>" class="dpUstawOpcjeNazwa attrValue update wymagane float_l"><?php echo $uzytkownik_grupa_nazwa_tmp->nazwa; ?></div>
                <span class="caret"></span>
            </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                <?php
                    $uzytkownik_grupa = $bazaDanych->pobierzDane('nazwa, id', 'uzytkownik_grupy', 'czy_usuniety = 0');
                    while($poj_uzytkownik_grupa = $uzytkownik_grupa->fetch_object()){
                ?>
                        <li class="dpUstawOpcje" data-element_id="<?php echo $poj_uzytkownik_grupa->id; ?>"><?php echo mb_ucfirst($poj_uzytkownik_grupa->nazwa); ?></li>
                <?php } ?>
            </ul>
        </div>
        <div class="clear_b"></div>
            <input data-kolumna="imie" placeholder="Imię" class="update wymagane float_l width_50" type="text" data-wartosc_domyslna="<?php echo $uzytkownik_tmp->imie; ?>" value="<?php echo $uzytkownik_tmp->imie; ?>"/>
            <input data-kolumna="nazwisko" placeholder="Nazwisko" class="update wymagane float_r width_50" type="text" data-wartosc_domyslna="<?php echo $uzytkownik_tmp->nazwisko; ?>" value="<?php echo $uzytkownik_tmp->nazwisko; ?>"/>
        <div class="clear_b"></div>
            <input data-kolumna="email" placeholder="Email" class="update wymagane float_l width_50" type="text" data-wartosc_domyslna="<?php echo $uzytkownik_tmp->email; ?>" value="<?php echo $uzytkownik_tmp->email; ?>"/>
            <input data-kolumna="telefon_kom" placeholder="Telefon kom" class="update wymagane float_r width_50" type="text" data-wartosc_domyslna="<?php echo $uzytkownik_tmp->telefon_kom; ?>" value="<?php echo $uzytkownik_tmp->telefon_kom; ?>"/>
        <div class="clear_b"></div>
            <input data-kolumna="haslo" placeholder="Hasło" class="uzytkownikHaslo update float_l width_50" type="password" data-wartosc_domyslna="" value=""/>
            <input placeholder="Powtórz hasło" class="uzytkownikHasloPowtorz float_r width_50" type="password" data-wartosc_domyslna="" value=""/>
        <div class="clear_b"></div>
        <button type="button" data-akcja="aktualizuj_uzytkownika" data-element_id="<?php echo $element_id; ?>" data-klasa_rodzic="uzytkownikOgolne" data-tabela="uzytkownik" class="btn btn-success zapiszZmianyAdministracja width_100">Zapisz zmiany</button>
    </div>
    <?php if($zarzadzanieUzytkownikami->sprawdzUprawnienie('administracja_szczegoly_uzytkownika')) { ?>
        <div role="tabpanel" class="tab-pane" id="uzytkownikSzczegoly">
            <div class="form-group float_l width_50 margin_b_0">
                <label for="uzytkownikDataDodania">Data utworzenia</label>
                <input type="text" disabled class="width_100" id="uzytkownikDataDodania" value="<?php echo $uzytkownik_tmp->data_dodania; ?>"/>
            </div>
            <div class="form-group float_r width_50 margin_b_0">
                <label for="uzytkownikZmianyHasla">Zmiana hasła</label>
                <input type="text" disabled class="width_100" id="uzytkownikZmianyHasla" value="<?php echo $uzytkownik_tmp->data_zmiana_hasla; ?>"/>
            </div>
            <div class="clear_b"></div>
            <div class="form-group float_l width_50 margin_b_0">
                <label for="uzytkownikDataLinkuAktywacyjnego">Data linku aktywacyjnego</label>
                <input type="text" disabled class="width_100" id="uzytkownikDataLinkuAktywacyjnego" value="<?php echo $uzytkownik_tmp->data_linku_aktywacyjnego; ?>"/>
            </div>
            <div class="form-group float_r width_50 margin_b_0">
                <label for="uzytkownikHasloSms">Hasło SMS</label>
                <input type="text" disabled class="width_100" id="uzytkownikHasloSms" value="<?php echo $uzytkownik_tmp->haslo_sms; ?>"/>
            </div>
            <div class="clear_b"></div>
            <div class="form-group width_100 margin_b_0">
                <label for="uzytkownikLiczbakontrolna">Liczba kontrolna</label>
                <input type="text" disabled class="width_100" id="uzytkownikLiczbakontrolna" value="<?php echo $uzytkownik_tmp->liczba_kontrolna; ?>"/>
            </div>
            <div class="form-group width_100 margin_b_0">
                <label for="uzytkownikOstatniaAktywnaSesja">Ostatnia aktywna sesja</label>
                <input type="text" disabled class="width_100" id="uzytkownikOstatniaAktywnaSesja" value="<?php echo $uzytkownik_tmp->ostatnia_aktywna_sesja; ?>"/>
            </div>
            <div class="form-group width_100 margin_b_0">
                <label for="uzytkownikSesjaPrzejmujacego">Sesja przejmującego</label>
                <input type="text" disabled class="width_100" id="uzytkownikSesjaPrzejmujacego" value="<?php echo $uzytkownik_tmp->sesja_przejmujacego; ?>"/>
            </div>
            <div class="clear_b"></div>
            <div class="form-group width_25 float_l margin_b_0">
                <label for="uzytkownikProbyLogowania">Próby logowania</label>
                <input type="text" disabled class="width_100 margin_b_0" id="uzytkownikProbyLogowania" value="<?php echo $uzytkownik_tmp->proby_logowania; ?>"/>
            </div>
            <div class="form-group width_25 float_l margin_b_0">
                <label for="uzytkownikBlokadaTymczasowa">Blokada</label>
                <input type="text" disabled class="width_100 margin_b_0" id="uzytkownikBlokadaTymczasowa" value="<?php echo $uzytkownik_tmp->tymczasowa_blokada; ?>"/>
            </div>
            <div class="form-group width_50 float_r margin_b_0">
                <label for="uzytkownikDataBlokadyTymczasowej">Data blokady tymczasowej</label>
                <input type="text" disabled class="width_100 margin_b_0" id="uzytkownikDataBlokadyTymczasowej" value="<?php echo $uzytkownik_tmp->data_blokada_tymczasowa; ?>"/>
            </div>
            <div class="clear_b"></div>
        </div>
    <?php } ?>
    <div role="tabpanel" class="tab-pane" id="uzytkownikAvatar">
        <div id="uzytkownikAvatarPodglad"><img src="/img/avatar/<?php echo $uzytkownik_tmp->avatar_link; ?>"/></div>
        <div id="uzytkownikAvatarPrzyciskGrupa">
        <div id="uzytkownikAvatarPrzyciskGrupaUpload" class="float_l btn btn-default"><span>Przeglądaj...</span><input accept="image/*" class="cursor_p" type="file" /></div>
        <i class="fa fa-trash margin_t_10 btn btn-default" aria-hidden="true" data-placement="left" data-html="true" data-toggle="popover"  title="Czy jesteś pewien?" data-content="<button data-element_id='<?php echo $element_id; ?>' data-nazwa_pliku='<?php echo $uzytkownik_tmp->avatar_link; ?>' type='button' class='btn btn-danger usunTak usunAvatarUzytkownika'>TAK</button>"></i>
        <div class="clear_b"></div>
        </div>
        <button type="button" data-akcja="uzytkownik_dodaj_avatar" data-element_id="<?php echo $element_id; ?>" data-tabela="uzytkownik" class="ukryj_widok margin_t_10 btn btn-success uzytkownikZapiszAvatar width_100">Zapisz zmiany</button>
    </div>
    <?php if($zarzadzanieUzytkownikami->sprawdzUprawnienie('administracja_nadawanie_uprawnien')) { ?>
        <div role="tabpanel" class="tab-pane" id="uzytkownikUprawnienia">
            <div class="uprawnienia_col kolumna_1"><?php echo $zarzadzanieUzytkownikami->generujListeUprawnienUzytkownika($bazaDanych, $element_id); ?></div>
            <div class="uprawnienia_col kolumna_2"></div>
            <div class="clear_b"></div>
        </div>
    <?php } ?>
</div>


