<?php
require_once($_SERVER ['DOCUMENT_ROOT'].'/header.php');

$filmyMain = new FilmyMain($bazaDanych);

if(!$filmyMain->sprawdzUprawnienie('filmy')){
    header('Location: https://' . $_SERVER ['HTTP_HOST'] . '/403 ');
}

$filmyMain->wyswietlNaglowek(false, 'filmy');
$filmyMain->zaladujBiblioteki();

?>
<script type="text/javascript" src="<?php adres_strony(); ?>moduly/filmy/js/funkcje"></script>
<link rel="stylesheet" href="<?php echo 'https://' . $_SERVER ['HTTP_HOST'] . '/moduly/filmy/css/filmy.css'; ?>" type="text/css" />

<div class="container-fluid padding_r_0 padding_l_0 filmyModul">
    <div class="col-md-12 gdzieJestem"><?php  echo gdzie_jestem($_SERVER['REQUEST_URI']); ?></div>
    <div class="col-md-2 mobileColMd">
        <div class="panel panel-default ">
            <div class="panel-heading">MENU</div>
            <div class="panel-body panel_body_menu">
                <button id="zakladka_lista_podcastow" type="button" class="btn btn-default">Podcasty</button>
                <button id="zakladka_lista_filmow" type="button" class="btn btn-default">Filmy</button>
            </div>
        </div>
    </div>
    <div class="col-md-10 mobileColMd">
        <div class="panel panel-default">
            <div id="panel_body_zawartosc" class="panel-body panel_body_zawartosc">
            </div>
        </div>
    </div>
    <div class="clear_b"></div>
</div>

    <div id="popUpFilmyAudio" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" style="display:none;">
        <div class="modal-dialog modal-dialog4" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h5 id="popUpTytulFilmyAudio" class="modal-title" >Modal title</h5>
                </div>
                <div id="popUpTrescFilmyAudio" class="modal-body popUpTrescFilmyAudio">
                    <video class="wiedoPole" width="320" height="240" controls controlsList="nodownload">
                        <source class="popUpTrescFilmySrc" src="" type="video/mp4">
                    </video>
                    <audio class="audioPole width_100" controls controlsList="nodownload">
                        <source class="popUpTrescAudioSrc" src="" type="audio/mp3">
                    </audio>
                    <div class="popUpTrescFilmyAudioDodatkowaTresc"></div>
                </div>
            </div>
        </div>
    </div>


<?php $filmyMain->wyswietlStopke(false); ?>