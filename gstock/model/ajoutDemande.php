<?php
include 'connexion.php';
include_once "function.php";
session_start();

if (
    !empty($_POST['id_employe']) 
    && !empty($_POST['id_produit']) 
    && !empty($_POST['quantite'])
    && !empty($_POST['date_demande'])
){
    $produit = getProduit($_POST['id_produit']);

    if (!empty($produit) && is_array($produit)){
        if ($_POST['quantite']>$produit['quantite']) {
            $_SESSION['message']['text'] = "La quantité demandée n'est pas disponible";
            $_SESSION['message']['type'] = "danger";    
        } else {
            $sql = "INSERT INTO demande (id_employe, id_produit, quantite, date_demande) 
                    VALUES (?, ?, ?, ?)";

            $req = $connexion->prepare($sql);

            $req->execute(array(
                $_POST['id_employe'],
                $_POST['id_produit'],  
                $_POST['quantite'],
                $_POST['date_demande']
            ));

            if ($req->rowCount() != 0) {
                $sql = "UPDATE produits SET quantite = quantite - ? WHERE id_produit = ?";

                $req = $connexion->prepare($sql);

                $req->execute(array(
                    $_POST['quantite'],
                    $_POST['id_produit'] 
                ));

                if ($req->rowCount() != 0) {
                    $_SESSION['message']['text'] = "Demande effectuée avec succès";
                    $_SESSION['message']['type'] = "success"; 
                } else {
                    $_SESSION['message']['text'] = "Impossible de mettre à jour la quantité du produit";
                    $_SESSION['message']['type'] = "danger";   
                }
            } else {
                $_SESSION['message']['text'] = "Une erreur s'est produite lors de la demande";
                $_SESSION['message']['type'] = "danger";       
            }
        }
    }
} else {
    $_SESSION['message']['text'] = "Une information obligatoire non renseignée";
    $_SESSION['message']['type'] = "danger";
}

header('Location: ../vue/demande.php');
exit();
?>
