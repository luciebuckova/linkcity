<?php

namespace App\View\Composers;

use Roots\Acorn\View\Composer;

class Post extends Composer
{
    /**
     * List of views served by this composer.
     *
     * @var array
     */
    protected static $views = [
        'partials.page-header',
    ];

    /**
     * Data to be passed to view before rendering.
     *
     * @return array
     */
    public function with(): array
    {
        return [
            'title' => $this->getTitle()
        ];
    }

    /**
     * Returns the post title.
     *
     * @return string
     */
    public function getTitle(): string
    {
        if ($this->view->name() !== 'partials.page-header') {
            return get_the_title();
        }

        if (is_home()) {
            if ($home = get_option('page_for_posts', true)) {
                return get_the_title($home);
            }

            return __('Poslední příspěvky', 'ttm');
        }

		if (is_post_type_archive(Project::SLUG)) {
	        $queriedObject = get_queried_object();
			return $queriedObject->description ?: ($queriedObject->label ?? get_the_archive_title());
		} else if (is_archive()) {
            return get_the_archive_title();
        }

        if (is_search()) {
            return sprintf(
            /* translators: %s is replaced with the search query */
                __('Výsledky pro %s', 'ttm'),
                get_search_query()
            );
        }

        if (is_404()) {
            return __('Stránka nebyla nenalezena', 'ttm');
        }

        return get_the_title();
    }

    public function getPhotoID(): ?int
    {
        if(is_single() && has_post_thumbnail()) {
            return get_post_thumbnail_id();
        }

        return null;
    }

    public function getExcerpt(): ?string
    {
        return is_singular('post') && has_excerpt() ? get_the_excerpt() : null;
    }
}