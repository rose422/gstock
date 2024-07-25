<?php 
include 'entete.php'; 
session_start();

if (isset($_SESSION['id']) && isset($_SESSION['username'])) {
?>
    <div class="home-content">
        <h1>Bienvenu cliquez pour commencer </h1>
        <a href="logout.php">Déconnexion</a>
    </div>
<?php 
} else {
    header("Location: index.php");
    exit();
}

include 'pied.php'; 
?>
