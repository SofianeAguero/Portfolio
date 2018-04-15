<?php session_start() ?>
<?php require "header.php" ?>
<?php require 'bdd.php'; ?>
<head>
	<link rel="stylesheet" href="css/stylee.css">
</head>
<body>
	<?php 
	$stmt = $bdd -> query("SELECT * FROM type_bac");
    		
	?>
	<style>
	table
{
    border-collapse: collapse;
}
td, th /* Mettre une bordure sur les td ET les th */
{
    border: 1px solid black;
}
</style>
	<div class="container">
		<div id="content">		
			<div class="typebac">
				<h2>Suivi scolarité</h2>
				<h3>Liste des années scolaires </h3>
				<center>
				<table>
				<tr>
				<th>Intitulé</th>
				<th>Actions</th>
				</tr>
				<?php
					 while($donnees = $stmt->fetch())
					 {
					 		$typesbac = $donnees["Id_type_bac"];
                            $Lib = $donnees["Lib_type_bac"];                          
							echo"<tr>";
							echo "<td>".$Lib."</td>", '<td><a href="./delete_bac.php?id='.$typesbac.'">Supprimé</a></td>';
							echo "</tr>";
							
						}; ?>
				</table>

				<br>
				<h3>  Ajouter un nouveau BAC </h3>
				<form method="POST" action="types_de_bac.php">
				<label> intitulé : </label> <input type="text" name="intitule_bac"/> <input class="btn btn-primary" type="submit" name="submit" value="Valider">
				</form>
			
				<?php
					// Si form envoyé, requete pour voir si bac existe déjà
					if(isset($_POST['submit'])) 
					{
						$stmtbac = $bdd->prepare('SELECT Lib_type_bac FROM type_bac WHERE Lib_type_bac = ?');
						$resultverif = $stmtbac->execute(array($_POST['intitule_bac']));
						$resultverif = $stmtbac->fetch(); 
					};

				
					//Si bac existe déjà msg erreur
					if(!empty($resultverif['Lib_type_bac'])) 
					{
						echo '<script type="text/javascript">alert("Bac déjà existant");</script>';
					};

					if(isset($_POST['submit']) && empty($_POST['intitule_bac']))
					{
						echo '<script type="text/javascript">alert("Champs vide");</script>';
					}
					elseif(isset($_POST['submit']) && empty($resultverif['Lib_type_bac'])) 
					{
						$stmtnew = $bdd->prepare("INSERT INTO type_bac(Lib_type_bac) VALUES (?)");
						$resultnouv = $stmtnew->execute(array($_POST['intitule_bac']));
						echo('<script type="text/javascript">if(confirm("Bac ajouté")){window.location.href = "/projet_stage/types_de_bac.php";}</script>');
					};
				?>
			</center>
			</div>
		</div>
	</div>
</body>
</html>