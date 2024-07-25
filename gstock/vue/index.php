<!DOCTYPE html>
<html>
<head>
	<title>LOGIN</title>
	<link rel="stylesheet" type="text/css" href="../public/css/style.css">
</head>
<body class="index-page">
     <form action="login.php" method="post">
     	<h2>Connexion</h2>
     	<?php if (isset($_GET['error'])) { ?>
     		<p class="error"><?php echo $_GET['error']; ?></p>
     	<?php } ?>
     	<label>utilisateur</label>
     	<input type="text" name="uname" placeholder="User Name"><br>

     	<label>mot de passe </label>
     	<input type="password" name="password" placeholder="Password"><br>

     	<button type="submit">connectez-vous</button>
     </form>
</body>
</html>
