<?php
    require_once($_SERVER ['DOCUMENT_ROOT'].'/czy_zalogowany.php');

    $bazaDanych = new main_BazaDanych();
    $zarzadzanieUzytkownikami = new ZarzadzanieUzytkownikami();

    $lista_uzytkownikow = null;

    if(isset($widokDane['listaParametrow'])){
        $listaParametrow = $widokDane['listaParametrow'];

        foreach($listaParametrow as $klucz => $wartosc){
            if($wartosc === 'null'){
                unset($listaParametrow[$klucz]);
            }
        }

        $lista_uzytkownikow = $bazaDanych->pobierzDane('*','uzytkownik',' (status = 0 OR status = 1)
        
            '.((array_key_exists('login',$listaParametrow)) ? ' AND login LIKE "%'.$listaParametrow['login'].'%" ' : '' ).'
            '.((array_key_exists('imie',$listaParametrow)) ? ' AND imie LIKE "%'.$listaParametrow['imie'].'%" ' : '' ).'
            '.((array_key_exists('nazwisko',$listaParametrow)) ? ' AND nazwisko LIKE "%'.$listaParametrow['nazwisko'].'%" ' : '' ).'
            '.((array_key_exists('data_dodania',$listaParametrow)) ? ' AND data_dodania LIKE "%'.$listaParametrow['data_dodania'].'%" ' : '' ).'
            '.((array_key_exists('email',$listaParametrow)) ? ' AND email LIKE "%'.$listaParametrow['email'].'%" ' : '' ).'
            '.((array_key_exists('telefon_kom',$listaParametrow)) ? ' AND telefon_kom LIKE "%'.$listaParametrow['telefon_kom'].'%" ' : '' ).'
         
         
         ORDER BY data_dodania DESC LIMIT '.$listaParametrow['top']);
    }
?>

<table class="table table-striped tabela_lista_uzytkownikow_filtruj">
    <thead>
        <tr>
            <th class="col-md-1">ID</th>
            <th class="col-md-3">Login</th>
            <th class="col-md-3">Imie</th>
            <th class="col-md-3">Nazwisko</th>
            <th class="col-md-2">Data dodania</th>
            <th class=""></th>
        </tr>
    </thead>
    <tbody>
        <?php
            if(!is_null($lista_uzytkownikow)){
                while($poj_lista_uzytkownikow = $lista_uzytkownikow->fetch_object()){ ?>
                    <tr>
                        <td class="col-md-1 edytujUzytkownika cursor_p" data-element_id="<?php echo $poj_lista_uzytkownikow->id; ?>" data-tabela="uzytkownik" data-akcja="edytuj_uzytkownika"><?php echo $poj_lista_uzytkownikow->id; ?></td>
                        <td class="col-md-3 edytujUzytkownika cursor_p" data-element_id="<?php echo $poj_lista_uzytkownikow->id; ?>" data-tabela="uzytkownik" data-akcja="edytuj_uzytkownika"><span class="tabelka_avatar"><img src="/img/avatar/<?php echo $poj_lista_uzytkownikow->avatar_link; ?>"/></span><?php echo $poj_lista_uzytkownikow->login; ?></td>
                        <td class="col-md-3 edytujUzytkownika cursor_p" data-element_id="<?php echo $poj_lista_uzytkownikow->id; ?>" data-tabela="uzytkownik" data-akcja="edytuj_uzytkownika"><?php echo $poj_lista_uzytkownikow->imie; ?></td>
                        <td class="col-md-3 edytujUzytkownika cursor_p" data-element_id="<?php echo $poj_lista_uzytkownikow->id; ?>" data-tabela="uzytkownik" data-akcja="edytuj_uzytkownika"><?php echo $poj_lista_uzytkownikow->nazwisko; ?></td>
                        <td class="col-md-2 edytujUzytkownika cursor_p" data-element_id="<?php echo $poj_lista_uzytkownikow->id; ?>" data-tabela="uzytkownik" data-akcja="edytuj_uzytkownika"><?php echo $poj_lista_uzytkownikow->data_dodania; ?></td>
                        <td class="">
                            <?php if($zarzadzanieUzytkownikami->sprawdzUprawnienie('administracja_edytuj_uzytkownika')) { ?>
                            <i class="fa fa-pencil edytujUzytkownika" data-element_id="<?php echo $poj_lista_uzytkownikow->id; ?>" data-tabela="uzytkownik" data-akcja="edytuj_uzytkownika" aria-hidden="true"></i>
                            <?php } ?>
                            <?php if($zarzadzanieUzytkownikami->sprawdzUprawnienie('administracja_uzytkownik_historia')) { ?>
                            <i class="fa fa-calendar historiaWyswietl" data-element_id="<?php echo $poj_lista_uzytkownikow->id; ?>" data-tabela="uzytkownik_historia_zmian" aria-hidden="true"></i>
                            <?php } ?>
                        </td>
                    </tr>
                <?php }
            } ?>
    </tbody>
</table>
