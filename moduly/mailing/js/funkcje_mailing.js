edytor_opcje();
$(document).ready(function(){

	/*FUNKCJE POTRZEBNE DO WYSLANIA WIADOMOSCI*/
	
	mailing_wyslij();
	mailing_adresat_dodaj_do_listy_wpisany_recznie();	
	mailing_odbiorca_lista_zamknij_wyswietl();
	$('.usun_mail').click(function(){
		$(this).parent().remove();
	});	
	mailing_zapisz_zalacznik();
	podpis_zmien();
	mailing_odbiorca_lista_dodaj_csv();
	mailing_wyslij_testowy();
	
	mailing_zapisz_schemat();
	
	/*kamyk 2016-09-16*/
	mailing_dodaj_liste_maili_grupy_struktury();
	mailing_dodaj_adres_do_wiadomosci();
	
	/*kamyk 2016-09-19*/
	mailing_dodaj_adres_pojedynczy_odbiorcy();
	
	/*----------------------------------------*/
	
	
	$('#podpis').click(function(){
		$('.element_do_wyboru').removeClass('aktywny');
		$(this).addClass('aktywny');
		podpis_wyswietl();
	});
	
	$('#nowa_wiadomosc').click(function(){
		$('.element_do_wyboru').removeClass('aktywny');
		$(this).addClass('aktywny');
		nowa_wiadomosc_wyswietl();
	});
	
	$('#podpis_szablon').click(function(){
		$('.element_do_wyboru').removeClass('aktywny');
		$(this).addClass('aktywny');
		podpis_szablon_wyswietl();
	});
	
	$('#lista_schematow').click(function(){
		$('.element_do_wyboru').removeClass('aktywny');
		$(this).addClass('aktywny');
		lista_schematow_wyswietl();
	});
	
	$('#lista_wyslanych').click(function(){
		$('.element_do_wyboru').removeClass('aktywny');
		$(this).addClass('aktywny');
		lista_wyslanych_wyswietl();
	});
	
	$('#lista_wszystkich_wyslanych').click(function(){
		$('.element_do_wyboru').removeClass('aktywny');
		$(this).addClass('aktywny');
		lista_wszystkich_wyslanych_wyswietl();
	});
	
	$('#grupy_mailingowe').click(function(){
		$('.element_do_wyboru').removeClass('aktywny');
		$(this).addClass('aktywny');
		grupy_mailingowe_wyswietl();
	});
	
});

function grupy_mailingowe_wyswietl(){
	$.ajax({
		method: "POST",
		url: "ajax/widoki/ajax_grupy_mailingowe"
	}).done(function( data ) {

		document.getElementById("body_strona_r_tresc_tlo").innerHTML = data ;
								
		zeruj_licznik_sesji_po_wykonaniu_funkcji();
	}).fail(function(ajaxContext) {
		document.getElementById("body_strona_r").innerHTML = ajaxContext.responseText ;
	});
}

function lista_wszystkich_wyslanych_wyswietl(){
	$.ajax({
		method: "POST",
		url: "ajax/widoki/ajax_lista_wszystkich_wyslanych"
	}).done(function( data ) {

		document.getElementById("body_strona_r_tresc_tlo").innerHTML = data ;
		
		edytor_opcje();
		
		mailing_edytuj_widok();
		
		$('.mwp_temat').click(function(){			
			if($(this).hasClass('rozwiniete')){
				$('.mwp_informacje').slideUp();
				$('.mwp_temat').removeClass('rozwiniete');
			}else{
				$('.mwp_informacje').slideUp();
				$('.mwp_temat').removeClass('rozwiniete');
				$(this).addClass('rozwiniete');
				$(this).next().slideDown();
			}
		});
				
		zeruj_licznik_sesji_po_wykonaniu_funkcji();
	}).fail(function(ajaxContext) {
		document.getElementById("body_strona_r").innerHTML = ajaxContext.responseText ;
	});
}

function lista_wyslanych_wyswietl(){
	$.ajax({
		method: "POST",
		url: "ajax/widoki/ajax_lista_wyslanych"
	}).done(function( data ) {

		document.getElementById("body_strona_r_tresc_tlo").innerHTML = data ;
		
		edytor_opcje();
		
		mailing_edytuj_widok();
		
		$('.mwp_temat').click(function(){			
			if($(this).hasClass('rozwiniete')){
				$('.mwp_informacje').slideUp();
				$('.mwp_temat').removeClass('rozwiniete');
			}else{
				$('.mwp_informacje').slideUp();
				$('.mwp_temat').removeClass('rozwiniete');
				$(this).addClass('rozwiniete');
				$(this).next().slideDown();
			}
		});
		
		$('.mwp_temat')[0].setAttribute("class", "mwp_temat rozwiniete");
		$('.mwp_informacje')[0].setAttribute("style", "display: block;");
				
		zeruj_licznik_sesji_po_wykonaniu_funkcji();
	}).fail(function(ajaxContext) {
		document.getElementById("body_strona_r").innerHTML = ajaxContext.responseText ;
	});
}

function lista_schematow_wyswietl(){
	$.ajax({
		method: "POST",
		url: "ajax/widoki/ajax_lista_schematow"
	}).done(function( data ) {

		document.getElementById("body_strona_r_tresc_tlo").innerHTML = data ;
		
		edytor_opcje();
		
		mailing_edytuj_widok();
				
		zeruj_licznik_sesji_po_wykonaniu_funkcji();
	}).fail(function(ajaxContext) {
		document.getElementById("body_strona_r").innerHTML = ajaxContext.responseText ;
	});
}

function mailing_edytuj_widok(){
	$('.mailing_edytuj_widok').click(function(){
		
		var mailing_id = $(this).parent().data('mailing_id');
		var akcja = '';
		
		if(mailing_id === undefined){
			mailing_id = $(this).data('mailing_id');
			var akcja = 'wyslij_ponownie';
		}
		
		//alert(mailing_id+' '+akcja14);
		
		$.ajax({
			method: "POST",
			url: "ajax/widoki/ajax_mailing_edytor_widok",
			data: {
				mailing_id : mailing_id,
				akcja : akcja
			}
		}).done(function( data ) {

			document.getElementById("body_strona_r_tresc_tlo").innerHTML = data ;
			
			edytor_opcje();
			mailing_zapisz_schemat();
			
			mailing_wyslij();
			mailing_adresat_dodaj_do_listy_wpisany_recznie();	
			mailing_odbiorca_lista_zamknij_wyswietl();
			
			$('.usun_mail').click(function(){
				$(this).parent().remove();
			});	
			
			mailing_zapisz_zalacznik();
			podpis_zmien();
			mailing_odbiorca_lista_dodaj_csv();
			mailing_wyslij_testowy();
			
			/*kamyk 2016-09-09*/
			
			mailing_schemat_usun();
			
			/*kamyk 2016-09-16*/
			mailing_dodaj_liste_maili_grupy_struktury();
			
			zeruj_licznik_sesji_po_wykonaniu_funkcji();
		}).fail(function(ajaxContext) {
			document.getElementById("body_strona_r").innerHTML = ajaxContext.responseText ;
		});
	});
}

