<?php
include_once ($_SERVER["DOCUMENT_ROOT"] . '/share/work/1/config/config.php');
include ('lijst_controle.php');
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />

		<!-- Always force latest IE rendering engine (even in intranet) & Chrome Frame
		Remove this if you use the .htaccess -->
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta name="description" content="confirmation" />
		<meta name="author" content="RHINO" />
		<meta name="viewport" content="width=device-width; initial-scale=1.0" />

		<title>Registratie voltooid</title>
		<link rel="stylesheet" type="text/css" href="/share/work/1/config/stijl.css">
	</head>
	<body>
		<img src="animoLogo.jpg" />

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
			//Conbtrole op invoer Naam
			if (!invul_controle($_POST[vNaam])) {
				$foutenlijst[] = $ERRORS['GEEN_VOORNAAM'];
			}
			//Conbtrole op invoer AchterNaam
			if (!invul_controle($_POST[aNaam])) {
				$foutenlijst[] = $ERRORS['GEEN_NAAM'];
			}
			//Conbtrole op invoer straat
			if (!invul_controle($_POST[straat])) {
				$foutenlijst[] = $ERRORS['GEEN_STRAAT'];
			}
			//controle op invoer huisnummer
			if (!invul_controle($_POST[huisnummer])) {
				$foutenlijst[] = $ERRORS['GEEN_HUISNUMMER'];
			}
			//controle op postcode
			if (!invul_controle($_POST[postcode])) {
				$foutenlijst[] = $ERRORS['GEEN_POSTCODE'];
			}
			//Controle op  ingevulde email:
			if (!empty($_POST[Email])) {
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
				echo " <h1> <a href=\"javascript:history.go(-1);\">Terug</a>\n </h1>";
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
					echo "<h2> Proficiat {$vNaam}. <br/>Uw lidmaatschap voor 2013 is voltooid, uw ID is : </h2>";

					if ($stmt = $mysqli -> prepare("SELECT `ID` FROM `alleleden` WHERE Voornaam=? AND Achternaam=? LIMIT 0 , 30")) {
						$stmt -> bind_param("ss", $vNaam, $aNaam);
						$stmt -> execute();
						$stmt -> bind_result($ID);
						$result = $stmt -> fetch();
						printf("<h1><u>%s</u></h1>", $ID);

						echo "<h3> Bent u op een smartphone? >> toon deze pagina aan de kassa </h3>";
					echo "<br/> <br/> <h3> <a href=\"index.php\">Nieuw lid</a></h3>";

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
	</body>
</html>