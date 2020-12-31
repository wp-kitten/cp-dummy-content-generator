<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

/*
 * Add custom routes or override existent ones
 */

/*
 * @GET: Show view
 */
Route::get( 'admin/dummy-content-generator', function () {
    if ( !vp_current_user_can( 'publish_posts' ) ) {
        return redirect()->back()->with( 'message', [
            'class' => 'danger',
            'text' => __( 'cpdcg::m.You are not allowed to access this page.' ),
        ] );
    }

    return view( 'dummy_content_generator' );
} )
    ->middleware( [ 'web', 'auth', 'active_user' ] )
    ->name( 'admin.dummy_content_generator' );

/*
 * @POST: Generate dummy content
 */
Route::post( 'admin/dummy-content-generator/generate', function () {
    $pages = request()->get( 'pages', 0 );
    $posts = request()->get( 'posts', 0 );
    $categories = request()->get( 'categories', 0 );
    $tags = request()->get( 'tags', 0 );

    if ( empty( $pages ) && empty( $posts ) && empty( $categories ) && empty( $tags ) ) {
        return redirect()->back()->with( 'message', [
            'class' => 'success',
            'text' => __( 'cpdcg::m.Nothing to generate' ),
        ] );
    }

    //#! Load seeder class
    $seederFilePath = path_combine( public_path( 'plugins' ), CPDCG_PLUGIN_DIR_NAME, 'seeders', 'DummyContentSeeder.php' );
    $GLOBALS['cpdcg_pages'] = $pages;
    $GLOBALS['cpdcg_posts'] = $posts;
    $GLOBALS['cpdcg_categories'] = $categories;
    $GLOBALS['cpdcg_tags'] = $tags;
    require_once( $seederFilePath );

    try {
        Artisan::call( 'db:seed', [
            '--class' => 'DummyContentSeeder',
        ] );
    }
    catch ( Exception $e ) {
        return redirect()->back()->with( 'message', [
            'class' => 'danger',
            'text' => __( 'cpdcg::m.An error occurred while executing the seeder class: ' . $e->getMessage() ),
        ] );
    }

    return redirect()->back()->with( 'message', [
        'class' => 'success',
        'text' => __( 'cpdcg::m.Content generator ran successfully!' ),
    ] );
} )
    ->middleware( [ 'web', 'auth', 'active_user' ] )
    ->name( 'admin.dummy_content_generator.generate' );

