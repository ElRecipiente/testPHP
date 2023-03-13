<?php
// On recupere la session courante
session_start();

// On inclue le fichier de configuration et de connexion a la base de donn�es
include('includes/config.php');


if (strlen($_SESSION['login']) == 0) {
     // Si l'utilisateur est d�connect�
     // L'utilisateur est renvoy� vers la page de login : index.php
     header('location:index.php');
     exit();
} else {
     // On r�cup�re l'identifiant du lecteur dans le tableau $_SESSION
     echo "ID de session : ";
     echo $_SESSION['rdid'];
     $rdid = $_SESSION['rdid'];

     // On veut savoir combien de livres ce lecteur a emprunte
     // On construit la requete permettant de le savoir a partir de la table tblissuedbookdetails
     // On stocke le r�sultat dans une variable

     // On veut savoir combien de livres ce lecteur n'a pas rendu
     // On construit la requete qui permet de compter combien de livres sont associ�s � ce lecteur avec le ReturnStatus � 0 

     // On stocke le r�sultat dans une variable
     $sql = "SELECT * FROM tblissuedbookdetails WHERE ReaderID = :readerid";
     $stmt = $dbh->prepare($sql);
     $stmt->bindParam(':readerid', $rdid);
     $stmt->execute();

     $results = $stmt->fetchAll(PDO::FETCH_OBJ);
?>

     <!DOCTYPE html>
     <html lang="FR">

     <head>
          <meta charset="utf-8" />
          <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
          <title>Gestion de librairie en ligne | Tableau de bord utilisateur</title>
          <!-- BOOTSTRAP CORE STYLE  -->
          <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
          <!-- FONT AWESOME STYLE  -->
          <link href="assets/css/font-awesome.css" rel="stylesheet" />
          <!-- CUSTOM STYLE  -->
          <link href="assets/css/style.css" rel="stylesheet" />
     </head>

     <body>
          <!--On inclue ici le menu de navigation includes/header.php-->
          <?php include('includes/header.php'); ?>
          <!-- On affiche le titre de la page : Tableau de bord utilisateur-->
          <style>
               h3 {
                    text-align: center;
                    margin: 0;
                    padding: 0;
               }

               p {
                    margin: 0;
                    padding: 0;
                    text-align: center;
               }

               div.flex {
                    display: flex;
                    flex-flow: row;
                    justify-content: center;
                    margin: 0 auto;
               }

               div.flex div {
                    padding: 1em;
                    margin: 1em;
                    border: solid black 1px;
                    border-radius: 1em;
               }
          </style>
          <h3>TABLEAU DE BORD UTILISATEUR</h3>
          <div class="flex">
               <!-- On affiche la carte des livres emprunt�s par le lecteur-->
               <div><!-- Carte empruntés-->
                    <h4>Livres empruntés :</h4>
                    <br>
                    <?php
                    $booktook = 0;
                    foreach ($results as $result) {
                         if (!empty($result->IssuesDate)) {
                              $booktook++;
                         }
                    }
                    if ($booktook != 0) {
                         echo "<p>$booktook</p>";
                    } else {
                         echo "<p>Aucun</p>";
                    } ?>
               </div>

               <!-- On affiche la carte des livres non rendus le lecteur-->
               <div><!-- Carte non rendus-->
                    <h4>Livres non rendus :</h4>
                    <?php
                    $bookback = 0;
                    foreach ($results as $result) {
                         if (!empty($result->ReturnStatus)) {
                              $bookback++;
                         }
                    }
                    if ($bookback != 0) {
                         echo "<p>$bookback</p>";
                    } else {
                         echo "<p>Aucun</p>";
                    } ?>
               </div>
          </div>


          <?php include('includes/footer.php'); ?>
          <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
          <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
     </body>

     </html>
<?php } ?>