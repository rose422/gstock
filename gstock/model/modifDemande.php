<?php
include 'connexion.php';
session_start();

if (
    !empty($_POST['id_produit']) 
    && !empty($_POST['id_employe']) 
    && !empty($_POST['quantite']) 
    && !empty($_POST['date_demande'])
) {
    if (!empty($_POST['id'])) {
       
        $sql = "UPDATE demande SET id_produit=?, id_employe=?, quantite=?, date_demande=? WHERE id=?";
        $req = $connexion->prepare($sql);
        $req->execute(array(
            $_POST['id_produit'],
            $_POST['id_employe'], 
            $_POST['quantite'], 
            $_POST['date_demande'],
            $_POST['id']
        ));

        if ($req->rowCount() != 0) {
            $_SESSION['message']['text'] = "Demande modifiée avec succès";
            $_SESSION['message']['type'] = "success"; 
        } else {
            $_SESSION['message']['text'] = "Rien n'a été modifié";
            $_SESSION['message']['type'] = "warning";       
        }
    } else {
        
        $sql = "INSERT INTO demande (id_produit, id_employe, quantite, date_demande) 
        VALUES (?, ?, ?, ?)";
        $req = $connexion->prepare($sql);
        $req->execute(array(
            $_POST['id_produit'],
            $_POST['id_employe'], 
            $_POST['quantite'], 
            $_POST['date_demande']
        ));

        if ($req->rowCount() != 0) {
            $_SESSION['message']['text'] = "Demande ajoutée avec succès";
            $_SESSION['message']['type'] = "success"; 
        } else {
            $_SESSION['message']['text'] = "Erreur lors de l'ajout de la demande";
            $_SESSION['message']['type'] = "danger";       
        }
    }
} else {
    $_SESSION['message']['text'] = "Une information obligatoire non renseignée";
    $_SESSION['message']['type'] = "danger";
}

header('Location: ../vue/demande.php');
exit;
?>
