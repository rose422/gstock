<?php 
include 'entete.php';

if (!empty($_GET['id'])) {
    $commande = getCommande($_GET['id']);
}
?>
<div class="home-content">
<div class="overview-boxes">
<div class="box">
    <form action="<?= !empty($_GET['id']) ? "../model/modifCommande.php": "../model/ajoutCommande.php" ?>" method="post">
        <input value="<?= !empty($_GET['id']) ? $produit['id_produit'] : "" ?>" type="hidden" name="id_produit" id="id_produit">

        <label for="id_produit">Produit</label>
        <select name="id_produit" id="id_produit"> 

        <?php 
        $produits = getProduit();
        if (!empty($produits) && is_array($produits)) {
            foreach ($produits as $key => $value) {
        ?>
            <option value="<?= $value['id_produit'] ?>"><?= $value['nom_produit']?></option>
        <?php 
            }
        }
        ?>
        </select>

        <label for="id_fournisseur">Fournisseur</label>
        <select name="id_fournisseur" id="id_fournisseur">
        <?php 
        $fournisseurs = getfournisseur();
        if (!empty($fournisseurs) && is_array($fournisseurs)) {
            foreach ($fournisseurs as $key => $value) {
        ?> 
            <option value="<?= $value['id'] ?>"><?= $value['nom']. " " . $value['prenom']. "  " ?></option>
        <?php 
            }
        }
        ?>
        </select>

        <label for="quantite">Quantité</label>
        <input value="<?= !empty($_GET['id']) ? $produit['quantite'] : "" ?>" type="number" name="quantite" id="quantite" placeholder="veillez saisir la quantité">

        <label for="date_commande">Date</label>
        <input value="<?= !empty($_GET['id']) ? $produit['date_commande'] : "" ?>" type="datetime-local" name="date_commande" id="date_commande" placeholder="veillez saisir la quantité">
        
        
        <button type="submit">Valider</button>

        <?php 
        if (!empty($_SESSION['message']['text'])) {
        ?>
        <div class="alert <?= $_SESSION['message']['type'] ?>">
            <?= $_SESSION['message']['text'] ?>
        </div>
        <?php
        }
        ?>
    </form>
</div>
<div class="box">
    <table class="mtable">
        <tr>
            <th>Produit</th>
            <th>Fournisseur</th>
            <th>Quantité</th>
            <th>Date</th>
            
        </tr>
        <?php
        $commandes = getCommande();
        if (!empty($commandes) && is_array($commandes)) {
            foreach ($commandes as $key => $value) {
        ?>
            <tr>
                <td><?= $value['nom_produit'] ?></td>
                <td><?= $value['nom']." ".$value['prenom'] ?></td>
                <td><?= $value['quantite'] ?></td>
                <td><?= date('d/m/Y H:i:s', strtotime($value['date_commande'])) ?></td>
                <td><a href="?id=<?= $value['id'] ?>"></a></td>
            </tr>
        <?php 
            }
        }
        ?>
    </table>     
</div>
</div>
</div>

</section>

<?php 
include 'pied.php';
?>