var konkursy = new Konkursy();

/*http://stackoverflow.com/questions/19305821/multiple-modals-overlay*/
 $(document).on('show.bs.modal', '.modal', function (event) {
 var zIndex = 1040 + (10 * $('.modal:visible').length);
 $(this).css('z-index', zIndex);
 setTimeout(function() {
 $('.modal-backdrop').not('.modal-stack').css('z-index', zIndex - 1).addClass('modal-stack');
 }, 0);
 });

$(document).ready(function() {
    $('.rankingiPrzedstawicieli .nav li').first().addClass('active');
    $('.rankingiPrzedstawicieli .tab-content .tab-pane').first().addClass('active');

    $(this).on('click','#zakladka_rankingi',function(){
        $('.rankingiPrzedstawicieli .nav li').first().addClass('active');
        $('.rankingiPrzedstawicieli .tab-content .tab-pane').first().addClass('active');
    });

    $(this).on('click','.wyswietlKonkurs',function(){
        mainPanel.wyswietlLoader('body');
        mainPanel.wczytajDaneDoPopUp($(this).parent().data('element_id'), 'wyswietl_konkurs', 'konkurs', 'modal-lg', 'wczytaj_dane');
        mainPanel.ukryjLoader();
    });

    $(this).on('click','.edytujkonkurs',function(){
        mainPanel.wyswietlLoader('body');
        mainPanel.wczytajDaneDoPopUp($(this).parent().parent().data('element_id'), 'edytuj_konkurs', 'konkurs', 'modal-lg', 'wczytaj_dane');
        mainPanel.ukryjLoader();
    });

    $(this).on('click','.usunPrzywrocElement',function(){
        if($(this).hasClass('usunDokument') || $(this).hasClass('usunDodatkoweZdjecie')){
            $(this).parent().parent().parent().parent().addClass('deleteHighlight').slideUp(500, function() {
                $(this).remove();
            });
        }
        mainDane = {
            '_element_id' : $(this).data('element_id')
            ,'_tabela' : $(this).data('tabela')
            ,'_reakcja' : $(this).data('reakcja')
        };

        mainPanel.usunPrzywrocElement(mainDane);
    });

    $(this).on('click','.edytujDokument',function(){
        mainPanel.wyswietlLoader('#PopUpTresc');
        mainPanel.wczytajDaneDoPopUp($(this).data('element_id'), 'edytuj_dokument', 'konkurs_dokument', 'modal-lgsm', 'wczytaj_dane', true);

    });

    $(this).on('click','.dodajDokument',function(){
        mainPanel.wczytajDaneDoPopUp('', 'dodaj_dokument', 'konkurs_dokument', 'modal-sm', 'wczytaj_dane', true);
    });

    $(this).on('click','.ZapiszDodajDokument',function(){
        konkursy.zapiszNowyDokument($('.konkursDane').data('element_id'),'zapisz_nowy_dokument',$('.konkursDane').data('element_id'));
    });

    $(this).on('click','.ZapiszZmianyDokument',function(){
        konkursy.ZapiszZmianyDokument($('.konkursDokumentSzczegoly').data('element_id'),'zapisz_zmiany_dokument',$('.konkursDane').data('element_id'));
    });

    $(this).on('click','.konkursDodajUprawnienieGrupy',function(){
        var reakcja;
        if($(this).hasClass('fa-check-square-o')){
            $(this).removeClass('fa-check-square-o').addClass('fa-square-o');
            reakcja = 'usun';
        }else{
            $(this).removeClass('fa-square-o').addClass('fa-check-square-o');
            reakcja = 'dodaj';
        }
        konkursy.dodajUsunUprawnienieGrupy('dodaj_usun_uprawnienie_grupy', reakcja, $('.konkursDane').data('element_id'), $(this).data('element_id'));
    });

    $(this).on('click','.konkursDokumentDodajUprawnienieGrupy',function(){
        var reakcja;
        if($(this).hasClass('fa-check-square-o')){
            $(this).removeClass('fa-check-square-o').addClass('fa-square-o');
            reakcja = 'usun';
        }else{
            $(this).removeClass('fa-square-o').addClass('fa-check-square-o');
            reakcja = 'dodaj';
        }
        konkursy.dodajUsunUprawnienieGrupy('dodaj_usun_uprawnienie_dokument_grupy', reakcja, $('.konkursDokumentSzczegoly').data('element_id'), $(this).data('element_id'));
    });

    $(this).on('click','.konkursGrafikaDodajUprawnienieGrupy',function(){
        var reakcja;
        if($(this).hasClass('fa-check-square-o')){
            $(this).removeClass('fa-check-square-o').addClass('fa-square-o');
            reakcja = 'usun';
        }else{
            $(this).removeClass('fa-square-o').addClass('fa-check-square-o');
            reakcja = 'dodaj';
        }
        konkursy.dodajUsunUprawnienieGrupy('dodaj_usun_uprawnienie_grafika_grupy', reakcja, $('.konkursGrafikaSzczegoly').data('element_id'), $(this).data('element_id'));
    });

    $(this).on('click','.dodajUsunUprawnienieUzytkownik',function(){
        if($(this).hasClass('usunTak')){
            $(this).parent().parent().parent().parent().addClass('deleteHighlight').slideUp(500, function() {
                $(this).remove();
            });
        }
        if($(this).hasClass('dodajUprawnienieKonkurs')){
            $(this).parent().parent().addClass('deleteHighlight').slideUp(500, function() {
                $(this).remove();
            });
        }
        mainDane = {
            '_element_id' : $('.konkursDane').data('element_id')
            ,'_tabela' : $(this).data('tabela')
            ,'_reakcja' : $(this).data('reakcja')
            ,'_uzytkownik_id' : $(this).data('element_id')
        };

        konkursy.dodajUsunUprawnienieUzytkownik(mainDane);
    });

    $(this).on('click','.dodajUsunUprawnienieDokumentUzytkownik',function(){
        if($(this).hasClass('usunTak')){
            $(this).parent().parent().parent().parent().addClass('deleteHighlight').slideUp(500, function() {
                $(this).remove();
            });
        }
        if($(this).hasClass('dodajUprawnienieKonkursDokument')){
            $(this).parent().parent().addClass('deleteHighlight').slideUp(500, function() {
                $(this).remove();
            });
        }
        mainDane = {
            '_element_id' : $('.konkursDokumentSzczegoly').data('element_id')
            ,'_tabela' : $(this).data('tabela')
            ,'_reakcja' : $(this).data('reakcja')
            ,'_uzytkownik_id' : $(this).data('element_id')
        };

        konkursy.dodajUsunUprawnienieDokumentUzytkownik(mainDane);
    });

    $(this).on('click','.widokDodajUprawnienieUzytkownik',function(){
        mainPanel.wczytajDaneDoPopUp($('.konkursDane').data('element_id'), 'wyswietl_dodaj_uprawnienie_uzytkownik', 'konkurs_uzytkownik', 'modal-lgsm', 'wczytaj_dane', true);

        $('#popUpTresc2 .panel:last-child').removeClass('margin_b_10').addClass('margin_b_0');
    });

    $(this).on('click','.widokDodajUprawnienieKonkursDokumentUzytkownik',function(){
        mainPanel.wczytajDaneDoPopUp($('.konkursDokumentSzczegoly').data('element_id'), 'wyswietl_dodaj_uprawnienie_uzytkownik', 'konkurs_dokumenty_id_uzytkownik_id', 'modal-lgsm', 'wczytaj_dane', false, true);

        $('#popUpTresc3 .panel:last-child').removeClass('margin_b_10').addClass('margin_b_0');
    });

    $(this).on('click','.konkursZapiszZmiany',function(){
        konkursy.ZapiszZmianyKonkurs($('.konkursDane').data('element_id'));
    });

    $(this).on('change', '.przyciskUploadGrupaUpload input',function(){
        var rodzicKlasa = $(this).parent().data('rodzic_klasa');
        $(this).addClass('aktualizuj');

        przyciskUploadPlik = this.files[0];
        przyciskUpload = $(this);

        if ( /^image/.test( przyciskUploadPlik.type ) ) {
            var reader = new FileReader();
            reader.readAsDataURL( przyciskUploadPlik );
            reader.onloadend = function(){
                $('.'+rodzicKlasa).html('<img class="width_100 height_auto" src="'+this.result+'" />');
                //$('.'+rodzicKlasa).find('img').attr('src',this.result);
            }
        }else{
            alert('Wybierz obraz!!!');
        }
    });

    $(this).on('click','.dodaj_konkurs',function(){
        mainPanel.wczytajDaneDoPopUp('', 'dodaj_konkurs', 'konkurs', 'modal-lg', 'wczytaj_dane');
    });

    $(this).on('click','.konkursDodajNowy',function(){
        konkursy.konkursDodajNowy();
    });

    $(this).on('click','.wyswietlRanking',function(){
        konkursy.wyswietlRanking($(this).data('grupa'), $(this).data('klasa_rodzic'));
    });

    $(this).on('click','.dodaj_dodatkowa_grafike',function(){
        mainPanel.wczytajDaneDoPopUp($('.konkursDane').data('element_id'), 'wswietl_dodaj_grafike', 'konkurs_grafiki', 'modal-lgsm', 'wczytaj_dane', true);
    });

    $(this).on('click','.konkursZapiszDodatkowaGrafike',function(){
        mainDane = {
            '_element_id' : $(this).data('element_id')
            ,'_tabela' : $(this).data('tabela')
            ,'_nazwa' : $('.konkursDodatkoweZdjecieNazwa').val()
        };
        konkursy.konkursZapiszDodatkowaGrafike(mainDane);
    });

    $(this).on('click','.edytujDodatkowaGrafike',function(){
        mainPanel.wyswietlLoader('#popUpTresc');
        mainPanel.wczytajDaneDoPopUp($(this).data('element_id'), 'wswietl_edytuj_grafike', 'konkurs_grafiki', 'modal-lgsm', 'wczytaj_dane', true);
        mainPanel.ukryjLoader();
    });

    $(this).on('click','.konkursZapiszZmianyDodatkowaGrafike',function(){
        konkursy.konkursZapiszZmianyDodatkowaGrafike($(this).data('element_id'));
    });

    $(this).on('click','.usunPelneZdjecieKosz',function(){
        $('.konkursPelneZdjecieUpload input').addClass('usunPelneZdjecie');
        $('.konkursPelneZdjecie').html('');
    });

    $(this).on('click','.PrzelaczMiniature',function(){
        $('.konkursZdjecieGlowne img').attr('src',$(this).attr('src'));

    });

});
