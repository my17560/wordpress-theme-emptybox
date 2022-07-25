<?php
// =============================================================================
/**
 * Initialize the theme
 *
 * @package emptybox
 */
// =============================================================================

/**
 * Set up the theme.
 */
function emptybox_setup()
{

	add_theme_support('custom-logo');
	add_theme_support('title-tag');
	add_theme_support('post-thumbnails');
	load_theme_textdomain('emptybox', get_template_directory() . '/languages');

}
add_action('after_setup_theme', 'emptybox_setup');

function emptybox_customize_register($wp_customize)
{

	$wp_customize->add_panel(
		'emptybox_options',
		array(
			'title'			=> __('Options'),
			'priority'		=> 120,
		)
	);

	$wp_customize->add_section(
		'emptybox_options_archive',
		array(
			'title'			=> 'Archive Pages',
			'panel'			=> 'emptybox_options',
			'priority'		=> 1,
		)
	);

	$wp_customize->add_setting('archive_linkarticle');
	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'archive_linkarticle',
			array(
				'label'		=> __('Link to each article'),
				'section'	=> 'emptybox_options_archive',
				'settings'	=> 'archive_linkarticle',
				'priority'	=> 1,
				'type'		=> 'checkbox',
			)
		)
	);

}
add_action('customize_register', 'emptybox_customize_register');

// -----------------------------------------------------------------------------

/**
 * Load reset.css/common.css if exists.
 */
function emptybox_scripts_base()
{

	if (file_exists(get_stylesheet_directory() . '/reset.css')) {
		wp_enqueue_style('emptybox_reset_style', get_stylesheet_directory_uri() . '/reset.css');
	}

	if (file_exists(get_stylesheet_directory() . '/common.css')) {
		wp_enqueue_style('emptybox_common_style', get_stylesheet_directory_uri() . '/common.css');
	}

}
add_action('wp_enqueue_scripts', 'emptybox_scripts_base', -999);

// -----------------------------------------------------------------------------

/**
 * Load style.css.
 */
function emptybox_scripts_theme()
{

	wp_enqueue_style('theme_style', get_stylesheet_directory_uri() . '/style.css');

}
add_action('wp_enqueue_scripts', 'emptybox_scripts_theme', 999);

// -----------------------------------------------------------------------------

/**
 * Load widget's javascipt for admin page.
 *
 * @param	string		$hook_suffix	Hook suffix.
 */
function emptybox_scripts_admin($hook_suffix) {
	if ($hook_suffix === 'widgets.php') {
		wp_enqueue_script('emptybox_admin_js', get_template_directory_uri() . '/inc/widgets/emptybox_basicparts_admin.js');
	//	wp_enqueue_style('custom_css', get_template_directory_uri() . '/inc/css/custom.css');
	}
}
add_action('admin_enqueue_scripts', 'emptybox_scripts_admin');

// -----------------------------------------------------------------------------

/**
 * Init widget area.
 */
