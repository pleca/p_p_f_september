$(document).ready(function(){
	
	produkty_rodzaj_widok();
	
	//$('.element_do_wyboru:first-child').addClass('aktywny');
	
	odblokuj_do_edycji_kategorie();
	odblokuj_pola_produkty_kategoria_dodaj_nowy();
	odblokuj_do_edycji_produkt_kategorii();
	produkty_z_kategori_dodaj_nowy_wiersz();
	produkty_strona_dodaj_nowy_zapisz();
	produkty_kategoria_dodaj_nowy_przycisk();
	edytuj_strona();
	
	produkty_kategoria_zapisz();
	produkty_z_kategori_szczegoly_produktu();
	produkty_z_kategori_pojedyncza_edytuj_zapisz();
	produkty_z_kategori_anuluj_edycje();
	
	/*kamyk 2016-08-30*/
	usun_produkt();
});

function produkty_rodzaj_widok(){
	$('.element_do_wyboru').click(function(){
		
		$('.element_do_wyboru').removeClass('aktywny');
		$(this).addClass('aktywny');
		$('.produkty_strona_edytuj').slideUp();
		
		var produkty_strona_id = $(this).data('strona_id');
		var produkty_strona_nazwa = $(this).attr('title');
		
		produkty_kategoria_przeladuj_widok(produkty_strona_id, produkty_strona_nazwa);
	});
} 

function odblokuj_do_edycji_kategorie(){
	$('.produkty_kategoria_edytuj').click(function(){
		
		
		var element_id = $(this).parent().data('produkty_kategoria_id');
		var tabelka = 'produkty_kategoria';
		
		$.ajax({
			method: "POST",
			url: "ajax/widoki/ajax_produkty_edytuj_grupe_kategorie",
			data: {
				element_id : element_id,
				tabelka : tabelka
			}
			
		}).done(function(html){
			document.getElementById("szczegoly_produktu").innerHTML = html ;
			
			$('#szczegoly_produktu').show();
			
			$('.szczegoly_produktu_tlo').addClass('wyswietl_okno_produktu');
			$('.szczegoly_produktu_przod').addClass('wyswietl_okno_produktu');
			
			produkty_z_kategori_szczegoly_produktu_zamknij();
			
			produkty_z_kategori_szczegoly_lista_wszystkich_uzytkownikow();
			produkty_z_kategori_szczegoly_produktu_lista_wszystkich_uzytkownikow_zamknij();
			
			lista_wszystkich_uzytkownikow_rozwin_liste();
			produkty_kategoria_lista_wszystkich_uzytkownikow_szukaj();
			
			lista_uzytkownikow_dla_kategoria_grupa_dodaj_uprawnienie();
			
			produkty_kategoria_uzytkownicy_usun();
			
			produkty_kategoria_zapisz();
			
			produkty_kategoria_uzytkownik_grupy_pojedyncza_kratka_zaznaczanie();
						
			usun_kategorie();
			
			zeruj_licznik_sesji_po_wykonaniu_funkcji();		
		}).fail(function(ajaxContext) {			
			document.getElementById("body_strona_r").innerHTML = ajaxContext.responseText ;
		});
		
	});
}

function lista_uzytkownikow_dla_kategoria_grupa_dodaj_uprawnienie(){
	$('.lista_uzytkownikow_dla_kategoria_grupa_dodaj_uprawnienie').click(function(){
				
		var produkt_id = $('.szczegoly_produktu_przod_belka_top_tytul').data('element_id');
		var uzytkownik_id = $(this).data('uzytkownik_id');
		
		//alert(produkt_id+' '+uzytkownik_id);
		
		$.ajax({
			method: "POST",
			url: "ajax/akcje/ajax_lista_uzytkownikow_dla_kategoria_grupa_dodaj_uprawnienie",
			data: {
				produkt_id : produkt_id,
				uzytkownik_id : uzytkownik_id
			}
			
		}).done(function(data){
			
			var array = $.parseJSON(data);
			
			if(array[0] === '0'){
				wyswitl_powiadomienie('Wybrany użytkownik posiada uprawnienie do grupy!!!', 0, 0);
			}else{
				produkty_kategoria_uzytkownicy_lista_dodanych(produkt_id);
				
				wyswitl_powiadomienie('Dodano uprawnienie dla użytkownika!!!', 1, 0);
			}
			
			zeruj_licznik_sesji_po_wykonaniu_funkcji();
		}).fail(function(ajaxContext) {			
			alert(ajaxContext.responseText) ;
		});
		
		$(this).parent().slideUp(function(){
			$(this).remove();
		});
				
	});
}

function odblokuj_pola_produkty_kategoria_dodaj_nowy(){
	$('.produkty_kategoria_dodaj_nowy_przycisk').click(function(){
		$('.produkty_strona_nazwa').css('width', '405px');
		$('.produkty_kategoria_dodaj_nowy_nr_kolejnosci').show();
		$('.produkty_kategoria_dodaj_nowy_nazwa').show();
		
		$(this).hide();
		$('.produkty_kategoria_dodaj_nowy_zapisz').show();
	});
}

function odblokuj_do_edycji_produkt_kategorii(){
	$('.produkty_z_kategori_pojedyncza_edytuj').click(function(){
			produkty_z_kategori_zablokuj_edycje();
		
			$(this).parent().find('.produkty_z_kategori_pojedyncza_zapisz').show();
			$(this).hide();
			$(this).parent().find('.produkty_z_kategori_pojedyncza_podglad').hide();
			$(this).parent().find('.produkty_z_kategori_pojedyncza_nazwa_nazwa').hide();
			
			$(this).parent().find('.produkty_z_kategori_pojedyncza_nr_kolejnosci').addClass('do_edycji');
			$(this).parent().find('.produkty_z_kategori_pojedyncza_nazwa').addClass('do_edycji');
			$(this).parent().find('.produkty_z_kategori_pojedyncza_opis').addClass('do_edycji');
			$(this).parent().find('.produkty_z_kategori_pojedyncza_plik').addClass('do_edycji');
			$(this).parent().find('.produkty_z_kategori_pojedyncza_anuluj_edytuj').show();
		
		
		
	});
}

function produkty_z_kategori_anuluj_edycje(){
	$('.produkty_z_kategori_pojedyncza_anuluj_edytuj').click(function(){
		produkty_z_kategori_zablokuj_edycje();
	});
}

function produkty_z_kategori_zablokuj_edycje(){
	$('.produkty_z_kategori_pojedyncza_zapisz').hide();
	$('.produkty_z_kategori_pojedyncza_edytuj').show();
	$('.produkty_z_kategori_pojedyncza_podglad').show();
	$('.produkty_z_kategori_pojedyncza_nazwa_nazwa').show();
	
	$('.produkty_z_kategori_pojedyncza_nr_kolejnosci').removeClass('do_edycji');
	$('.produkty_z_kategori_pojedyncza_nazwa').removeClass('do_edycji');
	$('.produkty_z_kategori_pojedyncza_opis').removeClass('do_edycji');
	$('.produkty_z_kategori_pojedyncza_plik').removeClass('do_edycji');
	$('.produkty_z_kategori_pojedyncza_anuluj_edytuj').hide();
}

