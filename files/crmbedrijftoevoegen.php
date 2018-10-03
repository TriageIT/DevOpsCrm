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


if ($empladmin != Y){
header("Location: http://" . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . "/crmmain.php");
exit;

}

// Dit is het laatste bedrijfnummer ophalen

// SQL-query nummer 1 opstellen:
$sqlid  = "SELECT COMPANY_ID FROM company ORDER BY COMPANY_ID;";  // en sorteer oplopend op company id.

// Query uitvoeren en een resultaatset opslaan:
$resultaat = mysqli_query($connect, $sqlid);

// Alle records in de resultaatset weergeven als een tabelrij
// door het resultaat te verwerken als een associatieve array:
while ($rij = mysqli_fetch_assoc($resultaat)) {
  $companyid = $rij["COMPANY_ID"];
}

$companyid = $companyid +1;

if (isset($_POST['submit'])) {
    if ($_POST['submit'] == "Okay") {

$companyid = $_POST['COMPANY_ID'];
$companyname = $_POST['COMPANY_NAME'];
$companyaddress = $_POST['COMPANY_ADDRESS'];
$companyzipcode = $_POST['COMPANY_ZIPCODE'];
$companycity = $_POST['COMPANY_CITY'];
$companyphone = $_POST['COMPANY_PHONE'];
$companyfax = $_POST['COMPANY_FAX'];
$companynotes = $_POST['COMPANY_NOTES'];
$referencesite = $_POST['REFERENCE_SITE'];

//creator en owner naar het inlogid zetten)

$creator = $inlogid;
$owner = $inlogid;

//Even uppercase maken
$companyzipcode = strtoupper ($companyzipcode);


			if ($referencesite == on){
              $referencesite = Y ;
            }
            elseif ($referencesite == off){
              $referencesite = N ;
            }

// MSSQL-toevoegquery opstellen:

$sqld  = "INSERT INTO company (COMPANY_ID, FK_BRANCHE_ID ,FK_HOLDING_ID, COMPANY_NAME, COMPANY_ADDRESS, COMPANY_CITY, COMPANY_PHONE, COMPANY_FAX, COMPANY_ZIPCODE, COMPANY_NOTES, REFERENCE_SITE, COM_CREATION_DATE, COM_CREATOR, COM_OWNER) VALUES ('$companyid', 0, 0, '$companyname',  '$companyaddress',  '$companycity',  '$companyphone',  '$companyfax',  '$companyzipcode',  '$companynotes',  '$referencesite', '$datumstreep', $creator, $owner);";
echo $sqld ;

// Constanten voor mysql_connect() insluiten:
require_once('../../triageinc/mysql_connect.inc.php');
require_once('../../triageinc/mysql_dbase.inc.php');

// Databaseverbinding openen met mysql_connect():
$connect = mysqli_connect(MYSQL_SERVER, MYSQL_GEBRUIKERSNAAM, MYSQL_WACHTWOORD, $dbase) or die("Unable 2 Connect to 'MYSQL_SERVER'");

mysqli_select_db($connect, $dbase) or die("Could not open the db '$dbase'");

$insert = mysqli_query($connect, $sqld);

            // Browser omleiden naar het de detail van de company voor eventueel branche en holding
            // als de bijdrage is toegevoegd:
		if ($insert) {
                header("Location: http://" . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . "/crmbedrijfdetail.php?COMPANY_ID=" . $companyid );
                exit;
            }

   }
       if ($_POST['submit'] == "Annuleren") {
                header("Location: http://" . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . "/crmbedrijflijst.php" );
                exit;
       }

}





// Webpagina weergeven:
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Bedrijf nummer: <?php echo $companyid; ?></title>
  <link rel="stylesheet" type="text/css" href="main.css" />

</head>
<table border="0" width="100%" id="top_table">
	<tr>
		<td colspan="2"><h1><a href="crmbedrijflijst.php"><img border="0" src="images/bedrijf_add.png" ></a>   Bedrijf toevoegen</h1></td>
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
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
<table border="0" align="center" >
	<tr>
		<td>
        <input class="knop" name="submit" type="image" src="images/toevoegen.jpg"  width="47" height="47" value="Okay"> - Okay
        </td>
		<td>
        <input class="knop" name="submit" type="image" src="images/cancel_groot.jpg"  width="47" height="47" value="Annuleren"> - Annuleren
        </td>
	</tr>
</table>

<input type="hidden" name="COMPANY_ID" size="12" value="<?php echo $companyid;?>">
<table border="0" cellpadding="2" cellspacing="0" width="100%">
	<tr >
      	<td width="10%">Naam</td>
      	<td>
		<input type="text" name="COMPANY_NAME" size="30" value="<?php echo $companyname;?>"> Referentie&nbsp;
			<input type="checkbox" name="REFERENCE_SITE" size="1"
            <?php
			if ($referencesite == Y){
              echo checked;
            }
            ?>



            ></td>
      	<td>
		&nbsp;</td>
      	<td>
		&nbsp;</td>
  	</tr>
    		<tr>
		<td>&nbsp;</td>
	      <td width="582">
			&nbsp;<fieldset style="padding: 2">
			<legend>Adres</legend>
			Straat&nbsp;
		<input type="text" name="COMPANY_ADDRESS" size="34" value="<?php echo $companyaddress;?>"> <p>Postcode
			<input type="text" name="COMPANY_ZIPCODE" size="6" value="<?php echo $companyzipcode;?>">                   Te&nbsp;&nbsp;
			<input type="text" name="COMPANY_CITY" size="39" value="<?php echo $companycity;?>"></p>
			<table border="0" width="100%" id="table1">
				<tr>
					<td width="93">Telefoon&nbsp; </td>
					<td>
          <input type="text" name="COMPANY_PHONE" size="11" value="<?php echo $companyphone;?>"></td>
				</tr>
				<tr>
					<td width="93">Fax </td>
					<td>
			<input type="text" name="COMPANY_FAX" size="11" value="<?php echo $companyfax;?>"></td>
				</tr>
			</table>
			</fieldset></td>
	      <td>
			&nbsp;</td>
	      <td>
			&nbsp;</td>
    	</tr>
    		<tr>
		<td>Notities</td>
	      <td rowspan="4" >
			<textarea rows="7" cols="50" name="COMPANY_NOTES" ><?php echo $companynotes;?></textarea>&nbsp; </td>
	      <td rowspan="4">&nbsp;</td>
	      <td rowspan="4">&nbsp;</td>
    	</tr>
   		<tr>
		<td>&nbsp;</td>
    	</tr>    		<tr>
		<td>&nbsp;</td>
    	</tr>
    		<tr>
		<td>&nbsp;</td>
    	</tr>
  </table>

</form>
