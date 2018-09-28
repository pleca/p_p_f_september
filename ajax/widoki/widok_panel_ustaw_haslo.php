<?php
    if(!isset($_POST['uzytkownikLogin']) || !isset($_POST['uzytkownikBilet'])){
        return;
    }
?>

<div class="panel panel-default animuj">
    <div class="panel-heading text-uppercase">wprowadź wszystkie wymagane dane</div>
    <div class="panel-body panelUstawHaslo">
        <div class="form-group ukryj">
            <input type="text" disabled class="form-control height_40 prm wymagane zablokowanePole" data-kolumna="uzytkownikBilet" value="<?php echo $_POST['uzytkownikBilet']; ?>" placeholder="Bilet użytkownika">
        </div>
        <div class="form-group">
            <input type="text" disabled class="form-control height_40 prm wymagane zablokowanePole" data-kolumna="uzytkownikLogin" maxlength="45" value="<?php echo $_POST['uzytkownikLogin']; ?>" placeholder="Numer agenta lub nazwa użytkownika">
        </div>
        <div class="form-group">
            <input type="text" class="form-control height_40 prm wymagane duzeMaleLiteryCyfry" data-kolumna="uzytkownikHasloSms" maxlength="6" placeholder="Hasło z wiadomości SMS">
        </div>
        <div class="form-group">
            <input type="password" class="form-control height_40 prm wymagane duzeMaleLiteryCyfry" data-kolumna="uzytkownikHaslo" maxlength="45" placeholder="Hasło użytkownika">
        </div>
        <div class="form-group">
            <input type="password" class="form-control height_40 prm wymagane duzeMaleLiteryCyfry" data-kolumna="uzytkownikHasloPowtorz" maxlength="45" placeholder="Powtórz hasło użytkownika">
        </div>
        <button type="button" data-klasa_rodzic="panelUstawHaslo" class="btn btn-success height_40 width_100 ustawHaslo">Zapisz</button>
    </div>
</div>