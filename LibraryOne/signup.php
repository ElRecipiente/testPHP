<?php
// On récupère la session courante
session_start();

// On inclue le fichier de configuration et de connexion à la base de données
include('includes/config.php');

// Après la soumission du formulaire de compte (plus bas dans ce fichier)
// On vérifie si le code captcha est correct en comparant ce que l'utilisateur a saisi dans le formulaire
// $_POST["vercode"] et la valeur initialisée $_SESSION["vercode"] lors de l'appel à captcha.php (voir plus bas)
if (!empty($_POST['vercode']) && $_POST['vercode'] != $_SESSION['vercode']) {
    // Le code est incorrect on informe l'utilisateur par une fenetre pop_up
    echo "<script>alert('CAPTCHA incorrect')</script>";
} else if (!empty($_POST['password']) || $_POST['password'] != $_POST['passwordverif']) {
    echo "<script>alert('Les mots de passe ne sont pas identiques')</script>";
} else {
    //On lit le contenu du fichier readerid.txt au moyen de la fonction 'file'. Ce fichier contient le dernier identifiant lecteur cree.
    $readerid = file("readerid.txt");

    // On incrémente de 1 la valeur lue
    $readerid[0]++;

    //NIQUE
    file_put_contents("readerid.txt", $readerid);

    // On récupère le nom saisi par le lecteur
    if (!empty($_POST["fullname"])) {
        $fullname = $_POST["fullname"];
    }

    // On récupère le numéro de portable
    if (!empty($_POST["mobilenumber"])) {
        $mobilenumber = $_POST["mobilenumber"];
    }

    // On récupère l'email
    if (!empty($_POST["emailid"])) {
        $emailid = $_POST["emailid"];
    }

    // On récupère le mot de passe
    if (!empty($_POST["password"])) {
        $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
    }

    // On fixe le statut du lecteur à 1 par défaut (actif)
    $status = 1;

    // On prépare la requete d'insertion en base de données de toutes ces valeurs dans la table tblreaders
    $sql = "INSERT INTO tblreaders (ReaderId, FullName, EmailId, MobileNumber, Password, Status) VALUES (:readerid, :fullname, :emailid, :mobilenumber, :password, :status)";
    $stmt = $dbh->prepare($sql);
    $stmt->bindParam(":readerid", $readerid[0]);
    $stmt->bindParam(":fullname", $fullname);
    $stmt->bindParam(":emailid", $emailid);
    $stmt->bindParam(":mobilenumber", $mobilenumber);
    $stmt->bindParam(":password", $password);
    $stmt->bindParam(":status", $status);

    // On éxecute la requete
    $stmt->execute();

    // On récupère le dernier id inséré en bd (fonction lastInsertId)
    $lastId = $dbh->lastInsertId();

    // Si ce dernier id existe, on affiche dans une pop-up que l'opération s'est bien déroulée, et on affiche l'identifiant lecteur (valeur de $hit[0] ($readerid[0]))
    if ($lastId == $readerid[0]) {
        echo "<script>alert('Enregistrement terminé ! Votre identifiant est le'.$readerid[0].')</script>";
    } else if (!empty($_POST['vercode']) && $lastId != $readerid[0]) {
        // Sinon on affiche qu'il y a eu un problème
        // echo $lastId;
        // echo $readerid[0];
        echo "<script>alert('Une erreur est survenue, veuillez réessayer.');</script>";
    }
}
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
        // let mdp1 = document.getElementById("password");
        // let mdp2 = document.getElementById("passwordverif");

        // function valid() {

        //     if (mdp1.value == mdp2.value) {
        //         return true;
        //     } else {
        //         return false;
        //     }
        // };

        // On cree une fonction avec l'email passé en paramêtre et qui vérifie la disponibilité de l'email
        // Cette fonction effectue un appel AJAX vers check_availability.php
        async function checkAvailability(mail) {
            let response = await fetch(`./check_availability.php?emailid=${mail}`);
            data = await response.json;
            console.log(data);
            // let emailInput = document.getElementById("emailid");
        };
        // 
    </script>
</head>

<body>
    <!-- On inclue le fichier header.php qui contient le menu de navigation-->
    <?php include('includes/header.php'); ?>
    <!--On affiche le titre de la page : CREER UN COMPTE-->
    <div class="container">
        <div class="row">
            <div class="col">
                <h3>CREER UN COMPTE</h3>
                <!--On affiche le formulaire de creation de compte-->
                <form action="signup.php" method="POST" onSubmit="return valid()">
                    <div class="form-group">
                        <label for="fullname">Entrez votre nom complet</label>
                        <input type="text" name="fullname" id="fullname" required>
                    </div>
                    <div class="form-group">
                        <label for="emailid">Entrez votre email</label>
                        <input type="text" name="emailid" id="emailid" onBlur="checkAvailability(this.value)" required>
                    </div>
                    <div class="form-group">
                        <label for="mobilenumber">Entrez votre numéro de téléphone</label>
                        <input type="text" name="mobilenumber" id="mobilenumber" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Entrez votre mot de passe</label>
                        <input type="text" name="password" id="password" required>
                    </div>
                    <div class="form-group">
                        <label for="passwordverif">Vérifiez votre mot de passe</label>
                        <input type="text" name="passwordverif" id="passwordverif" required>
                    </div>
                    <div class="form-group">
                        <label>Code de vérification</label>
                        <input type="text" name="vercode" required style="height:25px;">&nbsp;&nbsp;&nbsp;<img src="captcha.php">
                    </div>
                    <div class="form-group">
                        <input type="submit" value="Envoyer" id="button">
                    </div>
            </div>
        </div>
    </div>


    </form>
    <!--A la suite de la zone de saisie du captcha, on insère l'image créée par captcha.php : <img src="captcha.php">  -->
    <!-- On appelle la fonction valid() dans la balise <form> onSubmit="return valid(); -->
    <!-- On appelle la fonction checkAvailability() dans la balise <input> de l'email onBlur="checkAvailability(this.value)" -->



    <?php include('includes/footer.php'); ?>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>

</html>