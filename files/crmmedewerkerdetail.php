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

if ($empladmin != 'Y'){
header("Location: http://" . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . "/crmadmin.php");
exit;

}
$functionname ='';
$fkcontractid ='';

if (isset($_GET['EMPL_ID'])) {
    $emplid = $_GET['EMPL_ID'];


$sql  = "SELECT * FROM employee WHERE EMPL_ID ='$emplid' ;";     // waar de EMPL_ID gelijk is aan de import EMPL_ID


// Query uitvoeren en een resultaatset opslaan:
$resultaat = mysql_query($sql);

while ($rij = mysql_fetch_assoc($resultaat)) {


// Alleen de attributen ophalen die getoond worden op het scherm.
// Maak old_ variabele als gecontroleerd moet worden of deze veranderd is of niet.
// Reden is de verwerking vanwege het drukken op OKay
$empluseridorg = $rij['EMPL_USERID'];
$oldemplfirstname = $rij['EMPL_FIRSTNAME'];
$oldempllastname = $rij['EMPL_LASTNAME'];
$oldemplmail = $rij['EMPL_MAIL'];
$oldemplphone = $rij['EMPL_PHONE'];
$oldempladmin = $rij['EMPL_ADMIN'];
$emplzzp = $rij['EMPL_ZZP'];
$oldemplnumberofholidays = $rij['EMPL_NUMBER_HOLIDAYS'];
$emplstatus = $rij['EMPL_STATUS'];
$oldemplnotes = $rij['EMPL_NOTES'];
$oldemplprofile = $rij['EMPL_PROFILE'];
$fkfunctionid = $rij['FK_FUNCTION_ID'];
$oldemplstartdate = $rij['EMPL_START_DATE'];
$emplcreator = $rij['EMPL_CREATOR'];
$emplowner = $rij['EMPL_OWNER'];
$oldmaxnumberdays = $rij['MAX_NUMBER_DAYS'];
$oldmaxnumberhours = $rij['MAX_NUMBER_HOURS'];


$sql = "SELECT * FROM contract WHERE CONTRACT_ID ='$fkcontractid'";         // waar de contract gelijk is aan de import


$query = mysql_query($sql);

while( $uitvoer = mysql_fetch_assoc( $query ) )
   {
   $fkcompanyid = $uitvoer['FK_COMPANY_ID'];
   $contractname = $uitvoer['CONTRACT_NAME'];
   }



// naam creator opzoeken
$sqlcreator = "SELECT * FROM employee WHERE EMPL_ID ='$emplcreator' ;";     // waar de USERID gelijk is aan de inlognaam van de sessie

$resultcreator = mysql_query ($sqlcreator);

while ($rijcreator = mysql_fetch_assoc($resultcreator)) {

$creatorlastname = $rijcreator['EMPL_LASTNAME'];
$creatorfirstname = $rijcreator['EMPL_FIRSTNAME'];
}

// naam eigenaar opzoeken
$sqlowner = "SELECT * FROM employee WHERE EMPL_ID ='$emplowner' ;";     // waar de USERID gelijk is aan de inlognaam van de sessie

$resultowner = mysql_query ($sqlowner);

while ($rijowner = mysql_fetch_assoc($resultowner)) {

$ownerlastname = $rijowner['EMPL_LASTNAME'];
$ownerfirstname = $rijowner['EMPL_FIRSTNAME'];
}

$sqlfunc  = "SELECT * FROM emp_function WHERE  FUNCTION_ID ='$fkfunctionid' ;";     // Vraag de desbetreffende functie aan

$resultfunctie = mysql_query($sqlfunc);

while ($rijfunc = mysql_fetch_assoc($resultfunctie)){
$functionname = $rijfunc["FUNCTION_NAME"];

}

}

} else {

if (isset($_POST['submit'])) {

$emplid = $_POST['EMPL_ID'];
$empluserid = $_POST['EMPL_USERID'];
$empluseridorg = $_POST['EMPL_USERID_ORG'];
$emplfirstname = $_POST['EMPL_FIRSTNAME'];
$oldemplfirstname = $_POST['OLD_EMPL_FIRSTNAME'];
$empllastname = $_POST['EMPL_LASTNAME'];
$oldempllastname = $_POST['OLD_EMPL_LASTNAME'];
$emplmail = $_POST['EMPL_MAIL'];
$oldemplmail = $_POST['OLD_EMPL_MAIL'];
$emplphone = $_POST['EMPL_PHONE'];
$oldemplphone = $_POST['OLD_EMPL_PHONE'];

$emplzzp = $_POST['EMPL_ZZP'];
$oldemplzzp = $_POST['OLD_EMPL_ZZP'];
$emplnumberofholidays = $_POST['EMPL_NUMBER_OF_HOLIDAYS'];
$oldemplnumberofholidays = $_POST['OLD_EMPL_NUMBER_OF_HOLIDAYS'];
$emplnotes = $_POST['EMPL_NOTES'];
$oldemplnotes = $_POST['OLD_EMPL_NOTES'];
$emplprofile = $_POST['EMPL_PROFILE'];
$oldemplprofile = $_POST['OLD_EMPL_PROFILE'];
$maxnumberdays = $_POST['MAX_NUMBER_DAYS'];
$maxnumberhours = $_POST['MAX_NUMBER_HOURS'];
$oldmaxnumberdays = $_POST['OLD_MAX_NUMBER_DAYS'];
$oldmaxnumberhours = $_POST['OLD_MAX_NUMBER_HOURS'];
$emplstartdate = $_POST['EMPL_START_DATE'];
$oldemplstartdate = $_POST['OLD_EMPL_START_DATE'];


    if ($_POST['submit'] == "Okay") {

// Databaseverbinding openen en query uitvoeren:

// Constanten voor mysql_connect() insluiten:
require_once('../../triageinc/mysql_connect.inc.php');
require_once('../../triageinc/mysql_dbase.inc.php');

// Databaseverbinding openen met mysql_connect():
$verbinding = mysql_connect(MYSQL_SERVER, MYSQL_GEBRUIKERSNAAM, MYSQL_WACHTWOORD) or die("Verbinding mislukt: " . mysql_error());

// Database 'crm' selecteren:
mysql_select_db($dbase) or die("Kon de database niet openen: " . mysql_error());



if ($emplzzp== 'on')
{$emplzzp = 'Y';}
elseif ($emplzzp== NULL) {

$emplzzp = 'N';
}


if ($emplstartdate != $oldemplstartdate)  {
$change = 1 ;
}

else{

if ($maxnumberdays != $oldmaxnumberdays)  {
$change = 1 ;
}

else{
if ($maxnumberhours != $oldmaxnumberhours)  {
$change = 1 ;
}

else{
if ($emplnumberofholidays != $oldemplnumberofholidays)  {
$change = 1 ;
}

else{

if ($emplzzp != $oldemplzzp)  {
$change = 1 ;
}

else{



if ($emplfirstname != $oldemplfirstname)  {
$change = 1 ;
}

else {
if ($empllastname != $oldempllastname)  {
$change = 1 ;
}

else {

if ( $emplphone != $oldemplphone )  {
$change = 1  ;

}

else {

if ($oldemplmail != $emplmail)  {
$change = 1 ;
}

else {

if  ($oldemplnotes != $emplnotes)  {
$change = 1 ;
}
else {
 $change = 0 ;
 }
    }
   }
 }
}
}
}
}
}
}

if ($empluserid != $empluseridorg){
//mailtje versturen


$mailto = $emplmail;
$mailsubj = "Inlog gegevens urenregistratiesysteem";
$mailhead = "From: info@triage-it.nl \n";
$mailbody = " Hoi $emplfirstname
Hierbij de mededeling dat je kunt inloggen in ons urenregistratiesysteem.
Je kunt deze vinden op http://www.triage-it.nl/time/login.php

Jouw userid is $empluserid en je password is test123.
Deze laatste moet je na aanloggen direct veranderen.


Groeten,

Triage


";

mail($mailto, $mailsubj, $mailbody, $mailhead);
          }
// creator, owner start en einddatums zijn niet interessant voor deze detail verwerking

//Even uppercase maken
$emplid = strtoupper ($emplid);
$emplprivatezipcode = strtoupper ($emplprivatezipcode);
$emplmail = strtoupper ($emplmail);

// MSSQL-updatequery opstellen:

$sqld  = "UPDATE employee SET EMPL_START_DATE= '$emplstartdate', EMPL_FIRSTNAME = '$emplfirstname', EMPL_USERID = '$empluserid', EMPL_LASTNAME = '$empllastname', EMPL_MAIL = '$emplmail' , EMPL_PHONE = '$emplphone' , EMPL_ZZP = '$emplzzp', `EMPL_NUMBER_HOLIDAYS` = '$emplnumberofholidays', EMPL_NOTES = '$emplnotes' , EMPL_PROFILE = '$emplprofile', MAX_NUMBER_DAYS = '$maxnumberdays', MAX_NUMBER_HOURS = '$maxnumberhours' WHERE EMPL_ID ='$emplid';";



$update = mysql_query($sqld);


if ( $change == 0 ) {

header("Location: http://" . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . "/crmmedewerkerlijst.php");
                exit;

                }
else  {


$sqli  = "INSERT INTO history_employee (`EMPL_ID`, `EMPL_ACTION`, `EMPL_FIRSTNAME`, `EMPL_LASTNAME`, `EMPL_MAIL`, `EMPL_PHONE`, `EMPL_ADMIN`, `EMPL_ZZP`, `EMPL_NUMBER_HOLIDAYS`, `EMPL_STATUS`, `EMPL_NOTES`, `EMPL_PROFILE`, `FK_FUNCTION_ID`, `EMPL_START_DATE`, `EMPL_END_DATE`, `MAX_NUMBER_DAYS`, `MAX_NUMBER_HOURS`,`EMPL_LOG_DATE`,  `HISTORY_CREATOR`) VALUES ('$emplid', 'Update', '$oldemplfirstname', '$oldempllastname', '$oldemplmail', '$oldemplphone',  '$empladmin', '$oldemplzzp','$oldemplnumberofholidays', 'A', '$oldemplnotes', '$emplprofile', 0, '$emplstartdate', NULL, '$oldmaxnumberdays', '$oldmaxnumberhours', '$datumstreep', $inlogid);";

// vul history
$insert = mysql_query($sqli);


header("Location: http://" . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . "/crmmedewerkerlijst.php");

exit;

            }
             }

    if ($_POST['submit'] == "password") {

$sqlupdate = "UPDATE `employee` SET `EMPL_PASSWORD` = 'cc03e747a6afbbcbf8be7668acfebee5' WHERE `EMPL_ID` = '$emplid' LIMIT 1 ;";

$update = mysql_query($sqlupdate);

header("Location: http://" . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . "/crmmedewerkerdetail.php?EMPL_ID=" . $emplid );

}
    if ($_POST['submit'] == "admin") {

$sqlupdate = "UPDATE `employee` SET `EMPL_ADMIN` = 'Y' WHERE `EMPL_ID` = '$emplid' LIMIT 1 ;";

$sqli  = "INSERT INTO history_employee (`EMPL_ID`, `EMPL_ACTION`, `EMPL_ADMIN`, `EMPL_LOG_DATE`,  `HISTORY_CREATOR`) VALUES ('$emplid', 'Admin', '$datumstreep', $inlogid);";


$update = mysql_query($sqlupdate);
$history = mysql_query($sqli);

header("Location: http://" . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . "/crmmedewerkerdetail.php?EMPL_ID=" . $emplid );

}

    if ($_POST['submit'] == "Annuleren") {

header("Location: http://" . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . "/crmmedewerkerlijst.php");

}

    if ($_POST['submit'] == "Kalender") {

$sqlprof  = "INSERT INTO profile (FK_EMPL_ID, MONDAY_HOURS, TUESDAY_HOURS, WEDNESDAY_HOURS, THURSDAY_HOURS, FRIDAY_HOURS) VALUES ('$emplid', '0', '0', '0', '0', '0'); ";



// Query uitvoeren en een resultaatset opslaan:
$prof = mysql_query($sqlprof);

		if ($prof) {
header("Location: http://" . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . "/crmmedewerkerdetail.php?EMPL_ID=" . $emplid );
}
}

    if ($_POST['submit'] == "Profiel") {

$mondayhours = $_POST["MONDAY_HOURS"];
$tuesdayhours = $_POST["TUESDAY_HOURS"];
$wednesdayhours = $_POST["WEDNESDAY_HOURS"];
$thursdayhours = $_POST["THURSDAY_HOURS"];
$fridayhours = $_POST["FRIDAY_HOURS"];

$sqlprof  = "UPDATE `profile` SET `MONDAY_HOURS` = '$mondayhours' ,`TUESDAY_HOURS` = '$tuesdayhours', `WEDNESDAY_HOURS`  = '$wednesdayhours' , `THURSDAY_HOURS` = '$thursdayhours', `FRIDAY_HOURS` = '$fridayhours' WHERE `FK_EMPL_ID` = '$emplid' LIMIT 1 ;";

// Query uitvoeren en een resultaatset opslaan:
$prof = mysql_query($sqlprof);

		if ($prof) {
header("Location: http://" . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . "/crmmedewerkerdetail.php?EMPL_ID=" . $emplid );
}
}

}


}
// Webpagina weergeven:
?>

