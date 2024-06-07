<?php
include_once("bddjb/incrjb.php");

// Vérification des jetons

$nom = isset($_POST["nom"]) ? $_POST["nom"] : "";
$prenom = isset($_POST["prenom"]) ? $_POST["prenom"] : "";
$mail = isset($_POST["mail"]) ? $_POST["mail"] : "";
$sujet = isset($_POST["sujet"]) ? $_POST["sujet"] : "";
$message = isset($_POST["message"]) ? $_POST["message"] : "";

$erreurs = [];

// Vérification du nom
if (!preg_match("/^[A-Za-z0-9\x{00c0}-\x{00ff}]{5,20}$/u", $nom)) {
    $erreurs["nom"] = "Le format du nom est invalide";
}
if (!preg_match("/^[A-Za-z0-9\x{00c0}-\x{00ff}]{5,50}$/u", $prenom)) {
    $erreurs["prenom"] = "Le format du prenom est invalide";
}
if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
    $erreurs["mail"] = "L'email n'est pas valide";
}

// Protection XSS
$nom = htmlspecialchars($nom);
$prenom = htmlspecialchars($prenom);
$mail = htmlspecialchars($mail);
$sujet = htmlspecialchars($sujet);
$message = htmlspecialchars($message);

if (count($erreurs) > 0) {
    $_SESSION["donnees"]["nom"] = $nom;
    $_SESSION["donnees"]["prenom"] = $prenom;
    $_SESSION["donnees"]["mail"] = $mail;
    $_SESSION["donnees"]["sujet"] = $sujet;
    $_SESSION["donnees"]["message"] = $message;
    $_SESSION["erreurs"] = $erreurs;
    echo "Désolé, les champs ne sont pas corrects";
    echo "<a href='formuvoiture.php'>Vers la page formulaire</a>";
    exit(); // Arrêter l'exécution en cas d'erreurs
}

// Parcourir le tableau et valider les entrées
$tableauDonnes = [];
foreach ($_POST as $key => $val) {
    $tableauDonnes[":" . $key] = isset($val) && !empty($val) ? htmlspecialchars($val) : null;
}

// Cryptage du mot de passe
// $tableauDonnes[":password"] = password_hash($password, PASSWORD_BCRYPT);
include_once("bddjb/incrjb.php");
try {
    $pdo = new PDO("mysql:host=$db_host;dbname=$db_name;charset=utf8", $db_user, $db_password);
    // Options de PDO
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    // Préparation de la requête pour vérifier si l'email existe dans la base
    // $sql = "SELECT COUNT(*) as nb FROM hotel WHERE mail=?";
    // $qry = $pdo->prepare($sql);
    // $qry->execute([$tableauDonnes[":mail"]]);
    // $row = $qry->fetch();

    // // Vérification si l'email existe
    // if ($row["nb"] > 0) { // Changé de === 1 à > 0 pour être plus générique
    //     echo "L'email existe déjà dans la base de données";
    //     echo "<a href='formulaire.php'>Vers la page d'inscription</a>";
    // } else {
        $sql = "INSERT INTO contact(nom, prenom, mail, sujet, message) VALUES (:nom, :prenom, :mail, :sujet, :message)";
        $qry = $pdo->prepare($sql);
        $qry->execute($tableauDonnes);
        unset($pdo);
        echo "Vous êtes bien inscrit";
        echo "<a href='pageaccueil.php'>Vers la page d'accueil</a>";

} catch (PDOException $err) {
    // Gestion des erreurs
    $_SESSION["compte-erreur-sql"] = $err->getMessage();
    header("location:pageerreur.php");
    exit();
}
?>
