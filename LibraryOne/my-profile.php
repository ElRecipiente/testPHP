<?php
// On r�cup�re la session courante
session_start();

// On inclue le fichier de configuration et de connexion � la base de donn�es
include('includes/config.php');
// Si l'utilisateur n'est plus logu�
// On le redirige vers la page de login
if (strlen($_SESSION['login']) == 0) {
    header('location:index.php');
    exit();
} else {
    // Sinon on peut continuer.   
    // On souhaite voir la fiche de lecteur courant.
    // On recupere l'id de session dans $_SESSION
    $rdid = $_SESSION['rdid'];

    // On prepare la requete permettant d'obtenir TOUT
    $sql = "SELECT * FROM tblreaders WHERE ReaderID = :rdid";
    $stmt = $dbh->prepare($sql);
    $stmt->bindParam(':rdid', $rdid);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_OBJ);

    //Apr�s soumission du formulaire de profil 
    // On recupere le nom complet du lecteur
    if (!empty($_POST["fullname"])) {
        $fullname = $_POST["fullname"];
    } else {
        $fullname = $result->FullName;
    }

    // On récupère le numéro de portable
    if (!empty($_POST["mobilenumber"])) {
        $mobilenumber = $_POST["mobilenumber"];
    } else {
        $mobilenumber = $result->MobileNumber;
    }

    // On récupère l'email
    if (!empty($_POST["emailid"])) {
        $emailid = $_POST["emailid"];
    } else {
        $emailid = $result->EmailId;
    }

    // On update la table tblreaders avec ces valeurs
    if (!empty($_POST["emailid"]) ||  !empty($_POST["mobilenumber"]) || !empty($_POST["fullname"])) {
        $sql = "UPDATE tblreaders SET FullName = :fullname, EmailId = :emailid, MobileNumber = :mobilenumber WHERE ReaderID = :rdid";
        $stmt = $dbh->prepare($sql);
        $stmt->bindParam(":rdid", $rdid);
        $stmt->bindParam(":fullname", $fullname);
        $stmt->bindParam(":emailid", $emailid);
        $stmt->bindParam(":mobilenumber", $mobilenumber);
        $stmt->execute();

        echo "<script>alert('Changement effectué')</script>;";

        // On informe l'utilisateur du resultat de l'operation
    }
}
?>

<!DOCTYPE html>
<html lang="FR">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />

    <title>Gestion de bibliotheque en ligne | Profil</title>
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
    <!--On affiche le titre de la page : EDITION DU PROFIL-->

    <!--On affiche le formulaire-->
    <div class="container">
        <div class="row">
            <div class="col">
                <h3>EDITION DU PROFIL</h3>
                <form action="my-profile.php" method="POST">

                    <!--On affiche l'identifiant - non editable-->
                    <div class="form-group">
                        <label for="rdid">Identifiant : </label>
                        <?php echo $rdid; ?>
                    </div>
                    <div class="form-group">
                        <label for="regdate">Date d'enregistrement : </label>
                        <?php if (!empty($result->RegDate)) {
                            echo "$result->RegDate";
                        } else {
                            echo "Inconnu";
                        } ?>
                    </div>
                    <div class="form-group">
                        <label for="updatedate">Dernière mise à jour : </label>
                        <?php if (!empty($result->UpdateDate)) {
                            echo "$result->UpdateDate";
                        } else {
                            echo "Pas encore mis à jour";
                        } ?>
                    </div>
                    <div class="form-group">
                        <label for="statut">Statut : </label>
                        <?php if ($result->Status == 1) {
                            echo "<span style='color:green;'>Actif</span>";
                        } else {
                            echo "<span style='color:red;'>Inactif</span>";
                        } ?>
                    </div>
                    <div class="form-group">
                        <label for="fullname">Nom complet : </label>
                        <input type="text" name="fullname" id="fullname" placeholder="<?php echo $result->FullName; ?>">
                    </div>
                    <div class="form-group">
                        <label for="mobilenumber">Téléphone : </label>
                        <input type="text" name="mobilenumber" id="mobilenumber" placeholder="<?php echo $result->MobileNumber; ?>">
                    </div>
                    <div class=" form-group">
                        <label for="emailid">Email : </label>
                        <input type="email" name="emailid" id="emailid" placeholder="<?php echo $result->EmailId; ?>">
                    </div>
                    <div class=" form-group">
                        <input type="submit" value="Mettre à jour" id="button">
                    </div>
                </form>
            </div>
        </div>
    </div>


    <!--On affiche la date d'enregistrement - non editable-->

    <!--On affiche la date de derniere mise a jour - non editable-->

    <!--On affiche la statut du lecteur - non editable-->

    <!--On affiche le nom complet - editable-->

    <!--On affiche le numero de portable- editable-->

    <!--On affiche l'email- editable-->

    <?php include('includes/footer.php'); ?>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>

</html>