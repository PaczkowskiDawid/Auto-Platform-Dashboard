<?php
$servername = "localhost"; // Serverul MySQL, de obicei 'localhost' pe Bluehost
$username = ""; // Numele de utilizator MySQL pe care l-ai configurat (de exemplu, 'brqzqcmy_WPT7T')
$password = ""; // Parola pentru utilizatorul respectiv
$dbname = ""; // Numele bazei de date pe care ai creat-o, adică 'brqzqcmy_cars'



$conn = new mysqli($servername, $username, $password, $dbname);

// Verificare conexiune
if ($conn->connect_error) {
    die("Conexiunea a eșuat: " . $conn->connect_error);
}

// Paginare - afișăm 12 mașini per pagină
$masini_per_pagina = 12;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $masini_per_pagina;





// Preluarea filtrelor din GET
$marca = isset($_GET['marca']) ? $_GET['marca'] : '';
$model = isset($_GET['model']) ? $_GET['model'] : '';
$an = isset($_GET['an']) ? $_GET['an'] : '';
$pret = isset($_GET['pret']) ? $_GET['pret'] : '';
$motorizare = isset($_GET['motorizare']) ? $_GET['motorizare'] : '';
$cutie_viteze = isset($_GET['cutie_viteze']) ? $_GET['cutie_viteze'] : '';
$capacitate_cilindrica = isset($_GET['capacitate_cilindrica']) ? $_GET['capacitate_cilindrica'] : '';

// Construirea interogării SQL cu filtre
$sql = "SELECT * FROM cars WHERE 1=1";

if ($marca != '') $sql .= " AND marca LIKE '%$marca%'";
if ($model != '') $sql .= " AND model LIKE '%$model%'";
if ($an != '') $sql .= " AND an = '$an'";
if ($pret != '') $sql .= " AND pret <= '$pret'";
if ($motorizare != '') $sql .= " AND motorizare LIKE '%$motorizare%'";
if ($cutie_viteze != '') $sql .= " AND cutie_viteze LIKE '%$cutie_viteze%'";
if ($capacitate_cilindrica != '') $sql .= " AND capacitate_cilindrica <= '$capacitate_cilindrica'";

$sql .= " LIMIT $masini_per_pagina OFFSET $offset";

$result = $conn->query($sql);

// Total mașini pentru paginare
// Construim query-ul pentru numărarea mașinilor filtrate
$sql_total = "SELECT COUNT(id) AS total FROM cars WHERE 1=1";

if ($marca != '') $sql_total .= " AND marca LIKE '%$marca%'";
if ($model != '') $sql_total .= " AND model LIKE '%$model%'";
if ($an != '') $sql_total .= " AND an = '$an'";
if ($pret != '') $sql_total .= " AND pret <= '$pret'";
if ($motorizare != '') $sql_total .= " AND motorizare LIKE '%$motorizare%'";
if ($cutie_viteze != '') $sql_total .= " AND cutie_viteze LIKE '%$cutie_viteze%'";
if ($capacitate_cilindrica != '') $sql_total .= " AND capacitate_cilindrica <= '$capacitate_cilindrica'";

$total_result = $conn->query($sql_total);
$total_masini = $total_result->fetch_assoc()['total'];
$total_pagini = ceil($total_masini / $masini_per_pagina);

$total_pagini = ceil($total_masini / $masini_per_pagina);
// Funcție pentru a prelua opțiunile unice din baza de date
function getOptions($conn, $column, $where = "") {
    $sql = "SELECT DISTINCT $column FROM cars $where ORDER BY $column ASC";
    $result = $conn->query($sql);
    $options = [];
    while ($row = $result->fetch_assoc()) {
        $options[] = $row[$column];
    }
    return $options;
}

$marci = getOptions($conn, "marca");
$modele = isset($_GET['marca']) ? getOptions($conn, "model", "WHERE marca = '" . $_GET['marca'] . "'") : [];
$ani = isset($_GET['model']) ? getOptions($conn, "an", "WHERE model = '" . $_GET['model'] . "'") : [];



// Interogare pentru a obține toate mărcile distincte
$sql_marca = "SELECT DISTINCT marca FROM cars";
$result_marca = mysqli_query($conn, $sql_marca);

if (!$result_marca) {
    die("Eroare la interogarea mărcilor: " . mysqli_error($conn));
}



// Exemplu de preluare a datelor despre mașină din baza de date
$sqlCar = "SELECT * FROM cars WHERE id = ?";
$stmtCar = $conn->prepare($sqlCar);
$stmtCar->bind_param("i", $id); // ID-ul mașinii
$stmtCar->execute();
$resultCar = $stmtCar->get_result();
$car = $resultCar->fetch_assoc();
$stmtCar->close();

// Descrierea mașinii
$descriere = !empty($car['descriere']) ? $car['descriere'] : "Descrierea nu este disponibilă.";

