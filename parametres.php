<?php
session_start();
$title = 'Parametres du compte';
require("include/connecbdd.php");
require_once("include/header.php");

// maj des données sauf mdp dans la bdd 
if (isset($_POST['valider'])) 
{
	if (!empty($_POST['nom']) AND !empty($_POST['prenom']) AND !empty($_POST['choix'] AND !empty($_POST['reponse'])))
	{
		$nom = htmlspecialchars($_POST['nom']);
		$prenom = htmlspecialchars($_POST['prenom']) ;
		$question = ($_POST['choix']) ;
		$reponse = htmlspecialchars($_POST['reponse']) ;
		$username = ($_SESSION['pseudo']);
		
		$maj = $bdd->prepare('UPDATE users SET nom= :nom, prenom= :prenom, question_secrete= :question_secrete, reponse_secrete= :reponse_secrete WHERE username= :username');
		$maj ->execute(array(
		'nom' => $nom,
		'prenom' => $prenom,
		'question_secrete' => $question,
		'reponse_secrete' => $reponse,
		'username' => $username));

		$ok = '<p style="color: rgb(50,205,50);">Vos données ont bien été modifiées ! </p>'; 
	}
	else
	{
		$erreur = '<p style="color: rgb(255, 0, 0);"> Veuillez remplir tous les champs.</p>'; 
	}
}	
// maj mdp dans la bdd 
if (isset($_POST['valider_mdp'])) 
{
	if(!empty($_POST['password']))
	{
		$pass_hache = password_hash($_POST['password'], PASSWORD_DEFAULT);
		$username = ($_SESSION['pseudo']);
		
		$majmdp = $bdd->prepare('UPDATE users SET password=:password  WHERE username= :username');
		$majmdp ->execute(array(
		'password' => $pass_hache,
		'username' => $username));
		
		$ok_mdp = '<p style="color: rgb(50,205,50);">Vote mot de passe à bien été modifié ! </p>'; 
	}
	else
	{
		$erreur_mdp = '<p style="color: rgb(255, 0, 0);"> Veuillez choisir un nouveau mot de passe.</p>'; 
	}
}	
?>

<div id="inscription">
	<h3>Modifiez les données de votre compte :</h3>
	<!-- formulaire toutes données sauf mdp -->
	<form class="form" method="post" action="parametres.php">
		<label for="nom">Nom :</label><br>
		<input class="input" type="text" name="nom" id="nom"><br>
		<label for="prenom">Prénom :</label>
		<input class="input" type="text" name="prenom" id="prenom">
		<label  for="question">Question secrète :</label> <br>
		<select class="input" name="choix" id="question">
			<option value="choix1">Le nom de jeune fille de votre mère</option>
			<option value="choix2">Le nom de votre premier animal de compagnie</option>
			<option value="choix3">La ville de naissance de votre père</option>
		</select> <br>
		<label for="reponse">Réponse à la question secrète :</label>
		<input class="input" type="text" name="reponse" id="reponse">
		<input class="bouton_connexion" type="submit" name="valider" value="Valider">
	</form>
	<?php if(isset($erreur)) {echo $erreur;}?>
	<?php if(isset($ok)) {echo $ok;}; ?>

	<h3>Modifiez votre mot de passe :</h3>
	<!-- formulaire mdp  -->
	<form class="form" method="post" action="parametres.php">
	<label for="password">Votre nouveau mot de passe :</label>
		<input class="input" type="password" name="password" id="password">
		<input class="bouton_connexion" type="submit" name="valider_mdp" value="Valider">
	</form>
	<?php 
	if(isset($erreur_mdp)) {echo $erreur_mdp;}; 
	if(isset($ok_mdp)) {echo $ok_mdp;}; 
	?>
</div>

<?php require_once('include/footer.php');?> 



