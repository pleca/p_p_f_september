<?php
require_once($_SERVER ['DOCUMENT_ROOT'].'/czy_zalogowany.php');

$zarzadzanieSmsami = new ZarzadzanieSmsami();

if($zarzadzanieSmsami->sprawdzUprawnienie('administracja_dodaj_uzytkownika')){ ?>
<!--    <div class="panel panel-default margin_b_10"><div class="panel_naglowek"><i data-akcja="dodaj_uzytkownika" class="float_r fa fa-plus dodaj_element" aria-hidden="true"></i><div class="clear_b"></div></div></div>-->
<?php } ?>

<ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active SMS"><a href="#sms" aria-controls="SMS" role="tab" data-toggle="tab">SMS</a></li>
</ul>

<div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="sms">
        <?php
        $sms_grupy = $bazaDanych->pobierzDane('id, nazwa','dane_systemowe_sms_grupy','czy_usuniety = 0 ');
        if(!is_null($sms_grupy)){
            $i = 0;
            while($poj_sms_grupy = $sms_grupy->fetch_object()){
                $zarzadzanieSmsami->generujGrupeSmsow($poj_sms_grupy->id, $poj_sms_grupy->nazwa, $bazaDanych, $i, $poj_sms_grupy->id);
                $i++;
            }
        }
        ?>
    </div>
</div>

