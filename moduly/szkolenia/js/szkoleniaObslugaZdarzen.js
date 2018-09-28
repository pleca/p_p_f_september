if(!isset(szkoleniaMain)){
    var szkoleniaMain = new SzkoleniaMain();
}


var strona = $('#strona');
clearInterval(interval_test_czas);

$(document).ready(function(){

    strona.on('click','.szkolenia_aktualnosc_pojedyncza .well', function() {
        mainPanel.wczytajDaneDoPopUp($(this).parent().data('element_id'), $(this).data('akcja'), $(this).data('tabela'), 'modal-lg', 'wczytaj_dane');
    });

    strona.on('click','.szkolenia_aktualnosc_pojedyncza .fa-pencil', function() {
        mainPanel.wczytajDaneDoPopUp($(this).parent().data('element_id'), $(this).data('akcja'), $(this).data('tabela'), 'modal-lg', 'wczytaj_dane');
    });

    strona.on('click','.edytuj_szkolenie', function() {
        mainPanel.wczytajDaneDoPopUp($(this).parent().parent().data('element_id'), $(this).parent().data('akcja'), $(this).parent().parent().data('tabela'), 'modal-lg', 'wczytaj_dane');
    });

    strona.on('click','.edytuj_test', function() {
        mainPanel.wczytajDaneDoPopUp($(this).data('element_id'), $(this).data('akcja'), $(this).data('tabela'), 'modal-lg', 'wczytaj_dane', true);
    });

    strona.on('click','.edytuj_material', function() {
        mainPanel.wczytajDaneDoPopUp($(this).data('element_id'), $(this).data('akcja'), $(this).data('tabela'), 'modal-lg', 'wczytaj_dane' ,true);
    });

    strona.on('click','.wyswietl_material', function() {
        mainPanel.wczytajDaneDoPopUp($(this).data('element_id'), $(this).data('akcja'), $(this).data('tabela'), 'modal-lg', 'wczytaj_dane' ,true);
    });


    $(this).on('click', '.TypSzkoleniaOpcja',function(){
        //inputPole = $('.szkolenieMiejsce');
        if($(this).data('element_id') === 3){
            $('.szkolenieMiejsce').removeAttr('disabled');
            $('.szkolenieMiejsce').val('');
        } else if ($(this).data('element_id') === 1) {
            $('.szkolenieMiejsce').attr('disabled', 'disabled');
            $('.szkolenieMiejsce').val('Online');
        } else if ($(this).data('element_id') === 2) {
            $('.szkolenieMiejsce').attr('disabled', 'disabled');
            $('.szkolenieMiejsce').val('Wrocław');
        }
    });

    strona.on('click','.wyswietl_test', function() {
        mainPanel.wczytajDaneDoPopUp($(this).data('element_id'), $(this).data('akcja'), $(this).data('tabela'), 'modal-lgsm', 'wczytaj_dane' ,true);

        interval_test_czas = setInterval(function(){
            if(szkoleniaMain.odliczajCzasTestu()){
                clearInterval(interval_test_czas);

                main_dane = {
                    '_element_id' : $('.testDoRozwiazaniaPytania button').data('proba_id')
                    ,'_tabela' : $('.testDoRozwiazaniaPytania button').data('tabela')
                };

                szkoleniaMain.obliczWynikTestu(main_dane);
            }

        }, 1000);


    });

    strona.on('click','.wyswietl_szkolenie', function() {
        //szkoleniaMain.wczytajDaneDoPopUp($(this).parent().data('element_id'), $(this).parent().data('akcja'), $(this).parent().data('tabela'), (($(this).parent().hasClass('zapisany')) ? 'modal-lg' : 'modal-lgsm'));
        mainPanel.wczytajDaneDoPopUp($(this).parent().data('element_id'), $(this).parent().data('akcja'), $(this).parent().data('tabela'), 'modal-lgsm', 'wczytaj_dane');
    });

    strona.on('click','.dodaj_element_szkolenia', function() {
        if($(this).data('akcja') === 'dodaj_szkolenie'){
            mainPanel.wczytajDaneDoPopUp($(this).data('szkolenia_id'),$(this).data('akcja'),'','modal-lgsm', $(this).data('rodzaj'));
        }else if($(this).data('akcja') === 'dodaj_test'){
            mainPanel.wczytajDaneDoPopUp($(this).data('szkolenia_id'),$(this).data('akcja'),'','modal-lgsm', $(this).data('rodzaj') ,true);
        }else if($(this).data('akcja') === 'dodaj_aktualnosc') {
            mainPanel.wczytajDaneDoPopUp($(this).data('szkolenia_id'),$(this).data('akcja'),'','modal-lg', $(this).data('rodzaj'));
        }else{
            mainPanel.wczytajDaneDoPopUp($(this).data('szkolenia_id'),$(this).data('akcja'),'','modal-lg', $(this).data('rodzaj') ,true);
        }
    });

    strona.on('click','.DodajUczesnitkaOkno', function() {
        mainPanel.wczytajDaneDoPopUp($(this).data('element_id'), $(this).data('akcja'), $(this).data('tabela'), 'modal-lgsm', 'wczytaj_dane' ,true);
    });

    strona.on('click','.dodajUczesnitkaWyszukajDoSzkolenia', function() {
        main_dane = {
            '_szkolenia_id': $(this).data('szkolenia_id')
            ,'_uzytkownik_id': $(this).data('uzytkownik_id')

        };

        $(this).parent().parent().addClass('deleteHighlight').slideUp(500, function() {
            $(this).remove();
        });

        szkoleniaMain.dodajUczesnitkaWyszukajDoSzkolenia(main_dane);
    });


    strona.on('click','.zapiszUsunDoSzkolenia', function() {
        if($(this).data('akcja') === 'usun_ze_szkolenia'){
            $(this).parent().parent().parent().parent().addClass('deleteHighlight').slideUp(500, function() {
                $(this).remove();

                //console.log($('#oeszUczestnicy tbody tr').size());
                /* if($('#oeszUczestnicy tbody tr').size() == 0){
                 $('#oeszUczestnicy').text('Brak zapisanych uczestników...');
                 }*/
            });
        }

        main_dane = {
            '_szkolenia_id' : $(this).data('szkolenia_id')
            ,'_uzytkownik_id' : $(this).data('uzytkownik_id')
        };
        szkoleniaMain.zapiszUsunDoSzkolenia($(this).data('akcja'), $(this).data('tabela'), main_dane);
    });

    strona.on('click','.usunPrzywrocElement', function() {
        if($(this).data('tabela') === 'szkolenia_materialy'
            || $(this).data('tabela') === 'szkolenia_testy'
            || $(this).data('tabela') === 'szkolenia_testy_pytania_odpowiedzi'){
            $(this).parent().parent().parent().parent().addClass('deleteHighlight').slideUp(500, function() {
                $(this).remove();
            });
        }

        if($(this).data('tabela') === 'szkolenia_testy_pytania'){
            $(this).parent().parent().parent().addClass('deleteHighlight');
            $(this).parent().parent().parent().parent().slideUp(500, function() {
                $(this).remove();
            });
        }

        main_dane = {
            '_element_id' : $(this).data('element_id')
            ,'_reakcja' : $(this).data('reakcja')
            ,'_tabela' : $(this).data('tabela')

        };
        mainPanel.usunPrzywrocElement(main_dane);
    });

    strona.on('click','.zapiszZmiany', function() {

        main_dane = {
            '_element_id' : $(this).data('element_id')
            ,'_tabela' : $(this).data('tabela')
            ,'_akcja' : $(this).data('akcja')
            ,'_rodzic' : $(this).parent().data('rodzic_klasa')
        };
        mainPanel.zapiszZmiany(main_dane);
    });

    strona.on('click','.zapiszZmianyTest', function() {

        main_dane = {
            '_element_id' : $(this).data('element_id')
            ,'_tabela' : $(this).data('tabela')
            ,'_akcja' : $(this).data('akcja')
            ,'_rodzic' : $(this).parent().data('rodzic_klasa')
        };
        szkoleniaMain.zapiszZmianyTest(main_dane);
    });

    strona.on('click','.rozpocznijRozwiazywanieTestu', function() {

        main_dane = {
            '_element_id' : $(this).data('element_id')
            ,'_tabela' : $(this).data('tabela')
            ,'_akcja' : $(this).data('akcja')
        };
        szkoleniaMain.rozpocznijRozwiazywanieTestu(main_dane);
    });

    strona.on('click','.dodajOdpowiedzDoPytania', function() {

        main_dane = {
            '_element_id' : $(this).data('element_id')
            ,'_tabela' : $(this).data('tabela')
            ,'_akcja' : $(this).data('akcja')
            ,'_rodzic' : $(this).parent().data('rodzic_klasa')
        };
        szkoleniaMain.dodajOdpowiedzDoPytania(main_dane);
    });



    strona.on('click','.usunMiniaturaAktualnosc', function() {
        var miniaturaUploadPrzycisk = $('.miniaturaUploadPrzycisk');
        miniaturaUploadPrzycisk.val('');
        $('.miniaturaUploadImg img').remove();
        miniaturaUploadPrzycisk.addClass('prm');

    });



    strona.on('keyup','.oknoEdycjiMaterialu #wysiwyg_edytor', function() {
        var oknoEdycjiMaterialyWyswigEdytor = $('.oknoEdycjiMaterialu #wysiwyg_edytor');
        var oknoEdycjiMaterialuEditorPrm = $('.oknoEdycjiMaterialu .editor.prm');
        var przyciskUploagGrupa = $('.przyciskUploagGrupa');
        setTimeout(function(){
            console.log(oknoEdycjiMaterialyWyswigEdytor.html());
            console.log(oknoEdycjiMaterialyWyswigEdytor.text().length);

            if(oknoEdycjiMaterialyWyswigEdytor.html() == '<br>'){
                oknoEdycjiMaterialuEditorPrm.empty();
                oknoEdycjiMaterialyWyswigEdytor.empty();
            }

            if((oknoEdycjiMaterialyWyswigEdytor.text()).length > 0){
                przyciskUploagGrupa.slideUp();
            }else{
                przyciskUploagGrupa.slideDown();
                oknoEdycjiMaterialuEditorPrm.empty();
            }
        },1);


    });

    strona.on('change','.miniaturaUploadPrzycisk', function() {
        if ( /^image/.test( this.files[0].type ) ) {
            mainPanel.podgladMiniatury(this);
            $(this).addClass('prm');
        }else{
            powiadomienieBoczne('blad','','Wybierz obraz!!!');
        }

    });


    strona.on('click','.usunPlikPrzyciskUpload', function() {
        var przyciskUploadPrzycisk = $('.przyciskUploadPrzycisk');
        przyciskUploadPrzycisk.val('');
        $('.przyciskUpload span').text('Wybierz plik');
        przyciskUploadPrzycisk.addClass('prm');

        if($('.oknoEdycjiMaterialu').size() != 0){
            $('.wysiwyg-container').slideDown();
            $('.editor.prm').empty();
        }


    });

    strona.on('change','.przyciskUploadPrzycisk', function() {
        $(this).parent().find('span').text(this.files[0].name);
        $(this).addClass('prm');

        if($('.oknoEdycjiMaterialu').size() != 0){
            $('.wysiwyg-container').slideUp();
            $('.editor.prm').empty().next('div').empty();

        }
    });

    var popUp = $('#popUp');



    popUp.on('click', '.wyslijWiadomoscDoOrganizatora', function(){
        mainPanel.wyslijWiadomosc($('.wyslijWiadomoscDoOrganizatoraTemat').val(), $('.wyslijWiadomoscDoOrganizatoraTresc').val(),'pytanie_do_szkolenia', $(this).data('element_id'));
    });



    strona.on('click','.wyswietlDodajPytanie', function() {
        $('.odtDodajPytanie').slideToggle();
    });

    strona.on('click','.edytujPytanieWidokWysun', function() {
        $(this).parent().parent().find('.odtEdytujPytanie').slideToggle();
        $(this).parent().parent().find('.panel-body').slideToggle();
    });

    strona.on('click','.olpedWysun', function() {
        $(this).parent().parent().parent().parent().find('.olp_element_dodaj').slideToggle();
    });

    strona.on('click', '.olpElPojPoprawna', function(){
        if($(this).hasClass('fa-square-o')){
            $(this).removeClass('fa-square-o').addClass('fa-check-square-o').attr('value',1);
        }else{
            $(this).removeClass('fa-check-square-o').addClass('fa-square-o').attr('value',0);
        }
    });

    strona.on('click','.zaznaczOdpowiedz', function() {
        $(this).parent().find('.prm').removeClass('prm');
        $(this).addClass('prm');
    });

    strona.on('click','.zaznaczOdpowiedzWiele', function() {
        if($(this).hasClass('prm')){
            $(this).removeClass('prm');
        }else{
            $(this).addClass('prm');
        }
    });

    strona.on('click','.zapiszOdpowiedzUzytkownika', function() {

        if($(this).hasClass('przejdzDalej')){
            var aktywujZakladke = $(this).data('pytanie_klasa');
            $('.testDoRozwiazaniaPytania .active').removeClass('active');
            $('#'+aktywujZakladke).addClass('active');
            $('.'+aktywujZakladke).addClass('active').removeClass('ukryj_widok');
            $(this).removeClass('przejdzDalej');
            $(this).text('Zapisz');

        }

        main_dane = {
            '_element_id' : $(this).data('proba_id')+'-'+$(this).data('element_id')
            ,'_tabela' : $(this).data('tabela')
            ,'_akcja' : $(this).data('akcja')
            ,'_rodzic' : $(this).parent().data('rodzic_klasa')
            ,'_odpowiedz_wiele' : (($(this).hasClass('OdpowiedziWiele')) ? 1 : 0)
        };
        szkoleniaMain.zapiszZmianyTest(main_dane);

    });

    strona.on('click','.obliczWynikTestu', function() {
        main_dane = {
            '_element_id' : $(this).data('proba_id')
            ,'_tabela' : $(this).data('tabela')
        };

        szkoleniaMain.obliczWynikTestu(main_dane);
    });

    strona.on('click','.wyswietlTestDoOceny', function() {
        mainPanel.wczytajDaneDoPopUp($(this).data('element_id'),$(this).data('akcja'),$(this).data('tabela'),'modal-lgsm', $(this).data('rodzaj'));
    });

    strona.on('click','.ocenOdpowiedzUzytkownika', function() {

        main_dane = {
            '_element_id' : $(this).data('proba_id')+'-'+$(this).data('element_id')
            ,'_tabela' : $(this).data('tabela')
            ,'_akcja' : $(this).data('akcja')
            ,'_liczba_punktow' : $(this).parent().find('.ozpo_liczba_pkt').val()
        };
        szkoleniaMain.ocenOdpowiedzUzytkownika(main_dane);

    });

    strona.on('click','.wyslijWiadomoscDoWszystkichUczestnikow', function() {

        mainPanel.wczytajDaneDoPopUp($(this).data('element_id'), 'wyswietl_okno_wyslij_wiadomosc', '', 'modal-lg', 'dodaj_nowy', true);

    });

    strona.on('click','.usunUczestnikazListyDoWysylki',function(){
        $(this).parent().parent().parent().hide(function(){
            $(this).remove();
        });
    });

    strona.on('click','.wyslijWiadomoscDoUczestnikow', function() {

        main_dane = {
            '_element_id' : $(this).data('element_id')
            ,'_tabela' : $(this).data('tabela')
            ,'_akcja' : $(this).data('akcja')
        };

        szkoleniaMain.wyslijWiadomoscDoUczestnikow(main_dane);

    });
    strona.on('change','.mailing_zalaczniki_dodaj_pole', function() {
        var zalacznik = $(this)[0].files[0];

        var formData = new FormData();
        formData.append('zalacznik', zalacznik);

        $.ajax({
            method: "POST",
            url: "ajax/akcje/ajax_zalacznik_zapisz_do_tmp",
            data: formData,
            contentType: false,
            processData: false

        }).done(function(data){

            powiadomienieBoczne('sukces','','Załącznik został zapisany!!!');

            var element = '<div class="mailing_zalacznik" data-email_zalacznik="'+data+'"><p class="mail_napis">'+data+'</p><span class="usun_zalacznik"><span>x</span></span><div class="clear_b"></div></div>';

            $('#mailing_zalaczniki_lista').append(element);
            $('.usun_zalacznik').click(function(){
                $(this).parent().remove();
            });

            zeruj_licznik_sesji_po_wykonaniu_funkcji();
        }).fail(function(ajaxContext) {
            document.getElementById("body_strona_r").innerHTML = ajaxContext.responseText ;
        });

    });

});