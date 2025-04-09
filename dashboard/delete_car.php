<?php
// include conexiunea la baza de date
include('config.php'); 

// Verifică dacă id-ul a fost transmis prin URL
if (isset($_GET['id'])) {
    // Preia id-ul din URL
    $car_id = $_GET['id'];

    // Pregătește interogarea SQL pentru a șterge mașina cu id-ul respectiv
    $sql = "DELETE FROM cars WHERE id = ?";

    // Pregătește și execută interogarea
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("i", $car_id);
        if ($stmt->execute()) {
            // Dacă ștergerea a avut succes, redirecționează înapoi la pagina principală
            header("Location: admin_dashboard.php");
            exit();
        } else {
            echo "Eroare la ștergere: " . $stmt->error;
        }
    } else {
        echo "Eroare la pregătirea interogării: " . $conn->error;
    }
} else {
    echo "ID-ul nu a fost specificat.";
}
?>
