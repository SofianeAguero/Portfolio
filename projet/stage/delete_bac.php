<?php require 'bdd.php'; 
		$stmtclasse = $bdd->prepare('DELETE FROM type_bac WHERE Id_type_bac = ?');
		$resultclasse = $stmtclasse->execute(array($_GET['id']));
		header('Location:types_de_bac.php');
?>