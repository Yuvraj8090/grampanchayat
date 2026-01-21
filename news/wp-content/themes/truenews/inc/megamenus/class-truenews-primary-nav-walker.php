<?php
/**
 * Custom wp_nav_menu walker for primary menu.
 *
 * @package    TrueNews
 * @author     Theme Junkie
 * @copyright  Copyright (c) 2014, Theme Junkie
 * @license    http://www.gnu.org/licenses/gpl-2.0.html
 * @since      1.0.0
 */
class TrueNews_Custom_Nav_Walker extends Walker_Nav_Menu {

	public $megamenu          = false;
	public $category_megamenu = false;
	public $mega_columns      = 'cols-4';
	public $current_item;

	/**
	 * Starts the list before the elements are added.
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param int    $depth  Depth of menu item. Used for padding.
	 * @param array  $args   An array of arguments. @see wp_nav_menu()
	 */
	function start_lvl( &$output, $depth = 0, $args = array() ) {
		$indent = str_repeat("\t", $depth);
			
		if ( $this->megamenu && $depth == 0 ) {
			$output .= "\n$indent<div class=\"sf-mega $this->mega_columns\">\n";
		} elseif ( $depth == 1 ) {
			$output .= "\n$indent<ul>\n";
		} else {
			$output .= "\n$indent<ul class=\"sub-menu\">\n";
		}

		if ( $this->megamenu && $this->category_megamenu && $depth = 1 ) {
			$output .= "\n$indent<div class=\"sf-mega-section\">\n<ul>\n";
		}

	}

	/**
	 * Ends the list of after the elements are added.
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param int    $depth  Depth of menu item. Used for padding.
	 * @param array  $args   An array of arguments. @see wp_nav_menu()
	 */
	function end_lvl( &$output, $depth = 0, $args = array() ) {
		$indent = str_repeat("\t", $depth);

		if ( $this->megamenu && $depth == 0 ) {
			if ( $this->category_megamenu ) {
				$output .= "\n$indent</ul>\n</div>\n";
				$output .= apply_filters( 'truenews_mega_menu_end_lvl', array( 'item' => $this->current_item ) );
			}
			$output .= "\n$indent</div>\n";
		} elseif ( $depth == 1 ) {
			$output .= "\n$indent</ul>\n";
		} else {
			$output .= "\n$indent</ul>\n";
		}

	}

	/**
	 * Modified the menu output.
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param object $item   Menu item data object.
	 * @param int    $depth  Depth of menu item. Used for padding.
	 * @param array  $args   An array of arguments. @see wp_nav_menu()
	 * @param int    $id     Current item ID.
	 */
	function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

		// Set up empty variable.
		$class_names = $icon = '';

		$classes = empty( $item->classes ) ? array() : (array) $item->classes;
		$classes[] = 'menu-item-' . $item->ID;
		
		/**
		 * Filter the CSS class(es) applied to a menu item's <li>.
		 *
		 * @param array  $classes The CSS classes that are applied to the menu item's <li>.
		 * @param object $item    The current menu item.
		 * @param array  $args    An array of wp_nav_menu() arguments.
		 */
		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
		$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

		/**
		 * Filter the ID applied to a menu item's <li>.
		 *
		 * @param string $menu_id The ID that is applied to the menu item's <li>.
		 * @param object $item    The current menu item.
		 * @param array  $args    An array of wp_nav_menu() arguments.
		 */
		$id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
		$id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

		// <li> output.
		$output .= $indent . '<li ' . $id . $class_names .'>';

		// link attributes
		$attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
		$attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
		$attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
		$attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';

		// Add icon if has children.
		if ( $args->has_children && $depth == 0 ) {
			$icon = '<i class="fa fa-caret-down"></i>';
		}

		// Menu output.
		$item_output = sprintf( '%1$s<a%2$s>%3$s%4$s%5$s%6$s</a>%7$s',
			$args->before,
			$attributes,
			$args->link_before,
			apply_filters( 'the_title', $item->title, $item->ID ),
			$icon,
			$args->link_after,
			$args->after
		);

		// Build html
		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );

		/**
		 * Initialize the mega menu.
		 */
		if ( $depth == 0 ) {
			$this->megamenu = false;
			$this->current_item = null;
		}

		if ( $item->megamenu ) {
			$this->megamenu = true;
			$this->current_item = $item;
		}

		if ( $item->megamenu && $item->object == 'category' ) {
			$this->category_megamenu = true;
			$this->mega_columns  = 'cols-4';
		}

	}

	/**
	 * Ends the element output, if needed.
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param object $item   Page data object. Not used.
	 * @param int    $depth  Depth of page. Not Used.
	 * @param array  $args   An array of arguments. @see wp_nav_menu()
	 */
	function end_el( &$output, $item, $depth = 0, $args = array() ) {
		$output .= "</li>\n";
	}

	function display_element( $element, &$children_elements, $max_depth, $depth=0, $args, &$output ) {
		$id_field = $this->db_fields['id'];
		if ( is_object( $args[0] ) ) {
			$args[0]->has_children = ! empty( $children_elements[$element->$id_field] );
		}
		return parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
	}

}

/**
 * Custom latest posts based on parent category on top-level menu.
 *
 * @since  1.0.0
 */
function truenews_get_latest_posts( $args ) {
	extract( $args );

	$output = '';

	$output .= '<div class="sf-mega-posts">';

		$posts = new WP_Query( array( 'cat' => $item->object_id, 'posts_per_page' => 3, 'ignore_sticky_posts' => 1 ) );

		if ( $posts->have_posts() ) :
			while ( $posts->have_posts() ) : $posts->the_post();
				$output .= '<div class="entry post">';
					if ( has_post_thumbnail() ) {
						$output .= '<a href="' . get_permalink() . '">' . get_the_post_thumbnail( get_the_ID(), 'truenews-megamenu', array( 'alt' => esc_attr( get_the_title() ), 'class' => 'entry-thumbnail' ) ) . '</a>';
					}
					$output .= '<h2 class="entry-title"><a href="' . get_permalink() . '" rel="bookmark">' . get_the_title() . '</a></h3>';
				$output .= '</div>';
			endwhile;
		endif;
		wp_reset_postdata();

	$output .= '</div>';

	return $output;

}
add_filter( 'truenews_mega_menu_end_lvl', 'truenews_get_latest_posts' );