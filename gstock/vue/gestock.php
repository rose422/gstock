<?php 
include 'entete.php';

?>
<div class="home-content">
        <div class="overview-boxes">
          <div class="box">
            <div class="right-side">
              <div class="box-topic">Commande</div>
              <div class="number"><?php echo getAllCommande()['nbre']; ?></div>
              <div class="indicator">
                <i class="bx bx-up-arrow-alt"></i>
                <span class="text">Depuis hier</span>
              </div>
            </div>
            <i class="bx bx-cart-alt cart"></i>
          </div>
          <div class="box">
            <div class="right-side">
              <div class="box-topic">Demande</div>
              <div class="number"><?php echo getAlldemande()['nbre']; ?></div>
              <div class="indicator">
                <i class="bx bx-up-arrow-alt"></i>
                <span class="text">Depuis hier</span>
              </div>
            </div>
            <i class="bx bxs-cart-add cart two"></i>
          </div>
          <div class="box">
            <div class="right-side">
              <div class="box-topic">Produit</div>
              <div class="number"><?php echo getAllProduit()['nbre']; ?></div>
              <div class="indicator">
                <i class="bx bx-up-arrow-alt"></i>
                <span class="text">Depuis hier</span>
              </div>
            </div>
            <i class="bx bx-cart cart three"></i>
          </div>
        
        </div>

        <div class="sales-boxes">
          <div class="recent-sales box">
            <div class="title">Demande recentes</div>
            <?php
        $demandes =  getLastDemande();
         ?>   
            <div class="sales-details">
              <ul class="details">
                <li class="topic">Date</li>
                <?php
        foreach ($demandes as $key => $value) {
          ?>
           <li><a href="#"><?php echo date('d M Y', strtotime($value['date_demande']))?></a></li>
         <?php
     
        }
        
        ?>
              </ul>
              <ul class="details">
                <li class="topic">Employé</li>
                <?php
        foreach ($demandes as $key => $value) {
          ?>
           <li><a href="#"><?php echo $value ['nom']." ".$value['prenom']?></a></li>
         <?php
     
        }
        ?>
              </ul>
              <ul class="details">
                <li class="topic">Produit</li>
                <?php
        foreach ($demandes as $key => $value) {
          ?>
           <li><a href="#"><?php echo $value ['nom_produit']?></a></li>
         <?php
     
        }
        ?>
               
              </ul>
              <ul class="details">
                
              </ul>
            </div>
            <div class="button">
              <a href="#">Voir Tout</a>
            </div>
          </div>
          <div class="top-sales box">
            <div class="title">Produit le plus demande</div>
            <ul class="top-sales-details">
            <?php
        $produit = getMostDemande();
        foreach ($produit as $key => $value) {
          ?>
          <li>
                <a href="#">
                  <!--<img src="images/sunglasses.jpg" alt="">-->
                  <span class="product"><?php echo $value ['nom_produit']?></span>
                </a>
              </li>
          <?php
        }
        ?>
            
            </ul>
          </div>
        </div>
      </div>
    </section>

    <?php 
include 'pied.php';
?>