function produkty_z_kategori_dodaj_nowy_wiersz(){
	$('.produkty_z_kategori_dodaj_nowy').click(function(){
		produkty_z_kategori_zablokuj_edycje();
		
		var e1 = '<input class="produkty_z_kategori_pojedyncza_nr_kolejnosci nowy" type="text" value="" placeholder="Nr" />';
		var e2 = '<input class="produkty_z_kategori_pojedyncza_nazwa nowy" type="text" value="" placeholder="Nazwa produktu" />';
		var e6 = '<input class="produkty_z_kategori_pojedyncza_plik nowy" type="file" name="" />';
		var e3 = '<span style="display:block" class="produkty_z_kategori_pojedyncza_zapisz_nowy " ></span>';
		var e4 = '<span class="produkty_z_kategori_pojedyncza_usun dzkpu_wiersz_n" ></span>';
		var e5 = '<div class="clear_b"></div>';
		var e7 = '<textarea class="produkty_z_kategori_pojedyncza_opis" placeholder="Opis produktu"></textarea>';
		
		var wiersz = '<div style="display:none" class="produkty_z_kategori_pojedyncza produkty_z_kategori_nowa">'+e1+e2+e6+e3+e4+e7+e5+'</div>';
				
		
		$(this).prev().append(wiersz);
		$(this).prev().find('.produkty_z_kategori_pojedyncza:last').slideDown();
		
		produkty_z_kategori_usun_nowy_wiersz();
		produkty_z_kategori_pojedyncza_zapisz_nowy();
		aktualizuj_value_input_texarea();
		
		$('.produkty_z_kategori_dodaj_nowy').slideUp();
	});
}

function produkty_z_kategori_usun_nowy_wiersz(){
	$('.dzkpu_wiersz_n').click(function(){				
		$(this).parent().slideUp(function(){
			$(this).remove();
			
		});	
		$('.produkty_z_kategori_dodaj_nowy').slideDown();
	});
}

function produkty_strona_dodaj_nowy_zapisz(){
	$('.produkty_strona_dodaj_nowy_zapisz').click(function(){
		var produkty_strona_nr_kolejnosci = $('.produkty_strona_dodaj_nowy_nr_kolejnosci').val();
		var produkty_strona_nazwa = $('.produkty_strona_dodaj_nowy_nazwa').val();
		if(produkty_strona_nazwa == ''){
			wyswitl_powiadomienie('Uzupełnij nazwe rodzaju produktu!!!', 0, 0);
			return false;
		}
		
		if(produkty_strona_nr_kolejnosci == ''){
			produkty_strona_nr_kolejnosci = '0';
		}
		
		//alert(produkty_strona_nr_kolejnosci+' '+produkty_strona_nazwa);
		
		wyswietl_loader();
		
		$.ajax({
			method: "POST",
			url: "ajax/akcje/ajax_produkty_strona_dodaj_nowy",
			data: {
				produkty_strona_nr_kolejnosci : produkty_strona_nr_kolejnosci,
				produkty_strona_nazwa : produkty_strona_nazwa
			}
			
		}).done(function(html){
			
			//alert(html);
			
			wyswitl_powiadomienie('Dodano stronę do bazy!!!', 1, 1, 1000);
			
		}).fail(function(ajaxContext) {			
			document.getElementById("body_strona_r").innerHTML = ajaxContext.responseText ;
		});
	});
}

function produkty_kategoria_dodaj_nowy_przycisk(){
	$('.produkty_kategoria_dodaj_nowy_zapisz').click(function(){
		var produkty_kategoria_nr_kolejnosci = $('.produkty_kategoria_dodaj_nowy_nr_kolejnosci').val();
		var produkty_kategoria_nazwa = $('.produkty_kategoria_dodaj_nowy_nazwa').val();
		var produkty_strona_id = $('.produkty_strona_kategorii_opcje').data('strona_id');
		var produkty_strona_nazwa = $('.produkty_strona_nazwa').data('strona_nazwa');
				
		if(produkty_kategoria_nazwa == ''){
			wyswitl_powiadomienie('Uzupełnij nazwe kategorii produktu!!!', 0, 0);
			return false;
		}
		
		if(produkty_kategoria_nr_kolejnosci == ''){
			produkty_kategoria_nr_kolejnosci = '0';
		}
		
		//wyswietl_loader();
		
		$.ajax({
			method: "POST",
			url: "ajax/akcje/ajax_produkty_kategoria_dodaj_nowy",
			data: {
				produkty_kategoria_nr_kolejnosci : produkty_kategoria_nr_kolejnosci,
				produkty_kategoria_nazwa : produkty_kategoria_nazwa,
				produkty_strona_id : produkty_strona_id
			}
			
		}).done(function(html){
			
			produkty_kategoria_przeladuj_widok(produkty_strona_id, produkty_strona_nazwa);
			
			wyswitl_powiadomienie('Dodano Kategorię do bazy!!!', 1, 0);		
			
		}).fail(function(ajaxContext) {			
			document.getElementById("body_strona_r").innerHTML = ajaxContext.responseText ;
		});
	});
}


function produkty_kategoria_przeladuj_widok(strona_id, strona_nazwa){
	$.ajax({
		method: "POST",
		url: "ajax/widoki/ajax_produkty_strona",
		data: {
			produkty_strona_id : strona_id,
			produkty_strona_nazwa : strona_nazwa
		}
		
	}).done(function(html){
		document.getElementById("body_strona_r").innerHTML = html ;
		odblokuj_do_edycji_kategorie();
		odblokuj_pola_produkty_kategoria_dodaj_nowy();
		odblokuj_do_edycji_produkt_kategorii();
		produkty_z_kategori_dodaj_nowy_wiersz();
		produkty_kategoria_dodaj_nowy_przycisk();
		produkty_kategoria_zapisz();
		produkty_z_kategori_szczegoly_produktu();
		produkty_z_kategori_pojedyncza_edytuj_zapisz();
		produkty_z_kategori_anuluj_edycje();
		
		/*kamyk 2016-08-30*/
		usun_produkt();
		
		zeruj_licznik_sesji_po_wykonaniu_funkcji();		
	}).fail(function(ajaxContext) {			
		document.getElementById("body_strona_r").innerHTML = ajaxContext.responseText ;
	});
}

