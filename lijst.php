<?php
include_once ($_SERVER["DOCUMENT_ROOT"] . '/share/work/1/config/config.php');
include ('lijst_controle.php');
?>
 <!DOCTYPE html>
<html>
 <head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
  <link href="css/bootstrap-responsive.min.css" rel="stylesheet" media="screen">
  <link href="css/style.css" rel="stylesheet" media="screen">
  <script src="http://code.jquery.com/jquery.js"></script>
  <script src="js/bootstrap.min.js"></script>
 </head>
 <body>
  <!-- start rij 1 -->
  <div class="row-fluid">
   <div class="span12 header">
   	<img src="img/antransp.png" width="25%" height="25%" />
   </div>
  </div>
  
  <!-- start rij 2 -->
  <div class="row-fluid">
   <div class="span12 content">
   <?php
   $mysqli = new mysqli($host, $user, $password, $database);
   if (mysqli_connect_errno()) {
				printf("Connect failed: %s\n" . mysqli_connect_errno());
				exit();
   } else {
   //echo "DB connected <br />";
   /**
   * Hier gaan we controle voeren op het feit als er wel (juiste) invoer is geweest in de kottekes
   */
   
   $foutenlijst = array();
   // de gewenste formuliervelden langslopen:
   if (!invul_controle($_POST[vNaam])) $foutenlijst[] = $ERRORS['GEEN_VOORNAAM']; //Controle op invoer Naam
   if (!invul_controle($_POST[aNaam])) $foutenlijst[] = $ERRORS['GEEN_NAAM']; //Controle op invoer AchterNaam
   if (!invul_controle($_POST[straat])) $foutenlijst[] = $ERRORS['GEEN_STRAAT']; //Controle op invoer straat
   if (!invul_controle($_POST[huisnummer])) $foutenlijst[] = $ERRORS['GEEN_HUISNUMMER']; //controle op invoer huisnummer
   if (!invul_controle($_POST[postcode])) $foutenlijst[] = $ERRORS['GEEN_POSTCODE']; //controle op postcode
   if (!empty($_POST[Email])) { //Controle op  ingevulde email:
   	if (!email_controle($_POST[Email])) {
   		$foutenlijst[] = $ERRORS['VERKEERDE_MAIL']; 
   	}
   }
   //Fouten opgetreden: Deze naar het scherm schrijven.
   if (!empty($foutenlijst)) {
				echo "<h2> Er zijn fouten opgetreden </h2><ul>";
				foreach ($foutenlijst as $waarde) {
					echo "<li>$waarde</li>";
   	}
				echo "Vul het formulier correct in aub. <br/>";
				echo "<h1><a href=\"javascript:history.go(-1);\">Terug</a></h1>";
   } else {
   	if ($stmt = $mysqli -> prepare("INSERT INTO alleleden VALUES (null, ?, ?, ?, ?, ?, ?, ?, ?, ?)")) {
					$stmt -> bind_param('sssssisii', $vNaam, $aNaam, $straat, $huisnummer, $bus, $postcode, $email, $medewerker, $jaar);
					
					noSpace_text($vNaam = $_POST['vNaam']);
					noSpace_text($aNaam = $_POST['aNaam']);
					noSpace_text($straat = $_POST['straat']);
					noSpace_text($huisnummer = $_POST['huisnummer']);
					noSpace_text($bus = $_POST['bus']);
					noSpace_text($postcode = $_POST['postcode']);
					noSpace_text($land = $_POST['land']);
					noSpace_text($email = $_POST['Email']);
					$medewerker = $_POST['medewerker'];
					noSpace_text($jaar = $_POST['geboorteJaar']);
					
					$stmt -> execute();
					printf($mysqli -> error);
					$stmt -> close();
					
					//echo "<br/>Inserted {$vNaam},{$aNaam} into database\n";
					//echo "<h2> Proficiat {$vNaam}. <br/>Uw lidmaatschap voor 2013 is voltooid, uw ID is : </h2>";
					echo "<h2>Bedankt {$vNaam}.</h2><p>We hebben je gegevens goed ontvangen, je ID is : </p>";
					
					if ($stmt = $mysqli -> prepare("SELECT `ID` FROM `alleleden` WHERE Voornaam=? AND Achternaam=? LIMIT 0 , 30")) {
						$stmt -> bind_param("ss", $vNaam, $aNaam);
						$stmt -> execute();
						$stmt -> bind_result($ID);
						$result = $stmt -> fetch();
						printf("<h1><u>%s</u></h1>", $ID);
						
						//echo "<h3> Bent u op een smartphone? >> toon deze pagina aan de kassa </h3>";
						//echo "<br/> <br/> <h3> <a href=\"index.php\">Nieuw lid</a></h3>";
						echo "<h3>Surf je via een smartphone? Toon dan deze pagina aan de kassa </h3>";
						echo "<h3><a href=\"index.php\">Nieuw lid</a></h3>";
						
						$stmt -> close();
						$mysqli -> close();
   		} else {
						/* ERROR */
						printf("Prepared Statement Error: %s\n", $mysqli -> error);
   		}   
					} else {
						/* ERROR */
						printf("Prepared Statement Error: %s\n", $mysqli -> error);
					}
				}
			}
			?>
   </div>
  </div>
 </body>
</html>