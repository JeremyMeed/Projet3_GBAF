<?php
session_start();
$title = 'Commentaire';
require("include/connecbdd.php");
require_once("include/header.php");

//si on submit
if(isset($_POST['submit']))    
{
    $id_user = $_POST['id_user'];
    $id_acteur = $_POST["id_acteur"];
    $post = htmlspecialchars($_POST['commentaire']);
    $prenom = htmlspecialchars($_POST['prenom']); 

        //si les champs sont remplis
        if(isset($_POST['commentaire']) AND !empty($_POST['commentaire']))
        {
            //on insère dans la bdd
            $addcomm = $bdd->prepare('INSERT INTO comments(user_id, acteur_id, date_add, comment) VALUES (:id_user, :id_acteur, NOW(), :comment)');
            $addcomm->execute(array(
                'id_user' => $id_user,
                'id_acteur' => $id_acteur, 
                'comment' => $post ));
                $ok_commentaire = '<p style="color: green;"> Merci pour votre commentaire <?php echo $_SESSION["prenom"]?> !</p> 
                <p> <a href="index_user.php"> Retour à l\'accueil </a>';     
        }    
        else
        {
            echo '<p style="color:  rgb(252, 116, 106);"> Veuillez remplir tous les champs !</p>'; 
        } 
}
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?php 
            if(!empty($title))
            {
        ?>
        <title><?= $title; }?></title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
    </head>
    <body>
        <div id="form_commentaire">
            <form class="form" method="POST" action="commentaire_post.php?id=<?php echo $_GET['id']; ?>">
                <input class="input" type="hidden" name="prenom" value="<?php echo $_SESSION['prenom']?>" /> 
                    <h3>  <?php echo $_SESSION['prenom']?>, donnez nous votre avis </h3>
                <textarea class="textarea" name="commentaire" placeholder="Veuillez saisir votre commentaire"></textarea> <br/> <br/> 
                <input class="bouton_connexion" type="submit" value="Valider" name="submit" /> <br/>
                <input type="hidden" name="id_acteur" id = "id_acteur" value="<?php echo $_GET['id']; ?>" />
                <input type="hidden" name="id_user" id = "id_user" value="<?php echo $_SESSION['id_user']; ?>" />
            </form> 
            <?php if(isset($ok_commentaire)) {echo $ok_commentaire;}
            ?>
        </div>
    </body>
</html>
<?php 
require_once('include/footer.php');
?>