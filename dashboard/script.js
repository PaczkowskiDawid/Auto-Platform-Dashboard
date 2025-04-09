function deleteCar(carId) {
    if (confirm("Sigur vrei să ștergi această mașină?")) {
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "delete_car.php", true);  // Aici este fișierul care va prelucra cererea
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onload = function() {
            if (xhr.status == 200) {
                document.getElementById('car-' + carId).style.display = 'none'; // Ascunde cardul după ștergere
            }
        };
        xhr.send("id=" + carId); // Trimite ID-ul mașinii la fișierul PHP
    }
}
