<?php

require_once($_SERVER ['DOCUMENT_ROOT'] . 'czy_zalogowany.php');

$element_id = (isset($_POST['element_id'])) ? htmlspecialchars($_POST['element_id']) : '';
$akcja = (isset($_POST['akcja'])) ? htmlspecialchars($_POST['akcja']) : '';
$droga = (isset($_POST['droga'])) ? htmlspecialchars($_POST['droga']) : '';

$lista_dodanej_dokumentacji = null;

if($akcja == 'edytuj' ){
    $element_id = explode('-',$element_id);

    $umowa_typ_id = $bazaDanych->pobierzDane('UmowaTypId','umowa','Id = '.$element_id[0]);
    $umowa_typ_id = $umowa_typ_id->fetch_object();
    $umowa_id = $element_id[0];

    $lista_dodanej_dokumentacji = $bazaDanych->pobierzDane('*','umowaZalacznik','czy_usuniety = 0 AND UmowaId = '.$element_id[0]);

    $element_id = $element_id[0].'-'.$element_id[1].'-'.$element_id[2];
}

?>

<div class="daneStronyUmowyPopUp">

        <div class="panel panel-default margin_b_10 dokumentPobranyOdKlienta">
            <div class="panel-heading rozwinPojedynczyPanelNaglowniek cursor_p">DODAJ NOWY<i class="fa fa-plus float_r" aria-hidden="true"></i></div>
            <div class="panel-body ukryj_widok">
                <div class="drukUmowy margin_t_0">
                    <label class=" width_100">Wybierz z listy typ dokumentu</label>
                    <div class="dropdown width_100">
                        <button class="btn btn-default dropdown-toggle margin_t_0 width_100" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                            <div data-kolumna="ZalacznikTypId" data-wartosc_domyslna="" value="1" class="dpUstawOpcjeNazwa attrValue float_l update wymagane">Umowa z Klientem</div>
                            <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                            <?php
                                $lista_dokumentacji = $bazaDanych->pobierzDane('ZalacznikTypId','umowaZalacznikTypUmowaTyp','UmowaTypId = '.$umowa_typ_id->UmowaTypId);

                                while($poj_lista_dokumentacji = $lista_dokumentacji->fetch_object()){
                                    $nazwa_tmp = $bazaDanych->pobierzDane('Id, Wartosc','umowaSlownikZalacznikTyp','Id = '.$poj_lista_dokumentacji->ZalacznikTypId);
                                    $nazwa_tmp = $nazwa_tmp->fetch_object();
                                    echo '<li class="dpUstawOpcje" data-element_id="'.$nazwa_tmp->Id.'">'.mb_ucfirst($nazwa_tmp->Wartosc).'</li>';

                                }

                            ?>

                        </ul>
                    </div>
                </div>

                <div id="drukUmowyPrzyciskGrupaUpload" class="float_l btn btn-default"><span>Przeglądaj...</span><input data-kolumna="ZalacznikPlikNazwa" accept="image/*, application/pdf" class="cursor_p przyciskUploadPrzycisk update wymagane" type="file" /></div>
                <button data-reakcja="<?php echo ($akcja == 'nowy') ? 'zapisz_zmiany' : 'zapisz_przeladuj_widok'; ?>" data-droga="<?php echo $droga; ?>" data-klasa_rodzic="dokumentPobranyOdKlienta" data-element_id="<?php echo $element_id; ?>" data-tabela="umowa<?php echo mb_ucfirst($droga); ?>" data-strona="3" data-ogolne="0" data-akcja="dodaj_dokument_do_umowy" type="button" class="przyciskZapiszZmianyZielony margin_t_10 wczytajStroneDrogiUmowyDoPopUp btn btn-success width_100 margin_b_0">Dodaj dokument</button>

            </div>
        </div>

    <div class="panel panel-default margin_b_10 dokumentPobranyOdKlienta">
        <div class="panel-heading ">LISTA DOKUMENTACJI POBRANEJ OD KLIENTA</div>
        <div class="panel-body">
            <table class="table table-striped tabela_lista_pobranych_dokumentow">
            <thead>
                <tr>
                    <th class="">ID</th>
                    <th class="col-md-12">Nazwa</th>
                    <th class=""></th>
                </tr>
            </thead>
            <tbody>
                <?php
                    if(!is_null($lista_dodanej_dokumentacji)){
                        while($poj_lista_dodanej_dokumentacji = $lista_dodanej_dokumentacji->fetch_object()){
                            $nazwa_tmp = $bazaDanych->pobierzDane('Wartosc','umowaSlownikZalacznikTyp','Id = '.$poj_lista_dodanej_dokumentacji->ZalacznikTypId);
                            $nazwa_tmp = $nazwa_tmp->fetch_object();
                            echo '<tr>';
                                echo '<td class="">'.$poj_lista_dodanej_dokumentacji->Id.'</td>';
                                echo '<td class="col-md-11">'.$nazwa_tmp->Wartosc.'</td>';
                                echo '<td class="col-md-1">';
                                    echo '<a href="'.get_adres_strony().'moduly/druki/wyswietlDokument?id='.$poj_lista_dodanej_dokumentacji->UmowaId.'&nazwa='.$poj_lista_dodanej_dokumentacji->ZalacznikPlikNazwa.'" target="_blank"><i class="fa fa-eye margin_r_5" aria-hidden="true"></i></a>';
                                    echo '<i class="fa fa-trash" aria-hidden="true"data-placement="left" data-html="true" data-toggle="popover"  title="Czy jesteś pewien?" data-content="<button data-akcja=\'usun_przywroc_element\' data-tabela=\'umowaZalacznik\' data-reakcja=\'usun\' data-element_id=\'' . $poj_lista_dodanej_dokumentacji->Id . '-'.$umowa_id.'\' type=\'button\' class=\'btn usunPrzywrocZalacznik btn-danger usunTak \'>TAK</button>"></i>';

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

