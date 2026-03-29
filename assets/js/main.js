document.addEventListener('DOMContentLoaded', function () {
    var menuBtn = document.getElementById('menuBtn');
    var nav = document.getElementById('mainNav');

    if (menuBtn && nav) {
        menuBtn.addEventListener('click', function () {
            nav.classList.toggle('open');
        });
    }

    var colorSelect = document.getElementById('colorSelect');
    var storageSelect = document.getElementById('storageSelect');

    if (colorSelect) {
        colorSelect.addEventListener('change', function () {
            var selectedColor = document.getElementById('selectedColor');
            selectedColor.textContent = colorSelect.value;
        });
    }

    if (storageSelect && window.productData) {
        storageSelect.addEventListener('change', function () {
            var option = window.productData[storageSelect.value];
            document.getElementById('selectedStorage').textContent = option.storage;
            document.getElementById('selectedRam').textContent = option.ram;
            document.getElementById('selectedPrice').textContent = option.price;
        });
    }
});
