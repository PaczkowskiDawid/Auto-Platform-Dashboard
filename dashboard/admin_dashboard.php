<?php
// Conectare la baza de date
include 'config.php';

// Verificare conexiune
if ($conn->connect_error) {
    die("Conexiunea a eșuat: " . $conn->connect_error);
}
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit();
}

// Definirea variabilei de căutare
$search = "";

// Verifică dacă formularul de căutare a fost trimis
if (isset($_GET['search'])) {
    $search = mysqli_real_escape_string($conn, $_GET['search']);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Preia datele din formular cu valori implicite
    $marca = isset($_POST['marca']) ? mysqli_real_escape_string($conn, $_POST['marca']) : '';
    $model = isset($_POST['model']) ? mysqli_real_escape_string($conn, $_POST['model']) : '';
    $an = isset($_POST['an']) ? (int) $_POST['an'] : 0;
    $pret = isset($_POST['pret']) ? (float) $_POST['pret'] : 0.0;
    $motorizare = isset($_POST['motorizare']) ? mysqli_real_escape_string($conn, $_POST['motorizare']) : '';
    $cutie = isset($_POST['cutie']) ? mysqli_real_escape_string($conn, $_POST['cutie']) : '';
    $capacitate = isset($_POST['capacitate']) ? (float) $_POST['capacitate'] : 0.0;
    $kilometraj = isset($_POST['kilometraj']) ? (int) $_POST['kilometraj'] : 0;
    $descriere = isset($_POST['descriere']) ? mysqli_real_escape_string($conn, $_POST['descriere']) : '';
    $img_path = 'uploads/default.jpg'; // Valoare implicită dacă nu se încarcă imaginea

    // Verifică dacă imaginea principală a fost încărcată
    if (isset($_FILES['imagine']) && $_FILES['imagine']['error'] == 0) {
        $img_name = $_FILES['imagine']['name'];
        $img_tmp = $_FILES['imagine']['tmp_name'];
        $img_type = $_FILES['imagine']['type'];
        $upload_dir = 'uploads/';
        $img_path = $upload_dir . basename($img_name);

        // Verifică tipul fișierului și încarcă imaginea
        $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];
        if (in_array($img_type, $allowed_types)) {
            if (!move_uploaded_file($img_tmp, $img_path)) {
                echo "Eroare la încărcarea imaginii!";
                exit();
            }
        } else {
            echo "Tipul de fișier nu este permis. Permise: JPG, PNG, GIF.";
            exit();
        }
    }

    // Inserează mașina în baza de date
    $sql_insert = "INSERT INTO cars (marca, model, an, pret, motorizare, cutie_viteze, capacitate_cilindrica, kilometraj, imagine, descriere)
                   VALUES ('$marca', '$model', $an, $pret, '$motorizare', '$cutie', $capacitate, $kilometraj, '$img_path', '$descriere')";

    if (mysqli_query($conn, $sql_insert)) {
        $last_insert_id = mysqli_insert_id($conn);

        // Verifică și încarcă imaginile secundare (dacă există)
        if (!empty($_FILES['imagini_secundare']['name'][0])) {
            foreach ($_FILES['imagini_secundare']['tmp_name'] as $key => $tmp_name) {
                $file_name = basename($_FILES['imagini_secundare']['name'][$key]);
                $target_path = "uploads/" . $file_name;
        
                if (move_uploaded_file($tmp_name, $target_path)) {
                    // Inserează fiecare imagine în baza de date
                    $sql_insert_image = "INSERT INTO car_images (car_id, image_path) VALUES ('$last_insert_id', '$target_path')";
                    mysqli_query($conn, $sql_insert_image);
                }
            }
        }

        echo "<script>alert('Mașina și imaginile au fost adăugate cu succes!');</script>";
    } else {
        echo "Eroare SQL: " . mysqli_error($conn);
    }
}

// Parametrii pentru paginare
$limit = 7; // Numărul de înregistrări pe pagină
$page = isset($_GET['page']) ? $_GET['page'] : 1; // Pagina curentă
$offset = ($page - 1) * $limit; // Calculăm offsetul

// Interogare pentru a prelua numărul total de înregistrări
$sql_count = "SELECT COUNT(*) AS total FROM cars WHERE marca LIKE '%$search%' OR model LIKE '%$search%' OR motorizare LIKE '%$search%' OR cutie_viteze LIKE '%$search%' OR capacitate_cilindrica LIKE '%$search%' OR kilometraj LIKE '%$search%'";
$result_count = mysqli_query($conn, $sql_count);
$row_count = mysqli_fetch_assoc($result_count);
$total_records = $row_count['total']; // Totalul înregistrărilor
$total_pages = ceil($total_records / $limit); // Numărul total de pagini

