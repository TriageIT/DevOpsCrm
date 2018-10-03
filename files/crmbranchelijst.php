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
		<td colspan="2"><h1><a target="_self" href="crmmaintenance.php"><img border="0" src="images/branche_groot.png"></a>   Branches</h1></td>
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
<img border="0" src="images/branche_toevoegen.jpg" width="32" height="32"></a> - Voeg branche toe
		</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
</table>

<table align="center" border="0" cellpadding="2" cellspacing="0">
  <tr bgcolor="#ECE9D8">
    <th align="center" colspan="2">Edit</th>
    <th align="center" colspan="3">branche</th>
      </tr>
<?php
$bg = 0;

$sqla  = "SELECT * FROM branche ORDER BY BRANCHE_NAME ASC ";

// Query uitvoeren en een resultaatset opslaan:
$branche = mysqli_query($connect,$sqla);

while ($rija = mysqli_fetch_assoc($branche)) {

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

    echo '<tr>'; // E�n rij per branche


         //beginkolom
    echo '<td bgcolor="#ECE9D8" style="border-bottom: solid 1px #F5F5F5"></td>';

    // Dit wordt de edit kolom:
    echo '<td bgcolor="' . $bgcolour . '" align="center" style="border-bottom: solid 1px #F5F5F5">';
    echo '<a href="crmbranchedetail.php?BRANCHE_ID=' . $brancheid . '">';
    echo '<img border="0" src="images/b_edit.png" >';
    echo '</a>';
    echo '</td>';

         //tussenkolom
    echo '<td width="1" bgcolor="#F5F5F5" style="border-bottom: solid 1px #F5F5F5"></td>';

    echo '<td bgcolor="' . $bgcolour . '" align="left" style="border-bottom: solid 1px #F5F5F5">';
    echo '<a href="crmbranchedetail.php?BRANCHE_ID=' . $brancheid . '">';
    echo $branchename;
    echo '</a>';
    echo '</td>';

              //eindkolom

    echo '<td bgcolor="#ECE9D8" style="border-bottom: solid 1px #ECE9D8"></td>';

    echo '</tr>'; // einde rij branches

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

</br>
</br>

	</font>

 </body>
