<?php
/**
 * Main class.
 *
 * @package yandex-music-for-wp
 */

namespace Mihdan\YandexMusicForWP;

class Main {
	/**
	 * What about reading the spec, yandex team? 🤦‍
	 */
	private const TEMPLATES = [
		'playlist'    => [
			'format'   => '#https?:\/\/music\.yandex\.ru\/users\/([^\/]+)\/playlists\/(\d+)#i',
			'endpoint' => 'https://music.yandex.ru/handlers/oembed-{format}.jsx?album=%s',
			'callback' => 'playlist_callback',
			'template' => '<iframe frameborder="0" style="border:none;width:100%%;height:450px;" width="100%%" height="450" src="https://music.yandex.ru/iframe/#playlist/%s/%s"></iframe>',
		],
		'album_track' => [
			'format'   => '#https?:\/\/music\.yandex\.ru\/album\/(\d+)\/track\/(\d+)#i',
			'endpoint' => 'https://music.yandex.ru/handlers/oembed-{format}.jsx?album=%s&track=%s',
			'callback' => 'album_track_callback',
			'template' => '<iframe frameborder="0" style="border:none;width:100%%;height:180px;" width="100%%" height="180" src="https://music.yandex.ru/iframe/#track/%s/%s"></iframe>',
		],
		'track'       => [
			'format'   => '#https?:\/\/music\.yandex\.ru\/track\/(\d+)#i',
			'endpoint' => 'https://music.yandex.ru/handlers/oembed-{format}.jsx?track=%s',
			'callback' => 'track_callback',
			'template' => '<iframe frameborder="0" style="border:none;width:100%%;height:120px;" width="100%%" height="120" src="https://music.yandex.ru/iframe/#track/%s"></iframe>',
		],
		'album'       => [
			'format'   => '#https?:\/\/music\.yandex\.ru\/album\/(\d+)#i',
			'endpoint' => 'https://music.yandex.ru/handlers/oembed-{format}.jsx?album=%s',
			'callback' => 'album_callback',
			'template' => '<iframe frameborder="0" style="border:none;width:100%%;height:450px;" width="100%%" height="450" src="https://music.yandex.ru/iframe/#album/%s"></iframe>',
		],
	];

	public static function init() {
		self::setup_hooks();
	}
	private static function setup_hooks() {
		add_action( 'init', [ __CLASS__, 'add_oembed_provider' ] );
	}

	public static function add_oembed_provider() {
		foreach ( self::TEMPLATES as $template_key => $template ) {
			wp_embed_register_handler(
				$template_key . '_foo',
				$template['format'],
				[ __CLASS__, $template['callback'] ]
			);
		}
	}

	public static function album_track_callback( $matches, $attr, $url, $rawattr ) {
		$embed = sprintf(
			self::TEMPLATES['album_track']['template'],
			$matches[1],
			$matches[2]
		);

		return apply_filters( 'wp_embed_handler_yandex_music_album_track', $embed, $attr, $url, $rawattr );
	}

	public static function playlist_callback( $matches, $attr, $url, $rawattr ) {
		$embed = sprintf(
			self::TEMPLATES['playlist']['template'],
			$matches[1],
			$matches[2]
		);

		return apply_filters( 'wp_embed_handler_yandex_music_playlist', $embed, $attr, $url, $rawattr );
	}

	public static function album_callback( $matches, $attr, $url, $rawattr ) {
		$embed = sprintf(
			self::TEMPLATES['album']['template'],
			$matches[1]
		);

		return apply_filters( 'wp_embed_handler_yandex_music_album', $embed, $attr, $url, $rawattr );
	}

	public static function track_callback( $matches, $attr, $url, $rawattr ) {
		$embed = sprintf(
			self::TEMPLATES['track']['template'],
			$matches[1]
		);

		return apply_filters( 'wp_embed_handler_yandex_music_track', $embed, $attr, $url, $rawattr );
	}
}