<?php
    require_once 'hw1_config.php';
    //CONNESSIONE al DB
    $conn = connetti();
 
    $voto = mysqli_real_escape_string($conn, $_GET["voto"]);
    $id_sondaggio = mysqli_real_escape_string($conn, $_GET["id_sondaggio"]);

    if(isset($_SESSION["username"]))
    {
        $utente_id = mysqli_real_escape_string($conn, $_SESSION["id"]);
        $utente = $_SESSION["username"];
    }
    else{
        $utente = mysqli_real_escape_string($conn, $_GET["username"]);
        
        $query = "INSERT INTO utenti(username) VALUES(\"$utente\")";  
        mysqli_query($conn, $query);

        $utente_id = mysqli_insert_id($conn);  
    }

    setcookie("username", $utente);
    setcookie("utente_id", $utente_id);

    $query = "INSERT INTO partecipanti(utente, voto) VALUES(\"$utente_id\", \"$voto\")";
    mysqli_query($conn, $query);

    $query = "UPDATE sondaggi SET N_Votanti = N_Votanti + 1 WHERE Id = $id_sondaggio";
    mysqli_query($conn, $query);
    
    setcookie("username", $utente);
    
    mysqli_close($conn);

    header("Location: hw1_vote_pool.php?id_sondaggio=".$id_sondaggio);
    exit;
?>
