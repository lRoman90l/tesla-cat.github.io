<?php
/**
 * Host Google Fonts Locally
 *
 * Plugin Name: Host Google Fonts Locally
 * Plugin URI:  https://wordpress.org/plugins/host-google-fonts-locally
 * Description: Load fonts from your own local server instead of Google's. GDPR-friendly.
 * Version:     1.0.2
 * Author:      Fonts Plugin
 * Author URI:  https://fontsplugin.com
 * Text Domain: host-google-fonts-locally
 * License:     GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 * Domain Path: /languages
 *
 * @package   host-google-fonts-locally
 * @copyright Copyright (c) 2019, Fonts Plugin
 * @license   http://opensource.org/licenses/gpl-2.0.php GNU Public License
 */

if ( ! class_exists( 'Host_Google_Fonts_Locally' ) ) {

	/**
	 * Main Host_Google_Fonts_Locally Class
	 */
	class Host_Google_Fonts_Locally {

		/**
		 * The local CSS.
		 *
		 * @var string
		 */
		public $local_css;

		/**
		 * Initialize plugin.
		 */
		public function __construct() {

			if ( ! defined( 'OGF_VERSION' ) ) {
				add_action( 'admin_notices', array( $this, 'notice' ) );
				return;
			}

			add_action( 'plugins_loaded', array( $this, 'load_textdomain' ) );

			add_action( 'init', array( $this, 'build_css' ) );
			add_action( 'wp_enqueue_scripts', array( $this, 'dequeue_style' ), 1000 );
			add_action( 'ogf_inline_styles', array( $this, 'output_css' ) );

		}

		/**
		 * Load plugin textdomain.
		 */
		public function load_textdomain() {

			load_plugin_textdomain( 'host-google-fonts-locally', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );

		}

		/**
		 * Missing base plugin notice.
		 */
		public function notice() {
			$class     = 'notice notice-error';
			$admin_url = admin_url( 'plugin-install.php?s=googlefonts&tab=search&type=author' );
			/* translators: 1. Admin URL, 2. Admin URL */
			$message = sprintf( __( '<a href="%1$s">Google Fonts for WordPress</a> must be active for this plugin to function. <a href="%2$s">Install now</a>.', 'host-google-fonts-locally' ), $admin_url, $admin_url );
			printf( '<div class="%1$s"><p>%2$s</p></div>', esc_attr( $class ), wp_kses_post( $message ) );
		}

		/**
		 * Build the local CSS.
		 */
		public function build_css() {

			$fonts = new OGF_Fonts();

			if ( ! $fonts->has_custom_fonts() ) {
				return;
			}

			$url = $fonts->build_url();

			$transient_id = 'local_google_fonts_' . md5( $url );
			$contents     = get_site_transient( $transient_id );

			if ( ! $contents ) {
				// Get the contents of the remote URL.
				$contents = $this->get_remote_url_contents(
					$url,
					array(
						'headers' => array(
							'user-agent' => 'Mozilla/5.0 (X11; Linux i686; rv:21.0) Gecko/20100101 Firefox/21.0',
						),
					)
				);

				if ( $contents ) {
					// Add font-display:swap to improve rendering speed.
					$contents = str_replace( '@font-face {', '@font-face{', $contents );
					$contents = str_replace( '@font-face{', '@font-face{font-display:swap;', $contents );
					// Remove blank lines and extra spaces.
					$contents = str_replace(
						array( ': ', ';  ', '; ', '  ' ),
						array( ':', ';', ';', ' ' ),
						preg_replace( "/\r|\n/", '', $contents )
					);

					$contents = $this->use_local_files( $contents );

					// Set the transient for a week.
					set_site_transient( $transient_id, $contents, WEEK_IN_SECONDS );
				}
			}
			if ( $contents ) {
				$this->local_css = wp_strip_all_tags( $contents ); // phpcs:ignore WordPress.Security.EscapeOutput
			}
		}

		/**
		 * Gets the remote URL contents.
		 *
		 * @param string $url The URL to retrieve.
		 * @param array  $args An array of arguments for the wp_remote_retrieve_body() function.
		 */
		public function get_remote_url_contents( $url, $args = array() ) {
			$response = wp_remote_get( $url, $args );
			if ( is_wp_error( $response ) ) {
				return array();
			}
			$html = wp_remote_retrieve_body( $response );
			if ( is_wp_error( $html ) ) {
				return;
			}
			return $html;
		}

		/**
		 * Downloads font-files locally and uses the local files instead of the ones from Google's servers.
		 *
		 * @param string $css The CSS with original URLs.
		 * @return string     The CSS with local URLs.
		 */
		public function use_local_files( $css ) {
			preg_match_all( '/https\:.*?\.woff/', $css, $matches );
			$matches = array_shift( $matches );
			foreach ( $matches as $match ) {
				if ( 0 === strpos( $match, 'https://fonts.gstatic.com' ) ) {
					$new_url = $this->download_font_file( $match );
					if ( $new_url ) {
						$css = str_replace( $match, $new_url, $css );
					}
				}
			}
			return $css;
		}

		/**
		 * Download the font file and move it to wp-content/uploads.
		 *
		 * @param string $url The font URL to download.
		 * @return string     The new URL.
		 */
		public function download_font_file( $url ) {
			// Gives us access to the download_url() and wp_handle_sideload() functions.
			require_once ABSPATH . 'wp-admin/includes/file.php';

			$timeout_seconds = 5;

			// Download file to temp dir.
			$temp_file = download_url( $url, $timeout_seconds );

			if ( is_wp_error( $temp_file ) ) {
				return false;
			}

			// Array based on $_FILE as seen in PHP file uploads.
			$file = array(
				'name'     => basename( $url ),
				'type'     => 'font/woff',
				'tmp_name' => $temp_file,
				'error'    => 0,
				'size'     => filesize( $temp_file ),
			);

			$overrides = array(
				'test_type' => false,
				'test_form' => false,
				'test_size' => true,
			);

			// Move the temporary file into the uploads directory.
			$results = wp_handle_sideload( $file, $overrides );

			if ( empty( $results['error'] ) ) {
				return $results['url'];
			}

			return false;
		}

		/**
		 * Output the local CSS to load the font(s).
		 */
		public function output_css() {
			echo wp_kses_post( $this->local_css );
		}

		/**
		 * Remove the Google URL.
		 */
		public function dequeue_style() {
			wp_dequeue_style( 'olympus-google-fonts' );
		}


	}

	/**
	 * Initialize Google Fonts Pro.
	 */
	function host_google_fonts_locally_init() {
		$hgfl = new Host_Google_Fonts_Locally();
	}
	add_action( 'plugins_loaded', 'host_google_fonts_locally_init' );

}
