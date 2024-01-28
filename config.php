<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
    $servername = "localhost";
    $username = "lucas";
    $password = "123";
    $dbname = "login";


    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verifica a conexão
    if ($conn->connect_error) {
        die("Falha na conexão: " . $conn->connect_error);
    }
?>