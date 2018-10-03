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

  // Alle records in de resultaatset weergeven als een tabelrij
  // door het resultaat te verwerken als een associatieve array:
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


$functionname="";

if (isset($_POST['submit'])) {

$emplid = $_POST["EMPL_ID"];

//creator naar het inlogid zetten)

$creator = $inlogid;

// Constanten voor mysql_connect() insluiten:
require_once('../../triageinc/mysql_connect.inc.php');
require_once('../../triageinc/mysql_dbase.inc.php');

// Databaseverbinding openen met mysql_connect():
$verbinding = mysql_connect(MYSQL_SERVER, MYSQL_GEBRUIKERSNAAM, MYSQL_WACHTWOORD) or die("Verbinding mislukt: " . mysql_error());

// Database 'crm' selecteren:
mysql_select_db($dbase) or die("Kon de database niet openen: " . mysql_error());

// Dit is het laatste CV_EMPL_ID  ophalen

// SQL-query nummer 1 opstellen:
$sqlid  = "SELECT CV_EMPL_ID FROM cv_empl ORDER BY CV_EMPL_ID DESC limit 1;";  // en sorteer oplopend op 'holdingnaam'.



// Query uitvoeren en een resultaatset opslaan:
$resultaatid = mysql_query($sqlid);

// Alle records in de resultaatset weergeven als een tabelrij
// door het resultaat te verwerken als een associatieve array:
while ($rijid = mysql_fetch_assoc($resultaatid)) {

$cvemplid = $rijid["CV_EMPL_ID"];

}

$cvemplid = $cvemplid +1;


if ($_POST['submit'] == "addcv") {

$sqla  = "INSERT INTO cv_empl (CV_EMPL_ID, FK_EMPL_ID, CV_EMPL_CREATOR)  VALUES  ('$cvemplid', '$emplid', '$creator')";

echo $sqla;

$insert = mysql_query($sqla);

		if ($insert) {
                header("Location: http://" . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . "/crmmedewerkercv.php?EMPL_ID=" . $emplid );
                exit;
            }

}


}

?>

<html>
<head>
<title>Lijst met alle medewerkers</title>


 <link rel="stylesheet" type="text/css" href="main.css" />
</head>

<body>


<table border="0" width="100%" id="top_table">
	<tr>
		<td colspan="2"><h1><a target="_self" href="crmadmin.php"><img border="0" src="images/medewerker_groot.png" width="72" height="72"></a>   Medewerkers</h1></td>
		<td rowspan="2">
		<p align="center">
		<a target="_self" href="crmadmin.php">
		<img border="0" src="images/triage.png" ></a></td>
		<td><a target="_self" href="logout.php">log-out</a></td>
		<td><?php echo $inlognaam; ?></td>
	</tr>
	<tr>
		<td>
<a href="crmmedewerkertoevoegen.php">
<img border="0" src="images/medewerker_add.png" width="47" height="47"></a> - Voeg medewerker toe&nbsp;&nbsp;&nbsp;
		<a href="crmmedewerkerhistorylijst.php">
		<img border="0" src="images/history.JPG" width="38" height="36"></a>
		- Verleden</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
</table>

<table width="100%" border="0" cellpadding="2" cellspacing="0">
  <tr bgcolor="#ECE9D8">
    <th align="center" colspan="2">CV</th>
    <th align="center" colspan="2">Edit</th>
    <th align="center" colspan="2">Del</th>
    <th align="center" colspan="2">ZZP</th>
    <th align="center" colspan="2">Prop</th>
    <th align="center" colspan="2">Contract</th>
    <th align="center" colspan="2">Functie</th>
    <th align="left" colspan="2">Achternaam</th>
    <th align="left" colspan="2">Voornaam</th>
    <th align="left" colspan="2">Telefoon</th>
    <th align="left" colspan="3">Mail</th>
      </tr>
<?php
$bg = 0;

