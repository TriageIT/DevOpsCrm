<?php
session_start();
$inlognaam = $_SESSION['userinfo'] ;

if (isset($_SESSION['userinfo']))
{

  $query = "SELECT * FROM employee WHERE EMPL_USERID = '$inlognaam';";

  // Constanten voor mysql_connect() insluiten:
  require_once('../../triageinc/mysql_connect.inc.php');
  require_once('../../triageinc/mysql_dbase.inc.php');

  // Databaseverbinding openen met mysql_connect():
  $connect = mysqli_connect(MYSQL_SERVER, MYSQL_GEBRUIKERSNAAM, MYSQL_WACHTWOORD, $dbase) or die("Unable to Connect to 'MYSQL_SERVER'");

  mysqli_select_db($connect, $dbase) or die("Could not open the db '$dbase'");

  $resultlogin = mysqli_query ($connect, $query);

while ($rij = mysqli_fetch_assoc($resultlogin)) {

  $inlogid = $rij['EMPL_ID'];
  $empladmin = $rij['EMPL_ADMIN'];
  $fkfunctionid = $rij['FK_FUNCTION_ID'];
  $emplfirstname = $rij['EMPL_FIRSTNAME'];
            }
}else {

echo 'You are not allowed to do this without logging in';
exit;

}


$bgrij1 = 'F5F5F5';
$bgrij2 = 'FFFFFF';

//Datum opbouwen
$ditjaar = date('Y');
$dezemaand = date('m');
$dezedag = date('d');

//$date = $dezemaand.'-'.$dezedag.'-'.$ditjaar;
$datumnumeriek = $ditjaar.$dezemaand.$dezedag;
$datumstreep = $ditjaar.'-'.$dezemaand.'-'.$dezedag;

?>
<html>
<head>
 <link rel="stylesheet" type="text/css" href="main.css" />

</head>

<body>

<table border="0" width="100%" id="top_table">
	<tr>
		<td colspan="2"><h1><a target="_self" href="crmadmin.php"><img border="0" src="images/bedrijf_groot.png" ></a>   Bedrijven</h1></td>
		<td rowspan="2">
		<p align="center">
		<a target="_self" href="crmadmin.php">
		<img border="0" src="images/triage.png" ></a></td>
		<td><a target="_self" href="logout.php">log-out</a></td>
		<td><?php echo $inlognaam; ?></td>
	</tr>
	<tr>
		<td>
<a href="crmbedrijftoevoegen.php">
<img border="0" src="images/bedrijf_add.png" width="45" height="45"></a> - Voeg bedrijf toe
		</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
</table>

<table width="100%" border="0" cellpadding="2" cellspacing="0">
  <tr bgcolor="#ECE9D8">
    <th align="center" colspan="3">Edit</th>
    <th align="center" colspan="2">Del</th>
    <th align="center" colspan="2">Bedrijfnaam</th>
    <th align="center" colspan="2">+Contact</th>
    <th align="center" colspan="2">+Aanvraag</th>
    <th align="center" colspan="2">+Lead</th>
    <th align="center" colspan="2">Status</th>
    <th align="center" colspan="2">Stad</th>
    <th align="center" colspan="2">Straat</th>
    <th align="center" colspan="3">Telefoon</th>
      </tr>
<?php

// bolean introduceren voor achtergrondkleur
$bg = 0;

$sqla  = "SELECT * FROM company "
         . "WHERE COMPANY_ID <>0 "
         . "AND COMPANY_STATUS <> 'D'"
         . "ORDER BY COMPANY_NAME ASC ;";

// Query uitvoeren en een resultaatset opslaan:
$contact = mysqli_query($connect, $sqla);

