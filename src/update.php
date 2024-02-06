<?php
include("pdo.php");
/* Récupérer le tableau des domaines pour affichage dynamique en menu déroulant: ----*/
$result = $pdo->query("SELECT * FROM domaine");
$domaines = $result->fetchAll(PDO::FETCH_ASSOC);
/* Récupérer le tableau des catégories pour affichage dynamique en cases à cocher: ----*/
$result = $pdo->query("SELECT * FROM categorie");
$categories = $result->fetchAll(PDO::FETCH_ASSOC);
/* Récupérer le tableau cat_fav afin de l'alimenter lors de la création d'une catégorie: -*/
$result = $pdo->query("SELECT * FROM cat_fav");
$cat_fav = $result->fetchAll(PDO::FETCH_ASSOC);


/* Récupèrer les information du favori à modifier------------------------------------------*/
$groupConcat = ", GROUP_CONCAT(categorie.id_categorie)"; 
$groupBy = "GROUP BY favoris.id_favori;";

$requeteSQL = "SELECT  *" . $groupConcat . " FROM favoris 
INNER JOIN cat_fav    ON favoris.id_favori = cat_fav.id_favori 
INNER JOIN categorie  ON categorie.id_categorie = cat_fav.id_categorie
INNER JOIN domaine    ON domaine.id_domaine = favoris.id_domaine
WHERE favoris.id_favori =" . $_GET['id_favori']; 
$groupBy;

$result = $pdo->query($requeteSQL);
$favoris = $result->fetch(PDO::FETCH_ASSOC);
/* Déclaration des variables afin de les afficher dans le formulaire-----------------------*/
$libelleFav = $favoris['libelle'];
$urlFav = $favoris['url'];
$domaineFav = $favoris['nom_domaine'];
$categoryIdsString = $favoris['GROUP_CONCAT(categorie.id_categorie)'];
$categoryIdArray = explode("," , $categoryIdsString);
//$domaineCat = $favoris['
//echo "categories: " . $categoryIdsString;

/*Construction de la requête:-------------------------------------------------------------------*/
try {

    /* Étape 1=> validation des données:------------------------------------*/
    if (!empty($_POST['libelle'] ) && !empty($_POST['url'] ) && !empty($_POST['domaine'] ) && !empty($_POST['categorie'] ) ) {
        //echo ('all fields have been validated!')?>"<br>"<?php ;

    /* Étape 2=> Construction et preparation de la première requêtte:MAJ de table favoris--*/
        $libelle = $_POST['libelle'];
        $url = $_POST['url'];
        $idDomaine = $_POST['domaine'];
        $idFavori = $_GET['id_favori'];
        $idCategories = $_POST['categorie'];
        print_r($idCategories);
        //var_dump($libelle);
        //var_dump($url);
        //var_dump($idDomaine);
        //var_dump($idFavori);
        

        $updateRequestPrepare = "UPDATE favoris SET 
                        libelle    = :libelle, 
                        url        = :url, 
                        id_domaine = :idDomaine 
                        WHERE id_favori = :idFavori;";
        //var_dump($updateRequestPrepare);

        $requetePrepare = $pdo->prepare($updateRequestPrepare);                  
        
        $parameterArray = array(
            ':libelle'   => $libelle,
            ':url'       => $url,
            ':idDomaine' => $idDomaine,
            ':idFavori'  => $idFavori
        );

        $requetePrepare->execute($parameterArray);

    /* Étape 3=> Construction de la requêtte:MAJ de table categories en deux parts:*/

        /*1)effacer toutes les données correspondantes au favori selectionné--------*/

        $deleteCategorieRequest = "DELETE FROM cat_fav WHERE id_favori = :idFavori;";
        
        $requetePrepare = $pdo->prepare($deleteCategorieRequest);
        
        $parameterArray = array(':idFavori' => $idFavori);

        $requetePrepare->execute($parameterArray); 
        
        /*2)creer à nouveau les catégories selon le nouveau choix------------------*/

        $createRequest = "INSERT INTO cat_fav (id_favori, id_categorie)
        VALUES (:id_favori,:categorie);";
        //echo $createRequest;

        $requetePrepare = $pdo->prepare($createRequest);

        //echo $idFavori;
        foreach ($idCategories as $categorie) {  

            $parameterArray = array(
                ':id_favori' => $idFavori,
                ':categorie' => $categorie
            );
            
            $requetePrepare->execute($parameterArray);
        };

        header('Location: index.php?resultat=3');
        exit();

    } else {
        echo '<script src="script.js"></script>';
        echo '<script>';
        echo 'completerChamps()';
        echo '</script>';
    }
} catch(PDOException $e) {

    header("Location: index.php?resultat=4");
    exit();
}

?>

<!-----------------------------------HTLM------------------------------------------------------->
<!DOCTYPE html>
<html lang="en">

<pre>
<?php /*var_dump($idCategories);*/?>
</pre>


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="./output.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/e14b518d69.js" crossorigin="anonymous"></script>
    <title>Créer un favori</title>
</head>

<?php include("header.php"); ?>

<body>
    <section>
        <h2 class="text-3xl font-bold text-blue-900 h-20 flex items-center justify-center font-roboto
                  ">Ajout de favoris</h2>
        <div class="p-5 bg-gray-100 mx-auto max-w-screen-md">
            <form action="" method="post">
                <!--Champs de texte pour libelle et url ---------------------------------------------->
                <label for="libelle">Libellé: </label>
                <input type="text" name="libelle" id="libelle" placeholder="Saisir le libellé"
                       value="<?php echo $libelleFav ?>"><br><br>

                <label for="url">URL: </label>
                <input type="text" name="url" id="url" placeholder="Saisir une URL"
                       value="<?php echo $urlFav ?>"><br><br>

                <!--menu déroulant dynamique pour le choix de domaine: -------------------------------->
                <label for="domaine">Domaine: </label>
                <select name="domaine" > 
                    <option value="">-- Chosir un domaine --</option>
                    <?php foreach ($domaines as $domaine) { 
                        if ($domaine['nom_domaine'] == $domaineFav){

                            $selection = "selected";
                        }else{
                            $selection = "";
                        }
                        
                        ?>            
                        <option  <?= $selection ?> class="font-normal" value="<?= $domaine['id_domaine']?>">
                            <?= $domaine['nom_domaine'] ?>
                        </option>
                    <?php 
                    } 
                    ?>                
                </select><br><br>

                <!--cases à cocher pour le choix de catégorie(s): -------------------------------->
                <fieldset >
                    <legend>Attribuer une ou plusieurs catégories:</legend>

                    <?php                        
                        foreach ($categories as $categorie) {
                            //echo $categorie['id_categorie'];
                            if(in_array( $categorie['id_categorie'], $categoryIdArray )== true){
                                $selection = "checked";
                              } else{
                                $selection = "";
                              }
                    ?>            
                        <div >
                            <input type="checkbox" <?= $selection ?> id="categorie" name="categorie[]" value="<?php echo $categorie['id_categorie']?>"/>
                            <label for="categorie">
                                    <?= $categorie['nom_cat'] ?>
                            </label>
                        </div>   
                    <?php 
                    } 
                    ?>                      
                </fieldset><br><br>
                
                <!-------------------Boutton submit---------------------------------------------->
                <button class="font-bold bg-blue-400 hover:bg-blue-900
                        text-white px-4 py-2 rounded h-10 ml-20 border border-gray-300 shadow-lg"
                        type="submit">Submit</button>
            </form>
        </div>
    </section>
</body>
</html>