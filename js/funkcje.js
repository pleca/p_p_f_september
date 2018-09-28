$(document).ready(function () {
    $('.wysun_menu').click(function () {
        $('.wysun_menu').toggleClass('aktywne_menu');
        $('.menu').toggleClass('wysun_blok_menu');
    });

    /*
    $('#strona').click(function () {
        if ($('#menu_podreczne').hasClass('menu_podreczne_aktywne')) {
            $('#menu_podreczne').removeClass('menu_podreczne_aktywne');
            $('#menu_podreczne').innerHTML = ' ';
        }
    });

    $('html').bind("contextmenu", function (e) {


        pokaz_menu_kontekstowe(e.pageX, e.pageY, 'menu_podreczne');

        return false;

    });

    $('#menu_podreczne').bind("contextmenu", function (e) {


        //pokaz_menu_kontekstowe(e.pageX, e.pageY, 'menu_podreczne');

        return false;

    });
*/
});

function pokaz_powiadomienie_pulpit(powiadomienie, czas) {

    var tytul = 'Powiadomienie z systemu';
    var options = {
        body: powiadomienie
            // ,icon: '../img/logo_male.png'
    };

    if (!("Notification" in window)) {
        return false;

    } else if (Notification.permission === "granted") {


        var notification = new Notification(tytul, options);
        setTimeout(notification.close.bind(notification), czas);

    } else if (Notification.permission !== 'denied') {
        Notification.requestPermission(function (permission) {
            if (!('permission' in Notification)) {
                Notification.permission = permission;
            }

            if (permission === "granted") {
                var notification = new Notification(tytul, options);
                setTimeout(notification.close.bind(notification), czas);
            }
        });

    }

}

function zeruj_licznik_sesji_po_wykonaniu_funkcji(){
    mainPanel.odswierzSesje();
}

function pokaz_menu_kontekstowe(posx, posy, rodzaj) {
    $('#menu_podreczne').removeClass('menu_podreczne_aktywne');
    $('#menu_podreczne').innerHTML = ' ';
    //alert(posx+' '+posy);

    $.ajax({
            method: "POST",
            url: adres_hosta + "/ajax/" + rodzaj,
        })
        .done(function (html) {
            document.getElementById(rodzaj).innerHTML = html;

            var w = window.outerWidth;
            var h = window.outerHeight;

            $('#' + rodzaj).addClass('menu_podreczne_aktywne');

            $('#' + rodzaj).css('top', posy + 'px');
            //$('#'+rodzaj).css('left',(posx+300)+'px');

            if ((w - posx) < 300) {
                posx = posx - 260;
                $('#' + rodzaj).css('left', (posx) + 'px');
            } else {
                $('#' + rodzaj).css('left', (posx) + 'px');
            }

            var wysokosc_menu = parseInt($('#menu_podreczne').height());

            //alert(h+' '+posy);
            if ((h - posy) < (wysokosc_menu + 150)) {
                posy = posy - wysokosc_menu - 25;
                $('#' + rodzaj).css('top', posy + 'px');
            } else {
                $('#' + rodzaj).css('top', posy + 'px');
            }


            $('.mpte_wyloguj').click(function () {
                mainPanel.wyloguj();
            });

            $('.mpt_odswiez').click(function () {
                location.reload();
            });

            $('.mpt_wstecz').click(function () {
                window.history.back();
            });

            $('.mpt_do_przodu').click(function () {
                window.history.forward();
            });

        }).fail(function (ajaxContext) {
            document.getElementById("menu_podreczne").innerHTML = ajaxContext.responseText;
        });
}

function ukryj_powiadomienia_formularz() {
    document.getElementById("powiadomienia_formularz").innerHTML = ' ';
}

function wyswitl_powiadomienie(tresc, rodzaj, przeladuj, czas_komunikatu) {

    var czas_animacji;

    if (!czas_komunikatu) {
        czas_animacji = 3000;
    } else {
        czas_animacji = czas_komunikatu;
    }

    if (rodzaj == 0) {
        document.getElementById("powiadomienia_www").innerHTML = '<div class="error">' + tresc + '</div>';
    } else {
        document.getElementById("powiadomienia_www").innerHTML = '<div class="sukces">' + tresc + '</div>';
    }

    $('#powiadomienia_www').addClass('wysun_pole_powiadomienia');

    setTimeout(function () {
        if (przeladuj == 1) {
            location.reload();
        }
        $('#powiadomienia_www').removeClass('wysun_pole_powiadomienia');
    }, czas_animacji);

};

function sprawdz_pesel(pesel_tmp) {
    var pesel = $(pesel_tmp).val();

    if (pesel == '00000000000' || pesel == '11111111111' || pesel == '22222222222') {
        if ($(pesel_tmp).hasClass('pesel_niepoprawny')) {
            $(pesel_tmp).parent('div').addClass('blad');
        } else {
            $(pesel_tmp).parent('div').removeClass('blad');
        }
        return false;
    }

    var rok = parseInt(pesel.substring(0, 2), 10);
    var miesiac = parseInt(pesel.substring(2, 4), 10) - 1;
    var dzien = parseInt(pesel.substring(4, 6), 10);

    if (miesiac > 80) {
        rok = rok + 1800;
        miesiac = miesiac - 80;
    } else if (miesiac > 60) {
        rok = rok + 2200;
        miesiac = miesiac - 60;
    } else if (miesiac > 40) {
        rok = rok + 2100;
        miesiac = miesiac - 40;
    } else if (miesiac > 20) {
        rok = rok + 2000;
        miesiac = miesiac - 20;
    } else {
        rok += 1900;
    }

    var wagi = [9, 7, 3, 1, 9, 7, 3, 1, 9, 7];
    var suma = 0;

    for (var i = 0; i < wagi.length; i++) {
        suma += (parseInt(pesel.substring(i, i + 1), 10) * wagi[i]);
    }
    suma = suma % 10;

    var valid = (suma === parseInt(pesel.substring(10, 11), 10));

    if (!valid) {
        $(pesel_tmp).removeClass('pesel_poprawny');
        $(pesel_tmp).addClass('pesel_niepoprawny');
    } else {
        $(pesel_tmp).removeClass('pesel_niepoprawny');
        $(pesel_tmp).addClass('pesel_poprawny');
    }

    if (miesiac < 0 || miesiac > 12 || dzien < 0 || dzien > 31) {
        $(pesel_tmp).removeClass('pesel_poprawny');
        $(pesel_tmp).addClass('pesel_niepoprawny');
        if ($(pesel_tmp).hasClass('pesel_niepoprawny')) {
            $(pesel_tmp).parent('div').addClass('blad');
        } else {
            $(pesel_tmp).parent('div').removeClass('blad');
        }
        return false;
    }

    if (pesel == '') {
        $(pesel_tmp).removeClass('pesel_poprawny');
        $(pesel_tmp).removeClass('pesel_niepoprawny');
    }

    if ($(pesel_tmp).hasClass('pesel_niepoprawny')) {
        $(pesel_tmp).parent('div').addClass('blad');
    } else {
        $(pesel_tmp).parent('div').removeClass('blad');
    }
    if ($(pesel_tmp).hasClass('pesel_poprawny')) {
        $(pesel_tmp).parent('div').removeClass('blad');
        $(pesel_tmp).parent('div').addClass('poprawna');
    } else {
        $(pesel_tmp).parent('div').removeClass('poprawna');
    }

}

