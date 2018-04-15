<?php session_start() ?>
<?php require "header.php" ?>
<?php require 'bdd.php'; ?>
<link rel="stylesheet" href="css/stylee.css">
<body>
	
	<div class="container">
		<div id="content">		
			<div class="left">
				<h2>Suivi scolarité</h2>
				<h3>Ajouter une nouvelle classe</h3></br><!-- RIGHT --> 

				<!-- Tableau requête BDD liste des stages -->
				<form method="POST" action="">
				<label>Libellé : </label><input type="text" name="lib" value=""></br></br>
				<label>Désignation : </label><input type="text" name="designation" value=""></br></br>
				<input type="submit" name="submit" value="Valider">
				</form>

				<?php
			if(isset($_POST['submit'])) {
				$stmtselect = $bdd->prepare('SELECT Lib_classe FROM classe WHERE Lib_classe = ?');
				$insertClasse = $stmtselect->execute(array($_POST['lib']));
				$insertClasse = $stmtselect->fetch(); 
				};

				// si champs vide erreur sinon ajout
				if(isset($_POST['submit']) && (empty($_POST['lib']) || empty($_POST['designation'])))
				{
					echo '<script type="text/javascript">alert("Champs vide ou manquant");</script>';
				}
				elseif(isset($_POST['submit']) && empty($insertClasse['Lib_classe'])) 
				{
					
						$insertClasse = $bdd->prepare("INSERT INTO classe (Lib_classe, Designation_classe) VALUES (?,?)");
    					$insertClasse->execute(array($_POST['lib'], $_POST['designation']));
					echo('<script type="text/javascript">if(confirm("Classe ajouté")){window.location.href = "/projet_stage/nouvelle_classe.php";}</script>');
				}

				//Si entreprise existe déjà msg erreur
				if(!empty($insertClasse['Lib_classe'])) 
				{
					echo '<script type="text/javascript">alert("Classe déjà existant");</script>';
				};
				?>
				


			</div>
		</div>
	</div>
</body>
</html>

