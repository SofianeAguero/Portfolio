<?php session_start() ?>
<?php require "header.php" ?>
<?php require 'bdd.php'; ?>
<link rel="stylesheet" href="css/stylee.css">
<body>
	
	<div class="container">
		<div id="content">		
			<div class="left">				
			</div>
			<div class="contentright">
				<h2>Bienvenue sur la plateforme</h2>
				
				

				<?php require "connexion.php" ?>
				
				<?php require "verif.php" ?>
			</div>			
		</div>
	</div>
</body>
</html>
