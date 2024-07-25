<?php
include 'connexion.php';
include_once "function.php";
session_start();

if (
    !empty($_POST['id_fournisseur']) 
    && !empty($_POST['id_produit']) 
    && !empty($_POST['quantite'])
    && !empty($_POST['date_commande'])
){
    

            $sql = "INSERT INTO commande (id_fournisseur, id_produit, quantite, date_commande) 
                    VALUES (?, ?, ?, ?)";

            $req = $connexion->prepare($sql);

            $req->execute(array(
                $_POST['id_fournisseur'],
                $_POST['id_produit'],  
                $_POST['quantite'],
                $_POST['quantite']
            ));

            if ($req->rowCount() != 0) {
                $sql = "UPDATE produits SET quantite = quantite + ? WHERE id_produit = ?";

                $req = $connexion->prepare($sql);

                $req->execute(array(
                    $_POST['quantite'],
                    $_POST['id_produit'] 
                ));

                if ($req->rowCount() != 0) {
                    $_SESSION['message']['text'] = "commande effectuée avec succès";
                    $_SESSION['message']['type'] = "success"; 
                } else {
                    $_SESSION['message']['text'] = "Impossible de mettre à jour la quantité du produit";
                    $_SESSION['message']['type'] = "danger";   
                }
            } else {
                $_SESSION['message']['text'] = "Une erreur s'est produite lors de la commande";
                $_SESSION['message']['type'] = "danger";       
            }
        
    
    
} else {
    $_SESSION['message']['text'] = "Une information obligatoire non renseignée";
    $_SESSION['message']['type'] = "danger";
}

header('Location: ../vue/commande.php');
exit();
?>
