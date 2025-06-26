<?php
    $dbhost="localhost";
    $dbuser="root";
    $dbpassword="";
    $dbname="hw1";
    session_start(); 
    
    function connetti(){
        global  $dbhost,$dbuser,$dbpassword,$dbname;
        $conn = mysqli_connect($dbhost,$dbuser,$dbpassword) or die("Connessione Fallita");
        mysqli_select_db($conn,$dbname);
        return $conn;
    }
?>
