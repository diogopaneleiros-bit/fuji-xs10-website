<?php
// Configuração global do site
session_start();

define('SITE_NAME', 'Fuji X-S10');
define('DB_PATH', __DIR__ . '/data/site.sqlite');

if (!is_dir(__DIR__ . '/data')) {
    mkdir(__DIR__ . '/data', 0777, true);
}
