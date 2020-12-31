<?php

require_once( dirname( __FILE__ ) . '/index.php' );

add_action( 'valpress/plugin/deleted', function ( $pluginDirName ) {
    // logger( 'Plugin '.$pluginDirName.' deleted!' );
}, 10 );
