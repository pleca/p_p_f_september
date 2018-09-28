<?php
setlocale ( LC_CTYPE, "pl_PL.UTF-8" );

$klient = json_decode($_POST['klient'], true);
$pozostale_informacje = json_decode($_POST['pozostale_informacje'], true);
$uprawniony = json_decode($_POST['uprawniony'], true);
$umowa = json_decode($_POST['umowa'], true);

$stopka = 'PG-2-23-F5/2018-05-24';

?>

<link rel="stylesheet" href="<?php echo 'https://' . $_SERVER ['HTTP_HOST'] . '/biblioteki/bootstrap/css/bootstrap.css'; ?>" type="text/css"/>
<link rel="stylesheet" href="<?php echo 'https://' . $_SERVER ['HTTP_HOST'] . '/moduly/druki/wzory_dokumentow/css/wzory_dokumentow.css'; ?>" type="text/css"/>


<div class="pdf_strona">
    <div class="pdf_strona_pierwsza_naglowek_pelnomocnictwo margin_t_20">
        <div class="pdfs_tytu_dokumentu pdf_tytul_pelnomocnictwo">
            <p class="margin_b_0 font_w_700 font_size_26 text_a_center">PEŁNOMOCNICTWO</p>
        </div>
        <div class="pdfs_logo_laur"><img src="<?php echo 'https://' . $_SERVER ['HTTP_HOST']; ?>/img/laur.png" /></div>
        <div class="pdfs_logo_osobowe"><img src="<?php echo 'https://' . $_SERVER ['HTTP_HOST']; ?>/img/logo.png" /></div>
    </div>



    <div class="szary_box szary_box_ramka_czerw margin_t_20">
        <div class="form-group col-md-6 margin_t_5">
            <label class="font_size_10 margin_b_0">Ja niżej podpisany</label>
            <div class="pdf_kratka kratka_nowy margin_t_3"><?php echo ($pozostale_informacje['UmowaRodzajUprawnionegoId'] == 4 || $pozostale_informacje['UmowaRodzajUprawnionegoId'] == 0) ? $klient['Imie'] : $uprawniony['Imie']; ?></div>
            <label class="font_size_10 margin_b_0">imię</label>
        </div>
        <div class="form-group col-md-6 margin_t_10">

            <div class="pdf_kratka kratka_nowy margin_t_10"><?php echo ($pozostale_informacje['UmowaRodzajUprawnionegoId'] == 4 || $pozostale_informacje['UmowaRodzajUprawnionegoId'] == 0) ? $klient['Nazwisko'] : $uprawniony['Nazwisko']; ?></div>
            <label class="font_size_10 margin_b_0">nazwisko</label>
        </div>
        <label class="font_w_700 col-md-12 margin_t_10 margin_b_10">Adres zamieszkania</label>
        <div class="form-group col-md-6 margin_t_5">
            <div class="pdf_kratka kratka_nowy"><?php echo ($pozostale_informacje['UmowaRodzajUprawnionegoId'] == 4 || $pozostale_informacje['UmowaRodzajUprawnionegoId'] == 0) ? $klient['Ulica'] : $uprawniony['Ulica']; ?></div>
            <label class="font_size_10 margin_b_0">ulica</label>
        </div>
        <div class="form-group col-md-2 margin_t_5 paddding_r_0">
            <div class="pdf_kratka kratka_nowy"><?php echo ($pozostale_informacje['UmowaRodzajUprawnionegoId'] == 4 || $pozostale_informacje['UmowaRodzajUprawnionegoId'] == 0) ? $klient['NrDomu'] : $uprawniony['NrDomu']; ?></div>
            <label class="font_size_10 ">nr domu</label>
        </div>
        <div class="form-group col-md-2 margin_t_5 paddding_l_0">
            <div class="pdf_kratka kratka_nowy"><?php echo ($pozostale_informacje['UmowaRodzajUprawnionegoId'] == 4 || $pozostale_informacje['UmowaRodzajUprawnionegoId'] == 0) ? $klient['NrMieszkania'] : $uprawniony['NrMieszkania']; ?></div>
            <label class="font_size_10">mieszkania</label>
        </div>
        <div class="form-group col-md-2 margin_t_5">
            <div class="pdf_kratka kratka_nowy"><?php echo ($pozostale_informacje['UmowaRodzajUprawnionegoId'] == 4 || $pozostale_informacje['UmowaRodzajUprawnionegoId'] == 0) ? $klient['KodPocztowy'] : $uprawniony['KodPocztowy']; ?></div>
            <label class="font_size_10">kod pocztowy</label>
        </div>
        <div class="form-group col-md-4 margin_t_5">
            <div class="pdf_kratka kratka_nowy"><?php echo ($pozostale_informacje['UmowaRodzajUprawnionegoId'] == 4 || $pozostale_informacje['UmowaRodzajUprawnionegoId'] == 0) ? $klient['Miasto'] : $uprawniony['Miasto']; ?></div>
            <label class="font_size_10 ">miejscowość</label>
        </div>
        <div class="form-group col-md-4 margin_t_5">
            <div class="pdf_kratka kratka_nowy"><?php echo ($pozostale_informacje['UmowaRodzajUprawnionegoId'] == 4 || $pozostale_informacje['UmowaRodzajUprawnionegoId'] == 0) ? $klient['Pesel'] : $uprawniony['Pesel']; ?></div>
            <label class="font_size_10 ">PESEL</label>
        </div>
        <div class="form-group col-md-4 margin_t_5">
            <div class="pdf_kratka kratka_nowy"><?php echo ($pozostale_informacje['UmowaRodzajUprawnionegoId'] == 4 || $pozostale_informacje['UmowaRodzajUprawnionegoId'] == 0) ? $klient['Dowod'] : $uprawniony['Dowod']; ?></div>
            <label class="font_size_10 ">seria i numer dowodu osobistego</label>
        </div>
        <label class="font_w_700 col-md-12 margin_t_10 margin_b_10">
            Działając w imieniu
            <?php echo ($pozostale_informacje['UmowaRodzajUprawnionegoId'] == 1) ? ' małoletniego'  :  ''; ?>
            <?php echo ($pozostale_informacje['UmowaRodzajUprawnionegoId'] == 2) ? ' ubezwłasnowolnionego'  :  ''; ?>
            <?php echo ($pozostale_informacje['UmowaRodzajUprawnionegoId'] == 3) ? ' małżonka'  :  ''; ?>
            <?php echo ($pozostale_informacje['UmowaRodzajUprawnionegoId'] == 4 || $pozostale_informacje['UmowaRodzajUprawnionegoId'] == 0) ? 'małoletniego/ubezwłasnowolnionego/małżonka*'  :  ''; ?>
        </label>
        <div class="form-group col-md-6 margin_t_5">
            <div class="pdf_kratka kratka_nowy"><?php echo ($pozostale_informacje['UmowaRodzajUprawnionegoId'] != 4 && $pozostale_informacje['UmowaRodzajUprawnionegoId'] != 0) ? $klient['Imie'].' '.$klient['Nazwisko'] : ''; ?></div>
            <label class="font_size_10 margin_b_0">imię i nazwisko</label>
        </div>
        <div class="form-group col-md-6 margin_t_5">
            <div class="pdf_kratka kratka_nowy"><?php echo ($pozostale_informacje['UmowaRodzajUprawnionegoId'] != 4 && $pozostale_informacje['UmowaRodzajUprawnionegoId'] != 0) ? $klient['Ulica'] : ''; ?></div>
            <label class="font_size_10 margin_b_0">ulica</label>
        </div>
        <div class="form-group col-md-2 margin_t_5 paddding_r_0">
            <div class="pdf_kratka kratka_nowy"><?php echo ($pozostale_informacje['UmowaRodzajUprawnionegoId'] != 4 && $pozostale_informacje['UmowaRodzajUprawnionegoId'] != 0) ? $klient['NrDomu'] : ''; ?></div>
            <label class="font_size_10 ">nr domu</label>
        </div>
        <div class="form-group col-md-2 margin_t_5 paddding_l_0">
            <div class="pdf_kratka kratka_nowy"><?php echo ($pozostale_informacje['UmowaRodzajUprawnionegoId'] != 4 && $pozostale_informacje['UmowaRodzajUprawnionegoId'] != 0) ? $klient['NrMieszkania'] : ''; ?></div>
            <label class="font_size_10">mieszkania</label>
        </div>
        <div class="form-group col-md-2 margin_t_5">
            <div class="pdf_kratka kratka_nowy"><?php echo ($pozostale_informacje['UmowaRodzajUprawnionegoId'] != 4 && $pozostale_informacje['UmowaRodzajUprawnionegoId'] != 0) ? $klient['KodPocztowy'] : ''; ?></div>
            <label class="font_size_10">kod pocztowy</label>
        </div>
        <div class="form-group col-md-6 margin_t_5">
            <div class="pdf_kratka kratka_nowy"><?php echo ($pozostale_informacje['UmowaRodzajUprawnionegoId'] != 4 && $pozostale_informacje['UmowaRodzajUprawnionegoId'] != 0) ? $klient['Miasto'] : ''; ?></div>
            <label class="font_size_10 margin_b_0">miejscowość</label>
        </div>
        <div class="clear_b odstep"></div>
        <div class="col-md-12">
            <p class="font_size_10">*Niewłaściwe skreślić. Wypełnić jedynie w przypadku, gdy udzielający pełnomocnictwa działa w imieniu małżonka lub osoby nie posiadającej pełnej zdolności do czynności prawnych,
                tj. małoletniego/ubezwłasnowolnionego. W razie przemijającej przeszkody, która dotyczy jednego z małżonków pozostających we wspólnym pożyciu, zgodnie z art. 29 Kodeksu rodzinnego
                i opiekuńczego, drugi małżonek może za niego działać w sprawach zwykłego zarządu.</p>

            <p class="font_size_10">Udzielający pełnomocnictwa, zastępując małoletniego/uprawnionego, oświadcza, że przysługuje mu pełna władza rodzicielska nad małoletnim/opieka nad uprawnionym i nie toczy się
                żadne postępowanie dotyczące jej odebrania lub ograniczenia. Jednocześnie udzielający pełnomocnictwa potwierdza, że przysługuje mu zarząd majątkiem małoletniego, w imieniu
                którego działa oraz zobowiązuje się do poinformowania pełnomocnika o każdej zmianie w zakresie władzy rodzicielskiej/opieki lub zarządu majątkiem, które nastąpią po dniu udzielenia
                niniejszego pełnomocnictwa.</p>
        </div>
        <div class="clear_b"></div>
    </div>

    <p class="margin_t_10 padding_l_40 padding_r_40">Upoważniam</p>

    <div class="szary_box szary_box_ramka_czerw margin_t_10">
        <div class="pdf_kratka_duza">
            <p class="margin_b_0 text_align_justify font_size_12">VOTUM S.A. z siedzibą we Wrocławiu 53-012, przy ul. Wyścigowej 56i, zarejestrowana w Sądzie Rejonowym dla Wrocławia Fabrycznej VI
                Wydział Gospodarczy Krajowego Rejestru Sądowego pod numerem KRS: 0000243252, REGON: 020136043, NIP: 899-25-49-057, KAPITAŁ
                ZAKŁADOWY: 1 200 000 zł wpłacony w całości,
            </p>
        </div>
    </div>

    <div class="clear_b odstep"></div>
    <div class="col-md-12 padding_l_40 padding_r_40">
        <p class="margin_b_0 text_align_justify">
            do podejmowania w moim imieniu lub w imieniu osoby, którą reprezentuję przed wszelkimi podmiotami wszelkich czynności mających
            na celu ustalenie okoliczności zdarzenia z dnia <span class="font_w_700"><?php echo (!empty($pozostale_informacje['Data'])) ? $pozostale_informacje['Data'] : '______________'; ?></span>r., jak również jego skutków i dochodzenie roszczeń
            cywilnoprawnych, które z tego wynikają, w szczególności do wszelkich czynności pozaprocesowych i polubownych, zawarcia ugody,
            w tym wiążącej się ze zrzeczeniem się dalszych roszczeń, odbioru świadczenia, wskazania rachunku bankowego, na który mają być przelane
            świadczenia, odbioru wszelkiej korespondencji w sprawach objętych pełnomocnictwem, gromadzenia dokumentacji medycznej,
            w tym jej odbioru od podmiotów, które ją tworzą i przechowują, udzielania dalszych pełnomocnictw.
        </p>


        <p class="margin_b_0 text_align_justify margin_t_10">
            Pełnomocnictwo jest ważne także po śmierci mocodawcy.<br>
            Na podstawie art. 26 ust. 1 ustawy z dnia 6 listopada 2008 r. o prawach pacjenta i Rzeczniku Praw Pacjenta (t.j. Dz. U. z 2017 r. poz. 1318)
            zezwalam na wydanie/wysłanie przez wszelkie podmioty udzielające świadczeń zdrowotnych, odpisów lub kserokopii wszelkiej posiadanej
            dokumentacji medycznej, w tym zawierającej informacje o stanie zdrowia, rozpoznaniu, proponowanych oraz możliwych metodach
            diagnostycznych, leczniczych, dających się przewidzieć następstwach ich zastosowania albo zaniechania, wynikach leczenia oraz rokowaniu,
            a tym samym zwalniam w tym zakresie podmioty udzielające świadczeń zdrowotnych od obowiązku zachowania tajemnicy lekarskiej
            względem Votum S.A.
        </p>

        <p class="margin_b_0 text_align_justify margin_t_10">
            Upoważniam VOTUM S.A. do przekazywania oraz odbierania moich danych osobowych lub danych osobowych osoby na rzecz której będą dochodzone roszczenia odszkodowawcze objętych zakresem niniejszego pełnomocnictwa (w tym danych medycznych, danych dotyczących skazań, orzeczeń o ukaraniu i mandatów karnych a także innych orzeczeń wydanych w postępowaniach sądowych)
        </p>

    </div>
    <div class="clear_b odstep"></div>

    <div class="col-md-12 padding_l_40 padding_r_40 margin_t_10">
        <div class="float_l center">
            <span class="underline"><?php echo $umowa['Miasto'].' '.$umowa['DataUmowy'] ?></span><br>
            <span class="font_size_12">miejscowość i data</span>
        </div>
        <div class="float_r center">
            _______________________________________<br>
            <span class="font_size_12">podpis mocodawcy</span>
        </div>
    </div>


    <div class="col-md-12 padding_l_40 padding_r_40 margin_t_0">
        <span class="font_w_700">Dyspozycja wypłaty świadczenia</span>
        <p class="margin_b_0 text_align_justify">
            Oświadczam, że wszystkie świadczenia uzyskane w związku z realizacją niniejszego pełnomocnictwa mają być przekazywane na rachunek
            bankowy pełnomocnika, tj. VOTUM S.A., ul. Wyścigowa 56 i, 53 – 012 Wrocław, nr: 20 1050 1575 1000 0024 2109 0479. Powyższa
            dyspozycja obejmuje w szczególności wypłatę odszkodowań z tytułu szkód objętych umowami ubezpieczenia, o których mowa w ustawie
            z dnia 11 września 2015 r. o działalności ubezpieczeniowej i reasekuracyjnej oraz ustawie z dnia 22 maja 2003 r. o ubezpieczeniach
            obowiązkowych, Ubezpieczeniowym Funduszu Gwarancyjnym i Polskim Biurze Ubezpieczycieli Komunikacyjnych. Niniejsza dyspozycja
            wskazuje jedyny sposób spełnienia świadczenia przez podmiot zobowiązany do zapłaty w związku z realizacją niniejszego pełnomocnictwa.
        </p>
    </div>
    <div class="col-md-12 padding_l_40 padding_r_40 margin_t_10">
        <div class="float_l center">
            <span class="underline"><?php echo $umowa['Miasto'].' '.$umowa['DataUmowy'] ?></span><br>
            <span class="font_size_12">miejscowość i data</span>
        </div>
        <div class="float_r center">
            _______________________________________<br>
            <span class="font_size_12">podpis mocodawcy</span>
        </div>
    </div>

    <div class="stopka_pionowa"><?php echo $stopka; ?></div>

