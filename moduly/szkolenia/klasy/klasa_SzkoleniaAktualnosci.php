<?php

require_once($_SERVER ['DOCUMENT_ROOT'] . 'czy_zalogowany.php');

class SzkoleniaAktualnosci extends SzkoleniaMain{
    private $_bd;
    private $_uzytkownikId;
    private $_uzytkownikGrupaId;
    private $_listaAktualnosci = array();
    private $_listaPrzyznanychAktualnosci = array();

    function __construct($bazaDanych){
        $this->_bd = $bazaDanych;
    }

    private function pobierzListeAktualnosci(){
        if($this->_uzytkownikGrupaId === '1' || $this->sprawdzUprawnienie('szkolenia_aktualnosci_edytuj') || $this->sprawdzUprawnienie('szkolenia_aktualnosci_edytuj_wszystkie')){
            $listaElementow_tmp = $this->_bd->pobierzDane('id', 'szkolenia_aktualnosci','czy_usuniety = 0');
            if(!is_null($listaElementow_tmp)){
                while($poj_listaElementow_tmp = $listaElementow_tmp->fetch_object()){
                    array_push($this->_listaPrzyznanychAktualnosci, $poj_listaElementow_tmp->id);
                }
            }
        }else{
            $listaElementow_tmp = $this->_bd->pobierzDane('szkolenia_aktualnosci_id', 'szkolenia_aktualnosci_id_uzytkownik_id','uzytkownik_id = '.$this->_uzytkownikId);
            if(!is_null($listaElementow_tmp)){
                while($poj_listaElementow_tmp = $listaElementow_tmp->fetch_object()){
                    array_push($this->_listaPrzyznanychAktualnosci, $poj_listaElementow_tmp->szkolenia_aktualnosci_id);
                }
            }

            $listaElementow_tmp = $this->_bd->pobierzDane('szkolenia_aktualnosci_id', 'szkolenia_aktualnosci_id_uzytkownik_grupy_id','uzytkownik_grupy_id = '.$this->_uzytkownikGrupaId);
            if(!is_null($listaElementow_tmp)){
                while($poj_listaElementow_tmp = $listaElementow_tmp->fetch_object()){
                    array_push($this->_listaPrzyznanychAktualnosci, $poj_listaElementow_tmp->szkolenia_aktualnosci_id);
                }
            }
            $listaElementow_tmp = $this->_bd->pobierzDane('id', 'szkolenia_aktualnosci','uzytkownik_id = '.$_SESSION['uzytkownik_id']);
            if(!is_null($listaElementow_tmp)){
                while($poj_listaElementow_tmp = $listaElementow_tmp->fetch_object()){
                    array_push($this->_listaPrzyznanychAktualnosci, $poj_listaElementow_tmp->id);
                }
            }
        }

        $this->_listaPrzyznanychAktualnosci = array_unique($this->_listaPrzyznanychAktualnosci);
        $listaWszystkichElementow_tmp = $this->_bd->pobierzDane('id', 'szkolenia_aktualnosci','czy_usuniety = 0', 'nr_kolejnosci ASC');
        if(!is_null($listaWszystkichElementow_tmp)){
            while($poj_lwk_tmp = $listaWszystkichElementow_tmp->fetch_object()){
                if(in_array($poj_lwk_tmp->id, $this->_listaPrzyznanychAktualnosci)){
                    array_push($this->_listaAktualnosci, $poj_lwk_tmp->id);
                }
            }
        }

    }

	public function generujAktualnosc($ki, $kid, $kminiatura, $ktytul, $ktresc, $kzajawka, $kuzytkownik_id){
		echo '<div class="szkolenia_aktualnosc_pojedyncza '.(($ki > 3) ? 'szapp szap_pozostale_'.$ki : '').'" data-element_id="'.$kid.'" >';
		    echo '<div class="szap_opcje" data-element_id="'.$kid.'">';
                if($this->sprawdzUprawnienie('szkolenia_aktualnosci_edytuj') && !$this->sprawdzUprawnienie('szkolenia_aktualnosci_edytuj_wszystkie')) {
                    if ($_SESSION['uzytkownik_id'] == $kuzytkownik_id) {
                        echo '<i class="fa float_l fa-pencil" data-tabela="szkolenia_aktualnosci" data-akcja="edytuj_aktualnosc" aria-hidden="true"></i>';
                    }
                }
                if($this->sprawdzUprawnienie('szkolenia_aktualnosci_edytuj') && $this->sprawdzUprawnienie('szkolenia_aktualnosci_edytuj_wszystkie')) {
                    echo '<i class="fa float_l fa-pencil" data-tabela="szkolenia_aktualnosci" data-akcja="edytuj_aktualnosc" aria-hidden="true"></i>';
                }
                if($this->sprawdzUprawnienie('szkolenia_aktualnosci_historia')) {
                    echo '<i class="fa float_l fa-calendar historiaWyswietl" data-tabela="szkolenia_aktualnosci_historia_zmian-szkolenia_aktualnosci_id" data-element_id="' . $kid . '" aria-hidden="true"></i>';
                }
                echo '<div class="clear_b"></div>';
            echo '</div>';
			echo '<div class="well well-sm" data-akcja="wyswietl_aktualnosc" data-tabela="szkolenia_aktualnosci">';
				if($ki < 4){					
					if(!empty($kminiatura)){
						echo '<div class="szap_img">';
							echo parent::pobierzMiniature('aktualnosci', $kid, $kminiatura);
						echo '</div>';
					}										
				}
				echo '<div class="szap_tresc">';
					echo '<div class="szapt_tytul"><h'.(($ki == 0) ? '3' : '5' ).'>';
						if($ki == 0){
							//echo parent::utnijSlowa($ktytul, 5, ' [...]');
                            echo $ktytul;
						}else if($ki < 4){
							echo parent::utnijSlowa($ktytul, ((empty($kminiatura)) ? 8 : 4 ), ' [...]');
						}else{
							echo parent::utnijSlowa($ktytul, 6, ' [...]');
						}
					echo '</h'.(($ki == 0) ? '3' : '5' ).'></div>';
					echo '<div class="szapt_zajawka"><small>';
						if($ki == 0 || $ki > 3){
							echo parent::utnijSlowa(((empty($kzajawka)) ? preg_replace('/<(|\/)(?!\?).*?(|\/)>/','',htmlspecialchars_decode($ktresc)) : preg_replace('/<(|\/)(?!\?).*?(|\/)>/','',htmlspecialchars_decode($kzajawka))), ((empty($kminiatura) && $ki == 0) ? 210 : 30 ), ' [...]');
						}else{
							echo parent::utnijSlowa(((empty($kzajawka)) ? preg_replace('/<(|\/)(?!\?).*?(|\/)>/','',htmlspecialchars_decode($ktresc)) : preg_replace('/<(|\/)(?!\?).*?(|\/)>/','',htmlspecialchars_decode($kzajawka))), ((empty($kminiatura)) ? 30 : 20 ), ' [...]');
                            //echo parent::utnijSlowa(((empty($kzajawka)) ? $ktresc : $kzajawka), ((empty($kminiatura)) ? 30 : 20 ), ' [...]');

                        }
					echo '</small></div>';
				echo '</div>';
				echo '<div class="clear_b"></div>';
			echo '</div>';
		echo '</div>';
	}

    public function wygenerujListeAktualnosci($kuzytkownikId, $kuzytkownikGrupaId){
        $this->_uzytkownikId = $kuzytkownikId;
        $this->_uzytkownikGrupaId = $kuzytkownikGrupaId;

        $this->pobierzListeAktualnosci();

        return $this->_listaAktualnosci;
    }

}