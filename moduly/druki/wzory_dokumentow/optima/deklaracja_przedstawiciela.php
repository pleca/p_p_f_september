<link rel="stylesheet"
	href="<?php echo 'https://' . $_SERVER ['HTTP_HOST'] . '/wzory_dokumentow/css/zgloszenie_szkody.css'; ?>"
	type="text/css" />
<?php
require_once ($_SERVER ['DOCUMENT_ROOT'] . 'moduly/sprawy/db/funkcje_db.php');
(isset ( $_POST ['id_sprawy'] )) ? $id_sprawy = $_POST ['id_sprawy'] : $id_sprawy = $_GET ['id_sprawy'];

(isset ( $_POST ['uzytkownik_id'] )) ? $uzytkownik_id = $_POST ['uzytkownik_id'] : $uzytkownik_id = $_GET ['uzytkownik_id'];

$sprawa = sprawa_pobierz_dane_sprawy ( $id_sprawy );
$dane_uzytkownika = uzytkownik_pobierz_po_id ( $uzytkownik_id );

$id_zdarzenia = $sprawa ['sprawa_zdarzenie_id'];

$zdarzenie = sprawa_pobierz_dane_z_tabeli_zdarzenie ( $id_zdarzenia );
?>
<div class="strona strona_11">
	<!--<div class="logo_fair_play"></div>-->
	<div class="logo_votum"></div>
	<div class="tytul_strony_pierwszej">
		<p>DEKLARACJA</p>
	</div>
	<div class="sekcja_bez_odstepu">
		<div class="sekcja_tresc margin_top_35">
			<p>
				Szanowni Państwo!</br> </br> Pragnę osobiście potwierdzić, że Pani/i
				<?php echo $dane_uzytkownika['imie']. ' '.$dane_uzytkownika['nazwisko']; ?> legitymujący/a się dowodem
				osobistym nr ___________________________ jest autoryzowanym
				pełnomocnikiem Votum S .A. ( nr pełnomocnictwa
				________________________ ).</br> Złożenie przez Państwa podpisu na <span
					class="pogrubienie">umowie o dochodzenie roszczeń z obsługą
					procesową</span> za wypadek z dnia <?php echo $zdarzenie['data']; ?> jest równoznaczne ze złożeniem reprezentowanej przez niego spółce oferty zlecenia usług, wiążących się ze szczególną odpowiedzialnością. Zapewniam, że za rozpatrzenie oferty i realizację umowy odpowiada zespół specjalistów o najwyższych kompetencjach.
		</p>
		</div>
		<div class="podpis_krupa"></div>
	</div>

	<div class="sekcja_bez_odstepu">
		<div class="sekcja_tresc margin_top_200">
			<p>
				W celu rozpatrzenia oferty pełnomocnik zobowiązuje się do
				niezwłocznego przekazania do Spółki dokumentacji, na którą składa
				się:</br> 1. umowa – 2 egzemplarze podpisane własnoręcznie przez
				Klienta,</br> 2. pouczenie – 1 egzemplarz podpisany własnoręcznie
				przez Klienta,</br> 3. pełnomocnictwo – 3 egzemplarze podpisane
				własnoręcznie przez Klienta,</br> 4. pełnomocnictwo procesowe – 2
				egzemplarze podpisane własnoręcznie przez Klienta,</br> 5.
				zgłoszenie szkody – 1 egzemplarz podpisany własnoręcznie przez
				Klienta,</br> 6. dokumentacja szkody – ________________________
				(słownie: _________________________________________) kart.</br> </br>
				Pełnomocnik pozostawia u Państwa następujące dokumenty:</br> 1.
				potwierdzenie zamówienia (druk umowy) – 1 egzemplarz,</br> 2.
				pouczenie oraz wzór odstąpienia od umowy – 1 egzemplarz,</br> 3.
				kopia zgłoszenia szkody – 1 egzemplarz.</br> </br> Wpływ
				dokumentacji do Votum S.A. jest potwierdzany wiadomością SMS, w
				której podamy Państwu unikalny numer szkody – nie należy podawać go
				osobom nieupoważnionym
			</p>
		</div>
	</div>

	<div class="sekcja">
		<div class="sekcja_tresc">
			<div class="podpis_lewo small_font">Podpis Pełnomocnika Spółki</div>
			<div class="podpis_prawo small_font">Podpis Klienta</div>
			<div class="clear_b"></div>
		</div>
	</div>

	<div class="sekcja">
		<div class="sekcja_tresc">
			<div class="baner_red">CO TO JEST POTWIERDZENIE ZAMÓWIENIA?</div>
			<div class="clear_b"></div>
		</div>
	</div>
	<div class="sekcja">
		<div class="sekcja_tresc">
			</br>
			<p>
				Pełnomocnik nie zawiera umowy z klientem, gdyż chcemy, aby to <span
					class="pogrubienie">nasi prawnicy</span> szczegółowo zbadali
				możliwość uzyskania maksymalnej ilości różnych świadczeń
				odszkodowawczych w możliwie największych kwotach.
			</p>
			</br>
			<p>
				<span class="pogrubienie">Nie składamy obietnic bez pokrycia</span>,
				więc tak jak w tradycyjnych kancelariach rozpoczynamy obsługę od <span
					class="pogrubienie">analizy dokumentacji dokonanej przez
					profesjonalistę</span> – z tą różnicą że u nas jest ona <span
					class="pogrubienie">bezpłatna</span>. Jednocześnie zostawiamy
				Państwu potwierdzenie złożonego zamówienia, aby znali Państwo
				warunki świadczenia usług przez VOTUM S.A.
			</p>
			</br>
			<p>
				Jeżeli nie będzie możliwości dochodzenia roszczeń <span
					class="pogrubienie">nie wiążecie się Państwo bez potrzeby żadną
					umową</span>. W takiej sytuacji <span class="pogrubienie">na piśmie</span>
				poinformujemy Państwa, co jest przeszkodą w uzyskaniu odszkodowania.
			</p>
			</br>
			<p>
				Jeżeli możemy wspólnie działać umowa zostanie podpisana i odesłana
				pocztą. Uzyskacie Państwo wiarygodne potwierdzenie <span
					class="pogrubienie">rzetelnej analizy</span> poparte fachową oceną
				dokumentacji. Nie dokonuje jej nasz autoryzowany pełnomocnik, gdyż w
				trosce o jej najwyższą jakość dodatkową weryfikację przeprowadza
				specjalista posiadający wiedzę prawniczą i doświadczenie w
				merytorycznym prowadzeniu spraw przed ubezpieczycielami.
			</p>
			<div class="clear_b"></div>
		</div>
	</div>

	<div class="strona_stopka">
        <div class="linie_full"></div>
		<div class="stopka_do_lewej">
			<div class="logo_gpw"></div>
            <div class="logo_fair_play"></div>
			<span class="pogrubienie">VOTUM S.A. z siedzibą we Wrocławiu</span> zarejestrowana w Sądzie Rejonowym dla Wrocławia-Fabrycznej we Wrocławiu,
            IV Wydział Gospodarczy Krajowego Rejestru Sądowego pod numerem KRS: 0000243252, NIP: 899-25-49-057, REGON: 020136043, KAPITAŁ ZAKŁADOWY: 1 200 000 zł wpłacony w całości,
            ul, Wyścigowa 56i, 53-012 Wrocław, tel. +48 71 339 34 OO, fax +48 71 339 34 03,
			infolinia: 800 217 417, biuro@votum-sa.pl, www.votum-sa.pl</br>
		</div>
		<div class="linie_full"></div>
	</div>

