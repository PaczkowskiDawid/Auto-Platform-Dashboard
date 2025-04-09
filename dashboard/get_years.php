<?php
include 'config.php';

if (isset($_GET['model'])) {
    $model = $_GET['model'];
    $sql = "SELECT DISTINCT an FROM cars WHERE model = '$model' ORDER BY an DESC";
    $result = $conn->query($sql);

    echo '<option value="">Alege An</option>';
    while ($row = $result->fetch_assoc()) {
        echo '<option value="' . $row['an'] . '">' . $row['an'] . '</option>';
    }
}
?>
