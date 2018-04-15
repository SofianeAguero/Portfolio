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
				<h2><?php  echo $result['Nom_etudiant'] . " " . $result['Prenom_etudiant']; ?></h2> <!-- requête BDD -->

				<h3>Informations</h3> 
				<form method="POST" action="nouv_classe_eleve.php">
				<input type="submit" name="submit" value="Associer à une nouvelle classe">
				</form>

			

				<form method="POST">
					<label>nom : </label>  <input type="text" name="nomEleve" value="<?php echo $result['Nom_etudiant']; ?>" />
					<label>prénom : </label>  <input type="text" name="prenomEleve" value="<?php echo $result['Prenom_etudiant']; ?>" />
					<br>
					<label>Adresse 1 : </label>  <input type="text" name="adresse1Eleve" value="<?php echo $result['adresse1_etudiant']; ?>" />
					<label>Adresse 2 : </label>  <input type="text" name="adresse2Eleve" value="<?php echo $result['adresse2_etudiant']; ?>"/>
					<br>
					<label>Code Postal : </label>  <input type="text" name="CPEleve" value="<?php echo $result['CP_etudiant']; ?>" />
					<label>Ville : </label>  <input type="text" name="villeEleve" value="<?php echo $result['ville_etudiant']; ?>"/>
					<br>
					<label>Téléphone : </label>  <input type="text" name="telephoneEleve" value="<?php echo $result['num_tel_etudiant']; ?>"/>
					<label>Année obtention BAC : </label>  <input type="text" name="anneeBacEleve" value="<?php echo $result['annee_obtention_bac_etudiant']; ?> "/>
					<br>
					<label>Email : </label>  <input type="mail" name="mailEleve" value="<?php echo $result['mail_etudiant']; ?> "/>
					<br>
					<label>Type de BAC :</label>
					<select class="selectbac" name="typeBac" size="1">
						<?php
							$stmt = $bdd->prepare("SELECT * FROM type_bac, etudiant_sup where type_bac.Id_type_bac = etudiant_sup.Id_type_bac and Id_etudiant = ?");
				    		$resultbac = $stmt->execute(array($_GET['id']));
				    		$resultbac = $stmt->fetchAll();
				    		foreach ($resultbac as $resultbacs) {
									echo ("<OPTION value=".$resultbacs['Id_type_bac']. ">" .$resultbacs['Lib_type_bac']);
								};
			     		?>
					</select>
					<br>
					<input type="submit" name="submit" value="Editer">
				</form>			
				<?php
	
					if(isset($_POST['submit'])) {
						$stmt = $bdd->prepare("UPDATE 'etudiant_sup' set 'Nom_etudiant' = :? , 'Prenom_etudiant' = :? , 'adresse1_etudiant' = :?, 'adresse2_etudiant' = :? , CP_etudiant = :? , 'ville_etudiant' = :?, 'num_tel_etudiant'= :? ,'annee_obtention_bac_etudiant' = ? , 'mail_etudiant' = ?, WHERE 'Id_etudiant' = :?");
						

			    		$stmt->execute(array(
			    			':?' => $_POST['nomEleve'],
							':?' => $_POST['prenomEleve'],
							':?' => $_POST['adresse1Eleve'],
							':?' => $_POST['adresse2Eleve'],
							':?' => intval($_POST['CPEleve']),
							':?' => $_POST['villeEleve'],
							':?' => intval($_POST['telephoneEleve']),
							':?' => $_POST['anneeBacEleve'],
							':?' => $_POST['mailEleve']));
			    			
			    			
					}
				?>

				<?php
					$stmt = $bdd->prepare("SELECT * FROM possede, classe where possede.Id_classe=classe.Id_classe and Id_etudiant=?");
		    		$resulttableau = $stmt->execute(array($_GET['id']));
		    		$resulttableau = $stmt->fetchAll();
		    	?>
				<h3>Historique des classes</h3>
				<table>
					<tr>
				       <td>Année</td>
				       <td>Classe</td>
				       <td>Action</td>
				   </tr>
				   <?php 
						foreach ($resulttableau as $resultselecttableau) {
							echo ("<tr><td>".$resultselecttableau['Date_Annee_stage']."</td><td>".$resultselecttableau['Lib_classe']."</td><td><a href='ensemble_stages.php?id='>voir les stages</a></td></tr>");
						}
					 ?>
				</table>
								
			</div>
		</div>
	</div>
</body>
</html>