<?php
    require_once 'hw1_config.php';

        //CONNESSIONE al DB
        $conn = connetti();




/*
    if(isset($_SESSION["username"]))
    {
        //vorrà dire che non ne deve mettere
    }
  */  
    //Visualizzare OPZIONI del SONDAGGIO passato nel form

    //CONNESSIONE al DB
    require_once 'hw1_config.php';
    //CONNESSIONE al DB
    $conn = connetti();
    
    //INIZIALIZZO ARRAY di ARRAY opzioni + sondaggio
    $sondaggio_opzioni = array();

    //INIZIALIZZO ARRAY di OPZIONI
    $opzioni = array();

    
    
    $id_sondaggio = $_GET['id_sondaggio'];
     

    $query = "SELECT Id, Descrizione, Orario, Luogo, Data_evento, Categoria, N_Votanti, Stato FROM sondaggi WHERE Id = $id_sondaggio";
    $res1 = mysqli_query($conn, $query);
    $sondaggio = mysqli_fetch_assoc($res1);
    
    //MOSTRARE OPZIONI POSSIBILI
    
    //Leggo caratteristiche sondaggi
    $query = "SELECT Opzione
    FROM opzioni WHERE Sondaggio = $id_sondaggio";
    $res2 = mysqli_query($conn, $query);
    while($row = mysqli_fetch_assoc($res2))  {
        $opzioni[] = $row;
    }

    //libero spazio occupato dai risultati di una query
    mysqli_free_result($res1);
    mysqli_free_result($res2);  
    //chiusura della connessione
    mysqli_close($conn);

    //ritorno il json

?>

<html>
    <head>
        <script src="hw1_check_pool.js" defer></script>
        <link rel = 'stylesheet' href="hw1.css">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title> HOMEPAGE </title>
    </head>
    <body>
            <nav>
                    <form name='indietro' action='hw1.php'>
                        <input type='submit' value='<-'>
                    </form>
            </nav>
            <div class="post_start">
                <h1> <?php 
                echo $sondaggio['Descrizione'];
                ?>
                </h1>
                <span id="primo">  
                    <?php  
                    echo " giorno: ".$sondaggio['Data_evento'];
                    ?>
                </span>
                <span>    
                    <?php
                    echo " ore: ".$sondaggio['Orario'];
                    ?>
                </span>
                <span id="ultimo">  
                    <?php  
                    echo " a ".$sondaggio['Luogo'];
                    ?>
                    <input type="hidden" name="luogo" value=<?php echo $sondaggio['Luogo'] ?> >
                </span>
                <div>
                    <img src="insta.png" class="chat">
                </div>
                
            <div>
            <div class='horizonthal'>
            <input type="hidden" name="username" value=
            <?php
            if(isset($_COOKIE["username"])) {
                echo $_COOKIE["username"];
            }
            ?>>
            <input type="hidden" name="utente_id" value=
            <?php
            if(isset($_COOKIE["utente_id"])) {
                echo $_COOKIE["utente_id"];
            }
            ?>>

            <div class="pointer" id="risultati">Risultati </div>
            <div class="pointer" id="dettagli">Dettagli</div>
            </div>
            <section id='sec_risultati' class='vote hidden'>
            </section>
            <section id='sec_dettagli' class='vote hidden'>
            </section>    

   </body>
</html>        
