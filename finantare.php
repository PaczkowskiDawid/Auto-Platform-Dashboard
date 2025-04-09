<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Obține finanțare pentru mașina dorită la SSA Automobile! Descoperă opțiunile de finanțare flexibile pentru achiziționarea unui vehicul second hand.">

    <title>SSA Automobile - Finantare</title>
    <link rel="icon" href="favicon-32x32.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="stylesfinantare.css">
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
        #finantare {
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 20px;
    background-color: #f4f4f4;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.finantare-container {
    display: flex;
    justify-content: center; /* Center horizontally */
    align-items: center;     /* Center vertically */
    max-width: 1200px;
    margin: 0 auto; /* Center the container within the page */
    width: 100%;
    text-align: center; /* Ensures the text inside is also centered */
}

.finantare-image-container {
    margin-right: 30px;
    display: flex;
    justify-content: center; /* Centers the image horizontally */
}

.finantare-image-container img {
    width: 500px; /* Adjust image size as per your preference */
    height: auto;
    border-radius: 10px;
}

.finantare-text-container {
    max-width: 600px;
    text-align: center; /* Center the text inside the container */
}

.finantare-text-container h2 {
    font-size: 2em;
    margin-bottom: 15px;
}

.finantare-text-container p {
    font-size: 1.2em;
    margin-bottom: 15px;
}

.finantare-text-container ul {
    font-size: 1.1em;
    line-height: 1.5;
    list-style-type: none; /* Optional: removes bullet points */
}

.finantare-text-container li {
    margin-bottom: 10px;
    text-align: left;
}

.finantare-image-container img {
    width: 500px; /* Adjust image size */
    height: auto;
    border-radius: 10px;
}
/* --- OPTIMIZARE PENTRU TELEFON --- */
@media (max-width: 768px) {
    .finantare-container {
        flex-direction: column; /* Elemente puse în coloană */
        text-align: center;
    }

    .finantare-image-container {
        margin: 0 0 20px 0; /* Eliminăm marginea laterală și adăugăm spațiu jos */
    }

    .sfinantare-image-container img {
        width: 90%; /* Redimensionăm imaginea pentru telefoane */
        max-width: 300px; /* Nu o lăsăm să fie prea mare */
    }

    .finantare-text-container {
        max-width: 90%;
    }

    .finantare-text-container h2 {
        font-size: 1.8em; /* Ușor mai mic pentru mobil */
    }

    .finantare-text-container p, 
    .finantare-text-container ul {
        font-size: 1em; /* Reducem dimensiunea textului */
    }
}


.advantages-section {
    width: 100%;
    margin-top: 30px;
    text-align: center;
    line-height: 1.6;
    font-size: 1.1em;
    background-color: #fff; /* Fundal alb */
    padding: 20px 30px;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Umbra subtilă pentru efect */
    margin-bottom: 30px; /* Spatiu sub secțiune */
    overflow: hidden;
}

.advantages-section h2 {
    font-size: 1.8em;
    margin-bottom: 20px;
    text-align: left;
}

.advantages-section p {
    margin-bottom: 15px;
    font-size: 1em;
    text-align: left;
}

