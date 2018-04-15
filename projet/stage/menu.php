<div class="header">
		<div class="container">
			<div class="logo">
				<h1>Gestion des stages</h1>
			</div>
			<ul class="main-menu">
				<li>
					<a href="index.php" class="active">Accueil</a>
				</li>
				<li>
					<a href="stages.php">Stages</a>
				</li>
				<li>
					<a href="entreprise.php">Entreprises</a>
				</li>
				<li>
					<a href="suivi_scolarite.php">Suivi Scolarité</a>
				</li>
			</ul>
			<ul class="main-menu-right">
				<li>
				
					<?php 
					require 'bdd.php';
					if(isset($_SESSION['email']) && isset($_SESSION['mdp']))
					{
						echo '<a href="#">';
						// affiche le nom de l'user
						
						echo("Bonjour " .$_SESSION['email']);
						echo ("</a>");
					echo('<ul>');
					echo('<li><a href="">Mon compte</a></li>');
					// deconnecte l'utilisateur
					echo('<li><a href="./logout.php">Déconnexion</a></li>');
					echo('</ul>');
					echo "<br>";

					}
					else 
					{
						echo '<a href="index.php">';
						echo("Veuillez vous connecter");
						echo("</a>");

					}
					?>
				</li>
			</ul>
		</div>
	</div>