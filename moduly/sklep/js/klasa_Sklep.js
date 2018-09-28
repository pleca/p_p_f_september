function Sklep(){

    this.zapiszNowyProdukt = function(){
        mainDane = mainPanel.zbierzDaneZFormularza('produktDane');

        if(!mainDane){
            mainPanel.animateCss('animujModal1','shake');
            return;
        }

        formData = new FormData;
            formData.append( 'akcja', 'dodaj_produkt');
            formData.append( 'dane', JSON.stringify(mainDane));

        var miniaturaPole = $('.produktMiniaturaUpload input');

        if(miniaturaPole[0].files[0] !== undefined){
            formData.append('miniatura', miniaturaPole[0].files[0]);
        }else{
            mainPanel.wyswietlPowiadomienieBootsrtap('danger', '.produktDane', 'Dodaj miniature!!!');
            mainPanel.animateCss('animujModal1','shake');
            return;

        }

        mainPanel.wyswietlLoader('#popUpTresc');

        mainPanel.zaladujTrescAjax('ajax/akcje/ajax_aktualizuj_dane', formData);
        odpowiedzAjax = $.parseJSON(mainPanel.zawartoscTrescAjax());

        mainPanel.wyswietlPowiadomienieBoczne(odpowiedzAjax['rodzaj'],'',odpowiedzAjax['komunikat']);
        mainPanel.ukryjLoader();

        $('#PopUp.modal').modal('hide');

        if(odpowiedzAjax['przeladujWidok']){
            mainPanel.wyswietlLoader('#panel_body_zawartosc');
            var aktywna_zakladka = $('.sklepListaKategorii .nav .active').data('klasa');

            mainPanel.aktywujZakladke('zakladka_lista_produktow');

            $('.active').removeClass('active');
            $('.'+aktywna_zakladka).addClass('active');

        }



    };

}