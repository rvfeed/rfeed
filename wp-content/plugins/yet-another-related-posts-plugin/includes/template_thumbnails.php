<?php
/*
 * YARPP's built-in thumbnails template
 * @since 4
 *
 * This template is used when you choose the built-in thumbnails option.
 * If you want to create a new template, look at yarpp-templates/yarpp-template-example.php as an example.
 * More information on the custom templates is available at http://mitcho.com/blog/projects/yarpp-3-templates/
 */

if ( !$this->diagnostic_using_thumbnails() )
	$this->set_option( 'manually_using_thumbnails', true );

$options = array( 'thumbnails_heading', 'thumbnails_default', 'no_results' );
extract( $this->parse_args( $args, $options ) );

// a little easter egg: if the default image URL is left blank,
// default to the theme's header image. (hopefully it has one)
if ( empty($thumbnails_default) )
	$thumbnails_default = get_header_image();

$dimensions = $this->thumbnail_dimensions();



if (have_posts()) {
	$output .= '<div class="ccr-gallery-ttile">
                <span></span> <p>  <strong>' . $thumbnails_heading . '</strong></p></div>' . "\n";
	$output .= '<div class="yarpp-thumbnails-horizontal">' . "\n";
	while (have_posts()) {
		the_post();

		$output .= "<a class='yarpp-thumbnail' href='" . get_permalink() . "' title='" . the_title_attribute('echo=0') . "'>" . "\n";
        $dimensions['size'] = 'medium';
		$post_thumbnail_html = '';
		if ( has_post_thumbnail() ) {
			if ( $this->diagnostic_generate_thumbnails() )
				$this->ensure_resized_post_thumbnail( get_the_ID(), $dimensions );
			$post_thumbnail_html = get_the_post_thumbnail( null, 'medium' );
		}
		
		if ( trim($post_thumbnail_html) != '' )
			$output .= $post_thumbnail_html;
		else
			$output .= '<span class="yarpp-thumbnail-default"><img src="' . esc_url($thumbnails_default) . '"/></span>';

		$output .= '<span class="yarpp-thumbnail-title">' . get_the_title() . '</span>';
		$output .= '</a>' . "\n";

	}
	$output .= "</div>\n";
}
$this->enqueue_thumbnails( $dimensions );