function sprawdz_dowod(numer_tmp) {

    var numer = $(numer_tmp).val();
    numer = numer.toUpperCase();
    //numer = numer.replace(/[\s-]/g, '');



    if (numer == 'AAA000000' || numer == 'AAA111111') {
        return false;
    }

    letterValues = [
		'0', '1', '2', '3', '4', '5', '6', '7', '8', '9',
		'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J',
		'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T',
		'U', 'V', 'W', 'X', 'Y', 'Z'
	];

    function getLetterValue(letter) {
        return jQuery.inArray(letter, letterValues);
    }

    if (numer == '') {
        $(numer_tmp).removeClass('dowod_poprawny');
        $(numer_tmp).removeClass('dowod_niepoprawny');
        $(numer_tmp).parent('div').removeClass('blad');
        $(numer_tmp).parent('div').removeClass('poprawna');
        return false;
    } else {
        for (i = 0; i < 3; i++) {
            if (getLetterValue(numer[i]) < 10) {
                $(numer_tmp).addClass('dowod_niepoprawny');
                if ($(numer_tmp).hasClass('dowod_niepoprawny')) {
                    $(numer_tmp).parent('div').addClass('blad');
                } else {
                    $(numer_tmp).parent('div').removeClass('blad');
                }
                if ($(numer_tmp).hasClass('dowod_poprawny')) {
                    $(numer_tmp).parent('div').removeClass('blad');
                    $(numer_tmp).parent('div').addClass('poprawna');
                } else {
                    $(numer_tmp).parent('div').removeClass('poprawna');
                }
                return false;
            }
        }
    }

    if (numer == '') {
        $(numer_tmp).removeClass('dowod_poprawny');
        $(numer_tmp).removeClass('dowod_niepoprawny');
        $(numer_tmp).parent('div').removeClass('poprawna');
        $(numer_tmp).parent('div').removeClass('blad');
        return false;
    } else {
        for (i = 3; i < 9; i++) {
            if (getLetterValue(numer[i]) < 0 || getLetterValue(numer[i]) > 9) {
                $(numer_tmp).addClass('dowod_niepoprawny');
                if ($(numer_tmp).hasClass('dowod_niepoprawny')) {
                    $(numer_tmp).parent('div').addClass('blad');
                } else {
                    $(numer_tmp).parent('div').removeClass('blad');
                }
                if ($(numer_tmp).hasClass('dowod_poprawny')) {
                    $(numer_tmp).parent('div').removeClass('blad');
                    $(numer_tmp).parent('div').addClass('poprawna');
                } else {
                    $(numer_tmp).parent('div').removeClass('poprawna');
                }
                return false;
            }
        }
    }



    var sum = 7 * getLetterValue(numer[0]) +
        3 * getLetterValue(numer[1]) +
        1 * getLetterValue(numer[2]) +
        7 * getLetterValue(numer[4]) +
        3 * getLetterValue(numer[5]) +
        1 * getLetterValue(numer[6]) +
        7 * getLetterValue(numer[7]) +
        3 * getLetterValue(numer[8]);

    sum = sum %= 10;

    if (sum != getLetterValue(numer[3])) {
        $(numer_tmp).removeClass('dowod_poprawny');
        $(numer_tmp).addClass('dowod_niepoprawny');
    } else {
        $(numer_tmp).removeClass('dowod_niepoprawny');
        $(numer_tmp).addClass('dowod_poprawny');
        $(numer_tmp).parent('div').removeClass('blad');
    }

    if ($(numer_tmp).hasClass('dowod_poprawny')) {
        $(numer_tmp).parent('div').removeClass('blad');
        $(numer_tmp).parent('div').addClass('poprawna');
    } else {
        $(numer_tmp).parent('div').removeClass('poprawna');
    }


}

function sprawdz_kod_pocztowy(kod_tmp) {
    var kod = $(kod_tmp).val();
    var wzor_kodu = /[0-9]{1}[0-9]{1}-[0-9]{1}[0-9]{1}[0-9]{1}/;

    var sprawdzenie = kod.match(wzor_kodu);

    $(kod_tmp).keydown(function (e) {
        if (e.keyCode != 8) {
            if (kod.length == 2) {
                $(kod_tmp).val(kod + '-');
            } else {
                $(kod_tmp).val(kod);
            }
        }
    });

    if (!sprawdzenie) {
        $(kod_tmp).removeClass('kod_poprawny');
        $(kod_tmp).addClass('kod_niepoprawny');
    } else {
        $(kod_tmp).removeClass('kod_niepoprawny');
        $(kod_tmp).addClass('kod_poprawny');
    }

    if (kod == '') {
        $(kod_tmp).removeClass('kod_poprawny');
        $(kod_tmp).removeClass('kod_niepoprawny');
    }

    if ($(kod_tmp).hasClass('kod_niepoprawny')) {
        $(kod_tmp).parent('div').addClass('blad');
    } else {
        $(kod_tmp).parent('div').removeClass('blad');
    }

    if ($(kod_tmp).hasClass('kod_poprawny')) {
        $(kod_tmp).parent('div').removeClass('blad');
        $(kod_tmp).parent('div').addClass('poprawna');
    } else {
        $(kod_tmp).parent('div').removeClass('poprawna');
    }
}

