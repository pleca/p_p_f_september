var keys_to_moving_in_input = [8, 9, 32, 35, 36, 37, 39, 46, 109, 189];

//funkcje na document ready 

$(document).ready(function () {

    $('#umowa').click(function () {

        $(document).find('.element_do_wyboru').removeClass('aktywny');
        //
        $(this).addClass('aktywny');

    });



    generuj_zgloszenie_pdf();
    generuj_potwierdzenie_umowy_pdf();

    umowa();
    
    //umowa_bank();
    
    klient();
    lista_umow();
    dodaj_klienta();
    lista_klientow();
    edytuj_klienta();

    dokument();
    $('.zz_edytuj').click(function () {
        $().load(this.href);
        return false;
    });
});

//**************************************ajax**************************************



//funkcja, która wczyta nowy widok do pola z formularzem
function dodaj_klienta() {
    $('#dodaj_klienta').click(function () {


        $('.element_do_wyboru').removeClass('aktywny');
        $(this).addClass('aktywny');
        $('.pozycje_zakladek').slideUp();



        $.ajax({
                method: "POST",
                url: "ajax/widoki/ajax_dodaj_klienta",
                cache: false,
            })
            .done(function (html) {
                document.getElementById("zakladki_tresc").innerHTML = html;

                wybor_pochodzenia();


                $('input').keyup(function () {
                    var wartosc = $(this).val();

                    $(this).attr('value', wartosc);
                });

                blokuj_wpisanie_znakow('pesel');
                blokuj_wpisanie_znakow('kod_pocztowy');
                blokuj_wpisanie_znakow('nr_rachunku_bankowego');
                blokuj_wpisanie_liczb('imie');
                blokuj_wpisanie_liczb('nazwisko');
                blokuj_wpisanie_znakow('zleceniodawca_telefon');

                $('#klient_dodaj_nowy').click(function () {
                    klient_dodaj_nowy();
                });

                zeruj_licznik_sesji_po_wykonaniu_funkcji();

            }).fail(function (ajaxContext) {
                document.getElementById("body_strona_r").innerHTML = ajaxContext.responseText;
            });
    });
}

function dodaj_umowe() {
    $('#dodaj_umowe').click(function () {
        $('.zakladki_element').removeClass('aktywna');
        $(this).addClass('aktywna');
        $.ajax({
                method: "POST",
                url: "ajax/ajax_lista_dostepnych_umow",
            })
            .done(function (html) {
                document.getElementById("zakladki_tresc").innerHTML = html;

                $('#bloczek_a_optima_umowa').click(function () {
                    $(document).find('.element_do_wyboru_opcje').removeClass('aktywny');
                    $(document).find('.element_do_wyboru').removeClass('aktywny');
                    $(this).addClass('aktywny');
                    bloczek_a_optima_umowa_formularz();
                });

                $('#bloczek_a_maxima_umowa').click(function () {
                    $(document).find('.element_do_wyboru_opcje').removeClass('aktywny');
                    $(document).find('.element_do_wyboru').removeClass('aktywny');
                    $(this).addClass('aktywny');
                    bloczek_a_maxima_umowa_formularz();
                });

                $('#bloczek_a_promedica_umowa').click(function () {
                    $(document).find('.element_do_wyboru_opcje').removeClass('aktywny');
                    $(document).find('.element_do_wyboru').removeClass('aktywny');
                    $(this).addClass('aktywny');
                    bloczek_a_promedica_umowa_formularz();
                });

                $('#bloczek_a_ofe_umowa').click(function () {
                    $(document).find('.element_do_wyboru_opcje').removeClass('aktywny');
                    $(document).find('.element_do_wyboru').removeClass('aktywny');
                    $(this).addClass('aktywny');
                    bloczek_a_ofe_umowa_formularz();
                });



            }).fail(function (ajaxContext) {
                document.getElementById("body_strona_r").innerHTML = ajaxContext.responseText;
            });
    });
}

function pobierz_rodzaj_dokumentow() {
    $.ajax({
        method: "POST",
        url: "formularze_dokumenty/akcje/ajax_pobierz_rodzaj_dokumentu"
    }).done(function (data) {

        $('#tabelka_dokumentow .tabelka_dokumentow_wiersz:last').find('#rodzaj_dokumentu').append(data);

    }).fail(function (ajaxContext) {
        document.getElementById("body_strona_r").innerHTML = ajaxContext.responseText;
    });

}

/*EDYCJA DOKUMENTOW*/

function edytuj_dokument_umowa() {
    $('.edytuj_dokument_umowa').click(function () {
        var id_dokumentu = $(this).data('id_dokumentu');
        var typ_szkody = $(this).data('id_typ_szkody');
        var nazwa_dokumentu = $(this).data('nazwa_dokumentu').toLowerCase();

        $.ajax({
            method: "POST",
            data: {
                id_dokumentu: id_dokumentu,
                typ_szkody: typ_szkody,
                nazwa_dokumentu: nazwa_dokumentu
            },
            url: "formularze_dokumenty/widoki/ajax_edytuj_umowa_" + nazwa_dokumentu
        }).done(function (html) {
            document.getElementById("zakladki_tresc").innerHTML = html;
            wstecz_do_lista_dokumentow();
            $('.select_opcja_d').click(function () {

                $('.dzialajacy_w_imieniu_dane').slideUp('fast');

            });
            //reakcja na wybor "CZY KLIENT DZIAŁA W IMIENIU?"
            $('.select_dzialajacy_w_imieniu').change(function () {
                if ($('.select_dzialajacy_w_imieniu option:selected').val() == 'Wybierz') {
                    $('.dzialajacy_w_imieniu_dane').slideUp('fast');
                } else {
                    $('.dzialajacy_w_imieniu_dane').slideDown('fast');
                }
            });

            $('.select_wynagrodzenie').change(function () {

                if ($('.select_wynagrodzenie option:selected').val() == 'Wybierz') {
                    $('.wynagrodzenie_opcje').slideUp('fast');
                } else {
                    $('.zleceniodawca_formularz_nr_rachunku_bankowego').css('display', 'none');
                    $('.wynagrodzenie_opcje').slideDown('fast');
                }

                if ($('.select_wynagrodzenie option:selected').val() == 'Na rachunek bankowy') {
                    $('.zleceniodawca_formularz_nr_rachunku_bankowego').css('display', 'block');
                }

            });

            $('.kopiuj_adres_zleceniodawcy .kratka').click(function () {

                if ($(this).hasClass('zaznaczone')) {
                    $(this).removeClass('zaznaczone');

                    wyczysc_pola_input();

                    odblokuj_pola_do_edycji_odbiorca();

                } else {
                    $(this).addClass('zaznaczone');

                    kopiuj_adres_zleceniodawcy();

                    zablokuj_pola_do_edycji_odbiorca();

                }

            });

            $('input').keyup(function () {
                var wartosc = $(this).val();

                $(this).attr('value', wartosc);
            });

            $('.datepicer').datetimepicker({
                viewMode: 'years',
                format: 'YYYY-MM-DD'
            });

            blokuj_wpisanie_znakow('pesel');
            blokuj_wpisanie_znakow('kod_pocztowy');
            blokuj_wpisanie_znakow('nr_rachunku_bankowego');
            blokuj_wpisanie_liczb('imie');
            blokuj_wpisanie_liczb('nazwisko');

            uzupelnij_dane_klienta_na_podstawie_wybranego_z_listy();

            umowa_zapisz_edytuj_do_bazy();

        }).fail(function (ajaxContext) {
            document.getElementById("body_strona_r").innerHTML = ajaxContext.responseText;
        });
    });

}

function wstecz_do_lista_dokumentow() {
    $('.wstecz_do_lista_dokumentow').click(function () {
        dokument_z();
    });

}

/***********************************************************************************/
function umowa() {
    $('#umowa').click(function () {

        $(document).find('.element_do_wyboru').removeClass('aktywny');
        $(this).addClass('aktywny');

        $.ajax({
                method: "POST",
                url: "ajax/ajax_umowa",
            })
            .done(function (html) {
                document.getElementById("body_strona_r").innerHTML = html;

                dodaj_klienta();
                rodzaj_poszkodowanego();
                lista_klientow();
                edytuj_klienta();
                zgoda_na_przetwarzanie();
                adres_do_korespondencji();
                wybor_typu_szkody();
                wybor_rodzaju_wypadku();
                przelaczanie_zakladek();
                uprawniony_formularz();
                uprawniony_do_informacji_formularz();
                pojazd_a_k_b_k();
                pojazd_c_k();
                pojazd_b_k();
                rozwin_tresc_naglowka();
                ukryj_dwa_pola_z_trzech();
                wyswietl_jedno_ukryte_pole_czysc_input();
                kierujacy_A();
                kierujacy_B();
                roszczenia_od_UFG();
                roszczenia_od_pracodawcy_dodawanie();
                odpowiedzialnosc_karna();
                odpowiedzialnosc_cywilna();
                zaznaczanie_odznaczanie_kratka();
                pozostale_roszczenia();
                inne_odszkodowania();
                dane_poszkodowanego();
                zapisz_strone_nr_1();
                zapisz_strone_nr_2();
                zapisz_strone_nr_3();
                zapisz_strone_nr_4();
                zapisz_strone_nr_5();
                zapisz_strone_nr_6();
                zapisz_strone_nr_7();
                zapisz_strone_nr_8();
                zapisz_strone_nr_9();
                zapisz_strone_nr_10();
                zapisz_strone_nr_11a(); /*medyk*/
                zapisz_strone_nr_11b(); /*medyk*/
                zapisz_strone_nr_12();
                zapisz_strone_nr_13();
                zapisz_strone_nr_14();
                strona_zleceniodawca();
                generuj_zgloszenie_pdf();
                wybor_pochodzenia();
                oswiadczenie_uprawnionego();
                uzupelnij_dane_klienta_na_podstawie_wybranego_z_listy();
                wybor_umowy();
                wyplata_wynagrodzenia();
                wynagrodzenie();
                oswiadczenie_osoby_poszkodowanej(); /*medyk*/
                generuj_umowe_pdf()
                przepisz_poszkodowanego_przy_dodawaniu();
                pobierz_typ_rachunku_bankowego();
                klient_poszkodowany ();
                
                umowa_bankowa();

                $('.str_2').attr('style', 'display:none;');
                $('.str_3').attr('style', 'display:none;');
                $('.str_4').attr('style', 'display:none;');
                $('.str_5').attr('style', 'display:none;');
                $('.str_6').attr('style', 'display:none;');
                $('.str_7').attr('style', 'display:none;');
                $('.str_8').attr('style', 'display:none;');
                $('.str_9').attr('style', 'display:none;');
                $('.str_10').attr('style', 'display:none;');
                $('.str_11').attr('style', 'display:none;');
                $('.str_12').attr('style', 'display:none;');
                $('.str_13').attr('style', 'display:none;');
                $('.str_14').attr('style', 'display:none;');

                zeruj_licznik_sesji_po_wykonaniu_funkcji();

                /*kamyk 2016-08-17*/
                przenies_dane_umowy();

                $('.data').datetimepicker({
                    viewMode: 'years',
                    format: 'YYYY-MM-DD'
                });

                /*kamyk 2016-08-19*/
                sprawa_zapisz_kod_jednostki();
                sprawa_zapisz_rekomendacje();

            }).fail(function (ajaxContext) {
                document.getElementById("body_strona_r").innerHTML = ajaxContext.responseText;
            });
    });
}

function przenies_dane_umowy() {
    $('.przenies_dane_umowy').click(function () {
        var id_wzor = $('.klonowanie_umowy_lista option:selected').attr('id');
        var id_aktualna = $('#zakladki_tresc').data('id_sprawy');

        if (id_wzor == '' || id_wzor == undefined) {
            wyswitl_powiadomienie('Wybierz wzór umowy do skopiowania danych!!!', 0, 0);
            return false;
        }

        if (id_aktualna == '' || id_aktualna == undefined) {
            wyswitl_powiadomienie('Brak informacji z aktualnej sprawy!!!', 0, 0);
            return false;
        }

        $.ajax({
            method: "POST",
            url: 'ajax/akcje/ajax_sprawa_przenies_dane_umowy',
            data: {
                id_wzor: id_wzor,
                id_aktualna: id_aktualna

            }
        }).done(function (data) {

            var array = $.parseJSON(data);

            if (array[0] == '1') {
                wyswitl_powiadomienie(array[1], 1, 0);
                umowa_edytuj_widok(id_aktualna, '3');

            }
            if (array[0] == '0') {
                wyswitl_powiadomienie(array[1], 1, 0);

            }

        }).fail(function (ajaxContext) {
            document.getElementById("body_strona_r").innerHTML = ajaxContext.responseText;
        });
    });
}

function umowa_edytuj() {
    $('.edytuj_umowa').click(function () {
        var id = $(this).data('id_dokumentu');
        var strona = $(this).data('strona');
        var typ_szkody = $(this).data('id_typ_szkody');
        if (strona == '0') {
            strona = '1';
        }
        umowa_edytuj_widok(id, strona, typ_szkody);
    });
}

function umowa_usun() {
    $('.usun_umowa').click(function () {
        var id = $(this).data('id_dokumentu');
        umowa_usun_widok(id);
    });
}

function umowa_usun_widok(dokument_id_tmp) {

    var dokument_id = dokument_id_tmp;
    
    $.ajax({
            method: "POST",
            url: "ajax/ajax_umowa_usun",
            data: {
                dokument_id: dokument_id
            }
    }).done(function (html) {
        wyswitl_powiadomienie('Umowa została usunięta', 1, 0);
        document.getElementById('lista_umow').click();
    }).fail(function (ajaxContext) {
        document.getElementById("body_strona_r").innerHTML = ajaxContext.responseText;
    });
}


function umowa_edytuj_widok(dokument_id_tmp, strona_do_aktywacji, typ_szkody_tmp) {

    var dokument_id = dokument_id_tmp;
    var typ_szkody = typ_szkody_tmp;
    $('#lista_umow').removeClass('aktywny');

    $.ajax({
            method: "POST",
            url: "ajax/ajax_umowa_edytuj",
            data: {
                dokument_id: dokument_id,
                typ_szkody: typ_szkody
            }
        })
        .done(function (html) {
            // alert();
            document.getElementById("body_strona_r").innerHTML = html;

            zeruj_licznik_sesji_po_wykonaniu_funkcji();

            dodaj_klienta();
            lista_klientow();
            edytuj_klienta();


            $('.typ_szkody').show();

            $('.pozycje_zakladek').show();

            adres_do_korespondencji();
            wybor_typu_szkody();
            wybor_rodzaju_wypadku();
            przelaczanie_zakladek();
            uprawniony_formularz();
            uprawniony_do_informacji_formularz();
            pojazd_a_k_b_k();
            pojazd_c_k();
            pojazd_b_k();
            rozwin_tresc_naglowka();
            ukryj_dwa_pola_z_trzech();
            wyswietl_jedno_ukryte_pole_czysc_input();
            kierujacy_A();
            kierujacy_B();
            roszczenia_od_UFG();
            roszczenia_od_pracodawcy();
            odpowiedzialnosc_karna();
            odpowiedzialnosc_cywilna();
            zaznaczanie_odznaczanie_kratka();
            pozostale_roszczenia();
            inne_odszkodowania();
            dane_poszkodowanego();

            strona_zleceniodawca();
            generuj_zgloszenie_pdf();
            wybor_pochodzenia();
            oswiadczenie_uprawnionego();
            uzupelnij_dane_klienta_na_podstawie_wybranego_z_listy();
            wybor_umowy();
            wyplata_wynagrodzenia();
            wynagrodzenie();
            generuj_umowe_pdf()

            /*medyk 2016-08-25*/
            sprawa_oswiadczenie_poszkodowanego_zapisz_zmiany();
            oswiadczenie_osoby_poszkodowanej();
            przepisz_poszkodowanego();
            rodzaj_poszkodowanego();
            pobierz_typ_rachunku_bankowego();
            kogo_pozostawiono();

            if (typ_szkody == '3'){
        	        
        	$('.mop').hide();
                $('.mop').addClass("ukryj");
                $('.b').show();
                $('.inne_szkody').hide();
                $('.umowa_bankowa').hide();
                $('.rodzaj_wypadku').hide();

              
        	przelaczanie_zakladek_umowa_bankowa();
        	umowa_bankowa();
        	
        	$('.krok_8').attr('style', 'display:none;');
                $('.krok_9').attr('style', 'display:none;');
                $('.krok_10').attr('style', 'display:none;');
                $('.krok_11').attr('style', 'display:none;');
                $('.krok_12').attr('style', 'display:none;');
                $('.krok_13').attr('style', 'display:none;');
                $('.krok_14').attr('style', 'display:none;');

            } else {
        	$('.umowa_bankowa').hide();

                $('.mop').removeClass("ukryj");
                       
                $('.str_2').attr('style', 'display:none;');
                $('.str_3').attr('style', 'display:none;');
                $('.str_4').attr('style', 'display:none;');
                $('.str_5').attr('style', 'display:none;');
                $('.str_6').attr('style', 'display:none;');
                $('.str_7').attr('style', 'display:none;');
                $('.str_8').attr('style', 'display:none;');
                $('.str_9').attr('style', 'display:none;');
                $('.str_10').attr('style', 'display:none;');
                $('.str_11').attr('style', 'display:none;');
                $('.str_12').attr('style', 'display:none;');
                $('.str_13').attr('style', 'display:none;');
                $('.str_14').attr('style', 'display:none;');

            }


            /*KaMyK 2016-08-08*/
            kratka_zapisz_zmiane();
            zapisz_adres_kor_na_sprawie();
            //input_zapisz_zmiane_blur();

            /*KaMyK 2016-08-11*/
            sprawa_poszkodowany_zapisz_zmiany();
            sprawa_uprawniony_zapisz_zmiany();
            sprawa_uprawniony_do_inf_zapisz_zmiany();

            /*kamyk 2016-08-12*/
            $('.ou_ps_nastapilo_psm').click(function () {
                var sprawa_id = $('#zakladki_tresc').data('id_sprawy');
                var wartosc;

                ($(this).hasClass('zaznaczone')) ? wartosc = '1': wartosc = '0';
                kratka_zapisz_zmiane('sprawa', sprawa_id, 'pogorszenie_sytuacji', wartosc);
            });

            $('.ou_ps_w_krzywda').click(function () {
                var sprawa_id = $('#zakladki_tresc').data('id_sprawy');
                var wartosc;

                ($(this).hasClass('zaznaczone')) ? wartosc = '1': wartosc = '0';
                kratka_zapisz_zmiane('sprawa', sprawa_id, 'wystapienie_krzywdy', wartosc);

            });

            $('.data').datetimepicker({
                viewMode: 'years',
                format: 'YYYY-MM-DD'
            });

            sprawa_informacje_o_zdarzeniu_zapisz_zmiany();
            sprawa_odpowiedzialnosc_karna_zapisz_zmiany();

            /*kamyk 2016-08-16*/
            sprawa_odpowiedzialnosc_cywilna_zapisz_zmiany();
            sprawa_dochodzenie_roszczen_zapisz_zmiany();
            sprawa_inne_odszkodowania_zapisz_zmiany();

            if (strona_do_aktywacji != 0 || strona_do_aktywacji != '' || strona_do_aktywacji != undefined) {
                $('.str_1').attr('style', 'display:none;');
                $('.str_1').hide();
                $('.str_' + strona_do_aktywacji).attr('style', 'display:block;');
                $('.pozycje_zakladek .zakladki_element').removeClass('aktywna');
                $('.krok_' + strona_do_aktywacji).addClass('aktywna');
            }

            /*kamyk 2016-08-19*/
            sprawa_zapisz_kod_jednostki();
            sprawa_zapisz_rekomendacje();
            sprawa_informacje_o_zmarlym_zapisz_zmiany();
            sprawa_informacje_o_uprawnionym_zapisz_zmiany();
            sprawa_stosunki_rodzinne_majatkowe_zapisz_zmiany();

            /*2016-08-22*/
            sprawa_sytuacja_po_smierci_czlonka_rodziny_zapisz_zmiany();
            sprawa_oswiadczenie_zapisz_zmiany();
            sprawa_typ_umowy_zapisz_zmiany();
            sprawa_umowa_dane_zapisz_zmiany();
            blokuj_wpisanie_znakow('.dane_do_umowy_platnosc_rachunek');

        }).fail(function (ajaxContext) {
            alert(ajaxContext.responseText);
        });
}

function sprawa_umowa_dane_zapisz_zmiany() {
    $('.sprawa_spw').click(function () {
        $('.sprawa_spw').removeClass('zaznaczone');
        $(this).addClass('zaznaczone');

        if ($(this).hasClass('przekaz_pocztowyy')) {
            $('.zleceniodawca_formularz_numer_rachunku_bankowego').slideUp();
            $('.dane_do_umowy_platnosc_rachunek').val('');
        } else {
            $('.zleceniodawca_formularz_numer_rachunku_bankowego').slideDown();
        }

    });

    $('.kopiuj_adres_zleceniodawcy_kratka').click(function () {
        if ($(this).hasClass('zaznaczone')) {
            var sprawa_id = $('.umowa_do_edycji').data('id_sprawy');
            $.ajax({
                method: "POST",
                url: 'ajax/akcje/ajax_sprawa_kopiuj_adres_zleceniodawcy_do_wynagrodzenia',
                data: {
                    sprawa_id: sprawa_id

                }
            }).done(function (data) {
                var array = $.parseJSON(data);

                $('.dane_do_umowy_platnosc_rachunek').val(array[2]);
                $('.dane_do_umowy_platnosc_rachunek').attr('value', array[2]);

                $('.imie_przelew_edytuj_widok').val(array[0]);
                $('.imie_przelew_edytuj_widok').attr('value', array[0]);

                $('.wynagrodzenie_zleceniodawca_nazwisko').val(array[1]);
                $('.wynagrodzenie_zleceniodawca_nazwisko').attr('value', array[1]);

                $('.wynagrodzenie_zleceniodawca_ulica').val(array[3]);
                $('.wynagrodzenie_zleceniodawca_ulica').attr('value', array[3]);

                $('.wynagrodzenie_zleceniodawca_nr_domu').val(array[4]);
                $('.wynagrodzenie_zleceniodawca_nr_domu').attr('value', array[4]);

                $('.wynagrodzenie_zleceniodawca_nr_mieszkania').val(array[5]);
                $('.wynagrodzenie_zleceniodawca_nr_mieszkania').attr('value', array[5]);

                $('.wynagrodzenie_zleceniodawca_kod_pocztowy').val(array[6]);
                $('.wynagrodzenie_zleceniodawca_kod_pocztowy').attr('value', array[6]);

                $('.wynagrodzenie_zleceniodawca_miejscowosc').val(array[7]);
                $('.wynagrodzenie_zleceniodawca_miejscowosc').attr('value', array[7]);

                $('.kopiuj_adres_zleceniodawcy').data('id_odbiorcy', array[8]);
                $('.kopiuj_adres_zleceniodawcy').attr('data-id_odbiorcy', array[8]);

                $('.imie_przelew').attr('disabled', 'disabled');
                $('.nazwisko_przelew').attr('disabled', 'disabled');
                $('.ulica_przelew').attr('disabled', 'disabled');
                $('.dom_przelew').attr('disabled', 'disabled');
                $('.mieszkanie_przelew').attr('disabled', 'disabled');
                $('.kod_przelew').attr('disabled', 'disabled');
                $('.miejscowosc_przelew').attr('disabled', 'disabled');

            }).fail(function (ajaxContext) {
                alert(ajaxContext.responseText);
            });
        } else {

            $('.imie_przelew_edytuj_widok').val('');

            $('.wynagrodzenie_zleceniodawca_nazwisko').val('');

            $('.wynagrodzenie_zleceniodawca_ulica').val('');

            $('.wynagrodzenie_zleceniodawca_nr_domu').val('');

            $('.wynagrodzenie_zleceniodawca_nr_mieszkania').val('');

            $('.wynagrodzenie_zleceniodawca_kod_pocztowy').val('');

            $('.wynagrodzenie_zleceniodawca_miejscowosc').val('');

            $('.wynagrodzenie_do_umowy input').removeAttr('disabled');

            $('.kopiuj_adres_zleceniodawcy').data('id_odbiorcy', '0');
            $('.kopiuj_adres_zleceniodawcy').attr('data-id_odbiorcy', '0');
        }


    });

    $('.sposob_platnosci_zapisz_zmiany').click(function () {
        var sprawa_id = $('.umowa_do_edycji').data('id_sprawy');
        var forma_platnosci;

        if ($('.przekaz_pocztowyy').hasClass('zaznaczone')) {
            forma_platnosci = 'przekaz';
        }
        if ($('.przelew_bankowyy').hasClass('zaznaczone')) {
            forma_platnosci = 'przelew';
        }
        var id_odbiorcy = $('.kopiuj_adres_zleceniodawcy').data('id_odbiorcy');
        var imie = $('.wynagrodzenie_zleceniodawca_imie').val();
        var nazwisko = $('.wynagrodzenie_zleceniodawca_nazwisko').val();
        var ulica = $('.wynagrodzenie_zleceniodawca_ulica').val();
        var nr_domu = $('.wynagrodzenie_zleceniodawca_nr_domu').val();
        var nr_mieszkania = $('.wynagrodzenie_zleceniodawca_nr_mieszkania').val();
        var kod_pocztowy = $('.wynagrodzenie_zleceniodawca_kod_pocztowy').val();
        var miasto = $('.wynagrodzenie_zleceniodawca_miejscowosc').val();
        var rachunek = $('.rachunek_bankowy_edycja').val();
        

        var wymagane_pola_ilosc = $('.dane_do_umowy_pole_obowiazkowe').size();

        //alert(nazwisko);

        var i = 0;
        for (i; i < wymagane_pola_ilosc; i++) {
            if ($('.dane_do_umowy_pole_obowiazkowe')[i].value == '') {
                $('.dane_do_umowy_pole_obowiazkowe')[i].setAttribute('required', 'required');
            }

        }

        i = 0;
        for (i; i < wymagane_pola_ilosc; i++) {

            //alert($('.dane_do_umowy_pole_obowiazkowe')[i].value);

            if ($('.dane_do_umowy_pole_obowiazkowe')[i].value == '') {
                wyswitl_powiadomienie('Uzupełnij wszystkie wymagane pola!!!', 0, 0);
                return false;
            }
        }

        var kod_pocztowy_sprawdz = ($('.wynagrodzenie_zleceniodawca_kod_pocztowy').hasClass('kod_niepoprawny')) ? '1' : '0';

        if (kod_pocztowy_sprawdz == '1') {
            wyswitl_powiadomienie('Wpisz poprawny kod pocztowy!!!', 0, 0);
            return false;
        }

        $.ajax({
            method: "POST",
            url: 'ajax/akcje/ajax_sprawa_sposob_platnosci_zapisz_zmiany',
            data: {
                sprawa_id: sprawa_id,
                forma_platnosci: forma_platnosci,
                id_odbiorcy: id_odbiorcy,
                imie: imie,
                nazwisko: nazwisko,
                ulica: ulica,
                nr_domu: nr_domu,
                nr_mieszkania: nr_mieszkania,
                kod_pocztowy: kod_pocztowy,
                miasto: miasto,
                rachunek: rachunek

            }
        }).done(function (data) {

            wyswitl_powiadomienie('Zmiany zostały zapisane!!!', 1, 0);
            
      

        }).fail(function (ajaxContext) {
            document.getElementById("body_strona_r").innerHTML = ajaxContext.responseText;
        });

    });

}

function sprawa_typ_umowy_zapisz_zmiany() {
    $('.typ_umowy_zapisz_zmiany').click(function () {
        var sprawa_id = $('.umowa_do_edycji').data('id_sprawy');
        var nazwa;
        var prowizja_optima = $('.prowizja_optima').val();
        var prowizja_promedica = $('.prowizja_promedica').val();
        var prowizja_maxima = $('.prowizja_maxima').val();
        var prowizja_prima = $('.prowizja_prima').val();

        if ($('.optima').hasClass('zaznaczone')) {
            nazwa = 'optima';
            var prowizja = prowizja_optima;
        }
        if ($('.maxima').hasClass('zaznaczone')) {
            nazwa = 'maxima';
            prowizja = prowizja_maxima;
        }
        if ($('.promedica').hasClass('zaznaczone')) {
            nazwa = 'promedica';
            var prowizja = prowizja_promedica;
        }
        if ($('.prima').hasClass('zaznaczone')) {
            nazwa = 'prima';
            var prowizja = prowizja_prima;
        }

        if (prowizja == undefined) {
            wyswitl_powiadomienie('Wybierz poprawny typ umowy!!!', 0, 0);
            return false;
        }


        $.ajax({
            method: "POST",
            url: 'ajax/akcje/ajax_sprawa_typ_umowy_zapisz_zmiany',
            data: {
                sprawa_id: sprawa_id,
                nazwa: nazwa,
                prowizja: prowizja

            }
        }).done(function (data) {

            wyswitl_powiadomienie('Zmiany zostały zapisane!!!', 1, 0);

        }).fail(function (ajaxContext) {
            document.getElementById("body_strona_r").innerHTML = ajaxContext.responseText;
        });

    });
}

function sprawa_oswiadczenie_zapisz_zmiany() {
    $('.oswiadczenie_zapisz_zmiany').click(function () {
        var sprawa_id = $('.umowa_do_edycji').data('id_sprawy');
        var opis = $('.zsz_oswiadczenie_tresc').val();
        var imie = $('.ddo_imie').val();
        var nazwisko = $('.ddo_nazwisko').val();
        var ulica = $('.ddo_ulica').val();
        var nr_domu = $('.ddo_nr_domu').val();
        var nr_mieszkania = $('.ddo_nr_mieszkania').val();
        var kod_pocztowy = $('.ddo_kod_pocztowy').val();
        var miejscowosc = $('.ddo_miejscowosc').val();
        var data = $('.ddo_data').val();
        var miejscowosc_generowania = $('.ddo_miejscowosc_generowania').val();

        var imie_nazwisko = imie + ' ' + nazwisko;
        var adres = ulica + ',' + nr_domu + ',' + nr_mieszkania + ',' + kod_pocztowy + ',' + miejscowosc;

        $.ajax({
            method: "POST",
            url: 'ajax/akcje/ajax_sprawa_oswiadczenie_zapisz_zmiany',
            data: {
                sprawa_id: sprawa_id,
                opis: opis,
                miejscowosc: miejscowosc,
                imie_nazwisko: imie_nazwisko,
                adres: adres,
                data: data

            }
        }).done(function (data) {

            wyswitl_powiadomienie('Zmiany zostały zapisane!!!', 1, 0);

        }).fail(function (ajaxContext) {
            document.getElementById("body_strona_r").innerHTML = ajaxContext.responseText;
        });
    });
}

function sprawa_sytuacja_po_smierci_czlonka_rodziny_zapisz_zmiany() {
    $('.sytuacja_po_smierci_czlonka_rodziny_zapisz_zmiany').click(function () {
        var sprawa_id = $('.umowa_do_edycji').data('id_sprawy');
        var sprawa_sytuacja_majatkowa = $('.syt_p_s_rodz_mat.zaznaczone').data('syt_p_s_rodz_mat_id');
        var sprawa_motywacja = $('.syt_p_s_rodz_mot.zaznaczone').data('syt_p_s_rodz_mot_id');
        var sprawa_pozostawiona_rodzina = $('.syt_p_s_rodz_zmarl_p.zaznaczone').data('syt_p_s_rodz_zmarl_p_id');
        var sprawa_stan_psychiczny = $('.syt_p_s_rodz_wstrz.zaznaczone').data('syt_p_s_rodz_wstrz_id');
        var sprawa_stan_zdrowia = $('.syt_p_s_rodz_zdr.zaznaczone').data('syt_p_s_rodz_zdr_id');
        var liczba_dzieci = $('.ou_spscnr_zps_dz_l').val();
        var wiek_dzieci = $('.ou_spscnr_zps_dz_w').val();
        var id_porady = $('.porada_id').data('id_porady');

        var dzieci = $('.syt_p_s_rodz_zmarl_dz.zaznaczone').data('syt_p_s_rodz_zmarl_dz_id');


                  
        var sprawa_porady_1 = ($('.ou_spscnr_uk_psychiatra').hasClass('zaznaczone')) ? '1' : '0';
        var sprawa_porady_2 = ($('.ou_spscnr_uk_psycholog').hasClass('zaznaczone')) ? '1' : '0';
        var sprawa_porady_3 = ($('.ou_spscnr_uk_pedszk').hasClass('zaznaczone')) ? '1' : '0';
        var sprawa_porady_4 = ($('.ou_spscnr_uk_lpk').hasClass('zaznaczone')) ? '1' : '0';
        var sprawa_porady_5 = ($('.ou_spscnr_uk_duch').hasClass('zaznaczone')) ? '1' : '0';
        var sprawa_porady_6 = ($('.ou_spscnr_uk_rodz').hasClass('zaznaczone')) ? '1' : '0';

        if (sprawa_pozostawiona_rodzina == 1) {
            var malzonek = 1;
        } else if (sprawa_pozostawiona_rodzina == 2) {
            var malzonek = 2;
        }

        if (sprawa_sytuacja_majatkowa == undefined) {
            sprawa_sytuacja_majatkowa = '0';
        }
        if (sprawa_motywacja == undefined) {
            sprawa_motywacja = '0';
        }
        if (sprawa_pozostawiona_rodzina == undefined) {
            sprawa_pozostawiona_rodzina = '0';
        }
        if (sprawa_stan_psychiczny == undefined) {
            sprawa_stan_psychiczny = '0';
        }
        if (sprawa_stan_zdrowia == undefined) {
            sprawa_stan_zdrowia = '0';
        }
        if (dzieci != '3') {
            liczba_dzieci = '';
            wiek_dzieci = '';

        }

        var liczba_dzieci = $('.ou_spscnr_zps_dz_l').val();
        var wiek_dzieci = $('.ou_spscnr_zps_dz_w').val();

        var lata = wiek_dzieci.split(';',liczba_dzieci);

        if(lata.length != liczba_dzieci) {
            wyswitl_powiadomienie('Uzupełnij wszystkie wymagane pola!!!', 0, 0);
            return false;
        } else {
            for (var x=0; x<liczba_dzieci; x++) {

                if (lata[x] == '' || lata[x] == undefined) {
                    wyswitl_powiadomienie('Uzupełnij wszystkie wymagane pola!!!', 0, 0);
                    return false;
                }
            }
        }



        $.ajax({
            method: "POST",
            url: 'ajax/akcje/ajax_sprawa_sytuacja_po_smierci_czlonka_rodziny_zapisz_zmiany',
            data: {
                sprawa_id: sprawa_id,
                sprawa_sytuacja_majatkowa: sprawa_sytuacja_majatkowa,
                sprawa_motywacja: sprawa_motywacja,
                sprawa_pozostawiona_rodzina: dzieci,
                sprawa_stan_psychiczny: sprawa_stan_psychiczny,
                sprawa_stan_zdrowia: sprawa_stan_zdrowia,
                liczba_dzieci: liczba_dzieci,
                wiek_dzieci: wiek_dzieci,
                id_porady: id_porady,
                malzonek: malzonek,
                
                sprawa_porady_1: sprawa_porady_1,
                sprawa_porady_2: sprawa_porady_2,
                sprawa_porady_3: sprawa_porady_3,
                sprawa_porady_4: sprawa_porady_4,
                sprawa_porady_5: sprawa_porady_5,
                sprawa_porady_6: sprawa_porady_6

            }
        }).done(function (data) {

            wyswitl_powiadomienie('Zmiany zostały zapisane!!!', 1, 0);

        }).fail(function (ajaxContext) {
            document.getElementById("body_strona_r").innerHTML = ajaxContext.responseText;
        });

    });
}

function sprawa_stosunki_rodzinne_majatkowe_zapisz_zmiany() {
    $('.stosunki_rodzinne_majatkowe_zapisz_zmiany').click(function () {
        var sprawa_id = $('.umowa_do_edycji').data('id_sprawy');
        var sprawa_pokrewienstwo = $('.ou_zmar_dla_upra.zaznaczone').data('ou_zmar_dla_upra_id');
        var pokrewienstwo_tekst = $('.ou_srm_zdu_inne_rodzaj_tekst').val();
        var sprawa_stosunki_uprawnionego = $('.zm_dla_up_stosunki_u.zaznaczone').data('zm_dla_up_stosunki_u_id');
        var stosunki_mieszkaniowe_id = $('.utrzymanie_stosunki_id').data('id_stosunki');
        var utrzymanie_id = $('.utrzymanie_stosunki_id').data('id_utrzymanie');
        var sprawa_pomoc = $('.zm_dla_up_pomocc.zaznaczone').data('zm_dla_up_pomoc_id');

        
        var sprawa_utrzymanie_1 = ($('.ou_sbnu_utrz').hasClass('zaznaczone')) ? '1' : '0';
        var sprawa_utrzymanie_2 = ($('.ou_sbnu_lnmu').hasClass('zaznaczone')) ? '1' : '0';
        var sprawa_utrzymanie_3 = ($('.ou_sbnu_pwk').hasClass('zaznaczone')) ? '1' : '0';
        var sprawa_utrzymanie_4 = ($('.ou_sbnu_pkur').hasClass('zaznaczone')) ? '1' : '0';
        var sprawa_utrzymanie_5 = ($('.ou_sbnu_wfwp').hasClass('zaznaczone')) ? '1' : '0';
        
        var sprawa_stosunki_mieszkaniowe_1 = ($('.ou_srm_pzuwg').hasClass('zaznaczone')) ? '1' : '0';
        var sprawa_stosunki_mieszkaniowe_2 = ($('.ou_srm_bzptsacu').hasClass('zaznaczone')) ? '1' : '0';
        var sprawa_stosunki_mieszkaniowe_3 = ($('.ou_srm_nbzptsacu_amr').hasClass('zaznaczone')) ? '1' : '0';


        if (sprawa_pokrewienstwo == undefined) {
            sprawa_pokrewienstwo = '0';
        }

        if (sprawa_pomoc == undefined) {
            sprawa_pomoc = '0';
        }
        
        if (sprawa_stosunki_uprawnionego == undefined) {
            sprawa_stosunki_uprawnionego = '0';
        }

        $.ajax({
            method: "POST",
            url: 'ajax/akcje/ajax_sprawa_stosunki_rodzinne_majatkowe_zapisz_zmiany',
            data: {
                sprawa_id: sprawa_id,
                sprawa_pokrewienstwo: sprawa_pokrewienstwo,
                pokrewienstwo_tekst: pokrewienstwo_tekst,
                sprawa_stosunki_uprawnionego: sprawa_stosunki_uprawnionego,
                stosunki_mieszkaniowe_id: stosunki_mieszkaniowe_id,
                utrzymanie_id: utrzymanie_id,
                
                
                sprawa_utrzymanie_1: sprawa_utrzymanie_1,
                sprawa_utrzymanie_2: sprawa_utrzymanie_2,
                sprawa_utrzymanie_3: sprawa_utrzymanie_3,
                sprawa_utrzymanie_4: sprawa_utrzymanie_4,
                sprawa_utrzymanie_5: sprawa_utrzymanie_5,
 
                sprawa_stosunki_mieszkaniowe_1: sprawa_stosunki_mieszkaniowe_1,
                sprawa_stosunki_mieszkaniowe_2: sprawa_stosunki_mieszkaniowe_2,
                sprawa_stosunki_mieszkaniowe_3: sprawa_stosunki_mieszkaniowe_3,

                sprawa_pomoc: sprawa_pomoc,

            }
        }).done(function (data) {

            wyswitl_powiadomienie('Zmiany zostały zapisane!!!', 1, 0);

        }).fail(function (ajaxContext) {
            document.getElementById("body_strona_r").innerHTML = ajaxContext.responseText;
        });
    });
}

function sprawa_informacje_o_uprawnionym_zapisz_zmiany() {
    $('.informacje_o_uprawnionym_zapisz_zmiany').click(function () {
        var sprawa_id = $('.umowa_do_edycji').data('id_sprawy');
        var wiek_w_momencie_smierci = $('.ou_iu_wiek').val();
        var sprawa_wyksztalcenie = $('.ou_iu_wyksztalcenie.zaznaczone').data('wyk_id');
        var zawod_wyuczony = $('.ou_iu_z_wyuczony').val();
        var zawod_wykonywany = $('.ou_iu_z_wykonywany').val();
        var dodatkowe_kwalifikacje = $('.ou_iu_dodatkowe_k').val();
        var sprawa_zatrudnienie = $('.ou_iu_zatrudnienie.zaznaczone').data('zat_id');
        var zatrudnienie_tekst = $('.ou_iu_zat_inne_nazwa').val();
        var zarobki = $('.ou_iu_zat_pensja').val();
        
        

        if (sprawa_wyksztalcenie == undefined) {
            sprawa_wyksztalcenie = '0';
        }
        if (sprawa_zatrudnienie == undefined) {
            sprawa_zatrudnienie = '0';
        }

        $.ajax({
            method: "POST",
            url: 'ajax/akcje/ajax_sprawa_informacje_o_uprawnionym_zapisz_zmiany',
            data: {
                sprawa_id: sprawa_id,
                wiek_w_momencie_smierci: wiek_w_momencie_smierci,
                sprawa_wyksztalcenie: sprawa_wyksztalcenie,
                zawod_wyuczony: zawod_wyuczony,
                zawod_wykonywany: zawod_wykonywany,
                dodatkowe_kwalifikacje: dodatkowe_kwalifikacje,
                sprawa_zatrudnienie: sprawa_zatrudnienie,
                zatrudnienie_tekst: zatrudnienie_tekst,
                zarobki: zarobki

            }
        }).done(function (data) {

            wyswitl_powiadomienie('Zmiany zostały zapisane!!!', 1, 0);

        }).fail(function (ajaxContext) {
            document.getElementById("body_strona_r").innerHTML = ajaxContext.responseText;
        });
    });
}

function sprawa_informacje_o_zmarlym_zapisz_zmiany() {
    $('.informacje_o_zmarlym_zapisz_zmiany').click(function () {
        var sprawa_id = $('.umowa_do_edycji').data('id_sprawy');
        var wiek_w_momencie_smierci = $('.ou_iz_wiek').val();
        var sprawa_wyksztalcenie = $('.ou_iz_wyksztalcenie.zaznaczone').data('wyk_id');
        var zawod_wyuczony = $('.ou_iz_z_wyuczony').val();
        var zawod_wykonywany = $('.ou_iz_z_wykonywany').val();
        var dodatkowe_kwalifikacje = $('.ou_iz_dodatkowe_k').val();
        var sprawa_zatrudnienie = $('.ou_iz_zatrudnienie.zaznaczone').data('zat_id');
        var zatrudnienie_tekst = $('.ou_iz_zat_inne_nazwa ').val();
        var zarobki = $('.ou_iz_zat_pensja').val();

        if (sprawa_wyksztalcenie == undefined) {
            sprawa_wyksztalcenie = '0';
        }
        if (sprawa_zatrudnienie == undefined) {
            sprawa_zatrudnienie = '0';
        }

        $.ajax({
            method: "POST",
            url: 'ajax/akcje/ajax_sprawa_informacje_o_zmarlym_zapisz_zmiany',
            data: {
                sprawa_id: sprawa_id,
                wiek_w_momencie_smierci: wiek_w_momencie_smierci,
                sprawa_wyksztalcenie: sprawa_wyksztalcenie,
                zawod_wyuczony: zawod_wyuczony,
                zawod_wykonywany: zawod_wykonywany,
                dodatkowe_kwalifikacje: dodatkowe_kwalifikacje,
                sprawa_zatrudnienie: sprawa_zatrudnienie,
                zatrudnienie_tekst: zatrudnienie_tekst,
                zarobki: zarobki

            }
        }).done(function (data) {

            wyswitl_powiadomienie('Zmiany zostały zapisane!!!', 1, 0);

        }).fail(function (ajaxContext) {
            document.getElementById("body_strona_r").innerHTML = ajaxContext.responseText;
        });

    });
}

function sprawa_inne_odszkodowania_zapisz_zmiany() {
    $('.inne_odszkodowania_zapisz_zmiany').click(function () {
        var sprawa_id = $('.umowa_do_edycji').data('id_sprawy');
        var inne_odszkodowania_zgloszono_nnw = ($('.io_zgloszono_nnw').hasClass('zaznaczone')) ? '1' : '0';
        var inne_odszkodowania_komu_zgloszono = $('.io_zgloszono_nnw_nazwa').val();
        var inne_odszkodowania_jaki_wypadek;
        var inne_odszkodowania_gdzie_zgloszono;
        var inne_odszkodowania_inne_tekst = $('.io_wypadek_zgloszono_inne_nazwa').val();
        var inne_odszkodowania_zasilek_pogrzebowy = ($('.io_przyznano_zasilek_p').hasClass('zaznaczone')) ? '1' : '0';
        var inne_odszkodowania_oferta_finansowa = ($('.zsz_pf').hasClass('zaznaczone')) ? '1' : '0';
        var inne_odszkodowania_gamma = ($('.zsz_gamma').hasClass('zaznaczone')) ? '1' : '0';
        var inne_odszkodowania_dzialalnosc = ($('.zsz_dzialalnosc').hasClass('zaznaczone')) ? '1' : '0';
        var inne_odszkodowania_pcrf = ($('.zsz_pcrf').hasClass('zaznaczone')) ? '1' : '0';
        var inne_odszkodowania_fundacja = ($('.zsz_fundacja').hasClass('zaznaczone')) ? '1' : '0';
     
        var inne_odszkodowania_uszczerbek_nnw = ($('.io_uszczerbek_nnw').hasClass('zaznaczone')) ? '1' : '0';
        var inne_odszkodowania_uszczerbek_procent_nnw = $('.io_procent_uszczerbku_nnw').val();      
        var inne_odszkodowania_ubezp_procent_uszczerbku = $('.io_procent_uszczerbku').val();
        var inne_odszkodowania_jednorazowe_odszkodowanie = ($('.jednorazowe_odszkodowanie').hasClass('zaznaczone')) ? '1' : '0';
        var inne_odszkodowania_kwota_odszkodowania = $('.io_kwota_odszkodowania').val();       
        var inne_odszkodowania_zwolnienie = ($('.zwolnienie_lekarskie').hasClass('zaznaczone')) ? '1' : '0';
        var inne_odszkodowania_zwolnienie_od = $('.data_niezdolnosci_od').val();
        var inne_odszkodowania_zwolnienie_do = $('.data_niezdolnosci_do').val();
        var inne_odszkodowania_orzeczenie = ($('.io_orzeczenie').hasClass('zaznaczone')) ? '1' : '0';
        
        $('.od_kiedy_l4').attr('value', inne_odszkodowania_zwolnienie_od);
        $('.do_kiedy_l4').attr('value', inne_odszkodowania_zwolnienie_do);
        
        var kratka_do_kiedy = $('.do_kiedy_l4').val();   
        
        if(kratka_do_kiedy != '') {
            $('.lecz_na_zwolnieniu_do').addClass('zaznaczone');
            $('.lecz_na_zwolnieniu').removeClass('zaznaczone');
        }
        
        var inne_odszkodowania_orzeczenie_id = 0;
        
        if ($('.io_calkowite').hasClass('zaznaczone')) {
            inne_odszkodowania_orzeczenie_id = '1';
        } else if ($('.io_czesciowe').hasClass('zaznaczone')) {
            inne_odszkodowania_orzeczenie_id = '2';
        } else if ($('.io_trwale').hasClass('zaznaczone')) {
            inne_odszkodowania_orzeczenie_id = '3';
        } else if ($('.io_okresowe').hasClass('zaznaczone')) {
            inne_odszkodowania_orzeczenie_id = '4';
            var inne_odszkodowania_orzeczenie_do = $('.io_okresowe_data').val();
        }
       
        var inne_odszkodowania_ubezpieczyciel_id = 0;
        
        if ($('.io_zus').hasClass('zaznaczone')) {
            inne_odszkodowania_ubezpieczyciel_id = '1';
        } else if ($('.io_krus').hasClass('zaznaczone')) {
            inne_odszkodowania_ubezpieczyciel_id = '2';
        } else if ($('.io_inne').hasClass('zaznaczone')) {
            inne_odszkodowania_ubezpieczyciel_id = '3';
            var inne_odszkodowania_inne_nazwa = $('.io_inne_nazwa').val();
        }

        var inne_odszkodowania_swiadczenie_id = 0;
        
        if ($('.io_renta').hasClass('zaznaczone')) {
            inne_odszkodowania_swiadczenie_id = '1';
        } else if ($('.io_inne_swiadczenie').hasClass('zaznaczone')) {
            inne_odszkodowania_swiadczenie_id = '2';
            var inne_odszkodowania_swiadczenie_inne_nazwa = $('.io_inne_swiadczenie_nazwa').val();
        }
        
        var inne_odszkodowania_kwota_swiadczenia = $('.io_kwota_swiadczenia').val();
        var inne_odszkodowania_data_swiadczenia = $('.io_okres_swiadczenia').val();

        if ($('.io_wypadek_przy_pracy').hasClass('zaznaczone')) {
            inne_odszkodowania_jaki_wypadek = '1';
        }

        if ($('.io_wypadek_w_drodze_do_pracy').hasClass('zaznaczone')) {
            inne_odszkodowania_jaki_wypadek = '2';
        }

        if ($('.io_wypadek_zgloszono_zus').hasClass('zaznaczone')) {
            inne_odszkodowania_gdzie_zgloszono = '1';
        }

        if ($('.io_wypadek_zgloszono_krus').hasClass('zaznaczone')) {
            inne_odszkodowania_gdzie_zgloszono = '2';
        }

        if ($('.io_wypadek_zgloszono_inne').hasClass('zaznaczone')) {
            inne_odszkodowania_gdzie_zgloszono = '3';
        }
        
        $.ajax({
            method: "POST",
            url: 'ajax/akcje/ajax_sprawa_inne_odszkodowania_zapisz_zmiany',
            data: {
                sprawa_id: sprawa_id,
                inne_odszkodowania_zgloszono_nnw: inne_odszkodowania_zgloszono_nnw,
                inne_odszkodowania_komu_zgloszono: inne_odszkodowania_komu_zgloszono,
                inne_odszkodowania_jaki_wypadek: inne_odszkodowania_jaki_wypadek,
                inne_odszkodowania_gdzie_zgloszono: inne_odszkodowania_gdzie_zgloszono,
                inne_odszkodowania_inne_tekst: inne_odszkodowania_inne_tekst,
                inne_odszkodowania_zasilek_pogrzebowy: inne_odszkodowania_zasilek_pogrzebowy,
                inne_odszkodowania_oferta_finansowa: inne_odszkodowania_oferta_finansowa,
                inne_odszkodowania_gamma: inne_odszkodowania_gamma,
                inne_odszkodowania_dzialalnosc: inne_odszkodowania_dzialalnosc,
                inne_odszkodowania_pcrf: inne_odszkodowania_pcrf,
                inne_odszkodowania_fundacja: inne_odszkodowania_fundacja,
                
                inne_odszkodowania_uszczerbek_nnw: inne_odszkodowania_uszczerbek_nnw,
                inne_odszkodowania_uszczerbek_procent_nnw: inne_odszkodowania_uszczerbek_procent_nnw,
                inne_odszkodowania_ubezp_procent_uszczerbku: inne_odszkodowania_ubezp_procent_uszczerbku,
                inne_odszkodowania_jednorazowe_odszkodowanie: inne_odszkodowania_jednorazowe_odszkodowanie,
                inne_odszkodowania_kwota_odszkodowania: inne_odszkodowania_kwota_odszkodowania,
                inne_odszkodowania_zwolnienie: inne_odszkodowania_zwolnienie,
                inne_odszkodowania_zwolnienie_od: inne_odszkodowania_zwolnienie_od,
                inne_odszkodowania_zwolnienie_do: inne_odszkodowania_zwolnienie_do,
                inne_odszkodowania_orzeczenie: inne_odszkodowania_orzeczenie,
                inne_odszkodowania_orzeczenie_id: inne_odszkodowania_orzeczenie_id,
                inne_odszkodowania_orzeczenie_do: inne_odszkodowania_orzeczenie_do,
                inne_odszkodowania_ubezpieczyciel_id: inne_odszkodowania_ubezpieczyciel_id,
                inne_odszkodowania_inne_nazwa: inne_odszkodowania_inne_nazwa,
                inne_odszkodowania_swiadczenie_id: inne_odszkodowania_swiadczenie_id,
                inne_odszkodowania_swiadczenie_inne_nazwa: inne_odszkodowania_swiadczenie_inne_nazwa,
                inne_odszkodowania_kwota_swiadczenia: inne_odszkodowania_kwota_swiadczenia,
                inne_odszkodowania_data_swiadczenia: inne_odszkodowania_data_swiadczenia
            }
        }).done(function (data) {
            
            //alert(data);

            $('.inne_odszkodowania_id').attr('data-inne_odszkodowania_id', data);
            $('.inne_odszkodowania_id').data('inne_odszkodowania_id', data);

            wyswitl_powiadomienie('Zmiany zostały zapisane!!!', 1, 0);

        }).fail(function (ajaxContext) {
            document.getElementById("body_strona_r").innerHTML = ajaxContext.responseText;
        });

    });
}

function sprawa_dochodzenie_roszczen_zapisz_zmiany() {
    $('.dochodzenie_roszczen_zapisz_zmiany').click(function () {
        var sprawa_id = $('.umowa_do_edycji').data('id_sprawy');
        var dochodzenie_roszczen_czy_zlecono = ($('.dr_nie_zlecano_innym').hasClass('zaznaczone')) ? '0' : '1';
        var dochodzenie_roszczen_komu_zlecono = $('.dr_zlecono_sprawe_o_o').val();
        var dochodzenie_roszczen_kiedy_zlecono = $('.dr_zs_data_umowy').val();
        var dochodzenie_roszczen_czy_wypowiedziano = ($('.dr_zs_wypowiedziano_umowe_opcja').hasClass('zaznaczone')) ? '1' : '0';
        var dochodzenie_roszczen_kiedy_wypowiedziano = $('.dr_zs_wypowiedziano_umowe_data').val();
        /* medyk 12-09-2016 */
        var dochodzenie_roszczen_ile_kart = $('.dr_ile_kart').val();
        var dochodzenie_roszczen_inf_sms = ($('.dr_sms').hasClass('zaznaczone')) ? '1' : '0';
        var dochodzenie_roszczen_inf_email = ($('.dr_email').hasClass('zaznaczone')) ? '1' : '0';

        var zgoda = ($('.dr_zgoda_tak').hasClass('zaznaczone')) ? '1' : '0';
        
        if (zgoda == 1) {
            if (dochodzenie_roszczen_inf_sms == 0) {
        	if (dochodzenie_roszczen_inf_email == 0) {
            		wyswitl_powiadomienie('Wybierz formę otrzymywania informacji !!!', 0, 0);
                    return false;
            	}
            }
        }

        $.ajax({
            method: "POST",
            url: 'ajax/akcje/ajax_sprawa_dochodzenie_roszczen_zapisz_zmiany',
            data: {
                sprawa_id: sprawa_id,
                dochodzenie_roszczen_czy_zlecono: dochodzenie_roszczen_czy_zlecono,
                dochodzenie_roszczen_komu_zlecono: dochodzenie_roszczen_komu_zlecono,
                dochodzenie_roszczen_kiedy_zlecono: dochodzenie_roszczen_kiedy_zlecono,
                dochodzenie_roszczen_czy_wypowiedziano: dochodzenie_roszczen_czy_wypowiedziano,
                dochodzenie_roszczen_kiedy_wypowiedziano: dochodzenie_roszczen_kiedy_wypowiedziano,
                dochodzenie_roszczen_inf_sms: dochodzenie_roszczen_inf_sms,
                dochodzenie_roszczen_inf_email: dochodzenie_roszczen_inf_email,
                dochodzenie_roszczen_ile_kart: dochodzenie_roszczen_ile_kart

            }
        }).done(function (data) {

            $('.dochodzenie_roszczen_id').attr('data-dochodzenie_roszczen_id', data);
            $('.dochodzenie_roszczen_id').data('dochodzenie_roszczen_id', data);

            wyswitl_powiadomienie('Zmiany zostały zapisane!!!', 1, 0);

        }).fail(function (ajaxContext) {
            document.getElementById("body_strona_r").innerHTML = ajaxContext.responseText;
        });

    });
}

function sprawa_odpowiedzialnosc_cywilna_zapisz_zmiany() {
    $('.odpowiedzialnosc_cywilna_zapisz_zmiany').click(function () {

        var sprawa_id = $('.umowa_do_edycji').data('id_sprawy');

        var odpowiedzialnosc_cywilna_nr_szkody = $('.oc_nr_szkody').val();
        var odpowiedzialnosc_cywilna_zgl_szkode_w_poj = ($('.oc_zgloszono_szp').hasClass('zaznaczone')) ? '1' : '0';
        var odpowiedzialnosc_cywilna_data_zgl_w_poj = $('.oc_zgloszono_szp_data').val();
        var odpowiedzialnosc_cywilna_zgl_szkode_na_os = ($('.oc_zgloszono_szo').hasClass('zaznaczone')) ? '1' : '0';
        var odpowiedzialnosc_cywilna_data_zgl_na_os = $('.oc_zgloszono_szo_data').val();
        var odpowiedzialnosc_cywilna_co_z_oc;
        var odpowiedzialnosc_cywilna_kwota = $('.oc_wyplacono_szo_kwota').val();
        var odpowiedzialnosc_cywilna_podstawa;
        var odpowiedzialnosc_cywilna_data_decyzji = $('.on_wyplacono_szo_data').val();

        if ($('.oc_odszkodowanie_oc_p_nie_wyplacono').hasClass('zaznaczone')) {
            odpowiedzialnosc_cywilna_co_z_oc = '1';
        }

        if ($('.oc_odszkodowanie_oc_p_wyplacono').hasClass('zaznaczone')) {
            odpowiedzialnosc_cywilna_co_z_oc = '2';
        }

        if ($('.oc_wyplacono_szo').hasClass('zaznaczone')) {
            odpowiedzialnosc_cywilna_co_z_oc = '3';
        }

        if ($('.on_wyplacono_szo_ugoda').hasClass('zaznaczone')) {
            odpowiedzialnosc_cywilna_podstawa = '1';
        }

        if ($('.on_wyplacono_szo_wyrok').hasClass('zaznaczone')) {
            odpowiedzialnosc_cywilna_podstawa = '2';
        }

        if ($('.on_wyplacono_szo_decyzja_zd').hasClass('zaznaczone')) {
            odpowiedzialnosc_cywilna_podstawa = '3';
        }

        if ($('.on_wyplacono_szo_nie_wiem').hasClass('zaznaczone')) {
            odpowiedzialnosc_cywilna_podstawa = '4';
        }

        $.ajax({
            method: "POST",
            url: 'ajax/akcje/ajax_sprawa_odpowiedzialnosc_cywilna_zapisz_zmiany',
            data: {
                sprawa_id: sprawa_id,
                odpowiedzialnosc_cywilna_nr_szkody: odpowiedzialnosc_cywilna_nr_szkody,
                odpowiedzialnosc_cywilna_zgl_szkode_w_poj: odpowiedzialnosc_cywilna_zgl_szkode_w_poj,
                odpowiedzialnosc_cywilna_data_zgl_w_poj: odpowiedzialnosc_cywilna_data_zgl_w_poj,
                odpowiedzialnosc_cywilna_zgl_szkode_na_os: odpowiedzialnosc_cywilna_zgl_szkode_na_os,
                odpowiedzialnosc_cywilna_data_zgl_na_os: odpowiedzialnosc_cywilna_data_zgl_na_os,
                odpowiedzialnosc_cywilna_co_z_oc: odpowiedzialnosc_cywilna_co_z_oc,
                odpowiedzialnosc_cywilna_kwota: odpowiedzialnosc_cywilna_kwota,
                odpowiedzialnosc_cywilna_podstawa: odpowiedzialnosc_cywilna_podstawa,
                odpowiedzialnosc_cywilna_data_decyzji: odpowiedzialnosc_cywilna_data_decyzji

            }
        }).done(function (data) {

            $('.odpowiedzialnosc_cywilna_id').attr('data-odpowiedzialnosc_cywilna_id', data);
            $('.odpowiedzialnosc_cywilna_id').data('odpowiedzialnosc_cywilna_id', data);

            wyswitl_powiadomienie('Zmiany zostały zapisane!!!', 1, 0);

        }).fail(function (ajaxContext) {
            document.getElementById("body_strona_r").innerHTML = ajaxContext.responseText;
        });

    });
}

function sprawa_odpowiedzialnosc_karna_zapisz_zmiany() {
    $('.odpowiedzialnosc_karna_zapisz_zmiany').click(function () {

        var sprawa_id = $('.umowa_do_edycji').data('id_sprawy');

        var odpowiedzialnosc_karna_sygnatura_akt = $('.ok_sygnatura_akt').val();
        var odpowiedzialnosc_karna_oswiadczenie = ($('.ok_sprawca_napisal_oswiadczenie').hasClass('zaznaczone')) ? '1' : '0';

        var odpowiedzialnosc_karna_wezwano_policje = ($('.ok_wezwano_policje').hasClass('zaznaczone')) ? '1' : '0';
        var odpowiedzialnosc_karna_skad_policja = '';
        if (odpowiedzialnosc_karna_wezwano_policje == '1') {
            odpowiedzialnosc_karna_skad_policja = $('.ok_wp_miejsce').val();
        }

        var odpowiedzialnosc_karna_wszczeto_postepowanie = ($('.ok_wszczeto_postepowanie').hasClass('zaznaczone')) ? '1' : '0';

        var odpowiedzialnosc_karna_zarzut = ($('.ok_postawiono_sprawcy_zarzut').hasClass('zaznaczone')) ? '1' : '0';
        var odpowiedzialnosc_karna_zarzut_z_art = '';
        if (odpowiedzialnosc_karna_zarzut == '1') {
            odpowiedzialnosc_karna_zarzut_z_art = $('.ok_psz_artykul').val();
        }

        var odpowiedzialnosc_karna_umorzono = ($('.ok_postepowanie_karne_umorzono').hasClass('zaznaczone')) ? '1' : '0';
        var odpowiedzialnosc_karna_umorz_na_podst = '';
        if (odpowiedzialnosc_karna_umorzono == '1') {
            odpowiedzialnosc_karna_umorz_na_podst = $('.ok_pku_artykul').val();
        }

        var odpowiedzialnosc_karna_do_sadu = ($('.ok_skierowano_akt_do_sadu').hasClass('zaznaczone')) ? '1' : '0';
        var odpowiedzialnosc_karna_nazwa_sadu = '';
        if (odpowiedzialnosc_karna_do_sadu == '1') {
            odpowiedzialnosc_karna_nazwa_sadu = $('.ok_sads_pelna_nazwa_sadu').val();
        }

        var odpowiedzialnosc_karna_czy_wyrok = ($('.ok_zapadl_wyrok').hasClass('zaznaczone')) ? '1' : '0';
        var odpowiedzialnosc_karna_skazujacy = '0';
        var odpowiedzialnosc_karna_uniewinniajacy = '0';
        var odpowiedzialnosc_karna_wyrok_z_art = '';
        if (odpowiedzialnosc_karna_czy_wyrok == '1') {
            odpowiedzialnosc_karna_skazujacy = ($('.ok_zw_skazujacy').hasClass('zaznaczone')) ? '1' : '0';
            odpowiedzialnosc_karna_uniewinniajacy = ($('.ok_zw_uniewinniajacy').hasClass('zaznaczone')) ? '1' : '0';
            odpowiedzialnosc_karna_wyrok_z_art = $('.ok_zw_u_artykul').val();
        }

        $.ajax({
            method: "POST",
            url: 'ajax/akcje/ajax_sprawa_odpowiedzialnosc_karna_zapisz_zmiany',
            data: {
                sprawa_id: sprawa_id,
                odpowiedzialnosc_karna_sygnatura_akt: odpowiedzialnosc_karna_sygnatura_akt,
                odpowiedzialnosc_karna_oswiadczenie: odpowiedzialnosc_karna_oswiadczenie,
                odpowiedzialnosc_karna_wezwano_policje: odpowiedzialnosc_karna_wezwano_policje,
                odpowiedzialnosc_karna_skad_policja: odpowiedzialnosc_karna_skad_policja,
                odpowiedzialnosc_karna_wszczeto_postepowanie: odpowiedzialnosc_karna_wszczeto_postepowanie,
                odpowiedzialnosc_karna_zarzut: odpowiedzialnosc_karna_zarzut,
                odpowiedzialnosc_karna_zarzut_z_art: odpowiedzialnosc_karna_zarzut_z_art,
                odpowiedzialnosc_karna_umorzono: odpowiedzialnosc_karna_umorzono,
                odpowiedzialnosc_karna_umorz_na_podst: odpowiedzialnosc_karna_umorz_na_podst,
                odpowiedzialnosc_karna_do_sadu: odpowiedzialnosc_karna_do_sadu,
                odpowiedzialnosc_karna_nazwa_sadu: odpowiedzialnosc_karna_nazwa_sadu,
                odpowiedzialnosc_karna_czy_wyrok: odpowiedzialnosc_karna_czy_wyrok,
                odpowiedzialnosc_karna_skazujacy: odpowiedzialnosc_karna_skazujacy,
                odpowiedzialnosc_karna_uniewinniajacy: odpowiedzialnosc_karna_uniewinniajacy,
                odpowiedzialnosc_karna_wyrok_z_art: odpowiedzialnosc_karna_wyrok_z_art



            }
        }).done(function (data) {

            $('.odpowiedzialnosc_karna_id').attr('data-odpowiedzialnosc_karna_id', data);
            $('.odpowiedzialnosc_karna_id').data('odpowiedzialnosc_karna_id', data);

            wyswitl_powiadomienie('Zmiany zostały zapisane!!!', 1, 0);

        }).fail(function (ajaxContext) {
            document.getElementById("body_strona_r").innerHTML = ajaxContext.responseText;
        });

    });
}

function sprawa_informacje_o_zdarzeniu_zapisz_zmiany() {
    $('.informacje_o_zdarzeniu_zapisz_zmiany').click(function () {

        var sprawa_id = $('.umowa_do_edycji').data('id_sprawy');
        var zdarzenie_data = $('.data_wypadku').val();
        var zdarzenie_godzina = $('.godzina_wypadku').val();
        var zdarzenie_miejsce = $('.miejsce_zdarzenia').val();

        var zdarzenie_marka_a = $('.pojazd_a_marka').val();
        var zdarzenie_typ_pojazdu_a = $('.pojazd_a_model').val();
        var zdarzenie_nr_rejestracyjny_a = $('.pojazd_a_nr_rejestracyjny').val();
        var zdarzenie_kraj_rejestracji_a = $('.pojazd_a_kraj_rejestracji').val();
        var zdarzenie_kierujacy_a = $('.pojazd_a_kierujacy_pojazdem').val();
        var zdarzenie_posiadacz_a = $('.pojazd_a_posiadacz_pojazdu').val();
        var zdarzenie_ubezpieczyciel_a = $('.pojazd_a_uoc_posiadacz_pojazdu').val();
        var zdarzenie_nr_oc_a = $('.pojazd_a_nr_polisy_oc').val();

        var zdarzenie_marka_b = $('.pojazd_b_marka').val();
        var zdarzenie_typ_pojazdu_b = $('.pojazd_b_model').val();
        var zdarzenie_nr_rejestracyjny_b = $('.pojazd_b_nr_rejestracyjny').val();
        var zdarzenie_kraj_rejestracji_b = $('.pojazd_b_kraj_rejestracji').val();
        var zdarzenie_kierujacy_b = $('.pojazd_b_kierujacy_pojazdem').val();
        var zdarzenie_posiadacz_b = $('.pojazd_b_posiadacz_pojazdu').val();
        var zdarzenie_ubezpieczyciel_b = $('.pojazd_b_uoc_posiadacz_pojazdu').val();
        var zdarzenie_nr_oc_b = $('.pojazd_b_nr_polisy_oc').val();
        
        var zdarzenie_2_pojazdy = ($('.pojazd_a_k_b_k_kratka').hasClass('zaznaczone')) ? '1' : '0';
        var zdarzenie_pieszy_rowerzysta = ($('.pojazd_b_k_kratka').hasClass('zaznaczone')) ? '1' : '0';
        var zdarzenie_niekomunikacyjne = ($('.pojazd_c_k_kratka').hasClass('zaznaczone')) ? '1' : '0';
        
        if (zdarzenie_2_pojazdy == '1') {
            var rodzaj_zdarzenia = 1;
        } else if (zdarzenie_pieszy_rowerzysta == '1') {
            var rodzaj_zdarzenia = 2;
        } else if (zdarzenie_niekomunikacyjne == '1') {
            var rodzaj_zdarzenia = 3;
        }

        var zdarzenie_stosunek_poj_a;
        if ($('.dr_s_do_a_obcy').hasClass('zaznaczone')) {
            zdarzenie_stosunek_poj_a = '1';
        }
        if ($('.dr_s_do_a_rodzina').hasClass('zaznaczone')) {
            zdarzenie_stosunek_poj_a = '2';
        }
        if ($('.stos_a_inny').hasClass('zaznaczone')) {
            zdarzenie_stosunek_poj_a = '3';
        }
        var zdarzenie_stosunek_poj_a_tekst = $('.stos_a_inny_rodzaj').val();

        var zdarzenie_stosunek_poj_b;
        if ($('.dr_s_do_b_obcy').hasClass('zaznaczone')) {
            zdarzenie_stosunek_poj_b = '1';
        }
        if ($('.dr_s_do_b_rodzina').hasClass('zaznaczone')) {
            zdarzenie_stosunek_poj_b = '2';
        }
        if ($('.stos_b_inny').hasClass('zaznaczone')) {
            zdarzenie_stosunek_poj_b = '3';
        }
        var zdarzenie_stosunek_poj_b_tekst = $('.stos_b_inny_rodzaj').val();

        var zdarzenie_opis = $('.opis_zdarzenia').val();
        
        var obrazenia_opis = $('.opis_obrazen').val();
        


        $.ajax({
            method: "POST",
            url: 'ajax/akcje/ajax_sprawa_informacje_o_zdarzeniu_zapisz_zmiany',
            data: {
                sprawa_id: sprawa_id,
                zdarzenie_data: zdarzenie_data,
                zdarzenie_godzina: zdarzenie_godzina,
                zdarzenie_miejsce: zdarzenie_miejsce,
                zdarzenie_marka_a: zdarzenie_marka_a,
                zdarzenie_typ_pojazdu_a: zdarzenie_typ_pojazdu_a,
                zdarzenie_nr_rejestracyjny_a: zdarzenie_nr_rejestracyjny_a,
                zdarzenie_kraj_rejestracji_a: zdarzenie_kraj_rejestracji_a,
                zdarzenie_kierujacy_a: zdarzenie_kierujacy_a,
                zdarzenie_posiadacz_a: zdarzenie_posiadacz_a,
                zdarzenie_ubezpieczyciel_a: zdarzenie_ubezpieczyciel_a,
                zdarzenie_nr_oc_a: zdarzenie_nr_oc_a,
                zdarzenie_marka_b: zdarzenie_marka_b,
                zdarzenie_typ_pojazdu_b: zdarzenie_typ_pojazdu_b,
                zdarzenie_nr_rejestracyjny_b: zdarzenie_nr_rejestracyjny_b,
                zdarzenie_kraj_rejestracji_b: zdarzenie_kraj_rejestracji_b,
                zdarzenie_kierujacy_b: zdarzenie_kierujacy_b,
                zdarzenie_posiadacz_b: zdarzenie_posiadacz_b,
                zdarzenie_ubezpieczyciel_b: zdarzenie_ubezpieczyciel_b,
                zdarzenie_nr_oc_b: zdarzenie_nr_oc_b,
                zdarzenie_stosunek_poj_a: zdarzenie_stosunek_poj_a,
                zdarzenie_stosunek_poj_a_tekst: zdarzenie_stosunek_poj_a_tekst,
                zdarzenie_stosunek_poj_b: zdarzenie_stosunek_poj_b,
                zdarzenie_stosunek_poj_b_tekst: zdarzenie_stosunek_poj_b_tekst,
                zdarzenie_opis: zdarzenie_opis,
                obrazenia_opis: obrazenia_opis,
                rodzaj_zdarzenia: rodzaj_zdarzenia

            }
        }).done(function (data) {
            
            $('.info_o_zdarzeniu_id').attr('data-informacje_o_zdarzeniu_id', data);
            $('.info_o_zdarzeniu_id').data('informacje_o_zdarzeniu_id', data);

            wyswitl_powiadomienie('Zmiany zostały zapisane!!!', 1, 0);

        }).fail(function (ajaxContext) {
            document.getElementById("body_strona_r").innerHTML = ajaxContext.responseText;
        });

    });
}

function sprawa_uprawniony_do_inf_zapisz_zmiany() {
    $('.uprawniony_do_inf_zapisz_zmiany').click(function () {
        var uprawniony_do_inf_id = $('.uprawniony_do_informacji_id').data('uprawniony_do_inf_id');

        var akcja;
        if (uprawniony_do_inf_id == '' || uprawniony_do_inf_id == undefined) {
            akcja = 'dodaj';
        } else {
            akcja = 'edytuj';
        }

        var sprawa_id = $('.umowa_do_edycji').data('id_sprawy');
        var typ_osoba = '4';
        var uprawniony_imie = $('.uprawniony_informacje_imie').val();
        var uprawniony_nazwisko = $('.uprawniony_informacje_nazwisko').val();
        var uprawniony_pesel = $('.uprawniony_informacje_pesel').val();

        $.ajax({
            method: "POST",
            url: 'ajax/akcje/ajax_sprawa_uprawniony_do_inf_zapisz',
            data: {
                uprawniony_imie: uprawniony_imie,
                uprawniony_nazwisko: uprawniony_nazwisko,
                uprawniony_pesel: uprawniony_pesel,
                typ_osoba: typ_osoba,
                sprawa_id: sprawa_id,
                uprawniony_do_inf_id: uprawniony_do_inf_id,
                akcja: akcja

            }
        }).done(function (data) {

            $('.uprawniony_do_informacji_id').attr('data-uprawniony_do_inf_id', data);
            $('.uprawniony_do_informacji_id').data('uprawniony_do_inf_id', data);

            wyswitl_powiadomienie('Zmiany zostały zapisane!!!', 1, 0);

        }).fail(function (ajaxContext) {
            document.getElementById("body_strona_r").innerHTML = ajaxContext.responseText;
        });
    });
}

function sprawa_uprawniony_zapisz_zmiany() {
    $('.uprawniony_zapisz_zmiany').click(function () {

        var sprawa_id = $('.umowa_do_edycji').data('id_sprawy');
        var typ_osoba = '3';
        var uprawniony_imie = $('.uprawniony_imie').val();
        var uprawniony_nazwisko = $('.uprawniony_nazwisko').val();

        var uprawniony_ulica = $('.uprawniony_ulica').val();
        var uprawniony_nr_domu = $('.uprawniony_nr_domu').val();
        var uprawniony_nr_mieszkania = $('.uprawniony_nr_mieszkania').val();
        var uprawniony_kod_pocztowy = $('.uprawniony_kod_pocztowy').val();
        var uprawniony_miasto = $('.uprawniony_miejscowosc').val();

        var uprawniony_obcokrajowiec;
        var uprawniony_pesel = '';
        var uprawniony_dowod = '';
        var uprawniony_rodzaj_dokumentu = '';
        var uprawniony_nr_dokumentu = '';

        if ($('.obcokrajowiec_tak').hasClass('zaznaczone')) {
            uprawniony_obcokrajowiec = 1;
            uprawniony_rodzaj_dokumentu = $('.uprawniony_dokument').val();
            uprawniony_nr_dokumentu = $('.uprawniony_numer_dokumentu').val();
        }

        if ($('.obcokrajowiec_nie').hasClass('zaznaczone')) {
            uprawniony_obcokrajowiec = 0;
            uprawniony_pesel = $('.uprawniony_pesel').val();
            uprawniony_dowod = $('.uprawniony_seria_i_numer_dowodu').val();
        }

        var uprawniony_email = $('.uprawniony_email').val();
        var uprawniony_telefon = $('.uprawniony_telefon').val();

        var jest_uprawniony = ($('.uprawniony_formularz_kratka_kratka').hasClass('zaznaczone')) ? '1' : '0';

        if (jest_uprawniony == '1' && (uprawniony_imie == '' || uprawniony_nazwisko == '' || uprawniony_ulica == '' || uprawniony_nr_domu == '' || uprawniony_nr_domu == '' || uprawniony_kod_pocztowy == '')) {
            wyswitl_powiadomienie('Uzupełnij wszystkie dane poszkodowanego!!!', 0, 0);
            return false;
        }

        if (jest_uprawniony == '1' && uprawniony_obcokrajowiec == 1 && (uprawniony_rodzaj_dokumentu == '' || uprawniony_nr_dokumentu == '' )) {
            wyswitl_powiadomienie('Uzupełnij dane identyfikacyjne poszkodowanego!!!', 0, 0);
            return false;
        }

        if (jest_uprawniony == '1' && uprawniony_obcokrajowiec == 0 && (uprawniony_pesel == '' || uprawniony_dowod == '' )) {
            wyswitl_powiadomienie('Uzupełnij dane identyfikacyjne poszkodowanego!!!', 0, 0);
            return false;
        }

        $.ajax({
            method: "POST",
            url: 'ajax/akcje/ajax_sprawa_uprawniony_zapisz_zmiany',
            data: {
                uprawniony_imie: uprawniony_imie,
                uprawniony_nazwisko: uprawniony_nazwisko,
                uprawniony_ulica: uprawniony_ulica,
                uprawniony_nr_domu: uprawniony_nr_domu,
                uprawniony_nr_mieszkania: uprawniony_nr_mieszkania,
                uprawniony_kod_pocztowy: uprawniony_kod_pocztowy,
                uprawniony_miasto: uprawniony_miasto,
                uprawniony_obcokrajowiec: uprawniony_obcokrajowiec,
                uprawniony_pesel: uprawniony_pesel,
                uprawniony_dowod: uprawniony_dowod,
                uprawniony_rodzaj_dokumentu: uprawniony_rodzaj_dokumentu,
                uprawniony_nr_dokumentu: uprawniony_nr_dokumentu,
                uprawniony_email: uprawniony_email,
                uprawniony_telefon: uprawniony_telefon,
                typ_osoba: typ_osoba,
                sprawa_id: sprawa_id
            }
        }).done(function (data) {

            $('.uprawniony_naglowek_tresc').attr('data-uprawniony_id', data);
            $('.uprawniony_naglowek_tresc').data('uprawniony_id', data);

            wyswitl_powiadomienie('Zmiany zostały zapisane!!!', 1, 0);

            $('.ou_imie_nazwisko_u').value = uprawniony_imie + ' ' + uprawniony_nazwisko;
            $('.ou_imie_nazwisko_u').attr('value', uprawniony_imie + ' ' + uprawniony_nazwisko);

        }).fail(function (ajaxContext) {
            document.getElementById("body_strona_r").innerHTML = ajaxContext.responseText;
        });

    });
}

function sprawa_poszkodowany_zapisz_zmiany() {
    $('.poszkodowany_zapisz_zmiany').click(function () {
        var sprawa_id = $('.umowa_do_edycji').data('id_sprawy');
        var typ_osoba = '2';
        var poszkodowany_imie = $('.poszkodowany_imie').val();
        var poszkodowany_nazwisko = $('.poszkodowany_nazwisko').val();

        var typ_szkody = $('#zakladki_tresc').data('typ_szkody');

        var klient_poszkodowany = ($('.klient_poszkodowany_tak').hasClass('zaznaczone')) ? '1' : '0';
        var id_klienta = $('.sprawa_klient_dane').data('klient_wybrany_id');


        var poszkodowany_ulica = $('.poszkodowany_ulica').val();
        var poszkodowany_nr_domu = $('.poszkodowany_nr_domu').val();
        var poszkodowany_nr_mieszkania = $('.poszkodowany_nr_mieszkania').val();
        var poszkodowany_kod_pocztowy = $('.poszkodowany_kod_pocztowy').val();
        var poszkodowany_miasto = $('.poszkodowany_miejscowosc').val();

        var poszkodowany_obcokrajowiec;
        var poszkodowany_pesel = '';
        var poszkodowany_dowod = '';
        var poszkodowany_rodzaj_dokumentu = '';
        var poszkodowany_nr_dokumentu = '';
        
        var poszkodowany_maloletni = ($('.poszkodowany_maloletni').hasClass('zaznaczone')) ? '1' : '0';
        var poszkodowany_ubezwlasnowolniony = ($('.poszkodowany_ubezwlasnowolniony').hasClass('zaznaczone')) ? '1' : '0';
        var poszkodowany_malzonek = ($('.poszkodowany_malzonek').hasClass('zaznaczone')) ? '1' : '0';

        if (poszkodowany_maloletni == '1') {
            var typ_poszkodowanego = '1';
        } else if (poszkodowany_ubezwlasnowolniony == '1') {
            var typ_poszkodowanego = '2';
        } else if (poszkodowany_malzonek == '1') {
            var typ_poszkodowanego = '3';
        } else if (typ_szkody == '2') {
            var typ_poszkodowanego = '4';
        } else if (poszkodowany_maloletni == '0' && poszkodowany_ubezwlasnowolniony == '0' && poszkodowany_malzonek == '0' && typ_szkody == '1') {
            var typ_poszkodowanego = '0';
        }

        if ($('.obcokrajowiec_tak').hasClass('zaznaczone')) {
            poszkodowany_obcokrajowiec = 1;
            poszkodowany_rodzaj_dokumentu = $('.poszkodowany_dokument').val();
            poszkodowany_nr_dokumentu = $('.poszkodowany_numer_dokumentu').val();
        }

        if ($('.obcokrajowiec_nie').hasClass('zaznaczone')) {
            poszkodowany_obcokrajowiec = 0;
            poszkodowany_pesel = $('.poszkodowany_pesel').val();
            poszkodowany_dowod = $('.poszkodowany_seria_i_numer_dowodu').val();
        }

        var poszkodowany_email = $('.poszkodowany_email').val();
        var poszkodowany_telefon = $('.poszkodowany_tel').val();

        $.ajax({
            method: "POST",
            url: 'ajax/akcje/ajax_sprawa_poszkodowany_zapisz_zmiany',
            data: {
                poszkodowany_imie: poszkodowany_imie,
                poszkodowany_nazwisko: poszkodowany_nazwisko,
                poszkodowany_ulica: poszkodowany_ulica,
                poszkodowany_nr_domu: poszkodowany_nr_domu,
                poszkodowany_nr_mieszkania: poszkodowany_nr_mieszkania,
                poszkodowany_kod_pocztowy: poszkodowany_kod_pocztowy,
                poszkodowany_miasto: poszkodowany_miasto,
                poszkodowany_obcokrajowiec: poszkodowany_obcokrajowiec,
                poszkodowany_pesel: poszkodowany_pesel,
                poszkodowany_dowod: poszkodowany_dowod,
                poszkodowany_rodzaj_dokumentu: poszkodowany_rodzaj_dokumentu,
                poszkodowany_nr_dokumentu: poszkodowany_nr_dokumentu,
                poszkodowany_email: poszkodowany_email,
                poszkodowany_telefon: poszkodowany_telefon,
                typ_osoba: typ_osoba,
                sprawa_id: sprawa_id,
                klient_poszkodowany: klient_poszkodowany,
                id_klienta: id_klienta,
                typ_poszkodowanego: typ_poszkodowanego
            }
        }).done(function (data) {

            $('.poszkodowany_naglowek_tresc').attr('data-poszkodowany_id', data);

            wyswitl_powiadomienie('Zmiany zostały zapisane!!!', 1, 0);

            $('.ou_imie_nazwisko_zm').value = poszkodowany_imie + ' ' + poszkodowany_nazwisko;
            $('.ou_imie_nazwisko_zm').attr('value', poszkodowany_imie + ' ' + poszkodowany_nazwisko);

        }).fail(function (ajaxContext) {
            document.getElementById("body_strona_r").innerHTML = ajaxContext.responseText;
        });


    });
}

function zapisz_adres_kor_na_sprawie() {
    $('.zapisz_adres_kor_na_sprawie').click(function () {

        var adres_kor_id = $('.zleceniodawca_adres_kor_form').data('adres_kor_id');
        var url = 'ajax/akcje/ajax_sprawa_adres_kor_dodaj_nowy';

        if (adres_kor_id != '' || adres_kor_id == undefined) {
            url = 'ajax/akcje/ajax_sprawa_adres_kor_zapisz_zmiany';
        }

        var klient_id = $(this).parent().parent().data('klient_id');
        var zleceniodawca_ulica_kor = $('.zleceniodawca_ulica_kor').val();
        var zleceniodawca_nr_domu_kor = $('.zleceniodawca_nr_domu_kor').val();
        var zleceniodawca_nr_mieszkania_kor = $('.zleceniodawca_nr_mieszkania_kor').val();
        var zleceniodawca_kod_pocztowy_kor = $('.zleceniodawca_kod_pocztowy_kor').val();
        var zleceniodawca_miejscowosc_kor = $('.zleceniodawca_miejscowosc_kor').val();

        $.ajax({
            method: "POST",
            url: url,
            data: {
                klient_id: klient_id,
                zleceniodawca_ulica_kor: zleceniodawca_ulica_kor,
                zleceniodawca_nr_domu_kor: zleceniodawca_nr_domu_kor,
                zleceniodawca_nr_mieszkania_kor: zleceniodawca_nr_mieszkania_kor,
                zleceniodawca_kod_pocztowy_kor: zleceniodawca_kod_pocztowy_kor,
                zleceniodawca_miejscowosc_kor: zleceniodawca_miejscowosc_kor,
                adres_kor_id: adres_kor_id
            }
        }).done(function (data) {

            $('.zleceniodawca_adres_kor_form').attr('data-adres_kor_id', data);
            $('.zleceniodawca_adres_kor_form').data('adres_kor_id', data);



            wyswitl_powiadomienie('Zmiany zostały zapisane!!!', 1, 0);

        }).fail(function (ajaxContext) {
            document.getElementById("body_strona_r").innerHTML = ajaxContext.responseText;
        });

    });
}

function input_zapisz_zmiane_blur() {
    $('input').blur(function () {
        var tabela = $(this).data('tabela');
        var id = $(this).data('id');
        var komorka = $(this).data('kolumna')
        var wartosc = $(this).val();

        $.ajax({
            method: "POST",
            url: "ajax/akcje/ajax_input_zapisz_zmiane_blur",
            data: {
                tabela: tabela,
                id: id,
                komorka: komorka,
                wartosc: wartosc
            }
        }).done(function (data) {

            wyswitl_powiadomienie('Zmiany zostały zapisane!!!', 1, 0);

        }).fail(function (ajaxContext) {
            document.getElementById("body_strona_r").innerHTML = ajaxContext.responseText;
        });
    });
}

function input_zapisz_zmiane(tabelatmp, idtmp, komorkatmp, wartosctmp) {

    $.ajax({
        method: "POST",
        url: "ajax/akcje/ajax_input_zapisz_zmiane_blur",
        data: {
            tabela: tabelatmp,
            id: idtmp,
            komorka: komorkatmp,
            wartosc: wartosctmp
        }
    }).done(function (data) {

        wyswitl_powiadomienie('Zmiany zostały zapisane!!!', 1, 0);

    }).fail(function (ajaxContext) {
        document.getElementById("body_strona_r").innerHTML = ajaxContext.responseText;
    });

}

function kratka_zapisz_zmiane(tabelatmp, idtmp, komorkatmp, wartosctmp) {

    $.ajax({
        method: "POST",
        url: "ajax/akcje/ajax_kratka_zapisz_zmiane",
        data: {
            tabela: tabelatmp,
            id: idtmp,
            komorka: komorkatmp,
            wartosc: wartosctmp
        }
    }).done(function () {

        wyswitl_powiadomienie('Zmiany zostały zapisane!!!', 1, 0);

    }).fail(function (ajaxContext) {
        document.getElementById("body_strona_r").innerHTML = ajaxContext.responseText;
    });


}

function wybor_umowy() {

    $('.maxima').click(function () {
        $(this).addClass('zaznaczone');
        $('.optima').removeClass('zaznaczone');
        $('.promedica').removeClass('zaznaczone');
        //$('.promedica_pu').hide();
        $('.prima').removeClass('zaznaczone');

        //$('.prowizja_optima').val('');
        //$('.prowizja_prima').val('');

    });
    $('.optima').click(function () {
        $(this).addClass('zaznaczone');
        $('.maxima').removeClass('zaznaczone');
        $('.promedica').removeClass('zaznaczone');
        //$('.promedica_pu').hide();
        //$('.prowizja_promedica').slideUp();
        //$('.prowizja_maxima').slideUp();
        //$('.prowizja_optima').slideDown();
        
        $('.prima').removeClass('zaznaczone');
        //$('.prowizja_prima').val('');
        //$('.prowizja_prima').slideUp();
    });

    /* medyk 14-09-2016  ----> */
    $('.promedica').click(function () {
        $(this).addClass('zaznaczone');
        $('.maxima').removeClass('zaznaczone');
        $('.optima').removeClass('zaznaczone');
        //$('.maxima_pu').hide();
        //$('.prowizja_optima').slideUp();
        //$('.prowizja_promedica').slideDown();
        //$('.prowizja_maxima').slideUp();
        
        $('.prima').removeClass('zaznaczone');
        //$('.prowizja_prima').slideUp();
    });
    
    $('.prima').click(function () {
        $(this).addClass('zaznaczone');
        $('.maxima').removeClass('zaznaczone');
        $('.optima').removeClass('zaznaczone');
        $('.promedica').removeClass('zaznaczone');

        //$('.prowizja_optima').val('');
        //$('.prowizja_optima').slideUp();
        //$('.prowizja_prima').slideDown();
        //$('.prowizja_maxima').slideUp();
        
        //$('.prowizja_promedica').slideUp();
    });
    
    /*    < ---- medyk*/

}

function strona_zleceniodawca() {

    $('.instrukcja_dodaj').click(function () {

        $('.zleceniodawca_formularz_dodaj').slideDown();
        $('.zleceniodawca_formularz').slideUp();

    });

}

function zgoda_na_przetwarzanie() {


    $('.zgoda .tak').click(function () {

        $(this).addClass('zaznaczone');
        $('.typ_szkody').slideDown();
        $('.zgoda').find('.nie').removeClass('zaznaczone');
        $('.pytanie_do_klienta').slideUp();
        $('.pozycje_zakladek').slideDown();

        /*kamyk 2016-08-17*/
        $('.zakladki_element').hide();
        $('.zakladki_element.aktywna').show();

    });

    $('.zgoda .nie').click(function () {

        $(this).addClass('zaznaczone');
        $('.typ_szkody').slideUp();
        $('.zgoda').find('.tak').removeClass('zaznaczone');
        $('.komunikat_brak_zgody').slideDown();

    });
}

function wybor_typu_szkody() {

    $('.szkoda .obrazenia').click(function () {
        $(this).addClass('zaznaczone');
        $('.szkoda').find('.smierc').removeClass('zaznaczone');
        $('.szkoda').find('.bank').removeClass('zaznaczone');
        $('.rodzaj_wypadku').slideDown();
        $('.inne_szkody').slideUp();
        $('.poszkodowany_naglowek_tresc').html('DANE POSZKODOWANEGO');
        $('.przepisanie_klienta').show();
        
        $('.sytuacja_po_smierci_naglowek_tresc').hide();
        $('.sytuacja_po_smierci_naglowek_tresc_tresc').hide();
        
        $('.promedica_optima').show();
        $('.maxima_optima').hide();

        $('#zakladki_tresc').attr('data-typ_szkody', 1);
        $('#zakladki_tresc').data('typ_szkody', 1);

        /* medyk 15-09-2016 */
        $('.maxima_pu').hide();
        $('.promedica_pu').show();
        $('.optima_pu').show();
        $('.prima_pu').show();

        $('.io_zgody_o').show();
        
        $('.sekcja_przy_obrazeniach').show();
        $('.sekcja_przy_smierci').hide();
        $('.obrazenia_ciala').show();
        $('.kim_poszkodowany').show();
        
        var id = $('#zakladki_tresc').data('id_sprawy');
        kratka_zapisz_zmiane('sprawa', id, 'sprawa_typ_poszkodowany_id', 'NULL');

        /*KaMyK 2016-08-08*/
        if ($('#zakladki_tresc').hasClass('umowa_do_edycji')) {
            var komorka = $(this).data('komorka');
            var wartosc = $(this).data('wartosc');
            var id = $('#zakladki_tresc').data('id_sprawy');
            kratka_zapisz_zmiane('sprawa', id, komorka, wartosc);
            kratka_zapisz_zmiane('sprawa', id, 'sprawa_podtyp_szkody_id', 'null');
        }

        $('.inne_szkody .kratka').removeClass('zaznaczone');

    });

    $('.szkoda .smierc').click(function () {
        $(this).addClass('zaznaczone');
        $('.szkoda').find('.obrazenia').removeClass('zaznaczone');
        $('.szkoda').find('.bank').removeClass('zaznaczone');
        $('.rodzaj_wypadku').slideDown();
        $('.inne_szkody').slideUp();
        $('.poszkodowany_naglowek_tresc').html('DANE ZMARŁEGO');
        $('.przepisanie_klienta').hide();
        
        $('.sytuacja_po_smierci_naglowek_tresc').show();
        $('.sytuacja_po_smierci_naglowek_tresc_tresc').show();
        
        $('.promedica_optima').hide();
        $('.maxima_optima').show();


        $('#zakladki_tresc').attr('data-typ_szkody', 2);
        $('#zakladki_tresc').data('typ_szkody', 2);

        /* medyk 15-09-2016 */
        $('.maxima_pu').show();
        $('.promedica_pu').hide();
        $('.optima_pu').show();
        $('.prima_pu').show();

        $('.io_zgody_o').hide();
        
        $('.sekcja_przy_obrazeniach').hide();
        $('.sekcja_przy_smierci').show();
        $('.obrazenia_ciala').hide();
        $('.kim_poszkodowany').hide();

        var id = $('#zakladki_tresc').data('id_sprawy');
        kratka_zapisz_zmiane('sprawa', id, 'sprawa_typ_poszkodowany_id', '4');

        /*KaMyK 2016-08-08*/
        if ($('#zakladki_tresc').hasClass('umowa_do_edycji')) {
            var komorka = $(this).data('komorka');
            var wartosc = $(this).data('wartosc');
            var id = $('#zakladki_tresc').data('id_sprawy');
            kratka_zapisz_zmiane('sprawa', id, komorka, wartosc);
            kratka_zapisz_zmiane('sprawa', id, 'sprawa_podtyp_szkody_id', 'null');
        }

        $('.inne_szkody .kratka').removeClass('zaznaczone');
    });
    
    $('.szkoda .bank').click(function () {
        $(this).addClass('zaznaczone');
        $('.szkoda').find('.smierc').removeClass('zaznaczone');
        $('.szkoda').find('.obrazenia').removeClass('zaznaczone');
        $('.rodzaj_wypadku').slideUp();
        $('.inne_szkody').slideUp();
        $('#zapisz_strone_1').attr('style', 'display:block;');

        $('#zakladki_tresc').attr('data-typ_szkody', 1);
        $('#zakladki_tresc').data('typ_szkody', 1);

    });


    $('.pojazd').click(function () {
        $(this).addClass('zaznaczone');
        $('.budynek').removeClass('zaznaczone');
        $('.inna_szkoda').removeClass('zaznaczone');
        $('.szkoda_uzupelniona').val('');
        $('.szkoda_uzupelniona').slideUp();
        var komorka = $(this).data('komorka');
        var wartosc = $(this).data('wartosc');
        var id = $('#zakladki_tresc').data('id_sprawy');
        kratka_zapisz_zmiane('sprawa', id, komorka, wartosc);

    });
    $('.budynek').click(function () {
        $(this).addClass('zaznaczone');
        $('.pojazd').removeClass('zaznaczone');
        $('.inna_szkoda').removeClass('zaznaczone');
        $('.szkoda_uzupelniona').val('');
        $('.szkoda_uzupelniona').slideUp();
        var komorka = $(this).data('komorka');
        var wartosc = $(this).data('wartosc');
        var id = $('#zakladki_tresc').data('id_sprawy');
        kratka_zapisz_zmiane('sprawa', id, komorka, wartosc);
    });
    $('.inna_szkoda').click(function () {
        $(this).addClass('zaznaczone');
        $('.pojazd').removeClass('zaznaczone');
        $('.budynek').removeClass('zaznaczone');
        $('.szkoda_uzupelniona').slideDown();
    });

}

function wybor_rodzaju_wypadku() {

    $('.rodzaj .komunikacyjny').click(function () {
        $('#zapisz_strone_1').attr('style', 'display:block;');
        $(this).addClass('zaznaczone');
        $('.rodzaj').find('.w_rolnictwie').removeClass('zaznaczone');
        $('.rodzaj').find('.inne').removeClass('zaznaczone');
        $('.inne_wypadki').slideUp();

        /*KaMyK 2016-08-08*/
        if ($('#zakladki_tresc').hasClass('umowa_do_edycji')) {
            var komorka = $(this).data('komorka');
            var wartosc = $(this).data('wartosc');
            var id = $('#zakladki_tresc').data('id_sprawy');
            kratka_zapisz_zmiane('sprawa', id, komorka, wartosc);



        }

    });

    $('.rodzaj .w_rolnictwie').click(function () {
        $('#zapisz_strone_1').attr('style', 'display:block;');
        $(this).addClass('zaznaczone');
        $('.rodzaj').find('.komunikacyjny').removeClass('zaznaczone');
        $('.rodzaj').find('.inne').removeClass('zaznaczone');
        $('.inne_wypadki').slideUp();

        /*KaMyK 2016-08-08*/
        if ($('#zakladki_tresc').hasClass('umowa_do_edycji')) {
            var komorka = $(this).data('komorka');
            var wartosc = $(this).data('wartosc');
            var id = $('#zakladki_tresc').data('id_sprawy');
            kratka_zapisz_zmiane('sprawa', id, komorka, wartosc);

        }

    });

    $('.rodzaj .inne').click(function () {
        $(this).addClass('zaznaczone');
        $('.rodzaj').find('.w_rolnictwie').removeClass('zaznaczone');
        $('.rodzaj').find('.komunikacyjny').removeClass('zaznaczone');
        $('.inne_wypadki').slideDown();

        /*KaMyK 2016-08-08*/
        if ($('#zakladki_tresc').hasClass('umowa_do_edycji')) {
            var komorka = $(this).data('komorka');
            var wartosc = $(this).data('wartosc');
            var id = $('#zakladki_tresc').data('id_sprawy');
            kratka_zapisz_zmiane('sprawa', id, komorka, wartosc);
        }

    });

    $('.praca').click(function () {
        $(this).addClass('zaznaczone');
        $('.medyczny').removeClass('zaznaczone');
        $('.inny_wypadek').removeClass('zaznaczone');
        $('.inny_rodzaj_wypadku').val('');
        $('#zapisz_strone_1').attr('style', 'display:block;');
        $('.inny_rodzaj_wypadku').slideUp();
    });
    $('.medyczny').click(function () {
        $(this).addClass('zaznaczone');
        $('.praca').removeClass('zaznaczone');
        $('.inny_wypadek').removeClass('zaznaczone');
        $('.inny_rodzaj_wypadku').val('');
        $('#zapisz_strone_1').attr('style', 'display:block;');
        $('.inny_rodzaj_wypadku').slideUp();
    });
    $('.inny_wypadek').click(function () {
        $(this).addClass('zaznaczone');
        $('.praca').removeClass('zaznaczone');
        $('.medyczny').removeClass('zaznaczone');
        $('#zapisz_strone_1').attr('style', 'display:block;');
        $('.inny_rodzaj_wypadku').slideDown();
    });
}

function wybor_pochodzenia() {

    $('.obcokrajowiec .tak').click(function () {

        $(this).addClass('zaznaczone');
        $('.dane_identyfikacyjne_obcokrajowca').show();
        $('.obcokrajowiec').find('.nie').removeClass('zaznaczone');
        $('.dane_identyfikacyjne').hide();
        $('.poszkodowany_pesel').val('');
        $('.poszkodowany_seria_i_numer_dowodu').val('');
        $('.zleceniodawca_pesel_dodaj').val('');
        $('.zleceniodawca_seria_i_numer_dowodu_dodaj').val('');

    });

    $('.obcokrajowiec .nie').click(function () {

        $(this).addClass('zaznaczone');
        $('.dane_identyfikacyjne_obcokrajowca').hide();
        $('.obcokrajowiec').find('.tak').removeClass('zaznaczone');
        $('.dane_identyfikacyjne').show();
        $('.poszkodowany_dokument').val('');
        $('.poszkodowany_numer_dokumentu').val('');
        $('.zleceniodawca_dokument_dodaj').val('');
        $('.zleceniodawca_numer_dokumentu_dodaj').val('');

    });
}

function przelaczanie_zakladek() {

    $('.krok_1').click(function () {
        $('.str_1').slideDown();
        $('.krok_2').removeClass('aktywna');
        $('.krok_3').removeClass('aktywna');
        $('.krok_4').removeClass('aktywna');
        $('.krok_5').removeClass('aktywna');
        $('.krok_6').removeClass('aktywna');
        $('.krok_7').removeClass('aktywna');
        $('.krok_8').removeClass('aktywna');
        $('.krok_9').removeClass('aktywna');
        $('.krok_10').removeClass('aktywna');
        $('.krok_11').removeClass('aktywna');
        $('.krok_12').removeClass('aktywna');
        $('.krok_13').removeClass('aktywna');
        $('.krok_14').removeClass('aktywna');
        $(this).addClass('aktywna');
        $('.str_2').slideUp();
        $('.str_3').slideUp();
        $('.str_4').slideUp();
        $('.str_5').slideUp();
        $('.str_6').slideUp();
        $('.str_7').slideUp();
        $('.str_8').slideUp();
        $('.str_9').slideUp();
        $('.str_10').slideUp();
        $('.str_11').slideUp();
        $('.str_12').slideUp();
        $('.str_13').slideUp();
        $('.str_14').slideUp();

    });
    $('.krok_2').click(function () {
        $('.krok_1').removeClass('aktywna');
        $('.str_2').slideDown();
        $('.krok_3').removeClass('aktywna');
        $('.krok_4').removeClass('aktywna');
        $('.krok_5').removeClass('aktywna');
        $('.krok_6').removeClass('aktywna');
        $('.krok_7').removeClass('aktywna');
        $('.krok_8').removeClass('aktywna');
        $('.krok_9').removeClass('aktywna');
        $('.krok_10').removeClass('aktywna');
        $('.krok_11').removeClass('aktywna');
        $('.krok_12').removeClass('aktywna');
        $('.krok_13').removeClass('aktywna');
        $('.krok_14').removeClass('aktywna');
        $(this).addClass('aktywna');
        $('.str_1').slideUp();
        $('.str_2_b').slideUp();
        $('.str_3').slideUp();
        $('.str_4').slideUp();
        $('.str_5').slideUp();
        $('.str_6').slideUp();
        $('.str_7').slideUp();
        $('.str_8').slideUp();
        $('.str_9').slideUp();
        $('.str_10').slideUp();
        $('.str_11').slideUp();
        $('.str_12').slideUp();
        $('.str_13').slideUp();
        $('.str_14').slideUp();
    });
    $('.krok_3').click(function () {
        $('.str_3').slideDown();
        $('.krok_1').removeClass('aktywna');
        $('.krok_2').removeClass('aktywna');
        $('.krok_4').removeClass('aktywna');
        $('.krok_5').removeClass('aktywna');
        $('.krok_6').removeClass('aktywna');
        $('.krok_7').removeClass('aktywna');
        $('.krok_8').removeClass('aktywna');
        $('.krok_9').removeClass('aktywna');
        $('.krok_10').removeClass('aktywna');
        $('.krok_11').removeClass('aktywna');
        $('.krok_12').removeClass('aktywna');
        $('.krok_13').removeClass('aktywna');
        $('.krok_14').removeClass('aktywna');
        $(this).addClass('aktywna');
        $('.str_1').slideUp();
        $('.str_3_b').slideUp();
        $('.str_2').slideUp();
        $('.str_4').slideUp();
        $('.str_5').slideUp();
        $('.str_6').slideUp();
        $('.str_7').slideUp();
        $('.str_8').slideUp();
        $('.str_9').slideUp();
        $('.str_10').slideUp();
        $('.str_11').slideUp();
        $('.str_12').slideUp();
        $('.str_13').slideUp();
        $('.str_14').slideUp();
    });
    $('.krok_4').click(function () {
        $('.str_4').slideDown();
        $('.krok_1').removeClass('aktywna');
        $('.krok_2').removeClass('aktywna');
        $('.krok_3').removeClass('aktywna');
        $('.krok_5').removeClass('aktywna');
        $('.krok_6').removeClass('aktywna');
        $('.krok_7').removeClass('aktywna');
        $('.krok_8').removeClass('aktywna');
        $('.krok_9').removeClass('aktywna');
        $('.krok_10').removeClass('aktywna');
        $('.krok_11').removeClass('aktywna');
        $('.krok_12').removeClass('aktywna');
        $('.krok_13').removeClass('aktywna');
        $('.krok_14').removeClass('aktywna');
        $(this).addClass('aktywna');
        $('.str_1').slideUp();
        $('.str_4_b').slideUp();
        $('.str_2').slideUp();
        $('.str_3').slideUp();
        $('.str_5').slideUp();
        $('.str_6').slideUp();
        $('.str_7').slideUp();
        $('.str_8').slideUp();
        $('.str_9').slideUp();
        $('.str_10').slideUp();
        $('.str_11').slideUp();
        $('.str_12').slideUp();
        $('.str_13').slideUp();
        $('.str_14').slideUp();
    });
    $('.krok_5').click(function () {
        $('.str_5').slideDown();
        $('.krok_1').removeClass('aktywna');
        $('.krok_2').removeClass('aktywna');
        $('.krok_3').removeClass('aktywna');
        $('.krok_4').removeClass('aktywna');
        $('.krok_6').removeClass('aktywna');
        $('.krok_7').removeClass('aktywna');
        $('.krok_8').removeClass('aktywna');
        $('.krok_9').removeClass('aktywna');
        $('.krok_10').removeClass('aktywna');
        $('.krok_11').removeClass('aktywna');
        $('.krok_12').removeClass('aktywna');
        $('.krok_13').removeClass('aktywna');
        $('.krok_14').removeClass('aktywna');
        $(this).addClass('aktywna');
        $('.str_1').slideUp();
        $('.str_5_b').slideUp();
        $('.str_2').slideUp();
        $('.str_3').slideUp();
        $('.str_4').slideUp();
        $('.str_6').slideUp();
        $('.str_7').slideUp();
        $('.str_8').slideUp();
        $('.str_9').slideUp();
        $('.str_10').slideUp();
        $('.str_11').slideUp();
        $('.str_12').slideUp();
        $('.str_13').slideUp();
        $('.str_14').slideUp();
    });

    $('.krok_6').click(function () {
        $('.str_6').slideDown();
        $('.krok_1').removeClass('aktywna');
        $('.krok_2').removeClass('aktywna');
        $('.krok_3').removeClass('aktywna');
        $('.krok_4').removeClass('aktywna');
        $('.krok_5').removeClass('aktywna');
        $('.krok_7').removeClass('aktywna');
        $('.krok_8').removeClass('aktywna');
        $('.krok_9').removeClass('aktywna');
        $('.krok_10').removeClass('aktywna');
        $('.krok_11').removeClass('aktywna');
        $('.krok_12').removeClass('aktywna');
        $('.krok_13').removeClass('aktywna');
        $('.krok_14').removeClass('aktywna');
        $(this).addClass('aktywna');
        $('.str_1').slideUp();
        $('.str_6_b').slideUp();
        $('.str_2').slideUp();
        $('.str_3').slideUp();
        $('.str_4').slideUp();
        $('.str_5').slideUp();
        $('.str_7').slideUp();
        $('.str_8').slideUp();
        $('.str_9').slideUp();
        $('.str_10').slideUp();
        $('.str_11').slideUp();
        $('.str_12').slideUp();
        $('.str_13').slideUp();
        $('.str_14').slideUp();
    });

    $('.krok_7').click(function () {
        $('.str_7').slideDown();
        $('.krok_1').removeClass('aktywna');
        $('.krok_2').removeClass('aktywna');
        $('.krok_3').removeClass('aktywna');
        $('.krok_4').removeClass('aktywna');
        $('.krok_5').removeClass('aktywna');
        $('.krok_6').removeClass('aktywna');
        $('.krok_8').removeClass('aktywna');
        $('.krok_9').removeClass('aktywna');
        $('.krok_10').removeClass('aktywna');
        $('.krok_11').removeClass('aktywna');
        $('.krok_12').removeClass('aktywna');
        $('.krok_13').removeClass('aktywna');
        $('.krok_14').removeClass('aktywna');
        $(this).addClass('aktywna');
        $('.str_1').slideUp();
        $('.str_7_b').slideUp();;
        $('.str_2').slideUp();
        $('.str_3').slideUp();
        $('.str_4').slideUp();
        $('.str_5').slideUp();
        $('.str_6').slideUp();
        $('.str_8').slideUp();
        $('.str_9').slideUp();
        $('.str_10').slideUp();
        $('.str_11').slideUp();
        $('.str_12').slideUp();
        $('.str_13').slideUp();
        $('.str_14').slideUp();
    });

    $('.krok_8').click(function () {
        $('.str_8').slideDown();
        $('.krok_1').removeClass('aktywna');
        $('.krok_2').removeClass('aktywna');
        $('.krok_3').removeClass('aktywna');
        $('.krok_4').removeClass('aktywna');
        $('.krok_5').removeClass('aktywna');
        $('.krok_6').removeClass('aktywna');
        $('.krok_7').removeClass('aktywna');
        $('.krok_9').removeClass('aktywna');
        $('.krok_10').removeClass('aktywna');
        $('.krok_11').removeClass('aktywna');
        $('.krok_12').removeClass('aktywna');
        $('.krok_13').removeClass('aktywna');
        $('.krok_14').removeClass('aktywna');
        $(this).addClass('aktywna');
        $('.str_1').slideUp();
        $('.str_2').slideUp();
        $('.str_3').slideUp();
        $('.str_4').slideUp();
        $('.str_5').slideUp();
        $('.str_6').slideUp();
        $('.str_7').slideUp();
        $('.str_9').slideUp();
        $('.str_10').slideUp();
        $('.str_11').slideUp();
        $('.str_12').slideUp();
        $('.str_13').slideUp();
        $('.str_14').slideUp();
    });

    $('.krok_9').click(function () {
        $('.str_9').slideDown();
        $('.krok_1').removeClass('aktywna');
        $('.krok_2').removeClass('aktywna');
        $('.krok_3').removeClass('aktywna');
        $('.krok_4').removeClass('aktywna');
        $('.krok_5').removeClass('aktywna');
        $('.krok_6').removeClass('aktywna');
        $('.krok_7').removeClass('aktywna');
        $('.krok_8').removeClass('aktywna');
        $('.krok_10').removeClass('aktywna');
        $('.krok_11').removeClass('aktywna');
        $('.krok_12').removeClass('aktywna');
        $('.krok_13').removeClass('aktywna');
        $('.krok_14').removeClass('aktywna');
        $(this).addClass('aktywna');
        $('.str_1').slideUp();
        $('.str_2').slideUp();
        $('.str_3').slideUp();
        $('.str_4').slideUp();
        $('.str_5').slideUp();
        $('.str_6').slideUp();
        $('.str_7').slideUp();
        $('.str_8').slideUp();
        $('.str_10').slideUp();
        $('.str_11').slideUp();
        $('.str_12').slideUp();
        $('.str_13').slideUp();
        $('.str_14').slideUp();
    });

    $('.krok_10').click(function () {
        $('.str_10').slideDown();
        $('.krok_1').removeClass('aktywna');
        $('.krok_2').removeClass('aktywna');
        $('.krok_3').removeClass('aktywna');
        $('.krok_4').removeClass('aktywna');
        $('.krok_5').removeClass('aktywna');
        $('.krok_6').removeClass('aktywna');
        $('.krok_7').removeClass('aktywna');
        $('.krok_8').removeClass('aktywna');
        $('.krok_9').removeClass('aktywna');
        $('.krok_11').removeClass('aktywna');
        $('.krok_12').removeClass('aktywna');
        $('.krok_13').removeClass('aktywna');
        $('.krok_14').removeClass('aktywna');
        $(this).addClass('aktywna');
        $('.str_1').slideUp();
        $('.str_2').slideUp();
        $('.str_3').slideUp();
        $('.str_4').slideUp();
        $('.str_5').slideUp();
        $('.str_6').slideUp();
        $('.str_7').slideUp();
        $('.str_8').slideUp();
        $('.str_9').slideUp();
        $('.str_11').slideUp();
        $('.str_12').slideUp();
        $('.str_13').slideUp();
        $('.str_14').slideUp();
    });
    $('.krok_11').click(function () {
        $('.str_11').slideDown();
        $('.krok_1').removeClass('aktywna');
        $('.krok_2').removeClass('aktywna');
        $('.krok_3').removeClass('aktywna');
        $('.krok_4').removeClass('aktywna');
        $('.krok_5').removeClass('aktywna');
        $('.krok_6').removeClass('aktywna');
        $('.krok_7').removeClass('aktywna');
        $('.krok_8').removeClass('aktywna');
        $('.krok_9').removeClass('aktywna');
        $('.krok_10').removeClass('aktywna');
        $('.krok_12').removeClass('aktywna');
        $('.krok_13').removeClass('aktywna');
        $('.krok_14').removeClass('aktywna');
        $(this).addClass('aktywna');
        $('.str_1').slideUp();
        $('.str_2').slideUp();
        $('.str_3').slideUp();
        $('.str_4').slideUp();
        $('.str_5').slideUp();
        $('.str_6').slideUp();
        $('.str_7').slideUp();
        $('.str_8').slideUp();
        $('.str_9').slideUp();
        $('.str_10').slideUp();
        $('.str_12').slideUp();
        $('.str_13').slideUp();
        $('.str_14').slideUp();
    });
    $('.krok_12').click(function () {
        $('.str_12').slideDown();
        $('.krok_1').removeClass('aktywna');
        $('.krok_2').removeClass('aktywna');
        $('.krok_3').removeClass('aktywna');
        $('.krok_4').removeClass('aktywna');
        $('.krok_5').removeClass('aktywna');
        $('.krok_6').removeClass('aktywna');
        $('.krok_7').removeClass('aktywna');
        $('.krok_8').removeClass('aktywna');
        $('.krok_9').removeClass('aktywna');
        $('.krok_10').removeClass('aktywna');
        $('.krok_11').removeClass('aktywna');
        $('.krok_13').removeClass('aktywna');
        $('.krok_14').removeClass('aktywna');
        $(this).addClass('aktywna');
        $('.str_1').slideUp();
        $('.str_2').slideUp();
        $('.str_3').slideUp();
        $('.str_4').slideUp();
        $('.str_5').slideUp();
        $('.str_6').slideUp();
        $('.str_7').slideUp();
        $('.str_8').slideUp();
        $('.str_9').slideUp();
        $('.str_10').slideUp();
        $('.str_11').slideUp();
        $('.str_13').slideUp();
        $('.str_14').slideUp();
    });
    $('.krok_13').click(function () {
        $('.str_13').slideDown();
        $('.krok_1').removeClass('aktywna');
        $('.krok_2').removeClass('aktywna');
        $('.krok_3').removeClass('aktywna');
        $('.krok_4').removeClass('aktywna');
        $('.krok_5').removeClass('aktywna');
        $('.krok_6').removeClass('aktywna');
        $('.krok_7').removeClass('aktywna');
        $('.krok_8').removeClass('aktywna');
        $('.krok_9').removeClass('aktywna');
        $('.krok_10').removeClass('aktywna');
        $('.krok_11').removeClass('aktywna');
        $('.krok_12').removeClass('aktywna');
        $('.krok_14').removeClass('aktywna');
        $(this).addClass('aktywna');
        $('.str_1').slideUp();
        $('.str_2').slideUp();
        $('.str_3').slideUp();
        $('.str_4').slideUp();
        $('.str_5').slideUp();
        $('.str_6').slideUp();
        $('.str_7').slideUp();
        $('.str_8').slideUp();
        $('.str_9').slideUp();
        $('.str_10').slideUp();
        $('.str_11').slideUp();
        $('.str_12').slideUp();
        $('.str_14').slideUp();
    });
    $('.krok_14').click(function () {
        $('.str_14').slideDown();
        $('.krok_1').removeClass('aktywna');
        $('.krok_2').removeClass('aktywna');
        $('.krok_3').removeClass('aktywna');
        $('.krok_4').removeClass('aktywna');
        $('.krok_5').removeClass('aktywna');
        $('.krok_6').removeClass('aktywna');
        $('.krok_7').removeClass('aktywna');
        $('.krok_8').removeClass('aktywna');
        $('.krok_9').removeClass('aktywna');
        $('.krok_10').removeClass('aktywna');
        $('.krok_11').removeClass('aktywna');
        $('.krok_12').removeClass('aktywna');
        $('.krok_13').removeClass('aktywna');
        $(this).addClass('aktywna');
        $('.str_1').slideUp();
        $('.str_2').slideUp();
        $('.str_3').slideUp();
        $('.str_4').slideUp();
        $('.str_5').slideUp();
        $('.str_6').slideUp();
        $('.str_7').slideUp();
        $('.str_8').slideUp();
        $('.str_9').slideUp();
        $('.str_10').slideUp();
        $('.str_11').slideUp();
        $('.str_12').slideUp();
        $('.str_13').slideUp()
    });
}


function przelacz_str_1() {

    $('.str_1').slideUp();
    $('.str_3').slideUp();
    $('.str_4').slideUp();
    $('.str_5').slideUp();
    $('.str_6').slideUp();
    $('.str_7').slideUp();
    $('.str_8').slideUp();
    $('.str_9').slideUp();
    $('.str_10').slideUp();
    $('.str_11').slideUp();
    $('.str_12').slideUp();
    $('.str_13').slideUp();
    $('.str_14').slideUp();
    $('.str_2').slideDown();
    $('.krok_1').removeClass('aktywna');
    $('.krok_2').addClass('aktywna');
    $('.krok_2').show();

    zeruj_licznik_sesji_po_wykonaniu_funkcji();

}


function przelacz_str_2() {

    $('.str_1').slideUp();
    $('.str_2').slideUp();
    $('.str_4').slideUp();
    $('.str_5').slideUp();
    $('.str_6').slideUp();
    $('.str_7').slideUp();
    $('.str_8').slideUp();
    $('.str_9').slideUp();
    $('.str_10').slideUp();
    $('.str_11').slideUp();
    $('.str_12').slideUp();
    $('.str_13').slideUp();
    $('.str_14').slideUp();
    $('.str_3').slideDown();
    $('.krok_2').removeClass('aktywna');
    $('.krok_3').addClass('aktywna');
    $('.krok_3').show();

    zeruj_licznik_sesji_po_wykonaniu_funkcji();
}

function przelacz_str_3() {

    $('.str_1').slideUp();
    $('.str_3').slideUp();
    $('.str_2').slideUp();
    $('.str_5').slideUp();
    $('.str_6').slideUp();
    $('.str_7').slideUp();
    $('.str_8').slideUp();
    $('.str_9').slideUp();
    $('.str_10').slideUp();
    $('.str_11').slideUp();
    $('.str_12').slideUp();
    $('.str_13').slideUp();
    $('.str_14').slideUp();
    $('.str_4').slideDown();
    $('.krok_3').removeClass('aktywna');
    $('.krok_4').addClass('aktywna');
    $('.krok_4').show();

    zeruj_licznik_sesji_po_wykonaniu_funkcji();
}

function przelacz_str_4() {

    $('.str_1').slideUp();
    $('.str_3').slideUp();
    $('.str_2').slideUp();
    $('.str_4').slideUp();
    $('.str_6').slideUp();
    $('.str_7').slideUp();
    $('.str_8').slideUp();
    $('.str_9').slideUp();
    $('.str_10').slideUp();
    $('.str_11').slideUp();
    $('.str_12').slideUp();
    $('.str_13').slideUp();
    $('.str_14').slideUp();
    $('.str_5').slideDown();
    $('.krok_4').removeClass('aktywna');
    $('.krok_5').addClass('aktywna');
    $('.krok_5').show();

    zeruj_licznik_sesji_po_wykonaniu_funkcji();
}

function przelacz_str_5() {

    $('.str_1').slideUp();
    $('.str_3').slideUp();
    $('.str_2').slideUp();
    $('.str_5').slideUp();
    $('.str_4').slideUp();
    $('.str_7').slideUp();
    $('.str_8').slideUp();
    $('.str_9').slideUp();
    $('.str_10').slideUp();
    $('.str_11').slideUp();
    $('.str_12').slideUp();
    $('.str_6').slideDown();
    $('.str_13').slideUp();
    $('.str_14').slideUp();
    $('.krok_5').removeClass('aktywna');
    $('.krok_6').addClass('aktywna');
    $('.krok_6').show();

    zeruj_licznik_sesji_po_wykonaniu_funkcji();
}

function przelacz_str_6() {

    $('.str_1').slideUp();
    $('.str_3').slideUp();
    $('.str_2').slideUp();
    $('.str_5').slideUp();
    $('.str_4').slideUp();
    $('.str_6').slideUp();
    $('.str_8').slideUp();
    $('.str_9').slideUp();
    $('.str_10').slideUp();
    $('.str_11').slideUp();
    $('.str_12').slideUp();
    $('.str_13').slideUp();
    $('.str_14').slideUp();
    $('.str_7').slideDown();
    $('.krok_6').removeClass('aktywna');
    $('.krok_7').addClass('aktywna');
    $('.krok_7').show();

    zeruj_licznik_sesji_po_wykonaniu_funkcji();
}

function przelacz_str_7() {

    $('.str_1').slideUp();
    $('.str_3').slideUp();
    $('.str_2').slideUp();
    $('.str_5').slideUp();
    $('.str_4').slideUp();
    $('.str_7').slideUp();
    $('.str_6').slideUp();
    $('.str_9').slideUp();
    $('.str_10').slideUp();
    $('.str_11').slideUp();
    $('.str_12').slideUp();
    $('.str_13').slideUp();
    $('.str_14').slideUp();
    $('.str_8').slideDown();
    $('.krok_7').removeClass('aktywna');
    $('.krok_8').addClass('aktywna');
    $('.krok_8').show();

    zeruj_licznik_sesji_po_wykonaniu_funkcji();
}

function przelacz_str_8() {

    $('.str_1').slideUp();
    $('.str_3').slideUp();
    $('.str_2').slideUp();
    $('.str_5').slideUp();
    $('.str_4').slideUp();
    $('.str_7').slideUp();
    $('.str_8').slideUp();
    $('.str_6').slideUp();
    $('.str_10').slideUp();
    $('.str_11').slideUp();
    $('.str_12').slideUp();
    $('.str_9').slideDown();
    $('.str_13').slideUp();
    $('.str_14').slideUp();
    $('.krok_8').removeClass('aktywna');
    $('.krok_9').addClass('aktywna');
    $('.krok_9').show();

    zeruj_licznik_sesji_po_wykonaniu_funkcji();
}

function przelacz_str_9() {

    $('.str_1').slideUp();
    $('.str_3').slideUp();
    $('.str_2').slideUp();
    $('.str_5').slideUp();
    $('.str_4').slideUp();
    $('.str_7').slideUp();
    $('.str_8').slideUp();
    $('.str_9').slideUp();
    $('.str_6').slideUp();
    $('.str_11').slideUp();
    $('.str_12').slideUp();
    $('.str_13').slideUp();
    $('.str_14').slideUp();
    $('.str_10').slideDown();
    $('.krok_9').removeClass('aktywna');
    $('.krok_10').addClass('aktywna');
    $('.krok_10').show();

    zeruj_licznik_sesji_po_wykonaniu_funkcji();
}

function przelacz_str_10() {

    $('.str_1').slideUp();
    $('.str_2').slideUp();
    $('.str_3').slideUp();
    $('.str_4').slideUp();
    $('.str_5').slideUp();
    $('.str_6').slideUp();
    $('.str_7').slideUp();
    $('.str_8').slideUp();
    $('.str_9').slideUp();
    $('.str_10').slideUp();
    $('.str_12').slideUp();
    $('.str_13').slideUp();
    $('.str_14').slideUp();
    $('.str_11').slideDown();
    $('.krok_10').removeClass('aktywna');
    $('.krok_11').addClass('aktywna');
    $('.krok_11').show();

    zeruj_licznik_sesji_po_wykonaniu_funkcji();
}

function przelacz_str_11() {

    $('.str_1').slideUp();
    $('.str_2').slideUp();
    $('.str_3').slideUp();
    $('.str_4').slideUp();
    $('.str_5').slideUp();
    $('.str_6').slideUp();
    $('.str_7').slideUp();
    $('.str_8').slideUp();
    $('.str_9').slideUp();
    $('.str_10').slideUp();
    $('.str_11').slideUp();
    $('.str_13').slideUp();
    $('.str_14').slideUp();
    $('.str_12').slideDown();
    $('.krok_11').removeClass('aktywna');
    $('.krok_12').addClass('aktywna');
    $('.krok_12').show();

    zeruj_licznik_sesji_po_wykonaniu_funkcji();
}

function przelacz_str_12() {

    $('.str_1').slideUp();
    $('.str_3').slideUp();
    $('.str_2').slideUp();
    $('.str_5').slideUp();
    $('.str_4').slideUp();
    $('.str_6').slideUp();
    $('.str_7').slideUp();
    $('.str_8').slideUp();
    $('.str_9').slideUp();
    $('.str_10').slideUp();
    $('.str_11').slideUp();
    $('.str_12').slideUp();
    $('.str_14').slideUp();
    $('.str_13').slideDown();
    $('.krok_12').removeClass('aktywna');
    $('.krok_13').addClass('aktywna');
    $('.krok_13').show();

    zeruj_licznik_sesji_po_wykonaniu_funkcji();
}

function przelacz_str_13() {

    $('.str_1').slideUp();
    $('.str_3').slideUp();
    $('.str_2').slideUp();
    $('.str_5').slideUp();
    $('.str_4').slideUp();
    $('.str_6').slideUp();
    $('.str_7').slideUp();
    $('.str_8').slideUp();
    $('.str_9').slideUp();
    $('.str_10').slideUp();
    $('.str_11').slideUp();
    $('.str_12').slideUp();
    $('.str_13').slideUp();
    $('.str_14').slideDown();
    $('.krok_13').removeClass('aktywna');
    $('.krok_14').addClass('aktywna');
    $('.krok_14').show();

    zeruj_licznik_sesji_po_wykonaniu_funkcji();
}

function przelacz_str_14() {

    $('.str_1').slideUp();
    $('.str_3').slideUp();
    $('.str_2').slideUp();
    $('.str_5').slideUp();
    $('.str_4').slideUp();
    $('.str_6').slideUp();
    $('.str_7').slideUp();
    $('.str_8').slideUp();
    $('.str_9').slideUp();
    $('.str_10').slideUp();
    $('.str_11').slideUp();
    $('.str_12').slideUp();
    $('.str_13').slideUp();
    $('.krok_14').addClass('aktywna');

    zeruj_licznik_sesji_po_wykonaniu_funkcji();

}

function kierujacy_A() {
    $('.dr_s_do_a_obcy').click(function () {
        $('.dr_s_do_a_inny_rodzaj').slideUp();
        $('.dr_s_do_a_rodzina').removeClass('zaznaczone');
        $('.dr_s_do_a_inny').removeClass('zaznaczone');
        $('.dr_s_do_a_inny_rodzaj').val('');
    });
    $('.dr_s_do_a_rodzina').click(function () {
        $('.dr_s_do_a_inny_rodzaj').slideUp();
        $('.dr_s_do_a_inny').removeClass('zaznaczone');
        $('.dr_s_do_a_obcy').removeClass('zaznaczone');
        $('.dr_s_do_a_inny_rodzaj').val('');
    });
    $('.dr_s_do_a_inny').click(function () {
        $('.dr_s_do_a_rodzina').removeClass('zaznaczone');
        $('.dr_s_do_a_obcy').removeClass('zaznaczone');

        if ($(this).hasClass('zaznaczone')) {
            $('.dr_s_do_a_inny_rodzaj').slideUp();
        } else {
            $('.dr_s_do_a_inny_rodzaj').slideDown();
        }
    });
}

function kierujacy_B() {
    $('.dr_s_do_b_obcy').click(function () {
        $('.dr_s_do_b_inny_rodzaj').slideUp();
        $('.dr_s_do_b_rodzina').removeClass('zaznaczone');
        $('.dr_s_do_b_inny').removeClass('zaznaczone');
        $('.dr_s_do_b_inny_rodzaj').val('');
    });
    $('.dr_s_do_b_rodzina').click(function () {
        $('.dr_s_do_b_inny_rodzaj').slideUp();
        $('.dr_s_do_b_inny').removeClass('zaznaczone');
        $('.dr_s_do_b_obcy').removeClass('zaznaczone');
        $('.dr_s_do_b_inny_rodzaj').val('');
    });
    $('.dr_s_do_b_inny').click(function () {
        $('.dr_s_do_b_rodzina').removeClass('zaznaczone');
        $('.dr_s_do_b_obcy').removeClass('zaznaczone');
        if ($(this).hasClass('zaznaczone')) {
            $('.dr_s_do_b_inny_rodzaj').slideUp();
        } else {
            $('.dr_s_do_b_inny_rodzaj').slideDown();
        }
    });
}

function roszczenia_od_UFG() {
    $('.dr_ub_ufg_tak').click(function () {
        $('.dr_ub_ufg_nie').removeClass('zaznaczone');

        /*kamyk 2016-08-12*/
        if ($('#zakladki_tresc').hasClass('umowa_do_edycji')) {
            var id_sprawy = $('#zakladki_tresc').data('id_sprawy');
            kratka_zapisz_zmiane('sprawa', id_sprawy, 'roszczenia_od_ubezp_ufg', '1');
        }


    });
    $('.dr_ub_ufg_nie').click(function () {
        $('.dr_ub_ufg_tak').removeClass('zaznaczone');

        /*kamyk 2016-08-12*/
        if ($('#zakladki_tresc').hasClass('umowa_do_edycji')) {
            var id_sprawy = $('#zakladki_tresc').data('id_sprawy');
            kratka_zapisz_zmiane('sprawa', id_sprawy, 'roszczenia_od_ubezp_ufg', '0');
        }
    });
}

function wyplata_wynagrodzenia() {
    $('.przelew_bankowy').click(function () {
        $('.przekaz_pocztowy').removeClass('zaznaczone');
        $('.zleceniodawca_odbiorca').removeClass('zaznaczone');
        $('.wynagrodzenie_przekaz').slideUp();
        $('.wynagrodzenie_przelew').slideDown();
        $('.imie_przekaz').val('');
        $('.nazwisko_przekaz').val('');
        $('.ulica_przekaz').val('');
        $('.dom_przekaz').val('');
        $('.mieszkanie_przekaz').val('');
        $('.kod_przekaz').val('');
        $('.miejscowosc_przekaz').val('');

    });
    $('.przekaz_pocztowy').click(function () {
        $('.przelew_bankowy').removeClass('zaznaczone');
        $('.zleceniodawca_odbiorca').removeClass('zaznaczone');
        $('.wynagrodzenie_przekaz').slideDown();
        $('.wynagrodzenie_przelew').slideUp();
        $('.wynagrodzenie_nr_rachunku_bankowego ').val('');
        $('.imie_przelew').val('');
        $('.nazwisko_przelew').val('');
        $('.ulica_przelew').val('');
        $('.dom_przelew').val('');
        $('.mieszkanie_przelew').val('');
        $('.kod_przelew').val('');
        $('.miejscowosc_przelew').val('');
    });
}

function roszczenia_od_pracodawcy() {
    $('.dr_tak').click(function () {
        $('.dr_nie').removeClass('zaznaczone');

        /*kamyk 2016-08-12*/
        var id_sprawy = $('#zakladki_tresc').data('id_sprawy');
        kratka_zapisz_zmiane('sprawa', id_sprawy, 'roszczenia_od_prac', '1');

    });
    $('.dr_nie').click(function () {
        $('.dr_tak').removeClass('zaznaczone');

        /*kamyk 2016-08-12*/
        var id_sprawy = $('#zakladki_tresc').data('id_sprawy');
        kratka_zapisz_zmiane('sprawa', id_sprawy, 'roszczenia_od_prac', '0');

    });
}
function roszczenia_od_pracodawcy_dodawanie() {
    $('.dr_tak').click(function () {
        $('.dr_nie').removeClass('zaznaczone');

        /*kamyk 2016-08-12*/
        var id_sprawy = $('#zakladki_tresc').data('id_sprawy');
        //kratka_zapisz_zmiane('sprawa', id_sprawy, 'roszczenia_od_prac', '1');

    });
    $('.dr_nie').click(function () {
        $('.dr_tak').removeClass('zaznaczone');

        /*kamyk 2016-08-12*/
        var id_sprawy = $('#zakladki_tresc').data('id_sprawy');
        //kratka_zapisz_zmiane('sprawa', id_sprawy, 'roszczenia_od_prac', '0');

    });
}

function odpowiedzialnosc_karna() {


    $('.ok_wezwano_policje').click(function () {
        if ($(this).hasClass('zaznaczone')) {
            $('.ok_wp_miejsce').slideUp();
            $('.ok_wp_miejsce').val('');
        } else {
            $('.ok_wp_miejsce').slideDown();
        }
    });

    $('.ok_postawiono_sprawcy_zarzut').click(function () {
        if ($(this).hasClass('zaznaczone')) {
            $('.ok_psz_artykul').slideUp();
            $('.ok_psz_kk_o').slideUp();
            $('.ok_psz_kw_o').slideUp();

        } else {
            $('.ok_psz_artykul').val('');
            $('.ok_psz_artykul').slideDown();
            $('.ok_psz_kk_o').slideDown();
            $('.ok_psz_kw_o').slideDown();

        }
    });

    $('.ok_skierowano_akt_do_sadu').click(function () {
        if ($(this).hasClass('zaznaczone')) {
            $('.ok_sads_pelna_nazwa_sadu').val('');
            $('.ok_sads_pelna_nazwa_sadu').slideUp();
        } else {
            $('.ok_sads_pelna_nazwa_sadu').slideDown();
        }
    });

    $('.ok_postepowanie_karne_umorzono').click(function () {
        if ($(this).hasClass('zaznaczone')) {
            $('.wyrok').slideDown();
            $('.ok_pku_artykul').slideUp();
            $('.ok_pku_kpk_o').slideUp();
            $('.ok_pku_kpw_o').slideUp();
        } else {
            $('.ok_pku_artykul').val('');
            $('.wyrok').slideUp();
            $('.ok_pku_artykul').slideDown();
            $('.ok_pku_kpk_o').slideDown();
            $('.ok_pku_kpw_o').slideDown();
            $('.ok_pku_artykul').val('');
        }
    });

    $('.ok_zapadl_wyrok').click(function () {
        if ($(this).hasClass('zaznaczone')) {
            $('.ok_zw_skazujacy_o').slideUp();
            $('.ok_zw_u_artykul').slideUp();
            $('.ok_zw_uniewinniajacy_o').slideUp();
            $('.ok_zw_kk_o').slideUp();
            $('.ok_zw_kw_o').slideUp();
        } else {
            $('.ok_zw_skazujacy_o').slideDown();
            $('.ok_zw_u_artykul').slideDown();
            $('.ok_zw_uniewinniajacy_o').slideDown();
            $('.ok_zw_kk_o').slideDown();
            $('.ok_zw_kw_o').slideDown();
            $('.ok_zw_u_artykul').val('');
            $('.ok_zw_uniewinniajacy').removeClass('zaznaczone');
            $('.ok_zw_skazujacy').removeClass('zaznaczone');
        }
    });

    $('.ok_zw_skazujacy').click(function () {
        if ($(this).hasClass('zaznaczone')) {
            $('.ok_zw_uniewinniajacy').removeClass('zaznaczone');
            $('.ok_zw_uniewinniajacy').addClass('zaznaczone');
        } else {
            $('.ok_zw_uniewinniajacy').addClass('zaznaczone');
            $('.ok_zw_uniewinniajacy').removeClass('zaznaczone');
        }
    });
    $('.ok_zw_uniewinniajacy').click(function () {
        if ($(this).hasClass('zaznaczone')) {
            $('.ok_zw_skazujacy').removeClass('zaznaczone');
            $('.ok_zw_skazujacy').addClass('zaznaczone');
        } else {
            $('.ok_zw_skazujacy').addClass('zaznaczone');
            $('.ok_zw_skazujacy').removeClass('zaznaczone');
        }
    });

}

function odpowiedzialnosc_cywilna() {

    $('.oc_zgloszono_szp').click(function () {
        $('.oc_zgloszono_szp_data').slideDown();
        $('.oc_nie_zgloszono_szp').removeClass('zaznaczone');
    });

    $('.oc_nie_zgloszono_szp').click(function () {
        $('.oc_zgloszono_szp_data').val('');
        $('.oc_zgloszono_szp_data').slideUp();
        $('.oc_zgloszono_szp').removeClass('zaznaczone');
    });

    $('.oc_zgloszono_szo').click(function () {
        $('.oc_zgloszono_szo_data').slideDown();
        $('.oc_nie_zgloszono_szo').removeClass('zaznaczone');
    });

    $('.oc_nie_zgloszono_szo').click(function () {
        $('.oc_zgloszono_szo_data').val('');
        $('.oc_zgloszono_szo_data').slideUp();
        $('.oc_zgloszono_szo').removeClass('zaznaczone');
    });

    $('.oc_odszkodowanie_oc_p_nie_wyplacono').click(function () {
        $('.oc_odszkodowanie_oc_p_wyplacono').removeClass('zaznaczone');
        $('.oc_wyplacono_szo').removeClass('zaznaczone');
        $('.oc_wyplacono_szo_kwota').slideUp();
        $('.oc_wyplacono_szo_o').slideUp();
        $('.oc_wyplacono_szo_kwota').val('');
        $('.on_wyplacono_szo_data').val('');
        $('.on_wyplacono_szo_ugoda').removeClass('zaznaczone');
        $('.on_wyplacono_szo_wyrok').removeClass('zaznaczone');
    });

    $('.oc_odszkodowanie_oc_p_wyplacono').click(function () {
        $('.oc_odszkodowanie_oc_p_nie_wyplacono').removeClass('zaznaczone');
        $('.oc_wyplacono_szo').removeClass('zaznaczone');
        $('.oc_wyplacono_szo_kwota').slideUp();
        $('.oc_wyplacono_szo_o').slideUp();
        $('.oc_wyplacono_szo_kwota').val('');
        $('.on_wyplacono_szo_data').val('');
        $('.on_wyplacono_szo_ugoda').removeClass('zaznaczone');
        $('.on_wyplacono_szo_wyrok').removeClass('zaznaczone');
    });
    $('.oc_wyplacono_szo').click(function () {

        if ($('.oc_wyplacono_szo').hasClass('zaznaczone')) {
            $('.oc_odszkodowanie_oc_p_nie_wyplacono').removeClass('zaznaczone');
            $('.oc_odszkodowanie_oc_p_wyplacono').removeClass('zaznaczone');
            $('.oc_wyplacono_szo_kwota').slideUp();
            $('.oc_wyplacono_szo_o').slideUp();
        } else {
            $('.oc_wyplacono_szo').removeClass('zaznaczone');
            $('.oc_wyplacono_szo_kwota').slideDown();
            $('.oc_wyplacono_szo_o').slideDown();
            $('.on_wyplacono_szo_decyzja_zd').removeClass('zaznaczone');
            $('.on_wyplacono_szo_ugoda').removeClass('zaznaczone');
            $('.on_wyplacono_szo_wyrok').removeClass('zaznaczone');
            $('.on_wyplacono_szo_nie_wiem').removeClass('zaznaczone');
            $('.oc_wyplacono_szo_kwota').val('');
            $('.on_wyplacono_szo_data').val('');
        }
    });

    $('.on_wyplacono_szo_ugoda').click(function () {
        $('.on_wyplacono_szo_wyrok').removeClass('zaznaczone');
        $('.on_wyplacono_szo_decyzja_zd').removeClass('zaznaczone');
        $('.on_wyplacono_szo_nie_wiem').removeClass('zaznaczone');
        $('.on_wyplacono_szo_data').slideDown();
    });
    $('.on_wyplacono_szo_wyrok').click(function () {
        $('.on_wyplacono_szo_ugoda').removeClass('zaznaczone');
        $('.on_wyplacono_szo_decyzja_zd').removeClass('zaznaczone');
        $('.on_wyplacono_szo_nie_wiem').removeClass('zaznaczone');
        $('.on_wyplacono_szo_data').slideDown();
    });
    $('.on_wyplacono_szo_decyzja_zd').click(function () {
        $('.on_wyplacono_szo_ugoda').removeClass('zaznaczone');
        $('.on_wyplacono_szo_wyrok').removeClass('zaznaczone');
        $('.on_wyplacono_szo_nie_wiem').removeClass('zaznaczone');
        $('.on_wyplacono_szo_data').slideDown();
    });
    $('.on_wyplacono_szo_nie_wiem').click(function () {
        $('.on_wyplacono_szo_ugoda').removeClass('zaznaczone');
        $('.on_wyplacono_szo_wyrok').removeClass('zaznaczone');
        $('.on_wyplacono_szo_decyzja_zd').removeClass('zaznaczone');
        $('.on_wyplacono_szo_data').val('');
        $('.on_wyplacono_szo_data').slideUp();
    });

}

function przepisz_poszkodowanego() {
    
    var czy_smierciowka = ($('.smierc').hasClass('zaznaczone')) ? '1' : '0';
    
    if(czy_smierciowka == 1) {
	$('.klient_poszkodowany_nie').addClass('zaznaczone');
        $('.klient_poszkodowany_tak').removeClass('zaznaczone');
        $('.przepisanie_klienta').hide('');
        $('.dane_klienta_form').show();
    }
    
    var czy_przepisac = ($('.klient_poszkodowany_tak').hasClass('zaznaczone')) ? '1' : '0';

    $('.klient_poszkodowany_tak').click(function () {

        $('.dane_klienta_form').hide();

        $(this).parent().parent().find('.klient_poszkodowany_nie').removeClass('zaznaczone');
        $(this).parent().parent().find('.klient_poszkodowany_tak').addClass('zaznaczone');
        
        var id_klienta = $('.sprawa_klient_dane').data('klient_wybrany_id');
        
        $('.poszkodowany_naglowek_tresc').attr('data-poszkodowany_id', id_klienta);
        
        var id_poszkodowanego = $('.sprawa_klient_dane').data('klient_id');
        var imie_poszkodowanego = $('.zleceniodawca_imie_dodaj').val();
        var nazwisko_poszkodowanego = $('.zleceniodawca_nazwisko_dodaj').val();
        var ulica_poszkodowanego = $('.zleceniodawca_ulica_dodaj').val();
        var dom_poszkodowanego = $('.zleceniodawca_nr_domu_dodaj').val();
        var mieszkanie_poszkodowanego = $('.zleceniodawca_nr_mieszkania_dodaj').val();
        var kod_poszkodowanego = $('.zleceniodawca_kod_pocztowy_dodaj').val();
        var miejscowosc_poszkodowanego = $('.zleceniodawca_miejscowosc_dodaj').val();
        var pesel_poszkodowanego = $('.zleceniodawca_pesel_dodaj').val();
        var dowod_poszkodowanego = $('.zleceniodawca_seria_i_numer_dowodu_dodaj').val();
        var email_poszkodowanego = $('.zleceniodawca_email_dodaj').val();
        var telefon_poszkodowanego = $('.zleceniodawca_telefon_dodaj').val();
        
        var obcokrajowiec = $('.obcokrajowiec').data('obcokrajowiec');

        if (obcokrajowiec == 1) {
            $('.obc_tak').addClass('zaznaczone');
            $('.obc_nie').removeClass('zaznaczone');
        } else if (obcokrajowiec == 0) {
            $('.obc_nie').addClass('zaznaczone');
            $('.obc_tak').removeClass('zaznaczone');
        }
        
        $('.poszkodowany_imie').val(imie_poszkodowanego);
        $('.poszkodowany_imie').attr('value', imie_poszkodowanego);      
        $('.poszkodowany_imie').parent().addClass('zablokowane_pole');
        
        $('.poszkodowany_nazwisko').val(nazwisko_poszkodowanego);
        $('.poszkodowany_nazwisko').attr('value', nazwisko_poszkodowanego);
        $('.poszkodowany_nazwisko').parent().addClass('zablokowane_pole');
        
        $('.poszkodowany_ulica').val(ulica_poszkodowanego);
        $('.poszkodowany_ulica').attr('value', ulica_poszkodowanego);
        $('.poszkodowany_ulica').parent().addClass('zablokowane_pole');
              
        $('.poszkodowany_nr_domu').val(dom_poszkodowanego);
        $('.poszkodowany_nr_domu').attr('value', dom_poszkodowanego);
        $('.poszkodowany_nr_domu').parent().addClass('zablokowane_pole');
        
        $('.poszkodowany_nr_mieszkania').val(mieszkanie_poszkodowanego);
        $('.poszkodowany_nr_mieszkania').attr('value', mieszkanie_poszkodowanego);
        $('.poszkodowany_nr_mieszkania').parent().addClass('zablokowane_pole');
        
        $('.poszkodowany_kod_pocztowy').val(kod_poszkodowanego);
        $('.poszkodowany_kod_pocztowy').attr('value', kod_poszkodowanego);
        $('.poszkodowany_kod_pocztowy').parent().addClass('zablokowane_pole');
        
        $('.poszkodowany_miejscowosc').val(miejscowosc_poszkodowanego);
        $('.poszkodowany_miejscowosc').attr('value', miejscowosc_poszkodowanego);
        $('.poszkodowany_miejscowosc').parent().addClass('zablokowane_pole');
        
        $('.poszkodowany_email').val(email_poszkodowanego);
        $('.poszkodowany_email').attr('value', email_poszkodowanego);
        $('.poszkodowany_email').parent().addClass('zablokowane_pole');
        
        $('.poszkodowany_tel').val(telefon_poszkodowanego);
        $('.poszkodowany_tel').attr('value', telefon_poszkodowanego);
        $('.poszkodowany_tel').parent().addClass('zablokowane_pole');
        
        $('.poszkodowany_pesel').val(pesel_poszkodowanego);
        $('.poszkodowany_pesel').attr('value', pesel_poszkodowanego);
        $('.poszkodowany_pesel').parent().addClass('zablokowane_pole');
        
        $('.poszkodowany_seria_i_numer_dowodu').val(dowod_poszkodowanego);
        $('.poszkodowany_seria_i_numer_dowodu').attr('value', dowod_poszkodowanego);
        $('.poszkodowany_seria_i_numer_dowodu').parent().addClass('zablokowane_pole');

    });

    $('.klient_poszkodowany_nie').click(function () {

        $('.dane_klienta_form').show();

        $(this).parent().parent().find('.klient_poszkodowany_tak').removeClass('zaznaczone');
        $(this).parent().parent().find('.klient_poszkodowany_nie').addClass('zaznaczone');
        
        $('.poszkodowany_naglowek_tresc').attr('data-poszkodowany_id', '');
        $('.poszkodowany_naglowek_tresc').data('poszkodowany_id', '');
                
        $('.poszkodowany_imie').val('');
        $('.poszkodowany_imie').parent().removeClass('zablokowane_pole');
        $('.poszkodowany_nazwisko').val('');
        $('.poszkodowany_nazwisko').parent().removeClass('zablokowane_pole');
        $('.poszkodowany_ulica').val('');
        $('.poszkodowany_ulica').parent().removeClass('zablokowane_pole');
        $('.poszkodowany_nr_domu').val('');
        $('.poszkodowany_nr_domu').parent().removeClass('zablokowane_pole');
        $('.poszkodowany_nr_mieszkania').val('');
        $('.poszkodowany_nr_mieszkania').parent().removeClass('zablokowane_pole');
        $('.poszkodowany_kod_pocztowy').val('');
        $('.poszkodowany_kod_pocztowy').parent().removeClass('zablokowane_pole');
        $('.poszkodowany_miejscowosc').val('');
        $('.poszkodowany_miejscowosc').parent().removeClass('zablokowane_pole');
        $('.poszkodowany_pesel').val('');
        $('.poszkodowany_pesel').parent().removeClass('zablokowane_pole');
        $('.poszkodowany_seria_i_numer_dowodu').val('');
        $('.poszkodowany_seria_i_numer_dowodu').parent().removeClass('zablokowane_pole');
        $('.poszkodowany_email').val('');
        $('.poszkodowany_email').parent().removeClass('zablokowane_pole');
        $('.poszkodowany_tel').val('');
        $('.poszkodowany_tel').parent().removeClass('zablokowane_pole');
        $('.poszkodowany_dokument').val('');
        $('.poszkodowany_dokument').parent().removeClass('zablokowane_pole');
        $('.poszkodowany_numer_dokumentu').val('');
        $('.poszkodowany_numer_dokumentu').parent().removeClass('zablokowane_pole');

    });

}

function przepisz_poszkodowanego_przy_dodawaniu() {

    var czy_smierciowka = ($('.smierc').hasClass('zaznaczone')) ? '1' : '0';

    if(czy_smierciowka == 1) {
        $('.klient_poszkodowany_nie').addClass('zaznaczone');
        $('.klient_poszkodowany_tak').removeClass('zaznaczone');
        $('.przepisanie_klienta').hide('');
        $('.dane_klienta_form').show();
    }

    var czy_przepisac = ($('.klient_poszkodowany_tak').hasClass('zaznaczone')) ? '1' : '0';

    $('.klient_poszkodowany_tak').click(function () {

        $('.dane_klienta_form').hide();

        $(this).parent().parent().find('.klient_poszkodowany_nie').removeClass('zaznaczone');
        $(this).parent().parent().find('.klient_poszkodowany_tak').addClass('zaznaczone');

        var id_klienta = $('.sprawa_klient_dane').data('klient_wybrany_id');

        $('.poszkodowany_naglowek_tresc').attr('data-poszkodowany_id', id_klienta);

        var id_poszkodowanego = $('.sprawa_klient_dane').data('klient_id');
        var imie_poszkodowanego = $('.zleceniodawca_imie_dodaj').val();
        var nazwisko_poszkodowanego = $('.zleceniodawca_nazwisko_dodaj').val();
        var ulica_poszkodowanego = $('.zleceniodawca_ulica_dodaj').val();
        var dom_poszkodowanego = $('.zleceniodawca_nr_domu_dodaj').val();
        var mieszkanie_poszkodowanego = $('.zleceniodawca_nr_mieszkania_dodaj').val();
        var kod_poszkodowanego = $('.zleceniodawca_kod_pocztowy_dodaj').val();
        var miejscowosc_poszkodowanego = $('.zleceniodawca_miejscowosc_dodaj').val();
        var pesel_poszkodowanego = $('.zleceniodawca_pesel_dodaj').val();
        var dowod_poszkodowanego = $('.zleceniodawca_seria_i_numer_dowodu_dodaj').val();
        var email_poszkodowanego = $('.zleceniodawca_email_dodaj').val();
        var telefon_poszkodowanego = $('.zleceniodawca_telefon_dodaj').val();

        var obcokrajowiec = $('.obcokrajowiec').data('obcokrajowiec');

        if (obcokrajowiec == 1) {
            $('.obc_tak').addClass('zaznaczone');
            $('.obc_nie').removeClass('zaznaczone');

        } else if (obcokrajowiec == 0) {
            $('.obc_nie').addClass('zaznaczone');
            $('.obc_tak').removeClass('zaznaczone');
        }

        $('.poszkodowany_imie').val(imie_poszkodowanego);
        $('.poszkodowany_imie').attr('value', imie_poszkodowanego);
        $('.poszkodowany_imie').parent().addClass('zablokowane_pole');

        $('.poszkodowany_nazwisko').val(nazwisko_poszkodowanego);
        $('.poszkodowany_nazwisko').attr('value', nazwisko_poszkodowanego);
        $('.poszkodowany_nazwisko').parent().addClass('zablokowane_pole');

        $('.poszkodowany_ulica').val(ulica_poszkodowanego);
        $('.poszkodowany_ulica').attr('value', ulica_poszkodowanego);
        $('.poszkodowany_ulica').parent().addClass('zablokowane_pole');

        $('.poszkodowany_nr_domu').val(dom_poszkodowanego);
        $('.poszkodowany_nr_domu').attr('value', dom_poszkodowanego);
        $('.poszkodowany_nr_domu').parent().addClass('zablokowane_pole');

        $('.poszkodowany_nr_mieszkania').val(mieszkanie_poszkodowanego);
        $('.poszkodowany_nr_mieszkania').attr('value', mieszkanie_poszkodowanego);
        $('.poszkodowany_nr_mieszkania').parent().addClass('zablokowane_pole');

        $('.poszkodowany_kod_pocztowy').val(kod_poszkodowanego);
        $('.poszkodowany_kod_pocztowy').attr('value', kod_poszkodowanego);
        $('.poszkodowany_kod_pocztowy').parent().addClass('zablokowane_pole');

        $('.poszkodowany_miejscowosc').val(miejscowosc_poszkodowanego);
        $('.poszkodowany_miejscowosc').attr('value', miejscowosc_poszkodowanego);
        $('.poszkodowany_miejscowosc').parent().addClass('zablokowane_pole');

        $('.poszkodowany_email').val(email_poszkodowanego);
        $('.poszkodowany_email').attr('value', email_poszkodowanego);
        $('.poszkodowany_email').parent().addClass('zablokowane_pole');

        $('.poszkodowany_tel').val(telefon_poszkodowanego);
        $('.poszkodowany_tel').attr('value', telefon_poszkodowanego);
        $('.poszkodowany_tel').parent().addClass('zablokowane_pole');

        $('.poszkodowany_pesel').val(pesel_poszkodowanego);
        $('.poszkodowany_pesel').attr('value', pesel_poszkodowanego);
        $('.poszkodowany_pesel').parent().addClass('zablokowane_pole');

        $('.poszkodowany_seria_i_numer_dowodu').val(dowod_poszkodowanego);
        $('.poszkodowany_seria_i_numer_dowodu').attr('value', dowod_poszkodowanego);
        $('.poszkodowany_seria_i_numer_dowodu').parent().addClass('zablokowane_pole');

    });

    $('.klient_poszkodowany_nie').click(function () {

        $('.dane_klienta_form').show();

        $(this).parent().parent().find('.klient_poszkodowany_tak').removeClass('zaznaczone');
        $(this).parent().parent().find('.klient_poszkodowany_nie').addClass('zaznaczone');

        $('.poszkodowany_naglowek_tresc').attr('data-poszkodowany_id', '');
        $('.poszkodowany_naglowek_tresc').data('poszkodowany_id', '');

        $('.poszkodowany_imie').val('');
        $('.poszkodowany_imie').parent().removeClass('zablokowane_pole');
        $('.poszkodowany_nazwisko').val('');
        $('.poszkodowany_nazwisko').parent().removeClass('zablokowane_pole');
        $('.poszkodowany_ulica').val('');
        $('.poszkodowany_ulica').parent().removeClass('zablokowane_pole');
        $('.poszkodowany_nr_domu').val('');
        $('.poszkodowany_nr_domu').parent().removeClass('zablokowane_pole');
        $('.poszkodowany_nr_mieszkania').val('');
        $('.poszkodowany_nr_mieszkania').parent().removeClass('zablokowane_pole');
        $('.poszkodowany_kod_pocztowy').val('');
        $('.poszkodowany_kod_pocztowy').parent().removeClass('zablokowane_pole');
        $('.poszkodowany_miejscowosc').val('');
        $('.poszkodowany_miejscowosc').parent().removeClass('zablokowane_pole');
        $('.poszkodowany_pesel').val('');
        $('.poszkodowany_pesel').parent().removeClass('zablokowane_pole');
        $('.poszkodowany_seria_i_numer_dowodu').val('');
        $('.poszkodowany_seria_i_numer_dowodu').parent().removeClass('zablokowane_pole');
        $('.poszkodowany_email').val('');
        $('.poszkodowany_email').parent().removeClass('zablokowane_pole');
        $('.poszkodowany_tel').val('');
        $('.poszkodowany_tel').parent().removeClass('zablokowane_pole');
        $('.poszkodowany_dokument').val('');
        $('.poszkodowany_dokument').parent().removeClass('zablokowane_pole');
        $('.poszkodowany_numer_dokumentu').val('');
        $('.poszkodowany_numer_dokumentu').parent().removeClass('zablokowane_pole');

    });

}


function dane_poszkodowanego() {
    $('.obcokrajowiec_tak').click(function () {
        $(this).parent().parent().find('.obcokrajowiec_nie').removeClass('zaznaczone');

        $(this).parent().parent().find('.obcokrajowiec_tak').addClass('zaznaczone');
        $(this).parent().parent().find('.dokument_obcokrajowca').show();
        $(this).parent().parent().find('.dokument_polski').hide();
        $(this).parent().parent().find('.poszkodowany_pesel').val('');
        $(this).parent().parent().find('.poszkodowany_seria_i_numer_dowodu').val('');

    });

    $('.obcokrajowiec_nie').click(function () {
        $(this).parent().parent().find('.obcokrajowiec_tak').removeClass('zaznaczone');
        $(this).parent().parent().find('.obcokrajowiec_nie').addClass('zaznaczone');
        $(this).parent().parent().find('.dokument_polski').show();
        $(this).parent().parent().find('.dokument_obcokrajowca').hide();
        $(this).parent().parent().find('.poszkodowany_dokument').val('');
        $(this).parent().parent().find('.poszkodowany_numer_dokumentu').val('');

    });

}

function pozostale_roszczenia() {
    $('.dr_zlecono_sprawe').click(function () {

        if ($('.dr_zlecono_sprawe').hasClass('zaznaczone')) {
            $('.dr_nie_zlecano_innym').removeClass('zaznaczone');
            $('.dr_zlecono_sprawe_o_o').slideDown();
            $('.dr_zs_wypowiedziano_umowe_data').slideDown();
        } else {
            $('.dr_zlecono_sprawe').removeClass('zaznaczone');
            $('.dr_zs_wypowiedziano_umowe_data').val('');
            $('.dr_zs_data_umowy').val('');
            $('.dr_zs_nazwa').val('');
            $('.dr_zlecono_sprawe_o_o').slideUp();
            $('.dr_zs_wypowiedziano_umowe_data').slideUp();
            $('.dr_zs_wypowiedziano_umowe_opcja').removeClass('zaznaczone');
        }
    });
    $('.dr_nie_zlecano_innym').click(function () {

        if ($('.dr_nie_zlecano_innym').hasClass('zaznaczone')) {
            $('.dr_zlecono_sprawe').removeClass('zaznaczone');
            $('.dr_zs_wypowiedziano_umowe_opcja').removeClass('zaznaczone');
            $('.dr_zs_wypowiedziano_umowe_data').val('');
            $('.dr_zs_data_umowy').val('');
            $('.dr_zs_nazwa').val('');
            $('.dr_zlecono_sprawe_o_o').slideUp();
            $('.dr_zs_wypowiedziano_umowe_data').slideUp();

        } else {
            $('.dr_zlecono_sprawe').removeClass('zaznaczone');

        }
    });
    $('.dr_zs_wypowiedziano_umowe_opcja').click(function () {

        if ($('.dr_zs_wypowiedziano_umowe_opcja').hasClass('zaznaczone')) {

        } else {
            $('.dr_zs_wypowiedziano_umowe_opcja').removeClass('zaznaczone');
            $('.dr_zs_wypowiedziano_umowe_data').val('');
        }
    });


    //*---------------medyk 24-08-2016------------------


    $('.dr_zgoda_tak').click(function () {
        if ($(this).hasClass('zaznaczone')) {
            $('.dr_rodaj_inf_o').show();
            $('.dr_zgoda_nie').removeClass('zaznaczone');

        } else {
            $('.dr_rodaj_inf_o').hide();
            $('.dr_zgoda_tak').removeClass('zaznaczone');
        }
    });

    $('.dr_zgoda_nie').click(function () {
        if ($(this).hasClass('zaznaczone')) {
            $('.dr_rodaj_inf_o').hide();
            $('.dr_zgoda_tak').removeClass('zaznaczone');
            $('.dr_sms').removeClass('zaznaczone');
            $('.dr_email').removeClass('zaznaczone');

        } else {
            $('.dr_rodaj_inf_o').show();
            $('.dr_zgoda_nie').removeClass('zaznaczone');
        }
    });

    $('.dr_sms').click(function () {
        if ($(this).hasClass('zaznaczone')) {
            $('.dr_zgoda_tak').addClass('zaznaczone');
            $('.dr_zgoda_nie').removeClass('zaznaczone');
        }
    });
    $('.dr_email').click(function () {
        if ($(this).hasClass('zaznaczone')) {
            $('.dr_zgoda_tak').addClass('zaznaczone');
            $('.dr_zgoda_nie').removeClass('zaznaczone');
        }
    });


    //*-------------------------------------------------
}

function inne_odszkodowania() {


    $('.io_zgloszono_nnw').click(function () {
        if ($('.io_zgloszono_nnw').hasClass('zaznaczone')) {
            $('.io_zgloszono_nnw_nazwa').slideDown();
        } else {
            $('.io_zgloszono_nnw_nazwa').slideUp();
            $('.io_zgloszono_nnw_nazwa').val('');

        }
    });
    
    $('.jednorazowe_odszkodowanie').click(function () {
        if ($('.jednorazowe_odszkodowanie').hasClass('zaznaczone')) {
            $('.io_kwota_odszkodowania').slideDown();
        } else {
            $('.io_kwota_odszkodowania').slideUp();
            $('.io_kwota_odszkodowania').val('');

        }
    });

    $('.io_uszczerbek_nnw').click(function () {
        if ($('.io_uszczerbek_nnw').hasClass('zaznaczone')) {
            $('.io_procent_uszczerbku_nnw').slideDown();
        } else {
            $('.io_procent_uszczerbku_nnw').slideUp();
            $('.io_procent_uszczerbku_nnw').val('');

        }
    });
    
    $('.io_okresowe ').click(function () {
            $('.io_calkowite').removeClass('zaznaczone');
            $('.io_czesciowe').removeClass('zaznaczone');
            $('.io_trwale').removeClass('zaznaczone');
            $('.io_orzeczenie').addClass('zaznaczone');
            
    });
    
    $('.io_calkowite ').click(function () {
        $('.io_okresowe').removeClass('zaznaczone');
        $('.io_czesciowe').removeClass('zaznaczone');
        $('.io_trwale').removeClass('zaznaczone');
        $('.io_okresowe_data ').val('');
        $('.io_orzeczenie').addClass('zaznaczone');
    });
    
    $('.io_czesciowe ').click(function () {
        $('.io_calkowite').removeClass('zaznaczone');
        $('.io_okresowe').removeClass('zaznaczone');
        $('.io_trwale').removeClass('zaznaczone');
        $('.io_okresowe_data ').val('');
        $('.io_orzeczenie').addClass('zaznaczone');
    });
    
    $('.io_trwale ').click(function () {
        $('.io_calkowite').removeClass('zaznaczone');
        $('.io_czesciowe').removeClass('zaznaczone');
        $('.io_okresowe').removeClass('zaznaczone');
        $('.io_okresowe_data ').val('');
    });
    
    $('.io_okresowe ').click(function () {
        if ($('.io_okresowe ').hasClass('zaznaczone')) {
            $('.io_okresowe_data ').slideDown();
        } else {
            $('.io_okresowe_data ').slideUp();
            $('.io_okresowe_data ').val('');

        }
    });
    
    $('.zwolnienie_lekarskie ').click(function () {
        if (!($('.zwolnienie_lekarskie ').hasClass('zaznaczone'))) {
            $('.data_niezdolnosci_od').val('');
            $('.data_niezdolnosci_do').val('');
        } 
    });
    
    $('.data_niezdolnosci_od').click(function () {
        $('.zwolnienie_lekarskie ').addClass('zaznaczone');
    });
    $('.data_niezdolnosci_do').click(function () {
        $('.zwolnienie_lekarskie ').addClass('zaznaczone');
    });
    
    $('.io_orzeczenie').click(function () {
        if (!($('.io_orzeczenie').hasClass('zaznaczone'))) {
            $('.io_okresowe_data ').val('');
            $('.io_calkowite').removeClass('zaznaczone');
            $('.io_czesciowe').removeClass('zaznaczone');
            $('.io_trwale').removeClass('zaznaczone');
            $('.io_okresowe').removeClass('zaznaczone');
        } 
    });
    $('.io_zus').click(function () {
        $('.io_krus').removeClass('zaznaczone');
        $('.io_inne').removeClass('zaznaczone');
        $('.io_inne_nazwa').val('');
    });
    $('.io_krus').click(function () {
        $('.io_zus').removeClass('zaznaczone');
        $('.io_inne').removeClass('zaznaczone');
        $('.io_inne_nazwa').val('');
    });
    $('.io_inne').click(function () {
        $('.io_krus').removeClass('zaznaczone');
        $('.io_zus').removeClass('zaznaczone');
    });
    $('.io_renta').click(function () {
        $('.io_inne_swiadczenie').removeClass('zaznaczone');
        $('.io_inne_swiadczenie_nazwa').val('');
        $('.io_inne_swiadczenie_nazwa ').slideUp();
    });
    $('.io_inne_swiadczenie').click(function () {
        $('.io_renta').removeClass('zaznaczone');
        $('.io_inne_swiadczenie_nazwa').slideDown();
    });


    $('.io_wypadek_przy_pracy').click(function () {
        if ($('.io_wypadek_przy_pracy').hasClass('zaznaczone')) {
            $('.io_wypadek_w_drodze_do_pracy').removeClass('zaznaczone');
            $('.inf_o_szkodzie').slideDown();
            $('.io_wypadek_zgloszono_inne_nazwa').slideUp();
            $('.io_wypadek_zgloszono_zus_o').slideDown();
            $('.io_wypadek_zgloszono_krus_o').slideDown();
            $('.io_wypadek_zgloszono_inne_o').slideDown();
        } else {
            $('.inf_o_szkodzie').slideUp();
            $('.io_wypadek_zgloszono_zus_o').slideUp();
            $('.io_wypadek_zgloszono_krus_o').slideUp();
            $('.io_wypadek_zgloszono_inne_o').slideUp();
            $('.io_wypadek_zgloszono_inne_nazwa').slideUp();
            $('.io_wypadek_zgloszono_inne_nazwa').val('');
            $('.io_wypadek_zgloszono_zus').removeClass('zaznaczone');
            $('.io_wypadek_zgloszono_krus').removeClass('zaznaczone');
            $('.io_wypadek_zgloszono_inne').removeClass('zaznaczone');
        }
    });

    $('.io_wypadek_w_drodze_do_pracy').click(function () {
        if ($('.io_wypadek_w_drodze_do_pracy').hasClass('zaznaczone')) {
            $('.io_wypadek_przy_pracy').removeClass('zaznaczone');
            $('.inf_o_szkodzie').slideDown();
            $('.io_wypadek_zgloszono_inne_nazwa').slideUp();
            $('.io_wypadek_zgloszono_zus_o').slideDown();
            $('.io_wypadek_zgloszono_krus_o').slideDown();
            $('.io_wypadek_zgloszono_inne_o').slideDown();
        } else {
            $('.inf_o_szkodzie').slideUp();
            $('.io_wypadek_zgloszono_zus_o').slideUp();
            $('.io_wypadek_zgloszono_krus_o').slideUp();
            $('.io_wypadek_zgloszono_inne_o').slideUp();
            $('.io_wypadek_zgloszono_inne_nazwa').slideUp();
            $('.io_wypadek_zgloszono_inne_nazwa').val('');
            $('.io_wypadek_zgloszono_zus').removeClass('zaznaczone');
            $('.io_wypadek_zgloszono_krus').removeClass('zaznaczone');
            $('.io_wypadek_zgloszono_inne').removeClass('zaznaczone');
        }
    });

    $('.io_wypadek_zgloszono_inne').click(function () {

        if ($('.io_wypadek_zgloszono_inne').hasClass('zaznaczone')) {
            $('.io_wypadek_zgloszono_krus').removeClass('zaznaczone');
            $('.io_wypadek_zgloszono_zus').removeClass('zaznaczone');
            $('.io_wypadek_zgloszono_inne_nazwa').slideDown();
        } else {
            $('.io_wypadek_zgloszono_inne_nazwa').val('');
            $('.io_wypadek_zgloszono_inne_nazwa').slideUp();
        }
    });

    $('.io_wypadek_zgloszono_krus').click(function () {

        if ($('.io_wypadek_zgloszono_krus').hasClass('zaznaczone')) {
            $('.io_wypadek_zgloszono_zus').removeClass('zaznaczone');
            $('.io_wypadek_zgloszono_inne').removeClass('zaznaczone');
            $('.io_wypadek_zgloszono_inne_nazwa').val('');
            $('.io_wypadek_zgloszono_inne_nazwa').slideUp();
        }
    })

    $('.io_wypadek_zgloszono_zus').click(function () {

        if ($('.io_wypadek_zgloszono_zus').hasClass('zaznaczone')) {
            $('.io_wypadek_zgloszono_krus').removeClass('zaznaczone');
            $('.io_wypadek_zgloszono_inne').removeClass('zaznaczone');
            $('.io_wypadek_zgloszono_inne_nazwa').val('');
            $('.io_wypadek_zgloszono_inne_nazwa').slideUp();
        }
    });
    //*---------------medyk 24-08-2016------------------  
    //*-------------------------------------------------

}

function oswiadczenie_uprawnionego() {


    $('.ou_iz_w_podstawowe').click(function () {
        $('.ou_iz_w_zawodowe').removeClass('zaznaczone');
        $('.ou_iz_w_srednie').removeClass('zaznaczone');
        $('.ou_iz_w_wyzsze').removeClass('zaznaczone');
    });
    $('.ou_iz_w_zawodowe').click(function () {
        $('.ou_iz_w_podstawowe').removeClass('zaznaczone');
        $('.ou_iz_w_srednie').removeClass('zaznaczone');
        $('.ou_iz_w_wyzsze').removeClass('zaznaczone');
    });
    $('.ou_iz_w_srednie').click(function () {
        $('.ou_iz_w_zawodowe').removeClass('zaznaczone');
        $('.ou_iz_w_podstawowe').removeClass('zaznaczone');
        $('.ou_iz_w_wyzsze').removeClass('zaznaczone');
    });
    $('.ou_iz_w_wyzsze').click(function () {
        $('.ou_iz_w_zawodowe').removeClass('zaznaczone');
        $('.ou_iz_w_srednie').removeClass('zaznaczone');
        $('.ou_iz_w_podstawowe').removeClass('zaznaczone');
    });

    $('.ou_iz_zat_brak').click(function () {
        $('.ou_iz_zat_uop').removeClass('zaznaczone');
        $('.ou_iz_zat_uz').removeClass('zaznaczone');
        $('.ou_iz_zat_wdg').removeClass('zaznaczone');
        $('.ou_iz_zat_gr').removeClass('zaznaczone');
        $('.ou_iz_zat_pd').removeClass('zaznaczone');
        $('.ou_iz_zat_inne').removeClass('zaznaczone');
        $('.ou_iz_zat_inne_nazwa').val('');
        $('.ou_iz_zat_inne_nazwa').slideUp();
    });
    $('.ou_iz_zat_uop').click(function () {
        $('.ou_iz_zat_brak').removeClass('zaznaczone');
        $('.ou_iz_zat_uz').removeClass('zaznaczone');
        $('.ou_iz_zat_wdg').removeClass('zaznaczone');
        $('.ou_iz_zat_gr').removeClass('zaznaczone');
        $('.ou_iz_zat_pd').removeClass('zaznaczone');
        $('.ou_iz_zat_inne').removeClass('zaznaczone');
        $('.ou_iz_zat_inne_nazwa').val('');
        $('.ou_iz_zat_inne_nazwa').slideUp();
    });
    $('.ou_iz_zat_uz').click(function () {
        $('.ou_iz_zat_brak').removeClass('zaznaczone');
        $('.ou_iz_zat_uop').removeClass('zaznaczone');
        $('.ou_iz_zat_wdg').removeClass('zaznaczone');
        $('.ou_iz_zat_gr').removeClass('zaznaczone');
        $('.ou_iz_zat_pd').removeClass('zaznaczone');
        $('.ou_iz_zat_inne').removeClass('zaznaczone');
        $('.ou_iz_zat_inne_nazwa').val('');
        $('.ou_iz_zat_inne_nazwa').slideUp();
    });
    $('.ou_iz_zat_wdg').click(function () {
        $('.ou_iz_zat_brak').removeClass('zaznaczone');
        $('.ou_iz_zat_uop').removeClass('zaznaczone');
        $('.ou_iz_zat_uz').removeClass('zaznaczone');
        $('.ou_iz_zat_gr').removeClass('zaznaczone');
        $('.ou_iz_zat_pd').removeClass('zaznaczone');
        $('.ou_iz_zat_inne').removeClass('zaznaczone');
        $('.ou_iz_zat_inne_nazwa').val('');
        $('.ou_iz_zat_inne_nazwa').slideUp();
    });
    $('.ou_iz_zat_gr').click(function () {
        $('.ou_iz_zat_brak').removeClass('zaznaczone');
        $('.ou_iz_zat_uop').removeClass('zaznaczone');
        $('.ou_iz_zat_uz').removeClass('zaznaczone');
        $('.ou_iz_zat_wdg').removeClass('zaznaczone');
        $('.ou_iz_zat_pd').removeClass('zaznaczone');
        $('.ou_iz_zat_inne').removeClass('zaznaczone');
        $('.ou_iz_zat_inne_nazwa').val('');
        $('.ou_iz_zat_inne_nazwa').slideUp();
    });
    $('.ou_iz_zat_pd').click(function () {
        $('.ou_iz_zat_brak').removeClass('zaznaczone');
        $('.ou_iz_zat_uop').removeClass('zaznaczone');
        $('.ou_iz_zat_uz').removeClass('zaznaczone');
        $('.ou_iz_zat_wdg').removeClass('zaznaczone');
        $('.ou_iz_zat_gr').removeClass('zaznaczone');
        $('.ou_iz_zat_inne').removeClass('zaznaczone');
        $('.ou_iz_zat_inne_nazwa').val('');
        $('.ou_iz_zat_inne_nazwa').slideUp();
    });
    $('.ou_iz_zat_inne').click(function () {
        $('.ou_iz_zat_brak').removeClass('zaznaczone');
        $('.ou_iz_zat_uop').removeClass('zaznaczone');
        $('.ou_iz_zat_uz').removeClass('zaznaczone');
        $('.ou_iz_zat_wdg').removeClass('zaznaczone');
        $('.ou_iz_zat_gr').removeClass('zaznaczone');
        $('.ou_iz_zat_pd').removeClass('zaznaczone');
        $('.ou_iz_zat_inne_nazwa').slideDown();
    });

    $('.ou_iu_w_podstawowe').click(function () {
        $('.ou_iu_w_zawodowe').removeClass('zaznaczone');
        $('.ou_iu_w_srednie').removeClass('zaznaczone');
        $('.ou_iu_w_wyzsze').removeClass('zaznaczone');
    });
    $('.ou_iu_w_zawodowe').click(function () {
        $('.ou_iu_w_podstawowe').removeClass('zaznaczone');
        $('.ou_iu_w_srednie').removeClass('zaznaczone');
        $('.ou_iu_w_wyzsze').removeClass('zaznaczone');
    });
    $('.ou_iu_w_srednie').click(function () {
        $('.ou_iu_w_zawodowe').removeClass('zaznaczone');
        $('.ou_iu_w_podstawowe').removeClass('zaznaczone');
        $('.ou_iu_w_wyzsze').removeClass('zaznaczone');
    });
    $('.ou_iu_w_wyzsze').click(function () {
        $('.ou_iu_w_zawodowe').removeClass('zaznaczone');
        $('.ou_iu_w_srednie').removeClass('zaznaczone');
        $('.ou_iu_w_podstawowe').removeClass('zaznaczone');
    });

    $('.ou_iu_zat_brak').click(function () {
        $('.ou_iu_zat_uop').removeClass('zaznaczone');
        $('.ou_iu_zat_uz').removeClass('zaznaczone');
        $('.ou_iu_zat_wdg').removeClass('zaznaczone');
        $('.ou_iu_zat_gr').removeClass('zaznaczone');
        $('.ou_iu_zat_pd').removeClass('zaznaczone');
        $('.ou_iu_zat_inne').removeClass('zaznaczone');
        $('.ou_iu_zat_inne_nazwa').val('');
        $('.ou_iu_zat_inne_nazwa').slideUp();
    });
    $('.ou_iu_zat_uop').click(function () {
        $('.ou_iu_zat_brak').removeClass('zaznaczone');
        $('.ou_iu_zat_uz').removeClass('zaznaczone');
        $('.ou_iu_zat_wdg').removeClass('zaznaczone');
        $('.ou_iu_zat_gr').removeClass('zaznaczone');
        $('.ou_iu_zat_pd').removeClass('zaznaczone');
        $('.ou_iu_zat_inne').removeClass('zaznaczone');
        $('.ou_iu_zat_inne_nazwa').val('');
        $('.ou_iu_zat_inne_nazwa').slideUp();
    });
    $('.ou_iu_zat_uz').click(function () {
        $('.ou_iu_zat_brak').removeClass('zaznaczone');
        $('.ou_iu_zat_uop').removeClass('zaznaczone');
        $('.ou_iu_zat_wdg').removeClass('zaznaczone');
        $('.ou_iu_zat_gr').removeClass('zaznaczone');
        $('.ou_iu_zat_pd').removeClass('zaznaczone');
        $('.ou_iu_zat_inne').removeClass('zaznaczone');
        $('.ou_iu_zat_inne_nazwa').val('');
        $('.ou_iu_zat_inne_nazwa').slideUp();
    });
    $('.ou_iu_zat_wdg').click(function () {
        $('.ou_iu_zat_brak').removeClass('zaznaczone');
        $('.ou_iu_zat_uop').removeClass('zaznaczone');
        $('.ou_iu_zat_uz').removeClass('zaznaczone');
        $('.ou_iu_zat_gr').removeClass('zaznaczone');
        $('.ou_iu_zat_pd').removeClass('zaznaczone');
        $('.ou_iu_zat_inne').removeClass('zaznaczone');
        $('.ou_iu_zat_inne_nazwa').val('');
        $('.ou_iu_zat_inne_nazwa').slideUp();
    });
    $('.ou_iu_zat_gr').click(function () {
        $('.ou_iu_zat_brak').removeClass('zaznaczone');
        $('.ou_iu_zat_uop').removeClass('zaznaczone');
        $('.ou_iu_zat_uz').removeClass('zaznaczone');
        $('.ou_iu_zat_wdg').removeClass('zaznaczone');
        $('.ou_iu_zat_pd').removeClass('zaznaczone');
        $('.ou_iu_zat_inne').removeClass('zaznaczone');
        $('.ou_iu_zat_inne_nazwa').val('');
        $('.ou_iu_zat_inne_nazwa').slideUp();
    });
    $('.ou_iu_zat_pd').click(function () {
        $('.ou_iu_zat_brak').removeClass('zaznaczone');
        $('.ou_iu_zat_uop').removeClass('zaznaczone');
        $('.ou_iu_zat_uz').removeClass('zaznaczone');
        $('.ou_iu_zat_wdg').removeClass('zaznaczone');
        $('.ou_iu_zat_gr').removeClass('zaznaczone');
        $('.ou_iu_zat_inne').removeClass('zaznaczone');
        $('.ou_iu_zat_inne_nazwa').val('');
        $('.ou_iu_zat_inne_nazwa').slideUp();
    });
    $('.ou_iu_zat_inne').click(function () {
        $('.ou_iu_zat_brak').removeClass('zaznaczone');
        $('.ou_iu_zat_uop').removeClass('zaznaczone');
        $('.ou_iu_zat_uz').removeClass('zaznaczone');
        $('.ou_iu_zat_wdg').removeClass('zaznaczone');
        $('.ou_iu_zat_gr').removeClass('zaznaczone');
        $('.ou_iu_zat_pd').removeClass('zaznaczone');
        $('.ou_iu_zat_inne_nazwa').slideDown();
    });

    $('.ou_srm_zdu_z').click(function () {
        $('.ou_srm_zdu_m').removeClass('zaznaczone');
        $('.ou_srm_zdu_pk').removeClass('zaznaczone');
        $('.ou_srm_zdu_pm').removeClass('zaznaczone');
        $('.ou_srm_zdu_ma').removeClass('zaznaczone');
        $('.ou_srm_zdu_o').removeClass('zaznaczone');
        $('.ou_srm_zdu_c').removeClass('zaznaczone');
        $('.ou_srm_zdu_s').removeClass('zaznaczone');
        $('.ou_srm_zdu_si').removeClass('zaznaczone');
        $('.ou_srm_zdu_b').removeClass('zaznaczone');
        $('.ou_srm_zdu_wk').removeClass('zaznaczone');
        $('.ou_srm_zdu_wm').removeClass('zaznaczone');
        $('.ou_srm_zdu_dz').removeClass('zaznaczone');
        $('.ou_srm_zdu_ba').removeClass('zaznaczone');
        $('.ou_srm_zdu_inne').removeClass('zaznaczone');
        $('.ou_srm_zdu_inne_rodzaj').val('');
        $('.ou_srm_zdu_inne_rodzaj').slideUp();
    });
    $('.ou_srm_zdu_m').click(function () {
        $('.ou_srm_zdu_z').removeClass('zaznaczone');
        $('.ou_srm_zdu_pk').removeClass('zaznaczone');
        $('.ou_srm_zdu_pm').removeClass('zaznaczone');
        $('.ou_srm_zdu_ma').removeClass('zaznaczone');
        $('.ou_srm_zdu_o').removeClass('zaznaczone');
        $('.ou_srm_zdu_c').removeClass('zaznaczone');
        $('.ou_srm_zdu_s').removeClass('zaznaczone');
        $('.ou_srm_zdu_si').removeClass('zaznaczone');
        $('.ou_srm_zdu_b').removeClass('zaznaczone');
        $('.ou_srm_zdu_wk').removeClass('zaznaczone');
        $('.ou_srm_zdu_wm').removeClass('zaznaczone');
        $('.ou_srm_zdu_dz').removeClass('zaznaczone');
        $('.ou_srm_zdu_ba').removeClass('zaznaczone');
        $('.ou_srm_zdu_inne').removeClass('zaznaczone');
        $('.ou_srm_zdu_inne_rodzaj').val('');
        $('.ou_srm_zdu_inne_rodzaj').slideUp();
    });
    $('.ou_srm_zdu_pk').click(function () {
        $('.ou_srm_zdu_z').removeClass('zaznaczone');
        $('.ou_srm_zdu_m').removeClass('zaznaczone');
        $('.ou_srm_zdu_pm').removeClass('zaznaczone');
        $('.ou_srm_zdu_ma').removeClass('zaznaczone');
        $('.ou_srm_zdu_o').removeClass('zaznaczone');
        $('.ou_srm_zdu_c').removeClass('zaznaczone');
        $('.ou_srm_zdu_s').removeClass('zaznaczone');
        $('.ou_srm_zdu_si').removeClass('zaznaczone');
        $('.ou_srm_zdu_b').removeClass('zaznaczone');
        $('.ou_srm_zdu_wk').removeClass('zaznaczone');
        $('.ou_srm_zdu_wm').removeClass('zaznaczone');
        $('.ou_srm_zdu_dz').removeClass('zaznaczone');
        $('.ou_srm_zdu_ba').removeClass('zaznaczone');
        $('.ou_srm_zdu_inne').removeClass('zaznaczone');
        $('.ou_srm_zdu_inne_rodzaj').val('');
        $('.ou_srm_zdu_inne_rodzaj').slideUp();
    });
    $('.ou_srm_zdu_pm').click(function () {
        $('.ou_srm_zdu_z').removeClass('zaznaczone');
        $('.ou_srm_zdu_m').removeClass('zaznaczone');
        $('.ou_srm_zdu_pk').removeClass('zaznaczone');
        $('.ou_srm_zdu_ma').removeClass('zaznaczone');
        $('.ou_srm_zdu_o').removeClass('zaznaczone');
        $('.ou_srm_zdu_c').removeClass('zaznaczone');
        $('.ou_srm_zdu_s').removeClass('zaznaczone');
        $('.ou_srm_zdu_si').removeClass('zaznaczone');
        $('.ou_srm_zdu_b').removeClass('zaznaczone');
        $('.ou_srm_zdu_wk').removeClass('zaznaczone');
        $('.ou_srm_zdu_wm').removeClass('zaznaczone');
        $('.ou_srm_zdu_dz').removeClass('zaznaczone');
        $('.ou_srm_zdu_ba').removeClass('zaznaczone');
        $('.ou_srm_zdu_inne').removeClass('zaznaczone');
        $('.ou_srm_zdu_inne_rodzaj').val('');
        $('.ou_srm_zdu_inne_rodzaj').slideUp();
    });
    $('.ou_srm_zdu_ma').click(function () {
        $('.ou_srm_zdu_z').removeClass('zaznaczone');
        $('.ou_srm_zdu_m').removeClass('zaznaczone');
        $('.ou_srm_zdu_pk').removeClass('zaznaczone');
        $('.ou_srm_zdu_pm').removeClass('zaznaczone');
        $('.ou_srm_zdu_o').removeClass('zaznaczone');
        $('.ou_srm_zdu_c').removeClass('zaznaczone');
        $('.ou_srm_zdu_s').removeClass('zaznaczone');
        $('.ou_srm_zdu_si').removeClass('zaznaczone');
        $('.ou_srm_zdu_b').removeClass('zaznaczone');
        $('.ou_srm_zdu_wk').removeClass('zaznaczone');
        $('.ou_srm_zdu_wm').removeClass('zaznaczone');
        $('.ou_srm_zdu_dz').removeClass('zaznaczone');
        $('.ou_srm_zdu_ba').removeClass('zaznaczone');
        $('.ou_srm_zdu_inne').removeClass('zaznaczone');
        $('.ou_srm_zdu_inne_rodzaj').val('');
        $('.ou_srm_zdu_inne_rodzaj').slideUp();
    });
    $('.ou_srm_zdu_o').click(function () {
        $('.ou_srm_zdu_z').removeClass('zaznaczone');
        $('.ou_srm_zdu_m').removeClass('zaznaczone');
        $('.ou_srm_zdu_pk').removeClass('zaznaczone');
        $('.ou_srm_zdu_pm').removeClass('zaznaczone');
        $('.ou_srm_zdu_ma').removeClass('zaznaczone');
        $('.ou_srm_zdu_c').removeClass('zaznaczone');
        $('.ou_srm_zdu_s').removeClass('zaznaczone');
        $('.ou_srm_zdu_si').removeClass('zaznaczone');
        $('.ou_srm_zdu_b').removeClass('zaznaczone');
        $('.ou_srm_zdu_wk').removeClass('zaznaczone');
        $('.ou_srm_zdu_wm').removeClass('zaznaczone');
        $('.ou_srm_zdu_dz').removeClass('zaznaczone');
        $('.ou_srm_zdu_ba').removeClass('zaznaczone');
        $('.ou_srm_zdu_inne').removeClass('zaznaczone');
        $('.ou_srm_zdu_inne_rodzaj').val('');
        $('.ou_srm_zdu_inne_rodzaj').slideUp();
    });
    $('.ou_srm_zdu_c').click(function () {
        $('.ou_srm_zdu_z').removeClass('zaznaczone');
        $('.ou_srm_zdu_m').removeClass('zaznaczone');
        $('.ou_srm_zdu_pk').removeClass('zaznaczone');
        $('.ou_srm_zdu_pm').removeClass('zaznaczone');
        $('.ou_srm_zdu_ma').removeClass('zaznaczone');
        $('.ou_srm_zdu_o').removeClass('zaznaczone');
        $('.ou_srm_zdu_s').removeClass('zaznaczone');
        $('.ou_srm_zdu_si').removeClass('zaznaczone');
        $('.ou_srm_zdu_b').removeClass('zaznaczone');
        $('.ou_srm_zdu_wk').removeClass('zaznaczone');
        $('.ou_srm_zdu_wm').removeClass('zaznaczone');
        $('.ou_srm_zdu_dz').removeClass('zaznaczone');
        $('.ou_srm_zdu_ba').removeClass('zaznaczone');
        $('.ou_srm_zdu_inne').removeClass('zaznaczone');
        $('.ou_srm_zdu_inne_rodzaj').val('');
        $('.ou_srm_zdu_inne_rodzaj').slideUp();
    });
    $('.ou_srm_zdu_s').click(function () {
        $('.ou_srm_zdu_z').removeClass('zaznaczone');
        $('.ou_srm_zdu_m').removeClass('zaznaczone');
        $('.ou_srm_zdu_pk').removeClass('zaznaczone');
        $('.ou_srm_zdu_pm').removeClass('zaznaczone');
        $('.ou_srm_zdu_ma').removeClass('zaznaczone');
        $('.ou_srm_zdu_o').removeClass('zaznaczone');
        $('.ou_srm_zdu_c').removeClass('zaznaczone');
        $('.ou_srm_zdu_si').removeClass('zaznaczone');
        $('.ou_srm_zdu_b').removeClass('zaznaczone');
        $('.ou_srm_zdu_wk').removeClass('zaznaczone');
        $('.ou_srm_zdu_wm').removeClass('zaznaczone');
        $('.ou_srm_zdu_dz').removeClass('zaznaczone');
        $('.ou_srm_zdu_ba').removeClass('zaznaczone');
        $('.ou_srm_zdu_inne').removeClass('zaznaczone');
        $('.ou_srm_zdu_inne_rodzaj').val('');
        $('.ou_srm_zdu_inne_rodzaj').slideUp();
    });
    $('.ou_srm_zdu_si').click(function () {
        $('.ou_srm_zdu_z').removeClass('zaznaczone');
        $('.ou_srm_zdu_m').removeClass('zaznaczone');
        $('.ou_srm_zdu_pk').removeClass('zaznaczone');
        $('.ou_srm_zdu_pm').removeClass('zaznaczone');
        $('.ou_srm_zdu_ma').removeClass('zaznaczone');
        $('.ou_srm_zdu_o').removeClass('zaznaczone');
        $('.ou_srm_zdu_c').removeClass('zaznaczone');
        $('.ou_srm_zdu_s').removeClass('zaznaczone');
        $('.ou_srm_zdu_b').removeClass('zaznaczone');
        $('.ou_srm_zdu_wk').removeClass('zaznaczone');
        $('.ou_srm_zdu_wm').removeClass('zaznaczone');
        $('.ou_srm_zdu_dz').removeClass('zaznaczone');
        $('.ou_srm_zdu_ba').removeClass('zaznaczone');
        $('.ou_srm_zdu_inne').removeClass('zaznaczone');
        $('.ou_srm_zdu_inne_rodzaj').val('');
        $('.ou_srm_zdu_inne_rodzaj').slideUp();
    });
    $('.ou_srm_zdu_b').click(function () {
        $('.ou_srm_zdu_z').removeClass('zaznaczone');
        $('.ou_srm_zdu_m').removeClass('zaznaczone');
        $('.ou_srm_zdu_pk').removeClass('zaznaczone');
        $('.ou_srm_zdu_pm').removeClass('zaznaczone');
        $('.ou_srm_zdu_ma').removeClass('zaznaczone');
        $('.ou_srm_zdu_o').removeClass('zaznaczone');
        $('.ou_srm_zdu_c').removeClass('zaznaczone');
        $('.ou_srm_zdu_s').removeClass('zaznaczone');
        $('.ou_srm_zdu_si').removeClass('zaznaczone');
        $('.ou_srm_zdu_wk').removeClass('zaznaczone');
        $('.ou_srm_zdu_wm').removeClass('zaznaczone');
        $('.ou_srm_zdu_dz').removeClass('zaznaczone');
        $('.ou_srm_zdu_ba').removeClass('zaznaczone');
        $('.ou_srm_zdu_inne').removeClass('zaznaczone');
        $('.ou_srm_zdu_inne_rodzaj').val('');
        $('.ou_srm_zdu_inne_rodzaj').slideUp();
    });
    $('.ou_srm_zdu_wk').click(function () {
        $('.ou_srm_zdu_z').removeClass('zaznaczone');
        $('.ou_srm_zdu_m').removeClass('zaznaczone');
        $('.ou_srm_zdu_pk').removeClass('zaznaczone');
        $('.ou_srm_zdu_pm').removeClass('zaznaczone');
        $('.ou_srm_zdu_ma').removeClass('zaznaczone');
        $('.ou_srm_zdu_o').removeClass('zaznaczone');
        $('.ou_srm_zdu_c').removeClass('zaznaczone');
        $('.ou_srm_zdu_s').removeClass('zaznaczone');
        $('.ou_srm_zdu_si').removeClass('zaznaczone');
        $('.ou_srm_zdu_b').removeClass('zaznaczone');
        $('.ou_srm_zdu_wm').removeClass('zaznaczone');
        $('.ou_srm_zdu_dz').removeClass('zaznaczone');
        $('.ou_srm_zdu_ba').removeClass('zaznaczone');
        $('.ou_srm_zdu_inne').removeClass('zaznaczone');
        $('.ou_srm_zdu_inne_rodzaj').val('');
        $('.ou_srm_zdu_inne_rodzaj').slideUp();
    });
    $('.ou_srm_zdu_wm').click(function () {
        $('.ou_srm_zdu_z').removeClass('zaznaczone');
        $('.ou_srm_zdu_m').removeClass('zaznaczone');
        $('.ou_srm_zdu_pk').removeClass('zaznaczone');
        $('.ou_srm_zdu_pm').removeClass('zaznaczone');
        $('.ou_srm_zdu_ma').removeClass('zaznaczone');
        $('.ou_srm_zdu_o').removeClass('zaznaczone');
        $('.ou_srm_zdu_c').removeClass('zaznaczone');
        $('.ou_srm_zdu_s').removeClass('zaznaczone');
        $('.ou_srm_zdu_si').removeClass('zaznaczone');
        $('.ou_srm_zdu_b').removeClass('zaznaczone');
        $('.ou_srm_zdu_wk').removeClass('zaznaczone');
        $('.ou_srm_zdu_dz').removeClass('zaznaczone');
        $('.ou_srm_zdu_ba').removeClass('zaznaczone');
        $('.ou_srm_zdu_inne').removeClass('zaznaczone');
        $('.ou_srm_zdu_inne_rodzaj').val('');
        $('.ou_srm_zdu_inne_rodzaj').slideUp();
    });
    $('.ou_srm_zdu_dz').click(function () {
        $('.ou_srm_zdu_z').removeClass('zaznaczone');
        $('.ou_srm_zdu_m').removeClass('zaznaczone');
        $('.ou_srm_zdu_pk').removeClass('zaznaczone');
        $('.ou_srm_zdu_pm').removeClass('zaznaczone');
        $('.ou_srm_zdu_ma').removeClass('zaznaczone');
        $('.ou_srm_zdu_o').removeClass('zaznaczone');
        $('.ou_srm_zdu_c').removeClass('zaznaczone');
        $('.ou_srm_zdu_s').removeClass('zaznaczone');
        $('.ou_srm_zdu_si').removeClass('zaznaczone');
        $('.ou_srm_zdu_b').removeClass('zaznaczone');
        $('.ou_srm_zdu_wk').removeClass('zaznaczone');
        $('.ou_srm_zdu_wm').removeClass('zaznaczone');
        $('.ou_srm_zdu_ba').removeClass('zaznaczone');
        $('.ou_srm_zdu_inne').removeClass('zaznaczone');
        $('.ou_srm_zdu_inne_rodzaj').val('');
        $('.ou_srm_zdu_inne_rodzaj').slideUp();
    });
    $('.ou_srm_zdu_ba').click(function () {
        $('.ou_srm_zdu_z').removeClass('zaznaczone');
        $('.ou_srm_zdu_m').removeClass('zaznaczone');
        $('.ou_srm_zdu_pk').removeClass('zaznaczone');
        $('.ou_srm_zdu_pm').removeClass('zaznaczone');
        $('.ou_srm_zdu_ma').removeClass('zaznaczone');
        $('.ou_srm_zdu_o').removeClass('zaznaczone');
        $('.ou_srm_zdu_c').removeClass('zaznaczone');
        $('.ou_srm_zdu_s').removeClass('zaznaczone');
        $('.ou_srm_zdu_si').removeClass('zaznaczone');
        $('.ou_srm_zdu_b').removeClass('zaznaczone');
        $('.ou_srm_zdu_wk').removeClass('zaznaczone');
        $('.ou_srm_zdu_wm').removeClass('zaznaczone');
        $('.ou_srm_zdu_dz').removeClass('zaznaczone');
        $('.ou_srm_zdu_inne').removeClass('zaznaczone');
        $('.ou_srm_zdu_inne_rodzaj').val('');
        $('.ou_srm_zdu_inne_rodzaj').slideUp();
    });
    $('.ou_srm_zdu_inne').click(function () {
        $('.ou_srm_zdu_z').removeClass('zaznaczone');
        $('.ou_srm_zdu_m').removeClass('zaznaczone');
        $('.ou_srm_zdu_pk').removeClass('zaznaczone');
        $('.ou_srm_zdu_pm').removeClass('zaznaczone');
        $('.ou_srm_zdu_ma').removeClass('zaznaczone');
        $('.ou_srm_zdu_o').removeClass('zaznaczone');
        $('.ou_srm_zdu_c').removeClass('zaznaczone');
        $('.ou_srm_zdu_s').removeClass('zaznaczone');
        $('.ou_srm_zdu_si').removeClass('zaznaczone');
        $('.ou_srm_zdu_b').removeClass('zaznaczone');
        $('.ou_srm_zdu_wk').removeClass('zaznaczone');
        $('.ou_srm_zdu_wm').removeClass('zaznaczone');
        $('.ou_srm_zdu_dz').removeClass('zaznaczone');
        $('.ou_srm_zdu_ba').removeClass('zaznaczone');
        $('.ou_srm_zdu_inne_rodzaj').slideDown();
    });

    $('.ou_srm_pwo').click(function () {
        $('.ou_srm_npwo').removeClass('zaznaczone');
    });
    $('.ou_srm_npwo').click(function () {
        $('.ou_srm_pwo').removeClass('zaznaczone');
    });

    $('.ou_sudz_bz').click(function () {
        $('.ou_sudz_z').removeClass('zaznaczone');
        $('.ou_sudz_p').removeClass('zaznaczone');
        $('.ou_sudz_zle').removeClass('zaznaczone');
    });
    $('.ou_sudz_z').click(function () {
        $('.ou_sudz_bz').removeClass('zaznaczone');
        $('.ou_sudz_p').removeClass('zaznaczone');
        $('.ou_sudz_zle').removeClass('zaznaczone');
    });
    $('.ou_sudz_p').click(function () {
        $('.ou_sudz_bz').removeClass('zaznaczone');
        $('.ou_sudz_z').removeClass('zaznaczone');
        $('.ou_sudz_zle').removeClass('zaznaczone');
    });
    $('.ou_sudz_zle').click(function () {
        $('.ou_sudz_bz').removeClass('zaznaczone');
        $('.ou_sudz_z').removeClass('zaznaczone');
        $('.ou_sudz_p').removeClass('zaznaczone');
    });

    $('.ou_spscnr_sm_nuz').click(function () {
        $('.ou_spscnr_sm_psn').removeClass('zaznaczone');
        $('.ou_spscnr_sm_psz').removeClass('zaznaczone');
    });
    $('.ou_spscnr_sm_psn').click(function () {
        $('.ou_spscnr_sm_nuz').removeClass('zaznaczone');
        $('.ou_spscnr_sm_psz').removeClass('zaznaczone');
    });
    $('.ou_spscnr_sm_psz').click(function () {
        $('.ou_spscnr_sm_nuz').removeClass('zaznaczone');
        $('.ou_spscnr_sm_psn').removeClass('zaznaczone');
    });

    $('.ou_spscnr_mo_nuz').click(function () {
        $('.ou_spscnr_mo_psn').removeClass('zaznaczone');
        $('.ou_spscnr_mo_psz').removeClass('zaznaczone');
    });
    $('.ou_spscnr_mo_psn').click(function () {
        $('.ou_spscnr_mo_nuz').removeClass('zaznaczone');
        $('.ou_spscnr_mo_psz').removeClass('zaznaczone');
    });
    $('.ou_spscnr_mo_psz').click(function () {
        $('.ou_spscnr_mo_nuz').removeClass('zaznaczone');
        $('.ou_spscnr_mo_psn').removeClass('zaznaczone');
    });

    $('.ou_spscnr_wstrzas_o').click(function () {
        $('.ou_spscnr_wstrzas_no').removeClass('zaznaczone');
    });
    $('.ou_spscnr_wstrzas_no').click(function () {
        $('.ou_spscnr_wstrzas_o').removeClass('zaznaczone');
    });

    $('.ou_spscnr_zps_wk').click(function () {
        $('.ou_spscnr_zps_wm').removeClass('zaznaczone');

    });
    $('.ou_spscnr_zps_wm').click(function () {
        $('.ou_spscnr_zps_wk').removeClass('zaznaczone');

    });



    $('.ou_spscnr_zps_dz').click(function () {
        var dzieci = ($('.ou_spscnr_zps_dz').hasClass('zaznaczone')) ? '1' : '0';

        if (dzieci == '1') {
            $('.ou_spscnr_zps_dz_l').slideDown();
            $('.ou_spscnr_zps_dz_w').slideDown();
        } else {
            $('.ou_spscnr_zps_dz_l').val('');
            $('.ou_spscnr_zps_dz_w').val('');
            $('.ou_spscnr_zps_dz_l').slideUp();
            $('.ou_spscnr_zps_dz_w').slideUp();
        }
    });

}



function rozwin_tresc_naglowka() {
    $('.informacje_o_zmarlym_naglowek_tresc').click(function () {
        $(this).next('div').slideToggle();
    });
    $('.informacje_o_uprawnionym_naglowek_tresc').click(function () {
        $(this).next('div').slideToggle();
    });
    $('.stosunki_rodzinne_majatkowe_naglowek_tresc').click(function () {
        $(this).next('div').slideToggle();
    });
    $('.sytuacja_po_smierci_naglowek_tresc').click(function () {
        $(this).next('div').slideToggle();
    });
}

function wynagrodzenie() {

    $('.zleceniodawca_odbiorca').click(function () {

        if ($('.zleceniodawca_odbiorca').hasClass('zaznaczone')) {

            var imie = $('#zakladki_tresc').data('imie');
            var nazwisko = $('#zakladki_tresc').data('nazwisko');
            var ulica = $('#zakladki_tresc').data('ulica');
            var dom = $('#zakladki_tresc').data('dom');
            var mieszkanie = $('#zakladki_tresc').data('mieszkanie');
            var kod = $('#zakladki_tresc').data('kod');
            var miejscowosc = $('#zakladki_tresc').data('miejscowosc')


            $('.imie_przelew_u').val(imie);
            $('.wynagrodzenie_imie').addClass('zablokowane_pole')
            $('.nazwisko_przelew_u').val(nazwisko);
            $('.wynagrodzenie_nazwisko').addClass('zablokowane_pole')
            $('.ulica_przelew_u').val(ulica);
            $('.wynagrodzenie_ulica').addClass('zablokowane_pole')
            $('.dom_przelew_u').val(dom);
            $('.wynagrodzenie_dom').addClass('zablokowane_pole')
            $('.mieszkanie_przelew_u').val(mieszkanie);
            $('.wynagrodzenie_mieszkanie').addClass('zablokowane_pole')
            $('.kod_przelew_u').val(kod);
            $('.wynagrodzenie_kod').addClass('zablokowane_pole')
            $('.miejscowosc_przelew_u').val(miejscowosc);
            $('.wynagrodzenie_miejscowosc').addClass('zablokowane_pole')

            $('.imie_przekaz_u').val(imie);
            $('.wynagrodzenie_imie').addClass('zablokowane_pole')
            $('.nazwisko_przekaz_u').val(nazwisko);
            $('.wynagrodzenie_nazwisko').addClass('zablokowane_pole')
            $('.ulica_przekaz_u').val(ulica);
            $('.wynagrodzenie_ulica').addClass('zablokowane_pole')
            $('.dom_przekaz_u').val(dom);
            $('.wynagrodzenie_dom').addClass('zablokowane_pole')
            $('.mieszkanie_przekaz_u').val(mieszkanie);
            $('.wynagrodzenie_mieszkanie').addClass('zablokowane_pole')
            $('.kod_przekaz_u').val(kod);
            $('.wynagrodzenie_kod').addClass('zablokowane_pole')
            $('.miejscowosc_przekaz_u').val(miejscowosc);
            $('.wynagrodzenie_miejscowosc').addClass('zablokowane_pole')


        } else {
            $('.zleceniodawca_odbiorca').removeClass('zaznaczone');

            $('.imie_przelew_u').val('');
            $('.wynagrodzenie_imie').removeClass('zablokowane_pole')
            $('.nazwisko_przelew_u').val('');
            $('.wynagrodzenie_nazwisko').removeClass('zablokowane_pole')
            $('.ulica_przelew_u').val('');
            $('.wynagrodzenie_ulica').removeClass('zablokowane_pole')
            $('.dom_przelew_u').val('');
            $('.wynagrodzenie_dom').removeClass('zablokowane_pole')
            $('.mieszkanie_przelew_u').val('');
            $('.wynagrodzenie_mieszkanie').removeClass('zablokowane_pole')
            $('.kod_przelew_u').val('');
            $('.wynagrodzenie_kod').removeClass('zablokowane_pole')
            $('.miejscowosc_przelew_u').val('');
            $('.wynagrodzenie_miejscowosc').removeClass('zablokowane_pole')

            $('.imie_przekaz_u').val('');
            $('.wynagrodzenie_imie').removeClass('zablokowane_pole')
            $('.nazwisko_przekaz_u').val('');
            $('.wynagrodzenie_nazwisko').removeClass('zablokowane_pole')
            $('.ulica_przekaz_u').val('');
            $('.wynagrodzenie_ulica').removeClass('zablokowane_pole')
            $('.dom_przekaz_u').val('');
            $('.wynagrodzenie_dom').removeClass('zablokowane_pole')
            $('.mieszkanie_przekaz_u').val('');
            $('.wynagrodzenie_mieszkanie').removeClass('zablokowane_pole')
            $('.kod_przekaz_u').val('');
            $('.wynagrodzenie_kod').removeClass('zablokowane_pole')
            $('.miejscowosc_przekaz').val('');
            $('.wynagrodzenie_miejscowosc_u').removeClass('zablokowane_pole')

        }
    });
}

function zapisz_strone_nr_1() {

    $('#zapisz_strone_1').click(function () {

        var typ_szkody_obrazenia = ($('.szkoda .obrazenia').hasClass('zaznaczone')) ? '1' : '0';
        var typ_szkody_smierc = ($('.szkoda .smierc').hasClass('zaznaczone')) ? '1' : '0';
        var typ_szkody_bank = ($('.szkoda .bank').hasClass('zaznaczone')) ? '1' : '0';
        var rodzaj_wypadku_komunikacyjny = ($('.rodzaj .komunikacyjny').hasClass('zaznaczone')) ? '1' : '0';
        var rodzaj_wypadku_w_rolnictwie = ($('.rodzaj .w_rolnictwie').hasClass('zaznaczone')) ? '1' : '0';
        var rodzaj_wypadku_inny = ($('.rodzaj .inne').hasClass('zaznaczone')) ? '1' : '0';

        var wypadek_w_pracy = ($('.rodzaj .praca').hasClass('zaznaczone')) ? '1' : '0';
        var wypadek_medyczny = ($('.rodzaj .medyczny').hasClass('zaznaczone')) ? '1' : '0';
        var wypadek_inny = ($('.rodzaj .inny_wypadek').hasClass('zaznaczone')) ? '1' : '0';

        var inny_rodzaj_wypadku = $('.inny_rodzaj_wypadku').val();


        if (typ_szkody_obrazenia == '1') {
            var typ_szkody = 1;
        } else if (typ_szkody_smierc == '1') {
            var typ_szkody = 2;
        } else if (typ_szkody_bank == '1') {
            var typ_szkody = 3;
        }

        if (rodzaj_wypadku_komunikacyjny == '1') {
            var rodzaj_wypadku = 1;
        } else if (rodzaj_wypadku_w_rolnictwie == '1') {
            var rodzaj_wypadku = 2;
        } else if (rodzaj_wypadku_inny == '1') {
            var rodzaj_wypadku = 3;
        }

        if (wypadek_w_pracy == '1') {
            var inny_wypadek = 1;
        } else if (wypadek_medyczny == '1') {
            var inny_wypadek = 2;
        } else if (wypadek_inny == '1') {
            var inny_wypadek = 3;
        }

            przelacz_str_1();

        $.ajax({
                method: "POST",
                url: "formularze_dokumenty/akcje/ajax_umowa_zapisz_do_bazy_str_1",

                data: {
                    typ_szkody: typ_szkody,
                    rodzaj_wypadku: rodzaj_wypadku,
                    inny_wypadek: inny_wypadek,
                    inny_rodzaj_wypadku: inny_rodzaj_wypadku
                }
            })
            .done(function (data) {

                var array = $.parseJSON(data);

                $('#zakladki_tresc').attr('data-id_sprawy', array[0]);
                $('#zakladki_tresc').data('id_sprawy', array[0]);
                $('#zakladki_tresc').attr('data-typ_szkody', array[2]);
                $('#zakladki_tresc').data('typ_szkody', array[2]);

                wyswitl_powiadomienie('Dane zostały zapisane.', 1, 0);

            }).fail(function (ajaxContext) {
                document.getElementById("body_strona_r").innerHTML = ajaxContext.responseText;
            });

    });
}

function zapisz_strone_nr_2() {


    var czy_nowy_klient = 0;

    $('.akcja_dodawania').click(function () {
        czy_nowy_klient = 1;
    });

    $('#zapisz_strone_2').click(function () {

        var id_sprawy = $('#zakladki_tresc').data('id_sprawy');
        var typ_szkody = $('#zakladki_tresc').data('typ_szkody');

        var id_klienta = $('.lista_klientow_opcje option:selected').attr('id');

        var zleceniodawca_imie = $('.zleceniodawca_imie_dodaj').val();
        var zleceniodawca_nazwisko = $('.zleceniodawca_nazwisko_dodaj').val();
        var zleceniodawca_ulica = $('.zleceniodawca_ulica_dodaj').val();
        var zleceniodawca_nr_domu = $('.zleceniodawca_nr_domu_dodaj').val();
        var zleceniodawca_nr_mieszkania = $('.zleceniodawca_nr_mieszkania_dodaj').val();
        var zleceniodawca_kod_pocztowy = $('.zleceniodawca_kod_pocztowy_dodaj').val();
        var zleceniodawca_miejscowosc = $('.zleceniodawca_miejscowosc_dodaj').val();
        var zleceniodawca_email = $('.zleceniodawca_email_dodaj').val();
        var zleceniodawca_telefon = $('.zleceniodawca_telefon_dodaj').val();
        var zleceniodawca_pesel = $('.zleceniodawca_pesel_dodaj').val();
        var zleceniodawca_seria_i_numer_dowodu = $('.zleceniodawca_seria_i_numer_dowodu_dodaj').val();
        var zleceniodawca_dokument = $('.zleceniodawca_dokument_dodaj').val();
        var zleceniodawca_numer_dokumentu = $('.zleceniodawca_numer_dokumentu_dodaj').val();

        var zleceniodawca_ulica_kor = $('.zleceniodawca_ulica_kor_dodaj').val();
        var zleceniodawca_nr_domu_kor = $('.zleceniodawca_nr_domu_kor_dodaj').val();
        var zleceniodawca_nr_mieszkania_kor = $('.zleceniodawca_nr_mieszkania_kor_dodaj').val();
        var zleceniodawca_kod_pocztowy_kor = $('.zleceniodawca_kod_pocztowy_kor_dodaj').val();
        var zleceniodawca_miejscowosc_kor = $('.zleceniodawca_miejscowosc_kor_dodaj').val();

        var zleceniodawca_ulica_kor_obecnego = $('.zleceniodawca_ulica_kor_b').val();
        var zleceniodawca_nr_domu_kor_obecnego = $('.zleceniodawca_nr_domu_kor_b').val();
        var zleceniodawca_nr_mieszkania_kor_obecnego = $('.zleceniodawca_nr_mieszkania_kor_b').val();
        var zleceniodawca_kod_pocztowy_kor_obecnego = $('.zleceniodawca_kod_pocztowy_kor_b').val();
        var zleceniodawca_miejscowosc_kor_obecnego = $('.zleceniodawca_miejscowosc_kor_b').val();

        var zleceniodawca_imie_obecnego = $('.zleceniodawca_imie_b').val();
        var zleceniodawca_nazwisko_obecnego = $('.zleceniodawca_nazwisko_b').val();
        var zleceniodawca_ulica_obecnego = $('.zleceniodawca_ulica_b').val();
        var zleceniodawca_nr_domu_obecnego = $('.zleceniodawca_nr_domu_b').val();
        var zleceniodawca_kod_pocztowy_obecnego = $('.zleceniodawca_kod_pocztowy_b').val();
        var zleceniodawca_miejscowosc_obecnego = $('.zleceniodawca_miejscowosc_b').val();
        var zleceniodawca_nr_mieszkania_obecnego = $('.zleceniodawca_nr_mieszkania_b').val();

        var czy_obcokrajowiec = ($('.obcokrajowiec .nie').hasClass('zaznaczone')) ? '0' : '1';
        var adres_do_korespondencji = ($('.korespondencja_adres_nk').hasClass('zaznaczone')) ? '1' : '0';

        var czy_obecny_adres_przepisac = ($('.klient_obecny').hasClass('zaznaczone')) ? '1' : '0';

        if (czy_nowy_klient == 0) {


                if (zleceniodawca_imie_obecnego == '' || zleceniodawca_nazwisko_obecnego == '' || zleceniodawca_ulica_obecnego == '' || zleceniodawca_nr_domu_obecnego == '' || zleceniodawca_kod_pocztowy_obecnego == '' || zleceniodawca_miejscowosc_obecnego == '') {
                    wyswitl_powiadomienie('Uzupełnij dane klienta!!!', 0, 0);
                    return false;

                } else if (czy_obecny_adres_przepisac == 0 && (zleceniodawca_ulica_kor_obecnego == '' || zleceniodawca_nr_domu_kor_obecnego == '' || zleceniodawca_nr_mieszkania_kor_obecnego == '' || zleceniodawca_kod_pocztowy_kor_obecnego == '' || zleceniodawca_miejscowosc_kor_obecnego == '')) {
                    wyswitl_powiadomienie('Uzupełnij adres korespondencji klienta!!!', 0, 0);
                    return false;
                }
        }


        if (czy_nowy_klient == 1) {

            if (zleceniodawca_imie == '' || zleceniodawca_nazwisko == '' || zleceniodawca_ulica == '' || zleceniodawca_nr_domu == '' || zleceniodawca_kod_pocztowy == '' || zleceniodawca_miejscowosc == '') {
                wyswitl_powiadomienie('Uzupełnij dane klienta!!!', 0, 0);
                return false;

            }


            if (adres_do_korespondencji == '0' && (zleceniodawca_ulica_kor == '' || zleceniodawca_nr_domu_kor == '' || zleceniodawca_kod_pocztowy_kor == '' || zleceniodawca_miejscowosc_kor == '')) {
                    wyswitl_powiadomienie('Uzupełnij adres do korespondencji!!!', 0, 0);
                    return false;
            }


            if (czy_obcokrajowiec == '0') {

                if (zleceniodawca_pesel == '' || zleceniodawca_seria_i_numer_dowodu == '') {
                    wyswitl_powiadomienie('Uzupełnij dokumenty klienta!!!', 0, 0);
                    return false;
                }
            } else {
                if (zleceniodawca_dokument == '' || zleceniodawca_numer_dokumentu == '') {
                    wyswitl_powiadomienie('Uzupełnij dokumenty klienta!!!', 0, 0);
                    return false;
                }
            }
        }

        przelacz_str_2();

        $.ajax({
                method: "POST",
                url: "formularze_dokumenty/akcje/ajax_umowa_zapisz_do_bazy_str_2",

                data: {

                    id_sprawy: id_sprawy,
                    id_klienta: id_klienta,
                    czy_nowy_klient: czy_nowy_klient,
                    adres_do_korespondencji: adres_do_korespondencji,
                    czy_obecny_adres_przepisac: czy_obecny_adres_przepisac,
                    czy_obcokrajowiec: czy_obcokrajowiec,
                    zleceniodawca_imie: zleceniodawca_imie,
                    zleceniodawca_nazwisko: zleceniodawca_nazwisko,
                    zleceniodawca_ulica: zleceniodawca_ulica,
                    zleceniodawca_nr_domu: zleceniodawca_nr_domu,
                    zleceniodawca_nr_mieszkania: zleceniodawca_nr_mieszkania,
                    zleceniodawca_kod_pocztowy: zleceniodawca_kod_pocztowy,
                    zleceniodawca_miejscowosc: zleceniodawca_miejscowosc,
                    zleceniodawca_email: zleceniodawca_email,
                    zleceniodawca_telefon: zleceniodawca_telefon,
                    zleceniodawca_pesel: zleceniodawca_pesel,
                    zleceniodawca_seria_i_numer_dowodu: zleceniodawca_seria_i_numer_dowodu,
                    zleceniodawca_dokument: zleceniodawca_dokument,
                    zleceniodawca_numer_dokumentu: zleceniodawca_numer_dokumentu,
                    zleceniodawca_ulica_kor: zleceniodawca_ulica_kor,
                    zleceniodawca_nr_domu_kor: zleceniodawca_nr_domu_kor,
                    zleceniodawca_nr_mieszkania_kor: zleceniodawca_nr_mieszkania_kor,
                    zleceniodawca_kod_pocztowy_kor: zleceniodawca_kod_pocztowy_kor,
                    zleceniodawca_miejscowosc_kor: zleceniodawca_miejscowosc_kor,
                    zleceniodawca_ulica_kor_obecnego: zleceniodawca_ulica_kor_obecnego,
                    zleceniodawca_nr_domu_kor_obecnego: zleceniodawca_nr_domu_kor_obecnego,
                    zleceniodawca_nr_mieszkania_kor_obecnego: zleceniodawca_nr_mieszkania_kor_obecnego,
                    zleceniodawca_kod_pocztowy_kor_obecnego: zleceniodawca_kod_pocztowy_kor_obecnego,
                    zleceniodawca_miejscowosc_kor_obecnego: zleceniodawca_miejscowosc_kor_obecnego

    }
            })
            .done(function (data) {

                var array = $.parseJSON(data);

                $('#zakladki_tresc').attr('data-id_sprawy', array[0]);
                $('#zakladki_tresc').data('id_sprawy', array[0]);

                $('#zakladki_tresc').attr('data-id_klienta', array[1]);
                $('#zakladki_tresc').data('id_klienta', array[1]);

                wyswitl_powiadomienie('Dane zostały zapisane.', 1, 0);




                if (czy_nowy_klient == '1') {
                    $('.ddo_imie').val(zleceniodawca_imie);
                    $('.ddo_imie').attr('value', zleceniodawca_imie);

                    $('.ddo_nazwisko').val(zleceniodawca_nazwisko);
                    $('.ddo_nazwisko').attr('value', zleceniodawca_nazwisko);

                    $('.ddo_ulica').val(zleceniodawca_ulica);
                    $('.ddo_ulica').attr('value', zleceniodawca_ulica);

                    $('.ddo_nr_domu').val(zleceniodawca_nr_domu);
                    $('.ddo_nr_domu').attr('value', zleceniodawca_nr_domu);

                    $('.ddo_nr_mieszkania').val(zleceniodawca_nr_mieszkania);
                    $('.ddo_nr_mieszkania').attr('value', zleceniodawca_nr_mieszkania);

                    $('.ddo_kod_pocztowy').val(zleceniodawca_kod_pocztowy);
                    $('.ddo_kod_pocztowy').attr('value', zleceniodawca_kod_pocztowy);

                    $('.ddo_miejscowosc').val(zleceniodawca_miejscowosc);
                    $('.ddo_miejscowosc').attr('value', zleceniodawca_miejscowosc);
                } else {
                    $('.ddo_imie').val(zleceniodawca_imie_obecnego);
                    $('.ddo_imie').attr('value', zleceniodawca_imie_obecnego);

                    $('.ddo_nazwisko').val(zleceniodawca_nazwisko_obecnego);
                    $('.ddo_nazwisko').attr('value', zleceniodawca_nazwisko_obecnego);

                    $('.ddo_ulica').val(zleceniodawca_ulica_obecnego);
                    $('.ddo_ulica').attr('value', zleceniodawca_ulica_obecnego);

                    $('.ddo_nr_domu').val(zleceniodawca_nr_domu_obecnego);
                    $('.ddo_nr_domu').attr('value', zleceniodawca_nr_domu_obecnego);

                    $('.ddo_nr_mieszkania').val(zleceniodawca_nr_mieszkania_obecnego);
                    $('.ddo_nr_mieszkania').attr('value', zleceniodawca_nr_mieszkania_obecnego);

                    $('.ddo_kod_pocztowy').val(zleceniodawca_kod_pocztowy_obecnego);
                    $('.ddo_kod_pocztowy').attr('value', zleceniodawca_kod_pocztowy_obecnego);

                    $('.ddo_miejscowosc').val(zleceniodawca_miejscowosc_obecnego);
                    $('.ddo_miejscowosc').attr('value', zleceniodawca_miejscowosc_obecnego);
                }



            }).fail(function (ajaxContext) {
                document.getElementById("body_strona_r").innerHTML = ajaxContext.responseText;
            });

    });
}

function zapisz_strone_nr_3() {

    $('#zapisz_strone_3').click(function () {
	
	var czy_obcokrajowiec = ($('.obcokrajowiec_nie').hasClass('zaznaczone')) ? '0' : '1';

        var id_sprawy = $('#zakladki_tresc').data('id_sprawy');
        var id_klienta = $('#zakladki_tresc').data('id_klienta');
        var typ_szkody = $('#zakladki_tresc').data('typ_szkody');

        var poszkodowany_imie = $('.poszkodowany_imie').val();
        var poszkodowany_nazwisko = $('.poszkodowany_nazwisko').val();
        var poszkodowany_ulica = $('.poszkodowany_ulica').val();
        var poszkodowany_nr_domu = $('.poszkodowany_nr_domu').val();
        var poszkodowany_nr_mieszkania = $('.poszkodowany_nr_mieszkania').val();
        var poszkodowany_kod_pocztowy = $('.poszkodowany_kod_pocztowy').val();
        var poszkodowany_miejscowosc = $('.poszkodowany_miejscowosc').val();
        var poszkodowany_email = $('.poszkodowany_email').val();
        var poszkodowany_tel = $('.poszkodowany_tel').val();
        var poszkodowany_pesel = $('.poszkodowany_pesel').val();
        var poszkodowany_seria_i_numer_dowodu = $('.poszkodowany_seria_i_numer_dowodu').val();
        var poszkodowany_dokument = $('.poszkodowany_dokument').val();
        var poszkodowany_numer_dokumentu = $('.poszkodowany_numer_dokumentu').val();

        var klient_poszkodowany_tak = ($('.klient_poszkodowany_tak').hasClass('zaznaczone')) ? '1' : '0';
        var klient_poszkodowany_nie = ($('.klient_poszkodowany_nie').hasClass('zaznaczone')) ? '1' : '0';
        
        var poszkodowany_maloletni = ($('.poszkodowany_maloletni').hasClass('zaznaczone')) ? '1' : '0';
        var poszkodowany_ubezwlasnowolniony = ($('.poszkodowany_ubezwlasnowolniony').hasClass('zaznaczone')) ? '1' : '0';
        var poszkodowany_malzonek = ($('.poszkodowany_malzonek').hasClass('zaznaczone')) ? '1' : '0';
        
        if (poszkodowany_maloletni == '1') {
            var typ_poszkodowanego = 1;
        } else if (poszkodowany_ubezwlasnowolniony == '1') {
            var typ_poszkodowanego = 2;
        } else if (poszkodowany_malzonek == '1') {
            var typ_poszkodowanego = 3;
        } else if (typ_szkody == '2') {
            var typ_poszkodowanego = 4;
        } else if (poszkodowany_maloletni == '0' && poszkodowany_ubezwlasnowolniony == '0' && poszkodowany_malzonek == '0' && typ_szkody == '1') {
            var typ_poszkodowanego = 0;
        }

        if (klient_poszkodowany_tak == '1') {
            var klient_poszkodowany = 1;
        } else if (klient_poszkodowany_nie == '1') {
            var klient_poszkodowany = 0;
        }


        if (klient_poszkodowany == 0) {
            if (poszkodowany_imie == '') {
                wyswitl_powiadomienie('Uzupełnij imię poszkodowanego!!!', 0, 0);
                return false;
            }

            if (poszkodowany_nazwisko == '') {
                wyswitl_powiadomienie('Uzupełnij nazwisko poszkodowanego!!!', 0, 0);
                return false;
            }
        }

        if (typ_szkody == 2) {
            if (poszkodowany_imie == '') {
                wyswitl_powiadomienie('Uzupełnij imię zmarłego!!!', 0, 0);
                return false;
            }

            if (poszkodowany_nazwisko == '') {
                wyswitl_powiadomienie('Uzupełnij nazwisko zmarłego!!!', 0, 0);
                return false;
            }
        }



        przelacz_str_3();

        $.ajax({
                method: "POST",
                url: "formularze_dokumenty/akcje/ajax_umowa_zapisz_do_bazy_str_3",

                data: {
                    id_sprawy: id_sprawy,
                    id_klienta: id_klienta,
                    poszkodowany_imie: poszkodowany_imie,
                    poszkodowany_nazwisko: poszkodowany_nazwisko,
                    poszkodowany_ulica: poszkodowany_ulica,
                    poszkodowany_nr_domu: poszkodowany_nr_domu,
                    poszkodowany_nr_mieszkania: poszkodowany_nr_mieszkania,
                    poszkodowany_kod_pocztowy: poszkodowany_kod_pocztowy,
                    poszkodowany_miejscowosc: poszkodowany_miejscowosc,
                    poszkodowany_email: poszkodowany_email,
                    poszkodowany_tel: poszkodowany_tel,
                    czy_obcokrajowiec: czy_obcokrajowiec,
                    poszkodowany_pesel: poszkodowany_pesel,
                    poszkodowany_seria_i_numer_dowodu: poszkodowany_seria_i_numer_dowodu,
                    poszkodowany_dokument: poszkodowany_dokument,
                    poszkodowany_numer_dokumentu: poszkodowany_numer_dokumentu,
                    klient_poszkodowany: klient_poszkodowany,
                    typ_poszkodowanego: typ_poszkodowanego
                }
            })
            .done(function (data) {

                var array = $.parseJSON(data);

                $('#zakladki_tresc').attr('data-id_sprawy', array[0]);
                $('#zakladki_tresc').data('id_sprawy', array[0]);

                $('#zakladki_tresc').attr('data-id_klienta', array[1]);
                $('#zakladki_tresc').data('id_klienta', array[1]);

                $('#zakladki_tresc').attr('data-id_poszkodowany', array[2]);
                $('#zakladki_tresc').data('id_poszkodowany', array[2]);


                wyswitl_powiadomienie('Dane zostały zapisane.', 1, 0);

            }).fail(function (ajaxContext) {
                document.getElementById("body_strona_r").innerHTML = ajaxContext.responseText;
            });

    });
}

function zapisz_strone_nr_4() {

    $('#zapisz_strone_4').click(function () {

        var id_sprawy = $('#zakladki_tresc').data('id_sprawy');
        var id_klienta = $('#zakladki_tresc').data('id_klienta');

        var uprawniony_imie = $('.uprawniony_imie').val();
        var uprawniony_nazwisko = $('.uprawniony_nazwisko').val();
        var uprawniony_ulica = $('.uprawniony_ulica').val();
        var uprawniony_nr_domu = $('.uprawniony_nr_domu').val();
        var uprawniony_nr_mieszkania = $('.uprawniony_nr_mieszkania').val();
        var uprawniony_kod_pocztowy = $('.uprawniony_kod_pocztowy').val();
        var uprawniony_miejscowosc = $('.uprawniony_miejscowosc').val();
        var uprawniony_pesel = $('.uprawniony_pesel').val();
        var uprawniony_seria_i_numer_dowodu = $('.uprawniony_seria_i_numer_dowodu').val();
        var uprawniony_email = $('.uprawniony_email').val();
        var uprawniony_telefon = $('.uprawniony_telefon').val();
        var czy_obcokrajowiec = ($('.obcokrajowiec_tak.uprawniony_obcokraj').hasClass('zaznaczone')) ? '1' : '0'

        var uprawniony_dokument = $('.uprawniony_dokument').val();
        var uprawniony_numer_dokumentu = $('.uprawniony_numer_dokumentu').val();

        var uprawniony_informacje_imie = $('.uprawniony_informacje_imie').val();
        var uprawniony_informacje_nazwisko = $('.uprawniony_informacje_nazwisko').val();
        var uprawniony_informacje_pesel = $('.uprawniony_informacje_pesel').val();

        var inny_uprawniony = ($('.uprawniony_formularz_kratka_kratka').hasClass('zaznaczone')) ? '1' : '0';

        var uprawniony_do_inf = ($('.uprawniony_do_informacji_kratka_kratka').hasClass('zaznaczone')) ? '1' : '0';


        if (inny_uprawniony == '1') {

            if (uprawniony_imie == '') {
                wyswitl_powiadomienie('Uzupełnij imię uprawnionego!!!', 0, 0);
                return false;
            }
            if (uprawniony_nazwisko == '') {
                wyswitl_powiadomienie('Uzupełnij nazwisko uprawnionego!!!', 0, 0);
                return false;
            }
            if (uprawniony_ulica == '') {
                wyswitl_powiadomienie('Uzupełnij ulicę uprawnionego!!!', 0, 0);
                return false;
            }
            if (uprawniony_nr_domu == '') {
                wyswitl_powiadomienie('Uzupełnij numer domu uprawnionego!!!', 0, 0);
                return false;
            }
            if (uprawniony_kod_pocztowy == '') {
                wyswitl_powiadomienie('Uzupełnij kod pocztowy uprawnionego!!!', 0, 0);
                return false;
            }
            if (uprawniony_miejscowosc == '') {
                wyswitl_powiadomienie('Uzupełnij miejscowośc zamieszkania uprawnionego!!!', 0, 0);
                return false;
            }

            if (czy_obcokrajowiec == '0') {
                if (uprawniony_pesel == '') {
                    wyswitl_powiadomienie('Wpisz pesel uprawnionego!!!', 0, 0);
                    return false;
                } else if (!$('.uprawniony_pesel').hasClass('pesel_poprawny')) {
                    wyswitl_powiadomienie('Wpisz poprawny pesel uprawnionego!!!', 0, 0);
                    return false;
                }
            }

        }

        if (uprawniony_do_inf == '1') {
            if (uprawniony_informacje_imie == '' || uprawniony_informacje_nazwisko == '' || uprawniony_informacje_pesel == '') {
                wyswitl_powiadomienie('Uzupełnij dane uprawnionego!!!', 0, 0);
                return false;
            }
        }

        przelacz_str_4();

        $.ajax({
                method: "POST",
                url: "formularze_dokumenty/akcje/ajax_umowa_zapisz_do_bazy_str_4",

                data: {
                    id_sprawy: id_sprawy,
                    id_klienta: id_klienta,
                    uprawniony_imie: uprawniony_imie,
                    uprawniony_nazwisko: uprawniony_nazwisko,
                    uprawniony_ulica: uprawniony_ulica,
                    uprawniony_nr_domu: uprawniony_nr_domu,
                    uprawniony_nr_mieszkania: uprawniony_nr_mieszkania,
                    uprawniony_kod_pocztowy: uprawniony_kod_pocztowy,
                    uprawniony_miejscowosc: uprawniony_miejscowosc,
                    uprawniony_pesel: uprawniony_pesel,
                    uprawniony_seria_i_numer_dowodu: uprawniony_seria_i_numer_dowodu,
                    uprawniony_dokument: uprawniony_dokument,
                    uprawniony_numer_dokumentu: uprawniony_numer_dokumentu,
                    uprawniony_email: uprawniony_email,
                    uprawniony_telefon: uprawniony_telefon,
                    inny_uprawniony: inny_uprawniony,
                    czy_obcokrajowiec: czy_obcokrajowiec,
                    uprawniony_do_inf: uprawniony_do_inf,
                    uprawniony_informacje_imie: uprawniony_informacje_imie,
                    uprawniony_informacje_nazwisko: uprawniony_informacje_nazwisko,
                    uprawniony_informacje_pesel: uprawniony_informacje_pesel
                }
            })
            .done(function (data) {

                var array = $.parseJSON(data);

                $('#zakladki_tresc').attr('data-id_sprawy', array[0]);
                $('#zakladki_tresc').data('id_sprawy', array[0]);

                $('#zakladki_tresc').attr('data-id_uprawniony', array[1]);
                $('#zakladki_tresc').data('id_uprawniony', array[1]);

                wyswitl_powiadomienie('Dane zostały zapisane.', 1, 0);

            }).fail(function (ajaxContext) {
                document.getElementById("body_strona_r").innerHTML = ajaxContext.responseText;
            });



    });
}

function zapisz_strone_nr_5() {

    $('#zapisz_strone_5').click(function () {

        var id_sprawy = $('#zakladki_tresc').data('id_sprawy');

        var data_wypadku = $('.data_wypadku').val();
        var godzina_wypadku = $('.godzina_wypadku').val();
        var miejsce_zdarzenia = $('.miejsce_zdarzenia').val();

        var czy_dwa_pojazdy = ($('.pojazd_a_k_b_k_kratka').hasClass('zaznaczone')) ? '1' : '0';
        var czy_pieszy_rowerzysta = ($('.pojazd_b_k_kratka').hasClass('zaznaczone')) ? '1' : '0';

        var pojazd_a_marka = $('.pojazd_a_marka').val();
        var pojazd_a_model = $('.pojazd_a_model').val();
        var pojazd_a_nr_rejestracyjny = $('.pojazd_a_nr_rejestracyjny').val();
        var pojazd_a_kraj_rejestracji = $('.pojazd_a_kraj_rejestracji').val();
        var pojazd_a_kierujacy_pojazdem = $('.pojazd_a_kierujacy_pojazdem').val();
        var pojazd_a_posiadacz_pojazdu = $('.pojazd_a_posiadacz_pojazdu').val();
        var pojazd_a_uoc_posiadacz_pojazdu = $('.pojazd_a_uoc_posiadacz_pojazdu').val();
        var pojazd_a_nr_polisy_oc = $('.pojazd_a_nr_polisy_oc').val();

        var pojazd_b_marka = $('.pojazd_b_marka').val();
        var pojazd_b_model = $('.pojazd_b_model').val();
        var pojazd_b_nr_rejestracyjny = $('.pojazd_b_nr_rejestracyjny').val();
        var pojazd_b_kraj_rejestracji = $('.pojazd_b_kraj_rejestracji').val();
        var pojazd_b_kierujacy_pojazdem = $('.pojazd_b_kierujacy_pojazdem').val();
        var pojazd_b_posiadacz_pojazdu = $('.pojazd_b_posiadacz_pojazdu').val();
        var pojazd_b_uoc_posiadacz_pojazdu = $('.pojazd_b_uoc_posiadacz_pojazdu').val();
        var pojazd_b_nr_polisy_oc = $('.pojazd_b_nr_polisy_oc').val();

        var szkoda_niekomunikacyjna = ($('.pojazd_c_k_kratka').hasClass('zaznaczone')) ? '1' : '0';
        var inf_o_sprawcy = $('.pojazd_c_informacje').val();

        var opis_zdarzenia = $('.opis_zdarzenia').val();
        var opis_obrazen = $('.opis_obrazen').val();

        if (data_wypadku == '') {
            wyswitl_powiadomienie('Wpisz date!!!', 0, 0);
            return false;
        }

        if (miejsce_zdarzenia == '') {
            wyswitl_powiadomienie('Uzupełnij miejsce zdarzenia!!!', 0, 0);
            return false;
        }

        if (czy_dwa_pojazdy == '0' && czy_pieszy_rowerzysta == '0' && szkoda_niekomunikacyjna == '0') {
            wyswitl_powiadomienie('Wybierz jedną z opcji!!!', 0, 0);
            return false;
        }

        var poj_a_obcy = ($('.dr_s_do_a_obcy').hasClass('zaznaczone')) ? '1' : '0';
        var poj_a_rodzina = ($('.dr_s_do_a_rodzina').hasClass('zaznaczone')) ? '1' : '0';
        var poj_a_inny = ($('.dr_s_do_a_inny').hasClass('zaznaczone')) ? '1' : '0';
        var poj_a_inny_stosunek = $('.dr_s_do_a_inny_rodzaj').val();

        var poj_b_obcy = ($('.dr_s_do_b_obcy').hasClass('zaznaczone')) ? '1' : '0';
        var poj_b_rodzina = ($('.dr_s_do_b_rodzina').hasClass('zaznaczone')) ? '1' : '0';
        var poj_b_inny = ($('.dr_s_do_b_inny').hasClass('zaznaczone')) ? '1' : '0';
        var poj_b_inny_stosunek = $('.dr_s_do_b_inny_rodzaj').val();

        if (poj_a_obcy == '1') {
            var stos_poj_a = 1;
        } else if (poj_a_rodzina == '1') {
            var stos_poj_a = 2;
        } else if (poj_a_inny == '1') {
            var stos_poj_a = 3;
        }

        if (poj_b_obcy == '1') {
            var stos_poj_b = 1;
        } else if (poj_b_rodzina == '1') {
            var stos_poj_b = 2;
        } else if (poj_b_inny == '1') {
            var stos_poj_b = 3;
        }
        
        if (czy_dwa_pojazdy == '1') {
            var rodzaj_zdarzenia = 1;
        } else if (czy_pieszy_rowerzysta == '1') {
            var rodzaj_zdarzenia = 2;
        } else if (szkoda_niekomunikacyjna == '1') {
            var rodzaj_zdarzenia = 3;
        }

        przelacz_str_5();

        $.ajax({
                method: "POST",
                url: "formularze_dokumenty/akcje/ajax_umowa_zapisz_do_bazy_str_5",

                data: {
                    id_sprawy: id_sprawy,
                    data_wypadku: data_wypadku,
                    godzina_wypadku: godzina_wypadku,
                    miejsce_zdarzenia: miejsce_zdarzenia,
                    czy_dwa_pojazdy: czy_dwa_pojazdy,
                    czy_pieszy_rowerzysta: czy_pieszy_rowerzysta,
                    pojazd_a_marka: pojazd_a_marka,
                    pojazd_a_model: pojazd_a_model,
                    pojazd_a_nr_rejestracyjny: pojazd_a_nr_rejestracyjny,
                    pojazd_a_kraj_rejestracji: pojazd_a_kraj_rejestracji,
                    pojazd_a_kierujacy_pojazdem: pojazd_a_kierujacy_pojazdem,
                    pojazd_a_posiadacz_pojazdu: pojazd_a_posiadacz_pojazdu,
                    pojazd_a_uoc_posiadacz_pojazdu: pojazd_a_uoc_posiadacz_pojazdu,
                    pojazd_a_nr_polisy_oc: pojazd_a_nr_polisy_oc,
                    pojazd_b_marka: pojazd_b_marka,
                    pojazd_b_model: pojazd_b_model,
                    pojazd_b_nr_rejestracyjny: pojazd_b_nr_rejestracyjny,
                    pojazd_b_kraj_rejestracji: pojazd_b_kraj_rejestracji,
                    pojazd_b_kierujacy_pojazdem: pojazd_b_kierujacy_pojazdem,
                    pojazd_b_posiadacz_pojazdu: pojazd_b_posiadacz_pojazdu,
                    pojazd_b_uoc_posiadacz_pojazdu: pojazd_b_uoc_posiadacz_pojazdu,
                    pojazd_b_nr_polisy_oc: pojazd_b_nr_polisy_oc,
                    szkoda_niekomunikacyjna: szkoda_niekomunikacyjna,
                    inf_o_sprawcy: inf_o_sprawcy,
                    opis_zdarzenia: opis_zdarzenia,
                    stos_poj_a: stos_poj_a,
                    poj_a_inny_stosunek: poj_a_inny_stosunek,
                    stos_poj_b: stos_poj_b,
                    poj_b_inny_stosunek: poj_b_inny_stosunek,
                    opis_obrazen: opis_obrazen,
                    rodzaj_zdarzenia: rodzaj_zdarzenia
                }
            })
            .done(function (data) {

                var array = $.parseJSON(data);

                $('#zakladki_tresc').attr('data-id_sprawy', array[0]);
                $('#zakladki_tresc').data('id_sprawy', array[0]);

                $('#zakladki_tresc').attr('data-id_zdarzenia', array[1]);
                $('#zakladki_tresc').data('id_zdarzenia', array[1]);

                wyswitl_powiadomienie('Dane zostały zapisane.', 1, 0);

            }).fail(function (ajaxContext) {
                document.getElementById("body_strona_r").innerHTML = ajaxContext.responseText;
            });



    });
}

function zapisz_strone_nr_6() {

    $('#zapisz_strone_6').click(function () {

        var id_sprawy = $('#zakladki_tresc').data('id_sprawy');
        var id_zdarzenia = $('#zakladki_tresc').data('id_zdarzenia');



        var roszczenia_od_ub_tak = ($('.dr_ub_ufg_tak').hasClass('zaznaczone')) ? '1' : '0';
        var roszczenia_od_ub_nie = ($('.dr_ub_ufg_nie').hasClass('zaznaczone')) ? '1' : '0';

        var roszczenia_od_prac_tak = ($('.dr_tak_o .dr_tak').hasClass('zaznaczone')) ? '1' : '0';
        var roszczenia_od_prac_nie = ($('.dr_nie_o .dr_nie').hasClass('zaznaczone')) ? '1' : '0';



        if (roszczenia_od_ub_tak == '1') {
            var roszczenia_od_ub = 1;
        } else if (roszczenia_od_ub_nie == '1') {
            var roszczenia_od_ub = 0;
        }

        if (roszczenia_od_prac_tak == '1') {
            var roszczenia_od_prac = 1;
        } else if (roszczenia_od_prac_nie == '1') {
            var roszczenia_od_prac = 0;
        }



        if (roszczenia_od_ub_tak == 0) {
            if (roszczenia_od_ub_nie == 0) {
                wyswitl_powiadomienie('Wybierz odpowiednią opcję !!!', 0, 0);
                return false;
            }
        }

        if (roszczenia_od_prac_tak == 0) {
            if (roszczenia_od_prac_nie == 0) {
                wyswitl_powiadomienie('Wybierz odpowiednią opcję !!!', 0, 0);
                return false;
            }
        }

        przelacz_str_6();

        $.ajax({
                method: "POST",
                url: "formularze_dokumenty/akcje/ajax_umowa_zapisz_do_bazy_str_6",

                data: {
                    id_sprawy: id_sprawy,
                    id_zdarzenia: id_zdarzenia,

                    roszczenia_od_ub: roszczenia_od_ub,
                    roszczenia_od_prac: roszczenia_od_prac

                }
            })
            .done(function (data) {

                var array = $.parseJSON(data);

                $('#zakladki_tresc').attr('data-id_sprawy', array[0]);
                $('#zakladki_tresc').data('id_sprawy', array[0]);

                $('#zakladki_tresc').attr('data-id_zdarzenia', array[1]);
                $('#zakladki_tresc').data('id_zdarzenia', array[1]);

                wyswitl_powiadomienie('Dane zostały zapisane.', 1, 0);

            }).fail(function (ajaxContext) {
                document.getElementById("body_strona_r").innerHTML = ajaxContext.responseText;
            });



    });
}

function zapisz_strone_nr_7() {

    $('#zapisz_strone_7').click(function () {

        var id_sprawy = $('#zakladki_tresc').data('id_sprawy');
        var id_zdarzenia = $('#zakladki_tresc').data('id_zdarzenia');

        var sygnatura_akt = $('.ok_sygnatura_akt').val();

        var oswiadczenie = ($('.ok_sprawca_napisal_oswiadczenie').hasClass('zaznaczone')) ? '1' : '0';
        var czy_wezwano_policje = ($('.ok_wezwano_policje').hasClass('zaznaczone')) ? '1' : '0';
        var skad_policja = $('.ok_wp_miejsce').val();
        var czy_wszczeto_postepowanie = ($('.ok_wszczeto_postepowanie').hasClass('zaznaczone')) ? '1' : '0';
        var czy_postawiono_zarzut = ($('.ok_postawiono_sprawcy_zarzut').hasClass('zaznaczone')) ? '1' : '0';
        var art_dla_sprawcy = $('.ok_psz_artykul').val();
        var czy_umorzono = ($('.ok_postepowanie_karne_umorzono').hasClass('zaznaczone')) ? '1' : '0';
        var art_dla_umorzenia = $('.ok_pku_artykul').val();
        var czy_skierowano_do_sadu = ($('.ok_skierowano_akt_do_sadu').hasClass('zaznaczone')) ? '1' : '0';
        var nazwa_sadu = $('.ok_sads_pelna_nazwa_sadu').val();
        var czy_zapadl_wyrok = ($('.ok_zapadl_wyrok').hasClass('zaznaczone')) ? '1' : '0'
        var wyrok_skazujacy = ($('.ok_zw_skazujacy').hasClass('zaznaczone')) ? '1' : '0'
        var wyrok_uniewinniajacy = ($('.ok_zw_uniewinniajacy').hasClass('zaznaczone')) ? '1' : '0'
        var wyrok_z_art = $('.ok_zw_u_artykul').val();


        if (czy_zapadl_wyrok == 1) {

            if (wyrok_skazujacy == 0) {
                if (wyrok_uniewinniajacy == 0) {
                    wyswitl_powiadomienie('Wybierz rodzaj wyroku !!!', 0, 0);
                    return false;
                }
            }
            if (wyrok_z_art == '') {
                wyswitl_powiadomienie('Wpisz numer artykułu!!!', 0, 0);
                return false;
            }

        }

        przelacz_str_7();

        $.ajax({
                method: "POST",
                url: "formularze_dokumenty/akcje/ajax_umowa_zapisz_do_bazy_str_7",

                data: {
                    id_sprawy: id_sprawy,
                    id_zdarzenia: id_zdarzenia,
                    sygnatura_akt: sygnatura_akt,
                    oswiadczenie: oswiadczenie,
                    czy_wezwano_policje: czy_wezwano_policje,
                    skad_policja: skad_policja,
                    czy_wszczeto_postepowanie: czy_wszczeto_postepowanie,
                    czy_postawiono_zarzut: czy_postawiono_zarzut,
                    art_dla_sprawcy: art_dla_sprawcy,
                    czy_umorzono: czy_umorzono,
                    art_dla_umorzenia: art_dla_umorzenia,
                    czy_skierowano_do_sadu: czy_skierowano_do_sadu,
                    nazwa_sadu: nazwa_sadu,
                    czy_zapadl_wyrok: czy_zapadl_wyrok,
                    wyrok_skazujacy: wyrok_skazujacy,
                    wyrok_uniewinniajacy: wyrok_uniewinniajacy,
                    wyrok_z_art: wyrok_z_art
                }
            })
            .done(function (data) {

                var array = $.parseJSON(data);

                $('#zakladki_tresc').attr('data-id_sprawy', array[0]);
                $('#zakladki_tresc').data('id_sprawy', array[0]);

                $('#zakladki_tresc').attr('data-id_zdarzenia', array[1]);
                $('#zakladki_tresc').data('id_zdarzenia', array[1]);

                wyswitl_powiadomienie('Dane zostały zapisane.', 1, 0);

            }).fail(function (ajaxContext) {
                document.getElementById("body_strona_r").innerHTML = ajaxContext.responseText;
            });



    });
}

function zapisz_strone_nr_8() {

    $('#zapisz_strone_8').click(function () {

        var id_sprawy = $('#zakladki_tresc').data('id_sprawy');
        var id_zdarzenia = $('#zakladki_tresc').data('id_zdarzenia');

        var oc_nr_szkody = $('.oc_nr_szkody').val();
        var zgl_szkode_w_poj_tak = ($('.oc_zgloszono_szp').hasClass('zaznaczone')) ? '1' : '0';
        var zgl_szkode_w_poj_nie = ($('.oc_nie_zgloszono_szp').hasClass('zaznaczone')) ? '1' : '0';
        var data_zgloszenia_w_poj = $('.oc_zgloszono_szp_data').val();
        var zgl_szkode_na_os_tak = ($('.oc_zgloszono_szo').hasClass('zaznaczone')) ? '1' : '0';
        var zgl_szkode_na_os_nie = ($('.oc_nie_zgloszono_szo').hasClass('zaznaczone')) ? '1' : '0';
        var data_zgloszenia_na_os = $('.oc_zgloszono_szo_data').val();
        var z_oc_nie_wyplacono = ($('.oc_odszkodowanie_oc_p_nie_wyplacono').hasClass('zaznaczone')) ? '1' : '0'
        var z_oc_wyplacono_w_poj = ($('.oc_odszkodowanie_oc_p_wyplacono').hasClass('zaznaczone')) ? '1' : '0'
        var z_oc_wyplacono_na_os = ($('.oc_wyplacono_szo').hasClass('zaznaczone')) ? '1' : '0'
        var wyplaconoa_kwota = $('.oc_wyplacono_szo_kwota').val();
        var ugoda = ($('.on_wyplacono_szo_ugoda').hasClass('zaznaczone')) ? '1' : '0'
        var wyrok = ($('.on_wyplacono_szo_wyrok').hasClass('zaznaczone')) ? '1' : '0'
        var decyzja = ($('.on_wyplacono_szo_decyzja_zd').hasClass('zaznaczone')) ? '1' : '0'
        var nie_wiem = ($('.on_wyplacono_szo_nie_wiem').hasClass('zaznaczone')) ? '1' : '0'
        var data_uwd = $('.on_wyplacono_szo_data').val();

        var czy_pieszy_rowerzysta = ($('.pojazd_b_k_kratka').hasClass('zaznaczone')) ? '1' : '0';

        if (zgl_szkode_w_poj_tak == 1) {
            var zgl_szkode_w_poj = '1';
        } else if (zgl_szkode_w_poj_nie == 1) {
            var zgl_szkode_w_poj = '0';
        }

        if (zgl_szkode_na_os_tak == 1) {
            var zgl_szkode_na_os = '1';
        } else if (zgl_szkode_na_os_nie == 1) {
            var zgl_szkode_na_os = '0';
        }

        if (z_oc_nie_wyplacono == 1) {
            var odszkodowanie = '1';
        } else if (z_oc_wyplacono_w_poj == 1) {
            var odszkodowanie = '2';
        } else if (z_oc_wyplacono_na_os == 1) {
            var odszkodowanie = '3';
        }

        if (ugoda == 1) {
            var podstawa = '1';
        } else if (wyrok == 1) {
            var podstawa = '2';
        } else if (decyzja == 1) {
            var podstawa = '3';
        } else if (decyzja == 1) {
            var podstawa = '4';
        }

        if (z_oc_wyplacono_na_os == 1) {

            if (ugoda == 0) {
                if (wyrok == 0) {
                    if (decyzja == 0) {
                        wyswitl_powiadomienie('Wybierz podstawę wypłaty !!!', 0, 0);
                        return false;
                    }
                }
            }
        }


        if (czy_pieszy_rowerzysta == 0) {
            if (zgl_szkode_w_poj_nie == 0) {
                if (zgl_szkode_w_poj_tak == 0) {
                    wyswitl_powiadomienie('Zaznacz czy zgłoszono szkodę w pojeździe !!!', 0, 0);
                    return false;
                }
            }
        }

        if (zgl_szkode_w_poj_tak == 1) {
            if (data_zgloszenia_w_poj == '') {
                wyswitl_powiadomienie('Uzupełnij datę zgłoszenia!!!', 0, 0);
                return false;
            }
        }

        if (zgl_szkode_na_os_nie == 0) {
            if (zgl_szkode_na_os_tak == 0) {
                wyswitl_powiadomienie('Zaznacz czy zgłoszono szkodę w pojeździe !!!', 0, 0);
                return false;
            }
        }

        if (zgl_szkode_na_os_tak == 1) {
            if (data_zgloszenia_na_os == '') {
                wyswitl_powiadomienie('Uzupełnij datę zgłoszenia!!!', 0, 0);
                return false;
            }
        }

        przelacz_str_8();

        $.ajax({
                method: "POST",
                url: "formularze_dokumenty/akcje/ajax_umowa_zapisz_do_bazy_str_8",

                data: {
                    id_sprawy: id_sprawy,
                    id_zdarzenia: id_zdarzenia,
                    oc_nr_szkody: oc_nr_szkody,
                    zgl_szkode_w_poj: zgl_szkode_w_poj,
                    data_zgloszenia_w_poj: data_zgloszenia_w_poj,
                    zgl_szkode_na_os: zgl_szkode_na_os,
                    data_zgloszenia_na_os: data_zgloszenia_na_os,
                    odszkodowanie: odszkodowanie,
                    wyplaconoa_kwota: wyplaconoa_kwota,
                    podstawa: podstawa,
                    data_uwd: data_uwd
                }
            })
            .done(function (data) {

                var array = $.parseJSON(data);

                $('#zakladki_tresc').attr('data-id_sprawy', array[0]);
                $('#zakladki_tresc').data('id_sprawy', array[0]);

                $('#zakladki_tresc').attr('data-id_zdarzenia', array[1]);
                $('#zakladki_tresc').data('id_zdarzenia', array[1]);

                wyswitl_powiadomienie('Dane zostały zapisane.', 1, 0);
                zgoda_str_9();

            }).fail(function (ajaxContext) {
                document.getElementById("body_strona_r").innerHTML = ajaxContext.responseText;
            });

    });
}

function zapisz_strone_nr_9() {

    $('#zapisz_strone_9').click(function () {

        var id_sprawy = $('#zakladki_tresc').data('id_sprawy');
        var id_zdarzenia = $('#zakladki_tresc').data('id_zdarzenia');

        var nie_zlecono = ($('.dr_nie_zlecano_innym').hasClass('zaznaczone')) ? '1' : '0';
        var zlecono = ($('.dr_zlecono_sprawe').hasClass('zaznaczone')) ? '1' : '0';

        var komu_zlecono = $('.dr_zs_nazwa').val();
        var kiedy_zlecono = $('.dr_zs_data_umowy').val();

        var czy_wypowiedziano = ($('.dr_zs_wypowiedziano_umowe_opcja').hasClass('zaznaczone')) ? '1' : '0';
        var kiedy_wypowiedziano = $('.dr_zs_wypowiedziano_umowe_data').val();

        /* MEDYK 13-09-2016 */
        var inf_sms = ($('.dr_sms').hasClass('zaznaczone')) ? '1' : '0';
        var inf_email = ($('.dr_email').hasClass('zaznaczone')) ? '1' : '0';

        var ile_kart = $('.dr_ile_kart').val();
        
        var zgoda = ($('.dr_zgoda_tak').hasClass('zaznaczone')) ? '1' : '0';
        
        if (zgoda == 1) {
            if (inf_sms == 0) {
        	if (inf_email == 0) {
            		wyswitl_powiadomienie('Wybierz formę otrzymywania informacji !!!', 0, 0);
                    return false;
            	}
            }
        }

        /**/
        if (zlecono == 1) {
            var czy_zlecono = '1';
        } else if (nie_zlecono == 1) {
            var czy_zlecono = '0';
        }


        if (nie_zlecono == 0) {
            if (zlecono == 0) {
                wyswitl_powiadomienie('Dokonaj wyboru !!!', 0, 0);
                return false;
            }
        }

        przelacz_str_9();


        $.ajax({
                method: "POST",
                url: "formularze_dokumenty/akcje/ajax_umowa_zapisz_do_bazy_str_9",

                data: {
                    id_sprawy: id_sprawy,
                    id_zdarzenia: id_zdarzenia,
                    czy_zlecono: czy_zlecono,
                    komu_zlecono: komu_zlecono,
                    kiedy_zlecono: kiedy_zlecono,
                    czy_wypowiedziano: czy_wypowiedziano,
                    kiedy_wypowiedziano: kiedy_wypowiedziano,
                    inf_sms: inf_sms,
                    inf_email: inf_email,
                    ile_kart: ile_kart
                }
            })
            .done(function (data) {

                var array = $.parseJSON(data);

                $('#zakladki_tresc').attr('data-id_sprawy', array[0]);
                $('#zakladki_tresc').data('id_sprawy', array[0]);

                $('#zakladki_tresc').attr('data-id_zdarzenia', array[1]);
                $('#zakladki_tresc').data('id_zdarzenia', array[1]);

                wyswitl_powiadomienie('Dane zostały zapisane.', 1, 0);
                zgoda_str_10();

            }).fail(function (ajaxContext) {
                document.getElementById("body_strona_r").innerHTML = ajaxContext.responseText;
            });

    });
}


function zapisz_strone_nr_10() {

    $('#zapisz_strone_10').click(function () {

        var id_sprawy = $('#zakladki_tresc').data('id_sprawy');
        var id_zdarzenia = $('#zakladki_tresc').data('id_zdarzenia');

        var zgloszono_nnw = ($('.io_zgloszono_nnw').hasClass('zaznaczone')) ? '1' : '0';
        var komu_zgloszono = $('.io_zgloszono_nnw_nazwa').val();

        var zus = ($('.io_wypadek_zgloszono_zus').hasClass('zaznaczone')) ? '1' : '0';
        var krus = ($('.io_wypadek_zgloszono_krus').hasClass('zaznaczone')) ? '1' : '0';
        var inne = ($('.io_wypadek_zgloszono_inne').hasClass('zaznaczone')) ? '1' : '0';
        var kto_inny = $('.io_wypadek_zgloszono_inne_nazwa').val();

        var wyp_w_pracy = ($('.io_wypadek_przy_pracy').hasClass('zaznaczone')) ? '1' : '0';
        var wyp_w_drodze = ($('.io_wypadek_w_drodze_do_pracy').hasClass('zaznaczone')) ? '1' : '0';

        var zasilek = ($('.io_przyznano_zasilek_p').hasClass('zaznaczone')) ? '1' : '0';
        var prod_finansowe = ($('.zsz_pf').hasClass('zaznaczone')) ? '1' : '0';
        var gamma = ($('.zsz_gamma').hasClass('zaznaczone')) ? '1' : '0';
        var dzialalnosc = ($('.zsz_dzialalnosc').hasClass('zaznaczone')) ? '1' : '0';
        
        var pcrf = ($('.zsz_pcrf').hasClass('zaznaczone')) ? '1' : '0';
        var fundacja = ($('.zsz_fundacja').hasClass('zaznaczone')) ? '1' : '0';

        
        var inne_odszkodowania_uszczerbek_nnw = ($('.io_uszczerbek_nnw').hasClass('zaznaczone')) ? '1' : '0';
        var inne_odszkodowania_uszczerbek_procent_nnw = $('.io_procent_uszczerbku_nnw').val();      
        var inne_odszkodowania_ubezp_procent_uszczerbku = $('.io_procent_uszczerbku').val();
        var inne_odszkodowania_jednorazowe_odszkodowanie = ($('.jednorazowe_odszkodowanie').hasClass('zaznaczone')) ? '1' : '0';
        var inne_odszkodowania_kwota_odszkodowania = $('.io_kwota_odszkodowania').val();       
        var inne_odszkodowania_zwolnienie = ($('.zwolnienie_lekarskie').hasClass('zaznaczone')) ? '1' : '0';
        var inne_odszkodowania_zwolnienie_od = $('.data_niezdolnosci_od').val();
        var inne_odszkodowania_zwolnienie_do = $('.data_niezdolnosci_do').val();
        var inne_odszkodowania_orzeczenie = ($('.io_orzeczenie').hasClass('zaznaczone')) ? '1' : '0';
        
        $('.od_kiedy_l4').attr('value', inne_odszkodowania_zwolnienie_od);
        $('.do_kiedy_l4').attr('value', inne_odszkodowania_zwolnienie_do);
        
        var kratka_do_kiedy = $('.do_kiedy_l4').val();   
        
        if(kratka_do_kiedy != '') {
            $('.lecz_na_zwolnieniu_do').addClass('zaznaczone');
            $('.lecz_na_zwolnieniu').removeClass('zaznaczone');
        }
        
        var inne_odszkodowania_orzeczenie_id = 0;
        
        if ($('.io_calkowite').hasClass('zaznaczone')) {
            inne_odszkodowania_orzeczenie_id = '1';
        } else if ($('.io_czesciowe').hasClass('zaznaczone')) {
            inne_odszkodowania_orzeczenie_id = '2';
        } else if ($('.io_trwale').hasClass('zaznaczone')) {
            inne_odszkodowania_orzeczenie_id = '3';
        } else if ($('.io_okresowe').hasClass('zaznaczone')) {
            inne_odszkodowania_orzeczenie_id = '4';
            var inne_odszkodowania_orzeczenie_do = $('.io_okresowe_data').val();
        }
       
        var inne_odszkodowania_ubezpieczyciel_id = 0;
        
        if ($('.io_zus').hasClass('zaznaczone')) {
            inne_odszkodowania_ubezpieczyciel_id = '1';
        } else if ($('.io_krus').hasClass('zaznaczone')) {
            inne_odszkodowania_ubezpieczyciel_id = '2';
        } else if ($('.io_inne').hasClass('zaznaczone')) {
            inne_odszkodowania_ubezpieczyciel_id = '3';
            var inne_odszkodowania_inne_nazwa = $('.io_inne_nazwa').val();
        }

        var inne_odszkodowania_swiadczenie_id = 0;
        
        if ($('.io_renta').hasClass('zaznaczone')) {
            inne_odszkodowania_swiadczenie_id = '1';
        } else if ($('.io_inne_swiadczenie').hasClass('zaznaczone')) {
            inne_odszkodowania_swiadczenie_id = '2';
            var inne_odszkodowania_swiadczenie_inne_nazwa = $('.io_inne_swiadczenie_nazwa').val();
        }
        
        var inne_odszkodowania_kwota_swiadczenia = $('.io_kwota_swiadczenia').val();
        var inne_odszkodowania_data_swiadczenia = $('.io_okres_swiadczenia').val();


        if (zus == 1) {
            var ubezpieczenie = '1';
        } else if (krus == 1) {
            var ubezpieczenie = '2';
        } else if (inne == 1) {
            var ubezpieczenie = '3';
        }

        if (wyp_w_pracy == 1) {
            var jaki_wypadek = '1';
        } else if (wyp_w_drodze == 1) {
            var jaki_wypadek = '2';
        }
        
        przelacz_str_10();

        $.ajax({
                method: "POST",
                url: "formularze_dokumenty/akcje/ajax_umowa_zapisz_do_bazy_str_10",

                data: {
                    id_sprawy: id_sprawy,
                    id_zdarzenia: id_zdarzenia,
                    zgloszono_nnw: zgloszono_nnw,
                    komu_zgloszono: komu_zgloszono,
                    jaki_wypadek: jaki_wypadek,
                    ubezpieczenie: ubezpieczenie,
                    kto_inny: kto_inny,
                    zasilek: zasilek,
                    prod_finansowe: prod_finansowe,
                    gamma: gamma,
                    dzialalnosc: dzialalnosc,
                    pcrf: pcrf,
                    fundacja: fundacja,
                    
                    inne_odszkodowania_uszczerbek_nnw: inne_odszkodowania_uszczerbek_nnw,
                    inne_odszkodowania_uszczerbek_procent_nnw: inne_odszkodowania_uszczerbek_procent_nnw,
                    inne_odszkodowania_ubezp_procent_uszczerbku: inne_odszkodowania_ubezp_procent_uszczerbku,
                    inne_odszkodowania_jednorazowe_odszkodowanie: inne_odszkodowania_jednorazowe_odszkodowanie,
                    inne_odszkodowania_kwota_odszkodowania: inne_odszkodowania_kwota_odszkodowania,
                    inne_odszkodowania_zwolnienie: inne_odszkodowania_zwolnienie,
                    inne_odszkodowania_zwolnienie_od: inne_odszkodowania_zwolnienie_od,
                    inne_odszkodowania_zwolnienie_do: inne_odszkodowania_zwolnienie_do,
                    inne_odszkodowania_orzeczenie: inne_odszkodowania_orzeczenie,
                    inne_odszkodowania_orzeczenie_id: inne_odszkodowania_orzeczenie_id,
                    inne_odszkodowania_orzeczenie_do: inne_odszkodowania_orzeczenie_do,
                    inne_odszkodowania_ubezpieczyciel_id: inne_odszkodowania_ubezpieczyciel_id,
                    inne_odszkodowania_inne_nazwa: inne_odszkodowania_inne_nazwa,
                    inne_odszkodowania_swiadczenie_id: inne_odszkodowania_swiadczenie_id,
                    inne_odszkodowania_swiadczenie_inne_nazwa: inne_odszkodowania_swiadczenie_inne_nazwa,
                    inne_odszkodowania_kwota_swiadczenia: inne_odszkodowania_kwota_swiadczenia,
                    inne_odszkodowania_data_swiadczenia: inne_odszkodowania_data_swiadczenia
                }
            })
            .done(function (data) {
        	
                var array = $.parseJSON(data);

                $('#zakladki_tresc').attr('data-id_sprawy', array[0]);
                $('#zakladki_tresc').data('id_sprawy', array[0]);

                $('#zakladki_tresc').attr('data-id_zdarzenia', array[1]);
                $('#zakladki_tresc').data('id_zdarzenia', array[1]);

                $('.ou_imie_nazwisko_u').attr('value', array[2]);

                $('.ou_imie_nazwisko_zm').attr('value', array[3]);

                $('.ou_iu_wiek').attr('value', array[4]);

                $('.ou_data_wypadku').attr('value', array[5]);

                wyswitl_powiadomienie('Dane zostały zapisane.', 1, 0);
                wybor_typu_szkody_do_umowy();

            }).fail(function (ajaxContext) {
                document.getElementById("body_strona_r").innerHTML = ajaxContext.responseText;
            });

    });
}

function zapisz_strone_nr_11a() {

    $('#zapisz_strone_11a').click(function () {

        var id_sprawy = $('#zakladki_tresc').data('id_sprawy');
        var id_zdarzenia = $('#zakladki_tresc').data('id_zdarzenia');

        var id_uprawnionego = $('#zakladki_tresc').data('id_uprawniony');
        var id_poszkodowanego = $('#zakladki_tresc').data('id_poszkodowany');

        var os_uprawniona = $('.ou_imie_nazwisko_u').val();
        var wiek_uprawnionego = $('.ou_iu_wiek').val();
        var os_zmarla = $('.ou_imie_nazwisko_zm').val();
        var wiek_zmarlego = $('.ou_iz_wiek').val();
        var data_zdarzenia = $('.ou_data_wypadku').val();

        //alert(wiek_uprawnionego);

        var sytuacja_mat = ($('.ou_ps_nastapilo_psm').hasClass('zaznaczone')) ? '1' : '0';
        var krzywda = ($('.ou_ps_w_krzywda').hasClass('zaznaczone')) ? '1' : '0';

        var wyk_zm_podstawowe = ($('.ou_iz_w_podstawowe').hasClass('zaznaczone')) ? '1' : '0';
        var wyk_zm_zawodowe = ($('.ou_iz_w_zawodowe').hasClass('zaznaczone')) ? '1' : '0';
        var wyk_zm_srednie = ($('.ou_iz_w_srednie').hasClass('zaznaczone')) ? '1' : '0';
        var wyk_zm_wyzsze = ($('.ou_iz_w_wyzsze').hasClass('zaznaczone')) ? '1' : '0';

        var zaw_zm_wyuczony = $('.ou_iz_z_wyuczony').val();
        var zaw_zm_wykonywany = $('.ou_iz_z_wykonywany').val();
        var zaw_zm_dodatkowe = $('.ou_iz_dodatkowe_k').val();

        var zatrudnienie_zm_brak = ($('.ou_iz_zat_brak').hasClass('zaznaczone')) ? '1' : '0';
        var zatrudnienie_zm_o_prace = ($('.ou_iz_zat_uop').hasClass('zaznaczone')) ? '1' : '0';
        var zatrudnienie_zm_zlecenie = ($('.ou_iz_zat_uz').hasClass('zaznaczone')) ? '1' : '0';
        var zatrudnienie_zm_dzialanosc = ($('.ou_iz_zat_wdg').hasClass('zaznaczone')) ? '1' : '0';
        var zatrudnienie_zm_gospodarstwo = ($('.ou_iz_zat_gr').hasClass('zaznaczone')) ? '1' : '0';
        var zatrudnienie_zm_dorywczo = ($('.ou_iz_zat_pd').hasClass('zaznaczone')) ? '1' : '0';
        var zatrudnienie_zm_inne = ($('.ou_iz_zat_inne').hasClass('zaznaczone')) ? '1' : '0';
        var zatrudnienie_zm_inne_rodzaj = $('.ou_iz_zat_inne_nazwa').val();
        var wynagrodzenie_zm = $('.ou_iz_zat_pensja').val();


        var wyk_up_podstawowe = ($('.ou_iu_w_podstawowe').hasClass('zaznaczone')) ? '1' : '0';
        var wyk_up_zawodowe = ($('.ou_iu_w_zawodowe').hasClass('zaznaczone')) ? '1' : '0';
        var wyk_up_srednie = ($('.ou_iu_w_srednie').hasClass('zaznaczone')) ? '1' : '0';
        var wyk_up_wyzsze = ($('.ou_iu_w_wyzsze').hasClass('zaznaczone')) ? '1' : '0';

        var zaw_up_wyuczony = $('.ou_iu_z_wyuczony').val();
        var zaw_up_wykonywany = $('.ou_iu_z_wykonywany').val();
        var zaw_up_dodatkowe = $('.ou_iu_dodatkowe_k').val();

        var zatrudnienie_up_brak = ($('.ou_iu_zat_brak').hasClass('zaznaczone')) ? '1' : '0';
        var zatrudnienie_up_o_prace = ($('.ou_iu_zat_uop').hasClass('zaznaczone')) ? '1' : '0';
        var zatrudnienie_up_zlecenie = ($('.ou_iu_zat_uz').hasClass('zaznaczone')) ? '1' : '0';
        var zatrudnienie_up_dzialanosc = ($('.ou_iu_zat_wdg').hasClass('zaznaczone')) ? '1' : '0';
        var zatrudnienie_up_gospodarstwo = ($('.ou_iu_zat_gr').hasClass('zaznaczone')) ? '1' : '0';
        var zatrudnienie_up_dorywczo = ($('.ou_iu_zat_pd').hasClass('zaznaczone')) ? '1' : '0';
        var zatrudnienie_up_inne = ($('.ou_iu_zat_inne').hasClass('zaznaczone')) ? '1' : '0';
        var zatrudnienie_up_inne_rodzaj = $('.ou_iu_zat_inne_nazwa').val();
        var wynagrodzenie_up = $('.ou_iu_zat_pensja').val();

        var zona = ($('.ou_srm_zdu_z').hasClass('zaznaczone')) ? '1' : '0'
        var maz = ($('.ou_srm_zdu_m').hasClass('zaznaczone')) ? '1' : '0'
        var partnerka = ($('.ou_srm_zdu_pk').hasClass('zaznaczone')) ? '1' : '0'
        var partner = ($('.ou_srm_zdu_pm').hasClass('zaznaczone')) ? '1' : '0'
        var matka = ($('.ou_srm_zdu_ma').hasClass('zaznaczone')) ? '1' : '0'
        var ojciec = ($('.ou_srm_zdu_o').hasClass('zaznaczone')) ? '1' : '0'
        var corka = ($('.ou_srm_zdu_c').hasClass('zaznaczone')) ? '1' : '0'
        var syn = ($('.ou_srm_zdu_s').hasClass('zaznaczone')) ? '1' : '0'
        var siostra = ($('.ou_srm_zdu_si').hasClass('zaznaczone')) ? '1' : '0'
        var brat = ($('.ou_srm_zdu_b').hasClass('zaznaczone')) ? '1' : '0'
        var wnuczka = ($('.ou_srm_zdu_wk').hasClass('zaznaczone')) ? '1' : '0'
        var wnuk = ($('.ou_srm_zdu_wm').hasClass('zaznaczone')) ? '1' : '0'
        var dziadek = ($('.ou_srm_zdu_dz').hasClass('zaznaczone')) ? '1' : '0'
        var babcia = ($('.ou_srm_zdu_ba').hasClass('zaznaczone')) ? '1' : '0'
        var inne = ($('.ou_srm_zdu_inne').hasClass('zaznaczone')) ? '1' : '0'
        var inne_pokrewienstwo_tekst = $('.ou_srm_zdu_inne_rodzaj').val();

        var stos_b_zazyle = ($('.ou_sudz_bz').hasClass('zaznaczone')) ? '1' : '0'
        var stos_zazyle = ($('.ou_sudz_z').hasClass('zaznaczone')) ? '1' : '0'
        var stos_powierzchowne = ($('.ou_sudz_p').hasClass('zaznaczone')) ? '1' : '0'
        var stos_zle = ($('.ou_sudz_zle').hasClass('zaznaczone')) ? '1' : '0'

        var wspolne_gospodarstwo_dom = ($('.ou_srm_pzuwg').hasClass('zaznaczone')) ? '1' : '0'
        var taki_sam_adres_zam = ($('.ou_srm_bzptsacu').hasClass('zaznaczone')) ? '1' : '0'
        var inny_adres_zam = ($('.ou_srm_nbzptsacu_amr').hasClass('zaznaczone')) ? '1' : '0'

        var pomagal = ($('.ou_srm_pwo').hasClass('zaznaczone')) ? '1' : '0'
        var nie_pomagal = ($('.ou_srm_npwo').hasClass('zaznaczone')) ? '1' : '0'

        var moje_utrzymanie = ($('.ou_sbnu_utrz').hasClass('zaznaczone')) ? '1' : '0'
        var lozyl_na_utrzymanie = ($('.ou_sbnu_lnmu').hasClass('zaznaczone')) ? '1' : '0'
        var wspolne_konto = ($('.ou_sbnu_pwk').hasClass('zaznaczone')) ? '1' : '0'
        var partycypowal_koszty = ($('.ou_sbnu_pkur').hasClass('zaznaczone')) ? '1' : '0'
        var wspieral_finansowo = ($('.ou_sbnu_wfwp').hasClass('zaznaczone')) ? '1' : '0'

        var syt_nie_ulegla_zmianie = ($('.ou_spscnr_mo_nuz').hasClass('zaznaczone')) ? '1' : '0'
        var syt_niezn_pogorszyla_sie = ($('.ou_spscnr_mo_psn').hasClass('zaznaczone')) ? '1' : '0'
        var syt_pogorszyla_sie = ($('.ou_spscnr_mo_psz').hasClass('zaznaczone')) ? '1' : '0'

        var mot_nie_ulegla_zmianie = ($('.ou_spscnr_mo_nuz').hasClass('zaznaczone')) ? '1' : '0'
        var mot_poprawila_sie = ($('.ou_spscnr_mo_psn').hasClass('zaznaczone')) ? '1' : '0'
        var mot_pogorszyla_sie = ($('.ou_spscnr_mo_psz').hasClass('zaznaczone')) ? '1' : '0'

        var odczucia_odczul = ($('.ou_spscnr_wstrzas_o').hasClass('zaznaczone')) ? '1' : '0'
        var odczucia_nie_odczul = ($('.ou_spscnr_wstrzas_no').hasClass('zaznaczone')) ? '1' : '0'

        var zly_stan_psych = ($('.ou_spscnr_snp').hasClass('zaznaczone')) ? '1' : '0'
        var gorszy_stan_zdrowia = ($('.ou_spscnr_szps').hasClass('zaznaczone')) ? '1' : '0'

        var wsp_psychiatry = ($('.ou_spscnr_uk_psychiatra').hasClass('zaznaczone')) ? '1' : '0'
        var wsp_psychologa = ($('.ou_spscnr_uk_psycholog').hasClass('zaznaczone')) ? '1' : '0'
        var wsp_pedagoga = ($('.ou_spscnr_uk_pedszk').hasClass('zaznaczone')) ? '1' : '0'
        var wsp_lekarza = ($('.ou_spscnr_uk_lpk').hasClass('zaznaczone')) ? '1' : '0'
        var wsp_duchownego = ($('.ou_spscnr_uk_duch').hasClass('zaznaczone')) ? '1' : '0'
        var wsp_rodziny = ($('.ou_spscnr_uk_rodz').hasClass('zaznaczone')) ? '1' : '0'

        var poz_wdowe = ($('.ou_spscnr_zps_wk').hasClass('zaznaczone')) ? '1' : '0'
        var poz_wdowca = ($('.ou_spscnr_zps_wm').hasClass('zaznaczone')) ? '1' : '0'
        var poz_dzieci = ($('.ou_spscnr_zps_dz').hasClass('zaznaczone')) ? '1' : '0'

        var liczba_dzieci = $('.ou_spscnr_zps_dz_l').val();
        var wiek_dzieci = $('.ou_spscnr_zps_dz_w').val();

        if (poz_wdowe == 1) {
            var malzonek = 1;
        } else if (poz_wdowca == 1) {
            var malzonek = 2;
        }


        if (wsp_psychiatry == 1) {
            var wsparcie = '1';
        } else if (wsp_psychologa == 1) {
            var wsparcie = '2';
        } else if (wsp_pedagoga == 1) {
            var wsparcie = '3';
        } else if (wsp_lekarza == 1) {
            var wsparcie = '4';
        } else if (wsp_duchownego == 1) {
            var wsparcie = '5';
        } else if (wsp_rodziny == 1) {
            var wsparcie = '6';
        }

         if (poz_dzieci == 1) {
            var pozostawil = '3';
        }




        if (wspolne_gospodarstwo_dom == 1) {
            var zameldowanie = '1';
        } else if (taki_sam_adres_zam == 1) {
            var zameldowanie = '2';
        } else if (inny_adres_zam == 1) {
            var zameldowanie = '3';
        }

        if (odczucia_odczul == 1) {
            var odczucia = '1';
        } else if (odczucia_nie_odczul == 1) {
            var odczucia = '2';
        }

        if (zly_stan_psych == 1) {
            var stan_zdrowia = '1';
        } else if (gorszy_stan_zdrowia == 1) {
            var stan_zdrowia = '2';
        }


        if (pomagal == 1) {
            var czy_pomagal = '1';
        } else if (nie_pomagal == 1) {
            var czy_pomagal = '2';
        }

        if (syt_nie_ulegla_zmianie == 1) {
            var sytuacja_materialna = '1';
        } else if (syt_niezn_pogorszyla_sie == 1) {
            var sytuacja_materialna = '2';
        } else if (syt_pogorszyla_sie == 1) {
            var sytuacja_materialna = '3';
        }

        if (mot_nie_ulegla_zmianie == 1) {
            var motywacja = '1';
        } else if (mot_poprawila_sie == 1) {
            var motywacja = '2';
        } else if (mot_pogorszyla_sie == 1) {
            var motywacja = '3';
        }

        if (wyk_zm_podstawowe == 1) {
            var wyk_zmarlego = '1';
        } else if (wyk_zm_zawodowe == 1) {
            var wyk_zmarlego = '2';
        } else if (wyk_zm_srednie == 1) {
            var wyk_zmarlego = '3';
        } else if (wyk_zm_wyzsze == 1) {
            var wyk_zmarlego = '4';
        }

        if (zatrudnienie_zm_brak == 1) {
            var zatrudnienie_zmar = '1';
        } else if (zatrudnienie_zm_o_prace == 1) {
            var zatrudnienie_zmar = '2';
        } else if (zatrudnienie_zm_zlecenie == 1) {
            var zatrudnienie_zmar = '3';
        } else if (zatrudnienie_zm_dzialanosc == 1) {
            var zatrudnienie_zmar = '4';
        } else if (zatrudnienie_zm_gospodarstwo == 1) {
            var zatrudnienie_zmar = '5';
        } else if (zatrudnienie_zm_dorywczo == 1) {
            var zatrudnienie_zmar = '6';
        } else if (zatrudnienie_zm_inne == 1) {
            var zatrudnienie_zmar = '7';
        }

        if (wyk_up_podstawowe == 1) {
            var wyk_uprawnionego = '1';
        } else if (wyk_up_zawodowe == 1) {
            var wyk_uprawnionego = '2';
        } else if (wyk_up_srednie == 1) {
            var wyk_uprawnionego = '3';
        } else if (wyk_up_wyzsze == 1) {
            var wyk_uprawnionego = '4';
        }

        if (stos_b_zazyle == 1) {
            var stosunki_ze_zmarlym = '1';
        } else if (stos_zazyle == 1) {
            var stosunki_ze_zmarlym = '2';
        } else if (stos_powierzchowne == 1) {
            var stosunki_ze_zmarlym = '3';
        } else if (stos_zle == 1) {
            var stosunki_ze_zmarlym = '4';
        }

        if (moje_utrzymanie == 1) {
            var zmarly_utrzymanie = '1';
        } else if (lozyl_na_utrzymanie == 1) {
            var zmarly_utrzymanie = '2';
        } else if (wspolne_konto == 1) {
            var zmarly_utrzymanie = '3';
        } else if (partycypowal_koszty == 1) {
            var zmarly_utrzymanie = '4';
        } else if (wspieral_finansowo == 1) {
            var zmarly_utrzymanie = '5';
        }

        if (zatrudnienie_up_brak == 1) {
            var zatrudnienie_upr = '1';
        } else if (zatrudnienie_up_o_prace == 1) {
            var zatrudnienie_upr = '2';
        } else if (zatrudnienie_up_zlecenie == 1) {
            var zatrudnienie_upr = '3';
        } else if (zatrudnienie_up_dzialanosc == 1) {
            var zatrudnienie_upr = '4';
        } else if (zatrudnienie_up_gospodarstwo == 1) {
            var zatrudnienie_upr = '5';
        } else if (zatrudnienie_up_dorywczo == 1) {
            var zatrudnienie_upr = '6';
        } else if (zatrudnienie_up_inne == 1) {
            var zatrudnienie_upr = '7';
        }

        if (zona == 1) {
            var relacje = '1';
        } else if (maz == 1) {
            var relacje = '2';
        } else if (partnerka == 1) {
            var relacje = '3';
        } else if (partner == 1) {
            var relacje = '4';
        } else if (matka == 1) {
            var relacje = '5';
        } else if (ojciec == 1) {
            var relacje = '6';
        } else if (corka == 1) {
            var relacje = '7';
        } else if (syn == 1) {
            var relacje = '8';
        } else if (siostra == 1) {
            var relacje = '9';
        } else if (brat == 1) {
            var relacje = '10';
        } else if (wnuczka == 1) {
            var relacje = '11';
        } else if (wnuk == 1) {
            var relacje = '12';
        } else if (dziadek == 1) {
            var relacje = '13';
        } else if (babcia == 1) {
            var relacje = '14';
        } else if (inne == 1) {
            var relacje = '15';
        }

        if (maz == 0) {
            if (zona == 0) {
                if (partner == 0) {
                    if (partnerka == 0) {
                        if (ojciec == 0) {
                            if (matka == 0) {
                                if (syn == 0) {
                                    if (corka == 0) {
                                        if (brat == 0) {
                                            if (siostra == 0) {
                                                if (wnuk == 0) {
                                                    if (wnuczka == 0) {
                                                        if (dziadek == 0) {
                                                            if (babcia == 0) {
                                                                if (inne == 0) {
                                                                    wyswitl_powiadomienie('Wskaż stopień pokrewieństwa !!!', 0, 0);
                                                                    return false;
                                                                }
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }


        var lata = wiek_dzieci.split(';',liczba_dzieci);

        if(lata.length != liczba_dzieci) {
            wyswitl_powiadomienie('Uzupełnij wszystkie wymagane pola!!!', 0, 0);
            return false;
        } else {
            for (var x=0; x<liczba_dzieci; x++) {

                if (lata[x] == '' || lata[x] == undefined) {
                    wyswitl_powiadomienie('Uzupełnij wszystkie wymagane pola!!!', 0, 0);
                    return false;
                }
            }
        }



        przelacz_str_11();

        $.ajax({
                method: "POST",
                url: "formularze_dokumenty/akcje/ajax_umowa_zapisz_do_bazy_str_11a",

                data: {
                    id_sprawy: id_sprawy,
                    id_zdarzenia: id_zdarzenia,
                    id_uprawnionego: id_uprawnionego,
                    id_poszkodowanego: id_poszkodowanego,

                    pozostawil: pozostawil,
                    odczucia: odczucia,
                    sytuacja_mat: sytuacja_mat,
                    krzywda: krzywda,
                    czy_pomagal: czy_pomagal,
                    sytuacja_materialna: sytuacja_materialna,
                    motywacja: motywacja,
                    wyk_zmarlego: wyk_zmarlego,
                    zatrudnienie_zmar: zatrudnienie_zmar,
                    wyk_uprawnionego: wyk_uprawnionego,
                    stosunki_ze_zmarlym: stosunki_ze_zmarlym,
                    moje_utrzymanie: moje_utrzymanie,
                    lozyl_na_utrzymanie: lozyl_na_utrzymanie,
                    wspolne_konto: wspolne_konto,
                    partycypowal_koszty: partycypowal_koszty,
                    wspieral_finansowo: wspieral_finansowo,
                    wspolne_gospodarstwo_dom: wspolne_gospodarstwo_dom,
                    taki_sam_adres_zam: taki_sam_adres_zam,
                    inny_adres_zam: inny_adres_zam,
                    wsp_psychiatry: wsp_psychiatry,
                    wsp_psychologa: wsp_psychologa,
                    wsp_pedagoga: wsp_pedagoga,
                    wsp_lekarza: wsp_lekarza,
                    wsp_duchownego: wsp_duchownego,
                    wsp_rodziny: wsp_rodziny,
                    zatrudnienie_upr: zatrudnienie_upr,
                    relacje: relacje,
                    wiek_zmarlego: wiek_zmarlego,
                    zaw_zm_wyuczony: zaw_zm_wyuczony,
                    zaw_zm_wykonywany: zaw_zm_wykonywany,
                    zaw_zm_dodatkowe: zaw_zm_dodatkowe,
                    zatrudnienie_zm_inne_rodzaj: zatrudnienie_zm_inne_rodzaj,
                    wynagrodzenie_zm: wynagrodzenie_zm,
                    wiek_uprawnionego: wiek_uprawnionego,
                    zaw_up_wyuczony: zaw_up_wyuczony,
                    zaw_up_wykonywany: zaw_up_wykonywany,
                    zaw_up_dodatkowe: zaw_up_dodatkowe,
                    zatrudnienie_up_inne_rodzaj: zatrudnienie_up_inne_rodzaj,
                    wynagrodzenie_up: wynagrodzenie_up,
                    inne_pokrewienstwo_tekst: inne_pokrewienstwo_tekst,
                    liczba_dzieci: liczba_dzieci,
                    wiek_dzieci: wiek_dzieci,
                    odczucia: odczucia,
                    stan_zdrowia: stan_zdrowia,
                    wsparcie: wsparcie,
                    pozostawil: pozostawil,
                    malzonek: malzonek

                }
            })
            .done(function (data) {

                var array = $.parseJSON(data);




                $('#zakladki_tresc').attr('data-id_sprawy', array[0]);
                $('#zakladki_tresc').data('id_sprawy', array[0]);

                $('#zakladki_tresc').attr('data-id_zdarzenia', array[1]);
                $('#zakladki_tresc').data('id_zdarzenia', array[1]);

                wyswitl_powiadomienie('Dane zostały zapisane.', 1, 0);

            }).fail(function (ajaxContext) {
                document.getElementById("body_strona_r").innerHTML = ajaxContext.responseText;
            });

    });
}

function zapisz_strone_nr_12() {

    $('#zapisz_strone_12').click(function () {

        var id_sprawy = $('#zakladki_tresc').data('id_sprawy');
        var id_zdarzenia = $('#zakladki_tresc').data('id_zdarzenia');

        var id_uprawnionego = $('#zakladki_tresc').data('id_uprawniony');
        var id_poszkodowanego = $('#zakladki_tresc').data('id_poszkodowany');

        var tresc_oswiadczenia = $('.zsz_oswiadczenie_tresc').val();

        /*kamyk 2016-08-19*/
        var imie = $('.ddo_imie').val();
        var nazwisko = $('.ddo_nazwisko').val();
        var ulica = $('.ddo_ulica').val();
        var nr_domu = $('.ddo_nr_domu').val();
        var nr_mieszkania = $('.ddo_nr_mieszkania').val();
        var kod_pocztowy = $('.ddo_kod_pocztowy').val();
        var miejscowosc = $('.ddo_miejscowosc').val();
        var data = $('.ddo_data').val();
        var miejscowosc_generowania = $('.ddo_miejscowosc_generowania').val();

        var imie_nazwisko = imie + ' ' + nazwisko;
        var adres = ulica + ',' + nr_domu + ',' + nr_mieszkania + ',' + kod_pocztowy + ',' + miejscowosc;

        przelacz_str_12();

        $.ajax({
                method: "POST",
                url: "formularze_dokumenty/akcje/ajax_umowa_zapisz_do_bazy_str_12",

                data: {
                    id_sprawy: id_sprawy,
                    id_zdarzenia: id_zdarzenia,
                    id_uprawnionego: id_uprawnionego,
                    id_poszkodowanego: id_poszkodowanego,

                    tresc_oswiadczenia: tresc_oswiadczenia,
                    imie_nazwisko: imie_nazwisko,
                    adres: adres,
                    data: data,
                    miejscowosc_generowania: miejscowosc_generowania

                }
            })
            .done(function (data) {

                var array = $.parseJSON(data);


                $('#zakladki_tresc').attr('data-id_sprawy', array[0]);
                $('#zakladki_tresc').data('id_sprawy', array[0]);

                $('#zakladki_tresc').attr('data-id_zdarzenia', array[1]);
                $('#zakladki_tresc').data('id_zdarzenia', array[1]);

                $('#zakladki_tresc').attr('data-id_uprawnionego', array[2]);
                $('#zakladki_tresc').data('id_uprawnionego', array[2]);

                $('#zakladki_tresc').attr('data-id_poszkodowanego', array[3]);
                $('#zakladki_tresc').data('id_poszkodowanego', array[3]);


                wyswitl_powiadomienie('Dane zostały zapisane.', 1, 0);

            }).fail(function (ajaxContext) {
                document.getElementById("body_strona_r").innerHTML = ajaxContext.responseText;
            });

    });
}

function zapisz_strone_nr_13() {

    $('#zapisz_strone_13').click(function () {

        var id_sprawy = $('#zakladki_tresc').data('id_sprawy');
        var id_zdarzenia = $('#zakladki_tresc').data('id_zdarzenia');

        var id_uprawnionego = $('#zakladki_tresc').data('id_uprawniony');
        var id_poszkodowanego = $('#zakladki_tresc').data('id_poszkodowany');

        var maxima = ($('.maxima').hasClass('zaznaczone')) ? '1' : '0';
        var optima = ($('.optima').hasClass('zaznaczone')) ? '1' : '0';
        var prima = ($('.prima').hasClass('zaznaczone')) ? '1' : '0';
        var promedica = ($('.promedica').hasClass('zaznaczone')) ? '1' : '0'; //medyk 14-09-2016


        var prowizja_optima = $('.prowizja_optima').val();
        var prowizja_maxima = $('.prowizja_maxima').val();
        var prowizja_promedica = $('.prowizja_promedica').val();
        var prowizja_prima = $('.prowizja_prima').val();

        var id_klienta = $('#zakladki_tresc').data('id_klienta');

        if (maxima == 1) {
            var umowa = 'maxima';
            var prowizja = prowizja_maxima;
        } else if (optima == 1) {
            var umowa = 'optima';
            var prowizja = prowizja_optima;
        } else if (promedica == 1) {
            var umowa = 'promedica';
            var prowizja = prowizja_promedica;
        } else if (prima == 1) {
            var umowa = 'prima';
            var prowizja = prowizja_prima;
        }

        if (maxima == 0) {
            if (optima == 0) {
                if (promedica == 0) {
                    if (prima == 0) {
                        wyswitl_powiadomienie('Wybierz odpowiednią umowę !!!', 0, 0);
                        return false;
                    }
                }
            }
        }

        if (optima == 1) {
            if (prowizja_optima == '') {
                wyswitl_powiadomienie('Wpisz odpowiednią stawkę prowizji!!!', 0, 0);
                return false;
            }
            if (prowizja_optima > 35 || prowizja_optima < 25) {
                wyswitl_powiadomienie('Podana stawka prowizji jest nieodpowiednia!!!', 0, 0);
                return false;
            }
        }
        
        if (prima == 1) {
            if (prowizja_prima == '') {
                wyswitl_powiadomienie('Wpisz odpowiednią stawkę prowizji!!!', 0, 0);
                return false;
            }
            if (prowizja_prima > 35 || prowizja_prima < 25) {
                wyswitl_powiadomienie('Podana stawka prowizji jest nieodpowiednia!!!', 0, 0);
                return false;
            }
        }

        przelacz_str_13();

        $.ajax({
                method: "POST",
                url: "formularze_dokumenty/akcje/ajax_umowa_zapisz_do_bazy_str_13",

                data: {
                    id_sprawy: id_sprawy,
                    id_zdarzenia: id_zdarzenia,
                    id_uprawnionego: id_uprawnionego,
                    id_poszkodowanego: id_poszkodowanego,
                    id_klienta: id_klienta,
                    umowa: umowa,
                    prowizja: prowizja

                }
            })
            .done(function (data) {

                var array = $.parseJSON(data);

                $('#zakladki_tresc').attr('data-id_sprawy', array[0]);
                $('#zakladki_tresc').data('id_sprawy', array[0]);

                $('#zakladki_tresc').attr('data-id_umowy', array[1]);
                $('#zakladki_tresc').data('id_umowy', array[1]);

                $('#zakladki_tresc').attr('data-id_uprawnionego', array[2]);
                $('#zakladki_tresc').data('id_uprawnionego', array[2]);

                $('#zakladki_tresc').attr('data-id_poszkodowanego', array[3]);
                $('#zakladki_tresc').data('id_poszkodowanego', array[3]);

                $('#zakladki_tresc').attr('data-imie', array[4]);
                $('#zakladki_tresc').data('imie', array[4]);

                $('#zakladki_tresc').attr('data-nazwisko', array[5]);
                $('#zakladki_tresc').data('nazwisko', array[5]);

                $('#zakladki_tresc').attr('data-ulica', array[6]);
                $('#zakladki_tresc').data('ulica', array[6]);

                $('#zakladki_tresc').attr('data-dom', array[7]);
                $('#zakladki_tresc').data('dom', array[7]);

                $('#zakladki_tresc').attr('data-mieszkanie', array[8]);
                $('#zakladki_tresc').data('mieszkanie', array[8]);

                $('#zakladki_tresc').attr('data-kod', array[9]);
                $('#zakladki_tresc').data('kod', array[9]);

                $('#zakladki_tresc').attr('data-miejscowosc', array[10]);
                $('#zakladki_tresc').data('miejscowosc', array[10]);


                wyswitl_powiadomienie('Dane zostały zapisane.', 1, 0);

            }).fail(function (ajaxContext) {
                document.getElementById("body_strona_r").innerHTML = ajaxContext.responseText;
            });

    });
}

function zapisz_strone_nr_14() {

    $('#zapisz_strone_14').click(function () {

        var id_sprawy = $('#zakladki_tresc').data('id_sprawy');
        var id_umowy = $('#zakladki_tresc').data('id_umowy');

        var id_uprawnionego = $('#zakladki_tresc').data('id_uprawniony');
        var id_poszkodowanego = $('#zakladki_tresc').data('id_poszkodowany');
        var id_klienta = $('#zakladki_tresc').data('id_klienta');

        var przelew = ($('.przelew_bankowy').hasClass('zaznaczone')) ? '1' : '0';
        var przekaz = ($('.przekaz_pocztowy').hasClass('zaznaczone')) ? '1' : '0';

        var odbiorca = ($('.zleceniodawca_odbiorca').hasClass('zaznaczone')) ? '1' : '0';

        var rachunek_bankowy = $('.wynagrodzenie_nr_rachunku_bankowego_u').val();
        var imie_przelew = $('.imie_przelew_u').val();
        var nazwisko_przelew = $('.nazwisko_przelew_u').val();
        var ulica_przelew = $('.ulica_przelew_u').val();
        var dom_przelew = $('.dom_przelew_u').val();
        var mieszkanie_przelew = $('.mieszkanie_przelew_u').val();
        var kod_przelew = $('.kod_przelew_u').val();
        var miejscowosc_przelew = $('.miejscowosc_przelew_u').val();

        var imie_przekaz = $('.imie_przekaz_u').val();
        var nazwisko_przekaz = $('.nazwisko_przekaz_u').val();
        var ulica_przekaz = $('.ulica_przekaz_u').val();
        var dom_przekaz = $('.dom_przekaz_u').val();
        var mieszkanie_przekaz = $('.mieszkanie_przekaz_u').val();
        var kod_przekaz = $('.kod_przekaz_u').val();
        var miejscowosc_przekaz = $('.miejscowosc_przekaz_u').val();

        var poprawny_kod_przekaz = ($('.kod_przekaz_u').hasClass('kod_niepoprawny')) ? 1 : 0;
        var poprawny_kod_przelew = ($('.kod_przelew_u').hasClass('kod_niepoprawny')) ? 1 : 0;

         if (poprawny_kod_przekaz == 1) {
            wyswitl_powiadomienie('Wpisz poprawny kod pocztowy !!!', 0, 0);
            return false;
        }

        if (poprawny_kod_przelew == 1) {
            wyswitl_powiadomienie('Wpisz poprawny kod pocztowy !!!', 0, 0);
            return false;
        }

        if (przelew == 1) {
            var forma_platnosci = 'przelew';
        } else if (przekaz == 1) {
            var forma_platnosci = 'przekaz';
        }

        if (przelew == 0) {
            if (przekaz == 0) {
                wyswitl_powiadomienie('Wybierz rodzaj płatności !!!', 0, 0);
                return false;
            }
        }

        if (przelew == 1 && odbiorca == 0) {

            if (imie_przelew == '' || nazwisko_przelew == '' || ulica_przelew == '' || dom_przelew == '' || miejscowosc_przelew == '' || kod_przelew == '' || rachunek_bankowy == '') {
                wyswitl_powiadomienie('Uzupełnij dane odbiorcy!!!', 0, 0);
                return false;
            }
        }

        if (przekaz == 1 && odbiorca == 0) {

            if (imie_przekaz == '' || nazwisko_przekaz == '' || ulica_przekaz == '' || dom_przekaz == '' || miejscowosc_przekaz == '' || kod_przekaz == '') {
                wyswitl_powiadomienie('Uzupełnij dane odbiorcy!!!', 0, 0);
                return false;
            }
        }

        przelacz_str_14();


        $.ajax({
                method: "POST",
                url: "formularze_dokumenty/akcje/ajax_umowa_zapisz_do_bazy_str_14",

                data: {
                    id_sprawy: id_sprawy,
                    id_umowy: id_umowy,
                    id_uprawnionego: id_uprawnionego,
                    id_poszkodowanego: id_poszkodowanego,
                    id_klienta: id_klienta,
                    forma_platnosci: forma_platnosci,
                    odbiorca: odbiorca,
                    rachunek_bankowy: rachunek_bankowy,
                    imie_przelew: imie_przelew,
                    nazwisko_przelew: nazwisko_przelew,
                    ulica_przelew: ulica_przelew,
                    dom_przelew: dom_przelew,
                    mieszkanie_przelew: mieszkanie_przelew,
                    kod_przelew: kod_przelew,
                    miejscowosc_przelew: miejscowosc_przelew,
                    imie_przekaz: imie_przekaz,
                    nazwisko_przekaz: nazwisko_przekaz,
                    ulica_przekaz: ulica_przekaz,
                    dom_przekaz: dom_przekaz,
                    mieszkanie_przekaz: mieszkanie_przekaz,
                    kod_przekaz: kod_przekaz,
                    miejscowosc_przekaz: miejscowosc_przekaz
                }
            })
            .done(function (data) {

                var array = $.parseJSON(data);

                $('#zakladki_tresc').attr('data-id_sprawy', array[0]);
                $('#zakladki_tresc').data('id_sprawy', array[0]);

                $('#zakladki_tresc').attr('data-id_umowy', array[1]);
                $('#zakladki_tresc').data('id_umowy', array[1]);

                $('#zakladki_tresc').attr('data-id_uprawnionego', array[2]);
                $('#zakladki_tresc').data('id_uprawnionego', array[2]);

                $('#zakladki_tresc').attr('data-id_poszkodowanego', array[3]);
                $('#zakladki_tresc').data('id_poszkodowanego', array[3]);


                wyswitl_powiadomienie('Dane zostały zapisane.', 1, 0);

                generuj_umowe_pdf();

            }).fail(function (ajaxContext) {
                document.getElementById("body_strona_r").innerHTML = ajaxContext.responseText;
            });

    });
}

/*kamyk 2016-08-19*/
function sprawa_zapisz_kod_jednostki() {
    $('.lista_jednostek_opcje').change(function () {
        var sprawa_id = $('#zakladki_tresc').data('id_sprawy');
        var jednosta_id = $(this).find('option:selected').attr('id');

        if (jednosta_id == undefined) {
            jednosta_id = 'null';
        }

        if (sprawa_id != undefined) {
            kratka_zapisz_zmiane('sprawa', sprawa_id, 'sprawa_jednostka_id', jednosta_id);
        } else {
            wyswitl_powiadomienie('Błąd - brak id sprawy!!!', '0', '0');
            return false;
        }


    });
}

function sprawa_zapisz_rekomendacje() {
    $('.sprawa_zapisz_rekomendacje').click(function () {
        var sprawa_id = $('#zakladki_tresc').data('id_sprawy');
        var rekomendacja = $('.str_5_rekomendacja_tresc').val();

        //alert(rekomendacja+' '+sprawa_id);

        if (sprawa_id == undefined) {
            wyswitl_powiadomienie('BŁĄD!!! - BRAK ID SPRAWY!!!', 0, 0);
            return false;
        }

        $.ajax({
            method: "POST",
            url: "ajax/akcje/ajax_sprawa_dodaj_lub_aktualizuj_rekomendacje",

            data: {
                sprawa_id: sprawa_id,
                rekomendacja: rekomendacja,

            }
        }).done(function (data) {

            wyswitl_powiadomienie('Rekomendacja została zapisana!!!', 1, 0);

        }).fail(function (ajaxContext) {
            document.getElementById("body_strona_r").innerHTML = ajaxContext.responseText;
        });

    });
}

/*medyk 23-08-2016*/


function oswiadczenie_osoby_poszkodowanej() {

    $('.oz_pod_wplywem').click(function () {
        $(this).addClass('zaznaczone');
        $('.oz_nie_pod_wplywem_o').find('.oz_nie_pod_wplywem').removeClass('zaznaczone');
    });

    $('.oz_nie_pod_wplywem').click(function () {

        $(this).addClass('zaznaczone');
        $('.oz_pod_wplywem_o').find('.oz_pod_wplywem').removeClass('zaznaczone');
        $('.oz_alkohol_o').find('.oz_alkohol').removeClass('zaznaczone');
        $('.oz_narkotyki_o').find('.oz_narkotyki').removeClass('zaznaczone');
        $('.oz_inne_srodki_o').find('.oz_inne_srodki').removeClass('zaznaczone');
    });

    $('.oz_alkohol_o').click(function () {
        $(this).addClass('zaznaczone');
        $('.oz_nie_pod_wplywem_o').find('.oz_nie_pod_wplywem').removeClass('zaznaczone');
        $('.oz_pod_wplywem_o').find('.oz_pod_wplywem').addClass('zaznaczone');
    });

    $('.oz_narkotyki_o').click(function () {
        $(this).addClass('zaznaczone');
        $('.oz_nie_pod_wplywem_o').find('.oz_nie_pod_wplywem').removeClass('zaznaczone');
        $('.oz_pod_wplywem_o').find('.oz_pod_wplywem').addClass('zaznaczone');
    });

    $('.oz_inne_srodki_o').click(function () {
        $(this).addClass('zaznaczone');
        $('.oz_nie_pod_wplywem_o').find('.oz_nie_pod_wplywem').removeClass('zaznaczone');
        $('.oz_pod_wplywem_o').find('.oz_pod_wplywem').addClass('zaznaczone');
    });

    $('.oz_poza_pojazdem').click(function () {
        $(this).addClass('zaznaczone');
        
        $('.picie_kierowca').hide();
        $('.prawko_kierowca').hide();;
        
        $('.poza_pojazdem').show();
        $('.w_pojezdzie').hide();

        $('.oz_w_pojezdzie_o').find('.oz_w_pojezdzie').removeClass('zaznaczone');
        
        $('.oz_wiedza_o_piciu_o').find('.oz_wiedza_o_piciu').removeClass('zaznaczone');
        $('.oz_brak_wiedzy_o_piciu_o').find('.oz_brak_wiedzy_o_piciu').removeClass('zaznaczone');
        $('.oz_wiedza_o_prawku_o').find('.oz_wiedza_o_prawku').removeClass('zaznaczone');
        $('.oz_brak_wiedzy_o_prawku_o').find('.oz_brak_wiedzy_o_prawku').removeClass('zaznaczone');

        $('.oz_komunikacja_o').find('.oz_komunikacja').removeClass('zaznaczone');
        $('.oz_samochod_o').find('.oz_samochod').removeClass('zaznaczone');
        $('.oz_inne_nazwa').val('');
        $('.oz_inne_o').find('.oz_inne').removeClass('zaznaczone');
        $('.oz_kierowca_o').find('.oz_kierowca').removeClass('zaznaczone');
        $('.oz_pasazer_o').find('.oz_pasazer').removeClass('zaznaczone');
        $('.oz_obok_kierowcy_o').find('.oz_obok_kierowcy').removeClass('zaznaczone');
        $('.oz_za_pasazerem_o').find('.oz_za_pasazerem').removeClass('zaznaczone');
        $('.oz_z_tylu_kierowcy_o').find('.oz_z_tylu_kierowcy').removeClass('zaznaczone');
        $('.oz_posrodku_o').find('.oz_posrodku').removeClass('zaznaczone');
        $('.oz_byly_pasy_o').find('.oz_byly_pasy').removeClass('zaznaczone');
        $('.oz_oz_bez_pasow_o').find('.oz_bez_pasow').removeClass('zaznaczone');
        $('.oz_jestem_posiadaczem_o').find('.oz_jestem_posiadaczem').removeClass('zaznaczone');
        $('.oz_nie_jestem_posiadaczem_o').find('.oz_nie_jestem_posiadaczem').removeClass('zaznaczone');
        $('.oz_inne_miejsce_nazwa').val('');
        $('.oz_inne_miejsce_o').find('.oz_inne_miejsce').removeClass('zaznaczone');

    });

    $('.oz_w_pojezdzie').click(function () {
        $(this).addClass('zaznaczone');
        
        $('.picie_kierowca').show();
        $('.prawko_kierowca').show();
        
        $('.w_pojezdzie').show();
        $('.poza_pojazdem').hide();
        $('.oz_poza_pojazdem_o').find('.oz_poza_pojazdem').removeClass('zaznaczone');
        $('.oz_pieszy_o').find('.oz_pieszy').removeClass('zaznaczone');
        $('.oz_rowerzysta_o').find('.oz_rowerzysta').removeClass('zaznaczone');
    });

    $('.oz_pieszy').click(function () {
        $(this).addClass('zaznaczone');
        $('.oz_rowerzysta_o').find('.oz_rowerzysta').removeClass('zaznaczone');
    });

    $('.oz_rowerzysta').click(function () {
        $(this).addClass('zaznaczone');
        $('.oz_pieszy_o').find('.oz_pieszy').removeClass('zaznaczone');
    });

    $('.oz_samochod').click(function () {
        $(this).addClass('zaznaczone');
        $('.oz_inne_o').find('.oz_inne').removeClass('zaznaczone');
        $('.oz_komunikacja_o').find('.oz_komunikacja').removeClass('zaznaczone');
        $('.oz_inne_nazwa').val('');
        $('.oz_inne_nazwa').hide();
    });
    $('.oz_komunikacja').click(function () {
        $(this).addClass('zaznaczone');
        $('.oz_inne_o').find('.oz_inne').removeClass('zaznaczone');
        $('.oz_samochod_o').find('.oz_samochod').removeClass('zaznaczone');
        $('.oz_inne_nazwa').val('');
        $('.oz_inne_nazwa').hide();
    });
    $('.oz_inne').click(function () {
        $(this).addClass('zaznaczone');
        $('.oz_samochod_o').find('.oz_samochod').removeClass('zaznaczone');
        $('.oz_komunikacja_o').find('.oz_komunikacja').removeClass('zaznaczone');
        $('.oz_inne_nazwa').show();
    });

    $('.oz_kierowca').click(function () {
        $(this).addClass('zaznaczone');
        $('.oz_pasazer_o').find('.oz_pasazer').removeClass('zaznaczone');
        $('.oz_obok_kierowcy_o').find('.oz_obok_kierowcy').removeClass('zaznaczone');
        $('.oz_z_tylu_kierowcy_o').find('.oz_z_tylu_kierowcy').removeClass('zaznaczone');
        $('.oz_za_pasazerem_o').find('.oz_za_pasazerem').removeClass('zaznaczone');
        $('.oz_posrodku_o').find('.oz_posrodku').removeClass('zaznaczone');
        $('.oz_inne_miejsce_nazwa').val('');
        $('.oz_inne_miejsce_nazwa').hide();
        $('.oz_inne_miejsce_o').find('.oz_inne_miejsce').removeClass('zaznaczone');
        
        $('.pozycja_pasazera').hide();
    });
    $('.oz_pasazer').click(function () {
        $(this).addClass('zaznaczone');
        $('.oz_kierowca_o').find('.oz_kierowca').removeClass('zaznaczone');
        $('.oz_obok_kierowcy_o').find('.oz_obok_kierowcy').removeClass('zaznaczone');
        $('.oz_z_tylu_kierowcy_o').find('.oz_z_tylu_kierowcy').removeClass('zaznaczone');
        $('.oz_za_pasazerem_o').find('.oz_za_pasazerem').removeClass('zaznaczone');
        $('.oz_posrodku_o').find('.oz_posrodku').removeClass('zaznaczone');
        $('.oz_inne_miejsce_nazwa').val('');
        $('.oz_inne_miejsce_nazwa').hide();
        $('.oz_inne_miejsce_o').find('.oz_inne_miejsce').removeClass('zaznaczone');
        
        $('.pozycja_pasazera').show();
        
    });
    $('.oz_obok_kierowcy').click(function () {
        $(this).addClass('zaznaczone');
        $('.oz_kierowca_o').find('.oz_kierowca').removeClass('zaznaczone');
        $('.oz_z_tylu_kierowcy_o').find('.oz_z_tylu_kierowcy').removeClass('zaznaczone');
        $('.oz_za_pasazerem_o').find('.oz_za_pasazerem').removeClass('zaznaczone');
        $('.oz_posrodku_o').find('.oz_posrodku').removeClass('zaznaczone');
        $('.oz_inne_miejsce_nazwa').val('');
        $('.oz_inne_miejsce_nazwa').hide();
        $('.oz_inne_miejsce_o').find('.oz_inne_miejsce').removeClass('zaznaczone');
    });
    $('.oz_z_tylu_kierowcy').click(function () {
        $(this).addClass('zaznaczone');
        $('.oz_obok_kierowcy_o').find('.oz_obok_kierowcy').removeClass('zaznaczone');
        $('.oz_kierowca_o').find('.oz_kierowca').removeClass('zaznaczone');
        $('.oz_za_pasazerem_o').find('.oz_za_pasazerem').removeClass('zaznaczone');
        $('.oz_posrodku_o').find('.oz_posrodku').removeClass('zaznaczone');
        $('.oz_inne_miejsce_nazwa').val('');
        $('.oz_inne_miejsce_nazwa').hide();
        $('.oz_inne_miejsce_o').find('.oz_inne_miejsce').removeClass('zaznaczone');
    });
    $('.oz_za_pasazerem').click(function () {
        $(this).addClass('zaznaczone');
        $('.oz_obok_kierowcy_o').find('.oz_obok_kierowcy').removeClass('zaznaczone');
        $('.oz_z_tylu_kierowcy_o').find('.oz_z_tylu_kierowcy').removeClass('zaznaczone');
        $('.oz_kierowca_o').find('.oz_kierowca').removeClass('zaznaczone');
        $('.oz_posrodku_o').find('.oz_posrodku').removeClass('zaznaczone');
        $('.oz_inne_miejsce_nazwa').val('');
        $('.oz_inne_miejsce_nazwa').hide();
        $('.oz_inne_miejsce_o').find('.oz_inne_miejsce').removeClass('zaznaczone');
    });
    $('.oz_posrodku').click(function () {
        $(this).addClass('zaznaczone');
        $('.oz_obok_kierowcy_o').find('.oz_obok_kierowcy').removeClass('zaznaczone');
        $('.oz_z_tylu_kierowcy_o').find('.oz_z_tylu_kierowcy').removeClass('zaznaczone');
        $('.oz_za_pasazerem_o').find('.oz_za_pasazerem').removeClass('zaznaczone');
        $('.kierowca_o').find('.oz_kierowca').removeClass('zaznaczone');
        $('.oz_inne_miejsce_nazwa').val('');
        $('.oz_inne_miejsce_nazwa').hide();
        $('.oz_inne_miejsce_o').find('.oz_inne_miejsce').removeClass('zaznaczone');
    });
    $('.oz_inne_miejsce').click(function () {
        $(this).addClass('zaznaczone');
        $('.oz_obok_kierowcy_o').find('.oz_obok_kierowcy').removeClass('zaznaczone');
        $('.oz_z_tylu_kierowcy_o').find('.oz_z_tylu_kierowcy').removeClass('zaznaczone');
        $('.oz_za_pasazerem_o').find('.oz_za_pasazerem').removeClass('zaznaczone');
        $('.oz_kierowca_o').find('.oz_kierowca').removeClass('zaznaczone');
        $('.oz_posrodku_o').find('.oz_posrodku').removeClass('zaznaczone');
        $('.oz_inne_miejsce_nazwa').show();
    });

    $('.oz_byly_pasy').click(function () {
        $(this).addClass('zaznaczone');
        $('.oz_bez_pasow_o').find('.oz_bez_pasow').removeClass('zaznaczone');
    });
    $('.oz_bez_pasow').click(function () {
        $(this).addClass('zaznaczone');
        $('.oz_byly_pasy_o').find('.oz_byly_pasy').removeClass('zaznaczone');
    });

    $('.oz_jestem_posiadaczem').click(function () {
        $(this).addClass('zaznaczone');
        $('.oz_nie_jestem_posiadaczem_o').find('.oz_nie_jestem_posiadaczem').removeClass('zaznaczone');
    });
    $('.oz_nie_jestem_posiadaczem').click(function () {
        $(this).addClass('zaznaczone');
        $('.oz_jestem_posiadaczem_o').find('.oz_jestem_posiadaczem').removeClass('zaznaczone');
    });

    $('.oz_wiedza_o_piciu').click(function () {
	
	$('.oz_brak_wiedzy_o_piciu_o').find('.oz_brak_wiedzy_o_piciu').removeClass('zaznaczone');

    });
    
    $('.oz_brak_wiedzy_o_piciu').click(function () {

        $('.oz_wiedza_o_piciu_o').find('.oz_wiedza_o_piciu').removeClass('zaznaczone');
    });

    $('.oz_wiedza_o_prawku').click(function () {

        $('.oz_brak_wiedzy_o_prawku_o').find('.oz_brak_wiedzy_o_prawku').removeClass('zaznaczone');
    });
    $('.oz_brak_wiedzy_o_prawku').click(function () {

        $('.oz_wiedza_o_prawku_o').find('.oz_wiedza_o_prawku').removeClass('zaznaczone');
    });

    $('.lecz_koniec').click(function () {
        $(this).addClass('zaznaczone');
        $('.lecz_plan_koniec_o').find('.lecz_plan_koniec').removeClass('zaznaczone');
        $('.lecz_brak_terminu_o').find('.lecz_brak_terminu').removeClass('zaznaczone');
        $('.lecz_zabiegi_o').find('.lecz_zabiegi').removeClass('zaznaczone');
        $('.lecz_data_plan_zak').val('');
    });
    $('.lecz_plan_koniec').click(function () {
        $(this).addClass('zaznaczone');
        $('.lecz_koniec_o').find('.lecz_koniec').removeClass('zaznaczone');
        $('.lecz_brak_terminu_o').find('.lecz_brak_terminu').removeClass('zaznaczone');
        $('.lecz_zabiegi_o').find('.lecz_zabiegi').removeClass('zaznaczone');
        $('.lecz_koniec_data').val('');
    });
    $('.lecz_brak_terminu').click(function () {
        $(this).addClass('zaznaczone');
        $('.lecz_plan_koniec_o').find('.lecz_plan_koniec').removeClass('zaznaczone');
        $('.lecz_koniec_o').find('.lecz_koniec').removeClass('zaznaczone');
        $('.lecz_zabiegi_o').find('.lecz_zabiegi').removeClass('zaznaczone');
        $('.lecz_data_plan_zak').val('');
        $('.lecz_koniec_data').val('');
    });
    $('.lecz_zabiegi').click(function () {
        $(this).addClass('zaznaczone');
        $('.lecz_plan_koniec_o').find('.lecz_plan_koniec').removeClass('zaznaczone');
        $('.lecz_brak_terminu_o').find('.lecz_brak_terminu').removeClass('zaznaczone');
        $('.lecz_koniec_o').find('.lecz_koniec').removeClass('zaznaczone');
        $('.lecz_data_plan_zak').val('');
        $('.lecz_koniec_data').val('');
    });

    $('.lecz_na_zwolnieniu_do').click(function () {
        $(this).addClass('zaznaczone');
        $('.lecz_na_zwolnieniu_o').find('.lecz_na_zwolnieniu').removeClass('zaznaczone');
    });
    $('.lecz_na_zwolnieniu').click(function () {
        $(this).addClass('zaznaczone');
        $('.lecz_na_zwolnieniu_do_o').find('.lecz_na_zwolnieniu_do').removeClass('zaznaczone');
        $('.do_kiedy_l4').val('');
    });

    $('.pl_pogotowie').click(function () {
        if ($(this).hasClass('zaznaczone')) {} else {
            $('.szpital').val('');
            $('.przebieg_leczenia').find('.pl_pogotowie_o').removeClass('zaznaczone');
        }
    });

    $('.pl_przychodnia').click(function () {
        if ($(this).hasClass('zaznaczone')) {
            $('.przychodnia').show();
            $('.przychodnia_data').show();
            $('.pl_przychodnia_tekst_o').show();

        } else {
            $('.przychodnia').val('');
            $('.przychodnia_data').val('');
            $('.przychodnia').hide();
            $('.przychodnia_data').hide();
            $('.pl_przychodnia_tekst_o').hide();
        }
    });

    $('.pl_hospitalizacja').click(function () {

        if ($(this).hasClass('zaznaczone')) {

            $('.lh').show();

        } else {
            $('.lh').hide();
        }
    });

    $('.pl_zabiegi').click(function () {
        if ($(this).hasClass('zaznaczone')) {
            $('.pz').show();

        } else {
            $('.pz').hide();
        }
    });

    $('.lecz_koniec_data').click(function () {
        $('.lecz_koniec_o').find('.lecz_koniec').addClass('zaznaczone');
        $('.lecz_plan_koniec_o').find('.lecz_plan_koniec').removeClass('zaznaczone');
        $('.lecz_data_plan_zak').val('');
    });

    $('.lecz_data_plan_zak').click(function () {
        $('.lecz_plan_koniec_o').find('.lecz_plan_koniec').addClass('zaznaczone');
        $('.lecz_koniec_o').find('.lecz_koniec').removeClass('zaznaczone');
        $('.lecz_koniec_data').val('');
    });

    $('.do_kiedy_l4').click(function () {
        $('.lecz_na_zwolnieniu_do_o').find('.lecz_na_zwolnieniu_do').addClass('zaznaczone');
        $('.lecz_zabiegi_o').find('.lecz_zabiegi').removeClass('zaznaczone');
    });

    $('.usun_szpital').click(function () {
        var leczenie_row_usuniete = $('.usun_szpital').data('leczenie_row');
        //alert(leczenie_row_usuniete);
    });

}


function dodaj_szpital() {


    var leczenie = $('.pl_hospitalizacja_o').data('row');
    leczenie++;
    $('.pl_hospitalizacja_o').attr('data-row', leczenie);
    $('.pl_hospitalizacja_o').data('row', leczenie);

    $('.lh:last').after("<div class='lh leczenie_hospitalizacja_" + leczenie + "' data-row='" + leczenie + "''></div>");

    $('.lh:last').append("<input type='text' name='' class='hospitalizacja' placeholder='miejsce hospitalizacji' value='' style='display:block;'/>");

    $('.lh:last').append("<input type='data' name='' class='data hospitalizacja_data' placeholder='data od' value='' style='display:block;'/>");

    $('.lh:last').append("<input type='data' name='' class='data hospitalizacja_data_do' placeholder='data do' value='' style='display:block;'/>");

    $('.lh:last').append("<span class='usun_szpital' title='Usun szpital' onclick='usun_szpital(" + leczenie + ")' style='display:block;'></span>");


    $('.data').datetimepicker({
        viewMode: 'years',
        format: 'YYYY-MM-DD'
    });

}

function usun_szpital(rekord, id) {


    var sprawa_id = $('.umowa_do_edycji').data('id_sprawy');

    var przebieg_leczenia = $('.oswiadzczenie_osoby_poszkodowanej_naglowek_tresc').data('przebieg_leczenia_id');

    $(".leczenie_hospitalizacja_" + rekord + "").remove();


    $.ajax({
            method: "POST",
            url: "ajax/akcje/ajax_sprawa_zmien_hospitalizacje",

            data: {
                id_sprawy: sprawa_id,
                id_przebieg_leczenia: przebieg_leczenia,
                id_usuniete: id
            }
        })
        .done(function (data) {

            wyswitl_powiadomienie('Dane zostały zapisane.', 1, 0);

        }).fail(function (ajaxContext) {
            document.getElementById("body_strona_r").innerHTML = ajaxContext.responseText;
        });

}

function dodaj_zabieg() {


    var placowki = $('.pl_zabiegi_o').data('row');
    placowki++;
    $('.pl_zabiegi_o').attr('data-row', placowki);
    $('.pl_zabiegi_o').data('row', placowki);

    $('.pz:last').after("<div class='pz placowki_zabiegi_" + placowki + "' data-row='" + placowki + "''></div>");

    $('.pz:last').append("<input type='text' name='' class='placowka_zabieg' placeholder='Adres placówki medycznej, w której leczono poszkodowanego w związku z wypadkiem' value='' style='display:block;'/>");

    $('.pz:last').append("<input type='data' name='' class='data placowka_zabieg_data' placeholder='data zabiegu' value='' style='display:block;'/>");

    $('.pz:last').append("<span class='usun_zabieg' title='Usun zabieg' onclick='usun_zabieg(" + placowki + ")' style='display:block;'></span>");


    $('.data').datetimepicker({
        viewMode: 'years',
        format: 'YYYY-MM-DD'
    });

}

function usun_zabieg(rekord, id) {


    var sprawa_id = $('.umowa_do_edycji').data('id_sprawy');

    var przebieg_leczenia = $('.oswiadzczenie_osoby_poszkodowanej_naglowek_tresc').data('przebieg_leczenia_id');

    $(".placowki_zabiegi_" + rekord + "").remove();


    $.ajax({
            method: "POST",
            url: "ajax/akcje/ajax_sprawa_zmien_zabiegi",

            data: {
                id_sprawy: sprawa_id,
                id_przebieg_leczenia: przebieg_leczenia,
                id_usuniete: id
            }
        })
        .done(function (data) {

            wyswitl_powiadomienie('Dane zostały zapisane.', 1, 0);

        }).fail(function (ajaxContext) {
            document.getElementById("body_strona_r").innerHTML = ajaxContext.responseText;
        });

}

function sprawa_oswiadczenie_poszkodowanego_zapisz_zmiany() {
    $('.oswiadczenie_poszkodowanego_zapisz_zmiany').click(function () {


        var sprawa_id = $('.umowa_do_edycji').data('id_sprawy');

        var pod_wplywem_tak = ($('.oz_pod_wplywem').hasClass('zaznaczone')) ? '1' : '0';
        var pod_wplywem_nie = ($('.oz_nie_pod_wplywem').hasClass('zaznaczone')) ? '1' : '0';

        var w_pojezdzie = ($('.oz_w_pojezdzie').hasClass('zaznaczone')) ? '1' : '0';
        var poza_pojazdem = ($('.oz_poza_pojazdem').hasClass('zaznaczone')) ? '1' : '0';

        

        var stan;
        if (pod_wplywem_tak == 1) {
            stan = '1';
        } else if (pod_wplywem_nie == 1) {
            stan = '0';
        }

        if (stan === undefined) {
            wyswitl_powiadomienie('Uzupełnij stan klienta!!!', 0, 0);
            return false;
        }

        var po_czym;
        if ($('.oz_alkohol').hasClass('zaznaczone')) {
            po_czym = '1';
        }
        if ($('.oz_narkotyki').hasClass('zaznaczone')) {
            po_czym = '2';
        }
        if ($('.oz_inne_srodki').hasClass('zaznaczone')) {
            po_czym = '3';
        }


        if (stan == 1 && po_czym === undefined) {
            wyswitl_powiadomienie('Uzupełnij stan klienta!!!', 0, 0);
            return false;
        }


        if (w_pojezdzie == 1) {
            var czy_w_pojezdzie = 1;
        } else if (poza_pojazdem == 1) {
            var czy_w_pojezdzie = 0;
        }

        if (czy_w_pojezdzie === undefined) {
            wyswitl_powiadomienie('Wpisz gdzie znajdował sie klient w chwili zdarzenia!!!', 0, 0);
            return false;
        }

        var typ_pojazdu;
        if ($('.oz_samochod').hasClass('zaznaczone')) {
            var typ_pojazdu = '1';
        }
        if ($('.oz_komunikacja').hasClass('zaznaczone')) {
            var typ_pojazdu = '2';
        }
        if ($('.oz_inne').hasClass('zaznaczone')) {
            var typ_pojazdu = '3';
            var inny_typ_pojazdu = $('.oz_inne_nazwa').val();
        }

        if (czy_w_pojezdzie == 1 && typ_pojazdu === undefined) {
            wyswitl_powiadomienie('Uzupełnij typ pojazdu!!!', 0, 0);
            return false;
        }

        if (czy_w_pojezdzie == 1 && typ_pojazdu == 3) {
            if (inny_typ_pojazdu == '') {
                wyswitl_powiadomienie('Wpisz typ pojazdu!!!', 0, 0);
                return false;
            }
        }


        var pozycja;
        if ($('.oz_kierowca').hasClass('zaznaczone')) {
            pozycja = '1';
        }
        if ($('.oz_pasazer').hasClass('zaznaczone')) {
            pozycja = '2';
        }
        if ($('.oz_obok_kierowcy').hasClass('zaznaczone')) {
            pozycja = '3';
        }
        if ($('.oz_z_tylu_kierowcy').hasClass('zaznaczone')) {
            pozycja = '4';
        }
        if ($('.oz_za_pasazerem').hasClass('zaznaczone')) {
            pozycja = '5';
        }
        if ($('.oz_posrodku').hasClass('zaznaczone')) {
            pozycja = '6';
        }
        if ($('.oz_inne_miejsce').hasClass('zaznaczone')) {
            pozycja = '7';
            var inne_miejsce = $('.oz_inne_miejsce_nazwa').val();
        }


        if (czy_w_pojezdzie == 1 && pozycja === undefined) {
            wyswitl_powiadomienie('Zaznacz odpowiednią pozycję w pojeździe!!!', 0, 0);
            return false;
        }

        if (czy_w_pojezdzie == 1 && pozycja == 7) {
            if (inne_miejsce == '') {
                wyswitl_powiadomienie('Wpisz swoje miejsce!!!', 0, 0);
                return false;
            }
        }
        
        var pasy;
        if ($('.oz_byly_pasy').hasClass('zaznaczone')) {
            pasy = '1';
        }
        if ($('.oz_bez_pasow').hasClass('zaznaczone')) {
            pasy = '2';
        }

        if (czy_w_pojezdzie == 1 && pasy === undefined) {
            wyswitl_powiadomienie('Uzupełnij informację o pasach!!!', 0, 0);
            return false;
        }
        


        var wspolwlasciciel;
        if ($('.oz_jestem_posiadaczem').hasClass('zaznaczone')) {
            wspolwlasciciel = '1';
        } else if ($('.oz_nie_jestem_posiadaczem').hasClass('zaznaczone')) {
            wspolwlasciciel = '2';
        }

        if (czy_w_pojezdzie == 1 && wspolwlasciciel === undefined) {
            wyswitl_powiadomienie('Uzupełnij dane o własności!!!', 0, 0);
            return false;
        }

        var spozycie_tak = ($('.oz_wiedza_o_piciu').hasClass('zaznaczone')) ? '1' : '0';
        var spozycie_nie = ($('.oz_brak_wiedzy_o_piciu').hasClass('zaznaczone')) ? '1' : '0';

        if (spozycie_tak == 1) {
            var spozycie = 2;
        } else if (spozycie_nie == 1) {
            var spozycie = 1;
        } else var prawko = 0;

        var prawko_tak = ($('.oz_wiedza_o_prawku').hasClass('zaznaczone')) ? '1' : '0';
        var prawko_nie = ($('.oz_brak_wiedzy_o_prawku').hasClass('zaznaczone')) ? '1' : '0';

        if (prawko_tak == 1) {
            var prawko = 2;
        } else if (prawko_nie == 1) {
            var prawko = 1;
        } else var prawko = 0;

        var kim_byl;
        if ($('.oz_pieszy').hasClass('zaznaczone')) {
            kim_byl = '1';
        }
        if ($('.oz_rowerzysta').hasClass('zaznaczone')) {
            kim_byl = '2';
        }

        if (czy_w_pojezdzie == 0 && kim_byl === undefined) {
            wyswitl_powiadomienie('Zaznacz czy klient był rowerzystą czy pieszym!!!', 0, 0);
            return false;
        }

        var lecz_zakonczone = ($('.lecz_koniec').hasClass('zaznaczone')) ? '1' : '0';
        var lecz_data_zakonczenia = $('.lecz_koniec_data').val();
        var lecz_planowana_data = ($('.lecz_plan_koniec').hasClass('zaznaczone')) ? '1' : '0';
        var lecz_data_planowany = $('.lecz_data_plan_zak').val();
        var lecz_nieznana_data = ($('.lecz_brak_terminu').hasClass('zaznaczone')) ? '1' : '0';
        var lecz_planowane_zabiegi = ($('.lecz_zabiegi').hasClass('zaznaczone')) ? '1' : '0';


        if (lecz_zakonczone == 1) {
            var stan_leczenia = 1;
        } else if (lecz_planowana_data == 1) {
            var stan_leczenia = 2;
        } else if (lecz_nieznana_data == 1) {
            var stan_leczenia = 3;
        } else if (lecz_planowane_zabiegi == 1) {
            var stan_leczenia = 4;
        }


        if (lecz_zakonczone == 0 && lecz_planowana_data == 0 && lecz_nieznana_data == 0 && lecz_planowane_zabiegi == 0) {
            wyswitl_powiadomienie('Uzupełnij informację o leczeniu!!!', 0, 0);
            return false;
        }

        if (lecz_zakonczone == 1) {
            if (lecz_data_zakonczenia == '') {
                wyswitl_powiadomienie('Wpisz date zakonczenia leczenia!!!', 0, 0);
                return false;
            }
        }

        if (lecz_planowana_data == 1) {
            if (lecz_data_planowany == '') {
                wyswitl_powiadomienie('Wpisz date planowanego zakonczenia leczenia!!!', 0, 0);
                return false;
            }
        }

        var od_kiedy_l4 = $('.od_kiedy_l4').val();
        var termin_konca_zw = ($('.lecz_na_zwolnieniu_do').hasClass('zaznaczone')) ? '1' : '0';

        var do_kiedy_l4 = $('.do_kiedy_l4').val();
        var brak_terminu_konca_zw = ($('.lecz_na_zwolnieniu').hasClass('zaznaczone')) ? '1' : '0';

        if (od_kiedy_l4 != '') {
            if (termin_konca_zw == 0 && brak_terminu_konca_zw == 0) {
                wyswitl_powiadomienie('Wybierz termin końca zwolnienia!!!', 0, 0);
                return false;
            }
        }

        if (termin_konca_zw == 1) {
            if (od_kiedy_l4 == '') {
                wyswitl_powiadomienie('Wpisz date końca zwolnienia!!!', 0, 0);
                return false;
            }
        }

        var szpital = $('.szpital').val();
        var wezwano_pogotowie = ($('.pl_pogotowie').hasClass('zaznaczone')) ? '1' : '0';

        var przychodnia = $('.przychodnia').val();
        var przychodnia_data = $('.przychodnia_data').val();
        var leczenie_w_przychodni = ($('.pl_przychodnia').hasClass('zaznaczone')) ? '1' : '0';

        if (wezwano_pogotowie == 1) {
            if (szpital == '') {
                wyswitl_powiadomienie('Uzupełnij dane pogotowia!!!', 0, 0);
                return false;
            }
        }

        if (leczenie_w_przychodni == 1) {
            if (przychodnia == '' || przychodnia_data == '') {
                wyswitl_powiadomienie('Uzupełnij dane przychodni!!!', 0, 0);
                return false;

            }
        }

        var hospitalizacja = ($('.pl_hospitalizacja').hasClass('zaznaczone')) ? '1' : '0';
        var placowki = ($('.pl_zabiegi').hasClass('zaznaczone')) ? '1' : '0';

        $.ajax({
            method: "POST",
            url: 'ajax/akcje/ajax_sprawa_oswiadczenie_poszkodowanego_zapisz_zmiany',
            data: {

                id_sprawy: sprawa_id,
                stan: stan,
                po_czym: po_czym,
                czy_w_pojezdzie: czy_w_pojezdzie,
                typ_pojazdu: typ_pojazdu,
                inny_typ_pojazdu: inny_typ_pojazdu,
                pozycja: pozycja,
                inne_miejsce: inne_miejsce,
                pasy: pasy,
                wspolwlasciciel: wspolwlasciciel,
                spozycie: spozycie,
                prawko: prawko,
                kim_byl: kim_byl,
                stan_leczenia: stan_leczenia,
                lecz_data_zakonczenia: lecz_data_zakonczenia,
                lecz_data_planowany: lecz_data_planowany,
                od_kiedy_l4: od_kiedy_l4,
                do_kiedy_l4: do_kiedy_l4,
                szpital: szpital,
                przychodnia: przychodnia,
                przychodnia_data: przychodnia_data,

            }
        }).done(function (data) {
            
            wyswitl_powiadomienie('Zmiany zostały zapisane!!!', 1, 0);

            var array = $.parseJSON(data);

            $('.pl_hospitalizacja_o').attr('data-id_przebieg_leczenia', array[0]);
            $('.pl_hospitalizacja_o').data('id_przebieg_leczenia', array[0]);

            dodawanie_hospitalizacji();
            dodawanie_placowek();

        }).fail(function (ajaxContext) {
            document.getElementById("body_strona_r").innerHTML = ajaxContext.responseText;
        });

    });

}

function wybor_typu_szkody_do_umowy() {

    var typ_szkody = $('#zakladki_tresc').data('typ_szkody');

    if (typ_szkody == '1') {
        $('.promedica_optima').show();
        $('.maxima_optima').hide();
    } else if (typ_szkody == '2') {
        $('.maxima_optima').show();
        $('.promedica_optima').hide();
    }
}

function zgoda_str_9() {

    var typ_szkody = $('#zakladki_tresc').data('typ_szkody');

    if (typ_szkody == '1') {
        $('.dr_zlecono_votum_o_o').show();
    } else if (typ_szkody == '2') {
        $('.dr_zlecono_votum_o_o').hide();
    }
}

function zgoda_str_10() {

    var typ_szkody = $('#zakladki_tresc').data('typ_szkody');

    if (typ_szkody == '1') {
        $('.io_zgody_o').show();
    } else if (typ_szkody == '2') {
        $('.io_zgody_o').hide();
    }
}

function zapisz_strone_nr_11b() {
    $('#zapisz_strone_11b').click(function () {

        var id_sprawy = $('#zakladki_tresc').data('id_sprawy');

        var pod_wplywem_tak = ($('.oz_pod_wplywem').hasClass('zaznaczone')) ? '1' : '0';
        var pod_wplywem_nie = ($('.oz_nie_pod_wplywem').hasClass('zaznaczone')) ? '1' : '0';

        var w_pojezdzie = ($('.oz_w_pojezdzie').hasClass('zaznaczone')) ? '1' : '0';
        var poza_pojazdem = ($('.oz_poza_pojazdem').hasClass('zaznaczone')) ? '1' : '0';

        var stan;
        if (pod_wplywem_tak == 1) {
            stan = '1';
        } else if (pod_wplywem_nie == 1) {
            stan = '0';
        }

        if (stan === undefined) {
            wyswitl_powiadomienie('Uzupełnij stan klienta!!!', 0, 0);
            return false;
        }

        var po_czym;
        if ($('.oz_alkohol').hasClass('zaznaczone')) {
            po_czym = '1';
        }
        if ($('.oz_narkotyki').hasClass('zaznaczone')) {
            po_czym = '2';
        }
        if ($('.oz_inne_srodki').hasClass('zaznaczone')) {
            po_czym = '3';
        }

        if (stan == 1 && po_czym === undefined) {
            wyswitl_powiadomienie('Uzupełnij stan klienta!!!', 0, 0);
            return false;
        }

        if (w_pojezdzie == 1) {
            var czy_w_pojezdzie = 1;
        } else if (poza_pojazdem == 1) {
            var czy_w_pojezdzie = 0;
        }

        if (czy_w_pojezdzie === undefined) {
            wyswitl_powiadomienie('Wpisz gdzie znajdował sie klient w chwili zdarzenia!!!', 0, 0);
            return false;
        }

        var typ_pojazdu;
        if ($('.oz_samochod').hasClass('zaznaczone')) {
            var typ_pojazdu = 1;
        }
        if ($('.oz_komunikacja').hasClass('zaznaczone')) {
            var typ_pojazdu = 2;
        }
        if ($('.oz_inne').hasClass('zaznaczone')) {
            var typ_pojazdu = 3;
            var inny_typ_pojazdu = $('.oz_inne_nazwa').val();
        }

        if (czy_w_pojezdzie == 1 && typ_pojazdu === undefined) {
            wyswitl_powiadomienie('Uzupełnij typ pojazdu!!!', 0, 0);
            return false;
        }

        if (czy_w_pojezdzie == 1 && typ_pojazdu == 3) {
            if (inny_typ_pojazdu == '') {
                wyswitl_powiadomienie('Wpisz typ pojazdu!!!', 0, 0);
                return false;
            }
        }


        var pozycja;
        if ($('.oz_kierowca').hasClass('zaznaczone')) {
            pozycja = 1;
        }
        if ($('.oz_pasazer').hasClass('zaznaczone')) {
            pozycja = 2;
        }
        if ($('.oz_obok_kierowcy').hasClass('zaznaczone')) {
            pozycja = 3;
        }
        if ($('.oz_z_tylu_kierowcy').hasClass('zaznaczone')) {
            pozycja = 4;
        }
        if ($('.oz_za_pasazerem').hasClass('zaznaczone')) {
            pozycja = 5;
        }
        if ($('.oz_posrodku').hasClass('zaznaczone')) {
            pozycja = 6;
        }
        if ($('.oz_inne_miejsce').hasClass('zaznaczone')) {
            pozycja = 7;
            var inne_miejsce = $('.oz_inne_miejsce_nazwa').val();
        }

        if (czy_w_pojezdzie == 1 && pozycja === undefined) {
            wyswitl_powiadomienie('Zaznacz odpowiednią pozycję w pojeździe!!!', 0, 0);
            return false;
        }

        if (czy_w_pojezdzie == 1 && pozycja == 7) {
            if (inne_miejsce == '') {
                wyswitl_powiadomienie('Wpisz swoje miejsce!!!', 0, 0);
                return false;
            }
        }

        var pasy;
        if ($('.oz_byly_pasy').hasClass('zaznaczone')) {
            pasy = 1;
        } else if ($('.oz_bez_pasow').hasClass('zaznaczone')) {
            pasy = 2;
        }

        if (czy_w_pojezdzie == 1 && pasy === undefined) {
            wyswitl_powiadomienie('Uzupełnij informację o pasach!!!', 0, 0);
            return false;
        }

        var wspolwlasciciel;
        if ($('.oz_jestem_posiadaczem').hasClass('zaznaczone')) {
            wspolwlasciciel = 1;
        } else if ($('.oz_nie_jestem_posiadaczem').hasClass('zaznaczone')) {
            wspolwlasciciel = 2;
        }

        if (czy_w_pojezdzie == 1 && wspolwlasciciel === undefined) {
            wyswitl_powiadomienie('Uzupełnij dane o własności!!!', 0, 0);
            return false;
        }

        var spozycie_tak = ($('.oz_wiedza_o_piciu').hasClass('zaznaczone')) ? '1' : '0';
        var spozycie_nie = ($('.oz_brak_wiedzy_o_piciu').hasClass('zaznaczone')) ? '1' : '0';

        if (spozycie_tak == 1) {
            var spozycie = 2;
        } else if (spozycie_nie == 1) {
            var spozycie = 1;
        } else var spozycie = 0;

        var prawko_tak = ($('.oz_wiedza_o_prawku').hasClass('zaznaczone')) ? '1' : '0';
        var prawko_nie = ($('.oz_brak_wiedzy_o_prawku').hasClass('zaznaczone')) ? '1' : '0';

        if (prawko_tak == 1) {
            var prawko = 2;
        } else if (prawko_nie == 1) {
            var prawko = 1;
        } else var prawko = 0;

        var kim_byl;
        if ($('.oz_pieszy').hasClass('zaznaczone')) {
            kim_byl = 1;
        }
        if ($('.oz_rowerzysta').hasClass('zaznaczone')) {
            kim_byl = 2;
        }

        if (czy_w_pojezdzie == 0 && kim_byl === undefined) {
            wyswitl_powiadomienie('Zaznacz czy klient był rowerzystą czy pieszym!!!', 0, 0);
            return false;
        }

        var lecz_zakonczone = ($('.lecz_koniec').hasClass('zaznaczone')) ? '1' : '0';
        var lecz_data_zakonczenia = $('.lecz_koniec_data').val();
        var lecz_planowana_data = ($('.lecz_plan_koniec').hasClass('zaznaczone')) ? '1' : '0';
        var lecz_data_planowany = $('.lecz_data_plan_zak').val();
        var lecz_nieznana_data = ($('.lecz_brak_terminu').hasClass('zaznaczone')) ? '1' : '0';
        var lecz_planowane_zabiegi = ($('.lecz_zabiegi').hasClass('zaznaczone')) ? '1' : '0';


        if (lecz_zakonczone == 1) {
            var stan_leczenia = 1;
        } else if (lecz_planowana_data == 1) {
            var stan_leczenia = 2;
        } else if (lecz_nieznana_data == 1) {
            var stan_leczenia = 3;
        } else if (lecz_planowane_zabiegi == 1) {
            var stan_leczenia = 4;
        }

        if (lecz_zakonczone == 0 && lecz_planowana_data == 0 && lecz_nieznana_data == 0 && lecz_planowane_zabiegi == 0) {
            wyswitl_powiadomienie('Uzupełnij informację o leczeniu!!!', 0, 0);
            return false;
        }

        if (lecz_zakonczone == 1) {
            if (lecz_data_zakonczenia == '') {
                wyswitl_powiadomienie('Wpisz date zakonczenia leczenia!!!', 0, 0);
                return false;
            }
        }

        if (lecz_planowana_data == 1) {
            if (lecz_data_planowany == '') {
                wyswitl_powiadomienie('Wpisz date planowanego zakonczenia leczenia!!!', 0, 0);
                return false;
            }
        }

        var od_kiedy_l4 = $('.od_kiedy_l4').val();
        var termin_konca_zw = ($('.lecz_na_zwolnieniu_do').hasClass('zaznaczone')) ? '1' : '0';

        var do_kiedy_l4 = $('.do_kiedy_l4').val();
        var brak_terminu_konca_zw = ($('.lecz_na_zwolnieniu').hasClass('zaznaczone')) ? '1' : '0';

        if (od_kiedy_l4 != '') {
            if (termin_konca_zw == 0 && brak_terminu_konca_zw == 0) {
                wyswitl_powiadomienie('Wybierz termin końca zwolnienia!!!', 0, 0);
                return false;
            }
        }

        if (termin_konca_zw == 1) {
            if (od_kiedy_l4 == '') {
                wyswitl_powiadomienie('Wpisz date końca zwolnienia!!!', 0, 0);
                return false;
            }
        }

        var szpital = $('.szpital').val();
        var wezwano_pogotowie = ($('.pl_pogotowie').hasClass('zaznaczone')) ? '1' : '0';

        var przychodnia = $('.przychodnia').val();
        var przychodnia_data = $('.przychodnia_data').val();
        var leczenie_w_przychodni = ($('.pl_przychodnia').hasClass('zaznaczone')) ? '1' : '0';

        if (wezwano_pogotowie == 1) {
            if (szpital == '') {
                wyswitl_powiadomienie('Uzupełnij dane pogotowia!!!', 0, 0);
                return false;
            }
        }

        if (leczenie_w_przychodni == 1) {
            if (przychodnia == '' || przychodnia_data == '') {
                wyswitl_powiadomienie('Uzupełnij dane przychodni!!!', 0, 0);
                return false;

            }
        }

        przelacz_str_11();

        $.ajax({
            method: "POST",
            url: 'formularze_dokumenty/akcje/ajax_umowa_zapisz_do_bazy_str_11b',
            data: {
                id_sprawy: id_sprawy,
                stan: stan,
                po_czym: po_czym,
                czy_w_pojezdzie: czy_w_pojezdzie,
                typ_pojazdu: typ_pojazdu,
                inny_typ_pojazdu: inny_typ_pojazdu,
                pozycja: pozycja,
                inne_miejsce: inne_miejsce,
                pasy: pasy,
                wspolwlasciciel: wspolwlasciciel,
                spozycie: spozycie,
                prawko: prawko,
                kim_byl: kim_byl,
                stan_leczenia: stan_leczenia,
                lecz_data_zakonczenia: lecz_data_zakonczenia,
                lecz_data_planowany: lecz_data_planowany,
                od_kiedy_l4: od_kiedy_l4,
                do_kiedy_l4: do_kiedy_l4,
                szpital: szpital,
                przychodnia: przychodnia,
                przychodnia_data: przychodnia_data,
            }
        }).done(function (data) {

            wyswitl_powiadomienie('Zmiany zostały zapisane!!!', 1, 0);

            var array = $.parseJSON(data);

            $('.pl_hospitalizacja_o').attr('data-id_przebieg_leczenia', array[0]);
            $('.pl_hospitalizacja_o').data('id_przebieg_leczenia', array[0]);

            dodawanie_hospitalizacji();
            dodawanie_placowek();


        }).fail(function (ajaxContext) {
            document.getElementById("body_strona_r").innerHTML = ajaxContext.responseText;
        });

    });

}

function dodawanie_hospitalizacji() {
    

    var przebieg_leczenia_id = $('.pl_hospitalizacja_o').data('id_przebieg_leczenia');
    var licznik_rekordow = $('.pl_hospitalizacja_o').data('row');

    for (var i = 0; i <= licznik_rekordow; i++)

    {
	var aktywne_rekordy = $('.leczenie_hospitalizacja_' + i + '').data('row');


        if (aktywne_rekordy !== undefined) {
            var miejsce_hospitalizacji_is = $('.leczenie_hospitalizacja_' + i + ' .hospitalizacja').val();
            var data_hospitalizacji_is = $('.leczenie_hospitalizacja_' + i + ' .hospitalizacja_data').val();
            var data_hospitalizacji_do_is = $('.leczenie_hospitalizacja_' + i + ' .hospitalizacja_data_do').val();
            var id_hospitalizacji_is = $('.leczenie_hospitalizacja_' + i + '').data('id_hospitalizacji');

        }

        if (miejsce_hospitalizacji_is) {
            
            var miejsce_hospitalizacji = miejsce_hospitalizacji_is;
            var data_hospitalizacji = data_hospitalizacji_is;
            var data_hospitalizacji_do = data_hospitalizacji_do_is;
            var id_hospitalizacji = id_hospitalizacji_is;

            $.ajax({
                method: "POST",
                url: "ajax/akcje/ajax_sprawa_hospitalizacja_zapisz_zmiany",
                data: {
                    miejsce_hospitalizacji: miejsce_hospitalizacji,
                    data_hospitalizacji: data_hospitalizacji,
                    data_hospitalizacji_do: data_hospitalizacji_do,
                    id_hospitalizacji: id_hospitalizacji,
                    przebieg_leczenia_id: przebieg_leczenia_id
                }
            }).done(function (data) {

        	var array = $.parseJSON(data);

            }).fail(function (ajaxContext) {
                document.getElementById("body_strona_r").innerHTML = ajaxContext.responseText;
            });

        }
    }
}

function dodawanie_placowek() {

    var przebieg_leczenia_id = $('.pl_hospitalizacja_o').data('id_przebieg_leczenia');
    var licznik_zabiegow = $('.pl_zabiegi_o').data('row');

    for (var j = 0; j <= licznik_zabiegow; j++)

    {

        var aktywne_rekordy = $('.placowki_zabiegi_' + j + '').data('row');

        if (aktywne_rekordy !== undefined) {
            var miejsce_zabiegu_is = $('.placowki_zabiegi_' + j + ' .placowka_zabieg').val();
            var data_zabiegu_is = $('.placowki_zabiegi_' + j + ' .placowka_zabieg_data').val();
            var id_zabiegu_is = $('.placowki_zabiegi_' + j + '').data('id_placowek');

        }

        if (miejsce_zabiegu_is) {

            var miejsce_zabiegu = miejsce_zabiegu_is;
            var data_zabiegu = data_zabiegu_is;
            var id_zabiegu = id_zabiegu_is;


            $.ajax({
                method: "POST",
                url: "ajax/akcje/ajax_sprawa_zabiegi_zapisz_zmiany",
                data: {
                    miejsce_zabiegu: miejsce_zabiegu,
                    data_zabiegu: data_zabiegu,
                    id_zabiegu: id_zabiegu,
                    przebieg_leczenia_id: przebieg_leczenia_id
                }
            }).done().fail(function (ajaxContext) {
                document.getElementById("body_strona_r").innerHTML = ajaxContext.responseText;
            });

        }
    }
}
function generuj_drukuj_wszystko_pdf() {
    $('.generuj_drukuj_wszystko_pdf').click(function () {
        var uzytkownik_id = $('#uzytkownik_id').data('uzytkownik_id');
        var id_sprawy = $(this).data('id_sprawy');
        var id_umowy = $(this).data('id_umowa');
        
        $( "#result" ).load( "ajax/test.html" );

        wyswietl_loader('Trwa generowanie PDF. Prosze czekać!!!');

        $.ajax({
            method: "POST",
            url: "ajax/akcje/ajax_generuj_drukuj_wszystko",
            data: {
                uzytkownik_id: uzytkownik_id,
                id_sprawy: id_sprawy,
                id_umowy: id_umowy

            }
        }).done(function (data) {
            var array = $.parseJSON(data);

            ukryj_loader();

            if (array[0] === '0') {
                wyswitl_powiadomienie('Brak szablonu!!!', 0, 0);
                return false;
            } else {

                var downloadLink = document.createElement("a");

                downloadLink.href = 'wyswietl_pdf?id_sprawy=' + id_sprawy + '&id_umowy=' + id_umowy + '&drukuj_wszystko=1';

                window.open(downloadLink.href);
            }

            zeruj_licznik_sesji_po_wykonaniu_funkcji();

        }).fail(function (ajaxContext) {
            document.getElementById("body_strona_r").innerHTML = ajaxContext.responseText;
        });
    });
}

function rodzaj_poszkodowanego() {
    
    $('.poszkodowany_maloletni').click(function () {
	
	if ($(this).hasClass('zaznaczone')) {
	    $('.poszkodowany_maloletni').removeClass('zaznaczone');
	} else {
	    $(this).addClass('zaznaczone');
	    $('.poszkodowany_ubezwlasnowolniony').removeClass('zaznaczone');
	    $('.poszkodowany_malzonek').removeClass('zaznaczone');
	}
    });
    
    $('.poszkodowany_ubezwlasnowolniony').click(function () {
	
	if ($(this).hasClass('zaznaczone')) {
	    $('.poszkodowany_ubezwlasnowolniony').removeClass('zaznaczone');
	} else {
	    $(this).addClass('zaznaczone');
	    $('.poszkodowany_maloletni').removeClass('zaznaczone');
	    $('.poszkodowany_malzonek').removeClass('zaznaczone');
	}
    });

    $('.poszkodowany_malzonek').click(function () {
	
	if ($(this).hasClass('zaznaczone')) {
	    $('.poszkodowany_malzonek').removeClass('zaznaczone');
	} else {
	    $(this).addClass('zaznaczone');
	    $('.poszkodowany_ubezwlasnowolniony').removeClass('zaznaczone');
	    $('.poszkodowany_maloletni').removeClass('zaznaczone');
	}
    });
    
} 

function uzupelnij_dane_klienta_na_podstawie_wybranego_z_listy_b1() {
    $('.lista_klientow_opcje_b1').change(function () {


        var id_klienta = $('.lista_klientow_opcje_b1 option:selected').attr('id');

        $.ajax({
                method: "POST",
                url: "ajax/akcje/ajax_pobierz_klienta_po_id",
                data: {
                    klient_id: id_klienta
                }
            })
            .done(function (data) {

                var array = $.parseJSON(data);
                
                $('.dodawanie_klienta_b1').slideDown();
                
                $('.sprawa_klient_dane').attr('data-klient_wybrany_id', id_klienta);
                $('.sprawa_klient_dane').data('klient_wybrany_id', id_klienta);

                $('.zl_imie_um_bank_1').val(array[2]);
                $('.zl_imie_um_bank_1').attr('value', array[2]);

                $('.zl_nazwisko_um_bank_1').val(array[3]);
                $('.zl_nazwisko_um_bank_1').attr('value', array[3]);

                $('.zl_ulica_um_bank_1').val(array[6]);
                $('.zl_ulica_um_bank_1').attr('value', array[6]);

                $('.zl_nr_domu_um_bank_1').val(array[7]);
                $('.zl_nr_domu_um_bank_1').attr('value', array[7]);

                $('.zl_nr_mieszkania_um_bank_1').val(array[8]);
                $('.zl_nr_mieszkania_um_bank_1').attr('value', array[8]);

                $('.zl_miejscowosc_um_bank_1').val(array[9]);
                $('.zl_miejscowosc_um_bank_1').attr('value', array[9]);

                $('.zl_email_um_bank_1').val(array[10]);
                $('.zl_email_um_bank_1').attr('value', array[10]);

                $('.zl_telefon_um_bank_1').val(array[11]);
                $('.zl_telefon_um_bank_1').attr('value', array[11]);

                $('.zl_kod_pocztowy_um_bank_1').val(array[12]);
                $('.zl_kod_pocztowy_um_bank_1').attr('value', array[12]);
                
                $('.zl_obc_um_bank_1').attr('data-obcokrajowiec', array[14]);
                $('.zl_obc_um_bank_1').data('obcokrajowiec', array[14]);

                /* medyk 16-11-2016 */
                if (array[14] == '0') {
                    $('.zl_wiek_um_bank_1').val(array[13]);
                    $('.zl_wiek_um_bank_1').attr('value', array[13]);
                    
                    $('.zl_pesel_um_bank_1').val(array[4]);
                    $('.zl_pesel_um_bank_1').attr('value', array[4]);

                    $('.zl_numer_dowodu_um_bank_1').val(array[5]);
                    $('.zl_numer_dowodu_um_bank_1').attr('value', array[5]);
                    
                } else if (array[14] == '1') {
                    $('.zl_wiek_um_bank_1').val(array[13]);
                    $('.zl_wiek_um_bank_1').attr('value', array[13]);
                    
                    $('.zl_pesel_um_bank_1').val(array[15]);
                    $('.zl_pesel_um_bank_1').attr('value', array[15]);

                    $('.zl_numer_dowodu_um_bank_1').val(array[16]);
                    $('.zl_numer_dowodu_um_bank_1').attr('value', array[16]);
                }

                /*KaMyK 11-08-2016*/
                if ($('.lista_klientow_opcje').hasClass('lko_edycja')) {
                    var id_sprawy = $('#zakladki_tresc').data('id_sprawy');
                    //alert();
                    if (id_klienta == '' || id_klienta == undefined) {
                        id_klienta = 0;
                    }
                    kratka_zapisz_zmiane('sprawa', id_sprawy, 'sprawa_klient_id', id_klienta);

                }

            }).fail(function (ajaxContext) {
                document.getElementById("body_strona_r").innerHTML = ajaxContext.responseText;
            });
    });
}

function uzupelnij_dane_klienta_na_podstawie_wybranego_z_listy_b2() {
    $('.lista_klientow_opcje_b2').change(function () {

        var id_klienta = $('.lista_klientow_opcje_b2 option:selected').attr('id');

        
        $.ajax({
                method: "POST",
                url: "ajax/akcje/ajax_pobierz_klienta_po_id",
                data: {
                    klient_id: id_klienta
                }
            })
            .done(function (data) {

                var array = $.parseJSON(data);
                
                $('.dodawanie_klienta_b2').slideDown();
                
                $('.sprawa_klient_dane').attr('data-klient_wybrany_id', id_klienta);
                $('.sprawa_klient_dane').data('klient_wybrany_id', id_klienta);

                $('.zl_imie_um_bank_2').val(array[2]);
                $('.zl_imie_um_bank_2').attr('value', array[2]);

                $('.zl_nazwisko_um_bank_2').val(array[3]);
                $('.zl_nazwisko_um_bank_2').attr('value', array[3]);

                $('.zl_ulica_um_bank_2').val(array[6]);
                $('.zl_ulica_um_bank_2').attr('value', array[6]);

                $('.zl_nr_domu_um_bank_2').val(array[7]);
                $('.zl_nr_domu_um_bank_2').attr('value', array[7]);

                $('.zl_nr_mieszkania_um_bank_2').val(array[8]);
                $('.zl_nr_mieszkania_um_bank_2').attr('value', array[8]);

                $('.zl_miejscowosc_um_bank_2').val(array[9]);
                $('.zl_miejscowosc_um_bank_2').attr('value', array[9]);

                $('.zl_email_um_bank_2').val(array[10]);
                $('.zl_email_um_bank_2').attr('value', array[10]);

                $('.zl_telefon_um_bank_2').val(array[11]);
                $('.zl_telefon_um_bank_2').attr('value', array[11]);

                $('.zl_kod_pocztowy_um_bank_2').val(array[12]);
                $('.zl_kod_pocztowy_um_bank_2').attr('value', array[12]);
                
                $('.zl_obc_um_bank_2').attr('data-obcokrajowiec', array[14]);
                $('.zl_obc_um_bank_2').data('obcokrajowiec', array[14]);

                /* medyk 16-11-2016 */
                if (array[14] == '0') {
                    $('.zl_wiek_um_bank_2').val(array[13]);
                    $('.zl_wiek_um_bank_2').attr('value', array[13]);
                    
                    $('.zl_pesel_um_bank_2').val(array[4]);
                    $('.zl_pesel_um_bank_2').attr('value', array[4]);

                    $('.zl_numer_dowodu_um_bank_2').val(array[5]);
                    $('.zl_numer_dowodu_um_bank_2').attr('value', array[5]);
                    
                } else if (array[14] == '1') {
                    $('.zl_wiek_um_bank_2').val(array[13]);
                    $('.zl_wiek_um_bank_2').attr('value', array[13]);
                    
                    $('.zl_pesel_um_bank_2').val(array[15]);
                    $('.zl_pesel_um_bank_2').attr('value', array[15]);

                    $('.zl_numer_dowodu_um_bank_2').val(array[16]);
                    $('.zl_numer_dowodu_um_bank_2').attr('value', array[16]);
                }


                /*KaMyK 11-08-2016*/
                if ($('.lista_klientow_opcje').hasClass('lko_edycja')) {
                    var id_sprawy = $('#zakladki_tresc').data('id_sprawy');

                    if (id_klienta == '' || id_klienta == undefined) {
                        id_klienta = 0;
                    }
                    kratka_zapisz_zmiane('sprawa', id_sprawy, 'sprawa_klient_id', id_klienta);

                }
            }).fail(function (ajaxContext) {
                document.getElementById("body_strona_r").innerHTML = ajaxContext.responseText;
            });

    });
}
function strona_zleceniodawca_bank() {

    $('.instrukcja_dodaj_b1').click(function () {

        $('.zleceniodawca_formularz_dodaj_b1').slideDown();
        $('.zleceniodawca_formularz_b1').slideUp();

    });
    $('.instrukcja_dodaj_b2').click(function () {

        $('.zleceniodawca_formularz_dodaj_b2').slideDown();
        $('.zleceniodawca_formularz_b2').slideUp();

    });
}
function zapisz_strone_zleceniodawcow() {
    
    $('.instrukcja_dodaj_b1').children().click(function () {
	
        $('#zakladki_tresc').attr('data-id_klienta_1', '');
        $('.lista_klientow_opcje_b1').find('option:selected').remove();

    });
    
    $('.instrukcja_dodaj_b2').children().click(function () {
	
        $('#zakladki_tresc').attr('data-id_klienta_2', '');
        $('.lista_klientow_opcje_b2').find('option:selected').remove();

    });

    $('.zapisz_strone_zlec_1').click(function () {
	
	var id_sprawy = $('#zakladki_tresc').data('id_sprawy');
	
        var id_istniejacego_klienta_1 = $('#zakladki_tresc').data('id_klienta_1');
        var id_istniejacego_klienta_2 = $('#zakladki_tresc').data('id_klienta_2');

        var czy_nowy_klient_1 = '0';
        var czy_nowy_klient_2 = '0';

        var id_klienta_1 = $('.lista_klientow_opcje_b1 option:selected').attr('id');
        var id_klienta_2 = $('.lista_klientow_opcje_b2 option:selected').attr('id');

       // alert('KL1przed '+id_klienta_1);
        //alert('KL2przed '+id_klienta_2);

        id_klienta_1 = (id_klienta_1 === undefined) ? id_istniejacego_klienta_1 : id_klienta_1;
        id_klienta_2 = (id_klienta_2 === undefined) ? id_istniejacego_klienta_2 : id_klienta_2;

        //alert('KL1 '+id_klienta_1);
        //alert('KL2 '+id_klienta_2);

         if (id_klienta_1 === undefined) {

             //alert('Weszlo kl1');

             var zleceniodawca_1_imie = $('.b1_imie_dodaj').val();
             var zleceniodawca_1_nazwisko = $('.b1_nazwisko_dodaj').val();
             var zleceniodawca_1_ulica = $('.b1_ulica_dodaj').val();
             var zleceniodawca_1_nr_domu = $('.b1_nr_domu_dodaj').val();
             var zleceniodawca_1_nr_mieszkania = $('.b1_nr_mieszkania_dodaj').val();
             var zleceniodawca_1_kod_pocztowy = $('.b1_kod_pocztowy_dodaj').val();
             var zleceniodawca_1_miejscowosc = $('.b1_miejscowosc_dodaj').val();
             var zleceniodawca_1_email = $('.b1_email_dodaj').val();
             var zleceniodawca_1_telefon = $('.b1_telefon_dodaj').val();
             var zleceniodawca_1_pesel = $('.b1_pesel_dodaj').val();
             var zleceniodawca_1_seria_i_numer_dowodu = $('.b1_seria_i_numer_dowodu_dodaj').val();
             var zleceniodawca_1_dokument = $('.b1_dokument_dodaj').val();
             var zleceniodawca_1_numer_dokumentu = $('.b1_numer_dokumentu_dodaj').val();

             var zleceniodawca_1_ulica_kor = $('.b1_ulica_kor_dodaj').val();
             var zleceniodawca_1_nr_domu_kor = $('.b1_nr_domu_kor_dodaj').val();
             var zleceniodawca_1_nr_mieszkania_kor = $('.b1_nr_mieszkania_kor_dodaj').val();
             var zleceniodawca_1_kod_pocztowy_kor = $('.b1_kod_pocztowy_kor_dodaj').val();
             var zleceniodawca_1_miejscowosc_kor = $('.b1_miejscowosc_kor_dodaj').val();

             var czy_obcokrajowiec_1 = ($('.zl_obc_um_bank_1 .nie').hasClass('zaznaczone')) ? '0' : '1';
             var adres_do_korespondencji_1 = ($('.b1_adres_kor').hasClass('zaznaczone')) ? '1' : '0';


             czy_nowy_klient_1 = '1';


                         if (czy_obcokrajowiec_1 == '0') {

                             if (zleceniodawca_1_pesel == '' || zleceniodawca_1_seria_i_numer_dowodu == '') {
                                 wyswitl_powiadomienie('Uzupełnij dane klienta!!!', 0, 0);
                                 return false;
                             }

                         } else {

                             if (zleceniodawca_1_dokument == '' || zleceniodawca_1_numer_dokumentu == '') {
                                 wyswitl_powiadomienie('Uzupełnij dane klienta!!!', 0, 0);
                                 return false;
                             }
                         }

                         $('.b1_imie_dodaj').parent().addClass('zablokowane_pole');
                         $('.b1_nazwisko_dodaj').parent().addClass('zablokowane_pole');
                         $('.b1_ulica_dodaj').parent().addClass('zablokowane_pole');
                         $('.b1_nr_domu_dodaj').parent().addClass('zablokowane_pole');
                         $('.b1_nr_mieszkania_dodaj').parent().addClass('zablokowane_pole');
                         $('.b1_kod_pocztowy_dodaj').parent().addClass('zablokowane_pole');
                         $('.b1_miejscowosc_dodaj').parent().addClass('zablokowane_pole');
                         $('.b1_email_dodaj').parent().addClass('zablokowane_pole');
                         $('.b1_telefon_dodaj').parent().addClass('zablokowane_pole');
                         $('.b1_pesel_dodaj').parent().addClass('zablokowane_pole');
                         $('.b1_seria_i_numer_dowodu_dodaj').parent().addClass('zablokowane_pole');
                         $('.b1_dokument_dodaj').parent().addClass('zablokowane_pole');
                         $('.b1_numer_dokumentu_dodaj').parent().addClass('zablokowane_pole');
                         $('.b1_ulica_kor_dodaj').parent().addClass('zablokowane_pole');
                         $('.b1_nr_domu_kor_dodaj').parent().addClass('zablokowane_pole');
                         $('.b1_nr_mieszkania_kor_dodaj').parent().addClass('zablokowane_pole');
                         $('.b1_kod_pocztowy_kor_dodaj').parent().addClass('zablokowane_pole');
                         $('.b1_miejscowosc_kor_dodaj').parent().addClass('zablokowane_pole');

                         $('.b1_kod_pocztowy_dodaj').parent().removeClass('poprawna');
                         $('.b1_kod_pocztowy_dodaj').removeClass('kod_niepoprawny');
                         $('.b1_kod_pocztowy_dodaj').removeClass('kod_poprawny');
                         $('.b1_pesel_dodaj').parent().removeClass('poprawna');
                         $('.b1_pesel_dodaj').removeClass('pesel_niepoprawny');
                         $('.b1_pesel_dodaj').removeClass('pesel_poprawny');
                         $('.b1_seria_i_numer_dowodu_dodaj').parent().removeClass('poprawna');
                         $('.b1_seria_i_numer_dowodu_dodaj').removeClass('dowod_niepoprawny');
                         $('.b1_seria_i_numer_dowodu_dodaj').removeClass('dowod_poprawny');
                 }
        
         if (id_klienta_2 === undefined) {

             //alert('Weszlo kl2');
             
             var zleceniodawca_2_imie = $('.b2_imie_dodaj').val();
             var zleceniodawca_2_nazwisko = $('.b2_nazwisko_dodaj').val();
             var zleceniodawca_2_ulica = $('.b2_ulica_dodaj').val();
             var zleceniodawca_2_nr_domu = $('.b2_nr_domu_dodaj').val();
             var zleceniodawca_2_nr_mieszkania = $('.b2_nr_mieszkania_dodaj').val();
             var zleceniodawca_2_kod_pocztowy = $('.b2_kod_pocztowy_dodaj').val();
             var zleceniodawca_2_miejscowosc = $('.b2_miejscowosc_dodaj').val();
             var zleceniodawca_2_email = $('.b2_email_dodaj').val();
             var zleceniodawca_2_telefon = $('.b2_telefon_dodaj').val();
             var zleceniodawca_2_pesel = $('.b2_pesel_dodaj').val();
             var zleceniodawca_2_seria_i_numer_dowodu = $('.b2_seria_i_numer_dowodu_dodaj').val();
             var zleceniodawca_2_dokument = $('.b2_dokument_dodaj').val();
             var zleceniodawca_2_numer_dokumentu = $('.b2_numer_dokumentu_dodaj').val();

             var zleceniodawca_2_ulica_kor = $('.b2_ulica_kor_dodaj').val();
             var zleceniodawca_2_nr_domu_kor = $('.b2_nr_domu_kor_dodaj').val();
             var zleceniodawca_2_nr_mieszkania_kor = $('.b2_nr_mieszkania_kor_dodaj').val();
             var zleceniodawca_2_kod_pocztowy_kor = $('.b2_kod_pocztowy_kor_dodaj').val();
             var zleceniodawca_2_miejscowosc_kor = $('.b2_miejscowosc_kor_dodaj').val();

             var czy_obcokrajowiec_2 = ($('.zl_obc_um_bank_2 .nie').hasClass('zaznaczone')) ? '0' : '1';
             var adres_do_korespondencji_2 = ($('.b2_adres_kor').hasClass('zaznaczone')) ? '1' : '0';

             czy_nowy_klient_2 = '1';


                 if (czy_obcokrajowiec_2 == '0') {

                     if (zleceniodawca_2_pesel == '' || zleceniodawca_2_seria_i_numer_dowodu == '') {
                         wyswitl_powiadomienie('Uzupełnij dane klienta!!!', 0, 0);
                         return false;
                     }
                 } else {
                     if (zleceniodawca_2_dokument == '' || zleceniodawca_2_numer_dokumentu == '') {
                         wyswitl_powiadomienie('Uzupełnij dane klienta!!!', 0, 0);
                         return false;
                     }
                 }
                 
                 $('.b2_imie_dodaj').parent().addClass('zablokowane_pole');
                 $('.b2_nazwisko_dodaj').parent().addClass('zablokowane_pole');
                 $('.b2_ulica_dodaj').parent().addClass('zablokowane_pole');
                 $('.b2_nr_domu_dodaj').parent().addClass('zablokowane_pole');
                 $('.b2_nr_mieszkania_dodaj').parent().addClass('zablokowane_pole');
                 $('.b2_kod_pocztowy_dodaj').parent().addClass('zablokowane_pole');
                 $('.b2_miejscowosc_dodaj').parent().addClass('zablokowane_pole');
                 $('.b2_email_dodaj').parent().addClass('zablokowane_pole');
                 $('.b2_telefon_dodaj').parent().addClass('zablokowane_pole');
                 $('.b2_pesel_dodaj').parent().addClass('zablokowane_pole');
                 $('.b2_seria_i_numer_dowodu_dodaj').parent().addClass('zablokowane_pole');
                 $('.b2_dokument_dodaj').parent().addClass('zablokowane_pole');
                 $('.b2_numer_dokumentu_dodaj').parent().addClass('zablokowane_pole');
                 $('.b2_ulica_kor_dodaj').parent().addClass('zablokowane_pole');
                 $('.b2_nr_domu_kor_dodaj').parent().addClass('zablokowane_pole');
                 $('.b2_nr_mieszkania_kor_dodaj').parent().addClass('zablokowane_pole');
                 $('.b2_kod_pocztowy_kor_dodaj').parent().addClass('zablokowane_pole');
                 $('.b2_miejscowosc_kor_dodaj').parent().addClass('zablokowane_pole');
                 $('.b2_kod_pocztowy_dodaj').parent().removeClass('poprawna');
                 $('.b2_kod_pocztowy_dodaj').removeClass('kod_niepoprawny');
                 $('.b2_kod_pocztowy_dodaj').removeClass('kod_poprawny');
                 $('.b2_pesel_dodaj').parent().removeClass('poprawna');
                 $('.b2_pesel_dodaj').removeClass('pesel_niepoprawny');
                 $('.b2_pesel_dodaj').removeClass('pesel_poprawny');
                 $('.b2_seria_i_numer_dowodu_dodaj').parent().removeClass('poprawna');
                 $('.b2_seria_i_numer_dowodu_dodaj').removeClass('dowod_niepoprawny');
                 $('.b2_seria_i_numer_dowodu_dodaj').removeClass('dowod_poprawny');
         }


         przelacz_str_2_b();

        $.ajax({
                method: "POST",
                url: "formularze_dokumenty/akcje/ajax_umowa_zapisz_do_bazy_str_2_bank",

                data: {

                    id_sprawy: id_sprawy,
                    id_klienta_1: id_klienta_1,
                    czy_nowy_klient_1: czy_nowy_klient_1,
                    adres_do_korespondencji_1: adres_do_korespondencji_1,
                    czy_obcokrajowiec_1: czy_obcokrajowiec_1,
                    zleceniodawca_1_imie: zleceniodawca_1_imie,
                    zleceniodawca_1_nazwisko: zleceniodawca_1_nazwisko,
                    zleceniodawca_1_ulica: zleceniodawca_1_ulica,
                    zleceniodawca_1_nr_domu: zleceniodawca_1_nr_domu,
                    zleceniodawca_1_nr_mieszkania: zleceniodawca_1_nr_mieszkania,
                    zleceniodawca_1_kod_pocztowy: zleceniodawca_1_kod_pocztowy,
                    zleceniodawca_1_miejscowosc: zleceniodawca_1_miejscowosc,
                    zleceniodawca_1_email: zleceniodawca_1_email,
                    zleceniodawca_1_telefon: zleceniodawca_1_telefon,
                    zleceniodawca_1_pesel: zleceniodawca_1_pesel,
                    zleceniodawca_1_seria_i_numer_dowodu: zleceniodawca_1_seria_i_numer_dowodu,
                    zleceniodawca_1_dokument: zleceniodawca_1_dokument,
                    zleceniodawca_1_numer_dokumentu: zleceniodawca_1_numer_dokumentu,
                    zleceniodawca_1_ulica_kor: zleceniodawca_1_ulica_kor,
                    zleceniodawca_1_nr_domu_kor: zleceniodawca_1_nr_domu_kor,
                    zleceniodawca_1_nr_mieszkania_kor: zleceniodawca_1_nr_mieszkania_kor,
                    zleceniodawca_1_kod_pocztowy_kor: zleceniodawca_1_kod_pocztowy_kor,
                    zleceniodawca_1_miejscowosc_kor: zleceniodawca_1_miejscowosc_kor,

                    id_klienta_2: id_klienta_2,
                    czy_nowy_klient_2: czy_nowy_klient_2,
                    adres_do_korespondencji_2: adres_do_korespondencji_2,
                    czy_obcokrajowiec_2: czy_obcokrajowiec_2,
                    zleceniodawca_2_imie: zleceniodawca_2_imie,
                    zleceniodawca_2_nazwisko: zleceniodawca_2_nazwisko,
                    zleceniodawca_2_ulica: zleceniodawca_2_ulica,
                    zleceniodawca_2_2_nr_domu: zleceniodawca_2_nr_domu,
                    zleceniodawca_2_nr_mieszkania: zleceniodawca_2_nr_mieszkania,
                    zleceniodawca_2_kod_pocztowy: zleceniodawca_2_kod_pocztowy,
                    zleceniodawca_2_miejscowosc: zleceniodawca_2_miejscowosc,
                    zleceniodawca_2_email: zleceniodawca_2_email,
                    zleceniodawca_2_telefon: zleceniodawca_2_telefon,
                    zleceniodawca_2_pesel: zleceniodawca_2_pesel,
                    zleceniodawca_2_seria_i_numer_dowodu: zleceniodawca_2_seria_i_numer_dowodu,
                    zleceniodawca_2_dokument: zleceniodawca_2_dokument,
                    zleceniodawca_2_numer_dokumentu: zleceniodawca_2_numer_dokumentu,
                    zleceniodawca_2_ulica_kor: zleceniodawca_2_ulica_kor,
                    zleceniodawca_2_nr_domu_kor: zleceniodawca_2_nr_domu_kor,
                    zleceniodawca_2_nr_mieszkania_kor: zleceniodawca_2_nr_mieszkania_kor,
                    zleceniodawca_2_kod_pocztowy_kor: zleceniodawca_2_kod_pocztowy_kor,
                    zleceniodawca_2_miejscowosc_kor: zleceniodawca_2_miejscowosc_kor

                }
            })
            .done(function (data) {

                var array = $.parseJSON(data);

                $('#zakladki_tresc').attr('data-id_sprawy', array[0]);
                $('#zakladki_tresc').data('id_sprawy', array[0]);
                
                $('#zakladki_tresc').attr('data-id_klienta_1', array[1]);
                $('#zakladki_tresc').data('id_klienta_1', array[1]);
                
                $('#zakladki_tresc').attr('data-id_klienta_2', array[2]);
                $('#zakladki_tresc').data('id_klienta_2', array[2]);

               wyswitl_powiadomienie('Dane zostały zapisane.', 1, 0);

                $('.str_2_b').hide();
       		$('.str_3_b').show();
       		$('.str_4_b').hide();
       		$('.str_5_b').hide();
       		$('.str_6_b').hide();
       		$('.str_7_b').hide();

            }).fail(function (ajaxContext) {
                document.getElementById("body_strona_r").innerHTML = ajaxContext.responseText;
            });

    });
}

function zapisz_strone_3_bank() {


    $('.zapisz_str_3_b').click(function () {
	
	var id_sprawy = $('#zakladki_tresc').data('id_sprawy');
             
             
             var nazwa_banku = $('.nazwa_banku').val();
             var numer_umowy = $('.numer_umowy').val();

         przelacz_str_3_b();

        $.ajax({
                method: "POST",
                url: "formularze_dokumenty/akcje/ajax_umowa_zapisz_do_bazy_str_3_bank",

                data: {

                    id_sprawy: id_sprawy,
                    nazwa_banku: nazwa_banku,
                    numer_umowy: numer_umowy

                }
            })
            .done(function (data) {

                var array = $.parseJSON(data);

                $('#zakladki_tresc').attr('data-id_sprawy', array[0]);
                $('#zakladki_tresc').data('id_sprawy', array[0]);
                
                $('#zakladki_tresc').attr('data-id_umowy_bankowej', array[1]);
                $('#zakladki_tresc').data('id_umowy_bankowej', array[1]);
                
                $('#zakladki_tresc').attr('data-nazwa_banku', array[2]);
                $('#zakladki_tresc').data('nazwa_banku', array[2]);
                
                $('#zakladki_tresc').attr('data-nr_umowy_bankowej', array[3]);
                $('#zakladki_tresc').data('nr_umowy_bankowej', array[3]);

               wyswitl_powiadomienie('Dane zostały zapisane.', 1, 0);

                $('.str_2_b').hide();
       		$('.str_3_b').hide();
       		$('.str_4_b').show();
       		$('.str_5_b').hide();
       		$('.str_6_b').hide();
       		$('.str_7_b').hide();

            }).fail(function (ajaxContext) {
                document.getElementById("body_strona_r").innerHTML = ajaxContext.responseText;
            });
    });
}

function zapisz_strone_4_bank() {


    $('.zapisz_str_4_b').click(function () {
	
	var id_sprawy = $('#zakladki_tresc').data('id_sprawy');
	var id_umowy_bankowej = $('#zakladki_tresc').data('id_umowy_bankowej');
	var nazwa_banku = $('#zakladki_tresc').data('nazwa_banku');
	var numer_umowy = $('#zakladki_tresc').data('nr_umowy_bankowej');
             
	var umowa = ($('.dok_umowa').hasClass('zaznaczone')) ? '1' : '0';
	var pelnomocnictwo = ($('.dok_pelnomocnictwo').hasClass('zaznaczone')) ? '1' : '0';
	var dowod = ($('.dok_dok_tozsam').hasClass('zaznaczone')) ? '1' : '0';
	var wniosek = ($('.dok_wniosek_kred').hasClass('zaznaczone')) ? '1' : '0';
	var umowa_z_bankiem = ($('.dok_umowa_kred').hasClass('zaznaczone')) ? '1' : '0';
	var regulamin = ($('.dok_regulamin').hasClass('zaznaczone')) ? '1' : '0';
	var tabela = ($('.dok_tab_oplat').hasClass('zaznaczone')) ? '1' : '0';
	var harmonogram = ($('.dok_harmonogram').hasClass('zaznaczone')) ? '1' : '0';
	var potwierdzenie = ($('.dok_potwierdzenie').hasClass('zaznaczone')) ? '1' : '0';
	var decyzja = ($('.dok_decyzje').hasClass('zaznaczone')) ? '1' : '0';
	var oplaty = ($('.dok_potw_oplaty').hasClass('zaznaczone')) ? '1' : '0';
	var dowod_wspolkredytobiorcy = ($('.dok_dok_tozsamosci_zlec_2').hasClass('zaznaczone')) ? '1' : '0';
	var akt_malzenstwa = ($('.dok_akt_malzenstwa').hasClass('zaznaczone')) ? '1' : '0';


         przelacz_str_4_b();

        $.ajax({
                method: "POST",
                url: "formularze_dokumenty/akcje/ajax_umowa_zapisz_do_bazy_str_4_bank",

                data: {

                    id_sprawy: id_sprawy,
                    nazwa_banku: nazwa_banku,
                    numer_umowy: numer_umowy,
                    id_umowy_bankowej: id_umowy_bankowej,
                    umowa: umowa,
                    pelnomocnictwo: pelnomocnictwo,
                    dowod: dowod,
                    wniosek: wniosek,
                    umowa_z_bankiem: umowa_z_bankiem,
                    regulamin: regulamin,
                    tabela: tabela,
                    harmonogram: harmonogram,
                    potwierdzenie: potwierdzenie,
                    decyzja: decyzja,
                    oplaty: oplaty,
                    dowod_wspolkredytobiorcy: dowod_wspolkredytobiorcy,
                    akt_malzenstwa: akt_malzenstwa

                }
            })
            .done(function (data) {

                var array = $.parseJSON(data);

                $('#zakladki_tresc').attr('data-id_sprawy', array[0]);
                $('#zakladki_tresc').data('id_sprawy', array[0]);
                
                $('#zakladki_tresc').attr('data-id_umowy_bankowej', array[1]);
                $('#zakladki_tresc').data('id_umowy_bankowej', array[1]);

               wyswitl_powiadomienie('Dane zostały zapisane.', 1, 0);

                $('.str_2_b').hide();
       		$('.str_3_b').hide();
       		$('.str_4_b').hide();
       		$('.str_5_b').show();
       		$('.str_6_b').hide();
       		$('.str_7_b').hide();

            }).fail(function (ajaxContext) {
                document.getElementById("body_strona_r").innerHTML = ajaxContext.responseText;
            });
    });
}

function zapisz_strone_5_bank() {

    $('.zapisz_str_5_b').click(function () {
	
	var id_sprawy = $('#zakladki_tresc').data('id_sprawy');
	var id_umowy_bankowej = $('#zakladki_tresc').data('id_umowy_bankowej');
             
	var zgloszono_zwrot = ($('.zlecono_zwrot_tak').hasClass('zaznaczone')) ? '1' : '0';
	var niesplacone_raty = ($('.nadplacone_raty').hasClass('zaznaczone')) ? '1' : '0';
	var oplata_ubezp_pom = ($('.oplaty_ubep_pom').hasClass('zaznaczone')) ? '1' : '0';
	var data_oplata_ubezp_pom = $('.data_ub_pom').val();
	var oplata_wklad_wlasny = ($('.oplaty_ubezp_wkl_wl').hasClass('zaznaczone')) ? '1' : '0';
	var data_oplata_wklad_wlasny = $('.data_wk_wl').val();
	
	
         przelacz_str_5_b();

        $.ajax({
                method: "POST",
                url: "formularze_dokumenty/akcje/ajax_umowa_zapisz_do_bazy_str_5_bank",

                data: {

                    id_sprawy: id_sprawy,
                    zgloszono_zwrot: zgloszono_zwrot,
                    niesplacone_raty: niesplacone_raty,
                    oplata_ubezp_pom: oplata_ubezp_pom,
                    data_oplata_ubezp_pom: data_oplata_ubezp_pom,
                    oplata_wklad_wlasny: oplata_wklad_wlasny,
                    id_umowy_bankowej: id_umowy_bankowej,
                    data_oplata_wklad_wlasny: data_oplata_wklad_wlasny
                }
            })
            .done(function (data) {

                var array = $.parseJSON(data);

                $('#zakladki_tresc').attr('data-id_sprawy', array[0]);
                $('#zakladki_tresc').data('id_sprawy', array[0]);
                
                $('#zakladki_tresc').attr('data-id_umowy_bankowej', array[1]);
                $('#zakladki_tresc').data('id_umowy_bankowej', array[1]);

               wyswitl_powiadomienie('Dane zostały zapisane.', 1, 0);

                $('.str_2_b').hide();
       		$('.str_3_b').hide();
       		$('.str_4_b').hide();
       		$('.str_5_b').hide();
       		$('.str_6_b').show();
       		$('.str_7_b').hide();

            }).fail(function (ajaxContext) {
                document.getElementById("body_strona_r").innerHTML = ajaxContext.responseText;
            });
    });
}
function zapisz_strone_6_bank() {


    $('.zapisz_str_6_b').click(function () {
	
	var id_sprawy = $('#zakladki_tresc').data('id_sprawy');
             
	var czy_zlecono = ($('.czy_zlecono').hasClass('zaznaczone')) ? '1' : '0';
	var nazwa_pelnomocnika = $('.nazwa_pelnomocnika').val();
	var data_zlecenia = $('.data_zlecenia').val();
	var czy_wypowiedziano = ($('.wypowiedziono').hasClass('zaznaczone')) ? '1' : '0';
	var data_wypowiedzenia = $('.data_wypowiedzenia').val();
	var zgoda_na_inf_tak = ($('.inf_zgoda_tak').hasClass('zaznaczone')) ? '1' : '0';
	var zgoda_na_inf_nie = ($('.inf_zgoda_nie').hasClass('zaznaczone')) ? '1' : '0';	
	var sms = ($('.inf_sms').hasClass('zaznaczone')) ? '1' : '0';
	var email = ($('.inf_email').hasClass('zaznaczone')) ? '1' : '0';
	
         przelacz_str_6_b();

        $.ajax({
                method: "POST",
                url: "formularze_dokumenty/akcje/ajax_umowa_zapisz_do_bazy_str_6_bank",

                data: {

                    id_sprawy: id_sprawy,
                    czy_zlecono: czy_zlecono,
                    nazwa_pelnomocnika: nazwa_pelnomocnika,
                    data_zlecenia: data_zlecenia,
                    czy_wypowiedziano: czy_wypowiedziano,
                    data_wypowiedzenia: data_wypowiedzenia,
                    zgoda_na_inf_tak: zgoda_na_inf_tak,
                    zgoda_na_inf_nie: zgoda_na_inf_nie,
                    sms: sms,
                    email: email
                }
            })
            .done(function (data) {

                var array = $.parseJSON(data);

                $('#zakladki_tresc').attr('data-id_sprawy', array[0]);
                $('#zakladki_tresc').data('id_sprawy', array[0]);

               wyswitl_powiadomienie('Dane zostały zapisane.', 1, 0);

                $('.str_2_b').hide();
                $('.str_3_b').hide();
                $('.str_4_b').hide();
                $('.str_5_b').hide();
                $('.str_6_b').hide();
                $('.str_7_b').show();

            }).fail(function (ajaxContext) {
                document.getElementById("body_strona_r").innerHTML = ajaxContext.responseText;
            });
    });
}
function zapisz_strone_7_bank_edycja() {

    $('.zapisz_str_7_b_edycja').click(function () {

        var id_sprawy = $('#zakladki_tresc').data('id_sprawy');
        var id_klienta_1 = $('.kopiuj_adres_zleceniodawcy').data('id_odbiorcy');
        var id_umowy = $('.str_7_b').data('id_umowy');

        var przelew = ($('.przelew_bankowyy').hasClass('zaznaczone')) ? '1' : '0';
        var przekaz = ($('.przekaz_pocztowyy').hasClass('zaznaczone')) ? '1' : '0';

        var odbiorca = ($('.kopiuj_adres_zleceniodawcy_kratka').hasClass('zaznaczone')) ? '1' : '0';
        
        var prowizja = $('.prowizja_usl_bankowe').val();

        var rachunek_bankowy = $('.wynagrodzenie_nr_rachunku_bankowego').val();
        var imie_przelew = $('.imie_przelew').val();
        var nazwisko_przelew = $('.nazwisko_przelew').val();
        var ulica_przelew = $('.ulica_przelew').val();
        var dom_przelew = $('.dom_przelew').val();
        var mieszkanie_przelew = $('.mieszkanie_przelew').val();
        var kod_przelew = $('.kod_przelew').val();
        var miejscowosc_przelew = $('.miejscowosc_przelew').val();

        if (przelew == 1) {
            var forma_platnosci = 'przelew';
        } else if (przekaz == 1) {
            var forma_platnosci = 'przekaz';
        }

        generuj_umowe_pdf();

        $.ajax({
                method: "POST",
                url: "ajax/akcje/ajax_umowa_zapisz_do_bazy_wynagrodzenie_bank",

                data: {
                    id_sprawy: id_sprawy,
                    id_klienta_1: id_klienta_1,
                    forma_platnosci: forma_platnosci,
                    odbiorca: odbiorca,
                    prowizja: prowizja,
                    rachunek_bankowy: rachunek_bankowy,
                    id_umowy: id_umowy,
                    imie_przelew: imie_przelew,
                    nazwisko_przelew: nazwisko_przelew,
                    ulica_przelew: ulica_przelew,
                    dom_przelew: dom_przelew,
                    mieszkanie_przelew: mieszkanie_przelew,
                    kod_przelew: kod_przelew,
                    miejscowosc_przelew: miejscowosc_przelew,
                }
            })
            .done(function (data) {

                var array = $.parseJSON(data);

                $('#zakladki_tresc').attr('data-id_umowy', array[1]);
                $('#zakladki_tresc').data('id_umowy', array[1]);

                $('#zakladki_tresc').attr('data-id_sprawy', array[0]);
                $('#zakladki_tresc').data('id_sprawy', array[0]);

                wyswitl_powiadomienie('Dane zostały zapisane.', 1, 0);
                
                generuj_umowe_bankowa_pdf();

            }).fail(function (ajaxContext) {
                document.getElementById("body_strona_r").innerHTML = ajaxContext.responseText;
            });

    });
}

function zapisz_strone_7_bank() {

    $('.zapisz_str_7_b').click(function () {

        var id_sprawy = $('#zakladki_tresc').data('id_sprawy');
        var id_klienta_1 = $('#zakladki_tresc').data('id_klienta_1');
        var id_klienta_2 = $('#zakladki_tresc').data('id_klienta_2');

        var przelew = ($('.przelew_bankowy').hasClass('zaznaczone')) ? '1' : '0';
        var przekaz = ($('.przekaz_pocztowy').hasClass('zaznaczone')) ? '1' : '0';
        var odbiorca = ($('.zleceniodawca_odbiorca').hasClass('zaznaczone')) ? '1' : '0';

        var prowizja = $('.prowizja_usl_bankowe').val();
        var rachunek_bankowy = $('.wynagrodzenie_nr_rachunku_bankowego').val();
        var imie_przelew = $('.imie_przelew').val();
        var nazwisko_przelew = $('.nazwisko_przelew').val();
        var ulica_przelew = $('.ulica_przelew').val();
        var dom_przelew = $('.dom_przelew').val();
        var mieszkanie_przelew = $('.mieszkanie_przelew').val();
        var kod_przelew = $('.kod_przelew').val();
        var miejscowosc_przelew = $('.miejscowosc_przelew').val();

        var imie_przekaz = $('.imie_przekaz').val();
        var nazwisko_przekaz = $('.nazwisko_przekaz').val();
        var ulica_przekaz = $('.ulica_przekaz').val();
        var dom_przekaz = $('.dom_przekaz').val();
        var mieszkanie_przekaz = $('.mieszkanie_przekaz').val();
        var kod_przekaz = $('.kod_przekaz').val();
        var miejscowosc_przekaz = $('.miejscowosc_przekaz').val();

        if (przelew == 1) {
            var forma_platnosci = 'przelew';
        } else if (przekaz == 1) {
            var forma_platnosci = 'przekaz';
        }

        generuj_umowe_pdf();

        $.ajax({
            method: "POST",
            url: "formularze_dokumenty/akcje/ajax_umowa_zapisz_do_bazy_str_7_bank",

            data: {
                id_sprawy: id_sprawy,
                id_klienta_1: id_klienta_1,
                id_klienta_2: id_klienta_2,

                forma_platnosci: forma_platnosci,
                odbiorca: odbiorca,
                prowizja: prowizja,
                rachunek_bankowy: rachunek_bankowy,

                imie_przelew: imie_przelew,
                nazwisko_przelew: nazwisko_przelew,
                ulica_przelew: ulica_przelew,
                dom_przelew: dom_przelew,
                mieszkanie_przelew: mieszkanie_przelew,
                kod_przelew: kod_przelew,
                miejscowosc_przelew: miejscowosc_przelew,

                imie_przekaz: imie_przekaz,
                nazwisko_przekaz: nazwisko_przekaz,
                ulica_przekaz: ulica_przekaz,
                dom_przekaz: dom_przekaz,
                mieszkanie_przekaz: mieszkanie_przekaz,
                kod_przekaz: kod_przekaz,
                miejscowosc_przekaz: miejscowosc_przekaz
            }
        })
            .done(function (data) {

                var array = $.parseJSON(data);

                $('#zakladki_tresc').attr('data-id_umowy', array[1]);
                $('#zakladki_tresc').data('id_umowy', array[1]);

                $('#zakladki_tresc').attr('data-id_sprawy', array[0]);
                $('#zakladki_tresc').data('id_sprawy', array[0]);

                wyswitl_powiadomienie('Dane zostały zapisane.', 1, 0);

                generuj_umowe_bankowa_pdf();

            }).fail(function (ajaxContext) {
            document.getElementById("body_strona_r").innerHTML = ajaxContext.responseText;
        });

    });
}

function kopiuj_dane_zleceniodawcy() {
    $('.zleceniodawca_odbiorca').click(function () {
	
	var sprawa_id = $('#zakladki_tresc').data('id_sprawy');
        var id_klienta_1 = $('#zakladki_tresc').data('id_klienta_1');
        var id_klienta_2 = $('#zakladki_tresc').data('id_klienta_2');

	            $.ajax({
	                method: "POST",
	                url: 'ajax/akcje/ajax_sprawa_kopiuj_dane_zleceniodawcy',
	                data: {
	                    sprawa_id: sprawa_id,
	                    id_klienta_1: id_klienta_1,
	                    id_klienta_2: id_klienta_2
	                }
	            }).done(function (data) {
	                var array = $.parseJSON(data);

	                $('.imie_przekaz').val(array[0]);
	                $('.imie_przekaz').attr('value', array[0]);

	                $('.nazwisko_przekaz').val(array[1]);
	                $('.nazwisko_przekaz').attr('value', array[1]);

	                $('.ulica_przekaz').val(array[2]);
	                $('.ulica_przekaz').attr('value', array[2]);

	                $('.dom_przekaz').val(array[3]);
	                $('.dom_przekaz').attr('value', array[3]);

	                $('.mieszkanie_przekaz').val(array[4]);
	                $('.mieszkanie_przekaz').attr('value', array[4]);

	                $('.kod_przekaz').val(array[5]);
	                $('.kod_przekaz').attr('value', array[5]);

	                $('.miejscowosc_przekaz').val(array[6]);
	                $('.miejscowosc_przekaz').attr('value', array[6]);
	                
	                $('.nr_rachunku_bankowego').val(array[7]);
	                $('.nr_rachunku_bankowego').attr('value', array[7]);
	                
	                $('.imie_przelew').val(array[0]);
	                $('.imie_przelew').attr('value', array[0]);

	                $('.nazwisko_przelew').val(array[1]);
	                $('.nazwisko_przelew').attr('value', array[1]);

	                $('.ulica_przelew').val(array[2]);
	                $('.ulica_przelew').attr('value', array[2]);

	                $('.dom_przelew').val(array[3]);
	                $('.dom_przelew').attr('value', array[3]);

	                $('.mieszkanie_przelew').val(array[4]);
	                $('.mieszkanie_przelew').attr('value', array[4]);

	                $('.kod_przelew').val(array[5]);
	                $('.kod_przelew').attr('value', array[5]);

	                $('.miejscowosc_przelew').val(array[6]);
	                $('.miejscowosc_przelew').attr('value', array[6]);
	                
	                $('.nr_rachunku_przelew').val(array[7]);
	                $('.nr_rachunku_przelew').attr('value', array[7]);
	            });
    
    });
}

function umowa_bankowa () {
        uzupelnij_dane_klienta_na_podstawie_wybranego_z_listy_b1();
        uzupelnij_dane_klienta_na_podstawie_wybranego_z_listy_b2();
        strona_zleceniodawca_bank();
        zapisz_strone_zleceniodawcow();
        zapisz_strone_3_bank();
        zapisz_strone_4_bank();
        zapisz_strone_5_bank();
        zapisz_strone_6_bank();
        zapisz_strone_7_bank();
        zapisz_strone_7_bank_edycja();
        kopiuj_dane_zleceniodawcy();
    
    $('.szkoda .bank').click(function () {
	$('.umowa_bankowa').show();
        $(this).addClass('zaznaczone');
        $('.szkoda').find('.smierc').removeClass('zaznaczone');
        $('.szkoda').find('.obrazenia').removeClass('zaznaczone');
        $('.rodzaj_wypadku').slideUp();
        $('.inne_szkody').slideUp();
        $('#zapisz_strone_1').attr('style', 'display:block;');
        
        umowa_bankowa_akcje_js();
        
        $('.mop').hide();
        $('.b').show();

      
        /*KaMyK 2016-08-08*/
        if ($('#zakladki_tresc').hasClass('umowa_do_edycji')) {
            var komorka = $(this).data('komorka');
            var wartosc = $(this).data('wartosc');
            var id = $('#zakladki_tresc').data('id_sprawy');
            kratka_zapisz_zmiane('sprawa', id, komorka, wartosc);
        }

        var typ_szkody = '3';
        
        $.ajax({
                method: "POST",
                url: "formularze_dokumenty/akcje/ajax_umowa_zapisz_do_bazy_str_1_bank",

                data: {
                    typ_szkody: typ_szkody,
                }
            })
            .done(function (data) {
        	
        	przelacz_str_1_b();

                var array = $.parseJSON(data);

                $('#zakladki_tresc').attr('data-id_sprawy', array[0]);
                $('#zakladki_tresc').data('id_sprawy', array[0]);
                $('#zakladki_tresc').attr('data-typ_szkody', array[2]);
                $('#zakladki_tresc').data('typ_szkody', array[2]);

                wyswitl_powiadomienie('Dane zostały zapisane.', 1, 0);

            }).fail(function (ajaxContext) {
                document.getElementById("body_strona_r").innerHTML = ajaxContext.responseText;
            });
    
    });  
    
}
function umowa_bankowa_akcje_js() {

    $('.zlecono_zwrot_tak').click(function () {
	$('.zlecono_zwrot_nie').removeClass('zaznaczone');
	$('.opcje_przy_zgloszeniu').slideDown();
    });
    $('.zlecono_zwrot_nie').click(function () {
	$('.zlecono_zwrot_tak').removeClass('zaznaczone');
	$('.nadplacone_raty').removeClass('zaznaczone');
	$('.oplaty_ubep_pom').removeClass('zaznaczone');
	$('.oplaty_ubezp_wkl_wl').removeClass('zaznaczone');
	$('.opcje_przy_zgloszeniu').slideUp();
	$('.data_wk_wl').val('');
	$('.data_ub_pom').val('');
    });
    
    $('.czy_zlecono').click(function () {
	if ($('.czy_zlecono').hasClass('zaznaczone')) {
	    $('.dane_o_wypowiedzeniu').slideDown();
	} else {
	    $('.dane_o_wypowiedzeniu').slideUp();
	    $('.wypowiedziono').removeClass('zaznaczone');
	    $('.data_zlecenia').val('');
	    $('.data_wypowiedzenia').val('');
	}
    });
    
    $('.wypowiedziono').click(function () {
	if (!$('.wypowiedziono').hasClass('zaznaczone')) {
	    $('.data_wypowiedzenia').val('');
	} 
    });
    
    $('.inf_zgoda_nie').click(function () {
	if ($('.inf_zgoda_nie').hasClass('zaznaczone')) {
	    $('.inf_sms').removeClass('zaznaczone');
	    $('.inf_email').removeClass('zaznaczone');
	    $('.inf_zgoda_tak').removeClass('zaznaczone');
	}
    });
    $('.inf_zgoda_tak').click(function () {
	    $('.inf_zgoda_nie').removeClass('zaznaczone');
    });
}

function generuj_umowe_bankowa_pdf() {

        var id_sprawy = $('#zakladki_tresc').data('id_sprawy');
        var id_umowy = $('#zakladki_tresc').data('id_umowy');
        var id_uprawnionego = $('#zakladki_tresc').data('id_uprawniony');
        var potwierdzenie = $(this).data('potwierdzenie');

        if (id_sprawy == '' || id_sprawy == undefined) {
            id_sprawy = $(this).data('id_sprawy');
            id_umowy = $(this).data('id_umowa');
            id_uprawnionego = $(this).data('id_uprawniony');
        }

        wyswietl_loader('Trwa generowanie PDF. Prosze czekać!!!');

        $.ajax({
            method: "POST",
            url: "ajax/akcje/ajax_generuj_umowe",
            data: {
                id_sprawy: id_sprawy,
                id_umowy: id_umowy,
                id_uprawnionego: id_uprawnionego,
                potwierdzenie: potwierdzenie

            }
        }).done(function (data) {
            var array = $.parseJSON(data);

            ukryj_loader();

            if (array[0] === '0') {
                wyswitl_powiadomienie('Brak szablonu!!!', 0, 0);
                return false;
            } else {

                var downloadLink = document.createElement("a");

                downloadLink.href = 'wyswietl_pdf?id_sprawy=' + id_sprawy + '&umowa=1' + '&potwierdzenie=' + potwierdzenie;

                window.open(downloadLink.href);
            }

            zeruj_licznik_sesji_po_wykonaniu_funkcji();

        }).fail(function (ajaxContext) {
            document.getElementById("body_strona_r").innerHTML = ajaxContext.responseText;
        });
}
