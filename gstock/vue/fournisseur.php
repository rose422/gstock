<?php 
include 'entete.php';

if (!empty($_GET['id'])) {
  $fournisseur = getFournisseur($_GET['id']);
}
?>
<div class="home-content">
<div class="overview-boxes">
<div class="box">
  <form action="<?= !empty($_GET['id']) ? "../model/modifFournisseur.php": "../model/ajoutFournisseur.php" ?>" method="post">
          <label for="nom">Nom </label>
          <input value="<?= !empty($_GET['id']) ? $fournisseur['nom'] : "" ?>" type="text" name="nom" id="nom" placeholder="Veuillez saisir le nom">
          <input value="<?= !empty($_GET['id']) ? $fournisseur['id'] : "" ?>" type="hidden" name="id" id="id">

          <label for="prenom">prénom </label>
          <input value="<?= !empty($_GET['id']) ? $fournisseur['prenom'] : "" ?>" type="text" name="prenom" id="prenom" placeholder="Veuillez saisir le prenom">
         
          <label for="contact">N° Téléphone</label>
                <input value="<?= !empty($_GET['id'])  ? $fournisseur['contact'] : "" ?>" type="text" name="contact" id="conctact" placeholder="Veuillez saisir le N° de téléphone">
                
                <label for="adresse">Adresse</label>
                <input value="<?= !empty($_GET['id'])  ? $fournisseur['adresse'] : "" ?>" type="text" name="adresse" id="adresse" placeholder="Veuillez saisir l'adresse">
          
                
                <button type="submit">Valider</button>



          <?php 
          if (!empty($_SESSION ['message']['text'])) {
           ?>
          <div class="alert <?=$_SESSION ['message']['type']?>">
          <?=$_SESSION ['message']['text']?>
          </div>
         
           <?php
          }
          ?>

  </form>
</div>
 <div class="box">
   <table class="mtable">
     <tr>
      <th>Nom </th>
      <th>Prénom</th>
      <th>Contact</th>
      <th>Adresse</th>
      <th>Action</th>
     </tr>
  

   <?php
    $fournisseur = getFournisseur();

    if (!empty($fournisseur) && is_array($fournisseur)) {
      foreach ($fournisseur  as $key => $value) {
        ?>
        <tr>
          <td><?=$value['nom'] ?></td>
          <td><?=$value['prenom'] ?></td>
          <td><?=$value['contact'] ?></td>
          <td><?=$value['adresse'] ?></td>
          <td><a href="?id=<?= $value['id'] ?>"><i class='bx bx-edit-alt' ></i></a></td>
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