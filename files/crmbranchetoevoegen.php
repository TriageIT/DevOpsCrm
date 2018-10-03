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

//Datum opbouwen
$ditjaar = date('Y');
$dezemaand = date('m');
$dezedag = date('d');

//$date = $dezemaand.'-'.$dezedag.'-'.$ditjaar;
$datumnumeriek = $ditjaar.$dezemaand.$dezedag;
$datumstreep = $ditjaar.'-'.$dezemaand.'-'.$dezedag;

//test
// Dit is het laatste bedrijfnummer ophalen

// SQL-query nummer 1 opstellen:
$sqlid  = "SELECT BRANCHE_ID FROM branche ORDER BY BRANCHE_ID;";  // en sorteer oplopend op company id.

// Query uitvoeren en een resultaatset opslaan:
$resultaat = mysqli_query($connect, $sqlid);

// Alle records in de resultaatset weergeven als een tabelrij
// door het resultaat te verwerken als een associatieve array:
while ($rij = mysqli_fetch_assoc($resultaat)) {
  $brancheid = $rij["BRANCHE_ID"];

}

$brancheid = $brancheid +1;


if (isset($_POST['submit'])) {
    if ($_POST['submit'] == "Okay") {

$brancheid = $_POST["BRANCHE_ID"];
$branchename = $_POST["BRANCHE_NAME"];
$branchedescription = $_POST["BRANCHE_DESCRIPTION"];

//creator en owner naar het inlogid zetten)

$creator = $inlogid;
$owner = $inlogid;

// Constanten voor mysql_connect() insluiten:
require_once('../../triageinc/mysql_connect.inc.php');
require_once('../../triageinc/mysql_dbase.inc.php');

// Databaseverbinding openen met mysql_connect():
$connect = mysqli_connect(MYSQL_SERVER, MYSQL_GEBRUIKERSNAAM, MYSQL_WACHTWOORD, $dbase) or die("Unable to Connect to 'MYSQL_SERVER'");

mysqli_select_db($connect, $dbase) or die("Could not open the db '$dbase'");


            // MySQL-toevoegquery opstellen:

$sqla  = "INSERT INTO branche (BRANCHE_ID, BRANCHE_NAME, BRANCHE_DESCRIPTION, BRANCHE_CREATION_DATE, BRANCHE_CREATOR, BRANCHE_OWNER)  VALUES  ('$brancheid', '$branchename', '$branchedescription', '$datumstreep', '$creator', '$owner' );";
echo $sqla;

$insert = mysqli_query($connect, $sqla);

            // Browser omleiden naar het branchedetail
            // als de bijdrage is toegevoegd:
		if ($insert) {
                header("Location: http://" . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . "/crmbranchedetail.php?BRANCHE_ID=" . $brancheid );
                exit;
            }   }
    if ($_POST['submit'] == "Annuleren") {      echo "pech";

        header("Location: http://" . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . "/crmbranchelijst.php");
        exit;
      }



}
// Webpagina weergeven:
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Branche nr <?php   echo $brancheid; ?> toevoegen</title>
 <link rel="stylesheet" type="text/css" href="main.css" />

</head>
<body>
<table border="0" width="100%" id="top_table">
  <tr>
		<td colspan="2"><h1><a target="_self" href="crmbranchelijst.php"><img border="0" src="images/branche_groot.png"></a>   Branche toevoegen</h1></td>
		<td rowspan="2">
		<p align="center">
		<a target="_self" href="crmadmin.php">
		<img border="0" src="images/triage.png"></a></td>
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

<form action="crmbranchetoevoegen.php" method="post">

<input type="hidden" name="BRANCHE_ID" size="6" value="<?php echo $brancheid;?>">

<table align="center" border="0" cellpadding="2" cellspacing="0">
	<tr>
      	<td>Naam</td>
      	<td>
		<input type="text" name="BRANCHE_NAME" size="31"></td>
  	</tr>
	<tr>
      	<td>Notes</td>
      	<td>
      	<textarea rows="7" cols="50" name="BRANCHE_DESCRIPTION" ></textarea>
		</td>
  	</tr>
      <td>&nbsp;</td>
      <td align="right" nowrap>
        <input class="knop" name="submit" type="image" src="images/okay_groot.jpg"  width="47" height="47" value="Okay"> - Okay &nbsp;
        <input class="knop" name="submit" type="image" src="images/cancel_groot.jpg"  width="47" height="47" value="Annuleren"> - Annuleren
      </td>
    </tr>

  </table>

</form>
</body>
