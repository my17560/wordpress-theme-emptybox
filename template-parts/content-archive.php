<?php
$havePosts = have_posts();

// Archive Header
get_template_part('template-widgets/archive-header', $args["subType"], $args);

if ($havePosts) {
	// Has Results
	while ($havePosts) {
		the_post();
		$args = array("baseType" => $args["baseType"], "subType" => $args["subType"], "havePosts" => $havePosts);
?>
		<a href="<?php the_permalink() ?>">
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<?php get_template_part('template-widgets/entry-header', $args["subType"], $args); ?>
				<?php get_template_part('template-widgets/entry-content', $args["subType"], $args); ?>
				<?php get_template_part('template-widgets/entry-footer', $args["subType"], $args); ?>
			</article>
		</a>
<?php
		$havePosts = have_posts();
	}
} else {
	// No Results
	$args = array("baseType" => $args["baseType"], "subType" => $args["subType"], "havePosts" => false);
?>
	<section class="no-results not-found">
		<?php get_template_part('template-widgets/entry-header', $args["subType"], $args); ?>
		<?php get_template_part('template-widgets/entry-content', $args["subType"], $args); ?>
		<?php get_template_part('template-widgets/entry-footer', $args["subType"], $args); ?>
	</section>
<?php
}

// Archive Footer
get_template_part('template-widgets/archive-footer', $args["subType"], $args);
?>
