
<?php include('header.php'); 
include("pdo.php");

$result = $pdo->query("SELECT * FROM favori");  //Déclare la veriable $result et lui assigne la valeur de la requete SQL 
$favori = $result->fetchAll(PDO::FETCH_ASSOC);  //Déclare la veriable $favori et lui assigne la valeur de $result
    
$result = $pdo->query("SELECT * FROM categorie");   //Assigne a $result la valeur de la requete SQL  
$categories = $result->fetchAll(PDO::FETCH_ASSOC); //Déclare la veriable $categories et lui assigne la valeur de $result

$result = $pdo->query("SELECT * FROM domaine");   //Assigne a $result la valeur de la requete SQL $result 
$domaines = $result->fetchAll(PDO::FETCH_ASSOC);   //Déclare la variable $categories et lui assigne la valeur de $result

$requeteSQL = "";   //Déclare la veriable $requeteSQL et lui assigne une valeur nulle 


//Déclare une boucle 'if' 

if (!empty($_GET['filtreCategorie'])){  // le parametre exprime: "si la valeur de la globale $_GET n'est pas vide alors..."

    $requeteSQL = "SELECT * FROM favori    /*  ... assigne, a $requeteSQL, le contenu de la table 'favori'... */ 
    INNER JOIN `cat-fav`                    /* ...lie a la table d'association cat-fav..  */
    ON favori.id_fav = `cat-fav`.`id_fav`   /**...par l'id_fav de la table favori et l'id_fav de la table cat-fav... */

    INNER JOIN `categorie`                   /*...lie a la table 'categorie'... */ 
    ON categorie.id_cat = `cat-fav`.id_cat    /** ...par l'id_cat de la table categorie et l'id_cat de la table cat-fav... */ 

    INNER JOIN domaine                          /*...lie a la table 'domaine '... */ 
    ON favori.id_dom = domaine.id_dom           /** ...par l'id_dom de la table favori et l'id_cat de la table domaine ...*/ 

    WHERE categorie.id_cat = " . $_GET['filtreCategorie']  //...du moment que l'id_cat de la table categorie est égal a la valeur de $_GET...
    . " AND domaine.id_dom = " . $_GET['filtreDomaine'];    //...et que le 

} else {                                                        
    $requeteSQL = "SELECT * FROM favori" ;                    //ou alors assigne, a $requeteSQL, la totalité de la table favori
};

$result = $pdo->query($requeteSQL);                     //Assigne a $result la valeur de $requeteSQL  
$favori = $result->fetchAll(PDO::FETCH_ASSOC);          //Assigne a $favori la valeur de $result 

?> 


<section id="bookmarks">
        <div class="inline justify-between flex-row bg-red-700 ">
            <form method="GET" action="">
                <div class="justify-between flex-row">
                    <label class="justify-between flex-row max-w-min" for="filtreCategorie">Choisissez une catégorie:</label>
                    <select class="justify-between flex-row max-w-min" name="filtreCategorie" id="filtreCategorie">
                        <option valeur="">--toutes--</option>
                        <?php
                            foreach ($categories as $categorie) { ?>
                            <option value="<?php echo $categorie['id_cat']?>">
                                <?php echo $categorie['nom']?>
                            </option>
                        <?php } ?>
                    </select> 
                </div>

                <div class="justify-between flex-row max-w-min">
                    <label class="justify-between flex-row max-w-min" for="filtreDomaine">Choisissez un domaine:</label>
                    <select class="justify-between flex-row max-w-min" name="filtreDomaine" id="filtreDomaine">
                        <option valeur="">--toutes--</option>
                        <?php
                            foreach ($domaines as $domaine) { ?>
                            <option value="<?php echo $domaine['id_dom']?>">
                                <?php echo $domaine['nom']?>
                            </option>
                        <?php } ?>
                    </select> 
                </div>

                <input class="justify-between flex-row max-w-min" type="submit" value="Filtrer">    

            </form>
            <button class="bouton justify-between flex-row max-w-min">Ajouter un favori</button>
        </div>

        <table class="table-fav">
            <tr class="border-separate border border-slate-500 border-indigo-500/100 ">
                <th class="border-separate border border-slate-500 border-indigo-500/100 px-3 text-center">id_fav</th>
                <th class="border-separate border border-slate-500 border-indigo-500/100 px-3 text-center">libelle</th>
                <th class="border-separate border border-slate-500 border-indigo-500/100 px-3 text-center">date_creation</th>
                <th class="border-separate border border-slate-500 border-indigo-500/100 px-3 text-center">url</th>
                <th class="border-separate border border-slate-500 border-indigo-500/100 px-3 text-center">id_dom</th>
                <th class="border-separate border border-slate-500 border-indigo-500/100 px-3 text-center">modifier</th>
                <th class="border-separate border border-slate-500 border-indigo-500/100 px-3 text-center">suprimer</th>
            </tr>

        <?php 
            foreach($favori as $fav){ 
        ?>
            <tr class="border-separate border border-slate-500 border-indigo-500/100 even:bg-white odd:bg-gray-200">
                <td class="border-separate border border-slate-500 border-indigo-500/100 text-center"><?php echo $fav['id_fav'];?></td>
                <td class="border-separate border border-slate-500 border-indigo-500/100 text-center"><?php echo $fav['libelle'];?></td>
                <td class="border-separate border border-slate-500 border-indigo-500/100 text-center"><?php echo $fav['date_creation'];?></td>
                <!--comme ci-dessous: l'ouverture de la balise php ainsi que le "echo" qui suis peuvent se contracter en un seul "< ?="-->
                <td class="border-separate border border-slate-500 border-indigo-500/100 text-center"><?=$fav['url'];?></td>
                <td class="border-separate border border-slate-500 border-indigo-500/100 text-center"><?=$fav['id_dom'];?></td>
                <td class="border-separate border border-slate-500 border-indigo-500/100 items-center"><i class="fa-solid fa-pen m-3"></i></td>
                <td class="border-separate border border-slate-500 border-indigo-500/100 items-center"><i class="fa-solid fa-trash-can m-3"></i></td>
            </tr>
        <?php
            }
        ?>
        </table>
    </section>

    
</body>

</html>