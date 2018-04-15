<?php session_start() ?>
<?php require "header.php" ?>
<?php require 'bdd.php'; ?>
<link rel="stylesheet" href="css/stylee.css">
<body>
	<?php 	$stmt = $bdd->prepare("SELECT Lib_classe FROM classe");
    		$result = $stmt->execute();
    		$result = $stmt->fetchAll();
    		 

    		$stmteleve = $bdd->prepare("SELECT * FROM etudiant_sup");
    		$resulteleve = $stmteleve->execute();
    		$resulteleve = $stmteleve->fetchAll();
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
				<h2>Gestion des stages</h2><h3>Rechercher un élève</h3>
				<form method="POST" action="">
					<label>Classe :</label><br>
					<SELECT class="inpconnect" name="classe" size="1">
					<!--<OPTION>BTS 1 Option : SLAM
					<OPTION>BTS 2 Option : SLAM-->

					<?php 
					foreach ($result as $resultselect) {
						echo ("<OPTION>" .$resultselect['Lib_classe']);
					} ?>
					</SELECT><br>
					<?php 
						$stmt = $bdd -> query("SELECT * FROM etudiant_sup");
    					$stmtclasse = $bdd->prepare('SELECT Id_etudiant, Nom_etudiant, Prenom_etudiant FROM etudiant_sup');
						$resulteleve = $stmtclasse->execute();
						$resulteleve = $stmtclasse->fetchAll();
				?>
					<label>Eleve :</label><br>
					<select class="nometudiant" name="nometudiant" size="1">
							<?php 
							foreach ($resulteleve as $resultselecteleve) {
								echo ("<OPTION value=".$resultselecteleve['Id_etudiant'].">".$resultselecteleve['Nom_etudiant']." ".$resultselecteleve['Prenom_etudiant']);
							}
							 ?>
					<br>
					<input class="btn btn-primary" type="submit" name="submit" value="Rechercher"> 
					<!-- LINK ensemblestages.php -->
				</form>	
				<?php if(isset($_POST['submit']))
				{
					$stmt = $bdd -> query("SELECT Id_etudiant FROM etudiant_sup");
    				$stmtclasse = $bdd->prepare('SELECT Id_etudiant FROM etudiant_sup WHERE Id_etudiant = ?');
					$resultrecherche = $stmtclasse->execute(array($_POST['nometudiant']));
					$resultrecherche = $stmtclasse->fetch();
					var_dump($_POST['nometudiant']);
					var_dump($resultrecherche);
					header("Location:ensemble_stages?id=".$resultrecherche['Id_etudiant']);
				};
				?>
					
				
			</div>			
		</div>
	</div>
</body>
</html>