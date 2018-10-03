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

//einde session start

if (isset($_GET['COMPANY_ID'])) {
    $companyid = $_GET['COMPANY_ID'];


$sql = "SELECT * FROM company WHERE  COMPANY_ID ='$companyid'";         // waar de COMPANY_id gelijk is aan de import

$query = mysqli_query($connect, $sql);

while( $uitvoer = mysqli_fetch_assoc( $query ) )
   {
   $companyid = $uitvoer['COMPANY_ID'];
   $companyname = $uitvoer['COMPANY_NAME'];
   $companyaddress = $uitvoer['COMPANY_ADDRESS'];
   $companyzipcode = $uitvoer['COMPANY_ZIPCODE'];
   $companycity = $uitvoer['COMPANY_CITY'];
   $companyphone = $uitvoer['COMPANY_PHONE'];
   $companyfax = $uitvoer['COMPANY_FAX'];
   $billingheader = $uitvoer['BILLING_HEADER'];
   $billingaddress = $uitvoer['BILLING_ADDRESS'];
   $billingzipcode = $uitvoer['BILLING_ZIPCODE'];
   $companypobox  = $uitvoer['COMPANY_POBOX'];
   $billingcity = $uitvoer['BILLING_CITY'];
   $companybillingnumber = $uitvoer['COMPANY_BILLINGNUMBER'];
   $companynotes = $uitvoer['COMPANY_NOTES'];
   $referencesite = $uitvoer['REFERENCE_SITE'];
   $fkholdingid = $uitvoer['FK_HOLDING_ID'];
   $fkbrancheid = $uitvoer['FK_BRANCHE_ID'];
   $fkcompanystatusid = $uitvoer['FK_COMPANY_STATUS_ID'];
   $comcreationdate = $uitvoer['COM_CREATION_DATE'];
   $comcreator = $uitvoer['COM_CREATOR'];
   $comowner = $uitvoer['COM_OWNER'];

 if ($fkbrancheid == 0){

$branchename = '---geen branche---';

            }
elseif ($fkbrancheid != 0){

$sqlbranche  = "SELECT * FROM branche WHERE BRANCHE_ID ='$fkbrancheid'";     // waar de BRANCHE gelijk is aan de import BRANCHE

$querybranche = mysqli_query($connect, $sqlbranche);

// Alle records in de resultaatset weergeven als een tabelrij
// door het resultaat te verwerken als een associatieve array:
while( $outputbranche = mysqli_fetch_assoc( $querybranche ) )
   {
$brancheid = $outputbranche["BRANCHE_ID"];
$branchename = $outputbranche["BRANCHE_NAME"];
}
     }
   // naam creator opzoeken
$sqlcreator = "SELECT * FROM employee WHERE EMPL_ID ='$comcreator' ;";     // waar de USERID gelijk is aan de creator

$resultcreator = mysqli_query ($connect, $sqlcreator);

while ($rijcreator = mysqli_fetch_assoc($resultcreator)) {

$creatorlastname = $rijcreator['EMPL_LASTNAME'];
$creatorfirstname = $rijcreator['EMPL_FIRSTNAME'];
}

// naam eigenaar opzoeken
$sqlowner = "SELECT * FROM employee WHERE EMPL_ID ='$comowner' ;";     // waar de USERID gelijk is aan de eigenaar

$resultowner = mysqli_query ($connect, $sqlowner);

while ($rijowner = mysqli_fetch_assoc($resultowner)) {

$ownerlastname = $rijowner['EMPL_LASTNAME'];
$ownerfirstname = $rijowner['EMPL_FIRSTNAME'];
}


 	if ($referencesite == 'on'){
              $referencesite = Y ;
            }
            elseif ($referencesite == 'off'){
              $referencesite = N ;
            }
   }

if ($fkholdingid == 0){

$holdingname = '---geen holding---';

            }
elseif ($fkholdingid != 0){

$sqlholding  = "SELECT * FROM holding WHERE HOLDING_ID ='$fkholdingid'";     // waar de holding_id gelijk is aan de import holdingid

$queryholding = mysqli_query($connect, $sqlholding);

// Alle records in de resultaatset weergeven als een tabelrij
// door het resultaat te verwerken als een associatieve array:
while( $output = mysqli_fetch_assoc( $queryholding ) )
   {

$holdingid = $output["HOLDING_ID"];
$holdingname = $output["HOLDING_NAME"];
}
            }


} else {

if (isset($_POST['submit'])) {

$companyid = $_POST['COMPANY_ID'];
$companyname = $_POST['COMPANY_NAME'];
$companyaddress = $_POST['COMPANY_ADDRESS'];
$companyzipcode = $_POST['COMPANY_ZIPCODE'];
$companycity = $_POST['COMPANY_CITY'];
$companyphone = $_POST['COMPANY_PHONE'];
$companyfax = $_POST['COMPANY_FAX'];
$companybillingnumber = $_POST['COMPANY_BILLINGNUMBER'];
$companynotes = $_POST['COMPANY_NOTES'];
$referencesite = $_POST['REFERENCE_SITE'];
$billingheader = $_POST['BILLING_HEADER'];
$billingaddress = $_POST['BILLING_ADDRESS'];
$billingzipcode = $_POST['BILLING_ZIPCODE'];
$companypobox  = $_POST['COMPANY_POBOX'];
$billingcity = $_POST['BILLING_CITY'];
$fkcompanystatusid = $_POST['FK_COMPANY_STATUS_ID'];

			if ($referencesite == on){
              $referencesite = Y ;
            }
            elseif ($referencesite == off){
              $referencesite = N ;
            }

            // Constanten voor mysql_connect() insluiten:
            require_once('../../triageinc/mysql_connect.inc.php');
            require_once('../../triageinc/mysql_dbase.inc.php');

            // Databaseverbinding openen met mysql_connect():
            $connect = mysqli_connect(MYSQL_SERVER, MYSQL_GEBRUIKERSNAAM, MYSQL_WACHTWOORD, $dbase) or die("Unable to Connect to 'MYSQL_SERVER'");

            mysqli_select_db($connect, $dbase) or die("Could not open the db '$dbase'");



    if ($_POST['submit'] == "Okay") {

// MSSQL-toevoegquery opstellen:

$sqld  = "UPDATE company SET COMPANY_NAME ='$companyname', FK_COMPANY_STATUS_ID= '$fkcompanystatusid', COMPANY_ADDRESS ='$companyaddress', COMPANY_CITY ='$companycity', COMPANY_PHONE ='$companyphone', COMPANY_FAX ='$companyfax',BILLING_HEADER='$billingheader' ,BILLING_ADDRESS='$billingaddress', BILLING_ZIPCODE='$billingzipcode', COMPANY_POBOX='$companypobox',BILLING_CITY='$billingcity',    COMPANY_BILLINGNUMBER='$companybillingnumber', COMPANY_ZIPCODE ='$companyzipcode', COMPANY_NOTES ='$companynotes', REFERENCE_SITE ='$referencesite' WHERE COMPANY_ID ='$companyid';";


$update = mysqli_query($connect, $sqld);

            // Browser omleiden naar de bedrijflijst
            // als de bijdrage is toegevoegd:
		if ($update) {
                header("Location: http://" . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . "/crmbedrijflijst.php");
                exit;
            }


   }

       if ($_POST['submit'] == "Annuleren") {
       header("Location: http://" . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . "/crmbedrijflijst.php");
                exit;
       }

}

}



