<?php

include("pdo.php");

$groupConcat = ", GROUP_CONCAT(categorie.nom_cat)"; 
$groupBy = "GROUP BY favoris.id_favori;";

$requeteSQL = "SELECT  *" . $groupConcat . " FROM favoris 
INNER JOIN cat_fav    ON favoris.id_favori = cat_fav.id_favori 
INNER JOIN categorie  ON categorie.id_categorie = cat_fav.id_categorie
INNER JOIN domaine    ON domaine.id_domaine = favoris.id_domaine
WHERE favoris.id_favori =" . $_GET['id_favori']; 
$groupBy;

$result = $pdo->query($requeteSQL);
$favoris = $result->fetch(PDO::FETCH_ASSOC);

?>
<!---------------------------------------------------HTML---------------------------------------------->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="./output.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/e14b518d69.js" crossorigin="anonymous"></script>
    <title>Single Favori</title>
</head>
<?php include("header.php");?>
<body class="flex flex-col items-center">
    <section class="flex flex-col max-w-2xl min-h-2xl m-4 p-3 justify-center">
        <div class="mb-3 p-3 flex justify-center text-blue-800 bg-gray-200 rounded-lg">
            <h1><strong><?php echo $favoris['libelle'] ?></strong></h1>
        </div>
        <div class="">
            <ul class="leading-10 p-3 min-h-64 bg-gray-100 rounded-lg">
                <li><strong>Date de création: </strong><?php echo $favoris['date_creation'] ?></li>
                <li><strong>URL: </strong><a href="<?php echo $favoris['url'] ?>"> <?php echo $favoris['url'] ?></a></li>
                <li><strong>Catégorie: </strong><?php echo $favoris['nom_cat'] ?></li>
                <li><strong>Domaine: </strong><?php echo $favoris['nom_domaine'] ?></li>
            </ul>
        </div>  
    </section>

</body>

</html>