function edytuj_strona(){
	$('.edytuj_strona').click(function(){
		
		var element_id = $(this).parent().data('strona_id');
		var tabelka = 'produkty_strona';
		
		$.ajax({
			method: "POST",
			url: "ajax/widoki/ajax_produkty_edytuj_grupe_kategorie",
			data: {
				element_id : element_id,
				tabelka : tabelka
			}
			
		}).done(function(html){
			document.getElementById("szczegoly_produktu").innerHTML = html ;
			
			$('#szczegoly_produktu').show();
			
			$('.szczegoly_produktu_tlo').addClass('wyswietl_okno_produktu');
			$('.szczegoly_produktu_przod').addClass('wyswietl_okno_produktu');
			
			produkty_z_kategori_szczegoly_produktu_zamknij();
			
			produkty_strona_edytuj_zapisz();
			produkty_strona_usun();
			
			produkty_z_kategori_szczegoly_lista_wszystkich_uzytkownikow();
			produkty_z_kategori_szczegoly_produktu_lista_wszystkich_uzytkownikow_zamknij();
			
			lista_wszystkich_uzytkownikow_rozwin_liste();
			produkty_grupa_lista_wszystkich_uzytkownikow_szukaj();
			
			lista_uzytkownikow_dla_strona_grupa_dodaj_uprawnienie();
			
			produkty_grupa_uzytkownik_grupy_pojedyncza_kratka_zaznaczanie();
			
			produkty_grupa_uzytkownicy_usun();
			
			
			
			zeruj_licznik_sesji_po_wykonaniu_funkcji();		
		}).fail(function(ajaxContext) {			
			document.getElementById("body_strona_r").innerHTML = ajaxContext.responseText ;
		});
				
	});
}

function lista_uzytkownikow_dla_strona_grupa_dodaj_uprawnienie(){
	$('.lista_uzytkownikow_dla_strona_grupa_dodaj_uprawnienie').click(function(){
				
		var produkt_id = $('.szczegoly_produktu_przod_belka_top_tytul').data('element_id');
		var uzytkownik_id = $(this).data('uzytkownik_id');
		
		//alert(produkt_id+' '+uzytkownik_id);
		
		$.ajax({
			method: "POST",
			url: "ajax/akcje/ajax_lista_uzytkownikow_dla_strona_grupa_dodaj_uprawnienie",
			data: {
				produkt_id : produkt_id,
				uzytkownik_id : uzytkownik_id
			}
			
		}).done(function(data){
			
			var array = $.parseJSON(data);
			
			if(array[0] === '0'){
				wyswitl_powiadomienie('Wybrany użytkownik posiada uprawnienie do grupy!!!', 0, 0);
			}else{
				produkty_grupa_uzytkownicy_lista_dodanych(produkt_id);
				
				wyswitl_powiadomienie('Dodano uprawnienie dla użytkownika!!!', 1, 0);
			}
			
			zeruj_licznik_sesji_po_wykonaniu_funkcji();
		}).fail(function(ajaxContext) {			
			alert(ajaxContext.responseText) ;
		});
		
		$(this).parent().slideUp(function(){
			$(this).remove();
		});
				
	});
}

function produkty_strona_edytuj_zapisz(){
	$('.produkty_strona_edytuj_zapisz').click(function(){
		var produkty_strona_nr_kolejnosci = $(this).parent().find('.produkty_strona_edytuj_nr_kolejnosci').val();
		var produkty_strona_nazwa = $(this).parent().find('.produkty_strona_edytuj_nazwa').val();
		var produkty_strona_id = $(this).parent().data('strona_id');
		
		//alert(produkty_strona_nr_kolejnosci+' '+produkty_strona_nazwa);
		
		if(produkty_strona_nazwa == ''){
			wyswitl_powiadomienie('Uzupełnij nazwe rodzaju produktu!!!', 0, 0);
			return false;
		}
		
		if(produkty_strona_nr_kolejnosci == ''){
			produkty_strona_nr_kolejnosci = '0';
		}
		
		wyswietl_loader();
		
		$.ajax({
			method: "POST",
			url: "ajax/akcje/ajax_produkty_strona_edytuj",
			data: {
				produkty_strona_nr_kolejnosci : produkty_strona_nr_kolejnosci,
				produkty_strona_nazwa : produkty_strona_nazwa,
				produkty_strona_id : produkty_strona_id
			}
			
		}).done(function(html){
			
			//alert(html);
			
			wyswitl_powiadomienie('Zmiany zostały zapisane!!!', 1, 1, 1000);		
			
		}).fail(function(ajaxContext) {			
			document.getElementById("body_strona_r").innerHTML = ajaxContext.responseText ;
		});
	});
}



function produkty_kategoria_zapisz(){
	$('.produkty_strona_edytuj_zapisz').click(function(){
		var produkty_kategoria_nr_kolejnosci = $(this).parent().find('.produkty_strona_edytuj_nr_kolejnosci').val();
		var produkty_kategoria_nazwa = $(this).parent().find('.produkty_strona_edytuj_nazwa').val();
		var produkty_kategoria_id = $(this).parent().data('strona_id');
		var produkty_strona_id = $('.produkty_strona_kategorii_opcje').data('strona_id');
		var produkty_strona_nazwa = $('.produkty_strona_nazwa').data('strona_nazwa');
		
		if(produkty_kategoria_nazwa == ''){
			wyswitl_powiadomienie('Uzupełnij nazwe kategorii produktu!!!', 0, 0);
			return false;
		}
		
		if(produkty_kategoria_nr_kolejnosci == ''){
			produkty_kategoria_nr_kolejnosci = '0';
		}
		
		if(produkty_kategoria_id == ''){
			wyswitl_powiadomienie('Brak elementu do edycji!!!', 0, 0);	
			return false;
		}
		
		$.ajax({
			method: "POST",
			url: "ajax/akcje/ajax_produkty_kategoria_edytuj",
			data: {
				produkty_kategoria_nr_kolejnosci : produkty_kategoria_nr_kolejnosci,
				produkty_kategoria_nazwa : produkty_kategoria_nazwa,
				produkty_kategoria_id : produkty_kategoria_id
			}
			
		}).done(function(html){
						
			produkty_kategoria_przeladuj_widok(produkty_strona_id, produkty_strona_nazwa);
			
			wyswitl_powiadomienie('Zmiany zostały zapisane!!!', 1, 0);		
			
			$('.szczegoly_produktu_tlo').removeClass('wyswietl_okno_produktu');
			$('.szczegoly_produktu_przod').removeClass('wyswietl_okno_produktu');
			//$('#szczegoly_produktu').hide();
			$('.szczegoly_produktu_tlo').remove();
			$('.szczegoly_produktu_przod').remove();
			$('.lista_wszystkich_uzytkownikow').remove();
			zeruj_licznik_sesji_po_wykonaniu_funkcji();
			
			zeruj_licznik_sesji_po_wykonaniu_funkcji();
		}).fail(function(ajaxContext) {			
			document.getElementById("body_strona_r").innerHTML = ajaxContext.responseText ;
		});
		
	});
}

