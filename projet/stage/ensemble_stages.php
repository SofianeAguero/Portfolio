<?php session_start() ?>
<?php require "header.php" ?>
<?php require 'bdd.php'; ?>
<body>
<link rel="stylesheet" href="css/stylee.css">

	<?php 
    	$stmtstage = $bdd->prepare('SELECT * FROM stage, entreprise, rf_peda, rf_pro where stage.Id_entreprise = entreprise.Id_entreprise and stage.Id_rf_peda = rf_peda.Id_rf_peda and stage.Id_rf_pro = rf_pro.Id_rf_pro and Id_etudiant = ? ');
		$resultstage = $stmtstage->execute(array($_GET['id']));
		$resultstage = $stmtstage->fetch();	

	?>


	<div class="container">
		<div id="content">		
			<div class="left">
				<!-- Requête NOM Prénom CLASSE BDD --> <?php
				$stmt = $bdd->prepare("SELECT * FROM etudiant_sup where Id_etudiant = ?");
		    		$result = $stmt->execute(array($_GET['id']));
		    		$result = $stmt->fetch();

		    	?>
				<h2><?php  echo $result['Nom_etudiant'] . " " . $result['Prenom_etudiant']; ?></h2>
				<h3>Historique des stages</h3><!-- RIGHT --> 
				
				<form method="POST" action="">
				<input type="submit" name="submit" value="Ajouter un stage">
				</form>
				
				<!-- Tableau requête BDD liste des stages -->
				<?php if(isset($_POST['submit']))
				{
					
					header("Location:ajout_stage.php?id=".$result['Id_etudiant']);
				};
				?>
				<table style="width:100%">
					  	<tr>
					    	<th>Date début</th>
					    	<th>Date fin</th>
					    	<th>Entreprise</th> 
					    	<th>Référent pédagogique</th>
					    	<th>Référent professionnel</th>
					    	<th>Action</th>
					  	</tr>
					<!-- REQUETES BDD pour aficher les Details ! -->
					 <?php
					 		while($donnees = $stmtstage->fetch())
					 		{
					 	
					 		$identreprise = $donnees["Nom_entreprise"];
					 		$rfpeda = $donnees["nom_rf_peda"];
					 		$refpro = $donnees["nom_rf_pro"];
					 		$datedeb = $donnees["Date_deb_stage"];
					 		$datefin = $donnees["Date_fin_stage"];	
							echo"<tr>";
							echo "<td>".$datedeb."</td>","<td>".$datefin."</td>", "<td>".$identreprise."</td>", "<td>".$rfpeda."</td>", "<td>".$refpro."</td>",'<td><a href="delete_stage.php?id='.$identreprise.'">Supprimé</a></td>';
							echo "</tr>";
							
							}; 
					?>	</td>
				  		
				</table>
			</div>
		</div>
	</div>
</body>
</html>