function podpis_wyswietl(){
	$.ajax({
			method: "POST",
			url: "ajax/widoki/ajax_edytor_podpis"
	}).done(function( data ) {
	
			document.getElementById("body_strona_r_tresc_tlo").innerHTML = data ;
			edytor_opcje();
			
			
			
			$('.epp_nazwa').click(function(){
				
				$('.epp_nazwa').slideDown();
				$('.epp_edytor').slideUp();
				
				$(this).next().slideDown();
				$(this).slideUp();
			});
			
			podpis_zapisz();
			podpis_dodaj_nowy();
			podpis_usun();
			podpis_ustaw_domyslny();
			
			zeruj_licznik_sesji_po_wykonaniu_funkcji();
	}).fail(function(ajaxContext) {
			document.getElementById("body_strona_r").innerHTML = ajaxContext.responseText ;
	});
}

function podpis_szablon_wyswietl(){
	$.ajax({
		method: "POST",
		url: "ajax/widoki/ajax_mailing_podpis_szablon"
	}).done(function( data ) {
	
			document.getElementById("body_strona_r_tresc_tlo").innerHTML = data ;
			edytor_opcje();
			
			podpis_szablon_dodaj_nowy();
			podpis_szablon_zapisz_zmiany();
			
			zeruj_licznik_sesji_po_wykonaniu_funkcji();
	}).fail(function(ajaxContext) {
			document.getElementById("body_strona_r").innerHTML = ajaxContext.responseText ;
	});
}

function podpis_szablon_dodaj_nowy(){
	$('.epp_zapisz_nowy_szablon').click(function(){
		var mailing_podpis_nazwa;
		var mailing_podpis_tresc = $(this).parent().find('.wysiwyg-editor').html();
		
		$.ajax({
			method: "POST",
			url: "ajax/akcje/ajax_mailing_podpis_szablon_dodaj_nowy",
			data: {
				//mailing_podpis_nazwa : mailing_podpis_nazwa,
				mailing_podpis_tresc : mailing_podpis_tresc

			}
		}).done(function( data ) {
						
			wyswitl_powiadomienie('Podpis zapisano do bazy!!!', 1, 0);
			
			zeruj_licznik_sesji_po_wykonaniu_funkcji();
		}).fail(function(ajaxContext) {
			document.getElementById("body_strona_r").innerHTML = ajaxContext.responseText ;
		});
	});
}

function podpis_szablon_zapisz_zmiany(){
	$('.epp_zapisz_szablon').click(function(){
		var mailing_podpis_nazwa;
		var mailing_podpis_szablon_id = $(this).data('mailing_podpis_szablon_id');
		var mailing_podpis_tresc = $(this).parent().find('.wysiwyg-editor').html();
		
		$.ajax({
			method: "POST",
			url: "ajax/akcje/ajax_mailing_podpis_szablon_zapisz_zmiany",
			data: {
				//mailing_podpis_nazwa : mailing_podpis_nazwa,
				mailing_podpis_tresc : mailing_podpis_tresc,
				mailing_podpis_szablon_id : mailing_podpis_szablon_id

			}
		}).done(function( data ) {
						
			wyswitl_powiadomienie('Podpis zapisano do bazy!!!', 1, 0);
			
			zeruj_licznik_sesji_po_wykonaniu_funkcji();
		}).fail(function(ajaxContext) {
			document.getElementById("body_strona_r").innerHTML = ajaxContext.responseText ;
		});
	});
}

function podpis_dodaj_nowy(){
	$('.epp_zapisz_nowy').click(function(){
		var mailing_podpis_nazwa = $(this).parent().find('.eppe_nazwa').val();
		var mailing_podpis_tresc = $(this).parent().find('.wysiwyg-editor').html();
		var domyslny = $(this).data('mailing_podpis_domyslny');
				
		if(mailing_podpis_nazwa == ''){
			wyswitl_powiadomienie('Uzupełnij nazwę podpisu!!!', 0, 0);
			return false;
		}
		
		$.ajax({
			method: "POST",
			url: "ajax/akcje/ajax_mailing_podpis_dodaj_nowy",
			data: {
				mailing_podpis_nazwa : mailing_podpis_nazwa,
				mailing_podpis_tresc : mailing_podpis_tresc,
				domyslny : domyslny
			}
		}).done(function( data ) {
			
			podpis_wyswietl();
			
			wyswitl_powiadomienie('Podpis zapisano do bazy!!!', 1, 0);
			
			zeruj_licznik_sesji_po_wykonaniu_funkcji();
		}).fail(function(ajaxContext) {
			document.getElementById("body_strona_r").innerHTML = ajaxContext.responseText ;
		});
	});
}

function podpis_zapisz(){
	$('.epp_zapisz').click(function(){
		var mailing_podpis_nazwa = $(this).parent().find('.eppe_nazwa').val();
		var mailing_podpis_tresc = $(this).parent().find('.wysiwyg-editor').html();
		var mailing_podpis_id = $(this).data('epp_id');
		
		if(mailing_podpis_nazwa == ''){
			wyswitl_powiadomienie('Uzupełnij nazwę podpisu!!!', 0, 0);
			return false;
		}
		
		$.ajax({
			method: "POST",
			url: "ajax/akcje/ajax_mailing_podpis_zapisz",
			data: {
				mailing_podpis_nazwa : mailing_podpis_nazwa,
				mailing_podpis_tresc : mailing_podpis_tresc,
				mailing_podpis_id : mailing_podpis_id
			}
		}).done(function( data ) {
			
			podpis_wyswietl();
			
			wyswitl_powiadomienie('Zmiany zostały zapisane!!!', 1, 0);
			
			zeruj_licznik_sesji_po_wykonaniu_funkcji();
		}).fail(function(ajaxContext) {
			document.getElementById("body_strona_r").innerHTML = ajaxContext.responseText ;
		});
	});
}

