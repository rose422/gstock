<?php
include 'connexion.php';
session_start();

if (!empty($_POST['libelle_categorie'])) {
    $sql = "INSERT INTO categorie (libelle_categorie) VALUES (?)";
    $req = $connexion->prepare($sql);
    $req->execute(array($_POST['libelle_categorie']));

    if ($req->rowCount() != 0) {
        $_SESSION['message']['text'] = "Catégorie ajoutée avec succès";
        $_SESSION['message']['type'] = "success"; 
    } else {
        $_SESSION['message']['text'] = "Erreur lors de l'ajout de la catégorie";
        $_SESSION['message']['type'] = "danger";       
    }
} else {
    $_SESSION['message']['text'] = "Le libellé de la catégorie est obligatoire";
    $_SESSION['message']['type'] = "danger";
}

header('Location: ../vue/categorie.php');
exit;
?>

