<?php
include 'connexion.php';
session_start();

if (
      !empty($_POST['libelle_categorie']) 
  
) {
    if (!empty($_POST['id'])) {
       
        $sql = "UPDATE categorie SET libelle_categorie=? WHERE id=?";
        $req = $connexion->prepare($sql);
        $req->execute(array(
            $_POST['libelle_categorie'],
            $_POST['id']
            
        ));

        if ($req->rowCount() != 0) {
            $_SESSION['message']['text'] = "catégorie modifié avec succès";
            $_SESSION['message']['type'] = "success"; 
        } else {
            $_SESSION['message']['text'] = "Rien n'a été modifié";
            $_SESSION['message']['type'] = "warning";       
        }
    } else {
        
        $sql = "INSERT INTO categorie (libelle_categorie) VALUES (?)";
        $req = $connexion->prepare($sql);
        $req->execute(array(
            $_POST['libelle_categorie'],
           
            
        ));

        if ($req->rowCount() != 0) {
            $_SESSION['message']['text'] = "catégorie ajouté avec succès";
            $_SESSION['message']['type'] = "success"; 
        } else {
            $_SESSION['message']['text'] = "Erreur lors de l'ajout catégorie";
            $_SESSION['message']['type'] = "danger";       
        }
    }
} else {
    $_SESSION['message']['text'] = "Une information obligatoire non renseignée";
    $_SESSION['message']['type'] = "danger";
}

header('Location: ../vue/categorie.php');
exit;
?>