function podpis_zmien(){
	$('.mailing_podpis_lista').change(function(){
		var mailing_podpis_id = $('.mailing_podpis_lista option:selected').data('podpis_id');
		
		$.ajax({
			method: "POST",
			url: "ajax/akcje/ajax_mailing_podpis_pobierz_po_id",
			data: {
				mailing_podpis_id : mailing_podpis_id
			}
		}).done(function( data ) {
			
			$('.podpis_w_tresci').remove();
			
			var tresc_podpis = '<div class="podpis_w_tresci">'+data+'<div class="podpis_w_tresci_end"></div></div >';
			var wyswig_editor_tresc = $('.wysiwyg-editor').html();
			
			//alert(wyswig_editor_tresc);
			
			document.getElementById("wysiwyg_edytor").innerHTML =  wyswig_editor_tresc+tresc_podpis;
			  
			zeruj_licznik_sesji_po_wykonaniu_funkcji();
		}).fail(function(ajaxContext) {
			document.getElementById("body_strona_r").innerHTML = ajaxContext.responseText ;
		});
	});
}

function podpis_usun(){
	$('.usun_podpis').click(function(){
		$(this).parent().find('.czy_jestes_pewnien').toggleClass('wysun');
	});
	
	$('.czy_jestes_pewnien_tak').click(function(){
		var mailing_podpis_id = $(this).data('podpis_id');
		
		$(this).parent().parent().parent().slideUp(function(){
			$(this).remove();
		});
		
		$.ajax({
			method: "POST",
			url: "ajax/akcje/ajax_mailing_podpis_usun",
			data :{
				mailing_podpis_id : mailing_podpis_id
			}
		}).done(function( data ) {

			wyswitl_powiadomienie('Podpis został usunięty!!!', 1, 0);
			
			zeruj_licznik_sesji_po_wykonaniu_funkcji();
		}).fail(function(ajaxContext) {
				document.getElementById("body_strona_r").innerHTML = ajaxContext.responseText ;
		});
		
	});
	
}

function podpis_ustaw_domyslny(){
	$('.ustaw_domyslny').click(function(){
		var mailing_podpis_id = $(this).parent().parent().parent().data('podpis_id');
		var domyslny;
		
		if($(this).hasClass('zaznaczone')){
			return false;
		}else{
			$(this).addClass('zaznaczone');
			domyslny = 1;
		}
		
		
		//alert(mailing_podpis_id);
		$.ajax({
			method: "POST",
			url: "ajax/akcje/ajax_mailing_podpis_ustaw_domyslny",
			data :{
				mailing_podpis_id : mailing_podpis_id,
				domyslny : domyslny
			}
		}).done(function( data ) {
			
			podpis_wyswietl();
			
			wyswitl_powiadomienie('Zmiany zostały zapisane!!!', 1, 0);
			
			zeruj_licznik_sesji_po_wykonaniu_funkcji();
		}).fail(function(ajaxContext) {
				document.getElementById("body_strona_r").innerHTML = ajaxContext.responseText ;
		});
		
	});
}

function nowa_wiadomosc_wyswietl(){
	$.ajax({
			method: "POST",
			url: "ajax/widoki/ajax_edytor_tekstu"
	}).done(function( data ) {

			document.getElementById("body_strona_r_tresc_tlo").innerHTML = data ;
			edytor_opcje();
			
			mailing_wyslij();
			mailing_adresat_dodaj_do_listy_wpisany_recznie();	
			mailing_odbiorca_lista_zamknij_wyswietl();
			$('.usun_mail').click(function(){
				$(this).parent().remove();
			});	
			mailing_zapisz_zalacznik();
			podpis_zmien();
			
			mailing_odbiorca_lista_dodaj_csv();
			mailing_wyslij_testowy();
			
			mailing_zapisz_schemat();
			  
			zeruj_licznik_sesji_po_wykonaniu_funkcji();
			
			/*kamyk 2016-09-16*/
			mailing_dodaj_liste_maili_grupy_struktury();
			mailing_dodaj_adres_do_wiadomosci();
			
			/*kamyk 2016-09-19*/
			mailing_dodaj_adres_pojedynczy_odbiorcy();
			
	}).fail(function(ajaxContext) {
			document.getElementById("body_strona_r").innerHTML = ajaxContext.responseText ;
	});
}


function mailing_zapisz_zalacznik(){
	$('.mailing_zalaczniki_dodaj_pole').change(function(){
		var zalacznik = $(this)[0].files[0];
		
		var formData = new FormData();
		formData.append('zalacznik', zalacznik);
		
		$.ajax({
			method: "POST",
			url: "ajax/akcje/ajax_zalacznik_zapisz_do_tmp",
			data: formData,
            contentType: false,
            processData: false
			
		}).done(function(data){
			
			wyswitl_powiadomienie('Załącznik został zapisany!!!', 1, 0);
			
			var element = '<div class="mailing_zalacznik" data-email_zalacznik="'+data+'"><p class="mail_napis">'+data+'</p><span class="usun_zalacznik"><span>x</span></span><div class="clear_b"></div></div>';
			
			$('#mailing_zalaczniki_lista').append(element);
			$('.usun_zalacznik').click(function(){
				$(this).parent().remove();
			});
			
			zeruj_licznik_sesji_po_wykonaniu_funkcji();
		}).fail(function(ajaxContext) {
			document.getElementById("body_strona_r").innerHTML = ajaxContext.responseText ;
		});
		
	});
}

function mailing_odbiorca_lista_zamknij_wyswietl(){
	$('.mailing_odbiorca_lista_okno_zamknij').click(function(){
		setTimeout(function(){
			$('#mailing_odbiorca_lista_tlo').css('z-index','-2');
		},500);
		
		$('.mailing_odbiorca_lista_tlo').removeClass('wyswietl_mailing_odbiorca_lista');
		$('.mailing_odbiorca_lista_okno').removeClass('wyswietl_mailing_odbiorca_lista');
	});
	
	$('.mailing_odbiorca_dodaj').click(function(){
		$('#mailing_odbiorca_lista_tlo').css('z-index','2');
		$('.mailing_odbiorca_lista_tlo').addClass('wyswietl_mailing_odbiorca_lista');
		$('.mailing_odbiorca_lista_okno').addClass('wyswietl_mailing_odbiorca_lista');
	});
}

