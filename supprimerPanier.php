<?php
session_start(); // WARNING : NE PAS EFFACER CETTE LIGNE
include('helpers/magasinHelper.php');


$refProduit = $_GET['reference'];


// Je vérifie que mon panier existe, sinon je le crée
// Rappel : le panier est une entrée dans le tableau associatif $_SESSION avec la clef "panier"
// Cette entrée constitue un tableau associatif dont les clefs sont les références des produits et les valeurs les quantités associées

// Je vérifie que ma référence est déjà présente dans le panier.
// si oui j'augmente la quantité
// sinon j'ajoute le produit dans le panier

if (array_key_exists('panier', $_SESSION)) {
    if (array_key_exists($refProduit, $_SESSION['panier'])) {
        $_SESSION['panier'][$refProduit] -= 1;
    } else {
        $_SESSION['panier'][$refProduit] = 1;

    }
} else {
    $_SESSION['panier'] = array($refProduit => 1);
}

// Pas de code à vous après cette ligne


$panier = $_SESSION['panier']; // WARNING : NE PAS EFFACER CETTE LIGNE

echo "<pre>";print_r($panier);echo "</pre>";die(1);  // Voilà l'état actuel du panier. Supprimer cette ligne dès que votre script marche


header('Location: visuPanier.php'); // Je retourne voilr le panier