function produkty_z_kategori_pojedyncza_zapisz_nowy(){
	$('.produkty_z_kategori_pojedyncza_zapisz_nowy').click(function(){
		var produkty_z_kategori_nr_kolejnosci = $(this).parent('.produkty_z_kategori_nowa').find('.produkty_z_kategori_pojedyncza_nr_kolejnosci').val();
		var produkty_z_kategori_nazwa = $(this).parent('.produkty_z_kategori_nowa').find('.produkty_z_kategori_pojedyncza_nazwa').val();
		var produkty_z_kategori_plik = $(this).parent('.produkty_z_kategori_nowa').find('.produkty_z_kategori_pojedyncza_plik')[0].files[0];
		var produkty_z_kategori_opis = $(this).parent('.produkty_z_kategori_nowa').find('.produkty_z_kategori_pojedyncza_opis').val();
		var produkty_kategoria_id = $(this).parent().parent().parent().find('.produkty_kategoria_pojedyncza_naglowek').data('produkty_kategoria_id');
		
		var produkty_strona_id = $('.produkty_strona_kategorii_opcje').data('strona_id');
		var produkty_strona_nazwa = $('.produkty_strona_nazwa').data('strona_nazwa');
				
		var formData = new FormData();
		
		formData.append('produkty_z_kategori_nr_kolejnosci', produkty_z_kategori_nr_kolejnosci);
		formData.append('produkty_z_kategori_nazwa', produkty_z_kategori_nazwa);
		formData.append('produkty_z_kategori_plik', produkty_z_kategori_plik);
		formData.append('produkty_z_kategori_opis', produkty_z_kategori_opis);
		formData.append('produkty_kategoria_id', produkty_kategoria_id);
		formData.append('liczba_rand', Math.random());
		
		
		wyswietl_loader('Trwa wysyłanie plików na serwer!!!');
		
		$.ajax({
			xhr: function() {
		        var xhr = new window.XMLHttpRequest();
		        xhr.upload.addEventListener("progress", function(evt) {
		            if (evt.lengthComputable) {
		                var percentComplete  = Math.round((evt.loaded/evt.total)*100);
		                $('.postep_pasek').css('width',percentComplete+'%');
		            }
		       }, false);
		        return xhr;
			},
			method: "POST",
			url: "ajax/akcje/ajax_produkty_z_kategori_dodaj_nowy",
			data: formData,
            contentType: false,
            processData: false
			
		}).done(function(data){
									
			//alert(data);
			
			ukryj_loader();
			$('.postep_pasek').css('width','0%');
			
			produkty_kategoria_przeladuj_widok(produkty_strona_id, produkty_strona_nazwa);
			
			wyswitl_powiadomienie('produkt został dodany!!!', 1, 0);
			
			zeruj_licznik_sesji_po_wykonaniu_funkcji();
		}).fail(function(ajaxContext) {
			document.getElementById("body_strona_r").innerHTML = ajaxContext.responseText ;
		});
		
	});
}

function produkty_z_kategori_pojedyncza_edytuj_zapisz(){
	$('.produkty_z_kategori_pojedyncza_zapisz').click(function(){
		var produkty_z_kategori_nr_kolejnosci = $(this).parent('.produkty_z_kategori_pojedyncza').find('.produkty_z_kategori_pojedyncza_nr_kolejnosci').val();
		var produkty_z_kategori_nazwa = $(this).parent('.produkty_z_kategori_pojedyncza').find('.produkty_z_kategori_pojedyncza_nazwa').val();
		var produkty_z_kategori_plik = $(this).parent('.produkty_z_kategori_pojedyncza').find('.produkty_z_kategori_pojedyncza_plik')[0].files[0];
		var produkty_z_kategori_opis = $(this).parent('.produkty_z_kategori_pojedyncza').find('.produkty_z_kategori_pojedyncza_opis').val();
		var produkty_z_kategori_id_id = $(this).parent('.produkty_z_kategori_pojedyncza').data('produkty_z_kategori_id');
		
		//alert(produkty_z_kategori_id);
		
		var produkty_strona_id = $('.produkty_strona_kategorii_opcje').data('strona_id');
		var produkty_strona_nazwa = $('.produkty_strona_nazwa').data('strona_nazwa');
				
		var formData = new FormData();
		
		formData.append('produkty_z_kategori_nr_kolejnosci', produkty_z_kategori_nr_kolejnosci);
		formData.append('produkty_z_kategori_nazwa', produkty_z_kategori_nazwa);
		formData.append('produkty_z_kategori_plik', produkty_z_kategori_plik);
		formData.append('produkty_z_kategori_opis', produkty_z_kategori_opis);
		formData.append('produkty_z_kategori_id_id', produkty_z_kategori_id_id);
		formData.append('liczba_rand', Math.random());
		
		
		wyswietl_loader('Trwa wysyłanie plików na serwer!!!');
		
		$.ajax({
			xhr: function() {
		        var xhr = new window.XMLHttpRequest();
		        xhr.upload.addEventListener("progress", function(evt) {
		            if (evt.lengthComputable) {
		                var percentComplete  = Math.round((evt.loaded/evt.total)*100);
		                $('.postep_pasek').css('width',percentComplete+'%');
		            }
		       }, false);
		        return xhr;
			},
			method: "POST",
			url: "ajax/akcje/ajax_produkty_z_kategori_edytuj",
			data: formData,
            contentType: false,
            processData: false
			
		}).done(function(dane){
									
			//alert(dane);
			
			ukryj_loader();
			$('.postep_pasek').css('width','0%');
			
			produkty_kategoria_przeladuj_widok(produkty_strona_id, produkty_strona_nazwa);
			
			wyswitl_powiadomienie('Zmiany zostały wprowadzone!!!', 1, 0);
			
			zeruj_licznik_sesji_po_wykonaniu_funkcji();
		}).fail(function(ajaxContext) {
			document.getElementById("body_strona_r").innerHTML = ajaxContext.responseText ;
		});
		
	});
}