function mailing_adresat_dodaj_do_listy_wpisany_recznie(){
	$('.mailing_odbiorca_wpisany_recznie_dodaj').click(function(){
		var adres_email = $('.mailing_odbiorca_wpisany_recznie_pole').val();
		
		if(adres_email == ''){			
			wyswitl_powiadomienie('Wprowadź adres email!!!', 0, 0);				
			return false;
		}
		
		if ($('.mailing_odbiorca_wpisany_recznie_pole').is(":invalid")) {
			wyswitl_powiadomienie('Wprowadź poprawny adres email!!!', 0, 0);				
			return false;
		}
				
		var element = '<div class="mailing_odbiorca_email" data-adresat_email="'+adres_email+'"><p class="mail_napis">'+adres_email+'</p><span class="usun_mail"><span>x</span></span><div class="clear_b"></div></div>';
		
		$('#mailing_odbiorca_lista').append(element);
		$('.mailing_odbiorca_wpisany_recznie_pole').val('');
		
		$('.usun_mail').click(function(){
			$(this).parent().remove();
		});
		
	});
}

function mailing_odbiorca_lista_dodaj_csv(){

	$('.mailing_odbiorca_dodaj_z_pliku_csb_pole').change(function(){
		

		
		var plik = $(this)[0].files[0];
		

		
		var formData = new FormData();
		formData.append('plik', plik);
		
		$.ajax({
			method: "POST",
			url: "ajax/akcje/ajax_mailing_odbiorca_lista_dodaj_csv",
			data: formData,
            contentType: false,
            processData: false
			
		}).done(function(data){
			
			
			
			wyswitl_powiadomienie('Lista została zaimportowana!!!', 1, 0);
			
			$('#mailing_odbiorca_lista').append(data);
			
			$('.usun_mail').click(function(){
				$(this).parent().remove();
			});
			
			zeruj_licznik_sesji_po_wykonaniu_funkcji();
		}).fail(function(ajaxContext) {
			document.getElementById("body_strona_r").innerHTML = ajaxContext.responseText ;
		});
	});
}

function mailing_wyslij_testowy(){
	$('.mailing_wyslij_testowy').click(function(){
		var mailing_odbiorca = $(this).data('adres_email');
		var mailing_tresc = $('.wysiwyg-editor').html();
		var mailing_temat = '[MAILING TESTOWY] '+($('.mailing_tytul_pole').val());
		
		if(mailing_temat == '[MAILING TESTOWY] '){
			wyswitl_powiadomienie('Wprowadź temat wiadomości!!!', 0, 0);				
			return false;
		}
		
		var mailing_adresat_imie_nazwisko = $('.mailing_adresat_imie_nazwisko').val();
		
		if(mailing_adresat_imie_nazwisko == '' || mailing_adresat_imie_nazwisko == undefined){
			mailing_adresat_imie_nazwisko = $('.mailing_adresat_imie_nazwisko_p').text();
		}
		
		var mailing_adresat_email = $('.mailing_adresat_email').val();
		
		if(mailing_adresat_email == '' || mailing_adresat_email == undefined){
			mailing_adresat_email = $('.mailing_adresat_email_p').text();
		}
		
		var mailing_obrazki = [];
		var mailing_zalaczniki = [];
		
		var liczba_img = $('.wysiwyg-editor img').size();
		var liczba_zalacznikow = $('.mailing_zalacznik').size();
		
		var i = 0;
		for(i;i<liczba_img;i++){
			mailing_obrazki[i] = {
					id: i,
					src : $('.wysiwyg-editor img')[i].getAttribute('src'),
					height : $('.wysiwyg-editor img')[i].getAttribute('height'),
					width : $('.wysiwyg-editor img')[i].getAttribute('width'),
					style : $('.wysiwyg-editor img')[i].getAttribute('style')				
			};
		}
		
		var z=0;
		for(z;z<liczba_zalacznikow;z++){
			mailing_zalaczniki[z] = {
					src : $('.mailing_zalacznik')[z].getAttribute('data-email_zalacznik')					
			};
		}
						
		wyswietl_loader('Trwa wysyłanie wiadomości!!!');
						
			$.ajax({
				method: "POST",
				url: "ajax/akcje/ajax_mailing_wyslij",
				data: {
					mailing_adresat_imie_nazwisko : mailing_adresat_imie_nazwisko,
					mailing_adresat_email: mailing_adresat_email,
					mailing_temat: mailing_temat,
					mailing_odbiorca : mailing_odbiorca,
					mailing_tresc : mailing_tresc,
					mailing_obrazki : mailing_obrazki,
					mailing_zalaczniki : mailing_zalaczniki
				}
				
			}).done(function(data){
				
				ukryj_loader();
				wyswitl_powiadomienie('Maile zostały wysłane!!!', 1, 0);
				
				$('.mailing_wyslij_testowy_zgodnosc').slideDown();
								
				zeruj_licznik_sesji_po_wykonaniu_funkcji();
				
			}).fail(function(ajaxContext) {			
				document.getElementById("body_strona_r").innerHTML = ajaxContext.responseText ;
			});
		
		
	
	});
	
	$('.mailing_wyslij_testowy_zgodnosc .kratka').click(function(){
		
		if($(this).hasClass('zaznaczone')){
			$(this).removeClass('zaznaczone');
			$('.mailing_wyslij').hide();
			$('.mailing_wyslij_testowy').show();
			$('.mailing_wyslij_jako_udw').hide();
			$('.mailing_wyslij_priorytet').hide();
		}else{
			$(this).addClass('zaznaczone');
			$('.mailing_wyslij').show();
			$('.mailing_wyslij_testowy').hide();
			var liczba_dw = $('.mailing_odbiorca_do_wiadomosci_email').size();
			if(liczba_dw == 0){
				$('.mailing_wyslij_jako_udw').show();
			}
			$('.mailing_wyslij_priorytet').show();
		}
		
	});
	
$('.wyslij_jako_udw').click(function(){
		
		$(this).toggleClass('zaznaczone');
		if($(this).hasClass('zaznaczone')){
			$('.wyslij_jako_udw_l_paczki').show();
		}else{
			$('.wyslij_jako_udw_l_paczki').hide();
		}
	});

$('.wyslij_priorytet').click(function(){
	
	$(this).toggleClass('zaznaczone');
	
});
	
}

