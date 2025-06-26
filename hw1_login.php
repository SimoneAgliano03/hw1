<?php
    //Visualizzare SONDAGGI presenti nel DB
    require_once 'hw1_config.php';
    //CONNESSIONE al DB
    $conn = connetti();
    //Verifico se utente ha già effettuato l'accesso in questa sessione
    if(isset($_SESSION["username"]))
    {
        //Vado alla home_da_loggato
        header("Location: hw1_home_logged.php");
        exit;
    }
    //verifico se dati inviati con POST hanno corrispondenza nel DB,
    //controllo ridondante, già effettuato in JS
    if(isset($_POST["username"]) && isset($_POST["password"]))  { 
        //escape dell'input per evitare condotte fraudolente
        $username = mysqli_real_escape_string($conn, $_POST["username"]);
       
        $password = mysqli_real_escape_string($conn, $_POST["password"]);
        //ricerco utenti con le date credenziali
        $query = "SELECT id, username, Password FROM utenti WHERE username = '$username' AND Password = '$password'";

        /* AND Password = '".$password."' ";*/
        $res = mysqli_query($conn, $query) or die(mysqli_error($conn));
        
 
        if(mysqli_num_rows($res) > 0) {
            $entry = mysqli_fetch_assoc($res);     
            
            $_SESSION["username"] = $entry['username'];
            $_SESSION["id"] = $entry['id'];
            //vado alla home_loggato
            header("Location: hw1_home_logged.php");
            mysqli_close($conn);
            exit;
        }
        else    {
            //FLAG di errore
            $errore = true;
        }
    }

?>






<html>
    <head>
        <link rel='stylesheet' href='hw1_login_signup.css'>
        <script src='hw1_login.js' defer></script>
    </head>
    <body>
        <main>
            <!--// screen sito, esempio d'uso   -->
             <section class="main_left">
            </section>
            <section class="main_right">
                <h1>Doxa</h1>
            
                <form name='login' method='post'>
                    <input type='text' name='username' placeholder='Nome Utente'>                    
                    <input type='password' name='password' placeholder='Password'>                    
                    <input id='accedi' type='submit' name='accedi' value='Accedi'>                    
                    <?php
                    // Verifica la presenza di errori
                    if(isset($errore))
                    {
                        echo "<p class='errore'>";
                        echo "Credenziali non valide.";
                        echo "</p>";
                    }
                    ?>        
                </form>
                <div class="signup">Non hai un account? <a href="hw1_signup.php">Iscriviti</a>
            </section>
        </main>
    </body>
</html>
