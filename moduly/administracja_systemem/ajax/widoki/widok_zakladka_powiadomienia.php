<?php
    require_once($_SERVER ['DOCUMENT_ROOT'].'/czy_zalogowany.php');

    $powiadomienia = new Powiadomienia();
?>

<?php if($powiadomienia->sprawdzUprawnienie('administracja_powiadomienia_dodaj')){ ?>
    <div class="panel panel-default margin_b_10"><div class="panel_naglowek"><i data-akcja="dodaj_powiadomienie" class="float_r fa fa-plus dodaj_element" aria-hidden="true"></i><div class="clear_b"></div></div></div>
<?php } ?>
<ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active powiadomienia_aktywne"><a href="#powiadomienia_aktywne" aria-controls="powiadomienia_aktywne" role="tab" data-toggle="tab">Aktywne</a></li>
    <li role="presentation" class="powiadomienia_usuniete"><a href="#powiadomienia_usuniete" aria-controls="powiadomienia_usuniete" role="tab" data-toggle="tab">Usunięte</a></li>
</ul>

<div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="powiadomienia_aktywne">
        <?php
            $i = 0;
            $rodzaje_powiadomien = $bazaDanych->pobierzDane('id, nazwa', 'powiadomienia_rodzaj', 'czy_usuniety = 0');
            while($poj_rodzaje_powiadomien = $rodzaje_powiadomien->fetch_object()){
                echo $powiadomienia->generujListePowiadomien($poj_rodzaje_powiadomien->id, $poj_rodzaje_powiadomien->nazwa, $bazaDanych, 0, $i);
                $i++;
            }
        ?>
    </div>
    <div role="tabpanel" class="tab-pane " id="powiadomienia_usuniete">
        <?php
            $rodzaje_powiadomien = $bazaDanych->pobierzDane('id, nazwa', 'powiadomienia_rodzaj', 'czy_usuniety = 0');
            while($poj_rodzaje_powiadomien = $rodzaje_powiadomien->fetch_object()){
                echo $powiadomienia->generujListePowiadomien($poj_rodzaje_powiadomien->id, $poj_rodzaje_powiadomien->nazwa, $bazaDanych, 1, $i);
                $i++;
            }
        ?>
    </div>
</div>
