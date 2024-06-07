<?php session_start() ;?>
<?php
 include("Commun/Header.php");
 ?>
    <main>
        <section>
        <li><a href="panierjb.php"><i class="fa-solid fa-cart-shopping"><?= isset($_SESSION['panier']) ? array_sum($_SESSION['panier']) : 0 ?></i></a></li>
            <?php 
            include_once("bddjb/bdd.php"); 
            try{
                $pdo = new PDO("mysql:host=$db_host;dbname=$db_name;charset=utf8", $db_user, $db_password);
                    // Options de PDO
                    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

                // preparation de la requete
                    $sql="SELECT * FROM produits";
                    $qry=$pdo->prepare($sql);
                    $qry->execute();
                
                    $produits =  $qry->fetchAll(PDO::FETCH_ASSOC);
                    foreach( $produits as   $produit){
                        

                    ?>
                    <article class="liste_article">
                    <img src="images/<?= htmlspecialchars($produit["image"])?>" alt="<?= htmlspecialchars($produit["nom"])?>">
                    <h4><?= htmlspecialchars($produit["nom"])?></h4>
                    <h4><?= number_format($produit["prix"], 2)?>$</h4>
                    <button><a href="ajout.php?id_produit=<?= htmlspecialchars($produit["id_produit"])?>">acheter</a></button>
                </article>

                <?php
                
            }
            }catch(PDOException $err) {
                // Gestion des erreurs
                $_SESSION["compte-erreur-sql"] = $err->getMessage();
                header("location:pageerreur.php");
                exit();

            }
            
            ?>
              
        </section>  
    </main>
    <?php
 include"Commun/footer.php";
 ?>