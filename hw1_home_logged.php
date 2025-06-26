<?php
    require_once 'hw1_config.php';
    
    $conn = connetti();
    
    if(!isset($_SESSION["id"]))
    {
        //Non sono loggato
        header("Location: hw1_login.php");
        exit;
    }

?> 

<html>
    <head>
        <script src="hw1_home_logged.js" defer></script>
        <link rel = 'stylesheet' href="hw1_home_logged.css">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title> HOMEPAGE </title>
    </head>
    <body>
        <section id="left" class="side">   <!-- LAT. SX: CATEGORIA -> LISTA Puntata            -->
                <h1>CATEGORIE</h1>
                <ul>
                </ul>
        </section>
        <section id="central">
            <h1>I Miei Sondaggi</h1>
           <!--
            <div id="search">
                <form>   
                    <input type='text' placeholder='Cerca'>
                    <input type="hidden" name="id" value=<?php echo $_SESSION["id"] ?> >
                </form>
            </div>
            -->
            <div id="container"></div>
        </section>
        <section  id="right" class="side">
            <form name='create_pool' action='hw1_create_pool.php'>
                <input id='create_pool' type='submit' name='create_pool' value='Crea Nuovo Sondaggio'>
            </form>
                <a href="hw1_logout.php">LOGOUT</a>
        </section>
    </body>
</html>


