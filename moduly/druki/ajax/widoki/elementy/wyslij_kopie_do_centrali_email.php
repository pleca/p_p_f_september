<?php
    $agentDane = $widokDane['agentDane']->fetch_object();
    $klientDane = $widokDane['klientDane']->fetch_object();
    $umowaDroga = $widokDane['umowaDroga'];
?>

<table border="1" width="600px">
    <tr>
        <td style="padding:5px 20px;" colspan="2" align="center">Umowa - <?php echo mb_ucfirst($umowaDroga); ?></td>
    </tr>
    <tr>
        <td style="padding:5px 20px;" colspan="2" align="center">Agent dane</td>
    </tr>
    <tr>
        <td style="padding:5px 20px;">Numer</td>
        <td style="padding:5px 20px;"><?php echo $agentDane->login; ?></td>
    </tr>
    <tr>
        <td style="padding:5px 20px;">Imię i nazwisko</td>
        <td style="padding:5px 20px;"><?php echo $agentDane->imie.' '.$agentDane->nazwisko; ?></td>
    </tr>
    <tr>
        <td style="padding:5px 20px;">Email</td>
        <td style="padding:5px 20px;"><?php echo $agentDane->email; ?></td>
    </tr>
    <tr>
        <td style="padding:5px 20px;">Telefon</td>
        <td style="padding:5px 20px;"><?php echo $agentDane->telefon_kom; ?></td>
    </tr>
    <tr>
        <td style="padding:5px 20px;" colspan="2" align="center">Klient dane</td>
    </tr>
    <tr>
        <td style="padding:5px 20px;">Imię i nazwisko</td>
        <td style="padding:5px 20px;"><?php echo $klientDane->imie.' '.$klientDane->nazwisko; ?></td>
    </tr>
</table>
