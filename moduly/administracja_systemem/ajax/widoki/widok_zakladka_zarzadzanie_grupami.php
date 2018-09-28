<?php
require_once($_SERVER ['DOCUMENT_ROOT'].'/czy_zalogowany.php');

$zarzadzanieGrupami = new ZarzadzanieGrupami();

if($zarzadzanieGrupami->sprawdzUprawnienie('administracja_dodaj_grupe')){ ?>
    <div class="panel panel-default margin_b_10"><div class="panel_naglowek"><i data-akcja="dodaj_grupe_uzytkownika" class="float_r fa fa-plus dodaj_element" aria-hidden="true"></i><div class="clear_b"></div></div></div>
<?php } ?>

<ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active uzytkownicy_grupy_aktywne"><a href="#uzytkownicy_grupy_aktywne" aria-controls="uzytkownicy_grupy_aktywne" role="tab" data-toggle="tab">Aktywne</a></li>
    <li role="presentation"  class="uzytkownicy_grupy_usuniete"><a href="#uzytkownicy_grupy_usuniete" aria-controls="uzytkownicy_grupy_usuniete" role="tab" data-toggle="tab">Usunięte</a></li>
</ul>

<div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="uzytkownicy_grupy_aktywne">
        <?php
            $uzytkownik_grupy = $bazaDanych->pobierzDane('id, nazwa, czy_domyslna','uzytkownik_grupy','czy_usuniety = 0');
            $i = 0;
            while($poj_uzytkownik_grupy = $uzytkownik_grupy->fetch_object()){
                echo $zarzadzanieGrupami->generujListeGrup($poj_uzytkownik_grupy->id, $poj_uzytkownik_grupy->nazwa, $bazaDanych, 1, $i, $poj_uzytkownik_grupy->czy_domyslna);
                $i++;
            }
        ?>
    </div>
    <div role="tabpanel" class="tab-pane" id="uzytkownicy_grupy_usuniete">
        <?php
            $uzytkownik_grupy = $bazaDanych->pobierzDane('id, nazwa, czy_domyslna','uzytkownik_grupy','czy_usuniety = 1');
            if(!is_null($uzytkownik_grupy)){
                while($poj_uzytkownik_grupy = $uzytkownik_grupy->fetch_object()){
                    echo $zarzadzanieGrupami->generujListeGrup($poj_uzytkownik_grupy->id, $poj_uzytkownik_grupy->nazwa, $bazaDanych, 0, $i, $poj_uzytkownik_grupy->czy_domyslna);
                    $i++;
                }
            }else{
                echo '<p>Brak danych...</p>';
            }

        ?>
    </div>
</div>