$sqla  = "SELECT * FROM employee WHERE EMPL_STATUS = 'A' ORDER BY EMPL_LASTNAME ASC ";

// Query uitvoeren en een resultaatset opslaan:
$employee = mysqli_query($connect, $sqla);

while ($rija = mysqli_fetch_assoc($employee)) {

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

// wegschrijven van de emplid

$emplid = $rija["EMPL_ID"];
$emplzzp = $rija["EMPL_ZZP"];
$fkfunctionid = $rija["FK_FUNCTION_ID"];

$sqlfunc  = "SELECT * FROM emp_function WHERE  FUNCTION_ID ='$fkfunctionid' ;";     // Vraag de desbetreffende functie aan

$resultfunctie = mysql_query($sqlfunc);

while ($rijfunc = mysql_fetch_assoc($resultfunctie)){
$functionname = $rijfunc["FUNCTION_NAME"];

}

    //deze form heb ik nodig voor het aanmaken van de CV

    echo '<form action="crmmedewerkerlijst.php" method="post">';

    echo '<input type="hidden" align="right" name="EMPL_ID" size="5" value="';
    echo $emplid;
    echo '">';


    echo '<tr>'; // E�n rij per employee

         //beginkolom
    echo '<td bgcolor="#ECE9D8" style="border-bottom: solid 1px #F5F5F5"></td>';

        // Dit wordt de CV kolom:
    echo '<td bgcolor="' . $bgcolour . '" align="center" style="border-bottom: solid 1px #F5F5F5">';

    // eerst kijken of er een CV is aangemaakt.
$sqlcv = "
    SELECT *
    FROM cv_empl
    WHERE FK_EMPL_ID ='$emplid'

";

if(!$resultcv = mysql_query($sqlcv))
{
    trigger_error(mysql_error().' In query: '.$sqlcv);
}
else
{
    if(mysql_num_rows($resultcv) > 0)
    {

    echo '<a href="crmmedewerkercv.php?EMPL_ID=' . $emplid . '">';
    echo '<img border="0" src="images/cv_icon.jpg" >';
    echo '</a>';

    }
    else
    {
    echo '<input class="knop" name="submit" type="image" src="images/toevoegen.jpg" value="addcv">';

    }
}

    echo '</td>';

         //tussenkolom
    echo '<td width="1" bgcolor="#F5F5F5" style="border-bottom: solid 1px #F5F5F5"></td>';

    // Dit wordt de edit kolom:
    echo '<td bgcolor="' . $bgcolour . '"  align="center" style="border-bottom: solid 1px #F5F5F5">';
    echo '<a href="crmmedewerkerdetail.php?EMPL_ID=' . $emplid . '">';
    echo '<img border="0" src="images/b_edit.png" >';
    echo '</a>';
    echo '</td>';

         //tussenkolom
    echo '<td bgcolor="#F5F5F5" style="border-bottom: solid 1px #F5F5F5"></td>';

        // Dit wordt de delete kolom:
    echo '<td bgcolor="' . $bgcolour . '" align="center"  style="border-bottom: solid 1px #F5F5F5">';
    echo '<a href="crmmedewerkerdelete.php?EMPL_ID=' . $emplid . '">';
    echo '<img border="0" src="images/b_drop.png" >';
    echo '</a>';
    echo '</td>';

                 //tussenkolom
    echo '<td bgcolor="#F5F5F5" style="border-bottom: solid 1px #F5F5F5"></td>';

            // Dit wordt de ZZP kolom:
if ($emplzzp == 'N'){
    echo '<td bgcolor="' . $bgcolour . '"  style="border-bottom: solid 1px #F5F5F5"><font color= "#33CC33"><b>';
    echo $emplzzp;
    echo '</b></td>';
} elseif ($emplzzp == 'Y'){
    echo '<td bgcolor="' . $bgcolour . '"  style="border-bottom: solid 1px #F5F5F5"><font color= "#FF0000"><b>';
    echo $emplzzp;
    echo '</b></td>';

}
             //tussenkolom
    echo '<td bgcolor="#F5F5F5" style="border-bottom: solid 1px #F5F5F5"></td>';

             //lijst met proposals voor medewerkers

    echo '<td bgcolor="' . $bgcolour . '" align="center"  style="border-bottom: solid 1px #F5F5F5">';
    echo '<a href="crmmedewerkerproposallijst.php?EMPL_ID=' . $emplid . '">';
    echo '<img border="0" src="images/Folder_24.png">';
    echo '</a>';
    echo '</td>';


             //tussenkolom
    echo '<td bgcolor="#F5F5F5" style="border-bottom: solid 1px #F5F5F5"></td>';

$sqlcontract  = "SELECT * FROM contract_has_employee WHERE FK_EMPL_ID ='$emplid' AND RELATION_STATUS= 'A';";     // waar de fkemplid gelijk is aan de import id

// Query uitvoeren en een resultaatset opslaan:
$resultaatcontract = mysql_query($sqlcontract);


// Alle records in de resultaatset weergeven als een tabelrij
// door het resultaat te verwerken als een associatieve array:
while ($rijcontract = mysql_fetch_assoc($resultaatcontract)) {

$fkcontractid = $rijcontract["FK_CONTRACT_ID"];
$relationstartdate = $rijcontract["RELATION_START_DATE"];
$relationenddate = $rijcontract["RELATION_END_DATE"];
$relationcreator = $rijcontract["RELATION_CREATOR"];
$relationstatus = $rijcontract["RELATION_STATUS"];
$relationid = $rijcontract["RELATION_ID"];
}


//bijbehorende contract bijzoeken (als ie niet leeg is)
if (mysql_num_rows($resultaatcontract) == 0) {

$sqlcontractp  = "SELECT * FROM contract_has_employee WHERE FK_EMPL_ID ='$emplid' AND RELATION_STATUS= 'P';";     // waar de fkemplid gelijk is aan de import id

// Query uitvoeren en een resultaatset opslaan:
$resultaatcontractp = mysql_query($sqlcontractp);


// Alle records in de resultaatset weergeven als een tabelrij
// door het resultaat te verwerken als een associatieve array:
while ($rijcontractp = mysql_fetch_assoc($resultaatcontractp)) {

$fkcontractid = $rijcontractp["FK_CONTRACT_ID"];
$relationstartdate = $rijcontractp["RELATION_START_DATE"];
$relationenddate = $rijcontractp["RELATION_END_DATE"];
$relationcreator = $rijcontractp["RELATION_CREATOR"];
$relationstatus = $rijcontractp["RELATION_STATUS"];
$relationid = $rijcontractp["RELATION_ID"];
}
if (mysql_num_rows($resultaatcontractp) == 0) {
        // Dit wordt de contract kolom:

    echo '<td bgcolor="' . $bgcolour . '" align="center"  style="border-bottom: solid 1px #F5F5F5">';
    echo '<a href="crmmedewerkercontractselect.php?FK_EMPL_ID=' .$emplid . '">';
    echo 'Propose';
    echo '<img border="0" src="images/select.jpg" >';
    echo '</a>';
    echo '</td>';

     }
     else  {
     // alleen v
     echo '<td bgcolor="' . $bgcolour . '" align="center"  style="border-bottom: solid 1px #F5F5F5">';
//    echo '<a href="crmmedewerkercontract.php?EMPL_ID=' . $emplid . '">';
    echo '<a href="crmcontractmedewerkerdetail.php?EMPL_ID=' . $emplid . '&CONTRACT_ID=' . $fkcontractid . '">';
    echo '<img border="0" src="images/Folder_24.png">'. '  ';
    echo '</a>';
    echo '</td>';
}

}else
{
        // Dit wordt de contract kolom:
    echo '<td bgcolor="' . $bgcolour . '" align="center"  style="border-bottom: solid 1px #F5F5F5">';
    echo '<a href="crmcontractmedewerkerdetail.php?EMPL_ID=' . $emplid . '&CONTRACT_ID=' . $fkcontractid . '">';
    echo '<img border="0" src="images/contract_klein.png">'. '  ';
    echo '</a>';
    echo '</td>';
 }
             //tussenkolom
    echo '<td bgcolor="#F5F5F5" style="border-bottom: solid 1px #F5F5F5"></td>';

              // Functie
    echo '<td align="left" bgcolor="' . $bgcolour . '" style="border-bottom: solid 1px #F5F5F5">';
    if ( $functionname =="")
    {$functionname= '--- geen selectie ---';}
    echo $functionname;
    $functionname="";
    $functionid="";
    echo '</td>';

             //tussenkolom
    echo '<td bgcolor="#F5F5F5" style="border-bottom: solid 1px #F5F5F5"></td>';

              // Achternaam
    echo '<td align="left" bgcolor="' . $bgcolour . '" style="border-bottom: solid 1px #F5F5F5">';
    echo '<a href="crmmedewerkerdetail.php?EMPL_ID=' . $emplid . '">';
    echo '<img border="0" src="images/medewerker_klein.png">    ';
    echo $rija["EMPL_LASTNAME"];
    echo '</a>';
    echo '</td>';
             //tussenkolom

    echo '<td bgcolor="#F5F5F5" style="border-bottom: solid 1px #F5F5F5"></td>';

          // Voornaam
    echo '<td align="left" bgcolor="' . $bgcolour . '" style="border-bottom: solid 1px #F5F5F5">';
    echo '<a href="crmmedewerkerdetail.php?EMPL_ID=' . $emplid . '">';
    echo $rija["EMPL_FIRSTNAME"];
    echo '</a>';
    echo '</td>';

             //tussenkolom

    echo '<td bgcolor="#F5F5F5" style="border-bottom: solid 1px #F5F5F5"></td>';

          //telefoon
    echo '<td align="left" bgcolor="' . $bgcolour . '" style="border-bottom: solid 1px #F5F5F5">';
    echo '<img border="0" src="images/mobile.jpg">'. '  ';
    echo $rija["EMPL_PHONE"];
    echo '</td>';

             //tussenkolom
    echo '<td bgcolor="#F5F5F5" style="border-bottom: solid 1px #F5F5F5"></td>';

              //mail
    echo '<td align="left" bgcolor="' . $bgcolour . '" style="border-bottom: solid 1px #F5F5F5">';
    echo '<img border="0" src="images/b_mail.png">'. '  ';
    echo '<a href="mailto:';
    echo $rija["EMPL_MAIL"];
    echo '">';
    echo $rija["EMPL_MAIL"];
    echo '</a>';
    echo '</td>';

             //eindkolom

    echo '<td bgcolor="#ECE9D8" style="border-bottom: solid 1px #ECE9D8"></td>';

    echo '</tr>'; // einde rij medewerkers
     echo '</form>';
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
    echo '<td bgcolor="#ECE9D8" style="border-bottom: solid 1px #ECE9D8"></td>';
    echo '<td bgcolor="#ECE9D8" style="border-bottom: solid 1px #ECE9D8"></td>';
    echo '<td bgcolor="#ECE9D8" style="border-bottom: solid 1px #ECE9D8"></td>';
    echo '<td bgcolor="#ECE9D8" style="border-bottom: solid 1px #ECE9D8"></td>';
    echo '<td bgcolor="#ECE9D8" style="border-bottom: solid 1px #ECE9D8"></td>';
    echo '<td bgcolor="#ECE9D8" style="border-bottom: solid 1px #ECE9D8"></td>';
    echo '</tr>'; // einde rij


// Resultaatset vrijgeven:
mysql_free_result($employee);

// Einde van de tabel en de webpagina:
echo "</table>\n";

?>

 </body>
