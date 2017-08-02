<?php
// CONNEXION à la DATABASE "mycave-db" :
    try{
        $mycaveDb = new PDO('mysql:host=localhost;dbname=mycave_db;charset=utf8','root','',
        array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));// paramètre pour activer les erreurs
    }
    catch(Exeption $e)
    {
        die('Erreur : ' . $e->getMessage());
    }
// var_dump($mycaveDb);
?>