<?php session_start() ?>
<?php require "header.php" ?>
<?php require 'bdd.php'; ?>
<link rel="stylesheet" href="css/stylee.css">
<body>
	
	<div class="container">
		<div id="content">		
			<div class="left">
			<?php
				$stmt = $bdd->prepare("SELECT * FROM entreprise where Id_entreprise = ?");
		    		$result = $stmt->execute(array($_GET['id']));
		    		$result = $stmt->fetch();

		    	?>
					<h2> <?php echo $result['Nom_entreprise']; ?></h2> <!-- Nom de l'entreprise demandée -->
				<?php  
					$stmt = $bdd->prepare("SELECT COUNT(Id_stage) as nb_stage FROM stage WHERE Id_entreprise = ?");
		    		$resultcount = $stmt->execute(array($_GET['id']));
		    		$resultcount = $stmt->fetch();
		    		

		    	?>
				<h5>Cette société totalise <?php echo $resultcount['nb_stage']; ?> stages à son actif.</h5>  <!-- nbre stage de l'entreprise requete BDD -->
				<h3>Informations de l'entreprise</h3>
				<?php
				$stmt = $bdd->prepare("SELECT * FROM entreprise where Id_entreprise = ?");
		    		$results = $stmt->execute(array($_GET['id']));
		    		$results = $stmt->fetch();

		    	?>
				<form>
					<label>Nom de l'entreprise</label>
					<input type="text" name="nom entreprise" value="<?php echo $results['Nom_entreprise']; ?>"><br>
					<label>Type d'entreprise</label>
					<select>
						<?php
							$stmt = $bdd->prepare("SELECT * FROM type_entreprise");
				    		$resultstype = $stmt->execute();
				    		$resultstype = $stmt->fetchAll(); 
							foreach ($resultstype as $resultstypes) {
								echo ("<OPTION value=".$resultstypes['Id_type_entreprise'].">" .$resultstypes['Lib_type_entreprise']);
							};
						 ?>
					</select>
					<label>ou nouveau :</label>
					<input type="text" name="nouveautype"><br>
					<label>Chiffre d'affaires :</label>
					<input type="text" name="chiffreaffaires" value="<?php echo $results['ChiffreAffaire_entreprise']; ?>"><br>
					<label>Adresse postale 1 :</label>
					<input type="text" name="adresse1postale" value="<?php echo $results['adresse1_entreprise']; ?>"><br>
					<label>Adresse postale 2 :</label>
					<input type="text" name="adresse2postale" value="<?php echo $results['adresse2_entreprise']; ?>"><br>
					<br>
					<label>Code Postal : </label>  <input type="text" name="CPEntreprise" value="<?php echo $results['CP_entreprise']; ?>" />
					<label>Ville : </label>  <input type="text" name="villeEntreprise" value="<?php echo $results['ville_entreprise']; ?>"/><br>

					<label>Resp Technique</label>
					<select>
						<?php
							$stmt = $bdd->prepare("SELECT * FROM rf_peda");
				    		$resultsref = $stmt->execute();
				    		$resultsref = $stmt->fetchAll(); 
							foreach ($resultsref as $resultsrefs) {
								echo ("<OPTION value=".$resultsrefs['Id_rf_peda'].">" .$resultsrefs['prenom_rf_peda']." ".$resultsrefs['nom_rf_peda']);
							};
						 ?>
					</select>
					<label>ou nouveau :</label>
					<input type="text" name="nouveauresp"><br>
					<br>
					<input type="submit" name="submit" value="Editer">
				</form>
				<br>
				
				<?php
					$stmt = $bdd->prepare("SELECT * FROM stage,etudiant_sup WHERE etudiant_sup.Id_etudiant=stage.Id_etudiant and Id_entreprise=?");
		    		$resulttableau = $stmt->execute(array($_GET['id']));
		    		$resulttableau = $stmt->fetchAll();
		     	?>
				<h4>Historique des stages :</h4>
				<table style="width:100%">
					<thead>
					  	<tr>
					    	<th>Année</th>
					    	<th>Eleve</th>
					    	<th>Action</th> 
					   	</tr>
					</thead>
					<!-- REQUETES BDD pour aficher les Details ! -->
						<?php 
							foreach ($resulttableau as $resultselecttableau) {
								echo ("<tr><td>".$resultselecttableau['Date_Annee_stage']."</td><td>".$resultselecttableau['Nom_etudiant']." ".$resultselecttableau['Prenom_etudiant']."</td><td><a href='detail_stage.php?id='>voir les détails</a></td></tr>");
							}
						 ?>
			  	</table>
				
				
			</div>
		</div>
	</div>
</body>
</html>