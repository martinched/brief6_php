<?php include('header.php'); 
include("pdo.php");
$result = $pdo->query("SELECT * FROM favori");
    $favori = $result->fetchAll(PDO::FETCH_ASSOC); 
    
?>  
<section id="bookmarks">
        <table class="table-fav">
            <tr>
                <th>id_fav</th>
                <th>libelle</th>
                <th>date_creation</th>
                <th>url</th>
                <th>id_dom</th>
            </tr>

        <?php 
            foreach($favori as $fav){ 
        ?>
            <tr>
                <td><?php echo $fav['id_fav'];?></td>
                <td><?php echo $fav['libelle'];?></td>
                <td><?php echo $fav['date_creation'];?></td>
                <!--comme ci-dessous: l'ouverture de la balise php ainsi que le "echo" qui suis peuvent se contracter en un seul "< ?="-->
                <td><?=$fav['url'];?></td>
            </tr>
        <?php
            }
        ?>
        </table>
    </section>

    
</body>

</html>