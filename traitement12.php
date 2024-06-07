<?php
include_once("bddjb/bdd.php");
session_start();

// Vérification des jetons (à implémenter si nécessaire)


$mail = isset($_POST["mail"]) ? $_POST["mail"] : "";
$password = isset($_POST["password"]) ? $_POST["password"] : "";

$erreurs = [];

// Vérification du nom
// if (!preg_match("/^[A-Za-z0-9\x{00c0}-\x{00ff}]{5,20}$/u", $nom)) {
//     $erreurs["nom"] = "Le format du nom est invalide";
// }

if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
    $erreurs["mail"] = "L'email n'est pas valide";
}

if (!preg_match("/^[A-Za-z0-9$]{8,}$/", $password)) {
    $erreurs["password"] = "Le format du mot de passe n'est pas valide";
}

// Protection XSS

$mail = htmlspecialchars($mail);
$password = htmlspecialchars($password);

if (count($erreurs) > 0) {
  
    $_SESSION["donnees"]["mail"] = $mail;
    $_SESSION["donnees"]["password"] = $password;
    $_SESSION["erreurs"] = $erreurs;
    echo "Désolé, les champs ne sont pas corrects.<br>";
    echo "<a href='login.php'>Vers la page formulaire</a>";
    exit(); // Arrêter l'exécution en cas d'erreurs
}

// Parcourir le tableau et valider les entrées
$tableauDonnes = [];
foreach ($_POST as $key => $val) {
    $tableauDonnes[":" . $key] = isset($val) && !empty($val) ? htmlspecialchars($val) : null;
}

// Cryptage du mot de passe
$tableauDonnes[":password"] = password_hash($password, PASSWORD_BCRYPT);

try {
    $pdo = new PDO("mysql:host=$db_host;dbname=$db_name;charset=utf8", $db_user, $db_password);
    // Options de PDO
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    // Préparation de la requête pour vérifier si l'email existe dans la base
    $sql = "SELECT COUNT(*) as nb FROM utilisateur WHERE mail=?";
    $qry = $pdo->prepare($sql);
    $qry->execute([$tableauDonnes[":mail"]]);
    $row = $qry->fetch();

    // Vérification si l'email existe
    if ($row["nb"] > 0) {
        echo "L'email existe déjà dans la base de données.<br>";
        echo "<a href='login.php'>Vers la page d'inscription</a>";
    } else {
        $sql = "INSERT INTO utilisateur(mail,password) VALUES (:mail,:password)";
        $qry = $pdo->prepare($sql);
        $qry->execute($tableauDonnes);
        unset($pdo);
        echo "Vous êtes bien inscrit.<br>";
        echo "<a href='pageaccueil.php'>Vers la page d'accueil</a>";
    }

} catch (PDOException $err) {
    // Gestion des erreurs
    $_SESSION["compte-erreur-sql"] = $err->getMessage();
    header("Location: pageerreur.php");
    exit();
}
?>
