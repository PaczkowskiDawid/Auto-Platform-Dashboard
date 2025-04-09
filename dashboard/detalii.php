<?php
// Conectare la baza de date
include 'config.php';

// Preluăm ID-ul din URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("Mașina nu există.");
}

$id = (int)$_GET['id'];

// Interogăm baza de date pentru detaliile mașinii
$sql = "SELECT * FROM cars WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    die("Mașina nu a fost găsită.");
}

$car = $result->fetch_assoc();
$stmt->close();

// Obținem imaginile mașinii
$sqlImages = "SELECT image_path FROM car_images WHERE car_id = ?";
$stmtImages = $conn->prepare($sqlImages);
$stmtImages->bind_param("i", $id);
$stmtImages->execute();
$resultImages = $stmtImages->get_result();

$images = [];
while ($row = $resultImages->fetch_assoc()) {
    $images[] = $row['image_path'];
}

$stmtImages->close();

// Descrierea mașinii este deja preluată din interogarea inițială, deci nu mai e necesar să interoghezi din nou
$descriere = $car['descriere'] ? $car['descriere'] : "Descrierea nu este disponibilă.";

?>

<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SSA Automobile - <?php echo $car['marca']; ?> <?php echo $car['model']; ?></title>
    <link rel="icon" href="../favicon-32x32.png" type="image/x-icon">
    <link rel="stylesheet" href="styledetalii.css">
    <title>Detalii Mașină - <?php echo htmlspecialchars($car['marca'] . ' ' . $car['model']); ?></title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
         body {
            font-family: Arial, sans-serif;
        }.navbar {
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
        .car-card img {
            width: 100%;
            height: auto;
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
<!-- NAVBAR -->
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

<div class="container mt-5">
    <div class="car-container">
        <!-- Caruselul de imagini (Carusel principal) -->
        <div id="carouselExample" class="carousel slide car-carousel" data-bs-ride="carousel">
            <div class="carousel-inner">
                <?php foreach ($images as $index => $image): ?>
                    <div class="carousel-item <?php echo ($index === 0) ? 'active' : ''; ?>">
                        <img src="<?php echo $image; ?>" class="d-block w-100" alt="Imagine Mașină" id="mainImage">
                    </div>
                <?php endforeach; ?>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Înapoi</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Înainte</span>
            </button>
        </div>

        <!-- Detalii Mașină -->
        <div class="car-details">
            <h1><?php echo $car['marca'] . " " . $car['model']; ?></h1>
            <p class="price"><?php echo number_format($car['pret'], 0, ',', '.'); ?> €</p>
            <p class="status">✔ Disponibil în stoc</p>
            <p class="financing">💳 Opțiune de finanțare disponibilă</p>
                    
          
            <div class="rate-box">
                <span>Vrei în rate?</span>
                <a href="../finantare.php" ><button class="apply-btn-white">Aplica online</button></a>
              
            </div>

            <ul>
                <li>✅ Nu este nevoie de avans</li>
                <li>✅ Aprobare credit în 30 minute</li>
                <li>✅ Aplica 100% online fără deplasări</li>
                <li>✅ Rate fixe de la 6 la 60 luni</li>
                <li>✅ Dobândă începând de la 1%/lună</li>
            </ul>

            <!-- Secțiunea Dorești mai multe informații? -->
            <div class="info-section">
                <h3>Dorești mai multe informații?</h3>
                <div class="contact-buttons">
                    <a href="tel:+40743016677" class="call-btn">📞 Sună acum</a>
                    <a href="https://wa.me/40739550551?text=Salut!%20Mă%20interesează%20mai%20multe%20informații%20despre%20mașinile%20disponibile.%20Aș%20dori%20să%20aflu%20detalii%20adționale." class="whatsapp-btn">💬 Scrie-ne pe WhatsApp</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Secțiunea cu detalii tehnice -->
<div class="technical-details">
    <h2>Detalii tehnice</h2>
    
    <!-- Primul rând (3 elemente) -->
    <div class="details-row">
        <div class="detail"><i class="fas fa-gas-pump"></i> Motorizare: <strong><?php echo $car['motorizare']; ?></strong></div>
        <div class="detail"><i class="fas fa-calendar-alt"></i> An fabricație: <strong><?php echo $car['an']; ?></strong></div>
        <div class="detail"><i class="fas fa-cogs"></i> Cutie de viteze: <strong><?php echo $car['cutie_viteze']; ?></strong></div>
    </div>
    
    <!-- Al doilea rând (2 elemente) -->
    <div class="details-row-second">
    <div class="detail">
    <h2><?php echo htmlspecialchars($row['marca'] . ' ' . $row['model']); ?></h2>
    <p><i class="fas fa-cube"></i> Capacitate cilindrică: <strong><?php echo htmlspecialchars($row['capacitate_cilindrica'] ?? 'N/A'); ?> cm³</strong></p>
</div>
        <div class="detail"><i class="fas fa-tachometer-alt"></i> Kilometraj: <strong><?php echo number_format($car['kilometraj'], 0, ',', '.'); ?> km</strong></div>
    </div>
</div>

<!-- Secțiunea cu 3 cartonașe -->
<div class="cards-section">
    <div class="card">
        <i class="fas fa-shield-alt"></i> <!-- Iconă pentru garanție -->
        <h3>Garanție 1 an</h3>
        <p>Esti protejat de orice problemă apărută timp de 1 an fără limită de kilometri.</p>
    </div>
    <div class="card">
        <i class="fas fa-tachometer-alt"></i> <!-- Iconă pentru kilometri certificați -->
        <h3>Kilometri certificați</h3>
        <p>Kilometrajul fiecărei mașini este atestat oficial, astfel încât să poți avea încredere în informațiile legate de trecutul automobilului tău.</p>
    </div>
    <div class="card">
        <i class="fas fa-truck"></i> <!-- Iconă pentru livrare gratuită -->
        <h3>Livrare gratuită în toată țara</h3>
        <p>Oferim livrare GRATUITĂ în toată țara dacă nu dorești să te deplasezi sau numere roșii la alegere.</p>
    </div>
</div>

<!-- Secțiunea pentru descriere -->
<div class="car-description-section">
    <h2>Descrierea mașinii</h2>
    <p><?php echo nl2br(htmlspecialchars($descriere)); ?></p>
</div>

<div id="contact-button" class="contact-button">
        <span>Contact</span>
    </div>
    
    <div id="contact-options" class="contact-options">
        <a href="tel:+40743016677" class="option-button">Apel Telefonic</a>
        <a href="https://wa.me/40739550551?text=Salut!%20Mă%20interesează%20mai%20multe%20informații%20despre%20mașinile%20disponibile.%20Aș%20dori%20să%20aflu%20detalii%20adționale." class="option-button">WhatsApp</a>
        <a href="finantare.php" class="option-button">Rate Online</a>
    </div>


<section class="image-section">
        <div class="image-container">
            <img id="first-image" src="../tbi-bank.png" alt="Image 1" class="image-item">
            <img id="second-image" src="../mogo.png" alt="Image 2" class="image-item">
        </div>
    </section>
    
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
                <p>SSA AUTO AUTOMOBILE S.R.L</p>
                <p>CUI:RO44847873</p>
                <p id="gri"><a href="https://anpc.ro">A.N.P.C</a></p>
            </div>
    
            <!-- Coloana 3: Social Media -->
            <div class="footer-col">
                <h3>Urmărește-ne</h3>
                <div class="social-media">
                    <a href="https://www.facebook.com/share/1B6CWyu6Sa/?mibextid=wwXIfr" target="_blank">
                        <i class="fab fa-facebook-square"></i>
                    </a>
                    <a href="https://www.instagram.com/ssa.automobile?igsh=MXR6aXhwMWFyOXpibQ%3D%3D&utm_source=qr" target="_blank">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="https://www.tiktok.com/@ssa.automobile?_t=ZN-8ucK9QCQBfC&_r=1" target="_blank">
                        <i class="fab fa-tiktok"></i>
                    </a>
                </div>
                <div class="footer-images">
                    <a href="https://anpc.ro" target="_blank" id="anpc">
                        <img src="anpc.png" alt="Image 1" class="footer-img">
                    </a>
                    <a href="https://ec.europa.eu/consumers/odr/main/index.cfm?event=main.home.chooseLanguage" target="_blank">
                        <img src="sol.jpg" alt="Image 2" class="footer-img">
                    </a>
                </div>
            </div>
        </div>
    </footer>
<script>
    function changeMainImage(imageUrl) {
        document.getElementById('mainImage').src = imageUrl;
    }
</script>




<script>
        document.getElementById("contact-button").addEventListener("click", function() {
            var contactOptions = document.getElementById("contact-options");
    
            // Toggle (arată sau ascunde) opțiunile de contact
            contactOptions.classList.toggle("show");
        });
    </script>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
