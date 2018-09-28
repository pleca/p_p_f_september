if(!isset(drukiSystem)){
    var drukiSystem = new DrukiSystem();
}

var res;
var strona = $('#strona');

$(document).ready(function(){

    strona.on('keyup','.policz_znaki ', function() {

        var limit = $(this).data('liczba_znakow');
        var ile_wpisano = $(this).val().length;
        if(ile_wpisano > limit) {
            reset = $(this).val().substring(0, limit);
            $(this).val(reset);
        }
        $(this).next().text(limit - $(this).val().length);
    });


    strona.on('click', '.zgodaGiodo', function(){
        drukiSystem.wczytajListeDrog();
    });

    strona.on('click', '.wczytajStroneUmowyDoPopUp', function(){
        main_dane = {
            '_element_id' : $(this).data('element_id')
            ,'_ogolne' : $(this).data('ogolne')
            ,'_droga' : $(this).data('droga')
            ,'_strona' : $(this).data('strona')
            ,'_akcja' : $(this).data('akcja')
        };
        drukiSystem.wczytajDrogeUmowyDoPopUp(main_dane);
    });

    strona.on('click', '.wczytajStroneDrogiUmowyDoPopUp', function(){


        main_dane = {
            '_element_id' : $(this).data('element_id')
            ,'_tabela' : $(this).data('tabela')
            ,'_akcja' : $(this).data('akcja')
            ,'_ogolne' : $(this).data('ogolne')
            ,'_droga' : $(this).data('droga')
            ,'_strona' : $(this).data('strona')
            ,'_reakcja' : $(this).data('reakcja')
            ,'_rodzic' : $(this).data('klasa_rodzic')
        };

        //console.log(main_dane);

        if($(this).data('reakcja') == 'zapisz_zmiany' || $(this).data('reakcja') == 'zapisz_przeladuj_widok'){

        if($('.sprawdzPesel').val()){
            var pesel = $('.sprawdzPesel').val();
            var month = pesel.substring(2, 4);
            var year = pesel.substring(0, 2);

            if(parseInt(month) > 12){
                var currentYear = (new Date).getFullYear();
                year = parseInt(year);
                year += 2000;
                if(currentYear - year < 18){
                  if($(".daneKlientaPopUp").find("[data-kolumna='Dowod']").hasClass('wymagane'))
                  $(".daneKlientaPopUp").find("[data-kolumna='Dowod']").removeClass('wymagane');
                }else{
                    if(!$(".daneKlientaPopUp").find("[data-kolumna='Dowod']").hasClass('wymagane')){
                      $(".daneKlientaPopUp").find("[data-kolumna='Dowod']").addClass('wymagane');
                    }
                }
            }
        }

            var odpowiedz = drukiSystem.zapiszZmianyStrona(main_dane);

            if(odpowiedz){
                main_dane = {
                    '_element_id' : odpowiedz
                    ,'_tabela' : $(this).data('tabela')
                    ,'_akcja' : 'edytuj'
                    ,'_ogolne' : $(this).data('ogolne')
                    ,'_droga' : $(this).data('droga')
                    ,'_strona' : $(this).data('strona')
                    ,'_reakcja' : $(this).data('reakcja')
                    ,'_rodzic' : $(this).data('klasa_rodzic')
                };

                drukiSystem.wczytajStroneDrogiUmowyDoPopUp(main_dane);
            }
        }

        if($(this).data('reakcja') == 'przeladuj_widok'){
            main_dane['_akcja'] = 'edytuj';

            drukiSystem.wczytajStroneDrogiUmowyDoPopUp(main_dane);
        }

    });

    strona.on('click','.edytuj_klienta',function(){
        main_dane = {
            'element_id' : $(this).parent().data('element_id')
            ,'tabela' : $(this).parent().data('tabela')
            ,'akcja' : $(this).parent().data('akcja')
        };

        mainPanel.szczegolyElementu(main_dane);
    });

    strona.on('click','.szczeguly_umowy',function(){
        main_dane = {
            'element_id' : $(this).parent().data('element_id')
            ,'tabela' : $(this).parent().data('tabela')
            ,'akcja' : $(this).parent().data('akcja')
        };

        mainPanel.szczegolyElementu(main_dane);
    });

    strona.on('click','.zapiszZmiany',function(){
        main_dane = {
            '_element_id' : $(this).data('element_id')
            ,'_tabela' : $(this).data('tabela')
            ,'_akcja' : $(this).data('akcja')
            ,'_rodzic' : $(this).data('klasa_rodzic')
        };

        drukiSystem.zapiszZmianyDruki(main_dane);
    });

    strona.on('click','.rozwinPojedynczyPanel',function(){
        if($(this).parent().parent().hasClass('aktywnyPanel')){
            $(this).parent().parent().removeClass('aktywnyPanel');
            $(this).parent().next('div').slideUp();
        }else{
            $(this).parent().parent().addClass('aktywnyPanel');
            $(this).parent().next('div').slideDown();
        }
    });

    strona.on('click','.rozwinPojedynczyPanelNaglowniek',function(){
        if($(this).parent().hasClass('aktywnyPanel')){
            $(this).parent().removeClass('aktywnyPanel');
            $(this).next('div').slideUp();
        }else{
            //$('.aktywnyPanel').slideUp();
            $(this).parent().addClass('aktywnyPanel');
            $(this).next('div').slideDown();
        }
    });

    strona.on('click','.dpUstawOpcje',function(){
        if($(this).data('element_id') == 1){
            $('.numerRachunku').slideUp();
            $('.numerRachunku input').val('');
            $('.numerRachunku input').attr('value','');
            $('.numerRachunku input').removeClass('wymagane');
        }else{
            $('.numerRachunku').slideDown();
            $('.numerRachunku input').addClass('wymagane');
        }
    });

    strona.on('change', '#drukUmowyPrzyciskGrupaUpload input',function(){

        var file = this.files[0];

        $('#drukUmowyPrzyciskGrupaUpload span').text(file.name);

    });

    strona.on('click','.usunPrzywrocZalacznik',function(){

        $(this).parent().parent().parent().parent().addClass('deleteHighlight').slideUp(500, function() {
            $(this).remove();
        });

        main_dane = {
            '_element_id' : $(this).data('element_id')
            ,'_tabela' : $(this).data('tabela')
            ,'_akcja' : $(this).data('akcja')
            ,'_reakcja' : $(this).data('reakcja')
        };

        drukiSystem.usunPrzywrocElement(main_dane);
    });

    strona.on('click','.generujDokument',function(){

        main_dane = {
            '_element_id' : $(this).data('element_id')
            ,'_nazwa_druku' : $(this).data('nazwa_druku')
            ,'_droga' : $(this).data('droga')
            ,'_rodzaj_druku' : $(this).data('rodzaj_druku')
        };

        drukiSystem.generujDokument(main_dane);
    });

    strona.on('click','.zmienAdres',function(){

        var adk_ulica = $('.adk_ulica input');
        var adk_nr_domu = $('.adk_nr_domu input');
        var adk_nr_mieszkania = $('.adk_nr_mieszkania input');
        var adk_kod_pocztowy = $('.adk_kod_pocztowy input');
        var adk_miasto = $('.adk_miasto input');
        var adresDoKorespondencjiUmowa = $('.adresDoKorespondencjiUmowa input');

        if($(this).hasClass('fa-check-square-o')){
            adresDoKorespondencjiUmowa.removeAttr('disabled');
            adresDoKorespondencjiUmowa.addClass('update');

            adk_ulica.val(adk_ulica.data('wartosc_domyslna'));
            adk_ulica.attr('value',adk_ulica.data('wartosc_domyslna'));

            adk_nr_domu.val(adk_nr_domu.data('wartosc_domyslna'));
            adk_nr_domu.attr('value',adk_nr_domu.data('wartosc_domyslna'));

            adk_nr_mieszkania.val(adk_nr_mieszkania.data('wartosc_domyslna'));
            adk_nr_mieszkania.attr('value',adk_nr_mieszkania.data('wartosc_domyslna'));

            adk_kod_pocztowy.val(adk_kod_pocztowy.data('wartosc_domyslna'));
            adk_kod_pocztowy.attr('value',adk_kod_pocztowy.data('wartosc_domyslna'));

            adk_miasto.val(adk_miasto.data('wartosc_domyslna'));
            adk_miasto.attr('value',adk_miasto.data('wartosc_domyslna'));
        }else{
            adresDoKorespondencjiUmowa.attr('disabled','disabled');
            adresDoKorespondencjiUmowa.removeClass('update');

            adk_ulica.val(adk_ulica.data('zam_wartosc'));
            adk_ulica.attr('value',adk_ulica.data('zam_wartosc'));

            adk_nr_domu.val(adk_nr_domu.data('zam_wartosc'));
            adk_nr_domu.attr('value',adk_nr_domu.data('zam_wartosc'));

            adk_nr_mieszkania.val(adk_nr_mieszkania.data('zam_wartosc'));
            adk_nr_mieszkania.attr('value',adk_nr_mieszkania.data('zam_wartosc'));

            adk_kod_pocztowy.val(adk_kod_pocztowy.data('zam_wartosc'));
            adk_kod_pocztowy.attr('value',adk_kod_pocztowy.data('zam_wartosc'));

            adk_miasto.val(adk_miasto.data('zam_wartosc'));
            adk_miasto.attr('value',adk_miasto.data('zam_wartosc'));
        }

    });

    $(this).on('click', '.dzialaWImieniuOpcja',function(){
        inputPole = $('.dzialajacyWImieniuDane input');
        if($(this).data('element_id') === 4){
            inputPole.attr('disabled', 'disabled');
            inputPole.val('');
            inputPole.removeClass('update wymagane');
        }else{
            inputPole.removeAttr('disabled');
            inputPole.addClass('update wymagane');
        }
    });


    $(this).on('click', '.UmowaRodzajUprawnionegoOpcja',function(){
        inputPole = $('.daneUprawnionegoPopUp input');
        if($(this).data('element_id') === 4){
            inputPole.removeClass('wymaganeBlad');
            inputPole.attr('disabled', 'disabled');
            inputPole.val('');
            inputPole.removeClass('update');
            inputPole.removeClass('wymagane');
        }else{
            inputPole.removeAttr('disabled');
            inputPole.addClass('update');
            $('.telefonUprawniony').addClass('wymagane');
            //$('.emailUprawniony').addClass('wymagane');
            $('.dowodUprawniony').addClass('sprawdzNumerDowoduLubPusty');
            $('.peselUprawniony').addClass('sprawdzPesel');
        }
    });

    $(this).on('click', '.daneKlientaRzeczowe .sposobPlatnosci' ,function(){

        //var wartosc = $('.RodzajKlienta').val();

        //alert(wartosc);

    });


    $(this).on('click', '.pokaz',function(){

        var klasa = $(this).parent().parent().next().attr('class');
        var res = klasa.split(" ");

        var klasa2 = $(this).parent().parent().parent().next().attr('class');
        var res2 = klasa2.split(" ");

        if(res2[0] == 'UrzadSkarbowy') {

            var inputPole = $('.'+res2[0]+' input');
            if($(this).hasClass('fa-square-o')){
                inputPole.attr('disabled', 'disabled');
                inputPole.val('');
                inputPole.removeClass('update wymagane');
            }else{
                inputPole.removeAttr('disabled');
                inputPole.addClass('update wymagane');
            }
        }

        inputPole = $('.'+res[0]+' input');
        if($(this).hasClass('fa-square-o')){
            inputPole.attr('disabled', 'disabled');
            inputPole.val('');
            inputPole.removeClass('update wymagane');
        }else{
            inputPole.removeAttr('disabled');
            inputPole.addClass('update wymagane');
        }
    });

    $(this).on('click', '.ukryj',function(){

        var klasa = $(this).parent().parent().next().attr('class');
        var res = klasa.split(" ");

        var klasa2 = $(this).parent().parent().parent().next().attr('class');
        var res2 = klasa2.split(" ");

        if(res2[0] == 'UrzadSkarbowy') {

            var inputPole = $('.' + res2[0] + ' input');
            if($(this).hasClass('fa-check-square-o')){
                inputPole.attr('disabled', 'disabled');
                inputPole.val('');
            }else{
                inputPole.addClass('update wymagane');
            }
        }

            inputPole = $('.'+res[0]+' input');
        if($(this).hasClass('fa-check-square-o')){
            inputPole.attr('disabled', 'disabled');
            inputPole.val('');
        }else{
            inputPole.addClass('update wymagane');
        }
    });

    // AKCJE DO UMOWY OSOBOWEJ
    $(this).on('click', '.rodzaj_szkody',function(){

        if(($(this).hasClass('fa-check-square-o')) && ($(this).data('opcja') == 'komunikacyjna')){
            $(this).parent().parent().next().next().slideDown();
        } else {
            $(this).parent().parent().next().next().children().next().children().children(":first").removeClass('fa-check-square-o');
            $(this).parent().parent().next().next().children().next().children().children(":first").addClass('fa-square-o');
            $(this).parent().parent().next().next().slideUp();
        }

    });

    // ODPOWIEDZIALNOŚĆ KARNA

    $(this).on('click', '.ZleconoRoszczenia',function(){

        if($('.ZleconoRoszczeniaTak').hasClass('fa-square-o')){
            $('.ZleconoRoszczeniaTak').parent().next().children(":first").next().val(' ');
            $('.ZleconoRoszczeniaTak').parent().next().next().children(":first").next().val(' ');
        }
    });

    $(this).on('click', '.WypowiedzenieUmowy',function(){
        if($('.WypowiedzenieUmowyTak').hasClass('fa-square-o')){
            $('.WypowiedzenieUmowyTak').parent().next().children(":first").next().val(' ');
        }
    });

    $(this).on('click', '.PrzekazanoDokumentacje',function(){
        if($('.PrzekazanoDokumentacjeTak').hasClass('fa-square-o')){
            $('.PrzekazanoDokumentacjeTak').parent().next().children(":first").next().val(' ');
        }
    });

    $(this).on('click', '.WezwanoPolicje',function(){
        if($('.WezwanoPolicjeTak').hasClass('fa-square-o')){
            $('.WezwanoPolicjeTak').parent().next().children(":first").next().val(' ');
        }
    });
    $(this).on('click', '.PostepowanieZarzut',function(){
        if($('.PostepowanieZarzutTak').hasClass('fa-square-o')){
            $('.PostepowanieZarzutTak').parent().next().children(":first").next().val(' ');
            $('.PostepowanieZarzutTak').parent().next().next().children().children(":first").removeClass('fa-check-square-o');
            $('.PostepowanieZarzutTak').parent().next().next().children().children(":first").addClass('fa-square-o');
        }
    });
    $(this).on('click', '.PostepowanieKarne',function(){
        if($('.PostepowanieKarneTak').hasClass('fa-square-o')){
            $('.PostepowanieKarneTak').parent().next().children(":first").next().val(' ');
            $('.PostepowanieKarneTak').parent().next().next().children().children(":first").removeClass('fa-check-square-o');
            $('.PostepowanieKarneTak').parent().next().next().children().children(":first").addClass('fa-square-o');
        }
    });
    $(this).on('click', '.SkierowanoAkt',function(){
        if($('.SkierowanoAktTak').hasClass('fa-square-o')){
            $('.SkierowanoAktTak').parent().next().children(":first").next().val(' ');
        }
    });
    $(this).on('click', '.ZapadlWyrok',function(){
        if($('.ZapadlWyrokTak').hasClass('fa-square-o')){
            $('.ZapadlWyrokTak').parent().next().children(":first").next().next().children(":first").next().val(' ');
            $('.ZapadlWyrokTak').parent().next().children(":first").next().next().next().children(":first").children(":first").removeClass('fa-check-square-o');
            $('.ZapadlWyrokTak').parent().next().children(":first").next().next().next().children(":first").children(":first").addClass('fa-square-o');

            $('.ZapadlWyrokTak').parent().next().children().children(":first").removeClass('fa-check-square-o');
            $('.ZapadlWyrokTak').parent().next().children().children(":first").addClass('fa-square-o');

            $('.ZapadlWyrokTak').parent().next().children().next().children(":first").removeClass('fa-check-square-o');
            $('.ZapadlWyrokTak').parent().next().children().next().children(":first").addClass('fa-square-o');
        }
    });

    // ODPOWIEDZIALNOŚĆ CYWILNA

    $(this).on('click', '.ZgloszonoPojazdZOc',function(){
        if($('.ZgloszonoPojazdZOcTak').hasClass('fa-square-o')){
            $('.ZgloszonoPojazdZOcTak').parent().next().children(":first").next().val(' ');
        }
    });

    $(this).on('click', '.ZgloszonoOsobeZOc',function(){
        if($('.ZgloszonoOsobeZOcTak').hasClass('fa-square-o')){
            $('.ZgloszonoOsobeZOcTak').parent().next().children(":first").next().val(' ');
        }
    });

    $(this).on('click', '.SzkodaOsobowa',function(){
        if($('.SzkodaOsobowaTak').hasClass('fa-square-o')){
            $('.SzkodaOsobowaTak').parent().next().children(":first").next().val(' ');
            $('.SzkodaOsobowaTak').parent().next().next().children(":first").next().next().next().children(":first").val(' ');

            $('.SzkodaOsobowaTak').parent().next().next().children(":first").children(":first").next().removeClass('fa-check-square-o');
            $('.SzkodaOsobowaTak').parent().next().next().children(":first").children(":first").next().addClass('fa-square-o');

            $('.SzkodaOsobowaTak').parent().next().next().children(":first").next().children(":first").removeClass('fa-check-square-o');
            $('.SzkodaOsobowaTak').parent().next().next().children(":first").next().children(":first").addClass('fa-square-o');

            $('.SzkodaOsobowaTak').parent().next().next().children(":first").next().next().children(":first").removeClass('fa-check-square-o');
            $('.SzkodaOsobowaTak').parent().next().next().children(":first").next().next().children(":first").addClass('fa-square-o');

            $('.SzkodaOsobowaTak').parent().next().next().children(":first").next().next().next().next().children(":first").removeClass('fa-check-square-o');
            $('.SzkodaOsobowaTak').parent().next().next().children(":first").next().next().next().next().children(":first").addClass('fa-square-o');
        }
    });

    // INNE ODSZKODOWANIA

    $(this).on('click', '.ZgloszonoZNnw',function(){
        if($('.ZgloszonoZNnwTak').hasClass('fa-square-o')){
            $('.ZgloszonoZNnwTak').parent().next().children(":first").next().val(' ');
        }
    });
    $(this).on('click', '.OkreslonoUszczerbekNnw',function(){
        if($('.OkreslonoUszczerbekNnwTak').hasClass('fa-square-o')){
            $('.OkreslonoUszczerbekNnwTak').parent().next().children(":first").next().val(' ');
        }
    });
    $(this).on('click', '.ZgloszonoSzkode',function(){
        if($('.ZgloszonoSzkodeTak').hasClass('fa-square-o')){
            $('.ZgloszonoSzkodeTak').parent().next().children(":first").children(":first").removeClass('fa-check-square-o');
            $('.ZgloszonoSzkodeTak').parent().next().children(":first").children(":first").addClass('fa-square-o');

            $('.ZgloszonoSzkodeTak').parent().next().children(":first").next().children(":first").removeClass('fa-check-square-o');
            $('.ZgloszonoSzkodeTak').parent().next().children(":first").next().children(":first").addClass('fa-square-o');

            $('.ZgloszonoSzkodeTak').parent().next().children(":first").next().next().children(":first").removeClass('fa-check-square-o');
            $('.ZgloszonoSzkodeTak').parent().next().children(":first").next().next().children(":first").addClass('fa-square-o');

            $('.ZgloszonoSzkodeTak').parent().next().children(":first").next().next().next().children(":first").val(' ');

            $('.ZgloszonoSzkodeTak').parent().next().children(":first").next().next().next().next().next().children(":first").val(' ');
        }
    });
    $(this).on('click', '.GdzieZgloszono1',function(){
        if($('.GdzieZgloszono1').hasClass('fa-check-square-o')){
            $('.GdzieZgloszonoInne').val(' ');
        }
    });
    $(this).on('click', '.GdzieZgloszono2',function(){
        if($('.GdzieZgloszono2').hasClass('fa-check-square-o')){
            $('.GdzieZgloszonoInne').val(' ');
        }
    });
    $(this).on('click', '.GdzieZgloszono3',function(){
        if($('.GdzieZgloszono3').hasClass('fa-square-o')){
            $('.GdzieZgloszonoInne').val(' ');
        }
    });
    $(this).on('click', '.PrzyznanoOdszkodowanie',function(){
        if($('.PrzyznanoOdszkodowanieTak').hasClass('fa-square-o')){
            $('.PrzyznanoOdszkodowanieTak').parent().children(":first").next().next().children(":first").val(' ');
        }
    });
    $(this).on('click', '.ZwolnienieLekarskie',function(){
        if($('.ZwolnienieLekarskieTak').hasClass('fa-square-o')){
            $('.ZwolnienieLekarskieTak').next().next().children(":first").val(' ');
            $('.ZwolnienieLekarskieTak').next().next().next().children(":first").val(' ');
        }
    });
    $(this).on('click', '.OrzeczenieONiezdolnosci',function(){
        if($('.OrzeczenieONiezdolnosciTak').hasClass('fa-square-o')){
            $('.OrzeczenieONiezdolnosciTak').parent().next().children(":first").children(":first").removeClass('fa-check-square-o');
            $('.OrzeczenieONiezdolnosciTak').parent().next().children(":first").children(":first").addClass('fa-square-o');

            $('.OrzeczenieONiezdolnosciTak').parent().next().children(":first").next().children(":first").removeClass('fa-check-square-o');
            $('.OrzeczenieONiezdolnosciTak').parent().next().children(":first").next().children(":first").addClass('fa-square-o');

            $('.OrzeczenieONiezdolnosciTak').parent().next().children(":first").next().next().children(":first").removeClass('fa-check-square-o');
            $('.OrzeczenieONiezdolnosciTak').parent().next().children(":first").next().next().children(":first").addClass('fa-square-o');

            $('.OrzeczenieONiezdolnosciTak').parent().next().children(":first").next().next().next().children(":first").removeClass('fa-check-square-o');
            $('.OrzeczenieONiezdolnosciTak').parent().next().children(":first").next().next().next().children(":first").addClass('fa-square-o');

            $('.OrzeczenieONiezdolnosciTak').parent().next().children(":first").next().next().next().next().children(":first").val(' ');
        }
    });
    $(this).on('click', '.TypNiezdolnosci1',function(){
        if($('.TypNiezdolnosci1').hasClass('fa-check-square-o')){
            $('.DataNiezdolnosciDo').val(' ');
        }
    });
    $(this).on('click', '.TypNiezdolnosci2',function(){
        if($('.TypNiezdolnosci2').hasClass('fa-check-square-o')){
            $('.DataNiezdolnosciDo').val(' ');
        }
    });
    $(this).on('click', '.TypNiezdolnosci3',function(){
        if($('.TypNiezdolnosci3').hasClass('fa-check-square-o')){
            $('.DataNiezdolnosciDo').val(' ');
        }
    });
    $(this).on('click', '.TypNiezdolnosci4',function(){
        if($('.TypNiezdolnosci4').hasClass('fa-square-o')){
            $('.DataNiezdolnosciDo').val(' ');
        }
    });

    $(this).on('click', '.UbezpieczycielNazwa1',function(){
        if($('.UbezpieczycielNazwa1').hasClass('fa-check-square-o')){
            $('.UbezpieczycielNazwaInne').val(' ');
        } else {
            $('.UbezpieczycielNazwa1').parent().parent().next().children().children(":first").removeClass('fa-check-square-o');
            $('.UbezpieczycielNazwa1').parent().parent().next().children().children(":first").addClass('fa-square-o');
            $('.UbezpieczycielNazwa1').parent().parent().next().children().next().children(":first").removeClass('fa-check-square-o');
            $('.UbezpieczycielNazwa1').parent().parent().next().children().next().children(":first").addClass('fa-square-o');
            $('.UbezpieczycielNazwa1').parent().parent().next().children().next().next().children(":first").val('');

            $('.UbezpieczycielNazwa1').parent().parent().next().next().next().children().val('');
            $('.UbezpieczycielNazwa1').parent().parent().next().next().next().next().children().val('');
        }
    });
    $(this).on('click', '.UbezpieczycielNazwa2',function(){
        if($('.UbezpieczycielNazwa2').hasClass('fa-check-square-o')){
            $('.UbezpieczycielNazwaInne').val(' ');
        } else {
            $('.UbezpieczycielNazwa2').parent().parent().next().children().children(":first").removeClass('fa-check-square-o');
            $('.UbezpieczycielNazwa1').parent().parent().next().children().children(":first").addClass('fa-square-o');
            $('.UbezpieczycielNazwa1').parent().parent().next().children().next().children(":first").removeClass('fa-check-square-o');
            $('.UbezpieczycielNazwa1').parent().parent().next().children().next().children(":first").addClass('fa-square-o');
            $('.UbezpieczycielNazwa1').parent().parent().next().children().next().next().children(":first").val(' ');

            $('.UbezpieczycielNazwa1').parent().parent().next().next().next().children().val(' ');
            $('.UbezpieczycielNazwa1').parent().parent().next().next().next().next().children().val(' ');
        }
    });
    $(this).on('click', '.UbezpieczycielNazwa3',function(){
        if($('.UbezpieczycielNazwa3').hasClass('fa-square-o')){
            $('.UbezpieczycielNazwaInne').val(' ');
            $('.UbezpieczycielNazwa3').parent().parent().next().children().children(":first").removeClass('fa-check-square-o');
            $('.UbezpieczycielNazwa1').parent().parent().next().children().children(":first").addClass('fa-square-o');
            $('.UbezpieczycielNazwa1').parent().parent().next().children().next().children(":first").removeClass('fa-check-square-o');
            $('.UbezpieczycielNazwa1').parent().parent().next().children().next().children(":first").addClass('fa-square-o');
            $('.UbezpieczycielNazwa1').parent().parent().next().children().next().next().children(":first").val(' ');

            $('.UbezpieczycielNazwa1').parent().parent().next().next().next().children().val(' ');
            $('.UbezpieczycielNazwa1').parent().parent().next().next().next().next().children().val(' ');
        }
    });

    //PRZEBIEG LECZENIA

    $(this).on('click', '.HospitalizacjaTak',function(){
        if($('.HospitalizacjaTak').hasClass('fa-square-o')){
            $('.szpitale_box').slideUp();
        } else {
            $('.szpitale_box').slideDown();
        }
    });

    $(this).on('click', '.ZabiegiTak',function(){
        if($('.ZabiegiTak').hasClass('fa-square-o')){
            $('.placowki_box').slideUp();
        } else {
            $('.placowki_box').slideDown();
        }
    });

    //Wyslij kopie do centralii
    $(this).on('click', '.wyslijKopieDoCentrali',function(){
        main_dane = {
            'element_id' : $(this).data('element_id')
            ,'nazwa_drogi' : $(this).data('nazwa_drogi')
        };

        drukiSystem.wyslijKopieDoCentrali(main_dane);
    });

	//Założenie sprawy w centrali 
    $(this).on('click', '.dodajSpraweDoCentrali',function(){
        main_dane = {
            'element_id' : $(this).data('element_id')
            ,'nazwa_drogi' : $(this).data('nazwa_drogi')
        };
        $.ajax({
            url : API_URL + 'contract/centralupdate/' + main_dane['element_id'],
            type: 'POST',
            data: {
                'api_key' : '1aa53f75-55c8-41a7-8554-25e094c71b47'
            },
            success : function(response) {
                $("#dodajspawe").html("Operacja udana");
            },
            error : function(response) {
                $("#dodajspawe").html("Błąd przesyłu");
            }
        })
    });





  $(this).on('submit', '#sendFilesToCentarl', function(e) {
    e.preventDefault();
    var xformData = new FormData($(this)[0]);
    var msg_error = 'Błąd przesyłu';
    var msg_timeout = 'Serwer timeout';
    var message = '';
    var form = $('#sendFilesToCentarl');


    $.ajax({
      data: xformData,
      async: false,
      cache: false,
      processData: false,
      contentType: false,
      url: API_URL + 'contract/upload/' + $('#upload_file').data('element_id'),
      type: 'post',
      success : function(response) {
        $("#sendFilesToCentarlMessage").html('Plik został przesłany').show().delay(3000).fadeOut();
        $("#sendFilesToCentarlInputFile").val('');
      },
      error : function(response) {
        $("#sendFilesToCentarlMessage").html('<b style="color: red;">Przy przesyłaniu wystąpił błąd. W razie dalszych problemów skontaktuj się z działem IT.</b>').show().delay(4000).fadeOut();
        $("#sendFilesToCentarlInputFile").val('');
      },
      timeout: 7000
    });
  });

















    $(this).on('click', '.zapiszOdpowiedzIPrzejdzDalej',function(){

        var pytanie = $(this).data('klasa_rodzic');

        $('.'+pytanie).addClass('ukryte');
        $('.'+pytanie).slideUp();

        $('.'+pytanie).addClass('ukryte');
        $('.'+pytanie).next().slideUp();
    });


    $(this).on('click', '.pytanie', function(){

        if ($(this).next().hasClass('ukryte')) {
            $(this).next().removeClass('ukryte');
            $(this).next().next().removeClass('ukryte');
            $(this).next().slideDown();
            $(this).next().next().slideDown();
        } else {
            $(this).next().addClass('ukryte');
            $(this).next().next().addClass('ukryte')
            $(this).next().slideUp();
            $(this).next().next().slideUp();
        }
    });

    $(this).on('click', '.inny_poszkodowany',function(){
        inputPole = $('.danePoszkodowany input');
        if($(this).hasClass('fa-square-o')){

            inputPole.attr('disabled', 'disabled');
            inputPole.val('');
            inputPole.removeClass('update wymagane');
            document.getElementsByClassName('inny_poszkodowany')[0].setAttribute("value", "0");
            $('.zmienPoszkodowanego').attr('data-akcja', 'przepisz_poszkodowanego');
            $('.zmienPoszkodowanego').data('akcja', 'przepisz_poszkodowanego');
        }else{
            inputPole.val('');
            inputPole.removeAttr('disabled');
            document.getElementsByClassName('inny_poszkodowany')[0].setAttribute("value", "1");
            $('.zmienPoszkodowanego').attr('data-akcja', 'dodaj_osobe');
            $('.zmienPoszkodowanego').data('akcja', 'dodaj_osobe');
        }
    });

    $(this).on('click', '.rachunek_klienta',function(){
        inputPole = $('.dane_odbiorcy input');
        if($(this).hasClass('fa-square-o')){
            inputPole.val('');
            inputPole.removeAttr('disabled');
            document.getElementsByClassName('rachunek_klienta')[0].setAttribute("value", "0");
        }else{
            inputPole.attr('disabled', 'disabled');
            inputPole.val('');
            inputPole.removeClass('update wymagane');
            document.getElementsByClassName('rachunek_klienta')[0].setAttribute("value", "1");
        }
    });
/*
    $(this).on('submit', '#my_for_d', function(e) {
        e.preventDefault();
        var xformData = new FormData($(this)[0]);
        var msg_error = 'Błąd przesyłu';
        var msg_timeout = 'Serwer timeout';
        var message = '';
        var form = $('#my_form_id');
        $.ajax({
            data: xformData,
            async: false,
            cache: false,
            processData: false,
            contentType: false,
            url: 'ajax/ajax_upload',
            type: 'post',
            error: function(xhr, status, error) {
                if (status==="timeout") {
                    alert(msg_timeout);
                } else {
                    alert(msg_error);
                }
            },
            success: function(response) {
                //alert(response);
                $("#my_for_d").html('Udało się');

            },
            timeout: 7000
        });
    });
*/
    $(this).on('click', '#autocomplete',function(){

        var jednostki = function () {
            var tmp = null;
            $.ajax({
                'async': false,
                'type': "POST",
                'global': false,
                'dataType': 'json',
                'url': "ajax/akcje/ajax_autocomplete.php",
                'success': function (data) {
                    //tmp = $.parseJSON(data);

                    tmp = data;
                }
            });
            return tmp;
        }();

        $( "#autocomplete" ).autocomplete({
            source: jednostki,
            minLength: 1,
            select: function(event, ui) {
                $('#autocomplete').val(ui.item.value);
                return false;
            },
            focus: function(event, ui) {
                $("#autocomplete").val(ui.item.value);
                return false;
            }
        } );
    } );

    $(this).on('click', '.typKlientaOpcja',function(){


        var opcja = $(".dpUstawOpcjeNazwa").attr("value");

        if(opcja == 1) {
            $('.NazwaFirmy').hide();
        } else {
            $('.NazwaFirmy').show();
        }
    });


});