function sprawdz_numer_rachunku(nrb_tmp) {
    var nrb = $(nrb_tmp).val();

    if (nrb.length == 2) {
        $(nrb_tmp).val(nrb + ' ');
    }
    if (nrb.length == 7) {
        $(nrb_tmp).val(nrb + ' ');
    }
    if (nrb.length == 12) {
        $(nrb_tmp).val(nrb + ' ');
    }
    if (nrb.length == 17) {
        $(nrb_tmp).val(nrb + ' ');
    }
    if (nrb.length == 22) {
        $(nrb_tmp).val(nrb + ' ');
    }
    if (nrb.length == 27) {
        $(nrb_tmp).val(nrb + ' ');
    }

    nrb = nrb.replace(/[^0-9]+/g, '');
    if (nrb.length == 26) {

        var wagi = new Array(1, 10, 3, 30, 9, 90, 27, 76, 81, 34, 49, 5, 50, 15, 53, 45, 62, 38, 89, 17, 73, 51, 25, 56, 75, 71, 31, 19, 93, 57);

        nrb = nrb + "2521";
        nrb = nrb.substr(2) + nrb.substr(0, 2);

        var Z = 0;
        for (var i = 0; i < 30; i++) {
            Z += nrb[29 - i] * wagi[i];
        }

        if (Z % 97 == 1) {
            $(nrb_tmp).addClass('numer_rachunku_poprawny');
            $(nrb_tmp).removeClass('numer_rachunku_niepoprawny');
        } else {
            $(nrb_tmp).removeClass('numer_rachunku_poprawny');
            $(nrb_tmp).addClass('numer_rachunku_niepoprawny');
        }
    } else {
        $(nrb_tmp).removeClass('numer_rachunku_poprawny');
        $(nrb_tmp).addClass('numer_rachunku_niepoprawny');
    }

    if (nrb == '') {
        $(nrb_tmp).removeClass('numer_rachunku_poprawny');
        $(nrb_tmp).removeClass('numer_rachunku_niepoprawny');
    }

    if ($(nrb_tmp).hasClass('numer_rachunku_niepoprawny')) {
        $(nrb_tmp).parent('div').removeClass('poprawna');
        $(nrb_tmp).parent('div').addClass('blad');
    } else {
        $(nrb_tmp).parent('div').removeClass('blad');
    }

    if ($(nrb_tmp).hasClass('numer_rachunku_poprawny')) {
        $(nrb_tmp).parent('div').removeClass('blad');
        $(nrb_tmp).parent('div').addClass('poprawna');
    } else {
        $(nrb_tmp).parent('div').removeClass('poprawna');
    }
    //88 1090 2705 0000 0001 1645 0938
}

function blokuj_wpisanie_liczb(pole_klasa) {
    $('.' + pole_klasa).keydown(function (e) {
        if (e.keyCode >= 65 && e.keyCode <= 90 || (keys_to_moving_in_input.indexOf(e.keyCode) != -1) || e.keyCode == 45) {
            return true;
        } else {
            return false;
        }
    });
}

function blokuj_wpisanie_znakow(pole_klasa) {
    $('.' + pole_klasa).keydown(function (e) {
        if (e.shiftKey) {
            return false;
        } else {
            if (e.keyCode >= 48 && e.keyCode <= 57 || (e.keyCode >= 96 && e.keyCode <= 105) || e.keyCode == 8 || e.keyCode == 9) {
                return true;
            } else {
                return false;
            }
        }

    });
}

function przelacz_zakladke() {
    $('.zakladki_przycisk').click(function () {

        ukryj_powiadomienia_formularz();

        var pokarz_tresc = $(this).attr('id');

        $('.zakladki').find('.zakladki_przycisk').removeClass('zakladka_aktywna');
        $(this).addClass('zakladka_aktywna');

        $('.zakladki_tresc').find('.zakladka_tresc_tresc').removeClass('zakladka_aktywna');
        $('.zakladki_tresc').find('.' + pokarz_tresc).addClass('zakladka_aktywna');

        //alert(pokarz_tresc);
    });
}

function wyswietl_loader(tekst) {
    $('#loader').addClass('wyswietl_loader');
    if (tekst == '') {
        $('.loader_napis').text('Proszę czekać!!!');
    } else {
        $('.loader_napis').text(tekst);
    }

}

function ukryj_loader() {
    $('#loader').removeClass('wyswietl_loader');
    $('.loader_napis').text('Proszę czekać!!!');
}

$(document).find('#skrypty').remove();

function aktualizuj_value_input_texarea() {
    $('input').keyup(function () {
        var wartosc = $(this).val();

        $(this).attr('value', wartosc);
    });

    $('textarea').keyup(function () {
        var wartosc = $(this).val();

        $(this).attr('value', wartosc);
    });
}

