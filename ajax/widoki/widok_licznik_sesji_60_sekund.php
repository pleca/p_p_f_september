<div class="licznikSesji60Sekund licznikSesji60SekundTlo affix"></div>
<div class="licznikSesji60Sekund licznikSesji60SekundAlert affix padding_t_10 padding_r_10 padding_b_10 padding_l_10">
    <div class="alert alert-danger margin_b_10" role="alert">UWAGA!!! Sesja wygaśnie za <span class="licznikSesjiSekundy" data-licznik_sekundy="60">60</span> s!</div>
    <button type="button" class="btn btn-success width_100 odswierzSesje">Odśwież sesje</button>
</div>
<script>

    $(document).ready(function(){
        var licznikSek = $('.licznikSesjiSekundy');
        licznikSesjiSekundy(licznikSek.data('licznik_sekundy'),licznikSek);
    });

    function licznikSesjiSekundy(sekundy,licznikSek){
        setTimeout(function(){
            licznikSek.data('licznik_sekundy',(sekundy-1));
            licznikSek.text(sekundy-1);

            if((sekundy) % 5 === 0){
                mainPanel.animateCss('licznikSesji60SekundAlert','shake');
            }

            licznikSesjiSekundy(sekundy-1,licznikSek);
        },1000);
    }

</script>