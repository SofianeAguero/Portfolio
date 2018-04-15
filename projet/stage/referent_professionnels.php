<?php session_start() ?>
<?php require "header.php" ?>
<?php require 'bdd.php'; ?>
<body>
<link rel="stylesheet" href="css/stylee.css">
	<?php 
	$stmt = $bdd -> query("SELECT * FROM rf_pro");
    		
	?>
	<div class="container">
		<div id="content">		
			<div class="left">
			<h2>Entreprises :</h2>
			<h3>Ajouter un référent professionnel :</h3>

			<form method="POST" action="">
				<label>Nom du référent :</label>
				<input type="text" name="nomreferent" value=""><br>
				<label>Prénom du référent :</label>
				<input type="text" name="prenomreferent" value=""><br>
				<label>Fonction :</label>
				<input type="text" name="fonctionref" value=""></br></br>
				</select><br>
				<input type="submit" name="submit" value="Valider">
			</form>
			<?php
			if(isset($_POST['submit'])) {
				$stmtselect = $bdd->prepare('SELECT nom_rf_pro FROM rf_pro WHERE nom_rf_pro = ?');
				$insertRef = $stmtselect->execute(array($_POST['nomreferent']));
				$insertRef = $stmtselect->fetch(); 
				};

				// si champs vide erreur sinon ajout
				if(isset($_POST['submit']) && (empty($_POST['nomreferent']) || empty($_POST['prenomreferent']) || empty($_POST['fonctionref'])))
				{
					echo '<script type="text/javascript">alert("Champs vide ou manquant");</script>';
				}
				elseif(isset($_POST['submit']) && empty($insertRef['nom_rf_pro'])) 
				{
					
						$insertRef = $bdd->prepare("INSERT INTO rf_pro (nom_rf_pro, prenom_rf_pro, Fonction_rf_pro) VALUES (?,?,?)");
    					$insertRef->execute(array($_POST['nomreferent'], $_POST['prenomreferent'], $_POST['fonctionref']));
					echo('<script type="text/javascript">if(confirm("Referent ajouté")){window.location.href = "/projet_stage/referent_professionnels.php";}</script>');
				}

				//Si entreprise existe déjà msg erreur
				if(!empty($insertRef['nom_rf_pro'])) 
				{
					echo '<script type="text/javascript">alert("Referent déjà existant");</script>';
				};
				?>
			

			</div>
		</div>
	</div>
</body>
</html>