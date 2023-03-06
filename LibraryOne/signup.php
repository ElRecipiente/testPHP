<?php
// On récupère la session courante
session_start();

// On inclue le fichier de configuration et de connexion à la base de données
include('includes/config.php');

// Après la soumission du formulaire de compte (plus bas dans ce fichier)
// On vérifie si le code captcha est correct en comparant ce que l'utilisateur a saisi dans le formulaire
// $_POST["vercode"] et la valeur initialisée $_SESSION["vercode"] lors de l'appel à captcha.php (voir plus bas)
// if ($_POST['vercode'] != $_SESSION['vercode']) {
//     // Le code est incorrect on informe l'utilisateur par une fenetre pop_up
//     echo "<script>alert('Code de vérification incorrect')</script>";
// } else {
//On lit le contenu du fichier readerid.txt au moyen de la fonction 'file'. Ce fichier contient le dernier identifiant lecteur cree.
$value = file("readerid.txt")[0];

// On incrémente de 1 la valeur lue
$value++;

//NIQUE
file_put_contents("readerid.txt", $value);

// On récupère le nom saisi par le lecteur
$name = $_POST["name"];

// On récupère le numéro de portable
$telnumber = $_POST["telnumber"];

// On récupère l'email
$email = $_POST["email"];

// On récupère le mot de passe
$password = $_POST["password"];

// On fixe le statut du lecteur à 1 par défaut (actif)
$status = 1;

// On prépare la requete d'insertion en base de données de toutes ces valeurs dans la table tblreaders

// On éxecute la requete

// On récupère le dernier id inséré en bd (fonction lastInsertId)

// Si ce dernier id existe, on affiche dans une pop-up que l'opération s'est bien déroulée, et on affiche l'identifiant lecteur (valeur de $hit[0])

// Sinon on affiche qu'il y a eu un problème
// }
?>

<!DOCTYPE html>
<html lang="FR">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <!--[if IE]>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <![endif]-->
    <title>Gestion de bibliotheque en ligne | Signup</title>
    <!-- BOOTSTRAP CORE STYLE  -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <!-- FONT AWESOME STYLE  -->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <!-- CUSTOM STYLE  -->
    <link href="assets/css/style.css" rel="stylesheet" />
    <!-- GOOGLE FONT -->
    <!-- link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' / -->
    <script type="text/javascript">
        // On cree une fonction valid() sans paramètre qui renvoie 
        // TRUE si les mots de passe saisis dans le formulaire sont identiques
        // FALSE sinon

        // On cree une fonction avec l'email passé en paramêtre et qui vérifie la disponibilité de l'email
        // Cette fonction effectue un appel AJAX vers check_availability.php
    </script>
</head>

<body>
    <!-- On inclue le fichier header.php qui contient le menu de navigation-->
    <?php include('includes/header.php'); ?>
    <!--On affiche le titre de la page : CREER UN COMPTE-->
    <!--On affiche le formulaire de creation de compte-->
    <!--A la suite de la zone de saisie du captcha, on insère l'image créée par captcha.php : <img src="captcha.php">  -->
    <!-- On appelle la fonction valid() dans la balise <form> onSubmit="return valid(); -->
    <!-- On appelle la fonction checkAvailability() dans la balise <input> de l'email onBlur="checkAvailability(this.value)" -->



    <?php include('includes/footer.php'); ?>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>

</html>