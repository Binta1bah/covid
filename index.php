<?php

session_start();
if (!isset($_SESSION['covid'])) {
    $_SESSION['covid'] = array();
}

if (isset($_POST['valider'])) {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $age = $_POST['age'];
    $poids = $_POST['poids'];
    $temp = $_POST['temp'];
    $maux = $_POST['maux'];
    $diar = $_POST['diar'];
    $odeur = $_POST['odeur'];
    $toux = $_POST['toux'];
    $score = 0;
    if ($age < 0 || $age >= 120) {
        echo "Entrez un age correct svp ";
    } elseif ($age >= 0 && $age <= 5) {
        $score += 15;
    } elseif ($age > 5 && $age <= 15) {
        $score += 5;
    } elseif ($age > 15 && $age <= 50) {
        $score += 0;
    } elseif ($age > 50) {
        $score += 15;
    }

    if ($diar == 'oui') {
        $score += 10;
    } elseif ($diar == 'non') {
        $score += 0;
    }

    if ($maux == 'oui') {
        $score += 10;
    } elseif ($maux == 'non') {
        $score += 0;
    }

    if ($odeur == 'oui') {
        $score += 10;
    } elseif ($odeur == 'non') {
        $score += 0;
    }

    if ($toux == 'oui') {
        $score += 10;
    } elseif ($toux == 'non') {
        $score += 0;
    }

    if ($temp >= 37 && $temp <= 37.8) {
        $score += 0;
    } elseif ($temp > 37.8 && $temp <= 38) {
        $score += 10;
    } elseif ($temp > 39.5) {
        $score += 15;
    }



    echo $score;
    echo "<br>";
    echo "Merci $nom" . " " . $prenom . " d'avoir fais le test <br>";
    echo "<U> Voici les information que vous avez fourni </U><br>";
    echo "Vous avez " . $age . "an(s) <br>";
    echo "Temperature: " . $temp . "<br>";
    echo "Mot de tête: " . $maux . "<br>";
    echo "Diarrhée: " . $diar . "<br>";
    echo "Manque d'odorat: " . $odeur . "<br>";
    echo "Des toux: " . $toux . "<br>";
    echo "<br>";
    echo "<br";
    echo "<hr>";


    if (0 >= $score && $score <= 30) {
        echo " <B> D'après ces information vous êtes sain(te)! </B>";
        echo "<br>";
    } elseif (30 < $score && $score <= 50) {
        echo " <B> D'après ces information vous êtes suseptible d'avoir le covid allez faire un test pour être plus sûr. </B>";
        echo "<br>";
    } elseif (50 < $score && $score <= 70) {
        echo " <B> D'après ces information vous avez le covid allez faire un test pour être plus sûr. </B>";
        echo "<br>";
        echo "<br>";
    }

    echo "<br>";
}



?>






<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="" method="post">
        <Label for="nom">Nom: </Label>
        <input type="text" name="nom" pattern="[A-Za-zÀ-ÿ\s]+" placeholder="Saissisez votre nom" title="Veuillez entrer un texte, pas de chiffres."><br><br>
        <Label for="prenom">Prénom: </Label>
        <input type="text" name="prenom" pattern="[A-Za-zÀ-ÿ\s]+" placeholder="Saissisez votre prénom" title="Veuillez entrer un texte, pas de chiffres."> <br><br>
        <Label for="age">Age</Label>
        <input type="number" name="age" min="0" max="110" placeholder="Saissisez votre age" required> <br><br>
        <Label for="poids">Poids</Label>
        <input type="number" name="poids" step="0.01" placeholder="Saissisez votre poids"> <br><br>
        <Label for="temp">Temperature</Label>
        <input type="number" name="temp" step="0.01" min="34" max="43" placeholder="Saissisez votre temperature" required> <br><br>
        <label for="maux">Avez-vous des maux de tête?</label>
        <select id="maux" name="maux" required>
            <option value="oui">Oui</option>
            <option value="non">Non</option><br><br>
        </select><br><br>
        <label for="diar">Avez-vous la diarrhé?</label>
        <select id="diar" name="diar" required>
            <option value="oui">Oui</option>
            <option value="non">Non</option>
        </select><br><br>
        <label for="toux">Avez-vous des toux?</label>
        <select id="toux" name="toux" required>
            <option value="oui">Oui</option>
            <option value="non">Non</option>
        </select><br><br>
        <label for="odeur">Avez-vous une perte d'odorat?</label>
        <select id="odeur" name="odeur" required>
            <option value="oui">Oui</option>
            <option value="non">Non</option>
        </select><br><br>

        <input type="submit" name="valider" value="Valider">

    </form>
</body>

</html>

<?php





?>