function MainPanel(){
    var _zawartosc_tresc_ajax;
    var popover;
    var nowyCzasSesji;

    this.sprawdzZakladke = function(){
        if($('.panel_body_menu button').length !== 0){
            aktywnaZakladka = getCookie('aktywnaZakladka');

            if (aktywnaZakladka.length === 0 || $('#' + aktywnaZakladka).size() === 0) {
                this.aktywujZakladke($('.panel_body_menu button').first().attr('id'));
                return;
            }

            this.aktywujZakladke(aktywnaZakladka);
        }
    };

    this.aktywujZakladke = function(_dane){
        this.wyswietlLoader('#panel_body_zawartosc');
        aktywnaZakladka = _dane;
        setCookie('aktywnaZakladka',_dane);

        $('.panel_body_menu .btn-danger').removeClass('btn-danger').addClass('btn-defauld');
        $('#'+(aktywnaZakladka)).addClass('btn-danger').removeClass('btn-defauld');

        if(aktywnaZakladka === 'zakladka_kalendarz_szkolen'){
            aktywuj_kalendarz();
            return false;
        }

        this.zaladujTrescAjax('ajax/widoki/widok_'+aktywnaZakladka, null);
        this.wyswietlTresc('panel_body_zawartosc', _zawartosc_tresc_ajax);

        if(aktywnaZakladka === 'zakladka_wypelnij_druk'){
            $('.glownaZawartoscStrony').removeClass('col-md-6').addClass('col-md-10');
            $('.szczegolyElementuZawartosc').hide();
            return false;
        }else{
            if(!$('.glownaZawartoscStrony').hasClass('col-md-6')){
                $('.glownaZawartoscStrony').removeClass('col-md-10').addClass('col-md-6');
                $('.szczegolyElementuZawartosc').show();
            }
        }

        $('#szczegolyElementu').html('<p>Wybierz element aby wyświetlić szczegóły...</p>');

    };

    this.zaladujTrescAjax = function(_url, _dane, _async, _odswierzSesje){
        if(_async === undefined){
            _async = false;
    }
        $.ajax({
            method: "POST",
            url: _url,
            data : _dane,
            async: _async,
            contentType: false,
            processData: false
        }).done(function(dane) {
            _zawartosc_tresc_ajax = dane;
            //console.log(_out);
        }).fail(function(ajaxContext) {
            console.log(ajaxContext.responseText);
        });

        if(_odswierzSesje === undefined){
            this.odswierzSesje();
        }
    };

    this.odswierzSesje = function(){
        licznikSesji = $('.czasTrwaniaSesjiZegar');
        licznikSesji.data('czas_sesji','20');
        licznikSesji.text('20 min. do zakończenia sesji');
        /*$.ajax({
            method: "POST",
            url: '/ajax/akcje/ajax_odswiez_sesje',
            async: true,
            contentType: false,
            processData: false
        }).done(function(){
            licznikSesji.data('czas_sesji','20');
            licznikSesji.text('20 min. do zakończenia sesji');
        }).fail(function(ajaxContext) {
            console.log(ajaxContext.responseText);
        });*/
    };

    this.wyswietlTresc = function(_tresc_id, _dane){

        document.getElementById(_tresc_id).innerHTML = _dane;
        this.aktywujKontrolkiBootstrapowe();

        if(aktywnaZakladka === 'zakladka_aktualnosci'){
            this.rozdzielAktualnosciNaKolumny();
        }

        if(aktywnaZakladka === 'zakladka_lista_konkursow'){
            konkursy.rozdzielNaKolumny();
        }

    };

    this.wyswietlLoader = function(_blok_nadrzedny){
        if(_blok_nadrzedny === 'body'){
            zIndex = '9 affix';
        }else{
            zIndex = '1 position_absolute';
        }
        if($('.loader_spiner_tlo').size() === 0){
            $(_blok_nadrzedny).append('<div class="loader_spiner_tlo z_index_'+zIndex+'"><div class="loader_spiner"></div></div>');
        }
    };

    this.ukryjLoader = function(){
        $('.loader_spiner_tlo').remove();
    };

    this.wczytajDaneDoPopUp = function(_id, _akcja, _tabela, _klasa_rozmiar, _rodzaj, _modal2, _modal3){

        var formData = new FormData();
            formData.append('akcja', _akcja);
            formData.append('tabela', _tabela);
            formData.append('id', _id);

        this.zaladujTrescAjax('ajax/akcje/ajax_'+_rodzaj, formData);

        var popUpTresc = $.parseJSON(_zawartosc_tresc_ajax);

        if(_modal3 === true){
            document.getElementById('popUpTresc3').innerHTML = popUpTresc['tresc'];
            document.getElementById('popUpTytul3').innerHTML = popUpTresc['tytul'];
            document.getElementById('popUpImg3').innerHTML = popUpTresc['miniatura'];
            this.ukryjLoader();

            this.wyswietlPopUp3(_klasa_rozmiar);
            this.aktywujKontrolkiBootstrapowe();


            return;
        }


        if(_modal2 === true){
            document.getElementById('popUpTresc2').innerHTML = popUpTresc['tresc'];
            document.getElementById('popUpTytul2').innerHTML = popUpTresc['tytul'];
            document.getElementById('popUpImg2').innerHTML = popUpTresc['miniatura'];
        }else{
            document.getElementById('popUpTresc').innerHTML = popUpTresc['tresc'];
            document.getElementById('popUpTytul').innerHTML = popUpTresc['tytul'];
            document.getElementById('popUpImg').innerHTML = popUpTresc['miniatura'];
        }

        if(_akcja === 'historia_wyswietl'){
            aktywujDataTable('tabela_historia', 0,'desc');
        }

        this.ukryjLoader();

        this.wyswietlPopUp(_klasa_rozmiar, _modal2);
        this.aktywujKontrolkiBootstrapowe();

    };

    this.wyswietlPopUp = function(_klasa, _modal2){
        this.odswierzSesje();
        if($('.editor.prm.ukryj_widok').size() !== 0){
            $('.oknoEdycji .wysiwyg-container').addClass('ukryj_widok');
        }

        if(_modal2 === true){
            $('.modal-dialog2').removeClass('modal-lg').removeClass('modal-sm').removeClass('modal-lgsm').addClass(_klasa);
            $('#popUp2').modal('show');
        }else{
            $('.naglowekStrony').css({
                'padding-right' : '+=17px'
            });

            $('.stopkaStrony').css({
                'padding-right' : '+=17px'
            });

            $('.wysun_blok_menu').css({'right' : '+=17px'});

            $('.modal-dialog1').removeClass('modal-lg').removeClass('modal-sm').removeClass('modal-lgsm').addClass(_klasa);
            $('#popUp').modal('show');
        }

    };

    this.wyswietlPopUp3 = function(_klasa){
        this.odswierzSesje();
        $('.modal-dialog3').removeClass('modal-lg').removeClass('modal-sm').removeClass('modal-lgsm').addClass(_klasa);
        $('#popUp3').modal('show');
        //this.aktywujKontrolkiBootstrapowe();

    };


    this.ukryjPopUp = function(_modal2){
        this.odswierzSesje();

        clearInterval(interval_test_czas);

        if(_modal2 === true){
            document.getElementById('popUpTresc2').innerHTML = ' ';
            document.getElementById('popUpTytul2').innerHTML = ' ';
            document.getElementById('popUpImg2').innerHTML = ' ';

            $('body').addClass('modal-open');

        }else{
            $('.naglowekStrony').css({
                'padding-right' : '-=17px'
            });

            $('.stopkaStrony').css({
                'padding-right' : '-=17px'
            });

            $('.wysun_blok_menu').css({'right' : '-=17px'});
            document.getElementById('popUpTresc').innerHTML = ' ';
            document.getElementById('popUpTytul').innerHTML = ' ';
            document.getElementById('popUpImg').innerHTML = ' ';

        }
    };

    this.ukryjPopUp3 = function(){
        this.odswierzSesje();
        document.getElementById('popUpTresc3').innerHTML = ' ';
        document.getElementById('popUpTytul3').innerHTML = ' ';
        document.getElementById('popUpImg3').innerHTML = ' ';

        $('body').addClass('modal-open');
    };


    this.aktywujKontrolkiBootstrapowe = function(){
            this.odswierzSesje();
            popover = $('[data-toggle="popover"]');

            $('[data-toggle="tooltip"]').tooltip();
            popover.popover();
            $('.dropdown-toggle').dropdown();

            $('body').on('click', 'button', function () {
                popover.popover('hide');
            });

            //http://stackoverflow.com/questions/16150163/show-one-popover-and-hide-other-popovers
            popover.on('click', function (e) {
                popover.not(this).popover('hide');
            });

            //http://stackoverflow.com/questions/32581987/need-click-twice-after-hide-a-shown-bootstrap-popover
            $('body').on('hidden.bs.popover', function (e) {
                $(e.target).data("bs.popover").inState = { click: false, hover: false, focus: false }
            });

            //http://stackoverflow.com/questions/19305821/multiple-modals-overlay
            $('#popUp3').on('show.bs.modal', function () {
                $('#popUp3').css('z-index', 1080);
            });

            $('#popUp2').on('show.bs.modal', function () {
                $('#popUp2').css('z-index', 1060);
                $('#popUp').css('z-index', 1040);
            });

            $('#popUp2').on('hidden.bs.modal', function () {
                $('#popUp2').css('z-index', 1050);
                $('#popUp').css('z-index', 1050);
            });

            $('.dateTimePicker').datetimepicker({
                format: 'YYYY-MM-DD HH:mm'
            });

            $('.dateTimePicker').keydown(function(){
                return false;
            });

            $('.timePicker').datetimepicker({
                format: 'HH:mm'
            });

            $('.timePicker').keydown(function(){
                return false;
            });
/*
            $('.datePicker').datetimepicker({
                dateFormat: "yy-mm-dd"
                ,showTime : false
                ,timeOnlyShowDate : true
                ,alwaysSetTime : false
                ,timeFormat: ""
                ,monthNamesShort: ["Styczeń","Luty","Marzec","Kwiecień","Maj","Czerwiec",
                    "Lipiec","Sierpień","Wrzesień","Październik","Listopad","Grudzień"]
                ,viewMode: 'years'
            });
*/

        $('.datePicker').datetimepicker({
            viewMode: 'years',
            format: 'YYYY-MM-DD'
        });

            $('.datePicker').keydown(function(e){
                if (!e) {
                    var e = window.event;
                }
                if(e.keyCode == 8){
                    $(this).val('');
                    $(this).attr('value','');
                }
                return false;
            });



            //console.log('test');

            aktywujDataTable('tabela_lista_pobranych_dokumentow', 0, 'desc');
            aktywujDataTable('tabela_lista_drukow', 3, 'desc');
            aktywujDataTable('tabela_lista_szkolen', 3,'asc');
            aktywujDataTable('tabela_lista_klientow', 2,'asc');
            aktywujDataTable('tabela_lista_uzytkownikow', 0,'asc');
            aktywujDataTable('tabela_lista_uzytkownikow_uprawnienia_ogolne', 0,'asc');
            aktywujDataTable('tabela_lista_uzytkownikow_filtruj', 0,'asc');
            aktywujDataTable('tabela_lista_testow', 3,'desc');
            aktywujDataTable('tabela_szkolenia_lista_uczestnikow', 3,'asc');
            aktywujDataTable('tabela_szkolenia_lista_uczestnikow_wyszukaj', 2,'asc');
            aktywujDataTable('tabela_historia_rejestracji', 1,'desc');
            aktywujDataTable('tabela_historia_rejestracji_nowa', 1,'desc',15);
            aktywujDataTable('tabela_lista_uzytkownikow_uprawnienia', 3,'asc');
            aktywujDataTable('tabela_lista_uzytkownikow_dokumentu', 0,'asc');
            aktywujDataTable('tabela_lista_uzytkownikow_grafiki', 0,'asc');
            aktywujDataTable('tabela_historia', 0,'desc');
            aktywujDataTable('tabela_lista_rankingow_3', 0,'asc', 100);
            aktywujDataTable('tabela_lista_rankingow_2', 0,'asc', 100);
            aktywujDataTable('tabela_lista_rankingow_1', 0,'asc', 100);
            aktywujDataTable('tabela_lista_logowan_filtruj', 5,'desc');

            //aktywujDataTable('tabela_lista_podcastow', 3,'asc');

            edytor_opcje();
            edytor_opcje_prosty();
        if(!$('.tabela_lista_podcastow').hasClass('dataTable')) {
            lastTableGlobal = $('.tabela_lista_podcastow').DataTable({
                "language": {
                    "emptyTable": "Brak danych",
                    "info": "Liczba wierszy: _TOTAL_",
                    "infoEmpty": "Liczba wierszy: 0",
                    "lengthMenu": "Wyświetl _MENU_",
                    "loadingRecords": "Ładowanie...",
                    "searchPlaceholder": "Wyszukaj",
                    "zeroRecords": "Brak wyników wyszukiwania",
                    "paginate": {
                        "first": "Pierwszy",
                        "last": "Ostatni",
                        "next": "Następny",
                        "previous": "Poprzedni"
                    },
                    "search": "",
                    "infoFiltered": "(wyfiltrowano z _MAX_)"
                },
                "lengthMenu": [[10, 25, -1], [10, 25, "Wszystkie"]],
                "order": [[3, 'desc']],
                "iDisplayLength": 10,
                "aoColumnDefs": [
                    {
                        "bSortable": false,
                        "aTargets": [-1] // <-- gets last column and turns off sorting
                    }
                ]
            });
        }


    };

    this.zawartoscTrescAjax = function(){
        return _zawartosc_tresc_ajax;
    };

    this.zakladkaId = function(){
        return aktywnaZakladka;
    };

    this.wyslijWiadomosc = function(_temat, _tresc, _akcja, _element_id){
        if(_temat.length == 0 || _tresc.length == 0){
            this.wyswietlPowiadomienie('.popover-content', 'danger', 'Uzupełnij wszystkie pola!!!');
            this.ukryjPowiadomienie();
            return;
        }

        this.wyswietlLoader('.popover');

        var formData = new FormData();
        formData.append('akcja', _akcja);
        formData.append('temat', _temat);
        formData.append('tresc', _tresc);
        formData.append('element_id', _element_id);

        this.zaladujTrescAjax('ajax/akcje/ajax_wyslij_wiadomosc', formData);

        var odpowiedz = $.parseJSON(_zawartosc_tresc_ajax);

        if(odpowiedz[0] === 1){
            $('.popover-content').text(' ');
            this.wyswietlPowiadomienie('.popover-content', 'success', odpowiedz[1]);
            this.ukryjLoader();
            setTimeout(function () {
                $('[data-toggle="popover"]').popover('hide');
            }, 1000);

        }else{
            this.wyswietlPowiadomienie('.popover-content', 'danger', odpowiedz[1]);
            this.ukryjLoader();
        }

    };

    this.wyswietlPowiadomienie = function(_blok_nadrzedny, _rodzaj, _tresc){
        $('.powiadomienie').remove();
        $(_blok_nadrzedny).prepend('<div class="alert powiadomienie alert-'+_rodzaj+'" role="alert">'+_tresc+'</div>');
    };

    this.ukryjPowiadomienie = function(){
        setTimeout(function(){
            $('.powiadomienie').remove();
        },3000);

    };

    this.wyswietlPowiadomienieBoczne = function(rodzaj_tmp, tytul_tmp, tresc_tmp){

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
            z_index: 1090,
            delay: 5000,
            icon_type: 'class',
            template:   '<div data-notify="container" class="col-xs-10 col-lg-3 col-md-4 col-sm-5 margin_b_0 alert powiadomienieBoczne alert-{0}" role="alert">' +
            '<button type="button" aria-hidden="true" class="close" data-notify="dismiss">×</button>' +
            '<span data-notify="icon" class="margin_r_10"></span> ' +
            '<span data-notify="title">{1}</span> ' +
            '<span data-notify="message">{2}</span>' +
            '</div>'
        });
    };

    this.usunPrzywrocElement = function(_dane){
        var formData = new FormData();
            formData.append('akcja', 'usun_przywroc_element');
            formData.append('reakcja', _dane['_reakcja']);
            formData.append('tabela', _dane['_tabela']);
            formData.append('element_id', _dane['_element_id']);

        this.zaladujTrescAjax('ajax/akcje/ajax_aktualizuj_dane', formData);

        var odpowiedz = $.parseJSON(_zawartosc_tresc_ajax);

        powiadomienieBoczne(odpowiedz['rodzaj'],'',odpowiedz['komunikat']);



        if(_dane['_tabela'] === 'szkolenia_testy'){
            return false;
        }

        console.log(_dane['_tabela']);

        if(_dane['_tabela'] !== 'szkolenia_testy_pytania'){
            if(odpowiedz['ukryjPopUp'] === 1){
                $('#popUp').modal('hide');
            }

            if(odpowiedz['przeladujWidok'] === 1){
                this.wyswietlLoader('#panel_body_zawartosc');

                this.zaladujTrescAjax('ajax/widoki/widok_'+aktywnaZakladka, null);
                this.wyswietlTresc('panel_body_zawartosc', _zawartosc_tresc_ajax);
            }
        }
    };

    this.podgladMiniatury = function(_pole){
        var plik = _pole.files[0];

        var reader = new FileReader();
        reader.readAsDataURL( plik );
        reader.onloadend = function(){
            if($('.miniaturaUploadImg img').size() === 0){
                $('.miniaturaUploadImg').append('<img src="" />');
            }
            $('.miniaturaUploadImg img').attr('src',this.result);
        }
    };

    this.zbierzDaneZFormularza = function(_klasaRodzic){

        var polePrm = $('.' + _klasaRodzic + ' .prm');
        var liczbaPrm = polePrm.size();
        var wartosciPrm = {};
        var warPrm = '';
        var kluczPrm = '';
        var klasaPrm = '';

        this.sprawdzPolaWFormularzu(_klasaRodzic, liczbaPrm);

        if ($('.wymaganeBlad').size() !== 0) {
            mainPanel.wyswietlPowiadomienieBootsrtap('danger', '.'+_klasaRodzic, 'Uzupełnij wymagane pola!!!');
            mainPanel.animateCss('animuj','shake');
            return false;
        }

        if ($('.blednaWartosc').size() !== 0) {
            mainPanel.wyswietlPowiadomienieBootsrtap('danger', '.'+_klasaRodzic, 'Popraw błędy w formularzu!!!');
            mainPanel.animateCss('animuj','shake');
            return false;
        }

        for (var i = 0; i < liczbaPrm; i++) {
            kluczPrm = polePrm[i].getAttribute('data-kolumna');
            klasaPrm = polePrm[i].getAttribute('class');
            if (klasaPrm.indexOf('attrValue') < 0) {
                warPrm = polePrm[i].value;
            } else {
                warPrm = polePrm[i].getAttribute('value');
            }

            if (warPrm.length === 0) {
                warPrm = 'null';
            }
            wartosciPrm[kluczPrm] = warPrm;
        }

        return wartosciPrm;

    };

    this.sprawdzPolaWFormularzu = function(_klasaRodzic){
        var pole = $('.'+_klasaRodzic+' .wymagane');
        var liczba_wymaganych = pole.size();
        $('.wymaganeBlad').removeClass('wymaganeBlad');
        var wartosc = '';
        for(var i=0;i<liczba_wymaganych;i++){

            if((pole[i].getAttribute('class')).indexOf('attrValue') < 0){
                wartosc = pole[i].value;
            }else{
                wartosc = pole[i].getAttribute('value');
            }

            if((wartosc).length === 0){
                pole[i].setAttribute('class',(pole[i].getAttribute('class')+' wymaganeBlad'));
            }
        }
    };

    this.SprawdzWymaganePola = function(_klasaRodzic){
        var pole = $('.'+_klasaRodzic+' .wymagane');
        var liczba_wymaganych = pole.size();
        $('.wymaganeBlad').removeClass('wymaganeBlad');
        var wartosc = '';
        for(var i=0;i<liczba_wymaganych;i++){

            if((pole[i].getAttribute('class')).indexOf('attrValue') < 0){
                wartosc = $('.'+_klasaRodzic+' .wymagane')[i].value;
            }else{
                wartosc = $('.'+_klasaRodzic+' .wymagane')[i].getAttribute('value');
            }

            if((wartosc).length === 0){
                pole[i].setAttribute('class',(pole[i].getAttribute('class')+' wymaganeBlad'));

                //console.log(($('.'+_klasaRodzic+' .wymagane')[i].getAttribute('class')).indexOf('editor'));

                if((pole[i].getAttribute('class')).indexOf('editor') >= 0){
                    $('.'+_klasaRodzic).find('.wysiwyg-editor').addClass('wymaganeBlad');
                }
            }

        }
    };

    this.zapiszZmiany = function(_dane){
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
        var akcja = _dane['_akcja'];

        this.SprawdzWymaganePola(_dane['_rodzic'], liczbaPrm);

        if($('.wymaganeBlad').size() !== 0){
            powiadomienieBoczne('blad','','Uzupełnij wymagane pola!!!');
            return false;
        }

        if($('.blednaWartosc').size() !== 0){
            powiadomienieBoczne('blad','','Popraw błędy!!!');
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

        if($('.miniaturaUploadPrzycisk').val() !== '' && $('.miniaturaUploadPrzycisk').hasClass('prm')){
            formData.append('miniatura', $('.miniaturaUploadPrzycisk')[0].files[0]);
        }

        if($('.przyciskUploadPrzycisk').val() !== '' && $('.przyciskUploadPrzycisk').hasClass('prm')){
            formData.append('plik', $('.przyciskUploadPrzycisk')[0].files[0]);
        }else{
            formData.append('plik', 'null');
        }



        formData.append('dane', JSON.stringify(wartosciPrm));

        this.zaladujTrescAjax('ajax/akcje/ajax_aktualizuj_dane', formData);

        var odpowiedz = $.parseJSON(_zawartosc_tresc_ajax);

        powiadomienieBoczne(odpowiedz['rodzaj'],'',odpowiedz['komunikat']);

        if(akcja === 'aktualizuj_szkolenie'){
            this.listaKonczacychSieSzkolen();
        }

        if(odpowiedz['ukryjPopUp'] === 1){
            $('#popUp2').modal('hide');
        }

        if(odpowiedz['ukryjPopUp1'] === 1){
            $('#popUp').modal('hide');
        }

        if(odpowiedz['przeladujWidok'] === 1){
            if(aktywnaZakladka === 'zakladka_kalendarz_szkolen'){
                this.wyswietlLoader('#panel_body_zawartosc');
                aktywuj_kalendarz();
            }else{
                this.wyswietlLoader('#panel_body_zawartosc');

                this.zaladujTrescAjax('ajax/widoki/widok_'+aktywnaZakladka, null);
                this.wyswietlTresc('panel_body_zawartosc', _zawartosc_tresc_ajax);
            }


        }

        if(odpowiedz['przeladujPopUp'] === 1){
            this.wyswietlLoader('#popUpTresc');

            var formData = new FormData();
            formData.append('akcja', 'edytuj_szkolenie');
            formData.append('tabela', 'szkolenia');
            formData.append('id', odpowiedz['przeladujPopUpElementId']);

            this.zaladujTrescAjax('ajax/akcje/ajax_wczytaj_dane', formData);

            var popUpTresc = $.parseJSON(_zawartosc_tresc_ajax);
            this.wyswietlTresc('popUpTresc', popUpTresc['tresc']);
            $('#popUpTresc .active').removeClass('active');
            $('.'+odpowiedz['przeladujPopUpAktywnaZakladka']).addClass('active');
        }

    };

    this.rozdzielAktualnosciNaKolumny = function(){
        var liczbaAktualnosci = $('.szapp').size();
        var j=1;

        for(var i=0;i<liczbaAktualnosci;i++){
            if(j === 1){
                $('.szap_pozostale_'+(i+4)).appendTo('.la_1');
            }else if(j === 2){
                $('.szap_pozostale_'+(i+4)).appendTo('.la_2');
            }else{
                $('.szap_pozostale_'+(i+4)).appendTo('.la_3');
                j=0;
            }

            j++;
        }
    };

    this.listaKonczacychSieSzkolen = function(){
        var formData = new FormData();
        formData.append('akcja', 'lista_konczacych_sie_szkolen');
        mainPanel.zaladujTrescAjax('ajax/akcje/ajax_szkolenia_testy', formData);

        var odpowiedz = $.parseJSON(mainPanel.zawartoscTrescAjax());

        document.getElementById('listaKonczacychSieSzkolen').innerHTML = odpowiedz['tresc'];
    };

    this.szczegolyElementu = function(_dane){

        this.wyswietlLoader('#szczegolyElementu');

        formData = new FormData();
            formData.append('element_id', _dane['element_id']);
            formData.append('akcja', _dane['akcja']);
            formData.append('tabela', _dane['tabela']);

        this.zaladujTrescAjax('ajax/akcje/ajax_wczytaj_dane', formData);

        var odpowiedz = $.parseJSON(_zawartosc_tresc_ajax);
        document.getElementById('szczegolyElementu').innerHTML = odpowiedz['tresc'];

        if(_dane['tabela'] === 'uzytkownik' || _dane['tabela'] === 'uzytkownik_grupy'){
            this.rozdzielNaDwieKolumny('.uzytkownikGrupaUprawnien');
        }

        this.aktywujKontrolkiBootstrapowe();
    };

    this.rozdzielNaDwieKolumny = function(_element){
        $(_element+':odd').appendTo('.kolumna_2');
    };

    this.sprawdzWartosciPrm = function(_klasa_rodzic){
        var poleUpdate = $('.'+_klasa_rodzic+' .update');
        var liczbaUpdate = poleUpdate.size();

        var wartosc_domyslna = '';
        var wartosc_aktualna = '';
        var klasaUpdate = '';

        for(var i=0;i<liczbaUpdate;i++){
            wartosc_domyslna = poleUpdate[i].getAttribute('data-wartosc_domyslna');
            klasaUpdate = poleUpdate[i].getAttribute('class');

            if(klasaUpdate.indexOf('attrValue') < 0){
                wartosc_aktualna = poleUpdate[i].value;
            }else{
                wartosc_aktualna = poleUpdate[i].getAttribute('value');
            }

            //console.log(wartosc_aktualna + ' ' + wartosc_domyslna);

            if(wartosc_aktualna !== wartosc_domyslna){
                poleUpdate[i].setAttribute('class',poleUpdate[i].getAttribute('class')+' prm');
            }

        }
    };

    this.zbierzSprawdzPolaAktualizuj = function(_dane_tmp){
        $('.'+_dane_tmp['_rodzic']+' .prm').removeClass('prm');

        this.sprawdzWartosciPrm(_dane_tmp['_rodzic']);

        var polePrm = $('.'+_dane_tmp['_rodzic']+' .prm');
        var liczbaPrm = polePrm.size();

        if(liczbaPrm == 0){
            powiadomienieBoczne('blad','','Nie wykryto zmian!!!');
            return false;
        }

        var formData = new FormData();
            formData.append('akcja', _dane_tmp['_akcja']);
            formData.append('tabela', _dane_tmp['_tabela']);
            formData.append('element_id', _dane_tmp['_element_id']);

        var wartosciPrm = {};
        var warPrm = '';
        var kluczPrm = '';
        var klasaPrm = '';

        this.SprawdzWymaganePola(_dane_tmp['_rodzic'], liczbaPrm);

        if($('.wymaganeBlad').size() !== 0){
            powiadomienieBoczne('blad','','Uzupełnij wymagane pola!!!');
            return false;
        }

        for(var i=0;i<liczbaPrm;i++){
            kluczPrm = polePrm[i].getAttribute('data-kolumna');
            klasaPrm = polePrm[i].getAttribute('class');
            if(klasaPrm.indexOf('attrValue') < 0){
                //console.log('nie ma');
                warPrm = $('.'+_dane_tmp['_rodzic']+' .prm')[i].value;
            }else{
                //console.log('jest');
                warPrm = $('.'+_dane_tmp['_rodzic']+' .prm')[i].getAttribute('value');
            }

            if(warPrm.length === 0){
                warPrm = 'null';
            }
            wartosciPrm[kluczPrm] = warPrm;
        }

        formData.append('dane', JSON.stringify(wartosciPrm));

        return formData;
    };

    this.in_array = function(element, array){
        if(jQuery.inArray(element, array) < 0){
            return false;
        }
        return true;
    };

    this.sprawdzIBAN = function(nrb){

            nrb = nrb.replace(/[^0-9]+/g,'');
            var Wagi = new Array(1,10,3,30,9,90,27,76,81,34,49,5,50,15,53,45,62,38,89,17,
                73,51,25,56,75,71,31,19,93,57);

                //console.log(nrb.length);
            if(nrb.length === 26) {
                nrb = nrb + "2521";
                nrb = nrb.substr(2) + nrb.substr(0,2);
                var Z =0;
                for (var i=0;i<30;i++) {
                    Z += nrb[29-i] * Wagi[i];
                }
                //console.log(Z % 97);
                if(Z % 97 === 1) {
                    return true;
                }else{
                    return false;
                }

            }else{
                return false;
            }

    };

    this.sprawdzPesel = function(pesel) {
        var reg = /^[0-9]{11}$/;
        if(reg.test(pesel) === false) {
            return false;}
        else
        {
            var dig = (""+pesel).split("");
            var kontrola = (1*parseInt(dig[0]) + 3*parseInt(dig[1]) + 7*parseInt(dig[2]) + 9*parseInt(dig[3]) + 1*parseInt(dig[4]) + 3*parseInt(dig[5]) + 7*parseInt(dig[6]) + 9*parseInt(dig[7]) + 1*parseInt(dig[8]) + 3*parseInt(dig[9]))%10;
            if(kontrola==0) kontrola = 10;
            kontrola = 10 - kontrola;
            if(parseInt(dig[10])==kontrola)
                return true;
            else
                return false;
        }

    };

    this.sprawdzNumerDowodu = function(numer){

            if (numer === 'AAA000000' || numer === 'AAA111111') {
                return false;
            }

            if (numer === null || numer.length !== 9)
                return false;

            numer = numer.toUpperCase();

            letterValues = [
                '0', '1', '2', '3', '4', '5', '6', '7', '8', '9',
                'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J',
                'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T',
                'U', 'V', 'W', 'X', 'Y', 'Z'
            ];

            function getLetterValue(letter) {
                return jQuery.inArray(letter, letterValues);
            }

            for(var i=0; i<3; i++){
                if (getLetterValue(numer[i]) < 10){
                    return false;
                }

            }

            for (i=3; i<9; i++){
                if (getLetterValue(numer[i]) < 0 || getLetterValue(numer[i]) > 9){
                    return false;
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
            sum %= 10;

            if(sum !== getLetterValue(numer[3])){
                return false;
            }

            return true;
        };

    this.maskujKlawisze = function(AEvent, AMaska) {
        var kodKlawisza;
        if (window.Event) {
           kodKlawisza = AEvent.which;
        } else {
           kodKlawisza = AEvent.keyCode;
        }

        //console.log(kodKlawisza);

        if(this.in_array(kodKlawisza, klawiszeSterujace)){
            return true;
        }

        var klawisz = String.fromCharCode(kodKlawisza);

        if (AMaska.indexOf(klawisz) === -1) {
            return false;
        } else {
            return true;
        }
    };

    this.sprawdzKodPocztowy = function(kodPocztowy){
        var wzor_kodu = /[0-9]{1}[0-9]{1}-[0-9]{1}[0-9]{1}[0-9]{1}/;

        if(kodPocztowy.match(wzor_kodu)){
            return true;
        }

        return false;
    };

    this.sprawdzEmail = function(email) {
        var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;

        if(reg.test(email) === false){
            return false;
        }else {
            return true;
        }
    };

    this.setCookie = function(_nazwa,_wartosc){
        document.cookie = _nazwa + "=" + _wartosc + "; path=/; ";
    };

    this.getCookie = function(_nazwa){
        var nazwa = _nazwa + "=";
        var ca = document.cookie.split(';');
        for(var i=0; i<ca.length; i++){
            var c = ca[i].trim();
            if (c.indexOf(nazwa)===0) return c.substring(nazwa.length,c.length);
        }
        return "";
    };

    this.animateCss = function (_klasa, animationName) {
        var animationEnd = 'webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend';
        $('.'+_klasa).addClass('animated ' + animationName).one(animationEnd, function() {
            $(this).removeClass('animated ' + animationName);
        });
    };

    this.wyswietlPowiadomienieBootsrtap = function(_rodzaj, _blokNadrzedny, _komunikat){
        $(_blokNadrzedny+' .alert').remove();
        $(_blokNadrzedny).prepend('<div class="powiadomienieBootstrap alert margin_b_10 alert-'+_rodzaj+'">'+_komunikat+'</div>');
    };

    this.wyloguj = function(){

        this.wyswietlLoader('body');

        this.zaladujTrescAjax('/ajax/akcje/ajax_wyloguj');
        odpowiedzAjax = $.parseJSON(_zawartosc_tresc_ajax);

        if(odpowiedzAjax){
            window.location =adres_hosta+"/";
        }

    };

    this.licznikSesji = function(){
        licznikSesji = $('.czasTrwaniaSesjiZegar');
        if(licznikSesji === undefined){
            return;
        }

        czasSesji = licznikSesji.data('czas_sesji');
        nowyCzasSesji = czasSesji - 1;

        if(nowyCzasSesji === 0){
            mainPanel.wyloguj();
            return;
        }

        licznikSesji.data('czas_sesji',nowyCzasSesji);
        licznikSesji.text(nowyCzasSesji+' min. do zakończenia sesji');

        if(nowyCzasSesji === 1){
            mainPanel.licznikSesji60Sekund();
        }
    };

    this.licznikSesji60Sekund = function(){
        formData = new FormData;
            formData.append('akcja','wyswietl_lisznik_okno_60_sekund');

        this.zaladujTrescAjax('/ajax/akcje/ajax_wczytaj_widok', formData, false, false);
        odpowiedzAjax = $.parseJSON(_zawartosc_tresc_ajax);

        $('body').append(odpowiedzAjax['tresc']);
    };

    this.sprawdzSesje = function(){
        $.ajax({
            method: "POST",
            url: '/ajax/akcje/ajax_sprawdz_sesje'
        }).done(function(dane){
            odpowiedzAjax = $.parseJSON(dane);

            if(odpowiedzAjax['wyloguj']){
                mainPanel.wyswietlLoader('body');

                setTimeout(function(){
                    mainPanel.wyloguj();
                },3000);

                mainPanel.wyswietlPowiadomienieBoczne('blad','',odpowiedzAjax['komunikat']);
            }

        }).fail(function(ajaxContext) {
            console.log(ajaxContext.responseText);
        });
    };

    this.wyswietlPanelUzytkownika = function(){
        formData = new FormData;
        formData.append('akcja','wyswietl_panel_uzytkownika');

        this.zaladujTrescAjax('/ajax/akcje/ajax_wczytaj_widok', formData);
        odpowiedzAjax = $.parseJSON(_zawartosc_tresc_ajax);

        document.getElementById('popUpTresc').innerHTML = odpowiedzAjax['tresc'];
        document.getElementById('popUpTytul').innerHTML = odpowiedzAjax['tytul'];

        this.wyswietlPopUp('modal-lgsm');
        this.aktywujKontrolkiBootstrapowe();
    };

    this.panelUzytkownikZapiszZmiany = function(){
        var inputPoleUpload = $('.panelUzytkownikAvatarInput');
        $('.panelUzytkownikaOgolne .prm').removeClass('prm').addClass('update');
        $('.panelUzytkownikaOgolne .wymaganeBlad').removeClass('wymaganeBlad');
        $('.panelUzytkownikaOgolne .alert').remove();

        var uzytkownikStareHaslo = $('.uzytkownikStareHaslo');
        var uzytkownikHaslo = $('.uzytkownikHaslo');
        var uzytkownikHasloPowtorz = $('.uzytkownikHasloPowtorz');

        formData = new FormData;

        if(uzytkownikStareHaslo.val() === uzytkownikStareHaslo.data('wartosc_domyslna')
            && uzytkownikHaslo.val() === uzytkownikHaslo.data('wartosc_domyslna')
            && uzytkownikHasloPowtorz.val() === uzytkownikHasloPowtorz.data('wartosc_domyslna')
            && !inputPoleUpload.hasClass('aktualizuj')
        ){
            this.wyswietlPowiadomienieBoczne('blad','','Nie wykryto zmian!!!');
            mainPanel.animateCss('animujModal1', 'shake');
            return;
        }

        if (uzytkownikStareHaslo.val().length === 0) {
            if(!inputPoleUpload.hasClass('aktualizuj')) {
                mainPanel.wyswietlPowiadomienieBootsrtap('danger', '.panelUzytkownikaOgolne', 'Wprowadź stare hasło!!!');
                mainPanel.animateCss('animujModal1', 'shake');
                return;
            }
        }

        if (uzytkownikHaslo.val().length === 0) {
            if(!inputPoleUpload.hasClass('aktualizuj')) {
                mainPanel.wyswietlPowiadomienieBootsrtap('danger', '.panelUzytkownikaOgolne', 'Wprowadź hasło!!!');
                mainPanel.animateCss('animujModal1', 'shake');
                return;
            }
        }

        if (uzytkownikHasloPowtorz.val().length === 0) {
            if(!inputPoleUpload.hasClass('aktualizuj')) {
                mainPanel.wyswietlPowiadomienieBootsrtap('danger', '.panelUzytkownikaOgolne', 'Wprowadź hasło ponownie!!!');
                mainPanel.animateCss('animujModal1', 'shake');
                return;
            }
        }

        if (uzytkownikHasloPowtorz.val().length !== 0 && uzytkownikHaslo.val().length !== 0) {
            if (uzytkownikHaslo.val() !== uzytkownikHasloPowtorz.val()) {
                mainPanel.wyswietlPowiadomienieBootsrtap('danger', '.panelUzytkownikaOgolne', 'Podane hasła są różne!!!');
                mainPanel.animateCss('animujModal1', 'shake');
                return;
            }
            var sprawdzHaslo = this.sprawdzPoprawnoscHasla(uzytkownikHaslo.val());
            if(sprawdzHaslo.length !== 0 ){
                mainPanel.wyswietlPowiadomienieBootsrtap('danger', '.panelUzytkownikaOgolne', '<b>Hasło nie spełnia minimalnych wymagań!!!</b>'+sprawdzHaslo);
                mainPanel.animateCss('animujModal1','shake');
                return;
            }
            formData.append('uzytkownikStareHaslo', uzytkownikStareHaslo.val());
            formData.append('uzytkownikHaslo', uzytkownikHaslo.val());
            formData.append('uzytkownikHasloPowtorz', uzytkownikHasloPowtorz.val());
        }

        if(inputPoleUpload.hasClass('aktualizuj')) {
            if(inputPoleUpload.hasClass('domyslny')){
                formData.append('avatarKlasa', 'domyslny');
            }else{
                formData.append('plik', inputPoleUpload[0].files[0]);
                formData.append('avatarKlasa', 'nowy');
            }
        }

        formData.append('akcja','uzytkownik_zapisz_zmiany');

        this.zaladujTrescAjax('/ajax/akcje/ajax_wczytaj_dane', formData);
        odpowiedzAjax = $.parseJSON(_zawartosc_tresc_ajax);

        if(odpowiedzAjax['rodzaj']){
            $('.uzytkownik_avatar img').attr('src',adres_hosta+'/img/avatar/'+odpowiedzAjax['avatarNazwa']);
            this.wyswietlPowiadomienieBoczne('sukces','',odpowiedzAjax['komunikat']);
            $('.panelUzytkownikAvatarInput').removeClass('nowy domyslny aktualizuj');
            if(odpowiedzAjax['wyloguj']){
                this.wyloguj();
            }
        }else{
            this.wyswietlPowiadomienieBoczne('blad','',odpowiedzAjax['komunikat']);
        }




    };

    this.przeladujZawartoscPopUp = function(_element_id, _akcja, _tabela, _pop_up_nr){
        formData = new FormData();
            formData.append('akcja', _akcja);
            formData.append('tabela', _tabela);
            formData.append('id', _element_id);

        mainPanel.zaladujTrescAjax('ajax/akcje/ajax_wczytaj_dane', formData);

        var popUpTresc = $.parseJSON(mainPanel.zawartoscTrescAjax());

        document.getElementById('popUpTresc'+_pop_up_nr).innerHTML = popUpTresc['tresc'];
        document.getElementById('popUpTytul'+_pop_up_nr).innerHTML = popUpTresc['tytul'];
        document.getElementById('popUpImg'+_pop_up_nr).innerHTML = popUpTresc['miniatura'];

        this.aktywujKontrolkiBootstrapowe();
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

    this.elementDodajUsunUprawnienieGrupy = function(_dane){
        formData = new FormData();
            formData.append('akcja', 'dodaj_usun_uprawnienie_grupy');
            formData.append('tabela', _dane['tabela']);
            formData.append('kolumna', _dane['kolumna']);
            formData.append('grupa_id', _dane['grupa_id']);
            formData.append('element_id', _dane['element_id']);
            formData.append('reakcja', _dane['reakcja']);

        this.zaladujTrescAjax('/ajax/akcje/ajax_aktualizuj_dane', formData);

        odpowiedzAjax = $.parseJSON(_zawartosc_tresc_ajax);

        this.wyswietlPowiadomienieBoczne(odpowiedzAjax['rodzaj'],'',odpowiedzAjax['komunikat']);
    };

    this.elementDodajUsunUprawnienieUzytkownika = function(_dane){
        formData = new FormData();
            formData.append('akcja', 'dodaj_usun_uprawnienie_uzytkownika');
            formData.append('tabela', _dane['tabela']);
            formData.append('kolumna', _dane['kolumna']);
            formData.append('uzytkownik_id', _dane['uzytkownik_id']);
            formData.append('element_id', _dane['element_id']);
            formData.append('reakcja', _dane['reakcja']);

        this.zaladujTrescAjax('/ajax/akcje/ajax_aktualizuj_dane', formData);

        odpowiedzAjax = $.parseJSON(_zawartosc_tresc_ajax);

        this.wyswietlPowiadomienieBoczne(odpowiedzAjax['rodzaj'],'',odpowiedzAjax['komunikat']);

        if(_dane['reakcja'] === 'dodaj'){
            var tabela = _dane['kolumna'].replace('_id','');

            if(_dane['szczegoly_elementu'] === 1){
                formData = new FormData();
                    formData.append('element_id', _dane['element_id']);
                    formData.append('akcja', _dane['widok_edycja']);
                    formData.append('tabela', tabela);

                this.zaladujTrescAjax('ajax/akcje/ajax_wczytaj_dane', formData);
                odpowiedzAjax = $.parseJSON(_zawartosc_tresc_ajax);
                document.getElementById('szczegolyElementu').innerHTML = odpowiedzAjax['tresc'];
                this.aktywujKontrolkiBootstrapowe();
                $('.szczegolyElementuZawartosc .active').removeClass('active');

            }else{
                this.przeladujZawartoscPopUp(_dane['element_id'], _dane['widok_edycja'], tabela, '');
                $('.modal-dialog1 .active').removeClass('active');
            }
            $('.zakladkaWidocznosc').addClass('active');
        }


    };

    this.wyswietlDodajUprawnienieUzytkownik = function(_dane){
        formData = new FormData();
            formData.append('akcja', 'wyswietl_dodaj_usun_uprawnienie_uzytkownika');
            formData.append('tabela', _dane['tabela']);
            formData.append('kolumna', _dane['kolumna']);
            formData.append('element_id', _dane['element_id']);
            formData.append('widok_edycja', _dane['widok_edycja']);
            formData.append('szczegoly_elementu', _dane['szczegoly_elementu']);

        this.zaladujTrescAjax('/ajax/akcje/ajax_wczytaj_widok', formData);

        odpowiedzAjax = $.parseJSON(_zawartosc_tresc_ajax);

        document.getElementById('popUpTresc2').innerHTML = odpowiedzAjax['tresc'];
        document.getElementById('popUpTytul2').innerHTML = odpowiedzAjax['tytul'];

        this.aktywujKontrolkiBootstrapowe();

        $('#popUp2').modal('show');
    };

    this.histroiaElementuFiltruj = function(_dane){
        if($('.liczbaWynikow').val() < 10){

            this.wyswietlPowiadomienieBoczne('blad','','Minimalna liczba wyników to 10!!!');
            return;
        }

        mainDane = this.zbierzDaneZFormularza('historiaElementuFiltry');

        formData = new FormData;
            formData.append( 'akcja', 'wyswietl_tabele_historia_elementu');
            formData.append( 'lista_parametrow', JSON.stringify(mainDane));
            formData.append( 'kolumna', _dane['kolumna']);
            formData.append( 'element_id', _dane['element_id']);
            formData.append( 'historia_element', _dane['historia_element']);

        this.wyswietlLoader('.historiaElementuTabelaWynikow');

        this.zaladujTrescAjax('/ajax/akcje/ajax_wczytaj_dane', formData);

        odpowiedzAjax = $.parseJSON(_zawartosc_tresc_ajax);

        document.getElementById('historiaElementuTabelaWynikow').innerHTML = odpowiedzAjax['tresc'];

        this.aktywujKontrolkiBootstrapowe();
    };

    this.wyswietlPowiadomieniaSystemowePopUp = function(){
        this.zaladujTrescAjax('/ajax/ajax_powiadomienia_sprawdz_wyswietl', null);

        odpowiedzAjax = $.parseJSON(_zawartosc_tresc_ajax);

        var pupup = mainPanel.getCookie('pupup');

        if(odpowiedzAjax[0] === '1' && pupup == 1 && odpowiedzAjax[3] === '1'){
            document.getElementById('popUpTresc').innerHTML = odpowiedzAjax[1];
            document.getElementById('popUpTytul').innerHTML = 'UWAGA!!!';

            this.aktywujKontrolkiBootstrapowe();

            //$('.modal-dialog').css('width', '900')
            $('#popUp').modal('show');
            setCookie('pupup',0);
        }

    };

    this.nadajUprawnienieDlaWszystkichwGrupie = function(_dane){
        var nazwa_grupy_lista = _dane['nazwa_grupy_lista'];
        var pola_uzytkownikow_grupy = $('.'+nazwa_grupy_lista+' .ldgu_element');
        var liczba_uzytkownikow_grupy = pola_uzytkownikow_grupy.length;

        if(liczba_uzytkownikow_grupy === 0){
            this.wyswietlPowiadomienieBoczne('blad','','Wszyscy użytkownicy z grupy posiadają to uprawnienie!!!');
            return;
        }

        var lista_uzytkownikow = {};

        for(var i = 0; i<liczba_uzytkownikow_grupy; i++){
            lista_uzytkownikow[i] = pola_uzytkownikow_grupy[i].getAttribute('data-uzytkownik_id');
        }

        formData = new FormData;
            formData.append( 'akcja', 'nadaj_uprawnienia_dla_wszystkich_w_grupie');
            formData.append( 'dane', JSON.stringify(lista_uzytkownikow));
            formData.append( 'element_id', _dane['element_id']);

        this.wyswietlLoader('#popUpTresc2');
        this.zaladujTrescAjax('/ajax/akcje/ajax_aktualizuj_dane', formData);
        this.ukryjLoader();
        odpowiedzAjax = $.parseJSON(_zawartosc_tresc_ajax);

        this.wyswietlPowiadomienieBoczne(odpowiedzAjax['rodzaj'],'',odpowiedzAjax['komunikat']);

        this.przeladujZawartoscPopUp(_dane['element_id'], 'wyswietl_edytuj_uprawnienie_grupy', 'uprawnienia', '');
        $('.modal-dialog1 .active').removeClass('active');
        $('.zakladkaWidocznosc').addClass('active');

    }

}

