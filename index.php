<?php

//#! This plugin doesn't need to run in frontend
if ( !vp_is_admin() ) {
    return;
}


/**
 * Stores the name of the plugin's directory
 * @var string
 */
define( 'CPDCG_PLUGIN_DIR_NAME', basename( dirname( __FILE__ ) ) );
/**
 * Stores the system path to the plugin's directory
 * @var string
 */
define( 'CPDCG_PLUGIN_DIR_PATH', trailingslashit( wp_normalize_path( dirname( __FILE__ ) ) ) );


require_once( CPDCG_PLUGIN_DIR_PATH . 'functions.php' );
require_once( CPDCG_PLUGIN_DIR_PATH . 'hooks.php' );
require_once( CPDCG_PLUGIN_DIR_PATH . 'routes/web.php' );
