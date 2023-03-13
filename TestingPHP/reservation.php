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

        .ticket {
            width: 20%;
            border: black solid 1px;
            border-radius: 1em;
            padding: 2em;
            margin: 0 auto;
        }
    </style>
</head>

<body>

    <?php

    $prix_burger = 10;
    $prix_supplement = 1;
    $total = 0;

    if (isset($_POST["menu"]) && $_POST["menu"] != "") {
        $menu = $_POST["menu"];
        echo "<div class='ticket'>";
        echo "<h1>Commande Validée !</h1>";
        echo ("Votre commande numéro : " . rand(0, 9999999999) . "<br>");
        echo "<br>Vous avez choisi un {$menu} avec";
        $total += $prix_burger;

        if (isset($_POST["salade"]) && $_POST["salade"] != "") {
            $salade = $_POST["salade"];
            echo " salade";
            $total += $prix_supplement;
        } else {
            echo " sans salade";
        }
        if (isset($_POST["tomates"]) && $_POST["tomates"] != "") {
            $tomates = $_POST["tomates"];
            echo " tomates";
            $total += $prix_supplement;
        } else {
            echo " sans tomates";
        }
        if (isset($_POST["oignons"]) && $_POST["oignons"] != "") {
            $oignons = $_POST["oignons"];
            echo " oignons";
            $total += $prix_supplement;
        } else {
            echo " et sans oignons";
        }

        if (isset($_POST["datetime"]) && $_POST["datetime"] != "") {
            $datetime = $_POST["datetime"];
            echo ", à récupérer à {$datetime}";
        }

        if (isset($_POST["sur_place"]) && $_POST["sur_place"] != "") {
            $sur_place = $_POST["sur_place"];
            echo " sur place.<br>";
        } else if (isset($_POST["emporter"]) && $_POST["emporter"] != "") {
            $emporter = $_POST["emporter"];
            echo " à emporter.<br>";
        }

        echo "<br>Total : {$total}$";

        if (isset($_POST["cb_number"]) && $_POST["cb_number"] != "") {
            $cb_number = $_POST["cb_number"];
            echo "<br><br>Payé par carte bleue.";
        }

        echo "</div>";
        echo "<a href='http://localhost/chall_php/chall2.php'><button>Retour à la page précédente</button></a>";
    } else {
        echo "<h1>Commande invalide, veuillez réessayer.</h1>";
        echo "<a href='http://localhost/chall_php/chall2.php'><button>Retour à la page précédente</button></a>";
    }

    ?>
</body>

</html>