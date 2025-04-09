<?php
include 'config.php';

if (isset($_GET['marca'])) {
    $marca = $_GET['marca'];
    $sql = "SELECT DISTINCT model FROM cars WHERE marca = '$marca' ORDER BY model ASC";
    $result = $conn->query($sql);

    echo '<option value="">Alege Model</option>';
    while ($row = $result->fetch_assoc()) {
        echo '<option value="' . $row['model'] . '">' . $row['model'] . '</option>';
    }
}
?>