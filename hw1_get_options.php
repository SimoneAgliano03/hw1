<?php
    //CONNESSIONE al DB
    require_once 'hw1_config.php';
    //CONNESSIONE al DB
    $conn = connetti();
    
    //INIZIALIZZO ARRAY di OPZIONI
    $opzioni = array();
    
    //MOSTRARE OPZIONI POSSIBILI per tutti i sondaggi
    
    //Leggo caratteristiche sondaggi
    $query = "SELECT Id, Sondaggio, Opzione
    FROM opzioni";
    $res = mysqli_query($conn, $query);
    while($row = mysqli_fetch_assoc($res))  {
        $opzioni[] = $row;
    }
    //libero spazio occupato dai risultati di una query
    mysqli_free_result($res);
    //chiusura della connessione
    mysqli_close($conn);

    //ritorno il json
    echo json_encode($opzioni);
?>
