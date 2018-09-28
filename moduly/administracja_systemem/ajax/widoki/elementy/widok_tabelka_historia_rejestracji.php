<?php
    require_once($_SERVER ['DOCUMENT_ROOT'].'/czy_zalogowany.php');

    $slownik_pol = array('Imie i nazwisko','Email','Telefon','Dostęp do www','Status','Typ');

    $paginacjaStart = 1;
    $paginacjaStop = 100;

    $bazaDanych = new main_BazaDanych();

    $listaParametrow = array();
    $listaParametrow = array_merge($listaParametrow, array('paginationStart' => $paginacjaStart));

    if(!isset($widokDane['listaParametrow'])){
        $listaParametrow = array_merge($listaParametrow, array('paginationScope' => $paginacjaStop));
    }else{
        $listaParametrow = array_merge($widokDane['listaParametrow'], $listaParametrow);
    }

    foreach($listaParametrow as $klucz => $wartosc){
        if($wartosc === 'null'){
            unset($listaParametrow[$klucz]);
        }
    }

    $polaczenie_ms_sql = $bazaDanych->polaczeniePceSql();
    $lista_elementow_dat = $bazaDanych->wywolajProcedureSql('php_bledne_rejestracje_przedstawicieli_v2',$listaParametrow,$polaczenie_ms_sql);

?>

<table class="table table-striped tabela_historia_rejestracji_nowa">
    <thead>
        <tr>
            <th class="col-md-1">ID</th>
            <th class="col-md-3">Data</th>
            <th class="col-md-2">Numer Agenta</th>
            <th class="col-md-5">Nazwa Wysłana</th>
            <th class="col-md-1"></th>
        </tr>
    </thead>
    <tbody>
        <?php
            while($poj_lista_elementow_dat = mssql_fetch_object($lista_elementow_dat)){
                echo '<tr class="wyswietlSzczegolyHistoriaRejestracji cursor_p">';
                    echo '<td class="col-md-1">'.$poj_lista_elementow_dat->Id.'</td>';
                    echo '<td class="col-md-3">'.$poj_lista_elementow_dat->RegisterDate.'</td>';
                    echo '<td class="col-md-2">'.$poj_lista_elementow_dat->AgentNumberSend.'</td>';
                    echo '<td class="col-md-5">'.iconv("cp1250","UTF-8",$poj_lista_elementow_dat->NameSend).'</td>';
                    echo '<td class="col-md-1 ">';
                        echo '<i class="fa fa-eye" aria-hidden="true"></i>';
                        echo '<div class="wyswietlSzczegolyHistoriaRejestracjiElement ukryj_widok">';
                            echo '<table class="table table-striped tabelaPorownaniaHistoriiRejestracji">';
                                echo '<thead>';
                                    echo '<tr>';
                                        echo '<th class="text-nowrap">Nazwa</th>';
                                        echo '<th class="">Wysłane</th>';
                                        echo '<th class="">Na bazie</th>';
                                        echo '<th class=""></th>';
                                    echo '</tr>';
                                echo '</thead>';
                                echo '<tbody>';
                                    echo '<tr class="'.((iconv("cp1250","UTF-8",$poj_lista_elementow_dat->NameSend) == iconv("cp1250","UTF-8",$poj_lista_elementow_dat->NameDB)) ? '' : 'wshre_zly' ).'">';
                                        echo '<td class="">'.$slownik_pol[0].'</td>';
                                        echo '<td class="">'.iconv("cp1250","UTF-8",$poj_lista_elementow_dat->NameSend).'</td>';
                                        echo '<td class="">'.iconv("cp1250","UTF-8",$poj_lista_elementow_dat->NameDB).'</td>';
                                        echo '<td class=""><i class="fa fa-ban ukryj_widok" aria-hidden="true"></i></td>';
                                    echo '</tr>';
                                echo '</tbody>';
                            echo '</table>';
                            echo '<table class="table table-striped tabelaPorownaniaHistoriiRejestracji">';
                                echo '<thead>';
                                    echo '<tr>';
                                        echo '<th class="text-nowrap">Nazwa</th>';
                                        echo '<th class="text-nowrap">Informacja</th>';
                                        echo '<th class=""></th>';
                                    echo '</tr>';
                                echo '</thead>';
                                echo '<tbody>';
                                    echo '<tr class="'.((iconv("cp1250","UTF-8",$poj_lista_elementow_dat->EmailDB) === 'brak maila w systemie') ? 'wshre_zly' : '' ).'">';
                                        echo '<td>'.$slownik_pol[1].'</td>';
                                        echo '<td>'.iconv("cp1250","UTF-8",$poj_lista_elementow_dat->EmailDB).'</td>';
                                        echo '<td class=""><i class="fa fa-ban ukryj_widok" aria-hidden="true"></i></td>';
                                    echo '</tr>';
                                    echo '<tr class="'.((iconv("cp1250","UTF-8",$poj_lista_elementow_dat->PhoneNumberDB) === 'brak telefonu w systemie') ? 'wshre_zly' : '' ).'">';
                                        echo '<td>'.$slownik_pol[2].'</td>';
                                        echo '<td>'.iconv("cp1250","UTF-8",$poj_lista_elementow_dat->PhoneNumberDB).'</td>';
                                        echo '<td class=""><i class="fa fa-ban ukryj_widok" aria-hidden="true"></i></td>';
                                    echo '</tr>';
                                    echo '<tr class="'.((iconv("cp1250","UTF-8",$poj_lista_elementow_dat->WwwAccessDB) === '0') ? 'wshre_zly' : '' ).'">';
                                        echo '<td>'.$slownik_pol[3].'</td>';
                                        echo '<td>'.iconv("cp1250","UTF-8",$poj_lista_elementow_dat->WwwAccessDB).'</td>';
                                        echo '<td class=""><i class="fa fa-ban ukryj_widok" aria-hidden="true"></i></td>';
                                    echo '</tr>';
                                    echo '<tr class="'.((iconv("cp1250","UTF-8",$poj_lista_elementow_dat->AgentStateValueDB) !== 'Aktywny') ? 'wshre_zly' : '' ).'">';
                                        echo '<td>'.$slownik_pol[4].'</td>';
                                        echo '<td>'.iconv("cp1250","UTF-8",$poj_lista_elementow_dat->AgentStateValueDB).'</td>';
                                        echo '<td class=""><i class="fa fa-ban ukryj_widok" aria-hidden="true"></i></td>';
                                    echo '</tr>';
                                    echo '<tr>';
                                        echo '<td>'.$slownik_pol[5].'</td>';
                                        echo '<td colspan="2">'.iconv("cp1250","UTF-8",$poj_lista_elementow_dat->RegisterType).'</td>';
                                    echo '</tr>';
                                echo '<tbody>';
                            echo '</table>';
                        echo '</div>';
                    echo '</td>';
                echo '</tr>';
            }
        ?>
    </tbody>
</table>

<?php mssql_close($polaczenie_ms_sql); ?>
