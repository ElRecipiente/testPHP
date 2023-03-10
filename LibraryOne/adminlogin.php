<?php
// On demarre ou on recupere la session courante
session_start();

// On inclue le fichier de configuration et de connexion � la base de donn�es
include('includes/config.php');

// On invalide le cache de session $_SESSION['alogin'] = ''
if (isset($_SESSION['login']) && $_SESSION['alogin'] != '') {
    $_SESSION['alogin'] = '';
}

// A faire :
// Apres la soumission du formulaire de login (plus bas dans ce fichier)
// On verifie si le code captcha est correct en comparant ce que l'utilisateur a saisi dans le formulaire
// $_POST["vercode"] et la valeur initialis�e $_SESSION["vercode"] lors de l'appel a captcha.php (voir plus bas
if (!empty($_POST['vercode']) && $_POST['vercode'] != $_SESSION['vercode']) {
    // Le code est incorrect on informe l'utilisateur par une fenetre pop_up
    echo "<script>alert('CAPTCHA incorrect')</script>";
} else {
    // Le code est correct, on peut continuer
    // On recupere le nom de l'utilisateur saisi dans le formulaire
    if (!empty($_POST["username"])) {
        $username = $_POST["username"];
    }

    // On recupere le mot de passe saisi par l'utilisateur (et on le crypte/verify ?)
    if (!empty($_POST["password"])) {
        $password = $_POST["password"];
    }

    $sql = "SELECT UserName, Password FROM admin WHERE UserName = :username";
    $stmt = $dbh->prepare($sql);
    $stmt->bindParam(':username', $username);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_OBJ);

    // var_dump($result);

    if (!empty($result) && password_verify($_POST['password'], $result->Password)) {
        $_SESSION['alogin'] = $_POST['username'];
        echo "<script>alert('Welcome {$username}')</script>";
        header('location:dashboard_admin.php');
        exit();
    } else {
        echo "<script>alert('Identifiants incorrects, ressayez.')</script>";
    }
}
// On construit la requete qui permet de retrouver l'utilisateur a partir de son nom et de son mot de passe
// depuis la table admin



// Si le resultat de recherche n'est pas vide 
// On stocke le nom de l'utilisateur  $_POST['username'] en session $_SESSION
// On redirige l'utilisateur vers le tableau de bord administration (n'existe pas encore)

// sinon le login est refuse. On le signal par une popup

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />

    <title>Gestion de bibliotheque en ligne</title>
    <!-- BOOTSTRAP CORE STYLE  -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <!-- FONT AWESOME STYLE  -->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <!-- CUSTOM STYLE  -->
    <link href="assets/css/style.css" rel="stylesheet" />
</head>

<body>
    <!-- On inclue le fichier header.php qui contient le menu de navigation-->
    <?php include('includes/header.php'); ?>

    <div class="content-wrapper">
        <div class="container">
            <div class="row">
                <div class="col">
                    <h3>LOGIN ADMIN</h3>
                    <form action="adminlogin" method="POST" onSubmit="return valid()">
                        <div class="form-group">
                            <label for="username">Entrez votre email</label>
                            <input type="text" name="username" id="username" onBlur="checkAvailability(this.value)" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Entrez votre mot de passe</label>
                            <input type="text" name="password" id="password" required>
                        </div>
                        <div class="form-group">
                            <label>Code de vérification</label>
                            <input type="text" name="vercode" required style="height:25px;">&nbsp;&nbsp;&nbsp;<img src="captcha.php">
                        </div>
                        <div class="form-group">
                            <input type="submit" value="Envoyer" id="button">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- CONTENT-WRAPPER SECTION END-->
    <?php include('includes/footer.php'); ?>
    <!-- FOOTER SECTION END-->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>

</html>