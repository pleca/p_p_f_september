
function dokument() {
    $('#dokument').click(function () {
        $(document).find('.element_do_wyboru').removeClass('aktywny');

        dokument_z();

    });
}

function dokument_z() {

    $('#dokument').addClass('aktywny');

    $.ajax({
            method: "POST",
            url: "ajax/ajax_dokument",
        })
        .done(function (html) {
            document.getElementById("body_strona_r").innerHTML = html;

            lista_dokumentow();
            dodaj_umowe();
            oswiadczenie_o_dojazdach_formularz();
            zgloszenie_szkody_formularz();

            $('.rozwin_dokumenty').click(function () {


                if ($(this).parent().parent().hasClass('aktywna')) {
                    $('.tabelka_wiersz_opcje').slideUp();
                    $('.tabelka_wiersz').removeClass('aktywna');
                } else {
                    $('.tabelka_wiersz_opcje').slideUp();
                    $('.tabelka_wiersz').removeClass('aktywna');
                    $(this).parent().next().next().slideDown();
                    $(this).parent().parent().addClass('aktywna');
                }
            });

            generuj_zgloszenie_pdf();
            generuj_potwierdzenie_umowy_pdf();
            generuj_oswiadczenie_o_dojazdach();
            generuj_zgloszenie_szkody_pdf();
            edytuj_dokument_umowa();


        }).fail(function (ajaxContext) {
            document.getElementById("body_strona_r").innerHTML = ajaxContext.responseText;
        });

}



//funkcja, która wczyta nowy widok do pola z lista klienta
function lista_klientow() {
    $('.lista_klientow').click(function () {
        $('.zakladki_element').removeClass('aktywna');
        $(this).addClass('aktywna');
        $.ajax({
                method: "POST",
                url: "ajax/ajax_lista_klientow",
            })
            .done(function (html) {
                document.getElementById("zakladki_tresc").innerHTML = html;

                edytuj_klienta();
                zeruj_licznik_sesji_po_wykonaniu_funkcji();
            }).fail(function (ajaxContext) {
                document.getElementById("body_strona_r").innerHTML = ajaxContext.responseText;
            });
    });
}


function lista_dokumentow() {
    $('.lista_umow').click(function () {
        $('.zakladki_element').removeClass('aktywna');
        $(this).addClass('aktywna');
        $.ajax({
                method: "POST",
                url: "ajax/ajax_lista_dokumentow",
            })
            .done(function (html) {
                document.getElementById("zakladki_tresc").innerHTML = html;

                $('.rozwin_dokumenty').click(function () {


                    if ($(this).parent().parent().hasClass('aktywna')) {
                        $('.tabelka_wiersz_opcje').slideUp();
                        $('.tabelka_wiersz').removeClass('aktywna');
                    } else {
                        $('.tabelka_wiersz_opcje').slideUp();
                        $('.tabelka_wiersz').removeClass('aktywna');
                        $(this).parent().next().next().slideDown();
                        $(this).parent().parent().addClass('aktywna');
                    }
                });

                generuj_zgloszenie_pdf();
                generuj_potwierdzenie_umowy_pdf();
                generuj_oswiadczenie_o_dojazdach();
                generuj_zgloszenie_szkody_pdf();

                edytuj_dokument_umowa();

            }).fail(function (ajaxContext) {
                document.getElementById("body_strona_r").innerHTML = ajaxContext.responseText;
            });
    });
}

function wyczysc_pola_input() {
    $('.wynagrodzenie').find('.wynagrodzenie_zleceniodawca_imie').removeAttr('value');
    $('.wynagrodzenie').find('.wynagrodzenie_zleceniodawca_nazwisko').removeAttr('value');
    $('.wynagrodzenie').find('.wynagrodzenie_zleceniodawca_ulica').removeAttr('value');
    $('.wynagrodzenie').find('.wynagrodzenie_zleceniodawca_nr_domu').removeAttr('value');
    $('.wynagrodzenie').find('.wynagrodzenie_zleceniodawca_nr_mieszkania').removeAttr('value');
    $('.wynagrodzenie').find('.wynagrodzenie_zleceniodawca_kod_pocztowy').removeAttr('value');
    $('.wynagrodzenie').find('.wynagrodzenie_zleceniodawca_miejscowosc').removeAttr('value');

    $('.wynagrodzenie').find('.wynagrodzenie_zleceniodawca_imie').val('');
    $('.wynagrodzenie').find('.wynagrodzenie_zleceniodawca_nazwisko').val('');
    $('.wynagrodzenie').find('.wynagrodzenie_zleceniodawca_ulica').val('');
    $('.wynagrodzenie').find('.wynagrodzenie_zleceniodawca_nr_domu').val('');
    $('.wynagrodzenie').find('.wynagrodzenie_zleceniodawca_nr_mieszkania').val('');
    $('.wynagrodzenie').find('.wynagrodzenie_zleceniodawca_kod_pocztowy').val('');
    $('.wynagrodzenie').find('.wynagrodzenie_zleceniodawca_miejscowosc').val('');

    $('.wynagrodzenie').find('.wynagrodzenie_zleceniodawca_kod_pocztowy').removeClass('kod_poprawny');
    $('.wynagrodzenie').find('.wynagrodzenie_zleceniodawca_kod_pocztowy').removeClass('kod_niepoprawny');
    $('.wynagrodzenie').find('.wynagrodzenie_zleceniodawca_kod_pocztowy').parent('div').removeClass('poprawna');
    $('.wynagrodzenie').find('.wynagrodzenie_zleceniodawca_kod_pocztowy').parent('div').removeClass('blad');
}

function wyczysc_pola_input_dzialajacy_w_imieniu() {
    $('.dzialajacy_w_imieniu_dane').find('input').removeAttr('value');
    $('.dzialajacy_w_imieniu_dane').find('input').val('');

    $('.dzialajacy_w_imieniu_dane').find('.dowod_poprawny').removeClass('dowod_poprawny');
    $('.dzialajacy_w_imieniu_dane').find('.dowod_niepoprawny').removeClass('dowod_niepoprawny');

    $('.dzialajacy_w_imieniu_dane').find('.pesel_poprawny').removeClass('pesel_poprawny');
    $('.dzialajacy_w_imieniu_dane').find('.pesel_niepoprawny').removeClass('pesel_niepoprawny');

    $('.dzialajacy_w_imieniu_dane').find('.kod_poprawny').removeClass('kod_poprawny');
    $('.dzialajacy_w_imieniu_dane').find('.kod_niepoprawny').removeClass('kod_niepoprawny');

    $('.dzialajacy_w_imieniu_dane').find('.poprawna').removeClass('poprawna');
    $('.dzialajacy_w_imieniu_dane').find('.blad').removeClass('blad');
}

function kopiuj_adres_zleceniodawcy() {
    var zleceniodawca_imie = $('.zleceniodawca_formularz').find('.zleceniodawca_imie').val();
    var zleceniodawca_nazwisko = $('.zleceniodawca_formularz').find('.zleceniodawca_nazwisko').val();
    var zleceniodawca_ulica = $('.zleceniodawca_formularz').find('.zleceniodawca_ulica').val();
    var zleceniodawca_nr_domu = $('.zleceniodawca_formularz').find('.zleceniodawca_nr_domu').val();
    var zleceniodawca_nr_mieszkania = $('.zleceniodawca_formularz').find('.zleceniodawca_nr_mieszkania').val();
    var zleceniodawca_kod_pocztowy = $('.zleceniodawca_formularz').find('.zleceniodawca_kod_pocztowy').val();
    var zleceniodawca_miejscowosc = $('.zleceniodawca_formularz').find('.zleceniodawca_miejscowosc').val();

    if (zleceniodawca_imie != '') {
        $('.wynagrodzenie').find('.wynagrodzenie_zleceniodawca_imie').val(zleceniodawca_imie);
        $('.wynagrodzenie').find('.wynagrodzenie_zleceniodawca_imie').attr('value', zleceniodawca_imie);
    }
    if (zleceniodawca_nazwisko != '') {
        $('.wynagrodzenie').find('.wynagrodzenie_zleceniodawca_nazwisko').val(zleceniodawca_nazwisko);
        $('.wynagrodzenie').find('.wynagrodzenie_zleceniodawca_nazwisko').attr('value', zleceniodawca_nazwisko);
    }
    if (zleceniodawca_ulica != '') {
        $('.wynagrodzenie').find('.wynagrodzenie_zleceniodawca_ulica').val(zleceniodawca_ulica);
        $('.wynagrodzenie').find('.wynagrodzenie_zleceniodawca_ulica').attr('value', zleceniodawca_ulica);
    }
    if (zleceniodawca_nr_domu != '') {
        $('.wynagrodzenie').find('.wynagrodzenie_zleceniodawca_nr_domu').val(zleceniodawca_nr_domu);
        $('.wynagrodzenie').find('.wynagrodzenie_zleceniodawca_nr_domu').attr('value', zleceniodawca_nr_domu);
    }
    if (zleceniodawca_nr_mieszkania != '') {
        $('.wynagrodzenie').find('.wynagrodzenie_zleceniodawca_nr_mieszkania').val(zleceniodawca_nr_mieszkania);
        $('.wynagrodzenie').find('.wynagrodzenie_zleceniodawca_nr_mieszkania').attr('value', zleceniodawca_nr_mieszkania);
    }
    if (zleceniodawca_kod_pocztowy != '') {
        $('.wynagrodzenie').find('.wynagrodzenie_zleceniodawca_kod_pocztowy').val(zleceniodawca_kod_pocztowy);
        $('.wynagrodzenie').find('.wynagrodzenie_zleceniodawca_kod_pocztowy').attr('value', zleceniodawca_kod_pocztowy);

        if ($('.zleceniodawca_formularz').find('.zleceniodawca_kod_pocztowy').hasClass('kod_niepoprawny')) {
            $('.wynagrodzenie').find('.wynagrodzenie_zleceniodawca_kod_pocztowy').addClass('kod_niepoprawny');
            $('.wynagrodzenie').find('.wynagrodzenie_zleceniodawca_kod_pocztowy').parent('div').addClass('blad');
        }
        if ($('.zleceniodawca_formularz').find('.zleceniodawca_kod_pocztowy').hasClass('kod_poprawny')) {
            $('.wynagrodzenie').find('.wynagrodzenie_zleceniodawca_kod_pocztowy').addClass('kod_poprawny');
            $('.wynagrodzenie').find('.wynagrodzenie_zleceniodawca_kod_pocztowy').parent('div').addClass('poprawna');
        }

    }
    if (zleceniodawca_miejscowosc != '') {
        $('.wynagrodzenie').find('.wynagrodzenie_zleceniodawca_miejscowosc').val(zleceniodawca_miejscowosc);
        $('.wynagrodzenie').find('.wynagrodzenie_zleceniodawca_miejscowosc').attr('value', zleceniodawca_miejscowosc);
    }
};

function klient_dodaj_nowy() {
    var zleceniodawca_imie = $('.zleceniodawca_imie').val();
    var zleceniodawca_nazwisko = $('.zleceniodawca_nazwisko').val();
    var zleceniodawca_nr_domu = $('.zleceniodawca_nr_domu').val();
    var zleceniodawca_nr_mieszkania = $('.zleceniodawca_nr_mieszkania').val();
    var zleceniodawca_kod_pocztowy = $('.zleceniodawca_kod_pocztowy').val();
    var zleceniodawca_miejscowosc = $('.zleceniodawca_miejscowosc').val();
    var zleceniodawca_pesel = $('.zleceniodawca_pesel').val();
    var zleceniodawca_seria_i_numer_dowodu = $('.zleceniodawca_seria_i_numer_dowodu').val();
    var zleceniodawca_email = $('.zleceniodawca_email').val();
    var zleceniodawca_telefon = $('.zleceniodawca_telefon').val();
    var zleceniodawca_ulica = $('.zleceniodawca_ulica').val();


    if (zleceniodawca_imie == '' || zleceniodawca_nazwisko == '' || zleceniodawca_nr_domu == '' ||
        zleceniodawca_nr_mieszkania == '' || zleceniodawca_kod_pocztowy == '' || zleceniodawca_miejscowosc == '' ||
        zleceniodawca_pesel == '' || zleceniodawca_seria_i_numer_dowodu == '' || zleceniodawca_email == '' ||
        zleceniodawca_telefon == '' || zleceniodawca_ulica == '') {

        wyswitl_powiadomienie('Uzupełnij wszystkie pola!!!', 0, 0);
        return false;
    } else {

        if ($('.pesel').hasClass('pesel_niepoprawny') ||
            $('.numer_dowodu').hasClass('dowod_niepoprawny') ||
            $('.kod_pocztowy').hasClass('kod_niepoprawny')) {

            wyswitl_powiadomienie('Popraw błędy w formularzu!!!', 0, 0);
            return false;
        } else {
            $.ajax({
                method: "POST",
                data: {
                    zleceniodawca_imie: zleceniodawca_imie,
                    zleceniodawca_nazwisko: zleceniodawca_nazwisko,
                    zleceniodawca_nr_domu: zleceniodawca_nr_domu,
                    zleceniodawca_nr_mieszkania: zleceniodawca_nr_mieszkania,
                    zleceniodawca_kod_pocztowy: zleceniodawca_kod_pocztowy,
                    zleceniodawca_miejscowosc: zleceniodawca_miejscowosc,
                    zleceniodawca_pesel: zleceniodawca_pesel,
                    zleceniodawca_seria_i_numer_dowodu: zleceniodawca_seria_i_numer_dowodu,
                    zleceniodawca_email: zleceniodawca_email,
                    zleceniodawca_telefon: zleceniodawca_telefon,
                    zleceniodawca_ulica: zleceniodawca_ulica
                },
                url: "ajax/akcje/ajax_dodaj_klienta_do_bazy",
            }).done(function (data) {
                var array = $.parseJSON(data);

                if (array[0] === '0') {
                    wyswitl_powiadomienie('Uzupełnij wszystkie pola!!!', 0, 0);
                    return false;
                } else {
                    wyswitl_powiadomienie('Klient został dodany!!!', 1, 0);
                    $('.zakladki_element').removeClass('aktywna');
                    $('.lista_klientow').addClass('aktywna');
                    $.ajax({
                            method: "POST",
                            url: "ajax/ajax_lista_klientow",
                        })
                        .done(function (html) {
                            document.getElementById("zakladki_tresc").innerHTML = html;

                            edytuj_klienta();

                        }).fail(function (ajaxContext) {
                            document.getElementById("body_strona_r").innerHTML = ajaxContext.responseText;
                        });

                }

            }).fail(function (ajaxContext) {
                document.getElementById("body_strona_r").innerHTML = ajaxContext.responseText;
            });
        }

    }

}

function zgoda_na_pcrf() {
    $('.zgoda_pcrf .kratka').click(function () {
        if ($(this).hasClass('zaznaczone')) {
            $(this).removeClass('zaznaczone');
        } else {
            $(this).addClass('zaznaczone');
        }
    });
}

function zgloszenie_szkody_formularz() {
    $('#dodaj_szkode').click(function () {

        $('.zakladki_element').removeClass('aktywna');
        $(this).addClass('aktywna');

        var id_klienta = $('#id_klienta').data('id_klienta');

        $.ajax({
                method: "POST",
                url: "formularze_dokumenty/widoki/ajax_zgloszenie_szkody",
                data: {
                    id_klienta: id_klienta
                }
            })
            .done(function (html) {
                document.getElementById("zakladki_tresc").innerHTML = html;

                $('input').keyup(function () {
                    var wartosc = $(this).val();

                    $(this).attr('value', wartosc);
                });

                $('.data').datetimepicker({
                    viewMode: 'years',
                    format: 'YYYY-MM-DD'
                });

                zgloszenie_szkody_zapisz_do_bazy();
                zgloszenie_szkody_zapisz_do_bazy_str_2();
                zgloszenie_szkody_zapisz_do_bazy_str_3();
                zgloszenie_szkody_zapisz_do_bazy_str_4();
                zgloszenie_szkody_zapisz_do_bazy_str_5();
                zgloszenie_szkody_zapisz_do_bazy_str_6();
                uzupelnij_dane_umowy_z_poszkodowanym_na_podstawie_wybranej_z_listy();
                adres_do_korespondencji();
                poszkodowany_klient();
                poszkodowany_klient_dzialajacy_w_imieniu();
                poszkodowany_inny();
                uprawniony_formularz();
                uprawniony_do_informacji_formularz();
                pojazd_a_k_b_k();
                pojazd_b_k();
                pojazd_c_k();
                aktywuj_strone_zgloszenia();
                rozwin_tresc_naglowka();
                zaznaczanie_odznaczanie_kratka();
                walidacja_formularza_szkody_rzeczowe();
            }).fail(function (ajaxContext) {
                document.getElementById("body_strona_r").innerHTML = ajaxContext.responseText;
            });
    });

}

