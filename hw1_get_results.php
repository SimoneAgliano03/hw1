<?php
    //CONNESSIONE al DB
    require_once 'hw1_config.php';
    //CONNESSIONE al DB
    $conn = connetti();
    
    $id_sondaggio = $_GET["id_sondaggio"];
    
    // Better query that shows ALL options with their vote counts
    // Even options with zero votes will appear in results
    $query = "SELECT o.Id as voto, o.Opzione as opzione, 
              COUNT(p.Voto) as n_occ_voto 
              FROM opzioni o 
              LEFT JOIN partecipanti p ON o.Id = p.Voto 
              WHERE o.Sondaggio = $id_sondaggio 
              GROUP BY o.Id, o.Opzione";
    
    $res = mysqli_query($conn, $query);
    
    $occorrenze_voto = array();
    while($row = mysqli_fetch_assoc($res)) {
        $occorrenze_voto[] = $row;
    }
    
    //libero spazio occupato dai risultati di una query
    mysqli_free_result($res);
    
    //chiusura della connessione
    mysqli_close($conn);

    //ritorno il json
    echo json_encode($occorrenze_voto);


    //noto che: p.voto è una informazione ridondante
?>
