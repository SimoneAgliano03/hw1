<?php
    require_once 'hw1_config.php';
    //CONNESSIONE al DB
    $conn = connetti();

        

    //verifico se dati inviati con POST hanno corrispondenza nel DB,
    //controllo ridondante, già effettuato in JS
    if(!empty($_POST["username"]) && !empty($_POST["password"]))  {

        if ( strlen($_POST["password"]) < 5) {
            echo "<h1> Errore: Password troppo corta, inserire almeno 5 caratteri</h1>";
        }

        //escape dell'input per evitare condotte fraudolente
        $username = mysqli_real_escape_string($conn, $_POST["username"]);
        //ricerco utenti con le date credenziali
        $query = "SELECT username FROM utenti WHERE username = '".$username."' ";
        $res = mysqli_query($conn, $query);

        $num_rows = mysqli_num_rows($res);
        if($num_rows > 0)   {
            //FLAG DI ERRORE
            $errore = true;
        }
        else{
            $password = mysqli_real_escape_string($conn, $_POST["password"]);
//            $password = password_hash($password, PASSWORD_BCRYPT);

            //escape delle variabili nome e cognome
            $nome_escaped = mysqli_real_escape_string($conn, $_POST["nome"]);
            $cognome_escaped = mysqli_real_escape_string($conn, $_POST["cognome"]);

            //query di inserimento
            mysqli_query($conn, "INSERT INTO utenti(nome, cognome, username, password, livello) VALUES(\"$nome_escaped\", \"$cognome_escaped\", \"$username\", \"$password\", \"1\")");
            
            
            $_SESSION["username"] = $_POST["username"];
            $_SESSION["id"] = mysqli_insert_id($conn);
            //chiudo connessione
            mysqli_close($conn);
            header("Location: hw1_home_logged.php");
            exit;
        }
    }  

?>

<html>
    <head>
        <link rel='stylesheet' href='hw1_login_signup.css'>
        <script src='hw1_signup.js' defer></script>
        <meta name="viewport" content="width=device-width, initial-scale=1">
 
    </head>
    <body>
        <main>
            <!--// screen sito, esempio d'uso   -->
             <section class="main_left">
            </section>
            <section class="main_right">
                <h1>Doxa</h1>
            
                <form name='login' method='post'>
                    <?php
                    // Verifica la presenza di errori
                    if(isset($errore))
                    {
                        echo "<p class='errore'>";
                        echo "Username non disponibile.";
                        echo "</p>";
                    }
                    ?>
                    <input type='text' name='nome' placeholder='Nome'>                    
                    <input type='text' name='cognome' placeholder='Cognome'>                    
                    <input type='text' name='username' placeholder='Nome Utente'>                    
                    <input type='password' name='password' placeholder='Password'>                    
                    <input type='password' name='conf_password' placeholder='Conferma Password'>                    
                    <input id='registrati' type='submit' name='registrati' value='Registrati'>                    
                </form>
            </section>
        </main>
    </body>
</html>