<?php
    //Visualizzare SONDAGGI presenti nel DB
    require_once 'hw1_config.php';
    //CONNESSIONE al DB
    $conn = connetti();
    //INIZIALIZZO ARRAY di SONDAGGI
    $sondaggi = array();

    $username = $_SESSION["username"];

    $query =    "SELECT Descrizione, Orario, Luogo, Categoria, N_Votanti, Stato 
                FROM sondaggi JOIN utenti ON sondaggi.Utente = Utenti.Id 
                WHERE Utenti.Username = '".$username."' LIMIT 10";


    //Leggo caratteristiche sondaggi
    $res = mysqli_query($conn, $query) or die(mysqli_error($conn));
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
