<?php
    require_once($_SERVER ['DOCUMENT_ROOT'] . 'czy_zalogowany.php');

    $szkoleniaMain = new SzkoleniaMain();

    $akcja = htmlspecialchars($_POST['akcja']);
    $temat = htmlspecialchars($_POST['temat']);
    $tresc = $_POST['tresc'];
    $element_id = htmlspecialchars($_POST['element_id']);


    switch ($akcja) {
        case 'pytanie_do_szkolenia':
                $tresc = str_replace("\n", '<br/>', $tresc);

                $odbiorca_tmp = $bazaDanych->pobierzDane('uzytkownik_id', 'szkolenia', 'id = '.$element_id);
                $odbiorca_tmp = $odbiorca_tmp->fetch_object();

                $odbiorca = $bazaDanych->pobierzDane('email', 'uzytkownik', 'id = '.$odbiorca_tmp->uzytkownik_id);
                $odbiorca = $odbiorca->fetch_object();
                $odbiorca = $odbiorca->email;

                $nadawca = $bazaDanych->pobierzDane('email, imie, nazwisko', 'uzytkownik', 'id = '.$_SESSION['uzytkownik_id']);
                $nadawca = $nadawca->fetch_object();

                $nadawca_email = $nadawca->email;
                $nadawca_nazwa = $nadawca->imie.' '.$nadawca->nazwisko;

                $szkoleniaMain->dodajWpisDoHistorii($bazaDanych, $element_id, 'szkolenia_id', 'Wysłanie wiadomości', $nadawca_nazwa, $tresc , 'szkolenia_historia_zmian');

            break;

        case 'wiadomosc_do_uczestnika':
                $odbiorca = htmlspecialchars($_POST['email']);
                $mailing_zalaczniki = $_POST['mailing_zalaczniki'];
                $nadawca_nazwa = '[PANEL PRZEDSTAWICIELA]';
                $nadawca_email = 'automat@votum-sa.pl';
                $mailing_tresc = $tresc;




                $mailing_tresc = str_replace('<br></font>', '&nbsp;</font>', $mailing_tresc);

                $mailing_tresc = str_replace('<table>', '<p><table>', $mailing_tresc);
                $mailing_tresc = str_replace('</table>', '</table></p>', $mailing_tresc);

                $mailing_tresc = str_replace('<div class="podpis_w_tresci">', '', $mailing_tresc);
                $mailing_tresc = str_replace('<div class="podpis_w_tresci_end"></div></div>', '', $mailing_tresc);

                $mailing_tresc = str_replace('<blockquote><p>', '<tr><td style="margin: 0px  0px  0px  0px; padding: 0px 0px 0px 0px; font-family: Calibri;"><blockquote style="padding: 10px; border-left: 4px solid #CCC; font-style: italic; margin: 10px 40px;"><span>', $mailing_tresc);
                $mailing_tresc = str_replace('<blockquote><p align="left">', '<tr><td style="margin: 0px  0px  0px  0px; padding: 0px 0px 0px 0px; font-family: Calibri;"><blockquote style="padding: 10px; border-left: 4px solid #CCC; font-style: italic; margin: 10px 40px;"><span>', $mailing_tresc);
                $mailing_tresc = str_replace('<blockquote><p align="right">', '<tr><td style="margin: 0px  0px  0px  0px; padding: 0px 0px 0px 0px; font-family: Calibri;"><blockquote style="padding: 10px; border-left: 4px solid #CCC; font-style: italic; margin: 10px 40px;"><span>', $mailing_tresc);
                $mailing_tresc = str_replace('<blockquote><p align="justify">', '<tr><td style="margin: 0px  0px  0px  0px; padding: 0px 0px 0px 0px; font-family: Calibri;"><blockquote style="padding: 10px; border-left: 4px solid #CCC; font-style: italic; margin: 10px 40px;"><span>', $mailing_tresc);
                $mailing_tresc = str_replace('</blockquote></p>', '</blockquote></span></td></tr>', $mailing_tresc);

                $mailing_tresc = str_replace('<div', '<p style="margin: 0px 0px 0px 0px; font-family: Calibri; " ', $mailing_tresc);
                $mailing_tresc = str_replace('</div>', '</p>', $mailing_tresc);
                $mailing_tresc = str_replace('<br>', '<br></br>', $mailing_tresc);
                $mailing_tresc = str_replace('<p><br></br></p>', '<p>&nbsp;</p>', $mailing_tresc);
                $mailing_tresc = str_replace('<br></br></', '</', $mailing_tresc);
                $mailing_tresc = str_replace('<br></br></p>', '</p>', $mailing_tresc);
                $mailing_tresc = str_replace('<br></br>', '<p>&nbsp;</p>', $mailing_tresc);

                $mailing_tresc = str_replace('<p', '<p style="margin: 0px 0px 0px 0px; font-family: Calibri; " ', $mailing_tresc);
                $mailing_tresc = str_replace('<p', '<tr style="min-height:10px;"><td style="margin: 0px  0px  0px  0px; padding: 0px 0px 0px 0px; font-family: Calibri;"><div', $mailing_tresc);
                $mailing_tresc = str_replace('</p>', '</div></td></tr>', $mailing_tresc);

                $mailing_tresc = str_replace('<ul', '<tr><td style="margin: 0px  0px  0px  0px; padding: 0px 0px 0px 0px; font-family: Calibri;"><ul style="margin: 0px  0px  16px  30px; padding-left:30px"', $mailing_tresc);
                $mailing_tresc = str_replace('</ul>', '</ul></td></tr>', $mailing_tresc);
                $mailing_tresc = str_replace('<br/><ul', '<ul', $mailing_tresc);


                $mailing_tresc = str_replace('<ol', '<tr><td style="margin: 0px  0px  0px  0px; padding: 0px 0px 0px 0px; font-family: Calibri;"><ol style="margin: 0px  0px  16px  30px; padding-left:30px"', $mailing_tresc);
                $mailing_tresc = str_replace('</ol>', '</ol></td></tr>', $mailing_tresc);
                $mailing_tresc = str_replace('<br/><ol', '<ol', $mailing_tresc);


                $mailing_tresc = str_replace('style="margin:0cm;margin-bottom:.0001pt"', '', $mailing_tresc);

                $mailing_tresc = str_replace('align="justify"', 'style="text-align:justify;" align="justify"', $mailing_tresc);
                $mailing_tresc = str_replace('align="center"', 'style="text-align:center;" align="center"', $mailing_tresc);
                $mailing_tresc = str_replace('align="left"', 'style="text-align:left;" align="left"', $mailing_tresc);
                $mailing_tresc = str_replace('align="right"', 'style="text-align:right;" align="right"', $mailing_tresc);



                $naglowek = '<table width="800px" cellpadding="10" style=" font-family: Calibri; width:800px; " ><tbody border="0"  valign="midle" width="800px">';

                $stopka = '</tbody></table>';

                $zalaczniki = explode(',', $mailing_zalaczniki);

                $tresc = $naglowek.$mailing_tresc.$stopka;

                $szkoleniaMain->dodajWpisDoHistorii($bazaDanych, $element_id, 'szkolenia_id', 'Wysłanie wiadomości', $odbiorca, $tresc , 'szkolenia_historia_zmian');

            break;

        case 'wyslij_potwierdzenie_do_organizatora':

            $nadawca = $bazaDanych->pobierzDane('email, imie, nazwisko', 'uzytkownik', 'id = '.$_SESSION['uzytkownik_id']);
            $nadawca = $nadawca->fetch_object();

            $odbiorca = $nadawca->email;
            $mailing_zalaczniki = $_POST['mailing_zalaczniki'];
            $nadawca_nazwa = '[PANEL PRZEDSTAWICIELA]';
            $nadawca_email = 'automat@votum-sa.pl';
            $mailing_tresc = $tresc;
            $wyslane = $_POST['send_mail'];
            $nie_wyslane = $_POST['error_mail'];

            $mailing_tresc = str_replace('<br></font>', '&nbsp;</font>', $mailing_tresc);

            $mailing_tresc = str_replace('<table>', '<p><table>', $mailing_tresc);
            $mailing_tresc = str_replace('</table>', '</table></p>', $mailing_tresc);

            $mailing_tresc = str_replace('<div class="podpis_w_tresci">', '', $mailing_tresc);
            $mailing_tresc = str_replace('<div class="podpis_w_tresci_end"></div></div>', '', $mailing_tresc);

            $mailing_tresc = str_replace('<blockquote><p>', '<tr><td style="margin: 0px  0px  0px  0px; padding: 0px 0px 0px 0px; font-family: Calibri;"><blockquote style="padding: 10px; border-left: 4px solid #CCC; font-style: italic; margin: 10px 40px;"><span>', $mailing_tresc);
            $mailing_tresc = str_replace('<blockquote><p align="left">', '<tr><td style="margin: 0px  0px  0px  0px; padding: 0px 0px 0px 0px; font-family: Calibri;"><blockquote style="padding: 10px; border-left: 4px solid #CCC; font-style: italic; margin: 10px 40px;"><span>', $mailing_tresc);
            $mailing_tresc = str_replace('<blockquote><p align="right">', '<tr><td style="margin: 0px  0px  0px  0px; padding: 0px 0px 0px 0px; font-family: Calibri;"><blockquote style="padding: 10px; border-left: 4px solid #CCC; font-style: italic; margin: 10px 40px;"><span>', $mailing_tresc);
            $mailing_tresc = str_replace('<blockquote><p align="justify">', '<tr><td style="margin: 0px  0px  0px  0px; padding: 0px 0px 0px 0px; font-family: Calibri;"><blockquote style="padding: 10px; border-left: 4px solid #CCC; font-style: italic; margin: 10px 40px;"><span>', $mailing_tresc);
            $mailing_tresc = str_replace('</blockquote></p>', '</blockquote></span></td></tr>', $mailing_tresc);

            $mailing_tresc = str_replace('<div', '<p style="margin: 0px 0px 0px 0px; font-family: Calibri; " ', $mailing_tresc);
            $mailing_tresc = str_replace('</div>', '</p>', $mailing_tresc);
            $mailing_tresc = str_replace('<br>', '<br></br>', $mailing_tresc);
            $mailing_tresc = str_replace('<p><br></br></p>', '<p>&nbsp;</p>', $mailing_tresc);
            $mailing_tresc = str_replace('<br></br></', '</', $mailing_tresc);
            $mailing_tresc = str_replace('<br></br></p>', '</p>', $mailing_tresc);
            $mailing_tresc = str_replace('<br></br>', '<p>&nbsp;</p>', $mailing_tresc);

            $mailing_tresc = str_replace('<p', '<p style="margin: 0px 0px 0px 0px; font-family: Calibri; " ', $mailing_tresc);
            $mailing_tresc = str_replace('<p', '<tr style="min-height:10px;"><td style="margin: 0px  0px  0px  0px; padding: 0px 0px 0px 0px; font-family: Calibri;"><div', $mailing_tresc);
            $mailing_tresc = str_replace('</p>', '</div></td></tr>', $mailing_tresc);

            $mailing_tresc = str_replace('<ul', '<tr><td style="margin: 0px  0px  0px  0px; padding: 0px 0px 0px 0px; font-family: Calibri;"><ul style="margin: 0px  0px  16px  30px; padding-left:30px"', $mailing_tresc);
            $mailing_tresc = str_replace('</ul>', '</ul></td></tr>', $mailing_tresc);
            $mailing_tresc = str_replace('<br/><ul', '<ul', $mailing_tresc);


            $mailing_tresc = str_replace('<ol', '<tr><td style="margin: 0px  0px  0px  0px; padding: 0px 0px 0px 0px; font-family: Calibri;"><ol style="margin: 0px  0px  16px  30px; padding-left:30px"', $mailing_tresc);
            $mailing_tresc = str_replace('</ol>', '</ol></td></tr>', $mailing_tresc);
            $mailing_tresc = str_replace('<br/><ol', '<ol', $mailing_tresc);


            $mailing_tresc = str_replace('style="margin:0cm;margin-bottom:.0001pt"', '', $mailing_tresc);

            $mailing_tresc = str_replace('align="justify"', 'style="text-align:justify;" align="justify"', $mailing_tresc);
            $mailing_tresc = str_replace('align="center"', 'style="text-align:center;" align="center"', $mailing_tresc);
            $mailing_tresc = str_replace('align="left"', 'style="text-align:left;" align="left"', $mailing_tresc);
            $mailing_tresc = str_replace('align="right"', 'style="text-align:right;" align="right"', $mailing_tresc);

            //$mailing_tresc = $wyslane;
            //$mailing_tresc = $nie_wyslane;
            $statusy_maili = "<p>";
            $statusy_maili .= " Wyslano poprawnie do użytkowników: </br> ";
            $statusy_maili .= $wyslane;
            $statusy_maili .= " </p><p>";
            $statusy_maili .= " Wykryto błędy przy wysyłce do użytkownków: </br> ";
            $statusy_maili .= $nie_wyslane;
            $statusy_maili .= "</p>";



            $naglowek = '<table width="800px" cellpadding="10" style=" font-family: Calibri; width:800px; " ><tbody border="0"  valign="midle" width="800px">';

            $stopka = '</tbody></table>';

            $zalaczniki = explode(',', $mailing_zalaczniki);

            $tresc = $naglowek.$mailing_tresc.$statusy_maili.$stopka;

            $szkoleniaMain->dodajWpisDoHistorii($bazaDanych, $element_id, 'szkolenia_id', 'Wysłanie wiadomości', $odbiorca, $tresc , 'szkolenia_historia_zmian');

            break;
    }

    $wynik = $szkoleniaMain->wyslijWiadomoscEmail($temat, $tresc, $odbiorca, $nadawca_email, $nadawca_nazwa, $zalaczniki);

    $dane = array(
        0 => $wynik['rezultat']
        ,1 => $wynik['komunikat']
    );

    echo json_encode($dane);
    return;