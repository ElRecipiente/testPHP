<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quizz</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Roboto+Mono:wght@400;700&display=swap');

        body {
            font-family: "Roboto Mono", "sans-serif";
            color: #272838;
            margin: 0;
            padding: 3em;
            box-sizing: border-box;
        }

        form {

            width: 50%;
            margin: 0 auto;
        }

        fieldset {
            display: flex;
            flex-flow: column wrap;
            justify-content: space-between;
        }

        label {
            width: 50%;
        }

        legend {
            text-align: center;
        }

        input {
            height: 2em;
            width: fit-content;
        }

        .red {
            color: red;
        }

        .green {
            color: green;
        }
    </style>
</head>

<body>

    <form action="quizz.php" method="GET">

        <fieldset>
            <legend>Quizz des Minuscules Only</legend>
            <label for="answer0">Nommez une variable PHP.</label><br>
            <input type="text" name="answer0" placeholder="Votre réponse ici">
            <?php
            if (isset($_GET["answer0"]) && $_GET["answer0"] == '$php') {
                echo "<span class='green'>Bonne réponse !</span><br>";
            } else {
                echo "<span class='red'>Raté, mauvaise réponse !</span><br>";
            }
            ?>
            <br><label for="answer1">Nommez une constante PHP.</label><br>
            <input type="text" name="answer1" placeholder="Votre réponse ici"><br>
            <?php
            if (isset($_GET["answer1"]) && $_GET["answer1"] == 'PHP') {
                echo "<span class='green'>Bonne réponse !</span><br>";
            } else {
                echo "<span class='red'>Raté, mauvaise réponse !</span><br>";
            }
            ?>
            <br><label for="answer2">Si vous comparez les deux, vous obtenez : </label>
            <input type="radio" name="null" value="0">NULL
            <input type="radio" name="une_brouette" value="1">Une brouette
            <input type="radio" name="ordi_burn" value="2">Un ordi qui sert désormais aussi de barbecue.<br>
            <?php

            if (isset($_GET["ordi_burn"])) {
                echo "<span class='green'>Bonne réponse !</span><br>";
            } else {
                echo "<span class='red'>Raté, mauvaise réponse !</span><br>";
            }
            ?>
            <br><label for="answer3">Question :</label>
            <input type="checkbox" name="answer3a" value="Brouette">Brouette
            <input type="checkbox" name="answer3b">Brouette
            <input type="checkbox" name="answer3c">Brouette<br>
            <br><label for="answer4">Question :</label>
            <input type="radio" name="answer4">
            <input type="radio" name="answer4">
            <input type="radio" name="answer4"><br>
            <br><label for="answer5">Question :</label><br>
            <input type="radio" name="answer5"><br>
            <input type="radio" name="answer5"><br>
            <input type="radio" name="answer5"><br>
            <br><label for="answer6">Question :</label><br>
            <input type="number" name="answer6" placeholder="Votre réponse ici"><br>
            <br><label for="answer7">Question :</label><br>
            <input type="number" name="answer7" placeholder="Votre réponse ici"><br>
            <br><label for="answer8">Question :</label><br>
            <input type="number" name="answer8" placeholder="Votre réponse ici"><br>
            <br><label for="answer9">Question :</label><br>
            <input type="number" name="answer9" placeholder="Votre réponse ici"><br>
            <br><label for="answer10">Question : <?php $random1 = rand(1000, 9999);
                                                    $random2 = rand(1000, 9999);
                                                    echo $random1 . " + " . $random2; ?> </label><br>
            <input type="number" name="answer10" placeholder="Votre réponse ici"><br>

            <input type="submit" value="Envoyer">

        </fieldset>

    </form>

    <?php
    $notes = ["maths" => [12, 15, 16, 9, 18, 14], "anglais" => [12, 14, 14, 12], "informatique" => [16, 18, 17]];
    $moyenne = 0;

    foreach ($notes as $matiere => $notesMatiere) {
        for ($i = 0; $i < count($notesMatiere); $i++) {
            $moyenne += $notesMatiere[$i];
        }
        $moyenne = $moyenne / count($notesMatiere);
        echo "La moyenne en {$matiere} est de {$moyenne}<br>";
        $moyenne = 0;
    }
    ?>

</body>

</html>