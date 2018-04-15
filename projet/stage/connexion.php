<?php 
					
					require 'bdd.php';


					if(isset($_SESSION['email']) && isset($_SESSION['mdp']))
					{
						echo '<a href="#">';
						echo("Bonjour " .$_SESSION['nom']);
						echo('</br>');
						echo('</br>');
						echo("</a>");
					}
					else 
					{
						echo("<h3>Veuillez vous connecter</h3>");
						echo('<form method="POST" action="">');
						echo('<label for="email">Login :</label><br><input class="inpconnect" size="10" type="text" name="email"><br>');
						echo('<label for="mdp">Mot de passe :</label><br><input class="inpconnect" size="10" type="password" name="mdp"><br>');
						echo'<input class="btn btn-primary" type="submit" value="Envoyer" name="connexion">';
						
						echo'</form></br>';

					}
					?>
					<?php
						foreach ($connexion['erreur'] as $erreurs) {
							print_r($erreurs);
							echo ("</br>");
						};
						foreach ($connexion['reussi'] as $erreurs) {
							print_r($erreurs);
							echo ("</br>");
							};
					?>
