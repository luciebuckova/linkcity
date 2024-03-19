<?php

namespace App\Providers;

use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\ServiceProvider;

class PostTypesServiceProvider extends ServiceProvider
{
    private function getPostTypeLabels(array $names, array $labels): array
    {
        $singular = $names['singular'];
        $singularLower = $singular;
        if ( ! preg_match( '/[A-Z]{2,}/', $singular ) ) {
            $singularLower = strtolower( $singular );
        }

        $plural = $names['plural'];
        $pluralLower = $plural;
        if ( ! preg_match( '/[A-Z]{2,}/', $plural ) ) {
            $pluralLower = strtolower( $plural );
        }

        return array_merge([
            'add_new'                  => 'Přidat nový',
            'add_new_item'             => sprintf( 'Přidat nový %s', $singularLower ),
            'edit_item'                => sprintf( 'Upravit %s', $singularLower ),
            'new_item'                 => sprintf( 'Nový %s', $singularLower ),
            'view_item'                => sprintf( 'Zobrazit %s', $singularLower ),
            'view_items'               => sprintf( 'Zobrazit %s', $pluralLower ),
            'search_items'             => sprintf( 'Vyhledat %s', $pluralLower ),
            'not_found'                => sprintf( 'Žádný %s nenalezen.', $pluralLower ),
            'not_found_in_trash'       => sprintf( 'Žádný %s nenalezen v koši.', $pluralLower ),
            'parent_item_colon'        => sprintf( 'Nadřazený %s:', $singularLower ),
            'all_items'                => sprintf( 'Přehled %s', $pluralLower ),
            'archives'                 => sprintf( 'Archív %s', $pluralLower ),
            'attributes'               => sprintf( 'Parametry %s', $singularLower ),
            'insert_into_item'         => sprintf( 'Vložit k %s', $singularLower ),
            'uploaded_to_this_item'    => sprintf( 'Nahráno k tomuto %s', $singularLower ),
            'filter_items_list'        => sprintf( 'Filtrovat seznam %s', $pluralLower ),
            'filter_by_date'           => 'Filtrovat podle data',
            'items_list_navigation'    => sprintf( 'Navigace seznamu %s', $pluralLower ),
            'items_list'               => sprintf( 'Seznam %s', $pluralLower ),
            'item_published'           => sprintf( '%s publikován.', $singular ),
            'item_published_privately' => sprintf( '%s publikován jako soukromý.', $singular ),
            'item_reverted_to_draft'   => sprintf( '%s vrácen zpět na koncept.', $singular ),
            'item_trashed'             => sprintf( '%s přesunut do koše.', $singular ),
            'item_scheduled'           => sprintf( '%s naplánován.', $singular ),
            'item_updated'             => sprintf( '%s aktualizován.', $singular ),
            'item_link'                => sprintf( 'Odkaz %s', $singularLower ),
            'item_link_description'    => sprintf( 'Odkaz na %s.', $singularLower )
        ], $labels);
    }

    /**
     * Register post types services.
     *
     * @return void
     */
    public function register()
    {
        /**
         * Register the post types assets.
         *
         * @return void
         */
        add_action('init', function (): void {
            Collection::make(config('post-types.post_types'))
                ->each(function ($args, $post_type) {
                    $names = Arr::pull($args, 'names');
                    $labels = $this->getPostTypeLabels($names, Arr::pull($args, 'labels') ?? []);

                    register_extended_post_type(
                        $post_type,
                        array_merge($args, ['labels' => $labels]),
                        $names
                    );
                });
        }, 100);

        /**
         * Register the statuses.
         *
         * @return void
         */
        add_action('init', function (): void {
            Collection::make(config('post-types.post_statuses'))
                ->each(function ($args, $status) {
                    register_post_status( $status, $args );
                });
        }, 100);

        /**
         * Register the taxonomies.
         *
         * @return void
         */
        add_action('init', function (): void {
            Collection::make(config('post-types.taxonomies'))
                ->each(function ($args, $taxonomy) {
                    register_extended_taxonomy(
                        $taxonomy,
                        Arr::pull($args, 'post_types'),
                        $args,
                        Arr::pull($args, 'names')
                    );
                });
        }, 100);
    }
}