// Preluarea imaginii principale
$imagePath = !empty($car['imagine']) ? $car['imagine'] : 'default_image.jpg'; // Fallback image

// Verificarea căii imaginii
$full_image_path = $imagePath; // Calea completă a imaginii

?>

<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Vezi selecția noastră de mașini second hand la SSA Automobile! Găsește vehiculul ideal dintr-o gamă variată de mașini de vânzare la prețuri accesibile.">

    <title>SSA Automobile - Masini de vanzare</title>
    <link rel="stylesheet" href="stylemasini.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="icon" href="../favicon-32x32.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

    <style>
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
        .hero-section {
            background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url('hero-image.jpg') center/cover no-repeat;
            padding: 100px 0;
        }
        .hero-section h1 {
            font-size: 2.5rem;
            font-weight: bold;
        }
        .hero-section p {
            font-size: 1.2rem;
        }
        
/* Container pentru mașini */
.cars-container {
    margin: 20px auto;
    padding: 20px;
    max-width: 1200px;
}

.cars-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
    gap: 20px;
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
.car-image {
    width: 100% !important;
    height: 200px !important;
    object-fit: cover !important;
    border-bottom: 2px solid #ddd !important;
    display: block !important;
}
/* Media Query pentru telefoane */
@media screen and (max-width: 768px) {
    /* Scade dimensiunea butonului pe telefoane */
    .contact-button {
        bottom: 15px;
        right: 15px;
        padding: 12px;
        font-size: 16px;
    }

    /* Scade lățimea opțiunilor */
    .contact-options {
        width: 180px;
    }

    /* Ajustează dimensiunea butoanelor din opțiuni */
    .option-button {
        font-size: 12px;
        padding: 8px;
    }
}

/* Media Query pentru ecrane foarte mici (ex. telefoane foarte mici) */
@media screen and (max-width: 480px) {
    .contact-button {
        padding: 10px;
        font-size: 14px;
    }

    .contact-options {
        width: 160px;
    }

    .option-button {
        font-size: 12px;
        padding: 6px;
    }
}
</style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="../index.php">
                <img src="logo.png" alt="Logo" style="max-height: 60px;">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item"><a class="nav-link" href="../index.php">Acasă</a></li>
                    <li class="nav-item"><a class="nav-link" href="../desprenoi.html">Despre noi</a></li>
                    <li class="nav-item"><a class="nav-link" href="masini.php">Mașini de vânzare</a></li>
                    <li class="nav-item"><a class="nav-link" href="../finantare.php">Finanțare</a></li>
                    <li class="nav-item"><a class="nav-link" href="../contact.html">Contact</a></li>
                </ul>
            </div>
        </div>
    </nav>



    
    <div class="masinidevanzare">
    <h2>Mașinile noastre de vânzare</h2>
    </div>

    <form method="GET" action="masini.php" class="filter-form">
 
    <select name="marca" id="marca">
        <option value="">Alege Marca</option>
        <?php while ($row = mysqli_fetch_assoc($result_marca)) { ?>
            <option value="<?php echo $row['marca']; ?>" <?php if (isset($_GET['marca']) && $_GET['marca'] == $row['marca']) echo 'selected'; ?>>
                <?php echo $row['marca']; ?>
            </option>
        <?php } ?>
    </select>

    

    <!-- Model -->
    <select name="model" id="model" <?php echo empty($model) ? 'disabled' : ''; ?>>
        <option value="">Alege Model</option>
        <?php foreach ($modele as $item) { ?>
            <option value="<?php echo $item; ?>" <?php echo ($item == $model) ? 'selected' : ''; ?>>
                <?php echo $item; ?>
            </option>
        <?php } ?>
    </select>

    <!-- An -->
    <select name="an" id="an" <?php echo empty($an) ? 'disabled' : ''; ?>>
        <option value="">Alege An</option>
        <?php foreach ($ani as $item) { ?>
            <option value="<?php echo $item; ?>" <?php echo ($item == $an) ? 'selected' : ''; ?>>
                <?php echo $item; ?>
            </option>
        <?php } ?>
    </select>

    <!-- Preț -->
    <select name="pret" id="pret" <?php echo empty($pret) ? 'disabled' : ''; ?>>
        <option value="">Alege Preț</option>
        <?php 
            // Aici ar trebui să pui opțiunile pentru prețuri (sau o gamă de prețuri)
            $prețuri = [1000, 5000, 10000, 20000]; // Exemplu de opțiuni
            foreach ($prețuri as $item) { ?>
                <option value="<?php echo $item; ?>" <?php echo ($item == $pret) ? 'selected' : ''; ?>>
                    <?php echo $item; ?> €
                </option>
            <?php } ?>
    </select>

    <!-- Motorizare -->
    <select name="motorizare" id="motorizare" <?php echo empty($motorizare) ? 'disabled' : ''; ?>>
        <option value="">Alege Motorizare</option>
        <?php 
            // Aici adaugi opțiuni pentru motorizare
            $motorizari = ['Benzină', 'Diesel', 'Electric']; // Exemplu de opțiuni
            foreach ($motorizari as $item) { ?>
                <option value="<?php echo $item; ?>" <?php echo ($item == $motorizare) ? 'selected' : ''; ?>>
                    <?php echo $item; ?>
                </option>
            <?php } ?>
    </select>

    <!-- Cutie de viteze -->
    <select name="cutie_viteze" id="cutie_viteze" <?php echo empty($cutie_viteze) ? 'disabled' : ''; ?>>
        <option value="">Alege Cutie Viteze</option>
        <?php 
            // Aici adaugi opțiuni pentru cutia de viteze
            $cutii = ['Manuală', 'Automată']; // Exemplu de opțiuni
            foreach ($cutii as $item) { ?>
                <option value="<?php echo $item; ?>" <?php echo ($item == $cutie_viteze) ? 'selected' : ''; ?>>
                    <?php echo $item; ?>
                </option>
            <?php } ?>
    </select>

    <!-- Capacitate cilindrică -->
    <select name="capacitate_cilindrica" id="capacitate_cilindrica" <?php echo empty($capacitate_cilindrica) ? 'disabled' : ''; ?>>
        <option value="">Alege Capacitate Cilindrică</option>
        <?php 
            // Aici adaugi opțiuni pentru capacitatea cilindrică
            $capacitate = [1000, 1500, 2000, 2500]; // Exemplu de opțiuni
            foreach ($capacitate as $item) { ?>
                <option value="<?php echo $item; ?>" <?php echo ($item == $capacitate_cilindrica) ? 'selected' : ''; ?>>
                    <?php echo $item; ?> cm³
                </option>
            <?php } ?>
    </select>
    <button type="submit">Caută</button>
    <a href="masini.php" class="reset-btn">Resetare Filtre</a>
