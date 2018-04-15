<?php session_start() ?>
<?php require "header.php" ?>
<?php require 'bdd.php'; ?>
<body>
	
	<div class="container">
		<div id="content">		
			<div class="left">
				<h2>Dupont Jean Marc</h2>
				<h3>Associer l'élève à une nouvelle classe</h3>
				<form>
					<label>Classe :</label>
					<SELECT name="classe" size="1">
					<OPTION>BTS1
					<OPTION>BTS2
					</SELECT>
					<br>
					<label>Année :</label>
					<SELECT name="annee" size="1">
					<OPTION>2015/2016	
					<OPTION>2016/2017
					</SELECT>
					<br>
					<input type="submit" name="submit">
				</form>
			
				
			</div>
		</div>
	</div>
</body>
</html>