while ($rija = mysqli_fetch_assoc($contact)) {
$companyname = $rija["COMPANY_NAME"];
$companyaddress = $rija["COMPANY_ADDRESS"];
$companyid= $rija["COMPANY_ID"];
$fkcompanystatusid = $rija["FK_COMPANY_STATUS_ID"];

// bepalen van de achtergrondkleur
if ($bg == 0)
{
 $bgcolour = 'F5F5F5';
 $bg = 1;
 }
elseif ($bg == 1)
{
 $bgcolour = 'FFFFFF';
 $bg = 0;
}
    echo '<tr>'; // E�n rij per bedrijf

             //beginkolom
    echo '<td bgcolor="#ECE9D8" style="border-bottom: solid 1px #F5F5F5"></td>';


    // Dit wordt de edit kolom:
    echo '<td bgcolor="' . $bgcolour . '"  align="center" style="border-bottom: solid 1px #F5F5F5">';
    echo '<a href="crmbedrijfdetail.php?COMPANY_ID=' . $rija["COMPANY_ID"] . '" COMPANY_ID="' . $rija["COMPANY_ID"] .'">';
    echo '<img border="0" src="images/b_edit.png" >';
    echo '</a>';
    echo '</td>';

         //tussenkolom
    echo '<td bgcolor="#ECE9D8" style="border-bottom: solid 1px #F5F5F5"></td>';

        // Dit wordt de delete kolom:
    echo '<td bgcolor="' . $bgcolour . '" align="center" style="border-bottom: solid 1px #F5F5F5">';
    echo '<a href="crmbedrijfdelete.php?COMPANY_ID=' . $rija["COMPANY_ID"] .'">';
    echo '<img border="0" src="images/b_drop.png" >';
    echo '</a>';
    echo '</td>';

         //tussenkolom
    echo '<td bgcolor="#ECE9D8" style="border-bottom: solid 1px #F5F5F5"></td>';

         //bedrijfsnaam
    echo '<td bgcolor="' . $bgcolour . '"  style="border-bottom: solid 1px #F5F5F5"><font face="Century Gothic">';
    echo '<a href="crmbedrijfdetail.php?COMPANY_ID=' . $rija["COMPANY_ID"] .'">';
    echo '<img border="0" src="images/bedrijf_klein.jpg">'. '  ';
    echo  $companyname;
    echo '</a>';
    echo '</font></td>';

             //tussenkolom
    echo '<td bgcolor="#ECE9D8" style="border-bottom: solid 1px #F5F5F5"></td>';

         //contact toevoegen
    echo '<td bgcolor="' . $bgcolour . '"  align="center" style="border-bottom: solid 1px #F5F5F5">';
    echo '<a href="crmcontacttoevoegen.php?COMPANY_ID=' . $companyid .'">';
    echo '<img border="0" src="images/contacten_add.png"  width="45" height="45"></a>';
    echo '</td>';

             //tussenkolom
    echo '<td bgcolor="#ECE9D8" style="border-bottom: solid 1px #F5F5F5"></td>';

         //contRact toevoegen
    echo '<td bgcolor="' . $bgcolour . '"  align="center" style="border-bottom: solid 1px #F5F5F5">';
    echo '<a href="crmaanvraagtoevoegen.php?COMPANY_ID=' . $companyid .'">';
    echo '<img border="0" src="images/question.jpeg"  width="45" height="45"></a>';
    echo '</td>';

             //tussenkolom
    echo '<td bgcolor="#ECE9D8" style="border-bottom: solid 1px #F5F5F5"></td>';

         //Lead toevoegen
    echo '<td bgcolor="' . $bgcolour . '"  align="center" style="border-bottom: solid 1px #F5F5F5">';
    echo '<a href="crmleadtoevoegen.php?COMPANY_ID=' . $companyid .'">';
    echo '<img border="0" src="images/lead_add.jpg"  width="45" height="45"></a>';
    echo '</td>';

             //tussenkolom
    echo '<td bgcolor="#ECE9D8" style="border-bottom: solid 1px #F5F5F5"></td>';

         //Status toevoegen
    echo '<td bgcolor="' . $bgcolour . '"  align="center" style="border-bottom: solid 1px #F5F5F5">';
    echo '<a href="crmklantenlijst.php">';

    if  ($fkcompanystatusid == NULL OR $fkcompanystatusid == 0){
    echo '<img border="0" src="images/klant_groot.png"  width="45" height="45"></a>';

    } else
        if  ($fkcompanystatusid > 0){

$sqlcompanystatus  = "SELECT * FROM company_status WHERE COMPANY_STATUS_ID = '$fkcompanystatusid' ";

// Query uitvoeren en een resultaatset opslaan:
$companystatus = mysqli_query($connect, $sqlcompanystatus);

while ($rijcompanystatus = mysqli_fetch_assoc($companystatus)) {
$companystatusname= $rijcompanystatus["COMPANY_STATUS_NAME"];

echo $companystatusname;
}

    echo '</a>';

    }
    echo '</td>';

         //tussenkolom
    echo '<td bgcolor="#ECE9D8" style="border-bottom: solid 1px #F5F5F5"></td>';

         //Bedrijfstad
    echo '<td bgcolor="' . $bgcolour . '" align="left" style="border-bottom: solid 1px #F5F5F5"><font face="Century Gothic">';
    echo $rija["COMPANY_CITY"];
    echo '</font></td>';

             //tussenkolom
    echo '<td bgcolor="#ECE9D8" style="border-bottom: solid 1px #F5F5F5"></td>';

         //Bedrijfstad
    echo '<td bgcolor="' . $bgcolour . '" align="left" style="border-bottom: solid 1px #F5F5F5"><font face="Century Gothic">';
    echo $companyaddress;
    echo '</font></td>';

         //tussenkolom
    echo '<td bgcolor="#ECE9D8" style="border-bottom: solid 1px #F5F5F5"></td>';

         //telefoon
    echo '<td bgcolor="' . $bgcolour . '"  style="border-bottom: solid 1px #F5F5F5"><font face="Century Gothic">';
    echo '<img border="0" src="images/telefoon.jpg">'. '  ';
    echo $rija["COMPANY_PHONE"];
    echo '</font></td>';

         //eindkolom
    echo '<td bgcolor="#ECE9D8" style="border-bottom: solid 1px #F5F5F5"></td>';

    echo '</form>';

    echo '</tr>'; // einde rij bedrijven

}

