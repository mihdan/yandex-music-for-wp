<?php
/**
 * Plugin Name: Yandex Music for WordPress
 * Description: Add supports for ...
 * Version: 1.0.2
 * Author: Mikhail Kobzarev
 * Author URI: https://www.kobzarev.com/
 *
 * @package yandex-music-for-wp
 */

namespace Mihdan\YandexMusicForWP;

define( __NAMESPACE__ . '\PLUGIN_VERSION', '1.0.2' );
define( __NAMESPACE__ . '\PLUGIN_PATH', __DIR__ );
define( __NAMESPACE__ . '\PLUGIN_FILE', __FILE__ );
define( __NAMESPACE__ . '\PLUGIN_SLUG', 'yandex_music_for_wp' );

require_once PLUGIN_PATH . '/src/Embed.php';
require_once PLUGIN_PATH . '/src/Main.php';

Main::init();