function mailing_wyslij(){
	$('.mailing_wyslij').click(function(){
		var mailing_odbiorca;
		var mailing_tresc = $('.wysiwyg-editor').html();
		var mailing_temat = $('.mailing_tytul_pole').val();
		
		if(mailing_temat == ''){
			wyswitl_powiadomienie('Wprowadź temat wiadomości!!!', 0, 0);				
			return false;
		}
		
		var mailing_adresat_imie_nazwisko = $('.mailing_adresat_imie_nazwisko').val();
		
		if(mailing_adresat_imie_nazwisko == '' || mailing_adresat_imie_nazwisko == undefined){
			mailing_adresat_imie_nazwisko = $('.mailing_adresat_imie_nazwisko_p').text();
		}
		
		var mailing_adresat_email = $('.mailing_adresat_email').val();
		
		if(mailing_adresat_email == '' || mailing_adresat_email == undefined){
			mailing_adresat_email = $('.mailing_adresat_email_p').text();
		}
				
		var mailing_obrazki = [];
		var mailing_zalaczniki = [];
		
		var liczba_img = $('.wysiwyg-editor img').size();
		var liczba_zalacznikow = $('.mailing_zalacznik').size();
		
		var i = 0;
		for(i;i<liczba_img;i++){

			mailing_obrazki[i] = {
					'id': i,
					'src' : $('.wysiwyg-editor img')[i].getAttribute('src'),
					'height' : $('.wysiwyg-editor img')[i].getAttribute('height'),
					'width' : $('.wysiwyg-editor img')[i].getAttribute('width'),
					'style' : $('.wysiwyg-editor img')[i].getAttribute('style')
					
			};
		}
		
		var z=0;
		for(z;z<liczba_zalacznikow;z++){
			mailing_zalaczniki[z] = {
					'src' : $('.mailing_zalacznik')[z].getAttribute('data-email_zalacznik')					
			};
		}
		
		var liczba_adresatow = $('.mailing_odbiorca_email').size();
		
		if(liczba_adresatow == 0){
			wyswitl_powiadomienie('Wprowadź conajmniej jednego odbiorcę!!!', 0, 0);
			return false;
		}
				
		wyswietl_loader('Trwa wysyłanie wiadomości!!!');
		
		var adresaci_unikalni = [];
		var d=0;
		var email;
		
		var liczba_adresatow = $('.mailing_odbiorca_email').size();
		
		for(d=0; d<liczba_adresatow; d++){
			email = $('.mailing_odbiorca_email')[d].getAttribute("data-adresat_email");
			
			if(jQuery.inArray(email, adresaci_unikalni ) >= 0){
				$('.mailing_odbiorca_email')[d].setAttribute('class', 'mailing_odbiorca_email duplikat');
			}else{
				adresaci_unikalni[d] =  email;	
				
			}
			
		}		
		$('.duplikat').remove();
				
		liczba_adresatow = $('.mailing_odbiorca_email').size();
				
		var i=0;
		var liczba_wyslanych;
		var liczba_nie_wyslanych;
		var email_t;
		var mailing_odbiorcy = [];
		
		var wyslij_jako_udw = ($('.wyslij_jako_udw').hasClass('zaznaczone')) ? '1' : '0';
		var priorytet = ($('.wyslij_priorytet').hasClass('zaznaczone')) ? 1 : 0;
		
		
		if(wyslij_jako_udw == '1'){
			
			if(liczba_adresatow < 11){
				wyswitl_powiadomienie('Minimalna liczba odbiorców to 10!!! Wyślij pojedyńczo!!!', 0, 0);
				ukryj_loader();
				return false;
			}
			
			var mailing_odbiorcy_dw = [];
			
			for(i=0;i<liczba_adresatow;i++){
				mailing_odbiorcy_dw[i] =  {
						'email' : $('.mailing_odbiorca_email')[i].getAttribute("data-adresat_email"),
						'status': '1',
						'komunikat': 'Mail został wysłany prawidłowo'
						};

			}
			
			
			/*szybka wysylka maili*/
			var liczba_elementow_w_paczce = parseInt($('.wyslij_jako_udw_liczba_w_paczce').val());
			var liczba_paczek = Math.floor((mailing_odbiorcy_dw.length)/liczba_elementow_w_paczce);
			var liczba_poza_paczkami = (mailing_odbiorcy_dw.length) % liczba_elementow_w_paczce;
			
			if(liczba_poza_paczkami != 0){
				liczba_paczek = liczba_paczek + 1;
			}
						
			var dw_od = 0;
			var dw_do = liczba_elementow_w_paczce;
			var dw = 0;
			var lista_maili_pocietych = [];
			var dw_o = 0;
			var dw_i = 0;
			for(i=0;i<liczba_paczek;i++){
				
				lista_maili_pocietych[i] = [];
				
				for(dw=dw_od;dw<dw_do;dw++){
									
					lista_maili_pocietych[i][dw_i] = {
							'email' : mailing_odbiorcy_dw[dw_o]['email']
					};
					
					dw_i++;
					dw_o++;
				}
				dw_i = 0;
				dw = 0;
				dw_od = dw_do;
								
				if(liczba_poza_paczkami == 0){
					dw_do = dw_do + liczba_elementow_w_paczce;
				}else{
					dw_do = dw_do + liczba_elementow_w_paczce;
					if(dw_do > mailing_odbiorcy_dw.length){
						dw_do = mailing_odbiorcy_dw.length;
					}
				}
				
			}
			
			var log_caly = '';
			
			var liczba_wroconych = 0;
			$('.loader_napis').data('liczba_wyslanych_paczek',0);
			$('.loader_napis').attr('data-liczba_wyslanych_paczek',0);
			$('.loader_napis').text('Wysłano '+liczba_wroconych+' z '+liczba_paczek+' paczek!!!');
			
			var index_skrzynki = 0;
			
			for(i=0;i<liczba_paczek;i++){
				//alert(JSON.stringify(lista_maili_pocietych[i]));
				
				if(index_skrzynki == 4){
					index_skrzynki = 0;
				}
				
				$.ajax({
					method: "POST",
					url: "ajax/akcje/ajax_mailing_wyslij_dw",
					data: {
						mailing_adresat_imie_nazwisko : mailing_adresat_imie_nazwisko,
						mailing_adresat_email: mailing_adresat_email,
						mailing_temat: mailing_temat,
						mailing_odbiorcy_dw : lista_maili_pocietych[i],
						mailing_tresc : mailing_tresc,
						mailing_obrazki : mailing_obrazki,
						mailing_zalaczniki : mailing_zalaczniki,
						priorytet : priorytet,
						index_skrzynki : index_skrzynki
					},
					async: false
					
				}).done(function(data){
					
					zeruj_licznik_sesji_po_wykonaniu_funkcji();
					
					var array = $.parseJSON(data);
					
					if(array[0] == '0'){
						log_caly = log_caly + (array[2].toString());
					}
					
					liczba_wroconych = liczba_wroconych + 1;
					
					$('.loader_napis').data('liczba_wyslanych_paczek',(liczba_wroconych));
					$('.loader_napis').attr('data-liczba_wyslanych_paczek',(liczba_wroconych));
					$('.loader_napis').text('Wysłano '+(liczba_wroconych)+' z '+liczba_paczek+' paczek!!!');
					
					if($('.loader_napis').data('liczba_wyslanych_paczek') == liczba_paczek){
						for(i=0;i<liczba_adresatow;i++){
							
							if(log_caly.indexOf(mailing_odbiorcy_dw[i]['email']) > 0){
								
								mailing_odbiorcy_dw[i]['status'] = '0';
								mailing_odbiorcy_dw[i]['komunikat'] = 'Błąd';
							}
						}								
						
						mailing_wyslij_kopie_do_it(mailing_adresat_imie_nazwisko,mailing_adresat_email,mailing_temat,mailing_tresc,mailing_obrazki,mailing_zalaczniki,priorytet);
						mailing_zapisz_zaktualizuj_po_wysylce(mailing_adresat_imie_nazwisko,mailing_adresat_email,mailing_temat,mailing_tresc,mailing_obrazki,mailing_zalaczniki,mailing_odbiorcy_dw);
						
					} 
					
					
					
				}).fail(function(ajaxContext) {			
					document.getElementById("body_strona_r").innerHTML = ajaxContext.responseText ;
				});
								
				index_skrzynki++;
			}
					
			
				/*$.ajax({
					method: "POST",
					url: "ajax/akcje/ajax_mailing_wyslij_dw_po_php",
					data: {
						mailing_adresat_imie_nazwisko : mailing_adresat_imie_nazwisko,
						mailing_adresat_email: mailing_adresat_email,
						mailing_temat: mailing_temat,
						mailing_odbiorcy_dw : mailing_odbiorcy_dw,
						mailing_tresc : mailing_tresc,
						mailing_obrazki : mailing_obrazki,
						mailing_zalaczniki : mailing_zalaczniki,
						priorytet : priorytet,
						liczba_elementow_w_paczce : liczba_elementow_w_paczce
					}
					
				}).done(function(data){
					
					var array = $.parseJSON(data);
									
					wyswitl_powiadomienie('Maile zostały wysłane!!!', 1, 0);
					mailing_wyslij_kopie_do_it(mailing_adresat_imie_nazwisko,mailing_adresat_email,mailing_temat,mailing_tresc,mailing_obrazki,mailing_zalaczniki,priorytet);
					
					if(array[0] == '0'){
						var log = array[2].toString();
					
						for(i=0;i<liczba_adresatow;i++){
							
							if(log.indexOf(mailing_odbiorcy_dw[i]['email']) > 0){
								
								mailing_odbiorcy_dw[i]['status'] = '0';
								mailing_odbiorcy_dw[i]['komunikat'] = 'Błąd';
							}
						}
					}
					
					
					mailing_zapisz_zaktualizuj_po_wysylce(mailing_adresat_imie_nazwisko,mailing_adresat_email,mailing_temat,mailing_tresc,mailing_obrazki,mailing_zalaczniki,mailing_odbiorcy_dw);
					
					zeruj_licznik_sesji_po_wykonaniu_funkcji();
					
				}).fail(function(ajaxContext) {			
					document.getElementById("body_strona_r").innerHTML = ajaxContext.responseText ;
				});
				
				*/
				
			
			
			
		}else{
			
			var liczba_wroconych = 0;
			$('.loader_napis').data('liczba_wyslanych_paczek',0);
			$('.loader_napis').attr('data-liczba_wyslanych_paczek',0);
			$('.loader_napis').text('Wysłano '+liczba_wroconych+' z '+liczba_adresatow+' maili!!!');
			
			var licza_maili_jako_do_wiadomosci = 0;
			var mailing_odbiorcy_do_wiadomosci = [];
			var iop_dw = 0;
			
			for(i=0;i<liczba_adresatow;i++){
				
				
				
				var ile_od_przy_dw = $('.mailing_odbiorca_pojedynczy_email').size();

				if(ile_od_przy_dw != 0){
					mailing_odbiorca = $('.mailing_odbiorca_pojedynczy_email').data('adresat_email');
					licza_maili_jako_do_wiadomosci = $('.mailing_odbiorca_do_wiadomosci_email').size();
					
					for(iop_dw = 0;iop_dw<licza_maili_jako_do_wiadomosci;iop_dw++){
						mailing_odbiorcy_do_wiadomosci[iop_dw] = {
								'email' : $('.mailing_odbiorca_do_wiadomosci_email')[iop_dw].getAttribute("data-adresat_email")
						};
					}
					
				}else{
					mailing_odbiorca = $('.mailing_odbiorca_email')[i].getAttribute("data-adresat_email");
				}
				
						
				$.ajax({
					method: "POST",
					url: "ajax/akcje/ajax_mailing_wyslij",
					data: {
						mailing_adresat_imie_nazwisko : mailing_adresat_imie_nazwisko,
						mailing_adresat_email: mailing_adresat_email,
						mailing_temat: mailing_temat,
						mailing_odbiorca : mailing_odbiorca,
						mailing_tresc : mailing_tresc,
						mailing_obrazki : mailing_obrazki,
						mailing_zalaczniki : mailing_zalaczniki,
						numer_index: i,
						priorytet : priorytet,
						licza_maili_jako_do_wiadomosci : licza_maili_jako_do_wiadomosci,
						mailing_odbiorcy_do_wiadomosci : mailing_odbiorcy_do_wiadomosci
					},
					async: false
					
				}).done(function(data){
					
					var array = $.parseJSON(data);
					
					var index = parseInt(array[1]);
					
					if(licza_maili_jako_do_wiadomosci != 0){
						var odpowiedz_z_serwera = array[2].toString();
							
						mailing_odbiorcy[0] = {
								'email': 	mailing_odbiorca
							};
						
						iop_dw = 0;

						for(i=1;i<(licza_maili_jako_do_wiadomosci+1);i++){

							mailing_odbiorcy[i] = {
									'email': 	mailing_odbiorcy_do_wiadomosci[iop_dw]['email']
								};											
							iop_dw++;
						}
						
						iop_dw = 0;
												
						for(iop_dw=0;iop_dw<(licza_maili_jako_do_wiadomosci+1);iop_dw++){
							
							//alert(mailing_odbiorcy[iop_dw]['email']);
							
							if(odpowiedz_z_serwera.indexOf(mailing_odbiorcy[iop_dw]['email']) > 0){
								
								mailing_odbiorcy[iop_dw]['status'] = '0';
								mailing_odbiorcy[iop_dw]['komunikat'] = 'Błąd';
							}else{
								mailing_odbiorcy[iop_dw]['status'] = '1';
								mailing_odbiorcy[iop_dw]['komunikat'] = 'Mail wysłany prawidłowo';
							}
														
						}
						
						
											
						wyswitl_powiadomienie('Maile zostały wysłane!!!', 1, 0);	
						
						mailing_wyslij_kopie_do_it(mailing_adresat_imie_nazwisko,mailing_adresat_email,mailing_temat,mailing_tresc,mailing_obrazki,mailing_zalaczniki,priorytet);
						
						mailing_zapisz_zaktualizuj_po_wysylce(mailing_adresat_imie_nazwisko,mailing_adresat_email,mailing_temat,mailing_tresc,mailing_obrazki,mailing_zalaczniki,mailing_odbiorcy);

					}else{
						if(array[0]==='0'){
							$('.mailing_odbiorca_email')[index].setAttribute("class", "nie_wyslany mailing_odbiorca_email");
							email_t = $('.mailing_odbiorca_email')[index].getAttribute("data-adresat_email");
							var komunikat_bledu = array[2].toString();
							$('.mailing_odbiorca_email')[index].innerHTML = '<div class="bledny_mail"><div class="bledny_mail_napis">'+email_t+'</div><div class="mail_nie_wyslany_ikona"><div class="mail_nie_wyslany">'+komunikat_bledu+'</div></div><div class="clear_b"></div></div>' ;
							
							mailing_odbiorcy[index] = {
								'email': 	email_t,
								'status': '0',
								'komunikat': komunikat_bledu
							};
						}
						
						if(array[0]==='1'){
							$('.mailing_odbiorca_email')[index].setAttribute("class", "wyslany mailing_odbiorca_email");
							email_t = $('.mailing_odbiorca_email')[index].getAttribute("data-adresat_email");
							$('.mailing_odbiorca_email')[index].innerHTML = '<div class="poprawny_mail"><div class="poprawny_mail_napis">'+email_t+'</div><div class="mail_wyslany_ikona" ><div class="mail_wyslany">Mail wysłany prawidłowo do: '+email_t+'</div></div><div class="clear_b"></div></div>' ;
							
							mailing_odbiorcy[index] = {
									'email': 	email_t,
									'status': '1',
									'komunikat': 'Mail wysłany prawidłowo'
								};
						}
						
						liczba_wyslanych = $('.wyslany').size();
						liczba_nie_wyslanych = $('.nie_wyslany').size();
						
						if(liczba_adresatow == (liczba_wyslanych+liczba_nie_wyslanych)){				
														
							wyswitl_powiadomienie('Maile zostały wysłane!!!', 1, 0);	
							
							mailing_wyslij_kopie_do_it(mailing_adresat_imie_nazwisko,mailing_adresat_email,mailing_temat,mailing_tresc,mailing_obrazki,mailing_zalaczniki,priorytet);
							
							mailing_zapisz_zaktualizuj_po_wysylce(mailing_adresat_imie_nazwisko,mailing_adresat_email,mailing_temat,mailing_tresc,mailing_obrazki,mailing_zalaczniki,mailing_odbiorcy);

						}
					}
					
					
					
					liczba_wroconych = liczba_wroconych + 1;
					
					$('.loader_napis').data('liczba_wyslanych_paczek',(liczba_wroconych));
					$('.loader_napis').attr('data-liczba_wyslanych_paczek',(liczba_wroconych));
					$('.loader_napis').text('Wysłano '+(liczba_wroconych)+' z '+liczba_adresatow+' maili!!!');
					
					zeruj_licznik_sesji_po_wykonaniu_funkcji();
					
				}).fail(function(ajaxContext) {			
					document.getElementById("body_strona_r").innerHTML = ajaxContext.responseText ;
				});
			}
		}
		
	});
}

