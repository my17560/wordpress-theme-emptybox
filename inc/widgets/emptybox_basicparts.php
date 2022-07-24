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
			"archive_title" => "Archive Title",
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

		$title = emptybox_safeget($instance, 'title', '');
		$type = $instance['type'];
		$wrapper_id = ( !empty($instance['wrapper_id']) ? ' id="' . $instance['wrapper_id'] . '"' : '' );
		$wrapper_class = ( !empty($instance['wrapper_class']) ? ' class="' . $instance['wrapper_class'] . '"' : '' );
		$wrapper = emptybox_safeget($instance, 'wrapper', 'none');
		$wrapper_start = ( $wrapper !== 'none' ? sprintf('<%s%s%s>' , $wrapper, $wrapper_id, $wrapper_class) : '' );
		$wrapper_end = ( $wrapper !== 'none' ? '</' . $wrapper . '>' : '' );
		$par_code = emptybox_safeget($instance, 'par_code', '');
		$par_dateformat = emptybox_safeget($instance, 'par_dateformat', '');
		$par_nexttext = emptybox_safeget($instance, 'par_nexttext', 'Next »');
		$par_prevtext = emptybox_safeget($instance, 'par_prevtext', '« Previous');
		$par_midsize = emptybox_safeget($instance, 'par_midsize', 2);
		$par_screenreadertext = emptybox_safeget($instance, 'par_screenreadertext', '');
		$par_arialabel = emptybox_safeget($instance, 'par_ariable', '');
		$par_class = emptybox_safeget($instance, 'par_class', '');
		$par_insameterm = emptybox_safeget($instance, 'par_insameterm', false);
		$par_excludedterms = emptybox_safeget($instance, 'par_excludedterms', '');
		$par_taxonomy = emptybox_safeget($instance, 'par_taxonomy', '');
		$par_thumbnailsize = emptybox_safeget($instance, 'par_thumbnailsize', '');
		$par_archive_search = emptybox_safeget($instance, 'par_archive_search', '');
		$par_archive_tag  = emptybox_safeget($instance, 'par_archive_tag', '');
		$par_archive_date = emptybox_safeget($instance, 'par_archive_date', '');
		$par_archive_dateformat = emptybox_safeget($instance, 'par_archive_dateformat', '');
		$par_archive_category = emptybox_safeget($instance, 'par_archive_category', '');

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
			$ret = get_the_post_thumbnail(get_the_ID(), $par_thumbnailsize);
			break;
		case 'entry_tags':
			if(has_tag()) {
				$tags = get_the_tags(get_the_ID());
				foreach($tags as $tag){
					$ret .= '<a href="'.get_tag_link($tag->term_id).'">'. $tag->name.'</a>';
				}
			}
			break;
		case 'entry_createdate':
			$ret = get_the_date($par_dateformat);
			break;
		case 'entry_updatedate':
			$ret = get_the_modified_date($par_dateformat);
			break;
		case 'archive_title':
			$archive_class = 'archive-title';
			$archive_title = "";
			if (is_search()) {
				$icon = '<i class="fas fa-search"></i>';
				$archive_class .= ' search';
				$archive_title = get_search_query();
				$archive_msg = $par_archive_search;
			} else if (is_date()) {
				$icon = '<i class="fas fa-calendar"></i>';
				$archive_class .= " date";
				$archive_title = get_the_time($par_archive_dateformat);
				$archive_msg = $par_archive_date;
			} else if (is_tag()) {
				$icon = '<i class="fas fa-tag"></i>';
				$archive_class .= " tag";
				$archive_title = single_cat_title("", false);
				$archive_msg = $par_archive_tag;
			} else if (is_category()) {
				$icon = '<i class="fas fa-folder"></i>';
				$archive_class .= " category";
				$archive_title = single_cat_title("", false);
				$archive_msg = $par_archive_category;
			}

			if ($archive_title) {
				$ret = sprintf( esc_html__($archive_msg, 'myscribblenet' ), '<span class="' . $archive_class . '">' . $archive_title . '</span>' );
			}
			break;
		case 'post_navigation':
			$opt = array();
			if ($par_nexttext) $opt['next_text'] = $par_nexttext;
			if ($par_prevtext) $opt['prev_text'] = $par_prevtext;
			if ($par_screenreadertext) $opt['screen_reader_text'] = $par_screenreadertext;
			if ($par_arialabel) $opt['aria_label'] = $par_arialabel;
			if ($par_class) $opt['class'] = $par_class;
			if ($par_insameterm) $opt['in_same_term'] = $par_insameterm;
			if ($par_excludedterms) $opt['exclude_terms'] = $par_excludedterms;
			$ret = the_post_navigation($opt);
			break;
		case 'posts_navigation':
			if ($par_nexttext) $opt['next_text'] = $par_nexttext;
			if ($par_prevtext) $opt['prev_text'] = $par_prevtext;
			if ($par_screenreadertext) $opt['screen_reader_text'] = $par_screenreadertext;
			if ($par_arialabel) $opt['aria_label'] = $par_arialabel;
			if ($par_class) $opt['class'] = $par_class;
			$ret = the_posts_navigation($opt);
			break;
		case 'posts_pagination':
			if ($par_midsize) $opt['mid_size'] = $par_midsize;
			if ($par_nexttext) $opt['next_text'] = $par_nexttext;
			if ($par_prevtext) $opt['prev_text'] = $par_prevtext;
			if ($par_screenreadertext) $opt['screen_reader_text'] = $par_screenreadertext;
			if ($par_arialabel) $opt['aria_label'] = $par_arialabel;
			if ($par_class) $opt['class'] = $par_class;
			$ret = the_posts_pagination($opt);
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

		$title = emptybox_safeget($instance, 'title', '');
		$type = emptybox_safeget($instance, 'type', 'none');
		$wrapper = emptybox_safeget($instance, 'wrapper', 'none');
		$wrapper_id = emptybox_safeget($instance, 'wrapper_id', '');
		$wrapper_class = emptybox_safeget($instance, 'wrapper_class', '');
		$wrapper_start = ( $wrapper !== 'none' ? sprintf('<%s%s%s>' , $wrapper, $wrapper_id, $wrapper_class) : '' );
		$wrapper_end = ( $wrapper !== 'none' ? '</' . $wrapper . '>' : '' );
		$par_code = emptybox_safeget($instance, 'par_code', '');
		$par_dateformat = emptybox_safeget($instance, 'par_dateformat', '');
		$par_nexttext = emptybox_safeget($instance, 'par_nexttext', 'Next »');
		$par_prevtext = emptybox_safeget($instance, 'par_prevtext', '« Previous');
		$par_midsize = emptybox_safeget($instance, 'par_midsize', 2);
		$par_screenreadertext = emptybox_safeget($instance, 'par_screenreadertext', '');
		$par_arialabel = emptybox_safeget($instance, 'par_ariable', '');
		$par_class = emptybox_safeget($instance, 'par_class', '');
		$par_insameterm = emptybox_safeget($instance, 'par_insameterm', false);
		$par_excludedterms = emptybox_safeget($instance, 'par_excludedterms', '');
		$par_taxonomy = emptybox_safeget($instance, 'par_taxonomy', '');
		$par_thumbnailsize = emptybox_safeget($instance, 'par_thumbnailsize', '');
		$par_archive_search = emptybox_safeget($instance, 'par_archive_search', '');
		$par_archive_tag  = emptybox_safeget($instance, 'par_archive_tag', '');
		$par_archive_date = emptybox_safeget($instance, 'par_archive_date', '');
		$par_archive_dateformat = emptybox_safeget($instance, 'par_archive_dateformat', '');
		$par_archive_category = emptybox_safeget($instance, 'par_archive_category', '');
		?>

