<?php
    if(!isset($_POST['linkAktywacyjny'])){
        return;
    }
?>

<table width="600px" cellpadding="10" style="border:1px solid #CCC; border-left:5px solid #CCC; font-family: Calibri"  align="center">
    <tbody border="0" align="center" valign="midle">
    <tr align="center" valign="midle">
        <td align="center" valign="midle" ></td>
    </tr>
    <tr align="center" valign="midle">
        <td align="center" valign="midle">
            <b>WITAMY w systemie CRM VOTUM S.A.</b>
        </td>
    </tr>
    <tr align="center" valign="midle">
        <td align="center" valign="midle">
            <img src="cid:mojelogo" alt="" />
        </td>
    </tr>
    <tr align="center" valign="midle">
        <td  align="center" valign="midle">
            ------------------------------------------
        </td>
    </tr>
    <tr align="center" valign="midle">
        <td align="center" valign="midle">
            Aby aktywawować dostęp do aplikacji należy w ciągu <b>30 minut</b> uzupełnić dane na stronie:
        </td>
    </tr>
    <tr align="center" valign="midle">
        <td align="center" valign="midle">
            <a href="<?php echo $_POST['linkAktywacyjny']; ?>" target="_blank"><?php echo $_POST['linkAktywacyjny']; ?></a>
        </td>
    </tr >
    <tr align="center" valign="midle">
        <td align="center" valign="midle">
            Na podany w ankiecie numer telefonu komórkowego została wysłana wiadomość SMS.
        </td>
    </tr>
    <tr align="center" valign="midle">
        <td align="center" valign="midle">
            Otrzymane hasło należy wpisac w pole <b>"Hasło sms"</b>.
        </td>
    </tr>
    <tr align="center" valign="midle">
        <td  align="center" valign="midle">
            ------------------------------------------
        </td>
    </tr>
    <tr align="center" valign="midle">
        <td align="center" valign="midle" style="color:#C9252C;">
            WIADOMOŚĆ ZOSTAŁA WYGENEROWANA AUTOMATYCZNIE!!!<br/> PROSIMY NA NIĄ NIE ODPOWIADAĆ!!!
        </td>
    </tr>
    <tr align="center" valign="midle">
        <td align="center" valign="midle" ></td>
    </tr>

    </tbody>
</table>