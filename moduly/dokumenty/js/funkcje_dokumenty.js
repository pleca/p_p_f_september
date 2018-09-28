$(document).ready(function(){
	
	dokumenty_rodzaj_widok();
	
	//$('.element_do_wyboru:first-child').addClass('aktywny');
	
	odblokuj_do_edycji_kategorie();
	odblokuj_pola_dokumenty_kategoria_dodaj_nowy();
	odblokuj_do_edycji_dokument_kategorii();
	dokumenty_z_kategori_dodaj_nowy_wiersz();
	dokumenty_strona_dodaj_nowy_zapisz();
	dokumenty_kategoria_dodaj_nowy_przycisk();
	edytuj_strona();
	
	dokumenty_kategoria_zapisz();
	dokumenty_z_kategori_szczegoly_dokumentu();
	dokumenty_z_kategori_pojedyncza_edytuj_zapisz();
	dokumenty_z_kategori_anuluj_edycje();
	
	/*kamyk 2016-08-30*/
	usun_dokument();
});

function dokumenty_rodzaj_widok(){
	$('.element_do_wyboru').click(function(){
		
		$('.element_do_wyboru').removeClass('aktywny');
		$(this).addClass('aktywny');
		$('.dokumenty_strona_edytuj').slideUp();
		
		var dokumenty_strona_id = $(this).data('strona_id');
		var dokumenty_strona_nazwa = $(this).attr('title');
		
		dokumenty_kategoria_przeladuj_widok(dokumenty_strona_id, dokumenty_strona_nazwa);
		
		
		
	});
} 

function odblokuj_do_edycji_kategorie(){
	$('.dokumenty_kategoria_edytuj').click(function(){
		
		
		var element_id = $(this).parent().data('dokumenty_kategoria_id');
		var tabelka = 'dokumenty_kategoria';
		
		$.ajax({
			method: "POST",
			url: "ajax/widoki/ajax_dokumenty_edytuj_grupe_kategorie",
			data: {
				element_id : element_id,
				tabelka : tabelka
			}
			
		}).done(function(html){
			document.getElementById("szczegoly_dokumentu").innerHTML = html ;
			
			$('#szczegoly_dokumentu').show();
			
			$('.szczegoly_dokumentu_tlo').addClass('wyswietl_okno_dokumentu');
			$('.szczegoly_dokumentu_przod').addClass('wyswietl_okno_dokumentu');
			
			dokumenty_z_kategori_szczegoly_dokumentu_zamknij();
			
			dokumenty_z_kategori_szczegoly_lista_wszystkich_uzytkownikow();
			dokumenty_z_kategori_szczegoly_dokumentu_lista_wszystkich_uzytkownikow_zamknij();
			
			lista_wszystkich_uzytkownikow_rozwin_liste();
			dokumenty_kategoria_lista_wszystkich_uzytkownikow_szukaj();
			
			lista_uzytkownikow_dla_kategoria_grupa_dodaj_uprawnienie();
			
			dokumenty_kategoria_uzytkownicy_usun();
			
			dokumenty_kategoria_zapisz();
			
			dokumenty_kategoria_uzytkownik_grupy_pojedyncza_kratka_zaznaczanie();
						
			usun_kategorie();
			
			zeruj_licznik_sesji_po_wykonaniu_funkcji();		
		}).fail(function(ajaxContext) {			
			document.getElementById("body_strona_r").innerHTML = ajaxContext.responseText ;
		});
		
	});
}

