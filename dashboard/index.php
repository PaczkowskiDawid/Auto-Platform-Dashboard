<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Conectare la baza de date
include 'dashboard/config.php';

// Preluăm mașinile active din tabelul 'cars'
$result = mysqli_query($conn, "SELECT * FROM cars WHERE status = 'active'");

// Verificăm dacă interogarea a reușit
if (!$result) {
    // Dacă interogarea a eșuat, afișăm eroarea
    die('Eroare interogare SQL: ' . mysqli_error($conn));
}

echo '<div class="car-container">';
while ($row = mysqli_fetch_assoc($result)) {
    echo '<div class="car-card" id="car-' . $row['id'] . '">
              <h3>' . $row['marca'] . ' ' . $row['model'] . '</h3>
              <p>Preț: ' . $row['pret'] . ' €</p>
              <p>An: ' . $row['an'] . '</p>
              <p>Motorizare: ' . $row['motorizare'] . '</p>
              <p>Kilometraj: ' . $row['kilometraj'] . ' km</p>
              <button onclick="deleteCar(' . $row['id'] . ')">Șterge</button>
          </div>';
}

echo '</div>';
?>
