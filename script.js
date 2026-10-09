* {
    box-sizing: border-box;
}

:root {
    --black: #0b0d12;
    --dark: #101827;
    --panel: #111827;
    --muted: #dfe6ee;
    --white: #ffffff;
    --accent: #f97316;
    --accent-soft: #fb923c;
    --gray: #94a3b8;
    --light: #f5f7fb;
    --success: #22c55e;
    --danger: #ef4444;
}

html {
    scroll-behavior: smooth;
}

body {
    margin: 0;
    font-family: 'Montserrat', sans-serif;
    background: linear-gradient(180deg, #0f172a 0%, #111827 30%, #f8fafc 30%, #f8fafc 100%);
    color: var(--dark);
}

img {
    max-width: 100%;
    display: block;
}

a {
    text-decoration: none;
    color: inherit;
}

button, input, select, textarea {
    font: inherit;
}

.header {
    position: sticky;
    top: 0;
    z-index: 100;
    background: rgba(11, 13, 18, 0.88);
    backdrop-filter: blur(12px);
    border-bottom: 1px solid rgba(255,255,255,0.08);
}

.container-header {
    max-width: 1200px;
    margin: 0 auto;
    display: flex;
    align-items: center;
    justify-content: space-between;
    min-height: 80px;
    padding: 0 20px;
}

.logo h1 {
    margin: 0;
    font-family: 'Poppins', sans-serif;
    font-size: clamp(1.3rem, 2vw, 2.2rem);
    font-weight: 800;
    color: var(--white);
    letter-spacing: 0.05em;
}

.nav-menu {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 14px;
    flex: 1;
}

.nav-btn {
    padding: 10px 18px;
    border-radius: 999px;
    font-weight: 600;
    color: var(--white);
    background: transparent;
    border: 1px solid rgba(255,255,255,0.1);
    cursor: pointer;
    transition: 0.3s ease;
}

.nav-btn:hover,
.nav-btn.active {
    background: linear-gradient(135deg, var(--accent), var(--accent-soft));
    border-color: transparent;
    transform: translateY(-2px);
    box-shadow: 0 12px 24px rgba(249, 115, 22, 0.25);
}

.login-section {
    display: flex;
    align-items: center;
    justify-content: flex-end;
}

.login-btn,
.primary-btn,
.secondary-btn,
.mini-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    padding: 12px 20px;
    border: none;
    border-radius: 999px;
    font-weight: 700;
    transition: all 0.25s ease;
    cursor: pointer;
}

.login-btn {
    background: #fff;
    color: var(--dark);
    box-shadow: 0 10px 20px rgba(255,255,255,0.18);
}

.login-btn:hover,
.primary-btn:hover,
.secondary-btn:hover,
.mini-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 12px 25px rgba(15, 23, 42, 0.18);
}

.primary-btn {
    background: linear-gradient(135deg, var(--accent), var(--accent-soft));
    color: white;
}

.secondary-btn {
    background: rgba(15, 23, 42, 0.05);
    color: var(--dark);
}

.white {
    background: var(--white); 
    color: var(--black);
}

.main-content {
    max-width: 1200px;
    margin: 0 auto;
    padding: 40px 20px 50px;
}

.hero {
    display: grid;
    grid-template-columns: 1.1fr 1fr;
    align-items: center;
    gap: 40px;
    padding: 50px 0 30px;
}

.eyebrow {
    display: inline-block;
    letter-spacing: 0.08em;
    text-transform: uppercase;
    background: rgba(249, 115, 22, 0.08);
    color: var(--accent);
    padding: 8px 14px;
    border-radius: 999px;
    font-size: 0.75rem;
    font-weight: 700;
}

.hero-content h2,
.page-banner h2 {
    font-family: 'Poppins', sans-serif;
    font-size: clamp(2.2rem, 5vw, 4rem);
    line-height: 1.05;
    margin: 16px 0;
    color: var(--dark);
}

.hero-content p,
.banner-text p {
    font-size: 1.08rem;
    color: #475569;
    line-height: 1.7;
}

.cta-group {
    display: flex;
    gap: 16px;
    margin-top: 24px;
}

.hero-image img {
    width: 100%;
    height: 480px;
    object-fit: cover;
    border-radius: 28px;
    box-shadow: 0 20px 45px rgba(15, 23, 42, 0.15);
}

.info-section,
.features-section,
.gallery-section,
.info-blocks,
.compare-section,
.map-section,
.support-grid,
.survey-section,
.admin-page {
    margin-top: 50px;
}

