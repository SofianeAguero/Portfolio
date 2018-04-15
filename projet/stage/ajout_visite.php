<?php session_start() ?>
<?php require "header.php" ?>
<?php require 'bdd.php'; ?>
<link rel="stylesheet" href="css/stylee.css">
<body>
	
	<div class="container">
		<div id="content">		
			<div class="left">
				
				<?php
				$stmt = $bdd->prepare("SELECT * FROM etudiant_sup where Id_etudiant = ?");
		    		$result = $stmt->execute(array($_GET['id']));
		    		$result = $stmt->fetch();

		    	?>
				<h2><?php  echo $result['Nom_etudiant'] . " " . $result['Prenom_etudiant']; ?></h2> 
				<h3>Ajouter une nouvelle visite </h3>
				<form method="POST">
				<label>Date de visite: </label>  <input type="date" name="dateVisite" /> 
				<br>
				<label>Observations : </label>  <input type="text" name="observation"  size="4" />
				<br>
				<input class="btn btn-primary btnentreprise1" type="submit" name="submit">
				</form>
				<?php
						// si champs vide erreur sinon ajout
					if(isset($_POST['submit']) && (empty($_POST['dateVisite']) || empty($_POST['observation'])))
					{
						echo '<script type="text/javascript">alert("Champs vide ou manquant");</script>';
					}
					elseif(isset($_POST['submit']))
					{
						$stmt = $bdd->prepare("SELECT * FROM stage where Id_etudiant = ?");
		    			$resultId = $stmt->execute(array($_GET['id']));
		    			$resultId = $stmt->fetch();
		    			var_dump($resultId);
						$query = $bdd->prepare('INSERT  INTO visite_stage(date_visite,Observations_visite,Id_stage) VALUES (?,?,?)');
						$query->execute(array(
							$_POST['dateVisite'],
						    $_POST['observation'],
						    $resultId['Id_stage']));
							echo '<script type="text/javascript">alert("La visite a bien été ajoutée");</script>';
					};
				?>	
			</div>
		</div>
	</div>
</body>
</html>