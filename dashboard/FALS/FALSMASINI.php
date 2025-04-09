<?php
// PENTRU CARDDURI
// Conectarea la baza de date
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cars";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verificare conexiune
if ($conn->connect_error) {
    die("Conexiunea a eșuat: " . $conn->connect_error);
}

// Paginare - afișăm 12 mașini per pagină
$masini_per_pagina = 12;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $masini_per_pagina;

// Interogare pentru a prelua mașinile
$sql = "SELECT * FROM masini LIMIT $masini_per_pagina OFFSET $offset";
$result = $conn->query($sql);

// Total mașini pentru paginare
$sql_total = "SELECT COUNT(id) AS total FROM cars";
$total_result = $conn->query($sql_total);
$total_masini = $total_result->fetch_assoc()['total'];
$total_pagini = ceil($total_masini / $masini_per_pagina);
?>


<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SSA Automobile - Masini de vanzare </title>
    <link rel="icon" href="../favicon-32x32.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    
    <link rel="stylesheet" href="masini.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
    /* Stilizare pentru numerotarea paginilor */
    .pagination {
        display: flex;
        justify-content: center;
        margin-top: 20px;
    }

    .pagination a {
        margin: 0 5px;
        padding: 10px 15px;
        margin-bottom: 20px;
        background-color: #e7222e; /* Culoarea de fundal */
        color: white;
        border-radius: 5px;
        text-decoration: none;
    }

    .pagination a:hover {
        background-color: #333; /* Culoarea de hover */
    }

    .pagination .active {
        background-color: gray;
    }

    /* Alte stiluri deja existente */
    .container {
        max-width: 1200px;
        margin: auto;
        text-align: center;
    }

    .masini-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 20px;
        margin-top: 20px;
    }

    .car-card {
    background: #fff;
    padding: 15px;
    border-radius: 10px;
    box-shadow: 0 8px 15px rgba(0, 0, 0, 0.1); /* Umbra mai puternică */
    text-align: left;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    position: relative;
    padding-bottom: 80px; /* Spațiu pentru butonul de detalii */
}

.car-card h3 {
    font-size: 20px;
    margin: 10px 0;
    color: #333;
}

.car-card p {
    font-size: 14px;
    color: #666;
    margin: 5px 0;
}

.view-details-btn {
    display: inline-block;
    margin-top: 10px;
    padding: 8px 12px;
    background-color: #007bff;
    color: white;
    text-decoration: none;
    border-radius: 5px;
    font-weight: bold;
}

.view-details-btn:hover {
    background-color: #0056b3;
}


    .car-image {
        width: 100%;
        height: 200px;
        object-fit: cover;
        border-radius: 10px;
    }

    .view-details-btn {
    display: inline-block;
    background-color: #e7222e; /* Culoarea de fundal */
    color: white;
    padding: 12px 20px;
    border: none;
    border-radius: 50px;
    cursor: pointer;
    text-align: center;
    text-decoration: none;
    font-weight: bold;
    margin-top: 15px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    transition: background-color 0.3s ease, box-shadow 0.3s ease;
    position: absolute;
    bottom: 25px;
    left: 50%;
    transform: translateX(-50%); /* Aliniere perfectă */
    width: 80%;
    z-index: 10; /* Asigură-te că butonul rămâne în față */
}

.view-details-btn:hover {
    background-color: #333; /* Culoarea de hover */
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
}

.view-details-btn:active {
    background-color: #333; /* Culoare de activare */
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Umbra mai mică */
}
        body {
            font-family: Arial, sans-serif;
        }
        .navbar {
            background-color: #343a40 !important;
        }
        .navbar-brand, .nav-link {
            color: #ffffff !important;
            font-weight: bold;
        }



</style>

</head>
<body>

    <div class="containermasini">
    <h2>Mașinile noastre de vânzare</h2>
   
    
    <div id="filter-container">
    <select id="unique-brand-filter" data-default="Alege marca" onchange="loadModels(); saveFilter(this.id)">
        <option value="">Alege marca</option>
    </select>

    <select id="unique-model-filter" data-default="Alege model" onchange="loadYears(); saveFilter(this.id)" disabled>
        <option value="">Alege model</option>
    </select>

    <select id="unique-year-filter" data-default="Alege anul" onchange="loadPrices(); saveFilter(this.id)" disabled>
        <option value="">Alege anul</option>
    </select>

    <select id="unique-price-filter" data-default="Alege preț" onchange="loadEngines(); saveFilter(this.id)" disabled>
        <option value="">Alege preț</option>
    </select>

    <select id="unique-engine-filter" data-default="Alege motorizare" onchange="loadGearboxes(); saveFilter(this.id)" disabled>
        <option value="">Alege motorizare</option>
    </select>

    <select id="unique-gearbox-filter" data-default="Alege cutie viteze" onchange="loadCapacities(); saveFilter(this.id)" disabled>
        <option value="">Alege cutie viteze</option>
    </select>

    <select id="unique-capacity-filter" data-default="Alege capacitate cilindrică" onchange="saveFilter(this.id)" disabled>
        <option value="">Alege capacitate cilindrică</option>
    </select>

    <button onclick="applyFilters()">Caută</button>
    <button onclick="resetFilters()">Resetează filtre</button>
</div>

<!-- Aici vor fi afișate rezultatele -->
<div id="unique-cars-container" class="masini-grid"></div>

<div class="containermasini">
    <div class="masini-grid">
        <?php while ($row = $result->fetch_assoc()) { ?>
            <div class="car-card">
                <?php
                $image_path = $row['imagine'];
                if (!empty($image_path) && file_exists("dashboard/" . $image_path)) { ?>
                    <img src="http://localhost/dealership/dashboard/<?php echo htmlspecialchars($image_path); ?>" alt="Imaginea mașinii" class="car-image">
                <?php } else { ?>
                    <p>Imagine indisponibilă</p>
                <?php } ?>

                <h3><?php echo htmlspecialchars($row['marca'] . ' ' . $row['model']); ?></h3>
                <div class="car-specifications">
                    <p><i class="fas fa-euro-sign"></i> Preț: <?php echo htmlspecialchars($row['pret']); ?> €</p>
                    <p><i class="fas fa-calendar-alt"></i> An: <?php echo htmlspecialchars($row['an']); ?></p>
                    <p><i class="fas fa-gas-pump"></i> Motorizare: <?php echo htmlspecialchars($row['motorizare']); ?></p>
                    <p><i class="fas fa-tachometer-alt"></i> Kilometraj: <?php echo htmlspecialchars($row['kilometraj']); ?> km</p>
                    <p><i class="fas fa-cogs"></i> Cutie: <?php echo htmlspecialchars($row['cutie_viteze'] ?? 'N/A'); ?></p>
                    <p><i class="fas fa-cube"></i> Capacitate: <?php echo htmlspecialchars($row['capacitate_cilindrica'] ?? 'N/A'); ?> cm³</p>
                </div>
                <a href="detalii.php?id=<?php echo $row['id']; ?>" class="view-details-btn">Vezi detalii</a>
            </div>
        <?php } ?>
    </div>
</div>

<!-- PAGINARE -->
<div class="pagination">
    <?php if ($page > 1) { ?>
        <a href="?page=<?php echo $page - 1; ?>">← Anterior</a>
    <?php } ?>
    <span>Pagina <?php echo $page; ?> din <?php echo $total_pagini; ?></span>
    <?php if ($page < $total_pagini) { ?>
        <a href="?page=<?php echo $page + 1; ?>">Următor →</a>
    <?php } ?>
</div>
        
    <script>

</script>

<?php $conn->close(); ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>