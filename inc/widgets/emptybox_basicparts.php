<?php
// =============================================================================
/**
 * Basic parts widget.
 *
 * @package emptybox
 */
// =============================================================================

class EmptyboxParts extends WP_Widget
{

	public $typeNames;

	// -------------------------------------------------------------------------

	/**
	 * Constructor.
	 */
	function __construct()
	{

		// super()
		parent::__construct(
			'emptybox_parts',
			__('Empty Box Basic Parts'),
			array('description' => __('Empty Box theme basic parts.'))
		);

		// Init type names
		$this->typeNames = array(
			"none" => "(None)",
			"site_title" => "Site Title",
			"site_logo" => "Site Logo",
			"entry_title" => "Entry Title",
			"entry_content" => "Entry Content",
			"entry_excerpt" => "Entry Excerpt",
			"entry_thumbnail" => "Entry Thumbnail",
			"entry_tags" => "Entry Tags",
			"entry_createdate" => "Entry Create Date",
			"entry_updatedate" => "Entry Modified Date",
			"paged_title" => "Paged Title",
			"post_navigation" => "Post Navigation",
			"posts_navigation" => "Posts Navigation",
			"posts_pagination" => "Posts Pagination",
			"tag_start" => "Start Tag",
			"tag_end" => "End Tag",
			"html" => "Custom HTML",
			"code" => "Code",
		);

	}

	// -------------------------------------------------------------------------

	/**
	 * Render a widget.
	 *
	 * @param	array		$args
	 * @param	array		$instance
	 */
	public function widget($args, $instance)
	{

		// Get Variables

		$type = $instance['type'];
		$wrapper_id = ( $instance['wrapper_id'] ? ' id="' . $instance['wrapper_id'] . '"' : '' );
		$wrapper_class = ( $instance['wrapper_class'] ? ' class="' . $instance['wrapper_class'] . '"' : '' );
		$wrapper_start = ( $instance['wrapper'] !== 'none' ? sprintf('<%s%s%s>' , $instance['wrapper'], $wrapper_id, $wrapper_class) : '' );
		$wrapper_end = ( $instance['wrapper'] !== 'none' ? '</' . $instance['wrapper'] . '>' : '' );
		$par_code = ( $instance['par_code'] ? $instance['par_code'] : '' );
		$par_dateformat = ( $instance['par_dateformat'] ? $instance['par_dateformat'] : '' );
		$par_nexttext = ( $instance['par_nexttext'] ? $instance['par_nexttext'] : 'Next »' );
		$par_prevtext = ( $instance['par_prevtext'] ? $instance['par_prevtext'] : '« Previous' );
		$par_midsize = ( $instance['par_midsize'] ? $instance['par_midsize'] : 2 );
		$par_screenreadertext = ( $instance['par_screenreadertext'] ? $instance['par_screenreadertext'] : '' );
		$par_arialabel = ( $instance['par_arialable'] ? $instance['par_arialable'] : '' );
		$par_class = ( $instance['par_class'] ? $instance['par_class'] : '' );
		$par_insameterm = ( $instance['par_insameterm'] ? $instance['par_insameterm'] : true );
		$par_excludedterms = ( $instance['par_excludedterms'] ? $instance['par_excludedterms'] : '' );
		$par_taxonomy = ( $instance['par_taxonomy'] ? $instance['par_taxonomy'] : '' );

		$ret = "";
		switch ($type)
		{
		case 'site_title':
			$ret = get_bloginfo("name");
			break;
		case 'site_logo':
			$ret = get_custom_logo();
			break;
		case 'entry_title':
			$ret = get_the_title();
			break;
		case 'entry_content':
			$ret = apply_filters('the_content', get_the_content());
			break;
		case 'entry_excerpt':
			$ret = apply_filters('the_excerpt', get_the_excerpt());
			break;
		case 'entry_thumbnail':
			$ret = get_the_post_thumbnail();
			break;
		case 'entry_tags':
			break;
		case 'entry_createdate':
			$ret = get_the_date($par_dateformat);
			break;
		case 'entry_updatedate':
			$ret = get_the_modified_date($par_dateformat);
			break;
		case 'paged_title':
			if (is_search()) {
    			$ret = __("Search Result") . ': ' . get_search_query();
			} else if (is_home()) {
			} else if (!is_search()) {
    			$ret = get_the_archive_title();
			}
			break;
		case 'post_navigation':
			$ret = the_post_navigation(array(
				'next_text' => $par_nexttext,
				'prev_text' => $par_prevtext,
				'screen_reader_text' => $par_screenreadertext,
				'aria_label' => $par_arialable,
				'class' => $par_class,
				'in_same_term' => $par_insameterm,
				'exclude_terms' => $par_excludedterms,
			));
			break;
		case 'posts_navigation':
			$ret = the_posts_navigation(array(
				'next_text' => $par_nexttext,
				'prev_text' => $par_prevtext,
				'screen_reader_text' => $par_screenreadertext,
				'aria_label' => $par_arialable,
				'class' => $par_class,
			));
			break;
		case 'posts_pagination':
			$ret = the_posts_pagination(array(
				'mid_size' => $par_midsize,
				'next_text' => $par_nexttext,
				'prev_text' => $par_prevtext,
				'screen_reader_text' => $par_screenreadertext,
				'aria_label' => $par_arialable,
				'class' => $par_class,
			));
			break;
		case 'tag_start':
			$ret = $wrapper_start;
			$wrapper_start = "";
			$wrapper_end = "";
			break;
		case 'tag_end':
			$ret = $wrapper_end;
			$wrapper_start = "";
			$wrapper_end = "";
			break;
		case 'code':
			break;
		case 'html':
			$ret = $instance['par_code'];
			break;
		}

		// Before Widget
		echo $args['before_widget'];

		// Widget
		echo $wrapper_start . $ret . $wrapper_end;

		// After Widget
		echo $args['after_widget'];

	}

