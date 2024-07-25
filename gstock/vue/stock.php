<?php
session_start();
include '../model/connexion.php';

// Fonction pour récupérer tous les produits avec leurs stocks
function getAllProducts() {
    global $connexion;
    $sql = "SELECT id_produit, nom_produit, stock_initial, quantite FROM produits";
    $req = $connexion->prepare($sql);
    $req->execute();
    return $req->fetchAll();
}

// Récupération de tous les produits avec leurs stocks
$products = getAllProducts();
?>

<?php include 'entete.php'; ?>

<div class="home-content">
    <div class="overview-boxes">
        <div class="box">
            <h2>Stock des produits</h2>
            <table>
                <thead>
                    <tr>
                        
                        <th>Nom Produit</th>
                        <th>Stock Initial</th>
                        <th>Stock Actuel</th>
                        <th>Alerte</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($products as $product): ?>
                        <tr>
                            
                            <td><?= $product['nom_produit'] ?></td>
                            <td><?= $product['stock_initial'] ?></td>
                            <td><?= $product['quantite'] ?></td>
                            <td>
                                <?php if ($product['quantite'] < 10): // Seuil de stock bas ?>
                                    <div class="alert alert-danger">
                                        Stock bas !
                                    </div>
                                <?php else: ?>
                                    <div class="alert alert-success">
                                        Stock suffisant
                                    </div>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <?php 
            if (!empty($_SESSION['message']['text'])): ?>
                <div class="alert <?= $_SESSION['message']['type'] ?>">
                    <?= $_SESSION['message']['text'] ?>
                </div>
            <?php 
            unset($_SESSION['message']); // Clear message after displaying
            endif; ?>
        </div>
    </div>
</div>

<?php include 'pied.php'; ?>
