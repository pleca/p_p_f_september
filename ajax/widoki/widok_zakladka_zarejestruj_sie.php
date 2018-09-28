<div class="panel panel-default animuj">
    <div class="panel-heading text-uppercase">uzupełnij wszystkie pola</div>
    <div class="panel-body panelZarejestruj">
        <div class="alert alert-danger" role="alert">
            <p class="font_weight_700">Jeżeli prowadzisz jednoosobową działalność gospodarczą zarejestruj się jako osoba fizyczna.</p>
        </div>
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active osobaFizyczna"><a href="#osobaFizyczna" aria-controls="osobaFizyczna" role="tab" data-toggle="tab">Osoba fizyczna</a></li>
            <li role="presentation" class="dzialalnoscGospodarcza"><a href="#dzialalnoscGospodarcza" aria-controls="dzialalnoscGospodarcza" role="tab" data-toggle="tab">Działalność gospodarcza</a></li>
        </ul>
        <div class="tab-content padding_b_10 padding_t_10 padding_l_10 padding_r_10">
            <div role="tabpanel" class="tab-pane active osobaFizycznaFormularz" id="osobaFizyczna">
                <div class="form-group">
                    <input type="text" class="form-control height_40 duzeMaleLiteryCyfry prm wymagane" data-kolumna="uzytkownikLogin" maxlength="7" placeholder="Numer przedstawiciela(jedna duża litera i sześć cyfr)">
                </div>
                <div class="form-group">
                    <input type="text" class="form-control height_40 duzeMaleLiteryCyfry prm wymagane" data-kolumna="uzytkownikImie" maxlength="45" placeholder="Imię">
                </div>
                <div class="form-group">
                    <input type="text" class="form-control height_40 duzeMaleLiteryCyfry prm wymagane" data-kolumna="uzytkownikNazwisko" maxlength="45" placeholder="Nazwisko">
                </div>
                <?php
                    /*
                        <div class="form-group">
                            <input type="text" class="form-control height_40 sprawdzPesel poleLiczbowe prm wymagane" data-kolumna="uzytkownikPesel" maxlength="45" placeholder="Pesel">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control height_40 sprawdzNumerDowodu prm wymagane" data-kolumna="uzytkownikNrDowodu" maxlength="45" placeholder="Seria i numer dowodu osobistego">
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-control height_40 sprawdzEmail duzeMaleLiteryCyfry prm wymagane poleEmailVotum" data-kolumna="uzytkownikEmail" maxlength="45" placeholder="Email w domenie votum-sa.pl">
                        </div>
                    */
                ?>
                <button type="button" class="btn btn-success height_40 width_100 zarejestruj" data-zarejestruj_rodzaj="osoba_fizyczna" data-klasa_rodzic="osobaFizycznaFormularz">Zarejestruj</button>
            </div>
            <div role="tabpanel" class="tab-pane dzialalnoscGospodarczaFormularz" id="dzialalnoscGospodarcza">
                <div class="form-group">
                    <input type="text" class="form-control height_40 duzeMaleLiteryCyfry prm wymagane" data-kolumna="uzytkownikLogin" maxlength="45" placeholder="Numer przedstawiciela(jedna duża litera i sześć cyfr)">
                </div>
                <div class="form-group">
                    <input type="text" class="form-control height_40 duzeMaleLiteryCyfry prm wymagane" data-kolumna="uzytkownikImie" maxlength="45" placeholder="Imię reprezentanta">
                </div>
                <div class="form-group">
                    <input type="text" class="form-control height_40 duzeMaleLiteryCyfry prm wymagane" data-kolumna="uzytkownikNazwisko" maxlength="45" placeholder="Nazwisko reprezentanta">
                </div>
                <?php
                    /*
                        <div class="form-group">
                            <input type="text" class="form-control height_40 poleLiczbowe prm wymagane" data-kolumna="firmaNip" maxlength="45" placeholder="Nip">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control height_40 poleLiczbowe prm wymagane" data-kolumna="firmaRegon" maxlength="45" placeholder="Regon">
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-control height_40 sprawdzEmail duzeMaleLiteryCyfry prm wymagane poleEmailVotum" data-kolumna="uzytkownikEmail" maxlength="45" placeholder="Email reprezentanta firmy w domenie votum-sa.pl">
                        </div>
                    */
                ?>
                <button type="button" class="btn btn-success height_40 width_100 zarejestruj" data-zarejestruj_rodzaj="dzialalnosc_gospodarcza" data-klasa_rodzic="dzialalnoscGospodarczaFormularz">Zarejestruj</button>
            </div>
        </div>

    </div>
</div>