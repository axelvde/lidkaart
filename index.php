<!DOCTYPE html>
<html>
	<head>
		<title>Nieuw Lid</title>
		<!-- Bootstrap -->
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
  <div class="row-fluid content">
  	<div class="span12">
   		<h1>Lidkaart</h1>
   </div>
  </div>
  
  <form class="form-horizontal" action="lijst.php" method="post">
  <!-- start rij 3 -->
  <div class="row-fluid content">
   
   <!-- start kol 3.1 -->
   <div class="span6">
    <div class="control-group">
     <label class="control-label" for="vNaam">Voornaam</label>
     <div class="controls">
     	<input type="text" id="vNaam" placeholder="Voornaam" name="vNaam">
     </div>
    </div>
    <div class="control-group">
     <label class="control-label" for="aNaam">Achternaam</label>
     <div class="controls">
     	<input type="text" id="aNaam" placeholder="Achternaam" name="aNaam">
     </div>
    </div>
    <div class="control-group">
     <label class="control-label" for="Email">E-mailadres</label>
     <div class="controls">
     	<input type="text" id="Email" placeholder="E-mailadres" name="Email">
     </div>
    </div>
    <div class="control-group">
    <div class="controls">
      <label class="checkbox">Ik wil medewerker worden
        <input type="checkbox" value="1" name="medewerker">
      </label>
    </div>
  	</div>
   <div class="control-group">
    <div class="controls">
      <label>Geboortejaar: 
						<select name="geboorteJaar" class="input-small">
						<?php
							for ($i = 1960; $i <= date('Y'); $i++) {
								echo '<option value="' . $i . '">' . $i . '</option>';
							}
							?>
						</select>
      </label>
    </div>
  	</div>
   </div>
   
   <!-- start kol 3.2 -->
   <div class="span6">
   	<div class="control-group">
     <label class="control-label" for="straat">Straat</label>
     <div class="controls">
     	<input type="text" id="straat" placeholder="Straat" name="straat">
     </div>
    </div>
    <div class="control-group">
     <label class="control-label" for="huisnummer">Huisnummer</label>
     <div class="controls">
     	<input type="text" id="huisnummer" placeholder="Huisnummer" name="huisnummer" class="input-small" >
     </div>
    </div>
    <div class="control-group">
     <label class="control-label" for="bus">Bus</label>
     <div class="controls">
     	<input type="text" id="bus" placeholder="Bus" name="bus" class="input-small" >
     </div>
    </div>
    <div class="control-group">
     <label class="control-label" for="postcode">Postcode</label>
     <div class="controls">
     	<input type="text" id="postcode" placeholder="Postcode" name="postcode" class="input-small" >
     </div>
    </div>
   </div>
 </div>
 
 <!-- start rij 4 -->
 <div class="row-fluid content">
 	<div class="span12">
   <input type="reset" value="Reset" name="reset" class="btn btn-large" />
   <button type="submit" class="btn btn-large btn-primary">Verzenden</button>
  </div>
 </div>
	</form>
	</body>
</html>