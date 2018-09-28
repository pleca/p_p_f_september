<div id="commission-calculator" class="container">
    <div class="row calculator-inputs">
            <div class="col-sm">
                <label for="claim">Orientacyjna wartość nadpłaconych rat w PLN:</label>
                <input value = "65000" id="claim" type="number" name="claim" />
            </div>
            <div class="col-sm">
                <label for="decreasedCapital">Orientacyjna wartość przyszłych nadpłat w PLN:</label>
                <input value = "140000" id="decreasedCapital" type="number" name="decreasedCapital" /></div>
    </div>
    <div class="commission-calculate">
        <button class="odswierzSesje">Oblicz</button>
    </div>

    <div class="row">
        <div class="table-responsive">
            <table class="table table-hover" id="table-commission" border="1">
                <thead>
                <tr>
                    <th scope="col"></th>
                    <th scope="col">Honorarium brutto od pozostałych roszczeń</th>
                    <th scope="col">Wpłata wstępna brutto</th>
                    <th scope="col">Kwota honorarium brutto</th>
                    <th scope="col">Kwota honorarium brutto od zmniejszenia salda zadłużenia</th>
                    <th scope="col"><b>Suma opłaty wstępnej i honorarium brutto</b></th>
                    <th scope="col">Wartość % sumy wynagrodzenia od całości korzyści</th>
                </tr>
                </thead>
                <tbody>
                <tr class="tenThousand">
                    <th scope="row">
                        <div class="commision-offer-type-div">Oferta VIP</div>
                        <b>10.000 zł</b> netto
                        12.300 zł brutto</th>
                    <td>10%</td>
                    <td class="prepayment"></td>
                    <td class="remunerationAmount"></td>
                    <td class="remunerationFromReduction"></td>
                    <td class="sumRemuneration"></td>
                    <td class="totalBenefitsPercentage"></td>
                </tr>
                <tr class="fiveThousand">
                    <th scope="row">
                        <div class="commision-offer-type-div">Oferta PREMIUM</div>
                        <b>5.000 zł</b> netto
                        6.150 zł brutto</th>
                    <td>20%</td>
                    <td class="prepayment"></td>
                    <td class="remunerationAmount"></td>
                    <td class="remunerationFromReduction"></td>
                    <td class="sumRemuneration"></td>
                    <td class="totalBenefitsPercentage"></td>
                </tr>
                <tr class="twoThousandFiveHundred">
                    <th scope="row">
                        <div class="commision-offer-type-div">Oferta BASIC</div>
                        <b>2.500 zł</b> netto
                        3.075 zł brutto</th>
                    <td>30%</td>
                    <td class="prepayment"></td>
                    <td class="remunerationAmount"></td>
                    <td class="remunerationFromReduction"></td>
                    <td class="sumRemuneration"></td>
                    <td class="totalBenefitsPercentage"></td>
                </tr>

                </tbody>
            </table>
        </div>
    </div>
    
<!--    <ul>-->
<!--        <li class="k-state-active">-->
<!--            Menu 1.1-->
<!--        </li>-->
<!--        <li>-->
<!--            Menu 1.2-->
<!--        </li>-->
<!--        <li>-->
<!--            Menu 1.3-->
<!--        </li>-->
<!--        <li>-->
<!--            Menu 1.4-->
<!--        </li>-->
<!--    </ul>-->
<!--    <div>-->
<!--        <p>Content 1.1</p>-->
<!--    </div>-->
<!--    <div>-->
<!--        <p>Content 1.2</p>-->
<!--    </div>-->
<!--    <div>-->
<!--        <p>Content 1.3</p>-->
<!--    </div>-->
<!--    <div>-->
<!--        <p>Content 1.4</p>-->
<!--    </div>-->
    <div class="commission-calculate">
        <button id="commission-calculate-generate-pdf" class="odswierzSesje">Generuj PDF</button>
    </div>
</div>