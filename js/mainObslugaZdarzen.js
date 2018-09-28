var mainPanel = new MainPanel();

var main_dane = null;
var interval_test_czas = null;

/*http://stackoverflow.com/questions/19305821/multiple-modals-overlay*/
/*
$(document).on('show.bs.modal', '.modal', function (event) {
    var zIndex = 1040 + (10 * $('.modal:visible').length);
    $(this).css('z-index', zIndex);
    setTimeout(function() {
        $('.modal-backdrop').not('.modal-stack').css('z-index', zIndex - 1).addClass('modal-stack');
    }, 0);
});*/

$(document).ready(function() {

    mainPanel.sprawdzZakladke();

/*    setTimeout(function(){
        var pupup = mainPanel.getCookie('pupup');
        //alert(pupup);
        if (pupup == 1) {
            mainPanel.wczytajDaneDoPopUp('', $(this).data('akcja'), '', 'modal-lg', 'wczytaj_popup', 0,0,1);
            setCookie('pupup',0);
        }
    },3000);*/

    $('#popUp').on('hidden.bs.modal', function (){
        mainPanel.ukryjPopUp(false);
    });

    $('#popUp2').on('hidden.bs.modal', function () {
        mainPanel.ukryjPopUp(true);
    });

    $('#popUp3').on('hidden.bs.modal', function () {
        mainPanel.ukryjPopUp3();
    });

    $(this).on('keyup','input', function() {
        $(this).attr('value',$(this).val());
    });

    $(this).on('keypress','.poleLiczbowe', function(event) {
       // console.log(mainPanel.maskujKlawisze(event, '0123456789'));
        return mainPanel.maskujKlawisze(event, '0123456789');
    });

    $(this).on('keypress','.duzeMaleLiteryCyfry', function(event) {
        // console.log(mainPanel.maskujKlawisze(event, '0123456789'));

        return mainPanel.maskujKlawisze(event, 'QqAaĄąBbCcĆćDdEeĘęFfGgHhIiJjKkLlŁłMmNnŃńOoÓóPpRrSsŚśTtUuWwYyZzŹźŻżXxVv0123456789@-.!@#$%^&*-=+_;:,.()?*/');
    });

    $(this).on('click','.panel_body_menu button', function() {
        mainPanel.aktywujZakladke($(this).attr('id'));
    });

    $(this).on('click', '.dpUstawOpcje',function(){
        $(this).parent().parent().find('.dpUstawOpcjeNazwa').attr('value', $(this).data('element_id'));
        $(this).parent().parent().find('.dpUstawOpcjeNazwa').text($(this).text());
    });

    $(this).on('click','.historiaWyswietl', function() {
        var modal2 = false;
        if($(this).hasClass('PopUp2')){
            modal2 = true;
        }
        mainPanel.wczytajDaneDoPopUp($(this).data('element_id'), 'historia_wyswietl', $(this).data('tabela'), 'modal-lg', 'wczytaj_dane', modal2);
    });

    $(this).on('click','.dodaj_element', function() {
        mainPanel.wczytajDaneDoPopUp('', $(this).data('akcja'), '', 'modal-lgsm', 'dodaj_nowy');
    });

    $(this).on('click','.panelHistoriaNaglowek', function() {
        $(this).next('div').slideToggle();

    });

    $(this).on('click','#panel_body_zawartosc .rozwinZwinPanel',function(){
        if($(this).parent().hasClass('aktywnyPanel')){
            $(this).parent().removeClass('aktywnyPanel');
            $(this).next('div').slideUp();
        }else{
            $('.aktywnyPanel').removeClass('aktywnyPanel');
            $('#panel_body_zawartosc .panel-body').slideUp();

            $(this).parent().addClass('aktywnyPanel');
            $(this).next('div').slideDown();
        }
    });

    $(this).on('click','#popUpTresc2 .rozwinZwinPanelModal',function(){
        if($(this).parent().hasClass('aktywnyPanel')){
            $(this).parent().removeClass('aktywnyPanel');
            $(this).next('div').slideUp();
        }else{
            $('#popUpTresc2 .aktywnyPanel').removeClass('aktywnyPanel');
            $('#popUpTresc2 .panel-body').slideUp();

            $(this).parent().addClass('aktywnyPanel');
            $(this).next('div').slideDown();
        }
    });

    $(this).on('click','#popUpTresc3 .rozwinZwinPanelModal',function(){
        if($(this).parent().hasClass('aktywnyPanel')){
            $(this).parent().removeClass('aktywnyPanel');
            $(this).next('div').slideUp();
        }else{
            $('#popUpTresc3 .aktywnyPanel').removeClass('aktywnyPanel');
            $('#popUpTresc3 .panel-body').slideUp();

            $(this).parent().addClass('aktywnyPanel');
            $(this).next('div').slideDown();
        }
    });


    $(this).on('click', '.zpg_opcja .fa', function(){
        if(!$(this).hasClass('update')){
            $(this).addClass('update');
            $(this).parent().parent().find('.zpg_opcja_input').find('input').addClass('update');
        }

        if($(this).hasClass('fa-check-square-o')){
            $(this).removeClass('fa-check-square-o').addClass('fa-square-o');
            $(this).attr('value',0);
        }else{
            $(this).parent().parent().find('.fa-check-square-o').removeClass('fa-check-square-o').addClass('fa-square-o');
            $(this).removeClass('fa-square-o').addClass('fa-check-square-o');
            $(this).attr('value',1);
        }
    });

    $(this).on('click', '.zpg_opcjaaaa_radio .fa', function(){

        if(!$(this).hasClass('update')){
            $(this).addClass('update');
            $(this).parent().parent().find('.zpg_opcja_input').find('input').addClass('update');
        }

        if($(this).hasClass('fa-check-square-o')){
            //$(this).parent().parent().find('.fa-check-square-o').addClass('test');
            $(this).removeClass('fa-check-square-o').addClass('fa-square-o');
            //$(this).removeClass('update');
            //$(this).parent().parent().find('.fa-check-square-o').removeClass('update');
            //$(this).attr('value',0);
        }else{
            $(this).parent().parent().find('.fa-check-square-o').removeClass('update');
            //$(this).addClass('update');
            $(this).parent().parent().find('.fa-check-square-o').removeClass('fa-check-square-o').addClass('fa-square-o');
            //$(this).parent().parent().find('.zpg_opcja_input').find('input').attr('value',' ');
            //$(this).removeClass('fa-square-o').addClass('fa-check-square-o');
        }
    });


    $(this).on('click', '.zpg_opcja_radio .fa', function(){

        if(!$(this).hasClass('update')){
            $(this).addClass('update');
            $(this).parent().parent().find('.zpg_opcja_input').find('input').addClass('update');
        }

        if($(this).hasClass('fa-check-square-o')){
            $(this).removeClass('fa-check-square-o').addClass('fa-square-o');
            $(this).attr('value',0);
        }else{
            $(this).parent().parent().find('.fa-check-square-o').removeClass('fa-check-square-o').addClass('fa-square-o');
            $(this).parent().parent().find('.zpg_opcja_input').find('input').attr('value',' ');
            $(this).removeClass('fa-square-o').addClass('fa-check-square-o');
        }
    });


    $(this).on('keyup','.wynagrodzenieProcent',function(){
        if($(this).val() === '' && !$(this).hasClass('wymagane')){
            $(this).removeClass('blednaWartosc');
            return;
        }
        if($(this).val() > $(this).data('wartosc_maks')){
            $(this).addClass('blednaWartosc');
        }else{
            $(this).removeClass('blednaWartosc');
        }
    });

    $(this).on('keyup','.sprawdzIBAN',function(e){
        if($(this).val() === '' && !$(this).hasClass('wymagane')){
            $(this).removeClass('blednaWartosc');
            return;
        }

        if(e.keyCode !== 8){
            var wartosc = $(this).val();
            if(wartosc.length === 2 || wartosc.length === 7 || wartosc.length === 12 || wartosc.length === 17 || wartosc.length === 22 || wartosc.length === 27){
                $(this).val(wartosc+' ');
                $(this).attr('value', wartosc+' ')
            }
        }

        if(mainPanel.sprawdzIBAN($(this).val())){
            $(this).removeClass('blednaWartosc');
        }else{
            $(this).addClass('blednaWartosc');
        }
    });

    $(this).on('keyup','.sprawdzPesel',function(){
        if($(this).val() === '' && !$(this).hasClass('wymagane')){
            $(this).removeClass('blednaWartosc');
            return;
        }
        if(mainPanel.sprawdzPesel($(this).val())){
            $(this).removeClass('blednaWartosc');
        }else{
            $(this).addClass('blednaWartosc');
        }
    });

    $(this).on('keyup','.sprawdzNumerDowodu',function(){
        if($(this).val() === '' && !$(this).hasClass('wymagane')){
            $(this).removeClass('blednaWartosc');
            return;
        }
        if(mainPanel.sprawdzNumerDowodu($(this).val())){
            $(this).removeClass('blednaWartosc');
        }else{
            $(this).addClass('blednaWartosc');
        }
    });

    $(this).on('keyup','.sprawdzKodPocztowy',function(e){
        if($(this).val() === '' && !$(this).hasClass('wymagane')){
            $(this).removeClass('blednaWartosc');
            return;
        }
        if(e.keyCode !== 8) {
            var wartosc = $(this).val();
            if (wartosc.length === 2) {
                $(this).val(wartosc + '-');
                $(this).attr('value', wartosc + '-')
            }
        }

        if(mainPanel.sprawdzKodPocztowy($(this).val())){
            $(this).removeClass('blednaWartosc');
        }else{
            $(this).addClass('blednaWartosc');
        }
    });

    $(this).on('keyup','.sprawdzEmail',function(){
        if($(this).val() === '' && !$(this).hasClass('wymagane')){
            $(this).removeClass('blednaWartosc');
            return;
        }
        if(mainPanel.sprawdzEmail($(this).val())){
            $(this).removeClass('blednaWartosc');
        }else{
            $(this).addClass('blednaWartosc');
        }
    });

    $(this).on('click','#wyloguj',function(){
        mainPanel.wyloguj();
        deleteCookie("pupup");
    });

    $(this).on('click','.wyswietlPanelUzytkownika',function(){
        mainPanel.wyswietlPanelUzytkownika();
    });

    $(this).on('click','.odswierzSesje',function(){
        mainPanel.odswierzSesje();
        $('.licznikSesji60Sekund').remove();
    });

    $(this).on('change', '.przyciskUploadGrupaUpload input',function(){
        $(this).addClass('aktualizuj');
        var file = this.files[0];
        $(this).parent().find('#przyciskUploadGrupaNazwa').text(file.name);

    });

    interval_licznikSesji = setInterval(function(){
        mainPanel.licznikSesji();
    },60000);

    interval_sprawdzSesje = setInterval(function(){
        mainPanel.sprawdzSesje();
    },5000);

    $(this).on('change', '#uzytkownikAvatarPanelPrzyciskGrupaUpload input',function(){

        var file = this.files[0];
        if ( /^image/.test( file.type ) ) {
            var reader = new FileReader();
            reader.readAsDataURL( file );
            reader.onloadend = function(){
                $('#uzytkownikAvatarPanelPodglad img').attr('src',this.result);
                $('.panelUzytkownikAvatarInput').addClass('nowy aktualizuj').removeClass('domyslny');
            }
        }else{
            alert('Wybierz obraz!!!');
        }
    });

    $(this).on('click','.panelUzytkownikZapiszZmiany',function(){
        mainPanel.panelUzytkownikZapiszZmiany();
    });

    $(this).on('click','.usunAvatarPanelUzytkownika',function(){
        $('#uzytkownikAvatarPanelPodglad img').attr('src',adres_hosta+'/img/avatar/domyslny.png');
        $('.panelUzytkownikAvatarInput').removeClass('nowy').addClass('domyslny aktualizuj');
    });

    $(this).on('click','.elementDodajUsunUprawnienieGrupy',function(){
        var reakcja;
        if($(this).hasClass('fa-check-square-o')){
            $(this).removeClass('fa-check-square-o').addClass('fa-square-o');
            reakcja = 'usun';
        }else{
            $(this).removeClass('fa-square-o').addClass('fa-check-square-o');
            reakcja = 'dodaj';
        }
        mainDane = {
            'tabela' : $(this).data('tabela')
            ,'kolumna' : $(this).data('kolumna')
            ,'grupa_id' : $(this).data('grupa_id')
            ,'element_id' : $(this).data('element_id')
            ,'reakcja' : reakcja
        };

        mainPanel.elementDodajUsunUprawnienieGrupy(mainDane);
    });

    $(this).on('click','.elementDodajUsunUprawnienieUzytkownika',function(){
        var reakcja;
        if($(this).hasClass('usunTak')){
            $(this).parent().parent().parent().parent().addClass('deleteHighlight').slideUp(500, function() {
                $(this).remove();
            });
            reakcja = 'usun';
        }
        if($(this).hasClass('dodajTak')){
            $(this).parent().parent().addClass('deleteHighlight').slideUp(500, function() {
                $(this).remove();
            });
            reakcja = 'dodaj';
        }
        mainDane = {
            'tabela' : $(this).data('tabela')
            ,'kolumna' : $(this).data('kolumna')
            ,'uzytkownik_id' : $(this).data('uzytkownik_id')
            ,'element_id' : $(this).data('element_id')
            ,'reakcja' : reakcja
            ,'widok_edycja' : $(this).data('widok_edycja')
            ,'szczegoly_elementu' : $(this).data('szczegoly_elementu')
        };

        mainPanel.elementDodajUsunUprawnienieUzytkownika(mainDane);
    });

    $(this).on('click','.wyswietlDodajUprawnienieUzytkownik',function(){
        mainDane = {
            'tabela' : $(this).data('tabela')
            ,'kolumna' : $(this).data('kolumna')
            ,'element_id' : $(this).data('element_id')
            ,'widok_edycja' : $(this).data('widok_edycja')
            ,'szczegoly_elementu' : $(this).data('szczegoly_elementu')
        };
        mainPanel.wyswietlDodajUprawnienieUzytkownik(mainDane);
    });

    $(this).on('click','.histroiaElementuFiltruj', function() {
        mainDane = {
            'kolumna' : $(this).data('kolumna')
            ,'element_id' : $(this).data('element_id')
            ,'historia_element' : $(this).data('historia_element')
        };
        mainPanel.histroiaElementuFiltruj(mainDane);
    });

    $(this).on('keyup','.histroiaElementuFiltrujEnter', function(e) {
        if(e.keyCode === 13){
            var button_historia_elementu = $('.histroiaElementuFiltruj');
            mainDane = {
                'kolumna' : button_historia_elementu.data('kolumna')
                ,'element_id' : button_historia_elementu.data('element_id')
                ,'historia_element' : button_historia_elementu.data('historia_element')
            };
            mainPanel.histroiaElementuFiltruj(mainDane);
        }
    });

    $(this).on('click','.insertHtmlAktualizuj', function() {
        var html = $(this).parent().find('textarea').val();
        $(this).parent().parent().parent().find('.wysiwyg-editor').html(html);
    });

    if($('.strona_glowna').length !== 0){
        mainPanel.wyswietlPowiadomieniaSystemowePopUp();
    }

    $(this).on('click','.nadajUprawnienieDlaWszystkichwGrupie', function() {
        var nazwa_grupy_lista = $(this).data('nazwa_grupy_lista');
        var pole_grupy_lista = $('.'+nazwa_grupy_lista);

        mainDane = {
            'element_id' : pole_grupy_lista.find('.elementDodajUsunUprawnienieUzytkownika').data('element_id')
            ,'nazwa_grupy_lista' : nazwa_grupy_lista
        };
        mainPanel.nadajUprawnienieDlaWszystkichwGrupie(mainDane);
    });

});