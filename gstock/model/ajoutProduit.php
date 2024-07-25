<?php
session_start();
include 'connexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nom_produit = $_POST['nom_produit'] ?? '';
    $id_categorie = $_POST['id_categorie'] ?? '';
    $prix_unitaire = $_POST['prix_unitaire'] ?? '';
    $quantite = $_POST['quantite'] ?? '';
    $stock_initial = $_POST['stock_initial'] ?? ''; // Récupérer stock_initial

    // Vérifiez que tous les champs requis sont remplis
    if (empty($nom_produit) || empty($id_categorie) || empty($prix_unitaire) || empty($quantite) || empty($stock_initial)) {
        $_SESSION['message'] = [
            'text' => 'Tous les champs sont obligatoires.',
            'type' => 'alert-danger'
        ];
        header('Location: ../vue/produit.php');
        exit;
    }

    try {
        $sql = "INSERT INTO produits (nom_produit, id_categorie, prix_unitaire, quantite, stock_initial) 
                VALUES (?, ?, ?, ?, ?)";
        $stmt = $connexion->prepare($sql);
        $stmt->execute([$nom_produit, $id_categorie, $prix_unitaire, $quantite, $stock_initial]);
        
        $_SESSION['message'] = [
            'text' => 'Produit ajouté avec succès.',
            'type' => 'alert-success'
        ];
    } catch (PDOException $e) {
        $_SESSION['message'] = [
            'text' => 'Erreur : ' . $e->getMessage(),
            'type' => 'alert-danger'
        ];
    }

    header('Location: ../vue/produit.php');
    exit;
}
?>



