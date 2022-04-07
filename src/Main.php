<?php
/**
 * Main class.
 *
 * @package yandex-music-for-wp
 */

namespace Mihdan\YandexMusicForWP;

class Main {
	public static function init() {
		self::setup_hooks();
	}
	private static function setup_hooks() {
		add_action( 'init', [ Embed::class, 'add_oembed_provider' ] );
	}
}