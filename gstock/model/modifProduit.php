<?php
include 'connexion.php';
session_start();

if (
    !empty($_POST['nom_produit']) 
    && !empty($_POST['id_categorie']) 
    && !empty($_POST['prix_unitaire']) 
    && !empty($_POST['quantite']) 
    
) {
    if (!empty($_POST['id'])) {
        
        $sql = "UPDATE produits SET nom_produit=?, id_categorie=?, prix_unitaire=?, quantite=? WHERE id_produit=?";
        $req = $connexion->prepare($sql);
        $req->execute(array(
            $_POST['nom_produit'],
            $_POST['id_categorie'], 
            $_POST['prix_unitaire'], 
            $_POST['quantite'],
            $_POST['id']
        ));

        if ($req->rowCount() != 0) {
            $_SESSION['message']['text'] = "employé modifié avec succès";
            $_SESSION['message']['type'] = "success"; 
        } else {
            $_SESSION['message']['text'] = "Rien n'a été modifié";
            $_SESSION['message']['type'] = "warning";       
        }
    } else {
        
        $sql = "INSERT INTO produits (nom_produit, id_categorie, prix_unitaire, quantite) VALUES (?, ?, ?, ?)";
        $req = $connexion->prepare($sql);
        $req->execute(array(
            $_POST['nom_produit'],
            $_POST['id_categorie'], 
            $_POST['prix_unitaire'], 
            $_POST['quantite']
        ));

        if ($req->rowCount() != 0) {
            $_SESSION['message']['text'] = "employé ajouté avec succès";
            $_SESSION['message']['type'] = "success"; 
        } else {
            $_SESSION['message']['text'] = "Erreur lors de l'ajout du employé";
            $_SESSION['message']['type'] = "danger";       
        }
    }
} else {
    $_SESSION['message']['text'] = "Une information obligatoire non renseignée";
    $_SESSION['message']['type'] = "danger";
}

header('Location: ../vue/produit.php');
exit;
?>
