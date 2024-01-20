<?php
session_start();                       // WARNING : NE PAS EFFACER CETTE LIGNE
include('helpers/magasinHelper.php');  // WARNING : NE PAS EFFACER CETTE LIGNE

$data = chargerFichier("data/products.json");


?>

<!doctype html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>The Sneaker Shop</title>
        <link rel="stylesheet" href="CSS/header.css">
        <link rel="stylesheet" href="CSS/panier.css">
    </head>

    <body>

    <header>

        <a href="index.php"><img src="assets/site/logo-white.png" alt="logo"></a>
        <h1>We take care of your feet</h1>

    </header>

    <div id="nav">
        <nav>

            <div id="gauche">
                <a href="index.php">Accueil</a>
                <a href="magasin.php">Le shop</a>
                <a href="#">Nos magasins</a>
                <a href="#">Nous contacter</a>
            </div>


        </nav>

    </div>

    <div class="pannier">

        <div>
            <img class='pannier__img' src='assets/site/pannier.svg' alt='pannier'>
            <a href="visuPanier.php">Panier</a>

            <p class="pannier__chiffre">
                <?php
                echo sommesArticles($_SESSION['panier']);
                ?>
            </p>

        </div>
    </div>


    <div  id="commande">
        <div class="total__panier">

            <h4>Votre panier</h4>
            <table>
                    <tr>
                        <th class="imgTh"></th>
                        <th>Désignation</th>
                        <th> P.U. TTC</th>
                        <th>Quantité</th>
                        <th>Total TTC</th>
                    </tr>
                    <?php affichePanier($_SESSION['panier'], $data);?>
            </table>

        </div>

    <div id="recap">

        <div class="paiement">
            <h4>Recapitulatif</h4>


            <div class="page">
                <p>Panier

        <?php echo " (",count($_SESSION["panier"])," produit(s))"; ?> </p>


                <?php
                $total = 0;

                foreach($_SESSION["panier"] as $ref => $v){
                    $total = $total + ($data[$ref]["prix"] * $v);
                }
                echo "<p>$total €</p>"; ?>

            </div>

            <div class="page">
                <p>Frais de livraison :</p>
                <p>Gratuit</p>
            </div>

            <div class="page" id="total">
                <p>Total</p>
                <p><?php echo $total; ?>€</p>
            </div>

            <p id="bouton">Paiement</p>

            <div id="mode">
                <p>Mode de paiement</p>
                <img src="assets/site/paiement.png">

            </div>

        </div>

    </div>
    </div>

        <br/><br/><br/><br/>



    </body>

    <footer>
        <br/>
        <div class='container'>

            <div id='part1'>
                <img src='assets/site/logo-white.png'>
            </div>
            <div id='mid1'>

                <a href='#'><strong>Aide</strong></a>
                <a href='#'>Statut de commande</a>
                <a href='#'>Expédition et livraison</a>
                <a href='#'>Retour</a>
                <a href='#'>Codes promo</a>
            </div>
            <div id='mid2'>
                <a href='#'><strong>À propos</strong></a>
                <a href='#'>Nos magasins</a>
                <a href='#'>À propos de nos magasins</a>
                <a href='#'>Espace Presse</a>
                <a href='#'>Travailler chez Weackers</a>
            </div>
            <div id='mid3'>
                <a href='#'><strong>Informations légales</strong></a>
                <a href='#'>Conditions générales</a>
                <a href='#'>Déclaration de confidentialité</a>
                <a href='#'>Droit légal de rétractation</a>
                <a href='#'>Paramètres des cookies</a>
            </div>
            <div id='part2'>
                <a href='#'>Réseaux sociaux</a>
                <img src='assets/site/social%20media.png' alt='réseaux sociaux' id='rs'>
                <a href='#'>Modes de paiement</a>
                <img src='assets/site/paiement.png' alt='moyen de paiement' id='mp'>

                <br/><br/><br/>
                <p> © Weackers - Tous droits réservés</p>

            </div>
        </div>
        <br/>
    </footer>
</html>
