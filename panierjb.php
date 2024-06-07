<?php
 include("Commun/Header.php");
 ?>
  <main>
        <section>
            <table>
                <tr>
                    <th>Nom</th>
                    <th>Prix</th>
                    <th>Quantité</th>
                    <th>Supprimer</th>
                </tr>
                <?php  
                $total = 0;
                // Vérification s'il existe dans mon tableau
                if (isset($_SESSION["panier"]) && is_array($_SESSION["panier"])) {
                    $ids = array_keys($_SESSION["panier"]);
                    if (empty($ids)) {
                        echo "<tr><td colspan='4'>Panier est vide</td></tr>";
                    } else {
                        $produitIds = implode(',', array_map('intval', $ids));
                    }

                    try {
                        $pdo = new PDO("mysql:host=$db_host;dbname=$db_name;charset=utf8", $db_user, $db_password);
                        // Options de PDO
                        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

                        // Préparation de la requête
                        $sql = "SELECT * FROM produits WHERE id_produit IN ($produitIds)";
                        $qry = $pdo->prepare($sql);
                        $qry->execute();
                        $produits = $qry->fetchAll(PDO::FETCH_ASSOC);

                        foreach ($produits as $produit) {
                            $quantite = $_SESSION["panier"][$produit["id_produit"]];
                            $total += $produit["prix"] * $quantite;
                            ?>
                            <tr>
                                <td><img src="images/<?= htmlspecialchars($produit["image"]) ?>" alt="<?= htmlspecialchars($produit["nom"]) ?>"></td>
                                <td><h4><?= htmlspecialchars($produit["nom"]) ?></h4></td>
                                <td><h4><?= number_format($produit["prix"], 2) ?>$</h4></td>
                                <td><h4><?= htmlspecialchars($quantite) ?></h4></td>
                                <td><button><a href="panier.php?delete=<?= urlencode($produit["id_produit"]) ?>"><i class="fa-solid fa-trash-can"></i></a></button></td>
                            </tr>
                            <?php
                        }
                    } catch (PDOException $err) {
                        // Gestion des erreurs
                        $_SESSION["compte-erreur-sql"] = $err->getMessage();
                        header("location:pageerreur.php");
                        exit();
                    }
                }
                ?>
                <tr class="total">
                    <th colspan="5">Total : <?= number_format($total, 2) ?>€</th>
                </tr>
            </table>
        </section>



























<?php
 include"Commun/footer.php";
 ?>
