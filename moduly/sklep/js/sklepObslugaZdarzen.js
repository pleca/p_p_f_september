var sklep = new Sklep();

/*http://stackoverflow.com/questions/19305821/multiple-modals-overlay*/
$(document).on('show.bs.modal', '.modal', function (event) {
    var zIndex = 1040 + (10 * $('.modal:visible').length);
    $(this).css('z-index', zIndex);
    setTimeout(function() {
        $('.modal-backdrop').not('.modal-stack').css('z-index', zIndex - 1).addClass('modal-stack');
    }, 0);
});

$(document).ready(function(){

    $('.sklepListaKategorii .tab-content').css('min-height', ($('.sklepListaKategorii .nav-tabs').height())+'px');

    $(this).on('click','.dodaj_produkt',function(){
        mainPanel.wyswietlLoader('body');
        mainPanel.wczytajDaneDoPopUp('', 'wyswietl_dodaj_produkt', 'sklep_produkty', 'modal-lgsm', 'wczytaj_dane');
        mainPanel.ukryjLoader();
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
                $('.'+rodzicKlasa).html('<img class="width_100 height_auto margin_b_10" src="'+this.result+'" />');
                //$('.'+rodzicKlasa).find('img').attr('src',this.result);
            }
        }else{
            alert('Wybierz obraz!!!');
        }
    });

    $(this).on('click','.zapiszNowyProdukt',function(){
        sklep.zapiszNowyProdukt();
    });

});