<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test PHP</title>
</head>

<body>

    <?php
    // var connexion
    $host = 'localhost';
    $username = 'root';
    $password = "";
    $dbname = "pdodb";

    //var INSERT
    $nom = "'Richard'";
    $prenom = "'Pierre'";
    $adresse = "'Rue-Jean-Aicard'";
    $ville = "'Toulon'";
    $cp = 83000;
    $pays = "'France'";
    $mail = "'gg@gmail.com'),('a','b','c','d',1,'e','f'";

    //On essaie de se connecter
    try {
        $dbconnect = new PDO("mysql:host=$host; dbname=$dbname", $username, $password);

        //On définit le mode d'erreur de PDO sur Exception
        $dbconnect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        echo "Connexion réussie !<br><hr>";

        $dbconnect->beginTransaction();

        $sql = "INSERT INTO Clients(Nom,Prenom,Adresse,Ville,Codepostal,Pays,Mail) VALUES($nom,$prenom,$adresse,$ville,$cp,$pays,$mail)";

        $dbconnect->exec($sql);
        echo "Insertion complete !";


        //
    } catch (PDOException $e) {
        /*On capture les exceptions si une exception est lancée et on affiche
        *les informations relatives à celle-ci*/
        echo "Erreur : " . $e->getMessage();
    }

    //On ferme la dbconnect$dbconnect
    $dbconnect = null;

    ?>

</body>

</html>