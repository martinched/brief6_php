<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP PDO</title>
    <link href="./output.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/e14b518d69.js" crossorigin="anonymous"></script>
    <!-----------font Roboto--------------->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap">
    <script src="script.js"></script>
</head>

<body class="flex flex-col items-center">
    
    <?php 
    /*Pour lisibilité, le header a été placé dans un autre fichier et "include" le recupère*/
    include("header.php");
    /*PDO se connecte à la base de donées */
    include("pdo.php");

    /*---------------------------Affichage erreur ou succès dans les requettes delete, création; MAJ...---------*/
    if(isset($_GET['resultat'])){
        $resultat = $_GET['resultat'];
        //var_dump($_GET['resultat']);
      
        switch($resultat) {
            case "1": 
                $message = 'suppression réussie';
                break;

            case "2": 
                $message = 'La suppression à échoué, veuillez réessayer';
                break;
            
            case "3": 
                $message = 'La mise à jour à bien été effectuée';
                break;

            case "4": 
                $message = 'La mise à jour à échoué, veuillez réessayer';
                break;

            case "5": 
                $message = 'Le favoris à bien été crée';
                break;

            case "6": 
                $message = "L'ajout de favori à échoué, veuillez réessayer<h1>";
                break;
        }
        
        echo '<div 
                class=" bg-blue-600 text-white px-4 py-2 rounded h-10 border
                     border-gray-300 shadow-lg text-center w-80">
                        <h1 class="" id="resultatRequete">
                            ' . $message . '
                        <h1>
            </div>';

        }


    /* La requête SQL effectue le trie propose sur le DOM. Je l'ai générée sur phpMyAdmin pour confort 
    et pour la tester avant de l'implementer sur l'index*/
    $requeteSQL="";

    //Ci-dessous la requête qui permettra d'effectuer le tri:-----------------------------------------------------
    
   /* Je declare ces deux variables pour construire ma requette:
   le syntaxe SQL oblige à placer le GROUP BY à la fin de la requêtte, ce qui difficulte le
   cumul des conditions*/ 
    $groupConcat = ""; 
    $groupBy = "";

    $requeteSQL = "SELECT  *" . $groupConcat . " FROM favoris 
    INNER JOIN cat_fav    ON favoris.id_favori = cat_fav.id_favori 
    INNER JOIN categorie  ON categorie.id_categorie = cat_fav.id_categorie
    INNER JOIN domaine    ON domaine.id_domaine = favoris.id_domaine
    WHERE 1=1 " . 
    $groupBy;

    if (empty($_GET['filtreCategorie']) && empty($_GET['filtreDomaine']) && empty($_GET['filtreTextuel'])) { 
        
        $groupConcat = ", GROUP_CONCAT(categorie.nom_cat)"; 
        $groupBy = "GROUP BY favoris.id_favori;";
        
        $requeteSQL = "SELECT  *" . $groupConcat . " FROM favoris 
        INNER JOIN cat_fav    ON favoris.id_favori = cat_fav.id_favori 
        INNER JOIN categorie  ON categorie.id_categorie = cat_fav.id_categorie
        INNER JOIN domaine    ON domaine.id_domaine = favoris.id_domaine
        WHERE 1=1 " . 
        $groupBy; 
    }     
    
    if (!empty($_GET['filtreCategorie'])) { /* !empty verifie qu'il y ait un valeur attribué à 
        $_GET['filtreCategorie']*/
        $requeteSQL .= " AND categorie.id_categorie     = " . $_GET['filtreCategorie'];

    } 
       
    if (!empty($_GET['filtreDomaine'])) { /* !empty verifie qu'il y ait un valeur attribué à 
            $_GET['filtreCategorie']*/
        $requeteSQL .= " AND domaine.id_domaine         = " . $_GET['filtreDomaine']; 
    }
    
    if (!empty($_GET['filtreTextuel'])) { /* !empty verifie qu'il y ait un valeur attribué à 
        $_GET['filtreTextuel']*/
    $requeteSQL .= " AND libelle LIKE                    '%" . $_GET['filtreTextuel'] . "%'"; 
    }
    ;
    
    $result = $pdo->query($requeteSQL);
    $favoris = $result->fetchAll(PDO::FETCH_ASSOC);

    /*--Requête par domaine-------------------------------------------------------------------------------------*/   
  
    
        $result = $pdo->query("SELECT * FROM categorie");
        $categories = $result->fetchAll(PDO::FETCH_ASSOC);
        $result = $pdo->query("SELECT * FROM domaine");
        $domaines = $result->fetchAll(PDO::FETCH_ASSOC);
        $result = $pdo->query("SELECT * FROM domaine");
        $libelle = $result->fetchAll(PDO::FETCH_ASSOC);
    ?>
    <!----------Options de tri et recherche--------------------------------------------------------------------------------->
    <div class="justify-center bg-gray-100 m-5 align-middle hidden" id="collapseFilter" >    
        <form class="w-full overflow-x-hidden items-center
                     sm:flex" 
                    action="" method="GET">
            <!--Options de tri par categorie --------------------------> 
            <div class="flex flex-col p-4
                        sm:flex-row">
                <h2>Selectionnez une catégorie</h2>             
                <select name="filtreCategorie" >
                    
                <option value="">-- toutes --</option>
    
                <?php foreach ($categories as $categorie) { ?>            
                    <option class="font-normal" value="<?php echo $categorie['id_categorie']?>">
                        <?= $categorie['nom_cat'] ?>
                    </option>
                <?php 
                } 
                ?>                
                </select>
            </div>
            <!----Options de tri par domaine---------------------------->
            <div class="flex flex-col p-4">

                <h2>Selectionnez un domaine</h2>            
                <select name="filtreDomaine" > 
                    <option value="">-- toutes --</option>
                    <?php foreach ($domaines as $domaine) { ?>            
                        <option class="font-normal" value="<?php echo $domaine['id_domaine']?>">
                            <?= $domaine['nom_domaine'] ?>
                        </option>
                    <?php 
                    } 
                    ?>                
                </select><br>
            </div>
            <!--------------------recherche textuelle----------------------->
            <div class=" bg-gray-100 p-4 items-center">
                <label for="filtreTextuel">Barre de recherche</label>
                <input class="rounded" type="search" name="filtreTextuel" placeholder="Écris ici ta recherche">
            </div>

            <!----------------------Bouton filtrer----------------------->
            <button class="font-bold bg-blue-400 hover:bg-blue-900 text-white px-4 py-2 rounded h-10 ml-20 border border-gray-300 shadow-lg" 
                type="submit">Filtrer
            </button>
              
        </form>
                 
    </div>
    
    <!--Formulaire----------------------------------------------------------------------------------------------->
    
    <section id="favoris" class="flex justify-center">      
        <table class="table_favori m-10 border border-gray-300 shadow-lg">            
            <!--Titres du tablau----------------------->
            <tr class="text-center text-blue-800 bg-gray-200 w-100">
                <th>Id favori</th>
                <th class="text-center text-blue-800">Libellé</th>
                <th class="max-sm:hidden">Creation</th>
                <th class="max-sm:hidden">Domaine</th>
                <th class="max-sm:hidden">Categorie(s)</th>
                <th>Actions</th>
            </tr>
            <!---Registres generés en dynamique------------------------------------------------->
            <?php foreach ($favoris as $favori) { ?>
            <tr class="h-10 ml-10 bg-gray-100 hover:bg-blue-900 hover:text-white border border-gray-200 font-normal mx-auto max-w-screen-md even:bg-white odd:bg-gray-200">
                <td class="text-center font-normal" ><?= $favori['id_favori'] ?></td>
                <td class="font-normal text-left  max-w-60" >
                    <a class="text-wrap" href=" <?= $favori['url'] ?>"><?= $favori['libelle'] ?></a>
                </td>
                <td class="max-sm:hidden font-normal text-left>" ><?= $favori['date_creation'] ?></td>
                <td class="max-sm:hidden text-center font-normal w-40" ><?= $favori['nom_domaine'] ?></td>
                <td class="max-sm:hidden font-normal" ><?= $favori['GROUP_CONCAT(categorie.nom_cat)'] ?></td>

                <!------------------------Case "Actions"-------------------------------------->
                <td class="flex pt-2 pl-3 ">
                    <!-----------------------Single page---------------->
                    <form action="singleFavori.php" method="get">
                        <button name="id_favori" value="<?php echo $favori['id_favori']?>">
                            <i class="fa-solid fa-eye text-blue-800 m-1 hover:text-white"></i>
                        </button>
                    </form>
                    <!-----------------------Udpate---------------------->
                    <a href="update.php?id_favori=<?php echo $favori['id_favori']; ?>" name="id_favori" > 
                        <i class="fa-solid fa-pencil text-blue-800 m-1 hover:text-white"></i>
                    </a>                   
                    <!------------------------Delete---------------------->
                    <a href="#" name="id_favori" id="delete" onclick="confirmDelete(<?php echo $favori['id_favori']; ?>);"> 
                        <i class="fa-solid fa-trash text-blue-800 m-1 hover:text-white"></i>
                    </a>
                </td>
            </tr>
            <?php 
            } 
            ?>
        </table>
    </section>
</body>
</html>