<?php
    require_once 'hw1_config.php';
    //CONNESSIONE al DB
    $conn = connetti();

    /*
    echo $_SESSION["username"];
    echo $_SESSION["id"];
*/

    if(!isset($_SESSION["username"]))
    {
        $errore = true;
        echo "errore";
    }
    

    if(isset($_POST["descrizione"]) && isset($_POST["orario"]) && isset($_POST["luogo"]) && isset($_POST["data"]) && isset($_POST["categoria"]))  {
  
    $descrizione = mysqli_real_escape_string($conn, $_POST["descrizione"]);
    $orario = mysqli_real_escape_string($conn, $_POST["orario"]);
    $luogo = mysqli_real_escape_string($conn, $_POST["luogo"]);
    $data = mysqli_real_escape_string($conn, $_POST["data"]);
    $categoria = mysqli_real_escape_string($conn, $_POST["categoria"]);
    
    $id = $_SESSION["id"]; 
    
    //AGGIUNGO SONDAGGIO in TABELLA SONDAGGI
    $query = "INSERT INTO sondaggi(descrizione, orario, luogo, data_evento, categoria, utente) VALUES(\"$descrizione\", \"$orario\", \"$luogo\", \"$data\", \"$categoria\", $id) ";
    mysqli_query($conn, $query);
    
    $sondaggio = mysqli_insert_id($conn);
    
    echo "ciao";

    foreach($_POST['opzione'] as $o){
        $opzione = mysqli_real_escape_string($conn, $o);       
        $query = "INSERT INTO opzioni(Sondaggio, Opzione) VALUES(\"$sondaggio\", \"$opzione\") ";
        mysqli_query($conn, $query);
    }
    
    mysqli_close($conn);
    header("Location: hw1_home_logged.php");
    exit;
    }
?>

<html>
    <head>
        <link rel='stylesheet' href='hw1_login_signup.css'>
        <script src='hw1_create_pool.js' defer></script>
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    <body> 
        <main id="main_create_pool">
            <!--// screen sito, esempio d'uso   -->
            <section class="create_pool">
                <div class="scelta">
                    <h1>Doxa</h1>          
                    <form name='indietro' action='hw1_home_logged.php'>
                        <input type='submit' value='<-'>
                    </form>
                </div>  
                <form name='login' action='hw1_create_pool.php' method='post'>
                    <h3> Descrizione </h3>
                    <textarea name='descrizione'></textarea>                    
                    <h3> Orario </h3>
                    <input type="time" name='orario'>                    
                    <h3> Luogo </h3>
                    <input type='text' name='luogo'>                    
                    <h3> Data dell'evento </h3>
                    <input type='date' name='data'>                    
                    <h3> Categoria </h3>
                    <input type='text' name='categoria'>
                    <h3> Opzione 1 </h3>
                    <input type='text' name='opzione[]'>
                    <h3> Opzione 2 </h3>
                    <input type='text' name='opzione[]'>
                    <input type='button' value='+   Aggiungi Opzione'>
                    <div class='hidden'>                    </div>
                    <div class='button-center'>
                        <input id='fine' type='submit' value='+'>                  
                    </div>  
                </form>
            </section>
        </main>
    </body>
</html>
