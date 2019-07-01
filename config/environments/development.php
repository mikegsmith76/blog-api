<?php
/**
 * Configuration overrides for WP_ENV === 'development'
 */

ini_set('display_errors', 1);
error_reporting(E_ALL);

use Roots\WPConfig\Config;

Config::define('SAVEQUERIES', true);
Config::define('WP_DEBUG', true);
Config::define('WP_DEBUG_DISPLAY', true);
Config::define('WP_DISABLE_FATAL_ERROR_HANDLER', true);
Config::define('SCRIPT_DEBUG', true);

// Enable plugin and theme updates and installation from the admin
Config::define('DISALLOW_FILE_MODS', false);
