<?php 
include 'entete.php';

if (!empty($_GET['id'])) {
    $demande = getDemande($_GET['id']);
}
?>
<div class="home-content">
<div class="overview-boxes">
<div class="box">
    <form action="<?= !empty($_GET['id']) ? "../model/modifDemande.php": "../model/ajoutDemande.php" ?>" method="post">
        <input value="<?= !empty($_GET['id']) ? $produit['id_produit'] : "" ?>" type="hidden" name="id" id="id">

        <label for="id_produit">Produit</label>
        <select name="id_produit" id="id_produit"> 

        <?php 
        $produits = getProduit();
        if (!empty($produits) && is_array($produits)) {
            foreach ($produits as $key => $value) {
        ?>
            <option value="<?= $value['id_produit'] ?>"><?= $value['nom_produit']. " " . $value['quantite']. " " . "disponible"?></option>
        <?php 
            }
        }
        ?>
        </select>

        <label for="id_employe">Employé</label>
        <select name="id_employe" id="id_employe">
        <?php 
        $employes = getEmploye();
        if (!empty($employes) && is_array($employes)) {
            foreach ($employes as $key => $value) {
        ?> 
            <option value="<?= $value['id_employe'] ?>"><?= $value['nom']. " " . $value['prenom']. "  " ?></option>
        <?php 
            }
        }
        ?>
        </select>

        <label for="quantite">Quantité</label>
        <input value="<?= !empty($_GET['id']) ? $produit['quantite'] : "" ?>" type="number" name="quantite" id="quantite" placeholder="veillez saisir la quantité">

        <label for="date_demande">Date</label>
        <input value="<?= !empty($_GET['id']) ? $produit['date_demande'] : "" ?>" type="datetime-local" name="date_demande" id="date_demande" placeholder="veillez saisir la quantité">
        
        
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
            <th>Employé</th>
            <th>Quantité</th>
            <th>Date</th>
            <th>Action</th>
        </tr>
        <?php
        $demande = getDemande();
        if (!empty($demande) && is_array($demande)) {
            foreach ($demande as $key => $value) {
        ?>
            <tr>
                <td><?= $value['nom_produit'] ?></td>
                <td><?= $value['nom']." ".$value['prenom'] ?></td>
                <td><?= $value['quantite'] ?></td>
                <td><?= date('d/m/Y H:i:s', strtotime($value['date_demande'])) ?></td>
                <td><a href="?id=<?= isset($value['id']) ? $value['id'] : '' ?>"><i class='bx bx-edit-alt' ></i></a></td>

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
