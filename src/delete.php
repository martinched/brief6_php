<?php 
include("pdo.php");

//var_dump($_GET['id_favori']);


//On verifie si nous n'avons pas d'erreurs dans la requête de suppression
try {
    
    $deleteRegister = "DELETE FROM favoris WHERE favoris.id_favori =" . $_GET['id_favori'];
    
    $pdo->query($deleteRegister);
        
    header('Location: index.php?resultat=1');

}catch(PDOException $e) {
    
    header("Location: index.php?resultat=2");
    exit();
}
