function Konkursy(){
    var _liczbaKonkursow;
    var _listaKonkursow;

    this.rozdzielNaKolumny = function(){
       /* var konkursElement = $('.konkurs');
        var kolumnaNumer = 0;
        _liczbaKonkursow = konkursElement.size();

        for(var i=0;i<_liczbaKonkursow;i++){
            kolumnaNumer = kolumnaNumer + 1;
            if(kolumnaNumer === 5){
                kolumnaNumer = 1;
            }
            $('#'+(konkursElement[i].getAttribute('id'))).appendTo('.kolumna_'+(kolumnaNumer));
        }*/
    };

    this.zapiszNowyDokument = function(_element_id, _akcja, _konkurs_id){
        mainDane = mainPanel.zbierzDaneZFormularza('konkursDokumentSzczegoly');

        if(!mainDane){
            return;
        }

        formData = new FormData;
            formData.append( 'akcja', _akcja);
            formData.append( 'dane', JSON.stringify(mainDane));
            formData.append( 'element_id', _element_id);

        przyciskUpload = $('#przyciskUploadGrupaUpload input');

        if(przyciskUpload.val() !== ''){
            formData.append('plik', przyciskUpload[0].files[0]);
        }else{

                mainPanel.wyswietlPowiadomienieBootsrtap('danger', '.konkursDokumentSzczegoly', 'Dodaj plik!!!');
                mainPanel.animateCss('animuj','shake');
                return;
        }

        mainPanel.wyswietlLoader('#popUpTresc2');

        mainPanel.zaladujTrescAjax('ajax/akcje/ajax_aktualizuj_dane', formData);
        odpowiedzAjax = $.parseJSON(mainPanel.zawartoscTrescAjax());

        mainPanel.wyswietlPowiadomienieBoczne(odpowiedzAjax['rodzaj'],'',odpowiedzAjax['komunikat']);

        if(odpowiedzAjax['ukryjPopUp2'] === 1){
            $('#popUp2').modal('hide');
        }

        if(odpowiedzAjax['przeladujPopUp'] === 1){
            mainPanel.przeladujZawartoscPopUp(_konkurs_id, 'edytuj_konkurs', 'konkurs', '');

            $('.konkursDane .active').removeClass('active');
            $('.'+odpowiedzAjax['przeladujPopUpZakladka']).addClass('active');
        }

        if(odpowiedzAjax['przeladujPopUp2'] === 1){
            mainPanel.przeladujZawartoscPopUp(_element_id, 'edytuj_dokument', 'konkurs_dokumenty', '2');

            $('.konkursDane .active').removeClass('active');
            $('.'+odpowiedzAjax['przeladujPopUpZakladka']).addClass('active');
        }
    };

    this.ZapiszZmianyDokument = function(_element_id, _akcja, _konkurs_id){

        mainPanel.sprawdzWartosciPrm('konkursDokumentOgolne');

        var polePrm = $('.konkursDokumentSzczegoly .prm');
        var liczbaPrm = polePrm.size();

        if(liczbaPrm === 0){
            if(!$('#przyciskUploadGrupaUpload input').hasClass('aktualizuj')){
                powiadomienieBoczne('blad','','Nie wykryto zmian!!!');
                return;
            }
        }

        mainDane = mainPanel.zbierzDaneZFormularza('konkursDokumentSzczegoly');

        if(!mainDane){
            return;
        }

        formData = new FormData;
            formData.append( 'akcja', 'zapisz_zmiany_dokument');
            formData.append( 'dane', JSON.stringify(mainDane));
            formData.append( 'element_id', _element_id);

        przyciskUpload = $('#przyciskUploadGrupaUpload input');


        if(przyciskUpload.val() !== ''){
            formData.append('plik', przyciskUpload[0].files[0]);
        }

        mainPanel.wyswietlLoader('#popUpTresc2');

        mainPanel.zaladujTrescAjax('ajax/akcje/ajax_aktualizuj_dane', formData);
        odpowiedzAjax = $.parseJSON(mainPanel.zawartoscTrescAjax());

        mainPanel.wyswietlPowiadomienieBoczne(odpowiedzAjax['rodzaj'],'',odpowiedzAjax['komunikat']);

        if(odpowiedzAjax['ukryjPopUp2'] === 1){
            $('#popUp2').modal('hide');
        }

        if(odpowiedzAjax['przeladujPopUp'] === 1){
            mainPanel.przeladujZawartoscPopUp(_konkurs_id, 'edytuj_konkurs', 'konkurs', '');

            $('.konkursDane .active').removeClass('active');
            $('.'+odpowiedzAjax['przeladujPopUpZakladka']).addClass('active');
        }

        if(odpowiedzAjax['przeladujPopUp2'] === 1){
            mainPanel.przeladujZawartoscPopUp(_element_id, 'edytuj_dokument', 'konkurs_dokumenty', '2');

            $('.konkursDane .active').removeClass('active');
            $('.'+odpowiedzAjax['przeladujPopUpZakladka']).addClass('active');
        }

    };

    this.dodajUsunUprawnienieGrupy = function(_akcja, _reakcja, _element_id, _grupa_id){
        formData = new FormData;
            formData.append( 'akcja', _akcja);
            formData.append( 'reakcja', _reakcja);
            formData.append( 'element_id', _element_id);
            formData.append( 'uzytkownik_grupa_id', _grupa_id);

        mainPanel.zaladujTrescAjax('ajax/akcje/ajax_aktualizuj_dane', formData);
        odpowiedzAjax = $.parseJSON(mainPanel.zawartoscTrescAjax());

        mainPanel.wyswietlPowiadomienieBoczne(odpowiedzAjax['rodzaj'],'',odpowiedzAjax['komunikat']);
    };

    this.dodajUsunUprawnienieUzytkownik = function(_dane){
        formData = new FormData;
            formData.append( 'akcja', 'dodaj_usun_uprawnienie_uzytkownika');
            formData.append( 'reakcja', _dane['_reakcja']);
            formData.append( 'element_id', _dane['_element_id']);
            formData.append( 'uzytkownik_id', _dane['_uzytkownik_id']);

        mainPanel.zaladujTrescAjax('ajax/akcje/ajax_aktualizuj_dane', formData);
        odpowiedzAjax = $.parseJSON(mainPanel.zawartoscTrescAjax());

        mainPanel.wyswietlPowiadomienieBoczne(odpowiedzAjax['rodzaj'],'',odpowiedzAjax['komunikat']);

        if(odpowiedzAjax['przeladujPopUp'] === 1){
            mainPanel.przeladujZawartoscPopUp(_dane['_element_id'], 'edytuj_konkurs', 'konkurs', '');

            $('.konkursDane .active').removeClass('active');
            $('.'+odpowiedzAjax['przeladujPopUpZakladka']).addClass('active');
        }


    };

    this.dodajUsunUprawnienieDokumentUzytkownik = function(_dane){
        formData = new FormData;
            formData.append( 'akcja', 'dodaj_usun_uprawnienie_dokument_uzytkownika');
            formData.append( 'reakcja', _dane['_reakcja']);
            formData.append( 'element_id', _dane['_element_id']);
            formData.append( 'uzytkownik_id', _dane['_uzytkownik_id']);

        mainPanel.zaladujTrescAjax('ajax/akcje/ajax_aktualizuj_dane', formData);
        odpowiedzAjax = $.parseJSON(mainPanel.zawartoscTrescAjax());

        mainPanel.wyswietlPowiadomienieBoczne(odpowiedzAjax['rodzaj'],'',odpowiedzAjax['komunikat']);

        if(odpowiedzAjax['przeladujPopUp'] === 1){
            mainPanel.przeladujZawartoscPopUp(_dane['_element_id'], 'edytuj_konkurs', 'konkurs', '');

            $('.konkursDokumentSzczegoly .active').removeClass('active');
            $('.'+odpowiedzAjax['przeladujPopUpZakladka']).addClass('active');
        }
    };

    this.ZapiszZmianyKonkurs = function(_element_id){
        mainDane = mainPanel.zbierzDaneZFormularza('konkursOgolneDane');

        if(!mainDane){
            mainPanel.animateCss('animujModal1','shake');
            return;
        }

        formData = new FormData;
            formData.append( 'akcja', 'zapisz_zmiany_konkurs');
            formData.append( 'dane', JSON.stringify(mainDane));
            formData.append( 'element_id', _element_id);

        var miniaturaPole = $('.konkursMiniaturaUpload input');
        var pelneZdjeciePole = $('.konkursPelneZdjecieUpload input');

        if(miniaturaPole[0].files[0] !== undefined){
            formData.append('miniatura', miniaturaPole[0].files[0]);
        }else{
            if(miniaturaPole.hasClass('aktualizuj')){
                mainPanel.wyswietlPowiadomienieBootsrtap('danger', '.konkursOgolneDane', 'Dodaj miniature!!!');
                mainPanel.animateCss('animujModal1','shake');
                return;
            }
        }

        if(pelneZdjeciePole[0].files[0] !== undefined){
            formData.append('pelneZdjecie', pelneZdjeciePole[0].files[0]);
        }

        if(pelneZdjeciePole.hasClass('usunPelneZdjecie')){
            formData.append( 'usunPelneZdjecie', true);
        }

        mainPanel.wyswietlLoader('#popUpTresc');

        mainPanel.zaladujTrescAjax('ajax/akcje/ajax_aktualizuj_dane', formData);
        odpowiedzAjax = $.parseJSON(mainPanel.zawartoscTrescAjax());

        mainPanel.wyswietlPowiadomienieBoczne(odpowiedzAjax['rodzaj'],'',odpowiedzAjax['komunikat']);

        mainPanel.ukryjLoader();

        if(odpowiedzAjax['przeladujWidok'] === 1){
            mainPanel.aktywujZakladke('zakladka_lista_konkursow');
        }
    };

    this.konkursDodajNowy = function(_element_id){
        mainDane = mainPanel.zbierzDaneZFormularza('konkursOgolneDane');

        if(!mainDane){
            mainPanel.animateCss('animujModal1','shake');
            return;
        }

        formData = new FormData;
            formData.append( 'akcja', 'dodaj_konkurs');
            formData.append( 'dane', JSON.stringify(mainDane));

        var miniaturaPole = $('.konkursMiniaturaUpload input');
        var pelneZdjeciePole = $('.konkursPelneZdjecieUpload input');

        if(miniaturaPole[0].files[0] !== undefined){
            formData.append('miniatura', miniaturaPole[0].files[0]);
        }else{
                mainPanel.wyswietlPowiadomienieBootsrtap('danger', '.konkursOgolneDane', 'Dodaj miniature!!!');
                mainPanel.animateCss('animujModal1','shake');
                return;

        }

        if(pelneZdjeciePole[0].files[0] !== undefined){
            formData.append('pelneZdjecie', pelneZdjeciePole[0].files[0]);
        }

        mainPanel.wyswietlLoader('#popUpTresc');

        mainPanel.zaladujTrescAjax('ajax/akcje/ajax_aktualizuj_dane', formData);
        odpowiedzAjax = $.parseJSON(mainPanel.zawartoscTrescAjax());

        mainPanel.wyswietlPowiadomienieBoczne(odpowiedzAjax['rodzaj'],'',odpowiedzAjax['komunikat']);

        $('#PopUp.modal').modal('hide');

        if(odpowiedzAjax['przeladujWidok'] === 1){
            mainPanel.aktywujZakladke('zakladka_lista_konkursow');
        }
    };

    this.wyswietlRanking = function(_grupa, _klasa_rodzic){

        var dataPoczatek = $('.'+_klasa_rodzic+' .dataPoczatek');
        var dataKoniec = $('.'+_klasa_rodzic+' .dataKoniec');

        if(dataPoczatek.val() === dataPoczatek.data('wartosc_domyslna')
            && dataKoniec.val() === dataKoniec.data('wartosc_domyslna')
        ){
            mainPanel.wyswietlPowiadomienieBootsrtap('danger', '.'+_klasa_rodzic, 'Wybierz inny zakres!!!');
            return;
        }
        if(dataPoczatek.val().trim() === dataKoniec.val().trim()){
            mainPanel.wyswietlPowiadomienieBootsrtap('danger', '.'+_klasa_rodzic, 'Daty muszą być różne!!!');
            return;
        }

        mainDane = mainPanel.zbierzDaneZFormularza(_klasa_rodzic);

        if(!mainDane){
            return;
        }

        dataPoczatek = new Date(dataPoczatek.val());
        dataKoniec = new Date(dataKoniec.val());

        if((dataPoczatek - dataKoniec) > 0){
            mainPanel.wyswietlPowiadomienieBootsrtap('danger', '.'+_klasa_rodzic, 'Wybierz poprawny zakres dat!!!');
            return;
        }

        formData = new FormData;
            formData.append( 'akcja', 'wyswietl_ranking');
            formData.append( 'grupa', _grupa);
            formData.append( 'rodzic', _klasa_rodzic);
            formData.append( 'dane', JSON.stringify(mainDane));

        mainPanel.wyswietlLoader('.rankingiPrzedstawicieli');
        mainPanel.zaladujTrescAjax('ajax/akcje/ajax_wczytaj_dane', formData);
        odpowiedzAjax = $.parseJSON(mainPanel.zawartoscTrescAjax());

        $('.'+_klasa_rodzic).html(odpowiedzAjax['tresc']);

        mainPanel.aktywujKontrolkiBootstrapowe();

        mainPanel.ukryjLoader();
    };

    this.konkursZapiszDodatkowaGrafike = function(_dane){

        if(_dane['_nazwa'].length === 0){
            mainPanel.wyswietlPowiadomienieBootsrtap('danger', '.panelDodatkoweZdjecie', 'Wprowadź nazwe!!!');
            mainPanel.animateCss('animuj.modal-lgsm','shake');
            return;
        }

        inputPole = $('.konkursDodatkoweZdjecieUpload input')[0].files[0];

        if(inputPole === undefined){
            mainPanel.wyswietlPowiadomienieBootsrtap('danger', '.panelDodatkoweZdjecie', 'Wybierz zdjęcie!!!');
            mainPanel.animateCss('animuj.modal-lgsm','shake');
            return;
        }

        formData = new FormData;
            formData.append('akcja', 'dodaj_dodatkowa_grafike');
            formData.append('element_id', _dane['_element_id']);
            formData.append('tabela', _dane['_tabela']);
            formData.append('dodatkowaGrafika', inputPole);
            formData.append('nazwa', _dane['_nazwa']);

        mainPanel.wyswietlLoader('#popUpTresc2');

        mainPanel.zaladujTrescAjax('ajax/akcje/ajax_aktualizuj_dane', formData);
        odpowiedzAjax = $.parseJSON(mainPanel.zawartoscTrescAjax());

        mainPanel.wyswietlPowiadomienieBoczne(odpowiedzAjax['rodzaj'],'',odpowiedzAjax['komunikat']);

        $('#PopUp2.modal').modal('hide');

        document.getElementById('konkursListaDodatkowychGrafik').innerHTML = odpowiedzAjax['przeladujPopUpZakladka'];
        mainPanel.ukryjLoader();
    };

    this.konkursZapiszZmianyDodatkowaGrafike = function(_element_id){
        var konkursDodatkoweZdjecieNazwa = $('.konkursDodatkoweZdjecieNazwa');

        inputPole = $('.konkursDodatkoweZdjecieUpload input')[0].files[0];

        if(konkursDodatkoweZdjecieNazwa.val() === konkursDodatkoweZdjecieNazwa.data('wartosc_domyslna')){
            if(!$('.konkursDodatkoweZdjecieUpload input').hasClass('aktualizuj')){
                mainPanel.wyswietlPowiadomienieBoczne('blad','','Nie wykryto zmian!!!');
                return;
            }

        }

        if(konkursDodatkoweZdjecieNazwa.val().length === 0){
            mainPanel.wyswietlPowiadomienieBoczne('blad','','Wprowadź nazwe!!!');
            return;
        }

        formData = new FormData;
            formData.append('akcja', 'zapisz_zmiany_dodatkowa_grafike');
            formData.append('element_id', _element_id);
            formData.append('tabela', 'konkurs_grafiki');
            formData.append('nazwa', konkursDodatkoweZdjecieNazwa.val());

        if(inputPole !== undefined){
            formData.append('dodatkowaGrafika', inputPole);
        }

        mainPanel.wyswietlLoader('#popUpTresc2');

        mainPanel.zaladujTrescAjax('ajax/akcje/ajax_aktualizuj_dane', formData);
        odpowiedzAjax = $.parseJSON(mainPanel.zawartoscTrescAjax());

        mainPanel.wyswietlPowiadomienieBoczne(odpowiedzAjax['rodzaj'],'',odpowiedzAjax['komunikat']);

        document.getElementById('konkursListaDodatkowychGrafik').innerHTML = odpowiedzAjax['przeladujPopUpZakladka'];
        document.getElementById('popUpTresc2').innerHTML = odpowiedzAjax['przeladujPopUp'];
        mainPanel.ukryjLoader();

    };

}
