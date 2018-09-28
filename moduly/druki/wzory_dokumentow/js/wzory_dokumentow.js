$(document).ready(function(){
    var liczba_stron = $('.pdf_strona').size();

    for(var i = 1; i<liczba_stron;i++){
        $('.pdf_strona')[i].setAttribute('style','margin-top: 30px');
    }

    usuwaj_koncowki('div');
    usuwaj_koncowki('p');

});

function usuwaj_koncowki(rodzaj_elementu){
    $(rodzaj_elementu).each(function() {
        var tekst = $(this).html();
        tekst = tekst.replace(/(\s)([\S])[\s]+/g,"$1$2&nbsp;"); //jednoznakowe
        tekst = tekst.replace(/(\s)([^<][\S]{1})[\s]+/g,"$1$2&nbsp;"); //dwuznakowe
        $(this).html(tekst);
    });
}
