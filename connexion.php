<?php
 include_once("bddjb/bdd.php");
 session_start();

 $mail = (isset($_POST["mail"]) && !empty($_POST["mail"])) ? htmlspecialchars($_POST["mail"])  : "null";
$password = (isset($_POST["password"]) && !empty($_POST["password"])) ? htmlspecialchars($_POST["password"])  : "null";

if($email&&$password){

    include_once("bddjb/bdd.php");

    try {
        $pdo = new PDO("mysql:host=$db_host;dbname=$db_name;charset=utf8", $db_user, $db_password);
        // Options de PDO
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

        $qry=$pdo->prepare("SELECT * FROM utilisateur WHERE mail=?");
        $qry->execute(array($email));
        $data_user=$qry->fetch();
        // verification de mot de passe et email
        if($data_user && password_verify($password, $data_user["password"]) ){
            // definition du nom grace à la session
            $_SESSION["nom"]= $data_user["nom"];
            header("location:Pagesoins.php");

        }else{
            echo"utilisateur introuvable";
        }

    }catch (PDOException $err) {
        // Gestion des erreurs
        $_SESSION["compte-erreur-sql"] = $err->getMessage();
        header("location:pageerreur.php");
        exit();
    }
}else{
    echo"l'email ou le mot de passe ne sont pas correctes";
}
?>