<?php session_start() ?>
<?php require "header.php" ?>
<?php require 'bdd.php'; ?>
<link rel="stylesheet" href="css/stylee.css">
<body>
	<?php 
	$stmt = $bdd->prepare("SELECT id_etudiant, Observations FROM stage WHERE id_etudiant = ?");
    		$result = $stmt->execute($_POST['id_etudiant']);
    		$result = $stmt->fetchAll();

    $stmt = $bdd->prepare("SELECT Nom_prenom FROM etudiant_sup, stage WHERE etudiant_sup.id_etudiant = stage.id_etudiant ");
    		$resultNomPrenom = $stmt->execute();
    		$resultNomPrenom = $stmt->fetch();		
    		 ?>
	<div class="container">
		<div id="content">		
			<div class="left">
				<h2><?php echo($resultNomPrenom['Nom_prenom']); ?></h2>

				<h3>Visites liées au stage <button>Nouvelle visite</button></h3> <!-- requete BDD -->
				<br>

				<?php foreach ($result as $resultselect) {
					echo ("<h4>Observations : </h4>");
					echo ("<p>".$resultselect['Observations']."</p>");	
				};
				?>		
			</div>
		</div>
	</div>
</body>
</html>