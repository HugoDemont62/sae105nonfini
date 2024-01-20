<?php


function chargerFichier($nomFichier) {
    $fichierCharge = $nomFichier;
    $data = json_decode(file_get_contents($fichierCharge),true);
    return $data;

}

function afficheProduit($produit, $reference) {

    echo ' 
           <div class="article">
            <div id="image">
                <img src="'.$produit['imageUrl'].'">
            </div>
            <div id="description">
                <a href="article.php?reference='.$reference.'">'.$produit['titre'].'</a>
                <p>'.$produit['description'].'</p>
            </div>
            <div id="panier">
  
                <h4>'.$produit['prix'].'€</h4>
                <a href="ajoutPanier.php?reference='.$reference.'"><img src="assets/site/buy.png" alt="panier"></a>
                
            </div>
        </div>';

}

function afficheArticle($ref, $data){  //init de la function afficheArticle
    foreach ($data AS $reference=>$produit){ // boucle for sur le fichier data pour recup la ref et les items du produit
        if ($reference == $ref){ // si ref == reference  donc echo
            echo
                '<div id="img">
            <img src="'.$produit['imageUrl'].'">
        </div>

        <div id="infos">
            <h2>'.$produit['titre'].'</h2>
            
            <p><span id="prix">'.$produit['prix'].'€</span></p>
            
            <p>'.$produit['description'].'</p>
            
            <br/><br/><br/>
            
            <a class="add" href="ajoutPanier.php?reference='.$ref.'">Ajouter au panier</a>

        </div>';

        }
    }

}

function afficheCommentaire($avis) {
    echo '<div class="avis">

            <div class="nom">
                <p>' . $avis['auteur'] . ', le ' . $avis['date'] ." (".$avis["note"].'/10)</p>
            </div>
            
            <div class="texte">
                <p>'.$avis['avis'].'</p>
            </div>

        </div>';
}


function afficheArticleSimilaire($type, $data, $ref) {
    $i = 0;
    foreach ($data AS $reference => $produit){
        if ($type == $produit['type'] AND $ref != $reference){
            $i++;
            if ($i == 4){
                break;
            }
            echo ' <div class="chaussures">

            <a href="article.php?reference='.$reference.'">
 
                    <h5>'.$produit['titre'].'</h5>
                    
                    <br/>
    
                    <img src="'.$produit['imageUrl'].'" alt="basket">
       </a>
                </div>';
        }
    }
}


function calculeMoyenne($reference) {
    $fichierCharge = "data/avis.json";
    $avis = json_decode(file_get_contents($fichierCharge), true);

    $moyenne = 0;
    $nbAvis = 0;

    foreach ($avis as $a => $b) {
        for ($i = 0; $i < count($b); $i++) {
            if ($b[$i]['reference'] == $reference) {
                $moyenne += $b[$i]['note'];
                $nbAvis++;
            }
        }

        if ($nbAvis != 0) {
            return round($moyenne = $moyenne / $nbAvis, 2);

        } else {
            return "-";
        }

    }

}

function sommesArticles($panier) {
    $sommes=0;
    foreach($panier as $ref => $qte) {
        $sommes+=$qte;
    }
    return  $sommes;
}



function affichePanier($panierData, $data) {
    foreach ($data as $produits => $produit) {

        foreach ($panierData as $panier => $panierProduit) {
            if ($panier == $produits) {
            $TTC = $produit['prix'] * $panierProduit;
                echo ' 
                     <tr>
                     <td class="imgTh"><img src="' . $produit['imageUrl'] . '" alt="basket" class="basket"></td>
                         <td>
                              ' . $produit['titre'] . '
                         </td>
                          <td>' . $produit['prix'] . '</td>
                            <td >
                             <a class="quantité">
                             ' . $panierProduit . '
                             <a href="supprimerPanier.php?reference='.$produits.'"> <img src="assets/site/rmProduct.png" alt="panier" class="supp__basket"></a>  </td>
                           <td>' . $TTC . '</td>
                        
                      </tr>';
            }
        }
    }
}


//----------------------------------------------------------------------------------------
// WARNING : ne pas modifier ces lignes
//----------------------------------------------------------------------------------------

if(isset($_SESSION['panier']) == false)
    $_SESSION['panier'] = [];
$panier = $_SESSION["panier"];

?>