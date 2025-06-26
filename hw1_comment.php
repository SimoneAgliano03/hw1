<?php
    require_once 'hw1_config.php';
    //CONNESSIONE al DB
    $conn = connetti();

    $id_sondaggio = $_GET["id_sondaggio"];

    
    $commenti = array();

    //provare altra query

    $query=" SELECT c.Sondaggio, u.id as Id_Utente, u.username , c.Testo FROM commenti as c , utenti as u WHERE c.Utente = u.Id AND c.Sondaggio = $id_sondaggio ORDER BY 'ASC'";
    
    $res = mysqli_query($conn,$query);
    

    while($row = mysqli_fetch_assoc($res)) {
        $commenti[] = $row;
    }


    mysqli_free_result($res);
    mysqli_close($conn);

    
    echo json_encode($commenti);    
?>