<?php session_start() ?>
<?php require "header.php" ?>
<?php require 'bdd.php'; ?>
<link rel="stylesheet" href="css/stylee.css">
<body>
	<?php 
	$stmt = $bdd->prepare("SELECT * FROM etudiant_sup where Id_etudiant = ?");
		    		$result = $stmt->execute(array($_GET['id']));
		    		$result = $stmt->fetch();


    $stmt = $bdd->prepare("SELECT Nom_etudiant, Prenom_etudiant FROM etudiant_sup, stage WHERE etudiant_sup.Id_etudiant = stage.Id_etudiant ");
    		$resultNomPrenom = $stmt->execute();
    		$resultNomPrenom = $stmt->fetch();

    // req Entreprises
    $stmt = $bdd->prepare("SELECT * FROM entreprise");
    		$resultEntreprise = $stmt->execute();
    		$resultEntreprise = $stmt->fetchAll();

    // req ref peda
    $stmt = $bdd->prepare("SELECT * FROM rf_peda");
    		$resultref = $stmt->execute();
    		$resultref = $stmt->fetchAll();

    // req resp pro
    $stmt = $bdd->prepare("SELECT * FROM rf_pro");
    		$resultresp = $stmt->execute();
    		$resultresp = $stmt->fetchAll();

    // req techno
    $stmt = $bdd->prepare("SELECT * FROM techno_stage");
    		$resultTechno = $stmt->execute();
    		$resultTechno = $stmt->fetchAll();	

    // req Annee
    $stmt = $bdd->prepare("SELECT * FROM annee_stage");
    		$resultAnnee = $stmt->execute();
    		$resultAnnee = $stmt->fetchAll();	
    ?>
	
	<div class="container">
		<div id="content">		
			<div class="left">
				<h2><?php echo($result['Nom_etudiant']. " " .$result['Prenom_etudiant']); ?></h2> <!-- requête BDD -->

				<h3>Nouveau stage</h3>
				<form method="POST" action="">
					<label>Entreprise existante :</label>
					<SELECT name="entreprise" size="1">
					<?php foreach ($resultEntreprise as $resultEntrepriseSelect) {
						echo("<OPTION>".$resultEntrepriseSelect['Nom_entreprise']);	
					}; ?>
					<OPTION>Autre
					</SELECT>
					<label>ou nouvelle : </label>  <input type="text" name="nouvEntreprise" />
					<br>
					<label>Résponsable pédagogique :</label>
					<SELECT name="responsablePedagogique" size="1">
					<?php foreach ($resultref as $resultrefselect) {
						echo("<OPTION>".$resultrefselect['nom_rf_peda']);	
					}; ?>
					<OPTION>Autre
					</SELECT>
					<label>ou nouveau: </label>  <input type="text" name="nouvRespPedagogique" />
					<br>
					<label>Résponsable professionnel :</label>
					<SELECT name="responsableTechnique" size="1">
					<?php foreach ($resultresp as $resultrespselect) {
						echo("<OPTION>".$resultrespselect['nom_rf_pro']);	
					}; ?>
					<OPTION>Autre
					</SELECT>
					<label>ou nouveau: </label>  <input type="text" name="nouvTecho" />
					<br>
					<label>Technologies pratiquées :</label>
					<SELECT name="technoPratiquées" size="4" multiple>
					<?php foreach ($resultTechno as $resultTechnoselect) {
						echo("<OPTION>".$resultTechnoselect['Lib_Techno']);	
					}; ?>
					<OPTION>Autres
					</SELECT>
					<br>
					<label>Année concernée :</label>
					<SELECT name="anneeConcernee" size="1">
					<?php foreach ($resultAnnee as $resultAnneeSelect) {
						echo("<OPTION>".$resultAnneeSelect['Date_Annee_stage']);	
					}; ?>
					<OPTION>Autre
					</SELECT>
					<label>ou nouvelle : </label>  <input type="text" name="nouvAnneeConcernee" />
					<br>
					<label>Date début : </label>  <input type="date" name="dateDebut" />
					<label>Date fin : </label>  <input type="date" name="dateFin" />
					<br>
					<input type="submit" name="submit">
				</form>			
				
				<?php 
					if(isset($_POST['submit']))
					{
						
						$insertStage = $bdd->prepare("INSERT INTO stage (datedeb,Date_fin,id_etudiant,id_referent,id_entreprise,id_rf_pro) VALUES (?,?,?,?,?,?)");
    					$insertStage->execute(array($_POST['dateDebut'], $_POST['dateFin'],$result['id_etudiant'],$_POST['responsableTechnique'],$_POST['entreprise'],$_POST['responsablePedagogique']));
    					echo "Un nouveau stage a été créé.";
					};
				?>
				
			</div>
		</div>
	</div>
</body>
</html>