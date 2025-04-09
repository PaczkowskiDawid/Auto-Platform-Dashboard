<?php
include 'config.php';

if (isset($_GET['motorizare'])) {
    $motorizare = $_GET['motorizare'];
    $sql = "SELECT DISTINCT cutie_viteze FROM cars WHERE motorizare = '$motorizare' ORDER BY cutie_viteze ASC";
    $result = $conn->query($sql);

    echo '<option value="">Alege Cutie Viteze</option>';
    while ($row = $result->fetch_assoc()) {
        echo '<option value="' . $row['cutie_viteze'] . '">' . $row['cutie_viteze'] . '</option>';
    }
}
?>
