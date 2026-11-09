<?php
/**
 * Plugin Name:       LU3G Repeater Carousel
 * Plugin URI:        https://lu3g.it
 * Description:       Widget Elementor che trasforma un repeater JetEngine in un carosello a scroll orizzontale con snap, freccia di navigazione e animazione d'ingresso.
 * Version:           1.35.4
 * Update URI:        https://github.com/lu3gofficial/lu3g-repeater-carousel
 * Author:            LU3G Agenzia Web
 * Author URI:        https://lu3g.it
 * Text Domain:       lu3g-carousel
 * Domain Path:       /languages
 * Requires at least: 6.0
 * Requires PHP:      7.4
 * Requires Plugins:  elementor, jet-engine
 *
 * @package LU3G_Repeater_Carousel
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'LU3G_CAROUSEL_VERSION', '1.35.4' );
define( 'LU3G_CAROUSEL_PATH', plugin_dir_path( __FILE__ ) );
define( 'LU3G_CAROUSEL_URL', plugin_dir_url( __FILE__ ) );

/**
 * Aggiornamenti automatici dalle release GitHub di https://github.com/lu3gofficial/lu3g-repeater-carousel
 * (vedi includes/class-updater.php, generato da lu3g-updater come per gli altri plugin LU3G).
 *
 * Sta fuori dalla classe e prima dei controlli sulle dipendenze: il plugin
 * deve potersi aggiornare anche su un sito dove Elementor è disattivato.
 */
require_once __DIR__ . '/includes/class-updater.php';
LU3G_Repeater_Carousel_Updater::init( __FILE__ );

/**
 * Pulizia dopo il passaggio da Plugin Update Checker (fino alla 1.35.3) all'updater comune:
 * toglie il controllo pianificato e i dati salvati dalla vecchia libreria, che non servono più.
 * Gira una volta sola in bacheca.
 */
add_action(
	'admin_init',
	function () {
		if ( get_site_option( 'lu3g_carousel_puc_cleaned' ) ) {
			return;
		}
		wp_clear_scheduled_hook( 'puc_cron_check_updates-lu3g-repeater-carousel' );
		delete_site_option( 'external_updates-lu3g-repeater-carousel' );
		update_site_option( 'lu3g_carousel_puc_cleaned', 1 );
	}
);

/**
 * Bootstrap del plugin.
 *
 * Verifica le dipendenze e registra widget e asset. Se Elementor o JetEngine
 * non sono attivi mostra un avviso in bacheca e non fa altro.
 */
final class LU3G_Repeater_Carousel {

	/**
	 * Versione minima di Elementor supportata.
	 */
	const MIN_ELEMENTOR_VERSION = '3.5.0';

	/**
	 * Versione minima di PHP supportata.
	 */
	const MIN_PHP_VERSION = '7.4';

	/**
	 * Meta dell'allegato con il link della foto in modalità galleria.
	 */
	const GALLERY_LINK_META = '_lu3g_carousel_link';

	/**
	 * Istanza singola.
	 *
	 * @var LU3G_Repeater_Carousel|null
	 */
	private static $instance = null;