// Webpagina weergeven:
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Details <?php echo $companyname; ?></title>
<link rel="stylesheet" type="text/css" href="main.css" />

</head>


<body>
<table border="0" width="100%" id="top_table">
	<tr>
		<td colspan="2"><h1><a href="crmbedrijflijst.php"><img border="0" src="images/bedrijf_groot.png" ></a>   Bedrijfdetail <font color="#800000"><?php echo $companyname;?></font></h1></td>
		<td rowspan="2">
		<p align="center">
		<a target="_self" href="crmadmin.php">
		<img border="0" src="images/triage.png" ></a></td>
		<td><a target="_self" href="logout.php">log-out</a></td>
		<td><?php echo $inlognaam; ?></td>
	</tr>
	</table>

<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
<input type="hidden" name="COMPANY_ID" value="<?php echo $companyid;?>">

<table border="0" width="100%" >
	<tr>
		<td>
<a href="crmbedrijftoevoegen.php">
<img border="0" src="images/bedrijf_add.png" width="45" height="45"></a> - Voeg bedrijf toe
		</td>
		<td>
               <a href="crmcontracttoevoegen.php?COMPANY_ID=<?php echo $companyid;?>">
               <img border="0" src="images/contract_add.png" width="45" height="45"></a> - Voeg contract toe</td>
		<td>
               <a href="crmcontacttoevoegen.php?COMPANY_ID=<?php echo $companyid;?>">
               <img border="0" src="images/contacten_add.png"  width="45" height="45"></a> - Voeg nieuw contact toe
               </td>
		<td>
               <a href="crmcontactselect.php?COMPANY_ID=<?php echo $companyid;?>&ROUTE=1">
               <img border="0" src="images/contacten_select.png"  width="45" height="45"></a> - Selecteer een contact
               </td>
		<td>
               <input class="knop" name="submit" type="image" src="images/okay_groot.jpg"  width="47" height="47" value="Okay"> - Okay
               </td>
		<td>
               <input class="knop" name="submit" type="image" src="images/cancel_groot.jpg"  width="47" height="47" value="Annuleren"> - Annuleren
               </td>
	</tr>
