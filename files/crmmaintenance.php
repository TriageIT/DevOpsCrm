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

<title>Onderhoud pagina</title>
</head>

<body>

<table border="0" width="100%" id="top_table">
	<tr>
		<td colspan="2"><h1><a target="_self" href="crmadmin.php"><img border="0" src="images/onderhoud_groot.png" width="72" height="72"></a>   Onderhoud gedeelte</h1></td>
		<td rowspan="2">
		<p align="center">
		<a target="_self" href="crmadmin.php">
		<img border="0" src="images/triage.png" ></a></td>
		<td><a target="_self" href="logout.php">log-out</a></td>
		<td><?php echo $inlognaam; ?></td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
</table>



<table align="center" border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" width="30%">
  <tr>
    <td width="9%"></td>
    <td width="2%">&nbsp;</td>
    <td width="10%"><p align="left">
<a href="crmMyCompany.php"><img border="0" src="images/triage_small.png">  MyCompany</a>
</td>
  </tr>
  <tr>
    <td width="9%">&nbsp;</td>
    <td width="2%">&nbsp;</td>
    <td width="10%"><p align="left">
<a href="crmkalenderlijst.php"><img border="0" src="images/Calender_klein.jpg">  Kalender</a>

</td>
  </tr>
  <tr>
    <td width="9%">&nbsp;</td>
    <td width="2%">&nbsp;</td>
    <td width="10%"><p align="left"><a href="crmholdinglijst.php"><img border="0" src="images/holding_klein.jpg">  Holding</a>

</td>
  <tr>
    <td width="9%">&nbsp;</td>
    <td width="2%">&nbsp;</td>
    <td width="10%"><p align="left"><a href="crmbranchelijst.php"><img border="0" src="images/branche_klein.png">  Branche</a>

</td>
  </tr>
  <tr>
    <td width="9%">&nbsp;</td>
    <td width="2%">&nbsp;</td>
    <td width="10%"><p align="left"><a href="crmfunctielijst.php"><img border="0" src="images/functie_klein.jpg">  Functies</a></p>
</td>
  </tr>
  <tr>
    <td width="9%">&nbsp;</td>
    <td width="2%">&nbsp;</td>
    <td width="10%"><p align="left"><a href="crmkostentypelijst.php"><img border="0" src="images/kosten_klein.png">  Kostentype</a></p>
</td>
  </tr>
  <tr>
    <td width="9%">&nbsp;</td>
    <td width="2%">&nbsp;</td>
    <td width="10%"><p align="left"><a href="crmnonfactuuruurtypelijst.php"><img border="0" src="images/timesheet_klein.png">  Uurtype non-facturabele uren</a></p>
</td>
  </tr>
  <tr>
    <td width="9%">&nbsp;</td>
    <td width="2%">&nbsp;</td>
    <td width="10%"><p align="left"><a href="crmvakantieonderhoudlijst.php?YEAR=<?php echo $ditjaar;?>"><img border="0" src="images/vakantie_klein.png">  Vakanties</a>  of <a href="crmvakantiestatuslijst.php">  status</a></p>
</td>
  </tr>
  <tr>
    <td width="9%">&nbsp;</td>
    <td width="2%">&nbsp;</td>
    <td width="10%"><p align="left"><a href="crmmedewerkeradminlijst.php"><img border="0" src="images/admin_klein.png">  Admin</a></p>
</td>

  </tr>
    <tr>
    <td width="9%">&nbsp;</td>
    <td width="2%">&nbsp;</td>
    <td width="10%"><p align="left"><a href="crmleadonderhoudlijst.php"><img border="0" src="images/admin_klein.png">  Onderhoud Leads</a></p>
</td>

  </tr>

      <tr>
    <td width="9%">&nbsp;</td>
    <td width="2%">&nbsp;</td>
    <td width="10%"><p align="left"><a href="crmprojectonderhoudlijst.php"><img border="0" src="images/project_klein.png">  Onderhoud Project</a></p>
</td>

  </tr>
    <tr>
    <td width="9%">&nbsp;</td>
    <td width="2%">&nbsp;</td>
    <td width="10%"><p align="left"><a href="crmadminsettings.php"><img border="0" src="images/password_klein.jpg">  reset password</a></p>
</td>

  </tr>

</table>

</body>

</html>
