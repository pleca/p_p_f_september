function Filmy(){

    this.wczytajFilm = function(_film){
        mainPanel.wyswietlLoader('body');

        var viedoPole = $('.popUpTrescFilmyAudio video')[0];
        viedoPole.src = 'pobierz_film?id='+_film.data('element_id')+'&nazwa='+_film.data('nazwa_pliku');
        viedoPole.preload = 'auto';
        viedoPole.load();

        document.getElementById('popUpTytulFilmyAudio').innerHTML = _film.data('nazwa_filmu');
        mainPanel.ukryjLoader();

        $('.wiedoPole').show();
        $('.audioPole').hide();
        $('.popUpTrescFilmyAudioDodatkowaTresc').text('');

        $('#popUpFilmyAudio').modal('show');
        mainPanel.aktywujKontrolkiBootstrapowe();
    };

    this.wyswietlPodcast = function(_podcast){
        mainPanel.wyswietlLoader('body');

        var audioPole = $('.popUpTrescFilmyAudio audio')[0];
        audioPole.src = 'wyswietl_podcast?id='+_podcast.data('element_id')+'&nazwa='+_podcast.data('nazwa_pliku');
        audioPole.load();

        formData = new FormData;
            formData.append( 'akcja', 'wyswietl_podcast');
            formData.append( 'id', _podcast.data('element_id'));
            formData.append( 'tabela', 'podcasty');

        mainPanel.zaladujTrescAjax('ajax/akcje/ajax_wczytaj_dane', formData);
        odpowiedzAjax = $.parseJSON(mainPanel.zawartoscTrescAjax());

        $('.popUpTrescFilmyAudioDodatkowaTresc').html(odpowiedzAjax['tresc']);
        document.getElementById('popUpTytulFilmyAudio').innerHTML = odpowiedzAjax['tytul'];

        mainPanel.ukryjLoader();

        $('.wiedoPole').hide();
        $('.audioPole').show();

        $('#popUpFilmyAudio').modal('show');
        mainPanel.aktywujKontrolkiBootstrapowe();
    };

    this.zapiszZmianyFilm = function(_dane){
        mainPanel.sprawdzWartosciPrm(_dane['_rodzic']);

        if($('.'+_dane['_rodzic']+' .prm').size() === 0){
            mainPanel.wyswietlPowiadomienieBootsrtap('danger','.'+_dane['_rodzic'],'Nie wykryto zmian!!!');
            mainPanel.animateCss('animujModal1','shake');
            return;
        }

        mainDane = mainPanel.zbierzDaneZFormularza(_dane['_rodzic']);

        formData = new FormData;

        if(!mainDane){
            mainPanel.animateCss('animujModal1','shake');
            return;
        }

        var miniaturaPole = $('.filmMiniaturaUpload input');
        var filmPole = $('.filmPoleUpload input');

        if(miniaturaPole.size() !== 0){
            if(!miniaturaPole.hasClass('aktualizuj')){
                if($('.filmEdytuj').size() === 0){
                    mainPanel.wyswietlPowiadomienieBootsrtap('danger','.'+_dane['_rodzic'],'Wybierz miniature!!!');
                    mainPanel.animateCss('animujModal1','shake');
                    return;
                }
            }else{
                formData.append( 'miniatura', miniaturaPole[0].files[0]);
            }
        }

        if(filmPole.size() !== 0){
            if(!filmPole.hasClass('aktualizuj') && filmPole.size() !== 0){
                if($('.filmEdytuj').size() === 0) {
                    mainPanel.wyswietlPowiadomienieBootsrtap('danger', '.' + _dane['_rodzic'], 'Wybierz film!!!');
                    mainPanel.animateCss('animujModal1', 'shake');
                    return;
                }
            }else{
                formData.append( 'film', filmPole[0].files[0]);
            }
        }

            formData.append( 'akcja', _dane['_akcja']);
            formData.append( 'dane', JSON.stringify(mainDane));
            formData.append( 'element_id', _dane['_element_id']);
            formData.append( 'tabela', _dane['_tabela']);

        mainPanel.wyswietlLoader('#popUpTresc');

        mainPanel.zaladujTrescAjax('ajax/akcje/ajax_aktualizuj_dane', formData);

        mainPanel.ukryjLoader();

        odpowiedzAjax = $.parseJSON(mainPanel.zawartoscTrescAjax());

        mainPanel.wyswietlPowiadomienieBoczne(odpowiedzAjax['rodzaj'],'',odpowiedzAjax['komunikat']);

        if(odpowiedzAjax['ukryjPopUp']){
            $('#popUp').modal('hide');
        }

        if(odpowiedzAjax['przeladujWidok']){
            mainPanel.aktywujZakladke(aktywnaZakladka);
        }

    };

    this.zapiszZmianyPodcast = function(_dane){
/*        mainPanel.sprawdzWartosciPrm(_dane['_rodzic']);

        if($('.'+_dane['_rodzic']+' .prm').size() === 0){
            mainPanel.wyswietlPowiadomienieBootsrtap('danger','.'+_dane['_rodzic'],'Nie wykryto zmian!!!');
            mainPanel.animateCss('animujModal1','shake');
            return;
        }
*/
        mainDane = mainPanel.zbierzDaneZFormularza(_dane['_rodzic']);

        formData = new FormData;

        if(!mainDane){
            mainPanel.animateCss('animujModal1','shake');
            return;
        }

        var podcastPole = $('.podcastPoleUpload input');

        if(podcastPole.size() !== 0){
            if(!podcastPole.hasClass('aktualizuj') && podcastPole.size() !== 0){
                if($('.podcastEdytuj').size() === 0) {
                    mainPanel.wyswietlPowiadomienieBootsrtap('danger', '.' + _dane['_rodzic'], 'Wybierz podcast!!!');
                    mainPanel.animateCss('animujModal1', 'shake');
                    return;
                }
            }else{
                formData.append( 'podcast', podcastPole[0].files[0]);
            }
        }

        formData.append( 'akcja', _dane['_akcja']);
        formData.append( 'dane', JSON.stringify(mainDane));
        formData.append( 'element_id', _dane['_element_id']);
        formData.append( 'tabela', _dane['_tabela']);

        mainPanel.wyswietlLoader('#popUpTresc');

        mainPanel.zaladujTrescAjax('ajax/akcje/ajax_aktualizuj_dane', formData);

        mainPanel.ukryjLoader();

        odpowiedzAjax = $.parseJSON(mainPanel.zawartoscTrescAjax());

        mainPanel.wyswietlPowiadomienieBoczne(odpowiedzAjax['rodzaj'],'',odpowiedzAjax['komunikat']);

        if(odpowiedzAjax['ukryjPopUp']){
            $('#popUp').modal('hide');
        }

        if(odpowiedzAjax['przeladujWidok']){
            mainPanel.aktywujZakladke(aktywnaZakladka);
        }
    };

    this.usunKategorieFilmu = function(_dane){
        var formData = new FormData();
            formData.append('akcja', 'usun_przywroc_element');
            formData.append('reakcja', _dane['reakcja']);
            formData.append('tabela', _dane['tabela']);
            formData.append('element_id', _dane['element_id']);

        mainPanel.zaladujTrescAjax('ajax/akcje/ajax_aktualizuj_dane', formData);

        odpowiedzAjax = $.parseJSON(mainPanel.zawartoscTrescAjax());

        powiadomienieBoczne(odpowiedzAjax['rodzaj'],'',odpowiedzAjax['komunikat']);

        if(odpowiedzAjax['ukryjPopUp']){
            $('#popUp').modal('hide');
        }

        if(odpowiedzAjax['przeladujWidok']){
            mainPanel.aktywujZakladke(aktywnaZakladka);
        }

    };

    this.dodajUsunTag = function(_dane){
        $('.podcastTagi .alert').remove();
        var tagNazwaPole = $('.tagNazwa');
        tagNazwaPole.removeClass('wymaganeBlad');

        var formData = new FormData();

        if(_dane['reakcja'] === 'dodaj'){
            if(_dane['nazwa'] === ''){
                tagNazwaPole.addClass('wymaganeBlad');
                mainPanel.wyswietlPowiadomienieBootsrtap('danger', '.podcastEdytuj .podcastTagi', 'Uzupełnij wymagane pola!!!');
                mainPanel.animateCss('animujModal1', 'shake');
                return;
            }
            formData.append('nazwa', _dane['nazwa']);
        }
            formData.append('akcja', 'usun_dodaj_tag');
            formData.append('reakcja', _dane['reakcja']);
            formData.append('tag_id', _dane['tag_id']);
            formData.append('element_id', _dane['element_id']);

        mainPanel.zaladujTrescAjax('ajax/akcje/ajax_aktualizuj_dane', formData);

        odpowiedzAjax = $.parseJSON(mainPanel.zawartoscTrescAjax());

        powiadomienieBoczne(odpowiedzAjax['rodzaj'],'',odpowiedzAjax['komunikat']);

        if(_dane['reakcja'] === 'dodaj'){
            var pojedynczyTag = '<span class="badge pojedynczyTag">'+_dane['nazwa']+'<i data-tag_id="'+odpowiedzAjax['elementIdOut']+'" data-reakcja="usun" data-element_id="'+_dane['element_id']+'" class="fa fa-times-circle dodajUsunTag" aria-hidden="true"></i></span>';

            if($('.podcastTagi .pojedynczyTag').length === 0){
                    $('.podcastTagi .chumrkaTagow .panel-body').html(pojedynczyTag);
            }else{
                $('.podcastTagi .chumrkaTagow .panel-body').append(pojedynczyTag);
            }
        }

        mainPanel.aktywujZakladke(aktywnaZakladka);

    };
}
