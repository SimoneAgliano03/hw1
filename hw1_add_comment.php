<?php
    require_once 'hw1_config.php';
    //CONNESSIONE al DB
    $conn = connetti();

    $id_sondaggio = mysqli_real_escape_string($conn,$_GET["id_sondaggio"]);
    $utente_id = mysqli_real_escape_string($conn,$_GET["utente_id"]);
    $testo = mysqli_real_escape_string($conn, $_GET["testo"]);


    $query =  "INSERT INTO commenti(Utente, Sondaggio, Testo)  VALUES (\"$utente_id\", \"$id_sondaggio\",  \"$testo\")";
 
    mysqli_query($conn, $query);
    
    
    mysqli_close($conn);
?>
