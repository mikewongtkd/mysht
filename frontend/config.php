<?php

if( ! file_exists( '/usr/local/mysht/config.json' )) {
	copy( '/usr/local/mysht/config-default.json', '/usr/local/mysht/config.json' );
}

$config = read_config();

# ============================================================
function read_config() {
# ============================================================
	$text = file_get_contents( '/usr/local/mysht/config.json' );
	$config = json_decode( $text, true );
	return $config;
}

# ============================================================
function config_host( $config ) {
# ============================================================
	$protocol = isset( $config[ 'protocol' ]) ? $config[ 'protocol' ] : 'http://';
	$host     = isset( $config[ 'host' ]) ? $config[ 'host' ] : 'localhost';
	$port     = isset( $config[ 'port' ]) ? $config[ 'port' ] : 80;
	$port     = $port == 80 ? '' : ":{$port}";

	return "$protocol$host$port";
}

?>
