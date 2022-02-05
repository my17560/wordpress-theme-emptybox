<?php get_header(); ?>
<?php
list ($baseType, $subType) = emptybox_get_template_types();
$havePosts =  have_posts();
$args = array("baseType" => $baseType, "subType" => $subType, "havePosts" => $havePosts);
?>

<div id="content" class="site-content">
	<?php //get_template_part('template-parts/entry-header-wide', $templateType, $args); ?>
	<div class="wrapper">
		<?php get_template_part('template-parts/sidebar-left', '', $args); ?>

		<!-- Main Content -->
		<main id="primary" class="site-main content-area">
			<?php
			// Page Header
			get_template_part('template-parts/page-header', $subType, $args);

			// Entry
			get_template_part('template-parts/content-' . $baseType, $subType, $args);

			// Page Footer
			get_template_part('template-parts/page-footer', $subType, $args);
			?>
		</main>

		<?php
		get_template_part('template-parts/sidebar-right', '', $args);
		get_template_part('template-parts/sidebar-mobile', '', $args);
		?>
	</div>
	<?php //get_template_part('template-parts/entry-footer-wide', $templateType, $args); ?>
</div>

<?php get_footer(); ?>
