<?php
    require_once 'hw1_config.php';
    $conn = connetti();
    
    $id_sondaggio = $_GET["id_sondaggio"];
    
    $contenuto = array();
    
    // Get all options for this poll WITH THEIR IDs
    $query = "SELECT Id, Opzione FROM opzioni WHERE Sondaggio = $id_sondaggio";
    $res_options = mysqli_query($conn, $query);
    
    $opzioni = array();
    while($row = mysqli_fetch_assoc($res_options)) {
        $opzioni[] = $row;
    }
    
    // Get all users who voted in this poll in a single query
    $query = "SELECT u.Username, p.Voto as OpzioneId, o.Opzione 
              FROM partecipanti p 
              JOIN utenti u ON p.utente = u.Id 
              JOIN opzioni o ON p.voto = o.Id 
              WHERE o.Sondaggio = $id_sondaggio
              ORDER BY o.Opzione";
    
    $res_users = mysqli_query($conn, $query);
    
    $utenti = array();
    while($row = mysqli_fetch_assoc($res_users)) {
        $utenti[] = $row;
    }
    
    // Create the final content structure
    $contenuto['opzioni'] = $opzioni;
    $contenuto['utenti'] = $utenti;
    
    // Clean up
    mysqli_free_result($res_options);
    mysqli_free_result($res_users);
    mysqli_close($conn);
    
    // Return JSON
    echo json_encode($contenuto);
?>
