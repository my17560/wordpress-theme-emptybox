<?php get_header(); ?>
<?php
list ($baseType, $subType) = emptybox_get_template_types();
$havePosts =  have_posts();
$args = array("baseType" => $baseType, "subType" => $subType, "havePosts" => $havePosts);
?>

<div id="content" class="site-content">
	<?php get_template_part('template-widgets/page-header', $subType, $args); ?>

	<div class="wrapper">
		<?php get_template_part('template-widgets/sidebar-left', $subType, $args); ?>

		<!-- Main Content -->
		<main id="primary" class="site-main content-area">
			<?php get_template_part('template-parts/content-' . $baseType, $subType, $args); ?>
		</main>

		<?php
		get_template_part('template-widgets/sidebar-right', $subType, $args);
		get_template_part('template-widgets/sidebar-mobile', $subType, $args);
		?>
	</div>

	<?php get_template_part('template-widgets/page-footer', $subType, $args); ?>
</div>

<?php get_footer(); ?>
