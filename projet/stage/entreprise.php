<?php session_start() ?>
<?php require "header.php" ?>
<?php require 'bdd.php'; ?>
<link rel="stylesheet" href="css/stylee.css">
<body>
	<?php 
	$stmt = $bdd->prepare("SELECT * FROM entreprise");
    		$resultentreprise = $stmt->execute();
    		$resultentreprise = $stmt->fetchAll();
	?>
	<div class="container">
		<div id="content">		
			<div class="left">	
			</div>
			<ul class="menugauche">
				<li class="actived">Stages</li><HR size=2 width="100%">
				<li>Entreprises</li><HR size=2 align=center width="100%">
				<li>Suivi Scolarité</li>
			</ul>
			<div class="rightcont">
			<div class="col-lg-6">
			<h2>Entreprises</h2><br>
				<h3>Rechercher une entreprise</h3>
				<form method=POST action="">
					<label>Nom de l'entreprise :</label>
						<select class="selectentreprise1" name="nomentreprise" size="1">
							<?php 
							foreach ($resultentreprise as $resultselectentreprise) {
								echo ("<OPTION value=".$resultselectentreprise['Id_entreprise'].">" .$resultselectentreprise['Nom_entreprise']);
							};
							 ?>
						</select><br>
						<input class="btn btn-primary btnentreprise1" type="submit" name="submit1" value="Rechercher">
				</form><br>
				<?php 
					if(isset($_POST['submit1']))
					{
						header('Location:informations_entreprise.php?id='.$_POST['nomentreprise']);
					};

				?>
			</div>
				<div class="traitvertical"></div>
				<div class="rightentreprise col-lg-6">
				<h3>Nouvelle Entreprise</h3>
				<form method="POST" action="entreprise.php">
					<label>Nom de l'entreprise :</label>
					<input class="inputentreprise" type="text" name="nameentreprise">
					<label>Chiffre d'affaires :</label>
					<input class="inputentreprise" type="text" name="chiffreaffaires">
					<label>Adresse postale :</label><br>
					<input rows="5" cols="20" class="inputentreprise2" type="text" name="adressepostale"><br>
					<input class="btn btn-primary" type="submit" name="submit" value="Valider">
				</form>
				<?php
				// Si form envoyé, requete pour voir si entreprise existe déjà
				if(isset($_POST['submit'])) {
				$stmtselect = $bdd->prepare('SELECT Nom_entreprise FROM entreprise WHERE Nom_entreprise = ?');
				$resultverif = $stmtselect->execute(array($_POST['nameentreprise']));
				$resultverif = $stmtselect->fetch(); 
				};

				// si champs vide erreur sinon ajout
				if(isset($_POST['submit']) && (empty($_POST['chiffreaffaires']) || empty($_POST['nameentreprise']) || empty($_POST['adressepostale'])))
				{
					echo '<script type="text/javascript">alert("Champs vide ou manquant");</script>';
				}
				elseif(isset($_POST['submit']) && empty($resultverif['Nom_entreprise'])) 
				{
					$stmtnew = $bdd->prepare("INSERT INTO entreprise(Nom_entreprise,adresse1_entreprise,ChiffreAffaire_entreprise) VALUES ( ?, ?, ?)");
				$resultnouv = $stmtnew->execute(array($_POST['nameentreprise'], $_POST['adressepostale'], $_POST['chiffreaffaires']));
					echo('<script type="text/javascript">if(confirm("Entreprises ajouté")){window.location.href = "/projet_stage/entreprise.php";}</script>');
				}

				//Si entreprise existe déjà msg erreur
				if(!empty($resultverif['Nom_entreprise'])) 
				{
					echo '<script type="text/javascript">alert("Entreprise déjà existante");</script>';
				};
				?>
				</div>
			</div>
		</div>
	</div>
</body>
</html>