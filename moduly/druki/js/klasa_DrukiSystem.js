function DrukiSystem(){
    this.wczytajListeDrog = function(){
        var formData = new FormData();
        formData.append('akcja', 'lista_dostepnych_drog');

        mainPanel.zaladujTrescAjax('ajax/akcje/ajax_wczytaj_dane', formData);

        var odpowiedz = $.parseJSON(mainPanel.zawartoscTrescAjax());

        document.getElementById('panel_body_zawartosc').innerHTML = odpowiedz['tresc'];
    };

    this.wczytajDrogeUmowyDoPopUp = function(_dane) {
        var formData = new FormData();
            formData.append('element_id', _dane['_element_id']);
            formData.append('akcja', _dane['_akcja']);
            formData.append('droga', _dane['_droga']);
            formData.append('strona', _dane['_strona']);
            formData.append('ogolne', _dane['_ogolne']);

            if(_dane['_ogolne'] == '1'){
                mainPanel.zaladujTrescAjax('ajax/drogi/ogolne/ajax_ogolne_' + _dane['_strona'], formData);
            }else{
                mainPanel.zaladujTrescAjax('ajax/drogi/' + _dane['_droga'] + '/ajax_' + _dane['_droga'] + '_' + _dane['_strona'], formData);
            }


        document.getElementById('popUpTresc').innerHTML = mainPanel.zawartoscTrescAjax();
        document.getElementById('popUpTytul').innerHTML = 'Dane do druku' ;

        mainPanel.aktywujKontrolkiBootstrapowe();
        mainPanel.wyswietlPopUp('modal-lg', false);

    };

    this.wczytajStroneDrogiUmowyDoPopUp = function(_dane){

        var formData = new FormData();
            formData.append('element_id', _dane['_element_id']);
            formData.append('akcja', _dane['_akcja']);
            formData.append('droga', _dane['_droga']);
            formData.append('strona', _dane['_strona']);

        if(_dane['_ogolne'] == '1'){
            mainPanel.zaladujTrescAjax('ajax/drogi/ogolne/ajax_ogolne_' + _dane['_strona'], formData);
        }else{
            mainPanel.zaladujTrescAjax('ajax/drogi/' + _dane['_droga'] + '/ajax_' + _dane['_droga'] + '_' + _dane['_strona'], formData);
        }

        if(_dane['_reakcja'] == 'zapisz_zmiany'){
            document.getElementById('popUpTresc').innerHTML = mainPanel.zawartoscTrescAjax();
        }

        if(_dane['_reakcja'] == 'przeladuj_widok' || _dane['_reakcja'] == 'zapisz_przeladuj_widok'){
            document.getElementById('popUpStronaUmowy').innerHTML = mainPanel.zawartoscTrescAjax();
        }

        document.getElementById('popUpTytul').innerHTML = 'Dane do druku' ;

        mainPanel.aktywujKontrolkiBootstrapowe();

    };

    this.zapiszZmianyStrona = function(_dane){
        $('.'+_dane['_rodzic']+' .prm').removeClass('prm');

        mainPanel.sprawdzWartosciPrm(_dane['_rodzic']);

        var polePrm = $('.'+_dane['_rodzic']+' .prm');
        var liczbaPrm = polePrm.size();

        if(liczbaPrm == 0){
            powiadomienieBoczne('blad','','Nie wykryto zmian!!!');
            return;
        }

        var formData = new FormData();
            formData.append('akcja', _dane['_akcja']);
            formData.append('tabela', _dane['_tabela']);
            formData.append('element_id', _dane['_element_id']);
            formData.append('droga', _dane['_droga']);
            formData.append('strona', _dane['_strona']);

        var wartosciPrm = {};
        var warPrm = '';
        var kluczPrm = '';
        var klasaPrm = '';
        var akcja = _dane['_akcja'];

        mainPanel.SprawdzWymaganePola(_dane['_rodzic'], liczbaPrm);

        if($('.wymaganeBlad').size() != 0){
            powiadomienieBoczne('blad','','Uzupełnij wymagane pola!!!');
            return false;
        }

        if($('.blednaWartosc').size() != 0){
            powiadomienieBoczne('blad','','Popraw błędy!!!');
            return false;
        }

        for(var i=0;i<liczbaPrm;i++){
            kluczPrm = polePrm[i].getAttribute('data-kolumna');
            klasaPrm = polePrm[i].getAttribute('class');
            if(klasaPrm.indexOf('attrValue') < 0){
                warPrm = $('.'+_dane['_rodzic']+' .prm')[i].value;
            }else{
                warPrm = $('.'+_dane['_rodzic']+' .prm')[i].getAttribute('value');
            }

            wartosciPrm[kluczPrm] = warPrm;
        }

        if($('.przyciskUploadPrzycisk').val() != '' && $('.przyciskUploadPrzycisk').hasClass('prm')){
            formData.append('plik', $('.przyciskUploadPrzycisk')[0].files[0]);
        }else{
            formData.append('plik', 'null');
        }

        formData.append('dane', JSON.stringify(wartosciPrm));

        mainPanel.zaladujTrescAjax('ajax/akcje/ajax_aktualizuj_dane', formData);

        var odpowiedz = $.parseJSON(mainPanel.zawartoscTrescAjax());

        powiadomienieBoczne(odpowiedz['rodzaj'],'',odpowiedz['komunikat']);

        if(odpowiedz['ukryjPopUp1'] == 1) {
            $('#popUp').modal('hide');
        }

        if(odpowiedz['przeladujWidokZakladki'] == 1){
            if(getCookie('aktywnaZakladka') !== 'Wypełnij druki'){
                mainPanel.aktywujZakladke(getCookie('aktywnaZakladka'));
            }
        }

        if(odpowiedz['przeladujSzczegolyElementu'] == 1){
            akcja = 'edytuj_klienta';

            if(odpowiedz['tabela'] == 'umowa'){
                akcja = 'szczeguly_umowy';
            }

            if(odpowiedz['tabela'] == 'umowaBankowa'){
                akcja = 'szczeguly_umowy';
            }
            if(odpowiedz['tabela'] == 'umowaOsobowa'){
                akcja = 'szczeguly_umowy';
            }


            main_dane = {
                'element_id' : odpowiedz['element_id']
                ,'tabela' : odpowiedz['tabela']
                ,'akcja' : akcja
            };

            mainPanel.szczegolyElementu(main_dane);
        }

        if(odpowiedz['rodzaj'] != 'sukces'){
            return false;
        }

        return odpowiedz['element_id'];

    };

    this.zapiszZmianyDruki = function(_dane){

        var wartosciPola = mainPanel.zbierzSprawdzPolaAktualizuj(_dane);

        if(!wartosciPola){
            return;
        }

        if($('.blednaWartosc').size() != 0){
            powiadomienieBoczne('blad','','Popraw błędy!!!');
            return false;
        }

        var akcja = _dane['_akcja'];

        mainPanel.zaladujTrescAjax('ajax/akcje/ajax_aktualizuj_dane', wartosciPola);

        var odpowiedz = $.parseJSON(mainPanel.zawartoscTrescAjax());

        powiadomienieBoczne(odpowiedz['rodzaj'],'',odpowiedz['komunikat']);

        if(odpowiedz['ukryjPopUp1'] == 1) {
            $('#popUp').modal('hide');
        }

        if(odpowiedz['przeladujWidokZakladki'] == 1){
            if(getCookie('aktywnaZakladka') !== 'Wypełnij druki'){
                mainPanel.aktywujZakladke(getCookie('aktywnaZakladka'));
            }
        }

        if(odpowiedz['przeladujSzczegolyElementu'] == 1){
            akcja = 'edytuj_klienta';

            if(_dane['_tabela'] == 'powiadomienia'){
                akcja = 'edytuj_powiadomienie';
            }

            main_dane = {
                'element_id' : _dane['_element_id']
                ,'tabela' : _dane['_tabela']
                ,'akcja' : akcja
            };

            mainPanel.szczegolyElementu(main_dane);
        }

    };

    this.usunPrzywrocElement = function(_dane){
        var formData = new FormData();
            formData.append('element_id', _dane['_element_id']);
            formData.append('tabela', _dane['_tabela']);
            formData.append('akcja', _dane['_akcja']);
            formData.append('reakcja', _dane['_reakcja']);

        mainPanel.zaladujTrescAjax('ajax/akcje/ajax_aktualizuj_dane', formData);
        var odpowiedz = $.parseJSON(mainPanel.zawartoscTrescAjax());

        powiadomienieBoczne(odpowiedz['rodzaj'],'',odpowiedz['komunikat']);
    };

    this.generujDokument = function(_dane){
        mainPanel.wyswietlLoader('html');

        var formData = new FormData();
            formData.append('element_id', _dane['_element_id']);
            formData.append('nazwa_druku', _dane['_nazwa_druku']);
            formData.append('droga', _dane['_droga']);
            formData.append('rodzaj_druku', _dane['_rodzaj_druku']);

            if(_dane['_nazwa_druku'] == 'wszystko') {

                var druki = $('.listaDrukow').children();
                var i;

                var formData_druk = new FormData();
                formData_druk.append('element_id', _dane['_element_id']);
                formData_druk.append('droga', _dane['_droga']);

                for (i = 0; i < druki.length-1; i++) {

                    var zmienna = druki[i].getAttribute('data-nazwa_druku');

                    if(zmienna != null) {
                        formData_druk.append('nazwa_druku', druki[i].getAttribute('data-nazwa_druku'));
                        formData_druk.append('rodzaj_druku', druki[i].getAttribute('data-rodzaj_druku'));
						console.log(druki[i].getAttribute('data-nazwa_druku'));
						console.log(formData_druk);
                        mainPanel.zaladujTrescAjax('ajax/akcje/ajax_generuj_'+druki[i].getAttribute('data-nazwa_druku'), formData_druk);
                    }

                }

                mainPanel.zaladujTrescAjax('ajax/akcje/ajax_generuj_wszystko', formData);

                var tmp = _dane['_element_id'].split("-");
                var umowa = tmp[0];

                powiadomienieBoczne('sukces','','Wygenerowano poprawnie dokument!!!');

                mainPanel.ukryjLoader();

                window.open(adres_hosta+'/moduly/druki/wyswietlDokument?id='+umowa+'&nazwa='+umowa+'_'+_dane['_nazwa_druku']+'.pdf','_blank');

            } else {
                mainPanel.zaladujTrescAjax('ajax/akcje/ajax_generuj_'+_dane['_nazwa_druku'], formData);
                var odpowiedz = $.parseJSON(mainPanel.zawartoscTrescAjax());

                powiadomienieBoczne(odpowiedz['rodzaj'],'',odpowiedz['komunikat']);

                mainPanel.ukryjLoader();

                window.open(adres_hosta+'/moduly/druki/wyswietlDokument?id='+odpowiedz['element_id']+'&nazwa='+odpowiedz['nazwa_pliku']+'.pdf','_blank');
            }


    };

    this.wyslijKopieDoCentrali = function(_dane){
        mainPanel.wyswietlLoader('html');

        var formData = new FormData();
            formData.append('element_id', _dane['element_id']);
            formData.append('droga', _dane['nazwa_drogi']);
            formData.append('telefon', _dane['telefon']);
            formData.append('nazwa_druku', 'umowa');
            formData.append('sms_grupa', 'kopia_umowy_do_kancelarii');

        mainPanel.zaladujTrescAjax('ajax/akcje/ajax_sms', formData);
        //odpowiedz = $.parseJSON(mainPanel.zawartoscTrescAjax());

        //console.log(odpowiedz);
        mainPanel.zaladujTrescAjax('ajax/akcje/ajax_generuj_umowa', formData);

        var odpowiedz = $.parseJSON(mainPanel.zawartoscTrescAjax());

        formData.append('nazwa_pliku', odpowiedz['nazwa_pliku']);

        mainPanel.zaladujTrescAjax('ajax/akcje/ajax_wyslij_kopie_do_centrali', formData);
        mainPanel.ukryjLoader();

        odpowiedz = $.parseJSON(mainPanel.zawartoscTrescAjax());

        if(odpowiedz.rezultat){
            powiadomienieBoczne('sukces','',odpowiedz.komunikat);
        }else{
            powiadomienieBoczne('blad','',odpowiedz.komunikat);
        }
    };



}