	// -------------------------------------------------------------------------

	/**
	 * Render an admin form.
	 *
	 * @param	array		$instance
	 */
	public function form($instance)
	{

		// Get Variables

		$type = ( $instance['type'] ? $instance['type'] : 'none' );
		$wrapper = ( $instance['wrapper'] ? $instance['wrapper'] : '' );
		$wrapper_id = ( $instance['wrapper_id'] ? $instance['wrapper_id'] : '' );
		$wrapper_class = ( $instance['wrapper_class'] ? $instance['wrapper_class'] : '' );
		$wrapper_start = ( $instance['wrapper'] !== 'none' ? sprintf('<%s%s%s>' , $instance['wrapper'], $wrapper_id, $wrapper_class) : '' );
		$wrapper_end = ( $instance['wrapper'] !== 'none' ? '</' . $instance['wrapper'] . '>' : '' );
		$par_code = ( $instance['par_code'] ? $instance['par_code'] : '' );
		$par_dateformat = ( $instance['par_dateformat'] ? $instance['par_dateformat'] : '' );
		$par_nexttext = ( $instance['par_nexttext'] ? $instance['par_nexttext'] : '' );
		$par_prevtext = ( $instance['par_prevtext'] ? $instance['par_prevtext'] : '' );
		$par_midsize = ( $instance['par_midsize'] ? $instance['par_midsize'] : '' );
		$par_screenreadertext = ( $instance['par_screenreadertext'] ? $instance['par_screenreadertext'] : '' );
		$par_arialabel = ( $instance['par_arialable'] ? $instance['par_arialable'] : '' );
		$par_class = ( $instance['par_class'] ? $instance['par_class'] : '' );
		$par_insameterm = ( $instance['par_insameterm'] ? $instance['par_insameterm'] : '' );
		$par_excludedterms = ( $instance['par_excludedterms'] ? $instance['par_excludedterms'] : '' );
		$par_taxonomy = ( $instance['par_taxonomy'] ? $instance['par_taxonomy'] : '' );

		// Decide Title

		$title = $this->typeNames[$type];
		if ($type === 'html') {
			$title .= ": " . $instance['code'];
		} else if ($type === 'tag_start') {
			$title .= ": " . $wrapper;
		} else if ($type === 'tag_end') {
			$title .= ": " . $wrapper;
		} else {
			$title = $this->typeNames[$type];
		}
		?>

<div class="emptybox-basicparts">
		<!-- Title -->

		<p>
<!--
		<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label>
-->
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="hidden" value="<?php echo esc_attr($title); ?>" />
		</p>

		<!-- Type -->

		<p class="emptybox-basicparts-type">
		<label for="<?php echo $this->get_field_id('type'); ?>"><?php _e('Type:'); ?></label>
		<select class="widefat" id="<?php echo $this->get_field_id('type'); ?>" name="<?php echo $this->get_field_name('type'); ?>">
			<option value="none"<?php echo ($type == 'none' ? 'selected' : '') ?>>(None)</option>
			<option value="site_title"<?php echo ($type == 'site_title' ? 'selected' : '') ?>>Site Title</option>
			<option value="site_logo"<?php echo ($type == 'site_logo' ? 'selected' : '') ?>>Site Logo</option>
			<option value="entry_title"<?php echo ($type == 'entry_title' ? 'selected' : '') ?>>Entry Title</option>
			<option value="entry_content"<?php echo ($type == 'entry_content' ? 'selected' : '') ?>>Entry Content</option>
			<option value="entry_excerpt"<?php echo ($type == 'entry_excerpt' ? 'selected' : '') ?>>Entry Excerpt</option>
			<option value="entry_thumbnail"<?php echo ($type == 'entry_thumbnail' ? 'selected' : '') ?>>Entry Thumbnail</option>
			<option value="entry_tags"<?php echo ($type == 'entry_tags' ? 'selected' : '') ?>>Entry Tags</option>
			<option value="entry_createdate"<?php echo ($type == 'entry_createdate' ? 'selected' : '') ?>>Entry Create Date</option>
			<option value="entry_updatedate"<?php echo ($type == 'entry_updatedate' ? 'selected' : '') ?>>Entry Modified Date</option>
			<option value="paged_title"<?php echo ($type == 'paged_title' ? 'selected' : '') ?>>Paged Title</option>
			<option value="post_navigation"<?php echo ($type == 'post_navigation' ? 'selected' : '') ?>><?php echo $this->typeNames["post_navigation"]; ?></option>
			<option value="posts_navigation"<?php echo ($type == 'posts_navigation' ? 'selected' : '') ?>>Posts Navigation</option>
			<option value="posts_pagination"<?php echo ($type == 'posts_pagination' ? 'selected' : '') ?>>Posts Pagination</option>
			<option value="tag_start"<?php echo ($type == 'tag_start' ? 'selected' : '') ?>>Start Tag</option>
			<option value="tag_end"<?php echo ($type == 'tag_end' ? 'selected' : '') ?>>End Tag</option>
			<option value="html"<?php echo ($type == 'html' ? 'selected' : '') ?>>Custom HTML</option>
			<option value="code"<?php echo ($type == 'code' ? 'selected' : '') ?>>PHP Code</option>
		</select>
		</p>

		<!-- Wrapper -->

		<p class="emptybox-basicparts-wrapper">
		<label for="<?php echo $this->get_field_id('wrapper'); ?>"><?php _e('Wrapper:'); ?></label>
		<select class="widefat" id="<?php echo $this->get_field_id('wrapper'); ?>" name="<?php echo $this->get_field_name('wrapper'); ?>">
			<option value="none"<?php echo ($wrapper == 'none' ? 'selected' : '') ?>>(None)</option>
			<option value="div"<?php echo ($wrapper == 'div' ? 'selected' : '') ?>>div</option>
			<option value="span"<?php echo ($wrapper == 'span' ? 'selected' : '') ?>>span</option>
			<option value="p"<?php echo ($wrapper == 'p' ? 'selected' : '') ?>>p</option>
			<option value="h1"<?php echo ($wrapper == 'h1' ? 'selected' : '') ?>>h1</option>
			<option value="h2"<?php echo ($wrapper == 'h2' ? 'selected' : '') ?>>h2</option>
			<option value="h3"<?php echo ($wrapper == 'h3' ? 'selected' : '') ?>>h3</option>
		</select>
		</p>
		<p class="emptybox-basicparts-wrapper_id">
		<label for="<?php echo $this->get_field_id('wrapper_id'); ?>"><?php _e('Wrapper Id:'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('wrapper_id'); ?>" name="<?php echo $this->get_field_name('wrapper_id'); ?>" type="text" value="<?php echo esc_attr($wrapper_id); ?>" />
		</p>
		<p class="emptybox-basicparts-wrapper_class">
		<label for="<?php echo $this->get_field_id('wrapper_class'); ?>"><?php _e('Wrapper Class:'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('wrapper_class'); ?>" name="<?php echo $this->get_field_name('wrapper_class'); ?>" type="text" value="<?php echo esc_attr($wrapper_class); ?>" />
		</p>

		<!-- Parameters -->

		<p class="emptybox-basicparts-par_code">
		<label for="<?php echo $this->get_field_id('par_code'); ?>"><?php _e('Code:'); ?></label>
		<textarea class="widefat" id="<?php echo $this->get_field_id('par_code'); ?>" name="<?php echo $this->get_field_name('par_code'); ?>"><?php echo esc_attr($par_code); ?></textarea>
		</p>

		<p class="emptybox-basicparts-par_dateformat">
		<label for="<?php echo $this->get_field_id('par_dateformat'); ?>"><?php _e('Date Format:'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('par_dateformat'); ?>" name="<?php echo $this->get_field_name('par_dateformat'); ?>" type="text" value="<?php echo esc_attr($par_dateformat); ?>" />
		</p>

		<p class="emptybox-basicparts-par_nexttext">
		<label for="<?php echo $this->get_field_id('par_nexttext'); ?>"><?php _e('Next Text:'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('par_nexttext'); ?>" name="<?php echo $this->get_field_name('par_nexttext'); ?>" type="text" value="<?php echo esc_attr($par_nexttext); ?>" />
		</p>

		<p class="emptybox-basicparts-par_prevtext">
		<label for="<?php echo $this->get_field_id('par_prevtext'); ?>"><?php _e('Prev Text:'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('par_prevtext'); ?>" name="<?php echo $this->get_field_name('par_prevtext'); ?>" type="text" value="<?php echo esc_attr($par_prevtext); ?>" />
		</p>

		<p class="emptybox-basicparts-par_midsize">
		<label for="<?php echo $this->get_field_id('par_midsize'); ?>"><?php _e('Mid Size:'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('par_midsize'); ?>" name="<?php echo $this->get_field_name('par_midsize'); ?>" type="text" value="<?php echo esc_attr($par_midsize); ?>" />
		</p>

		<p class="emptybox-basicparts-par_screenreadertext">
		<label for="<?php echo $this->get_field_id('par_screenreadertext'); ?>"><?php _e('Screen Reader Text:'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('par_screenreadertext'); ?>" name="<?php echo $this->get_field_name('par_screenreadertext'); ?>" type="text" value="<?php echo esc_attr($par_screenreadertext); ?>" />
		</p>

		<p class="emptybox-basicparts-par_arialabel">
		<label for="<?php echo $this->get_field_id('par_arialabel'); ?>"><?php _e('Arial Label:'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('par_arialabel'); ?>" name="<?php echo $this->get_field_name('par_arialabel'); ?>" type="text" value="<?php echo esc_attr($par_arialabel); ?>" />
		</p>

		<p class="emptybox-basicparts-par_class">
		<label for="<?php echo $this->get_field_id('par_class'); ?>"><?php _e('Class:'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('par_class'); ?>" name="<?php echo $this->get_field_name('par_class'); ?>" type="text" value="<?php echo esc_attr($par_class); ?>" />
		</p>

		<p class="emptybox-basicparts-par_insameterm">
		<label for="<?php echo $this->get_field_id('par_insameterm'); ?>"><?php _e('In Same Term:'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('par_insameterm'); ?>" name="<?php echo $this->get_field_name('par_insameterm'); ?>" type="checkbox" value="<?php echo esc_attr($par_insameterm); ?>" />
		</p>

		<p class="emptybox-basicparts-par_excludedterms">
		<label for="<?php echo $this->get_field_id('par_excludedterms'); ?>"><?php _e('Exclude Terms:'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('par_excludedterms'); ?>" name="<?php echo $this->get_field_name('par_excludedterms'); ?>" type="text" value="<?php echo esc_attr($par_excludedterms); ?>" />
		</p>

		<p class="emptybox-basicparts-par_taxonomy">
		<label for="<?php echo $this->get_field_id('par_taxonomy'); ?>"><?php _e('Taxonomy:'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('par_taxonomy'); ?>" name="<?php echo $this->get_field_name('par_taxonomy'); ?>" type="text" value="<?php echo esc_attr($par_taxonomy); ?>" />
		</p>

		<script type="text/javascript">
			(function($){
				let widget = jQuery('#<?php echo $this->get_field_id('title'); ?>').parent().parent();
				$(widget).find('.emptybox-basicparts-type select').on('change', function(){
					emptybox.initType(widget, this.value);
				});

				$(widget).find('.emptybox-basicparts-wrapper select').on('change', function(){
					emptybox.initWrapper(widget, this.value);
				});

				// Init
				emptybox.initType(widget, '<?php echo $type ?>')
				emptybox.initWrapper(widget, '<?php echo $wrapper ?>')
			})(jQuery);
		</script>
</div>

<?php
	}

	// -------------------------------------------------------------------------

	/**
	 * Update widget settings.
	 *
	 * @param	array		$new_instance
	 * @param	array		$old_instance
	 *
	 * @return	instance
	 */
	public function update($new_instance, $old_instance)
	{

		$instance = array();
		$instance['title'] = (!empty($new_instance['title']) ? sanitize_text_field($new_instance['title']) : '');
		$instance['type'] = (!empty($new_instance['type']) ? sanitize_text_field($new_instance['type']) : '');
		$instance['wrapper'] = (!empty($new_instance['wrapper']) ? sanitize_text_field($new_instance['wrapper']) : '');
		$instance['wrapper_id'] = (!empty($new_instance['wrapper_id']) ? sanitize_text_field($new_instance['wrapper_id']) : '');
		$instance['wrapper_class'] = (!empty($new_instance['wrapper_class']) ? sanitize_text_field($new_instance['wrapper_class']) : '');
		$instance['par_code'] = (!empty($new_instance['par_code']) ? $new_instance['par_code'] : '');
		$instance['par_dateformat'] = (!empty($new_instance['par_dateformat']) ? $new_instance['par_dateformat'] : '');
		$instance['par_nexttext'] = (!empty($new_instance['par_nexttext']) ? $new_instance['par_nexttext'] : '');
		$instance['par_prevtext'] = (!empty($new_instance['par_prevtext']) ? $new_instance['par_prevtext'] : '');
		$instance['par_midsize'] = (!empty($new_instance['par_midsize']) ? $new_instance['par_midsize'] : '');
		$instance['par_screenreadertext'] = (!empty($new_instance['par_screenreadertext']) ? $new_instance['par_screenreadertext'] : '');
		$instance['par_arialabel'] = (!empty($new_instance['par_arialabel']) ? $new_instance['par_arialabel'] : '');
		$instance['par_class'] = (!empty($new_instance['par_class']) ? $new_instance['par_class'] : '');
		$instance['par_insameterm'] = (!empty($new_instance['par_insameterm']) ? $new_instance['par_insameterm'] : '');
		$instance['par_excludedterms'] = (!empty($new_instance['par_excludedterms']) ? $new_instance['par_excludedterms'] : '');
		$instance['par_taxonomy'] = (!empty($new_instance['par_taxonomy']) ? $new_instance['par_taxonomy'] : '');

		return $instance;

	}

}

add_action('widgets_init', function () {
	register_widget('EmptyBoxParts');
});
