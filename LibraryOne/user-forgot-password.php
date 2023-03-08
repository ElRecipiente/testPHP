<?php
// On récupère la session courante
session_start();

// On inclue le fichier de configuration et de connexion à la base de données
include('includes/config.php');
// Après la soumission du formulaire de login ($_POST['change'] existe
// On verifie si le code captcha est correct en comparant ce que l'utilisateur a saisi dans le formulaire
// $_POST["vercode"] et la valeur initialisee $_SESSION["vercode"] lors de l'appel a captcha.php (voir plus bas)
if (!empty($_POST['vercode']) && $_POST['vercode'] != $_SESSION['vercode']) {
     // Le code est incorrect on informe l'utilisateur par une fenetre pop_up
     echo "<script>alert('CAPTCHA incorrect')</script>";
} else if (!empty($_POST['password']) || $_POST['password'] != $_POST['passwordverif']) {
     echo "<script>alert('Les mots de passe ne sont pas identiques')</script>";
} else {

     // Sinon on continue
     // on recupere l'email et le numero de portable saisi par l'utilisateur
     // et le nouveau mot de passe que l'on encode (fonction password_hash)

     if (!empty($_POST["mobilenumber"])) {
          $mobilenumber = $_POST["mobilenumber"];
     }

     if (!empty($_POST["emailid"])) {
          $emailid = $_POST["emailid"];
     }

     if (!empty($_POST["password"])) {
          $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
     }
     // On cherche en base le lecteur avec cet email et ce numero de tel dans la table tblreaders

     // Si le resultat de recherche n'est pas vide
     // On met a jour la table tblreaders avec le nouveau mot de passe
     // On informa l'utilisateur par une fenetre popup de la reussite ou de l'echec de l'operation
     // On prépare la requete d'insertion en base de données de toutes ces valeurs dans la table tblreaders
     $sql = "INSERT INTO tblreaders (Password) VALUES (:password)";
     $stmt = $dbh->prepare($sql);

     $stmt->bindParam(":password", $password);

     // On éxecute la requete
     $stmt->execute();
}
?>

<!DOCTYPE html>
<html lang="FR">

<head>
     <meta charset="utf-8" />
     <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />

     <title>Gestion de bibliotheque en ligne | Recuperation de mot de passe </title>
     <!-- BOOTSTRAP CORE STYLE  -->
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
     <!-- FONT AWESOME STYLE  -->
     <link href="assets/css/font-awesome.css" rel="stylesheet" />
     <!-- CUSTOM STYLE  -->
     <link href="assets/css/style.css" rel="stylesheet" />

     <script type="text/javascript">
          // On cree une fonction nommee valid() qui verifie que les deux mots de passe saisis par l'utilisateur sont identiques.
     </script>

</head>

<body>
     <!--On inclue ici le menu de navigation includes/header.php-->
     <?php include('includes/header.php'); ?>
     <!-- On insere le titre de la page (RECUPERATION MOT DE PASSE -->
     <div class="container">
          <div class="row">
               <div class="col">
                    <h3>RECUPERATION MOT DE PASSE</h3>
                    <!--On affiche le formulaire de creation de compte-->
                    <form action="user-forgot-password.php" method="POST" onSubmit="return valid()">
                         <div class="form-group">
                              <label for="emailid">Entrez votre email</label>
                              <input type="text" name="emailid" id="emailid" required>
                         </div>
                         <div class="form-group">
                              <label for="mobilenumber">Entrez votre numéro de téléphone</label>
                              <input type="text" name="mobilenumber" id="mobilenumber" required>
                         </div>
                         <div class="form-group">
                              <label for="password">Nouveau mot de passe</label>
                              <input type="text" name="password" id="password" required>
                         </div>
                         <div class="form-group">
                              <label for="passwordverif">Confirmez votre mot de passe</label>
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

     <!--On insere le formulaire de recuperation-->
     <!--L'appel de la fonction valid() se fait dans la balise <form> au moyen de la propri�t� onSubmit="return valid();"-->


     <?php include('includes/footer.php'); ?>
     <!-- FOOTER SECTION END-->
     <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
     <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>

</html>