<html>
<head>
<title>Medewerker <?php echo $oldemplfirstname.' '. $oldempllastname; ?></title>
 <link rel="stylesheet" type="text/css" href="main.css" />
</head>

<table border="0" width="100%" id="table1">
	<tr>
		<td colspan="2"><h1><a href="crmmedewerkerlijst.php"><img border="0" src="images/medewerker_groot.png" width="72" height="72"></a>   Medewerker details  <font color="#800000"><?php echo $oldemplfirstname; ?></font> </h1></td>
		<td rowspan="2">
		<p align="center">
		<a target="_self" href="crmadmin.php">
		<img border="0" src="images/triage.png" ></a></td>
		<td><a target="_self" href="logout.php">log-out</a></td>
		<td><?php echo $inlognaam; ?></td>
	</tr>

</table>
<table border="0" align="center"  width="100%" id="details">
	<tr>
  		<td width="25%" align="center" bordercolor="#800080" style="border-style: dashed; border-width: 1px">
        <?php
        echo '<a href="crmmedewerkerdetail.php?EMPL_ID=' . $emplid . '">';
         echo 'details';
         echo '</a>';
         ?></td>
		<td width="25%" align="center" bordercolor="#800080" style="border-style: dashed; border-width: 1px">

      <?php
    echo '<a href="crmmedewerkerhistory.php?EMPL_ID=' . $emplid . '">';
    echo '<img border="0" src="images/history.JPG" width="24" height="22" > - Verleden  ';
    echo '</a>';

    ?>
              </td>
        <td width="25%" align="center" bordercolor="#800080" style="border-style: dashed; border-width: 1px">
        <?php
    echo '<a href="crmmedewerkerprive.php?EMPL_ID=' . $emplid . '">';
    echo 'Priv�  ';
    echo '</a>';

    ?>

              </td>
        <td width="25%" align="center" bordercolor="#800080" style="border-style: dashed; border-width: 1px">
         <?php
    echo '<a href="crmmedewerkercontract.php?EMPL_ID=' . $emplid . '">';
    echo '<img border="0" src="images/triage_small.png">';
    echo 'Huidig contract  ';
    echo '</a>';

    ?>
        </td>
	</tr>
