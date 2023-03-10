<?php
// On r�cup�re la session courante
session_start();

// On inclue le fichier de configuration et de connexion � la base de donn�es
include('includes/config.php');

// Si l'utilisateur n'est pas connecte, on le dirige vers la page de login
if (strlen($_SESSION['login']) == 0) {
    header('location:index.php');
    exit();
} else {
    $rdid = $_SESSION['rdid'];
    //A FAIRE
    // Sinon on peut continuer
    //	Si le bouton de suppression a ete clique($_GET['del'] existe)
    //On recupere l'identifiant du livre
    // On supprime le livre en base
    // On redirige l'utilisateur vers issued-book.php


}
?>

<!DOCTYPE html>
<html lang="FR">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />

    <title>Gestion de bibliotheque en ligne | Gestion des livres</title>
    <!-- BOOTSTRAP CORE STYLE  -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <!-- FONT AWESOME STYLE  -->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <!-- CUSTOM STYLE  -->
    <link href="assets/css/style.css" rel="stylesheet" />
</head>

<body>
    <style>
        h3 {
            text-align: center;
            margin: 1em;
        }

        table {
            margin: 0 auto;
        }

        th {
            padding: 1em;
            border: solid black 1px;
            background-color: #404060;
            color: white;
        }

        td {
            padding: 1em;
            border: solid black 1px;
            text-align: center;
        }

        td#del {
            background-color: red;
            border: none;
            color: white;
            font-weight: bolder;
        }
    </style>
    <!--On insere ici le menu de navigation T-->
    <?php include('includes/header.php'); ?>
    <!-- On affiche le titre de la page : LIVRES SORTIS -->
    <h3>LIVRES SORTIS</h3>
    <div class="tableau">
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Titre</th>
                    <th>ISBN</th>
                    <th>Date de sortie</th>
                    <th>Date de retour</th>
                </tr>
            </thead>
            <tbody>

                <?php
                //on crée la requête SQL
                //$sql = "SELECT * FROM tblreaders JOIN tblissuedbookdetails ON tblreaders.ReaderId = tblissuedbookdetails.ReaderID WHERE ReaderID = :rdid";
                $sql = "SELECT * FROM tblissuedbookdetails WHERE ReaderID = :rdid";
                //On la prépare dans un statement
                $stmt = $dbh->prepare($sql);
                $stmt->bindParam(":rdid", $rdid);
                //On l'exécute
                $stmt->execute();
                //On la stocke
                $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

                // var_dump($results);

                foreach ($results as $book) {
                    echo "<tr><td>{$book['id']}</td>";
                    echo "<td>{$book['BookId']}</td>";
                    echo "<td>{$book['BookId']}</td>";
                    echo "<td>{$book['IssuesDate']}</td>";
                    echo "<td>{$book['ReturnDate']}</td></tr>";
                }

                ?>
                <!-- <td>x</td>
                    <td>x</td>
                    <td>x</td>
                    <td>x</td>
                    <td>x</td> -->
                <!-- <td id="del">DEL</td> -->

            </tbody>
        </table>
    </div>

    <!-- On affiche la liste des sorties contenus dans $results sous la forme d'un tableau -->
    <!-- Si il n'y a pas de date de retour, on affiche non retourne -->


    <?php include('includes/footer.php'); ?>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>

</html>