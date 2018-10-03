<?php
session_start();
$username = $_SESSION['userinfo'] ;
echo 'jahoor';

if (isset($_SESSION['userinfo']))
{

  $query = "SELECT * FROM employee WHERE EMPL_USERID = '$username';";

  // Constanten voor mysql_connect() insluiten:
  require_once('../../triageinc/mysql_connect.inc.php');
  require_once('../../triageinc/mysql_dbase.inc.php');

  // Databaseverbinding openen met mysql_connect():
  $connect = mysqli_connect(MYSQL_SERVER, MYSQL_GEBRUIKERSNAAM, MYSQL_WACHTWOORD, $dbase) or die("Unable to Connect to 'MYSQL_SERVER'");

  mysqli_select_db($connect, $dbase) or die("Could not open the db '$dbase'");

  $resultlogin = mysqli_query ($connect, $query);

while ($rij = mysqli_fetch_assoc($resultlogin)) {

$inlogid = $rijlogin['EMPL_ID'];
$empladmin = $rijlogin['EMPL_ADMIN'];
$fkfunctionid = $rijlogin['FK_FUNCTION_ID'];
$emplfirstname = $rijlogin['EMPL_FIRSTNAME'];
            }
}

// deze gaat nog wel veranderen, maar nu gaat ie naar de medewerkerslijst

if ($empladmin !=  'Y'){
header("Location: http://" . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . "/crmmain.php");
exit;
}

if ($fkfunctionid == 1){
$autorisatie = 'directeur';}

$sqla  = "SELECT * FROM employee WHERE EMPL_STATUS = 'A' OR EMPL_STATUS = 'Z'";

$employee = mysql_query($sqla);

$empltriage = "";
$emplzzpcount = "";

while ($rija = mysqli_fetch_assoc($employee)) {

$emplzzp = $rija['EMPL_ZZP'];
if ($emplzzp == 'Y' )
{ $emplzzpcount =  $emplzzpcount +1;}
elseif ($emplzzp == 'N' )
{ $empltriage =  $empltriage +1;}
}

        //Datum opbouwen
$ditjaar = date('Y');
$dezemaand = date('m');
$dezedag = date('d');

$timesheetperiod = $dezemaand;

//$date = $dezemaand.'-'.$dezedag.'-'.$ditjaar;
$datumnumeriek = $ditjaar.$dezemaand.$dezedag;
$datumstreep = $ditjaar.'-'.$dezemaand.'-'.$dezedag;

 if (isset($_POST['submit'])) {

// Constanten voor mysql_connect() insluiten:
require_once('../../triageinc/mysql_connect.inc.php');
require_once('../../triageinc/mysql_dbase.inc.php');

// Databaseverbinding openen met mysql_connect():
$verbinding = mysql_connect(MYSQL_SERVER, MYSQL_GEBRUIKERSNAAM, MYSQL_WACHTWOORD) or die("Verbinding mislukt: " . mysql_error());

// Database 'crm' selecteren:
mysql_select_db($dbase) or die("Kon de database niet openen: " . mysql_error());

    if ($_POST['submit'] == "addvisit") {
// Dit is het laatste visitnummer ophalen

$sqlid  = "SELECT VISIT_ID FROM customer_visit ORDER BY VISIT_ID DESC limit 1;";  // en sorteer oplopend op 'holdingnaam'.

// Query uitvoeren en een resultaatset opslaan:
$resultaat = mysql_query($sqlid);

// Alle records in de resultaatset weergeven als een tabelrij
// door het resultaat te verwerken als een associatieve array:
while ($rij = mysql_fetch_assoc($resultaat)) {

$visitid = $rij["VISIT_ID"];

}

$visitid = $visitid +1;

$visitdate = $_POST["VISIT_DATE"];
$visitdescription = $_POST["VISIT_DESCRIPTION"];
$visitnotes = $_POST["VISIT_NOTES"];

//creator naar het inlogid zetten)

$creator = $inlogid;

            // MySQL-toevoegquery opstellen:

$sqla  = "INSERT INTO customer_visit (VISIT_ID, VISIT_DATE,  VISIT_DESCRIPTION, VISIT_NOTES, VISIT_CREATOR)  VALUES  ('$visitid', '$datumstreep', '$visitdescription', '$visitnotes', '$creator')";

$insert = mysql_query($sqla);

            // Browser omleiden naar de detailscherm voor verdere invoering
            // als de bijdrage is toegevoegd:
		if ($insert) {
                header("Location: http://" . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . "/crmvisitdetail.php?VISIT_ID=" . $visitid);
                exit;
            }

 }

}


