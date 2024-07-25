<?php
include 'connexion.php';
session_start();

if (!empty($_POST['nom']) 
    && !empty($_POST['prenom']) 
    && !empty($_POST['contact'])
    && !empty($_POST['adresse'])
   
) {
    $sql = "INSERT INTO fournisseur (nom, prenom, contact, adresse) 
    VALUES (?, ?, ?, ?)";

    $req = $connexion->prepare($sql);

    $req->execute(array(
        $_POST['nom'],
        $_POST['prenom'],
        $_POST['contact'],
        $_POST['adresse'],

    ));

    if ($req->rowCount() != 0) {
        $_SESSION['message']['text'] = "Fournisseur ajouté avec succès";
        $_SESSION['message']['type'] = "success";
    } else {
        $_SESSION['message']['text'] = "Une erreur s'est produite lors de l'ajout du fournisseur";
        $_SESSION['message']['type'] = "danger";
    }
} else {
    $_SESSION['message']['text'] = "Une information obligatoire non renseignée";
    $_SESSION['message']['type'] = "danger";
}

header('Location: ../vue/fournisseur.php');
exit();
?>