function mailing_wyslij_kopie_do_it(mailing_adresat_imie_nazwisko,mailing_adresat_email,mailing_temat,mailing_tresc,mailing_obrazki,mailing_zalaczniki,priorytettmp){
	var mailing_odbiorca_tmp = 'it@votum-sa.pl';
	var mailing_temat_tmp = '[MAILING WYSŁANY] '+mailing_temat;
	

	
	//alert(priorytettmp);
	
	$.ajax({
		method: "POST",
		url: "ajax/akcje/ajax_mailing_wyslij",
		data: {
			mailing_adresat_imie_nazwisko : mailing_adresat_imie_nazwisko,
			mailing_adresat_email: mailing_adresat_email,
			mailing_temat: mailing_temat_tmp,
			mailing_odbiorca : mailing_odbiorca_tmp,
			mailing_tresc : mailing_tresc,
			mailing_obrazki : mailing_obrazki,
			mailing_zalaczniki : mailing_zalaczniki,
			priorytet : priorytettmp
		}
		
	}).done(function(){
				
		zeruj_licznik_sesji_po_wykonaniu_funkcji();
		
	}).fail(function(ajaxContext) {			
		document.getElementById("body_strona_r").innerHTML = ajaxContext.responseText ;
	});

}

function mailing_zapisz_schemat(){
	$('.mailing_zapisz_schemat').click(function(){
		
		var mailing_temat_wiadomosci = $('.mailing_tytul_pole').val();
		var mailing_id = $('.mailing_naglowek').data('mailing_id');
		
		
		
		if(mailing_id == ''){
			var url_ajax = 'ajax/akcje/ajax_mailing_dodaj_nowy';
		}else{
			var url_ajax = 'ajax/akcje/ajax_mailing_zapisz_zmiany';
		}
				
		if(mailing_temat_wiadomosci == ''){
			wyswitl_powiadomienie('Wprowadź temat wiadomości!!!', 0, 0);
			return false;
		}
		
		var mailing_adresat_imie_nazwisko = $('.mailing_adresat_imie_nazwisko').val();
		
		if(mailing_adresat_imie_nazwisko == '' || mailing_adresat_imie_nazwisko == undefined){
			mailing_adresat_imie_nazwisko = $('.mailing_adresat_imie_nazwisko_p').text();
		}
		
		var mailing_adresat_email = $('.mailing_adresat_email').val();
		
		if(mailing_adresat_email == '' || mailing_adresat_email == undefined){
			mailing_adresat_email = $('.mailing_adresat_email_p').text();
		}
		
		var mailing_tresc = $('.wysiwyg-editor').html();
		
		$.ajax({
			method: "POST",
			url: url_ajax,
			data: {
				mailing_temat_wiadomosci : mailing_temat_wiadomosci,
				mailing_adresat_imie_nazwisko : mailing_adresat_imie_nazwisko,
				mailing_adresat_email : mailing_adresat_email,
				mailing_tresc : mailing_tresc,
				mailing_id : mailing_id
			}
			
		}).done(function(data){
			
			$('.mailing_naglowek').data('mailing_id',data);
			$('.mailing_naglowek').attr('data-mailing_id',data);
			
			wyswitl_powiadomienie('Schemat mailingu został zapisany!!!', 1, 0);
					
			zeruj_licznik_sesji_po_wykonaniu_funkcji();
			
		}).fail(function(ajaxContext) {			
			document.getElementById("body_strona_r").innerHTML = ajaxContext.responseText ;
		});
		
	});
}

