<?php    
?>


<html>
    <head>
        <script src="hw1_home.js" defer></script>
        <link rel = 'stylesheet' href="hw1.css">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title> HOMEPAGE </title>
    </head>
    <body>
        <main>
            <section id="left" class="side">   <!-- LAT. SX: CATEGORIA -> LISTA Puntata            -->
                <h3>CATEGORIE</h3>
                    <ul>

                    </ul>
                    
            </section>
            <section id="central">
                <div id="search">
                    <form name='cerca' action='hw1_get_search.php' method='get'>   
                    <input type='text' placeholder='Cerca' name='cerca' class="cerca">
                    </form>
                </div>
                <div class="container"></div>
            </section>
            <section id="right" class="side">
                <form name='login' action='hw1_login.php' method='post'>
                        <!-- sono elementi inline -->
                    <input id='accedi' type='submit' name='accedi' value='Accedi'>        
                </form>
                <form name='sign_up' action='hw1_signup.php'>
                    <input id='registrati' type='submit' name='registrati' value='Registrati'>
                </form>
            </section>
    
        </main>
    </body>
</html>