</table>

<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">

<table border="0" align="center" >
	<tr>
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
      	<td>User ID</td>
      	<td colspan="3">
      	<input type="hidden" name="EMPL_USERID_ORG" size="8" value="<?php echo $empluseridorg;?>">
		<input type="text" name="EMPL_USERID" size="8" value="<?php echo $empluseridorg;?>"> Admin&nbsp;
			<input type="checkbox" name="EMPL_ADMIN" size="1"
            <?php
			if ($oldempladmin == 'Y'){
              echo 'checked';
            }
            ?>

             disabled="true"

            >
            ZZP&nbsp;
			<input type="checkbox" name="EMPL_ZZP" size="1"
            <?php
			if ($emplzzp == 'Y'){
              echo 'checked';
            }
            ?>



            >
        <input type="hidden" name="OLD_EMPL_ZZP" size="1" value="<?php echo $emplzzp;?>">
        <input type="hidden" name="EMPL_ID" size="8" value="<?php echo $emplid;?>"></td>
      	<td>
      	<input class="knop" name="submit" type="submit" value="admin">
		<input class="knop" name="submit" type="submit" value="password"> </td>
      	<td>
		&nbsp;</td>
  	</tr>
	<tr>
      	<td>Voornaam</td>
      	<td colspan="3">

		<input type="text" name="EMPL_FIRSTNAME" size="30" value="<?php echo $oldemplfirstname;?>">
        <input type="hidden" name="OLD_EMPL_FIRSTNAME" size="30" value="<?php echo $oldemplfirstname;?>"> </td>
      	<td>
		</td>
      	<td>
		&nbsp;</td>
  	</tr>
	<tr>
      	<td>Achternaam</td>
      	<td colspan="3">
        <input type="text" name="EMPL_LASTNAME" size="30" value="<?php echo $oldempllastname;?>">
		<input type="hidden" name="OLD_EMPL_LASTNAME" size="30" value="<?php echo $oldempllastname;?>"> </td>
      	<td>
		</td>
      	<td>
		&nbsp;</td>
  	</tr>
      <tr>
      	<td>Mail</td>
      	<td colspan="3">
		<input type="text" name="EMPL_MAIL" size="45" value="<?php echo $oldemplmail;?>">
        <input type="hidden" name="OLD_EMPL_MAIL" size="45" value="<?php echo $oldemplmail;?>"></td>
      	<td>
		&nbsp;</td>
      	<td>
		&nbsp;</td>
       </td>
  	</tr>
	<tr>
      	<td>Telefoon</td>
      	<td>
          <input type="text" name="EMPL_PHONE" size="15" value="<?php echo $oldemplphone;?>">
          <input type="hidden" name="OLD_EMPL_PHONE" size="15" value="<?php echo $oldemplphone;?>"></td>
      	<td>
          </td>
      	<td>
			</td>
      	<td>
      	&nbsp;</td>
      	<td>
          &nbsp;</td>
  	</tr>
	<tr>
      	<td>Startdatum</td>
      	<td>
          <input type="text" name="EMPL_START_DATE" size="8" value="<?php echo $oldemplstartdate;?>">
          </td>
      	<td><input type="hidden" name="OLD_EMPL_START_DATE" value="<?php echo $oldemplstartdate;?>">
          </td>
      	<td>
			</td>
      	<td>
      	&nbsp;</td>
      	<td>
          &nbsp;</td>
  	</tr>

    		<tr>
		<td>Notities</td>
	      <td rowspan="4" colspan="3">
			<textarea rows="7" cols="50" name="EMPL_NOTES" ><?php echo $oldemplnotes;?></textarea>
            <input type="hidden" name="OLD_EMPL_NOTES" value="<?php echo $oldemplnotes;?>">&nbsp; </td>
	      <td rowspan="4">&nbsp;</td>
	      <td rowspan="4">&nbsp;</td>
    	</tr>
    	<tr>
		<td></td>
		<td></td>
    	</tr>
    	    	<tr>
		<td></td>
		<td></td>
    	</tr>
            	    	<tr>
		<td></td>
		<td></td>
    	</tr>
     <tr>
		<td>Functie</td>
        <td align="left" nowrap colspan="3">
        <?php
