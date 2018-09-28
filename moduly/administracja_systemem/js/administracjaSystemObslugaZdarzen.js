var administracjaSystemMain = new AdministracjaSystemMain();

$(document).ready(function(){
    $(this).on('click','.edytujUzytkownika',function(){
        main_dane = {
            'element_id' : $(this).data('element_id')
            ,'tabela' : $(this).data('tabela')
            ,'akcja' : $(this).data('akcja')
        };

        mainPanel.szczegolyElementu(main_dane);
    });

    $(this).on('click','.edytujPowiadomienie',function(){
        main_dane = {
            'element_id' : $(this).parent().data('element_id')
            ,'tabela' : $(this).parent().data('tabela')
            ,'akcja' : $(this).parent().data('akcja')
        };

        mainPanel.szczegolyElementu(main_dane);
    });

    $(this).on('click','.edytujUzytkownikGrupy',function(){
        main_dane = {
            'element_id' : $(this).data('element_id')
            ,'tabela' : $(this).data('tabela')
            ,'akcja' : $(this).data('akcja')
        };

        mainPanel.szczegolyElementu(main_dane);
    });

    $(this).on('click','.usunPrzywrocElement',function(){
        main_dane = {
            '_element_id' : $(this).data('element_id')
            ,'_tabela' : $(this).data('tabela')
            ,'_reakcja' : $(this).data('reakcja')
        };

        administracjaSystemMain.usunPrzywrocElement(main_dane);
    });

    $(this).on('click','.zapiszZmianyAdministracja',function(){
        main_dane = {
            '_element_id' : $(this).data('element_id')
            ,'_tabela' : $(this).data('tabela')
            ,'_akcja' : $(this).data('akcja')
            ,'_rodzic' : $(this).data('klasa_rodzic')
        };

        administracjaSystemMain.zapiszZmianyAdministracja(main_dane);
    });

    $(this).on('click','.usunPrzywrocUzytkownika', function() {
        main_dane = {
            '_element_id' : $(this).data('element_id')
            ,'_reakcja' : $(this).data('reakcja')
            ,'_tabela' : $(this).data('tabela')

        };
        administracjaSystemMain.usunPrzywrocElement(main_dane);
    });

    $(this).on('click','.sms_add_tag',function(){
        //$(this).toggleClass('zaznaczonyFiltr');
        $('.sms_content')[0].value += ' *' + $(this).data('tag') + '/* ';
    });

    $(this).on('click','.wlaczWylaczSms', function() {
        var reakcja = ($(this).hasClass('zaznaczone')) ? 'wylacz' : 'wlacz' ;

        if(!$(this).hasClass('zaznaczone')){
            $(this).addClass('zaznaczone').removeClass('fa-square-o').addClass('fa-check-square-o');
        }else{
            $(this).removeClass('zaznaczone').removeClass('fa-check-square-o').addClass('fa-square-o');
        }

        main_dane = {
            '_element_id' : $(this).data('element_id')
            ,'_reakcja' : reakcja
            ,'_tabela' : 'dane_systemowe_sms'

        };
        administracjaSystemMain.wlaczWylaczSms(main_dane);
    });

    // $(this).on('change','.sms_content', function() {
    //     var reakcja = 'sms_update';
    //     var content = $(this).val();
    //
    //     main_dane = {
    //         '_element_id' : $(this).data('element_id')
    //         ,'_reakcja' : reakcja
    //         ,'_tabela' : 'dane_systemowe_sms'
    //         ,'_tresc' : content
    //
    //     };
    //     administracjaSystemMain.updateSms(main_dane);
    // });

    $(this).on('click','#save_sms', function() {
        var reakcja = 'sms_update';
        var content = $('.sms_content').val();
        main_dane = {
            '_element_id' : $('.sms_content').data('element_id')
            ,'_reakcja' : reakcja
            ,'_tabela' : 'dane_systemowe_sms'
            ,'_tresc' : content

        };
        administracjaSystemMain.updateSms(main_dane);
    });

    $(this).on('click','.usunDodajUprawnienieUzytkownika', function() {
        var reakcja = ($(this).hasClass('zaznaczone')) ? 'usun' : 'dodaj' ;

        if(!$(this).hasClass('zaznaczone')){
            $(this).addClass('zaznaczone').removeClass('fa-square-o').addClass('fa-check-square-o');
        }else{
            $(this).removeClass('zaznaczone').removeClass('fa-check-square-o').addClass('fa-square-o');
        }

        main_dane = {
            '_element_id' : $(this).data('element_id') 
            ,'_reakcja' : reakcja
            ,'_tabela' : 'uzytkownik_uprawnienie'

        };
        administracjaSystemMain.usunDodajUprawnienieUzytkownika(main_dane);
    });



    $(this).on('click','.usunDodajUprawnienieGrupy', function() {
        var reakcja = ($(this).hasClass('zaznaczone')) ? 'usun' : 'dodaj' ;

        if(!$(this).hasClass('zaznaczone')){
            $(this).addClass('zaznaczone').removeClass('fa-square-o').addClass('fa-check-square-o');
        }else{
            $(this).removeClass('zaznaczone').removeClass('fa-check-square-o').addClass('fa-square-o');
        }

        main_dane = {
            '_element_id' : $(this).data('element_id')
            ,'_reakcja' : reakcja
            ,'_tabela' : 'uzytkownik_grupy_uprawnienie'

        };
        administracjaSystemMain.usunDodajUprawnienieGrupy(main_dane);
    });

    $(this).on('click','#uzytkownikUprawnienia .panel-heading',function(){
        if($(this).parent().hasClass('aktywnyPanelUprawnienie')){
            $(this).parent().removeClass('aktywnyPanelUprawnienie');
            $(this).next('div').slideUp();
        }else{
            $('.aktywnyPanelUprawnienie').removeClass('aktywnyPanelUprawnienie');
            $('#uzytkownikUprawnienia .panel-body').slideUp();

            $(this).parent().addClass('aktywnyPanelUprawnienie');
            $(this).next('div').slideDown();
        }
    });

    $(this).on('click','.usunAvatarUzytkownika', function() {
        if($('#uzytkownikAvatarPodglad img').attr('src') == '/img/avatar/domyslny.png'){
            powiadomienieBoczne('blad', '', 'Nie wykryto zmian!!!');
            return;
        }
        main_dane = {
            '_element_id' : $(this).data('element_id')
            ,'_tabela' : 'uzytkownik'

        };
        administracjaSystemMain.usunAvatarUzytkownika(main_dane);
    });

    $(this).on('change', '#uzytkownikAvatarPrzyciskGrupaUpload input',function(){

        var file = this.files[0];
        if ( /^image/.test( file.type ) ) {
            var reader = new FileReader();
            reader.readAsDataURL( file );
            reader.onloadend = function(){
                $('#uzytkownikAvatarPodglad img').attr('src',this.result);
                $('.uzytkownikZapiszAvatar').show();
            }
        }else{
            alert('Wybierz obraz!!!');
        }
    });

    $(this).on('click','.uzytkownikZapiszAvatar', function() {
        main_dane = {
            '_element_id' : $(this).data('element_id')
            ,'_tabela' : 'uzytkownik'

        };
        administracjaSystemMain.uzytkownikZapiszAvatar(main_dane);
    });

    $(this).on('click','.wyswietlSzczegolyHistoriaRejestracji', function() {
        var szczegoly = $(this).find('.wyswietlSzczegolyHistoriaRejestracjiElement').html();
        $('#szczegolyElementu').html(szczegoly);
    });

    $(this).on('click','.wymusWylogowanieUzytkownika',function(){
        administracjaSystemMain.wymusWylogowanieUzytkownika($(this).data('element_id'));
    });

    $(this).on('click','.powiadomienieAktywne',function(){
        if($(this).hasClass('zaznaczone')){
            $(this).addClass('fa-square-o').removeClass('zaznaczone').removeClass('fa-check-square-o');
            $(this).attr('value', '0');
        }else{
            $(this).addClass('zaznaczone').addClass('fa-check-square-o').removeClass('fa-square-o');
            $(this).attr('value', '1');
        }
    });

    $(this).on('click','.powiadomieniePoZalogowaniu',function(){
        if($(this).hasClass('zaznaczone')){
            $(this).addClass('fa-square-o').removeClass('zaznaczone').removeClass('fa-check-square-o');
            $(this).attr('value', '0');
        }else{
            $(this).addClass('zaznaczone').addClass('fa-check-square-o').removeClass('fa-square-o');
            $(this).attr('value', '1');
        }
    });

    $(this).on('click','.dpuoPowiadomienie',function(){
        if($(this).data('element_id') == 1){
            $('.powiadomienieDaneNowe .ilosc_wyswietlen').removeAttr('disabled');
            $('.poZalogowaniu').show();
        }else{
            $('.powiadomienieDaneNowe .ilosc_wyswietlen').attr('disabled','disabled');
            $(this).attr('value', '0');
            $('.poZalogowaniu').hide();
        }
    });

    $(this).on('click','.dpuoPowiadomienieSz',function(){
        if($(this).data('element_id') == 1){
            $('.powiadomienieDane .ilosc_wyswietlen').removeAttr('disabled');
            $('.poZalogowaniuSz').show();
        }else{
            $('.powiadomienieDane .ilosc_wyswietlen').attr('disabled','disabled');
            $('.poZalogowaniuSz').hide();
        }
    });

    $(this).on('click','.uzytkownikPrzejmijSesje', function() {
        administracjaSystemMain.uzytkownikPrzejmijSesje($(this).data('element_id'));
    });

    $(this).on('click','.histroiaRejestracjiFiltruj', function() {
        administracjaSystemMain.histroiaRejestracjiFiltruj();
    });

    $(this).on('keyup','.histroiaRejestracjiFiltrujEnter', function(e) {
        if(e.keyCode === 13){
            administracjaSystemMain.histroiaRejestracjiFiltruj();
        }
    });

    $(this).on('click','.listaUzytkownikowFiltruj', function() {
        administracjaSystemMain.listaUzytkownikowFiltruj();
    });

    $(this).on('keyup','.listaUzytkownikowFiltrujEnter', function(e) {
        if(e.keyCode === 13){
            administracjaSystemMain.listaUzytkownikowFiltruj();
        }
    });

    $(this).on('click','.histroiaLogowanFiltruj', function() {
        administracjaSystemMain.histroiaLogowanFiltruj();
    });

    $(this).on('keyup','.histroiaLogowanFiltrujEnter', function(e) {
        if(e.keyCode === 13){
            administracjaSystemMain.histroiaLogowanFiltruj();
        }
    });

    $(this).on('click','.edytujUprawnienieGrupa',function(){
        main_dane = {
            'element_id' : $(this).data('element_id')
            ,'tabela' : 'uprawnienia_grupy'
            ,'akcja' : 'edytuj_uprawnienie_grupa'
        };

        mainPanel.szczegolyElementu(main_dane);
    });

    $(this).on('click','.edytujUprawnienieGrupy', function() {
        mainPanel.wczytajDaneDoPopUp($(this).data('element_id'),'wyswietl_edytuj_uprawnienie_grupy','uprawnienia','modal-lgsm','wczytaj_dane');
    });

    $(this).on('click','.zapiszZmianyUprawnieniaGrupyZU',function(){
        main_dane = {
            '_element_id' : $(this).data('element_id')
            ,'_tabela' : $(this).data('tabela')
            ,'_akcja' : $(this).data('akcja')
            ,'_rodzic' : $(this).data('rodzic')
        };

        administracjaSystemMain.zapiszZmianyUprawnieniaGrupyZU(main_dane);
    });

    $(this).on('click','.zapiszZmianyUprawnieniaGrupyPojedyncze',function(){
        main_dane = {
            '_element_id' : $(this).data('element_id')
            ,'_rodzic' : $(this).data('rodzic')
        };

        administracjaSystemMain.zapiszZmianyUprawnieniaGrupyPojedyncze(main_dane);
    });

});