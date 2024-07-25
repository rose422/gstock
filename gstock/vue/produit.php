<?php 
include 'entete.php';

if (!empty($_GET['id'])) {
  $produit = getProduit($_GET['id']);
}
?>
<div class="home-content">
<div class="overview-boxes">
<div class="box">
  <form action="<?= !empty($_GET['id']) ? "../model/modifProduit.php" : "../model/ajoutProduit.php" ?>" method="post">
          <label for="nom_produit">Nom du produit</label>
          <input value="<?= !empty($_GET['id']) ? $produit['nom_produit'] : "" ?>" type="text" name="nom_produit" id="nom_produit" placeholder="Veuillez saisir le nom">
          <input value="<?= !empty($_GET['id']) ? $produit['id_produit'] : "" ?>" type="hidden" name="id" id="id">

          <label for="id_categorie">Catégorie</label>
          <select name="id_categorie" id="id_categorie">
          <?php 
          $categories = getCategorie();

          if (!empty($categories) && is_array($categories)) {
            foreach ($categories as $key => $value) {
          ?>
            <option <?= !empty($produit['id_categorie']) && $produit['id_categorie'] == $value['id'] ? "selected" : "" ?> value="<?= $value['id'] ?>"><?= $value['libelle_categorie'] ?></option>
          <?php 
            }
          }
          ?>
          </select>

          <label for="prix_unitaire">Prix unitaire</label>
          <input value="<?= !empty($_GET['id']) ? $produit['prix_unitaire'] : "" ?>" type="number" name="prix_unitaire" id="prix_unitaire" placeholder="Veuillez saisir le prix">
  
          <label for="quantite">Quantité</label>
          <input value="<?= !empty($_GET['id']) ? $produit['quantite'] : "" ?>" type="number" name="quantite" id="quantite" placeholder="Veuillez saisir la quantité">
          
          <label for="stock_initial">Stock initial</label>
          <input value="<?= !empty($_GET['id']) ? $produit['stock_initial'] : "" ?>" type="number" name="stock_initial" id="stock_initial" placeholder="Veuillez saisir le stock initial">
          
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
<div style="display: block;" class="box">
  <form action="" method="get">
  <table class="mtable">
     <tr>
      <th>Nom produit</th>
      <th>Catégorie</th>
      <th>Prix unitaire</th>
      <th>Quantité</th>
     </tr>
  <tr>
    <td>
        <input type="text" name="nom_produit" id="nom_produit" placeholder="Veuillez saisir le nom">
    </td>
    <td>
      <select name="id_categorie" id="id_categorie">
        <option value="">---choisir une categorie---</option>
        <?php 
        $categories = getCategorie();
        if (!empty($categories) && is_array($categories)) {
          foreach ($categories as $key => $value) {
        ?>
        <option value="<?= $value['id'] ?>"><?= $value['libelle_categorie'] ?></option>
        <?php 
          }
        }
        ?>
      </select>         
    </td>
    <td>
      <input type="number" name="prix_unitaire" id="prix_unitaire" placeholder="Veuillez saisir le prix">
    </td>
    <td>
      <input type="number" name="quantite" id="quantite" placeholder="Veuillez saisir la quantité">
    </td>
  </tr>
  </table>     
  <br>
  <button type="submit">Valider</button>
  </form>
  <br>
  <table class="mtable">
     <tr>
      <th>Nom produit</th>
      <th>Catégorie</th>
      <th>Prix unitaire</th>
      <th>Quantité</th>
      <th>Stock Initial</th>
      <th>Action</th>
     </tr>
   <?php
   if (!empty($_GET)) {
       $produits = getProduit(null, $_GET);
   } else {
       $produits = getProduit();
   }

    if (!empty($produits) && is_array($produits)) {
      foreach ($produits as $value) {
        ?>
        <tr>
          <td><?= $value['nom_produit'] ?></td>
          <td><?= $value['libelle_categorie'] ?></td>
          <td><?= $value['prix_unitaire'] ?></td>
          <td><?= $value['quantite'] ?></td>
          <td><?= $value['stock_initial'] ?></td>
          <td><a href="?id=<?= $value['id_produit'] ?>"><i class='bx bx-edit-alt'></i></a></td>
        </tr>
        <?php 
      }
    }
    ?>
  </table>     
 </div>
</div>
</div>
<?php include 'pied.php'; ?>
