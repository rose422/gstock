<?php
include 'connexion.php';
session_start();

if (!empty($_POST['id_departement'])
    &&!empty($_POST['nom']) 
    && !empty($_POST['prenom'])
    && !empty($_POST['adresse']) 
    && !empty($_POST['telephone'])
) {
    $sql = "INSERT INTO employes (id_departement, nom, prenom, adresse, telephone) 
    VALUES (?, ?, ?, ?, ?)";

    $req = $connexion->prepare($sql);

    $req->execute(array(
        $_POST['id_departement'],
        $_POST['nom'],
        $_POST['prenom'],
        $_POST['adresse'],
        $_POST['telephone'],
    ));

    if ($req->rowCount() != 0) {
        $_SESSION['message']['text'] = "Employé ajouté avec succès";
        $_SESSION['message']['type'] = "success";
    } else {
        $_SESSION['message']['text'] = "Une erreur s'est produite lors de l'ajout de l'employé";
        $_SESSION['message']['type'] = "danger";
    }
} else {
    $_SESSION['message']['text'] = "Une information obligatoire non renseignée";
    $_SESSION['message']['type'] = "danger";
}

header('Location: ../vue/employe.php');
exit();
?>
