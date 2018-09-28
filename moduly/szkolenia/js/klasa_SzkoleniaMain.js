function SzkoleniaMain(){
    var sekunda;
    var minuta;

    this.zapiszUsunDoSzkolenia = function(_akcja, _tabela, _dane){
        if(_akcja !== 'usun_ze_szkolenia'){
            mainPanel.wyswietlLoader('#popUpTresc');
        }

        var formData = new FormData();
            formData.append('akcja', _akcja);
            formData.append('tabela', _tabela);
            formData.append('szkolenia_id', _dane['_szkolenia_id']);
            formData.append('uzytkownik_id', _dane['_uzytkownik_id']);

        mainPanel.zaladujTrescAjax('ajax/akcje/ajax_aktualizuj_dane', formData);

        var odpowiedz = $.parseJSON(mainPanel.zawartoscTrescAjax());

        powiadomienieBoczne(odpowiedz['rodzaj'],'',odpowiedz['komunikat']);

        if(_akcja !== 'usun_ze_szkolenia'){
            $('#popUp').modal('hide');
        }

        mainPanel.wyswietlLoader('#panel_body_zawartosc');

        if(getCookie('aktywnaZakladka') === 'zakladka_kalendarz_szkolen'){
            mainPanel.wyswietlLoader('#panel_body_zawartosc');
            aktywuj_kalendarz();

            return false;
        }

        mainPanel.zaladujTrescAjax('ajax/widoki/widok_'+mainPanel.zakladkaId(), null);
        mainPanel.wyswietlTresc('panel_body_zawartosc', mainPanel.zawartoscTrescAjax());

        this.listaKonczacychSieSzkolen();
    },

    this.dodajOdpowiedzDoPytania = function(_dane){
        var formData = new FormData();
        formData.append('akcja', _dane['_akcja']);
        formData.append('tabela', _dane['_tabela']);
        formData.append('element_id', _dane['_element_id']);

        var polePrm = $('.'+_dane['_rodzic']+' .prm');
        var liczbaPrm = polePrm.size();
        var wartosciPrm = {};
        var warPrm = '';
        var kluczPrm = '';
        var klasaPrm = '';

        mainPanel.SprawdzWymaganePola(_dane['_rodzic'], liczbaPrm);

        if($('.wymaganeBlad').size() != 0){
            powiadomienieBoczne('blad','','Uzupełnij wymagane pola!!!');
            return false;
        }

        for(var i=0;i<liczbaPrm;i++) {
            kluczPrm = polePrm[i].getAttribute('data-kolumna');
            klasaPrm = polePrm[i].getAttribute('class');
            if (klasaPrm.indexOf('attrValue') < 0) {
                //console.log('nie ma');
                warPrm = $('.' + _dane['_rodzic'] + ' .prm')[i].value;
            } else {
                //console.log('jest');
                warPrm = $('.' + _dane['_rodzic'] + ' .prm')[i].getAttribute('value');
            }

            if (warPrm.length == 0) {
                warPrm = 'null';
            }
            wartosciPrm[kluczPrm] = warPrm;
        }

        formData.append('dane', JSON.stringify(wartosciPrm));

        mainPanel.zaladujTrescAjax('ajax/akcje/ajax_szkolenia_testy', formData);

        var odpowiedz = $.parseJSON(mainPanel.zawartoscTrescAjax());
        powiadomienieBoczne(odpowiedz['rodzaj'],'',odpowiedz['komunikat']);

        if(odpowiedz[0] == 1){
            $('.odtDodajPytanie').slideUp();
            $('.odtDodajPytanie .nr_kolejnosci').val('0').text('0');
            $('.odtDodajPytanie .liczba_pkt').val('1').text('1');
            $('.odtDodajPytanie .dpUstawOpcjeNazwa').val('2').text('Otwarte');
            $('.odtDodajPytanie .odtTrescPytania').val('').text('');

            var formData2 = new FormData();
            formData2.append('akcja', 'lista_pytan');
            formData2.append('id', $('.odtListaPytanLista').data('szkolenia_testy_id'));

            mainPanel.zaladujTrescAjax('ajax/akcje/ajax_wczytaj_dane', formData2);

            var ListaPytanTresc = $.parseJSON(mainPanel.zawartoscTrescAjax());
            document.getElementById('odtListaPytan').innerHTML = ListaPytanTresc['tresc'];

            mainPanel.aktywujKontrolkiBootstrapowe();

            //$('.'+_dane['_rodzic']).show();
            $('.'+_dane['_rodzic']).parent().parent().parent().parent().show();
            $('.'+_dane['_rodzic']).parent().parent().parent().parent().prev().show();

        }

    },

    this.zapiszZmianyTest = function(_dane){
        var formData = new FormData();
        formData.append('akcja', _dane['_akcja']);
        formData.append('tabela', _dane['_tabela']);
        formData.append('element_id', _dane['_element_id']);

        var polePrm = $('.'+_dane['_rodzic']+' .prm');
        var liczbaPrm = polePrm.size();
        var wartosciPrm = {};
        var warPrm = '';
        var kluczPrm = '';
        var klasaPrm = '';

        //console.log(_dane['_rodzic']);
        //console.log(liczbaPrm);

        mainPanel.SprawdzWymaganePola(_dane['_rodzic'], liczbaPrm);

        if($('.wymaganeBlad').size() != 0){
            powiadomienieBoczne('blad','','Uzupełnij wymagane pola!!!');
            return false;
        }


            for(var i=0;i<liczbaPrm;i++){
                kluczPrm = polePrm[i].getAttribute('data-kolumna');
                klasaPrm = polePrm[i].getAttribute('class');
                if(klasaPrm.indexOf('attrValue') < 0){
                    //console.log('nie ma');
                    warPrm = $('.'+_dane['_rodzic']+' .prm')[i].value;
                }else{
                    //console.log('jest');
                    warPrm = $('.'+_dane['_rodzic']+' .prm')[i].getAttribute('value');
                }

                if(warPrm.length == 0){
                    warPrm = 'null';
                }
                if(_dane['_odpowiedz_wiele'] == 0) {
                    wartosciPrm[kluczPrm] = warPrm;
                }else{
                    wartosciPrm[kluczPrm] = ((wartosciPrm[kluczPrm] != undefined) ? wartosciPrm[kluczPrm] + ',' : '' ) + warPrm;
                }
            }



        //console.log(wartosciPrm);
        formData.append('dane', JSON.stringify(wartosciPrm));

        mainPanel.zaladujTrescAjax('ajax/akcje/ajax_szkolenia_testy', formData);

        var odpowiedz = $.parseJSON(mainPanel.zawartoscTrescAjax());
        powiadomienieBoczne(odpowiedz['rodzaj'],'',odpowiedz['komunikat']);

        if(odpowiedz[0] == 1){
            if(odpowiedz['przeladujWidok'] == 1){
                $('.odtDodajPytanie').slideUp();
                $('.odtDodajPytanie .nr_kolejnosci').val('0').text('0');
                $('.odtDodajPytanie .liczba_pkt').val('1').text('1');
                $('.odtDodajPytanie .dpUstawOpcjeNazwa').val('2').text('Otwarte');
                $('.odtDodajPytanie .odtTrescPytania').val('').text('');

                var formData2 = new FormData();
                formData2.append('akcja', 'lista_pytan');
                formData2.append('id', odpowiedz['element_id']);

                mainPanel.zaladujTrescAjax('ajax/akcje/ajax_wczytaj_dane', formData2);

                var ListaPytanTresc = $.parseJSON(mainPanel.zawartoscTrescAjax());
                document.getElementById('odtListaPytan').innerHTML = ListaPytanTresc['tresc'];

                mainPanel.aktywujKontrolkiBootstrapowe();

                if(_dane['_akcja'] == 'aktualizuj_pytanie'){
                    $('.'+_dane['_rodzic']).show();
                    $('.'+_dane['_rodzic']).next().show();
                }
            }
        }
    },

    this.rozpocznijRozwiazywanieTestu = function(_dane){
        mainPanel.wyswietlLoader('#popUpTresc2');

        var formData = new FormData();
            formData.append('akcja', _dane['_akcja']);
            formData.append('tabela', _dane['_tabela']);
            formData.append('element_id', _dane['_element_id']);

        mainPanel.zaladujTrescAjax('ajax/akcje/ajax_szkolenia_testy', formData);

        var odpowiedz = $.parseJSON(mainPanel.zawartoscTrescAjax());

        powiadomienieBoczne(odpowiedz['rodzaj'],'',odpowiedz['komunikat']);

        if(odpowiedz[0] == 1){

            formData = new FormData();
                formData.append('akcja', 'wyswietl_test');
                formData.append('tabela', 'szkolenia_testy');
                formData.append('id', _dane['_element_id']);

            mainPanel.zaladujTrescAjax('ajax/akcje/ajax_wczytaj_dane', formData);

            odpowiedz = $.parseJSON(mainPanel.zawartoscTrescAjax());

            document.getElementById('popUpTresc2').innerHTML = odpowiedz['tresc'];
            document.getElementById('popUpTytul2').innerHTML = odpowiedz['tytul'];
        }else{
            mainPanel.ukryjLoader();
        }

    },

    this.obliczWynikTestu = function(_dane){
        mainPanel.wyswietlLoader('#popUpTresc2');

        var formData = new FormData();
            formData.append('akcja', 'aktualizuj_wynik_testu');
            formData.append('tabela', _dane['_tabela']);
            formData.append('element_id', _dane['_element_id']);

        mainPanel.zaladujTrescAjax('ajax/akcje/ajax_szkolenia_testy', formData);

        var odpowiedz = $.parseJSON(mainPanel.zawartoscTrescAjax());

        powiadomienieBoczne(odpowiedz['rodzaj'],'',odpowiedz['komunikat']);

        if(odpowiedz['wyslanyMail'] == 1){
            powiadomienieBoczne('sukces','',odpowiedz['wyslanyMailKomunikat']);
        }

        if(odpowiedz[0] == 1){

            formData = new FormData();
            formData.append('akcja', 'wyswietl_test');
            formData.append('tabela', 'szkolenia_testy');
            formData.append('id', odpowiedz['element_id']);

            mainPanel.zaladujTrescAjax('ajax/akcje/ajax_wczytaj_dane', formData);

            odpowiedz = $.parseJSON(mainPanel.zawartoscTrescAjax());

            document.getElementById('popUpTresc2').innerHTML = odpowiedz['tresc'];
            document.getElementById('popUpTytul2').innerHTML = odpowiedz['tytul'];
        }else{
            mainPanel.ukryjLoader();
        }



    },

    this.ocenOdpowiedzUzytkownika = function(_dane){
        mainPanel.wyswietlLoader('.testDoSprawdzeniaPytania');

        var formData = new FormData();
            formData.append('akcja', 'ocen_odpowiedz_uzytkownika');
            formData.append('tabela', _dane['_tabela']);
            formData.append('element_id', _dane['_element_id']);
            formData.append('liczba_punktow', _dane['_liczba_punktow']);

        mainPanel.zaladujTrescAjax('ajax/akcje/ajax_szkolenia_testy', formData);

        var odpowiedz = $.parseJSON(mainPanel.zawartoscTrescAjax());

        powiadomienieBoczne(odpowiedz['rodzaj'],'',odpowiedz['komunikat']);

        mainPanel.ukryjLoader();

        if(odpowiedz['przeladujWidok'] == 1){
            if(mainPanel.zakladkaId() === 'kalendarz_szkolen'){
                this.wyswietlLoader('#panel_body_zawartosc');
                aktywuj_kalendarz();
            }else{
                mainPanel.wyswietlLoader('#panel_body_zawartosc');

                mainPanel.zaladujTrescAjax('ajax/widoki/widok_'+mainPanel.zakladkaId(), null);
                mainPanel.wyswietlTresc('panel_body_zawartosc', mainPanel.zawartoscTrescAjax());
            }
        }

        if(odpowiedz['wyslanyMail'] == 1){
            powiadomienieBoczne('sukces','',odpowiedz['wyslanyMailKomunikat']);
        }
    },

    this.listaKonczacychSieSzkolen = function(){
        var formData = new FormData();
            formData.append('akcja', 'lista_konczacych_sie_szkolen');
        mainPanel.zaladujTrescAjax('ajax/akcje/ajax_szkolenia_testy', formData);

        var odpowiedz = $.parseJSON(mainPanel.zawartoscTrescAjax());

        document.getElementById('listaKonczacychSieSzkolen').innerHTML = odpowiedz['tresc'];
    },

    this.dodajUczesnitkaWyszukajDoSzkolenia = function(_dane){

        var formData = new FormData();
            formData.append('akcja', 'zapisz_do_szkolenia_administracyjnie');
            formData.append('tabela', 'szkolenia_id_uzytkownik_id');
            formData.append('szkolenia_id', _dane['_szkolenia_id']);
            formData.append('uzytkownik_id', _dane['_uzytkownik_id']);

        mainPanel.zaladujTrescAjax('ajax/akcje/ajax_aktualizuj_dane', formData);

        var odpowiedz = $.parseJSON(mainPanel.zawartoscTrescAjax());

        powiadomienieBoczne(odpowiedz['rodzaj'],'',odpowiedz['komunikat']);

        this.listaKonczacychSieSzkolen();

        if(odpowiedz['przeladujPopUp'] == 1){
            mainPanel.wyswietlLoader('#popUpTresc');

            formData = new FormData();
                formData.append('akcja', 'edytuj_szkolenie');
                formData.append('tabela', 'szkolenia');
                formData.append('id', odpowiedz['przeladujPopUpElementId']);

            mainPanel.zaladujTrescAjax('ajax/akcje/ajax_wczytaj_dane', formData);

            var popUpTresc = $.parseJSON(mainPanel.zawartoscTrescAjax());
            mainPanel.wyswietlTresc('popUpTresc', popUpTresc['tresc']);
            $('#popUpTresc .active').removeClass('active');
            $('.'+odpowiedz['przeladujPopUpAktywnaZakladka']).addClass('active');
        }

        if(odpowiedz['przeladujWidok'] == 1){
            if(mainPanel.zakladkaId() === 'kalendarz_szkolen'){
                mainPanel.wyswietlLoader('#panel_body_zawartosc');
                aktywuj_kalendarz();
            }else{
                mainPanel.wyswietlLoader('#panel_body_zawartosc');

                mainPanel.zaladujTrescAjax('ajax/widoki/widok_'+mainPanel.zakladkaId(), null);
                mainPanel.wyswietlTresc('panel_body_zawartosc', mainPanel.zawartoscTrescAjax());
            }
        }

    },

    this.odliczajCzasTestu = function(){
        minuta = parseInt($('.testMinuta').text());
        sekunda = parseInt($('.testSekunda').text());

        if((sekunda - 1) < 0){
            sekunda = 59;
            if((minuta - 1) < 0){
                return true;
            }
            minuta = minuta - 1;
        }else{
            sekunda = sekunda - 1;
            if(sekunda < 10){
                sekunda = '0' + sekunda;
            }
        }

        if(minuta == 0){

            $('.testDoRozwiazaniaPytania .alert-warning').remove();
            $('.testDoRozwiazaniaPytania').prepend('<div class="alert alert-warning" role="alert"><b>UWAGA!!!</b> Po zakończeniu odliczania test zostanie wyłączony automatycznie!!!</div>');

        }

        $('.testMinuta').text(minuta);
        $('.testSekunda').text(sekunda);

        return false;
    },

    this.wyslijWiadomoscDoUczestnikow = function(_dane){
        var temat = $('.wyslijWidomoscDoWszystkichUczestnikow .tytulWiadomosci').val();
        var tresc = $('.wyslijWidomoscDoWszystkichUczestnikow .trescWiadomosci').val();


        if(temat === '' || tresc === ''){
            powiadomienieBoczne('blad','','Uzupełnij temat i treść!!!');
            return;
        }

        mainPanel.wyswietlLoader('#popUp2');
        var liczba_uczestnikow = $('.pojedynczyUczestnik').size();

        if(liczba_uczestnikow === 0){
            powiadomienieBoczne('blad','','Musisz podać przynajmniej jednego odbiorcę!!!');
            return;
        }

        var mailing_zalaczniki = [];
        var liczba_zalacznikow = $('.mailing_zalacznik').size();
        var z=0;
        for(z;z<liczba_zalacznikow;z++){
            mailing_zalaczniki[z] = $('.mailing_zalacznik')[z].getAttribute('data-email_zalacznik');

        }

        var email;

        var formData = new FormData();
            formData.append('akcja', _dane['_akcja']);
            formData.append('tabela', _dane['_tabela']);
            formData.append('element_id', _dane['_element_id']);
            formData.append('mailing_zalaczniki', mailing_zalaczniki);
            formData.append('temat', temat);
            formData.append('tresc', tresc);
            //formData.append('inni_adresaci', inni_adresaci);

        var odpowiedz;
        var send_mail = new Array();
        var error_mail = new Array();


        for(var i = 0; i<liczba_uczestnikow; i++){
            //console.log('test');
            email = $('.pojedynczyUczestnik')[i].getAttribute('data-email');

            formData.append('email', email);

            mainPanel.zaladujTrescAjax('ajax/akcje/ajax_wyslij_wiadomosc', formData);

            odpowiedz = $.parseJSON(mainPanel.zawartoscTrescAjax());

            if(odpowiedz[0] === 1){
                powiadomienieBoczne('sukces','','Wysłano do '+email);
                send_mail.push(email);
            }else{
                powiadomienieBoczne('blad','','Błąd wysyłania do '+email+' '+odpowiedz[1]);
                error_mail.push(email);
            }

            if((i + 1) === liczba_uczestnikow){
                //powiadomienieBoczne('sukces','','Wiadomości zostały wysłane!!!');
                mainPanel.ukryjLoader();
            }

        }

        var inni_adresaci = $('.wyslijWidomoscDoWszystkichUczestnikow .inniAdresaci').val();

        var adresaci = inni_adresaci.split(";");
        var liczba_adresatow = adresaci.length;

        for(var i = 0; i<liczba_adresatow; i++){
            //console.log('test');

            formData.append('email', adresaci[i]);

            mainPanel.zaladujTrescAjax('ajax/akcje/ajax_wyslij_wiadomosc', formData);

            odpowiedz = $.parseJSON(mainPanel.zawartoscTrescAjax());

            if(odpowiedz[0] === 1){
                powiadomienieBoczne('sukces','','Wysłano do '+adresaci[i]);
                send_mail.push(adresaci[i]);
            }else{
                powiadomienieBoczne('blad','','Błąd wysyłania do '+adresaci[i]+' '+odpowiedz[1]);
                error_mail.push(adresaci[i]);
            }

            if((i + 1) === liczba_uczestnikow){
                //powiadomienieBoczne('sukces','','Wiadomości zostały wysłane!!!');
                mainPanel.ukryjLoader();
            }

        }

        var nowa_akcja = 'wyslij_potwierdzenie_do_organizatora';

        formData.append('send_mail', send_mail);
        formData.append('error_mail', error_mail);
        formData.append('akcja', nowa_akcja);

        mainPanel.zaladujTrescAjax('ajax/akcje/ajax_wyslij_wiadomosc', formData);

    }

}

/*
//dodaję właściwość i metodę do prototypu
SzkoleniaMain.prototype.showInfo = function () {
    alert('test');
}

szkoleniaMain.showInfo();
*/

