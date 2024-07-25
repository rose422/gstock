<?php 
include 'entete.php';

if (!empty($_GET['id'])) {
  $departement = getDepartement($_GET['id']);
}
?>
<div class="home-content">
  <div class="overview-boxes">
    <div class="box">
      <form action="<?= !empty($_GET['id']) ? "../model/modifDepartement.php" : "../model/ajoutDepartement.php" ?>" method="post">
        <label for="libelle_departement">Nom du departement </label>
        <input value="<?= !empty($_GET['id']) ? $departement['libelle_departement'] : "" ?>" type="text" name="libelle_departement" id="libelle_departement" placeholder="Veuillez saisir ">
        <input value="<?= !empty($_GET['id']) ? $departement['id'] : "" ?>" type="hidden" name="id" id="id">

        <button type="submit">Valider</button>

        <?php 
        if (!empty($_SESSION['message']['text'])) {
        ?>
          <div class="alert <?= ($_SESSION['message']['type']) ?>">
            <?= ($_SESSION['message']['text']) ?>
          </div>
        <?php
        }
        ?>
      </form>
    </div>
    <div class="box">
      <table class="mtable">
        <tr>
          <th>Departement</th>
          <th>Action</th>
        </tr>
        <?php
        $departement = getDepartement();

        if (!empty($departement) && is_array($departement)) {
          foreach ($departement as $key => $value) {
        ?>
          <tr>
            
            <td><?= $value['libelle_departement'] ?></td>
            <td><a href="?id=<?= $value['id'] ?>"><i class='bx bx-edit-alt'></i></a></td>
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
