<?php
/**
 * PHP file to use when rendering the block type on the server to show on the front end.
 *
 * The following variables are exposed to the file:
 *     $attributes (array): The block attributes.
 *     $content (string): The block default content.
 *     $block (WP_Block): The block instance.
 *
 * @see https://github.com/WordPress/gutenberg/blob/trunk/docs/reference-guides/block-api/block-metadata.md#render
 */


$button_text = esc_html__( 'Bentornato, continua a leggere', 'give-me-back-php' );

if ( is_user_logged_in() ){
	$button_text = sprintf( esc_html__( 'Bentornato %s, continua a leggere' ), wp_get_current_user()->display_name );
}

$wrapper_attributes = get_block_wrapper_attributes( array(
	'data-wp-interactive' => 'myPlugin',
	'data-wp-context' => '{ "isOpen": false }'
) );

$processor = new WP_HTML_Tag_Processor(
	do_blocks( '<!-- wp:give-me-back-php/random-emoji /-->' )
 );
if ( $processor->next_tag() ) {
 	$processor->set_attribute( 'data-wp-bind--aria-expanded', 'context.isOpen' );
	$processor->set_attribute( 'data-wp-on--click', 'actions.toggle' );
}
$random_emoji = $processor->get_updated_html();


$content = <<<HTML
	<div $wrapper_attributes>
		<!-- wp:buttons -->
			<div class="wp-block-buttons"><!-- wp:button -->
				<div class="wp-block-button">
					<a class="wp-block-button__link wp-element-button">
					$button_text
					$random_emoji
					</a>
				</div>
			<!-- /wp:button --></div>
		<!-- /wp:buttons -->

		<p id="p-1" hidden data-wp-bind--hidden="!context.isOpen">
			<!-- wp:jetpack/sharing-button {"service":"linkedin","label":"LinkedIn"} /-->
		</p>

	</div>
HTML;
echo do_blocks( $content );

?>

