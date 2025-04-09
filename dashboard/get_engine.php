<?php
include 'config.php';

if (isset($_GET['pret'])) {
    $pret = $_GET['pret'];
    $sql = "SELECT DISTINCT motorizare FROM cars WHERE pret = '$pret' ORDER BY motorizare ASC";
    $result = $conn->query($sql);

    echo '<option value="">Alege Motorizare</option>';
    while ($row = $result->fetch_assoc()) {
        echo '<option value="' . $row['motorizare'] . '">' . $row['motorizare'] . '</option>';
    }
}
?>
