<?php
include 'connexion.php';

function getProduit($id = null, $searchDATA = array()) {
    global $connexion;

    if (!empty($id)) {
        $sql = "SELECT nom_produit, libelle_categorie, prix_unitaire, quantite, id_categorie, stock_initial, p.id_produit 
        FROM produits AS p, categorie AS c WHERE p.id_categorie=c.id AND id_produit=?";
        $req = $connexion->prepare($sql);
        $req->execute(array($id));
        return $req->fetch();
    } elseif (!empty($searchDATA)) {
        $search = "";
        extract($searchDATA);

        if (!empty($nom_produit)) $search .= " AND p.nom_produit LIKE '%$nom_produit%' ";
        $sql = "SELECT nom_produit, libelle_categorie, prix_unitaire, quantite, id_categorie, stock_initial, p.id_produit
        FROM produits AS p, categorie AS c WHERE p.id_categorie=c.id $search";
        $req = $connexion->prepare($sql);
        $req->execute();
        return $req->fetchAll();
    } else {
        $sql = "SELECT nom_produit, libelle_categorie, prix_unitaire, quantite, id_categorie, stock_initial, p.id_produit
        FROM produits AS p, categorie AS c WHERE p.id_categorie=c.id";
        $req = $connexion->prepare($sql);
        $req->execute();
        return $req->fetchAll();
    }
}

function getAllProduits() {
    global $connexion;
    $sql = "SELECT id_produit, nom_produit, stock_initial, quantite FROM produits";
    $req = $connexion->prepare($sql);
    $req->execute();
    return $req->fetchAll();

    
}


function getEmploye($id = null) 
{
    global $connexion;

    if (!empty($id)) {
        $sql = "SELECT e.nom, e.prenom, e.adresse, e.telephone, de.libelle_departement, e.id_departement, e.id_employe
                FROM employes AS e
                JOIN departement AS de ON e.id_departement = de.id
                WHERE e.id_employe = ?";
        $req = $connexion->prepare($sql);
        $req->execute(array($id));
        return $req->fetch();
    } else {
        $sql = "SELECT e.nom, e.prenom, e.adresse, e.telephone, de.libelle_departement, e.id_departement, e.id_employe
                FROM employes AS e
                JOIN departement AS de ON e.id_departement = de.id";
        $req = $connexion->prepare($sql);
        $req->execute();
        return $req->fetchAll();
    }
}



function getDemande($id = null) 
{
    global $connexion;

    if (!empty($id)) {
        $sql = "SELECT nom_produit, nom, prenom, d.quantite, date_demande
                FROM demande AS d
                JOIN produits AS p ON d.id_produit = p.id_produit
                JOIN employes AS e ON d.id_employe= e.id_employe
                WHERE d.id = ?";
        $req = $connexion->prepare($sql);
        $req->execute(array($id));
        return $req->fetch();
    } else {
        $sql = "SELECT nom_produit, nom, prenom, d.quantite, date_demande
                FROM demande AS d
                JOIN produits AS p ON d.id_produit = p.id_produit
                JOIN employes AS e ON d.id_employe = e.id_employe";
        $req = $connexion->prepare($sql);
        $req->execute();
        return $req->fetchAll();
    }
}
function getFournisseur($id = null) 
{
    global $connexion;

    if (!empty($id)) {
        $sql = "SELECT * FROM fournisseur WHERE id= ?";
        $req = $connexion->prepare($sql);
        $req->execute(array($id));
        return $req->fetch();
    } else {
        $sql = "SELECT * FROM fournisseur";
        $req = $connexion->prepare($sql);
        $req->execute();
        return $req->fetchAll();
    }
}

function getCommande($id = null) 
{
    global $connexion;

    if (!empty($id)) {
        $sql = "SELECT c.id, p.nom_produit, f.nom, f.prenom, c.quantite, c.date_commande
                FROM commande AS c
                JOIN produits AS p ON c.id_produit = p.id_produit
                JOIN fournisseur AS f ON c.id_fournisseur = f.id
                WHERE c.id = ?";
        $req = $connexion->prepare($sql);
        $req->execute(array($id));
        return $req->fetch();
    } else {
        $sql = "SELECT c.id, p.nom_produit, f.nom, f.prenom, c.quantite, c.date_commande
                FROM commande AS c
                JOIN produits AS p ON c.id_produit = p.id_produit
                JOIN fournisseur AS f ON c.id_fournisseur = f.id";
        $req = $connexion->prepare($sql);
        $req->execute();
        return $req->fetchAll();
    }
}
function getAllCommande(){
    $sql = "SELECT COUNT(*) AS nbre FROM commande";

    $req = $GLOBALS['connexion']->prepare($sql);
    
    $req->execute();
    
    return $req->fetch();
}

function getAllDemande(){
    $sql = "SELECT COUNT(*) AS nbre FROM demande";

    $req = $GLOBALS['connexion']->prepare($sql);
    
    $req->execute();
    
    return $req->fetch();
}
function getAllProduit(){
    $sql = "SELECT COUNT(*) AS nbre FROM produits";

    $req = $GLOBALS['connexion']->prepare($sql);
    
    $req->execute();
    
    return $req->fetch();
}

function getLastDemande() 
{
   
        $sql = "SELECT nom_produit, nom, prenom, d.quantite, date_demande
                FROM demande AS d
                JOIN produits AS p ON d.id_produit = p.id_produit
                JOIN employes AS e ON d.id_employe = e.id_employe
                ORDER BY date_demande
                DESC LIMIT 10";

     $req = $GLOBALS['connexion']->prepare($sql);

        $req->execute();

        return $req->fetchAll();
    
}

function getMostDemande() 
{
   
        $sql = "SELECT nom_produit
                FROM demande AS d
                JOIN produits AS p ON d.id_produit = p.id_produit
                JOIN employes AS e ON d.id_employe = e.id_employe 
                 GROUP BY d.id 
                ORDER BY date_demande
                DESC LIMIT 10";

     $req = $GLOBALS['connexion']->prepare($sql);
     
        $req->execute();

        return $req->fetchAll();
    
}

function getCategorie($id = null) 
{
    global $connexion;

    if (!empty($id)) {
        $sql = "SELECT * FROM categorie WHERE id = ?";
        $req = $connexion->prepare($sql);
        $req->execute(array($id));
        return $req->fetch();
    } else {
        $sql = "SELECT * FROM categorie";

        $req = $GLOBALS['connexion']->prepare($sql);
     
        $req->execute();
        return $req->fetchAll();
    }
}
function getDepartement($id = null) 
{
    global $connexion;

    if (!empty($id)) {
        $sql = "SELECT * FROM departement WHERE id = ?";
        $req = $connexion->prepare($sql);
        $req->execute(array($id));
        return $req->fetch();
    } else {
        $sql = "SELECT * FROM departement";

        $req = $GLOBALS['connexion']->prepare($sql);
     
        $req->execute();
        return $req->fetchAll();
    }
}


?>