/*kamyk 2016-09-01*/
function edytor_opcje() {
    $(document).ready(function () {
        $('.editor').each(function (index, element) {
            $(element).wysiwyg({
                'class': 'fake-bootstrap',
                // 'selection'|'top'|'top-selection'|'bottom'|'bottom-selection'
                toolbar: 'top',
                buttons: {

                    insertimage: {
                        title: 'Insert image',
                        image: '\uf030', // <img src="path/to/image.png" width="16" height="16" alt="" />

                    },

                    insertlink: {
                        title: 'Insert link',
                        image: '\uf08e' // <img src="path/to/image.png" width="16" height="16" alt="" />
                    },

                    // Fontsize plugin
                    fontsize: {
                        title: 'Size',
                        style: 'color:white;background:#cccccc', // you can pass any property - example: "style"
                        image: '\uf034', // <img src="path/to/image.png" width="16" height="16" alt="" />
                        popup: function ($popup, $button) {
                            // Hack: http://stackoverflow.com/questions/5868295/document-execcommand-fontsize-in-pixels/5870603#5870603
                            var list_fontsizes = [];
                            for (var i = 8; i <= 11; ++i)
                                list_fontsizes.push(i + 'px');
                            for (var i = 12; i <= 28; i += 2)
                                list_fontsizes.push(i + 'px');
                            list_fontsizes.push('36px');
                            list_fontsizes.push('48px');
                            list_fontsizes.push('72px');
                            var $list = $('<div/>').addClass('wysiwyg-plugin-list')
                                .attr('unselectable', 'on');
                            $.each(list_fontsizes, function (index, size) {
                                var $link = $('<a/>').attr('href', '#')
                                    .html(size)
                                    .click(function (event) {
                                        $(element).wysiwyg('shell').fontSize(7).closePopup();
                                        $(element).wysiwyg('container')
                                            .find('font[size=7]')
                                            .removeAttr("size")
                                            .css("font-size", size);
                                        // prevent link-href-#
                                        event.stopPropagation();
                                        event.preventDefault();
                                        return false;
                                    });
                                $list.append($link);
                            });
                            $popup.append($list);
                        }

                    },
                    bold: {
                        title: 'Pogrubienie (Ctrl+B)',
                        image: '\uf032', // <img src="path/to/image.png" width="16" height="16" alt="" />
                        hotkey: 'b'
                    },
                    italic: {
                        title: 'Pochylenie (Ctrl+I)',
                        image: '\uf033', // <img src="path/to/image.png" width="16" height="16" alt="" />
                        hotkey: 'i'
                    },
                    underline: {
                        title: 'Podkreślenie (Ctrl+U)',
                        image: '\uf0cd', // <img src="path/to/image.png" width="16" height="16" alt="" />
                        hotkey: 'u'
                    },
                    strikethrough: {
                        title: 'Przekreślenie (Ctrl+S)',
                        image: '\uf0cc', // <img src="path/to/image.png" width="16" height="16" alt="" />
                        hotkey: 's'
                    },
                    forecolor: {
                        title: 'Kolor czcionki',
                        image: '\uf1fc' // <img src="path/to/image.png" width="16" height="16" alt="" />
                    },
                    highlight: {
                        title: 'Kolor tła',
                        image: '\uf043' // <img src="path/to/image.png" width="16" height="16" alt="" />
                    },
                    alignleft: {
                        title: 'Wyrównaj do lewej',
                        image: '\uf036', // <img src="path/to/image.png" width="16" height="16" alt="" />
                        //showstatic: true,    // wanted on the toolbar
                        showselection: false // wanted on selection
                    },
                    aligncenter: {
                        title: 'Wyśrodkój',
                        image: '\uf037', // <img src="path/to/image.png" width="16" height="16" alt="" />
                        //showstatic: true,    // wanted on the toolbar
                        showselection: false // wanted on selection
                    },
                    alignright: {
                        title: 'Wyrównaj do prawej',
                        image: '\uf038', // <img src="path/to/image.png" width="16" height="16" alt="" />
                        //showstatic: true,    // wanted on the toolbar
                        showselection: false // wanted on selection
                    },
                    alignjustify: {
                        title: 'Justowanie',
                        image: '\uf039', // <img src="path/to/image.png" width="16" height="16" alt="" />
                        //showstatic: true,    // wanted on the toolbar
                        showselection: false // wanted on selection
                    },
                    indent: {
                        title: 'Indent',
                        image: '\uf03c', // <img src="path/to/image.png" width="16" height="16" alt="" />
                        //showstatic: true,    // wanted on the toolbar
                        showselection: false // wanted on selection
                    },
                    outdent: {
                        title: 'Outdent',
                        image: '\uf03b', // <img src="path/to/image.png" width="16" height="16" alt="" />
                        //showstatic: true,    // wanted on the toolbar
                        showselection: false // wanted on selection
                    },
                    orderedList: {
                        title: 'Ordered list',
                        image: '\uf0cb', // <img src="path/to/image.png" width="16" height="16" alt="" />
                        //showstatic: true,    // wanted on the toolbar
                        showselection: false // wanted on selection
                    },
                    unorderedList: {
                        title: 'Unordered list',
                        image: '\uf0ca', // <img src="path/to/image.png" width="16" height="16" alt="" />
                        //showstatic: true,    // wanted on the toolbar
                        showselection: false // wanted on selection
                    },
                    removeformat: {
                        title: 'Remove format',
                        image: '\uf12d' // <img src="path/to/image.png" width="16" height="16" alt="" />
                    }
                },
                // Submit-Button
                submit: {
                    title: 'Submit',
                    image: '\uf00c' // <img src="path/to/image.png" width="16" height="16" alt="" />
                },
                // Other properties
                selectImage: 'Kliknij lub upuść obraz tutaj',
                placeholderUrl: 'www.example.com',
                placeholderEmbed: '<embed/>',
                maxImageSize: [760, 570],
                //filterImageType: function( file ) { alert(file); },
                onKeyDown: function (key, character, shiftKey, altKey, ctrlKey, metaKey) {},
                onKeyPress: function (key, character, shiftKey, altKey, ctrlKey, metaKey) {},
                onKeyUp: function (key, character, shiftKey, altKey, ctrlKey, metaKey) {},
                onAutocomplete: function (typed, key, character, shiftKey, altKey, ctrlKey, metaKey) {},
                onImageUpload: function (insert_image) {

                    var input = $('.wysiwyg-browse input')[0].files[0];

                    if (!/^image/.test(input.type)) {
                        alert('Wybierz obraz!!!');
                        return false;
                    }

                    var formData = new FormData();
                    formData.append('obraz', input);

                    $.ajax({
                        method: "POST",
                        url: "ajax/akcje/ajax_zapisz_obraz_do_tmp",
                        data: formData,
                        contentType: false,
                        processData: false

                    }).done(function (data) {
                        insert_image(adres_hosta + '/moduly/mailing/tmp/' + data);

                    }).fail(function (ajaxContext) {
                        document.getElementById("body_strona_r").innerHTML = ajaxContext.responseText;
                    });
                },
                forceImageUpload: true, // upload images even if File-API is present
                videoFromUrl: function (url) {}
            });

        });

    });
}

