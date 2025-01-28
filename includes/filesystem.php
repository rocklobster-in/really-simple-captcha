<?php

trait RSC_Filesystem {

	private $filesystem;

	public function connect() {
		global $wp_filesystem;

		if ( ! function_exists( 'WP_Filesystem' ) ) {
			require_once ABSPATH . '/wp-admin/includes/file.php';
		}

		ob_start();
		$credentials = request_filesystem_credentials( '' );
		ob_end_clean();

		if ( false === $credentials or ! WP_Filesystem( $credentials ) ) {
			wp_trigger_error( __FUNCTION__, __( 'Could not access filesystem.' ) );
			return;
		}

		$this->filesystem = $wp_filesystem;
	}

}
