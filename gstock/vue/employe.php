<?php 
include 'entete.php';

if (!empty($_GET['id'])) {
  $employes = getEmploye($_GET['id']);
}
?>
<div class="home-content">
<div class="overview-boxes">
<div class="box">
  <form action="<?= !empty($_GET['id']) ? "../model/modifEmploye.php": "../model/ajoutEmploye.php" ?>" method="post">
          <label for="nom">Nom </label>
          <input value="<?= !empty($_GET['id']) ? $employes['nom'] : "" ?>" type="text" name="nom" id="nom" placeholder="Veuillez saisir le nom">
          <input value="<?= !empty($_GET['id']) ? $employes['id_employe'] : "" ?>" type="hidden" name="id" id="id">

          <label for="prenom">prénom </label>
          <input value="<?= !empty($_GET['id']) ? $employes['prenom'] : "" ?>" type="text" name="prenom" id="prenom" placeholder="Veuillez saisir le prenom">
      
                <label for="adresse">Adresse</label>
                <input value="<?= !empty($_GET['id'])  ? $employes['adresse'] : "" ?>" type="text" name="adresse" id="adresse" placeholder="Veuillez saisir l'adresse">

                <label for="id_departement">Departement</label>
<select name="id_departement" id="id_departement">
<?php 
$departements=getDepartement();

if (!empty($departements) && is_array($departements)) {
 foreach ($departements as $key => $value) {
?>
 <option <?= !empty($employe['id']) && $employe['departement'] == "informatique" ? "selected" : "" ?> value="<?= !empty($value['id']) ? $value['id'] : "" ?>"><?php echo !empty($value['libelle_departement']) ? $value['libelle_departement'] : ""; ?></option>

    <?php 
}
}
?>
</select>
                <label for="telephone">N° Téléphone</label>
                <input value="<?= !empty($_GET['id'])  ? $employes['telephone'] : "" ?>" type="text" name="telephone" id="telephone" placeholder="Veuillez saisir le N° de téléphone">
                
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
      <th>Adresse</th>
      <th>Departement</th>
      <th>telephone</th>
      <th>Action</th>
     </tr>
  

   <?php
    $employe = getEmploye();

    if (!empty($employe) && is_array($employe)) {
      foreach ($employe  as $key => $value) {
        ?>
        <tr>
          <td><?=$value['nom'] ?></td>
          <td><?=$value['prenom'] ?></td>
          <td><?=$value['adresse'] ?></td>
          <td><?=$value['libelle_departement'] ?></td>
          <td><?=$value['telephone'] ?></td>
          <td><a href="?id=<?= $value['id_employe'] ?>"><i class='bx bx-edit-alt' ></i></a></td>
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