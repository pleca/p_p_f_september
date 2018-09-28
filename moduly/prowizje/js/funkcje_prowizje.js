var keys_to_moving_in_input = [8, 9, 32, 35, 36, 37, 39, 46, 109, 189];

var miesiace = [
    "Styczeń",
    "Luty",
    "Marzec",
    "Kwiecień",
    "Maj",
    "Czerwiec",
    "Lipiec",
    "Sierpień",
    "Wrzesień",
    "Październik",
    "Listopad",
    "Grudzień"
];

$(document).ready(function() {

    wykres_prowizji_uzytkownika();
    wykres_prowizji_struktury();
    pobierz_date();

} );


function pobierz_date() {
    var d = new Date();
    var n = d.getFullYear();
    var miesiac = d.getMonth();
    var rok = parseFloat(n);

    if (miesiac == 0) {
        rok = rok - 1;
        document.getElementById("rok").innerHTML = rok;
    } else {
        document.getElementById("rok").innerHTML = rok;
    }
    return rok;
}

/*WYKRESY*/

function pobierz_miesiac() {
    var d = new Date();
    var miesiac = d.getMonth();

    return miesiac + 1;
}

function wykres_prowizji_uzytkownika() {

    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawChart);

    var rok = pobierz_date();

    function drawChart() {

        var jsonData = $.ajax({
            data: {
                rok: rok,
                aktualny_miesiac: pobierz_miesiac()
            },
            method: "POST",
            url: "ajax/ajax_prowizje_uzytkownika_rok",
            dataType: "json",
            async: false
        }).responseText;

        var obj = $.parseJSON(jsonData);

        var data = google.visualization.arrayToDataTable(obj);

        var view = new google.visualization.DataView(data);

        view.setColumns([0, 1,
            { calc: "stringify",
                sourceColumn: 1,
                type: "string",
                role: "annotation" }]);

        //data.sort({ column: 1, asc: true });

        var chart = new google.visualization.ColumnChart(document.getElementById('chart_div_uzytkownik'));

        var options = {
            legend:{
                position:'none'
            },
            displayAnnotations: 'true',
            bars: 'vertical',
            hAxis: {
                textStyle : {
                    fontSize: 11
                },
                title: 'Miesiąc',
            },
            height: 600,
            width: '100%',
            vAxis: {
                title: 'Kwota prowizji',
                format: 'decimal'
            },
            colors: ['#C9252C'],
            annotations: {
                textStyle: {
                    fontName: 'Times-Roman',
                    fontSize: 11,
                    bold: false,
                    italic: false,
                    color: '#C9252C',
                    alwaysOutside: true,
                    highContrast: true
                }
            }
        };

        google.visualization.events.addListener(chart, 'error', function (googleError) {
            google.visualization.errors.removeError(googleError.id);
            $('.wykres_prowizji_uzytkownika').hide();
            $('.wykres_prowizji_struktury').hide();
            document.getElementById("error_msg").innerHTML = "Brak danych";
        });

        chart.draw(view, options);

    }
}


function wykres_prowizji_struktury() {

    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawChart);

    var rok = pobierz_date();

    function drawChart() {

        var jsonData = $.ajax({
            data: {
                rok: rok
            },
            method: "POST",
            url: "ajax/ajax_pobierz_prowizje_struktury_top_12",
            dataType: "json",
            async: false
        }).responseText;

        var obj = $.parseJSON(jsonData);

        var data = google.visualization.arrayToDataTable(obj);

        var view = new google.visualization.DataView(data);

        view.setColumns([0, 1,
            { calc: "stringify",
                sourceColumn: 1,
                type: "string",
                role: "annotation" }]);

        data.sort({ column: 1, desc: true });

        var chart = new google.visualization.ColumnChart(document.getElementById('chart_div_struktura'));

        var options = {
            legend:{
                position:'none'
            },
            displayAnnotations: 'true',
            bars: 'vertical',
            hAxis: {
                textStyle : {
                    fontSize: 11
                },
                title: 'Numer agenta',
                gridlines: { count: 10 }
            },
            height: 600,
            width: '100%',
            vAxis: {
                title: 'Kwota prowizji',
                format: 'decimal'
            },
            colors: ['#666'],
            annotations: {
                textStyle: {
                    fontName: 'Times-Roman',
                    fontSize: 11,
                    bold: false,
                    italic: false,
                    color: '#C9252C',
                    alwaysOutside: true,
                    highContrast: true
                }
            }
        };

        chart.draw(view, options);

    }
}