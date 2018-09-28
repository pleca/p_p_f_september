<?php
setlocale ( LC_CTYPE, "pl_PL.UTF-8" );

$umowa = json_decode($_POST['umowa'], true);
$klient = json_decode($_POST['klient'], true);
$wynagrodzenie = json_decode($_POST['wynagrodzenie'], true);
$umowa_dane = json_decode($_POST['umowa_dane'], true);
$lista_dostepnej_dokumentacji = json_decode($_POST['lista_dostepnej_dokumentacji']);
$lista_pobranej_dokumentacji = $_POST['lista_pobranej_dokumentacji'];



$stopka = 'PG-2-13-F4/2015-04-01';
$nr_strony = 1;
$liczba_reprezentantow = 3;
//$strony = $liczba_reprezentantow

if ($liczba_reprezentantow == 1 || $liczba_reprezentantow == 0) {
    $strony = 3;
} else if ($liczba_reprezentantow%2) {
    $strony = intval($liczba_reprezentantow/2)+3;
} else {
    $strony = intval($liczba_reprezentantow/2)+2;
}
?>


    <link rel="stylesheet" href="<?php echo 'https://' . $_SERVER ['HTTP_HOST'] . '/biblioteki/bootstrap/css/bootstrap.css'; ?>" type="text/css" />
    <link rel="stylesheet" href="<?php echo 'https://' . $_SERVER ['HTTP_HOST'] . '/moduly/druki/wzory_dokumentow/css/wzory_dokumentow.css'; ?>" type="text/css" />
    <script id="skrypty" type="text/javascript" src="<?php echo 'https://' . $_SERVER ['HTTP_HOST'] . '/biblioteki/jQuery/jquery.min.js'; ?>"></script>
    <script id="skrypty" type="text/javascript" src="<?php echo 'https://' . $_SERVER ['HTTP_HOST'] . '/moduly/druki/wzory_dokumentow/js/wzory_dokumentow.js'; ?>"></script>

    <div class="pdf_strona">

        <div class="pdf_podpisy col-md-12 paddding_l_0 paddding_r_0 margin_t_40 margin_b_0">
            <div class="pdf_kreska col-md-4 paddding_l_0 paddding_r_0 margin_b_0 margin_t_20"></div>
            <div class="col-md-4 paddding_l_0 paddding_r_0 margin_b_0"></div>
            <div class="col-md-4 paddding_l_0 paddding_r_0 margin_b_0">________________, dnia ________________ r.</div>
        </div>

        <div class="pdf_podpisy col-md-12 paddding_l_0 paddding_r_0 margin_t_40 margin_b_0">
            <div class="pdf_kreska col-md-4 paddding_l_0 paddding_r_0 margin_b_0"></div>
        </div>

        <div class="pdf_podpisy col-md-12 paddding_l_0 paddding_r_0 margin_t_40 margin_b_0">
            <div class="pdf_kreska col-md-4 paddding_l_0 paddding_r_0 margin_b_0"></div>
        </div>
        <p class="margin_b_0 font_size_10 pdf_duze_litery">DANE MAŁŻONKA ZMARŁEGO</p>


        <div class="pdf_strona_pierwsza_naglowek_oswiadczenie margin_t_60 margin_b_60">
            <div class="pdfs_tytu_dokumentu pdf_tytul_oswiadczenie">
                <p class="margin_b_0 font_w_700 font_size_26 text_a_center">OŚWIADCZENIE O MAŁŻEŃSKICH</p>
                <p class="margin_b_0 font_w_700 font_size_26 text_a_center">STOSUNKACH MAJĄTKOWYCH</p>
            </div>
            <div class="pdfs_logo"><img src="<?php echo 'https://' . $_SERVER ['HTTP_HOST']; ?>/img/logo.png" /></div>
        </div>
        <label class="pdf_duze_litery pdf_label_kratka pdf_czerowny_napis margin_l_20">JA NIŻEJ PODPISANA/Y OŚWIADCZAM, ŻE:</label>
        <div class="pdf_czerwona_kratka pdf_kratka_duza kratka_naglowek margin_t_10">
            <div class="form-group col-md-4 margin_t_5">
                <p class="margin_b_0 font_w_700 margin_t_20">w dniu zawarcia związku małżeńskiego z</p>
            </div>
            <div class="form-group col-md-8">
                <div class="pdf_kratka margin_t_20"><?php echo $klient['Imie']; ?></div>
            </div>
            <div class="form-group col-md-12 margin_t_5">
                <p class="margin_b_0">
                    <span class="glyphicon glyphicon<?php echo ($umowa_dane['NadplaconeRaty'] == 1) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span> istniała wspólnota majątkowa,
                </p>
                <p class="margin_b_0">
                    <span class="glyphicon glyphicon<?php echo ($umowa_dane['NadplaconeRaty'] == 1) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span> istniała rozdzielność majątkowa;
                </p>
            </div>

            <div class="form-group col-md-12 margin_t_5">
                <p class="margin_b_0 font_w_700 margin_t_20">od zawarcia małżeństwa do chwili śmierci małżonka</p>
            </div>
            <div class="form-group col-md-12 margin_t_5">
                <p class="margin_b_0">
                    <span class="glyphicon glyphicon<?php echo ($umowa_dane['NadplaconeRaty'] == 1) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span> nie zaszły żadne zmiany w małżeńskich stosunkach majątkowych,
                </p>
                <p class="margin_b_0">
                    <span class="glyphicon glyphicon<?php echo ($umowa_dane['NadplaconeRaty'] == 1) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span> zaszły zmiany w małżeńskich stosunkach majątkowych, na dowód tego załączam:
                </p>
            </div>
            <div class="form-group col-md-12 margin_t_5">
                <p class="margin_b_0 font_w_700">Prawomocne orzeczenie sądu/umowę w formie aktu notarialnego</p>
            </div>

            <div class="form-group col-md-12 margin_t_20">
                <p class="margin_b_0 font_w_700">Jednocześnie oświadczam, że:</p>
            </div>
            <div class="form-group col-md-12 margin_t_5">
                <p class="margin_b_0">
                    <span class="glyphicon glyphicon<?php echo ($umowa_dane['NadplaconeRaty'] == 1) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span> posiadam rachunek w otwartym funduszu emerytalnym prowadzony pod numerem:
                </p>
                <div class="pdf_kratka margin_t_5"><?php echo $klient['Imie']; ?></div>
                <p class="margin_b_0 margin_t_5">
                    <span class="glyphicon glyphicon<?php echo ($umowa_dane['NadplaconeRaty'] == 1) ? '-check' : '-unchecked' ; ?>" aria-hidden="true"></span> nie posiadam rachunku w otwartym funduszu emerytalnym.
                </p>
            </div>
        </div>

        <div class="pdf_podpisy col-md-12 paddding_l_0 paddding_r_0 margin_t_60 margin_b_20">
            <div class="pdf_podpisy_p float_r col-md-6 paddding_l_0 paddding_r_0">
                <div class="pdf_kreska col-md-12 paddding_l_0 paddding_r_0 margin_b_0"></div>
                <p class="margin_b_0 font_size_10 pdf_duze_litery text_a_right">WŁASNORĘCZNY PODPIS</p>
            </div>
            <div class="clear_b"></div>
        </div>

        <div class="pdf_strona_stopka col-md-12 margin_b_0">
            <div class="pdf_strona_stopka_wersja"><?php echo $stopka; ?></div>
            <p class="text_a_center margin_b_0"><?php echo $nr_strony++; ?>/1</div>
        </p>
    </div>
    </div>