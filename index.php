<?php get_header(); ?>
<?php
list ($baseType, $subType) = emptybox_get_template_types();
$havePosts =  have_posts();
$args = array("baseType" => $baseType, "subType" => $subType, "havePosts" => $havePosts);
?>

<div id="content" class="site-content">
	<!-- Page Header -->
	<?php get_template_part('template-parts/page-header', $subType, $args); ?>

	<div class="wrapper">
		<!-- Sidebar Left -->
		<?php get_template_part('template-parts/sidebar-left', '', $args); ?>

		<!-- Main Content -->
		<main id="primary" class="site-main content-area">
			<?php get_template_part('template-parts/content-' . $baseType, $subType, $args); ?>
		</main>

		<!-- Sidebar Right/Mobile -->
		<?php
		get_template_part('template-parts/sidebar-right', '', $args);
		get_template_part('template-parts/sidebar-mobile', '', $args);
		?>
	</div>

	<!-- Page Footer -->
	<?php get_template_part('template-parts/page-footer', $subType, $args); ?>
</div>

<?php get_footer(); ?>
