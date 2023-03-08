CHECK AVAILABILITY
<?php

// On inclue le fichier de configuration et de connexion a la base de donnees
require_once("includes/config.php");
// On recupere dans $_GET l email soumis par l'utilisateur
$emailid = $_GET['emailid'];

// On verifie que l'email est un email valide (fonction php filter_var)
if (!filter_var($emailid, FILTER_VALIDATE_EMAIL)) {
	// Si ce n'est pas le cas, on fait un echo qui signale l'erreur
	echo "<script>alert('Email invalide')</script>";
} else {
	// Si c'est bon
	// On prepare la requete qui recherche la presence de l'email dans la table tblreaders
	// On execute la requete et on stocke le resultat de recherche
	$sql = "SELECT emailid FROM tblreaders";
	$stmt = $dbh->prepare($sql);
	$stmt->execute();
	$resultats = $stmt->fetchAll(PDO::FETCH_ASSOC);
	echo "<script>let button = document.getElementById('button');</script>";
	var_dump($resultats);
	foreach ($resultats as $mail) {
		var_dump($mail);
		if ($emailid == $mail['emailid']) {
			echo "<script>button.disabled = true;</script>";
			echo "<script>alert('Email déjà utilisé');</script>";
			echo "le mail est pas OK";
		} else {
			echo "<script>button.disabled = false;</script>";
			echo "le mail est OK";
		}
	}
}



// Si le resultat n'est pas vide. On signale a l'utilisateur que cet email existe deja et on desactive le bouton
// de soumission du formulaire

// Sinon on signale a l'utlisateur que l'email est disponible et on active le bouton du formulaire
?>