function sprawdz_poprawnosc_hasla(wartosc_tmp) {
    /*
     sprawdz_poprawnosc_hasla(uzytkownik_haslo);
    	if($('.h_zle').size() != 0){
    		$('.wymagania_hasla').show();
    		wyswitl_powiadomienie('Hasło nie spełnia minimalnych wymagań!!!', 0, 0);
    		return false;
    	}
    */


    $('.wymagania_hasla').remove();

    var wartosc = wartosc_tmp;

    var male_litery = /[a-z]/;
    var duze_litery = /[A-Z]/;
    var znaki_specjalne = /[\!\@\#\$\%\^\&\*\(\)\-\=\+\_\;\:\,\.\(/)\?\*]/;

    var t0 = '<p class="h_naglowek">Hasło nie spełnia minimalnych wymagań!!!</p>';
    var t1 = '<p class="h_dobre">- Minimalna długość 8 znaków</p>';
    var t2 = '<p class="h_dobre">- Minimum 1 mała litera</p>';
    var t3 = '<p class="h_dobre">- Minimum 1 wielka litera</p>';
    var t4 = '<p class="h_dobre">- Minimum 1 znak specjalny ( ! @ # $ % ^ & * ( ) - = + _ ; : , . / ? * )</p>';

    if (wartosc.length < 8) {
        var t1 = '<p class="h_zle">- Minimalna długość 8 znaków</p>';
    }
    if (!male_litery.test(wartosc)) {
        var t2 = '<p class="h_zle">- Minimum 1 mała litera</p>';
    }
    if (!duze_litery.test(wartosc)) {
        var t3 = '<p class="h_zle">- Minimum 1 wielka litera</p>';
    }
    if (!znaki_specjalne.test(wartosc)) {
        var t4 = '<p class="h_zle">- Minimum 1 znak specjalny ( ! @ # $ % ^ & * ( ) - = + _ ; : , . / ? * )</p>';
    }

    var w1 = '<div class="wymagania_hasla" style="display:none">' + t0 + t1 + t2 + t3 + t4 + '</div>';

    $('.zapisz_zmiany_z_haslem').before(w1);

}

/*kamyk 2016-09-13*/
function znajdz_w_stringu(str, needle) {
    return (" " + str + " ").indexOf(" " + needle + " ") !== -1;
}

/*kamyk 2017-01-10*/
function isset(variable) {
    return typeof variable !== typeof undefined ? true : false;
}

function setCookie(nazwa_tmp,wartosc_tmp){
	document.cookie = nazwa_tmp + "=" + wartosc_tmp + "; path=/; ";
}

function getCookie(nazwa_tmp){
	var nazwa = nazwa_tmp + "=";
	var ca = document.cookie.split(';');
	for(var i=0; i<ca.length; i++){
		var c = ca[i].trim();
		if (c.indexOf(nazwa)==0) return c.substring(nazwa.length,c.length);
	}
	return "";
}

function deleteCookie(nazwa_tmp){
	document.cookie = nazwa_tmp + "=; path=/; ";
}

function require(script) {
    $.ajax({
    	method: "POST",
        url: script,
        dataType: "script",
        async: false
    });
}

function usun_polskie_znaki(wartosc){
	return wartosc.replace(/ą/g, 'a').replace(/Ą/g, 'A')
    .replace(/ć/g, 'c').replace(/Ć/g, 'C')
    .replace(/ę/g, 'e').replace(/Ę/g, 'E')
    .replace(/ł/g, 'l').replace(/Ł/g, 'L')
    .replace(/ń/g, 'n').replace(/Ń/g, 'N')
    .replace(/ó/g, 'o').replace(/Ó/g, 'O')
    .replace(/ś/g, 's').replace(/Ś/g, 'S')
    .replace(/ż/g, 'z').replace(/Ż/g, 'Z')
    .replace(/ź/g, 'z').replace(/Ź/g, 'Z');
}

function zadanieAjax(url_tmp, dane_tmp){
	var return_dane;
	
	$.ajax({
		method: "POST",
		url: url_tmp,
		data : dane_tmp,
		async: false,
		contentType: false,
        processData: false
	}).done(function( dane ) {
				
		return_dane = dane;
						
	}).fail(function(ajaxContext) {

		var odpowiedz = ajaxContext.responseText;
		
		alert(odpowiedz);
		
	});
	
	return return_dane;
}

function edytor_opcje_prosty() {
    $(document).ready(function () {
        $('.editor_prosty').each(function (index, element) {
            $(element).wysiwyg({
                'class': 'fake-bootstrap',
                // 'selection'|'top'|'top-selection'|'bottom'|'bottom-selection'
                toolbar: 'top',
                buttons: {
/*
                    insertimage: {
                        title: 'Insert image',
                        image: '\uf030', // <img src="path/to/image.png" width="16" height="16" alt="" />

                    },*/

                    insertlink: {
                        title: 'Insert link',
                        image: '\uf08e' // <img src="path/to/image.png" width="16" height="16" alt="" />
                    },

                    // Fontsize plugin
                    fontsize: {
                        title: 'Size',
                        style: 'color:white;background:#cccccc', // you can pass any property - example: "style"
                        image: '\uf034', // <img src="path/to/image.png" width="16" height="16" alt="" />
                        popup: function ($popup, $button) {
                            // Hack: http://stackoverflow.com/questions/5868295/document-execcommand-fontsize-in-pixels/5870603#5870603
                            var list_fontsizes = [];
                            for (var i = 8; i <= 11; ++i)
                                list_fontsizes.push(i + 'px');
                            for (var i = 12; i <= 28; i += 2)
                                list_fontsizes.push(i + 'px');
                            list_fontsizes.push('36px');
                            list_fontsizes.push('48px');
                            list_fontsizes.push('72px');
                            var $list = $('<div/>').addClass('wysiwyg-plugin-list')
                                .attr('unselectable', 'on');
                            $.each(list_fontsizes, function (index, size) {
                                var $link = $('<a/>').attr('href', '#')
                                    .html(size)
                                    .click(function (event) {
                                        $(element).wysiwyg('shell').fontSize(7).closePopup();
                                        $(element).wysiwyg('container')
                                            .find('font[size=7]')
                                            .removeAttr("size")
                                            .css("font-size", size);
                                        // prevent link-href-#
                                        event.stopPropagation();
                                        event.preventDefault();
                                        return false;
                                    });
                                $list.append($link);
                            });
                            $popup.append($list);
                        }

                    },
                    bold: {
                        title: 'Pogrubienie (Ctrl+B)',
                        image: '\uf032', // <img src="path/to/image.png" width="16" height="16" alt="" />
                        hotkey: 'b'
                    },
                    italic: {
                        title: 'Pochylenie (Ctrl+I)',
                        image: '\uf033', // <img src="path/to/image.png" width="16" height="16" alt="" />
                        hotkey: 'i'
                    },
                    underline: {
                        title: 'Podkreślenie (Ctrl+U)',
                        image: '\uf0cd', // <img src="path/to/image.png" width="16" height="16" alt="" />
                        hotkey: 'u'
                    },
                    /*strikethrough: {
                     title: 'Przekreślenie (Ctrl+S)',
                     image: '\uf0cc', // <img src="path/to/image.png" width="16" height="16" alt="" />
                     hotkey: 's'
                     },*/
                    forecolor: {
                        title: 'Kolor czcionki',
                        image: '\uf1fc' // <img src="path/to/image.png" width="16" height="16" alt="" />
                    },
                    /* highlight: {
                     title: 'Kolor tła',
                     image: '\uf043' // <img src="path/to/image.png" width="16" height="16" alt="" />
                     },*/
                    alignleft: {
                        title: 'Wyrównaj do lewej',
                        image: '\uf036', // <img src="path/to/image.png" width="16" height="16" alt="" />
                        //showstatic: true,    // wanted on the toolbar
                        showselection: false // wanted on selection
                    },
                    aligncenter: {
                        title: 'Wyśrodkój',
                        image: '\uf037', // <img src="path/to/image.png" width="16" height="16" alt="" />
                        //showstatic: true,    // wanted on the toolbar
                        showselection: false // wanted on selection
                    },
                    alignright: {
                        title: 'Wyrównaj do prawej',
                        image: '\uf038', // <img src="path/to/image.png" width="16" height="16" alt="" />
                        //showstatic: true,    // wanted on the toolbar
                        showselection: false // wanted on selection
                    },
                    alignjustify: {
                        title: 'Justowanie',
                        image: '\uf039', // <img src="path/to/image.png" width="16" height="16" alt="" />
                        //showstatic: true,    // wanted on the toolbar
                        showselection: false // wanted on selection
                    },
                   /* indent: {
                        title: 'Indent',
                        image: '\uf03c', // <img src="path/to/image.png" width="16" height="16" alt="" />
                        //showstatic: true,    // wanted on the toolbar
                        showselection: false // wanted on selection
                    },
                    outdent: {
                        title: 'Outdent',
                        image: '\uf03b', // <img src="path/to/image.png" width="16" height="16" alt="" />
                        //showstatic: true,    // wanted on the toolbar
                        showselection: false // wanted on selection
                    },*/
                    /*orderedList: {
                     title: 'Ordered list',
                     image: '\uf0cb', // <img src="path/to/image.png" width="16" height="16" alt="" />
                     //showstatic: true,    // wanted on the toolbar
                     showselection: false // wanted on selection
                     },*/
                    unorderedList: {
                        title: 'Unordered list',
                        image: '\uf0ca', // <img src="path/to/image.png" width="16" height="16" alt="" />
                        //showstatic: true,    // wanted on the toolbar
                        showselection: false // wanted on selection
                    },
                    removeformat: {
                        title: 'Remove format',
                        image: '\uf12d' // <img src="path/to/image.png" width="16" height="16" alt="" />
                    },

                    insertHTML: {
                        title: 'Insert HTML',
                        image: '\uf121', // <img src="path/to/image.png" width="16" height="16" alt="" />
                        popup: function ($popup, $button) {

                            var buttonAktualizuj = '<button type="button" class="btn btn-success width_100 insertHtmlAktualizuj">Aktualizuj HTML</button>';
                            var html = $('#wysiwyg_edytor').html();

                            $popup.append('<div class="inserHtmlEditor"><div class="inserHtmlEditorTextarea"><textarea class="">'+html+'</textarea></div>'+buttonAktualizuj+'</div>');
                            $popup.addClass('insertHtmlPopUp');
                            setTimeout(function(){
                                $popup.appendTo($('.wysiwyg-container'));
                            },1);

                        }
                    }
                },
                // Submit-Button
                submit: {
                    title: 'Submit',
                    image: '\uf00c' // <img src="path/to/image.png" width="16" height="16" alt="" />
                },
                // Other properties
                selectImage: 'Kliknij lub upuść obraz tutaj',
                placeholderUrl: 'www.example.com',
                placeholderEmbed: '<embed/>',
                maxImageSize: [760, 570],
                filterImageType: function( file ) { alert(file); },
                onKeyDown: function (key, character, shiftKey, altKey, ctrlKey, metaKey) {},
                onKeyPress: function (key, character, shiftKey, altKey, ctrlKey, metaKey) {},
                onKeyUp: function (key, character, shiftKey, altKey, ctrlKey, metaKey) {},
                onAutocomplete: function (typed, key, character, shiftKey, altKey, ctrlKey, metaKey) {},
                onImageUpload: function (insert_image) {

                    insert_image(window.URL.createObjectURL($('.wysiwyg-browse input')[0].files[0]));

/*
                    var input = $('.wysiwyg-browse input')[0].files[0];

                    if (!/^image/.test(input.type)) {
                        alert('Wybierz obraz!!!');
                        return false;
                    }

                    var formData = new FormData();
                    formData.append('obraz', input);

                    $.ajax({
                        method: "POST",
                        url: "ajax/akcje/ajax_zapisz_obraz_do_tmp",
                        data: formData,
                        contentType: false,
                        processData: false

                    }).done(function (data) {
                        insert_image(adres_hosta + '/moduly/mailing/tmp/' + data);

                    }).fail(function (ajaxContext) {
                        document.getElementById("body_strona_r").innerHTML = ajaxContext.responseText;
                    });*/
                },
                forceImageUpload: true, // upload images even if File-API is present
                videoFromUrl: function (url) {}
            });

        });

    });
}

/*kamyk 2016-09-01*/
function edytor_opcje() {
    $(document).ready(function () {
        $('.editor').each(function (index, element) {
            $(element).wysiwyg({
                'class': 'fake-bootstrap',
                // 'selection'|'top'|'top-selection'|'bottom'|'bottom-selection'
                toolbar: 'top',
                buttons: {

                     insertimage: {
                     title: 'Insert image',
                     image: '\uf030', // <img src="path/to/image.png" width="16" height="16" alt="" />


                     },

                     insertlink: {
                     title: 'Insert link',
                     image: '\uf08e' // <img src="path/to/image.png" width="16" height="16" alt="" />
                     },

                    // Fontsize plugin
                    fontsize: {
                        title: 'Size',
                        style: 'color:white;background:#cccccc', // you can pass any property - example: "style"
                        image: '\uf034', // <img src="path/to/image.png" width="16" height="16" alt="" />
                        popup: function ($popup, $button) {
                            // Hack: http://stackoverflow.com/questions/5868295/document-execcommand-fontsize-in-pixels/5870603#5870603
                            var list_fontsizes = [];
                            for (var i = 8; i <= 11; ++i)
                                list_fontsizes.push(i + 'px');
                            for (var i = 12; i <= 28; i += 2)
                                list_fontsizes.push(i + 'px');
                            list_fontsizes.push('36px');
                            list_fontsizes.push('48px');
                            list_fontsizes.push('72px');
                            var $list = $('<div/>').addClass('wysiwyg-plugin-list')
                                .attr('unselectable', 'on');
                            $.each(list_fontsizes, function (index, size) {
                                var $link = $('<a/>').attr('href', '#')
                                    .html(size)
                                    .click(function (event) {
                                        $(element).wysiwyg('shell').fontSize(7).closePopup();
                                        $(element).wysiwyg('container')
                                            .find('font[size=7]')
                                            .removeAttr("size")
                                            .css("font-size", size);
                                        // prevent link-href-#
                                        event.stopPropagation();
                                        event.preventDefault();
                                        return false;
                                    });
                                $list.append($link);
                            });
                            $popup.append($list);
                        }

                    },
                    bold: {
                        title: 'Pogrubienie (Ctrl+B)',
                        image: '\uf032', // <img src="path/to/image.png" width="16" height="16" alt="" />
                        hotkey: 'b'
                    },
                    italic: {
                        title: 'Pochylenie (Ctrl+I)',
                        image: '\uf033', // <img src="path/to/image.png" width="16" height="16" alt="" />
                        hotkey: 'i'
                    },
                    underline: {
                        title: 'Podkreślenie (Ctrl+U)',
                        image: '\uf0cd', // <img src="path/to/image.png" width="16" height="16" alt="" />
                        hotkey: 'u'
                    },
                    /*strikethrough: {
                     title: 'Przekreślenie (Ctrl+S)',
                     image: '\uf0cc', // <img src="path/to/image.png" width="16" height="16" alt="" />
                     hotkey: 's'
                     },*/
                    forecolor: {
                        title: 'Kolor czcionki',
                        image: '\uf1fc' // <img src="path/to/image.png" width="16" height="16" alt="" />
                    },
                    /* highlight: {
                     title: 'Kolor tła',
                     image: '\uf043' // <img src="path/to/image.png" width="16" height="16" alt="" />
                     },*/
                    alignleft: {
                        title: 'Wyrównaj do lewej',
                        image: '\uf036', // <img src="path/to/image.png" width="16" height="16" alt="" />
                        //showstatic: true,    // wanted on the toolbar
                        showselection: false // wanted on selection
                    },
                    aligncenter: {
                        title: 'Wyśrodkój',
                        image: '\uf037', // <img src="path/to/image.png" width="16" height="16" alt="" />
                        //showstatic: true,    // wanted on the toolbar
                        showselection: false // wanted on selection
                    },
                    alignright: {
                        title: 'Wyrównaj do prawej',
                        image: '\uf038', // <img src="path/to/image.png" width="16" height="16" alt="" />
                        //showstatic: true,    // wanted on the toolbar
                        showselection: false // wanted on selection
                    },
                    alignjustify: {
                        title: 'Justowanie',
                        image: '\uf039', // <img src="path/to/image.png" width="16" height="16" alt="" />
                        //showstatic: true,    // wanted on the toolbar
                        showselection: false // wanted on selection
                    },
                  /*  indent: {
                        title: 'Indent',
                        image: '\uf03c', // <img src="path/to/image.png" width="16" height="16" alt="" />
                        //showstatic: true,    // wanted on the toolbar
                        showselection: false // wanted on selection
                    },
                    outdent: {
                        title: 'Outdent',
                        image: '\uf03b', // <img src="path/to/image.png" width="16" height="16" alt="" />
                        //showstatic: true,    // wanted on the toolbar
                        showselection: false // wanted on selection
                    },*/
                    /*orderedList: {
                     title: 'Ordered list',
                     image: '\uf0cb', // <img src="path/to/image.png" width="16" height="16" alt="" />
                     //showstatic: true,    // wanted on the toolbar
                     showselection: false // wanted on selection
                     },*/
                    unorderedList: {
                        title: 'Unordered list',
                        image: '\uf0ca', // <img src="path/to/image.png" width="16" height="16" alt="" />
                        //showstatic: true,    // wanted on the toolbar
                        showselection: false // wanted on selection
                    },
                    removeformat: {
                        title: 'Remove format',
                        image: '\uf12d' // <img src="path/to/image.png" width="16" height="16" alt="" />
                    },

                    insertHTML: {
                        title: 'Insert HTML',
                        image: '\uf121', // <img src="path/to/image.png" width="16" height="16" alt="" />
                        popup: function ($popup, $button) {

                            var buttonAktualizuj = '<button type="button" class="btn btn-success width_100 insertHtmlAktualizuj">Aktualizuj HTML</button>';
                            var html = $('#wysiwyg_edytor').html();

                            $popup.append('<div class="inserHtmlEditor"><div class="inserHtmlEditorTextarea"><textarea class="">'+html+'</textarea></div>'+buttonAktualizuj+'</div>');
                            $popup.addClass('insertHtmlPopUp');
                            setTimeout(function(){
                                $popup.appendTo($('.wysiwyg-container'));
                            },1);

                        }
                    }
                },
                // Submit-Button
                submit: {
                    title: 'Submit',
                    image: '\uf00c' // <img src="path/to/image.png" width="16" height="16" alt="" />
                },
                // Other properties
                selectImage: 'Kliknij lub upuść obraz tutaj',
                placeholderUrl: 'www.example.com',
                placeholderEmbed: '<embed/>',
                maxImageSize: [760, 570],
                filterImageType: function( file ) { alert(file); },
                onKeyDown: function (key, character, shiftKey, altKey, ctrlKey, metaKey) {},
                onKeyPress: function (key, character, shiftKey, altKey, ctrlKey, metaKey) {},
                onKeyUp: function (key, character, shiftKey, altKey, ctrlKey, metaKey) {},
                onAutocomplete: function (typed, key, character, shiftKey, altKey, ctrlKey, metaKey) {},
                onImageUpload: function (insert_image) {

                    //insert_image(window.URL.createObjectURL($('.wysiwyg-browse input')[0].files[0]));


                    var input = $('.wysiwyg-browse input')[0].files[0];

                     if (!/^image/.test(input.type)) {
                     alert('Wybierz obraz!!!');
                     return false;
                     }

                     var formData = new FormData();
                     formData.append('obraz', input);

                     $.ajax({
                     method: "POST",
                     url: "ajax/akcje/ajax_zapisz_obraz_do_tmp",
                     data: formData,
                     contentType: false,
                     processData: false

                     }).done(function (data) {
                     insert_image(adres_hosta + '/moduly/mailing/tmp/' + data);

                     }).fail(function (ajaxContext) {
                     document.getElementById("body_strona_r").innerHTML = ajaxContext.responseText;
                     });
                },
                forceImageUpload: true, // upload images even if File-API is present
                videoFromUrl: function (url) {}
            });

        });

    });
}

function powiadomienieBoczne(rodzaj_tmp, tytul_tmp, tresc_tmp){

    var typ;
    var ikona;

    if(rodzaj_tmp === 'sukces'){
        typ = 'success';
        ikona = 'fa fa-check';
    }

    if(rodzaj_tmp === 'blad'){
        typ = 'danger';
        ikona = 'fa fa-exclamation';
    }

    if(rodzaj_tmp === 'info'){
        typ = 'info';
        ikona = 'fa fa-info';
    }

    if(rodzaj_tmp === 'uwaga'){
        typ = 'warning';
        ikona = 'fa fa-exclamation-triangle';
    }

    $.notify({
        icon: ikona,
        title: tytul_tmp,
        message: tresc_tmp
    },{
        element: 'body',
        type: typ,
        allow_dismiss: true,
        newest_on_top: true,
        placement: {
            from: "bottom",
            align: "left"
        },
        offset: {
            x: 20,
            y: 20
        },
        spacing: 10,
        z_index: 9999,
        delay: 5000,
        icon_type: 'class',
        template:   '<div data-notify="container" class="col-xs-11 col-lg-3 col-md-3 col-sm-3 pow_alert_sm alert alert-{0} " role="alert">' +
        '<button type="button" aria-hidden="true" class="close" data-notify="dismiss">×</button>' +
        '<span data-notify="icon" class="margin_r_10"></span> ' +
        '<span data-notify="title">{1}</span> ' +
        '<span data-notify="message">{2}</span>' +
        '<div class="progress" data-notify="progressbar">' +
        '<div class="progress-bar progress-bar-{0}" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>' +
        '</div>' +
        '<a href="{3}" target="{4}" data-notify="url"></a>' +
        '</div>'
    });
}

function aktywujDataTable(klasa, order, order_kierunek, ilewynikow){
    if(!$('.'+klasa).hasClass('dataTable')){
        if(ilewynikow == undefined || ilewynikow == ''){
            ilewynikow = 10;
        }

/*
            $('.'+klasa+' tfoot th').each( function () {
                var title = $(this).text();
                $(this).html( '<input type="text" placeholder="'+title+'" />' );
            } );
*/
        //var table = $('.'+klasa).DataTable({
        $('.'+klasa).DataTable({
            "language": {
                "emptyTable":     "Brak danych",
                "info":           "Liczba wierszy: _TOTAL_",
                "infoEmpty":      "Liczba wierszy: 0",
                "lengthMenu":     "Wyświetl _MENU_",
                "loadingRecords": "Ładowanie...",
                "searchPlaceholder": "Wyszukaj",
                "zeroRecords":    "Brak wyników wyszukiwania",
                "paginate": {
                    "first":      "Pierwszy",
                    "last":       "Ostatni",
                    "next":       "Następny",
                    "previous":   "Poprzedni"
                },
                "search":         "",
                "infoFiltered": "(wyfiltrowano z _MAX_)"
            },
            "lengthMenu": [[ilewynikow, 25, -1], [ilewynikow, 25, "Wszystkie"]],
            "order": [[ order, order_kierunek ]],
            "iDisplayLength": ilewynikow,
            "aoColumnDefs": [
                {
                    "bSortable": false,
                    "aTargets": [ -1 ] // <-- gets last column and turns off sorting
                }
            ]
        });
/*
        table.columns().every( function () {
            var that = this;

            $( 'input', this.footer() ).on( 'keyup change', function () {
                console.log('keypu')
                if ( that.search() !== this.value ) {
                    that
                        .search( this.value )
                        .draw();
                }
            } );
        } );
*/
    }
}


function aktywuj_kalendarz(){

    var formData = new FormData();
    formData.append('akcja', 'lista_szkolen');

    mainPanel.zaladujTrescAjax('ajax/akcje/ajax_wczytaj_dane', formData);

    var lista_szkolen = $.parseJSON(mainPanel.zawartoscTrescAjax());

    //console.log(lista_szkolen);

    document.getElementById('panel_body_zawartosc').innerHTML = '<div id="kalendarz_tresc"></div>';

    $(document).ready(function () {

            $('#kalendarz_tresc').fullCalendar({
                events: lista_szkolen,
                lang: 'pl',
                timezone: 'local',
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,agendaWeek'
                },
                defaultView: 'month',
                editable: false,
                height: 'auto',
                droppable: false,
                slotDuration: '00:30:00',
                minTime: '07:00:00',
                maxTime: '20:00:00'
                ,timeFormat: 'H:mm'

                ,dayClick: function (date, allDay, jsEvent, view) {

                },eventClick: function (calEvent, jsEvent, view) {
                    //szkoleniaMain.wczytajDaneDoPopUp(calEvent.id, 'wyswietl_szkolenie', 'szkolenia', ((calEvent.className == 'zapisany') ? 'modal-lg' : 'modal-lgsm'));
                    mainPanel.wczytajDaneDoPopUp(calEvent.id, 'wyswietl_szkolenie', 'szkolenia', 'modal-lgsm', 'wczytaj_dane');

                },eventResize: function (event, delta, revertFunc) {

                },eventDrop: function (event, delta, revertFunc) {

                },eventRender: function (event, element) {
                    element.find('.fc-title').html(event.title);
                }
            });

            $('#panel_body_zawartosc').prepend('<div class="panel panel-default margin_b_10"><div class="panel-heading"><i data-akcja="dodaj_szkolenie" data-rodzaj="dodaj_nowy" class="float_r fa fa-plus dodaj_element" aria-hidden="true"></i><div class="clear_b"></div></div></div>');

            $('.fc-toolbar button').click(function(){
                kalendarz_czysczenie();
            });

            kalendarz_czysczenie();

            var formData2 = new FormData();
            formData2.append('akcja', 'lista_szkolen_kalendarz');
            mainPanel.zaladujTrescAjax('ajax/akcje/ajax_wczytaj_dane', formData2);
            $('#panel_body_zawartosc').append(mainPanel.zawartoscTrescAjax());


            mainPanel.aktywujKontrolkiBootstrapowe();
            mainPanel.ukryjLoader();


    });

}

function kalendarz_czysczenie(){
    $('.fc-time span').text(function(){
        var text_p = $(this).text();
        if(text_p.length == 2){
            $(this).text(text_p+':00');
        }
    });
    $('.fc-axis').css({'width':'37px'});

    $('.fc-day-grid').hide();

    $('.fc-day-grid-container .fc-day-grid').show();

    $('.fc-event').addClass('cursor_p');
}


