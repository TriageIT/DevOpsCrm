<?php
session_start ();

// starten van een sessie
$inlognaam = $_SESSION['userinfo'] ;

if (isset($_SESSION['userinfo']))
{

// Databaseverbinding openen en query uitvoeren:

// Constanten voor mysql_connect() insluiten:
require_once('../triageinc/mysql_connect.inc.php');
require_once('../triageinc/mysql_dbase.inc.php');

// Databaseverbinding openen met mysql_connect():
$verbinding = mysql_connect(MYSQL_SERVER, MYSQL_GEBRUIKERSNAAM, MYSQL_WACHTWOORD) or die("Verbinding mislukt: " . mysql_error());

// Database 'crm' selecteren:
mysql_select_db($dbase) or die("Kon de database niet openen: " . mysql_error());

// eerste query opstellen en uitvoeren voor opvragen naam en userid

$sqllogin = "SELECT * FROM employee WHERE EMPL_USERID ='$inlognaam' ;";     // waar de USERID gelijk is aan de inlognaam van de sessie

$resultlogin = mysql_query ($sqllogin);

while ($rijlogin = mysql_fetch_assoc($resultlogin)) {

$inlogid = $rijlogin['EMPL_ID'];
$empladmin = $rijlogin['EMPL_ADMIN'];

}



}

else {

echo 'You are not allowed to do this without logging in';
exit;

}

$bgrij1 = F5F5F5;
$bgrij2 = FFFFFF;

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

if (isset($_GET['COMPANY_ID'])) {
    $companyid = $_GET['COMPANY_ID'];


$sql = "SELECT * FROM company WHERE  COMPANY_ID ='$companyid'";         // waar de COMPANY_id gelijk is aan de import

$query = mysql_query($sql);

while( $uitvoer = mysql_fetch_assoc( $query ) )
   {
   $companyid = $uitvoer['COMPANY_ID'];
   $companyname = $uitvoer['COMPANY_NAME'];
   $companyaddress = $uitvoer['COMPANY_ADDRESS'];
   $companyzipcode = $uitvoer['COMPANY_ZIPCODE'];
   $companycity = $uitvoer['COMPANY_CITY'];

//einde
            }


}

// hier komt het afvangen van het selecteren van een holding
else {

if (isset($_POST['submit'])) {


$brancheid = $_POST['BRANCHE_ID'];
$companyid = $_POST['COMPANY_ID'];

// Databaseverbinding openen en query uitvoeren:

// Constanten voor mysql_connect() insluiten:
require_once('../triageinc/mysql_connect.inc.php');
require_once('../triageinc/mysql_dbase.inc.php');

// Databaseverbinding openen met mysql_connect():
$verbinding = mysql_connect(MYSQL_SERVER, MYSQL_GEBRUIKERSNAAM, MYSQL_WACHTWOORD) or die("Verbinding mislukt: " . mysql_error());

// Database 'crm' selecteren:
mysql_select_db($dbase) or die("Kon de database niet openen: " . mysql_error());

    if ($_POST['submit'] == "select") {

// MySQL-toevoegquery opstellen:

$sqld  = "UPDATE company SET FK_BRANCHE_ID ='$brancheid' WHERE COMPANY_ID ='$companyid';";
// Query uitvoeren en een resultaatset opslaan:

$update = mysql_query($sqld);

            // Browser omleiden naar de medewerkerdetail
            // als de bijdrage is toegevoegd:
		if ($update) {
  header("Location: http://" . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . "/crmbedrijfdetail.php?COMPANY_ID=" . $companyid );
  exit;

}

}
    if ($_POST['submit'] == "Annuleren") {
      header("Location: http://" . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . "/crmbedrijfdetail.php?COMPANY_ID=" . $companyid );
  exit;
    }

}}
?>

<html>
<head>
 <link rel="stylesheet" type="text/css" href="main.css" />
 <title>Selecteer een branche voor <?php echo $companyname; ?></title>
 <SCRIPT LANGUAGE="JavaScript">
<!-- Begin
function popUp(URL) {
window.open( "/crm/crmbrancheaddpopup.php?COMPANY_ID=<?php  echo $companyid;  ?>", "myWindow", "status = 0, height = 350, width = 550,left = 470,top = 200, resizable = 0, dependent = 1" )
}

// End -->
</script>
</head>

<body>

