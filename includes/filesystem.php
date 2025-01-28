<?php

trait RSC_Filesystem {

	private $filesystem;

	public function connect() {
		global $wp_filesystem;

		require_once ABSPATH . 'wp-admin/includes/file.php';
		require_once ABSPATH . 'wp-admin/includes/class-wp-filesystem-base.php';
		require_once ABSPATH . 'wp-admin/includes/class-wp-filesystem-direct.php';

		ob_start();
		$credentials = request_filesystem_credentials( '' );
		ob_end_clean();

		if ( false === $credentials or ! WP_Filesystem( $credentials ) ) {
			wp_trigger_error( __FUNCTION__, __( 'Could not access filesystem.' ) );

			$this->filesystem = new WP_Filesystem_Direct( array() );
		} else {
			$this->filesystem = $wp_filesystem;
		}
	}

	public function put_contents( $file, $contents, $mode ) {
		return $this->filesystem->put_contents( $file, $contents, $mode );
	}

}
