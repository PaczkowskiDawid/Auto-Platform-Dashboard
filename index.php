<?php
$servername = "localhost"; // Serverul MySQL, de obicei 'localhost' pe Bluehost
$username = "brqzqcmy_dawid"; // Numele de utilizator MySQL pe care l-ai configurat (de exemplu, 'brqzqcmy_WPT7T')
$password = "ADawidE2003@"; // Parola pentru utilizatorul respectiv
$dbname = "brqzqcmy_cars"; // Numele bazei de date pe care ai creat-o, adică 'brqzqcmy_cars'
?>


<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Bine ați venit la SSA Automobile! Găsește mașini second hand de încredere, la prețuri accesibile. Descoperă oferta noastră variată de automobile pentru toate gusturile.">
    <title>SSA Automobile - Acasa</title>
    <link rel="icon" href="favicon-32x32.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="styles.css">
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
        .car-card img {
            width: 100%;
            height: auto;
        }
        /* Secțiunea "De ce să alegi SSA Automobile?" */
#ss-auto-features {
    padding: 40px;
    background-color: #f8f8f8;
    text-align: center;
}

#ss-auto-features h2 {
    font-size: 30px;
    color: #333;
    margin-bottom: 20px;
}

#ss-auto-features p {
    font-size: 16px;
    color: #555;
    margin-bottom: 40px;
    line-height: 1.6;
}

/* Container pentru caracteristicile SSA */
.features-list {
    display: flex;
    justify-content: center;
    gap: 30px;
    flex-wrap: wrap;
}

/* Fiecare caracteristică */
.feature-item {
    background-color: #fff;
    border-radius: 8px;
    padding: 20px;
    width: 250px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    text-align: center;
    transition: transform 0.3s ease;
}

.feature-item:hover {
    transform: translateY(-10px); /* Efect de ridicare la hover */
}

.feature-item img {
    width: 50px;
    height: 50px;
    margin-bottom: 20px;
}

.feature-item h3 {
    font-size: 18px;
    color: #e7222e;
    margin-bottom: 10px;
    font-weight: 600;
}

.feature-item p {
    font-size: 14px;
    color: #666;
    line-height: 1.5;
}

/* Responsivitate */
@media (max-width: 768px) {
    .features-list {
        flex-direction: column;
        align-items: center;
    }
}
#servicii {
    display: flex;
    justify-content: center; /* Center content horizontally */
    align-items: center;     /* Center content vertically */
    width: 100%;
    padding: 20px 0; /* Optional: Add padding to create space around */
}

.servicii-container {
    display: flex;
    justify-content: center; /* Align items horizontally in the container */
    align-items: center;     /* Align items vertically in the container */
    max-width: 1200px;
    width: 100%;
    text-align: center; /* Ensures the text is centered */
    margin: 0 auto; /* Centers the container itself */
}

.servicii-image-container {
    margin-right: 30px;
}

.servicii-image-container img {
    width: 500px; /* Adjust image size as per your preference */
    height: auto;
    border-radius: 10px;
}

.servicii-text-container {
    max-width: 600px;
    text-align: center; /* Ensures the text is centered */
}

.servicii-text-container h2 {
    font-size: 2em;
    margin-bottom: 15px;
}

.servicii-text-container p {
    font-size: 1.2em;
    margin-bottom: 15px;
}

.servicii-text-container ul {
    font-size: 1.1em;
    line-height: 1.5;
    list-style-type: none; /* Optional: removes bullet points */
}

.servicii-text-container li {
    margin-bottom: 10px;
    text-align: left;
}
/* --- OPTIMIZARE PENTRU TELEFON --- */
@media (max-width: 768px) {
    .servicii-container {
        flex-direction: column; /* Elemente puse în coloană */
        text-align: center;
    }

    .servicii-image-container {
        margin: 0 0 20px 0; /* Eliminăm marginea laterală și adăugăm spațiu jos */
    }

    .servicii-image-container img {
        width: 90%; /* Redimensionăm imaginea pentru telefoane */
        max-width: 300px; /* Nu o lăsăm să fie prea mare */
    }

    .servicii-text-container {
        max-width: 90%;
    }

    .servicii-text-container h2 {
        font-size: 1.8em; /* Ușor mai mic pentru mobil */
    }

    .servicii-text-container p, 
    .servicii-text-container ul {
        font-size: 1em; /* Reducem dimensiunea textului */
    }
}
.car-image {
    width: 100% !important;
    height: 200px !important;
    object-fit: cover !important;
    border-bottom: 2px solid #ddd !important;
    display: block !important;
}