function produkty_z_kategori_szczegoly_produktu(){
	$('.produkty_z_kategori_pojedyncza_podglad').click(function(){
		produkty_z_kategori_zablokuj_edycje();
		
		var produkty_z_kategori_id = $(this).data('produkty_z_kategori_pojedyncza_id');
		
		$.ajax({
			method: "POST",
			url: "ajax/widoki/ajax_produkty_z_kategori_szczegoly_produktu",
			data: {
				produkty_z_kategori_id : produkty_z_kategori_id
			}
			
		}).done(function(html){
						
			document.getElementById("szczegoly_produktu").innerHTML = html ;
			$('#szczegoly_produktu').show();
			
			$('.szczegoly_produktu_tlo').addClass('wyswietl_okno_produktu');
			$('.szczegoly_produktu_przod').addClass('wyswietl_okno_produktu');
			
			produkty_z_kategori_szczegoly_produktu_zamknij();
			pobierz_produkt();
			produkty_z_kategori_szczegoly_produktu_zmien_zakladke();
			uzytkownik_grupy_pojedyncza_kratka_zaznaczanie();
			produkty_uzytkownicy_usun();
			produkty_z_kategori_szczegoly_lista_wszystkich_uzytkownikow();
			produkty_z_kategori_szczegoly_produktu_lista_wszystkich_uzytkownikow_zamknij();
			lista_wszystkich_uzytkownikow_rozwin_liste();
			lista_wszystkich_uzytkownikow_szukaj();
			lista_uzytkownikow_dla_grupy_dodaj_uprawnienie();
			
			zeruj_licznik_sesji_po_wykonaniu_funkcji();
		}).fail(function(ajaxContext) {			
			document.getElementById("body_strona_r").innerHTML = ajaxContext.responseText ;
		});
		
	});
	
	$('.produkty_z_kategori_pojedyncza_nazwa_nazwa').click(function(){
		produkty_z_kategori_zablokuj_edycje();
		
		var produkty_z_kategori_id = $(this).data('produkty_z_kategori_pojedyncza_id');
		
		$.ajax({
			method: "POST",
			url: "ajax/widoki/ajax_produkty_z_kategori_szczegoly_produktu",
			data: {
				produkty_z_kategori_id : produkty_z_kategori_id
			}
			
		}).done(function(html){
						
			document.getElementById("szczegoly_produktu").innerHTML = html ;
			$('#szczegoly_produktu').show();
			
			$('.szczegoly_produktu_tlo').addClass('wyswietl_okno_produktu');
			$('.szczegoly_produktu_przod').addClass('wyswietl_okno_produktu');
			
			produkty_z_kategori_szczegoly_produktu_zamknij();
			pobierz_produkt();
			produkty_z_kategori_szczegoly_produktu_zmien_zakladke();
			uzytkownik_grupy_pojedyncza_kratka_zaznaczanie();
			produkty_uzytkownicy_usun();
			produkty_z_kategori_szczegoly_lista_wszystkich_uzytkownikow();
			produkty_z_kategori_szczegoly_produktu_lista_wszystkich_uzytkownikow_zamknij();
			lista_wszystkich_uzytkownikow_rozwin_liste();
			lista_wszystkich_uzytkownikow_szukaj();
			lista_uzytkownikow_dla_grupy_dodaj_uprawnienie();
			
			zeruj_licznik_sesji_po_wykonaniu_funkcji();
		}).fail(function(ajaxContext) {			
			document.getElementById("body_strona_r").innerHTML = ajaxContext.responseText ;
		});
		
	});
}

function produkty_uzytkownicy_usun(){
	$('.dup_el_usun').click(function(){
		$(this).parent().slideUp(function(){
			$(this).remove();
		});
		
		var produkty_id = $('.szczegoly_produktu_przod_belka_top_tytul').data('szczegoly_produktu_id');
		var uzytkownik_id = $(this).data('uzytkownik_id');
			
		$.ajax({
			method: "POST",
			url: "ajax/akcje/ajax_produkty_uzytkownicy_usun",
			data: {
				produkty_id : produkty_id,
				uzytkownik_id : uzytkownik_id
			}
			
		}).done(function(){
			
			//alert(html);
			
			
			
			wyswitl_powiadomienie('Usunięto uprawnienie dla użytkownika!!!', 1, 0);
			
			zeruj_licznik_sesji_po_wykonaniu_funkcji();
		}).fail(function(ajaxContext) {			
			document.getElementById("body_strona_r").innerHTML = ajaxContext.responseText ;
		});
		
	});
}

function produkty_grupa_uzytkownicy_usun(){
	$('.dup_el_usun').click(function(){
		$(this).parent().slideUp(function(){
			$(this).remove();
		});
		
		var produkty_id = $('.szczegoly_produktu_przod_belka_top_tytul').data('element_id');
		var uzytkownik_id = $(this).data('uzytkownik_id');
			
		$.ajax({
			method: "POST",
			url: "ajax/akcje/ajax_produkty_grupa_uzytkownicy_usun",
			data: {
				produkty_id : produkty_id,
				uzytkownik_id : uzytkownik_id
			}
			
		}).done(function(){
			
			//alert(html);
			
			
			
			wyswitl_powiadomienie('Usunięto uprawnienie dla użytkownika!!!', 1, 0);
			
			zeruj_licznik_sesji_po_wykonaniu_funkcji();
		}).fail(function(ajaxContext) {			
			document.getElementById("body_strona_r").innerHTML = ajaxContext.responseText ;
		});
		
	});
}

function produkty_kategoria_uzytkownicy_usun(){
	$('.dup_el_usun').click(function(){
		$(this).parent().slideUp(function(){
			$(this).remove();
		});
		
		var produkty_id = $('.szczegoly_produktu_przod_belka_top_tytul').data('element_id');
		var uzytkownik_id = $(this).data('uzytkownik_id');
			
		$.ajax({
			method: "POST",
			url: "ajax/akcje/ajax_produkty_kategoria_uzytkownicy_usun",
			data: {
				produkty_id : produkty_id,
				uzytkownik_id : uzytkownik_id
			}
			
		}).done(function(){
			
			//alert(html);
			
			
			
			wyswitl_powiadomienie('Usunięto uprawnienie dla użytkownika!!!', 1, 0);
			
			zeruj_licznik_sesji_po_wykonaniu_funkcji();
		}).fail(function(ajaxContext) {			
			document.getElementById("body_strona_r").innerHTML = ajaxContext.responseText ;
		});
		
	});
}

function uzytkownik_grupy_pojedyncza_kratka_zaznaczanie(){
	$('.uzytkownik_grupy_pojedyncza_kratka').click(function(){
		var produkty_id = $('.szczegoly_produktu_przod_belka_top_tytul').data('szczegoly_produktu_id');
		var uzytkownik_grupa_id = $(this).data('produkty_grupy_id');
		
		
		
		if($(this).hasClass('zaznaczone')){
			$(this).removeClass('zaznaczone');
			
			aktualizuj_produkty_grupy('usun' , produkty_id, uzytkownik_grupa_id);
			
		}else{
			$(this).addClass('zaznaczone');
			aktualizuj_produkty_grupy('dodaj' , produkty_id, uzytkownik_grupa_id);
		}
	});
}

