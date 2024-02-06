
<?php
//Connection à la base de donnees

//On recupère les constantes de connexion definis dans require.php
require("connect.php");

/*On prepara la connection à la base de donnees*/
$dsn = "mysql:dbname=". BASE . ";host=" . SERVER;

//On verifie si nous n'avons pas d'erreurs dans la connection à la bdd
try {
    $pdo = new PDO($dsn,USER,PASSWORD,array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
}catch(PDOException $e) {
    echo 'Impossible de connecter'. $e->getMessage();
    exit();
}
?>