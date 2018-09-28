var panelLogowania = new PanelLogowania();
var mainPanel = new MainPanel();

$(document).ready(function(){

    panelLogowania.sprawdzZakladkeId();


    $('#popUp').on('hidden.bs.modal', function (){
        panelLogowania.ukryjPopUpPanelLogowania();
    });

    $(this).on('click','.zakladkaElement', function() {
        panelLogowania.aktywujZakladkeId($(this).attr('id'));
    });

    $(this).on('click','.zaloguj', function() {
        panelLogowania.zaloguj($(this).data('klasa_rodzic'));
    });

    $(this).on('keypress','.uzytkownikZalogujHasloEnter', function(event) {
        if(event.keyCode === 13){
            panelLogowania.zaloguj($('.zaloguj').data('klasa_rodzic'));
        }
    });

    $(this).on('click','.zarejestruj', function() {
        var klasaRodzic = $(this).data('klasa_rodzic');

        /*var poleEmailVotum = $('.'+klasaRodzic+' .poleEmailVotum').val();

        if(poleEmailVotum.indexOf('votum-sa.pl') < 0){

            mainPanel.wyswietlPowiadomienieBootsrtap('danger','.'+klasaRodzic,'Wprowadź adres email w domenie votum-sa.pl!!!');
            setTimeout(function(){
                $('.powiadomienieBootstrap').remove();
            },5000);
            return;
        }*/

        panelLogowania.zarejestruj(klasaRodzic, $(this).data('zarejestruj_rodzaj'));
    });

    $(this).on('click','.przypomnijHaslo', function() {
        panelLogowania.przypomnijHaslo($(this).data('klasa_rodzic'));
    });

    $(this).on('keypress','.uzytkownikPrzypomnijHasloEnter', function(event) {
        if(event.keyCode === 13){
            panelLogowania.przypomnijHaslo($('.przypomnijHaslo').data('klasa_rodzic'));
        }
    });

    $(this).on('click','.ustawHaslo', function(){
        panelLogowania.ustawHaslo($(this).data('klasa_rodzic'));
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

    $(this).on('keypress','.poleLiczbowe', function(event) {
        return mainPanel.maskujKlawisze(event, '0123456789');
    });

    $(this).on('keypress','.zablokowanePole', function(event) {
        return false;
    });

    $(this).on('keypress','.duzeMaleLiteryCyfry', function(event) {
        return mainPanel.maskujKlawisze(event, 'AaĄąBbCcĆćDdEeĘęFfGgHhIiJjKkLlŁłMmNnŃńOoÓóPpRrSsŚśTtUuWwYyZzŹźŻżXx0123456789@-.!#$%^&*=+_;:,()?*');
    });

    $('.skryptJs').remove();
});