function walidacja_formularza_szkody_rzeczowe() {
    $('.ok_sprawca_napisal_oswiadczenie').click(function () {
        if (!$(this).hasClass('zaznaczone')) {
            $('.ok_sno_wezwano_policje_o').hide();
            $('.ok_sno_nie_wezwano_policji_o').hide();
        } else {
            $('.ok_sno_wezwano_policje_o').show();
            $('.ok_sno_nie_wezwano_policji_o').show();
        }
    });
    $('.ok_sno_wezwano_policje').click(function () {
        if ($(this).hasClass('zaznaczone')) {
            $('.ok_sno_nie_wezwano_policji_o').hide();
        } else {
            $('.ok_sno_nie_wezwano_policji_o').show();
        }
    });
    $('.ok_sno_nie_wezwano_policji').click(function () {
        if ($(this).hasClass('zaznaczone')) {
            $('.ok_sno_wezwano_policje_o').hide();
        } else {
            $('.ok_sno_wezwano_policje_o').show();
        }
    });
    $('.ok_wezwano_policje').click(function () {
        if (!$(this).hasClass('zaznaczone')) {
            $('.ok_wp_miejsce').hide();
        } else {
            $('.ok_wp_miejsce').show();
        }
    });
    $('.ok_postawiono_sprawcy_zarzut').click(function () {
        if (!$(this).hasClass('zaznaczone')) {
            $('.ok_psz_artykul').hide();
            $('.ok_psz_kk_o').hide();
            $('.ok_psz_kw_o').hide();
        } else {
            $('.ok_psz_artykul').show();
            $('.ok_psz_kk_o').show();
            $('.ok_psz_kw_o').show();
        }
    });
    $('.ok_psz_kk').click(function () {
        if ($(this).hasClass('zaznaczone')) {
            $('.ok_psz_kw_o').hide();
        } else {
            $('.ok_psz_kw_o').show();
        }
    });
    $('.ok_psz_kw').click(function () {
        if ($(this).hasClass('zaznaczone')) {
            $('.ok_psz_kk_o').hide();
        } else {
            $('.ok_psz_kk_o').show();
        }
    });
    $('.ok_postepowanie_karne_umorzono').click(function () {
        if (!$(this).hasClass('zaznaczone')) {
            $('.ok_pku_artykul').hide();
            $('.ok_pku_kpk_o').hide();
            $('.ok_pku_kpw_o').hide();
        } else {
            $('.ok_pku_artykul').show();
            $('.ok_pku_kpk_o').show();
            $('.ok_pku_kpw_o').show();
        }
    });
    $('.ok_pku_kpk').click(function () {
        if ($(this).hasClass('zaznaczone')) {
            $('.ok_pku_kpw_o').hide();
        } else {
            $('.ok_pku_kpw_o').show();
        }
    });
    $('.ok_pku_kpw').click(function () {
        if ($(this).hasClass('zaznaczone')) {
            $('.ok_pku_kpk_o').hide();
        } else {
            $('.ok_pku_kpk_o').show();
        }
    });
    $('.ok_skierowano_akt_do_sadu').click(function () {
        if (!$(this).hasClass('zaznaczone')) {
            $('.ok_sads_pelna_nazwa_sadu').hide();
        } else {
            $('.ok_sads_pelna_nazwa_sadu').show();
        }
    });
    $('.ok_zapadl_wyrok').click(function () {
        if (!$(this).hasClass('zaznaczone')) {
            $('.ok_zw_skazujacy_o').hide();
            $('.ok_zw_uniewinniajacy_o').hide();
        } else {
            $('.ok_zw_skazujacy_o').show();
            $('.ok_zw_uniewinniajacy_o').show();
        }
    });
    $('.ok_zw_skazujacy').click(function () {
        $('.ok_zw_kk').removeClass('zaznaczone');
        $('.ok_zw_kw').removeClass('zaznaczone');
        if ($(this).hasClass('zaznaczone')) {
            $('.ok_zw_uniewinniajacy_o').hide();
            $('.ok_zw_u_artykul').show();
            $('.ok_zw_kk_o').show();
            $('.ok_zw_kw_o').show();
        } else {
            $('.ok_zw_uniewinniajacy_o').show();
            $('.ok_zw_u_artykul').hide();
            $('.ok_zw_kk_o').hide();
            $('.ok_zw_kw_o').hide();
        }
    });
    $('.ok_zw_uniewinniajacy').click(function () {
        $('.ok_zw_kk').removeClass('zaznaczone');
        $('.ok_zw_kw').removeClass('zaznaczone');
        if ($(this).hasClass('zaznaczone')) {
            $('.ok_zw_skazujacy_o').hide();
            $('.ok_zw_u_artykul').show();
            $('.ok_zw_kk_o').show();
            $('.ok_zw_kw_o').show();

        } else {
            $('.ok_zw_skazujacy_o').show();
            $('.ok_zw_u_artykul').hide();
            $('.ok_zw_kk_o').hide();
            $('.ok_zw_kw_o').hide();
        }
    });
    $('.ok_zw_kk').click(function () {
        if ($(this).hasClass('zaznaczone')) {
            $('.ok_zw_kw_o').hide();
        } else {
            $('.ok_zw_kw_o').show();
        }
    });
    $('.ok_zw_kw').click(function () {
        if ($(this).hasClass('zaznaczone')) {
            $('.ok_zw_kk_o').hide();
        } else {
            $('.ok_zw_kk_o').show();
        }
    });

    wyswietl_jedno_ukryte_pole('oc_zgloszono_szp', 'oc_zgloszono_szp_data');
    ukryj_jedno_pole('oc_zgloszono_szp', 'oc_nie_zgloszono_szp_o');
    ukryj_jedno_pole('oc_nie_zgloszono_szp', 'oc_zgloszono_szp_o');

    wyswietl_jedno_ukryte_pole('oc_zgloszono_szo', 'oc_zgloszono_szo_data');
    ukryj_jedno_pole('oc_zgloszono_szo', 'oc_nie_zgloszono_szo_o');
    ukryj_jedno_pole('oc_nie_zgloszono_szo', 'oc_zgloszono_szo_o');

    ukryj_jedno_z_dwoch('oc_odszkodowanie_oc_p_nie_wyplacono', 'oc_odszkodowanie_oc_p_wyplacono_o');
    ukryj_jedno_z_dwoch('oc_odszkodowanie_oc_p_wyplacono', 'oc_odszkodowanie_oc_p_nie_wyplacono_o');

    $('.oc_wyplacono_szo').click(function () {
        if (!$(this).hasClass('zaznaczone')) {
            $('.oc_wyplacono_szo_kwota').hide();
            $('.oc_wyplacono_szo_kwota').val('');
            $('.oc_wyplacono_szo_kwota').removeAttr('value');
            $('.oc_wyplacono_szo_o').hide();
            $('.on_wyplacono_szo_data').val('');
            $('.on_wyplacono_szo_data').removeAttr('value');
            $('.on_wyplacono_szo_ugoda').removeClass('zaznaczone');
            $('.on_wyplacono_szo_wyrok').removeClass('zaznaczone');
            $('.on_wyplacono_szo_decyzja_zd').removeClass('zaznaczone');
        } else {
            $('.oc_wyplacono_szo_kwota').show();
            $('.oc_wyplacono_szo_o').show();
            $('.on_wyplacono_szo_ugoda_o').show();
            $('.on_wyplacono_szo_wyrok_o').show();
            $('.on_wyplacono_szo_decyzja_zd_o').show();

        }
    });

    ukryj_dwa_pola_z_trzech('on_wyplacono_szo_ugoda', 'on_wyplacono_szo_wyrok', 'on_wyplacono_szo_decyzja_zd');
    ukryj_dwa_pola_z_trzech('on_wyplacono_szo_wyrok', 'on_wyplacono_szo_ugoda', 'on_wyplacono_szo_decyzja_zd');
    ukryj_dwa_pola_z_trzech('on_wyplacono_szo_decyzja_zd', 'on_wyplacono_szo_wyrok', 'on_wyplacono_szo_ugoda');

    wyswietl_jedno_ukryte_pole('io_zgloszono_nnw', 'io_zgloszono_nnw_nazwa');
    wyswietl_jedno_ukryte_pole('io_zgloszono_nnw_uszczerbek', 'io_zgloszono_nnw_uczerbek_procent');

    ukryj_jedno_z_dwoch('io_wypadek_przy_pracy', 'io_wypadek_w_drodze_do_pracy_o');
    ukryj_jedno_z_dwoch('io_wypadek_w_drodze_do_pracy', 'io_wypadek_przy_pracy_o');


    $('.io_wypadek_zgloszono').click(function () {
        if (!$(this).hasClass('zaznaczone')) {
            $('.io_wypadek_zgloszono_o').hide();
            $('.io_wypadek_zgloszono_zus').removeClass('zaznaczone');
            $('.io_wypadek_zgloszono_krus').removeClass('zaznaczone');
            $('.io_wypadek_zgloszono_inne').removeClass('zaznaczone');
            $('.io_wypadek_zgloszono_inne_nazwa').val('');
            $('.io_wypadek_zgloszono_inne_nazwa').removeAttr('value');
            $('.io_wypadek_zgloszono_uszczerbek_procent').val('');
            $('.io_wypadek_zgloszono_uszczerbek_procent').removeAttr('value');
        } else {
            $('.io_wypadek_zgloszono_o').show();
        }
    });
    ukryj_dwa_pola_z_trzech('io_wypadek_zgloszono_zus', 'io_wypadek_zgloszono_krus', 'io_wypadek_zgloszono_inne');
    ukryj_dwa_pola_z_trzech('io_wypadek_zgloszono_krus', 'io_wypadek_zgloszono_zus', 'io_wypadek_zgloszono_inne');
    ukryj_dwa_pola_z_trzech('io_wypadek_zgloszono_inne', 'io_wypadek_zgloszono_krus', 'io_wypadek_zgloszono_zus');

    wyswietl_jedno_ukryte_pole_czysc_input('io_przyznano_jozwpp', 'io_przyznano_jozwpp_kwota');
    wyswietl_jedno_ukryte_pole_czysc_input('io_zwolnienie_lekarskie', 'io_zwolnienie_lekarskie_o');

    $('.io_orzeczenie_o_niezdolnosci').click(function () {
        if (!$(this).hasClass('zaznaczone')) {
            $('.io_orzeczenie_o_niezdolnosci_o').hide();
            $('.io_orzeczenie_on_okresowej_o_o').hide();
            $('.io_orzeczenie_on_okresowej_o_o').val('');
            $('.io_orzeczenie_on_okresowej_o_o').removeAttr('value');
            $('.io_orzeczenie_o_niezdolnosci_o .kratka_2').removeClass('zaznaczone');
        } else {
            $('.io_orzeczenie_o_niezdolnosci_o').show();
        }
    });

    ukryj_pozostale_pola_czysc_input_i_kratki('io_orzenie_on_calkowite');
    ukryj_pozostale_pola_czysc_input_i_kratki('io_orzeczenie_on_czesciowe');
    ukryj_pozostale_pola_czysc_input_i_kratki('io_orzeczenie_on_trwalej');
    ukryj_pozostale_pola_czysc_input_i_kratki('io_orzeczenie_on_okresowej');

    wyswietl_jedno_ukryte_pole_czysc_input('io_orzeczenie_on_okresowej', 'io_orzeczenie_on_okresowej_data_do');

    ukryj_dwa_pola_z_trzech('io_przyznal_rente_zus', 'io_przyznal_rente_krus', 'io_przyznal_rente_inne');
    ukryj_dwa_pola_z_trzech('io_przyznal_rente_krus', 'io_przyznal_rente_zus', 'io_przyznal_rente_inne');
    ukryj_dwa_pola_z_trzech('io_przyznal_rente_inne', 'io_przyznal_rente_krus', 'io_przyznal_rente_zus');

    wyswietl_jedno_ukryte_pole_czysc_input('io_przyznal_rente_inne', 'io_przyznal_rente_inne_nazwa');

    wyswietl_jedno_ukryte_pole_czysc_input('io_przyznal_rente_zus', 'io_przyznal_rente_o');
    wyswietl_jedno_ukryte_pole_czysc_input('io_przyznal_rente_krus', 'io_przyznal_rente_o');
    wyswietl_jedno_ukryte_pole_czysc_input('io_przyznal_rente_inne', 'io_przyznal_rente_o');

    wyswietl_jedno_ukryte_pole_czysc_input('pl_wezwano_pogotowie', 'pl_wp_miejscowosc_szpital');
    wyswietl_jedno_ukryte_pole_czysc_input('pl_pspdl', 'pl_pspdl_o');

    wyswietl_jedno_ukryte_pole_czysc_input('pl_pbh', 'pl_pbh_o');
    wyswietl_jedno_ukryte_pole_czysc_input('pl_pzo', 'pl_pzo_o');

    ukryj_jedno_z_dwoch('dr_nie_zlecano_innym', 'dr_zlecono_sprawe_o');
    ukryj_jedno_z_dwoch('dr_zlecono_sprawe', 'dr_nie_zlecano_innym_o');

    wyswietl_jedno_ukryte_pole_czysc_input('dr_zlecono_sprawe', 'dr_zlecono_sprawe_o_o');
    wyswietl_jedno_ukryte_pole_czysc_input('dr_zs_wypowiedziano_umowe_opcja', 'dr_zs_wypowiedziano_umowe_data');

    ukryj_dwa_pola_z_trzech('dr_s_do_a_obcy', 'dr_s_do_a_rodzina', 'dr_s_do_a_inny');
    ukryj_dwa_pola_z_trzech('dr_s_do_a_rodzina', 'dr_s_do_a_obcy', 'dr_s_do_a_inny');
    ukryj_dwa_pola_z_trzech('dr_s_do_a_inny', 'dr_s_do_a_rodzina', 'dr_s_do_a_obcy');

    wyswietl_jedno_ukryte_pole_czysc_input('dr_s_do_a_inny', 'dr_s_do_a_inny_o_o');

    ukryj_dwa_pola_z_trzech('dr_s_do_b_obcy', 'dr_s_do_b_rodzina', 'dr_s_do_b_inny');
    ukryj_dwa_pola_z_trzech('dr_s_do_b_rodzina', 'dr_s_do_b_obcy', 'dr_s_do_b_inny');
    ukryj_dwa_pola_z_trzech('dr_s_do_b_inny', 'dr_s_do_b_rodzina', 'dr_s_do_b_obcy');

    wyswietl_jedno_ukryte_pole_czysc_input('dr_s_do_b_inny', 'dr_s_do_b_inny_o_o');

    ukryj_jedno_z_dwoch('dr_ub_ufg_tak', 'dr_ub_ufg_nie_o');
    ukryj_jedno_z_dwoch('dr_ub_ufg_nie', 'dr_ub_ufg_tak_o');

    ukryj_jedno_z_dwoch('dokument_polski', 'dokument_obcokrajowca');
    ukryj_jedno_z_dwoch('dokument_obcokrajowca', 'dokument_polski');

    ukryj_jedno_z_dwoch('dr_tak', 'dr_nie_o');
    ukryj_jedno_z_dwoch('dr_nie', 'dr_tak_o');

    ukryj_jedno_z_dwoch('dr_wyrazam_zgode', 'dr_nie_wyrazam_zgode_o');
    ukryj_jedno_z_dwoch('dr_nie_wyrazam_zgode', 'dr_wyrazam_zgode_o');

    wyswietl_ukryte_pola_czysc_input_i_kratki('dr_wyrazam_zgode', 'wz_nwz_opcje');
    wyswietl_ukryte_pola_czysc_input_i_kratki('dr_nie_wyrazam_zgode', 'wz_nwz_opcje');

    ukryj_jedno_z_dwoch('oz_poszkodowany_pw', 'oz_poszkodowany_npw_o');
    ukryj_jedno_z_dwoch('oz_poszkodowany_npw', 'oz_poszkodowany_pw_o');

    ukryj_jedno_z_dwoch('ppp_pieszy', 'ppp_rowerzysta_o');
    ukryj_jedno_z_dwoch('ppp_rowerzysta', 'ppp_pieszy_o');

    ukryj_dwa_pola_z_trzech('pwp_typ_samochod', 'pwp_typ_kz', 'pwp_typ_inne');
    ukryj_dwa_pola_z_trzech('pwp_typ_kz', 'pwp_typ_samochod', 'pwp_typ_inne');
    ukryj_dwa_pola_z_trzech('pwp_typ_inne', 'pwp_typ_kz', 'pwp_typ_samochod');

    wyswietl_jedno_ukryte_pole_czysc_input('pwp_typ_inne', 'pwp_typ_inne_o_o');

    ukryj_jedno_z_dwoch('pwp_kierowca', 'pwp_pasazer_o');
    ukryj_jedno_z_dwoch('pwp_pasazer', 'pwp_kierowca_o');

    ukryj_pozostale_pola_czysc_input_i_kratki('pwp_miejsce_ok');
    ukryj_pozostale_pola_czysc_input_i_kratki('pwp_miejsce_tzk');
    ukryj_pozostale_pola_czysc_input_i_kratki('pwp_miejsce_tzpp');
    ukryj_pozostale_pola_czysc_input_i_kratki('pwp_miejsce_tp');
    ukryj_pozostale_pola_czysc_input_i_kratki('pwp_miejsce_inne');

    wyswietl_jedno_ukryte_pole_czysc_input('pwp_miejsce_inne', 'pwp_miejsce_inne_o_o');

    ukryj_jedno_z_dwoch('pwp_p_zapiety', 'pwp_p_nie_zapiety_o');
    ukryj_jedno_z_dwoch('pwp_p_nie_zapiety', 'pwp_p_zapiety_o');

    ukryj_jedno_z_dwoch('pwp_p_wspol', 'pwp_p_nie_wspol_o');
    ukryj_jedno_z_dwoch('pwp_p_nie_wspol', 'pwp_p_wspol_o');

    ukryj_jedno_z_dwoch('pwp_kierowca_pw_wiedzialem', 'pwp_kierowca_pw_nie_wiedzialem_o');
    ukryj_jedno_z_dwoch('pwp_kierowca_pw_nie_wiedzialem', 'pwp_kierowca_pw_wiedzialem_o');

    ukryj_jedno_z_dwoch('pwp_kierowca_bu_wiedzialem', 'pwp_kierowca_bu_nie_wiedzialem_o');
    ukryj_jedno_z_dwoch('pwp_kierowca_bu_nie_wiedzialem', 'pwp_kierowca_bu_wiedzialem_o');

    wyswietl_jedno_ukryte_pole_czysc_input('l_zakonczone', 'l_zakonczone_data');

    ukryj_pozostale_pola_czysc_input_i_kratki('l_zakonczone');
    ukryj_pozostale_pola_czysc_input_i_kratki('l_nie_zakonczone_t');
    ukryj_pozostale_pola_czysc_input_i_kratki('l_nie_zakonczone_bt');

    wyswietl_jedno_ukryte_pole_czysc_input('l_nie_zakonczone_t', 'l_nie_zakonczone_t_data_o');

    ukryj_jedno_pole_czysc_input('l_chorobowe_nadal', 'l_chorobowe_do');

    ukryj_pozostale_pola_czysc_input_i_kratki('ou_iz_w_podstawowe');
    ukryj_pozostale_pola_czysc_input_i_kratki('ou_iz_w_zawodowe');
    ukryj_pozostale_pola_czysc_input_i_kratki('ou_iz_w_srednie');
    ukryj_pozostale_pola_czysc_input_i_kratki('ou_iz_w_wyzsze');

    wyswietl_jedno_ukryte_pole_czysc_input('ou_iz_zat_inne', 'ou_iz_zat_inne_nazwa');

    ukryj_pozostale_pola_czysc_input_i_kratki('ou_iz_zat_brak');
    ukryj_pozostale_pola_czysc_input_i_kratki('ou_iz_zat_uop');
    ukryj_pozostale_pola_czysc_input_i_kratki('ou_iz_zat_uz');
    ukryj_pozostale_pola_czysc_input_i_kratki('ou_iz_zat_wdg');
    ukryj_pozostale_pola_czysc_input_i_kratki('ou_iz_zat_gr');
    ukryj_pozostale_pola_czysc_input_i_kratki('ou_iz_zat_pd');
    ukryj_pozostale_pola_czysc_input_i_kratki('ou_iz_zat_inne');

    ukryj_jedno_pole_czysc_input('ou_iz_zat_brak', 'ou_iz_zat_pensja');

    ukryj_pozostale_pola_czysc_input_i_kratki('ou_iu_w_podstawowe');
    ukryj_pozostale_pola_czysc_input_i_kratki('ou_iu_w_zawodowe');
    ukryj_pozostale_pola_czysc_input_i_kratki('ou_iu_w_srednie');
    ukryj_pozostale_pola_czysc_input_i_kratki('ou_iu_w_wyzsze');

    wyswietl_jedno_ukryte_pole_czysc_input('ou_iu_zat_inne', 'ou_iu_zat_inne_nazwa');

    ukryj_pozostale_pola_czysc_input_i_kratki('ou_iu_zat_brak');
    ukryj_pozostale_pola_czysc_input_i_kratki('ou_iu_zat_uop');
    ukryj_pozostale_pola_czysc_input_i_kratki('ou_iu_zat_uz');
    ukryj_pozostale_pola_czysc_input_i_kratki('ou_iu_zat_wdg');
    ukryj_pozostale_pola_czysc_input_i_kratki('ou_iu_zat_gr');
    ukryj_pozostale_pola_czysc_input_i_kratki('ou_iu_zat_pd');
    ukryj_pozostale_pola_czysc_input_i_kratki('ou_iu_zat_inne');

    ukryj_jedno_pole_czysc_input('ou_iu_zat_brak', 'ou_iu_zat_pensja');

    wyswietl_jedno_ukryte_pole_czysc_input('ou_srm_zdu_inne', 'ou_srm_zdu_inne_rodzaj');

    ukryj_pozostale_pola_czysc_input_i_kratki('ou_srm_zdu_z');
    ukryj_pozostale_pola_czysc_input_i_kratki('ou_srm_zdu_m');
    ukryj_pozostale_pola_czysc_input_i_kratki('ou_srm_zdu_pk');
    ukryj_pozostale_pola_czysc_input_i_kratki('ou_srm_zdu_pm');
    ukryj_pozostale_pola_czysc_input_i_kratki('ou_srm_zdu_ma');
    ukryj_pozostale_pola_czysc_input_i_kratki('ou_srm_zdu_o');
    ukryj_pozostale_pola_czysc_input_i_kratki('ou_srm_zdu_c');
    ukryj_pozostale_pola_czysc_input_i_kratki('ou_srm_zdu_s');
    ukryj_pozostale_pola_czysc_input_i_kratki('ou_srm_zdu_si');
    ukryj_pozostale_pola_czysc_input_i_kratki('ou_srm_zdu_b');
    ukryj_pozostale_pola_czysc_input_i_kratki('ou_srm_zdu_wk');
    ukryj_pozostale_pola_czysc_input_i_kratki('ou_srm_zdu_wm');
    ukryj_pozostale_pola_czysc_input_i_kratki('ou_srm_zdu_dz');
    ukryj_pozostale_pola_czysc_input_i_kratki('ou_srm_zdu_ba');
    ukryj_pozostale_pola_czysc_input_i_kratki('ou_srm_zdu_inne');

    ukryj_jedno_pole('ou_srm_pwo', 'ou_srm_npwo_o');
    ukryj_jedno_pole('ou_srm_npwo', 'ou_srm_pwo_o');

    ukryj_pozostale_pola_czysc_input_i_kratki('ou_sudz_bz');
    ukryj_pozostale_pola_czysc_input_i_kratki('ou_sudz_z');
    ukryj_pozostale_pola_czysc_input_i_kratki('ou_sudz_p');
    ukryj_pozostale_pola_czysc_input_i_kratki('ou_sudz_zle');

    ukryj_jedno_z_dwoch('ou_sbnu_utrz', 'ou_sbnu_lnmu_o');
    ukryj_jedno_z_dwoch('ou_sbnu_lnmu', 'ou_sbnu_utrz_o');

    ukryj_dwa_pola_z_trzech('ou_spscnr_sm_nuz', 'ou_spscnr_sm_psn', 'ou_spscnr_sm_psz');
    ukryj_dwa_pola_z_trzech('ou_spscnr_sm_psn', 'ou_spscnr_sm_nuz', 'ou_spscnr_sm_psz');
    ukryj_dwa_pola_z_trzech('ou_spscnr_sm_psz', 'ou_spscnr_sm_psn', 'ou_spscnr_sm_nuz');

    ukryj_dwa_pola_z_trzech('ou_spscnr_mo_nuz', 'ou_spscnr_mo_psn', 'ou_spscnr_mo_psz');
    ukryj_dwa_pola_z_trzech('ou_spscnr_mo_psn', 'ou_spscnr_mo_nuz', 'ou_spscnr_mo_psz');
    ukryj_dwa_pola_z_trzech('ou_spscnr_mo_psz', 'ou_spscnr_mo_psn', 'ou_spscnr_mo_nuz');

    ukryj_jedno_z_dwoch('ou_spscnr_wstrzas_o', 'ou_spscnr_wstrzas_no_o');
    ukryj_jedno_z_dwoch('ou_spscnr_wstrzas_no', 'ou_spscnr_wstrzas_o_o');

    ukryj_jedno_z_dwoch('ou_spscnr_zps_wk', 'ou_spscnr_zps_wm_o');
    ukryj_jedno_z_dwoch('ou_spscnr_zps_wm', 'ou_spscnr_zps_wk_o');

    wyswietl_jedno_ukryte_pole_czysc_input('ou_spscnr_zps_dz', 'ou_spscnr_zps_dz_l');
    wyswietl_jedno_ukryte_pole_czysc_input('ou_spscnr_zps_dz', 'ou_spscnr_zps_dz_w');

    $('.poszkodowany_klient_k').click(function () {
        $('.poszkodowany_zmarly').removeClass('zaznaczone');
        $('.poszkodowany_malzonek').removeClass('zaznaczone');
        $('.poszkodowany_ubez').removeClass('zaznaczone');
        $('.poszkodowany_maloletni').removeClass('zaznaczone');
    });
    $('.dzialajacy_w_imieniu_kratka').click(function () {
        $('.poszkodowany_zmarly').removeClass('zaznaczone');
        $('.poszkodowany_malzonek').removeClass('zaznaczone');
        $('.poszkodowany_ubez').removeClass('zaznaczone');
        $('.poszkodowany_maloletni').removeClass('zaznaczone');
    });
    $('.poszkodowany_inny_kratka').click(function () {
        $('.poszkodowany_zmarly').removeClass('zaznaczone');
        $('.poszkodowany_malzonek').removeClass('zaznaczone');
        $('.poszkodowany_ubez').removeClass('zaznaczone');
        $('.poszkodowany_maloletni').removeClass('zaznaczone');
    });

}

function wyswietl_jedno_ukryte_pole(klik, wyswietl) {
    $('.' + klik).click(function () {
        if (!$(this).hasClass('zaznaczone')) {
            $('.' + wyswietl).hide();
        } else {
            $('.' + wyswietl).show();
        }
    });
}

function wyswietl_jedno_ukryte_pole_czysc_input(klik, wyswietl) {
    $('.' + klik).click(function () {
        if (!$(this).hasClass('zaznaczone')) {
            $('.' + wyswietl).hide();
            $('.' + wyswietl).val('');
            $('.' + wyswietl).removeAttr('value');
        } else {
            $('.' + wyswietl).show();
        }
    });
}

function wyswietl_ukryte_pola_czysc_input_i_kratki(klik, wyswietl) {
    $('.' + klik).click(function () {
        if (!$(this).hasClass('zaznaczone')) {
            $('.' + wyswietl).hide();
            $('.' + wyswietl).val('');
            $('.' + wyswietl).removeAttr('value');
            $('.' + wyswietl + ' .kratka_2').removeClass('zaznaczone');
        } else {
            $('.' + wyswietl).show();
        }
    });
}

function ukryj_jedno_pole(klik, ukryj) {
    $('.' + klik).click(function () {
        if ($(this).hasClass('zaznaczone')) {
            $('.' + ukryj).hide();
        } else {
            $('.' + ukryj).show();
        }
    });
}

function ukryj_jedno_pole_czysc_input(klik, ukryj) {
    $('.' + klik).click(function () {
        if ($(this).hasClass('zaznaczone')) {
            $('.' + ukryj).hide();
            $('.' + ukryj).val('');
            $('.' + ukryj).removeAttr('value');
        } else {
            $('.' + ukryj).show();
        }
    });
}

function ukryj_pozostale_pola_czysc_input_i_kratki(klik) {

    $('.' + klik).click(function () {
        if ($(this).hasClass('zaznaczone')) {
            $('.' + klik + '_o').hide();
            $('.' + klik + '_o').removeClass('zaznaczone');
            $('.' + klik + '_o').val('');
            $('.' + klik + '_o').removeAttr('value');
            $('.' + klik + '_o_o').val('');
            $('.' + klik + '_o_o').removeAttr('value');
        } else {
            $('.' + klik + '_o').show();
        }
    });
}

function ukryj_dwa_pola_z_trzech(klik, ukryj1, ukryj2) {

    $('.' + klik).click(function () {
        if ($(this).hasClass('zaznaczone')) {
            $('.' + ukryj1 + '_o').hide();
            $('.' + ukryj2 + '_o').hide();
            $('.' + ukryj1).removeClass('zaznaczone');
            $('.' + ukryj2).removeClass('zaznaczone');
        } else {
            $('.' + ukryj1 + '_o').show();
            $('.' + ukryj2 + '_o').show();

        }
    });
}

function ukryj_jedno_z_dwoch(klik, ukryj) {
    $('.' + klik).click(function () {
        if ($(this).hasClass('zaznaczone')) {
            $('.' + ukryj).hide();
        } else {
            $('.' + ukryj).show();
        }
    });
}

function zaznaczanie_odznaczanie_kratka() {
    $('.kratka_2').click(function () {
        if ($(this).hasClass('zaznaczone')) {
            $(this).removeClass('zaznaczone');
        } else {
            $(this).addClass('zaznaczone');
        }
    });
}



