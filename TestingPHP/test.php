<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test PHP</title>
</head>

<body>

    <?php

    $fichier = fopen("exemple2.txt", "c+b");
    fwrite($fichier, 'Un premier texte dans mon fichier');
    fwrite($fichier, 'Un premier texte dans mon fichier');

    ?>

    <p>Brouette accomplished</p>

</body>

</html>