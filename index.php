<?php get_header(); ?>
<?php
list ($baseType, $subType) = emptybox_get_template_types();
$havePosts =  have_posts();
$args = array("baseType" => $baseType, "subType" => $subType, "havePosts" => $havePosts);
?>

<main id="site-content" class="site-content">
	<?php get_template_part('template-widgets/page-header', $subType, $args); ?>

	<div class="site-wrapper">
		<?php get_template_part('template-widgets/sidebar-left', $subType, $args); ?>

		<!-- Page Content -->
		<div id="page-content" class="page-content">
			<?php get_template_part('template-parts/content-' . $baseType, $subType, $args); ?>
		</div>

		<?php
		get_template_part('template-widgets/sidebar-right', $subType, $args);
		get_template_part('template-widgets/sidebar-mobile', $subType, $args);
		?>
	</div>

	<?php get_template_part('template-widgets/page-footer', $subType, $args); ?>
</main>

<?php get_footer(); ?>
