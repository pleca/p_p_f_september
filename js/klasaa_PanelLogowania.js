function PanelLogowania() {
    this.sprawdzZakladkeId = function () {
        aktywnaZakladka = mainPanel.getCookie('aktywnaZakladka');
        mainPanel.setCookie('pupup',1);

        if($('.listaZakladek .zakladkaElement').size() !== 0){
            if (aktywnaZakladka.length === 0 || $('#zakladka_' + aktywnaZakladka).length === 0) {
                this.aktywujZakladkeId($('.listaZakladek .zakladkaElement').first().attr('id'));
                return;
            }

            this.aktywujZakladkeId(aktywnaZakladka);
        }

    };

    this.sprawdzBlokade = function(){
        if(mainPanel.getCookie('blokada') === 'true'){
            dataBlokady = new Date(mainPanel.getCookie('blokadaData'));
            dataTeraz = new Date();
            var roznicaDat_tmp = Math.floor(Math.floor((dataTeraz.getTime() - dataBlokady.getTime())/1000)/60);
            var pozostalyCzas = 30 - roznicaDat_tmp;

            if(pozostalyCzas < 1){
                mainPanel.setCookie('blokada',false);
                mainPanel.setCookie('blokadaData','');
                return;
            }

            mainPanel.wyswietlPowiadomienieBootsrtap('danger', '.panelLogowania', 'Z powodu przekroczenia błędnych prób logowania konto zostało tymczasowo zablokowane!!! <b>Spróbuj ponownie za: '+pozostalyCzas+' min!!!</b>');
            mainPanel.animateCss('animuj','shake');

            $('.panelLogowania .form-group').remove();
            $('.panelLogowania .zaloguj').remove();
            $('.panelLogowania .alert').removeClass('margin_b_10').addClass('margin_b_0');
            $('.stronaLogowaniaRejestracji .listaZakladek').remove();
            $('#stronaZawartosc').attr('class','col-lg-6 col-md-8 col-sm-8 col-xs-12');

        }
    };

    this.aktywujZakladkeId = function (_aktywnaZakladka) {
        mainPanel.wyswietlLoader('body');
        mainPanel.setCookie('aktywnaZakladka', _aktywnaZakladka);

        $('.zakladkaElement').removeClass('btn-danger').addClass('btn-defauld');
        $('#' + _aktywnaZakladka).addClass('btn-danger').removeClass('btn-defauld');

        this.zaladujWidokAjax('ajax/widoki/widok_' + _aktywnaZakladka, null, 'stronaZawartosc');
    };

    this.zaladujWidokAjax = function (_url, _dane, _kontener) {
        $.ajax({
            method: "POST",
            url: _url,
            data: _dane
        }).done(function (dane) {
            zawartoscAjax = dane;
            panelLogowania.wyswietlZawartosc(_kontener);
            panelLogowania.sprawdzBlokade();
            mainPanel.ukryjLoader();
        }).fail(function (ajaxContext) {
            if (ajaxContext.status === 404) {
                console.log('Strona nie istnieje - ' + _url);
            }else{
                console.log(ajaxContext.responseText);
            }
            mainPanel.ukryjLoader();
        });
    };

    this.zaladujDaneAjaxSynchronicznie = function (_url, _dane) {

        $.ajax({
            method: "POST",
            url: _url,
            data : _dane,
            async: false,
            contentType: false,
            processData: false
        }).done(function(dane) {
            zawartoscAjax = dane;
            mainPanel.ukryjLoader();
        }).fail(function(ajaxContext) {
            if (ajaxContext.status === 404) {
                console.log('Strona nie istnieje - ' + _url);
            }else{
                console.log(ajaxContext.responseText);
            }
            mainPanel.ukryjLoader();
            return false;
        });

        return true;

    };

    this.wyswietlZawartosc = function (_trescKontener) {
        document.getElementById(_trescKontener).innerHTML = zawartoscAjax;
        this.aktywujBootstrapa();
    };

    this.aktywujBootstrapa = function () {};



    this.zaloguj = function(_klasaRodzic){
        mainDane = mainPanel.zbierzDaneZFormularza(_klasaRodzic);

        if(!mainDane){
            return;
        }

        mainPanel.wyswietlLoader('body');

        formData = new FormData;
            formData.append( 'akcja', 'zaloguj_sie');
            formData.append( 'dane', JSON.stringify(mainDane));

        if(!this.zaladujDaneAjaxSynchronicznie('ajax/akcje/ajax_wczytaj_dane', formData)) {
            return;
        }

        odpowiedzAjax = $.parseJSON(zawartoscAjax);

        mainPanel.setCookie('blokada', odpowiedzAjax['blokada']);
        mainPanel.setCookie('blokadaData', odpowiedzAjax['blokadaData']);

        if(!odpowiedzAjax['rodzaj']){
            mainPanel.wyswietlPowiadomienieBootsrtap('danger', '.panelLogowania', odpowiedzAjax['komunikat']);
            mainPanel.animateCss('animuj','shake');

            if(odpowiedzAjax['blokada']){
                $('.panelLogowania .form-group').remove();
                $('.panelLogowania .zaloguj').remove();
                $('.panelLogowania .alert').removeClass('margin_b_10').addClass('margin_b_0');
                $('.stronaLogowaniaRejestracji .listaZakladek').remove();
                $('#stronaZawartosc').attr('class','col-lg-6 col-md-8 col-sm-8 col-xs-12');
            }

            return;
        }

        mainPanel.wyswietlLoader('body');

        window.location = '/strona_glowna.php';

    };

    this.zarejestruj = function(_klasaRodzic, _zarejestrujRodzaj){
        mainDane = mainPanel.zbierzDaneZFormularza(_klasaRodzic);

        if(!mainDane){
            return;
        }

        mainPanel.wyswietlLoader('body');

        formData = new FormData;
            formData.append( 'akcja', 'zarejestruj');
            formData.append( 'rodzaj', _zarejestrujRodzaj);
            formData.append( 'dane', JSON.stringify(mainDane));

        if(!this.zaladujDaneAjaxSynchronicznie('ajax/akcje/ajax_wczytaj_dane', formData)) {
            return;
        }

        odpowiedzAjax = $.parseJSON(zawartoscAjax);

        if(!odpowiedzAjax['rodzaj']){
            if(odpowiedzAjax['blokadaZarejestruj']){
                $('.panelZarejestruj').text('');

                mainPanel.wyswietlPowiadomienieBootsrtap('danger', '.panelZarejestruj', odpowiedzAjax['komunikat']);
                mainPanel.animateCss('animuj','shake');

                $('.panelZarejestruj .alert').removeClass('margin_b_10').addClass('margin_b_0');

                return;
            }

            mainPanel.wyswietlPowiadomienieBootsrtap('danger', '.'+_klasaRodzic, odpowiedzAjax['komunikat']);
            mainPanel.animateCss('animuj','shake');

            return;
        }

        $('#popUpTytul').text(odpowiedzAjax['tytul']);
        $('#popUpTresc').html(odpowiedzAjax['tresc']);
        this.wyswietlPopUpPanelLogowania('modal-lg');

        this.aktywujZakladkeId('zakladka_zaloguj_sie');

    };

    this.przypomnijHaslo = function(_klasaRodzic){
        mainDane = mainPanel.zbierzDaneZFormularza(_klasaRodzic);

        if(!mainDane){
            return;
        }

        mainPanel.wyswietlLoader('body');

        formData = new FormData;
            formData.append( 'akcja', 'przypomnij_haslo');
            formData.append( 'dane', JSON.stringify(mainDane));

        if(!this.zaladujDaneAjaxSynchronicznie('ajax/akcje/ajax_wczytaj_dane', formData)) {
            return;
        }

        odpowiedzAjax = $.parseJSON(zawartoscAjax);

        mainPanel.setCookie('blokada', odpowiedzAjax['blokada']);
        mainPanel.setCookie('blokadaData', odpowiedzAjax['blokadaData']);

        if(!odpowiedzAjax['rodzaj']){
            mainPanel.wyswietlPowiadomienieBootsrtap('danger', '.przypomnijHasloFormularz', odpowiedzAjax['komunikat']);
            mainPanel.animateCss('animuj','shake');

            if(odpowiedzAjax['blokada'] || odpowiedzAjax['blokadaPrzypomnijHaslo']){
                $('.przypomnijHasloFormularz .form-group').remove();
                $('.przypomnijHasloFormularz .przypomnijHaslo').remove();
                $('.przypomnijHasloFormularz .alert').removeClass('margin_b_10').addClass('margin_b_0');
                $('.stronaLogowaniaRejestracji .listaZakladek').remove();
                $('#stronaZawartosc').attr('class','col-lg-6 col-md-8 col-sm-8 col-xs-12');
            }

            return;
        }

        $('#popUpTytul').text(odpowiedzAjax['tytul']);
        $('#popUpTresc').html(odpowiedzAjax['tresc']);
        this.wyswietlPopUpPanelLogowania('modal-lg');

        this.aktywujZakladkeId('zakladka_zaloguj_sie');

    };

    this.wyswietlPopUpPanelLogowania = function(_klasa){
        $('.modal-dialog').removeClass('modal-lg').removeClass('modal-sm').removeClass('modal-lgsm').addClass(_klasa);
        $('#popUp').modal('show');

    };

    this.ukryjPopUpPanelLogowania = function(){
            document.getElementById('popUpTresc').innerHTML = ' ';
            document.getElementById('popUpTytul').innerHTML = ' ';
            document.getElementById('popUpImg').innerHTML = ' ';
    };

    this.ustawHaslo = function(_klasaRodzic){
        mainDane = mainPanel.zbierzDaneZFormularza(_klasaRodzic);

        if(!mainDane){
            return;
        }

        if(mainDane['uzytkownikHasloSms'].length !== 6){
            mainPanel.wyswietlPowiadomienieBootsrtap('danger', '.panelUstawHaslo', 'Wprowadź poprawne hasło z wiadomości SMS!!!');
            mainPanel.animateCss('animuj','shake');
            return;
        }

        if(mainDane['uzytkownikHaslo'] !== mainDane['uzytkownikHasloPowtorz']){
            mainPanel.wyswietlPowiadomienieBootsrtap('danger', '.panelUstawHaslo', 'Podane hasła są różne!!!');
            mainPanel.animateCss('animuj','shake');
            return;
        }
        var sprawdzHaslo = this.sprawdzPoprawnoscHasla(mainDane['uzytkownikHaslo']);
        if(sprawdzHaslo.length !== 0 ){
            mainPanel.wyswietlPowiadomienieBootsrtap('danger', '.panelUstawHaslo', '<b>Hasło nie spełnia minimalnych wymagań!!!</b>'+sprawdzHaslo);
            mainPanel.animateCss('animuj','shake');
            return;
        }

        formData = new FormData;
            formData.append( 'akcja', 'ustaw_haslo');
            formData.append( 'dane', JSON.stringify(mainDane));

        if(!this.zaladujDaneAjaxSynchronicznie('ajax/akcje/ajax_wczytaj_dane', formData)) {
            return;
        }

        odpowiedzAjax = $.parseJSON(zawartoscAjax);

        var panel_form_group = $('.panelUstawHaslo .form-group');
        var panel_ustawHaslo = $('.panelUstawHaslo .ustawHaslo');
        var panel_alert;

        if(!odpowiedzAjax['rodzaj']){
            mainPanel.wyswietlPowiadomienieBootsrtap('danger', '.panelUstawHaslo', odpowiedzAjax['komunikat']);
            mainPanel.animateCss('animuj','shake');

            panel_alert = $('.panelUstawHaslo .alert');

            panel_form_group.remove();
            panel_ustawHaslo.remove();
            panel_alert.removeClass('margin_b_10').addClass('margin_b_0');
            return;
        }

        mainPanel.wyswietlPowiadomienieBootsrtap('success', '.panelUstawHaslo', odpowiedzAjax['komunikat']);
        panel_alert = $('.panelUstawHaslo .alert');

        panel_form_group.remove();
        panel_ustawHaslo.remove();
        panel_alert.removeClass('margin_b_10').addClass('margin_b_0');

        setTimeout(function(){
            window.location = '/';
        },5000);

    };

    this.sprawdzPoprawnoscHasla = function(wartosc) {

        var male_litery = /[a-z]/;
        var duze_litery = /[A-Z]/;
        var znaki_specjalne = /[\@\-\.\!\#\$\%\^\&\*\=\+\_\;\:\,\(\)\?\*]/;
        var w1 = '';

        if (wartosc.length < 8) {
            w1 = w1 + '<p class="margin_b_0 margin_l_20 margin_t_10">- Minimum 8 znaków</p>';
        }
        if (!male_litery.test(wartosc)) {
            w1 = w1 + '<p class="margin_b_0 margin_l_20 margin_t_0">- Minimum 1 mała litera</p>';
        }
        if (!duze_litery.test(wartosc)) {
            w1 = w1 + '<p class="margin_b_0 margin_l_20 margin_t_0">- Minimum 1 wielka litera</p>';
        }
        if (!znaki_specjalne.test(wartosc)) {
            w1 = w1 + '<p class="margin_b_0 margin_l_20 margin_t_0">- Minimum 1 znak specjalny (@-.!#$%^&*=+_;:,()?*)</p>';
        }

        return w1;
    };
}

