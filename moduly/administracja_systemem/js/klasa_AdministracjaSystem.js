function AdministracjaSystemMain(){
    this.zapiszZmianyAdministracja = function(_dane){
        $('.'+_dane['_rodzic']+' .prm').removeClass('prm');

        mainPanel.sprawdzWartosciPrm(_dane['_rodzic']);

        var polePrm = $('.'+_dane['_rodzic']+' .prm');
        var liczbaPrm = polePrm.size();

        if(liczbaPrm === 0){
            mainPanel.wyswietlPowiadomienieBoczne('blad','','Nie wykryto zmian!!!');
            return;
        }

        var poleUzytkownikHaslo = $('.'+_dane['_rodzic']+' .uzytkownikHaslo');

        if(poleUzytkownikHaslo.hasClass('prm')){
            if(poleUzytkownikHaslo.val() !== $('.'+_dane['_rodzic']+' .uzytkownikHasloPowtorz').val()){
                mainPanel.wyswietlPowiadomienieBoczne('blad','','Podane hasła są różne!!!');
                return;
            }
            if(!this.sprawdzPoprawnoscHasla(poleUzytkownikHaslo.val())){
                return;
            }

        }

        formData = new FormData();
            formData.append('akcja', _dane['_akcja']);
            formData.append('tabela', _dane['_tabela']);
            formData.append('element_id', _dane['_element_id']);

        var wartosciPrm = {};
        var warPrm = '';
        var kluczPrm = '';
        var klasaPrm = '';
        var akcja = _dane['_akcja'];

        mainPanel.SprawdzWymaganePola(_dane['_rodzic'], liczbaPrm);

        if($('.wymaganeBlad').size() !== 0){
            mainPanel.wyswietlPowiadomienieBoczne('blad','','Uzupełnij wymagane pola!!!');
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

            if(warPrm.length === 0){
                warPrm = 'null';
            }
            wartosciPrm[kluczPrm] = warPrm;
        }

        var przyciskUploadPrzycisk = $('.przyciskUploadPrzycisk');

        if(przyciskUploadPrzycisk.val() !== '' && przyciskUploadPrzycisk.hasClass('prm')){
            formData.append('plik', przyciskUploadPrzycisk[0].files[0]);
        }else{
            formData.append('plik', 'null');
        }

        formData.append('dane', JSON.stringify(wartosciPrm));

        mainPanel.zaladujTrescAjax('ajax/akcje/ajax_aktualizuj_dane', formData);

        odpowiedzAjax = $.parseJSON(mainPanel.zawartoscTrescAjax());

        mainPanel.wyswietlPowiadomienieBoczne(odpowiedzAjax['rodzaj'],'',odpowiedzAjax['komunikat']);

        if(odpowiedzAjax['ukryjPopUp1'] === 1) {
            $('#popUp').modal('hide');
        }

        var aktywnaZakladka = $('.panel_body_zawartosc .tab-pane.active').attr('id');
        var aktywnaGrupa = $('.panel_body_zawartosc .aktywnyPanel').attr('id');

        if(odpowiedzAjax['przeladujWidokZakladki'] === 1){
            if(_dane['_tabela'] === 'uzytkownik'){
                mainPanel.aktywujZakladke('zakladka_zarzadzanie_uzytkownikami');
            }

            if(_dane['_tabela'] === 'powiadomienia'){
                mainPanel.aktywujZakladke('zakladka_powiadomienia');
            }

            if(_dane['_tabela'] === 'uzytkownik_grupy'){
                if(_dane['_akcja'] === 'uprawnienia_zapisz_zmiany'){
                    mainPanel.aktywujZakladke('zakladka_zarzadzanie_uprawnieniami');
                }else{
                    mainPanel.aktywujZakladke('zakladka_zarzadzanie_grupami');
                }
            }


            $('.panel_body_zawartosc .active').removeClass('active');
            $('#'+aktywnaZakladka).addClass('active');
            $('.'+aktywnaZakladka).addClass('active');
            $('#'+aktywnaGrupa).addClass('aktywnyPanel');
            $('#'+aktywnaGrupa+' .ukryj_widok').show();
        }

        if(odpowiedzAjax['przeladujSzczegolyElementu'] === 1){
            akcja = 'edytuj_uzytkownika';

            if(_dane['_tabela'] === 'powiadomienia'){
                akcja = 'edytuj_powiadomienie';
            }

            if(_dane['_tabela'] === 'uzytkownik_grupy'){
                akcja = 'edytuj_uzytkownik_grupy';
            }

            main_dane = {
                'element_id' : _dane['_element_id']
                ,'tabela' : _dane['_tabela']
                ,'akcja' : akcja
            };

            mainPanel.szczegolyElementu(main_dane);
        }

    };

    this.sprawdzPoprawnoscHasla = function(wartosc) {

        var male_litery = /[a-z]/;
        var duze_litery = /[A-Z]/;
        var znaki_specjalne = /[\@\-\.\!\#\$\%\^\&\*\=\+\_\;\:\,\(\)\?]/;
        var w1 = '';
        if (wartosc.length < 8) {
            w1 = w1 + '<p class="margin_b_0 margin_l_20">- Minimum 8 znaków</p>';
        }
        if (!male_litery.test(wartosc)) {
            w1 = w1 + '<p class="margin_b_0 margin_l_20">- Minimum 1 mała litera</p>';
        }
        if (!duze_litery.test(wartosc)) {
            w1 = w1 + '<p class="margin_b_0 margin_l_20">- Minimum 1 wielka litera</p>';
        }
        if (!znaki_specjalne.test(wartosc)) {
            w1 = w1 + '<p class="margin_b_0 margin_l_20 margin_t_0">- Minimum 1 znak specjalny (@-.!#$%^&*=+_;:,()?)</p>';
        }

        if(w1.length !== 0){
            mainPanel.wyswietlPowiadomienieBoczne('blad','Hasło nie spełnia minimalnych wymagań!!!',w1);
            return false;
        }

        return true;
    };

    this.usunPrzywrocElement = function(_dane) {
        formData = new FormData();
            formData.append('akcja', 'usun_przywroc_element');
            formData.append('reakcja', _dane['_reakcja']);
            formData.append('tabela', _dane['_tabela']);
            formData.append('element_id', _dane['_element_id']);

        mainPanel.zaladujTrescAjax('ajax/akcje/ajax_aktualizuj_dane', formData);

        odpowiedzAjax = $.parseJSON(mainPanel.zawartoscTrescAjax());

        mainPanel.wyswietlPowiadomienieBoczne(odpowiedzAjax['rodzaj'], '', odpowiedzAjax['komunikat']);

        var aktywnaZakladka = $('.panel_body_zawartosc .tab-pane.active').attr('id');
        var aktywnaGrupa = $('.panel_body_zawartosc .aktywnyPanel').attr('id');

        if(odpowiedzAjax['przeladujWidokZakladki'] === 1){
            if(_dane['_tabela'] === 'uzytkownik'){
                mainPanel.aktywujZakladke('zakladka_zarzadzanie_uzytkownikami');
            }

            if(_dane['_tabela'] === 'powiadomienia'){
                mainPanel.aktywujZakladke('zakladka_powiadomienia');
            }

            if(_dane['_tabela'] === 'uzytkownik_grupy'){
                mainPanel.aktywujZakladke('zakladka_zarzadzanie_grupami');
            }


            $('.panel_body_zawartosc .active').removeClass('active');
            $('#'+aktywnaZakladka).addClass('active');
            $('.'+aktywnaZakladka).addClass('active');
            $('#'+aktywnaGrupa).addClass('aktywnyPanel');
            $('#'+aktywnaGrupa+' .ukryj_widok').show();
        }

        if(odpowiedzAjax['przeladujSzczegolyElementu'] === 1){
            var akcja = 'edytuj_uzytkownika';

            if(_dane['_tabela'] === 'powiadomienia'){
                akcja = 'edytuj_powiadomienie';
            }

            if(_dane['_tabela'] === 'uzytkownik_grupy'){
                akcja = 'edytuj_uzytkownik_grupy';
            }

            main_dane = {
                'element_id' : _dane['_element_id']
                ,'tabela' : _dane['_tabela']
                ,'akcja' : akcja
            };

            mainPanel.szczegolyElementu(main_dane);
        }
    };

    this.wlaczWylaczSms = function(_dane){
        formData = new FormData();
        formData.append('akcja', 'wlacz_wylacz_sms');
        formData.append('reakcja', _dane['_reakcja']);
        formData.append('tabela', _dane['_tabela']);
        formData.append('element_id', _dane['_element_id']);


        mainPanel.zaladujTrescAjax('ajax/akcje/ajax_aktualizuj_dane', formData);

        odpowiedzAjax = $.parseJSON(mainPanel.zawartoscTrescAjax());

        mainPanel.wyswietlPowiadomienieBoczne(odpowiedzAjax['rodzaj'], '', odpowiedzAjax['komunikat']);
    };
    this.updateSms = function(_dane){
        formData = new FormData();
        formData.append('akcja', 'update_sms');
        formData.append('reakcja', _dane['_reakcja']);
        formData.append('tabela', _dane['_tabela']);
        formData.append('element_id', _dane['_element_id']);
        formData.append('tresc', _dane['_tresc']);
        mainPanel.zaladujTrescAjax('ajax/akcje/ajax_aktualizuj_dane', formData);

        odpowiedzAjax = $.parseJSON(mainPanel.zawartoscTrescAjax());

        mainPanel.wyswietlPowiadomienieBoczne(odpowiedzAjax['rodzaj'], '', odpowiedzAjax['komunikat']);
    };

    this.usunDodajUprawnienieUzytkownika = function(_dane){
        formData = new FormData();
        formData.append('akcja', 'usun_dodaj_uprawnienie_uzytkownika');
        formData.append('reakcja', _dane['_reakcja']);
        formData.append('tabela', _dane['_tabela']);
        formData.append('element_id', _dane['_element_id']);

        mainPanel.zaladujTrescAjax('ajax/akcje/ajax_aktualizuj_dane', formData);

        odpowiedzAjax = $.parseJSON(mainPanel.zawartoscTrescAjax());

        mainPanel.wyswietlPowiadomienieBoczne(odpowiedzAjax['rodzaj'], '', odpowiedzAjax['komunikat']);
    };

    this.usunDodajUprawnienieGrupy = function(_dane){
        formData = new FormData();
        formData.append('akcja', 'usun_dodaj_uprawnienie_grupy');
        formData.append('reakcja', _dane['_reakcja']);
        formData.append('tabela', _dane['_tabela']);
        formData.append('element_id', _dane['_element_id']);

        mainPanel.zaladujTrescAjax('ajax/akcje/ajax_aktualizuj_dane', formData);

        odpowiedzAjax = $.parseJSON(mainPanel.zawartoscTrescAjax());

        mainPanel.wyswietlPowiadomienieBoczne(odpowiedzAjax['rodzaj'], '', odpowiedzAjax['komunikat']);
    };

    this.usunAvatarUzytkownika = function(_dane){
        mainPanel.wyswietlLoader('#uzytkownikAvatarPodglad');

        formData = new FormData();
            formData.append('akcja', 'uzytkownik_usun_avatar');
            formData.append('tabela', _dane['_tabela']);
            formData.append('element_id', _dane['_element_id']);

        mainPanel.zaladujTrescAjax('ajax/akcje/ajax_aktualizuj_dane', formData);

        odpowiedzAjax = $.parseJSON(mainPanel.zawartoscTrescAjax());

        mainPanel.wyswietlPowiadomienieBoczne(odpowiedzAjax['rodzaj'], '', odpowiedzAjax['komunikat']);

        var aktywnaZakladka = $('.panel_body_zawartosc .tab-pane.active').attr('id');
        var aktywnaGrupa = $('.panel_body_zawartosc .aktywnyPanel').attr('id');

        if(odpowiedzAjax['przeladujSzczegolyElementu'] === 1){
            main_dane = {
                'element_id' : _dane['_element_id']
                ,'tabela' : 'uzytkownik'
                ,'akcja' : 'edytuj_uzytkownika'
            };

            mainPanel.szczegolyElementu(main_dane);
        }

        if(odpowiedzAjax['przeladujWidokZakladki'] === 1){
            mainPanel.aktywujZakladke('zakladka_zarzadzanie_uzytkownikami');

            $('.panel_body_zawartosc .active').removeClass('active');
            $('#'+aktywnaZakladka).addClass('active');
            $('.'+aktywnaZakladka).addClass('active');
            $('#'+aktywnaGrupa).addClass('aktywnyPanel');
            $('#'+aktywnaGrupa+' .ukryj_widok').show();
        }
        $('.uzytkownikZapiszAvatar').hide();
        $('#uzytkownikAvatarPodglad img').attr('src', '/img/avatar/domyslny.png');
        mainPanel.ukryjLoader();
    };

    this.uzytkownikZapiszAvatar = function(_dane){
        mainPanel.wyswietlLoader('#uzytkownikAvatarPodglad');

        formData = new FormData();
            formData.append('plik', $('#uzytkownikAvatarPrzyciskGrupaUpload input')[0].files[0]);
            formData.append('akcja', 'uzytkownik_dodaj_avatar');
            formData.append('tabela', _dane['_tabela']);
            formData.append('element_id', _dane['_element_id']);

        mainPanel.zaladujTrescAjax('ajax/akcje/ajax_aktualizuj_dane', formData);

        odpowiedzAjax = $.parseJSON(mainPanel.zawartoscTrescAjax());

        mainPanel.wyswietlPowiadomienieBoczne(odpowiedzAjax['rodzaj'], '', odpowiedzAjax['komunikat']);

        var aktywnaZakladka = $('.panel_body_zawartosc .tab-pane.active').attr('id');
        var aktywnaGrupa = $('.panel_body_zawartosc .aktywnyPanel').attr('id');

        if(odpowiedzAjax['przeladujWidokZakladki'] === 1){
            mainPanel.aktywujZakladke('zakladka_zarzadzanie_uzytkownikami');

            $('.panel_body_zawartosc .active').removeClass('active');
            $('#'+aktywnaZakladka).addClass('active');
            $('.'+aktywnaZakladka).addClass('active');
            $('#'+aktywnaGrupa).addClass('aktywnyPanel');
            $('#'+aktywnaGrupa+' .ukryj_widok').show();
        }

        if(odpowiedzAjax['przeladujSzczegolyElementu'] === 1){
            main_dane = {
                'element_id' : _dane['_element_id']
                ,'tabela' : 'uzytkownik'
                ,'akcja' : 'edytuj_uzytkownika'
            };

            mainPanel.szczegolyElementu(main_dane);
        }

        mainPanel.ukryjLoader();
    };

    this.wymusWylogowanieUzytkownika = function(_element_id){
        formData = new FormData();
            formData.append('akcja', 'uzytkownik_wymus_wylogowanie');
            formData.append('tabela', 'uzytkownik');
            formData.append('element_id', _element_id);

        mainPanel.zaladujTrescAjax('ajax/akcje/ajax_aktualizuj_dane', formData);

        odpowiedzAjax = $.parseJSON(mainPanel.zawartoscTrescAjax());

        mainPanel.wyswietlPowiadomienieBoczne(odpowiedzAjax['rodzaj'], '', odpowiedzAjax['komunikat']);
    };

    this.uzytkownikPrzejmijSesje = function(_element_id){
        mainPanel.wyswietlLoader('body');

        formData = new FormData();
            formData.append('akcja', 'uzytkownik_przejmij_konto');
            formData.append('element_id', _element_id);

        mainPanel.zaladujTrescAjax('ajax/akcje/ajax_aktualizuj_dane', formData);

        odpowiedzAjax = $.parseJSON(mainPanel.zawartoscTrescAjax());

        mainPanel.wyswietlPowiadomienieBoczne(odpowiedzAjax['rodzaj'], '', odpowiedzAjax['komunikat']);

        if(odpowiedzAjax['rodzaj'] === 'sukces'){
            setTimeout(function(){
                window.location = adres_hosta+'/strona_glowna';
            },2000);

        }

    };

    this.histroiaRejestracjiFiltruj = function(){
        if($('.paginationScope').val() < 10){

            mainPanel.wyswietlPowiadomienieBoczne('blad','','Minimalna liczba wyników to 10!!!');
            return;
        }

        mainDane = mainPanel.zbierzDaneZFormularza('histroiaRejestracjiFiltry');

        formData = new FormData;
            formData.append( 'akcja', 'wyswietl_tabele_historia_rejestracji');
            formData.append( 'dane', JSON.stringify(mainDane));

        mainPanel.wyswietlLoader('.historiaRejestracjiTabelaWynikow');

        mainPanel.zaladujTrescAjax('ajax/akcje/ajax_wczytaj_dane', formData);

        odpowiedzAjax = $.parseJSON(mainPanel.zawartoscTrescAjax());

        document.getElementById('historiaRejestracjiTabelaWynikow').innerHTML = odpowiedzAjax['tresc'];

        mainPanel.aktywujKontrolkiBootstrapowe();

    };

    this.listaUzytkownikowFiltruj = function(){
        if($('.liczbaTop').val() < 10){

            mainPanel.wyswietlPowiadomienieBoczne('blad','','Minimalna liczba wyników to 10!!!');
            return;
        }

        mainDane = mainPanel.zbierzDaneZFormularza('listaUzytkownikowFiltry');

        formData = new FormData;
        formData.append( 'akcja', 'wyswietl_tabele_lista_uzytkownikow_filtruj');
        formData.append( 'dane', JSON.stringify(mainDane));

        mainPanel.wyswietlLoader('.listaUzytkownikowTabelaWynikow');

        mainPanel.zaladujTrescAjax('ajax/akcje/ajax_wczytaj_dane', formData);

        odpowiedzAjax = $.parseJSON(mainPanel.zawartoscTrescAjax());

        document.getElementById('listaUzytkownikowTabelaWynikow').innerHTML = odpowiedzAjax['tresc'];

        mainPanel.aktywujKontrolkiBootstrapowe();

    };

    this.histroiaLogowanFiltruj = function(){
        if($('.liczbaTop').val() < 10){
            mainPanel.wyswietlPowiadomienieBoczne('blad','','Minimalna liczba wyników to 10!!!');
            return;
        }

        mainDane = mainPanel.zbierzDaneZFormularza('histroiaLogowanFiltry');
        formData = new FormData;
            formData.append( 'akcja', 'wyswietl_tabele_historia_logowan_filtruj');
            formData.append( 'dane', JSON.stringify(mainDane));

        mainPanel.wyswietlLoader('.histroiaLogowanTabelaWynikow');
        mainPanel.zaladujTrescAjax('ajax/akcje/ajax_wczytaj_dane', formData);
        odpowiedzAjax = $.parseJSON(mainPanel.zawartoscTrescAjax());
        document.getElementById('histroiaLogowanTabelaWynikow').innerHTML = odpowiedzAjax['tresc'];
        mainPanel.aktywujKontrolkiBootstrapowe();
    };

    this.zapiszZmianyUprawnieniaGrupyZU = function(_dane){
        formData = new FormData;
            formData.append( 'akcja', _dane['_akcja']);
            formData.append( 'element_id', _dane['_element_id']);
            formData.append( 'tabela', _dane['_tabela']);

            mainPanel.sprawdzWartosciPrm(_dane['_rodzic']);

            var polePrm = $('.'+_dane['_rodzic']+' .prm');
            var liczbaPrm = polePrm.size();

            if(liczbaPrm === 0){
                mainPanel.wyswietlPowiadomienieBoczne('blad','','Nie wykryto zmian!!!');
                return false;
            }

            mainDane = mainPanel.zbierzDaneZFormularza(_dane['_rodzic']);

            formData.append( 'dane', JSON.stringify(mainDane));

        mainPanel.wyswietlLoader('#szczegolyElementu');
        mainPanel.zaladujTrescAjax('ajax/akcje/ajax_aktualizuj_dane', formData);
        mainPanel.ukryjLoader();
        odpowiedzAjax = $.parseJSON(mainPanel.zawartoscTrescAjax());

        if(odpowiedzAjax['przeladujWidokZakladki'] === 1){
            mainPanel.aktywujZakladke('zakladka_zarzadzanie_uprawnieniami');
        }

        if(odpowiedzAjax['przeladujSzczegolyElementu'] === 1){
            main_dane = {
                'element_id' : _dane['_element_id']
                ,'tabela' : 'uprawnienia_grupy'
                ,'akcja' : 'edytuj_uprawnienie_grupa'
            };

            mainPanel.szczegolyElementu(main_dane);
        }
    };

    this.zapiszZmianyUprawnieniaGrupyPojedyncze = function(_dane){
        formData = new FormData;
            formData.append( 'akcja', 'uprawnienia_zapisz_zmiany');
            formData.append( 'element_id', _dane['_element_id']);
            formData.append( 'tabela', 'uprawnienia');

            mainPanel.sprawdzWartosciPrm(_dane['_rodzic']);

            var polePrm = $('.'+_dane['_rodzic']+' .prm');
            var liczbaPrm = polePrm.size();

            if(liczbaPrm === 0){
                mainPanel.wyswietlPowiadomienieBoczne('blad','','Nie wykryto zmian!!!');
                return false;
            }

            mainDane = mainPanel.zbierzDaneZFormularza(_dane['_rodzic']);

            formData.append( 'dane', JSON.stringify(mainDane));

        mainPanel.wyswietlLoader('#szczegolyElementu');
        mainPanel.zaladujTrescAjax('ajax/akcje/ajax_aktualizuj_dane', formData);
        mainPanel.ukryjLoader();
        odpowiedzAjax = $.parseJSON(mainPanel.zawartoscTrescAjax());

        if(odpowiedzAjax['przeladujSzczegolyElementu'] === 1){
            main_dane = {
                'element_id' : _dane['_element_id']
                ,'tabela' : 'uprawnienia_grupy'
                ,'akcja' : 'edytuj_uprawnienie_grupa'
            };

            mainPanel.szczegolyElementu(main_dane);

            $('.uprawnieniaGrupaZawartosc .active').removeClass('active');
            $('.uprawnieniaGrupaListaUprawnien').addClass('active');
        }
    };

}