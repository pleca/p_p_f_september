<?php

require_once($_SERVER ['DOCUMENT_ROOT'] . 'czy_zalogowany.php');

class ZarzadzanieSmsami extends AdministracjaMain {
    public function generujGrupeSmsow($kgrupaId, $kgrupaNazwa, $kb, $ki, $kuzytkownik_grupy_id){
        $lista_sms = $kb->pobierzDane('id, sms_tresc, aktywny', 'dane_systemowe_sms','sms_grupa_id = '.$kgrupaId );
        $row = $lista_sms->fetch_object();
        if(!is_null($lista_sms)){
                echo '<div id="poj_panel_' . $ki . '" class="panel panel-default pojGrupaUzytkownikow margin_b_10">';
                echo '<div class="panel-heading cursor_p rozwinZwinPanel">' . mb_ucfirst($kgrupaNazwa) . '</div>';
                echo '<div class="panel-body ukryj_widok ">';
                echo '<div class="">';
                if($row->aktywny == '1'){
                    $result = 'fa-check-square-o zaznaczone';
                }else{
                    $result = 'fa-square-o';
                }
                echo '<div class="confirm"><p><span>Czy wysyłać SMS ?</span><i class="fa wlaczWylaczSms float_r ' . $result . '" aria-hidden="true" data-element_id="'.$row->id.'"></i></p></div>';
                echo '<label>Treść:</label>';
                echo '<textarea class="form-control sms_content" placeholder="treść smsa" data-element_id="'.$row->id.'">'.$row->sms_tresc.'</textarea>';
                echo '<div class="row">';
                echo '<div class="col-xs-12 tags">';
                echo '<div>Wstaw: </div>';
                echo '<div class="btn btn-default sms_add_tag " data-tag="Imie"> Imię </div>';
                echo '<div class="btn btn-default sms_add_tag " data-tag="Nazwisko"> Nazwisko </div>';
                echo '<div class="btn btn-default sms_add_tag " data-tag="Plec"> Pan / Pani </div>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
                echo '<div class="row">';
                echo '<div class="col-xs-12 text-right">';
                echo '<button id="save_sms" class="btn btn-success"> Zapisz </button>';
                echo '</div>';
                echo '</div>';
            echo '</div>';
            echo '</div>';
        }
    }
}