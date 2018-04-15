<?php session_start() ?>
<?php require "header.php" ?>
<?php require 'bdd.php'; ?>
<link rel="stylesheet" href="css/stylee.css">
<body>
	
	<div class="container">
		<div id="content">		
			<div class="left">
				<h2>Suivi scolarité</h2>
				<h3>Ajouter un élève</h3>
				<form method="POST">
					<label>Nom: </label>  <input type="text" name="nomNouvEleve" />
					<label>Prénom : </label>  <input type="text" name="prenomNouvEleve" />
					<br>
					<label>Téléphone: </label>  <input type="text" name="telephoneNouvEleve" />
					<label>Email : </label>  <input type="mail" name="emailNouvEleve" />
					<br>

					<label>Adresse 1: </label>  <input type="text" name="adresse1NouvEleve" />
					<br>

					<label>Adresse2: </label>  <input type="text" name="adresse2NouvEleve" />
					<br>

					<label>CP: </label>  <input type="text" name="cpNouvEleve" />
					<br>

					<label>Ville: </label>  <input type="text" name="villeNouvEleve" />
					<label>Année obtention BAC : </label>  <input type="text" name="anneeBacNouvEleve" />
					
					<br>

					<label>Type de BAC :</label>
					<select>
						<?php
							$stmt = $bdd->prepare("SELECT * FROM type_bac");
				    		$resultbac = $stmt->execute();
				    		$resultbac = $stmt->fetchAll();
				    		foreach ($resultbac as $resultbacs) {
									echo ("<OPTION value=".$resultbacs['Id_type_bac'].">" .$resultbacs['Lib_type_bac']);
								};
			     		?>
					</select>

					<br>

					<input class="btn btn-primary btnentreprise1" type="submit" name="submit">
				</form>
				<?php
					if(isset($_POST['submit']) && (empty($_POST['nomNouvEleve']) || empty($_POST['prenomNouvEleve']) || empty($_POST['adresse1NouvEleve']) || empty($_POST['cpNouvEleve']) || empty($_POST['villeNouvEleve']) || empty($_POST['telephoneNouvEleve']) || empty($_POST['anneeBacNouvEleve']) || empty($_POST['emailNouvEleve']) || empty($resultbacs['Id_type_bac']))) 
					{
						echo '<script type="text/javascript">alert("Champ(s) vide(s) ou manquant(s)");</script>';
					}
					elseif(isset($_POST['submit']))
					{
						$stmtselect = $bdd->prepare('INSERT  INTO etudiant_sup (Nom_etudiant,Prenom_etudiant,adresse1_etudiant,adresse2_etudiant,CP_etudiant,ville_etudiant,num_tel_etudiant,annee_obtention_bac_etudiant,mail_etudiant,id_type_bac) VALUES (?,?,?,?,?,?,?,?,?,?)');
						$resultverif = $stmtselect->execute(
							array($_POST['nomNouvEleve'],
								$_POST['prenomNouvEleve'],
								$_POST['adresse1NouvEleve'],
								$_POST['adresse2NouvEleve'],
								intval($_POST['cpNouvEleve']),
								$_POST['villeNouvEleve'],
								intval($_POST['telephoneNouvEleve']),
								$_POST['anneeBacNouvEleve'],
								$_POST['emailNouvEleve'],
								$resultbacs['Id_type_bac']));
						echo '<script type="text/javascript">alert(" Le nouvel élève a bien été ajouté");</script>';
					}
					
				?>
			</div>
		</div>
	</div>
</body>
</html>