// Interogare pentru a prelua mașinile pentru pagina curentă
$sql = "SELECT * FROM cars WHERE marca LIKE '%$search%' OR model LIKE '%$search%' OR motorizare LIKE '%$search%' OR cutie_viteze LIKE '%$search%' OR capacitate_cilindrica LIKE '%$search%' OR kilometraj LIKE '%$search%' LIMIT $limit OFFSET $offset";
$result = mysqli_query($conn, $sql) or die("Eroare SQL: " . mysqli_error($conn));
?>


<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="admin.css">
    <style>
        .search-container {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }
        .search-container input[type="text"] {
            padding: 5px;
            margin-right: 10px;
            width: 300px;
        }
        .search-container button {
            padding: 5px 10px;
            cursor: pointer;
        }
        .clear-btn {
            cursor: pointer;
            background: none;
            border: none;
            font-size: 18px;
            color: red;
        }
        .pagination {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }

        .pagination a {
            margin: 0 5px;
            padding: 10px 15px;
            background-color: #e7222e;
            color: white;
            border-radius: 5px;
            text-decoration: none;
        }

        .pagination a:hover {
            background-color: #333;
        }

        .pagination .active {
            background-color: #28a745;
        }
        .btn-logout {
    display: inline-block;
    padding: 10px 20px;
    background-color: #dc3545;
    color: white;
    text-decoration: none;
    border-radius: 5px;
    text-align: center;
    font-weight: bold;
    margin-top: 10px;
}

.btn-logout:hover {
    background-color: #c82333;
}

    </style>
</head>
<body>
<a href="logout.php" class="btn-logout">Logout</a>

    <div class="admin-container">
        <h2>Mașini din Admin Dashboard</h2>

        <!-- Formular pentru căutare -->
        <form method="GET" action="" class="search-container">
            <input type="text" name="search" placeholder="Căutați o mașină..." value="<?php echo htmlspecialchars($search); ?>">
            <button type="submit">Căutare</button>
            <?php if ($search) { ?>
                <button type="button" class="clear-btn" onclick="window.location.href = window.location.pathname;">X</button>
            <?php } ?>
        </form>

        <!-- Tabelul cu mașinile existente -->
        <table border="1">
            <thead>
                <tr>
                    <th>Marca</th>
                    <th>Model</th>
                    <th>An</th>
                    <th>Preț (€)</th>
                    <th>Kilometraj</th>
                    <th>Motorizare</th>
                    <th>Cutie de viteze</th>
                    <th>Capacitate cilindrică</th>
                    <th>Acțiuni</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                    <tr>
                        <td><?php echo $row['marca']; ?></td>
                        <td><?php echo $row['model']; ?></td>
                        <td><?php echo $row['an']; ?></td>
                        <td><?php echo $row['pret']; ?> €</td>
                        <td><?php echo $row['kilometraj']; ?> km</td>
                        <td><?php echo $row['motorizare']; ?></td>
                        <td><?php echo $row['cutie_viteze']; ?></td>
                        <td><?php echo $row['capacitate_cilindrica']; ?> cm³</td>
                        <td>
                            <!-- Butoane pentru Editare și Ștergere -->
                            <a href="edit_car.php?id=<?php echo $row['id']; ?>" class="edit-btn">Editează</a>
                            <a href="delete_car.php?id=<?php echo $row['id']; ?>" class="delete-btn" onclick="return confirm('Sigur vrei să ștergi această mașină?');">Șterge</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>

        <!-- Paginare -->
        <div class="pagination">
            <?php for ($i = 1; $i <= $total_pages; $i++) { ?>
                <a href="?page=<?php echo $i; ?>&search=<?php echo urlencode($search); ?>" class="<?php echo ($i == $page) ? 'active' : ''; ?>"><?php echo $i; ?></a>
            <?php } ?>
        </div>

<!-- Formular pentru adăugarea unei mașini -->
<h3>Adaugă o Mașină</h3>
<form method="POST" action="" enctype="multipart/form-data">
    <label>Marca:</label>
    <input type="text" name="marca" required>

    <label>Model:</label>
    <input type="text" name="model" required>

    <label>An:</label>
    <input type="number" name="an" required>

    <label>Preț (€):</label>
    <input type="number" name="pret" required>

    <label>Motorizare:</label>
    <input type="text" name="motorizare" required>

    <label>Cutie de viteze:</label>
    <select name="cutie" required>
        <option value="Manuala">Manuală</option>
        <option value="Automata">Automată</option>
    </select>

    <label>Capacitate cilindrică (cm³):</label>
    <input type="number" name="capacitate" step="0.001" required>

    <label>Kilometraj:</label>
    <input type="number" name="kilometraj" required>
    
    <!-- Câmp pentru descrierea mașinii -->
    <label>Descriere:</label>
    <textarea name="descriere" required></textarea>

    <!-- Câmp pentru încărcarea imaginii principale -->
    <label>Imagine Principală:</label>
    <input type="file" name="imagine" required>

    <!-- Câmp pentru încărcarea imaginilor secundare -->
    <label>Imagini Secundare:</label>
    <input type="file" name="imagini_secundare[]" multiple>

    <button type="submit">Adaugă Mașina</button>
</form>

    </div>
</body>
</html>
