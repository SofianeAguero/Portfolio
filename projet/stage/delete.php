<?php require 'bdd.php'; 

		$stmtclasse = $bdd->prepare('DELETE FROM etudiant_sup WHERE Id_etudiant = ?');
		$resultclasse = $stmtclasse->execute(array($_GET['id']));
		header('Location:classe.php?id='.$_GET['idclasse']);
		?>