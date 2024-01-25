<?php

require("connect.php");

$dsn = 'mysql:dbname='.BASE."; host=".SERVER;

    //$pdo = new PDO($dsn, 'root', '', array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));

try{
  $pdo=new PDO($dsn,USER,PASSWORD);
} catch(PDOException $e){
    echo "Echec de la connexion: %s\n" .$e->getMessage();
    exit();
}
echo "Connexion réussie";

?>