function zgloszenie_szkody_zapisz_do_bazy() {
    $('#zgloszenie_szkody_zapisz_zgloszenie').click(function () {

        var kod_jednostki;
        var kod_konsultanta;
        var umowa_id = $('.lista_umow_opcje option:selected').attr('id');

        var adres_kor_ulica = $('.zleceniodawca_ulica_kor').val();
        var adres_kor_nr_domu = $('.zleceniodawca_nr_domu_kor').val();
        var adres_kor_nr_mieszkania = $('.zleceniodawca_nr_mieszkania_kor').val();
        var adres_kor_kod_pocztowy = $('.zleceniodawca_kod_pocztowy_kor').val();
        var adres_kor_miejscowosc = $('.zleceniodawca_miejscowosc_kor').val();

        var poszkodowany_imie = $('.poszkodowany_imie').val();
        var poszkodowany_nazwisko = $('.poszkodowany_nazwisko').val();
        var poszkodowany_wiek = $('.poszkodowany_wiek').val();
        var poszkodowany_ulica = $('.poszkodowany_ulica').val();
        var poszkodowany_nr_domu = $('.poszkodowany_nr_domu').val();
        var poszkodowany_nr_mieszkania = $('.poszkodowany_nr_mieszkania').val();
        var poszkodowany_kod_pocztowy = $('.poszkodowany_kod_pocztowy').val();
        var poszkodowany_miejscowosc = $('.poszkodowany_miejscowosc').val();
        var poszkodowany_pesel = $('.poszkodowany_pesel').val();
        var poszkodowany_numer_dowodu = $('.poszkodowany_seria_i_numer_dowodu').val();
        var poszkodowany_email = $('.poszkodowany_email').val();
        var poszkodowany_telefon = $('.poszkodowany_telefon').val();

        var poszkodowany_maloletni = ($('.poszkodowany_maloletni').hasClass('zaznaczone')) ? '1' : '0';
        var poszkodowany_ubez = ($('.poszkodowany_ubez').hasClass('zaznaczone')) ? '1' : '0';
        var poszkodowany_malzonek = ($('.poszkodowany_malzonek').hasClass('zaznaczone')) ? '1' : '0';
        var poszkodowany_zmarly = ($('.poszkodowany_zmarly').hasClass('zaznaczone')) ? '1' : '0';

        if ($('.dzialajacy_w_imieniu_kratka').hasClass('zaznaczone') || $('.poszkodowany_inny_kratka').hasClass('zaznaczone')) {
            if (poszkodowany_imie == '' || poszkodowany_nazwisko == '' || poszkodowany_wiek == '' ||
                poszkodowany_ulica == '' || poszkodowany_nr_domu == '' || poszkodowany_nr_mieszkania == '' ||
                poszkodowany_kod_pocztowy == '' || poszkodowany_miejscowosc == '' || poszkodowany_pesel == '' ||
                poszkodowany_numer_dowodu == '' || poszkodowany_email == '' || poszkodowany_telefon == '') {
                wyswitl_powiadomienie('Uzupełnij dane poszkodowanego!!!', 0, 0);
                return false;
            }
        }

        if ($('.kod_pocztowy').hasClass('kod_niepoprawny')) {
            wyswitl_powiadomienie('Popraw błędy w formularzu!!!', 0, 0);
            return false;
        }

        if ($('.pesel').hasClass('pesel_niepoprawny')) {
            wyswitl_powiadomienie('Popraw błędy w formularzu!!!', 0, 0);
            return false;
        }

        if ($('.poszkodowany_seria_i_numer_dowodu').hasClass('dowod_niepoprawny')) {
            wyswitl_powiadomienie('Popraw błędy w formularzu!!!', 0, 0);
            return false;
        }

        if ($('.dzialajacy_w_imieniu_kratka').hasClass('zaznaczone') || $('.poszkodowany_inny_kratka').hasClass('zaznaczone')) {
            if (poszkodowany_maloletni == '0' && poszkodowany_ubez == '0' && poszkodowany_malzonek == '0' && poszkodowany_zmarly == '0') {
                wyswitl_powiadomienie('Wybierz kim jest poszkodowany!!!', 0, 0);
                return false;
            }
        }

        var uprawniony_imie = $('.uprawniony_imie').val();
        var uprawniony_nazwisko = $('.uprawniony_nazwisko').val();
        var uprawniony_wiek = $('.uprawniony_wiek').val();
        var uprawniony_ulica = $('.uprawniony_ulica').val();
        var uprawniony_nr_domu = $('.uprawniony_nr_domu').val();
        var uprawniony_nr_mieszkania = $('.uprawniony_nr_mieszkania').val();
        var uprawniony_kod_pocztowy = $('.uprawniony_kod_pocztowy').val();
        var uprawniony_miejscowosc = $('.uprawniony_miejscowosc').val();
        var uprawniony_pesel = $('.uprawniony_pesel').val();
        var uprawniony_numer_dowodu = $('.uprawniony_seria_i_numer_dowodu').val();
        var uprawniony_email = $('.uprawniony_email').val();
        var uprawniony_telefon = $('.uprawniony_telefon').val();

        if ($('.uprawniony_formularz_kratka_kratka').hasClass('zaznaczone')) {
            if (uprawniony_imie == '' || uprawniony_nazwisko == '' || uprawniony_wiek == '' ||
                uprawniony_ulica == '' || uprawniony_nr_domu == '' || uprawniony_nr_mieszkania == '' ||
                uprawniony_kod_pocztowy == '' || uprawniony_miejscowosc == '' || uprawniony_pesel == '' ||
                uprawniony_numer_dowodu == '' || uprawniony_email == '' || uprawniony_telefon == '') {
                wyswitl_powiadomienie('Uzupełnij dane uprawnionego!!!', 0, 0);
                return false;
            }
        }
        if ($('.uprawniony_seria_i_numer_dowodu').hasClass('dowod_niepoprawny')) {
            wyswitl_powiadomienie('Popraw błędy w formularzu!!!', 0, 0);
            return false;
        }

        var uprawniony_do_inf_imie = $('.uprawniony_informacje_imie').val();
        var uprawniony_do_inf_nazwisko = $('.uprawniony_informacje_nazwisko').val();
        var uprawniony_do_inf_pesel = $('.uprawniony_informacje_pesel').val();

        if ($('.uprawniony_do_informacji_kratka_kratka').hasClass('zaznaczone')) {
            if (uprawniony_do_inf_imie == '' || uprawniony_do_inf_nazwisko == '' || uprawniony_do_inf_pesel == '') {
                wyswitl_powiadomienie('Uzupełnij dane uprawnionego do uzyskiwania informacji!!!', 0, 0);
                return false;
            }
        }

        var godzina_wypadku = $('.godzina_wypadku').val();
        var miejsce_zdarzenia = $('.miejsce_zdarzenia').val();

        if (godzina_wypadku == '' || miejsce_zdarzenia == '') {
            wyswitl_powiadomienie('Uzupełnij godzine i miejsce wypadku!!!', 0, 0);
            return false;
        }

        var pojazd_a_marka = $('.pojazd_a_marka').val();
        var pojazd_a_model = $('.pojazd_a_model').val();
        var pojazd_a_rn_rejestracyjny = $('.pojazd_a_rn_rejestracyjny').val();
        var pojazd_a_kraj_rejestracji = $('.pojazd_a_kraj_rejestracji').val();
        var pojazd_a_kierujacy_pojazdem = $('.pojazd_a_kierujacy_pojazdem').val();
        var pojazd_a_posiadacz_pojazdu = $('.pojazd_a_posiadacz_pojazdu').val();
        var pojazd_a_uoc_posiadacz_pojazdu = $('.pojazd_a_uoc_posiadacz_pojazdu').val();
        var pojazd_a_nr_polisy_oc = $('.pojazd_a_nr_polisy_oc').val();

        var pojazd_b_marka = $('.pojazd_b_marka').val();
        var pojazd_b_model = $('.pojazd_b_model').val();
        var pojazd_b_rn_rejestracyjny = $('.pojazd_b_rn_rejestracyjny').val();
        var pojazd_b_kraj_rejestracji = $('.pojazd_b_kraj_rejestracji').val();
        var pojazd_b_kierujacy_pojazdem = $('.pojazd_b_kierujacy_pojazdem').val();
        var pojazd_b_posiadacz_pojazdu = $('.pojazd_b_posiadacz_pojazdu').val();
        var pojazd_b_uoc_posiadacz_pojazdu = $('.pojazd_b_uoc_posiadacz_pojazdu').val();
        var pojazd_b_nr_polisy_oc = $('.pojazd_b_nr_polisy_oc').val();

        var szkoda_nie_komunikacyjna = $('.pojazd_c_informacje').val();

        if (!$('.pojazd_a_k_b_k_kratka').hasClass('zaznaczone') && !$('.pojazd_b_k_kratka').hasClass('zaznaczone') && !$('.pojazd_c_k_kratka').hasClass('zaznaczone')) {
            wyswitl_powiadomienie('Wybierz kto brał udział w wypadku!!!', 0, 0);
            return false;
        }

        if ($('.pojazd_a_k_b_k_kratka').hasClass('zaznaczone')) {

            if (pojazd_a_marka == '' || pojazd_a_model == '' || pojazd_a_rn_rejestracyjny == '' || pojazd_a_kraj_rejestracji == '' ||
                pojazd_a_kierujacy_pojazdem == '' || pojazd_a_posiadacz_pojazdu == '' || pojazd_a_uoc_posiadacz_pojazdu == '' || pojazd_a_nr_polisy_oc == '' || pojazd_b_marka == '' || pojazd_b_model == '' || pojazd_b_rn_rejestracyjny == '' || pojazd_b_kraj_rejestracji == '' || pojazd_b_kierujacy_pojazdem == '' || pojazd_b_posiadacz_pojazdu == '' || pojazd_b_uoc_posiadacz_pojazdu == '' || pojazd_b_nr_polisy_oc == '') {
                wyswitl_powiadomienie('Uzupełnij dane pojazdu A i B!!!', 0, 0);
                return false;
            }
        }

        if ($('.pojazd_b_k_kratka').hasClass('zaznaczone')) {

            if (pojazd_b_marka == '' || pojazd_b_model == '' || pojazd_b_rn_rejestracyjny == '' || pojazd_b_kraj_rejestracji == '' || pojazd_b_kierujacy_pojazdem == '' || pojazd_b_posiadacz_pojazdu == '' || pojazd_b_uoc_posiadacz_pojazdu == '' || pojazd_b_nr_polisy_oc == '') {
                wyswitl_powiadomienie('Uzupełnij dane pojazdu B!!!', 0, 0);
                return false;
            }
        }
        if ($('.pojazd_c_k_kratka').hasClass('zaznaczone')) {

            if (szkoda_nie_komunikacyjna == '') {
                wyswitl_powiadomienie('Uzupełnij informacje o szkodzie!!!', 0, 0);
                return false;
            }
        }

        $.ajax({
                method: "POST",
                url: "formularze_dokumenty/akcje/ajax_zgloszenie_szkody_zapisz_do_bazy",
                data: {
                    umowa_id: umowa_id,
                    adres_kor_ulica: adres_kor_ulica,
                    adres_kor_nr_domu: adres_kor_nr_domu,
                    adres_kor_nr_mieszkania: adres_kor_nr_mieszkania,
                    adres_kor_kod_pocztowy: adres_kor_kod_pocztowy,
                    adres_kor_miejscowosc: adres_kor_miejscowosc,
                    poszkodowany_imie: poszkodowany_imie,
                    poszkodowany_nazwisko: poszkodowany_nazwisko,
                    poszkodowany_wiek: poszkodowany_wiek,
                    poszkodowany_ulica: poszkodowany_ulica,
                    poszkodowany_nr_domu: poszkodowany_nr_domu,
                    poszkodowany_nr_mieszkania: poszkodowany_nr_mieszkania,
                    poszkodowany_kod_pocztowy: poszkodowany_kod_pocztowy,
                    poszkodowany_miejscowosc: poszkodowany_miejscowosc,
                    poszkodowany_pesel: poszkodowany_pesel,
                    poszkodowany_numer_dowodu: poszkodowany_numer_dowodu,
                    poszkodowany_email: poszkodowany_email,
                    poszkodowany_telefon: poszkodowany_telefon,
                    poszkodowany_maloletni: poszkodowany_maloletni,
                    poszkodowany_ubez: poszkodowany_ubez,
                    poszkodowany_malzonek: poszkodowany_malzonek,
                    poszkodowany_zmarly: poszkodowany_zmarly,
                    uprawniony_imie: uprawniony_imie,
                    uprawniony_nazwisko: uprawniony_nazwisko,
                    uprawniony_wiek: uprawniony_wiek,
                    uprawniony_ulica: uprawniony_ulica,
                    uprawniony_nr_domu: uprawniony_nr_domu,
                    uprawniony_nr_mieszkania: uprawniony_nr_mieszkania,
                    uprawniony_kod_pocztowy: uprawniony_kod_pocztowy,
                    uprawniony_miejscowosc: uprawniony_miejscowosc,
                    uprawniony_pesel: uprawniony_pesel,
                    uprawniony_numer_dowodu: uprawniony_numer_dowodu,
                    uprawniony_email: uprawniony_email,
                    uprawniony_telefon: uprawniony_telefon,
                    uprawniony_do_inf_imie: uprawniony_do_inf_imie,
                    uprawniony_do_inf_nazwisko: uprawniony_do_inf_nazwisko,
                    uprawniony_do_inf_pesel: uprawniony_do_inf_pesel,
                    godzina_wypadku: godzina_wypadku,
                    miejsce_zdarzenia: miejsce_zdarzenia,
                    pojazd_a_marka: pojazd_a_marka,
                    pojazd_a_model: pojazd_a_model,
                    pojazd_a_rn_rejestracyjny: pojazd_a_rn_rejestracyjny,
                    pojazd_a_kraj_rejestracji: pojazd_a_kraj_rejestracji,
                    pojazd_a_kierujacy_pojazdem: pojazd_a_kierujacy_pojazdem,
                    pojazd_a_posiadacz_pojazdu: pojazd_a_posiadacz_pojazdu,
                    pojazd_a_uoc_posiadacz_pojazdu: pojazd_a_uoc_posiadacz_pojazdu,
                    pojazd_a_nr_polisy_oc: pojazd_a_nr_polisy_oc,
                    pojazd_b_marka: pojazd_b_marka,
                    pojazd_b_model: pojazd_b_model,
                    pojazd_b_rn_rejestracyjny: pojazd_b_rn_rejestracyjny,
                    pojazd_b_kraj_rejestracji: pojazd_b_kraj_rejestracji,
                    pojazd_b_kierujacy_pojazdem: pojazd_b_kierujacy_pojazdem,
                    pojazd_b_posiadacz_pojazdu: pojazd_b_posiadacz_pojazdu,
                    pojazd_b_uoc_posiadacz_pojazdu: pojazd_b_uoc_posiadacz_pojazdu,
                    pojazd_b_nr_polisy_oc: pojazd_b_nr_polisy_oc,
                    szkoda_nie_komunikacyjna: szkoda_nie_komunikacyjna
                }
            })
            .done(function (data) {

                var array = $.parseJSON(data);

                $('#id_druk_zgloszenia_szkody').attr('data-id_druk_zgloszenia_szkody', array[0]);
                $('#id_druk_zgloszenia_szkody').data('id_druk_zgloszenia_szkody', array[0]);

                wyswitl_powiadomienie('Pierwsza strona zgłoszenia została zapisana!!!', 1, 0);

                $('.strona_zgloszenia').removeClass('aktywna');
                $('.druk_zgloszenia_szkody_strona_str_2').show();
                $('.druk_zgloszenia_szkody_strona_str_2').addClass('aktywna');
                $('.str_1').slideUp();
                $('.str_2').slideDown();


            }).fail(function (ajaxContext) {
                document.getElementById("body_strona_r").innerHTML = ajaxContext.responseText;
            });
    });
}

