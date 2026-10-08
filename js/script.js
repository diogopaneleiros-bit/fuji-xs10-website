document.addEventListener('DOMContentLoaded', function () {
    const profileWrap = document.querySelector('.profile-wrap');
    const profileToggle = document.querySelector('.profile-toggle');

    if (profileWrap && profileToggle) {
        profileToggle.addEventListener('click', function () {
            profileWrap.classList.toggle('open');
        });

        document.addEventListener('click', function (event) {
            if (!profileWrap.contains(event.target)) {
                profileWrap.classList.remove('open');
            }
        });
    }

    const loginTabs = document.querySelectorAll('.auth-tab');
    const loginForms = document.querySelectorAll('.auth-form');

    loginTabs.forEach((tab) => {
        tab.addEventListener('click', () => {
            const target = tab.dataset.target;

            loginTabs.forEach((item) => item.classList.toggle('active', item === tab));
            loginForms.forEach((form) => form.classList.toggle('active', form.dataset.form === target));
        });
    });

    const mapPins = document.querySelectorAll('.map-marker');
    const mapInfo = document.querySelector('.map-info');

    mapPins.forEach((pin) => {
        pin.addEventListener('click', () => {
            const country = pin.dataset.country;
            const provider = pin.dataset.provider;
            const price = pin.dataset.price;
            const status = pin.dataset.status;
            const type = pin.dataset.type;

            if (!mapInfo) return;

            mapInfo.innerHTML = `
                <h4>${country}</h4>
                <p><strong>Loja:</strong> ${provider}</p>
                <p><strong>Preço:</strong> ${price}</p>
                <p><strong>Disponibilidade:</strong> ${status}</p>
                <p><strong>Envio:</strong> ${type}</p>
            `;

            mapInfo.classList.add('visible');
            mapPins.forEach((marker) => marker.classList.toggle('active', marker === pin));
        });
    });
});
