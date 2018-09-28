var filmy = new Filmy();

/*http://stackoverflow.com/questions/19305821/multiple-modals-overlay*/
 $(document).on('show.bs.modal', '.modal', function (event) {
     var zIndex = 1040 + (10 * $('.modal:visible').length);
     $(this).css('z-index', zIndex);
     setTimeout(function() {
        $('.modal-backdrop').not('.modal-stack').css('z-index', zIndex - 1).addClass('modal-stack');
     }, 0);
 });

$(document).ready(function() {
    var modalViedoAudio = $('#popUpFilmyAudio');
    var poleVideo = $('.popUpTrescFilmyAudio video')[0];
    var poleAudio = $('.popUpTrescFilmyAudio audio')[0];

    modalViedoAudio.on('hidden.bs.modal', function () {
        interval_licznikSesji = setInterval(function(){
            mainPanel.licznikSesji();
        },60000);

        $('.naglowekStrony').css({
            'padding-right' : '-=17px'
        });

        $('.stopkaStrony').css({
            'padding-right' : '-=17px'
        });

        poleVideo.pause();
        poleVideo.src='';
        poleAudio.pause();
        poleAudio.src='';
    });

    modalViedoAudio.on('show.bs.modal', function () {
        clearInterval(interval_licznikSesji);

        $('.naglowekStrony').css({
            'padding-right' : '+=17px'
        });

        $('.stopkaStrony').css({
            'padding-right' : '+=17px'
        });
        poleVideo.play();
    });

    $(this).on('click','.wyswietlFilm',function(){
        filmy.wczytajFilm($(this));
    });

    $(this).on('click','.dodaj_kategorieFilmu',function(){
        mainPanel.wczytajDaneDoPopUp('', 'wyswietl_dodaj_kategorie_filmu', 'film_kategoria', 'modal-sm', 'wczytaj_dane');
    });

    $(this).on('click','.dodaj_podcast',function(){
        mainPanel.wczytajDaneDoPopUp('', 'wyswietl_dodaj_podcast', '', 'modal-sm', 'wczytaj_dane');
    });

    $(this).on('click','.edytuj_kategorieFilmu',function(){
        mainPanel.wczytajDaneDoPopUp($(this).data('element_id'), 'wyswietl_edytuj_kategorie_filmu', 'film_kategoria', 'modal-lg', 'wczytaj_dane');
    });

    $(this).on('click','.usun_kategorieFilmu',function(){
        mainDane = {
            'element_id' : $(this).data('element_id')
            ,'tabela' : $(this).data('tabela')
            ,'reakcja' : $(this).data('reakcja')
        };

        filmy.usunKategorieFilmu(mainDane);
    });


    $(this).on('click','.dodaj_film',function(){
        mainPanel.wczytajDaneDoPopUp($(this).data('element_id'), 'wyswietl_dodaj_film', 'film', 'modal-lgsm', 'wczytaj_dane');
    });

    $(this).on('click','.edytujFilm',function(){
        mainPanel.wczytajDaneDoPopUp($(this).data('element_id'), 'wyswietl_edytuj_film', 'film', 'modal-lg', 'wczytaj_dane');
    });

    $(this).on('click','.edytujPodcast',function(){
        mainPanel.wczytajDaneDoPopUp($(this).data('element_id'), 'wyswietl_edytuj_podcast', 'podcasty', 'modal-lg', 'wczytaj_dane');
    });

    $(this).on('click','.zapiszZmianyFilm',function(){
        mainDane = {
            '_element_id' : $(this).data('element_id')
            ,'_tabela' : $(this).data('tabela')
            ,'_akcja' : $(this).data('akcja')
            ,'_rodzic' : $(this).data('klasa_rodzic')
        };

        filmy.zapiszZmianyFilm(mainDane);
    });

    $(this).on('change', '.filmMiniaturaUpload input',function(){
        var rodzicKlasa = $(this).parent().data('rodzic_klasa');
        $(this).addClass('aktualizuj');

        przyciskUploadPlik = this.files[0];
        przyciskUpload = $(this);

        if ( /^image/.test( przyciskUploadPlik.type ) ) {
            var reader = new FileReader();
            reader.readAsDataURL( przyciskUploadPlik );
            reader.onloadend = function(){
                $('.'+rodzicKlasa).html('<img class="width_100 height_auto margin_b_10" src="'+this.result+'" />');
            }
        }else{
            alert('Wybierz obraz!!!');
        }
    });

    $(this).on('change', '.filmPoleUpload input',function(){
        przyciskUploadPlik = this.files[0];
        $('.filmNazwa').text(przyciskUploadPlik.name);
    });

    $(this).on('change', '.podcastPoleUpload input',function(){
        przyciskUploadPlik = this.files[0];
        $('.podcastNazwa').text(przyciskUploadPlik.name);
    });

    $(this).on('click','.zapiszZmianyPodcast',function(){
        mainDane = {
            '_element_id' : $(this).data('element_id')
            ,'_tabela' : $(this).data('tabela')
            ,'_akcja' : $(this).data('akcja')
            ,'_rodzic' : $(this).data('klasa_rodzic')
        };

        filmy.zapiszZmianyPodcast(mainDane);
    });

    $(this).on('click','.wyswietlPodcast',function(){
        filmy.wyswietlPodcast($(this));
    });

    $(this).on('click','.usunPrzywrocElement',function(){
        mainDane = {
            'element_id' : $(this).data('element_id')
            ,'tabela' : $(this).data('tabela')
            ,'reakcja' : $(this).data('reakcja')
        };

        filmy.usunKategorieFilmu(mainDane);
    });

    $(this).on('click','.dodajUsunTag',function(){
        var reakcja = $(this).data('reakcja');
        mainDane = {
            'element_id' : $(this).data('element_id')
            ,'reakcja' : reakcja
            ,'tag_id' : $(this).data('tag_id')
            ,'nazwa' : $('.tagNazwa').val()
        };

        filmy.dodajUsunTag(mainDane);

        if(reakcja === 'usun'){
            $(this).parent().remove();
        }

        if(reakcja === 'dodaj'){
            $('.tagNazwa').val('')
        }
    });

    $(this).on('click','.wczytajTabelkeDlaTagu',function(){

        lastTableGlobal.column(4).search($(this).data('tag_nazwa')).draw().search( '' )
            .columns().search( '' );

        $('.dataTables_filter .input-sm').val($(this).data('tag_nazwa'));


    });

});
