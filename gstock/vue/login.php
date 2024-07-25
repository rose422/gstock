<?php 
session_start(); 
include 'entete.php';
include "../model/connexion.php";

if (isset($_POST['uname']) && isset($_POST['password'])) {

    function validate($data){
       $data = trim($data);
       $data = stripslashes($data);
       $data = htmlspecialchars($data);
       return $data;
    }

    $uname = validate($_POST['uname']);
    $pass = validate($_POST['password']);

    if (empty($uname)) {
        header("Location: index.php?error=User Name is required");
        exit();
    } else if(empty($pass)){
        header("Location: index.php?error=Password is required");
        exit();
    } else {
        // Préparation de la requête SQL avec PDO
        $sql = "SELECT * FROM users WHERE username = :uname AND password = :pass";
        $stmt = $connexion->prepare($sql);
        $stmt->bindParam(':uname', $uname, PDO::PARAM_STR);
        $stmt->bindParam(':pass', $pass, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        // Débogage
        if (!$result) {
            error_log("Aucun résultat trouvé pour l'utilisateur: $uname avec le mot de passe fourni.", 0);
        }

        if ($result) {
            $_SESSION['username'] = $result['username'];
            $_SESSION['name'] = $result['name'];
            $_SESSION['id'] = $result['id'];
            header("Location: home.php");
            exit();
        } else {
            header("Location: index.php?error=Incorrect User name or password");
            exit();
        }
    }
    
} else {
    header("Location: index.php");
    exit();
}
?>


