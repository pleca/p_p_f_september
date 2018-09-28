<?php
    require_once($_SERVER ['DOCUMENT_ROOT'].'/czy_zalogowany.php');

    $zarzadzanieUzytkownikami = new ZarzadzanieUzytkownikami();

if($zarzadzanieUzytkownikami->sprawdzUprawnienie('administracja_dodaj_uzytkownika')){ ?>
    <div class="panel panel-default margin_b_10"><div class="panel_naglowek"><i data-akcja="dodaj_uzytkownika" class="float_r fa fa-plus dodaj_element" aria-hidden="true"></i><div class="clear_b"></div></div></div>
<?php } ?>

<ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active uzytkownicy_aktywni"><a href="#uzytkownicy_aktywni" aria-controls="uzytkownicy_aktywni" role="tab" data-toggle="tab">Aktywni</a></li>
    <li role="presentation"  class="uzytkownicy_usunieci"><a href="#uzytkownicy_usunieci" aria-controls="uzytkownicy_usunieci" role="tab" data-toggle="tab">Usunięci</a></li>
    <li role="presentation"  class="wyszukiwarka_uzytkownikow"><a href="#wyszukiwarka_uzytkownikow" aria-controls="wyszukiwarka_uzytkownikow" role="tab" data-toggle="tab">Szukaj</a></li>
</ul>

<div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="uzytkownicy_aktywni">
        <?php
            $uzytkownik_grupy = $bazaDanych->pobierzDane('id, nazwa','uzytkownik_grupy','czy_usuniety = 0 ');
            if(!is_null($uzytkownik_grupy)){
                $i = 0;
                while($poj_uzytkownik_grupy = $uzytkownik_grupy->fetch_object()){
                    $zarzadzanieUzytkownikami->generujListeUzytkownikow($poj_uzytkownik_grupy->id, $poj_uzytkownik_grupy->nazwa, $bazaDanych, 1, $i, $_SESSION['uzytkownik_grupa_id']);
                    $i++;
                }
            }
        ?>
    </div>
    <div role="tabpanel" class="tab-pane" id="uzytkownicy_usunieci">
        <?php
            $uzytkownik_grupy = $bazaDanych->pobierzDane('id, nazwa','uzytkownik_grupy','czy_usuniety = 0 ');
            if(!is_null($uzytkownik_grupy)) {
                while ($poj_uzytkownik_grupy = $uzytkownik_grupy->fetch_object()) {
                    $zarzadzanieUzytkownikami->generujListeUzytkownikow($poj_uzytkownik_grupy->id, $poj_uzytkownik_grupy->nazwa, $bazaDanych, 0, $i, $_SESSION['uzytkownik_grupa_id']);
                    $i++;
                }
            }
        ?>
    </div>
    <div role="tabpanel" class="tab-pane" id="wyszukiwarka_uzytkownikow">
        <div class="well well-sm margin_b_10 listaUzytkownikowFiltry">
            <div class="form-group col-md-2 padding_l_0 margin_b_10">
                <input type="text" class="form-control height_40 text-center prm wymagane liczbaTop listaUzytkownikowFiltrujEnter poleLiczbowe" data-kolumna="top" placeholder="liczba wyników" value="100">
            </div>
            <div class="form-group col-md-2 padding_l_0 margin_b_10">
                <input type="text" class="form-control height_40 prm listaUzytkownikowFiltrujEnter duzeMaleLiteryCyfry" data-kolumna="login" placeholder="Login" value="">
            </div>
            <div class="form-group col-md-4 padding_l_0 margin_b_10">
                <input type="text" class="form-control height_40 prm listaUzytkownikowFiltrujEnter duzeMaleLiteryCyfry" data-kolumna="imie" placeholder="Imię" value="">
            </div>
            <div class="form-group col-md-4 padding_l_0 margin_b_10">
                <input type="text" class="form-control height_40 prm listaUzytkownikowFiltrujEnter duzeMaleLiteryCyfry" data-kolumna="nazwisko" placeholder="Nazwisko" value="">
            </div>
            <div class="form-group col-md-2 padding_l_0 margin_b_10">
                <input type="text" class="form-control height_40 prm datePicker text-center listaUzytkownikowFiltrujEnter " data-kolumna="data_dodania" placeholder="Data dodania" value="">
            </div>
            <div class="form-group col-md-6 padding_l_0 margin_b_10">
                <input type="email" class="form-control height_40 prm listaUzytkownikowFiltrujEnter duzeMaleLiteryCyfry" data-kolumna="email" placeholder="Email" value="">
            </div>
            <div class="form-group col-md-4 padding_l_0 margin_b_10">
                <input type="text" class="form-control height_40 prm listaUzytkownikowFiltrujEnter poleLiczbowe" data-kolumna="telefon_kom" placeholder="Telefon" value="">
            </div>
            <div class="clear_b"></div>
            <button type="button" class="btn btn-success width_100 height_40 listaUzytkownikowFiltruj">Filtruj</button>
        </div>
        <div class="panel panel-default ">
            <div id="listaUzytkownikowTabelaWynikow" class="panel-body listaUzytkownikowTabelaWynikow ">
                <?php require_once 'elementy/widok_tabela_lista_uzytkownikow_filtruj.php';?>
            </div>
        </div>
    </div>
</div>