</table>


<table border="0" cellpadding="2" cellspacing="0" width="100%">
	<tr>
      	<td>Naam</td>
      	<td >

		<input type="text" name="COMPANY_NAME" size="30" value="<?php echo $companyname;?>"> Referentie&nbsp;
			<input type="checkbox" name="REFERENCE_SITE" size="1"
            <?php
			if ($referencesite == 'Y'){
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
	      <td >
			<fieldset style="padding: 2">
			<legend>Adres</legend>
			<p>Straat&nbsp;<input type="text" name="COMPANY_ADDRESS" size="34" value="<?php echo $companyaddress;?>">                  </p>
            <p>Postcode <input type="text" name="COMPANY_ZIPCODE" size="6" value="<?php echo $companyzipcode;?>">
            &nbsp;&nbsp;Te&nbsp;&nbsp;<input type="text" name="COMPANY_CITY" size="39" value="<?php echo $companycity;?>">             </p>
         <p>Telefoon&nbsp;<input type="text" name="COMPANY_PHONE" size="11" value="<?php echo $companyphone;?>">                       </p>
         <p>Fax <input type="text" name="COMPANY_FAX" size="11" value="<?php echo $companyfax;?>">                                     </p>
			</fieldset></td>
	      <td>
			<fieldset style="padding: 2">
			<legend>Factuur gegevens <img border="0" src="images/billing_klein.jpg"></legend>
			<p>Aanhef (m/v)&nbsp;<input type="text" name="BILLING_HEADER" size="50" value="<?php echo $billingheader;?>">                  </p>
			<p>Straat&nbsp;<input type="text" name="BILLING_ADDRESS" size="34" value="<?php echo $billingaddress;?>">                  </p>
            <p>Postbus <input type="text" name="COMPANY_POBOX" size="6" value="<?php echo $companypobox;?>">                            </p>
            <p>Postcode <input type="text" name="BILLING_ZIPCODE" size="6" value="<?php echo $billingzipcode;?>">
            &nbsp;&nbsp;Te&nbsp;&nbsp;<input type="text" name="BILLING_CITY" size="39" value="<?php echo $billingcity;?>">             </p>
			</fieldset></td>
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
	<tr>

      <td>Debiteurnummer</td>
      <td                   >
        <input type="text" name="COMPANY_BILLINGNUMBER" size="5" value="<?php echo $companybillingnumber;?>">&nbsp;
        </td>
      <td >
        &nbsp;</td>
      <td >
        &nbsp;</td>
    </tr>
	<tr>

      <td>Status</td>
      <td>
      <?php


// routine die moet kijken welke er reeds ingevuld is

$sqlcompanystatus  = "SELECT * FROM company_status ORDER BY COMPANY_STATUS_ID ASC ";

// Query uitvoeren en een resultaatset opslaan:
$companystatus = mysqli_query($connect, $sqlcompanystatus);

$companystatusid = array ();
$companystatusname  = array ();

$statusteller = 0;

while ($rijcompanystatus = mysqli_fetch_assoc($companystatus)) {
$companystatusid [$statusteller] = $rijcompanystatus["COMPANY_STATUS_ID"];
$companystatusname [$statusteller]= $rijcompanystatus["COMPANY_STATUS_NAME"];
$statusteller = $statusteller+1;
}


    //echo $companystatus;

    echo '<select name="FK_COMPANY_STATUS_ID"> ';

    $t = 0;

    while ($t<$statusteller)
    {
    if ( $companystatusid[$t] ==  $fkcompanystatusid){
    echo '<option value="'.$companystatusid[$t].'">'.$companystatusname[$t];

    }
    $t++;
    }

    $t = 0;

    while ($t<$statusteller)
    {
    if ( $companystatusid[$t] !=  $fkcompanystatusid){
    echo '<option value="'.$companystatusid[$t].'">'.$companystatusname[$t];

    }
    $t++;
    }



    ?>
        &nbsp;
        </td>
      <td >
        &nbsp;</td>
      <td >
        &nbsp;</td>
    </tr>

	<tr>

      <td>Holding</td>
      <td align="right" nowrap width="582">
        <p align="left"><?php echo $holdingname; ?>&nbsp;
<?php
    echo '<a href="crmholdingselect.php?COMPANY_ID=' . $companyid . '" COMPANY_ID="' . $companyid .'">';
    echo '<img border="0" src="images/holding_select.png" >';
    echo '</a>';
    ?>


        </td>
      <td align="right" nowrap>
        &nbsp;</td>
      <td align="right" nowrap>
        &nbsp;</td>
    </tr>
    	<tr>

      <td>Branche</td>
      <td align="right" >
        <p align="left"><?php echo $branchename; ?>&nbsp;
<?php
    echo '<a href="crmbrancheselect.php?COMPANY_ID=' . $companyid .'">';
    echo '<img border="0" src="images/branche_select.png" >';
    echo '</a>';
    ?>


        </td>
      <td align="right" nowrap>
        &nbsp;</td>
      <td align="right" nowrap>
        &nbsp;</td>
    </tr>
 	<tr>
		<td>Creator</td>
   		<td><input type="hidden" name="CONTRACT_CREATOR" size="1" value="<?php echo $contractcreator;?>">
           <?php
           echo $creatorfirstname.' '.$creatorlastname ;
           ?></td>
      	<td>
		</td>
      	<td>
		</td>
   	</tr>
   	<tr>
		<td>Owner</td>
   		<td><input type="hidden" name="CONTRACT_OWNER" size="1" value="<?php echo $contractowner;?>">
           <?php
           echo $ownerfirstname.' '.$ownerlastname ;
           ?></td>
      	<td>
		</td>
      	<td>
		</td>
   	</tr>
  </table>

</form>

<table border="0" width="100%" >
	<tr>
		<td>
<h1<a href="crmcontactlijst.php"><img border="0" src="images/contacten_groot.jpg"></a>   Contacten</h1>
		</td>
		<td>
        <a href="crmcontacttoevoegen.php?COMPANY_ID=<?php echo $companyid;?>">
<img border="0" src="images/contacten_add.png"  width="45" height="45"></a> - Voeg nieuw contact toe
        </td>
		<td><a href="crmcontactselect.php?COMPANY_ID=<?php echo $companyid;?>&ROUTE=1">
<img border="0" src="images/contacten_select.png"  width="45" height="45"></a> - Selecteer een contact</td>
	</tr>
</table>





<table border="0" align="center" cellpadding="2" cellspacing="0">
  <tr bgcolor="#ECE9D8">
    <th align="center" colspan="3">Del</th>
    <th align="center" colspan="2">Achternaam</th>
    <th align="center" colspan="2">Voornaam</th>
    <th align="center" colspan="2">Telefoon</th>
    <th align="center" colspan="2">Mobiel</th>
    <th align="center" colspan="3">E-mail</th>
          </tr>
<?php

// bolean introduceren voor achtergrondkleur
$bg = 0;

$sqla  = "SELECT * FROM contact WHERE FK_COMPANY_ID = '$companyid' ORDER BY CONTACT_SURNAME ASC ;";

// Query uitvoeren en een resultaatset opslaan:
$contact = mysqli_query($connect, $sqla);

while ($rija = mysqli_fetch_assoc($contact)) {

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


    echo '<tr>'; // E�n rij per contact


             //beginkolom
    echo '<td bgcolor="#ECE9D8" style="border-bottom: solid 1px #F5F5F5"></td>';

        // Dit wordt de delete kolom:
    echo '<td bgcolor="' . $bgcolour . '"  align="right" style="border-bottom: solid 1px #F5F5F5">';
    echo '<td align="right" style="border-bottom: solid 1px #F5F5F5">';
    echo '<a href="crmcontactdelete.php?CONTACT_ID=' . $rija["CONTACT_ID"] . '" CONTACT_ID="' . $rija["CONTACT_ID"] .'">';
    echo '<img border="0" src="images/b_drop.png" >';
    echo '</a>';
    echo '</td>';

         //tussenkolom
    echo '<td bgcolor="#ECE9D8" style="border-bottom: solid 1px #F5F5F5"></td>';

    echo '<td bgcolor="' . $bgcolour . '"  align="left" style="border-bottom: solid 1px #F5F5F5">';
    echo '<a href="crmcontactdetail.php?CONTACT_ID=' . $rija["CONTACT_ID"] . '" CONTACT_ID="' . $rija["CONTACT_ID"] .'">';
    echo '<img border="0" src="images/contacten_klein.jpg">';
    echo $rija["CONTACT_SURNAME"];
    echo '</a>';
    echo '</td>';

         //tussenkolom
    echo '<td bgcolor="#ECE9D8" style="border-bottom: solid 1px #F5F5F5"></td>';

    echo '<td bgcolor="' . $bgcolour . '"  align="left" style="border-bottom: solid 1px #F5F5F5">';
    echo $rija["CONTACT_FIRSTNAME"];
    echo '</td>';

         //tussenkolom
    echo '<td bgcolor="#ECE9D8" style="border-bottom: solid 1px #F5F5F5"></td>';

    echo '<td bgcolor="' . $bgcolour . '"  align="right" style="border-bottom: solid 1px #F5F5F5">';
    echo '<img border="0" src="images/telefoon.jpg">'. '  ';
    echo $rija["CONTACT_PHONE"];
    echo '</td>';

         //tussenkolom
    echo '<td bgcolor="#ECE9D8" style="border-bottom: solid 1px #F5F5F5"></td>';

    echo '<td bgcolor="' . $bgcolour . '"  align="right" style="border-bottom: solid 1px #F5F5F5">';
    echo '<img border="0" src="images/mobile.jpg">'. '  ';
    echo $rija["CONTACT_MOBILENUMBER"];
    echo '</td>';

         //tussenkolom
    echo '<td bgcolor="#ECE9D8" style="border-bottom: solid 1px #F5F5F5"></td>';

    echo '<td bgcolor="' . $bgcolour . '"  align="right" style="border-bottom: solid 1px #F5F5F5">';
    echo '<img border="0" src="images/b_mail.png">'. '  ';
    echo '<a href="mailto:';
    echo $rija["CONTACT_EMAIL"];
    echo '">';
    echo $rija["CONTACT_EMAIL"];
    echo '</a>';
    echo '</td>';

         //eindkolom
    echo '<td bgcolor="#ECE9D8" style="border-bottom: solid 1px #F5F5F5"></td>';

    echo '</tr>'; // einde rij contacten

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

    echo '</tr>'; // einde rij
// Resultaatset vrijgeven:
mysqli_free_result($contact);

// Databaseverbinding sluiten:
mysqli_close($connect);

// Einde van de tabel en de webpagina:
echo "</table>\n";

?>
