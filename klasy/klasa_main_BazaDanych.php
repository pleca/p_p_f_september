<?php


class main_BazaDanych {
	private $_bd;
		
	private function polaczenie(){
	    if(defined('DB_HOST') && defined('DB_USER') && defined('DB_PASSWORD') && defined('DB_NAME')){
            $this->_bd = new mysqli(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
        }else{
            $this->_bd = new mysqli(MYSQL_HOST,MYSQL_USER,MYSQL_PASSWORD,MYSQL_DB_NAME);
        }

		$this->_bd->set_charset("utf8");
		
		if($this->_bd->connect_errno > 0){
			die('Błąd połączenia z bazą danych [' . $this->_bd->connect_error . ']');
		}
	}
	
	private function odswierzPolaczenie(){
		$this->_bd->close();
		$this->polaczenie();
	}

	public function polaczeniePceSql(){
        $connection = mssql_connect ( PCE_HOST, PCE_USER, PCE_PASSWORD );

        if ($connection == FALSE) {
            die ( "Couldn't connect" );
        }

        if (! mssql_select_db ( PCE_DB_NAME, $connection )) {
            die ( 'Failed to select DB' );
        }

        return $connection;
    }

    public function polaczenieAnakondaSql(){
        $connection = mssql_connect ( ANAKONDA_HOST, ANAKONDA_USER, ANAKONDA_PASSWORD );

        if ($connection == FALSE) {
            die ( "Couldn't connect" );
        }

        if (! mssql_select_db ( ANAKONDA_DB_NAME, $connection )) {
            die ( 'Failed to select DB' );
        }

        return $connection;
    }

	public function pobierzDane($select, $from, $where, $orderby = null){
		//$this->odswierzPolaczenie();
		
		$rezultat = $this->_bd->query(' SELECT '.$select.' FROM '.$from.' WHERE '.$where.((!is_null($orderby)) ? ' ORDER BY '.$orderby : '' ));
		if($rezultat->num_rows !== 0){
			return $rezultat;
		}
		return null;
	}

	public function wstawDane($tabela, $wartosci, $ret_insert_id = true){
        $klucze = '';
        $klucze_wartosci = '';

        foreach($wartosci as $klucz => $wartosc){
            $klucze .= ','.htmlspecialchars($klucz);
            if($wartosc === 'NOW()' || $wartosc === 'null'){
                $klucze_wartosci .= ','.htmlspecialchars($wartosc);
            }else{
                $klucze_wartosci .= ',"'.htmlspecialchars($wartosc).'"';
            }
        }

        $klucze = substr($klucze, 1);
        $klucze_wartosci = substr($klucze_wartosci, 1);

        $this->_bd->query('INSERT INTO '.$tabela.' ('.$klucze.') VALUES ('.$klucze_wartosci.')');

        if($ret_insert_id){
            return $this->_bd->insert_id;
        }

    }

    public function aktualizujDane($tabela, $wartosci, $id_tmp){
        $klucze_wartosci = '';

        foreach($wartosci as $klucz => $wartosc){
            if($wartosc !== ''){
                if($wartosc === 'NOW()' || $wartosc === 'null'){
                    $klucze_wartosci .= ','.htmlspecialchars($klucz).' = '.htmlspecialchars($wartosc);
                }else{
                    $klucze_wartosci .= ','.htmlspecialchars($klucz).' = "'.htmlspecialchars($wartosc).'"';
                }

            }

        }

        $klucze_wartosci = substr($klucze_wartosci, 1);

        $this->_bd->query('UPDATE '.$tabela.' SET '.$klucze_wartosci.' WHERE id = '.$id_tmp);
    }

    public function aktualizujDaneZWarunkiem($tabela, $wartosci, $warunek_tmp){
        $klucze_wartosci = '';

        foreach($wartosci as $klucz => $wartosc){
            if($wartosc !== ''){
                if($wartosc === 'NOW()' || $wartosc === 'null'){
                    $klucze_wartosci .= ','.htmlspecialchars($klucz).' = '.htmlspecialchars($wartosc);
                }else{
                    $klucze_wartosci .= ','.htmlspecialchars($klucz).' = "'.htmlspecialchars($wartosc).'"';
                }

            }

        }

        $klucze_wartosci = substr($klucze_wartosci, 1);

        $this->_bd->query('UPDATE '.$tabela.' SET '.$klucze_wartosci.' WHERE '.$warunek_tmp);
    }

    public function usunDane($tabela, $id_tmp){
        $this->_bd->query('UPDATE '.$tabela.' SET czy_usuniety = 1 WHERE id = '.$id_tmp);
    }

    public function deleteDane($tabela, $wartosc_where){
        $this->_bd->query('DELETE FROM '.$tabela.' WHERE '.$wartosc_where);
    }

    public function przywrocDane($tabela, $id_tmp){
        $this->_bd->query('UPDATE '.$tabela.' SET czy_usuniety = 0 WHERE id = '.$id_tmp);
    }

    public function wywolajProcedureSql($nazwa_procedury, $wartosci, $polaczenie){
        $procedura_tmp = mssql_init($nazwa_procedury, $polaczenie);

        foreach($wartosci as $klucz => $wartosc){
            mssql_bind($procedura_tmp, '@'.$klucz, iconv("UTF-8","cp1250",$wartosc),  SQLVARCHAR);
        }

        return mssql_execute($procedura_tmp);
    }

    public function wywolajProcedure($nazwa_procedury, $wartosci, $parametr_out = NULL){
        $this->odswierzPolaczenie();

        $lista_wartosci = '';

        foreach($wartosci as $wartosc){
            $lista_wartosci .= ',"'.$wartosc.'"';
        }

        if(!is_null($parametr_out)){
            $parametr_out = ',@parametr_out';
        }

        $lista_wartosci = substr($lista_wartosci, 1);

        if(!is_null($parametr_out)){
            $this->_bd->multi_query('CALL '.$nazwa_procedury.'('.$lista_wartosci.$parametr_out.')'.((!is_null($parametr_out)) ? ';SELECT @parametr_out as paramert_out' : '' ));
            $this->_bd->next_result();
            $rezultat = $this->_bd->store_result();
            if($rezultat->num_rows !== 0){
                $paramert_out = $rezultat->fetch_object();
                return $paramert_out->paramert_out;
            }
        }else{
            $rezultat = $this->_bd->query('CALL `'.$nazwa_procedury.'`('.$lista_wartosci.')');
            return $rezultat;
        }

    }

	public function __construct(){
		$this->polaczenie();
	}
	
	public function __sleep(){
		return array('_bd');
	}
	
	public function __wakeup(){
		$this->polaczenie();
	}

}