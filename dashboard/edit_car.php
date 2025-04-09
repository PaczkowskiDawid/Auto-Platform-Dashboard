<?php
// Conectare la baza de date
include 'config.php';

// Verificăm dacă există ID-ul în URL și este numeric
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("Eroare: ID-ul mașinii lipsește sau este invalid!");
}

$id = $_GET['id'];

// Interogare pentru a prelua datele mașinii
$sql = "SELECT * FROM cars WHERE id = $id";
$result = mysqli_query($conn, $sql);

if (!$result || mysqli_num_rows($result) == 0) {
    die("Eroare: Mașina nu a fost găsită în baza de date!");
}

$car = mysqli_fetch_assoc($result);

// Preluăm imaginile secundare
$sql_images = "SELECT * FROM car_images WHERE car_id = $id";
$result_images = mysqli_query($conn, $sql_images);
$images = mysqli_fetch_all($result_images, MYSQLI_ASSOC);

// Procesare formular editare
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $marca = $_POST['marca'];
    $model = $_POST['model'];
    $an = $_POST['an'];
    $pret = $_POST['pret'];
    $motorizare = $_POST['motorizare'];
    $cutie_viteze = $_POST['cutie'];
    $capacitate_cilindrica = $_POST['capacitate'];
    $kilometraj = $_POST['kilometraj'];
    $descriere = mysqli_real_escape_string($conn, $_POST['descriere']);
    $reducere = isset($_POST['reducere']) ? 1 : 0;

    // Verificăm dacă a fost selectată o imagine nouă
    if ($_FILES['imagine']['name'] != '') {
        $old_image = $car['imagine'];
        if (file_exists($old_image)) {
            unlink($old_image);
        }

        // Preia fișierul imagine
        $image = $_FILES['imagine']['name'];
        $image_temp = $_FILES['imagine']['tmp_name'];
        $image_folder = "uploads/" . $image;

        // Mută imaginea în directorul corespunzător
        move_uploaded_file($image_temp, $image_folder);
    } else {
        // Dacă nu s-a selectat o imagine nouă, păstrăm imaginea veche
        $image_folder = $car['imagine'];
    }

    // Actualizăm informațiile despre mașină
    $sql = "UPDATE cars SET 
                marca='$marca', model='$model', an='$an', pret='$pret', 
                motorizare='$motorizare', cutie_viteze='$cutie_viteze', capacitate_cilindrica='$capacitate_cilindrica', kilometraj='$kilometraj',
                descriere='$descriere', imagine='$image_folder',  reducere='$reducere' 
            WHERE id = $id";

    if (mysqli_query($conn, $sql)) {
        // Gestionăm imaginile secundare
        if (!empty($_FILES['imagini_secundare']['name'][0])) {
            foreach ($_FILES['imagini_secundare']['tmp_name'] as $key => $tmp_name) {
                $file_name = basename($_FILES['imagini_secundare']['name'][$key]);
                $target_path = "uploads/" . $file_name;

                if (move_uploaded_file($tmp_name, $target_path)) {
                    // Inserează fiecare imagine în baza de date
                    $sql_insert_image = "INSERT INTO car_images (car_id, image_path) VALUES ('$id', '$target_path')";
                    mysqli_query($conn, $sql_insert_image);
                }
            }
        }

        header("Location: admin_dashboard.php");
        exit();
    } else {
        echo "Eroare la actualizare: " . mysqli_error($conn);
    }
}
?>


<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editează Mașina</title>
    <link rel="stylesheet" href="editcar.css">
    <script>
        // Funcție de confirmare înainte de a trimite formularul
        function confirmSave(event) {
            var confirmAction = confirm("Ești sigur că vrei să salvezi modificările?");
            if (!confirmAction) {
                event.preventDefault(); // Oprește trimiterea formularului dacă utilizatorul apasă "Nu"
            }
        }
    </script>
    <style>
        .btn-back {
    display: inline-block;
    padding: 10px 20px;
    background-color: #c82333;
    color: white;
    text-decoration: none;
    border-radius: 5px;
    text-align: center;
    margin-top: 10px;
}

.btn-back:hover {
    background-color: #c82333;
}
/* Stilizare container */
.checkbox-container {
    display: flex;
    align-items: center;
    gap: 10px; /* Spațiu între etichetă și checkbox */
}

/* Stilizare etichetă */
.checkbox-container label {
    font-size: 16px;
    font-weight: bold;
    color: #333;
}

/* Stilizare checkbox */
.checkbox-container input[type="checkbox"] {
    width: 20px;
    height: 20px;
    cursor: pointer;
    accent-color: #28a745; /* Verde pentru efect vizual */
}

    </style>
</head>
<body>
<a href="admin_dashboard.php" class="btn-back">Înapoi la Dashboard</a>

<div class="admin-container">
        <h2>Editează Mașina</h2>
        <form method="POST" action="" enctype="multipart/form-data" onsubmit="confirmSave(event)">
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($car['id']); ?>">
            
            <label>Marca:</label>
            <input type="text" name="marca" value="<?php echo htmlspecialchars($car['marca']); ?>" required>
            
            <label>Model:</label>
            <input type="text" name="model" value="<?php echo htmlspecialchars($car['model']); ?>" required>
            
            <label>An:</label>
            <input type="number" name="an" value="<?php echo htmlspecialchars($car['an']); ?>" required>
            
            <label>Preț (€):</label>
            <input type="number" name="pret" value="<?php echo htmlspecialchars($car['pret']); ?>" required>
            
            <label>Motorizare:</label>
            <input type="text" name="motorizare" value="<?php echo htmlspecialchars($car['motorizare']); ?>" required>
            
            <label>Cutie de viteze:</label>
            <select name="cutie" required>
                <option value="Manuala" <?php echo ($car['cutie_viteze'] == 'Manuala') ? 'selected' : ''; ?>>Manuală</option>
                <option value="Automata" <?php echo ($car['cutie_viteze'] == 'Automata') ? 'selected' : ''; ?>>Automată</option>
            </select>
            
            <label>Capacitate cilindrică (cm³):</label>
            <input type="number" name="capacitate" value="<?php echo htmlspecialchars($car['capacitate_cilindrica']); ?>" required>
            
            <label>Kilometraj:</label>
            <input type="number" name="kilometraj" value="<?php echo htmlspecialchars($car['kilometraj']); ?>" required>

            <label>Descriere:</label>
            <textarea name="descriere" required><?php echo htmlspecialchars($car['descriere']); ?></textarea>
           
           
           
            <div class="checkbox-container">
    <label for="reducere">Reducere:</label>
    <input type="checkbox" name="reducere" id="reducere" value="1" 
           <?php echo (!empty($car['reducere']) && $car['reducere'] == 1) ? 'checked' : ''; ?>>
</div>




            <label>Imagine Principală:</label>
            <img src="<?php echo $car['imagine']; ?>" alt="Imagine Mașină" width="200"><br>
            <input type="file" name="imagine" accept="image/*">

            <label>Imagini Secundare Existente:</label><br>
            <?php foreach ($images as $img) { ?>
                <img src="<?php echo $img['image_path']; ?>" alt="Imagine Secundară" width="100">
            <?php } ?>

            <label>Adaugă Imagini Secundare:</label>
            <input type="file" name="imagini_secundare[]" multiple accept="image/*">


            <button type="submit">Salvează Modificările</button>
        </form>
    </div>
</body>
</html>
