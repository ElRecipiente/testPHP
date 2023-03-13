<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire</title>
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

        form {
            width: 50%;
            margin: 0 auto;
        }
    </style>
</head>

<body>

    <form action="http://localhost/chall_php/add_user.php" method="POST">

        <fieldset>
            <legend>Inscription</legend>
            <label for="name">Firstname Lastname</label><br>
            <input type="text" name="name" maxlength="30" id="name" placeholder="Firstname Lastname" required><br>

            <label for="email">Mail</label><br>
            <input type="email" name="email" maxlength="30" id="email" placeholder="mail@mail.com" required><br>

            <label for="country">Country</label><br>
            <input type="text" minlength="2" maxlength="2" name="country" id="country" placeholder="fr" required><br>

            <label for="favouriteBook">Your Favourite Book</label><br>
            <select name="favouriteBook" id="favouriteBook"><br>
                <option value="">Choose a book here</option>
                <?php
                $host = 'localhost';
                $dbname = 'projets-php';
                $username = 'root';
                $password = "";
                //
                try {
                    $db = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
                    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                    $sql = "SELECT * FROM books";
                    $stmt = $db->prepare($sql);
                    $stmt->execute();
                    $resultats = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    //
                    foreach ($resultats as $users) {
                        echo "<option value='{$users['id']}'>{$users['title']}</option>";
                    }
                } catch (PDOException $e) {
                    echo "Erreur : " . $e->getMessage();
                    die();
                }

                $db = null;
                ?>
            </select>

            <input type="submit" value="Envoyer">


        </fieldset>

    </form>

</body>

</html>