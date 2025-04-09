<?php
$servername = "localhost"; // Serverul MySQL, de obicei 'localhost' pe Bluehost
$username = ""; // Numele de utilizator MySQL
$password = ""; // Parola MySQL
$dbname = ""; // Numele bazei de date

// Crează conexiunea
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Verifică conexiunea
if (!$conn) {
    die("Conexiune eșuată: " . mysqli_connect_error());
}

// Dezactivează modurile stricte din MySQL pentru sesiunea curentă
mysqli_query($conn, "SET SESSION sql_mode = 'NO_ENGINE_SUBSTITUTION';");

// Activează afișarea erorilor (pentru debugging)
error_reporting(E_ALL);
ini_set('display_errors', 1);

?>
