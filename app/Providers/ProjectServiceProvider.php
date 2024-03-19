<?php

namespace App\Providers;

use App\View\Composers\Project;
use Illuminate\Support\ServiceProvider;
use WP_Query;

class ProjectServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
	    if (!is_admin()) {
		    /**
		     * Front-end query filters
		     */
		    add_action( 'pre_get_posts', [ $this, 'processSearchQuery' ] );
	    }

	    /**
	     * Project taxonomy archive rewrite rules
	     */
	    add_action('init', [$this, 'setupProjectGroupsRewriteRules'], 999);
    }

	public function processSearchQuery( WP_Query $query ): WP_Query
	{
		if ( !$query->is_archive || empty( $query->query['post_type'] )
		     || ! in_array( Project::SLUG, (array) $query->query['post_type'], true )
		) {
			return $query;
		}

		$query->set('posts_per_page', $query->query['posts_per_page'] ?? -1);
		$query->set('fields', 'ids');

		return $query;
	}

	public function setupProjectGroupsRewriteRules(): void
	{
		foreach (get_terms(['taxonomy' => 'group', 'hide_empty' => false]) as $term) {
			add_rewrite_rule(
				'^projekty/(' . $term->slug . ')[/]?$',
				'index.php?post_type=project&group=$matches[1]',
				'top'
			);
		}
	}
}
