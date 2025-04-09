<!-- <?php
include 'config.php';

if (isset($_POST['marca'])) {
    $marca = $_POST['marca'];
    $query = "SELECT DISTINCT model FROM cars WHERE marca = '$marca' ORDER BY model ASC";
    $result = mysqli_query($conn, $query);
    
    $options = "<option value=''>Alege model</option>";
    while ($row = mysqli_fetch_assoc($result)) {
        $options .= "<option value='" . $row['model'] . "'>" . $row['model'] . "</option>";
    }
    echo $options;
}
?> -->
