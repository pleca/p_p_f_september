<?php
    if(!isset($_POST['adresEmail'])){
        return;
    }
?>


<div class="alert alert-danger margin_b_10 text-justify" role="alert">
    <p class="float_l font_size_36 font_weight_700 margin_r_10">1!</p>
    <p class="col-md-11">Na adres email <b><?php echo $_POST['adresEmail']; ?></b> Została wysłana wiadomośc z linkiem do strony na której należy dokonać aktywacji konta i ustawienia hasła do logowania.</p>
    <div class="clear_b"></div>
</div>

<div class="alert alert-danger margin_b_0 text-justify" role="alert">
    <p class="float_l font_size_36 font_weight_700 margin_r_10">2!</p>
    <p class="col-md-11">Na podany numer telefonu komórkowego w ankiecie osobowej została wysłana wiadomość z jednorazowym kodem wymaganym do aktywowania konta użytkownika.</p>
    <div class="clear_b"></div>
</div>



