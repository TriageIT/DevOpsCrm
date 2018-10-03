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

if (isset($_GET['BRANCHE_ID'])) {
    $brancheid = $_GET['BRANCHE_ID'];

$sql  = "SELECT * FROM branche WHERE BRANCHE_ID ='$brancheid'";     // waar de BRANCHE_ID gelijk is aan de import holdingid

$query = mysqli_query($connect, $sql);

// Alle records in de resultaatset weergeven als een tabelrij
// door het resultaat te verwerken als een associatieve array:
while( $uitvoer = mysqli_fetch_assoc( $query ) )
   {

$brancheid = $uitvoer["BRANCHE_ID"];
$branchename = $uitvoer["BRANCHE_NAME"];
$branchedescription = $uitvoer["BRANCHE_DESCRIPTION"];
$branchecreationdate = $uitvoer["BRANCHE_CREATION_DATE"];
$branchecreator = $uitvoer["BRANCHE_CREATOR"];
$brancheowner = $uitvoer["BRANCHE_OWNER"];


// naam creator opzoeken
$sqlcreator = "SELECT * FROM employee WHERE EMPL_ID ='$branchecreator' ;";     // waar de USERID gelijk is aan de creator

$resultcreator = mysqli_query ($connect, $sqlcreator);

while ($rijcreator = mysqli_fetch_assoc($resultcreator)) {

$creatorlastname = $rijcreator['EMPL_LASTNAME'];
$creatorfirstname = $rijcreator['EMPL_FIRSTNAME'];
}

// naam eigenaar opzoeken
$sqlowner = "SELECT * FROM employee WHERE EMPL_ID ='$brancheowner' ;";     // waar de USERID gelijk is aan de eigenaar

$resultowner = mysqli_query ($connect, $sqlowner);

while ($rijowner = mysqli_fetch_assoc($resultowner)) {

$ownerlastname = $rijowner['EMPL_LASTNAME'];
$ownerfirstname = $rijowner['EMPL_FIRSTNAME'];
}

}



//einde


}

if (isset($_POST['submit'])) {
    if ($_POST['submit'] == "Okay") {


$brancheid = $_POST["BRANCHE_ID"];
$branchename = $_POST["BRANCHE_NAME"];
$branchedescription = $_POST["BRANCHE_DESCRIPTION"];
$brancheowner = $_POST["BRANCHE_OWNER"];

// Constanten voor mysql_connect() insluiten:
require_once('../../triageinc/mysql_connect.inc.php');
require_once('../../triageinc/mysql_dbase.inc.php');

// Databaseverbinding openen met mysql_connect():
$connect = mysqli_connect(MYSQL_SERVER, MYSQL_GEBRUIKERSNAAM, MYSQL_WACHTWOORD, $dbase) or die("Unable to Connect to 'MYSQL_SERVER'");

mysqli_select_db($connect, $dbase) or die("Could not open the db '$dbase'");

// MSSQL-updatequery opstellen:

$sqld  = "UPDATE branche SET BRANCHE_NAME ='$branchename', BRANCHE_DESCRIPTION = '$branchedescription' WHERE BRANCHE_ID ='$brancheid'";

$update = mysqli_query($connect, $sqld);

            // Browser omleiden naar het lijst van holdings
            // als de bijdrage is toegevoegd:
  		if ($update) {
                header("Location: http://" . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . "/crmbranchelijst.php");
                exit;
            } }
            else {
              header("Location: http://" . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . "/crmbranchelijst.php");
              exit;              
            }

}



if (isset($_POST['submit'])) {
    if ($_POST['submit'] == "delete") {


}}




// Webpagina weergeven:
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Branche nummer: <?php echo $brancheid; ?></title>
 <link rel="stylesheet" type="text/css" href="main.css" />
</head>
<body>
<table border="0" width="100%" id="top_table">
  <tr>
		<td colspan="2"><h1><a target="_self" href="crmbranchelijst.php"><img border="0" src="images/branche_groot.png"></a>   Branche  <font color="#800000"><?php echo $branchename;?></font></h1></td>
		<td rowspan="2">
		<p align="center">
		<a target="_self" href="crmadmin.php">
		<img border="0" src="images/triage.png"></a></td>
		<td><a target="_self" href="logout.php">log-out</a></td>
		<td><?php echo $inlognaam; ?></td>
	</tr>
	<tr>
		<td>
<a href="crmbranchetoevoegen.php">
<img border="0" src="images/branche_toevoegen.jpg" width="25" height="25"></a> - Voeg branche toe
		</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
</table>


<form action="crmbranchedetail.php" method="post">
<input type="hidden" name="BRANCHE_ID" size="12" value="<?php echo $brancheid;?>">
<table align="center" border="0" cellpadding="2" cellspacing="0">
	<tr>
      	<td>Naam</td>
      	<td>
		<input type="text" name="BRANCHE_NAME" size="30" value="<?php echo $branchename;?>"></td>
  	</tr>
	<tr>
      	<td>Notes</td>
      	<td>
      	<textarea rows="7" cols="50" name="BRANCHE_DESCRIPTION" ><?php echo $branchedescription;?></textarea>
		</td>
  	</tr>
  	<tr>
		<td>Creator</td>
   		<td><input type="hidden" name="BRANCHE_CREATOR" size="1" value="<?php echo $emplcreator;?>">
           <?php
           echo $creatorfirstname.' '.$creatorlastname ;
           ?></td>
   	</tr>
   	<tr>
		<td>Owner</td>
   		<td><input type="hidden" name="BRANCHE_OWNER" size="1" value="<?php echo $emplowner;?>">
           <?php
           echo $ownerfirstname.' '.$ownerlastname ;
           ?></td>
   	</tr>
</table>

<table align="center">
      <td>&nbsp;</td>
      <td align="right" nowrap>
        <input class="knop" name="submit" type="image" src="images/okay_groot.jpg"  width="47" height="47" value="Okay"> - Okay &nbsp;
        <input class="knop" name="submit" type="image" src="images/cancel_groot.jpg"  width="47" height="47" value="Annuleren"> - Annuleren
      </td>
    </tr>

  </table>

</form>

</body>