echo $functionname.'  ';
echo '<a href="crmfunctieselect.php?EMPL_ID=' . $emplid . '&ROUTE=2">';
echo '<img border="0" src="images/functie_select.png"  width="47" height="47"  >';
echo '</a>';
?>


<input type="hidden" name="OLD_EMPL_NUMBER_OF_HOLIDAYS" size="2" value="<?php echo $oldemplnumberofholidays;?>">
Aantal vakantiedagen   <input type="text" name="EMPL_NUMBER_OF_HOLIDAYS" size="2" value="<?php echo $oldemplnumberofholidays;?>">
<a href="crmvakantiemedewerker.php?EMPL_ID=<?php echo $emplid;?>"><img border="0" src="images/vakantie_klein.png"></a></td>
    	</tr>
	<tr>
		<td>Creator</td>
   		<td><input type="hidden" name="EMPL_CREATOR" size="1" value="<?php echo $emplcreator;?>">
           <?php
           echo $creatorfirstname.' '.$creatorlastname ;
           ?></td>
   	</tr>
   		<tr>
		<td>Owner</td>
   		<td><input type="hidden" name="EMPL_OWNER" size="1" value="<?php echo $emplowner;?>">
           <?php
           echo $ownerfirstname.' '.$ownerlastname ;
           ?></td>
   	</tr>
    	<tr>
		<td></td>
		<td></td>
    	</tr>
	<tr>
      	<td><h1>Wensen</h1></td>
      	<td >
        </td>
      	<td>
		</td>
      	<td>
		&nbsp;</td>
  	</tr>
	<tr>
      	<td>Aantal dagen contract(max)</td>
      	<td colspan="3">
        <input type="hidden" name="OLD_MAX_NUMBER_DAYS" size="2" value="<?php echo $oldmaxnumberdays;?>">
		<input type="text" name="MAX_NUMBER_DAYS" size="2" value="<?php echo $oldmaxnumberdays;?>"> </td>
      	<td>
		</td>
      	<td>
		&nbsp;</td>
  	</tr>
	<tr>
      	<td>Aantal uren contract(max)</td>
      	<td colspan="3">
        <input type="hidden" name="OLD_MAX_NUMBER_HOURS" size="2" value="<?php echo $oldmaxnumberhours;?>">
		<input type="text" name="MAX_NUMBER_HOURS" size="2" value="<?php echo $oldmaxnumberhours;?>"> </td>
      	<td>
		</td>
      	<td>
		&nbsp;</td>
  	</tr>
  </table>
