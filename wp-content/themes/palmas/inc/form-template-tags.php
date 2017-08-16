<?php
/**
 * Template tags for form element to pick posts, taxonomies etc. using select, multiple select, radio button etc.
 * mostly used for administration purpose like metabox etc.
 * 
 *
 * @package wpkube
 * @since wpkube 1.0
 */

/**
 * Output a multiple select for post, page and custom post types.
 * Use arguments like WP_Query
 * Set class and other attribut (excluding name) for the element on the $attr parameter eg. $attr = 'id="wpkube-multiple-1" class="wpkube-multiple"' 
 *
 *
 * @since wpkube 1.0
 */
function wpkube_post_multiple_select( $id, $args = 'post_type=post&post_status=publish', $default, $attr = ''){
	$posts = get_posts($args);
	if ( is_array($posts) && count($posts)> 0 ){
	?>
		<select multiple="multiple" name="<?php echo $id; ?>[]" <?php echo $attr; ?> >
		<?php
		foreach ( $posts as $post ){
			if ( is_array($default) ){
				$selected = '';
				if ( array_search($post->ID, $default) !== false ) $selected = 'selected="selected"';
			}
			?>
			<option value="<?php echo $post->ID; ?>" <?php echo $selected; ?>><?php echo $post->post_title; ?></option>
			<?php
		}
		?>
		</select>
	<?php
	}
}

/**
 * Output a select for post, page and custom post types.
 * Use arguments like WP_Query
 * Set class and other attribut (excluding name) for the element on the $attr parameter eg. $attr = 'id="wpkube-multiple-1" class="wpkube-multiple"' 
 *
 *
 * @since wpkube 1.0
 */
function wpkube_post_select( $id, $args = 'post_type=post&post_status=publish', $default, $attr = ''){
	$posts = get_post($args);
	if ( is_array($posts) && count($posts)> 0 ){
	?>
		<select name="<?php echo $id; ?>" <?php echo $attr; ?> >
		<?php
		foreach ( $posts as $post ){
			?>
			<option value="<?php echo $post->ID; ?>" <?php selected($post->ID, $default, 1); ?>><?php echo $post->post_title; ?></option>
			<?php
		}
		?>
		</select>
	<?php
	}
}

/**
 * Output a select for terms such as category, tags or other custom taxonomy.
 * Use args as arguments like get_terms http://codex.wordpress.org/Function_Reference/get_terms
 * Set class and other attribut (excluding name) for the element on the $attr parameter eg. $attr = 'id="wpkube-multiple-1" class="wpkube-multiple"' 
 *
 *
 * @since wpkube 1.0
 */
function wpkube_term_select( $id, $taxonomy = 'category', $args = 'hide_empty=1', $default, $attr = ''){
	$terms = get_terms($taxonomy, $args);
	if ( is_array($terms) && count($terms)> 0 ){
	?>
		<select name="<?php echo $id; ?>" <?php echo $attr; ?> >
		<?php
		foreach ( $terms as $term ){
			?>
			<option value="<?php echo $term->term_id; ?>" <?php selected($term->term_id, $default, 1); ?>><?php echo $term->name; ?></option>
			<?php
		}
		?>
		</select>
	<?php
	}
}

/**
 * Output a multiple select for terms such as category, tags or other custom taxonomy.
 * Use args as arguments like get_terms http://codex.wordpress.org/Function_Reference/get_terms
 * Set class and other attribut (excluding name) for the element on the $attr parameter eg. $attr = 'id="wpkube-multiple-1" class="wpkube-multiple"' 
 *
 *
 * @since wpkube 1.0
 */
function wpkube_term_multiple_select( $id, $taxonomy='category', $args = 'hide_empty=1', $default, $attr = ''){
	$terms = get_terms($taxonomy, $args);
	if ( is_array($terms) && count($terms)> 0 ){
	?>
		<select multiple="multiple" name="<?php echo $id; ?>[]" <?php echo $attr; ?> >
		<?php
		foreach ( $terms as $term ){
			if ( is_array($default) ){
				$selected = '';
				if ( array_search($term->term_id, $default) !== false ) $selected = 'selected="selected"';
			}
			?>
			<option value="<?php echo $term->term_id; ?>" <?php echo $selected; ?>><?php echo $term->name; ?></option>
			<?php
		}
		?>
		</select>
	<?php
	}
}
?>