?>

<html>

<head>
 <link rel="stylesheet" type="text/css" href="main.css" />

<title>Main Admin pagina</title>
</head>

<body>

<table border="0" width="100%" id="top_table">
	<tr>
		<td colspan="2"><h1>Admin gedeelte voor <?php echo $autorisatie . '  '. $inlognaam; ?></h1></td>
		<td rowspan="2">
		<p align="center">
		<img border="0" src="images/triage.png" ></td>
		<td><a target="_self" href="logout.php">log-out</a></td>
		<td><?php echo $inlognaam; ?></td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td><a target="_self" href="../time/crmmain.php">Time</a></td>
	</tr>
</table>



<table align="center" border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" width="101%">
  <tr>
    <td width="4%"><a href="crmcontactlijst.php"><img border="0" src="images/Contacten_Groot.png" width="47" height="47"></a></td>
    <td width="16%"><a href="crmcontactlijst.php">Contacten</a></td>
    <td width="2%"><a href="crmcontacttoevoegen.php">
    <img border="0" src="images/contacten_add.png"  width="47" height="47"></a></td>
    <td width="5%">
    </td>
    <td width="5%">
    <a href="crmprogrammalijst.php">
    <img border="0" src="images/Programma.jpeg"   width="47" height="47"></a></td>
    <td width="160%" rowspan="13" colspan="2">
    <?php
  $tijd = date("H:i:s");
  $dag_vd_week = date("w");
  $maand_vh_jaar = date("n")-1;
  $dedag = date("j");
  $jaar = date("Y");
  $uur = explode(":", $tijd);

  $dagen = array('zondag', 'maandag', 'dinsdag', 'woensdag', 'donderdag', 'vrijdag', 'zaterdag');
  $maanden = array('januari', 'februari', 'maart', 'april', 'mei', 'juni', 'juli', 'augustus', 'september', 'oktober', 'november', 'december');
  $dag = $dagen[$dag_vd_week];
  $maand = $maanden[$maand_vh_jaar];

  echo "Het is vandaag ".$dag." ".$dedag." ".$maand." in het jaar ".$jaar.".";
  echo " Op dit moment is het ".$uur[0]." uur ".$uur[1]." minuten en ".$uur[2]." second(en).";
  echo '<br>';
  $dezemaand = date ("m");
  $date = date('Y-m-d', mktime(0, 0, 0, $dezemaand, 1, $jaar)) ;

  // Aantal visits deze maand
  $sqlvisit  = "SELECT * FROM customer_visit WHERE VISIT_DATE >= '" . $date . "'"  ;


    $resultvisit = mysql_query($sqlvisit);
    $num_rows = mysql_num_rows($resultvisit);
    echo 'Aantal visits deze maand (sinds de eerste van de maand '.$maand . ') : ' . $num_rows;

    $sqlvisitklant  = "SELECT * FROM customer_visit JOIN company ON customer_visit.FK_COMPANY_ID = company.COMPANY_ID WHERE customer_visit.VISIT_DATE >= '" . $date . "' AND company.FK_COMPANY_STATUS_ID = 3"  ;

    $resultvisitklant = mysql_query($sqlvisitklant);
    $num_rows_klant = mysql_num_rows($resultvisitklant);

     $sqlvisitprospect  = "SELECT * FROM customer_visit JOIN company ON customer_visit.FK_COMPANY_ID = company.COMPANY_ID WHERE customer_visit.VISIT_DATE >= '" . $date . "' AND company.FK_COMPANY_STATUS_ID = 2"  ;

    $resultvisitprospect = mysql_query($sqlvisitprospect);
    $num_rows_prospect = mysql_num_rows($resultvisitprospect);

     $sqlvisitsuspect  = "SELECT * FROM customer_visit JOIN company ON customer_visit.FK_COMPANY_ID = company.COMPANY_ID WHERE customer_visit.VISIT_DATE >= '" . $date . "' AND company.FK_COMPANY_STATUS_ID = 1"  ;

    $resultvisitsuspect = mysql_query($sqlvisitsuspect);
    $num_rows_suspect = mysql_num_rows($resultvisitsuspect);

  echo "<p>".$date."</p>";

      ?>
      <table border="1"   bordercolor="#FF3300" width="14%">
	<tr>
		<td bordercolor="#FF3300">Klant</td>
		<td width="54" align="center" bordercolor="#FF3300"><?php echo $num_rows_klant; ?></td>
		<td width="48" align="center" bordercolor="#FF3300">&nbsp;</td>
	</tr>
	<tr>
		<td bordercolor="#FF3300">Prospect</td>
		<td width="54" align="center" bordercolor="#FF3300"><?php echo $num_rows_prospect; ?></td>
		<td width="48" align="center" bordercolor="#FF3300">&nbsp;</td>
	</tr>
	<tr>
		<td bordercolor="#FF3300">Suspect</td>
		<td width="54" align="center" bordercolor="#FF3300"><?php echo $num_rows_suspect; ?></td>
		<td width="48" align="center" bordercolor="#FF3300">&nbsp;</td>
	</tr>
