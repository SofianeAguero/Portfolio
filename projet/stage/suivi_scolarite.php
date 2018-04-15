<?php session_start() ?>
<?php require "header.php" ?>
<?php require 'bdd.php'; ?>
<link rel="stylesheet" href="css/stylee.css">

<body>
	<?php 
		$stmt = $bdd -> query("SELECT * FROM classe");
    	$stmtbac = $bdd->prepare('SELECT Lib_classe, Id_classe FROM classe');
		$resultsuivi = $stmtbac->execute();
		$resultsuivi = $stmtbac->fetchAll();	
	?>
	<div class="container">
		<div id="content">		
			<div class="left">
				<h2>Suivi de scolarité</h2><br>
				<h3>Rechercher une classe :</h3> <br>
				
				<form method="POST" action="nouvelle_classe.php">
				<button>Ajouter une classe</button><br>
				</form>

				<form method="POST" action="">
					<label>Nom de la classe :</label>
					<select class="nomclasse" name="nomclasse" size="1">
							<?php 
							foreach ($resultsuivi as $resultselectsuivi) {
								echo ("<OPTION value=".$resultselectsuivi['Id_classe'].">".$resultselectsuivi['Lib_classe']);
							}
							 ?>
					</select>
					</br>

					<input type="submit" name="submit1" value="Rechercher"><br>
				</form>
				<?php
				if(isset($_POST['submit1']))
				{
					header("Location:classe.php?id=".$_POST['nomclasse']);
				} 
				?>

				<br>

				<?php 
						$stmt = $bdd -> query("SELECT * FROM etudiant_sup");
    					$stmtclasse = $bdd->prepare('SELECT Id_etudiant, Nom_etudiant, Prenom_etudiant FROM etudiant_sup');
						$resultclasse = $stmtclasse->execute();
						$resultclasse = $stmtclasse->fetchAll();
				?>


				<h3>Rechercher un élève :</h3> 
				<form method="POST" action=""><br>
				<button>Ajouter un élève</button><br>
				</form>
				<form method="POST" action="">
					<label>Nom de l'élève :</label>
					<select class="nometudiant" name="nometudiant" size="1">
							<?php 
							foreach ($resultclasse as $resultselectclasse) {
								echo ("<OPTION value=".$resultselectclasse['Id_etudiant'].">".$resultselectclasse['Nom_etudiant']." ".$resultselectclasse['Prenom_etudiant']);
							}
							 ?>
							 	<br>
					</select>
				
				
					<input type="submit" name="submit" value="Rechercher">
				</form>
				<br>
				<?php if(isset($_POST['submit']))
				{
					$stmt = $bdd -> query("SELECT Id_etudiant FROM etudiant_sup");
    				$stmtclasse = $bdd->prepare('SELECT Id_etudiant FROM etudiant_sup WHERE Id_etudiant = ?');
					$resultrecherche = $stmtclasse->execute(array($_POST['nometudiant']));
					$resultrecherche = $stmtclasse->fetch();
					var_dump($_POST['nometudiant']);
					var_dump($resultrecherche);
					header("Location:eleve.php?id=".$resultrecherche['Id_etudiant']);
				};
				?>
				

		
				
			</div>
		</div>
	</div>
</body>
</html>