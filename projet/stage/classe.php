<?php session_start() ?>
<?php require "header.php" ?>
<?php require 'bdd.php'; ?>

<body>
<?php 

    	
    	$stmtclasse = $bdd->prepare('SELECT * FROM classe, etudiant_sup WHERE etudiant_sup.Id_classe_etudiant = classe.Id_classe and Id_classe = ?');
		$resultclasse = $stmtclasse->execute(array($_GET['id']));
		$resultclasse = $stmtclasse->fetch();	
	?>
	<link rel="stylesheet" href="css/stylee.css">
	<div class="container">
		<div id="content">		
			<div class="left">
			<?php
				$stmt = $bdd->prepare("SELECT * FROM classe where Id_classe = ?");
		    		$result = $stmt->execute(array($_GET['id']));
		    		$result = $stmt->fetch();

		    	?>
				<!-- Requête NOM Prénom CLASSE BDD --><h2><?php  echo $result['Lib_classe']; ?></h2>
				<h3>Historique des élèves par année</h3><!-- RIGHT --> <a href="nouvelle_annee.php"><button>Ajouter une année</button></a>

				<!-- Tableau requête BDD liste des stages -->
				
				<p><strong>2016/2017</strong></p>
				<table style="width:100%">
				
				<tr>
				<th>Nom</th>
				<th>Prénom</th>
				<th>email</th>
				<th>Année Obtention Bac</th>
				<th>Action</th>
				</tr>
				<?php
					 while($donnees = $stmtclasse->fetch())
					 {

					 		$nometudiant = $donnees["Nom_etudiant"];
					 		$prenometudiant = $donnees["Prenom_etudiant"];
					 		$mailetudiant = $donnees["mail_etudiant"];
					 		$obtentionbac = $donnees["annee_obtention_bac_etudiant"];
					 		$idetudiant = $donnees["Id_etudiant"];
							echo"<tr>";

							echo "<td>".$nometudiant."</td>", "<td>".$prenometudiant."</td>", "<td>".$mailetudiant."</td>", "<td>".$obtentionbac."</td>",'<td><a href="eleve.php?id='.$idetudiant.'&idclasse='.$_GET['id'].'">Détails</a></td>';
							echo "</tr>";
							
						}; ?>
				
				</table></br>

				<p><strong>2015/2016</strong></p>
				<table style="width:100%">
					<thead>
					  	<tr>
					    	<th>Nom</th>
					    	<th>Prénom</th> 
					    	<th>N° Telephone</th>
					    	<th>Année Obtention Bac</th>
					    	<th>Action</th>
					  	</tr>
					</thead>
					
				</table>
			</div>
		</div>
	</div>
</body>
</html>