function zgloszenie_szkody_zapisz_do_bazy_str_2() {
    $('#zgloszenie_szkody_zapisz_zgloszenie_str_2').click(function () {

        var zgloszenie_szkody_id = $('#id_druk_zgloszenia_szkody').data('id_druk_zgloszenia_szkody');

        var opis_zdarzenia = $('.opis_zdarzenia').val();
        if (opis_zdarzenia == '') {
            wyswitl_powiadomienie('Uzupełnij opis zdarzenia!!!', 0, 0);
            return false;
        }

        var obrazenia_ciala = $('.obrazenia_ciala').val();
        if (obrazenia_ciala == '') {
            wyswitl_powiadomienie('Uzupełnij opis obrażeń!!!', 0, 0);
            return false;
        }

        var ok_sygnatura_akt = $('.ok_sygnatura_akt').val();
        var ok_sprawca_napisal_oswiadczenie = ($('.ok_sprawca_napisal_oswiadczenie').hasClass('zaznaczone')) ? '1' : '0';
        var ok_sno_wezwano_policje = ($('.ok_sno_wezwano_policje').hasClass('zaznaczone')) ? '1' : '0';
        var ok_sno_nie_wezwano_policji = ($('.ok_sno_nie_wezwano_policji').hasClass('zaznaczone')) ? '1' : '0';

        var ok_wezwano_policje = ($('.ok_wezwano_policje').hasClass('zaznaczone')) ? '1' : '0';
        var ok_wp_miejsce = $('.ok_wp_miejsce').val();
        var ok_wszczeto_postepowanie = ($('.ok_wszczeto_postepowanie').hasClass('zaznaczone')) ? '1' : '0';

        if (ok_wezwano_policje == '1') {
            if (ok_wp_miejsce == '') {
                wyswitl_powiadomienie('Z jakiej miejscowośći wezwano policje?!?!?!', 0, 0);
                return false;
            }
        }

        var ok_postawiono_sprawcy_zarzut = ($('.ok_postawiono_sprawcy_zarzut').hasClass('zaznaczone')) ? '1' : '0';
        var ok_psz_artykul = $('.ok_psz_artykul').val();
        var ok_psz_kk = ($('.ok_psz_kk').hasClass('zaznaczone')) ? '1' : '0';
        var ok_psz_kw = ($('.ok_psz_kw').hasClass('zaznaczone')) ? '1' : '0';

        if (ok_postawiono_sprawcy_zarzut == '1') {
            if (ok_psz_artykul == '') {
                wyswitl_powiadomienie('Uzupełnij nr Artykułu!!!', 0, 0);
                return false;
            } else {
                if (ok_psz_kk == '0' && ok_psz_kw == '0') {
                    wyswitl_powiadomienie('Z jakiego kodeksu?!?!?!', 0, 0);
                    return false;
                }
            }
        }

        var ok_postepowanie_karne_umorzono = ($('.ok_postepowanie_karne_umorzono').hasClass('zaznaczone')) ? '1' : '0';
        var ok_pku_artykul = $('.ok_pku_artykul').val();
        var ok_pku_kpk = ($('.ok_pku_kpk').hasClass('zaznaczone')) ? '1' : '0';
        var ok_pku_kpw = ($('.ok_pku_kpw').hasClass('zaznaczone')) ? '1' : '0';

        if (ok_postepowanie_karne_umorzono == '1') {
            if (ok_pku_artykul == '') {
                wyswitl_powiadomienie('Uzupełnij nr Artykułu!!!', 0, 0);
                return false;
            } else {
                if (ok_pku_kpk == '0' && ok_pku_kpw == '0') {
                    wyswitl_powiadomienie('Z jakiego kodeksu?!?!?!', 0, 0);
                    return false;
                }
            }
        }

        var ok_skierowano_akt_do_sadu = ($('.ok_skierowano_akt_do_sadu').hasClass('zaznaczone')) ? '1' : '0';
        var ok_sads_pelna_nazwa_sadu = $('.ok_sads_pelna_nazwa_sadu').val();

        if (ok_skierowano_akt_do_sadu == '1') {
            if (ok_sads_pelna_nazwa_sadu == '') {
                wyswitl_powiadomienie('Wpisz pełną nazwę sądu!!!', 0, 0);
            }
        }

        var ok_zapadl_wyrok = ($('.ok_zapadl_wyrok').hasClass('zaznaczone')) ? '1' : '0';
        var ok_zw_skazujacy = ($('.ok_zw_skazujacy').hasClass('zaznaczone')) ? '1' : '0';
        var ok_zw_uniewinniajacy = ($('.ok_zw_uniewinniajacy').hasClass('zaznaczone')) ? '1' : '0';
        var ok_zw_u_artykul = $('.ok_zw_u_artykul').val();
        var ok_zw_kk = ($('.ok_zw_kk').hasClass('zaznaczone')) ? '1' : '0';
        var ok_zw_kw = ($('.ok_zw_kw').hasClass('zaznaczone')) ? '1' : '0';

        if (ok_zapadl_wyrok == '1') {
            if (ok_zw_skazujacy == '1' || ok_zw_uniewinniajacy == '1') {
                if (ok_zw_u_artykul == '') {
                    wyswitl_powiadomienie('Uzupełnij nr Artykułu!!!', 0, 0);
                    return false;
                } else {
                    if (ok_zw_kk == '0' && ok_zw_kw == '0') {
                        wyswitl_powiadomienie('Z jakiego kodeksu?!?!?!', 0, 0);
                        return false;
                    }
                }
            } else {
                wyswitl_powiadomienie('Jaki zapadł wyrok?!?!?!', 0, 0);
                return false;
            }
        }

        var oc_nr_szkody = $('.oc_nr_szkody').val();
        var oc_zgloszono_szp = ($('.oc_zgloszono_szp').hasClass('zaznaczone')) ? '1' : '0';
        var oc_zgloszono_szp_data = $('.oc_zgloszono_szp_data').val();
        var oc_nie_zgloszono_szp = ($('.oc_nie_zgloszono_szp').hasClass('zaznaczone')) ? '1' : '0';

        if (oc_zgloszono_szp == '1') {
            if (oc_zgloszono_szp_data == '') {
                wyswitl_powiadomienie('Uzupełnij date zgłoszenia szkody!!!', 0, 0);
                return false;
            }
        }

        var oc_zgloszono_szo = ($('.oc_zgloszono_szo').hasClass('zaznaczone')) ? '1' : '0';
        var oc_zgloszono_szo_data = $('.oc_zgloszono_szo_data').val();
        var oc_nie_zgloszono_szo = ($('.oc_nie_zgloszono_szo').hasClass('zaznaczone')) ? '1' : '0';

        if (oc_zgloszono_szo == '1') {
            if (oc_zgloszono_szo_data == '') {
                wyswitl_powiadomienie('Uzupełnij date zgłoszenia szkody!!!', 0, 0);
                return false;
            }
        }

        var oc_odszkodowanie_oc_p_nie_wyplacono = ($('.oc_odszkodowanie_oc_p_nie_wyplacono').hasClass('zaznaczone')) ? '1' : '0';
        var oc_odszkodowanie_oc_p_wyplacono = ($('.oc_odszkodowanie_oc_p_wyplacono').hasClass('zaznaczone')) ? '1' : '0';

        var oc_wyplacono_szo = ($('.oc_wyplacono_szo').hasClass('zaznaczone')) ? '1' : '0';
        var oc_wyplacono_szo_kwota = $('.oc_wyplacono_szo_kwota').val();

        var on_wyplacono_szo_ugoda = ($('.on_wyplacono_szo_ugoda').hasClass('zaznaczone')) ? '1' : '0';
        var on_wyplacono_szo_wyrok = ($('.on_wyplacono_szo_wyrok').hasClass('zaznaczone')) ? '1' : '0';
        var on_wyplacono_szo_decyzja_zd = ($('.on_wyplacono_szo_decyzja_zd').hasClass('zaznaczone')) ? '1' : '0';
        var on_wyplacono_szo_data = $('.on_wyplacono_szo_data').val();

        if (oc_wyplacono_szo == '1') {
            if (oc_wyplacono_szo_kwota == '') {
                wyswitl_powiadomienie('Uzupełnij kwote!!!', 0, 0);
                return false;
            }
            if (on_wyplacono_szo_ugoda == '0' && on_wyplacono_szo_ugoda == '0' &&
                on_wyplacono_szo_ugoda == '0' && on_wyplacono_szo_data == '') {
                wyswitl_powiadomienie('Na jakiej podstawie?!?!?!', 0, 0);
                return false;
            }
        }

        var io_zgloszono_nnw = ($('.io_zgloszono_nnw').hasClass('zaznaczone')) ? '1' : '0';
        var io_zgloszono_nnw_nazwa = $('.io_zgloszono_nnw_nazwa').val();
        if (io_zgloszono_nnw == '1') {
            if (io_zgloszono_nnw_nazwa == '') {
                wyswitl_powiadomienie('Uzupełnij nazwe Ubezpieczyciela!!!', 0, 0);
                return false;
            }
        }

        var io_zgloszono_nnw_uszczerbek = ($('.io_zgloszono_nnw_uszczerbek').hasClass('zaznaczone')) ? '1' : '0';
        var io_zgloszono_nnw_uczerbek_procent = $('.io_zgloszono_nnw_uczerbek_procent').val();
        if (io_zgloszono_nnw_uszczerbek == '1') {
            if (io_zgloszono_nnw_uczerbek_procent == '') {
                wyswitl_powiadomienie('I % przyznał Ubezpieczyciel?!?!?!', 0, 0);
                return false;
            }
        }

        var io_wypadek_przy_pracy = ($('.io_wypadek_przy_pracy').hasClass('zaznaczone')) ? '1' : '0';
        var io_wypadek_w_drodze_do_pracy = ($('.io_wypadek_w_drodze_do_pracy').hasClass('zaznaczone')) ? '1' : '0';

        var io_wypadek_zgloszono = ($('.io_wypadek_zgloszono').hasClass('zaznaczone')) ? '1' : '0';
        var io_wypadek_zgloszono_zus = ($('.io_wypadek_zgloszono_zus').hasClass('zaznaczone')) ? '1' : '0';
        var io_wypadek_zgloszono_krus = ($('.io_wypadek_zgloszono_krus').hasClass('zaznaczone')) ? '1' : '0';
        var io_wypadek_zgloszono_inne = ($('.io_wypadek_zgloszono_inne').hasClass('zaznaczone')) ? '1' : '0';
        var io_wypadek_zgloszono_inne_nazwa = $('.io_wypadek_zgloszono_inne_nazwa').val();
        var io_wypadek_zgloszono_uszczerbek_procent = $('.io_wypadek_zgloszono_uszczerbek_procent').val();

        if (io_wypadek_zgloszono == '1') {
            if (io_wypadek_zgloszono_zus == '0' && io_wypadek_zgloszono_krus == '0' &&
                io_wypadek_zgloszono_inne == '0') {
                wyswitl_powiadomienie('Wybierz rodzaj organizacjii!!!', 0, 0);
                return false;
            } else {
                if (io_wypadek_zgloszono_inne == '1') {
                    if (io_wypadek_zgloszono_inne_nazwa == '') {
                        wyswitl_powiadomienie('Wpisz nazwe organizacjii!!!', 0, 0);
                        return false;
                    }
                }
                if (io_wypadek_zgloszono_uszczerbek_procent == '') {
                    wyswitl_powiadomienie('I % przyznał Ubezpieczyciel?!?!?!', 0, 0);
                    return false;
                }
            }
        }


        var io_przyznano_jozwpp = ($('.io_przyznano_jozwpp').hasClass('zaznaczone')) ? '1' : '0';
        var io_przyznano_jozwpp_kwota = $('.io_przyznano_jozwpp_kwota').val();

        if (io_przyznano_jozwpp == '1') {
            if (io_przyznano_jozwpp_kwota == '') {
                wyswitl_powiadomienie('Uzupełnij kwote odszkodowania!!!', 0, 0);
                return false;
            }
        }

        var io_przyznano_zasilek_p = ($('.io_przyznano_zasilek_p').hasClass('zaznaczone')) ? '1' : '0';

        var io_zwolnienie_lekarskie = ($('.io_zwolnienie_lekarskie').hasClass('zaznaczone')) ? '1' : '0';
        var io_zwoilnienie_lekarskie_od = $('.io_zwoilnienie_lekarskie_od').val();
        var io_zwolnienie_lekarskie_od = $('.io_zwolnienie_lekarskie_od').val();

        if (io_zwolnienie_lekarskie == '1') {
            if (io_zwoilnienie_lekarskie_od == '' || io_zwolnienie_lekarskie_od == '') {
                wyswitl_powiadomienie('Uzupełnij date zwolnienia!!!', 0, 0);
                return false;
            }
        }

        var io_orzeczenie_o_niezdolnosci = ($('.io_orzeczenie_o_niezdolnosci').hasClass('zaznaczone')) ? '1' : '0';
        var io_orzenie_on_calkowite = ($('.io_orzenie_on_calkowite').hasClass('zaznaczone')) ? '1' : '0';
        var io_orzeczenie_on_czesciowe = ($('.io_orzeczenie_on_czesciowe').hasClass('zaznaczone')) ? '1' : '0';
        var io_orzeczenie_on_trwalej = ($('.io_orzeczenie_on_trwalej').hasClass('zaznaczone')) ? '1' : '0';
        var io_orzeczenie_on_okresowej = ($('.io_orzeczenie_on_okresowej').hasClass('zaznaczone')) ? '1' : '0';
        var io_orzeczenie_on_okresowej_data_do = $('.io_orzeczenie_on_okresowej_data_do').val();

        if (io_orzeczenie_o_niezdolnosci == '1') {
            if (io_orzenie_on_calkowite == '0' && io_orzeczenie_on_czesciowe == '0' && io_orzeczenie_on_trwalej == '0' && io_orzeczenie_on_okresowej == '0') {
                wyswitl_powiadomienie('Wybierz rodzaj niezdolności do pracy!!!', 0, 0);
                return false;
            } else {
                if (io_orzeczenie_on_okresowej == '1') {
                    if (io_orzeczenie_on_okresowej_data_do == '') {
                        wyswitl_powiadomienie('Uzupełnij date niezdolności do pracy!!!', 0, 0);
                        return false;
                    }
                }
            }
        }

        var io_przyznal_rente_zus = ($('.io_przyznal_rente_zus').hasClass('zaznaczone')) ? '1' : '0';
        var io_przyznal_rente_krus = ($('.io_przyznal_rente_krus').hasClass('zaznaczone')) ? '1' : '0';
        var io_przyznal_rente_inne = ($('.io_przyznal_rente_inne').hasClass('zaznaczone')) ? '1' : '0';
        var io_przyznal_rente_inne_nazwa = $('.io_przyznal_rente_inne_nazwa').val();
        var io_przyznal_inne_nazwa = $('.io_przyznal_inne_nazwa').val();

        var io_przyznal_ri_kwota = $('.io_przyznal_ri_kwota').val();
        var io_przyznal_ri_data = $('.io_przyznal_ri_data').val();

        if (io_przyznal_rente_zus == '1' || io_przyznal_rente_krus == '1' || io_przyznal_rente_inne == '1') {
            if (io_przyznal_ri_kwota == '' || io_przyznal_ri_data == '') {
                wyswitl_powiadomienie('Uzupełnij date i kowte świadczenia!!!', 0, 0);
                return false;
            }
        }


        $.ajax({
                method: "POST",
                url: "formularze_dokumenty/akcje/ajax_zgloszenie_szkody_zapisz_do_bazy_str_2",
                data: {
                    zgloszenie_szkody_id: zgloszenie_szkody_id,
                    obrazenia_ciala: obrazenia_ciala,
                    opis_zdarzenia: opis_zdarzenia,
                    ok_sygnatura_akt: ok_sygnatura_akt,
                    ok_sprawca_napisal_oswiadczenie: ok_sprawca_napisal_oswiadczenie,
                    ok_sno_wezwano_policje: ok_sno_wezwano_policje,
                    ok_sno_nie_wezwano_policji: ok_sno_nie_wezwano_policji,
                    ok_wezwano_policje: ok_wezwano_policje,
                    ok_wp_miejsce: ok_wp_miejsce,
                    ok_wszczeto_postepowanie: ok_wszczeto_postepowanie,
                    ok_postawiono_sprawcy_zarzut: ok_postawiono_sprawcy_zarzut,
                    ok_psz_artykul: ok_psz_artykul,
                    ok_psz_kk: ok_psz_kk,
                    ok_psz_kw: ok_psz_kw,
                    ok_postepowanie_karne_umorzono: ok_postepowanie_karne_umorzono,
                    ok_pku_artykul: ok_pku_artykul,
                    ok_pku_kpk: ok_pku_kpk,
                    ok_pku_kpw: ok_pku_kpw,
                    ok_skierowano_akt_do_sadu: ok_skierowano_akt_do_sadu,
                    ok_sads_pelna_nazwa_sadu: ok_sads_pelna_nazwa_sadu,
                    ok_zapadl_wyrok: ok_zapadl_wyrok,
                    ok_zw_skazujacy: ok_zw_skazujacy,
                    ok_zw_uniewinniajacy: ok_zw_uniewinniajacy,
                    ok_zw_u_artykul: ok_zw_u_artykul,
                    ok_zw_kk: ok_zw_kk,
                    ok_zw_kw: ok_zw_kw,
                    oc_nr_szkody: oc_nr_szkody,
                    oc_zgloszono_szp: oc_zgloszono_szp,
                    oc_zgloszono_szp_data: oc_zgloszono_szp_data,
                    oc_nie_zgloszono_szp: oc_nie_zgloszono_szp,
                    oc_zgloszono_szo: oc_zgloszono_szo,
                    oc_zgloszono_szo_data: oc_zgloszono_szo_data,
                    oc_nie_zgloszono_szo: oc_nie_zgloszono_szo,
                    oc_odszkodowanie_oc_p_nie_wyplacono: oc_odszkodowanie_oc_p_nie_wyplacono,
                    oc_odszkodowanie_oc_p_wyplacono: oc_odszkodowanie_oc_p_wyplacono,
                    oc_wyplacono_szo: oc_wyplacono_szo,
                    oc_wyplacono_szo_kwota: oc_wyplacono_szo_kwota,
                    on_wyplacono_szo_ugoda: on_wyplacono_szo_ugoda,
                    on_wyplacono_szo_wyrok: on_wyplacono_szo_wyrok,
                    on_wyplacono_szo_decyzja_zd: on_wyplacono_szo_decyzja_zd,
                    on_wyplacono_szo_data: on_wyplacono_szo_data,
                    io_zgloszono_nnw: io_zgloszono_nnw,
                    io_zgloszono_nnw_nazwa: io_zgloszono_nnw_nazwa,
                    io_zgloszono_nnw_uszczerbek: io_zgloszono_nnw_uszczerbek,
                    io_zgloszono_nnw_uczerbek_procent: io_zgloszono_nnw_uczerbek_procent,
                    io_wypadek_przy_pracy: io_wypadek_przy_pracy,
                    io_wypadek_w_drodze_do_pracy: io_wypadek_w_drodze_do_pracy,
                    io_wypadek_zgloszono: io_wypadek_zgloszono,
                    io_wypadek_zgloszono_zus: io_wypadek_zgloszono_zus,
                    io_wypadek_zgloszono_krus: io_wypadek_zgloszono_krus,
                    io_wypadek_zgloszono_inne: io_wypadek_zgloszono_inne,
                    io_wypadek_zgloszono_inne_nazwa: io_wypadek_zgloszono_inne_nazwa,
                    io_wypadek_zgloszono_uszczerbek_procent: io_wypadek_zgloszono_uszczerbek_procent,
                    io_przyznano_jozwpp: io_przyznano_jozwpp,
                    io_przyznano_jozwpp_kwota: io_przyznano_jozwpp_kwota,
                    io_przyznano_zasilek_p: io_przyznano_zasilek_p,
                    io_zwolnienie_lekarskie: io_zwolnienie_lekarskie,
                    io_zwoilnienie_lekarskie_od: io_zwoilnienie_lekarskie_od,
                    io_zwolnienie_lekarskie_od: io_zwolnienie_lekarskie_od,
                    io_orzeczenie_o_niezdolnosci: io_orzeczenie_o_niezdolnosci,
                    io_orzenie_on_calkowite: io_orzenie_on_calkowite,
                    io_orzeczenie_on_czesciowe: io_orzeczenie_on_czesciowe,
                    io_orzeczenie_on_trwalej: io_orzeczenie_on_trwalej,
                    io_orzeczenie_on_okresowej: io_orzeczenie_on_okresowej,
                    io_orzeczenie_on_okresowej_data_do: io_orzeczenie_on_okresowej_data_do,
                    io_przyznal_rente_zus: io_przyznal_rente_zus,
                    io_przyznal_rente_krus: io_przyznal_rente_krus,
                    io_przyznal_rente_inne: io_przyznal_rente_inne,
                    io_przyznal_rente_inne_nazwa: io_przyznal_rente_inne_nazwa,
                    io_przyznal_inne_nazwa: io_przyznal_inne_nazwa,
                    io_przyznal_ri_kwota: io_przyznal_ri_kwota,
                    io_przyznal_ri_data: io_przyznal_ri_data
                }
            })
            .done(function (data) {

                var array = $.parseJSON(data);

                wyswitl_powiadomienie('Druga strona zgłoszenia została zapisana!!!', 1, 0);

                $('.strona_zgloszenia').removeClass('aktywna');
                $('.druk_zgloszenia_szkody_strona_str_3').show();
                $('.druk_zgloszenia_szkody_strona_str_3').addClass('aktywna');
                $('.str_2').slideUp();
                $('.str_3').slideDown();

            }).fail(function (ajaxContext) {
                document.getElementById("body_strona_r").innerHTML = ajaxContext.responseText;
            });

    });
}

function zgloszenie_szkody_zapisz_do_bazy_str_3() {
    $('#zgloszenie_szkody_zapisz_zgloszenie_str_3').click(function () {
        var zgloszenie_szkody_id = $('#id_druk_zgloszenia_szkody').data('id_druk_zgloszenia_szkody');

        var pl_wezwano_pogotowie = ($('.pl_wezwano_pogotowie').hasClass('zaznaczone')) ? '1' : '0';
        var pl_wp_miejscowosc_szpital = $('.pl_wp_miejscowosc_szpital').val();

        var pl_pspdl = ($('.pl_pspdl').hasClass('zaznaczone')) ? '1' : '0';
        var pl_pspdl_dane_przychodni = $('.pl_pspdl_dane_przychodni').val();
        var pl_pspdl_data = $('.pl_pspdl_data').val();

        var pl_pbh = ($('.pl_pbh').hasClass('zaznaczone')) ? '1' : '0';
        var pl_pbh_nazwa_1 = $('.pl_pbh_nazwa_1').val();
        var pl_pbh_data_1 = $('.pl_pbh_data_1').val();
        var pl_pbh_nazwa_2 = $('.pl_pbh_nazwa_2').val();
        var pl_pbh_data_2 = $('.pl_pbh_data_2').val();
        var pl_pbh_nazwa_3 = $('.pl_pbh_nazwa_3').val();
        var pl_pbh_data_3 = $('.pl_pbh_data_3').val();

        var pl_pzo = ($('.pl_pzo').hasClass('zaznaczone')) ? '1' : '0';
        var pl_pzo_nazwa_1 = $('.pl_pzo_nazwa_1').val();
        var pl_pzo_data_1 = $('.pl_pzo_data_1').val();
        var pl_pzo_nazwa_2 = $('.pl_pzo_nazwa_2').val();
        var pl_pzo_data_2 = $('.pl_pzo_data_2').val();
        var pl_pzo_nazwa_3 = $('.pl_pzo_nazwa_3').val();
        var pl_pzo_data_3 = $('.pl_pzo_data_3').val();

        var dr_nie_zlecano_innym = ($('.dr_nie_zlecano_innym').hasClass('zaznaczone')) ? '1' : '0';
        var dr_zlecono_sprawe = ($('.dr_zlecono_sprawe').hasClass('zaznaczone')) ? '1' : '0';
        var dr_zs_nazwa = $('.dr_zs_nazwa').val();
        var dr_zs_data_umowy = $('.dr_zs_data_umowy').val();

        var dr_zs_wypowiedziano_umowe_data = $('.dr_zs_wypowiedziano_umowe_data').val();

        var dr_s_do_a_obcy = ($('.dr_s_do_a_obcy').hasClass('zaznaczone')) ? '1' : '0';
        var dr_s_do_a_rodzina = ($('.dr_s_do_a_rodzina').hasClass('zaznaczone')) ? '1' : '0';
        var dr_s_do_a_inny = ($('.dr_s_do_a_inny').hasClass('zaznaczone')) ? '1' : '0';
        var dr_s_do_a_inny_rodzaj = $('.dr_s_do_a_inny_rodzaj').val();

        var dr_s_do_b_obcy = ($('.dr_s_do_b_obcy').hasClass('zaznaczone')) ? '1' : '0';
        var dr_s_do_b_rodzina = ($('.dr_s_do_b_rodzina').hasClass('zaznaczone')) ? '1' : '0';
        var dr_s_do_b_inny = ($('.dr_s_do_b_inny').hasClass('zaznaczone')) ? '1' : '0';
        var dr_s_do_b_inny_rodzaj = $('.dr_s_do_b_inny_rodzaj').val();

        var dr_ub_ufg_tak = ($('.dr_ub_ufg_tak').hasClass('zaznaczone')) ? '1' : '0';
        var dr_ub_ufg_nie = ($('.dr_ub_ufg_nie').hasClass('zaznaczone')) ? '1' : '0';

        var dr_tak = ($('.dr_tak').hasClass('zaznaczone')) ? '1' : '0';
        var dr_nie = ($('.dr_nie').hasClass('zaznaczone')) ? '1' : '0';

        var dr_liczba_kartek = $('.dr_liczba_kartek').val();

        var dr_wyrazam_zgode = ($('.dr_wyrazam_zgode').hasClass('zaznaczone')) ? '1' : '0';
        var dr_wyrazam_zgode_sms = ($('.dr_wyrazam_zgode_sms').hasClass('zaznaczone')) ? '1' : '0';
        var dr_wyrazam_zgode_email = ($('.dr_wyrazam_zgode_email').hasClass('zaznaczone')) ? '1' : '0';
        var dr_nie_wyrazam_zgode = ($('.dr_nie_wyrazam_zgode').hasClass('zaznaczone')) ? '1' : '0';

        var zsz_pcrf = ($('.zsz_pcrf').hasClass('zaznaczone')) ? '1' : '0';
        var zsz_cmg = ($('.zsz_cmg').hasClass('zaznaczone')) ? '1' : '0';
        var zsz_inna_dz = ($('.zsz_inna_dz').hasClass('zaznaczone')) ? '1' : '0';
        var zsz_pf = ($('.zsz_pf').hasClass('zaznaczone')) ? '1' : '0';

        $.ajax({
                method: "POST",
                url: "formularze_dokumenty/akcje/ajax_zgloszenie_szkody_zapisz_do_bazy_str_3",
                data: {
                    zgloszenie_szkody_id: zgloszenie_szkody_id,
                    pl_wezwano_pogotowie: pl_wezwano_pogotowie,
                    pl_wp_miejscowosc_szpital: pl_wp_miejscowosc_szpital,
                    pl_pspdl: pl_pspdl,
                    pl_pspdl_dane_przychodni: pl_pspdl_dane_przychodni,
                    pl_pspdl_data: pl_pspdl_data,
                    pl_pbh: pl_pbh,
                    pl_pbh_nazwa_1: pl_pbh_nazwa_1,
                    pl_pbh_data_1: pl_pbh_data_1,
                    pl_pbh_nazwa_2: pl_pbh_nazwa_2,
                    pl_pbh_data_2: pl_pbh_data_2,
                    pl_pbh_nazwa_3: pl_pbh_nazwa_3,
                    pl_pbh_data_3: pl_pbh_data_3,
                    pl_pzo: pl_pzo,
                    pl_pzo_nazwa_1: pl_pzo_nazwa_1,
                    pl_pzo_data_1: pl_pzo_data_1,
                    pl_pzo_nazwa_2: pl_pzo_nazwa_2,
                    pl_pzo_data_2: pl_pzo_data_2,
                    pl_pzo_nazwa_3: pl_pzo_nazwa_3,
                    pl_pzo_data_3: pl_pzo_data_3,
                    dr_nie_zlecano_innym: dr_nie_zlecano_innym,
                    dr_zlecono_sprawe: dr_zlecono_sprawe,
                    dr_zs_nazwa: dr_zs_nazwa,
                    dr_zs_data_umowy: dr_zs_data_umowy,
                    dr_zs_wypowiedziano_umowe_data: dr_zs_wypowiedziano_umowe_data,
                    dr_s_do_a_obcy: dr_s_do_a_obcy,
                    dr_s_do_a_rodzina: dr_s_do_a_rodzina,
                    dr_s_do_a_inny: dr_s_do_a_inny,
                    dr_s_do_a_inny_rodzaj: dr_s_do_a_inny_rodzaj,
                    dr_s_do_b_obcy: dr_s_do_b_obcy,
                    dr_s_do_b_rodzina: dr_s_do_b_rodzina,
                    dr_s_do_b_inny: dr_s_do_b_inny,
                    dr_s_do_b_inny_rodzaj: dr_s_do_b_inny_rodzaj,
                    dr_ub_ufg_tak: dr_ub_ufg_tak,
                    dr_ub_ufg_nie: dr_ub_ufg_nie,
                    dr_tak: dr_tak,
                    dr_nie: dr_nie,
                    dr_liczba_kartek: dr_liczba_kartek,
                    dr_wyrazam_zgode: dr_wyrazam_zgode,
                    dr_wyrazam_zgode_sms: dr_wyrazam_zgode_sms,
                    dr_wyrazam_zgode_email: dr_wyrazam_zgode_email,
                    dr_nie_wyrazam_zgode: dr_nie_wyrazam_zgode,
                    zsz_pcrf: zsz_pcrf,
                    zsz_cmg: zsz_cmg,
                    zsz_inna_dz: zsz_inna_dz,
                    zsz_pf: zsz_pf
                }
            })
            .done(function (data) {

                var array = $.parseJSON(data);

                wyswitl_powiadomienie('Trzecia strona zgłoszenia została zapisana!!!', 1, 0);

                $('.strona_zgloszenia').removeClass('aktywna');
                $('.druk_zgloszenia_szkody_strona_str_4').show();
                $('.druk_zgloszenia_szkody_strona_str_4').addClass('aktywna');
                $('.str_3').slideUp();
                $('.str_4').slideDown();

            }).fail(function (ajaxContext) {
                document.getElementById("body_strona_r").innerHTML = ajaxContext.responseText;
            });

    });

}

