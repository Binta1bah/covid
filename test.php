<?php

session_start();
if (!isset($_SESSION['covid'])) {
    $_SESSION['covid'] = array();
    $_SESSION['champ'] = array();
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
    $erreur = [];

    if ($nom == '' || $prenom == '' || $age == "" || $temp = '') {
        echo "les champs Nom Prénom, Age et Temperature sont obligatoires <br>";
        $erreur[] = "les champs Nom Prénom, Age et Temperature sont obligatoires <br>";
    } elseif (!preg_match("/^[a-zA-Z]+$/", $nom) || !preg_match("/^[a-zA-Z]+$/", $nom) || !preg_match("/^[a-zA-Z]+$/", $prenom)) {
        echo "Entrer un nom et prénom correct svp. <br>";
        $erreur[] = "Entrer un nom et prénom correct svp. <br>";
    } elseif (!is_numeric($age) || $age < 0 || $age >= 120) {
        echo "Entrez un age correct svp ";
        $erreur[] = "Entrez un age correct svp ";
    } elseif (!is_numeric($_POST['temp']) || $_POST['temp'] <= 32 || $_POST['temp'] >= 45) {
        echo "la temperature doit etre entre 32 et 45";
        $erreur[] = "la temperature doit etre entre 32 et 45";
    } elseif (!is_numeric($poids) || $poids < 0) {
        echo "Donner un poids correct svp!";
        $erreur[] =  "Donner un poids correct svp!";
    } elseif (empty($diar) || empty($maux) || empty($odeur) || empty($toux)) {
        echo "Il faut obligatoirement faire u choix dans les champs select";
        $erreur[] = "Il faut obligatoirement faire u choix dans les champs select";
    } else {


        if ($age >= 0 && $age <= 5) {
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

        if ($_POST['temp'] >= 37 && $_POST['temp'] <= 37.8) {
            $score += 0;
        } elseif ($_POST['temp'] > 37.8 && $_POST['temp'] <= 38) {
            $score += 10;
        } elseif ($_POST['temp'] > 39.5) {
            $score += 15;
        }

        // echo $score;
        // echo "<br>";
        // echo "Merci $nom" . " " . $prenom . " d'avoir fais le test <br>";
        // echo "<U> Voici les information que vous avez fourni </U><br>";
        // echo "Vous avez " . $age . "an(s) <br>";
        // echo "Temperature: " . $_POST['temp'] . "<br>";
        // echo "Mot de tête: " . $maux . "<br>";
        // echo "Diarrhée: " . $diar . "<br>";
        // echo "Manque d'odorat: " . $odeur . "<br>";
        // echo "Des toux: " . $toux . "<br>";
        // echo "<br>";
        // echo "<br";
        // echo "<hr>";






    }

    $message = "";
    if ($score >= 0  && $score <= 30) {
        $message = "<B> D'après ces information vous êtes sain(te)! </B>";
        echo "<br>";
    } elseif ($score > 30 && $score <= 50) {
        $message = " <B> D'après ces information vous êtes suseptible d'avoir le covid allez faire un test pour être plus sûr. </B>";
        echo "<br>";
    } elseif ($score > 30  && $score <= 70) {
        $message = " <B> D'après ces information vous avez le covid allez faire un test pour être plus sûr. </B>";
        echo "<br>";
        echo "<br>";
    }

    $history = "Merci $nom" .  "  " . $prenom . " d'avoir fait le test <br> <B> Votre score est = " . $score . "/70 </B> <br> <U> Voici les information que vous avez fourni </U><br>
        Vous avez " . $age . "an(s) <br> Temperature: " . $_POST['temp'] . "<br> Mot de tête: " . $maux . "<br> Diarrhée: " . $diar . "<br> 
        Manque d'odorat: " . $odeur . "<br> Des toux: " . $toux . "<br>" . $message . "<br>";

    echo $history;

    $_SESSION['covid'][] = $history;
    // $_SESSION['champ'][] = [$nom, $prenom, $age, $poids, $temp, $diar, $maux, $odeur];


    echo "<br>";
}



// session_destroy();









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
        <input type="text" name="nom" placeholder="Saissisez votre nom" value="<?php if (!empty($erreur)) echo $nom; ?>"><br><br>
        <Label for="prenom">Prénom: </Label>
        <input type="text" name="prenom" placeholder="Saissisez votre prénom" value="<?php if (!empty($erreur)) echo $prenom; ?>"> <br><br>
        <Label for="age">Age</Label>
        <input type="number" name="age" placeholder="Saissisez votre age" value="<?php if (!empty($erreur)) echo $age; ?>"> <br><br>
        <Label for="poids">Poids</Label>
        <input type="number" name="poids" placeholder="Saissisez votre poids" value="<?php if (!empty($erreur)) echo $poids; ?>"> <br><br>
        <Label for="temp">Temperature</Label>
        <input type="number" name="temp" placeholder="Saissisez votre temperature" value="<?php if (!empty($erreur)) echo $_POST['temp']; ?>"> <br><br>
        <label for="maux">Avez-vous des maux de tête?</label>
        <select id="maux" name="maux" value="<?php if (isset($maux)) echo $maux; ?>">
            <option value="oui" <?php if (!empty($erreur) && $maux == 'oui') echo 'selected'; ?>>Oui</option>
            <option value="non" <?php if (!empty($erreur) && $maux == 'non') echo 'selected'; ?>>Non</option><br><br>
        </select><br><br>
        <label for="diar">Avez-vous la diarrhé?</label>
        <select id="diar" name="diar" value="<?php if (isset($diar)) echo $diar; ?>">
            <option value="oui" <?php if (!empty($erreur) && $diar == 'oui') echo 'selected'; ?>>Oui</option>
            <option value="non" <?php if (!empty($erreur) && $diar == 'non') echo 'selected'; ?>>Non</option>
        </select><br><br>
        <label for="toux">Avez-vous des toux?</label>
        <select id="toux" name="toux" value="<?php if (isset($toux)) echo $toux; ?>">
            <option value="oui" <?php if (!empty($erreur) && $toux == 'oui') echo 'selected'; ?>>Oui</option>
            <option value="non" <?php if (!empty($erreur) && $toux == 'non') echo 'selected'; ?>>Non</option>
        </select><br><br>
        <label for="odeur">Avez-vous une perte d'odorat?</label>
        <select id="odeur" name="odeur">
            <option value="oui" <?php if (!empty($erreur) && $odeur == 'oui') echo 'selected'; ?>>Oui</option>
            <option value="non" <?php if (!empty($erreur) && $odeur == 'non') echo 'selected'; ?>>Non</option>

        </select><br><br>

        <input type="submit" name="valider" value="Valider">



    </form>
</body>

</html>

<?php

echo "<br>";
echo "<br>";
echo "<h2> Lh'istorique des tests </h2><br>";
foreach ($_SESSION['covid'] as $c) {
    echo $c;
    echo "<br>";
}



?>