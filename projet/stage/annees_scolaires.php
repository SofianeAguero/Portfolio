<?php session_start() ?>
<?php require "header.php" ?>
<?php require 'bdd.php'; ?>
<head>
	<link rel="stylesheet" href="css/css_annee_scolaire.css">
	<link rel="stylesheet" href="css/stylee.css">
</head>
<body>
<?php 
			$stmt = $bdd->prepare("SELECT Date_Annee_stage FROM annee_stage");
    		$result = $stmt->execute();
    		$result = $stmt->fetchAll();
?>
	
	<div class="container">
		<div id="content">		
			<div class="left">
				<h2>Suivi scolarité</h2>
				<h3>Liste des années scolaires</h3>
				<table>
					<tr>
						<th>Année</th>
						<th>Actions</th>
					</tr>
					<?php 
					foreach ($result as $resultselect) {
						echo "<tr>";
						echo "<td>".$resultselect['Date_Annee_stage']."</td>";
						echo "<td><a href='deleteannee.php?id=".$resultselect['Date_Annee_stage']."'>Supprimer</a></td>";
						echo "</tr>";
					}
					?>
				</table>
				<br>
				<h3>Ajouter une année</h3><br>
				<form method="POST" action="">
				<label> Nom : </label> <input type="text" name="nom_annee"/> <input type="submit" name="submit" value="Ajouter"/></form>
				<?php
				if(isset($_POST['submit']))
				{
					if(empty($_POST['nom_annee']))
					{
						echo "Merci de renseigner le champs 'Nom'";
					}
					else
					{
						$stmt = $bdd->prepare("INSERT INTO annee_stage (Date_Annee_stage) VALUES (?)");
    					$result = $stmt->execute(array($_POST['nom_annee']));
						echo "L'année a bien été ajoutée";
					}
				}

				?>
			
			</div>
		</div>
	</div>
</body>
</html>