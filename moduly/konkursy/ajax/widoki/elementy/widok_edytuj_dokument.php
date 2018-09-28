<?php

require_once($_SERVER ['DOCUMENT_ROOT'] . 'czy_zalogowany.php');

$bazaDanych = new main_BazaDanych();
$konkursyMain = new KonkursyMain($bazaDanych);

$widokDane = $widokDane['dokument'];
$nazwa = '';
$opis = '';
$konkurs_slownik_dokument_rodzaj_id = 1;
$nazwa_pliku = 'Przegladaj...';
$konkurs_slownik_dokument_rodzaj_nazwa = 'Regulamin';
$element_id = '';

if(!is_null($widokDane)){
    $nazwa = $widokDane->nazwa;
    $konkurs_slownik_dokument_rodzaj_id = $widokDane->konkurs_slownik_dokument_rodzaj_id;

    $konkurs_slownik_dokument_rodzaj_nazwa = $bazaDanych->pobierzDane('wartosc','konkurs_slownik_dokument_rodzaj','id = '.$widokDane->konkurs_slownik_dokument_rodzaj_id);
    $konkurs_slownik_dokument_rodzaj_nazwa = $konkurs_slownik_dokument_rodzaj_nazwa->fetch_object();
    $konkurs_slownik_dokument_rodzaj_nazwa = $konkurs_slownik_dokument_rodzaj_nazwa->wartosc;

    $opis = $widokDane->opis;
    $nazwa_pliku = $widokDane->nazwa_pliku;
    $element_id = $widokDane->id;

    $listaGrupPrzyznanych = $bazaDanych->pobierzDane('uzytkownik_grupy_id','konkurs_dokumenty_id_uzytkownik_grupy_id','konkurs_dokumenty_id = '.$widokDane->id);
    $listaUzytkownikow = $bazaDanych->pobierzDane('uzytkownik_id','konkurs_dokumenty_id_uzytkownik_id','konkurs_dokumenty_id = '.$widokDane->id);
}