//sluitrij
    echo '<tr>'; // einde rij
    echo '<td bgcolor="#ECE9D8" style="border-bottom: solid 1px #ECE9D8"></td>';
    echo '<td bgcolor="#ECE9D8" style="border-bottom: solid 1px #ECE9D8"></td>';
    echo '<td bgcolor="#ECE9D8" style="border-bottom: solid 1px #ECE9D8"></td>';
    echo '<td bgcolor="#ECE9D8" style="border-bottom: solid 1px #ECE9D8"></td>';
    echo '<td bgcolor="#ECE9D8" style="border-bottom: solid 1px #ECE9D8"></td>';
    echo '<td bgcolor="#ECE9D8" style="border-bottom: solid 1px #ECE9D8"></td>';
    echo '<td bgcolor="#ECE9D8" style="border-bottom: solid 1px #ECE9D8"></td>';
    echo '<td bgcolor="#ECE9D8" style="border-bottom: solid 1px #ECE9D8"></td>';
    echo '<td bgcolor="#ECE9D8" style="border-bottom: solid 1px #ECE9D8"></td>';
    echo '<td bgcolor="#ECE9D8" style="border-bottom: solid 1px #ECE9D8"></td>';
    echo '<td bgcolor="#ECE9D8" style="border-bottom: solid 1px #ECE9D8"></td>';
    echo '<td bgcolor="#ECE9D8" style="border-bottom: solid 1px #ECE9D8"></td>';
    echo '<td bgcolor="#ECE9D8" style="border-bottom: solid 1px #ECE9D8"></td>';
    echo '<td bgcolor="#ECE9D8" style="border-bottom: solid 1px #ECE9D8"></td>';
    echo '<td bgcolor="#ECE9D8" style="border-bottom: solid 1px #ECE9D8"></td>';
    echo '<td bgcolor="#ECE9D8" style="border-bottom: solid 1px #ECE9D8"></td>';
    echo '<td bgcolor="#ECE9D8" style="border-bottom: solid 1px #ECE9D8"></td>';
    echo '</tr>'; // einde rij

// Resultaatset vrijgeven:
//mysql_free_result($connect);

// Databaseverbinding sluiten:
mysqli_close($connect);

// Einde van de tabel en de webpagina:
echo "</table>\n";

?>


 </body>
