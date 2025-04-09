<?php
include 'config.php';

if (isset($_GET['cutie_viteze'])) {
    $cutie = $_GET['cutie_viteze'];
    $sql = "SELECT DISTINCT capacitate_cilindrica FROM cars WHERE cutie_viteze = '$cutie' ORDER BY capacitate_cilindrica ASC";
    $result = $conn->query($sql);

    echo '<option value="">Alege Capacitate Cilindrică</option>';
    while ($row = $result->fetch_assoc()) {
        echo '<option value="' . $row['capacitate_cilindrica'] . '">' . $row['capacitate_cilindrica'] . '</option>';
    }
}
?>