/* Stil pentru butonul principal */
.contact-button {
    position: fixed;
    bottom: 20px;
    right: 20px;
    background-color: #e7222e; /* Culoarea aleasă */
    color: white;
    padding: 15px;
    border-radius: 50%;
    font-size: 18px;
    font-weight: bold;
    text-align: center;
    cursor: pointer;
    box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.3);
    z-index: 1000;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.contact-button:hover {
    transform: scale(1.1); /* Mărim butonul la hover */
    box-shadow: 0px 6px 15px rgba(0, 0, 0, 0.4); /* Efect de umbră la hover */
}

/* Stil pentru opțiunile care vor apărea */
.contact-options {
    display: none; /* Ascunde opțiunile inițial */
    position: fixed;
    bottom: 90px;
    right: 20px;
    background-color: #fff;
    box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1); /* Efect de umbră subtile */
    border-radius: 8px;
    padding: 10px;
    width: 220px;
    z-index: 999;
    transition: opacity 0.3s ease, transform 0.3s ease;
    opacity: 0;
    transform: translateY(20px); /* Împinge opțiunile în sus la început */
}

.contact-options.show {
    display: block;
    opacity: 1;
    transform: translateY(0); /* Permite opțiunilor să se miște în sus */
}

/* Stil pentru fiecare opțiune */
.option-button {
    display: block;
    padding: 10px;
    margin: 8px 0;
    background-color: #e7222e; /* Culoare similară cu butonul principal */
    color: white;
    text-decoration: none;
    border-radius: 6px;
    text-align: center;
    font-weight: 600;
    transition: background-color 0.3s ease, transform 0.2s ease;
    font-size: 14px;
}

.option-button:hover {
    background-color: #d61d2c; /* Culoare mai închisă la hover */
}

.option-button:active {
    transform: scale(0.98); /* Micșorează butonul la apăsare */
}

/* Efect pentru animarea butonului principal și opțiunilor */
@keyframes bounce {
    0%, 100% {
        transform: translateY(0);
    }
    50% {
        transform: translateY(-5px);
    }
}

.contact-button {
    animation: bounce 2s infinite; /* Animatie care face butonul să sară */
}

.cookie-notice {
    position: fixed;
    bottom: 20px;
    left: 20px;
    width: 300px; /* Dimensiune mai mică */
    background-color: rgba(0, 0, 0, 0.9);
    color: white;
    text-align: left;
    padding: 15px;
    font-size: 14px;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    z-index: 1000;
}

.cookie-notice a {
    color: #f1c40f;
    text-decoration: underline;
}

.cookie-notice button {
    background-color: #f1c40f;
    color: black;
    border: none;
    padding: 8px 12px;
    cursor: pointer;
    margin-top: 10px;
    border-radius: 5px;
    width: 100%;
}

.cookie-notice button:hover {
    background-color: #333;
}