	/**
	 * Restituisce l'istanza del plugin.
	 *
	 * @return LU3G_Repeater_Carousel
	 */
	public static function instance() {
		if ( null === self::$instance ) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	/**
	 * Costruttore: aggancia l'init dopo il caricamento dei plugin.
	 */
	private function __construct() {
		add_action( 'plugins_loaded', array( $this, 'init' ) );
	}

	/**
	 * Campo "Link nel carosello" nei dettagli delle immagini.
	 *
	 * @param array   $fields Campi dell'allegato.
	 * @param WP_Post $post   Allegato.
	 * @return array
	 */
	public function gallery_link_field( $fields, $post ) {
		if ( ! wp_attachment_is_image( $post->ID ) ) {
			return $fields;
		}

		$fields['lu3g_carousel_link'] = array(
			'label' => __( 'Link nel carosello', 'lu3g-carousel' ),
			'input' => 'text',
			'value' => (string) get_post_meta( $post->ID, self::GALLERY_LINK_META, true ),
			'helps' => __( 'LU3G Repeater Carousel: pagina che si apre cliccando questa foto, con "Al click: Link della singola immagine".', 'lu3g-carousel' ),
		);

		return $fields;
	}

	/**
	 * Salva il link della foto; vuoto lo rimuove.
	 *
	 * @param array $post       Dati dell'allegato.
	 * @param array $attachment Campi inviati.
	 * @return array
	 */
	public function gallery_link_save( $post, $attachment ) {
		if ( isset( $attachment['lu3g_carousel_link'] ) ) {
			$url = esc_url_raw( trim( (string) $attachment['lu3g_carousel_link'] ) );

			if ( '' === $url ) {
				delete_post_meta( $post['ID'], self::GALLERY_LINK_META );
			} else {
				update_post_meta( $post['ID'], self::GALLERY_LINK_META, $url );
			}
		}

		return $post;
	}

	/**
	 * Init: controlla le dipendenze e registra gli hook.
	 *
	 * @return void
	 */
	public function init() {

		if ( ! did_action( 'elementor/loaded' ) ) {
			add_action( 'admin_notices', array( $this, 'notice_missing_elementor' ) );
			return;
		}

		if ( ! version_compare( ELEMENTOR_VERSION, self::MIN_ELEMENTOR_VERSION, '>=' ) ) {
			add_action( 'admin_notices', array( $this, 'notice_elementor_version' ) );
			return;
		}

		if ( ! version_compare( PHP_VERSION, self::MIN_PHP_VERSION, '>=' ) ) {
			add_action( 'admin_notices', array( $this, 'notice_php_version' ) );
			return;
		}

		if ( ! function_exists( 'jet_engine' ) ) {
			add_action( 'admin_notices', array( $this, 'notice_missing_jetengine' ) );
			return;
		}

		// Link della singola foto: campo nei dettagli dell'immagine (libreria Media, anche dentro Elementor).
		add_filter( 'attachment_fields_to_edit', array( $this, 'gallery_link_field' ), 10, 2 );
		add_filter( 'attachment_fields_to_save', array( $this, 'gallery_link_save' ), 10, 2 );

		add_action( 'elementor/widgets/register', array( $this, 'register_widgets' ) );
		add_action( 'elementor/elements/categories_registered', array( $this, 'register_category' ) );

		// Gli asset vengono registrati, non accodati: il widget li dichiara
		// in get_style_depends() / get_script_depends() e Elementor li carica
		// solo nelle pagine dove il widget è effettivamente presente.
		add_action( 'elementor/frontend/after_register_styles', array( $this, 'register_styles' ) );
		add_action( 'elementor/frontend/after_register_scripts', array( $this, 'register_scripts' ) );
	}

	/**
	 * Registra il widget.
	 *
	 * @param \Elementor\Widgets_Manager $widgets_manager Manager dei widget.
	 * @return void
	 */
	public function register_widgets( $widgets_manager ) {
		require_once LU3G_CAROUSEL_PATH . 'includes/class-auto-icons.php';
		require_once LU3G_CAROUSEL_PATH . 'includes/class-widget-repeater-carousel.php';
		$widgets_manager->register( new \LU3G\Widgets\Repeater_Carousel() );
	}

	/**
	 * Registra una categoria dedicata nel pannello di Elementor.
	 *
	 * @param \Elementor\Elements_Manager $elements_manager Manager degli elementi.
	 * @return void
	 */
	public function register_category( $elements_manager ) {
		$elements_manager->add_category(
			'lu3g',
			array(
				'title' => __( 'LU3G', 'lu3g-carousel' ),
				'icon'  => 'fa fa-plug',
			)
		);
	}

	/**
	 * Registra il foglio di stile.
	 *
	 * @return void
	 */
	public function register_styles() {
		wp_register_style(
			'lu3g-carousel',
			LU3G_CAROUSEL_URL . 'assets/carousel.css',
			array(),
			LU3G_CAROUSEL_VERSION
		);
	}

	/**
	 * Registra lo script.
	 *
	 * @return void
	 */
	public function register_scripts() {
		wp_register_script(
			'lu3g-carousel',
			LU3G_CAROUSEL_URL . 'assets/carousel.js',
			array(),
			LU3G_CAROUSEL_VERSION,
			true
		);
	}

	/**
	 * Avviso: Elementor non attivo.
	 *
	 * @return void
	 */
	public function notice_missing_elementor() {
		$this->render_notice(
			sprintf(
				/* translators: %s: nome del plugin richiesto */
				__( 'LU3G Repeater Carousel richiede %s per funzionare.', 'lu3g-carousel' ),
				'<strong>Elementor</strong>'
			)
		);
	}

	/**
	 * Avviso: versione di Elementor troppo vecchia.
	 *
	 * @return void
	 */
	public function notice_elementor_version() {
		$this->render_notice(
			sprintf(
				/* translators: %s: versione minima richiesta */
				__( 'LU3G Repeater Carousel richiede Elementor %s o superiore.', 'lu3g-carousel' ),
				'<strong>' . self::MIN_ELEMENTOR_VERSION . '</strong>'
			)
		);
	}

	/**
	 * Avviso: versione di PHP troppo vecchia.
	 *
	 * @return void
	 */
	public function notice_php_version() {
		$this->render_notice(
			sprintf(
				/* translators: %s: versione minima richiesta */
				__( 'LU3G Repeater Carousel richiede PHP %s o superiore.', 'lu3g-carousel' ),
				'<strong>' . self::MIN_PHP_VERSION . '</strong>'
			)
		);
	}

	/**
	 * Avviso: JetEngine non attivo.
	 *
	 * @return void
	 */
	public function notice_missing_jetengine() {
		$this->render_notice(
			sprintf(
				/* translators: %s: nome del plugin richiesto */
				__( 'LU3G Repeater Carousel richiede %s per leggere i campi repeater.', 'lu3g-carousel' ),
				'<strong>JetEngine</strong>'
			)
		);
	}

	/**
	 * Stampa un avviso in bacheca.
	 *
	 * @param string $message Messaggio già tradotto, può contenere tag base.
	 * @return void
	 */
	private function render_notice( $message ) {
		if ( ! current_user_can( 'activate_plugins' ) ) {
			return;
		}
		printf(
			'<div class="notice notice-warning is-dismissible"><p>%s</p></div>',
			wp_kses( $message, array( 'strong' => array() ) )
		);
	}
}

LU3G_Repeater_Carousel::instance();
