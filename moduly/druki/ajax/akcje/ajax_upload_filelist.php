<?php
require_once($_SERVER ['DOCUMENT_ROOT'].'czy_zalogowany.php');
setlocale ( LC_CTYPE, "pl_PL.UTF-8" );

$umid = intval($_SESSION["umowaId"]);

$files = $bazaDanych->pobierzDane('*','dokumenty_pliki 
                                    LEFT JOIN `dokumenty_pliki_umowa_link` ON `id` = `pliki_id` ','umowa_id = '.$umid);
while($row = $files->fetch_array())
{
    $arr[] =
        array(
            "nazwa_pliku" => $row["nazwa_pliku"],
            "nazwa_dokumentu" => $row["nazwa_dokumentu"],
            "typ_pliku" => $row["typ_pliku"],
            "umowa_id" => $row["umowa_id"],
            "data_utworzenia" => $row["data_utworzenia"]

        );
}
echo json_encode($arr)
?>