<?php
/*
 * Het is de bedoeling dat hier alle controle's op invoer gaan plaatsvinden
 */

function noSpace_text($text = '') {
	$text = trim($text);
	// Haalt links en recht eventueel whitespace karakters weg
	return htmlspecialchars($text);
	// Alle html code wordt effectief zo opgeslagen.
}

global $ERRORS;
// array nog declareren
// Globale Array met foutmeldingen

$ERRORS['GEEN_VOORNAAM'] = "Het invullen van je Voornaam is verplicht, of u hebt een ongeldige voornaam opgegeven";
$ERRORS['GEEN_NAAM'] = "Het invullen van je familienaam is verplicht, of u hebt een ongeldige naam opgegeven";
$ERRORS['GEEN_STRAAT'] = "Het invullen van je Straat is verplicht, of u hebt een ongeldige Straatnaam opgegeven";
$ERRORS['GEEN_HUISNUMMER'] = "Het invullen van je HuisNummer is verplicht, of u hebt een ongeldig huisNummer opgegeven";
$ERRORS['GEEN_POSTCODE'] = "Het invullen van je postcode is verplicht, of u hebt een ongeldig postcode opgegeven";

$ERRORS['VERKEERDE_MAIL'] = "Gelieve u Email adres Juist of niet in te vullen";

function invul_controle($waarde) {
	if (empty($waarde)) {
		return false;
	} else {
		return true;
	}

}

function email_controle($Email) {

	if (!preg_match("/^[A-Za-z0-9._\-]+\@[A-Za-z0-9._\-]+\.[A-Za-z]{2,4}$/", $Email)) {
		return false;
	} else {
		return true;

	}
}

function OpvragenID($vNaam, $aNaam) {
	if ($stmt = $mysqli -> prepare("SELECT `ID` FROM `alleleden` WHERE Voornaam=? AND Achternaam=? LIMIT 0 , 30")) {
		$stmt -> bind_param("ss", $vNaam, $aNaam);
		$stmt -> execute();
		$stmt -> bind_result($ID);
		$result = $stmt -> fetch();
		
		return $result;
		
		$stmt -> close();
		$mysqli -> close();

	} else {
		/* ERROR */
		printf("Prepared Statement Error: %s\n", $mysqli -> error);
	}

}

function BestaatAl($vNaam, $aNaam) {
	if ($stmt = $mysqli -> prepare("SELECT 'Voornaam', 'Vander Elst' FROM `alleleden` WHERE Voornaam=? AND Achternaam=? LIMIT 0 , 30")) {
		$stmt -> bind_param("ss", $vNaam, $aNaam);
		$stmt -> execute();
		$stmt -> bind_result($Bestaat);
		$result = $stmt -> fetch();
		//$result = $_STATEMENT->fetch();
		printf("%s is de id van,  %s\n", $Bestaat, $vNaam);

		return $result;

		$stmt -> close();
		$mysqli -> close();

	} else {
		/* ERROR */
		printf("Prepared Statement Error: %s\n", $mysqli -> error);
	}

}
?>