</form>
<div class="containermasini">
    <div class="masini-grid">
        <?php while ($row = $result->fetch_assoc()) { ?>
            <div class="car-card">
                <?php
                // Corectăm calea imaginii
                $image_name = !empty($row['imagine']) ? basename($row['imagine']) : 'default_image.jpg';
                $full_image_path = "https://ssa-automobile-prahova.com/dashboard/uploads/" . $image_name;
                ?>
                <img src="<?php echo htmlspecialchars($full_image_path); ?>" alt="Imaginea mașinii" class="car-image" />

                <?php if ($row['reducere'] == 1) { ?>
                    <div class="badge-reducere">Reducere</div>
                <?php } ?>

                <h3><?php echo htmlspecialchars($row['marca'] . ' ' . $row['model']); ?></h3>
                <div class="car-specifications">
                    <p><i class="fas fa-euro-sign"></i> Preț: <?php echo htmlspecialchars($row['pret']); ?> €</p>
                    <p><i class="fas fa-calendar-alt"></i> An: <?php echo htmlspecialchars($row['an']); ?></p>
                    <p><i class="fas fa-gas-pump"></i> Motorizare: <?php echo htmlspecialchars($row['motorizare']); ?></p>
                    <p><i class="fas fa-tachometer-alt"></i> Kilometraj: 
    <?php echo number_format((int) $row['kilometraj'], 0, ',', '.'); ?> km
</p>

                    <p><i class="fas fa-cogs"></i> Cutie: <?php echo htmlspecialchars($row['cutie_viteze'] ?? 'N/A'); ?></p>
                    <p><i class="fas fa-cube"></i> Capacitate: <?php echo htmlspecialchars($row['capacitate_cilindrica'] ?? 'N/A'); ?> cm³</p>
                </div>
                <a href="detalii.php?id=<?php echo $row['id']; ?>" class="view-details-btn">Vezi detalii</a>
            </div>
        <?php } ?>
    </div>
</div>


<div id="contact-button" class="contact-button">
        <span>Contact</span>
    </div>
    
    <div id="contact-options" class="contact-options">
        <a href="tel:+40743016677" class="option-button">Apel Telefonic</a>
        <a href="https://wa.me/40739550551?text=Salut!%20Mă%20interesează%20mai%20multe%20informații%20despre%20mașinile%20disponibile.%20Aș%20dori%20să%20aflu%20detalii%20adționale." class="option-button">WhatsApp</a>
        <a href="finantare.php" class="option-button">Rate Online</a>
    </div>





<?php
// Construim query string-ul pentru a păstra filtrele în paginare
$query_params = $_GET;
unset($query_params['page']); // Eliminăm "page" pentru a o adăuga separat în URL
$query_string = http_build_query($query_params);
$pagination_url = "masini.php?" . $query_string;
?>

