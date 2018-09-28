<?php
    require_once($_SERVER ['DOCUMENT_ROOT'].'/czy_zalogowany.php');

    $bazaDanych = new main_BazaDanych();
    $zarzadzanieUzytkownikami = new ZarzadzanieUzytkownikami();



    if(isset($widokDane['listaParametrow'])){
        $listaParametrow = $widokDane['listaParametrow'];

        foreach($listaParametrow as $klucz => $wartosc){
            if($wartosc === 'null'){
                unset($listaParametrow[$klucz]);
            }
        }



        $lista_logowan = $bazaDanych->pobierzDane('*','uzytkownik_historia_zmian','
        
            (uzytkownik_id = 0 
            OR akcja LIKE "%logowanie%")
            
            '.((array_key_exists('data_zmiany',$listaParametrow)) ? ' AND data_zmiany BETWEEN "'.$listaParametrow['data_zmiany'].' 00:00:00" AND "'.$listaParametrow['data_zmiany'].' 23:59:59" ' : '' ).'
            '.((array_key_exists('akcja',$listaParametrow)) ? ' AND akcja LIKE "%'.$listaParametrow['akcja'].'%" ' : '' ).'
            
            ORDER BY data_zmiany DESC LIMIT '.$listaParametrow['top']);
    }else{
        $lista_logowan = $bazaDanych->pobierzDane('*','uzytkownik_historia_zmian','
        
            uzytkownik_id = 0 
            OR akcja LIKE "%logowanie%"
            ORDER BY data_zmiany DESC LIMIT 100'

        );
    }
?>

<table class="table table-striped tabela_lista_logowan_filtruj">
    <thead>
    <tr>
        <th class="">ID</th>
        <th class="col-md-5">Komunikat</th>
        <th class="col-md-2">Wartość</th>
        <th class="col-md-2">Użytkownik</th>
        <th class="">IP</th>
        <th class="col-md-3">Data dodania</th>
        <th class=""></th>
    </tr>
    </thead>
    <tbody>
        <?php
            if(!is_null($lista_logowan)){
                while($poj_lista_logowan = $lista_logowan->fetch_object()){ ?>
                    <tr>
                        <td class=""><?php echo $poj_lista_logowan->id; ?></td>
                        <td class="col-md-5"><?php echo htmlspecialchars_decode($poj_lista_logowan->akcja); ?></td>
                        <td class="col-md-2"><?php echo $poj_lista_logowan->wartosc_przed; ?></td>
                        <td class="col-md-2">
                            <?php
                                if(strpos($poj_lista_logowan->akcja,'logowanie') !== false){
                                    $login_tmp = $bazaDanych->pobierzDane('login','uzytkownik','id = '.$poj_lista_logowan->uzytkownik_id);
                                    $login_tmp = $login_tmp->fetch_object();
                                    echo $login_tmp->login;
                                }
                            ?>
                        </td>
                        <td class=""><?php echo $poj_lista_logowan->adres_ip; ?></td>
                        <td class="col-md-3"><?php echo $poj_lista_logowan->data_zmiany; ?></td>
                        <td class=""></td>
                    </tr>
                <?php }
            }
        ?>
    </tbody>
</table>