<table border="0" width="100%" id="top_table">
	<tr>
		<td colspan="2"><h1><img border="0" src="images/branche_select.png" > Selecteer nieuwe branche voor <font color="#800000"><?php echo $companyname; ?></font></h1></td>
		<td rowspan="2">
		<p align="center">
		<a target="_self" href="crmadmin.php">
		<img border="0" src="images/triage.png" ></a></td>
		<td><a target="_self" href="logout.php">log-out</a></td>
		<td><?php echo $inlognaam; ?></td>
	</tr>
	
</table>

<table align="center">

	<tr>
		<td>
            <form>
		<input type="hidden" name="COMPANY_ID" value="<?php  echo $companyid;  ?>">
        <input class="knop" name="submit" type="image" img border="0" src="images/branche_add.png" width="47" height="47" onClick="javascript:popUp('')"> - Voeg branche toe
		</td></form>
		</td>
			<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
	<input type="hidden" name="COMPANY_ID" value="<?php   echo $companyid; ?>">

  		<td>
        <input class="knop" name="submit" type="image" src="images/cancel_groot.jpg"  width="47" height="47" value="Annuleren"> - Annuleren
        </td>
		<td><input class="knop" name="submit" type="image" img border="0" src="images/refresh.jpg" value="refresh" width="47" height="47"> - Verversen</td>
		<td>&nbsp;</td>

	</tr>
</table>
		</form>



		
<table align="center" border="0" cellpadding="2" cellspacing="0">
  <tr bgcolor="#ECE9D8">
    <th align="center" colspan="2">Select</th>
    <th align="center" colspan="3">Branchenaam</th>
      </tr>
<?php
$bg = 0;

$sqla  = "SELECT * FROM branche ORDER BY BRANCHE_NAME ASC ";

// Query uitvoeren en een resultaatset opslaan:
$branche = mysql_query($sqla);

while ($rija = mysql_fetch_assoc($branche)) {

//achtergrond neerleggen
if ($bg == 0)
{
 $bgcolour = $bgrij1;
 $bg = 1;
 }
elseif ($bg == 1)
{
 $bgcolour = $bgrij2;
 $bg = 0;
}

$brancheid = $rija["BRANCHE_ID"];
$branchename = $rija["BRANCHE_NAME"];

    echo '<form action="crmbrancheselect.php" method="post">';

    echo '<input type="hidden" align="right" name="COMPANY_ID" size="5" value="';
    echo $companyid;
    echo '">';
    
    
    echo '<tr>'; // Eén rij per holding

         //beginkolom
    echo '<td bgcolor="#ECE9D8" style="border-bottom: solid 1px #F5F5F5"></td>';

    // Dit wordt de select kolom:
    echo '<td bgcolor="' . $bgcolour . '" align="center" style="border-bottom: solid 1px #F5F5F5">';
    echo '<input class="knop" name="submit" type="image" src="images/archief_klein.jpg" value="select">';
    echo '<input type="hidden" align="right" name="BRANCHE_ID" size="5" value="';
    echo $brancheid;
    echo '">';
    echo '</td>';
    
         //tussenkolom
    echo '<td width="1" bgcolor="#F5F5F5" style="border-bottom: solid 1px #F5F5F5"></td>';

    echo '<td bgcolor="' . $bgcolour . '" align="left" style="border-bottom: solid 1px #F5F5F5">';
    echo '<a href="crmholdingdetail.php?BRANCHE_ID=' . $branche . '">';
    echo $branchename;
    echo '</a>';
    echo '</td>';

                 //eindkolom

    echo '<td bgcolor="#ECE9D8" style="border-bottom: solid 1px #ECE9D8"></td>';


    echo '</tr>'; // einde rij bedrijven
     echo '</form>';
     
}

//sluitrij
    echo '<tr>'; // einde rij
    echo '<td bgcolor="#ECE9D8" style="border-bottom: solid 1px #ECE9D8"></td>';
    echo '<td bgcolor="#ECE9D8" style="border-bottom: solid 1px #ECE9D8"></td>';
    echo '<td bgcolor="#ECE9D8" style="border-bottom: solid 1px #ECE9D8"></td>';
   echo '<td bgcolor="#ECE9D8" style="border-bottom: solid 1px #ECE9D8"></td>';
    echo '<td bgcolor="#ECE9D8" style="border-bottom: solid 1px #ECE9D8"></td>';
    echo '</tr>'; // einde rij

// Einde van de tabel en de webpagina:
echo "</table>\n";

?>


 </body>