@media screen and (max-width: 768px) {
    .advantages-section {
        width: 95%; /* Evităm marginile inutile */
        padding: 15px; /* Reducem padding-ul */
        font-size: 1rem; /* Micșorăm textul pentru o citire mai ușoară */
        text-align: left; /* Textul aliniat stânga pentru aspect profesional */
    }

    .advantages-section h2 {
        font-size: 1.5em; /* Reducem dimensiunea titlului */
        margin-bottom: 10px;
    }

    .advantages-section p {
        font-size: 0.9em; /* Micșorăm textul pentru o mai bună încadrate */
        margin-bottom: 10px; /* Mai puțin spațiu între paragrafe */
    }
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
                    <li class="nav-item"><a class="nav-link" href="finantare.html">Finanțare</a></li>
                    <li class="nav-item"><a class="nav-link" href="contact.html">Contact</a></li>
                </ul>
            </div>
        </div>
    </nav>



    <section class="application-form">
    <div class="form-container">
        <h1>Aplica Online</h1>
        <p>Completează formularul și vei fi contactat în cel mai scurt timp.</p>
        
        <form action="submit-form.php" method="POST">
            <div class="form-group">
                <label for="venituri">Informații venituri</label>
                <select id="venituri" name="venituri" required>
                    <option value="salariat_romania">Salariat România</option>
                    <option value="pensionar_romania">Pensionar în România</option>
                    <option value="contract_extern">Contract extern (UE)</option>
                </select>
            </div>

            <div class="form-group">
                <label for="telefon">Telefon</label>
                <input type="text" id="telefon" name="telefon" placeholder="Numărul de telefon" required>
            </div>

            <div class="form-group">
                <label for="nume">Nume</label>
                <input type="text" id="nume" name="nume" placeholder="Introduceti numele" required>
            </div>

            <div class="form-group">
                <label for="localitate">Localitate domiciliu</label>
                <input type="text" id="localitate" name="localitate" placeholder="Introduceti localitatea" required>
            </div>

            <div class="form-group">
                <label class="radio-label">Sunteți angajat sau pensionar de minim 3 luni?</label>
                <div class="radio-buttons">
                    <label><input type="radio" name="angajat_pensionar" value="da" required> Da</label>
                    <label><input type="radio" name="angajat_pensionar" value="nu" required> Nu</label>
                </div>
            </div>

            <div class="form-group">
                <label class="radio-label">Aveți un venit lunar de peste 2400 RON?</label>
                <div class="radio-buttons">
                    <label><input type="radio" name="venit_lunar" value="da" required> Da</label>
                    <label><input type="radio" name="venit_lunar" value="nu" required> Nu</label>
                </div>
            </div>

            <div class="form-group">
                <label class="radio-label">Aveți rate restante sau sunteți în Biroul de Credit?</label>
                <div class="radio-buttons">
                    <label><input type="radio" name="rate_restante" value="da" required> Da</label>
                    <label><input type="radio" name="rate_restante" value="nu" required> Nu</label>
                </div>
            </div>

            <div class="form-group">
                <label for="masina">Mașina pentru care aplicați</label>
                <textarea id="masina" name="masina" placeholder="Detalii despre mașina dorită" rows="3" required></textarea>
            </div>

            <button type="submit">Trimite aplicația</button>
        </form>
    </div>
</section>


    

    <section id="finantare">
        <div class="finantare-container">
            <div class="finantare-image-container">
                <img src="car-finance-outstanding.png" alt="Imagine finantare">
            </div>
            <div class="finantare-text-container">
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
    
    

    <div class="advantages-section">
        <h2>Avantajele noastre</h2>
        <p>La SSA Automobile, fiecare autoturism din stocul nostru trece printr-un proces riguros de verificare pentru a ne asigura că este fiabil, economic și eficient din punct de vedere al consumului de combustibil. Oferim o selecție variată de mărci, inclusiv Renault, Citroen, Peugeot, Nissan, Audi, Volkswagen și Dacia, pentru a satisface orice preferință și buget.</p>
        <p>Toate mașinile disponibile pot fi testate înainte de achiziție direct la sediul nostru. Pe lângă plata integrală în numerar, oferim și posibilitatea achiziției în rate fixe, astfel încât să puteți găsi autoturismul ideal fără a face un efort financiar considerabil.</p>
        <p>Comparativ cu anunțurile de pe diverse platforme, la SSA Automobile beneficiați de o gamă largă de modele într-un singur loc, având ocazia să analizați fiecare autoturism personal, să îl verificați într-un service autorizat sau împreună cu un mecanic de încredere. De asemenea, oferim finanțare flexibilă pe o perioadă de până la 5 ani, cu avans 0 sau o sumă minimă care să vă asigure o rată lunară accesibilă. Pentru transparență totală, fiecare vehicul din stoc este însoțit de seria de șasiu (VIN), astfel încât să îl puteți verifica în orice bază de date sau la reprezentanță. În plus, testăm toate funcțiile și dotările fiecărui autoturism pentru a vă asigura că beneficiați de toate sistemele funcționale, de la climatizare până la senzori de parcare. Suntem prezenți de ani de zile pe piață, iar clienții noștri ne pot găsi mereu la aceeași adresă.</p>
        <p>La SSA Automobile, nu doar că vindem mașini, ci ne asigurăm că fiecare client are parte de o experiență de achiziție sigură și plăcută. Fiecare autoturism achiziționat de la noi vine cu garanție pentru motor și cutia de viteze, iar kilometrajul real este certificat pe factură. Oferim soluții flexibile de finanțare, inclusiv pentru persoane cu istoric negativ, pensionari sau români care lucrează în străinătate. Alegând SSA Automobile, optați pentru profesionalism, transparență și autoturisme atent verificate. În plus, oferim posibilitatea achiziței prin rate fixe, egale pe toată perioada de creditare, cu avans 0.</p>
        <p>Mașinile noastre provin exclusiv de la proprietari privați, fără a fi fost utilizate în regim de taxi sau pentru școli de șoferi. Fiecare vehicul este verificat amănunțit, atât din punct de vedere vizual, cât și tehnic, pentru a ne asigura că nu veți întâmpina probleme în utilizarea zilnică.</p>
        <p>Dacă sunteți în căutarea unei mașini second-hand fiabile și verificate, SSA Automobile este locul potrivit! Vă așteptăm să descoperiți oferta noastră variată și avantajele unui partener de încredere în achiziția unui autoturism.</p>
    </div>
    
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
        document.getElementById("contact-button").addEventListener("click", function() {
            var contactOptions = document.getElementById("contact-options");
    
            // Toggle (arată sau ascunde) opțiunile de contact
            contactOptions.classList.toggle("show");
        });
    </script>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
