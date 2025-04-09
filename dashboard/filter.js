// document.addEventListener("DOMContentLoaded", function () {
//     let marcaSelect = document.getElementById("marca");
//     let modelSelect = document.getElementById("model");
//     let priceMin = document.getElementById("priceMin");
//     let priceMax = document.getElementById("priceMax");
//     let priceRange = document.getElementById("priceRange");

//     // AJAX pentru încărcarea modelelor
//     marcaSelect.addEventListener("change", function () {
//         let marca = this.value;
//         let xhr = new XMLHttpRequest();
//         xhr.open("POST", "get_models.php", true);
//         xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
//         xhr.onload = function () {
//             if (this.status == 200) {
//                 modelSelect.innerHTML = this.responseText;
//             }
//         };
//         xhr.send("marca=" + marca);
//     });

//     // Slider pentru preț
//     function updatePriceRange() {
//         let minVal = parseInt(priceMin.value);
//         let maxVal = parseInt(priceMax.value);

//         if (minVal > maxVal) {
//             let temp = minVal;
//             priceMin.value = maxVal;
//             priceMax.value = temp;
//         }

//         priceRange.value = `€${priceMin.value} - €${priceMax.value}`;
//     }

//     priceMin.addEventListener("input", updatePriceRange);
//     priceMax.addEventListener("input", updatePriceRange);

//     updatePriceRange();
// });