function mailing_zapisz_zaktualizuj_po_wysylce(mailing_adresat_imie_nazwisko,mailing_adresat_email,mailing_temat,mailing_tresc,mailing_obrazki,mailing_zalaczniki,mailing_odbiorcy){
		
	$.ajax({
		method: "POST",
		url: "ajax/akcje/ajax_mailing_historia_dodaj_nowy",
		data: {
			mailing_adresat_imie_nazwisko: mailing_adresat_imie_nazwisko,
			mailing_adresat_email: mailing_adresat_email,
			mailing_temat: mailing_temat,
			mailing_tresc: mailing_tresc,
			mailing_obrazki: mailing_obrazki,
			mailing_zalaczniki: mailing_zalaczniki,
			mailing_odbiorcy: mailing_odbiorcy
		}
		
	}).done(function(data){
						
		//alert(data);
		ukryj_loader();
		$('.element_do_wyboru').removeClass('aktywny');
		$('#lista_wyslanych').addClass('aktywny');
		lista_wyslanych_wyswietl();
		zeruj_licznik_sesji_po_wykonaniu_funkcji();
		
	}).fail(function(ajaxContext) {			
		document.getElementById("body_strona_r").innerHTML = ajaxContext.responseText ;
	});
}

function mailing_schemat_usun(){
	$('.mailing_usun_schemat').click(function(){
		$('.mailing_usun_schemat_czjp').toggleClass('wysun');
	});
	
	$('.mailing_usun_schemat_tak').click(function(){
		var mailing_id = $('.mailing_naglowek').data('mailing_id');
		$.ajax({
			method: "POST",
			url: "ajax/akcje/ajax_mailing_usun_schemat",
			data: {
				mailing_id: mailing_id
			}
			
		}).done(function(data){
							
			lista_schematow_wyswietl();
			
			wyswitl_powiadomienie('Zmiany zostały zapisane!!!', 1, 0);
			
			zeruj_licznik_sesji_po_wykonaniu_funkcji();
			
		}).fail(function(ajaxContext) {			
			document.getElementById("body_strona_r").innerHTML = ajaxContext.responseText ;
		});
	});
}

