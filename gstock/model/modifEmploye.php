<?php
include 'connexion.php';
session_start();

if (!empty($_POST['id_departement']) 
     &&!empty($_POST['nom']) 
    && !empty($_POST['prenom'])
    && !empty($_POST['adresse'])
    && !empty($_POST['telephone'])
) {
    if (!empty($_POST['id'])) {
        
        $sql = "UPDATE employes SET id_departement=?, nom=?, prenom=?, adresse=?, telephone=?  WHERE id_employe=?";
        $req = $connexion->prepare($sql);
        $req->execute(array(
            $_POST['id_departement'], 
            $_POST['nom'],
            $_POST['prenom'], 
            $_POST['adresse'],
            $_POST['telephone'],
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
        
        $sql = "INSERT INTO employes (nom, prenom, id_departement, adresse, telephone) VALUES (?, ?, ?, ?, ?)";
        $req = $connexion->prepare($sql);
        $req->execute(array(
            $_POST['id_departement'], 
            $_POST['nom'],
            $_POST['prenom'], 
            $_POST['adresse']
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

header('Location: ../vue/employe.php');
exit;
?>
