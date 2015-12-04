<?php 

define('BASE_URL', "http://wsi.dev/");
define('REMOTE_URL',"http://wsi.blackstormtest.com");
define('APP_PATH',BASE_URL . 'app/');
define('INC_PATH',APP_PATH . 'includes/');
define('CUSTOM_INC_PATH',APP_PATH . 'custom_includes/');
define('ARTWORK_UPLOAD_PATH', BASE_DIR . "/app/custom_includes/img/artworks/");
define('ARTWORK_UPLOAD_PATH_TEMP',ARTWORK_UPLOAD_PATH. "temp/");

//Use these for imagemagick conversions
define('ARTWORK_FETCH_REL_PATH', 'app/custom_includes/img/artworks/temp/');
define('ARTWORK_THUMB_REL_PATH', ARTWORK_FETCH_REL_PATH . 'thumb/');
define('ARTWORK_THUMB_PATH',BASE_URL . ARTWORK_THUMB_REL_PATH );
?>