<h1>Profiel</h1>

<?php
$sqlprof  = "SELECT * FROM profile WHERE FK_EMPL_ID = '$emplid';";

// Query uitvoeren en een resultaatset opslaan:
$prof = mysql_query($sqlprof);

$result = mysql_num_rows($prof);

if ($result == 0){

echo 'geen profiel aangemaakt';

echo '<input class="knop" name="submit" type="image" src="images/Calender_klein.jpg" value="Kalender"> - Aanmaken';
} else {
$sqlprof  = "SELECT * FROM profile WHERE FK_EMPL_ID = '$emplid';";

// Query uitvoeren en een resultaatset opslaan:
$prof = mysql_query($sqlprof);

while ($rijprof = mysql_fetch_assoc($prof)) {

$mondayhours = $rijprof["MONDAY_HOURS"];
$tuesdayhours = $rijprof["TUESDAY_HOURS"];
$wednesdayhours = $rijprof["WEDNESDAY_HOURS"];
$thursdayhours = $rijprof["THURSDAY_HOURS"];
$fridayhours = $rijprof["FRIDAY_HOURS"];


echo '<table align="center"  border="0" cellpadding="2" cellspacing="0">';
    echo '<tr>';
    echo '<td align="center">Maandag';
    echo '</td>';
        echo '<td align="center">Dinsdag';
    echo '</td>';
        echo '<td align="center">Woensdag';
    echo '</td>';
        echo '<td align="center">Donderdag';
    echo '</td>';
        echo '<td align="center">Vrijdag';
    echo '</td>';
    echo '</tr>';
        echo '<tr>';
    echo '<td align="center">';
    echo '<input type="text" name="MONDAY_HOURS" size="1" value="' . $mondayhours . '">';
    echo '</td>';
    echo '<td align="center">';
    echo '<input type="text" name="TUESDAY_HOURS" size="1" value="' . $tuesdayhours . '">';
    echo '</td>';
    echo '<td align="center">';
    echo '<input type="text" name="WEDNESDAY_HOURS" size="1" value="' . $wednesdayhours . '">';
    echo '</td>';
    echo '<td align="center">';
    echo '<input type="text" name="THURSDAY_HOURS" size="1" value="' . $thursdayhours . '">';
    echo '</td>';
    echo '<td align="center">';
    echo '<input type="text" name="FRIDAY_HOURS" size="1" value="' . $fridayhours . '">';
    echo '</td>';
    echo '</tr>';
echo '</table>';

echo '<table border="0" align="center" >';
echo '	<tr>';
echo '		<td>';
echo '        <input class="knop" name="submit" type="image" src="images/okay_groot.jpg"  width="47" height="47" value="Profiel"> - Profiel opslaan';
echo '        </td>';
echo '		<td> ';
echo '        <input class="knop" name="submit" type="image" src="images/cancel_groot.jpg"  width="47" height="47" value="Annuleren"> - Annuleren';
echo '        </td>';
echo '	</tr>';
echo '</table>';

}


}


?>


</form>
