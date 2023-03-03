<!DOCTYPE html>
<html>

<head>
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

        img {
            width: 100px;
        }
    </style>
    <title>Challenges PHP : #1</title>
</head>

<body>

    <?php $nbExo = 1; ?>

    <h1>Exercices PHP: Challenge 1</h1>

    <hr />

    <p>Dans ce challenge on revoit les bases de la programmation, mais en PHP. Habituez-vous à la syntaxe, et n'oubliez pas les ; !</p>

    <h2>Exercice <?php echo ($nbExo++); ?> : variables</h2>
    <ul>
        <li>Déclarez une variable appelée age, initialisez la avec une valeur</li>
        <li>Incrémentez la de 1 et affichez là à l'emplacement prévu</li>
    </ul>
    <?php

    $age = 5;
    $age++;

    ?>
    <p>Mon âge est : <?php echo $age ?> ans.</p>



    <h2>Exercice <?php echo ($nbExo++); ?> : boucles A</h2>
    <ul>
        <li>Créez une boucle for qui affiche les chiffres de 1 à 10</li>
    </ul>
    <?php
    for ($i = 1; $i <= 10; $i++) {
        echo "<br>{$i}";
    };

    ?>



    <h2>Exercice <?php echo ($nbExo++); ?> : boucles B</h2>
    <ul>
        <li>Créez une boucle for qui affiche les chiffres de 11 à 15</li>
        <li>Mais cette fois dans une structure ul / li</li>
    </ul>
    <b>Ma liste</b>
    <ul> <!-- j'ai créé le ul pour vous, de rien -->
        <?php
        for ($i; $i <= 15; $i++) {
            echo "<li>{$i}</li>";
        };

        ?>
    </ul>



    <h2>Exercice <?php echo ($nbExo++); ?> : boucle C</h2>
    <ul>
        <li>Déclarez un tableau qui contient 5 chaines de caractères</li>
        <li>Affichez ces éléments dans un ol / li grâce à une boucle for</li>
        <li>Dans un ul / li maintenant, affichez les éléments dont la longueur est supérieure à 5</li>
        <li>Indice: strlen</li>
    </ul>

    <?php

    $strings = ["c'est", "quoi", "cette", "brouette", "!?"];

    ?>

    <ol>
        <?php
        for ($i = 0; $i < count($strings); $i++) {
            echo "<li>{$strings[$i]};</li>";
        };
        ?>
    </ol>

    <ul>
        <?php
        for ($i = 0; $i < count($strings); $i++) {
            if (strlen($strings[$i]) >= 5) {
                echo "<li>{$strings[$i]};</li>";
            };
        };
        ?>
    </ul>


    <h2>Exercice <?php echo ($nbExo++); ?> : conditions</h2>
    <ul>
        <li>En réutilisant la variable age déclarée plus haut, faites en sorte que seul l'un de ces deux blocs s'affiche</li>
        <li>Pour cela, il vous faudra utiliser un if</li>
        <li>Indice : vous n'avez qu'à écrire dans les balises php existantes, pas besoin d'en créer d'autres</li>
    </ul>


    <div>
        <?php if ($age >= 18) {
            echo '<ul style="display:flex; list-style-type: none; font-size: 3em;">
                <li>🍺</li>
                <li>🍸</li>
                <li>🍾</li>
                </ul>';
        } else {
            echo '<ul style="display:flex; list-style-type: none; font-size: 3em;">
        <li>🧸</li>
        <li>🧃</li>
        <li>🏫</li>
    </ul>';
        };
        ?>

    </div>


    <h2>Exercice <?php echo ($nbExo++); ?> : fonctions</h2>
    <ul>
        <li>Déclarez une fonction qui affiche une image dont le lien est passé en paramètre</li>
        <li>Affichez 2 images grâce à cette fonction</li>
    </ul>

    <?php
    /* Déclarez une fonction, qui prend un paramètre (l'url de l'image)
        et qui affiche une balise HTML img avec l'url donné en param (et une largeur de 100px)
        */
    // ...

    function showImg($url)
    {
        echo "<img src='{$url}' alt=''>";
    };

    showImg("https://api.dicebear.com/5.x/big-smile/svg?seed=Pepper");
    showImg("https://api.dicebear.com/5.x/big-smile/svg?seed=Zoey");


    /* Appelez cette fonction avec 2 url différentes. Je vous en donne 2 en exemple :
        - https://api.dicebear.com/5.x/big-smile/svg?seed=Pepper
        - https://api.dicebear.com/5.x/big-smile/svg?seed=Zoey
        */

    ?>

    <hr>
</body>

</html>