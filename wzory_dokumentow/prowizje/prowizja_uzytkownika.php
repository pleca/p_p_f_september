<link rel="stylesheet"
	href="<?php  echo 'https://' . $_SERVER ['HTTP_HOST'] . '/wzory_dokumentow/css/prowizje.css'; ?>"
	type="text/css" media="print"/>


    <?php
    //$numer_agenta = $uzytkownik ['login'];
    $numer_agenta = 'A011068';

    $licznik_stron = 0;
    require_once ($_SERVER ['DOCUMENT_ROOT'] . 'moduly/prowizje/db/funkcje_db.php');

    //$id_miesiaca = '133';
    //$typ_prowizji = '1';

    $id_miesiaca = htmlspecialchars ( $_POST ['id_miesiaca'] );
    $typ_prowizji = htmlspecialchars ( $_POST ['typ_prowizji'] );

    //$uzytkownik = pobierz_jeden_wiersz_z_tabeli ( 'uzytkownik', $_SESSION ['uzytkownik_id'] );

    $miesiace_tab = array (
        1 => "Styczeń",
        2 => "Luty",
        3 => "Marzec",
        4 => "Kwiecień",
        5 => "Maj",
        6 => "Czerwiec",
        7 => "Lipiec",
        8 => "Sierpień",
        9 => "Wrzesień",
        10 => "Październik",
        11 => "Listopad",
        12 => "Grudzień"
    );


        $prowizja = pobierz_prowizje ( $id_miesiaca, $numer_agenta, $typ_prowizji );

        $ile=mssql_num_rows($prowizja);

        $i=0;

        //$test = $ile%9;

        while ( $wiersz = mssql_fetch_array ( $prowizja ) ) {

            //for ($i=1; $i<=$ile; $i++) {




            $numer_sprawy = iconv ( "cp1250", "UTF-8", $wiersz ['CaseNumber'] );
            $krotki_numer_sprawy = substr ( $numer_sprawy, - 7 );
            $kod_jednostki = '';
            $numer_agenta = iconv ( "cp1250", "UTF-8", $wiersz ['AgentNumber'] );
            $in_agenta = iconv ( "cp1250", "UTF-8", $wiersz ['AgentName'] );
            $numer_kierownika = iconv ( "cp1250", "UTF-8", $wiersz ['ManagerNumber'] );
            $in_kierownika = iconv ( "cp1250", "UTF-8", $wiersz ['ManagerName'] );
            $numer_dyrektora = iconv ( "cp1250", "UTF-8", $wiersz ['DirectorNumber'] );
            $in_dyrektora = iconv ( "cp1250", "UTF-8", $wiersz ['DirectorName'] );
            $imie_klienta = iconv ( "cp1250", "UTF-8", $wiersz ['ClientName'] );
            $nazwisko_klienta = iconv ( "cp1250", "UTF-8", $wiersz ['ClientSurname'] );
            $kwota_odszk = iconv ( "cp1250", "UTF-8", $wiersz ['CompensationAmount'] );
            $numer_odszk = iconv ( "cp1250", "UTF-8", $wiersz ['CompensationNumber'] );
            $data_wplywu = iconv ( "cp1250", "UTF-8", $wiersz ['AccountDate'] );
            $honorarium_netto = iconv ( "cp1250", "UTF-8", $wiersz ['FeeNetto'] );
            $prowizja_przed = iconv ( "cp1250", "UTF-8", $wiersz ['CommissionBeforeDeduction'] );
            $prowizja_po = iconv ( "cp1250", "UTF-8", $wiersz ['CommissionAfterDeduction'] );
            $nazwa_prowizji = iconv ( "cp1250", "UTF-8", $wiersz ['CommissionName'] );

        if ($i%9 == 0) {

            $licznik_stron++;
        ?>
    </table>
        </div>
    </div>
<div class="strona_pozioma">
    <div class="dane_uzytkownika">

        <p>Numer agenta: <?php echo $numer_agenta; ?></p>
        <p>Imię i nazwisko:</p>
        <p>Strona: <?php echo $licznik_stron; ?></p>
    </div>


    <div class="tresc_strony">
    <table>
        <tr>
            <th>Krótki numer sprawy</th>
            <th>Numer sprawy</th>
            <th>Kod jednostki</th>
            <th>Numer agenta</th>
            <th>Agent</th>
            <th>Numer kierownika</th>
            <th>Kierownik</th>
            <th>Numer dyrektora</th>
            <th>Dyrektor</th>
            <th>Nazwisko klienta</th>
            <th>Imię klienta</th>
            <th>Kwota odszkodowania</th>
            <th>Data wpływu</th>
            <th>Honorarium netto</th>
            <th>Prowizja przed potrąceniem</th>
            <th>Prowizja po potrąceniu</th>
            <th>Numer odszkodowania</th>
            <th>Nazwa prowizji</th>

        </tr>

        <?php
        }
                echo '<tr>';
                echo '<td>' . $krotki_numer_sprawy . '</td>';
                echo '<td>' . $numer_sprawy . '</td>';
                echo '<td>' . $kod_jednostki . '</td>';
                echo '<td>' . $numer_agenta . '</td>';
                echo '<td>' . $in_agenta . '</td>';
                echo '<td>' . $numer_kierownika . '</td>';
                echo '<td>' . $in_kierownika . '</td>';
                echo '<td>' . $numer_dyrektora . '</td>';
                echo '<td>' . $in_dyrektora . '</td>';
                echo '<td>' . $nazwisko_klienta . '</td>';
                echo '<td>' . $imie_klienta . '</td>';
                echo '<td>' . $kwota_odszk . '</td>';
                echo '<td>' . $data_wplywu . '</td>';
                echo '<td>' . $honorarium_netto . '</td>';
                echo '<td>' . $prowizja_przed . '</td>';
                echo '<td>' . $prowizja_po . '</td>';
                echo '<td>' . $numer_odszk . '</td>';
                echo '<td>' . $nazwa_prowizji . '</td>';
                echo '</tr>';
                $i++;

        }
        ?>
    </table>
    </div>
</div>



