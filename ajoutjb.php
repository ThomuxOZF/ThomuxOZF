<?php
  include_once("bddjb/bdd.php");  

//  verifiaction du status de ma session
 if(session_status() === PHP_SESSION_NONE){
    session_start();
 }
//   creationde sessiopn panier

if(!isset($_SESSION["panier"])){
    $_SESSION["panier"] = array();
}
// recuperation de mon id
if(isset($_GET["id_produit"])){
   $id =$_GET["id_produit"];
}

try{
    $pdo = new PDO("mysql:host=$db_host;dbname=$db_name;charset=utf8", $db_user, $db_password);
    // Options de PDO
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);


    // requete preparer
    $sql="SELECT * FROM produits WHERE id_produit=? ";
    $qry=$pdo->prepare($sql);
    $qry->bindValue(1,   $id, PDO::PARAM_INT);
    $qry->execute();
    $produit =  $qry->fetch(PDO::FETCH_ASSOC);


    if(!$produit){
         die("le produit n'exite pas");
    }

    if(isset($_SESSION["panier"][$id ])){
        $_SESSION["panier"][$id]++; 


    }else{
        $_SESSION["panier"][$id]=1; 
    }
    header("location:articles.php");
    exit();



}catch(PDOException $err){
  // Gestion des erreurs
  $_SESSION["compte-erreur-sql"] = $err->getMessage();
  header("location:pageerreur.php");
  exit();
}









