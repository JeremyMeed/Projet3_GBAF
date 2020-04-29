<?php
session_start();
$title = 'Accueil Membre';
require("include/connecbdd.php");
require_once("include/header.php");
?>

		<!-- Présentation du GBAF et bannière -->
		<div id="presentation">
			<h1> Bienvenue sur l'extranet de GBAF </h1>
				<p>Le Groupement Banque Assurance Français (GBAF) est une fédération représentant les 6 grands groupes français :<br/><br/>
				BNP Paribas <br/>
				BPCE <br/>
				Crédit Agricole <br/>
				Crédit Mutuel-CIC <br/>
				Société Générale <br/>
				La Banque Postale<br/><br/>
				Même s’il existe une forte concurrence entre ces entités, elles vont toutes travailler de la même façon pour gérer près de 80 millions de comptes sur le territoire national.<br/>
				Le GBAF est le représentant de la profession bancaire et des assureurs sur tous les axes de la réglementation financière française.<br/> Sa mission est de promouvoir l'activité bancaire à l’échelle nationale.<br/> C’est aussi un interlocuteur privilégié des pouvoirs publics.</p>
			<div id="banniere_image">
				<img src="img/banniere1.jpg" alt="banniere">
			</div>
		</div>
		<!-- On affiche les acteurs -->
		<div class="separateur">
		</div>
		<div id="bloc_acteurs">
			<div id="bloc_titre">
				<h2> Acteurs et Partenaires </h2>
					<p> Présentation de la liste des différents acteurs du système bancaire français :</p>
			</div>
			<div id="separateur">
			</div>
			<div id="acteurs">
				<?php
				$req = $bdd->query('SELECT * FROM acteurs');
				// Boucle affichage acteur
				while($donnees = $req->fetch())
				{
				?>	
				<div class="styleacteur">
					<img class="logo_acteur_mini" src="<?php echo $donnees['logo'];?>" alt="acteur_logo_mini"/> <br/>
					<div class="texteacteur">
						<?php 
							echo '<h2>' . $donnees['acteur'] . '</h2>';
							echo substr($donnees['description'], 0, 100).'...'; 
						?>
						<button class="bouton_suite" onclick= "window.location.href='acteur.php?id=<?php echo $donnees['id_acteur']; ?>';">Afficher la suite
						</button> 
					</div>	
				</div>	
				<?php 
				} // Fin boucle acteur 
				?>			
			</div>
		</div>
<?php 
require_once('include/footer.php');
?> 	

