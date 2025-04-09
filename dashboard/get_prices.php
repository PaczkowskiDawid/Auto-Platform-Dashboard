<?php
include 'config.php';

if (isset($_GET['an'])) {
    $an = $_GET['an'];
    $sql = "SELECT DISTINCT pret FROM cars WHERE an = '$an' ORDER BY pret ASC";
    $result = $conn->query($sql);

    echo '<option value="">Alege Preț</option>';
    while ($row = $result->fetch_assoc()) {
        echo '<option value="' . $row['pret'] . '">' . $row['pret'] . '</option>';
    }
}
?>
