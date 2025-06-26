<?php
    //Visualizzare SONDAGGI presenti nel DB

    //CONNESSIONE al DB
    require_once 'hw1_config.php';
    //CONNESSIONE al DB
    $conn = connetti();
    

    $cerca = $_GET["cerca"];
    
    $cerca = $cerca."%";

    //INIZIALIZZO ARRAY di SONDAGGI
    $sondaggi = array();

    $query ="SELECT Id, Descrizione, Orario, Luogo, Categoria, N_Votanti, Stato
    FROM sondaggi
    WHERE Descrizione LIKE '$cerca' LIMIT 10";

    //Leggo caratteristiche sondaggi
    $res = mysqli_query($conn, $query);
    while($row = mysqli_fetch_assoc($res))  {
        $sondaggi[] = $row;
    }
    //libero spazio occupato dai risultati di una query
    mysqli_free_result($res);
    //chiusura della connessione
    mysqli_close($conn);
    //ritorno il json
    echo json_encode($sondaggi);
?>
