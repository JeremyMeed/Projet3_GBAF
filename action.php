<?php
session_start();
$title = 'Like';
require("include/connecbdd.php");
require_once("include/header.php");

//Vérifie que les $_GET sont présent et non vides
if(isset($_GET['t'], $_GET['id'], $_SESSION['id_user']) AND !empty($_GET['t']) AND !empty($_GET['id']) AND !empty($_SESSION['id_user'])) 
{
    // Stocke les informations dans des variables
    $getid = (int) $_GET['id'];
    $gett = (int) $_GET['t'];
    $sessionid = (int) $_SESSION['id_user'];

    // Vérifie que l'id du $_GET existe dans la BDD
    $check = $bdd->prepare('SELECT id_acteur FROM acteurs WHERE id_acteur =?');
    $check->execute(array($getid));
    
    // Si le tableau stocké dans $check possède 1 ligne -> l'acteur existe
    if($check->rowCount() == 1) 
    {
        // 1 -> like
        if($gett == 1) 
        {   
            // Vérifie si l'utilisateur de la session a déjà liké l'acteur      
            $check_like = $bdd->prepare('SELECT id_like FROM likes WHERE acteur_id = ? AND user_id = ?');
            $check_like->execute(array($getid, $sessionid));
            // Si l'utilisateur a disliké l'acteur, on supprime le dislike
            $deldislike = $bdd->prepare('DELETE FROM dislikes WHERE acteur_id = ? AND user_id = ?');
            $deldislike->execute(array($getid, $sessionid));
            
            // S'il y a déjà un like, on le supprime
            if($check_like->rowCount() == 1) 
            { 
                $dellike = $bdd->prepare('DELETE FROM likes WHERE acteur_id = ? AND user_id = ?');
                $dellike->execute(array($getid, $sessionid));
            }
            // S'il n'y a pas de like, on l'ajoute 
            else 
            {
                $ins = $bdd->prepare('INSERT INTO likes (acteur_id, user_id) VALUES (?, ?)');
                $ins->execute(array($getid, $sessionid));
            }
        } 
        // 2 -> dislike
        elseif ($gett == 2) 
        {
            // Vérifie si l'utilisateur de la session a déjà disliké l'acteur
            $check_like = $bdd->prepare('SELECT id_dislike FROM dislikes WHERE acteur_id = ? AND user_id = ?');
            $check_like->execute(array($getid, $sessionid));
            // Si l'utilisateur a liké l'acteur, on supprime le like
            $dellike = $bdd->prepare('DELETE FROM likes WHERE acteur_id = ? AND user_id = ?');
            $dellike->execute(array($getid, $sessionid));
            
            // S'il y a déjà un dislike, on le supprime
            if($check_like->rowCount() == 1) 
            { 
                $deldislike = $bdd->prepare('DELETE FROM dislikes WHERE acteur_id = ? AND user_id = ?');
                $deldislike->execute(array($getid, $sessionid));
            } 
            // S'il n'y a pas de dislike, on l'ajoute
            else 
            {
                $ins = $bdd->prepare('INSERT INTO dislikes (acteur_id, user_id) VALUES (?, ?)');
                $ins->execute(array($getid, $sessionid));
            }
        }
        // Actualisation de la page après action 
        header('Location: acteur.php?id=' .$getid);
    } 
    else 
    {
        exit('Erreur Fatale');
    }       
} 
else 
{
    exit('Erreur Fatale. <a href="index_user.php">Revenir à la page d\'accueil</a>');
}
?>