</table>
     <p><a href="crmklantenlijst.php"><img border="0" src="images/klant_groot.png"  width="47" height="47"> salesplan</a></p>
     <p>
     <a href="crmcontractlijst.php"><img border="0" src="images/contract_groot.png"  width="47" height="47"> Contracten</a>
     <a href="crmproposallijst.php"><img border="0" src="images/Folder_24.png"  width="47" height="47"> Proposals</a>
     <a href="crmaanvraaglijst.php"><img border="0" src="images/question.jpeg"  width="47" height="47"> Aanvragen</a>
     </p>
    </td>
</tr>
<tr>
    <td width="4%"><a href="crmbedrijflijst.php"><img border="0" src="images/bedrijf_groot.jpg" width="47" height="47"></a></td>
    <td width="16%"><a href="crmbedrijflijst.php">Bedrijven</a></td>
    <td width="2%"><a href="crmbedrijftoevoegen.php">
    <img border="0" src="images/bedrijf_add.png" width="47" height="47"></a>  </td>
    <td width="5%">
    </td>
    <td width="5%">
    <a href="crmpersoonlijst.php">
    <img border="0" src="images/person_groot.jpg"  width="47" height="47"></a></td>
    <td width="160%" rowspan="13" colspan="2">&nbsp;</td>
</tr>
<tr>
    <td width="4%"><a href="crmvisitlijst.php"><img border="0" src="images/visit_groot.jpg" width="47" height="47"></a></td>
    <td width="16%"><a href="crmvisitlijst.php">Bezoek</a></td>
    <td width="2%">
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
          <table align="center">
	             <tr>
		             <td> <input class="knop" name="submit" type="image" img border="0" src="images/visit_add.png" value="addvisit"  width="47" height="47">
		             </td>
		             <td>


                     </td>
	</tr>
</table>
</form>

    </td>
    <td width="5%">
    </td>
    <td width="5%">
                  <a href="crmprojectlijst.php">
    <img border="0" src="images/project.png"  width="47" height="47"></a></td>
</tr>
<tr>
    <td width="4%"><a href="crmmedewerkerlijst.php"><img border="0" src="images/medewerker_groot.png"  width="47" height="47"></a></td>
    <td width="16%"><a href="crmmedewerkerlijst.php">Medewerkers</a></td>
    <td width="2%"><a href="crmmedewerkertoevoegen.php">
    <img border="0" src="images/medewerker_add.png" width="47" height="47"></a>
    </td>
    <td width="5%">
    </td>
    <td width="5%">
    &nbsp;</td>
</tr>
<tr>
    <td width="4%"><a href="crmprospectlijst.php"><img border="0" src="images/prospect_groot.jpg"  width="47" height="47"></a></td>
    <td width="16%"><a href="crmprospectlijst.php">Kandidaten</a></td>
    <td width="2%"><a href="crmprospecttoevoegen.php">
    <img border="0" src="images/prospect_add.png" width="47" height="47"></a>
    </td>
    <td width="5%">
    </td>
    <td width="5%">
    &nbsp;</td>
</tr>
<tr>
    <td width="4%"><a href="crmboekenlijst.php"><img border="0" src="images/boeken.jpg"  width="47" height="47"></a></td>
    <td width="16%"><a href="crmboekenlijst.php">Boeken</a></td>
    <td width="2%"><a href="crmboektoevoegen.php"><img border="0" src="images/boek_add.png" width="47" height="47"></a></td>
    <td width="5%">&nbsp;</td>
    <td width="5%">&nbsp;</td>
</tr>
<tr>
    <td width="4%"><a href="crmactielijstalgemeen.php"><img border="0" src="images/actie_groot.jpg"></a></td>
    <td width="16%"><a href="crmactielijstalgemeen.php">Acties</a></td>
    <td width="2%"><a href="crmactietoevoegen.php">
    <img border="0" src="images/actie_add.png" width="47" height="47"></a> </td>
    <td width="5%">
    </td>
    <td width="5%">
    &nbsp;</td>
