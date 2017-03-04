<?php

define('BASE_URL', 'http://192.168.1.21/jss_photos/');
define('LETTERS_URL', 'http://192.168.1.21/jss_letters/');
define('PUBLIC_URL', BASE_URL . 'public/');
define('XML_SRC_URL', BASE_URL . 'md-src/xml/');
define('PHOTO_URL', PUBLIC_URL . 'Photos/');
define('DOWNLOAD_URL', PUBLIC_URL . 'Downloads/');
define('STOCK_IMAGE_URL', PUBLIC_URL . 'images/stock/');
define('RESOURCES_URL', PUBLIC_URL . 'Resources/');
define('JSON_PRECAST_URL', BASE_URL . 'json-precast/');

// Physical location of resources
define('PHY_BASE_URL', '/var/www/html/jss_photos/');
define('PHY_PUBLIC_URL', PHY_BASE_URL . 'public/');
define('PHY_XML_SRC_URL', PHY_BASE_URL . 'md-src/xml/');
define('PHY_PHOTO_URL', PHY_PUBLIC_URL . 'Photos/');
define('PHY_TXT_URL', PHY_PUBLIC_URL . 'Text/');
define('PHY_DOWNLOAD_URL', PHY_PUBLIC_URL . 'Downloads/');
define('PHY_FLAT_URL', PHY_BASE_URL . 'application/views/flat/');
define('PHY_STOCK_IMAGE_URL', PHY_PUBLIC_URL . 'images/stock/');
define('PHY_RESOURCES_URL', PHY_PUBLIC_URL . 'Resources/');

define('DB_PREFIX', 'jss');
define('DB_HOST', 'localhost');

// Git config
define('GIT_USER_NAME', 'shivasdst232');
define('GIT_PASSWORD', 'shiva565');
define('GIT_REPO', 'github.com/shivasdst/jss_photos.git');
define('GIT_REMOTE', 'https://' . GIT_USER_NAME . ':' . GIT_PASSWORD . '@' . GIT_REPO);
define('GIT_EMAIL', 'shiva@srirangadigital.com');

// photo will become iitmPHOTO inside
define('DB_NAME', 'jssphotos');

define('jssphotos_USER', 'root');
define('jssphotos_PASSWORD', 'mysql');

?>
