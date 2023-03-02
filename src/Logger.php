<?php

namespace Plugin\Env;


use Plugin\Env\PluginInterface;

class Logger {

	private $plugin;

	public function __construct( PluginInterface $plugin ) {
		$this->plugin = $plugin;
	}

	public function error( $error, $data = null ) {
		\wc_get_logger()->critical(
			sprintf( 'Error: %s\n%s',
				$error,
				self::dumper( $data )
			),
			[
				'source' => $this->plugin->plugin_text_domain() . '-errors',
			]
		);
	}

	public function info( $data = null ) {
		\wc_get_logger()->info(
			self::dumper( $data ),
			[
				'source' => $this->plugin->plugin_text_domain() . '-info',
			]
		);
	}

	public function dumper( $data ) {
		ob_start();
		print_r( $data );
		$v = ob_get_contents();
		ob_end_clean();

		return $v;
	}
}