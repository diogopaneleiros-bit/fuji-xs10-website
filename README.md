document.addEventListener('DOMContentLoaded', function () {
    const toggleBtn = document.getElementById('toggleProfileMenu');
    const profileMenu = document.getElementById('profileMenu');

    if (toggleBtn && profileMenu) {
        toggleBtn.addEventListener('click', function () {
            profileMenu.classList.toggle('open');
        });
    }

    const mapPins = document.querySelectorAll('.map-pin');
    const mapInfo = document.getElementById('mapInfo');

    if (mapPins.length && mapInfo) {
        mapPins.forEach(function (pin) {
            pin.addEventListener('click', function () {
                const country = pin.dataset.country;
                const price = pin.dataset.price;
                const store = pin.dataset.store;
                const link = pin.dataset.link || '#';

                mapInfo.innerHTML = `
                    <h3>${country}</h3>
                    <p><strong>Preço:</strong> ${price}</p>
                    <p><strong>Loja:</strong> ${store}</p>
                    <p><strong>Disponibilidade:</strong> Em stock</p>
                    <p><a href="${link}" class="primary-btn">Ver loja</a></p>
                `;
            });
        });
    }
});