function zgloszenie_szkody_zapisz_do_bazy_str_4() {
    $('#zgloszenie_szkody_zapisz_zgloszenie_str_4').click(function () {
        var zgloszenie_szkody_id = $('#id_druk_zgloszenia_szkody').data('id_druk_zgloszenia_szkody');

        var oz_imie_nazwisko = $('.oz_imie_nazwisko').val();
        var oz_miejscowsc = $('.oz_miejscowsc').val();
        var oz_ulica_trasa = $('.oz_ulica_trasa').val();
        var oz_kraj = $('.oz_kraj').val();
        var oz_data = $('.oz_data').val();
        var oz_godzina = $('.oz_godzina').val();
        var oz_poszkodowany_pw = ($('.oz_poszkodowany_pw').hasClass('zaznaczone')) ? '1' : '0';
        var oz_poszkodowany_pw_a = ($('.oz_poszkodowany_pw_a').hasClass('zaznaczone')) ? '1' : '0';
        var oz_poszkodowany_pw_n = ($('.oz_poszkodowany_pw_n').hasClass('zaznaczone')) ? '1' : '0';
        var oz_poszkodowany_pw_inne = ($('.oz_poszkodowany_pw_inne').hasClass('zaznaczone')) ? '1' : '0';
        var oz_poszkodowany_npw = ($('.oz_poszkodowany_npw').hasClass('zaznaczone')) ? '1' : '0';

        var ppp_pieszy = ($('.ppp_pieszy').hasClass('zaznaczone')) ? '1' : '0';
        var ppp_rowerzysta = ($('.ppp_rowerzysta').hasClass('zaznaczone')) ? '1' : '0';
        var ppp_marka_pojazdu = $('.ppp_marka_pojazdu').val();
        var ppp_nr_rejestracji = $('.ppp_nr_rejestracji').val();

        var pwp_typ_samochod = ($('.pwp_typ_samochod').hasClass('zaznaczone')) ? '1' : '0';
        var pwp_typ_kz = ($('.pwp_typ_kz').hasClass('zaznaczone')) ? '1' : '0';
        var pwp_typ_inne = ($('.pwp_typ_inne').hasClass('zaznaczone')) ? '1' : '0';
        var pwp_typ_inne_nazwa = $('.pwp_typ_inne_nazwa').val();
        var pwp_marka_pojazdu = $('.pwp_marka_pojazdu').val();
        var pwp_nr_rejestracyjny = $('.pwp_nr_rejestracyjny').val();
        var pwp_kierowca = ($('.pwp_kierowca').hasClass('zaznaczone')) ? '1' : '0';
        var pwp_pasazer = ($('.pwp_pasazer').hasClass('zaznaczone')) ? '1' : '0';

        var pwp_miejsce_ok = ($('.pwp_miejsce_ok').hasClass('zaznaczone')) ? '1' : '0';
        var pwp_miejsce_tzk = ($('.pwp_miejsce_tzk').hasClass('zaznaczone')) ? '1' : '0';
        var pwp_miejsce_tzpp = ($('.pwp_miejsce_tzpp').hasClass('zaznaczone')) ? '1' : '0';
        var pwp_miejsce_tp = ($('.pwp_miejsce_tp').hasClass('zaznaczone')) ? '1' : '0';
        var pwp_miejsce_inne = ($('.pwp_miejsce_inne').hasClass('zaznaczone')) ? '1' : '0';
        var pwp_miejsce_inne_nazwa = $('.pwp_miejsce_inne_nazwa').val();

        var pwp_p_zapiety = ($('.pwp_p_zapiety').hasClass('zaznaczone')) ? '1' : '0';
        var pwp_p_nie_zapiety = ($('.pwp_p_nie_zapiety').hasClass('zaznaczone')) ? '1' : '0';

        var pwp_p_wspol = ($('.pwp_p_wspol').hasClass('zaznaczone')) ? '1' : '0';
        var pwp_p_nie_wspol = ($('.pwp_p_nie_wspol').hasClass('zaznaczone')) ? '1' : '0';

        var pwp_kierowca_pw_wiedzialem = ($('.pwp_kierowca_pw_wiedzialem').hasClass('zaznaczone')) ? '1' : '0';
        var pwp_kierowca_pw_nie_wiedzialem = ($('.pwp_kierowca_pw_nie_wiedzialem').hasClass('zaznaczone')) ? '1' : '0';

        var pwp_kierowca_bu_wiedzialem = ($('.pwp_kierowca_bu_wiedzialem').hasClass('zaznaczone')) ? '1' : '0';
        var pwp_kierowca_bu_nie_wiedzialem = ($('.pwp_kierowca_bu_nie_wiedzialem').hasClass('zaznaczone')) ? '1' : '0';

        var l_zakonczone = ($('.l_zakonczone').hasClass('zaznaczone')) ? '1' : '0';
        var l_zakonczone_data = $('.l_zakonczone_data').val();
        var l_nie_zakonczone_t = ($('.l_nie_zakonczone_t').hasClass('zaznaczone')) ? '1' : '0';
        var l_nie_zakonczone_t_data = $('.l_nie_zakonczone_t_data').val();
        var l_nie_zakonczone_bt = ($('.l_nie_zakonczone_bt').hasClass('zaznaczone')) ? '1' : '0';
        var l_zabiegi = ($('.l_zabiegi').hasClass('zaznaczone')) ? '1' : '0';
        var l_chorobowe_od = $('.l_chorobowe_od').val();
        var l_chorobowe_do = $('.l_chorobowe_do').val();
        var l_chorobowe_nadal = ($('.l_chorobowe_nadal').hasClass('zaznaczone')) ? '1' : '0';

        $.ajax({
                method: "POST",
                url: "formularze_dokumenty/akcje/ajax_zgloszenie_szkody_zapisz_do_bazy_str_4",
                data: {
                    zgloszenie_szkody_id: zgloszenie_szkody_id,
                    oz_imie_nazwisko: oz_imie_nazwisko,
                    oz_miejscowsc: oz_miejscowsc,
                    oz_ulica_trasa: oz_ulica_trasa,
                    oz_kraj: oz_kraj,
                    oz_data: oz_data,
                    oz_godzina: oz_godzina,
                    oz_poszkodowany_pw: oz_poszkodowany_pw,
                    oz_poszkodowany_pw_a: oz_poszkodowany_pw_a,
                    oz_poszkodowany_pw_n: oz_poszkodowany_pw_n,
                    oz_poszkodowany_pw_inne: oz_poszkodowany_pw_inne,
                    oz_poszkodowany_npw: oz_poszkodowany_npw,
                    ppp_pieszy: ppp_pieszy,
                    ppp_rowerzysta: ppp_rowerzysta,
                    ppp_marka_pojazdu: ppp_marka_pojazdu,
                    ppp_nr_rejestracji: ppp_nr_rejestracji,
                    pwp_typ_samochod: pwp_typ_samochod,
                    pwp_typ_kz: pwp_typ_kz,
                    pwp_typ_inne: pwp_typ_inne,
                    pwp_typ_inne_nazwa: pwp_typ_inne_nazwa,
                    pwp_marka_pojazdu: pwp_marka_pojazdu,
                    pwp_nr_rejestracyjny: pwp_nr_rejestracyjny,
                    pwp_kierowca: pwp_kierowca,
                    pwp_pasazer: pwp_pasazer,
                    pwp_miejsce_ok: pwp_miejsce_ok,
                    pwp_miejsce_tzk: pwp_miejsce_tzk,
                    pwp_miejsce_tzpp: pwp_miejsce_tzpp,
                    pwp_miejsce_tp: pwp_miejsce_tp,
                    pwp_miejsce_inne: pwp_miejsce_inne,
                    pwp_miejsce_inne_nazwa: pwp_miejsce_inne_nazwa,
                    pwp_p_zapiety: pwp_p_zapiety,
                    pwp_p_nie_zapiety: pwp_p_nie_zapiety,
                    pwp_p_wspol: pwp_p_wspol,
                    pwp_p_nie_wspol: pwp_p_nie_wspol,
                    pwp_kierowca_pw_wiedzialem: pwp_kierowca_pw_wiedzialem,
                    pwp_kierowca_pw_nie_wiedzialem: pwp_kierowca_pw_nie_wiedzialem,
                    pwp_kierowca_bu_wiedzialem: pwp_kierowca_bu_wiedzialem,
                    pwp_kierowca_bu_nie_wiedzialem: pwp_kierowca_bu_nie_wiedzialem,
                    l_zakonczone: l_zakonczone,
                    l_zakonczone_data: l_zakonczone_data,
                    l_nie_zakonczone_t: l_nie_zakonczone_t,
                    l_nie_zakonczone_t_data: l_nie_zakonczone_t_data,
                    l_nie_zakonczone_bt: l_nie_zakonczone_bt,
                    l_zabiegi: l_zabiegi,
                    l_chorobowe_od: l_chorobowe_od,
                    l_chorobowe_do: l_chorobowe_do,
                    l_chorobowe_nadal: l_chorobowe_nadal
                }
            })
            .done(function (data) {

                var array = $.parseJSON(data);

                wyswitl_powiadomienie('Czwarta strona zgłoszenia została zapisana!!!', 1, 0);

                $('.strona_zgloszenia').removeClass('aktywna');
                $('.druk_zgloszenia_szkody_strona_str_5').show();
                $('.druk_zgloszenia_szkody_strona_str_5').addClass('aktywna');
                $('.str_4').slideUp();
                $('.str_5').slideDown();

            }).fail(function (ajaxContext) {
                document.getElementById("body_strona_r").innerHTML = ajaxContext.responseText;
            });

    });
}



function pojazd_a_k_b_k() {
    $('.pojazd_a_k_b_k .kratka').click(function () {
        $('.dane_wypadku_formularz').find('.kratka').removeClass('zaznaczone');
        $(this).addClass('zaznaczone');
        $('.pojazd_c').slideUp();
        $('.pojazd_a').slideDown();
        $('.pojazd_b').slideDown();

        /*kamyk 2016-08-12*/
        $('.stosunek_a').slideDown();
        $('.stosunek_b').slideDown();
    });
}

function pojazd_b_k() {
    $('.pojazd_b_k .kratka').click(function () {
        $('.dane_wypadku_formularz').find('.kratka').removeClass('zaznaczone');
        $(this).addClass('zaznaczone');
        $('.pojazd_a_marka').val('');
        $('.pojazd_a_model').val('');
        $('.pojazd_a_nr_rejestracyjny').val('');
        $('.pojazd_a_kraj_rejestracji').val('');
        $('.pojazd_a_kierujacy_pojazdem').val('');
        $('.pojazd_a_posiadacz_pojazdu').val('');
        $('.pojazd_a_nr_polisy_oc').val('');
        $('.pojazd_a_uoc_posiadacz_pojazdu').val('');
        $('.pojazd_a').slideUp();
        $('.pojazd_c').slideUp();
        $('.pojazd_b').slideDown();

        /*kamyk 2016-08-12*/
        $('.stosunek_a').slideUp();
        $('.stosunek_b').slideDown();

    });
}

function pojazd_c_k() {
    $('.pojazd_c_k .kratka').click(function () {
        $('.dane_wypadku_formularz').find('.kratka').removeClass('zaznaczone');
        $(this).addClass('zaznaczone');
        $('.pojazd_a_marka').val('');
        $('.pojazd_a_model').val('');
        $('.pojazd_a_nr_rejestracyjny').val('');
        $('.pojazd_a_kraj_rejestracji').val('');
        $('.pojazd_a_kierujacy_pojazdem').val('');
        $('.pojazd_a_posiadacz_pojazdu').val('');
        $('.pojazd_a_nr_polisy_oc').val('');
        $('.pojazd_a_uoc_posiadacz_pojazdu').val('');

        $('.pojazd_b_marka').val('');
        $('.pojazd_b_model').val('');
        $('.pojazd_b_nr_rejestracyjny').val('');
        $('.pojazd_b_kraj_rejestracji').val('');
        $('.pojazd_b_kierujacy_pojazdem').val('');
        $('.pojazd_b_posiadacz_pojazdu').val('');
        $('.pojazd_b_nr_polisy_oc').val('');
        $('.pojazd_b_uoc_posiadacz_pojazdu').val('');

        $('.pojazd_a').slideUp();
        $('.pojazd_c').slideDown();
        $('.pojazd_b').slideUp();

        /*kamyk 2016-08-12*/
        $('.stosunek_a').slideUp();
        $('.stosunek_b').slideUp();
    });
}

function poszkodowany_klient_dzialajacy_w_imieniu() {
    $('.poszkodowany_klient_dzialajacy_w_imieniu .kratka').click(function () {
        $('.dzialajacy_w_imieniu_formularz').find('.kratka').removeClass('zaznaczone');
        $(this).addClass('zaznaczone');
        $('.poszkodowany_dane_formularz').slideDown();

        var reprezentowany_id = $('.dzialajacy_w_imieniu_kratka').data('id_reprezentowany');

        if (reprezentowany_id != '0') {
            $.ajax({
                    method: "POST",
                    url: "ajax/akcje/ajax_pobierz_klienta_po_id",
                    data: {
                        klient_id: reprezentowany_id
                    }
                })
                .done(function (data) {

                    var array = $.parseJSON(data);

                    $('.poszkodowany_imie').val(array[2]);
                    $('.poszkodowany_imie').attr('value', array[2]);

                    $('.poszkodowany_nazwisko').val(array[3]);
                    $('.poszkodowany_nazwisko').attr('value', array[3]);

                    $('.poszkodowany_pesel').val(array[4]);
                    $('.poszkodowany_pesel').attr('value', array[4]);

                    $('.poszkodowany_seria_i_numer_dowodu').val(array[5]);
                    $('.poszkodowany_seria_i_numer_dowodu').attr('value', array[5]);

                    $('.poszkodowany_ulica').val(array[6]);
                    $('.poszkodowany_ulica').attr('value', array[6]);

                    $('.poszkodowany_nr_domu').val(array[7]);
                    $('.poszkodowany_nr_domu').attr('value', array[7]);

                    $('.poszkodowany_nr_mieszkania').val(array[8]);
                    $('.poszkodowany_nr_mieszkania').attr('value', array[8]);

                    $('.poszkodowany_miejscowosc').val(array[9]);
                    $('.poszkodowany_miejscowosc').attr('value', array[9]);

                    var email = $('.zleceniodawca_email').val();
                    var telefon = $('.zleceniodawca_telefon').val();

                    $('.poszkodowany_email').val(email);
                    $('.poszkodowany_email').attr('value', email);

                    $('.poszkodowany_telefon').val(telefon);
                    $('.poszkodowany_telefon').attr('value', telefon);

                    $('.poszkodowany_wiek ').val(array[13]);
                    $('.poszkodowany_wiek').attr('value', array[13]);

                    $('.poszkodowany_kod_pocztowy').val(array[12]);
                    $('.poszkodowany_kod_pocztowy').attr('value', array[12]);

                    $('.poszkodowany_dane_formularz div').addClass('zablokowane_pole');
                    $('.opcje_kim_poszkodowany').removeClass('zablokowane_pole');

                }).fail(function (ajaxContext) {
                    document.getElementById("body_strona_r").innerHTML = ajaxContext.responseText;
                });
        }

    });
}

function zablokuj_pola_do_edycji_odbiorca() {
    $('.wynagrodzenie_opcje .zleceniodawca_formularz_imie').addClass('zablokowane_pole');
    $('.wynagrodzenie_opcje .zleceniodawca_formularz_nazwisko').addClass('zablokowane_pole');
    $('.wynagrodzenie_opcje .zleceniodawca_formularz_ulica').addClass('zablokowane_pole');
    $('.wynagrodzenie_opcje .zleceniodawca_formularz_nr_domu').addClass('zablokowane_pole');
    $('.wynagrodzenie_opcje .zleceniodawca_formularz_nr_mieszkania').addClass('zablokowane_pole');
    $('.wynagrodzenie_opcje .zleceniodawca_formularz_kod_pocztowy').addClass('zablokowane_pole');
    $('.wynagrodzenie_opcje .zleceniodawca_formularz_miejscowosc').addClass('zablokowane_pole');
}

function odblokuj_pola_do_edycji_odbiorca() {
    $('.wynagrodzenie_opcje .zleceniodawca_formularz_imie').removeClass('zablokowane_pole');
    $('.wynagrodzenie_opcje .zleceniodawca_formularz_nazwisko').removeClass('zablokowane_pole');
    $('.wynagrodzenie_opcje .zleceniodawca_formularz_ulica').removeClass('zablokowane_pole');
    $('.wynagrodzenie_opcje .zleceniodawca_formularz_nr_domu').removeClass('zablokowane_pole');
    $('.wynagrodzenie_opcje .zleceniodawca_formularz_nr_mieszkania').removeClass('zablokowane_pole');
    $('.wynagrodzenie_opcje .zleceniodawca_formularz_kod_pocztowy').removeClass('zablokowane_pole');
    $('.wynagrodzenie_opcje .zleceniodawca_formularz_miejscowosc').removeClass('zablokowane_pole');
}

