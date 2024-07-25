<?php
include 'connexion.php';
session_start();

if (!empty($_POST['libelle_departement']) 
    
  
) {
    $sql = "INSERT INTO departement (libelle_departement) VALUES (?)";

    $req = $connexion->prepare($sql);

    $req->execute(array(
        $_POST['libelle_departement']
    ));

    if ($req->rowCount() != 0) {
        $_SESSION['message']['text'] = "Departement ajouté avec succès";
        $_SESSION['message']['type'] = "success";
    } else {
        $_SESSION['message']['text'] = "Une erreur s'est produite lors de l'ajout du Departement";
        $_SESSION['message']['type'] = "danger";
    }
} else {
    $_SESSION['message']['text'] = "Une information obligatoire non renseignée";
    $_SESSION['message']['type'] = "danger";
}

header('Location: ../vue/departement.php');
exit();
?>
