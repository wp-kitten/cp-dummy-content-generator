<?php

require_once( dirname( __FILE__ ) . '/index.php' );

add_action( 'contentpress/plugin/deleted', function ( $pluginDirName ) {
    // logger( 'Plugin '.$pluginDirName.' deleted!' );
}, 10 );
