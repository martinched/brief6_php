<?php include('header.php'); 
include("pdo.php");
$result = $pdo->query("SELECT * FROM favori");
    $favori = $result->fetchAll(PDO::FETCH_ASSOC); 
    
?>  
<section id="bookmarks">
        <div class="flex justify-end"><button class="bouton ">Ajouter un favori</button></div>
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