<?php
include 'connexion.php';
session_start();

if (
    !empty($_POST['nom']) 
    && !empty($_POST['prenom']) 
    && !empty($_POST['contact']) 
    && !empty($_POST['adresse'])
    
) {
    if (!empty($_POST['id'])) {
        
        $sql = "UPDATE fournisseur SET nom=?, prenom=?, contact=?, adresse=? WHERE id=?";
        $req = $connexion->prepare($sql);
        $req->execute(array(
            $_POST['nom'],
            $_POST['prenom'], 
            $_POST['contact'], 
            $_POST['adresse'],
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
        
        $sql = "INSERT INTO fournisseur (nom, prenom, contact, adresse) VALUES (?, ?, ?, ?)";
        $req = $connexion->prepare($sql);
        $req->execute(array(
            $_POST['nom'],
            $_POST['prenom'], 
            $_POST['contact'], 
            $_POST['adresse']
        ));

        if ($req->rowCount() != 0) {
            $_SESSION['message']['text'] = "employé ajouté avec succès";
            $_SESSION['message']['type'] = "success"; 
        } else {
            $_SESSION['message']['text'] = "Erreur lors de l'ajout du produit";
            $_SESSION['message']['type'] = "danger";       
        }
    }
} else {
    $_SESSION['message']['text'] = "Une information obligatoire non renseignée";
    $_SESSION['message']['type'] = "danger";
}

header('Location: ../vue/fournisseur.php');
exit;
?>
