<?php
include 'connexion.php';
session_start();

if (!empty($_POST['id_produit']) && !empty($_POST['quantite_demandee'])) {
    $id_produit = $_POST['id_produit'];
    $quantite_demandee = (int)$_POST['quantite_demandee'];

    // Récupérer la quantité actuelle en stock
    $sql = "SELECT quantite FROM produits WHERE id_produit = ?";
    $req = $connexion->prepare($sql);
    $req->execute([$id_produit]);
    $produit = $req->fetch();

    if ($produit && $produit['quantite'] >= $quantite_demandee) {
        // Mettre à jour la quantité en stock
        $nouvelle_quantite = $produit['quantite'] - $quantite_demandee;
        $sql = "UPDATE produits SET quantite = ? WHERE id_produit = ?";
        $req = $connexion->prepare($sql);
        $req->execute([$nouvelle_quantite, $id_produit]);

        $_SESSION['message']['text'] = "Demande traitée avec succès. Nouvelle quantité: $nouvelle_quantite";
        $_SESSION['message']['type'] = "success";
    } else {
        $_SESSION['message']['text'] = "Quantité demandée non disponible.";
        $_SESSION['message']['type'] = "danger";
    }
} else {
    $_SESSION['message']['text'] = "Information obligatoire non renseignée.";
    $_SESSION['message']['type'] = "danger";
}

header('Location: ../vue/stock.php');
exit();
?>
