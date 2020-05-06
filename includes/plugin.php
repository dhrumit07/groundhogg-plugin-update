<?php

namespace GroundhoggBetaUpdates;

use Groundhogg\Admin\Admin_Menu;
use Groundhogg\DB\Manager;
use Groundhogg\Extension;
use function Groundhogg\is_option_enabled;

class Plugin extends Extension {


	/**
	 * Override the parent instance.
	 *
	 * @var Plugin
	 */
	public static $instance;

	/**
	 * Include any files.
	 *
	 * @return void
	 */
	public function includes() {
//        require  GROUNDHOGG_BETA_UPDATES_PATH . '/includes/functions.php';
	}

	/**
	 * Init any components that need to be added.
	 *
	 * @return void
	 */
	public function init_components() {
		$this->installer = new Installer();

		if ( is_option_enabled( 'gh_get_beta_versions_updates' ) ) {

			$this->updater = new Update_Groundhogg();
		}
	}

	public function register_settings( $settings ) {

		$settings['gh_get_beta_versions_updates'] = array(
			'id'      => 'gh_get_beta_versions_updates',
			'section' => 'misc_info',
			'label'   => _x( 'Get updates for pre-release versions of Gorundhogg core', 'settings', 'groundhogg-update' ),
			'desc'    => _x( 'This will enable automatic updates for beta versions of the Groundhogg core plugin.', 'settings', 'groundhogg-update' ),
			'type'    => 'checkbox',
			'atts'    => array(
				'label' => __( 'Enable' ),
				//keep brackets for backwards compat
				'name'  => 'gh_get_beta_versions_updates',
				'id'    => 'gh_get_beta_versions_updates',
				'value' => 'on',
			),
		);

		return $settings;
	}

	/**
	 * Get the ID number for the download in EDD Store
	 *
	 * @return int
	 */
	public function get_download_id() {
		return 48348;
	}

	/**
	 * Get the version #
	 *
	 * @return mixed
	 */
	public function get_version() {
		return GROUNDHOGG_BETA_UPDATES_VERSION;
	}

	/**
	 * @return string
	 */
	public function get_plugin_file() {
		return GROUNDHOGG_BETA_UPDATES__FILE__;
	}

	/**
	 * Register autoloader.
	 *
	 * Groundhogg autoloader loads all the classes needed to run the plugin.
	 *
	 * @since 1.6.0
	 * @access private
	 */
	protected function register_autoloader() {
		require GROUNDHOGG_BETA_UPDATES_PATH . 'includes/autoloader.php';
		Autoloader::run();
	}
}

Plugin::instance();