<?php
$title = 'Inscription';
require("include/connecbdd.php");
require_once("include/header_public.php");
?>
<div id="bloc_page">
	<div id="inscription">
		<h3>Inscription</h3> 
		<?php //affiche une erreur si pseudo deja utlisé 
		if(!empty($_GET['err']) && $_GET['err']== "pseudo")
		{
			echo '<p style="color: rgb(252, 116, 106);"><strong> Pseudo déja utlisé ! </strong></p>'; 
		}
		// affiche une validation si tous les champs ne sont pas remplis 
		if(!empty($_GET['err']) && $_GET['err']== "champs")
		{
			echo '<p style="color: rgb(252, 116, 106);"><strong> Tous les champs doivent être remplis ! </strong></p>';  
		}
		?>
		<form class="form" method="post" action="inscription_bdd.php">
			Votre nom :
			<input class="input" type="text" name="nom">
			Votre prénom :
			<input class="input" type="text" name="prenom">
			Votre pseudo :
			<input class="input" type="text" name="username">
			Votre mot de passe :
			<input class="input" type="password" name="password">
			Votre question secrète : <br>
			<select class="input" name="choix">
				<option value="choix1">Le nom de jeune fille de votre mère</option>
				<option value="choix2">Le nom de votre premier animal de compagnie</option>
				<option value="choix3">La ville de naissance de votre père</option>
			</select> <br>
			Réponse à la question secrète :
			<input class="input" type="text" name="reponse">
			<input class="bouton_connexion" type="submit" name="valider" value="Valider">
		</form>
	</div>
</div>
<?php require_once('include/footer.php');?> 

	