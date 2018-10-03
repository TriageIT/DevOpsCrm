<?php
session_start ();

if( isset( $_POST['username'], $_POST['password'] ) )
{

$username  = $_POST['username'];
$password = md5($_POST['password']);

$query = "SELECT * FROM employee WHERE EMPL_USERID = '$username';";

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

$empluserid = $rij['EMPL_USERID'];
$emplid = $rij['EMPL_ID'];
$emplstatus = $rij['EMPL_STATUS'];
$emplenddate = $rij['EMPL_END_DATE'];
$emplstartdate = $rij['EMPL_START_DATE'];
$emplpassword = $rij['EMPL_PASSWORD'];
$fkfunctionid = $rij['FK_FUNCTION_ID'];
$empladmin = $rij['EMPL_ADMIN'];
$emplzzp = $rij['EMPL_ZZP'];

}

//Datum opbouwen
$ditjaar = date('Y');
$dezemaand = date('m');
$dezedag = date('d');

//$date = $dezemaand.'-'.$dezedag.'-'.$ditjaar;
$datumnumeriek = $ditjaar.$dezemaand.$dezedag;
$datumstreep = $ditjaar.'-'.$dezemaand.'-'.$dezedag;


//controleer de gebruikersnaam

if (!$empluserid == $username)
{
echo 'Foute inlognaam';


}

elseif ($empluserid == $username)
{

//controleer bijbehorend password

if ($emplpassword != $password)
   {
   echo 'effe een fout password';
   }

elseif  ($emplpassword == $password){

// Bekijk of de persoon nog actief is

if ($emplstatus != 'A' )
{
echo 'jij bent niet actief';
}

elseif ($emplstatus == 'A' ) {
// geef de gebruikersnaam als variabele door
$_SESSION['userinfo'] = $username;

// Login in history
$queryhistory = "INSERT INTO `history_login` ( `LOGIN_ID` , `FK_FUNCTION_ID`, `LOGIN_DATE` , `LOGIN_TIME` , `FK_EMPL_ID` )  VALUES (NULL , '$fkfunctionid',  '$datumstreep', CURTIME( ) , '$emplid');";

// Query uitvoeren en een resultaatset opslaan:
$loghistory = mysql_query($queryhistory) or trigger_error( mysql_error() );


header("Location: http://" . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . "/crmadmin.php");



exit;
     }
   }
  }
 }


?>
<head>
<SCRIPT LANGUAGE="JavaScript">

<!-- This script and many more are available free online at -->
<!-- The JavaScript Source!! http://javascript.internet.com -->
<!-- John Munn  (jrmunn@home.com) -->

<!-- Begin
 function putFocus(formInst, elementInst) {
  if (document.forms.length > 0) {
   document.forms[formInst].elements[elementInst].focus();
  }
 }
// The second number in the "onLoad" command in the body
// tag determines the form's focus. Counting starts with '0'
//  End -->
</script>
</head>

<BODY onLoad="putFocus(0,0);">

<table border="0" height="100%" cellpadding="0" cellspacing="0" style="border-collapse: collapse" width="100%">
  <tr>
    <td >&nbsp;</td>
    <td width="33%">&nbsp;</td>
    <td >&nbsp;</td>
  </tr>
  <tr width="33%">
    <td>&nbsp;</td>
    <td width="33%"><form action="login.php" method="post">
<table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" width="100%">
  <tr>
      <td width="33%" align="right" rowspan="3">
      <p align="center">
      <img border="0" src="images/triage.JPG" width="54" height="69"></td>
    <td width="33%" align="right">Username&nbsp;&nbsp;&nbsp; </td>
    <td width="33%"> <input type="text" id="username" name="username" size="20"></td>
  </tr>
  <tr>
    <td width="33%" align="right">Wachtwoord&nbsp;&nbsp;&nbsp; </td>
    <td width="33%"> <input type="password" id="password" name="password" size="20"></td>
  </tr>
  <tr>
    <td width="33%">&nbsp;</td>
    <td width="33%">
    <input type="submit" id="submit" value="Log in !"></td>
  </tr>
</table>
</form></td>
    <td >&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
     <td width="33%">&nbsp;</td>
    <td>&nbsp;</td>
   </tr>
</table>

</body>

</html>