<div class="emptybox-basicparts">
		<!-- Title -->

		<p class="emptybox-basicparts-title">
		<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
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
			<option value="archive_title"<?php echo ($type == 'archive_title' ? 'selected' : '') ?>>Archive Title</option>
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

		<p class="emptybox-basicparts-par_thumbnailsize">
		<label for="<?php echo $this->get_field_id('par_thumbnailsize'); ?>"><?php _e('Thumbnail Size:'); ?></label>
		<select class="widefat" id="<?php echo $this->get_field_id('par_thumbnailsize'); ?>" name="<?php echo $this->get_field_name('par_thumbnailsize'); ?>">
			<option value="full"<?php echo ($par_thumbnailsize == 'full' ? 'selected' : '') ?>>full</option>
			<option value="thumbnail"<?php echo ($par_thumbnailsize == 'thumbnail' ? 'selected' : '') ?>>thumbnail</option>
			<option value="medium"<?php echo ($par_thumbnailsize == 'medium' ? 'selected' : '') ?>>medium</option>
			<option value="large"<?php echo ($par_thumbnailsize == 'large' ? 'selected' : '') ?>>large</option>
		</select>

		<p class="emptybox-basicparts-par_archive_search">
		<label for="<?php echo $this->get_field_id('par_archive_search'); ?>"><?php _e('Message - Search:'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('par_archive_search'); ?>" name="<?php echo $this->get_field_name('par_archive_search'); ?>" type="text" value="<?php echo esc_attr($par_archive_search); ?>" />
		</p>
		<p class="emptybox-basicparts-par_archive_tag">
		<label for="<?php echo $this->get_field_id('par_archive_tag'); ?>"><?php _e('Message - Tag:'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('par_archive_tag'); ?>" name="<?php echo $this->get_field_name('par_archive_tag'); ?>" type="text" value="<?php echo esc_attr($par_archive_tag); ?>" />
		</p>
		<p class="emptybox-basicparts-par_archive_date">
		<label for="<?php echo $this->get_field_id('par_archive_date'); ?>"><?php _e('Message - Date:'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('par_archive_date'); ?>" name="<?php echo $this->get_field_name('par_archive_date'); ?>" type="text" value="<?php echo esc_attr($par_archive_date); ?>" />
		<input class="widefat" id="<?php echo $this->get_field_id('par_archive_dateformat'); ?>" name="<?php echo $this->get_field_name('par_archive_dateformat'); ?>" type="text" value="<?php echo esc_attr($par_archive_dateformat); ?>" />
		</p>
		<p class="emptybox-basicparts-par_archive_category">
		<label for="<?php echo $this->get_field_id('par_archive_category'); ?>"><?php _e('Message - Category:'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('par_archive_category'); ?>" name="<?php echo $this->get_field_name('par_archive_category'); ?>" type="text" value="<?php echo esc_attr($par_archive_category); ?>" />
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
		$instance['title'] = emptybox_safeget($new_instance, 'title', '');
		$instance['type'] = emptybox_safeget($new_instance, 'type', '');
		$instance['wrapper'] = emptybox_safeget($new_instance, 'wrapper', '');
		$instance['wrapper_id'] = emptybox_safeget($new_instance, 'wrapper_id', '');
		$instance['wrapper_class'] = emptybox_safeget($new_instance, 'wrapper_class', '');
		$instance['par_code'] = emptybox_safeget($new_instance, 'par_code', '');
		$instance['par_dateformat'] = emptybox_safeget($new_instance, 'par_dateformat', '');
		$instance['par_nexttext'] = emptybox_safeget($new_instance, 'par_nexttext', '');
		$instance['par_prevtext'] = emptybox_safeget($new_instance, 'par_prevtext', '');
		$instance['par_midsize'] = emptybox_safeget($new_instance, 'par_midsize', '');
		$instance['par_screenreadertext'] = emptybox_safeget($new_instance, 'par_screenreadertext', '');
		$instance['par_arialabel'] = emptybox_safeget($new_instance, 'par_arialabel', '');
		$instance['par_class'] = emptybox_safeget($new_instance, 'par_class', '');
		$instance['par_insameterm'] = emptybox_safeget($new_instance, 'par_insameterm', '');
		$instance['par_excludedterms'] = emptybox_safeget($new_instance, 'par_excludedterms', '');
		$instance['par_taxonomy'] = emptybox_safeget($new_instance, 'par_taxonomy', '');
		$instance['par_thumbnailsize'] = emptybox_safeget($new_instance, 'par_thumbnailsize', '');
		$instance['par_archive_search'] = emptybox_safeget($new_instance, 'par_archive_search', '');
		$instance['par_archive_tag']  = emptybox_safeget($new_instance, 'par_archive_tag', '');
		$instance['par_archive_date'] = emptybox_safeget($new_instance, 'par_archive_date', '');
		$instance['par_archive_dateformat'] = emptybox_safeget($new_instance, 'par_archive_dateformat', '');
		$instance['par_archive_category'] = emptybox_safeget($new_instance, 'par_archive_category', '');

		return $instance;

	}

}

add_action('widgets_init', function () {
	register_widget('EmptyBoxParts');
});