/*kamyk 2016-09-16*/
function mailing_dodaj_liste_maili_grupy_struktury(){
	$('.dodaj_maile_elementu').click(function(){
		var element_id = $(this).data('element_id');
		var rodzaj = $(this).data('rodzaj');
		
		var pole = $(this);
		
		$.ajax({
			method: "POST",
			url: "ajax/akcje/ajax_mailing_dodaj_liste_maili_grupy_struktury",
			data: {
				element_id: element_id,
				rodzaj : rodzaj
			}
			
		}).done(function(data){
							
			wyswitl_powiadomienie('Lista została zaimportowana!!!', 1, 0);
			
			$('#mailing_odbiorca_lista').append(data);
			
			$('.usun_mail').click(function(){
				$(this).parent().remove();
			});
			
			pole.remove();
			
			zeruj_licznik_sesji_po_wykonaniu_funkcji();
			
		}).fail(function(ajaxContext) {			
			document.getElementById("body_strona_r").innerHTML = ajaxContext.responseText ;
		});
	});
}


function mailing_dodaj_adres_do_wiadomosci(){
	$('.dodaj_mailing_dw_a').click(function(){
		var adres_email = $(this).prev().val();
		
		$(this).prev().val('');
		if(adres_email != ''){
			$('#mailing_dw_a').append('<div class="mailing_odbiorca_do_wiadomosci_email" data-adresat_email="'+adres_email+'"><p class="mail_napis">'+adres_email+'</p><span class="usun_mail"><span>x</span></span><div class="clear_b"></div></div>');
			
			
			
			$('.usun_mail').click(function(){
				$(this).parent().remove();
				
				var ile_dw = $('.mailing_odbiorca_do_wiadomosci_email').size();
				if(ile_dw == 0){
					$('.mailing_odbiorcy_bez_dw').show();
					$('.mailing_pojedynczy_odbiorca').hide();
					$('#mailing_odbiorca_pojedynczy_a').html('');
				}
				
			});
			$('.mailing_pojedynczy_odbiorca').show();
			$('.mailing_odbiorcy_bez_dw').hide();
		}
		
	});
}

function mailing_dodaj_adres_pojedynczy_odbiorcy(){
	$('.dodaj_mailing_odbiorca_a').click(function(){
		var adres_email = $(this).prev().val();
		
		$(this).prev().val('');
		if(adres_email != ''){
			$('#mailing_odbiorca_pojedynczy_a').append('<div class="mailing_odbiorca_pojedynczy_email" data-adresat_email="'+adres_email+'"><p class="mail_napis">'+adres_email+'</p><span class="usun_mail"><span>x</span></span><div class="clear_b"></div></div>');
			
			
			
			$('.usun_mail').click(function(){
				$(this).parent().remove();
				
				var ile_od_przy_dw = $('.mailing_odbiorca_pojedynczy_email').size();
				if(ile_od_przy_dw == 0){
					$('.mailing_odbiorca_pojedynczy_a_pole').show();
				}
				
			});
			$('.mailing_odbiorca_pojedynczy_a_pole').hide();
		}
		
	});
}