function produkty_grupa_uzytkownik_grupy_pojedyncza_kratka_zaznaczanie(){
	$('.uzytkownik_grupy_pojedyncza_kratka').click(function(){
		var produkty_id = $('.szczegoly_produktu_przod_belka_top_tytul').data('element_id');
		var uzytkownik_grupa_id = $(this).data('produkty_grupy_id');
		
		
		
		if($(this).hasClass('zaznaczone')){
			$(this).removeClass('zaznaczone');
			
			produkty_grupa_aktualizuj_produkty_grupy('usun' , produkty_id, uzytkownik_grupa_id);
			
		}else{
			$(this).addClass('zaznaczone');
			produkty_grupa_aktualizuj_produkty_grupy('dodaj' , produkty_id, uzytkownik_grupa_id);
		}
	});
}

function produkty_kategoria_uzytkownik_grupy_pojedyncza_kratka_zaznaczanie(){
	$('.uzytkownik_grupy_pojedyncza_kratka').click(function(){
		var produkty_id = $('.szczegoly_produktu_przod_belka_top_tytul').data('element_id');
		var uzytkownik_grupa_id = $(this).data('produkty_grupy_id');
		
		
		
		if($(this).hasClass('zaznaczone')){
			$(this).removeClass('zaznaczone');
			
			produkty_kategoria_aktualizuj_produkty_grupy('usun' , produkty_id, uzytkownik_grupa_id);
			
		}else{
			$(this).addClass('zaznaczone');
			produkty_kategoria_aktualizuj_produkty_grupy('dodaj' , produkty_id, uzytkownik_grupa_id);
		}
	});
}

function aktualizuj_produkty_grupy(akcja , produktyid, uzytkownikgrupaid){
		
	$.ajax({
		method: "POST",
		url: "ajax/akcje/ajax_aktualizuj_produkty_grupy",
		data: {
			akcja : akcja,
			produkty_id : produktyid,
			uzytkownik_grupa_id : uzytkownikgrupaid
		}
		
	}).done(function(){
		
		//alert(html);
				
		wyswitl_powiadomienie('Zakualizowano uprawnienia dla grupy!!!', 1, 0);
		
		zeruj_licznik_sesji_po_wykonaniu_funkcji();
	}).fail(function(ajaxContext) {			
		document.getElementById("body_strona_r").innerHTML = ajaxContext.responseText ;
	});
}

function produkty_grupa_aktualizuj_produkty_grupy(akcja , produktyid, uzytkownikgrupaid){
	
	$.ajax({
		method: "POST",
		url: "ajax/akcje/ajax_produkty_grupa_aktualizuj_produkty_grupy",
		data: {
			akcja : akcja,
			produkty_id : produktyid,
			uzytkownik_grupa_id : uzytkownikgrupaid
		}
		
	}).done(function(){
		
		//alert(html);
				
		wyswitl_powiadomienie('Zakualizowano uprawnienia dla grupy!!!', 1, 0);
		
		zeruj_licznik_sesji_po_wykonaniu_funkcji();
	}).fail(function(ajaxContext) {			
		document.getElementById("body_strona_r").innerHTML = ajaxContext.responseText ;
	});
}

function produkty_kategoria_aktualizuj_produkty_grupy(akcja , produktyid, uzytkownikgrupaid){
	
	$.ajax({
		method: "POST",
		url: "ajax/akcje/ajax_produkty_kategoria_aktualizuj_produkty_grupy",
		data: {
			akcja : akcja,
			produkty_id : produktyid,
			uzytkownik_grupa_id : uzytkownikgrupaid
		}
		
	}).done(function(){
		
		//alert(html);
				
		wyswitl_powiadomienie('Zakualizowano uprawnienia dla grupy!!!', 1, 0);
		
		zeruj_licznik_sesji_po_wykonaniu_funkcji();
	}).fail(function(ajaxContext) {			
		document.getElementById("body_strona_r").innerHTML = ajaxContext.responseText ;
	});
}

function produkty_z_kategori_szczegoly_produktu_zamknij(){
	$('.szczegoly_produktu_tlo').click(function(){
		$('.szczegoly_produktu_tlo').removeClass('wyswietl_okno_produktu');
		$('.szczegoly_produktu_przod').removeClass('wyswietl_okno_produktu');
		//$('#szczegoly_produktu').hide();
		$('.szczegoly_produktu_tlo').remove();
		$('.szczegoly_produktu_przod').remove();
		$('.lista_wszystkich_uzytkownikow').remove();
		zeruj_licznik_sesji_po_wykonaniu_funkcji();
	});
	
	$('.szczegoly_produktu_zamknij').click(function(){
		$('.szczegoly_produktu_tlo').removeClass('wyswietl_okno_produktu');
		$('.szczegoly_produktu_przod').removeClass('wyswietl_okno_produktu');
		//$('#szczegoly_produktu').hide();
		$('.szczegoly_produktu_tlo').remove();
		$('.szczegoly_produktu_przod').remove();
		$('.lista_wszystkich_uzytkownikow').remove();
		zeruj_licznik_sesji_po_wykonaniu_funkcji();
	});
}

function produkty_z_kategori_szczegoly_produktu_lista_wszystkich_uzytkownikow_zamknij(){
	$('.lista_wszystkich_uzytkownikow').click(function(){
		$('.lista_wszystkich_uzytkownikow').removeClass('wyswietl_okno_produktu');
		$('.lista_wszystkich_uzytkownikow_przod').removeClass('wyswietl_okno_produktu');
		zeruj_licznik_sesji_po_wykonaniu_funkcji();
	});
	
	$('.lista_wszystkich_uzytkownikow_zamknij').click(function(){
		$('.lista_wszystkich_uzytkownikow').removeClass('wyswietl_okno_produktu');
		$('.lista_wszystkich_uzytkownikow_przod').removeClass('wyswietl_okno_produktu');
		zeruj_licznik_sesji_po_wykonaniu_funkcji();
	});
}

function pobierz_produkt(){
	$('.szczegoly_produktu_pobierz_d').click(function(){
		var nazwa_pliku = $(this).data('szczegoly_produktu_nazwa');
		var produkt_id = $(this).data('szczegoly_produktu_id');
		var liczba_p = $(this).data('szczegoly_produktu_p');
		
		
		
		
		
		var downloadLink = document.createElement("a");
		
		
		
		if($(this).hasClass('zapisz_plik_z_archwum')){
			
			downloadLink.href = 'pobierz_produkt?id_d='+produkt_id+'&nazwa='+nazwa_pliku+'&liczba_p='+liczba_p+'&arch=1';
			liczba_p = liczba_p+1;
			$(this).prev('.dzkap_p').text(liczba_p);
			$(this).data('szczegoly_produktu_p',liczba_p);
			$(this).attr('data-szczegoly_produktu_p',liczba_p);
		}else{
			
			downloadLink.href = 'pobierz_produkt?id_d='+produkt_id+'&nazwa='+nazwa_pliku+'&liczba_p='+liczba_p+'&arch=0';
			liczba_p = liczba_p+1;
			$('.liczba_pobran').text(liczba_p);
			$('.szczegoly_produktu_pobierz').data('szczegoly_produktu_p',liczba_p);
			$('.szczegoly_produktu_pobierz').attr('data-szczegoly_produktu_p',liczba_p);
		}
		
		
		
		window.open(downloadLink.href);
	});
}