function lista_uzytkownikow_dla_kategoria_grupa_dodaj_uprawnienie(){
	$('.lista_uzytkownikow_dla_kategoria_grupa_dodaj_uprawnienie').click(function(){
				
		var dokument_id = $('.szczegoly_dokumentu_przod_belka_top_tytul').data('element_id');
		var uzytkownik_id = $(this).data('uzytkownik_id');
		
		//alert(dokument_id+' '+uzytkownik_id);
		
		$.ajax({
			method: "POST",
			url: "ajax/akcje/ajax_lista_uzytkownikow_dla_kategoria_grupa_dodaj_uprawnienie",
			data: {
				dokument_id : dokument_id,
				uzytkownik_id : uzytkownik_id
			}
			
		}).done(function(data){
			
			var array = $.parseJSON(data);
			
			if(array[0] === '0'){
				wyswitl_powiadomienie('Wybrany użytkownik posiada uprawnienie do grupy!!!', 0, 0);
			}else{
				dokumenty_kategoria_uzytkownicy_lista_dodanych(dokument_id);
				
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

function odblokuj_pola_dokumenty_kategoria_dodaj_nowy(){
	$('.dokumenty_kategoria_dodaj_nowy_przycisk').click(function(){
		$('.dokumenty_strona_nazwa').css('width', '405px');
		$('.dokumenty_kategoria_dodaj_nowy_nr_kolejnosci').show();
		$('.dokumenty_kategoria_dodaj_nowy_nazwa').show();
		
		$(this).hide();
		$('.dokumenty_kategoria_dodaj_nowy_zapisz').show();
	});
}

function odblokuj_do_edycji_dokument_kategorii(){
	$('.dokumenty_z_kategori_pojedyncza_edytuj').click(function(){
			dokumenty_z_kategori_zablokuj_edycje();
		
			$(this).parent().find('.dokumenty_z_kategori_pojedyncza_zapisz').show();
			$(this).hide();
			$(this).parent().find('.dokumenty_z_kategori_pojedyncza_podglad').hide();
			$(this).parent().find('.dokumenty_z_kategori_pojedyncza_nazwa_nazwa').hide();
			
			$(this).parent().find('.dokumenty_z_kategori_pojedyncza_nr_kolejnosci').addClass('do_edycji');
			$(this).parent().find('.dokumenty_z_kategori_pojedyncza_nazwa').addClass('do_edycji');
			$(this).parent().find('.dokumenty_z_kategori_pojedyncza_opis').addClass('do_edycji');
			$(this).parent().find('.dokumenty_z_kategori_pojedyncza_plik').addClass('do_edycji');
			$(this).parent().find('.dokumenty_z_kategori_pojedyncza_anuluj_edytuj').show();
		
		
		
	});
}

function dokumenty_z_kategori_anuluj_edycje(){
	$('.dokumenty_z_kategori_pojedyncza_anuluj_edytuj').click(function(){
		dokumenty_z_kategori_zablokuj_edycje();	
	});
}

function dokumenty_z_kategori_zablokuj_edycje(){
	$('.dokumenty_z_kategori_pojedyncza_zapisz').hide();
	$('.dokumenty_z_kategori_pojedyncza_edytuj').show();
	$('.dokumenty_z_kategori_pojedyncza_podglad').show();
	$('.dokumenty_z_kategori_pojedyncza_nazwa_nazwa').show();
	
	$('.dokumenty_z_kategori_pojedyncza_nr_kolejnosci').removeClass('do_edycji');
	$('.dokumenty_z_kategori_pojedyncza_nazwa').removeClass('do_edycji');
	$('.dokumenty_z_kategori_pojedyncza_opis').removeClass('do_edycji');
	$('.dokumenty_z_kategori_pojedyncza_plik').removeClass('do_edycji');
	$('.dokumenty_z_kategori_pojedyncza_anuluj_edytuj').hide();
}

function dokumenty_z_kategori_dodaj_nowy_wiersz(){
	$('.dokumenty_z_kategori_dodaj_nowy').click(function(){
		dokumenty_z_kategori_zablokuj_edycje();
		
		var e1 = '<input class="dokumenty_z_kategori_pojedyncza_nr_kolejnosci nowy" type="text" value="" placeholder="Nr" />';
		var e2 = '<input class="dokumenty_z_kategori_pojedyncza_nazwa nowy" type="text" value="" placeholder="Nazwa dokumentu" />';
		var e6 = '<input class="dokumenty_z_kategori_pojedyncza_plik nowy" type="file" name="" />';
		var e3 = '<span style="display:block" class="dokumenty_z_kategori_pojedyncza_zapisz_nowy " ></span>';
		var e4 = '<span class="dokumenty_z_kategori_pojedyncza_usun dzkpu_wiersz_n" ></span>';
		var e5 = '<div class="clear_b"></div>';
		var e7 = '<textarea class="dokumenty_z_kategori_pojedyncza_opis" placeholder="Opis dokumentu"></textarea>';
		
		var wiersz = '<div style="display:none" class="dokumenty_z_kategori_pojedyncza dokumenty_z_kategori_nowa">'+e1+e2+e6+e3+e4+e7+e5+'</div>';
				
		
		$(this).prev().append(wiersz);
		$(this).prev().find('.dokumenty_z_kategori_pojedyncza:last').slideDown();	
		
		dokumenty_z_kategori_usun_nowy_wiersz();
		dokumenty_z_kategori_pojedyncza_zapisz_nowy();
		aktualizuj_value_input_texarea();
		
		$('.dokumenty_z_kategori_dodaj_nowy').slideUp();
	});
}

function dokumenty_z_kategori_usun_nowy_wiersz(){
	$('.dzkpu_wiersz_n').click(function(){				
		$(this).parent().slideUp(function(){
			$(this).remove();
			
		});	
		$('.dokumenty_z_kategori_dodaj_nowy').slideDown();
	});
}

function dokumenty_strona_dodaj_nowy_zapisz(){
	$('.dokumenty_strona_dodaj_nowy_zapisz').click(function(){
		var dokumenty_strona_nr_kolejnosci = $('.dokumenty_strona_dodaj_nowy_nr_kolejnosci').val();
		var dokumenty_strona_nazwa = $('.dokumenty_strona_dodaj_nowy_nazwa').val();
		
		if(dokumenty_strona_nazwa == ''){
			wyswitl_powiadomienie('Uzupełnij nazwe rodzaju dokumentu!!!', 0, 0);	
			return false;
		}
		
		if(dokumenty_strona_nr_kolejnosci == ''){
			dokumenty_strona_nr_kolejnosci = '0';
		}
		
		//alert(dokumenty_strona_nr_kolejnosci+' '+dokumenty_strona_nazwa);
		
		wyswietl_loader();
		
		$.ajax({
			method: "POST",
			url: "ajax/akcje/ajax_dokumenty_strona_dodaj_nowy",
			data: {
				dokumenty_strona_nr_kolejnosci : dokumenty_strona_nr_kolejnosci,
				dokumenty_strona_nazwa : dokumenty_strona_nazwa
			}
			
		}).done(function(html){
			
			//alert(html);
			
			wyswitl_powiadomienie('Dodano stronę do bazy!!!', 1, 1, 1000);		
			
		}).fail(function(ajaxContext) {			
			document.getElementById("body_strona_r").innerHTML = ajaxContext.responseText ;
		});
	});
}

function dokumenty_kategoria_dodaj_nowy_przycisk(){
	$('.dokumenty_kategoria_dodaj_nowy_zapisz').click(function(){
		var dokumenty_kategoria_nr_kolejnosci = $('.dokumenty_kategoria_dodaj_nowy_nr_kolejnosci').val();
		var dokumenty_kategoria_nazwa = $('.dokumenty_kategoria_dodaj_nowy_nazwa').val();
		var dokumenty_strona_id = $('.dokumenty_strona_kategorii_opcje').data('strona_id');
		var dokumenty_strona_nazwa = $('.dokumenty_strona_nazwa').data('strona_nazwa');
				
		if(dokumenty_kategoria_nazwa == ''){
			wyswitl_powiadomienie('Uzupełnij nazwe kategorii dokumentu!!!', 0, 0);	
			return false;
		}
		
		if(dokumenty_kategoria_nr_kolejnosci == ''){
			dokumenty_kategoria_nr_kolejnosci = '0';
		}
		
		//wyswietl_loader();
		
		$.ajax({
			method: "POST",
			url: "ajax/akcje/ajax_dokumenty_kategoria_dodaj_nowy",
			data: {
				dokumenty_kategoria_nr_kolejnosci : dokumenty_kategoria_nr_kolejnosci,
				dokumenty_kategoria_nazwa : dokumenty_kategoria_nazwa,
				dokumenty_strona_id : dokumenty_strona_id
			}
			
		}).done(function(html){
			
			dokumenty_kategoria_przeladuj_widok(dokumenty_strona_id, dokumenty_strona_nazwa);
			
			wyswitl_powiadomienie('Dodano Kategorię do bazy!!!', 1, 0);		
			
		}).fail(function(ajaxContext) {			
			document.getElementById("body_strona_r").innerHTML = ajaxContext.responseText ;
		});
	});
}


function dokumenty_kategoria_przeladuj_widok(strona_id, strona_nazwa){
	$.ajax({
		method: "POST",
		url: "ajax/widoki/ajax_dokumenty_strona",
		data: {
			dokumenty_strona_id : strona_id,
			dokumenty_strona_nazwa : strona_nazwa
		}
		
	}).done(function(html){
		document.getElementById("body_strona_r").innerHTML = html ;
		odblokuj_do_edycji_kategorie();
		odblokuj_pola_dokumenty_kategoria_dodaj_nowy();
		odblokuj_do_edycji_dokument_kategorii();
		dokumenty_z_kategori_dodaj_nowy_wiersz();
		dokumenty_kategoria_dodaj_nowy_przycisk();
		dokumenty_kategoria_zapisz();
		dokumenty_z_kategori_szczegoly_dokumentu();
		dokumenty_z_kategori_pojedyncza_edytuj_zapisz();
		dokumenty_z_kategori_anuluj_edycje();
		
		/*kamyk 2016-08-30*/
		usun_dokument();
		
		zeruj_licznik_sesji_po_wykonaniu_funkcji();		
	}).fail(function(ajaxContext) {			
		document.getElementById("body_strona_r").innerHTML = ajaxContext.responseText ;
	});
}

function edytuj_strona(){
	$('.edytuj_strona').click(function(){
		
		var element_id = $(this).parent().data('strona_id');
		var tabelka = 'dokumenty_strona';
		
		$.ajax({
			method: "POST",
			url: "ajax/widoki/ajax_dokumenty_edytuj_grupe_kategorie",
			data: {
				element_id : element_id,
				tabelka : tabelka
			}
			
		}).done(function(html){
			document.getElementById("szczegoly_dokumentu").innerHTML = html ;
			
			$('#szczegoly_dokumentu').show();
			
			$('.szczegoly_dokumentu_tlo').addClass('wyswietl_okno_dokumentu');
			$('.szczegoly_dokumentu_przod').addClass('wyswietl_okno_dokumentu');
			
			dokumenty_z_kategori_szczegoly_dokumentu_zamknij();
			
			dokumenty_strona_edytuj_zapisz();
			dokumenty_strona_usun();
			
			dokumenty_z_kategori_szczegoly_lista_wszystkich_uzytkownikow();
			dokumenty_z_kategori_szczegoly_dokumentu_lista_wszystkich_uzytkownikow_zamknij();
			
			lista_wszystkich_uzytkownikow_rozwin_liste();
			dokumenty_grupa_lista_wszystkich_uzytkownikow_szukaj();
			
			lista_uzytkownikow_dla_strona_grupa_dodaj_uprawnienie();
			
			dokumenty_grupa_uzytkownik_grupy_pojedyncza_kratka_zaznaczanie();
			
			dokumenty_grupa_uzytkownicy_usun();
			
			
			
			zeruj_licznik_sesji_po_wykonaniu_funkcji();		
		}).fail(function(ajaxContext) {			
			document.getElementById("body_strona_r").innerHTML = ajaxContext.responseText ;
		});
				
	});
}

function lista_uzytkownikow_dla_strona_grupa_dodaj_uprawnienie(){
	$('.lista_uzytkownikow_dla_strona_grupa_dodaj_uprawnienie').click(function(){
				
		var dokument_id = $('.szczegoly_dokumentu_przod_belka_top_tytul').data('element_id');
		var uzytkownik_id = $(this).data('uzytkownik_id');
		
		//alert(dokument_id+' '+uzytkownik_id);
		
		$.ajax({
			method: "POST",
			url: "ajax/akcje/ajax_lista_uzytkownikow_dla_strona_grupa_dodaj_uprawnienie",
			data: {
				dokument_id : dokument_id,
				uzytkownik_id : uzytkownik_id
			}
			
		}).done(function(data){
			
			var array = $.parseJSON(data);
			
			if(array[0] === '0'){
				wyswitl_powiadomienie('Wybrany użytkownik posiada uprawnienie do grupy!!!', 0, 0);
			}else{
				dokumenty_grupa_uzytkownicy_lista_dodanych(dokument_id);
				
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

function dokumenty_strona_edytuj_zapisz(){
	$('.dokumenty_strona_edytuj_zapisz').click(function(){
		var dokumenty_strona_nr_kolejnosci = $(this).parent().find('.dokumenty_strona_edytuj_nr_kolejnosci').val();
		var dokumenty_strona_nazwa = $(this).parent().find('.dokumenty_strona_edytuj_nazwa').val();
		var dokumenty_strona_id = $(this).parent().data('strona_id');
		
		//alert(dokumenty_strona_nr_kolejnosci+' '+dokumenty_strona_nazwa);
		
		if(dokumenty_strona_nazwa == ''){
			wyswitl_powiadomienie('Uzupełnij nazwe rodzaju dokumentu!!!', 0, 0);	
			return false;
		}
		
		if(dokumenty_strona_nr_kolejnosci == ''){
			dokumenty_strona_nr_kolejnosci = '0';
		}
		
		wyswietl_loader();
		
		$.ajax({
			method: "POST",
			url: "ajax/akcje/ajax_dokumenty_strona_edytuj",
			data: {
				dokumenty_strona_nr_kolejnosci : dokumenty_strona_nr_kolejnosci,
				dokumenty_strona_nazwa : dokumenty_strona_nazwa,
				dokumenty_strona_id : dokumenty_strona_id
			}
			
		}).done(function(html){
			
			//alert(html);
			
			wyswitl_powiadomienie('Zmiany zostały zapisane!!!', 1, 1, 1000);		
			
		}).fail(function(ajaxContext) {			
			document.getElementById("body_strona_r").innerHTML = ajaxContext.responseText ;
		});
	});
}



function dokumenty_kategoria_zapisz(){
	$('.dokumenty_strona_edytuj_zapisz').click(function(){
		var dokumenty_kategoria_nr_kolejnosci = $(this).parent().find('.dokumenty_strona_edytuj_nr_kolejnosci').val();
		var dokumenty_kategoria_nazwa = $(this).parent().find('.dokumenty_strona_edytuj_nazwa').val();
		var dokumenty_kategoria_id = $(this).parent().data('strona_id');
		var dokumenty_strona_id = $('.dokumenty_strona_kategorii_opcje').data('strona_id');
		var dokumenty_strona_nazwa = $('.dokumenty_strona_nazwa').data('strona_nazwa');
		
		if(dokumenty_kategoria_nazwa == ''){
			wyswitl_powiadomienie('Uzupełnij nazwe kategorii dokumentu!!!', 0, 0);	
			return false;
		}
		
		if(dokumenty_kategoria_nr_kolejnosci == ''){
			dokumenty_kategoria_nr_kolejnosci = '0';
		}
		
		if(dokumenty_kategoria_id == ''){
			wyswitl_powiadomienie('Brak elementu do edycji!!!', 0, 0);	
			return false;
		}
		
		$.ajax({
			method: "POST",
			url: "ajax/akcje/ajax_dokumenty_kategoria_edytuj",
			data: {
				dokumenty_kategoria_nr_kolejnosci : dokumenty_kategoria_nr_kolejnosci,
				dokumenty_kategoria_nazwa : dokumenty_kategoria_nazwa,
				dokumenty_kategoria_id : dokumenty_kategoria_id
			}
			
		}).done(function(html){
						
			dokumenty_kategoria_przeladuj_widok(dokumenty_strona_id, dokumenty_strona_nazwa);
			
			wyswitl_powiadomienie('Zmiany zostały zapisane!!!', 1, 0);		
			
			$('.szczegoly_dokumentu_tlo').removeClass('wyswietl_okno_dokumentu');
			$('.szczegoly_dokumentu_przod').removeClass('wyswietl_okno_dokumentu');
			//$('#szczegoly_dokumentu').hide();
			$('.szczegoly_dokumentu_tlo').remove();
			$('.szczegoly_dokumentu_przod').remove();
			$('.lista_wszystkich_uzytkownikow').remove();
			zeruj_licznik_sesji_po_wykonaniu_funkcji();
			
			zeruj_licznik_sesji_po_wykonaniu_funkcji();
		}).fail(function(ajaxContext) {			
			document.getElementById("body_strona_r").innerHTML = ajaxContext.responseText ;
		});
		
	});
}

function dokumenty_z_kategori_pojedyncza_zapisz_nowy(){
	$('.dokumenty_z_kategori_pojedyncza_zapisz_nowy').click(function(){
		var dokumenty_z_kategori_nr_kolejnosci = $(this).parent('.dokumenty_z_kategori_nowa').find('.dokumenty_z_kategori_pojedyncza_nr_kolejnosci').val();
		var dokumenty_z_kategori_nazwa = $(this).parent('.dokumenty_z_kategori_nowa').find('.dokumenty_z_kategori_pojedyncza_nazwa').val();
		var dokumenty_z_kategori_plik = $(this).parent('.dokumenty_z_kategori_nowa').find('.dokumenty_z_kategori_pojedyncza_plik')[0].files[0];
		var dokumenty_z_kategori_opis = $(this).parent('.dokumenty_z_kategori_nowa').find('.dokumenty_z_kategori_pojedyncza_opis').val();
		var dokumenty_kategoria_id = $(this).parent().parent().parent().find('.dokumenty_kategoria_pojedyncza_naglowek').data('dokumenty_kategoria_id');
		
		var dokumenty_strona_id = $('.dokumenty_strona_kategorii_opcje').data('strona_id');
		var dokumenty_strona_nazwa = $('.dokumenty_strona_nazwa').data('strona_nazwa');
				
		var formData = new FormData();
		
		formData.append('dokumenty_z_kategori_nr_kolejnosci', dokumenty_z_kategori_nr_kolejnosci);
		formData.append('dokumenty_z_kategori_nazwa', dokumenty_z_kategori_nazwa);	
		formData.append('dokumenty_z_kategori_plik', dokumenty_z_kategori_plik);	
		formData.append('dokumenty_z_kategori_opis', dokumenty_z_kategori_opis);	
		formData.append('dokumenty_kategoria_id', dokumenty_kategoria_id);
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
			url: "ajax/akcje/ajax_dokumenty_z_kategori_dodaj_nowy",
			data: formData,
            contentType: false,
            processData: false
			
		}).done(function(data){
									
			//alert(data);
			
			ukryj_loader();
			$('.postep_pasek').css('width','0%');
			
			dokumenty_kategoria_przeladuj_widok(dokumenty_strona_id, dokumenty_strona_nazwa);
			
			wyswitl_powiadomienie('Dokument został dodany!!!', 1, 0);
			
			zeruj_licznik_sesji_po_wykonaniu_funkcji();
		}).fail(function(ajaxContext) {
			document.getElementById("body_strona_r").innerHTML = ajaxContext.responseText ;
		});
		
	});
}

function dokumenty_z_kategori_pojedyncza_edytuj_zapisz(){
	$('.dokumenty_z_kategori_pojedyncza_zapisz').click(function(){
		var dokumenty_z_kategori_nr_kolejnosci = $(this).parent('.dokumenty_z_kategori_pojedyncza').find('.dokumenty_z_kategori_pojedyncza_nr_kolejnosci').val();
		var dokumenty_z_kategori_nazwa = $(this).parent('.dokumenty_z_kategori_pojedyncza').find('.dokumenty_z_kategori_pojedyncza_nazwa').val();
		var dokumenty_z_kategori_plik = $(this).parent('.dokumenty_z_kategori_pojedyncza').find('.dokumenty_z_kategori_pojedyncza_plik')[0].files[0];
		var dokumenty_z_kategori_opis = $(this).parent('.dokumenty_z_kategori_pojedyncza').find('.dokumenty_z_kategori_pojedyncza_opis').val();
		var dokumenty_z_kategori_id_id = $(this).parent('.dokumenty_z_kategori_pojedyncza').data('dokumenty_z_kategori_id');
		
		//alert(dokumenty_z_kategori_id);
		
		var dokumenty_strona_id = $('.dokumenty_strona_kategorii_opcje').data('strona_id');
		var dokumenty_strona_nazwa = $('.dokumenty_strona_nazwa').data('strona_nazwa');
				
		var formData = new FormData();
		
		formData.append('dokumenty_z_kategori_nr_kolejnosci', dokumenty_z_kategori_nr_kolejnosci);
		formData.append('dokumenty_z_kategori_nazwa', dokumenty_z_kategori_nazwa);	
		formData.append('dokumenty_z_kategori_plik', dokumenty_z_kategori_plik);	
		formData.append('dokumenty_z_kategori_opis', dokumenty_z_kategori_opis);	
		formData.append('dokumenty_z_kategori_id_id', dokumenty_z_kategori_id_id);
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
			url: "ajax/akcje/ajax_dokumenty_z_kategori_edytuj",
			data: formData,
            contentType: false,
            processData: false
			
		}).done(function(dane){
									
			//alert(dane);
			
			ukryj_loader();
			$('.postep_pasek').css('width','0%');
			
			dokumenty_kategoria_przeladuj_widok(dokumenty_strona_id, dokumenty_strona_nazwa);
			
			wyswitl_powiadomienie('Zmiany zostały wprowadzone!!!', 1, 0);
			
			zeruj_licznik_sesji_po_wykonaniu_funkcji();
		}).fail(function(ajaxContext) {
			document.getElementById("body_strona_r").innerHTML = ajaxContext.responseText ;
		});
		
	});
}

function dokumenty_z_kategori_szczegoly_dokumentu(){
	$('.dokumenty_z_kategori_pojedyncza_podglad').click(function(){
		dokumenty_z_kategori_zablokuj_edycje();
		
		var dokumenty_z_kategori_id = $(this).data('dokumenty_z_kategori_pojedyncza_id');
		
		$.ajax({
			method: "POST",
			url: "ajax/widoki/ajax_dokumenty_z_kategori_szczegoly_dokumentu",
			data: {
				dokumenty_z_kategori_id : dokumenty_z_kategori_id
			}
			
		}).done(function(html){
						
			document.getElementById("szczegoly_dokumentu").innerHTML = html ;
			$('#szczegoly_dokumentu').show();
			
			$('.szczegoly_dokumentu_tlo').addClass('wyswietl_okno_dokumentu');
			$('.szczegoly_dokumentu_przod').addClass('wyswietl_okno_dokumentu');
			
			dokumenty_z_kategori_szczegoly_dokumentu_zamknij();
			pobierz_dokument();
			dokumenty_z_kategori_szczegoly_dokumentu_zmien_zakladke();
			uzytkownik_grupy_pojedyncza_kratka_zaznaczanie();
			dokumenty_uzytkownicy_usun();
			dokumenty_z_kategori_szczegoly_lista_wszystkich_uzytkownikow();
			dokumenty_z_kategori_szczegoly_dokumentu_lista_wszystkich_uzytkownikow_zamknij();
			lista_wszystkich_uzytkownikow_rozwin_liste();
			lista_wszystkich_uzytkownikow_szukaj();
			lista_uzytkownikow_dla_grupy_dodaj_uprawnienie();
			
			zeruj_licznik_sesji_po_wykonaniu_funkcji();
		}).fail(function(ajaxContext) {			
			document.getElementById("body_strona_r").innerHTML = ajaxContext.responseText ;
		});
		
	});
	
	$('.dokumenty_z_kategori_pojedyncza_nazwa_nazwa').click(function(){
		dokumenty_z_kategori_zablokuj_edycje();
		
		var dokumenty_z_kategori_id = $(this).data('dokumenty_z_kategori_pojedyncza_id');
		
		$.ajax({
			method: "POST",
			url: "ajax/widoki/ajax_dokumenty_z_kategori_szczegoly_dokumentu",
			data: {
				dokumenty_z_kategori_id : dokumenty_z_kategori_id
			}
			
		}).done(function(html){
						
			document.getElementById("szczegoly_dokumentu").innerHTML = html ;
			$('#szczegoly_dokumentu').show();
			
			$('.szczegoly_dokumentu_tlo').addClass('wyswietl_okno_dokumentu');
			$('.szczegoly_dokumentu_przod').addClass('wyswietl_okno_dokumentu');
			
			dokumenty_z_kategori_szczegoly_dokumentu_zamknij();
			pobierz_dokument();
			dokumenty_z_kategori_szczegoly_dokumentu_zmien_zakladke();
			uzytkownik_grupy_pojedyncza_kratka_zaznaczanie();
			dokumenty_uzytkownicy_usun();
			dokumenty_z_kategori_szczegoly_lista_wszystkich_uzytkownikow();
			dokumenty_z_kategori_szczegoly_dokumentu_lista_wszystkich_uzytkownikow_zamknij();
			lista_wszystkich_uzytkownikow_rozwin_liste();
			lista_wszystkich_uzytkownikow_szukaj();
			lista_uzytkownikow_dla_grupy_dodaj_uprawnienie();
			
			zeruj_licznik_sesji_po_wykonaniu_funkcji();
		}).fail(function(ajaxContext) {			
			document.getElementById("body_strona_r").innerHTML = ajaxContext.responseText ;
		});
		
	});
}

function dokumenty_uzytkownicy_usun(){
	$('.dup_el_usun').click(function(){
		$(this).parent().slideUp(function(){
			$(this).remove();
		});
		
		var dokumenty_id = $('.szczegoly_dokumentu_przod_belka_top_tytul').data('szczegoly_dokumentu_id');
		var uzytkownik_id = $(this).data('uzytkownik_id');
			
		$.ajax({
			method: "POST",
			url: "ajax/akcje/ajax_dokumenty_uzytkownicy_usun",
			data: {
				dokumenty_id : dokumenty_id,
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

function dokumenty_grupa_uzytkownicy_usun(){
	$('.dup_el_usun').click(function(){
		$(this).parent().slideUp(function(){
			$(this).remove();
		});
		
		var dokumenty_id = $('.szczegoly_dokumentu_przod_belka_top_tytul').data('element_id');
		var uzytkownik_id = $(this).data('uzytkownik_id');
			
		$.ajax({
			method: "POST",
			url: "ajax/akcje/ajax_dokumenty_grupa_uzytkownicy_usun",
			data: {
				dokumenty_id : dokumenty_id,
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

function dokumenty_kategoria_uzytkownicy_usun(){
	$('.dup_el_usun').click(function(){
		$(this).parent().slideUp(function(){
			$(this).remove();
		});
		
		var dokumenty_id = $('.szczegoly_dokumentu_przod_belka_top_tytul').data('element_id');
		var uzytkownik_id = $(this).data('uzytkownik_id');
			
		$.ajax({
			method: "POST",
			url: "ajax/akcje/ajax_dokumenty_kategoria_uzytkownicy_usun",
			data: {
				dokumenty_id : dokumenty_id,
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
		var dokumenty_id = $('.szczegoly_dokumentu_przod_belka_top_tytul').data('szczegoly_dokumentu_id');
		var uzytkownik_grupa_id = $(this).data('dokumenty_grupy_id');
		
		
		
		if($(this).hasClass('zaznaczone')){
			$(this).removeClass('zaznaczone');
			
			aktualizuj_dokumenty_grupy('usun' , dokumenty_id, uzytkownik_grupa_id);
			
		}else{
			$(this).addClass('zaznaczone');
			aktualizuj_dokumenty_grupy('dodaj' , dokumenty_id, uzytkownik_grupa_id);
		}
	});
}

function dokumenty_grupa_uzytkownik_grupy_pojedyncza_kratka_zaznaczanie(){
	$('.uzytkownik_grupy_pojedyncza_kratka').click(function(){
		var dokumenty_id = $('.szczegoly_dokumentu_przod_belka_top_tytul').data('element_id');
		var uzytkownik_grupa_id = $(this).data('dokumenty_grupy_id');
		
		
		
		if($(this).hasClass('zaznaczone')){
			$(this).removeClass('zaznaczone');
			
			dokumenty_grupa_aktualizuj_dokumenty_grupy('usun' , dokumenty_id, uzytkownik_grupa_id);
			
		}else{
			$(this).addClass('zaznaczone');
			dokumenty_grupa_aktualizuj_dokumenty_grupy('dodaj' , dokumenty_id, uzytkownik_grupa_id);
		}
	});
}

function dokumenty_kategoria_uzytkownik_grupy_pojedyncza_kratka_zaznaczanie(){
	$('.uzytkownik_grupy_pojedyncza_kratka').click(function(){
		var dokumenty_id = $('.szczegoly_dokumentu_przod_belka_top_tytul').data('element_id');
		var uzytkownik_grupa_id = $(this).data('dokumenty_grupy_id');
		
		
		
		if($(this).hasClass('zaznaczone')){
			$(this).removeClass('zaznaczone');
			
			dokumenty_kategoria_aktualizuj_dokumenty_grupy('usun' , dokumenty_id, uzytkownik_grupa_id);
			
		}else{
			$(this).addClass('zaznaczone');
			dokumenty_kategoria_aktualizuj_dokumenty_grupy('dodaj' , dokumenty_id, uzytkownik_grupa_id);
		}
	});
}

function aktualizuj_dokumenty_grupy(akcja , dokumentyid, uzytkownikgrupaid){
		
	$.ajax({
		method: "POST",
		url: "ajax/akcje/ajax_aktualizuj_dokumenty_grupy",
		data: {
			akcja : akcja,
			dokumenty_id : dokumentyid,
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

function dokumenty_grupa_aktualizuj_dokumenty_grupy(akcja , dokumentyid, uzytkownikgrupaid){
	
	$.ajax({
		method: "POST",
		url: "ajax/akcje/ajax_dokumenty_grupa_aktualizuj_dokumenty_grupy",
		data: {
			akcja : akcja,
			dokumenty_id : dokumentyid,
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

function dokumenty_kategoria_aktualizuj_dokumenty_grupy(akcja , dokumentyid, uzytkownikgrupaid){
	
	$.ajax({
		method: "POST",
		url: "ajax/akcje/ajax_dokumenty_kategoria_aktualizuj_dokumenty_grupy",
		data: {
			akcja : akcja,
			dokumenty_id : dokumentyid,
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

function dokumenty_z_kategori_szczegoly_dokumentu_zamknij(){
	$('.szczegoly_dokumentu_tlo').click(function(){
		$('.szczegoly_dokumentu_tlo').removeClass('wyswietl_okno_dokumentu');
		$('.szczegoly_dokumentu_przod').removeClass('wyswietl_okno_dokumentu');
		//$('#szczegoly_dokumentu').hide();
		$('.szczegoly_dokumentu_tlo').remove();
		$('.szczegoly_dokumentu_przod').remove();
		$('.lista_wszystkich_uzytkownikow').remove();
		zeruj_licznik_sesji_po_wykonaniu_funkcji();
	});
	
	$('.szczegoly_dokumentu_zamknij').click(function(){
		$('.szczegoly_dokumentu_tlo').removeClass('wyswietl_okno_dokumentu');
		$('.szczegoly_dokumentu_przod').removeClass('wyswietl_okno_dokumentu');
		//$('#szczegoly_dokumentu').hide();
		$('.szczegoly_dokumentu_tlo').remove();
		$('.szczegoly_dokumentu_przod').remove();
		$('.lista_wszystkich_uzytkownikow').remove();
		zeruj_licznik_sesji_po_wykonaniu_funkcji();
	});
}

function dokumenty_z_kategori_szczegoly_dokumentu_lista_wszystkich_uzytkownikow_zamknij(){
	$('.lista_wszystkich_uzytkownikow').click(function(){
		$('.lista_wszystkich_uzytkownikow').removeClass('wyswietl_okno_dokumentu');
		$('.lista_wszystkich_uzytkownikow_przod').removeClass('wyswietl_okno_dokumentu');
		zeruj_licznik_sesji_po_wykonaniu_funkcji();
	});
	
	$('.lista_wszystkich_uzytkownikow_zamknij').click(function(){
		$('.lista_wszystkich_uzytkownikow').removeClass('wyswietl_okno_dokumentu');
		$('.lista_wszystkich_uzytkownikow_przod').removeClass('wyswietl_okno_dokumentu');
		zeruj_licznik_sesji_po_wykonaniu_funkcji();
	});
}

function pobierz_dokument(){
	$('.szczegoly_dokumentu_pobierz_d').click(function(){
		var nazwa_pliku = $(this).data('szczegoly_dokumenty_nazwa');
		var dokument_id = $(this).data('szczegoly_dokumentu_id');
		var liczba_p = $(this).data('szczegoly_dokumentu_p');
		
		
		
		
		
		var downloadLink = document.createElement("a");
		
		
		
		if($(this).hasClass('zapisz_plik_z_archwum')){
			
			downloadLink.href = 'pobierz_dokument?id_d='+dokument_id+'&nazwa='+nazwa_pliku+'&liczba_p='+liczba_p+'&arch=1';			
			liczba_p = liczba_p+1;
			$(this).prev('.dzkap_p').text(liczba_p);
			$(this).data('szczegoly_dokumentu_p',liczba_p);
			$(this).attr('data-szczegoly_dokumentu_p',liczba_p);
		}else{
			
			downloadLink.href = 'pobierz_dokument?id_d='+dokument_id+'&nazwa='+nazwa_pliku+'&liczba_p='+liczba_p+'&arch=0';			
			liczba_p = liczba_p+1;
			$('.liczba_pobran').text(liczba_p);
			$('.szczegoly_dokumentu_pobierz').data('szczegoly_dokumentu_p',liczba_p);
			$('.szczegoly_dokumentu_pobierz').attr('data-szczegoly_dokumentu_p',liczba_p);
		}
		
		
		
		window.open(downloadLink.href);
	});
}

function dokumenty_z_kategori_szczegoly_dokumentu_zmien_zakladke(){
	$('.szczegoly_dokumentu_informacje_naglowki_przycisk').click(function(){
		
		$('.szczegoly_dokumentu_informacje_naglowki_przycisk').removeClass('aktywny_p');
		$(this).addClass('aktywny_p');
		
		var tresc = $(this).data('nazwa_tresci');
		
		$('.szczegoly_dokumentu_informacje_tresc_pojedyncza').removeClass('aktywny_t');
		$('#'+tresc).addClass('aktywny_t');
		
	});
}

function dokumenty_z_kategori_szczegoly_lista_wszystkich_uzytkownikow(){
	$('.dokumenty_uzytkownicy_dodaj_nowy').click(function(){
		$('.lista_wszystkich_uzytkownikow').addClass('wyswietl_okno_dokumentu');
		$('.lista_wszystkich_uzytkownikow_przod').addClass('wyswietl_okno_dokumentu');
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

function dokumenty_grupa_lista_wszystkich_uzytkownikow_szukaj(){
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

function dokumenty_kategoria_lista_wszystkich_uzytkownikow_szukaj(){
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
				
		var dokument_id = $('.szczegoly_dokumentu_przod_belka_top_tytul').data('szczegoly_dokumentu_id');
		var uzytkownik_id = $(this).data('uzytkownik_id');
		
		//alert(dokument_id+' '+uzytkownik_id);
		
		$.ajax({
			method: "POST",
			url: "ajax/akcje/ajax_lista_uzytkownikow_dla_grupy_dodaj_uprawnienie",
			data: {
				dokument_id : dokument_id,
				uzytkownik_id : uzytkownik_id
			}
			
		}).done(function(data){
			
			var array = $.parseJSON(data);
			
			if(array[0] === '0'){
				wyswitl_powiadomienie('Wybrany użytkownik posiada uprawnienie do dokumentu!!!', 0, 0);
			}else{
				dokumenty_uzytkownicy_lista_dodanych(dokument_id);
				
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

function dokumenty_uzytkownicy_lista_dodanych(dokument_id){
	$.ajax({
		method: "POST",
		url: "ajax/akcje/ajax_dokumenty_uzytkownicy_lista_dodanych",
		data : {
			dokument_id : dokument_id
		}
		
	}).done(function(html){
		document.getElementById("dokumenty_uzytkownicy_lista_dodanych").innerHTML = html ;
		dokumenty_uzytkownicy_usun();
		
		zeruj_licznik_sesji_po_wykonaniu_funkcji();
	}).fail(function(ajaxContext) {			
		alert(ajaxContext.responseText) ;
	});
}

function dokumenty_grupa_uzytkownicy_lista_dodanych(dokument_id){
	$.ajax({
		method: "POST",
		url: "ajax/akcje/ajax_dokumenty_grupa_uzytkownicy_lista_dodanych",
		data : {
			dokument_id : dokument_id
		}
		
	}).done(function(html){
		document.getElementById("dokumenty_uzytkownicy_lista_dodanych").innerHTML = html ;
		dokumenty_uzytkownicy_usun();
		
		zeruj_licznik_sesji_po_wykonaniu_funkcji();
	}).fail(function(ajaxContext) {			
		alert(ajaxContext.responseText) ;
	});
}

function dokumenty_kategoria_uzytkownicy_lista_dodanych(dokument_id){
	$.ajax({
		method: "POST",
		url: "ajax/akcje/ajax_dokumenty_kategoria_uzytkownicy_lista_dodanych",
		data : {
			dokument_id : dokument_id
		}
		
	}).done(function(html){
		document.getElementById("dokumenty_uzytkownicy_lista_dodanych").innerHTML = html ;
		dokumenty_uzytkownicy_usun();
		
		zeruj_licznik_sesji_po_wykonaniu_funkcji();
	}).fail(function(ajaxContext) {			
		alert(ajaxContext.responseText) ;
	});
}

/*kamyk 30-08-2016*/
function usun_dokument(){
	$('.dokumenty_z_kategori_pojedyncza_usun').click(function(){
		$(this).next().addClass('wysun');
	});
	
	$('.dokumenty_z_kategori_pojedyncza_usun_tak').click(function(){
		var dokument_id = $(this).data('id_element');
		
		var wiersz = $(this).parent().parent();
		
		$.ajax({
			method: "POST",
			url: "ajax/akcje/ajax_dokumenty_usun_dokument",
			data : {
				dokument_id : dokument_id
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
	$('.dokumenty_kategoria_usun').click(function(){
		$('.szczegoly_dokumentu_przod').find('.czy_jestes_pewnien').addClass('wysun');
	});
	
	$('.dokumenty_kategoria_usun_tak').click(function(){
		var kategoria_id = $(this).data('id_element');
		
		var strona_id = $('.element_do_wyboru.aktywny').data('strona_id');
		var strona_nazwa = $('.element_do_wyboru.aktywny').attr('title');
		var wiersz = $(this).parent().parent();
		
		$.ajax({
			method: "POST",
			url: "ajax/akcje/ajax_dokumenty_kategoria_usun",
			data : {
				kategoria_id : kategoria_id
			}
			
		}).done(function(html){
			
			$('.szczegoly_dokumentu_tlo').removeClass('wyswietl_okno_dokumentu');
			$('.szczegoly_dokumentu_przod').removeClass('wyswietl_okno_dokumentu');
			$('.szczegoly_dokumentu_tlo').remove();
			$('.szczegoly_dokumentu_przod').remove();
			$('.lista_wszystkich_uzytkownikow').remove();
			zeruj_licznik_sesji_po_wykonaniu_funkcji();
			
			dokumenty_kategoria_przeladuj_widok(strona_id, strona_nazwa);
			
			wyswitl_powiadomienie('Kategoria została usunięta!!!', 1, 0);
			
			zeruj_licznik_sesji_po_wykonaniu_funkcji();
		}).fail(function(ajaxContext) {			
			alert(ajaxContext.responseText) ;
		});
		
	});
}

function dokumenty_strona_usun(){
	$('.dokumenty_strona_edytuj_usun').click(function(){
		$('.czy_jestes_pewnien').toggleClass('wysun');
	});
	
	$('.dokumenty_strona_edytuj_usun_tak').click(function(){
		var dokumenty_strona_id = $('.szczegoly_dokumentu_przod_belka_top_tytul').data('element_id');
		
		//alert(dokumenty_strona_nr_kolejnosci+' '+dokumenty_strona_nazwa);
		
		wyswietl_loader();
		
		$.ajax({
			method: "POST",
			url: "ajax/akcje/ajax_dokumenty_strona_usun",
			data: {
				dokumenty_strona_id : dokumenty_strona_id
			}
			
		}).done(function(html){
			
			//alert(html);
			
			wyswitl_powiadomienie('Strona została usunięta!!!', 1, 1, 1000);		
			
		}).fail(function(ajaxContext) {			
			document.getElementById("body_strona_r").innerHTML = ajaxContext.responseText ;
		});
	});
}