?>
<div class=" konkursDokumentSzczegoly" data-element_id="<?php echo $element_id; ?>">
    <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active konkursDokumentOgolne"><a href="#konkursDokumentOgolne" aria-controls="konkursDokumentOgolne" role="tab" data-toggle="tab">Ogólne</a></li>

        <li role="presentation" class="konkursDokumentWidocznosc"><a href="#konkursDokumentWidocznosc" aria-controls="konkursDokumentWidocznosc" role="tab" data-toggle="tab">Widoczność</a></li>

    </ul>
    <div class="tab-content tabContentStyle">
        <div role="tabpanel" class="tab-pane active konkursDokumentOgolne" id="konkursDokumentOgolne">
            <div class="form-group margin_b_10">
                <input type="text" class="form-control height_40 duzeMaleLiteryCyfry update wymagane duzeMaleLiteryCyfry" placeholder="Nazwa" data-kolumna="nazwa" data-wartosc_domyslna="<?php echo $nazwa; ?>" value="<?php echo $nazwa; ?>">
            </div>
            <div class="form-group margin_b_10">
                <textarea type="text" class="form-control duzeMaleLiteryCyfry update duzeMaleLiteryCyfry" placeholder="Opis" data-kolumna="opis" data-wartosc_domyslna="<?php echo $opis; ?>" ><?php echo $opis; ?></textarea>
            </div>
            <div class="form-group margin_b_10">
                <div class="dropdown">
                    <button class="btn btn-default dropdown-toggle margin_t_0 width_100 height_40" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                        <div data-kolumna="konkurs_slownik_dokument_rodzaj_id" data-wartosc_domyslna="<?php echo $konkurs_slownik_dokument_rodzaj_id; ?>" value="<?php echo $konkurs_slownik_dokument_rodzaj_id; ?>" class="dpUstawOpcjeNazwa attrValue update wymagane float_l"><?php echo $konkurs_slownik_dokument_rodzaj_nazwa; ?></div>
                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                        <?php
                        $rodzajDokumentu = $bazaDanych->pobierzDane('wartosc, id', 'konkurs_slownik_dokument_rodzaj', 'czy_usuniety = 0');
                        while($poj_rodzajDokumentua = $rodzajDokumentu->fetch_object()){
                            echo '<li class="dpUstawOpcje" data-element_id="'.$poj_rodzajDokumentua->id.'">'.mb_ucfirst($poj_rodzajDokumentua->wartosc).'</li>';
                        }
                        ?>
                    </ul>
                </div>
            </div>

            <div id="przyciskUploadGrupaUpload" class="float_l btn btn-default margin_b_10">
                <span id="przyciskUploadGrupaNazwa"><?php echo $nazwa_pliku; ?></span>
                <input class="cursor_p" data-kolumna="nazwa_pliku" type="file" />
            </div>

            <button type="button" class="btn btn-success width_100 height_40 ZapiszZmianyDokument">Zapisz zmiany</button>
        </div>
        <div role="tabpanel" class="tab-pane konkursDokumentWidocznosc" id="konkursDokumentWidocznosc">
            <div class="panel panel-default margin_b_10">
                <div class="panel-heading">Grupy użytkowników</div>
                <div class="panel-body padding_b_0 padding_r_0">
                    <?php
                        if($_SESSION['uzytkownik_grupa_id'] === '1'){
                            $listaGrupUzytkownikow = $bazaDanych->pobierzDane('*','uzytkownik_grupy','czy_usuniety = 0');
                        }else{
                            $listaGrupUzytkownikow = $bazaDanych->pobierzDane('*','uzytkownik_grupy','czy_usuniety = 0 AND id != 1');
                        }
                        $listaGrupPrzyznanych_array = array();

                        if(!is_null($listaGrupPrzyznanych)){
                            while($poj_listaGrupPrzyznanych = $listaGrupPrzyznanych->fetch_object()){
                                array_push($listaGrupPrzyznanych_array, $poj_listaGrupPrzyznanych->uzytkownik_grupy_id);
                            }
                        }

                        while($poj_listaGrupUzytkownikow = $listaGrupUzytkownikow->fetch_object()){
                            echo '<div class=" col-md-4 col-xs-6 padding_l_0">';
                                echo '<div class="well well-sm margin_b_15">'.$poj_listaGrupUzytkownikow->nazwa.'<i class="fa fa-'.((in_array($poj_listaGrupUzytkownikow->id,$listaGrupPrzyznanych_array)) ? 'check-' : '' ).'square-o float_r konkursDokumentDodajUprawnienieGrupy" data-element_id="'.$poj_listaGrupUzytkownikow->id.'" aria-hidden="true"></i></div>';
                            echo '</div>';
                        }
                    ?>
                </div>
            </div>
            <div class="panel panel-default margin_b_0">
                <div class="panel-heading">Lista użytkowników<i class="fa fa-plus-square float_r widokDodajUprawnienieKonkursDokumentUzytkownik" aria-hidden="true"></i></div>
                <div class="panel-body">
                    <table class="table table-striped tabela_lista_uzytkownikow_dokumentu">
                        <thead>
                        <tr>
                            <th class="col-md-1">ID</th>
                            <th class="col-md-3">login</th>
                            <th class="col-md-3">Imie</th>
                            <th class="col-md-4">Nazwisko</th>
                            <th class=""></th>
                        </tr>
                        </thead>
                        <tbody>
                            <?php
                                if(!is_null($listaUzytkownikow)){
                                    while($poj_listaUzytkownikow = $listaUzytkownikow->fetch_object()){
                                        $uzytkownik_tmp = $bazaDanych->pobierzDane('imie, nazwisko, login','uzytkownik','id = '.$poj_listaUzytkownikow->uzytkownik_id);
                                        $uzytkownik_tmp = $uzytkownik_tmp->fetch_object();
                                        echo '<tr>';
                                            echo '<td class="col-md-1">'.$poj_listaUzytkownikow->uzytkownik_id.'</td>';
                                            echo '<td class="col-md-3">'.$uzytkownik_tmp->login.'</td>';
                                            echo '<td class="col-md-3">'.$uzytkownik_tmp->imie.'</td>';
                                            echo '<td class="col-md-4">'.$uzytkownik_tmp->nazwisko.'</td>';
                                            echo '<td class="">';
                                                echo '<i class="fa fa-trash float_r" aria-hidden="true" data-placement="left" data-html="true" data-toggle="popover"  title="Czy jesteś pewien?" data-content="<button data-element_id=\''.$poj_listaUzytkownikow->uzytkownik_id.'\' data-reakcja=\'usun\' data-tabela=\'konkurs_dokumenty_id_uzytkownik_id\' type=\'button\' class=\'btn btn-danger usunTak dodajUsunUprawnienieKonkursDokumentUzytkownik\'>TAK</button>"></i>';
                                            echo '</td>';
                                        echo '</tr>';
                                    }
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>