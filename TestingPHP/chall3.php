<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="author" content="">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Roboto+Mono:wght@400;700&display=swap');

        body {
            font-family: "Roboto Mono", mono;
            color: #272838;
            margin: 0;
            padding: 3em;
            box-sizing: border-box;
        }

        h2 {
            color: #EB9486;
            margin-top: 3em;
        }

        div {
            background: black;
            color: white;
            padding: 10px;
        }
    </style>
    <title>Challenges PHP : #2</title>
</head>

<body>
    <h1>Exercices PHP: Challenge 3</h1>

    <hr />

    <p>Dans ce challenge on va voir comment accéder à nos bases de données</p>

    <h2>Exercice 1 : Se connecter, et SELECT</h2>
    <ol>
        <li>
            En suivant le tutoriel, connectez vous à la base de données
            <ul>
                <li>host : localhost</li>
                <li>dbname : projets-php</li>
                <li>user : root</li>
                <li>password : (vide)</li>
            </ul>
        </li>
        <li>Créez une variable qui stocke votre requête SQL qui permet d'accéder à tous les attributs de toustes les utilisateurices</li>
        <li>prepare</li>
        <li>execute</li>
        <li>fetchAll</li>
        <li>foreach</li>
    </ol>

    <div>
        <?php

        $host = 'localhost';
        $dbname = 'projets-php';
        $username = 'root';
        $password = "";

        try {
            $db = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Étape 2 : Préparer la requête SQL
            $sql = "SELECT * FROM users";
            $stmt = $db->prepare($sql);

            // Étape 3 : Binder les valeurs des paramètres de la requête avec les valeurs des variables (optionel car pas de variables ici)

            // Étape 4 : Exécuter la requête
            $stmt->execute();

            // Étape 5 : Récupérer les résultats sous forme d'un tableau associatif
            $resultats = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // Étape 6 : Parcourir le tableau associatif et afficher les résultats

            foreach ($resultats as $users) {
                echo $users['name'] . " " . $users['email'] . " " . $users['country'] . " " . $users['favouriteBook'] . " " . "<br>";
                echo var_dump($users);
            }


            //
        } catch (PDOException $e) {
            echo "Erreur : " . $e->getMessage();
            die();
        }

        $db = null;

        // Try / catch + new PDO

        // SQL Query

        // Statement (prepare)

        // Execute statement

        // Fetch all data

        ?>
    </div>



    <h2>Exercice 2 : Des SELECT plus complexes</h2>
    <ol>
        <li>En reprenant la structure de l'exercice précédant, affichez seulement les utilisateurices qui sont en France</li>
        <li>Affichez seulement les utilisateurices dont le nom commence par C</li>
        <li>Affichez seulement les utilisateurices dont le livre préféré est le livre de M. Scott</li>
    </ol>
    <p>Indice: WHERE, LIKE</p>

    <div>
        <?php

        try {
            $db = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "SELECT * FROM users WHERE country = 'fr'";
            //
            $stmt = $db->prepare($sql);
            //
            $stmt->execute();

            // 
            $resultats = $stmt->fetchAll(PDO::FETCH_ASSOC);
            //
            foreach ($resultats as $users) {
                echo "Users WHERE fr<br>";
                echo $users['name'] . " " . $users['email'] . " " . $users['country'] . " " . $users['favouriteBook'] . " " . "<br>";
                echo var_dump($users);
            }

            $sql = "SELECT * FROM users WHERE name LIKE 'C%'";
            //
            $stmt = $db->prepare($sql);
            //
            $stmt->execute();

            // 
            $resultats = $stmt->fetchAll(PDO::FETCH_ASSOC);
            //
            foreach ($resultats as $users) {
                echo "Users LIKE C<br>";
                echo $users['name'] . " " . $users['email'] . " " . $users['country'] . " " . $users['favouriteBook'] . " " . "<br>";
                echo var_dump($users);
            }

            $sql = "SELECT * FROM users WHERE favouriteBook = 6";
            $stmt = $db->prepare($sql);
            $stmt->execute();
            $resultats = $stmt->fetchAll(PDO::FETCH_ASSOC);

            foreach ($resultats as $users) {
                echo "Users WHERE favouriteBook = M. Scott<br>";
                echo $users['name'] . " " . $users['email'] . " " . $users['country'] . " " . $users['favouriteBook'] . " " . "<br>";
                echo var_dump($users);
            }


            //
        } catch (PDOException $e) {
            echo "Erreur : " . $e->getMessage();
            die();
        }

        $db = null;

        ?>
    </div>


    <h2>Exercice 3 : Jointures</h2>
    <ul>
        <li>
            Le PHP ne va pas beaucoup changer ici. On va travailler sur la requête SQL avant tout.
        </li>
        <li>
            La syntaxe est la suivante Syntaxe : SELECT table1.attr, table2.attr FROM table1 JOIN table2 ON table1.attr = table2.attr;
        </li>
    </ul>

    <div>
        <?php
        try {
            $db = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "SELECT users.*, books.* FROM users JOIN books ON users.favouriteBook = books.id";
            //
            $stmt = $db->prepare($sql);
            //
            $stmt->execute();

            // 
            $resultats = $stmt->fetchAll(PDO::FETCH_ASSOC);
            //
            foreach ($resultats as $users) {
                echo "Users JOIN Book<br>";
                echo $users['name'] . " " . $users['title'] . "<br><br>";
                echo var_dump($users);
                echo "<br>";
            }
        } catch (PDOException $e) {
            echo "Erreur : " . $e->getMessage();
            die();
        }

        $db = null;
        ?>
    </div>

    <h2>Exercice 4 : Ajoutez une nouvelle entrée en base</h2>
    <p>Utilisez la requête INSERT pour ajouter une entrée dans votre base de données (sans formulaire pour l'instant).</p>
    <p>Pensez à commenter votre code après avoir vérifié que l'entrée a bien été ajoutée en base de données</p>



    <?php

    $name = "Nicow";
    $email = "nicow@mail.com";
    $country = "fr";
    $favouriteBook = 3;

    try {
        $db = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::FETCH_ASSOC);
        $sql = "INSERT INTO users (name, email, country, favouriteBook) VALUES (:name, :email, :country, :favouriteBook)";
        $stmt = $db->prepare($sql);

        //bind values
        $stmt->bindParam(":name", $name);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":country", $country);
        $stmt->bindParam(":favouriteBook", $favouriteBook);

        // $stmt->execute();

        // if ($stmt->rowCount() > 0) {
        //     echo "Insertion réussie.";
        // } else {
        //     echo "Erreur lors de l'insertion.";
        // }

        //
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
        die();
    }

    $db = null;
    ?>



    <h2>Exercice 5 : Ajoutez une nouvelle entrée en base (via un formulaire)</h2>
    <p>Cette fois créez un formulaire qui permet de créer une nouvelle entrée dans la table Users</p>

    <ul>
        <li>Créez un form, avec les bons input à l'intérieur (pour le livre préféré, vous pouvez pour l'instant vous contenter de demander un chiffre à l'utilisateurice)</li>
        <li>Ce form doit être en POST, et envoyez les données vers une page add_user.php</li>
        <li>
            Vous pouvez vous inspirer de code de <a href="https://phpdelusions.net/pdo_examples/insert">cette page</a> pour voir comment récupérer vos données et les insérer en base. J'ai aussi tapé <a href="https://www.notion.so/PDO-c8ba63626482479c97c604fd77578609">ce mini résumé</a>
        </li>
    </ul>


    <?php

    try {
        $db = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::FETCH_ASSOC);

        //
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
        die();
    }

    $db = null;

    ?>

</body>

</html>