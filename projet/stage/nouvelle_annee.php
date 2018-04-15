<?php session_start() ?>
<?php require "header.php" ?>
<?php require 'bdd.php'; ?>

<body>
	
	<div class="container">
		<div id="content">		
			<div class="left">
				<!-- Requête NOM Prénom CLASSE BDD --> <h2>Classe - BTS1</h2>
				<h3>Historique des élèves par année</h3></br><!-- RIGHT -->

				<!-- Tableau requête BDD liste des stages -->
				<label>Année : </label><select>
				<option>2017/2016</option>	
				<option>2016/2015</option>	
				</select>
				
				
				<label>Ou nouvelle : </label><input type="text" name="text" value=""></br></br>


				<input type="submit" name="submit" value="Valider">
				
			</div>
		</div>
	</div>
</body>
</html>

