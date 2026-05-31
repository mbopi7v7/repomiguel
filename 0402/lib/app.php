<?php
define('ASSETS_URL', '/assets');

//BASE_URL
 $script_name = $_SERVER['SCRIPT_NAME'];
 $parts = explode('/', trim($script_name, '/'));
 $base_url = $parts[0] ?? '';
 define('BASE_URL', '/' . $base_url);

?>