/* Media Query pentru dispozitive mobile */
@media (max-width: 600px) {
    .cookie-notice {
        bottom: 10px;
        left: 10px; /* Poziționează-l în colțul din stânga jos */
        right: auto; /* Elimină alinierea dreapta */
        padding: 12px;
        font-size: 14px;
        max-width: 60%; /* Lățimea este mai mică */
        margin: 0; /* Nu mai folosim margine automată */
        position: fixed; /* Menține secțiunea fixată pe ecran */
    }

    .cookie-notice button {
        padding: 8px 12px;
    }
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
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="index.php">
                <img src="logo.png" alt="Logo" style="max-height: 60px;">
            </a>
                       
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item"><a class="nav-link" href="index.php">Acasă</a></li>
                    <li class="nav-item"><a class="nav-link" href="desprenoi.html">Despre noi</a></li>
                    <li class="nav-item"><a class="nav-link" href="dashboard/masini.php">Mașini de vânzare</a></li>
                    <li class="nav-item"><a class="nav-link" href="finantare.php">Finanțare</a></li>
                    <li class="nav-item"><a class="nav-link" href="contact.html">Contact</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div id="cookie-notice" class="cookie-notice">
    <p>Acest site folosește cookie-uri pentru a îmbunătăți experiența utilizatorilor. <a href="politica.html">Mai multe detalii</a></p>
    <button id="accept-cookies">Accept</button>
</div>



    <header class="hero-section">
        <div class="container">
            <div class="hero-content">
                <h1>Mașini RATE sau CASH</h1>
                <p><strong>Tu alegi mașina, noi o finanțăm.</strong></p>
                
                <div class="checklist">
                    <div class="check-item">
                        <span class="check-circle">&#10003;</span>
                        <span>Aplici 100% online fără deplasări</span>
                    </div>
                    <div class="check-item">
                        <span class="check-circle">&#10003;</span>
                        <span>Garantie 12 Luni</span>
                    </div>
                    <div class="check-item">
                        <span class="check-circle">&#10003;</span>
                        <span>Doar mașini cu Kilometri reali</span>
                    </div>
                    <div class="check-item">
                        <span class="check-circle">&#10003;</span>
                        <span>Rate fără avans 100% online</span>
                    </div>
                </div>
    
                <div class="buttons">
                    <a href="dashboard/masini.php" class="btn-primary">Vezi stocul </a>
                    <a href="https://wa.me/40739550551?text=Salut!%20Mă%20interesează%20mai%20multe%20informații%20despre%20mașinile%20disponibile.%20Aș%20dori%20să%20aflu%20detalii%20adționale." class="btn-whatsapp">
                        <img src="wapp.png" alt="WhatsApp"> Mesaj pe WhatsApp
                    </a>
                </div>
            </div>
        </div>
    </header>


   <!-- Container pentru carduri cu mașini -->
<section class="masini-section">
    <h2>Anunțuri automobile</h2>
    <div class="containermasini">
        <div class="masini-grid">
            <?php
            require 'dashboard/config.php'; 

            $query = "SELECT * FROM cars WHERE 1=1";

// Dacă sunt filtre pentru marcă sau model, le adăugăm la interogare
if (isset($_GET['marca'])) {
    $query .= " AND marca LIKE '%" . mysqli_real_escape_string($conn, $_GET['marca']) . "%'";
}

if (isset($_GET['model'])) {
    $query .= " AND model LIKE '%" . mysqli_real_escape_string($conn, $_GET['model']) . "%'";
}

// Limitează la 12 rezultate
$query .= " LIMIT 12";

            $result = mysqli_query($conn, $query);

            if (!$result) {
                die('Eroare la interogare: ' . mysqli_error($conn)); 
            }

            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    // Verificăm dacă există o imagine în baza de date și setăm calea corectă
                    $image_name = !empty($row['imagine']) ? basename($row['imagine']) : 'default_image.jpg';
                    $full_image_path = "https://ssa-automobile-prahova.com/dashboard/uploads/" . $image_name;
            ?>
                    <div class="car-card">
                        <!-- Afișăm imaginea din calea corectă -->
                        <img src="<?php echo htmlspecialchars($full_image_path); ?>" alt="Imaginea mașinii" class="car-image" />

                        <h3><?php echo htmlspecialchars($row['marca'] . ' ' . $row['model']); ?></h3>
                        <div class="car-specifications">
                            <p><i class="fas fa-euro-sign"></i> Preț: <?php echo htmlspecialchars($row['pret']); ?> €</p>
                            <p><i class="fas fa-calendar-alt"></i> An: <?php echo htmlspecialchars($row['an']); ?></p>
                            <p><i class="fas fa-gas-pump"></i> Motorizare: <?php echo htmlspecialchars($row['motorizare']); ?></p>
                            <p><i class="fas fa-tachometer-alt"></i> Kilometraj: 
   
                            <?php echo number_format((int) $row['kilometraj'], 0, ',', '.'); ?> km                     </p>
               <p><i class="fas fa-cogs"></i> Cutie de viteze: <?php echo htmlspecialchars($row['cutie_viteze'] ?? 'N/A'); ?></p>
                            <p><i class="fas fa-cube"></i> Capacitate cilindrică: <?php echo htmlspecialchars($row['capacitate_cilindrica'] ?? 'N/A'); ?> cm³</p>
                        </div>
                        <a href="dashboard/detalii.php?id=<?php echo $row['id']; ?>" class="view-details-btn">Vezi detalii</a>
                    </div>
            <?php
                }
            } else {
                echo "<p>Nu s-au găsit mașini.</p>";
            }
            ?>
        </div>
    </div>
