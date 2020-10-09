<?php

namespace Database\Seeders;

use App\Helpers\CPML;
use App\Helpers\MetaFields;
use App\Models\Category;
use App\Models\CategoryMeta;
use App\Models\Post;
use App\Models\PostMeta;
use App\Models\PostStatus;
use App\Models\PostType;
use App\Models\Tag;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DummyContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $postTypeID = PostType::where( 'name', 'post' )->first()->id;
        $postTypePageID = PostType::where( 'name', 'page' )->first()->id;
        $postStatusID = PostStatus::where( 'name', 'publish' )->first()->id;
        $languageID = CPML::getDefaultLanguageID();
        $currentUserID = cp_get_current_user()->getAuthIdentifier();

        $numPages = ( ( isset( $GLOBALS[ 'cpdcg_pages' ] ) && !empty( $GLOBALS[ 'cpdcg_pages' ] ) ) ? intval( $GLOBALS[ 'cpdcg_pages' ] ) : 0 );
        $numPosts = ( ( isset( $GLOBALS[ 'cpdcg_posts' ] ) && !empty( $GLOBALS[ 'cpdcg_posts' ] ) ) ? intval( $GLOBALS[ 'cpdcg_posts' ] ) : 0 );
        $numCategories = ( ( isset( $GLOBALS[ 'cpdcg_categories' ] ) && !empty( $GLOBALS[ 'cpdcg_categories' ] ) ) ? intval( $GLOBALS[ 'cpdcg_categories' ] ) : 0 );
        $numTags = ( ( isset( $GLOBALS[ 'cpdcg_tags' ] ) && !empty( $GLOBALS[ 'cpdcg_tags' ] ) ) ? intval( $GLOBALS[ 'cpdcg_tags' ] ) : 0 );

        $categoriesIds = [];
        $tagsIds = [];

        //#! Categories
        if ( !empty( $numCategories ) ) {
            for ( $i = 0; $i < $numCategories; $i++ ) {
                $categoryName = Str::title( __( 'cpdcg::m.Category :number', [ 'number' => $i ] ) );
                $slug = Str::slug( $categoryName . '-' . time() );
                $category = Category::create( [ 'name' => Str::title( $categoryName ), 'slug' => Str::slug( $slug ), 'language_id' => $languageID, 'post_type_id' => $postTypeID, ] );
                if ( $category && $category->id ) {
                    //#! Add meta fields
                    CategoryMeta::create( [
                        'meta_name' => '_category_image',
                        'meta_value' => '',
                        'category_id' => $category->id,
                        'language_id' => $category->language_id,
                    ] );
                    array_push( $categoriesIds, $category->id );
                }
            }
        }

        //#! Tags
        if ( !empty( $numTags ) ) {
            for ( $i = 0; $i < $numTags; $i++ ) {
                $tagName = Str::title( __( 'cpdcg::m.Tag :number', [ 'number' => $i ] ) );
                $slug = Str::slug( $tagName . '-' . time() );
                $tag = Tag::create( [ 'name' => Str::title( $tagName ), 'slug' => Str::slug( $slug ), 'language_id' => $languageID, 'post_type_id' => $postTypeID, ] );
                if ( $tag ) {
                    array_push( $tagsIds, $tag->id );
                }
            }
        }

        //#! Pages
        if ( !empty( $numPages ) ) {
            for ( $i = 0; $i < $numPages; $i++ ) {
                $title = Str::title( __( 'cpdcg::m.Page :number', [ 'number' => $i ] ) );
                $slug = Str::slug( $title . '-' . time() );
                Post::create( [
                    'title' => $title,
                    'slug' => Str::slug( $slug ),
                    'content' => '<h2>What is Lorem Ipsum?</h2>
<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
<h2>Where does it come from?</h2>
<p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of "de Finibus Bonorum et Malorum" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32.</p>',
                    'user_id' => $currentUserID,
                    'language_id' => $languageID,
                    'post_type_id' => $postTypePageID,
                    'post_status_id' => $postStatusID,
                ] );
            }
        }

        //#! Posts
        if ( !empty( $numPosts ) ) {
            for ( $i = 0; $i < $numPosts; $i++ ) {
                $title = Str::title( __( 'cpdcg::m.Post :number', [ 'number' => $i ] ) );
                $slug = Str::slug( $title . '-' . time() );
                $post = Post::create( [
                    'title' => Str::title( $title ),
                    'slug' => Str::slug( $slug ),
                    'content' => '<h2>What is Lorem Ipsum?</h2>
<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
<h2>Where does it come from?</h2>
<p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of "de Finibus Bonorum et Malorum" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32.</p>',
                    'excerpt' => 'Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old.',
                    'user_id' => $currentUserID,
                    'language_id' => $languageID,
                    'post_type_id' => $postTypeID,
                    'post_status_id' => $postStatusID,
                ] );
                if ( $post ) {
                    //#! Update post meta
                    if ( cp_current_user_can( 'manage_custom_fields' ) ) {
                        MetaFields::add( new PostMeta(), 'post_id', $post->id, '_comments_enabled', true, $languageID );
                    }

                    //#! Set category & tags
                    if ( cp_current_user_can( 'manage_taxonomies' ) ) {
                        if ( !empty( $categoriesIds ) ) {
                            $post->categories()->detach();
                            $post->categories()->attach( $categoriesIds[ array_rand( $categoriesIds, 1 ) ] );
                        }

                        if ( !empty( $tagsIds ) ) {
                            $post->tags()->detach();
                            $tags = array_rand( $tagsIds, ceil( count( $tagsIds ) / 3 ) );
                            $t = [];
                            foreach ( $tags as $ix => $index ) {
                                array_push( $t, $tagsIds[ $index ] );
                            }
                            $post->tags()->attach( $t );
                        }
                    }
                }
            }
        }
    }
}
