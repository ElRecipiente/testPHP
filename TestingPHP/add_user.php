<html>

<?php

//
if (isset($_POST["name"]) && $_POST["name"] != "") {
    $name = $_POST["name"];
    echo "name recup OK<br>";
} else {
    echo "NAME IS NOT OK<br>";
}

if (isset($_POST["email"]) && $_POST["email"] != "") {
    $email = $_POST["email"];
    echo "email recup OK<br>";
} else {
    echo "EMAIL IS NOT OK<br>";
}

if (isset($_POST["country"]) && $_POST["country"] != "") {
    $country = $_POST["country"];
    echo "country recup OK<br>";
} else {
    echo "COUNTRY IS NOT OK<br>";
}

if (isset($_POST["favouriteBook"]) && $_POST["favouriteBook"] != 0) {
    $favouriteBook = $_POST["favouriteBook"];
    echo "favouriteBook recup OK<br>";
} else {
    $favouriteBook = null;
    echo "L'utilisateur n'aime pas les livres.<br>";
}
//
$host = 'localhost';
$dbname = 'projets-php';
$username = 'root';
$password = "";
//
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

    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        echo "Insertion réussie.";
    } else {
        echo "Erreur lors de l'insertion.";
    }
} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
    die();
}

$db = null;
//
?>

</html>