</tr>
<tr>
    <td width="4%"><a href="crmmaillogin.php"><img border="0" src="images/mail_groot.jpg" width="45" height="45"></a>   </td>
    <td width="16%">Mail</td>
    <td width="2%"></td>
    <td width="5%">&nbsp;</td>
    <td width="5%">&nbsp;</td>
</tr>
<?php
if ($fkfunctionid == 1){
   echo '<tr>';
   echo '    <td width="4%"><a href="crmmaintenance.php"><img border="0" src="images/onderhoud_klein.png"></a></td>  ';
   echo '    <td width="16%"><a href="crmmaintenance.php">Onderhoud</a></td>';
   echo '    <td width="2%">&nbsp;</td>';
   echo '    <td width="5%">&nbsp;</td>';
   echo '    <td width="5%">&nbsp;</td>';
   echo '  </tr> ';
   echo '<tr>';
   echo '    <td width="4%"><a href="crmvakantielijst.php"><img border="0" src="images/vakantie_klein.png"></a></td>';
   echo '    <td width="16%"><a href="crmvakantielijst.php">Vakanties</a></td>';
   echo '    <td width="2%">&nbsp;</td>';
   echo '    <td width="5%">&nbsp;</td>';
   echo '    <td width="5%">&nbsp;</td>';
   echo '  </tr>';
   echo '  <tr>';
   echo '    <td width="4%"><a href="crmmaandafsluiting.php?TIMESHEET_PERIOD=' . $timesheetperiod. '&YEAR='. $ditjaar . '"><img border="0" src="images/maand_groot.jpg"  width="47" height="47"></a></td>';
   echo '    <td width="16%"><a href="crmmaandafsluiting.php?TIMESHEET_PERIOD='. $timesheetperiod . '&YEAR='. $ditjaar.'">Maandafsluiting</a></td> ';
   echo '    <td width="2%"><a href="crmmaandafsluitinguser.php?TIMESHEET_PERIOD='. $timesheetperiod. '&YEAR='. $ditjaar. '">Mijn</a></td> ';
   echo '    <td width="1%">&nbsp;</td> ';
   echo '    <td width="0%">&nbsp;</td> ';
   echo '    <td width="160%">&nbsp;</td> ';
   echo '  </tr> ';
   echo '  <tr>';
   echo '    <td width="4%"><a href="crmleadlijst.php"><img border="0" src="images/lead.png" width="45" height="45"></a></td>';
   echo '    <td width="16%"><a href="crmleadlijst.php">Leads</a></td>';
   echo '    <td width="2%">&nbsp;</td>';
   echo '    <td width="5%">&nbsp;</td>';
   echo '    <td width="5%">&nbsp;</td>';
   echo '  </tr>';

}
?>


  <tr>
    <td width="4%" colspan="3">Aantal Medewerkers <?php echo $empltriage; ?></td>
    <td width="16%" colspan="4">Aantal ZZP-ers <?php echo $emplzzpcount; ?></td>
    <td width="2%">&nbsp;</td>
    <td width="10%">&nbsp;</td>
  </tr>

  <tr>
    <td width="4%">&nbsp;</td>
    <td width="16%">&nbsp;</td>
    <td width="2%">&nbsp;</td>
    <td width="1%" colspan="2">&nbsp;</td>
    <td width="39%" align="center"></td>
    <td width="121%" align="center"></td>
  </tr>
  <tr>
    <td width="4%">&nbsp;</td>
    <td width="16%">&nbsp;</td>
    <td width="2%">&nbsp;</td>
    <td width="1%" colspan="2">&nbsp;</td>
    <td width="160%" >&nbsp;</td>
  </tr>
  <tr>
    <td width="4%">&nbsp;</td>
    <td width="16%">&nbsp;</td>
    <td width="2%">&nbsp;</td>
    <td width="1%" colspan="2">&nbsp;</td>
    <td width="160%" colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td width="4%">&nbsp;</td>
    <td width="16%">&nbsp;</td>
    <td width="2%">&nbsp;</td>
    <td width="1%" colspan="2">&nbsp;</td>
    <td width="160%" colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td width="4%">&nbsp;</td>
    <td width="16%">&nbsp;</td>
    <td width="2%">&nbsp;</td>
    <td width="1%" colspan="2">&nbsp;</td>
    <td width="160%" colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td width="4%">&nbsp;</td>
    <td width="16%">&nbsp;</td>
    <td width="2%">&nbsp;</td>
    <td width="1%" colspan="2">&nbsp;</td>
    <td width="160%" colspan="2">&nbsp;</td>
  </tr>

</table>

</body>

</html>
