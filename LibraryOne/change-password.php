<?php
// On recupere la session courante
session_start();

// On inclue le fichier de configuration et de connexion � la base de donn�es
include('includes/config.php');

// Vérification login / redirection sinon to index.php
if (strlen($_SESSION['login']) == 0) {
	header('location:index.php');
	exit();
	//Je vérifie que les champs ne sont pas vides (ni remplis d'espace #TrimTheBest)
} else if (!empty($_POST['change']) && (empty(trim($_POST['oldpassword'])) || empty(trim($_POST['newpassword'])) || empty(trim($_POST['passwordverif'])))) {
	echo "<p class='error'>Vous devez remplir tous les champs.</p>";
	//Je vérifie que le nouveau password et sa vérif sont identiques
} else if (!empty($_POST['newpassword']) && $_POST['newpassword'] != $_POST['passwordverif']) {
	echo "<p class='error'>Le mot de passe de vérification n'est pas identique au nouveau mot de passe.</p>";
	//je vérifie que le nouveau mot de passe est différent du mot de passe existant
} else if (!empty($_POST['newpassword']) && $_POST['oldpassword'] == $_POST['newpassword']) {
	echo "<p class='error'>Votre ancien mot de passe est identique au nouveau, réessayez.</p>";
} else if (!empty($_POST['change'])) {
	// sinon, on peut continuer,
	// si le formulaire a ete envoye : $_POST['change'] 
	// On recupere le mot de passe et on le crypte (fonction php password_hash)
	$rdid = $_SESSION['rdid'];
	$newPassword = $_POST['newpassword'];
	$sql = "SELECT Password FROM tblreaders WHERE ReaderId = :rdid";
	$stmt = $dbh->prepare($sql);
	$stmt->bindParam(":rdid", $rdid);
	$stmt->execute();
	$result = $stmt->fetch(PDO::FETCH_ASSOC);
	// On recupere l'email de l'utilisateur dans le tableau $_SESSION
	// On cherche en base l'utilisateur avec ce mot de passe et cet email
	// Si le resultat de recherche n'est pas vide
	// On met a jour en base le nouveau mot de passe (tblreader) pour ce lecteur
	// On stocke le message d'operation reussie
	// sinon (resultat de recherche vide)
	// On stocke le message "mot de passe invalide"

	//Si le mot de passe du compte est le bon, l'opération continue, sinon, j'avertis l'utilisateur
	if (password_verify($_POST['oldpassword'], $result['Password'])) {
		$newPassword = password_hash($_POST['newpassword'], PASSWORD_DEFAULT);
		$sql = "UPDATE tblreaders SET `password`=:newpassword WHERE ReaderId = :rdid";
		$stmt = $dbh->prepare($sql);
		$stmt->bindParam(":newpassword", $newPassword);
		$stmt->bindParam(":rdid", $rdid);
		$stmt->execute();
		echo "<script>alert('Changement de mot de passe terminé !')</script>";
	} else {
		echo "<p class='error'>Veuillez renseigner votre mot de passe actuel.</p>";
	}
}




?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />

	<title>Gestion de bibliotheque en ligne | changement de mot de passe</title>
	<!-- BOOTSTRAP CORE STYLE  -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
	<!-- FONT AWESOME STYLE  -->
	<link href="assets/css/font-awesome.css" rel="stylesheet" />
	<!-- CUSTOM STYLE  -->
	<link href="assets/css/style.css" rel="stylesheet" />

	<!-- Penser au code CSS de mise en forme des message de succes ou d'erreur -->
	<style>
		.flexible {
			display: flex;
			flex-flow: column;
			align-items: center;
		}

		p.error {
			color: red;
			background-color: red;
			width: 100%;
			text-align: center;
			animation: redtowhite 0.4s forwards;
			margin: 0;
			padding: 0;
		}

		@keyframes redtowhite {
			100% {
				color: white;
			}
		}
	</style>

</head>
<!-- <script type="text/javascript">
	/* On cree une fonction JS valid() qui verifie si les deux mots de passe saisis sont identiques 
	Cette fonction retourne un booleen*/ 
	//Booleen non utilisé//
</script> -->

<body>
	<!-- Mettre ici le code CSS de mise en forme des message de succes ou d'erreur -->
	<?php include('includes/header.php'); ?>
	<!--On affiche le titre de la page : CHANGER MON MOT DE PASSE-->
	<!--  Si on a une erreur, on l'affiche ici // fait via php-->
	<!--  Si on a un message, on l'affiche ici // fait via php-->


	<!--On affiche le formulaire-->
	<!-- la fonction de validation de mot de passe est appelee dans la balise form : onSubmit="return valid();" why ?-->

	<div class="flexible">
		<h3>CHANGER MON MOT DE PASSE</h3>
		<form action="change-password.php" method="POST">
			<div class="form-group">
				<label for="oldpassword">Entrez votre mot de passe actuel</label>
				<input type="text" name="oldpassword" id="oldpassword" required>
			</div>
			<div class="form-group">
				<label for="newpassword">Entrez votre nouveau mot de passe</label>
				<input type="text" name="newpassword" id="newpassword" required>
			</div>
			<div class="form-group">
				<label for="passwordverif">Vérifiez votre nouveau mot de passe</label>
				<input type="text" name="passwordverif" id="passwordverif" required>
			</div>
			<div class="form-group">
				<input type="submit" value="Envoyer" id="button">
			</div>
			<input type="hidden" name="change" value="send">
		</form>
	</div>


	<?php include('includes/footer.php'); ?>
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>

</html>