function uzupelnij_dane_klienta_na_podstawie_wybranego_z_listy() {
    $('.lista_klientow_opcje').change(function () {


        var id_klienta = $('.lista_klientow_opcje option:selected').attr('id');

        $.ajax({
                method: "POST",
                url: "ajax/akcje/ajax_pobierz_klienta_po_id",
                data: {
                    klient_id: id_klienta
                }
            })
            .done(function (data) {

                var array = $.parseJSON(data);

                $('.dodawanie_klienta').slideDown();
                
                $('.sprawa_klient_dane').attr('data-klient_wybrany_id', id_klienta);
                $('.sprawa_klient_dane').data('klient_wybrany_id', id_klienta);

                $('.zleceniodawca_imie_b').val(array[2]);
                $('.zleceniodawca_imie_b').attr('value', array[2]);

                $('.zleceniodawca_nazwisko_b').val(array[3]);
                $('.zleceniodawca_nazwisko_b').attr('value', array[3]);

                $('.zleceniodawca_ulica_b').val(array[6]);
                $('.zleceniodawca_ulica_b').attr('value', array[6]);

                $('.zleceniodawca_nr_domu_b').val(array[7]);
                $('.zleceniodawca_nr_domu_b').attr('value', array[7]);

                $('.zleceniodawca_nr_mieszkania_b').val(array[8]);
                $('.zleceniodawca_nr_mieszkania_b').attr('value', array[8]);

                $('.zleceniodawca_miejscowosc_b').val(array[9]);
                $('.zleceniodawca_miejscowosc_b').attr('value', array[9]);

                $('.zleceniodawca_email_b').val(array[10]);
                $('.zleceniodawca_email_b').attr('value', array[10]);

                $('.zleceniodawca_telefon_b').val(array[11]);
                $('.zleceniodawca_telefon_b').attr('value', array[11]);

                $('.zleceniodawca_kod_pocztowy_b').val(array[12]);
                $('.zleceniodawca_kod_pocztowy_b').attr('value', array[12]);
                
                $('.obcokrajowiec').attr('data-obcokrajowiec', array[14]);
                $('.obcokrajowiec').data('obcokrajowiec', array[14]);

                /* medyk 16-11-2016 */
                if (array[14] == '0') {
                    $('.zleceniodawca_wiek_b').val(array[13]);
                    $('.zleceniodawca_wiek_b').attr('value', array[13]);
                    
                    $('.zleceniodawca_pesel_b').val(array[4]);
                    $('.zleceniodawca_pesel_b').attr('value', array[4]);

                    $('.zleceniodawca_seria_i_numer_dowodu_b').val(array[5]);
                    $('.zleceniodawca_seria_i_numer_dowodu_b').attr('value', array[5]);
                    
                } else if (array[14] == '1') {
                    $('.zleceniodawca_wiek_b').val(array[13]);
                    $('.zleceniodawca_wiek_b').attr('value', array[13]);
                    
                    $('.zleceniodawca_pesel_b').val(array[15]);
                    $('.zleceniodawca_pesel_b').attr('value', array[15]);

                    $('.zleceniodawca_seria_i_numer_dowodu_b').val(array[16]);
                    $('.zleceniodawca_seria_i_numer_dowodu_b').attr('value', array[16]);
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

function generuj_potwierdzenie_umowy_pdf() {
    $('.generuj_potwierdzenie_pdf').click(function () {

        var dokument_id = $(this).data('id_dokumentu');
        var umowa = $(this).data('nazwa_dokumentu');

        wyswietl_loader('Trwa generowanie PDF. Prosze czekać!!!');

        $.ajax({
            method: "POST",
            url: "ajax/akcje/ajax_generuj_potwierdzenie_do_umowy_pdf",
            data: {
                dokument_id: dokument_id,
                umowa: umowa
            }
        }).done(function (data) {
            var array = $.parseJSON(data);

            ukryj_loader();

            if (array[0] === '0') {
                wyswitl_powiadomienie('Brak szablonu do wskazanej umowy!!!', 0, 0);
                return false;
            } else {
                var downloadLink = document.createElement("a");

                downloadLink.href = 'wyswietl_pdf?dokument_id=' + dokument_id + '&potwierdzenie=1';

                window.open(downloadLink.href);
            }

        }).fail(function (ajaxContext) {
            document.getElementById("body_strona_r").innerHTML = ajaxContext.responseText;
        });

    });
}

function generuj_zgloszenie_pdf() {
    $('.generuj_zgloszenie_pdf').click(function () {


        var id_sprawy = $('#zakladki_tresc').data('id_sprawy');
        var potwierdzenie = $(this).data('potwierdzenie');

        if (id_sprawy == '' || id_sprawy == undefined) {
            id_sprawy = $(this).data('id_sprawy');
        }

        wyswietl_loader('Trwa generowanie PDF. Prosze czekać!!!');

        $.ajax({
            method: "POST",
            url: "ajax/akcje/ajax_generuj_szkode",
            data: {
                id_sprawy: id_sprawy,
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


                downloadLink.href = 'wyswietl_pdf?id_sprawy=' + id_sprawy + '&umowa=0' + '&potwierdzenie=' + potwierdzenie;

                window.open(downloadLink.href);
            }

            zeruj_licznik_sesji_po_wykonaniu_funkcji();

        }).fail(function (ajaxContext) {
            document.getElementById("body_strona_r").innerHTML = ajaxContext.responseText;
        });

    });
}

function generuj_umowe_pdf_z_listy() {
    $('.generuj_umowe_pdf_z_listy').click(function () {


        var id_sprawy = $('#umowa_z_listy').data('id_dokumentu');
        var id_umowy = $('.generuj_umowe').data('id_umowa');


        wyswietl_loader('Trwa generowanie PDF. Prosze czekać!!!');

        $.ajax({
            method: "POST",
            url: "ajax/akcje/ajax_generuj_umowe",
            data: {
                id_sprawy: id_sprawy,
                id_umowy: id_umowy,
                id_uprawnionego: id_uprawnionego

            }
        }).done(function (data) {
            var array = $.parseJSON(data);

            ukryj_loader();

            if (array[0] === '0') {
                wyswitl_powiadomienie('Brak szablonu!!!', 0, 0);
                return false;
            } else {

                var downloadLink = document.createElement("a");

                downloadLink.href = 'wyswietl_pdf?id_sprawy=' + id_sprawy + '&umowa=1';

                window.open(downloadLink.href);
            }

        }).fail(function (ajaxContext) {
            document.getElementById("body_strona_r").innerHTML = ajaxContext.responseText;
        });

    });
}



function generuj_umowe_pdf() {
    $('.generuj_umowe_pdf').click(function () {


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

    });
}

function generuj_deklaracja_przedstawiciela_pdf() {
    $('.generuj_deklaracja_przedstawiciela_pdf').click(function () {
        var uzytkownik_id = $('#uzytkownik_id').data('uzytkownik_id');
        var id_sprawy = $(this).data('id_sprawy');

        wyswietl_loader('Trwa generowanie PDF. Prosze czekać!!!');

        $.ajax({
            method: "POST",
            url: "ajax/akcje/ajax_generuj_deklaracja_przedstawiciela",
            data: {
                uzytkownik_id: uzytkownik_id,
                id_sprawy: id_sprawy

            }
        }).done(function (data) {
            var array = $.parseJSON(data);

            ukryj_loader();

            if (array[0] === '0') {
                wyswitl_powiadomienie('Brak szablonu!!!', 0, 0);
                return false;
            } else {

                var downloadLink = document.createElement("a");

                downloadLink.href = 'wyswietl_pdf?id_sprawy=' + id_sprawy + '&deklaracja_przedstawiciela=1';

                window.open(downloadLink.href);
            }

            zeruj_licznik_sesji_po_wykonaniu_funkcji();

        }).fail(function (ajaxContext) {
            document.getElementById("body_strona_r").innerHTML = ajaxContext.responseText;
        });
    });
}





function generuj_pelnomocnictwo_kairp_pdf() {
    $('.generuj_pelnomocnictwo_kairp_pdf').click(function () {
        var id_sprawy = $(this).data('id_sprawy');

        wyswietl_loader('Trwa generowanie PDF. Prosze czekać!!!');

        $.ajax({
            method: "POST",
            url: "ajax/akcje/ajax_generuj_pelnomocnictwo_kairp",
            data: {
                id_sprawy: id_sprawy

            }
        }).done(function (data) {
            var array = $.parseJSON(data);

            ukryj_loader();

            if (array[0] === '0') {
                wyswitl_powiadomienie('Brak szablonu!!!', 0, 0);
                return false;
            } else {

                var downloadLink = document.createElement("a");

                downloadLink.href = 'wyswietl_pdf?id_sprawy=' + id_sprawy + '&pelnomocnictwo_kairp=1';

                window.open(downloadLink.href);
            }

            zeruj_licznik_sesji_po_wykonaniu_funkcji();

        }).fail(function (ajaxContext) {
            document.getElementById("body_strona_r").innerHTML = ajaxContext.responseText;
        });
    });
}

function generuj_pelnomocnictwo_votum_pdf() {
    $('.generuj_pelnomocnictwo_votum_pdf').click(function () {
        var id_sprawy = $(this).data('id_sprawy');

        wyswietl_loader('Trwa generowanie PDF. Prosze czekać!!!');

        $.ajax({
            method: "POST",
            url: "ajax/akcje/ajax_generuj_pelnomocnictwo_votum",
            data: {
                id_sprawy: id_sprawy

            }
        }).done(function (data) {
            var array = $.parseJSON(data);

            ukryj_loader();

            if (array[0] === '0') {
                wyswitl_powiadomienie('Brak szablonu!!!', 0, 0);
                return false;
            } else {

                var downloadLink = document.createElement("a");

                downloadLink.href = 'wyswietl_pdf?id_sprawy=' + id_sprawy + '&pelnomocnictwo_votum=1';

                window.open(downloadLink.href);
            }

            zeruj_licznik_sesji_po_wykonaniu_funkcji();

        }).fail(function (ajaxContext) {
            document.getElementById("body_strona_r").innerHTML = ajaxContext.responseText;
        });
    });
}

function generuj_pelnomocnictwo_bankowe_votum_pdf() {
    $('.generuj_pelnomocnictwo_bankowe_votum_pdf').click(function () {
	
	var id_sprawy = $(this).data('id_sprawy');
	var id_umowy = $(this).data('id_umowa');
	
        wyswietl_loader('Trwa generowanie PDF. Prosze czekać!!!');

        $.ajax({
            method: "POST",
            url: "ajax/akcje/ajax_generuj_pelnomocnictwo_bankowe_votum",
            data: {
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

                downloadLink.href = 'wyswietl_pdf?id_sprawy=' + id_sprawy + '&pelnomocnictwo_bankowe_votum=1';

                window.open(downloadLink.href);
            }

            zeruj_licznik_sesji_po_wykonaniu_funkcji();

        }).fail(function (ajaxContext) {
            document.getElementById("body_strona_r").innerHTML = ajaxContext.responseText;
        });
    });
}

function generuj_pouczenie_o_prawie_odstapienia_od_umowy_pdf() {
    $('.generuj_pouczenie_o_prawie_odstapienia_od_umowy_pdf').click(function () {
        var id_sprawy = $(this).data('id_sprawy');

        wyswietl_loader('Trwa generowanie PDF. Prosze czekać!!!');

        $.ajax({
            method: "POST",
            url: "ajax/akcje/ajax_generuj_pouczenie_o_prawie_odstapienia_od_umowy",
            data: {
                id_sprawy: id_sprawy

            }
        }).done(function (data) {
            var array = $.parseJSON(data);

            ukryj_loader();

            if (array[0] === '0') {
                wyswitl_powiadomienie('Brak szablonu!!!', 0, 0);
                return false;
            } else {

                var downloadLink = document.createElement("a");

                downloadLink.href = 'wyswietl_pdf?id_sprawy=' + id_sprawy + '&pouczenie_o_odstapieniu_od_umowy=1';

                window.open(downloadLink.href);
            }

            zeruj_licznik_sesji_po_wykonaniu_funkcji();

        }).fail(function (ajaxContext) {
            document.getElementById("body_strona_r").innerHTML = ajaxContext.responseText;
        });
    });
}


function klient() {
    $('#klient').click(function () {

        $(document).find('.element_do_wyboru').removeClass('aktywny');
        $(this).addClass('aktywny');
        $.ajax({
                method: "POST",
                url: "ajax/ajax_klient",
            })
            .done(function (html) {
                document.getElementById("body_strona_r").innerHTML = html;

                dodaj_klienta();
                lista_klientow();
                edytuj_klienta();

                zeruj_licznik_sesji_po_wykonaniu_funkcji();

            }).fail(function (ajaxContext) {
                document.getElementById("body_strona_r").innerHTML = ajaxContext.responseText;
            });
    });
}

function lista_umow() {
    $('#lista_umow').click(function () {

        $(document).find('.element_do_wyboru').removeClass('aktywny');
        $(this).addClass('aktywny');
        $.ajax({
                method: "POST",
                url: "ajax/ajax_lista_umow",
            })
            .done(function (html) {
                document.getElementById("body_strona_r").innerHTML = html;

                $('.rozwin').click(function () {


                    if ($(this).hasClass('rozwiniety')) {
                        $('.tabelka_wiersz').removeClass('tabelka_wiersz_hover');
                        $('.rozwin').removeClass('rozwiniety');
                        $('.tabelka_wiersz_lista_dokumentow').slideUp();
                    } else {
                        $('.tabelka_wiersz').removeClass('tabelka_wiersz_hover');
                        $('.rozwin').removeClass('rozwiniety');
                        $('.tabelka_wiersz_lista_dokumentow').slideUp();
                        $(this).addClass('rozwiniety');
                        $(this).parent().parent().find('.tabelka_wiersz_lista_dokumentow').slideDown();
                        $(this).parent().parent().addClass('tabelka_wiersz_hover');
                    }
                });

                generuj_zgloszenie_pdf();
                generuj_umowe_pdf();

                umowa_edytuj();
                umowa_usun();
                zeruj_licznik_sesji_po_wykonaniu_funkcji();

                /*kamyk 2016-08-23*/
                generuj_pouczenie_o_prawie_odstapienia_od_umowy_pdf();

                /*kamyk 2016-08-23*/
                generuj_pelnomocnictwo_votum_pdf();
                generuj_pelnomocnictwo_bankowe_votum_pdf();
                generuj_pelnomocnictwo_kairp_pdf();
                generuj_deklaracja_przedstawiciela_pdf();
                generuj_drukuj_wszystko_pdf();

            }).fail(function (ajaxContext) {
                document.getElementById("body_strona_r").innerHTML = ajaxContext.responseText;
            });
    });
}

function poszkodowany_inny() {
    $('.poszkodowany_inny .kratka').click(function () {
        $('.dzialajacy_w_imieniu_formularz').find('.kratka').removeClass('zaznaczone');
        $(this).addClass('zaznaczone');
        $('.poszkodowany_dane_formularz').slideDown();

        $('.poszkodowany_dane_formularz input').val('');
        $('.poszkodowany_dane_formularz input').removeAttr('value');

        $('.poszkodowany_dane_formularz div').removeClass('zablokowane_pole');

    });
}

function poszkodowany_klient() {
    $('.poszkodowany_klient .kratka').click(function () {
        $('.dzialajacy_w_imieniu_formularz').find('.kratka').removeClass('zaznaczone');
        $(this).addClass('zaznaczone');
        $('.poszkodowany_dane_formularz').slideUp();

        $('.poszkodowany_dane_formularz input').val('');
        $('.poszkodowany_dane_formularz input').removeAttr('value');

        $('.poszkodowany_dane_formularz div').removeClass('zablokowane_pole');
    });
}

function adres_do_korespondencji() {
    $('.korespondencja .kratka').click(function () {
        if ($(this).hasClass('zaznaczone')) {
            $(this).removeClass('zaznaczone');
            $('.adres_kor_form').slideDown();
            $('.zleceniodawca_ulica_kor').val('');
            $('.zleceniodawca_nr_domu_kor').val('');
            $('.zleceniodawca_nr_mieszkania_kor').val('');
            $('.zleceniodawca_kod_pocztowy_kor').val('');
            $('.zleceniodawca_miejscowosc_kor').val('');
            $('.zleceniodawca_adres_kor_form').attr('data-adres_kor_id', '');
            $('.zleceniodawca_adres_kor_form').data('adres_kor_id', '');
        } else {
            $(this).addClass('zaznaczone');
            $('.adres_kor_form').slideUp();

            var sprawa_adres_korespondencja_id = $('.zleceniodawca_adres_kor_form').data('adres_kor_id');
            var sprawa_adres_zameldowania_id = $('.zleceniodawca_adres_kor_form').data('adres_zam_id');
            var klient_id = $('.sprawa_klient_dane').data('klient_id');

            sprawa_adres_kor_usun(klient_id, sprawa_adres_korespondencja_id, sprawa_adres_zameldowania_id);

        }
    });
}

function sprawa_adres_kor_usun(klient_id, sprawa_adres_korespondencja_id, sprawa_adres_zameldowania_id) {
    $.ajax({
        method: "POST",
        url: "ajax/akcje/ajax_sprawa_adres_kor_usun",
        data: {
            klient_id: klient_id,
            sprawa_adres_korespondencja_id: sprawa_adres_korespondencja_id,
            sprawa_adres_zameldowania_id: sprawa_adres_zameldowania_id
        }
    }).done(function () {

        $('.zleceniodawca_adres_kor_form').attr('data-adres_kor_id', '');
        $('.zleceniodawca_adres_kor_form').data('adres_kor_id', '');

    }).fail(function (ajaxContext) {
        document.getElementById("body_strona_r").innerHTML = ajaxContext.responseText;
    });
}

function uprawniony_formularz() {
    $('.uprawniony_formularz_kratka .kratka').click(function () {
        if ($(this).hasClass('zaznaczone')) {
            $(this).removeClass('zaznaczone');
            $('.uprawniony_formularz_formularz').slideUp();
            $('.adres_kor_form').slideDown();
            $('.uprawniony_imie').val('');
            $('.uprawniony_nazwisko').val('');
            $('.uprawniony_ulica').val('');
            $('.uprawniony_nr_domu').val('');
            $('.uprawniony_nr_mieszkania').val('');
            $('.uprawniony_kod_pocztowy').val('');
            $('.uprawniony_miejscowosc').val('');
            $('.uprawniony_pesel').val('');
            $('.uprawniony_seria_i_numer_dowodu').val('');
            $('.uprawniony_email').val('');
            $('.uprawniony_telefon').val('');


            var id_sprawy = $('#zakladki_tresc').data('id_sprawy');
            kratka_zapisz_zmiane('sprawa', id_sprawy, 'sprawa_uprawniony_id', 'null');

        } else {
            $(this).addClass('zaznaczone');
            $('.uprawniony_formularz_formularz').slideDown();
        }
    });
}

function uprawniony_do_informacji_formularz() {
    $('.uprawniony_do_informacji_kratka .kratka').click(function () {
        if ($(this).hasClass('zaznaczone')) {
            $(this).removeClass('zaznaczone');
            $('.uprawniony_informacje_formularz_formularz').slideUp();
            $('.uprawniony_informacje_imie').val('');
            $('.uprawniony_informacje_nazwisko').val('');
            $('.uprawniony_informacje_pesel').val('');

            var id_sprawy = $('#zakladki_tresc').data('id_sprawy');
            kratka_zapisz_zmiane('sprawa', id_sprawy, 'sprawa_uprawniony_do_inf_id', 'null');
        } else {
            $(this).addClass('zaznaczone');
            $('.uprawniony_informacje_formularz_formularz').slideDown();
        }
    });
}

function uzupelnij_dane_umowy_z_poszkodowanym_na_podstawie_wybranej_z_listy() {
    $('.lista_umow_opcje').change(function () {


        var id_umowy = $('.lista_umow_opcje option:selected').attr('id');

        if (id_umowy == '0') {
            $('.poszkodowany_dane_formularz input').val('');
            $('.poszkodowany_dane_formularz input').removeAttr('value');

            $('.poszkodowany_dane_formularz div').removeClass('zablokowane_pole');
            $('.dzialajacy_w_imieniu_kratka').removeClass('zaznaczone');
            $('.poszkodowany_dane_formularz').slideUp();
            $('.druk_zgloszenia_szkody_strona').hide();
            return false;
        }

        $('.druk_zgloszenia_szkody_strona').show();

        $.ajax({
                method: "POST",
                url: "ajax/akcje/ajax_pobierz_umowe_z_poszkodowanym_po_id",
                data: {
                    id_umowy: id_umowy
                }
            })
            .done(function (data) {

                var array = $.parseJSON(data);

                $('.zleceniodawca_imie').val(array[1]);
                $('.zleceniodawca_imie').attr('value', array[1]);

                $('.zleceniodawca_nazwisko').val(array[2]);
                $('.zleceniodawca_nazwisko').attr('value', array[2]);

                $('.zleceniodawca_ulica').val(array[3]);
                $('.zleceniodawca_ulica').attr('value', array[3]);

                $('.zleceniodawca_nr_domu').val(array[4]);
                $('.zleceniodawca_nr_domu').attr('value', array[4]);

                $('.zleceniodawca_nr_mieszkania').val(array[5]);
                $('.zleceniodawca_nr_mieszkania').attr('value', array[5]);

                $('.zleceniodawca_kod_pocztowy').val(array[6]);
                $('.zleceniodawca_kod_pocztowy').attr('value', array[6]);

                $('.zleceniodawca_miejscowosc').val(array[7]);
                $('.zleceniodawca_miejscowosc').attr('value', array[7]);

                $('.zleceniodawca_pesel').val(array[8]);
                $('.zleceniodawca_pesel').attr('value', array[8]);

                $('.zleceniodawca_data_wypadku').val(array[9]);
                $('.zleceniodawca_data_wypadku').attr('value', array[9]);

                $('.ou_data_wypadku').val(array[9]);
                $('.ou_data_wypadku').attr('value', array[9]);

                $('.zleceniodawca_data_urodzenia').val(array[10]);
                $('.zleceniodawca_data_urodzenia').attr('value', array[10]);

                $('.zleceniodawca_wiek').val(array[11]);
                $('.zleceniodawca_wiek').attr('value', array[11]);

                $('.zleceniodawca_seria_i_numer_dowodu').val(array[12]);
                $('.zleceniodawca_seria_i_numer_dowodu').attr('value', array[12]);

                $('.zleceniodawca_email').val(array[13]);
                $('.zleceniodawca_email').attr('value', array[13]);

                $('.zleceniodawca_telefon').val(array[14]);
                $('.zleceniodawca_telefon').attr('value', array[14]);

                if (array[15] == '0') {
                    $('.poszkodowany_klient_dzialajacy_w_imieniu').hide();
                    $('.dzialajacy_w_imieniu_kratka').attr('data-id_reprezentowany', array[15]);
                    $('.dzialajacy_w_imieniu_kratka').data('id_reprezentowany', array[15]);
                } else {
                    $('.poszkodowany_klient_dzialajacy_w_imieniu').show();
                    $('.dzialajacy_w_imieniu_kratka').attr('data-id_reprezentowany', array[15]);
                    $('.dzialajacy_w_imieniu_kratka').data('id_reprezentowany', array[15]);
                }

                $('.dane_wypadku_data_wypadku').addClass('zablokowane_pole');

                $('.data_wypadku').val(array[9]);
                $('.data_wypadku').attr('value', array[9]);

                $('.strona_zgloszenia').removeClass('aktywna');
                $('.druk_zgloszenia_szkody_strona_str_1').show();
                $('.druk_zgloszenia_szkody_strona_str_1').addClass('aktywna');
                $('.str_1').slideDown();

            }).fail(function (ajaxContext) {
                document.getElementById("body_strona_r").innerHTML = ajaxContext.responseText;
            });

    });
}

function uzupelnij_dane_umowy_na_podstawie_wybranej_z_listy() {
    $('.lista_umow_opcje').change(function () {


        var id_umowy = $('.lista_umow_opcje option:selected').attr('id');


        $.ajax({
                method: "POST",
                url: "ajax/akcje/ajax_pobierz_umowe_po_id",
                data: {
                    id_umowy: id_umowy
                }
            })
            .done(function (data) {

                var array = $.parseJSON(data);

                $('.zleceniodawca_imie').val(array[1]);
                $('.zleceniodawca_imie').attr('value', array[1]);

                $('.zleceniodawca_nazwisko').val(array[2]);
                $('.zleceniodawca_nazwisko').attr('value', array[2]);

                $('.zleceniodawca_ulica').val(array[3]);
                $('.zleceniodawca_ulica').attr('value', array[3]);

                $('.zleceniodawca_nr_domu').val(array[4]);
                $('.zleceniodawca_nr_domu').attr('value', array[4]);

                $('.zleceniodawca_nr_mieszkania').val(array[5]);
                $('.zleceniodawca_nr_mieszkania').attr('value', array[5]);

                $('.zleceniodawca_kod_pocztowy').val(array[6]);
                $('.zleceniodawca_kod_pocztowy').attr('value', array[6]);

                $('.zleceniodawca_miejscowosc').val(array[7]);
                $('.zleceniodawca_miejscowosc').attr('value', array[7]);

                $('.zleceniodawca_pesel').val(array[8]);
                $('.zleceniodawca_pesel').attr('value', array[8]);

                $('.zleceniodawca_data_wypadku').val(array[9]);
                $('.zleceniodawca_data_wypadku').attr('value', array[9]);

                $('.zleceniodawca_data_urodzenia').val(array[10]);
                $('.zleceniodawca_data_urodzenia').attr('value', array[10]);

                if (id_umowy != undefined) {
                    $('.zleceniodawca_formularz_tr_cala').slideDown();
                } else {
                    $('.zleceniodawca_formularz_tr_cala').slideUp();
                }



            }).fail(function (ajaxContext) {
                document.getElementById("body_strona_r").innerHTML = ajaxContext.responseText;
            });

    });
}

function klient_szczegoly_odblokuj_do_edycji() {
    $('.klient_szczegoly_opcje_edytuj').click(function () {
        $('.zablokowane_pole').removeClass('zablokowane_pole');
        $('#klient_zapisz_zmiany').show();
        $('.obcokrajowiec').show();
    });
}

function edytuj_klienta() {
    $('.edytuj_klienta').click(function () {

        var klient_id = $(this).parent().parent().find('.tabelka_id').text();

        edytuj_klienta_szczegoly(klient_id);
    });
}

function edytuj_klienta_szczegoly(klient_id) {
    $('.zakladki_element').removeClass('aktywna');
    $('.szczegoly_klienta').addClass('aktywna');
    $.ajax({
        method: "POST",
        url: "ajax/widoki/ajax_edytuj_klienta",
        data: {
            klient_id: klient_id
        }
    }).done(function (data) {

        document.getElementById("zakladki_tresc").innerHTML = data;

        $('input').keyup(function () {
            var wartosc = $(this).val();

            $(this).attr('value', wartosc);
        });

        klient_szczegoly_odblokuj_do_edycji();

        $('.kratka').click(function () {
            if (!$(this).hasClass('zaznaczone')) {
                $('.obcokrajowiec .kratka').removeClass('zaznaczone');
                $(this).addClass('zaznaczone');

                $('.obcokrajowiec_dane_dok').hide();

                if ($(this).hasClass('tak')) {
                    $('.dane_identyfikacyjne_obcokrajowca').show();
                }

                if ($(this).hasClass('nie')) {
                    $('.dane_identyfikacyjne').show();
                }
            }
        });

        klient_zapisz_zmiany();

    }).fail(function (ajaxContext) {
        document.getElementById("body_strona_r").innerHTML = ajaxContext.responseText;
    });
}

function klient_zapisz_zmiany() {
    $('#klient_zapisz_zmiany').click(function () {

        var zleceniodawca_id = $('.zleceniodawca_formularz_naglowek').data('klient_id');

        var zleceniodawca_imie = $('.zleceniodawca_imie').val();
        var zleceniodawca_nazwisko = $('.zleceniodawca_nazwisko').val();

        var zleceniodawca_ulica = $('.zleceniodawca_ulica').val();
        var zleceniodawca_nr_domu = $('.zleceniodawca_nr_domu').val();
        var zleceniodawca_nr_mieszkania = $('.zleceniodawca_nr_mieszkania').val();
        var zleceniodawca_kod_pocztowy = $('.zleceniodawca_kod_pocztowy').val();
        var zleceniodawca_miejscowosc = $('.zleceniodawca_miejscowosc').val();

        var zleceniodawca_dokument = $('.poszkodowany_dokument').val();
        var zleceniodawca_numer_dokumentu = $('.poszkodowany_numer_dokumentu').val();
        var zleceniodawca_pesel = $('.zleceniodawca_pesel').val();
        var zleceniodawca_seria_i_numer_dowodu = $('.zleceniodawca_seria_i_numer_dowodu').val();

        var zleceniodawca_czy_obcokrajowiec;

        if (zleceniodawca_imie == '' || zleceniodawca_nazwisko == '' || zleceniodawca_ulica == '' ||
            zleceniodawca_nr_domu == '' || zleceniodawca_kod_pocztowy == '' ||
            zleceniodawca_miejscowosc == '') {

            wyswitl_powiadomienie('Uzupełnij wszystkie pola!!!', 0, 0);
            return false;
        }

        if ($('.kratka.nie').hasClass('zaznaczone')) {

            if (zleceniodawca_pesel == '' || zleceniodawca_seria_i_numer_dowodu == '') {
                wyswitl_powiadomienie('Uzupełnij PESEL i NUMER DOWODU!!!', 0, 0);
                return false;
            }

            zleceniodawca_czy_obcokrajowiec = '0';
            zleceniodawca_dokument = '';
            zleceniodawca_numer_dokumentu = '';
        }

        if ($('.kratka.tak').hasClass('zaznaczone')) {
            if (zleceniodawca_dokument == '' || zleceniodawca_numer_dokumentu == '') {
                wyswitl_powiadomienie('Uzupełnij RODZAJ i NUMER DOKUMENTU!!!', 0, 0);
                return false;
            }

            zleceniodawca_czy_obcokrajowiec = '1';
            zleceniodawca_pesel = '';
            zleceniodawca_seria_i_numer_dowodu = '';
        }

        var zleceniodawca_email = $('.zleceniodawca_email').val();
        var zleceniodawca_telefon = $('.zleceniodawca_telefon').val();


        $.ajax({
            method: "POST",
            url: "ajax/akcje/ajax_edytuj_klienta_do_bazy",
            data: {
                zleceniodawca_id: zleceniodawca_id,
                zleceniodawca_imie: zleceniodawca_imie,
                zleceniodawca_nazwisko: zleceniodawca_nazwisko,
                zleceniodawca_ulica: zleceniodawca_ulica,
                zleceniodawca_nr_domu: zleceniodawca_nr_domu,
                zleceniodawca_nr_mieszkania: zleceniodawca_nr_mieszkania,
                zleceniodawca_kod_pocztowy: zleceniodawca_kod_pocztowy,
                zleceniodawca_miejscowosc: zleceniodawca_miejscowosc,
                zleceniodawca_dokument: zleceniodawca_dokument,
                zleceniodawca_numer_dokumentu: zleceniodawca_numer_dokumentu,
                zleceniodawca_pesel: zleceniodawca_pesel,
                zleceniodawca_seria_i_numer_dowodu: zleceniodawca_seria_i_numer_dowodu,
                zleceniodawca_czy_obcokrajowiec: zleceniodawca_czy_obcokrajowiec,
                zleceniodawca_email: zleceniodawca_email,
                zleceniodawca_telefon: zleceniodawca_telefon
            }
        }).done(function () {

            edytuj_klienta_szczegoly(zleceniodawca_id);
            wyswitl_powiadomienie('Zmiany zostały zapisane!!!', 1, 0);

        }).fail(function (ajaxContext) {
            document.getElementById("body_strona_r").innerHTML = ajaxContext.responseText;
        });

    });
}

function umowa_zapisz_do_bazy() {
    $('#umowa_zapisz_umowe').click(function () {
        var nazwa_umowy = $('#nazwa_umowy').data('nazwa_umowy');


        var zleceniodawca_imie = $('.zleceniodawca_imie').val();
        var zleceniodawca_nazwisko = $('.zleceniodawca_nazwisko').val();
        var zleceniodawca_nr_domu = $('.zleceniodawca_nr_domu').val();
        var zleceniodawca_nr_mieszkania = $('.zleceniodawca_nr_mieszkania').val();
        var zleceniodawca_kod_pocztowy = $('.zleceniodawca_kod_pocztowy').val();
        var zleceniodawca_miejscowosc = $('.zleceniodawca_miejscowosc').val();
        var zleceniodawca_pesel = $('.zleceniodawca_pesel').val();
        var zleceniodawca_seria_i_numer_dowodu = $('.zleceniodawca_seria_i_numer_dowodu').val();
        var zleceniodawca_email = $('.zleceniodawca_email').val();
        var zleceniodawca_telefon = $('.zleceniodawca_telefon').val();
        var zleceniodawca_ulica = $('.zleceniodawca_ulica').val();

        var dzialajacy_w_imieniu = $('.select_dzialajacy_w_imieniu').val();

        var zleceniodawca_w_imienu_imie = $('.zleceniodawca_w_imienu_imie').val();
        var zleceniodawca_w_imienu_nazwisko = $('.zleceniodawca_w_imienu_nazwisko').val();
        var zleceniodawca_w_imienu_ulica = $('.zleceniodawca_w_imienu_ulica').val();
        var zleceniodawca_w_imienu_nr_domu = $('.zleceniodawca_w_imienu_nr_domu').val();
        var zleceniodawca_w_imienu_nr_mieszkania = $('.zleceniodawca_w_imienu_nr_mieszkania').val();
        var zleceniodawca_w_imienu_kod_pocztowy = $('.zleceniodawca_w_imienu_kod_pocztowy').val();
        var zleceniodawca_w_imienu_miejscowosc = $('.zleceniodawca_w_imienu_miejscowosc').val();
        var zleceniodawca_w_imienu_pesel = $('.zleceniodawca_w_imienu_pesel').val();
        var zleceniodawca_w_imienu_seria_i_numer_dowodu = $('.zleceniodawca_w_imienu_seria_i_numer_dowodu').val();

        var select_wynagrodzenie = $('.select_wynagrodzenie').val();

        var wynagrodzenie_nr_rachunku_bankowego = $('.wynagrodzenie_nr_rachunku_bankowego').val();
        var wynagrodzenie_zleceniodawca_imie = $('.wynagrodzenie_zleceniodawca_imie').val();
        var wynagrodzenie_zleceniodawca_nazwisko = $('.wynagrodzenie_zleceniodawca_nazwisko').val();
        var wynagrodzenie_zleceniodawca_ulica = $('.wynagrodzenie_zleceniodawca_ulica').val();
        var wynagrodzenie_zleceniodawca_nr_domu = $('.wynagrodzenie_zleceniodawca_nr_domu').val();
        var wynagrodzenie_zleceniodawca_nr_mieszkania = $('.wynagrodzenie_zleceniodawca_nr_mieszkania').val();
        var wynagrodzenie_zleceniodawca_kod_pocztowy = $('.wynagrodzenie_zleceniodawca_kod_pocztowy').val();
        var wynagrodzenie_zleceniodawca_miejscowosc = $('.wynagrodzenie_zleceniodawca_miejscowosc').val();

        var data_wypadku = $('.data_wypadku').val();
        var wynagrodzenie_procent = $('.wynagrodzenie_procent').val();

        var smierc_osoby = $('.smierc_osoby').val();

        var zgoda_na_pcrf = 0;

        if ($('.zgoda_pcrf .kratka').hasClass('zaznaczone')) {
            zgoda_na_pcrf = 1;
        }

        if (zleceniodawca_imie == '' || zleceniodawca_nazwisko == '' ||
            zleceniodawca_nr_domu == '' || zleceniodawca_nr_mieszkania == '' ||
            zleceniodawca_kod_pocztowy == '' || zleceniodawca_miejscowosc == '' ||
            zleceniodawca_pesel == '' || zleceniodawca_seria_i_numer_dowodu == '' ||
            zleceniodawca_email == '' || zleceniodawca_telefon == '' || zleceniodawca_ulica == '') {
            wyswitl_powiadomienie('Wybierz klienta z listy!!!', 0, 0);
            return false;
        }

        if (dzialajacy_w_imieniu == 'Wybierz') {
            wyczysc_pola_input_dzialajacy_w_imieniu();
        } else {
            if (zleceniodawca_w_imienu_imie == '' || zleceniodawca_w_imienu_nazwisko == '' ||
                zleceniodawca_w_imienu_ulica == '' || zleceniodawca_w_imienu_nr_domu == '' ||
                zleceniodawca_w_imienu_nr_mieszkania == '' || zleceniodawca_w_imienu_kod_pocztowy == '' ||
                zleceniodawca_w_imienu_miejscowosc == '' || zleceniodawca_w_imienu_pesel == '' ||
                zleceniodawca_w_imienu_seria_i_numer_dowodu == '') {
                wyswitl_powiadomienie('Uzupełnij wszystkie pola!!!', 0, 0);
                return false;
            }
        }

        if (select_wynagrodzenie == 'Na rachunek bankowy') {
            if (wynagrodzenie_nr_rachunku_bankowego == '') {
                wyswitl_powiadomienie('Wprowadź numer rachunku!!!', 0, 0);
                return false;
            }
            if (wynagrodzenie_zleceniodawca_imie == '' || wynagrodzenie_zleceniodawca_nazwisko == '' ||
                wynagrodzenie_zleceniodawca_ulica == '' || wynagrodzenie_zleceniodawca_nr_domu == '' ||
                wynagrodzenie_zleceniodawca_nr_mieszkania == '' || wynagrodzenie_zleceniodawca_kod_pocztowy == '' ||
                wynagrodzenie_zleceniodawca_miejscowosc == '') {
                wyswitl_powiadomienie('Uzupełnij wszystkie pola!!!', 0, 0);
                return false;
            }
        } else if (select_wynagrodzenie == 'Przekazem pocztowym') {
            if (wynagrodzenie_zleceniodawca_imie == '' || wynagrodzenie_zleceniodawca_nazwisko == '' ||
                wynagrodzenie_zleceniodawca_ulica == '' || wynagrodzenie_zleceniodawca_nr_domu == '' ||
                wynagrodzenie_zleceniodawca_nr_mieszkania == '' || wynagrodzenie_zleceniodawca_kod_pocztowy == '' ||
                wynagrodzenie_zleceniodawca_miejscowosc == '') {
                wyswitl_powiadomienie('Uzupełnij wszystkie pola!!!', 0, 0);
                return false;
            }
        } else if (select_wynagrodzenie == 'Wybierz') {
            $('.wynagrodzenie_nr_rachunku_bankowego').val('');
            $('.wynagrodzenie_nr_rachunku_bankowego').removeAttr('value');
            $('.kopiuj_adres_zleceniodawcy').removeClass('zaznaczone');
            odblokuj_pola_do_edycji_odbiorca();
            wyczysc_pola_input();
        }

        if ($('.zleceniodawca_w_imienu_kod_pocztowy').hasClass('kod_niepoprawny') ||
            $('.zleceniodawca_w_imienu_pesel').hasClass('pesel_niepoprawny') ||
            $('.zleceniodawca_w_imienu_seria_i_numer_dowodu').hasClass('dowod_niepoprawny') ||
            $('.wynagrodzenie_nr_rachunku_bankowego').hasClass('numer_rachunku_niepoprawny')) {
            wyswitl_powiadomienie('Popraw błędy w formularzu!!!', 0, 0);
            return false;
        }

        if (data_wypadku == '') {
            wyswitl_powiadomienie('Podaj date wypadku!!!', 0, 0);
            return false;
        }

        if (wynagrodzenie_procent == '') {
            wyswitl_powiadomienie('Uzupełnij pole wynagrodzenie!!!', 0, 0);
            return false;
        }

        if (select_wynagrodzenie == 'Wybierz') {
            wyswitl_powiadomienie('Wybierz sposób w jaki mają być przekazane uzyskane świadczenia!!!', 0, 0);
            return false;
        }

        $.ajax({
            method: "POST",
            url: "formularze_dokumenty/akcje/ajax_umowa_zapisz_do_bazy",
            data: {

                nazwa_umowy: nazwa_umowy,
                zleceniodawca_imie: zleceniodawca_imie,
                zleceniodawca_nazwisko: zleceniodawca_nazwisko,
                zleceniodawca_nr_domu: zleceniodawca_nr_domu,
                zleceniodawca_nr_mieszkania: zleceniodawca_nr_mieszkania,
                zleceniodawca_kod_pocztowy: zleceniodawca_kod_pocztowy,
                zleceniodawca_miejscowosc: zleceniodawca_miejscowosc,
                zleceniodawca_pesel: zleceniodawca_pesel,
                zleceniodawca_seria_i_numer_dowodu: zleceniodawca_seria_i_numer_dowodu,
                zleceniodawca_email: zleceniodawca_email,
                zleceniodawca_telefon: zleceniodawca_telefon,
                zleceniodawca_ulica: zleceniodawca_ulica,
                dzialajacy_w_imieniu: dzialajacy_w_imieniu,
                zleceniodawca_w_imienu_imie: zleceniodawca_w_imienu_imie,
                zleceniodawca_w_imienu_nazwisko: zleceniodawca_w_imienu_nazwisko,
                zleceniodawca_w_imienu_ulica: zleceniodawca_w_imienu_ulica,
                zleceniodawca_w_imienu_nr_domu: zleceniodawca_w_imienu_nr_domu,
                zleceniodawca_w_imienu_nr_mieszkania: zleceniodawca_w_imienu_nr_mieszkania,
                zleceniodawca_w_imienu_kod_pocztowy: zleceniodawca_w_imienu_kod_pocztowy,
                zleceniodawca_w_imienu_miejscowosc: zleceniodawca_w_imienu_miejscowosc,
                zleceniodawca_w_imienu_pesel: zleceniodawca_w_imienu_pesel,
                zleceniodawca_w_imienu_seria_i_numer_dowodu: zleceniodawca_w_imienu_seria_i_numer_dowodu,
                select_wynagrodzenie: select_wynagrodzenie,
                wynagrodzenie_nr_rachunku_bankowego: wynagrodzenie_nr_rachunku_bankowego,
                wynagrodzenie_zleceniodawca_imie: wynagrodzenie_zleceniodawca_imie,
                wynagrodzenie_zleceniodawca_nazwisko: wynagrodzenie_zleceniodawca_nazwisko,
                wynagrodzenie_zleceniodawca_ulica: wynagrodzenie_zleceniodawca_ulica,
                wynagrodzenie_zleceniodawca_nr_domu: wynagrodzenie_zleceniodawca_nr_domu,
                wynagrodzenie_zleceniodawca_nr_mieszkania: wynagrodzenie_zleceniodawca_nr_mieszkania,
                wynagrodzenie_zleceniodawca_kod_pocztowy: wynagrodzenie_zleceniodawca_kod_pocztowy,
                wynagrodzenie_zleceniodawca_miejscowosc: wynagrodzenie_zleceniodawca_miejscowosc,
                wynagrodzenie_procent: wynagrodzenie_procent,
                data_wypadku: data_wypadku,
                smierc_osoby: smierc_osoby,
                zgoda_na_pcrf: zgoda_na_pcrf
            }
        }).done(function (data) {

            var array = $.parseJSON(data);

            if (array[0] === '0') {
                wyswitl_powiadomienie('Brak umowy w bazie!!!', 0, 0);
                return false;
            }

            wyswitl_powiadomienie('Umowa została zapisana do bazy!!!', 1, 0);
            dokument_z();

        }).fail(function (ajaxContext) {
            document.getElementById("body_strona_r").innerHTML = ajaxContext.responseText;
        });
    });
}

function umowa_zapisz_edytuj_do_bazy() {
    $('#umowa_zapisz_edytuj_do_bazy').click(function () {
        var nazwa_umowy = $('#nazwa_umowy').data('nazwa_umowy');

        var umowa_id = $('#nazwa_umowy').data('umowa_id');

        var zleceniodawca_imie = $('.zleceniodawca_imie').val();
        var zleceniodawca_nazwisko = $('.zleceniodawca_nazwisko').val();
        var zleceniodawca_nr_domu = $('.zleceniodawca_nr_domu').val();
        var zleceniodawca_nr_mieszkania = $('.zleceniodawca_nr_mieszkania').val();
        var zleceniodawca_kod_pocztowy = $('.zleceniodawca_kod_pocztowy').val();
        var zleceniodawca_miejscowosc = $('.zleceniodawca_miejscowosc').val();
        var zleceniodawca_pesel = $('.zleceniodawca_pesel').val();
        var zleceniodawca_seria_i_numer_dowodu = $('.zleceniodawca_seria_i_numer_dowodu').val();
        var zleceniodawca_email = $('.zleceniodawca_email').val();
        var zleceniodawca_telefon = $('.zleceniodawca_telefon').val();
        var zleceniodawca_ulica = $('.zleceniodawca_ulica').val();

        var dzialajacy_w_imieniu = $('.select_dzialajacy_w_imieniu').val();

        var zleceniodawca_w_imienu_imie = $('.zleceniodawca_w_imienu_imie').val();
        var zleceniodawca_w_imienu_nazwisko = $('.zleceniodawca_w_imienu_nazwisko').val();
        var zleceniodawca_w_imienu_ulica = $('.zleceniodawca_w_imienu_ulica').val();
        var zleceniodawca_w_imienu_nr_domu = $('.zleceniodawca_w_imienu_nr_domu').val();
        var zleceniodawca_w_imienu_nr_mieszkania = $('.zleceniodawca_w_imienu_nr_mieszkania').val();
        var zleceniodawca_w_imienu_kod_pocztowy = $('.zleceniodawca_w_imienu_kod_pocztowy').val();
        var zleceniodawca_w_imienu_miejscowosc = $('.zleceniodawca_w_imienu_miejscowosc').val();
        var zleceniodawca_w_imienu_pesel = $('.zleceniodawca_w_imienu_pesel').val();
        var zleceniodawca_w_imienu_seria_i_numer_dowodu = $('.zleceniodawca_w_imienu_seria_i_numer_dowodu').val();

        var select_wynagrodzenie = $('.select_wynagrodzenie').val();

        var wynagrodzenie_nr_rachunku_bankowego = $('.wynagrodzenie_nr_rachunku_bankowego').val();
        var wynagrodzenie_zleceniodawca_imie = $('.wynagrodzenie_zleceniodawca_imie').val();
        var wynagrodzenie_zleceniodawca_nazwisko = $('.wynagrodzenie_zleceniodawca_nazwisko').val();
        var wynagrodzenie_zleceniodawca_ulica = $('.wynagrodzenie_zleceniodawca_ulica').val();
        var wynagrodzenie_zleceniodawca_nr_domu = $('.wynagrodzenie_zleceniodawca_nr_domu').val();
        var wynagrodzenie_zleceniodawca_nr_mieszkania = $('.wynagrodzenie_zleceniodawca_nr_mieszkania').val();
        var wynagrodzenie_zleceniodawca_kod_pocztowy = $('.wynagrodzenie_zleceniodawca_kod_pocztowy').val();
        var wynagrodzenie_zleceniodawca_miejscowosc = $('.wynagrodzenie_zleceniodawca_miejscowosc').val();

        var data_wypadku = $('.data_wypadku').val();
        var wynagrodzenie_procent = $('.wynagrodzenie_procent').val();
        var smierc_osoby = $('.smierc_osoby').val();

        var zgoda_na_pcrf = 0;

        if ($('.zgoda_pcrf .kratka').hasClass('zaznaczone')) {
            zgoda_na_pcrf = 1;
        }

        if (zleceniodawca_imie == '' || zleceniodawca_nazwisko == '' ||
            zleceniodawca_nr_domu == '' || zleceniodawca_nr_mieszkania == '' ||
            zleceniodawca_kod_pocztowy == '' || zleceniodawca_miejscowosc == '' ||
            zleceniodawca_pesel == '' || zleceniodawca_seria_i_numer_dowodu == '' ||
            zleceniodawca_email == '' || zleceniodawca_telefon == '' || zleceniodawca_ulica == '') {
            wyswitl_powiadomienie('Wybierz klienta z listy!!!', 0, 0);
            return false;
        }

        if (dzialajacy_w_imieniu == 'Wybierz') {
            wyczysc_pola_input_dzialajacy_w_imieniu();
        } else {
            if (zleceniodawca_w_imienu_imie == '' || zleceniodawca_w_imienu_nazwisko == '' ||
                zleceniodawca_w_imienu_ulica == '' || zleceniodawca_w_imienu_nr_domu == '' ||
                zleceniodawca_w_imienu_nr_mieszkania == '' || zleceniodawca_w_imienu_kod_pocztowy == '' ||
                zleceniodawca_w_imienu_miejscowosc == '' || zleceniodawca_w_imienu_pesel == '' ||
                zleceniodawca_w_imienu_seria_i_numer_dowodu == '') {
                wyswitl_powiadomienie('Uzupełnij wszystkie pola!!!', 0, 0);
                return false;
            }
        }

        if (select_wynagrodzenie == 'Na rachunek bankowy') {
            if (wynagrodzenie_nr_rachunku_bankowego == '') {
                wyswitl_powiadomienie('Wprowadź numer rachunku!!!', 0, 0);
                return false;
            }
            if (wynagrodzenie_zleceniodawca_imie == '' || wynagrodzenie_zleceniodawca_nazwisko == '' ||
                wynagrodzenie_zleceniodawca_ulica == '' || wynagrodzenie_zleceniodawca_nr_domu == '' ||
                wynagrodzenie_zleceniodawca_nr_mieszkania == '' || wynagrodzenie_zleceniodawca_kod_pocztowy == '' ||
                wynagrodzenie_zleceniodawca_miejscowosc == '') {
                wyswitl_powiadomienie('Uzupełnij wszystkie pola!!!', 0, 0);
                return false;
            }
        } else if (select_wynagrodzenie == 'Przekazem pocztowym') {
            if (wynagrodzenie_zleceniodawca_imie == '' || wynagrodzenie_zleceniodawca_nazwisko == '' ||
                wynagrodzenie_zleceniodawca_ulica == '' || wynagrodzenie_zleceniodawca_nr_domu == '' ||
                wynagrodzenie_zleceniodawca_nr_mieszkania == '' || wynagrodzenie_zleceniodawca_kod_pocztowy == '' ||
                wynagrodzenie_zleceniodawca_miejscowosc == '') {
                wyswitl_powiadomienie('Uzupełnij wszystkie pola!!!', 0, 0);
                return false;
            }
        } else if (select_wynagrodzenie == 'Wybierz') {
            $('.wynagrodzenie_nr_rachunku_bankowego').val('');
            $('.wynagrodzenie_nr_rachunku_bankowego').removeAttr('value');
            $('.kopiuj_adres_zleceniodawcy').removeClass('zaznaczone');
            odblokuj_pola_do_edycji_odbiorca();
            wyczysc_pola_input();
        }

        if ($('.zleceniodawca_w_imienu_kod_pocztowy').hasClass('kod_niepoprawny') ||
            $('.zleceniodawca_w_imienu_pesel').hasClass('pesel_niepoprawny') ||
            $('.zleceniodawca_w_imienu_seria_i_numer_dowodu').hasClass('dowod_niepoprawny') ||
            $('.wynagrodzenie_nr_rachunku_bankowego').hasClass('numer_rachunku_niepoprawny')) {
            wyswitl_powiadomienie('Popraw błędy w formularzu!!!', 0, 0);
            return false;
        }

        if (data_wypadku == '') {
            wyswitl_powiadomienie('Podaj date wypadku!!!', 0, 0);
            return false;
        }

        if (wynagrodzenie_procent == '') {
            wyswitl_powiadomienie('Uzupełnij pole wynagrodzenie!!!', 0, 0);
            return false;
        }

        if (select_wynagrodzenie == 'Wybierz') {
            wyswitl_powiadomienie('Wybierz sposób w jaki mają być przekazane uzyskane świadczenia!!!', 0, 0);
            return false;
        }

        if (umowa_id == '') {
            wyswitl_powiadomienie('Brak numeru umowy!!!', 0, 0);
            return false;
        }

        $.ajax({
            method: "POST",
            url: "formularze_dokumenty/akcje/ajax_umowa_zapisz_edytuj_do_bazy",
            data: {
                umowa_id: umowa_id,
                nazwa_umowy: nazwa_umowy,
                zleceniodawca_imie: zleceniodawca_imie,
                zleceniodawca_nazwisko: zleceniodawca_nazwisko,
                zleceniodawca_nr_domu: zleceniodawca_nr_domu,
                zleceniodawca_nr_mieszkania: zleceniodawca_nr_mieszkania,
                zleceniodawca_kod_pocztowy: zleceniodawca_kod_pocztowy,
                zleceniodawca_miejscowosc: zleceniodawca_miejscowosc,
                zleceniodawca_pesel: zleceniodawca_pesel,
                zleceniodawca_seria_i_numer_dowodu: zleceniodawca_seria_i_numer_dowodu,
                zleceniodawca_email: zleceniodawca_email,
                zleceniodawca_telefon: zleceniodawca_telefon,
                zleceniodawca_ulica: zleceniodawca_ulica,
                dzialajacy_w_imieniu: dzialajacy_w_imieniu,
                zleceniodawca_w_imienu_imie: zleceniodawca_w_imienu_imie,
                zleceniodawca_w_imienu_nazwisko: zleceniodawca_w_imienu_nazwisko,
                zleceniodawca_w_imienu_ulica: zleceniodawca_w_imienu_ulica,
                zleceniodawca_w_imienu_nr_domu: zleceniodawca_w_imienu_nr_domu,
                zleceniodawca_w_imienu_nr_mieszkania: zleceniodawca_w_imienu_nr_mieszkania,
                zleceniodawca_w_imienu_kod_pocztowy: zleceniodawca_w_imienu_kod_pocztowy,
                zleceniodawca_w_imienu_miejscowosc: zleceniodawca_w_imienu_miejscowosc,
                zleceniodawca_w_imienu_pesel: zleceniodawca_w_imienu_pesel,
                zleceniodawca_w_imienu_seria_i_numer_dowodu: zleceniodawca_w_imienu_seria_i_numer_dowodu,
                select_wynagrodzenie: select_wynagrodzenie,
                wynagrodzenie_nr_rachunku_bankowego: wynagrodzenie_nr_rachunku_bankowego,
                wynagrodzenie_zleceniodawca_imie: wynagrodzenie_zleceniodawca_imie,
                wynagrodzenie_zleceniodawca_nazwisko: wynagrodzenie_zleceniodawca_nazwisko,
                wynagrodzenie_zleceniodawca_ulica: wynagrodzenie_zleceniodawca_ulica,
                wynagrodzenie_zleceniodawca_nr_domu: wynagrodzenie_zleceniodawca_nr_domu,
                wynagrodzenie_zleceniodawca_nr_mieszkania: wynagrodzenie_zleceniodawca_nr_mieszkania,
                wynagrodzenie_zleceniodawca_kod_pocztowy: wynagrodzenie_zleceniodawca_kod_pocztowy,
                wynagrodzenie_zleceniodawca_miejscowosc: wynagrodzenie_zleceniodawca_miejscowosc,
                wynagrodzenie_procent: wynagrodzenie_procent,
                data_wypadku: data_wypadku,
                smierc_osoby: smierc_osoby,
                zgoda_na_pcrf: zgoda_na_pcrf
            }
        }).done(function (data) {

            var array = $.parseJSON(data);

            if (array[0] === '0') {
                wyswitl_powiadomienie('Brak umowy w bazie!!!', 0, 0);
                return false;
            }

            wyswitl_powiadomienie('Umowa została zaktualizowana!!!', 1, 0);
            dokument_z();

        }).fail(function (ajaxContext) {
            document.getElementById("body_strona_r").innerHTML = ajaxContext.responseText;
        });
    });
}

function oswiadczenie_zapisz_do_bazy() {
    $('#oswiadczenie_zapisz_oswiadczenie').click(function () {
        var umowa_id = $('.lista_umow_opcje option:selected').attr('id');

        if (umowa_id == undefined) {
            wyswitl_powiadomienie('Wybierz umowe z listy!!!', 0, 0);
            return false;
        }

        var marka_samochodu = $('.zleceniodawca_marka_auta').val();
        var nr_rejestracyjny = $('.zleceniodawca_nr_rejestracji').val();
        var poj_silnika = $('.zleceniodawca_poj_silnika').val();

        if (marka_samochodu == '' || nr_rejestracyjny == '' || poj_silnika == '') {
            wyswitl_powiadomienie('Uzupełnij dane pojazdu!!!', 0, 0);
            return false;
        }

        var liczba_pol = $('#tabelka_wyjazdow .wiersz_z_danymi').size();

        var data;
        var miejscowosc_wyjazd;
        var miejscowosc_docelowa;
        var nazwa_placowki;
        var odleglosc;

        for (var i = 0; i < liczba_pol; i++) {
            data = $('#wiersz_' + (i + 1) + ' .data').val();
            miejscowosc_wyjazd = $('#wiersz_' + (i + 1) + ' .start').val();
            miejscowosc_docelowa = $('#wiersz_' + (i + 1) + ' .stop').val();
            nazwa_placowki = $('#wiersz_' + (i + 1) + ' .rodzaj_placowki').val();
            odleglosc = $('#wiersz_' + (i + 1) + ' .odleglosc').val();

            if (data == '' || miejscowosc_docelowa == '' || miejscowosc_wyjazd == '' || nazwa_placowki == '' || odleglosc == '') {
                wyswitl_powiadomienie('Uzupełnij pola wyjazdu!!!', 0, 0);
                return false;
            }
        }

        var liczba_pol_dok = $('#tabelka_dokumentow .wiersz_z_danymi').size();

        var element;
        var rodzaj_dokumentu_tmp;

        for (var i = 0; i < liczba_pol_dok; i++) {
            element = $('#wiersz_' + (i + 1) + ' #plik_' + (i + 1)).val();
            rodzaj_dokumentu_tmp = $('#wiersz_' + (i + 1) + ' #rodzaj_dokumentu').val();

            if (element == '' || rodzaj_dokumentu_tmp == 'Wybierz') {
                wyswitl_powiadomienie('Uzupełnij pola Dokumentów!!!', 0, 0);
                return false;
            }
        }

        $.ajax({
            method: "POST",
            url: "formularze_dokumenty/akcje/ajax_oswiadczenie_zapisz_do_bazy",
            data: {
                umowa_id: umowa_id,
                marka_samochodu: marka_samochodu,
                nr_rejestracyjny: nr_rejestracyjny,
                poj_silnika: poj_silnika

            }
        }).done(function (data) {

            var array = $.parseJSON(data);

            if (array[0] === '0') {
                wyswitl_powiadomienie('Brak umowy w bazie!!!', 0, 0);
                return false;
            }



            oswiadczenie_zapisz_wyjazd_do_bazy(array[1]);
            oswiadczenie_zapisz_pliki_do_bazy(array[1]);


            wyswitl_powiadomienie('Oświadczenie zostało dodane do bazy!!!', 1, 0);
            dokument_z();

        }).fail(function (ajaxContext) {
            document.getElementById("body_strona_r").innerHTML = ajaxContext.responseText;
        });
    });

}

function oswiadczenie_zapisz_wyjazd_do_bazy(id_oswiadczenie) {
    var oswiadczenie_id = id_oswiadczenie;


    var liczba_pol_1 = $('#tabelka_wyjazdow .wiersz_z_danymi').size();


    for (var i = 0; i < liczba_pol_1; i++) {

        var data = $('#wiersz_' + (i + 1) + ' .data').val();
        var miejscowosc_wyjazd = $('#wiersz_' + (i + 1) + ' .start').val();
        var miejscowosc_docelowa = $('#wiersz_' + (i + 1) + ' .stop').val();
        var nazwa_placowki = $('#wiersz_' + (i + 1) + ' .rodzaj_placowki').val();
        var odleglosc = $('#wiersz_' + (i + 1) + ' .odleglosc').val();

        $.ajax({
            method: "POST",
            url: "formularze_dokumenty/akcje/ajax_oswiadczenie_zapisz_wyjazd_do_bazy",
            data: {
                oswiadczenie_id: oswiadczenie_id,
                data: data,
                miejscowosc_wyjazd: miejscowosc_wyjazd,
                miejscowosc_docelowa: miejscowosc_docelowa,
                nazwa_placowki: nazwa_placowki,
                odleglosc: odleglosc

            }
        }).done().fail(function (ajaxContext) {
            document.getElementById("body_strona_r").innerHTML = ajaxContext.responseText;
        });

    }
}

function oswiadczenie_zapisz_pliki_do_bazy(id_oswiadczenie) {
    var oswiadczenie_id = id_oswiadczenie;
    var umowa_id = $('.lista_umow_opcje option:selected').attr('id');

    var liczba_pol_1 = $('#tabelka_dokumentow .wiersz_z_danymi').size();

    for (var i = 0; i < liczba_pol_1; i++) {
        var formData = new FormData();
        formData.append('plik', $('#plik_' + (i + 1))[0].files[0]);
        formData.append('rodzaj', $('#wiersz_' + (i + 1) + ' #rodzaj_dokumentu').val());
        formData.append('umowa_id', umowa_id);
        formData.append('oswiadczenie_id', oswiadczenie_id);
        formData.append('liczba_rand', Math.random());

        $.ajax({
            method: "POST",
            url: "formularze_dokumenty/akcje/ajax_oswiadczenie_zapisz_pliki_do_bazy",
            data: formData,
            contentType: false,
            processData: false

        }).done(function (html) {
        }).fail(function (ajaxContext) {

            alert(ajaxContext.responseText);
            return false;
        });
    }



}

function dynamiczna_tabelka_wyjazdy() {

    $('#dodaj_wiersz_tabelka_wyjazdow').click(function () {
        var ile_wierszy = $('#tabelka_wyjazdow .tabelka_wyjazdow_wiersz').size();

        var e1 = '<div class="tabelka_wyjazdow_wiersz_element twwe_lp">' + ile_wierszy + '</div>';
        var e2 = '<div class="tabelka_wyjazdow_wiersz_element twwe_data"><input type="text" class="data" placeholder="RRRR-MM-DD"/></div>';
        var e3 = '<div class="tabelka_wyjazdow_wiersz_element twwe_mw"><input type="text" class="start" placeholder="Początek"/></div>';
        var e4 = '<div class="tabelka_wyjazdow_wiersz_element twwe_md"><input type="text" class="stop" placeholder="Cel"/></div>';
        var e5 = '<div class="tabelka_wyjazdow_wiersz_element twwe_rp"><textarea class="rodzaj_placowki" placeholder="Rodzaj placówki medycznej oraz cel wizyty"></textarea></div>';
        var e6 = '<div class="tabelka_wyjazdow_wiersz_element twwe_od"><input type="text" class="odleglosc" placeholder="Odległość w km"/></div>';
        var e7 = '<div class="clear_b"></div>';

        var wiersz = '<div style="display:none;" id="wiersz_' + ile_wierszy + '" class="wiersz_z_danymi tabelka_wyjazdow_wiersz">' + e1 + e2 + e3 + e4 + e5 + e6 + e7 + '</div>';



        $('#tabelka_wyjazdow').append(wiersz);
        $('#tabelka_wyjazdow .tabelka_wyjazdow_wiersz:last').slideDown();

        $('input').keyup(function () {
            var wartosc = $(this).val();

            $(this).attr('value', wartosc);
        });

        $('.data').datetimepicker({
            viewMode: 'years',
            format: 'YYYY-MM-DD'
        });

    });

    $('#usun_ostatni_wiersz').click(function () {

        if (!$('#tabelka_wyjazdow .tabelka_wyjazdow_wiersz:last').hasClass('pierwszy')) {
            $('#tabelka_wyjazdow .tabelka_wyjazdow_wiersz:last').slideUp(function () {
                $(this).remove();
            });
        }
    });
}

function dynamiczna_tabelka_dokumenty() {

    $('#dodaj_wiersz_tabelka_dokumentow').click(function () {
        var ile_wierszy = $('#tabelka_dokumentow .tabelka_dokumentow_wiersz').size();

        var e1 = '<div class="tabelka_dokumentow_wiersz_element td_lp">' + ile_wierszy + '</div>';
        var e2 = '<div class="tabelka_dokumentow_wiersz_element td_w"><input id="plik_' + ile_wierszy + '" type="file" class="plik" name="plik_' + ile_wierszy + '" /></div>';
        var e4 = '<div class="tabelka_dokumentow_wiersz_element td_r"><select id="rodzaj_dokumentu"> <option selected>Wybierz</option>  </select></div>';

        var e7 = '<div class="clear_b"></div>';

        var wiersz = '<div style="display:none;" id="wiersz_' + ile_wierszy + '" class="wiersz_z_danymi tabelka_dokumentow_wiersz">' + e1 + e2 + e4 + e7 + '</div>';

        $('#tabelka_dokumentow').append(wiersz);
        pobierz_rodzaj_dokumentow();
        $('#tabelka_dokumentow .tabelka_dokumentow_wiersz:last').slideDown();
    });

    $('#usun_ostatni_wiersz_tabelka_dokumentow').click(function () {

        if (!$('#tabelka_dokumentow .tabelka_dokumentow_wiersz:last').hasClass('tabelka_dokumentow_wiersz_naglowek')) {
            $('#tabelka_dokumentow .tabelka_dokumentow_wiersz:last').slideUp(function () {
                $(this).remove();
            });
        }
    });
}

function pobierz_typ_rachunku_bankowego() {

    $('#rodzaj_rachunku').click(function () {

        var typ_rachunku = document.getElementById("rodzaj_rachunku").value;

        if(typ_rachunku == 'inny') {
            $('.nr_rachunku_bankowego').removeAttr('onkeyup');
        }
        if (typ_rachunku == 'pl') {
            $('.nr_rachunku_bankowego').attr('onkeyup', 'sprawdz_numer_rachunku(this);');
            $('.nr_rachunku_bankowego').removeClass('numer_rachunku_poprawny');
            $('.zleceniodawca_formularz_numer_rachunku_bankowego').removeClass('poprawna');
            $('.nr_rachunku_bankowego').removeClass('numer_rachunku_niepoprawny');
            $('.zleceniodawca_formularz_numer_rachunku_bankowego').removeClass('blad');
        }

    });
}
function przelaczanie_zakladek_umowa_bankowa() {

    $('.krok_1').click(function () {
        $('.str_1').slideDown();
        $('.krok_2').removeClass('aktywna');
        $('.krok_3').removeClass('aktywna');
        $('.krok_4').removeClass('aktywna');
        $('.krok_5').removeClass('aktywna');
        $('.krok_6').removeClass('aktywna');
        $('.krok_7').removeClass('aktywna');
        $(this).addClass('aktywna');
        $('.str_2_b').slideUp();
        $('.str_3_b').slideUp();
        $('.str_4_b').slideUp();
        $('.str_5_b').slideUp();
        $('.str_6_b').slideUp();
        $('.str_7_b').slideUp();

        $('.str_2').slideUp();
        $('.str_3').slideUp();
        $('.str_4').slideUp();
        $('.str_5').slideUp();
        $('.str_6').slideUp();
        $('.str_7').slideUp();

    });
    $('.krok_2').click(function () {
        $('.krok_1').removeClass('aktywna');
        $('.str_2_b').slideDown();
        $('.krok_3').removeClass('aktywna');
        $('.krok_4').removeClass('aktywna');
        $('.krok_5').removeClass('aktywna');
        $('.krok_6').removeClass('aktywna');
        $('.krok_7').removeClass('aktywna');

        $(this).addClass('aktywna');
        $('.str_1').slideUp();
        $('.str_2').slideUp();
        $('.str_3_b').slideUp();
        $('.str_4_b').slideUp();
        $('.str_5_b').slideUp();
        $('.str_6_b').slideUp();
        $('.str_7_b').slideUp();

        $('.str_3').slideUp();
        $('.str_4').slideUp();
        $('.str_5').slideUp();
        $('.str_6').slideUp();
        $('.str_7').slideUp();

    });
    $('.krok_3').click(function () {
        $('.str_3_b').slideDown();
        $('.krok_1').removeClass('aktywna');
        $('.krok_2').removeClass('aktywna');
        $('.krok_4').removeClass('aktywna');
        $('.krok_5').removeClass('aktywna');
        $('.krok_6').removeClass('aktywna');
        $('.krok_7').removeClass('aktywna');

        $(this).addClass('aktywna');
        $('.str_3').slideUp();
        $('.str_1').slideUp();
        $('.str_2_b').slideUp();
        $('.str_4_b').slideUp();
        $('.str_5_b').slideUp();
        $('.str_6_b').slideUp();
        $('.str_7_b').slideUp();

        $('.str_2').slideUp();
        $('.str_4').slideUp();
        $('.str_5').slideUp();
        $('.str_6').slideUp();
        $('.str_7').slideUp();

    });
    $('.krok_4').click(function () {
        $('.str_4_b').slideDown();
        $('.krok_1').removeClass('aktywna');
        $('.krok_2').removeClass('aktywna');
        $('.krok_3').removeClass('aktywna');
        $('.krok_5').removeClass('aktywna');
        $('.krok_6').removeClass('aktywna');
        $('.krok_7').removeClass('aktywna');

        $(this).addClass('aktywna');
        $('.str_4').slideUp();
        $('.str_1').slideUp();
        $('.str_2_b').slideUp();
        $('.str_3_b').slideUp();
        $('.str_5_b').slideUp();
        $('.str_6_b').slideUp();
        $('.str_7_b').slideUp();

        $('.str_2').slideUp();
        $('.str_3').slideUp();
        $('.str_5').slideUp();
        $('.str_6').slideUp();
        $('.str_7').slideUp();

    });
    $('.krok_5').click(function () {
        $('.str_5_b').slideDown();
        $('.krok_1').removeClass('aktywna');
        $('.krok_2').removeClass('aktywna');
        $('.krok_3').removeClass('aktywna');
        $('.krok_4').removeClass('aktywna');
        $('.krok_6').removeClass('aktywna');
        $('.krok_7').removeClass('aktywna');

        $(this).addClass('aktywna');
        $('.str_5').slideUp();
        $('.str_1').slideUp();
        $('.str_2_b').slideUp();
        $('.str_3_b').slideUp();
        $('.str_4_b').slideUp();
        $('.str_6_b').slideUp();
        $('.str_7_b').slideUp();

        $('.str_2').slideUp();
        $('.str_3').slideUp();
        $('.str_4').slideUp();
        $('.str_6').slideUp();
        $('.str_7').slideUp();

    });

    $('.krok_6').click(function () {
        $('.str_6_b').slideDown();
        $('.krok_1').removeClass('aktywna');
        $('.krok_2').removeClass('aktywna');
        $('.krok_3').removeClass('aktywna');
        $('.krok_4').removeClass('aktywna');
        $('.krok_5').removeClass('aktywna');
        $('.krok_7').removeClass('aktywna');

        $(this).addClass('aktywna');
        $('.str_6').slideUp();
        $('.str_1').slideUp();
        $('.str_2_b').slideUp();
        $('.str_3_b').slideUp();
        $('.str_4_b').slideUp();
        $('.str_5_b').slideUp();
        $('.str_7_b').slideUp();

        $('.str_2').slideUp();
        $('.str_3').slideUp();
        $('.str_4').slideUp();
        $('.str_5').slideUp();
        $('.str_7').slideUp();

    });

    $('.krok_7').click(function () {
        $('.str_7_b').slideDown();
        $('.krok_1').removeClass('aktywna');
        $('.krok_2').removeClass('aktywna');
        $('.krok_3').removeClass('aktywna');
        $('.krok_4').removeClass('aktywna');
        $('.krok_5').removeClass('aktywna');
        $('.krok_6').removeClass('aktywna');

        $(this).addClass('aktywna');
        $('.str_7').slideUp();
        $('.str_1').slideUp();
        $('.str_2_b').slideUp();;
        $('.str_3_b').slideUp();
        $('.str_4_b').slideUp();
        $('.str_5_b').slideUp();
        $('.str_6_b').slideUp();

        $('.str_2').slideUp();;
        $('.str_3').slideUp();
        $('.str_4').slideUp();
        $('.str_5').slideUp();
        $('.str_6').slideUp();
    });
}

function przelacz_str_1_b() {

    $('.str_1').slideUp();
    $('.str_3_b').slideUp();
    $('.str_4_b').slideUp();
    $('.str_5_b').slideUp();
    $('.str_6_b').slideUp();
    $('.str_7_b').slideUp();
    $('.str_2_b').slideDown();
    $('.krok_1').removeClass('aktywna');
    $('.krok_2').addClass('aktywna');
    $('.krok_2').show();

    zeruj_licznik_sesji_po_wykonaniu_funkcji();
}

function przelacz_str_2_b() {

    $('.str_1').slideUp();
    $('.str_2_b').slideUp();
    $('.str_4_b').slideUp();
    $('.str_5_b').slideUp();
    $('.str_6_b').slideUp();
    $('.str_7_b').slideUp();
    $('.str_3_b').slideDown();
    $('.krok_2').removeClass('aktywna');
    $('.krok_3').addClass('aktywna');
    $('.krok_3').show();

    zeruj_licznik_sesji_po_wykonaniu_funkcji();
}

function przelacz_str_3_b() {

    $('.str_1').slideUp();
    $('.str_3_b').slideUp();
    $('.str_2_b').slideUp();
    $('.str_5_b').slideUp();
    $('.str_6_b').slideUp();
    $('.str_7_b').slideUp();
    $('.str_4_b').slideDown();
    $('.krok_3').removeClass('aktywna');
    $('.krok_4').addClass('aktywna');
    $('.krok_4').show();

    zeruj_licznik_sesji_po_wykonaniu_funkcji();
}

function przelacz_str_4_b() {

    $('.str_1').slideUp();
    $('.str_3_b').slideUp();
    $('.str_2_b').slideUp();
    $('.str_4_b').slideUp();
    $('.str_6_b').slideUp();
    $('.str_7_b').slideUp();
    $('.str_5_b').slideDown();
    $('.krok_4').removeClass('aktywna');
    $('.krok_5').addClass('aktywna');
    $('.krok_5').show();

    zeruj_licznik_sesji_po_wykonaniu_funkcji();
}

function przelacz_str_5_b() {

    $('.str_1').slideUp();
    $('.str_3_b').slideUp();
    $('.str_2_b').slideUp();
    $('.str_5_b').slideUp();
    $('.str_4_b').slideUp();
    $('.str_7_b').slideUp();
    $('.str_6_b').slideDown();
    $('.krok_5').removeClass('aktywna');
    $('.krok_6').addClass('aktywna');
    $('.krok_6').show();

    zeruj_licznik_sesji_po_wykonaniu_funkcji();
}

function przelacz_str_6_b() {

    $('.str_1').slideUp();
    $('.str_3_b').slideUp();
    $('.str_2_b').slideUp();
    $('.str_5_b').slideUp();
    $('.str_4_b').slideUp();
    $('.str_6_b').slideUp();
    $('.str_7_b').slideDown();
    $('.krok_6').removeClass('aktywna');
    $('.krok_7').addClass('aktywna');
    $('.krok_7').show();

    zeruj_licznik_sesji_po_wykonaniu_funkcji();
}

function przelacz_str_7_b() {

    $('.str_1').slideUp();
    $('.str_3_b').slideUp();
    $('.str_2_b').slideUp();
    $('.str_5_b').slideUp();
    $('.str_4_b').slideUp();
    $('.str_7_b').slideUp();
    $('.str_8_b').slideDown();
    $('.krok_7').removeClass('aktywna');
    $('.krok_8').addClass('aktywna');
    $('.krok_8').show();

    zeruj_licznik_sesji_po_wykonaniu_funkcji();
}
function klient_poszkodowany () {
    $( '.klient_poszkodowany_tak').on( "click", function() {
        var klient_poszkodowany_tak = ($('.klient_poszkodowany_tak').hasClass('zaznaczone')) ? '1' : '0';

        if (klient_poszkodowany_tak == '1') {
            $('.kim_poszkodowany').hide();
            //alert('ukryj');
        }
    });

    $( '.klient_poszkodowany_nie').on( "click", function() {
        var klient_poszkodowany_nie = ($('.klient_poszkodowany_nie').hasClass('zaznaczone')) ? '1' : '0';

        if (klient_poszkodowany_nie == '1') {
            $('.kim_poszkodowany').show();
            $('.dane_klienta_form').show();
            //alert('pokaz');
        }
    });

}
function kogo_pozostawiono() {
    $('.syt_p_s_rodz_zmarl_dz').click(function () {
        var dzieci = ($('.syt_p_s_rodz_zmarl_dz').hasClass('zaznaczone')) ? '1' : '0';

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