<!DOCTYPE html>
<html>
	<head>
		<title>Nieuw Lid</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<!-- Bootstrap -->
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link href="css/bootstrap-responsive.css" rel="stylesheet" media="screen">
	</head>
	<body>

		<img src="img/antransp.png" width= '25%' height='25%' />
		<script src="http://code.jquery.com/jquery.js"></script>
		<script src="js/bootstrap.min.js"></script>

		<div class="container-fluid">
			<div class="row-fluid">
				<h3>Lidkaart</h3>
				
			</div>
			
			<form action="lijst.php" method="post">

				<div class="row-fluid">
					<div class="span2">
						<label>Voornaam: </label>
						<input class="input-medium" type="text" name="vNaam" />
					</div>
					<div class="span2">
						<label>Achternaam: </label>
						<input class="input-medium" type="text" name="aNaam" />
					</div>
				</div>

				<div class="row-fluid">
					<div class="span2">
						<label>Straat: </label>
						<input class="input-medium" type="text" name="straat" />
					</div>
					<div class="span1">
						<label>Nummer: </label>
						<input class="input-mini" type="text"  name="huisnummer" />
					</div>
					<div class="span1">
						<label>Bus: </label>
						<input class="input-mini" type="text"  name="bus" />
					</div>
				</div>

				<div class="row-fluid">
					<div class="span2">
						<label>Postcode: </label>
						<input class="input-mini" type="text"   maxlength="4" name="postcode" />
					</div>

				</div>
				<div class="row-fluid">
					<div class="span2">
						<label>Email: </label>
						<input class="input-medium" type="text" name="Email" />
					</div>
					<div class="span2">
						<label>Ik wil medewerker worden:</label></td><td>
						<input type="checkbox" value="1" name="medewerker" />
					</div>
				</div>

				<div class="row-fluid">
					<div class="span2">
						<label>Geboortejaar: </label></td><td>
						<select class="input-small" name="geboorteJaar">
							<?php
							for ($i = 1960; $i <= date('Y'); $i++) {
								echo '<option value="' . $i . '">' . $i . '</option>';
							}
							?>
						</select>
					</div>
				</div>

				<div class="row-fluid">
					<div class="span2">
						<input type="reset" value="Reset" name="reset" />
					</div>
					<div class="span2">
						<input class="btn btn-primary" type="submit" value="VERZEND" name="submit"/>
					</div>
				</div>
				
		
		</form>
		</div>

	</body>
</html>