<?php if ($total_masini > $masini_per_pagina) { ?>
    <div class="pagination">
        <?php if ($page > 1) { ?>
            <a href="<?php echo $pagination_url . '&page=' . ($page - 1); ?>">← Anterior</a>
        <?php } ?>
        <span>Pagina <?php echo $page; ?> din <?php echo $total_pagini; ?></span>
        <?php if ($page < $total_pagini) { ?>
            <a href="<?php echo $pagination_url . '&page=' . ($page + 1); ?>">Următor →</a>
        <?php } ?>
    </div>
<?php } ?>


<footer class="footer">
        <div class="footer-container">
            <!-- Coloana 1: Contact -->
            <div class="footer-col">
                <h3>Contact</h3>
                <p><strong></strong> <a href="tel:+40743016677">📞+40 743 016 677</a></p>
                <p><strong></strong> <a href="tel:+40739550551">📞+40 739 550 551</a></p>
                <p><strong>📧Email:</strong> <a href="mailto:ssa.automobile.prahova@gmail.com">ssa.automobile.prahova@gmail.com</a></p>
                <p><strong>Locație:</strong> DN1A 194, Ploiesti, Romania</p>
                <a href="https://maps.app.goo.gl/EzRFX6MzpRjbM7TN7" target="_blank">Vezi pe Google Maps</a>
            </div>
    
            <!-- Coloana 2: Informații firmă -->
            <div class="footer-col">
                <h3>Informații</h3>
                <p>SSA AUTO AUTOMOBILE S.R.L</a></p>
                <p >CUI:RO44847873</a></p>
                <p id="gri"><a href="https://anpc.ro">A.N.P.C</a></p>
            </div>
    
            <div class="footer-col">
                <h3>Urmărește-ne</h3>
                <div class="social-media">
                    <a href="https://www.facebook.com/share/1B6CWyu6Sa/?mibextid=wwXIfr" target="_blank">
                        <i class="fab fa-facebook-square"></i> <!-- Icona pentru Facebook -->
                    </a>
                    <a href="https://www.instagram.com/ssa.automobile?igsh=MXR6aXhwMWFyOXpibQ%3D%3D&utm_source=qr" target="_blank">
                        <i class="fab fa-instagram"></i> <!-- Icona pentru Instagram -->
                    </a>
                    <a href="https://www.tiktok.com/@ssa.automobile?_t=ZN-8ucK9QCQBfC&_r=1" target="_blank">
                        <i class="fab fa-tiktok"></i> <!-- Icona pentru TikTok -->
                    </a>
                </div>
                <div class="footer-images">
                    <a href="https://reclamatiisal.anpc.ro" target="_blank" id="anpc">
                        <img src="anpc.png" alt="Image 1" class="footer-img">
                    </a>
                    <a href="https://ec.europa.eu/consumers/odr/main/index.cfm?event=main.home.chooseLanguage" target="_blank">
                        <img src="sol.jpg" alt="Image 2" class="footer-img">
                    </a>
                </div>
        </div>
    </footer>
    


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>$(document).ready(function(){
    $("#marca").change(function(){
        var marca = $(this).val();
        $.get("get_models.php", { marca: marca }, function(data){
            // Actualizează modelele
            $("#model").html(data).prop("disabled", false);
        });
    });

    $("#model").change(function(){
        var model = $(this).val();
        $.get("get_years.php", { model: model }, function(data){
            // Actualizează anii
            $("#an").html(data).prop("disabled", false);
        });
    });

    $("#an").change(function(){
        var an = $(this).val();
        $.get("get_prices.php", { an: an }, function(data){
            // Actualizează prețurile
            $("#pret").html(data).prop("disabled", false);
        });
    });

    $("#pret").change(function(){
        var pret = $(this).val();
        $.get("get_engine.php", { pret: pret }, function(data){
            // Actualizează motorizările
            $("#motorizare").html(data).prop("disabled", false);
        });
    });

    $("#motorizare").change(function(){
        var motorizare = $(this).val();
        $.get("get_transmission.php", { motorizare: motorizare }, function(data){
            // Actualizează cutiile de viteze
            $("#cutie_viteze").html(data).prop("disabled", false);
        });
    });

    $("#cutie_viteze").change(function(){
        var cutie = $(this).val();
        $.get("get_capacity.php", { cutie_viteze: cutie }, function(data){
            // Actualizează capacitatea cilindrică
            $("#capacitate_cilindrica").html(data).prop("disabled", false);
        });
    });
});

</script>



<script>
        document.getElementById("contact-button").addEventListener("click", function() {
            var contactOptions = document.getElementById("contact-options");
    
            // Toggle (arată sau ascunde) opțiunile de contact
            contactOptions.classList.toggle("show");
        });
    </script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>

<?php $conn->close(); ?>