.info-container,
.features-grid,
.support-grid,
.country-list,
.stats-grid {
    display: grid;
    gap: 24px;
}

.info-container {
    grid-template-columns: repeat(3, minmax(0, 1fr));
}

.info-card,
.feature,
.support-card,
.country-card,
.stat-box,
.profile-panel,
.summary-card,
.account-sidebar .avatar-card,
.lens-card,
.accessory-card,
.map-info,
.login-box {
    background: rgba(255,255,255,0.8);
    border: 1px solid rgba(15, 23, 42, 0.06);
    border-radius: 24px;
    padding: 24px;
    box-shadow: 0 18px 38px rgba(15, 23, 42, 0.06);
}

.info-card h3,
.feature h4,
.support-card h3,
.summary-card h4,
.map-info h3,
.login-box h2,
.account-main h3 {
    font-family: 'Poppins', sans-serif;
    margin-top: 0;
}

.features-grid {
    grid-template-columns: repeat(3, minmax(0, 1fr));
}

.feature h4 {
    margin-bottom: 8px;
}

.gallery {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 20px;
}

.gallery img {
    height: 260px;
    object-fit: cover;
    border-radius: 24px;
    box-shadow: 0 16px 30px rgba(15, 23, 42, 0.08);
}

.page-layout {
    padding-top: 20px;
}

.page-banner {
    display: grid;
    grid-template-columns: 1fr 1.1fr;
    align-items: center;
    gap: 30px;
    background: linear-gradient(135deg, rgba(15,23,42,0.96), rgba(31,41,55,0.9));
    color: var(--white);
    border-radius: 32px;
    padding: 32px;
    overflow: hidden;
}

.page-banner.compact {
    display: block;
    background: linear-gradient(135deg, rgba(249,115,22,0.18), rgba(15,23,42,0.9));
    padding: 28px 32px;
}

.page-banner img {
    width: 100%;
    max-height: 420px;
    object-fit: cover;
    border-radius: 24px;
}

.banner-text h2 {
    color: var(--white);
    margin: 10px 0;
}

.banner-text p {
    color: rgba(255,255,255,0.82);
}

.specs-wrap {
    display: grid;
    grid-template-columns: 1.4fr 0.9fr;
    gap: 26px;
    padding-top: 28px;
}

.spec-main img {
    width: 100%;
    height: 420px;
    object-fit: cover;
    border-radius: 24px;
}

.spec-side {
    background: rgba(255,255,255,0.8);
    border: 1px solid rgba(15,23,42,0.06);
    border-radius: 24px;
    padding: 28px;
}

.spec-side ul {
    padding-left: 18px;
    color: #475569;
    line-height: 2;
}

.info-blocks {
    display: grid;
    grid-template-columns: repeat(3, minmax(0, 1fr));
    gap: 24px;
}

.info-item {
    background: #fff;
    border-radius: 24px;
    padding: 24px;
    border: 1px solid rgba(15,23,42,0.06);
}

.compare-table {
    background: rgba(255,255,255,0.9);
    border: 1px solid rgba(15,23,42,0.06);
    border-radius: 20px;
    overflow: hidden;
}

.table-row {
    display: grid;
    grid-template-columns: 1.3fr 1fr 1fr;
    padding: 18px 24px;
    border-bottom: 1px solid rgba(15,23,42,0.06);
}

.table-row.head {
    background: rgba(249,115,22,0.08);
    font-weight: 700;
}

.lens-grid,
.accessory-grid {
    display: grid;
    grid-template-columns: repeat(2, minmax(0, 1fr));
    gap: 26px;
    margin-top: 28px;
}

.lens-card,
.accessory-card {
    overflow: hidden;
    padding: 0;
}

.lens-card img,
.accessory-card img {
    height: 260px;
    width: 100%;
    object-fit: cover;
}

.lens-info,
.accessory-info {
    padding: 22px;
}

.support-grid {
    grid-template-columns: repeat(2, minmax(0, 1fr));
}

.survey-form,
.profile-form,
.login-form {
    display: grid;
    gap: 18px;
    margin-top: 16px;
}

.survey-form label,
.profile-form label,
.login-form label {
    display: grid;
    gap: 10px;
    font-weight: 600;
    color: var(--dark);
}

input, select, textarea {
    width: 100%;
    border: 1px solid rgba(15,23,42,0.12);
    border-radius: 12px;
    padding: 12px 14px;
    background: rgba(255,255,255,0.7);
}

textarea {
    resize: vertical;
    min-height: 120px;
}

.alert {
    padding: 12px 16px;
    border-radius: 12px;
    margin-top: 12px;
    font-weight: 600;
}