</section>



<!-- Buton pentru a redirecționa către pagina cu toate mașinile -->
<a href="dashboard/masini.php" class="view-more-btn">Vezi mai multe mașini</a>

    
    <section id="ss-auto-features">
        <h2>De ce să alegi SSA Automobile?</h2>
        <p>SSA Automobile este autorizat în comerțul cu autoturisme rulate și vă oferă spre vânzare o gamă diversificată de autoturisme din import de cea mai înaltă calitate.</p>
        
        <div class="features-list">
            <div class="feature-item">
                <img src="https://img.icons8.com/ios-filled/50/000000/money-bag.png" alt="Finanțare fără avans">
                <h3>Finanțare Fără Avans</h3>
                <p>Vă oferim posibilitatea de a achiziționa autoturismele noastre atât cash cât și în rate fără niciun avans.</p>
            </div>
    
            <div class="feature-item">
                <img src="https://img.icons8.com/ios-filled/50/000000/guarantee.png" alt="Garantie 12 Luni">
                <h3>Garantie 12 Luni</h3>
                <p>Garantie 12 luni pentru cutia de viteze și motor indiferent de mașina achiziționată.</p>
            </div>
    
            <div class="feature-item">
                <img src="https://img.icons8.com/ios-filled/50/000000/truck.png" alt="Livrare la adresa">
                <h3>Livrare Directă</h3>
                <p>Vă oferim posibilitatea ridicării din parc sau livrare la adresa a autoturismului, oriunde în țară!</p>
            </div>
        </div>
    </section>
    

 <section id="servicii">
    <div class="servicii-container">
        <div class="servicii-image-container">
            <img src="car-finance-outstanding.png" alt="Imagine servicii">
        </div>
        <div class="servicii-text-container">
            <h2>Cum se obtine finantarea?</h2>
            <p>Foarte simplu și sunt necesare doar câteva condiții decente:</p>
            <ul>
                <li><span class="checkmark">✅</span> Ești persoană fizică cu rezidență permanentă în România;</li>
                <li><span class="checkmark">✅</span> Ai minim 3 luni vechime în muncă la actualul angajator;</li>
                <li><span class="checkmark">✅</span> Încasezi un venit permanent de minim 1.524 RON;</li>
                <li><span class="checkmark">✅</span> Te încadrezi inclusiv cu istoric negativ în birou de credit;</li>
                <li><span class="checkmark">✅</span> Acceptăm inclusiv venituri din afaceri, doar cu prezența unui co-plătitor pe contract;</li>
                <li><span class="checkmark">✅</span> Documentația necesară este redusă - poți lua un credit doar cu buletinul, fără adeverință de venit, dacă ai venituri permanente declarate la ANAF.</li>
            </ul>
        </div>
    </div>
</section>


    <div id="contact-button" class="contact-button">
        <span>Contact</span>
    </div>
    
    <div id="contact-options" class="contact-options">
        <a href="tel:+40743016677" class="option-button">Apel Telefonic</a>
        <a href="https://wa.me/40739550551?text=Salut!%20Mă%20interesează%20mai%20multe%20informații%20despre%20mașinile%20disponibile.%20Aș%20dori%20să%20aflu%20detalii%20adționale." class="option-button">WhatsApp</a>
        <a href="finantare.php" class="option-button">Rate Online</a>
    </div>



    

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
    
    <script>
        document.getElementById("contact-button").addEventListener("click", function() {
            var contactOptions = document.getElementById("contact-options");
    
            // Toggle (arată sau ascunde) opțiunile de contact
            contactOptions.classList.toggle("show");
        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            if (!localStorage.getItem("cookieAccepted")) {
                document.getElementById("cookie-notice").style.display = "flex";
            }
        
            document.getElementById("accept-cookies").addEventListener("click", function () {
                localStorage.setItem("cookieAccepted", "true");
                document.getElementById("cookie-notice").style.display = "none";
            });
        });
        </script>
        
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
