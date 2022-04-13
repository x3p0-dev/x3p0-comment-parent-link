<?php
/**
 * Block class.
 *
 * Registers and renders the block type on the front end.
 *
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright Copyright (c) 2022, Justin Tadlock
 * @link      https://github.com/x3p0-dev/x3p0-comment-parent-link
 * @license   http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

namespace X3P0\CommentParentLink;

use WP_Block;

class Block
{
        /**
         * Sets up object state.
         *
         * @since 1.0.0
         */
        public function __construct( protected string $path ) {}

        /**
         * Boots the component, running its actions/filters.
         *
         * @since 1.0.0
         */
        public function boot(): void
        {
                add_action( 'init', [ $this, 'register' ] );
        }

	/**
	 * Registers the block with WordPress.
	 *
	 * @since 1.0.0
	 */
        public function register(): void
        {
                register_block_type( $this->path . '/public', [
                        'render_callback' => [ $this, 'render' ]
                ] );
        }

	/**
	 * Renders the block on the front end.
	 *
	 * @since 1.0.0
	 */
        public function render( array $attr, string $content, WP_Block $block ): string
        {
		// Gets the comment ID from the Comment Template ancestor block.
                $comment_id = absint( $block->context['commentId'] );

        	$attr = wp_parse_args( $attr, [
        		'text'      => __( 'In reply to %s', 'x3p0-comment-parent-link' ),
        		'depth'     => 2,
                        'before'    => '',
                        'after'     => '',
                        'textAlign' => ''
        	] );

        	$html   = '';
                $depth  = 1;
                $parent = absint( get_comment( $comment_id )->comment_parent );

		// Loop through the hierarchy of parent blocks. As soon as we
		// hit a parent at the minimum depth set by the user, grab the
		// parent's link and break from the loop.
                while ( 0 < $parent ) {
                        ++$depth;

                        if ( $depth === absint( $attr['depth'] ) ) {
                                $url  = get_comment_link( $parent );
                                $text = sprintf( $attr['text'], get_comment_author( $parent ) );

                                $html = sprintf(
                                        '%s<a class="wp-block-x3p0-comment-parent-link__anchor" href="%s">%s</a>%s',
                                        esc_html( $attr['before'] ),
                                        esc_url( $url ),
                                        esc_html( $text ),
                                        esc_html( $attr['after'] )
                                );

				// No need to continue up the chain of ancestors.
                                break;
                        }

			// Get the current comment's parent.
                        $parent = absint( get_comment( $parent )->comment_parent );
                }

		// If no HTML at this point, bail out. We don't have a link to show.
                if ( ! $html ) {
                        return '';
                }

		// Get text alignment class.
                $align = empty( $attr['textAlign'] )
                         ? ''
                         : "has-text-align-{$attr['textAlign']}";

		// Return the formatted block output.
                return sprintf(
                        '<div %s>%s</div>',
                        get_block_wrapper_attributes( [
                                'class' => esc_attr( $align )
                        ] ),
                        $html
                );
        }
}