</div>

<!--
<div class="pdf_strona">
    <div class="pdf_strona_pierwsza_naglowek_pelnomocnictwo margin_t_20">
        <div class="pdfs_tytu_dokumentu pdf_tytul_pelnomocnictwo">
            <p class="margin_b_0 font_w_700 font_size_26 text_a_center">PEŁNOMOCNICTWO</p>
        </div>
        <div class="pdfs_logo_laur"><img src="<?php /*echo 'https://' . $_SERVER ['HTTP_HOST']; */?>/img/laur.png" /></div>
        <div class="pdfs_logo_osobowe"><img src="<?php /*echo 'https://' . $_SERVER ['HTTP_HOST']; */?>/img/logo.png" /></div>
    </div>



    <div class="szary_box szary_box_ramka_czerw margin_t_20">
        <div class="form-group col-md-6 margin_t_5">
            <label class="font_size_10 margin_b_0">Ja niżej podpisany</label>
            <div class="pdf_kratka kratka_nowy margin_t_3"><?php /*echo ($pozostale_informacje['UmowaRodzajUprawnionegoId'] == 4 || $pozostale_informacje['UmowaRodzajUprawnionegoId'] == 0) ? $klient['Imie'] : $uprawniony['Imie']; */?></div>
            <label class="font_size_10 margin_b_0">imię</label>
        </div>
        <div class="form-group col-md-6 margin_t_10">

            <div class="pdf_kratka kratka_nowy margin_t_10"><?php /*echo ($pozostale_informacje['UmowaRodzajUprawnionegoId'] == 4 || $pozostale_informacje['UmowaRodzajUprawnionegoId'] == 0) ? $klient['Nazwisko'] : $uprawniony['Nazwisko']; */?></div>
            <label class="font_size_10 margin_b_0">nazwisko</label>
        </div>
        <label class="font_w_700 col-md-12 margin_t_10 margin_b_10">Adres zamieszkania</label>
        <div class="form-group col-md-6 margin_t_5">
            <div class="pdf_kratka kratka_nowy"><?php /*echo ($pozostale_informacje['UmowaRodzajUprawnionegoId'] == 4 || $pozostale_informacje['UmowaRodzajUprawnionegoId'] == 0) ? $klient['Ulica'] : $uprawniony['Ulica']; */?></div>
            <label class="font_size_10 margin_b_0">ulica</label>
        </div>
        <div class="form-group col-md-2 margin_t_5 paddding_r_0">
            <div class="pdf_kratka kratka_nowy"><?php /*echo ($pozostale_informacje['UmowaRodzajUprawnionegoId'] == 4 || $pozostale_informacje['UmowaRodzajUprawnionegoId'] == 0) ? $klient['NrDomu'] : $uprawniony['NrDomu']; */?></div>
            <label class="font_size_10 ">nr domu</label>
        </div>
        <div class="form-group col-md-2 margin_t_5 paddding_l_0">
            <div class="pdf_kratka kratka_nowy"><?php /*echo ($pozostale_informacje['UmowaRodzajUprawnionegoId'] == 4 || $pozostale_informacje['UmowaRodzajUprawnionegoId'] == 0) ? $klient['NrMieszkania'] : $uprawniony['NrMieszkania']; */?></div>
            <label class="font_size_10">mieszkania</label>
        </div>
        <div class="form-group col-md-2 margin_t_5">
            <div class="pdf_kratka kratka_nowy"><?php /*echo ($pozostale_informacje['UmowaRodzajUprawnionegoId'] == 4 || $pozostale_informacje['UmowaRodzajUprawnionegoId'] == 0) ? $klient['KodPocztowy'] : $uprawniony['KodPocztowy']; */?></div>
            <label class="font_size_10">kod pocztowy</label>
        </div>
        <div class="form-group col-md-4 margin_t_5">
            <div class="pdf_kratka kratka_nowy"><?php /*echo ($pozostale_informacje['UmowaRodzajUprawnionegoId'] == 4 || $pozostale_informacje['UmowaRodzajUprawnionegoId'] == 0) ? $klient['Miasto'] : $uprawniony['Miasto']; */?></div>
            <label class="font_size_10 ">miejscowość</label>
        </div>
        <div class="form-group col-md-4 margin_t_5">
            <div class="pdf_kratka kratka_nowy"><?php /*echo ($pozostale_informacje['UmowaRodzajUprawnionegoId'] == 4 || $pozostale_informacje['UmowaRodzajUprawnionegoId'] == 0) ? $klient['Pesel'] : $uprawniony['Pesel']; */?></div>
            <label class="font_size_10 ">PESEL</label>
        </div>
        <div class="form-group col-md-4 margin_t_5">
            <div class="pdf_kratka kratka_nowy"><?php /*echo ($pozostale_informacje['UmowaRodzajUprawnionegoId'] == 4 || $pozostale_informacje['UmowaRodzajUprawnionegoId'] == 0) ? $klient['Dowod'] : $uprawniony['Dowod']; */?></div>
            <label class="font_size_10 ">seria i numer dowodu osobistego</label>
        </div>
        <label class="font_w_700 col-md-12 margin_t_10 margin_b_10">Działając w imieniu małoletniego/ubezwłasnowolnionego/ małżonka *</label>
        <div class="form-group col-md-6 margin_t_5">
            <div class="pdf_kratka kratka_nowy"><?php /*echo ($pozostale_informacje['UmowaRodzajUprawnionegoId'] != 4 && $pozostale_informacje['UmowaRodzajUprawnionegoId'] != 0) ? $klient['Imie'].' '.$klient['Nazwisko'] : ''; */?></div>
            <label class="font_size_10 margin_b_0">imię i nazwisko</label>
        </div>
        <div class="form-group col-md-6 margin_t_5">
            <div class="pdf_kratka kratka_nowy"><?php /*echo ($pozostale_informacje['UmowaRodzajUprawnionegoId'] != 4 && $pozostale_informacje['UmowaRodzajUprawnionegoId'] != 0) ? $klient['Ulica'] : ''; */?></div>
            <label class="font_size_10 margin_b_0">ulica</label>
        </div>
        <div class="form-group col-md-2 margin_t_5 paddding_r_0">
            <div class="pdf_kratka kratka_nowy"><?php /*echo ($pozostale_informacje['UmowaRodzajUprawnionegoId'] != 4 && $pozostale_informacje['UmowaRodzajUprawnionegoId'] != 0) ? $klient['NrDomu'] : ''; */?></div>
            <label class="font_size_10 ">nr domu</label>
        </div>
        <div class="form-group col-md-2 margin_t_5 paddding_l_0">
            <div class="pdf_kratka kratka_nowy"><?php /*echo ($pozostale_informacje['UmowaRodzajUprawnionegoId'] != 4 && $pozostale_informacje['UmowaRodzajUprawnionegoId'] != 0) ? $klient['NrMieszkania'] : ''; */?></div>
            <label class="font_size_10">mieszkania</label>
        </div>
        <div class="form-group col-md-2 margin_t_5">
            <div class="pdf_kratka kratka_nowy"><?php /*echo ($pozostale_informacje['UmowaRodzajUprawnionegoId'] != 4 && $pozostale_informacje['UmowaRodzajUprawnionegoId'] != 0) ? $klient['KodPocztowy'] : ''; */?></div>
            <label class="font_size_10">kod pocztowy</label>
        </div>
        <div class="form-group col-md-6 margin_t_5">
            <div class="pdf_kratka kratka_nowy"><?php /*echo ($pozostale_informacje['UmowaRodzajUprawnionegoId'] != 4 && $pozostale_informacje['UmowaRodzajUprawnionegoId'] != 0) ? $klient['Miasto'] : ''; */?></div>
            <label class="font_size_10 margin_b_0">miejscowość</label>
        </div>
        <div class="clear_b odstep"></div>
        <div class="col-md-12">
            <p class="font_size_10">*Niewłaściwe skreślić. Wypełnić jedynie w przypadku, gdy udzielający pełnomocnictwa działa w imieniu małżonka lub osoby nie posiadającej pełnej zdolności do czynności prawnych,
                tj. małoletniego/ubezwłasnowolnionego. W razie przemijającej przeszkody, która dotyczy jednego z małżonków pozostających we wspólnym pożyciu, zgodnie z art. 29 Kodeksu rodzinnego
                i opiekuńczego, drugi małżonek może za niego działać w sprawach zwykłego zarządu.</p>

            <p class="font_size_10">Udzielający pełnomocnictwa, zastępując małoletniego/uprawnionego, oświadcza, że przysługuje mu pełna władza rodzicielska nad małoletnim/opieka nad uprawnionym i nie toczy się
                żadne postępowanie dotyczące jej odebrania lub ograniczenia. Jednocześnie udzielający pełnomocnictwa potwierdza, że przysługuje mu zarząd majątkiem małoletniego, w imieniu
                którego działa oraz zobowiązuje się do poinformowania pełnomocnika o każdej zmianie w zakresie władzy rodzicielskiej/opieki lub zarządu majątkiem, które nastąpią po dniu udzielenia
                niniejszego pełnomocnictwa.</p>
        </div>
        <div class="clear_b"></div>
    </div>

    <p class="margin_t_10 padding_l_40 padding_r_40">Upoważniam</p>

    <div class="szary_box szary_box_ramka_czerw margin_t_10">
        <div class="pdf_kratka_duza">
            <p class="margin_b_0 text_align_justify font_size_12">VOTUM S.A. z siedzibą we Wrocławiu 53-012, przy ul. Wyścigowej 56i, zarejestrowana w Sądzie Rejonowym dla Wrocławia Fabrycznej VI
                Wydział Gospodarczy Krajowego Rejestru Sądowego pod numerem KRS: 0000243252, REGON: 020136043, NIP: 899-25-49-057, KAPITAŁ
                ZAKŁADOWY: 1 200 000 zł wpłacony w całości,
            </p>
        </div>
    </div>

    <div class="clear_b odstep"></div>
    <div class="col-md-12 padding_l_40 padding_r_40">
        <p class="margin_b_0 text_align_justify">
            do podejmowania w moim imieniu lub w imieniu osoby, którą reprezentuję przed wszelkimi podmiotami wszelkich czynności mających
            na celu ustalenie okoliczności zdarzenia z dnia <span class="font_w_700"><?php /*echo (!empty($pozostale_informacje['Data'])) ? $pozostale_informacje['Data'] : '______________'; */?></span>r., jak również jego skutków i dochodzenie roszczeń
            cywilnoprawnych, które z tego wynikają, w szczególności do wszelkich czynności pozaprocesowych i polubownych, zawarcia ugody,
            w tym wiążącej się ze zrzeczeniem się dalszych roszczeń, odbioru świadczenia, wskazania rachunku bankowego, na który mają być przelane
            świadczenia, odbioru wszelkiej korespondencji w sprawach objętych pełnomocnictwem, gromadzenia dokumentacji medycznej,
            w tym jej odbioru od podmiotów, które ją tworzą i przechowują, udzielania dalszych pełnomocnictw.
        </p>


        <p class="margin_b_0 text_align_justify margin_t_10">
            Pełnomocnictwo jest ważne także po śmierci mocodawcy.<br>
            Na podstawie art. 26 ust. 1 ustawy z dnia 6 listopada 2008 r. o prawach pacjenta i Rzeczniku Praw Pacjenta (t.j. Dz. U. z 2017 r. poz. 1318)
            zezwalam na wydanie/wysłanie przez wszelkie podmioty udzielające świadczeń zdrowotnych, odpisów lub kserokopii wszelkiej posiadanej
            dokumentacji medycznej, w tym zawierającej informacje o stanie zdrowia, rozpoznaniu, proponowanych oraz możliwych metodach
            diagnostycznych, leczniczych, dających się przewidzieć następstwach ich zastosowania albo zaniechania, wynikach leczenia oraz rokowaniu,
            a tym samym zwalniam w tym zakresie podmioty udzielające świadczeń zdrowotnych od obowiązku zachowania tajemnicy lekarskiej
            względem Votum S.A.
        </p>

        <p class="margin_b_0 text_align_justify margin_t_10">
            Na podstawie art. 27 ust. 2 pkt 1 ustawy z dnia 29 sierpnia 1997 r. o ochronie danych osobowych (t. j. Dz. U. 2016 r. poz. 922 ze zm.) wyrażam
            zgodę na przetwarzanie moich danych osobowych (w tym danych dotyczących stanu zdrowia, wskazań, orzeczeń o ukaraniu i mandatów
            karnych, a także innych orzeczeń wydanych w postępowaniu sądowym) przez VOTUM S.A. z siedzibą we Wrocławiu, ul. Wyścigowa 56i,
            53-012 Wrocław w celu wykonania czynności objętych niniejszym pełnomocnictwem.
        </p>

    </div>
    <div class="clear_b odstep"></div>

    <div class="col-md-12 padding_l_40 padding_r_40 margin_t_10">
        <div class="float_l center">
            <span class="underline"><?php /*echo $umowa['Miasto'].' '.$umowa['DataUmowy'] */?></span><br>
            <span class="font_size_12">miejscowość i data</span>
        </div>
        <div class="float_r center">
            _______________________________________<br>
            <span class="font_size_12">podpis mocodawcy</span>
        </div>
    </div>


    <div class="col-md-12 padding_l_40 padding_r_40 margin_t_0">
        <span class="font_w_700">Dyspozycja wypłaty świadczenia</span>
        <p class="margin_b_0 text_align_justify">
            Oświadczam, że wszystkie świadczenia uzyskane w związku z realizacją niniejszego pełnomocnictwa mają być przekazywane na rachunek
            bankowy pełnomocnika, tj. VOTUM S.A., ul. Wyścigowa 56 i, 53 – 012 Wrocław, nr: 20 1050 1575 1000 0024 2109 0479. Powyższa
            dyspozycja obejmuje w szczególności wypłatę odszkodowań z tytułu szkód objętych umowami ubezpieczenia, o których mowa w ustawie
            z dnia 11 września 2015 r. o działalności ubezpieczeniowej i reasekuracyjnej oraz ustawie z dnia 22 maja 2003 r. o ubezpieczeniach
            obowiązkowych, Ubezpieczeniowym Funduszu Gwarancyjnym i Polskim Biurze Ubezpieczycieli Komunikacyjnych. Niniejsza dyspozycja
            wskazuje jedyny sposób spełnienia świadczenia przez podmiot zobowiązany do zapłaty w związku z realizacją niniejszego pełnomocnictwa.
        </p>
    </div>
    <div class="col-md-12 padding_l_40 padding_r_40 margin_t_10">
        <div class="float_l center">
            <span class="underline"><?php /*echo $umowa['Miasto'].' '.$umowa['DataUmowy'] */?></span><br>
            <span class="font_size_12">miejscowość i data</span>
        </div>
        <div class="float_r center">
            _______________________________________<br>
            <span class="font_size_12">podpis mocodawcy</span>
        </div>
    </div>

    <div class="stopka_pionowa"><?php /*echo $stopka; */?></div>

</div>-->