</div>

<div class="strona strona_12">
    <!--<div class="logo_fair_play"></div>-->
	<div class="logo_votum"></div>
	<div class="sekcja margin_top_100">
		<div class="sekcja_tresc">
			<div class="baner_red">DLACZEGO JESTEŚMY NAJLEPSI W TYM CO ROBIMY?</div>
			<div class="clear_b"></div>
		</div>
	</div>
	<div class="sekcja">
		<div class="sekcja_tresc">
			</br>
			<p>
				Uzyskujemy <span class="pogrubienie">najwyższe odszkodowania</span>:
			</p>
			<ul>
				<li>nawet 1 milion dwieście tys. zł samego zadośćuczynienia za
					obrażenia ciała,</li>
				<li>nawet 450 tys. zł zadośćuczynienia i odszkodowania za utratę
					najbliższych członków rodziny,</li>
				<li>nawet 400 tys. zł odsetek za opóźnienie ubezpieczyciela.</li>
			</ul>
			</br>
			<p>
				Gwarantujemy najwyższe <span class="pogrubienie">bezpieczeństwo</span>:
			</p>
			<ul>
				<li>spółka giełdowa <span class="pogrubienie">nadzorowana przez
						Komisję Nadzoru Finansowego</span>,
				</li>
				<li>roszczenia naszych klientów są objęte ochroną do kwoty 2 mln zł
					wynikającą z naszego <span class="pogrubienie">ubezpieczenia OC</span>,
				</li>
				<li>to Ty decydujesz o wytoczeniu procesu przez naszą kancelarię lub
					zawarciu ugody.</li>
			</ul>
			</br>
			<p>
				Zapewniamy największe <span class="pogrubienie">możliwości</span>:
			</p>
			<ul>
				<li>największa na rynku <span class="pogrubienie">ilość
						przeprowadzonych postępowań</span> odszkodowawczych i procesów,
				</li>
				<li>najwyższa na rynku <span class="pogrubienie">suma odszkodowań</span>
					uzyskanych od ubezpieczycieli,
				</li>
				<li>największy udział w rynku - <span class="pogrubienie">co trzeci
						klient kancelarii odszkodowawczych wybiera Votum S.A.</span></li>
			</ul>
			</br>
			<div class="clear_b"></div>
		</div>
	</div>

	<div class="sekcja">
		<div class="sekcja_tresc">
			<div class="baner_red">DLACZEGO NASZA UMOWA JEST NAJKORZYSTNIEJSZA?</div>
			<div class="clear_b"></div>
		</div>
	</div>
	<div class="sekcja">
		<div class="sekcja_tresc">
			</br>
			<p>
				Z nami <span class="pogrubienie">wydane pieniądze wrócą do Ciebie w
					całości</span>:
			</p>
			<ul>
				<li>Votum nie pobiera wynagrodzenia od uzyskanych zwrotów kosztów
					leczenia, rehabilitacji i sprzętu ortopedycznego,</li>
				<li>Votum nie pobiera wynagrodzenia od uzyskanych zwrotów kosztów
					związanych z pogrzebem,</li>
				<li>Votum nie pobiera wynagrodzenia od uzyskanych
					nieskapitalizowanych rent.</li>
			</ul>
			</br>
			<p>
				Dzięki nam zyskujesz <span class="pogrubienie">najszerszą obsługę,
					bezpieczeństwo i wygodę na każdym etapie sprawy</span>:
			</p>
			<ul>
				<li>nie musisz sam zebrać całej dokumentacji – podejmujemy działania
					zmierzające do ustalenia sprawcy, jego ubezpieczyciela, oraz
					wszystkich dowodów pozwalających uzyskać najwyższe odszkodowanie,</li>
				<li>nie musisz godzić się na warunki ubezpieczyciela – w ramach
					naszej umowy masz zapewnioną reprezentację w procesie sądowym,</li>
				<li>Ty decydujesz czy odszkodowanie jest wystarczające – decyzję o
					wytoczeniu procesu lub zawarciu ugody podejmuje u nas Klient.</li>
			</ul>
			</br>
			<p>Ponadto zapewniamy Ci uczciwe i transparentne warunki wynikające z
				przepisów prawa:</p>
			<ul>
				<li>cenę podajemy z uwzględnieniem podatku VAT, w <span
					class="pogrubienie">rzeczywistej stawce</span> BRUTTO,
				</li>
				<li><span class="pogrubienie">nie stosujemy</span> jednostronnych
					kar umownych, ani opłat manipulacyjnych za prowadzenie sprawy bez
					efektu,</li>
				<li>zapewniamy możliwość składania reklamacji, <span
					class="pogrubienie">jeżeli jakość naszych usług</span> nie będzie
					odpowiadała Państwa oczekiwaniom.
				</li>
			</ul>
			</br>
			<div class="clear_b"></div>
		</div>
	</div>

	<div class="sekcja">
		<div class="sekcja_tresc">
			<div class="baner_red">MASZ PYTANIE? JESTEŚMY DO DYSPOZYCJI</div>
			<div class="clear_b"></div>
		</div>
	</div>
	<div class="sekcja">
		<div class="sekcja_tresc">
			</br>
			<div class="qr"></div>
			<p>W razie jakichkolwiek pytań prosimy o kontakt z Działem Obsługi
				Klienta:</p>
			<p>tel.: 71 339 34 00, e-mail: dok@votum-sa.pl</p>
			<p>W celu przejścia do elektronicznego formularza kontaktowego proszę
				zeskanować kod:</p>
		</div>
	</div>

    <div class="strona_stopka">
        <div class="linie_full"></div>
        <div class="stopka_do_lewej">
            <div class="logo_gpw"></div>
            <div class="logo_fair_play"></div>
            <span class="pogrubienie">VOTUM S.A. z siedzibą we Wrocławiu</span> zarejestrowana w Sądzie Rejonowym dla Wrocławia-Fabrycznej we Wrocławiu,
            IV Wydział Gospodarczy Krajowego Rejestru Sądowego pod numerem KRS: 0000243252, NIP: 899-25-49-057, REGON: 020136043, KAPITAŁ ZAKŁADOWY: 1 200 000 zł wpłacony w całości,
            ul, Wyścigowa 56i, 53-012 Wrocław, tel. +48 71 339 34 OO, fax +48 71 339 34 03,
            infolinia: 800 217 417, biuro@votum-sa.pl, www.votum-sa.pl</br>
        </div>
        <div class="linie_full"></div>
    </div>

</div>