.alert.success {
    background: rgba(34,197,94,0.12);
    color: #166534;
}

.alert.error {
    background: rgba(239,68,68,0.10);
    color: #991b1b;
}

.map-wrapper {
    display: grid;
    grid-template-columns: 1.5fr 0.7fr;
    gap: 24px;
    align-items: center;
}

.map-surface {
    position: relative;
    height: 420px;
    background: linear-gradient(180deg, #dbeafe, #f1f5f9 55%, #dbeafe);
    border-radius: 24px;
    border: 1px solid rgba(15,23,42,0.08);
    overflow: hidden;
    box-shadow: inset 0 0 60px rgba(148,163,184,0.15);
}

.map-surface::before {
    content: "";
    position: absolute;
    inset: 0;
    background: radial-gradient(circle at 20% 20%, rgba(58,120,255,0.18), transparent 30%), radial-gradient(circle at 65% 35%, rgba(99,102,241,0.18), transparent 25%);
}

.map-pin {
    position: absolute;
    width: 44px;
    height: 44px;
    border-radius: 50%;
    border: 3px solid white;
    background: linear-gradient(135deg, var(--accent), var(--accent-soft));
    color: white;
    font-weight: 700;
    box-shadow: 0 10px 20px rgba(249,115,22,0.35);
    cursor: pointer;
    transition: transform 0.2s ease;
}

.map-pin:hover {
    transform: scale(1.08);
}

.map-info {
    min-height: 220px;
}

.country-list {
    grid-template-columns: repeat(4, minmax(0, 1fr));
    margin-top: 30px;
}

.account-page {
    padding-top: 32px;
}

.account-shell {
    display: grid;
    grid-template-columns: 320px 1fr;
    gap: 26px;
}

.avatar-box {
    width: 120px;
    height: 120px;
    border-radius: 50%;
    overflow: hidden;
    border: 4px solid rgba(249,115,22,0.15);
    margin: 0 auto 18px;
}

.avatar-box img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.account-actions {
    margin-top: 18px;
}

.account-main {
    display: grid;
    gap: 24px;
}

.account-summary {
    display: grid;
    grid-template-columns: repeat(2, minmax(0, 1fr));
    gap: 24px;
}

#profileMenu {
    display: none;
}

#profileMenu.open {
    display: block;
}

.login-page {
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 70vh;
}

.login-box {
    width: min(100%, 460px);
}

.login-meta {
    margin-top: 18px;
    color: #475569;
    font-size: 0.95rem;
    line-height: 1.6;
}

.admin-table-wrap {
    background: rgba(255,255,255,0.82);
    border-radius: 24px;
    border: 1px solid rgba(15,23,42,0.06);
    padding: 24px;
    overflow: auto;
}

.admin-table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 16px;
}

.admin-table th,
.admin-table td {
    border-bottom: 1px solid rgba(15,23,42,0.08);
    text-align: left;
    padding: 12px 10px;
    vertical-align: top;
}

.stats-grid {
    grid-template-columns: repeat(3, minmax(0, 1fr));
    margin-bottom: 20px;
}

.stat-box {
    text-align: center;
}

.stat-box h3 {
    margin: 0 0 6px;
    font-size: 2rem;
    color: var(--dark);
}

.footer {
    background: #0f172a;
    color: rgba(255,255,255,0.9);
    margin-top: 60px;
}

.footer-content {
    max-width: 1200px;
    margin: 0 auto;
    display: grid;
    grid-template-columns: repeat(4, minmax(0, 1fr));
    gap: 28px;
    padding: 40px 20px 20px;
}

.footer-section h4 {
    font-family: 'Poppins', sans-serif;
    margin-top: 0;
    margin-bottom: 14px;
    color: white;
}

.footer-section p,
.footer-section a {
    color: rgba(255,255,255,0.7);
    line-height: 1.8;
}

.footer-bottom {
    text-align: center;
    padding: 16px 20px 28px;
    border-top: 1px solid rgba(255,255,255,0.08);
    color: rgba(255,255,255,0.75);
}

@media (max-width: 920px) {
    .nav-menu {
        display: none;
    }

    .hero,
    .page-banner,
    .specs-wrap,
    .account-shell,
    .map-wrapper,
    .country-list,
    .info-container,
    .features-grid,
    .support-grid,
    .stats-grid,
    .account-summary,
    .footer-content,
    .lens-grid,
    .accessory-grid {
        grid-template-columns: 1fr;
    }

    .gallery {
        grid-template-columns: 1fr;
    }
}