function produkty_z_kategori_szczegoly_produktu_zmien_zakladke(){
	$('.szczegoly_produktu_informacje_naglowki_przycisk').click(function(){
		
		$('.szczegoly_produktu_informacje_naglowki_przycisk').removeClass('aktywny_p');
		$(this).addClass('aktywny_p');
		
		var tresc = $(this).data('nazwa_tresci');
		
		$('.szczegoly_produktu_informacje_tresc_pojedyncza').removeClass('aktywny_t');
		$('#'+tresc).addClass('aktywny_t');
		
	});
}

function produkty_z_kategori_szczegoly_lista_wszystkich_uzytkownikow(){
	$('.produkty_uzytkownicy_dodaj_nowy').click(function(){
		$('.lista_wszystkich_uzytkownikow').addClass('wyswietl_okno_produktu');
		$('.lista_wszystkich_uzytkownikow_przod').addClass('wyswietl_okno_produktu');
	});
}

function lista_wszystkich_uzytkownikow_rozwin_liste(){
	$('.lwu_grupa_nazwa').click(function(){
		if($(this).hasClass('aktywna')){
			$(this).removeClass('aktywna');
			$(this).next('.lwu_grupa').slideUp();
		}else{
			$(this).addClass('aktywna');
			$(this).next('.lwu_grupa').slideDown();
		}
	});
}

function lista_wszystkich_uzytkownikow_szukaj(){
	/*	
	$('.lwu_pole_szukaj').blur(function(){
		$('.lista_wszystkich_uzytkownikow_pole_wyniki').slideUp(function(){
			$(this).remove();
		});
		
		$(this).val('');
		$(this).removeAttr('value');
		
	});
	*/
	$('.lwu_pole_szukaj').keyup(function(){
				
		var wartosc = $(this).val();
		
		if(wartosc != ''){
			$.ajax({
				method: "POST",
				url: "ajax/akcje/ajax_lista_wszystkich_uzytkownikow_szukaj",
				data: {
					wartosc : wartosc
				}
				
			}).done(function(html){
				document.getElementById("lista_wszystkich_uzytkownikow_pole_wyniki").innerHTML = html ;
				
				$('.lista_wszystkich_uzytkownikow_pole_wyniki').show();
				lista_uzytkownikow_dla_grupy_dodaj_uprawnienie();
				
				$('.lista_wszystkich_uzytkownikow_pole_wyniki_zwin').click(function(){
					$('.lista_wszystkich_uzytkownikow_pole_wyniki').slideUp(function(){
						$(this).remove();
						$('.lwu_pole_szukaj').val('');
						$('.lwu_pole_szukaj').removeAttr('value');
					});
				});
				
				zeruj_licznik_sesji_po_wykonaniu_funkcji();
			}).fail(function(ajaxContext) {			
				document.getElementById("body_strona_r").innerHTML = ajaxContext.responseText ;
			});
		}else{
			$('.lista_wszystkich_uzytkownikow_pole_wyniki').slideUp(function(){
				$(this).remove();
			});
		}
		
		
		
	});
}

function produkty_grupa_lista_wszystkich_uzytkownikow_szukaj(){
	/*	
	$('.lwu_pole_szukaj').blur(function(){
		$('.lista_wszystkich_uzytkownikow_pole_wyniki').slideUp(function(){
			$(this).remove();
		});
		
		$(this).val('');
		$(this).removeAttr('value');
		
	});
	*/
	$('.lwu_pole_szukaj').keyup(function(){
				
		var wartosc = $(this).val();
		
		if(wartosc != ''){
			$.ajax({
				method: "POST",
				url: "ajax/akcje/ajax_lista_wszystkich_uzytkownikow_szukaj",
				data: {
					wartosc : wartosc
				}
				
			}).done(function(html){
				document.getElementById("lista_wszystkich_uzytkownikow_pole_wyniki").innerHTML = html ;
				
				$('.lista_wszystkich_uzytkownikow_pole_wyniki').show();
				lista_uzytkownikow_dla_strona_grupa_dodaj_uprawnienie();
				
				$('.lista_wszystkich_uzytkownikow_pole_wyniki_zwin').click(function(){
					$('.lista_wszystkich_uzytkownikow_pole_wyniki').slideUp(function(){
						$(this).remove();
						$('.lwu_pole_szukaj').val('');
						$('.lwu_pole_szukaj').removeAttr('value');
					});
				});
				
				zeruj_licznik_sesji_po_wykonaniu_funkcji();
			}).fail(function(ajaxContext) {			
				document.getElementById("body_strona_r").innerHTML = ajaxContext.responseText ;
			});
		}else{
			$('.lista_wszystkich_uzytkownikow_pole_wyniki').slideUp(function(){
				$(this).remove();
			});
		}
		
		
		
	});
}

function produkty_kategoria_lista_wszystkich_uzytkownikow_szukaj(){
	/*	
	$('.lwu_pole_szukaj').blur(function(){
		$('.lista_wszystkich_uzytkownikow_pole_wyniki').slideUp(function(){
			$(this).remove();
		});
		
		$(this).val('');
		$(this).removeAttr('value');
		
	});
	*/
	$('.lwu_pole_szukaj').keyup(function(){
				
		var wartosc = $(this).val();
		
		if(wartosc != ''){
			$.ajax({
				method: "POST",
				url: "ajax/akcje/ajax_lista_wszystkich_uzytkownikow_szukaj",
				data: {
					wartosc : wartosc
				}
				
			}).done(function(html){
				document.getElementById("lista_wszystkich_uzytkownikow_pole_wyniki").innerHTML = html ;
				
				$('.lista_wszystkich_uzytkownikow_pole_wyniki').show();
				lista_uzytkownikow_dla_kategoria_grupa_dodaj_uprawnienie();
				
				$('.lista_wszystkich_uzytkownikow_pole_wyniki_zwin').click(function(){
					$('.lista_wszystkich_uzytkownikow_pole_wyniki').slideUp(function(){
						$(this).remove();
						$('.lwu_pole_szukaj').val('');
						$('.lwu_pole_szukaj').removeAttr('value');
					});
				});
				
				zeruj_licznik_sesji_po_wykonaniu_funkcji();
			}).fail(function(ajaxContext) {			
				document.getElementById("body_strona_r").innerHTML = ajaxContext.responseText ;
			});
		}else{
			$('.lista_wszystkich_uzytkownikow_pole_wyniki').slideUp(function(){
				$(this).remove();
			});
		}
		
		
		
	});
}