function emptybox_widgets_init()
{

	register_sidebar(
		array(
			'name'          => esc_html__('Site Header', 'emptybox'),
			'id'            => 'site-header',
			'before_widget' => '',
			'after_widget'  => '',
			'before_title'  => '',
			'after_title'   => '',
		)
	);

	register_sidebar(
		array(
			'name'          => esc_html__('Page Header (Singular)', 'emptybox'),
			'id'            => 'page-header-singular',
			'before_widget' => '',
			'after_widget'  => '',
			'before_title'  => '',
			'after_title'   => '',
		)
	);

	register_sidebar(
		array(
			'name'          => esc_html__('Entry Header (Singular)', 'emptybox'),
			'id'            => 'entry-header-singular',
			'before_widget' => '',
			'after_widget'  => '',
			'before_title'  => '',
			'after_title'   => '',
		)
	);

	register_sidebar(
		array(
			'name'          => esc_html__('Entry Content (Singular)', 'emptybox'),
			'id'            => 'entry-content-singular',
			'before_widget' => '',
			'after_widget'  => '',
			'before_title'  => '',
			'after_title'   => '',
		)
	);

	register_sidebar(
		array(
			'name'          => esc_html__('Entry Footer (Singular)', 'emptybox'),
			'id'            => 'entry-footer-singular',
			'before_widget' => '',
			'after_widget'  => '',
			'before_title'  => '',
			'after_title'   => '',
		)
	);

	register_sidebar(
		array(
			'name'          => esc_html__('Page Footer (Singular)', 'emptybox'),
			'id'            => 'page-footer-singular',
			'before_widget' => '',
			'after_widget'  => '',
			'before_title'  => '',
			'after_title'   => '',
		)
	);

	register_sidebar(
		array(
			'name'          => esc_html__('Page Header (Archive)', 'emptybox'),
			'id'            => 'page-header-archive',
			'before_widget' => '',
			'after_widget'  => '',
			'before_title'  => '',
			'after_title'   => '',
		)
	);

	register_sidebar(
		array(
			'name'          => esc_html__('Archive Header (Archive)', 'emptybox'),
			'id'            => 'archive-header-archive',
			'before_widget' => '',
			'after_widget'  => '',
			'before_title'  => '',
			'after_title'   => '',
		)
	);

	register_sidebar(
		array(
			'name'          => esc_html__('Entry Header (Archive)', 'emptybox'),
			'id'            => 'entry-header-archive',
			'before_widget' => '',
			'after_widget'  => '',
			'before_title'  => '',
			'after_title'   => '',
		)
	);

	register_sidebar(
		array(
			'name'          => esc_html__('Entry Content (Archive)', 'emptybox'),
			'id'            => 'entry-content-archive',
			'before_widget' => '',
			'after_widget'  => '',
			'before_title'  => '',
			'after_title'   => '',
		)
	);

	register_sidebar(
		array(
			'name'          => esc_html__('Entry Footer (Archive)', 'emptybox'),
			'id'            => 'entry-footer-archive',
			'before_widget' => '',
			'after_widget'  => '',
			'before_title'  => '',
			'after_title'   => '',
		)
	);

	register_sidebar(
		array(
			'name'          => esc_html__('Archive Footer (Archive)', 'emptybox'),
			'id'            => 'archive-footer-archive',
			'before_widget' => '',
			'after_widget'  => '',
			'before_title'  => '',
			'after_title'   => '',
		)
	);

	register_sidebar(
		array(
			'name'          => esc_html__('Page Footer (Archive)', 'emptybox'),
			'id'            => 'page-footer-archive',
			'before_widget' => '',
			'after_widget'  => '',
			'before_title'  => '',
			'after_title'   => '',
		)
	);

	/*
	register_sidebar(
		array(
			'name'          => esc_html__('Page Header (Archive - No Result)', 'emptybox'),
			'id'            => 'page-header-archive-noresult',
			'before_widget' => '',
			'after_widget'  => '',
			'before_title'  => '',
			'after_title'   => '',
		)
	);
	 */

	register_sidebar(
		array(
			'name'          => esc_html__('Entry Header (Archive - No Result)', 'emptybox'),
			'id'            => 'entry-header-archive-noresult',
			'before_widget' => '',
			'after_widget'  => '',
			'before_title'  => '',
			'after_title'   => '',
		)
	);

	register_sidebar(
		array(
			'name'          => esc_html__('Entry Content (Archive - No Result)', 'emptybox'),
			'id'            => 'entry-content-archive-noresult',
			'before_widget' => '',
			'after_widget'  => '',
			'before_title'  => '',
			'after_title'   => '',
		)
	);

	register_sidebar(
		array(
			'name'          => esc_html__('Entry Footer (Archive - No Result)', 'emptybox'),
			'id'            => 'entry-footer-archive-noresult',
			'before_widget' => '',
			'after_widget'  => '',
			'before_title'  => '',
			'after_title'   => '',
		)
	);

	/*
	register_sidebar(
		array(
			'name'          => esc_html__('Page Footer (Archive - No Result)', 'emptybox'),
			'id'            => 'page-footer-archive-noresult',
			'before_widget' => '',
			'after_widget'  => '',
			'before_title'  => '',
			'after_title'   => '',
		)
	);
	 */

	register_sidebar(
		array(
			'name'          => esc_html__('Page Header (404)', 'emptybox'),
			'id'            => 'page-header-404',
			'before_widget' => '',
			'after_widget'  => '',
			'before_title'  => '',
			'after_title'   => '',
		)
	);

	register_sidebar(
		array(
			'name'          => esc_html__('Entry Header (404)', 'emptybox'),
			'id'            => 'entry-header-404',
			'before_widget' => '',
			'after_widget'  => '',
			'before_title'  => '',
			'after_title'   => '',
		)
	);

	register_sidebar(
		array(
			'name'          => esc_html__('Entry Content (404)', 'emptybox'),
			'id'            => 'entry-content-404',
			'before_widget' => '',
			'after_widget'  => '',
			'before_title'  => '',
			'after_title'   => '',
		)
	);

	register_sidebar(
		array(
			'name'          => esc_html__('Entry Footer (404)', 'emptybox'),
			'id'            => 'entry-footer-404',
			'before_widget' => '',
			'after_widget'  => '',
			'before_title'  => '',
			'after_title'   => '',
		)
	);

	register_sidebar(
		array(
			'name'          => esc_html__('Page Footer (404)', 'emptybox'),
			'id'            => 'page-footer-404',
			'before_widget' => '',
			'after_widget'  => '',
			'before_title'  => '',
			'after_title'   => '',
		)
	);

	register_sidebar(
		array(
			'name'          => esc_html__('Site Footer', 'emptybox'),
			'id'            => 'site-footer',
			'before_widget' => '',
			'after_widget'  => '',
			'before_title'  => '',
			'after_title'   => '',
		)
	);

	register_sidebar(
		array(
			'name'          => esc_html__('Sidebar (Left)', 'emptybox'),
			'id'            => 'sidebar-left',
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

	register_sidebar(
		array(
			'name'          => esc_html__('Sidebar (Right)', 'emptybox'),
			'id'            => 'sidebar-right',
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

	register_sidebar(
		array(
			'name'          => esc_html__('Sidebar (Mobile)', 'emptybox'),
			'id'            => 'sidebar-mobile',
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

	register_sidebar(
		array(
			'name'          => esc_html__('Head Utils', 'emptybox'),
			'id'            => 'head-utils',
			'before_widget' => '',
			'after_widget'  => '',
			'before_title'  => '',
			'after_title'   => '',
		)
	);

	register_sidebar(
		array(
			'name'          => esc_html__('Site Utils', 'emptybox'),
			'id'            => 'site-utils',
			'before_widget' => '',
			'after_widget'  => '',
			'before_title'  => '',
			'after_title'   => '',
		)
	);

}
add_action('widgets_init', 'emptybox_widgets_init');