function lista_uzytkownikow_dla_grupy_dodaj_uprawnienie(){
	$('.lista_uzytkownikow_dla_grupy_dodaj_uprawnienie').click(function(){
				
		var produkt_id = $('.szczegoly_produktu_przod_belka_top_tytul').data('szczegoly_produktu_id');
		var uzytkownik_id = $(this).data('uzytkownik_id');
		
		//alert(produkt_id+' '+uzytkownik_id);
		
		$.ajax({
			method: "POST",
			url: "ajax/akcje/ajax_lista_uzytkownikow_dla_grupy_dodaj_uprawnienie",
			data: {
				produkt_id : produkt_id,
				uzytkownik_id : uzytkownik_id
			}
			
		}).done(function(data){
			
			var array = $.parseJSON(data);
			
			if(array[0] === '0'){
				wyswitl_powiadomienie('Wybrany użytkownik posiada uprawnienie do produktu!!!', 0, 0);
			}else{
				produkty_uzytkownicy_lista_dodanych(produkt_id);
				
				wyswitl_powiadomienie('Dodano uprawnienie dla użytkownika!!!', 1, 0);
			}
			
			zeruj_licznik_sesji_po_wykonaniu_funkcji();
		}).fail(function(ajaxContext) {			
			alert(ajaxContext.responseText) ;
		});
		
		$(this).parent().slideUp(function(){
			$(this).remove();
		});
				
	});
}

function produkty_uzytkownicy_lista_dodanych(produkt_id){
	$.ajax({
		method: "POST",
		url: "ajax/akcje/ajax_produkty_uzytkownicy_lista_dodanych",
		data : {
			produkt_id : produkt_id
		}
		
	}).done(function(html){
		document.getElementById("produkty_uzytkownicy_lista_dodanych").innerHTML = html ;
		produkty_uzytkownicy_usun();
		
		zeruj_licznik_sesji_po_wykonaniu_funkcji();
	}).fail(function(ajaxContext) {			
		alert(ajaxContext.responseText) ;
	});
}

function produkty_grupa_uzytkownicy_lista_dodanych(produkt_id){
	$.ajax({
		method: "POST",
		url: "ajax/akcje/ajax_produkty_grupa_uzytkownicy_lista_dodanych",
		data : {
			produkt_id : produkt_id
		}
		
	}).done(function(html){
		document.getElementById("produkty_uzytkownicy_lista_dodanych").innerHTML = html ;
		produkty_uzytkownicy_usun();
		
		zeruj_licznik_sesji_po_wykonaniu_funkcji();
	}).fail(function(ajaxContext) {			
		alert(ajaxContext.responseText) ;
	});
}

function produkty_kategoria_uzytkownicy_lista_dodanych(produkt_id){
	$.ajax({
		method: "POST",
		url: "ajax/akcje/ajax_produkty_kategoria_uzytkownicy_lista_dodanych",
		data : {
			produkt_id : produkt_id
		}
		
	}).done(function(html){
		document.getElementById("produkty_uzytkownicy_lista_dodanych").innerHTML = html ;
		produkty_uzytkownicy_usun();
		
		zeruj_licznik_sesji_po_wykonaniu_funkcji();
	}).fail(function(ajaxContext) {			
		alert(ajaxContext.responseText) ;
	});
}

/*kamyk 30-08-2016*/
function usun_produkt(){
	$('.produkty_z_kategori_pojedyncza_usun').click(function(){
		$(this).next().addClass('wysun');
	});
	
	$('.produkty_z_kategori_pojedyncza_usun_tak').click(function(){
		var produkt_id = $(this).data('id_element');
		
		var wiersz = $(this).parent().parent();
		
		$.ajax({
			method: "POST",
			url: "ajax/akcje/ajax_produkty_usun_produkt",
			data : {
				produkt_id : produkt_id
			}
			
		}).done(function(html){
			wiersz.slideUp(function(){
				$(this).remove();
			});
			
			zeruj_licznik_sesji_po_wykonaniu_funkcji();
		}).fail(function(ajaxContext) {			
			alert(ajaxContext.responseText) ;
		});
		
	});
}

/*kamyk 2016-08-31*/
function usun_kategorie(){
	$('.produkty_kategoria_usun').click(function(){
		$('.szczegoly_produktu_przod').find('.czy_jestes_pewnien').addClass('wysun');
	});
	
	$('.produkty_kategoria_usun_tak').click(function(){
		var kategoria_id = $(this).data('id_element');
		
		var strona_id = $('.element_do_wyboru.aktywny').data('strona_id');
		var strona_nazwa = $('.element_do_wyboru.aktywny').attr('title');
		var wiersz = $(this).parent().parent();
		
		$.ajax({
			method: "POST",
			url: "ajax/akcje/ajax_produkty_kategoria_usun",
			data : {
				kategoria_id : kategoria_id
			}
			
		}).done(function(html){
			
			$('.szczegoly_produktu_tlo').removeClass('wyswietl_okno_produktu');
			$('.szczegoly_produktu_przod').removeClass('wyswietl_okno_produktu');
			$('.szczegoly_produktu_tlo').remove();
			$('.szczegoly_produktu_przod').remove();
			$('.lista_wszystkich_uzytkownikow').remove();
			zeruj_licznik_sesji_po_wykonaniu_funkcji();
			
			produkty_kategoria_przeladuj_widok(strona_id, strona_nazwa);
			
			wyswitl_powiadomienie('Kategoria została usunięta!!!', 1, 0);
			
			zeruj_licznik_sesji_po_wykonaniu_funkcji();
		}).fail(function(ajaxContext) {			
			alert(ajaxContext.responseText) ;
		});
		
	});
}

function produkty_strona_usun(){
	$('.produkty_strona_edytuj_usun').click(function(){
		$('.czy_jestes_pewnien').toggleClass('wysun');
	});
	
	$('.produkty_strona_edytuj_usun_tak').click(function(){
		var produkty_strona_id = $('.szczegoly_produktu_przod_belka_top_tytul').data('element_id');
		
		//alert(produkty_strona_nr_kolejnosci+' '+produkty_strona_nazwa);
		
		wyswietl_loader();
		
		$.ajax({
			method: "POST",
			url: "ajax/akcje/ajax_produkty_strona_usun",
			data: {
				produkty_strona_id : produkty_strona_id
			}
			
		}).done(function(html){
			
			//alert(html);
			
			wyswitl_powiadomienie('Strona została usunięta!!!', 1, 1, 1000);		
			
		}).fail(function(ajaxContext) {			
			document.getElementById("body_strona_r").innerHTML = ajaxContext.responseText ;
		});
	});
}




